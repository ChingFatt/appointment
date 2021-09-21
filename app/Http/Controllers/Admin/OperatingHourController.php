<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OperatingHour;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Rinvex\Country\Models\Country;
use Auth;

class OperatingHourController extends Controller
{
    public function __construct()
    {
        //$this->authorizeResource(OperatingHour::class, 'operating_hour');
    }

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
    public function create(Outlet $outlet)
    {
        if (Auth::user()->hasRole('admin') || (Auth::user()->merchant->outlets->contains($outlet->id))) {
            $countries = collect(countries())->pluck('name', 'iso_3166_1_alpha2');
            return view('admin.operating_hours.create')->with(compact('countries', 'outlet'));
        } else {
            abort(403);
        }
        
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
        //dd($operatingHour->outlet->id);
        //dd(Auth::user()->merchant->outlets);
        //dd(Auth::user()->merchant->outlets->contains($operatingHour->outlet->id));
        $years[date('Y')] = date('Y');

        for ($x = 1; $x < 5; $x++) {
            $loop_year = date("Y", strtotime("+ ".$x." year"));
            $years[$loop_year] = $loop_year;
        }

        $public_holidays = $operatingHour->public_holidays;
        //dd($operatingHour->other_holidays);
        $countries = collect(countries())->pluck('name', 'iso_3166_1_alpha2');
        return view('admin.operating_hours.edit')->with(compact('operatingHour', 'countries', 'years', 'public_holidays'));
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
        //dd($request);
        if (isset($request->public_holidays)) {
            $public_holidays = [];
            $holidays = $request->public_holidays;

            foreach ($holidays as $date => $holiday) {
                $ph     = (empty($holiday['ph'])) ? false : true;
                $eve    = (empty($holiday['eve'])) ? false : true;

                $date = date('Y-m-d', strtotime($date));

                $public_holidays[$date] = [
                    'name'  => $holiday['name'],
                    'ph'    => $ph,
                    'eve'   => $eve
                ];
            }

            //dd($public_holidays);

            $request->merge([
                'public_holidays' => collect($public_holidays)->toArray()
            ]);
        }

        if (isset($request->other_holidays)) {
            $other_holidays = [];
            $holidays = $request->other_holidays;

            foreach ($holidays as $holiday) {
                $ph     = (empty($holiday['ph'])) ? false : true;
                $eve    = (empty($holiday['eve'])) ? false : true;

                $date = date('Y-m-d', strtotime($holiday['date']));

                $other_holidays[$date] = [
                    'name'  => $holiday['name'],
                    'ph'    => $ph,
                    'eve'   => $eve
                ];
            }

            $request->merge([
                'other_holidays' => collect($other_holidays)->toArray()
            ]);
        } else {
             $request->merge([
                'other_holidays' => null
            ]);
        }

        $request->merge([
            'operating_hours' => collect($request->operating_hours)->toArray()
        ]);
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
