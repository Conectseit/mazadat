
<script>

    // ========= get_options_by_category_id =====
    $("#category").change(function (e) {
        e.preventDefault();
        var category_id = $(this).val();
        let _token = '{{ csrf_token() }}';
        //console.log(category_id);
        if (category_id) {
            $.ajax({
                url: "{{ route('ajax_get_options_by_category_id') }}",
                type: 'POST',
                data: {category_id, _token},
                success: function (response) {
                    if (response.status == 1) {
                        //console.log(data);
                        $("#options").empty();
                        $("#options").append('<option value="">اختر </option>');
                        $.each(response.options, function (index, option) {
                            console.log(option);
                            $("#options").append('<option value="' + option.id + '">' + option.name_ar + '</option>');
                        });
                    }
                },
                error: function (jqXhr, textStatus, errorMessage) {
                    alert(errorMessage);
                }
            });
        } else {
            $("#options").empty();
            $("#options").append('<option value="">اختر </option>');
        }
    });




    // ===== get_option_details_by_option_id ===========
    $("#options").change(function (e) {
        e.preventDefault();
        var option_id = $(this).val();
        let _token = '{{ csrf_token() }}';
        //console.log(option_id);
        if (option_id) {
            $.ajax({
                url: "{{ route('ajax_get_option_details_by_option_id') }}",
                type: 'POST',
                data: {option_id, _token},
                success: function (response) {
                    if (response.status == 1) {
                        //console.log(data);
                        $("#option_details").empty();
                        $("#option_details").append('<option value="">اختر </option>');
                        $.each(response.option_details, function (index, option) {
                            console.log(option);
                            $("#option_details").append('<option value="' + option.id + '">' + option.value_ar + '</option>');
                        });
                    }
                },
                error: function (jqXhr, textStatus, errorMessage) {
                    alert(errorMessage);
                }
            });
        } else {
            $("#option_details").empty();
            $("#option_details").append('<option value="">اختر </option>');
        }
    });
</script>




{{--    @include('Dashboard.Auctions.delete_auction_data')--}}
{{-- delete auction one auction image--}}
<script>
    $('a.delete-action').on('click', function (e) {
        var id = $(this).data('id');
        var tbody = $('table#images tbody');
        var count = tbody.data('count');

        e.preventDefault();

        swal({
            title: "هل انت متأكد من حذف هذه الصورة ",
            // text: "سيتم الحذف بالانتقال لسلة المهملات",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    var tbody = $('table#auctionimages tbody');
                    var count = tbody.data('count');

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('ajax-delete-image') }}',
                        data: {id: id},
                        success: function (response) {
                            if (response.deleteStatus) {
                                // $('#post-row-'+id).fadeOut(); count = count - 1;tbody.attr('data-count', count);
                                $('#image-row-' + id).remove();
                                count = count - 1;
                                tbody.attr('data-count', count);
                                swal(response.message, {icon: "success"});
                            } else {
                                swal(response.error);
                            }
                        },
                        error: function (x) {
                            crud_handle_server_errors(x);
                        },
                        complete: function () {
                            if (count == 1) tbody.append(`<tr><td colspan="5"><strong>No data available in table</strong></td></tr>`);
                        }
                    });
                } else {
                    swal("تم الغاء العمليه");
                }
            });
    });
</script>

{{-- delete auction option_detail--}}
<script>
    $(document).on('click', 'a.delete_auction_data', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var tbody = $('table#auction_option_details tbody');
        var count = tbody.data('count');

        swal({
            title: "هل انت متأكد من حذف هذه التصنيف ",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    var tbody = $('table#auction_option_details tbody');
                    var count = tbody.data('count');

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('ajax-delete-auction_data') }}',
                        data: {id: id},
                        success: function (response) {
                            if (response.deleteStatus) {
                                // $('#post-row-'+id).fadeOut(); count = count - 1;tbody.attr('data-count', count);
                                $('#auction_option_detail-row-' + id).remove();
                                count = count - 1;
                                tbody.attr('data-count', count);
                                swal(response.message, {icon: "success"});
                            } else {
                                swal(response.error);
                            }
                        },
                        error: function (x) {
                            crud_handle_server_errors(x);
                        },
                        complete: function () {
                            if (count === 1) tbody.append(`<tr><td colspan="5"><strong>No data available in table</strong></td></tr>`);
                        }
                    });
                } else {
                    swal("تم الغاء العمليه");
                }
            });
    });

</script>
