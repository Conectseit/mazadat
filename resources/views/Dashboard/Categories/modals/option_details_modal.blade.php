<!-- option modal -->
<div id="add_option_details-{{ $id }}" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="table-responsive content-group">
                    <!-- Basic layout-->
                    <form action="{{  route('add_option_detail', ['option_id' => $id]) }}" class="form-horizontal" method="post"
                          enctype="multipart/form-data">
                        {{ method_field('PUT') }}
                        @csrf
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">{{ trans('messages.option_detail.add_detail') }}</h5>
                            </div>
                            <div class="panel-body">
                                <div class="box-body">
                                    <input type="hidden" name="option_id" value="{{$id}}" >
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="" name="value_ar" placeholder="@lang('messages.value_ar') ">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="" name="value_en" placeholder="@lang('messages.value_en') ">
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

                    <button type="button"
                            class="btn btn-link btn-xs text-uppercase text-semibold" data-dismiss="modal">Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /option modal -->
