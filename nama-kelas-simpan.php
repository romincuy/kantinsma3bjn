<?php
session_start();
include "koneksi.php";
$nama_kelas = trim($_POST['nama_kelas']);
$sql 		= "SELECT * FROM tbl_kelas WHERE nama_kelas = '$nama_kelas'";
$query 	= mysqli_query($koneksi, $sql);
if(mysqli_num_rows($query)>0){
  $_SESSION['info'] = 'Gagal Disimpan';
}else{
  $sql = "INSERT INTO tbl_kelas(nama_kelas) VALUES('$nama_kelas')";
  mysqli_query($koneksi, $sql);
  $_SESSION['info'] = 'Disimpan';
}
header("location:nama-kelas.php");
?>
