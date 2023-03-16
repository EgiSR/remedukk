<?php 

include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
$query = mysqli_query($koneksi, $sql);

if(mysqli_num_rows($query)>0){
      $data = mysqli_fetch_array($query);
      session_start();
      $_SESSION['id_user'] = $data['id_user'];
      $_SESSION['nama_user'] = $data['nama_user'];
      $_SESSION['id_level'] = $data['id_level'];
      if($data['id_level']=='1') {
            header('location:admin2/admin2.php');
      }elseif($data['id_level']=='2') {
            header('location:kasir/kasir.php');
      }
  }else{
      echo"<script>
      alert('Maaf login Gagal, Silakan Ulangi Lagi');
      window.location.assign('login.php');
      </script>";
  }