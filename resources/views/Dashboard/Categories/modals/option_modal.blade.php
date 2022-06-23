<!-- option modal -->
<div id="add_options" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="table-responsive content-group">
                    <!-- Basic layout-->
                    <form action="{{ route('options.store') }}" class="form-horizontal" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">{{ trans('messages.option.add') }}</h5>
                            </div>
                            <div class="panel-body">
                                <div class="box-body">
                                    <input type="hidden" name="category_id" value="{{$category->id}}" >
                                    <div class="form-group">
                                        <input type="text" class="form-control"  name="name_ar"
                                               value="{{ old('name_ar') }}"
                                               placeholder="@lang('messages.name_ar') ">
                                        @error('name_ar')<span style="color: #e81414;">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control"  name="name_en"
                                               value="{{ old('name_en') }}" placeholder="@lang('messages.name_en') ">
                                        @error('name_en')<span style="color: #e81414;">{{ $message }}</span>@enderror

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label display-block"> {{ trans('messages.is_required/not') }} </label>
                                    <div class="col-lg-9">
                                        <select name="is_required"  class="select form-control">
                                            <option value="" selected disabled>{{trans('messages.select')}}</option>
                                            <option  value="1">{{trans('messages.required')}}</option>
                                            <option  value="0 ">{{trans('messages.not_required')}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right" style="padding-bottom: 10px; padding-left: 10px;">
                                <input type="submit" class="btn btn-primary" value=" {{ trans('messages.add_and_forward_to_list') }} "/>
                            </div>
                        </div>
                    </form>
                    <!-- /basic layout -->
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-link btn-xs text-uppercase text-semibold" data-dismiss="modal">Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /option modal -->
