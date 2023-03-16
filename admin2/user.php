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
    $id_user = $_GET["id_user"];
    $sql = "DELETE FROM user WHERE id_user='$id_user'";
    $query = mysqli_query($koneksi, $sql);
    if ($query) {
        $sukses = "Data berhasil dihapus";
    } else {
        $error = "Data gagal dihapus";
    }
}


    if ($op == 'edit') {
    @$id_user = $_GET['id_user'];
    $sql = "SELECT * FROM user WHERE id_user ='$id_user'";
    $query = mysqli_query($koneksi, $sql);
    $data = mysqli_fetch_array($query);
    @$username = $data['username'];
    @$password = $data['password'];
    @$nama_user = $data['nama_user'];
    @$id_level = $data['id_level'];

    if ($id_user == '') {
        $error = "Data tidak ditemukan";
    }
 }


    if (isset($_POST["add_menu"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $nama_user = $_POST["nama_user"];
    $id_level = $_POST["id_level"];

    if ($username && $password && $nama_user && $id_level) {
        if ($op === "edit") {
            $sql = "UPDATE user SET username='$username', password='$password', nama_user='$nama_user', id_level='$id_level' WHERE id_user='$id_user'";
            $query = mysqli_query($koneksi, $sql);
            if ($query) {
                $sukses = "Data berhasil disimpan";
            } else {
                $error = "Data gagal disimpan";
            }
        } else {
             $sql = "INSERT INTO user(username , password , nama_user , id_level) VALUES('$username', '$password', '$nama_user', '$id_level')";
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
                                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="username" name="username" autocomplete="off" value="<?= @$username ?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password" name="password" value="<?= @$password ?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="nama_user" class="col-sm-2 col-form-label">Nama User</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" autocomplete="off"  id="nama_user" name="nama_user" value="<?= @$nama_user ?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="id_level" class="col-sm-2 col-form-label">Id Level</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="id_level" name="id_level" value="<?= @$id_level ?>">
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
                            <h3 class="card-title">Data User</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-paginate" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Username</td>
                                        <td>Password</td>
                                        <td>Nama User</td>
                                        <td>Id Level</td>
                                        <td>Edit & Hapus</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM user ORDER BY id_user ASC";
                                    $query = mysqli_query($koneksi, $sql);
                                    $no = 1;
                                    while ($data_user = mysqli_fetch_array($query)) {
                                        $id_user = $data_user['id_user'];
                                        $username = $data_user['username'];
                                        $password = $data_user['password'];
                                        $nama_user = $data_user['nama_user'];
                                        $id_level = $data_user['id_level'];
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= @$username; ?></td>
                                            <td><?= @$password; ?></td>
                                            <td><?= @$nama_user; ?></td>
                                            <td><?= @$id_level; ?></td>
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