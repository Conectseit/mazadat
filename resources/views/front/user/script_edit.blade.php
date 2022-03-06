<script>

    // ======== image preview ====== //
    // $(".image").change(function () {
    //     if (this.files && this.files[0]) {
    //         var reader = new FileReader();
    //         reader.onload = function (e) {
    //             $('.image-preview').attr('src', e.target.result);
    //         }
    //         reader.readAsDataURL(this.files[0]);
    //     }
    // });

    function readURL0(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imageUpload").change(function () {
        readURL0(this);
    });
</script>

<script>
    $(function () {
        lightbox.option({
            resizeDuration: 100,
            fadeDuration: 300,
            fitImagesInViewport: true,
        });
    });
    let noimage = "https://assets.wasalt.com/others/icons/villas-for-sale-in-makkah.jpeg";

    function readURL(input) {
        console.log(input.files);
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#img-preview").attr("src", e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        } else {
            $("#img-preview").attr("src", "https://assets.wasalt.com/others/icons/villas-for-sale-in-makkah.jpeg");

        }
    }
    function readURL2(input) {
        console.log(input.files);
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#img-preview2").attr("src", e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        } else {

            $("#img-preview2").attr("src", "https://assets.wasalt.com/others/icons/villas-for-sale-in-makkah.jpeg");
        }
    }

    function readURL3(input) {
        console.log(input.files);
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#img-preview3").attr("src", e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        } else {

            $("#img-preview3").attr("src", "https://assets.wasalt.com/others/icons/villas-for-sale-in-makkah.jpeg");
        }
    }
</script>
