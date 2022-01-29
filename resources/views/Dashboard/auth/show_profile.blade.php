@extends('Dashboard.layouts.master')

@section('title', trans('messages.admin.admins'))
@section('breadcrumb')
    <div class="breadcrumb-line">
        <ul class="breadcrumb" style="float: {{ floating('right', 'left') }}">
            <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')</a>
            </li>

            <li class="active">@lang('messages.profile')</li>
        </ul>

        @include('Dashboard.layouts.parts.quick-links')
    </div>
@endsection


@section('style')
{{--    <!-- Theme JS files -->--}}
{{--    <script type="text/javascript" src="{{ asset('Dashboard/assets/js/plugins/forms/styling/uniform.min.js') }}"></script>--}}
{{--    <script type="text/javascript" src="{{ asset('Dashboard/assets/js/plugins/forms/styling/switchery.min.js') }}"></script>--}}
{{--    <script type="text/javascript" src="{{ asset('Dashboard/assets/js/plugins/forms/inputs/touchspin.min.js') }}"></script>--}}

{{--    <script type="text/javascript" src="{{ asset('Dashboard/assets/js/core/app.js') }}"></script>--}}
{{--    <script type="text/javascript" src="{{ asset('Dashboard/assets/js/pages/form_input_groups.js') }}"></script>--}}

{{--    <script type="text/javascript" src="{{ asset('Dashboard/assets/js/plugins/ui/ripple.min.js') }}"></script>--}}
{{--    <!-- /theme JS files -->--}}

    <style>
        .admin-profile {
            background-image: url('{{url('http://demo.interface.club/limitless/assets/images/bg.png')}}');
            background-size: contain;
        }
        .admin-image { width: 110px; height: 110px; }
    </style>
@stop



@section('content')


    <!-- Page header -->
{{--    <div class="page-header page-header-default" dir="{{ direction() }}">--}}
{{--        <div class="page-header-content">--}}
{{--            <div class="page-title">--}}
{{--                <h4>--}}
{{--                    <i class="icon-arrow-right6 position-left"></i>--}}
{{--                    <span class="text-semibold">@lang('messages.dashboard')</span> - @lang('messages.profile')--}}
{{--                </h4>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="breadcrumb-line">--}}
{{--            <ul class="breadcrumb" style="float: {{ floating('right', 'left') }}">--}}
{{--                <li><a href=" {{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')</a></li>--}}
{{--                <li class="active">@lang('messages.profile')</li>--}}
{{--            </ul>--}}

{{--            @include('Dashboard.layouts.parts.quick-links')--}}
{{--        </div>--}}
{{--    </div>--}}
    <!-- /page header -->













    @include('Dashboard.layouts.parts.validation_errors')

    <div class="content">
        <div class="row">
            <div class="col-md-3" style="float: {{ floating('right', 'left') }}">

                <div class="sidebar-detached">
                    <div class="sidebar sidebar-default sidebar-separate">
                        <div class="sidebar-content">
                            <!-- User details -->
                            <div class="content-group">
                                <div class="panel-body bg-indigo-400 border-radius-top text-center admin-profile">
                                    <div class="content-group-sm">
                                        <h6 class="text-semibold no-margin-bottom">{{ ucwords($admin->full_name) }}</h6>
                                        <span class="display-block">{{$admin->email}}</span>
                                    </div>
                                    {{--                                    Auth::guard('admin')->user()->ImagePath--}}
                                    <a href="javascript:void(0);" class="display-inline-block content-group-sm">
                                        <img src="{{$admin->image_path}}" class="img-circle img-responsive admin-image" alt="">
                                    </a>
                                </div>

                                <div class="panel no-border-top no-border-radius-top">
                                    <ul class="navigation">
                                        <li class="navigation-header">@lang('messages.main')</li>

                                        <li class="active">
                                            <a href="#profile" data-toggle="tab"><i class="icon-user"></i> @lang('messages.profile')</a>
                                        </li>

                                        <li>
                                            <a href="#schedule" data-toggle="tab"><i class="icon-gear"></i> @lang('messages.edit')</a>
                                        </li>

                                        <li class="navigation-divider"></li>

                                        <li>
                                            <a href="{{ route('admin.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form-2').submit();">
                                                <i class="icon-switch2"></i> @lang('messages.logout')
                                            </a>

                                            <form id="logout-form-2" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /user details -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9" style="float: {{ floating('left', 'right') }}">
                <div class="container-detached">

                    <div class="content-detached">

                        <!-- Tab content -->
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="profile">
                                <!-- Profile info -->
                                <div class="panel panel-flat">
                                    <div class="panel-heading">
                                        <h6 class="panel-title">@lang('messages.profile-info')</h6>
                                    </div>

                                    <div class="panel-body">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>@lang('messages.full_name')</label>
                                                    <input type="text" dir="{{ direction() }}" value="{{ ucwords($admin->full_name) }}" readonly class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>@lang('messages.email')</label>
                                                    <input type="text" dir="{{ direction() }}" value="{{$admin->email}}" readonly class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>@lang('messages.mobile')</label>
                                                    <input type="text" dir="{{ direction() }}" value="{{ !empty(Auth::guard('admin')->user()->mobile) ? Auth::guard('admin')->user()->mobile : trans('messages.no-value') }}" readonly class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>@lang('messages.since')</label>
                                                    <input type="text" dir="{{ direction() }}" value="{{ Auth::guard('admin')->user()->created_at->diffForHumans() }}" readonly class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>@lang('messages.type')</label><br>
                                                    {{--													@if ($admin->is_super_admin == 1)--}}
                                                    {{--														<label class="label label-success">@lang('messages.super-admin')</label>--}}
                                                    {{--													@else--}}
                                                    {{--														<label class="label label-danger">@lang('messages.admin')</label>--}}
                                                    {{--													@endif--}}
                                                    <label class="label label-danger">@lang('messages.admin.admin')</label>

                                                </div>
                                                <div class="col-md-6">
                                                    <label>@lang('messages.form-status')</label><br>
                                                    {{--								                    @if($admin->status == 1)--}}
                                                    {{--                                                        <span class="label label-success">@lang('messages.active')</span>--}}
                                                    {{--								                    @else <span class="label label-danger">@lang('messages.disactive')</span>--}}
                                                    {{--								                    @endif--}}

                                                    <span class="label label-success">@lang('messages.active')</span>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /profile info -->
                            </div>

                            <div class="tab-pane fade" id="schedule">
                                <!-- Account settings -->
                                <div class="panel panel-flat">

                                    <div class="panel-heading"><h6 class="panel-title">@lang('messages.account_settings')</h6></div>

                                    <div class="panel-body">
                                        <form action="{{ route('admin.updateProfile', $admin->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <div class="col-xs-12">
                                                    <div class="form-valid floating @error('full_name') 'has-error' @enderror">
                                                        <label for="full_name">{{ trans('messages.full_name') }}</label>
                                                        <input type="text" value="{{ $admin->full_name }}" class="form-control" name="full_name" id="full_name" dir="{{ direction() }}">
{{--                                                        @error('full_name') <span><strong>{{ $message }}</strong></span> @enderror--}}
                                                    </div><br>

                                                    <div class="form-valid floating @error('email') 'has-error' @enderror">
                                                        <label for="email">{{ trans('messages.email') }}</label>
                                                        <input type="email" value="{{ $admin->email }}" class="form-control" name="email" id="email" dir="{{ direction() }}">
{{--                                                        @error('email') <span><strong>{{ $message }}</strong></span> @enderror--}}
                                                    </div><br>

                                                    <div class="form-valid floating @error('mobile') 'has-error' @enderror">
                                                        <label for="mobile">{{ trans('messages.mobile') }}</label>
                                                        <input type="tel"  value="{{ $admin->mobile }}"maxlength="11" class="form-control" name="mobile" id="mobile" dir="{{ direction() }}">
{{--                                                        @error('mobile') <span><strong>{{ $message }}</strong></span> @enderror--}}
                                                    </div><br>

                                                    <div class="form-valid floating @error('password') 'has-error' @enderror">
                                                        <label for="password">{{ trans('messages.password') }}</label>
                                                        <input type="password" class="form-control" name="password" id="password" dir="{{ direction() }}">
{{--                                                        @error('password') <span><strong>{{ $message }}</strong></span> @enderror--}}
                                                    </div><br>

                                                    <div class="form-valid floating">
                                                        <label for="password_confirmation">{{ trans('messages.confirm_password') }}</label>
                                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" dir="{{ direction() }}">
                                                    </div><br>

{{--                                                    <div class="col-xs-12 @error('image') 'has-error' @enderror">--}}
{{--                                                        <div class="row img-media">--}}
{{--                                                            <div class="col-xs-12">--}}
{{--                                                                <div class="form-valid">--}}
{{--                                                                    <label for="image">{{ trans('messages.image') }}</label><br>--}}
{{--                                                                    <input type="file"value="{{ $admin->image_path }}" class="file-styled form-control" id="image" accept="image/*" name="image">--}}
{{--                                                                    @error('image') <span><strong>{{ $message }}</strong></span> @enderror--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}



                                                    <div class="form-group">
                                                        <label>@lang('messages.image')</label>
                                                        <input type="file" class="form-control image " name="image">
                                                    </div>

                                                    <div class="form-group">
                                                        <img src=" {{ asset('uploads/default.png') }} " width=" 100px "
                                                             class="thumbnail image-preview">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="text-right">
                                                <input type="submit" name="submit" class="btn btn-primary" value="@lang('messages.save')">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- /account settings -->
                            </div>
                        </div>
                        <!-- /tab content -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
















{{--@section('content')--}}

{{--    <!-- Page header -->--}}
{{--    <div class="page-header page-header-default">--}}
{{--        @section('breadcrumb')--}}
{{--            <div class="breadcrumb-line">--}}
{{--                <ul class="breadcrumb">--}}
{{--                    <li><a href="{{route('admin.home')}}"><i--}}
{{--                                class="icon-home2 position-left"></i> @lang('messages.home')--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="active">@lang('messages.admin.admins')</li>--}}
{{--                </ul>--}}

{{--                @include('Dashboard.layouts.parts.quick-links')--}}
{{--            </div>--}}
{{--        @endsection--}}
{{--    </div>--}}
{{--    <!-- /page header -->--}}


{{--    @include('Dashboard.layouts.parts.validation_errors')--}}

{{--    <div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;">--}}
{{--        <div class="panel-heading">--}}
{{--            @include('Dashboard.layouts.parts.table-header', ['collection' => $admins, 'name' => 'admins', 'icon' => 'admin'])--}}
{{--        </div>--}}
{{--        <br>--}}
{{--        <div class="list-icons" style="padding-right: 10px;">--}}
{{--            <a href="{{route('admins.create')}}" class="btn btn-success btn-labeled btn-labeled-left"><b><i--}}
{{--                        class="icon-plus2"></i></b>{{ trans('messages.admin.add_new_admin') }}</a>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@stop--}}

{{--@section('scripts')--}}
{{--    @include('Dashboard.layouts.parts.ajax_delete', ['model' => 'admin'])--}}
{{--@stop--}}


