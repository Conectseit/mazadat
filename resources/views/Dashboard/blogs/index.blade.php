@extends('Dashboard.layouts.master')
@section('title', trans('messages.blog.blogs'))
@section('files_scripts')
    <script type="text/javascript" src="{{asset('Dashboard/assets/js/pages/form_checkboxes_radios.js')}}"></script>
@stop
@section('style')
@stop
@section('breadcrumb')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')
                </a>
            </li>
            <li class="active">@lang('messages.blog.blogs')</li>
        </ul>
        @include('Dashboard.layouts.parts.quick-links')
    </div>
@stop
@section('content')

    <!-- Basic datatable -->
    <div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;">

        <div class="panel-heading">
            @include('Dashboard.layouts.parts.table-header', ['collection' => $blogs, 'name' => 'blogs', 'icon' => 'blogs'])
        </div>
        <br>
        <div class="list-icons" style="padding-right: 10px;">
            <a href="{{route('blogs.create')}}" class="btn btn-success btn-labeled btn-labeled-left"><b><i
                        class="icon-plus2"></i></b>{{ trans('messages.add') }}</a>
        </div>
        <br>

{{--        @include('Dashboard.layouts.parts.flash')--}}
        <table class="table datatable-basic" id="blogs" style="font-size: 16px;">
            <thead>
            <tr style="messagesground-color:gainsboro">
                <th>#</th>
                <th>{{ trans('messages.image') }}</th>
                <th>{{ trans('messages.name') }}</th>
                <th>@lang('messages.since')</th>
                <th class="text-center">@lang('messages.form-actions')</th>
            </tr>
            </thead>
            @if($blogs->count() > 0)
                <tbody>
                @foreach($blogs as $blog)
                    <tr id="blog-row-{{ $blog->id }}">

                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ $blog->image_path }}" data-popup="lightbox">
                                <img src="{{ $blog->image_path }}" alt="" width="80" height="80" class="img-circle">
                            </a>
                        </td>

                        <td> {{ isNullable($blog->$name) }}
{{--                        <td><a href={{ route('blogs.show', $blog->id) }}> {{ isNullable($blog->$name) }}</a>--}}
                        </td>
                        <td>{{isset($blog->created_at) ?$blog->created_at->diffForHumans():'---' }}</td>
                        <td class="text-center">
                            <div class="list-icons text-center">
                                <div class="list-icons-item dropdown text-center">
                                    <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-{{ floating('right', 'left') }}">
{{--                                        <li>--}}
{{--                                            <a href="{{ route('blogs.show', $blog->id) }}"> <i--}}
{{--                                                    class="icon-eye"></i>@lang('messages.show') </a>--}}
{{--                                        </li>--}}
                                        <li>
                                            <a href="{{ route('blogs.edit',$blog->id) }}"> <i
                                                    class="icon-database-edit2"></i>@lang('messages.edit') </a>
                                        </li>
                                        <li>
                                            <a data-id="{{ $blog->id }}" class="delete-action"
                                               href="{{ Url('/blog/blog/'.$blog->id) }}">
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
    @include('Dashboard.layouts.parts.ajax_delete', ['model' => 'blog'])

@stop


