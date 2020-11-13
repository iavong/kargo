-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 13 Nov 2020 pada 15.56
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.9

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
-- Struktur dari tabel `deposit`
--

CREATE TABLE `deposit` (
  `id` bigint(20) NOT NULL,
  `id_pengirim` bigint(20) DEFAULT NULL,
  `id_penjualan` bigint(20) DEFAULT NULL,
  `deposit` varchar(100) DEFAULT NULL,
  `tipe` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=In,0=Out',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `deposit`
--

INSERT INTO `deposit` (`id`, `id_pengirim`, `id_penjualan`, `deposit`, `tipe`, `created_at`) VALUES
(1, 2, NULL, '1000000', 1, '2020-11-10 23:33:10'),
(11, 2, 5, '506950', 0, '2020-11-13 21:52:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id` bigint(20) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `harga` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id`, `keterangan`, `harga`, `created_at`) VALUES
(2, 'makanan', '50000', '2020-09-07 04:12:45'),
(5, 'Galon', '7000', '2020-09-07 21:22:22'),
(6, 'Kopi', '5000', '2020-09-07 21:23:15'),
(9, 'Nasi Bungkus', '12000', '2020-10-07 04:46:07'),
(10, 'batagor dadan', '10000', '2020-10-27 02:24:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengirim`
--

CREATE TABLE `pengirim` (
  `id` bigint(20) NOT NULL,
  `nama` varchar(250) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `deposit` varchar(100) DEFAULT NULL,
  `tipe` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Langganan,1=Hutang',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pengirim`
--

INSERT INTO `pengirim` (`id`, `nama`, `no_hp`, `alamat`, `deposit`, `tipe`, `created_at`) VALUES
(1, 'Fikri', '089595959555', 'Pontianak', '-483950', 0, '2020-11-10 23:02:08'),
(2, 'Iavong', '08989898998', 'Pontianak', '493050', 0, '2020-11-10 23:02:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
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
  `isi` text DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `id_pengirim` bigint(20) DEFAULT NULL,
  `pengirim` varchar(100) DEFAULT NULL,
  `penerima` varchar(100) DEFAULT NULL,
  `tujuan_id` int(11) DEFAULT NULL,
  `jenis_pembayaran` enum('deposit','cash','debit') DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id`, `no_kwitansi`, `airlines`, `no_penerbangan`, `no_smu`, `berat`, `koli`, `custom_harga`, `harga_smu`, `biaya_smu`, `biaya_admin_smu`, `biaya_operasional`, `total_operasional`, `harga_gudang`, `harga_admin_gudang`, `total_biaya_gudang`, `biaya_tambahan`, `biaya_total`, `isi`, `catatan`, `id_pengirim`, `pengirim`, `penerima`, `tujuan_id`, `jenis_pembayaran`, `created_at`) VALUES
(2, 10002, 'sriwijaya', '79234', '02938402', '7', 2, '', '30000', '320000', '20000', '15000', '150000', '1045', '3500', '13950', '', '483950', '', '', 1, 'Fikri', 'degi', 14, 'deposit', '2020-11-13 21:17:48'),
(5, 10003, 'sriwijaya', '79234', '02938402', '7', 2, '', '30000', '320000', '20000', '15000', '150000', '1045', '3500', '13950', '23000', '506950', '', '', 2, 'Iavong', 'degi', 14, 'deposit', '2020-11-13 21:47:32'),
(6, 10004, 'sriwijaya', '79234', '02938402', '7', 2, '', '30000', '305000', '5000', '5000', '50000', '1045', '3500', '13950', '', '368950', '', '', 2, 'Iavong', 'Reki', 14, 'cash', '2020-11-13 21:55:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tujuan`
--

CREATE TABLE `tujuan` (
  `id` int(11) NOT NULL,
  `berat` decimal(10,0) DEFAULT NULL,
  `kota_tujuan` varchar(100) DEFAULT NULL,
  `biaya` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tujuan`
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
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` tinyint(4) NOT NULL COMMENT '1=Master,2=Staff kantor,3=Staff lapangan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
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
-- Indeks untuk tabel `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengirim`
--
ALTER TABLE `pengirim`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tujuan`
--
ALTER TABLE `tujuan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `deposit`
--
ALTER TABLE `deposit`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pengirim`
--
ALTER TABLE `pengirim`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tujuan`
--
ALTER TABLE `tujuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
