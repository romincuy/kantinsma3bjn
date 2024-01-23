<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Cetak Rekapitulasi Member Siswa</title>
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
    <span style="margin-left: 25px; font-size: 24px;">REKAPITULASI MEMBER SISWA</span>
    <table class="table table-bordered table-hover" style="width: 60%; margin-left:25px;">
      <thead>
        <tr class="text-center">
          <th>No.</th>
          <th>Nama Siswa</th>
          <th>Photo</th>
          <th>Telp</th>
          <th>Deposit</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include "koneksi.php";
        $no  = 1;
        $ttl = 0;
        $sql = "SELECT * FROM tbl_member WHERE kode=1";
        $query = mysqli_query($koneksi, $sql);
        while ($data = mysqli_fetch_array($query)) {
          $photo  = $data['photo'];
          if($photo==""){$photo="no-logo.png";}
          $ttl=$ttl+$data['deposit'];?>
          <tr>
            <td align="center" width="5%"><?= $no++; ?>.</td>
            <td><?= $data['nama_member']; ?></td>
            <td align="center"><img src="img/<?= $photo; ?>" alt="photo" width="40" height="40"></td>
            <td><?= $data['telp']; ?></td>
            <td align="right"><?= number_format($data['deposit'],0); ?></td>
          </tr>
        <?php
        } ?>
        <tr>
          <td colspan="4" align="right">Total</td>
          <td align="right"><?= number_format($ttl,0); ?></td>
        </tr>
      </tbody>
    </table>
  </body>
</html>

