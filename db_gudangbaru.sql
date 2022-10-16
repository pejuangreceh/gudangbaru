-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2022 at 08:06 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_gudangbaru`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_code`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'SPDHP-001', 'Sepatu PDH PRIA', NULL, '2022-06-17 11:04:07'),
(2, 'SPDHW-001', 'Sepatu PDH WANITA', '2022-06-18 03:13:56', '2022-06-18 03:13:56'),
(3, 'SPDLP-001', 'Sepatu PDL', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_code`, `customer_name`, `created_at`, `updated_at`) VALUES
(1, 'C001', 'Shopee', '2022-06-16 22:29:19', '2022-06-16 22:29:19');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `unit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sku_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int(11) NOT NULL,
  `buying_price` int(11) NOT NULL DEFAULT 0,
  `selling_price` int(11) DEFAULT 0,
  `used` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `newest_lead_time` float NOT NULL,
  `newest_order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item_code`, `item_name`, `item_category_id`, `unit_id`, `sku_number`, `stok`, `buying_price`, `selling_price`, `used`, `created_at`, `updated_at`, `newest_lead_time`, `newest_order_id`) VALUES
(1, 'PDL NINJA 1-41', 'PDL NINJA 1 Uk. 41', 3, 3, 'PDL NINJA 1-41', 0, 90000, 150000, 1, NULL, '2022-10-13 17:44:32', 4, 13),
(2, 'PDL NINJA 1-43', 'PDL NINJA 1 Uk. 43', 3, 3, 'PDL NINJA 1-43', 6, 100000, 150000, 1, NULL, NULL, 3, 17),
(3, 'PDL NINJA 2-41', 'PDL NINJA 2 Uk. 41', 3, 3, 'PDL NINJA 2-41', 6, 100000, 150000, 1, NULL, NULL, 1, 15),
(4, 'PDL NINJA 2-42', 'PDL NINJA 2 Uk. 42', 3, 3, 'PDL NINJA 2-42', 9, 100000, 150000, 1, NULL, NULL, 0, 9),
(5, 'SUSR04 5cm-39', 'PDH SUS 04 5cm Uk. 39', 2, 3, 'SUSR04 5cm-39', 13, 100000, 150000, 1, NULL, NULL, 11, 14),
(6, 'SUSR04 5cm-41', 'PDH SUS 04 5cm Uk. 41', 2, 3, 'SUSR04 5cm-41', 10, 100000, 150000, 1, NULL, NULL, 5, 16);

--
-- Triggers `items`
--
DELIMITER $$
CREATE TRIGGER `used_updated` AFTER UPDATE ON `items` FOR EACH ROW BEGIN 
IF ((NEW.stok > 0) AND (NEW.used = FALSE) ) THEN
UPDATE items SET NEW.used = TRUE;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `item_in_tb`
--

CREATE TABLE `item_in_tb` (
  `id` int(11) NOT NULL,
  `transaction_code` varchar(255) NOT NULL,
  `item_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `item_total` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `parent_code` varchar(30) NOT NULL,
  `in_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lead_time` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_in_tb`
--

INSERT INTO `item_in_tb` (`id`, `transaction_code`, `item_id`, `supplier_id`, `warehouse_id`, `item_total`, `total_price`, `order_id`, `parent_code`, `in_date`, `created_at`, `updated_at`, `lead_time`) VALUES
(7, 'P00002', 6, 1, 1, 8, 800000, 7, 'P00001', '2022-10-16 15:15:03', '2022-09-17 14:04:05', '2022-09-17 14:04:05', 0),
(8, 'P00002', 5, 1, 1, 10, 1000000, 8, 'P00001', '2022-10-16 15:15:03', '2022-09-17 14:04:05', '2022-09-17 14:04:05', 0),
(9, 'P00002', 4, 1, 1, 9, 900000, 9, 'P00001', '2022-10-16 15:15:03', '2022-09-17 14:04:05', '2022-09-17 14:04:05', 0),
(10, 'P00002', 3, 1, 1, 5, 500000, 10, 'P00001', '2022-10-16 15:15:03', '2022-09-17 14:04:05', '2022-09-17 14:04:05', 0),
(11, 'P00002', 2, 1, 1, 10, 1000000, 11, 'P00001', '2022-10-16 15:15:03', '2022-09-17 14:04:05', '2022-09-17 14:04:05', 0),
(12, 'P00002', 1, 1, 1, 5, 500000, 12, 'P00001', '2022-10-16 15:15:03', '2022-09-17 14:04:05', '2022-09-17 14:04:05', 0),
(13, 'P00009', 1, 1, 1, 8, 800000, 13, 'P00008', '2022-10-16 15:15:03', '2022-09-28 14:35:58', '2022-09-28 14:35:58', 7),
(14, 'P00016', 5, 3, 1, 3, 300000, 14, 'P00015', NULL, '2022-10-16 16:05:55', '2022-10-16 16:05:55', 10),
(15, 'P00016', 3, 3, 1, 1, 100000, 15, 'P00015', NULL, '2022-10-16 16:05:55', '2022-10-16 16:05:55', 4),
(16, 'P00018', 6, 1, 1, 2, 200000, 16, 'P00017', '2022-10-14 17:00:00', '2022-10-16 16:13:54', '2022-10-16 16:13:54', 6),
(17, 'P00018', 2, 1, 1, 6, 600000, 17, 'P00017', '2022-10-07 17:00:00', '2022-10-16 16:13:54', '2022-10-16 16:13:54', 11);

--
-- Triggers `item_in_tb`
--
DELIMITER $$
CREATE TRIGGER `insert_item_in` AFTER INSERT ON `item_in_tb` FOR EACH ROW BEGIN 
UPDATE items SET stok = stok + NEW.item_total WHERE id = NEW.item_id;
UPDATE order_tb SET sisa_stok = sisa_stok - NEW.item_total WHERE id = NEW.order_id;
UPDATE transactions SET total_stok = total_stok -  NEW.item_total WHERE transaction_code = NEW.parent_code;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `item_out_tb`
--

CREATE TABLE `item_out_tb` (
  `id` int(11) NOT NULL,
  `transaction_code` varchar(255) NOT NULL,
  `item_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `item_total` int(11) NOT NULL,
  `selling_price` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `out_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_out_tb`
--

INSERT INTO `item_out_tb` (`id`, `transaction_code`, `item_id`, `customer_id`, `warehouse_id`, `item_total`, `selling_price`, `total_price`, `status`, `out_date`, `created_at`, `updated_at`) VALUES
(8, 'P00003', 1, 1, 1, 1, 150000, 150000, 'accepted', NULL, '2022-09-17 14:10:02', '2022-09-17 14:10:45'),
(9, 'P00004', 1, 1, 1, 1, 150000, 150000, 'accepted', NULL, '2022-09-18 14:20:29', '2022-09-18 14:22:01'),
(10, 'P00005', 1, 1, 1, 1, 150000, 150000, 'accepted', NULL, '2022-09-19 14:20:37', '2022-09-19 14:21:56'),
(11, 'P00006', 1, 1, 1, 1, 150000, 150000, 'accepted', NULL, '2022-09-20 14:20:43', '2022-09-20 14:21:52'),
(12, 'P00007', 1, 1, 1, 1, 150000, 150000, 'accepted', NULL, '2022-09-21 14:21:00', '2022-09-21 14:21:47'),
(13, 'P00010', 1, 1, 1, 2, 150000, 300000, 'accepted', NULL, '2022-09-10 14:38:31', '2022-09-10 14:40:16'),
(14, 'P00011', 1, 1, 1, 1, 150000, 150000, 'accepted', NULL, '2022-09-10 14:39:16', '2022-09-10 14:40:21'),
(15, 'P00012', 1, 1, 1, 1, 150000, 150000, 'accepted', NULL, '2022-09-10 14:39:22', '2022-09-10 14:40:27'),
(16, 'P00013', 1, 1, 1, 1, 150000, 150000, 'accepted', NULL, '2022-09-10 14:39:31', '2022-09-10 14:40:32'),
(17, 'P00014', 1, 1, 1, 3, 150000, 450000, 'accepted', NULL, '2022-09-10 14:39:47', '2022-09-10 14:40:37'),
(18, 'P00019', 2, 1, 1, 10, 150000, 1500000, 'pending', '2022-10-20 17:00:00', '2022-10-16 16:52:25', '2022-10-16 16:52:25');

--
-- Triggers `item_out_tb`
--
DELIMITER $$
CREATE TRIGGER `accept_item_out` AFTER UPDATE ON `item_out_tb` FOR EACH ROW BEGIN 
IF (NEW.status = 'rejected') THEN
UPDATE items SET stok = stok + NEW.item_total WHERE id = NEW.item_id;
END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_item_out` AFTER INSERT ON `item_out_tb` FOR EACH ROW BEGIN 
UPDATE items SET stok = stok - NEW.item_total WHERE id = NEW.item_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `order_tb`
--

CREATE TABLE `order_tb` (
  `id` int(11) NOT NULL,
  `transaction_code` varchar(20) NOT NULL,
  `item_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `item_total` int(11) NOT NULL,
  `buying_price` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `sisa_stok` int(11) NOT NULL,
  `order_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_tb`
--

INSERT INTO `order_tb` (`id`, `transaction_code`, `item_id`, `supplier_id`, `item_total`, `buying_price`, `total_price`, `status`, `sisa_stok`, `order_date`, `created_at`, `updated_at`) VALUES
(7, 'P00001', 6, 1, 8, 100000, 800000, 'accepted', 0, '2022-10-16 15:12:32', '2022-09-10 14:01:30', '2022-09-10 14:01:51'),
(8, 'P00001', 5, 1, 10, 100000, 1000000, 'accepted', 0, '2022-10-16 15:12:32', '2022-09-10 14:01:30', '2022-09-10 14:01:51'),
(9, 'P00001', 4, 1, 9, 100000, 900000, 'accepted', 0, '2022-10-16 15:12:32', '2022-09-10 14:01:30', '2022-09-10 14:01:51'),
(10, 'P00001', 3, 1, 5, 100000, 500000, 'accepted', 0, '2022-10-16 15:12:32', '2022-09-10 14:01:30', '2022-09-10 14:01:51'),
(11, 'P00001', 2, 1, 10, 100000, 1000000, 'accepted', 0, '2022-10-16 15:12:32', '2022-09-10 14:01:30', '2022-09-10 14:01:51'),
(12, 'P00001', 1, 1, 5, 100000, 500000, 'accepted', 0, '2022-10-16 15:12:32', '2022-09-10 14:01:30', '2022-09-10 14:01:51'),
(13, 'P00008', 1, 1, 8, 100000, 800000, 'accepted', 0, '2022-10-16 15:12:32', '2022-09-03 14:31:32', '2022-09-24 14:32:01'),
(14, 'P00015', 5, 3, 3, 100000, 300000, 'accepted', 0, '2022-10-05 17:00:00', '2022-10-16 15:37:57', '2022-10-16 15:46:43'),
(15, 'P00015', 3, 3, 1, 100000, 100000, 'accepted', 0, '2022-10-11 17:00:00', '2022-10-16 15:37:57', '2022-10-16 15:46:43'),
(16, 'P00017', 6, 1, 2, 100000, 200000, 'accepted', 0, '2022-10-09 17:00:00', '2022-10-16 16:07:53', '2022-10-16 16:10:19'),
(17, 'P00017', 2, 1, 6, 100000, 600000, 'accepted', 0, '2022-10-04 17:00:00', '2022-10-16 16:07:53', '2022-10-16 16:10:19');

--
-- Triggers `order_tb`
--
DELIMITER $$
CREATE TRIGGER `used_items` AFTER INSERT ON `order_tb` FOR EACH ROW BEGIN
UPDATE items SET used = 1 WHERE id = NEW.item_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier_code`, `supplier_name`, `address`, `created_at`, `updated_at`) VALUES
(1, 'SUP001', 'UD. K.A.E', 'Mojokerto', '2022-03-03 05:04:02', '2022-03-03 05:04:02'),
(3, 'SUP002', 'UD. NOTO JOYO', 'Mojokerto', '2022-06-17 11:00:05', '2022-06-17 11:00:15');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `transaction_code` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `parent_code` varchar(20) NOT NULL,
  `total_stok` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transaction_code`, `type`, `supplier_id`, `warehouse_id`, `customer_id`, `status`, `description`, `parent_code`, `total_stok`, `created_at`, `updated_at`) VALUES
(10, 'P00001', 'order', 1, 0, 0, 'done', 'Sudah sesuai', '', 0, '2022-09-10 14:01:30', '2022-09-10 14:01:51'),
(11, 'P00002', 'in', 1, 1, 0, 'stok_in', '', 'P00001', 0, '2022-09-17 14:04:05', '2022-09-17 14:04:05'),
(12, 'P00003', 'out', 0, 1, 1, 'accepted', 'Sudah sesuai', '', 0, '2022-09-17 14:10:02', '2022-09-17 14:10:45'),
(13, 'P00004', 'out', 0, 1, 1, 'accepted', 'Sudah sesuai', '', 0, '2022-09-18 14:20:29', '2022-09-10 14:22:01'),
(14, 'P00005', 'out', 0, 1, 1, 'accepted', 'Sudah sesuai', '', 0, '2022-09-19 14:20:37', '2022-09-19 14:21:56'),
(15, 'P00006', 'out', 0, 1, 1, 'accepted', 'Sudah sesuai', '', 0, '2022-09-20 14:20:43', '2022-09-21 14:21:52'),
(16, 'P00007', 'out', 0, 1, 1, 'accepted', 'Sudah sesuai', '', 0, '2022-09-22 14:21:00', '2022-09-22 14:21:47'),
(17, 'P00008', 'order', 1, 0, 0, 'done', 'Sudah sesuai', '', 0, '2022-09-24 14:31:32', '2022-09-24 14:32:01'),
(18, 'P00009', 'in', 1, 1, 0, 'stok_in', '', 'P00008', 0, '2022-09-28 14:35:58', '2022-09-28 14:35:58'),
(19, 'P00010', 'out', 0, 1, 1, 'accepted', 'Sudah sesuai', '', 0, '2022-09-10 14:38:31', '2022-09-10 14:40:16'),
(20, 'P00011', 'out', 0, 1, 1, 'accepted', 'Sudah sesuai', '', 0, '2022-09-10 14:39:16', '2022-09-10 14:40:21'),
(21, 'P00012', 'out', 0, 1, 1, 'accepted', 'Sudah sesuai', '', 0, '2022-09-10 14:39:22', '2022-09-10 14:40:27'),
(22, 'P00013', 'out', 0, 1, 1, 'accepted', 'Sudah sesuai', '', 0, '2022-09-10 14:39:31', '2022-09-10 14:40:32'),
(23, 'P00014', 'out', 0, 1, 1, 'accepted', 'Sudah sesuai', '', 0, '2022-09-10 14:39:47', '2022-09-10 14:40:37'),
(24, 'P00015', 'order', 3, 0, 0, 'done', 'ini sudah disetujui', '', 0, '2022-10-16 15:37:57', '2022-10-16 15:46:43'),
(25, 'P00016', 'in', 3, 1, 0, 'stok_in', '', 'P00015', 0, '2022-10-16 16:05:55', '2022-10-16 16:05:55'),
(26, 'P00017', 'order', 1, 0, 0, 'done', '', '', 0, '2022-10-16 16:07:53', '2022-10-16 16:10:19'),
(27, 'P00018', 'in', 1, 1, 0, 'stok_in', '', 'P00017', 0, '2022-10-16 16:13:54', '2022-10-16 16:13:54'),
(28, 'P00019', 'out', 0, 1, 1, 'pending', '', '', 0, '2022-10-16 16:52:25', '2022-10-16 16:52:25');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `unit_code`, `unit_name`, `created_at`, `updated_at`) VALUES
(1, 'Pcs', 'Pieces', NULL, '2022-03-24 12:09:02'),
(3, 'PSG', 'Pasang', '2022-06-02 08:04:22', '2022-06-02 08:04:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `role_id` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nik`, `name`, `username`, `email`, `password`, `address`, `phone_number`, `gender`, `role_id`, `created_at`, `updated_at`) VALUES
(3, '123456', 'Owner Utama', 'owner', 'owner@gmail.com', '123456', 'Pandan Landung', '082135265021', 'Laki-laki', 'owner', '2022-06-19 10:43:31', '2022-06-19 10:45:23'),
(4, '1234544', 'Admin Default', 'admin', 'yohanaadella@gmail.com', '123456', 'Sawojajar', '089187263882', 'Perempuan', 'admin', '2022-06-19 10:44:30', '2022-06-19 10:44:30'),
(6, '123123', 'Gudang', 'gudang', 'prima@gmail.com', '123456', 'sawojawajar', '01239817322', 'Perempuan', 'gudang', '2022-06-29 23:03:23', '2022-06-29 23:03:23'),
(7, '12930132', 'Admin2', 'admin2', 'elloyyabest@gmail.com', '123456', 'pandan', '081238132123', 'Laki-laki', 'admin', '2022-06-30 10:27:39', '2022-06-30 10:27:39');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warehouse_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `warehouse_code`, `warehouse_name`, `created_at`, `updated_at`) VALUES
(1, 'gdng1', 'Gudang1', '2022-02-01 14:26:14', '2022-02-01 14:26:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `items_item_code_unique` (`item_code`),
  ADD UNIQUE KEY `items_sku_number_unique` (`sku_number`),
  ADD KEY `items_item_category_id_foreign` (`item_category_id`),
  ADD KEY `items_unit_id_foreign` (`unit_id`);

--
-- Indexes for table `item_in_tb`
--
ALTER TABLE `item_in_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_out_tb`
--
ALTER TABLE `item_out_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_tb`
--
ALTER TABLE `order_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transaction_code` (`transaction_code`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `warehouses_wareouse_code_unique` (`warehouse_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `item_in_tb`
--
ALTER TABLE `item_in_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `item_out_tb`
--
ALTER TABLE `item_out_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `order_tb`
--
ALTER TABLE `order_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_item_category_id_foreign` FOREIGN KEY (`item_category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `items_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
