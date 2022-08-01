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
                                <p class="mb-1 text-white fw-bold">{{Auth::user()->name}}</p>
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
                    <div class="row justify-content-center">
                        <div class="col-10 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <?php $size=sizeOf($education_details); ?>
                                    <!-- <h2 class="card-title">Education Details</h2> -->
                                    <form action="{{route('submit')}}" id="msform" class="forms-sample" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <!-- fieldsets -->
                                        @include('step-form/education')
                                        @include('step-form/experience')
                                        @include('step-form/work-preference')
                                        @include('step-form/upload')
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


    <div class="modal fade" id="DeleteEducation" >
    <div class="modal-dialog">
        <div class="modal-content">
        
        <div class="modal-body p-0">
            
        
            <div class="card">
                <!-- <div class="card-header">Delete user
                <button type="button" class="btn-close float-right" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> -->
                <div class="card-body">
                        <p>Are you sure you want to delete?</p> 
                        <button type="button" class="btn btn-secondary btn-sm Banner_delete" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger btn-sm Banner_delete">Delete</button>
                </div>
            </div>


        
        </div>
        </div>
    </div>
</div>
</body>
<script>
let token = '{{csrf_token()}}'
let step = '{{$step}}'
let experience = '{{$experience}}'
let preference = '{{$preference}}'
let education_data = '{{$size}}'
$('.delete-mem-btn').on('click',function(){
    let id=$(this).data('delete-link')
    console.log(id)
    //  $.ajax({
    //     type: "GET",
    //     url: base_url+'delete/Education/'+id,
    // }).done(()=>{

    // })
})
</script>
@include('includes/footer')