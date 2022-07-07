@props([
    'name' => null,
    'value' => null,
])

{{ Form::textarea($name, 
    $value, [
        'class'             => 'js-maxlength form-control', 
        'required'          => false, 
        'autocomplete'      => 'off', 
        'rows'              => 3, 
        'maxlength'         => 255, 
        'data-always-show'  => 'true', 
        'data-placement'    => 'top',
        $attributes
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