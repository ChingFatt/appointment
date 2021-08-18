<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('appointment_no')->nullable();
            $table->string('fullname');
            $table->string('phone');
            $table->string('email');
            $table->string('gender')->nullable();
            $table->foreignId('industry_id');
            $table->foreignId('merchant_id');
            $table->json('service_id');
            $table->foreignId('outlet_id');
            $table->foreignId('employee_id');
            $table->string('date');
            $table->string('time');
            $table->string('end_time')->nullable();
            $table->string('duration')->nullable();
            $table->string('comments')->nullable();
            $table->string('status');
            $table->foreignId('action_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
