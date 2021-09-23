<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Appointment;
use App\Providers\RouteServiceProvider;

class AppointmentTest extends TestCase
{
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_appointment_page_can_be_rendered()
    {
        $response = $this->get('/MERCH00001');

        $response->assertStatus(200);
    }
}
