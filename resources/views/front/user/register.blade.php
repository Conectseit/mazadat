

@extends('front.layouts.master')
@section('title', trans('messages.register'))
@section('style')
    <style></style>
@endsection

@section('content')
    @include('front.auctions.head')
    <section class="sign-up-page">
        <div class="container">
            <h4 class="title">تسجيل مستخدم جديد</h4>
            <div class="row">
                <form action="">
                    <div class="inputs-group">
                        <h5 class="group-title">البيانات الشخصية</h5>
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
                    </div>

                    <div class="inputs-group">
                        <h5 class="group-title">بيانات حسابك</h5>
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="username" class="form-label">اسم المستخدم</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="text" class="form-control" id="username" name="username"
                                       placeholder="ادخل اسم مستخدم">
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

                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="password-confirm" class="form-label">تاكيد كلمة المرور</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="password" class="form-control" id="password-confirm"
                                       name="password-confirm" placeholder="قم بتاكيد كلمة المرور">
                            </div>
                        </div>
                        <div class="sign-btn">
                            <p>
                                بضغطك على تسجيل حسابك انت توافق على الشروط والاحكام الخاصة
                                بالامارات للمزادات
                            </p>
                            <button type="submit" class="btn btn-primary submit-btn">تسجيل حسابك</button>
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
    </script>
@endpush
