<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-between">
                <!-- <a class="navbar-brand brand-logo" href="index.html"><img
                        src="{{asset('assets/step-form/images/logo.svg')}}" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="index.html"><img
                        src="{{asset('assets/step-form/images/logo-mini.svg')}}" alt="logo" /></a> -->
                <div class="d-flex align-items-center">
                    <button class="toggle-btn">
                        <span class="toggle-icon"></span>
                        <span class="toggle-icon"></span>
                        <span class="toggle-icon"></span>
                    </button>
                    <div class="nav-welcome-text">
                        <p class="mb-0 text-white">Welcome!</p>
                        <p class="mb-0 text-white">{{Session::get('admin-user')->name}}</p>
                    </div>
                </div>
                <div class="navbar-menu-wrapper d-flex align-items-stretch">
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item nav-profile dropdown custom-dropdown">
                            <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <!-- <div class="nav-profile-img">
                                    <img src="{{asset('assets/step-form/images/faces/face1.jpg')}}" alt="image">
                                    <span class="availability-status online"></span>
                                </div> -->
                                <div class="nav-profile-text">
                                    <p class="mb-0 text-white"><i class="mdi mdi-account-circle me-2"></i> {{Session::get('admin-user')->name}}</p>
                                </div>
                            </a>
                            <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                                <!-- <a class="dropdown-item" href="#">
                                    <i class="mdi mdi-cached me-2 text-success"></i> Activity Log </a> -->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('admin-profile')}}">
                                    <i class="mdi mdi-account me-2"></i> Profile
                                </a>
                                <a class="dropdown-item" href="{{route('admin-logout')}}">
                                    <i class="mdi mdi-logout me-2"></i> Signout
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>