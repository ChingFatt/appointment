<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Merchant;
use App\Models\Outlet;
use App\Models\Service;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('appointment.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (isset($request->merchant_code)) {
            $merchant = Merchant::where('merchant_code', $request->merchant_code)->first();
            $outlet = Outlet::findOrFail($request->outlet_id);
            $interval = $outlet->operating_hour->interval;

            $end_time = date("G:i:s", strtotime('+'.$request->duration.' minutes', strtotime($request->time)));
            $start_time = $request->time;
            $rounded_end_time = date('g:ia', round(strtotime($end_time) / ($interval * 60)) * ($interval * 60));

            $appointments = Appointment::where('status', 'Pending')
                ->where('outlet_id', $request->outlet_id)
                ->where('date', $request->date)
                ->where(function($query) use ($start_time,$rounded_end_time){
                    $query->whereTime('time', '>', $start_time);
                    $query->whereTime('time', '<', $rounded_end_time);
                })
                ->orWhere(function($query) use ($start_time,$rounded_end_time){
                    $query->whereTime('end_time', '>', $start_time);
                    $query->whereTime('end_time', '<', $rounded_end_time);
                })
                ->get()
                ->count();

            if ($appointments < $outlet->operating_hour->capacity) {
                $request->merge([
                    'merchant_id'   => $merchant->id,
                    'industry_id'   => $merchant->industry_id,
                    'end_time'      => $rounded_end_time,
                    'status'        => 'Pending'
                ]);
                $appointment = Appointment::create($request->all());
                $this->appointment_no($appointment); 

                return redirect()->route('appointment', $request->merchant_code)->withSuccess('Thank you. Appointment has been made.');
            }

            return redirect()->route('appointment', $request->merchant_code)->withError('Insufficient time slot. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }

    public function availability(Request $request)
    {
        $picker = collect();
        $outlet = Outlet::where('id', $request->outlet_id)->first();

        if (isset($outlet->operating_hour)) {
            $operating_hours = $outlet->operating_hour->operating_hours;
            $picker->put('operating_hours', $outlet->operating_hour->operating_hours);
            $picker->put('interval', $outlet->operating_hour->interval);

            $daysOfWeekDisabled = [];

            foreach ($operating_hours as $day => $value) {
                if (empty($value['start_time']) && empty($value['end_time'])) {
                    $daysOfWeekDisabled[] = date('w', strtotime($day));
                    $picker->put('daysOfWeekDisabled', $daysOfWeekDisabled);
                }

                if (isset($value['start_time']) && $day == 'Friday') {
                    $picker->put('start_time', $value['start_time']);
                    $picker->put('end_time', $value['end_time']);
                }

                if (isset($value['rest_start_time']) && isset($value['rest_end_time']) && $day == 'Friday') {
                    $picker->put('rest_start_time', $value['rest_start_time']);
                    $picker->put('rest_end_time', $value['rest_end_time']);
                }
            }
        }

        return view('appointment.availability')->with(compact('picker')); 
    }

    public function appointment_no($appointment)
    {
        $appointments = Appointment::where('created_at', 'like', '%'.date('Y-m-d').'%')->get()->count();
        $appointment_no = date('ymd').''.sprintf('%04d', $appointments);

        $appointment->appointment_no = $appointment_no;
        $appointment->save();
    }

    public function appointment($merchant)
    {
        if (isset($merchant)) {
            return view('appointment.index')->with(compact('merchant'));
        } else {

        }
    }
}
