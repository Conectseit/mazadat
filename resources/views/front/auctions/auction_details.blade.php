@extends('front.layouts.master')
@section('title', trans('messages.auction.auction_details'))
@section('style')
    <style> #map { height: 400px;}#map1 { height: 400px;} </style>
@endsection

@section('content')
{{--    @include('front.auctions.head')--}}
    <div class="ad-details-page">
        <main class="ad-main-details">
            <div class="container">
                <div class="row">
                    @include('front.layouts.parts.make_bid_alert')


                    <div class="col-lg-5 d-flex align-items-center">
                        <a class="navbar-brand" href="{{route('front.home')}}">
                            <i class="fal fa-calendar-alt"></i>
                        </a>
                        <h3 class="ad-title">{{ ($auction->category->$name ) }}</h3>
                    </div>
                    <div class="col-lg-5" id="mainInfo">
                        <p class="start-date">
                            <i class="fal fa-calendar-alt"></i>
                            {{trans('messages.auction.start_at')}}: {{ ($auction->start_date->format('l, m/d/Y  h:s') ) }}
{{--                            Start_at: {{ ($auction->start_date->format('l, m/d/Y  h:s') ) }}--}}
                        </p>
{{--                        <p class="ticket"><i class="fal fa-ticket"></i>{{ ($auction->count_of_buyer ) }}</p>--}}
                        <div class="row">
{{--                            <div class="col-sm-4 col-6">--}}
{{--                                <p><i class="fal fa-tag"></i>{{($auction->value_of_increment)}}</p>--}}
{{--                            </div>--}}
                            <div class="col-sm-4 col-6">
                                <p><i class="fal fa-gavel"></i>{{trans('messages.auction.start_auction_price')}}{{($auction->start_auction_price)}}</p>
                            </div>
                            <div class="col-sm-4 col-6">
                                <p><i class="fal fa-gavel"></i>{{trans('messages.auction.current_price')}}:{{($auction->current_price)}}</p>
                            </div>
{{--                            <div class="col-sm-4">--}}
{{--                                <p><i class="fal fa-clock"></i>{{$auction->remaining_time}}</p>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                    <div class="col-lg-2 d-flex align-items-center" id="bid">
                        <a href="#" class="bid-btn">Bid Now</a>
                    </div>
                    <div class="col-lg-7 d-flex align-items-center justify-content-end" id="bidMainInfo">
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
        <section class="ad-info">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="main-image"   style="height: 200px;">
                            <img src="{{$auction->first_image_path}}" alt="image" class="img-thumbnail">
                        </div>
                    </div>

                    <div class="col-lg-9">

                        <div class="details" id="details">
                            <h4>{{$auction->$name}}</h4>
                        </div>
                        <div class="details" id="details">
                            <h6>{{trans('messages.auction.buyers_count')}}:{{ ($auction->count_of_buyer ) }}</h6>
                        </div>
                        <div class="details" id="details">
                            <p> {{trans('messages.auction.remaining_time')}}:<i class="fal fa-clock"></i> {{$auction->remaining_time}}</p>

{{--                            <h6>{{trans('messages.auction.remaining_time')}}:{{ ($auction->remaining_time ) }}</h6>--}}
                        </div>
                        <div class="description" id="description">
                            <h4>{{ trans('messages.description')}}:</h4>
                            <p>{{$auction->$description}}</p>
                        </div>
                        <div class="details" id="details">
{{--                            <h4>التفاصيل</h4>--}}
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
                                    <input type="number" name="buyer_offer" id="bidInput" value="{{($auction->current_price)}}" />
                                    <span class="plus" id="pluss">
                                        <i class="fal fa-plus"></i>
                                    </span>
                                </div>

                                <div class="bid-options">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <ul>
{{--                                                <li>--}}
{{--                                                    <div class="mb-3 form-check form-group">--}}
{{--                                                        <input type="checkbox" class="form-check-input" name="porxy-bid"--}}
{{--                                                               id="proxy">--}}
{{--                                                        <label class="form-check-label" for="proxy">المزايدة--}}
{{--                                                            بالوكالة</label>--}}
{{--                                                    </div>--}}
{{--                                                </li>--}}
                                                <li>
                                                    <div class="mb-3 form-check form-group">
                                                        <a href="{{ route('front.accept_auction_terms',$auction->id) }}">
{{--                                                        <a href="javascript:void(0);" id="change-terms-value">--}}
                                                        <input  type="checkbox" class="form-check-input" id="accept-terms"
                                                               {{ checkIsUserAccept($auction)->count()?'checked':''}}
                                                        >
                                                        </a>

                                                        <label class="form-check-label" for="accept-terms">قبول الشروط والاحكام</label>

                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-6">
                                            <ul>
                                                <li>
                                                    <p><i class="far fa-clock"></i> {{ trans('messages.auction.remaining_time')}}:{{$auction->remaining_time}}</p>
                                                </li>
                                                <li>
                                                    <p class="ticket"><i class="far fa-ticket"></i>{{ trans('messages.auction.count_of_buyer')}}: {{ ($auction->count_of_buyer ) }}</p>
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
                                    <button type="submit" class="btn btn-primary submit-btn">l{{trans('messages.auction.make_bid')}}</button>
                                </div>
{{--                                <input type="submit" class="submit-btn" value="{{trans('messages.auction.make_bid')}}">--}}
                            </form>
                        </div>
                    </div>
                </div><hr>

                <div class="more-imgs">
                    <div class="terms">
                        <h4>{{ trans('messages.auction.images')}}:</h4>
                    </div>
                    <div class="row">
                        @foreach($images as $image)
                        <div class="col-md-3 col-6">
                            <a href="{{$image->image_path}}" data-lightbox="roadtrip">
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
                </div><hr>

                <div class="terms">
                    <h4>{{ trans('messages.auction.terms')}}:</h4>
                    <p>
                        {{$auction->$auction_terms}}
                    </p>
                </div>



{{--<hr><br><br>--}}


{{--                <div class="terms">--}}
{{--                    <h4>{{ trans('messages.auction.inspection_location_map')}}:</h4>--}}
{{--                    <div class="form-group">--}}
{{--                        <div class="col-lg-12">--}}
{{--                            <input id="searchInput" class=" form-control"  placeholder=" اختر المكان علي الخريطة " name="other">--}}
{{--                            <div id="map1"></div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-6">--}}
{{--                            <input type="text" id="geo_lat" name="latitude" readonly="" placeholder=" latitude" class="form-control hidden d-none">--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-6">--}}
{{--                            <input type="text" id="geo_lng" name="longitude" readonly="" placeholder="longitude" class="form-control hidden d-none">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <hr><br><br>

                <div class="terms">
                    <h4>{{ trans('messages.auction.calculate_delivery_charge')}}:</h4>

                    <div class="form-group">
                        <label>@lang('messages.auction.choose_location'):</label><br>
                        <div class="col-lg-12">
                            <input id="searchInput" class=" form-control"  placeholder=" اختر المكان علي الخريطة " name="other">
                            <div id="map"></div>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" id="geo_lat" name="latitude" readonly="" placeholder=" latitude" class="form-control hidden d-none">
                        </div>
                        <div class="col-lg-6">
                            <input type="text" id="geo_lng" name="longitude" readonly="" placeholder="longitude" class="form-control hidden d-none">
                        </div>
                    </div>

                </div>

            </div>
        </section>
    </div>
@stop

@push('scripts')
    @include('Dashboard.layouts.parts.map')

    {{--    <script>--}}
{{--        $(function () {--}}
{{--            lightbox.option({--}}
{{--                resizeDuration: 100,--}}
{{--                fadeDuration: 300,--}}
{{--                fitImagesInViewport: true,--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}





    <script>
        $(function () {
            let currentVal = 100;
            $("#minuss").click(function () {
                var $input = $(this).parent().find("#bidInput");
                var count = parseInt($input.val()) - currentVal;
                count = count < 1 ? 1 : count;
                $input.val(count);
                $input.change();
                return false;
            });
            $("#pluss").click(function () {
                var $input = $(this).parent().find("#bidInput");
                $input.val(parseInt($input.val()) + currentVal);
                $input.change();
                return false;
            });

            {{--$('a#change-terms-value').on('click', function (e){--}}
            {{--    e.preventDefault();--}}
            {{--    $.ajax({--}}
            {{--        method: 'GET',--}}
            {{--        url: '{{ route('front.accept_auction_terms',$auction->id) }}',--}}
            {{--        success: res => {--}}
            {{--            console.log(res);--}}
            {{--        },--}}
            {{--        error: err => console.log(err),--}}
            {{--    });--}}
            {{--});--}}
        });
    </script>
@endpush
