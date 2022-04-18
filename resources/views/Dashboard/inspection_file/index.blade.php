@extends('Dashboard.layouts.master')
@section('title', trans('messages.inspection_file_names'))

@section('breadcrumb')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')
                </a>
            </li>
            <li class="active">@lang('messages.inspection_file_names')</li>
        </ul>
        @include('Dashboard.layouts.parts.quick-links')
    </div>
@endsection

@section('content')

    @include('Dashboard.layouts.parts.validation_errors')


    <!-- Basic datatable -->
    <div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;">
{{--        <div class="panel-heading">--}}
{{--            @include('Dashboard.layouts.parts.table-header', ['collection' => $inspection_file_names, 'name' => 'inspection_file_names', 'icon' => 'inspection_file_names'])--}}
{{--        </div>--}}
        <br>
        <div class="list-icons" style="padding-right: 10px;">
            <a href="{{route('inspection_file_names.create')}}" class="btn btn-success btn-labeled btn-labeled-left"><b><i
                        class="icon-plus2"></i></b>{{ trans('messages.add') }}</a>
        </div>

        @if($inspection_file_names->count() > 0)
            <table class="table datatable-basic" id="inspection_file_names" style="font-size: 16px;">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('messages.name') }}</th>
{{--                    <th>{{ trans('messages.country.country') }}</th>--}}
                    <th>@lang('messages.since')</th>
                    <th class="text-center">@lang('messages.form-actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($inspection_file_names as $inspection_file_name)
                    <tr id="inspection_file_name-row-{{ $inspection_file_name->id }}">

                        <td>{{ $inspection_file_name->id }}</td>
                        <td><a href=""> {{ isNullable($inspection_file_name->name) }}</a></td>
{{--                        <td><a href=""> {{ isNullable($inspection_file_name->country->$name) }}</a></td>--}}
                        <td>{{isset($inspection_file_name->created_at) ?$inspection_file_name->created_at->diffForHumans():'---' }}</td>
                        <td class="text-center">
                            <div class="list-icons text-center">
                                <div class="list-icons-item dropdown text-center">
                                    <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-{{ floating('right', 'left') }}">
{{--                                        <li>--}}
{{--                                            <a href="{{ route('inspection_file_names.edit',$inspection_file_name->id) }}"> <i--}}
{{--                                                    class="icon-database-edit2"></i>@lang('messages.edit') </a>--}}
{{--                                        </li>--}}
                                        <li>
                                            <a data-id="{{ $inspection_file_name->id }}" class="delete-action"
                                               href="{{ Url('/inspection_file_name/inspection_file_name/'.$inspection_file_name->id) }}">
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
    @include('Dashboard.layouts.parts.ajax_delete', ['model' => 'filename'])
@stop


