@extends('Dashboard.layouts.master')

@section('title', trans('messages.message.messages'))
    @section('breadcrumb')
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="{{route('admin.home')}}"><i
                            class="icon-home2 position-left"></i> @lang('messages.home')
                    </a>
                </li>
                <li class="active">@lang('messages.message.messages')</li>
            </ul>

            @include('Dashboard.layouts.parts.quick-links')
        </div>
    @stop
@section('content')

    @include('Dashboard.layouts.parts.validation_errors')

    <!-- Basic datatable -->
    <div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;">
        <div class="panel-heading">
            @include('Dashboard.layouts.parts.table-header', ['collection' => $messages, 'name' => 'messages', 'icon' => 'message'])
        </div>
        <br>
        <div class="list-icons" style="padding-right: 10px;">
            <a href="{{route('messages.create')}}" class="btn btn-success btn-labeled btn-labeled-left"><b><i
                        class="icon-plus2"></i></b>{{ trans('messages.add') }}</a>
        </div>

        @if($messages->count() > 0)
            <table class="table datatable-button-print-basic" id="messages" style="font-size: 16px;">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('messages.message.title') }}</th>
                    <th>{{ trans('messages.message.text') }}</th>
                    <th>@lang('messages.since')</th>
                    <th class="text-center">@lang('messages.form-actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($messages as $message)
                    <tr id="message-row-{{ $message->id }}">
                        <td>{{ $message->id }}</td>
                        <td> {{ $message->title}}</td>
                        <td> {{ $message->text}}</td>
                        <td>{{isset($message->created_at) ?$message->created_at->diffForHumans():'---' }}</td>
                        <td class="text-center">
                            <div class="list-icons text-center">
                                <div class="list-icons-item dropdown text-center">
                                    <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-{{ floating('right', 'left') }}">
                                        <li>
                                            <a href="{{ route('messages.edit',$message->id) }}"> <i
                                                    class="icon-database-edit2"></i>@lang('messages.edit') </a>
                                        </li>
                                        <li>
                                            <a data-id="{{ $message->id }}" class="delete-action"
                                               href="{{ Url('/message/message/'.$message->id) }}">
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
            <h2> @lang('messages.no_data_found') </h2>
        @endif
    </div>
    <!-- /basic datatable -->
@stop

@section('scripts')
        @include('Dashboard.layouts.parts.ajax_delete', ['model' => 'message'])
@stop


