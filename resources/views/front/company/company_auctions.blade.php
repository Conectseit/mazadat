@extends('front.layouts.master')
@section('title', trans('messages.home'))
@section('style')
    <style>

    </style>
@endsection


@section('content')
    @include('front.layouts.parts.alert')
    <div class="category-items-page">
        <main class="category-control">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 ">
                        <a href="{{ url()->previous() }}" class="">  <i class="fal fa-arrow-circle-right"></i>  </a>
{{--                        <a href="javascript:history.back()" class="">  <i class="fal fa-arrow-circle-right"></i>  </a>--}}

                        <h3 class="category-title">
                            {{trans('messages.auctions_of')}}:{{$company->user_name}}
                        </h3>
                    </div>
                </div>
            </div>
        </main>
        <section class="items">
            <div class="container">
                <div class="row">
                    @forelse($auctions as $auction)

                        <div class="col-lg-4 col-md-6" id="viewItem">
                            <div class="card gallery-card" id="itemCard">
                                <a href="{{route('front.auction_details',$auction->id)}}" class="image">
                                    <div class="overlay"></div>
                                    <img src="{{$auction->first_image_path}}" alt="card-img">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title">{{ ($auction->$name ) }}</h5>
                                    <p class="start-date info-item">
                                        <i class="fal fa-calendar-alt"></i>
                                        {{trans('messages.auction.start_at')}}
                                        {{--                                    يبدأ فى الثلاثاء , 16/11/2021 , 10:10--}}
                                        : {{ ($auction->start_date->format('l, m/d/Y') ) }}

                                    </p>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p><i class="fal fa-ticket"></i>
                                                {{trans('messages.auction.buyers')}}:{{ ($auction->count_of_buyer ) }}
                                            </p>
                                        </div>
                                        <div class="col-sm-6">
                                            <p><i class="fal fa-tag"></i>
                                                {{trans('messages.auction.value_of_increment')}}
                                                : {{($auction->value_of_increment)}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p><i class="fal fa-gavel"></i>
                                                {{trans('messages.auction.start_auction_price')}}
                                                :{{($auction->start_auction_price)}}</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <p><i class="fal fa-gavel"></i>
                                                {{trans('messages.auction.current_price')}}
                                                :{{($auction->current_price)}}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-sm-6">
                                            <p><i class="fal fa-clock"></i>{{trans('messages.auction.remaining_time')}}
                                                :{{$auction->remaining_time}}</p>
                                        </div>
                                        @if(auth()->check())
                                            <div class="col-sm-6">
                                                <div class="container">
                                                    <div class="input-group mb-2 mr-sm-2">
                                                        <div class="input-group-prepend">
                                                            {{--                                                            <a href="{{route('front.watch_auction',$auction->id)}}">--}}
                                                            <a href="javascript:void(0);"
                                                               id="change-icon-{{$auction->id}}">
                                                                <div class="input-group-text">
                                                                    <i class="{{ checkIsUserWatch($auction)->count() ? 'fas fa-eye-slash' : 'fas fa-eye' }}"
                                                                       id="eye-{{$auction->id}}"></i>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('front.auctions.ajax-watch', ['auction' => $auction])

                    @empty

                        <div style="text-align: center;">
                            <h2> @lang('messages.there_is_no_auctions_on_this_category_yet') </h2></div>
                    @endforelse

                </div>
            </div>
        </section>
    </div>
@stop

@push('scripts')
    <script>

    </script>
@endpush
