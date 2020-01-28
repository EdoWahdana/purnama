<?php
include("_koneksi.php");

$username = $_POST["username"];
$password = md5($_POST["password"]);

if ($username == "") {
	$respon["status"] = "Isi username terlebih dahulu";
} elseif ($password == md5("")) {
	$respon["status"] = "Isi password terlebih dahulu";
} else {
	$query = mysqli_query($conn, "(SELECT username, password, hakAkses FROM admin WHERE username='$username' AND password='$password')
	UNION
	(SELECT username, password, hakAkses FROM konsumen WHERE username='$username' AND password='$password')");
	if (mysqli_num_rows($query) > 0) {
		$data = mysqli_fetch_assoc($query);
		$_SESSION["login"] = true;
		$_SESSION["username"] = $data["username"];
		$_SESSION["akses"] = $data["hakAkses"];
		
		$respon["status"] = "Berhasil";
		$respon["akses"] = $data["hakAkses"];
	} else {
		$respon["status"] = "Username atau password tidak valid";
	}
}

echo json_encode($respon);
?>