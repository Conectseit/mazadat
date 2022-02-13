@extends('Dashboard.layouts.master')

@section('title', trans('messages.admin.admins'))

    @section('breadcrumb')
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="{{route('admin.home')}}"><i
                            class="icon-home2 position-left"></i> @lang('messages.home')
                    </a>
                </li>
                <li class="active">@lang('messages.admin.admins')</li>
            </ul>

            @include('Dashboard.layouts.parts.quick-links')
        </div>
    @endsection


@section('content')

    @include('Dashboard.layouts.parts.validation_errors')

    <!-- Basic datatable -->
    <div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;">
        <div class="panel-heading">
            @include('Dashboard.layouts.parts.table-header', ['collection' => $admins, 'name' => 'admins', 'icon' => 'admin'])
        </div>
        <br>
        <div class="list-icons" style="padding-right: 10px;">
            <a href="{{route('admins.create')}}" class="btn btn-success btn-labeled btn-labeled-left"><b><i
                        class="icon-plus2"></i></b>{{ trans('messages.admin.add_new_admin') }}</a>
        </div>

        @if($admins->count() > 0)
            <table class="table datatable-basic" id="admins" style="font-size: 16px;">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('messages.full_name') }}</th>
                    <th>{{ trans('messages.admin.admin_role_name') }}</th>
                    <th>{{ trans('messages.mobile') }}</th>
                    <th>{{ trans('messages.email') }}</th>
                    <th>@lang('messages.since')</th>
                    <th class="text-center">@lang('messages.form-actions')</th>
                </tr>
                </thead>


                <tbody>
                @foreach($admins as $admin)
                    <tr id="admin-row-{{ $admin->id }}">

                        <td>{{ $admin->id }}</td>


                        <td><a href={{ route('admins.show', $admin->id) }}> {{ isNullable($admin->full_name) }}</a>
                        </td>
                        <td> {{ isNullable($admin->admin_role->name_ar) }}</td>
                        <td> {{ $admin->mobile}}</td>
                        <td> {{ $admin->email}}</td>


                        <td>{{isset($admin->created_at) ?$admin->created_at->diffForHumans():'---' }}</td>


                        <td class="text-center">
                            @if( $admin->id!=1)
                            <div class="list-icons text-center">
                                <div class="list-icons-item dropdown text-center">
                                    <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-{{ floating('right', 'left') }}">
                                        <li>
                                            <a href="{{ route('admins.edit',$admin->id) }}"> <i
                                                    class="icon-database-edit2"></i>@lang('messages.edit') </a>
                                        </li>
                                        <li>
                                            <a data-id="{{ $admin->id }}" class="delete-action"
                                               href="{{ Url('/admin/admin/'.$admin->id) }}">
                                                <i class="icon-database-remove"></i>@lang('messages.delete')
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            @endif
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
        @include('Dashboard.layouts.parts.ajax_delete', ['model' => 'admin'])
@stop


