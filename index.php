<?php
if ($_SESSION["akses"] == "Konsumen" or $_SESSION["akses"] == "")
	header("Location:halaman/utama.php");
else
	header("Location:halaman/admin.php");
?>