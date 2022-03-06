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
        #map { height: 400px;}
        #add_map { height: 400px;}
    </style>
    <link rel="stylesheet" href="{{asset('Front/assets/css/profile_image.css')}}"/>

@endsection

@section('content')
    <section class="my-profile-page edit-profile">

        <div class="container">

            @include('front.layouts.parts.alert')


            @if(auth()->user()->is_completed==0)
                <h3>{{ trans('messages.please_complete_your_data')}}</h3>
            @endif


            <div class="row">
                <div class="edit-form">
                    <form action="{{route('front.update_profile')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="inputs-group">
                            <h5 class="group-title">تعديل الصفحة الشخصية</h5>
                            <div class="form-group mb-4 row ">
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <input type='file' id="imageUpload" name="image" accept=".png, .jpg, .jpeg"/>
                                        <label for="imageUpload"></label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="imagePreview" style="background-image: url({{auth()->user()->image_path}});"
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
                                    <label for="email" class="form-label">البريد الالكتروني</label>
                                </div>
                                <div class="col-lg-10 col-md-9">
                                    <input type="email" class="form-control" id="email" name="email"
                                           placeholder="{{trans('messages.enter_email')}}"
                                           value={{ auth()->user()->email}}>
                                </div>
                            </div>

                            <div class="form-group mb-4 row">
                                <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                    <label for="phone" class="form-label">رقم الجوال</label>
                                </div>
                                <div class="col-lg-10 col-md-9">
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-4 col-sm-6" >

                                            <select class="form-select form-control" name="phone_code" aria-label="Default select example">
                                                <option selected
                                                        disabled >{{ isset(auth()->user()->country)? auth()->user()->country->$name :  trans('messages.choose_country_code') }}</option>
                                                {{--                                            <option selected disabled> {{ trans('messages.choose_country_code')}}</option>--}}
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->phone_code }}"> {{ $country->$name }}{{ $country->phone_code }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-xl-9 col-lg-8 col-sm-6">
                                            <input type="text" maxlength="14" id="mobile" name="mobile"
                                                   class="form-control   @error('mobile') is-invalid @enderror"
                                                   placeholder="{{trans('messages.enter_mobile')}}xxx xxx xx"
                                                   value={{ltrim( auth()->user()->mobile,auth()->user()->country->phone_code)}}>


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
                                             {{--                                "https://assets.wasalt.com/others/icons/villas-for-sale-in-makkah.jpeg"--}}

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
                                        <label for="name" class="form-label">{{trans('messages.company_location')}}</label>
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
                                    </div><br>
                                </div><br>
                            @endif



                            <div class="form-group mb-4 row">
                                <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                    <label for="password" class="form-label">كلمة المرور</label>
                                </div>
                                <div class="col-lg-10 col-md-9">
                                    <input type="password" class="form-control" id="password" name="password"
                                           placeholder="{{trans('messages.enter_password')}} ">
                                </div>
                            </div>
                            <div class="form-group mb-4 row">
                                <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                    <label for="password-confirm" class="form-label">تاكيد كلمة المرور</label>
                                </div>
                                <div class="col-lg-10 col-md-9">
                                    <input type="password" class="form-control" id="password-confirm"
                                           name="password_confirmation"
                                           placeholder="{{trans('messages.confirm-password')}}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary submit-btn">تعديل</button>
                        </div>
                    </form>
                </div>
            </div>


            @include('front.user.complete_profile_form')
            @if(auth()->user()->is_company=='person')
            @include('front.user.add_address_form')
            @endif


        </div>
    </section>
@stop

@push('scripts')


    @include('front.user.script_edit')
    @include('Dashboard.layouts.parts.map')

@endpush






{{--<div class="row">--}}

{{--    <div class="col-lg-6">--}}
{{--        <div class="slogan-right">--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-6">--}}
{{--                    <div class="image">--}}
{{--                        <img src={{Auth::guard('web')->user()->ImagePath}} alt="my-image">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-sm-6">--}}
{{--                    <div class="slogan-left">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-sm-6">--}}
{{--                                --}}{{--                                        <a href="" data-bs-toggle="modal" data-bs-target="#edit-photo-modal">--}}
{{--                                --}}{{--                                            تعديل الصورة الشخصية--}}
{{--                                --}}{{--                                        </a>--}}

{{--                                <div class="col-sm-12">--}}
{{--                                    <a href="" data-bs-toggle="modal" data-bs-target="#edit-photo-modal">--}}
{{--                                        تعديل الصورة الشخصية--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                --}}{{--                                        <div class="col-sm-12">--}}
{{--                                --}}{{--                                            <a href="#" data-bs-toggle="modal" data-bs-target="#bio-modal">--}}
{{--                                --}}{{--                                                تعديل البيانات الشخصية--}}
{{--                                --}}{{--                                            </a>--}}
{{--                                --}}{{--                                        </div>--}}
{{--                            </div>--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    --}}{{--            <div class="col-lg-6">--}}
{{--    --}}{{--                <div class="slogan-left">--}}
{{--    --}}{{--                    <div class="row">--}}

{{--    --}}{{--                        <div class="col-sm-6">--}}
{{--    --}}{{--                            <a href="{{route('front.user_documents')}}">--}}
{{--    --}}{{--                                 اضافة وثائق رسمية--}}
{{--    --}}{{--                            </a>--}}
{{--    --}}{{--                        </div>--}}
{{--    --}}{{--                        <div class="col-sm-6">--}}
{{--    --}}{{--                            <a href="#" data-bs-toggle="modal" data-bs-target="#bio-modal">--}}
{{--    --}}{{--                                 السيرة الذاتية--}}
{{--    --}}{{--                            </a>--}}
{{--    --}}{{--                        </div>--}}
{{--    --}}{{--                        <div class="col-sm-6">--}}
{{--    --}}{{--                            <a href="{{route('front.user_passport')}}">--}}
{{--    --}}{{--                                اضافة جواز السفر--}}
{{--    --}}{{--                            </a>--}}
{{--    --}}{{--                        </div>--}}
{{--    --}}{{--                    </div>--}}
{{--    --}}{{--                </div>--}}
{{--    --}}{{--            </div>--}}
{{--</div>--}}


{{--    <!-- bio-modal -->--}}
{{--    <div class="modal user-modal bio-modal fade" id="bio-modal" tabindex="-1" aria-labelledby="exampleModalLabel"--}}
{{--         aria-hidden="true">--}}
{{--        <div class="modal-dialog modal-dialog-centered">--}}
{{--            <div class="modal-content">--}}
{{--                <form action="{{route('front.update_profile')}}" method="post">--}}
{{--                    @csrf--}}
{{--                    <div class="modal-header">--}}
{{--                        <h5 class="modal-title" id="exampleModalLabel"> تعديل الصفحة الشخصية</h5>--}}
{{--                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                    </div>--}}
{{--                    <div class="modal-body">--}}
{{--                        <textarea name="bio"  id="bioInput" cols="30" placeholder="ادخل سيرتك الذاتية">--}}
{{--                            {{auth()->user()->bio}}--}}
{{--                        </textarea>--}}
{{--                        <div class="form-group mb-4 row">--}}
{{--                            <div class="col-lg-2 col-md-3 d-flex align-items-center">--}}
{{--                                <label for="name" class="form-label">الاسم الكامل</label>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-10 col-md-9">--}}
{{--                                <input type="text" class="form-control" id="name" name="full_name"--}}
{{--                                       placeholder="{{trans('messages.enter_full_name')}}"   value={{ auth()->user()->full_name}}>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group mb-4 row">--}}
{{--                            <div class="col-lg-2 col-md-3 d-flex align-items-center">--}}
{{--                                <label for="email" class="form-label">البريد الالكتروني</label>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-10 col-md-9">--}}
{{--                                <input type="email" class="form-control" id="email" name="email"--}}
{{--                                       placeholder="{{trans('messages.enter_email')}}" value={{ auth()->user()->email}}>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group mb-4 row">--}}
{{--                            <div class="col-lg-2 col-md-3 d-flex align-items-center">--}}
{{--                                <label for="phone" class="form-label">رقم الجوال</label>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-10 col-md-9">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-xl-3 col-lg-4 col-sm-6">--}}
{{--                                        <select class="form-select form-control" name="country-code"--}}
{{--                                                aria-label="Default select example">--}}
{{--                                            <option selected disabled>اختر كود الدولة</option>--}}
{{--                                            <option value="ksa">+966 المملكة العربية السعودية</option>--}}
{{--                                            --}}{{--                                            <option value="eg">+20 مصر</option>--}}
{{--                                            --}}{{--                                            <option value="eg">+20 مصر</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-xl-9 col-lg-8 col-sm-6">--}}
{{--                                        <input type="text" class="form-control" id="mobile" name="mobile"--}}
{{--                                               placeholder="{{trans('messages.enter_mobile')}}"  value={{ auth()->user()->mobile}} >--}}

{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group mb-4 row">--}}
{{--                            <div class="col-lg-2 col-md-3 d-flex align-items-center">--}}
{{--                                <label for="password" class="form-label">كلمة المرور</label>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-10 col-md-9">--}}
{{--                                <input type="password" class="form-control" id="password" name="password"--}}
{{--                                       placeholder="{{trans('messages.enter_password')}} "--}}
{{--                                    --}}{{--                                       value={{ auth()->user()->password}}--}}
{{--                                >--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group mb-4 row">--}}
{{--                            <div class="col-lg-2 col-md-3 d-flex align-items-center">--}}
{{--                                <label for="password-confirm" class="form-label">تاكيد كلمة المرور</label>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-10 col-md-9">--}}
{{--                                <input type="password" class="form-control" id="password-confirm"--}}
{{--                                       name="password_confirmation" placeholder="{{trans('messages.confirm-password')}}">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                    <div class="modal-footer">--}}
{{--                        <button type="submit" class="btn btn-primary add">اضافة</button>--}}
{{--                        <button type="button" class="btn btn-secondary cancel"--}}
{{--                                data-bs-dismiss="modal">الغاء</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- bio-modal -->--}}


{{--?????????--}}
{{--                                    <div class="col-xl-3 col-lg-4 col-sm-6">--}}
{{--                                        <select class="form-select form-control" name="country-code"--}}
{{--                                                aria-label="Default select example">--}}
{{--                                            <option selected disabled>اختر كود الدولة</option>--}}
{{--                                            <option value="ksa">+966 المملكة العربية السعودية</option>--}}
{{--                                            <option value="eg">+20 مصر</option>--}}
{{--                                            <option value="eg">+20 مصر</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-xl-9 col-lg-8 col-sm-6">--}}
{{--                                        <input type="text" class="form-control" id="mobile" name="mobile"--}}
{{--                                               placeholder="{{trans('messages.enter_mobile')}}"  value={{ auth()->user()->mobile}} >--}}

{{--                                    </div>--}}




















<!-- Modals -->
<!-- edit-photo-modal -->
{{--    <div class="modal user-modal edit-profile-modal fade" id="edit-photo-modal" tabindex="-1"--}}
{{--         aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--        <div class="modal-dialog modal-dialog-centered modal-lg">--}}
{{--            <div class="modal-content">--}}

{{--                <form action="" method="post" enctype="multipart/form-data">--}}
{{--                <form action="{{route('front.update_personal_image')}}" method="post" enctype="multipart/form-data">--}}
{{--                        @csrf--}}
{{--                    <div class="modal-header">--}}
{{--                        <h5 class="modal-title" id="exampleModalLabel">قم باضافة صورة لحسابك</h5>--}}
{{--                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                    </div>--}}
{{--                    <div class="modal-body">--}}
{{--                        <div class="upload-images">--}}
{{--                            <div class="upload-input user-img" id="myImg">--}}
{{--                                <input type="file" id="myImgUploader" name="image">--}}
{{--                                <div class="text" id="uploadText"  name="image">--}}
{{--                                    <p id="uploadText">قم بسحب وافلات الصورة هنا او اضغط للتصفح</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="modal-footer">--}}
{{--                        <button type="submit" class="btn btn-primary add">اضافة</button>--}}
{{--                        <button type="button" class="btn btn-secondary cancel" data-bs-dismiss="modal">الغاء</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
