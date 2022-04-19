@props([
    'name' => null,
    'options' => [],
    'prepend' => false,
    'append' => false,
    'placeholder' => '',
    'selected' => null
])

<div wire:ignore>
    <div class="input-group">
        @if ($prepend)
        <div class="input-group-prepend">
            <span class="input-group-text">
                {{ $prepend }}
            </span>
        </div>
        @endif
        {{ Form::select($name, 
                $options,
                $selected, 
                [
                    $attributes->merge(['class' => 'form-control js-select2'])->only('class'),
                    'placeholder'       => $placeholder,
                    'data-placeholder'  => $placeholder,
                    $attributes
                ]
            )
        }}
        @if ($append)
        <div class="input-group-append">
            <span class="input-group-text">
                {{ $append }}
            </span>
        </div>
        @endif
    </div>
</div>

@once
@push ('styles')
<link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
@endpush

@push ('scripts')
<script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    window.addEventListener('select2', event => {
        jQuery('.js-select2').select2();
    })
</script>
@endpush
@endonce