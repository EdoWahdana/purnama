<?php
include("../include/_koneksi.php");
					
//$id = $_GET["id"];
//$query = mysqli_query($conn, "SELECT * FROM transaksi WHERE kdTransaksi='$id'");
//$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Registrasi</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/font-awesome.css">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<div class="container-fluid px-0">
		<?php include("_menu.php"); ?>
		<div class="konten my-5">
			<div class="rounded-top bg-white shadow p-5 mx-auto" style="width: 50%; border-bottom: 5px solid teal;">
			
				<div class="text-left"><a href="keranjang.php" class="tombol tombol-teal mb-3"><i class="fas fa-chevron-circle-left"></i> Kembali </a></div>
                
				<p class="text-danger">* harus diisi</p>
				<form enctype="application/x-www-form-urlencoded" method="POST" action="simpanundangan.php">
					<div class="row mb-3">
						<div class="col-lg-3">
							<label for="kdTransaksi" class="mt-lg-1">Kode Transaksi<span class="text-danger">*</span></label>
						</div>
						<div class="col-lg-9">
						<select name = "kdTransaksi" id="kdTransaksi">
						<?php 
						$data_login=$_SESSION['username'];
						$query = mysqli_query($conn, "SELECT kdTransaksi FROM transaksi WHERE idKonsumen = '$data_login'AND status ='keranjang';") or die("<b>Error: </b>" . mysqli_error($conn));
						while($tugas=mysqli_fetch_assoc($query)){
						echo "<option value='$tugas[kdTransaksi]'>$tugas[kdTransaksi]</option>";
						}
						?>
						</select>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-lg-3">
							<label for="NamaPengantin" >Jenis Produk <span class="text-danger">*</span></label>
						</div>
						<div class="col-lg-9">
							<input type="text" class="form-control" id="NamaPengantin" name="NamaPengantin">
						</div>
					</div>
                    <div class="row mb-3">
						<div class="col-lg-3">
							<label for="NamaOrtu_Pcwo" class="mt-lg-1">Nama <span class="text-danger">*</span></label>
						</div>
						<div class="col-lg-9">
							<input type="text" class="form-control" id="NamaOrtu_Pcwo" name="NamaOrtu_Pcwo">
						</div>
					</div>
                    <div class="row mb-3">
						<div class="col-lg-3">
							<label for="NamaOrtu_Pcwe" class="mt-lg-1">Nama Orang tua<span class="text-danger">*</span></label>
						</div>
						<div class="col-lg-9">
							<input type="text" class="form-control" id="NamaOrtu_Pcwe" name="NamaOrtu_Pcwe">
						</div>
					</div>
                    <div class="row mb-3">
						<div class="col-lg-3">
							<label for="JadwalAkad" class="mt-lg-1">Jadwal Acara<span class="text-danger">*</span></label>
						</div>
						<div class="col-lg-9">
							<input type="text" class="form-control" id="JadwalAkad" name="JadwalAkad">
						</div>
					</div>
                    <div class="row mb-3">
						<div class="col-lg-3">
							<label for="Alamat" class="mt-lg-1">Alamat<span class="text-danger">*</span></label>
						</div>
						<div class="col-lg-9">
							<textarea class="form-control" id="Alamat" name="Alamat"></textarea>
						</div>
					</div>
                    <div class="row mb-3">
						<div class="col-lg-3">
							<label for="Hiburan" class="mt-lg-1">Hiburan<span class="text-danger">*</span></label>
						</div>
						<div class="col-lg-9">
							<input type="text" class="form-control" id="Hiburan" name="Hiburan">
						</div>
					</div>
                    <div class="row mb-3">
						<div class="col-lg-3">
							<label for="TurutMengundang" class="mt-lg-1">Keterangan<span class="text-danger">*</span></label>
						</div>
						<div class="col-lg-9">
							<textarea class="form-control" id="TurutMengundang" name="TurutMengundang"></textarea>
						</div>
                        <tr><td>Note :</td>
                        	<td>1.</td>
                        </tr>
					</div>
                    <div class="row mr-auto">
						<div class="col-lg-9">
							<input type="submit" class="btn btn-primary" value="Simpan" name="simpan" id="btnSimpan"/>
						</div>
					</div>
					</div>
				</form>
			</div>
			
		</div>
		<?php include("_footer.php"); ?>	
	</div>

<script type="text/javascript">

$(document).ready(function(){ 
    $("#btnSimpan").click(function() { 
    alert("Apakah anda ingin menyimpan data undangan !!!");
        $.ajax({
        cache: false,
        type: 'POST',
        url: 'simpanundangan.php',
        data: $("#myForm").serialize(),
        success: function(d) {
            $("#someElement").html(d);
        }
        });
    }); 
});

</script>
	
	
  <script src="../js/jquery-3.3.1.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.js"></script>
  <script src="../js/font-awesome.js"></script>
  <script src="../js/misc.js"></script>
</body>
</html>
