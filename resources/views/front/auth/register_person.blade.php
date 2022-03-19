@extends('front.layouts.master')
@section('title', trans('messages.register'))
@section('style')
@endsection

@section('content')
    @include('front.auctions.parts.head')
    <section class="sign-up-page">
        <div class="container">
            <h4 class="title"> {{ trans('messages.add_new_user') }}</h4>

            @include('front.layouts.parts.alert')

            <div class="row">
                <form action="{{route('front.register_person')}}" method="post"  id="submitted-form" enctype="multipart/form-data">
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
{{--                                <input type="hidden" name="fcm_web_token" value="">--}}

                                <input type="password"
                                       class="form-control   @error('password') is-invalid @enderror"  value="{{ old('password') }}"
                                       id="password" name="password" placeholder="{{trans('messages.enter_password')}}">
                                @error('password')<span style="color: #e81414;">{{ $message }}</span>@enderror

                            </div>
                        </div>
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="password-confirm" class="form-label">{{trans('messages.confirm-password')}}</label>
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
                            <div class="col-lg-7 col-md-6">
                                <label class="radio-inline">
                                    <label class="radio-inline">
                                        <input type="radio" value="0" class="styled" name="is_appear_name" checked="checked">{{trans('messages.No')}}
                                    </label>
                                    <input type="radio"  value="1" class="styled" name="is_appear_name" >{{trans('messages.Yes')}}
                                </label>

                            </div>
                        </div>


                        <div class="sign-btn">
                            <div class="col-lg-10 col-md-9">
                                {!! NoCaptcha::renderJs() !!}
                                {{--                                {!! NoCaptcha::display(['data-theme' => 'dark']) !!}--}}
                                {!! NoCaptcha::display() !!}
                            </div>
                            @error('g-recaptcha-response')<span style="color: #e81414;">{{ $message }}</span>@enderror

                            <p> {{trans('messages.accept_term')}}</p>
                            <button type="submit" id="save-form-btn" class="btn btn-primary submit-btn">{{trans('messages.register_your_account')}}</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </section>

@stop
