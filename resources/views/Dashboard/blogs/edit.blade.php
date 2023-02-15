@extends('Dashboard.layouts.master')
@section('title', trans('back.edit-var',['var'=>trans('back.blog.blog')]))
@section('breadcrumb')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="icon-home2 position-left"></i> @lang('back.home')</a>
            </li>
            <li><a href="{{ route('blogs.index') }}"><i
                        class="icon-admin position-left"></i> @lang('back.blog.blogs')</a></li>
            <li class="active">@lang('back.edit-var',['var'=>trans('back.blog.blog')])</li>
        </ul>
        @include('Dashboard.layouts.parts.quick-links')
    </div>
@endsection

@section('content')

    @include('Dashboard.layouts.parts.validation_errors')
    <div class="row" style="padding: 15px;">
        <div class="col-md-9">

            <!-- Basic layout-->
            <form action="{{ route('blogs.update',$blog) }}" class="form-horizontal" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="blog_id" value="{{$blog->id}}"/>
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">{{ trans('back.edit') }} </h5>
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
                            <input type="text" class="form-control" value="{{$blog->name_ar}}" name="name_ar"
                                   placeholder="@lang('back.name_ar') ">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" value="{{$blog->name_en}}" name="name_en"
                                   placeholder="@lang('back.name_en') ">
                        </div>


                        <div class="form-group">
                            <label><strong>{{ trans('back.description_ar') }}</strong></label>
                            <textarea class=" form-control"
                                      name="description_ar">{{ $blog->description_ar }}</textarea>
                        </div>
                        <div class="form-group">
                            <label><strong>{{ trans('back.description_en') }}</strong></label>
                            <textarea class=" form-control"
                                      name="description_en">{{ $blog->description_en }}</textarea>
                        </div>


                        <div class="form-group">
                            <label>@lang('back.main_image')</label>
                            <input type="file" class="form-control image " name="image">
                        </div>
                        <div class="form-group">
                            <img src=" {{$blog->image_path}} " width=" 100px " value="{{$blog->image_path}}"
                                 class="thumbnail image-preview">
                        </div>


                        <div class="form-group">
                            <input type="text" class="form-control" value="{{$blog->meta_title}}" name="meta_title"
                                   placeholder="@lang('back.meta_title') ">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" value="{{$blog->meta_description}}" name="meta_description"
                                   placeholder="@lang('back.meta_description') ">
                        </div>

                        <div class="text-right">
                            {{--<input type="submit" class="btn btn-primary" name="forward"--}}{{--value=" {{ trans('dash.update_and_forword_2_list') }} "/>--}}
                            <input type="submit" class="btn btn-success"
                                   value=" {{ trans('back.update_and_forward_to_list') }} "/>
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

@stop



