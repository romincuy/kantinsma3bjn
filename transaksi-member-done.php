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
      <th>Aksi</th>
    </tr>
  </thead>

  <?php
  include "koneksi.php";
  session_start();
  $kode_member = $_SESSION['kode_member'];
  $no = 1;
  $ttl=0;
  $sql = "SELECT a.id_detail, a.qty, a.harga, a.no_transaksi, b.nama_member, c.tgl_transaksi, d.nama_menu FROM tbl_transaksi_detail a INNER JOIN tbl_member b ON a.kode_member = b.kode_member INNER JOIN tbl_transaksi c ON a.no_transaksi = c.no_transaksi INNER JOIN tbl_menu d ON a.id_menu = d.id_menu WHERE a.kode_tenant = '$kode_member' AND a.dikerjakan=''";
  $query = mysqli_query($koneksi, $sql);
  if(mysqli_num_rows($query)>0){
    $ttl=0;?>
    <tbody>
      <?php
      while ($data = mysqli_fetch_array($query)) {
        $nama_member = $data['nama_member'];
        $no_transaksi= $data['no_transaksi'];
        $ttl = $ttl + $data['harga'] * $data['qty'];
        $tanggal     = date_create($data['tgl_transaksi']);?>
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
          <td align="center"><i class="fa fa-check text-success" id="kerja" id2="<?= $data['id_detail']; ?>"></i></td>
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
<script>
  $(document).ready(function() {
    $('#tblTransaksi').dataTable();
    
  });
</script>