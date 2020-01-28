<?php
include("../include/_koneksi.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Data Kritik &amp; Saran</title>
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
						<h4 class="mb-3">Order Masuk</h4>
						<div class="table-responsive-lg">
							<table class="table table-sm">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama Konsumen</th>
										<th>Subjek</th>
										<th colspan="2">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$query = mysqli_query($conn, "SELECT kritik_saran.*, konsumen.nama FROM kritik_saran INNER JOIN konsumen ON kritik_saran.idKonsumen=konsumen.username ORDER BY idKritik DESC");
									if (mysqli_num_rows($query) > 0) {
										$no = 1;
										while ($data = mysqli_fetch_assoc($query)) {
											if ($_SESSION["akses"] == "Admin" and ($data["status"] == "Deliv" or $data["status"] == "RP")) {
												$class = "font-weight-bold";
											} elseif ($_SESSION["akses"] == "Pemilik" and ($data["status"] == "Deliv" or $data["status"] == "RA")) {
												$class = "font-weight-bold";
											} else {
												$class = "";
											}
											
											echo "<tr class='$class'>
											<td>$no</td>
											<td>$data[nama]</td>
											<td>$data[subjek]</td>
											<td>
												<a class='tombol tombol-teal mr-3' href='detail_kritik.php?id=$data[idKritik]'><i class='fas fa-eye'></i> Detail</a>
											</td>
											<td>
												<button class='tombol tombol-red' name='hapus[]' id='$data[idKritik]'><i class='fas fa-trash-alt'></i> Hapus</button>
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
	$("button[name='hapus[]']").on("click", function() {
		$(this).prop("disabled", true);
		$.ajax({
			url: "../include/deleteKritik.php",
			type: "POST",
			data: {id: $(this).prop("id")},
			dataType: "JSON",
			success: function (respon) {
				if (respon.status == "Berhasil") {
					location.href = "data_kritik.php";
				} else {
					$(this).text(respon.status);
				}
			}
		});
	});
</script>