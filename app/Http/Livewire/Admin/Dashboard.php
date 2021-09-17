<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Appointment;
use Auth;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Http;

class Dashboard extends Component
{
    public $duration;
    public $start_date;
    public $end_date;

    public $customers;
    public $today_appointments;
    public $weekly_appointments;
    public $current_week;
    public $last_week;
    public $scheduled;
    public $total;
    public $result;

    public $selectedDuration = NULL;

    public function render()
    {
        return view('livewire.admin.dashboard');
    }

    public function mount()
    {
        //$this->duration = 30;
        //session()->put('duration', $this->duration);
    }

    public function test()
    {
        return redirect()->route('admin.merchant.show', 8);
    }

    public function selectedDuration($duration = null)
    {
        //$holiday = Http::get('https://calendarific.com/api/v2/holidays?&api_key=a82664be48e31697f59ce9bd56e6b14a4cc0607d&country=SG&year=2021');
        //dd($holiday->json()['response']);

        //sleep(1);//to test slow connection
        if (isset($duration)) {
            $this->duration = $duration;
        } else {
            if (session()->has('duration')) {
                $this->duration = session()->get('duration');
            } else {
                $this->duration = 30;
            }
        }
        session()->put('duration', $this->duration);
        $duration = session()->get('duration');

        if (is_int($duration)) {
            $start_date = now()->subDays($duration);
            $end_date = now();
        } else {
            $start_date = date('Y-m-01', strtotime($duration));
            $end_date = date('Y-m-t', strtotime($duration));
        }

        $today = date('Y-m-d');
        $today_scheduled = Appointment::where('status', 'Scheduled')->where('date', $today);
        $scheduled = Appointment::where('status', 'Scheduled')->whereBetween('date', [$start_date, $end_date]);
        $total = Appointment::whereBetween('date', [$start_date, $end_date]);
        $customers = Appointment::whereBetween('date', [$start_date, $end_date]);

        $startOfWeek        = Carbon::now()->startOfWeek(Carbon::SUNDAY);
        $endOfWeek          = Carbon::now()->endOfWeek(Carbon::SATURDAY);  

        $this->current_week = $this->getWeeklyAppointments($startOfWeek, $endOfWeek);
        $this->last_week = $this->getWeeklyAppointments($startOfWeek->subWeek(), $endOfWeek->subWeek());

        //if merchant role
        if (Auth::user()->hasRole('merchant')) {
            $this->getMerchantAppointments(collect($this->current_week));
            $this->getMerchantAppointments(collect($this->last_week));
            $this->getMerchantAppointments($today_scheduled);
            $this->getMerchantAppointments($scheduled);
            $this->getMerchantAppointments($total);
            $this->getMerchantAppointments($customers);
        }

        if ($this->last_week > 0) {
            $this->result = (int) (collect($this->current_week)->sum() / max(collect($this->last_week)->sum(), 1) * 100) - 100;
        } else {
            $this->result = (int) (collect($this->current_week)->sum() * 100) - 100;
        }

        $this->customers = $customers->get()->unique('email')->values()->count();
        $this->today_appointments = $today_scheduled->count();
        $this->scheduled = $scheduled->count();
        $this->total = $total->count();

        $this->start_date = date('d M Y', strtotime($start_date));
        $this->end_date = date('d M Y', strtotime($end_date));

        $this->dispatchBrowserEvent('updateChart', ['current_week' => $this->current_week]);
    }

    public function getWeeklyAppointments($start, $end)
    {
        $period = CarbonPeriod::create($start, $end);
        $weekly_scheduled = Appointment::where('status', 'Scheduled')->whereBetween('date', [$start->format('Y-m-d'), $end->format('Y-m-d')]);
        $appointments = $weekly_scheduled->get()->groupBy(function($item) {
             return $item->date;
        });

        $data = [];

        foreach ($period as $date) {
            foreach($appointments as $day => $appointment){
                if ($date->format('Y-m-d') == $day) {
                    $data[$date->format('Y-m-d')] = $appointment->count();
                    break;
                } else {
                    $data[$date->format('Y-m-d')] = 0;
                }
            }
        }

        return array_values($data);
    }

    public function getMerchantAppointments($collection)
    {
        return $collection->where('merchant_id', Auth::user()->merchant_id);
    }
}
