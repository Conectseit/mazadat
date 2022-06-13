<ul class="navigation navigation-main navigation-accordion"style="font-family: Sans-Serif; background-color: #26A69A;">

    <!-- Main -->
    <li class="navigation-header"><span style="font-family: Sans-Serif; color: white">Main</span> <i class="icon-menu" title="Main pages"></i></li>
    <li class="active">
        <a href="{{route('admin.home')}}">
            <i class="icon-home4" ></i>
            <span  style="font-family: Sans-Serif;">{{ trans('messages.home') }}</span>
        </a>
    </li>
    <li >
        <a href="#">
            <i class="icon-people"></i>
            <span style="font-family: Sans-Serif; color: white">{{ trans('messages.person.persons') }} / {{ trans('messages.company.companies') }}</span></a>
        <ul>
            <li><a href="{{route('persons.index')}}">{{ trans('messages.person.persons') }}</a></li>
            <li><a href="{{route('companies.index')}}">{{ trans('messages.company.companies') }}</a></li>

        </ul>
    </li>

    <li>
        <a href="#"><i class="icon-stack2"></i>
            <span style="font-family: Sans-Serif; color: white">{{ trans('messages.auction.auctions') }}</span></a>
        <ul>
            <li><a href="{{route('auctions.index')}}">{{ trans('messages.all') }}</a></li>
            <li><a href="{{route('auctions.create')}}">{{ trans('messages.add') }}</a></li>

        </ul>
    </li>
    <li>
        <a href="#"><i class="icon-archive"></i>
            <span style="font-family: Sans-Serif; color: white"> {{ trans('messages.category.categories') }} </span></a>
        <ul>
            <li><a href="{{route('categories.index')}}">{{ trans('messages.all') }}</a></li>
            <li><a href="{{route('categories.create')}}"> {{ trans('messages.add') }}</a></li>
        </ul>
    </li>

    <li>
        <a href="#"><i class="icon-archive"></i>
            <span style="font-family: Sans-Serif; color: white"> {{ trans('messages.advertisement.advertisements') }} </span></a>
        <ul>
            <li><a href="{{route('advertisements.index')}}">{{ trans('messages.all') }}</a></li>
            <li><a href="{{route('advertisements.create')}}"> {{ trans('messages.add') }}</a></li>
        </ul>
    </li>

    <li>
        <a href="#"><i class="icon-archive"></i>
            <span style="font-family: Sans-Serif; color: white"> {{ trans('messages.nationality.nationalities') }} </span></a>
        <ul>
            <li><a href="{{route('nationalities.index')}}">{{ trans('messages.all') }}</a></li>
            <li><a href="{{route('nationalities.create')}}"> {{ trans('messages.add') }}</a></li>
        </ul>
    </li>

    <li>
        <a href="#"><i class="icon-archive"></i>
            <span style="font-family: Sans-Serif; color: white"> {{ trans('messages.country.countries') }} </span></a>
        <ul>
            <li><a href="{{route('countries.index')}}">{{ trans('messages.all') }}</a></li>
            <li><a href="{{route('countries.create')}}"> {{ trans('messages.add') }}</a></li>
        </ul>
    </li>

    <li>
        <a href="#"><i class="icon-archive"></i>
            <span style="font-family: Sans-Serif; color: white"> {{ trans('messages.city.cities') }} </span></a>
        <ul>
            <li><a href="{{route('cities.index')}}">{{ trans('messages.all') }}</a></li>
            <li><a href="{{route('cities.create')}}"> {{ trans('messages.add') }}</a></li>
        </ul>
    </li>
    <li>
        <a href="#"><i class="icon-archive"></i>
            <span style="font-family: Sans-Serif; color: white"> {{ trans('messages.message.messages') }} </span></a>
        <ul>
            <li><a href="{{route('messages.index')}}">{{ trans('messages.all') }}</a></li>
            <li><a href="{{route('messages.create')}}"> {{ trans('messages.add') }}</a></li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="{{ route('inspection_file_names.index') }}"
           class="nav-link {{ request()->route()->getName() == 'dashboard.inspection_file_names.index' ? 'active' : '' }}">
            <i class="icon-file-pdf"></i> <span style="font-family: Sans-Serif; color: white">{{ trans('messages.inspection_file_names') }}</span></a>
    </li>


    <li>
        <a href="#"><i class="icon-people"></i>
            <span style="font-family: Sans-Serif; color: white">{{ trans('messages.admin.admins') }}</span></a>
        <ul>
            <li><a href="{{route('admins.index')}}">{{ trans('messages.all') }}</a></li>
            <li><a href="{{route('admins.index')}}">{{ trans('messages.add') }}</a></li>

        </ul>
    </li>

    <li>
        <a href="#"><i class="icon-archive"></i>
            <span style="font-family: Sans-Serif; color: white"> {{ trans('messages.permission.permissions') }} </span></a>
        <ul>
            <li><a href="{{route('permissions.index')}}">{{ trans('messages.all') }}</a></li>
            <li><a href="{{route('permissions.create')}}"> {{ trans('messages.add') }}</a></li>
        </ul>
    </li>

    <li>
        <a href="#"><i class="icon-people"></i>
            <span style="font-family: Sans-Serif; color: white">{{ trans('messages.activity.activities') }}</span></a>
        <ul>
            <li><a href="{{route('activities.index')}}">{{ trans('messages.all') }}</a></li>

        </ul>
    </li>

    <li>
        <a href="#"><i class="icon-archive"></i>
            <span style="font-family: Sans-Serif; color: white"> {{ trans('messages.transaction.transactions') }} </span></a>
        <ul>
            <li><a href="{{ route('transactions.index')}}">{{ trans('messages.show') }}</a></li>
        </ul>
    </li>

    <li>
        <a href="#"><i class="icon-archive"></i>
            <span style="font-family: Sans-Serif; color: white"> {{ trans('messages.financial_reviews') }} </span></a>
        <ul>
            <li><a href="{{ route('financial_reviews.index')}}">{{ trans('messages.show') }}</a></li>
        </ul>
    </li>

    <li class="nav-item">
        <a href="{{ route('contacts.index') }}"
           class="nav-link {{ request()->route()->getName() == 'dashboard.contact.index' ? 'active' : '' }}">
            <i class="icon-comment-discussion"></i> <span style="font-family: Sans-Serif; color: white">{{ trans('messages.contact.contacts') }}</span></a>
    </li>

    <li>
        @inject('questions', 'App\Models\CommonQuestion')
        <a href="{{ route('questions.index') }}"><i class="icon-list-unordered"></i>
            <span style="font-family: Sans-Serif; color: white">{{trans('messages.question.questions')}}
                <span class="label bg-blue-400">{{$questions->count()}}</span>
            </span></a>
    </li>
    <li class="nav-item">
        <a href="{{ route('settings.index') }}"
           class="nav-link {{ request()->route()->getName() == 'dashboard.setting.index' ? 'active' : '' }}"><i
                class="icon-gear"></i>
            <span style="font-family: Sans-Serif; color: white">{{ trans('messages.settings.settings') }}</span></a>
    </li>
</ul>

{{--    <li>--}}
{{--        --}}{{--        <a href="#"><i class="icon-stack2"></i> <span style="float: {{ floating('left','right') }};">{{ trans('messages.users') }}</span></a>--}}
{{--        <a href="#"><i class="icon-people"></i> <span style="float: {{ floating('left','right') }};">{{ trans('messages.seller.sellers') }}</span></a>--}}
{{--        <ul>--}}
{{--            <li><a href="{{route('sellers.index')}}">{{ trans('messages.all') }}</a></li>--}}
{{--            <li><a href="{{route('sellers.create')}}">{{ trans('messages.add') }}</a></li>--}}
{{--        </ul>--}}
{{--    </li>--}}

{{--        <li><a href="../../RTL/default/index.html"><i class="icon-width"></i> <span style="font-family: Sans-Serif; color: white;">RTL version</span></a></li>--}}
<!-- /main -->


{{--    <li>--}}
{{--        <a href="#"><i class="icon-archive"></i> <span style="font-family: Sans-Serif; color: white;"> {{ trans('messages.option.options') }} </span></a>--}}
{{--        <ul>--}}
{{--            <li><a href="{{route('options.index')}}">{{ trans('messages.all') }}</a></li>--}}
{{--            <li><a href="{{route('options.create')}}"> {{ trans('messages.add') }}</a></li>--}}
{{--        </ul>--}}
{{--    </li>--}}
{{--    <li>--}}
{{--        <a href="#"><i class="icon-archive" style="float: {{ floating('right','left') }};"></i> <span style="font-family: Sans-Serif; color: white;"> {{ trans('messages.option.option_details') }} </span></a>--}}
{{--        <ul>--}}
{{--            <li><a href="{{route('option_details.index')}}">{{ trans('messages.all') }}</a></li>--}}
{{--        </ul>--}}
{{--    </li>--}}
