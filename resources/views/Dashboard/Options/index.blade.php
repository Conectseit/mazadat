@extends('Dashboard.layouts.master')

@section('title', trans('messages.option.options'))

@section('content')

    <!-- Page header -->
    <div class="page-header page-header-default">
        @section('breadcrumb')
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')
                    </a>
                </li>
                <li class="active">@lang('messages.option.options')</li>
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
            @include('Dashboard.layouts.parts.table-header', ['collection' => $options, 'name' => 'options', 'icon' => 'options'])
        </div>
        <br>
        <div class="list-icons" style="padding-right: 10px;">
            <a href="{{route('options.create')}}" class="btn btn-success btn-labeled btn-labeled-left"><b><i
                        class="icon-plus2"></i></b>{{ trans('messages.option.add') }}</a>
        </div>

        @if($options->count() > 0)
            <table class="table datatable-basic" id="options" style="font-size: 16px;">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('messages.category.name') }}</th>
                    <th>{{ trans('messages.name') }}</th>
                    <th>@lang('messages.since')</th>
                    <th class="text-center">@lang('messages.form-actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($options as $option)
                    <tr id="option-row-{{ $option->id }}">

                        <td>{{ $option->id }}</td>
                        <td>{{ $option->category->$name }}</td>

                        <td><a href={{ route('options.show', $option->id) }}> {{ isNullable($option->$name) }}</a></td>
                        <td>{{isset($option->created_at) ?$option->created_at->diffForHumans():'---' }}</td>
                        <td class="text-center">
                            <div class="list-icons text-center">
                                <div class="list-icons-item dropdown text-center">
                                    <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-{{ floating('right', 'left') }}">
{{--                                        <li>--}}
{{--                                            <a href="{{ route('options.edit',$option->id) }}"> <i--}}
{{--                                                    class="icon-database-edit2"></i>@lang('messages.edit') </a>--}}
{{--                                        </li>--}}
                                        <li>
                                            <a data-id="{{ $option->id }}" class="delete-action"
                                               href="{{ Url('/option/option/'.$option->id) }}">
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
           <br><div style="margin:50px; padding: 20px;">
                <h2> @lang('messages.no_data_found') </h2>
            </div>
        @endif
    </div>
    <!-- /basic datatable -->


@stop

@section('scripts')
    @include('Dashboard.layouts.parts.ajax_delete', ['model' => 'option'])
@stop


