@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
@endsection

@yield('form')
<div class="content">
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Info</h3>
        </div>
        <div class="block-content">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div class="form-group">
                        <label for="name">Name</label>
                        {{ Form::text('name', 
                            null, [
                                'class'         => 'form-control', 
                                'required'      => true, 
                                'autocomplete'  => 'off'
                            ]
                        ) }}
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        {{ Form::textarea('description', 
                            null, [
                                'class'             => 'js-maxlength form-control', 
                                'required'          => true, 
                                'autocomplete'      => 'off', 
                                'rows'              => 4, 
                                'maxlength'         => 255, 
                                'data-always-show'  => 'true', 
                                'data-placement'    => 'top'
                            ]
                        ) }}
                        <small class="form-text text-muted">
                            255 Character Max
                        </small>
                    </div>
                    <div class="form-group">
                        {!! Form::btnSave() !!}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>