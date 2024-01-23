<style>
  .backGambar{
    height:82vh;
    overflow-y: scroll;

  }
  .display-5{
    position: relative;
    color: black !important;
    font-weight: bold;
    margin-bottom: 15px;
    text-align: center;
  }
  #kerja:hover{
    cursor: pointer;
    
  }
</style>
<?php
  $judul = "H O M E";
  include "koneksi.php";
  include "header.php";
  include "sidebar.php";
  include "topbar.php";
  
  $waktu = date('Y-m-d');
  $kode_login   = $_SESSION['kode_login'];
  $kode_member  = $_SESSION['kode_member'];
  $sql = "SELECT * FROM tbl_member WHERE kode_member='$kode_member'";
  $query = mysqli_query($koneksi, $sql);
  if(mysqli_num_rows($query)>0){
    $data = mysqli_fetch_array($query);
    $kode = $data['kode'];
  }else{
    $kode=0;
  }

?>

<div class="container-fluid backGambar"">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-3">
    <!-- <h1 class="h3 pt-5 text-dark">Dashboard</h1> -->
  </div>

  <!-- Content -->
  <?php
    if($kode==0){?>
      <div class="row mt-5 pt-3">
        <div class="col-md-7 jumbotron m-5">
          <h1 class="display-5">E-KANTIN</h1>
          <hr class="hr" style="width:100%; margin-top: -10px">
        </div>
      </div>
      <?php  
    }
  ?>

  <?php
  // Siswa
  if($kode==1){
    $belanja=0;
    $sql1 = "SELECT deposit FROM tbl_member WHERE kode_member = '$kode_member' AND kode=1";
    $query1 = mysqli_query($koneksi, $sql1);
    if(mysqli_num_rows($query1)>0){
      $data1   = mysqli_fetch_array($query1);
      $deposit = $data1['deposit'];
    }
    
    $sql1a = "SELECT * FROM tbl_transaksi_detail WHERE kode_member = '$kode_member' AND dikerjakan='Y'";
    $query1a = mysqli_query($koneksi, $sql1a);
    if(mysqli_num_rows($query1a)>0){
      while($data1a  = mysqli_fetch_array($query1a)){
        $harga= $data1a['harga'];
        $qty  = $data1a['qty'];
        $belanja = $belanja + $harga*$qty;
      }
    }?>
    
    <div class="row mt-4">
      <!-- Jumlah Deposit -->
      <div class="col-xl-3 col-md-6 mb-2">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="font-weight-bold text-primary text-uppercase mb-1">
                Total Deposit</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($deposit); ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-users fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Jumlah Belanja -->
      <div class="col-xl-3 col-md-6 mb-2">
        <div class="card border-left-danger shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="font-weight-bold text-danger text-uppercase mb-1">
                Total Belanja</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($belanja); ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-users fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    <?php  
  }?>

  <?php
  // Tenant
  if($kode==2){
    $ttl=0;
    $sql = "SELECT * FROM tbl_transaksi_detail WHERE kode_tenant = '$kode_member' AND dikerjakan = 'Y' ORDER BY kode_tenant";
    $query = mysqli_query($koneksi, $sql);
    if(mysqli_num_rows($query)>0){
      while($data = mysqli_fetch_array($query)){
        $harga  = $data['harga'];        
        $qty    = $data['qty'];
        $ttl = $ttl + $harga*$qty;
      }
    } 
    
    $ttl1=0;
    ?>
    <div class="row mt-5 pl-5 pt-3">
      <!-- Total Pendapatan -->
      <div class="col-xl-3 col-md-6 mb-2">
        <div class="card border-left-danger shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="font-weight-bold text-danger text-uppercase mb-1">
                Ttl Penerimaan</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800" id="nilaiPendapatan"><?= number_format($ttl,0); ?> </div>
              </div>
              <div class="col-auto">
                <i class="fa fa-gift fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Penerimaan Hari ini -->
      <div class="col-xl-3 col-md-6 mb-2">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="font-weight-bold text-warning text-uppercase mb-1">Hari ini
                </div>
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= number_format($ttl1); ?></div>
              </div>
              <div class="col-auto">
                <i class="fa fa-credit-card fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-5 pl-5 pt-3">
      <div class="col-xl-12 table-responsive table-dashboard">
        <table class="table table-bordered table-hover table-sm" id="tblTransaksi">
          <thead>
            <tr style="height:40px;text-align:center">
              <th width="5%">No.</th>
              <th>Tgl</th>
              <th>No Transaksi</th>
              <th>Nama Member</th>
              <th>Nama Menu</th>
              <th>Harga</th>
              <th>Qty</th>
              <th>Sub</th>
              <th>Pesan</th>
            </tr>
          </thead>
          <?php
          $no = 1;
          $sql = "SELECT a.id_detail, a.qty, a.harga, a.no_transaksi, c.total_bayar, b.nama_member, c.tgl_transaksi, d.nama_menu FROM tbl_transaksi_detail a INNER JOIN tbl_member b ON a.kode_member = b.kode_member INNER JOIN tbl_transaksi c ON a.no_transaksi = c.no_transaksi INNER JOIN tbl_menu d ON a.id_menu = d.id_menu WHERE a.kode_tenant = '$kode_member' AND a.dikerjakan=''";
          $query = mysqli_query($koneksi, $sql);
          if(mysqli_num_rows($query)>0){?>
            <tbody>
              <?php
              $ttl=0;
              while ($data = mysqli_fetch_array($query)) {
                $nama_member = $data['nama_member'];
                $no_transaksi= $data['no_transaksi'];
                $ttl = $ttl + $data['harga'] * $data['qty'];
                $total_bayar = $data['total_bayar'];
                $tanggal = date_create($data['tgl_transaksi']);?>
                <tr>
                  <td align="center"><?= $no++; ?>.</td>
                  <td align="center"><?= date_format($tanggal, "d-m-Y"); ?></td>
                  <td><?= $no_transaksi; ?></td>
                  <td><?= $nama_member; ?></td>
                  <td><?= $data['nama_menu']; ?></td>
                  <td align="right"><?= number_format($data['harga']); ?></td>
                  <td align="right"><?= number_format($data['qty']); ?></td>
                  <td align="right">
                    <?= number_format($data['harga'] * $data['qty']); ?>
                  </td>
                  <?php 
                  if($total_bayar>0){?>
                    <td align="center"><i class="fa fa-check text-success" id="kerja" id2="<?= $data['id_detail']; ?>" id3="<?= $kode_member;?>"></i></td>
                    <?php 
                  }else{?>
                    <td align="center"><i class="fa fa-question text-danger" title="Belum Bayar"></i></td>
                    <?php 
                  }?>
                </tr>
                <?php
              }?>
            </tbody>
            <tr style="height: 40px;font-weight:bold;text-align:right;font-size:20px;">
              <td colspan="7" align="right">Total</td>
              <td ><?= number_format($ttl); ?></td>
              <td ></td>
            </tr>
            <?php 
          }?>
        </table>
      </div>
    </div>
    <?php
  }?>
</div>

<?php include "sticky-footer.php"; ?>    
<?php include "footer.php"; ?>

<script>
  $(document).ready(function() {
    $('#tblTransaksi').dataTable();

    // Bayar
    $(document).on('click', '#kerja', function() {
      var idDetail = $(this).attr('id2');
      var kode_member = $(this).attr('id3');
      $.ajax({
        method: 'POST',
        data: {
          idDetail: idDetail,
          kode_member: kode_member
        },
        url: 'transaksi-member-dikerjakan.php',
        cache: false,
        success: function(a) {
          $('#nilaiPendapatan').text(a);
          $('.table-dashboard').load('transaksi-member-done.php');
        }
      })
    });

  });

</script>