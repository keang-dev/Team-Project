  <!-- jQuery -->
  <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
$.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- overlayScrollbars -->
  <script src="{{asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>

  <!-- SweetAlert2 -->
  <script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

  <!-- Toastr -->
  <script src="{{asset('assets/plugins/toastr/toastr.min.js')}}"></script>

  <!-- Select2 -->
  <script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>

  <!-- AdminLTE App -->
  <script src="{{asset('assets/dist/js/adminlte.js')}}"></script>
  <!-- custom base action js -->
  <script src="{{asset('assets/js/base_action.js')}}"></script>
  <script src="{{asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{asset('assets/admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
  <script src="{{asset('assets/js/base_action.js')}}"></script>

  <script>
//Initialize Select2 Elements
$('.select2').select2()

//Initialize Select2 Elements
$('.select2bs4').select2({
    theme: 'bootstrap4'
})
  </script>
  <script>
function preview(e) {
    let img = document.getElementById('img');
    img.src = URL.createObjectURL(e.target.files[0]);
}
  </script>