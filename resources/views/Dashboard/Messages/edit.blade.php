@extends('Dashboard.layouts.master')
@section('title', trans('messages.edit-var',['var'=>trans('messages.message.message')]))

    @section('breadcrumb')
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')</a>
                </li>
                <li><a href="{{ route('messages.index') }}"><i
                            class="icon-message position-left"></i> @lang('messages.message.messages')</a></li>
                <li class="active">@lang('messages.edit-var',['var'=>trans('messages.message.message')])</li>
            </ul>

            @include('Dashboard.layouts.parts.quick-links')
        </div>
    @endsection

@section('content')

    @include('Dashboard.layouts.parts.validation_errors')


    <div class="row" style="padding: 15px;">
        <div class="col-md-9">
            <!-- Basic layout-->
            <form action="{{ route('messages.update',$message) }}" class="form-horizontal" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">{{ trans('messages.edit') }} </h5>
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
                            <input type="text" class="form-control" value="{{$message->title}}" name="title" placeholder="@lang('messages.title') ">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" value="{{$message->text}}" name="text" placeholder="@lang('messages.text') ">
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
