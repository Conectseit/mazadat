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
        </div><br>


        <!-- Basic pills -->
        <div class="row" style="padding: 15px;">
            <div class="col-md-12">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h6 class="panel-title">{{ trans('messages.buyer.buyers') }}</h6>
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
                                <li class="active"><a href="#accepted_buyers" data-toggle="tab">{{ trans('messages.accepted') }}</a></li>
                                <li><a href="#not_accepted_buyers" data-toggle="tab">{{ trans('messages.not_accepted') }}</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="accepted_buyers">

                                    <div class="panel-body">
                                        @if($accepted_buyers->count() > 0)
                                            <table class="table datatable-basic" id="buyers" style="font-size: 16px;">
                                                <thead>
                                                <tr style="background-color:gainsboro">
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">{{ trans('messages.full_name') }}</th>
                                                    <th class="text-center">{{ trans('messages.mobile') }}</th>
                                                    <th class="text-center">{{ trans('messages.email') }}</th>
                                                    {{--                    <th class="text-center">{{ trans('messages.city_name') }}</th>--}}
                                                    <th class="text-center">{{ trans('messages.accept/not_accept') }}</th>
                                                    <th class="text-center">@lang('messages.since')</th>
                                                    <th class="text-center">@lang('messages.form-actions')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($accepted_buyers as $buyer)
                                                    <tr id="buyer-row-{{ $buyer->id }}">
                                                        <td class="text-center">{{ $buyer->id }}</td>
                                                        <td class="text-center"><a href={{ route('buyers.show', $buyer->id) }}> {{ isNullable($buyer->full_name) }}</a></td>
                                                        <td class="text-center"> {{ $buyer->mobile}}</td>
                                                        <td class="text-center"> {{ $buyer->email}}</td>
                                                        {{--                        <td class="text-center"> {{isset($buyer->city->$name) ? $buyer->city->$name:''}}</td>--}}

                                                        {{--                        <td class="text-center">--}}

                                                        {{--                            @if($buyer->is_accepted  == 0)--}}
                                                        {{--                                <a href="$buyer/{{$buyer->id}}/de_activate/">--}}
                                                        {{--                                    <span class="badge badge-success">{{ trans('messages.deactive') }}</span>--}}
                                                        {{--                                </a>--}}
                                                        {{--                            @else--}}
                                                        {{--                                <a href="$buyer/{{$buyer->id}}/activate/">--}}
                                                        {{--                                    <span class="badge badge-danger">{{ trans('messages.active') }}</span>--}}
                                                        {{--                                </a>--}}
                                                        {{--                            @endif--}}
                                                        {{--                        </td>--}}

                                                        <td class="text-center">
                                                            @if($buyer->is_accepted ==1)
                                                                <a href="buyer/{{$buyer->id}}/not_accept/" class="btn btn-danger btn-sm"><i class="icon-close2"> </i>{{trans('messages.not_accept')}}</a>
                                                            @else
                                                                <a href="buyer/{{$buyer->id}}/accept/" class="btn btn-success btn-sm">  <i class="icon-check2"></i> {{trans('messages.accept')}}</a>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">{{isset($buyer->created_at) ? $buyer->created_at->diffForHumans():'---' }}</td>
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
                                </div>
                                <div class="tab-pane" id="not_accepted_buyers">
                                    <div class="panel-body">
                                        @if($not_accepted_buyers->count() > 0)
                                            <table class="table datatable-basic" id="buyers" style="font-size: 16px;">
                                                <thead>
                                                <tr style="background-color:gainsboro">
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">{{ trans('messages.full_name') }}</th>
                                                    <th class="text-center">{{ trans('messages.mobile') }}</th>
                                                    <th class="text-center">{{ trans('messages.email') }}</th>
                                                    {{--                    <th class="text-center">{{ trans('messages.city_name') }}</th>--}}
                                                    <th class="text-center">{{ trans('messages.accept/not_accept') }}</th>
                                                    <th class="text-center">@lang('messages.since')</th>
                                                    <th class="text-center">@lang('messages.form-actions')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($not_accepted_buyers as $buyer)
                                                    <tr id="buyer-row-{{ $buyer->id }}">
                                                        <td class="text-center">{{ $buyer->id }}</td>
                                                        <td class="text-center"><a href={{ route('buyers.show', $buyer->id) }}> {{ isNullable($buyer->full_name) }}</a></td>
                                                        <td class="text-center"> {{ $buyer->mobile}}</td>
                                                        <td class="text-center"> {{ $buyer->email}}</td>
                                                        <td class="text-center">
                                                            @if($buyer->is_accepted ==1)
                                                                <a href="buyer/{{$buyer->id}}/not_accept/" class="btn btn-danger btn-sm"><i class="icon-close2"> </i>{{trans('messages.not_accept')}}</a>
                                                            @else
                                                                <a href="buyer/{{$buyer->id}}/accept/" class="btn btn-success btn-sm">  <i class="icon-check2"></i> {{trans('messages.accept')}}</a>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">{{isset($buyer->created_at) ? $buyer->created_at->diffForHumans():'---' }}</td>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /basic pills -->


    </div>
    <!-- /basic datatable -->
@stop

@section('scripts')
    @include('Dashboard.layouts.parts.ajax_delete', ['model' => 'buyer'])
@stop


