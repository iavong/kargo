-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2020 at 09:54 AM
-- Server version: 8.0.15
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_kargo`
--

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE `deposit` (
  `id` bigint(20) NOT NULL,
  `id_pengirim` bigint(20) DEFAULT NULL,
  `id_penjualan` bigint(20) DEFAULT NULL,
  `deposit` varchar(100) DEFAULT NULL,
  `tipe` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=In,0=Out',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `deposit`
--

INSERT INTO `deposit` (`id`, `id_pengirim`, `id_penjualan`, `deposit`, `tipe`, `created_at`) VALUES
(1, 2, NULL, '1000000', 1, '2020-11-10 23:33:10'),
(14, 2, 9, '83950', 0, '2020-11-23 20:37:09'),
(15, 1, 9, '83950', 0, '2020-11-23 20:39:54'),
(16, 1, NULL, '20000000', 1, '2020-11-23 21:01:04');

-- --------------------------------------------------------

--
-- Table structure for table `gaji`
--

CREATE TABLE `gaji` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `total gaji` varchar(100) DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id` bigint(20) NOT NULL,
  `keterangan` text,
  `harga` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id`, `keterangan`, `harga`, `created_at`) VALUES
(2, 'makanan', '50000', '2020-09-07 04:12:45'),
(5, 'Galon', '7000', '2020-09-07 21:22:22'),
(6, 'Kopi', '5000', '2020-09-07 21:23:15'),
(9, 'Nasi Bungkus', '12000', '2020-10-07 04:46:07'),
(10, 'batagor dadan', '10000', '2020-10-27 02:24:43'),
(11, 'Kopi Asiang 5 Gelas', '50000', '2020-11-14 00:03:05'),
(12, 'BELI ROKOK', '200000', '2020-11-23 21:07:53'),
(13, 'BELI LIQUID', '1500000', '2020-11-23 21:08:15');

-- --------------------------------------------------------

--
-- Table structure for table `pengirim`
--

CREATE TABLE `pengirim` (
  `id` bigint(20) NOT NULL,
  `nama` varchar(250) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `deposit` varchar(100) DEFAULT NULL,
  `tipe` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=Langganan,1=Hutang',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pengirim`
--

INSERT INTO `pengirim` (`id`, `nama`, `no_hp`, `alamat`, `deposit`, `tipe`, `created_at`) VALUES
(1, 'Fikri', '089595959555', 'Pontianak', '19131650', 0, '2020-11-10 23:02:08'),
(2, 'Iavong', '08989898998', 'Pontianak', '916050', 0, '2020-11-10 23:02:23'),
(3, 'rey', '0877342432', 'ketapang', '0', 1, '2020-11-14 15:16:43');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` bigint(20) NOT NULL,
  `no_kwitansi` int(11) DEFAULT NULL,
  `airlines` varchar(100) DEFAULT NULL,
  `no_penerbangan` varchar(100) DEFAULT NULL,
  `no_smu` varchar(100) DEFAULT NULL,
  `berat` decimal(10,0) DEFAULT NULL,
  `koli` int(11) DEFAULT NULL,
  `custom_harga` varchar(100) DEFAULT NULL,
  `harga_smu` varchar(100) DEFAULT NULL,
  `biaya_smu` varchar(100) DEFAULT NULL,
  `biaya_admin_smu` varchar(100) DEFAULT NULL,
  `biaya_operasional` varchar(100) DEFAULT NULL,
  `total_operasional` varchar(100) DEFAULT NULL,
  `harga_gudang` varchar(100) DEFAULT NULL,
  `harga_admin_gudang` varchar(100) DEFAULT NULL,
  `total_biaya_gudang` varchar(100) DEFAULT NULL,
  `biaya_tambahan` varchar(100) DEFAULT NULL,
  `biaya_total` varchar(100) DEFAULT NULL,
  `isi` text,
  `catatan` text,
  `id_pengirim` bigint(20) DEFAULT NULL,
  `pengirim` varchar(100) DEFAULT NULL,
  `penerima` varchar(100) DEFAULT NULL,
  `tujuan_id` int(11) DEFAULT NULL,
  `jenis_pembayaran` enum('deposit','cash','debit') DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `no_kwitansi`, `airlines`, `no_penerbangan`, `no_smu`, `berat`, `koli`, `custom_harga`, `harga_smu`, `biaya_smu`, `biaya_admin_smu`, `biaya_operasional`, `total_operasional`, `harga_gudang`, `harga_admin_gudang`, `total_biaya_gudang`, `biaya_tambahan`, `biaya_total`, `isi`, `catatan`, `id_pengirim`, `pengirim`, `penerima`, `tujuan_id`, `jenis_pembayaran`, `created_at`) VALUES
(2, 10002, 'sriwijaya', '79234', '02938402', '7', 2, '', '30000', '320000', '20000', '15000', '150000', '1045', '3500', '13950', '', '483950', '', '', 1, 'Fikri', 'degi', 14, 'deposit', '2020-11-13 21:17:48'),
(5, 10003, 'sriwijaya', '79234', '02938402', '7', 2, '', '30000', '320000', '20000', '15000', '150000', '1045', '3500', '13950', '23000', '506950', '', '', 2, 'Iavong', 'degi', 14, 'cash', '2020-11-13 21:47:32'),
(6, 10004, 'sriwijaya', '79234', '02938402', '7', 2, '', '30000', '305000', '5000', '5000', '50000', '1045', '3500', '13950', '', '368950', '', '', 2, 'Iavong', 'Reki', 14, 'cash', '2020-11-13 21:55:08'),
(7, 10005, 'sriwijaya', '79234', '02938402', '5', 4, '', '15000', '170000', '20000', '15000', '150000', '1045', '3500', '13950', '', '333950', '', '', NULL, 'Rina', 'Reki', 12, 'cash', '2020-11-14 14:25:17'),
(8, 10006, 'sriwijaya', '3123', '231', '5', 1, '10000', '10000', '120000', '20000', '1000', '10000', '1045', '3500', '13950', '', '143950', '', '', 3, 'rey', 'ia', 10, 'cash', '2020-11-14 15:17:57'),
(9, 10007, 'sriwijaya', 'SJ-551', '998-23421', '10', 2, '', '5000', '60000', '10000', '1000', '10000', '1045', '3500', '13950', '', '83950', '', '', 2, 'Iavong', 'atan', 10, 'deposit', '2020-11-23 20:37:09'),
(11, 10009, 'sriwijaya', 'SJ-185', '977-111777', '100', 15, '7500', '7500', '760000', '10000', '3500', '350000', '1045', '3500', '108000', '', '1218000', 'GENCO', '-', NULL, 'JOHN KEI', 'HERCULES', 4, 'cash', '2020-11-23 20:53:02');

-- --------------------------------------------------------

--
-- Table structure for table `tujuan`
--

CREATE TABLE `tujuan` (
  `id` int(11) NOT NULL,
  `berat` decimal(10,0) DEFAULT NULL,
  `kota_tujuan` varchar(100) DEFAULT NULL,
  `biaya` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tujuan`
--

INSERT INTO `tujuan` (`id`, `berat`, `kota_tujuan`, `biaya`) VALUES
(4, '1', 'Jakarta', '25000'),
(5, '1', 'Sambas', '15000'),
(9, '1', 'Zimbabwe', '1000000'),
(10, '1', 'Ketapang', '5000'),
(11, '1', 'Solo', '16000'),
(12, '1', 'Bebas', '15000'),
(14, '1', 'Sintang', '30000'),
(15, '1', 'Daerah Istimewa Yogyakarta', '10000');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` tinyint(4) NOT NULL COMMENT '1=Master,2=Staff kantor,3=Staff lapangan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `role`) VALUES
(1, 'Administrator', 'master', '$2y$10$SMmgGW7yn/aVqf0ZsQm36.oDRyXHV9GFZASmhHLADrPiANk5dfQOm', 1),
(3, 'Atan', 'staff', '$2y$10$95nNst0hXjWRmyyo4Zq0a.A5N5jDneYsgrsvu.cTcXl/OojvGSC5a', 2),
(4, 'master dua', 'master2', '$2y$10$wSeSgBzHIT2sbfM5uAITz.ZXNhSgzt52C6JyT1ip.MgdgGH8.Gs1.', 1),
(5, 'Hap', 'lapangan', '$2y$10$17mlhhYKYHTn1gLSXZIM0u4PSzLhrXxkN6jILQsZsp1xnUIskYLB6', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengirim`
--
ALTER TABLE `pengirim`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tujuan`
--
ALTER TABLE `tujuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deposit`
--
ALTER TABLE `deposit`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pengirim`
--
ALTER TABLE `pengirim`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tujuan`
--
ALTER TABLE `tujuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
