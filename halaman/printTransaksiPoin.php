<?php
include("../include/_koneksi.php");

$tanggalAwal = $_POST["tanggalAwal"];
$tanggalAkhir = $_POST["tanggalAkhir"];
?>

<html>
	<body onLoad="window.print();">
		<h4 align="center" style="margin-bottom: 20px;">LAPORAN TRANSAKSI POIN <?php echo strtoupper(tanggalLengkap(strtotime($tanggalAwal)) . " - " . tanggalLengkap(strtotime($tanggalAkhir))); ?></h4>
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
				<td>: Percetakan</td>
			</tr>
		</table>
		<table cellpadding="2" cellspacing="0" border="1" width="100%">
			<thead>
				<tr>
					<th>No</th>
					<th>Kode</th>
					<th>Nama</th>
					<th>Tanggal</th>
					<th>Alamat</th>
					<th>Qty</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$query = mysqli_query($conn, "SELECT transaksipoin.*, konsumen.nama FROM transaksipoin INNER JOIN konsumen ON transaksipoin.idKonsumen=konsumen.username WHERE tanggal BETWEEN '" . date("Y-m-d", strtotime($tanggalAwal)) . "' AND '" . date("Y-m-d", strtotime($tanggalAkhir)) . "' AND status='selesai'");
				if (mysqli_num_rows($query) > 0) {
					$no = 1;
					while ($data = mysqli_fetch_assoc($query)) {
						echo "<tr>
						<td>$no</td>
						<td>$data[kdTransaksiPoin]</td>
						<td>$data[nama]</td>
						<td>" . tanggalLengkap(strtotime($data["tanggal"])) . " " . date("h:i", strtotime($data["jam"])) . "</td>
						<td>$data[alamat]</td>";
						$queryDetail = mysqli_query($conn, "SELECT * FROM detailtransaksipoin WHERE kdTransaksiPoin='$data[kdTransaksiPoin]'");
						$qty = 0;
						$total = 0;
						while ($dataDetail = mysqli_fetch_assoc($queryDetail)) {
							$qty += $dataDetail["qty"];
							$total += $dataDetail["jumlah"];
						}
						echo "<td>$qty</td>
						<td>" . number_format($total, 0, ".", ".") . " poin</td>
						</tr>";
						$no++;
					}
				} else
					echo "<tr>
					<td colspan='7' align='center'>Tidak ada data</td>
					</tr>";
				?>
			</tbody>
		</table>
	</body>
</html>