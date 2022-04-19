<?php

namespace App\Http\Controllers;

use App\Mail\Welcome;
use App\Models\Appointment;
use App\Models\Merchant;
use App\Models\Outlet;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

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

            $start_time = $request->time;
            $end_time = date("G:i:s", strtotime('+'.$request->duration.' minutes', strtotime($request->time)));
            $rounded_end_time = date('g:ia', round(strtotime($end_time) / ($interval * 60)) * ($interval * 60));

            foreach ($outlet->operating_hour->operating_hours as $day => $value) {
                if (isset($value['start_time']) && $day == date('l', strtotime($request->date))) {
                    $end_operating_hour = $value['end_time'];
                }
            }

            if (Carbon::createFromFormat('g:ia', $rounded_end_time)->gte(Carbon::createFromFormat('g:ia', $end_operating_hour))) {
                return redirect()->route('appointment', $request->merchant_code)->withError('Total service duration exceeded operating hours. Please try again.');
            }

            $appointments = Appointment::where('status', 'Pending')
                ->where('outlet_id', $request->outlet_id)
                ->where('date', $request->date)
                ->where(function($query) use ($start_time,$rounded_end_time){
                    $query->whereTime('time', '>', $start_time);
                    $query->whereTime('end_time', '<', $rounded_end_time);
                })
                ->get()
                ->count();

            if ($appointments < $outlet->operating_hour->capacity) {
                $request->merge([
                    'merchant_id'   => $merchant->id,
                    'industry_id'   => $merchant->industry_id,
                    'employee_id'   => array_map(null, explode(',', $request->employee_id)),
                    'end_time'      => $rounded_end_time,
                    'status'        => 'Pending'
                ]);
                $appointment = Appointment::create($request->all());
                $this->appointment_no($appointment);

                Mail::to($request->email)->bcc($outlet->email)->send(new Welcome($request));

                return redirect()->route('appointment', $request->merchant_code)->withSuccess('Thank you. Your appointment has been made.');
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
        //
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
        $validation = Merchant::where('merchant_code', $merchant)->first();

        if (isset($validation)) {
            return view('appointment.index')->with(compact('merchant'));
        } else {
            return redirect()->route('landing');
        }
    }
}
