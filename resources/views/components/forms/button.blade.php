@php
    $route = Route::currentRouteAction();
    $action = substr($route, strpos($route, '@') + 1);
@endphp
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="form-group">
            <div class="btn-group mr-2">
                <button type="submit" class="btn btn-alt-primary">Save</button>
            </div>
            <div class="btn-group">
                @if ($action == 'create' || $action == 'edit')
                <a href="{{ url()->previous() }}" class="btn btn-alt-secondary">Cancel</a>
                @else
                <button type="button" class="btn btn-alt-secondary mr-1" data-dismiss="modal">Cancel</button>
                @endif
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}