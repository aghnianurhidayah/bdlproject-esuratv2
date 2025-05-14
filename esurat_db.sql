-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2023 at 02:53 PM
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
-- Database: `esurat_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `form_id` int(11) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `nik` varchar(50) DEFAULT NULL,
  `no_kk` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `tgl_kematian` date DEFAULT NULL,
  `jenis_kelamin` varchar(50) DEFAULT NULL,
  `agama` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `pekerjaan` varchar(50) DEFAULT NULL,
  `kewarganegaraan` varchar(50) DEFAULT NULL,
  `nama_ayah` varchar(50) DEFAULT NULL,
  `nama_ibu` varchar(50) DEFAULT NULL,
  `file_kk` varchar(255) DEFAULT NULL,
  `file_ktp` varchar(255) DEFAULT NULL,
  `file_foto` varchar(255) DEFAULT NULL,
  `nama_surat` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`form_id`, `no_surat`, `nik`, `no_kk`, `nama`, `tgl_lahir`, `tgl_kematian`, `jenis_kelamin`, `agama`, `alamat`, `pekerjaan`, `kewarganegaraan`, `nama_ayah`, `nama_ibu`, `file_kk`, `file_ktp`, `file_foto`, `nama_surat`, `status`) VALUES
(34, '172/SK/2023/123', '6471046804040001', '1234567898765437', 'Nia nuristikomah', '2023-11-07', '0000-00-00', 'Perempuan', 'Hindu', 'bontang', 'baby sister', '', '', '', 'kk.Surat Keterangan Tidak Mampu.Nia nuristikomah.png', 'ktp.Surat Keterangan Tidak Mampu.Nia nuristikomah.png', '', 'Surat Keterangan Tidak Mampu', 'Setuju'),
(37, '172/SK/2023/0', '6471046804040001', '123456789098765', 'cinta kuya', '2023-11-16', '0000-00-00', 'Perempuan', 'Hindu', 'makasar', '', 'indonesia', '', '', 'kk.Surat Keterangan Domisili.cinta kuya.png', 'ktp.Surat Keterangan Domisili.cinta kuya.png', '', 'Surat Keterangan Domisili', 'Tolak');

-- --------------------------------------------------------

--
-- Table structure for table `surat`
--

CREATE TABLE `surat` (
  `fk_form_id` int(11) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `jenis_surat` varchar(50) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_keluar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat`
--

INSERT INTO `surat` (`fk_form_id`, `nik`, `jenis_surat`, `tgl_masuk`, `tgl_keluar`) VALUES
(34, '6471046804040001', 'Surat Keterangan', '2023-11-16', '2023-11-16'),
(37, '6471046804040001', 'Surat Keterangan', '2023-11-16', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nik`, `nama`, `password`) VALUES
(12, '6474015908040006', 'Aghnia Nurhidayah', '$2y$10$gpVlPPD0ee206sYtexonoO6eV0PqftjIHgBXveeqtLz80xG2cQ7se'),
(13, '6471046804040001', 'Navira Arditha', '$2y$10$rdrOu5eAfEPl4uHc3gIZku.N2V/UsMx57WzIw6i0MrKxWYlFpdH4K');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`form_id`);

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
  ADD KEY `fk_form_id` (`fk_form_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `form_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `surat`
--
ALTER TABLE `surat`
  ADD CONSTRAINT `surat_ibfk_1` FOREIGN KEY (`fk_form_id`) REFERENCES `forms` (`form_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
