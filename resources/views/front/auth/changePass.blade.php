@extends('front.layouts.master')
@section('title', trans('messages.activation'))
@section('style')
    <style>
        .box {
            background: white;
            border-radius: 10px;
            border: 1px solid #ccc;
            padding: 20px 10px;
            text-align: center;
        }
        .box strong {
            display: block;
            margin-bottom: 30px;
        }
        .box .code {
            border: 0px;
            text-align: center;
            border-bottom: 3px solid #999;
            width: 30px;
            margin: 0px 10px;
            font-weight: bold;
            font-size: 20px;
            padding-bottom: 5px;
        }

    </style>
@endsection

@section('content')
    @include('front.auctions.parts.head')
    <section class="sign-up-page">
        <div class="container">
            @include('front.layouts.parts.alert')
            <div class="row">
                <form action="{{route('front.resetPassword')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="inputs-group">
                        <h5 class="group-title">{{trans('messages.change_pass')}}</h5>

                        <div class="form-group mb-4 row">
                            <div class="form-group mb-4 row">
                                <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                    <label for="password" class="form-label">{{ trans('messages.password') }}</label>
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
                                           name="password_confirmation" placeholder="{{trans('messages.confirm-password')}}">
                                </div>
                            </div>
                        </div>

                        <div class="sign-btn row">
                            <button type="submit" class="btn btn-primary submit-btn">{{trans('messages.send')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@stop
