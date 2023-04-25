@extends('Dashboard.layouts.master')
@section('title', trans('messages.edit-var',['var'=>trans('messages.admin.admin')]))

@section('content')


    <!-- Page header -->
    <div class="page-header page-header-default">
        @section('breadcrumb')
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')</a>
                </li>
                <li><a href="{{ route('admins.index') }}"><i
                            class="icon-admin position-left"></i> @lang('messages.admin.admins')</a></li>
                <li class="active">@lang('messages.edit-var',['var'=>trans('messages.admin.admin')])</li>
            </ul>

            @include('Dashboard.layouts.parts.quick-links')
        </div>
        @endsection
    </div>
    <!-- /page header -->


    @include('Dashboard.layouts.parts.validation_errors')


    <div class="row" style="padding: 15px;">
        <div class="col-md-9">


            <!-- Basic layout-->
            <form action="{{ route('admins.update',$admin) }}" class="form-horizontal" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
{{--                <input type="hidden" name="admin_id" value="{{$admin->id}}"/>--}}
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">{{ trans('messages.admin.edit_admin_data') }} </h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                                <li><a data-action="close"></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">

                        <div class="form-group">
                            <input type="text" class="form-control" value="{{$admin->full_name}}" name="full_name" placeholder="@lang('messages.full_name') ">
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">{{ trans('messages.email') }}</label>
                            <div class="col-lg-9">
                                <input type="email" name="email" class="form-control" value="{{ $admin->email }}"
                                       placeholder="{{ trans('messages.email') }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">{{ trans('messages.mobile') }}</label>
                            <div class="col-lg-9">
                                <input type="text" name="mobile" value="{{ $admin->mobile }}" class="form-control"
                                       placeholder="{{ trans('messages.mobile') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label
                                class="col-lg-3 control-label display-block"> {{ trans('messages.admin.admin_role_name') }} </label>
                            <div class="col-lg-9">
                                <select name="admin_role_id" class="select-border-color border-warning form-control">
{{--                                    <option value="null" selected  disabled>{{ trans('back.name_of_job') }}</option>--}}
                                    @foreach ($admin_roles as $role)
                                        <option {{ $admin->admin_role_id == $role->id ? 'selected' : '' }} value="{{ $role->id }}"> {{ $role->name_ar }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="text-right">
                            <input type="submit" class="btn btn-success"
                                   value=" {{ trans('messages.update_and_come_back') }} "/>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /basic layout -->
        </div>
    </div>
@stop
