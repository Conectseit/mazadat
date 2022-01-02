@extends('Dashboard.layouts.master')
@section('title', trans('messages.edit-var',['var'=>trans('messages.auction.auctions')]))


@section('content')

    <!-- Page header -->
    <div class="page-header page-header-default">
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
    </div>
    <!-- /page header -->

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
                                <select name="category_id" class="select-border-color border-warning form-control">
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
                                <select name="seller_id" class="select-border-color border-warning form-control">
                                    <optgroup label="{{ trans('messages.auction.seller_full_name') }}">

                                        @foreach ($sellers as $seller)
                                            <option
                                                {{ $auction->seller_id == $seller->id ? 'selected' : '' }} value="{{ $seller->id }}"> {{ $seller->full_name}} </option>
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
                            <label class="col-lg-3 control-label"> {{ trans('messages.auction.value_of_increment') }} </label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" value="{{$auction->value_of_increment}}" name="value_of_increment"
                                       placeholder="@lang('messages.value_of_increment')">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="display-block">{{ trans('messages.auction.start_date') }}:</label>
                            <input type="datetime-local" class="form-control" value="{{$auction->start_date}}" name="start_date"
                                   placeholder="@lang('messages.auction.start_date') ">
                        </div>
                        <div class="form-group">
                            <label class="display-block">{{ trans('messages.auction.end_date') }}:</label>
                            <input type="datetime-local" class="form-control" value="{{$auction->end_date}}" name="end_date"
                                   placeholder="@lang('messages.auction.end_date') ">
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label"> {{ trans('messages.auction.start_auction_price') }} </label>
                            <div class="col-lg-9">
                                <input class="form-control" name="start_auction_price" value="{{ $auction->start_auction_price }}" placeholder="{{ trans('messages.start_auction_price') }}">
                            </div>
                        </div>



{{--                        <div class="form-group">--}}
{{--                            <label class="col-lg-3 control-label"> {{ trans('messages.auction.start_date') }}:</label>--}}
{{--                            <div class="col-lg-9">--}}
{{--                                <input type="datetime-local" class="form-control" value="" name="start_date"--}}
{{--                                       placeholder="@lang('messages.auction.start_date') ">{{ $auction->start_date }}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label class="col-lg-3 control-label"> {{ trans('messages.auction.end_date') }}:</label>--}}
{{--                            <div class="col-lg-9">--}}
{{--                                <input type="datetime-local" class="form-control" value="" name="end_date"--}}
{{--                                       placeholder="@lang('messages.auction.end_date') ">{{ $auction->end_date }}--}}
{{--                            </div>--}}
{{--                        </div>--}}



                        <div class="form-group">
                            <label>@lang('messages.auction.images')</label>
                            <input type="file" class="form-control " name="images[]" multiple="multiple"/>
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
