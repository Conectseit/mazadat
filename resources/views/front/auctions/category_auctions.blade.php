@extends('front.layouts.master')
@section('title', trans('messages.category.auctions'))

@section('content')

{{--    @include('front.auctions.head')--}}

    <div class="category-items-page">
        <main class="category-control">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <h5 class="category-title"><a class="navbar-brand" href="{{route('front.home')}}">
                                <i class="fal fa-calendar-alt"></i>
                            </a>
                            {{$category->$name}}</h5>
                    </div>
                    <div class="col-sm-6">
                        <div class="controls">
                            <button class="search-btn" id="searchBtn"><i class="fal fa-search"></i></button>
                            <form class="search-form" id="searchForm">
                                <input class="form-control" type="search" name="search" placeholder="عن ماذا تبحث"
                                       aria-label="Search">
                            </form>
                            <button class="filter" id="filterBtn"><i class="fal fa-filter"></i></button>
                            <form class="filter-form" id="filterForm">
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <button class="submit-btn">تطبيق</button>
                            </form>
                            <button class="sidebar" id="controlMenuBtn"><i class="fal fa-ellipsis-v-alt"></i></button>
                            <form class="menu-form" id="controlMenuForm">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6"><select class="form-select"
                                                                           aria-label="Default select example">
                                            <option selected>Open this select menu</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-6"><select class="form-select"
                                                                           aria-label="Default select example">
                                            <option selected>Open this select menu</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-6"><select class="form-select"
                                                                           aria-label="Default select example">
                                            <option selected>Open this select menu</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-6"><select class="form-select"
                                                                           aria-label="Default select example">
                                            <option selected>Open this select menu</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>
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
                    @foreach($auctions as $auction)

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
                                        {{--                                    يبدأ فى الثلاثاء , 16/11/2021 , 10:10--}}
                                        Start_at: {{ ($auction->start_date->format('l, m/d/Y , h:s') ) }}

                                    </p>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p><i class="fal fa-ticket"></i>{{ ($auction->count_of_buyer ) }}</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <p><i class="fal fa-tag"></i>{{($auction->value_of_increment)}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p><i class="fal fa-gavel"></i>{{($auction->start_auction_price)}} $</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <p><i class="fal fa-clock"></i>{{$auction->remaining_time}}</p>
                                        </div>
                                        @if(auth()->check())
                                        <div class="container">
                                            {{--                                        <form class="form-inline" action="{{route('front.fav_auction',$auction->id)}}">--}}
                                            <div class="input-group mb-2 mr-sm-2">
                                                <div class="input-group-prepend">
                                                    <a href="{{route('front.watch_auction',$auction->id)}}">
                                                        {{--                                                    <div class="input-group-text"><i class="fas fa-eye-slash" id="eye"></i></div>--}}
                                                        <div class="input-group-text">
                                                            <i class=" {{ (boolean)checkIsUserWatch($auction)->count() ? 'fas fa-eye-slash' : 'fas fa-eye' }}" id="eye"></i>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
        </section>
    </div>@stop

@push('scripts')
    <script>

    </script>
@endpush
