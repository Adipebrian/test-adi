<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="../../icon.png" type="image/x-icon">
  <title>Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="/adminlte/plugins/summernote/summernote-bs4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="/adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav style="background-color: #c1f8cf; color:#000;" class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->


    <?= $this->include('layout/sidebar') ?>
    <?= $this->renderSection('content') ?>



    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        Order
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2022</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="/adminlte/plugins/jquery/jquery.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="/adminlte/plugins/jszip/jszip.min.js"></script>
  <script src="/adminlte/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="/adminlte/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="/adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- Summernote -->
  <script src="/adminlte/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="/adminlte/dist/js/adminlte.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="/adminlte/plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="/assets/js/script.js"></script>
  <!-- Datatable script -->
  <script>
    $(function() {
      // Summernote
      $('#summernote').summernote()
    })
  </script>
  <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
  <script>
    function previewImg() {
      const foto = document.querySelector('#foto');
      const imgPreview = document.querySelector('.img-preview');



      const fileFoto = new FileReader();
      fileFoto.readAsDataURL(foto.files[0]);

      fileFoto.onload = function(e) {
        imgPreview.src = e.target.result;
      }
    }
  </script>
  <script>
    const flashDataSuccess = $('.flash-data-success').data('flashdata');
    const flashDataWarning = $('.flash-data-warning').data('flashdata');
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: true,
      timer: 3000
    });
    if (flashDataSuccess) {
      Toast.fire({
        icon: 'success',
        title: flashDataSuccess,
      })
    }
    if (flashDataWarning) {
      Toast.fire({
        icon: 'warning',
        title: flashDataWarning
      })
    }
  </script>


</body>

</html>