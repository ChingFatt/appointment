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
                            'Your data has been deleted. Redirecting in 5 seconds ...',
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