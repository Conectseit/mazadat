<!-- notify modal -->
<div id="send_notify_to_all_users" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="table-responsive content-group">
                    <!-- Basic layout-->
                    <form action="{{  route('send_notify_to_all_users') }}" class="form-horizontal" method="post"  id="submitted-form"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">{{ trans('messages.notification.send_to_all_users') }}</h5>
                            </div>
                            <div class="panel-body">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label
                                            class="col-lg-3 control-label display-block"> {{ trans('messages.message.text') }}
                                            : </label>
                                        <div class="col-lg-6">
                                            <select name="text" class="select">
                                                <optgroup label="{{ trans('messages.message.text')}}">
                                                    <option selected
                                                            disabled>{{trans('messages.select')}}</option>
                                                    @foreach($messages as $message)
                                                        <option
                                                            value="{{ $message->text }}"> {{ $message->text }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <div class="text-right" style="padding-bottom: 10px; padding-left: 10px;">
                                <input type="submit" class="btn btn-primary" id="save-form-btn" value=" {{ trans('messages.notification.send') }} "/>
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
<!-- /notify modal -->
