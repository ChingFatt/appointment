<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Outlet;
use App\Models\Employee;
use App\Models\Service;

class Welcome extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $outlet;
    public $employees;
    public $services;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data      = $data;
        $this->outlet    = Outlet::findOrFail($this->data['outlet_id']);
        $this->employees = Employee::whereIn('id', $this->data['employee_id'])->get();
        $this->services  = Service::whereIn('id', $this->data['service_id'])->get();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.welcome')->subject('Welcome!');
    }
}
