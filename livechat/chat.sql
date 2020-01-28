-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 11, 2015 at 05:36 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `widget`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `nama` varchar(12) NOT NULL,
  `email` varchar(35) NOT NULL,
  `komen` varchar(120) NOT NULL,
  `waktu` varchar(20) NOT NULL,
  `cek` varchar(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`nama`, `email`, `komen`, `waktu`, `cek`) VALUES
('Dona', 'rama@gmail.com', 'Test komentar doang boleh ya gan, siapa tau error. Kalo error gak lanjut baca tutorialnya. He he he', '2014-11-28, 15:04 pm', 'cek'),
('Rama', 'rama@gmail.com', 'Test komentar doang boleh ya gan, siapa tau error.', '2014-11-28, 15:03 pm', 'cek'),
('Ratna', 'ratna@gmail.com', 'Selamat malam admin, bisa minta tutorial membuat live chat seperti yang di web ini gak? Thanks', '2014-11-27, 19:43 pm', 'cek'),
('Nanda', 'nandayola@yahoo.com', 'Cara pemesanan aplikasi berbasis web nya gimana, apa bisa scriptnya saja yang dikirim?', '2014-05-17, 02:07 am', 'cek'),
('Andreas', 'andreas@g', 'Isi artikelnya bagus, mudah di ikuti buat praktek langsung. Thanks admin', '2014-05-22, 19:40 pm', 'cek'),
('khoerulq', 'khoerulq@gmail.com', 'lw tambah kolom gimana y gan..', '2014-08-20, 14:17 pm', 'cek'),
('andela', 'CSFGSE@GMAIL.COM', 'saya memerlukan aplikasi/softwere untuk membuat website bagaimana caranya?', '2014-09-11, 09:01 am', 'cek'),
('Saya Adm', 'admin@rajaputramedia.com', 'Saya mau coba test komen sekali lagi, kaloo gagal tidur dulu, lanjut besok', '2014-12-03, 15:43 pm', 'cek');
