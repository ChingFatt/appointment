@push('js_before')
    <script src="{{ asset('js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('js/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    @include('layouts.admin.sweetalert', ['route' => route('admin.appointment.destroy', $appointment), 'redirect' => route('admin.appointment.index')])
@endpush

<x-layout.backend>
    <div class="content">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Details</h3>
                        <x-btn type="index" :url="route('admin.appointment.index')"/>
                        <x-btn type="edit" :url="route('admin.appointment.edit', $appointment)"/>
                        @role('admin')
                        <x-btn type="delete"/>
                        @endrole
                    </div>
                    <div class="block-content block-content-full">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="example-text-input">Customer</label>
                                    <div>{{ $appointment->fullname ?? '' }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="example-text-input">Appointment No.</label>
                                    <div>{{ $appointment->appointment_no ?? '' }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="example-text-input">Gender</label>
                                    <div>{{ $appointment->gender ?? '' }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="example-text-input">Email</label>
                                    <div>{{ $appointment->email ?? '' }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="example-text-input">Phone</label>
                                    <div>{{ $appointment->phone ?? '' }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="example-text-input">Appointment Date</label>
                                    <div>{{ $appointment->date ?? '' }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="example-text-input">Preferred Time</label>
                                    <div>{{ $appointment->time ?? '' }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="example-text-input">Approximate End Time</label>
                                    <div>{{ $appointment->end_time ?? '' }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="example-text-input">Duration</label>
                                    <div>{{ $appointment->duration ?? '' }} minutes</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="example-text-input">Industry</label>
                                    <div>{{ $appointment->industry->name ?? '' }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="example-text-input">Merchant</label>
                                    <div>{{ $appointment->merchant->name ?? '' }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="example-text-input">Status</label>
                                    <div><span class="bg-{!! $appointment->status_color !!}-light text-{!! $appointment->status_color !!} font-size-sm font-w600 px-2 py-1 rounded">{{ $appointment->status }}</span></div>
                                </div>
                            </div>
                            @isset($appointment->action_by)
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="example-text-input">{{ $appointment->status }} By</label>
                                    <div>{{ $appointment->user->name ?? '' }}</div>
                                </div>
                            </div>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Preferred Employees</h3>
                    </div>
                    <div class="table-responsive block-content p-0">
                        <table class="table table-borderless table-striped table-vcenter block-table">
                            <tbody>
                                @foreach($preferred_employees as $service => $employee)
                                <tr>
                                   <td>{{ $service ?? '' }}</td>
                                   <td>
                                        {{ $employee ?? '' }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="block block-rounded">
                    <div class="block-content block-content-full alert alert-warning">
                        <div class="row justify-content-center">
                            <div class="col-md-12 col-lg-12">
                                <p class="font-size-sm">
                                    <i class="si fa-fw si-note mr-1"></i> Customer Remarks
                                </p>
                                <div class="font-weight-bold">
                                    {{ $appointment->comments }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block block-rounded">
                    <div class="block-content block-content-full alert alert-info">
                        <div class="row justify-content-center">
                            <div class="col-md-12 col-lg-12">
                                <p class="font-size-sm">
                                    <i class="si fa-fw si-info mr-1"></i> This remarks will not be displayed to the customer.
                                </p>
                                <div class="font-weight-bold">
                                    {{ $appointment->remarks }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="aside">
        <x-layout.admin.aside>
            <x-slot name="title">
                Appointments
            </x-slot>
            <x-slot name="label">
                {{ $appointment->date }}
            </x-slot>
            <x-slot name="indicator">
                ({{ count($appointments_aside) }})
            </x-slot>
            <x-slot name="content">
                @foreach ($appointments_aside as $appointment)
                <li>
                    <a class="appointment-aside text-dark media py-2 px-4{{ request()->is('admin/appointment/'.$appointment->id) ? ' active' : '' }}" href="{{ route('admin.appointment.show', $appointment) }}">
                        <div class="media-body">
                            <div class="font-size-sm font-w600">{{ $appointment->fullname }}</div>
                            <small class="font-size-sm text-muted">{{ $appointment->date }}</small>
                        </div>
                        <div><span class="bg-{!! $appointment->status_color !!}-light text-{!! $appointment->status_color !!} font-size-sm font-w600 px-2 py-1 rounded">{{ $appointment->status }}</span></div>
                    </a>
                </li>
                @endforeach
            </x-slot>
        </x-layout.admin.aside>
    </x-slot>
</x-layout.backend>