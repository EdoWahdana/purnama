<?php
include("../include/_koneksi.php");
$data_login=$_SESSION['username'];
$query = mysqli_query($conn, "SELECT * FROM transaksi WHERE kdTransaksi='$data_login'");
$data = mysqli_fetch_assoc($query);
$idKurir = $data["idKurir"];
$idOngkir = $data["idOngkir"];
$buktiLampiran = $data["buktiLampiran"];					

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Request Desain</title>
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
			
				<div class="text-left"><a href="utama.php" class="tombol tombol-teal mb-3"><i class="fas fa-chevron-circle-left"></i> Kembali </a></div>
                
				
				<form method="POST" action="simpanupload.php" enctype="multipart/form-data">
					<div class="row mb-3">
								<div class="col-lg-3">
									<label for="nama" class="mt-lg-1">Nama</label>
								</div>
								<div class="col-lg-9">
									<input type="text" id="nama" name="nama" value="<?php echo "$data_login"; ?>">
								</div>
							</div>
					
					<div class="row mb-3">
						<div class="col-lg-3">
							<label for="gambarDesain" >Upload Desain</label>
						</div>
						<div class="col-lg-9">
							<input type="file" name="gambarDesain" id="gambarDesain">
						</div>
					</div>
					</br>
					<div class="row mb-3">
						<div class="col-lg-3">
							<label for="buktiBayar" >Upload Bukti Pembayaran</label>
						</div>
						<div class="col-lg-9">
							<input type="file" name="buktiBayar" id="buktiBayar">
						</div>
					</div>
					</br>
					<div class="row mb-3">
								<div class="col-lg-3">
									<label for="keterangan" class="mt-lg-1">Keterangan</label>
								</div>
								<div class="col-lg-9">
									<textarea class="form-control" id="keterangan" name="keterangan"></textarea>
								</div>
							</div>
					<div class="row mb-6">
						<div class="col-lg-3">
						<input type="submit" class="tombol tombol-teal mb-3" value="Simpan" name="simpan" id="btnSimpan"/>
						</div>
					</div>
		
					</div>
				</form>
			</div>
		<?php include("_footer.php"); ?>
	</div>
			
</body>
</html>


<script type="text/javascript">

$(document).ready(function(){ 
    $("#btnSimpan").click(function() { 
    alert("Apakah anda ingin menyimpan konfirmasi pembayaran !!!");
        $.ajax({
        cache: false,
        type: 'POST',
        url: 'simpanupload.php',
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
