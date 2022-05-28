@extends('front.layouts.master')
@section('title', trans('messages.auction.add'))
@section('style')
    <style> #map {height: 400px;}
    .hide{
        visibility: hidden;
    }
    </style>

{{-- ================== Test multi image =================== --}}
    <style>
{{--        .upload__box {--}}
{{--            padding: 40px;--}}
{{--        }--}}
{{--        .upload__inputfile {--}}
{{--            width: 0.1px;--}}
{{--            height: 0.1px;--}}
{{--            opacity: 0;--}}
{{--            overflow: hidden;--}}
{{--            position: absolute;--}}
{{--            z-index: -1;--}}
{{--        }--}}
{{--        .upload__btn {--}}
{{--            display: inline-block;--}}
{{--            font-weight: 600;--}}
{{--            color: #fff;--}}
{{--            text-align: center;--}}
{{--            min-width: 116px;--}}
{{--            padding: 5px;--}}
{{--            transition: all 0.3s ease;--}}
{{--            cursor: pointer;--}}
{{--            border: 2px solid;--}}
{{--            background-color: #4045ba;--}}
{{--            border-color: #4045ba;--}}
{{--            border-radius: 10px;--}}
{{--            line-height: 26px;--}}
{{--            font-size: 14px;--}}
{{--        }--}}
{{--        .upload__btn:hover {--}}
{{--            background-color: unset;--}}
{{--            color: #4045ba;--}}
{{--            transition: all 0.3s ease;--}}
{{--        }--}}
{{--        .upload__btn-box {--}}
{{--            margin-bottom: 10px;--}}
{{--        }--}}
{{--        .upload__img-wrap {--}}
{{--            display: flex;--}}
{{--            flex-wrap: wrap;--}}
{{--            margin: 0 -10px;--}}
{{--        }--}}
{{--        .upload__img-box {--}}
{{--            width: 200px;--}}
{{--            padding: 0 10px;--}}
{{--            margin-bottom: 12px;--}}
{{--        }--}}
{{--        .upload__img-close {--}}
{{--            width: 24px;--}}
{{--            height: 24px;--}}
{{--            border-radius: 50%;--}}
{{--            background-color: rgba(0, 0, 0, 0.5);--}}
{{--            position: absolute;--}}
{{--            top: 10px;--}}
{{--            right: 10px;--}}
{{--            text-align: center;--}}
{{--            line-height: 24px;--}}
{{--            z-index: 1;--}}
{{--            cursor: pointer;--}}
{{--        }--}}
{{--        .upload__img-close:after {--}}
{{--            content: '\2716';--}}
{{--            font-size: 14px;--}}
{{--            color: white;--}}
{{--        }--}}
{{--        .img-bg {--}}
{{--            background-repeat: no-repeat;--}}
{{--            background-position: center;--}}
{{--            background-size: cover;--}}
{{--            position: relative;--}}
{{--            padding-bottom: 100%;--}}
{{--        }--}}
    </style>
{{-- ================== Test multi image =================== --}}

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
                                <label for="email" class="form-label">{{ trans('messages.option.required_options') }}</label>
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
                                <h6 class="group-title">  {{trans('messages.option_terms')}}</h6>

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

                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="email" class="form-label">{{ trans('messages.option.not_required_options') }}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <div class="not-options"></div>
                            </div>
                        </div>

                    </div>


                    <div class="inputs-group">
                        <h5 class="group-title"> {{trans('messages.enter_other_user_data')}}</h5>

                        <div class="form-group">
                            <label>@lang('messages.auction.images')</label>
{{--                            <input type="file" multiple id="gallery-photo-add" class="form-control" name="images[]">--}}
{{--                            <div class="gallery" id="output">--}}
{{--                            </div>--}}

                            <div class="input-group control-group increment" >
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6"> اختر صورة : <input type="file" name="images[]" class=" image"><br>
                                        </div>
                                        <div class="col-lg-6">
                                            <img src=" {{ asset('uploads/default.png') }} " width=" 100px " class="thumbnail image-preview">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="input-group-btn">
                                <button class="btn btn-success add" type="button"> <i class="glyphicon glyphicon-plus"> </i> {{trans('messages.add_another_image')}}</button>
                            </div>
                            <div class="clone hide">
                                <div class="control-group input-group" style="margin-top:10px">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <input type="file"  name="images[]" class="form-control" accept="image/*" onchange="readURL2(this)" >
                                        </div>
                                        <div class="col-lg-4">
                                            <img id="img-preview2" style="width: 120px ; height:90px"
                                                 src="{{ asset('uploads/images.jpg') }}" width="250px"/>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="input-group-btn">
                                                <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> حذف </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div> <hr><br>




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
{{--    @include('front.auctions.parts.image_preview')--}}
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





    <script>
        // ======== image preview ================================//
        $(".image").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.image-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
        // ======== image preview ================================//
    </script>

    <script>
        // ======== image preview ================================//
        function readURL2(input) {
            console.log(input.files);
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#img-preview2").attr("src", e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                $("#img-preview2").attr("src", " {{asset('uploads/images.jpg')}}");
            }
        }
        // ======== image preview ================================//
    </script>
@endpush












{{-- ================== Test multi image =================== --}}

{{--                        <div class="form-group">--}}
{{--                            <label>@lang('messages.auction.images')</label>--}}
{{--                            <div class="upload__box">--}}
{{--                                <div class="upload__btn-box">--}}
{{--                                    <label class="upload__btn">--}}
{{--                                        <p>Upload images</p>--}}
{{--                                        <input type="file" multiple="" data-max_length="20" class="upload__inputfile" name="images[]">--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="upload__img-wrap"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--    <script src="https://code.jquery.com/jquery-3.6.0.min.js"--}}
{{--            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>--}}
{{--    <script>--}}
{{--        jQuery(document).ready(function () {--}}
{{--            ImgUpload();--}}
{{--        });--}}
{{--        function ImgUpload() {--}}
{{--            var imgWrap = "";--}}
{{--            var imgArray = [];--}}

{{--            $('.upload__inputfile').each(function () {--}}
{{--                $(this).on('change', function (e) {--}}
{{--                    imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');--}}
{{--                    var maxLength = $(this).attr('data-max_length');--}}

{{--                    var files = e.target.files;--}}
{{--                    var filesArr = Array.prototype.slice.call(files);--}}
{{--                    var iterator = 0;--}}
{{--                    filesArr.forEach(function (f, index) {--}}

{{--                        if (!f.type.match('image.*')) {--}}
{{--                            return;--}}
{{--                        }--}}

{{--                        if (imgArray.length > maxLength) {--}}
{{--                            return false--}}
{{--                        } else {--}}
{{--                            var len = 0;--}}
{{--                            for (var i = 0; i < imgArray.length; i++) {--}}
{{--                                if (imgArray[i] !== undefined) {--}}
{{--                                    len++;--}}
{{--                                }--}}
{{--                            }--}}
{{--                            if (len > maxLength) {--}}
{{--                                return false;--}}
{{--                            } else {--}}
{{--                                imgArray.push(f);--}}

{{--                                var reader = new FileReader();--}}
{{--                                reader.onload = function (e) {--}}
{{--                                    var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";--}}
{{--                                    imgWrap.append(html);--}}
{{--                                    iterator++;--}}
{{--                                }--}}
{{--                                reader.readAsDataURL(f);--}}
{{--                            }--}}
{{--                        }--}}
{{--                    });--}}
{{--                });--}}
{{--            });--}}

{{--            $('body').on('click', ".upload__img-close", function (e) {--}}
{{--                var file = $(this).parent().data("file");--}}
{{--                for (var i = 0; i < imgArray.length; i++) {--}}
{{--                    if (imgArray[i].name === file) {--}}
{{--                        imgArray.splice(i, 1);--}}
{{--                        break;--}}
{{--                    }--}}
{{--                }--}}
{{--                $(this).parent().parent().remove();--}}
{{--            });--}}
{{--        }--}}
{{--    </script>--}}

{{-- ================== Test multi image =================== --}}
