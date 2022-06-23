@extends('Dashboard.layouts.master')
@section('title', trans('messages.edit-var',['var'=>trans('messages.company.company')]))
@section('style')
    <style> #map { height: 400px;} </style>
@endsection
@section('breadcrumb')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')</a>
            </li>
            <li><a href="{{ route('companies.index') }}"><i
                        class="icon-admin position-left"></i> @lang('messages.company.companies')</a></li>
            <li class="active">@lang('messages.edit-var',['var'=>trans('messages.company.company')])</li>
        </ul>

        @include('Dashboard.layouts.parts.quick-links')
    </div>
@endsection
@section('content')
    @include('Dashboard.layouts.parts.validation_errors')
    <div class="row" style="padding: 15px;">
        <div class="col-md-9">
            <!-- Basic layout-->
            <form action="{{ route('companies.update',$company) }}" class="form-horizontal" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="company_id" value="{{$company->id}}"/>
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">{{ trans('messages.company.edit') }} </h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                                <li><a data-action="close"></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">

                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label>@lang('messages.company.image')</label>
                                    <input type="file" class="form-control image" name="image">
                                </div>
                                <div class="col-lg-6">
                                    <img src=" {{$company->image_path}} " width=" 100px " value="{{$company->image_path}}"
                                         class="thumbnail image-preview">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">{{ trans('messages.company.user_name') }}</label>
                            <div class="col-lg-9">
                                <input type="text" name="user_name" value="{{ $company->user_name }}" class="form-control"
                                       placeholder="{{ trans('messages.user_name') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">{{ trans('messages.email') }}</label>
                            <div class="col-lg-9">
                                <input type="email" name="email" class="form-control" value="{{ $company->email }}"
                                       placeholder="{{ trans('messages.email') }}" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">{{ trans('messages.mobile') }}</label>
                            <div class="col-lg-9">
                                <input type="text" name="mobile" value="{{ $company->mobile }}" class="form-control"
                                       placeholder="{{ trans('messages.mobile') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">{{ trans('messages.P_O_Box') }}</label>
                            <div class="col-lg-9">
                                <input type="text" name="P_O_Box" value="{{ $company->P_O_Box }}" class="form-control"
                                       placeholder="{{ trans('messages.P_O_Box') }}">
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="col-lg-3 control-label display-block"> {{ trans('messages.nationality.nationality') }} </label>
                            <div class="col-lg-9">
                                <select name="nationality_id" class="select form-control">
                                    <option selected disabled>{{trans('messages.select')}}</option>
                                    @foreach ($nationalities as $nationality)
                                        <option {{ $company->nationality_id == $nationality->id ? 'selected' : '' }}
                                            value="{{ $nationality->id }}"> {{ $nationality->$name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label display-block"> {{ trans('messages.country.country') }} </label>
                            <div class="col-lg-9">
                                <select name="country_id" class="select form-control"  id="country">
                                    <option selected disabled>{{trans('messages.select')}}</option>
                                    @foreach ($countries as $country)

                                        <option  {{ $company->country_id == $country->id ? 'selected' : '' }}
                                            value="{{ $country->id }}"> {{ $country->$name }}

                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label display-block"> {{ trans('messages.city_name') }} </label>
                            <div class="col-lg-9">
                                <select name="city_id" class="select form-control"  id="cities">
                                    <option selected disabled>{{trans('messages.select')}}</option>
                                    @foreach ($cities as $city)
                                        <option {{ $company->city_id == $city->id ? 'selected' : '' }}
                                            value="{{ $city->id }}"> {{ $city->$name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">

                            <label>@lang('messages.commercial_register_image')</label>
                            <input type="file" class="form-control commercial_register_image" name="commercial_register_image">
                            <img src=" {{$company->commercial_register_image_path}} " width=" 100px " value="{{$company->commercial_register_image_path}}"
                                 class="thumbnail image-preview2">

                            <label>@lang('messages.company.company_authorization_image')</label>
                            <input type="file" class="form-control company_authorization_image" name="company_authorization_image">
                            <img src=" {{$company->company_authorization_image_path}} " width=" 100px " value="{{$company->company_authorization_image_path}}"
                                 class="thumbnail image-preview1">
                        </div>
                        <div class="form-group">
                            <label>@lang('messages.company.location'):</label>
                            <div class="col-lg-12">
                                {{--                                        <input id="searchInput" class=" form-control"   style="background-color: #FFF;margin-left: -150px;" placeholder=" اختر المكان علي الخريطة " name="other">--}}
                                <div id="map"></div>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" id="geo_lat" name="latitude" readonly=""
                                       value="{{isset($company->latitude)?$company->latitude:'24.7135517'}}"
                                       placeholder=" latitude" class="form-control">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" id="geo_lng" name="longitude" readonly=""
                                       value="{{isset($company->longitude)?$company->longitude:'24.7135517'}}"
                                       placeholder="longitude" class="form-control">
                            </div>
                        </div>

                        <div class="text-right">
                            <input type="submit" class="btn btn-success"
                                   value=" {{ trans('messages.update_and_come_back') }} "/>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /basic layout -->
        </div>
    </div>
@stop

@section('scripts')
    @include('front.auth.ajax_get_cities')
    @include('Dashboard.layouts.parts.edit_location_map')

    <script>

// ======== image preview ====== //
        $(".company_authorization_image").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.image-preview1').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
// ====================================

        $(".commercial_register_image").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.image-preview2').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

    </script>
@stop
