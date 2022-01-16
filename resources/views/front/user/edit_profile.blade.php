@extends('front.layouts.master')
@section('title', trans('messages.my_profile'))
@section('style')
    <style></style>
@endsection

@section('content')
===========


<section class="my-profile-page edit-profile">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="slogan-right">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="image">
                                <img src="assets/imgs/user-img.jpg" alt="my-image">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="info">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#edit-photo-modal">
                                    تعديل صورة الملف الشخصى
                                </a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#bio-modal">
                                    تعديل السيرة الذاتية
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6"></div>
        </div>
        <div class="row">
            <div class="edit-form">
                <form action="">
                    <div class="inputs-group">
                        <h5 class="group-title">تعديل الصفحة الشخصية</h5>
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="name" class="form-label">الاسم الكامل</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="ادخل اسمك كاملا">
                            </div>
                        </div>

                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="email" class="form-label">البريد الالكتروني</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="ادخل البريد الالكترونى">
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
                                            <option selected disabled>اختر كود المحافظة</option>
                                            <option value="eg">+20 مصر</option>
                                            <option value="ksa">+995 المملكة العربية السعودية</option>
                                            <option value="eg">+20 مصر</option>
                                        </select>
                                    </div>
                                    <div class="col-xl-9 col-lg-8 col-sm-6">
                                        <input type="number" class="form-control" id="phone" name="phone"
                                               placeholder="ادخل رقم الجوال">
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
                                       placeholder="ادخل كلمة المرور">
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
                <form action="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">قم باضافة صورة لحسابك</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="upload-images">
                            <div class="upload-input user-img" id="myImg">
                                <input type="file" id="myImgUploader">
                                <div class="text" id="uploadText">
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

    <!-- bio-modal -->
    <div class="modal user-modal bio-modal fade" id="bio-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">قم بتغيير سيرتك الذاتية</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <textarea name="bio" id="bioInput" cols="30" placeholder="ادخل سيرتك الذاتية"></textarea>
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
