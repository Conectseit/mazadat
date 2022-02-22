
<main class="categories-bar">
    @inject('categories', 'App\Models\Category')
    <div class="container">
        <div class="owl-carousel categories-bar-carousel owl-theme">
{{--            <div class="item">--}}
{{--                <div class="fal fa-indent" >--}}
{{--                    <a href="{{route('front.home')}}">{{trans('messages.home')}}</a>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="item">
                <a class="home-active" href="{{route('front.home')}}">
                    <i class="fal fa-indent d-inline-flex" style="font-size: large">  <h4 class="px-2">{{trans('messages.home')}}</h4> </i>
                </a>
            </div>
        @foreach( App\Models\Category::all() as $category)
            <div class="item">
                <a href="{{route('front.category_auctions',$category->id)}}">
                    <i class="fal fa-city">
                        <h4>{{$category->$name}}</h4>
                    </i>
                </a>
            </div>
            @endforeach


        </div>
    </div>
</main>

