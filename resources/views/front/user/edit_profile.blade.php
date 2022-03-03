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
                            @if(auth()->user()->is_company=='person')

                                <div class="form-group row mb-4">
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input type='file' id="imageUpload" name="image"
                                                {{--                                           accept=".png, .jpg, .jpeg"--}}/>
                                            <label for="imageUpload"></label>
                                        </div>
                                        <div class="avatar-preview">
                                            <div id="imagePreview"
                                                 style="background-image: url({{auth()->user()->image_path}});"></div>
                                        </div>

                                    </div>
                                </div>
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
                                             src={{ asset('uploads/images.jpg') }}
                                             {{--                                "https://assets.wasalt.com/others/icons/villas-for-sale-in-makkah.jpeg"--}}

                                                 width="250px"/>
                                    </div>
                                </div>
                                <div class="form-group row ">
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
                                             src="{{ asset('uploads/images.jpg') }}"
                                             width="250px"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>@lang('messages.company_location'):</label>
                                    <div class="col-lg-12">
                                        {{--                                    <input id="searchInput" class=" form-control"  placeholder=" اختر المكان علي الخريطة " name="other">--}}
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
                                        <div class="col-xl-3 col-lg-4 col-sm-6" 3>
                                            <select class="form-select form-control" name="phone_code"
                                                    aria-label="Default select example">
                                                <option selected
                                                        disabled>{{ isset(auth()->user()->country)? auth()->user()->country->$name :  trans('messages.choose_country_code') }}</option>
                                                {{--                                            <option selected disabled> {{ trans('messages.choose_country_code')}}</option>--}}
                                                @foreach ($countries as $country)
                                                    <option
                                                        value="{{ $country->phone_code }}"> {{ $country->$name }}{{ $country->phone_code }} </option>
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
                                    </div>
                                </div>
                            </div>

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
            <div class="row">
                <div class="edit-form">
                    <form action="{{route('front.complete_profile')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="inputs-group">
                            <h5 class="group-title">{{ trans('messages.please_complete_your_address_details')}}</h5>
                            <div class="form-group mb-4 row">
                                <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                    <label for="full_name"
                                           class="form-label"> {{ trans('messages.nationality.nationality') }}</label>
                                </div>
                                <div class="col-lg-10 col-md-9">
                                    <select class=" select form-select form-control" name="nationality_id"
                                            aria-label="Default select example">
                                        {{--                                        <option selected disabled>{{trans('messages.select')}}</option>--}}
                                        <option selected
                                                disabled>{{ isset(auth()->user()->nationality)? auth()->user()->nationality->$name :  trans('messages.select') }}</option>

                                        {{--                                        <option selected disabled>{{ auth()->user()->nationality->$name }}</option>--}}

                                        @foreach ($nationalities as $nationality)
                                            <option value="{{ $nationality->id }}"> {{ $nationality->$name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mb-4 row">
                                <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                    <label for="city_name" class="form-label"> {{ trans('messages.city_name') }}</label>
                                </div>
                                <div class="col-lg-10 col-md-9">
                                    <select class=" select form-select form-control" id="cities" name="city_id"
                                            aria-label="Default select example">

                                        <option selected
                                                disabled>{{ isset(auth()->user()->city)? auth()->user()->city->$name :  trans('messages.select') }}</option>

                                        {{--                                        <option selected disabled>{{ auth()->user()->city->$name }}</option>--}}
                                        @foreach ($cities as $city)
                                            {{--                                            <option  disabled>{{trans('messages.select')}}</option>--}}
                                            <option value="{{ $city->id }}"> {{ $city->$name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mb-4 row">
                                <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                    <label for="block" class="form-label"> {{trans('messages.P_O_Box')}}</label>
                                </div>
                                <div class="col-lg-10 col-md-9">
                                    <input type="text" class="form-control" id="name" name="P_O_Box"
                                           placeholder="{{trans('messages.P_O_Box')}}"
                                           value={{ auth()->user()->P_O_Box}}>
                                </div>
                            </div>
                            @if(auth()->user()->is_company=='person')
                                <div class="form-group mb-4 row">
                                    <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                        <label for="block" class="form-label"> {{trans('messages.block')}}</label>
                                    </div>
                                    <div class="col-lg-10 col-md-9">
                                        <input type="text" class="form-control" id="name" name="block"
                                               placeholder="{{trans('messages.block')}}"
                                               value={{ auth()->user()->block}}>
                                    </div>
                                </div>

                                <div class="form-group mb-4 row">
                                    <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                        <label for="block" class="form-label"> {{trans('messages.street')}}</label>
                                    </div>
                                    <div class="col-lg-10 col-md-9">
                                        <input type="text" class="form-control" id="name" name="street"
                                               placeholder="{{trans('messages.street')}}"
                                               value={{ auth()->user()->street}}>
                                    </div>
                                </div>
                                <div class="form-group mb-4 row">
                                    <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                        <label for="block" class="form-label"> {{trans('messages.block_num')}}</label>
                                    </div>
                                    <div class="col-lg-10 col-md-9">
                                        <input type="text" class="form-control" id="name" name="block_num"
                                               placeholder="{{trans('messages.block_num')}}"
                                               value={{ auth()->user()->block_num}}>
                                    </div>
                                </div>
                                <div class="form-group mb-4 row">
                                    <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                        <label for="block" class="form-label"> {{trans('messages.signs')}}</label>
                                    </div>
                                    <div class="col-lg-10 col-md-9">
                                        <input type="text" class="form-control" id="name" name="signs"
                                               placeholder="{{trans('messages.signs')}}"
                                               value={{ auth()->user()->signs}}>
                                    </div>
                                </div>




                                {{--                            <div class="form-group mb-4  row ">--}}
                                {{--                                <div class="col-lg-2 col-md-3 d-flex align-items-center">--}}
                                {{--                                    <label>@lang('messages.passport_image')</label>--}}
                                {{--                                </div>--}}
                                {{--                                <div class="col-lg-8 col-sm-12 d-flex align-items-center">--}}
                                {{--                                    <input type="file" class="form-control " name="passport_image" accept="image/*" onchange="readURL(this)" />--}}
                                {{--                                </div>--}}
                                {{--                                <div class="col-lg-2 col-sm-12 d-flex align-items-center">--}}
                                {{--                                    <img  id="img-preview" style="width: 180px ; hight:50px" src="https://ami-sni.com/wp-content/themes/consultix/images/no-image-found-360x250.png" width="250px" />--}}
                                {{--                                </div>--}}
                                {{--                            </div>--}}




                                <div class="form-group mb-4 row">
                                    <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                        <label for="block" class="form-label"> @lang('messages.passport_image')</label>
                                    </div>
                                    <div class="col-lg-10 col-md-9">
                                        <input type="file" class="form-control image " name="passport_image">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <img src=" {{auth()->user()->passport_image_path}} " width=" 100px "
                                         value="{{auth()->user()->passport_image_path}}"
                                         class="thumbnail image-preview">
                                </div>

                            @endif


                            <button type="submit" class="btn btn-primary submit-btn">اضافة</button>
                        </div>
                    </form>
                </div>
            </div>


        </div>


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


    </section>
@stop

@push('scripts')
    <script>

        // ======== image preview ====== //
        $(".image").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.image-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imageUpload").change(function () {
            readURL(this);
        });
    </script>

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
