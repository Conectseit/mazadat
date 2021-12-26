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
{{--                                <div class="heading-elements">--}}
{{--                                    <ul class="icons-list">--}}
{{--                                        <li><a data-action="collapse"></a></li>--}}
{{--                                        <li><a data-action="reload"></a></li>--}}
{{--                                        <li><a data-action="close"></a></li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
                            </div>
                            <div class="panel-body">
                                <div class="box-body">
                                    <input type="hidden" name="category_id" value="{{$category->id}}" >
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="" name="name_ar" placeholder="@lang('messages.name_ar') ">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="" name="name_en" placeholder="@lang('messages.name_en') ">
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

                    {{--                        <div>--}}
                    {{--                                     <span class="badge  badge-pill" style="background-color: #00838F;">--}}
                    {{--                                        <a href=>{{__('messages.seller.show_auction_bids')}}</a>--}}
                    {{--                                      </span>--}}
                    {{--                        </div>--}}

                    <button type="button" class="btn btn-link btn-xs text-uppercase text-semibold" data-dismiss="modal">Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /option modal -->
