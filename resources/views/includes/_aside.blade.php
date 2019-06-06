<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{url('AdminDesign')}}/uploads/admins/{{ $admin->file->file_name }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->guard('admin')->user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i>  @lang('admin.online')</a>
            </div>
        </div>
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="@lang('admin.search')">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">@lang('admin.main_navigation')</li>
            <li class="treeview">
                <a href="{{ route('admin.index') }}">
                    <i class="fa fa-dashboard"></i> <span>@lang('admin.main')</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i> <span>@lang('admin.admins')</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @if(auth()->guard('admin')->user()->can('read_admins'))
                    <li class="active"><a href="{{ route('admins.index') }}"><i class="fa fa-users"></i> @lang('admin.admins')</a></li>
                    @endif
                    @if(auth()->guard('admin')->user()->can('add_admins'))
                        <li><a href="{{ route('admins.create') }}"><i class="fa fa-plus"></i> @lang('admin.create_admin')</a></li>
                    @endif
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i> <span>@lang('admin.users')</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @if(auth()->guard('admin')->user()->can('read_users'))
                        <li class="active"><a href="{{ route('users.index') }}"><i class="fa fa-users"></i> @lang('admin.users')</a></li>
                    @endif
                    @if(auth()->guard('admin')->user()->can('add_users'))
                        <li><a href="{{ route('users.create') }}"><i class="fa fa-plus"></i> @lang('admin.create_user')</a></li>
                    @endif
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-flag-o"></i> <span>@lang('admin.countries')</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @if(auth()->guard('admin')->user()->can('read_countries'))
                        <li class="active"><a href="{{ route('countries.index') }}"><i class="fa fa-flag-o"></i> @lang('admin.countries')</a></li>
                    @endif
                    @if(auth()->guard('admin')->user()->can('add_countries'))
                        <li><a href="{{ route('countries.create') }}"><i class="fa fa-plus"></i> @lang('admin.create_country')</a></li>
                    @endif
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-list"></i> <span>@lang('admin.categories')</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @if(auth()->guard('admin')->user()->can('read_categories'))
                        <li class="active"><a href="{{ route('categories.index') }}"><i class="fa fa-list"></i> @lang('admin.categories')</a></li>
                    @endif
                    @if(auth()->guard('admin')->user()->can('add_categories'))
                        <li><a href="{{ route('categories.create') }}"><i class="fa fa-plus"></i> @lang('admin.create_category')</a></li>
                    @endif
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-adjust"></i> <span>@lang('admin.ads')</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @if(auth()->guard('admin')->user()->can('read_ads'))
                        <li class="active"><a href="{{ route('ads.index') }}"><i class="fa fa-adjust"></i> @lang('admin.ads')</a></li>
                    @endif
                    @if(auth()->guard('admin')->user()->can('add_ads'))
                        <li><a href="{{ route('ads.create') }}"><i class="fa fa-plus"></i> @lang('admin.create_ad')</a></li>
                    @endif
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-newspaper-o"></i> <span>@lang('admin.news')</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @if(auth()->guard('admin')->user()->can('read_news'))
                        <li class="active"><a href="{{ route('news.index') }}"><i class="fa fa-newspaper-o"></i> @lang('admin.news')</a></li>
                    @endif
                    @if(auth()->guard('admin')->user()->can('add_news'))
                        <li><a href="{{ route('news.create') }}"><i class="fa fa-plus"></i> @lang('admin.create_new')</a></li>
                    @endif
                </ul>
            </li>
            <li class="treeview">
                <a href="{{ route('settings') }}">
                    <i class="fa fa-gears"></i> <span>@lang('admin.settings')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>
