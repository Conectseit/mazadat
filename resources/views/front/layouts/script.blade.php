
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script src="{{asset('Front/assets/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('Front/assets/js/fa-pro.js')}}"></script>
<script src="{{asset('Front/assets/js/lightbox.min.js')}}"></script>
<script src="{{asset('Front/assets/js/main.js')}}"></script>






<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>

<script>
    $(function () {
        lightbox.option({
            resizeDuration: 100,
            fadeDuration: 300,
            fitImagesInViewport: true,
        });
    });
</script>








{{--<script>--}}
{{--    @if(Session::has('messege'))--}}
{{--    var type="{{Session::get('alert-type','info')}}"--}}
{{--    switch(type){--}}
{{--        case 'info':--}}
{{--            toastr.info("{{ Session::get('messege') }}");--}}
{{--            break;--}}
{{--        case 'success':--}}
{{--            toastr.success("{{ Session::get('messege') }}");--}}
{{--            break;--}}
{{--        case 'warning':--}}
{{--            toastr.warning("{{ Session::get('messege') }}");--}}
{{--            break;--}}
{{--        case 'error':--}}
{{--            toastr.error("{{ Session::get('messege') }}");--}}
{{--            break;--}}
{{--    }--}}
{{--    @endif--}}
{{--</script>--}}

<!-- Option 2: Separate Popper and Bootstrap JS -->








{{--<script>--}}
{{--    $('.num').keyup(function () {--}}
{{--        var inputVal = $(this).val();--}}
{{--        var characterReg = /^[0-9]{1}$/;--}}
{{--        var s = characterReg.test(inputVal);--}}
{{--        if (s) {--}}
{{--            var inputs = $(this).closest('form').find(':input');--}}
{{--            inputs.eq(inputs.index(this) - 1 ).focus();--}}
{{--        }--}}
{{--    });--}}
{{--</script>--}}
