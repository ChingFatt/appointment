<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Appointment as Appoint;
use App\Models\Industry;
use App\Models\Merchant;
use App\Models\Outlet;
use App\Models\Employee;
use App\Models\Service;

class Appointment extends Component
{
    public $industries;
    public $merchants;
    public $outlets;
    public $employees;
    public $services;
    public $duration;
    public $service_listing;

    public $selectedDay = NULL;
    public $selectedOutlet = NULL;
    public $selectedService = NULL;
    public $selectedDate = NULL;
    public $pickedIndustry = NULL;
    public $selectedEmployee = NULL;

    public $fullname;
    public $phone;
    public $email;
    public $merchant;

    protected $listeners = ['selectedDate'];

    protected $rules = [
        'fullname' => 'required|min:2',
        'phone' => 'required',
        'email' => 'required|email',
    ];

    public function submit()
    {
        $this->validate();
        dd($this);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount($merchant)
    {
        $this->merchant = Merchant::where('merchant_code', $merchant)->first();
        $this->industries = Industry::pluck('name', 'id');
        $this->merchants = collect();
        $this->outlets = Outlet::has('operating_hour')->where('merchant_id', $this->merchant->id)->get()->pluck('name', 'id')->toArray();
        $this->employees = collect();
        $this->services = collect();
    }

    public function render()
    {
        return view('livewire.appointment');
    }

    public function updatedsselectedEmployee($employee)
    {
        dd($employee);
    }

    public function updatedselectedService($service)
    {
        $this->service_listing = Service::whereIn('id', $service)->get();
        $this->duration = 0;

        if (!is_null($service)) {
            $employees = [];
            foreach ($this->service_listing as $service) {
                $this->duration += $service->duration;
                $employee = Employee::where('service_codes', 'like', '%'.$service->service_code.'%')->get();
                $employees[$service->name] = $employee ?? '';
            }
            $this->dispatchBrowserEvent('updateDuration');
            
            $employee_listing = [];
            if (count($employees) > 0) {
                foreach ($employees as $service_name => $staff) {
                    if (count($staff) > 0) {
                        foreach ($staff as $employee) {
                            $employee_listing[$service_name][$employee->id] = $employee->name;
                            //$employee_listing[$service_name][$employee->id]['id'] = $employee->id;
                            //$employee_listing[$service_name][$employee->id]['text'] = $employee->name;
                        }
                    } else {
                        $employee_listing[$service_name][0] = 'Anyone';
                    }
                }
            }
            $this->employees = $employee_listing;
            $this->dispatchBrowserEvent('updateEmployee');
        }
    }

    public function updatedselectedOutlet($outlet)
    {
        $daysOfWeekDisabled = [];
        if (!is_null($outlet)) {
            $outlet = Outlet::findOrFail($outlet);

            $services = [];
            $services = $outlet->services();
            
            $services_array = [];
            foreach ($services as $code => $name) {
                $services_array[] = $code;
            }

            $new_services = Service::whereIn('service_code', $services_array)->get();

            $service_listing = [];
            if (count($new_services) > 0) {
                foreach ($new_services as $service) {
                    $service_listing[$service->id]['id'] = $service->id;
                    $service_listing[$service->id]['text'] = $service->name;
                    //$service_listing[$service->id] = $service->name;
                }
            }
            $this->services = $service_listing;
            $this->dispatchBrowserEvent('updateService', ['services' => array_values($service_listing)]);

            if (isset($outlet->operating_hour)) {
                $operating_hours = $outlet->operating_hour->operating_hours;
                $week = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
                foreach ($operating_hours as $day => $value) {
                    if (empty($value['start_time']) && empty($value['end_time']) && in_array($day, $week)) {
                        $daysOfWeekDisabled[] = date('w', strtotime($day));
                    }
                }
            }
            $this->dispatchBrowserEvent('updateCalendar', ['daysOfWeekDisabled' => $daysOfWeekDisabled]);
        }
    }

    public function updatedselectedDate($data)
    {
        //$data[0] = date
        //$data[1] = outlet_id

        $picker = collect();
        if (!is_null($data)) {
            $outlet = Outlet::findOrFail($data[1]);
            $appointments = Appoint::where('outlet_id', $data[1])
            ->where('date', $data[0])
            ->whereIn('status', ['Pending', 'Scheduled'])
            ->get();
            
            $reserved = [];
            foreach ($appointments->groupBy('time') as $time => $appointment) {
                if (count($appointment) >= $outlet->operating_hour->capacity) {
                    $reserved[$time] = array($time, date('H:ia', strtotime($time) + 60));
                }
            }

            if (isset($outlet->operating_hour)) {
                $operating_hours = $outlet->operating_hour->operating_hours;
                $picker->put('operating_hours', $outlet->operating_hour->operating_hours);
                $interval = $outlet->operating_hour->interval ?? 30;
                $picker->put('interval', $interval);

                foreach ($operating_hours as $day => $value) {
                    if (isset($value['start_time']) && $day == date('l', strtotime($data[0]))) {
                        $picker->put('start_time', $value['start_time']);
                        $picker->put('end_time', date('H:ia', strtotime($value['end_time']) - ($outlet->operating_hour->interval * 60)));
                    }

                    if (isset($value['rest_start_time']) && isset($value['rest_end_time']) && $day == date('l', strtotime($data[0]))) {
                        $picker->put('rest_start_time', $value['rest_start_time']);
                        $picker->put('rest_end_time', $value['rest_end_time']);

                        array_push($reserved, array($value['rest_start_time'], $value['rest_end_time']));
                    }
                }
            }
            $picker->put('reserved', array_values($reserved));
            $this->dispatchBrowserEvent('updateTime', ['picker' => $picker]);
        }
    }

}
