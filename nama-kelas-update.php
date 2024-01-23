<?php
session_start();
include "koneksi.php";
$kode_kelas = $_POST['kode_kelas'];
$nama_kelas	= $_POST['nama_kelas'];

$sql = "SELECT * FROM tbl_kelas WHERE nama_kelas = '$nama_kelas'";
$query = mysqli_query($koneksi, $sql);
if(mysqli_num_rows($query)>0){
  $_SESSION['info'] = 'Gagal Diupdate';
}else{
  $sql = "UPDATE tbl_kelas SET 
    nama_kelas    = '$nama_kelas'
  WHERE kode_kelas  = '$kode_kelas'";
    mysqli_query($koneksi, $sql);
  $_SESSION['info'] = 'Diupdate';
}
header("location:nama-kelas.php");?>
