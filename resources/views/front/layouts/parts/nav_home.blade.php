<main class="categories-bar">
    @inject('auctions', 'App\Models\Auction')
    <div class="container">
{{--        <div class="owl-carousel categories-bar-carousel owl-theme">--}}

            {{--            <div class="item">--}}
            {{--                <a class="home-active" href="{{route('front.home')}}">--}}
            {{--                    <i class="fal fa-indent d-inline-flex" style="font-size: large">  <h4 class="px-2">{{trans('messages.home')}}</h4> </i>--}}
            {{--                </a>--}}
            {{--            </div>--}}
{{--        <div class="d-flex justify-content-center" style="color: #fff">--}}
{{--            <div class="item text-center  d-inline-flex m-2 ">--}}
{{--                <i class="fal fa-gavel  px-2 mx-1 "></i><h6>{{ trans('messages.auction.on_progress') }}:({{$auctions->where(['status'=>'on_progress'])->count()}})</h6>--}}
{{--            </div>--}}
{{--            <div class="item text-center d-inline-flex m-2">--}}
{{--                <i class="fal fa-gavel  d-inline-flex px-2 mx-1"> </i> <h6>{{ trans('messages.auction.done') }}:({{$auctions->where(['status'=>'done'])->count()}})</h6>--}}
{{--            </div>--}}
{{--            <div class="item text-center d-inline-flex m-2">--}}
{{--                <i class="fal fa-gavel  d-inline-flex px-2 mx-1"></i> <h6> {{ trans('messages.auction.selled') }} ؟؟ </h6>--}}
{{--            </div>--}}
{{--        </div>--}}


        <div class="row">
            <div class=" d-flex justify-content-between">

                <div  class=" statistics btn"><b><i class="fal fa-gavel"></i>
                    </b>{{ trans('messages.auction.on_progress') }}:({{$auctions->where(['status'=>'on_progress','is_accepted'=>1])->count()}})</div>
                <div  class=" statistics btn"><b><i class="fal fa-gavel"></i>
                    </b>{{ trans('messages.auction.done') }}:({{$auctions->where(['status'=>'done'])->count()}})</div>
                <div  class=" statistics btn"><b><i class="fal fa-gavel"></i>
                    </b>{{ trans('messages.auction.selled') }}:؟؟</div>
{{--                <div  class=" statistics btn"><b><i class="fal fa-gavel"></i>--}}
{{--                    </b>????:??</div>--}}
{{--                <div  class=" statistics btn"><b><i class="fal fa-gavel"></i>--}}
{{--                    </b>????:??</div>--}}
            </div>
        </div>
        </div>
{{--    </div>--}}
</main>


