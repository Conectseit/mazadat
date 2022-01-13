@extends('front.layouts.master')
@section('title', trans('messages.activation'))
@section('style')
    <style></style>
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
                            <div class="col-lg-10 col-md-9">
                                <input type="text" class="form-control" id="activation_code" name="activation_code"
                                       placeholder="{{trans('messages.activation_code')}}">
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

                        <div class="sign-btn">
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
    </script>
@endpush
