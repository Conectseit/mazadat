@extends('front.layouts.master')
@section('title', trans('messages.auction.add'))
@section('style')
    <style> #map {height: 400px;}
    .hide{
        visibility: hidden;
    }
        .hide-file{
            visibility: hidden;
        }
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
                <form action="{{route('front.add_auction1')}}" method="post" id="submitted-form"
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
                                <div class="select-inputs-options"></div>
                                <h6 class="group-title">  {{trans('messages.option_terms')}}</h6>
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



                        @include('front.auctions.parts.add_auction_images_and_files')


                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label class="form-label">{{trans('messages.auction.is_appear_location')}}</label>
                            </div>
                            <div class="col-lg-5 col-md-4">
                                <select class="form-select" id="is_appear_location" name="is_appear_location" data-placeholder="{{trans('back.select')}}">
                                    <option value="0">{{trans('messages.No')}}</option>
                                    <option value="1" id="yes">{{trans('messages.Yes')}}</option>
                                </select>

                            </div>
                        </div>

                        <div class="map" id="map-section" style="display:none;">

                        <div class="form-group">
                            <label>@lang('messages.auction.location'):</label>
                            <div class="col-lg-12">
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





{{--        <div data-repeater-list="invoice">--}}
{{--            <div data-repeater-item class="invoice_add">--}}
{{--                <div class="row d-flex align-items-end">--}}
{{--                    <div class="col-md-2 col-12">--}}
{{--                        <div class="mb-1">--}}
{{--                            <label class="form-label" for="itemname">إختار إسم الصنف</label>--}}
{{--                            --}}{{--<select class="form-control" id="itemname" aria-describedby="itemname" name="item_id[]">--}}
{{--                            <select class="form-control item select2 form-select" id="itemname" aria-describedby="itemname" name="item_id[]" onchange="showItems(this)">--}}
{{--                                <option></option>--}}
{{--                                @foreach($items as $item)--}}
{{--                                    <option value="{{$item->id}}">{{$item->name}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            @if($errors->has('item_id[]'))--}}
{{--                                <span class="text-danger">{{ $errors->first('item_id[]') }}</span>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-1 col-12 category_base" >--}}
{{--                        <div class="mb-1">--}}
{{--                            <label class="form-label" for="categoryname"> إسم القسم</label>--}}
{{--                            --}}{{--<select class="form-control item select2 form-select" id="categoryname" aria-describedby="categoryname" name="category_id[]" >--}}
{{--                            <input name="category" type="text" readonly="" class="form-control-plaintext" placeholder="القسم">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-1 col-12 company_base" >--}}
{{--                        <div class="mb-1">--}}
{{--                            <label class="form-label" for="companyname"> إسم الشركه</label>--}}
{{--                            <input name="company" type="text" readonly="" class="form-control-plaintext" placeholder="الشركه">--}}

{{--                            --}}{{--<select class="form-control item select2 form-select" id="companyname" aria-describedby="companyname" name="company_id[]" >--}}
{{--                            --}}{{--<option></option>--}}
{{--                            --}}{{--</select>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-md-1 col-12 unit_base">--}}
{{--                        <div class="mb-1">--}}
{{--                            <label class="form-label" for="itemcost">إختار الوحده</label>--}}
{{--                            <select class="form-control  select2 form-select" id="itemcost" aria-describedby="itemcost" name="unit_id[]">--}}
{{--                                <option></option>--}}
{{--                                @foreach($units as $unit)--}}
{{--                                    <option value="{{$unit->id}}">{{$unit->name}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            @if($errors->has('unit_id[]'))--}}
{{--                                <span class="text-danger">{{ $errors->first('unit_id[]')}}</span>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-md-1 col-12 price_base">--}}
{{--                        <div class="mb-1">--}}
{{--                            <label class="form-label" for="staticprice">السعر</label>--}}
{{--                            <input type="text" name="price[]" class="form-control itemprice" id="staticprice" aria-describedby="staticprice" placeholder="السعر" step="any" />--}}
{{--                            @if($errors->has('price[]'))--}}
{{--                                <span class="text-danger">{{ $errors->first('price[]') }}</span>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-md-1 col-12 qty_base">--}}
{{--                        <div class="mb-1">--}}
{{--                            <label class="form-label" for="itemquantity">الكميه</label>--}}
{{--                            <input value="1"--}}
{{--                                   type="number"--}}
{{--                                   class="form-control itemquantity"--}}
{{--                                   id="itemquantity"--}}
{{--                                   aria-describedby="itemquantity"--}}
{{--                                   placeholder="1"--}}
{{--                                   name="qty[]"--}}
{{--                                   onchange="showQuantityItems(this)"--}}
{{--                            />--}}
{{--                            @if($errors->has('qty[]'))--}}
{{--                                <span class="text-danger">{{ $errors->first('qty[]') }}</span>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-md-1 col-12 count_item_base">--}}
{{--                        <div class="mb-1">--}}
{{--                            <label class="form-label" for="count_item">عدد الوحده</label>--}}
{{--                            <input onchange="showCount(this)" value="0"--}}
{{--                                   type="number"--}}
{{--                                   class="form-control"--}}
{{--                                   id="count_item"--}}
{{--                                   placeholder="عدد الوحده وليكن 14 زجاجه"--}}
{{--                                   aria-describedby="count_item"--}}
{{--                                   name="count_item"--}}
{{--                            />--}}
{{--                            @if($errors->has('count_item[]'))--}}
{{--                                <span class="text-danger">{{ $errors->first('count_item[]') }}</span>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-1 col-12 price_unit_base">--}}
{{--                        <div class="mb-1">--}}
{{--                            <label class="form-label" for="price_unit">سعر الوحده</label>--}}
{{--                            <input type="text" readonly="" name="price_unit" class="form-control-plaintext" id="price_unit" value="0" step="any">--}}
{{--                            @if($errors->has('price_unit'))--}}
{{--                                <span class="text-danger">{{ $errors->first('price_unit') }}</span>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-1 col-12 size_base">--}}
{{--                        <div class="mb-1">--}}
{{--                            <label class="form-label" for="size_base">حجم الوحده</label>--}}
{{--                            <input type="text" readonly="" name="size" class="form-control-plaintext" id="size_base" value="0" step="any">--}}
{{--                            @if($errors->has('size'))--}}
{{--                                <span class="text-danger">{{ $errors->first('size') }}</span>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-md-1 col-12 min_stock_base" >--}}
{{--                        <div class="mb-1">--}}
{{--                            <input name="min_stock" type="hidden" readonly="" class="form-control-plaintext" placeholder="الحد الادني للمخزون">--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-md-1 col-12 mb-50">--}}
{{--                        <div class="mb-1">--}}
{{--                            <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">--}}
{{--                                <i data-feather="x" class="me-25"></i>--}}
{{--                                <span>حذف</span>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <hr />--}}
{{--            </div>--}}














{{--    </section>--}}
@stop

@push('scripts')
    @include('front.layouts.parts.map')
    @include('front.auctions.parts.add_auction_ajax_get_options')
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

    <script type="text/javascript">
        $(document).ready(function() {
            $(".btn-file").click(function(){
                var x = $(".clone-file").html();
                $(".increment-file").after(x);
            });
            $("body").on("click",".btn-danger-file",function(){
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
@endpush
