@extends('Dashboard.layouts.master')

@section('title', trans('messages.login'))
@section('content')

    <body class="login-cover"
          {{--          style="background-image: url({{ asset('Dashboard/assets/images/login_cover.jpg') }}); background-repeat: no-repeat; background-size: cover;">--}}
          style="background-image: url({{ asset('Dashboard/assets/images/backgrounds/user_bg4.jpg') }}); background-repeat: no-repeat; background-size: cover;">
    <!-- Content area -->


    <center>
        <div style="width: 420px;height: 520px; padding-top: 50px; ">

        @include('Dashboard.layouts.parts.validation_errors')

        <!-- Form with validation -->
            <form method="Post" action="{{ route('admin.submit.login') }}" class="form-validate">
                @csrf
                <div class="panel panel-body login-form" style=" box-shadow: 4px 2px 5px #aaa; border-radius:  20px;">
                    <div class="text-center">

                        <div class="icon-object border-slate-300 text-slate-300">

                            <img src=" {{ asset('uploads/mazadat_logo.jpg') }} " width=" 200px"
                                 class="img-circle">
{{--                            <i class="icon-reading"></i>--}}
                        </div>
                        <h5 class="content-group">@lang('messages.log_in') <small class="display-block">Your
                                credentials</small></h5>
                    </div>

                    <div class="form-group has-feedback has-feedback-left">
                        <input type="email" class="form-control" value="{{ old('email') }}"
                               placeholder="@lang('messages.email')"
                               name="email" autocomplete="email">
                        <div class="form-control-feedback">
                            <i class="icon-user text-muted"></i>
                        </div>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                        	<strong style="color: red;">{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group has-feedback has-feedback-left">
                        <input type="password" class="form-control"
                               placeholder="@lang('messages.password')" name="password" autocomplete="password">
                        <div class="form-control-feedback">
                            <i class="icon-lock2 text-muted"></i>
                        </div>

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong style="color: red;">{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group login-options">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="checkbox-inline">
                                    <input type="checkbox" class="styled" checked="checked">
                                    Remember
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn bg-pink-400 btn-block">@lang('messages.Login')
                            <i class="icon-arrow-left13 position-right"></i></button>
                    </div>
                </div>
            </form>
            <!-- /form with validation -->


            <div class=" text-muted text-center mt-10" >
                <h2>&copy; {{ date('Y') }}. developed by <a href="" arget="_blank">Connect</a></h2>
            </div>
            <!-- /footer -->

        </div>
    </center>
    <!-- /content area -->
    </body>
@stop
