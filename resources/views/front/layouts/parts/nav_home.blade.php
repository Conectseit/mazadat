<main class="categories-bar">
    @inject('auctions', 'App\Models\Auction')
    <div class="container">
        <div class="owl-carousel categories-bar-carousel owl-theme">

            {{--            <div class="item">--}}
            {{--                <a class="home-active" href="{{route('front.home')}}">--}}
            {{--                    <i class="fal fa-indent d-inline-flex" style="font-size: large">  <h4 class="px-2">{{trans('messages.home')}}</h4> </i>--}}
            {{--                </a>--}}
            {{--            </div>--}}
            <div class="item text-center">
                <i class="fal fa-gavel  d-inline-flex" ><h6>{{ trans('messages.auction.on_progress') }}:({{$auctions->where(['status'=>'on_progress'])->count()}})</h6></i>
            </div>
            <div class="item">
                <i class="fal fa-gavel  d-inline-flex" >  <h6>{{ trans('messages.auction.done') }}:({{$auctions->where(['status'=>'done'])->count()}})</h6></i>
            </div>
            <div class="item">
                <i class="fal fa-gavel  d-inline-flex" > <h6> {{ trans('messages.auction.selled') }} ؟؟ </h6></i>
            </div>
        </div>
    </div>
</main>


