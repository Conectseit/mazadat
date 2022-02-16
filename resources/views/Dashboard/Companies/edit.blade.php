@extends('Dashboard.layouts.master')
@section('title', trans('messages.edit-var',['var'=>trans('messages.company.company')]))
@section('breadcrumb')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')</a>
            </li>
            <li><a href="{{ route('companies.index') }}"><i
                        class="icon-admin position-left"></i> @lang('messages.company.companies')</a></li>
            <li class="active">@lang('messages.edit-var',['var'=>trans('messages.company.company')])</li>
        </ul>

        @include('Dashboard.layouts.parts.quick-links')
    </div>
@endsection
@section('content')
    @include('Dashboard.layouts.parts.validation_errors')
    <div class="row" style="padding: 15px;">
        <div class="col-md-9">


            <!-- Basic layout-->
            <form action="{{ route('companies.update',$company) }}" class="form-horizontal" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="company_id" value="{{$company->id}}"/>
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">{{ trans('messages.company.edit') }} </h5>
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
                            <label class="col-lg-3 control-label">{{ trans('messages.company.user_name') }}</label>
                            <div class="col-lg-9">
                                <input type="text" name="user_name" value="{{ $company->user_name }}" class="form-control"
                                       placeholder="{{ trans('messages.user_name') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">{{ trans('messages.email') }}</label>
                            <div class="col-lg-9">
                                <input type="email" name="email" class="form-control" value="{{ $company->email }}"
                                       placeholder="{{ trans('messages.email') }}" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">{{ trans('messages.mobile') }}</label>
                            <div class="col-lg-9">
                                <input type="text" name="mobile" value="{{ $company->mobile }}" class="form-control"
                                       placeholder="{{ trans('messages.mobile') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>@lang('messages.company.image')</label>
                            <input type="file" class="form-control image" name="image">
                        </div>
                        <div class="form-group">
                            <img src=" {{$company->image_path}} " width=" 100px " value="{{$company->image_path}}"
                                 class="thumbnail image-preview">
                        </div>
                        <div class="text-right">
                            <input type="submit" class="btn btn-success"
                                   value=" {{ trans('messages.update_and_come_back') }} "/>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /basic layout -->
        </div>
    </div>
@stop
