<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Rinvex\Country\Models\Country;

class OutletController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Outlet::class, 'outlet');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outlets = Outlet::with('merchant')->latest()->get();
        return view('admin.outlets.index')->with(compact('outlets'));
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
        if (isset($request->service_codes)) {
            $service_codes = Service::whereIn('service_code', $request->service_codes)->pluck('name', 'service_code')->toArray();
            $request->merge([
                'service_codes' => $service_codes
            ]);
        }
        
        $request->merge([
            'is_publish' => ($request->is_publish) ? $request->is_publish : 0
        ]);

        $outlet = Outlet::create($request->all());
        $this->outlet_code($outlet); 

        return redirect()->route('admin.merchant.show', $request->merchant_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function show(Outlet $outlet)
    {
        $countries = collect(countries())->pluck('name', 'iso_3166_1_alpha2');
        $picker = collect();

        if (isset($outlet->operating_hour)) {
            $operating_hours = $outlet->operating_hour->operating_hours;
            $picker->put('operating_hours', $operating_hours);
            $picker->put('interval', $outlet->operating_hour->interval);

            $daysOfWeekDisabled = [];

            foreach (collect($operating_hours)->toArray() as $day => $value) {
                if (empty($value['start_time'])) {
                    $daysOfWeekDisabled[] = date('w', strtotime($day));
                    $picker->put('daysOfWeekDisabled', $daysOfWeekDisabled);
                }
            }
        }

        $week = app('App\Models\OperatingHour')->week();
        $services = $outlet->merchant->services->pluck('name', 'service_code');
        $outlet_services = $outlet->services();
        return view('admin.outlets.show')->with(compact('outlet', 'services', 'outlet_services', 'picker', 'countries', 'week'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function edit(Outlet $outlet)
    {
        $services = $outlet->merchant->services->pluck('name', 'service_code');
        $selected = [];
        foreach ($outlet->services() as $code => $name) {
            $selected[] = $code;
        }
        //dd($selected);
        return view('admin.outlets.edit')->with(compact('outlet', 'services', 'selected'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outlet $outlet)
    {
        if (isset($request->service_codes)) {
            $service_codes = Service::whereIn('service_code', $request->service_codes)->pluck('name', 'service_code')->toArray();
            $request->merge([
                'service_codes' => $service_codes
            ]);
        }
        
        $request->merge([
            'is_publish' => ($request->is_publish) ? $request->is_publish : 0
        ]);

        $outlet->update($request->except('_method', '_token'));
        return redirect()->route('admin.outlet.show', $outlet);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outlet $outlet)
    {
        $outlet->delete();
        return redirect()->route('admin.outlet.index');
    }

    public function outlet_code($outlet)
    {
        $outlet_code = 'OUTLET'. sprintf('%04d', $outlet->id);

        $outlet->outlet_code = $outlet_code;
        $outlet->save();
    }

    public function getloation($query)
    {
        $response = Http::get('http://api.positionstack.com/v1/forward?access_key=cd507a242f62553f9369dda5f1cf09c2&query="'.$query.'"&limit=1');
        $location = $response->object()->data[0];
        return $location;
    }
}
