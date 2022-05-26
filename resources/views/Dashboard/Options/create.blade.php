{{--@extends('Dashboard.layouts.master')--}}
{{--@section('title', trans('messages.create-var',['var'=>trans('messages.option.option')]))--}}
{{--@section('content')--}}

{{--    <!-- Page header -->--}}
{{--    <div class="page-header page-header-default">--}}
{{--        @section('breadcrumb')--}}
{{--        <div class="breadcrumb-line">--}}
{{--            <ul class="breadcrumb">--}}
{{--                <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')</a>--}}
{{--                </li>--}}
{{--                <li><a href="{{ route('options.index') }}"><i--}}
{{--                            class="icon-admin position-left"></i> @lang('messages.option.options')</a></li>--}}
{{--                <li class="active">{{ trans('messages.option.add') }}</li>--}}
{{--            </ul>--}}

{{--            @include('Dashboard.layouts.parts.quick-links')--}}
{{--        </div>--}}
{{--        @endsection--}}
{{--    </div>--}}
{{--    <!-- /page header -->--}}
{{--    @include('Dashboard.layouts.parts.validation_errors')--}}

{{--    <div class="row" style="padding: 15px;">--}}
{{--        <div class="col-md-6">--}}
{{--            <!-- Basic layout-->--}}
{{--            <form action="{{ route('options.store') }}" class="form-horizontal" method="post"--}}
{{--                  enctype="multipart/form-data">--}}
{{--                @csrf--}}
{{--                <div class="panel panel-flat">--}}
{{--                    <div class="panel-heading">--}}
{{--                        <h5 class="panel-title">{{ trans('messages.option.add') }}</h5>--}}
{{--                        <div class="heading-elements">--}}
{{--                            <ul class="icons-list">--}}
{{--                                <li><a data-action="collapse"></a></li>--}}
{{--                                <li><a data-action="reload"></a></li>--}}
{{--                                <li><a data-action="close"></a></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}


{{--                    <div class="panel-body">--}}
{{--                        <div class="box-body">--}}

{{--                            <div class="form-group">--}}
{{--                                <label--}}
{{--                                    class="col-lg-3 control-label display-block"> {{ trans('messages.auction.category_name') }} </label>--}}
{{--                                <div class="col-lg-9">--}}
{{--                                    <select name="category_id" class="select form-control">--}}
{{--                                        <optgroup label="{{ trans('messages.auction.category_name') }}">--}}
{{--                                            @foreach ($categories as $category)--}}
{{--                                                <option value="{{ $category->id }}"> {{ $category->$name }} </option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <input type="text" class="form-control" value="" name="name_ar"--}}
{{--                                       placeholder="@lang('messages.name_ar') ">--}}
{{--                            </div>--}}

{{--                            <div class="form-group">--}}
{{--                                <input type="text" class="form-control" value="" name="name_en"--}}
{{--                                       placeholder="@lang('messages.name_en') ">--}}
{{--                            </div>--}}

{{--                        </div>--}}

{{--                    </div>--}}
{{--                    <div class="text-right" style="padding-bottom: 10px; padding-left: 10px;">--}}
{{--                        <input type="submit" class="btn btn-primary" value=" {{ trans('messages.add_and_forward_to_list') }} "/>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--            <!-- /basic layout -->--}}
{{--        </div>--}}
{{--        <div class="col-md-6">--}}
{{--            <div class="panel panel-flat">--}}

{{--                <div class="panel-heading">--}}
{{--                    <h5 class="panel-title"> {{ trans('messages.option.last_options') }} </h5>--}}
{{--                    <div class="heading-elements">--}}
{{--                        <ul class="icons-list">--}}
{{--                            <li><a data-action="collapse"></a></li>--}}
{{--                            <li><a data-action="reload"></a></li>--}}
{{--                            <li><a data-action="close"></a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="panel-body">--}}

{{--                    <table class="table table-bordered table-hover">--}}
{{--                        <tr class="text-center">--}}
{{--                            <th> {{ trans('messages.name') }} </th>--}}
{{--                        </tr>--}}
{{--                        @forelse($latest_options as $option)--}}
{{--                            <tr>--}}
{{--                                <td> {{ $option->$name }} </td>--}}
{{--                            </tr>--}}
{{--                        @empty--}}
{{--                        @endforelse--}}
{{--                    </table>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}



{{--@stop--}}



