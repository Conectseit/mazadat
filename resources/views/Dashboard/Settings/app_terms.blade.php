<div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-12">
                <!-- Basic layout-->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">{{ trans('messages.settings.about_app_settings') }} تعرض في الموقع </h5>
                    </div><br>
                    <div class="card-body">
                        <form action="{{ route('settings.update') }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3">{{ trans('messages.settings.about_app_ar') }}
                                    :</label>
                                <div class="col-lg-9">
                                                <textarea rows="5" cols="5" name="site_about_app_ar" class="form-control"
                                                          placeholder="{{ trans('messages.settings.about_app_ar') }}">{{ settings('site_about_app_ar') }}
                                                </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3">{{ trans('messages.settings.about_app_en') }}
                                    :</label>
                                <div class="col-lg-9">
                                                <textarea rows="5" cols="5" name="site_about_app_en" class="form-control"
                                                          placeholder="{{ trans('messages.settings.about_app_en') }}">{{ settings('site_about_app_en') }}
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
                        <h5 class="card-title">{{ trans('messages.settings.conditions_app_settings') }} تعرض في الموقع </h5>
                    </div><br>
                    <div class="card-body">
                        <form action="{{ route('settings.update') }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group row" >
                                <label class="col-form-label col-lg-3">{{ trans('messages.settings.conditions_terms_ar') }}
                                    :</label>
                                <div class="col-lg-9">
                                    {{--                                        <textarea type="text" style="resize: vertical;" rows="8" class="form-control"id="site_conditions_terms_ar" name="site_conditions_terms_ar">{{ settings('site_conditions_terms_ar') }}</textarea>--}}

                                    <textarea rows="5" cols="5" name="site_conditions_terms_ar" class="  form-control "
                                              placeholder="{{ trans('messages.settings.conditions_terms_ar') }}">{{ settings('site_conditions_terms_ar') }}
                                        </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-form-label col-lg-3">{{ trans('messages.settings.conditions_terms_en') }}
                                    :</label>
                                <div class="col-lg-9">
                                                <textarea rows="5" cols="5" name="site_conditions_terms_en"
                                                          class="form-control"
                                                          placeholder="{{ trans('messages.settings.conditions_terms_en') }}">{{ settings('site_conditions_terms_en') }}
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
                        <h5 class="card-title">{{ trans('messages.settings.privacy') }}  تعرض في الموقع </h5>
                    </div><br>
                    <div class="card-body">
                        <form action="{{ route('settings.update') }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group row" >
                                <label class="col-form-label col-lg-3">{{ trans('messages.settings.privacy_ar') }}
                                    :</label>
                                <div class="col-lg-9">
                                        <textarea rows="5" cols="5" name="site_privacy_ar" class="  form-control "
                                                  placeholder="{{ trans('messages.settings.privacy_ar') }}">{{ settings('site_privacy_ar') }}
                                        </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-form-label col-lg-3">{{ trans('messages.settings.privacy_en') }}
                                    :</label>
                                <div class="col-lg-9">
                                                <textarea rows="5" cols="5" name="site_privacy_en"
                                                          class="form-control"
                                                          placeholder="{{ trans('messages.settings.privacy_en') }}">{{ settings('site_privacy_en') }}
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
