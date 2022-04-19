<!-- option modal -->
<div id="edit_option_details_modal-{{ $id }}" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                @foreach($option->option_details as $option_detail)
                <div class="row">
                    <div class="col-lg-6">
                        <h5 style="">{{isNullable( $option_detail->$value) }}
                        </h5>
                    </div>
                    <div class="col-lg-6">
                        <a href="{{ route('option_details.edit',$option_detail->id) }}">
                            <i class="icon-database-edit2"> </i> @lang('messages.edit') </a>
                    </div>
                </div>
                    <hr>
                @endforeach

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link btn-xs text-uppercase text-semibold" data-dismiss="modal">Close
                </button>
            </div>
        </div>
    </div>

</div>
<!-- /option modal -->
