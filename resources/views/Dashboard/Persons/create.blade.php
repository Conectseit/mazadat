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
        <div class="col-md-8">

            <!-- Basic layout-->
            <form action="{{ route('persons.store') }}" class="form-horizontal" method="post"
                  id="submitted-form" enctype="multipart/form-data">
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
                                <label>@lang('messages.person.image'):</label>
                                <input type="file" class="form-control image " name="image">
                                <img src=" {{ asset('uploads/default.png') }} " width="100px" class="thumbnail image-preview">
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">{{ trans('messages.first_name') }}</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" value="{{ old('first_name')}}" name="first_name" placeholder="@lang('messages.first_name') ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">{{ trans('messages.middle_name') }}</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" value="{{ old('middle_name')}}" name="middle_name" placeholder="@lang('messages.middle_name') ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">{{ trans('messages.last_name') }}</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" value="{{ old('last_name')}}" name="last_name" placeholder="@lang('messages.last_name') ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">{{ trans('messages.user_name') }}</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" value="{{ old('user_name')}}" name="user_name" placeholder="@lang('messages.user_name') ">
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
                                <label class="col-lg-3 control-label display-block"> {{ trans('messages.mobile') }} </label>
                                <div class="col-lg-5">
                                    <select name="country_id" class="select form-control"  id="country">
                                        <option selected disabled>{{trans('messages.choose_country_code')}}</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}"> {{ $country->$name }}{{ $country->phone_code }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <input type="text" maxlength="9" name="mobile" value="{{ old('mobile') }}" class="form-control"
                                           placeholder="{{trans('messages.enter_mobile')}}5xx xxx xxx">
                                </div>
                            </div>
{{--                            <div class="form-group">--}}
{{--                                <label class="col-lg-3 control-label">{{ trans('messages.mobile') }}</label>--}}
{{--                                <div class="col-lg-9">--}}
{{--                                    <input type="text" maxlength="14" name="mobile" value="{{ old('mobile') }}" class="form-control"--}}
{{--                                           placeholder="{{ trans('messages.mobile') }}">--}}
{{--                                </div>--}}
{{--                            </div>--}}

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
                                    <p class="text-pink">  {{trans('messages.pass_terms')}}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label display-block">{{ trans('messages.is_appear_name')}}:</label>
                                <label class="radio-inline">
                                    <label class="radio-inline">
                                        <input type="radio" value="0" class="styled" name="is_appear_name" checked="checked">{{trans('messages.No')}}
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio"  value="1" class="styled" name="is_appear_name" >{{trans('messages.Yes')}}
                                    </label>
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
                                <label class="col-lg-3 control-label">{{ trans('messages.block') }}</label>
                                <div class="col-lg-9">
                                    <input type="text" maxlength="14" name="block" value="{{ old('block') }}" class="form-control"
                                           placeholder="{{ trans('messages.block') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">{{ trans('messages.street') }}</label>
                                <div class="col-lg-9">
                                    <input type="text" maxlength="14" name="street" value="{{ old('street') }}" class="form-control"
                                           placeholder="{{ trans('messages.street') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">{{ trans('messages.block_num') }}</label>
                                <div class="col-lg-9">
                                    <input type="text" maxlength="14" name="block_num" value="{{ old('block_num') }}" class="form-control"
                                           placeholder="{{ trans('messages.block_num') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">{{ trans('messages.signs') }}</label>
                                <div class="col-lg-9">
                                    <input type="text" maxlength="14" name="signs" value="{{ old('signs') }}" class="form-control"
                                           placeholder="{{ trans('messages.signs') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">{{ trans('messages.P_O_Box') }}</label>
                                <div class="col-lg-9">
                                    <input type="text" maxlength="14" name="P_O_Box" value="{{ old('P_O_Box') }}" class="form-control"
                                           placeholder="{{ trans('messages.P_O_Box') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>@lang('messages.identity')</label>
                                        <input type="file" class="form-control  passport_image" name="passport_image">
                                    </div>
                                    <div class="col-lg-6">
                                        <img src=" {{ asset('uploads/default.png') }} " width="100px" class="thumbnail image-preview1">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="text-right" style="padding-bottom: 10px; padding-left: 10px;">
                        <input type="submit" class="btn btn-primary" id="save-form-btn" value=" {{ trans('messages.add_and_forward_to_list') }} "/>
                        {{--                        <input type="submit" class="btn btn-success" name="back" value=" {{ trans('messages.add_and_come_back') }} " />--}}
                    </div>
                </div>
            </form>
            <!-- /basic layout -->
        </div>


        <div class="col-md-4">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title"> {{ trans('messages.person.latest_persons') }} </h5>
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




    <script>
        // ======== image preview ====== //
        $(".passport_image").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.image-preview1').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>
@stop





