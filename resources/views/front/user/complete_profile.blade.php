@extends('front.layouts.master')
@section('title', trans('messages.my_profile'))
@section('style')
    <style>
        #img-preview3 {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            border: 5px solid #eee;
        }
        #map {height: 400px;}

        #add_map {height: 400px;}
    </style>
    <link rel="stylesheet" href="{{asset('Front/assets/css/profile_image.css')}}"/>

@endsection

@section('content')
    <section class="my-profile-page edit-profile">

        <div class="container">

            @include('front.layouts.parts.alert')


            @if(auth()->user()->is_completed==0)
                <h3>{{ trans('messages.please_complete_your_data')}}</h3>
            @endif

            <a href="{{ url()->previous() }}" class="mt-2 mx-1 back"> <i
                    class="fal fa-arrow-circle-right text-black"></i> </a> حسابي الشخصي


            <div class="row">
                <div class="edit-form">
                    <form action="{{route('front.complete_profile')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="inputs-group">
                            <h5 class="group-title">{{ trans('messages.please_complete_your_address_details')}}</h5>
                            <div class="form-group mb-4 row">
                                <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                    <label for="full_name"
                                           class="form-label"> {{ trans('messages.nationality.nationality') }}</label>
                                </div>
                                <div class="col-lg-10 col-md-9">
                                    <select class=" select form-select form-control" name="nationality_id"
                                            aria-label="Default select example">
                                        {{--                                        <option selected disabled>{{trans('messages.select')}}</option>--}}
                                        <option selected
                                                disabled>{{ isset(auth()->user()->nationality)? auth()->user()->nationality->$name :  trans('messages.select') }}
                                        </option>

                                        {{--                                        <option selected disabled>{{ auth()->user()->nationality->$name }}</option>--}}

                                        @foreach ($nationalities as $nationality)
                                            <option
                                                {{isset(auth()->user()->nationality_id)==$nationality->id? 'selected' : ''}}
                                                value="{{ $nationality->id }}"> {{ $nationality->$name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mb-4 row">
                                <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                    <label for="city_name" class="form-label"> {{ trans('messages.city_name') }}</label>
                                </div>
                                <div class="col-lg-10 col-md-9">
                                    <select class=" select form-select form-control" id="cities" name="city_id"
                                            aria-label="Default select example">

                                        <option selected
                                                disabled>{{ isset(auth()->user()->city)? auth()->user()->city->$name :  trans('messages.select') }}</option>
                                        @foreach ($cities as $city)
                                            <option {{isset(auth()->user()->city_id)==$city->id? 'selected' : ''}}
                                                    value="{{ $city->id }}"> {{ $city->$name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mb-4 row">
                                <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                    <label for="block" class="form-label"> {{trans('messages.P_O_Box')}}</label>
                                </div>
                                <div class="col-lg-10 col-md-9">
                                    <input type="text" class="form-control" id="name" name="P_O_Box"
                                           placeholder="{{trans('messages.P_O_Box')}}"
                                           value={{ auth()->user()->P_O_Box}}>
                                </div>
                                @error('P_O_Box')<span style="color: #e81414;">{{ $message }}</span>@enderror

                            </div>
                            @if(auth()->user()->is_company=='person')
                                <div class="form-group mb-4 row">
                                    <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                        <label for="block" class="form-label"> {{trans('messages.block')}}</label>
                                    </div>
                                    <div class="col-lg-10 col-md-9">
                                        <input type="text" class="form-control" id="name" name="block"
                                               placeholder="{{trans('messages.block')}}"
                                               value={{ isset(auth()->user()->block)?auth()->user()->block: old('block')}}>
                                    </div>
                                    @error('block')<span style="color: #e81414;">{{ $message }}</span>@enderror

                                </div>

                                <div class="form-group mb-4 row">
                                    <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                        <label for="block" class="form-label"> {{trans('messages.street')}}</label>
                                    </div>
                                    <div class="col-lg-10 col-md-9">
                                        <input type="text" class="form-control" id="name" name="street"
                                               placeholder="{{trans('messages.street')}}"
                                               value={{ auth()->user()->street}}>
                                    </div>
                                    @error('street')<span style="color: #e81414;">{{ $message }}</span>@enderror

                                </div>
                                <div class="form-group mb-4 row">
                                    <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                        <label for="block" class="form-label"> {{trans('messages.block_num')}}</label>
                                    </div>
                                    <div class="col-lg-10 col-md-9">
                                        <input type="text" class="form-control" id="name" name="block_num"
                                               placeholder="{{trans('messages.block_num')}}"
                                               value={{ auth()->user()->block_num}}>
                                    </div>
                                    @error('block_num')<span style="color: #e81414;">{{ $message }}</span>@enderror

                                </div>
                                <div class="form-group mb-4 row">
                                    <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                        <label for="block" class="form-label"> {{trans('messages.signs')}}</label>
                                    </div>
                                    <div class="col-lg-10 col-md-9">
                                        <input type="text" class="form-control" id="name" name="signs"
                                               placeholder="{{trans('messages.signs')}}"
                                               value={{ auth()->user()->signs}}>
                                    </div>
                                    @error('signs')<span style="color: #e81414;">{{ $message }}</span>@enderror

                                </div>




                                {{--                            <div class="form-group mb-4  row ">--}}
                                {{--                                <div class="col-lg-2 col-md-3 d-flex align-items-center">--}}
                                {{--                                    <label>@lang('messages.passport_image')</label>--}}
                                {{--                                </div>--}}
                                {{--                                <div class="col-lg-8 col-sm-12 d-flex align-items-center">--}}
                                {{--                                    <input type="file" class="form-control " name="passport_image" accept="image/*" onchange="readURL(this)" />--}}
                                {{--                                </div>--}}
                                {{--                                <div class="col-lg-2 col-sm-12 d-flex align-items-center">--}}
                                {{--                                    <img  id="img-preview" style="width: 180px ; hight:50px" src="https://ami-sni.com/wp-content/themes/consultix/images/no-image-found-360x250.png" width="250px" />--}}
                                {{--                                </div>--}}
                                {{--                            </div>--}}




                                {{--                                <div class="form-group mb-4 row">--}}
                                {{--                                    <div class="col-lg-2 col-md-3 d-flex align-items-center">--}}
                                {{--                                        <label for="block" class="form-label"> @lang('messages.passport_image')</label>--}}
                                {{--                                    </div>--}}
                                {{--                                    <div class="col-lg-10 col-md-9">--}}
                                {{--                                        <input type="file" class="form-control image " name="passport_image">--}}

                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                {{--                                <div class="form-group">--}}
                                {{--                                    <img src=" {{auth()->user()->passport_image_path}} " width=" 100px "--}}
                                {{--                                         value="{{auth()->user()->passport_image_path}}"--}}
                                {{--                                         class="thumbnail image-preview">--}}
                                {{--                                </div>--}}




                                <div class="form-group mb-4  row ">
                                    <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                        <label>@lang('messages.identity')</label>
                                    </div>
                                    <div class="col-lg-8 col-sm-12 d-flex align-items-center">
                                        <input type="file" class="form-control passport_image"
                                               name="passport_image" accept="image/*"
                                               onchange="readURL3(this)"/>
                                    </div>
                                    <div class="col-lg-2 col-sm-12 d-flex align-items-center">
                                        <img id="img-preview3" style="width: 180px ; height:90px"
                                             src="{{ auth()->user()->passport_image_path}}" width="250px"/>
                                    </div>
                                    @error('passport_image')<span style="color: #e81414;">{{ $message }}</span>@enderror

                                </div>

                            @endif


                            <button type="submit" class="btn btn-primary submit-btn">اضافة</button>
                        </div>
                    </form>
                </div>
            </div>


            @if(auth()->user()->is_company=='person')
                @include('front.user.add_address_form')
            @endif

        </div>
    </section>
@stop

@push('scripts')


    @include('front.user.parts.script_edit')
    @include('front.user.parts.add_location_map')
    {{--    @include('front.layouts.parts.map')--}}
    {{--    @include('front.auth.ajax_get_cities')--}}

@endpush