<!-- <script src="{{asset('assets/step-form/vendors/js/vendor.bundle.base.js')}}"></script> -->
<script nonce="{{Session::get('csp-code')}}" src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
<script nonce="{{Session::get('csp-code')}}" src="{{ asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script nonce="{{Session::get('csp-code')}}" src="{{ asset('assets/admin/js/datatablepdf/dataTables.buttons.min.js')}}"></script>
<script nonce="{{Session::get('csp-code')}}" src="{{ asset('assets/admin/js/datatablepdf/jszip.min.js')}}"></script>
<script nonce="{{Session::get('csp-code')}}" src="{{ asset('assets/admin/js/datatablepdf/pdfmake.min.js')}}"></script>
<script nonce="{{Session::get('csp-code')}}" src="{{ asset('assets/admin/js/datatablepdf/vfs_fonts.js')}}"></script>
<script nonce="{{Session::get('csp-code')}}" src="{{ asset('assets/admin/js/datatablepdf/buttons.html5.min.js')}}"></script>
<script nonce="{{Session::get('csp-code')}}" src="{{ asset('assets/admin/js/datatablepdf/buttons.print.min.js')}}"></script>
<script nonce="{{Session::get('csp-code')}}" src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<script nonce="{{Session::get('csp-code')}}" src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
<script nonce="{{Session::get('csp-code')}}" src="{{ asset('assets/super-admin/js/dashboard.js')}}"></script>
<script nonce="{{Session::get('csp-code')}}" >
    let base_url = "{{env('BASE_URL')}}";
    let token = "{{csrf_token()}}";
    $('.table').dataTable()

    function encode(str) {
        str = btoa(str);
        str+='UKP'
        str = btoa(str);
        str='UKP'+str
        return btoa(str);
    }
</script>

</html>