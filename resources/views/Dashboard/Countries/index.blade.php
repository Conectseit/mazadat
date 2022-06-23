@extends('Dashboard.layouts.master')
@section('title', trans('messages.country.countries'))

    @section('breadcrumb')
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')
                    </a>
                </li>
                <li class="active">@lang('messages.country.countries')</li>
            </ul>
            @include('Dashboard.layouts.parts.quick-links')
        </div>
    @stop
@section('content')
    @include('Dashboard.layouts.parts.validation_errors')

    <!-- Basic datatable -->
    <div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;">
        <div class="panel-heading">
            @include('Dashboard.layouts.parts.table-header', ['collection' => $countries, 'name' => 'countries', 'icon' => 'countries'])
        </div>
        <br>
        <div class="list-icons" style="padding-right: 10px;">
            <a href="{{route('countries.create')}}" class="btn btn-success btn-labeled btn-labeled-left"><b><i
                        class="icon-plus2"></i></b>{{ trans('messages.country.add') }}</a>
        </div>

        @if($countries->count() > 0)
            <table class="table datatable-basic" id="countries" style="font-size: 16px;">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">{{ trans('messages.country.phone_code') }}</th>
                    <th class="text-center">{{ trans('messages.name') }}</th>
                    <th class="text-center">@lang('messages.since')</th>
                    <th class="text-center">@lang('messages.form-actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($countries as $country)
                    <tr id="country-row-{{ $country->id }}">

                        <td class="text-center">{{ $country->id }}</td>
                        <td class="text-center"><a href=""> {{ isNullable($country->phone_code) }}</a></td>
                        <td class="text-center"><a href=""> {{ isNullable($country->$name) }}</a></td>
                        <td class="text-center">{{isset($country->created_at) ?$country->created_at->diffForHumans():'---' }}</td>
                        <td class="text-center">
                            <div class="list-icons text-center">
                                <div class="list-icons-item dropdown text-center">
                                    <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-{{ floating('right', 'left') }}">
                                        <li>
                                            <a href="{{ route('countries.edit',$country->id) }}"> <i
                                                    class="icon-database-edit2"></i>@lang('messages.edit') </a>
                                        </li>
                                        <li>
                                            <a data-id="{{ $country->id }}" class="delete-action"
                                               href="{{ Url('/country/country/'.$country->id) }}">
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
    @include('Dashboard.layouts.parts.ajax_delete', ['model' => 'country'])
@stop


