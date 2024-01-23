<style>
  .backGambar{
    height:82vh;
    overflow: hidden;
  }
</style>

<?php
$judul = "Edit Tenant";
include "koneksi.php";
include "header.php";
include "sidebar.php";
include "topbar.php";

$kode_member = $_GET['kode_member'];
$sql    = "SELECT * FROM tbl_member WHERE kode_member = '$kode_member' AND kode = 2";
$query  = mysqli_query($koneksi, $sql);
$data   = mysqli_fetch_array($query);
$nama_tenant  = $data['nama_tenant'];
$nama_member  = $data['nama_member'];
$alamat       = $data['alamat'];
$telp         = $data['telp'];
$deposit      = $data['deposit'];
$photo        = $data['photo'];

?>

<div class="container-fluid pt-3 pb-5 backGambar">
  <div class="row pb-3">
    <div class="col-xl-12">	
      <h3 class="text-center text-uppercase text-dark">Edit Member Tenant</h3>
      <hr class="hr">
    </div>
  </div>

  <div class="row ml-5">
    <div class="col-xl-6">
      <form action="registrasi-tenant-update.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="kode_member" value="<?= $kode_member;?>">

        
        <!-- Nama Tenant -->
        <div class="input-group mb-1">
          <span class="input-group-text lebar">Nama Tenant</span>
          <input type="text" name="nama_tenant" autocomplete="off" class="form-control form-control-sm" placeholder="Input Nama Tenant" value="<?= $nama_tenant;?>" required>
        </div>

        <!-- Nama Pemilik -->
        <div class="input-group mb-1">
          <span class="input-group-text lebar">Nama Pemilik</span>
          <input type="text" name="nama_member" autocomplete="off" class="form-control form-control-sm" placeholder="Input Nama Member" value="<?= $nama_member;?>" required>
        </div>

        <!-- Alamat -->
        <div class="input-group mb-1">
          <span class="input-group-text lebar">Alamat</span>
          <textarea name="alamat" cols="30" rows="5" class="form-control form-control-sm"><?= $alamat; ?></textarea>
        </div>

        <!-- Telp -->
        <div class="input-group mb-1">
          <span class="input-group-text lebar">Telp</span>
          <input type="text" name="telp" autocomplete="off" class="form-control form-control-sm" placeholder="Input No. Wa / Telp" value="<?= $telp; ?>" required >
        </div>

        <!-- Deposit -->
        <div class="input-group mb-1">
          <span class="input-group-text lebar">Deposit</span>
          <input type="text" name="deposit" autocomplete="off" class="form-control form-control-sm text-right money angkaSemua" value="<?= $deposit; ?>" required >
        </div>

        <!-- Photo -->
        <div class="input-group mb-1">
          <span class="input-group-text lebar">Photo</span>
          <img src="img/<?= $photo;?>" width="60px" height="60px">
        </div>

        <!-- Photo -->
        <div class="input-group mb-1">
          <span class="input-group-text lebar">Photo</span>
          <input type="file" name="img" class="form-control form-control-sm" accept="image/*">
        </div>

        <div class="input-group mt-3">
          <button type="submit" class="btn btn-success btn-sm">&nbsp;<i class="fas fa-save"></i>&nbsp;&nbsp;Update&nbsp;&nbsp;</button>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="registrasi-tenant.php" class="btn btn-sm btn-warning">&nbsp;<i class="fas fa-redo"></i>&nbsp;&nbsp;Cancel&nbsp;&nbsp;</a>
        </div>
      </form>
	  </div>
  </div>
</div>

<?php include "sticky-footer.php"; ?>    
<?php include "footer.php"; ?>
