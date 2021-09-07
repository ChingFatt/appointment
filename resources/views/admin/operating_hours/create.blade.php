@extends('layouts.backend')

@section('form')
    {!! Form::open(['route' => 'admin.operating_hour.store', 'method' => 'post', 'files' => true]) !!}
@endsection

@section('content')
<div class="content">
    @include('admin.operating_hours.form')
</div>
@endsection