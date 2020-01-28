-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2020 at 07:12 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `percetakan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `idAdmin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `hakAkses` varchar(50) NOT NULL,
  PRIMARY KEY (`idAdmin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`idAdmin`, `username`, `password`, `hakAkses`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin'),
(2, 'pemilik', '58399557dae3c60e23c78606771dfa3d', 'Pemilik');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE IF NOT EXISTS `chats` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `time` datetime NOT NULL,
  `text` text NOT NULL,
  `sender` varchar(50) NOT NULL,
  `receiver` varchar(50) NOT NULL,
  `stat` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `time`, `text`, `sender`, `receiver`, `stat`) VALUES
(1, '2019-09-30 06:28:47', 'tes', 'agus', 'admin', '1'),
(2, '2019-09-30 06:30:18', 'tes admin?', 'agus', 'admin', '1'),
(3, '2019-09-30 06:53:22', 'tes', 'agus', 'admin', '1'),
(4, '2019-09-30 08:33:24', 'hiadmin', 'agus', 'admin', '1'),
(5, '2019-09-30 09:16:54', 'tesah', 'agus', 'admin', '1'),
(7, '2019-09-30 09:26:59', 'gusan', 'admin', 'agus', '1'),
(8, '2019-09-30 09:27:54', 'minnnn', 'agus', 'admin', '1');

-- --------------------------------------------------------

--
-- Table structure for table `dataundangan`
--

CREATE TABLE IF NOT EXISTS `dataundangan` (
  `id_undangan` int(10) NOT NULL AUTO_INCREMENT,
  `kdTransaksi` varchar(50) NOT NULL,
  `NamaPengantin` varchar(100) NOT NULL,
  `NamaOrtu_Pcwo` varchar(100) NOT NULL,
  `NamaOrtu_Pcwe` varchar(100) NOT NULL,
  `JadwalAkad` varchar(100) NOT NULL,
  `Alamat` varchar(500) NOT NULL,
  `Hiburan` varchar(100) NOT NULL,
  `TurutMengundang` varchar(500) NOT NULL,
  PRIMARY KEY (`id_undangan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `dataundangan`
--

INSERT INTO `dataundangan` (`id_undangan`, `kdTransaksi`, `NamaPengantin`, `NamaOrtu_Pcwo`, `NamaOrtu_Pcwe`, `JadwalAkad`, `Alamat`, `Hiburan`, `TurutMengundang`) VALUES
(25, 'TRANS0000001', 'oppoopopopo', 'p', 'op', 'op', 'opo', 'po', 'pop'),
(26, 'TRANS0000002', 'jaja', 'mami', '', '27 januari', 'ciomas', '', ''),
(27, 'TRANS0000005', 'kartu nama', 'indra', '', '', '', '', 'alamat : ciomas\r\ntelfn : 0000\r\nemail : iuiwy\r\nperusaaan : iiiuuuytyrt'),
(28, 'TRANS0000006', 'buku yasin', 'q bin w', '', '', '', '', 'lair 3456\r\nwafat 5678'),
(29, 'TRANS0000007', 'yasin', 'kkk', '', '', '', '', 'll'),
(30, 'TRANS0000008', '', '', '', '', '', '', ''),
(31, 'TRANS0000008', 'jj', 'kjk', 'jkj', 'k', 'jkj', 'kj', 'kj'),
(32, 'TRANS0000008', 'iiuiu', 'l[pl', '[p[p', 'l[p', 'l[p', 'll', '['),
(33, 'TRANS0000008', 'oij', 'ijio', 'jo', 'ijoi', 'joi', 'joi', 'jn');

-- --------------------------------------------------------

--
-- Table structure for table `detailtransaksipoin`
--

CREATE TABLE IF NOT EXISTS `detailtransaksipoin` (
  `idDetailTransaksiPoin` int(11) NOT NULL AUTO_INCREMENT,
  `kdTransaksiPoin` varchar(50) NOT NULL,
  `idKonsumen` varchar(50) NOT NULL,
  `idProduk` int(11) NOT NULL,
  `poin` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  PRIMARY KEY (`idDetailTransaksiPoin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `detailtransaksipoin`
--

INSERT INTO `detailtransaksipoin` (`idDetailTransaksiPoin`, `kdTransaksiPoin`, `idKonsumen`, `idProduk`, `poin`, `qty`, `jumlah`) VALUES
(1, 'TRANP0000001', 'indra', 7, 0, 2, 40);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `idKategori` int(11) NOT NULL AUTO_INCREMENT,
  `nmKategori` varchar(30) NOT NULL,
  PRIMARY KEY (`idKategori`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`idKategori`, `nmKategori`) VALUES
(1, 'Undangan Soft Cover'),
(3, 'Undangan Hard Cover'),
(4, 'Buku Yasin'),
(5, 'Kartu Nama');

-- --------------------------------------------------------

--
-- Table structure for table `konsumen`
--

CREATE TABLE IF NOT EXISTS `konsumen` (
  `idKonsumen` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `hakAkses` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `gender` varchar(2) NOT NULL,
  `ttl` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `desa` varchar(50) NOT NULL,
  `kec` varchar(50) NOT NULL,
  `kab` varchar(50) NOT NULL,
  `provinsi` varchar(50) NOT NULL,
  `noHp` varchar(15) NOT NULL,
  `poin` int(11) NOT NULL,
  PRIMARY KEY (`idKonsumen`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `konsumen`
--

INSERT INTO `konsumen` (`idKonsumen`, `username`, `password`, `hakAkses`, `nama`, `gender`, `ttl`, `email`, `alamat`, `desa`, `kec`, `kab`, `provinsi`, `noHp`, `poin`) VALUES
(1, 'aprian', '4fe8d05045161f447b575c3b29f61995', 'Konsumen', 'Dani Apriansyah', 'L', '1995-04-16', 'aprian@gmail.com', 'No. 77', 'Cirendang', 'Kuningan', 'Kuningan', 'Jawa Barat', '89660645681', 59),
(2, 'agus', 'fdf169558242ee051cca1479770ebac3', 'Konsumen', 'Agus', 'L', '1999-08-11', 'agus@gmail.com', 'Jln. Raya Pangkalan', 'Susukan', 'Kuningan', 'Kuningan', 'Jawa Barat', '82121838838', 13),
(3, 'wira', '6215f4770ee800ad5402bc02be783c26', 'Konsumen', 'wira', 'L', '1995-02-07', 'wira@gmail.com', 'tangerang', 'legok', 'Cigugur', 'Kuningan', 'Jawa Barat', '85561234321', 20),
(4, 'indra', 'aff4b352312d5569903d88e0e68d3fbb', 'Konsumen', 'indra', 'L', '1996-07-31', 'indra@gmail.com', 'dusun wage rt 02 rw 04', 'ciomas', 'Kuningan', 'Kuningan', 'Jawa Barat', '85523697207', 10),
(5, '12', 'c20ad4d76fe97759aa27a0c99bff6710', 'Konsumen', '12', 'L', '1992-07-08', 'jkajkjak@gmail.com', 'oaokkslak', 'alkslakl', 'Kuningan', 'Kuningan', 'Jawa Barat', '855234565421', 0),
(6, 'klo', 'c20ad4d76fe97759aa27a0c99bff6710', 'Konsumen', 'ertyu', 'L', '1992-07-08', '8jkiiy@gmail.com', 'mnbvc', 'mnb', 'Kuningan', 'Kuningan', 'Jawa Barat', '876545678', 0),
(7, 'poiuy', 'c20ad4d76fe97759aa27a0c99bff6710', 'Konsumen', 'ertyu', 'L', '1992-07-08', '8jkiiy@gmail.com', 'mnbvc', 'mnb', 'Kuningan', 'Kuningan', 'Jawa Barat', '8765456786', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kritik_saran`
--

CREATE TABLE IF NOT EXISTS `kritik_saran` (
  `idKritik` int(11) NOT NULL AUTO_INCREMENT,
  `idKonsumen` varchar(50) NOT NULL,
  `thread` int(11) NOT NULL,
  `subjek` text NOT NULL,
  `isi` text NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`idKritik`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `kritik_saran`
--

INSERT INTO `kritik_saran` (`idKritik`, `idKonsumen`, `thread`, `subjek`, `isi`, `status`) VALUES
(6, 'agus', 1, 'Ujicoba', 'Tingkatkan fitur', 'Deliv'),
(9, 'agus', 2, 'tes', 'tesss', 'Deliv');

-- --------------------------------------------------------

--
-- Table structure for table `kurir`
--

CREATE TABLE IF NOT EXISTS `kurir` (
  `idKurir` int(11) NOT NULL AUTO_INCREMENT,
  `namaKurir` varchar(50) NOT NULL,
  PRIMARY KEY (`idKurir`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `kurir`
--

INSERT INTO `kurir` (`idKurir`, `namaKurir`) VALUES
(1, 'JNE'),
(2, 'TIKI'),
(3, 'J&T');

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE IF NOT EXISTS `ongkir` (
  `idOngkir` int(11) NOT NULL AUTO_INCREMENT,
  `idKurir` int(11) NOT NULL,
  `idOK` int(11) NOT NULL,
  `ongkir` int(11) NOT NULL,
  `kec` varchar(50) NOT NULL,
  `kab` varchar(50) NOT NULL,
  `prov` varchar(50) NOT NULL,
  PRIMARY KEY (`idOngkir`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`idOngkir`, `idKurir`, `idOK`, `ongkir`, `kec`, `kab`, `prov`) VALUES
(4, 2, 3, 12000, 'Kuningan', 'Kuningan', 'Jawa Barat'),
(6, 2, 4, 20000, 'Kuningan', 'Kuningan', 'Jawa Barat'),
(7, 3, 5, 14000, 'Kuningan', 'Kuningan', 'Jawa Barat'),
(8, 3, 6, 26000, 'Kuningan', 'Kuningan', 'Jawa Barat'),
(10, 1, 1, 12000, 'jatibarang', 'indramayu', 'jawabarat');

-- --------------------------------------------------------

--
-- Table structure for table `ongkirkurir`
--

CREATE TABLE IF NOT EXISTS `ongkirkurir` (
  `idOK` int(11) NOT NULL AUTO_INCREMENT,
  `idKurir` int(11) NOT NULL,
  `namaOngkir` varchar(50) NOT NULL,
  PRIMARY KEY (`idOK`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ongkirkurir`
--

INSERT INTO `ongkirkurir` (`idOK`, `idKurir`, `namaOngkir`) VALUES
(1, 1, 'Reguler'),
(2, 1, '1 Day'),
(3, 2, 'Reguler'),
(4, 2, '1 Day'),
(5, 3, 'Reguler'),
(6, 3, '1 Day');

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE IF NOT EXISTS `pengaturan` (
  `hargaPoin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`hargaPoin`) VALUES
(50000);

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE IF NOT EXISTS `pesan` (
  `id_pesan` int(50) NOT NULL AUTO_INCREMENT,
  `id_pengirim` int(50) NOT NULL,
  `id_penerima` int(50) NOT NULL,
  `tanggal` date NOT NULL,
  `subyek_pesan` varchar(500) NOT NULL,
  `isi_pesan` longtext NOT NULL,
  `sudah_dibaca` enum('Belum','Sudah') NOT NULL,
  PRIMARY KEY (`id_pesan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id_pesan`, `id_pengirim`, `id_penerima`, `tanggal`, `subyek_pesan`, `isi_pesan`, `sudah_dibaca`) VALUES
(1, 2, 1, '2019-09-30', 'oyyyy', 'testostes', 'Belum'),
(2, 2, 1, '2019-09-30', 'tes', 'hi', 'Belum');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE IF NOT EXISTS `produk` (
  `idProduk` int(11) NOT NULL AUTO_INCREMENT,
  `idKategori` int(11) NOT NULL,
  `namaProduk` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` text NOT NULL,
  `stok` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  PRIMARY KEY (`idProduk`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`idProduk`, `idKategori`, `namaProduk`, `deskripsi`, `harga`, `gambar`, `stok`, `berat`) VALUES
(10, 1, 'SCB002', 'Detail :\r\n- Softcover lipat 1, laminasi doff\r\n- Ukuran 15 x 20 cm\r\n- Kertas Ivory 260 gram\r\n- Full color\r\n\r\nHarga di atas, sudah termasuk bonus:\r\n1. Gratis plastik pembungkus\r\n2. Gratis pengemasan', 6000, '../gambar/produk/10/10.jpg', 4600, 3),
(12, 1, 'SCC003', 'Detail :\r\n- Amplop cokelat isi 2 lembar soft cover(Undangan + Denah).\r\n- Ukuran 16 x 21 cm\r\n- Kertas Aster & Kraft\r\n- Full color\r\n\r\nHarga di atas, sudah termasuk bonus:\r\n1. Gratis plastik pembungkus\r\n2. Gratis pengemasan\r\n', 8700, '../gambar/produk/12/12.jpg', 5000, 4),
(14, 3, 'HCA001', 'Detail :\r\n- Amplop Isi 1 single hardcover, dengan hotprint emas.\r\n-Ukuran16 x 21 cm\r\n- Kertas Jasmine\r\n- 1 Warna\r\n\r\nHarga di atas, sudah termasuk bonus:\r\n1. Gratis plastik pembungkus\r\n2. Gratis pengemasan', 9500, '../gambar/produk/14/14.jpg', 5000, 6),
(16, 3, 'HCB002', 'Detail :\r\n- Amplop Isi 1 single hardcover, dengan hotprint emas + emboss 3 titik.\r\n- Ukuran16 x 21 cm\r\n- Kertas Jasmine\r\n- 1 Warna\r\n\r\nHarga di atas, sudah termasuk bonus:\r\n1. Gratis plastik pembungkus\r\n2. Gratis pengemasan\r\n', 10000, '../gambar/produk/16/16.jpg', 5000, 6),
(18, 1, 'SCD004', 'Detail :\r\n- Softcover lipat 1, laminasi doff\r\n- Ukuran 15 x 20 cm\r\n- Kertas Ivory 260 gram\r\n- Full color\r\n\r\nHarga di atas, sudah termasuk bonus:\r\n1. Gratis plastik pembungkus\r\n2. Gratis pengemasan\r\n\r\n', 6000, '../gambar/produk/18/18.jpg', 5000, 3),
(21, 4, 'Buku Yasin Hard Cover Emas Timbul', 'desain buku yasin menggunakan cetakan warna emas pada covernya. Jika disentuh menggunakan tangan, tulisan kaligrafi pada cover atau nama akan terasa menonjol, buku yasin jenis ini juga biasa disebut cover timbul.\r\n\r\nDETAIL PRODUK :\r\n    Kertas isi HVS 70 gsm\r\n    Ukuran kertas 15,5 x 12 cm\r\n    Sampul tebal hardcover\r\n    Isi 192 halaman', 33700, '../gambar/produk/21/21.jpg', 989, 250),
(22, 4, 'Buku Yasin Lengkap Hard Cover', 'Buku yasin jenis ini memiliki isi yang teba\r\n\r\nDETAIL PRODUK :\r\n    Surat Yasin dan bacaan tahlil arab, latin\r\n    Isi buku Yasin 192 halaman\r\n    Cover hot print warna emas / perak\r\n    Dimensi 16 x 12 cm', 34700, '../gambar/produk/22/22.jpeg', 1000, 500),
(23, 4, 'Buku Yasin Silk CoveR', 'yang satu ini akan terasa licin di bagian covernya, punya material khusus yang membuatnya premium dan nyaman digenggam. Kesan premium dan elegan akan dirasakan oleh orang yang memiliki buku Yasin ini.\r\n\r\nDETAIL PRODUK :\r\n    Cover silk premium\r\n    Isi buku kertas licin 192 halaman\r\n    Desain cover dengan huruf timbul yang elegan', 26700, '../gambar/produk/23/23.jpg', 1000, 250),
(24, 4, 'Buku Yasin Soft Cover', 'Cetak buku Yasin soft cover ini cocok untuk hadiah dan souvenir tahlilan untuk pengajian, peringatan 40 hari, peringatan 100 hari, dan peringatan 1000 hari.\r\n\r\nDETAIL PRODUK :\r\n    Isi cetak buku Yasin 192 halaman\r\n    Jenis kertas HVS\r\n    Ukuran cetak buku Yasin 15,5 x 12 cm', 26000, '../gambar/produk/24/24.jpg', 900, 250),
(25, 5, 'IDCARD001', 'Ukuran : 90 x 55 mm\r\nKertas : Artpaper 260 gsm\r\nCetak : 2Sisi\r\nFinishing : Laminasi \r\nFinishing : Potong Kotak ', 50000, '../gambar/produk/25/25.jpg', 1500, 150),
(26, 5, 'IDCARD002', 'Ukuran : 90 x 55 mm\r\nKertas : Artpaper 260 gsm\r\nCetak : 2Sisi\r\nFinishing : Laminasi \r\nFinishing : Potong Kotak ', 50000, '../gambar/produk/26/26.png', 1494, 150);

-- --------------------------------------------------------

--
-- Table structure for table `produkpoin`
--

CREATE TABLE IF NOT EXISTS `produkpoin` (
  `idProdukPoin` int(11) NOT NULL AUTO_INCREMENT,
  `idKategori` int(11) NOT NULL,
  `namaProduk` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `berat` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `jumlahPoin` int(11) NOT NULL,
  `gambar` text NOT NULL,
  PRIMARY KEY (`idProdukPoin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `produkpoin`
--

INSERT INTO `produkpoin` (`idProdukPoin`, `idKategori`, `namaProduk`, `deskripsi`, `berat`, `stok`, `jumlahPoin`, `gambar`) VALUES
(3, 2, 'Gelas Couple', 'Deskripsi', 500, 50, 20, '../gambar/produkpoin/3/3.png'),
(5, 2, 'Jam Dinding', 'Deskripsi', 500, 50, 20, '../gambar/produkpoin/5/5.png'),
(7, 2, 'Dompet', 'Deskripsi', 300, 48, 20, '../gambar/produkpoin/7/7.png');

-- --------------------------------------------------------

--
-- Table structure for table `reqdesain`
--

CREATE TABLE IF NOT EXISTS `reqdesain` (
  `idReqdesain` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `gambarDesain` text NOT NULL,
  `buktiBayar` text NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`idReqdesain`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `reqdesain`
--

INSERT INTO `reqdesain` (`idReqdesain`, `nama`, `gambarDesain`, `buktiBayar`, `keterangan`) VALUES
(7, 'agus', '../gambar/UploadDesain/agus/agus.jpg', '../gambar/UploadDesain/agus/agus.png', 'ahahaha'),
(8, 'agus', '../gambar/UploadDesain/agus/agus.png', '../gambar/UploadDesain/agus/agus.jpg', 'jjajasyaisyiay');

-- --------------------------------------------------------

--
-- Table structure for table `retur`
--

CREATE TABLE IF NOT EXISTS `retur` (
  `idRetur` int(11) NOT NULL AUTO_INCREMENT,
  `idTransaksi` varchar(50) NOT NULL,
  `alasan` varchar(50) NOT NULL,
  `gambarBukti` text NOT NULL,
  `statusRetur` varchar(50) NOT NULL,
  PRIMARY KEY (`idRetur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `retur`
--

INSERT INTO `retur` (`idRetur`, `idTransaksi`, `alasan`, `gambarBukti`, `statusRetur`) VALUES
(1, 'TRANS0000001', 'rusak', '../gambar/retur/1/1.jpg', 'proses');

-- --------------------------------------------------------

--
-- Table structure for table `tblorder`
--

CREATE TABLE IF NOT EXISTS `tblorder` (
  `idOrder` int(11) NOT NULL AUTO_INCREMENT,
  `kdTransaksi` varchar(50) NOT NULL,
  `idKonsumen` varchar(50) NOT NULL,
  `idProduk` int(11) NOT NULL,
  `poin` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  PRIMARY KEY (`idOrder`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=47 ;

--
-- Dumping data for table `tblorder`
--

INSERT INTO `tblorder` (`idOrder`, `kdTransaksi`, `idKonsumen`, `idProduk`, `poin`, `qty`, `jumlah`) VALUES
(24, 'TRANS0000001', 'indra', 10, 0, 100, 600000),
(28, 'TRANS0000002', 'indra', 7, 0, 15, 120000),
(30, 'TRANS0000004', 'admin', 14, 0, 1, 0),
(31, 'TRANS0000005', 'indra', 26, 0, 3, 150000),
(32, 'TRANS0000006', 'indra', 21, 0, 11, 370700),
(36, 'TRANS0000007', 'indra', 24, 0, 100, 2600000),
(39, 'TRANS0000008', 'indra', 12, 0, 200, 1740000),
(41, 'TRANS0000008', 'indra', 10, 0, 1, 0),
(43, 'TRANS0000008', 'indra', 23, 0, 1, 0),
(44, 'TRANS0000008', 'indra', 10, 0, 1, 0),
(45, 'TRANS0000008', 'indra', 10, 0, 1, 0),
(46, 'TRANS0000008', 'indra', 10, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
  `idTransaksi` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `idKonsumen` varchar(50) NOT NULL,
  `kdTransaksi` varchar(50) NOT NULL,
  `idOngkir` int(11) NOT NULL,
  `idKurir` int(11) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `desa` varchar(50) NOT NULL,
  `kec` varchar(50) NOT NULL,
  `kab` varchar(50) NOT NULL,
  `prov` varchar(50) NOT NULL,
  `pembayaran` int(11) NOT NULL,
  `noResi` varchar(50) NOT NULL,
  `buktiLampiran` text NOT NULL,
  `status` varchar(40) NOT NULL,
  PRIMARY KEY (`idTransaksi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`idTransaksi`, `tanggal`, `jam`, `idKonsumen`, `kdTransaksi`, `idOngkir`, `idKurir`, `alamat`, `desa`, `kec`, `kab`, `prov`, `pembayaran`, `noResi`, `buktiLampiran`, `status`) VALUES
(17, '2019-11-22', '04:01:36', 'indra', 'TRANS0000001', 4, 2, 'dusun wage rt 02 rw 04', 'ciomas', 'Kuningan', 'Kuningan', 'Jawa Barat', 612000, 'o90', '../gambar/transaksi/TRANS0000001/TRANS0000001.jpg', 'retur'),
(19, '2019-12-03', '11:25:42', 'indra', 'TRANS0000002', 7, 3, 'dusun wage rt 02 rw 04', 'ciomas', 'Kuningan', 'Kuningan', 'Jawa Barat', 134000, 'akulaku', '', 'selesai'),
(21, '0000-00-00', '00:00:00', 'admin', 'TRANS0000004', 0, 0, '', '', '', '', '', 0, '', '', 'keranjang'),
(22, '2019-12-05', '02:38:33', 'indra', 'TRANS0000005', 7, 3, 'dusun wage rt 02 rw 04', 'ciomas', 'Kuningan', 'Kuningan', 'Jawa Barat', 0, '', '', 'ditolak'),
(23, '2019-12-05', '02:45:56', 'indra', 'TRANS0000006', 0, 0, 'dusun wage rt 02 rw 04', 'ciomas', 'Kuningan', 'Kuningan', 'Jawa Barat', 370700, 'j', '../gambar/transaksi/TRANS0000006/TRANS0000006.jpg', 'dikirim'),
(24, '2019-12-16', '05:10:44', 'indra', 'TRANS0000007', 7, 3, 'dusun wage rt 02 rw 04', 'ciomas', 'Kuningan', 'Kuningan', 'Jawa Barat', 2950000, 'iouys8', '../gambar/transaksi/TRANS0000007/TRANS0000007.jpg', 'dikirim'),
(25, '0000-00-00', '00:00:00', 'indra', 'TRANS0000008', 7, 3, '', '', '', '', '', 0, '', '', 'keranjang');

-- --------------------------------------------------------

--
-- Table structure for table `transaksipoin`
--

CREATE TABLE IF NOT EXISTS `transaksipoin` (
  `idTransaksiPoin` int(11) NOT NULL AUTO_INCREMENT,
  `kdTransaksiPoin` varchar(50) NOT NULL,
  `idKonsumen` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `idOngkir` int(11) NOT NULL,
  `idKurir` int(11) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `desa` varchar(50) NOT NULL,
  `kec` varchar(50) NOT NULL,
  `kab` varchar(50) NOT NULL,
  `prov` varchar(50) NOT NULL,
  `pembayaran` int(11) NOT NULL,
  `noResi` int(11) NOT NULL,
  `buktiLampiran` text NOT NULL,
  `status` varchar(40) NOT NULL,
  PRIMARY KEY (`idTransaksiPoin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `transaksipoin`
--

INSERT INTO `transaksipoin` (`idTransaksiPoin`, `kdTransaksiPoin`, `idKonsumen`, `tanggal`, `jam`, `idOngkir`, `idKurir`, `alamat`, `desa`, `kec`, `kab`, `prov`, `pembayaran`, `noResi`, `buktiLampiran`, `status`) VALUES
(1, 'TRANP0000001', 'indra', '2019-12-05', '02:47:57', 4, 2, 'dusun wage rt 02 rw 04', 'ciomas', 'Kuningan', 'Kuningan', 'Jawa Barat', 12000, 987654, '', 'dikirim');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
