@extends('Dashboard.layouts.master')
@section('title', trans('messages.edit-var',['var'=>trans('messages.permission.edit')]))

@section('breadcrumb')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')</a>
            </li>
            <li><a href="{{ route('permissions.index') }}"><i
                        class="icon-admin position-left"></i> @lang('messages.permission.permissions')</a></li>
            <li class="active">@lang('messages.edit-var',['var'=>trans('messages.permission.edit')])</li>
        </ul>

        @include('Dashboard.layouts.parts.quick-links')
    </div>
@stop
@section('content')
    @include('Dashboard.layouts.parts.validation_errors')


    <div class="row" style="padding: 15px;">
        <div class="col-md-9">


            <!-- Basic layout-->
            <form action="{{ route('permissions.update',$role->id) }}" class="form-horizontal" method="post"
                  enctype="multipart/form-data">
                {{--                {{ Form::token() }}--}}
                @csrf
                @method('PUT')
                <input type="hidden" name="administration_group_id" value="{{$role->id}}"/>
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title"> تعديل صلاحية جديدة </h5>
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
                                <input type="text" class="form-control" name="name_ar" value="{{ $role->name_ar }}"
                                       placeholder="{{ trans('messages.name_ar') }}" >
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-lg-3 control-label"> {{ trans('messages.name_en') }} </label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="name_en" value="{{ $role->name_en }}"
                                       placeholder="{{ trans('messages.name_en') }}" >
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-lg-3 control-label"> {{ trans('messages.description') }} </label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="description_ar" value="{{ $role->description_ar }}"
                                       placeholder="{{ trans('messages.description') }}" >
                            </div>
                        </div>

                        @foreach(cruds() as $i => $crud)
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h5 class="panel-title">@lang('messages.'.str()->singular($crud).'.' .$crud)</h5>
{{--                                    <h5 class="panel-title">@lang('messages.'.$crud.'.' .$crud)</h5>--}}
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
                                                            {!! Form::checkbox('perms[]', "$crud.index", checkIfHasRole($role, $crud, 'index'), ['class' => 'switchery form-control']) !!}                                                        </label>
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
                                                            {!! Form::checkbox('perms[]', "$crud.create", checkIfHasRole($role, $crud, 'create'), ['class' => 'switchery form-control']) !!}
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
                                                            {!! Form::checkbox('perms[]', "$crud.store", checkIfHasRole($role, $crud, 'create'), ['class' => 'switchery form-control']) !!}
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
                                                            {!! Form::checkbox('perms[]', "$crud.edit", checkIfHasRole($role, $crud, 'edit'), ['class' => 'switchery form-control']) !!}                                                        </label>
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
                                                            {!! Form::checkbox('perms[]', "$crud.update", checkIfHasRole($role, $crud, 'edit'), ['class' => 'switchery form-control']) !!}                                                        </label>
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
                                                            {!! Form::checkbox('perms[]', "ajax-delete-".str()->singular($crud), checkIfHasRole($role, $crud, 'delete'), ['class' => 'switchery form-control']) !!}
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
                                                        @if(in_array('settings.index',$perms))

                                                        @endif
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

                        <div class="text-right">
                            {{--<input type="submit" class="btn btn-primary" name="forward"--}}
                            {{--value=" {{ trans('messages.update_and_forword_2_list') }} "/>--}}
                            <input type="submit" class="btn btn-success" name="messages"
                                   value=" {{ trans('messages.update_and_forward_to_list') }} "/>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /basic layout -->
        </div>
    </div>
@stop
