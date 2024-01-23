<?php
  session_start();
  include "koneksi.php";
  if (!isset($_SESSION['id_login'])){
    $id_login = "";
  }else{
    $noTransaksi  = "";
    $qtyPesan     = "";
    $id_login = $_SESSION['id_login'];
    if($id_login!="sudahLogin"){
      $id_login="";
    }else{
      $kode_member= $_SESSION['kode_member'];
      $nama       = $_SESSION['nama'];
     
      $sql = "SELECT sum(b.qty) AS qty, a.no_transaksi FROM tbl_transaksi a INNER JOIN tbl_transaksi_detail b ON a.no_transaksi = b.no_transaksi WHERE a.kode_member = '$kode_member' AND a.total_bayar = 0 ORDER BY a.no_transaksi DESC";
      $query = mysqli_query($koneksi, $sql);
      if(mysqli_num_rows($query)>0){
        $data         = mysqli_fetch_array($query);
        $noTransaksi  = $data['no_transaksi'];
        $qtyPesan     = $data['qty'];
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en" id="home">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-KANTIN</title>
    <link rel="shorcut icon" type="text/css" href="img/smaga.jpg">

    <link rel="stylesheet" href="css/bootstrap-4_4_1.min.css">
    <link rel="stylesheet" href="assets/fontawesome-free/css/all.min.css" >
    <link rel="stylesheet" href="css/styleku.css">
  </head>
  <body>
    <!-- SweetAlert2 -->
	  <div class="info-data" data-infodata="<?php if(isset($_SESSION['info'])){ echo $_SESSION['info']; } unset($_SESSION['info']); ?>"></div>
    
    <!-- Navbar -->
    <nav class="navbar sticky-top navbar-expand-lg shadow">
      <a class="navbar-brand" href="#">
        <img src="img/logo.png" alt="Logo" width="130px" height="40px" class=""> 
        <?php 
        if($id_login==""){
          echo "";
        }else{
          echo ""; 
        }?>  
      </a>
      <?php 
      if($id_login!=""){?>
        <!-- Jika sudah login -->
        <a href="transaksi-member.php" class="page-scroll1">
          <i class="fa fa-shopping-cart" title="Daftar Belanja"></i> <span class="badge badge-success qtyPesan" id="qtyPesan"><?= $qtyPesan; ?></span>
        </a>
        <a href="logout.php" class="page-scroll2" title="LogOut">LOG OUT</a>
        <?php 
      }else{?>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon">
            <hr class="new1">
            <hr class="new2">
            <hr class="new3">
          </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-lg-0">
            <!-- Jika belum login -->
            <?php 
            if($id_login==""){?>
              <li><a href="#about" class="page-scroll">ABOUT</a></li>
              <?php 
              $sql = "SELECT * FROM tbl_menu LIMIT 1";
              $query = mysqli_query($koneksi, $sql);
              if (mysqli_num_rows($query)>0){?>
                <li><a href="#portfolio" class="page-scroll">MENU</a></li>
                <?php 
              }?>
              <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-weight: bold;">LOGIN
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                  <!-- Form login -->
                  <form action="proses.php" method="post">
                    <!-- Username -->
                    <div class="form-group mx-2 my-0 py-0">
                      <input type="text" name="username" class="form-control form-control-sm" placeholder="Username"  autocomplete="off" required>
                    </div>

                    <!-- Password -->
                    <div class="form-group mx-2 my-0 py-0">
                      <input type="password" name="password" class="form-control form-control-sm" placeholder="Password" autocomplete="off" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm ml-2 py-1 my-0">&nbsp;<i class="fa fa-lock"></i>&nbsp;&nbsp;Login&nbsp;&nbsp;</button>
                  </form>
                </div>
              </li>
              <?php 
            }?>
          </ul>
        </div>
        <?php 
      }?>
    </nav>

    <!-- Jika belum login -->
    <?php 
    if($id_login==""){?>
      <!-- Jumbotron -->
      <div class="jumbotron text-center">
        <img src="img/sma3.jpg" alt="Logo" class="rounded-circle" >
        <h1 class="textWarning">E-KANTIN</h1>
        <p class="kopi">SMAN 3 BOJONEGORO</p>
      </div>
      <!-- Akhir Jumbtron -->
      <?php 
    }?>

    <!-- Jika belum login about-->
    <?php 
    if($id_login==""){?>
      <!-- About -->
      <section class="about" id="about">
        <div class="container-fluid imgAbout">
          <div class="row">
            <div class="col-md-12 text-center">
              <h2 class="text-dark">About</h2>
              <hr class="hr">
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-md-6">
              <p class="pKiri">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kantin menjadi salah satu area di sekolah yang patut mendapatkan perhatian khusus. Tidak sekadar menjual makanan minuman yang lezat, kehadiran kantin harus dipastikan menyediakan makanan dan minuman yang sehat, baik makanan utama yang bergizi seimbang atau makanan selingan. <br>
              
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Terdapat empat pilar yang menyokong terwujudnya kantin sehat sekolah yaitu komitmen dan manajemen sekolah; sumber daya manusia; sarana prasarana; dan mutu pangan. Pembinaan k antin sehat tidak hanya melibatkan para pedagang namun juga peserta didik.<br>
              
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Untuk mewujudkan kantin sehat, satuan pendidikan dapat melaksanakan sejumlah kegiatan seperti mengadakan penyuluhan  higiene sanitasi pangan dan  penyuluhan makanan bergizi seimbang untuk food handler.</p>
            </div>
            <div class="col-md-6">
              <p class="pKanan">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Setelah memberikan edukasi, pengawasan juga perlu dilakukan. Pengawasan bisa dilakukan melalui pengisian buku rapor kantin oleh sekolah, inspeksi kantin sekolah, pemberian stiker pada kantin yang memenuhi syarat. Kegiatan tersebut dapat melibatkan instansi kesehatan seperti puskesmas. <br>
              
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Peserta didik juga berperan tidak kalah penting dalam pengawasan kantin sehat. Pihak sekolah dapat melakukan pemberdayaan kader kesehatan sekolah/madrasah untuk melakukan kegiatan peningkatan dan pengawasan. Dengan begitu semua pihak di sekolah memiliki kesadaran tentang pentingnya kantin sehat dan berupaya mewujudkannya. <br>
              
              
              </p>
            </div>
          </div>
        </div>
      </section>
      <!-- Akhir About  -->
      <?php 
    }?>

 <!-- Menu -->
 <?php 
    $sql = "SELECT * FROM tbl_menu";
    $query = mysqli_query($koneksi, $sql);
    if (mysqli_num_rows($query)>0){?>
      <section class="portfolio" id="portfolio">
        <div class="container">
          <div class="row">
            <div class="col-sm-12 text-center">
              <h2>M E N U </h2>
              <hr class="hr">
            </div>
          </div>
          <div class="row menuCustomerBeli">
            <?php 
            $sql = "SELECT * FROM tbl_menu a INNER JOIN tbl_member b ON a.kode_tenant = b.kode_member ORDER BY a.id_jenis_menu, a.nama_menu";
            $query = mysqli_query($koneksi, $sql);
            while ($data = mysqli_fetch_array($query)) {
              if ($data['img']==""){
                $img = "img/no-logo.png";
              }else{ 
                $img = "img/".$data['img'];
              }
              $id_menu    = $data['id_menu'];
              $nama_tenant= strtoupper($data['nama_tenant']);
              $nama_menu  = strtoupper($data['nama_menu']);
              $harga      = number_format($data['harga']);
              $qty        = $data['qty'];
              $jual       = $data['jual'];?>

              <div class="col-sm-3 mb-1">
                <a class="gambar">
                  <input type="hidden" name="noTrans" value="<?= $noTransaksi; ?>">
                  <input type="hidden" name="kode_member" value="<?= $kode_member; ?>">
                  
                  <img src="<?= $img; ?>" alt="<?= $nama_menu; ?>" class="img-responsive">
                  <span></span>
                  <div class="namaTenant"><?= $nama_tenant; ?></div>
                  <div class="menuNama"><?= $nama_menu; ?></div>
                  <div class="menuHarga"><?= "Rp. " .$harga; ?></div>
                  <?php 
                  if($qty-$jual>0){?>
                    <div class="menuPesan">
                      <small class="btn btn-sm btn-success pesanMenu" id2="<?= $id_menu; ?>" id3="<?= $kode_member; ?>"><i class="fa fa-plus"></i></small>
                    </div>
                    <?php 
                  }else{?>
                    <div class="soldOut"><img src="img/soldOut.png" class="imgSold"></div>
                    <?php 
                  }?>
                </a>
              </div>
              <?php 
            }?>
          </div>
        </div>
      </section>
      <?php 
    }?>
    <!-- Akhir Menu -->



    <!-- Footer -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <p class="footer">&copy; Copyright <?= date('Y'); ?> | SMAN 3 BOJONEGORO</p>
          </div>
        </div>
      </div>
    </footer>
    <!-- Akhir Footer -->

    <script src="assets/jquery/jquery.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
	  <script src="js/style-sweetalert2.js"></script>
    
    <?php 
    if($id_login==""){?>
      <script src="js/script.js"></script>
      <?php 
    }else{?>
      <script src="js/script_login.js"></script>
      <?php 
    }?>
    <script>
      $(document).ready(function () {
        $(document).on("click", ".pesanMenu", function () {
          var idMenu      = $(this).attr('id2');
          var kodeMember  = $(this).attr('id3');
          var noTrans     = $('[name="noTrans"]').val();
          $.ajax({
            method: 'POST',
            data: {
              idMenu: idMenu,
              kodeMember: kodeMember,
              noTrans: noTrans
            },
            url: 'transaksi-member-ajax.php',
            cache: false,
            success: function(a) {
              var row = JSON.parse(a);
              var noTransaksi = row.no_transaksi;
              if (noTransaksi!="Saldo Kurang"){
                var qtyPesan = row.qty;
                var stock = row.stock;
                $('[name="noTrans"]').val(noTransaksi);
                $('#qtyPesan').text(qtyPesan);
                $('.menuCustomerBeli').load('transaksi-member-beli.php', {
                  idMenu: idMenu,
                  kodeMember: kodeMember,
                  noTransaksi:noTransaksi
                });
              }else{
                Swal.fire('Saldo DEPOSIT tidak cukup!');
              }
            }
          });
        });

        $(document).on("click", "#userDropdown", function () {
          $('[name="username"]').focus();
        });
      });
    </script>
   </body>
</html>
