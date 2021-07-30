@extends('layouts.backend')

@section('form')
    {!! Form::model($industry, ['route' => ['admin.industry.update', $industry], 'method' => 'put', 'files' => true]) !!}
@endsection

@section('content')
    @include('admin.industries.form')
@endsection