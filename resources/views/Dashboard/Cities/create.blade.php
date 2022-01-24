@extends('Dashboard.layouts.master')

@section('title', trans('messages.create-var',['var'=>trans('messages.city.city')]))

<!-- Page header -->
<div class="page-header page-header-default">
    @section('breadcrumb')
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')</a>
                </li>
                <li><a href="{{ route('cities.index') }}"><i
                            class="icon-admin position-left"></i> @lang('messages.city.cities')</a></li>
                <li class="active">@lang('messages.create-var',['var'=>trans('messages.city.city')])</li>
            </ul>

            @include('Dashboard.layouts.parts.quick-links')
        </div>
    @endsection
</div>
<!-- /page header -->
@section('content')

    @include('Dashboard.layouts.parts.validation_errors')


    <div class="row" style="padding: 15px;">
        <div class="col-md-6">

            <!-- Basic layout-->
            <form action="{{ route('cities.store') }}" class="form-horizontal" method="post"
                  enctype="multipart/form-data">
                @csrf
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">{{ trans('messages.city.add') }}</h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                                <li><a data-action="close"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label display-block"> {{ trans('messages.country.name') }}: </label>
                        <div class="col-lg-6">
                            <select name="country_id" class="select">
{{--                                <optgroup label="{{ trans('messages.country.name')}}">--}}
                                    <option selected disabled>{{trans('messages.select')}}</option>

                                @foreach($countries as $country)
                                        <option value="{{ $country->id }}"> {{ $country->$name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div><br>

                    <div class="panel-body">
                        <div class="box-body">
                            <div class="form-group">
                                <input type="text" class="form-control" value="" name="name_ar"
                                       placeholder="@lang('messages.name_ar') ">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" value="" name="name_en"
                                       placeholder="@lang('messages.name_en') ">
                            </div>
                        </div>

                    </div>


                    <div class="text-right" style="padding-bottom: 10px; padding-left: 10px;">
                        <input type="submit" class="btn btn-primary"
                               value=" {{ trans('messages.add_and_forward_to_list') }} "/>
{{--                        <input type="submit" class="btn btn-success" name="messages"--}}
{{--                               value=" {{ trans('messages.add_and_come_messages') }} "/>--}}
                    </div>

                </div>


            </form>
            <!-- /basic layout -->

        </div>


        <div class="col-md-6">
            <div class="panel panel-flat">

                <div class="panel-heading">
                    <h5 class="panel-title"> {{ trans('messages.city.latest_cities') }} </h5>
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
                            <th> {{ trans('messages.name_ar') }} </th>
                            <th> {{ trans('messages.name_en') }} </th>
                        </tr>
                        @forelse($latest_cities as $city)
                            <tr>
                                <td> {{ $city->name_ar }} </td>
                                <td> {{ $city->name_en }} </td>
                            </tr>
                        @empty
                        @endforelse
                    </table>
                </div>

            </div>
        </div>
    </div>
@stop



