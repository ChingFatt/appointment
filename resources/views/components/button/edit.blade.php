@props([
    'route' => 'javascript:void(0)'
])

<a href="{{ $route }}"
    {{ $attributes }}
    class="btn btn-sm btn-alt-primary ml-1"
    data-toggle="tooltip"
    data-placement="top"
    title="Edit"
    wire:ignore
>
    <i class="si si-pencil"></i>
</a>