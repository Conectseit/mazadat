<script>
    $(function () {
        let incrementVal = {{($auction->value_of_increment)}};
        let current_price = {{($auction->current_price)}};
        $("#minuss").click(function () {
            var $input = $(this).parent().find("#bidInput");
            var count = parseInt($input.val()) - incrementVal;
            count = count < current_price ? current_price : count;
            $input.val(count);
            $input.change();
            return false;
        });
        $("#pluss").click(function () {
            var $input = $(this).parent().find("#bidInput");
            $input.val(parseInt($input.val()) + incrementVal);
            $input.change();
            return false;
        });


// ============= for accept conditions====================
        $('a#change-terms-value').on('click', function (e) {
            e.preventDefault();
            let checkBox = $('#accept-terms');
            $.ajax({
                method: 'GET',
                url: '{{ route('front.accept_auction_terms_person',$auction->id) }}',
                success: res => {
                    if(res.is_accepted) {
                        checkBox.prop('checked', true);
                    } else {
                        checkBox.prop('checked', false);
                    }
                },
                error: err => console.log(err),
            });
        });
 });
</script>



<script>
    $('a.delete-report-file').on('click', function (e) {
        var id = $(this).data('id');
        var tbody = $('table#inspection_report_images tbody');
        var count = tbody.data('count');

        e.preventDefault();

        swal({
            title: "هل انت متأكد من حذف هذه الفايل ",
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
                        url: '{{ route('front.ajax-delete-auction-file-person') }}',
                        data: {id: id, "_token": "{{ csrf_token() }}",},
                        success: function (response) {
                            if (response.deleteStatus) {
                                // $('#post-row-'+id).fadeOut(); count = count - 1;tbody.attr('data-count', count);
                                $('#inspection_report_image-row-' + id).remove();
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
