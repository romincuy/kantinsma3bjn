<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Cetak Rekapitulasi Customer</title>
    <link rel="shorcut icon" type="text/css" href="img/logo-02-min.jpg">

    <!-- CSS -->
    <link rel="stylesheet" href="css/bootstrap-4_4_1.min.css"/>
    <style>
      tr>th{text-align: center; height: 35px; border: 2px solid;}
      tr>td{padding-left: 5px; vertical-align: middle!important;}
      tr>td>img{margin-top: 3px; margin-bottom: 3px;}
    </style>
  </head>

  <body onload="window.print(); window.onafterprint = window.close; ">
    <br>
    <span style="margin-left: 25px; font-size: 24px;">REKAPITULASI MEMBER TENANT</span>
    <table class="table table-bordered table-hover" style="margin-left: 25px; width: 90%;">
      <thead>
        <tr class="text-center">
          <th>No.</th>
          <th>Nama Tenant</th>
          <th>Nama Pemilik</th>
          <th>Alamat</th>
          <th>Telp</th>
          <th>Deposit</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include "koneksi.php";
        $no = 1;
        $ttl= 0;
        $sql = "SELECT * FROM tbl_member WHERE kode=2";
        $query = mysqli_query($koneksi, $sql);
        while ($data = mysqli_fetch_array($query)) {
          $ttl = $ttl+$data['deposit']; ?>
          <tr>
            <td align="center" width="4%"><?= $no++; ?>.</td>
            <td width="15%"><?= $data['nama_tenant']; ?></td>
            <td width="15%"><?= $data['nama_member']; ?></td>
            <td><?= $data['alamat']; ?></td>
            <td width="10%"><?= $data['telp']; ?></td>
            <td width="12%" align="right"><?= number_format($data['deposit'],0); ?></td>
          </tr>
          <?php
        } ?>
        <tr>
          <td colspan="5" align="right">Total</td>
          <td align="right"><?= number_format($ttl,0); ?></td>
        </tr>
      </tbody>
    </table>
  </body>
</html>

