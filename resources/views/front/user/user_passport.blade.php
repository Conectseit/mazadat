@extends('front.layouts.master')
@section('title', trans('messages.user_passport'))
@section('style')
    <style></style>
@endsection

@section('content')


    <section class="my-profile-page edit-profile">


                <div class="container">
                    <nav class="breadcrumb-nav" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('front.my_profile')}}">حسابى</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{trans('messages.user_passport')}}</li>
                        </ol>
                    </nav>
                </div>
        @include('front.layouts.parts.alert')

        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="slogan-right">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="image">
                                    <img src={{Auth::guard('web')->user()->passport_image_path}} alt="my-image">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="info">
                                    <a href="" data-bs-toggle="modal" data-bs-target="#edit-photo-modal">
                                        تعديل صورة جواز السفر
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modals -->
        <!-- edit-photo-modal -->
        <div class="modal user-modal edit-profile-modal fade" id="edit-photo-modal" tabindex="-1"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">

                    <form action="{{route('front.upload_passport')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">قم برفع  جواز السفر الخاص بك</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group mb-4">
                                <i class="fal fa-calendar"></i>
                                <input type="text" class="form-control" placeholder="select passport_expiry_date" id="datepicker"
                                       name="passport_expiry_date" required>
                            </div>
                            <div class="upload-images">
                                <div class="upload-input user-img" id="myImg">
                                    <input type="file" id="myImgUploader" name="passport_image">
                                    <div class="text" id="uploadText"  name="passport_image">
                                        <p id="uploadText">قم بسحب وافلات الصورة هنا او اضغط للتصفح</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary add">اضافة</button>
                            <button type="button" class="btn btn-secondary cancel"
                                    data-bs-dismiss="modal">الغاء</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop

@push('scripts')
    <script>

    </script>
@endpush

































{{--@extends('front.layouts.master')--}}
{{--@section('title', trans('messages.user_passport'))--}}
{{--@section('style')--}}
{{--    <style></style>--}}
{{--@endsection--}}

{{--@section('content')--}}
{{--    <section class="my-wallet-page">--}}
{{--        <div class="container">--}}
{{--            <nav class="breadcrumb-nav" aria-label="breadcrumb">--}}
{{--                <ol class="breadcrumb">--}}
{{--                    <li class="breadcrumb-item"><a href="{{route('front.my_profile')}}">حسابى</a></li>--}}
{{--                    <li class="breadcrumb-item active" aria-current="page"> user_passport</li>--}}
{{--                </ol>--}}
{{--            </nav>--}}
{{--        </div>--}}

{{--        @include('Dashboard.layouts.parts.validation_errors')--}}
{{--        <div class="container">--}}
{{--            <div class="bank-form">--}}
{{--                <form action="{{route('front.upload_passport')}}" method="post" enctype="multipart/form-data">--}}
{{--                    @csrf--}}
{{--                    <h5 class="title">قم برفع  جواز السفر الخاص بك</h5>--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-6">--}}
{{--                            <div class="upload-images">--}}
{{--                                <div class="receipt-img" id="myImg"  name="passport_image">--}}
{{--                                    <img src={{Auth::guard('web')->user()->passport_image_path}} alt="my-image">--}}
{{--                                </div>--}}
{{--                                <div class="text">--}}
{{--                                    <p>رفع صورة</p>--}}
{{--                                    <input type="file" id="myImgUploader"  name="passport_image">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6">--}}
{{--                            <div class="form-group mb-4">--}}
{{--                                <i class="fal fa-calendar"></i>--}}
{{--                                <input type="text" class="form-control" placeholder="select passport_expiry_date" id="datepicker"--}}
{{--                                       name="passport_expiry_date" required>--}}
{{--                            </div>--}}
{{--                            <button type="submit" class="submit-btn">ارسال </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--            <hr>--}}
{{--        </div>--}}
{{--    </section>--}}
{{--@stop--}}

{{--@push('scripts')--}}
{{--    <script>--}}

{{--    </script>--}}
{{--@endpush--}}
