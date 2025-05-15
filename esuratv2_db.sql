-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2025 at 08:56 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
  `skd_id` int(11) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sk_kelahiran`
--

CREATE TABLE `sk_kelahiran` (
  `skl_id` int(11) NOT NULL,
  `nik` varchar(50) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sk_kematian`
--

CREATE TABLE `sk_kematian` (
  `skm_id` int(11) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `no_kk` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `tgl_meninggal` date DEFAULT NULL,
  `jenis_kelamin` varchar(50) DEFAULT NULL,
  `agama` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `file_kk` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sk_tidak_mampu`
--

CREATE TABLE `sk_tidak_mampu` (
  `sktm_id` int(11) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `spn_akte_kelahiran`
--

CREATE TABLE `spn_akte_kelahiran` (
  `spn_akte_kelahiran_id` int(11) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `spn_status_perwalian`
--

CREATE TABLE `spn_status_perwalian` (
  `status_perwalian_id` int(11) NOT NULL,
  `nik` varchar(50) DEFAULT NULL,
  `no_kk` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `tgl_lahir` varchar(50) DEFAULT NULL,
  `jenis_kelamin` varchar(50) DEFAULT NULL,
  `agama` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `kewarganagaraan` varchar(50) DEFAULT NULL,
  `file_ktp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_e_ktp`
--

CREATE TABLE `sp_e_ktp` (
  `spektp_id` int(11) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_nikah`
--

CREATE TABLE `sp_nikah` (
  `sp_nikah_id` int(11) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_skck`
--

CREATE TABLE `sp_skck` (
  `skck_id` int(11) NOT NULL,
  `nik` varchar(50) DEFAULT NULL,
  `no_kk` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `tgl_lahir` varchar(50) DEFAULT NULL,
  `jenis_kelamin` varchar(50) DEFAULT NULL,
  `agama` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `pekerjaan` varchar(50) DEFAULT NULL,
  `file_ktp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sk_domisili`
--
ALTER TABLE `sk_domisili`
  ADD PRIMARY KEY (`skd_id`);

--
-- Indexes for table `sk_kelahiran`
--
ALTER TABLE `sk_kelahiran`
  ADD PRIMARY KEY (`skl_id`);

--
-- Indexes for table `sk_kematian`
--
ALTER TABLE `sk_kematian`
  ADD PRIMARY KEY (`skm_id`);

--
-- Indexes for table `sk_tidak_mampu`
--
ALTER TABLE `sk_tidak_mampu`
  ADD PRIMARY KEY (`sktm_id`);

--
-- Indexes for table `spn_akte_kelahiran`
--
ALTER TABLE `spn_akte_kelahiran`
  ADD PRIMARY KEY (`spn_akte_kelahiran_id`);

--
-- Indexes for table `spn_status_perwalian`
--
ALTER TABLE `spn_status_perwalian`
  ADD PRIMARY KEY (`status_perwalian_id`);

--
-- Indexes for table `sp_e_ktp`
--
ALTER TABLE `sp_e_ktp`
  ADD PRIMARY KEY (`spektp_id`);

--
-- Indexes for table `sp_nikah`
--
ALTER TABLE `sp_nikah`
  ADD PRIMARY KEY (`sp_nikah_id`);

--
-- Indexes for table `sp_skck`
--
ALTER TABLE `sp_skck`
  ADD PRIMARY KEY (`skck_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sk_domisili`
--
ALTER TABLE `sk_domisili`
  MODIFY `skd_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sk_kelahiran`
--
ALTER TABLE `sk_kelahiran`
  MODIFY `skl_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sk_kematian`
--
ALTER TABLE `sk_kematian`
  MODIFY `skm_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sk_tidak_mampu`
--
ALTER TABLE `sk_tidak_mampu`
  MODIFY `sktm_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `spn_akte_kelahiran`
--
ALTER TABLE `spn_akte_kelahiran`
  MODIFY `spn_akte_kelahiran_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `spn_status_perwalian`
--
ALTER TABLE `spn_status_perwalian`
  MODIFY `status_perwalian_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_e_ktp`
--
ALTER TABLE `sp_e_ktp`
  MODIFY `spektp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_nikah`
--
ALTER TABLE `sp_nikah`
  MODIFY `sp_nikah_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_skck`
--
ALTER TABLE `sp_skck`
  MODIFY `skck_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
