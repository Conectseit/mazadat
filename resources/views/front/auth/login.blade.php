@extends('front.layouts.master')
@section('title', trans('messages.login'))
@section('style')
@endsection

@section('content')
    @include('front.auctions.parts.head')
    <section class="sign-up-page">
        @include('front.layouts.parts.alert')
        <div class="container" dir="{{ direction() }}">
            <h4 class="title"> {{ trans('messages.login') }}</h4>
            <div class="row">
                <form action="{{route('front.login')}}" method="post" id="submitted-form" enctype="multipart/form-data">
                    @csrf
                    <div class="inputs-group">
                        <h4 class="title" style="color: #d1915c;"> {{ trans('messages.log_in') }}</h4>
                        <p class="mb-5">{{ __('messages.plz_log') }}</p>
                        <div class="mb-4 form-group row">
                            <div class="col-sm-2 d-flex align-items-center">
                                <label for="email" class="form-label"> {{ trans('messages.email_or_mobile') }}</label>
                            </div>
                            <div class="col-sm-8">
                                 <input type="hidden" id="fcm_web_token" name="fcm_web_token" value="">
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                       id="email" name="email" aria-describedby="emailHelp"
{{--                                       value="{{ old('email') }}"--}}
                                       placeholder=" {{ trans('messages.enter_email_or_mobile') }}">
                                @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 form-group row">
                            <div class="col-sm-2 d-flex align-items-center">
                                <label for="password" class="form-label">{{ trans('messages.password') }}</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="password" id="password"  placeholder="{{ trans('messages.enter_password') }}">
                            </div>
                        </div>

                        <div class="mb-4 form-group row">
                            <div class="col-sm-4">
{{--                                {!! NoCaptcha::renderJs() !!}--}}
{{--                                {!! NoCaptcha::display(['data-theme' => 'dark']) !!}--}}
{{--                                {!! NoCaptcha::display() !!}--}}
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3 form-check" >
                                    <input type="checkbox" class="form-check-input" name="remember" id="remember">
                                    <label class="form-check-label" for="remember" > {{ trans('messages.remember') }}</label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <a href="#" class="forgot" data-bs-toggle="modal"
                                   data-bs-target="#forget_pass_modal"> {{ trans('messages.forget_password') }}</a>
                                <a href="#" class="forgot"></a>
                            </div>
                        </div>

                        <div class="sign-btn">
                            <button type="submit"  id="save-form-btn" class="btn btn-primary submit-btn">{{trans('messages.login')}}</button>
                        </div>
{{--                        <div class="sign-btn">--}}
{{--                            <a href="{{route('front.show_register')}}" >{{trans('messages.register')}}</a>--}}
{{--                        </div>--}}



                    </div>
                </form>


            </div>

        </div>
        @include('front.layouts.parts.modal')

    </section>

@stop

@section('js')
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-messaging.js"></script>
    <script>
        $(document).ready(function(){
            const messaging = firebase.messaging();

            messaging.getToken()
                .then(currentToken => {
                    if (currentToken){
                        $('input#fcm_web_token').val(currentToken);
                    } else {
                        console.log('No Instance ID token available. Request permission to generate one.');
                    }
                })
                .catch(err => console.log('An error occurred while retrieving token. ', err));
        });
    </script>
@stop
