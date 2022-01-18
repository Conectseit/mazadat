
<main class="categories-bar">
{{--    @inject('categories', 'App\Models\Category')--}}
    <div class="container">
        <div class="owl-carousel categories-bar-carousel owl-theme">
            <div class="item fal fa-indent" >
                <a href="{{route('front.home')}}">{{trans('messages.home')}}</a>
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
