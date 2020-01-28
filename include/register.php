<?php
include("_koneksi.php");

$nama = $_POST["nama"];
$gender = $_POST["gender"];
$ttl = $_POST["ttl"];
$email = $_POST["email"];
$alamat = $_POST["alamat"];
$desa = $_POST["desa"];
$kecamatan = $_POST["kecamatan"];
$kabupaten = $_POST["kabupaten"];
$provinsi = $_POST["provinsi"];
$username = $_POST["username"];
$password = md5($_POST["password"]);
$noHp = $_POST["noHp"];
$valid = true;

if ($nama == "")
	$respon["status"] = "Isi nama terlebih dahulu";
elseif ($ttl == "")
	$respon["status"] = "Isi ttl terlebih dahulu";
elseif ($email == "")
	$respon["status"] = "Isi email terlebih dahulu";
elseif ($alamat == "")
	$respon["status"] = "Isi alamat terlebih dahulu";
elseif ($desa == "")
	$respon["status"] = "Isi desa terlebih dahulu";
elseif ($kecamatan == "")
	$respon["status"] = "Isi kecamatan terlebih dahulu";
elseif ($kabupaten == "")
	$respon["status"] = "Isi kabupaten terlebih dahulu";
elseif ($provinsi == "")
	$respon["status"] = "Isi provinsi terlebih dahulu";
elseif ($username == "")
	$respon["status"] = "Isi username terlebih dahulu";
elseif ($password == md5(""))
	$respon["status"] = "Isi password terlebih dahulu";
elseif ($noHp == "")
	$respon["status"] = "Isi nomor HP terlebih dahulu";
else {
	$query = mysqli_query($conn, "(SELECT username FROM admin WHERE username='$username')
	UNION
	(SELECT username FROM konsumen WHERE username='$username')");
	if (mysqli_num_rows($query) > 0) {
		$valid = false;
		$respon["status"] = "Username telah terdaftar";
	}
	if (!ctype_digit($noHp)) {
		$valid = false;
		$respon["status"] = "Nomor HP harus angka";
	}
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$valid = false;
		$respon["status"] = "Isi email dengan benar";
	}
	if ($valid) {
		$query = mysqli_query($conn, "INSERT INTO konsumen VALUES(null, '$username', '$password', 'Konsumen', '$nama', '$gender', '$ttl', '$email', '$alamat', '$desa', '$kecamatan', '$kabupaten', '$provinsi', '$noHp', '0')");
		if ($query)
			$respon["status"] = "Berhasil";
		else
			$respon["status"] = "Gagal register";
	}
}

echo json_encode($respon);
?>