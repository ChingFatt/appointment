@extends('layouts.backend')

@section('title', 'Create New Industry')

@section('form')
    {!! Form::open(['route' => 'admin.industry.store', 'method' => 'post', 'files' => true]) !!}
@endsection

@section('content')
    @include('admin.industries.form')
@endsection