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
<body>
    <!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
        <a href="index.php" class="navbar-brand">
            <h5 class="brand-text">E Restoran</h5>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="../admin/logout.php" role="button">
                    <i class="fas fa-lock"></i> Logout
                </a>
            </li>
        </ul>

    </div>
</nav>
<!-- /.navbar -->

 <!-- awal sidebar -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="../assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">E Restoran</span>
    </a>
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Egi Satmata R</a>
        </div>
      </div>
      
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

              <li class="nav-item">
                <a href="admin.php?url=makanan-minuman" class="nav-link ">
                  <p>Makanan & Minuman</p>
                </a>                
              </li>

              <li class="nav-item">
                <a href="admin.php?url=user" class="nav-link">
                  <p>Data Kasir dan Pelanggan</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="transaksi.php" class="nav-link">
                  <p>Transaksi</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="laporan.php" class="nav-link">
                  <p>Laporan</p>
                </a>
              </li>
            </ul>
          </li>
      </nav>
    </div>
  </aside>

<?php
include ('../koneksi.php');
if (isset($_GET['url'])) {
    $url = $_GET['url'];
    } else {
    $url = "";
    }

    // Menghapus Data
    if ($url == 'delete') {
    $id_masakan = $_GET['id_masakan'];
    $sql = "DELETE FROM masakan WHERE id_masakan='$id_masakan'";
    $query = mysqli_query($koneksi, $sql);
    if ($query) {
        $sukses = "Data berhasil dihapus";
    } else {
        $error = "Data gagal dihapus";
    }
 }

    // Edit Data
    if ($url == 'edit') {
    @$id_masakan = $_GET['id_masakan'];
    $sql = "SELECT * FROM masakan WHERE id_masakan ='$id_masakan'";
    $query = mysqli_query($koneksi, $sql);
    $data = mysqli_fetch_array($query);
    @$nama_masakan = $data['nama_masakan'];
    @$harga = $data['harga'];
    @$status_masakan = $data['status_masakan'];

    if ($id_masakan == '') {
        $error = "Data tidak ditemukan";
    }
 }

    // Tambah Data
    if (isset($_POST['add_menu'])) {
    @$nama_masakan = $_POST['nama_masakan'];
    @$harga = $_POST['harga'];
    @$status_masakan = $_POST['status_masakan'];

    if ($nama_masakan && $harga && $status_masakan) {
        if ($url == 'edit') {
            $sql = "UPDATE masakan SET nama_masakan='$nama_masakan', harga='$harga', status_masakan='$status_masakan' WHERE id_masakan='$id_masakan'";
            $query = mysqli_query($koneksi, $sql);
            if ($query) {
                $sukses = "Data berhasil disimpan";
            } else {
                $error = "Data gagal disimpan";
            }
            } else {
            $sql = "INSERT INTO masakan(nama_masakan, harga, status_masakan) VALUES('$nama_masakan', '$harga', '$status_masakan')";
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

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Menu Makanan</h1>
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
                            Tambah Data Menu
                        </div>
                        <div class="card-body">
                            <?php
                            if (@$error) { ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo @$error ?>
                                </div>
                                <?php
                                header("refresh:2;url=makanan-minuman.php");
                                ?>
                            <?php } ?>
                            <?php
                            if (@$sukses) { ?>
                                <div class="alert alert-success" role="alert">
                                    <?php echo @$sukses ?>
                                </div>
                                <?php
                                //header("refresh:1;url=admin/makanan-minuman.php");
                                ?>
                            <?php } ?>

                            <form action="" method="POST" value="Reset Makanans">
                                <div class="row mb-3">
                                    <label for="nama_makanan" class="col-sm-2 col-form-label">Nama Makanan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama_masakan" name="nama_masakan" autocomplete="off" value="<?= @$nama_masakan ?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="harga" name="harga" value="<?= @$harga ?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select id="status_masakan" name="status_masakan" class="form-control">
                                            <option value="">- Pilih Status -</option>
                                            <option value="tersedia" <?php if (@$status_masakan == "tersedia") echo "selected" ?>>Tersedia</option>
                                            <option value="habis" <?php if (@$status_masakan == "habis") echo "selected" ?>>Habis</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <input type="submit" value="Simpan Data" name="add_menu" class="btn btn-primary">
                                    <input type="reset" value="Reset Form" class="btn btn-success">
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
                                        <td>Nama</td>
                                        <td>Harga</td>
                                        <td>Status</td>
                                        <td>Edit & Hapus</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM masakan ORDER BY id_masakan ASC";
                                    $query = mysqli_query($koneksi, $sql);
                                    $no = 1;
                                    while ($data_masakan = mysqli_fetch_array($query)) {
                                        $id_masakan = $data_masakan['id_masakan'];
                                        $nama_masakan = $data_masakan['nama_masakan'];
                                        $harga = $data_masakan['harga'];
                                        $status_masakan = $data_masakan['status_masakan'];
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= @$nama_masakan; ?></td>
                                            <td>Rp. <?= number_format(@$harga); ?></td>
                                            <td><?= @$status_masakan; ?></td>
                                            <td>
                                                <a href="makanan-minuman.php?url=edit&id_masakan=<?= $data_masakan['id_masakan'] ?>" class="btn btn-warning ">Edit</a>
                                                <a href="makanan-minuman.php?url=delete&id_masakan=<?= $data_masakan['id_masakan'] ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" class="btn btn-danger ">Hapus</a>
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
    </body>