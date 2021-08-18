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
    //public $selectedIndustry = NULL;
    //public $selectedMerchant = NULL;
    public $selectedOutlet = NULL;
    public $selectedService = NULL;
    public $selectedDate = NULL;
    public $pickedIndustry = NULL;

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
        $this->services = Service::where('merchant_id', $this->merchant->id)->get()->pluck('service_duration', 'id');
    }

    public function render()
    {
        return view('livewire.appointment');
    }

    //public function updatedselectedIndustry($industry)
    //{
    //    if (!is_null($industry)) {
    //        $this->merchants = Merchant::where('industry_id', $industry)->pluck('name', 'id');
    //    }
    //}

    //public function pickedIndustry($industry)
    //{
    //    if (!is_null($industry)) {
    //        $this->merchants = Merchant::where('industry_id', $industry)->pluck('name', 'id');
    //    }
    //}

    //public function updatedselectedMerchant($merchant)
    //{
    //    if (!is_null($merchant)) {
    //        $this->services = Service::where('merchant_id', $merchant)->pluck('name', 'id');
    //    }
    //}

    public function updatedselectedService($service)
    {
        $this->service_listing = Service::whereIn('id', $service)->get();
        $this->duration = 0;

        if (!is_null($service)) {
            foreach ($this->service_listing as $service) {
                $this->duration += $service->duration;
            }
            //$service = Service::findOrFail($service->id);
            //$this->outlets = Outlet::has('operating_hour')->where('service_codes', 'like', '%'.$service.'%')->pluck('name', 'id')->toArray();
            //$this->employees = Employee::where('service_codes', 'like', '%'.$service.'%')->pluck('name', 'id');
            //dd($duration);
            $this->dispatchBrowserEvent('updateDuration');
        }
    }

    public function updatedselectedOutlet($outlet)
    {
        $employees = [];
        $employees = Employee::where('outlet_id', $outlet)->get();
        
        $employee_listing = [];
        if (count($employees) > 0) {
            foreach ($employees as $employee) {
                $employee_listing[$employee->id]['id'] = $employee->id;
                $employee_listing[$employee->id]['text'] = $employee->name;
            }
        }
        $this->dispatchBrowserEvent('updateEmployee', ['employees' => array_values($employee_listing)]);

        $daysOfWeekDisabled = [];
        if (!is_null($outlet)) {
            $outlet = Outlet::findOrFail($outlet);

            if (isset($outlet->operating_hour)) {
                $operating_hours = $outlet->operating_hour->operating_hours;

                foreach ($operating_hours as $day => $value) {
                    if (empty($value['start_time']) && empty($value['start_time'])) {
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
            //array_push($reserved, $reserved[$time]);

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
            //dd(json_encode(array_values($reserved)));

            $this->dispatchBrowserEvent('updateTime', ['picker' => $picker]);
        }
    }

}
