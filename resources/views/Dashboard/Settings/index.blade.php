@extends('Dashboard.layouts.master')
@section('title', trans('back.settings'))
@section('style')
    <style> #map { height: 400px;} </style>
@endsection
@section('breadcrumb')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')
                </a></li>
            <li class="active">@lang('messages.settings.settings')</li>
        </ul>
        @include('Dashboard.layouts.parts.quick-links')
    </div>
@endsection

@section('content')
    @include('Dashboard.layouts.parts.validation_errors')

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;">
                <div class="panel-heading">
                    <!-- Basic layout-->
                    <div class="card">
                        <div class="card-header header-elements-inline">
                            <h5 class="card-title">{{ trans('messages.settings.general_settings') }}</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('settings.update') }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group row">
                                    <label
                                        class="col-form-label col-lg-4">{{ trans('messages.settings.project_name_ar') }}
                                        :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="project_name_ar"
                                               value="{{ settings('project_name_ar') }}" class="form-control"
                                               placeholder="{{ trans('messages.settings.project_name_ar') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-form-label col-lg-4">{{ trans('messages.settings.project_name_en') }}
                                        :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="project_name_en"
                                               value="{{ settings('project_name_en') }}" class="form-control"
                                               placeholder="{{ trans('messages.settings.project_name_en') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-4">{{ trans('messages.settings.mobile') }}
                                        :</label>
                                    <div class="col-lg-8">
                                        <input type="phone" name="mobile" value="{{ settings('mobile') }}"
                                               class="form-control"
                                               placeholder="{{ trans('messages.settings.mobile') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-4">{{ trans('messages.settings.email') }}
                                        :</label>
                                    <div class="col-lg-8">
                                        <input type="email" name="email" value="{{ settings('email') }}"
                                               class="form-control"
                                               placeholder="{{ trans('messages.settings.email') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-lg-4">{{ trans('messages.settings.fax') }}
                                        :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="fax" value="{{ settings('fax') }}" class="form-control"
                                               placeholder="{{ trans('messages.settings.fax') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-4">{{ trans('messages.settings.address') }}
                                        :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="address" value="{{ settings('address') }}"
                                               class="form-control"
                                               placeholder="{{ trans('messages.settings.address') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-lg-4">{{ trans('messages.settings.location_on_google_maps') }}:</label>

                                        <div class="col-lg-12">
{{--                                            <input id="searchInput" class=" form-control"   style="background-color: #FFF;margin-left: -150px;" placeholder=" اختر المكان علي الخريطة " name="other">--}}
                                            <div id="map"></div>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" id="geo_lat" name="latitude" value="{{ settings('latitude') }}"
                                                   readonly="" placeholder="latitude" class="form-control">
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" id="geo_lng" name="longitude" value="{{ settings('longitude') }}"
                                                   readonly="" placeholder="longitude" class="form-control">
                                        </div>
                                </div>
                                <legend class="font-weight-semibold text-uppercase font-size-sm"></legend>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success"><i
                                            class="icon-paperplane mr-2"></i>{{ trans('messages.buttons.submit_back_to_list') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /basic layout -->
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;">
                <div class="panel-heading">
                    <!-- Basic layout-->
                    <div class="card">
                        <div class="card-header header-elements-inline">
                            <h5 class="card-title">{{ trans('messages.settings.social_settings') }}</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('settings.update') }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-4">{{ trans('messages.settings.facebook_url') }}
                                        :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="facebook_url" value="{{ settings('facebook_url') }}"
                                               class="form-control"
                                               placeholder="{{ trans('messages.settings.facebook_url') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-4">{{ trans('messages.settings.twitter_url') }}
                                        :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="twitter_url" value="{{ settings('twitter_url') }}"
                                               class="form-control"
                                               placeholder="{{ trans('messages.settings.twitter_url') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-4">{{ trans('messages.settings.youtube_url') }}
                                        :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="youtube_url" value="{{ settings('youtube_url') }}"
                                               class="form-control"
                                               placeholder="{{ trans('messages.settings.youtube_url') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-form-label col-lg-4">{{ trans('messages.settings.instagram_url') }}
                                        :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="instagram_url" value="{{ settings('instagram_url') }}"
                                               class="form-control"
                                               placeholder="{{ trans('messages.settings.instagram_url') }}">
                                    </div>
                                </div>
                                <legend class="font-weight-semibold text-uppercase font-size-sm"></legend>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success"><i
                                            class="icon-paperplane mr-2"></i>{{ trans('messages.buttons.submit_back_to_list') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /basic layout -->
                </div>
            </div>
        </div>
    </div>

{{--//bank--}}
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;">
                <div class="panel-heading">
                    <!-- Basic layout-->
                    <div class="card">
                        <div class="card-header header-elements-inline">
                            <h5 class="card-title">{{ trans('messages.settings.bank_settings') }}</h5><br><br>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('settings.update') }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                                <div class="form-group row">
                                    <label class="col-form-label col-lg-4">{{ trans('messages.settings.bank_name_ar') }}
                                        :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="bank_name_ar" value="{{ settings('bank_name_ar') }}"
                                               class="form-control"
                                               placeholder="{{ trans('messages.settings.bank_name_ar') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-lg-4">{{ trans('messages.settings.bank_name_en') }}
                                        :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="bank_name_en" value="{{ settings('bank_name_en') }}"
                                               class="form-control"
                                               placeholder="{{ trans('messages.settings.bank_name_en') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-4">{{ trans('messages.settings.account_name') }}
                                        :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="account_name" value="{{ settings('account_name') }}"
                                               class="form-control"
                                               placeholder="{{ trans('messages.settings.account_name') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-4">{{ trans('messages.settings.account_number') }}
                                        :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="account_number" value="{{ settings('account_number') }}"
                                               class="form-control"
                                               placeholder="{{ trans('messages.settings.account_number') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-4">{{ trans('messages.settings.iban') }}
                                        :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="iban" value="{{ settings('iban') }}"
                                               class="form-control" placeholder="{{ trans('messages.settings.iban') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-4">{{ trans('messages.settings.branch') }}
                                        :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="branch" value="{{ settings('branch') }}"
                                               class="form-control" placeholder="{{ trans('messages.settings.branch') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-4">{{ trans('messages.swift_code') }}
                                        :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="swift_code" value="{{ settings('swift_code') }}"
                                               class="form-control" placeholder="{{ trans('messages.swift_code') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-4">{{ trans('messages.routing_number') }}
                                        :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="routing_number" value="{{ settings('routing_number') }}"
                                               class="form-control" placeholder="{{ trans('messages.routing_number') }}">
                                    </div>
                                </div>


                                <legend class="font-weight-semibold text-uppercase font-size-sm"></legend>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success"><i
                                            class="icon-paperplane mr-2"></i>{{ trans('messages.buttons.submit_back_to_list') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /basic layout -->
                </div>
            </div>
        </div>
    </div>





    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;">
                <div class="panel-heading">

                    <!-- Basic layout-->
                    <div class="card">
                        <div class="card-header header-elements-inline">
                            <h5 class="card-title">{{ trans('messages.settings.quote') }}</h5>
                        </div>
                        <br>
                        <div class="card-body">
                            <form action="{{ route('settings.update') }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-3">{{ trans('messages.settings.quote_name_ar') }}:</label><br>
                                    <div class="col-lg-9">
                                                <textarea rows="4" cols="4" name="quote_name_ar" class="form-control"
                                                          placeholder="{{ trans('messages.settings.quote_name_ar') }}">{{ settings('quote_name_ar') }}
                                                </textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-3">{{ trans('messages.settings.quote_name_en') }}:</label><br>
                                    <div class="col-lg-9">
                                                <textarea rows="4" cols="4" name="quote_name_en" class="form-control"
                                                          placeholder="{{ trans('messages.settings.quote_name_en') }}">{{ settings('quote_name_en') }}
                                                </textarea>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success"><i
                                            class="icon-paperplane mr-2"></i>{{ trans('messages.buttons.submit_back_to_list') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /basic layout -->

                </div>
            </div>
        </div>

    </div>



    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;">
                <div class="panel-heading">

                    <!-- Basic layout-->
                    <div class="card">
                        <div class="card-header header-elements-inline">
                            <h5 class="card-title">{{ trans('messages.settings.description') }}</h5>
                        </div>
                        <br>
                        <div class="card-body">
                            <form action="{{ route('settings.update') }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-3">{{ trans('messages.settings.app_description_ar') }}:</label><br>
                                    <div class="col-lg-9">
                                                <textarea rows="4" cols="4" name="app_description_ar" class="form-control"
                                                          placeholder="{{ trans('messages.settings.app_description_ar') }}">{{ settings('app_description_ar') }}
                                                </textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-3">{{ trans('messages.settings.app_description_en') }}:</label><br>
                                    <div class="col-lg-9">
                                                <textarea rows="4" cols="4" name="app_description_en" class="form-control"
                                                          placeholder="{{ trans('messages.settings.app_description_en') }}">{{ settings('app_description_en') }}
                                                </textarea>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success"><i
                                            class="icon-paperplane mr-2"></i>{{ trans('messages.buttons.submit_back_to_list') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /basic layout -->

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;">
                <div class="panel-heading">
                    <!-- Basic layout-->
                    <div class="card">
                        <div class="card-header header-elements-inline">
                            <h5 class="card-title">{{ trans('messages.settings.online_payment') }}</h5>
                        </div>
                        <br>
                        <div class="card-body">
                            <form action="{{ route('settings.update') }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-3">{{ trans('messages.settings.online_payment_conditions_ar') }}:</label><br>
                                    <div class="col-lg-9">
                                                <textarea rows="4" cols="4" name="online_payment_conditions_ar" class="form-control"
                                                          placeholder="{{ trans('messages.settings.online_payment_conditions_ar') }}">{{ settings('online_payment_conditions_ar') }}
                                                          placeholder="{{ trans('messages.settings.online_payment_conditions_ar') }}">{{ settings('online_payment_conditions_ar') }}
                                                </textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-3">{{ trans('messages.settings.online_payment_conditions_en') }}:</label><br>
                                    <div class="col-lg-9">
                                                <textarea rows="4" cols="4" name="online_payment_conditions_en" class="form-control"
                                                          placeholder="{{ trans('messages.settings.online_payment_conditions_en') }}">{{ settings('online_payment_conditions_en') }}
                                                </textarea>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success"><i
                                            class="icon-paperplane mr-2"></i>{{ trans('messages.buttons.submit_back_to_list') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /basic layout -->

                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-12">
                    <!-- Basic layout-->
                    <div class="card">
                        <div class="card-header header-elements-inline">
                            <h5 class="card-title">{{ trans('messages.settings.about_app_settings') }}</h5>
                        </div><br>
                        <div class="card-body">
                            <form action="{{ route('settings.update') }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-3">{{ trans('messages.settings.about_app_ar') }}
                                        :</label>
                                    <div class="col-lg-9">
                                                <textarea rows="5" cols="5" name="about_app_ar" class="form-control"
                                                          placeholder="{{ trans('messages.settings.about_app_ar') }}">{{ settings('about_app_ar') }}
                                                </textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-3">{{ trans('messages.settings.about_app_en') }}
                                        :</label>
                                    <div class="col-lg-9">
                                                <textarea rows="5" cols="5" name="about_app_en" class="form-control"
                                                          placeholder="{{ trans('messages.settings.about_app_en') }}">{{ settings('about_app_en') }}
                                                </textarea>
                                    </div>
                                </div>
                                <legend class="font-weight-semibold text-uppercase font-size-sm"></legend>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success"><i
                                            class="icon-paperplane mr-2"></i>{{ trans('messages.buttons.submit_back_to_list') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /basic layout -->
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-12">
                    <!-- Basic layout-->
                    <div class="card">
                        <div class="card-header header-elements-inline">
                            <h5 class="card-title">{{ trans('messages.settings.conditions_app_settings') }}</h5>
                        </div><br>
                        <div class="card-body">
                            <form action="{{ route('settings.update') }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group row" >
                                    <label class="col-form-label col-lg-3">{{ trans('messages.settings.conditions_terms_ar') }}
                                        :</label>
                                    <div class="col-lg-9">
{{--                                        <textarea type="text" style="resize: vertical;" rows="8" class="form-control"id="conditions_terms_ar" name="conditions_terms_ar">{{ settings('conditions_terms_ar') }}</textarea>--}}

                                      <textarea rows="5" cols="5" name="conditions_terms_ar" class="  form-control "
                                                  placeholder="{{ trans('messages.settings.conditions_terms_ar') }}">{{ settings('conditions_terms_ar') }}
                                        </textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-form-label col-lg-3">{{ trans('messages.settings.conditions_terms_en') }}
                                        :</label>
                                    <div class="col-lg-9">
                                                <textarea rows="5" cols="5" name="conditions_terms_en"
                                                          class="form-control"
                                                          placeholder="{{ trans('messages.settings.conditions_terms_en') }}">{{ settings('conditions_terms_en') }}
                                                </textarea>
                                    </div>
                                </div>
                                <legend class="font-weight-semibold text-uppercase font-size-sm"></legend>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success"><i
                                            class="icon-paperplane mr-2"></i>{{ trans('messages.buttons.submit_back_to_list') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /basic layout -->
                </div>
            </div>
        </div>
    </div>

@stop

@section('scripts')
    <script>
        CKEDITOR.replace('conditions_terms_ar', { height: '400px' });
        CKEDITOR.replace('conditions_terms_en', { height: '400px' });
        CKEDITOR.replace('about_app_ar', { height: '300px' });
        CKEDITOR.replace('about_app_en', { height: '300px' });
        {{--CKEDITOR.instances.about_app_ar.setData(`{!! isset($setting) ? $setting->value : '' !!}`);--}}
    </script>
    @include('Dashboard.Settings.app_location_map')
@stop


