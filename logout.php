<?php
  session_start();
  session_destroy();
  unset( $_SESSION['id_login']);
  unset( $_SESSION['kode_member']);
  unset( $_SESSION['kode']);
  header("location:index.php");
?>