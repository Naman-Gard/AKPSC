<script src="{{asset('assets/step-form/vendors/js/vendor.bundle.base.js')}}"></script>
<script src="{{ asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/datatablepdf/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/datatablepdf/jszip.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/datatablepdf/pdfmake.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/datatablepdf/vfs_fonts.js')}}"></script>
<script src="{{ asset('assets/admin/js/datatablepdf/buttons.html5.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/datatablepdf/buttons.print.min.js')}}"></script>


<script>
    $(document).ready(function() {
        $('.table').DataTable({
            dom: 'lBfrtip',
            buttons: [
            'copy', 'csv', 'excel', 'print',
                {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'A4'
                }
            ]
        });
    });
</script>
</html>