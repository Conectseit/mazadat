@extends('Dashboard.layouts.master')
@section('title', trans('messages.edit-var',['var'=>trans('messages.page.page')]))
@section('breadcrumb')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')</a>
            </li>
            <li><a href="{{ route('pages.index') }}"><i
                        class="icon-admin position-left"></i> @lang('messages.page.pages')</a></li>
            <li class="active">@lang('messages.edit-var',['var'=>trans('messages.page.page')])</li>
        </ul>
        @include('Dashboard.layouts.parts.quick-links')
    </div>
@endsection

@section('content')

    @include('Dashboard.layouts.parts.validation_errors')
    <div class="row" style="padding: 15px;">
        <div class="col-md-9">

            <!-- Basic layout-->
            <form action="{{ route('pages.update',$page) }}" class="form-horizontal" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="page_id" value="{{$page->id}}"/>
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">{{ trans('messages.edit') }} </h5>
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
                            <input type="text" class="form-control" value="{{$page->name_ar}}" name="name_ar"
                                   placeholder="@lang('messages.name_ar') ">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" value="{{$page->name_en}}" name="name_en"
                                   placeholder="@lang('messages.name_en') ">
                        </div>


{{--                        <div class="form-group">--}}
{{--                            <label><strong>{{ trans('messages.description_ar') }}</strong></label>--}}
{{--                            <textarea class=" form-control"--}}
{{--                                      name="description_ar">{{ $page->description_ar }}</textarea>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label><strong>{{ trans('messages.description_en') }}</strong></label>--}}
{{--                            <textarea class=" form-control"--}}
{{--                                      name="description_en">{{ $page->description_en }}</textarea>--}}
{{--                        </div>--}}


                        <div class="form-group">
                            <label>الصورة الاساسية</label>
                            <input type="file" class="form-control image " name="main_image">
                        </div>
                        <div class="form-group">
                            <img src=" {{$page->main_image_path}} " width=" 100px " value="{{$page->main_image_path}}"
                                 class="thumbnail image-preview">
                        </div>



                        <div class="form-group">
                            <input type="text" class="form-control" value="{{$page->meta_title}}" name="meta_title"
                                   placeholder="@lang('messages.meta_title') ">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" value="{{$page->meta_description}}" name="meta_description"
                                   placeholder="@lang('messages.meta_description') ">
                        </div>

                        <div class="text-right">
                            {{--<input type="submit" class="btn btn-primary" name="forward"--}}{{--value=" {{ trans('dash.update_and_forword_2_list') }} "/>--}}
                            <input type="submit" class="btn btn-success"
                                   value=" {{ trans('messages.update_and_forward_to_list') }} "/>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /basic layout -->
        </div>
    </div>

@stop
@section('scripts')

    <script>
        CKEDITOR.replace('description_ar', {height: '300px'});
    </script>
    <script>
        CKEDITOR.replace('description_en', {height: '300px'});
    </script>
    <script>
        // ======== image preview ====== //
        $(".image2").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.image-preview2').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>

@stop



