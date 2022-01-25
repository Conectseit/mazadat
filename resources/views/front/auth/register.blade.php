@extends('front.layouts.master')
@section('title', trans('messages.register'))
@section('style')
    <style> #map { height: 400px;} </style>
@endsection

@section('content')
    @include('front.auctions.head')
    <section class="sign-up-page">
        <div class="container">
            <h4 class="title"> {{ trans('messages.add_new_user') }}</h4>
            @include('Dashboard.layouts.parts.validation_errors')

            <div class="row">
                <form action="{{route('front.register')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="inputs-group">
                        <h5 class="group-title">{{trans('messages.personal_info')}}</h5>
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="full_name" class="form-label">{{trans('messages.full_name')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="text" class="form-control"  name="full_name"
                                       placeholder="{{trans('messages.enter_full_name')}}">
                            </div>
                        </div>
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="email" class="form-label">{{trans('messages.email')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="{{trans('messages.enter_email')}}">
                            </div>
                        </div>
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="mobile" class="form-label">{{ trans('messages.mobile')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <div class="row">
{{--                                    <div class="col-xl-3 col-lg-4 col-sm-6">--}}
{{--                                        <select class="form-select form-control" name="country-code"--}}
{{--                                                aria-label="Default select example">--}}
{{--                                            <option selected disabled> {{ trans('messages.choose_country_code')}}</option>--}}
{{--                                            @foreach ($countries as $country)--}}
{{--                                                <option value="{{ $country->id }}"> {{ $country->$name }}{{ $country->phone_code }} </option>--}}
{{--                                            @endforeach--}}
{{--                                            <option >+966 المملكة العربية السعودية</option>--}}
{{--                                            <option value="ksa">+20 مصر</option>--}}
{{--                                            <option value="eg">+20 مصر</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
                                    <div class="col-xl-9 col-lg-8 col-sm-6">
                                        <input type="number" class="form-control" id="phone" name="mobile"
                                               placeholder="{{trans('messages.enter_mobile')}}: 5xx xxx xxx">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="user_name" class="form-label">{{trans('messages.user_name')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="text" class="form-control" id="username" name="user_name"
                                       placeholder="ادخل اسم مستخدم">
                            </div>
                        </div>
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="password" class="form-label">{{ trans('messages.password') }}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="password" class="form-control" id="password" name="password"
                                       placeholder="ادخل كلمة المرور">
                            </div>
                        </div>
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="password-confirm" class="form-label">تاكيد كلمة المرور</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="password" class="form-control" id="password-confirm"
                                       name="password_confirmation" placeholder="{{trans('messages.confirm-password')}}">
                            </div>
                        </div>
                    </div>

                    <div class="inputs-group">
                        <h5 class="group-title"> {{trans('messages.enter_other_user_data')}}</h5>
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="full_name" class="form-label"> {{ trans('messages.seller/buyer') }}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <select class=" select form-select form-control" name="type"
                                        aria-label="Default select example">
                                    <option selected disabled>{{trans('messages.select')}}</option>
                                    <option  value="buyer">{{trans('messages.buyer.buyer')}}</option>
                                    <option  value="seller ">{{trans('messages.seller.seller')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="full_name" class="form-label"> {{ trans('messages.buyer.person/company') }}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <select class=" select form-select form-control" name="is_company" id="is_company"
                                        aria-label="Default select example">
                                    <option selected disabled>{{trans('messages.select')}}</option>
                                    <option  value="person">{{trans('messages.person')}}</option>
                                    <option  id="option" value="company ">{{trans('messages.company')}}</option>
                                </select>
                            </div>
                        </div>
                        <div id="location" style="display:none;">
                            <div class="form-group row ">
                                <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                    <label>@lang('messages.commercial_register_image')</label>
                                </div>
                                <div class="col-lg-8 col-sm-12 d-flex align-items-center">
                                    <input type="file" class="form-control commercial_register_image" name="commercial_register_image" accept="image/*" onchange="readURL(this)" />
                                </div>
                                <div class="col-lg-2 col-sm-12 d-flex align-items-center">
                                    <img  id="img-preview" style="width: 180px ; hight:50px" src="https://ami-sni.com/wp-content/themes/consultix/images/no-image-found-360x250.png" width="250px" />
                                </div>

                            </div>
                            <div class="form-group">
                                <label>@lang('messages.buyer.location'):</label>
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

                        <div class="form-group mb-4 mt-3 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="P_O_Box" class="form-label">{{ trans('messages.P_O_Box') }}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="text" class="form-control"
                                       name="P_O_Box" placeholder="{{ trans('messages.P_O_Box') }}">
                            </div>
                        </div>


                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="is_appear_name" class="form-label">{{ trans('messages.is_appear_name')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <label class="radio-inline">
                                    <input type="radio"  value="1" class="styled" name="is_appear_name" checked="checked">{{trans('messages.Yes')}}
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" value="0" class="styled" name="is_appear_name">{{trans('messages.No')}}
                                </label>
                            </div>
                        </div>


                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="full_name" class="form-label"> {{ trans('messages.nationality.nationality') }}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <select class=" select form-select form-control" name="nationality_id"
                                        aria-label="Default select example">
                                    <option selected disabled>{{trans('messages.select')}}</option>
                                    @foreach ($nationalities as $nationality)
                                        <option value="{{ $nationality->id }}"> {{ $nationality->$name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

{{--                        <div class="form-group mb-4 row">--}}
{{--                            <div class="col-lg-2 col-md-3 d-flex align-items-center">--}}
{{--                                <label for="country_name" class="form-label"> {{ trans('messages.country.name') }}</label>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-10 col-md-9">--}}
{{--                                <select class=" select form-select form-control" id="country" name="country_id"--}}
{{--                                        aria-label="Default select example">--}}
{{--                                    <option selected disabled>{{trans('messages.select')}}</option>--}}
{{--                                    @foreach ($countries as $country)--}}
{{--                                        <option value="{{ $country->id }}"> {{ $country->$name }} </option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="city_name" class="form-label"> {{ trans('messages.city_name') }}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <select class=" select form-select form-control" id="cities" name="city_id"
                                        aria-label="Default select example">
                                    <option selected disabled>{{trans('messages.select')}}</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}"> {{ $city->$name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="sign-btn">
                            <p> {{trans('messages.accept_term')}}</p>
                            <button type="submit" class="btn btn-primary submit-btn">{{trans('messages.register_your_account')}}</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </section>

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
        let noimage =
            "https://ami-sni.com/wp-content/themes/consultix/images/no-image-found-360x250.png";

        function readURL(input) {
            console.log(input.files);
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#img-preview").attr("src", e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                $("#img-preview").attr("src", noimage);
            }
        }
    </script>

    @include('Dashboard.layouts.parts.map')
    @include('front.auth.ajax_get_cities')
@endpush
