<?php
include("_koneksi.php");

$id = $_POST["id"];

if ($id == "")
	$respon["status"] = "Invalid";
else {
	$query = mysqli_query($conn, "SELECT * FROM kritik_saran WHERE idKritik='$id'");
	$data = mysqli_fetch_assoc($query);
	
	if ($_SESSION["akses"] == "Admin") {
		if ($data["status"] == "Deliv")
			$status = "RA";
		elseif ($data["status"] == "RP")
			$status = "Read";
	} elseif ($_SESSION["akses"] == "Pemilik") {
		if ($data["status"] == "Deliv")
			$status = "RP";
		elseif ($data["status"] == "RA")
			$status = "Read";
	}
	
	$query = mysqli_query($conn, "UPDATE kritik_saran SET status='$status' WHERE idKritik='$id'");
	if ($query)
		$respon["status"] = "Berhasil";
	else
		$respon["status"] = "Gagal update pesan";
}

echo json_encode($respon);
?>