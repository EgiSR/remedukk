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
    if (isset($_GET["id_order"])) {
        $id_order = $_GET["id_order"];
        $sql = "DELETE FROM `order` WHERE id_order='$id_order'";
        $query = mysqli_query($koneksi, $sql);
        if ($query) {
            $sukses = "Data berhasil dihapus";
        } else {
            $error = "Data gagal dihapus";
        }
    } else {
        $error = "ID order tidak ditemukan";
    }
}

if ($op == 'edit') {
    if (isset($_GET['id_order'])) {
        $id_order = $_GET['id_order'];
        $sql = "SELECT * FROM `order` WHERE id_order ='$id_order'";
        $query = mysqli_query($koneksi, $sql);
        $data = mysqli_fetch_array($query);
        if ($data) {
            $no_meja = $data['no_meja'];
            $tanggal = $data['tanggal'];
            $id_user = $data['id_user'];
            $keterangan = $data['keterangan'];
            $status_order = $data['status_order'];
        } else {
            $error = "Data tidak ditemukan";
        }
    } else {
        $error = "ID order tidak ditemukan";
    }
}

if (isset($_POST["add_menu"])) {
    $no_meja = $_POST['no_meja'];
    $tanggal = $_POST['tanggal'];
    $id_user = $_POST['id_user'];
    $keterangan = $_POST['keterangan'];
    $status_order = $_POST['status_order'];

    if ($no_meja && $tanggal && $id_user && $keterangan && $status_order) {
        if ($op === "edit" && isset($_GET['id_order'])) {
            $id_order = $_GET['id_order'];
            $sql = "UPDATE `order` SET no_meja='$no_meja', tanggal='$tanggal', id_user='$id_user', keterangan='$keterangan', status_order='$status_order' WHERE id_order='$id_order'";
            $query = mysqli_query($koneksi, $sql);
            if ($query) {
                $sukses = "Data berhasil disimpan";
            } else {
                $error = "Data gagal disimpan";
            }
        } else {
            $sql = "INSERT INTO `order`(no_meja, tanggal, id_user, keterangan, status_order) VALUES('$no_meja', '$tanggal', '$id_user', '$keterangan', '$status_order')";
            $query = mysqli_query($koneksi, $sql);
            if ($query) {
                $sukses = "Data berhasil disimpan";
            } else {
                $error = "Data gagal disimpan";
            }
        }
    } else {
        $error = "Silahkan masukkan data";
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
                                    <label for="no_meja" class="col-sm-2 col-form-label">no meja</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="no_meja" name="no_meja" autocomplete="off" value="<?= @$no_meja ?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="tanggal" class="col-sm-2 col-form-label">tanggal</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= @$tanggal ?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="id_user" class="col-sm-2 col-form-label">id user</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" autocomplete="off"  id="id_user" name="id_user" value="<?= @$id_user ?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="keterangan" class="col-sm-2 col-form-label">keterangan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= @$keterangan ?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="id_level" class="col-sm-2 col-form-label">status order</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="status_order" name="status_order" value="<?= @$status_order ?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="id_makanan" class="col-sm-2 col-form-label">id makanan</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="id_makanan" name="id_makanan" value="<?= @$id_makanan ?>">
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
                                        <td>no meja</td>
                                        <td>tanggal</td>
                                        <td>id user</td>
                                        <td>keterangan</td>
                                        <td>status order</td>
                                        <td>Edit & Hapus</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM  `order` ORDER BY id_order ASC";
                                    $query = mysqli_query($koneksi, $sql);
                                    $no = 1;
                                 while ($data_order = mysqli_fetch_array($query)) {
                                        $id_order = $data_order['id_order'];
                                        $no_meja = $data_order['no_meja'];
                                        $tanggal = $data_order['tanggal'];
                                        $id_user = $data_order['id_user'];
                                        $keterangan = $data_order['keterangan'];
                                        $status_order = $data_order['status_order'];

                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= @$no_meja; ?></td>
                                            <td><?= @$tanggal; ?></td>
                                            <td><?= @$id_user; ?></td>
                                            <td><?= @$keterangan; ?></td>
                                            <td><?= @$status_order; ?></td>
                                            <td>
                                                <a href="user.php?op=edit&id_user=<?= $data_user['id_user'] ?>" class="btn btn-warning ">Edit</a>
                                                <a href="user.php?op=delete&id_user=<?= $data_user['id_user'] ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" class="btn btn-danger ">Hapus</a>
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