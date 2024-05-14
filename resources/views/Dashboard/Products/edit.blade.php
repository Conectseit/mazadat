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
        <div class="col-md-7">

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
                            <label class="col-lg-3 control-label display-block">
                                {{ trans('messages.category.status') }}
                            </label>
                            <div class="col-md-6">
                                <select name="status" class="select" required>
                                    <option {{$category->status == null ? 'selected disabled' : ''}}>
                                        {{trans('messages.select')}}
                                    </option>

                                    <optgroup label="{{ trans('messages.category.status') }}">

                                        <option  value="real_estate"
                                                {{$category->status == 'real_estate' ? 'selected disabled' : ''}}>
                                            {{trans('messages.category.real_estate')}}
                                        </option>
                                        <option value="cars" {{$category->status == 'cars' ? 'selected disabled' : ''}}>
                                            {{trans('messages.category.cars') }}
                                        </option>

                                    </optgroup>
                                </select>
                                @error('status')<span style="color: #e81414;">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" value="{{$category->name_ar}}"
                                   name="name_ar" placeholder="@lang('messages.name_ar') ">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" value="{{$category->name_en}}"
                                   name="name_en" placeholder="@lang('messages.name_en') ">
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label display-block">
                                {{ trans('messages.category.choose_category') }}
                            </label>
                            <div class="col-lg-6">
                                <select name="parent_id" id="category" class="select">
                                    <optgroup label="{{ trans('messages.category.choose_category') }}">
                                        <option selected value="">{{trans('messages.select')}}</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}"
                                                    {{$category->parent_id == $cat->id ? 'selected disabled' : ''}}>
                                                {{ $cat->$name }} </option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                            @error('parent_id')<span style="color: #e81414;">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label"> {{ trans('messages.description_ar') }} </label>
                            <div class="col-lg-9">
                                <textarea class="form-control" name="description_ar"
                                          placeholder="{{ trans('messages.description_ar') }}">
                                    {{ $category->description_ar }}
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label"> {{ trans('messages.description_en') }} </label>
                            <div class="col-lg-9">
                                <textarea class="form-control" name="description_en"
                                          placeholder="{{ trans('messages.description_en') }}">
                                    {{ $category->description_en }}
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control"  value="{{$category->auction_commission}}"
                                   name="auction_commission"
                                   placeholder="@lang('messages.auction_commission')   /100 ريال ">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" value="{{ $category->meta_title }}"
                                   name="meta_title"
                                   placeholder="@lang('messages.blog.meta_title')">
                            <span class="label-text"></span>
                            @error('meta_title')
                            <span class="label-text"
                                  style="color: #e81414;">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" value="{{ $category->meta_description }}"
                                   name="meta_description"
                                   placeholder="@lang('messages.blog.meta_description')">
                            <span class="label-text"></span>
                            @error('meta_description') <span class="label-text"
                                                       style="color: #e81414;">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox"
                                           @if($category->menu == 1) checked @endif id="menu" name="menu"/>
                                    @lang('back.category.menu')
                                </label>
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
        <div class="col-md-5">
            <div class="panel panel-flat">

                <div class="panel-heading">
                    <h5 class="panel-title"> {{ trans('messages.category.sub_categories') }} </h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">
                    <table class="table table-bordered table-hover">
                        <tr class="text-center">
                            <th> {{ trans('messages.name') }} </th>
                            <th> {{ trans('messages.image') }} </th>
                        </tr>
                        @forelse($sub_categories as $category)
                            <tr>
                                <td> {{ $category->name_ar }} </td>
                                <td><img src="{{ $category->ImagePath }}" style="height:50px;"/></td>
                            </tr>
                        @empty
                        @endforelse
                    </table>
                </div>

            </div>
        </div>
    </div>

@stop
