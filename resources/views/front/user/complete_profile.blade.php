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
    <section class="my-profile-page edit-profile" dir="{{ direction() }}">

        <div class="container">
            <h5 class="title">
                <a href="{{ route('front.my_profile') }}" class="mt-2 mx-1 back"> <i class="fal fa-arrow-circle-{{ floating('right','left') }}" style="color: black;"></i> </a>
                {{ trans('messages.my_profile') }}</h5>
            @include('front.layouts.parts.alert')


            @if(auth()->user()->is_completed==0)
                <h3>(Not completed) {{ trans('messages.please_complete_your_data')}}  </h3>
            @endif


            <div class="row">
                <div class="edit-form">
                    <form action="{{route('front.complete_profile')}}" method="post"  id="submitted-form"  enctype="multipart/form-data">
                        @csrf
                        <div class="inputs-group">
                            @if(auth()->user()->is_company =='person')
                              <input type="hidden" name="is_company" value="person"/>
                            @endif
                            <h5 class="group-title">{{ trans('messages.user.complete_data')}}</h5>
                            <div class="form-group mb-4 row">
                                <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                    <label for="full_name"
                                           class="form-label"> {{ trans('messages.nationality.nationality') }}</label>
                                </div>
                                <div class="col-lg-10 col-md-9" >
                                    <select class=" select form-select form-control" name="nationality_id"
                                            aria-label="Default select example" >
                                        <option selected
                                                disabled>{{ isset(auth()->user()->nationality)? auth()->user()->nationality->$name :  trans('messages.select') }}
                                        </option>
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
{{--                                           value={{ auth()->user()->P_O_Box}}>--}}
                                    value={{ isset(auth()->user()->P_O_Box)?auth()->user()->P_O_Box: old('P_O_Box')}}>

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
{{--                                               value={{ auth()->user()->street}}>--}}
                                        value={{ isset(auth()->user()->street)?auth()->user()->street: old('street')}}>

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
{{--                                               value={{ auth()->user()->block_num}}>--}}
                                        value={{ isset(auth()->user()->block_num)?auth()->user()->block_num: old('block_num')}}>

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
{{--                                               value={{ auth()->user()->signs}}>--}}
                                        value={{ isset(auth()->user()->signs)?auth()->user()->signs: old('signs')}}>

                                    </div>
                                    @error('signs')<span style="color: #e81414;">{{ $message }}</span>@enderror

                                </div>
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

                                    <div class="form-group">
                                        <label>{{trans('messages.user_location_on_map')}}:</label>
                                        <div class="col-lg-12">
                                            <div id="map"></div>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" id="geo_lat" name="latitude"
                                                   value=""
                                                   readonly="" placeholder=" latitude" class="form-control hidden d-none">
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" id="geo_lng" name="longitude"
                                                   value=""
                                                   readonly="" placeholder="longitude" class="form-control hidden d-none">
                                        </div>
                                        @error('latitude')<span style="color: #e81414;">{{ $message }}</span>@enderror

                                    </div>
                            @endif
                                <button type="submit" id="save-form-btn" class="btn btn-primary submit-btn">{{__(trans('messages.send'))}}</button>

{{--                                <button type="submit" class="btn btn-primary submit-btn">{{__(trans('messages.send'))}}</button>--}}
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
@endpush
