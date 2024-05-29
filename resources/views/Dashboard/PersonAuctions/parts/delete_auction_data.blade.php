{{--<script>--}}
{{--    // delete auction one auction image--}}
{{--    $('a.delete-action').on('click', function (e) {--}}
{{--        var id = $(this).data('id');--}}
{{--        var tbody = $('table#images tbody');--}}
{{--        var count = tbody.data('count');--}}

{{--        e.preventDefault();--}}

{{--        swal({--}}
{{--            title: "هل انت متأكد من حذف هذه الصورة ",--}}
{{--            // text: "سيتم الحذف بالانتقال لسلة المهملات",--}}
{{--            icon: "warning",--}}
{{--            buttons: true,--}}
{{--            dangerMode: true,--}}
{{--        })--}}
{{--            .then((willDelete) => {--}}
{{--                if (willDelete) {--}}
{{--                    var tbody = $('table#postimages tbody');--}}
{{--                    var count = tbody.data('count');--}}

{{--                    $.ajax({--}}
{{--                        type: 'POST',--}}
{{--                        url: '{{ route('ajax-delete-image') }}',--}}
{{--                        data: {id: id},--}}
{{--                        success: function (response) {--}}
{{--                            if (response.deleteStatus) {--}}
{{--                                // $('#post-row-'+id).fadeOut(); count = count - 1;tbody.attr('data-count', count);--}}
{{--                                $('#image-row-' + id).remove();--}}
{{--                                count = count - 1;--}}
{{--                                tbody.attr('data-count', count);--}}
{{--                                swal(response.message, {icon: "success"});--}}
{{--                            } else {--}}
{{--                                swal(response.error);--}}
{{--                            }--}}
{{--                        },--}}
{{--                        error: function (x) {--}}
{{--                            crud_handle_server_errors(x);--}}
{{--                        },--}}
{{--                        complete: function () {--}}
{{--                            if (count == 1) tbody.append(`<tr><td colspan="5"><strong>No data available in table</strong></td></tr>`);--}}
{{--                        }--}}
{{--                    });--}}
{{--                } else {--}}
{{--                    swal("تم الغاء العمليه");--}}
{{--                }--}}
{{--            });--}}
{{--    });--}}


{{--    // delete auction option_detail--}}
{{--    $('a.delete-action').on('click', function (e) {--}}
{{--        var id = $(this).data('id');--}}
{{--        var tbody = $('table#auction_option_details tbody');--}}
{{--        var count = tbody.data('count');--}}

{{--        e.preventDefault();--}}

{{--        swal({--}}
{{--            title: "هل انت متأكد من حذف هذه التصنيف ",--}}
{{--            icon: "warning",--}}
{{--            buttons: true,--}}
{{--            dangerMode: true,--}}
{{--        })--}}
{{--            .then((willDelete) => {--}}
{{--                if (willDelete) {--}}
{{--                    var tbody = $('table#auction_option_details tbody');--}}
{{--                    var count = tbody.data('count');--}}

{{--                    $.ajax({--}}
{{--                        type: 'POST',--}}
{{--                        url: '{{ route('ajax-delete-auction_data') }}',--}}
{{--                        data: {id: id},--}}
{{--                        success: function (response) {--}}
{{--                            if (response.deleteStatus) {--}}
{{--                                // $('#post-row-'+id).fadeOut(); count = count - 1;tbody.attr('data-count', count);--}}
{{--                                $('#auction_option_detail-row-' + id).remove();--}}
{{--                                count = count - 1;--}}
{{--                                tbody.attr('data-count', count);--}}
{{--                                swal(response.message, {icon: "success"});--}}
{{--                            } else {--}}
{{--                                swal(response.error);--}}
{{--                            }--}}
{{--                        },--}}
{{--                        error: function (x) {--}}
{{--                            crud_handle_server_errors(x);--}}
{{--                        },--}}
{{--                        complete: function () {--}}
{{--                            if (count == 1) tbody.append(`<tr><td colspan="5"><strong>No data available in table</strong></td></tr>`);--}}
{{--                        }--}}
{{--                    });--}}
{{--                } else {--}}
{{--                    swal("تم الغاء العمليه");--}}
{{--                }--}}
{{--            });--}}
{{--    });--}}

{{--</script>--}}
