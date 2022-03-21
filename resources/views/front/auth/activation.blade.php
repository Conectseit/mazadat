@extends('front.layouts.master')
@section('title', trans('messages.activation'))
@section('style')
    <style>
        .box {
            background: white;
            border-radius: 10px;
            border: 1px solid #ccc;
            padding: 20px 10px;
            text-align: center;
        }
        .box strong {
            display: block;
            margin-bottom: 30px;
        }
        .box .code {
            border: 0px;
            text-align: center;
            border-bottom: 3px solid #999;
            width: 30px;
            margin: 0px 10px;
            font-weight: bold;
            font-size: 20px;
            padding-bottom: 5px;
        }

    </style>
@endsection

@section('content')
    @include('front.auctions.parts.head')
    <section class="sign-up-page">
        <div class="container">
            @include('front.layouts.parts.alert')
            <div class="row">
                <form action="{{route('front.check_code')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="inputs-group">
                        <h5 class="group-title">{{trans('messages.activation')}}</h5>
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="full_name" class="form-label">{{trans('messages.activation_code')}}</label>
                            </div>
                            <div class="col-lg-8 col-md-10">
{{--                                <input type="text" class="form-control d-none" id="activation_code" name="activation_code"--}}
{{--                                       placeholder="{{trans('messages.activation_code')}}">--}}
                                <div class="box">
{{--                                    <strong class="text-dark">{{trans('messages.activation_code')}}</strong>--}}
                                    <input type="text" class="code"  name="activation_code"  maxlength="4" style="width: 120px;"
                                           placeholder="{{trans('messages.enter_activation_code')}}">

                                    {{--   <input type="text" class="code"  name="code1" tabindex="1" maxlength="1">--}}
{{--                                    <input type="text" class="code"  name="code2" tabindex="2" maxlength="1">--}}
{{--                                    <input type="text" class="code"  name="code3" tabindex="3" maxlength="1">--}}
{{--                                    <input type="text" class="code"  name="code4" tabindex="4" maxlength="1">--}}
                                </div>
                            </div>
                        </div>

                        <div class="sign-btn row">
                            <button type="submit" id="resend-code-btn" class="btn btn-primary submit-btn send_again">{{trans('messages.send')}}</button>
                        </div>


                        <p class="mt-3 ">

                            <a id="resend-code-btn" href="{{ route('front.resend-sms',$mobile) }}" class="create  text-orange send_btn d-none"> لم يصلك كود التفعيل؟  ارسل مرة أخرى</a>
                            <span class="counter_send d-none"> اعادة ارسال بعد  <span id="countdowntimer">20 </span> Seconds</span>
                        </p>

                    </div>
                </form>
            </div>

        </div>
    </section>

@stop

@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(function () {
            lightbox.option({
                resizeDuration: 100,
                fadeDuration: 300,
                fitImagesInViewport: true,
            });
            // $('a#resend-code-btn').on('click', function(e){
            //     e.preventDefault();
            //     let href = $(this).attr('href');
            //     let timerInterval
            //     Swal.fire({
            //         // title: 'Auto close alert!',
            //         // html: 'I will close in <b></b> milliseconds.',
            //         html: 'سيتم اعادة ارسال كود التفعيل <b></b> بعد ثانيتين.',
            //         timer: 2000,
            //         timerProgressBar: true,
            //         didOpen: () => {
            //             Swal.showLoading()
            //             const b = Swal.getHtmlContainer().querySelector('b')
            //             $.ajax({
            //                 method: 'GET',
            //                 url: href,
            //                 success: res => console.log(res),
            //                 error: err => console.log(err),
            //             });
            //         },
            //         willClose: () => {
            //             clearInterval(timerInterval)
            //         }
            //
            //     }).then((result) => {
            //         /* Read more about handling dismissals below */
            //         if (result.dismiss === Swal.DismissReason.timer) {
            //             console.log('I was closed by the timer')
            //         }
            //     });
            // });
        });
        // var items = document.querySelectorAll('.code'),
        //     lastTabIndex = 4,
        //     backSpaceCode = 8;
        // items.forEach(function(item) {
        //     item.addEventListener('focus', function(e) {
        //         e.target.value = '';
        //     });
        //     item.addEventListener('keydown', function(e) {
        //         let keyCode = e.keyCode,
        //             currentTabIndex = e.target.tabIndex;
        //         if (keyCode !== backSpaceCode && currentTabIndex !== lastTabIndex) {
        //             document.querySelectorAll('.code').forEach(function(inpt) {
        //                 if (inpt.tabIndex === currentTabIndex + 1) {
        //                     setTimeout(function() {
        //                         inpt.focus();
        //                     }, 100);
        //                 }
        //             });
        //         }
        //     });
        // });
        $( document ).ready(function() {
           // var timeleft = 1000;
           // var downloadTimer = setInterval(function(){
           //     timeleft--;
           //     document.getElementById("countdowntimer").textContent = timeleft;
           //     if(timeleft <= 0)
           //         clearInterval(downloadTimer);
           // },10000);
            $( ".send_btn" ).addClass('d-none')
            $( ".counter_send" ).removeClass('d-none')
            var timeleft = 20 ;
            var downloadTimer = setInterval(function(){
                timeleft--;
                $("#countdowntimer").textContent = timeleft;
                $( ".send_btn" ).removeClass('d-none')
                $( ".counter_send" ).addClass('d-none')
                if(timeleft <= 0)
                    clearInterval(downloadTimer);
            },20000);
       })
//timer

</script>
@endpush
