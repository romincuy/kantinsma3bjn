<style>
  .backGambar{
    height:82vh;
    overflow: hidden;
  }
</style>

<?php
$judul = "Edit Member";
include "koneksi.php";
include "header.php";
include "sidebar.php";
include "topbar.php";

$kode_member = $_GET['kode_member'];
$sql    = "SELECT * FROM tbl_member a WHERE a.kode_member = '$kode_member' AND a.kode = 1";
$query  = mysqli_query($koneksi, $sql);
$data   = mysqli_fetch_array($query);
$nama_member  = $data['nama_member'];
$telp         = $data['telp'];
$deposit      = $data['deposit'];
$deposit_awal = $data['deposit'];
$photo        = $data['photo'];
if($photo==""){$photo="no-logo.png";}
$sql1   = "SELECT * FROM tbl_transaksi WHERE kode_member = '$kode_member'";
$query1 = mysqli_query($koneksi, $sql1);
if(mysqli_num_rows($query1)>0){$deposit=0;}

?>

<div class="container-fluid pt-3 pb-5 backGambar">
  <div class="row pb-3">
    <div class="col-xl-12">	
      <h3 class="text-center text-uppercase text-dark">Edit Member Siswa</h3>
      <hr class="hr">
    </div>
  </div>

  <div class="row ml-5">
    <div class="col-xl-4">
      <form action="registrasi-member-update.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="kode_member" value="<?= $kode_member;?>">
        <input type="hidden" name="deposit_awal" value="<?= $deposit_awal;?>">
        <input type="hidden" name="photo" value="<?= $photo;?>">
       
        <!-- Nama Member -->
        <div class="input-group mb-1">
          <span class="input-group-text lebar">Nama Member</span>
          <input type="text" name="nama_member" autocomplete="off" class="form-control form-control-sm" placeholder="Input Nama Member" value="<?= $nama_member;?>"  required>
        </div>

      

        <!-- Telp -->
        <div class="input-group mb-1">
          <span class="input-group-text lebar">Telp</span>
          <input type="text" name="telp" autocomplete="off" class="form-control form-control-sm" placeholder="Input No. Wa / Telp" value="<?= $telp; ?>" required >
        </div>

        <!-- Deposit -->
        <div class="input-group mb-1">
          <?php 
          if($deposit==0){?>
            <span class="input-group-text lebar">Top UP</span>
            <?php
          }else{?>
            <span class="input-group-text lebar">Deposit</span>
            <?php 
          }?>
          <input type="hidden" name="deposit1" value="<?= $deposit; ?>">
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
          <button type="submit" class="btn btn-success btn-sm">&nbsp;<i class="fas fa-save"></i>&nbsp;&nbsp;Update&nbsp;&nbsp;</button>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="registrasi-member.php" class="btn btn-sm btn-warning">&nbsp;<i class="fas fa-redo"></i>&nbsp;&nbsp;Cancel&nbsp;&nbsp;</a>
        </div>
      </form>
	  </div>
  </div>
</div>

<?php include "sticky-footer.php"; ?>    
<?php include "footer.php"; ?>
