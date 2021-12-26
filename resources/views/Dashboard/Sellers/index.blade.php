@extends('Dashboard.layouts.master')

@section('title', trans('messages.seller.sellers'))

@section('content')

    <!-- Page header -->
    <div class="page-header page-header-default">
        @section('breadcrumb')
            <div class="breadcrumb-line">
                <ul class="breadcrumb">
                    <li><a href="{{route('admin.home')}}"><i
                                class="icon-home2 position-left"></i> @lang('messages.home')
                        </a>
                    </li>
                    <li class="active">@lang('messages.seller.sellers')</li>
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
            @include('Dashboard.layouts.parts.table-header', ['collection' => $sellers, 'name' => 'sellers', 'icon' => 'seller'])
        </div>
        <br>
        <div class="list-icons" style="padding-right: 10px;">
            <a href="{{route('sellers.create')}}" class="btn btn-success btn-labeled btn-labeled-left"><b><i
                        class="icon-plus2"></i></b>{{ trans('messages.add_new_seller') }}</a>
        </div>

        @if($sellers->count() > 0)
            <table class="table datatable-basic" id="seller" style="font-size: 16px;">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('messages.full_name') }}</th>
                    <th>{{ trans('messages.user_name') }}</th>
                    <th>{{ trans('messages.mobile') }}</th>
                    <th>{{ trans('messages.email') }}</th>
                    <th>{{ trans('messages.city_name') }}</th>

                    <th>@lang('messages.since')</th>
                    <th class="text-center">@lang('messages.form-actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sellers as $seller)
                    <tr id="seller-row-{{ $seller->id }}">
                        <td>{{ $seller->id }}</td>

                        <td><a href={{ route('sellers.show', $seller->id) }}> {{ isNullable($seller->full_name) }}</a>
                        </td>
                        <td> {{ isNullable($seller->user_name) }}</td>
                        <td> {{ $seller->mobile}}</td>
                        <td> {{ $seller->email}}</td>
                        <td> {{ $seller->city->$name}}</td>
                        <td>{{isset($seller->created_at) ?$seller->created_at->diffForHumans():'---' }}</td>


                        <td class="text-center">
                            <div class="list-icons text-center">
                                <div class="list-icons-item dropdown text-center">
                                    <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-{{ floating('right', 'left') }}">
                                        <li>
                                            <a href="{{ route('sellers.edit',$seller->id) }}"> <i
                                                    class="icon-database-edit2"></i>@lang('messages.edit') </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('sellers.show',$seller->id) }}"> <i
                                                    class="icon-eye"></i>@lang('messages.show') </a>
                                        </li>
                                        <li>
                                            <a data-id="{{ $seller->id }}" class="delete-action"
                                               href="{{ Url('/seller/seller/'.$seller->id) }}">
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
        @include('Dashboard.layouts.parts.ajax_delete', ['model' => 'seller'])


{{--    <script>--}}
{{--        $('a.delete-action').on('click', function (e) {--}}
{{--            var id = $(this).data('id');--}}
{{--            var tbody = $('table#sellers tbody');--}}
{{--            var count = tbody.data('count');--}}

{{--            e.preventDefault();--}}

{{--            swal({--}}
{{--                title: "هل انت متأكد من حذف هذه العميل",--}}
{{--                // text: "سيتم الحذف بالانتقال لسلة المهملات",--}}
{{--                icon: "warning",--}}
{{--                buttons: true,--}}
{{--                dangerMode: true,--}}
{{--            })--}}
{{--                .then((willDelete) => {--}}
{{--                    if (willDelete) {--}}
{{--                        var tbody = $('table#sellers tbody');--}}
{{--                        var count = tbody.data('count');--}}

{{--                        $.ajax({--}}
{{--                            type: 'POST',--}}
{{--                            url: '{{ route('ajax-delete-seller') }}',--}}
{{--                            data: {id: id},--}}
{{--                            success: function (response) {--}}
{{--                                if (response.deleteStatus) {--}}
{{--                                    // $('#category-row-'+id).fadeOut(); count = count - 1;tbody.attr('data-count', count);--}}
{{--                                    $('#category-row-' + id).remove();--}}
{{--                                    count = count - 1;--}}
{{--                                    tbody.attr('data-count', count);--}}
{{--                                    swal(response.message, {icon: "success"});--}}
{{--                                } else {--}}
{{--                                    swal(response.error);--}}
{{--                                }--}}
{{--                            },--}}
{{--                            error: function (x) {--}}
{{--                                crud_handle_server_errors(x);--}}
{{--                            },--}}
{{--                            complete: function () {--}}
{{--                                if (count == 1) tbody.append(`<tr><td colspan="5"><strong>No data available in table</strong></td></tr>`);--}}
{{--                            }--}}
{{--                        });--}}
{{--                    } else {--}}
{{--                        swal("تم الغاء العمليه");--}}
{{--                    }--}}
{{--                });--}}
{{--        });--}}

{{--    </script>--}}

@stop


