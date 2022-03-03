<main class="categories-bar">
    @inject('categories', 'App\Models\Category')
    <div class="container">
        <div class="owl-carousel categories-bar-carousel owl-theme">

            {{--            <div class="item">--}}
            {{--                <a class="home-active" href="{{route('front.home')}}">--}}
            {{--                    <i class="fal fa-indent d-inline-flex" style="font-size: large">  <h4 class="px-2">{{trans('messages.home')}}</h4> </i>--}}
            {{--                </a>--}}
            {{--            </div>--}}
            <div class="item">
                <h6>{{ trans('messages.auction_on_progress') }}55</h6>
            </div>
            <div class="item">
                <h6>{{ trans('messages.auction_ended') }}55</h6>
            </div>
            <div class="item">
                <h6> {{ trans('messages.auction_selled') }}55</h6>
            </div>
        </div>
    </div>
</main>


