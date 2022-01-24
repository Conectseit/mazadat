
<script>

    // ========= get_cities_by_country_id =====
    $("#country").change(function (e) {
        e.preventDefault();
        var country_id = $(this).val();
        let _token = '{{ csrf_token() }}';
        //console.log(country_id);
        if (country_id) {
            $.ajax({
                url: "{{ route('get_cities_by_country_id') }}",
                type: 'POST',
                data: {country_id, _token},
                success: function (response) {
                    if (response.status == 1) {
                        //console.log(data);
                        $("#cities").empty();
                        $("#cities").append('<option value="">اختر </option>');
                        $.each(response.cities, function (index, city) {
                            console.log(city);
                            $("#cities").append('<option value="' + city.id + '">' + city.name_ar + '</option>');
                        });
                    }
                },
                error: function (jqXhr, textStatus, errorMessage) {
                    alert(errorMessage);
                }
            });
        } else {
            $("#cities").empty();
            $("#cities").append('<option value="">اختر </option>');
        }
    });
</script>
