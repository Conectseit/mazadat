<style>
    .accordion-button,.accordion-button:focus,.accordion-button:not(.collapsed) {
        background: #1e3c48;
        color: #d1915c;
        border: 0;
    }
</style>
<footer>
{{--    @inject('settings', 'App\Models\Setting')--}}
    @inject('latest_auctions', 'App\Models\Auction')
    @inject('featured_auctions', 'App\Models\Auction')
    @php($about= 'about_app_'.app()->getLocale())
    @php($terms= 'conditions_terms_'.app()->getLocale())
    @php($app_description= 'app_description_'.app()->getLocale())

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


{{--                                    <div class="accordion accordion-flush" id="accordionFlushExample">--}}
{{--                                        <ul class="methods">--}}
{{--                                            <li>--}}
{{--                                                <div class="accordion-item">--}}
{{--                                                    <h2 class="accordion-header" id="flush-headingOne">--}}
{{--                                                        <button class="accordion-button collapsed" type="button"--}}
{{--                                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"--}}
{{--                                                                aria-expanded="false" aria-controls="flush-collapseOne">--}}
{{--                                                            Gadaa--}}
{{--                                                        </button>--}}
{{--                                                    </h2>--}}
{{--                                                    <div id="flush-collapseOne" class="accordion-collapse collapse"--}}
{{--                                                         aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">--}}
{{--                                                        <div class="accordion-body">--}}
{{--                                                            asdfghj--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </li>--}}


{{--                                            --}}{{--                                <li>--}}
{{--                                            --}}{{--                                    <div class="accordion-item">--}}
{{--                                            --}}{{--                                        <h2 class="accordion-header" id="flush-headingTwo">--}}
{{--                                            --}}{{--                                            <button class="accordion-button collapsed" type="button"--}}
{{--                                            --}}{{--                                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"--}}
{{--                                            --}}{{--                                                    aria-expanded="false" aria-controls="flush-collapseTwo">--}}
{{--                                            --}}{{--                                                El Raiyad--}}
{{--                                            --}}{{--                                            </button>--}}
{{--                                            --}}{{--                                        </h2>--}}
{{--                                            --}}{{--                                        <div id="flush-collapseTwo" class="accordion-collapse collapse"--}}
{{--                                            --}}{{--                                             aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">--}}
{{--                                            --}}{{--                                            <div class="accordion-body">--}}
{{--                                            --}}{{--                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero ullam--}}
{{--                                            --}}{{--                                                repellat cupiditate esse! Tenetur, maiores laboriosam sequi dolorem--}}
{{--                                            --}}{{--                                                libero voluptatum reiciendis omnis pariatur, neque consectetur aliquam--}}
{{--                                            --}}{{--                                                dolorum incidunt sit odit!--}}
{{--                                            --}}{{--                                            </div>--}}
{{--                                            --}}{{--                                        </div>--}}
{{--                                            --}}{{--                                    </div>--}}
{{--                                            --}}{{--                                </li>--}}
{{--                                            --}}{{--                                <li>--}}
{{--                                            --}}{{--                                    <div class="accordion-item">--}}
{{--                                            --}}{{--                                        <h2 class="accordion-header" id="flush-headingThree">--}}
{{--                                            --}}{{--                                            <button class="accordion-button collapsed" type="button"--}}
{{--                                            --}}{{--                                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseThree"--}}
{{--                                            --}}{{--                                                    aria-expanded="false" aria-controls="flush-collapseThree">--}}
{{--                                            --}}{{--                                                El Raiyad--}}
{{--                                            --}}{{--                                            </button>--}}
{{--                                            --}}{{--                                        </h2>--}}
{{--                                            --}}{{--                                        <div id="flush-collapseThree" class="accordion-collapse collapse"--}}
{{--                                            --}}{{--                                             aria-labelledby="flush-headingThree"--}}
{{--                                            --}}{{--                                             data-bs-parent="#accordionFlushExample">--}}
{{--                                            --}}{{--                                            <div class="accordion-body">--}}
{{--                                            --}}{{--                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero ullam--}}
{{--                                            --}}{{--                                                repellat cupiditate esse! Tenetur, maiores laboriosam sequi dolorem--}}
{{--                                            --}}{{--                                                libero voluptatum reiciendis omnis pariatur, neque consectetur aliquam--}}
{{--                                            --}}{{--                                                dolorum incidunt sit odit!--}}
{{--                                            --}}{{--                                            </div>--}}
{{--                                            --}}{{--                                        </div>--}}
{{--                                            --}}{{--                                    </div>--}}
{{--                                            --}}{{--                                </li>--}}

{{--                                        </ul>--}}
{{--                                    </div>--}}


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
                                    {{ trans('messages.settings.description') }}
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                                <div class="accordion-body">
                                    <strong>{{App\Models\Setting::where('key',$app_description)->first()->value}}</strong>
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
                                المزادات المميزة
                            </h4>
                            <ul>
{{--                                <li><a href="#">المركبات والمعدات</a></li>--}}
{{--                                <li><a href="#">أرقام اتصالات المميزة</a></li>--}}
{{--                                <li><a href="#">متفرقات</a></li>--}}
{{--                                <li><a href="#">مزاد ابوظبي العقاري</a></li>--}}
{{--                                <li><a href="#">مزاد الامارات العقاري</a></li>--}}

                                @foreach($featured_auctions->orderBy('count_of_buyer', 'desc')->take(4)->get() as $auction)

                                    <li><a href="#">{{$auction->$name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="ul-parent">
                            <h4 class="footer-title">
                                <span class="sq"></span>
                                مزادات
                            </h4>
                            <ul>
                                <li><a href="{{route('front.about_app')}}">{{trans('messages.about_app')}}</a></li>
                                <li><a href="#">اتصل بنا</a></li>
                                <li><a href="#">نتائج المزادات </a></li>
                                <li><a href="{{route('front.show_register')}}">التسجيل</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="ul-parent">
                            <h4 class="footer-title">
                                <span class="sq"></span>
                                   احدث المزادات
                            </h4>
                            <ul>
                                @foreach($latest_auctions ->orderBy('id', 'desc')->take(4)->get() as $auction)

                                <li><a href="#">{{$auction->$name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="ul-parent">
                            <h4 class="footer-title">
                                <span class="sq"></span>
                                الدعم والمساعدة
                            </h4>
                            <ul>
                                <li><a href="#">هل نسيت كلمة المرور؟</a></li>
                                <li><a href="{{route('front.questions')}}">{{trans('messages.question.questions')}} </a></li>
{{--                                <li><a href="#">التسجيل</a></li>--}}
{{--                                <li><a href="#">التأمين</a></li>--}}
{{--                                <li><a href="#">المزايدة</a></li>--}}
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
                        مؤسسة مزادات للتسويق  - 202 &copy; جميع الحقوق محفوظة
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
