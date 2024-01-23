<?php
$judul = "Login";
include "koneksi.php";
include "header.php";
include "sidebar.php";
include "topbar.php";
?>

<div class="container-fluid pt-3 pb-5 backGambar">
  <div class="row">
    <div class="col-xl-12">
      <h3 class="text-center text-uppercase text-dark">Rekapitulasi Master Login </h3>
      <hr class="hr">
    </div>
  </div>

  <div class="row">
    <div class="col-xl-10 table-responsive">
      <?php 
      if($kode==0){?>
        <button type="button" class="btn btn-primary btn-sm px-2 my-3" data-toggle="modal" data-target="#staticBackdrop" title="tambah data">
          <i class="fas fa-plus"></i>&nbsp;Tambah&nbsp;&nbsp;
        </button>
        <?php 
      }?>

      <table class="table table-bordered table-hover" id="login">
        <thead>
          <tr class="text-center">
            <th width="5%">No.</th>
            <th>Nama</th>
            <th>Photo</th>
            <th>Username</th>
            <th>Posisi</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
          <?php 
          if($kode==0){
            $no=2;?>
            <tr>
              <td align="center" width="3%">1.</td>
              <td>Administrator</td>
              <td align="center"><img src="img/male.png" alt="photo" width="40" height="40"></td>
              <td>Admin</td>
              <td>Administrator</td>
              <td></td>
            </tr>
            <?php 
          }else{
            $no=1;
          }?>

          <?php 
            if($kode==0){
              $sql = "SELECT * FROM tbl_login a INNER JOIN tbl_member b ON a.kode_member = b.kode_member WHERE a.kode_login!=1";
            }else{
              $sql = "SELECT * FROM tbl_login a INNER JOIN tbl_member b ON a.kode_member = b.kode_member WHERE a.kode_login!=1 AND a.kode_member = '$kode_member'";
            }
            $query=mysqli_query($koneksi, $sql);
            if(mysqli_num_rows($query)>0){      
              while ($data = mysqli_fetch_array($query)) {
                if($data['kode']==1){
                  $posisi="Pembeli"; // Change "Siswa" to "Pembeli"
                }else{
                  $posisi="Tenant";
                }
                $nama_member = $data['nama_member'];
                $photo1 = $data['photo'];
                if($photo1==""){
                  $photo = "img/no-logo.png";  
                }else{
                  $photo = "img/".$data['photo'];
                }?>
                <tr>
                  <td align="center" width="3%"><?= $no++; ?>.</td>
                  <td><?= $nama_member; ?></td>
                  <td align="center"><img src="<?= $photo; ?>" alt="photo" width="40" height="40"></td>
                  <td><?= $data['username']; ?></td>
                  <td><?= $posisi; ?></td>
                  <td align="center" width="15%">
                    <a href="login-member-edit.php?kode_login=<?= $data['kode_login']; ?>" class="badge badge-primary p-2" title="Edit"><i class="fas fa-edit"></i></a> 
                    <?php 
                    if($kode==0){?>
                      | <a href="login-delete.php?kode_member=<?= $data['kode_member']; ?>" class="badge badge-danger p-2 delete-data" title='Delete'><i class="fas fa-trash"></i></a>
                      <?php 
                    }?>
                  </td>
                </tr>
                <?php
              }
            } 
          ?>
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
					Input Master Login
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<form action="login-simpan.php" method="post">
					<div class="input-group mb-1">
						<span class="input-group-text lebar">Nama Member</span>
						<select name="kode_member" class="form-control-chosen form-control-sm" required>
							<option value="" selected>~ Pilih Nama Member ~</option>
							<?php
							include "koneksi.php";
							$sql = "SELECT * FROM tbl_member WHERE kode_password=1 ORDER BY nama_member";
							$query = mysqli_query($koneksi, $sql);
							while ($data   = mysqli_fetch_array($query)) {?>
								<option value=<?= $data['kode_member']; ?>><?= $data['nama_member']; ?> </option>
							  <?php
							}?>
						</select>
					</div>
			
          <div class="input-group input-group-sm mb-1">
						<span class="input-group-text lebar">Username</span>
						<input type="text" name="username" required autocomplete="off" class="form-control form-control-sm" placeholder="Input Username">
					</div>

          <div class="input-group mb-1">
						<span class="input-group-text lebar">Password</span>
						<input type="password" name="password" required class="form-control form-control-sm" placeholder="Input Password">
					</div>

					<div class="modal-footer">
						<button type="submit" class="btn btn-primary btn-sm">&nbsp;<i class="fas fa-save"></i>&nbsp;&nbsp;Simpan&nbsp;&nbsp;</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#login').dataTable();

		$('.form-control-chosen').chosen({
			allow_single_deselect: true,
		});

	});
</script>