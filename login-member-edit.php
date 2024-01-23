<style>
  .backGambar{
    height:82vh;
    overflow: hidden;
  }
</style>
<?php
$judul = "Edit Master Login";
include "koneksi.php";
include "header.php";
include "sidebar.php";
include "topbar.php";


$kode_login = $_GET['kode_login'];
$sql      = "SELECT * FROM tbl_login a INNER JOIN tbl_member b ON a.kode_member  = b.kode_member WHERE a.kode_login = '$kode_login'";
$query= mysqli_query($koneksi, $sql);
$data = mysqli_fetch_array($query);
$kode_member = $data['kode_member'];
$nama_member = $data['nama_member'];

?>

<div class="container-fluid pt-3 pb-5 backGambar">
  <div class="row pb-3">
    <div class="col-xl-12">	
      <h3 class="text-center text-uppercase text-dark">Edit Master Login</h3>
      <hr class="hr">
    </div>
  </div>
  <div class="row ml-5">
    <div class="col-xl-5">
      <form action="login-member-update.php" method="post">
        <input type="hidden" name="kode_member" value="<?= $kode_member;?>">

        <div class="input-group mb-1">
          <span class="input-group-text lebar" >Nama Member</span>
          <input class="form-control form-control-sm" type="text" value="<?= $nama_member; ?>" readonly>
        </div>

        <div class="input-group mb-1">
          <span class="input-group-text lebar" >Username</span>
          <input  type="text" name="username" class="form-control form-control-sm" required autocomplete="off" value="<?= $data['username'];?>" readonly>
        </div>

        <?php 
        if($kode!=0){?>
          <div class="input-group mb-1">
            <span class="input-group-text lebar" >Password Lama</span>
            <input type="password" name="password_lama" class="form-control form-control-sm" required >
          </div>
          <?php 
        }?>

        <div class="input-group mb-3">
          <span class="input-group-text lebar" >Password baru</span>
          <input type="password" name="password_baru" class="form-control form-control-sm" required >
        </div>

        <div class="input-group mb-1">
          <button type="submit" class="btn btn-success btn-sm">&nbsp;<i class="fas fa-save"></i>&nbsp;&nbsp;Update&nbsp;&nbsp;</button>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="login.php" class="btn btn-sm btn-warning">&nbsp;<i class="fas fa-redo"></i>&nbsp;&nbsp;Cancel&nbsp;&nbsp;</a>
        </div>
      </form>
		</div>
	</div>
</div>

<?php include "sticky-footer.php"; ?>    
<?php include "footer.php"; ?>
