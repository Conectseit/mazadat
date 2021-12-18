@extends('Dashboard.layouts.master')

@section('title', trans('messages.create-var',['var'=>trans('messages.buyer.buyer')]))


@section('content')


    <!-- Page header -->
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4>
                    <i class="icon-arrow-right6 position-left"></i>
                    <span class="text-semibold">@lang('messages.home')</span>
                    - @lang('messages.create-var',['var'=>trans('messages.buyer.buyers')])
                </h4>
            </div>
        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')</a>
                </li>
                <li><a href="{{ route('buyers.index') }}"><i
                            class="icon-admin position-left"></i> @lang('messages.buyer.buyers')</a></li>
                <li class="active">@lang('messages.create-var',['var'=>trans('messages.buyer.buyer')])</li>
            </ul>

            @include('Dashboard.layouts.parts.quick-links')
        </div>
    </div>
    <!-- /page header -->




    <div class="row" style="padding: 15px;">
        @include('Dashboard.layouts.parts.validation_errors')

        <div class="col-md-6">

            <!-- Basic layout-->
            <form action="{{ route('buyers.store') }}" class="form-horizontal" method="post"
                  enctype="multipart/form-data">
                @csrf
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">{{ trans('messages.add_new_buyer') }}</h5>
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
                                <label class="col-lg-3 control-label">{{ trans('messages.full_name') }}</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" value="" name="full_name"
                                           placeholder="@lang('messages.full_name') ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">{{ trans('messages.user_name') }}</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" value="" name="user_name"
                                           placeholder="@lang('messages.user_name') ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">{{ trans('messages.email') }}</label>
                                <div class="col-lg-9">
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                           placeholder="{{ trans('messages.email') }}" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">{{ trans('messages.mobile') }}</label>
                                <div class="col-lg-9">
                                    <input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control"
                                           placeholder="{{ trans('messages.mobile') }}">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-lg-3 control-label"> {{ trans('messages.password') }} </label>
                                <div class="col-lg-9">
                                    <input type="password" class="form-control" name="password"
                                           placeholder=" {{ trans('messages.password') }} " />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label"> {{ trans('messages.confirm_password') }} </label>
                                <div class="col-lg-9">
                                    <input type="password" class="form-control" name="password_confirmation"
                                           placeholder=" {{ trans('messages.confirm_password') }} " />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">{{ trans('messages.gender') }}</label>
                                <div class="col-lg-9">
                                    <select name=" gender" class="select-border-color border-warning">
                                        <option value="0">{{trans('messages.female')}}</option>
                                        <option value="1">{{trans('messages.male')}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label
                                    class="col-lg-3 control-label display-block"> {{ trans('messages.is_appear_name') }} </label>
                                <div class="col-lg-9">
                                    <select name="is_appear_name"
                                            class="select-border-color border-warning form-control">
                                        <option value="0">{{trans('messages.Yes')}}</option>
                                        <option value="1">{{trans('messages.No')}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label
                                    class="col-lg-3 control-label display-block"> {{ trans('messages.city_name') }} </label>
                                <div class="col-lg-9">
                                    <select name="city_id" class="select-border-color border-warning form-control">
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}"> {{ $city->$name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="text-right" style="padding-bottom: 10px; padding-left: 10px;">
                        <input type="submit" class="btn btn-primary"
                               value=" {{ trans('messages.add_and_forward_to_list') }} "/>
                        {{--                        <input type="submit" class="btn btn-success" name="back" value=" {{ trans('messages.add_and_come_back') }} " />--}}
                    </div>

                </div>


            </form>
            <!-- /basic layout -->

        </div>


        <div class="col-md-6">
            <div class="panel panel-flat">

                <div class="panel-heading">
                    <h5 class="panel-title"> {{ trans('messages.buyer.latest_buyers') }} </h5>
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
                            <th> {{ trans('messages.full_name') }} </th>
                            <th> {{ trans('messages.user_name') }} </th>
                        </tr>
                        @forelse($latest_buyers as $buyer)
                            <tr>
                                <td> {{ $buyer->full_name }} </td>
                                <td>{{ $buyer->user_name }}</td>
                            </tr>
                        @empty
                        @endforelse
                    </table>
                </div>

            </div>
        </div>
    </div>



@stop



