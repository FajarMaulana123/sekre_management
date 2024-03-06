<!-- ================== BEGIN core-js ================== -->
<script src="{{ asset('assets/js/vendor.min.js') }}"></script>
<script src="{{ asset('assets/js/app.min.js') }}"></script>
<!-- ================== END core-js ================== -->

<script src="{{ asset('assets/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-fixedcolumns/js/dataTables.fixedColumns.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js') }}"></script>


<script src="{{ asset('assets/plugins/datatables.net-colreorder/js/dataTables.colReorder.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-colreorder-bs5/js/colReorder.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-keytable-bs5/js/keyTable.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-rowreorder/js/dataTables.rowReorder.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-rowreorder-bs5/js/rowReorder.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-select/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-select-bs5/js/select.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/build/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/jszip/dist/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/summernote/dist/summernote-lite.min.js') }}"></script>

<script src="{{ asset('assets/plugins/parsleyjs/dist/parsley.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select-picker/dist/picker.min.js')}}"></script>

<script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/popover/jquery.webui-popover.min.js') }}"></script>

<script src="{{ asset('assets/plugins/select2/dist/js/select2.min.js')}}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script> --}}
<script src="{{ asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js')}}"></script>

<script src="{{ asset('assets/plugins/highchart/highcharts.js')}}"></script>
<script src="{{ asset('assets/plugins/highchart/highcharts-3d.js')}}"></script>
<script src="{{ asset('assets/plugins/highchart/modules/exporting.js')}}"></script>
{{-- <script src="{{ asset('assets/plugins/highchart/modules/export-data.js')}}"></script> --}}
<script src="{{ asset('assets/plugins/highchart/modules/accessibility.js')}}"></script>
<script>
	var user_auth = "{{Auth::user()->roles}}";
</script>