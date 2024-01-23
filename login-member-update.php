<?php
  session_start();
  $kode = $_SESSION['kode'];

  include "koneksi.php";

  $username = $_POST['username'];
  $kode_member = $_POST['kode_member'];
  $password_lama = md5(htmlspecialchars($_POST['password_lama']));;
  $password_baru = md5(htmlspecialchars($_POST['password_baru']));;
  
  if($kode==0){
    $sql = "UPDATE tbl_login SET password  = '$password_baru' 
    WHERE kode_member = '$kode_member'";
    mysqli_query($koneksi, $sql);
    $_SESSION['info'] = 'Diupdate';
  }else{
    $sql = "SELECT * FROM tbl_login WHERE username = '$username' AND password = '$password_lama'";
    $query= mysqli_query($koneksi, $sql);
    if(mysqli_num_rows($query)>0){
      $sql = "UPDATE tbl_login SET password  = '$password_baru' 
      WHERE kode_member = '$kode_member'";
      mysqli_query($koneksi, $sql);
      $_SESSION['info'] = 'Diupdate';
    }else{
      $_SESSION['info'] = 'Gagal Diupdate';
    }
  }
  header("location:login.php");
?>
