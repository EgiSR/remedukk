<?php

include ('koneksi.php');

//menerima input dari form
$username = $_POST['username'];
$password = $_POST['password'];
$id_level = 1; //hak akses

//query untuk menambahkan user baru
$sql = "INSERT INTO user (username , password , nama_user , id_level) VALUES ('$username', '$hashed_password', '$nama_user' , '$id_level')";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "Registrasi berhasil!";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>
