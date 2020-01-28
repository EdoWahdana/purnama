<?php
include("../include/_koneksi.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cara Pembelian</title>
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
			<div class="rounded-top bg-white shadow p-5 mx-auto" style="width: 75%; border-bottom: 5px solid teal; margin-top: 85px;">
				<a href="utama.php" class="tombol tombol-teal mb-3"><i class="fas fa-chevron-circle-left"></i> Kembali</a>
				<h4 class="text-center">Cara Pembelian</h4>
				<p>
					<ol type="1">
						<li>Lakukan Login / Registrasi terlebih dahulu.</li>
						<li>Klik pada tombol beli pada produk yang ingin anda pesan.</li>
						<li>Produk yang anda pesan akan masuk kedalam keranjang belanja</li>
						<li>Jika sudah selesai, klik tombol selesai belanja , maka akan tampil form untuk pengisian data kustomer</li>
						<li>Setelah diisi , klik tombol proses , maka akan tampil data pembeli beserta produk yang sudah dipesan . Dan juga ada total pembayaran.</li>
						<li>Apabila telah melakukan pembayaran, maka produk/barang akan segera kami kirimkan.</li>
                        
                                                
                                                
                                                
                        <h4 class="text-center">Cara Custom Desain Sendiri</h4>
				<p>
					<ol type="1">
						<li>Lakukan Login / Registrasi terlebih dahulu.</li>
                        <li>Konsumen melakukan chat kepada admin melalui menu pesan untuk berdiskusi mengenai harga atau produk yang akan di pesan</li>
						<li>Klik pada tombol Upload.</li>
						<li>Isikan keterangan dengan ukuran, jenis finishing, dan jumlah produk yang di pesan</li>
						<li>Jika sudah selesai, klik tombol simpan , maka pesanan akan segera di proses</li>
						<li>Apabila produk telah jadi, maka produk/barang akan segera kami kirimkan.</li>
					</ol>
				</p>
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