<!-- <script src="{{asset('assets/step-form/vendors/js/vendor.bundle.base.js')}}"></script> -->
<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{ asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/datatablepdf/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/datatablepdf/jszip.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/datatablepdf/pdfmake.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/datatablepdf/vfs_fonts.js')}}"></script>
<script src="{{ asset('assets/admin/js/datatablepdf/buttons.html5.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/datatablepdf/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
<script src="{{ asset('assets/super-admin/js/dashboard.js')}}"></script>
<script>
    let base_url = "{{env('BASE_URL')}}";
    let token = "{{csrf_token()}}";
    $('.table').dataTable()
</script>

</html>