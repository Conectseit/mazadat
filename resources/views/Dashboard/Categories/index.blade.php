@extends('Dashboard.layouts.master')
@section('title', trans('messages.category.categories'))
@section('breadcrumb')
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')
                    </a>
                </li>
                <li class="active">@lang('messages.category.categories')</li>
            </ul>
            @include('Dashboard.layouts.parts.quick-links')
        </div>
@stop
@section('content')
    @include('Dashboard.layouts.parts.validation_errors')
    <!-- Basic datatable -->
    <div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;">
        <div class="panel-heading">
            @include('Dashboard.layouts.parts.table-header', ['collection' => $categories, 'name' => 'categories', 'icon' => 'categories'])
        </div>
        <br>
        <div class="list-icons" style="padding-right: 10px;">
            {{--<a href="{{route('categories.create')}}" class="btn btn-success btn-labeled btn-labeled-left"><b><i--}}
                        {{--class="icon-plus2"></i></b>{{ trans('messages.category.add') }}</a>--}}
        </div><br>

        @if($categories->count() > 0)
            <table class="table  datatable-button-print-basic" id="categories" style="font-size: 16px;">
                <thead>
                <tr style="background-color:gainsboro">
                    <th>#</th>
                    <th>{{ trans('messages.image') }}</th>
                    <th>{{ trans('messages.name') }}</th>
                    <th>{{ trans('messages.description') }}</th>
                    <th>{{ trans('messages.category.menu_index') }}</th>
                    <th>@lang('messages.since')</th>
                    <th class="text-center">@lang('messages.form-actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr id="category-row-{{ $category->id }}">

                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ $category->ImagePath }}" data-popup="lightbox">
                                <img src="{{ $category->ImagePath }}" alt="" width="80" height="80" class="img-circle">
                            </a>
                        </td>

                        <td><a href={{ route('categories.show', $category->id) }}> {{ isNullable($category->$name) }}</a></td>
{{--                        <td> {{ isNullable(Str::limit($category->$description),10) }}</td>--}}
                        <td> {{ isNullable(substr($category->$description,0,30)) }}...</td>
                        <td> {{$category->menu == 1
                                ? trans('messages.category.showing_in_web')
                                : trans('messages.category.not_showing_in_web')}}</td>
                        <td>{{isset($category->created_at) ? $category->created_at->diffForHumans() :'---' }}</td>
                        <td class="text-center">
                            <div class="list-icons text-center">
                                <div class="list-icons-item dropdown text-center">
                                    <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-{{ floating('right', 'left') }}">
                                        <li>
                                            {{--<a href="{{ route('categories.show', $category->id) }}">--}}
                                                 <a href="#">
                                                <i class="icon-eye"></i>@lang('messages.show')
                                            </a>
                                        </li>
                                        <li>
                                            {{--<a href="{{ route('categories.edit',$category->id) }}"> --}}
                                            <a href="#">
                                                <i class="icon-database-edit2"></i>@lang('messages.edit')
                                            </a>
                                        </li>
                                        <li>
                                            <a data-id="{{ $category->id }}" class="delete-action"
                                               {{--href="{{ Url('/category/category/'.$category->id) }}">--}}
                                               href="#">
                                                <i class="icon-database-remove"></i>@lang('messages.delete')
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        @else
            <div style="text-align: center;"><h2> @lang('messages.no_data_found') </h2></div>
        @endif
    </div>
    <!-- /basic datatable -->


@stop

@section('scripts')
    @include('Dashboard.layouts.parts.ajax_delete', ['model' => 'category'])
@stop


