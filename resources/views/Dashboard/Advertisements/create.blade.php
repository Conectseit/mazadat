@extends('Dashboard.layouts.master')
@section('title', trans('messages.create-var',['var'=>trans('messages.advertisement.advertisement')]))
@section('breadcrumb')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')</a>
            </li>
            <li><a href="{{ route('advertisements.index') }}"><i
                        class="icon-admin position-left"></i> @lang('messages.advertisement.advertisements')</a></li>
            <li class="active">@lang('messages.create-var',['var'=>trans('messages.advertisement.advertisement')])</li>
        </ul>

        @include('Dashboard.layouts.parts.quick-links')
    </div>
@endsection

@section('content')
    @include('Dashboard.layouts.parts.validation_errors')
    <div class="row" style="padding: 15px;">
        <div class="col-md-6">

            <!-- Basic layout-->
            <form action="{{ route('advertisements.store') }}" class="form-horizontal" method="post"
                  enctype="multipart/form-data">
                @csrf
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">{{ trans('messages.advertisement.add') }}</h5>
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
                                <input type="text" class="form-control" value="" name="name_ar"
                                       placeholder="@lang('messages.name_ar') ">
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" value="" name="name_en"
                                       placeholder="@lang('messages.name_en') ">
                            </div>

                            <div class="form-group">
                                <label>@lang('messages.image')</label>
                                <input type="file" class="form-control image " name="image">
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
                        {{--                        <input type="submit" class="btn btn-success" name="messages" value=" {{ trans('messages.add_and_come_messages') }} " />--}}
                    </div>

                </div>


            </form>
            <!-- /basic layout -->

        </div>


        <div class="col-md-6">
            <div class="panel panel-flat">

                <div class="panel-heading">
                    <h5 class="panel-title"> {{ trans('messages.advertisement.last_advertisements') }} </h5>
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
                        @forelse($latest_advertisements as $advertisement)
                            <tr>
                                <td> {{ $advertisement->name_ar }} </td>
                                <td><img  src="{{ $advertisement->ImagePath }}" style="height:50px;"/></td>
                            </tr>
                        @empty
                        @endforelse
                    </table>
                </div>

            </div>
        </div>
    </div>
@stop



