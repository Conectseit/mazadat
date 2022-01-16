<style>
    .accordion-button,.accordion-button:focus,.accordion-button:not(.collapsed) {
        background: #1e3c48;
        color: #d1915c;
        border: 0;
    }

</style>
<footer>
{{--    @inject('settings', 'App\Models\Setting')--}}
    @php($about= 'about_app_'.app()->getLocale())
    @php($terms= 'conditions_terms_'.app()->getLocale())

    <div class="container">
        <div class="row">
            <div class="col-lg-7 slog-right">
                <img class="logo" src="{{asset('Front/assets/imgs/logo-text.svg')}}" alt="logo">
                <p class="footer-text">
                    {{App\Models\Setting::where('key',$about)->first()->value}}
                </p>
                <div class="links">
{{--                    <a href="#">الشروط والاحكام <i class="fal fa-chevron-left"></i></a>--}}
{{--                    <a href="#">تعؤف اكثر على مزادات <i class="fal fa-chevron-left"></i></a>--}}
                    <div class="accordion" id="accordionPanelsStayOpenExample">

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                    {{trans('messages.terms')}}    <i class="fal fa-chevron-left" style="padding: 20px"></i>
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                                <div class="accordion-body">
                                    <strong>{{App\Models\Setting::where('key',$terms)->first()->value}}</strong>
                                    {{--                                    any HTML can go within the <code>.accordion-body</code>,--}}
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                    {{trans('messages.about_mazadat')}}
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                                <div class="accordion-body">
                                    <strong>{{App\Models\Setting::where('key',$about)->first()->value}}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="row">
                    <div class="col-md-6">
                        <div class="ul-parent">
                            <h4 class="footer-title">
                                <span class="sq"></span>
                                المزادات
                            </h4>
                            <ul>
                                <li><a href="#">المركبات والمعدات</a></li>
                                <li><a href="#">أرقام اتصالات المميزة</a></li>
                                <li><a href="#">متفرقات</a></li>
                                <li><a href="#">مزاد ابوظبي العقاري</a></li>
                                <li><a href="#">مزاد الامارات العقاري</a></li>
                            </ul>
                        </div>
                        <div class="ul-parent">
                            <h4 class="footer-title">
                                <span class="sq"></span>
                                مزادات
                            </h4>
                            <ul>
                                <li><a href="#">عن الامارات للمزادات</a></li>
                                <li><a href="#">اتصل بنا</a></li>
                                <li><a href="#">نتائج المزاد العقاري</a></li>
                                <li><a href="#">التسجيل</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="ul-parent">
                            <h4 class="footer-title">
                                <span class="sq"></span>
                                المزادات
                            </h4>
                            <ul>
                                <li><a href="#">لوحات ابوظبي المميزة</a></li>
                                <li><a href="#">لوحات رأس الخيمة المميزة</a></li>
                                <li><a href="#">لوحات ام القيوين المميزة</a></li>
                                <li><a href="#">لوحات الفجيرة المميزة</a></li>
                                <li><a href="#">لوحات الشارقة المميزة</a></li>
                            </ul>
                        </div>
                        <div class="ul-parent">
                            <h4 class="footer-title">
                                <span class="sq"></span>
                                الدعم والمساعدة
                            </h4>
                            <ul>
                                <li><a href="#">هل نسيت كلمة المرور؟</a></li>
                                <li><a href="#">الاسئلة المتكررة</a></li>
                                <li><a href="#">التسجيل</a></li>
                                <li><a href="#">التأمين</a></li>
                                <li><a href="#">المزايدة</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="ul-parent">
                            <h4 class="footer-title">
                                <span class="sq"></span>
                                تابعنا على
                            </h4>
                            <div class="social">
                                <a href="{{App\Models\Setting::where('key','facebook_url')->first()->value}}"><i class="fab fa-facebook-square"></i></a>
                                <a href="{{ App\Models\Setting:: where('key','instagram_url')->first()->value}}"><i class="fab fa-instagram"></i></a>
                                <a href="{{ App\Models\Setting:: where('key','twitter_url')->first()->value}}"><i class="fab fa-twitter-square"></i></a>
                                <a href="{{ App\Models\Setting:: where('key','youtube_url')->first()->value}}"><i class="fab fa-youtube"></i></a>
                                <a href="#"><i class="fab fa-google-plus-square"></i></a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
    <div class="rights">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <p>
                        الامارات للمزادات 2004 - 2021 &copy; جميع الحقوق محفوظة
                    </p>

                </div>
                <div class="col-lg-6">
                    <div class="payment-brands">
                        <img src="{{asset('Front/assets/imgs/mastercard.svg')}}" alt="mastercard">
                        <img src="{{asset('Front/assets/imgs/mastercard.svg')}}" alt="mastercard">
                        <img src="{{asset('Front/assets/imgs/mastercard.svg')}}" alt="mastercard">
                        <img src="{{asset('Front/assets/imgs/mastercard.svg')}}" alt="mastercard">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
