<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class DashboardController extends Controller
{
    public function index()
    {
        $today              = date('Y-m-d');

        //this week
        $startOfWeek        = Carbon::now()->startOfWeek(Carbon::SUNDAY);
        $endOfWeek          = Carbon::now()->endOfWeek(Carbon::SATURDAY);     
        $period             = CarbonPeriod::create($startOfWeek, $endOfWeek);
        $weekly_scheduled   = Appointment::where('status', 'Scheduled')
                                ->whereBetween('date', [$startOfWeek->format('Y-m-d'), $endOfWeek->format('Y-m-d')]);

        //last week
        $last_startOfWeek       = Carbon::now()->startOfWeek(Carbon::SUNDAY)->subWeek();
        $last_endOfWeek         = Carbon::now()->endOfWeek(Carbon::SATURDAY)->subWeek();     
        $last_period            = CarbonPeriod::create($last_startOfWeek, $last_endOfWeek);
        $last_weekly_scheduled  = Appointment::where('status', 'Scheduled')
                                    ->whereBetween('date', [$last_startOfWeek->format('Y-m-d'), $last_endOfWeek->format('Y-m-d')]);

        //others
        $pending            = Appointment::where('status', 'Pending');
        $scheduled          = Appointment::where('status', 'Scheduled');
        $today_scheduled    = Appointment::where('status', 'Scheduled')
                                ->where('date', $today);

        $customers = Appointment::where('created_at', '>=', now()->subMonth(1)
                        ->setTime(0, 0, 0)
                        ->toDateTimeString())
                        ->get()->unique('email')
                        ->values()
                        ->count();

        if (Auth::user()->hasRole('merchant')) {
            $pending->where('merchant_id', Auth::user()->merchant_id);
            $today_scheduled->where('merchant_id', Auth::user()->merchant_id);
            $weekly_scheduled->where('merchant_id', Auth::user()->merchant_id);
            $last_weekly_scheduled->where('merchant_id', Auth::user()->merchant_id);
        }

        //this week appointment
        $current_week = [];
        $appointments = $weekly_scheduled->get()->groupBy(function($item) {
             return $item->date;
        });
        foreach ($period as $date) {
            foreach($appointments as $day => $appointment){
                if ($date->format('Y-m-d') == $day) {
                    $current_week[$date->format('Y-m-d')] = $appointment->count();
                    break;
                } else {
                    $current_week[$date->format('Y-m-d')] = 0;
                }
            }
        }
        $current_week = collect(array_values($current_week))->toJson();

        //last week appointment
        $last_week = [];
        $last_week_appointments = $last_weekly_scheduled->get()->groupBy(function($item) {
             return $item->date;
        });
        
        foreach ($last_period as $date) {
            foreach($last_week_appointments as $day => $appointment){
                if ($date->format('Y-m-d') == $day) {
                    $last_week[$date->format('Y-m-d')] = $appointment->count();
                    break;
                } else {
                    $last_week[$date->format('Y-m-d')] = 0;
                }
            }
        }
        $last_week = collect(array_values($last_week))->toJson();

        $pending_appointments       = $pending->count();
        $today_appointments         = $today_scheduled->count();
        $weekly_appointments        = $weekly_scheduled->count();
        $last_weekly_appointments   = $last_weekly_scheduled->count();

        $result = (int) ($weekly_appointments / max($last_weekly_appointments, 1) * 100) - 100;

        return view('admin.dashboard.index')->with(compact(
            'pending_appointments', 
            'customers', 
            'today_appointments', 
            'result', 
            'weekly_appointments', 
            'current_week',
            'last_week'
        ));
    }
}
