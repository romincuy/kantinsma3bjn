<?php
session_start();
include "koneksi.php";

$id_detail = $_POST['idDetail'];
$sql = "UPDATE tbl_transaksi_detail SET dikerjakan='Y' 
  WHERE id_detail =  '$id_detail'";
mysqli_query($koneksi, $sql);

$terima = 0;
$kode_member = $_SESSION['kode_member'];
$sql = "SELECT * FROM tbl_transaksi_detail WHERE dikerjakan='Y' 
  AND kode_tenant =  '$kode_member'";
$query = mysqli_query($koneksi, $sql);
while($data = mysqli_fetch_array($query)){
  $harga = $data['harga'];
  $qty = $data['qty'];
  $terima = $terima+ $harga*$qty;
}
echo number_format($terima,0);