@extends('front.layouts.master')
@section('title', trans('messages.auction.add'))
@section('style')
    <style> #map {height: 400px;}
    .hide{
        visibility: hidden;
    }
        /*.hide-file{*/
        /*    visibility: hidden;*/
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
    </section>
@stop

@push('scripts')
    @include('front.layouts.parts.map')
    @include('front.auctions.parts.add_auction_ajax_get_options')
    <script type="text/javascript">
// ======== repeat upload iamge ================================//
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
// ======== repeat upload file ================================//
        $(document).ready(function() {
            $(".btn-file").click(function(){
                var x = $(".clone-file").html();
                $(".increment-file").after(x);
            });
            $("body").on("click",".btn-danger-file",function(){
                $(this).parent(".control-group").remove();
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
