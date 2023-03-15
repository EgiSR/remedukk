<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Makanan Minuman</title>

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

    <?php
    include('../layouts/admin/navbar-admin.php');
    include('../layouts/admin/sidebar-dashboard-admin.php');
    include('../koneksi.php');
 
    if (isset($_GET["op"])) {
    $op = $_GET["op"];
    } else {
    $op = "";
    }
    
    if ($op == "delete") {
    $id_transaksi = $_GET["id_transaksi"];
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
    @$username = $data['username'];
    @$id_order = $data['id_order'];
    @$tanggal = $data['tanggal'];
    @$total_bayar = $data['total_bayar'];

    if ($id_transaksi == '') {
        $error = "Data tidak ditemukan";
    }
 }


    if (isset($_POST["add_menu"])) {
    $username = $_POST["id_user"];
    $id_order = $_POST["id_order"];
    $tanggal = $_POST["tanggal"];
    $total_bayar = $_POST["total_bayar"];

    if ($username && $id_order && $tanggal && $total_bayar) {
        if ($op === "edit") {
            $sql = "UPDATE user SET id_user='$username', id_order='$id_order', tanggal='$tanggal', total_bayar='$total_bayar' WHERE id_user='$username'";
            $query = mysqli_query($koneksi, $sql);
            if ($query) {
                $sukses = "Data berhasil disimpan";
            } else {
                $error = "Data gagal disimpan";
            }
        } else {
             $sql = "INSERT INTO user(id_user , id_order , tanggal , total_bayar) VALUES('$username', '$id_order', '$tanggal', '$total_bayar')";
             $query = mysqli_query($koneksi, $sql);
             if ($query) {
                 $sukses = "Data berhasil disimpan";
            } else {
                 $error = "Data gagal disimpan";
             }
         }
    } 
    
    else {
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
                    <h1 class="m-0">Data User</h1>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">

        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            Tambah Data User
                        </div>
                        <div class="card-body">
                            <?php
                            if (@$error) { ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo @$error ?>
                                </div>
                                <?php
                                //header("refresh:2;url=user.php");
                                ?>
                            <?php } ?>
                            <?php
                            if (@$sukses) { ?>
                                <div class="alert alert-success" role="alert">
                                    <?php echo @$sukses ?>
                                </div>
                                <?php
                                //header("refresh:1;url=admin/user.php");
                                ?>
                            <?php } ?>

                            <form action="" method="POST" value="Reset">
                                <div class="row mb-3">
                                    <label for="id_user" class="col-sm-2 col-form-label">username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="id_user" name="id_user" readonly autocomplete="off" value="<?= @$username ?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="id_order" class="col-sm-2 col-form-label">id order</label>
                                    <div class="col-sm-10">
                                        <input type="id_order" class="form-control" id="id_order" name="id_order" value="<?= @$id_order ?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" autocomplete="off"  id="tanggal" name="tanggal" value="<?= @$tanggal ?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="total_bayar" class="col-sm-2 col-form-label">Total Bayar</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="total_bayar" name="total_bayar" value="<?= @$total_bayar ?>">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <input type="submit" value="Simpan Data" name="add_menu" class="btn btn-primary">
                                    <input type="reset" value="Reset" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->

        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Menu</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-paginate" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>username</td>
                                        <td>id order</td>
                                        <td>tanggal</td>
                                        <td>total bayar</td>
                                        <td>Edit & Hapus</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM transaksi , user ORDER BY id_transaksi ASC";
                                    $query = mysqli_query($koneksi, $sql);
                                    $no = 1;
                                    while ($data_transaksi = mysqli_fetch_array($query)) {
                                        $username = $data_transaksi['username'];
                                        $id_order = $data_transaksi['id_order'];
                                        $tanggal = $data_transaksi['tanggal'];
                                        $total_bayar = $data_transaksi['total_bayar'];
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= @$username; ?></td>
                                            <td><?= @$id_order; ?></td>
                                            <td><?= @$tanggal; ?></td>
                                            <td><?= @$total_bayar; ?></td>
                                            <td>
                                                <a href="transaksi.php?op=edit&id_transaksi=<?= $data_transaksi['id_user'] ?>" class="btn btn-warning ">Edit</a>
                                                <a href="transaksi.php?op=delete&id_user=<?= $data_transaksi['id_user'] ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" class="btn btn-danger ">Cetak Laporan</a>
                                            </td>
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