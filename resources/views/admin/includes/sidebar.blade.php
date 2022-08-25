<div class="sidebar">
    <div class="menu-bar">
        <nav class="nav flex-column">
            <a class="nav-link {{ Request::is('secure-admin/dashboard') ? 'active' : '' }}" aria-current="page" href="{{route('dashboard')}}"><i class="mdi mdi-view-dashboard"></i> Dashboard</a>
            <a class="nav-link {{ Request::is('secure-admin/registered/users') ? 'active' : '' }}" href="{{route('registered-users')}}"><i class="mdi mdi-account-check"></i> Registered Users</a>
            <a class="nav-link {{ Request::is('secure-admin/empanelled/users') ? 'active' : '' }}" href="{{route('empanelled-users')}}"><i class="mdi mdi-account-check"></i> Empanelled Users</a>
            <a class="nav-link {{ Request::is('secure-admin/appointed/users') ? 'active' : '' }}" href="{{route('appointed-users')}}"><i class="mdi mdi-account-clock"></i> Appointed Users</a>
            <a class="nav-link {{ Request::is('secure-admin/blacklisted/users') ? 'active' : '' }}" href="{{route('blacklisted-users')}}"><i class="mdi mdi-account-off"></i> Blacklisted Users</a>
            <!-- <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Dropdown</a>
                <ul class="dropdown-menu">
                <li><a class="nav-link" href="#">Action</a></li>
                <li><a class="nav-link" href="#">Another action</a></li>
                <li><a class="nav-link" href="#">Something else here</a></li>
                </ul>
            </div> -->
        </nav>
    </div>
</div>