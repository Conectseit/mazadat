@extends('Dashboard.layouts.master')
@section('title', trans('messages.create-var',['var'=>trans('messages.category.category')]))
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
            <li><a href="{{ route('categories.index') }}"><i
                        class="icon-admin position-left"></i> @lang('messages.category.categories')</a></li>
            <li class="active">@lang('messages.create-var',['var'=>trans('messages.category.category')])</li>
        </ul>
        @include('Dashboard.layouts.parts.quick-links')
    </div>
@endsection

@section('content')
{{--    @include('Dashboard.layouts.parts.validation_errors')--}}

    <div class="row" style="padding: 15px;">
        <div class="col-md-6">

            <!-- Basic layout-->
            <form action="{{ route('categories.store') }}" class="form-horizontal" method="post"
                  enctype="multipart/form-data">
                @csrf
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">{{ trans('messages.add_new_category') }}</h5>
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
                                           placeholder="@lang('messages.name_ar')" required>
                                    <span class="label-text"></span>
                                @error('name_ar') <span  class="label-text" style="color: #e81414;">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ old('name_en') }}"  name="name_en"
                                       placeholder="@lang('messages.name_en')" required>
                                <span class="label-text"></span>
                                @error('name_en') <span  class="label-text" style="color: #e81414;">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ old('description_ar') }}"  name="description_ar"
                                       placeholder="@lang('messages.description_ar')" required>
                                <span class="label-text"></span>
                                @error('description_ar') <span  class="label-text" style="color: #e81414;">{{ $message }}</span>@enderror
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ old('description_en') }}"  name="description_en"
                                       placeholder="@lang('messages.description_en')" required>
                                <span class="label-text"></span>
                                @error('description_en') <span  class="label-text" style="color: #e81414;">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control"
                                       value="{{ old('auction_commission') }}" name="auction_commission"
                                       placeholder="@lang('messages.auction_commission')" required>
                                <span class="label-text"></span>
                                @error('auction_commission') <span class="label-text" style="color: #e81414;">{{ $message }}</span>@enderror
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ old('meta_title') }}" name="meta_title"
                                       placeholder="@lang('messages.blog.meta_title')">
                                <span class="label-text"></span>
                                @error('meta_title')
                                    <span class="label-text" style="color: #e81414;">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ old('meta_description') }}" name="meta_description"
                                       placeholder="@lang('messages.blog.meta_description')">
                                <span class="label-text"></span>
                                @error('meta_description')
                                    <span class="label-text" style="color: #e81414;">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>@lang('messages.image')</label>
                                <input type="file" class="form-control image " name="image">
                                @error('image')<span style="color: #e81414;">{{ $message }}</span>@enderror

                            </div>
                            <div class="form-group">
                                <img src=" {{ asset('uploads/default.png') }} " width=" 100px "
                                     class="thumbnail image-preview">
                            </div>

                        </div>
                    </div>
                    <div class="text-right" style="padding-bottom: 10px; padding-left: 10px;">
                        <input type="submit" class="btn btn-primary"
                               value=" {{ trans('messages.add_and_forward_to_list') }} "/>
                        {{--<input type="submit" class="btn btn-success" name="messages" value=" {{ trans('messages.add_and_come_messages') }} " />--}}
                    </div>

                </div>
            </form>
            <!-- /basic layout -->
        </div>

        <div class="col-md-6">
            <div class="panel panel-flat">

                <div class="panel-heading">
                    <h5 class="panel-title"> {{ trans('messages.category.last_categories') }} </h5>
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
                        @forelse($latest_categories as $category)
                            <tr>
                                <td> {{ $category->name_ar }} </td>
                                <td><img  src="{{ $category->ImagePath }}" style="height:50px;"/></td>
                            </tr>
                        @empty
                        @endforelse
                    </table>
                </div>

            </div>
        </div>
    </div>

@stop



