<table {{ $attributes->merge(['class' => 'table table-borderless table-striped table-vcenter'])->only('class') }}>
    <thead>
        <tr>
            {{ $head }}
        </tr>
    </thead>

    <tbody>
        {{ $body }}
    </tbody>
</table>