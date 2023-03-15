<?php 
session_start();
if($_SESSION['id_level']!= '3') {
    echo"<script>
      alert('Maaf anda bukan lagi pelanggan');
      window.location.assign('../login.php');
      </script>";
}if(empty($_SESSION['id_user'])) {
    echo"<script>
      alert('Maaf anda belum login');
      window.location.assign('../login.php');
      </script>";
}

?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pelanggan</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <?php 
  include ('../layouts/pelanggan/navbar-pelanggan.php');
  ?>
  <!-- /.navbar -->

  
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Transaksi</h1>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    <?php 
    include ('../koneksi.php');
    ?>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Transaksi</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-paginate" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>id order</td>
                                        <td>tanggal</td>
                                        <td>total bayar</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM transaksi ORDER BY id_transaksi ASC";
                                    $query = mysqli_query($koneksi, $sql);
                                    $no = 1;
                                    while ($data_transaksi = mysqli_fetch_array($query)) {
                                        $id_transaksi = $data_transaksi['id_transaksi'];
                                        $id_user = $data_transaksi['id_user'];
                                        $tanggal = $data_transaksi['tanggal'];
                                        $total_bayar = $data_transaksi['total_bayar'];
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= @$id_user; ?></td>
                                            <td><?= $tanggal; ?></td>
                                            <td><?= @$total_bayar; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->

  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
</body>
</html>
