@extends('Dashboard.layouts.master')
@section('title', trans('messages.auction.auctions'))
@section('content')

    <!-- Page header -->
    <div class="page-header page-header-default">
        @section('breadcrumb')
            <div class="breadcrumb-line">
                <ul class="breadcrumb">
                    <li><a href="{{route('admin.home')}}"><i
                                class="icon-home2 position-left"></i> @lang('messages.home')</a>
                    </li>
                    <li><a href="{{ route('auctions.index') }}"><i
                                class="icon-admin position-left"></i> @lang('messages.auction.auctions')</a></li>
                    <li class="active">@lang('messages.auction.show')</li>
                </ul>
                @include('Dashboard.layouts.parts.quick-links')
            </div>
        @endsection
    </div>
    <!-- /page header -->

    @include('Dashboard.layouts.parts.validation_errors')

    <!-- Cover area -->
    <div class="profile-cover">
        <div class="profile-cover-img" style="background-image: url({{ $auction->first_image_path }})"></div>
        <div class="media">
            <div class="media-left">
                <a href="#" class="profile-thumb">
                    <img src="{{ $auction->first_image_path }}" class="img-circle" alt="">
                </a>
            </div>
            <div class="media-body">
                <h1>{{ trans('messages.auction.name') }} : {{ $auction->$name }} <small class="display-block">UX/UI
                        designer</small></h1>
            </div>

            <div class="media-right media-middle">
                                <ul class="list-inline list-inline-condensed no-margin-bottom text-nowrap">
                                    <li><a href="#" class="btn btn-default"><i class="icon-file-picture position-left"></i> Cover image</a></li>
                                    <li><a href="#" class="btn btn-default"><i class="icon-file-stats position-left"></i> Statistics</a></li>
                                </ul>
            </div>
        </div>
    </div>
    <!-- /cover area -->


    <!-- Toolbar -->
    <div class="navbar navbar-default navbar-xs content-group">

        <ul class="nav navbar-nav visible-xs-block">
            <li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i
                        class="icon-menu7"></i></a></li>
        </ul>

        <div class="navbar-collapse collapse" id="navbar-filter">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#activity" data-toggle="tab"><i
                            class="icon-menu7 position-left"></i> {{ trans('messages.auction.auction_data') }}</a></li>
                <li><a href="#auction_options" data-toggle="tab"><i
                            class="icon-menu7 position-left"></i> {{ trans('messages.auction.options') }}</a></li>
                <li><a href="#auction_images" data-toggle="tab"><i
                            class="icon-calendar3 position-left"></i> {{ trans('messages.auction.images') }} <span
                            class="badge badge-success badge-inline position-right">{{$images->count()}}</span></a></li>
                <li><a href="#auction_bids" data-toggle="tab"><i
                            class="icon-calendar3 position-left"></i> {{ trans('messages.auction.bids') }} <span
                            class="badge badge-success badge-inline position-right">{{$auction_bids->count()}}</span></a></li>
                <li><a href="#settings" data-toggle="tab"><i class="icon-cog3 position-left"></i> Settings</a></li>
            </ul>
        </div>
    </div>
    <!-- /toolbar -->


    <!-- Content area -->
    <div class="content">
        <!-- User profile -->
        <div class="row">
            <div class="col-lg-9">
                <div class="tabbable">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="activity">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;">
                                        <div class="panel-heading">
                                            <!-- Basic layout-->
                                            <div class="card">
                                                <div class="card-header header-elements-inline">
                                                    <h5 class="card-title">{{ trans('messages.auction.auction_data') }}</h5>
                                                </div><br><br>
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-lg-4">{{ trans('messages.auction.name')}}:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" name="" value="{{ $auction->$name }}" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-lg-4">{{ trans('messages.description')}}:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text"  value="{{ $auction->$description }}" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-lg-4">{{ trans('messages.category.category') }}:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text"  value="{{ $auction->category['name_' . app()->getLocale()] }}" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-lg-4">{{ trans('messages.auction.seller') }}:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text"  value="{{ $auction->seller->full_name }}" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-lg-4">{{ trans('messages.auction.start_date') }}:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text"  value="{{ $auction->start_date }}" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-lg-4">{{ trans('messages.auction.end_date') }}:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text"  value="{{ $auction->end_date }}" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-lg-4">{{ trans('messages.since') }}:</label>
                                                        <div class="col-lg-8">
                                                            <input type="text"  value="{{ $auction->created_at->diffforHumans() }}" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /basic layout -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="auction_options">
                            <!-- auction_images -->
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

                                    <a href="#" data-toggle="modal" data-target="#add_options"
                                       class="btn btn-success btn-labeled btn-labeled-left"><b><i
                                                class="icon-plus2"></i></b>{{ trans('messages.option.add') }}
                                    </a>
                                    @if($auction_option_details->count() > 0)
                                        <table class="table datatable-basic" id="auction_option_details" style="font-size: 16px;">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th class="text-center"><h3>{{ trans('messages.auction.option') }}:</h3></th>
                                                <th class="text-center"><h3>{{ trans('messages.auction.option_detail') }}:</h3></th>
                                                <th class="text-center">@lang('messages.form-actions')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($auction_option_details as $option_detail)
                                                <tr id="auction_option_detail-row-{{ $option_detail->id }}">
                                                    <td>{{ $option_detail->id }}</td>
                                                    <td class="text-center">{{isNullable( $option_detail->option->$name) }}</td>
                                                    <td class="text-center">{{( $option_detail->option_detail->$value) }}</td>
                                                    <td class="text-center">
                                                        <div class="list-icons text-center">
                                                            <div class="list-icons-item dropdown text-center">
                                                                <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">
                                                                    <i class="icon-menu9"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-{{ floating('right', 'left') }}">
                                                                    <li>
                                                                        <a data-id="{{ $option_detail->id }}" class="delete_auction_data"
                                                                           href="{{ Url('/auction_data/auction_data/'.$option_detail->id) }}">
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
                                    @else
                                        <center><h3> @lang('messages.no_data_found') </h3></center>
                                    @endif
                                </div>
                            </div>
                            <!-- /auction_images -->
                        </div>
                        <div class="tab-pane fade" id="auction_images">
                            <!-- auction_images -->
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
                                    @if($images->count() > 0)
                                    <table class="table datatable" id="images" style="font-size: 16px;">
                                        <thead>
                                        <tr>
                                            <th class="text-center"><h3>{{ trans('messages.auction.images') }} : </h3></th>
                                            <th class="text-center">@lang('messages.form-actions')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($images as $image)
                                            <tr id="image-row-{{ $image->id }}">
                                                <td>
                                                    <a href="{{asset($image->ImagePath) }}" data-popup="lightbox">
                                                        <img src="{{asset($image->ImagePath) }}" alt="" width="80" height="70" class="img-preview rounded">
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    <ul class="icons-list">
                                                        <li class="dropdown">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu9"></i></a>
                                                            <ul class="dropdown-menu dropdown-menu-{{ floating('right', 'left') }}">
                                                                <li>
                                                                    <a data-id="{{ $image->id }}" class="delete-action" href="{{ Url('/image/image/'.$image->id) }}">
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
                                        <center><h3> @lang('messages.no_data_found') </h3></center>
                                    @endif
                                </div>

                            </div>
                            <!-- /auction_images -->
                        </div>
                        <div class="tab-pane fade" id="auction_bids">
                            <!-- auction_bids -->
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
                                    @if($auction_bids->count() > 0)
                                    <table class="table table-striped table-dark datatable" id="auction_bids" style="font-size: 16px;">
                                        <thead class="table-dark">
                                        <tr>
                                            <th class="text-center"><h3>{{ trans('messages.auction.buyer') }} : </h3></th>
                                            <th class="text-center"><h3>{{ trans('messages.auction.buyer_offer') }} : </h3></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                              @foreach($auction_bids as $auction_bids)
                                                  <tr id="auction_bids-row-{{ $auction_bids->id }}">
                                                        <td>
                                                            {{$auction_bids->buyer->full_name}}
                                                        </td>
                                                        <td>
                                                            {{$auction_bids->buyer_offer}} / ريال- سعودي
                                                        </td>
                                                   </tr>
                                              @endforeach
                                        </tbody>
                                    </table>
                                    @else
                                        <center><h3> @lang('messages.no_data_found') </h3></center>
                                    @endif
                                </div>

                            </div>
                            <!-- /auction_auction_bidss -->
                        </div>
                        <div class="tab-pane fade" id="settings">

{{--                            <!-- Profile info -->--}}
{{--                            <div class="panel panel-flat">--}}
{{--                                <div class="panel-heading">--}}
{{--                                    <h6 class="panel-title">Profile information</h6>--}}
{{--                                    <div class="heading-elements">--}}
{{--                                        <ul class="icons-list">--}}
{{--                                            <li><a data-action="collapse"></a></li>--}}
{{--                                            <li><a data-action="reload"></a></li>--}}
{{--                                            <li><a data-action="close"></a></li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="panel-body">--}}
{{--                                    <form action="#">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col-md-6">--}}
{{--                                                    <label>Username</label>--}}
{{--                                                    <input type="text" value="Eugene" class="form-control">--}}
{{--                                                </div>--}}
{{--                                                <div class="col-md-6">--}}
{{--                                                    <label>Full name</label>--}}
{{--                                                    <input type="text" value="Kopyov" class="form-control">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="form-group">--}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col-md-6">--}}
{{--                                                    <label>Address line 1</label>--}}
{{--                                                    <input type="text" value="Ring street 12" class="form-control">--}}
{{--                                                </div>--}}
{{--                                                <div class="col-md-6">--}}
{{--                                                    <label>Address line 2</label>--}}
{{--                                                    <input type="text" value="building D, flat #67"--}}
{{--                                                           class="form-control">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="form-group">--}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col-md-4">--}}
{{--                                                    <label>City</label>--}}
{{--                                                    <input type="text" value="Munich" class="form-control">--}}
{{--                                                </div>--}}
{{--                                                <div class="col-md-4">--}}
{{--                                                    <label>State/Province</label>--}}
{{--                                                    <input type="text" value="Bayern" class="form-control">--}}
{{--                                                </div>--}}
{{--                                                <div class="col-md-4">--}}
{{--                                                    <label>ZIP code</label>--}}
{{--                                                    <input type="text" value="1031" class="form-control">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="form-group">--}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col-md-6">--}}
{{--                                                    <label>Email</label>--}}
{{--                                                    <input type="text" readonly="readonly" value="eugene@kopyov.com"--}}
{{--                                                           class="form-control">--}}
{{--                                                </div>--}}
{{--                                                <div class="col-md-6">--}}
{{--                                                    <label>Your country</label>--}}
{{--                                                    <select class="select">--}}
{{--                                                        <option value="germany" selected="selected">Germany</option>--}}
{{--                                                        <option value="france">France</option>--}}
{{--                                                        <option value="spain">Spain</option>--}}
{{--                                                        <option value="netherlands">Netherlands</option>--}}
{{--                                                        <option value="other">...</option>--}}
{{--                                                        <option value="uk">United Kingdom</option>--}}
{{--                                                    </select>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="form-group">--}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col-md-6">--}}
{{--                                                    <label>Phone #</label>--}}
{{--                                                    <input type="text" value="+99-99-9999-9999" class="form-control">--}}
{{--                                                    <span class="help-block">+99-99-9999-9999</span>--}}
{{--                                                </div>--}}

{{--                                                <div class="col-md-6">--}}
{{--                                                    <label class="display-block">Upload profile image</label>--}}
{{--                                                    <input type="file" class="file-styled">--}}
{{--                                                    <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="text-right">--}}
{{--                                            <button type="submit" class="btn btn-primary">Save <i--}}
{{--                                                    class="icon-arrow-left13 position-right"></i></button>--}}
{{--                                        </div>--}}
{{--                                    </form>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!-- /profile info -->--}}
{{--                            <!-- Account settings -->--}}
{{--                            <div class="panel panel-flat">--}}
{{--                                <div class="panel-heading">--}}
{{--                                    <h6 class="panel-title">Account settings</h6>--}}
{{--                                    <div class="heading-elements">--}}
{{--                                        <ul class="icons-list">--}}
{{--                                            <li><a data-action="collapse"></a></li>--}}
{{--                                            <li><a data-action="reload"></a></li>--}}
{{--                                            <li><a data-action="close"></a></li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="panel-body">--}}
{{--                                    <form action="#">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col-md-6">--}}
{{--                                                    <label>Username</label>--}}
{{--                                                    <input type="text" value="Kopyov" readonly="readonly"--}}
{{--                                                           class="form-control">--}}
{{--                                                </div>--}}

{{--                                                <div class="col-md-6">--}}
{{--                                                    <label>Current password</label>--}}
{{--                                                    <input type="password" value="password" readonly="readonly"--}}
{{--                                                           class="form-control">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="form-group">--}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col-md-6">--}}
{{--                                                    <label>New password</label>--}}
{{--                                                    <input type="password" placeholder="Enter new password"--}}
{{--                                                           class="form-control">--}}
{{--                                                </div>--}}

{{--                                                <div class="col-md-6">--}}
{{--                                                    <label>Repeat password</label>--}}
{{--                                                    <input type="password" placeholder="Repeat new password"--}}
{{--                                                           class="form-control">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="form-group">--}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col-md-6">--}}
{{--                                                    <label>Profile visibility</label>--}}

{{--                                                    <div class="radio">--}}
{{--                                                        <label>--}}
{{--                                                            <input type="radio" name="visibility" class="styled"--}}
{{--                                                                   checked="checked">--}}
{{--                                                            Visible to everyone--}}
{{--                                                        </label>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="radio">--}}
{{--                                                        <label>--}}
{{--                                                            <input type="radio" name="visibility" class="styled">--}}
{{--                                                            Visible to friends only--}}
{{--                                                        </label>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="radio">--}}
{{--                                                        <label>--}}
{{--                                                            <input type="radio" name="visibility" class="styled">--}}
{{--                                                            Visible to my connections only--}}
{{--                                                        </label>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="radio">--}}
{{--                                                        <label>--}}
{{--                                                            <input type="radio" name="visibility" class="styled">--}}
{{--                                                            Visible to my colleagues only--}}
{{--                                                        </label>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

{{--                                                <div class="col-md-6">--}}
{{--                                                    <label>Notifications</label>--}}

{{--                                                    <div class="checkbox">--}}
{{--                                                        <label>--}}
{{--                                                            <input type="checkbox" class="styled" checked="checked">--}}
{{--                                                            Password expiration notification--}}
{{--                                                        </label>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="checkbox">--}}
{{--                                                        <label>--}}
{{--                                                            <input type="checkbox" class="styled" checked="checked">--}}
{{--                                                            New message notification--}}
{{--                                                        </label>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="checkbox">--}}
{{--                                                        <label>--}}
{{--                                                            <input type="checkbox" class="styled" checked="checked">--}}
{{--                                                            New task notification--}}
{{--                                                        </label>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="checkbox">--}}
{{--                                                        <label>--}}
{{--                                                            <input type="checkbox" class="styled">--}}
{{--                                                            New contact request notification--}}
{{--                                                        </label>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="text-right">--}}
{{--                                            <button type="submit" class="btn btn-primary">Save <i--}}
{{--                                                    class="icon-arrow-left13 position-right"></i></button>--}}
{{--                                        </div>--}}
{{--                                    </form>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!-- /account settings -->--}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('Dashboard.Auctions.option_modal')
    </div>

@stop

@section('scripts')
{{--    @include('Dashboard.Auctions.delete_auction_data')--}}


<script>
    // delete auction one auction image
    $('a.delete-action').on('click', function (e) {
        var id = $(this).data('id');
        var tbody = $('table#images tbody');
        var count = tbody.data('count');

        e.preventDefault();

        swal({
            title: "هل انت متأكد من حذف هذه الصورة ",
            // text: "سيتم الحذف بالانتقال لسلة المهملات",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    var tbody = $('table#auctionimages tbody');
                    var count = tbody.data('count');

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('ajax-delete-image') }}',
                        data: {id: id},
                        success: function (response) {
                            if (response.deleteStatus) {
                                // $('#post-row-'+id).fadeOut(); count = count - 1;tbody.attr('data-count', count);
                                $('#image-row-' + id).remove();
                                count = count - 1;
                                tbody.attr('data-count', count);
                                swal(response.message, {icon: "success"});
                            } else {
                                swal(response.error);
                            }
                        },
                        error: function (x) {
                            crud_handle_server_errors(x);
                        },
                        complete: function () {
                            if (count == 1) tbody.append(`<tr><td colspan="5"><strong>No data available in table</strong></td></tr>`);
                        }
                    });
                } else {
                    swal("تم الغاء العمليه");
                }
            });
    });
</script>


{{--// delete auction option_detail--}}
<script>

    $('a.delete_auction_data').on('click', function (e) {
        var id = $(this).data('id');
        var tbody = $('table#auction_option_details tbody');
        var count = tbody.data('count');

        e.preventDefault();
        swal({
            title: "هل انت متأكد من حذف هذه التصنيف ",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    var tbody = $('table#auction_option_details tbody');
                    var count = tbody.data('count');

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('ajax-delete-auction_data') }}',
                        data: {id: id},
                        success: function (response) {
                            if (response.deleteStatus) {
                                // $('#post-row-'+id).fadeOut(); count = count - 1;tbody.attr('data-count', count);
                                $('#auction_option_detail-row-' + id).remove();
                                count = count - 1;
                                tbody.attr('data-count', count);
                                swal(response.message, {icon: "success"});
                            } else {
                                swal(response.error);
                            }
                        },
                        error: function (x) {
                            crud_handle_server_errors(x);
                        },
                        complete: function () {
                            if (count == 1) tbody.append(`<tr><td colspan="5"><strong>No data available in table</strong></td></tr>`);
                        }
                    });
                } else {
                    swal("تم الغاء العمليه");
                }
            });
    });

</script>
@stop


