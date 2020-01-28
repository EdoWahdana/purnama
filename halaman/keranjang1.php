<?php
include("../include/_koneksi.php");

$query = mysqli_query($conn, "SELECT * FROM transaksi WHERE idKonsumen='$_SESSION[username]' AND status='keranjang'");
if (mysqli_num_rows($query) > 0) {
	$data = mysqli_fetch_assoc($query);
	$kdTransaksi = $data["kdTransaksi"];
} else
	$kdTransaksi = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Keranjang</title>
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
				<h4 class="mb-4">Keranjang Belanja</h4>
				<div class="row mb-3">
					<div class="col">
						<a href="keranjang.php" style="padding: 10px; background-color: grey; color: white; display: block; width: 100%; text-align: center; font-weight: bold;">Keranjang Belanja</a>
					</div>
					<div class="col">
						<a href="keranjang_poin.php" style="padding: 10px; background-color: grey; color: white; display: block; width: 100%; text-align: center;">Penukaran Poin</a>
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
								<th>Harga</th>
								<th>Total</th>
								<th>Hapus</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$query = mysqli_query($conn, "SELECT * FROM tblorder INNER JOIN transaksi ON tblorder.kdTransaksi=transaksi.kdTransaksi WHERE tblorder.idKonsumen='$_SESSION[username]' AND transaksi.status='keranjang' ORDER BY idOrder");
							if (mysqli_num_rows($query) > 0) {
								$no = 1;
								while ($data = mysqli_fetch_assoc($query)) {
									$queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE idProduk='$data[idProduk]'");
									$dataProduk = mysqli_fetch_assoc($queryProduk);
									$totalHarga = $data["qty"] * $dataProduk["harga"];
									
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
											<input type='text' name='harga[]' value='$dataProduk[harga]' hidden>
											<div class='input-group-append'>
												<button class='btn btn-outline-secondary' type='button' name='tambah[]'>+</button> 
											</div>
										</div>
									</td>
									<td>Rp " . number_format($dataProduk["harga"], 0, ".", ".") . "</td>
									<td>Rp " . number_format($totalHarga, 0, ".", ".") . "</td>
									<td><button class='tombol tombol-red' name='hapus[]' id='$data[idOrder]'><i class='fas fa-trash-alt'></i></button></td>
									</tr>";
									$no++;
								}
							} else
								echo "<tr>
								<td colspan='7' align='center'>Belum ada produk yang akan dipesan</td>
								</tr>";
							?>
						</tbody>
					</table>
					<div class="text-right mt-5">
						<div class="helper text-left" style="display: inline-block;">
							<div class="dot-pulse" style="display: inline-block; margin: 0 20px;" hidden></div>
						</div>
						<button type="button" class="tombol tombol-teal" id="submitBayar">Lanjut Pembayaran</button>	
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
		totalHarga($(this), $(this).next());
	});
	
	$("button[name='tambah[]']").on("click", function() {
		var qty = $(this).parent().prev().prev();
		var nilai = parseInt(qty.val());
		$(qty).val(nilai + 1);
		cekNilai(qty);
		totalHarga(qty, qty.next());
	});
	$("button[name='kurang[]']").on("click", function() {
		var qty = $(this).parent().next();
		var nilai = parseInt(qty.val());
		$(qty).val(nilai - 1);
		cekNilai(qty);
		totalHarga(qty, qty.next());
	});
	
	$("button[name='hapus[]']").on("click", function() {
		$(this).prop("disabled", true);
		$.ajax({
			url: "../include/deleteOrder.php",
			type: "POST",
			data: {
				id: $(this).prop("id"),
				kd: "<?php echo $kdTransaksi; ?>"
			},
			dataType: "JSON",
			success: function (respon) {
				if (respon.status == "Berhasil") {
					location.href = "keranjang.php";
				} else {
					$(this).text(respon.status);
				}
			}
		});
	});
	
	
	$("#submitBayar").on("click", function() {
		var kdTransaksi = "<?php echo $kdTransaksi; ?>";
		if (kdTransaksi == "") {
			$(this).prop("disabled", true);
			$(".helper span").css("color", "red");
			$(".helper span").html("Anda belum memesan apapun");
		} else {
			$(this).prop("disabled", true);
			$(".helper div").prop("hidden", false);
			$(".helper span").html("");
			updateOrder();
		}
	});
	
	function cekNilai(qty) {
		if (qty.val() < 1)
			qty.val(1);
	}
	function totalHarga(q, h) {
		var qty = q.val();
		var harga = h.val();
		var totalHarga = qty * harga;
		q.parent().parent().next().next().text("Rp " + totalHarga.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1.'));
	}
	function updateOrder() {
		$.ajax({
			url: "../include/updateOrder.php",
			type: "POST",
			data: $("input[name='qty[]']").serialize() + "&kdTransaksi=<?php echo $kdTransaksi; ?>&case=bayar",
			dataType: "JSON",
			success: function (respon) {
				$("#submitBayar").prop("disabled", false);
				$(".helper div").prop("hidden", true);
				if (respon.status == "Berhasil") {
					location.href = "pembayaran1.php?id=<?php echo $kdTransaksi; ?>";
				} else {
					$(".helper span").css("color", "red");
					$(".helper span").html(respon.status);
				}
			}
		});
	}
	
</script>