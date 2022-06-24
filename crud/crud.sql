-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2022 at 07:42 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama`, `jumlah`, `tanggal`) VALUES
(2, 'meja', 10, '2022-05-24'),
(11, 'kursi', 16, '2022-05-31'),
(12, 'laptop', 20, '2022-05-31'),
(13, 'komputer', 22, '2022-05-31'),
(14, 'telepon', 6, '2022-05-31'),
(15, 'mesin fotokopi', 4, '2022-05-31'),
(16, 'lemari', 10, '2022-05-31'),
(17, 'printer', 8, '2022-05-31'),
(18, 'AC', 14, '2022-05-31'),
(19, 'kipas angin', 22, '2022-05-31'),
(20, 'dispenser', 4, '2022-05-31'),
(21, 'papan tulis', 6, '2022-05-31'),
(38, 'flashdisk', 30, '2022-06-24'),
(39, 'mouse', 40, '2022-06-24');

-- --------------------------------------------------------

--
-- Table structure for table `log_barang`
--

CREATE TABLE `log_barang` (
  `id` int(11) NOT NULL,
  `user` varchar(200) NOT NULL,
  `aksi` varchar(200) NOT NULL,
  `nama_barang` varchar(200) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `nama_barang_baru` varchar(200) DEFAULT NULL,
  `jumlah_baru` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_barang`
--

INSERT INTO `log_barang` (`id`, `user`, `aksi`, `nama_barang`, `jumlah`, `tanggal`, `nama_barang_baru`, `jumlah_baru`) VALUES
(5, 'admin', 'menghapus', 'tes2', 10, '2022-06-21 07:56:25', NULL, NULL),
(6, 'admin', 'menghapus', 'tes3', 10, '2022-06-21 05:59:57', NULL, NULL),
(7, 'admin', 'menghapus', 'tes4', 10, '2022-06-21 06:07:34', NULL, NULL),
(8, 'admin', 'menghapus', 'tes5', 10, '2022-06-21 06:08:54', NULL, NULL),
(9, 'admin', 'menghapus', 'tes6', 10, '2022-06-22 01:11:26', NULL, NULL),
(38, 'admin', 'menghapus', 'tes3', 10, '2022-06-22 07:36:40', NULL, NULL),
(39, 'admin', 'menghapus', 'tes3', 10, '2022-06-22 07:37:28', NULL, NULL),
(40, 'admin', 'menambahkan', 'tes tambah', 10, '2022-06-23 01:00:43', NULL, NULL),
(41, 'admin', 'menghapus', 'tes tambah', 10, '2022-06-23 01:00:57', NULL, NULL),
(42, 'admin', 'menghapus', 'tes tambah', 10, '2022-06-23 01:08:43', NULL, NULL),
(43, 'admin', 'menghapus', 'tes4', 10, '2022-06-23 01:09:06', NULL, NULL),
(44, 'admin', 'menambahkan', 'tes edit 1', 22, '2022-06-23 10:41:18', NULL, NULL),
(45, 'admin', 'menambahkan', 'tes edit 2', 22, '2022-06-23 22:45:08', NULL, NULL),
(46, 'admin', 'mengedit', 'tes edit 2', 22, '2022-06-23 22:47:37', 'tes edit 2.1', '20'),
(47, 'admin', 'menghapus', 'tes edit 2.1', 20, '2022-06-24 22:05:49', NULL, NULL),
(48, 'admin2', 'menghapus', 'tes edit 1', 22, '2022-06-24 22:08:07', NULL, NULL),
(49, 'test', 'menambahkan', 'flashdisk', 30, '2022-06-24 23:36:11', NULL, NULL),
(50, 'test', 'menambahkan', 'kabel', 40, '2022-06-24 23:36:47', NULL, NULL),
(51, 'test', 'mengedit', 'kabel', 40, '2022-06-24 23:37:03', 'mouse', '50'),
(52, 'test', 'mengedit', 'mouse', 50, '2022-06-24 23:38:58', 'mouse', '40');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `gambar`, `username`, `password`) VALUES
(1, 'default.png', 'admin', '$2y$10$wh8sEohdi1o7McFSNSeBaecZ.awXjwBBwBH/EWJa.isoi4HA1jKIu'),
(2, 'nophoto2.jpg', 'admin2', '$2y$10$2V.N5GItchKzcUtxF0exbe1Ah1FKb5pA4YbtsMv5hzj8qZcRuwjp2'),
(3, 'nophoto(1).png', 'admin3', '$2y$10$T7oMUwhPLWj9q8sCGHs.quBVVk4IeabH59B6GbScSrIdK22vc6scy'),
(9, 'nophoto.png', 'a', '$2y$10$mT/zmaUylVJzT8pVoDNF4uhceczwdufCxPNfTxkqZQSzZM5gU7sfC'),
(10, 'nophoto(1)(2).png', 'guest', '$2y$10$ig2XcZ7j.ZS/U55pk5s8e.hRfqQArWn6CyoArwen070eXGB9dNycC'),
(16, 'nophoto(1)(2)(3).png', 'b', '$2y$10$L4i01m1Zp0u6ypGlccYh9eGKeH49DE2s1tqogR9lP4GUsvA3Ud8Yy'),
(18, 'nophoto4(1).jpg', 'test', '$2y$10$UG3L7dRHjDfod1W/3qS7.O8DKKuZ.EZeZZxylz45sHV1X44tqvnt6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_barang`
--
ALTER TABLE `log_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `log_barang`
--
ALTER TABLE `log_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
