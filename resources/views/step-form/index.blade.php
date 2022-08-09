@include('includes/header')
@include('includes/nav')
@include('step-form/form-head/index')
<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row justify-content-center">
                <div class="col-10 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
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


<div class="modal fade" id="DeleteModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body p-0">


                <div class="card">
                    <!-- <div class="card-header">Delete user
                <button type="button" class="btn-close float-right" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> -->
                    <div class="card-body">
                        <p>Are you sure you want to delete?</p>
                        <button type="button" class="btn btn-secondary btn-sm Banner_delete"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger btn-sm delete-mem-btn"
                            data-bs-dismiss="modal">Delete</button>
                    </div>
                </div>



            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="NotifyModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body p-0">


                <div class="card">
                    <!-- <div class="card-header">Delete user
                <button type="button" class="btn-close float-right" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> -->
                    <div class="card-body">
                        <p id="notify-message"></p>
                        <button type="button" class="btn btn-secondary btn-sm Banner_delete"
                            data-bs-dismiss="modal">Close</button>
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
</script>
@include('includes/footer')