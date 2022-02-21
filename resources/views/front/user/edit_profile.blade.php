@extends('front.layouts.master')
@section('title', trans('messages.my_profile'))
@section('style')
    <style></style>
@endsection

@section('content')
<section class="my-profile-page edit-profile">

    <div class="container">

        <div class="row">
            @include('front.layouts.parts.alert')

            <div class="col-lg-6">
                <div class="slogan-right">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="image">
                                <img src={{Auth::guard('web')->user()->ImagePath}} alt="my-image">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="slogan-left">
                                <div class="row">
                                    <div class="col-sm-6">
{{--                                        <a href="" data-bs-toggle="modal" data-bs-target="#edit-photo-modal">--}}
{{--                                            تعديل الصورة الشخصية--}}
{{--                                        </a>--}}

                                        <div class="col-sm-12">
                                            <a href="" data-bs-toggle="modal" data-bs-target="#edit-photo-modal">
                                                تعديل الصورة الشخصية
                                            </a>
                                        </div>
{{--                                        <div class="col-sm-12">--}}
{{--                                            <a href="#" data-bs-toggle="modal" data-bs-target="#bio-modal">--}}
{{--                                                تعديل البيانات الشخصية--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
{{--            <div class="col-lg-6">--}}
{{--                <div class="slogan-left">--}}
{{--                    <div class="row">--}}

{{--                        <div class="col-sm-6">--}}
{{--                            <a href="{{route('front.user_documents')}}">--}}
{{--                                 اضافة وثائق رسمية--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <div class="col-sm-6">--}}
{{--                            <a href="#" data-bs-toggle="modal" data-bs-target="#bio-modal">--}}
{{--                                 السيرة الذاتية--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <div class="col-sm-6">--}}
{{--                            <a href="{{route('front.user_passport')}}">--}}
{{--                                اضافة جواز السفر--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>


        @if(auth()->user()->is_completed==1)
            <h3>{{ trans('messages.please_complete_your_data')}}</h3>
        @endif

        <div class="row">
            <div class="edit-form">
                <form action="{{route('front.complete_profile')}}" method="post">
                    @csrf
                    <div class="inputs-group">
                        <h5 class="group-title">{{ trans('messages.please_complete_your_data')}}</h5>
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
                        @if(auth()->user()->is_company=='company')
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="block" class="form-label"> block</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="text" class="form-control" id="name" name="block_id"
                                       placeholder="{{trans('messages.block')}}"   value={{ auth()->user()->block}}>
                            </div>
                        </div>

                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="block" class="form-label"> street</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="text" class="form-control" id="name" name="street_id"
                                       placeholder="{{trans('messages.street')}}"   value={{ auth()->user()->street}}>
                            </div>
                        </div>
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="block" class="form-label"> block_num</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="text" class="form-control" id="name" name="block_num_id"
                                       placeholder="{{trans('messages.block_num')}}"   value={{ auth()->user()->block_num}}>
                            </div>
                        </div>
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="block" class="form-label"> signs</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="text" class="form-control" id="name" name="signs_id"
                                       placeholder="{{trans('messages.signs')}}"   value={{ auth()->user()->signs}}>
                            </div>
                        </div>

                        @endif
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="block" class="form-label"> P_O_Box</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="text" class="form-control" id="name" name="P_O_Box_id"
                                       placeholder="{{trans('messages.P_O_Box')}}"   value={{ auth()->user()->P_O_Box}}>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary submit-btn">تعديل</button>
                    </div>
                </form>
            </div>
        </div>



        <div class="row">
            <div class="edit-form">
                <form action="{{route('front.update_profile')}}" method="post">
                    @csrf
                    <div class="inputs-group">
                        <h5 class="group-title">تعديل الصفحة الشخصية</h5>

                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="name" class="form-label">الاسم الكامل</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="text" class="form-control" id="name" name="first_name"
                                       placeholder="{{trans('messages.enter_first_name')}}"   value={{ auth()->user()->first_name}}>
                            </div>
                        </div>
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="name" class="form-label">الاسم الكامل</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="text" class="form-control" id="name" name="middle_name"
                                       placeholder="{{trans('messages.enter_middle_name')}}"   value={{ auth()->user()->middle_name}}>
                            </div>
                        </div>
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="name" class="form-label">الاسم الكامل</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="text" class="form-control" id="name" name="last_name"
                                       placeholder="{{trans('messages.enter_last_name')}}"   value={{ auth()->user()->last_name}}>
                            </div>
                        </div>
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="name" class="form-label">الاسم الكامل</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="text" class="form-control" id="name" name="user_name"
                                       placeholder="{{trans('messages.enter_user_name')}}"   value={{ auth()->user()->user_name}}>
                            </div>
                        </div>

                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="email" class="form-label">البريد الالكتروني</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="{{trans('messages.enter_email')}}" value={{ auth()->user()->email}}>
                            </div>
                        </div>

                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="phone" class="form-label">رقم الجوال</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-4 col-sm-6">
                                        <select class="form-select form-control" name="country-code"
                                                aria-label="Default select example">
                                            <option selected disabled>اختر كود الدولة</option>
                                            <option value="ksa">+966 المملكة العربية السعودية</option>
                                                                                        <option value="eg">+20 مصر</option>
                                                                                        <option value="eg">+20 مصر</option>
                                        </select>
                                    </div>
                                    <div class="col-xl-9 col-lg-8 col-sm-6">
                                        <input type="text" class="form-control" id="mobile" name="mobile"
                                               placeholder="{{trans('messages.enter_mobile')}}"  value={{ auth()->user()->mobile}} >

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="password" class="form-label">كلمة المرور</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="password" class="form-control" id="password" name="password"
                                       placeholder="{{trans('messages.enter_password')}} "
                                       value={{ auth()->user()->password}}
                                >
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
                        <button type="submit" class="btn btn-primary submit-btn">تعديل</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modals -->
    <!-- edit-photo-modal -->
    <div class="modal user-modal edit-profile-modal fade" id="edit-photo-modal" tabindex="-1"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <form action="{{route('front.update_personal_image')}}" method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">قم باضافة صورة لحسابك</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="upload-images">
                            <div class="upload-input user-img" id="myImg">
                                <input type="file" id="myImgUploader" name="image">
                                <div class="text" id="uploadText"  name="image">
                                    <p id="uploadText">قم بسحب وافلات الصورة هنا او اضغط للتصفح</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary add">اضافة</button>
                        <button type="button" class="btn btn-secondary cancel" data-bs-dismiss="modal">الغاء</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
</section>
@stop

@push('scripts')
    <script>

    </script>
@endpush
