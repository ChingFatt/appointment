<?php

namespace App\Http\Livewire;

use Livewire\Component;
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
    public $selectedIndustry = NULL;
    public $selectedMerchant = NULL;
    public $selectedOutlet = NULL;
    public $selectedService = NULL;

    public function mount()
    {
        $this->industries = Industry::pluck('name', 'id');
        $this->merchants = collect();
        $this->outlets = collect();
        $this->employees = collect();
        $this->services = collect();
    }

    public function render()
    {
        return view('livewire.appointment');
    }

    public function updatedselectedIndustry($industry)
    {
        if (!is_null($industry)) {
            $this->merchants = Merchant::where('industry_id', $industry)->pluck('name', 'id');
        }
    }

    public function updatedselectedMerchant($merchant)
    {
        if (!is_null($merchant)) {
            $this->services = Service::where('merchant_id', $merchant)->pluck('name', 'service_code');
        }
    }

    public function updatedselectedService($service)
    {
        if (!is_null($service)) {
            $this->outlets = Outlet::where('service_codes', 'like', '%'.$service.'%')->pluck('name', 'id');
        }
    }

    public function updatedselectedOutlet($outlet)
    {
        if (!is_null($outlet)) {
            $this->employees = Employee::where('outlet_id', $outlet)->pluck('name', 'id');
        }
    }

}
