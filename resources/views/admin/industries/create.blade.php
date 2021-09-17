<x-layout.backend>
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Info</h3>
            </div>
            <div class="block-content">
                {!! Form::open(['route' => 'admin.industry.store', 'method' => 'post', 'files' => true]) !!}
                @include('admin.industries.form')
                <x-forms.button/>
            </div>
        </div>
    </div>
</x-layout.backend>