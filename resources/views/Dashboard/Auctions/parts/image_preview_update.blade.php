<script>
//====
    $(function() {
        // Multiple images preview in browser
        var imagesPreview = function(input, placeToInsertImagePreview) {
            $(placeToInsertImagePreview).html(``);
            if (input.files) {
                var filesAmount = input.files.length;

                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        $($.parseHTML(`<img style="width: 100px;margin: 4px;padding: 8px;">`)).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        };

        $('#gallery-photo-add').on('change', function() {
            imagesPreview(this, 'div.gallery');
        });
    });


    $(function() {
        // Multiple images preview in browser
        var imagesPreview1 = function(input, placeToInsertImagePreview) {
            $(placeToInsertImagePreview).html(``);
            if (input.files) {
                var filesAmount = input.files.length;

                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        // $($.parseHTML('<img style="width: 100px;margin: 4px;padding: 8px;">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        };

        $('#inspection-photo-add').on('change', function() {
            imagesPreview1(this, 'div.gallery1');
        });
    });

</script>
