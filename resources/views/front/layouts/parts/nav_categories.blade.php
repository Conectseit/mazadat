
    @inject('categories', 'App\Models\Category')
    <div class="item col-lg-2 text-center" >
        <a class="home-active" href="{{route('front.home')}}">
            <i class="fa fa-home "><h4 class="px-2"></h4> </i>
        </a>
    </div>
    <div class="container col-lg-10">
        <div class="owl-carousel categories-bar-carousel owl-theme">

            @foreach( App\Models\Category::all() as $category)
                <div class="item">
                    <a href="{{route('front.category_auctions',$category->id)}}">
                        <h4>{{$category->$name}}</h4>

{{--                        <i class="fal fa-city">--}}
{{--                            <h4>{{$category->$name}}</h4>--}}
{{--                        </i>--}}
                    </a>
                </div>
            @endforeach
             </div>
    </div>









{{--<main class="categories-bar">--}}
{{--    @inject('categories', 'App\Models\Category')--}}
{{--    <div class="container">--}}
{{--        <div class="owl-carousel categories-bar-carousel owl-theme">--}}
{{--            --}}{{--            <div class="item">--}}
{{--            --}}{{--                <div class="fal fa-indent" >--}}
{{--            --}}{{--                    <a href="{{route('front.home')}}">{{trans('messages.home')}}</a>--}}
{{--            --}}{{--                </div>--}}
{{--            --}}{{--            </div>--}}
{{--            <div class="item">--}}
{{--                <a class="home-active" href="{{route('front.home')}}">--}}
{{--                    <i class="fal fa-indent d-inline-flex" style="font-size: large">  <h4 class="px-2">{{trans('messages.home')}}</h4> </i>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--                <div class="item">--}}
{{--                            <h6>{{ trans('messages.auction_on_progress') }}55</h6>--}}
{{--                </div>--}}
{{--                <div class="item">--}}
{{--                            <h6>{{ trans('messages.auction_ended') }}55</h6>--}}
{{--                </div>--}}
{{--            <div class="item">--}}
{{--               <h6> {{ trans('messages.auction_selled') }}55</h6>--}}
{{--                </div>--}}


{{--        </div>--}}
{{--    </div>--}}
{{--</main>--}}



