<?php 
session_start();
if($_SESSION['id_level']!= '1') {
    echo"<script>
      alert('Maaf anda bukan lagi admin');
      window.location.assign('../login.php');
      </script>";
}if(empty($_SESSION['id_user'])) {
    echo"<script>
      alert('Maaf anda belum login');
      window.location.assign('../login.php');
      </script>";
}

?>