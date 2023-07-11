<div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-12">
                <!-- Basic layout-->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h2 class="card-title">Meta settings</h2>
                    </div>
                    <br>
                    <div class="card-body">
                        <form action="{{ route('settings.update') }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group row">
                                <label
                                    class="col-form-label col-lg-3">Arabic meta title
                                    :</label>
                                <div class="col-lg-9">
                                                <textarea rows="5" cols="5" name="site_meta_title_ar" class="form-control"
                                                          placeholder="meta title">{{ settings('site_meta_title_ar') }}
                                                </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-form-label col-lg-3">English meta title
                                    :</label>
                                <div class="col-lg-9">
                                                <textarea rows="5" cols="5" name="site_meta_title_en" class="form-control"
                                                          placeholder="meta title">{{ settings('site_meta_title_en') }}
                                                </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-form-label col-lg-3">Arabic meta description
                                    :</label>
                                <div class="col-lg-9">
                                                <textarea rows="5" cols="5" name="site_meta_description_ar"
                                                          class="form-control"
                                                          placeholder="meta description">{{ settings('site_meta_description_ar') }}
                                                </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-form-label col-lg-3">English meta description
                                    :</label>
                                <div class="col-lg-9">
                                                <textarea rows="5" cols="5" name="site_meta_description_en"
                                                          class="form-control"
                                                          placeholder="meta description">{{ settings('site_meta_description_en') }}
                                                </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-form-label col-lg-3"> Arabic meta keywords
                                    :</label>
                                <div class="col-lg-9">
                                                <textarea rows="5" cols="5" name="site_meta_keywords_ar"
                                                          class="form-control"
                                                          placeholder="meta keywords">{{ settings('site_meta_keywords_ar') }}
                                                </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-form-label col-lg-3"> English meta keywords
                                    :</label>
                                <div class="col-lg-9">
                                                <textarea rows="5" cols="5" name="site_meta_keywords_en"
                                                          class="form-control"
                                                          placeholder="meta keywords">{{ settings('site_meta_keywords_en') }}
                                                </textarea>
                                </div>
                            </div>
                            <legend class="font-weight-semibold text-uppercase font-size-sm"></legend>
                            <div class="text-right">
                                <button type="submit" class="btn btn-success"><i
                                        class="icon-paperplane mr-2"></i>{{ trans('back.buttons.submit_back_to_list') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /basic layout -->
        </div>
    </div>
</div>
