-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 24, 2020 at 10:21 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `percetakan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `idAdmin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `hakAkses` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `chats` (
  `id` int(15) NOT NULL,
  `time` datetime NOT NULL,
  `text` text NOT NULL,
  `sender` varchar(50) NOT NULL,
  `receiver` varchar(50) NOT NULL,
  `stat` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `dataundangan` (
  `id_undangan` int(10) NOT NULL,
  `kdTransaksi` varchar(50) NOT NULL,
  `NamaPengantin` varchar(100) NOT NULL,
  `NamaOrtu_Pcwo` varchar(100) NOT NULL,
  `NamaOrtu_Pcwe` varchar(100) NOT NULL,
  `JadwalAkad` varchar(100) NOT NULL,
  `Alamat` varchar(500) NOT NULL,
  `Hiburan` varchar(100) NOT NULL,
  `TurutMengundang` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(33, 'TRANS0000008', 'oij', 'ijio', 'jo', 'ijoi', 'joi', 'joi', 'jn'),
(34, 'TRANS0000009', '', '', '', '', '', '', ''),
(35, 'TRANS0000009', 'Buku', 'Agus', 'Agusus', 'Besok', 'Kuningan', 'Dangdut', 'Biasalah'),
(36, 'TRANS0000009', '', '', '', '', '', '', ''),
(37, 'TRANS0000009', '', '', '', '', '', '', ''),
(38, 'TRANS0000009', '', '', '', '', '', '', ''),
(39, 'TRANS0000009', '', '', '', '', '', '', ''),
(40, 'TRANS0000009', '', '', '', '', '', '', ''),
(41, 'TRANS0000009', '', '', '', '', '', '', ''),
(42, 'TRANS0000009', '', '', '', '', '', '', ''),
(43, 'TRANS0000010', '', '', '', '', '', '', ''),
(44, 'TRANS0000010', '', '', '', '', '', '', ''),
(45, 'TRANS0000010', '', '', '', '', '', '', ''),
(46, 'TRANS0000010', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `desainadmin`
--

CREATE TABLE `desainadmin` (
  `idDesainAdmin` int(11) NOT NULL,
  `kdTransaksi` varchar(50) NOT NULL,
  `desain` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `desainadmin`
--

INSERT INTO `desainadmin` (`idDesainAdmin`, `kdTransaksi`, `desain`) VALUES
(9, 'TRANS0000017', '20200222_2356280.JPG'),
(10, 'TRANS0000017', '20200222_2356291.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `detailtransaksipoin`
--

CREATE TABLE `detailtransaksipoin` (
  `idDetailTransaksiPoin` int(11) NOT NULL,
  `kdTransaksiPoin` varchar(50) NOT NULL,
  `idKonsumen` varchar(50) NOT NULL,
  `idProduk` int(11) NOT NULL,
  `poin` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detailtransaksipoin`
--

INSERT INTO `detailtransaksipoin` (`idDetailTransaksiPoin`, `kdTransaksiPoin`, `idKonsumen`, `idProduk`, `poin`, `qty`, `jumlah`) VALUES
(1, 'TRANP0000001', 'indra', 7, 0, 2, 40);

-- --------------------------------------------------------

--
-- Table structure for table `gambardesain`
--

CREATE TABLE `gambardesain` (
  `id` int(11) NOT NULL,
  `idOrder` int(11) NOT NULL,
  `desain` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gambardesain`
--

INSERT INTO `gambardesain` (`id`, `idOrder`, `desain`) VALUES
(1, 70, '70_0.JPG'),
(2, 70, '70_1.JPG'),
(3, 73, '73_0.JPG'),
(4, 73, '73_1.JPG'),
(5, 74, '74_0.JPG'),
(6, 74, '74_1.png'),
(7, 75, '75_0.JPG'),
(8, 76, '76_0.JPG'),
(9, 76, '76_1.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `idKategori` int(11) NOT NULL,
  `nmKategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`idKategori`, `nmKategori`) VALUES
(1, 'Undangan Soft Cover'),
(3, 'Undangan Hard Cover'),
(4, 'Buku Yasin'),
(5, 'Kartu Nama'),
(6, 'Spanduk');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `idKomentar` int(11) NOT NULL,
  `idProduk` int(11) NOT NULL,
  `usernameKonsumen` varchar(100) DEFAULT NULL,
  `isiKomentar` text NOT NULL,
  `createdAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`idKomentar`, `idProduk`, `usernameKonsumen`, `isiKomentar`, `createdAt`) VALUES
(1, 10, 'agus', 'asdasd', '2020-01-29 14:43:12'),
(2, 23, 'agus', 'Ini barang bagus sekali', '2020-01-29 14:45:13'),
(3, 23, 'agus', 'nnhjhn', '2020-01-29 16:10:53'),
(5, 26, 'agus', 'mmmmm', '2020-01-29 20:54:26'),
(6, 26, 'agus', 'anjg', '2020-01-30 08:32:32'),
(7, 27, 'agus', 'Ini tukunangn bagus', '2020-01-31 22:54:20'),
(8, 27, 'agus', 'Ini jelek', '2020-01-31 22:55:05'),
(9, 32, 'agus', 'Ini spanduk dengan logo uniku', '2020-02-03 10:08:12'),
(10, 26, 'agus', 'asdasd', '2020-02-07 15:27:18'),
(19, 22, 'agus', 'Bagus bgt desain yasinnya\n', '2020-02-07 15:58:05'),
(20, 12, 'wira', 'Anjing', '2020-02-07 18:02:42'),
(22, 32, 'agus', 'AJJA', '2020-02-10 18:06:03'),
(23, 14, 'agus', 'ok', '2020-02-10 18:09:13'),
(24, 32, 'asu', 'Bisa', '2020-02-17 20:58:44'),
(25, 21, 'asu', 'asas', '2020-02-17 21:03:24'),
(26, 25, 'agus', 'Edo', '2020-02-17 21:45:00'),
(27, 31, 'agus', 'tes', '2020-02-18 15:07:24');

-- --------------------------------------------------------

--
-- Table structure for table `komentarPoin`
--

CREATE TABLE `komentarPoin` (
  `idKomentar` int(11) NOT NULL,
  `idProdukPoin` int(11) NOT NULL,
  `usernameKonsumen` varchar(100) DEFAULT NULL,
  `isiKomentar` text NOT NULL,
  `createdAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `konsumen`
--

CREATE TABLE `konsumen` (
  `idKonsumen` int(11) NOT NULL,
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
  `poin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konsumen`
--

INSERT INTO `konsumen` (`idKonsumen`, `username`, `password`, `hakAkses`, `nama`, `gender`, `ttl`, `email`, `alamat`, `desa`, `kec`, `kab`, `provinsi`, `noHp`, `poin`) VALUES
(1, 'aprian', '4fe8d05045161f447b575c3b29f61995', 'Konsumen', 'Dani Apriansyah', 'L', '1995-04-16', 'aprian@gmail.com', 'No. 77', 'Cirendang', 'Kuningan', 'Kuningan', 'Jawa Barat', '89660645681', 59),
(2, 'agus', 'fdf169558242ee051cca1479770ebac3', 'Konsumen', 'Agus', 'L', '1999-08-11', 'agus@gmail.com', 'Jln. Raya Pangkalan', 'Susukan', 'Kuningan', 'Kuningan', 'Jawa Barat', '82121838838', 26),
(3, 'wira', '6215f4770ee800ad5402bc02be783c26', 'Konsumen', 'wira', 'L', '1995-02-07', 'wira@gmail.com', 'tangerang', 'legok', 'Cigugur', 'Kuningan', 'Jawa Barat', '85561234321', 20),
(4, 'indra', 'aff4b352312d5569903d88e0e68d3fbb', 'Konsumen', 'indra', 'L', '1996-07-31', 'indra@gmail.com', 'dusun wage rt 02 rw 04', 'ciomas', 'Kuningan', 'Kuningan', 'Jawa Barat', '85523697207', 10),
(5, '12', 'c20ad4d76fe97759aa27a0c99bff6710', 'Konsumen', '12', 'L', '1992-07-08', 'jkajkjak@gmail.com', 'oaokkslak', 'alkslakl', 'Kuningan', 'Kuningan', 'Jawa Barat', '855234565421', 0),
(6, 'klo', 'c20ad4d76fe97759aa27a0c99bff6710', 'Konsumen', 'ertyu', 'L', '1992-07-08', '8jkiiy@gmail.com', 'mnbvc', 'mnb', 'Kuningan', 'Kuningan', 'Jawa Barat', '876545678', 0),
(7, 'poiuy', 'c20ad4d76fe97759aa27a0c99bff6710', 'Konsumen', 'ertyu', 'L', '1992-07-08', '8jkiiy@gmail.com', 'mnbvc', 'mnb', 'Kuningan', 'Kuningan', 'Jawa Barat', '8765456786', 0),
(8, 'asu', '102a6ed6587b5b8cb4ebbe972864690b', 'Konsumen', 'DKDK', 'L', '2020-02-26', 'asdklasj@gmail.com', 'Kuningan', 'Kuningan', 'Kuningan', 'Kuningan', 'Jawa Barat', '091238219', 0),
(9, 'agussudrajat', 'fdf169558242ee051cca1479770ebac3', 'Konsumen', 'agus', 'L', '2020-02-18', 'agus@gmail.com', 'kuniga', 'nsdkhysdf', 'Kuningan', 'Kuningan', 'Jawa Barat', '8657752321', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kritik_saran`
--

CREATE TABLE `kritik_saran` (
  `idKritik` int(11) NOT NULL,
  `idKonsumen` varchar(50) NOT NULL,
  `thread` int(11) NOT NULL,
  `subjek` text NOT NULL,
  `isi` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `kurir` (
  `idKurir` int(11) NOT NULL,
  `namaKurir` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kurir`
--

INSERT INTO `kurir` (`idKurir`, `namaKurir`) VALUES
(1, 'JNE'),
(2, 'TIKI'),
(3, 'J&T');

-- --------------------------------------------------------

--
-- Table structure for table `masukan`
--

CREATE TABLE `masukan` (
  `idMasukan` int(11) NOT NULL,
  `idDesainAdmin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `isiMasukan` text DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `masukan`
--

INSERT INTO `masukan` (`idMasukan`, `idDesainAdmin`, `username`, `isiMasukan`, `createdAt`) VALUES
(1, 9, 'agus', 'bisa ga kalo llogonya diubah jadi bentuk uang?\n', '2020-02-24 16:03:36'),
(2, 9, 'agus', 'bisa ga woy?', '2020-02-24 16:14:54'),
(3, 9, 'admin', 'Bisa atuh siamah', '2020-02-24 16:20:02');

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `idOngkir` int(11) NOT NULL,
  `idKurir` int(11) NOT NULL,
  `idOK` int(11) NOT NULL,
  `ongkir` int(11) NOT NULL,
  `kec` varchar(50) NOT NULL,
  `kab` varchar(50) NOT NULL,
  `prov` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `ongkirkurir` (
  `idOK` int(11) NOT NULL,
  `idKurir` int(11) NOT NULL,
  `namaOngkir` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `pengaturan` (
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

CREATE TABLE `pesan` (
  `id_pesan` int(50) NOT NULL,
  `id_pengirim` int(50) NOT NULL,
  `id_penerima` int(50) NOT NULL,
  `tanggal` date NOT NULL,
  `subyek_pesan` varchar(500) NOT NULL,
  `isi_pesan` longtext NOT NULL,
  `sudah_dibaca` enum('Belum','Sudah') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `produk` (
  `idProduk` int(11) NOT NULL,
  `idKategori` int(11) NOT NULL,
  `namaProduk` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` text NOT NULL,
  `stok` int(11) NOT NULL,
  `berat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`idProduk`, `idKategori`, `namaProduk`, `deskripsi`, `harga`, `gambar`, `stok`, `berat`) VALUES
(10, 1, 'SCB002', 'Detail :\r\n- Softcover lipat 1, laminasi doff\r\n- Ukuran 15 x 20 cm\r\n- Kertas Ivory 260 gram\r\n- Full color\r\n\r\nHarga di atas, sudah termasuk bonus:\r\n1. Gratis plastik pembungkus\r\n2. Gratis pengemasan', 6000, '../gambar/produk/10/10.jpg', 4600, 3),
(12, 1, 'SCC003', 'Detail :\r\n- Amplop cokelat isi 2 lembar soft cover(Undangan + Denah).\r\n- Ukuran 16 x 21 cm\r\n- Kertas Aster & Kraft\r\n- Full color\r\n\r\nHarga di atas, sudah termasuk bonus:\r\n1. Gratis plastik pembungkus\r\n2. Gratis pengemasan\r\n', 8700, '../gambar/produk/12/12.jpg', 4998, 4),
(14, 3, 'HCA001', 'Detail :\r\n- Amplop Isi 1 single hardcover, dengan hotprint emas.\r\n-Ukuran16 x 21 cm\r\n- Kertas Jasmine\r\n- 1 Warna\r\n\r\nHarga di atas, sudah termasuk bonus:\r\n1. Gratis plastik pembungkus\r\n2. Gratis pengemasan', 9500, '../gambar/produk/14/14.jpg', 5000, 6),
(16, 3, 'HCB002', 'Detail :\r\n- Amplop Isi 1 single hardcover, dengan hotprint emas + emboss 3 titik.\r\n- Ukuran16 x 21 cm\r\n- Kertas Jasmine\r\n- 1 Warna\r\n\r\nHarga di atas, sudah termasuk bonus:\r\n1. Gratis plastik pembungkus\r\n2. Gratis pengemasan\r\n', 10000, '../gambar/produk/16/16.jpg', 4998, 6),
(18, 1, 'SCD004', 'Detail :\r\n- Softcover lipat 1, laminasi doff\r\n- Ukuran 15 x 20 cm\r\n- Kertas Ivory 260 gram\r\n- Full color\r\n\r\nHarga di atas, sudah termasuk bonus:\r\n1. Gratis plastik pembungkus\r\n2. Gratis pengemasan\r\n\r\n', 6000, '../gambar/produk/18/18.jpg', 4999, 3),
(21, 4, 'Buku Yasin Hard Cover Emas Timbul', 'desain buku yasin menggunakan cetakan warna emas pada covernya. Jika disentuh menggunakan tangan, tulisan kaligrafi pada cover atau nama akan terasa menonjol, buku yasin jenis ini juga biasa disebut cover timbul.\r\n\r\nDETAIL PRODUK :\r\n    Kertas isi HVS 70 gsm\r\n    Ukuran kertas 15,5 x 12 cm\r\n    Sampul tebal hardcover\r\n    Isi 192 halaman', 33700, '../gambar/produk/21/21.jpg', 989, 250),
(22, 4, 'Buku Yasin Lengkap Hard Cover', 'Buku yasin jenis ini memiliki isi yang teba\r\n\r\nDETAIL PRODUK :\r\n    Surat Yasin dan bacaan tahlil arab, latin\r\n    Isi buku Yasin 192 halaman\r\n    Cover hot print warna emas / perak\r\n    Dimensi 16 x 12 cm', 34700, '../gambar/produk/22/22.jpeg', 1000, 500),
(23, 4, 'Buku Yasin Silk CoveR', 'yang satu ini akan terasa licin di bagian covernya, punya material khusus yang membuatnya premium dan nyaman digenggam. Kesan premium dan elegan akan dirasakan oleh orang yang memiliki buku Yasin ini.\r\n\r\nDETAIL PRODUK :\r\n    Cover silk premium\r\n    Isi buku kertas licin 192 halaman\r\n    Desain cover dengan huruf timbul yang elegan', 26700, '../gambar/produk/23/23.jpg', 999, 250),
(24, 4, 'Buku Yasin Soft Cover', 'Cetak buku Yasin soft cover ini cocok untuk hadiah dan souvenir tahlilan untuk pengajian, peringatan 40 hari, peringatan 100 hari, dan peringatan 1000 hari.\r\n\r\nDETAIL PRODUK :\r\n    Isi cetak buku Yasin 192 halaman\r\n    Jenis kertas HVS\r\n    Ukuran cetak buku Yasin 15,5 x 12 cm', 26000, '../gambar/produk/24/24.jpg', 898, 250),
(25, 5, 'IDCARD001', 'Ukuran : 90 x 55 mm\r\nKertas : Artpaper 260 gsm\r\nCetak : 2Sisi\r\nFinishing : Laminasi \r\nFinishing : Potong Kotak ', 50000, '../gambar/produk/25/25.jpg', 1497, 150),
(26, 5, 'IDCARD002', 'Ukuran : 90 x 55 mm\r\nKertas : Artpaper 260 gsm\r\nCetak : 2Sisi\r\nFinishing : Laminasi \r\nFinishing : Potong Kotak ', 50000, '../gambar/produk/26/26.png', 1493, 150),
(27, 6, 'Sampel Logo', 'Ini adalah sampel logo', 20000, '../gambar/produk/27/27.png', 19, 500),
(31, 6, 'Spanduk Uniku', 'Ini adalah spanduk uniku', 20000, '../gambar/produk/31/31.png', -3, 4),
(32, 6, 'Spanduk Uniku', 'Ini adalah spanduk uniku', 20000, '../gambar/produk/32/32.png', 0, 450);

-- --------------------------------------------------------

--
-- Table structure for table `produkpoin`
--

CREATE TABLE `produkpoin` (
  `idProdukPoin` int(11) NOT NULL,
  `idKategori` int(11) NOT NULL,
  `namaProduk` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `berat` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `jumlahPoin` int(11) NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `reqdesain` (
  `idReqdesain` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `gambarDesain` text NOT NULL,
  `buktiBayar` text NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reqdesain`
--

INSERT INTO `reqdesain` (`idReqdesain`, `nama`, `gambarDesain`, `buktiBayar`, `keterangan`) VALUES
(7, 'agus', '../gambar/UploadDesain/agus/agus.jpg', '../gambar/UploadDesain/agus/agus.png', 'ahahaha'),
(8, 'agus', '../gambar/UploadDesain/agus/agus.png', '../gambar/UploadDesain/agus/agus.jpg', 'jjajasyaisyiay'),
(9, 'agus', '../gambar/UploadDesain/agus/agus.png', '../gambar/UploadDesain/agus/agus.png', 'Contoh Tukunang');

-- --------------------------------------------------------

--
-- Table structure for table `retur`
--

CREATE TABLE `retur` (
  `idRetur` int(11) NOT NULL,
  `idTransaksi` varchar(50) NOT NULL,
  `alasan` varchar(50) NOT NULL,
  `gambarBukti` text NOT NULL,
  `statusRetur` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `retur`
--

INSERT INTO `retur` (`idRetur`, `idTransaksi`, `alasan`, `gambarBukti`, `statusRetur`) VALUES
(1, 'TRANS0000001', 'rusak', '../gambar/retur/1/1.jpg', 'proses');

-- --------------------------------------------------------

--
-- Table structure for table `tblorder`
--

CREATE TABLE `tblorder` (
  `idOrder` int(11) NOT NULL,
  `kdTransaksi` varchar(50) NOT NULL,
  `idKonsumen` varchar(50) NOT NULL,
  `idProduk` int(11) NOT NULL,
  `poin` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

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
(41, 'TRANS0000008', 'indra', 10, 0, 1, 6000),
(43, 'TRANS0000008', 'indra', 23, 0, 1, 26700),
(44, 'TRANS0000008', 'indra', 10, 0, 1, 6000),
(45, 'TRANS0000008', 'indra', 10, 0, 1, 6000),
(46, 'TRANS0000008', 'indra', 10, 0, 1, 6000),
(53, 'TRANS0000009', 'agus', 31, 0, 1, 20000),
(57, 'TRANS0000010', 'agus', 32, 0, 2, 40000),
(59, 'TRANS0000010', 'agus', 24, 0, 2, 52000),
(61, 'TRANS0000013', 'agus', 16, 0, 1, 10000),
(62, 'TRANS0000013', 'agus', 18, 0, 1, 6000),
(63, 'TRANS0000013', 'agus', 31, 0, 5, 100000),
(64, 'TRANS0000013', 'agus', 32, 0, 3, 60000),
(65, 'TRANS0000011', 'asu', 23, 0, 1, 26700),
(66, 'TRANS0000014', 'asu', 26, 0, 1, 50000),
(67, 'TRANS0000014', 'asu', 31, 0, 1, 20000),
(68, 'TRANS0000015', 'agus', 27, 0, 1, 20000),
(73, 'TRANS0000016', 'agus', 12, 0, 2, 17400),
(74, 'TRANS0000016', 'agus', 25, 0, 3, 150000),
(75, 'TRANS0000017', 'agus', 16, 0, 1, 10000),
(76, 'TRANS0000018', 'agus', 31, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `idTransaksi` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `idKonsumen` varchar(50) NOT NULL,
  `kdTransaksi` varchar(50) NOT NULL,
  `idOngkir` int(11) DEFAULT NULL,
  `idKurir` int(11) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `desa` varchar(50) DEFAULT NULL,
  `kec` varchar(50) DEFAULT NULL,
  `kab` varchar(50) DEFAULT NULL,
  `prov` varchar(50) DEFAULT NULL,
  `pembayaran` int(11) DEFAULT NULL,
  `noResi` varchar(50) DEFAULT NULL,
  `buktiLampiran` text DEFAULT NULL,
  `status` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(25, '0000-00-00', '00:00:00', 'indra', 'TRANS0000008', 7, 3, '', '', '', '', '', 0, '', '', 'keranjang'),
(29, '2020-02-01', '10:31:31', 'agus', 'TRANS0000009', 4, 1, 'Jln. Raya Pangkalan', 'Susukan', 'Kuningan', 'Kuningan', 'Jawa Barat', NULL, NULL, '../gambar/transaksi/TRANS0000009/TRANS0000009.png', 'ditolak'),
(30, '2020-02-01', '18:01:11', 'agus', 'TRANS0000010', 4, 1, 'Jln. Raya Pangkalan', 'Susukan', 'Kuningan', 'Kuningan', 'Jawa Barat', NULL, NULL, NULL, 'proses'),
(34, '2020-02-17', '21:13:15', 'asu', 'TRANS0000011', 4, 1, 'Kuningan', 'Kuningan', 'Kuningan', 'Kuningan', NULL, NULL, NULL, NULL, 'proses'),
(35, '2020-02-17', '21:18:42', 'wira', 'TRANS0000012', 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'keranjang'),
(36, '2020-02-17', '21:38:18', 'agus', 'TRANS0000013', 4, 1, 'Jln. Raya Pangkalan', 'Susukan', 'Kuningan', 'Kuningan', 'Jawa Barat', NULL, NULL, NULL, 'proses'),
(37, '2020-02-18', '22:12:42', 'asu', 'TRANS0000014', 7, 3, 'Kuningan', 'Kuningan', 'Kuningan', 'Kuningan', 'Jawa Barat', 84000, NULL, NULL, 'dikonfirmasi'),
(38, '2020-02-18', '15:08:04', 'agus', 'TRANS0000015', 4, 1, 'Jln. Raya Pangkalan', 'Susukan', 'Kuningan', 'Kuningan', 'Jawa Barat', NULL, NULL, NULL, 'proses'),
(41, '2020-02-20', '04:43:02', 'agus', 'TRANS0000016', 4, 1, 'Jln. Raya Pangkalan', 'Susukan', 'Kuningan', 'Kuningan', 'Jawa Barat', NULL, NULL, NULL, 'proses'),
(42, '2020-02-22', '00:57:16', 'agus', 'TRANS0000017', 4, 1, 'Jln. Raya Pangkalan', 'Susukan', 'Kuningan', 'Kuningan', 'Jawa Barat', NULL, NULL, NULL, 'proses'),
(43, '2020-02-22', '23:11:17', 'agus', 'TRANS0000018', 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'keranjang');

-- --------------------------------------------------------

--
-- Table structure for table `transaksipoin`
--

CREATE TABLE `transaksipoin` (
  `idTransaksiPoin` int(11) NOT NULL,
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
  `status` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksipoin`
--

INSERT INTO `transaksipoin` (`idTransaksiPoin`, `kdTransaksiPoin`, `idKonsumen`, `tanggal`, `jam`, `idOngkir`, `idKurir`, `alamat`, `desa`, `kec`, `kab`, `prov`, `pembayaran`, `noResi`, `buktiLampiran`, `status`) VALUES
(1, 'TRANP0000001', 'indra', '2019-12-05', '02:47:57', 4, 2, 'dusun wage rt 02 rw 04', 'ciomas', 'Kuningan', 'Kuningan', 'Jawa Barat', 12000, 987654, '', 'dikirim');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idAdmin`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dataundangan`
--
ALTER TABLE `dataundangan`
  ADD PRIMARY KEY (`id_undangan`);

--
-- Indexes for table `desainadmin`
--
ALTER TABLE `desainadmin`
  ADD PRIMARY KEY (`idDesainAdmin`);

--
-- Indexes for table `detailtransaksipoin`
--
ALTER TABLE `detailtransaksipoin`
  ADD PRIMARY KEY (`idDetailTransaksiPoin`);

--
-- Indexes for table `gambardesain`
--
ALTER TABLE `gambardesain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idKategori`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`idKomentar`);

--
-- Indexes for table `komentarPoin`
--
ALTER TABLE `komentarPoin`
  ADD PRIMARY KEY (`idKomentar`);

--
-- Indexes for table `konsumen`
--
ALTER TABLE `konsumen`
  ADD PRIMARY KEY (`idKonsumen`);

--
-- Indexes for table `kritik_saran`
--
ALTER TABLE `kritik_saran`
  ADD PRIMARY KEY (`idKritik`);

--
-- Indexes for table `kurir`
--
ALTER TABLE `kurir`
  ADD PRIMARY KEY (`idKurir`);

--
-- Indexes for table `masukan`
--
ALTER TABLE `masukan`
  ADD PRIMARY KEY (`idMasukan`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`idOngkir`);

--
-- Indexes for table `ongkirkurir`
--
ALTER TABLE `ongkirkurir`
  ADD PRIMARY KEY (`idOK`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id_pesan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`idProduk`);

--
-- Indexes for table `produkpoin`
--
ALTER TABLE `produkpoin`
  ADD PRIMARY KEY (`idProdukPoin`);

--
-- Indexes for table `reqdesain`
--
ALTER TABLE `reqdesain`
  ADD PRIMARY KEY (`idReqdesain`);

--
-- Indexes for table `retur`
--
ALTER TABLE `retur`
  ADD PRIMARY KEY (`idRetur`);

--
-- Indexes for table `tblorder`
--
ALTER TABLE `tblorder`
  ADD PRIMARY KEY (`idOrder`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`idTransaksi`);

--
-- Indexes for table `transaksipoin`
--
ALTER TABLE `transaksipoin`
  ADD PRIMARY KEY (`idTransaksiPoin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `idAdmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `dataundangan`
--
ALTER TABLE `dataundangan`
  MODIFY `id_undangan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `desainadmin`
--
ALTER TABLE `desainadmin`
  MODIFY `idDesainAdmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `detailtransaksipoin`
--
ALTER TABLE `detailtransaksipoin`
  MODIFY `idDetailTransaksiPoin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gambardesain`
--
ALTER TABLE `gambardesain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idKategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `idKomentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `komentarPoin`
--
ALTER TABLE `komentarPoin`
  MODIFY `idKomentar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `konsumen`
--
ALTER TABLE `konsumen`
  MODIFY `idKonsumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kritik_saran`
--
ALTER TABLE `kritik_saran`
  MODIFY `idKritik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kurir`
--
ALTER TABLE `kurir`
  MODIFY `idKurir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `masukan`
--
ALTER TABLE `masukan`
  MODIFY `idMasukan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `idOngkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ongkirkurir`
--
ALTER TABLE `ongkirkurir`
  MODIFY `idOK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id_pesan` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `idProduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `produkpoin`
--
ALTER TABLE `produkpoin`
  MODIFY `idProdukPoin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reqdesain`
--
ALTER TABLE `reqdesain`
  MODIFY `idReqdesain` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `retur`
--
ALTER TABLE `retur`
  MODIFY `idRetur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblorder`
--
ALTER TABLE `tblorder`
  MODIFY `idOrder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `idTransaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `transaksipoin`
--
ALTER TABLE `transaksipoin`
  MODIFY `idTransaksiPoin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
