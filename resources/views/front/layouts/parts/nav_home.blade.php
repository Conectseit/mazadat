<main class="categories-bar" dir="{{ direction() }}">
    {{--    @inject('auctions', 'App\Models\Auction')--}}
    <div class="container">
        <div class="row">
            <div class=" d-flex justify-content-between">
                @if(auth()->check())
                    @if(auth()->user()->is_verified==1)
                        <a href="{{route('front.show_add_auction')}}" class="add-auction btn "><b>
                                <i class="fal fa-plus-circle"></i> </b>{{ trans('messages.auction.add') }}</a>
                    @endif
                @endif
                <a href="{{route('front.all_companies')}}" class="add-auction btn"><b>
                        <i class="fal fa-gavel"></i> </b>{{ trans('messages.company.companies_auctions') }}</a>
            </div>
        </div>
    </div>
</main>


