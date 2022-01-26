@extends('front.layouts.master')
@section('title', trans('messages.auction.my_bids'))
@section('style')
    <style></style>
@endsection

@section('content')
    <section class="watching-page">
        @if($auctions->count() > 0)
            <div class="container">
                @foreach($auctions as $auction)
                    <div class="watching-card">
                        <div class="row">
                            <div class="col-lg-10">
                                <div class="card list-card" id="itemCard">
                                    <a href="{{route('front.auction_details',$auction->id)}}" class="image">
                                        <div class="overlay"></div>
                                        <img src="{{$auction->first_image_path}}" alt="card-img">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ ($auction->$name ) }}</h5>
                                        <p class="start-date info-item">
                                            <i class="fal fa-calendar-alt"></i>
                                            {{--                                    يبدأ فى الثلاثاء , 16/11/2021 , 10:10--}}
                                            {{trans('messages.auction.start_at')}} : {{ ($auction->start_date->format('l, m/d/Y') ) }}
                                        </p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p><i class="fal fa-ticket"></i>{{trans('messages.auction.buyers')}}:{{ ($auction->count_of_buyer ) }}</p>
                                            </div>
                                            <div class="col-sm-6">
                                                <p><i class="fal fa-tag"></i>
                                                {{trans('messages.auction.value_of_increment')}} : {{($auction->value_of_increment)}}</p>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p><i class="fal fa-gavel"></i>
                                                    {{trans('messages.auction.current_price')}}:{{($auction->current_price)}}</p>

                                            </div>
                                            <div class="col-sm-6">
                                                <p><i class="fal fa-gavel"></i>{{trans('messages.auction.start_auction_price')}}:{{($auction->start_auction_price)}}</p>
                                            </div>
                                            <div class="col-sm-6">
                                                <p><i class="fal fa-clock"></i>{{$auction->remaining_time}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="buttons">
                                    <a href="{{route('front.auction_details',$auction->id)}}" class="bid"> متابعة</a>
                                    <a href="{{route('front.cancel_bid_auction',$auction->id)}}" class="remove">الخروج</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <center><h2> @lang('messages.you_dont_have_auctions_yet') </h2></center>
        @endif

    </section>

    {{--    <section class="watching-page">--}}
{{--        <div class="container">--}}
{{--            <div class="watching-card">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-10">--}}
{{--                        <div class="card list-card" id="itemCard">--}}
{{--                            <a href="ad-details.html" class="image">--}}
{{--                                <div class="overlay"></div>--}}
{{--                                <img src="assets/imgs/car-img.jpg" alt="card-img">--}}
{{--                            </a>--}}
{{--                            <div class="card-body">--}}
{{--                                <h5 class="card-title">عنوان المزاد</h5>--}}
{{--                                <p class="start-date info-item">--}}
{{--                                    <i class="fal fa-calendar-alt"></i>--}}
{{--                                    يبدأ فى الثلاثاء , 16/11/2021 , 10:10--}}
{{--                                </p>--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-sm-6">--}}
{{--                                        <p><i class="fal fa-ticket"></i>121</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-sm-6">--}}
{{--                                        <p><i class="fal fa-tag"></i>33.600</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-sm-6">--}}
{{--                                        <p><i class="fal fa-gavel"></i>1000.000 $</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-sm-6">--}}
{{--                                        <p><i class="fal fa-clock"></i>3m : 50s</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-2">--}}
{{--                        <div class="buttons">--}}
{{--                            <a href="{{route('front.auction_details',$auction->id)}}" class="bid">متابعة</a>--}}
{{--                            <a href="#" class="remove">الخروج</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

@stop

@push('scripts')
    <script>

    </script>
@endpush
