<x-layout.backend>
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header">
                <h3 class="block-title">Listing</h3>
                @role('admin|merchant')
                <x-button.create route="{{ route('admin.user.create') }}"/>
                @endrole
            </div>
            <div class="block-content block-content-full table-responsive">
                <x-table class="js-datatable">
                    <x-slot name="head">
                        <x-table.heading>ID</x-table.heading>
                        <x-table.heading>Name</x-table.heading>
                        <x-table.heading>Email</x-table.heading>
                        <x-table.heading>Roles</x-table.heading>
                        <x-table.heading class="actions">Actions</x-table.heading>
                    </x-slot>

                    <x-slot name="body">
                        @foreach ($users as $user)
                        @can('view-any', $user)
                            <x-table.row>
                                <x-table.cell>{{ $user->id }}</x-table.cell>
                                <x-table.cell>{{ $user->name }}</x-table.cell>
                                <x-table.cell>{{ $user->email }}</x-table.cell>
                                <x-table.cell>
                                    @foreach ($user->getRoleNames() as $role)
                                    <span class="bg-body-dark text-secondary font-size-sm font-w600 px-2 py-1 rounded">
                                        {{ $role }}
                                    </span>
                                    @endforeach
                                </x-table.cell>
                                <x-table.cell>
                                    @role('admin|merchant')
                                    <x-button.edit route="{{ route('admin.user.edit', $user) }}"/>
                                    @endrole
                                    @role('admin')
                                    @canBeImpersonated($user, $guard = null)
                                    <x-button.impersonate route="{{ route('admin.impersonate', $user) }}"/>
                                    @endCanBeImpersonated
                                    @endrole
                                </x-table.cell>
                            </x-table.row>
                        @endcan
                        @endforeach
                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>
</x-layout.backend>