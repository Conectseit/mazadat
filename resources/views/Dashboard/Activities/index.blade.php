@extends('Dashboard.layouts.master')
@section('title', trans('messages.activity.activities'))

@section('breadcrumb')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')
                </a>
            </li>
            <li class="active">@lang('messages.activity.activities')</li>
        </ul>
        @include('Dashboard.layouts.parts.quick-links')
    </div>
@stop

@section('content')
    @include('Dashboard.layouts.parts.validation_errors')

    <!-- Basic datatable -->
    <div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;">
        <div class="panel-heading">
            @include('Dashboard.layouts.parts.table-header', ['collection' => $activities, 'name' => 'activities', 'icon' => 'activities'])
        </div>
        <br>

        @if($activities->count() > 0)
            <table class="table datatable-button-print-basic" id="activities" style="font-size: 16px;">
                <thead>
                <tr style="background-color:gainsboro">
                    <th class="text-center">#</th>
                    <th class="text-center">{{ trans('messages.activity.description') }}</th>
                    <th class="text-center">{{ trans('messages.activity.admin_name') }}</th>
                    <th class="text-center">@lang('messages.activity.since')</th>
{{--                    <th class="text-center">@lang('messages.delete')</th>--}}
{{--                    <th class="text-center">@lang('messages.form-actions')</th>--}}
                </tr>
                </thead>
                <tbody>

                @foreach($activities as $activity)
                    <tr id="activity-row-{{ $activity->id }}">

                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center"> {{ isNullable($activity->description) }}</td>
                        <td class="text-center"><a href=""> {{ isNullable($activity->causer->full_name) }}</a></td>
                        <td class="text-center">{{isset($activity->created_at) ?$activity->created_at->diffForHumans():'---' }}</td>
{{--                        <td class="text-center">--}}
{{--                            <div class="list-icons text-center">--}}
{{--                                <a data-id="{{ $activity->id }}" class="delete-action"--}}
{{--                                   href="{{ Url('/activity/activity/'.$activity->id) }}">--}}
{{--                                    <i class="icon-database-remove"></i>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </td>--}}
{{--                        <td class="text-center">--}}
{{--                            <div class="list-icons text-center">--}}
{{--                                <div class="list-icons-item dropdown text-center">--}}
{{--                                    <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">--}}
{{--                                        <i class="icon-menu9"></i>--}}
{{--                                    </a>--}}
{{--                                    <ul class="dropdown-menu dropdown-menu-{{ floating('right', 'left') }}">--}}

{{--                                        <li>--}}
{{--                                            <a data-id="{{ $activity->id }}" class="delete-action"--}}
{{--                                               href="{{ Url('/activity/activity/'.$activity->id) }}">--}}
{{--                                                <i class="icon-database-remove"></i>@lang('messages.delete')--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </td>--}}
                    </tr>
                @endforeach
                </tbody>
            </table>

        @else
            <div style="text-align: center;"><h2> @lang('messages.no_data_found') </h2></div>
        @endif

    </div>
    <!-- /basic datatable -->
@stop

@section('scripts')
    @include('Dashboard.layouts.parts.ajax_delete', ['model' => 'activity'])
@stop



