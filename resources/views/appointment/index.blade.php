@extends('layouts.main')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/js/plugins/jquery-timepicker/jquery.timepicker.min.css') }}">

    <link rel="stylesheet" href="{{ asset('/js/plugins/slick-carousel/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('/js/plugins/slick-carousel/slick-theme.css') }}">

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    
    <script src="{{ asset('/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/jquery-timepicker/jquery.timepicker.min.js') }}"></script>

    <script src="{{ asset('/js/plugins/jquery-timepicker/datepair.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/jquery-timepicker/jquery.datepair.min.js') }}"></script>

    <script src="{{ asset('/js/plugins/slick-carousel/slick.min.js') }}"></script>
@endsection

@section('content')
@livewireStyles
@livewire('appointment', ['merchant' => $merchant])
@livewireScripts
@endsection