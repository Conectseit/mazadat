<ul class="breadcrumb-elements" style="float: {{ floating('left', 'right') }};position: relative;{{ floating('left', 'right') }}: 51px;">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="icon-gear position-left"></i>@lang('messages.quick_links')
            <span class="caret"></span>
        </a>

        <ul class="dropdown-menu dropdown-menu-right">
            <li><a href="{{ route('auctions.index') }}"><i class="icon-stack2"></i>{{trans('messages.auction.auctions')}}</a></li>
            <li><a href="{{ route('buyers.index') }}"><i class="icon-user-tie"></i>{{trans('messages.buyer.buyers')}}</a></li>
            <li><a href="{{ route('settings.index') }}"><i class="icon-gear"></i>{{ trans('messages.settings.settings') }}</a></li>

            {{--@if (auth()->user()->is_super_admin == 1)--}}
{{--                <li><a href="{{ route('client.create') }}"><i class="icon-user"></i> @lang('back.create-var',['var'=>trans('back.client')])</a></li>--}}
            {{--@endif--}}
        </ul>
    </li>
</ul>
