<?php
  session_start();
  include "koneksi.php";
  $kode_member = $_GET['kode_member'];
  $sql = "DELETE FROM tbl_login WHERE kode_member ='$kode_member'";
  mysqli_query($koneksi, $sql);
  $_SESSION['info'] = 'Dihapus';

  $sql = "UPDATE tbl_member SET 
    kode_password = 1
  WHERE kode_member ='$kode_member'";
  mysqli_query($koneksi, $sql);
  
  header("location:login.php");
?>