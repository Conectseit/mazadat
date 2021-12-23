@extends('Dashboard.layouts.master')
@section('title', trans('messages.edit-var',['var'=>trans('messages.question.question')]))
@section('content')


    <!-- Page header -->
    <div class="page-header page-header-default">
        @section('breadcrumb')
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')</a>
                </li>
                <li><a href="{{ route('questions.index') }}"><i
                            class="icon-admin position-left"></i> @lang('messages.question.questions')</a></li>
                <li class="active">@lang('messages.edit-var',['var'=>trans('messages.question.question')])</li>
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
            <form action="{{ route('questions.update',$question) }}" class="form-horizontal" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">{{ trans('messages.question.edit') }} </h5>
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
                            <input type="text" class="form-control" value="{{$question->question_ar}}" name="question_ar" placeholder="@lang('messages.question_ar') ">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" value="{{$question->question_en}}" name="question_en" placeholder="@lang('messages.question_en') ">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" value="{{$question->replay_ar}}" name="replay_ar" placeholder="@lang('messages.replay_ar') ">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" value="{{$question->replay_en}}" name="replay_en" placeholder="@lang('messages.replay_en') ">
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
