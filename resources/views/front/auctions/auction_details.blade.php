@extends('front.layouts.master')
@section('title', trans('messages.auction.auction_details'))
@section('style')
    <style>
        #map { height: 400px; border: solid 1px; padding-right: 20px; }
        .carousel-item img { height: 400px; border: solid 1px; }
    </style>
@endsection

@section('content')
    <main class="categories-bar row m-auto">
        @include('front.layouts.parts.nav_categories')
    </main>
    <div class="ad-details-page">
        <main class="ad-main-details">
            <div class="container">
                <div class="row">


                    @include('front.layouts.parts.make_bid_alert')
                    @if($auction->status=='on_progress')
                        <div class="col-lg-2 d-flex align-items-center">
                        </div>
                        <div class="col-lg-4 d-flex align-items-center">
                            <a href="{{ url()->previous() }}" class="mt-2 mx-1 back"> <i
                                    class="fal fa-arrow-circle-right"></i> </a>

                            <div id="countdown" style="margin-right: -141px; background: #d1915c;">
                                <h5 class="text-center mx-auto my-1 "
                                    style=" background: black;">{{__('messages.auction.remaining_time')}}
                                    : <i class="fal fa-clock"> </i>
                                </h5>
                                <div class="labels">
                                    <li>Days</li>
                                    <li>Hours</li>
                                    <li>Mins</li>
                                    <li>Secs</li>
                                </div>
                                <div class="labels">
                                    <li id="days"></li>
                                    <li id="hours"></li>
                                    <li id="minutes"></li>
                                    <li id="seconds"></li>
                                </div>
                            </div>

                        </div>
                        @if(auth()->check())
                            @if(auth()->user()->is_verified == 1 )
                                @if(auth()->user()->id != $auction->seller_id)

                                    <div class="col-lg-2 d-flex align-items-center" id="bid">
                                        <a href="#" class="bid-btn"> {{ trans('messages.auction.bid_now')}}</a>
                                    </div>
                                @endif
                            @endif
                            @if(auth()->user()->is_verified == 0 )
                                <div class="col-lg-6 d-flex align-items-center">
                                    <a href="{{route('front.show_complete_profile')}}"> {{ trans('messages.please_complete_your_data_to_could_make_bid')}}
                                        --></a>
                                </div>
                            @endif

                        @endif
                    @endif
                    <div class="col-lg-6 d-flex align-items-center justify-content-end" id="bidMainInfo">
                        <div class="current-price">
                            <p>{{ trans('messages.auction.current_price')}}:</p>
                            <h4>{{($auction->current_price)}}</h4>
                        </div>
                        <div class="min-increment">
                            <p> {{ trans('messages.auction.value_of_increment')}}:</p>
                            <h4>{{($auction->value_of_increment)}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <section class="ad-info" dir="{{ direction() }}">
            <div class="container">
                <div class="row"style="margin-bottom:20px ;">
                    <div class="col-lg-12" >
                        <h4 class="ad-title">{{ ($auction->category->$description )}}</h4>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <h4 class="ad-title">
                            <a href="{{ route('front.category_auctions',$auction->category->id) }}"
                               class="mt-2 mx-1 back"> <i
                                    class="fal fa-arrow-circle-{{ floating('right','left') }}"
                                    style="color: black;"></i>
                            </a>
                            {{ trans('messages.category.category')}} ({{ ($auction->category->$name )}})
                        </h4>
                        <div class="main-image" style="height: 200px;">
                            <img src="{{$auction->first_image_path}}" alt="image" class="img-thumbnail">
                        </div>
                    </div>

                    <div class="col-lg-9">
                        <div class="row ">
                            <div class="col-lg-6">

                                <div class="details" id="details">
                                    <h4>{{$auction->$name}}  </h4>
                                </div>
                                <div class="details" id="details">
                                    <p class="start-date">
                                        <i class="fal fa-calendar-alt"></i>
                                        {{trans('messages.auction.start_at')}}
                                        : {{isset($auction->start_date)? ($auction->start_date->format('l, m/d/Y') ):''}}

                                    </p>
                                </div>
                                @if($auction->status=='on_progress')
                                    <div class="details" id="details">
                                        <p><i class="fal fa-clock"></i> {{trans('messages.auction.remaining_time')}}:
                                            {{--                                        {{ ($auction->remaining_time['days'] ) }}--}}
                                            <span class="test-time"> <span id="Timerapp"></span></span>
                                        </p>
                                    </div>
                                @endif

                                @if($auction->status=='done')
                                    <div class="details" id="details">
                                        <p><i class="fal fa-clock"></i> {{trans('messages.auction.remaining_time')}}:
                                            <span class="test-time">{{trans('messages.auction.done_auction')}} </span>
                                        </p>
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-6">
                                <div class="details" id="details">
                                    <h5>{{trans('messages.auction.delivery_charge')}} :
                                        {{($auction->delivery_charge)}}</h5>
                                </div>
                                <div class="details" id="details">
                                    <p>
                                        <i class="fal fa-gavel"></i>{{trans('messages.auction.start_auction_price')}}
                                        :{{($auction->start_auction_price)}}
                                    </p>
                                </div>

                                <div class="details " id="details">
                                    <p><i class="fa fa-money"></i>{{trans('messages.auction.current_price')}}
                                        :{{($auction->current_price)}}</p>
                                </div>
                                <div class="details" id="details">
                                    <p><i class="fal fa-tag"></i>{{trans('messages.auction.value_of_increment')}}
                                        :{{($auction->value_of_increment)}}</p>

                                    <p class="ticket"><i
                                            class="fa fa-users"></i> {{trans('messages.auction.buyers_count')}}
                                        :{{ ($auction->count_of_buyer ) }}
                                    </p>
                                    <p class="ticket"><i
                                            class="fal fa-user"></i> {{trans('messages.auction.seller')}} :

                                        @if($auction->seller->is_company=='person' && $auction->seller->is_appear_name==1)
                                            {{ ($auction->seller->full_name ) }}
                                        @else
                                            {{ ($auction->seller->user_name ) }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="description" id="description">
                            <h4>{{ trans('messages.description')}}:</h4>
                            <p>{{$auction->$description}}</p>
                        </div>
                        <br>
                        <div class="bid-details" id="bidDetails">
                            <form action="{{route('front.make_bid',$auction->id)}}" method="post">
                                @csrf
                                <div class="bid-input">
                                    <span class="minus" id="minuss">
                                        <i class="fal fa-minus"></i>
                                    </span>
                                    <h4>ريال سعودي</h4>
                                    <input type="number" name="buyer_offer" id="bidInput"
                                           value="{{($auction->current_price)}}"/>
                                    <span class="plus" id="pluss">
                                        <i class="fal fa-plus"></i>
                                    </span>
                                </div>

                                <div class="bid-options">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <ul>
                                                <li>
                                                    <div class="mb-3 form-check form-group">
                                                        <a href="javascript:void(0);" id="change-terms-value">
                                                            <input type="checkbox" class="form-check-input"
                                                                   id="accept-terms" name="accept_auction"
                                                            @if(auth()->check()){{ checkIsUserAccept($auction)->count()?'checked':''}}@endif
                                                            >
                                                        </a>
                                                        <label class="form-check-label" for="accept-terms"
                                                               style="color: red;">
                                                            {{ trans('messages.accept_terms')}} </label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-6">
                                            <ul>
                                                {{--                                                <li>--}}
                                                {{--                                                    <p>--}}
                                                {{--                                                        <i class="far fa-clock"></i> {{ trans('messages.auction.remaining_time')}}--}}
                                                {{--                                                        :{{$auction->remaining_time['days']}}--}}
                                                {{--                                                    </p>--}}
                                                {{--                                                </li>--}}
                                                <li>
                                                    <p class="ticket"><i
                                                            class="far fa-ticket"></i>{{ trans('messages.auction.count_of_buyer')}}
                                                        : {{ ($auction->count_of_buyer ) }}</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="bid-description">
                                    <h5>{{ trans('messages.description')}}:</h5>
                                    <p> {{$auction->$description}}</p>
                                </div>
                                <div class="sign-btn">
                                    <button type="submit" class="btn btn-primary submit-btn">
                                        {{trans('messages.auction.make_bid')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="more">
                    <div class="terms">
                        <h4>{{ trans('messages.auction.images')}}:</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-10 col-10 mx-auto">
                            <div id="carouselExample" class="carousel slide w-100" data-bs-ride="carousel"
                                 data-bs-interval="3000">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0"
                                            class="active"></button>
                                    <button type="button" data-bs-target="#carouselExample"
                                            data-bs-slide-to="1"></button>
                                    <button type="button" data-bs-target="#carouselExample"
                                            data-bs-slide-to="2"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100"
                                             {{--                                             src="https://www.cs.ucy.ac.cy/courses/EPL425/labs/LAB10/slide1.jpg"--}}
                                             src="{{$auction->first_image_path}}"
                                             alt="First slide">
                                        {{--                                        <div class="carousel-caption d-none d-md-block">--}}
                                        {{--                                            <h5>Social Facilities Center</h5>--}}
                                        {{--                                            <p>University Campus</p>--}}
                                        {{--                                        </div>--}}
                                    </div>
                                    @foreach($images as $image)
                                        <div class="carousel-item">
                                            <a href="{{$image->image_path}}" data-lightbox="roadtrip">
                                                <img class="d-block w-100" src="{{$image->image_path}}" alt="image">
                                            </a>
                                        </div>
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
                <hr>
                <div class="more-imgs">
                    <div class="terms">
                        <h4>{{ trans('messages.auction.inspection_report_images')}}:</h4>
                    </div>
                    <div class="row">
                        @foreach($auction->inspectionimages as $image)
                            <div class="col-md-3 col-6">
                                <a href="{{$image->image_path}}">
                                    <div class="image">
                                        <img src="{{$image->image_path}}" alt="image">
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <hr>

                <div class="more-imgs">
                    <div class="terms">
                        <h4>{{ trans('messages.auction.options')}}:</h4>
                    </div>
                    <div class="row">
                        @foreach($auction->auctiondata as $option)

                            <div class="col-md-3 col-6">
                                <div class="description" id="description">
                                    <h5>{{$option->option_detail->option->$name}}:</h5>
                                    <p>{{$option->option_detail->$value}}</p>
                                </div>
                                <br>
                            </div>
                        @endforeach
                    </div>
                </div>
                <hr>
                <div class="terms">
                    <h4>{{ trans('messages.auction.terms')}}:</h4>
                    <p>{{$auction->$auction_terms}}</p>
                </div>
                <hr>
                <div class="terms">
                    <h4>{{ trans('messages.auction.location')}}:</h4>
                    <div id="map" class="m-6"></div>
                </div>
            </div>

        </section>
    </div>
@stop
@push('scripts')
    @include('front.auctions.parts.auction_location_on_google_map')
    @include('front.auctions.parts.ajax')
    @include('front.auctions.parts.counter', ['auction' => $auction])
@endpush
