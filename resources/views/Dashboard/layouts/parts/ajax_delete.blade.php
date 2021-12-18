<script>
    let modelTable = '{{ str()->plural($model) }}';
    let currentModel = '{{ $model }}';

    $('a.delete-action').on('click', function (e) {
        var id = $(this).data('id');
        var tbody = $('table#'+modelTable+' tbody');
        var count = tbody.data('count');

        e.preventDefault();

        swal({
            title: "{{ trans('messages.confirm-delete-message-var', ['var' => trans('messages.'.$model.'.'.$model)]) }}",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    var tbody = $('table#'+modelTable+' tbody');
                    var count = tbody.data('count');

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('ajax-delete-' . $model) }}',
                        {{--url: '{{ Url('/'.$model.'/'.$model.'/'.$model->id) }}',--}}
                        {{--url: '{{ route('categories.destroy',$category->id) }}',--}}
                        data: {id: id},
                        success: function (response) {
                            if (response.deleteStatus) {
                                // $('#city-row-'+id).fadeOut(); count = count - 1;tbody.attr('data-count', count);
                                $('#'+currentModel+'-row-' + id).remove();
                                count = count - 1;
                                tbody.attr('data-count', count);
                                swal(response.message, {icon: "success"});
                            }
                            else {
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
                }
                else {
                    swal("تم الغاء العمليه");
                }
            });
    });

</script>
