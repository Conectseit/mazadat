@extends('front.layouts.master')
@section('title', trans('messages.add_auction'))
@section('style')
    <style> #map {
            height: 400px;
        } </style>
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
                                <label for="email" class="form-label">{{ trans('messages.auction.choose_category')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <select class="form-select form-control" name="category_id"
                                        aria-label="Default select example">
                                    <option selected disabled> {{ trans('messages.auction.choose_category')}}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"> {{ $category->$name }} </option>
                                    @endforeach
                                </select>


                            </div>
                        </div>
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="email" class="form-label">{{trans('messages.name_ar')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="name_ar" id="name_ar" name="name_ar"
                                       class="form-control   @error('name_ar') is-invalid @enderror"
                                       value="{{ old('name_ar') }}"
                                       placeholder="{{trans('messages.enter_name_ar')}}">
                                @error('name_ar')<span style="color: #e81414;">{{ $message }}</span>@enderror

                            </div>
                        </div>


                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="email" class="form-label">{{trans('messages.name_en')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="name_en" id="name_en" name="name_en"
                                       class="form-control   @error('name_en') is-invalid @enderror"
                                       value="{{ old('name_en') }}"
                                       placeholder="{{trans('messages.enter_name_en')}}">
                                @error('name_en')<span style="color: #e81414;">{{ $message }}</span>@enderror

                            </div>
                        </div>


                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="email" class="form-label">{{trans('messages.description_ar')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <textarea name="description_ar"
                                          class="form-control @error('description_ar') is-invalid @enderror" cols="100"
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
                                <textarea name="description_en"
                                          class="form-control @error('description_en') is-invalid @enderror" cols="100"
                                          value="{{ old('description_en') }}"
                                          placeholder="{{trans('messages.enter_description_en')}}">
                                </textarea>

                            </div>
                        </div>


                    </div>

                    <div class="inputs-group">
                        <h5 class="group-title"> {{ trans('messages.auction.auction_terms') }}</h5>
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="email"
                                       class="form-label">{{ trans('messages.auction.auction_terms_ar') }}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <textarea name="auction_terms_ar"
                                          class="form-control @error('auction_terms_ar') is-invalid @enderror"
                                          cols="100"
                                          value="{{ old('auction_terms_ar') }}"
                                          placeholder="{{trans('messages.enter_auction_terms_ar')}}">
                                </textarea>
                            </div>
                        </div>

                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="email"
                                       class="form-label">{{trans('messages.auction.auction_terms_en')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <textarea name="auction_terms_en"
                                          class="form-control @error('auction_terms_en') is-invalid @enderror"
                                          cols="100"
                                          value="{{ old('auction_terms_en') }}"
                                          placeholder="{{trans('messages.enter_auction_terms_en')}}">
                                </textarea>
                            </div>
                        </div>

                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label  class="form-label">{{trans('messages.auction.allowed_take_photo')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <label class="radio-inline">
                                    <input type="radio" value="0" class="styled" name="allowed_take_photo">
                                    {{trans('messages.No')}}
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" value="1" class="styled" name="allowed_take_photo">
                                    {{trans('messages.Yes')}}
                                </label>
                            </div>
                        </div>


                    </div>

{{--                    <div class="inputs-group">--}}
{{--                        <h5 class="group-title"> {{ trans('messages.auction.options') }}</h5>--}}
{{--                        <div class="form-group mb-4 row">--}}
{{--                            <div class="col-lg-2 col-md-3 d-flex align-items-center">--}}
{{--                                <label for="email"--}}
{{--                                       class="form-label">{{ trans('messages.auction.auction_terms_ar') }}</label>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-10 col-md-9">--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}


                    <div class="inputs-group">
                        <h5 class="group-title"> {{trans('messages.enter_other_user_data')}}</h5>

                        {{--                        <div id="location" style="display:block;">--}}

                        <div class="form-group">
                            <label>@lang('messages.auction.images')</label>
                            <input type="file" class="form-control " name="images[]" multiple="multiple"/>
                        </div>

                        <hr>
                        <div class="form-group">
                            <label>@lang('messages.auction.inspection_report_images')</label>
                            <input type="file" class="form-control " name="inspection_report_images[]"
                                   multiple="multiple"/>
                        </div>
                        <br>
                        <div class="form-group">
                            <label>@lang('messages.auction.location'):</label>
                            <div class="col-lg-12">
                                {{--                                    <input id="searchInput" class=" form-control"  placeholder=" اختر المكان علي الخريطة " name="other">--}}
                                <div id="map"></div>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" id="geo_lat" name="latitude" readonly="" placeholder=" latitude"
                                       class="form-control hidden d-none">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" id="geo_lng" name="longitude" readonly="" placeholder="longitude"
                                       class="form-control hidden d-none">
                            </div>
                        </div>

                        {{--                        </div>--}}
                        <div class="sign-btn">
                            <p> {{trans('messages.wait')}}</p>
                            <button type="submit"
                                    class="btn btn-primary submit-btn">{{trans('messages.add_auction')}}</button>
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

