-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 30 Agu 2024 pada 12.14
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tahfidz`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id_guru` char(50) NOT NULL,
  `nik_guru` char(50) NOT NULL,
  `nama_guru` varchar(255) NOT NULL,
  `tempat_lahir_guru` varchar(255) NOT NULL,
  `tanggal_lahir_guru` date NOT NULL,
  `jenis_kelamin_guru` char(5) NOT NULL,
  `no_hp_guru` char(15) NOT NULL,
  `email_guru` char(50) NOT NULL,
  `foto_guru` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `status_guru` int NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_user` int NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id_guru`, `nik_guru`, `nama_guru`, `tempat_lahir_guru`, `tanggal_lahir_guru`, `jenis_kelamin_guru`, `no_hp_guru`, `email_guru`, `foto_guru`, `status_guru`, `password`, `id_user`, `created_at`, `updated_at`, `deleted_at`) VALUES
('GR-190724-1', '1234567', 'as', 'as', '2024-07-19', 'L', '123456789012', 'as@gmail.com', 'guru/as-images-removebg-preview.png', 1, '$2y$12$Mjm0lP/mogxrqHh8BKR67.ROV7/FM6d1Quin9GEpxUSlUz5SsvJhC', 10, '2024-08-30 10:57:53', '2024-08-30 10:57:53', NULL),
('GR-300824-2', '123456789123', 'we', 'we', '2024-08-30', 'L', '123456789012', 'asas@gmail.com', 'guru/we-JAKFAR MERAH FORMAL.jpg', 1, '$2y$12$Z3EkYiKbfkWqsnVKZKReQ.as33rM8y.CitAlGNnBhWhb95TTACDg6', 10, '2024-08-30 11:02:30', '2024-08-30 11:03:00', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` char(50) NOT NULL,
  `nama_kelas` varchar(255) NOT NULL,
  `status_kelas` int NOT NULL,
  `id_user` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `status_kelas`, `id_user`, `created_at`, `updated_at`, `deleted_at`) VALUES
('KLS-190724-1', 'A.01', 0, 10, '2024-07-19 01:32:10', '2024-07-22 03:14:22', NULL),
('KLS-190724-2', 'A.02', 0, 10, '2024-07-19 15:44:27', '2024-07-19 15:44:27', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kop`
--

CREATE TABLE `kop` (
  `id` int NOT NULL,
  `image_kop` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `kop`
--

INSERT INTO `kop` (`id`, `image_kop`, `created_at`, `updated_at`) VALUES
(1, '1721619262_kop_web_mytahfidz.jpg', '2024-07-19 10:49:36', '2024-07-22 10:34:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_login`
--

CREATE TABLE `log_login` (
  `id` bigint UNSIGNED NOT NULL,
  `ip_address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `browser` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `platform` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `device` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `negara` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `log_login`
--

INSERT INTO `log_login` (`id`, `ip_address`, `browser`, `platform`, `device`, `negara`, `id_user`, `created_at`, `updated_at`) VALUES
(1, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-19 01:31:56', '2024-07-19 01:31:56'),
(2, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-19 02:55:56', '2024-07-19 02:55:56'),
(3, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-19 11:14:19', '2024-07-19 11:14:19'),
(4, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-19 14:44:59', '2024-07-19 14:44:59'),
(5, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-19 16:46:23', '2024-07-19 16:46:23'),
(6, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-19 16:48:34', '2024-07-19 16:48:34'),
(7, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-19 16:52:53', '2024-07-19 16:52:53'),
(8, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-19 17:09:13', '2024-07-19 17:09:13'),
(9, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-19 22:53:23', '2024-07-19 22:53:23'),
(10, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-19 22:54:42', '2024-07-19 22:54:42'),
(11, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-19 22:56:02', '2024-07-19 22:56:02'),
(12, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-19 22:57:19', '2024-07-19 22:57:19'),
(13, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-19 22:57:41', '2024-07-19 22:57:41'),
(14, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-19 23:04:57', '2024-07-19 23:04:57'),
(15, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-19 23:05:24', '2024-07-19 23:05:24'),
(16, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-19 23:07:52', '2024-07-19 23:07:52'),
(17, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-19 23:09:57', '2024-07-19 23:09:57'),
(18, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-19 23:13:50', '2024-07-19 23:13:50'),
(19, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-19 23:15:09', '2024-07-19 23:15:09'),
(20, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-19 23:19:02', '2024-07-19 23:19:02'),
(21, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-19 23:26:46', '2024-07-19 23:26:46'),
(22, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-19 23:28:13', '2024-07-19 23:28:13'),
(23, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-19 23:28:31', '2024-07-19 23:28:31'),
(24, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-19 23:37:58', '2024-07-19 23:37:58'),
(25, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-19 23:42:27', '2024-07-19 23:42:27'),
(26, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-19 23:53:11', '2024-07-19 23:53:11'),
(27, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-20 00:20:39', '2024-07-20 00:20:39'),
(28, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-20 01:12:05', '2024-07-20 01:12:05'),
(29, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-20 01:13:38', '2024-07-20 01:13:38'),
(30, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-20 04:30:41', '2024-07-20 04:30:41'),
(31, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-20 04:33:53', '2024-07-20 04:33:53'),
(32, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-20 04:35:07', '2024-07-20 04:35:07'),
(33, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-20 04:47:16', '2024-07-20 04:47:16'),
(34, '127.0.0.1', 'Edge V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-20 04:57:44', '2024-07-20 04:57:44'),
(35, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-20 04:59:05', '2024-07-20 04:59:05'),
(36, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-20 04:59:43', '2024-07-20 04:59:43'),
(37, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-20 05:00:04', '2024-07-20 05:00:04'),
(38, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-20 05:00:42', '2024-07-20 05:00:42'),
(39, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-20 05:28:27', '2024-07-20 05:28:27'),
(40, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-20 05:29:06', '2024-07-20 05:29:06'),
(41, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-20 06:47:15', '2024-07-20 06:47:15'),
(42, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-20 06:48:49', '2024-07-20 06:48:49'),
(43, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-20 07:03:21', '2024-07-20 07:03:21'),
(44, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-20 07:47:09', '2024-07-20 07:47:09'),
(45, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-20 07:50:21', '2024-07-20 07:50:21'),
(46, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-20 08:36:20', '2024-07-20 08:36:20'),
(47, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-20 09:14:47', '2024-07-20 09:14:47'),
(48, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-20 14:59:32', '2024-07-20 14:59:32'),
(49, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-20 21:49:09', '2024-07-20 21:49:09'),
(50, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-20 21:53:12', '2024-07-20 21:53:12'),
(51, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-20 22:37:40', '2024-07-20 22:37:40'),
(52, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-20 22:39:09', '2024-07-20 22:39:09'),
(53, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-20 22:41:33', '2024-07-20 22:41:33'),
(54, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-20 22:46:13', '2024-07-20 22:46:13'),
(55, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-20 22:47:09', '2024-07-20 22:47:09'),
(56, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-20 22:53:25', '2024-07-20 22:53:25'),
(57, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-20 22:55:57', '2024-07-20 22:55:57'),
(58, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-20 22:56:11', '2024-07-20 22:56:11'),
(59, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-20 23:18:21', '2024-07-20 23:18:21'),
(60, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-20 23:52:57', '2024-07-20 23:52:57'),
(61, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-20 23:55:03', '2024-07-20 23:55:03'),
(62, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-21 00:23:33', '2024-07-21 00:23:33'),
(63, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-21 00:24:06', '2024-07-21 00:24:06'),
(64, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-21 00:57:19', '2024-07-21 00:57:19'),
(65, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-21 03:19:39', '2024-07-21 03:19:39'),
(66, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-21 03:23:59', '2024-07-21 03:23:59'),
(67, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-21 03:24:11', '2024-07-21 03:24:11'),
(68, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-21 03:37:38', '2024-07-21 03:37:38'),
(69, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-21 03:39:23', '2024-07-21 03:39:23'),
(70, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-21 03:40:00', '2024-07-21 03:40:00'),
(71, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-21 03:48:54', '2024-07-21 03:48:54'),
(72, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-21 03:49:04', '2024-07-21 03:49:04'),
(73, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-22 02:38:20', '2024-07-22 02:38:20'),
(74, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-22 02:39:26', '2024-07-22 02:39:26'),
(75, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-22 03:11:55', '2024-07-22 03:11:55'),
(76, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-22 03:58:33', '2024-07-22 03:58:33'),
(77, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-22 04:02:44', '2024-07-22 04:02:44'),
(78, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-22 04:04:50', '2024-07-22 04:04:50'),
(79, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-22 04:06:11', '2024-07-22 04:06:11'),
(80, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-22 04:07:53', '2024-07-22 04:07:53'),
(81, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-22 04:16:52', '2024-07-22 04:16:52'),
(82, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-22 04:20:02', '2024-07-22 04:20:02'),
(83, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-22 04:21:19', '2024-07-22 04:21:19'),
(84, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-22 06:43:29', '2024-07-22 06:43:29'),
(85, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-22 10:39:33', '2024-07-22 10:39:33'),
(86, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-22 10:40:19', '2024-07-22 10:40:19'),
(87, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-22 10:48:03', '2024-07-22 10:48:03'),
(88, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-22 11:32:13', '2024-07-22 11:32:13'),
(89, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-22 12:28:31', '2024-07-22 12:28:31'),
(90, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-22 12:28:54', '2024-07-22 12:28:54'),
(91, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-22 15:31:04', '2024-07-22 15:31:04'),
(92, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-22 15:31:35', '2024-07-22 15:31:35'),
(93, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-22 16:21:26', '2024-07-22 16:21:26'),
(94, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-23 02:13:26', '2024-07-23 02:13:26'),
(95, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-23 02:14:26', '2024-07-23 02:14:26'),
(96, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-23 03:10:49', '2024-07-23 03:10:49'),
(97, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-23 03:11:39', '2024-07-23 03:11:39'),
(98, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-23 03:44:49', '2024-07-23 03:44:49'),
(99, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-23 07:40:08', '2024-07-23 07:40:08'),
(100, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-23 11:52:43', '2024-07-23 11:52:43'),
(101, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-23 12:15:48', '2024-07-23 12:15:48'),
(102, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-23 13:59:04', '2024-07-23 13:59:04'),
(103, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-23 22:55:50', '2024-07-23 22:55:50'),
(104, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-24 10:17:32', '2024-07-24 10:17:32'),
(105, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-24 10:36:49', '2024-07-24 10:36:49'),
(106, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-24 13:37:54', '2024-07-24 13:37:54'),
(107, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-24 13:38:28', '2024-07-24 13:38:28'),
(108, '127.0.0.1', 'Edge V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-24 13:38:44', '2024-07-24 13:38:44'),
(109, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-24 22:30:03', '2024-07-24 22:30:03'),
(110, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-24 22:41:17', '2024-07-24 22:41:17'),
(111, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-25 01:48:44', '2024-07-25 01:48:44'),
(112, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-25 02:10:17', '2024-07-25 02:10:17'),
(113, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-25 02:11:10', '2024-07-25 02:11:10'),
(114, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-25 03:16:25', '2024-07-25 03:16:25'),
(115, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-25 03:17:14', '2024-07-25 03:17:14'),
(116, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-25 11:15:39', '2024-07-25 11:15:39'),
(117, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-25 14:04:08', '2024-07-25 14:04:08'),
(118, '127.0.0.1', 'Chrome V.126.0.0.0', 'AndroidOS V.6.0', 'Nexus', 'Local Server - 127.0.0.1', 'session user', '2024-07-25 16:48:17', '2024-07-25 16:48:17'),
(119, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-26 02:40:49', '2024-07-26 02:40:49'),
(120, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-26 03:20:02', '2024-07-26 03:20:02'),
(121, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-26 14:51:38', '2024-07-26 14:51:38'),
(122, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-26 16:02:06', '2024-07-26 16:02:06'),
(123, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-26 16:07:56', '2024-07-26 16:07:56'),
(124, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-27 04:28:49', '2024-07-27 04:28:49'),
(125, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-27 13:33:08', '2024-07-27 13:33:08'),
(126, '127.0.0.1', 'Chrome V.126.0.0.0', 'AndroidOS V.6.0', 'Nexus', 'Local Server - 127.0.0.1', 'session user', '2024-07-27 14:29:43', '2024-07-27 14:29:43'),
(127, '127.0.0.1', 'Chrome V.126.0.0.0', 'AndroidOS V.6.0', 'Nexus', 'Local Server - 127.0.0.1', 'session user', '2024-07-27 14:32:08', '2024-07-27 14:32:08'),
(128, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-27 22:32:27', '2024-07-27 22:32:27'),
(129, '127.0.0.1', 'Chrome V.126.0.0.0', 'AndroidOS V.6.0', 'Nexus', 'Local Server - 127.0.0.1', 'session user', '2024-07-27 22:44:23', '2024-07-27 22:44:23'),
(130, '127.0.0.1', 'Chrome V.126.0.0.0', 'AndroidOS V.6.0', 'Nexus', 'Local Server - 127.0.0.1', 'session user', '2024-07-27 22:45:44', '2024-07-27 22:45:44'),
(131, '127.0.0.1', 'Chrome V.126.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-29 00:04:35', '2024-07-29 00:04:35'),
(132, '127.0.0.1', 'Chrome V.127.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-07-30 06:14:41', '2024-07-30 06:14:41'),
(133, '127.0.0.1', 'Chrome V.127.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-08-09 22:29:29', '2024-08-09 22:29:29'),
(134, '127.0.0.1', 'Chrome V.127.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-08-09 22:30:22', '2024-08-09 22:30:22'),
(135, '127.0.0.1', 'Chrome V.127.0.0.0', 'AndroidOS V.6.0', 'Nexus', 'Local Server - 127.0.0.1', 'session user', '2024-08-10 00:11:54', '2024-08-10 00:11:54'),
(136, '127.0.0.1', 'Chrome V.127.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-08-10 09:41:05', '2024-08-10 09:41:05'),
(137, '127.0.0.1', 'Chrome V.127.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-08-10 09:50:34', '2024-08-10 09:50:34'),
(138, '127.0.0.1', 'Chrome V.127.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-08-21 09:06:42', '2024-08-21 09:06:42'),
(139, '127.0.0.1', 'Chrome V.127.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-08-21 09:08:50', '2024-08-21 09:08:50'),
(140, '127.0.0.1', 'Chrome V.127.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-08-21 09:23:12', '2024-08-21 09:23:12'),
(141, '127.0.0.1', 'Chrome V.127.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-08-21 09:24:11', '2024-08-21 09:24:11'),
(142, '127.0.0.1', 'Chrome V.127.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-08-30 10:50:40', '2024-08-30 10:50:40'),
(143, '127.0.0.1', 'Chrome V.127.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-08-30 10:58:41', '2024-08-30 10:58:41'),
(144, '127.0.0.1', 'Chrome V.127.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-08-30 11:01:38', '2024-08-30 11:01:38'),
(145, '127.0.0.1', 'Chrome V.127.0.0.0', 'AndroidOS V.6.0', 'Nexus', 'Local Server - 127.0.0.1', 'session user', '2024-08-30 11:12:28', '2024-08-30 11:12:28'),
(146, '127.0.0.1', 'Chrome V.127.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-08-30 11:14:50', '2024-08-30 11:14:50'),
(147, '127.0.0.1', 'Chrome V.127.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-08-30 11:16:11', '2024-08-30 11:16:11'),
(148, '127.0.0.1', 'Chrome V.127.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-08-30 11:59:22', '2024-08-30 11:59:22'),
(149, '127.0.0.1', 'Chrome V.127.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-08-30 12:04:19', '2024-08-30 12:04:19'),
(150, '127.0.0.1', 'Chrome V.127.0.0.0', 'Windows V.10.0', 'WebKit', 'Local Server - 127.0.0.1', 'session user', '2024-08-30 12:11:08', '2024-08-30 12:11:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mail_settings`
--

CREATE TABLE `mail_settings` (
  `id` int UNSIGNED NOT NULL,
  `mail_mailer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'smtp',
  `mail_host` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'mailpit',
  `mail_port` int NOT NULL DEFAULT '1025',
  `mail_username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_encryption` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_from_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hello@example.com',
  `mail_from_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Laravel',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `mail_settings`
--

INSERT INTO `mail_settings` (`id`, `mail_mailer`, `mail_host`, `mail_port`, `mail_username`, `mail_password`, `mail_encryption`, `mail_from_address`, `mail_from_name`, `created_at`, `updated_at`) VALUES
(1, 'smtp', 'smtp.gmail.com', 465, 'shodiqsolution@gmail.com', 'zmxinnjncrpmrcca', 'ssl', 'shodiqsolution@gmail.com', 'MY TAHFIDZ', NULL, '2024-07-22 02:48:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_06_01_223445_create_mail_settings_table', 1),
(6, '2024_06_05_094243_crate_log_pengguna_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaian_kegiatan`
--

CREATE TABLE `penilaian_kegiatan` (
  `id_penilaian_kegiatan` char(50) NOT NULL,
  `id_peserta_kegiatan` char(50) NOT NULL,
  `tanggal_penilaian_kegiatan` date NOT NULL,
  `jenis_penilaian_kegiatan` char(50) NOT NULL,
  `surah_awal_penilaian_kegiatan` varchar(255) NOT NULL,
  `surah_akhir_penilaian_kegiatan` varchar(255) NOT NULL,
  `ayat_awal_penilaian_kegiatan` int NOT NULL,
  `ayat_akhir_penilaian_kegiatan` int NOT NULL,
  `nilai_tajwid_penilaian_kegiatan` double DEFAULT NULL,
  `nilai_fasohah_penilaian_kegiatan` double DEFAULT NULL,
  `nilai_kelancaran_penilaian_kegiatan` double DEFAULT NULL,
  `nilai_ghunnah_penilaian_kegiatan` double DEFAULT NULL,
  `nilai_mad_penilaian_tahsin` double DEFAULT NULL,
  `nilai_waqof_penilaian_tahsin` double DEFAULT NULL,
  `keterangan_penilaian_kegiatan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_user` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `penilaian_kegiatan`
--

INSERT INTO `penilaian_kegiatan` (`id_penilaian_kegiatan`, `id_peserta_kegiatan`, `tanggal_penilaian_kegiatan`, `jenis_penilaian_kegiatan`, `surah_awal_penilaian_kegiatan`, `surah_akhir_penilaian_kegiatan`, `ayat_awal_penilaian_kegiatan`, `ayat_akhir_penilaian_kegiatan`, `nilai_tajwid_penilaian_kegiatan`, `nilai_fasohah_penilaian_kegiatan`, `nilai_kelancaran_penilaian_kegiatan`, `nilai_ghunnah_penilaian_kegiatan`, `nilai_mad_penilaian_tahsin`, `nilai_waqof_penilaian_tahsin`, `keterangan_penilaian_kegiatan`, `created_at`, `updated_at`, `deleted_at`, `id_user`) VALUES
('PNI-200724-1', 'PES-200724-1', '2024-07-20', 'tahsin', '1', '1', 1, 7, NULL, NULL, 98, 96, 96, 96, 'asss', '2024-07-20 06:45:55', '2024-07-20 07:26:58', NULL, 'GR-230624-3'),
('PNI-200724-2', 'PES-200724-1', '2024-07-20', 'tahsin', '1', '2', 1, 1, NULL, NULL, 99, 97, 96, 97, 'ass', '2024-07-20 11:03:35', '2024-07-20 11:03:35', NULL, 'GR-190724-1'),
('PNI-200724-3', 'PES-200724-1', '2024-07-20', 'materikulasi', '1', '1', 1, 3, NULL, NULL, 98, 97, 98, 100, 'as', '2024-07-20 11:03:35', '2024-07-20 11:08:54', NULL, 'GR-190724-1'),
('PNI-200724-4', 'PES-200724-1', '2024-07-20', 'tahsin', '1', '5', 1, 1, NULL, NULL, 83, 100, 97, 97, 'ass', '2024-07-20 11:03:35', '2024-07-20 11:09:02', NULL, 'GR-190724-1'),
('PNI-210724-1', 'PES-210724-1', '2024-07-21', 'murajaah', '3', '4', 2, 3, 87, 96, 99, NULL, NULL, NULL, 'as', '2024-07-20 23:09:36', '2024-07-20 23:09:36', NULL, 'GR-190724-1'),
('PNI-210724-2', 'PES-210724-1', '2024-07-21', 'tahfidz', '1', '2', 1, 25, 97, 97, 99, NULL, NULL, NULL, 'as', '2024-07-20 23:09:36', '2024-07-20 23:09:36', NULL, 'GR-190724-1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaian_sertifikasi`
--

CREATE TABLE `penilaian_sertifikasi` (
  `id_penilaian_sertifikasi` char(50) NOT NULL,
  `id_peserta_sertifikasi` char(50) NOT NULL,
  `surah_mulai` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `surah_akhir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ayat_awal` int NOT NULL,
  `ayat_akhir` int NOT NULL,
  `koreksi_sertifikasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nilai_sertifikasi` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_user` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `penilaian_sertifikasi`
--

INSERT INTO `penilaian_sertifikasi` (`id_penilaian_sertifikasi`, `id_peserta_sertifikasi`, `surah_mulai`, `surah_akhir`, `ayat_awal`, `ayat_akhir`, `koreksi_sertifikasi`, `nilai_sertifikasi`, `created_at`, `updated_at`, `deleted_at`, `id_user`) VALUES
('PEN-SERT-230724-1', 'PES-SERT-220724-4', '1', '17', 3, 3, 'as', 80, '2024-07-23 05:35:10', '2024-07-23 13:23:41', NULL, 'GR-190724-1'),
('PEN-SERT-230724-2', 'PES-SERT-220724-4', '2', '111', 271, 5, 'er', 89, '2024-07-23 13:18:29', '2024-07-23 13:36:03', NULL, 'GR-190724-1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `periode`
--

CREATE TABLE `periode` (
  `id_periode` char(50) NOT NULL,
  `id_tahun_ajaran` char(50) NOT NULL,
  `judul_periode` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jenis_periode` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jenis_kegiatan` varchar(255) DEFAULT NULL,
  `tggl_awal_periode` date DEFAULT NULL,
  `tggl_akhir_periode` date DEFAULT NULL,
  `tggl_akhir_penilaian` datetime DEFAULT NULL,
  `tggl_periode` date DEFAULT NULL,
  `tanggungjawab_periode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `pesan_periode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `file_periode` varchar(255) DEFAULT NULL,
  `juz_periode` int DEFAULT NULL,
  `sesi_periode` int DEFAULT NULL,
  `status_periode` int NOT NULL,
  `id_user` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `periode`
--

INSERT INTO `periode` (`id_periode`, `id_tahun_ajaran`, `judul_periode`, `jenis_periode`, `jenis_kegiatan`, `tggl_awal_periode`, `tggl_akhir_periode`, `tggl_akhir_penilaian`, `tggl_periode`, `tanggungjawab_periode`, `pesan_periode`, `file_periode`, `juz_periode`, `sesi_periode`, `status_periode`, `id_user`, `created_at`, `updated_at`, `deleted_at`) VALUES
('PE-190724-1', 'TA-190724-2', 'setoran', 'tahfidz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 10, '2024-07-19 16:28:14', '2024-07-19 16:39:18', '2024-07-19 04:39:18'),
('PE-190724-2', 'TA-190724-2', 'setoran', 'tahfidz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, '2024-07-19 16:37:59', '2024-07-25 02:10:34', NULL),
('PE-190724-3', 'TA-190724-2', 'setoran', 'tahsin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, '2024-07-19 16:39:47', '2024-07-25 02:10:31', NULL),
('PE-200724-1', 'TA-190724-2', 'rapor', 'tahfidz', 'ganjil', '2024-07-19', '2024-07-21', '2024-09-20 13:49:00', '2024-07-20', 'Jakfar Shodiq, S.T', 'test', NULL, NULL, NULL, 1, 10, '2024-07-20 06:50:11', '2024-08-30 11:15:34', NULL),
('PE-200724-2', 'TA-190724-2', 'rapor', 'tahsin', 'ganjil', '2024-07-19', '2024-07-20', '2024-09-25 13:54:00', '2024-07-20', 'Jakfar Shodiq, S.T', 'coba', NULL, NULL, NULL, 1, 10, '2024-07-20 06:55:16', '2024-08-30 11:15:55', NULL),
('PE-220724-1', 'TA-190724-2', 'sertifikasi', 'tahfidz', NULL, NULL, NULL, '2024-07-22 13:07:00', '2024-07-22', 'as', NULL, '1722006007_custom-filename.jpeg', 2, 2, 0, 10, '2024-07-22 05:06:41', '2024-07-26 15:00:07', NULL),
('PE-220724-3', 'TA-190724-2', 'sertifikasi', 'tahfidz', NULL, NULL, NULL, '2024-07-22 18:05:00', '2024-07-22', 'Asalaman', NULL, NULL, 1, 2, 1, 10, '2024-07-22 11:05:37', '2024-07-25 02:10:55', NULL),
('PE-250724-1', 'TA-190724-2', 'sertifikasi', 'tahsin', NULL, NULL, NULL, '2024-07-25 10:16:00', '2024-07-31', 'qw', NULL, NULL, 30, 2, 1, 10, '2024-07-25 03:16:58', '2024-07-25 03:17:02', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'YourAppName', 'a98da01098646c6ac7ef13ed7ebe9812feb04f0088bd9a869fd8a02bc1485d27', '[\"*\"]', NULL, NULL, '2024-07-18 23:40:56', '2024-07-18 23:40:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peserta_kegiatan`
--

CREATE TABLE `peserta_kegiatan` (
  `id_peserta_kegiatan` char(50) NOT NULL,
  `id_tahun_ajaran` char(50) NOT NULL,
  `id_periode` char(50) NOT NULL,
  `id_siswa` char(50) NOT NULL,
  `id_kelas` char(50) NOT NULL,
  `id_guru` char(50) NOT NULL,
  `status_peserta_kegiatan` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `peserta_kegiatan`
--

INSERT INTO `peserta_kegiatan` (`id_peserta_kegiatan`, `id_tahun_ajaran`, `id_periode`, `id_siswa`, `id_kelas`, `id_guru`, `status_peserta_kegiatan`, `created_at`, `updated_at`, `deleted_at`, `id_user`) VALUES
('PES-200724-1', 'TA-190724-2', 'PE-190724-3', 'SW-190724-1', 'KLS-190724-1', 'GR-190724-1', 1, '2024-07-20 05:28:43', '2024-07-24 13:43:19', NULL, 10),
('PES-210724-1', 'TA-190724-2', 'PE-190724-2', 'SW-190724-1', 'KLS-190724-1', 'GR-190724-1', 1, '2024-07-20 22:53:56', '2024-07-20 22:54:00', NULL, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `peserta_sertifikasi`
--

CREATE TABLE `peserta_sertifikasi` (
  `id_peserta_sertifikasi` char(50) NOT NULL,
  `id_tahun_ajaran` char(50) NOT NULL,
  `id_periode` char(50) NOT NULL,
  `id_siswa` char(50) NOT NULL,
  `id_kelas` char(50) NOT NULL,
  `id_guru` char(50) NOT NULL,
  `id_penguji` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `status_peserta_sertifikasi` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `peserta_sertifikasi`
--

INSERT INTO `peserta_sertifikasi` (`id_peserta_sertifikasi`, `id_tahun_ajaran`, `id_periode`, `id_siswa`, `id_kelas`, `id_guru`, `id_penguji`, `status_peserta_sertifikasi`, `created_at`, `updated_at`, `deleted_at`, `id_user`) VALUES
('PES-SERT-220724-1', 'TA-190724-2', 'PE-220724-1', 'SW-190724-1', 'KLS-190724-1', 'GR-190724-1', NULL, 3, '2024-07-22 14:43:32', '2024-07-22 15:26:11', '2024-07-22 03:26:11', 0),
('PES-SERT-220724-2', 'TA-190724-2', 'PE-220724-1', 'SW-190724-1', 'KLS-190724-1', 'GR-190724-1', NULL, 3, '2024-07-22 15:27:52', '2024-07-22 15:30:11', '2024-07-22 03:30:11', 0),
('PES-SERT-220724-3', 'TA-190724-2', 'PE-220724-1', 'SW-190724-1', 'KLS-190724-1', 'GR-190724-1', NULL, 3, '2024-07-22 15:30:33', '2024-07-22 15:30:37', '2024-07-22 03:30:37', 0),
('PES-SERT-220724-4', 'TA-190724-2', 'PE-220724-1', 'SW-190724-1', 'KLS-190724-1', 'GR-190724-1', 'GR-190724-1', 0, '2024-07-22 15:30:42', '2024-07-23 03:39:54', NULL, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rapor_kegiatan`
--

CREATE TABLE `rapor_kegiatan` (
  `id_rapor` char(50) NOT NULL,
  `id_tahun_ajaran` char(50) NOT NULL,
  `id_periode` char(50) NOT NULL,
  `id_siswa` char(50) NOT NULL,
  `id_kelas` char(50) NOT NULL,
  `id_guru` char(50) NOT NULL,
  `jenis_penilaian_kegiatan` char(50) NOT NULL,
  `surah_baru` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `surah_lama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `n_j_baru` double DEFAULT NULL,
  `n_f_baru` double DEFAULT NULL,
  `n_k_baru` double DEFAULT NULL,
  `n_g_baru` double DEFAULT NULL,
  `n_m_baru` double DEFAULT NULL,
  `n_w_baru` double DEFAULT NULL,
  `n_j_lama` double DEFAULT NULL,
  `n_f_lama` double DEFAULT NULL,
  `n_k_lama` double DEFAULT NULL,
  `n_g_lama` double DEFAULT NULL,
  `n_m_lama` double DEFAULT NULL,
  `n_w_lama` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `rapor_kegiatan`
--

INSERT INTO `rapor_kegiatan` (`id_rapor`, `id_tahun_ajaran`, `id_periode`, `id_siswa`, `id_kelas`, `id_guru`, `jenis_penilaian_kegiatan`, `surah_baru`, `surah_lama`, `n_j_baru`, `n_f_baru`, `n_k_baru`, `n_g_baru`, `n_m_baru`, `n_w_baru`, `n_j_lama`, `n_f_lama`, `n_k_lama`, `n_g_lama`, `n_m_lama`, `n_w_lama`, `created_at`, `updated_at`, `deleted_at`, `id_user`) VALUES
('RAP-100824-1', 'TA-190724-2', 'PE-200724-2', 'SW-190724-1', 'KLS-190724-1', 'GR-190724-1', 'tahsin', 'Al-Fatihah', 'Al-Fatihah', NULL, NULL, 70, 73.25, 72.25, 72.5, NULL, NULL, 24.5, 24.25, 24.5, 25, '2024-07-20 07:00:39', '2024-08-10 00:15:30', NULL, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rapor_pengembangan_diri`
--

CREATE TABLE `rapor_pengembangan_diri` (
  `id_pengembangan_diri` char(50) NOT NULL,
  `id_rapor` char(50) NOT NULL,
  `id_tahun_ajaran` char(50) NOT NULL,
  `id_periode` char(50) NOT NULL,
  `id_siswa` char(50) NOT NULL,
  `id_kelas` char(50) NOT NULL,
  `id_guru` char(50) NOT NULL,
  `jenis_penilaian_kegiatan` char(50) NOT NULL,
  `awal_surah_baru` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `akhir_surah_baru` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `awal_ayat_baru` int DEFAULT NULL,
  `akhir_ayat_baru` int DEFAULT NULL,
  `awal_surah_lama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `akhir_surah_lama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `awal_ayat_lama` int DEFAULT NULL,
  `akhir_ayat_lama` int DEFAULT NULL,
  `n_k_p` double DEFAULT NULL,
  `n_m_p` double DEFAULT NULL,
  `n_t_p` double DEFAULT NULL,
  `n_th_p` double DEFAULT NULL,
  `n_tf_p` double DEFAULT NULL,
  `n_jk_p` double DEFAULT NULL,
  `tggl_penilaian_p` date NOT NULL,
  `ketrangan_p` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_user` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `rapor_pengembangan_diri`
--

INSERT INTO `rapor_pengembangan_diri` (`id_pengembangan_diri`, `id_rapor`, `id_tahun_ajaran`, `id_periode`, `id_siswa`, `id_kelas`, `id_guru`, `jenis_penilaian_kegiatan`, `awal_surah_baru`, `akhir_surah_baru`, `awal_ayat_baru`, `akhir_ayat_baru`, `awal_surah_lama`, `akhir_surah_lama`, `awal_ayat_lama`, `akhir_ayat_lama`, `n_k_p`, `n_m_p`, `n_t_p`, `n_th_p`, `n_tf_p`, `n_jk_p`, `tggl_penilaian_p`, `ketrangan_p`, `created_at`, `updated_at`, `deleted_at`, `id_user`) VALUES
('PNGM-220724-1', 'RAP-100824-1', 'TA-190724-2', 'PE-200724-2', 'SW-190724-1', 'KLS-190724-1', 'GR-190724-1', 'tahsin', 'Al-Fatihah', 'Al-Fatihah', 0, 0, 'Al-Fatihah', 'Al-Fatihah', 0, 0, 96, NULL, NULL, 89, NULL, 90, '2024-07-22', '12aswww', '2024-07-22 04:08:47', '2024-07-22 04:08:47', NULL, 'GR-190724-1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` char(50) NOT NULL,
  `nisn_siswa` char(50) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `tanggal_lahir_siswa` date NOT NULL,
  `tempat_lahir_siswa` varchar(50) NOT NULL,
  `jenis_kelamin_siswa` varbinary(50) NOT NULL,
  `no_hp_siswa` char(15) NOT NULL,
  `email_siswa` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `tahun_masuk_siswa` year NOT NULL,
  `foto_siswa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `status_siswa` int NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_user` char(50) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nisn_siswa`, `nama_siswa`, `tanggal_lahir_siswa`, `tempat_lahir_siswa`, `jenis_kelamin_siswa`, `no_hp_siswa`, `email_siswa`, `tahun_masuk_siswa`, `foto_siswa`, `status_siswa`, `password`, `id_user`, `created_at`, `updated_at`, `deleted_at`) VALUES
('SW-190724-1', '1234567890', 'shodiq', '2024-07-19', 'as', 0x4c, '123456789012', 'shodiq@gmail.com', '2024', 'siswa/shodiq-kop_web_mytahfidz.jpg', 1, '$2y$12$XotNJ50htJCrgOHeGSkXFeo9BaiZaYXMusOHMnh4ZwV8hd0q8MnIe', '10', '2024-07-19 16:19:52', '2024-07-22 02:54:37', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sm_penilaian_kegiatan`
--

CREATE TABLE `sm_penilaian_kegiatan` (
  `id_penilaian_kegiatan` char(50) NOT NULL,
  `id_peserta_kegiatan` char(50) NOT NULL,
  `id_periode` char(50) NOT NULL,
  `tanggal_penilaian_kegiatan` date NOT NULL,
  `jenis_penilaian_kegiatan` char(50) NOT NULL,
  `surah_awal_penilaian_kegiatan` varchar(255) NOT NULL,
  `surah_akhir_penilaian_kegiatan` varchar(255) NOT NULL,
  `ayat_awal_penilaian_kegiatan` double NOT NULL,
  `ayat_akhir_penilaian_kegiatan` double NOT NULL,
  `nilai_tajwid_penilaian_kegiatan` double DEFAULT NULL,
  `nilai_fasohah_penilaian_kegiatan` double DEFAULT NULL,
  `nilai_kelancaran_penilaian_kegiatan` double DEFAULT NULL,
  `nilai_ghunnah_penilaian_kegiatan` double DEFAULT NULL,
  `nilai_mad_penilaian_tahsin` double DEFAULT NULL,
  `nilai_waqof_penilaian_tahsin` double DEFAULT NULL,
  `keterangan_penilaian_kegiatan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_user` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `surah`
--

CREATE TABLE `surah` (
  `nomor` int NOT NULL,
  `namaLatin` varchar(255) NOT NULL,
  `jumlahAyat` int NOT NULL,
  `tempatTurun` varchar(255) NOT NULL,
  `arti` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `surah`
--

INSERT INTO `surah` (`nomor`, `namaLatin`, `jumlahAyat`, `tempatTurun`, `arti`, `created_at`, `updated_at`) VALUES
(1, 'Al-Fatihah', 7, 'Mekah', 'Pembukaan', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(2, 'Al-Baqarah', 286, 'Madinah', 'Sapi', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(3, 'Ali \'Imran', 200, 'Madinah', 'Keluarga Imran', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(4, 'An-Nisa\'', 176, 'Madinah', 'Wanita', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(5, 'Al-Ma\'idah', 120, 'Madinah', 'Hidangan', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(6, 'Al-An\'am', 165, 'Mekah', 'Binatang Ternak', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(7, 'Al-A\'raf', 206, 'Mekah', 'Tempat Tertinggi', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(8, 'Al-Anfal', 75, 'Madinah', 'Rampasan Perang', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(9, 'At-Taubah', 129, 'Madinah', 'Pengampunan', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(10, 'Yunus', 109, 'Mekah', 'Yunus', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(11, 'Hud', 123, 'Mekah', 'Hud', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(12, 'Yusuf', 111, 'Mekah', 'Yusuf', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(13, 'Ar-Ra\'d', 43, 'Madinah', 'Guruh', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(14, 'Ibrahim', 52, 'Mekah', 'Ibrahim', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(15, 'Al-Hijr', 99, 'Mekah', 'Hijr', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(16, 'An-Nahl', 128, 'Mekah', 'Lebah', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(17, 'Al-Isra\'', 111, 'Mekah', 'Memperjalankan Malam Hari', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(18, 'Al-Kahf', 110, 'Mekah', 'Goa', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(19, 'Maryam', 98, 'Mekah', 'Maryam', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(20, 'Taha', 135, 'Mekah', 'Taha', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(21, 'Al-Anbiya\'', 112, 'Mekah', 'Para Nabi', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(22, 'Al-Hajj', 78, 'Madinah', 'Haji', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(23, 'Al-Mu\'minun', 118, 'Mekah', 'Orang-Orang Mukmin', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(24, 'An-Nur', 64, 'Madinah', 'Cahaya', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(25, 'Al-Furqan', 77, 'Mekah', 'Pembeda', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(26, 'Asy-Syu\'ara\'', 227, 'Mekah', 'Para Penyair', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(27, 'An-Naml', 93, 'Mekah', 'Semut-semut', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(28, 'Al-Qasas', 88, 'Mekah', 'Kisah-Kisah', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(29, 'Al-\'Ankabut', 69, 'Mekah', 'Laba-Laba', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(30, 'Ar-Rum', 60, 'Mekah', 'Romawi', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(31, 'Luqman', 34, 'Mekah', 'Luqman', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(32, 'As-Sajdah', 30, 'Mekah', 'Sajdah', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(33, 'Al-Ahzab', 73, 'Madinah', 'Golongan Yang Bersekutu', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(34, 'Saba\'', 54, 'Mekah', 'Saba\'', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(35, 'Fatir', 45, 'Mekah', 'Maha Pencipta', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(36, 'Yasin', 83, 'Mekah', 'Yasin', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(37, 'As-Saffat', 182, 'Mekah', 'Barisan-Barisan', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(38, 'Sad', 88, 'Mekah', 'Sad', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(39, 'Az-Zumar', 75, 'Mekah', 'Rombongan', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(40, 'Gafir', 85, 'Mekah', 'Maha Pengampun', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(41, 'Fussilat', 54, 'Mekah', 'Yang Dijelaskan', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(42, 'Asy-Syura', 53, 'Mekah', 'Musyawarah', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(43, 'Az-Zukhruf', 89, 'Mekah', 'Perhiasan', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(44, 'Ad-Dukhan', 59, 'Mekah', 'Kabut', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(45, 'Al-Jasiyah', 37, 'Mekah', 'Berlutut', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(46, 'Al-Ahqaf', 35, 'Mekah', 'Bukit Pasir', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(47, 'Muhammad', 38, 'Madinah', 'Muhammad', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(48, 'Al-Fath', 29, 'Madinah', 'Kemenangan', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(49, 'Al-Hujurat', 18, 'Madinah', 'Kamar-Kamar', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(50, 'Qaf', 45, 'Mekah', 'Qaf', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(51, 'Az-Zariyat', 60, 'Mekah', 'Angin yang Menerbangkan', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(52, 'At-Tur', 49, 'Mekah', 'Bukit Tursina', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(53, 'An-Najm', 62, 'Mekah', 'Bintang', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(54, 'Al-Qamar', 55, 'Mekah', 'Bulan', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(55, 'Ar-Rahman', 78, 'Madinah', 'Maha Pengasih', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(56, 'Al-Waqi\'ah', 96, 'Mekah', 'Hari Kiamat', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(57, 'Al-Hadid', 29, 'Madinah', 'Besi', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(58, 'Al-Mujadalah', 22, 'Madinah', 'Gugatan', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(59, 'Al-Hasyr', 24, 'Madinah', 'Pengusiran', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(60, 'Al-Mumtahanah', 13, 'Madinah', 'Wanita Yang Diuji', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(61, 'As-Saff', 14, 'Madinah', 'Barisan', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(62, 'Al-Jumu\'ah', 11, 'Madinah', 'Jumat', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(63, 'Al-Munafiqun', 11, 'Madinah', 'Orang-Orang Munafik', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(64, 'At-Tagabun', 18, 'Madinah', 'Pengungkapan Kesalahan', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(65, 'At-Talaq', 12, 'Madinah', 'Talak', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(66, 'At-Tahrim', 12, 'Madinah', 'Pengharaman', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(67, 'Al-Mulk', 30, 'Mekah', 'Kerajaan', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(68, 'Al-Qalam', 52, 'Mekah', 'Pena', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(69, 'Al-Haqqah', 52, 'Mekah', 'Hari Kiamat', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(70, 'Al-Ma\'arij', 44, 'Mekah', 'Tempat Naik', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(71, 'Nuh', 28, 'Mekah', 'Nuh', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(72, 'Al-Jinn', 28, 'Mekah', 'Jin', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(73, 'Al-Muzzammil', 20, 'Mekah', 'Orang Yang Berselimut', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(74, 'Al-Muddassir', 56, 'Mekah', 'Orang Yang Berkemul', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(75, 'Al-Qiyamah', 40, 'Mekah', 'Hari Kiamat', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(76, 'Al-Insan', 31, 'Madinah', 'Manusia', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(77, 'Al-Mursalat', 50, 'Mekah', 'Malaikat Yang Diutus', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(78, 'An-Naba\'', 40, 'Mekah', 'Berita Besar', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(79, 'An-Nazi\'at', 46, 'Mekah', 'Malaikat Yang Mencabut', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(80, '\'Abasa', 42, 'Mekah', 'Bermuka Masam', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(81, 'At-Takwir', 29, 'Mekah', 'Penggulungan', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(82, 'Al-Infitar', 19, 'Mekah', 'Terbelah', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(83, 'Al-Mutaffifin', 36, 'Mekah', 'Orang-Orang Curang', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(84, 'Al-Insyiqaq', 25, 'Mekah', 'Terbelah', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(85, 'Al-Buruj', 22, 'Mekah', 'Gugusan Bintang', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(86, 'At-Tariq', 17, 'Mekah', 'Yang Datang Di Malam Hari', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(87, 'Al-A\'la', 19, 'Mekah', 'Maha Tinggi', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(88, 'Al-Gasyiyah', 26, 'Mekah', 'Hari Kiamat', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(89, 'Al-Fajr', 30, 'Mekah', 'Fajar', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(90, 'Al-Balad', 20, 'Mekah', 'Negeri', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(91, 'Asy-Syams', 15, 'Mekah', 'Matahari', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(92, 'Al-Lail', 21, 'Mekah', 'Malam', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(93, 'Ad-Duha', 11, 'Mekah', 'Duha', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(94, 'Asy-Syarh', 8, 'Mekah', 'Lapang', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(95, 'At-Tin', 8, 'Mekah', 'Buah Tin', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(96, 'Al-\'Alaq', 19, 'Mekah', 'Segumpal Darah', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(97, 'Al-Qadr', 5, 'Mekah', 'Kemuliaan', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(98, 'Al-Bayyinah', 8, 'Madinah', 'Bukti Nyata', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(99, 'Az-Zalzalah', 8, 'Madinah', 'Guncangan', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(100, 'Al-\'Adiyat', 11, 'Mekah', 'Kuda Yang Berlari Kencang', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(101, 'Al-Qari\'ah', 11, 'Mekah', 'Hari Kiamat', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(102, 'At-Takasur', 8, 'Mekah', 'Bermegah-Megahan', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(103, 'Al-\'Asr', 3, 'Mekah', 'Asar', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(104, 'Al-Humazah', 9, 'Mekah', 'Pengumpat', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(105, 'Al-Fil', 5, 'Mekah', 'Gajah', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(106, 'Quraisy', 4, 'Mekah', 'Quraisy', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(107, 'Al-Ma\'un', 7, 'Mekah', 'Barang Yang Berguna', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(108, 'Al-Kausar', 3, 'Mekah', 'Pemberian Yang Banyak', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(109, 'Al-Kafirun', 6, 'Mekah', 'Orang-Orang kafir', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(110, 'An-Nasr', 3, 'Madinah', 'Pertolongan', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(111, 'Al-Lahab', 5, 'Mekah', 'Api Yang Bergejolak', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(112, 'Al-Ikhlas', 4, 'Mekah', 'Ikhlas', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(113, 'Al-Falaq', 5, 'Mekah', 'Subuh', '2023-12-17 01:26:46', '2023-12-17 01:26:46'),
(114, 'An-Nas', 6, 'Mekah', 'Manusia', '2023-12-17 01:26:46', '2023-12-17 01:26:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `id_tahun_ajaran` char(50) NOT NULL,
  `nama_tahun_ajaran` varchar(255) NOT NULL,
  `status_tahun_ajaran` int NOT NULL,
  `id_user` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`id_tahun_ajaran`, `nama_tahun_ajaran`, `status_tahun_ajaran`, `id_user`, `created_at`, `updated_at`, `deleted_at`) VALUES
('TA-190724-1', '2023/2024', 0, 10, '2024-07-19 01:32:25', '2024-07-19 16:26:39', NULL),
('TA-190724-2', '2022/2023', 1, 10, '2024-07-19 16:04:36', '2024-07-22 03:13:13', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_user` int NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `email_verified_at`, `password`, `nama_user`, `no_hp_user`, `alamat_user`, `level_user`, `status_user`, `remember_token`, `created_at`, `updated_at`) VALUES
(5, 'jakfarshodiq2302@gmail.com', NULL, '$2y$12$zKvlsdFfi00N3Kuze72xXOt9/Nlx1NGpsmH4BnV1C0mnedDrmE6nO', 'as', '123456789012', 'as', '2', 0, NULL, '2024-07-18 15:52:54', '2024-07-18 15:59:03'),
(10, 'jakfarshodiq230@gmail.com', '2024-07-18 23:59:50', '$2y$12$Mjm0lP/mogxrqHh8BKR67.ROV7/FM6d1Quin9GEpxUSlUz5SsvJhC', 'as', '123456789012', 'as', '2', 1, NULL, '2024-07-18 11:21:18', '2024-08-10 00:10:56');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`nik_guru`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `kop`
--
ALTER TABLE `kop`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `log_login`
--
ALTER TABLE `log_login`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mail_settings`
--
ALTER TABLE `mail_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `penilaian_kegiatan`
--
ALTER TABLE `penilaian_kegiatan`
  ADD PRIMARY KEY (`id_penilaian_kegiatan`);

--
-- Indeks untuk tabel `penilaian_sertifikasi`
--
ALTER TABLE `penilaian_sertifikasi`
  ADD PRIMARY KEY (`id_penilaian_sertifikasi`);

--
-- Indeks untuk tabel `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id_periode`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `peserta_kegiatan`
--
ALTER TABLE `peserta_kegiatan`
  ADD PRIMARY KEY (`id_peserta_kegiatan`);

--
-- Indeks untuk tabel `peserta_sertifikasi`
--
ALTER TABLE `peserta_sertifikasi`
  ADD PRIMARY KEY (`id_peserta_sertifikasi`);

--
-- Indeks untuk tabel `rapor_kegiatan`
--
ALTER TABLE `rapor_kegiatan`
  ADD PRIMARY KEY (`id_rapor`);

--
-- Indeks untuk tabel `rapor_pengembangan_diri`
--
ALTER TABLE `rapor_pengembangan_diri`
  ADD PRIMARY KEY (`id_pengembangan_diri`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nisn_siswa`);

--
-- Indeks untuk tabel `sm_penilaian_kegiatan`
--
ALTER TABLE `sm_penilaian_kegiatan`
  ADD PRIMARY KEY (`id_penilaian_kegiatan`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kop`
--
ALTER TABLE `kop`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `log_login`
--
ALTER TABLE `log_login`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT untuk tabel `mail_settings`
--
ALTER TABLE `mail_settings`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
