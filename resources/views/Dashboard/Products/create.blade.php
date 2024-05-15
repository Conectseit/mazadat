@extends('Dashboard.layouts.master')
@section('title', trans('messages.create-var',['var'=>trans('messages.product.product')]))
@section('style')
    <style>
        .form-group input[required] + .label-text:after,
        .form-group select[required] {
            color: #c00;
            content: " *";
            font-family: serif;
        }
    </style>
@endsection
@section('breadcrumb')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')</a>
            </li>
            <li><a href="{{ route('products.index') }}"><i
                            class="icon-admin position-left"></i> @lang('messages.product.products')</a></li>
            <li class="active">@lang('messages.create-var',['var'=>trans('messages.product.product')])</li>
        </ul>
        @include('Dashboard.layouts.parts.quick-links')
    </div>
@endsection

@section('content')
    <div class="row" style="padding: 15px;">
        <div class="col-md-7">

            <!-- Basic layout-->
            <form action="{{ route('products.store') }}" class="form-horizontal" method="post"
                  enctype="multipart/form-data">
                @csrf
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">{{ trans('messages.product.add_new_product') }}</h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                                <li><a data-action="close"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="box-body">

                            <div class="form-group">
                                <label class="col-lg-3 control-label display-block">
                                    {{ trans('messages.category.choose_category') }}
                                </label>
                                <div class="col-lg-6">
                                    <select name="category_id" id="category" class="select">
                                        <optgroup label="{{ trans('messages.category.choose_category') }}">
                                            <option selected disabled>{{trans('messages.select')}}</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" data-status="{{ $category->status }}">
{{--                                                <option value="{{ $category->id }}" data-status="{{ $category->parent->status }}">--}}
                                                    {{ $category->$name }} </option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                                @error('category_id')<span style="color: #e81414;">{{ $message }}</span>@enderror
                            </div>
                            <div class="row" id="real_estate" style="display: none;">
                                @include('Dashboard.Products.parts.real_estate_page')
                            </div>


                        </div>
                    </div>
                    <div class="text-right" style="padding-bottom: 10px; padding-left: 10px;">
                        <input type="submit" class="btn btn-primary"
                               value=" {{ trans('messages.add_and_forward_to_list') }} "/>
                    </div>

                </div>
            </form>
            <!-- /basic layout -->
        </div>

        <div class="col-md-5">
            <div class="panel panel-flat">

                <div class="panel-heading">
                    <h5 class="panel-title"> {{ trans('messages.product.latest_products') }} </h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">
                    <table class="table table-bordered table-hover">
                        <tr class="text-center">
                            <th> {{ trans('messages.name') }} </th>
                            <th> {{ trans('messages.image') }} </th>
                        </tr>
                        @forelse($latest_products as $product)
                            <tr>
                                <td> {{ $product->name_ar }} </td>
                                <td><img src="{{ $product->ImagePath }}" style="height:50px;"/></td>
                            </tr>
                        @empty
                        @endforelse
                    </table>
                </div>

            </div>
        </div>
    </div>

@stop
@section('scripts')
    <script>
        $('select#category').on('change', function () {
            let selectedOption = $(this).find('option:selected');
            let categoryStatus = selectedOption.data('status');
            if (categoryStatus === 'real_estate') {
                document.getElementById("real_estate").style.display = "block";
            } else {
                document.getElementById("real_estate").style.display = "none";
            }
        });
    </script>
@stop




