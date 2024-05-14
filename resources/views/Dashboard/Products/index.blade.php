@extends('Dashboard.layouts.master')
@section('title', trans('messages.product.products'))
@section('breadcrumb')
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')
                    </a>
                </li>
                <li class="active">@lang('messages.product.products')</li>
            </ul>
            @include('Dashboard.layouts.parts.quick-links')
        </div>
@stop
@section('content')
    @include('Dashboard.layouts.parts.validation_errors')
    <!-- Basic datatable -->
    <div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;">
        <div class="panel-heading">
            @include('Dashboard.layouts.parts.table-header', ['collection' => $products, 'name' => 'products', 'icon' => 'products'])
        </div>
        <br>
        <div class="list-icons" style="padding-right: 10px;">
            <a href="{{route('products.create')}}" class="btn btn-success btn-labeled btn-labeled-left"><b><i
                        class="icon-plus2"></i></b>{{ trans('messages.product.add') }}</a>
        </div><br>

        @if($products->count() > 0)
            <table class="table  datatable-button-print-basic" id="products" style="font-size: 16px;">
                <thead>
                <tr style="background-color:gainsboro">
                    <th>#</th>
                    <th>{{ trans('messages.city.city') }}</th>
                    <th>{{ trans('messages.category.category') }}</th>
                    <th>{{ trans('messages.product.district') }}</th>
                    <th>{{ trans('messages.product.property_type') }}</th>
                    <th>{{ trans('messages.product.purpose_of_the_advertisement') }}</th>
                    <th>@lang('messages.since')</th>
                    <th class="text-center">@lang('messages.form-actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr id="product-row-{{ $product->id }}">

                        <td>{{ $loop->iteration }}</td>
                        <td>
                            {{ isNullable($product->city->$name) }}
                        </td>
                        <td>
                            {{ isNullable($product->category->$name) }}
                        </td>

                        <td>
                            <a href={{ route('products.show', $product->id) }}> {{ isNullable($product->$district) }}</a>
                        </td>
                        <td> {{isNullable($product->$property_type) }}</td>
                        <td> {{isNullable($product->purpose_of_the_advertisement) }}</td>
                        <td>{{isset($product->created_at) ? $product->created_at->diffForHumans() :'---' }}</td>
                        <td class="text-center">
                            <div class="list-icons text-center">
                                <div class="list-icons-item dropdown text-center">
                                    <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-{{ floating('right', 'left') }}">
                                        <li>
                                            <a href="{{ route('products.show', $product->id) }}"> <i
                                                    class="icon-eye"></i>@lang('messages.show') </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('products.edit',$product->id) }}"> <i
                                                    class="icon-database-edit2"></i>@lang('messages.edit') </a>
                                        </li>
                                        <li>
                                            <a data-id="{{ $product->id }}" class="delete-action"
                                               href="{{ Url('/product/product/'.$product->id) }}">
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
    @include('Dashboard.layouts.parts.ajax_delete', ['model' => 'product'])
@stop


