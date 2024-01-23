<?php
session_start();
include "koneksi.php";

$username 		= htmlspecialchars($_POST['username']);
$password 		= md5(htmlspecialchars($_POST['password']));
$kode_member  = $_POST['kode_member'];

$sql = "INSERT INTO tbl_login(kode_member, username, password) VALUES('$kode_member', '$username', '$password')";
$hsl = mysqli_query($koneksi, $sql);
if($hsl==1){
  $_SESSION['info'] = 'Disimpan';
  $sql = "UPDATE tbl_member SET 
      kode_password = 2 
    WHERE kode_member = '$kode_member'";
    mysqli_query($koneksi, $sql);
}else{
  $_SESSION['info'] = 'Gagal Disimpan';
}
header("location:login.php");

?>
