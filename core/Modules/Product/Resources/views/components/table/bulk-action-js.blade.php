<script>
    $(document).on('click', '#bulk_delete_btn', function(e) {
        e.preventDefault();

        var bulkOption = $('#bulk_option').val();
        var isAdminOrVendor = $('#isAdminOrVendor').val();
        var allCheckbox = $('.bulk-checkbox:checked');
        var allIds = [];

        allCheckbox.each(function(index, value) {
            allIds.push($(this).val());
        });

        if (allIds != '' && bulkOption == 'delete') {
            $(this).html('<i class="fas fa-spinner fa-spin mr-1"></i>{{ __('Deleting') }}');
            $.ajax({
                'type': "POST",
                'url': "{{ $url }}",
                'data': {
                    _token: "{{ csrf_token() }}",
                    ids: allIds
                },
                success: function(data) {
                    toastr.success('Products deleted successfully');
                    setTimeout(() => {
                        location.reload();
                    }, 1000)
                }
            });
        }

        if (isAdminOrVendor && isAdminOrVendor == 1) {
            var actionUrl = "{{ route('admin.products.bulk.action') }}";
        } else {
            var actionUrl = "{{ route('vendor.products.bulk.action') }}";
        }

        if (allIds != '' && (bulkOption == 'active' || bulkOption == 'inactive')) {
            $(this).html('<i class="fas fa-spinner fa-spin mr-1"></i>{{ __('Updateing') }}');
            $.ajax({
                'type': "POST",
                'url': actionUrl,
                'data': {
                    _token: "{{ csrf_token() }}",
                    ids: allIds,
                    status: bulkOption
                },
                success: function(data) {

                    if (data.status == true) {

                        toastr.success('Products updated successfully');

                        setTimeout(() => {
                            location.reload();
                        }, 1000)

                    }
                }
            });
        }
    });

    $(document).on('change', '.all-checkbox', function(e) {
        e.preventDefault();
        var value = $('.all-checkbox').is(':checked');
        var allChek = $(this).parent().parent().parent().parent().parent().find('.bulk-checkbox');
        if (value == true) {
            allChek.prop('checked', true);
        } else {
            allChek.prop('checked', false);
        }
    });
</script>
