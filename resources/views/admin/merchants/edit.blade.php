@extends('layouts.backend')

@section('form')
    {!! Form::model($merchant, ['route' => ['admin.merchant.update', $merchant], 'method' => 'put', 'files' => true]) !!}
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