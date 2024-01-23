<?php 
session_start();
include "koneksi.php";
$username = mysqli_escape_string($koneksi, $_POST['username']);
$password = md5(mysqli_escape_string($koneksi, $_POST['password']));

$sql = "SELECT * FROM tbl_login WHERE username = '$username' AND password = '$password'";
$query = mysqli_query($koneksi, $sql);
if (mysqli_num_rows($query)>0){
  $data         = mysqli_fetch_array($query);
  $kode_login   = $data['kode_login'];
  $kode_member  = $data['kode_member'];

  $_SESSION['kode_member']  = $kode_member;
  $_SESSION['kode_login']   = $kode_login;
  $_SESSION['kode']   = 0;
   
  if($kode_login!=1){
    $sql1   = "SELECT * FROM tbl_member WHERE kode_member = '$kode_member'";
    $query1 = mysqli_query($koneksi, $sql1);
    $data1  = mysqli_fetch_array($query1);
    $kode   = $data1['kode'];
    $_SESSION['kode']   = $kode;
    if($kode==1){
      $_SESSION['id_login']="sudahLogin";
      $_SESSION['nama']=$data1['nama_member'];
      $_SESSION['photo']=$data1['photo'];
      header("location:index.php");
    }else{
      header("location:dashboard.php");
    }
  }else{
    header("location:dashboard.php");
  }
}else{
  $_SESSION['info'] = 'Salah';
  header("location:index.php");
}
