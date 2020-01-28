<div class="d-flex flex-column mb-3">
	<?php if ($_SESSION["akses"] == "Admin") { ?>
	<a href="admin.php" class="side-menu-list"><i class="fas fa-home"></i> Home</a>
	<a href="data_kategori.php" class="side-menu-list">Kategori Produk</a>
	<a href="data_produk.php" class="side-menu-list">Produk</a>
	<a href="data_produk_poin.php" class="side-menu-list">Produk Poin</a>
	<a href="data_order.php" class="side-menu-list">Lihat Order Masuk</a>
	<a href="data_order_poin.php" class="side-menu-list">Lihat Order Poin Masuk</a>
	<a href="dataRequest.php" class="side-menu-list">Lihat Order Request Desain</a>
	<a href="data_laporan_undangan.php" class="side-menu-list">Informasi Data Pesanan</a>
	<a href="data_poin.php" class="side-menu-list">Promo Poin</a>
	<a href="data_ongkir.php" class="side-menu-list">Ongkos Kirim</a>
	<a href="data_ongkir_kurir.php" class="side-menu-list">Jasa Pengiriman</a>
	<a href="data_kurir.php" class="side-menu-list">Kurir</a>
	<?php } elseif ($_SESSION["akses"] == "Pemilik") { ?>
	<a href="data_laporan.php" class="side-menu-list">Laporan Transaksi</a>
	<a href="data_laporan_poin.php" class="side-menu-list">Laporan Transaksi Poin</a>
	
	<?php } ?>
	<a href="data_kritik.php" class="side-menu-list">Kritik &amp; Saran</a>
</div>