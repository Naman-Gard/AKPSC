<script  nonce="{{Session::get('csp-code')}}" src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
<script  nonce="{{Session::get('csp-code')}}" src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<!-- <sc nonce="{{Session::get('csp-code')}}" ript src="{{asset('assets/js/jquery-ui.min.js')}}"></script> -->
<script  nonce="{{Session::get('csp-code')}}" src="{{asset('assets/js/datepicker.js')}}" type="text/javascript"></script>
<script  nonce="{{Session::get('csp-code')}}" src="{{asset('assets/auth/js/auth.js')}}"></script>
<script nonce="{{Session::get('csp-code')}}">
let base_url = "{{env('BASE_URL')}}"
// let token = $('#token').val()
let token = "{{csrf_token()}}"
</script>

</html>