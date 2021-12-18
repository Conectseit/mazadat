<ul class="breadcrumb-elements" style="float: {{ floating('left', 'right') }};position: relative;{{ floating('left', 'right') }}: 51px;">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="icon-gear position-left"></i>@lang('back.quick-links')
            <span class="caret"></span>
        </a>

        <ul class="dropdown-menu dropdown-menu-right">
{{--            <li><a href="{{ route('client.index') }}"><i class="icon-user-tie"></i> @lang('back.display-all',['var'=>trans('back.clients')])</a></li>--}}

            {{--@if (auth()->user()->is_super_admin == 1)--}}
{{--                <li><a href="{{ route('client.create') }}"><i class="icon-user"></i> @lang('back.create-var',['var'=>trans('back.client')])</a></li>--}}
            {{--@endif--}}

            {{--<li>--}}
                {{--<a href="{{ route('categories.index') }}"><i class="icon-stack2"></i> @lang('back.display-all',['var'=>trans('back.categories')])</a>--}}
            {{--</li>--}}

            {{--<li>--}}
                {{--<a href="{{ route('categories.create') }}"><i class="icon-stack"></i> @lang('back.create-var',['var'=>trans('back.category')])</a>--}}
            {{--</li>--}}
        </ul>
    </li>
</ul>
