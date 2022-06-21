@extends('front.layouts.master')
@section('title', trans('messages.my_profile'))
@section('style')
    <style>
        #img-preview3 {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            border: 5px solid #eee;
        }
    </style>
    <link rel="stylesheet" href="{{asset('Front/assets/css/profile_image.css')}}"/>
@endsection
@section('content')
    <section class="my-profile-page edit-profile"  dir="{{ direction() }}">
        <div class="container">
            @include('front.layouts.parts.alert')
            @if(auth()->user()->is_completed==0)
                <h3>{{ trans('messages.please_complete_your_data')}}</h3>
            @endif
            <h5 class="title">
                <a href="{{ route('front.my_profile') }}" class="mt-2 mx-1 back"> <i
                        class="fal fa-arrow-circle-{{ floating('right','left') }}" style="color: black;"></i> </a>
                {{ trans('messages.my_profile') }}</h5>

            <div class="row">
                <div class="edit-form">
                    <form action="{{route('front.update_profile')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="inputs-group">
                            <h5 class="group-title"> {{ trans('messages.user.update_personal_profile') }}</h5>
                            <div class="form-group mb-4 row ">
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <input type='file' id="imageUpload" name="image" accept=".png, .jpg, .jpeg"/>
                                        <label for="imageUpload"></label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="imagePreview"
                                             style="background-image: url({{auth()->user()->image_path}});"
                                        ></div>
                                    </div>
                                </div>
                            </div>
                            @if(auth()->user()->is_company=='person')
                                <div class="form-group mb-4 row">
                                    <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                        <label for="name"
                                               class="form-label">{{trans('messages.enter_first_name')}}</label>
                                    </div>
                                    <div class="col-lg-10 col-md-9">
                                        <input type="text" class="form-control" id="name" name="first_name"
                                               placeholder="{{trans('messages.enter_first_name')}}"
                                               value={{ auth()->user()->first_name}}>
                                    </div>
                                </div>
                                <div class="form-group mb-4 row">
                                    <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                        <label for="name"
                                               class="form-label">{{trans('messages.enter_middle_name')}}</label>
                                    </div>
                                    <div class="col-lg-10 col-md-9">
                                        <input type="text" class="form-control" id="name" name="middle_name"
                                               placeholder="{{trans('messages.enter_middle_name')}}"
                                               value={{ auth()->user()->middle_name}}>
                                    </div>
                                </div>
                                <div class="form-group mb-4 row">
                                    <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                        <label for="name"
                                               class="form-label">{{trans('messages.enter_last_name')}}</label>
                                    </div>
                                    <div class="col-lg-10 col-md-9">
                                        <input type="text" class="form-control" id="name" name="last_name"
                                               placeholder="{{trans('messages.enter_last_name')}}"
                                               value={{ auth()->user()->last_name}}>
                                    </div>
                                </div>
                            @endif

                            <div class="form-group mb-4 row">
                                <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                    <label for="name" class="form-label">{{trans('messages.user_name')}}</label>
                                </div>
                                <div class="col-lg-10 col-md-9">
                                    <input type="text" class="form-control" id="name" name="user_name"
                                           placeholder="{{trans('messages.enter_user_name')}}"
                                           value={{ auth()->user()->user_name}}>
                                </div>
                            </div>
                            <div class="form-group mb-4 row">
                                <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                    <label for="email" class="form-label">{{trans('messages.email')}}</label>
                                </div>
                                <div class="col-lg-10 col-md-9">
                                    <input type="text" class="form-control" id="email" name="email"
                                           placeholder="{{trans('messages.enter_email')}}"
                                           value={{ auth()->user()->email}}>
                                </div>
                            </div>

                            <div class="form-group mb-4 row">
                                <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                    <label for="phone" class="form-label">{{trans('messages.mobile')}}</label>
                                </div>
                                <div class="col-lg-10 col-md-9">
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-4 col-sm-6">

                                            <select class="form-select form-control" name="phone_code"
                                                    aria-label="Default select example">
                                                <option selected
                                                        disabled> {{ trans('messages.choose_country_code')}}</option>
                                                @foreach ($countries as $country)
                                                    <option
                                                        {{ $country->phone_code == auth()->user()->country->phone_code ? 'selected' : '' }} value="{{ $country->phone_code }}"> {{ $country->$name }}{{ $country->phone_code }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-xl-9 col-lg-8 col-sm-6">
                                            <input type="text" maxlength="12" id="mobile" name="mobile"
                                                   class="form-control   @error('mobile') is-invalid @enderror"
                                                   placeholder="{{trans('messages.enter_mobile')}}xxx xxx xx"
                                                   value={{explode(auth()->user()->country->phone_code,auth()->user()->mobile)[1]}}>
                                            @error('mobile')<span style="color: #e81414;">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if(auth()->user()->is_company=='company')
                                <div class="form-group mb-4  row ">
                                    <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                        <label>@lang('messages.company.company_authorization_image')</label>
                                    </div>
                                    <div class="col-lg-8 col-sm-12 d-flex align-items-center">
                                        <input type="file" class="form-control company_authorization_image "
                                               name="company_authorization_image" accept="image/*"
                                               onchange="readURL(this)"/>
                                    </div>
                                    <div class="col-lg-2 col-sm-12 d-flex align-items-center">
                                        <img id="img-preview" style="width: 180px ; height:90px"
                                             src={{ auth()->user()->company_authorization_image_path}}
                                                 width="250px"/>
                                    </div>
                                </div>
                                <div class="form-group mb-4  row ">
                                    <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                        <label>@lang('messages.commercial_register_image')</label>
                                    </div>
                                    <div class="col-lg-8 col-sm-12 d-flex align-items-center">
                                        <input type="file" class="form-control commercial_register_image"
                                               name="commercial_register_image" accept="image/*"
                                               onchange="readURL2(this)"/>
                                    </div>
                                    <div class="col-lg-2 col-sm-12 d-flex align-items-center">
                                        <img id="img-preview2" style="width: 180px ; height:90px"
                                             src="{{ auth()->user()->commercial_register_image_path}}" width="250px"/>
                                    </div>
                                </div>
                                <div class="form-group mb-4 row">
                                    <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                        <label for="name"
                                               class="form-label">{{trans('messages.company_location')}}</label>
                                    </div>
                                    <div class="col-lg-10 col-md-9">
                                        <div id="map"></div>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" id="geo_lat" name="latitude" readonly=""
                                               placeholder=" latitude" class="form-control hidden d-none">
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" id="geo_lng" name="longitude" readonly=""
                                               placeholder="longitude" class="form-control hidden d-none">
                                    </div>
                                    <br>
                                </div><br>
                            @endif
                            <div class="form-group mb-4 row">
                                <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                    <label for="password" class="form-label">{{trans('messages.password')}}</label>
                                </div>
                                <div class="col-lg-10 col-md-9">
                                    <input type="password" class="form-control" id="password" name="password"
                                           placeholder="{{trans('messages.enter_password')}} ">
                                </div>
                            </div>
                            <div class="form-group mb-4 row">
                                <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                    <label for="password-confirm" class="form-label">{{trans('messages.confirm-password')}}</label>
                                </div>
                                <div class="col-lg-10 col-md-9">
                                    <input type="password" class="form-control" id="password-confirm"
                                           name="password_confirmation"
                                           placeholder="{{trans('messages.confirm-password')}}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary submit-btn">{{trans('messages.edit')}}</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
@stop

@push('scripts')
    @include('front.user.parts.script_edit')
@endpush
