@extends('Dashboard.layouts.master')
@section('title', trans('messages.edit-var',['var'=>trans('messages.auction.auctions')]))

@section('breadcrumb')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')</a>
            </li>
            <li><a href="{{ route('auctions.index') }}"><i
                        class="icon-admin position-left"></i> @lang('messages.auction.auctions')</a></li>
            <li class="active">@lang('messages.edit-var',['var'=>trans('messages.auction.auctions')])</li>
        </ul>
        @include('Dashboard.layouts.parts.quick-links')
    </div>
@endsection

@section('content')

    <div class="row" style="padding: 15px;">
        @include('Dashboard.layouts.parts.validation_errors')

        <div class="col-md-9">
            <!-- Basic layout-->
            <form action="{{ route('auctions.update',$auction) }}" class="form-horizontal" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
{{--                <input type="hidden" name="auction_id" value="{{$auction->id}}"/>--}}
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">{{ trans('messages.auction.edit') }} </h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                                <li><a data-action="close"></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="form-group">
                            <label
                                class="col-lg-3 control-label display-block"> {{ trans('messages.auction.category_name') }} </label>
                            <div class="col-lg-9">
                                <select name="category_id" class="select form-control">
                                    <optgroup label="{{ trans('messages.auction.category_name') }}">
                                        @foreach ($categories as $category)
                                            <option
                                                {{ $auction->category_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}"> {{ $category->name_ar }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label
                                class="col-lg-3 control-label display-block"> {{ trans('messages.auction.seller_full_name') }} </label>
                            <div class="col-lg-9">
                                <select name="seller_id" class="select form-control">
                                    <optgroup label="{{ trans('messages.auction.seller_full_name') }}">

                                        @foreach ($users as $seller )
                                            <option
                                                {{ $auction->seller_id == $seller->id ? 'selected' : '' }} value="{{ $seller->id }}"> {{ $seller->user_name}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label"> {{ trans('messages.name_ar') }} </label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" value="{{$auction->name_ar}}" name="name_ar" placeholder="@lang('messages.name_ar')">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label"> {{ trans('messages.name_en') }} </label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" value="{{$auction->name_en}}" name="name_en" placeholder="@lang('messages.name_en') ">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label"> {{ trans('messages.description_ar') }} </label>
                            <div class="col-lg-9">
                                <textarea
                                    class="form-control" name="description_ar"
                                          placeholder="{{ trans('messages.description_ar') }}">{{ $auction->description_ar }}
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label"> {{ trans('messages.description_en') }} </label>
                            <div class="col-lg-9">
                                <textarea class="form-control" name="description_en"
                                          placeholder="{{ trans('messages.description_en') }}">{{ $auction->description_en }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label"> {{ trans('messages.auction.start_auction_price') }} </label>
                            <div class="col-lg-9">
                                <input class="form-control" name="start_auction_price" value="{{ $auction->start_auction_price }}" placeholder="{{ trans('messages.start_auction_price') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label"> {{ trans('messages.auction.value_of_increment') }} </label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" value="{{$auction->value_of_increment}}" name="value_of_increment"
                                       placeholder="@lang('messages.auction.value_of_increment')">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label"> {{ trans('messages.auction.delivery_charge') }} </label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" value="{{$auction->delivery_charge}}" name="delivery_charge"
                                       placeholder="@lang('messages.auction.delivery_charge')">
                            </div>
                        </div>
                        @if(isset($auction->start_date))
                        <div class="form-group">
                            <label class="display-block">{{ trans('messages.auction.start_date') }}:</label>
                            <input type="datetime-local" class="form-control" value="{{$auction->start_date->format('Y-m-d\TH:i')}}"
                                   name="start_date" placeholder="@lang('messages.auction.start_date') ">
                        </div>
                        @else
                            <div class="form-group">
                                <label class="display-block">{{ trans('messages.auction.start_date') }}:</label>
                                <input type="datetime-local" class="form-control" value=""
                                       name="start_date" placeholder="@lang('messages.auction.start_date') ">
                            </div>
                        @endif


                        @if(isset($auction->end_date))
                        <div class="form-group">
                            <label class="display-block">{{ trans('messages.auction.end_date') }}:</label>
                            <input type="datetime-local" class="form-control" value="{{$auction->end_date->format('Y-m-d\TH:i')}}"
                                   name="end_date" placeholder="@lang('messages.auction.end_date') ">
                        </div>
                        @else
                            <div class="form-group">
                                <label class="display-block">{{ trans('messages.auction.end_date') }}:</label>
                                <input type="datetime-local" class="form-control" value=""
                                       name="end_date" placeholder="@lang('messages.auction.end_date') ">
                            </div>
                        @endif

                        <div class="form-group">
                            <label class="col-lg-3 control-label"> {{ trans('messages.auction.auction_terms_ar') }} </label>
                            <div class="col-lg-9">
                                <textarea class="form-control" name="auction_terms_ar"
                                          placeholder="{{ trans('messages.auction.auction_terms_ar') }}">{{ $auction->auction_terms_ar }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label"> {{ trans('messages.auction.auction_terms_en') }} </label>
                            <div class="col-lg-9">
                                <textarea class="form-control" name="auction_terms_en"
                                          placeholder="{{ trans('messages.auction.auction_terms_en') }}">{{ $auction->auction_terms_en }}</textarea>
                            </div>
                        </div>



{{--                        <div class="form-group">--}}
{{--                            <label class="display-block">{{ trans('messages.auction.who_can_see') }}:</label>--}}
{{--                            <label class="radio-inline">--}}
{{--                                <input type="radio" value="all" class="styled" name="who_can_see" checked="checked">--}}
{{--                                {{trans('messages.all')}}--}}
{{--                            </label>--}}

{{--                            <label class="radio-inline">--}}
{{--                                <input type="radio" value="users" class="styled" name="who_can_see">--}}
{{--                                {{trans('messages.auction.users')}}--}}
{{--                            </label>--}}
{{--                            <label class="radio-inline">--}}
{{--                                <input type="radio" value="company" class="styled" name="who_can_see">--}}
{{--                                {{trans('messages.auction.company')}}--}}
{{--                            </label>--}}
{{--                        </div>--}}

{{--                        <div class="form-group">--}}
{{--                            <label class="display-block">{{ trans('messages.auction.who_can_buy') }}:</label>--}}
{{--                            <label class="radio-inline">--}}
{{--                                <input type="radio" value="all" class="styled" name="who_can_buy" checked="checked">--}}
{{--                                {{trans('messages.all')}}--}}
{{--                            </label>--}}

{{--                            <label class="radio-inline">--}}
{{--                                <input type="radio" value="users" class="styled" name="who_can_buy">--}}
{{--                                {{trans('messages.auction.users')}}--}}
{{--                            </label>--}}
{{--                            <label class="radio-inline">--}}
{{--                                <input type="radio" value="company" class="styled" name="who_can_buy">--}}
{{--                                {{trans('messages.auction.company')}}--}}
{{--                            </label>--}}
{{--                        </div>--}}

{{--                        <div class="form-group">--}}
{{--                            <label>@lang('messages.auction.inspection_report_image')</label>--}}
{{--                            <input type="file" class="form-control image " name="inspection_report_image">--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <img src=" {{$auction->inspection_report_image_path}} " width=" 100px " value="{{$auction->inspection_report_image_path}}"--}}
{{--                                 class="thumbnail image-preview">--}}
{{--                        </div>--}}


                        <hr>
                        <div class="form-group">
                            <label>@lang('messages.auction.inspection_report_images')</label>
{{--                            <input type="file" class="form-control " name="inspection_report_images[]" multiple="multiple"/>--}}
                            <input type="file" multiple id="gallery-photo-add"  class="form-control" name="images[]">
                            <div class="gallery"></div>
                        </div>
                        <div class="form-group">
                            <label>@lang('messages.auction.images')</label>
{{--                            <input type="file" class="form-control " name="images[]" multiple="multiple"/>--}}
                            <input type="file" multiple id="inspection-photo-add"  class="form-control" name="inspection_report_images[]">
                            <div class="gallery1"></div>

                        </div>










                        <div class="text-right">
                            <input type="submit" class="btn btn-primary" name="forward"
                            value=" {{ trans('messages.update_and_come_back') }} "/>
{{--                            <input type="submit" class="btn btn-success"--}}
{{--                                   value=" {{ trans('messages.update_and_come_back') }} "/>--}}
                        </div>
                    </div>
                </div>
            </form>
            <!-- /basic layout -->



        </div>
    </div>

@stop

@section('scripts')
{{--    @include('Dashboard.layouts.parts.ajax_get_options')--}}
{{--    @include('Dashboard.layouts.parts.map')--}}
{{--    @include('Dashboard.Auctions.ajax_get_options_by_category_id')--}}
    @include('Dashboard.Auctions.image_preview')

@endsection
