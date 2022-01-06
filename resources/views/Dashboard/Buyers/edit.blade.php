@extends('Dashboard.layouts.master')
@section('title', trans('messages.edit-var',['var'=>trans('messages.buyer.buyer')]))


@section('content')


    <!-- Page header -->
    <div class="page-header page-header-default">
        {{--        <div class="page-header-content">--}}
        {{--            <div class="page-title">--}}
        {{--                <h4>--}}
        {{--                    <i class="icon-arrow-right6 position-left"></i>--}}
        {{--                    <span class="text-semibold">@lang('messages.home')</span>--}}
        {{--                    - @lang('messages.create-var',['var'=>trans('messages.buyer.buyer')])--}}
        {{--                </h4>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        @section('breadcrumb')
            <div class="breadcrumb-line">
                <ul class="breadcrumb">
                    <li><a href="{{route('admin.home')}}"><i
                                class="icon-home2 position-left"></i> @lang('messages.home')</a>
                    </li>
                    <li><a href="{{ route('buyers.index') }}"><i
                                class="icon-admin position-left"></i> @lang('messages.buyer.buyers')</a></li>
                    <li class="active">@lang('messages.edit-var',['var'=>trans('messages.buyer.buyer')])</li>
                </ul>

                @include('Dashboard.layouts.parts.quick-links')
            </div>
        @endsection

    </div>
    <!-- /page header -->

    <div class="row" style="padding: 15px;">
        @include('Dashboard.layouts.parts.validation_errors')

        <div class="col-md-9">


            <!-- Basic layout-->
            <form action="{{ route('buyers.update',$buyer) }}" class="form-horizontal" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                {{--                <input type="hidden" name="buyer_id" value="{{$buyer->id}}"/>--}}
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">{{ trans('messages.buyer_edit') }} </h5>
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
                            <div class="col-lg-9">
                                <input type="text" name="full_name" value="{{ $buyer->full_name }}" class="form-control"
                                       placeholder="{{ trans('messages.full_name') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">{{ trans('messages.user_name') }}</label>
                            <div class="col-lg-9">
                                <input type="text" name="user_name" value="{{ $buyer->user_name }}" class="form-control"
                                       placeholder="{{ trans('messages.user_name') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">{{ trans('messages.email') }}</label>
                            <div class="col-lg-9">
                                <input type="email" name="email" class="form-control" value="{{ $buyer->email }}"
                                       placeholder="{{ trans('messages.email') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">{{ trans('messages.mobile') }}</label>
                            <div class="col-lg-9">
                                <input type="text" name="mobile" value="{{ $buyer->mobile }}" class="form-control"
                                       placeholder="{{ trans('messages.mobile') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>@lang('messages.image')</label>
                            <input type="file" class="form-control image" name="image">
                        </div>
                        <div class="form-group">
                            <img src=" {{$buyer->image_path}} " width=" 100px " value="{{$buyer->image_path}}"
                                 class="thumbnail image-preview">
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
