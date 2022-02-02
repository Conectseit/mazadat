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
    @include('front.auctions.head')
    <section class="sign-up-page">
        <div class="container">
{{--            <h4 class="title"> {{ trans('messages.activation') }}</h4>--}}
            @include('front.layouts.parts.alert')

            <div class="row">
                <form action="{{route('front.check-reset-code')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="inputs-group">
                        <h5 class="group-title">{{trans('messages.email_reset')}}</h5>
{{--                        <p class="mb-4"> </p>--}}

                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="full_name" class="form-label">{{trans('messages.activation_code')}}</label>
                            </div>
                            <div class="col-lg-8 col-md-10">
{{--                                <input type="text" class="form-control d-none" id="activation_code" name="activation_code"--}}
{{--                                       placeholder="{{trans('messages.activation_code')}}">--}}
                                <div class="box">
{{--                                    <strong class="text-dark">{{trans('messages.activation_code')}}</strong>--}}
                                    <input type="text" class="code"  name="code"  maxlength="4" style="width: 120px;"
                                           placeholder="{{trans('messages.enter_activation_code')}}">
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

@push('scripts')
@endpush