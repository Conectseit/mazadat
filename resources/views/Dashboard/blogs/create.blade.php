@extends('Dashboard.layouts.master')
@section('title', trans('messages.create-var',['var'=>trans('messages.blog.blog')]))
@section('style')
    <style>
        .form-group input[required] + .label-text:after,
        .form-group select[required] {
            color: #c00;
            content: " *";
            font-family: serif;
        }
    </style>
@endsection
@section('breadcrumb')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')</a>
            </li>
            <li><a href="{{ route('blogs.index') }}"><i
                        class="icon-admin position-left"></i> @lang('messages.blog.blogs')</a></li>
            <li class="active">@lang('messages.create-var',['var'=>trans('messages.blog.blog')])</li>
        </ul>

        @include('Dashboard.layouts.parts.quick-links')
    </div>
@endsection

@section('content')
    @include('Dashboard.layouts.parts.validation_errors')
    {{--    @include('Dashboard/layouts/parts/flash')--}}
    <div class="row" style="padding: 15px;">
        <div class="col-md-9">

            <!-- Basic layout-->
            <form action="{{ route('blogs.store') }}" class="form-horizontal" method="post" id="submitted-form"
                  enctype="multipart/form-data">
                @csrf
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">@lang('messages.create-var',['var'=>trans('messages.blog.blog')])</h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                                <li><a data-action="close"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="box-body">
                            <div class="form-group">
                                <input type="text" class="form-control"
                                       value="{{ old('name_ar') }}" name="name_ar"
                                       placeholder="@lang('messages.name_ar')">
                                <span class="label-text"></span>
                                @error('name_ar') <span class="label-text"
                                                        style="color: #e81414;">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ old('name_en') }}" name="name_en"
                                       placeholder="@lang('messages.name_en')" required>
                                <span class="label-text"></span>
                                @error('name_en') <span class="label-text"
                                                        style="color: #e81414;">{{ $message }}</span>@enderror
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label display-block"> {{ trans('messages.category.category') }}
                                    : </label>
                                <div class="col-lg-6">
                                    <select name="category_id" class="selectpicker">
                                        <optgroup label="{{ trans('messages.category.category')}}">
                                            <option selected disabled>{{trans('messages.select')}}</option>

                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}"> {{ $category->$name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label><strong>{{ trans('messages.description_ar') }}</strong></label>
                                <textarea class=" form-control"
                                          name="description_ar">{{ old('description_ar') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label><strong>{{ trans('messages.description_en') }}</strong></label>
                                <textarea class=" form-control"
                                          name="description_en">{{ old('description_en') }}</textarea>
                            </div>


                            <div class="form-group">
                                <label>الصورة الاساسية</label>
                                <input type="file" class="form-control image " name="image">
                                @error('image')<span style="color: #e81414;">{{ $message }}</span>@enderror

                            </div>
                            <div class="form-group">
                                <img src=" {{ asset('default.png') }} " width=" 100px "
                                     class="thumbnail image-preview">

                                @error('image')
                                <span><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label>صورة اخري للمقالة</label>
                                <input type="file" class="form-control image2 " name="image2">
                                @error('image2')<span style="color: #e81414;">{{ $message }}</span>@enderror

                            </div>
                            <div class="form-group">
                                <img src=" {{ asset('default.png') }} " width=" 100px "
                                     class="thumbnail image-preview2">

                                @error('image2')
                                <span><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ old('meta_title') }}" name="meta_title"
                                       placeholder="@lang('messages.blog.meta_title')" required>
                                <span class="label-text"></span>
                                @error('meta_title') <span class="label-text"
                                                        style="color: #e81414;">{{ $message }}</span>@enderror
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ old('meta_description') }}" name="meta_description"
                                       placeholder="@lang('messages.blog.meta_description')" required>
                                <span class="label-text"></span>
                                @error('meta_description') <span class="label-text"
                                                           style="color: #e81414;">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary"
                            id="save-form-btn" style="padding-bottom: 10px; padding-left: 10px;">
                        {{ trans('messages.add_and_forward_to_list') }}
                        <i class="icon-check position-right"></i>
                    </button>

                </div>
            </form>
            <!-- /basic layout -->

        </div>

    </div>

@stop

@section('scripts')
    <script>
        CKEDITOR.replace('description_ar', {height: '300px'});
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

