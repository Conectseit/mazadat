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
@endsection


@section('content')

    <!-- Basic datatable -->
    <div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;">
        @include('Dashboard.layouts.parts.validation_errors')

        <div class="panel-heading">
            @include('Dashboard.layouts.parts.table-header', ['collection' => $persons, 'name' => 'persons', 'icon' => 'person'])
        </div>
        <br>
        <div class="list-icons" style="padding-right: 10px;">
            <a href="{{route('persons.create')}}" class="btn btn-success btn-labeled btn-labeled-left"><b><i
                        class="icon-plus2"></i></b>{{ trans('messages.person.add_new_person') }}</a>
        </div>
        <div class="panel-body">
            @if($persons->count() > 0)
                <table class="table datatable-basic" id="persons" style="font-size: 16px;">
                    <thead>
                    <tr style="background-color:gainsboro">
                        <th>#</th>
                        <th class="text-center">{{ trans('messages.person.image') }}</th>

                        <th>{{ trans('messages.full_name') }}</th>
                        <th>{{ trans('messages.mobile') }}</th>
                        <th>{{ trans('messages.email') }}</th>
                        <th>@lang('messages.since')</th>
                        <th class="text-center">@lang('messages.form-actions')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($persons as $person)
                        <tr id="person-row-{{ $person->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-center">
                                <a href="{{ $person->image_path }}" data-popup="lightbox"><img src="{{ $person->image_path }}" alt="" width="80" height="80" class="img-circle"></a>
                            </td>
                            <td>
                                <a href={{ route('persons.show', $person->id) }}> {{ isNullable($person->full_name) }}</a>
                            </td>
                            <td> {{ $person->mobile}}</td>
                            <td> {{ $person->email}}</td>
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
                <center><h2> @lang('messages.no_data_found') </h2></center>
            @endif
        </div>
    </div>
    <!-- /basic datatable -->
@stop

@section('scripts')
    @include('Dashboard.layouts.parts.ajax_delete', ['model' => 'person'])
@stop


