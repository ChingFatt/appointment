<x-layout.backend>
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header">
                <h3 class="block-title">Listing</h3>
                @role('admin')
                <x-btn type="create" :url="route('admin.merchant.create')"/>
                @endrole
            </div>
            <div class="block-content block-content-full">
                {{-- <div class="row">
                    <div class="col-lg-4 col-md-12">
                        {!! Form::open(['route' => 'admin.merchant.index', 'method' => 'get', 'files' => true]) !!}
                        <div class="form-group">
                            <div class="input-group">
                                {{ Form::text('search', 
                                    null, [
                                        'class'         => 'form-control', 
                                        'required'      => false, 
                                        'autocomplete'  => 'off'
                                    ]
                                ) }}
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-alt-primary">
                                        <i class="fa fa-search mr-1"></i> Search
                                    </button>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div> --}}
                <x-table>
                    <x-slot name="head">
                        <x-table.heading>ID</x-table.heading>
                        <x-table.heading sortable>@sortablelink('name')</x-table.heading>
                        <x-table.heading>Merchant Code</x-table.heading>
                        <x-table.heading>Industry</x-table.heading>
                        <x-table.heading>Status</x-table.heading>
                        <x-table.heading class="actions">Actions</x-table.heading>
                    </x-slot>

                    <x-slot name="body">
                        @foreach ($merchants as $merchant)
                        @can('view-any', $merchant)
                            <x-table.row>
                                <x-table.cell>{{ $merchant->id }}</x-table.cell>
                                <x-table.cell>{{ $merchant->name }}</x-table.cell>
                                <x-table.cell>{{ $merchant->merchant_code }}</x-table.cell>
                                <x-table.cell>{{ $merchant->industry->name }}</x-table.cell>
                                <x-table.cell>{!! $merchant->published !!}</x-table.cell>
                                <x-table.cell>
                                    <x-btn type="show" :url="route('admin.merchant.show', $merchant)"/>
                                    <x-btn type="edit" :url="route('admin.merchant.edit', $merchant)"/>
                                </x-table.cell>
                            </x-table.row>
                        @endcan
                        @endforeach
                    </x-slot>
                </x-table>
                <x-pagination :model="$merchants"/>
            </div>
        </div>
    </div>
</x-layout.backend>
