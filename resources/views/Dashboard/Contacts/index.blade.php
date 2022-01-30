@extends('Dashboard.layouts.master')
@section('title', trans('messages.contact.contacts'))

@section('breadcrumb')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href=""><i class="icon-home2 position-left"></i> @lang('messages.home')</a>
            </li>
            <li class="active">@lang('messages.contact.contacts')</li>
        </ul>

        @include('Dashboard.layouts.parts.quick-links')
    </div>
@endsection


@section('content')


    @include('Dashboard.layouts.parts.validation_errors')

    <!-- Basic datatable -->
    <div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;">
        <div class="panel-heading">
            @include('Dashboard.layouts.parts.table-header', ['collection' => $contacts, 'name' => 'contacts', 'icon' => 'contacts'])
        </div>

        <table class="table datatable-button-init-basic">
            <thead>
            <tr class="text-center">
                <th class="text-center">#</th>
                <th class="text-center">{{ trans('messages.contact.name') }}</th>
                <th class="text-center">{{ trans('messages.contact.mobile') }}</th>
                <th class="text-center">{{ trans('messages.contact.message') }}</th>
                <th class="text-center">{{ trans('messages.contact.is_seen') }}</th>
                <th class="text-center">@lang('messages.since')</th>
                <th class="text-center">@lang('messages.form-actions')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($contacts as $contact)
                <tr class="text-center" id="row_{{ $contact->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>
{{--                    @if($contact->user_id)--}}
{{--                            <a href="" class="text-default font-weight-semibold">{{ $contact->full_name }}</a></td>--}}
{{--                    @else--}}
                        {{ $contact->full_name }}
{{--                    @endif--}}
                    <td>{{ $contact->mobile }}</td>
                    <td>
                        <a data-popup="tooltip" title="{{ $contact->message }}">
                            {{ substr($contact->message, 0, 20) }} ...
                        </a>
                    </td>
                    <td>
                        @if($contact->read_at == null)
                            <span class="badge badge-warning">{{ trans('messages.contact.unseen') }}</span>
                        @else
                            <span class="badge badge-primary">{{ trans('messages.contact.seen') }}</span>
                        @endif
                    </td>
                    <td>{{ $contact->created_at->diffforHumans() }}</td>
                    <td>
                        <div class="list-icons">
                            <div class="list-icons-item dropdown">
                                <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-{{ floating('right', 'left') }}">
                                    <li>
                                        <a href="{{ route('contacts.show', $contact->id) }}"> <i
                                                class="icon-eye"></i>@lang('messages.show') </a>
                                    </li>
                                    <li>
                                        <a data-id="{{ $contact->id }}" class="delete-action"
                                           href="{{ Url('/contact/contact/'.$contact->id) }}">
                                            <i class="icon-database-remove"></i>@lang('messages.delete')
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /basic datatable -->
@stop

@section('scripts')
    @include('Dashboard.layouts.parts.ajax_delete', ['model' => 'contact'])

@stop
