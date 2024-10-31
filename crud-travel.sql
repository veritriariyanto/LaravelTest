-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 19, 2024 at 11:59 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud-travel`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('admin1@gmail.com|127.0.0.1', 'i:1;', 1729334597),
('admin1@gmail.com|127.0.0.1:timer', 'i:1729334597;', 1729334597);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_destinasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `htm` decimal(10,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`id`, `nama_destinasi`, `deskripsi`, `lokasi`, `htm`, `image`, `created_at`, `updated_at`) VALUES
(2, 'Bali', '<p>Destinasi wisata terkenal dengan pantai dan budayanya.</p>', 'Bali, Indonesia', 1000000.00, 'eoNnb2tQtjIwSMQhgDAuj5AwT4EInbH2kxds7UdD.jpg', '2024-10-19 02:52:09', '2024-10-18 21:22:16'),
(3, 'Yogyakarta', '<p>Kota budaya dengan banyak candi dan sejarah.</p>', 'Yogyakarta, Indonesia', 750000.00, 'rqlOi1SudfMMQreJcnULeCWQRZdYEvy4IsD506Fg.jpg', '2024-10-19 02:52:09', '2024-10-18 21:23:38'),
(4, 'Jakarta', '<p>Ibukota Indonesia dengan berbagai atraksi modern.</p>', 'Jakarta, Indonesia', 500000.00, 'iQq6JSoJokHtXeBvBpObLZNtOnkBI8Ci0wyB8AlA.jpg', '2024-10-19 02:52:09', '2024-10-18 21:23:51'),
(5, 'Lombok', '<p>Pulau yang terkenal dengan pantai dan hiking.</p>', 'Lombok, Indonesia', 800000.00, 'iCak41cebh7u49bNmhY4gm2cjQKgTh8jWUd6HQl0.jpg', '2024-10-19 02:52:09', '2024-10-18 21:24:01'),
(6, 'Bandung', 'Kota dengan banyak tempat wisata alam dan kuliner.', 'Bandung, Indonesia', 600000.00, 'bandung.jpg', '2024-10-19 02:52:09', '2024-10-19 02:52:09'),
(7, 'Malang', 'Kota dengan udara sejuk dan banyak atraksi.', 'Malang, Indonesia', 700000.00, 'malang.jpg', '2024-10-19 02:52:09', '2024-10-19 02:52:09'),
(8, 'Seminyak', 'Daerah di Bali dengan pantai dan kehidupan malam.', 'Seminyak, Bali', 1200000.00, 'seminyak.jpg', '2024-10-19 02:52:09', '2024-10-19 02:52:09'),
(9, 'Ubud', 'Tempat dengan keindahan alam dan budaya yang kaya.', 'Ubud, Bali', 950000.00, 'ubud.jpg', '2024-10-19 02:52:09', '2024-10-19 02:52:09'),
(10, 'Surabaya', 'Kota terbesar kedua di Indonesia dengan sejarah.', 'Surabaya, Indonesia', 550000.00, 'surabaya.jpg', '2024-10-19 02:52:09', '2024-10-19 02:52:09'),
(11, 'Labuan Bajo', 'Gerbang menuju Pulau Komodo dan keindahan alam.', 'Labuan Bajo, Indonesia', 1300000.00, 'labuan_bajo.jpg', '2024-10-19 02:52:09', '2024-10-19 02:52:09'),
(12, 'Bromo', 'Gunung berapi yang terkenal dengan pemandangan matahari terbit.', 'Bromo, Indonesia', 900000.00, 'bromo.jpg', '2024-10-19 02:52:09', '2024-10-19 02:52:09'),
(13, 'Belitung', 'Pulau yang terkenal dengan pantai dan batu granit.', 'Belitung, Indonesia', 1100000.00, 'belitung.jpg', '2024-10-19 02:52:09', '2024-10-19 02:52:09'),
(14, 'Raja Ampat', 'Surga bawah laut dengan keindahan coral.', 'Raja Ampat, Indonesia', 2000000.00, 'raja_ampat.jpg', '2024-10-19 02:52:09', '2024-10-19 02:52:09'),
(15, 'Flores', 'Pulau dengan keindahan alam yang menakjubkan.', 'Flores, Indonesia', 1400000.00, 'flores.jpg', '2024-10-19 02:52:09', '2024-10-19 02:52:09'),
(16, 'Sumba', 'Pulau dengan budaya yang unik dan pantai yang indah.', 'Sumba, Indonesia', 1700000.00, 'sumba.jpg', '2024-10-19 02:52:09', '2024-10-19 02:52:09'),
(17, 'Baliem Valley', 'Lembah dengan pemandangan pegunungan yang indah.', 'Papua, Indonesia', 1800000.00, 'baliem.jpg', '2024-10-19 02:52:09', '2024-10-19 02:52:09'),
(18, 'Tana Toraja', 'Daerah dengan budaya unik dan pemandangan yang menakjubkan.', 'Sulawesi, Indonesia', 1600000.00, 'toraja.jpg', '2024-10-19 02:52:09', '2024-10-19 02:52:09'),
(19, 'Bintan', 'Pulau dengan resort dan pantai yang menawan.', 'Bintan, Indonesia', 1300000.00, 'bintan.jpg', '2024-10-19 02:52:09', '2024-10-19 02:52:09'),
(20, 'Sumbawa', 'Pulau dengan pemandangan yang masih alami.', 'Sumbawa, Indonesia', 1500000.00, 'sumbawa.jpg', '2024-10-19 02:52:09', '2024-10-19 02:52:09'),
(21, 'Kepulauan Seribu', 'Kumpulan pulau yang indah dekat Jakarta.', 'Jakarta, Indonesia', 750000.00, 'seribu.jpg', '2024-10-19 02:52:09', '2024-10-19 02:52:09');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_hotel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_per_malam` decimal(15,2) NOT NULL,
  `destination_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `nama_hotel`, `alamat`, `harga_per_malam`, `destination_id`, `created_at`, `updated_at`) VALUES
(2, 'Hotel Yogyakarta', 'Jl. Malioboro No. 2, Yogyakarta', 600000.00, 13, '2024-10-19 02:52:17', '2024-10-19 01:47:56'),
(3, 'Hotel Jakarta', 'Jl. Sudirman No. 3, Jakarta', 900000.00, 3, '2024-10-19 02:52:17', '2024-10-19 02:52:17'),
(4, 'Hotel Lombok', 'Jl. Senggigi No. 4, Lombok', 700000.00, 4, '2024-10-19 02:52:17', '2024-10-19 02:52:17'),
(5, 'Hotel Bandung', 'Jl. Dago No. 5, Bandung', 500000.00, 5, '2024-10-19 02:52:17', '2024-10-19 02:52:17'),
(6, 'Hotel Malang', 'Jl. Ijen No. 6, Malang', 550000.00, 6, '2024-10-19 02:52:17', '2024-10-19 02:52:17'),
(7, 'Hotel Seminyak', 'Jl. Seminyak No. 7, Bali', 1200000.00, 7, '2024-10-19 02:52:17', '2024-10-19 02:52:17'),
(8, 'Hotel Ubud', 'Jl. Ubud No. 8, Bali', 950000.00, 8, '2024-10-19 02:52:17', '2024-10-19 02:52:17'),
(9, 'Hotel Surabaya', 'Jl. Tunjungan No. 9, Surabaya', 650000.00, 9, '2024-10-19 02:52:17', '2024-10-19 02:52:17'),
(10, 'Hotel Labuan Bajo', 'Jl. Labuan Bajo No. 10, Flores', 1300000.00, 10, '2024-10-19 02:52:17', '2024-10-19 02:52:17'),
(11, 'Hotel Bromo', 'Jl. Bromo No. 11, Bromo', 700000.00, 11, '2024-10-19 02:52:17', '2024-10-19 02:52:17'),
(12, 'Hotel Belitung', 'Jl. Belitung No. 12, Belitung', 850000.00, 12, '2024-10-19 02:52:17', '2024-10-19 02:52:17'),
(13, 'Hotel Raja Ampat', 'Jl. Raja Ampat No. 13, Papua', 2000000.00, 13, '2024-10-19 02:52:17', '2024-10-19 02:52:17'),
(14, 'Hotel Flores', 'Jl. Flores No. 14, Flores', 1400000.00, 14, '2024-10-19 02:52:17', '2024-10-19 02:52:17'),
(15, 'Hotel Sumba', 'Jl. Sumba No. 15, Sumba', 1700000.00, 15, '2024-10-19 02:52:17', '2024-10-19 02:52:17'),
(16, 'Hotel Baliem Valley', 'Jl. Baliem No. 16, Papua', 1800000.00, 16, '2024-10-19 02:52:17', '2024-10-19 02:52:17'),
(17, 'Hotel Tana Toraja', 'Jl. Toraja No. 17, Sulawesi', 1600000.00, 17, '2024-10-19 02:52:17', '2024-10-19 02:52:17'),
(18, 'Hotel Bintan', 'Jl. Bintan No. 18, Bintan', 1300000.00, 18, '2024-10-19 02:52:17', '2024-10-19 02:52:17'),
(19, 'Hotel Sumbawa', 'Jl. Sumbawa No. 19, Sumbawa', 1500000.00, 19, '2024-10-19 02:52:17', '2024-10-19 02:52:17'),
(20, 'Hotel Kepulauan Seribu', 'Jl. Seribu No. 20, Jakarta', 750000.00, 20, '2024-10-19 02:52:17', '2024-10-19 02:52:17');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(19, '0001_01_01_000000_create_users_table', 1),
(20, '0001_01_01_000001_create_cache_table', 1),
(21, '0001_01_01_000002_create_jobs_table', 1),
(22, '2024_10_13_111916_create_products_table', 1),
(23, '2024_10_18_120410_create_destinations_table', 1),
(24, '2024_10_18_122411_create_hotels_table', 1),
(25, '2024_10_18_122545_create_transports_table', 1),
(26, '2024_10_18_122655_create_pakets_table', 1),
(27, '2024_10_18_154151_change_biaya_type_in_transports_table', 1),
(28, '2024_10_19_013115_add_destination_id_to_transports_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pakets`
--

CREATE TABLE `pakets` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_paket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_total` decimal(10,2) NOT NULL,
  `destination_id` bigint UNSIGNED NOT NULL,
  `hotel_id` bigint UNSIGNED NOT NULL,
  `transport_id` bigint UNSIGNED NOT NULL,
  `rating` int NOT NULL DEFAULT '0',
  `ulasan` int NOT NULL DEFAULT '0',
  `total_pembelian` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pakets`
--

INSERT INTO `pakets` (`id`, `nama_paket`, `deskripsi`, `harga_total`, `destination_id`, `hotel_id`, `transport_id`, `rating`, `ulasan`, `total_pembelian`, `created_at`, `updated_at`) VALUES
(2, 'Paket Wisata Lombok', 'Termasuk akomodasi dan transportasi ke pantai.', 1900000.00, 12, 4, 4, 1, 4, 4, '2024-10-19 02:55:40', '2024-10-19 04:14:10'),
(3, 'Paket Kuliner Bandung', 'Nikmati kuliner Bandung dengan hotel nyaman.', 1600000.00, 5, 5, 5, 0, 0, 0, '2024-10-19 02:55:40', '2024-10-19 02:55:40'),
(4, 'Paket Malang Sejuk', 'Paket wisata ke Malang dan hotel terbaik.', 1700000.00, 6, 6, 6, 0, 0, 0, '2024-10-19 02:55:40', '2024-10-19 02:55:40'),
(6, 'Paket Relaksasi Ubud', 'Wisata alam dan spa di Ubud.', 2800000.00, 8, 8, 2, 0, 0, 0, '2024-10-19 02:55:40', '2024-10-19 02:55:40'),
(7, 'Paket Surabaya Heritage', 'Eksplorasi sejarah Surabaya dengan penginapan.', 2100000.00, 9, 9, 4, 0, 0, 0, '2024-10-19 02:55:40', '2024-10-19 02:55:40'),
(8, 'Paket Labuan Bajo Adventure', 'Paket petualangan ke Pulau Komodo.', 3500000.00, 10, 10, 10, 0, 0, 0, '2024-10-19 02:55:40', '2024-10-19 02:55:40'),
(11, 'Paket Raja Ampat Snorkeling', 'Pengalaman snorkeling di Raja Ampat.', 4200000.00, 13, 13, 5, 0, 0, 0, '2024-10-19 02:55:40', '2024-10-19 02:55:40'),
(12, 'Paket Flores Trekking', 'Paket trekking di Flores dengan penginapan.', 3000000.00, 14, 14, 4, 0, 0, 0, '2024-10-19 02:55:40', '2024-10-19 02:55:40'),
(13, 'Paket Sumba Culture', 'Menelusuri budaya Sumba.', 2900000.00, 15, 15, 2, 0, 0, 0, '2024-10-19 02:55:40', '2024-10-19 02:55:40'),
(16, 'Paket Bintan Relaxation', 'Resort di Bintan dengan fasilitas lengkap.', 3000000.00, 18, 18, 2, 0, 0, 0, '2024-10-19 02:55:40', '2024-10-19 02:55:40'),
(17, 'Paket Sumbawa Adventure', 'Petualangan outdoor di Sumbawa.', 3200000.00, 19, 19, 4, 0, 0, 0, '2024-10-19 02:55:40', '2024-10-19 02:55:40'),
(18, 'Paket Kepulauan Seribu Getaway', 'Liburan santai di Kepulauan Seribu.', 2100000.00, 20, 20, 5, 0, 0, 0, '2024-10-19 02:55:40', '2024-10-19 02:55:40');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('veritriariyanto@gmail.com', '$2y$12$7V7hYKjy6CkoUgzF7ebOEuq.gx8Rx54jMhGxq4CrG54XVSC90FdFO', '2024-10-19 03:21:59');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` bigint NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('h3TgF3MZv5BUIX8qVi8WobodoZyd8quVFhXDyodj', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVHNzWmJxZDFES2tKVlFPNnVNR1B2Tzc2V2RaREJsdkFZa3doZUhONCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly9jcnVkLXRyYXZlbC50ZXN0L2xvZ2luIjt9czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMDoiaHR0cDovL2NydWQtdHJhdmVsLnRlc3QvcGFrZXRzIjt9fQ==', 1729339167),
('KUKHYXMXYZyMhXuMAqfD4twvPovbS4sNoNMFO0Db', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZ3lLOEx1VkNTOUtBeFJDOGNlUUFYdDZrTWN3NmtwOU5UTE5scEVKNiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wYWtldHMiO319', 1729336480);

-- --------------------------------------------------------

--
-- Table structure for table `transports`
--

CREATE TABLE `transports` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_transport` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe_transport` enum('bis','travel','pesawat','kapal') COLLATE utf8mb4_unicode_ci NOT NULL,
  `biaya` bigint NOT NULL,
  `destination_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transports`
--

INSERT INTO `transports` (`id`, `nama_transport`, `tipe_transport`, `biaya`, `destination_id`, `created_at`, `updated_at`) VALUES
(2, 'Travel Yogyakarta', 'travel', 400000, 2, '2024-10-19 02:52:24', '2024-10-19 02:52:24'),
(4, 'Kapal Lombok', 'kapal', 500000, 4, '2024-10-19 02:52:24', '2024-10-19 02:52:24'),
(5, 'Bis Bandung-Jakarta', 'bis', 200000, 3, '2024-10-19 02:52:24', '2024-10-19 02:52:24'),
(6, 'Travel Malang', 'travel', 300000, 6, '2024-10-19 02:52:24', '2024-10-19 02:52:24'),
(7, 'Pesawat Bali-Sumba', 'pesawat', 1500000, 15, '2024-10-19 02:52:24', '2024-10-19 02:52:24'),
(8, 'Bis Seminyak-Jakarta', 'bis', 350000, 3, '2024-10-19 02:52:24', '2024-10-19 02:52:24'),
(9, 'Kapal Labuan Bajo', 'kapal', 600000, 10, '2024-10-19 02:52:24', '2024-10-19 02:52:24'),
(10, 'Travel Bromo', 'travel', 700000, 11, '2024-10-19 02:52:24', '2024-10-19 02:52:24'),
(11, 'Pesawat Belitung', 'pesawat', 1200000, 12, '2024-10-19 02:52:24', '2024-10-19 02:52:24'),
(12, 'Bis Raja Ampat', 'bis', 800000, 13, '2024-10-19 02:52:24', '2024-10-19 02:52:24'),
(13, 'Travel Flores', 'travel', 900000, 14, '2024-10-19 02:52:24', '2024-10-19 02:52:24'),
(14, 'Pesawat Sumba', 'pesawat', 2000000, 15, '2024-10-19 02:52:24', '2024-10-19 02:52:24'),
(15, 'Kapal Baliem Valley', 'kapal', 1800000, 16, '2024-10-19 02:52:24', '2024-10-19 02:52:24'),
(16, 'Travel Tana Toraja', 'travel', 1700000, 17, '2024-10-19 02:52:24', '2024-10-19 02:52:24'),
(17, 'Bis Bintan', 'bis', 750000, 18, '2024-10-19 02:52:24', '2024-10-19 02:52:24'),
(18, 'Kapal Sumbawa', 'kapal', 950000, 19, '2024-10-19 02:52:24', '2024-10-19 02:52:24'),
(19, 'Travel Kepulauan Seribu', 'travel', 600000, 20, '2024-10-19 02:52:24', '2024-10-19 02:52:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(7, 'admin', 'admin@gmail.com', NULL, '$2y$12$o7M79Qtg8.lHDA9BszVbPeUiTLyfN1WfR6x3yQqo7t6b8Yb4N/pPS', NULL, '2024-10-19 04:44:07', '2024-10-19 04:44:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotels_destination_id_foreign` (`destination_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pakets`
--
ALTER TABLE `pakets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pakets_destination_id_foreign` (`destination_id`),
  ADD KEY `pakets_hotel_id_foreign` (`hotel_id`),
  ADD KEY `pakets_transport_id_foreign` (`transport_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transports`
--
ALTER TABLE `transports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transports_destination_id_foreign` (`destination_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `pakets`
--
ALTER TABLE `pakets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transports`
--
ALTER TABLE `transports`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hotels`
--
ALTER TABLE `hotels`
  ADD CONSTRAINT `hotels_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pakets`
--
ALTER TABLE `pakets`
  ADD CONSTRAINT `pakets_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pakets_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pakets_transport_id_foreign` FOREIGN KEY (`transport_id`) REFERENCES `transports` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transports`
--
ALTER TABLE `transports`
  ADD CONSTRAINT `transports_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
