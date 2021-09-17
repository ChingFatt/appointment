<th {{ $attributes->merge(['class' => (($sortable) ? 'sorting' : '')])->only('class') }}>
    {{ $slot }}
</th>