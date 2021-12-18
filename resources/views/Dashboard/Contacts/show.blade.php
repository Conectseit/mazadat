@extends('Dashboard.layouts.master')

@section('title', trans('messages.contact.contacts'))

@section('content')

    <!-- Page header -->
    <div class="page-header page-header-default">
        @section('breadcrumb')
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href=""><i class="icon-home2 position-left"></i> @lang('messages.home')</a>
                </li>
                <li><a href="{{ route('contacts.index') }}"><i
                            class="icon-admin position-left"></i> @lang('messages.contact.contacts')</a></li>
                <li class="active">@lang('messages.show-var',['var'=>trans('messages.contact.contacts')])</li>

            </ul>

            @include('Dashboard.layouts.parts.quick-links')
        </div>
        @endsection
    </div>
    <!-- /page header -->


    @include('Dashboard.layouts.parts.validation_errors')

    <!-- Basic datatable -->
    <div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;">

        <div class="panel-heading">
            <div class="row">
                <div class="col-md-8">
                    <!-- Basic layout-->
                    <div class="card">
                        <div class="card-header header-elements-inline">
{{--                            <h5 class="card-title">{{ trans('messages.contact.show_contact_message') }}</h5>--}}
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-3">{{ trans('messages.contact.name') }} :</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" value="{{ $contact->name }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-3">{{ trans('messages.contact.email') }} :</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" value="{{ $contact->email }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-3">{{ trans('messages.contact.mobile') }} :</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" value="{{ $contact->mobile }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-3">{{ trans('messages.contact.title') }} :</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" value="{{ $contact->title }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-3">{{ trans('messages.contact.title') }} :</label>
                                    <div class="col-lg-9">
                                        <textarea class="form-control" readonly>{{ $contact->message }}</textarea>
                                    </div>
                                </div>
                                <legend class="font-weight-semibold text-uppercase font-size-sm"></legend>
                                <div class="text-right">
                                    <a href="{{ route('contacts.index') }}" class="btn btn-primary text-white"><i class="icon-list2 mr-2"></i>{{ trans('messages.buttons_back_to_list') }}</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /basic layout -->
                </div>
            </div>

        </div>

    </div>
    <!-- /basic datatable -->
@stop

