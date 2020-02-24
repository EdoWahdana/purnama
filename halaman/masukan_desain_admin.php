<?php
include("../include/_koneksi.php");

$id = $_GET["id"];

$query = mysqli_query($conn, "SELECT * FROM desainadmin WHERE idDesainAdmin='$id'");
$data = mysqli_fetch_assoc($query);
$kdTransaksi = $data["kdTransaksi"];
$desain = $data["desain"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Masukan tentang Desain</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/font-awesome.css">
  <link rel="stylesheet" href="../css/style.css">

  <style>
  	.jumbotron {
		  padding-top: 10px !important;
		  padding-bottom: 3px !important;
	}
  </style>
</head>
<body>
	<div class="container-fluid px-0">
		<?php include("_menu.php"); ?>
		<div class="konten container mt-5">
			<a href="javascript:history.back()" class="tombol tombol-teal mb-3"><i class="fas fa-chevron-circle-left"></i> Kembali</a>
			<div class="row">
				<div class="col-4 col-lg-6">
					<div class=" shadow-sm p-4 bg-white" style="border-right: 3px solid teal;">
						<p class="text-center h3 mb-3">DESAIN</p>
						<img class="img-fluid" src="../gambar/desainAdmin/<?= $desain ?>">
					</div>
				</div>
				<div class="col-8 col-lg-6">
					<div class="shadow-sm p-4 bg-white" style="border-left: 3px solid teal;">
						<!-- Tempat Kolom Komentar -->
						<div id="tempatKomen" class="container-fluid">


							<!-- Query untuk melakukan read koemntar dan looping hasilnya -->
							<?php
								$query = mysqli_query($conn, "SELECT * FROM masukan WHERE idDesainAdmin='$id'");
								if(mysqli_num_rows($query) > 0){
									while($masukan = mysqli_fetch_assoc($query)){
							?>
							<!-- Section untuk menampilkan komentar semua user -->
							<div id="bagianMasukan" class="row">
								<div class="col-2 text-center">
									<!-- Untuk Menampilkan gambar logo user atau logo admin-->
									<?php 
										if($masukan['username'] == 'admin') {
											echo "
												<img src='../gambar/admin.png' class='img-thumbnail' width='80px'>
												<small class='text-uppercase font-weight-bold' id='username'>$masukan[username]</small>";
										} else {
											echo "
												<img src='../gambar/user.png' class='img-thumbnail' width='80px'>
												<small class='text-muted' id='username'>$masukan[username]</small>";
										}
									?>
								</div>
								<div class="col-10">
									<!-- Untuk menampilkan komentar user menggunakan jumbotron -->
									<div class="jumbotron">
									  <div class="container">
									    <?php 
										    if($masukan['username'] == 'admin') {
										    	echo "<p class='font-weight-bold' id='isiMasukan'>$masukan[isiMasukan]</p>";	
										    } else {
										    	echo "<p id='isiMasukan'>$masukan[isiMasukan]</p>";
										    }
									    ?>
									    <small><p id="waktuMasukan" class="text-muted"><?= $masukan['createdAt'] ?></p></small>
									  </div>
									</div>
								</div>
							</div>

							<?php
									}
								}
							?>

						
							<?php if ($_SESSION["username"] !== "") { ?>

							<!-- Section untuk menampilkan kolom untuk input komentar -->
							<div class="row">
								<div class="col">
									<div class="form-group">
									    <label for="masukanText">Apa masukan anda tentang desain ini ?</label>
									    <textarea class="form-control" id="teksMasukan" rows="1"></textarea>
									    <button type="button" id="inputMasukan" class="komen tombol tombol-teal mt-2">Masukan</button>
									</div>		
								</div>
							</div>	

							<?php } ?>

						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>


  <script src="../js/jquery-3.3.1.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.js"></script>
  <script src="../js/font-awesome.js"></script>
  <script src="../js/misc.js"></script>
</body>
</html>

<script>
	
	$("#inputMasukan").on("click", function() {
		var idDesainAdmin = "<?= $id ?>";
		var username = "<?= $_SESSION['username'] ?>";
		var isiMasukan = $("#teksMasukan").val();
		var createdAt = "<?= date('Y-m-d H:i:s') ?>";

		if(isiMasukan == "") return;

		$.ajax({
			type: "POST",
			url: "../include/inputMasukan.php",
			data : {
				idDesainAdmin: idDesainAdmin,
				username: username,
				isiMasukan: isiMasukan,
				createdAt: createdAt
			},
			dataType: "JSON",
			success: function(respon) {
				if(respon.status == "Berhasil")
					window.location.reload();
			},
			error: function(XMLHttpRequest, respon, error){
				console.log("Error karena " + error + " Respon : " + respon.status);
			}
		});		
	});
</script>