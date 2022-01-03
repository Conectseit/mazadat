@extends('Dashboard.layouts.master')
@section('title', trans('messages.edit-var',['var'=>trans('messages.seller.seller')]))
@section('content')


    <!-- Page header -->
    <div class="page-header page-header-default">
        @section('breadcrumb')
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')</a>
                </li>
                <li><a href="{{ route('sellers.index') }}"><i
                            class="icon-admin position-left"></i> @lang('messages.seller.sellers')</a></li>
                <li class="active">@lang('messages.edit-var',['var'=>trans('messages.seller.seller')])</li>
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
            <form action="{{ route('sellers.update',$seller) }}" class="form-horizontal" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
{{--                <input type="hidden" name="seller_id" value="{{$seller->id}}"/>--}}
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">{{ trans('messages.seller_edit') }} </h5>
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
                            <label class="col-lg-3 control-label">{{ trans('messages.full_name') }}</label>
{{--                            <input type="text" class="form-control" value="{{$seller->full_name}}" name="full_name" placeholder="@lang('messages.full_name') ">--}}
                            <div class="col-lg-9">
                                <input type="text" name="full_name" value="{{ $seller->full_name }}" class="form-control"
                                       placeholder="{{ trans('messages.full_name') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">{{ trans('messages.user_name') }}</label>
                            <div class="col-lg-9">
                                <input type="text" name="user_name" value="{{ $seller->user_name }}" class="form-control"
                                       placeholder="{{ trans('messages.user_name') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">{{ trans('messages.email') }}</label>
                            <div class="col-lg-9">
                                <input type="email" name="email" class="form-control" value="{{ $seller->email }}"
                                       placeholder="{{ trans('messages.email') }}" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">{{ trans('messages.mobile') }}</label>
                            <div class="col-lg-9">
                                <input type="text" name="mobile" value="{{ $seller->mobile }}" class="form-control"
                                       placeholder="{{ trans('messages.mobile') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>@lang('messages.image')</label>
                            <input type="file" class="form-control image" name="image">
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
