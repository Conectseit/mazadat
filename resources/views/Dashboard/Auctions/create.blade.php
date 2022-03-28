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
                    <h3 class="panel-title">{{ trans('messages.auction.add') }}</h3>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                <form action="{{ route('auctions.store') }}"  method="post" id="submitted-form"
                      class =" stepy-basic wizard-form steps-validation" enctype="multipart/form-data">
                    @csrf

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
                                <input type="text" class="form-control"  value="{{ old('name_ar')}}" name="name_ar"
                                       placeholder="@lang('messages.name_ar') ">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control"  value="{{ old('name_en')}}" name="name_en"
                                       placeholder="@lang('messages.name_en') ">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control"  value="{{ old('description_ar')}}" name="description_ar"
                                       placeholder="@lang('messages.description_ar') ">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control"  value="{{ old('description_en')}}" name="description_en"
                                       placeholder="@lang('messages.description_en') ">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label class="control-label"> {{ trans('messages.auction.auction_terms_ar') }}: </label>
                                <textarea rows="2" cols="2" name="auction_terms_ar" class="form-control  @error('auction_terms_ar') is-invalid @enderror" >
                                    {{ old('auction_terms_ar') }}</textarea>
                                @error('auction_terms_ar')<span style="color: #e81414;">{{ $message }}</span>@enderror

                            </div>
                            <div class="form-group">
                                <label class="control-label"> {{ trans('messages.auction.auction_terms_en') }}: </label>
                                <textarea rows="2" cols="2" name="auction_terms_en" class="form-control @error('auction_terms_ar') is-invalid @enderror" >
                                    {{ old('auction_terms_en') }}</textarea>
                                @error('auction_terms_en')<span style="color: #e81414;">{{ $message }}</span>@enderror

                            </div>
                        </div>
                    <div class="row">
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

                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="" class="form-label">{{ trans('messages.option.options') }}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <div class="select-inputs-options"></div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label class="display-block">{{ trans('messages.auction.start_date') }}:</label>
                            <input type="datetime-local" class="form-control"  value="" name="start_date"
                                   placeholder="@lang('messages.auction.start_date') ">
                        </div>
                        <div class="form-group">
                            <label class="display-block">{{ trans('messages.auction.end_date') }}:</label>
                            <input type="datetime-local" class="form-control"  value="" name="end_date"
                                   placeholder="@lang('messages.auction.end_date') ">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control"  value="{{ old('start_auction_price')}}" name="start_auction_price"
                                   placeholder="@lang('messages.auction.start_auction_price') ">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control"  value="{{ old('value_of_increment')}}" name="value_of_increment"
                                   placeholder="@lang('messages.auction.value_of_increment') ">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control"  value="{{ old('delivery_charge')}}" name="delivery_charge"
                                   placeholder="@lang('messages.auction.delivery_charge') ">
                        </div>

                        <div class="form-group">
                            <label class="display-block">{{ trans('messages.auction.who_can_see') }}:</label>
                            <label class="radio-inline">
                                <input type="radio" value="all" class="styled" name="who_can_see" checked="checked">
                                {{trans('messages.all')}}
                            </label>

                            <label class="radio-inline">
                                <input type="radio" value="person" class="styled" name="who_can_see">
                                {{trans('messages.auction.users')}}
                            </label>
                            <label class="radio-inline">
                                <input type="radio" value="company" class="styled" name="who_can_see">
                                {{trans('messages.auction.company')}}
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label>@lang('messages.auction.images')</label>
                            {{--                                <input type="file" class="form-control " name="images[]" multiple="multiple"/>--}}
                            <input type="file" multiple id="gallery-photo-add"  class="form-control" name="images[]">
                            <div class="gallery"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="form-group">
                                <label>@lang('messages.auction.inspection_report_images')</label>
                                {{--                                    <input type="file" class="form-control " name="inspection_report_images[]" multiple="multiple"/>--}}
                                <input type="file" multiple id="inspection-photo-add"  class="form-control" name="inspection_report_images[]">
                                <div class="gallery1"></div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
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
                        </div><br>
                    </div>

                    <button type="submit" class="btn btn-primary stepy-finish mt-5" id="save-form-btn">{{ trans('messages.add_and_forward_to_list') }}
                        <i class="icon-check position-right"></i></button>
                </form>
                </div>
            <!-- /basic setup -->

        </div>
        </div>
{{--        <div class="col-md-3" dir="{{ direction() }}" >--}}
{{--            <div class="panel panel-flat">--}}

{{--                <div class="panel-heading">--}}
{{--                    <h5 class="panel-title"> {{ trans('messages.auction.latest_auctions') }} </h5>--}}
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
{{--                            <th> {{ trans('messages.image') }} </th>--}}
{{--                        </tr>--}}
{{--                        @forelse($latest_auctions as $auction)--}}
{{--                            <tr>--}}
{{--                                <td> {{ substr($auction->$name,0,15) }} </td>--}}
{{--                                <td><img src="{{ $auction->first_image_path }}" style="height:50px;"/></td>--}}
{{--                            </tr>--}}
{{--                        @empty--}}
{{--                        @endforelse--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>

@stop
@section('scripts')

@include('Dashboard.layouts.parts.ajax_get_options')
@include('Dashboard.layouts.parts.map')
@include('Dashboard.Auctions.parts.ajax_get_options_by_category_id')
@include('Dashboard.Auctions.parts.image_preview')

@endsection
