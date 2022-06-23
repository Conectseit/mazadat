@extends('Dashboard.layouts.master')
@section('title', trans('messages.create-var',['var'=>trans('messages.company.company')]))
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
            <li class="active">@lang('messages.create-var',['var'=>trans('messages.company.company')])</li>
        </ul>
        @include('Dashboard.layouts.parts.quick-links')
    </div>
@endsection

@section('content')

    @include('Dashboard.layouts.parts.validation_errors')

    <div class="row" style="padding: 15px;">
        <div class="col-md-7">

            <!-- Basic layout-->
            <form action="{{ route('companies.store') }}" class="form-horizontal" method="post"
                  id="submitted-form" enctype="multipart/form-data">
                @csrf
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ trans('messages.company.add_new_company') }}</h3>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                                <li><a data-action="close"></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="box-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>@lang('messages.company.image'):</label>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="file" class="form-control image " name="image">
                                        <img src=" {{ asset('uploads/default.png') }} " width="100px" class="thumbnail image-preview">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">{{ trans('messages.company.user_name') }}</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" value="" name="user_name" placeholder="@lang('messages.company.user_name') ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">{{ trans('messages.email') }}</label>
                                <div class="col-lg-9">
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                           placeholder="{{ trans('messages.email') }}">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-lg-3 control-label display-block"> {{ trans('messages.mobile') }} </label>
                                <div class="col-lg-5">
                                    <select name="country_id" class="select form-control"  id="country">
                                        <option selected disabled>{{trans('messages.choose_country_code')}}</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}"> {{ $country->$name }}{{ $country->phone_code }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <input type="text" maxlength="9" name="mobile" value="{{ old('mobile') }}" class="form-control"
                                           placeholder="{{trans('messages.enter_mobile')}}5xx xxx xxx">
                                </div>
                            </div>
{{--                            <div class="form-group">--}}
{{--                                <label class="col-lg-3 control-label">{{ trans('messages.mobile') }}</label>--}}
{{--                                <div class="col-lg-9">--}}
{{--                                    <input type="text" name="mobile"  maxlength="14" value="{{ old('mobile') }}" class="form-control"--}}
{{--                                           placeholder="{{ trans('messages.mobile') }}">--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="form-group">
                                <label class="col-lg-3 control-label">{{ trans('messages.P_O_Box') }}</label>
                                <div class="col-lg-9">
                                    <input type="text" name="P_O_Box" value="{{ old('P_O_Box') }}" class="form-control"
                                           placeholder="{{ trans('messages.P_O_Box') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label"> {{ trans('messages.password') }} </label>
                                <div class="col-lg-9">
                                    <input type="password" class="form-control" name="password"
                                           placeholder=" {{ trans('messages.password') }} "/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label"> {{ trans('messages.confirm_password') }} </label>
                                <div class="col-lg-9">
                                    <input type="password" class="form-control" name="password_confirmation"
                                           placeholder=" {{ trans('messages.confirm_password') }} "/>
                                    <p class="text-pink">  {{trans('messages.pass_terms')}}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label display-block"> {{ trans('messages.nationality.nationality') }} </label>
                                <div class="col-lg-9">
                                    <select name="nationality_id" class="select form-control">
                                        <option selected disabled>{{trans('messages.select')}}</option>
                                        @foreach ($nationalities as $nationality)
                                            <option value="{{ $nationality->id }}"> {{ $nationality->$name }} </option>
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
                                            <option value="{{ $city->id }}"> {{ $city->$name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>@lang('messages.company.company_authorization_image')</label>
                                        <input type="file" class="form-control  company_authorization_image" name="company_authorization_image">

                                    </div>
                                    <div class="col-lg-6">
                                        <img src=" {{ asset('uploads/default.png') }} " width="100px" class="thumbnail image-preview1">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>@lang('messages.commercial_register_image')</label>
                                        <input type="file" class="form-control commercial_register_image" name="commercial_register_image">
                                    </div>
                                    <div class="col-lg-6">
                                        <img src=" {{ asset('uploads/default.png') }} " width="100px" class="thumbnail image-preview2">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                    <label>@lang('messages.company.location'):</label>
                                    <div class="col-lg-12">
                                        {{--                                        <input id="searchInput" class=" form-control"   style="background-color: #FFF;margin-left: -150px;" placeholder=" اختر المكان علي الخريطة " name="other">--}}
                                        <div id="map"></div>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" id="geo_lat" name="latitude" readonly="" placeholder=" latitude" class="form-control">
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" id="geo_lng" name="longitude" readonly="" placeholder="longitude" class="form-control">
                                    </div>
                                </div>


                        </div>
                    </div>
                    <div class="text-right" style="padding-bottom: 10px; padding-left: 10px;">
                        <input type="submit" class="btn btn-primary"   id="save-form-btn" value=" {{ trans('messages.add_and_forward_to_list') }} "/>
                    </div>
                </div>
            </form>
            <!-- /basic layout -->
        </div>


        <div class="col-md-5">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title"> {{ trans('messages.company.latest_companies') }} </h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">
                    <table class="table table-bordered table-hover">
                        <tr class="text-center">
                            <th> {{ trans('messages.company.image') }} </th>
                            <th> {{ trans('messages.company.user_name') }} </th>
                        </tr>
                        @forelse($latest_companies as $company)
                            <tr>
                                <td class="text-center">
                                    <a href="{{ $company->image_path }}" data-popup="lightbox"><img src="{{ $company->image_path }}" alt="" width="80" height="80" class="img-circle"></a>
                                </td>
                                <td>{{ $company->user_name }}</td>
                            </tr>
                        @empty
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>


@stop
@section('scripts')
    @include('front.auth.ajax_get_cities')
    @include('Dashboard.layouts.parts.map')

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
// ====================================
        });

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


