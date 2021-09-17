<x-layout.backend>
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header">
                <h3 class="block-title">Listing</h3>
                <x-btn type="create" :url="route('admin.industry.create')"/>
            </div>
            <div class="block-content block-content-full">
                <x-table>
                    <x-slot name="head">
                        <x-table.heading>ID</x-table.heading>
                        <x-table.heading sortable>Name</x-table.heading>
                        <x-table.heading>Created</x-table.heading>
                        <x-table.heading>Updated</x-table.heading>
                        <x-table.heading class="actions">Actions</x-table.heading>
                    </x-slot>

                    <x-slot name="body">
                        @foreach ($industries as $industry)
                            <x-table.row>
                                <x-table.cell>{{ $industry->id }}</x-table.cell>
                                <x-table.cell>{{ $industry->name }}</x-table.cell>
                                <x-table.cell>{{ $industry->created_at }}</x-table.cell>
                                <x-table.cell>{{ $industry->updated_at }}</x-table.cell>
                                <x-table.cell>
                                    <x-btn type="show" :url="route('admin.industry.show', $industry)"/>
                                    <x-btn type="edit" :url="route('admin.industry.edit', $industry)"/>
                                </x-table.cell>
                            </x-table.row>
                        @endforeach
                    </x-slot>
                </x-table>
                <x-pagination :model="$industries"/>
            </div>
        </div>
    </div>
</x-layout.backend>
