@extends('Dashboard.layouts.master')
@section('title', trans('messages.page.pages'))
@section('files_scripts')
    <script type="text/javascript" src="{{asset('Dashboard/assets/js/pages/form_checkboxes_radios.js')}}"></script>
@stop
@section('style')
@stop
@section('breadcrumb')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')
                </a>
            </li>
            <li class="active">@lang('messages.page.pages')</li>
        </ul>
        @include('Dashboard.layouts.parts.quick-links')
    </div>
@stop
@section('content')

    <!-- Basic datatable -->
    <div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;">

        <div class="panel-heading">
            @include('Dashboard.layouts.parts.table-header', ['collection' => $pages, 'name' => 'pages', 'icon' => 'pages'])
        </div>
        <br>
        <div class="list-icons" style="padding-right: 10px;">
            <a href="{{route('pages.create')}}" class="btn btn-success btn-labeled btn-labeled-left"><b><i
                        class="icon-plus2"></i></b>{{ trans('messages.add') }}</a>
        </div>
        <br>

{{--        @include('Dashboard.layouts.parts.flash')--}}
        <table class="table datatable-basic" id="pages" style="font-size: 16px;">
            <thead>
            <tr style="background-color:gainsboro">
                <th>#</th>
                <th>{{ trans('messages.image') }}</th>
                <th>{{ trans('messages.name') }}</th>
                <th>@lang('messages.since')</th>
                <th class="text-center">@lang('messages.form-actions')</th>
            </tr>
            </thead>
            @if($pages->count() > 0)
                <tbody>
                @foreach($pages as $page)
                    <tr id="page-row-{{ $page->id }}">

                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ $page->main_image_path }}" data-popup="lightbox">
                                <img src="{{ $page->main_image_path }}" alt="" width="80" height="80" class="img-circle">
                            </a>
                        </td>

                        <td> {{ isNullable($page->$name) }}
{{--                        <td><a href={{ route('pages.show', $page->id) }}> {{ isNullable($page->$name) }}</a>--}}
                        </td>
                        <td>{{isset($page->created_at) ?$page->created_at->diffForHumans():'---' }}</td>
                        <td class="text-center">
                            <div class="list-icons text-center">
                                <div class="list-icons-item dropdown text-center">
                                    <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-{{ floating('right', 'left') }}">
                                        <li>
                                            <a href="{{ route('pages.show', $page->id) }}"> <i
                                                    class="icon-eye"></i>@lang('messages.show') </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('pages.edit',$page->id) }}"> <i
                                                    class="icon-database-edit2"></i>@lang('messages.edit') </a>
                                        </li>
                                        <li>
                                            <a data-id="{{ $page->id }}" class="delete-action"
                                               href="{{ Url('/page/page/'.$page->id) }}">
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
            @endif
        </table>
    </div>
    <!-- /basic datatable -->


@stop

@section('scripts')
    @include('Dashboard.layouts.parts.ajax_delete', ['model' => 'page'])

@stop


