@extends('layouts.backend')

@section('js_after')
<script src="{{ asset('js/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('js/plugins/chart.js/Chart.bundle.min.js') }}"></script>

<script src="{{ asset('js/pages/be_pages_dashboard.min.js') }}"></script>
@endsection

@section('content')
@livewireStyles
@livewire('admin.dashboard')
@livewireScripts
@endsection