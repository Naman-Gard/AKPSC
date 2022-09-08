<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<!-- <script src="{{asset('assets/js/jquery-ui.min.js')}}"></script> -->
<script src="{{asset('assets/js/datepicker.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/auth/js/auth.js')}}"></script>
<script>
let base_url = "{{env('BASE_URL')}}"
let token = '{{csrf_token()}}'
</script>

</html>