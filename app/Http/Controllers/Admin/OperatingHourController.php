<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OperatingHour;
use Illuminate\Http\Request;

class OperatingHourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.operating_hours.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $operatingHour = OperatingHour::create($request->all());
        return redirect()->route('admin.outlet.show', $operatingHour->outlet_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OperatingHour  $operatingHour
     * @return \Illuminate\Http\Response
     */
    public function show(OperatingHour $operatingHour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OperatingHour  $operatingHour
     * @return \Illuminate\Http\Response
     */
    public function edit(OperatingHour $operatingHour)
    {
        return view('admin.operating_hours.edit')->with(compact('operatingHour'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OperatingHour  $operatingHour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OperatingHour $operatingHour)
    {
        $operatingHour->update($request->except('_method', '_token'));
        return redirect()->route('admin.outlet.show', $request->outlet_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OperatingHour  $operatingHour
     * @return \Illuminate\Http\Response
     */
    public function destroy(OperatingHour $operatingHour)
    {
        //
    }
}
