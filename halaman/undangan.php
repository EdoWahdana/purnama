<?php
include("../include/_koneksi.php");

$id = $_GET["id"];

$query = mysqli_query($conn, "SELECT * FROM transaksi WHERE kdTransaksi='$id'");
$data = mysqli_fetch_assoc($query);
	
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<title>Data Produk Undangan</title>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<link href='css/bootstrap2.css' rel='stylesheet' type='text/css' />
</head>

<body>

<div class="container">
		<!-- Begin Modal #tambah -->
  <div class="modal-dialog">
    <div class="modal-content">
	
	  <form action="" method="POST" role="form">
	  <p class="text-danger">* harus diisi</p>
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Data Produk Undangan</h4>
      </div>	  
      <div class="modal-body">   
		  <div class="form-group">
			  <label for="KdTransaksi">Kode Transaksi<span class="text-danger">*</span></label>
			  <select name = "KdTransaksi" id="KdTransaksi" class="required">
						<?php 
						$data_login=$_SESSION['username'];
						$query = mysqli_query($conn, "SELECT KdTransaksi FROM transaksi WHERE idKonsumen = '$data_login'AND status ='keranjang';") or die("<b>Error: </b>" . mysqli_error($conn));
						while($tugas=mysqli_fetch_assoc($query)){
						echo "<option value='$tugas[KdTransaksi]'>$tugas[KdTransaksi]</option>";
						}
						?>
						</select>
		  </div>
		  <div class="form-group">
			  <label for="NamaPengantin">Nama Pengantin Pria & Wanita <span class="text-danger">*</span></label>
			  <input type="text" class="form-control" id="NamaPengantin" name="NamaPengantin">
		  </div>
		  <div class="form-group">
			  <label for="NamaOrtu_Pcwo">Nama Ortu Pengantin Pria<span class="text-danger">*</span></label>
			  <input type="text" class="form-control" id="NamaOrtu_Pcwo" name="NamaOrtu_Pcwo">
		  </div>
		  <div class="form-group">
			  <label for="NamaOrtu_Pcwe">Nama Ortu Pengantin Wanita<span class="text-danger">*</span></label>
			  <input type="text" class="form-control" id="NamaOrtu_Pcwe" name="NamaOrtu_Pcwe">
		  </div>
		  <div class="form-group">
			  <label for="JadwalAkad">Jadwal Akad<span class="text-danger">*</span></label>
			  <input type="text" class="form-control" id="JadwalAkad" name="JadwalAkad">
		  </div>
		  <div class="form-group">
			  <label for="AlamatAkad">Alamat Resepsi<span class="text-danger">*</span></label>
			  <textarea class="form-control" id="AlamatAkad" name="AlamatAkad"></textarea>
		  </div>
		  <div class="form-group">
			  <label for="Hiburan">Hiburan<span class="text-danger">*</span></label>
			  <input type="text" class="form-control" id="Hiburan" name="Hiburan" >
		  </div>
		  <div class="form-group">
			  <label for="TurutMengundang">Turut Mengundang<span class="text-danger">*</span></label>
			  <textarea class="form-control" id="TurutMengundang" name="TurutMengundang"></textarea>
		  </div>
		  
		  
	  </div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <input type="submit" class="btn btn-primary" value="Simpan" name="simpan"/>
      </div>
	  </form>
	  
    </div> <!-- end modal content -->

</div>
<!-- End Modal #tambah -->
		<div class="col-md-12">
			<?php include("simpanundangan.php"); ?>
		</div>
</div> <!-- end row -->


<script src="js/jquery.min.js"></script>
<script src="js/bootstrap2.js"></script>

</body>
</html>
