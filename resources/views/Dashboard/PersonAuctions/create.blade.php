@extends('Dashboard.layouts.master')
@section('title', trans('messages.create-var',['var'=>trans('messages.auction.auction')]))
@section('style')
    <style> #map {
            height: 400px;
        } </style>
@endsection
@section('breadcrumb')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i
                            class="icon-home2 position-left"></i> @lang('messages.home')</a>
            </li>
            <li><a href="{{ route('person_auctions.index') }}"><i
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
                    <form action="{{ route('person_auctions.store') }}" method="post" id="submitted-form"
                          class=" stepy-basic wizard-form steps-validation" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="userType" id="userType" value="">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-lg-3 control-label display-block">
                                    {{ trans('messages.auction.seller_full_name') }}
                                </label>
                                <div class="col-md-6">
                                    <select name="seller_id" id="seller_id" class="select" onchange="updateAdditionalFields(this)">
                                        <option selected disabled>{{trans('messages.select')}}</option>

                                        <optgroup label="{{ trans('messages.auction.seller_full_name') }}">
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}" data-is-company="{{ $user->is_company }}">
                                                    {{ $user->user_name }} </option>
                                            @endforeach
                                        </optgroup>
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

                            <div id="additionalFields">
                                {{--@if($user->is_company == 'person')--}}

                                    {{--<div class="form-group">--}}
                                        {{--<input type="text" class="form-control" value="{{ old('name_of_the_licensor')}}"--}}
                                               {{--name="name_of_the_licensor"--}}
                                               {{--placeholder="@lang('messages.auction.name_of_the_licensor') ">--}}
                                        {{--@error('name_of_the_licensor')<span--}}
                                                {{--style="color: #e81414;">{{ $message }}</span>@enderror--}}
                                    {{--</div>--}}
                                    {{--<div class="form-group">--}}
                                        {{--<input type="number" class="form-control" value="{{ old('license_number')}}"--}}
                                               {{--name="license_number"--}}
                                               {{--placeholder="@lang('messages.auction.enter_license_number') ">--}}
                                        {{--@error('license_number')<span style="color: #e81414;">{{ $message }}</span>@enderror--}}
                                    {{--</div>--}}
                                {{--@elseif($user->is_company == 'company')--}}
                                    {{--<div class="form-group">--}}
                                        {{--<input type="number" class="form-control"--}}
                                               {{--value="{{ old('brokerage_license_number')}}"--}}
                                               {{--name="brokerage_license_number"--}}
                                               {{--placeholder="@lang('messages.auction.brokerage_license_number_for_brokers') ">--}}
                                        {{--@error('brokerage_license_number')<span--}}
                                                {{--style="color: #e81414;">{{ $message }}</span>@enderror--}}
                                    {{--</div>--}}


                                {{--@endif--}}
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="control-label">
                                    {{ trans('messages.auction.auction_terms_ar') }}:
                                </label>
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
                                <label class="col-lg-3 control-label display-block">
                                    {{ trans('messages.auction.choose_category') }}
                                </label>
                                <div class="col-lg-6">
                                    <select name="category_id" id="category" class="select">
                                        <optgroup label="{{ trans('messages.auction.choose_category') }}}">
                                            <option selected disabled>{{trans('messages.select')}}</option>

                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}"
                                                        data-status="{{ $category->status }}">
                                                    {{ $category->$name }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                                @error('category_id')<span style="color: #e81414;">{{ $message }}</span>@enderror
                            </div>
                            <br>
                            <div class="form-group mb-4 row">
                                <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                    <label for="" class="form-label">
                                        {{ trans('messages.option.required_options') }}
                                    </label>
                                </div>
                                <div class="col-lg-10 col-md-9">
                                    <div class="select-inputs-options"></div>
                                </div>
                            </div>


                            <div class="form-group mb-4 row">
                                <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                    <label for="" class="form-label">
                                        {{ trans('messages.option.not_required_options') }}
                                    </label>
                                </div>
                                <div class="col-lg-10 col-md-9">
                                    <div class="not-options"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="real_estate" style="display: none;">

                            @include('front.auctions.parts.real_estate_page')

                        </div>
                        <hr>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <label class="display-block">
                                    {{ trans('messages.auction.start_date') }}:
                                </label>
                                <input type="datetime-local" class="form-control" value="" name="start_date"
                                       placeholder="@lang('messages.auction.start_date') ">
                                @error('start_date')<span style="color: #e81414;">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label class="display-block">
                                    {{ trans('messages.auction.end_date') }}:
                                </label>
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
                                <label class="display-block">
                                    {{ trans('messages.auction.who_can_see') }}:
                                </label>
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
                        <hr>
                        <br>


                        <div class="row">
                            <div class="form-group">
                                <label>@lang('messages.auction.images')</label>
                                {{--<input type="file" multiple="multiple"
                                id="gallery-photo-add" class="form-control" name="images[]">--}}
                                {{-- <div class="gallery"></div>--}}

                                <div class="input-group control-group increment">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-6"> اختر صورة : <input type="file" name="images[]"
                                                                                      class=" image"><br>
                                            </div>
                                            <div class="col-lg-6">
                                                <img src=" {{ asset('uploads/images.jpg') }} " width=" 150px "
                                                     class="thumbnail image-preview">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group-btn">
                                    <button class="btn btn-success" type="button"><i
                                                class="glyphicon glyphicon-plus"></i>{{trans('messages.add_another_image')}}
                                    </button>
                                </div>
                                <div class="clone hide">
                                    <div class="control-group input-group" style="margin-top:10px">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <input type="file" name="images[]" class="form-control" accept="image/*"
                                                       onchange="readURL2(this)">
                                            </div>
                                            <div class="col-lg-4">
                                                <img id="img-preview2" style="width: 120px ; height:90px"
                                                     src="{{ asset('uploads/images.jpg') }}" width="250px"/>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-danger" type="button"><i
                                                                class="glyphicon glyphicon-remove"></i> حذف
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @error('images')<span style="color: #e81414;">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <hr>
                        <br>


                        <div class="row">
                            <h4>
                                <i class="icon-file-pdf"> </i>
                                @lang('messages.auction.inspection_report_files')
                            </h4>

                            <div class="form-group">
                                <div class="col-lg-3">
                                    <select name="file_name_id" class="select form-control">
                                        <option selected disabled>{{trans('messages.select_file_name')}}</option>
                                        @foreach ($inspection_file_names as $inspection_file_name)
                                            <option
                                                    value="{{ $inspection_file_name->id }}"> {{ $inspection_file_name->name }} </option>
                                        @endforeach
                                    </select>
                                    @error('file_name_id')<span style="color: #e81414;">{{ $message }}</span>@enderror
                                </div>
                                {{--<div class="col-lg-3">--}}
                                {{--<input type="file"  class="form-control" name="image">--}}
                                {{--</div>--}}
                                <div class="col-lg-3">
                                    <input type="file" multiple class="form-control" name="inspection_report_images[]">
                                </div>
                                @error('inspection_report_images')<span
                                        style="color: #e81414;">{{ $message }}</span>@enderror
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="description"
                                           placeholder="@lang('messages.file_desc')" required>
                                </div>
                                @error('description')<span style="color: #e81414;">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <hr>
                        <br><br>
                        <div class="row">
                            <div class="form-group">
                                <label> <i class="icon-file-pdf"></i> @lang('messages.extra_file_only_to_admin'):
                                </label>
                                <input type="file" class="form-control " name="extra">
                            </div>
                        </div>
                        <hr>
                        <br>


                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label class="form-label">{{trans('messages.auction.is_appear_location')}}</label>
                            </div>
                            <div class="col-lg-5 col-md-4">
                                <select class="form-select" id="is_appear_location" name="is_appear_location"
                                        data-placeholder="{{trans('back.select')}}">
                                    <option value="0">{{trans('messages.No')}}</option>
                                    <option value="1" id="yes">{{trans('messages.Yes')}}</option>
                                </select>

                            </div>
                        </div>

                        <div class="map" id="map-section" style="display:none;">
                            <div class="form-group row ">
                                <div class="col-lg-12">
                                    <input id="searchInput" class=" form-control"
                                           style="background-color: #FFF;margin-left: -350px;"
                                           placeholder=" اختر المكان علي الخريطة " name="other">
                                    <div id="map"></div>
                                </div>

                                <div class="col-lg-6">
                                    <input type="text" id="geo_lat" name="latitude"
                                           readonly="" placeholder=" latitude" class="form-control">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" id="geo_lng" name="longitude"
                                           readonly="" placeholder="longitude" class="form-control">
                                </div>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary stepy-finish mt-5"
                                id="save-form-btn">{{ trans('messages.add_and_forward_to_list') }}
                            <i class="icon-check position-right"></i>
                        </button>
                    </form>
                </div>
                <!-- /basic setup -->

            </div>
        </div>
    </div>
@stop


@section('scripts')
    @include('Dashboard.layouts.parts.ajax_get_options')
    {{--    @include('Maps.map')--}}
    @include('Dashboard.layouts.parts.map')

    @include('Dashboard.Auctions.parts.ajax_get_options_by_category_id')
    {{--    @include('Dashboard.Auctions.parts.image_preview')--}}

    <script type="text/javascript">
        function updateAdditionalFields(selectElement) {
            var userType = selectElement.options[selectElement.selectedIndex].getAttribute('data-is-company');
            document.getElementById('userType').value = userType;

            // Show/hide additional fields based on the selected user type
            if (userType === 'person') {
                document.getElementById('additionalFields').innerHTML = `
                <div class="form-group">
                    <input type="text" class="form-control"
                    value="{{ old('name_of_the_licensor')}}" name="name_of_the_licensor"
                     placeholder="@lang('messages.auction.name_of_the_licensor') ">
                    @error('name_of_the_licensor')<span style="color: #e81414;">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <input type="number" class="form-control"
                    value="{{ old('license_number')}}" name="license_number"
                    placeholder="@lang('messages.auction.enter_license_number') ">
                    @error('license_number')<span style="color: #e81414;">{{ $message }}</span>@enderror
                </div>
            `;
            } else if (userType === 'company') {
                document.getElementById('additionalFields').innerHTML = `
                <div class="form-group">
                    <input type="number" class="form-control" value="{{ old('brokerage_license_number')}}"
                    name="brokerage_license_number" placeholder="@lang('messages.auction.brokerage_license_number_for_brokers') ">
                    @error('brokerage_license_number')<span style="color: #e81414;">{{ $message }}</span>@enderror
                </div>
            `;
            }
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $(".btn-success").click(function () {
                var html = $(".clone").html();
                $(".increment").after(html);
            });
            $("body").on("click", ".btn-danger", function () {
                $(this).parents(".control-group").remove();
            });
        });
    </script>
    <script>
        $('select#is_appear_location').on('change', function () {
            let is_appear_location = $(this).val();
            if (is_appear_location) {
                optionValue = document.getElementById("yes").value;
                if (optionValue === is_appear_location) {
                    document.getElementById("map-section").style.display = "block";
                } else {
                    document.getElementById("map-section").style.display = "none";
                }
            } else {
                document.getElementById("map-section").style.display = "block";
            }
        });
    </script>
    <script>
        $('select#category').on('change', function () {
            let selectedOption = $(this).find('option:selected');
            let categoryStatus = selectedOption.data('status');
            if (categoryStatus === 'real_estate') {
                document.getElementById("real_estate").style.display = "block";
            } else {
                document.getElementById("real_estate").style.display = "none";
            }
        });
    </script>

@endsection

{{--                        <div class="map" id="map-section" style="display:none;">--}}
{{--                            <div class="form-group">--}}
{{--                                <label>@lang('messages.auction.location'):</label>--}}
{{--                                <div class="col-lg-12">--}}
{{--                                    <input id="searchInput" class=" form-control"--}}
{{--                                           style="background-color: #FFF;margin-left: -350px;"--}}
{{--                                           placeholder=" اختر المكان علي الخريطة " name="other">--}}
{{--                                    <div id="map"></div>--}}
{{--                                </div>--}}
{{--                                <div class="col-lg-6">--}}
{{--                                    <input type="text" id="geo_lat" name="latitude" readonly="" placeholder=" latitude"--}}
{{--                                           class="form-control hidden d-none">--}}
{{--                                </div>--}}
{{--                                <div class="col-lg-6">--}}
{{--                                    <input type="text" id="geo_lng" name="longitude" readonly="" placeholder="longitude"--}}
{{--                                           class="form-control hidden d-none">--}}
{{--                                </div>--}}


{{--                            </div>--}}
{{--                        </div>--}}
