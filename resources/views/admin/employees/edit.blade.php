@extends('layouts.backend')

@section('form')
    {!! Form::model($employee, ['route' => ['admin.employee.update', $employee], 'method' => 'put', 'files' => true]) !!}
@endsection

@section('content')
<div class="content">
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Info</h3>
        </div>
        <div class="block-content">
            @include('admin.employees.form')
        </div>
    </div>
</div>
@endsection