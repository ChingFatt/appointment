<?php

namespace App\View\Components\Layout\Admin;

use Illuminate\View\Component;
use App\Models\Appointment;

class Header extends Component
{
    public $appointments;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->appointments = Appointment::count();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layout.admin.header');
    }
}
