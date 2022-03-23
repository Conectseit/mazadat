@extends('Dashboard.layouts.master')
@section('title', trans('messages.company.companies'))

@section('breadcrumb')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('admin.home')}}">
                    <i class="icon-home2 position-left"></i> @lang('messages.home')
                </a>
            </li>
            <li class="active">@lang('messages.company.companies')</li>
        </ul>
        @include('Dashboard.layouts.parts.quick-links')
    </div>
@stop

@section('content')
    @include('Dashboard.layouts.parts.validation_errors')

    <!-- Basic datatable -->
    <div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;"><br>
        <div class="list-icons" style="padding-right: 10px;">
            <a href="{{route('companies.create')}}" class="btn btn-success btn-labeled btn-labeled-left"><b><i
                        class="icon-plus2"></i></b>{{ trans('messages.company.add_new_company') }}</a>
        </div>
        <div class="panel-heading">
            @include('Dashboard.layouts.parts.table-header', ['collection' => $companies, 'name' => 'companies', 'icon' => 'company'])
        </div>


        <!-- Basic pills -->
        <div class="row" style="padding: 15px;">
            <div class="col-md-12">
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
                        <div class="tabbable">
                            <ul class="nav nav-pills nav-pills-bordered nav-justified">
                                <li class="active"><a href="#accepted_companies" data-toggle="tab">{{ trans('messages.accepted') }}</a></li>
                                <li><a href="#not_accepted_companies" data-toggle="tab">{{ trans('messages.not_accepted') }}</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="accepted_companies">

                                    <div class="panel-body">
                                        @if($accepted_companies->count() > 0)
                                            <table class="table datatable-basic" id="company" style="font-size: 16px;">
                                                <thead>
                                                <tr style="background-color:gainsboro">
{{--                                                    <th class="text-center">#</th>--}}
                                                    <th class="text-center">{{ trans('messages.company.image') }}</th>
{{--                                                    <th class="text-center">{{ trans('messages.type') }}</th>--}}
                                                    <th class="text-center">{{ trans('messages.company.user_name') }}</th>
{{--                                                    <th class="text-center">{{ trans('messages.mobile') }}</th>--}}
                                                    <th class="text-center">{{ trans('messages.email') }}</th>
                                                    <th class="text-center">{{ trans('messages.accept/not_accept') }}</th>
                                                    <th class="text-center">{{ trans('messages.unique') }}</th>
                                                    <th class="text-center">@lang('messages.since')</th>
                                                    <th class="text-center">@lang('messages.form-actions')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($accepted_companies as $company)

                                                    <tr id="company-row-{{ $company->id }}">
{{--                                                        <td class="text-center">({{ $loop->iteration }})</td>--}}
                                                        <td class="text-center">
                                                            <a href="{{ $company->image_path }}" data-popup="lightbox"><img src="{{ $company->image_path }}" alt="" width="80" height="80" class="img-circle"></a>
                                                        </td>
{{--                                                        <td class="text-center"> {{ $company->is_company=='company'?trans('messages.company.company'):trans('messages.person.person')}} </td>--}}
                                                        <td class="text-center">
                                                            <a href={{ route('companies.show', $company->id) }}> {{ isNullable($company->user_name) }}</a>
                                                        </td>
{{--                                                        <td class="text-center"> {{ $company->mobile}}</td>--}}
                                                        <td class="text-center"> {{ $company->email}}</td>

                                                        <td class="text-center">
                                                            @if($company->is_accepted ==1)
                                                                <a href="company/{{$company->id}}/not_accept/" class="btn btn-danger btn-sm"><i
                                                                        class="icon-close2"></i>{{trans('messages.not_accept')}}</a>
                                                            @else
                                                                <a href="company/{{$company->id}}/accept/" class="btn btn-success btn-sm"> <i
                                                                        class="icon-check2"></i> {{trans('messages.accept')}}</a>
                                                            @endif
                                                        </td>


{{--                                                        <td class="text-center">--}}
{{--                                                            @if($company->unique_company ==0)--}}
{{--                                                                <a href="company/{{$company->id}}/unique/" class="btn btn-success btn-sm"> <i--}}
{{--                                                                        class="icon-check2"></i> {{trans('messages.unique')}}</a>--}}
{{--                                                            @else--}}

{{--                                                                <a href="company/{{$company->id}}/not_unique/" class="btn btn-danger btn-sm"><i--}}
{{--                                                                        class="icon-close2"></i>{{trans('messages.not_unique')}}</a>--}}
{{--                                                            @endif--}}
{{--                                                        </td>--}}

                                                        <td class="text-center">
                                                            @if($company->is_accepted ==1)
                                                                <a href="{{route('company/not_accept',$company->id)}}" class="btn btn-danger btn-sm"><i
                                                                        class="icon-close2"></i>{{trans('messages.not_accept')}}</a>
                                                            @else
                                                                <a href="{{route('company/accept',$company->id)}}" class="btn btn-success btn-sm"> <i
                                                                        class="icon-check2"></i> {{trans('messages.accept')}}</a>
                                                            @endif
                                                        </td>

                                                        <td class="text-center">{{isset($company->created_at) ?$company->created_at->diffForHumans():'---' }}</td>
                                                        <td class="text-center">

                                                            <ul class="icons-list">
                                                                <li class="dropdown">
                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                        <i class="icon-menu9"></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu dropdown-menu-{{ floating('right', 'left') }}">
                                                                        <li>
                                                                            <a href="{{ route('companies.show',$company->id) }}"> <i
                                                                                    class="icon-eye"></i>@lang('messages.show') </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="{{ route('companies.edit',$company->id) }}"> <i
                                                                                    class="icon-database-edit2"></i>@lang('messages.edit') </a>
                                                                        </li>
                                                                        <li>
                                                                            <a data-id="{{ $company->id }}" class="delete-action"
                                                                               href="{{ Url('/company/company/'.$company->id) }}">
                                                                                <i class="icon-database-remove"></i>@lang('messages.delete')
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                        @else
                                            <center><h2> @lang('messages.no_data_found') </h2></center>

                                        @endif
                                    </div>
                                </div>


                                <div class="tab-pane " id="not_accepted_companies">

                                    <div class="panel-body">
                                        @if($not_accepted_companies->count() > 0)
                                            <table class="table datatable-basic" id="company" style="font-size: 16px;">
                                                <thead>
                                                <tr style="background-color:gainsboro">
{{--                                                    <th class="text-center">#</th>--}}
                                                    <th class="text-center">{{ trans('messages.company.image') }}</th>
                                                    {{--                                                    <th class="text-center">{{ trans('messages.type') }}</th>--}}
                                                    <th class="text-center">{{ trans('messages.company.user_name') }}</th>
{{--                                                    <th class="text-center">{{ trans('messages.mobile') }}</th>--}}
                                                    <th class="text-center">{{ trans('messages.email') }}</th>
                                                    <th class="text-center">{{ trans('messages.accept/not_accept') }}</th>
                                                    <th class="text-center">@lang('messages.since')</th>
                                                    <th class="text-center">@lang('messages.form-actions')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($not_accepted_companies as $company)

                                                    <tr id="company-row-{{ $company->id }}">
{{--                                                        <td class="text-center">({{ $loop->iteration }})</td>--}}
                                                        <td class="text-center">
                                                            <a href="{{ $company->image_path }}" data-popup="lightbox"><img src="{{ $company->image_path }}" alt="" width="80" height="80" class="img-circle"></a>
                                                        </td>
                                                        {{--                                                        <td class="text-center"> {{ $company->is_company=='company'?trans('messages.company.company'):trans('messages.person.person')}} </td>--}}
                                                        <td class="text-center">
                                                            <a href={{ route('companies.show', $company->id) }}> {{ isNullable($company->user_name) }}</a>
                                                        </td>
{{--                                                        <td class="text-center"> {{ $company->mobile}}</td>--}}
                                                        <td class="text-center"> {{ $company->email}}</td>

                                                        <td class="text-center">
                                                            @if($company->is_accepted ==1)
{{--                                                                <a href="company/{{$company->id}}/not_accept/" class="btn btn-danger btn-sm"><i--}}
{{--                                                                        class="icon-close2"></i>{{trans('messages.not_accept')}}</a>--}}
                                                                <a href="{{route('company/not_accept',$company->id)}}" class="btn btn-danger btn-sm"><i
                                                                        class="icon-close2"></i>{{trans('messages.not_accept')}}</a>
                                                            @else
                                                                <a href="{{route('company/accept',$company->id)}}" class="btn btn-success btn-sm"> <i
                                                                        class="icon-check2"></i> {{trans('messages.accept')}}</a>
{{--                                                                <a href="company/{{$company->id}}/accept/" class="btn btn-success btn-sm"> <i--}}
{{--                                                                        class="icon-check2"></i> {{trans('messages.accept')}}</a>--}}
                                                            @endif
                                                        </td>


                                                        <td class="text-center">{{isset($company->created_at) ?$company->created_at->diffForHumans():'---' }}</td>
                                                        <td class="text-center">

                                                            <ul class="icons-list">
                                                                <li class="dropdown">
                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                        <i class="icon-menu9"></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu dropdown-menu-{{ floating('right', 'left') }}">
                                                                        <li>
                                                                            <a href="{{ route('companies.show',$company->id) }}"> <i
                                                                                    class="icon-eye"></i>@lang('messages.show') </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="{{ route('companies.edit',$company->id) }}"> <i
                                                                                    class="icon-database-edit2"></i>@lang('messages.edit') </a>
                                                                        </li>
                                                                        <li>
                                                                            <a data-id="{{ $company->id }}" class="delete-action"
                                                                               href="{{ Url('/company/company/'.$company->id) }}">
                                                                                <i class="icon-database-remove"></i>@lang('messages.delete')
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                        @else
                                            <center><h2> @lang('messages.no_data_found') </h2></center>

                                        @endif
                                    </div>
                                </div>


                                {{--                                <div class="tab-pane" id="not_accepted_companies">--}}
{{--                                    <div class="panel-body">--}}
{{--                                        @if($not_accepted_companies->count() > 0)--}}
{{--                                            <table class="table datatable-basic" id="company" style="font-size: 16px;">--}}
{{--                                                <thead>--}}
{{--                                                <tr style="background-color:gainsboro">--}}
{{--                                                    <th class="text-center">#</th>--}}
{{--                                                    <th class="text-center">{{ trans('messages.company.image') }}</th>--}}
{{--                                                    <th class="text-center">{{ trans('messages.company.user_name') }}</th>--}}
{{--                                                    <th class="text-center">{{ trans('messages.mobile') }}</th>--}}
{{--                                                    <th class="text-center">{{ trans('messages.email') }}</th>--}}
{{--                                                    <th class="text-center">{{ trans('messages.accept/not_accept') }}</th>--}}
{{--                                                    <th class="text-center">@lang('messages.since')</th>--}}
{{--                                                    <th class="text-center">@lang('messages.form-actions')</th>--}}
{{--                                                </tr>--}}
{{--                                                </thead>--}}
{{--                                                <tbody>--}}
{{--                                                @foreach($not_accepted_companies as $company)--}}

{{--                                                    <tr id="company-row-{{ $company->id }}">--}}
{{--                                                        <td class="text-center">{{ $loop->iteration }}</td>--}}
{{--                                                        <td class="text-center">--}}
{{--                                                            <a href="{{ $company->image_path }}" data-popup="lightbox"><img src="{{ $company->image_path }}" alt="" width="80" height="80" class="img-circle"></a>--}}
{{--                                                        </td>--}}
{{--                                                        <td class="text-center"> {{ $company->is_company=='company'?trans('messages.company.company'):trans('messages.person.person')}} </td>--}}
{{--                                                        <td class="text-center"><a--}}
{{--                                                                href={{ route('companies.show', $company->id) }}> {{ isNullable($company->user_name) }}</a>--}}
{{--                                                        </td>--}}
{{--                                                        <td class="text-center"> {{ $company->mobile}}</td>--}}
{{--                                                        <td class="text-center"> {{ $company->email}}</td>--}}

{{--                                                        <td class="text-center">--}}
{{--                                                            @if($company->is_accepted ==1)--}}
{{--                                                                <a href="company/{{$company->id}}/not_accept/" class="btn btn-danger btn-sm"><i--}}
{{--                                                                        class="icon-close2"></i>{{trans('messages.not_accept')}}</a>--}}
{{--                                                            @else--}}
{{--                                                                <a href="company/{{$company->id}}/accept/" class="btn btn-success btn-sm"> <i--}}
{{--                                                                        class="icon-check2"></i> {{trans('messages.accept')}}</a>--}}
{{--                                                            @endif--}}
{{--                                                        </td>--}}

{{--                                                        --}}{{--                        <td class="text-center"> {{ $company->city->$name}}</td>--}}
{{--                                                        <td class="text-center">{{isset($company->created_at) ?$company->created_at->diffForHumans():'---' }}</td>--}}
{{--                                                        <td class="text-center">--}}

{{--                                                            <ul class="icons-list">--}}
{{--                                                                <li class="dropdown">--}}
{{--                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
{{--                                                                        <i class="icon-menu9"></i>--}}
{{--                                                                    </a>--}}
{{--                                                                    <ul class="dropdown-menu dropdown-menu-{{ floating('right', 'left') }}">--}}
{{--                                                                        <li>--}}
{{--                                                                            <a href="{{ route('companies.show',$company->id) }}"> <i--}}
{{--                                                                                    class="icon-eye"></i>@lang('messages.show') </a>--}}
{{--                                                                        </li>--}}
{{--                                                                        <li>--}}
{{--                                                                            <a href="{{ route('companies.edit',$company->id) }}"> <i--}}
{{--                                                                                    class="icon-database-edit2"></i>@lang('messages.edit') </a>--}}
{{--                                                                        </li>--}}
{{--                                                                        <li>--}}
{{--                                                                            <a data-id="{{ $company->id }}" class="delete-action"--}}
{{--                                                                               href="{{ Url('/company/company/'.$company->id) }}">--}}
{{--                                                                                <i class="icon-database-remove"></i>@lang('messages.delete')--}}
{{--                                                                            </a>--}}
{{--                                                                        </li>--}}
{{--                                                                    </ul>--}}
{{--                                                                </li>--}}
{{--                                                            </ul>--}}
{{--                                                        </td>--}}
{{--                                                    </tr>--}}
{{--                                                @endforeach--}}
{{--                                                </tbody>--}}
{{--                                            </table>--}}

{{--                                        @else--}}
{{--                                            <center><h2> @lang('messages.no_data_found') </h2></center>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /basic pills -->
    </div>
    <!-- /basic datatable -->
@stop

@section('scripts')
    @include('Dashboard.layouts.parts.ajax_delete', ['model' => 'company'])
@stop


