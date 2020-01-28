<?php
include("../include/_koneksi.php");

$id = $_GET["id"];

$query = mysqli_query($conn, "SELECT kritik_saran.*, konsumen.nama FROM kritik_saran INNER JOIN konsumen ON kritik_saran.idKonsumen=konsumen.username WHERE idKritik='$id'");
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Detail Kritik &amp; Saran</title>
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
			<a href="data_kritik.php" class="tombol tombol-teal mb-3"><i class="fas fa-chevron-circle-left"></i> Kembali</a>
			<div class="row">
				<div class="col-lg-3 col-4 side-menu shadow-sm py-4">
					<?php include("_sidemenu_admin.php"); ?>
				</div>
				<div class="col-lg-9 col-8">
					<div class="bg-white shadow-sm p-4 mb-5" style="border-top: 3px solid teal;">
						<h4 class="mb-3">Kritik &amp; Saran</h4>
						<p>Dari: <span class="font-weight-bold"><?php echo $data["nama"]; ?></span></p>
						<p>
							Subjek:<br>
							<?php echo $data["subjek"]; ?>
						</p>
						<p>
							Isi Pesan:<br>
							<?php echo nl2br($data["isi"]); ?>
						</p>
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
	var status = "<?php echo $data["status"]; ?>";
	
	if (status != "Read") {
		$.ajax({
			url: "../include/updateKritik.php",
			type: "POST",
			data: {id: "<?php echo $data["idKritik"]; ?>"},
			dataType: "JSON",
			success: function (respon) {
				if (respon.status != "Berhasil") {
					location.href = "data_kritik.php";
				}
			}
		});
	}
</script>