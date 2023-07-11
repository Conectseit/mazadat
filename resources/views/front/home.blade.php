@extends('front.layouts.master')

@section('meta_description')
    <meta name="description" content="{{App\Models\Setting::where('key',$site_meta_description)->first()->value}}"/>
@stop
@section('meta_title')
    <meta name="title" content="{{App\Models\Setting::where('key',$site_meta_title)->first()->value}}"/>
@stop
@section('meta_keywords')
    <meta name="keywords" content="{{App\Models\Setting::where('key',$site_meta_keywords)->first()->value}}"/>
@stop

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
        .carousel {
            /*margin-top: 40px;*/
            /*background-color: var(--secondary-color);*/
        }
        .carousel-item {
            width: 100%;
            height: 380px;
            /*background-color: rgba(0, 0, 0, 0.5);*/
        }
        .carousel-item img {
            height: 100%;
            width: 100%;
            border-radius: 10px;
            border: 1px solid;
        }
        .slider_image {
            width: 750px;
        }
        .carousel img:hover {
            color: white;
            transform: scale(1.2);
            transition: .5s;

        }
        .carousel-control-prev-icon, .carousel-control-next-icon {
            background-color: var(--main-color);
        }
    </style>
@endsection

@include('front.layouts.splash')

@section('content')
    {{--    @include('front.layouts.parts.nav_home')--}}
    @include('front.layouts.parts.alert')
    <center>
        <div class="row">
            <div class="col-md-12 col-sm-2 mx-auto w-100" dir="{{ direction() }}">
                <div id="carouselExample" class="carousel slide w-100" data-bs-ride="carousel"
                     data-bs-interval="3000">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0"
                                class="active"></button>
                        @foreach($advertisements as $advertisement)
                            <button type="button" data-bs-target="#carouselExample"
                                    data-bs-slide-to={{$advertisement->id}}></button>
                        @endforeach
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="slider_image" style="height: 100%; width: 100%;">
                                <a href="{{$advertisements->count() > 0 ? $advertisements->first()->ImagePath : asset('uploads/mazadat_logo.jpg') }}"
                                   data-popup="lightbox">
                                    <img class="d-block"
                                         src="{{$advertisements->count() > 0 ? $advertisements->first()->ImagePath : asset('uploads/mazadat_logo.jpg') }}"
                                         alt="First slide" style="height: 100%; width: 100%;">
                                </a>
                            </div>

                            <div class="carousel-caption d-none d-md-block">
                                <h4>{{$advertisements->count() > 0 ? $advertisements->first()->$name : 'mazadat' }}</h4>
                            </div>
                        </div>
                        @foreach($advertisements as $advertisement)
                            @if(!$loop->first)
                                <div class="carousel-item">
                                    <div class="slider_image" style="height: 100%; width: 100%;">
                                        <a href="{{ $advertisement->ImagePath }}" data-popup="lightbox">
                                            <img class="d-block" src="{{ $advertisement->ImagePath }}"
                                                 alt="Second slide" style="height: 100%; width: 100%;">
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
    </center>
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
                        {{--                        <div class="statistics ">--}}
                        {{--                            <img src="{{asset('Front/assets/imgs/icon/d_auction.png')}}" alt="logo" width="50"--}}
                        {{--                                 height="50">--}}

                        {{--                            <b>--}}
                        {{--                                                                <i class="fal fa-check-circle" style="color: white;background-color: green;"></i>--}}
                        {{--                                <i class="fal fa-done" style="color: white;background-color: green;"></i>--}}
                        {{--                            </b>{{ trans('messages.auction.count_of_done') }}--}}
                        {{--                            :({{$auctions->where(['status'=>'done'])->count()}})--}}
                        {{--                        </div>--}}
                    </div>
                    <div class=" col-lg-6 col-md-6">
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
                    <div class=" col-lg-3 col-md-3">
                        @if(auth()->check())

                            @if(auth()->user()->is_verified==1)
                                <a class="add-auction btn"
                                   href="{{route('front.show_add_auction')}}" style=" box-shadow: 5px 10px #888888;"> <i
                                        class="fal fa-plus-circle"> </i> @lang('messages.auction.add_your_auction')</a>
                            @endif
                        @endif
                    </div>
                    {{--                    <div class=" col-lg-3 col-md-3">--}}
                    {{--                        <div class="statistics ">--}}
                    {{--                            <img src="{{asset('Front/assets/imgs/icon/d_auction.png')}}" alt="logo" width="50"--}}
                    {{--                                 height="50">--}}
                    {{--                            <b>--}}
                    {{--                                --}}{{--                                <i class="fal fa-check-circle" style="color: white;background-color: green;"></i>--}}
                    {{--                                <i class="fal fa-done" style="color: white;background-color: green;"></i>--}}
                    {{--                            </b>{{ trans('messages.auction.count_of_done') }}--}}
                    {{--                            :({{$auctions->where(['status'=>'done'])->count()}})--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    {{--                                        <div class=" col-lg-3 col-md-3">--}}
                    {{--                                            <a href="{{route('front.unique_auction')}}" class="add-auction btn"><b> <i--}}
                    {{--                                                        class="fal fa-gavel"></i> </b>{{trans('messages.auction.unique')}}</a>--}}
                    {{--                                        </div>--}}
                </div><br><br><br>
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
@push('scripts')@endpush
