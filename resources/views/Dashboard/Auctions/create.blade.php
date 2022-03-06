@extends('Dashboard.layouts.master')
@section('title', trans('messages.create-var',['var'=>trans('messages.auction.auction')]))
@section('style')
    <style> #map { height: 400px;} </style>
@endsection
@section('breadcrumb')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i
                        class="icon-home2 position-left"></i> @lang('messages.home')</a>
            </li>
            <li><a href="{{ route('auctions.index') }}"><i
                        class="icon-admin position-left"></i> @lang('messages.auction.auctions')</a></li>
            <li class="active">@lang('messages.create-var',['var'=>trans('messages.auction.auction')])</li>
        </ul>
        @include('Dashboard.layouts.parts.quick-links')
    </div>
@endsection
@section('content')

    <div class="row" style="padding: 15px;"  dir="{{ direction() }}">
        <div class="col-md-9">
            <!-- Basic setup -->
            <div class="panel panel-white">
                <div class="panel-heading">
                    @include('Dashboard.layouts.parts.validation_errors')
                    <h6 class="panel-title">{{ trans('messages.auction.add') }}</h6>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                <form action="{{ route('auctions.store') }}"  method="post" class =" stepy-basic wizard-form steps-validation"
                enctype="multipart/form-data">
                    @csrf
                    <fieldset title="1">
                        <legend class="text-semibold">{{ trans('messages.auction.basic_data') }}</legend><br><br>
                        <div class="row">
                            <div class="form-group">
                                <label
                                    class="col-lg-3 control-label display-block"> {{ trans('messages.auction.seller_full_name') }} </label>
                                <div class="col-md-6">
                                    <select name="seller_id" class="select">
                                        <option selected disabled>{{trans('messages.select')}}</option>

{{--                                        <optgroup label="{{ trans('messages.auction.seller_full_name') }}">--}}
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"> {{ $user->user_name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" value="" name="name_ar"
                                       placeholder="@lang('messages.name_ar') ">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" value="" name="name_en"
                                       placeholder="@lang('messages.name_en') ">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" value="" name="description_ar"
                                       placeholder="@lang('messages.description_ar') ">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" value="" name="description_en"
                                       placeholder="@lang('messages.description_en') ">
                            </div>
                        </div>
                    </fieldset>

                    <fieldset title="2">
                        <legend class="text-semibold">{{ trans('messages.auction.auction_terms') }}</legend><br><br>
                        <div class="row">
                            <div class="form-group">
                                <label class="control-label"> {{ trans('messages.auction.auction_terms_ar') }}: </label>
                                <textarea rows="2" cols="2" name="auction_terms_ar" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label"> {{ trans('messages.auction.auction_terms_en') }}: </label>
                                <textarea rows="2" cols="2" name="auction_terms_en" class="form-control"></textarea>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset title="3">
                        <legend class="text-semibold">{{ trans('messages.auction.options') }}</legend>
                        <div class="row">
{{--                            <div class="form-group">--}}
{{--                                <label class="col-lg-3 control-label display-block"> {{ trans('messages.auction.choose_category') }} </label>--}}
{{--                                <div class="col-lg-6">--}}
{{--                                    <select id="category" name="category_id" class="select>--}}
{{--                                        <optgroup label="{{ trans('messages.auction.choose_category') }}">--}}
{{--                                            @foreach ($categories as $category)--}}
{{--                                                <option value="{{ $category->id }}"> {{ $category->$name }} </option>--}}
{{--                                            @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div><br>--}}

                            <div class="form-group">
                                <label class="col-lg-3 control-label display-block"> {{ trans('messages.auction.choose_category') }} </label>
                                <div class="col-lg-6">
                                    <select name="category_id" id="category" class="select">
{{--                                        <optgroup  label="{{ trans('messages.auction.choose_category') }}}">--}}
                                            <option selected disabled>{{trans('messages.select')}}</option>

                                        @foreach($categories as $category)
                                                <option value="{{ $category->id }}"> {{ $category->$name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><br>

                            <div class="form-group">
                                <label class="col-lg-3 control-label display-block"> {{ trans('messages.auction.choose_options') }} </label>
                                <div class="col-lg-6">
                                    <select name="option_id" id="options" class="select">
                                        <optgroup label="{{ trans('messages.option.options') }}">
                                        @foreach($options as $option)
                                                <option value="{{ $option->id }}"> {{ $option->$name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><br>
                            <div class="form-group">
                                <label class="col-lg-3 control-label display-block"> {{ trans('messages.auction.choose_option_details') }} </label>
                                <div class="col-lg-6">
                                    <select name="option_details_id" id="option_details" class="select">
                                        <optgroup label="{{ trans('messages.auction.choose_option_details') }}">
                                            @foreach($option_details as $option_detail)
                                                <option value="{{ $option_detail->id }}"> {{ $option_detail->$value }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>








{{--          // ////////////////////////////////////////////////                 --}}

                            <br><br>
{{--                            <div class="form-group">--}}
{{--                                <label--}}
{{--                                    class="col-lg-3 control-label display-block"> {{ trans('messages.option.option_details') }} </label>--}}
{{--                                <div class="col-lg-9">--}}
{{--                                    <select name="option_details_id"--}}
{{--                                            class="select-border-color border-warning form-control">--}}
{{--                                        <optgroup label="{{ trans('messages.option.options') }}">--}}
{{--                                            @forelse($options as $option)--}}
{{--                                                <optgroup label="{{ $option->$name }}">--}}
{{--                                                    @foreach ($option->option_details as $option_details)--}}
{{--                                                        <option--}}
{{--                                                            value="{{ $option_details->id }}"> {{ $option_details->$value }} </option>--}}
{{--                                                    @endforeach--}}
{{--                                                </optgroup>--}}
{{--                                        @empty--}}
{{--                                        @endforelse--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div><br><br>--}}
                        </div>
                    </fieldset>

                    <fieldset title="4">
                        <legend class="text-semibold">{{ trans('messages.auction.time') }}</legend><br><br>
                        <div class="row">
                            <div class="form-group">
                                <label class="display-block">{{ trans('messages.auction.start_date') }}:</label>
                                <input type="datetime-local" class="form-control" value="" name="start_date"
                                       placeholder="@lang('messages.auction.start_date') ">
                            </div>
                            <div class="form-group">
                                <label class="display-block">{{ trans('messages.auction.end_date') }}:</label>
                                <input type="datetime-local" class="form-control" value="" name="end_date"
                                       placeholder="@lang('messages.auction.end_date') ">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" value="" name="start_auction_price"
                                       placeholder="@lang('messages.auction.start_auction_price') ">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" value="" name="value_of_increment"
                                       placeholder="@lang('messages.auction.value_of_increment') ">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" value="" name="delivery_charge"
                                       placeholder="@lang('messages.auction.delivery_charge') ">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset title="5">
                        <legend class="text-semibold">{{ trans('messages.auction.other_data') }}</legend><br><br>
                        <div class="row">
{{--                            <div class="form-group">--}}
{{--                                <label>@lang('messages.auction.inspection_report_image')</label>--}}
{{--                                <input type="file" class="form-control image " name="inspection_report_image">--}}
{{--                            </div>--}}

{{--                            <div class="form-group">--}}
{{--                                <img src=" {{ asset('uploads/default.png') }} " width=" 100px "--}}
{{--                                     class="thumbnail image-preview">--}}
{{--                            </div>--}}

                            <div class="form-group">
                                <label class="display-block">{{ trans('messages.auction.who_can_see') }}:</label>
                                <label class="radio-inline">
                                    <input type="radio" value="all" class="styled" name="who_can_see" checked="checked">
                                    {{trans('messages.all')}}
                                </label>

                                <label class="radio-inline">
                                    <input type="radio" value="users" class="styled" name="who_can_see">
                                    {{trans('messages.auction.users')}}
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" value="company" class="styled" name="who_can_see">
                                    {{trans('messages.auction.company')}}
                                </label>
                            </div>

                            <div class="form-group">
                                <label class="display-block">{{ trans('messages.auction.who_can_buy') }}:</label>
                                <label class="radio-inline">
                                    <input type="radio" value="all" class="styled" name="who_can_buy" checked="checked">
                                    {{trans('messages.all')}}
                                </label>

                                <label class="radio-inline">
                                    <input type="radio" value="users" class="styled" name="who_can_buy">
                                    {{trans('messages.auction.users')}}
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" value="company" class="styled" name="who_can_buy">
                                    {{trans('messages.auction.company')}}
                                </label>
                            </div>

                            <div class="form-group">
                                <label>@lang('messages.auction.images')</label>
                                <input type="file" class="form-control " name="images[]" multiple="multiple"/>
                            </div>

                            <hr>
                            <div class="form-group">
                                <label>@lang('messages.auction.inspection_report_images')</label>
                                <input type="file" class="form-control " name="inspection_report_images[]" multiple="multiple"/>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label>@lang('messages.auction.location'):</label>
                                <div class="col-lg-12">
{{--                                    <input id="searchInput" class=" form-control"   style="background-color: #FFF;margin-left: -150px;" placeholder=" اختر المكان علي الخريطة " name="other">--}}
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
                    </fieldset>
                    <button type="submit" class="btn btn-primary stepy-finish">{{ trans('messages.add_and_forward_to_list') }}
                        <i class="icon-check position-right"></i></button>
                </form>
                </div>
            <!-- /basic setup -->

        </div>
        </div>
        <div class="col-md-3" dir="{{ direction() }}" >
            <div class="panel panel-flat">

                <div class="panel-heading">
                    <h5 class="panel-title"> {{ trans('messages.auction.latest_auctions') }} </h5>
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
                        @forelse($latest_auctions as $auction)
                            <tr>
                                <td> {{ $auction->$name }} </td>
                                <td><img src="{{ $auction->first_image_path }}" style="height:50px;"/></td>
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
    @include('Dashboard.layouts.parts.ajax_get_options')
    @include('Dashboard.layouts.parts.map')

@endsection
