@props([
    'route' => null,
    'redirect' => null
])

<button
    {{ $attributes }}
    class="btn btn-sm btn-alt-danger ml-1"
    data-toggle="tooltip"
    data-placement="top"
    title="Delete"
    id="delete"
    wire:ignore
>
    <i class="far fa-trash-alt"></i>
</button>

@once
@push ('scripts')
<script src="{{ asset('js/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
{{-- <script>
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-alt-success',
            cancelButton: 'btn btn-alt-danger ml-2'
        },
        buttonsStyling: false
    })

    window.addEventListener('sweetalert', event => {
        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            reverseButtons: false
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit('sweetalert.confirmed')
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your data is safe :)',
                    'error'
                )
            }
        })
    });

    window.addEventListener('sweetalert.success', event => {
        swalWithBootstrapButtons.fire(
            'Deleted!',
            'Your data has been deleted.',
            'success'
        )
    });
</script> --}}
<script>
    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-alt-success',
            cancelButton: 'btn btn-alt-danger ml-2'
        },
        buttonsStyling: false
    })

    jQuery('#delete').click(function() {
        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            reverseButtons: false
        }).then((result) => {
            if (result.isConfirmed) {
                jQuery.ajax({
                    type : "POST",
                    data : {'_method' : 'DELETE'},
                    url: "{{ $route }}",
                    success: function () {
                        swalWithBootstrapButtons.fire(
                            'Deleted!',
                            'Your data has been deleted.',
                            'success'
                        )
                        setTimeout(function () {
                            window.location.href = "{{ $redirect }}";
                        }, 5000);
                    }         
                });
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
                ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your data is safe :)',
                    'error'
                )
            }
        })
    });
</script>
@endpush
@endonce