@extends('layouts.backend')

@section('js_after')
    <!-- Sweetalert2 JS Code -->
    <script src="{{ asset('js/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    
    @include('layouts.admin.sweetalert', ['route' => route('admin.employee.destroy', $employee), 'redirect' => route('admin.outlet.show', $employee->outlet_id)])
@endsection

@section('content')
<div class="content">
	<div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Details</h3>
            {!! Form::btnEdit(route('admin.employee.edit', $employee)) !!}
            {!! Form::btnDelete() !!}
        </div>
        <div class="block-content">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="example-text-input">Name</label>
                        <div>{{ $employee->name }}</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="example-text-input">Employee Code</label>
                        <div>{{ $employee->employee_code }}</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="example-text-input">Outlet Code</label>
                        <div><a href="{{ route('admin.outlet.show', $employee->outlet_id) }}">{{ $employee->outlet->outlet_code }}</a></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="example-text-input">Created</label>
                        <div>{{ $employee->created_at }}</div>
                    </div>
                </div>
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="example-text-input">Updated</label>
                        <div>{{ $employee->updated_at }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection