<?php
  $judul = "Nama Kelas";
  include "koneksi.php";
  include "header.php";
  include "sidebar.php";
  include "topbar.php";
?>
<div class="container-fluid pt-3 pb-5 backGambar">
  <div class="row">
    <div class="col-xl-12">
      <h3 class="text-center text-uppercase">Rekapitulasi Nama Kelas</h3>
      <hr class="hr">
    </div>
  </div>

  <div class="row">
    <div class="col-xl-6 table-responsive">
      <button type="button" class="btn btn-primary btn-sm p-1 my-3" data-toggle="modal" data-target="#staticBackdrop">&nbsp;
        <i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah&nbsp;&nbsp;
      </button>

      <table class="table table-bordered table-hover" id="menu">
        <thead>
          <tr class="text-center">
            <th>No.</th>
            <th>Nama Kelas</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no 		= 1;
          $sql 		= "SELECT * FROM tbl_kelas ORDER BY nama_kelas";
          $query 	= mysqli_query($koneksi, $sql);
          while ($data = mysqli_fetch_array($query)) { 
            $kode_kelas = $data['kode_kelas'];?>
            <tr>
              <td align="center" width="5%"><?= $no++; ?>.</td>
              <td><?= $data['nama_kelas']; ?></td>
              <?php 
                $sql1 = "SELECT * FROM tbl_member WHERE kode_kelas = '$kode_kelas' ORDER BY kode_kelas";
                $query1 	= mysqli_query($koneksi, $sql1);
                if(mysqli_num_rows($query1)>0){?>
                  <td></td>
                  <?php 
                }else{?>
                  <td align="center" width="25%">
                    <a href="nama-kelas-edit.php?kode_kelas=<?= $kode_kelas; ?>" class="badge badge-primary p-2" title="Edit"><i class="fas fa-edit"></i></a> | <a href="nama-kelas-delete.php?kode_kelas=<?= $kode_kelas; ?>" class="badge badge-danger delete-data p-2" title='Delete'><i class="fas fa-trash"></i></a> 
                  </td>
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
					Input Nama Kelas
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="nama-kelas-simpan.php" method="post">
					<div class="input-group mb-1">
						<span class="input-group-text lebar">Nama Kelas</span>
						<input type="text" name="nama_kelas" required autocomplete="off" class="form-control form-control-sm" placeholder="Input Nama Kelas" autofocus>
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