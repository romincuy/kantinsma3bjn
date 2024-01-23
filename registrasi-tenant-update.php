<?php
  session_start();
  include "koneksi.php";
  $kode_member  = $_POST['kode_member'];
  $nama_tenant  = $_POST['nama_tenant'];
  $nama_member  = $_POST['nama_member'];
  $alamat       = $_POST['alamat'];
  $telp         = $_POST['telp'];
  $deposit = str_replace(',','', mysqli_escape_string($koneksi, $_POST['deposit']));
  $photo        = $_POST['photo'];
 
  $namaBaru = date('dmYHis');
  $img 	    = $_FILES['img']['name'];
  if($img !=""){$img = $namaBaru.$_FILES['img']['name'];};
  $temp	    = $namaBaru.$_FILES['img']['tmp_name'];

  if($img==""){
    $sql = "UPDATE tbl_member SET 
      nama_tenant = '$nama_tenant',
      nama_member = '$nama_member',
      alamat      = '$alamat',
      telp        = '$telp',
      deposit     = '$deposit'
    WHERE kode_member = '$kode_member' AND kode=2";
  }else{
    $sql = "UPDATE tbl_member SET 
      nama_tenant = '$nama_tenant',
      nama_member = '$nama_member',
      alamat      = '$alamat',
      telp        = '$telp',
      deposit     = '$deposit',
      photo       = '$img'
    WHERE kode_member = '$kode_member' AND kode=2";
    unlink("img/".$photo);
    move_uploaded_file($_FILES['img']['tmp_name'], "img/".$img);
  }
  $_SESSION['info'] = 'Diupdate';
  mysqli_query($koneksi, $sql);
  header("location:registrasi-tenant.php");
?>
