<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <div class="row">
            <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top">
                <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-between">
                    <!-- <a class="navbar-brand brand-logo" href="index.html"><img
                            src="{{asset('assets/step-form/images/logo.svg')}}" alt="logo" /></a>
                    <a class="navbar-brand brand-logo-mini" href="index.html"><img
                            src="{{asset('assets/step-form/images/logo-mini.svg')}}" alt="logo" /></a> -->
                    <div class="nav-welcome-text px-4">
                        <p class="mb-0 text-white fw-bold">Welcome!</p>
                        <p class="mb-0 text-white fw-bold">{{Auth::user()->name}}</p>
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
                                        <i class="mdi mdi-account-circle"></i>
                                        <p class="mb-1 text-white fw-bold">{{Auth::user()->name}}</p>
                                    </div>
                                </a>
                                <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                                    <!-- <a class="dropdown-item" href="#">
                                        <i class="mdi mdi-cached me-2 text-success"></i> Activity Log </a> -->
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{route('profile')}}">
                                        <span class="mdi mdi-account me-3" id="account"></span>Profile
                                    </a>
                                    <a class="dropdown-item" href="{{route('logout')}}">
                                        <i class="mdi mdi-logout me-2"></i> Signout
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>