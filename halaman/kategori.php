<?php
include("../include/_koneksi.php");

if (!isset($_GET["id"]))
	$id = 1;
else
	$id = $_GET["id"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Kategori</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/font-awesome.css">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<div class="container-fluid px-0">
		<?php include("_menu.php"); ?>
		<div class="konten container mt-5">
			<a href="utama.php" class="tombol tombol-teal mb-3"><i class="fas fa-chevron-circle-left"></i> Kembali</a>
			<div class="row">
				<div class="col-lg-3 col-4 side-menu shadow-sm py-4">
					<p>Kategori</p>
					<div class="d-flex flex-column">
					
						<?php
						$query = mysqli_query($conn, "SELECT * FROM kategori");
						if (mysqli_num_rows($query) > 0) {
							while ($data = mysqli_fetch_assoc($query)) {
								?>
						<a href="kategori.php?id=<?php echo $data["idKategori"]; ?>" class="side-menu-list"><?php echo $data["nmKategori"]; ?></a>
						<?php
							}
						} else {
							echo "<p class='ml-3'>Tidak ada data</p>";
						}
						?>
					</div>
				</div>
				<div class="col-lg-9 col-8">
					<div class="row">
					
						<?php
						$kosong = 0;
						$query = mysqli_query($conn, "SELECT * FROM produk WHERE idKategori='$id'");
						if (mysqli_num_rows($query) > 0) {
							while ($data = mysqli_fetch_assoc($query)) {
								?>
						<div class="col-6 mb-5">
							<a href="produk.php?id=<?php echo $data["idProduk"]; ?>" class="bg-white shadow-sm d-flex flex-column item" style="border-bottom: 2.5px solid teal;">
								<img src="<?php echo $data["gambar"]; ?>" style="height: 200px; object-fit: cover;">
								<span class="small mx-auto pt-3"><?php echo $data["namaProduk"]; ?></span>
								<span class="font-weight-bold mx-auto py-3" style="color: goldenrod;">Rp <?php echo number_format($data["harga"], 0, ".", "."); ?></span>
							</a>
							<?php if ($_SESSION["username"] != "") { ?>
							<button class="btn btn-block" style="background-color: #C05900; color: #ffffff;" name="beli[]" id="<?php echo $data["idProduk"]; ?>">Beli</button>
							<?php } ?>
						</div>
						<?php
							}
						} else
							$kosong++;
						
						$query = mysqli_query($conn, "SELECT * FROM produkpoin WHERE idKategori='$id'");
						if (mysqli_num_rows($query) > 0) {
							while ($data = mysqli_fetch_assoc($query)) {
								?>
						<div class="col-6 mb-5">
							<a href="produk_poin.php?id=<?php echo $data["idProdukPoin"]; ?>" class="bg-white shadow-sm d-flex flex-column item" style="border-bottom: 2.5px solid teal;">
								<img src="<?php echo $data["gambar"]; ?>" style="height: 200px; object-fit: cover;">
								<span class="small mx-auto pt-3"><?php echo $data["namaProduk"]; ?></span>
								<span class="font-weight-bold mx-auto py-3" style="color: goldenrod;"><?php echo number_format($data["jumlahPoin"], 0, ".", "."); ?> poin</span>
							</a>
							<?php if ($_SESSION["username"] != "") { ?>
							<button class="btn btn-block" style="background-color: #00802A; color: #ffffff;" name="tukarPoin[]" id="<?php echo $data["idProdukPoin"]; ?>">Tukar Poin</button>
							<?php } ?>
						</div>
						<?php
							}
						} else
							$kosong++;
						
						if ($kosong == 2)
							echo "<p class='ml-3'>Belum ada produk apapun</p>";
						?>
					</div>
				</div>
				<!-- The Modal -->
				<div class="modal fade" id="popUpBeli">
					<div class="modal-dialog modal-lg modal-dialog-centered">
						<div class="modal-content">
							<!-- Modal Header -->
							<div class="modal-header">
								<input type="text" name="kode" id="kode" hidden>
								<input type="text" name="stok" id="stok" hidden>
								<input type="text" name="poin" id="poin" hidden>
								<input type="text" name="jumlahPoin" id="jumlahPoin" hidden>
								<h4 class="modal-title">Beli <span id="nama"></span></h4>
								<button type="button" class="close" onClick="$('#popUpBeli').modal('hide');">&times;</button>
							</div>
							<!-- Modal body -->
							<div class="modal-body">
								<div class="row">
									<div class="col-4 col-lg-6">
										<img class="img-fluid" src="#" id="gambar">
									</div>
									<div class="col-8 col-lg-6">
										<h4 id="nama1"></h4>
										<p>
										<span class="font-weight-bold">Deskripsi</span><br>
										<span id="deskripsi"></span>
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
									<button type="button" class="tombol tombol-teal m-2">Beli & Kembali Belanja</button>
									<button type="button" class="tombol tombol-teal m-2" id="submitBeli">Tambahkan ke Keranjang</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php include("_footer.php"); ?>
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
	var beli = "";
	
	$("button[name='beli[]']").on("click", function() {
		beli = "beli produk";
		var tombol = $(this);
		var kode = $(this).prop("id");
		$.ajax({
			type: "POST",
			url: "../include/readProduk.php",
			data: {
				kode: kode
			},
			dataType: "JSON",
			success: function(respon) {
				if (respon.status == "Berhasil") {
					$("#kode").val(kode);
					$("#nama").text(respon.nama);
					$("#nama1").text(respon.nama);
					$("#gambar").prop("src", respon.gambar);
					$("#deskripsi").text(respon.deskripsi);
					$("#stok").val(respon.stok);
					$("#popUpBeli").modal("show");
				}
			}
		});
	});
	$("button[name='tukarPoin[]']").on("click", function() {
		beli = "tukar poin";
		var tombol = $(this);
		var kode = $(this).prop("id");
		$.ajax({
			type: "POST",
			url: "../include/readProdukPoin.php",
			data: {
				kode: kode
			},
			dataType: "JSON",
			success: function(respon) {
				if (respon.status == "Berhasil") {
					$("#kode").val(kode);
					$("#nama").text(respon.nama);
					$("#nama1").text(respon.nama);
					$("#gambar").prop("src", respon.gambar);
					$("#deskripsi").text(respon.deskripsi);
					$("#stok").val(respon.stok);
					$("#poin").val(respon.poin);
					$("#jumlahPoin").val(respon.jumlahPoin);
					$("#popUpBeli").modal("show");
				}
			}
		});
	});
	$("#submitBeli").prev().on("click", function() {
		stat = "kembali";
		if (beli == "beli produk") {
			var stok = $("#stok").val();
			var id = "<?php $_SESSION["username"]; ?>";
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
		} else if (beli == "tukar poin") {
			var stok = $("#stok").val();
			var poin = $("#poin").val();
			var jumlahPoin = $("#jumlahPoin").val();
			if (stok == 0) {
				$(this).prop("disabled", true);
				$(".helper span").css("color", "red");
				$(".helper span").html("Stok habis");
			} else if (poin < jumlahPoin) {
				$(this).prop("disabled", true);
				$(".helper span").css("color", "red");
				$(".helper span").html("Poin anda tidak mencukupi");
			} else {
				$(this).prop("disabled", true);
				$(".helper div").prop("hidden", false);
				$(".helper span").html("");
				inputTransaksiPoin();
			}
		}
	});
	$("#submitBeli").on("click", function() {
		stat = "keranjang";
		if (beli == "beli produk") {
			var stok = $("#stok").val();
			var id = "<?php $_SESSION["username"]; ?>";
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
		} else if (beli == "tukar poin") {
			var stok = $("#stok").val();
			var poin = $("#poin").val();
			var jumlahPoin = $("#jumlahPoin").val();
			if (stok == 0) {
				$(this).prop("disabled", true);
				$(".helper span").css("color", "red");
				$(".helper span").html("Stok habis");
			} else if (poin < jumlahPoin) {
				$(this).prop("disabled", true);
				$(".helper span").css("color", "red");
				$(".helper span").html("Poin anda tidak mencukupi");
			} else {
				$(this).prop("disabled", true);
				$(".helper div").prop("hidden", false);
				$(".helper span").html("");
				inputTransaksiPoin();
			}
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
				idProduk: $("#kode").val(),
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
	function inputTransaksiPoin() {
		$.ajax({
			url: "../include/inputTransaksiPoin.php",
			type: "POST",
			data: {
				id: "<?php echo $_SESSION["username"]; ?>"
			},
			dataType: "JSON",
			success: function (respon) {
				if (respon.status == "Berhasil") {
					inputDetailTransaksiPoin(respon.kdTransaksi);
				} else {
					$(".helper span").css("color", "red");
					$(".helper span").html(respon.status);
				}
			}
		});
	}
	function inputDetailTransaksiPoin(kdTransaksi) {
		$.ajax({
			url: "../include/inputDetailTransaksiPoin.php",
			type: "POST",
			data: {
				idProduk: $("#kode").val(),
				idKonsumen: "<?php echo $_SESSION["username"]; ?>",
				kdTransaksi: kdTransaksi
			},
			dataType: "JSON",
			success: function (respon) {
				$("#submitTukar").prop("disabled", false);
				$(".helper div").prop("hidden", true);
				if (respon.status == "Berhasil") {
					if (stat == "kembali")
						location.reload();
					else
						location.href = "keranjang_poin.php";
				} else {
					$(".helper span").css("color", "red");
					$(".helper span").html(respon.status);
				}
			}
		});
	}
</script>