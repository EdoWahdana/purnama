<?php
include("../include/_koneksi.php");

$sql="INSERT INTO dataundangan (kdTransaksi,NamaPengantin,NamaOrtu_Pcwo,NamaOrtu_Pcwe,JadwalAkad,Alamat,Hiburan,TurutMengundang) 
VALUES ('$_POST[kdTransaksi]', '$_POST[NamaPengantin]', '$_POST[NamaOrtu_Pcwo]', '$_POST[NamaOrtu_Pcwe]', '$_POST[JadwalAkad]', '$_POST[Alamat]', '$_POST[Hiburan]', '$_POST[TurutMengundang]')";

if (!mysqli_query($conn,$sql))
  {
  die('Error: ' . mysqli_error($conn));
  }
  header("location: keranjang1.php");
  echo "1 record added";

 mysqli_close($conn);

 ?>