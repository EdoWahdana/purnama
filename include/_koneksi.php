<?php
date_default_timezone_set("Asia/Jakarta");
if (!session_id()) session_start();

if (!isset($_SESSION["login"])) {
	$_SESSION["login"] = false;
	$_SESSION["username"] = "";
	$_SESSION["akses"] = "";
}

$servername = "localhost";
$username = "root";
$password = "";
$database = "percetakan";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
//if (!$conn) {
//    die("Connection failed: " . mysqli_connect_error());
//}
//echo "Connected successfully";

function tanggalLengkap($tanggal) {
	$bulan = date("m", $tanggal);
	
	if ($bulan == 1)
		$namaBulan = "Januari";
	elseif ($bulan == 2)
		$namaBulan = "Februari";
	elseif ($bulan == 3)
		$namaBulan = "Maret";
	elseif ($bulan == 4)
		$namaBulan = "April";
	elseif ($bulan == 5)
		$namaBulan = "Mei";
	elseif ($bulan == 6)
		$namaBulan = "Juni";
	elseif ($bulan == 7)
		$namaBulan = "Juli";
	elseif ($bulan == 8)
		$namaBulan = "Agustus";
	elseif ($bulan == 9)
		$namaBulan = "September";
	elseif ($bulan == 10)
		$namaBulan = "Oktober";
	elseif ($bulan == 11)
		$namaBulan = "November";
	elseif ($bulan == 12)
		$namaBulan = "Desember";
	
	return date("d", $tanggal) . " " . $namaBulan . " " . date("Y", $tanggal);
}

function konversiBerat($berat) {
	if ($berat >= 1000) {
		$berat = $berat / 1000;
		$satuan = "kg";
	} else
		$satuan = "gram";
	
	return str_replace(".", ",", "$berat $satuan");
}
?>