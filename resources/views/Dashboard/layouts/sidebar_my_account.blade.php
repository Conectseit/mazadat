<div class="category-content">
    <div class="sidebar-user-material-content">
        <a href="#">
{{--            <img src="{{asset('Dashboard/assets/images/placeholder.jpg')}}"--}}
            <img src="{{Auth::guard('admin')->user()->ImagePath}}"
                         class=" img-responsive" alt=""></a>
        <h6>{{Auth::guard('admin')->user()->full_name}}</h6>
        <span class="text-size-small">{{Auth::guard('admin')->user()->email}}</span>
    </div>

    <div class="sidebar-user-material-menu">
        <a href="#user-nav" data-toggle="collapse"><span>@lang('messages.my-account')</span> <i class="caret"></i></a>
    </div>
</div>

<div class="navigation-wrapper collapse" id="user-nav">
    <ul class="navigation">
        <li><a href="{{ route('admin.showProfile') }}"><i class="icon-user-plus"></i> <span>My profile</span></a></li>
{{--        <li><a href="#"><i class="icon-coins"></i> <span>My balance</span></a></li>--}}
{{--        <li><a href="#"><i class="icon-comment-discussion"></i> <span><span--}}
{{--                        class="badge bg-teal-400 pull-right">58</span> Messages</span></a></li>--}}
{{--        <li class="divider"></li>--}}
{{--        <li><a href="#"><i class="icon-cog5"></i> <span>Account settings</span></a></li>--}}
        <li><a href="{{ route('admin.logout') }}"><i class="icon-switch2"></i> <span>Logout</span></a></li>
    </ul>
</div>
