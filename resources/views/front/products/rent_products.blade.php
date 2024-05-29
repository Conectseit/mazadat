@extends('front.layouts.master')
{{--@section('meta_title')--}}
    {{--<meta name="title" content="{{$category->meta_title}}"/>--}}
{{--@stop--}}
{{--@section('meta_description')--}}
    {{--<meta name="description" content="{{$category->meta_description}}"/>--}}
{{--@stop--}}
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
                            @lang('messages.product.rent')</h5>
                    </div>

                </div>
            </div>
        </main>

        <section class="items" dir="{{ direction() }}">
            <div class="container">
                <div class="title">
                    <h5>@lang('messages.product.rent')</h5>
                </div>
                <br>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" role="tabpanel"><br>

                        <div class="row">
                            @forelse($products as $product)

                                <div class="col-lg-4 col-md-6" id="viewItem">
                                    <div class="card gallery-card" id="itemCard" style="height: 367px !important;">
{{--                                        <a href="{{route('front.product_details',$product->id)}}" class="image">--}}
                                        <a href="#" class="image">
                                            <div class="overlay"></div>
                                            <img src="{{$product->ImagePath}}" alt="card-img">
                                        </a>
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                {{ substr($product->city->$name,0,30 ) }}
                                            </h5>
                                            <p class="start-date info-item">
                                                <i class="fal fa-calendar-alt"></i>
                                                {{trans('messages.product.district')}}
                                                : {{$product->$district}}
                                            </p>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p><i class="fal fa-ticket"></i>
                                                        {{trans('messages.auction.street')}}
                                                        : {{ ($product->$street ) }}
                                                    </p>
                                                </div>
                                                <div class="col-sm-6">
                                                    <p><i class="fal fa-tag"></i>
                                                        {{trans('messages.auction.space')}}
                                                        : {{($product->space)}}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p><i class="fal fa-gavel"></i>
                                                        {{trans('messages.product.unit_price')}}
                                                        :{{($product->unit_price)}}</p>
                                                </div>
                                                <div class="col-sm-6">
                                                    <p><i class="fal fa-gavel"></i>
                                                        {{trans('messages.product.purpose_of_the_advertisement')}}
                                                        : {{($product->purpose_of_the_advertisement == 'sale'
                                                            ? trans('messages.product.sale')
                                                            : trans('messages.product.rent'))}}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @empty
                                <div style="text-align: center;">
                                    <h2> @lang('messages.there_is_no_properties_here_yet') </h2>
                                </div>
                            @endforelse
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@stop
