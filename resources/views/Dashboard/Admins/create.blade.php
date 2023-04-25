@extends('Dashboard.layouts.master')

@section('title', trans('messages.create-var',['var'=>trans('messages.admin.admins')]))

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
                <li class="active">@lang('messages.create-var',['var'=>trans('messages.admin.admins')])</li>
            </ul>

            @include('Dashboard.layouts.parts.quick-links')
        </div>
        @endsection
    </div>
    <!-- /page header -->


    @include('Dashboard.layouts.parts.validation_errors')


    <div class="row" style="padding: 15px;">
        <div class="col-md-6">

            <!-- Basic layout-->
            <form action="{{ route('admins.store') }}" class="form-horizontal" method="post"
                  enctype="multipart/form-data">
                @csrf
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">{{ trans('messages.admin.add_new_admin') }}</h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                                <li><a data-action="close"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-lg-3 control-label">{{ trans('messages.full_name') }}</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" value="" name="full_name"
                                           placeholder="@lang('messages.full_name') ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label
                                    class="col-lg-3 control-label display-block"> {{ trans('messages.admin.admin_role_name') }} </label>
                                <div class="col-lg-9">
                                    <select name="admin_role_id" class="select-border-color border-warning form-control">
                                        @foreach ($admin_roles as $admin_role)
                                            <option value="{{ $admin_role->id }}"> {{ $admin_role->$name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">{{ trans('messages.email') }}</label>
                                <div class="col-lg-9">
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                           placeholder="{{ trans('messages.email') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">{{ trans('messages.mobile') }}</label>
                                <div class="col-lg-9">
                                    <input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control"
                                           placeholder="{{ trans('messages.mobile') }}">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-lg-3 control-label"> {{ trans('messages.password') }} </label>
                                <div class="col-lg-9">
                                    <input type="password" class="form-control" name="password"
                                           placeholder=" {{ trans('messages.password') }} "/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label"> {{ trans('messages.confirm_password') }} </label>
                                <div class="col-lg-9">
                                    <input type="password" class="form-control" name="password_confirmation"
                                           placeholder=" {{ trans('messages.confirm_password') }} "/>
                                </div>
                            </div>

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
                    <div class="text-right" style="padding-bottom: 10px; padding-left: 10px;">
                        <input type="submit" class="btn btn-primary"
                               value=" {{ trans('messages.add_and_forward_to_list') }} "/>
                        {{--                        <input type="submit" class="btn btn-success" name="back" value=" {{ trans('messages.add_and_come_back') }} " />--}}
                    </div>
                </div>
            </form>
            <!-- /basic layout -->

        </div>


        <div class="col-md-6">
            <div class="panel panel-flat">

                <div class="panel-heading">
                    <h5 class="panel-title"> {{ trans('messages.admin.latest_admins') }} </h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">

                    <table class="table table-bordered table-hover">
                        <tr class="text-center">
                            <th> {{ trans('messages.full_name') }} </th>
                            <th> {{ trans('messages.admin.admin_role_name') }} </th>
                        </tr>
                        @forelse($latest_admins as $admin)
                            <tr>
                                <td> {{ $admin->full_name }} </td>
                                <td>{{ $admin->admin_role->$name }}</td>
                            </tr>
                        @empty
                        @endforelse
                    </table>
                </div>

            </div>
        </div>
    </div>

@stop



