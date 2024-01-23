<?php
  session_start();
  include "koneksi.php";
  $kode_member  = $_POST['kode_member'];
  $deposit_awal = str_replace(',','', mysqli_escape_string($koneksi,$_POST['deposit_awal']));
  $deposit1      = str_replace(',','', mysqli_escape_string($koneksi,$_POST['deposit1']));
  $nama_member  = $_POST['nama_member'];
  $telp         = $_POST['telp'];
  $photo        = $_POST['photo'];
  
  if($deposit_awal==$deposit1){
    $deposit = str_replace(',','', mysqli_escape_string($koneksi, $_POST['deposit']));
  }else{
    $deposit = str_replace(',','', mysqli_escape_string($koneksi, $_POST['deposit']))+$deposit_awal;
  }

  $namaBaru = date('dmYHis');
  $img 	    = $_FILES['img']['name'];
  if($img !=""){$img = $namaBaru.$_FILES['img']['name'];};
  $temp	    = $namaBaru.$_FILES['img']['tmp_name'];

  if($img==""){
    $sql = "UPDATE tbl_member SET 
      nama_member = '$nama_member',
      deposit     = '$deposit',
      telp        = '$telp'
    WHERE kode_member = '$kode_member' AND kode=1";
  }else{
    $_SESSION['info'] = 'Diupdate';
    $sql = "UPDATE tbl_member SET 
      nama_member = '$nama_member',
      deposit     = '$deposit',
      photo       = '$img',
      telp        = '$telp'
    WHERE kode_member = '$kode_member' AND kode=1";
    unlink("img/".$photo);
    move_uploaded_file($_FILES['img']['tmp_name'], "img/".$img);
  }
  mysqli_query($koneksi, $sql);
  header("location:registrasi-member.php");
?>
