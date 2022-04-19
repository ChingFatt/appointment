@props([
    'route' => 'javascript:void(0)'
])

<a href="{{ $route }}"
    {{ $attributes }}
    class="btn btn-sm btn-alt-info ml-1"
    data-toggle="tooltip"
    data-placement="top"
    title="Listing"
    wire:ignore
>
    <i class="fa fa-list-ul"></i>
</a>