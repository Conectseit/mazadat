@extends('front.layouts.master')
@section('title', trans('messages.register'))
@section('style')
    <style> #map { height: 400px;} </style>
@endsection

@section('content')
    @include('front.auctions.head')
    <section class="sign-up-page">
        <div class="container">

            @include('front.layouts.parts.alert')

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success! </strong>
                    {{session('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <form action="{{route('front.login')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h4 class="title">الدخول لحسابك</h4>
                    <p>
                        من فضلك ادخل معلومات الدخول الخاصة بحسابك لتتمكن من استخدام كل خصائص الموقع وإذا لم يكن لديك حسابك؟
                        يمكنك
                        تسجيل مستخدم جديد مجانأ
                    </p>
                    <div class="mb-4 form-group row">
                        <div class="col-sm-2 d-flex align-items-center">
                            <label for="email" class="form-label">ايميل المستخدم</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email" aria-describedby="emailHelp"
                                   value="{{ old('email') }}" placeholder="ادخل بريدك الالكتروني">
                            @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4 form-group row">
                        <div class="col-sm-2 d-flex align-items-center">
                            <label for="password" class="form-label">كلمة المرور</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="password" id="password"  placeholder="ادخل كلمة المرور">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" name="remember" id="remember">
                                        <label class="form-check-label" for="remember">تذكرنى؟</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">

                                    <a href="#" class="forgot" data-bs-toggle="modal"
                                       data-bs-target="#forget_pass_modal">نسيت كلمة المرور؟</a>

                                    {{--                            <a href="#" class="forgot"></a>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8">
                            <button type="submit" class="btn btn-primary submit-btn">الدخول</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </section>

@stop






@push('scripts')

@endpush


