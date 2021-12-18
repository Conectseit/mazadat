@extends('Dashboard.layouts.master')

@section('title', trans('messages.buyer.buyers'))

@section('content')

    <!-- Page header -->
    <div class="page-header page-header-default">
{{--        <div class="page-header-content">--}}
{{--            <div class="page-title">--}}
{{--                <h4>--}}
{{--                    <i class="icon-arrow-right6 position-left"></i>--}}
{{--                    <span class="text-semibold">@lang('messages.home')</span> - @lang('messages.buyers')--}}
{{--                </h4>--}}
{{--            </div>--}}
{{--        </div>--}}

        @section('breadcrumb')
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')
                    </a>
                </li>
                <li class="active">@lang('messages.buyer.buyers')</li>
            </ul>

            @include('Dashboard.layouts.parts.quick-links')
        </div>
        @endsection
    </div>
    <!-- /page header -->




    <!-- Basic datatable -->
    <div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;">

        <div class="panel-heading">
            @include('Dashboard.layouts.parts.table-header', ['collection' => $buyers, 'name' => 'buyers', 'icon' => 'buyer'])
        </div>
        <br>
        @include('Dashboard.layouts.parts.validation_errors')

        <div class="list-icons" style="padding-right: 10px;">
            <a href="{{route('buyers.create')}}" class="btn btn-success btn-labeled btn-labeled-left"><b><i
                        class="icon-plus2"></i></b>{{ trans('messages.add_new_buyer') }}</a>
        </div>

        @if($buyers->count() > 0)
            <table class="table datatable-basic" id="buyers" style="font-size: 16px;">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('messages.full_name') }}</th>
                    <th>{{ trans('messages.user_name') }}</th>
                    <th>{{ trans('messages.mobile') }}</th>
                    <th>{{ trans('messages.email') }}</th>
                    <th>{{ trans('messages.city_name') }}</th>
                    <th>{{ trans('messages.status') }}</th>
                    <th>@lang('messages.since')</th>
                    <th class="text-center">@lang('messages.form-actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($buyers as $buyer)
                    <tr id="buyer-row-{{ $buyer->id }}">

                        <td>{{ $buyer->id }}</td>

                        <td><a href={{ route('buyers.show', $buyer->id) }}> {{ isNullable($buyer->full_name) }}</a></td>
                        <td> {{ isNullable($buyer->user_name) }}</td>
                        <td> {{ $buyer->mobile}}</td>
                        <td> {{ $buyer->email}}</td>
                        <td> {{isset($buyer->city->$name) ? $buyer->city->$name:''}}</td>

                        <td>

                            @if($buyer->is_accepted  == 0)
                                <span class="badge badge-danger">{{ trans('messages.deactive') }}</span>
                            @else
                                <span class="badge badge-success">{{ trans('messages.active') }}</span>
                            @endif
                        </td>

                        <td>{{isset($buyer->created_at) ? $buyer->created_at->diffForHumans():'---' }}</td>
                        <td class="text-center">
                            <div class="list-icons text-center">
                                <div class="list-icons-item dropdown text-center">
                                    <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-{{ floating('right', 'left') }}">
                                        <li>
                                            <a href="{{ route('buyers.edit',$buyer->id) }}"> <i
                                                    class="icon-database-edit2"></i>@lang('messages.edit') </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('buyers.show',$buyer->id) }}"> <i
                                                    class="icon-eye"></i>@lang('messages.show') </a>
                                        </li>
                                        <li>
                                            <a data-id="{{ $buyer->id }}" class="delete-action"
                                               href="{{ Url('/buyer/buyer/'.$buyer->id) }}">
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
           <center><h2> @lang('messages.no_data_found') </h2></center>
        @endif
    </div>
    <!-- /basic datatable -->
@stop

@section('scripts')
    @include('Dashboard.layouts.parts.ajax_delete', ['model' => 'buyer'])
@stop


