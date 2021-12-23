@extends('Dashboard.layouts.master')
@section('title', trans('messages.city.cities'))
@section('content')

    <!-- Page header -->
    <div class="page-header page-header-default">
        @section('breadcrumb')
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')
                    </a>
                </li>
                <li class="active">@lang('messages.city.cities')</li>
            </ul>
            @include('Dashboard.layouts.parts.quick-links')
        </div>
        @endsection
    </div>
    <!-- /page header -->
    @include('Dashboard.layouts.parts.validation_errors')


    <!-- Basic datatable -->
    <div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;">
        <div class="panel-heading">
            @include('Dashboard.layouts.parts.table-header', ['collection' => $cities, 'name' => 'cities', 'icon' => 'cities'])
        </div>
        <br>
        <div class="list-icons" style="padding-right: 10px;">
            <a href="{{route('cities.create')}}" class="btn btn-success btn-labeled btn-labeled-left"><b><i
                        class="icon-plus2"></i></b>{{ trans('messages.city.add') }}</a>
        </div>

        @if($cities->count() > 0)
            <table class="table datatable-basic" id="cities" style="font-size: 16px;">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('messages.name') }}</th>
{{--                    <th>{{ trans('messages.name_en') }}</th>--}}
                    <th>@lang('messages.since')</th>
                    <th class="text-center">@lang('messages.form-actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cities as $city)
                    <tr id="city-row-{{ $city->id }}">

                        <td>{{ $city->id }}</td>
                        <td><a href=""> {{ isNullable($city->$name) }}</a></td>
{{--                        <td><a href=""> {{ isNullable($city->name_en) }}</a></td>--}}
                        <td>{{isset($city->created_at) ?$city->created_at->diffForHumans():'---' }}</td>
                        <td class="text-center">
                            <div class="list-icons text-center">
                                <div class="list-icons-item dropdown text-center">
                                    <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-{{ floating('right', 'left') }}">
                                        <li>
                                            <a href="{{ route('cities.edit',$city->id) }}"> <i
                                                    class="icon-database-edit2"></i>@lang('messages.edit') </a>
                                        </li>
                                        <li>
                                            <a data-id="{{ $city->id }}" class="delete-action"
                                               href="{{ Url('/city/city/'.$city->id) }}">
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
    @include('Dashboard.layouts.parts.ajax_delete', ['model' => 'city'])
@stop


