<?php
  session_start();
  include "koneksi.php";
  $kode_member = $_GET['kode_member'];

  $sql2   = "SELECT * FROM tbl_member WHERE kode_member = '$kode_member' AND kode=2";
  $query2 = mysqli_query($koneksi, $sql2);
  $dt2    = mysqli_fetch_array($query2);
  $img    = $dt2['photo'];

  $sql = "DELETE FROM tbl_member WHERE kode_member = '$kode_member' AND kode=2";
  $hsl = mysqli_query($koneksi, $sql);
  if($hsl==1){
    if($img!="" && $img!="no-logo.png"){unlink("img/".$img);}
    $_SESSION['info'] = 'Dihapus';

  }else{
    $_SESSION['info'] = 'Gagal Dihapus';
  }
  header("location:registrasi-tenant.php");
?>