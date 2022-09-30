<!-- container-scroller -->
<!-- plugins:js -->
<!-- <script nonce="{{Session::get('csp-code')}}" src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script> -->
<script nonce="{{Session::get('csp-code')}}" src="{{asset('assets/step-form/vendors/js/vendor.bundle.base.js')}}"></script>
<script nonce="{{Session::get('csp-code')}}" src="{{ asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script nonce="{{Session::get('csp-code')}}">
let base_url = "{{env('BASE_URL')}}";
let token = "{{csrf_token()}}";
let educationDataStatus = 0,
    SpecializationStatus = 0,
    experienceDataStatus = 0,
    languageDataStatus = 0,
    organizationDataStatus = 0,
    states={};
    function encode(str) {
        str = btoa(str);
        str+='UKP'
        str = btoa(str);
        str='UKP'+str
        return btoa(str);
    }

// $(document).ready(function() {
//     $('.table').DataTable();
// });
</script>
<script nonce="{{Session::get('csp-code')}}" src="{{asset('assets/step-form/js/form.js')}}"></script>
<script nonce="{{Session::get('csp-code')}}" src="{{asset('assets/step-form/js/education.js')}}"></script>
<script nonce="{{Session::get('csp-code')}}" src="{{asset('assets/step-form/js/experience.js')}}"></script>
<script nonce="{{Session::get('csp-code')}}" src="{{asset('assets/step-form/js/prefrence.js')}}"></script>
<script nonce="{{Session::get('csp-code')}}" src="{{asset('assets/preview/js/preview.js')}}"></script>
<script nonce="{{Session::get('csp-code')}}" src="{{asset('assets/step-form/js/upload.js')}}"></script>


<!-- endinject -->
<!-- Plugin js for this page -->
<!-- <script nonce="{{Session::get('csp-code')}}" src="{{asset('assets/step-form/js/jquery.cookie.js')}}" type="text/javascript"></script> -->
<!-- End plugin js for this page -->
<!-- Custom js for this page -->
<!-- <script nonce="{{Session::get('csp-code')}}" src="{{asset('assets/step-form/js/dashboard.js')}}"></script> -->
<!-- <script nonce="{{Session::get('csp-code')}}" src="{{asset('assets/step-form/js/todolist.js')}}"></script> -->
<!-- End custom js for this page -->

</html>