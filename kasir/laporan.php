<?php 
session_start();
if($_SESSION['id_level']!= '2') {
    echo"<script>
      alert('Maaf anda bukan lagi kasir');
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
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../assets/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker --> 
  <link rel="stylesheet" href="../assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../assets/plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- /.content-header -->
    
    <?php
    include('../layouts/admin/navbar-admin.php');
    include('../layouts/kasir/sidebar-dashboard-kasir.php');
    include('../koneksi.php');

    // menggambil variable op
    if (isset($_GET['op'])) {
    $op = $_GET['op'];
    } else {
    $op = "";
    }

    // 
    if ($op == 'delete') {
    $id_transaksi = $_GET['id_transaksi'];
    $sql = "DELETE FROM transaksi WHERE id_transaksi='$id_transaksi'";
    $query = mysqli_query($koneksi, $sql);
    if ($query) {
        $sukses = "Data berhasil dihapus";
    } else {
        $error = "Data gagal dihapus";
    }
 }

    if ($op == 'edit') {
    @$id_transaksi = $_GET['id_transaksi'];
    $sql = "SELECT * FROM transaksi WHERE id_transaksi ='$id_transaksi'";
    $query = mysqli_query($koneksi, $sql);
    $data = mysqli_fetch_array($query);
    @$nama_transaksi = $data['nama_transaksi'];
    @$harga = $data['harga'];
    @$status_transaksi = $data['status_transaksi'];

    if ($id_transaksi == '') {
        $error = "Data tidak ditemukan";
    }
 }

    if (isset($_POST['add_menu'])) {
    @$nama_transaksi = $_POST['nama_transaksi'];
    @$harga = $_POST['harga'];
    @$status_transaksi = $_POST['status_transaksi'];

    if ($nama_transaksi && $harga && $status_transaksi) {
        if ($op == 'edit') {
            $sql = "UPDATE transaksi SET nama_transaksi='$nama_transaksi', harga='$harga', status_transaksi='$status_transaksi' WHERE id_transaksi='$id_transaksi'";
            $query = mysqli_query($koneksi, $sql);
            if ($query) {
                $sukses = "Data berhasil disimpan";
            } else {
                $error = "Data gagal disimpan";
            }
            } else {
            $sql = "INSERT INTO transaksi(nama_transaksi, harga, status_transaksi) VALUES('$nama_transaksi', '$harga', '$status_transaksi')";
            $query = mysqli_query($koneksi, $sql);
            if ($query) {
                $sukses = "Data berhasil disimpan";
            } else {
                $error = "Data gagal disimpan";
            }
            }
    }   else {
        $error = "Silahkan masukan data";
        }
}
?>

<!-- Content Wrapper. Contains page content -->
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

        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Transaksi</h3>
                        </div>
                        <div class="card-body">
                            <div class="btn btn-primary">Print Laporan</div>
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
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

</div>
     ?>