<?php
include("../include/_koneksi.php");

if (!isset($_GET["id"]))
	$id = 1;
else
	$id = $_GET["id"];

$query = mysqli_query($conn, "SELECT * FROM kurir WHERE idKurir='$id'");
$data = mysqli_fetch_assoc($query);
$namaKurir = $data["namaKurir"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Data Paket Jasa Pengiriman</title>
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
			<a href="admin.php" class="tombol tombol-teal mb-3"><i class="fas fa-chevron-circle-left"></i> Kembali</a>
			<div class="row">
				<div class="col-lg-3 col-4 side-menu shadow-sm py-4">
					<?php include("_sidemenu_admin.php"); ?>
				</div>
				<div class="col-lg-9 col-8">
					<div class="bg-white shadow-sm p-4 mb-5" style="border-top: 3px solid teal;">
						<h4>Paket Jasa Pengiriman <?php echo $namaKurir; ?></h4>
						<div class="row mb-3">
							<?php
							$query = mysqli_query($conn, "SELECT * FROM kurir");
							if (mysqli_num_rows($query) > 0) {
								while ($data = mysqli_fetch_assoc($query)) {
									echo "<div class='col-6 col-lg-3'>
									<a href='data_ongkir_kurir.php?id=$data[idKurir]' class='tombol tombol-teal my-3'>$data[namaKurir]</a>
									</div>";
								}
							} else
								echo "<p>Tidak ada data kurir</p>";
							?>
						</div>
						<a href="tambah_ongkir_kurir.php?id=<?php echo $id; ?>" class="tombol tombol-teal my-3">Tambah Paket Pengiriman</a>
						<div class="table-responsive-lg">
							<table class="table table-sm">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$query = mysqli_query($conn, "SELECT * FROM ongkirkurir WHERE idKurir='$id'");
									if (mysqli_num_rows($query) > 0) {
										$no = 1;
										while ($data = mysqli_fetch_assoc($query)) {
											echo "<tr>
											<td>$no</td>
											<td>$data[namaOngkir]</td>
											<td>
												<a class='tombol tombol-teal mr-3' href='edit_ongkir_kurir.php?id=$data[idOK]'><i class='fas fa-edit'></i> Edit</a> 
												<button class='tombol tombol-red' name='hapus[]' id='$data[idOK]'><i class='fas fa-trash-alt'></i> Hapus</button>
											</td>
											</tr>";
											$no++;
										}
									} else
										echo "<tr>
										<td align='center' colspan='4'>Tidak ada data</td>
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
	$("button[name='hapus[]']").on("click", function() {
		$(this).prop("disabled", true);
		$.ajax({
			url: "../include/deleteOngkirKurir.php",
			type: "POST",
			data: {id: $(this).prop("id")},
			dataType: "JSON",
			success: function (respon) {
				if (respon.status == "Berhasil") {
					location.href = "data_ongkir_kurir.php";
				} else {
					$(this).text(respon.status);
				}
			}
		});
	});
</script>