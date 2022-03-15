@extends('Dashboard.layouts.master')

@section('title', trans('messages.permissions.permissions'))
@section('breadcrumb')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i
                        class="icon-home2 position-left"></i> @lang('messages.home')
                </a>
            </li>
            <li class="active">@lang('messages.permission.permissions')</li>
        </ul>

        @include('Dashboard.layouts.parts.quick-links')
    </div>
@endsection
@section('content')

    @include('Dashboard.layouts.parts.validation_errors')


    <!-- Basic datatable -->
    <div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;">
        <div class="panel-heading">
                        @include('Dashboard.layouts.parts.table-header', ['collection' => $permissions, 'name' => 'permissions', 'icon' => 'permissions'])
        </div>
        <br>
        <div class="list-icons" style="padding-right: 10px;">
            <a href="{{route('permissions.create')}}" class="btn btn-success btn-labeled btn-labeled-left"><b><i
                        class="icon-plus2"></i></b>{{ trans('messages.permission.add') }}</a>
        </div>


        <table class="table datatable-basic" id="permissions" style="font-size: 16px;">
            <thead>
            <tr>
                <th>#</th>
                <th>@lang('messages.permission.name')</th>
{{--                <th>@lang('messages.permission.permissions')</th>--}}

                <th>@lang('messages.since')</th>
                <th class="text-center">@lang('messages.form-actions')</th>
            </tr>
            </thead>
            <tbody>


            @foreach($permissions as $permission)
                <tr id="permission-row-{{ $permission->id }}">

                    <td>{{ $permission->id }}</td>

                    <td>
                        <a href="{{ route('permissions.show', $permission->id) }}">  {{ isNullable($permission->name_ar) }}</a>
                    </td>

{{--                    <td>--}}

{{--                        @if( $permission->id!=1)--}}
{{--                            @foreach($permission->permissions as $key => $value)--}}
{{--                                <span class="badge bg-success badge-pill">{{ trans('messages.' . $key) }}</span>--}}
{{--                            @endforeach--}}

{{--                                                    <span class="badge bg-success badge-pill">{{ trans('messages.permissions') }}</span>--}}

{{--                        @else--}}
{{--                            كل الصلاحيات--}}
{{--                        @endif--}}

{{--                    </td>--}}


                    <td>{{ $permission->created_at->diffForHumans() }}</td>


                    <td class="text-center">
                        {{--@include('permission.includes.edit-delete', ['route' => 'permissions', 'model' => $permission])--}}
                        @if( $permission->id!=1)

                            <ul class="icons-list">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                            class="icon-menu9"></i></a>

                                    <ul class="dropdown-menu dropdown-menu-{{ floating('right', 'left') }}">

                                        <li>
                                            <a href="{{ route('permissions.edit',$permission->id) }}"> <i
                                                    class="icon-database-edit2"></i>@lang('messages.edit') </a>
                                        </li>

                                        <li>
                                            <a data-id="{{ $permission->id }}" class="delete-action"
                                               href="{{ Url('/permission/permission/'.$permission->id) }}">
                                                <i class="icon-database-remove"></i>@lang('messages.delete')
                                            </a>
                                        </li>

                                    </ul>
                                </li>
                            </ul>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /basic datatable -->


@stop

@section('scripts')
    @include('Dashboard.layouts.parts.ajax_delete', ['model' => 'permission'])
@stop

