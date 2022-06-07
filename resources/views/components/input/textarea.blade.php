@props([
    'name' => null
])

{{ Form::textarea($name, 
    null, [
        'class'             => 'js-maxlength form-control', 
        'required'          => false, 
        'autocomplete'      => 'off', 
        'rows'              => 3, 
        'maxlength'         => 255, 
        'data-always-show'  => 'true', 
        'data-placement'    => 'top'
    ]
) }}
<small class="form-text text-muted">
    255 Character Max
</small>

@once
@push('scripts')
    <script src="{{ asset('js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
@endpush
@endonce