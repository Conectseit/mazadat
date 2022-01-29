@extends('Dashboard.layouts.master')
@section('title', trans('messages.edit-var',['var'=>trans('messages.category.category')]))
@section('breadcrumb')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')</a>
            </li>
            <li><a href="{{ route('categories.index') }}"><i
                        class="icon-admin position-left"></i> @lang('messages.category.categories')</a></li>
            <li class="active">@lang('messages.edit-var',['var'=>trans('messages.category.category')])</li>
        </ul>
        @include('Dashboard.layouts.parts.quick-links')
    </div>
@endsection

@section('content')

    @include('Dashboard.layouts.parts.validation_errors')
    <div class="row" style="padding: 15px;">
        <div class="col-md-9">

            <!-- Basic layout-->
            <form action="{{ route('categories.update',$category) }}" class="form-horizontal" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
{{--                <input type="hidden" name="category_id" value="{{$category->id}}"/>--}}
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">{{ trans('messages.category.edit') }} </h5>
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
                            <input type="text" class="form-control" value="{{$category->name_ar}}" name="name_ar" placeholder="@lang('messages.name_ar') ">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" value="{{$category->name_en}}" name="name_en" placeholder="@lang('messages.name_en') ">
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label"> {{ trans('messages.description_ar') }} </label>
                            <div class="col-lg-9">
                                <textarea class="form-control" name="description_ar"
                                          placeholder="{{ trans('messages.description_ar') }}">{{ $category->description_ar }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label"> {{ trans('messages.description_en') }} </label>
                            <div class="col-lg-9">
                                <textarea class="form-control" name="description_en"
                                          placeholder="{{ trans('messages.description_en') }}">{{ $category->description_en }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>@lang('messages.category.image')</label>
                            <input type="file" class="form-control image " name="image">
                        </div>
                        <div class="form-group">
                            <img src=" {{$category->image_path}} " width=" 100px " value="{{$category->image_path}}"
                                 class="thumbnail image-preview">
                        </div>
                        <div class="text-right">
                            {{--<input type="submit" class="btn btn-primary" name="forward"--}}{{--value=" {{ trans('dash.update_and_forword_2_list') }} "/>--}}
                            <input type="submit" class="btn btn-success" value=" {{ trans('messages.update_and_forward_to_list') }} "/>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /basic layout -->
        </div>
    </div>

@stop
