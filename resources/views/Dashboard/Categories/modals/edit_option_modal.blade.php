<!-- option modal -->
<div id="edit_option_modal-{{ $id }}" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="table-responsive content-group">
                    <!-- Basic layout-->
                    <form action="{{ route('options.update',$option) }}" class="form-horizontal" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        {{--                <input type="hidden" name="option_id" value="{{$option->id}}"/>--}}
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">{{ trans('messages.option.edit') }} </h5>
                                <div class="heading-elements">
                                    <ul class="icons-list">
                                        <li><a data-action="collapse"></a></li>
                                        <li><a data-action="reload"></a></li>
                                        <li><a data-action="close"></a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-body">

                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{$option->name_ar}}" name="name_ar" placeholder="@lang('messages.name_ar') ">
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{$option->name_en}}" name="name_en" placeholder="@lang('messages.name_en') ">
                                </div>

                                <div class="text-right">
                                    <input type="submit" class="btn btn-success"
                                           value=" {{ trans('messages.update_and_forward_to_list') }} "/>
                                </div>
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
