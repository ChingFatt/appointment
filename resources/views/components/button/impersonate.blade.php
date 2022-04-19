@props([
    'route' => 'javascript:void(0)'
])

<a href="{{ $route }}"
    {{ $attributes }}
    class="btn btn-sm btn-alt-warning ml-1"
    data-toggle="tooltip"
    data-placement="top"
    title="Impersonate"
    wire:ignore
>
    <i class="fa fa-user-cog"></i>
</a>