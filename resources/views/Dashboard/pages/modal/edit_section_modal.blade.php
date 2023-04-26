<!-- modal -->
<div id="edit_section_modal-{{ $id }}" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="table-responsive content-group">
                    <!-- Basic layout-->
                    <form action="{{ route('edit_page_section') }}" class="form-horizontal" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="image_id" value="{{$image->id}}"/>
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


{{--                                <div class="form-group">--}}
{{--                                    <label><strong>{{ trans('messages.description_ar') }}</strong></label>--}}
{{--                                    <textarea class=" form-control"--}}
{{--                                              name="description_ar">{{ $image->description_ar }}</textarea>--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <label><strong>{{ trans('messages.description_en') }}</strong></label>--}}
{{--                                    <textarea class=" form-control"--}}
{{--                                              name="description_en">{{ $image->description_en }}</textarea>--}}
{{--                                </div>--}}


                                <div class="form-group">
									<textarea cols="18" rows="18" class="wysihtml5 wysihtml5-default form-control" name="description_ar"  placeholder="Enter text ...">
                                          {{ $image->description_ar }}
									</textarea>
                                </div>
                                <div class="form-group">
									<textarea cols="18" rows="18" class="wysihtml5 wysihtml5-default form-control" name="description_en"  placeholder="Enter text ...">
                                          {{ $image->description_en }}
									</textarea>
                                </div>


                                <div class="form-group">
                                    <label>الصورة الاساسية</label>
                                    <input type="file" class="form-control image " name="image">
                                </div>
                                <div class="form-group">
                                    <img src=" {{$image->image_path}} " width=" 100px " value="{{$image->image_path}}"
                                         class="thumbnail image-preview">
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
<!-- /modal -->
