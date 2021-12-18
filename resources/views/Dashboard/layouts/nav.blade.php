
<!-- Main navbar -->
<div class="navbar-header navbar-dark  navbar-{{ floating('left', 'right') }}">
    <a class="navbar-brand" href=""><img src="{{ asset('Dashboard/assets/images/logo_light.png') }}" alt="logo"></a>

    <ul class="nav navbar-nav visible-xs-block">
        <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
        <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
    </ul>
</div>

<div class="navbar-collapse collapse" id="navbar-mobile">
    <ul class="nav navbar-nav">
        <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a>
        </li>
    </ul>
    <div class="navbar-{{ floating('right','left') }}">
        <ul class="nav navbar-nav" style="float: {{ floating('right','left') }};">
            <li class="dropdown language-switch">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    @php
                        $lang = app()->isLocale('ar') ? 'sa' : 'gb';
                    @endphp
                    <img src="{{ asset('Dashboard/assets/images/flags/'.$lang.'.png') }}" alt="">
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ isLocalized("en") }}" class="english">
                            <img src="{{ asset('Dashboard/assets/images/flags/gb.png') }}" alt="">
                            English
                        </a>
                    </li>
                    <li>
                        <a href="{{ isLocalized("ar") }}" class="arabic">
                            <img src="{{ asset('Dashboard/assets/images/flags/sa.png') }}" alt="">
                            العربية
                        </a>
                    </li>
                </ul>
            </li>
        </ul>


        {{--when authinticate--}}
        @if(auth()->guard('admin')->check())
                            <p class="navbar-text" dir="{{ direction() }}">@lang('messages.welcome') {{auth()->guard('admin')->user()->full_name}}!</p>
            <p class="navbar-text"><span class="label bg-success-400">@lang('messages.online')</span></p>
            <p class="navbar-text">
                <a href="{{ route('admin.logout') }}"
                   onclick="event.preventDefault();document.getElementById('logout-form-1').submit();">
                    <i class="icon-switch2" style="color: rgba(255,255,255,.9);"></i>
                </a>

            <form id="logout-form-1" action="{{ route('admin.logout') }}" method="post"
                  style="display: none;">
                <form id="logout-form-1" action="" method="post" style="display: none;">
                    @csrf
                </form>
            </form>
            </p>
        @endif
    </div>

    <div class="navbar-right">
{{--                    <p class="navbar-text">Morning, Victoria!</p>--}}
{{--                    <p class="navbar-text"><span class="label bg-success-400">Online</span></p>--}}
    </div>
</div>

<!-- /main navbar -->
