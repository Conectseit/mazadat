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
    @php($quote_name= 'quote_name_'.app()->getLocale())

    <div class="container" >
        <div class="row">
            <div class="col-lg-7 slog-right" dir="{{ direction() }}">
                <img class="logo" src="{{asset('Front/assets/imgs/logo-text.svg')}}" alt="logo">
                <p class="footer-text">
{{--                    {{App\Models\Setting::where('key',$about)->first()->value}}--}}
                    {{App\Models\Setting::where('key',$quote_name)->first()->value}}
                </p>
                <div class="links" >
                    <a href="{{route('front.condition_and_terms')}}">{{trans('messages.terms')}} <i class="fal fa-chevron-left" ></i></a>
                    <a href="{{route('front.description')}}">{{ trans('messages.settings.description') }}<i class="fal fa-chevron-left"></i></a>
                    <a href="{{route('front.privacy')}}">{{ trans('messages.settings.privacy') }}<i class="fal fa-chevron-left"></i></a>
                </div>
            </div>
            <div class="col-lg-5" dir="{{ direction() }}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="ul-parent">
                            <h4 class="footer-title">
                                <span class="sq"></span>
                               {{trans('messages.auction.unique')}}
                            </h4>
                            <ul>

                                @foreach($featured_auctions->where('is_unique', 1)->latest()->take(4)->get() as $auction)
                                    <li><a href="{{route('front.auction_details',$auction->id)}}"> {{ substr($auction->$name,0,25) }} </a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="ul-parent">
                            <h4 class="footer-title">
                                <span class="sq"></span>{{trans('messages.mazadat')}}
                            </h4>
                            <ul>
                                <li><a href="{{route('front.about_app')}}">{{trans('messages.about_app')}}</a></li>

                                <li><a href="{{route('front.show_register')}}">{{trans('messages.register')}}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="ul-parent">
                            <h6 class="footer-title">
                                <span class="sq"></span>
                                {{trans('messages.auction.latest_auctions')}}
                            </h6>
                            <ul>
                            @foreach(\App\Models\Category::has('auctions')->get() as $category)
                                <li><a href="{{route('front.auction_details',$category->auctions->last()->id)}}">{{ substr($category->auctions->last()->$name,0,25) }}</a></li>
                            @endforeach
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
                                       data-bs-target="#forget_pass_modal"> {{trans('messages.forget_password')}}</a>
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
                                <a href="{{App\Models\Setting::where('key','facebook_url')->first()->value}}"  target="_blank"><i class="fab fa-snapchat-square"></i></a>
                                <a href="{{ App\Models\Setting:: where('key','instagram_url')->first()->value}}" target="_blank"><i class="fab fa-instagram"></i></a>
                                <a href="{{ App\Models\Setting:: where('key','twitter_url')->first()->value}}" target="_blank"><i class="fab fa-twitter-square"></i></a>
{{--                                <a href="{{ App\Models\Setting:: where('key','youtube_url')->first()->value}}" target="_blank"><i class="fab fa-youtube"></i></a>--}}
{{--                                <a href="#"><i class="fab fa-google-plus-square"></i></a>--}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="rights">
        <div class="container">
            <div class="row" dir="{{ direction() }}">
                <div class="col-lg-6" >
                    <p style="font-weight: bold; font-size: 14px;">{{trans('messages.copy_rights')}}
                        <b>
                            <img  class="img-circle" src="{{asset('Front/assets/imgs/icon/dark-logoo.png')}}" alt="mastercard"style="width: 100px; height: 35px;">
                        </b>
                        {{trans('messages.for')}}
                    </p>
                </div>
                <div class="col-lg-6">
                    <div class="payment-brands">
                        <img src="{{asset('Front/assets/imgs/mastercard-img.svg')}}" alt="mastercard">
                        <img src="{{asset('Front/assets/imgs/whiteUrway.png')}}" alt="mastercard" >
                        <img src="{{asset('Front/assets/imgs/visa-img.svg')}}" alt="mastercard">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
