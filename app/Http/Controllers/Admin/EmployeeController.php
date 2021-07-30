<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Service;
use Illuminate\Http\Request;

class EmployeeController extends Controller
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
        //dd($request);

        $employee = Employee::create($request->all());
        $this->employee_code($employee); 

        return redirect()->route('admin.outlet.show', $request->outlet_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('admin.employees.show')->with(compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $services = $employee->outlet->services();
        $selected = [];
        foreach ($employee->services() as $code => $name) {
            $selected[] = $code;
        }
        return view('admin.employees.edit')->with(compact('employee', 'services', 'selected'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        if (isset($request->service_codes)) {
            $service_codes = Service::whereIn('service_code', $request->service_codes)->pluck('name', 'service_code')->toArray();
            $request->merge([
                'service_codes' => $service_codes
            ]);
        }

        $employee->update($request->except('_method', '_token'));
        return redirect()->route('admin.employee.show', $employee);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('admin.employee.index');
    }

    public function employee_code($employee)
    {
        $employee_code = 'EMPLOYEE'. sprintf('%03d', $employee->id);

        $employee->employee_code = $employee_code;
        $employee->save();
    }
}
