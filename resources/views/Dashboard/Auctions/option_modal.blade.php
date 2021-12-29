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
                                    <input type="hidden" name="auction_id" value="{{$auction->id}}" >
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label display-block"> {{ trans('messages.auction.choose_options') }} </label>
                                        <div class="col-lg-6">
                                            <select name="option_id" id="options" class="select">
                                                <optgroup label="{{ trans('messages.option.options') }}">
                                                    @foreach($auction->category->options as $option)
                                                        <option value="{{ $option->id }}"> {{ $option->$name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div><br>
{{--                                    <div class="form-group">--}}
{{--                                        <label class="col-lg-3 control-label display-block"> {{ trans('messages.auction.choose_option_details') }} </label>--}}
{{--                                        <div class="col-lg-6">--}}
{{--                                            <select name="option_details_id" id="option_details" class="select">--}}
{{--                                                <optgroup label="{{ trans('messages.auction.choose_option_details') }}">--}}
{{--                                                    @foreach($option_details as $option_detail)--}}
{{--                                                        <option value="{{ $option_detail->id }}"> {{ $option_detail->$value }} </option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div><br>--}}


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

@section('scripts')
    @include('Dashboard.layouts.parts.ajax_get_options')
@endsection
