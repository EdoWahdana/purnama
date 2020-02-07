<?php
include("../include/_koneksi.php");

$id = $_GET["id"];

$query = mysqli_query($conn, "SELECT * FROM produk WHERE idProduk='$id'");
$data = mysqli_fetch_assoc($query);
$idKategori = $data["idKategori"];
$nama = $data["namaProduk"];
$deskripsi = $data["deskripsi"];
$harga = $data["harga"];
$gambar = $data["gambar"];
$berat = $data["berat"];
$stok = $data["stok"];

$query = mysqli_query($conn, "SELECT * FROM kategori WHERE idKategori='$idKategori'");
$data = mysqli_fetch_assoc($query);
$nmKategori = $data["nmKategori"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Produk</title>
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
			<a href="utama.php" class="tombol tombol-teal mb-3"><i class="fas fa-chevron-circle-left"></i> Kembali</a>
			<div class="row">
				<div class="col-4 col-lg-6">
					<div class=" shadow-sm p-4 bg-white" style="border-right: 3px solid teal;">
						<img class="img-fluid" src="<?php echo $gambar; ?>">
					</div>
				</div>
				<div class="col-8 col-lg-6">
					<div class="shadow-sm p-4 bg-white" style="border-left: 3px solid teal;">
						<p class="small">Kategori: <?php echo $nmKategori; ?></p>
						<div class="d-lg-flex mb-4">
							<h4><?php echo $nama; ?></h4>
							<span class="align-self-center ml-lg-3" style="color: goldenrod;">Rp <?php echo number_format($harga, 0, ".", "."); ?></span>
						</div>
						<div class="d-flex">
							<p class="small flex-fill">Stok: <?php echo $stok; ?></p>
							<p class="small flex-fill">Berat: <?php echo konversiBerat($berat); ?></p>
						</div>
						<p>
							<span class="font-weight-bold">Deskripsi</span><br>
							<?php echo nl2br($deskripsi); ?>
						</p>

						<p>
							<span class="font-weight-bold">Komentar Pengguna</span><br>
						</p>

						<!-- Tempat Kolom Komentar -->
						<div id="tempatKomen" class="container-fluid">


							<!-- Query untuk melakukan read koemntar dan looping hasilnya -->
							<?php
								$query = mysqli_query($conn, "SELECT * FROM komentar WHERE idProduk='$id'");
								if(mysqli_num_rows($query) > 0){
									while($komentar = mysqli_fetch_assoc($query)){
							?>
							<!-- Section untuk menampilkan komentar semua user -->
							<div id="bagianKomen" class="row">
								<div class="col-2 text-center">
									<!-- Untuk Menampilkan gambar logo user -->
									<img src="../gambar/user.png" class="img-thumbnail" width="80px">
									<small class="text-muted" id="usernameKonsumen"><?= $komentar['usernameKonsumen'] ?></small>
									
								</div>
								<div class="col-10">
									<!-- Untuk menampilkan komentar user menggunakan jumbotron -->
									<div class="jumbotron">
									  <div class="container">
									    <p id="isiKomentar"><?= $komentar['isiKomentar'] ?></p>
									    <small><p id="waktuKomentar" class="text-muted"><?= $komentar['createdAt'] ?></p></small>
									  </div>
									</div>
								</div>
							</div>

							<?php
									}
								}
							?>

						
							<!-- Section untuk menampilkan kolom untuk input komentar -->
							<div class="row">
								<div class="col">
									<div class="form-group">
									    <label for="commentText">Apa komentar anda tentang desain ini ?</label>
									    <textarea class="form-control" id="teksKomen" rows="1"></textarea>
									    <button type="button" id="inputKomentar" class="komen tombol tombol-teal mt-2">Komen</button>
									</div>		
								</div>
							</div>	
						</div>	

						<div class="text-right mt-5">
							<?php if ($_SESSION["username"] == "") { ?>
							<a href="login.php" class="tombol tombol-teal">Log In Untuk Pesan</a>
							<?php } else { ?>
							<button type="submit" class="tombol tombol-teal" data-toggle="modal" data-target="#popUpBeli">Beli</button>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php include("_footer.php"); ?>
	</div>


	<!-- The Modal -->
	<div class="modal fade" id="popUpBeli">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Beli <?php echo $nama; ?></h4>
					<button type="button" class="close" onClick="$('#popUpBeli').modal('hide');">&times;</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body">
					<div class="row">
						<div class="col-4 col-lg-6">
							<img class="img-fluid" src="<?php echo $gambar; ?>">
						</div>
						<div class="col-8 col-lg-6">
							<h4><?php echo $nama; ?></h4>
							<p>
							<span class="font-weight-bold">Deskripsi</span><br>
							<?php echo nl2br($deskripsi); ?>
						</p>
						</div>
					</div>
				</div>
				<!-- Modal footer -->
				<div class="modal-footer">
					<div class="helper text-left" style="display: inline-block;">
						<div class="dot-pulse" style="display: inline-block; margin: 0 20px;" hidden></div>
						<span></span>
					</div>
			        <div style="display: inline-block;">
			            <button type="submit" class="tombol tombol-teal m-2">Kembali Belanja</button>
			            <button type="submit" class="tombol tombol-teal m-2" id="submitBeli">Tambahkan ke Keranjang/Beli</button>
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

	var stat = "";
	
	$("#inputKomentar").on("click", function() {
		var idProduk = "<?= $id ?>";
		var usernameKonsumen = "<?= $_SESSION['username'] ?>";
		var isiKomentar = $("#teksKomen").val();
		var createdAt = "<?= date('Y-m-d H:i:s') ?>";

		if(isiKomentar == "") return;

		$.ajax({
			type: "POST",
			url: "../include/inputKomentar.php",
			data : {
				idProduk: idProduk,
				usernameKonsumen: usernameKonsumen,
				isiKomentar: isiKomentar,
				createdAt: createdAt
			},
			dataType: "JSON",
			success: function(respon) {
				if(respon.status == "Berhasil")
					window.location.reload();
			},
			error: function(XMLHttpRequest, respon, error){
				console.log("Error karena " + error + " Respon : " + respon);
			}
		});		
	});

	$("#submitBeli").prev().on("click", function() {
		var stok = <?php echo $stok; ?>;
		var id = "<?php $_SESSION["username"]; ?>";
		stat = "kembali";
		if (stok == 0) {
			$(this).prop("disabled", true);
			$(".helper span").css("color", "red");
			$(".helper span").html("Stok habis");
		} else {
			$(this).prop("disabled", true);
			$(".helper div").prop("hidden", false);
			$(".helper span").html("");
			inputTransaksi();
		}
	});
	$("#submitBeli").on("click", function() {
		var stok = <?php echo $stok; ?>;
		var id = "<?php $_SESSION["username"]; ?>";
		stat = "keranjang";
		if (stok == 0) {
			$(this).prop("disabled", true);
			$(".helper span").css("color", "red");
			$(".helper span").html("Stok habis");
		} else {
			$(this).prop("disabled", true);
			$(".helper div").prop("hidden", false);
			$(".helper span").html("");
			inputTransaksi();
		}
	});
	
	function inputTransaksi() {
		$.ajax({
			url: "../include/inputTransaksi.php",
			type: "POST",
			data: {
				id: "<?php echo $_SESSION["username"]; ?>"
			},
			dataType: "JSON",
			success: function (respon) {
				if (respon.status == "Berhasil") {
					inputOrder(respon.kdTransaksi);
				} else {
					$(".helper span").css("color", "red");
					$(".helper span").html(respon.status);
				}
			}
		});
	}
	function inputOrder(kdTransaksi) {
		$.ajax({
			url: "../include/inputOrder.php",
			type: "POST",
			data: {
				idProduk: "<?php echo $id; ?>",
				idKonsumen: "<?php echo $_SESSION["username"]; ?>",
				kdTransaksi: kdTransaksi
			},
			dataType: "JSON",
			success: function (respon) {
				$("#submitBeli").prop("disabled", false);
				$(".helper div").prop("hidden", true);
				if (respon.status == "Berhasil") {
					if (stat == "kembali")
						location.reload();
					else
						location.href = "keranjang.php";
				} else {
					$(".helper span").css("color", "red");
					$(".helper span").html(respon.status);
				}
			}
		});
	}
</script>