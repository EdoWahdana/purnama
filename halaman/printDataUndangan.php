<?php
include("../include/_koneksi.php");
$kode= $_POST["kdTransaksi"];

?>

<html>
	<body onLoad="window.print();">
		<h4 align="center" style="margin-bottom: 20px;">Informasi Data Undangan</h4>
		<table border="0" style="margin-bottom: 20px;">
			<tr>
				<td>Nama Perusahaan</td>
				<td>: Percetakan Purnama Jaya</td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td>: Komplek Terminal Ciawigebang</td>
		  </tr>
			<tr>
				<td>Jenis / Bidang Usaha</td>
				<td>: Percetakan </td>
		  </tr>
		</table>
		<table cellpadding="2" cellspacing="0" border="1" width="100%">
			<thead>
				<tr>
					<th>Kode Transaksi</th>
					<th>Jenis Produk</th>
					<th>Nama </th>
					<th>Nama Orang tua</th>
					<th>Jadwal Acara</th>
					<th>Alamat</th>
					<th>Hiburan</th>
					<th>Keterangan</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$query = mysqli_query($conn, "SELECT kdTransaksi,NamaPengantin,NamaOrtu_Pcwo,NamaOrtu_Pcwe,JadwalAkad,Alamat,Hiburan,TurutMengundang FROM dataundangan WHERE kdTransaksi='$kode';");			
					if (mysqli_num_rows($query) > 0) {
					while ($data = mysqli_fetch_assoc($query)) {
						echo "<tr>
						<td>$data[kdTransaksi]</td>
						<td>$data[NamaPengantin]</td>
						<td>$data[NamaOrtu_Pcwo]</td>
						<td>$data[NamaOrtu_Pcwe]</td>
						<td>$data[JadwalAkad]</td>
						<td>$data[Alamat]</td>
						<td>$data[Hiburan]</td>
						<td>$data[TurutMengundang]</td></tr>";
						
					}
				} 
					
				?>
			</tbody>
		</table>
	</body>
</html>