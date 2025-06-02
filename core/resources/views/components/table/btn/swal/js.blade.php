<script>
    (function($) {
        "use strict"
        $(document).ready(function() {
            $(document).on('click', '.swal-delete', function() {
                Swal.fire({
                    title: '{{ __('Are you sure?') }}',
                    text: '{{ __('This action cannot be undone.') }}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ee0000',
                    cancelButtonColor: '#55545b',
                    confirmButtonText: '{{ __('Yes, delete it!') }}',
                    cancelButtonText: "{{ __('No') }}"
                }).then((result) => {
                    if (result.isConfirmed) {
                        let route = $(this).data('route');
                        $.post(route, {
                            _token: '{{ csrf_token() }}'
                        }).then(function(data) {
                            if (data) {
                                Swal.fire('Deleted!', '', 'success');
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            }
                        });
                    }
                });
            });
        });
    })(jQuery)
</script>
