<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Http\Request;
use Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = Appointment::with('industry', 'merchant', 'outlet')->latest()->get();
        return view('admin.appointments.index')->with(compact('appointments'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        $services = Service::whereIn('id', $appointment->services())->get('name')->implode('name', ', ');
        return view('admin.appointments.show')->with(compact('appointment', 'services'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        return view('admin.appointments.edit')->with(compact('appointment'));
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
        if ($request->status != 'Pending') {
            $request->merge([
                'action_by' => Auth::id()
            ]);
        }

        $appointment->update($request->except('_method', '_token'));
        return redirect()->route('admin.appointment.show', $appointment);
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function calendar()
    {
        $data = Appointment::all();

        $listing = [];
        foreach ($data as $appointment) {
            if ($appointment->status == 'Scheduled') {
                $color = '#1fae77';
            } elseif ($appointment->status == 'Pending') {
                $color = '#e5ae67';
            } elseif ($appointment->status == 'Cancelled') {
                $color = '#e56767';
            }

            $services = Service::whereIn('id', $appointment->services())->get('name')->implode('name', ', ');

            $listing[$appointment->id]['title']       = $appointment->fullname.' - '.$services;
            $listing[$appointment->id]['start']       = $appointment->date.' '.date('H:i:s', strtotime($appointment->time));
            $listing[$appointment->id]['url']         = route('admin.appointment.show', $appointment);
            $listing[$appointment->id]['color']       = $color;
        }
        //dd(json_encode(array_values($listing)));
        $appointments = json_encode(array_values($listing));
        return view('admin.appointments.calendar')->with(compact('appointments'));
    }

}
