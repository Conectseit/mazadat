@extends('front.layouts.master')
@section('title', trans('messages.auction.auction_details'))

@section('content')

    @include('front.auctions.head')

    <div class="ad-details-page">
        <main class="ad-main-details">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 d-flex align-items-center">
                        <h3 class="ad-title">{{ ($auction->category->$name ) }}</h3>
                    </div>
                    <div class="col-lg-5" id="mainInfo">
                        <p class="start-date">
                            <i class="fal fa-calendar-alt"></i>
                            يبدأ فى الثلاثاء ,
                            {{ ($auction->start_date ) }}
                        </p>
                        <p class="ticket"><i class="fal fa-ticket"></i>{{ ($auction->count_of_buyer ) }}</p>


                        <div class="row">
                            <div class="col-sm-4 col-6">
                                <p><i class="fal fa-tag"></i>{{($auction->value_of_increment)}}</p>
                            </div>
                            <div class="col-sm-4 col-6">
                                <p><i class="fal fa-gavel"></i>{{($auction->start_auction_price)}} $</p>
                            </div>
                            <div class="col-sm-4">
                                <p><i class="fal fa-clock"></i>{{$auction->remaining_time}}</p>
                            </div>
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
                    <div class="col-lg-5">
                        <div class="main-image">
                            <img src="{{$auction->first_image_path}}" alt="image">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="description" id="description">
                            <h4>{{ trans('messages.description')}}:</h4>
                            <p>
                                {{$auction->$description}}
                            </p>
                        </div>
                        <div class="details" id="details">
{{--                            <h4>التفاصيل</h4>--}}
                        </div>
                        <div class="bid-details" id="bidDetails">
                            <form action="">
                                <div class="bid-input">
                                    <span class="minus" id="minus">
                                        <i class="fal fa-minus"></i>
                                    </span>
                                    <h4>ريال سعودي</h4>
                                    <input type="number" name="bid-value" id="bidInput" value="{{($auction->current_price)}}" />
                                    <span class="plus" id="plus">
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
                                                        <input type="checkbox" class="form-check-input"
                                                               id="accept-terms" name="accept-terms">
                                                        <label class="form-check-label" for="accept-terms">قبول الشروط
                                                            والاحكام</label>
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
                                    <p>
                                        {{$auction->$description}}
                                    </p>
                                </div>
                                <input type="submit" class="submit-btn" value="{{trans('messages.auction.make_bid')}}">
                            </form>
                        </div>
                    </div>

                </div>

                <div class="more-imgs">
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

                <div class="terms">
                    <h4>{{ trans('messages.auction.terms')}}:</h4>
                    <p>
                        {{$auction->$auction_terms}}
                    </p>
                </div>
            </div>
        </section>
    </div>
@stop

@push('scripts')
    <script>
        $(function () {
            lightbox.option({
                resizeDuration: 100,
                fadeDuration: 300,
                fitImagesInViewport: true,
            });
        });
    </script>
@endpush
