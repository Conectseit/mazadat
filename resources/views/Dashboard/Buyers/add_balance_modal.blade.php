<!-- option modal -->
<div id="add_balance" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="table-responsive content-group">
                    <!-- Basic layout-->
                    <form action="{{ route('transactions.store') }}" class="form-horizontal" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">{{ trans('messages.buyer.add_balance') }}</h5>
                            </div>
                            <div class="panel-body">
                                <div class="box-body">
                                    <input type="hidden" name="user_id" value="{{$buyer->id}}" >
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="" name="amount" placeholder="@lang('messages.amount') " required>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label display-block"> {{ trans('messages.transaction.payment_type') }} </label>
                                        <div class="col-lg-9">
                                            <select name="payment_type" class="select form-control">
{{--                                                <option value="" selected disabled>{{trans('messages.select')}}</option>--}}
                                                <option value="cash">{{trans('messages.transaction.cash')}}</option>
                                                <option value="bank_deposit">{{trans('messages.transaction.bank_deposit')}}</option>
{{--                                                <option value="on_line">{{trans('messages.transaction.online')}}</option>--}}
                                            </select>
                                        </div>
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
                    <button type="button" class="btn btn-link btn-xs text-uppercase text-semibold" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /option modal -->
