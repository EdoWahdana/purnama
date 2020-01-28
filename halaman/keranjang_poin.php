<?php
include("../include/_koneksi.php");

$query = mysqli_query($conn, "SELECT * FROM transaksipoin WHERE idKonsumen='$_SESSION[username]' AND status='keranjang'");
if (mysqli_num_rows($query) > 0) {
	$data = mysqli_fetch_assoc($query);
	$kdTransaksi = $data["kdTransaksiPoin"];
} else
	$kdTransaksi = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Penukaran Poin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/font-awesome.css">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<div class="container-fluid px-0">
		<?php include("_menu.php"); ?>
		<div class="konten">
			<div class="rounded-top bg-white shadow p-5 mx-auto my-5" style="width: 75%; border-bottom: 5px solid teal;">
				<a href="utama.php" class="tombol tombol-teal mb-3"><i class="fas fa-chevron-circle-left"></i> Kembali</a>
				<h4 class="mb-4">Penukaran Poin</h4>
				<div class="row mb-3">
					<div class="col">
						<a href="keranjang.php" style="padding: 10px; background-color: grey; color: white; display: block; width: 100%; text-align: center;">Keranjang Belanja</a>
					</div>
					<div class="col">
						<a href="keranjang_poin.php" style="padding: 10px; background-color: grey; color: white; display: block; width: 100%; text-align: center; font-weight: bold;">Penukaran Poin</a>
					</div>
				</div>
				<div class="table-responsive-lg">
					<table class="table table-sm">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Produk</th>
								<th>Berat</th>
								<th>Qty</th>
								<th>Jumlah Poin</th>
								<th>Total</th>
								<th>Hapus</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$query = mysqli_query($conn, "SELECT * FROM detailtransaksipoin INNER JOIN transaksipoin ON detailtransaksipoin.kdTransaksiPoin=transaksipoin.kdTransaksiPoin WHERE detailtransaksipoin.idKonsumen='$_SESSION[username]' AND transaksipoin.status='keranjang' ORDER BY idDetailTransaksiPoin");
							if (mysqli_num_rows($query) > 0) {
								$no = 1;
								while ($data = mysqli_fetch_assoc($query)) {
									$queryProduk = mysqli_query($conn, "SELECT * FROM produkpoin WHERE idProdukPoin='$data[idProduk]'");
									$dataProduk = mysqli_fetch_assoc($queryProduk);
									$totalPoin = $data["qty"] * $dataProduk["jumlahPoin"];
									
									if ($data["qty"] == 0)
										$qty = 1;
									else
										$qty = $data["qty"];
									
									echo "<tr>
									<td>$no</td>
									<td>$dataProduk[namaProduk]</td>
									<td>" . konversiBerat($dataProduk["berat"]) . "</td>
									<td>
										<div class='input-group'>
											<div class='input-group-prepend'>
												<button class='btn btn-outline-secondary' type='button' name='kurang[]'>-</button> 
											</div>
											<input type='text' class='form-control text-center' name='qty[]' value='$qty' style='width: 1px;'>
											<input type='text' name='jumlahPoin[]' value='$dataProduk[jumlahPoin]' hidden>
											<div class='input-group-append'>
												<button class='btn btn-outline-secondary' type='button' name='tambah[]'>+</button> 
											</div>
										</div>
									</td>
									<td>" . number_format($dataProduk["jumlahPoin"], 0, ".", ".") . " poin</td>
									<td>" . number_format($totalPoin, 0, ".", ".") . " poin</td>
									<td><button class='tombol tombol-red' name='hapus[]' id='$data[idDetailTransaksiPoin]'><i class='fas fa-trash-alt'></i></button></td>
									</tr>";
									$no++;
								}
							} else
								echo "<tr>
								<td colspan='7' align='center'>Belum ada produk yang akan ditukar</td>
								</tr>";
							?>
						</tbody>
					</table>
					<div class="text-right mt-5">
						<div class="helper text-left" style="display: inline-block;">
							<div class="dot-pulse" style="display: inline-block; margin: 0 20px;" hidden></div>
							<span></span>
						</div>
						<button type="button" class="tombol tombol-teal" id="submitTukar">Lanjut Penukaran</button>
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
	$("input[name='qty[]']").on("keyup blur change", function() {
		cekNilai($(this));
		totalPoin($(this), $(this).next());
	});
	
	$("button[name='tambah[]']").on("click", function() {
		var qty = $(this).parent().prev().prev();
		var nilai = parseInt(qty.val());
		$(qty).val(nilai + 1);
		cekNilai(qty);
		totalPoin(qty, qty.next());
	});
	$("button[name='kurang[]']").on("click", function() {
		var qty = $(this).parent().next();
		var nilai = parseInt(qty.val());
		$(qty).val(nilai - 1);
		cekNilai(qty);
		totalPoin(qty, qty.next());
	});
	
	$("button[name='hapus[]']").on("click", function() {
		$(this).prop("disabled", true);
		$.ajax({
			url: "../include/deleteDetailTransaksiPoin.php",
			type: "POST",
			data: {
				id: $(this).prop("id"),
				kd: "<?php echo $kdTransaksi; ?>"
			},
			dataType: "JSON",
			success: function (respon) {
				if (respon.status == "Berhasil") {
					location.href = "keranjang_poin.php";
				} else {
					$(this).text(respon.status);
				}
			}
		});
	});
	$("#submitTukar").on("click", function() {
		var kdTransaksi = "<?php echo $kdTransaksi; ?>";
		if (kdTransaksi == "") {
			$(this).prop("disabled", true);
			$(".helper span").css("color", "red");
			$(".helper span").html("Anda belum memesan apapun");
		} else {
			$(this).prop("disabled", true);
			$(".helper div").prop("hidden", false);
			$(".helper span").html("");
			updateDetailTransaksiPoin();
		}
	});
	
	function cekNilai(qty) {
		if (qty.val() < 1)
			qty.val(1);
	}
	function totalPoin(q, p) {
		var qty = q.val();
		var harga = p.val();
		var totalPoin = qty * harga;
		q.parent().parent().next().next().text(totalPoin.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1.') + " poin");
	}
	function updateDetailTransaksiPoin() {
		$.ajax({
			url: "../include/updateDetailTransaksiPoin.php",
			type: "POST",
			data: $("input[name='qty[]']").serialize() + "&kdTransaksi=<?php echo $kdTransaksi; ?>&case=tukar",
			dataType: "JSON",
			success: function (respon) {
				$("#submitTukar").prop("disabled", false);
				$(".helper div").prop("hidden", true);
				if (respon.status == "Berhasil") {
					location.href = "pembayaran_poin.php?id=<?php echo $kdTransaksi; ?>";
				} else {
					$(".helper span").css("color", "red");
					$(".helper span").html(respon.status);
				}
			}
		});
	}
</script>