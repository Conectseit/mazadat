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
            <h4 class="title"> {{ trans('messages.activation') }}</h4>
{{--            @include('Dashboard.layouts.parts.validation_errors')--}}

            @if(session()->has('error'))
                <div class="alert alert-warning alert-dismissible" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif


            <div class="row">
                <form action="{{route('front.check_code')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="inputs-group">
                        <h5 class="group-title">{{trans('messages.activation')}}</h5>
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="full_name" class="form-label">{{trans('messages.activation_code')}}</label>
                            </div>
                            <div class="col-lg-8 col-md-10">
                                <input type="text" class="form-control d-none" id="activation_code" name="activation_code"
                                       placeholder="{{trans('messages.activation_code')}}">
                                <div class="box">
                                    <strong class="text-dark">{{trans('messages.activation_code')}}</strong>
                                    <input type="text" class="code" tabindex="1" maxlength="1">
                                    <input type="text" class="code" tabindex="2" maxlength="1">
                                    <input type="text" class="code" tabindex="3" maxlength="1">
                                    <input type="text" class="code" tabindex="4" maxlength="1">
                                </div>
                            </div>





{{--                            <div class="row text-center" style="padding-left: 40px;">--}}
{{--                                <div class="col-3">--}}
{{--                                    <input class="num" maxlength="1" style="text-align: center;font-size: 42px;" name="code0" type="text">--}}
{{--                                </div>--}}
{{--                                <div class="col-3">--}}
{{--                                    <input class="num" maxlength="1" style="text-align: center;font-size: 42px;" name="code1" type="text">--}}
{{--                                </div>--}}
{{--                                <div class="col-3">--}}
{{--                                    <input class="num" maxlength="1" style="text-align: center;font-size: 42px;" name="code2" type="text">--}}
{{--                                </div>--}}
{{--                                <div class="col-3">--}}
{{--                                    <input class="num" maxlength="1" style="text-align: center;font-size: 42px;" name="code3" type="text">--}}
{{--                                </div>--}}
{{--                            </div>--}}
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
    <script>
        $(function () {
            lightbox.option({
                resizeDuration: 100,
                fadeDuration: 300,
                fitImagesInViewport: true,
            });
        });
        var items = document.querySelectorAll('.code'),
            lastTabIndex = 4,
            backSpaceCode = 8;
        items.forEach(function(item) {
            item.addEventListener('focus', function(e) {
                e.target.value = '';
            });
            item.addEventListener('keydown', function(e) {
                let keyCode = e.keyCode,
                    currentTabIndex = e.target.tabIndex;
                if (keyCode !== backSpaceCode && currentTabIndex !== lastTabIndex) {
                    document.querySelectorAll('.code').forEach(function(inpt) {
                        if (inpt.tabIndex === currentTabIndex + 1) {
                            setTimeout(function() {
                                inpt.focus();
                            }, 100);
                        }
                    });
                }
            });
        });
    </script>
@endpush