<style>
  nav.navbar.navbar-expand.shadow{
    background-color: #1E8BC3;
    color: black;
    font-weight: bold;
    margin-bottom: 0px;
  }
</style>
<?php 
if ($kode_login ==1){
  $nama_member ="Administrator";
  $photo = "sma3.jpg";
}else{
  include "koneksi.php";
  $sql = "SELECT * FROM tbl_member WHERE kode_member = '$kode_member'";
  $query = mysqli_query($koneksi, $sql);
  if (mysqli_num_rows($query)>0){
    $data = mysqli_fetch_array($query);
    $kode = $data['kode'];
    $nama_member = $data['nama_member'];
    $photo = $data['photo'];
    if($photo==""){$photo="no-logo.png";}
  }
}?>

<nav class="navbar navbar-expand topbar static-top shadow">
  <!-- Sidebar Toggle (Topbar) -->
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>

  <div class="d-none d-sm-inline-block ml-md-3 my-2 my-md-0 mw-100 h3" >
    <marquee width="350%" behavior="" direction="left">Selamat Datang : <?= $nama_member; ?></marquee> 
  </div>

  <!-- Topbar Navbar -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img class="img-profile rounded-circle mr-3" src="img/<?= $photo; ?>" title="<?= $nama_member; ?>" >
      </a>

      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <?php 
        if($kode==1){?>  
          <a class="dropdown-item" href="index.php">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Back
          </a>
          <?php 
        }else{?>
          <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Logout
          </a>
          <?php 
        }?>
      </div>
    </li>
  </ul>
</nav>

<!-- SweetAlert2 -->
<div class="info-data" data-infodata="<?php if(isset($_SESSION['info'])){ 
  echo $_SESSION['info']; 
  } 
  unset($_SESSION['info']); ?>">
</div>