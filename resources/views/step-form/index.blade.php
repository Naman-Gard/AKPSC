@include('includes/header')
@include('includes/nav')
@include('step-form/form-head/index')
<!-- partial -->
<section class="">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="main-panel">
                    <div class="card">
                        <div class="card-body">
                            <!-- <h2 class="card-title">Education Details</h2> -->
                            <!-- <input type="hidden" name="token" id="token" value={{csrf_token()}}> -->
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
                    <!-- content-wrapper ends -->
                    <!-- partial:partials/_footer.html -->
                    <!-- partial -->
                </div>
            </div>
        </div>
    </div>
    <!-- partial -->

    <!-- main-panel ends -->
</section>
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

<div class="modal fade" id="LoaderModal">
    <div class="modal-dialog loader-dialog">
        <div class="modal-content" id="loader">

            <div class="modal-body p-0">

                <!-- <div class="card-header">
                    <h2>User Empanelment</h2>
                </div> -->
                <!-- <div class="card"> -->
                <!-- <div class="card-header">Delete user
                <button type="button" class="btn-close float-right" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> -->
                <!-- <div class="card-body"> -->
                <div class="lds-ring">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
                <!-- </div>
                </div> -->

            </div>
        </div>
    </div>
</div>

@include('includes/footer')
<script nonce="{{Session::get('csp-code')}}">
    // let token = $('#token').val()
    // let token = "{{csrf_token()}}"
    let step = '{{$step}}'
</script>