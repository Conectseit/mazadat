@extends('Dashboard.layouts.master')

@section('title', trans('messages.create-var',['var'=>trans('messages.message.messages')]))

@section('breadcrumb')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')</a>
            </li>
            <li><a href="{{ route('messages.index') }}"><i
                        class="icon-message position-left"></i> @lang('messages.message.messages')</a></li>
            <li class="active">@lang('messages.create-var',['var'=>trans('messages.message.messages')])</li>
        </ul>
        @include('Dashboard.layouts.parts.quick-links')
    </div>
@endsection
@section('content')

    @include('Dashboard.layouts.parts.validation_errors')
    <div class="row" style="padding: 15px;">
        <div class="col-md-6">

            <!-- Basic layout-->
            <form action="{{ route('messages.store') }}" class="form-horizontal" method="post"
                  enctype="multipart/form-data">
                @csrf
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">{{ trans('messages.add') }}</h5>
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
                                <label class="col-lg-3 control-label">{{ trans('messages.message.title') }}</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" value="" name="title"
                                           placeholder="@lang('messages.message.title') ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">{{ trans('messages.message.text') }}</label>
                                <div class="col-lg-9">
                                    <input type="text" name="text" class="form-control" value="{{ old('text') }}"
                                           placeholder="{{ trans('messages.message.text') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-right" style="padding-bottom: 10px; padding-left: 10px;">
                        <input type="submit" class="btn btn-primary"
                               value=" {{ trans('messages.add_and_forward_to_list') }} "/>
                    </div>
                </div>
            </form>
            <!-- /basic layout -->
        </div>
    </div>

@stop



