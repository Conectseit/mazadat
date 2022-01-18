<main class="sign-in-form" id="signInForm">
    <div class="container">
        {{--        @if(session()->has('error'))--}}
        {{--            <div class="alert alert-warning alert-dismissible" role="alert">--}}
        {{--                {{ session('error') }}--}}
        {{--                <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
        {{--                    <span aria-hidden="true">&times;</span>--}}
        {{--                </button>--}}
        {{--            </div>--}}
        {{--        @endif--}}
        <form action="{{route('front.login')}}" method="post" enctype="multipart/form-data">
            @csrf
            <h4 class="title">الدخول لحسابك</h4>
            <p>
                من فضلك ادخل معلومات الدخول الخاصة بحسابك لتتمكن من استخدام كل خصائص الموقع وإذا لم يكن لديك حسابك؟
                يمكنك
                تسجيل مستخدم جديد مجانأ
            </p>
            <div class="mb-4 form-group row">
                <div class="col-sm-2 d-flex align-items-center">
                    <label for="email" class="form-label">اسم المستخدم</label>
                </div>
                <div class="col-sm-8">
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                </div>
            </div>
            <div class="mb-4 form-group row">
                <div class="col-sm-2 d-flex align-items-center">
                    <label for="password" class="form-label">كلمة المرور</label>
                </div>
                <div class="col-sm-8">
                    <input type="password" class="form-control" name="password" id="password">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" name="remember" id="remember">
                                <label class="form-check-label" for="remember">تذكرنى؟</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <a href="#" class="forgot">نسيت كلمة المرور؟</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <button type="submit" class="btn btn-primary submit-btn">الدخول</button>
                </div>
            </div>
        </form>
    </div>
</main>

<nav class="navbar navbar-expand-lg navbar-light" id="navbar">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-6 nav-col">
                <a class="navbar-brand" href="{{route('front.home')}}">
                    <img src="{{asset('Front/assets/imgs/logo.svg')}}" alt="logo" width="250">
                </a>

            </div>

            <div class="col-lg-3 col-sm-4 col-7 nav-col">
                <div class="time">
                    <h5>توقيت مكة المكرمة</h5>
                    <p class="clock" id="time"></p>
                    <p class="day"><span class="name px-2" id="day_d">الثلاثاء</span><span class="number"
                                                                                           id="day_n">02</span></p>
                    <h3 class="month-year"><span class="month px-2" id="day_m">نوفمبر</span><span class="year" id="year_h"></span>
                    </h3>
                </div>
            </div>

            <button class="navbar-toggler col-4" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <i class="fal fa-bars"></i>
            </button>

            <div class="col-lg-6">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="row">
                        <div class="col-lg-6 nav-col">
                            <div class="site-links">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link hvr-shutter-out-horizontal"
                                           href="{{route('front.about_app')}}">
                                            {{trans('messages.about_app')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link hvr-shutter-out-horizontal"
                                           href="{{route('front.questions')}}">
                                            {{trans('messages.question.questions')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link hvr-shutter-out-horizontal" href="#">اتصل بنا</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-6 nav-col">
                            <div class="user-links">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link hvr-shutter-out-horizontal"
                                           href="{{route('front.show_register')}}">  {{trans('messages.register')}}</a>
                                    </li>
                                    {{--                                    <li class="nav-item">--}}
                                    {{--                                        <a class="nav-link hvr-shutter-out-horizontal" id="signInBtn"--}}
                                    {{--                                           href="{{route('front.show_login')}}">الدخول</a>--}}
                                    {{--                                    </li>--}}

{{--                                    <li class="nav-item">--}}
{{--                                        @if( app()->isLocale('en') )--}}
{{--                                            <a class="nav-link hvr-shutter-out-horizontal"--}}
{{--                                               href="{{ isLocalized("ar") }}">AR </a>--}}
{{--                                        @else--}}
{{--                                            <a class="nav-link hvr-shutter-out-horizontal"--}}
{{--                                               href="{{ isLocalized("en") }}">ENG US</a>--}}
{{--                                        @endif--}}
{{--                                    </li>--}}
                                    <li class="nav-item">
                                            <div class="nav-link ">
                                                <span class="bg-{{ app()->isLocale('ar') ? 'green' : 'white' }}  ">
                                                    <a href="{{ isLocalized("ar") }}" class="arabic">@lang('messages.ar.ar')</a>
                                                </span>
                                                <span class="bg-{{ app()->isLocale('en') ? 'green' : 'white' }} ">
                                                   <a href="{{ isLocalized("en") }}" class="arabic">@lang('messages.en.en')</a>
                                                </span>
                                            </div>
                                    </li>

                                    {{--when authinticate--}}
                                    @if(auth()->check())

                                        <li class="nav-item">
                                            <a class="nav-link hvr-shutter-out-horizontal"
                                               href="{{route('front.logout')}}">logout</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link hvr-shutter-out-horizontal"
                                               href="{{route('front.my_profile')}}"> <i
                                                    class="fa fa-user"></i> {{trans('messages.profile')}}</a>
                                        </li>
                                    @else
                                        <li class="nav-item">
                                            <a class="nav-link hvr-shutter-out-horizontal" id="signInBtn"
                                               href="{{route('front.show_login')}}">الدخول</a>
                                        </li>
                                    @endif

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>

<script>
    var myVar = setInterval(function () {
        myTimer();
    }, 1000);

    function myTimer() {
        "use strict";
        var time = new Date(),
            show2 = document.getElementById("time"),
            hours = time.getHours(),
            minute = time.getMinutes(),
            second = time.getSeconds();
        if (hours > 12) {
            hours = hours - 12;
            show2.innerHTML = hours + ":" + minute + ":" + second + " " + "PM";
        } else {
            show2.innerHTML = hours + ":" + minute + ":" + second + " " + "AM";
        }
    }

    $(function () {
        var date = new Date();

        var show = document.getElementById("day_d"),

            year_h = document.getElementById("year_h"),
            day_m = document.getElementById("day_m"),

            day = date.getDate(),
            /*because month between 0 to 11 , 0 referring jan, February referring 1 */
            year = date.getFullYear();
        var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        var now = new Date();
        var day_m_v = months[now.getMonth()];
        if (day < 10) {
            day = "0" + day;
        }
        if (months < 10) {
            months = "0" + months;
        }
        show.innerHTML = day;
        year_h.innerHTML = year;
        day_m.innerHTML = day_m_v;

        var today = new Date(),
            day = today.getDay(),
            show3 = document.getElementById("day_n"),
            dayList = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        show3.innerHTML = dayList[day];
    });
</script>
