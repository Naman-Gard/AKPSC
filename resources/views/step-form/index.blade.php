@include('includes/header')

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <!-- <a class="navbar-brand brand-logo" href="index.html"><img
                        src="{{asset('assets/step-form/images/logo.svg')}}" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="index.html"><img
                        src="{{asset('assets/step-form/images/logo-mini.svg')}}" alt="logo" /></a> -->
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <!-- <div class="nav-profile-img">
                                <img src="{{asset('assets/step-form/images/faces/face1.jpg')}}" alt="image">
                                <span class="availability-status online"></span>
                            </div> -->
                            <div class="nav-profile-text">
                                <p class="mb-1 text-black">{{Auth::user()->name}}</p>
                            </div>
                        </a>
                        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="mdi mdi-cached me-2 text-success"></i> Activity Log </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{route('logout')}}">
                                <i class="mdi mdi-logout me-2 text-primary"></i> Signout
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <?php $size=sizeOf($education_details); ?>
                                    <!-- <h2 class="card-title">Education Details</h2> -->
                                    <form action="{{route('submit')}}" id="msform" class="forms-sample" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <!-- fieldsets -->
                                        @if(!in_array('education',$step))
                                        @include('step-form/education')
                                        @endif

                                        @if(!in_array('experience',$step))
                                        @include('step-form/experience')
                                        @endif

                                        @if(!in_array('preference',$step))
                                        @include('step-form/work-preference')
                                        @endif

                                        @if(!in_array('upload',$step))
                                        @include('step-form/upload')
                                        @endif

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>

</body>
<script>
let token = '{{csrf_token()}}'
let education_data = '{{$size}}'
</script>
@include('includes/footer')