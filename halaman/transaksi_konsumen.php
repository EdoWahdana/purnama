<?php
include("../include/_koneksi.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Data Order Masuk</title>
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
			<div class="row">
				<div class="col-12">
					<div class="bg-white shadow-sm p-4 mb-5" style="border-top: 3px solid teal;">
						<h4 class="mb-3">Order Masuk</h4>
						<div class="table-responsive-lg">
							<table class="table table-sm text-center">
								<thead>
									<tr>
										<th>No</th>
										<th>Kode</th>
										<th>Tanggal Order</th>
										<th>Jam</th>
										<th>Status</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$query = mysqli_query($conn, "SELECT transaksi.*, konsumen.nama FROM transaksi INNER JOIN konsumen ON transaksi.idKonsumen=konsumen.username WHERE status!='keranjang' AND transaksi.idKonsumen='$_SESSION[username]' AND transaksi.status='proses' ORDER BY tanggal DESC");
									if (mysqli_num_rows($query) > 0) {
										$no = 1;
										while ($data = mysqli_fetch_assoc($query)) {
											echo "<tr>
											<td>$no</td>
											<td>$data[kdTransaksi]</td>
											<td>" . tanggalLengkap(strtotime($data["tanggal"])) . "</td>
											<td>" . date("h:i", strtotime($data["jam"])) . "</td>
											<td class='font-weight-bold'>$data[status]</td>
											<td>
												<a class='tombol tombol-teal mr-3' href='detail_pembayaran_konsumen.php?id=$data[kdTransaksi]'><i class='fas fa-eye'></i> Detail</a>
											</td>
											</tr>";
											$no++;
										}
									} else
										echo "<tr>
										<td align='center' colspan='7'>Tidak ada data</td>
										</tr>";
									?>
								</tbody>
							</table>
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
	
</script>