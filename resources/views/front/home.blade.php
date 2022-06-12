@extends('front.layouts.master')
@section('title', trans('messages.home'))
@section('style')
    <style>

        .statistics {
            text-align: center;
            border: 1px solid #fff;
            padding: 3px ;
            margin-top: 10px;margin-bottom: 10px;
            color: #1e3c48;
            font-size: 12px;
            width: 220px;
            /*background: #1e3c48;*/
        }
        .add-auction.btn {
            text-align: center;
            border: 1px solid #fff;
            padding: 8px;
            color: #fff;
            font-size: 20px;
            background: #1e3c48;
        }

        /*.count-auction.btn {*/
        /*    text-align: center;*/
        /*    !*border: 1px solid #fff;*!*/
        /*    padding: 8px;*/
        /*    color: #fff;*/
        /*    font-size: 20px;*/
        /*    background: #d1915c;*/
        /*    width: 357px;*/
        /*}*/
        .carousel{
            margin-top: 40px;
            /*border-radius: 20px;*/
        }
        .carousel-item{
            width: 100%;
            height: 350px;
        }
        .carousel-item img {
            height: 100%;
            width: 100%;
            border-radius: 20px;
            border: 1px solid;
        }




        /*.notification-message-unread {*/
        /*    float: right;*/
        /*    text-align: center;*/
        /*    color: gainsboro;*/
        /*    font-size: 17px;*/
        /*    !*color: #666;*!*/
        /*    !*background: white;*!*/
        /*    padding-left: 10px;*/
        /*    display: block;*/
        /*    position: relative;*/
        /*    width: 200px;*/
        /*    height: 45px;*/
        /*    background-color: red;*/
        /*    animation: blinker 1s linear infinite;*/
        /*    border-radius: 20px;*/
        /*    margin-bottom: 10px;*/
        /*    padding-top: 10px;*/
        /*}*/

        /*@keyframes blinker {*/
        /*    50% {*/
        /*        background-color: blue;*/
        /*    }*/
        /*}*/















        /*.category-items-page .items .card.gallery-card .card-body {*/
        /*    background: #1e3c48;*/
        /*}*/
        /*.category-items-page .items .card.gallery-card .card-title {*/
        /*    text-align: center; position: static;*/
        /*}*/

        /*.category-items-page .items .card.gallery-card {*/
        /*    border: 0px solid transparent;*/
        /*    transition: .3s ease-in-out;*/
        /*    border-radius: 30px;*/
        /*}*/

        /*.category-items-page .items .card.gallery-card:hover {*/
        /*    border: 10px solid #1e3c48; opacity: .9;*/
        /*}*/


        .ad {
            float: right;
            text-align: center;
            color: gainsboro;
            font-size: 17px;
            padding-left: 10px;
            display: block;
            position: relative;
            width: 200px;
            height: 45px;
            background-color: var(--main-color);
            border-radius: 20px;
            margin-bottom: 10px;
            padding-top: 10px;
            padding-right: 10px;
            animation-duration: 2s;
            animation-iteration-count: infinite;
            animation-name: hideBtn;
            opacity: 1;
        }

        @keyframes hideBtn {
            0% {
                opacity: 1;
            }
            50% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

    </style>
@endsection

@include('front.layouts.splash')

@section('content')
{{--    @include('front.layouts.parts.nav_home')--}}
    @include('front.layouts.parts.alert')
    <div class="mt-0">
        <div class="row">
            <div class="col-md-10 col-sm-2 mx-auto" dir="{{ direction() }}">

                <div id="carouselExample" class="carousel slide w-100" data-bs-ride="carousel" data-bs-interval="3000">


{{--                    <div class="row">--}}
{{--                        <div class=" col-lg-3 col-md-3">--}}
{{--                                <div class="notification-message-unread ">{{ trans('messages.ad-auctions') }}</div>--}}
{{--                        </div>--}}
{{--                    </div>--}}


                    <div class="row">
                        <div class=" col-lg-3 col-md-3">
                            <div class="ad">{{ trans('messages.ad-auctions') }}</div>
                        </div>
                    </div>
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0"
                                class="active"></button>
                        <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2"></button>
                    </div>
                    <div class="carousel-inner">

                        <div class="carousel-item active">
                            <a href="{{$advertisements->count() > 0 ? $advertisements->first()->ImagePath : asset('uploads/mazadat_logo.jpg') }}"
                               data-popup="lightbox">
                                <img class="d-block" src="
{{--                    https://www.cs.ucy.ac.cy/courses/EPL425/labs/LAB10/slide1.jpg" --}}
                                {{$advertisements->count() > 0 ? $advertisements->first()->ImagePath : asset('uploads/mazadat_logo.jpg') }}"
                                     alt="First slide">
                            </a>

                                <div class="carousel-caption d-none d-md-block">
                                    <h4>{{$advertisements->count() > 0 ? $advertisements->first()->$name : 'mazadat' }}</h4>
                                </div>
                        </div>

                        @foreach($advertisements as $advertisement)
                            @if(!$loop->first)
                                <div class="carousel-item">

                                  <div class="slider_image" style="height: 100%; width: 100%">
                                      <a href="{{ $advertisement->ImagePath }}" data-popup="lightbox">
                                          <img class="d-block" src="{{ $advertisement->ImagePath }}"
                                               alt="Second slide" style="height: 100%; width: 100%">
                                      </a>
                                  </div>
                                    <div class="carousel-caption d-none d-md-block">
                                        <h4>{{ isNullable($advertisement->$name) }}</h4>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </div>
                    <button class="carousel-control-prev" data-bs-target="#carouselExample" type="button"
                            data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" data-bs-target="#carouselExample" type="button"
                            data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>






    <div class="category-items-page">
{{--        <section class="items" dir="{{ direction() }}">--}}
{{--            <div class="container">--}}
{{--                @inject('auctions', 'App\Models\Auction')--}}
{{--                <div class="row">--}}
{{--                    <div class=" d-flex justify-content-between">--}}
{{--                    <div class=" col-lg-8 col-md-8">--}}
{{--                        <div class=" statistics btn"><b><i class="fal fa-gavel"></i>--}}
{{--                            </b>{{ trans('messages.auction.count_of_on_progress') }}--}}
{{--                            :({{$auctions->where(['status'=>'on_progress','is_accepted'=>1])->count()}})--}}
{{--                        </div>--}}
{{--                        <div class=" statistics btn"><b><i class="fal fa-gavel"></i>--}}
{{--                            </b>{{ trans('messages.auction.count_of_done') }}:({{$auctions->where(['status'=>'done'])->count()}})--}}
{{--                        </div>--}}
{{--                        <div class=" statistics btn"><b><i class="fal fa-gavel"></i>--}}
{{--                            </b>{{ trans('messages.auction.selled') }}:؟؟--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}


{{--                --}}{{--                <div class="row">--}}
{{--                --}}{{--                    <div class=" d-flex justify-content-between">--}}
{{--                --}}{{--                        @if(auth()->check())--}}
{{--                --}}{{--                            @if(auth()->user()->is_verified==1)--}}
{{--                --}}{{--                        <a href="{{route('front.show_add_auction')}}" class="add-auction btn "><b> <i--}}
{{--                --}}{{--                                    class="fal fa-plus-circle"></i> </b>{{ trans('messages.auction.add') }}</a>--}}
{{--                --}}{{--                            @endif--}}
{{--                --}}{{--                        @endif--}}
{{--                --}}{{--                        <a href="{{route('front.all_companies')}}" class="add-auction btn"><b> <i--}}
{{--                --}}{{--                                    class="fal fa-gavel"></i> </b>{{ trans('messages.company.companies_auctions') }}</a>--}}
{{--                --}}{{--                    </div>--}}
{{--                --}}{{--                </div>--}}
{{--                <br>--}}
{{--                <h1 style="color: #d1915c;"> {{__('messages.categories')}}</h1><br>--}}
{{--                <div class="row">--}}

{{--                    @foreach($categories as $category)--}}
{{--                        <div class="col-lg-4 col-md-6" id="viewItem">--}}
{{--                            <div class="card gallery-card" id="itemCard"--}}
{{--                                 style="background: url({{ $category->ImagePath }}) center center no-repeat">--}}
{{--                                <a href="{{route('front.category_auctions',$category->id)}}" class="image">--}}
{{--                                    <div class="overlay">--}}

{{--                                    </div>--}}
{{--                                    --}}{{--                                    <img src="{{ $category->ImagePath }}" alt="card-img">--}}
{{--                                </a>--}}
{{--                                <div class="card-body">--}}
{{--                                    <h3 class="card-title">{{$category->$name}}</h3>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}






        <section class="categories" dir="{{ direction() }}">

            <div class="container">
                @inject('auctions', 'App\Models\Auction')
                <div class="row">
                    {{--                    <div class=" d-flex justify-content-between">--}}
                    <div class=" col-lg-3 col-md-3">
                        <div class=" statistics "><b>
                            </b>{{ trans('messages.auction.count_of_on_progress') }}
                            :({{$auctions->where(['status'=>'on_progress','is_accepted'=>1])->count()}})
                        </div>
                        <div class=" statistics "><b><i class="fal fa-check-circle"style="color: white;background-color: green;" ></i>
                            </b>{{ trans('messages.auction.count_of_done') }}:({{$auctions->where(['status'=>'done'])->count()}})
                        </div>
                    </div>

                    <div class=" col-lg-6 col-md-6">
                    </div>
                    <div class=" col-lg-3 col-md-3">
                      <a href="{{route('front.unique_auction')}}" class="add-auction btn"><b> <i class="fal fa-gavel"></i> </b>{{trans('messages.auction.unique')}}</a>
                    </div>

                </div>

                <h2 style="color: var(--main-color); text-align: center"> {{__('messages.categories')}}</h2><br>
                <div class="row">
                    @foreach($categories as $category)
                        <div class="col-lg-3 col-md-6" >
                            <a href="{{route('front.category_auctions',$category->id)}}" class="cate-card" dir="{{ direction() }}">
{{--                                <i class="fal fa-city"></i>--}}
                                <img src="{{ $category->ImagePath }}" alt="" width="80" height="80"  class="img-circle" >
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
    <script></script>
@endpush
