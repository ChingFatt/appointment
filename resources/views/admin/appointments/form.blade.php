@php
    $route = Route::currentRouteAction();
    $action = substr($route, strpos($route, '@') + 1);
@endphp

@if ($action == 'edit')
    {!! Form::model($appointment, ['route' => ['admin.appointment.update', $appointment], 'method' => 'put', 'files' => true]) !!}
@else
    {!! Form::open(['route' => 'admin.appointment.store', 'method' => 'post', 'files' => true, 'class' => 'js-validation']) !!}
@endif

<div class="row justify-content-center">
    <div class="col-md-12 col-lg-12">
        <div class="form-group">
            <label for="status">Status</label>
            <x-input.select2 name="status" :model="$appointment" :options="App\Models\Appointment::STATUSES"/>
        </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-12 col-lg-12">
        <p class="alert alert-info font-size-sm">
            <i class="fa fa-fw fa-info mr-1"></i> This remarks will not be displayed to the customer.
        </p>
        <div class="form-group">
            <label for="one-ecom-customer-note">Remarks</label>
            <x-input.textarea name="remarks" :model="$appointment"/>
        </div>
    </div>
</div>
<x-forms.button/>