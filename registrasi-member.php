<?php
$judul = "Member Siswa";
include "koneksi.php";
include "header.php";
include "sidebar.php";
include "topbar.php";
?>

<div class="container-fluid pt-3 pb-5 backGambar">
  <div class="row">
    <div class="col-xl-12">
      <h3 class="text-center text-uppercase">Rekapitulasi Member Pembeli</h3>
      <hr class="hr">
    </div>
  </div>

  <div class="row mt-3">
    <div class="col-xl-9 table-responsive">
      <button type="button" class="btn btn-primary btn-sm p-1 mb-3" data-toggle="modal" data-target="#staticBackdrop">&nbsp;
        <i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah&nbsp;&nbsp;
      </button>

      <table class="table table-bordered table-hover" id="member">
        <thead>
          <tr class="text-center">
            <th>No.</th>
            <th>Photo</th>
            <th>Nama</th>
            <th>No. Telp</th>
            <th>Deposit</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no 		= 1;
          $sql 		= "SELECT * FROM tbl_member ORDER BY nama_member";
          $query 	= mysqli_query($koneksi, $sql);
          while ($data = mysqli_fetch_array($query)) { 
            $img = $data['photo'];
            if ($img == "") {
              $img = "no-logo.png";
            }
            $kode_member = $data['kode_member'];
            $sql2   = "SELECT * FROM tbl_login WHERE kode_member = '$kode_member' ORDER BY kode_member";
            $query2 = mysqli_query($koneksi, $sql2);
            if (mysqli_num_rows($query2) > 0) {
              $login = 1;
            } else {
              $login = 0;
            }
          ?>
            <tr>
              <td align="center" width="5%"><?= $no++; ?>.</td>
              <td align="center" width="8%"><img src="img/<?= $img; ?>" alt="photo" width="30px" height="30px"></td>
              <td><?= $data['nama_member']; ?></td>
              <td><?= $data['telp']; ?></td>
              <td align="right"><?= number_format($data['deposit'], 0); ?></td>
              <td align="center" width="12%">
                <a href="registrasi-member-edit.php?kode_member=<?= $data['kode_member']; ?>" class="badge badge-primary p-2" title='Delete'><i class="fas fa-edit"></i></a>
                <?php
                $sql1 = "SELECT * FROM tbl_transaksi WHERE kode_member = '$kode_member' ORDER BY kode_member";
                $query1 	= mysqli_query($koneksi, $sql1);
                if (mysqli_num_rows($query1) == 0) {
                  if ($login == 0) { ?>
                    |
                    <a href="registrasi-member-delete.php?kode_member=<?= $data['kode_member']; ?>" class="badge badge-danger p-2 delete-data" title='Delete'><i class="fas fa-trash"></i></a>
                <?php
                  }
                } ?>
              </td>
            </tr>
          <?php
          } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include "sticky-footer.php"; ?>
<?php include "footer.php"; ?>

<!-- Modal Tambah-->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">
          Input Member
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="registrasi-member-simpan.php" method="post" enctype="multipart/form-data">
          <!-- Nama Member -->
          <div class="input-group mb-1">
            <span class="input-group-text lebar">Nama Member</span>
            <input type="text" name="nama_member" required autocomplete="off" class="form-control form-control-sm" placeholder="Input Nama Member">
          </div>

          <!-- Telp -->
          <div class="input-group mb-1">
            <span class="input-group-text lebar">Telp</span>
            <input type="text" name="telp" required autocomplete="off" class="form-control form-control-sm" placeholder="Input No. Wa / Telp">
          </div>

          <!-- Deposit -->
          <div class="input-group mb-1">
            <span class="input-group-text lebar">Deposit</span>
            <input type="text" name="deposit" required autocomplete="off" class="form-control form-control-sm text-right money angkaSemua" placeholder="Input Deposit">
          </div>

          <!-- Photo -->
          <div class="input-group mb-1">
            <span class="input-group-text lebar">Photo</span>
            <input type="file" name="img" class="form-control form-control-sm" accept="image/*">
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i>&nbsp;&nbsp;Simpan&nbsp;</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#member').dataTable();
  });
</script>
