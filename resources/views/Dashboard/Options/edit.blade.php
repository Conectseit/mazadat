@extends('Dashboard.layouts.master')
@section('title', trans('messages.edit-var',['var'=>trans('messages.option.option')]))
<!-- Page header -->
<div class="page-header page-header-default">
{{--    @section('breadcrumb')--}}
{{--        <div class="breadcrumb-line">--}}
{{--            <ul class="breadcrumb">--}}
{{--                <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')</a>--}}
{{--                </li>--}}
{{--                <li><a href="{{ route('options.index') }}"><i--}}
{{--                            class="icon-admin position-left"></i> @lang('messages.option.options')</a></li>--}}
{{--                <li class="active">@lang('messages.edit-var',['var'=>trans('messages.option.option')])</li>--}}
{{--            </ul>--}}

{{--            @include('Dashboard.layouts.parts.quick-links')--}}
{{--        </div>--}}
{{--    @endsection--}}
</div>
<!-- /page header -->

@section('content')

    @include('Dashboard.layouts.parts.validation_errors')


    <div class="row" style="padding: 15px;">
        <div class="col-md-9">


            <!-- Basic layout-->
            <form action="{{ route('options.update',$option) }}" class="form-horizontal" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
{{--                <input type="hidden" name="option_id" value="{{$option->id}}"/>--}}
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">{{ trans('messages.option.edit') }} </h5>
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
                            <input type="text" class="form-control" value="{{$option->name_ar}}" name="name_ar" placeholder="@lang('messages.name_ar') ">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" value="{{$option->name_en}}" name="name_en" placeholder="@lang('messages.name_en') ">
                        </div>

                        <div class="text-right">
                            <input type="submit" class="btn btn-success"
                                   value=" {{ trans('messages.update_and_forward_to_list') }} "/>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /basic layout -->

        </div>

    </div>

@stop
