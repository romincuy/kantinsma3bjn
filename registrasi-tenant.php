<?php
  $judul = "Member Tenant";
  include "koneksi.php";
  include "header.php";
  include "sidebar.php";
  include "topbar.php";
?>

<div class="container-fluid pt-3 pb-5 backGambar">
  <div class="row">
    <div class="col-xl-12">
      <h3 class="text-center text-uppercase">Rekapitulasi Member Tenant</h3>
      <hr class="hr">
    </div>
  </div>

  <div class="row mt-3">
    <div class="col-xl-12 table-responsive">
      <button type="button" class="btn btn-primary btn-sm p-1 mb-3" data-toggle="modal" data-target="#staticBackdrop">&nbsp;
        <i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah&nbsp;&nbsp;
      </button>

      <table class="table table-bordered table-hover" id="menu">
        <thead>
          <tr class="text-center">
            <th>No.</th>
            <th>Gambar</th>
            <th>Nama Tenant</th>
            <th>Nama Pemilik</th>
            <th>Alamat</th>
            <th>Telp</th>
            <th>Deposit</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no 		= 1;
          $sql 		= "SELECT * FROM tbl_member WHERE kode=2 ORDER BY kode, kode_member";
          $query 	= mysqli_query($koneksi, $sql);
          while ($data = mysqli_fetch_array($query)) {
            $kode_password = $data['kode_password']; 
            $img = $data['photo'];
            if($img==""){$img="no-logo.png";}
            ?>
            <tr>
              <td align="center" width="5%"><?= $no++; ?>.</td>
              <td align="center" width="8%"><img src="img/<?= $img; ?>" alt="menu" width="30px" height="30px"></td>
              <td><?= $data['nama_tenant']; ?></td>
              <td><?= $data['nama_member']; ?></td>
              <td><?= $data['alamat']; ?></td>
              <td align="right"><?= $data['telp']; ?></td>
              <td align="right"><?= number_format($data['deposit']); ?></td>
              <?php 
              if ($kode_password==2){?>
                <td></td>
                <?php 
              }else{?>
                <td align="center" width="12%"><a href="registrasi-tenant-edit.php?kode_member=<?= $data['kode_member']; ?>" class="badge badge-primary p-2" title="Edit"><i class="fas fa-edit"></i></a> | <a href="registrasi-tenant-delete.php?kode_member=<?= $data['kode_member']; ?>" class="badge badge-danger p-2 delete-data" title='Delete'><i class="fas fa-trash"></i></a> </td>
                <?php 
              }?>
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
					Input Member Tenant
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="registrasi-tenant-simpan.php" method="post" enctype="multipart/form-data">
          <!-- Nama Tenant -->
					<div class="input-group mb-1">
						<span class="input-group-text lebar">Nama Tenant</span>
						<input type="text" name="nama_tenant" required autocomplete="off" class="form-control form-control-sm" placeholder="Input Nama Tenant">
					</div>

          <!-- Nama Pemilik -->
					<div class="input-group mb-1">
						<span class="input-group-text lebar">Nama Pemilik</span>
						<input type="text" name="nama_member" required autocomplete="off" class="form-control form-control-sm" placeholder="Input Nama Pemilik">
					</div>

          <!-- Alamat -->
					<div class="input-group mb-1">
						<span class="input-group-text lebar">Alamat</span>
            <textarea name="alamat" cols="30" rows="5" class="form-control form-control-sm"></textarea>
					</div>

          <!-- Telp -->
					<div class="input-group mb-1">
						<span class="input-group-text lebar">Telp / WA</span>
						<input type="text" name="telp" required autocomplete="off" class="form-control form-control-sm" placeholder="Input Telp / WA">
					</div>

          <!-- Deposit -->
					<div class="input-group mb-1">
						<span class="input-group-text lebar">Deposit</span>
						<input type="text" name="deposit" required autocomplete="off" class="form-control form-control-sm text-right money angkaSemua" placeholder="Input Harga">
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
		$('#menu').dataTable();
	});
</script>