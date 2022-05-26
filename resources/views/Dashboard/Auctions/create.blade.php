@extends('Dashboard.layouts.master')
@section('title', trans('messages.create-var',['var'=>trans('messages.auction.auction')]))
@section('style')
    <style> #map {height: 400px;} </style>
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

    <div class="row" style="padding: 15px;" dir="{{ direction() }}">
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
                    <form action="{{ route('auctions.store') }}" method="post" id="submitted-form"
                          class=" stepy-basic wizard-form steps-validation" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="form-group">
                                <label class="col-lg-3 control-label display-block"> {{ trans('messages.auction.seller_full_name') }} </label>
                                <div class="col-md-6">
                                    <select name="seller_id" class="select">
                                        <option selected disabled>{{trans('messages.select')}}</option>

                                        <optgroup label="{{ trans('messages.auction.seller_full_name') }}">
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"> {{ $user->user_name }} </option>
                                        @endforeach
                                    </select>
                                    @error('seller_id')<span style="color: #e81414;">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ old('name_ar')}}" name="name_ar"
                                       placeholder="@lang('messages.name_ar') ">
                                @error('name_ar')<span style="color: #e81414;">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ old('name_en')}}" name="name_en"
                                       placeholder="@lang('messages.name_en') ">
                                @error('name_en')<span style="color: #e81414;">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ old('description_ar')}}"
                                       name="description_ar"
                                       placeholder="@lang('messages.description_ar') ">
                                @error('description_ar')<span style="color: #e81414;">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ old('description_en')}}"
                                       name="description_en"
                                       placeholder="@lang('messages.description_en') ">
                                @error('description_en')<span style="color: #e81414;">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="control-label"> {{ trans('messages.auction.auction_terms_ar') }}: </label>
                                <textarea rows="2" cols="2" name="auction_terms_ar"
                                          class="form-control  @error('auction_terms_ar') is-invalid @enderror">
                                    {{ old('auction_terms_ar') }}</textarea>
                                @error('auction_terms_ar')<span style="color: #e81414;">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label"> {{ trans('messages.auction.auction_terms_en') }}: </label>
                                <textarea rows="2" cols="2" name="auction_terms_en"
                                          class="form-control @error('auction_terms_ar') is-invalid @enderror">
                                    {{ old('auction_terms_en') }}</textarea>
                                @error('auction_terms_en')<span style="color: #e81414;">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-lg-3 control-label display-block"> {{ trans('messages.auction.choose_category') }} </label>
                                <div class="col-lg-6">
                                    <select name="category_id" id="category" class="select">
                                        <optgroup label="{{ trans('messages.auction.choose_category') }}}">
                                            <option selected disabled>{{trans('messages.select')}}</option>

                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}"> {{ $category->$name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category_id')<span style="color: #e81414;">{{ $message }}</span>@enderror
                            </div><br>
                            <div class="form-group mb-4 row">
                                <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                    <label for="" class="form-label">{{ trans('messages.option.required_options') }}</label>
                                </div>
                                <div class="col-lg-10 col-md-9">
                                    <div class="select-inputs-options"></div>
                                </div>
                            </div>


                            <div class="form-group mb-4 row">
                                <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                    <label for="" class="form-label">{{ trans('messages.option.not_required_options') }}</label>
                                </div>
                                <div class="col-lg-10 col-md-9">
                                    <div class="not-options"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label class="display-block">{{ trans('messages.auction.start_date') }}:</label>
                                <input type="datetime-local" class="form-control" value="" name="start_date"
                                       placeholder="@lang('messages.auction.start_date') ">
                                @error('start_date')<span style="color: #e81414;">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label class="display-block">{{ trans('messages.auction.end_date') }}:</label>
                                <input type="datetime-local" class="form-control" value="" name="end_date"
                                       placeholder="@lang('messages.auction.end_date') ">
                                @error('end_date')<span style="color: #e81414;">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" value="{{ old('start_auction_price')}}"
                                       name="start_auction_price"
                                       placeholder="@lang('messages.auction.start_auction_price') ">
                                @error('start_auction_price')<span
                                    style="color: #e81414;">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" value="{{ old('value_of_increment')}}"
                                       name="value_of_increment"
                                       placeholder="@lang('messages.auction.value_of_increment') ">
                                @error('value_of_increment')<span style="color: #e81414;">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" value="{{ old('delivery_charge')}}"
                                       name="delivery_charge"
                                       placeholder="@lang('messages.auction.delivery_charge') ">
                                @error('delivery_charge')<span style="color: #e81414;">{{ $message }}</span>@enderror
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
                        </div><hr><br>


                        <div class="row">
                            <div class="form-group">
                                <label>@lang('messages.auction.images')</label>
{{--                                <input type="file" multiple="multiple" id="gallery-photo-add" class="form-control" name="images[]">--}}
{{--                                <div class="gallery"></div>--}}


                                <div class="input-group control-group increment" >
                                    <input type="file" name="images[]" class="form-control image"><br>
                                    <div class="form-group">
                                        <img src=" {{ asset('uploads/default.png') }} " width=" 100px "
                                             class="thumbnail image-preview">
                                    </div>
                                </div>
                                <div class="input-group-btn">
                                    <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>{{trans('messages.add_another_image')}}</button>
                                </div>
                                <div class="clone hide">
                                    <div class="control-group input-group" style="margin-top:10px">
                                        <input type="file"  name="images[]" class="form-control image-x">
{{--                                            <img src=" {{ asset('uploads/default.png') }} " width=" 100px "--}}
{{--                                                 class="thumbnail image-preview-x">--}}
                                        <div class="input-group-btn">
                                            <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> حذف </button>
                                        </div>
                                    </div>
                                </div>
                                @error('images')<span style="color: #e81414;">{{ $message }}</span>@enderror
                            </div>
                        </div><hr><br>


                        <div class="row">
                            <h4><i class="icon-file-pdf"> </i> @lang('messages.auction.inspection_report_files')</h4>
                            <div class="form-group">
                                <div class="col-lg-6">
                                    <select name="file_name_id" class="select form-control">
                                        <option selected disabled>{{trans('messages.select_file_name')}}</option>
                                        @foreach ($inspection_file_names as $inspection_file_name)
                                            <option value="{{ $inspection_file_name->id }}"> {{ $inspection_file_name->name }} </option>
                                        @endforeach
                                    </select>
                                    @error('file_name_id')<span style="color: #e81414;">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-lg-6">
                                    <input type="file" multiple class="form-control" name="inspection_report_images[]">
                                </div>
                                @error('inspection_report_images')<span style="color: #e81414;">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <hr><br><br>
                        <div class="row">
                            <div class="form-group">
                                <label> <i class="icon-file-pdf"></i> @lang('messages.extra_file_only_to_admin'):
                                </label>
                                <input type="file" class="form-control " name="extra">
                            </div>
                        </div><hr><br>
                        <div class="row">
                            <div class="form-group">
                                <label>@lang('messages.auction.location'):</label>
                                @error('latitude')<span style="color: #e81414;">{{ $message }}</span>@enderror

                                <div class="col-lg-12">
{{--                                    <input id="searchInput" class=" form-control"--}}
{{--                                           style="background-color: #FFF;margin-left: -150px;"--}}
{{--                                           placeholder=" اختر المكان علي الخريطة " name="other">--}}
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
                        <button type="submit" class="btn btn-primary stepy-finish mt-5"
                                id="save-form-btn">{{ trans('messages.add_and_forward_to_list') }}
                            <i class="icon-check position-right"></i>
                        </button>
                    </form>
                </div>
                <!-- /basic setup -->

            </div>
        </div>
        <div class="col-md-3" dir="{{ direction() }}">
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
                                <td> {{ substr($auction->$name,0,15) }} </td>
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
    @include('Dashboard.Auctions.parts.ajax_get_options_by_category_id')
    @include('Dashboard.Auctions.parts.image_preview')

    <script type="text/javascript">
        $(document).ready(function() {
            $(".btn-success").click(function(){
                var html = $(".clone").html();
                $(".increment").after(html);
            });
            $("body").on("click",".btn-danger",function(){
                $(this).parents(".control-group").remove();
            });
        });
    </script>
@endsection



{{--<script>--}}
{{--    function registerClickHandler() {--}}
{{--        // Implement the click handler here for button of class 'remove'--}}
{{--        $('.remove').click(function() {--}}
{{--            $(this).parent().remove();--}}
{{--        });--}}
{{--    }--}}
{{--    registerClickHandler();--}}
{{--</script>--}}







{{--                        <h3>@lang('messages.auction.address'):</h3>--}}
{{--                        <div class="form-group">--}}
{{--                            <label--}}
{{--                                class="col-lg-3 control-label display-block"> {{ trans('messages.city_name') }} </label>--}}
{{--                            <div class="col-lg-9">--}}
{{--                                <select name="city_id" class="select form-control" id="cities">--}}
{{--                                    <option selected disabled>{{trans('messages.select')}}</option>--}}
{{--                                    @foreach ($cities as $city)--}}
{{--                                        <option value="{{ $city->id }}"> {{ $city->$name }} </option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                @error('city_id')<span style="color: #e81414;">{{ $message }}</span>@enderror--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="row">--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="col-lg-3 control-label"> @lang('messages.auction.address'): </label>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <input type="text" class="form-control" value="{{ old('address')}}" name="address"--}}
{{--                                           placeholder="@lang('messages.auction.address_details') ">--}}
{{--                                </div>--}}
{{--                                @error('address')<span style="color: #e81414;">{{ $message }}</span>@enderror--}}

{{--                            </div>--}}
{{--                        </div>--}}


{{--                    <div class="row">--}}
{{--                        <div class="form-group">--}}
{{--                            <div class="form-group">--}}
{{--                                <label>@lang('messages.auction.inspection_report_images')</label>--}}
{{--                                <input type="file" multiple id="inspection-photo-add"  class="form-control" name="inspection_report_images[]">--}}
{{--                                <div class="gallery1"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}



{{--<div class="form-group">--}}
{{--    <label>@lang('messages.auction.images')</label>--}}
{{--    <input type="file" multiple="multiple" id="gallery-photo-add" class="form-control" name="images[]">--}}
{{--    <div class="gallery"></div>--}}
{{--    @error('images')<span style="color: #e81414;">{{ $message }}</span>@enderror--}}
{{--</div>--}}
