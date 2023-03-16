<?php 

include 'koneksi.php';

$username_pelanggan = $_POST['username_pelanggan'];
$password_pelanggan = $_POST['password_pelanggan'];

$sql = "SELECT * FROM pelanggan WHERE username_pelanggan='$username_pelanggan' AND password_pelanggan='$password_pelanggan'";
$query = mysqli_query($koneksi, $sql);

if(mysqli_num_rows($query)>0){
      $data = mysqli_fetch_array($query);
      session_start();
      $_SESSION['nama_pelanggan'] = $data['nama_pelanggan'];
      $_SESSION['username_pelanggan'] = $data['username_pelanggan'];
      $_SESSION['id_level'] = $data['id_level'];
      if($data['id_level']=='3') {
            header('location:pelanggan/pelanggan.php');
      }elseif($data['level']=='2') {
            header('location:petugas/petugas.php');
      }
  }else{
      echo"<script>
      alert('Maaf login Gagal, Silakan Ulangi Lagi');
      window.location.assign('login.php');
      </script>";
  }
?>