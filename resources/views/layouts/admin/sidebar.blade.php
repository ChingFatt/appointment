<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="content-header bg-white-5">
        <!-- Logo -->
        <a class="font-w600 text-dual" href="/">
            <span class="smini-visible text-center">
                {{ substr(config('app.name', 'Laravel'), 0, 1) }}
            </span>
            <span class="smini-hide font-size-h5 tracking-wider">
                {{ config('app.name', 'Laravel') }}
            </span>
        </a>
        <!-- END Logo -->
    </div>
    <!-- END Side Header -->

    <!-- Sidebar Scrolling -->
    <div class="js-sidebar-scroll">
        <!-- Side Navigation -->
        <div class="content-side">
            <ul class="nav-main">
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('admin/dashboard*') ? ' active' : '' }}" href="/admin/dashboard">
                        <i class="nav-main-link-icon si si-cursor"></i>
                        <span class="nav-main-link-name text-capitalize">Dashboard</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                        <i class="nav-main-link-icon si si-cursor"></i>
                        <span class="nav-main-link-name">Appointments</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('admin/calendar*') ? ' active' : '' }}" href="{{ route('admin.calendar') }}">
                                <span class="nav-main-link-name">Calendar</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('admin/appointment*') ? ' active' : '' }}" href="{{ route('admin.appointment.index') }}">
                                <span class="nav-main-link-name">Listing</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @role('merchant')
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('admin/merchant*') ? ' active' : '' }}" href="{{ route('admin.merchant.show', Auth::user()->merchant_id) }}">
                        <i class="nav-main-link-icon si si-cursor"></i>
                        <span class="nav-main-link-name text-capitalize">Merchant</span>
                    </a>
                </li>
                @endrole
                @role('admin')
                <li class="nav-main-heading">Setting</li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('admin/industry*') ? ' active' : '' }}" href="{{ route('admin.industry.index') }}">
                        <i class="nav-main-link-icon si si-cursor"></i>
                        <span class="nav-main-link-name text-capitalize">Industries</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('admin/merchant*') ? ' active' : '' }}" href="{{ route('admin.merchant.index') }}">
                        <i class="nav-main-link-icon si si-cursor"></i>
                        <span class="nav-main-link-name text-capitalize">Merchants</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('admin/outlet*') ? ' active' : '' }}" href="{{ route('admin.outlet.index') }}">
                        <i class="nav-main-link-icon si si-cursor"></i>
                        <span class="nav-main-link-name text-capitalize">Outlets</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('admin/user*') ? ' active' : '' }}" href="{{ route('admin.user.index') }}">
                        <i class="nav-main-link-icon si si-cursor"></i>
                        <span class="nav-main-link-name text-capitalize">Users</span>
                    </a>
                </li>
                @endrole
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- END Sidebar Scrolling -->
</nav>