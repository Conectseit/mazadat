
    @inject('categories', 'App\Models\Category')
    <div class="item col-lg-2 text-center" >
        <a class="home-active hoome_icon" href="{{route('front.home')}}">
            <i class="fa fa-home "><h4 class="px-2"></h4> </i>
        </a>
    </div>
    <div class="container col-lg-10">
        <div class="owl-carousel categories-bar-carousel owl-theme">

            @foreach( App\Models\Category::where(['parent_id' => null , 'menu' => 1])->get() as $category)
                <div class="item">
                    <a class="hoome_icon" href="{{route('front.category_auctions',$category->id)}}">
                        <h5>{{$category->$name}}</h5>
                    </a>
                </div>
            @endforeach
             </div>
    </div>



