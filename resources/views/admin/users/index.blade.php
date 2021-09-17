@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
@endsection

<x-layout.backend>
    <div class="content">
        <!-- Dynamic Table Full -->
        <div class="block block-rounded">
            <div class="block-header">
                <h3 class="block-title">Listing</h3>
                @role('admin')
                <x-btn type="create" :url="route('admin.user.create')"/>
                @endrole
            </div>
            <div class="block-content block-content-full table-responsive">
                <table class="table table-borderless table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th class="actions">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td class="d-sm-table-cell">{{ $user->name }}</td>
                            <td class="d-sm-table-cell">{{ $user->email }}</td>
                            <td class="d-sm-table-cell">
                                @foreach ($user->getRoleNames() as $role)
                                <span class="bg-body-dark text-secondary font-size-sm font-w600 px-2 py-1 rounded">
                                    {{ $role }}
                                </span>
                                @endforeach
                            </td>
                            <td>
                                @role('admin')
                                <x-btn type="edit" :url="route('admin.user.edit', $user)"/>
                                @canBeImpersonated($user, $guard = null)
                                <x-btn type="impersonate" :url="route('admin.impersonate', $user)"/>
                                @endCanBeImpersonated
                                @endrole
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <x-pagination :model="$users"/>
            </div>
        </div>
    </div>
</x-layout.backend>