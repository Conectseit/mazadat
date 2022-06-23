@extends('Dashboard.layouts.master')
@section('title', trans('messages.advertisement.advertisements'))
@section('breadcrumb')
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')
                    </a>
                </li>
                <li class="active">@lang('messages.advertisement.advertisements')</li>
            </ul>

            @include('Dashboard.layouts.parts.quick-links')
        </div>
@stop
@section('content')
    @include('Dashboard.layouts.parts.validation_errors')
    <!-- Basic datatable -->
    <div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;">
        <div class="panel-heading">
            @include('Dashboard.layouts.parts.table-header', ['collection' => $advertisements, 'name' => 'advertisements', 'icon' => 'advertisements'])
        </div>
        <br>
        <div class="list-icons" style="padding-right: 10px;">
            <a href="{{route('advertisements.create')}}" class="btn btn-success btn-labeled btn-labeled-left"><b><i
                        class="icon-plus2"></i></b>{{ trans('messages.advertisement.add') }}</a>
        </div><br>

        @if($advertisements->count() > 0)
            <table class="table datatable-basic" id="advertisements" style="font-size: 16px;">
                <thead>
                <tr style="background-color:gainsboro">
                    <th>#</th>
                    <th>{{ trans('messages.image') }}</th>
                    <th>{{ trans('messages.name') }}</th>
                    <th>@lang('messages.since')</th>
                    <th class="text-center">@lang('messages.form-actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($advertisements as $advertisement)
                    <tr id="advertisement-row-{{ $advertisement->id }}">

                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ $advertisement->ImagePath }}" data-popup="lightbox">
                                <img src="{{ $advertisement->ImagePath }}" alt="" width="80" height="80" class="img-circle">
                            </a>
                        </td>

                        <td><a href=''> {{ isNullable($advertisement->$name) }}</a></td>
                        <td>{{isset($advertisement->created_at) ?$advertisement->created_at->diffForHumans():'---' }}</td>
                        <td class="text-center">
                            <div class="list-icons text-center">
                                <div class="list-icons-item dropdown text-center">
                                    <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-{{ floating('right', 'left') }}">
{{--                                        <li>--}}
{{--                                            <a href="{{ route('advertisements.show', $advertisement->id) }}"> <i--}}
{{--                                                    class="icon-eye"></i>@lang('messages.show') </a>--}}
{{--                                        </li>--}}
                                        <li>
                                            <a href="{{ route('advertisements.edit',$advertisement->id) }}"> <i
                                                    class="icon-database-edit2"></i>@lang('messages.edit') </a>
                                        </li>
                                        <li>
                                            <a data-id="{{ $advertisement->id }}" class="delete-action"
                                               href="{{ Url('/advertisement/advertisement/'.$advertisement->id) }}">
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
            <div style="text-align: center;"><h2> @lang('messages.no_data_found') </h2></div>
        @endif
    </div>
    <!-- /basic datatable -->
@stop

@section('scripts')
    @include('Dashboard.layouts.parts.ajax_delete', ['model' => 'advertisement'])
@stop


