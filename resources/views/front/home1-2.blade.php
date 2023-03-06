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


        /*.ad {*/
        /*    float: right;*/
        /*    text-align: center;*/
        /*    color: gainsboro;*/
        /*    font-size: 17px;*/
        /*    padding-left: 10px;*/
        /*    display: block;*/
        /*    position: relative;*/
        /*    width: 200px;*/
        /*    height: 45px;*/
        /*    background-color: var(--main-color);*/
        /*    border-radius: 20px;*/
        /*    margin-bottom: 10px;*/
        /*    padding-top: 10px;*/
        /*    padding-right: 10px;*/
        /*    animation-duration: 2s;*/
        /*    animation-iteration-count: infinite;*/
        /*    animation-name: hideBtn;*/
        /*    opacity: 1;*/
        /*}*/

        /*@keyframes hideBtn {*/
        /*    0% {*/
        /*        opacity: 1;*/
        /*    }*/
        /*    50% {*/
        /*        opacity: 0;*/
        /*    }*/
        /*    100% {*/
        /*        opacity: 1;*/
        /*    }*/
        /*}*/
        .carousel-control-prev-icon,.carousel-control-next-icon {
            background-color: var(--main-color);
        }

        .owl-carousel{
            background-color: var(--secondary-color);
            height: 400px;
        }
        .owl-carousel img{
            width: 80%;
            height: 100%;
        }

    </style>
@endsection

@include('front.layouts.splash')

@section('content')
    {{--    @include('front.layouts.parts.nav_home')--}}
    @include('front.layouts.parts.alert')

<center>
    <div class="row">
        <div class="col-md-12 col-sm-2 mx-auto" dir="{{ direction() }}">

                <div class="owl-carousel categories-bar-carousel owl-theme">

                    @foreach($advertisements as $advertisement)
                        <div class="item">
                            <a class="" href="{{ $advertisement->ImagePath }}" data-popup="lightbox">
                                <img src="{{ $advertisement->ImagePath }}" alt="image" />
                            </a>

                        </div>
                    @endforeach
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
{{--                                --}}{{--                                <i class="fal fa-check-circle" style="color: white;background-color: green;"></i>--}}
{{--                                <i class="fal fa-done" style="color: white;background-color: green;"></i>--}}
{{--                            </b>{{ trans('messages.auction.count_of_done') }}--}}
{{--                            :({{$auctions->where(['status'=>'done'])->count()}})--}}
{{--                        </div>--}}
                    </div>
                    <div class=" col-lg-6 col-md-6">
                    </div>
                    <div class=" col-lg-3 col-md-3">
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


{{--                                        <div class=" col-lg-3 col-md-3">--}}
{{--                                            <a href="{{route('front.unique_auction')}}" class="add-auction btn"><b> <i--}}
{{--                                                        class="fal fa-gavel"></i> </b>{{trans('messages.auction.unique')}}</a>--}}
{{--                                        </div>--}}
                </div>
                <br>
                <br>
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

@endpush
