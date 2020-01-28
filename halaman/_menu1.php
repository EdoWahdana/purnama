<div class="menu-header">
	<ul>
		<div class="clearfix">
			<?php if ($_SESSION["akses"] == "Konsumen" or $_SESSION["akses"] == "") { ?>
			<li><a href="utama.php" class="menu-logo"><i class="fas fa-home"></i></a></li>
			<?php } else { ?>
			<li><a href="admin.php" class="menu-logo"><i class="fas fa-home"></i></a></li>
			<?php } ?>
			<?php if ($_SESSION["login"] and $_SESSION["akses"] == "Konsumen") { ?>
			<li>
				<a href="keranjang.php" class="keranjang">
					<i class="fas fa-shopping-cart fa-2x"></i>
					<span>
						<?php
						$notif = 0;
						$query = mysqli_query($conn, "SELECT * FROM tblorder INNER JOIN transaksi ON tblorder.kdTransaksi=transaksi.kdTransaksi WHERE tblorder.idKonsumen='$_SESSION[username]' AND status='keranjang'");
						$notif += mysqli_num_rows($query);
						$query = mysqli_query($conn, "SELECT * FROM detailtransaksipoin INNER JOIN transaksipoin ON detailtransaksipoin.kdTransaksiPoin=transaksipoin.kdTransaksiPoin WHERE detailtransaksipoin.idKonsumen='$_SESSION[username]' AND status='keranjang'");
						$notif += mysqli_num_rows($query);
						echo $notif;
						?>
					</span>
				</a>
			</li>
			<?php } ?>
			<?php if ($_SESSION["login"] and $_SESSION["akses"] == "Konsumen" or $_SESSION["akses"] == "") { ?>
			<li><a href="kategori.php" class="menu-list"><i class="fas fa-ring"></i><span> Kategori</span></a></li>
			<?php } ?>
			<?php if ($_SESSION["login"] and $_SESSION["akses"] == "Konsumen") { ?>
			<li><a href="konfirmasi.php" class="menu-list"><i class="fas fa-note"></i><span> Konfirmasi Bayar</span></a></li>
			<?php } ?>
			<?php if ($_SESSION["login"] and $_SESSION["akses"] == "Konsumen") { ?>
			<li><a href="request.php" class="menu-list"><i class="fas fa-note"></i><span> Upload</span></a></li>
			<?php } ?>
			<?php if ($_SESSION["login"] and $_SESSION["akses"] == "Konsumen" or $_SESSION["akses"] == "Admin") { ?>
			<li><a href="../livechat/index.php" class="menu-list" target="_blank"><i class="fas fa-inbox"></i><span> Pesan</span></a></li>
			<?php } ?>
			<?php if ($_SESSION["login"] and $_SESSION["akses"] == "Konsumen" or $_SESSION["akses"] == "") { ?>
			<li><a href="cara_beli.php" class="menu-list"><i class="fas fa-question"></i><span> Cara Beli</span></a></li>
			<?php } ?>
			<?php if ($_SESSION["login"] and $_SESSION["akses"] == "Konsumen" or $_SESSION["akses"] == "") { ?>
			<li><a href="sejarah.php" class="menu-list"><i class="fas fa-quote-left"></i><span> Profil Perusahaan</span></a></li>
			<?php } ?>
			<?php if ($_SESSION["login"] and $_SESSION["akses"] == "Konsumen" or $_SESSION["akses"] == "") { ?>
			<li><a href="kontak.php" class="menu-list"><i class="fas fa-inbox"></i><span> Kontak</span></a></li>
			<?php } ?>
			
			<?php if ($_SESSION["login"]) { ?>
				<?php if ($_SESSION["akses"] == "Konsumen") { ?>
			<?php
	$query = mysqli_query($conn, "SELECT * FROM konsumen WHERE username='$_SESSION[username]'");
	$data = mysqli_fetch_assoc($query);
	?>
			<li class="float-right"><a href="profil.php?username=<?php echo $_SESSION["username"]; ?>" class="menu-list"><i class="fas fa-user"></i><span> <?php echo $data["nama"]; ?> <span style="color: #FF9600">[Poin: <?php echo $data["poin"]; ?>]</span></span></a></li>
				<?php } ?>
			<li class="float-right"><a href="../include/logout.php" class="menu-list"><i class="fas fa-sign-out-alt"></i><span> Log Out</span></a></li>
			<?php } else { ?>
			<li class="float-right"><a href="login.php" class="menu-list"><i class="fas fa-sign-in-alt"></i><span> Log In</span></a></li>
			<?php } ?>
		</div>
	</ul>
</div>