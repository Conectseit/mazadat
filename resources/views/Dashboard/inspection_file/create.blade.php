@extends('Dashboard.layouts.master')

@section('title', trans('messages.create-var',['var'=>trans('messages.city.city')]))

@section('breadcrumb')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')</a>
            </li>
            <li><a href="{{ route('cities.index') }}"><i
                        class="icon-admin position-left"></i> @lang('messages.inspection_file_names')</a></li>
            <li class="active">@lang('messages.add')])</li>
        </ul>

        @include('Dashboard.layouts.parts.quick-links')
    </div>
@endsection

@section('content')

    @include('Dashboard.layouts.parts.validation_errors')


    <div class="row" style="padding: 15px;">
        <div class="col-md-6">

            <!-- Basic layout-->
            <form action="{{ route('inspection_file_names.store') }}" class="form-horizontal" method="post" id="submitted-form"
                  enctype="multipart/form-data">
                @csrf
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">{{ trans('messages.add') }}</h5>
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
                                <input type="text" class="form-control" value="" name="name"
                                       placeholder="@lang('messages.name') ">
                            </div>
                        </div>
                    </div>
                    <div class="text-right" style="padding-bottom: 10px; padding-left: 10px;">
                        <input type="submit" class="btn btn-primary" id="save-form-btn"
                               value=" {{ trans('messages.add_and_forward_to_list') }} "/>
                    </div>
                </div>
            </form>
            <!-- /basic layout -->

        </div>
    </div>
@stop



