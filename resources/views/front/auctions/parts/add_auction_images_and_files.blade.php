<div class="form-group">
    <div class="input-group control-group increment">
        <div class="form-group">
            <h5>@lang('messages.auction.images')</h5>
            <div class="row">
                <div class="col-lg-6">
                    اختر صورة : <input type="file" name="images[]" class=" image"><br>
                </div>
                <div class="col-lg-6">
                    <img src=" {{ asset('uploads/default.png') }} " width=" 100px " class="thumbnail image-preview">
                </div>
            </div>
        </div>
    </div>

    <div class="input-group-btn">
        <button class="btn btn-success add" type="button"><i
                class="fal fa-plus-circle"> </i> {{trans('messages.add_another_image')}}</button>
    </div>
    <div class="clone hide">
        <div class="control-group input-group" style="margin-top:10px">
            <div class="row">
                <div class="col-lg-6">
                    <input type="file" name="images[]" class="form-control" accept="image/*" onchange="readURL2(this)">
                </div>
                <div class="col-lg-4">
                    <img id="img-preview2" style="width: 120px ; height:90px"
                         src="{{ asset('uploads/images.jpg') }}" width="250px"/>
                </div>
                <div class="col-lg-2">
                    <div class="input-group-btn">
                        <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> حذف
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr><br>

<div class="form-group">
    <h4>@lang('messages.auction.inspection_report_files')</h4><br>

    <div class=" input-group  clone-file hide-file">

        <div class="row control-group" >

            <div class="col-lg-3 col-md-3">
                <label>@lang('messages.file_type')</label>
                <select name="file_name_id[]" class="form-select form-control" required>
{{--                                    <select name="files[file_name_id]" class="form-select form-control">--}}
                    <option selected disabled > {{trans('messages.select_file_type')}}</option>
                    @foreach ($inspection_file_names as $inspection_file_name)
                        <option
                            value="{{ $inspection_file_name->id }}" > {{ $inspection_file_name->name }} </option>
                    @endforeach
                </select>
                @error('file_name_id')<span style="color: #e81414;">{{ $message }}</span>@enderror

            </div>
            <div class="col-lg-3 col-md-3">
                <label>@lang('messages.select_file')</label>
                <input type="file" class="form-control" name="image[]"required>
                {{--                <input type="file" class="form-control" name="files[image]">--}}
                @error('inspection_report_images')<span
                    style="color: #e81414;">{{ $message }}</span>@enderror
            </div>


            <div class="col-lg-5 col-md-5">
                <label>@lang('messages.file_desc')</label>
                <input type="text" class="form-control" name="description[]" placeholder="@lang('messages.file_desc')" required>
                {{--                <input type="text" class="form-control" name="files[description]"placeholder="@lang('messages.file_desc')">--}}

            </div>
            <div class="col-lg-1 col-md-1">
                <div class="input-group-btn">
                    <button class="btn btn-danger btn-danger-file" type="button"><i
                            class="glyphicon glyphicon-remove"></i> حذف
                    </button>
                </div>
            </div>
        </div>


    </div>
    <div class=" increment-file">
        <div class="input-group-btn border" style="background: green; margin: 5px; padding: 5px; width: 20%;">
            <button class="btn   btn-file add-file btn-white" type="button"><i
                    class="fal fa-plus-circle"> </i> {{trans('messages.add_another_file')}}</button>
        </div>
    </div>


    <hr>
    <br>
</div>


{{--<div class="form-group">--}}
{{--    <div class="input-group control-group increment" >--}}
{{--        <div class="form-group">--}}
{{--            <h5>@lang('messages.auction.images')</h5>--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-6">--}}
{{--                    اختر صورة : <input type="file" name="images[]" class=" image"><br>--}}
{{--                </div>--}}
{{--                <div class="col-lg-6">--}}
{{--                    <img src=" {{ asset('uploads/default.png') }} " width=" 100px " class="thumbnail image-preview">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="input-group-btn">--}}
{{--        <button class="btn btn-success add" type="button"> <i class="fal fa-plus-circle"> </i> {{trans('messages.add_another_image')}}</button>--}}
{{--    </div>--}}
{{--    <div class="clone hide">--}}
{{--        <div class="control-group input-group" style="margin-top:10px">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-6">--}}
{{--                    <input type="file"  name="images[]" class="form-control" accept="image/*" onchange="readURL2(this)" >--}}
{{--                </div>--}}
{{--                <div class="col-lg-4">--}}
{{--                    <img id="img-preview2" style="width: 120px ; height:90px"--}}
{{--                         src="{{ asset('uploads/images.jpg') }}" width="250px"/>--}}
{{--                </div>--}}
{{--                <div class="col-lg-2">--}}
{{--                    <div class="input-group-btn">--}}
{{--                        <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> حذف </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div> <hr><br>--}}

{{--<div class="form-group">--}}
{{--    <h4>@lang('messages.auction.inspection_report_files')</h4><br>--}}

{{--    <div class="input-group control-group increment-file" >--}}
{{--        <div class="row">--}}
{{--            <div class="col-lg-2 col-md-3 d-flex align-items-center">--}}
{{--                <label>@lang('messages.file_type')</label>--}}
{{--            </div>--}}
{{--            <div class="col-lg-10 col-md-9">--}}
{{--                <select name="file_name_id[]" class="form-select form-control">--}}
{{--                <select name="files[file_name_id]" class="form-select form-control">--}}
{{--                    <option selected disabled>{{trans('messages.select_file_type')}}</option>--}}
{{--                    @foreach ($inspection_file_names as $inspection_file_name)--}}
{{--                        <option--}}
{{--                            value="{{ $inspection_file_name->id }}"> {{ $inspection_file_name->name }} </option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        @error('file_name_id')<span style="color: #e81414;">{{ $message }}</span>@enderror--}}


{{--        <div class="row">--}}
{{--            <div class="col-lg-2 col-md-3 d-flex align-items-center">--}}
{{--                <label>@lang('messages.select_file')</label>--}}
{{--            </div>--}}
{{--            <div class="col-lg-10 col-md-9">--}}
{{--                <input type="file" class="form-control" name="image[]">--}}
{{--                <input type="file" class="form-control" name="files[image]">--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        @error('inspection_report_images')<span--}}
{{--            style="color: #e81414;">{{ $message }}</span>@enderror--}}

{{--        <div class="row">--}}
{{--            <div class="col-lg-12 col-md-12">--}}
{{--                <input type="text" class="form-control" name="description[]"placeholder="@lang('messages.file_desc')">--}}
{{--                <input type="text" class="form-control" name="files[description]"placeholder="@lang('messages.file_desc')">--}}
{{--            </div>--}}
{{--        </div>--}}


{{--        <div class="input-group-btn border" style="background: green; margin: 5px; padding: 5px;">--}}
{{--            <button class="btn   btn-file add-file btn-white" type="button"> <i class="fal fa-plus-circle"> </i> {{trans('messages.add_another_file')}}</button>--}}
{{--        </div>--}}


{{--        <div class="clone-file hide-file">--}}
{{--            <div class="control-group input-group" >--}}

{{--                <div class="row">--}}
{{--                    <div class="col-lg-2 col-md-3 d-flex align-items-center">--}}
{{--                        <label>@lang('messages.file_type')</label>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-10 col-md-9">--}}
{{--                        <select name="file_name_id[]" class="form-select form-control">--}}
{{--                        <select name="files[file_name_id]" class="form-select form-control">--}}
{{--                            <option selected disabled>{{trans('messages.select_file_type')}}</option>--}}
{{--                            @foreach ($inspection_file_names as $inspection_file_name)--}}
{{--                                <option--}}
{{--                                    value="{{ $inspection_file_name->id }}"> {{ $inspection_file_name->name }} </option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                @error('file_name_id')<span style="color: #e81414;">{{ $message }}</span>@enderror--}}
{{--                <br>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-6">--}}
{{--                        <input type="file" class="form-control" name="image[]">--}}
{{--                        <input type="file" class="form-control" name="files[image]">--}}
{{--                    </div>--}}


{{--                        <div class="col-lg-4 ">--}}
{{--                            <input type="text" class="form-control" name="description[]" placeholder="@lang('messages.file_desc')">--}}
{{--                            <input type="text" class="form-control" name="files[description]" placeholder="@lang('messages.file_desc')">--}}
{{--                        </div>--}}

{{--                    <div class="col-lg-2">--}}
{{--                        <div class="input-group-btn">--}}
{{--                            <button class="btn btn-danger btn-danger-file" type="button"><i class="glyphicon glyphicon-remove"></i> حذف </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}

{{--    </div><hr><br>--}}
{{--</div>--}}








