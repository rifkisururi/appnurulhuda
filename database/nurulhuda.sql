-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2021 at 02:26 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nurulhuda`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(53, '2014_10_12_000000_create_users_table', 1),
(54, '2014_10_12_100000_create_password_resets_table', 1),
(55, '2019_08_19_000000_create_failed_jobs_table', 1),
(56, '2021_04_27_153724_tagihan_master', 1),
(57, '2021_04_27_160154_tagihan_detail', 1),
(58, '2021_05_07_113522_create_permission_tables', 1),
(59, '2021_05_29_162936_sp_tagihan_rekap_tahunan', 1),
(60, '2021_06_03_134656_yayasan', 1),
(61, '2021_07_10_145520_create_jobs_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2021-06-07 09:34:51', '2021-06-07 09:34:51'),
(2, 'bendahara', 'web', '2021-06-07 09:34:51', '2021-06-07 09:34:51'),
(3, 'santri', 'web', '2021-06-07 09:34:51', '2021-06-07 09:34:51');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tagihan_detail`
--

CREATE TABLE `tagihan_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_tagihan_master` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `jatuh_tempo` date NOT NULL,
  `id_user_confirm` int(11) NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `flag_pay` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tagihan_detail`
--

INSERT INTO `tagihan_detail` (`id`, `id_user`, `id_tagihan_master`, `jumlah`, `jatuh_tempo`, `id_user_confirm`, `tanggal_bayar`, `flag_pay`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 2, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:17', '2021-08-01 06:41:17'),
(2, 3, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:17', '2021-08-01 06:41:17'),
(3, 4, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:17', '2021-08-01 06:41:17'),
(4, 5, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:17', '2021-08-01 06:41:17'),
(5, 6, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:17', '2021-08-01 06:41:17'),
(6, 7, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:17', '2021-08-01 06:41:17'),
(7, 8, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:17', '2021-08-01 06:41:17'),
(8, 9, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:17', '2021-08-01 06:41:17'),
(9, 10, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:17', '2021-08-01 06:41:17'),
(10, 11, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:17', '2021-08-01 06:41:17'),
(11, 12, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:17', '2021-08-01 06:41:17'),
(12, 13, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:17', '2021-08-01 06:41:17'),
(13, 14, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:17', '2021-08-01 06:41:17'),
(14, 15, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:17', '2021-08-01 06:41:17'),
(15, 16, 3, 10000, '2021-08-10', 0, '2021-08-01', 1, 0, '2021-08-01 06:41:17', '2021-08-01 06:42:14'),
(16, 17, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:17', '2021-08-01 06:41:17'),
(17, 18, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:17', '2021-08-01 06:41:17'),
(18, 19, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:17', '2021-08-01 06:41:17'),
(19, 20, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:17', '2021-08-01 06:41:17'),
(20, 21, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:17', '2021-08-01 06:41:17'),
(21, 22, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:17', '2021-08-01 06:41:17'),
(22, 23, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:17', '2021-08-01 06:41:17'),
(23, 24, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:17', '2021-08-01 06:41:17'),
(24, 25, 3, 10000, '2021-08-10', 0, '2021-08-01', 1, 0, '2021-08-01 06:41:17', '2021-08-01 08:03:29'),
(25, 26, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:17', '2021-08-01 06:41:17'),
(26, 27, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:17', '2021-08-01 06:41:17'),
(27, 28, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:17', '2021-08-01 06:41:17'),
(28, 29, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:17', '2021-08-01 06:41:17'),
(29, 30, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:17', '2021-08-01 06:41:17'),
(30, 31, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:17', '2021-08-01 06:41:17'),
(31, 32, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:17', '2021-08-01 06:41:17'),
(32, 33, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:17', '2021-08-01 06:41:17'),
(33, 34, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(34, 35, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(35, 36, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(36, 37, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(37, 38, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(38, 39, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(39, 40, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(40, 41, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(41, 42, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(42, 43, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(43, 44, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(44, 45, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(45, 46, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(46, 47, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(47, 48, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(48, 49, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(49, 50, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(50, 51, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(51, 52, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(52, 53, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(53, 54, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(54, 55, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(55, 56, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(56, 57, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(57, 58, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(58, 59, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(59, 60, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(60, 61, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(61, 62, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(62, 63, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(63, 64, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(64, 65, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(65, 66, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(66, 67, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(67, 68, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(68, 69, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(69, 70, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(70, 71, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(71, 72, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(72, 73, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(73, 74, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(74, 75, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(75, 76, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(76, 77, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(77, 78, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(78, 79, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(79, 80, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(80, 81, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(81, 82, 3, 10000, '2021-08-10', 0, '2021-08-01', 1, 0, '2021-08-01 06:41:18', '2021-08-01 08:03:57'),
(82, 83, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(83, 84, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(84, 85, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18'),
(85, 86, 3, 10000, '2021-08-10', 0, '2021-01-01', 0, 0, '2021-08-01 06:41:18', '2021-08-01 06:41:18');

-- --------------------------------------------------------

--
-- Table structure for table `tagihan_master`
--

CREATE TABLE `tagihan_master` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tagihan_master`
--

INSERT INTO `tagihan_master` (`id`, `name`, `keterangan`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 'Syahriyyah Madin', '', 20000, '2021-06-07 09:34:51', '2021-06-07 09:34:51'),
(2, 'Pajek', 'Pajek', 150000, '2021-06-07 09:34:51', '2021-06-07 09:34:51'),
(3, 'Syahriah TPQ', 'Syahriah TPQ', 10000, '2021-07-01 09:02:04', '2021-07-01 09:02:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_yayasan` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `no_hp1`, `no_hp2`, `email_verified_at`, `password`, `id_yayasan`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@mailnesia.com', '6285647451640', '62895401665951', '2021-06-07 09:34:51', '$2y$10$zopbCx0D4eSBcOvTYtdM8OTBatRKxbdTyDf.P6jMV703h7wrpyqty', 1, NULL, '2021-06-07 09:34:51', '2021-08-01 06:20:45'),
(2, 'Adnan Mirza Ardani', NULL, '6287822867330', '0', NULL, '', 2, NULL, NULL, '2021-07-01 07:29:58'),
(3, 'Ahmad Haidar', NULL, '0', '0', NULL, '', 2, NULL, NULL, NULL),
(4, 'Aqila Zahrotun Nafisa', NULL, '0', '0', NULL, '', 2, NULL, NULL, NULL),
(5, 'Danish Nabil Akhdan', NULL, '0', '0', NULL, '', 2, NULL, NULL, NULL),
(6, 'Hilga Latifah', NULL, '0', '0', NULL, '', 2, NULL, NULL, NULL),
(7, 'Naili Nafisatul Mahmudah', NULL, '0', '0', NULL, '', 2, NULL, NULL, NULL),
(8, 'Nana Nadia Nadilo', NULL, '0', '0', NULL, '', 2, NULL, NULL, NULL),
(9, 'Siti Fatimah Az-Zahra', NULL, '0', '0', NULL, '', 2, NULL, NULL, NULL),
(10, 'Anggun Setiyaning T.', NULL, '6283136159011', NULL, NULL, '', 2, NULL, NULL, '2021-07-01 07:31:12'),
(11, 'Gina Alfatunnisa', NULL, '6281228582631', '0', NULL, '', 2, NULL, NULL, NULL),
(12, 'Halisa Amalia', NULL, '6285943443868', '0', NULL, '', 2, NULL, NULL, NULL),
(13, 'Iklilia Kayyisa', NULL, '0', '0', NULL, '', 2, NULL, NULL, NULL),
(14, 'Nabilla Adelia Hanifah', NULL, '0', '0', NULL, '', 2, NULL, NULL, NULL),
(15, 'Nayla Lufia Hanna', NULL, '6283862954657', '0', NULL, '', 2, NULL, NULL, NULL),
(16, 'Nayya Kurniawati', NULL, '6283101567749', '0', NULL, '', 2, NULL, NULL, NULL),
(17, 'Raihanum', NULL, '6285225091110', '0', NULL, '', 2, NULL, NULL, NULL),
(18, 'Siska Zulaikhah', NULL, '6283867940978', '0', NULL, '', 2, NULL, NULL, NULL),
(19, 'Tahtadu khoiril Anam', NULL, '6283108218910', '0', NULL, '', 2, NULL, NULL, NULL),
(20, 'Talita Dewi', NULL, '0', '0', NULL, '', 2, NULL, NULL, NULL),
(21, 'Tausiya Syauqiya', NULL, '6283842124928', '0', NULL, '', 2, NULL, NULL, NULL),
(22, 'Vita Bilqis Auliya ', NULL, '6283162113996', '0', NULL, '', 2, NULL, NULL, NULL),
(23, 'Widia Ningsih Murthi A.', NULL, '0', '0', NULL, '', 2, NULL, NULL, NULL),
(24, 'Hananiya  Kamalia Husna', NULL, '6281915445084', '6283867467056', NULL, '', 2, NULL, NULL, NULL),
(25, 'Ahmad Ramadhani', NULL, '6282135829258', '0', NULL, '', 2, NULL, NULL, '2021-07-01 07:30:11'),
(26, 'Almaira Syifa', NULL, '6283862267362', NULL, NULL, '', 2, NULL, NULL, '2021-07-01 07:30:57'),
(27, 'Faat abdul M.', NULL, '0', '0', NULL, '', 2, NULL, NULL, NULL),
(28, 'Kaka Ardiansyah', NULL, '6283112888676', '0', NULL, '', 2, NULL, NULL, NULL),
(29, 'Layinatu Rifqia', NULL, '6285311678922', '0', NULL, '', 2, NULL, NULL, NULL),
(30, 'M.Akmal Wildan', NULL, '0', '0', NULL, '', 2, NULL, NULL, NULL),
(31, 'Najwa Nur Azizah', NULL, '6287736395230', '0', NULL, '', 2, NULL, NULL, NULL),
(32, 'Raisa Sabna Isnani', NULL, '6285328725578', '0', NULL, '', 2, NULL, NULL, NULL),
(33, 'Rasta Aditiya', NULL, '6283145741438', '0', NULL, '', 2, NULL, NULL, NULL),
(34, 'Syakila Sellin Kurnia Sari', NULL, '6287771735860', '0', NULL, '', 2, NULL, NULL, NULL),
(35, 'Syifaul Jannah', NULL, '0', '0', NULL, '', 2, NULL, NULL, NULL),
(36, 'Ulumudin', NULL, '0', '0', NULL, '', 2, NULL, NULL, NULL),
(37, 'Zaki Alfa Rizal', NULL, '0', '0', NULL, '', 2, NULL, NULL, NULL),
(38, 'Andi Zakaria', NULL, '0', '0', NULL, '', 2, NULL, NULL, NULL),
(39, 'Dina Cahyaningrum', NULL, '6283844369091', '0', NULL, '', 2, NULL, NULL, '2021-07-01 07:33:34'),
(40, 'Efriza S.Zahra', NULL, '6285729862536', '0', NULL, '', 2, NULL, NULL, '2021-07-01 07:34:35'),
(41, 'Fatkhurohman', NULL, '0', '0', NULL, '', 2, NULL, NULL, NULL),
(42, 'Fifiana Putri', NULL, '6283145020024', '0', NULL, '', 2, NULL, NULL, NULL),
(43, 'Firman Nasuha', NULL, '6283150763484', '0', NULL, '', 2, NULL, NULL, '2021-07-01 07:38:49'),
(44, 'Ilham Muhammad', NULL, '0', '0', NULL, '', 2, NULL, NULL, NULL),
(45, 'Ita Naura Zakia', NULL, '0', '0', NULL, '', 2, NULL, NULL, NULL),
(46, 'Khoirun Nasirin', NULL, '6283840354534', '0', NULL, '', 2, NULL, NULL, NULL),
(47, 'Nabila Lutfiana K.', NULL, '6283820104082', '0', NULL, '', 2, NULL, NULL, NULL),
(48, 'Riski Rahmawati', NULL, '6283102984936', '0', NULL, '', 2, NULL, NULL, NULL),
(49, 'Salwa Fatihunnada', NULL, '6287700266345', '0', NULL, '', 2, NULL, NULL, NULL),
(50, 'Wildan Zaki Ahmada', NULL, '6287816311774', '0', NULL, '', 2, NULL, NULL, NULL),
(51, 'Zeni Puspita Sari', NULL, '6285228039961', '0', NULL, '', 2, NULL, NULL, NULL),
(52, 'Achmad Lukman H.', NULL, '0', '0', NULL, '', 2, NULL, NULL, NULL),
(53, 'Alfin Ahmad Alfaqih', NULL, '6285712157526', '6282227748267', NULL, '', 2, NULL, NULL, '2021-07-01 07:30:33'),
(54, 'Bayu Ardiansyah', NULL, '0', '0', NULL, '', 2, NULL, NULL, NULL),
(55, 'Catur Nur Rizqi', NULL, '0', '0', NULL, '', 2, NULL, NULL, NULL),
(56, 'Dila Nurul Halimah', NULL, '6283838486171', '0', NULL, '', 2, NULL, NULL, '2021-07-01 07:33:22'),
(57, 'Ernin Herawati', NULL, '62895336199725', '0', NULL, '', 2, NULL, NULL, '2021-07-01 07:35:45'),
(58, 'Fadli Rabi Fazani', NULL, '0', '0', NULL, '', 2, NULL, NULL, NULL),
(59, 'Ikhsanudin', NULL, '0', '0', NULL, '', 2, NULL, NULL, NULL),
(60, 'Iqbal Widiansyah', NULL, '6281804116467', '0', NULL, '', 2, NULL, NULL, NULL),
(61, 'M. Fuad Hasyim', NULL, '0', '0', NULL, '', 2, NULL, NULL, NULL),
(62, 'M.Rifai', NULL, '6283844369102', '0', NULL, '', 2, NULL, NULL, NULL),
(63, 'Raditia', NULL, '628988990922', '0', NULL, '', 2, NULL, NULL, NULL),
(64, 'Rendi', NULL, '0', '0', NULL, '', 2, NULL, NULL, NULL),
(65, 'Resa Amelia Anna', NULL, '6281281728518', '0', NULL, '', 2, NULL, NULL, NULL),
(66, 'Satria Dirga Permana', NULL, '6283116312940', '0', NULL, '', 2, NULL, NULL, NULL),
(67, 'Seno Nuki Solifin', NULL, '0', '0', NULL, '', 2, NULL, NULL, NULL),
(68, 'Sintia Aulia Sari', NULL, '6287832088364', '0', NULL, '', 2, NULL, NULL, NULL),
(69, 'Tsani Fiki Azizah', NULL, '0', '0', NULL, '', 2, NULL, NULL, NULL),
(70, 'Zuhdan Maimun', NULL, '0', '0', NULL, '', 2, NULL, NULL, NULL),
(71, 'Abdul Haris', NULL, '6285327578072', NULL, NULL, '', 2, NULL, NULL, '2021-07-01 07:35:22'),
(72, 'Aura Rahma Dini', NULL, '0', '0', NULL, '', 2, NULL, NULL, NULL),
(73, 'Dea Khalimatu S.', NULL, '6283146620508', '0', NULL, '', 2, NULL, NULL, '2021-07-01 07:31:30'),
(74, 'Deysta Tri Ananda', NULL, '6283839598167', '0', NULL, '', 2, NULL, NULL, '2021-07-01 07:32:20'),
(75, 'Diki M.Y.Khair', NULL, '6283867940978', '0', NULL, '', 2, NULL, NULL, '2021-07-01 07:33:08'),
(76, 'Fajrina Oktavia Azzahra', NULL, '6283151769604', '0', NULL, '', 2, NULL, NULL, NULL),
(77, 'Faqih Faizun Zaini', NULL, '6283107772795', '0', NULL, '', 2, NULL, NULL, NULL),
(78, 'Febiana Nabila P.', NULL, '0', '0', NULL, '', 2, NULL, NULL, NULL),
(79, 'Hilda Salsabila', NULL, '0', '0', NULL, '', 2, NULL, NULL, NULL),
(80, 'Irurroziqin', NULL, '0', '0', NULL, '', 2, NULL, NULL, NULL),
(81, 'M. Alifia Anjani', NULL, '6285225091110', '0', NULL, '', 2, NULL, NULL, NULL),
(82, 'Milatina Alya Zuhrofa', NULL, '6282135829258', '0', NULL, '', 2, NULL, NULL, NULL),
(83, 'Tanzela Medina H.', NULL, '6287894186538', '0', NULL, '', 2, NULL, NULL, NULL),
(84, 'Ummi F. Zahra', NULL, '6285725909500', '0', NULL, '', 2, NULL, NULL, NULL),
(85, 'Zahri Rafi Irham', NULL, '62859126496739', '0', NULL, '', 2, NULL, NULL, NULL),
(86, 'Zidan Nur Falah', NULL, '', '0', NULL, '', 2, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `yayasan`
--

CREATE TABLE `yayasan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `yayasan`
--

INSERT INTO `yayasan` (`id`, `nama`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Pondok Pesantren', 1, '2021-06-07 09:34:51', '2021-06-07 09:34:51'),
(2, 'TPQ', 1, '2021-06-07 09:34:51', '2021-06-07 09:34:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `tagihan_detail`
--
ALTER TABLE `tagihan_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tagihan_master`
--
ALTER TABLE `tagihan_master`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tagihan_master_keterangan_unique` (`keterangan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yayasan`
--
ALTER TABLE `yayasan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tagihan_detail`
--
ALTER TABLE `tagihan_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `tagihan_master`
--
ALTER TABLE `tagihan_master`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `yayasan`
--
ALTER TABLE `yayasan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
