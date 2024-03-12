<!-- add end date  modal -->
<div id="re_auction_modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="table-responsive content-group">
                    <!-- Basic layout-->
                    <form action="{{ route('auction/re_auction',$auction->id ) }}" class="form-horizontal" method="post" id="submitted-form"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">{{trans('messages.auction.add_end_time/re_auction')}}</h5>
                            </div>
                            <div class="panel-body">
                                <div class="box-body">

                                    <div class="form-group">
                                        <label class="display-block">{{ trans('messages.auction.end_date') }}:</label>
                                        <input type="datetime-local" class="form-control" value=""
                                               name="end_date" placeholder="@lang('messages.auction.end_date') ">
                                    </div>

                                </div>
                            </div>
                            <div class="text-right" style="padding-bottom: 10px; padding-left: 10px;">
                                <input type="submit" class="btn btn-primary" id="save-form-btn"
                                       value=" {{  trans('messages.add_and_forward_to_list') }} "/>
                            </div>
                        </div>
                    </form>
                    <!-- /basic layout -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link btn-xs text-uppercase text-semibold" data-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /add end date  modal -->

