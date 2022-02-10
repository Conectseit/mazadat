@extends('front.layouts.master')
@section('title', trans('messages.register'))
@section('style')
@endsection

@section('content')
    @include('front.auctions.head')
    <section class="sign-up-page">
        <div class="container">
            <h4 class="title"> {{ trans('messages.add_new_user') }}</h4>

{{--            @include('front.layouts.parts.alert')--}}

{{--            @if(session('success'))--}}
{{--                <div class="alert alert-success alert-dismissible fade show" role="alert">--}}
{{--                    <strong>Success! </strong>--}}
{{--                    {{session('success')}}--}}
{{--                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
{{--                </div>--}}
{{--            @endif--}}

            <div class="row">
                <form action="{{route('front.register_person')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="inputs-group">
                        <h5 class="group-title">{{trans('messages.personal_info')}}</h5>

                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="full_name" class="form-label">{{trans('messages.first_name')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="text"   name="first_name"
                                       class="form-control   @error('first_name') is-invalid @enderror"  value="{{ old('first_name') }}"
                                       placeholder="{{trans('messages.enter_first_name')}}">
                                @error('first_name')<span style="color: #e81414;">{{ $message }}</span>@enderror

                            </div>
                        </div>
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="full_name" class="form-label">{{trans('messages.middle_name')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="text"   name="middle_name"
                                       class="form-control   @error('middle_name') is-invalid @enderror"  value="{{ old('middle_name') }}"
                                       placeholder="{{trans('messages.enter_middle_name')}}">
                                @error('middle_name')<span style="color: #e81414;">{{ $message }}</span>@enderror

                            </div>
                        </div>
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="full_name" class="form-label">{{trans('messages.last_name')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="text"   name="last_name"
                                       class="form-control   @error('last_name') is-invalid @enderror"  value="{{ old('last_name') }}"
                                       placeholder="{{trans('messages.enter_last_name')}}">
                                @error('last_name')<span style="color: #e81414;">{{ $message }}</span>@enderror

                            </div>
                        </div>

                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="email" class="form-label">{{trans('messages.email')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="email"  id="email" name="email"
                                       class="form-control   @error('email') is-invalid @enderror"  value="{{ old('email') }}"
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
                                        <select class="form-select form-control" name="phone_code"
                                                aria-label="Default select example">
                                            <option selected disabled> {{ trans('messages.choose_country_code')}}</option>
                                            @foreach ($countries as $country)
                                                <option  value="{{ $country->phone_code }}"> {{ $country->$name }}{{ $country->phone_code }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-xl-9 col-lg-8 col-sm-6">
                                        <input type="text"  maxlength="14" name="mobile"
                                               class="form-control   @error('mobile') is-invalid @enderror"  value="{{ old('mobile') }}"
                                               placeholder="{{trans('messages.enter_mobile')}}xxx xxx xx">
                                        @error('mobile')<span style="color: #e81414;">{{ $message }}</span>@enderror
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
                                <input type="text"  id="username" name="user_name"
                                       class="form-control   @error('user_name') is-invalid @enderror"  value="{{ old('user_name') }}"
                                       placeholder="{{trans('messages.enter_user_name')}}">
                                @error('user_name')<span style="color: #e81414;">{{ $message }}</span>@enderror

                            </div>
                        </div>
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="password" class="form-label">{{ trans('messages.password') }}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="hidden" name="fcm_web_token" value="">

                                <input type="password"
                                       class="form-control   @error('password') is-invalid @enderror"  value="{{ old('password') }}"
                                       id="password" name="password" placeholder="{{trans('messages.enter_password')}}">
                                @error('password')<span style="color: #e81414;">{{ $message }}</span>@enderror

                            </div>
                        </div>
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="password-confirm" class="form-label">تاكيد كلمة المرور</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="password" class="form-control" id="password-confirm"
                                       name="password_confirmation" placeholder="{{trans('messages.confirm-password')}}">
                                <h6 class="group-title">  {{trans('messages.pass_terms')}}</h6>
                            </div>

                        </div>


                    </div>

                    <div class="inputs-group">
                        <h5 class="group-title"> {{trans('messages.enter_other_user_data')}}</h5>
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

@section('js')
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-messaging.js"></script>
    <script>
        $(document).ready(function(){
            const messaging = firebase.messaging();

            messaging.getToken()
                .then(currentToken => {
                    if (currentToken){
                        console.log(currentToken);
                        $('input[name=fcm_web_token]').val(currentToken);
                    } else {
                        console.log('No Instance ID token available. Request permission to generate one.');
                    }
                })
                .catch(err => console.log('An error occurred while retrieving token. ', err));
        });
    </script>
@stop




{{--                        <div class="form-group mb-4 row">--}}
{{--                            <div class="col-lg-2 col-md-3 d-flex align-items-center">--}}
{{--                                <label for="full_name" class="form-label"> {{ trans('messages.nationality.nationality') }}</label>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-10 col-md-9">--}}
{{--                                <select class=" select form-select form-control" name="nationality_id"--}}
{{--                                        aria-label="Default select example">--}}
{{--                                    <option selected disabled>{{trans('messages.select')}}</option>--}}
{{--                                    @foreach ($nationalities as $nationality)--}}
{{--                                        <option value="{{ $nationality->id }}"> {{ $nationality->$name }} </option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}

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

{{--                        <div class="form-group mb-4 row">--}}
{{--                            <div class="col-lg-2 col-md-3 d-flex align-items-center">--}}
{{--                                <label for="city_name" class="form-label"> {{ trans('messages.city_name') }}</label>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-10 col-md-9">--}}
{{--                                <select class=" select form-select form-control" id="cities" name="city_id"--}}
{{--                                        aria-label="Default select example">--}}
{{--                                    <option selected disabled>{{trans('messages.select')}}</option>--}}
{{--                                    @foreach ($cities as $city)--}}
{{--                                        <option value="{{ $city->id }}"> {{ $city->$name }} </option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}







{{--                        <div class="form-group mb-4 row">--}}
{{--                            <div class="col-lg-2 col-md-3 d-flex align-items-center">--}}
{{--                                <label for="full_name" class="form-label"> {{ trans('messages.seller/buyer') }}</label>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-10 col-md-9">--}}
{{--                                <select class=" select form-select form-control" name="type"--}}
{{--                                        aria-label="Default select example">--}}
{{--                                    <option selected disabled>{{trans('messages.select')}}</option>--}}
{{--                                    <option  value="buyer">{{trans('messages.buyer.buyer')}}</option>--}}
{{--                                    <option  value="seller ">{{trans('messages.seller.seller')}}</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group mb-4 row">--}}
{{--                            <div class="col-lg-2 col-md-3 d-flex align-items-center">--}}
{{--                                <label for="full_name" class="form-label"> {{ trans('messages.buyer.person/company') }}</label>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-10 col-md-9">--}}
{{--                                <select class=" select form-select form-control" name="is_company" id="is_company"--}}
{{--                                        aria-label="Default select example">--}}
{{--                                    <option selected disabled>{{trans('messages.select')}}</option>--}}
{{--                                    <option  value="person">{{trans('messages.person')}}</option>--}}
{{--                                    <option  id="option" value="company ">{{trans('messages.company')}}</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div id="location" style="display:none;">--}}
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
{{--                            <div class="form-group">--}}
{{--                                <label>@lang('messages.buyer.location'):</label>--}}
{{--                                <div class="col-lg-12">--}}
{{--                                    <input id="searchInput" class=" form-control"  placeholder=" اختر المكان علي الخريطة " name="other">--}}
{{--                                    <div id="map"></div>--}}
{{--                                </div>--}}
{{--                                <div class="col-lg-6">--}}
{{--                                    <input type="text" id="geo_lat" name="latitude" readonly="" placeholder=" latitude" class="form-control hidden d-none">--}}
{{--                                </div>--}}
{{--                                <div class="col-lg-6">--}}
{{--                                    <input type="text" id="geo_lng" name="longitude" readonly="" placeholder="longitude" class="form-control hidden d-none">--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                        </div>--}}

{{--                        <div class="form-group mb-4 mt-3 row">--}}
{{--                            <div class="col-lg-2 col-md-3 d-flex align-items-center">--}}
{{--                                <label for="P_O_Box" class="form-label">{{ trans('messages.P_O_Box') }}</label>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-10 col-md-9">--}}
{{--                                <input type="text" class="form-control"--}}
{{--                                       name="P_O_Box" placeholder="{{ trans('messages.P_O_Box') }}">--}}
{{--                            </div>--}}
{{--                        </div>--}}


{{--                        <div class="form-group mb-4 row">--}}
{{--                            <div class="col-lg-2 col-md-3 d-flex align-items-center">--}}
{{--                                <label for="full_name" class="form-label">{{trans('messages.full_name')}}</label>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-10 col-md-9">--}}
{{--                                <input type="text" class="form-control"  name="full_name"--}}
{{--                                       placeholder="{{trans('messages.enter_full_name')}}">--}}
{{--                            </div>--}}
{{--                        </div>--}}
