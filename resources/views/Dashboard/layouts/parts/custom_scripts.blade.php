
<script>
    // function readURL(fileName) {
    //     if (fileName.files && fileName.files[0]) {
    //         var reader = new FileReader();
    //         reader.onload = (e) => {
    //             $('#viewImage').attr('src', e.target.result).width(90).height(90);
    //         };
    //         reader.readAsDataURL(fileName.files[0]);
    //     }
    // }
    // ======== image preview ====== //
    $(".image").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.image-preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

</script>


{{--<script>--}}
{{--    function startTime() {--}}
{{--        var d = new Date();--}}
{{--        var h = d.getHours();--}}
{{--        var m = d.getMinutes();--}}
{{--        var s = d.getSeconds();--}}
{{--        m = checkTime(m);--}}
{{--        s = checkTime(s);--}}
{{--        document.getElementById('txt').innerHTML = "Today Current Time is: " + h + ":" + m + ":" + s;--}}
{{--    }--}}
{{--    function checkTime(i) {--}}
{{--        var j = i;--}}
{{--        if (i < 10) {--}}
{{--            j = "0" + i;--}}
{{--        }--}}
{{--        return j;--}}
{{--    }--}}
{{--    setInterval(function () {--}}
{{--        startTime();--}}
{{--    }, 500);--}}
{{--</script>--}}




<script>
    $(function(){
        clock({!! json_encode(trans('dash.months')) !!}, {!! json_encode(trans('dash.days')) !!});
    });
    $(window).on("load", function () {
        $(".loading").delay(600).fadeOut('slow',function(){
            $('.loading-page').css('opacity', '1');
        });
    });

    // Notifucation
    Noty.overrideDefaults({
        theme: 'limitless',
        layout: "{{ LaravelLocalization::getCurrentLocaleDirection() == 'rtl' ? 'topRight' : 'topLeft'}}"
    });
</script>
