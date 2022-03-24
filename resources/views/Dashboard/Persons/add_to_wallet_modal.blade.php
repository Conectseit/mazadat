<!-- wallet modal ==-->

<div id="add_wallet" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="table-responsive content-group">
                    <!-- Basic layout-->
                    <form action="{{ route('add_balance',$person->id) }}" class="form-horizontal" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">{{ trans('messages.person.add_wallet') }}</h5>
                            </div>
                            <div class="panel-body">
                                <div class="box-body">
{{--                                    <input type="hidden" name="auction_id" value="{{$auction->id}}" >--}}
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">{{ trans('messages.balance') }}</label>
                                        <div class="col-lg-9">
                                            <input type="text" name="wallet"  class="form-control" placeholder="{{ trans('messages.balance') }}">
                                        </div>
                                    </div>
                                    <br>

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
<!-- /wallet modal -->


