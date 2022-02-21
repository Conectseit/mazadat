@extends('front.layouts.master')
@section('title', trans('messages.add_auction'))
@section('style')
    <style> #map { height: 400px;} </style>
@endsection

@section('content')
    @include('front.auctions.head')
    <section class="sign-up-page">
        @include('front.layouts.parts.alert')

        <div class="container">
            <h4 class="title"> {{ trans('messages.auction.add') }}</h4>
            <div class="row">
                <form action="{{route('front.add_auction')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="inputs-group">

                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="email" class="form-label">{{trans('messages.name_ar')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="name_ar"  id="name_ar" name="name_ar"
                                       class="form-control   @error('name_ar') is-invalid @enderror"  value="{{ old('name_ar') }}"
                                       placeholder="{{trans('messages.enter_name_ar')}}">
                                @error('name_ar')<span style="color: #e81414;">{{ $message }}</span>@enderror

                            </div>
                        </div>


                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="email" class="form-label">{{trans('messages.name_en')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="name_en"  id="name_en" name="name_en"
                                       class="form-control   @error('name_en') is-invalid @enderror"  value="{{ old('name_en') }}"
                                       placeholder="{{trans('messages.enter_name_en')}}">
                                @error('name_en')<span style="color: #e81414;">{{ $message }}</span>@enderror

                            </div>
                        </div>


                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="email" class="form-label">{{trans('messages.description_ar')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <textarea name="description_ar" class="form-control @error('description_ar') is-invalid @enderror"  cols="100"
                                            value="{{ old('description_ar') }}"
                                           placeholder="{{trans('messages.enter_description_ar')}}">
                                </textarea>

                            </div>
                        </div>

                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="email" class="form-label">{{trans('messages.description_en')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <textarea name="description_en" class="form-control @error('description_en') is-invalid @enderror"  cols="100"
                                          value="{{ old('description_en') }}"
                                          placeholder="{{trans('messages.enter_description_en')}}">
                                </textarea>

                            </div>
                        </div>
{{--                            <div class="sign-btn">--}}
{{--                                <button type="submit" class="btn btn-primary submit-btn">{{trans('messages.add_auction')}}</button>--}}
{{--                            </div>--}}

                        </div>

                    <div class="inputs-group">



                        <h5 class="group-title"> {{ trans('messages.auction.auction_terms') }}</h5>

                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="email" class="form-label">{{ trans('messages.auction.auction_terms_ar') }}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <textarea name="auction_terms_ar" class="form-control @error('auction_terms_ar') is-invalid @enderror"  cols="100"
                                          value="{{ old('auction_terms_ar') }}"
                                          placeholder="{{trans('messages.enter_auction_terms_ar')}}">
                                </textarea>

                            </div>
                        </div>

                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="email" class="form-label">{{trans('messages.auction.auction_terms_en')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <textarea name="auction_terms_en" class="form-control @error('auction_terms_en') is-invalid @enderror"  cols="100"
                                          value="{{ old('auction_terms_en') }}"
                                          placeholder="{{trans('messages.enter_auction_terms_en')}}">
                                </textarea>

                            </div>
                        </div>


                    </div>

                    <div class="inputs-group">
                        <h5 class="group-title"> {{ trans('messages.auction.options') }}</h5>
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="email" class="form-label">{{ trans('messages.auction.auction_terms_ar') }}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">

                            </div>
                        </div>
                    </div>



                    <div class="inputs-group">
                        <h5 class="group-title"> {{trans('messages.enter_other_user_data')}}</h5>

                        <div id="location" style="display:block;">


                            <div class="form-group">
                                <label>@lang('messages.auction.images')</label>
                                <input type="file" class="form-control " name="images[]" multiple="multiple"/>
                            </div>

                            <hr>
                            <div class="form-group">
                                <label>@lang('messages.auction.inspection_report_images')</label>
                                <input type="file" class="form-control " name="inspection_report_images[]" multiple="multiple"/>
                            </div>
{{--                            <div class="form-group row ">--}}
{{--                                <div class="col-lg-2 col-md-3 d-flex align-items-center">--}}
{{--                                    <label>@lang('messages.commercial_register_image')</label>--}}
{{--                                </div>--}}
{{--                                <div class="col-lg-8 col-sm-12 d-flex align-items-center">--}}
{{--                                    <input type="file" class="form-control commercial_register_image" name="commercial_register_image" accept="image/*" onchange="readURL(this)" />--}}
{{--                                </div>--}}
{{--                                <div class="col-lg-2 col-sm-12 d-flex align-items-center">--}}
{{--                                    <img  id="img-preview" style="width: 180px ; hight:50px" src="https://ami-sni.com/wp-content/themes/consultix/images/no-image-found-360x250.png" width="250px" />--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="form-group">
                                <label>@lang('messages.auction.location'):</label>
                                <div class="col-lg-12">
                                    {{--                                    <input id="searchInput" class=" form-control"  placeholder=" اختر المكان علي الخريطة " name="other">--}}
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
                        <div class="sign-btn">
                            <p> {{trans('messages.wait')}}</p>
                            <button type="submit" class="btn btn-primary submit-btn">{{trans('messages.register_your_account')}}</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </section>

    @stop

@push('scripts')
    @include('Dashboard.layouts.parts.map')
@endpush

