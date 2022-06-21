@extends('front.layouts.master')
@section('title', trans('messages.my_profile'))
@section('style')
    <style>
        #map {height: 400px;}
    </style>
@endsection

@section('content')
    <section class="my-profile-page edit-profile" dir="{{ direction() }}">
        <div class="container">
            @include('front.layouts.parts.alert')
                <div class=" d-flex justify-content-between">
                    <div class="add-auction btn "><b>
                        </b>{{ trans('messages.additional_address') }}:
                    </div>
                </div>
                <div class="row">
                    <div class="edit-form">
                        <form action="{{route('front.add_address')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="inputs-group">
                                <div class="form-group mb-4 row">
                                    <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                        <label for="block" class="form-label"> {{trans('messages.block')}}</label>
                                    </div>
                                    <div class="col-lg-10 col-md-9">
                                        <input type="text" class="form-control" id="name" name="block"
                                               placeholder="{{trans('messages.block')}}" value="">
                                    </div>
                                    @error('block')<span style="color: #e81414;">{{ $message }}</span>@enderror

                                </div>
                                <div class="form-group mb-4 row">
                                    <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                        <label for="block" class="form-label"> {{trans('messages.street')}}</label>
                                    </div>
                                    <div class="col-lg-10 col-md-9">
                                        <input type="text" class="form-control" id="name" name="street"
                                               placeholder="{{trans('messages.street')}}" value="">
                                    </div>
                                    @error('street')<span style="color: #e81414;">{{ $message }}</span>@enderror

                                </div>
                                <div class="form-group mb-4 row">
                                    <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                        <label for="block" class="form-label"> {{trans('messages.block_num')}}</label>
                                    </div>
                                    <div class="col-lg-10 col-md-9">
                                        <input type="text" class="form-control" id="name" name="block_num"
                                               placeholder="{{trans('messages.block_num')}}" value="">
                                    </div>
                                    @error('block_num')<span style="color: #e81414;">{{ $message }}</span>@enderror

                                </div>
                                <div class="form-group mb-4 row">
                                    <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                        <label for="block" class="form-label"> {{trans('messages.signs')}}</label>
                                    </div>
                                    <div class="col-lg-10 col-md-9">
                                        <input type="text" class="form-control" id="name" name="signs"
                                               placeholder="{{trans('messages.signs')}}" value="">
                                    </div>
                                    @error('signs')<span style="color: #e81414;">{{ $message }}</span>@enderror

                                </div>
                                <div class="form-group mb-4 row">

                                    <label>@lang('messages.user_location_on_map'):</label>
                                    <div class="col-lg-12">
                                        <div id="map"></div>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" id="geo_lat" name="latitude" readonly=""
                                               placeholder=" latitude"
                                               class="form-control hidden d-none">
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" id="geo_lng" name="longitude" readonly=""
                                               placeholder="longitude"
                                               class="form-control hidden d-none">
                                    </div>
                                    @error('latitude')<span style="color: #e81414;">{{ $message }}</span>@enderror
                                </div>
                                <button type="submit" class="btn btn-primary submit-btn">{{__('messages.add')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
    </section>
@stop

@push('scripts')
    @include('front.user.parts.add_location_map')
@endpush
