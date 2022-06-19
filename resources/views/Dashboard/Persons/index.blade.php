@extends('Dashboard.layouts.master')
@section('title', trans('messages.person.persons'))
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
@stop



