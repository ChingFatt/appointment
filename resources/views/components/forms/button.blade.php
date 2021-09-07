<div>
    @php
        $route = Route::currentRouteAction();
        $action = substr($route, strpos($route, '@') + 1);
    @endphp
    @if ($action == 'create' || $action == 'edit')
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="form-group">
                    {!! Form::btnSave() !!}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    @endif
</div>