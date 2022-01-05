@extends('Dashboard.layouts.master')
@section('title', trans('messages.create-var',['var'=>trans('messages.buyer.buyer')]))
@section('style')
    <style> #map { height: 400px;} </style>
@endsection
@section('content')

    <!-- Page header -->
    <div class="page-header page-header-default">
        @section('breadcrumb')
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
        @endsection
    </div>
    <!-- /page header -->

    @include('Dashboard.layouts.parts.validation_errors')

    <div class="row" style="padding: 15px;">
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
                                <label class="col-lg-3 control-label display-block"> {{ trans('messages.buyer.person/company') }} </label>
                                <div class="col-lg-9">
                                    <select name="is_company" id="is_company" class="select form-control">
                                        <option value="" selected disabled>{{trans('messages.select')}}</option>
                                        <option  value="person">{{trans('messages.person')}}</option>
                                        <option  id="option" value="company ">{{trans('messages.company')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div id="location" style="display:none;">
                                {{--                                <div class="form-group">--}}
                                {{--                                    <label>@lang('messages.commercial_register_image')--}}
                                {{--                                        <input type="file" class="col-lg-3 control-label display-block  " name="commercial_register_image">--}}
                                {{--                                        <img src=" {{ asset('uploads/default.png') }} " width="100px" class="thumbnail image-preview">--}}
                                {{--                                    </label>--}}
                                {{--                                </div><br>--}}
                                <div class="form-group">
                                    <label>@lang('messages.commercial_register_image')</label>
                                    <input type="file" class="form-control commercial_register_image" name="commercial_register_image">
                                </div>
                                <div class="form-group">
                                    <label>@lang('messages.buyer.location'):</label>
                                    <div class="col-lg-12">
                                        <input id="searchInput" class=" form-control"   style="background-color: #FFF;margin-left: -150px;" placeholder=" اختر المكان علي الخريطة " name="other">
                                        <div id="map"></div>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" id="geo_lat" name="latitude" readonly="" placeholder=" latitude" class="form-control">
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" id="geo_lng" name="longitude" readonly="" placeholder="longitude" class="form-control">
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">{{ trans('messages.full_name') }}</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" value="" name="full_name" placeholder="@lang('messages.full_name') ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">{{ trans('messages.user_name') }}</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" value="" name="user_name" placeholder="@lang('messages.user_name') ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">{{ trans('messages.email') }}</label>
                                <div class="col-lg-9">
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                           placeholder="{{ trans('messages.email') }}">
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
                                <label class="col-lg-3 control-label">{{ trans('messages.P_O_Box') }}</label>
                                <div class="col-lg-9">
                                    <input type="text" name="P_O_Box" value="{{ old('P_O_Box') }}" class="form-control"
                                           placeholder="{{ trans('messages.P_O_Box') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label"> {{ trans('messages.password') }} </label>
                                <div class="col-lg-9">
                                    <input type="password" class="form-control" name="password"
                                           placeholder=" {{ trans('messages.password') }} "/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label"> {{ trans('messages.confirm_password') }} </label>
                                <div class="col-lg-9">
                                    <input type="password" class="form-control" name="password_confirmation"
                                           placeholder=" {{ trans('messages.confirm_password') }} "/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">{{ trans('messages.gender') }}</label>
                                <div class="col-lg-9">
                                    <select name=" gender" class="select border-warning">
                                        <option value="male">{{trans('messages.male')}}</option>
                                        <option value="female">{{trans('messages.female')}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label display-block">{{ trans('messages.is_appear_name')}}:</label>
                                <label class="radio-inline">
                                    <input type="radio"  value="1" class="styled" name="is_appear_name" checked="checked">{{trans('messages.Yes')}}
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" value="0" class="styled" name="is_appear_name">{{trans('messages.No')}}
                                </label>
                            </div>


                            <div class="form-group">
                                <label class="col-lg-3 control-label display-block"> {{ trans('messages.nationality.nationality') }} </label>
                                <div class="col-lg-9">
                                    <select name="nationality_id" class="select form-control">
                                        @foreach ($nationalities as $nationality)
                                            <option value="{{ $nationality->id }}"> {{ $nationality->$name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label display-block"> {{ trans('messages.city_name') }} </label>
                                <div class="col-lg-9">
                                    <select name="city_id" class="select form-control">
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}"> {{ $city->$name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>@lang('messages.buyer.image'):</label>
                                <input type="file" class="form-control image " name="image">
                                <img src=" {{ asset('uploads/default.png') }} " width="100px" class="thumbnail image-preview">
                            </div>
                        </div>
                    </div>
                    <div class="text-right" style="padding-bottom: 10px; padding-left: 10px;">
                        <input type="submit" class="btn btn-primary" value=" {{ trans('messages.add_and_forward_to_list') }} "/>
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

@section('scripts')

    @include('Dashboard.layouts.parts.map')
@stop
@stop






















{{--@extends('Dashboard.layouts.master')--}}

{{--@section('title', trans('messages.create-var',['var'=>trans('messages.buyer.buyer')]))--}}


{{--@section('content')--}}


{{--    <!-- Page header -->--}}
{{--    <div class="page-header page-header-default">--}}
{{--        <div class="page-header-content">--}}
{{--            <div class="page-title">--}}
{{--                <h4>--}}
{{--                    <i class="icon-arrow-right6 position-left"></i>--}}
{{--                    <span class="text-semibold">@lang('messages.home')</span>--}}
{{--                    - @lang('messages.create-var',['var'=>trans('messages.buyer.buyers')])--}}
{{--                </h4>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="breadcrumb-line">--}}
{{--            <ul class="breadcrumb">--}}
{{--                <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')</a>--}}
{{--                </li>--}}
{{--                <li><a href="{{ route('buyers.index') }}"><i--}}
{{--                            class="icon-admin position-left"></i> @lang('messages.buyer.buyers')</a></li>--}}
{{--                <li class="active">@lang('messages.create-var',['var'=>trans('messages.buyer.buyer')])</li>--}}
{{--            </ul>--}}

{{--            @include('Dashboard.layouts.parts.quick-links')--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- /page header -->--}}




{{--    <div class="row" style="padding: 15px;">--}}
{{--        @include('Dashboard.layouts.parts.validation_errors')--}}

{{--        <div class="col-md-6">--}}

{{--            <!-- Basic layout-->--}}
{{--            <form action="{{ route('buyers.store') }}" class="form-horizontal" method="post"--}}
{{--                  enctype="multipart/form-data">--}}
{{--                @csrf--}}
{{--                <div class="panel panel-flat">--}}
{{--                    <div class="panel-heading">--}}
{{--                        <h5 class="panel-title">{{ trans('messages.add_new_buyer') }}</h5>--}}
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
{{--                                <label class="col-lg-3 control-label">{{ trans('messages.full_name') }}</label>--}}
{{--                                <div class="col-lg-9">--}}
{{--                                    <input type="text" class="form-control" value="" name="full_name"--}}
{{--                                           placeholder="@lang('messages.full_name') ">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="col-lg-3 control-label">{{ trans('messages.user_name') }}</label>--}}
{{--                                <div class="col-lg-9">--}}
{{--                                    <input type="text" class="form-control" value="" name="user_name"--}}
{{--                                           placeholder="@lang('messages.user_name') ">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="col-lg-3 control-label">{{ trans('messages.email') }}</label>--}}
{{--                                <div class="col-lg-9">--}}
{{--                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"--}}
{{--                                           placeholder="{{ trans('messages.email') }}" >--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group">--}}
{{--                                <label class="col-lg-3 control-label">{{ trans('messages.mobile') }}</label>--}}
{{--                                <div class="col-lg-9">--}}
{{--                                    <input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control"--}}
{{--                                           placeholder="{{ trans('messages.mobile') }}">--}}
{{--                                </div>--}}
{{--                            </div>--}}


{{--                            <div class="form-group">--}}
{{--                                <label class="col-lg-3 control-label"> {{ trans('messages.password') }} </label>--}}
{{--                                <div class="col-lg-9">--}}
{{--                                    <input type="password" class="form-control" name="password"--}}
{{--                                           placeholder=" {{ trans('messages.password') }} " />--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group">--}}
{{--                                <label class="col-lg-3 control-label"> {{ trans('messages.confirm_password') }} </label>--}}
{{--                                <div class="col-lg-9">--}}
{{--                                    <input type="password" class="form-control" name="password_confirmation"--}}
{{--                                           placeholder=" {{ trans('messages.confirm_password') }} " />--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group">--}}
{{--                                <label class="col-lg-3 control-label">{{ trans('messages.gender') }}</label>--}}
{{--                                <div class="col-lg-9">--}}
{{--                                    <select name=" gender" class="select-border-color border-warning">--}}
{{--                                        <option value="0">{{trans('messages.female')}}</option>--}}
{{--                                        <option value="1">{{trans('messages.male')}}</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group">--}}
{{--                                <label--}}
{{--                                    class="col-lg-3 control-label display-block"> {{ trans('messages.is_appear_name') }} </label>--}}
{{--                                <div class="col-lg-9">--}}
{{--                                    <select name="is_appear_name"--}}
{{--                                            class="select-border-color border-warning form-control">--}}
{{--                                        <option value="0">{{trans('messages.Yes')}}</option>--}}
{{--                                        <option value="1">{{trans('messages.No')}}</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group">--}}
{{--                                <label--}}
{{--                                    class="col-lg-3 control-label display-block"> {{ trans('messages.city_name') }} </label>--}}
{{--                                <div class="col-lg-9">--}}
{{--                                    <select name="city_id" class="select-border-color border-warning form-control">--}}
{{--                                        @foreach ($cities as $city)--}}
{{--                                            <option value="{{ $city->id }}"> {{ $city->$name }} </option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}

{{--                    <div class="text-right" style="padding-bottom: 10px; padding-left: 10px;">--}}
{{--                        <input type="submit" class="btn btn-primary"--}}
{{--                               value=" {{ trans('messages.add_and_forward_to_list') }} "/>--}}
{{--                        --}}{{--                        <input type="submit" class="btn btn-success" name="back" value=" {{ trans('messages.add_and_come_back') }} " />--}}
{{--                    </div>--}}

{{--                </div>--}}


{{--            </form>--}}
{{--            <!-- /basic layout -->--}}

{{--        </div>--}}


{{--        <div class="col-md-6">--}}
{{--            <div class="panel panel-flat">--}}

{{--                <div class="panel-heading">--}}
{{--                    <h5 class="panel-title"> {{ trans('messages.buyer.latest_buyers') }} </h5>--}}
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
{{--                            <th> {{ trans('messages.full_name') }} </th>--}}
{{--                            <th> {{ trans('messages.user_name') }} </th>--}}
{{--                        </tr>--}}
{{--                        @forelse($latest_buyers as $buyer)--}}
{{--                            <tr>--}}
{{--                                <td> {{ $buyer->full_name }} </td>--}}
{{--                                <td>{{ $buyer->user_name }}</td>--}}
{{--                            </tr>--}}
{{--                        @empty--}}
{{--                        @endforelse--}}
{{--                    </table>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}



{{--@stop--}}



