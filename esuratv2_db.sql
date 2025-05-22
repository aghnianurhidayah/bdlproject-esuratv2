-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2025 at 12:00 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `esuratv2_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `sk_domisili`
--

CREATE TABLE `sk_domisili` (
  `skd_id` varchar(50) NOT NULL,
  `nik` varchar(50) DEFAULT NULL,
  `no_kk` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `tgl_lahir` varchar(50) DEFAULT NULL,
  `jenis_kelamin` varchar(50) DEFAULT NULL,
  `agama` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `kewarganagaraan` varchar(50) DEFAULT NULL,
  `file_kk` varchar(50) DEFAULT NULL,
  `file_ktp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sk_domisili`
--

INSERT INTO `sk_domisili` (`skd_id`, `nik`, `no_kk`, `nama`, `tgl_lahir`, `jenis_kelamin`, `agama`, `alamat`, `kewarganagaraan`, `file_kk`, `file_ktp`) VALUES
('DOM-0001', '2', '2', '2', '2025-05-22', 'Laki-Laki', 'Islam', '2', '2', 'kk..2.jpg', 'ktp..2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sk_kelahiran`
--

CREATE TABLE `sk_kelahiran` (
  `skl_id` varchar(50) NOT NULL,
  `no_kk` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(50) DEFAULT NULL,
  `agama` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `kewarganagaraan` varchar(50) DEFAULT NULL,
  `nama_ayah` varchar(50) DEFAULT NULL,
  `nama_ibu` varchar(50) DEFAULT NULL,
  `file_kk` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sk_kelahiran`
--

INSERT INTO `sk_kelahiran` (`skl_id`, `no_kk`, `nama`, `tgl_lahir`, `jenis_kelamin`, `agama`, `alamat`, `kewarganagaraan`, `nama_ayah`, `nama_ibu`, `file_kk`) VALUES
('LHR-0001', '4', '4', '2025-05-22', 'Laki-Laki', 'Islam', '4', '4', '4', '4', 'kk.4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sk_kematian`
--

CREATE TABLE `sk_kematian` (
  `skm_id` varchar(50) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `no_kk` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `tgl_meninggal` date DEFAULT NULL,
  `jenis_kelamin` varchar(50) DEFAULT NULL,
  `agama` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `file_kk` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sk_tidak_mampu`
--

CREATE TABLE `sk_tidak_mampu` (
  `sktm_id` varchar(50) NOT NULL,
  `nik` varchar(50) DEFAULT NULL,
  `no_kk` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `tgl_lahir` varchar(50) DEFAULT NULL,
  `jenis_kelamin` varchar(50) DEFAULT NULL,
  `agama` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `kewarganagaraan` varchar(50) DEFAULT NULL,
  `file_kk` varchar(50) DEFAULT NULL,
  `file_ktp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `spn_akte_kelahiran`
--

CREATE TABLE `spn_akte_kelahiran` (
  `spn_akte_kelahiran_id` varchar(50) NOT NULL,
  `no_kk` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `tgl_lahir` varchar(50) DEFAULT NULL,
  `jenis_kelamin` varchar(50) DEFAULT NULL,
  `agama` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `kewarganegaraan` varchar(50) DEFAULT NULL,
  `nama_ayah` varchar(50) DEFAULT NULL,
  `nama_ibu` varchar(50) DEFAULT NULL,
  `file_kk` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `spn_akte_kelahiran`
--

INSERT INTO `spn_akte_kelahiran` (`spn_akte_kelahiran_id`, `no_kk`, `nama`, `tgl_lahir`, `jenis_kelamin`, `agama`, `alamat`, `kewarganegaraan`, `nama_ayah`, `nama_ibu`, `file_kk`) VALUES
('AKL-0001', '5', '5', '2025-05-22', 'Laki-Laki', 'Islam', '5', '5', '5', '5', 'kk.5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `spn_status_perwalian`
--

CREATE TABLE `spn_status_perwalian` (
  `spn_status_perwalian_id` varchar(50) NOT NULL,
  `nik` varchar(50) DEFAULT NULL,
  `no_kk` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `tgl_lahir` varchar(50) DEFAULT NULL,
  `jenis_kelamin` varchar(50) DEFAULT NULL,
  `agama` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `kewarganagaraan` varchar(50) DEFAULT NULL,
  `file_ktp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sp_e_ktp`
--

CREATE TABLE `sp_e_ktp` (
  `spektp_id` varchar(50) NOT NULL,
  `nik` varchar(50) DEFAULT NULL,
  `no_kk` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `tgl_lahir` varchar(50) DEFAULT NULL,
  `jenis_kelamin` varchar(50) DEFAULT NULL,
  `agama` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `kewarganagaraan` varchar(50) DEFAULT NULL,
  `file_kk` varchar(50) DEFAULT NULL,
  `file_ktp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sp_e_ktp`
--

INSERT INTO `sp_e_ktp` (`spektp_id`, `nik`, `no_kk`, `nama`, `tgl_lahir`, `jenis_kelamin`, `agama`, `alamat`, `kewarganagaraan`, `file_kk`, `file_ktp`) VALUES
('EKTP-0001', '1', '1', '1', '2025-05-22', 'Laki-Laki', 'Islam', '1', '1', 'kk.1.jpg', 'ktp.1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sp_nikah`
--

CREATE TABLE `sp_nikah` (
  `sp_nikah_id` varchar(50) NOT NULL,
  `nik` varchar(50) DEFAULT NULL,
  `no_kk` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `tgl_lahir` varchar(50) DEFAULT NULL,
  `jenis_kelamin` varchar(50) DEFAULT NULL,
  `agama` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `pekerjaan` varchar(50) DEFAULT NULL,
  `kewarganegaraan` varchar(50) DEFAULT NULL,
  `file_kk` varchar(50) DEFAULT NULL,
  `file_ktp` varchar(50) DEFAULT NULL,
  `file_foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sp_skck`
--

CREATE TABLE `sp_skck` (
  `sp_skck_id` varchar(50) NOT NULL,
  `nik` varchar(50) DEFAULT NULL,
  `no_kk` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `tgl_lahir` varchar(50) DEFAULT NULL,
  `jenis_kelamin` varchar(50) DEFAULT NULL,
  `agama` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `pekerjaan` varchar(50) DEFAULT NULL,
  `file_ktp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `surat`
--

CREATE TABLE `surat` (
  `surat_id` varchar(50) NOT NULL,
  `nik_user` varchar(16) NOT NULL,
  `nama_surat` varchar(50) NOT NULL,
  `jenis_surat` varchar(50) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_keluar` date NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat`
--

INSERT INTO `surat` (`surat_id`, `nik_user`, `nama_surat`, `jenis_surat`, `no_surat`, `tgl_masuk`, `tgl_keluar`, `status`) VALUES
('AKL-0001', '1234567890000001', 'Surat Pernyataan Tidak Memiliki Akte Kelahiran', 'Surat Pernyataan', '0', '2025-05-22', '0000-00-00', 'Proses'),
('DOM-0001', '1234567890000001', '', '', '0', '2025-05-22', '0000-00-00', 'proses'),
('EKTP-0001', '1234567890000001', '', '', '0', '2025-05-22', '0000-00-00', 'proses'),
('LHR-0001', '1234567890000001', '', '', '0', '2025-05-22', '0000-00-00', 'proses');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nik`, `nama`, `password`) VALUES
(1, '1234567890000001', 'Aghnia', '$2y$10$uffAh9WuK2/2VIVStXyXHOonzodjVGnKJVVI.fuka3Lk3RXc1vfcO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sk_domisili`
--
ALTER TABLE `sk_domisili`
  ADD KEY `fk_skd_id` (`skd_id`);

--
-- Indexes for table `sp_e_ktp`
--
ALTER TABLE `sp_e_ktp`
  ADD KEY `fk_spektp_id` (`spektp_id`);

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`surat_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sk_domisili`
--
ALTER TABLE `sk_domisili`
  ADD CONSTRAINT `fk_skd_id` FOREIGN KEY (`skd_id`) REFERENCES `surat` (`surat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sp_e_ktp`
--
ALTER TABLE `sp_e_ktp`
  ADD CONSTRAINT `fk_spektp_id` FOREIGN KEY (`spektp_id`) REFERENCES `surat` (`surat_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
