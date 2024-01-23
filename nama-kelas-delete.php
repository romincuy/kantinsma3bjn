<?php
  session_start();
  include "koneksi.php";

  $kode_kelas = $_GET['kode_kelas'];
  $sql 		= "SELECT * FROM tbl_member WHERE kode_kelas = '$kode_kelas' AND kode = 1 ORDER BY kode_kelas";
  $query 	= mysqli_query($koneksi, $sql);
  if(mysqli_num_rows($query)>0){
    $_SESSION['info'] = 'Gagal Dihapus';
  }else{
    $sql = "DELETE FROM tbl_kelas WHERE kode_kelas = '$kode_kelas'";
    mysqli_query($koneksi, $sql);
    $_SESSION['info'] = 'Dihapus';
  }
  header("location:nama-kelas.php");
?>