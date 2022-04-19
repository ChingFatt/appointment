@props([
    'route' => 'javascript:void(0)'
])

<a href="{{ $route }}"
    {{ $attributes }}
    class="btn btn-alt-success ml-1"
    data-toggle="tooltip"
    data-placement="top"
    title="Create"
    wire:ignore
>
    Create
</a>