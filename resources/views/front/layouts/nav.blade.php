<main class="sign-in-form" id="signInForm">
    <div class="container">
        @if(session()->has('error'))
            <div class="alert alert-warning alert-dismissible" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
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
                <div class="col-sm-8"> <button type="submit" class="btn btn-primary submit-btn">الدخول</button>
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
                    <h5>توقيت الامارات</h5>
                    <p class="clock">03:01 <span>م</span></p>
                    <p class="day"><span class="name">الثلاثاء</span><span class="number">02</span></p>
                    <h3 class="month-year"><span class="month">نوفمبر</span><span class="year">2021</span></h3>
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
                                        <a class="nav-link hvr-shutter-out-horizontal" href="{{route('front.about_app')}}">
                                            {{trans('messages.about_app')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link hvr-shutter-out-horizontal" href="{{route('front.questions')}}">
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
                                        <a class="nav-link hvr-shutter-out-horizontal" href="{{route('front.show_register')}}">  {{trans('messages.register')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link hvr-shutter-out-horizontal" id="signInBtn"
                                           href="{{route('front.show_login')}}">الدخول</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link hvr-shutter-out-horizontal" href="{{ isLocalized("en") }}">ENG US</a>
                                        <a class="nav-link hvr-shutter-out-horizontal" href="{{ isLocalized("ar") }}">AR </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
