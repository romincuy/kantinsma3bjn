<style>
  #accordionSidebar{
    background: url("img/standing-banner.jpg");
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

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard-member.php">
    <img src="img/logo-01.png" alt="logo" width="60px" height="60px">
    <span class="sidebar-brand-text mx-3"><?= $judul; ?></span>
  </a>
  <!-- Divider -->
  <hr class="sidebar-divider my-0">

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
    <a class="nav-link" href="dashboard-member.php">
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

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline mt-3">
    <button class="rounded-circle border-0 bg-warning" id="sidebarToggle"></button>
  </div>
</ul>

<div id="content-wrapper" class="d-flex flex-column">
  <div id="content">