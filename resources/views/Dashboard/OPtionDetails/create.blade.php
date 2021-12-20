@extends('Dashboard.layouts.master')
@section('title', trans('messages.create-var',['var'=>trans('messages.option.option_details')]))
@section('content')

    <!-- Page header -->
    <div class="page-header page-header-default">
        @section('breadcrumb')
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')</a>
                </li>
                <li><a href="{{ route('option_details.index') }}"><i
                            class="icon-admin position-left"></i> @lang('messages.option.option_details')</a></li>
                <li class="active">{{ trans('messages.option_detail.add') }}</li>
            </ul>

            @include('Dashboard.layouts.parts.quick-links')
        </div>
        @endsection
    </div>
    <!-- /page header -->
    @include('Dashboard.layouts.parts.validation_errors')

    <div class="row" style="padding: 15px;">
        <div class="col-md-6">
            <!-- Basic layout-->
            <form action="{{ route('option_details.store') }}" class="form-horizontal" method="post"
                  enctype="multipart/form-data">
                @csrf
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">{{ trans('messages.option_detail.add') }}</h5>
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
                                <label
                                    class="col-lg-3 control-label display-block"> {{ trans('messages.option.name') }} </label>
                                <div class="col-lg-9">
                                    <select name="option_id" class="select-border-color border-warning form-control">
                                        <optgroup label="{{ trans('messages.option.name') }}">
                                            @foreach ($options as $option)
                                                <option value="{{ $option->id }}"> {{ $option->$name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" value="" name="value_ar"
                                       placeholder="@lang('messages.value_ar') ">
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" value="" name="value_en"
                                       placeholder="@lang('messages.value_en') ">
                            </div>

                        </div>

                    </div>
                    <div class="text-right" style="padding-bottom: 10px; padding-left: 10px;">
                        <input type="submit" class="btn btn-primary" value=" {{ trans('messages.add_and_forward_to_list') }} "/>
                    </div>
                </div>
            </form>
            <!-- /basic layout -->
        </div>
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
    </div>



@stop



