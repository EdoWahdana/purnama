<?php
include("../include/_koneksi.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Kontak Kami</title>
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
			<div class="rounded-top bg-white shadow p-5 mx-auto text-center" style="width: 50%; border-bottom: 5px solid teal; margin-top: 85px;">
        <div class="text-left"><a href="utama.php" class="tombol tombol-teal mb-3"><i class="fas fa-chevron-circle-left"></i> Kembali</a></div>
				<h4 class="mb-5">Hubungi kami pada kontak di bawah ini:</h4>
				<p><i class="fas fa-mobile"></i> : 0852-2215-5540 </p>
				<p><i class="fab fa-whatsapp-square"></i> : 0852-2215-5540 </p>
				<p><i class="email"></i> e-mail : purnama@gmail.com </p>
				
				<?php if ($_SESSION["akses"] == "Konsumen") { ?>
				<p class="mt-5">Atau <a style="color: teal;" href="kritik_saran.php">Kirim Kritik &amp; Saran</a></p>
				<?php } ?>
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