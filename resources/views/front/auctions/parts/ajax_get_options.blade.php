
<script>

    // ========= get_options_by_category_id =====
    $("#category").change(function (e) {
        e.preventDefault();
        var category_id = $(this).val();
        let _token = '{{ csrf_token() }}';
        let select_inputs_options = $('.select-inputs-options');
        //console.log(category_id);
        if (category_id) {
            $.ajax({
                url: "{{ route('front.ajax_get_options_by_category_id') }}",
                type: 'POST',
                data: {category_id, _token},
                success: function (response) {
                    if (response.status === true) {
                        select_inputs_options.html(``);
                        let html = ``;
                        $("#options").append('<option value="">اختر </option>');
                        $.each(response.options, function (index, option) {
                            html += `
                                <select class="form-select form-control"  id="options" name="option_ids[]" aria-label="Default select example" style="margin-bottom: 17px;">
                                    <option value="${option.id}" >${option.name_ar}</option>

                                    <optgroup class="form-select form-control" id="options" value="${option.id}">
                                        ${get_option_details(option.option_details)}
                                    </optgroup>
                                </select>
                            `;
                        });
                        select_inputs_options.html(html);
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

    function get_option_details(option_details){
        let html = ``;
        $.each(option_details, function (index, el){
            html += `<option value="${el.id}">${el.value_ar}</option>`;
        });
        return html;
    }

</script>
