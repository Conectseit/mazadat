@extends('Dashboard.layouts.master')
@section('title', trans('messages.question.questions'))
@section('breadcrumb')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')
                </a>
            </li>
            <li class="active">@lang('messages.question.questions')</li>
        </ul>
        @include('Dashboard.layouts.parts.quick-links')
    </div>
@stop


@section('content')
    @include('Dashboard.layouts.parts.validation_errors')

    <!-- Basic datatable -->
    <div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;">
        <div class="panel-heading">
            @include('Dashboard.layouts.parts.table-header', ['collection' => $questions, 'name' => 'questions', 'icon' => 'questions'])
        </div>
        <br>
        <div class="list-icons" style="padding-right: 10px;">
            <a href="{{route('questions.create')}}" class="btn btn-success btn-labeled btn-labeled-left"><b><i
                        class="icon-plus2"></i></b>{{ trans('messages.question.add') }}</a>
        </div>

        @if($questions->count() > 0)
            <table class="table datatable-button-print-basic" id="questions" style="font-size: 16px;">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('messages.question.question') }}</th>
                    <th>{{ trans('messages.question.replay') }}</th>
                    <th>@lang('messages.since')</th>
                    <th class="text-center">@lang('messages.form-actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($questions as $questionn)
                    <tr id="question-row-{{ $questionn->id }}">
                        <td>{{ $questionn->id }}</td>
                        <td><a href=""> {{ isNullable($questionn->$question) }}</a></td>
                        <td> {{ isNullable($questionn->$replay) }}</td>
                        <td>{{isset($questionn->created_at) ?$questionn->created_at->diffForHumans():'---' }}</td>
                        <td class="text-center">
                            <div class="list-icons text-center">
                                <div class="list-icons-item dropdown text-center">
                                    <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-{{ floating('right', 'left') }}">
                                        <li>
                                            <a href="{{ route('questions.edit',$questionn->id) }}"> <i
                                                    class="icon-database-edit2"></i>@lang('messages.edit') </a>
                                        </li>
                                        <li>
                                            <a data-id="{{ $questionn->id }}" class="delete-action"
                                               href="{{ Url('/question/question/'.$questionn->id) }}">
                                                <i class="icon-database-remove"></i>@lang('messages.delete')
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <center><h2> @lang('messages.no_data_found') </h2></center>
        @endif
    </div>
    <!-- /basic datatable -->
@stop

@section('scripts')
    @include('Dashboard.layouts.parts.ajax_delete', ['model' => 'question'])
@stop


