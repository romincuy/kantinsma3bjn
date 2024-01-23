<style>
  .lebar{
    width: 80px !important;
  }
</style>
<?php
  $judul = "Laporan Transaksi";
  include "koneksi.php";
  include "header.php";
  include "sidebar.php";
  include "topbar.php";

$kode_tenant = $_SESSION['kode_member'];
?>

<div class="container-fluid pt-3 pb-5 backGambar">
  <div class="row">
    <div class="col-xl-12">
      <h3 class="text-center text-uppercase text-dark">Rekapituasi Transaksi</h3>
      <hr class="hr">
    </div>
  </div>

  <!-- Periode -->
  <form action="cetak-transaksi.php" method="post" target="_blank">
    <div class="row mb-4 mt-2">
      <div class="col-xl-10">
        <div class="input-group mb-1">
          <span class="input-group-text lebar">Dari</span>
          <input type="date" name="periodeDari" id="periodeDari" class="form-control form-control-sm lebar" value="<?= $tglHariIni; ?>">
          
          <span class="input-group-text lebar">Sampai</span>
          <input type="date" name="periodeSampai" id="periodeSampai" class="form-control form-control-sm" value="<?= $tglHariIni; ?>">
        
          <select name="kode_member" class="form-control form-control-sm form-control-chosen lebar" >
            <option value="" selected>~ Pilih Nama Member~</option>
            <?php
            $sql = "SELECT * FROM tbl_member WHERE kode = 1 ORDER BY nama_member";
            $query 	= mysqli_query($koneksi, $sql);
            while ($k = mysqli_fetch_array($query)) {
              $kode_member  = $k['kode_member'];
              $nama_member  = $k['nama_member'];?>
              <option value="<?= $kode_member;?>"><?= $nama_member;?></option>
              <?php 
            }?>
          </select>
        
          <a class="btn btn-sm btn-primary text-white" id="periodeCari"><i class="fas fa-search pt-1"></i></a>

          <button class="btn btn-sm btn-success text-white" type="submit" id="periodePrint" name="cetak"><i class="fas fa-print"></i></button>
        </div>
      </div>
    </div>
  </form>

  <div class="row">
    <div class="col-xl-12 table-responsive">
      <div id="tampilkanTransaksiPeriode">
        <table class="table table-bordered table-hover table-sm" id="tblTransaksi">
          <thead>
            <tr style="height:40px;text-align:center">
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
            $no = 1;
            $grand=0;
              $sql = "SELECT * FROM tbl_transaksi a INNER JOIN tbl_member b ON a.kode_member = b.kode_member ORDER BY a.tgl_transaksi DESC, a.no_transaksi DESC";
            $query = mysqli_query($koneksi, $sql);
            while ($data = mysqli_fetch_array($query)) {
              $nama_member = $data['nama_member'];
              $no_transaksi= $data['no_transaksi'];
              $tanggal     = date_create($data['tgl_transaksi']);?>
              <tr>
                <td align="center"><?= $no++; ?>.</td>
                <td align="center"><?= date_format($tanggal, "d-m-Y"); ?></td>
                <td><?= $no_transaksi; ?></td>
                <td><?= $nama_member; ?></td>
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
                      $ttl=0;
                      $sql1 = "SELECT a.id_detail, a.qty AS qty, a.harga, a.kode_tenant, b.nama_menu FROM tbl_transaksi_detail a INNER JOIN tbl_menu b ON a.id_menu = b.id_menu WHERE a.no_transaksi = '$no_transaksi' AND a.kode_tenant = '$kode_tenant' ORDER BY a.id_detail";
                      $query1 = mysqli_query($koneksi, $sql1);
                      while ($data1 = mysqli_fetch_array($query1)) { 
                        $ttl=$ttl+($data1['harga']*$data1['qty']);
                        ?>
                        <tr>
                          <td align="center"><?= $nomer++; ?>.</td>
                          <td><?= $data1['nama_menu']; ?></td>
                          <td align="right"><?= number_format($data1['harga']); ?></td>
                          <td align="right"><?= number_format($data1['qty']); ?></td>
                          <td align="right"><?= number_format($data1['harga'] * $data1['qty']); ?>
                          </td>
                        </tr>
                        <?php
                      }
                      $grand= $grand+$ttl;?>
                    </tbody>
                  </table>
                </td>
                <td align="right"><?= number_format($ttl); ?></td>
              </tr>
              <?php
            } ?>
          </tbody>
          <tr style="height: 40px;font-weight:bold;text-align:right;font-size:20px;">
            <td colspan="4" align="right">Total</td>
            <td colspan="2"><?= number_format($grand); ?></td>
            <td colspan="2"></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include "sticky-footer.php"; ?>
<?php include "footer.php"; ?>

<script>
  $(document).ready(function() {
    $('#tblTransaksi').dataTable();
    // Menampilkan Tabel Transaksi Per Periode

    $(document).on('click', '#periodeCari', function() {
      var periodeDari   = $('#periodeDari').val();
      var periodeSampai = $('#periodeSampai').val();
      var kodeMember   = $('[name="kode_member"]').val();
      $.ajax({
        method: 'POST',
        data: {
          periodeDari: periodeDari,
          periodeSampai: periodeSampai,
          kodeMember: kodeMember
        },
        url: 'transaksi-cari-periode.php',
        cache: false,
        success: function() {
          $('#tampilkanTransaksiPeriode').load('transaksi-cari-periode.php', {
            periodeDari: periodeDari,
            periodeSampai: periodeSampai,
            kodeMember: kodeMember
          });
        }
      });
    });

    $('.form-control-chosen').chosen({
      allow_single_deselect: true,
    });
  });
</script>