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
{{--    //socail settings--}}
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
                                <label class="col-form-label col-lg-4">{{ trans('messages.settings.twitter_url') }}
                                    :</label>
                                <div class="col-lg-8">
                                    <input type="text" name="twitter_url" value="{{ settings('twitter_url') }}"
                                           class="form-control"
                                           placeholder="{{ trans('messages.settings.twitter_url') }}">
                                </div>
                            </div>
                            {{--                                <div class="form-group row">--}}
                            {{--                                    <label class="col-form-label col-lg-4">{{ trans('messages.settings.youtube_url') }}--}}
                            {{--                                        :</label>--}}
                            {{--                                    <div class="col-lg-8">--}}
                            {{--                                        <input type="text" name="youtube_url" value="{{ settings('youtube_url') }}"--}}
                            {{--                                               class="form-control"--}}
                            {{--                                               placeholder="{{ trans('messages.settings.youtube_url') }}">--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
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

                            <div class="form-group row">
                                <label class="col-form-label col-lg-4">{{ trans('messages.settings.snapchat_url') }}
                                    :</label>
                                <div class="col-lg-8">
                                    <input type="text" name="facebook_url" value="{{ settings('facebook_url') }}"
                                           class="form-control"
                                           placeholder="{{ trans('messages.settings.snapchat_url') }}">
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





