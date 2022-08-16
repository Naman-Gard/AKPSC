<!-- container-scroller -->
<!-- plugins:js -->
<!-- <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script> -->
<script src="{{asset('assets/step-form/vendors/js/vendor.bundle.base.js')}}"></script>
<script src="{{ asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script>
let base_url = "{{env('BASE_URL')}}";
let educationDataStatus = 0,
    SpecializationStatus = 0,
    experienceDataStatus = 0,
    languageDataStatus = 0,
    organizationDataStatus = 0;

// $(document).ready(function() {
//     $('.table').DataTable();
// });
</script>
<script src="{{asset('assets/step-form/js/form.js')}}"></script>
<script src="{{asset('assets/step-form/js/education.js')}}"></script>
<script src="{{asset('assets/step-form/js/experience.js')}}"></script>
<script src="{{asset('assets/step-form/js/prefrence.js')}}"></script>
<script src="{{asset('assets/preview/js/preview.js')}}"></script>
<script src="{{asset('assets/step-form/js/upload.js')}}"></script>


<!-- endinject -->
<!-- Plugin js for this page -->
<!-- <script src="{{asset('assets/step-form/js/jquery.cookie.js')}}" type="text/javascript"></script> -->
<!-- End plugin js for this page -->
<!-- Custom js for this page -->
<!-- <script src="{{asset('assets/step-form/js/dashboard.js')}}"></script> -->
<!-- <script src="{{asset('assets/step-form/js/todolist.js')}}"></script> -->
<!-- End custom js for this page -->

</html>