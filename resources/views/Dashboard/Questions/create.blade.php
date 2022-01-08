@extends('Dashboard.layouts.master')

@section('title', trans('messages.create-var',['var'=>trans('messages.question.question')]))

<!-- Page header -->
<div class="page-header page-header-default">
    @section('breadcrumb')
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')</a>
                </li>
                <li><a href="{{ route('questions.index') }}"><i
                            class="icon-admin position-left"></i> @lang('messages.question.questions')</a></li>
                <li class="active">@lang('messages.create-var',['var'=>trans('messages.question.question')])</li>
            </ul>
            @include('Dashboard.layouts.parts.quick-links')
        </div>
    @endsection
</div>
<!-- /page header -->


@section('content')

    @include('Dashboard.layouts.parts.validation_errors')


    <div class="row" style="padding: 15px;">
        <div class="col-md-6">

            <!-- Basic layout-->
            <form action="{{ route('questions.store') }}" class="form-horizontal" method="post"
                  enctype="multipart/form-data">
                @csrf
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">{{ trans('messages.question.add') }}</h5>
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
                                <input type="text" class="form-control" value="" name="question_ar" placeholder="@lang('messages.question.question_ar') ">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" value="" name="question_en" placeholder="@lang('messages.question.question_en') ">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" value="" name="replay_ar" placeholder="@lang('messages.question.replay_ar') ">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" value="" name="replay_en" placeholder="@lang('messages.question.replay_en') ">
                            </div>
                        </div>

                    </div>


                    <div class="text-right" style="padding-bottom: 10px; padding-left: 10px;">
                        <input type="submit" class="btn btn-primary" value=" {{ trans('messages.add_and_forward_to_list') }} "/>
                    </div>
                </div>
            </form>
            <!-- /basic layout -->

        </div>


        <div class="col-md-6">
            <div class="panel panel-flat">

                <div class="panel-heading">
                    <h5 class="panel-title"> {{ trans('messages.question.latest_questions') }} </h5>
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
                            <th> {{ trans('messages.question.question_ar') }} </th>
                            <th> {{ trans('messages.question.question_en') }} </th>
                        </tr>
                        @forelse($latest_questions as $question)
                            <tr>
                                <td> {{ $question->question_ar }} </td>
                                <td> {{ $question->question_en }} </td>
                            </tr>
                        @empty
                        @endforelse
                    </table>
                </div>

            </div>
        </div>
    </div>
@stop



