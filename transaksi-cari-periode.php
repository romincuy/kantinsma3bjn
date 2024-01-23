<?php
  session_start();
  include "koneksi.php";
  $no  = 1;
  $periodeDari   = $_POST['periodeDari'];
  $periodeSampai = $_POST['periodeSampai'];
  $kodeMember    = $_POST['kodeMember'];
?>
<table class="table table-bordered table-hover table-sm" id="tblTransaksi2">
  <thead>
    <tr class="text-center">
      <th width="5%">No.</th>
      <th>Tgl</th>
      <th>No Transaksi</th>
      <th>Nama Member</th>
      <th>Detail</th>
      <th>Total</th>
    </tr>
  </thead>

  <tbody>
    <?php
    $ttl=0;
    if($kodeMember==""){
      $sql = "SELECT * FROM tbl_transaksi a INNER JOIN tbl_member b ON a.kode_member = b.kode_member ORDER BY a.tgl_transaksi DESC, a.no_transaksi";
    }else{
      $sql = "SELECT * FROM tbl_transaksi a INNER JOIN tbl_member b ON a.kode_member = b.kode_member WHERE a.kode_member = '$kodeMember' ORDER BY a.tgl_transaksi DESC, a.no_transaksi";
    }
    $query = mysqli_query($koneksi, $sql);
    if($a=mysqli_num_rows($query)>0){
      while($data = mysqli_fetch_array($query)){
        $tgl      = $data['tgl_transaksi'];
        if(($tgl >= $periodeDari && $tgl <= $periodeSampai) || ($periodeDari == "" && $periodeSampai == "")){
          $nama_member = $data['nama_member'];
          $no_transaksi = $data['no_transaksi'];
          $ttl = $ttl+$data['total_transaksi'];
          $tanggal      = date_create($data['tgl_transaksi']);?>
          <tr>
            <td align="center"><?= $no++;?>.</td>
            <td align="center"><?= date_format($tanggal,"d-m-Y");?></td>
            <td><?= $no_transaksi;?></td>
            <td><?= $nama_member;?></td>
            <td>
              <table class="table table-bordered table-sm">
                <thead>
                  <tr class="text-center bg-success">
                    <th width="5%">No.</th>
                    <th>Nama Menu</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Sub</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $nomer = 1;
                  $sql1 = "SELECT * FROM tbl_transaksi_detail a INNER JOIN tbl_menu b ON a.id_menu = b.id_menu WHERE a.no_transaksi = '$no_transaksi' ORDER BY a.id_detail";
                  $query1 = mysqli_query($koneksi, $sql1);
                  while($data1 = mysqli_fetch_array($query1)){?>
                    <tr>
                      <td align="center"><?= $nomer++;?>.</td>
                      <td><?= $data1['nama_menu'];?></td>
                      <td align="right"><?= number_format($data1['harga']);?></td>
                      <td align="right"><?= number_format($data1['qty']);?></td>
                      <td align="right"><?= number_format($data1['harga']*$data1['qty']);?></td>
                    </tr>
                    <?php
                  }?>
                </tbody>
              </table>
            </td>
            <td align="right"><?= number_format($data['total_transaksi']);?></td>
          </tr>
          <?php
        }
      }
    }?>
  </tbody>
  <tr style="height: 40px;font-weight:bold;text-align:right;font-size:20px;">
    <td colspan="4" align="right">Total</td>
    <td colspan="2"><?= number_format($ttl); ?></td>
    <td colspan="2"></td>
  </tr>
</table>
<script>
	$(document).ready(function() {
		$('#tblTransaksi2').dataTable();
	});
</script>