<div class="sidebar mt-5 py-5">
    <div class="menu-bar">
        <nav class="nav flex-column">
            <a class="nav-link {{ Request::is('secure-admin/dashboard') ? 'active' : '' }}" aria-current="page" href="{{route('dashboard')}}">Dashboard</a>
            <a class="nav-link {{ Request::is('secure-admin/registered/users') ? 'active' : '' }}" href="{{route('registered-users')}}">Registered Users</a>
            <a class="nav-link {{ Request::is('secure-admin/empanelled/users') ? 'active' : '' }}" href="{{route('empanelled-users')}}">Empanelled Users</a>
            <a class="nav-link {{ Request::is('secure-admin/appointed/users') ? 'active' : '' }}" href="{{route('appointed-users')}}">Appointed Users</a>
            <a class="nav-link {{ Request::is('secure-admin/blacklisted/users') ? 'active' : '' }}" href="{{route('blacklisted-users')}}">Blacklisted Users</a>
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