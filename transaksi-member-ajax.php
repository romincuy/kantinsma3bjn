<?php
session_start();
date_default_timezone_set("Asia/Jakarta");
include "koneksi.php";

$idMenu	= $_POST['idMenu'];
$sql    = "SELECT * FROM tbl_menu WHERE id_menu = '$idMenu'";
$query  = mysqli_query($koneksi, $sql);
$data   = mysqli_fetch_array($query);
$harga  = $data['harga'];
$kode_tenant = $data['kode_tenant'];

$noTransaksi= $_POST['noTrans'];
$tgl    = date('Y-m-d');
if($noTransaksi==""){
  
  $sql1   = "SELECT * FROM tbl_transaksi ORDER BY id_transaksi DESC";
  $query1 = mysqli_query($koneksi, $sql1);
  if(mysqli_num_rows($query1)>0){
    $data1= mysqli_fetch_array($query1);
    $id_transaksi = $data1['id_transaksi']+1;
    if($id_transaksi<10){
      $noTransaksi = "00000000".$id_transaksi;
    }else if($id_transaksi<100){
      $noTransaksi = "0000000".$id_transaksi;
    }else if($id_transaksi<1000){
      $noTransaksi = "000000".$id_transaksi;
    }else if($id_transaksi<10000){
      $noTransaksi = "00000".$id_transaksi;
    }else if($id_transaksi<100000){
      $noTransaksi = "0000".$id_transaksi;
    }else if($id_transaksi<1000000){
      $noTransaksi = "000".$id_transaksi;
    }else if($id_transaksi<10000000){
      $noTransaksi = "00".$id_transaksi;
    }else if($id_transaksi<100000000){
      $noTransaksi = "0".$id_transaksi;
    }
  }else{
    $noTransaksi = "000000001";
  }
  $tglTransaksi = str_replace('-','', mysqli_escape_string($koneksi, $tgl));
  $noTransaksi  = $tglTransaksi.$noTransaksi;
}

$kodeMember = $_POST['kodeMember'];
$sql5   = "SELECT * FROM tbl_member WHERE kode_member = '$kodeMember'";
$query5 = mysqli_query($koneksi, $sql5);
if(mysqli_num_rows($query5)>0){
  $data5  = mysqli_fetch_array($query5);
  $deposit= $data5['deposit'];
}else{
  $deposit = 0;
}

$sql6 = "SELECT sum(total_transaksi) as ttl_transaksi FROM tbl_transaksi WHERE kode_member = '$kodeMember' ORDER BY kode_member";
$query6 = mysqli_query($koneksi, $sql6);
if(mysqli_num_rows($query6)>0){
  $data6 = mysqli_fetch_array($query6);
  $total_transaksi = $data6['ttl_transaksi']+$harga;
}else{
  $total_transaksi = $harga;
}
if($deposit<$total_transaksi){
  $arr = [
    "no_transaksi" => "Saldo Kurang",
  ];
  echo json_encode($arr);  
  exit();
}

$sql2 = "SELECT * FROM tbl_transaksi_detail WHERE no_transaksi = '$noTransaksi' ORDER BY no_transaksi";
$query2 = mysqli_query($koneksi, $sql2);
if(mysqli_num_rows($query2)>0){
  $sql2c = "UPDATE tbl_transaksi SET total_transaksi =  total_transaksi + '$harga' 
  WHERE no_transaksi =  '$noTransaksi'";
  mysqli_query($koneksi, $sql2c);
}else{
  $sql2 = "INSERT INTO tbl_transaksi(tgl_transaksi, no_transaksi, total_transaksi, kode_member, kode) VALUES('$tgl', '$noTransaksi', '$harga', '$kodeMember', 1)";
  mysqli_query($koneksi, $sql2);
}

$sql3 = "SELECT * FROM tbl_transaksi_detail WHERE no_transaksi = '$noTransaksi' AND id_menu = '$idMenu' ORDER BY no_transaksi";
$query3 = mysqli_query($koneksi, $sql3);
if(mysqli_num_rows($query3)>0){
  $sql3 = "UPDATE tbl_transaksi_detail SET qty =  qty + 1 
  WHERE no_transaksi = '$noTransaksi' AND id_menu = '$idMenu'";
  mysqli_query($koneksi, $sql3);
}else{
  $sql3 = "INSERT INTO tbl_transaksi_detail(no_transaksi, id_menu, qty, harga, kode_member, kode_tenant) VALUES('$noTransaksi', '$idMenu', 1, '$harga', '$kodeMember', '$kode_tenant')";
  mysqli_query($koneksi, $sql3);
}

$sql4 = "UPDATE tbl_menu SET jual =  jual + 1 WHERE id_menu = '$idMenu'";
mysqli_query($koneksi, $sql4);

$sql = "SELECT sum(qty) AS qty, no_transaksi FROM tbl_transaksi_detail WHERE no_transaksi = '$noTransaksi'";
$query  = mysqli_query($koneksi, $sql);
$data   = mysqli_fetch_assoc($query);
$result = [];
$result = $data;
echo json_encode($result);
?>
