<?php
session_start();
include "koneksi.php";
$jenis_menu = trim($_POST['jenis_menu']);
$sql 		= "SELECT * FROM tbl_jenis_menu WHERE jenis_menu = '$jenis_menu'";
$query 	= mysqli_query($koneksi, $sql);
if(mysqli_num_rows($query)>0){
  $_SESSION['info'] = 'Gagal Disimpan';
}else{
  $sql = "INSERT INTO tbl_jenis_menu(jenis_menu) VALUES('$jenis_menu')";
  mysqli_query($koneksi, $sql);
  $_SESSION['info'] = 'Disimpan';
}
header("location:jenis-menu.php");
?>
