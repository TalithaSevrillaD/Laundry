-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2020 at 06:25 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail`
--

CREATE TABLE `detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `subtotal` int(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail`
--

INSERT INTO `detail` (`id`, `id_transaksi`, `id_jenis`, `subtotal`, `qty`, `created_at`, `updated_at`) VALUES
(7, 4, 3, 10000, 2, NULL, NULL),
(8, 5, 3, 10000, 2, NULL, NULL),
(9, 5, 2, 10000, 1, NULL, NULL),
(10, 6, 5, 48000, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_cuci`
--

CREATE TABLE `jenis_cuci` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_kilo` int(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_cuci`
--

INSERT INTO `jenis_cuci` (`id`, `nama_jenis`, `harga_kilo`, `created_at`, `updated_at`) VALUES
(3, 'cuci', 5000, NULL, NULL),
(4, 'setrika', 10000, NULL, NULL),
(5, 'cuci kering + setrika', 12000, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
-- Error reading data for table laundry.migrations: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `laundry`.`migrations`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_pelanggan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama_pelanggan`, `alamat`, `telp`, `created_at`, `updated_at`) VALUES
(3, 'athala', 'Malang', '0892355', NULL, NULL),
(4, 'nakula', 'JKT', '082754788', NULL, NULL),
(5, 'sevrillaaaaa', 'baliiiii', '0829480971', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_petugas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('petugas','admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id`, `nama_petugas`, `telp`, `username`, `password`, `level`, `created_at`, `updated_at`) VALUES
(3, 'knj', '0989244567', 'knj', '$2y$10$fWOyQ1kvm3BiHQRrGRV6Mea0mr9RuZZLL2W/oG/KXht8Cg9c73ckO', 'admin', '2020-02-18 05:01:04', '2020-02-18 05:01:04'),
(4, 'v', '0989244567', 'v', '$2y$10$ywc75Fe0Ig9oYarmlY4x.O4tmtJAdvnaCgoDXsUdRhq.DRg6y6WXG', 'petugas', '2020-02-18 05:01:20', '2020-02-18 05:01:20'),
(5, 'talitha', '08972487', 'talitha', '$2y$10$GL0QMg7DnuvIi2qvyqdBruZI/JdN33ZxFw7G3/VqVNqtd4nh4MfJq', 'admin', '2020-02-28 00:12:04', '2020-02-28 00:12:04'),
(6, 'aku', '08972487', 'aku', '$2y$10$e2re5Tfn2Fx1v4jrQ38ytuEQw6var8ujzzUaUj2d442QyeDlptROe', 'admin', '2020-03-22 23:27:49', '2020-03-22 23:27:49');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `tgl_transaksi` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
-- Error reading data for table laundry.transaksi: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `laundry`.`transaksi`' at line 1

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail`
--
ALTER TABLE `detail`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_transaksi` (`id_transaksi`,`id_jenis`);

--
-- Indexes for table `jenis_cuci`
--
ALTER TABLE `jenis_cuci`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_pelanggan` (`id_pelanggan`,`id_petugas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail`
--
ALTER TABLE `detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jenis_cuci`
--
ALTER TABLE `jenis_cuci`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
