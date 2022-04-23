@extends('front.layouts.master')
@section('title', trans('messages.auction.add'))
@section('style')
    <style> #map {
            height: 400px;
        }

        /*.remove-image {*/
        /*    display: none;*/
        /*    position: absolute;*/
        /*    text-align: center;*/
        /*    !*top: -10px;*!*/
        /*    !*right: -10px;*!*/
        /*    border-radius: 10em;*/
        /*    padding: 2px 6px 3px;*/
        /*    text-decoration: none;*/
        /*    font: 700 21px/20px sans-serif;*/
        /*    background: #555;*/
        /*    border: 3px solid #fff;*/
        /*    color: #FFF;*/
        /*    box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 2px 4px rgba(0,0,0,0.3);*/
        /*    text-shadow: 0 1px 2px rgba(0,0,0,0.5);*/
        /*    -webkit-transition: background 0.5s;*/
        /*    !*transition: background 0.5s;*!*/
        /*}*/
        /*.remove-image:hover {*/
        /*    background: #E54E4E;*/
        /*    padding: 3px 7px 5px;*/
        /*    top: -11px;*/
        /*    right: -11px;*/
        /*}*/
        /*.remove-image:active {*/
        /*    background: #E54E4E;*/
        /*    top: -10px;*/
        /*    right: -11px;*/
        /*}*/

    </style>
@endsection

@section('content')
    <section class="sign-up-page" dir="{{ direction() }}">
        @include('front.layouts.parts.alert')

        <div class="container">
            <h4 class="title">
                <a href="{{ url()->previous() }}" class="mt-2 mx-1 back"> <i
                        class="fal fa-arrow-circle-{{ floating('right','left') }}" style="color: black;"></i> </a>

                {{ trans('messages.auction.add_new') }}</h4>
            <div class="row">
                <form action="{{route('front.add_auction')}}" method="post" id="submitted-form"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="inputs-group">
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="email" class="form-label">{{trans('messages.name_ar')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="text" id="name_ar" name="name_ar"
                                       class="form-control   @error('name_ar') is-invalid @enderror"
                                       value="{{ old('name_ar') }}"
                                       placeholder="{{trans('messages.enter_name_ar')}}">
                                @error('name_ar')<span style="color: #e81414;">{{ $message }}</span>@enderror
                            </div>
                        </div>


                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="email" class="form-label">{{trans('messages.name_en')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="text" id="name_en" name="name_en"
                                       class="form-control   @error('name_en') is-invalid @enderror"
                                       value="{{ old('name_en') }}"
                                       placeholder="{{trans('messages.enter_name_en')}}">
                                @error('name_en')<span style="color: #e81414;">{{ $message }}</span>@enderror

                            </div>
                        </div>


                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="email" class="form-label">{{trans('messages.description_ar')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <textarea name="description_ar"
                                          class="form-control @error('description_ar') is-invalid @enderror" cols="100"
                                          placeholder="{{trans('messages.description_ar')}}">{{ old('description_ar') }}</textarea>
                                @error('description_ar')<span style="color: #e81414;">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="email" class="form-label">{{trans('messages.description_en')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <textarea name="description_en"
                                          class="form-control @error('description_en') is-invalid @enderror" cols="100"
                                          placeholder="{{trans('messages.description_en')}}">{{ old('description_en') }}</textarea>
                                @error('description_en')<span style="color: #e81414;">{{ $message }}</span>@enderror
                            </div>
                        </div>


                    </div>

                    <div class="inputs-group">
                        <h5 class="group-title"> {{ trans('messages.auction.auction_terms') }}</h5>
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="email"
                                       class="form-label">{{ trans('messages.auction.auction_terms_ar') }}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <textarea name="auction_terms_ar"
                                          class="form-control @error('auction_terms_ar') is-invalid @enderror"
                                          cols="100"
                                          placeholder="{{trans('messages.auction.auction_terms_ar')}}">{{ old('auction_terms_ar') }}</textarea>
                                @error('auction_terms_ar')<span style="color: #e81414;">{{ $message }}</span>@enderror
                            </div>

                        </div>

                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="email"
                                       class="form-label">{{trans('messages.auction.auction_terms_en')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <textarea name="auction_terms_en"
                                          class="form-control @error('auction_terms_en') is-invalid @enderror"
                                          cols="100"
                                          placeholder="{{trans('messages.auction.auction_terms_en')}}">{{ old('auction_terms_en') }}</textarea>
                                @error('auction_terms_en')<span style="color: #e81414;">{{ $message }}</span>@enderror
                            </div>

                        </div>


                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="email"
                                       class="form-label">{{trans('messages.auction.start_auction_price')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="number" id="start_auction_price" name="start_auction_price"
                                       class="form-control   @error('start_auction_price') is-invalid @enderror"
                                       value="{{ old('start_auction_price') }}"
                                       placeholder="{{trans('messages.auction.start_auction_price')}}">
                                @error('start_auction_price')<span
                                    style="color: #e81414;">{{ $message }}</span>@enderror

                            </div>
                        </div>
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="email"
                                       class="form-label">{{trans('messages.auction.value_of_increment')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="number" id="value_of_increment" name="value_of_increment"
                                       class="form-control   @error('value_of_increment') is-invalid @enderror"
                                       value="{{ old('value_of_increment') }}"
                                       placeholder="{{trans('messages.auction.value_of_increment')}}">
                                @error('value_of_increment')<span style="color: #e81414;">{{ $message }}</span>@enderror

                            </div>
                        </div>
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label class="form-label">{{trans('messages.auction.allowed_take_photo')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <label class="radio-inline">
                                    <input type="radio" value="0" class="styled" name="allowed_take_photo"
                                           checked="checked">
                                    {{trans('messages.No')}}
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" value="1" class="styled" name="allowed_take_photo">
                                    {{trans('messages.Yes')}}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="inputs-group">
                        <h5 class="group-title"> {{ trans('messages.auction.options') }}</h5>
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="email"
                                       class="form-label">{{ trans('messages.auction.choose_category')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <select class="form-select form-control" id="category" name="category_id"
                                        aria-label="Default select example">
                                    <option selected disabled> {{ trans('messages.auction.choose_category')}}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"> {{ $category->$name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('category_id')<span style="color: #e81414;">{{ $message }}</span>@enderror

                        </div>


                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="email" class="form-label">{{ trans('messages.option.options') }}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                {{--                                <select class="form-select form-control" name="option_id" id="options"--}}
                                {{--                                        aria-label="Default select example">--}}
                                {{--                                    <option selected disabled> {{ trans('messages.option.options') }}</option>--}}
                                {{--                                    @foreach ($options as $option)--}}
                                {{--                                        <option value="{{ $option->id }}"> {{ $option->$name }} </option>--}}
                                {{--                                    @endforeach--}}
                                {{--                                </select>--}}
                                <div class="select-inputs-options"></div>
                                {{--                                @foreach ($options as $key => $option)--}}
                                {{--                                <select class="form-select form-control"  id="options" name="option_ids[]" multiple aria-label="Default select example">--}}
                                {{--                                    <option value="{{ $option->id }}">{{ $option->$name }}</option>--}}
                                {{--                                    <optgroup class="form-select form-control" id="options" label="{{ $option->$name }}" value="{{ $option->id }}">--}}
                                {{--                                        <option>Diplodocus</option>--}}
                                {{--                                        <option>Saltasaurus</option>--}}
                                {{--                                    </optgroup>--}}
                                {{--                                </select>--}}
                                {{--                                @endforeach--}}


                            </div>
                        </div>
                    </div>


                    <div class="inputs-group">
                        <h5 class="group-title"> {{trans('messages.enter_other_user_data')}}</h5>

                        <div class="form-group">
                            <label>@lang('messages.auction.images')</label>
                            {{--                            <input type="file" class="form-control " name="images[]" multiple="multiple"/>--}}
                            <input type="file" multiple id="gallery-photo-add" class="form-control" name="images[]">
                            {{--                            <input id="btn1" type="button" value="Click me" onclick="onClick1()" style="height: 100px; width: 100px;">--}}

                            <div class="gallery" id="output">

                            {{--                                <p><button onclick="remove_img()"> remove </button></p>--}}
                            <!--<a class="remove-image" href="#" style="display: inline;">&#215;</a>-->
                            </div>
                        </div>

                        <hr>
                        <br>

                        <div class="form-group">
                            <h4>@lang('messages.auction.inspection_report_files')</h4><br>
                            <div class="row">
                                <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                    <label>@lang('messages.file_name')</label>
                                </div>
                                <div class="col-lg-10 col-md-9">
                                    <select name="file_name_id" class="form-select form-control">
                                        <option selected disabled>{{trans('messages.select_file_name')}}</option>
                                        @foreach ($inspection_file_names as $inspection_file_name)
                                            <option
                                                value="{{ $inspection_file_name->id }}"> {{ $inspection_file_name->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @error('file_name_id')<span style="color: #e81414;">{{ $message }}</span>@enderror

                            <br>
                            <div class="row">
                                <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                    <label>@lang('messages.select_file')</label>
                                </div>
                                <div class="col-lg-10 col-md-9">
                                    <input type="file" class="form-control" name="inspection_report_images[]">
                                </div>
                            </div>
                            @error('inspection_report_images')<span
                                style="color: #e81414;">{{ $message }}</span>@enderror

                        </div><hr><br>


                        {{--  <div class="form-group">--}}
                        {{--                            <label>@lang('messages.auction.inspection_report_images')</label>--}}
                        {{--                            <input type="file" class="form-control " name="inspection_report_images[]" multiple="multiple"/>--}}
                        {{--                            <input type="file" multiple id="inspection-photo-add"  class="form-control" name="inspection_report_images[]">--}}
                        {{--                            <div class="gallery1"></div>--}}
                        {{--                        </div><br>--}}


                        <br>
                        <br>
                        <div class="form-group">
                            <label>@lang('messages.auction.location'):</label>
                            <div class="col-lg-12">
                                {{--                                    <input id="searchInput" class=" form-control"  placeholder=" اختر المكان علي الخريطة " name="other">--}}
                                <div id="map"></div>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" id="geo_lat" name="latitude" readonly="" placeholder=" latitude"
                                       class="form-control hidden d-none">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" id="geo_lng" name="longitude" readonly="" placeholder="longitude"
                                       class="form-control hidden d-none">
                            </div>
                        </div>

                        <div class="sign-btn">
                            <p> {{trans('messages.wait')}}</p>
                            <button type="submit" id="save-form-btn"
                                    class="btn btn-primary submit-btn">{{trans('messages.auction.add')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

@stop

@push('scripts')
    @include('front.layouts.parts.map')
    @include('front.auctions.parts.add_auction_ajax_get_options')
    @include('front.auctions.parts.image_preview')
@endpush

