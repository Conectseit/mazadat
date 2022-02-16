@extends('Dashboard.layouts.master')
@section('title', trans('messages.create-var',['var'=>trans('messages.person.person')]))
@section('style')
@endsection

@section('breadcrumb')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')</a>
            </li>
            <li><a href="{{ route('persons.index') }}"><i
                        class="icon-admin position-left"></i> @lang('messages.person.persons')</a></li>
            <li class="active">@lang('messages.create-var',['var'=>trans('messages.person.person')])</li>
        </ul>
        @include('Dashboard.layouts.parts.quick-links')
    </div>
@endsection

@section('content')

    @include('Dashboard.layouts.parts.validation_errors')

    <div class="row" style="padding: 15px;">
        <div class="col-md-6">

            <!-- Basic layout-->
            <form action="{{ route('persons.store') }}" class="form-horizontal" method="post"
                  enctype="multipart/form-data">
                @csrf
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ trans('messages.person.add_new_person') }}</h3>
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
                                <label class="col-lg-3 control-label">{{ trans('messages.first_name') }}</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" value="" name="first_name" placeholder="@lang('messages.first_name') ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">{{ trans('messages.middle_name') }}</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" value="" name="middle_name" placeholder="@lang('messages.middle_name') ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">{{ trans('messages.last_name') }}</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" value="" name="last_name" placeholder="@lang('messages.last_name') ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">{{ trans('messages.user_name') }}</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" value="" name="user_name" placeholder="@lang('messages.user_name') ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">{{ trans('messages.email') }}</label>
                                <div class="col-lg-9">
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                           placeholder="{{ trans('messages.email') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">{{ trans('messages.mobile') }}</label>
                                <div class="col-lg-9">
                                    <input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control"
                                           placeholder="{{ trans('messages.mobile') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label"> {{ trans('messages.password') }} </label>
                                <div class="col-lg-9">
                                    <input type="password" class="form-control" name="password"
                                           placeholder=" {{ trans('messages.password') }} "/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label"> {{ trans('messages.confirm_password') }} </label>
                                <div class="col-lg-9">
                                    <input type="password" class="form-control" name="password_confirmation"
                                           placeholder=" {{ trans('messages.confirm_password') }} "/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label display-block">{{ trans('messages.is_appear_name')}}:</label>
                                <label class="radio-inline">
                                    <input type="radio"  value="0" class="styled" name="is_appear_name" checked="checked">{{trans('messages.Yes')}}
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" value="1" class="styled" name="is_appear_name">{{trans('messages.No')}}
                                </label>
                            </div>


                            <div class="form-group">
                                <label class="col-lg-3 control-label display-block"> {{ trans('messages.nationality.nationality') }} </label>
                                <div class="col-lg-9">
                                    <select name="nationality_id" class="select form-control">
                                    <option selected disabled>{{trans('messages.select')}}</option>
                                    @foreach ($nationalities as $nationality)
                                            <option value="{{ $nationality->id }}"> {{ $nationality->$name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label display-block"> {{ trans('messages.country.country') }} </label>
                                <div class="col-lg-9">
                                    <select name="country_id" class="select form-control"  id="country">
                                        <option selected disabled>{{trans('messages.select')}}</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}"> {{ $country->$name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label display-block"> {{ trans('messages.city_name') }} </label>
                                <div class="col-lg-9">
                                    <select name="city_id" class="select form-control"  id="cities">
                                        <option selected disabled>{{trans('messages.select')}}</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}"> {{ $city->$name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>@lang('messages.person.image'):</label>
                                    <input type="file" class="form-control image " name="image">
                                    <img src=" {{ asset('uploads/default.png') }} " width="100px" class="thumbnail image-preview">
                            </div>
                        </div>
                    </div>
                    <div class="text-right" style="padding-bottom: 10px; padding-left: 10px;">
                        <input type="submit" class="btn btn-primary" value=" {{ trans('messages.add_and_forward_to_list') }} "/>
                        {{--                        <input type="submit" class="btn btn-success" name="back" value=" {{ trans('messages.add_and_come_back') }} " />--}}
                    </div>
                </div>
            </form>
            <!-- /basic layout -->
        </div>


        <div class="col-md-6">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title"> {{ trans('messages.latest_persons') }} </h5>
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
                            <th> {{ trans('messages.full_name') }} </th>
                            <th> {{ trans('messages.user_name') }} </th>
                        </tr>
                        @forelse($latest_persons as $person)
                            <tr>
                                <td> {{ $person->full_name }} </td>
                                <td>{{ $person->user_name }}</td>
                            </tr>
                        @empty
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    @include('front.auth.ajax_get_cities')
@stop




