<style>
  #accordionSidebar{
    background: #6BB9F0;
    background-size:cover;
  }
  li.nav-item{
    margin-top: -10px !important;
    margin-bottom: -10px !important;
  }
  span{
    color: black !important;
    font-weight: bold;
  }
</style>
<?php 
  $kode_login   = $_SESSION['kode_login'];
  $kode_member  = $_SESSION['kode_member'];
  $kode         = $_SESSION['kode'];
?>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
    <!-- <img src="img/logo-01.png" alt="logo" width="60px" height="60px"> -->
    <span class="sidebar-brand-text mx-3"><?= $judul; ?></span>
  </a>
  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="dashboard.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>
  </li>
  <hr class="sidebar-divider my-0">

  <?php
  // Login Sebagai Administrator
  if($kode_login==1){?>
    <!-- Master -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseOne">
        <i class="fas fa-fw fa-cog"></i>
        <span>Master</span>
      </a>
      <div id="collapseSix" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          
    
          <!-- Jenis Menu -->
          <a class="collapse-item" href="jenis-menu.php">
            <i class="fas fa-fw fa-clipboard-list"></i>
            <span>Jenis Menu</span>
          </a>

          <!-- User Login -->
          <a class="collapse-item" href="login.php" >
            <i class="fas fa-fw fa-user"></i>
            <span>User Login</span>
          </a>
        </div>
      </div>
    </li>
    <hr class="sidebar-divider my-0">

    <!-- Registrasi Member -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseOne">
        <i class="fas fa-fw fa-cog"></i>
        <span>Registrasi</span>
      </a>
            
      <div id="collapseFive" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <!-- Registrasi -->
          <a class="collapse-item" href="registrasi-member.php" >
            <i class="fas fa-fw fa-user"></i>
            <span>Registrasi Member</span>
          </a>
          
          <!-- Registrasi Tenant -->
          <a class="collapse-item" href="registrasi-tenant.php" >
            <i class="fas fa-fw fa-user"></i>
            <span>Registrasi Tenant</span>
          </a>

        </div>
      </div>
    </li>
    <hr class="sidebar-divider my-0">

    <!-- Laporan-laporan -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-edit"></i>
        <span>Laporan-laporan</span>
      </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <!-- Member Siswa -->
          <a class="collapse-item" href="laporan-member-siswa.php">
            <i class="fas fa-fw fa-clipboard-list"></i>
            <span>Member Pembeli</span>
          </a>

          <!-- Member Tenant -->
          <a class="collapse-item" href="laporan-member-tenant.php">
            <i class="fas fa-fw fa-clipboard-list"></i>
            <span>Member Tenant</span>
          </a>
          
          <!-- Laporan Jenis Menu -->
          <a class="collapse-item" href="laporan-jenis-menu.php">
            <i class="fas fa-fw fa-clipboard-list"></i>
            <span>Laporan Jenis Menu</span>
          </a>
          
          <!-- Laporan Menu -->
          <a class="collapse-item" href="laporan-menu.php">
            <i class="fas fa-fw fa-clipboard-list"></i>
            <span>Laporan Menu</span>
          </a>

          <!-- Laporan Transaksi -->
          <a class="collapse-item" href="laporan-transaksi.php">
            <i class="fas fa-fw fa-clipboard-list"></i>
            <span>Laporan Transaksi</span>
          </a>

        </div>
      </div>
    </li>
    <?php 

  // Login Sebagai Tenant
  }else if($kode==2){?>
    <li class="nav-item">
      <!-- User Login Tenant-->
      <a class="nav-link" href="login.php" >
        <i class="fas fa-fw fa-user"></i>
        <span>User Login</span>
      </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
      <!-- Daftar Menu -->
      <a class="nav-link collapsed" href="tenant.php">
        <i class="fas fa-fw fa-clipboard-list"></i>
        <span>Daftar Menu</span>
      </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Laporan Transaksi -->
    <li class="nav-item">
      <a class="nav-link" href="laporan-transaksi.php">
        <i class="fas fa-fw fa-clipboard-list"></i>
        <span>Laporan Transaksi</span>
      </a>
    </li>
    <?php 

  // Login Sebagai Siswa
  }else if($kode==1){?>
    <!-- User Login -->
    <li class="nav-item">
      <a class="nav-link" href="login.php" >
        <i class="fas fa-fw fa-user"></i>
        <span>User Login</span>
      </a>
    </li>
    <hr class="sidebar-divider my-0">
  
    <!-- Transaksi -->
    <li class="nav-item">
      <a class="nav-link" href="transaksi-member.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Transaksi</span>
      </a>
    </li>
    <hr class="sidebar-divider my-0">
  
    <!-- Histori -->
    <li class="nav-item">
      <a class="nav-link" href="history-member.php">
        <i class="fas fa-fw fa-clipboard-list"></i>
        <span>History</span>
      </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <?php
  }?>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">
  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline mt-3">
    <button class="rounded-circle border-0 bg-primary" id="sidebarToggle"></button>
  </div>
</ul>

<div id="content-wrapper" class="d-flex flex-column">
  <div id="content">
  