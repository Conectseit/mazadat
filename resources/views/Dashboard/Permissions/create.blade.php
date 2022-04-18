@extends('Dashboard.layouts.master')

@section('title', trans('messages.create-var',['var'=>trans('messages.permission.permission')]))


<!-- Page header -->
{{--<div class="page-header page-header-default">--}}
    @section('breadcrumb')
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')</a>
                </li>
                <li><a href="{{ route('permissions.index') }}"><i
                            class="icon-admin position-left"></i> @lang('messages.permission.permissions')</a></li>
                <li class="active">{{ __('messages.permission.add') }}</li>
            </ul>

            @include('Dashboard.layouts.parts.quick-links')
        </div>
    @endsection
{{--</div>--}}
<!-- /page header -->
@section('content')




    @include('Dashboard.layouts.parts.validation_errors')


    <div class="row" style="padding: 15px;">
        <div class="col-md-8">

            <!-- Basic layout-->
            <form action="{{ route('permissions.store') }}" class="form-horizontal" method="post"
                  enctype="multipart/form-data">
                @csrf
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title"> {{ __('messages.permission.add') }} </h5>
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
                            <label class="col-lg-3 control-label"> {{ trans('messages.name_ar') }} </label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="name_ar"
                                       placeholder="{{ trans('messages.name_ar') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label"> {{ trans('messages.name_en') }} </label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="name_en"
                                       placeholder="{{ trans('messages.name_en') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label"> {{ trans('messages.description_ar') }} </label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="description_ar"
                                       placeholder="{{ trans('messages.description_ar') }}">
                            </div>
                        </div>


                        @foreach(cruds() as $i => $crud)
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h5 class="panel-title">@lang('messages.'.str()->singular($crud).'.'.$crud)</h5>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label class="control-label col-lg-3"> عرض الكل </label>
                                                <div class="col-lg-9">
                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                        <label>
                                                            <input type="checkbox" name="perms[]" class="switchery"
                                                                   value="{{ ($crud) }}.index">
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label class="control-label col-lg-3"> عرض عنصر </label>
                                                <div class="col-lg-9">
                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                        <label>
                                                            <input type="checkbox" name="perms[]" class="switchery"
                                                                   value="{{ ($crud) }}.show">
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label class="control-label col-lg-3"> انشاء </label>
                                                <div class="col-lg-9">
                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                        <label>
                                                            {{--   <input type="hidden" name="perms[]" value="{{ $crud }}.store" >--}}
                                                            <input type="checkbox" name="perms[]" class="switchery"
                                                                   value="{{ $crud }}.create">
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label class="control-label col-lg-3"> حفظ الانشاء </label>
                                                <div class="col-lg-9">
                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                        <label>
                                                            <input type="checkbox" name="perms[]" class="switchery"
                                                                   value="{{ $crud }}.store">
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label class="control-label col-lg-3"> تعديل </label>
                                                <div class="col-lg-9">
                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                        <label>
                                                            {{--                                                            <input type="hidden" name="perms[]" value="{{ $crud }}.update" >--}}
                                                            <input type="checkbox" name="perms[]" class="switchery"
                                                                   value="{{ $crud }}.edit">
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label class="control-label col-lg-3"> حفظ التعديل </label>
                                                <div class="col-lg-9">
                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                        <label>
                                                            <input type="checkbox" name="perms[]" class="switchery"
                                                                   value="{{ $crud }}.update">
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label class="control-label col-lg-3"> حذف </label>
                                                <div class="col-lg-9">
                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                        <label>
                                                            <input type="checkbox" name="perms[]" class="switchery"
                                                                   {{--                                                                   value="{{ $crud }}.destroy">--}}
                                                                   value="ajax-delete-{{ str()->singular($crud) }}">
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach




                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">@lang('messages.user.add_balance')</h5>
                                <div class="heading-elements">
                                    <ul class="icons-list">
                                        <li><a data-action="collapse"></a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="control-label col-lg-3"> اضافة </label>
                                            <div class="col-lg-9">
                                                <div class="checkbox checkbox-switchery switchery-xs">
                                                    <label>
                                                        <input type="checkbox" name="perms[]" class="switchery"
                                                               value="add_balance">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">@lang('messages.settings.settings')</h5>
                                <div class="heading-elements">
                                    <ul class="icons-list">
                                        <li><a data-action="collapse"></a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="control-label col-lg-3"> عرض </label>
                                            <div class="col-lg-9">
                                                <div class="checkbox checkbox-switchery switchery-xs">
                                                    <label>
                                                        <input type="checkbox" name="perms[]" class="switchery"
                                                               value="settings.index">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="control-label col-lg-3"> تعديل </label>
                                            <div class="col-lg-9">
                                                <div class="checkbox checkbox-switchery switchery-xs">
                                                    <label>
                                                        <input type="checkbox" name="perms[]" class="switchery"
                                                               value="settings.update">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>




                    </div>


                    <div class="text-right" style="padding-bottom: 10px; padding-left: 10px;">
                        <input type="submit" class="btn btn-primary" name="forward"
                               value=" {{ trans('messages.add_and_forward_to_list') }} "/>
{{--                        <input type="submit" class="btn btn-success" name="messages"--}}
{{--                               value=" {{ trans('messages.added_and_come_messages') }} "/>--}}
                    </div>
                </div>
            </form>
            <!-- /basic layout -->

        </div>

    </div>



@stop



