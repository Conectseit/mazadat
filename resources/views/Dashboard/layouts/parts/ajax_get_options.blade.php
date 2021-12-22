
<script>

    // ========= get_options_by_category_id =====
    $("#category").change(function (e) {
        e.preventDefault();
        var category_id = $(this).val();
        let _token = '{{ csrf_token() }}';
        //console.log(category_id);
        if (category_id) {
            $.ajax({
                {{--url: "{{ route('ajax_get_options_by_category_id') }}",--}}
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
                {{--url: "{{ route('ajax_get_option_details_by_option_id') }}",--}}
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
