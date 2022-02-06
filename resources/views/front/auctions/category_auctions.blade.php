@extends('front.layouts.master')
@section('title', trans('messages.category.auctions'))
@section('content')

    {{--    @include('front.auctions.head')--}}
    <div class="category-items-page">
        <main class="category-control">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <h5 class="category-title">
                            <a class="navbar-brand" href="{{route('front.home')}}">
                                <i class="fal fa-calendar-alt"></i>
                            </a>
                            {{$category->$name}}</h5>
                    </div>
                    <div class="col-sm-6">
                        <div class="controls">
                            <button class="search-btn" id="searchBtn"><i class="fal fa-search"></i></button>
                            <form class="search-form" id="searchForm"
                                  action="{{ route('front.category_auctions',$category->id) }}" method="get">
                                @csrf
                                <input class="form-control" type="search" name="search_by_auction_name"
                                       placeholder="عن ماذا تبحث" aria-label="Search">
                            </form>


                            <button class="filter" id="filterBtn"><i class="fal fa-filter"></i></button>
                            <form class="filter-form" id="filterForm"
                                  action="{{ route('front.filter_category',$category->id) }}" method="POST">
                                @csrf
                                @foreach($category_options as $category_option)
                                    <select class="form-select" name="option_detail_id[]"
                                            aria-label="Default select example">
                                        <option selected disabled value="">{{$category_option->$name}}</option>
                                        @foreach($category_option->option_details as $detail)
                                            <option value="{{ $detail->id }}">{{$detail->$value}}</option>
                                        @endforeach
                                    </select>
                                @endforeach
                                <button class="submit-btn">تطبيق</button>
                            </form>
                            <button class="sidebar" id="controlMenuBtn"><i class="fal fa-ellipsis-v-alt"></i></button>
                            <form class="menu-form" id="controlMenuForm"
                                  action="{{ route('front.main_filter',$category->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-3 col-md-6">
                                        <select class="form-select" aria-label="Default select example" >
                                            <option selected>price</option>
                                            <option value="less_price">less_price</option>
                                            <option value="high_price">high_price</option>

                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>bids</option>
                                            <option value="less_bids">less_bids</option>
                                            <option value="high_bids">high_bids</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>ending</option>
                                            <option value="less_ending">less_ending</option>
                                            <option value="high_ending">high_ending</option>
                                        </select>
                                    </div>
                                    {{--                                    <div class="col-lg-3 col-md-6"><select class="form-select"--}}
                                    {{--                                                                           aria-label="Default select example">--}}
                                    {{--                                            <option selected>Open this select menu</option>--}}
                                    {{--                                            <option value="1">One</option>--}}
                                    {{--                                            <option value="2">Two</option>--}}
                                    {{--                                            <option value="3">Three</option>--}}
                                    {{--                                        </select>--}}
                                    {{--                                    </div>--}}
                                </div>
                                <button class="submit-btn">تطبيق</button>
                            </form>
                            <button id="viewBtn"><i class="fal fa-th"></i></button>
                        </div>
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
                                                            <a href="{{route('front.watch_auction',$auction->id)}}">
{{--                                                            <a href="javascript:void(0);" id="change-icon">--}}
                                                                <div class="input-group-text">
                                                                    <i class="{{ checkIsUserWatch($auction)->count() ? 'fas fa-eye-slash' : 'fas fa-eye' }}"
                                                                       id="eye"></i>
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
                    @empty

                        <center><h2> @lang('messages.there_is_no_auctions_on_this_category_yet') </h2></center>
                    @endforelse
                </div>
            </div>
        </section>
{{--        <div class="d-flex justify-content-center">--}}
{{--            {!! $auctions->links() !!}--}}
{{--        </div>--}}
    </div>

@stop

@push('scripts')
    @include('front.auctions.ajax-watch')
@endpush
