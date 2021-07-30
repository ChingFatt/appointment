@extends('layouts.backend')

@section('title', 'Create New Merchant')

@section('form')
    {!! Form::open(['route' => 'admin.merchant.store', 'method' => 'post', 'files' => true]) !!}
@endsection

@section('content')
<div class="content">
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Info</h3>
        </div>
        <div class="block-content">
            @include('admin.merchants.form')
        </div>
    </div>
</div>
@endsection