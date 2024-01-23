<?php
  $judul = "Edit Kelas";
  include "koneksi.php";
  include "header.php";
  include "sidebar.php";
  include "topbar.php";

  $kode_kelas = $_GET['kode_kelas'];
  $sql        = "SELECT * FROM tbl_kelas WHERE kode_kelas = '$kode_kelas'";
  $query      = mysqli_query($koneksi, $sql);
  $data       = mysqli_fetch_array($query);
  $kode_kelas = $data['kode_kelas'];
  $nama_kelas = $data['nama_kelas'];
?>

<div class="container-fluid pt-3 pb-5 backGambar">
  <div class="row pb-3">
    <div class="col-xl-12">	
      <h3 class="text-center text-uppercase text-dark">Edit Nama Kelas</h3>
      <hr class="hr">
    </div>
  </div>
  <div class="row ml-5">
    <div class="col-xl-4">
      <form action="nama-kelas-update.php" method="post">
        <input type="hidden" name="kode_kelas" value="<?= $kode_kelas;?>">
        <input type="hidden" name="nama_kelas1" value="<?= $nama_kelas;?>">
        <div class="input-group mb-2">
          <span class="input-group-text lebar">Nama Kelas</span>
					<input type="text" name="nama_kelas" required autocomplete="off" class="form-control form-control-sm" placeholder="Input Nama Kelas" value="<?= $data['nama_kelas'];?>" >
        </div>

        <div class="input-group">
          <button type="submit" class="btn btn-success btn-sm">&nbsp;<i class="fas fa-save"></i>&nbsp;&nbsp;Update&nbsp;&nbsp;</button>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="nama-kelas.php" class="btn btn-sm btn-warning">&nbsp;<i class="fas fa-redo"></i>&nbsp;&nbsp;Cancel&nbsp;&nbsp;</a>
        </div>
			</form>
		</div>
	</div>
</div>

<?php include "sticky-footer.php"; ?>    
<?php include "footer.php"; ?>
