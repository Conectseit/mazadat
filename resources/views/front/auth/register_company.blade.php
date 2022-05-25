@extends('front.layouts.master')
@section('title', trans('messages.register'))
@section('style')
    <style> #map {
            height: 400px;
        } </style>
@endsection
@section('content')
    @include('front.auctions.parts.head')
    <section class="sign-up-page" dir="{{ direction() }}">
        <div class="container">
            <h4 class="title"> {{ trans('messages.register_company') }}</h4>

            @include('front.layouts.parts.alert')

            <div class="row">
                <form action="{{route('front.register_company')}}" method="post" id="submitted-form"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="inputs-group">
                        <h5 class="group-title">{{trans('messages.personal_info')}}</h5>
                        <div class="form-group mb-4  row ">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label>@lang('messages.company.company_authorization_image')</label>
                            </div>
                            <div class="col-lg-8 col-sm-12 d-flex align-items-center">
                                <input type="file" class="form-control company_authorization_image "
                                       name="company_authorization_image" accept="image/*" onchange="readURL(this)">
                            </div>
                            <div class="col-lg-2 col-sm-12 d-flex align-items-center">
                                <img id="img-preview" style="width: 180px ; height:90px"
                                     src={{ asset('uploads/images.jpg') }}
                                     {{--                                "https://assets.wasalt.com/others/icons/villas-for-sale-in-makkah.jpeg"--}}
                                         width="250px"/>
                            </div>
                            @error('company_authorization_image')<span
                                style="color: #e81414;">{{ $message }}</span>@enderror

                        </div>

                        <div class="form-group mb-4 row">
                            {{--                            <input type="hidden" name="fcm_web_token" value="">--}}

                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="user_name" class="form-label">{{trans('messages.company_name')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="text" id="username" name="user_name"
                                       class="form-control   @error('user_name') is-invalid @enderror"
                                       value="{{ old('user_name') }}"
                                       placeholder="{{trans('messages.enter_company_name')}}">
                                @error('user_name')<span style="color: #e81414;">{{ $message }}</span>@enderror

                            </div>
                        </div>

                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="email" class="form-label">{{trans('messages.email')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="email" id="email" name="email"
                                       class="form-control   @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}"
                                       placeholder="{{trans('messages.enter_email')}}">
                                @error('email')<span style="color: #e81414;">{{ $message }}</span>@enderror

                            </div>
                        </div>
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="mobile" class="form-label">{{ trans('messages.mobile')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-4 col-sm-6">
                                        <select class="form-select form-control" name="country_id"
                                                aria-label="Default select example">
                                            <option selected
                                                    disabled> {{ trans('messages.choose_country_code')}}</option>
                                            @foreach ($countries as $country)
                                                <option
                                                    value="{{ $country->id }}"> {{ $country->$name }}{{ $country->phone_code }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-xl-9 col-lg-8 col-sm-6">
                                        <input type="text"  name="mobile"  maxlength="9" minlength="9"
                                               class="form-control   @error('mobile') is-invalid @enderror"
                                               value="{{ old('mobile') }}"
                                               placeholder="{{trans('messages.enter_mobile')}}5xx xxx xxx">
                                        <h6 class="group-title">  {{trans('messages.mobile_terms')}}</h6>

                                        @error('mobile')<span style="color: #e81414;">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="password" class="form-label">{{ trans('messages.password') }}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="password" class="form-control
                                @error('password') is-invalid @enderror" value="{{ old('password') }}"
                                       id="password" name="password" placeholder="{{trans('messages.enter_password')}}">
                                @error('password')<span style="color: #e81414;">{{ $message }}</span>@enderror

                            </div>
                        </div>
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="password-confirm"
                                       class="form-label">{{trans('messages.confirm-password')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="password" class="form-control" id="password-confirm"
                                       name="password_confirmation"
                                       placeholder="{{trans('messages.confirm-password')}}">
                                <h6 class="group-title">  {{trans('messages.pass_terms')}}</h6>
                            </div>
                        </div>
                    </div>

                    <div class="inputs-group">
                        <h5 class="group-title"> {{trans('messages.enter_other_user_data')}}</h5>

                        {{--                        <div id="location" style="display:block;">--}}
                        <div class="form-group row ">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label>@lang('messages.commercial_register_image')</label>
                            </div>
                            <div class="col-lg-8 col-sm-12 d-flex align-items-center">
                                <input type="file" class="form-control commercial_register_image"
                                       name="commercial_register_image" accept="image/*" onchange="readURL2(this)"/>
                            </div>

                            <div class="col-lg-2 col-sm-12 d-flex align-items-center">
                                <img id="img-preview2" style="width: 180px ; height:90px"
                                     src="{{ asset('uploads/images.jpg') }}" width="250px"/>
                            </div>
                            @error('commercial_register_image')<span
                                style="color: #e81414;">{{ $message }}</span>@enderror

                        </div>
                        <div class="form-group">
                            <label>@lang('messages.company_location'):</label>
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
                            @error('latitude')<span style="color: #e81414;">{{ $message }}</span>@enderror

                        </div>


                        {{--                        </div>--}}
                        {{--                            <div class="form-group mt-5 row d-lg-flex d-sm-block">--}}

                        {{--                                <div class="col-lg-3 col-md-5">--}}
                        {{--                                    {!! NoCaptcha::renderJs() !!}--}}
                        {{--                                                                    {!! NoCaptcha::display(['data-theme' => 'dark']) !!}--}}
                        {{--                                    {!! NoCaptcha::display() !!}--}}
                        {{--                                </div>--}}
                        {{--                                <div class="col-lg-9 col-md-7 my-auto">--}}
                        {{--                                    <p> {{trans('messages.accept_term')}}</p>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}


                        <br>

                        <div class="sign-btn">
                            <div class="col-lg-10 col-md-9">
                                {!! NoCaptcha::renderJs() !!}
                                {{--                                {!! NoCaptcha::display(['data-theme' => 'dark']) !!}--}}
                                {!! NoCaptcha::display() !!}
                            </div>
                            @error('g-recaptcha-response')<span style="color: #e81414;">{{ $message }}</span>@enderror

                            {{--                            <p> {{trans('messages.accept_term')}}</p>--}}


                            <br><br>
                            <div class=" form-check form-group">
                                <a href="{{route('front.condition_and_terms')}}">
                                    <label class="form-check-label"
                                           style="color: white; text-decoration: underline">{{ trans('messages.accept_terms')}} </label>
                                    <input type="checkbox"
                                           class="form-check-input  @error('accept_app_terms') is-invalid @enderror"
                                           value="yes" name="accept_app_terms">
                                </a>
                                @error('accept_app_terms')<span style="color: #e81414;">{{ $message }}</span>@enderror
                            </div>
                            <button type="submit" id="save-form-btn"
                                    class="btn btn-primary submit-btn">{{trans('messages.register_your_account')}}</button>
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
        let noimage = "https://assets.wasalt.com/others/icons/villas-for-sale-in-makkah.jpeg";

        function readURL(input) {
            console.log(input.files);
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#img-preview").attr("src", e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                $("#img-preview").attr("src", "https://assets.wasalt.com/others/icons/villas-for-sale-in-makkah.jpeg");

            }
        }

        function readURL2(input) {
            console.log(input.files);
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#img-preview2").attr("src", e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                $("#img-preview2").attr("src", "https://assets.wasalt.com/others/icons/villas-for-sale-in-makkah.jpeg");
            }
        }
    </script>

    {{--    @include('Dashboard.layouts.parts.map')--}}
    @include('front.layouts.parts.map')
    @include('front.auth.ajax_get_cities')
@endpush
