<?php
  $judul = "Laporan";
  include "koneksi.php";
  include "header.php";
  include "sidebar.php";
  include "topbar.php";
?>

<div class="container-fluid pt-3 pb-5 backGambar">
  <div class="row mt-3">
    <div class="col-xl-8 table-responsive">
      <a href="cetak-laporan-member-siswa.php" class="btn btn-sm btn-success text-white mb-3" target="_blank">&nbsp;<i class="fas fa-print"></i>&nbsp;&nbsp;Member Pembeli&nbsp;&nbsp;</a>

      <table class="table table-bordered table-hover" id="laporanSiswa">
        <thead>
          <tr class="text-center">
            <th>No.</th>
            <th>Nama Pembeli</th>
            <th>Photo</th>
            <th>Telp</th>
            <th>Deposit</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $sql = "SELECT * FROM tbl_member WHERE kode = 1";
          $query = mysqli_query($koneksi, $sql);
          while ($data = mysqli_fetch_array($query)) {
            $photo = $data['photo'];
            if($photo==""){$photo="no-logo.png";}?>
            <tr>
              <td align="center" width="5%"><?= $no++; ?>.</td>
              <td><?= $data['nama_member']; ?></td>
              <td align="center"><img src="img/<?= $photo; ?>" alt="photo" width="40" height="40"></td>
              <td><?= $data['telp']; ?></td>
              <td align="right"><?= number_format($data['deposit'],0); ?></td>
            </tr>
          <?php
          } ?>
        </tbody>
      </table>
		</div>
	</div>
</div>

<?php include "sticky-footer.php"; ?>
<?php include "footer.php"; ?>

<script>
	$(document).ready(function() {
		$('#laporanSiswa').dataTable();
		$('.form-control-chosen').chosen({
			allow_single_deselect: true,
		});
	});
</script>