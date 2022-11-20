@extends('Dashboard.layouts.master')
@section('title', trans('messages.person.persons'))

@section('style')
{{--    <style>--}}
{{--        @page {--}}
{{--            size: A4;--}}
{{--            margin: 40px;--}}
{{--        }--}}

{{--        @media print {--}}
{{--            html,--}}
{{--            body {--}}
{{--                width: 210mm;--}}
{{--                height: 297mm;--}}
{{--            }--}}
{{--            @-moz-document url-prefix() {}--}}
{{--            .col-sm-1,--}}
{{--            .col-sm-2,--}}
{{--            .col-sm-3,--}}
{{--            .col-sm-4,--}}
{{--            .col-sm-5,--}}
{{--            .col-sm-6,--}}
{{--            .col-sm-7,--}}
{{--            .col-sm-8,--}}
{{--            .col-sm-9,--}}
{{--            .col-sm-10,--}}
{{--            .col-sm-11,--}}
{{--            .col-sm-12,--}}
{{--            .col-md-1,--}}
{{--            .col-md-2,--}}
{{--            .col-md-3,--}}
{{--            .col-md-4,--}}
{{--            .col-md-5,--}}
{{--            .col-md-6,--}}
{{--            .col-md-7,--}}
{{--            .col-md-8,--}}
{{--            .col-md-9,--}}
{{--            .col-md-10,--}}
{{--            .col-md-11,--}}
{{--            .col-smdm-12 {--}}
{{--                float: left;--}}
{{--            }--}}
{{--            .col-sm-12,--}}
{{--            .col-md-12 {--}}
{{--                width: 100%;--}}
{{--            }--}}
{{--            .col-sm-11,--}}
{{--            .col-md-11 {--}}
{{--                width: 91.66666667%;--}}
{{--            }--}}
{{--            .col-sm-10,--}}
{{--            .col-md-10 {--}}
{{--                width: 83.33333333%;--}}
{{--            }--}}
{{--            .col-sm-9,--}}
{{--            .col-md-9 {--}}
{{--                width: 75%;--}}
{{--            }--}}
{{--            .col-sm-8,--}}
{{--            .col-md-8 {--}}
{{--                width: 66.66666667%;--}}
{{--            }--}}
{{--            .col-sm-7,--}}
{{--            .col-md-7 {--}}
{{--                width: 58.33333333%;--}}
{{--            }--}}
{{--            .col-sm-6,--}}
{{--            .col-md-6 {--}}
{{--                width: 50%;--}}
{{--            }--}}
{{--            .col-sm-5,--}}
{{--            .col-md-5 {--}}
{{--                width: 41.66666667%;--}}
{{--            }--}}
{{--            .col-sm-4,--}}
{{--            .col-md-4 {--}}
{{--                width: 33.33333333%;--}}
{{--            }--}}
{{--            .col-sm-3,--}}
{{--            .col-md-3 {--}}
{{--                width: 25%;--}}
{{--            }--}}
{{--            .col-sm-2,--}}
{{--            .col-md-2 {--}}
{{--                width: 16.66666667%;--}}
{{--            }--}}
{{--            .col-sm-1,--}}
{{--            .col-md-1 {--}}
{{--                width: 8.33333333%;--}}
{{--            }--}}
{{--            .col-sm-pull-12 {--}}
{{--                right: 100%;--}}
{{--            }--}}
{{--            .col-sm-pull-11 {--}}
{{--                right: 91.66666667%;--}}
{{--            }--}}
{{--            .col-sm-pull-10 {--}}
{{--                right: 83.33333333%;--}}
{{--            }--}}
{{--            .col-sm-pull-9 {--}}
{{--                right: 75%;--}}
{{--            }--}}
{{--            .col-sm-pull-8 {--}}
{{--                right: 66.66666667%;--}}
{{--            }--}}
{{--            .col-sm-pull-7 {--}}
{{--                right: 58.33333333%;--}}
{{--            }--}}
{{--            .col-sm-pull-6 {--}}
{{--                right: 50%;--}}
{{--            }--}}
{{--            .col-sm-pull-5 {--}}
{{--                right: 41.66666667%;--}}
{{--            }--}}
{{--            .col-sm-pull-4 {--}}
{{--                right: 33.33333333%;--}}
{{--            }--}}
{{--            .col-sm-pull-3 {--}}
{{--                right: 25%;--}}
{{--            }--}}
{{--            .col-sm-pull-2 {--}}
{{--                right: 16.66666667%;--}}
{{--            }--}}
{{--            .col-sm-pull-1 {--}}
{{--                right: 8.33333333%;--}}
{{--            }--}}
{{--            .col-sm-pull-0 {--}}
{{--                right: auto;--}}
{{--            }--}}
{{--            .col-sm-push-12 {--}}
{{--                left: 100%;--}}
{{--            }--}}
{{--            .col-sm-push-11 {--}}
{{--                left: 91.66666667%;--}}
{{--            }--}}
{{--            .col-sm-push-10 {--}}
{{--                left: 83.33333333%;--}}
{{--            }--}}
{{--            .col-sm-push-9 {--}}
{{--                left: 75%;--}}
{{--            }--}}
{{--            .col-sm-push-8 {--}}
{{--                left: 66.66666667%;--}}
{{--            }--}}
{{--            .col-sm-push-7 {--}}
{{--                left: 58.33333333%;--}}
{{--            }--}}
{{--            .col-sm-push-6 {--}}
{{--                left: 50%;--}}
{{--            }--}}
{{--            .col-sm-push-5 {--}}
{{--                left: 41.66666667%;--}}
{{--            }--}}
{{--            .col-sm-push-4 {--}}
{{--                left: 33.33333333%;--}}
{{--            }--}}
{{--            .col-sm-push-3 {--}}
{{--                left: 25%;--}}
{{--            }--}}
{{--            .col-sm-push-2 {--}}
{{--                left: 16.66666667%;--}}
{{--            }--}}
{{--            .col-sm-push-1 {--}}
{{--                left: 8.33333333%;--}}
{{--            }--}}
{{--            .col-sm-push-0 {--}}
{{--                left: auto;--}}
{{--            }--}}
{{--            .col-sm-offset-12 {--}}
{{--                margin-left: 100%;--}}
{{--            }--}}
{{--            .col-sm-offset-11 {--}}
{{--                margin-left: 91.66666667%;--}}
{{--            }--}}
{{--            .col-sm-offset-10 {--}}
{{--                margin-left: 83.33333333%;--}}
{{--            }--}}
{{--            .col-sm-offset-9 {--}}
{{--                margin-left: 75%;--}}
{{--            }--}}
{{--            .col-sm-offset-8 {--}}
{{--                margin-left: 66.66666667%;--}}
{{--            }--}}
{{--            .col-sm-offset-7 {--}}
{{--                margin-left: 58.33333333%;--}}
{{--            }--}}
{{--            .col-sm-offset-6 {--}}
{{--                margin-left: 50%;--}}
{{--            }--}}
{{--            .col-sm-offset-5 {--}}
{{--                margin-left: 41.66666667%;--}}
{{--            }--}}
{{--            .col-sm-offset-4 {--}}
{{--                margin-left: 33.33333333%;--}}
{{--            }--}}
{{--            .col-sm-offset-3 {--}}
{{--                margin-left: 25%;--}}
{{--            }--}}
{{--            .col-sm-offset-2 {--}}
{{--                margin-left: 16.66666667%;--}}
{{--            }--}}
{{--            .col-sm-offset-1 {--}}
{{--                margin-left: 8.33333333%;--}}
{{--            }--}}
{{--            .col-sm-offset-0 {--}}
{{--                margin-left: 0%;--}}
{{--            }--}}
{{--            .visible-xs {--}}
{{--                display: none !important;--}}
{{--            }--}}
{{--            .hidden-xs {--}}
{{--                display: block !important;--}}
{{--            }--}}
{{--            table.hidden-xs {--}}
{{--                display: table;--}}
{{--            }--}}
{{--            tr.hidden-xs {--}}
{{--                display: table-row !important;--}}
{{--            }--}}
{{--            th.hidden-xs,--}}
{{--            td.hidden-xs {--}}
{{--                display: table-cell !important;--}}
{{--            }--}}
{{--            .hidden-xs.hidden-print {--}}
{{--                display: none !important;--}}
{{--            }--}}
{{--            .hidden-sm {--}}
{{--                display: none !important;--}}
{{--            }--}}
{{--            .visible-sm {--}}
{{--                display: block !important;--}}
{{--            }--}}
{{--            table.visible-sm {--}}
{{--                display: table;--}}
{{--            }--}}
{{--            tr.visible-sm {--}}
{{--                display: table-row !important;--}}
{{--            }--}}
{{--            th.visible-sm,--}}
{{--            td.visible-sm {--}}
{{--                display: table-cell !important;--}}
{{--            }--}}
{{--        }--}}

{{--        *{--}}
{{--            font-family: "tajawal",Arial,serif;--}}
{{--        }--}}
{{--        .container {--}}
{{--            color: black;--}}
{{--            font-size: 24px;--}}
{{--            /*border: 20px solid tan;*/--}}
{{--            width: 850px;--}}
{{--            /*height: 563px;*/--}}
{{--            display: table-cell;--}}
{{--            vertical-align: middle;--}}
{{--        }--}}

{{--    </style>--}}
@stop
@section('breadcrumb')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i
                        class="icon-home2 position-left"></i> @lang('messages.home')
                </a>
            </li>
            <li class="active">@lang('messages.person.persons')</li>
        </ul>
        @include('Dashboard.layouts.parts.quick-links')
    </div>
@stop
@section('content')

    <!-- Basic datatable -->
    <div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;">
        @include('Dashboard.layouts.parts.validation_errors')
        <br>
        <div class="list-icons" style="padding-right: 10px;">
            <a href="{{route('persons.create')}}" class="btn btn-success btn-labeled btn-labeled-left"><b><i
                        class="icon-plus2"></i></b>{{ trans('messages.person.add_new_person') }}</a>
            <a href="#" data-toggle="modal" data-target="#send_notify_to_all_users"
               class="btn btn-primary btn-labeled btn-labeled-left"><b><i
                        class="icon-bell3 position-left"></i></b>{{ trans('messages.notification.send_to_all_users') }}
            </a>
        </div>

        <div class="panel-heading">
            @include('Dashboard.layouts.parts.table-header', ['collection' => $persons, 'name' => 'persons', 'icon' => 'person'])
        </div>

        <!-- Basic pills -->
        <div class="row" style="padding: 15px;">
            <div class="col-md-12">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                                <li><a data-action="close"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="tabbable">
                            <ul class="nav nav-pills nav-pills-bordered nav-justified">
                                <li class="active"><a href="#accepted_persons" data-toggle="tab">{{ trans('messages.person.verified') }}</a></li>
                                <li><a href="#not_accepted_persons" data-toggle="tab">{{ trans('messages.person.not_verified') }}</a></li>
                                <li><a href="#not_actived_persons" data-toggle="tab">{{ trans('messages.person.de_active') }}</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="accepted_persons">
                                    <div class="panel-body">
                                        @if($accepted_persons->count() > 0)
                                            <table class="table datatable-button-print-basic" id="persons" style="font-size: 16px;">
                                                <thead>
                                                <tr style="background-color:gainsboro">
                                                    <th class="text-center">{{ trans('messages.person.image') }}</th>

                                                    <th>{{ trans('messages.full_name') }}</th>
                                                    <th>{{ trans('messages.email') }}</th>
                                                    <th class="text-center">{{ trans('messages.ban/not') }}</th>
                                                    <th>@lang('messages.since')</th>
                                                    <th class="text-center">@lang('messages.form-actions')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($accepted_persons as $person)
                                                    <tr id="person-row-{{ $person->id }}">
                                                        <td class="text-center">
                                                            <a href="{{ $person->image_path }}" data-popup="lightbox"><img src="{{ $person->image_path }}" alt="" width="80" height="80" class="img-circle"></a>
                                                        </td>
                                                        <td>
                                                            <a href={{ route('persons.show', $person->id) }}> {{ isNullable($person->full_name) }}</a>
                                                        </td>
                                                        <td> {{ $person->email}}</td>
                                                        <td class="text-center">
                                                            @if($person->ban ==1)
                                                                <a href="{{route('not_ban',$person->id)}}" class="btn btn-danger btn-sm"><i
                                                                        class="icon-close2"></i>{{trans('messages.not_ban')}}</a>
                                                            @else
                                                                <a href="{{route('ban',$person->id)}}" class="btn btn-success btn-sm"> <i
                                                                        class="icon-check2"></i> {{trans('messages.ban')}}</a>
                                                            @endif
                                                        </td>
                                                        <td>{{isset($person->created_at) ?$person->created_at->diffForHumans():'---' }}</td>
                                                        <td class="text-center">
                                                            <ul class="icons-list">
                                                                <li class="dropdown">
                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                        <i class="icon-menu9"></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu dropdown-menu-{{ floating('right', 'left') }}">
                                                                        <li>
                                                                            <a href="{{ route('persons.show',$person->id) }}"> <i
                                                                                    class="icon-eye"></i>@lang('messages.show') </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="{{ route('persons.edit',$person->id) }}"> <i
                                                                                    class="icon-database-edit2"></i>@lang('messages.edit') </a>
                                                                        </li>
                                                                        <li>
                                                                            <a data-id="{{ $person->id }}" class="delete-action"
                                                                               href="{{ Url('/person/person/'.$person->id) }}">
                                                                                <i class="icon-database-remove"></i>@lang('messages.delete')
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <div style="text-align: center;"><h2> @lang('messages.no_data_found') </h2></div>
                                        @endif
                                    </div>
                                </div>

                                <div class="tab-pane" id="not_accepted_persons">
                                    <div class="panel-body">
                                        @if($not_accepted_persons->count() > 0)
                                            <table class="table datatable-button-print-basic" id="persons" style="font-size: 16px;">
                                                <thead>
                                                <tr style="background-color:gainsboro">
                                                    <th class="text-center">{{ trans('messages.person.image') }}</th>
                                                    <th>{{ trans('messages.full_name') }}</th>
                                                    <th>{{ trans('messages.email') }}</th>
                                                    <th class="text-center">{{ trans('messages.ban/not') }}</th>
                                                    <th>@lang('messages.since')</th>
                                                    <th class="text-center">@lang('messages.form-actions')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($not_accepted_persons as $person)
                                                    <tr id="person-row-{{ $person->id }}">
                                                        <td class="text-center">
                                                            <a href="{{ $person->image_path }}" data-popup="lightbox"><img src="{{ $person->image_path }}" alt="" width="80" height="80" class="img-circle"></a>
                                                        </td>
                                                        <td>
                                                            <a href={{ route('persons.show', $person->id) }}> {{ isNullable($person->full_name) }}</a>
                                                        </td>
                                                        <td> {{ $person->email}}</td>
                                                        <td class="text-center">
                                                            @if($person->ban ==1)
                                                                <a href="{{route('not_ban',$person->id)}}" class="btn btn-danger btn-sm"><i
                                                                        class="icon-close2"></i>{{trans('messages.not_ban')}}</a>
                                                            @else
                                                                <a href="{{route('ban',$person->id)}}" class="btn btn-success btn-sm"> <i
                                                                        class="icon-check2"></i> {{trans('messages.ban')}}</a>
                                                            @endif
                                                        </td>
                                                        <td>{{isset($person->created_at) ?$person->created_at->diffForHumans():'---' }}</td>
                                                        <td class="text-center">
                                                            <ul class="icons-list">
                                                                <li class="dropdown">
                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                        <i class="icon-menu9"></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu dropdown-menu-{{ floating('right', 'left') }}">
                                                                        <li>
                                                                            <a href="{{ route('persons.show',$person->id) }}"> <i
                                                                                    class="icon-eye"></i>@lang('messages.show') </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="{{ route('persons.edit',$person->id) }}"> <i
                                                                                    class="icon-database-edit2"></i>@lang('messages.edit') </a>
                                                                        </li>
                                                                        <li>
                                                                            <a data-id="{{ $person->id }}" class="delete-action"
                                                                               href="{{ Url('/person/person/'.$person->id) }}">
                                                                                <i class="icon-database-remove"></i>@lang('messages.delete')
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <div style="text-align: center;"><h2> @lang('messages.no_data_found') </h2></div>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-pane" id="not_actived_persons">
                                    <div class="panel-body">
                                        @if($not_actived_persons->count() > 0)
                                            <table class="table datatable-button-print-basic" id="persons" style="font-size: 16px;">
                                                <thead>
                                                <tr style="background-color:gainsboro">
                                                    <th class="text-center">{{ trans('messages.person.image') }}</th>

                                                    <th>{{ trans('messages.full_name') }}</th>
                                                    <th>{{ trans('messages.email') }}</th>
                                                    <th class="text-center">{{ trans('messages.ban/not') }}</th>
                                                    <th>@lang('messages.since')</th>
                                                    <th class="text-center">@lang('messages.form-actions')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($not_actived_persons as $person)
                                                    <tr id="person-row-{{ $person->id }}">
                                                        {{--                                                        <td>{{ $loop->iteration }}</td>--}}
                                                        <td class="text-center">
                                                            <a href="{{ $person->image_path }}" data-popup="lightbox"><img src="{{ $person->image_path }}" alt="" width="80" height="80" class="img-circle"></a>
                                                        </td>
                                                        <td>
                                                            <a href={{ route('persons.show', $person->id) }}> {{ isNullable($person->full_name) }}</a>
                                                        </td>
                                                        <td> {{ $person->email}}</td>
                                                        <td class="text-center">
                                                            @if($person->ban ==1)
                                                                <a href="{{route('not_ban',$person->id)}}" class="btn btn-danger btn-sm"><i
                                                                        class="icon-close2"></i>{{trans('messages.not_ban')}}</a>
                                                            @else
                                                                <a href="{{route('ban',$person->id)}}" class="btn btn-success btn-sm"> <i
                                                                        class="icon-check2"></i> {{trans('messages.ban')}}</a>
                                                            @endif
                                                        </td>
                                                        <td>{{isset($person->created_at) ?$person->created_at->diffForHumans():'---' }}</td>
                                                        <td class="text-center">
                                                            <ul class="icons-list">
                                                                <li class="dropdown">
                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                        <i class="icon-menu9"></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu dropdown-menu-{{ floating('right', 'left') }}">
                                                                        <li>
                                                                            <a href="{{ route('persons.show',$person->id) }}"> <i
                                                                                    class="icon-eye"></i>@lang('messages.show') </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="{{ route('persons.edit',$person->id) }}"> <i
                                                                                    class="icon-database-edit2"></i>@lang('messages.edit') </a>
                                                                        </li>
                                                                        <li>
                                                                            <a data-id="{{ $person->id }}" class="delete-action"
                                                                               href="{{ Url('/person/person/'.$person->id) }}">
                                                                                <i class="icon-database-remove"></i>@lang('messages.delete')
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <div style="text-align: center;"><h2> @lang('messages.no_data_found') </h2></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /basic pills -->
@include('Dashboard.Persons.notify')
    </div>
    <!-- /basic datatable -->
@stop

@section('scripts')
    @include('Dashboard.layouts.parts.ajax_delete', ['model' => 'person'])


{{--    <script>--}}
{{--        $((function(){"use strict";window.print()}));--}}
{{--    </script>--}}
@stop



