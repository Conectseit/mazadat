{{--<script>--}}
{{--    @if($auction)--}}
{{--        get_ajax_request({{ $auction->category_id }}, @json($auction->option_details));--}}
{{--    @endif--}}

{{--    // ========= get_options_by_category_id =====--}}
{{--    function get_ajax_request(category_id, options_details)--}}
{{--    {--}}
{{--        let _token = '{{ csrf_token() }}';--}}
{{--        let select_inputs_options = $('.select-inputs-options');--}}

{{--        //console.log(category_id);--}}

{{--        if (category_id) {--}}
{{--            $.ajax({--}}
{{--                url: "{{ route('front.ajax_get_options_by_category_id') }}",--}}
{{--                type: 'POST',--}}
{{--                data: {category_id, _token},--}}
{{--                success: function (response) {--}}
{{--                    if (response.status === true) {--}}
{{--                        select_inputs_options.html(``);--}}
{{--                        let html = ``;--}}
{{--                        $("#options").append('<option value="">اختر </option>');--}}
{{--                        $.each(response.options, function (index, option) {--}}
{{--                            html += `--}}
{{--                                <select class="form-select form-control"  id="options" name="option_ids[]" aria-label="Default select example" style="margin-bottom: 17px;">--}}
{{--                                    <option value="0" >${option.name_ar}</option>--}}

{{--                                    <optgroup class="form-select form-control" id="options" value="${option.id}">--}}
{{--                                        ${get_option_details(option.option_details, options_details[index])}--}}
{{--                                    </optgroup>--}}
{{--                                </select>--}}
{{--                            `;--}}
{{--                        });--}}
{{--                        select_inputs_options.html(html);--}}
{{--                    }--}}
{{--                },--}}
{{--                error: function (jqXhr, textStatus, errorMessage) {--}}
{{--                    alert(errorMessage);--}}
{{--                }--}}
{{--            });--}}
{{--        } else {--}}
{{--            $("#options").empty();--}}
{{--            $("#options").append('<option value="">اختر </option>');--}}
{{--        }--}}
{{--    }--}}


{{--    $("#category").change(function (e) {--}}
{{--        e.preventDefault();--}}
{{--        get_ajax_request($(this).val(), [{id: 0}]);--}}
{{--    });--}}

{{--    function get_option_details(option_details, options_detail){--}}

{{--        let html = ``;--}}
{{--        $.each(option_details, function (index, el){--}}
{{--            html += `<option ${check_if_selected(options_detail, el)} value="${el.id}">${el.value_ar}</option>`;--}}
{{--        });--}}
{{--        return html;--}}
{{--    }--}}

{{--    function check_if_selected(options_detail, el){--}}
{{--        if(!options_detail) return '';--}}

{{--        return options_detail.id === el.id ? 'selected' : '';--}}
{{--    }--}}

{{--</script>--}}








<script>
    // ========= get_options_by_category_id =====
    $("#category").change(function (e) {
        e.preventDefault();
        var category_id = $(this).val();
        let _token = '{{ csrf_token() }}';
        let select_inputs_options = $('.select-inputs-options');
        let not_options = $('.not-options');
        console.log(category_id);
        if (category_id) {
            $.ajax({
                url: "{{ route('front.ajax_get_options_by_category_id') }}",
                type: 'POST',
                data: {category_id, _token},
                success: function (response) {
                    if (response.status === true) {

//==========================================================================
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
//==========================================================================

                        not_options.html(``);
                        let html1 = ``;
                        $("#not").append('<option value="">اختر </option>');
                        $.each(response.not, function (index, option) {
                            html1 += `
                                <select class="form-select form-control"  id="not" name="option_ids[]" aria-label="Default select example" style="margin-bottom: 17px;">
                                    <option value="${option.id}" >${option.name_ar}</option>

                                    <optgroup class="form-select form-control" id="not" value="${option.id}">
                                        ${get_option_details(option.option_details)}
                                    </optgroup>
                                </select>
                            `;
                        });
                        not_options.html(html1);
//==========================================================================

                    }
                },
                error: function (jqXhr, textStatus, errorMessage) {
                    alert(errorMessage);
                }
            });
        } else {

            //==========================================================================
            $("#options").empty();
            $("#options").append('<option value="">اختر </option>');
            //==========================================================================
            $("#not").empty();
            $("#not").append('<option value="">اختر </option>');
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
