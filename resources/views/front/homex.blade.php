@extends('front.layouts.master')
@section('title', trans('messages.home'))
@section('style')
    <style>
        .statistics {
            text-align: center;
            border: 1px solid #fff;
            padding: 3px;
            margin-top: 10px;
            margin-bottom: 10px;
            background-color: #1e3c48;
            font-size: 12px;
            width: 220px;
            color: white;
        }

        .add-auction.btn {
            text-align: center;
            border: 1px solid #fff;
            padding: 8px;
            color: #fff;
            font-size: 20px;
            background: #1e3c48;
        }



        a{
            text-decoration: none;
        }
        .slider {
            background: grey;
            color: #222;
            font-family: arial;
            font-weight: bold;
            width: 852.406px;
            height: 386px;
            display: flex;
            overflow-x: hidden;

        }
        .slide {
            width: 260px;
            margin-right: 10px;
            margin-top: 70px;
            margin-left: 10px;
            height: 256px;
            background: white;
            border: 0.5px solid yellow;
            border-radius: 10px;
            position: relative;
        }
        .slideImg{
            width: 260px;
            height: 163px;
            object-fit: cover;
            object-position: 50% 0;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .title{
            font-size: 17px;
            margin-right: 12px;
            margin-left: 12px;
            margin-top: 10px;
            padding-bottom: 10px;
            color: #333333;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;

        }
        div.slide{
            text-overflow: ellipsis;
        }
        .btnLeft,.btnRight{
            top: 180px;
            width: 40px;
            height: 100px;
            margin-top: -22px;
            border: none;
            opacity: 90%;
            background: orange;
            position: absolute;

        }
        .btnRight{
            margin-left: 812px;
        }
        .btnRight:hover, .btnLeft:hover{
            opacity: 50%;
        }
        .view{
            position: sticky;
            width: 260px;
            height: 30px;
            background: rgb(1,1,1,80%);
            color: white;
            margin-top: 133px;
            text-align: center;
        }
        .page{
            margin-top: 360px;
            margin-left: 426.2px;

        }
        .pageNumber{
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: white;
            position: sticky;
            float: left;
            margin-right: 4px;

        }
        .active{
            background: orange;
        }

    </style>
@endsection

@include('front.layouts.splash')

@section('content')
    {{--    @include('front.layouts.parts.nav_home')--}}
    @include('front.layouts.parts.alert')
    <div class="mt-0">
        <div class="row">
            <div class="col-md-12 col-sm-2 mx-auto" dir="{{ direction() }}">

                <div style="  -webkit-box-align:center;-webkit-box-pack:center;display:-webkit-box;transform: translateY(20%);">
                    <div style='position: relative;scale:1.2'>
                        <div class="slider">

                            @foreach($advertisements as $advertisement)
                            <a href="">
                                <div class="slide">
                                    <div style="position: absolute;">
                                        <div class="view"><p style="padding-top: 7px;">1.000.000 views</p></div>
                                    </div>
                                    <img class="slideImg" src="{{ $advertisement->ImagePath }}">
                                    <div class="title">Title ...</div>
                                </div>
                            </a>
                            @endforeach

                        </div>

                        <div id="absolute" style="position: absolute;top:0px">
                            <p style="position: absolute;font-size: 24px;color: #222222;margin-left: 65px;white-space: nowrap;font-family: arial;font-weight: bold;">NEWS</p>
                            <button class="btnLeft" onclick="to_left()"><</button>
                            <button class="btnRight" onclick="to_right()">></button>
                            <div class="page">

                            </div>
                        </div>

                    </div>
                </div>

                <br>
                <br>
                <br>

            </div>
        </div>
    </div>
    <div class="category-items-page">
        <section class="categories" dir="{{ direction() }}">

            <div class="container">
                @inject('auctions', 'App\Models\Auction')
                <div class="row">
                    <div class=" col-lg-3 col-md-3">
                        <div class=" statistics ">
                            <img src="{{asset('Front/assets/imgs/icon/p_auction.png')}}" alt="logo" width="50"
                                 height="50">

                            <b>
                            </b>{{ trans('messages.auction.count_of_on_progress') }}
                            :({{$auctions->where(['status'=>'on_progress','is_accepted'=>1])->count()}})
                        </div>
                        <div class="statistics ">
                            <img src="{{asset('Front/assets/imgs/icon/d_auction.png')}}" alt="logo" width="50"
                                 height="50">

                            <b>
                                {{--                                <i class="fal fa-check-circle" style="color: white;background-color: green;"></i>--}}
                                <i class="fal fa-done" style="color: white;background-color: green;"></i>
                            </b>{{ trans('messages.auction.count_of_done') }}
                            :({{$auctions->where(['status'=>'done'])->count()}})
                        </div>
                    </div>
                    <div class=" col-lg-6 col-md-6">
                    </div>
                    {{--                    <div class=" col-lg-3 col-md-3">--}}
                    {{--                        <a href="{{route('front.unique_auction')}}" class="add-auction btn"><b> <i--}}
                    {{--                                    class="fal fa-gavel"></i> </b>{{trans('messages.auction.unique')}}</a>--}}
                    {{--                    </div>--}}
                </div>
                <h2 style="color: var(--main-color); text-align: center"> {{__('messages.categories')}}</h2><br>
                <div class="row">
                    @foreach($categories as $category)
                        <div class="col-lg-3 col-md-6">
                            <a href="{{route('front.category_auctions',$category->id)}}" class="cate-card"
                               dir="{{ direction() }}">
                                <img src="{{ $category->ImagePath }}" alt="" width="80" height="80" class="img-circle">
                                <h4 style="padding-top: 30px;">{{$category->$name}}</h4>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@stop

@push('scripts')
    <script>

        const timer = ms => new Promise(res => setTimeout(res, ms));
        var slidePage = 0
        var slidePageNumber = 0

        function active(position){
            var activing = document.getElementsByClassName('active')[0]
            if(activing){
                activing.className = activing.className.replace("active","")
            }
            document.getElementsByClassName("pageNumber")[position].className += " active"
        }

        async function to_right(){
            var a = document.getElementsByClassName('slider')[0]
            var position = a.scrollLeft
            for(var i = position; i <= position + 840; i+=10){
                a.scrollLeft = i
                await timer(1)
            }
            if(slidePage < slidePageNumber - 1){
                slidePage += 1
                active(slidePage)
            }


        }
        async function to_left(){
            var a = document.getElementsByClassName('slider')[0]
            var position = a.scrollLeft
            for(var i = position; i >= position - 840; i-=10){
                a.scrollLeft = i
                await timer(1)
            }
            if(slidePage > 0){
                slidePage -= 1
                active(slidePage)
            }

        }
        function page(){
            var a = document.getElementsByClassName("slide")
            var length = a.length
            var du = length % 3
            var count = (length - du)/3
            if(du >= 1){
                count += 1
            }
            slidePageNumber = count
            for(var i = 0; i < count; i++){
                var html = '<div class="pageNumber"></div>';
                document.getElementsByClassName('page')[0].insertAdjacentHTML('beforeend', html);
                var element = document.querySelector('.page')
                var style = getComputedStyle(element)
                var left = style.marginLeft
                var number = left.replace("px","")
                number = Number(number)
                number -= 7
                document.getElementsByClassName("page")[0].style.marginLeft = number+"px"
            }
            //...
        }
        async function autoshow(){
            i = 0
            while(1){
                await timer(2000)
                to_right()
                i += 1
                var a = document.getElementsByClassName('slider')[0]
                var position = a.scrollLeft
                if(slidePage == slidePageNumber-1){
                    i = 0
                    for(var j = position; j >= 0; j-=10){
                        a.scrollLeft = j
                        await timer(0)
                    }
                    slidePage = 0
                    active(0)
                }
            }
        }
        page()
        active(0)
        autoshow()
    </script>
@endpush
