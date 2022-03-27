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
    @inject('categories', 'App\Models\Category')
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
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                    {{trans('messages.terms')}}
{{--                                    <i class="fal fa-chevron-left" style="padding: 20px"></i>--}}
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
                               {{trans('messages.auction.unique')}}
                            </h4>
                            <ul>

                                @foreach($featured_auctions->where('is_unique', 1)->latest()->take(4)->get() as $auction)
{{--                                @foreach($featured_auctions->orderBy('count_of_buyer', 'desc')->take(4)->get() as $auction)--}}

                                    <li><a href="{{route('front.auction_details',$auction->id)}}"> {{ substr($auction->$name,0,15) }} </a></li>
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

                                <li><a href="{{route('front.show_register')}}">{{trans('messages.register')}}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="ul-parent">
                            <h4 class="footer-title">
                                <span class="sq"></span>
                                {{trans('messages.auction.latest_auctions')}}
                            </h4>
                            <ul>

                            @foreach(\App\Models\Category::has('auctions')->get() as $category)
                                <li><a href="{{route('front.auction_details',$category->auctions->last()->id)}}">{{ substr($category->auctions->last()->$name,0,15) }}</a></li>
                            @endforeach

{{--                                @foreach($latest_auctions ->orderBy('id', 'desc')->take(4)->get() as $auction)--}}

{{--                                <li><a href="{{route('front.auction_details',$auction->id)}}">{{ substr($auction->$name,0,15) }}</a></li>--}}
{{--                                @endforeach--}}
                            </ul>
                        </div>
                        <div class="ul-parent">
                            <h4 class="footer-title">
                                <span class="sq"></span>
                                {{trans('messages.support&help')}}
                            </h4>
                            <ul>
                                <li>
                                    <a href="#" class="forgot" data-bs-toggle="modal"
                                       data-bs-target="#forget_pass_modal"> {{trans('messages.forget_pass')}}</a>
                                </li>
                                <li><a href="{{route('front.questions')}}">{{trans('messages.question.questions')}} </a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="ul-parent">
                            <h4 class="footer-title">
                                <span class="sq"></span>
                                {{trans('messages.follow_us')}}
                            </h4>
                            <div class="social">
                                <a href="{{App\Models\Setting::where('key','facebook_url')->first()->value}}"  target="_blank"><i class="fab fa-facebook-square"></i></a>
                                <a href="{{ App\Models\Setting:: where('key','instagram_url')->first()->value}}" target="_blank"><i class="fab fa-instagram"></i></a>
                                <a href="{{ App\Models\Setting:: where('key','twitter_url')->first()->value}}" target="_blank"><i class="fab fa-twitter-square"></i></a>
                                <a href="{{ App\Models\Setting:: where('key','youtube_url')->first()->value}}" target="_blank"><i class="fab fa-youtube"></i></a>
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
                        مؤسسة مزادات للتسويق  - 2022 &copy; جميع الحقوق محفوظة
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
