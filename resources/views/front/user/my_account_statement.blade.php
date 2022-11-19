@extends('front.layouts.master')
@section('title', trans('messages.user.my_auctions'))
@section('style')
    <style>

        @media print {
            head, footer {
                display: none;
            }
        }
    </style>
@endsection

@section('content')
    <main class="categories-bar row">
{{--        @include('front.layouts.parts.nav_categories')--}}
    </main>
    @include('front.layouts.parts.alert')

    <section class="watching-page" dir="{{ direction() }}">
        <div class="container">
            <h4 class="title">
                <a href="{{ route('front.my_profile') }}" class="mt-2 mx-1 back"> <i
                        class="fal fa-arrow-circle-{{ floating('right','left') }}" style="color: black;"></i> </a>
                {{ trans('messages.my_profile') }}
            </h4><br>
            <div class="row">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="profile-tab" data-bs-toggle="tab"
                                data-bs-target="#pending_auctions"
                                type="button" role="tab" aria-controls="profile"
                                aria-selected="false">{{ trans('messages.bids') }}</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link " id="home-tab" data-bs-toggle="tab"
                                data-bs-target="#on_progress_auctions"
                                type="button" role="tab" aria-controls="home"
                                aria-selected="true">{{ trans('messages.payment') }}</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="pending_auctions" role="tabpanel"
                         aria-labelledby="profile-tab"><br>
                        @if($person_bids->count() > 0)
                            <br>
                            <a href="" id="printme" target="_blank" class="btn btn-default printme"
                               style="background-color: var(--main-color); color: whitesmoke; margin-bottom: 30px; padding: 10px;"><i
                                    class="fa fa-print"></i> Print</a>
                            <table class="table table-striped table-dark datatable"
                                   id="auction_bids"
                                   style="font-size: 16px;">
                                <thead class="table-dark">
                                <tr>
                                    <th class="text-center">
                                        <h3>{{ trans('messages.auction.name') }}
                                            : </h3></th>
                                    <th class="text-center">
                                        <h3>{{ trans('messages.auction.buyer_offer') }}
                                            : </h3></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($person_bids as $bid)
                                    <tr id="auction_bids-row-{{ $bid->id }}">
                                        <td class="text-center">
                                            {{$bid->auction->$name}}
                                        </td>
                                        <td class="text-center">
                                            {{$bid->buyer_offer}} / ريال- سعودي
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <div style="text-align: center;">
                                <h3> @lang('messages.no_data_found') </h3></div>
                        @endif
                    </div>
                    <div class="tab-pane fade  " id="on_progress_auctions" role="tabpanel" aria-labelledby="home-tab">
                        <br>
                        <a href="" id="print_transactions" target="_blank" class="btn btn-default print_transactions"
                           style="background-color: var(--main-color); color: whitesmoke; margin-bottom: 30px; padding: 10px;"><i
                                class="fa fa-print"></i> Print</a>

                        <table class="table table-striped datatable-basic print_transactions"
                               id="transactions" style="font-size: 16px;">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">{{ trans('messages.transaction.payment_type') }}</th>
                                <th class="text-center">{{ trans('messages.transaction.amount') }}</th>
                                <th class="text-center">@lang('messages.transaction.date')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user->payments as $transaction)
                                <tr id="transaction-row-{{ $transaction->id }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        {{ isNullable($transaction->payment_type) }}</a>
                                    </td>
                                    <td class="text-center">
                                        {{ isNullable($transaction->amount) }}
                                    </td>
                                    <td class="text-center">{{isset($transaction->created_at) ?$transaction->created_at->format('y/m/d'):'---' }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </section>
@stop


@push('scripts')
    <script type="text/javascript" src="js/jquery.printPage.js"></script>
    <script>

        // document.getElementById("printme").onclick = function () {
        //     window.print();
        // };
        // document.getElementById("print_transactions").onclick = function () {
        //     window.print();
        // };




        $(".print_transactions").click(function (e) {
            e.preventDefault();
                window.print();
        });

        $(".printme").click(function (e) {
            e.preventDefault();
                window.print();
        });
    </script>


@endpush

