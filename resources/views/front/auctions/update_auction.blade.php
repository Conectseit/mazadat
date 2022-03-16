@extends('front.layouts.master')
@section('title', trans('messages.auction.update'))
@section('style')
    <style> #map {height: 400px;}</style>
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/js/plugins/dropzone/dist/min/dropzone.min.css') }}"/>

@endsection


@section('content')
    @include('front.auctions.parts.head')
    <section class="sign-up-page">
        @include('front.layouts.parts.alert')

        <div class="container">
            <h4 class="title"> {{ trans('messages.auction.update') }}</h4>
            <div class="row">
                <form action="{{route('front.auction_update',$auction)}}" method="post"  id="submitted-form" enctype="multipart/form-data">
                    @csrf
                    <div class="inputs-group">
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="email" class="form-label">{{trans('messages.name_ar')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="text" id="name_ar" name="name_ar"
                                       class="form-control   @error('name_ar') is-invalid @enderror"
                                       value="{{$auction->name_ar}}">
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
                                       value="{{$auction->name_en}}">
                                @error('name_en')<span style="color: #e81414;">{{ $message }}</span>@enderror

                            </div>
                        </div>


                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="email" class="form-label">{{trans('messages.description_ar')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <textarea name="description_ar"
                                          class="form-control @error('description_ar') is-invalid @enderror" cols="100">
                                    {{ $auction->description_ar }}
                                </textarea>
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
                                          >{{ $auction->description_en }}
                                </textarea>
                                @error('description_en')<span style="color: #e81414;">{{ $message }}</span>@enderror
                            </div>
                        </div>


                    </div>

                    <div class="inputs-group">
                        <h5 class="group-title"> {{ trans('messages.auction.auction_terms') }}</h5>
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="email" class="form-label">{{ trans('messages.auction.auction_terms_ar') }}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <textarea name="auction_terms_ar"
                                          class="form-control @error('auction_terms_ar') is-invalid @enderror" cols="100">
                                   {{ $auction->auction_terms_ar }}
                                </textarea>
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
                                          class="form-control @error('auction_terms_en') is-invalid @enderror" cols="100"
                                          >{{ $auction->auction_terms_en }}
                                </textarea>
                                @error('auction_terms_en')<span style="color: #e81414;">{{ $message }}</span>@enderror
                            </div>

                        </div>


                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="email" class="form-label">{{trans('messages.auction.start_auction_price')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="number" id="start_auction_price" name="start_auction_price"
                                       class="form-control   @error('start_auction_price') is-invalid @enderror"
                                       value="{{ $auction->start_auction_price }}">
                                @error('start_auction_price')<span style="color: #e81414;">{{ $message }}</span>@enderror

                            </div>
                        </div>
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="email" class="form-label">{{trans('messages.auction.value_of_increment')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <input type="number" id="value_of_increment" name="value_of_increment"
                                       class="form-control   @error('value_of_increment') is-invalid @enderror"
                                       value="{{$auction->value_of_increment}}">
                                @error('value_of_increment')<span style="color: #e81414;">{{ $message }}</span>@enderror

                            </div>
                        </div>
{{--                        <div class="form-group mb-4 row">--}}
{{--                            <div class="col-lg-2 col-md-3 d-flex align-items-center">--}}
{{--                                <label  class="form-label">{{trans('messages.auction.allowed_take_photo')}}</label>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-10 col-md-9">--}}
{{--                                <label class="radio-inline">--}}
{{--                                    <input type="radio" value="0" class="styled" name="allowed_take_photo">--}}
{{--                                    {{trans('messages.No')}}--}}
{{--                                </label>--}}
{{--                                <label class="radio-inline">--}}
{{--                                    <input type="radio" value="1" class="styled" name="allowed_take_photo">--}}
{{--                                    {{trans('messages.Yes')}}--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>

                    <div class="inputs-group">
{{--                        <h5 class="group-title"> {{ trans('messages.auction.options') }}</h5>--}}
{{--                        <div class="form-group mb-4 row">--}}
{{--                            <div class="col-lg-2 col-md-3 d-flex align-items-center">--}}
{{--                                <label for="email" class="form-label">{{ trans('messages.auction.choose_category')}}</label>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-10 col-md-9">--}}
{{--                                <select class="form-select form-control"  id="category" name="category_id"--}}
{{--                                        aria-label="Default select example">--}}
{{--                                    <option selected disabled> {{ trans('messages.auction.choose_category')}}</option>--}}
{{--                                    @foreach ($categories as $category)--}}
{{--                                        <option value="{{ $category->id }}"> {{ $category->$name }} </option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            @error('category_id')<span style="color: #e81414;">{{ $message }}</span>@enderror--}}

{{--                        </div>--}}



{{--                        <div class="form-group mb-4 row">--}}
{{--                            <div class="col-lg-2 col-md-3 d-flex align-items-center">--}}
{{--                                <label for="email" class="form-label">{{ trans('messages.option.options') }}</label>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-10 col-md-9">--}}
{{--                                <select class="form-select form-control" name="option_id" id="options"--}}
{{--                                        aria-label="Default select example">--}}
{{--                                    <option selected disabled> {{ trans('messages.option.options') }}</option>--}}
{{--                                    @foreach ($options as $option)--}}
{{--                                        <option value="{{ $option->id }}"> {{ $option->$name }} </option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                <div class="select-inputs-options"></div>--}}
{{--                                @foreach ($options as $key => $option)--}}
{{--                                <select class="form-select form-control"  id="options" name="option_ids[]" multiple aria-label="Default select example">--}}
{{--                                    <option value="{{ $option->id }}">{{ $option->$name }}</option>--}}
{{--                                    <optgroup class="form-select form-control" id="options" label="{{ $option->$name }}" value="{{ $option->id }}">--}}
{{--                                        <option>Diplodocus</option>--}}
{{--                                        <option>Saltasaurus</option>--}}
{{--                                    </optgroup>--}}
{{--                                </select>--}}
{{--                                @endforeach--}}


{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}


                    <div class="inputs-group">
                        <h5 class="group-title"> {{trans('messages.enter_other_user_data')}}</h5>

                        <div class="form-group">
                            <label>@lang('messages.auction.images')</label>
{{--                            <input type="file" class="form-control " name="images[]" multiple="multiple"/>--}}
                            <input type="file" multiple id="gallery-photo-add"  class="form-control" name="images[]">
                            <div class="gallery"></div>
{{--                            <div class="gallery22" style="height: 40px;width: 40px;">--}}
{{--                                @if ($images)--}}
{{--                                <ul class="list-group">--}}
{{--                                    @foreach($images as $image)--}}
{{--                                        <li>--}}
{{--                                            <img src="{{asset($image->ImagePath) }}" style="height: 40px;" alt="">--}}
{{--                                            <button class="btn btn-danger" style="margin-top: 5px;"></button>--}}
{{--                                        </li>--}}
{{--                                    @endforeach--}}
{{--                                </ul>--}}
{{--                                @endif--}}
{{--                            </div>--}}
                        </div>

                        <hr>
                        <div class="form-group">
                            <label>@lang('messages.auction.inspection_report_images')</label>
{{--                            <input type="file" class="form-control " name="inspection_report_images[]" multiple="multiple"/>--}}
                            <input type="file" multiple id="inspection-photo-add"  class="form-control" name="inspection_report_images[]">
                            <div class="gallery1"></div>

{{--                            <div class="gallery222" style="height: 40px;width: 40px;">--}}
{{--                                @if ($inspection_report_images)--}}
{{--                                    <ul class="list-group">--}}
{{--                                        @foreach($inspection_report_images as $image)--}}
{{--                                            <li>--}}
{{--                                                <img src="{{asset($image->ImagePath) }}" style="height: 40px;" alt="">--}}
{{--                                                <button class="btn btn-danger" style="margin-top: 5px;"></button>--}}
{{--                                            </li>--}}
{{--                                        @endforeach--}}
{{--                                    </ul>--}}
{{--                                @endif--}}
{{--                            </div>--}}

                        </div><br>

                        <div class="form-group">
                            <label>@lang('messages.auction.location'):</label>
                            <div class="col-lg-12">
{{--                                                                    <input id="searchInput" class=" form-control"  placeholder=" اختر المكان علي الخريطة " name="other">--}}
                                <div id="map"></div>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" id="geo_lat" name="latitude"
                                       readonly="" placeholder=" latitude"
                                       value="{{isset($auction->latitude)?$auction->latitude:'24.7135517'}}"
                                       class="form-control hidden d-none">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" id="geo_lng" name="longitude" readonly="" placeholder="longitude"
                                       value="{{isset($auction->longitude)?$auction->longitude:'24.7135517'}}"
                                       class="form-control hidden d-none">
                            </div>
                            <br>

{{--                            <div class="tab-pane" id="images">--}}
{{--                                <div class="tile">--}}
{{--                                    <h3 class="tile-title">Upload Image</h3>--}}
{{--                                    <hr>--}}
{{--                                    <div class="tile-body">--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-md-12">--}}
{{--                                                <form action="" class="dropzone" id="dropzone" style="border: 2px dashed rgba(0,0,0,0.3)">--}}
{{--                                                    <input type="hidden" name="product_id" value="{{ $auction->id }}">--}}
{{--                                                    {{ csrf_field() }}--}}
{{--                                                </form>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="row d-print-none mt-2">--}}
{{--                                            <div class="col-12 text-right">--}}
{{--                                                <button class="btn btn-success" type="button" id="uploadButton">--}}
{{--                                                    <i class="fa fa-fw fa-lg fa-upload"></i>Upload Images--}}
{{--                                                </button>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        @if ($auction->images)--}}
{{--                                            <hr>--}}
{{--                                            <div class="row">--}}
{{--                                                @foreach($auction->images as $image)--}}
{{--                                                    <div class="col-md-3">--}}
{{--                                                        <div class="card">--}}
{{--                                                            <div class="card-body">--}}
{{--                                                                <img src="{{asset($image->ImagePath) }}" id="brandLogo" class="img-fluid" alt="img">--}}
{{--                                                                <a class="card-link float-right text-danger" href="">--}}
{{--                                                                    <i class="fa fa-fw fa-lg fa-trash"></i>--}}
{{--                                                                </a>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                @endforeach--}}
{{--                                            </div>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>

                        <div class="sign-btn">
                            <p> {{trans('messages.wait')}}</p>
                            <button type="submit" id="save-form-btn" class="btn btn-primary submit-btn">{{trans('messages.auction.update')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

@stop

@push('scripts')
    @include('front.auctions.parts.update_auction_map')
    @include('front.auctions.parts.ajax_get_options')
    @include('front.auctions.parts.image_preview')
{{--    <script type="text/javascript" src="{{ asset('backend/js/plugins/dropzone/dist/min/dropzone.min.js') }}"></script>--}}
{{--    <script type="text/javascript" src="{{ asset('backend/js/plugins/select2.min.js') }}"></script>--}}
{{--    <script type="text/javascript" src="{{ asset('backend/js/plugins/bootstrap-notify.min.js') }}"></script>--}}

{{--    <script>--}}
{{--        Dropzone.autoDiscover = false;--}}
{{--        $( document ).ready(function() {--}}
{{--            $('#categories').select2();--}}
{{--            let myDropzone = new Dropzone("#dropzone", {--}}
{{--                paramName: "image",--}}
{{--                addRemoveLinks: false,--}}
{{--                maxFilesize: 4,--}}
{{--                parallelUploads: 2,--}}
{{--                uploadMultiple: false,--}}
{{--                url: "",--}}
{{--                --}}{{--url: "{{ route('admin.products.images.upload') }}",--}}
{{--                autoProcessQueue: false,--}}
{{--            });--}}
{{--            myDropzone.on("queuecomplete", function (file) {--}}
{{--                window.location.reload();--}}
{{--                showNotification('Completed', 'All product images uploaded', 'success', 'fa-check');--}}
{{--            });--}}
{{--            $('#uploadButton').click(function(){--}}
{{--                if (myDropzone.files.length === 0) {--}}
{{--                    showNotification('Error', 'Please select files to upload.', 'danger', 'fa-close');--}}
{{--                } else {--}}
{{--                    myDropzone.processQueue();--}}
{{--                }--}}
{{--            });--}}
{{--            function showNotification(title, message, type, icon)--}}
{{--            {--}}
{{--                $.notify({--}}
{{--                    title: title + ' : ',--}}
{{--                    message: message,--}}
{{--                    icon: 'fa ' + icon--}}
{{--                },{--}}
{{--                    type: type,--}}
{{--                    allow_dismiss: true,--}}
{{--                    placement: {--}}
{{--                        from: "top",--}}
{{--                        align: "right"--}}
{{--                    },--}}
{{--                });--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}
@endpush




