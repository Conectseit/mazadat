@extends('front.layouts.master')
@section('title', trans('messages.category.auctions'))
@section('content')
    <main class="categories-bar row">
        @include('front.layouts.parts.nav_categories')
    </main>
    <div class="category-items-page">
        <main class="category-control" dir="{{ direction() }}">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <h5 class="category-title">
                            <a class="navbar-brand" href="{{route('front.home')}}">
                                <i class="fal fa-calendar-alt" style="padding:10px;"></i>
                            </a>
                            {{$category->$name}}</h5>
                    </div>
                    <div class="col-sm-6">
                        <div class="controls">
                            <button class="search-btn" id="searchBtn"><i class="fal fa-search"></i></button>
                            <form class="search-form" id="searchForm"
                                  action="{{ route('front.category_auctions',$category->id) }}" method="get">
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
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>{{trans('messages.price')}}</option>
                                            <option value="less_price">{{trans('messages.less_price')}}</option>
                                            <option value="high_price">{{trans('messages.high_price')}}</option>

                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>{{trans('messages.bidss')}}</option>
                                            <option value="less_bids">{{trans('messages.less_bids')}}</option>
                                            <option value="high_bids">{{trans('messages.high_bids')}}</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>{{trans('messages.ending')}}</option>
                                            <option value="less_ending">{{trans('messages.less_ending')}}</option>
                                            <option value="high_ending">{{trans('messages.high_ending')}}</option>
                                        </select>
                                    </div>
                                </div>
                                <button class="submit-btn">تطبيق</button>
                            </form>
                            <button id="viewBtn"><i class="fal fa-th"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <section class="items" dir="{{ direction() }}">
            <div class="container">
                <div class="title">
                    <h5>{{ $category->$description }}</h5>
                </div>
                <br>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                type="button" role="tab" aria-controls="home"
                                aria-selected="true">{{ trans('messages.auction.on_progress') }}</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                type="button" role="tab" aria-controls="profile"
                                aria-selected="false">{{ trans('messages.auction.done') }}</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"><br>

                        @if(auth()->check())
                            <div class="row">
                                @forelse($on_progress_auctions as $auction)

                                    @if(auth()->user()->is_company == $auction->who_can_see || $auction->who_can_see == 'all' )

                                        <div class="col-lg-4 col-md-6" id="viewItem">
                                            <div class="card gallery-card" id="itemCard" style="height: 367px !important;">
                                                <a href="{{route('front.auction_details',$auction->id)}}" class="image">
                                                    <div class="overlay"></div>
                                                    <img src="{{$auction->first_image_path}}" alt="card-img">
                                                </a>
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        {{ substr($auction->$name,0,30 ) }}
                                                    </h5>
                                                    <p class="start-date info-item">
                                                        <i class="fal fa-calendar-alt"></i>
                                                        {{trans('messages.auction.start_at')}}
                                                        : {{isset($auction->start_date)? ($auction->start_date->format('l, m/d/Y') ):''}}
                                                    </p>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <p><i class="fal fa-ticket"></i>
                                                                {{trans('messages.auction.buyers')}}
                                                                :{{ ($auction->count_of_buyer ) }}
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
                                        @include('front.auctions.parts.ajax-watch', ['auction' => $auction])
                                    @endif
                                @empty
                                    <div style="text-align: center;">
                                        <h2> @lang('messages.there_is_no_auctions_on_this_category_yet') </h2></div>
                                @endforelse
                            </div>
                        @else
                            <div class="row">
                                @forelse($on_progress_auctions as $auction)
                                    <div class="col-lg-4 col-md-6" id="viewItem">
                                        <div class="card gallery-card" id="itemCard" style="height: 367px !important;">
                                            <a href="{{route('front.auction_details',$auction->id)}}" class="image">
                                                <div class="overlay"></div>
                                                <img src="{{$auction->first_image_path}}" alt="card-img">
                                            </a>
                                            <div class="card-body">

                                                <h5 class="card-title">
                                                    {{ substr($auction->$name,0,30 ) }}
                                                </h5>
                                                <p class="start-date info-item">
                                                    <i class="fal fa-calendar-alt"></i>
                                                    {{trans('messages.auction.start_at')}}
                                                    : {{isset($auction->start_date)? ($auction->start_date->format('l, m/d/Y') ):''}}

                                                </p>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><i class="fal fa-ticket"></i>
                                                            {{trans('messages.auction.buyers')}}
                                                            :{{ ($auction->count_of_buyer ) }}
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
                                    @include('front.auctions.parts.ajax-watch', ['auction' => $auction])
                                @empty

                                    <div style="text-align: center;">
                                        <h2> @lang('messages.there_is_no_auctions_on_this_category_yet') </h2></div>
                                @endforelse

                            </div>
                        @endif
                        <div class="d-flex justify-content-center">
                            {!! $on_progress_auctions->links() !!}
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"><br>

                        <div class="row">
                            @forelse($done_auctions as $auction)
                                <div class="col-lg-4 col-md-6" id="viewItem">
                                    <div class="card gallery-card" id="itemCard" style="height: 367px !important;">
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
                                                        {{trans('messages.auction.buyers')}}
                                                        :{{ ($auction->count_of_buyer ) }}
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
                                @include('front.auctions.parts.ajax-watch', ['auction' => $auction])
                            @empty
                                <div style="text-align: center;"><h2> @lang('messages.there_is_no_auctions_on_this_category_yet') </h2></div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop
