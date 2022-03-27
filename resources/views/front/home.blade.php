@extends('front.layouts.master')
@section('title', trans('messages.home'))
@section('style')
    <style>

        .statistics.btn {
            text-align: center;
            border: 1px solid #fff;
            padding: 8px;
            color: #fff;
            font-size: 12px;
            background: #1e3c48;
        }

        .add-auction.btn {
            text-align: center;
            border: 1px solid #fff;
            padding: 8px;
            color: #fff;
            font-size: 20px;
            background: #1e3c48;
        }

        .count-auction.btn {
            text-align: center;
            /*border: 1px solid #fff;*/
            padding: 8px;
            color: #fff;
            font-size: 20px;
            background: #d1915c;
            width: 357px;
        }

        .carousel-item img {
            height: 350px;
            /*border: 1px solid;*/
        }

        .category-items-page .items .card.gallery-card .card-body {
            background: #1e3c48;
        }

        /*//*/
        .category-items-page .items .card.gallery-card .card-title {
            text-align: center;
            position: static;
        }

        .category-items-page .items .card.gallery-card {
            border: 0px solid transparent;
            transition: .3s ease-in-out;
            border-radius: 30px;
        }

        .category-items-page .items .card.gallery-card:hover {
            border: 10px solid #1e3c48;
            opacity: .9;
        }

        /*    */

    </style>
@endsection

@include('front.layouts.splash')

@section('content')
    @include('front.layouts.parts.nav_home')
    @include('front.layouts.parts.alert')
    <div class="mt-0">

        <div class="row">

            <div class="col-md-10 col-5 mx-auto">
                <div id="carouselExample" class="carousel slide w-100" data-bs-ride="carousel" data-bs-interval="3000">
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
                                <img class="d-block w-100" src="
{{--                    https://www.cs.ucy.ac.cy/courses/EPL425/labs/LAB10/slide1.jpg" --}}
                                {{$advertisements->count() > 0 ? $advertisements->first()->ImagePath : asset('uploads/mazadat_logo.jpg') }}"
                                     alt="First slide">
                            </a>

                            <div class="carousel-caption d-none d-md-block">
                                <h5>{{$advertisements->count() > 0 ? $advertisements->first()->$name : 'mazadat' }}</h5>
                                {{--                        <p>University Campus</p>--}}
                            </div>
                        </div>

                        @foreach($advertisements as $advertisement)
                            @if(!$loop->first)
                                <div class="carousel-item">

                                    <a href="{{ $advertisement->ImagePath }}" data-popup="lightbox">
                                        <img class="d-block w-100" src="{{ $advertisement->ImagePath }}"
                                             alt="Second slide">
                                    </a>
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>{{ isNullable($advertisement->$name) }}</h5>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        {{--                <div class="carousel-item">--}}
                        {{--                    <img class="d-block w-100" src="https://www.cs.ucy.ac.cy/courses/EPL425/labs/LAB10/slide3.jpg" alt="Third slide">--}}
                        {{--                    <div class="carousel-caption d-none d-md-block">--}}
                        {{--                        <h5>Faculty of Engineering</h5>--}}
                        {{--                        <p>University Campus</p>--}}
                        {{--                    </div>--}}
                        {{--                </div>--}}
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



    {{--        <section class="categories">--}}

    {{--        <div class="container">--}}
    {{--            <div class="row">--}}
    {{--                <div class=" d-flex justify-content-between" >--}}
    {{--                    <a href="{{route('front.show_add_auction')}}" class="add-auction btn "><b>  <i class="fal fa-plus-circle"></i>  </b>{{ trans('messages.auction.add') }}</a>--}}

    {{--                    <a href="{{route('front.all_companies')}}" class="add-auction btn"><b>  <i class="fal fa-gavel"></i>  </b>{{ trans('messages.company.companies_auctions') }}</a>--}}
    {{--                </div>--}}
    {{--            </div><br>--}}
    {{--            <div class="row">--}}
    {{--                @foreach($categories as $category)--}}
    {{--                <div class="col-lg-3 col-md-6">--}}
    {{--                    <a href="{{route('front.category_auctions',$category->id)}}" class="cate-card">--}}
    {{--                        <i class="fal fa-city"></i>--}}
    {{--                        <img src="{{ $category->ImagePath }}" alt="" width="50" height="50" class="img-circle ">--}}

    {{--                        <h4>{{$category->$name}}</h4>--}}
    {{--                    </a>--}}
    {{--                </div>--}}
    {{--                @endforeach--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}


    <div class="category-items-page">
        <section class="items">
            <div class="container">
                @inject('auctions', 'App\Models\Auction')
                <div class="row">
{{--                    <div class=" d-flex justify-content-between">--}}
                    <div class=" col-lg-8 col-md-8">
                        <div class=" statistics btn"><b><i class="fal fa-gavel"></i>
                            </b>{{ trans('messages.auction.on_progress') }}
                            :({{$auctions->where(['status'=>'on_progress','is_accepted'=>1])->count()}})
                        </div>
                        <div class=" statistics btn"><b><i class="fal fa-gavel"></i>
                            </b>{{ trans('messages.auction.done') }}:({{$auctions->where(['status'=>'done'])->count()}})
                        </div>
                        <div class=" statistics btn"><b><i class="fal fa-gavel"></i>
                            </b>{{ trans('messages.auction.selled') }}:؟؟
                        </div>
                    </div>
                </div>


                {{--                <div class="row">--}}
                {{--                    <div class=" d-flex justify-content-between">--}}
                {{--                        @if(auth()->check())--}}
                {{--                            @if(auth()->user()->is_verified==1)--}}
                {{--                        <a href="{{route('front.show_add_auction')}}" class="add-auction btn "><b> <i--}}
                {{--                                    class="fal fa-plus-circle"></i> </b>{{ trans('messages.auction.add') }}</a>--}}
                {{--                            @endif--}}
                {{--                        @endif--}}
                {{--                        <a href="{{route('front.all_companies')}}" class="add-auction btn"><b> <i--}}
                {{--                                    class="fal fa-gavel"></i> </b>{{ trans('messages.company.companies_auctions') }}</a>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                <br>
                <h1 style="color: #d1915c;"> الأقسام والتصنيفات ::</h1><br>
                <div class="row">

                    @foreach($categories as $category)
                        <div class="col-lg-4 col-md-6" id="viewItem">
                            <div class="card gallery-card" id="itemCard"
                                 style="background: url({{ $category->ImagePath }}) center center no-repeat">
                                <a href="{{route('front.category_auctions',$category->id)}}" class="image">
                                    <div class="overlay">

                                    </div>
                                    {{--                                    <img src="{{ $category->ImagePath }}" alt="card-img">--}}
                                </a>
                                <div class="card-body">
                                    <h3 class="card-title">{{$category->$name}}</h3>
                                </div>
                            </div>
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
