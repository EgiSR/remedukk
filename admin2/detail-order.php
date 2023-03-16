<?php
$id_order = $_GET['id_order'];
include('../koneksi.php');
$sql = "SELECT * FROM `order`  where id_order = '$id_order'";


?>
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
    include('../koneksi.php');

    // Mengambil parameter op sama seperti GET url
    if (isset($_GET['op'])) {
    $op = $_GET['op'];
    } else {
    $op = "";
    }


    if ($op == 'delete') {
    $id_detail_order = $_GET['id_detail_order'];
   if (isset($_GET["id_order"])) {
       $sql = "DELETE FROM detail_order WHERE id_order='$id_order' AND id_detail_order='$id_detail_order'";
       $query = mysqli_query($koneksi, $sql);
       if ($query) {
           $sukses = "Data berhasil dihapus";
       } else {
           $error = "Data gagal dihapus";
       }
   } else {
       $error = "id detail order tidak ditemukan";
   }
}

    // Menghapus Data
//     if ($op == 'delete') {
//     $id_detail_order = $_GET['id_detail_order'];
//     $sql = "delete from detail_order where id_detail_order = '$id_detail_order'";
//     $query = mysqli_query($koneksi, $sql);

//     if($query) {
//         $sukses = "Data berhasil dihapus";
//     } else {
//         $error = "Data gagal dihapus";
//     }
//  }

    // Tambah Data
    if (isset($_POST['add_menu'])) {
    $id_masakan =$_POST['id_masakan']; 
    $keterangan = $_POST['keterangan']; 
    $status_detail_order = $_POST['status_detail_order']; 
 
    $sql = "INSERT into detail_order (id_order, id_masakan, keterangan, status_detail_order ) values('$id_order', '$id_masakan', '$keterangan', '$status_detail_order')"; 
    $query = mysqli_query($koneksi, $sql); 
 
    if($query) {    
    } else { 
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
                            Tambah Data Orderan
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
                                        <select name="id_masakan" id="id_masakan" onchange="harga()" class="form-control" required> 
                                            <option value="">- PIlih Menu -</option> 
                                            <?php 
                                            $sql = "SELECT * FROM masakan ORDER BY nama_masakan"; 
                                            $query = mysqli_query($koneksi, $sql); 
                                            $no = 1; 
                                            while ($data_masakan = mysqli_fetch_array($query)) { ?> 
                                                <option value="<?= $data_masakan['id_masakan']; ?>"> <?= $data_masakan['nama_masakan']; ?> - Rp. <?= number_format($data_masakan['harga']); ?> </option> 
                                            <?php 
                                            } 
                                            ?> 
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control img-thumbnail" name="keterangan" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select id="status_detail_order" name="status_detail_order" class="form-control">
                                            <option value="">- Pilih Status -</option>
                                            <option value="lunas" <?php if (@$status_detail_order == "lunas") echo "selected" ?>>lunas</option>
                                            <option value="belum lunas" <?php if (@$status_detail_order == "belum lunas") echo "selected" ?>>belum lunas</option>
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
                                        <td>Masakan</td>
                                        <td>Harga</td>
                                        <td>keterangan</td>
                                        <td>Status</td>
                                        <td>Hapus</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1; 
                                        $sql = "select * from detail_order, masakan where detail_order.id_masakan=masakan.id_masakan and id_order='$id_order' order by id_detail_order desc"; 
                                        $query = mysqli_query($koneksi, $sql); 
                                        foreach ($query as $data) {  ?> 
                                            <tr> 
                                                <td><?= $no++; ?></td> 
                                                <td><?= $data['nama_masakan'] ?></td> 
                                                <td>Rp. <?= number_format($data['harga'], 2, ',', ',') ?></td> 
                                                <td><?= $data['keterangan'] ?></td> 
                                                <td><?= $data['status_detail_order'] ?></td> 
                                                </td> 
                                                <td width="20%"> 
                                                    <a onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini')" href="detail-order.php?id_order=<?= $id_order['id_order'] ?>&id_detail_order=<?= $data['id_order'] ?>" class="btn btn-danger btn-sm-10">Hapus</a>
                                                </td> 
                                                <?php 
                                                echo var_dump($id_order);   
                                                ?>
                                            </tr> 
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
            
        </div>
        <!-- <a onclick="return confirm('Apakkh Anda Yakin Ingin Menghapus Data Ini')" href="detail-order.php?id_detail_order=" class="btn btn-danger btn-sm-10">Hapus</a>  -->
         <!-- //$data['id_order']  -->