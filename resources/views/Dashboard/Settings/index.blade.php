@extends('Dashboard.layouts.master')
@section('title', trans('back.settings'))
@section('content')

    <!-- Page header -->
    <div class="page-header page-header-default">
        @section('breadcrumb')
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')</a></li>
                <li class="active">@lang('messages.settings.settings')</li>
            </ul>
            @include('Dashboard.layouts.parts.quick-links')
        </div>
        @endsection
    </div>
    <!-- /page header -->

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
                                    <label class="col-form-label col-lg-4">{{ trans('messages.settings.project_name_ar') }}:</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="project_name_ar"
                                               value="{{ settings('project_name_ar') }}" class="form-control"
                                               placeholder="{{ trans('messages.settings.project_name_ar') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-4">{{ trans('messages.settings.project_name_en') }}:</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="project_name_en"
                                               value="{{ settings('project_name_en') }}" class="form-control"
                                               placeholder="{{ trans('messages.settings.project_name_en') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-4">{{ trans('messages.settings.mobile') }}:</label>
                                    <div class="col-lg-8">
                                        <input type="phone" name="mobile" value="{{ settings('mobile') }}" class="form-control"
                                               placeholder="{{ trans('messages.settings.mobile') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-4">{{ trans('messages.settings.email') }} :</label>
                                    <div class="col-lg-8">
                                        <input type="email" name="email" value="{{ settings('email') }}" class="form-control" placeholder="{{ trans('messages.settings.email') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-lg-4">{{ trans('messages.settings.fax') }} :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="fax" value="{{ settings('fax') }}" class="form-control" placeholder="{{ trans('messages.settings.fax') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-4">{{ trans('messages.settings.address') }} :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="address" value="{{ settings('address') }}" class="form-control" placeholder="{{ trans('messages.settings.address') }}">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-form-label col-lg-4">{{ trans('messages.settings.account_name') }} :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="account_name" value="{{ settings('account_name') }}" class="form-control" placeholder="{{ trans('messages.settings.account_name') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-4">{{ trans('messages.settings.bank_name') }} :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="bank_name" value="{{ settings('bank_name') }}" class="form-control" placeholder="{{ trans('messages.settings.bank_name') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-4">{{ trans('messages.settings.iban') }} :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="iban" value="{{ settings('iban') }}" class="form-control" placeholder="{{ trans('messages.settings.iban') }}">
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
                                            <label class="col-form-label col-lg-4">{{ trans('messages.settings.facebook_url') }}:</label>
                                            <div class="col-lg-8">
                                                <input type="text" name="facebook_url" value="{{ settings('facebook_url') }}"
                                                       class="form-control"
                                                       placeholder="{{ trans('messages.settings.facebook_url') }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-4">{{ trans('messages.settings.twitter_url') }}:</label>
                                            <div class="col-lg-8">
                                                <input type="text" name="twitter_url" value="{{ settings('twitter_url') }}"
                                                       class="form-control"
                                                       placeholder="{{ trans('messages.settings.twitter_url') }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-4">{{ trans('messages.settings.youtube_url') }}:</label>
                                            <div class="col-lg-8">
                                                <input type="text" name="youtube_url" value="{{ settings('youtube_url') }}"
                                                       class="form-control"
                                                       placeholder="{{ trans('messages.settings.youtube_url') }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-4">{{ trans('messages.settings.instagram_url') }}:</label>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Basic layout-->
                                    <div class="card">
                                        <div class="card-header header-elements-inline">
                                            <h5 class="card-title">{{ trans('messages.settings.auction_settings') }} :</h5>
                                        </div><br>
                                        <div class="card-body">
                                            <form action="{{ route('settings.update') }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('PUT') }}
                                                <div class="form-group row">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class="col-form-label col-lg-4">{{ trans('messages.settings.min_duration_of_auction') }} :</label>
                                                            <div class="col-lg-8">
                                                                <input type="number" name="min_duration_of_auction" value="{{ settings('min_duration_of_auction') }}" class="form-control" placeholder="{{ trans('messages.settings.min_duration_of_auction') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{--                                                <label class="col-lg-3 control-label">{{ trans('messages.min_time_unit') }}</label>--}}
                                                            <div class="col-lg-9">
                                                                <select name=" min_time_unit" class="select-border-color border-warning">
                                                                    <option value="hour">{{trans('messages.settings.hour')}}</option>
                                                                    <option value="day">{{trans('messages.settings.day')}}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class="col-form-label col-lg-4">{{ trans('messages.settings.max_duration_of_auction') }} :</label>
                                                            <div class="col-lg-8">
                                                                <input type="number" name="max_duration_of_auction" value="{{ settings('max_duration_of_auction') }}" class="form-control" placeholder="{{ trans('messages.settings.min_duration_of_auction') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="col-lg-9">
                                                                <select name=" max_time_unit" class="select-border-color border-warning">
                                                                    <option value="day">{{trans('messages.settings.day')}}</option>
                                                                    <option value="hour">{{trans('messages.settings.hour')}}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-form-label col-lg-4">{{ trans('messages.settings.appearance_of_ended_auctions') }} :</label>
                                                    <div class="col-lg-8">
                                                        <select name=" appearance_of_ended_auctions" class="select-border-color border-warning">
                                                            <option value="yes">{{trans('messages.Yes')}}</option>
                                                            <option value="no">{{trans('messages.No')}}</option>
                                                        </select>                                                    </div>
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
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('settings.update') }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-3">{{ trans('messages.settings.about_app_ar') }}:</label>
                                            <div class="col-lg-9">
                                                <textarea rows="5" cols="5" name="about_app_ar" class="form-control"
                                                          placeholder="{{ trans('messages.settings.about_app_ar') }}">{{ settings('about_app_ar') }}
                                                </textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-3">{{ trans('messages.settings.about_app_en') }}:</label>
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
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('settings.update') }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-3">{{ trans('messages.settings.conditions_terms_ar') }}:</label>
                                            <div class="col-lg-9">
                                                <textarea rows="5" cols="5" name="conditions_terms_ar" class="form-control"
                                                          placeholder="{{ trans('messages.settings.conditions_terms_ar') }}">{{ settings('conditions_terms_ar') }}
                                                </textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-3">{{ trans('messages.settings.conditions_terms_en') }}:</label>
                                            <div class="col-lg-9">
                                                <textarea rows="5" cols="5" name="conditions_terms_en" class="form-control"
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




