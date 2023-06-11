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

    @include('Dashboard.Settings.main_settings')
    @include('Dashboard.Settings.bank_settings')


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
{{--        <div class="col-md-6">--}}
{{--            <div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;">--}}
{{--                <div class="panel-heading">--}}
{{--                    <!-- Basic layout-->--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-body">--}}
{{--                            <form action="{{ route('settings.update') }}" method="POST">--}}
{{--                                {{ csrf_field() }}--}}
{{--                                {{ method_field('PUT') }}--}}
{{--                                <div class="form-group row">--}}
{{--                                    <label class="col-form-label col-lg-4"style="font-size: 17px;">{{ trans('messages.settings.wait_to_verify_new_auction') }}--}}
{{--                                        :</label>--}}
{{--                                    <div class="col-lg-8">--}}
{{--                                        <div  class=" mx-2">--}}

{{--                                            <input type="radio"  name="wait_to_verify_new_auction" value="yes"--}}
{{--                                                {{ App\Models\Setting::where('key', 'wait_to_verify_new_auction')->first()->value=="yes"?'checked':'' }}  >--}}
{{--                                            <label for="wait_to_verify_new_auction" style="padding-{{ floating('left', 'right') }}: 25px;">{{trans('messages.Yes')}}</label>--}}

{{--                                            <input type="radio"  name="wait_to_verify_new_auction" value="no"--}}
{{--                                                {{ App\Models\Setting::where('key', 'wait_to_verify_new_auction')->first()->value=="no"?'checked':'' }}  >--}}

{{--                                            <label for="wait_to_verify_new_auction">{{trans('messages.No')}}</label>--}}

{{--                                        </div>--}}

{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="text-right">--}}
{{--                                    <button type="submit" class="btn btn-success"><i--}}
{{--                                            class="icon-paperplane mr-2"></i>{{ trans('messages.buttons.submit_back_to_list') }}--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- /basic layout -->--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
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
                            <h5 class="card-title">{{ trans('messages.settings.about_app_settings') }}  تعرض في تطبيق الموبايل  </h5>
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
                            <h5 class="card-title">{{ trans('messages.settings.conditions_app_settings') }}  تعرض في تطبيق الموبايل</h5>
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


    <div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-12">
                    <!-- Basic layout-->
                    <div class="card">
                        <div class="card-header header-elements-inline">
                            <h5 class="card-title">{{ trans('messages.settings.privacy') }} تعرض في تطبيق الموبايل </h5>
                        </div><br>
                        <div class="card-body">
                            <form action="{{ route('settings.update') }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group row" >
                                    <label class="col-form-label col-lg-3">{{ trans('messages.settings.privacy_ar') }}
                                        :</label>
                                    <div class="col-lg-9">
                                        <textarea rows="5" cols="5" name="privacy_ar" class="  form-control "
                                                  placeholder="{{ trans('messages.settings.privacy_ar') }}">{{ settings('privacy_ar') }}
                                        </textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-form-label col-lg-3">{{ trans('messages.settings.privacy_en') }}
                                        :</label>
                                    <div class="col-lg-9">
                                                <textarea rows="5" cols="5" name="privacy_en"
                                                          class="form-control"
                                                          placeholder="{{ trans('messages.settings.privacy_en') }}">{{ settings('privacy_en') }}
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

    @include('Dashboard.Settings.app_terms')


@stop

@section('scripts')
    <script>
        CKEDITOR.replace('site_conditions_terms_ar', { height: '300px' });
        CKEDITOR.replace('site_conditions_terms_en', { height: '300px' });
        CKEDITOR.replace('site_privacy_ar', { height: '300px' });
        CKEDITOR.replace('site_privacy_en', { height: '300px' });
        CKEDITOR.replace('site_about_app_ar', { height: '300px' });
        CKEDITOR.replace('site_about_app_en', { height: '300px' });
        {{--CKEDITOR.instances.about_app_ar.setData(`{!! isset($setting) ? $setting->value : '' !!}`);--}}
    </script>
    @include('Dashboard.Settings.app_location_map')
@stop


