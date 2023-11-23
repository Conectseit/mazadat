<ul class="navigation navigation-main navigation-accordion" style="font-family: Sans-Serif; background-color: #26A69A;">

    <!-- Main -->
    <li class="navigation-header">
        <span style="font-family: Sans-Serif; color: black">Main</span>
        <i class="icon-menu" title="Main pages" style="color: #d1915c;"></i>
    </li>
    <li class="active">
        <a href="{{route('admin.home')}}" style="color: #d1915c;">
            <i class="icon-home4"></i>
            <span style="font-family: Sans-Serif;">{{ trans('messages.home') }}</span>
        </a>
    </li>

    @if(permission_route_checker('persons'.'.index') )
        <li>
            <a href="#" style="color: #d1915c;">
                <i class="icon-people"></i>
                <span style="font-family: Sans-Serif; color: black">{{ trans('messages.person.persons') }}
                    / {{ trans('messages.company.companies') }}</span>
            </a>
            <ul>
                <li>
                    <a href="{{route('persons.index')}}" style="font-family: Sans-Serif; color: black">
                        {{ trans('messages.person.persons') }}
                    </a>
                </li>
                <li>
                    <a href="{{route('companies.index')}}" style="font-family: Sans-Serif; color: black">
                        {{ trans('messages.company.companies') }}
                    </a>
                </li>

            </ul>
        </li>
    @endif
    @if(permission_route_checker('auctions'.'.index') )
        <li>
            <a href="#" style="color: #d1915c;">
                <i class="icon-stack2"></i>
                <span style="font-family: Sans-Serif; color: black">{{ trans('messages.auction.auctions') }}</span>
            </a>
            <ul>
                <li>
                    <a href="{{route('auctions.index')}}" style="font-family: Sans-Serif; color: black">
                        {{ trans('messages.all') }}
                    </a>
                </li>
                <li>
                    <a href="{{route('auctions.create')}}" style="font-family: Sans-Serif; color: black">
                        {{ trans('messages.add') }}
                    </a>
                </li>

            </ul>
        </li>
    @endif
    @if(permission_route_checker('categories'.'.index') )
        <li>
            <a href="#" style="color: #d1915c;">
                <i class="icon-archive"></i>
                <span style="font-family: Sans-Serif; color: black">
                    {{ trans('messages.category.categories') }}
                </span>
            </a>
            <ul>
                <li>
                    <a href="{{route('categories.index')}}" style="font-family: Sans-Serif; color: black">
                        {{ trans('messages.all') }}
                    </a>
                </li>
                <li>
                    <a href="{{route('categories.create')}}" style="font-family: Sans-Serif; color: black">
                        {{ trans('messages.add') }}
                    </a>
                </li>
            </ul>
        </li>
    @endif
    @if(permission_route_checker('advertisements'.'.index') )
        <li>
            <a href="#" style="color: #d1915c;">
                <i class="icon-dice"></i>
                <span style="font-family: Sans-Serif; color: black">
                    {{ trans('messages.advertisement.advertisements') }}
                </span>
            </a>
            <ul>
                <li>
                    <a href="{{route('advertisements.index')}}" style="font-family: Sans-Serif; color: black">
                        {{ trans('messages.all') }}
                    </a>
                </li>
                <li>
                    <a href="{{route('advertisements.create')}}" style="font-family: Sans-Serif; color: black">
                        {{ trans('messages.add') }}
                    </a>
                </li>
            </ul>
        </li>
    @endif

    @if(permission_route_checker('nationalities'.'.index') )
        <li>
            <a href="#" style="color: #d1915c;">
                <i class="icon-person"></i>
                <span style="font-family: Sans-Serif; color: black">
                    {{ trans('messages.nationality.nationalities') }}
                </span>
            </a>
            <ul>
                <li>
                    <a href="{{route('nationalities.index')}}" style="font-family: Sans-Serif; color: black">
                        {{ trans('messages.all') }}
                    </a>
                </li>
                <li>
                    <a href="{{route('nationalities.create')}}" style="font-family: Sans-Serif; color: black">
                        {{ trans('messages.add') }}
                    </a>
                </li>
            </ul>
        </li>
    @endif
    @if(permission_route_checker('countries'.'.index') )
        <li>
            <a href="#" style="color: #d1915c;">
                <i class="icon-earth"></i>
                <span style="font-family: Sans-Serif; color: black">
                    {{ trans('messages.country.countries') }}
                </span>
            </a>
            <ul>
                <li>
                    <a href="{{route('countries.index')}}" style="font-family: Sans-Serif; color: black">
                        {{ trans('messages.all') }}
                    </a>
                </li>
                <li>
                    <a href="{{route('countries.create')}}" style="font-family: Sans-Serif; color: black">
                        {{ trans('messages.add') }}
                    </a>
                </li>
            </ul>
        </li>
    @endif
    @if(permission_route_checker('cities'.'.index') )
        <li>
            <a href="#" style="color: #d1915c;">
                <i class="icon-city"></i>
                <span style="font-family: Sans-Serif; color: black">
                    {{ trans('messages.city.cities') }}
                </span>
            </a>
            <ul>
                <li>
                    <a href="{{route('cities.index')}}" style="font-family: Sans-Serif; color: black">
                        {{ trans('messages.all') }}
                    </a>
                </li>
                <li>
                    <a href="{{route('cities.create')}}" style="font-family: Sans-Serif; color: black">
                        {{ trans('messages.add') }}
                    </a>
                </li>
            </ul>
        </li>
    @endif
    @if(permission_route_checker('messages'.'.index') )
        <li>
            <a href="#" style="color: #d1915c;">
                <i class="icon-bubbles"></i>
                <span style="font-family: Sans-Serif; color: black">
                    {{ trans('messages.message.messages') }}
                </span>
            </a>
            <ul>
                <li>
                    <a href="{{route('messages.index')}}" style="font-family: Sans-Serif; color: black">
                        {{ trans('messages.all') }}
                    </a>
                </li>
                <li>
                    <a href="{{route('messages.create')}}" style="font-family: Sans-Serif; color: black">
                        {{ trans('messages.add') }}
                    </a>
                </li>
            </ul>
        </li>
    @endif
    @if(permission_route_checker('inspection_file_names'.'.index') )
        <li class="nav-item">
            <a href="{{ route('inspection_file_names.index') }}" style="color: #d1915c;"
               class="nav-link {{ request()->route()->getName() == 'dashboard.inspection_file_names.index' ? 'active' : '' }}">
                <i class="icon-file-pdf" ></i>
                <span style="font-family: Sans-Serif; color: black">
                    {{ trans('messages.auction.additional_file_names') }}
                </span>
            </a>
        </li>
    @endif
    @if(permission_route_checker('admins'.'.index') )
        <li>
            <a href="#" style="color: #d1915c;">
                <i class="icon-people"></i>
                <span style="font-family: Sans-Serif; color: black">
                    {{ trans('messages.admin.admins') }}
                </span>
            </a>
            <ul>
                <li>
                    <a href="{{route('admins.index')}}" style="font-family: Sans-Serif; color: black">
                        {{ trans('messages.all') }}
                    </a>
                </li>
                <li>
                    <a href="{{route('admins.index')}}" style="font-family: Sans-Serif; color: black">
                        {{ trans('messages.add') }}
                    </a>
                </li>

            </ul>
        </li>
    @endif
    @if(permission_route_checker('permissions'.'.index') )
        <li>
            <a href="#" style="color: #d1915c;">
                <i class="icon-eye-blocked" ></i>
                <span style="font-family: Sans-Serif; color: black">
                    {{ trans('messages.permission.permissions') }}
                </span>
            </a>
            <ul>
                <li>
                    <a href="{{route('permissions.index')}}" style="font-family: Sans-Serif; color: black">
                        {{ trans('messages.all') }}
                    </a>
                </li>
                <li>
                    <a href="{{route('permissions.create')}}" style="font-family: Sans-Serif; color: black">
                        {{ trans('messages.add') }}
                    </a>
                </li>
            </ul>
        </li>
    @endif
    @if(permission_route_checker('activities'.'.index') )
        <li>
            <a href="#" style="color: #d1915c;">
                <i class="icon-people"></i>
                <span style="font-family: Sans-Serif; color: black">
                    {{ trans('messages.activity.activities') }}
                </span>
            </a>
            <ul>
                <li>
                    <a href="{{route('activities.index')}}" style="font-family: Sans-Serif; color: black">
                        {{ trans('messages.all') }}
                    </a>
                </li>

            </ul>
        </li>
    @endif
    @if(permission_route_checker('transactions'.'.index') )
        <li>
            <a href="#" style="color: #d1915c;">
                <i class="icon-paypal" ></i>
                <span style="font-family: Sans-Serif; color: black">
                    {{ trans('messages.transaction.transactions') }}
                </span>
            </a>
            <ul>
                <li>
                    <a href="{{ route('transactions.index')}}" style="font-family: Sans-Serif; color: black">
                        {{ trans('messages.show') }}
                    </a>
                </li>
            </ul>
        </li>
    @endif
    @if(permission_route_checker('financial_reviews'.'.index') )
        <li>
            <a href="#" style="color: #d1915c;">
                <i class="icon-finder" ></i>
                <span style="font-family: Sans-Serif; color: black">
                    {{ trans('messages.financial_reviews') }} </span>
            </a>
            <ul>
                <li>
                    <a href="{{ route('financial_reviews.index')}}" style="font-family: Sans-Serif; color: black">
                        {{ trans('messages.show') }}
                    </a>
                </li>
            </ul>
        </li>
    @endif
    @if(permission_route_checker('blogs'.'.index') )
        <li>
            <a href="#" style="color: #d1915c;">
                <i class="icon-blog"></i>
                <span style="font-family: Sans-Serif; color: black"> {{ trans('messages.blog.blogs') }} </span></a>
            <ul>
                <li>
                    <a href="{{route('blogs.index')}}" style="font-family: Sans-Serif; color: black">
                        {{ trans('messages.all') }}
                    </a>
                </li>
                <li>
                    <a href="{{route('blogs.create')}}" style="font-family: Sans-Serif; color: black">
                        {{ trans('messages.add') }}
                    </a>
                </li>
            </ul>
        </li>
    @endif
    @if(permission_route_checker('pages'.'.index') )
        <li>
            <a href="#" style="color: #d1915c;">
                <i class="icon-page-break"></i>
                <span style="font-family: Sans-Serif; color: black">
                    {{ trans('messages.page.pages') }}
                </span>
            </a>
            <ul>
                <li>
                    <a href="{{route('pages.index')}}" style="font-family: Sans-Serif; color: black">
                        {{ trans('messages.all') }}
                    </a>
                </li>
                <li>
                    <a href="{{route('pages.create')}}" style="font-family: Sans-Serif; color: black">
                        {{ trans('messages.add') }}
                    </a>
                </li>
            </ul>
        </li>
    @endif
    @if(permission_route_checker('contacts'.'.index') )
        <li class="nav-item">
            <a href="{{ route('contacts.index') }}" style="color: #d1915c;"
               class="nav-link {{ request()->route()->getName() == 'dashboard.contact.index' ? 'active' : '' }}">
                <i class="icon-comment-discussion"></i>
                <span style="font-family: Sans-Serif; color: black">
                    {{ trans('messages.contact.contacts') }}
                </span>
            </a>
        </li>
    @endif
    @if(permission_route_checker('questions'.'.index') )
        <li>
            @inject('questions', 'App\Models\CommonQuestion')
            <a href="{{ route('questions.index') }}" style="color: #d1915c;">
                <i class="icon-list-unordered"></i>
                <span style="font-family: Sans-Serif; color: black">{{trans('messages.question.questions')}}
                    <span class="label bg-blue-400">{{$questions->count()}}</span>
                </span>
            </a>
        </li>
    @endif
    @if(permission_route_checker('settings'.'.index') )
        <li class="nav-item">
            <a href="{{ route('settings.index') }}" style="color: #d1915c;"
               class="nav-link {{ request()->route()->getName() == 'dashboard.setting.index' ? 'active' : '' }}">
                <i class="icon-gear"></i>
                <span style="font-family: Sans-Serif; color: black">
                    {{ trans('messages.settings.settings') }}
                </span>
            </a>
        </li>
    @endif


</ul>
