-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2022 at 09:33 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

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
(1, 'syr', 'Sayur', NULL, '2022-06-17 11:04:07'),
(6, 'bh', 'Buah', '2022-06-18 03:13:56', '2022-06-18 03:13:56');

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
(3, 'C-12', 'Syifa', '2022-06-16 22:29:19', '2022-06-16 22:29:19'),
(4, 'C-13', 'Jihan', '2022-06-16 22:29:54', '2022-06-16 22:29:54');

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
(16, 'barang', 'Bayam', 1, 1, '214124', 0, 15000, 20000, 1, '2022-01-13 08:07:43', '2022-06-30 10:52:28', 0, 0),
(17, 'Cbi', 'Cabai', 1, 1, '412412', 14, 30000, 35000, 1, '2022-03-24 14:18:31', '2022-06-30 11:17:21', 4, 174),
(23, 'Item-22', 'Tomat Buah', 1, 3, 'coba', 0, 2500, 3000, 1, '2022-06-30 08:07:04', '2022-06-30 08:07:04', 0, 0),
(24, 'Item-23', 'Jagung', 1, 1, '123123', 19, 8000, 9500, 1, '2022-06-30 08:07:31', '2022-06-30 08:07:31', 4, 171),
(25, 'ITEM-COBA', 'Garam', 1, 3, 'COBALAGI', 1, 1200, 1500, 1, '2022-06-30 10:53:01', '2022-06-30 10:53:01', 4, 173),
(26, 'bwg-pth', 'Bawang Putih', 1, 1, '21299', 5, 28000, 32000, 1, '2022-07-12 12:08:43', '2022-07-12 12:08:43', 3, 166);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lead_time` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_in_tb`
--

INSERT INTO `item_in_tb` (`id`, `transaction_code`, `item_id`, `supplier_id`, `warehouse_id`, `item_total`, `total_price`, `order_id`, `parent_code`, `created_at`, `updated_at`, `lead_time`) VALUES
(43, 'P00002', 25, 3, 0, 6, 7200, 161, 'P00001', '2022-07-04 22:21:28', '2022-07-04 22:21:28', 0),
(44, 'P00002', 17, 3, 0, 3, 90000, 162, 'P00001', '2022-07-04 22:21:28', '2022-07-04 22:21:28', 0),
(45, 'P00002', 16, 3, 0, 1, 15000, 163, 'P00001', '2022-07-04 22:21:28', '2022-07-04 22:21:28', 0),
(46, 'P00003', 25, 3, 0, 1, 1200, 161, 'P00001', '2022-07-04 22:32:43', '2022-07-04 22:32:43', 0),
(47, 'P00003', 17, 3, 0, 1, 30000, 162, 'P00001', '2022-07-04 22:32:43', '2022-07-04 22:32:43', 0),
(48, 'P00003', 16, 3, 0, 2, 30000, 163, 'P00001', '2022-07-04 22:32:43', '2022-07-04 22:32:43', 0),
(49, 'P00004', 25, 3, 0, 3, 3600, 161, 'P00001', '2022-07-04 22:33:03', '2022-07-04 22:33:03', 0),
(50, 'P00004', 17, 3, 0, 2, 60000, 162, 'P00001', '2022-07-04 22:33:03', '2022-07-04 22:33:03', 0),
(51, 'P00018', 24, 1, 0, 10, 80000, 167, 'P00015', '2022-07-13 22:56:57', '2022-07-13 22:56:57', 0),
(52, 'P00018', 26, 1, 0, 10, 280000, 168, 'P00015', '2022-07-13 22:56:58', '2022-07-13 22:56:58', 0),
(53, 'P00019', 23, 3, 2, 2, 5000, 164, 'P00014', '2022-07-13 23:54:57', '2022-07-13 23:54:57', 0),
(54, 'P00019', 24, 3, 2, 2, 16000, 165, 'P00014', '2022-07-13 23:54:57', '2022-07-13 23:54:57', 0),
(55, 'P00019', 26, 3, 2, 2, 56000, 166, 'P00014', '2022-07-13 23:54:57', '2022-07-13 23:54:57', 0),
(56, 'P00026', 16, 1, 1, 6, 90000, 170, 'P00017', '2022-07-15 15:25:54', '2022-07-15 15:25:54', 1),
(57, 'P00027', 17, 1, 1, 4, 120000, 169, 'P00016', '2022-07-15 15:28:00', '2022-07-15 15:28:00', 3),
(58, 'P00028', 23, 3, 1, 1, 2500, 164, 'P00014', '2022-07-15 15:46:15', '2022-07-15 15:46:15', 5),
(59, 'P00028', 24, 3, 1, 2, 16000, 165, 'P00014', '2022-07-15 15:46:49', '2022-07-15 15:46:49', 5),
(60, 'P00028', 26, 3, 1, 4, 112000, 166, 'P00014', '2022-07-15 15:48:50', '2022-07-15 15:48:50', 3),
(61, 'P00029', 24, 3, 1, 10, 80000, 175, 'P00024', '2022-07-15 16:01:15', '2022-07-15 16:01:15', 1),
(62, 'P00029', 17, 3, 1, 5, 150000, 176, 'P00024', '2022-07-15 16:01:15', '2022-07-15 16:01:15', 1),
(63, 'P00030', 24, 3, 1, 5, 40000, 171, 'P00022', '2022-07-18 18:10:52', '2022-07-18 18:10:52', 4),
(64, 'P00030', 17, 3, 1, 4, 120000, 172, 'P00022', '2022-07-18 18:10:52', '2022-07-18 18:10:52', 4),
(65, 'P00031', 25, 1, 1, 10, 12000, 173, 'P00023', '2022-07-18 18:11:01', '2022-07-18 18:11:01', 4),
(66, 'P00031', 17, 1, 1, 5, 150000, 174, 'P00023', '2022-07-18 18:11:01', '2022-07-18 18:11:01', 4);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_out_tb`
--

INSERT INTO `item_out_tb` (`id`, `transaction_code`, `item_id`, `customer_id`, `warehouse_id`, `item_total`, `selling_price`, `total_price`, `status`, `created_at`, `updated_at`) VALUES
(1, 'P00005', 16, 0, 2, 4, 0, 80000, '', '2022-07-09 12:52:48', '2022-07-09 12:52:48'),
(2, 'P00005', 17, 0, 2, 1, 0, 35000, '', '2022-07-09 12:52:48', '2022-07-09 12:52:48'),
(3, 'P00005', 24, 0, 2, 8, 0, 76000, '', '2022-07-09 12:52:48', '2022-07-09 12:52:48'),
(4, 'P00006', 25, 0, 1, 2, 0, 3000, '', '2022-07-12 09:46:45', '2022-07-12 09:46:45'),
(5, 'P00007', 17, 0, 1, 3, 0, 105000, 'pending', '2022-07-12 10:26:03', '2022-07-12 10:26:03'),
(6, 'P00007', 25, 0, 1, 4, 0, 6000, 'pending', '2022-07-12 10:26:03', '2022-07-12 10:26:03'),
(7, 'P00008', 25, 0, 1, 5, 0, 7500, 'pending', '2022-07-12 10:49:18', '2022-07-12 10:49:18'),
(8, 'P00008', 17, 0, 1, 3, 0, 105000, 'pending', '2022-07-12 10:49:18', '2022-07-12 10:49:18'),
(9, 'P00009', 25, 0, 2, 5, 0, 7500, 'accepted', '2022-07-12 10:54:16', '2022-07-12 10:57:58'),
(10, 'P00009', 17, 0, 2, 4, 0, 140000, 'accepted', '2022-07-12 10:54:16', '2022-07-12 10:57:58'),
(11, 'P00010', 25, 0, 2, 2, 0, 3000, 'accepted', '2022-07-12 10:58:50', '2022-07-12 10:59:21'),
(12, 'P00010', 16, 0, 2, 3, 0, 60000, 'accepted', '2022-07-12 10:58:50', '2022-07-12 10:59:21'),
(13, 'P00011', 25, 0, 1, 2, 0, 3000, 'rejected', '2022-07-12 11:00:53', '2022-07-12 11:27:28'),
(14, 'P00011', 17, 0, 1, 1, 0, 35000, 'rejected', '2022-07-12 11:00:53', '2022-07-12 11:27:28'),
(15, 'P00012', 17, 0, 1, 1, 0, 35000, 'accepted', '2022-07-12 11:01:41', '2022-07-12 11:27:57'),
(16, 'P00013', 25, 0, 1, 2, 0, 3000, 'rejected', '2022-07-12 11:31:54', '2022-07-12 11:32:17'),
(17, 'P00013', 17, 0, 1, 1, 0, 35000, 'rejected', '2022-07-12 11:31:54', '2022-07-12 11:32:17'),
(18, 'P00020', 24, 3, 1, 6, 0, 57000, 'pending', '2022-07-14 01:20:13', '2022-07-14 01:20:13'),
(19, 'P00020', 23, 3, 1, 1, 0, 3000, 'pending', '2022-07-14 01:20:13', '2022-07-14 01:20:13'),
(20, 'P00021', 26, 4, 2, 3, 0, 96000, 'accepted', '2022-07-14 01:22:59', '2022-07-18 18:21:20'),
(21, 'P00021', 24, 4, 2, 3, 0, 28500, 'accepted', '2022-07-14 01:22:59', '2022-07-18 18:21:20'),
(22, 'P00025', 25, 3, 2, 2, 1500, 3000, 'accepted', '2022-07-14 02:28:54', '2022-07-18 18:21:16'),
(23, 'P00025', 26, 3, 2, 6, 32000, 192000, 'accepted', '2022-07-14 02:28:54', '2022-07-18 18:21:16'),
(24, 'P00025', 24, 3, 2, 1, 9500, 9500, 'accepted', '2022-07-14 02:28:54', '2022-07-18 18:21:16'),
(25, 'P00032', 16, 4, 2, 6, 20000, 120000, 'accepted', '2022-07-18 18:20:53', '2022-07-18 18:21:11'),
(26, 'P00032', 23, 4, 2, 2, 3000, 6000, 'accepted', '2022-07-18 18:20:53', '2022-07-18 18:21:11'),
(27, 'P00032', 26, 4, 2, 2, 32000, 64000, 'accepted', '2022-07-18 18:20:53', '2022-07-18 18:21:11'),
(28, 'P00032', 25, 4, 2, 10, 1500, 15000, 'accepted', '2022-07-18 18:20:53', '2022-07-18 18:21:11'),
(29, 'P00032', 17, 4, 2, 5, 35000, 175000, 'accepted', '2022-07-18 18:20:53', '2022-07-18 18:21:11');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_tb`
--

INSERT INTO `order_tb` (`id`, `transaction_code`, `item_id`, `supplier_id`, `item_total`, `buying_price`, `total_price`, `status`, `sisa_stok`, `created_at`, `updated_at`) VALUES
(161, 'P00001', 25, 3, 10, 0, 12000, 'accepted', 0, '2022-07-04 22:16:17', '2022-07-04 22:17:59'),
(162, 'P00001', 17, 3, 6, 0, 180000, 'accepted', 0, '2022-07-04 22:16:17', '2022-07-04 22:17:59'),
(163, 'P00001', 16, 3, 3, 0, 45000, 'accepted', 0, '2022-07-04 22:16:17', '2022-07-04 22:17:59'),
(164, 'P00014', 23, 3, 3, 0, 7500, 'accepted', 0, '2022-07-12 12:23:00', '2022-07-13 22:58:25'),
(165, 'P00014', 24, 3, 4, 0, 32000, 'accepted', 0, '2022-07-12 12:23:00', '2022-07-13 22:58:25'),
(166, 'P00014', 26, 3, 6, 0, 168000, 'accepted', 0, '2022-07-12 12:23:00', '2022-07-13 22:58:25'),
(167, 'P00015', 24, 1, 10, 0, 80000, 'accepted', 0, '2022-07-13 22:36:14', '2022-07-13 22:39:31'),
(168, 'P00015', 26, 1, 10, 0, 280000, 'accepted', 0, '2022-07-13 22:36:14', '2022-07-13 22:39:31'),
(169, 'P00016', 17, 1, 4, 0, 120000, 'accepted', 0, '2022-07-13 22:50:00', '2022-07-13 22:58:32'),
(170, 'P00017', 16, 1, 6, 0, 90000, 'accepted', 0, '2022-07-13 22:50:32', '2022-07-13 22:58:41'),
(171, 'P00022', 24, 3, 5, 0, 40000, 'accepted', 0, '2022-07-14 02:06:32', '2022-07-18 17:55:56'),
(172, 'P00022', 17, 3, 4, 0, 120000, 'accepted', 0, '2022-07-14 02:06:32', '2022-07-18 17:55:56'),
(173, 'P00023', 25, 1, 10, 0, 12000, 'accepted', 0, '2022-07-14 02:19:08', '2022-07-18 17:55:50'),
(174, 'P00023', 17, 1, 5, 0, 150000, 'accepted', 0, '2022-07-14 02:19:08', '2022-07-18 17:55:50'),
(175, 'P00024', 24, 3, 10, 8000, 80000, 'accepted', 0, '2022-07-14 02:21:03', '2022-07-15 15:59:16'),
(176, 'P00024', 17, 3, 5, 30000, 150000, 'accepted', 0, '2022-07-14 02:21:03', '2022-07-15 15:59:16'),
(177, 'P00033', 16, 3, 100, 15000, 1500000, 'accepted', 100, '2022-07-18 18:33:11', '2022-07-18 18:33:43'),
(178, 'P00033', 17, 3, 5, 30000, 150000, 'accepted', 5, '2022-07-18 18:33:11', '2022-07-18 18:33:43'),
(179, 'P00033', 26, 3, 10, 28000, 280000, 'accepted', 10, '2022-07-18 18:33:11', '2022-07-18 18:33:43'),
(180, 'P00033', 23, 3, 10, 2500, 25000, 'accepted', 10, '2022-07-18 18:33:11', '2022-07-18 18:33:43'),
(181, 'P00033', 25, 3, 10, 1200, 12000, 'accepted', 10, '2022-07-18 18:33:11', '2022-07-18 18:33:43');

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
(1, 'Suptes', 'Supplier Test', '', '2022-03-03 05:04:02', '2022-03-03 05:04:02'),
(3, 'Supp01', 'Yabes Supplier', 'Bandulan Timur', '2022-06-17 11:00:05', '2022-06-17 11:00:15');

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
(72, 'P00001', 'order', 3, 0, 0, 'done', 'sudah aman', '', 0, '2022-07-04 22:16:17', '2022-07-04 22:17:59'),
(73, 'P00002', 'in', 3, 0, 0, 'stok_in', '', 'P00001', 0, '2022-07-04 22:21:28', '2022-07-04 22:21:28'),
(74, 'P00003', 'in', 3, 0, 0, 'stok_in', '', 'P00001', 0, '2022-07-04 22:32:43', '2022-07-04 22:32:43'),
(75, 'P00004', 'in', 3, 0, 0, 'stok_in', '', 'P00001', 0, '2022-07-04 22:33:03', '2022-07-04 22:33:03'),
(76, 'P00005', 'out', 0, 2, 0, 'accepted', 'coba setuju', '', 0, '2022-07-09 12:52:48', '2022-07-09 13:58:12'),
(77, 'P00006', 'out', 0, 1, 0, 'accepted', 'sudah aman', '', 0, '2022-07-12 09:46:45', '2022-07-12 09:49:07'),
(78, 'P00007', 'out', 0, 1, 0, 'accepted', 'coba accept', '', 0, '2022-07-12 10:26:03', '2022-07-12 10:45:14'),
(79, 'P00008', 'out', 0, 1, 0, 'accepted', 'coba menyetujui item out', '', 0, '2022-07-12 10:49:18', '2022-07-12 10:51:30'),
(80, 'P00009', 'out', 0, 2, 0, 'accepted', 'mari kita coba item out', '', 0, '2022-07-12 10:54:16', '2022-07-12 10:57:58'),
(81, 'P00010', 'out', 0, 2, 0, 'accepted', 'coba lagi ', '', 0, '2022-07-12 10:58:50', '2022-07-12 10:59:21'),
(82, 'P00011', 'out', 0, 1, 0, 'rejected', 'reject', '', 0, '2022-07-12 11:00:53', '2022-07-12 11:27:28'),
(83, 'P00012', 'out', 0, 1, 0, 'accepted', 'accept', '', 0, '2022-07-12 11:01:41', '2022-07-12 11:27:57'),
(84, 'P00013', 'out', 0, 1, 0, 'rejected', 'gagal bos', '', 0, '2022-07-12 11:31:54', '2022-07-12 11:32:17'),
(85, 'P00014', 'order', 3, 0, 0, 'done', 'berhasil', '', 0, '2022-07-12 12:23:00', '2022-07-13 22:58:25'),
(86, 'P00015', 'order', 1, 0, 0, 'done', 'setuju', '', 0, '2022-07-13 22:36:14', '2022-07-13 22:39:31'),
(87, 'P00016', 'order', 1, 0, 0, 'done', 'asd', '', 0, '2022-07-13 22:50:00', '2022-07-13 22:58:32'),
(88, 'P00017', 'order', 1, 0, 0, 'done', 'asdasdasd', '', 0, '2022-07-13 22:50:32', '2022-07-13 22:58:41'),
(89, 'P00018', 'in', 1, 0, 0, 'stok_in', '', 'P00015', 0, '2022-07-13 22:56:58', '2022-07-13 22:56:58'),
(90, 'P00019', 'in', 3, 2, 0, 'stok_in', '', 'P00014', 0, '2022-07-13 23:54:57', '2022-07-13 23:54:57'),
(91, 'P00020', 'out', 0, 1, 3, 'pending', '', '', 0, '2022-07-14 01:20:13', '2022-07-14 01:20:13'),
(92, 'P00021', 'out', 0, 2, 4, 'accepted', 'okee', '', 0, '2022-07-14 01:22:59', '2022-07-18 18:21:20'),
(93, 'P00022', 'order', 3, 0, 0, 'done', 'lagi', '', 0, '2022-07-14 02:06:32', '2022-07-18 17:55:56'),
(94, 'P00023', 'order', 1, 0, 0, 'done', 'coba', '', 0, '2022-07-14 02:19:08', '2022-07-18 17:55:50'),
(95, 'P00024', 'order', 3, 0, 0, 'done', 'berhasil', '', 0, '2022-07-14 02:21:03', '2022-07-15 15:59:16'),
(96, 'P00025', 'out', 0, 2, 3, 'accepted', 'yaa', '', 0, '2022-07-14 02:28:54', '2022-07-18 18:21:16'),
(97, 'P00026', 'in', 1, 1, 0, 'stok_in', '', 'P00017', 0, '2022-07-15 15:25:54', '2022-07-15 15:25:54'),
(98, 'P00027', 'in', 1, 1, 0, 'stok_in', '', 'P00016', 0, '2022-07-15 15:28:00', '2022-07-15 15:28:00'),
(99, 'P00028', 'in', 3, 1, 0, 'stok_in', '', 'P00014', 0, '2022-07-15 15:48:50', '2022-07-15 15:48:50'),
(100, 'P00029', 'in', 3, 1, 0, 'stok_in', '', 'P00024', 0, '2022-07-15 16:01:15', '2022-07-15 16:01:15'),
(101, 'P00030', 'in', 3, 1, 0, 'stok_in', '', 'P00022', 0, '2022-07-18 18:10:52', '2022-07-18 18:10:52'),
(102, 'P00031', 'in', 1, 1, 0, 'stok_in', '', 'P00023', 0, '2022-07-18 18:11:01', '2022-07-18 18:11:01'),
(103, 'P00032', 'out', 0, 2, 4, 'accepted', 'terima', '', 0, '2022-07-18 18:20:53', '2022-07-18 18:21:11'),
(104, 'P00033', 'order', 3, 0, 0, 'accepted', 'yyayayaya', '', 135, '2022-07-18 18:33:11', '2022-07-18 18:33:43');

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
(1, 'kg', 'Kilogram', NULL, '2022-03-24 12:09:02'),
(3, 'gr', 'Gram', '2022-06-02 08:04:22', '2022-06-02 08:04:22');

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
(1, 'gdng1', 'Gudang1', '2022-02-01 14:26:14', '2022-02-01 14:26:14'),
(2, 'GBR', 'Gudang Besar', '2022-03-24 14:18:00', '2022-03-24 14:18:00');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `item_in_tb`
--
ALTER TABLE `item_in_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `item_out_tb`
--
ALTER TABLE `item_out_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `order_tb`
--
ALTER TABLE `order_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

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
