@extends('layouts.backend')

@section('js_after')
    <!-- Sweetalert2 JS Code -->
    <script src="{{ asset('js/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    
    @include('layouts.admin.sweetalert', ['route' => route('admin.service.destroy', $service), 'redirect' => route('admin.merchant.show', $service->merchant->id)])
@endsection

@section('content')
<div class="content">
	<div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Details</h3>
            {!! Form::btnEdit(route('admin.service.edit', $service)) !!}
            {!! Form::btnDelete() !!}
        </div>
        <div class="block-content">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="example-text-input">Name</label>
                        <div>{{ $service->name }}</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="example-text-input">Service Code</label>
                        <div>{{ $service->service_code }}</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="example-text-input">Merchant</label>
                        <div><a href="{{ route('admin.merchant.show', $service->merchant->id) }}">{{ $service->merchant->merchant_code }}</a></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="example-text-input">Created</label>
                        <div>{{ $service->created_at }}</div>
                    </div>
                </div>
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="example-text-input">Updated</label>
                        <div>{{ $service->updated_at }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection