@extends('Dashboard.layouts.master')
@section('title', trans('messages.page.pages'))
@section('style')

    <!-- Theme JS files -->
    <script type="text/javascript" src="{{asset('Dashboard/assets/js/plugins/editors/wysihtml5/wysihtml5.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('Dashboard/assets/js/plugins/editors/wysihtml5/toolbar.js')}}"></script>
    <script type="text/javascript" src="{{asset('Dashboard/assets/js/plugins/editors/wysihtml5/parsers.js')}}"></script>
    <script type="text/javascript" src="{{asset('Dashboard/assets/js/plugins/editors/wysihtml5/locales/bootstrap-wysihtml5.ua-UA.js')}}"></script>
    <script type="text/javascript" src="{{asset('Dashboard/assets/js/plugins/notifications/jgrowl.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('Dashboard/assets/js/core/app.js')}}"></script>
    <script type="text/javascript" src="{{asset('Dashboard/assets/js/pages/editor_wysihtml5.js')}}"></script>

    {{--    <script type="text/javascript" src="{{asset('Dashboard/ckeditor/ckeditor.js')}}"></script>--}}
    {{--    <script type="text/javascript" src="{{asset('Dashboard/assets/js/pages/editor_ckeditor.js')}}"></script>--}}

@stop
@section('breadcrumb')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i
                        class="icon-home2 position-left"></i> @lang('messages.home')</a>
            </li>
            <li><a href="{{ route('pages.index') }}"><i
                        class="icon-admin position-left"></i> @lang('messages.page.pages')</a></li>
            <li class="active">@lang('messages.page.show')</li>
        </ul>
        @include('Dashboard.layouts.parts.quick-links')
    </div>
@stop

@section('content')
    @include('Dashboard.layouts.parts.validation_errors')


    <!-- Toolbar -->
    <div class="navbar navbar-default navbar-xs content-group">
        <ul class="nav navbar-nav visible-xs-block">
            <li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i
                        class="icon-menu7"></i></a></li>
        </ul>
        <div class="navbar-collapse collapse" id="navbar-filter">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#page_images" data-toggle="tab"><i
                            class="icon-menu7 position-left"></i> {{ trans('messages.page.images') }}</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- /toolbar -->


    <!-- Content area -->
    <div class="content">
        <div class="row">
            <div class="col-lg-9">
                <div class="tabbable">
                    <div class="tab-content">

                        <div class="tab-pane fade in active" id="page_images">
                            <!-- category_auctions -->
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>
                                            <li><a data-action="reload"></a></li>
                                            <li><a data-action="close"></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body">

                                    <div class="card-header header-elements-inline">
                                        <h3 class="card-title">{{ trans('messages.page.images')}}:</h3>
                                    </div>
                                    <br>


                                    <div class="list-icons" style="padding-right: 10px;">
                                        <a href="#" data-toggle="modal" data-target="#add_images"
                                           class="btn btn-success btn-labeled btn-labeled-left"><b><i
                                                    class="icon-plus2"></i></b>{{ trans('messages.page.add_image_section') }}
                                        </a>
                                    </div>
                                    <br>
                                    <table class="table datatable-basic" id="page-images" style="font-size: 16px;">
                                        <thead>
                                        <tr style="background-color:gainsboro">
                                            <th>{{ trans('messages.image') }}</th>
                                            <th class="text-center">@lang('messages.form-actions')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($page_images as $image)

                                            <tr id="page-image-row-{{ $image->id }}">
                                                <td>
                                                    <a href="{{ $image->image_path }}" data-popup="lightbox">
                                                        <img src="{{ $image->image_path }}" alt="" width="80"
                                                             height="80" class="img-circle"></a>
                                                </td>

                                                <td class="text-center">
                                                    <div class="list-icons text-center">
                                                        <div class="list-icons-item dropdown text-center">
                                                            <a href="#"
                                                               class="list-icons-item caret-0 dropdown-toggle"
                                                               data-toggle="dropdown">
                                                                <i class="icon-menu9"></i>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-{{ floating('right', 'left') }}">
                                                                <li>
                                                                    <a href="javascript:void(0);"
                                                                       data-toggle="modal"
                                                                       data-target="#edit_section_modal-{{$image->id}}">
                                                                        <i class="icon-database-edit2"></i>@lang('messages.edit')
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a data-id="{{ $image->id }}"
                                                                       class="delete-action">
                                                                        <i class="icon-database-remove"></i>@lang('messages.delete')
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @include('Dashboard.pages.modal.edit_section_modal', ['id' => $image->id])

                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /category_auctions -->
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <!-- option modal -->
        <div id="add_images" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive content-group">
                            <!-- Basic layout-->
                            <form action="{{ route('addPageImage') }}" class="form-horizontal" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="panel panel-flat">
                                    <div class="panel-heading">
                                        <h5 class="panel-title">{{ trans('messages.page.add_image_section') }}</h5>
                                    </div>
                                    <div class="panel-body">
                                        <div class="box-body">
                                            <input type="hidden" name="page_id" value="{{$page->id}}">
{{--                                            <div class="form-group">--}}
{{--                                                <label><strong>{{ trans('messages.description_ar') }}</strong></label>--}}
{{--                                                <textarea class=" form-control"--}}
{{--                                                          name="description_ar">{{ old('description_ar') }}</textarea>--}}
{{--                                            </div>--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label><strong>{{ trans('messages.description_en') }}</strong></label>--}}
{{--                                                <textarea class=" form-control"--}}
{{--                                                          name="description_en">{{ old('description_en') }}</textarea>--}}
{{--                                            </div>--}}


                                            <div class="form-group">
                                                <label><strong>{{ trans('messages.description_ar') }}</strong></label>
                                                <textarea cols="18" rows="18" class="wysihtml5 wysihtml5-default form-control"
                                                          name="description_ar" placeholder="Enter text ..."></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label><strong>{{ trans('messages.description_en') }}</strong></label>
                                                <textarea cols="18" rows="18" class="wysihtml5 wysihtml5-default form-control"
                                                              name="description_en" placeholder="Enter text ..."></textarea>
                                            </div>


                                            <div class="form-group">
                                                <label>صورة السكشن</label>
                                                <input type="file" class="form-control image " name="image">
                                                @error('image')<span
                                                    style="color: #e81414;">{{ $message }}</span>@enderror

                                            </div>
                                            <div class="form-group">
                                                <img src=" {{ asset('default.png') }} " width=" 100px "
                                                     class="thumbnail image-preview">

                                                @error('image')
                                                <span><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="text-right" style="padding-bottom: 10px; padding-left: 10px;">
                                        <input type="submit" class="btn btn-primary"
                                               value=" {{ trans('messages.add_and_forward_to_list') }} "/>
                                    </div>
                                </div>
                            </form>
                            <!-- /basic layout -->
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-link btn-xs text-uppercase text-semibold"
                                    data-dismiss="modal">Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /option modal -->
    </div>


@stop

@section('scripts')
    @include('Dashboard.layouts.parts.ajax_delete', ['model' => 'page-image'])
    {{--        <script>--}}
    {{--            CKEDITOR.replace('description_ar', {height: '300px'});--}}
    {{--            CKEDITOR.replace('description_en', {height: '300px'});--}}
    {{--        </script>--}}

@stop


