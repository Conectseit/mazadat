
    @inject('categories', 'App\Models\Category')
    <div class="item col-lg-2 text-center" >
        <a class="home-active hoome_icon" href="{{route('front.home')}}">
            <i class="fa fa-home "><h4 class="px-2"></h4> </i>
        </a>
    </div>
    <div class="container col-lg-10">
        <div class="owl-carousel categories-bar-carousel owl-theme">

            @foreach( App\Models\Category::all() as $category)
                <div class="item">
                    <a class="hoome_icon" href="{{route('front.category_auctions',$category->id)}}">
                        <h4>{{$category->$name}}</h4>
                    </a>
                </div>
            @endforeach
             </div>
    </div>



