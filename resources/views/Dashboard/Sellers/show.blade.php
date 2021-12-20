@extends('Dashboard.layouts.master')

@section('title', trans('messages.seller.sellers'))

@section('content')



    <!-- Page header -->
    <div class="page-header page-header-default">
        @section('breadcrumb')
            <div class="breadcrumb-line">
                <ul class="breadcrumb">
                    <li><a href="{{route('admin.home')}}"><i
                                class="icon-home2 position-left"></i> @lang('messages.home')</a>
                    </li>
                    <li><a href="{{ route('sellers.index') }}"><i
                                class="icon-admin position-left"></i> @lang('messages.seller.sellers')</a></li>
                    <li class="active">@lang('messages.seller.show')</li>
                </ul>

                @include('Dashboard.layouts.parts.quick-links')
            </div>
        @endsection
    </div>
    <!-- /page header -->

    <!-- Toolbar -->
    <div class="navbar navbar-default navbar-xs content-group">
        <ul class="nav navbar-nav visible-xs-block">
            <li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i
                        class="icon-menu7"></i></a></li>
        </ul>

        <div class="navbar-collapse collapse" id="navbar-filter">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#seller_data" data-toggle="tab"><i
                            class="icon-menu7 position-left"></i> {{ trans('messages.seller.seller_data') }}</a></li>
                <li><a href="#seller_auctions" data-toggle="tab"><i
                            class="icon-calendar3 position-left"></i> {{ trans('messages.seller.seller_auctions') }}
                        <span
                            class="badge badge-success badge-inline position-right">{{$seller->seller_auctions->count()}}</span></a>
                </li>
                <li><a href="#settings" data-toggle="tab"><i class="icon-cog3 position-left"></i> Settings</a></li>
            </ul>


        </div>
    </div>
    <!-- /toolbar -->
    <!-- Content area -->
    <div class="content" dir="{{ direction() }}">

        <!-- User profile -->
        <div class="row">
            <div class="col-lg-9">
                <div class="tabbable">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="seller_data">

                            <!-- seller_data -->
                            <div class="timeline timeline-left content-group">
                                <div class="timeline-container">
                                    <!-- Sales stats -->
                                    <div class="timeline-row">
                                        <div class="panel panel-flat timeline-content">
                                            <div class="panel-heading">
                                                <div class="card">
                                                    {{--                                                    <div class="card-header header-elements-inline">--}}
                                                    {{--                                                        <h5 class="card-title">{{ trans('messages.seller.seller_data') }}</h5>--}}
                                                    {{--                                                    </div>--}}
                                                    <div class="card-body">
                                                        <form action="#">
                                                            <div class="form-group row">
                                                                <div class="col-md-6">
                                                                    <label
                                                                        class="col-form-label">{{ trans('messages.seller.full_name') }}
                                                                        :</label>
                                                                    <input type="text" value="{{ $seller->full_name }}"
                                                                           class="form-control"
                                                                           placeholder="{{ trans('messages.sellers.full_name') }}"
                                                                           readonly>
                                                                </div>

                                                            </div>

                                                            <div class="form-group row">
                                                                <div class="col-md-6">
                                                                    <label
                                                                        class="col-form-label">{{ trans('messages.since') }}
                                                                        :</label>
                                                                    <input type="text"
                                                                           value="{{ $seller->created_at->diffforHumans() }}"
                                                                           class="form-control" readonly>
                                                                </div>

                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /sales stats -->
                                </div>
                            </div>
                            <!-- /seller_data -->

                        </div>
                        <div class="tab-pane fade" id="seller_auctions">

                            <!-- Seller_auctions -->
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
                                    <!-- Palette colors -->
                                    <h6 class="content-group-sm text-semibold">
                                        {{__('messages.seller.full_name')}}
                                        <small class="display-block">{{$seller->full_name}}</small>
                                    </h6>

                                    <div class="row">
                                        @foreach($seller_auctions as $seller_auction)
                                            <div class="col-sm-4 col-lg-2">
                                                <div class="panel">
                                                    <div class="bg-info-800 demo-color">
                                                        <span>{{$seller_auction->$name}}</span></div>

                                                    <div class="p-15">
                                                        <div class="media-body">
                                                            <strong>{{$seller_auction->start_auction_price}}
                                                                ريال</strong>
                                                            <div
                                                                class="text-muted mt-5">{{$seller_auction->value_of_increment}}
                                                                ريال
                                                            </div>
                                                        </div>

                                                        <div class="media-right">
                                                            <ul class="icons-list">
                                                                <li><a href="#" data-toggle="modal" data-target="#info_800"><i class="icon-three-bars"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <span class="badge  badge-pill" style="background-color: #00838F;">
                                                        <a href={{ route('auctions.show', $seller_auction->id) }}>{{__('messages.seller.show_auction_bids')}}</a>
                                                    </span>
                                                </div>
                                            </div>



                                            <!-- auction modal -->
                                            <div id="info_800" class="modal fade">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                &times;
                                                            </button>
                                                            <h5 class="modal-title">{{__('messages.description')}}:</h5>
                                                        </div>

                                                        <div class="modal-body">
                                                            {{$seller_auction->$description}}                                                        </div>

                                                        <div class="table-responsive content-group">
                                                            <table class="table">
                                                                <tr>
                                                                    <td>{{__('messages.auction.name')}}:</td>
                                                                    <td><code>{{$seller_auction->$name}}</code></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{{__('messages.auction.start_auction_price')}}
                                                                        :
                                                                    </td>
                                                                    <td>
                                                                        <code>{{$seller_auction->start_auction_price}}</code>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{{__('messages.auction.value_of_increment')}}:
                                                                    </td>
                                                                    <td>
                                                                        <code>.{{$seller_auction->value_of_increment}}</code>
                                                                    </td>
                                                                </tr>

                                                            </table>
                                                        </div>


                                                        <div class="modal-footer">

                                                            <div>
                                                                <span class="badge  badge-pill" style="background-color: #00838F;">
                                                                    <a href={{ route('auctions.show', $seller_auction->id) }}>{{__('messages.seller.show_auction_bids')}}</a>
                                                                </span>
                                                            </div>

                                                            <button type="button"
                                                                    class="btn btn-link btn-xs text-uppercase text-semibold"
                                                                    data-dismiss="modal">Close
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /auction modal -->
                                        @endforeach


                                    </div>
                                    <!-- /palette colors -->

                                </div>
                            </div>
                            <!-- /Seller_auctions -->

                        </div>
                        <div class="tab-pane fade" id="settings">

                            <!-- Profile info -->
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Profile information</h6>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>
                                            <li><a data-action="reload"></a></li>
                                            <li><a data-action="close"></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">
                                    <form action="#">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Username</label>
                                                    <input type="text" value="Eugene" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Full name</label>
                                                    <input type="text" value="Kopyov" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Address line 1</label>
                                                    <input type="text" value="Ring street 12" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Address line 2</label>
                                                    <input type="text" value="building D, flat #67"
                                                           class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>City</label>
                                                    <input type="text" value="Munich" class="form-control">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>State/Province</label>
                                                    <input type="text" value="Bayern" class="form-control">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>ZIP code</label>
                                                    <input type="text" value="1031" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Email</label>
                                                    <input type="text" readonly="readonly" value="eugene@kopyov.com"
                                                           class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Your country</label>
                                                    <select class="select">
                                                        <option value="germany" selected="selected">Germany</option>
                                                        <option value="france">France</option>
                                                        <option value="spain">Spain</option>
                                                        <option value="netherlands">Netherlands</option>
                                                        <option value="other">...</option>
                                                        <option value="uk">United Kingdom</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Phone #</label>
                                                    <input type="text" value="+99-99-9999-9999" class="form-control">
                                                    <span class="help-block">+99-99-9999-9999</span>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="display-block">Upload profile image</label>
                                                    <input type="file" class="file-styled">
                                                    <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">Save <i
                                                    class="icon-arrow-left13 position-right"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /profile info -->


                            <!-- Account settings -->
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Account settings</h6>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>
                                            <li><a data-action="reload"></a></li>
                                            <li><a data-action="close"></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">
                                    <form action="#">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Username</label>
                                                    <input type="text" value="Kopyov" readonly="readonly"
                                                           class="form-control">
                                                </div>

                                                <div class="col-md-6">
                                                    <label>Current password</label>
                                                    <input type="password" value="password" readonly="readonly"
                                                           class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>New password</label>
                                                    <input type="password" placeholder="Enter new password"
                                                           class="form-control">
                                                </div>

                                                <div class="col-md-6">
                                                    <label>Repeat password</label>
                                                    <input type="password" placeholder="Repeat new password"
                                                           class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Profile visibility</label>

                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="visibility" class="styled"
                                                                   checked="checked">
                                                            Visible to everyone
                                                        </label>
                                                    </div>

                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="visibility" class="styled">
                                                            Visible to friends only
                                                        </label>
                                                    </div>

                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="visibility" class="styled">
                                                            Visible to my connections only
                                                        </label>
                                                    </div>

                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="visibility" class="styled">
                                                            Visible to my colleagues only
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <label>Notifications</label>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" class="styled" checked="checked">
                                                            Password expiration notification
                                                        </label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" class="styled" checked="checked">
                                                            New message notification
                                                        </label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" class="styled" checked="checked">
                                                            New task notification
                                                        </label>
                                                    </div>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" class="styled">
                                                            New contact request notification
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">Save <i
                                                    class="icon-arrow-left13 position-right"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /account settings -->

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

@stop

@section('scripts')
@stop
