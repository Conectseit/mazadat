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
