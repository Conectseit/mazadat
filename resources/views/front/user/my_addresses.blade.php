@extends('front.layouts.master')
@section('title', trans('messages.my_addresses'))
@section('style')
    <style>
        #map {height: 400px;}
        #map1 {height: 400px;}
    </style>
@endsection

@section('content')

    <section class="items" dir="{{ direction() }}">
        <div class="container">
            <h5 class="title">
                <a href="{{ route('front.my_profile') }}" class="mt-2 mx-1 back"> <i
                        class="fal fa-arrow-circle-{{ floating('right','left') }}" style="color: black;"></i> </a>
                {{ trans('messages.my_profile') }}</h5><br>

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#main_address"
                            type="button" role="tab" aria-controls="home"
                            aria-selected="true">{{trans('messages.person.main_address')}}</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#additional_address"
                            type="button" role="tab" aria-controls="profile"
                            aria-selected="false">{{trans('messages.person.additional_addresses')}}</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="main_address" role="tabpanel" aria-labelledby="home-tab">
                    <section class="my-profile-page edit-profile" dir="{{ direction() }}">

                        <div class="container">
                            <div class="row">
                                <div class="edit-form">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="inputs-group">

                                            <div class="form-group mb-4 row">
                                                <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                                    <label for="full_name"
                                                           class="form-label"> {{ trans('messages.nationality.nationality') }}</label>
                                                </div>
                                                <div class="col-lg-10 col-md-9">
                                                    {{isset(auth()->user()->nationality)? auth()->user()->nationality->$name : ''}}
                                                </div>
                                            </div>

                                            <div class="form-group mb-4 row">
                                                <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                                    <label for="city_name"
                                                           class="form-label"> {{ trans('messages.city_name') }}</label>
                                                </div>
                                                <div class="col-lg-10 col-md-9">
                                                    {{isset(auth()->user()->city)? auth()->user()->city->$name : ''}}

                                                </div>
                                            </div>

                                            <div class="form-group mb-4 row">
                                                <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                                    <label for="block"
                                                           class="form-label"> {{trans('messages.P_O_Box')}}</label>
                                                </div>
                                                <div class="col-lg-10 col-md-9">
                                                    {{ auth()->user()->P_O_Box}}
                                                </div>

                                            </div>
                                            @if(auth()->user()->is_company=='person')
                                                <div class="form-group mb-4 row">
                                                    <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                                        <label for="block"
                                                               class="form-label"> {{trans('messages.block')}}</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-9">
                                                        {{ isset(auth()->user()->block)?auth()->user()->block: old('block')}}
                                                    </div>

                                                </div>

                                                <div class="form-group mb-4 row">
                                                    <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                                        <label for="block"
                                                               class="form-label"> {{trans('messages.street')}}</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-9">
                                                        <input type="text" class="form-control"
                                                               value={{ auth()->user()->street}}>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-4 row">
                                                    <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                                        <label for="block"
                                                               class="form-label"> {{trans('messages.block_num')}}</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-9">
                                                        <input type="text" class="form-control"
                                                               value={{ auth()->user()->block_num}}>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-4 row">
                                                    <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                                        <label for="block"
                                                               class="form-label"> {{trans('messages.signs')}}</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-9">
                                                        <input type="text" class="form-control"
                                                               value={{ auth()->user()->signs}}>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-4  row ">
                                                    <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                                        <label>@lang('messages.identity')</label>
                                                    </div>

                                                    <div class="col-lg-2 col-sm-12 d-flex align-items-center">
                                                        <img id="img-preview3" style="width: 180px ; height:90px"
                                                             src="{{ auth()->user()->passport_image_path}}"
                                                             width="250px"/>
                                                    </div>

                                                </div>

                                                <div class="form-group">
                                                    <label>{{trans('messages.user_location_on_map')}}:</label>
                                                    <div class="col-lg-12">
                                                        <div id="map"></div>
                                                        {{--                                                        <iframe id="map" src="https://maps.google.com/maps?q={{auth()->user()->latitude}},{{auth()->user()->longitude}}&hl=es&z=14&output=embed" width="100%" frameborder="0" style="border:0;height: 400px;" allowfullscreen="allowfullscreen"></iframe>--}}
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="tab-pane fade" id="additional_address" role="tabpanel" aria-labelledby="profile-tab"><br>
                    <section class="my-profile-page edit-profile" dir="{{ direction() }}">
                        <div class="container">
                            <div class=" d-flex justify-content-between">
                                <a href="{{ route('front.show_add_address') }}">
                                    <div class="add-auction btn"><b>
                                            <i class="fal fa-plus-circle"></i> </b>{{ trans('messages.add_address') }}:
                                    </div>
                                </a>
                            </div>
                            @foreach($user_addresses as $user_address)
                                <div class="row">
                                    <div class="edit-form">
                                        <form action="" method="post">
                                            <div class="inputs-group">
                                                    <div class="form-group mb-4 row">
                                                        <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                                            <label for="block" class="form-label"> {{trans('messages.block')}}:</label>
                                                        </div>
                                                        <div class="col-lg-10 col-md-9">{{ $user_address->block}}</div>
                                                    </div>
                                                    <div class="form-group mb-4 row">
                                                        <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                                            <label for="block"
                                                                   class="form-label"> {{trans('messages.street')}}:</label>
                                                        </div>
                                                        <div class="col-lg-10 col-md-9">{{ $user_address->street}}:</div>
                                                    </div>
                                                    <div class="form-group mb-4 row">
                                                        <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                                            <label for="block" class="form-label"> {{trans('messages.block_num')}}:</label>
                                                        </div>
                                                        <div class="col-lg-10 col-md-9">{{ $user_address->block_num}}</div>

                                                    </div>
                                                    <div class="form-group mb-4 row">
                                                        <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                                            <label for="block" class="form-label"> {{trans('messages.signs')}}:</label>
                                                        </div>
                                                        <div class="col-lg-10 col-md-9">{{ $user_address->signs}}</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>{{trans('messages.user_location_on_map')}}:</label>
                                                        <div class="col-lg-12">
                                                            <div id="map1"></div>
                                                        </div>
{{--                                                        <div class="col-lg-6">--}}
{{--                                                            <input type="text" id="geo_lat" name="latitude"--}}
{{--                                                                   value="{{$user_address->latitude}}" readonly=""--}}
{{--                                                                   placeholder=" latitude"--}}
{{--                                                                   class="form-control hidden d-none">--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-lg-6">--}}
{{--                                                            <input type="text" id="geo_lng" name="longitude"--}}
{{--                                                                   value="{{$user_address->longitude}}"--}}
{{--                                                                   readonly="" placeholder="longitude"--}}
{{--                                                                   class="form-control hidden d-none">--}}
{{--                                                        </div>--}}

                                                    </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>

@stop

@push('scripts')
    @include('front.user.parts.add_location_map')
@endpush
