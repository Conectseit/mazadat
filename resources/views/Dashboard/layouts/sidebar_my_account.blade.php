<div class="category-content"style="background: #009688;">
    <div class="sidebar-user-material-content">
        <a href="#">
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
        <li><a href="{{ route('admin.logout') }}"><i class="icon-switch2"></i> <span>Logout</span></a></li>
    </ul>
</div>
