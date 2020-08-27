-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 21, 2020 at 09:15 AM
-- Server version: 5.7.31-0ubuntu0.18.04.1
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cafeapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gst_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `address`, `gst_number`) VALUES
(1, 'Rudra Enterprise', 'Ahmedabad', '24AXAPJ4406A1ZB');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_name` enum('pizza','sandwich','snacks','drinks','others') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pizza',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cafe_price` decimal(10,2) NOT NULL,
  `frozen_price` decimal(10,2) NOT NULL,
  `zomato_price` decimal(10,2) NOT NULL,
  `swiggy_price` decimal(10,2) NOT NULL,
  `stock` decimal(10,2) DEFAULT '0.00',
  `order_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `group_name`, `name`, `image`, `cafe_price`, `frozen_price`, `zomato_price`, `swiggy_price`, `stock`, `order_by`, `created_at`, `updated_at`) VALUES
(1, 'pizza', 'Premium Pizza', NULL, '125.00', '95.00', '145.00', '145.00', '43.00', 1, '2020-07-08 22:17:02', '2020-08-20 16:34:12'),
(2, 'pizza', '4 Cheese Pizza', NULL, '125.00', '95.00', '145.00', '145.00', '9.00', 2, '2020-07-08 22:17:27', '2020-07-13 01:08:32'),
(3, 'pizza', 'Garlic Cheese Pizza', NULL, '125.00', '95.00', '145.00', '145.00', '0.00', 3, '2020-07-08 22:18:17', '2020-07-08 22:18:17'),
(4, 'pizza', 'Mini Margereta Pizza', NULL, '125.00', '95.00', '145.00', '145.00', '0.00', 4, '2020-07-08 22:19:28', '2020-07-08 22:19:28'),
(5, 'pizza', 'DC Vegetable Pizza', NULL, '180.00', '140.00', '200.00', '200.00', '-3.00', 5, '2020-07-08 22:19:55', '2020-08-20 16:35:43'),
(6, 'pizza', 'DC Margereta Pizza', NULL, '180.00', '140.00', '200.00', '200.00', '-1.00', 6, '2020-07-08 22:20:22', '2020-08-20 16:35:43'),
(7, 'pizza', 'DC Panner Pizza', NULL, '180.00', '140.00', '200.00', '200.00', '-4.00', 7, '2020-07-08 22:20:47', '2020-08-20 16:35:49'),
(8, 'pizza', 'DC Italian Macroni Pizza', NULL, '180.00', '140.00', '200.00', '200.00', '0.00', 8, '2020-07-08 22:21:20', '2020-07-08 22:21:20'),
(9, 'sandwich', 'Vegetable Sandwich', NULL, '50.00', '50.00', '70.00', '70.00', '0.00', 1, '2020-07-08 22:23:23', '2020-07-08 22:23:23'),
(10, 'sandwich', 'Cheese Sandwich', NULL, '60.00', '60.00', '80.00', '80.00', '0.00', 2, '2020-07-08 22:25:04', '2020-07-08 22:25:04'),
(11, 'sandwich', 'Butter Jam Sandwich', NULL, '40.00', '40.00', '60.00', '60.00', '-1.00', 3, '2020-07-08 22:25:33', '2020-08-20 16:35:49'),
(12, 'sandwich', 'Bread Butter', NULL, '30.00', '30.00', '50.00', '50.00', '0.00', 4, '2020-07-08 22:26:10', '2020-07-08 22:26:10'),
(13, 'sandwich', 'Classic Cheese Sandwich', NULL, '100.00', '100.00', '120.00', '120.00', '0.00', 5, '2020-07-08 22:27:16', '2020-07-08 22:27:16'),
(14, 'sandwich', 'Chili Cheese Sandwich', NULL, '100.00', '100.00', '120.00', '120.00', '-1.00', 6, '2020-07-08 22:27:41', '2020-08-13 18:21:50'),
(15, 'sandwich', 'Masala Sandwich', NULL, '100.00', '100.00', '120.00', '120.00', '0.00', 7, '2020-07-08 22:28:10', '2020-07-08 22:28:10'),
(16, 'sandwich', 'Garlic Bread', NULL, '120.00', '120.00', '140.00', '140.00', '0.00', 8, '2020-07-08 22:28:42', '2020-07-08 22:28:42'),
(17, 'sandwich', 'Burger', NULL, '100.00', '79.00', '120.00', '120.00', '0.00', 9, '2020-07-08 22:29:08', '2020-07-08 22:40:46'),
(18, 'snacks', 'French Fries', NULL, '60.00', '60.00', '80.00', '80.00', '0.00', 1, '2020-07-08 22:32:40', '2020-07-08 22:32:40'),
(19, 'others', 'French Fries Packet 200 gm', NULL, '33.00', '33.00', '33.00', '33.00', '0.00', 1, '2020-07-08 22:33:04', '2020-07-08 22:33:04'),
(20, 'others', 'French Fries Packet 500 gm', NULL, '68.00', '68.00', '68.00', '68.00', '0.00', 2, '2020-07-08 22:34:00', '2020-07-08 22:34:00'),
(21, 'snacks', 'Masala Paneer', NULL, '80.00', '135.00', '100.00', '100.00', '0.00', 2, '2020-07-08 22:37:07', '2020-07-08 22:37:07'),
(22, 'snacks', 'Masti Dahi Tikki', NULL, '80.00', '125.00', '100.00', '100.00', '0.00', 3, '2020-07-08 22:38:00', '2020-07-08 22:38:00'),
(23, 'snacks', 'Cheese Onion Paratha', NULL, '120.00', '180.00', '140.00', '140.00', '0.00', 4, '2020-07-08 22:38:27', '2020-07-08 22:38:27'),
(24, 'snacks', 'Cheese Onion Samosa', NULL, '70.00', '120.00', '90.00', '90.00', '0.00', 5, '2020-07-08 22:38:49', '2020-07-08 22:38:49'),
(25, 'snacks', 'Cheese Poppons', NULL, '90.00', '145.00', '110.00', '110.00', '0.00', 6, '2020-07-08 22:39:13', '2020-07-08 22:39:13'),
(26, 'snacks', 'Aloo Tikki', NULL, '60.00', '75.00', '80.00', '80.00', '0.00', 7, '2020-07-08 22:39:31', '2020-07-08 22:39:31'),
(27, 'snacks', 'Potato Wedges', NULL, '60.00', '83.00', '80.00', '80.00', '0.00', 8, '2020-07-08 22:39:51', '2020-07-08 22:39:51'),
(28, 'snacks', 'Hash Brown', NULL, '60.00', '61.00', '80.00', '80.00', '0.00', 9, '2020-07-08 22:40:10', '2020-07-08 22:40:10'),
(29, 'snacks', 'Veggie Stick', NULL, '70.00', '95.00', '90.00', '90.00', '0.00', 10, '2020-07-08 22:41:20', '2020-07-08 22:41:20'),
(30, 'snacks', 'Bhaji Pav', NULL, '130.00', '130.00', '150.00', '150.00', '0.00', 11, '2020-07-08 22:41:49', '2020-07-08 22:41:49'),
(31, 'snacks', 'Chole Bhature', NULL, '140.00', '140.00', '160.00', '160.00', '0.00', 12, '2020-07-08 22:42:12', '2020-07-08 22:42:12'),
(32, 'others', 'Extra Cheese', NULL, '30.00', '30.00', '30.00', '30.00', '0.00', 3, '2020-07-08 22:42:44', '2020-07-08 22:42:44'),
(33, 'others', 'Extra Grill', NULL, '25.00', '25.00', '25.00', '25.00', '0.00', 4, '2020-07-08 22:43:03', '2020-07-08 22:43:03'),
(34, 'others', 'Extra Pav', NULL, '20.00', '20.00', '20.00', '20.00', '0.00', 5, '2020-07-08 22:43:22', '2020-07-08 22:43:22'),
(35, 'others', 'Extra Bhature', NULL, '30.00', '30.00', '30.00', '30.00', '0.00', 6, '2020-07-08 22:43:39', '2020-07-08 22:43:39'),
(36, 'drinks', 'Hot Pro', NULL, '20.00', '20.00', '40.00', '40.00', '-1.00', 1, '2020-07-08 22:43:57', '2020-08-13 18:21:50'),
(37, 'drinks', 'Cappuccino Coffee', NULL, '30.00', '30.00', '50.00', '50.00', '0.00', 2, '2020-07-08 22:44:21', '2020-07-08 22:44:21'),
(38, 'drinks', 'Tea', NULL, '20.00', '20.00', '40.00', '40.00', '0.00', 3, '2020-07-08 22:44:40', '2020-07-08 22:44:40'),
(39, 'drinks', 'Hot Coffee', NULL, '20.00', '20.00', '40.00', '40.00', '0.00', 4, '2020-07-08 22:45:06', '2020-07-08 22:45:06'),
(40, 'drinks', 'Amul Pro Milkshake', NULL, '80.00', '80.00', '100.00', '100.00', '0.00', 5, '2020-07-08 22:46:58', '2020-07-08 22:46:58'),
(41, 'drinks', 'Classic Cold Coffee', NULL, '80.00', '80.00', '100.00', '100.00', '0.00', 6, '2020-07-08 22:47:44', '2020-07-08 22:47:44'),
(42, 'drinks', 'Oreo Milkshake', NULL, '110.00', '110.00', '130.00', '130.00', '0.00', 7, '2020-07-08 22:48:17', '2020-07-08 22:48:17'),
(43, 'drinks', 'Kitkat Milkshake', NULL, '120.00', '120.00', '140.00', '140.00', '0.00', 8, '2020-07-08 22:48:58', '2020-07-08 22:48:58'),
(44, 'drinks', 'Belgium Chocolate Milkshake', NULL, '120.00', '120.00', '140.00', '140.00', '0.00', 9, '2020-07-08 22:49:24', '2020-07-08 22:49:24'),
(45, 'drinks', 'Ferro Rocher Milkshake', NULL, '150.00', '150.00', '170.00', '170.00', '0.00', 10, '2020-07-08 22:49:56', '2020-07-08 22:49:56');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_05_25_124431_create_employee_details_table', 2),
(5, '2020_05_25_103755_create_admins_table', 3),
(6, '2020_05_27_065532_create_languages_table', 4),
(7, '2020_05_27_090020_create_language_contents_table', 4),
(8, '2020_05_27_091349_create_language_texts_table', 4),
(9, '2020_05_28_095618_create_holidays_table', 5),
(10, '2020_06_02_131841_create_leavetype_table', 6),
(11, '2020_06_03_013948_cretae_leave_applies_table', 7),
(12, '2020_06_04_051105_create_salary_types_table', 8),
(13, '2020_06_04_122559_create_settings_table', 9),
(14, '2020_06_05_065240_create_employee_time_logs_table', 10),
(15, '2020_06_08_133332_create_table_company_settings_table', 11),
(16, '2020_06_20_050357_create_clients_table', 12),
(17, '2020_06_20_060730_create_groups_table', 13),
(18, '2020_06_20_060844_create_businesses_table', 14),
(19, '2020_06_20_060941_create_client_businesses_table', 15),
(20, '2020_06_21_032859_create_to_dos_table', 16),
(21, '2020_06_24_185638_create_schools_table', 16),
(22, '2020_06_26_184444_create_uniforms_table', 17),
(23, '2020_06_29_143658_create_commisions_table', 18),
(24, '2020_06_30_081020_create_item_masters_table', 19),
(25, '2020_07_03_180817_create_companies_table', 20),
(26, '2020_07_04_051108_create_items_table', 21),
(27, '2020_07_04_123703_create_orders_table', 22),
(28, '2020_07_04_123738_create_order_items_table', 23);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_by` int(11) NOT NULL,
  `customer_type` enum('swiggy','zomato','cafe','frozen','other') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cafe',
  `bill_no` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `time` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('paid','unpaid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'paid',
  `bill_type` enum('sale','purchase') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sale',
  `payment_mode` enum('cash','paytm','swiggy','zomato') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cash',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `created_by`, `customer_type`, `bill_no`, `order_number`, `total_price`, `time`, `status`, `bill_type`, `payment_mode`, `created_at`, `updated_at`) VALUES
(1, 1, 'cafe', '120720-001', '1', '375.00', '18:19 PM', 'paid', 'sale', 'cash', '2020-07-12 18:20:00', '2020-07-12 18:20:00'),
(2, 1, 'cafe', '130720-001', '1', '125.00', '01:07 AM', 'paid', 'sale', 'cash', '2020-07-13 01:07:36', '2020-07-13 01:07:36'),
(3, 1, 'frozen', '130720-002', '2', '95.00', '01:07 AM', 'paid', 'sale', 'cash', '2020-07-13 01:07:52', '2020-07-13 01:07:52'),
(4, 1, 'cafe', '130720-003', '3', '125.00', '01:07 AM', 'paid', 'sale', 'paytm', '2020-07-13 01:08:15', '2020-07-13 01:08:15'),
(5, 1, 'cafe', '130720-004', '4', '125.00', '19:42 PM', 'paid', 'sale', 'cash', '2020-07-13 19:42:29', '2020-07-13 19:42:29'),
(6, 1, 'cafe', '130720-005', '5', '180.00', '19:43 PM', 'paid', 'sale', 'cash', '2020-07-13 19:43:40', '2020-07-13 19:43:40'),
(7, 1, 'cafe', '130820-001', '1', '660.00', '23:51 PM', 'paid', 'sale', 'cash', '2020-08-13 18:21:50', '2020-08-13 18:21:50'),
(8, 1, 'cafe', '200820-001', '1', '305.00', '22:04 PM', 'paid', 'sale', 'cash', '2020-08-20 16:34:12', '2020-08-20 16:34:12'),
(9, 1, 'cafe', '200820-002', '2', '360.00', '22:05 PM', 'paid', 'sale', 'cash', '2020-08-20 16:35:43', '2020-08-20 16:35:43'),
(10, 1, 'cafe', '200820-003', '3', '220.00', '22:05 PM', 'paid', 'sale', 'cash', '2020-08-20 16:35:49', '2020-08-20 16:35:49');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `random_number` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `item_id`, `price`, `quantity`, `total_price`, `random_number`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '125.00', 3, '375.00', '899550', '2020-07-12 18:20:00', '2020-07-12 18:20:00'),
(2, 2, 1, '125.00', 1, '125.00', '262313', '2020-07-13 01:07:36', '2020-07-13 01:07:36'),
(3, 3, 1, '95.00', 1, '95.00', '495962', '2020-07-13 01:07:52', '2020-07-13 01:07:52'),
(4, 4, 2, '125.00', 1, '125.00', '282070', '2020-07-13 01:08:15', '2020-07-13 01:08:15'),
(5, 5, 1, '125.00', 1, '125.00', '629285', '2020-07-13 19:42:29', '2020-07-13 19:42:29'),
(6, 6, 5, '180.00', 1, '180.00', '864840', '2020-07-13 19:43:40', '2020-07-13 19:43:40'),
(7, 7, 36, '20.00', 1, '20.00', '749287', '2020-08-13 18:21:50', '2020-08-13 18:21:50'),
(8, 7, 14, '100.00', 1, '100.00', '536550', '2020-08-13 18:21:50', '2020-08-13 18:21:50'),
(9, 7, 7, '180.00', 3, '540.00', '275104', '2020-08-13 18:21:50', '2020-08-13 18:21:50'),
(10, 8, 1, '125.00', 1, '125.00', '420970', '2020-08-20 16:34:12', '2020-08-20 16:34:12'),
(11, 8, 5, '180.00', 1, '180.00', '283836', '2020-08-20 16:34:12', '2020-08-20 16:34:12'),
(12, 9, 5, '180.00', 1, '180.00', '845828', '2020-08-20 16:35:43', '2020-08-20 16:35:43'),
(13, 9, 6, '180.00', 1, '180.00', '322604', '2020-08-20 16:35:43', '2020-08-20 16:35:43'),
(14, 10, 11, '40.00', 1, '40.00', '418028', '2020-08-20 16:35:49', '2020-08-20 16:35:49'),
(15, 10, 7, '180.00', 1, '180.00', '987995', '2020-08-20 16:35:49', '2020-08-20 16:35:49');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_by` int(11) NOT NULL,
  `time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('paid','unpaid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'paid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`id`, `created_by`, `time`, `order_number`, `total_price`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '18:19 PM', '1', '6250.00', 'paid', '2020-07-12 18:19:44', '2020-07-12 18:19:44'),
(2, 1, '01:07 AM', '1', '1250.00', 'paid', '2020-07-13 01:08:32', '2020-07-13 01:08:32');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_items`
--

CREATE TABLE `purchase_order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `random_number` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_order_items`
--

INSERT INTO `purchase_order_items` (`id`, `purchase_order_id`, `item_id`, `price`, `quantity`, `total_price`, `random_number`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '125.00', 50, '6250.00', '697227', '2020-07-12 18:19:44', '2020-07-12 18:19:44'),
(2, 2, 2, '125.00', 10, '1250.00', '343905', '2020-07-13 01:08:32', '2020-07-13 01:08:32');

-- --------------------------------------------------------

--
-- Table structure for table `stocklogs`
--

CREATE TABLE `stocklogs` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `opning` decimal(10,2) NOT NULL,
  `purchase` decimal(10,2) NOT NULL,
  `sale` decimal(10,2) NOT NULL,
  `closing` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `cash` decimal(10,2) NOT NULL,
  `paytm` decimal(10,2) NOT NULL,
  `zomato` decimal(10,2) NOT NULL,
  `swiggy` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stocklogs`
--

INSERT INTO `stocklogs` (`id`, `item_id`, `opning`, `purchase`, `sale`, `closing`, `total`, `cash`, `paytm`, `zomato`, `swiggy`, `created_at`, `updated_at`) VALUES
(1, 1, '0.00', '50.00', '3.00', '47.00', '375.00', '375.00', '0.00', '0.00', '0.00', '2020-07-12 18:19:44', '2020-07-12 18:20:00'),
(2, 1, '47.00', '0.00', '3.00', '44.00', '345.00', '345.00', '0.00', '0.00', '0.00', '2020-07-13 01:07:36', '2020-07-13 19:42:29'),
(3, 2, '0.00', '10.00', '1.00', '9.00', '125.00', '0.00', '125.00', '0.00', '0.00', '2020-07-13 01:08:15', '2020-07-13 01:08:32'),
(4, 5, '0.00', '0.00', '1.00', '-1.00', '180.00', '180.00', '0.00', '0.00', '0.00', '2020-07-13 19:43:40', '2020-07-13 19:43:40'),
(5, 36, '0.00', '0.00', '1.00', '-1.00', '20.00', '20.00', '0.00', '0.00', '0.00', '2020-08-13 18:21:50', '2020-08-13 18:21:50'),
(6, 14, '0.00', '0.00', '1.00', '-1.00', '100.00', '100.00', '0.00', '0.00', '0.00', '2020-08-13 18:21:50', '2020-08-13 18:21:50'),
(7, 7, '0.00', '0.00', '3.00', '-3.00', '540.00', '540.00', '0.00', '0.00', '0.00', '2020-08-13 18:21:50', '2020-08-13 18:21:50'),
(8, 1, '44.00', '0.00', '1.00', '43.00', '125.00', '125.00', '0.00', '0.00', '0.00', '2020-08-20 16:34:12', '2020-08-20 16:34:12'),
(9, 5, '-1.00', '0.00', '2.00', '-3.00', '360.00', '360.00', '0.00', '0.00', '0.00', '2020-08-20 16:34:12', '2020-08-20 16:35:43'),
(10, 6, '0.00', '0.00', '1.00', '-1.00', '180.00', '180.00', '0.00', '0.00', '0.00', '2020-08-20 16:35:43', '2020-08-20 16:35:43'),
(11, 11, '0.00', '0.00', '1.00', '-1.00', '40.00', '40.00', '0.00', '0.00', '0.00', '2020-08-20 16:35:49', '2020-08-20 16:35:49'),
(12, 7, '-3.00', '0.00', '1.00', '-4.00', '180.00', '180.00', '0.00', '0.00', '0.00', '2020-08-20 16:35:49', '2020-08-20 16:35:49');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('operator','super_admin','user') COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `city_id` int(255) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `username`, `role`, `password`, `status`, `city_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Admin', 'admin', 'super_admin', '$2y$10$VjC2yF97QwXKsKEkxuHBBujuS5.sonsUSOwxVZuJTAvDwKBPQVYRC', 'active', 1, NULL, '2020-05-24 18:30:00', '2020-06-25 12:46:39'),
(13, 'Sagar', 'Sagar', 'abcd', 'user', '$2y$10$rFXuT8Qovy3mVFLsZxLXKOJkgcjwXL44fXw/xqog/wNKYOzObMWt6', 'active', NULL, NULL, '2020-07-10 00:44:52', '2020-07-13 02:26:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocklogs`
--
ALTER TABLE `stocklogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
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
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `stocklogs`
--
ALTER TABLE `stocklogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
