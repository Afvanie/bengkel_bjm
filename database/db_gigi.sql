-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2020 at 11:32 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_gigi`
--

-- --------------------------------------------------------

--
-- Table structure for table `analisa_hasil`
--

CREATE TABLE `analisa_hasil` (
  `noip` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `kelamin` varchar(30) NOT NULL,
  `umur` varchar(30) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kd_penyakit` varchar(30) NOT NULL,
  `tanggal` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bobot`
--

CREATE TABLE `bobot` (
  `id_bobot` int(11) NOT NULL,
  `kd_gejala` varchar(30) NOT NULL,
  `kd_penyakit` varchar(30) NOT NULL,
  `bobot` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bobot`
--

INSERT INTO `bobot` (`id_bobot`, `kd_gejala`, `kd_penyakit`, `bobot`) VALUES
(7, 'G1', 'P1', 1),
(8, 'G2', 'P1', 0.3),
(9, 'G3', 'P1', 0.3),
(10, 'G4', 'P1', 1),
(11, 'G5', 'P1', 1),
(12, 'G6', 'P1', 0.8),
(13, 'G1', 'P2', 1),
(14, 'G7', 'P2', 1),
(15, 'G8', 'P2', 1),
(16, 'G9', 'P3', 0.8),
(18, 'G11', 'P3', 1),
(19, 'G12', 'P3', 0.5),
(20, 'G13', 'P3', 0.3),
(21, 'G14', 'P3', 0.8),
(22, 'G15', 'P3', 1),
(23, 'G6', 'P3', 0.8),
(28, 'G10', 'P3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gejala`
--

CREATE TABLE `gejala` (
  `kd_gejala` varchar(30) NOT NULL,
  `gejala` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gejala`
--

INSERT INTO `gejala` (`kd_gejala`, `gejala`) VALUES
('G1', 'Ngilu Pada Saat Makan / Minum '),
('G10', 'Gusi Bengkak'),
('G11', 'Terasa Nyeri'),
('G12', 'Gigi Goyang'),
('G13', 'Radang Sekitar Gigi'),
('G14', 'Jika Ditekan Adanya Pus Yang Keluar Dari Sulkus Gingivi Gigi'),
('G15', 'Demam'),
('G2', 'Terasa Ada Makanan Nyangkut Dipermukaan Gigi'),
('G3', 'Adanya 2 White Spot Dipermukaan Gigi'),
('G4', 'Kecoklatan Pada Permukaan Gigi'),
('G5', 'Rasa Tidak Nyaman Pada Saat Makan'),
('G6', 'Bau Mulut'),
('G7', 'Ngilu Pada Saat Berbicara'),
('G8', 'Terlihat Seperti Irisan Pisau Pada Daerah Cervical Gigi'),
('G9', 'Adanya Pembengkakan Pada Kelenjar Getah Bening');

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int(11) NOT NULL,
  `id_pasien` varchar(30) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `kelamin` varchar(10) NOT NULL,
  `umur` varchar(3) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `kd_penyakit` varchar(30) NOT NULL,
  `tanggal` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `id_pasien`, `nama`, `kelamin`, `umur`, `alamat`, `email`, `kd_penyakit`, `tanggal`) VALUES
(18, '8', 'Muhamad Hendra', 'Pria', '23', 'Rajeg', 'hendra.stmikglobal@gmail.com', 'P1', '2020-09-15 04:30:35'),
(19, '8', 'Muhamad Hendra', 'Pria', '23', 'Rajeg', 'hendra.stmikglobal@gmail.com', 'P1', '2020-09-15 04:30:35');

-- --------------------------------------------------------

--
-- Table structure for table `indikator`
--

CREATE TABLE `indikator` (
  `id_indikator` int(11) NOT NULL,
  `nama_indikator` varchar(30) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `indikator`
--

INSERT INTO `indikator` (`id_indikator`, `nama_indikator`, `nilai`) VALUES
(3, '1', 1),
(4, '0.3', 0.3),
(5, '0.8', 0.8),
(6, '0.5', 0.5);

-- --------------------------------------------------------

--
-- Table structure for table `informasi`
--

CREATE TABLE `informasi` (
  `id_info` varchar(10) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(20) NOT NULL,
  `posting` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `informasi`
--

INSERT INTO `informasi` (`id_info`, `judul`, `isi`, `gambar`, `posting`) VALUES
('INF2923473', 'Penyakit Gigi Sungguh Sangat Menyakitkan', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'INF2923473.jpg', '2020-08-04 06:38:15'),
('INF8618947', 'Jagalah Gigi Anda Selalu', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'INF8618947.jpg', '2020-08-04 06:38:38'),
('INF8978123', 'Gigi Harus Selalu Dibersihkan', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'INF8978123.jpg', '2020-08-04 06:37:51');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_login` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_login`, `username`, `password`) VALUES
(2, 'hendra', 'aGVuZHJh');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `kelamin` varchar(10) NOT NULL,
  `umur` varchar(3) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `tanggal` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `nama`, `kelamin`, `umur`, `alamat`, `tanggal`, `email`) VALUES
(8, 'Muhamad Hendra', 'Pria', '23', 'Rajeg', '2020-09-15 04:30:35', 'hendra.stmikglobal@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `penyakit`
--

CREATE TABLE `penyakit` (
  `kd_penyakit` varchar(30) NOT NULL,
  `nama_penyakit` varchar(30) NOT NULL,
  `definisi` text NOT NULL,
  `solusi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penyakit`
--

INSERT INTO `penyakit` (`kd_penyakit`, `nama_penyakit`, `definisi`, `solusi`) VALUES
('P1', 'Karies Gigi', 'Karies gigi adalah sebuah penyakit infeksi yang merusak struktur jaringan keras gigi. Penyakit ini ditandai dengan gigi berlubang. Jika tidak ditangani, penyakit ini dapat menyebabkan nyeri, kematian saraf gigi (nekrose) dan infeksi periapikal dan infeksi sistemik yang bisa membahayakan penderita, dan bahkan bisa berakibat kematian. Penyakit ini telah dikenal sejak masa lalu, berbagai bukti telah menunjukkan bahwa penyakit ini telah dikenal sejak zaman perunggu, zaman besi, dan zaman pertengahan. Peningkatan prevalensi karies banyak dipengaruhi perubahan dari pola makan. Kini, karies gigi telah menjadi penyakit yang tersebar di seluruh dunia.', 'Penambahan Gigi Dengan GI dan Penambalan Gigi Dengan Komposit'),
('P2', 'Erosi Gigi', 'Erosi gigi adalah kondisi terkikisnya lapisan terluar gigi yang dikenal sebagai enamel. Enamel merupakan lapisan keras transparan yang berfungsi melindungi gigi dari kerusakan. Ketika enamel mengalami erosi atau terkikis, lapisan gigi di bawah enamel yang bernama dentin akan terekspos tanpa lapisan pelindung. Hal ini dapat menyebabkan nyeri gigi karena sifat dentin yang sensitif.', 'Penambahan Gigi Dengan GI dan Penambalan Gigi Dengan Komposit'),
('P3', 'Abses Gigi', 'Abses gigi merupakan penyakit yang terjadi karena infeksi bakteri dan sering menyerang orang yang tidak menjaga kebersihan gigi dengan baik. Kondisi ini memicu terbentuknya kantung atau benjolan berisi nanah pada gigi. Abses gigi umumnya muncul di ujung akar gigi dan menyebabkan rasa nyeri tak tertahankan. Nyeri yang muncul sebagai gejala penyakit ini disebabkan oleh nanah yang berkumpul pada benjolan di seputar gigi dan mulut.', 'Perawatan Saluran Akan Jika Mahkota Gigi Masih Ada, Premedikasi dan Pencabutan');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_analisa`
--

CREATE TABLE `tmp_analisa` (
  `noip` varchar(30) NOT NULL,
  `kd_gejala` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmp_gejala`
--

CREATE TABLE `tmp_gejala` (
  `kd_gejala` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmp_gejala`
--

INSERT INTO `tmp_gejala` (`kd_gejala`) VALUES
('G3'),
('G6');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_pasien`
--

CREATE TABLE `tmp_pasien` (
  `noip` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmp_penyakit`
--

CREATE TABLE `tmp_penyakit` (
  `noip` varchar(30) NOT NULL,
  `kd_penyakit` varchar(30) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analisa_hasil`
--
ALTER TABLE `analisa_hasil`
  ADD PRIMARY KEY (`noip`);

--
-- Indexes for table `bobot`
--
ALTER TABLE `bobot`
  ADD PRIMARY KEY (`id_bobot`);

--
-- Indexes for table `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`kd_gejala`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `indikator`
--
ALTER TABLE `indikator`
  ADD PRIMARY KEY (`id_indikator`);

--
-- Indexes for table `informasi`
--
ALTER TABLE `informasi`
  ADD PRIMARY KEY (`id_info`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indexes for table `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`kd_penyakit`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bobot`
--
ALTER TABLE `bobot`
  MODIFY `id_bobot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `indikator`
--
ALTER TABLE `indikator`
  MODIFY `id_indikator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
