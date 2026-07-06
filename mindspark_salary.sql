-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 06, 2026 at 08:02 AM
-- Server version: 10.11.14-MariaDB-0ubuntu0.24.04.1
-- PHP Version: 8.1.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mindsparksalary`
--

-- --------------------------------------------------------

--
-- Table structure for table `allowances`
--

CREATE TABLE `allowances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `allowances`
--

INSERT INTO `allowances` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Food Allowance', 'Daily food allowance for promoters', '2025-09-17 21:39:19', '2025-09-17 21:39:19'),
(2, 'Transport Allowance', 'Transportation allowance for commuting', '2025-09-17 21:39:19', '2025-09-17 21:39:19'),
(3, 'Accommodation Allowance', 'Accommodation allowance for outstation work', '2025-09-17 21:39:19', '2025-09-17 21:39:19'),
(4, 'Medical Allowance', 'Medical expenses allowance', '2025-09-17 21:39:19', '2025-09-17 21:39:19'),
(5, 'Communication Allowance', 'Mobile phone and communication expenses', '2025-09-17 21:39:19', '2025-09-17 21:39:19'),
(6, 'Uniform Allowance', 'Uniform and clothing allowance', '2025-09-17 21:39:19', '2025-09-17 21:39:19'),
(7, 'Overtime Allowance', 'Additional payment for overtime work', '2025-09-17 21:39:19', '2025-09-17 21:39:19'),
(8, 'Performance Bonus', 'Bonus based on performance metrics', '2025-09-17 21:39:19', '2025-09-17 21:39:19'),
(11, 'Incentive', 'Payment', '2026-01-20 19:15:46', '2026-01-20 19:15:46');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('mindspark-salary-system-cache-setting.company_address', 's:15:\"Default Address\";', 1782840540),
('mindspark-salary-system-cache-setting.company_email', 's:18:\"info@mindspark.com\";', 1782840540),
('mindspark-salary-system-cache-setting.company_name', 's:15:\"Default Company\";', 1782840540),
('mindspark-salary-system-cache-setting.company_phone', 's:17:\"+1 (555) 123-4567\";', 1782840540),
('mindspark-salary-system-cache-setting.company_website', 's:25:\"https://www.mindspark.com\";', 1782840540),
('mindspark-salary-system-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:54:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:10:\"view users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:12:\"create users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:10:\"edit users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:12:\"delete users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:10:\"view roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:12:\"create roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:10:\"edit roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:12:\"delete roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:12:\"view clients\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:4;i:3;i:5;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:14:\"create clients\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:12:\"edit clients\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:14:\"delete clients\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:9:\"view jobs\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:6:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;i:5;i:6;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:11:\"create jobs\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:4;i:3;i:5;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:9:\"edit jobs\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:4;i:3;i:5;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:11:\"delete jobs\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:14:\"view promoters\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:4;i:3;i:5;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:16:\"create promoters\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:14:\"edit promoters\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:16:\"delete promoters\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:23:\"view promoter positions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:4;i:3;i:5;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:25:\"create promoter positions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:23:\"edit promoter positions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:25:\"delete promoter positions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:17:\"view coordinators\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:4;i:3;i:5;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:19:\"create coordinators\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:17:\"edit coordinators\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:19:\"delete coordinators\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:18:\"view salary sheets\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:6:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;i:5;i:6;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:20:\"create salary sheets\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:5:{i:0;i:1;i:1;i:2;i:2;i:4;i:3;i:5;i:4;i:6;}}i:30;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:18:\"edit salary sheets\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:5:{i:0;i:1;i:1;i:2;i:2;i:4;i:3;i:5;i:4;i:6;}}i:31;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:20:\"delete salary sheets\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:4;i:2;i:5;}}i:32;a:4:{s:1:\"a\";i:33;s:1:\"b\";s:14:\"view dashboard\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:6:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;i:5;i:6;}}i:33;a:4:{s:1:\"a\";i:34;s:1:\"b\";s:18:\"access admin panel\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:6;}}i:34;a:4:{s:1:\"a\";i:35;s:1:\"b\";s:15:\"view allowances\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:4;i:3;i:5;}}i:35;a:4:{s:1:\"a\";i:36;s:1:\"b\";s:17:\"create allowances\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:4;i:3;i:5;}}i:36;a:4:{s:1:\"a\";i:37;s:1:\"b\";s:15:\"edit allowances\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:4;i:3;i:5;}}i:37;a:4:{s:1:\"a\";i:38;s:1:\"b\";s:17:\"delete allowances\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:4;i:3;i:5;}}i:38;a:4:{s:1:\"a\";i:39;s:1:\"b\";s:12:\"view reports\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:4;i:2;i:5;}}i:39;a:4:{s:1:\"a\";i:40;s:1:\"b\";s:14:\"create reports\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:40;a:4:{s:1:\"a\";i:41;s:1:\"b\";s:12:\"edit reports\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:41;a:4:{s:1:\"a\";i:42;s:1:\"b\";s:14:\"delete reports\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:42;a:4:{s:1:\"a\";i:43;s:1:\"b\";s:14:\"view reporters\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:4;i:3;i:5;}}i:43;a:4:{s:1:\"a\";i:44;s:1:\"b\";s:16:\"create reporters\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:44;a:4:{s:1:\"a\";i:45;s:1:\"b\";s:14:\"edit reporters\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:45;a:4:{s:1:\"a\";i:46;s:1:\"b\";s:16:\"delete reporters\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:46;a:4:{s:1:\"a\";i:47;s:1:\"b\";s:13:\"view officers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:4;i:3;i:5;}}i:47;a:4:{s:1:\"a\";i:48;s:1:\"b\";s:15:\"create officers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:48;a:4:{s:1:\"a\";i:49;s:1:\"b\";s:13:\"edit officers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:49;a:4:{s:1:\"a\";i:50;s:1:\"b\";s:15:\"delete officers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:50;a:4:{s:1:\"a\";i:51;s:1:\"b\";s:13:\"view settings\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:51;a:4:{s:1:\"a\";i:52;s:1:\"b\";s:13:\"edit settings\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:52;a:4:{s:1:\"a\";i:53;s:1:\"b\";s:19:\"print salary sheets\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:6;}}i:53;a:4:{s:1:\"a\";i:54;s:1:\"b\";s:20:\"export salary sheets\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:6;}}}s:5:\"roles\";a:6:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:5:\"admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:7:\"manager\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:4;s:1:\"b\";s:8:\"reporter\";s:1:\"c\";s:3:\"web\";}i:3;a:3:{s:1:\"a\";i:5;s:1:\"b\";s:7:\"officer\";s:1:\"c\";s:3:\"web\";}i:4;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:4:\"user\";s:1:\"c\";s:3:\"web\";}i:5;a:3:{s:1:\"a\";i:6;s:1:\"b\";s:14:\"client service\";s:1:\"c\";s:3:\"web\";}}}', 1783396283);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_code` varchar(3) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `company_address` text DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_account_number` varchar(255) DEFAULT NULL,
  `bank_routing_number` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `status` enum('active','inactive','suspended') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `short_code`, `email`, `phone`, `company_name`, `company_address`, `bank_name`, `bank_account_number`, `bank_routing_number`, `contact_person`, `notes`, `status`, `created_at`, `updated_at`) VALUES
(34, 'Nestle', 'NST', 'Tharuki.Jayamanne1@lk.nestle.com', '0765204473', 'Nestle Lanaka PLC', 'No121 TB jayamwatha Colombo 10', NULL, NULL, NULL, 'Thariki Jayamanne', NULL, 'active', '2025-09-26 03:11:16', '2025-10-07 03:48:33'),
(35, 'Delmege', 'DMG', 'Shanaka@delmege.com', '0767732151', 'Delmege Consumner', '101 Vinayalanakara Mawatha Colombo 10', NULL, NULL, NULL, 'Shanaka', NULL, 'active', '2025-09-26 04:13:31', '2025-10-07 03:47:05'),
(38, 'Falcon', 'FLC', 'priyadarshana@akbar.com', '0773087409', 'Falcon Trading Pvt LTD', NULL, NULL, NULL, NULL, 'Sachini Paranagama', NULL, 'active', '2025-10-07 03:45:41', '2025-10-07 03:45:41'),
(39, 'Plently Food Pvt LTD', 'PFL', 'Sisirag.PF@cbllk.com', '0777448858', 'Plently Food Pvt LTD', NULL, NULL, NULL, NULL, 'Sisira Gunawardhana', NULL, 'active', '2025-10-07 03:50:52', '2025-10-07 03:50:52'),
(41, 'Sunshine Holding PLC', 'SUN', 'samadhi.tennakoon@sunshineholdings.lk', '0702942809', 'Sunshine Holding PLC', NULL, NULL, NULL, NULL, 'Samadhi Tennakoon', NULL, 'active', '2026-01-05 23:25:21', '2026-01-14 13:53:40'),
(46, 'Australasian Academy', 'AUS', 'thanushi@australasian.edu.lk', '0719269373', 'Austrlasian Academy', NULL, NULL, NULL, NULL, 'Thanushi Dhananjana', NULL, 'active', '2026-01-05 23:35:43', '2026-01-14 13:27:21'),
(47, 'Lanka Tiles PLC', 'LTP', 'kasthuriR@lankatiles.com', '07777332686', 'Lanka Tiles PLC', NULL, NULL, NULL, NULL, 'Kasthuri Rathnayake', NULL, 'active', '2026-01-05 23:37:39', '2026-01-14 13:29:35'),
(48, 'Haleon Group', 'GSK', 'admin.mindspark@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2026-01-12 12:35:14', '2026-01-12 12:35:14'),
(50, 'Jubilant Foodworks Lanka Pvt. Ltd', 'DOM', 'dasun.yatawara@jublfood.com', '0777330228', 'Domino\'s Pizza', NULL, NULL, NULL, NULL, 'Dasun Yatawara', NULL, 'active', '2026-01-12 12:50:10', '2026-01-14 13:25:12'),
(55, 'Darley Butler', 'DBL', 'admin.mindspk@gmail.com', NULL, 'Darley Butler', NULL, NULL, NULL, NULL, 'Mr Rukshan', NULL, 'active', '2026-01-13 15:49:08', '2026-01-13 15:49:08'),
(56, 'Dailog Finance', 'DIF', 'yasassri.perera@dialog.lk', '0777338873', 'Dailog Finance', NULL, NULL, NULL, NULL, 'Yasassri Perera', NULL, 'active', '2026-01-14 13:10:03', '2026-01-14 13:10:03'),
(57, 'Diamond Best Food', 'DIM', 'ameera.w@bestfood.info', '0703401320', 'Diamond Best Food', '288,dutugamunu mawatha, paliyagoda', NULL, NULL, NULL, 'Mr.Ameera', NULL, 'active', '2026-01-16 19:26:12', '2026-01-16 19:30:20'),
(58, 'Abans Sri Lanka', 'ABA', 'abans@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2026-01-16 20:08:02', '2026-01-16 20:08:02'),
(59, 'Cinoman Life', 'JKH', 'ruchirawi@cinnamonhotels.com', '0762391375', 'Waterfront Properties', NULL, NULL, NULL, NULL, 'Ruchira', NULL, 'active', '2026-01-26 15:15:42', '2026-01-26 15:15:42'),
(60, 'Asliya consultancy', 'ASC', 'asliya@gmail.com', '0772220222', 'Asliya consultancy', NULL, NULL, NULL, NULL, 'Asliya', NULL, 'active', '2026-01-26 16:33:55', '2026-01-26 16:33:55'),
(61, 'Snickers', 'MBM', 'apoorva.sharma@effem.com', '0721937334', 'Maliban Group', NULL, NULL, NULL, NULL, 'Apoorva Sharma', NULL, 'active', '2026-01-27 16:23:40', '2026-01-27 16:23:40'),
(62, 'Link Natural Products (Pvt) Ltd', 'LNK', 'chamari.f@lmp.lk', '0706295190', 'Link Natural', NULL, NULL, NULL, NULL, 'Chamari', NULL, 'active', '2026-01-27 17:34:05', '2026-01-27 17:34:05'),
(63, 'Alsonic', 'ALS', 'accountant@alsoni.lk', '0771216919', 'Alsonic', NULL, NULL, NULL, NULL, 'Mr Piyasara', NULL, 'active', '2026-01-27 18:33:20', '2026-02-02 13:52:33'),
(64, 'Fresh Harvest', 'FRH', 'Fh.Harvest@gmail.com', '0713349145', NULL, NULL, NULL, NULL, NULL, 'Shanya', NULL, 'active', '2026-02-03 13:30:58', '2026-02-03 13:30:58'),
(65, 'Hemas Pharmaceuticals', 'HEM', 'pavithrann.pharma@hemas.com', '77 843 0228', NULL, NULL, NULL, NULL, NULL, 'Mr Pavithran', NULL, 'active', '2026-02-05 13:02:57', '2026-02-05 13:02:57'),
(67, 'Cargils Ceylon', 'CAC', 'chamika.f@cargilsceylon.com', '76 848 3359', 'Cargils Ceylon', NULL, NULL, NULL, NULL, 'Chamika Ferando', NULL, 'active', '2026-02-10 15:09:05', '2026-02-10 15:29:21'),
(68, 'Street Burger', 'STB', 'accountant@st.lk', '0713097880', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2026-02-12 13:10:40', '2026-02-12 13:10:40'),
(69, 'A. Baur & Co. (Pvt.) Ltd.', 'NHL', 'purchasing@baurs.com', '0114732600', NULL, NULL, NULL, NULL, NULL, 'Gehan Seneviratne', NULL, 'active', '2026-02-13 13:15:24', '2026-02-13 13:15:24'),
(70, 'Sozo Beverages Pvt Ltd', 'SOS', 'udaya@sozoiced.com', '0789753180', NULL, NULL, NULL, NULL, NULL, 'Mr Kavidu', NULL, 'active', '2026-02-17 14:11:36', '2026-02-17 14:12:12'),
(71, 'Caltex', 'CAL', 'accounts.cal@gmail.com', '0778701254', 'Caltex', NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2026-02-23 12:32:38', '2026-02-23 12:32:38'),
(72, 'Green Cabin', 'GRB', 'managermarketing@greencabin.lk', '0776147715', 'Cyril Rodrigos Resturant Pvt Ltd', NULL, NULL, NULL, NULL, 'Ms Shehana', NULL, 'active', '2026-03-06 13:18:42', '2026-03-06 13:18:42'),
(73, 'Royal College', 'RYC', 'royal.college@gmail.com', '0713349145', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2026-03-17 12:50:55', '2026-03-17 12:50:55'),
(74, 'ILAA Maldives Pvt Ltd', 'ILM', 'ranga.kahapala@ilaamalidives.com', '+9603355751', 'ILAA Maldives Pvt Ltd', NULL, NULL, NULL, NULL, 'Mr Ranga', NULL, 'active', '2026-04-06 11:55:16', '2026-04-06 11:55:16'),
(75, 'Dimo Lanka', 'DIO', 'accounts.finance@gmail.com', '077528254', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2026-04-22 18:09:05', '2026-04-22 18:09:05'),
(77, 'Lion Max', 'LIM', 'Finance.accounts@gmail.com', '077 895 6365', NULL, NULL, NULL, NULL, NULL, 'Mr', NULL, 'active', '2026-04-27 11:22:11', '2026-04-27 11:22:11'),
(78, 'Country Style Foods (Pvt) Ltd', 'SMA', 'amadhi@smack.lk', '0773157047', 'Country Style Foods (Pvt) Ltd', NULL, NULL, NULL, NULL, 'Amadhi Alahakoon', NULL, 'active', '2026-05-11 17:45:41', '2026-05-20 12:44:30'),
(79, 'Atlas Axillia Company (Private) Limited', 'ATL', 'atlaslanka.accounts@gmail.com', '0764308110', NULL, NULL, NULL, NULL, NULL, 'Sanuja Sundareshan', NULL, 'active', '2026-05-13 12:15:14', '2026-05-19 14:42:45'),
(80, 'Rocell Ceramics Lanka PLC', 'RCL', 'anjalij@rcl.lk', '0776250318', 'Rocell Ceramics Lanka PLC', NULL, NULL, NULL, NULL, 'ANJALI JAYAWARDENA', NULL, 'active', '2026-05-19 14:39:26', '2026-05-19 14:39:26'),
(81, 'Lion Brewery (Ceylon) PLC', 'LIN', 'lionaccounts@gmail.com', '0112465900', 'Lion Brewery (Ceylon) PLC', NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2026-05-26 15:46:04', '2026-05-26 15:46:04'),
(82, 'Ceylon Tobacco Company', 'CTC', 'ceylontabaccoaccounts@gmail.com', '0112496200', 'Ceylon Tobacco Company', NULL, NULL, NULL, NULL, 'Ms Budhima', NULL, 'active', '2026-06-02 12:53:30', '2026-06-02 12:53:30'),
(83, 'Unilever Sri Lanka Limited', 'UNI', 'uniliver@accounts.gmail.com', '0114700800', 'Unilever Sri Lanka Limited', NULL, NULL, NULL, NULL, 'Ms', NULL, 'active', '2026-06-09 11:03:21', '2026-06-09 11:03:21'),
(84, 'Dragons Awards', 'DRA', 'dragonsawards.accounts@gmail.com', '0114700800', 'Dragons Awards', NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2026-06-10 15:27:37', '2026-06-10 15:27:37'),
(90, 'Ceylon Tobacco Company PLC', 'CTP', 'thamaligirihagamaExternal@bat.com', '0770752677', 'Ceylon Tobacco Company PLC', '178 Srimath Ramanathan Mawatha, Colombo 001500', NULL, NULL, NULL, 'Thamali Girihagama', NULL, 'active', '2026-06-16 13:22:23', '2026-06-16 13:22:23'),
(91, 'Pyramid Wilmar (Pvt) Ltd', 'FOR', 'ruchiru@pyramidwilmar.com', '0770892241', 'Pyramid Wilmar (Pvt) Ltd', NULL, NULL, NULL, NULL, 'Mr.Ruchiru Jayarathne', NULL, 'active', '2026-06-16 13:26:16', '2026-06-16 13:26:16'),
(92, 'Flora Food Lanka (PVT) Ltd', 'FFL', 'methuli.perera@florafg.com', '0777187943', 'Flora Food Lanka (PVT) Ltd', NULL, NULL, NULL, NULL, 'Methuli', NULL, 'active', '2026-07-02 01:13:32', '2026-07-02 01:13:32');

-- --------------------------------------------------------

--
-- Table structure for table `coordinators`
--

CREATE TABLE `coordinators` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coordinator_id` varchar(255) NOT NULL,
  `coordinator_name` varchar(255) NOT NULL,
  `nic_no` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_branch_name` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `status` enum('active','inactive','suspended') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coordinators`
--

INSERT INTO `coordinators` (`id`, `coordinator_id`, `coordinator_name`, `nic_no`, `phone_no`, `bank_name`, `bank_branch_name`, `account_number`, `status`, `created_at`, `updated_at`) VALUES
(32, 'COO/001', 'K.V.D Madushani', '198653402420', '0702081358', 'Commercial Bank', 'Makola', '8018882434', 'active', '2026-01-13 16:30:07', '2026-01-13 16:30:07'),
(33, 'COO/002', 'H.A.D.S Parathibhana', '961612314V', '0770072356', 'Commercial Bank', 'Kiribathgoda', '8000532118', 'active', '2026-01-14 11:56:10', '2026-01-14 11:56:10'),
(34, 'COO/003', 'Sharith Dilshan', '825433953V', '0702471093', 'Commercial Bank', 'Puttalam', '8026505950', 'active', '2026-01-14 11:57:25', '2026-01-14 11:57:25'),
(35, 'COO/004', 'Ajith Fernando', '823020350V', '0777966992', 'NSB', 'Pitakote', '101380145173', 'active', '2026-01-14 11:59:43', '2026-01-14 11:59:43'),
(36, 'COO/005', 'B.A Indeewari', '896333194v', '0715169632', '7278', '117', '111754866751', 'active', '2026-01-20 14:42:10', '2026-01-20 14:42:10'),
(37, 'COO/006', 'T.M Pasan', '973550250V', '0779690984', '7056', '33', '8021546057', 'active', '2026-01-20 14:45:55', '2026-01-20 14:45:55'),
(38, 'COO/007', 'M.M.A.N.Danushika Dulanjalie', '946742805V', '0713349145', '7056', '19', '8190037787', 'active', '2026-01-21 18:25:17', '2026-01-21 18:25:17'),
(39, 'COO/008', 'S G MOHANLAL', '802334370 V', '0773319759', '7010', 'KINNIYA', '77038278', 'active', '2026-01-26 14:55:26', '2026-01-26 14:55:26');

-- --------------------------------------------------------

--
-- Table structure for table `custom_jobs`
--

CREATE TABLE `custom_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_number` varchar(255) NOT NULL,
  `job_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `officer_name` varchar(255) DEFAULT NULL,
  `reporter_officer_name` varchar(255) DEFAULT NULL,
  `status` enum('pending','in_progress','completed','cancelled') NOT NULL DEFAULT 'pending',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `default_coordinator_fee` decimal(10,2) DEFAULT NULL,
  `default_hold_for_8_weeks` decimal(10,2) DEFAULT NULL,
  `default_food_allowance` decimal(10,2) DEFAULT NULL,
  `default_accommodation_allowance` decimal(10,2) DEFAULT NULL,
  `default_expenses` decimal(10,2) DEFAULT NULL,
  `default_location` varchar(255) DEFAULT NULL,
  `location_notes` text DEFAULT NULL,
  `allowance` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `officer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reporter_id` bigint(20) UNSIGNED DEFAULT NULL
) ;

--
-- Dumping data for table `custom_jobs`
--

INSERT INTO `custom_jobs` (`id`, `job_number`, `job_name`, `description`, `client_id`, `officer_name`, `reporter_officer_name`, `status`, `start_date`, `end_date`, `default_coordinator_fee`, `default_hold_for_8_weeks`, `default_food_allowance`, `default_accommodation_allowance`, `default_expenses`, `default_location`, `location_notes`, `allowance`, `created_at`, `updated_at`, `officer_id`, `reporter_id`) VALUES
(15, '26/NST/001', 'Nescafe First Cup-Galle Face', NULL, 34, NULL, NULL, 'pending', '2026-01-01', '2026-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[{\"allowance_name\":\"Food Allowance\",\"price\":300}]', '2026-01-05 21:21:05', '2026-01-06 16:47:58', 12, 9),
(16, '26/SUN/002', 'Watawala Tea Sampling -New Year Function', 'Watawala Tea Sampling -New Year Function', 41, NULL, NULL, 'completed', '2026-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-05 23:33:45', '2026-01-05 23:33:45', 7, 11),
(17, '26/AUS/003', 'Australasian Academy Graduation Ceremony 2026', 'January\r\nBMICH\r\nGraduation Ceremony', 46, NULL, NULL, 'in_progress', '2026-01-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-05 23:39:13', '2026-02-13 12:06:26', 16, 11),
(18, '26/LTP/004', 'Lanka Tile Production', 'Lanka Tile Production', 47, NULL, NULL, 'in_progress', '2026-01-05', NULL, 200.00, NULL, NULL, NULL, NULL, NULL, NULL, '[{\"allowance_name\":\"Food Allowance\",\"price\":500},{\"allowance_name\":\"Transport Allowance\",\"price\":750}]', '2026-01-05 23:40:24', '2026-01-14 14:01:01', 12, 11),
(19, '26/NST/005', 'NP Peach Ice Tea-Ram Cinema Activation Jananayagan Film', 'NP Peach Ice Tea-Ram Cinema Activation Jananayagan Film', 34, NULL, NULL, 'in_progress', '2026-01-09', '2026-01-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-05 23:41:43', '2026-01-06 16:38:28', 12, 9),
(20, '26/SUN/006', 'Dainty Ginger Bread House -Voice Over', NULL, 41, NULL, NULL, 'in_progress', '2026-01-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-05 23:43:00', '2026-01-05 23:43:00', 12, 11),
(21, '26/NST/007', 'Srilanka Vs Pakistan Match-Vendor Boy Operation Milo', NULL, 34, NULL, NULL, 'in_progress', '2026-01-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[{\"allowance_name\":\"Transport Allowance\",\"price\":1000}]', '2026-01-05 23:44:33', '2026-01-20 17:20:41', 7, 9),
(22, '26/NST/008', 'One stop Galle Face-January', NULL, 34, NULL, NULL, 'in_progress', '2026-01-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[{\"allowance_name\":\"Transport Allowance\",\"price\":1000}]', '2026-01-05 23:48:51', '2026-01-22 01:57:26', 7, 9),
(23, '26/NST/009', 'One stop Galle Face outlet Marketing Campaign Activity', NULL, 34, NULL, NULL, 'in_progress', '2026-01-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[{\"allowance_name\":\"Additional 1\",\"price\":500,\"multiply_by_attendance\":false},{\"allowance_name\":\"Additional 2\",\"price\":1000,\"multiply_by_attendance\":false}]', '2026-01-05 23:51:09', '2026-01-28 12:14:24', 7, 9),
(25, '26/NST/011', 'Wrist Band Production Ram Cinema Activation', 'Wrist Band Production', 34, NULL, NULL, 'in_progress', '2026-01-09', '2026-01-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-06 12:23:01', '2026-01-06 16:34:13', 12, 9),
(26, '26/DMG/012', 'Photo Glass Frame', 'Photo Glass Frame', 35, NULL, NULL, 'in_progress', '2026-01-06', '2026-01-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-06 12:36:32', '2026-01-09 17:56:27', 19, 9),
(28, '26/SUN/013', 'Sunshine Office -Meeting Setup', 'Sunshine Office -Meeting Setup', 41, NULL, NULL, 'in_progress', '2026-01-07', '2026-01-29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-07 18:40:40', '2026-01-07 18:40:40', 7, 11),
(29, '26/NST/014', 'Nestamalt Dispenser Machine -Asanka', 'Nestamalt Dispenser Machine -Asanka', 34, NULL, NULL, 'cancelled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-07 19:28:26', '2026-02-03 19:53:08', 7, 10),
(30, '26/LTP/015', 'Lanka Tile Greating Printing', 'Lanka Tile Greating Printing', 47, NULL, NULL, 'completed', '2026-01-07', '2026-01-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-07 19:37:02', '2026-01-07 19:37:02', 18, 11),
(31, '26/NST/016', 'Nescafe Gift Pack Raping', 'Nescafe Gift Pack Raping', 34, NULL, NULL, 'in_progress', '2026-01-07', NULL, 200.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-07 20:11:39', '2026-01-13 16:33:56', 17, 10),
(32, '26/NST/017', 'Milkmaid Thaipongal SMMT Outlet Activation (Weekend)', 'Milkmaid Thaipongal SMMT Outlet Activation (Weekend)', 34, NULL, NULL, 'in_progress', '2026-01-07', NULL, 200.00, NULL, NULL, NULL, NULL, NULL, NULL, '[{\"allowance_name\":\"Incentive\",\"price\":1750}]', '2026-01-07 20:14:31', '2026-01-21 18:02:57', 17, 10),
(34, '26/NST/018', 'Srilanka England Match Maggi', 'Srilanka Vs England Match Maggi Cricket board payment', 34, NULL, NULL, 'in_progress', '2026-01-08', '2026-01-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[{\"allowance_name\":\"Transport Allowance\",\"price\":1000}]', '2026-01-08 15:17:16', '2026-02-24 17:08:08', 7, 9),
(35, '26/NST/019', 'Mr Ali Phone Purchasing', NULL, 34, NULL, NULL, 'cancelled', '2026-01-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-09 11:40:04', '2026-02-03 19:52:35', NULL, 10),
(38, '26/GSK/020', 'Iodex Spary Training Program -January', 'Iodex Spary Training Program -January', 48, NULL, NULL, 'in_progress', '2026-01-08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-12 12:46:41', '2026-01-12 12:46:41', 16, 11),
(39, '26/DOM/021', 'Counter Tops Delivery', 'Counter Tops Delivery', 50, NULL, NULL, 'in_progress', '2026-01-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-12 12:57:32', '2026-01-12 12:57:32', 18, 11),
(42, '26/NST/022', 'Maggi Papare Blast D2D Estern -Janaury', 'Maggi Papare Blast D2D E stern -Janaury', 34, NULL, NULL, 'in_progress', '2026-01-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-13 14:42:10', '2026-01-13 14:42:10', 7, 10),
(43, '26/NST/023', 'Maggi Cubes D2D Activation-Jafna (January)', 'Vijitha Food City Maggi ISM outlet Activation', 34, NULL, NULL, 'in_progress', '2026-01-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-13 15:13:52', '2026-01-19 14:37:08', 7, 9),
(44, '26/NST/024', 'Nestomalt D2D 24Girls Eastern Activation-January', 'Nestomalt D2D', 34, NULL, NULL, 'completed', '2026-01-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-13 15:27:26', '2026-01-14 12:52:10', 17, 10),
(45, '26/DOM/025', 'Dominos Pongal Decoration', 'Dominos Pongal Decoration', 50, NULL, NULL, 'in_progress', '2026-01-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-13 15:29:00', '2026-01-13 15:29:00', 18, 11),
(46, '26/DOM/026', 'Christmas Deco Removing 2nd', 'Christmas Deco Removing 2nd', 50, NULL, NULL, 'in_progress', '2026-01-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-13 15:30:25', '2026-01-13 15:30:25', 12, 11),
(47, '26/GSK/027', 'Sensodyne Oral Health Day 2 Nd', 'Oral Health Day', 48, NULL, NULL, 'in_progress', '2026-01-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-13 15:32:28', '2026-01-13 15:32:28', 18, 11),
(48, '26/DBL/028', 'Darly Butlur Teddy Hangers 2000', 'Teddy Hangers 2000', 55, NULL, NULL, 'in_progress', '2026-01-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-13 15:50:25', '2026-01-13 15:50:25', 10, 10),
(49, '26/NST/029', 'Nestamalt Eastern Jet Pack 6 Boys -January', 'Eastern Jet Pack 6 Boys', 34, NULL, NULL, 'in_progress', '2026-01-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-13 15:55:08', '2026-01-13 15:55:08', 13, 10),
(50, '26/NST/030', 'Nestamalt Jet Pack -Kelaniya Temple', 'Jet Pack -Kelaniya Temple', 34, NULL, NULL, 'in_progress', '2026-01-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-13 16:00:10', '2026-01-13 16:00:10', 13, 10),
(51, '26/NST/031', 'Jet Pack Promotion Permenet -Janaury', 'Jet Pack Promotion', 34, NULL, NULL, 'in_progress', '2026-01-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-13 16:01:38', '2026-01-13 16:01:38', 13, 10),
(56, '26/NST/032', 'Onestop Galleface Marketing', 'Onestop Galleface', 34, NULL, NULL, 'cancelled', '2026-01-13', NULL, 200.00, NULL, NULL, NULL, NULL, NULL, NULL, '[{\"allowance_name\":\"Transport Allowance\",\"price\":500}]', '2026-01-16 19:20:37', '2026-01-22 09:26:50', 7, 9),
(57, '26/DIM/033', 'Kiridiwela Purasanda - Chef Payment Roza Pasta', 'Chef Payment Roza Pasta', 57, NULL, NULL, 'in_progress', '2026-01-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-16 19:28:54', '2026-01-16 19:36:25', 7, 11),
(58, '26/GSK/034', 'Iodex branding board installation 3rd phase January cost change 234', 'Iodex branding board installation', 48, NULL, NULL, 'cancelled', '2026-01-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-16 19:34:04', '2026-06-01 17:11:56', 13, 11),
(59, '26/NST/035', 'Valwetithure Kite Festival Jet Pack Promotion - January', 'Valwetithure Kite Festival Jet Pack Promotion - January', 34, NULL, NULL, 'in_progress', '2026-01-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-16 19:40:35', '2026-01-16 19:40:35', 13, 10),
(60, '26/NST/036', 'Nescafe Jet Pack Promotion Permenet - 4 Team', 'Nescafe Jet Pack Promotion Permenet - 4 Team', 34, NULL, NULL, 'in_progress', '2026-01-14', NULL, 200.00, NULL, NULL, NULL, NULL, NULL, NULL, '[{\"allowance_name\":\"water\",\"price\":250,\"multiply_by_attendance\":false}]', '2026-01-16 19:41:48', '2026-01-28 15:23:27', 13, 10),
(61, '26/NST/037', 'Nestomalt Jet Pack Promotion 3 Teams - January', 'Nestomalt Jet Pack Promotion 3 Teams - January', 34, NULL, NULL, 'in_progress', '2026-01-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-16 19:44:01', '2026-01-16 19:44:01', 13, 10),
(62, '26/NST/038', 'Onestop Galleface Permenet Model - January', 'One-stop Galleface Permanent Model - January', 34, NULL, NULL, 'in_progress', '2026-01-01', '2026-01-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-16 19:46:13', '2026-01-16 19:46:13', 7, 9),
(63, '26/NST/039', 'Nestomalt D2D Negombo 5 Girls  - January', 'Nestomalt D2D Negombo 5 Girls  - January', 34, NULL, NULL, 'in_progress', '2026-01-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-16 19:49:14', '2026-01-16 19:49:14', 7, 10),
(64, '26/GSK/040', 'Iodex Spray Hockey Training', 'Hockey Training', 48, NULL, NULL, 'in_progress', '2026-01-16', NULL, 200.00, NULL, NULL, NULL, NULL, NULL, NULL, '[{\"allowance_name\":\"Transport Allowance\",\"price\":500}]', '2026-01-16 19:50:39', '2026-01-20 17:39:33', 12, 11),
(65, '26/NST/041', 'Nestle Peach ISM - Jaffna', 'Nestle Peach ISM - Jaffna', 34, NULL, NULL, 'in_progress', '2026-01-16', NULL, 200.00, NULL, NULL, NULL, NULL, NULL, NULL, '[{\"allowance_name\":\"Food Allowance\",\"price\":500,\"multiply_by_attendance\":false},{\"allowance_name\":\"Transport Allowance\",\"price\":500,\"multiply_by_attendance\":false}]', '2026-01-16 19:55:08', '2026-01-26 15:32:13', 12, 9),
(66, '26/GSK/042', 'PFC Childrens Day Gift Bag Delivery', 'PFC Children\'s Day Gift Bag Delivery', 48, NULL, NULL, 'completed', '2026-01-16', '2026-01-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-16 20:00:40', '2026-01-16 20:00:40', NULL, 11),
(67, '26/ABA/043', 'LG Abans Jeffreybawa Concept', 'LG Abans Jeffreybawa Concept', 58, NULL, NULL, 'in_progress', '2026-01-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-16 20:09:32', '2026-01-16 20:09:32', 18, 11),
(68, '26/NST/044', 'Maggi kite Festival -Jaffna', 'kite Festival -Jaffna', 34, NULL, NULL, 'in_progress', '2026-01-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-19 12:32:56', '2026-01-19 14:08:05', 7, 9),
(69, '26/NST/045', 'Nescafe Jet Pack Permanent Activation Colombo-January', 'Jet Pack Permanent Activation Colombo-January', 34, NULL, NULL, 'in_progress', '2026-01-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-19 13:07:34', '2026-01-19 13:07:34', 13, 10),
(70, '26/NST/046', 'Onestop Jaffna Event', 'Onestop Jaffna Intrenational Tread Fair 2026', 34, NULL, NULL, 'in_progress', '2026-01-22', '2026-01-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-19 13:15:13', '2026-01-28 11:48:19', 7, 9),
(71, '26/NST/047', 'Maggi ISM Outlet Activation January', 'Maggi ISM Outlet 101 Activation', 34, NULL, NULL, 'in_progress', '2026-01-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-19 14:39:00', '2026-01-19 14:39:00', 7, 10),
(72, '26/NST/048', 'Srilanaka Vs England Milo Vender boy Activation', 'Sri Lanka Vs England Milo Vender boy Activation Premadasa and Pallekelle', 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-19 14:50:11', '2026-01-19 14:50:11', 7, 9),
(73, '26/NST/049', 'Srilanka Vs Pakistan maggi', 'Srilanaka Vs Pakistan Cricket Board payment for Maggi', 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-19 14:55:11', '2026-01-19 14:55:11', 7, 9),
(74, '26/DMG/050', 'Backdrop Production', 'January 01st Event Backdrop Production', 35, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-19 15:37:57', '2026-01-19 15:37:57', 7, 9),
(75, '26/NST/051', 'Nestamalt jet pack 4 promoters wayaba-january', 'Nestamalt Jet Pack 4 Promoters Wayaba-january', 34, NULL, NULL, 'in_progress', '2026-01-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-19 16:07:08', '2026-01-19 16:56:06', 13, 10),
(76, '26/NST/052', 'Nestamalt  Jet Pack Trincomale 7 days-January', 'Nestamalt  jet pack trincomale 7 days-january', 34, NULL, NULL, 'in_progress', '2026-01-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-19 16:11:55', '2026-01-19 16:54:12', 13, 10),
(77, '26/NST/053', 'Nestamolt ISM 200 Outlets', 'ISM 200 Outlets', 34, NULL, NULL, 'in_progress', '2026-01-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-19 16:58:35', '2026-01-20 15:27:05', 17, 10),
(79, '26/LTP/054', 'Lanka Tiles Leaflets Printing', '7500 qty ( 13/01/2026)', 47, NULL, NULL, 'in_progress', '2026-01-13', '2026-01-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-20 17:18:47', '2026-01-20 17:34:25', 18, 11),
(80, '26/SUN/055', 'Daintee Rasa Pana Certificate Printing', '16/01/2026 80 qty', 41, NULL, NULL, 'in_progress', '2026-01-16', '2026-01-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-20 18:21:53', '2026-01-20 18:21:53', 18, 11),
(81, '26/LTP/056', 'Lanka Tiles Influencer Payment -Senuri Rupasinghe Ticktok', 'Senuri Rupasinghe Ticktok', 47, NULL, NULL, 'in_progress', '2026-01-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-21 14:05:31', '2026-01-21 14:06:27', NULL, 11),
(82, '26/LTP/057', 'lankatile pelawatta leaflets distribution-january', NULL, 47, NULL, NULL, 'in_progress', '2026-01-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-21 19:46:35', '2026-01-21 19:46:35', 13, 11),
(83, '26/NST/058', 'Maggi SMMT Activation Galle January', 'Galle Hithayath Outlet', 34, NULL, NULL, 'in_progress', '2026-01-14', '2026-01-14', 200.00, NULL, NULL, NULL, NULL, NULL, NULL, '[{\"allowance_name\":\"Transport Allowance\",\"price\":500}]', '2026-01-22 09:36:57', '2026-01-22 09:47:39', 7, 9),
(84, '26/GSK/059', 'Iodex Spray T-Shirt Production', 'Iodex Spray T Shirt - 200 qty\r\nHareen Enterprises', 48, NULL, NULL, 'completed', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-26 13:26:43', '2026-01-26 13:26:43', 16, 11),
(85, '26/JKH/060', '75 Chairs rent', '75 chairs rent for one day delivery date 26th January evening and collecting 27th evening', 59, NULL, NULL, 'in_progress', NULL, '2026-01-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-26 15:17:46', '2026-01-26 15:17:46', 12, 9),
(86, '26/NST/061', 'Milkmaid D 2 D 12 Girls Eastern Activation  (February)', NULL, 34, NULL, NULL, 'in_progress', '2026-02-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-26 15:36:39', '2026-01-26 15:36:39', 17, 10),
(87, '26/NST/062', 'Eastern jetpack activation 5 boys 15 days jan 27', NULL, 34, NULL, NULL, 'in_progress', '2026-01-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-26 16:13:07', '2026-01-26 16:13:07', 13, 10),
(88, '26/NST/063', 'Dispenser rent january', NULL, 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-26 16:15:07', '2026-01-26 16:15:07', 13, 10),
(89, '26/NST/064', 'England Tour Jetpack Promotion', NULL, 34, NULL, NULL, 'in_progress', '2026-01-24', NULL, 200.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-26 16:19:02', '2026-01-28 18:51:28', 13, 10),
(90, '26/NST/065', 'ICC World Cup 1st Round Matches Jet Pack Activation', NULL, 34, NULL, NULL, 'in_progress', '2026-02-08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-26 16:21:15', '2026-01-27 13:12:17', 13, 10),
(91, '26/NST/066', 'Galle Marathon Even February 1', NULL, 34, NULL, NULL, 'in_progress', '2026-02-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-26 16:23:51', '2026-01-27 13:11:45', 13, 10),
(92, '26/ASC/067', 'Asliya Consultancy', 'Asliya consultancy', 60, NULL, NULL, 'in_progress', '2026-01-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-26 16:35:13', '2026-01-26 20:33:10', 16, 11),
(93, '26/SUN/068', 'Sofa Collection', 'Sofa Collection', 41, NULL, NULL, 'in_progress', '2026-01-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-26 17:19:26', '2026-01-26 20:37:05', 29, 11),
(94, '26/NST/069', 'Dispenser Rent Milo Propaganda Truck', 'Dispenser rent Milo Propaganda Truck for 09 days 02 units', 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-26 17:26:19', '2026-01-26 17:26:19', 7, 9),
(95, '26/NST/070', 'Dispenser & Generator rent', 'Dispenser & Generator rent for 03 months to Madhusanka', 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-26 17:31:17', '2026-01-26 17:31:17', 7, 9),
(97, '26/GSK/071', 'Iodex T-Shirt Production', 'Iodex T-Shirt - Crocodile Material, Embroidery\r\n500 qty\r\nHareen Enterprises', 48, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-27 14:16:22', '2026-01-27 14:16:22', 16, 11),
(98, '26/NST/072', 'Milkmaid Ramazan SMMT Outlets Activation', '135 outlets Milkmaid February 20 th march 15 th', 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-27 15:12:56', '2026-01-27 15:12:56', 17, 10),
(99, '26/MBM/073', 'Spikes Asia Awards Entry Submission Payment', 'Spikes Asia Awards Entry Submission Payment', 61, NULL, NULL, 'in_progress', '2026-01-27', '2026-02-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-27 16:24:59', '2026-01-27 16:24:59', 18, NULL),
(100, '26/DOM/074', 'Domino\'s Valentine\'s Valentine\'s Gift Production, Concept Development & Sample', NULL, 50, NULL, NULL, 'completed', '2026-01-19', '2026-01-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-27 18:01:25', '2026-01-27 18:01:25', 18, 11),
(101, '26/DIM/075', 'Roza chef - Madeena Cricket Fiesta', 'January 23,24,25 Siyabalagaskotuwa', 57, NULL, NULL, 'in_progress', '2026-01-23', '2026-01-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-27 18:11:07', '2026-01-27 18:11:07', 7, 11),
(102, '26/DOM/076', 'Domino\'s Coupons Printing & Distribution', 'Coupon Printing-27/01/2026\r\nDistributions -30th Jan/ 1st Feb/3rd Feb', 50, NULL, NULL, 'in_progress', '2026-01-27', '2026-02-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-27 18:17:44', '2026-01-27 18:17:44', 18, 11),
(103, '26/LNK/077', 'Link Sudantha Town Activation January', NULL, 62, NULL, NULL, 'in_progress', '2026-01-02', '2026-01-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-27 18:22:58', '2026-01-28 13:02:15', 17, 10),
(104, '26/ALS/078', 'Alsonic Leaflets campaign - Wiharamahadewi', '24th, 25th Wiharamahadewi', 63, NULL, NULL, 'in_progress', '2026-01-24', '2026-01-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-27 19:00:50', '2026-01-28 11:36:49', 7, 9),
(106, '26/NST/079', 'Maggi Counter Production', '10 units MT sampling counter production for Maggi', 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-28 12:41:01', '2026-01-28 12:41:01', 7, 9),
(107, '26/DOM/080', 'Valentine\"s Flower Decorations Dominos', NULL, 50, NULL, NULL, 'in_progress', '2026-01-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-28 12:47:02', '2026-01-28 12:48:12', 12, 11),
(109, '26/NST/082', 'Onestop Event Galle cancel cost tranfer 085', 'Onestop event Galle 01st Feb Nestomalt Marothen', 34, NULL, NULL, 'cancelled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-28 13:48:55', '2026-05-14 16:31:56', 7, 9),
(110, '26/DOM/083', 'Domino\'s Junior Pizza Maker Dehiwala', NULL, 50, NULL, NULL, 'in_progress', '2026-01-29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-28 17:00:18', '2026-01-28 17:00:18', 12, 11),
(111, '26/NST/084', 'nescafe jet pack permanent activation-february', NULL, 34, NULL, NULL, 'in_progress', '2026-01-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-28 17:29:05', '2026-02-03 12:30:34', 13, 10),
(112, '26/NST/085', 'Onestop Galle Event', 'Nestomalt Marathan - Feb', 34, NULL, NULL, 'in_progress', '2026-01-30', '2026-02-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-29 15:01:15', '2026-03-03 13:32:10', 7, 9),
(113, '26/NST/086', 'Maggi Papare Blast MT Activation', 'Outlet Activation February', 34, NULL, NULL, 'in_progress', '2026-02-06', '2026-02-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-30 11:24:55', '2026-02-09 14:15:21', 7, 9),
(114, '26/NST/087', 'Onestop Shangri-La', 'Onestop Nestle Sales Conference @Shangri-La', 34, NULL, NULL, 'completed', '2026-02-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-02 13:29:31', '2026-02-26 17:07:09', 7, 9),
(115, '26/NST/088', 'Nestomalt Run Sri Lanka- Galle', 'Nestomalt Run Sri Lanka Galle Game Zone', 34, NULL, NULL, 'completed', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-02 13:51:17', '2026-02-04 20:52:17', 7, 9),
(116, '26/NST/089', 'Onestop Harcourt\'s  International  School', 'Onestop Harcourt\'s  International  School', 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-02 14:03:33', '2026-02-02 14:03:33', 7, 9),
(117, '26/SUN/090', 'Zesta Valentine Event', 'Zesta Valentines Event', 41, NULL, NULL, 'in_progress', '2026-02-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-02 14:10:29', '2026-02-02 14:11:11', 18, 11),
(118, '26/NST/091', 'Maggi Kottu & Mikmaid Tea Masters NP', 'Maggi Kottu & Milkmaid tea Master compitition @ Viharamahadevi Park', 34, NULL, NULL, 'in_progress', '2026-02-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-02 16:48:03', '2026-02-04 20:33:55', 12, 9),
(119, '26/FRH/092', 'Fresh Harvest', NULL, 64, NULL, NULL, 'completed', '2026-02-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-03 13:31:58', '2026-02-03 13:31:58', 16, 11),
(120, '26/NST/093', 'Propaganda Payment', 'P&S Activation Propaganda payment jan', 34, NULL, NULL, 'in_progress', '2026-02-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-03 14:09:15', '2026-02-05 11:58:46', 7, 9),
(121, '26/NST/094', 'Milkmaid Ramazan Special Events 2026', NULL, 34, NULL, NULL, 'in_progress', '2026-02-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-03 14:46:15', '2026-02-03 14:46:15', 17, 10),
(122, '26/NST/095', 'JET PACK NAWAM PERAHARA -JAN31', NULL, 34, NULL, NULL, 'in_progress', '2026-01-31', '2026-01-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-05 05:57:17', '2026-02-05 05:57:17', 13, 10),
(123, '26/NST/096', 'JET PACK NAWAM PERAHARA -JAN31', NULL, 34, NULL, NULL, 'in_progress', '2026-01-31', '2026-01-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-05 05:57:20', '2026-02-05 05:57:20', 13, 10),
(124, '26/GSK/097', 'PFC Event -Pharo Nittambuwa', 'PFC Event -Pharo Nittambuwa   2026 February 24', 48, NULL, NULL, 'in_progress', '2026-02-24', '2026-02-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-05 12:14:19', '2026-02-05 12:14:19', 16, 11),
(125, '26/NST/098', '02 unit Dispenser rent Feb', '02 unit dispenser rent for Milo Propaganda truck Feb month', 34, NULL, NULL, 'in_progress', '2026-02-01', '2026-02-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-05 12:31:54', '2026-02-05 12:31:54', 7, 9),
(126, '26/LTP/099', 'Lanka Tiles Artchirct Event stall production', 'Lanka Tiles Architect Event Stall Production', 47, NULL, NULL, 'in_progress', '2026-02-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-05 12:55:07', '2026-02-05 13:32:30', 16, 11),
(127, '26/HEM/100', 'Hemas Pharmaceuticals - Cinnamon Life Product Launch', 'Cinnamon Life Product Launch', 65, NULL, NULL, 'in_progress', '2026-02-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-05 14:10:23', '2026-02-05 14:10:23', 16, 11),
(128, '26/LTP/101', 'Leaflets Printing - Galle outlet', '5000 qty -28/01/2026', 47, NULL, NULL, 'in_progress', '2026-01-28', '2026-01-29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-05 14:19:46', '2026-02-05 14:19:46', 13, 11),
(129, '26/NST/102', 'Derana Viharamahadevi Event', 'Onestop Deanna Viharanmahadevi Event', 34, NULL, NULL, 'in_progress', '2026-02-07', '2026-02-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-05 16:18:07', '2026-02-05 16:18:07', 7, 9),
(130, '26/NST/103', 'T20 World Cup Maggi Payment', 'T20 World Cup Maggi location payment', 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-05 16:43:45', '2026-02-05 16:43:45', NULL, 9),
(131, '26/DIM/104', 'Roza chef - Veyangoda', 'Feb 1st', 57, NULL, NULL, 'in_progress', '2026-01-31', '2026-02-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-05 17:19:30', '2026-02-05 17:19:30', 7, 11),
(132, '26/DIM/105', 'Roza chef - Veyangoda', 'Feb 1st', 57, NULL, NULL, 'in_progress', '2026-01-31', '2026-02-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-05 17:19:31', '2026-02-05 17:19:31', 7, 11),
(133, '26/DIM/106', 'Roza chef - Veyangoda', 'Feb 1st', 57, NULL, NULL, 'in_progress', '2026-01-31', '2026-02-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-05 17:19:34', '2026-02-05 17:19:34', 7, 11),
(134, '26/DIM/107', 'Roza chef - Nawala', '4th Feb', 57, NULL, NULL, 'in_progress', '2026-02-03', '2026-02-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-05 17:20:29', '2026-02-05 17:20:29', 7, 11),
(135, '26/NST/108', 'Onestop Lotus Tower', 'Onestop Lotus tower event', 34, NULL, NULL, 'in_progress', '2026-02-07', '2026-02-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-05 17:22:37', '2026-02-05 17:22:37', 7, 9),
(136, '26/SUN/109', 'Sofa delivery to Swarnawahini', '29th January', 41, NULL, NULL, 'in_progress', '2026-01-28', '2026-01-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-05 17:23:51', '2026-02-05 17:23:51', 7, 11),
(137, '26/NST/110', 'Onestop batti event', NULL, 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-05 17:30:49', '2026-02-05 17:30:49', 7, 9),
(138, '26/NST/111', 'Onestop - Shangri LA', '3rd Feb', 34, NULL, NULL, 'completed', '2026-02-03', '2026-02-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-05 17:39:09', '2026-02-05 17:39:09', 7, 9),
(139, '26/NST/112', 'Nestomalt D 2 D 24 Girls Eastern Activation  February', NULL, 34, NULL, NULL, 'in_progress', '2026-02-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-06 13:17:27', '2026-02-06 13:18:06', 17, 10),
(140, '26/NST/113', 'Data Entry (Machine List)', 'Maggi sampaling & selling MT Activation  -job cost mentioned below job to 26NST086', 34, NULL, NULL, 'cancelled', '2026-02-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-06 14:18:38', '2026-03-31 11:12:51', 17, 9),
(141, '26/GSK/114', 'sensodyne MT outlet Activation-February', '17 outlets', 48, NULL, NULL, 'in_progress', '2026-02-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-06 16:22:31', '2026-02-06 16:22:31', 13, 11),
(142, '26/NST/115', 'Milkmaid Keells outlet Activation-February', 'weeend', 34, NULL, NULL, 'in_progress', '2026-02-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-06 16:47:08', '2026-02-09 12:57:42', 13, 10),
(143, '26/NST/116', 'Jaffna ISM Peach tea Activation Additional', 'Jaffna ISM Peach tea Activation Additional', 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-06 22:31:59', '2026-02-06 22:31:59', 12, 9),
(144, '26/NST/117', 'CS peach tea activation', 'CS peach tea activation', 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-06 23:06:19', '2026-02-06 23:06:19', 7, 9),
(145, '26/NST/118', 'CNV peach tea activation', 'CNV peach tea activation', 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-06 23:10:09', '2026-02-06 23:10:09', 7, 9),
(146, '26/DIM/119', 'Roza & Diomond Harcourts International School Activation', 'Chef & 2 Promo boy', 57, NULL, NULL, 'in_progress', '2026-02-06', '2026-02-08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-09 13:06:36', '2026-02-09 13:06:36', 7, 11),
(147, '26/GSK/120', 'eno Light Board Production', 'Eno Uv light board production & Display Lotus Tower', 48, NULL, NULL, 'completed', '2026-02-07', '2026-02-08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-09 13:16:21', '2026-02-09 13:16:40', 12, 11),
(148, '26/GSK/121', 'iodex spray Sri Lanka foundation Air force Training', 'sri lanka foundation air force training 130 gift packs', 48, NULL, NULL, 'in_progress', '2026-02-07', '2026-02-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-09 13:27:11', '2026-02-09 13:28:20', 12, 11),
(149, '26/NST/122', 'Onestop Aurudu Event', 'Onestop Aurud Event SLECC', 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-09 13:45:38', '2026-02-09 13:45:38', 7, 9),
(150, '26/NST/123', 'Onestop Ramadan SLECC', 'Onestop Ramadan SLECC', 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-09 13:47:17', '2026-02-09 13:47:17', 7, 9),
(151, '26/DIM/124', 'Roza & Diamond Gangarama Activation', 'chef & 3 Promo boy (4 days)', 57, NULL, NULL, 'in_progress', '2026-02-07', '2026-02-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-09 14:10:04', '2026-02-09 14:10:04', 7, 11),
(152, '26/NST/125', 'NP Cricket  Board payment', 'NP Cricket  Board payment T20 World Cup', 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-10 12:14:08', '2026-02-10 12:14:08', 7, 9),
(153, '26/NST/126', 'Salam Ramadan @ Greenpath -One Stop Special Events', 'February 27 & 28th , March 1st', 34, NULL, NULL, 'in_progress', '2026-02-27', '2026-03-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-10 12:32:32', '2026-02-10 12:32:32', 19, 9),
(154, '26/NST/127', 'NP Milkmaid Petta Activation', 'NP Milkmaid Pettha Activation', 34, NULL, NULL, 'in_progress', '2026-02-13', '2026-02-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-10 14:06:45', '2026-02-10 14:06:45', 17, 9),
(155, '26/MBM/128', 'Asia Award Ceramoney Balance Payament', 'Asia Award Ceramoney Balance Payament', 61, NULL, NULL, 'in_progress', '2026-02-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-10 14:19:44', '2026-02-10 14:19:44', 18, 11),
(156, '26/CAC/129', 'Heavenly Ice Cream Valentine\'s Activation', NULL, 67, NULL, NULL, 'in_progress', '2026-02-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-10 15:10:53', '2026-02-10 15:27:58', 12, 11),
(157, '26/NST/130', 'Maggi Vender Boy Unit Production', 'Maggi Vender Boy Unit Production', 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-10 18:02:38', '2026-02-10 18:02:38', 7, 9),
(158, '26/NST/131', 'Onestop Batticaloa trade fair activation', 'onestop 13th, 14th, 15th Feb', 34, NULL, NULL, 'in_progress', '2026-02-12', '2026-02-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-10 18:26:18', '2026-02-10 18:26:18', 7, 9),
(159, '26/NST/132', 'gangarama jetpack  activation-feb', 'gangarama temple jet pack  activation', 34, NULL, NULL, 'in_progress', '2026-02-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-10 19:32:57', '2026-02-11 19:40:25', 13, 10),
(160, '26/NST/133', 'Maggi Cubes D to D - Kalmune', 'cubes D to D Kalmune February - pradeep', 34, NULL, NULL, 'in_progress', '2026-02-11', '2026-03-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-11 12:34:46', '2026-02-11 12:34:46', 7, 10),
(161, '26/DOM/134', 'Hiru Mage Adare Tv Program -Models Hiring', '2 girls -11/02/2026', 50, NULL, NULL, 'in_progress', '2026-02-11', '2026-02-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-11 16:00:25', '2026-02-11 16:00:25', 18, 11),
(162, '26/NST/135', 'Nescafe sampling Activation', 'Nawam mawatha', 34, NULL, NULL, 'in_progress', '2026-02-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-11 16:02:04', '2026-02-11 16:02:04', 17, 9),
(163, '26/NST/136', 'nescafe arpico outlet  activation-february', NULL, 34, NULL, NULL, 'in_progress', '2026-02-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-11 19:01:28', '2026-02-11 19:01:28', 13, 10),
(164, '26/DOM/137', 'Menu Card Printing BIA', '05/02/2026 - 2 Menu cards', 50, NULL, NULL, 'in_progress', '2026-02-05', '2026-02-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-11 19:32:14', '2026-02-11 19:32:14', 18, 11),
(165, '26/NST/138', 'Gangarama vendor boy activation -feb', 'gangarama temple vendor boy', 34, NULL, NULL, 'in_progress', '2026-02-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-11 19:42:45', '2026-02-11 19:42:45', 13, 10),
(166, '26/STB/139', 'Street Burger Direction Board Fix', 'Street Burger Direction Board Fix', 68, NULL, NULL, 'in_progress', '2026-02-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-12 13:13:36', '2026-02-12 13:13:36', 12, 9),
(167, '26/LTP/140', 'Lanka Tiles BMICH Training Event', 'BMICH\r\n7th of February', 47, NULL, NULL, 'completed', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-12 14:26:33', '2026-02-12 14:26:33', 16, 11),
(168, '26/LTP/141', 'Lanka Tiles Kingsbury Hotel Event', '13/02/2025', 47, NULL, NULL, 'in_progress', '2026-02-13', '2026-02-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-12 14:39:05', '2026-02-12 14:39:05', 12, 11),
(169, '26/NST/142', 'Colombo Municipal Marathon Payment  Asanka', 'Municipal Marathon Payment', 34, NULL, NULL, 'in_progress', '2026-02-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-12 15:54:33', '2026-02-12 15:54:33', 29, 10),
(170, '26/DIM/143', 'Zara tea MT activation - February', 'SPAR outlet', 57, NULL, NULL, 'in_progress', '2026-02-13', '2026-02-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-12 19:35:55', '2026-02-12 19:35:55', 7, 11),
(171, '26/NHL/144', 'Resourse Diabetic Pharmacy Activation', 'Resourse Diabetic Pharmacy Activation', 69, NULL, NULL, 'in_progress', '2026-02-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-13 13:16:35', '2026-02-13 13:16:35', 18, 11),
(172, '26/NST/145', 'One Stop -Viharamadevi Marathan', 'Viharamadevi Marathan', 34, NULL, NULL, 'in_progress', '2026-02-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-13 15:36:35', '2026-02-13 15:36:35', 7, 9),
(173, '26/NST/146', 'Vinada Np Payment', 'Vinada Np Payment', 34, NULL, NULL, 'completed', '2026-02-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-16 13:36:08', '2026-02-18 22:52:53', 29, 9),
(174, '26/GSK/147', 'Light Board fixing Solis pitakotte', '% light Board Fixing & Removing 2 boys & 1 lorry', 48, NULL, NULL, 'in_progress', '2026-02-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-16 15:17:55', '2026-02-16 15:17:55', 12, 11),
(175, '26/NST/148', 'Chiller Machine 3 Rent For Netamalt February', 'Chiller Machine 3 Rent For Netamalt February', 34, NULL, NULL, 'in_progress', '2026-02-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-16 16:35:24', '2026-02-16 16:35:57', 13, 10),
(176, '26/NST/149', 'Milo vendor boy - permanent February Cost tranfer 26/NST/392', 'Permanent February', 34, NULL, NULL, 'cancelled', '2026-02-16', '2026-02-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-16 17:28:55', '2026-05-26 12:42:31', 7, 9),
(177, '26/CAC/150', 'Ride Iron Man Activation', 'Ride Iron', 67, NULL, NULL, 'in_progress', '2026-02-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-16 17:45:21', '2026-02-16 17:45:21', 12, 11),
(178, '26/NST/151', 'Maggi Papare blast - Siripade operation', 'MOP activation -February', 34, NULL, NULL, 'in_progress', '2026-02-16', '2026-02-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-16 18:27:01', '2026-02-16 18:27:01', 7, 9),
(179, '26/NST/152', 'Viharamahadevi Nestamalt Marathan-February', 'Viharamahadevi Nestamalt Marathan-February', 34, NULL, NULL, 'in_progress', '2026-02-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-16 18:44:53', '2026-02-16 18:44:53', 13, 10),
(180, '26/NST/153', 'Milkmaid mt outlet Activation-Febraury', 'Milkmaid Arpico Activation with chiller\r\n-Febraury,march,april', 34, NULL, NULL, 'in_progress', '2026-02-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-16 18:48:41', '2026-03-25 11:54:46', 13, 10),
(181, '26/DOM/154', 'Domino\'s Vouchers Printing', '15 Vouchers & Envelops Printing ( 10th of Feb)', 50, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-16 19:23:19', '2026-02-16 19:23:19', 18, 11),
(182, '26/NST/155', 'Ceregrow Keells Activation - February', '14th,15th week', 34, NULL, NULL, 'in_progress', '2026-02-13', '2026-02-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-17 11:09:08', '2026-02-17 11:09:08', 7, 9),
(183, '26/SOS/163', 'Sozo activation - Cinnamon lake', '13th,14th & 15th Feb', 70, NULL, NULL, 'in_progress', '2026-02-12', '2026-02-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-17 11:12:21', '2026-02-17 14:22:48', 7, 9),
(184, '26/NST/157', 'Milo Mascot boy - Campbell Park', '14th Feb', 34, NULL, NULL, 'completed', '2026-02-13', '2026-02-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-17 11:22:15', '2026-02-17 11:22:15', 7, 9),
(185, '26/DIM/159', 'Roza Activation - Cargills February', 'February month', 57, NULL, NULL, 'in_progress', '2026-02-20', '2026-02-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-17 11:22:16', '2026-02-17 11:26:18', 7, 11),
(186, '26/CAC/160', 'Kotmale Stall Production', '19/02/2026 Event', 67, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-17 13:08:40', '2026-02-17 13:08:40', 12, 11),
(187, '26/NST/161', 'Maggi Kootu Master & Milkmaid Tea Master Additional Cost', 'Maggi Kootu Master & Milkmaid Tea Master Additional Cost', 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-17 13:42:40', '2026-02-17 13:42:40', 12, 9),
(188, '26/NST/162', 'Onestop Thalawila Charch Feast - March', '6th, 7th, 8th of March', 34, NULL, NULL, 'in_progress', '2026-03-04', '2026-03-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-17 14:08:08', '2026-02-17 14:08:08', 7, 9),
(189, '26/NST/164', 'Jet Packk Permenet Nestammalt Promotion February', 'Jet Packk Permanent Promotion February', 34, NULL, NULL, 'in_progress', '2026-02-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-17 14:26:45', '2026-03-12 13:51:43', 13, 10),
(190, '26/NST/165', 'Ceregrow keells Activation 21st &22nd Feb', 'Ceregrow keells Activation 21st &22nd Feb', 34, NULL, NULL, 'in_progress', '2026-02-21', '2026-02-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-17 15:40:21', '2026-02-17 15:40:21', 7, 9),
(191, '26/NST/166', 'OneStop Galle Tender Process cost 26/NST/474', 'Leasing of Galle Heritage Emporium-Block E shop space on monthly rental basis - Invitation to Bidders', 34, NULL, NULL, 'cancelled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-17 17:32:38', '2026-06-17 12:20:20', 19, 9),
(192, '26/HEM/167', 'UpToDate Subscription - Dr. Thurul Attygalle', 'Subscription\r\nUSD Purchase\r\nStamp Duty 4%', 65, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-17 21:04:14', '2026-02-17 21:04:14', 16, 11),
(193, '26/HEM/168', 'APCO Doctor Sponsorship Payment Dr Kehelambi', 'Dr. Payment', 65, NULL, NULL, 'completed', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-17 21:07:54', '2026-02-17 21:07:54', 16, 11),
(194, '26/NST/169', 'milkmaid branding Fort Railway station', 'Base 30 Fixing & Removing Display charge Base Charge', 34, NULL, NULL, 'in_progress', '2026-02-12', '2026-02-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 12:27:53', '2026-02-18 12:27:53', 12, 9),
(195, '26/DIM/170', 'Roza chef - Delgoda', '15th February', 57, NULL, NULL, 'in_progress', '2026-02-14', '2026-02-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 14:06:51', '2026-02-18 14:06:51', 7, 11),
(196, '26/DIM/171', 'Roza chef - Pilimathlawa', '17th February', 57, NULL, NULL, 'in_progress', '2026-02-16', '2026-02-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 14:08:00', '2026-02-18 14:08:00', 7, 11),
(197, '26/DIM/172', 'Roza chef - Rabukkana', '18th February', 57, NULL, NULL, 'in_progress', '2026-02-17', '2026-02-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 14:09:15', '2026-02-18 14:09:15', 7, 11),
(198, '26/DOM/173', 'Dominos Backdrop & Light board Fixing Sirasa Rathmalana', 'Light Board & Backdrop delivery to  Sirasa Rathmalana Lorry, 2nd day One Light Board re branding lorry one boy', 50, NULL, NULL, 'in_progress', '2026-02-15', '2026-02-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 14:53:39', '2026-02-18 14:53:39', 12, 11),
(199, '26/NST/174', 'Nescafe MT Activation (Negombo)', 'Arpico & spar outlets', 34, NULL, NULL, 'in_progress', '2026-02-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 16:14:33', '2026-02-18 16:14:33', 17, 10),
(200, '26/NST/175', 'One Stop Galleface Permenent Model - February', NULL, 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 18:28:30', '2026-02-18 18:28:30', 19, 9),
(201, '26/NST/176', 'Sticker Pasting - Maggi CMP', NULL, 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 18:32:09', '2026-02-18 18:32:09', 19, 10),
(202, '26/NST/177', 'Onestop Matara book fair', '20th to 26th Feb', 34, NULL, NULL, 'in_progress', '2026-02-19', '2026-02-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 19:20:51', '2026-02-18 19:20:51', 7, 9),
(203, '26/GSK/178', 'Ride Colombo \'26', 'Iodex Spray \"Official Pain Relief Partner\" Sponsorship\r\nGalle Face Green\r\n7th of March \'26\r\nFemale Cycling Event', 48, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 19:24:12', '2026-02-18 19:30:54', 16, 11),
(204, '26/HEM/179', 'Vastarel MR Launch Event  26/HEM/100', 'Cinnamon Life Colombo\r\n24th of April', 65, NULL, NULL, 'cancelled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 19:26:47', '2026-06-09 17:10:07', 16, 11),
(205, '26/NST/180', '02 Units Dispenser rent In Feb Month', '02 Units Dispenser rent In Feb Month Milo Propaganda truck Roshan & Tharidu', 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 22:24:44', '2026-02-18 22:24:44', 7, 9),
(206, '26/DIM/181', 'Roza Cargills - Feb', 'Cargills activation', 57, NULL, NULL, 'in_progress', '2026-02-19', '2026-02-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-19 19:06:44', '2026-02-23 19:01:46', 7, 11),
(207, '26/DIM/182', 'Roza Cargills - Feb', 'Cargills activation', 57, NULL, NULL, 'in_progress', '2026-02-19', '2026-02-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-19 19:06:56', '2026-02-23 14:06:57', 7, 11),
(208, '26/NST/183', 'Onestop Galle is gold', '21st Feb', 34, NULL, NULL, 'in_progress', '2026-02-19', '2026-02-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-19 19:09:18', '2026-02-19 19:09:18', 7, 9),
(209, '26/NST/184', 'Onestop Negombo food festival', 'Browns Beach food festival 27th, 28th, 29th March', 34, NULL, NULL, 'in_progress', '2026-03-26', '2026-03-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-23 11:40:52', '2026-03-30 14:20:39', 7, 9),
(210, '26/DOM/185', 'Dominos junior pizza Maker Malabe', NULL, 50, NULL, NULL, 'in_progress', '2026-02-23', '2026-02-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-23 12:40:25', '2026-02-23 12:40:25', 12, 11),
(211, '26/GSK/186', 'iodex spray press conference cinnamon life', '2 light board fixing & Removing 1 Lorry , 2 boy', 48, NULL, NULL, 'in_progress', '2026-02-23', '2026-03-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-23 12:43:02', '2026-02-23 12:43:02', 12, 11),
(212, '26/DBL/187', 'Darly Butlur Teddy Mascot Payment', 'Teddy Mascot Payment', 55, NULL, NULL, 'in_progress', '2026-02-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-23 16:10:28', '2026-02-23 16:10:28', 18, 10),
(213, '26/NST/188', 'Maggi Batticaloa Event', '13th,14th,15th 0f February 2026', 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 13:49:00', '2026-02-24 13:49:00', 19, 9),
(214, '26/NST/189', 'Maggi Ramadan Event SLECC', 'Ramadan Shopping Festival 11th to 15th March', 34, NULL, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 13:50:57', '2026-02-24 13:50:57', 19, 9),
(215, '26/NST/190', 'Maggi Avurudu Event SLECC', 'Avurudu Shopping Festival 2026 (02nd to 11th April)', 34, NULL, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 13:53:28', '2026-02-24 13:53:28', 19, 9),
(216, '26/NST/191', 'Maggi Negombo Food Festival', 'March 17,28,29 @ Negombo Browns Beach', 34, NULL, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 13:56:28', '2026-02-24 13:56:28', 19, 9),
(217, '26/NST/192', 'Ceregrow Keells - Feb 2nd week', '21st, 22nd Feb', 34, NULL, NULL, 'in_progress', '2026-02-21', '2026-02-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 16:36:22', '2026-03-03 12:21:16', 7, 9),
(218, '26/NST/193', 'Maggi supplier Payment Galle Lion', 'Maggi supplier Payment Galle Lion -Payment For Kasun', 34, NULL, NULL, 'in_progress', '2026-02-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 17:25:12', '2026-02-24 17:25:12', 29, 9),
(219, '26/GSK/194', 'Iodex Spray T Shirt Printing Final Batch', 'Hareen Enterprises\r\nTotal Qty 270 (150 invoice & 120 invoice)\r\nWetlook Material with Print', 48, NULL, NULL, 'completed', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 19:49:08', '2026-02-24 19:49:08', 16, 11),
(220, '26/GSK/195', 'Iodex Spary Niners Sixers Cricket Tournement', 'Iodex Spary Niners Sixers Cricket Tournement', 48, NULL, NULL, 'in_progress', '2026-02-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-24 22:00:15', '2026-02-24 22:00:15', 16, 11),
(221, '26/NST/196', 'Galle face Onestop 50% Coupon Delivery', '19th Feb Started Monday to Thursday', 34, NULL, NULL, 'in_progress', '2026-02-19', '2026-03-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-25 11:05:51', '2026-02-25 14:41:41', 7, 9),
(222, '26/NST/197', 'Galle face onestop match activity 19th February', 'T20 match', 34, NULL, NULL, 'in_progress', '2026-02-18', '2026-02-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-25 11:12:45', '2026-02-25 11:12:45', 7, 9),
(223, '26/LTP/198', 'Lanka Tile Banner Production 55% & 60% Off', 'Banner 200 & Tow Lorry Two Time Use 2 Labour', 47, NULL, NULL, 'in_progress', '2026-02-23', '2026-03-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-25 12:21:45', '2026-02-25 12:21:45', 12, 11),
(224, '26/NST/199', 'Maggi Ederamulla Church Payment', 'Maggi Ederamulla Church Payment request by Kasun 250000', 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-25 13:33:47', '2026-02-25 13:33:47', 29, 9),
(225, '26/NST/200', 'Maggi Gangarama Location Fee paymnet', 'Maggi Gangarama Location Fee payment request by Kasun Maggi 420000', 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-25 13:45:05', '2026-02-25 13:45:05', 29, 9),
(226, '26/NST/201', 'Galle face Onestop Marketing Campaign  6 month', 'Galle face Onestop Marketing Campaign  6 month Friday Saturday and Sunday starting  feb', 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-25 14:40:13', '2026-02-25 14:40:13', 7, 9),
(227, '26/DOM/202', 'Counter Tops Delivery - BIA', 'February \r\n20/02/2026 & 24/02/2026', 50, NULL, NULL, 'in_progress', '2026-02-20', '2026-02-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-25 15:54:08', '2026-02-25 15:54:08', 18, 11),
(228, '26/GSK/203', 'Iodex Spary Braning Board Installation -3rd Phase', 'Indoor Stadium', 48, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-25 15:57:25', '2026-02-25 15:57:25', 18, 11);
INSERT INTO `custom_jobs` (`id`, `job_number`, `job_name`, `description`, `client_id`, `officer_name`, `reporter_officer_name`, `status`, `start_date`, `end_date`, `default_coordinator_fee`, `default_hold_for_8_weeks`, `default_food_allowance`, `default_accommodation_allowance`, `default_expenses`, `default_location`, `location_notes`, `allowance`, `created_at`, `updated_at`, `officer_id`, `reporter_id`) VALUES
(229, '26/NST/204', 'negombo jet pack activation feb23-feb', NULL, 34, NULL, NULL, 'in_progress', '2026-02-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-25 19:14:43', '2026-02-25 19:14:43', 17, 10),
(230, '26/NST/205', 'Nestamalt Barcode Pasting', 'Nestamalt Barcode Pasting', 34, NULL, NULL, 'in_progress', '2026-02-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-25 20:15:35', '2026-02-25 20:15:35', 17, 10),
(231, '26/NST/206', 'Nestomalt jetpack activation gampaha,galle & abilipitiya', NULL, 34, NULL, NULL, 'in_progress', '2026-02-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-26 01:17:33', '2026-02-26 01:17:33', 13, 10),
(232, '26/DIM/207', 'Diamond Salam Raamadaan Event - Greenpath', '27th, 28th February & 1st March', 57, NULL, NULL, 'in_progress', '2026-02-26', '2026-03-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-26 11:09:43', '2026-02-26 11:09:43', 7, 11),
(233, '26/DIF/208', 'Dialog Genie app promotion kurunegala-feb', NULL, 56, NULL, NULL, 'in_progress', '2026-02-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-26 11:53:37', '2026-02-26 11:53:37', 13, 9),
(234, '26/DBL/209', 'Coupon Box Production', 'Coupon Box Printing\r\n30 qty\r\nAdroit Graphics', 55, NULL, NULL, 'completed', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-26 11:56:57', '2026-02-26 11:56:57', 16, 10),
(235, '26/DBL/210', 'X Pennant Production', 'X Pennant Printing\r\n30 qty\r\nAdroit Graphics - Unsuccessful (No Payment)\r\nDT - Completed Order\r\nShehan Delivery to Gangoda', 55, NULL, NULL, 'completed', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-26 11:57:59', '2026-03-04 14:36:14', 16, 10),
(236, '26/NST/211', 'Nestamalt Kelaniya Temple Kasun Payment', NULL, 34, NULL, NULL, 'in_progress', '2026-02-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-26 15:04:16', '2026-02-26 15:04:16', 29, 10),
(237, '26/LTP/212', 'lankatile pelawatta flag fixing and removing-feb', NULL, 47, NULL, NULL, 'in_progress', '2026-02-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-26 15:05:51', '2026-02-26 15:05:51', 13, 11),
(238, '26/STB/213', 'street Burger Direction Board RD Payment', 'street Burger Direction Board RD Payment', 68, NULL, NULL, 'in_progress', '2026-02-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-26 15:22:11', '2026-02-26 15:22:11', 12, 9),
(239, '26/NST/214', 'NP Supplier Payment Daishika', 'NP Supplier Payment Daishika', 34, NULL, NULL, 'cancelled', '2026-02-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-26 15:23:06', '2026-04-29 11:32:22', 29, 9),
(240, '26/GSK/215', 'iodex spary srilanka foundation', 'iodex spray Sri lanka foundation Training program Field-Site First Aid in Sports Acute Injury Management', 48, NULL, NULL, 'in_progress', '2026-02-25', '2026-03-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-26 15:46:01', '2026-02-26 15:46:01', 12, 11),
(241, '26/NST/216', 'NESTLE 4 CHAIR DELIVERY-FEB', NULL, 34, NULL, NULL, 'in_progress', '2026-02-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-26 16:42:50', '2026-02-26 16:42:50', 13, 10),
(242, '26/DMG/217', 'Photoframe Handover to Delmege', 'Photo frame & handover', 35, NULL, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-27 15:13:33', '2026-02-27 15:13:33', 19, 9),
(243, '26/NST/218', 'Nescafe Np Sri Pada Activation', 'Nescafe Np Sri pada Activation \r\n2 Boy \r\n1 Announcer\r\n1 supervisor\r\njbl  sound\r\ncameramen\r\nvehicle 1', 34, NULL, NULL, 'in_progress', '2026-02-27', '2026-03-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-03 11:44:49', '2026-03-03 11:44:49', 12, 9),
(244, '26/NST/219', 'Iftar Event NP', 'Iftar event supplier payment NP Shanika', 34, NULL, NULL, 'in_progress', '2026-03-03', '2026-03-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-03 12:05:55', '2026-03-05 13:51:10', 29, 9),
(245, '26/NST/220', 'Ceregrow Keells Activation - February', '3rd weekend', 34, NULL, NULL, 'in_progress', '2026-02-26', '2026-03-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-03 13:23:01', '2026-03-03 13:23:01', 7, 9),
(246, '26/NST/221', 'Milkmaid Sampling Indian High Commissional Event', '1st March Airport Garden hotel Seeduwa', 34, NULL, NULL, 'in_progress', '2026-03-01', '2026-03-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-03 14:32:49', '2026-03-03 14:32:49', 7, 9),
(247, '26/GSK/222', 'Eno Dry Sampling - Colombo Mousque', '27th February', 48, NULL, NULL, 'in_progress', '2026-02-26', '2026-02-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-03 14:35:59', '2026-03-03 14:35:59', 7, 11),
(248, '26/NST/223', '02 Milo Unit Dispenser Rent March', '02 Milo Unit Dispenser Rent March', 34, NULL, NULL, 'in_progress', '2026-03-01', '2026-03-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-03 14:57:11', '2026-03-03 14:57:11', 7, 9),
(249, '26/NST/224', 'Milkmaid MT Outlet Dessert Table Activation -Mar to April', 'Arpico and laugfs', 34, NULL, NULL, 'in_progress', '2026-03-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-03 15:21:30', '2026-03-31 13:31:32', 13, 10),
(250, '26/NST/225', 'ncc nestomalt marathon -feb', NULL, 34, NULL, NULL, 'in_progress', '2026-02-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-03 16:06:09', '2026-03-11 17:40:52', 13, 10),
(251, '26/NST/226', 'kollupitiya nestomalt marathon activation-mar01', NULL, 34, NULL, NULL, 'in_progress', '2026-03-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-03 16:08:22', '2026-03-03 16:32:18', 13, 10),
(252, '26/NST/227', 'Nescafe jetpack activation eastern & jaffna-feb', NULL, 34, NULL, NULL, 'in_progress', '2026-03-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-03 18:15:16', '2026-03-03 18:15:16', 13, 10),
(253, '26/NST/228', 'nescafe jetpack activation kuliyapitiya perahara', NULL, 34, NULL, NULL, 'in_progress', '2026-03-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-03 19:00:31', '2026-03-03 19:00:31', 13, 10),
(255, '26/NST/229', 'Nestamalt Street Promotion Colombo-Sponshership 380', 'Nestamalt Street Promotion Colombo-Sponshership 380\r\nKasun And Hiranya', 34, NULL, NULL, 'in_progress', '2026-03-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-03 19:16:03', '2026-03-05 15:02:32', 13, 10),
(256, '26/NST/230', 'street Promotion Eastern -Maggi Nuddles Feb', 'street Promotion Eastern -Maggi Nuddles Feb', 34, NULL, NULL, 'in_progress', '2026-03-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-03 19:51:44', '2026-03-03 19:51:44', 7, 10),
(257, '26/DMG/231', 'Motha Light board fixing and removing - Monarch Imperial', 'SLIM Award ceremony 03rd March', 35, NULL, NULL, 'in_progress', '2026-03-02', '2026-03-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-04 12:44:06', '2026-03-04 12:44:06', 7, 9),
(258, '26/SUN/232', 'Milady toffee bowls arrangement - SLIM Awards', 'Monarch Iperial 03rd March', 41, NULL, NULL, 'in_progress', '2026-03-02', '2026-03-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-04 12:57:08', '2026-03-04 12:57:08', 7, 11),
(259, '26/NST/233', 'Nescafe NP Dompe Machine Clean-Job Cost Tranfer 26/NST/359', '4 Boys', 34, NULL, NULL, 'in_progress', '2026-03-04', '2026-03-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-04 14:14:57', '2026-04-06 16:30:44', 12, 9),
(260, '26/FRH/234', 'Fresh Harvest Social Media Feb \'26', 'Social Media Handling Facebook & Instagram\r\nAnuradha', 64, NULL, NULL, 'completed', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-04 14:23:19', '2026-03-04 14:23:19', 16, 11),
(261, '26/NST/235', 'Baththaramulla Sadathanna DB point GIFT Wrapping and anchana sponshership payment', NULL, 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-04 14:28:23', '2026-03-05 15:05:33', 17, 10),
(262, '26/CAL/236', 'Caltex Event - Embilipitiya', '04th March', 71, NULL, NULL, 'in_progress', '2026-03-03', '2026-03-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-04 14:38:03', '2026-03-04 14:38:03', 7, 11),
(263, '26/NST/237', 'OneStop Airforce Event Rathmalana', 'March   6th  / 7th  /8th', 34, NULL, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-04 14:40:04', '2026-03-04 14:40:04', 19, 9),
(264, '26/GSK/238', 'Iodex training program Field-Site First Aid in Sports Acute Injury Manage Field-Site First Aid in Sports Acute Injury Management  sri lanka foundation', '2 boy \r\n1 supervisor\r\n10 flags\r\n2 light board\r\n1 lorry', 48, NULL, NULL, 'in_progress', '2026-02-21', '2026-03-08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-04 15:08:28', '2026-03-05 13:52:32', 12, 11),
(265, '26/LNK/239', 'Link sudantha town Activation February', NULL, 62, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-04 18:30:10', '2026-03-04 18:30:10', 17, 10),
(266, '26/NST/240', 'Milkmaid & Nescafe Gold Selling  Activation (GREENPATH)', NULL, 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-05 01:52:50', '2026-03-05 01:52:50', 17, 10),
(267, '26/NST/241', 'Milo Vendor boy  operation - Galle big match', '6th, 7th March Big match', 34, NULL, NULL, 'in_progress', '2026-03-05', '2026-03-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-05 12:45:18', '2026-03-09 16:59:29', 7, 9),
(268, '26/NST/242', 'Maggi Cubes And Rasamausu  D2D-Eastern March', 'Maggi Cubes And Rasamausu  D2D-Eastern March 20 Days.(7th to 26th', 34, NULL, NULL, 'in_progress', '2026-03-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-05 12:56:12', '2026-03-26 11:33:43', 7, 9),
(270, '26/NST/244', 'Avurudu Gemi Gedara Production', NULL, 34, NULL, NULL, 'in_progress', '2026-03-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-05 14:02:36', '2026-03-05 14:02:36', 7, 9),
(271, '26/NST/245', 'Chiller Machine 3 Rent For Netamalt March', 'Chiller Machine 3 Rent For Netamalt March', 34, NULL, NULL, 'in_progress', '2026-03-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-05 15:59:39', '2026-03-05 15:59:39', 13, 10),
(272, '26/DOM/246', 'Dominos Lolipop Sign', 'Lolipop Sign', 50, NULL, NULL, 'in_progress', '2026-03-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-05 18:02:14', '2026-03-05 18:02:14', 29, 11),
(273, '26/DOM/247', 'Dominos Toys Unit Sample Production', 'Dominos Toys Unit Sample Production', 50, NULL, NULL, 'in_progress', '2026-03-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-05 18:03:29', '2026-03-05 18:03:29', 29, 11),
(274, '26/LTP/248', 'Lanka Tile BMICH Event-Compere Payment', 'Lanka Tile BMICH Event-Compere Payment', 47, NULL, NULL, 'in_progress', '2026-03-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-06 13:03:45', '2026-03-06 13:03:45', 18, 11),
(275, '26/GRB/249', 'St\' Thomas College - Big Match', 'St\' Thomas College Mt Laviniya - 12,13,14th March @ SSC', 72, NULL, NULL, 'in_progress', '2026-03-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-06 13:21:05', '2026-03-06 13:27:38', 19, 9),
(276, '26/NST/250', 'nestomalt marathon independence square -mar 8', NULL, 34, NULL, NULL, 'in_progress', '2026-03-08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-06 16:23:03', '2026-03-06 16:23:58', 13, 10),
(277, '26/NST/251', 'Nescafe gift box Purchasing', NULL, 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-07 13:54:11', '2026-03-07 13:54:11', 17, 10),
(278, '26/NST/252', 'Ceregrow Keells Activation - March', '4th week', 34, NULL, NULL, 'in_progress', '2026-03-06', '2026-03-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-09 11:52:46', '2026-03-09 11:52:46', 7, 9),
(279, '26/NST/253', 'Ceregrow Activation - ISM 1st Weekend', '6th, 7th, 8th March', 34, NULL, NULL, 'in_progress', '2026-03-05', '2026-04-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-09 11:58:01', '2026-03-16 18:15:34', 7, 9),
(280, '26/DOM/254', 'Balloons unit  Delivery', '2 balloon unit delivery Nawala & Pita Kotte', 50, NULL, NULL, 'in_progress', '2026-03-06', '2026-03-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-09 16:33:12', '2026-03-09 16:33:12', 12, 11),
(281, '26/DOM/255', 'Dominos sales Stall salika Ground DFCC event', 'Dominos Sales Stall Fixing & Removing Lorry Payment & labor Cost Rs 36000/', 50, NULL, NULL, 'in_progress', '2026-03-07', '2026-03-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-09 16:47:12', '2026-03-09 16:47:12', 12, 11),
(282, '26/NST/256', 'Milo Vendor boy operation - Colombo big match thirston Isipathana', '8th March(Pee sara)', 34, NULL, NULL, 'in_progress', '2026-03-08', '2026-03-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-09 16:57:21', '2026-05-14 16:33:26', 7, 9),
(283, '26/DMG/257', 'St\' Thomas College - Big Match - Delizia Pasta Sampling', '13th,14th March 2026', 35, NULL, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-09 17:21:44', '2026-03-10 18:06:18', 12, 9),
(284, '26/GSK/258', 'RFTL Additional Payment', 'RFTL Additional Payment', 48, NULL, NULL, 'in_progress', '2026-03-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-09 17:30:34', '2026-03-09 17:30:34', 29, 11),
(285, '26/GSK/259', 'Haleon Factory AC unit Installation - 1 Month Rent', NULL, 48, NULL, NULL, 'cancelled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-10 11:31:35', '2026-06-10 18:00:24', 12, 11),
(286, '26/NST/260', '#OneStop Eastern Mega Carnival - Samanthurai', '20th March to 27th March', 34, NULL, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-10 11:53:11', '2026-03-10 11:53:11', 19, 9),
(287, '26/NST/261', 'Nestamalt Jet Pack -Trinco Feb 28', 'Nestamalt Jet Pack -Trinco Feb 28', 34, NULL, NULL, 'in_progress', '2026-03-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-10 12:33:46', '2026-03-10 12:33:46', 13, 10),
(288, '26/GSK/262', 'PFC Pharmacist\'s Program Chilaw', 'Nilavin Hotel Chilaw\r\n150 Guests\r\n24th of April', 48, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-10 12:49:49', '2026-03-10 12:49:49', 16, 11),
(289, '26/GSK/263', 'Iodex spray Rugby school  Tournament', 'Bmich Press Conference Lorry & 2 boy', 48, NULL, NULL, 'in_progress', '2026-03-08', '2026-03-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-10 13:00:26', '2026-03-13 15:45:03', 12, 11),
(290, '26/NST/264', 'Maggi MT Actvation March', NULL, 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-10 13:29:08', '2026-03-10 13:29:08', 17, 9),
(291, '26/NST/265', 'street Promotion Eastern -Maggi Nuddles March', NULL, 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-10 13:41:06', '2026-03-10 13:41:06', 7, 10),
(292, '26/NST/266', 'NP Tender Paymnet Nuwaraeliay', 'NP Tender Paymnet Nuwaraeliay', 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-10 14:49:47', '2026-03-10 14:49:47', 29, 9),
(293, '26/NST/267', 'Milo Nescafe Vendor Boy Royal - Thomian Big Match @ SSC Ground', 'Royal Thomian Big Match @ SSC Ground\r\nMilo & Nescafe RTD Selling Operation\r\n03/13/2026 to 03/15/2026', 34, NULL, NULL, 'in_progress', '2026-03-13', '2026-03-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-10 14:55:56', '2026-03-10 15:08:05', 34, 9),
(294, '26/NST/268', 'Nestomallt MT Activation', 'FC /KEELLS', 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-11 16:15:36', '2026-03-11 16:15:36', 17, 10),
(295, '26/DOM/269', 'Counter Tops Delivery BIA - March', NULL, 50, NULL, NULL, 'in_progress', '2026-03-01', '2026-03-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-11 16:17:39', '2026-03-11 16:17:39', 18, 11),
(296, '26/NST/270', 'nestomalt  avurudu activations march to april', NULL, 34, NULL, NULL, 'in_progress', '2026-03-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-11 17:26:27', '2026-04-02 14:03:30', 13, 10),
(297, '26/NST/271', 'dispensor rent to nestomalt kanishka', 'mar 10', 34, NULL, NULL, 'in_progress', '2026-03-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-11 17:36:40', '2026-03-11 17:36:40', 13, 10),
(298, '26/NST/272', 'Galle face onestop T20 final match 8th March', 'T20 Final Match', 34, NULL, NULL, 'completed', '2026-03-07', '2026-03-08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-12 12:52:48', '2026-03-12 12:52:48', 7, 9),
(299, '26/NST/273', 'Jet Pack  Permeant Nestomalt-  March', 'Jet Pack Permanent Neatamalt March', 34, NULL, NULL, 'in_progress', '2026-03-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-12 14:04:48', '2026-04-02 13:46:17', 34, 10),
(300, '26/NST/274', 'Milo vendor Boy Hindu College Big match', 'Milo Vendor Boy Hindu College big match @ Sarawanamuttu Cricket Stadium', 34, NULL, NULL, 'in_progress', '2026-03-13', '2026-03-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-12 16:59:47', '2026-03-12 16:59:47', 34, 9),
(301, '26/NST/275', 'Jet Pack Accommodation facilities', 'Jet pack Accommodation Facilities & Other Equipments', 34, NULL, NULL, 'in_progress', '2026-03-16', '2026-03-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-12 17:06:29', '2026-03-12 17:06:29', 34, 10),
(302, '26/NST/276', 'Nestomalt goods purchasing', 'Nestomalt goods purchasing', 34, NULL, NULL, 'in_progress', '2026-03-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-13 15:16:31', '2026-03-13 15:16:31', 13, 10),
(303, '26/DIM/277', 'Roza chef - Rathmalana', '11th March', 57, NULL, NULL, 'completed', '2026-03-10', '2026-03-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-13 16:43:48', '2026-03-13 16:43:48', 7, 11),
(304, '26/DBL/278', 'Sunny Hangers Qty 4000-March', 'Sunny Hangers Qty 4000', 55, NULL, NULL, 'in_progress', '2026-03-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-16 15:57:04', '2026-04-02 15:47:13', 29, 10),
(305, '26/DOM/279', 'Domino\'s Photo Frame Printing - Women\'s day', NULL, 50, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-16 18:09:19', '2026-03-16 18:09:19', 18, 11),
(306, '26/NST/280', 'Ceregrow Keells Activation - March', '5th Week', 34, NULL, NULL, 'in_progress', '2026-03-13', '2026-03-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-16 18:16:41', '2026-03-16 18:16:41', 7, 9),
(307, '26/NST/281', 'Ceregrow Activation - ISM 2nd Weekend', '13th, 14th, 15th March', 34, NULL, NULL, 'in_progress', '2026-03-13', '2026-03-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-16 18:22:48', '2026-03-16 18:22:48', 7, 9),
(308, '26/NST/282', 'ODO Plus Activation - SPAR Outlet', '14th, 15th March', 34, NULL, NULL, 'in_progress', '2026-03-13', '2026-03-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-17 09:50:30', '2026-03-17 09:50:30', 7, 9),
(309, '26/NST/283', 'ODO Plus Activation - SPAR Outlet', '14th, 15th March', 34, NULL, NULL, 'in_progress', '2026-03-13', '2026-03-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-17 09:50:32', '2026-03-17 09:50:32', 7, 9),
(310, '26/NST/284', 'Vijitha Food City Activation', 'Vijitha Food City Activation', 34, NULL, NULL, 'in_progress', '2026-03-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-17 11:27:06', '2026-03-17 11:27:06', 29, 9),
(312, '26/RYC/285', 'Roy Tho Big Match -2026 ( Cups Production)', '1500 cups', 73, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-17 12:57:03', '2026-03-17 12:57:03', 18, 11),
(313, '26/NST/286', 'jetpack repairing-march', 'cost cahnge 26/NST/486', 34, NULL, NULL, 'cancelled', '2026-03-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-17 13:43:53', '2026-05-19 18:52:09', 13, 10),
(314, '26/NST/287', 'Nestamalt Jetpack -Coustume Sewing', 'Nestamalt Jetpack -Coustume Sewing', 34, NULL, NULL, 'cancelled', '2026-03-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-17 15:40:00', '2026-05-19 18:53:45', 13, 10),
(315, '26/NST/288', 'Ceregrow Keells Activation - March', '6th Week (21st, 22nd March)', 34, NULL, NULL, 'in_progress', '2026-03-19', '2026-03-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-18 12:31:08', '2026-03-18 12:31:08', 7, 9),
(316, '26/NST/289', 'Jo Pete Big Match @ SSC Ground Vendor Boy', 'Jo Pete Big Match @ SSC Ground\r\nMilo Nescafe Vendor Boy', 34, NULL, NULL, 'in_progress', '2026-03-19', '2026-03-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-18 13:15:08', '2026-03-18 13:43:13', 34, 9),
(317, '26/NST/290', 'Maliyadeva vs Anne\'s Big match @ Welagedara Kurunegala Vendor Boy', 'Maliyadeva vs Anne\'s Big match @ Welagedara Kurunegala\r\nMilo Nescafe Vendor Boy', 34, NULL, NULL, 'in_progress', '2026-03-20', '2026-03-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-18 13:15:09', '2026-03-18 13:43:24', 34, 9),
(318, '26/NST/291', 'Richmond Mahinda Big Match @ Galle Cricket Stadium Vendor Boy', 'Richmond Mahinda Big Match @ Galle Cricket Stadium\r\nMilo Nescafe Vendor Boy', 34, NULL, NULL, 'in_progress', '2026-03-19', '2026-03-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-18 13:18:47', '2026-03-18 13:43:32', 34, 9),
(319, '26/NST/292', 'Kingswood Dharmaraja Big Match @ Asgiriya Ground Vendor Boy', 'Kingswood Dharmaraja Big Match @ Asgiriya Ground\r\nMilo Nesacafe Vendor Boy', 34, NULL, NULL, 'in_progress', '2026-03-20', '2026-03-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-18 13:22:48', '2026-03-18 13:43:39', 34, 9),
(320, '26/NST/293', 'kingswood vs darmaraja big match  jet pack activation -march', 'asgiriya groung 20,21,22', 34, NULL, NULL, 'in_progress', '2026-03-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-18 13:44:48', '2026-03-18 13:44:48', 13, 10),
(321, '26/NST/294', 'richmond vs mahinda big match galle jetpack activation-march', '19,20,21', 34, NULL, NULL, 'in_progress', '2026-03-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-18 13:47:11', '2026-04-06 16:25:34', 13, 10),
(322, '26/NST/295', 'Maliyadewa big match jet pack kurunegala activation', '20,21,22', 34, NULL, NULL, 'in_progress', '2026-03-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-18 13:48:29', '2026-03-31 13:26:54', 13, 10),
(323, '26/NST/296', 'nestomalt jetpack activation puttalama ramazan food festival-march', NULL, 34, NULL, NULL, 'in_progress', '2026-03-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-18 14:05:43', '2026-03-24 17:06:20', 13, 10),
(324, '26/NST/297', 'nestomalt jet pack Activation Pugoda -march', 'pugoda,beruwala', 34, NULL, NULL, 'in_progress', '2026-03-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-18 16:51:36', '2026-04-02 13:55:49', 13, 10),
(325, '26/NST/298', 'nescafe outlet activation-march', NULL, 34, NULL, NULL, 'in_progress', '2026-03-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-18 17:31:58', '2026-03-18 17:31:58', 13, 10),
(326, '26/NST/299', '15000 Gift Voucher Wrapping', 'Singer mega homes voucher', 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-19 13:56:33', '2026-03-19 13:56:33', 17, 10),
(327, '26/DMG/300', 'Motha Awurudu Festival @ Kahathuduwa', 'Motha Awurudu Festival @ Kahathuduwa\r\nGame handling & Branding', 35, NULL, NULL, 'in_progress', '2026-03-21', '2026-03-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-19 14:10:25', '2026-03-19 14:10:25', 34, 9),
(328, '26/GSK/301', 'Royal Thomiyan Eno Sponshership Payment', 'Royal Thomiyan Eno Sponshership Payment', 48, NULL, NULL, 'in_progress', '2026-03-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-19 14:37:10', '2026-03-19 14:37:10', 29, 11),
(329, '26/DOM/302', 'Royal Thomiyan Big Match -Dominos', 'Royal Thomiyan Big Match -Dominos', 50, NULL, NULL, 'in_progress', '2026-03-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-19 14:40:37', '2026-03-19 14:40:37', 29, 11),
(330, '26/LTP/303', 'Royal Thomiyan Big Match -Lanka Tiles', 'Royal Thomiyan  Big Match -Lanka Tiles', 47, NULL, NULL, 'in_progress', '2026-03-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-19 14:41:33', '2026-03-19 14:41:33', 29, 11),
(331, '26/NST/304', 'One Stop Permenet Outlet March', 'One Stop Permenet Outlet March', 34, NULL, NULL, 'in_progress', '2026-03-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-19 16:17:17', '2026-03-19 16:17:17', 7, 9),
(332, '26/NST/305', 'gg', NULL, 34, NULL, NULL, 'in_progress', '2026-03-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-23 13:37:18', '2026-04-03 16:16:27', 13, 10),
(333, '26/NST/306', 'Puttalam Ramazan food Festival vendor boy activation', NULL, 34, NULL, NULL, 'in_progress', '2026-03-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-23 13:38:36', '2026-03-23 13:38:36', 13, 9),
(334, '26/GSK/307', 'Sensodyne Oral Health Day Flex Banner printing', NULL, 48, NULL, NULL, 'in_progress', '2026-03-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-23 13:53:17', '2026-03-23 13:53:17', 29, 11),
(335, '26/NST/308', 'Anchana Event Payement', NULL, 34, NULL, NULL, 'in_progress', '2026-03-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-23 14:32:17', '2026-03-23 14:32:17', 29, 10),
(336, '26/NST/309', 'Daham Event Payment', NULL, 34, NULL, NULL, 'in_progress', '2026-03-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-23 14:47:34', '2026-03-23 14:47:34', 13, 10),
(337, '26/DOM/310', 'Dominos Backdrop & Light board Fixing Sirasa Rathmalana -02', NULL, 50, NULL, NULL, 'in_progress', '2026-03-18', '2026-03-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-23 14:49:31', '2026-03-30 16:54:46', 12, 9),
(338, '26/GSK/311', 'iodex Head fast Sri jayawardanepura  univercity Pain Relif', 'Iodex Sri pada setup & sampling Activation Head fast Only', 48, NULL, NULL, 'in_progress', '2026-03-20', '2026-03-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-23 14:53:11', '2026-03-23 14:53:11', 12, 11),
(339, '26/NHL/312', 'Resourse Diabetic Pharmacy Activation-March', NULL, 69, NULL, NULL, 'in_progress', '2026-03-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-23 15:33:06', '2026-03-23 15:33:06', 17, 11),
(340, '26/NST/313', 'Maggi Papare Blast ISM Outlet Activation - March, April', '20th March Started', 34, NULL, NULL, 'in_progress', '2026-03-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-23 18:09:36', '2026-03-24 10:20:07', 7, 10),
(341, '26/NST/314', 'Ceregrow Activation - ISM 3rd Weekend', '21st, 22nd, 23rd March', 34, NULL, NULL, 'in_progress', '2026-03-19', '2026-03-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-24 10:17:37', '2026-03-24 10:17:37', 7, 9),
(342, '26/NST/315', 'Nestomalt ISM Activation - March, April', '20th March Started', 34, NULL, NULL, 'in_progress', '2026-03-19', '2026-04-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-24 10:22:15', '2026-03-24 10:22:15', 7, 10),
(343, '26/DMG/316', 'Backdrop production Galle Cricket match', 'Backdrop production Galle Cricket match', 35, NULL, NULL, 'in_progress', '2026-03-24', '2026-03-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-24 13:23:22', '2026-03-24 13:23:22', 7, NULL),
(344, '26/NST/317', 'Genaretoer rent April', 'Genaretoer rent April', 34, NULL, NULL, 'in_progress', NULL, '2026-04-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-24 14:27:32', '2026-03-24 14:27:32', 7, 9),
(345, '26/GSK/319', 'Oral day event - Trinco', '25th March', 48, NULL, NULL, 'in_progress', '2026-03-23', '2026-03-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-24 14:58:25', '2026-03-24 17:12:24', 7, 11),
(346, '26/SUN/320', 'Watawala Apron Production', '100 qty - March', 41, NULL, NULL, 'in_progress', '2026-03-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-24 17:19:24', '2026-03-24 17:19:24', 18, 11),
(347, '26/HEM/321', 'Servier T-Shirt & Shirt Production', 'T-Shirts - Ashoka\r\nShirts - Hameedias Rajagiriya', 65, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-24 17:47:07', '2026-03-24 17:47:07', 16, 11),
(348, '26/MBM/322', 'Spikes Asia Awards -Script writing & Video Editing', 'Script writing & Video Editing', 61, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-24 18:02:23', '2026-03-24 18:02:23', 18, 11),
(349, '26/NST/323', 'Jetpack Permanent Activation March-Nestamalt', 'Jetpack Permanent activation March', 34, NULL, NULL, 'in_progress', '2026-03-24', '2026-03-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-24 18:07:08', '2026-04-02 13:52:18', 34, 10),
(350, '26/LNK/324', 'Link sudantha town Activation March', NULL, 62, NULL, NULL, 'in_progress', '2026-03-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-25 11:08:05', '2026-03-25 11:08:05', 17, 10),
(351, '26/GSK/325', 'Branded Pens Production', 'Cosodyle, Piriton syrup, Panadeine (3000 qty each 1000)', 48, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-25 14:06:42', '2026-03-25 14:06:42', 18, 11),
(352, '26/NST/326', 'Milo MT Activation', 'Milo MT Activation With sampling\r\nMAR-APR', 34, NULL, NULL, 'in_progress', '2026-03-28', '2026-04-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-25 14:22:18', '2026-03-25 14:22:18', 34, 9),
(353, '26/NHL/327', 'Resourse Diabetic Sampling Activation ( SLMNA Market Fair)', 'Kalaniya', 69, NULL, NULL, 'in_progress', '2026-03-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-25 14:32:44', '2026-03-25 14:32:44', 17, 11),
(354, '26/NST/328', 'Ceregrow Keells Activation - March', '28th, 29th March', 34, NULL, NULL, 'in_progress', '2026-03-26', '2026-03-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-25 14:37:13', '2026-03-25 14:37:13', 7, 9),
(355, '26/NST/329', 'Onestop - Malabe Sky One Event', '27th March', 34, NULL, NULL, 'in_progress', '2026-03-26', '2026-03-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-25 14:41:17', '2026-03-25 14:41:17', 7, 9),
(356, '26/NST/330', 'Client Payament', 'Client Payament', 34, NULL, NULL, 'in_progress', '2026-03-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-25 14:44:17', '2026-03-25 14:44:17', 29, 9),
(357, '26/NST/331', 'Onestop - Yfm Kandy Gatambe Event', '29th March', 34, NULL, NULL, 'in_progress', '2026-03-27', '2026-03-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-25 14:47:36', '2026-03-25 14:47:36', 7, 9),
(358, '26/HEM/332', 'Hemas Pharmaceuticals - Grand Kandyan Kandy Product Launch', '28th of April\r\n25 Pax\r\nDinner Event\r\nXTreme', 65, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-25 16:12:19', '2026-03-25 16:13:21', 16, 11),
(359, '26/HEM/333', 'Hemas Pharmaceuticals - Radisson Blu Galle Product Launch', '30th of April\r\n15 Pax\r\nDinner Event\r\nXTreme', 65, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-25 16:13:08', '2026-04-27 15:34:17', 16, 11),
(360, '26/NST/334', 'mikmaid dessert table costume sewing cost change 26/NST/486', NULL, 34, NULL, NULL, 'cancelled', '2026-03-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-25 17:00:10', '2026-05-19 18:54:36', 13, 10),
(361, '26/NST/335', 'Nestomalt ISM Activation - March, April', '20th March Started', 34, NULL, NULL, 'in_progress', '2026-03-20', '2026-04-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-26 11:57:23', '2026-03-26 11:57:23', 7, 10),
(362, '26/NST/336', 'jo&peter big match ssc groung jet pack activation-march', NULL, 34, NULL, NULL, 'in_progress', '2026-02-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-26 12:32:11', '2026-03-26 12:32:11', 13, 10),
(363, '26/GSK/337', 'Oral day event - Kandy', '27th March  Cost Change 26/GSK/319', 48, NULL, NULL, 'cancelled', '2026-03-26', '2026-03-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-26 15:33:07', '2026-05-15 13:35:40', 7, 11),
(364, '26/NST/338', 'Milo Nescafe Vendor Boy @ P Sara Ground', 'Milo Nescafe Vendor Boy\r\nAmbalangoda Ground\r\nP sara Ground\r\nWelagedara Ground', 34, NULL, NULL, 'in_progress', '2026-03-26', '2026-03-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-26 18:34:00', '2026-03-26 18:34:00', 34, 9),
(365, '26/NST/339', 'Milo Nescafe Vendor Boy @ P Sara Ground', 'Milo Nescafe Vendor Boy\r\nAmbalangoda Ground\r\nP sara Ground\r\nWelagedara Ground', 34, NULL, NULL, 'in_progress', '2026-03-26', '2026-03-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-26 18:34:01', '2026-03-26 18:34:01', 34, 9),
(366, '26/DIF/340', 'Dialog Finance - Kolambagama Avurudu Event', 'Viharamaha Devi Park\r\n29th of March\r\nXTreme', 56, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-28 19:47:26', '2026-03-28 19:47:26', 16, 9),
(367, '26/DMG/341', 'Delmege 1 million Achievement Event', '2nd of April', 35, NULL, NULL, 'in_progress', '2026-04-01', '2026-04-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-30 14:59:09', '2026-03-30 14:59:09', 7, 9),
(368, '26/NST/342', 'Senthomas Nescafe gold blend box purchase', NULL, 34, NULL, NULL, 'in_progress', '2026-03-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-30 15:58:00', '2026-03-30 15:58:00', 17, 10),
(369, '26/GSK/343', 'futsal tournament March 28th at Athlete 360, Nugegoda iodex spray', 'A Board & Flags Base Fixing & Removing One day', 48, NULL, NULL, 'in_progress', '2026-03-26', '2026-04-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-30 16:33:38', '2026-03-30 16:33:38', 12, 11),
(370, '26/NST/344', 'Ceregrow Activation - ISM 4th Weekend', '27th, 28th, 29th, & 30th March', 34, NULL, NULL, 'in_progress', '2026-03-27', '2026-03-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-30 16:41:57', '2026-03-30 16:41:57', 7, 9),
(371, '26/NST/345', 'Nestomalt Dispensor Rent April', NULL, 34, NULL, NULL, 'in_progress', '2026-03-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-30 16:46:27', '2026-04-02 14:13:23', 13, 10),
(372, '26/NST/346', 'nestomalt marothan kandy', NULL, 34, NULL, NULL, 'in_progress', '2026-03-29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-30 16:54:01', '2026-03-30 16:54:01', 13, 10),
(373, '26/NST/347', 'nestomalt avurudu uniform production', NULL, 34, NULL, NULL, 'in_progress', '2026-03-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-30 17:00:51', '2026-03-30 17:00:51', 13, 10),
(374, '26/DOM/348', 'Domino\'s Sirsa TV Avrudu Shoot', '7500 vouchers - 10\r\n5000 vouchers -16 \r\n30th shoot', 50, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-30 17:29:30', '2026-03-30 17:29:30', 18, 11),
(375, '26/NST/349', 'Jet Pack Permanent Nescafe - March', NULL, 34, NULL, NULL, 'in_progress', '2026-03-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-30 20:09:12', '2026-03-30 20:09:12', 34, 10),
(376, '26/FRH/350', 'Fresh Harvest Social Media Mar \'26', 'Social Media Handling Instagram & Facebook\r\nAnuradha', 64, NULL, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-31 11:34:23', '2026-03-31 11:34:23', 16, 11),
(377, '26/NST/351', 'Nestle Goods Delivery -Dompe To Spectra', NULL, 34, NULL, NULL, 'in_progress', '2026-03-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-31 11:38:55', '2026-03-31 11:38:55', 13, 10),
(378, '26/GSK/352', 'Haleon factory Rathmalana  Ac Unit Rent 1 Month', '120000 BTU ac unit one month rent fixing date 2026.03.13 to 2026.03.14', 48, NULL, NULL, 'in_progress', '2026-03-13', '2026-04-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-31 11:55:19', '2026-03-31 11:55:19', 12, 11),
(379, '26/NST/353', 'Aurudu gemigedara paymnet', '50000/= Additioanl Payment for Aurudu gemigedara for Rajendra', 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-31 14:33:26', '2026-05-19 14:15:22', 7, 9),
(380, '26/CAC/354', 'Heavenly Activation - Havelock Mall (2nd Activation)', '6th, 7th & 8th April', 67, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-31 14:46:27', '2026-03-31 14:46:27', 18, 11),
(381, '26/DOM/355', 'Domino\'s Derana Avrudu Shoot -1st of April', NULL, 50, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-31 15:32:30', '2026-03-31 15:32:30', 18, 11),
(382, '26/NST/356', 'Jet Pack Activation', 'Jet pack March', 34, NULL, NULL, 'in_progress', '2026-03-31', '2026-04-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-31 15:56:12', '2026-03-31 15:56:12', 34, 10),
(383, '26/NST/357', 'Blender Purchasing For Nuwara Eliya -2 Units', NULL, 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-31 16:02:56', '2026-03-31 16:02:56', 29, 9),
(384, '26/NST/358', '3 Units Blender Purchasing Milo Mt Activation', NULL, 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-31 16:04:03', '2026-03-31 16:04:03', 29, 9),
(385, '26/NST/359', 'Dompe Stores Cleaning Project March', NULL, 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-31 16:07:55', '2026-03-31 16:07:55', 7, 9),
(386, '26/NST/360', 'Double 2 Refrigrator Propaganda Truck', NULL, 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-31 16:09:22', '2026-03-31 16:09:22', 29, 9),
(387, '26/NST/361', 'Nescafe Gift Wraping', NULL, 34, NULL, NULL, 'in_progress', '2026-03-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-31 19:13:10', '2026-03-31 19:13:10', 17, 10),
(388, '26/NST/362', 'Vendor Boy Permanent Activation -mar to april', NULL, 34, NULL, NULL, 'in_progress', '2026-03-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-31 19:31:37', '2026-03-31 19:31:37', 13, 9),
(389, '26/NST/363', 'Vendor Boy Thurstan Vs Isipathana Big match @SSC', 'Thurstan Vs Isipathana Big match @SSC\r\nVendor boy Activation\r\nMaggi Carrier Boy', 34, NULL, NULL, 'in_progress', '2026-04-03', '2026-04-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 11:22:06', '2026-04-02 11:22:06', 34, 9),
(390, '26/NST/364', 'Thurston Isipathana Bigmatch -Papare Payment', NULL, 34, NULL, NULL, 'in_progress', '2026-04-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 11:52:33', '2026-04-02 11:52:33', 7, 9),
(391, '26/NST/365', 'Maggi MT Activation April', NULL, 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 12:34:52', '2026-04-02 12:34:52', 17, 11),
(392, '26/DBL/366', 'Sunny Hangers Qty 4000-April', NULL, 55, NULL, NULL, 'in_progress', '2026-04-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 15:47:46', '2026-04-02 15:47:46', 29, 10),
(393, '26/DBL/367', 'Sunny Block Stand -200', NULL, 55, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 15:49:31', '2026-04-02 15:49:31', 29, 10),
(394, '26/DOM/368', 'Dominos Backdrop & Light Board Fixing Sirasa MonyDroop', 'one labour one lorry Fixing & Removing', 50, NULL, NULL, 'in_progress', '2026-03-21', '2026-04-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 11:47:49', '2026-04-03 11:47:49', 12, 11),
(395, '26/GSK/369', 'Eno Light board fixing & Removing ssc Ground', 'one boy,one lorry Fixing & removing', 48, NULL, NULL, 'in_progress', '2026-04-03', '2026-04-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 11:50:43', '2026-04-03 11:50:43', 12, 11),
(396, '26/NST/370', 'Ceregrow Activation - ISM 5th Weekend', '3rd, 4th, 5th April', 34, NULL, NULL, 'in_progress', '2026-04-02', '2026-04-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 10:58:18', '2026-04-06 10:58:18', 7, 9),
(397, '26/NST/371', 'Ceregrow Keells Activation - April', '4th, 5th April', 34, NULL, NULL, 'in_progress', '2026-04-03', '2026-04-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 10:59:59', '2026-04-06 10:59:59', 7, 9),
(398, '26/NST/372', 'Shabira Payment -Salary cost tranfer 26/NST/376', 'Shabira Settlement and sale Cash Release', 34, NULL, NULL, 'cancelled', '2026-04-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 11:29:26', '2026-06-02 13:44:26', 29, 10),
(399, '26/ILM/373', 'Sample T Shirt Delivery', 'Sample T Shirt Delivery -DHL-Maldives', 74, NULL, NULL, 'cancelled', '2026-04-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 11:56:54', '2026-06-17 12:43:35', 19, 9),
(400, '26/NST/374', 'NP Activation  Nuwara-Eliya Salalihini Wasanthaya', '10th to 19th April', 34, NULL, NULL, 'in_progress', '2026-04-09', '2026-04-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 12:27:22', '2026-04-06 12:27:22', 7, 9),
(401, '26/NST/375', 'Dummy -26/NST/289', NULL, 34, NULL, NULL, 'in_progress', '2026-04-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 13:04:09', '2026-04-06 13:04:09', 29, 9),
(402, '26/NST/376', 'OneStop Nuwara-Eliya Salalihini Wasanthaya - 01', 'OneStop Nuwara-Eliya @ Gregory Lake side - 10th April - 20th April 2026', 34, NULL, NULL, 'in_progress', '2026-04-10', '2026-04-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 13:23:49', '2026-04-06 14:14:31', 19, 9),
(403, '26/NST/377', 'OneStop Nuwara-Eliya Salalihini Wasanthaya - 02 (Publ London)', 'OneStop Nuwara-Eliya Salalihini Wasanthaya - 14th - 20th April 2026', 34, NULL, NULL, 'in_progress', '2026-04-14', '2026-04-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 14:16:53', '2026-04-21 11:47:29', 19, 9),
(404, '26/DBL/378', 'Darly Buttler Teddy Activation', NULL, 55, NULL, NULL, 'in_progress', '2026-04-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 17:52:59', '2026-05-19 18:49:36', 17, 10),
(405, '26/NST/379', 'Nestomalt Keells Activation Windows Bord visiting', NULL, 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 17:55:57', '2026-04-06 17:55:57', 17, 10),
(406, '26/PFL/380', 'Cbl sera spar Super Outlet Activation', 'Cbl Sera Spar super Outlet Activation 6 outlet', 39, NULL, NULL, 'in_progress', '2026-04-06', '2026-04-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 18:04:11', '2026-04-06 18:04:11', 12, 9),
(407, '26/DIM/381', 'Roza chef - Moors Ground Colombo', '1st April', 57, NULL, NULL, 'completed', '2026-04-01', '2026-04-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-07 10:43:42', '2026-04-07 10:43:54', 7, 11),
(408, '26/NST/382', 'Nestle - Handala Warehouse Cleaning', '31st March Handala New Warehouse Cleaning 26/NST/389', 34, NULL, NULL, 'cancelled', '2026-03-31', '2026-04-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-07 11:20:07', '2026-04-29 11:31:06', 7, 9),
(409, '26/NST/383', 'Milo MT Activation April', 'Milo MT Activation April\r\nArpico Outlets', 34, NULL, NULL, 'in_progress', '2026-04-09', '2026-04-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-07 13:10:14', '2026-04-07 13:10:14', 34, 9),
(410, '26/LTP/384', 'Lanka Tiles Colombo Fashion Week - Cinnamon Life', NULL, 47, NULL, NULL, 'in_progress', '2026-04-02', '2026-04-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-07 17:06:08', '2026-04-07 17:06:08', 18, 11),
(411, '26/DOM/385', 'Domino\'s Sticker cards Printing', '2 sticker cards', 50, NULL, NULL, 'in_progress', '2026-04-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-07 18:35:19', '2026-04-07 18:35:19', 18, 11),
(412, '26/NST/386', 'Onestop Yfm Horana Event', '9th April', 34, NULL, NULL, 'in_progress', '2026-04-08', '2026-04-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 12:08:14', '2026-04-08 12:08:14', 12, 9),
(413, '26/NST/387', 'Maggi Cubes D to D - Jaffna area', '07th to 18th April', 34, NULL, NULL, 'completed', '2026-04-07', '2026-04-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 12:09:48', '2026-04-21 11:22:43', 7, 10),
(414, '26/NST/388', 'Maggi Papare D to D - Jaffna area', '07th to 13th April', 34, NULL, NULL, 'completed', '2026-04-07', '2026-04-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 12:12:43', '2026-04-21 11:25:04', 7, 10),
(415, '26/GSK/389', 'Transport Allowance Addition- Math ekka Yamu', 'Transport Allowance Addition', 48, NULL, NULL, 'in_progress', '2026-04-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 14:13:29', '2026-04-09 14:13:29', 29, 11),
(416, '26/NST/390', 'NP Selling Activation - Awissawella & Horana', '9th, 10th April', 34, NULL, NULL, 'completed', '2026-04-09', '2026-04-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-12 10:36:10', '2026-04-12 10:36:10', 7, 9),
(417, '26/NST/391', 'Maggi D2D Mathugama sepcial Day', '11th Nestomalt, 12th Maggi April', 34, NULL, NULL, 'in_progress', '2026-04-11', '2026-04-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-12 10:42:07', '2026-05-19 18:58:38', 7, 10),
(418, '26/DOM/392', 'DOMINOS ALOON UNIT DILIVERY DEHIWALA BRANCH', '1 BOY 1 LORRY & DILIVERY TO DEHIWALA BRANCH', 50, NULL, NULL, 'in_progress', '2026-04-17', '2026-05-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-21 10:43:07', '2026-04-21 10:43:07', 12, 9),
(419, '26/DOM/393', 'DOMINOS FLAGS FIXING & REMOEING NUWARAELIYA DOMINOS', '6 POLES ,6 BASE 20DAYS FLAGS DILIVERY BOY COLOMBO TO NUWARAELIYA UP & DOWN', 50, NULL, NULL, 'in_progress', '2026-04-12', '2026-05-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-21 10:46:53', '2026-04-21 10:46:53', 12, 9),
(420, '26/DOM/394', 'Dominos Backdrop & Light board Fixing Sirasa Rathmalana', 'Fixing 2 light box\r\n1 back drop\r\nLorry 1\r\nHelfer 2', 50, NULL, NULL, 'in_progress', '2026-04-21', '2026-04-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-21 13:10:40', '2026-04-21 13:10:40', 12, 11),
(421, '26/NST/395', 'Nestamalt Avurudu Activation -Part 2', NULL, 34, NULL, NULL, 'in_progress', '2026-04-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-21 14:52:37', '2026-04-21 14:52:37', 13, 10),
(422, '26/NST/396', 'NuwaraEliya Nescafe Drone Payment', 'Nescafe Drone Payment', 34, NULL, NULL, 'in_progress', '2026-04-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-21 14:54:23', '2026-04-21 14:54:45', 29, 9),
(423, '26/NST/397', 'Milo Vendor Boy Joshep Vass Vs St. Anthony @ P Sara Ground', 'Vendor Boy Joshep Vass Vs St. Anthony @ P Sara Ground', 34, NULL, NULL, 'in_progress', '2026-04-24', '2026-04-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-22 10:43:14', '2026-04-22 10:44:01', 34, 9),
(424, '26/NST/398', 'Milo Vendor Boy Jo Pete Big match @ SSC Ground cost change 397', 'Milo Vendor Boy Jo Pete Big match @ SSC Ground', 34, NULL, NULL, 'cancelled', '2026-04-24', '2026-04-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-22 10:45:28', '2026-05-14 16:41:55', 34, 9),
(425, '26/DIM/399', 'Roza chef - Sakya Awrudu Event Nugegoda', '20th April', 57, NULL, NULL, 'completed', '2026-04-20', '2026-04-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-22 11:45:06', '2026-04-22 11:45:06', 7, 11),
(426, '26/DIM/400', 'Roza chef - Sakya Awrudu Event Gampaha', '21st April(cost Change DIM 381', 57, NULL, NULL, 'cancelled', '2026-04-21', '2026-04-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-22 11:46:27', '2026-05-05 12:49:27', 7, 11),
(427, '26/HEM/401', 'Vastarel Product Launch Cakes - Hemas Pharmaceuticals Office', '2.5kg Printed Cakes x 2\r\n1.5kg Printed Cake x 1\r\nSala Cake & Tool', 65, NULL, NULL, 'completed', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-22 12:02:01', '2026-04-22 12:02:01', 16, 11),
(428, '26/NST/402', 'Onestop Nestle Head Office-Avurudu', '22nd April', 34, NULL, NULL, 'in_progress', '2026-04-21', '2026-04-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-22 12:02:47', '2026-04-28 17:17:35', 7, 9),
(429, '26/GSK/403', 'Sripada Math ekka Yamu -Transport Allowance', NULL, 48, NULL, NULL, 'in_progress', '2026-04-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-22 12:14:23', '2026-04-22 12:14:23', 12, 11),
(430, '26/NST/404', 'CMP Maggi Stickering-April', 'CMP MAggi Stickering - DB points', 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-22 13:42:52', '2026-04-22 13:42:52', 19, 10),
(431, '26/NST/405', 'nestomalt sticker pasting-nestle head office', NULL, 34, NULL, NULL, 'in_progress', '2026-04-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-22 17:27:30', '2026-04-22 17:27:30', 13, 10),
(432, '26/LTP/406', 'Lanka Tiles Kasthuri Transport', NULL, 47, NULL, NULL, 'in_progress', '2026-04-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-22 17:45:11', '2026-04-22 17:45:11', 29, 11);
INSERT INTO `custom_jobs` (`id`, `job_number`, `job_name`, `description`, `client_id`, `officer_name`, `reporter_officer_name`, `status`, `start_date`, `end_date`, `default_coordinator_fee`, `default_hold_for_8_weeks`, `default_food_allowance`, `default_accommodation_allowance`, `default_expenses`, `default_location`, `location_notes`, `allowance`, `created_at`, `updated_at`, `officer_id`, `reporter_id`) VALUES
(433, '26/DIO/407', 'Dimo Valentines Rose', 'Dimo Valentines Rose  67390/-', 75, NULL, NULL, 'in_progress', '2026-04-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-22 18:09:43', '2026-04-22 18:10:17', 29, 11),
(434, '26/GSK/408', 'Iodex RSM Training Programe', NULL, 48, NULL, NULL, 'in_progress', '2026-04-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-22 18:27:32', '2026-04-22 18:27:32', 29, 11),
(435, '26/NST/409', 'Anchana Payment - April', 'Anchana Payment - April', 34, NULL, NULL, 'in_progress', '2026-04-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-23 11:34:51', '2026-04-23 11:34:51', 29, 10),
(436, '26/NST/410', 'Maggi kalmunei shop visiting job cancel 26/NST/486', NULL, 34, NULL, NULL, 'cancelled', '2026-03-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-23 15:25:08', '2026-05-19 19:04:05', NULL, NULL),
(437, '26/NST/411', 'Nuwaraeliya jet pack activation-april', NULL, 34, NULL, NULL, 'in_progress', '2026-04-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-23 16:19:42', '2026-04-23 16:19:42', 13, 10),
(438, '26/GSK/412', 'Derana 60 Plus Gift Delivery', NULL, 48, NULL, NULL, 'in_progress', '2026-04-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-24 13:15:15', '2026-04-24 13:15:15', 12, 11),
(439, '26/NST/413', 'Onestop -Trace City', '26th April', 34, NULL, NULL, 'in_progress', '2026-04-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-24 17:43:10', '2026-04-29 14:21:55', 7, 9),
(440, '26/NST/414', 'Maggi MT Kurungala Spar Activation', NULL, 34, NULL, NULL, 'in_progress', '2026-04-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-27 11:05:12', '2026-04-27 11:05:12', 17, 9),
(441, '26/NST/415', 'Nescafe Fashion Show -Advance', NULL, 34, NULL, NULL, 'in_progress', '2026-04-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-27 13:10:50', '2026-04-27 13:10:50', 29, 9),
(442, '26/NST/416', 'Head Office Branding-Shenara', NULL, 34, NULL, NULL, 'in_progress', '2026-04-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-27 17:13:15', '2026-04-27 17:13:15', 29, 10),
(443, '26/NST/417', 'Milo Mt Activation-Arpico Job 326 Part 2', NULL, 34, NULL, NULL, 'in_progress', '2026-04-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-28 13:48:46', '2026-04-28 13:48:46', 34, 9),
(444, '26/LIM/418', 'Lion Max MT Activation', NULL, 77, NULL, NULL, 'in_progress', '2026-04-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-28 17:29:36', '2026-04-28 17:29:36', 17, 11),
(445, '26/NST/419', 'Nestomalt Marothan & Avurudu activation Viharamahadewi-april 26', NULL, 34, NULL, NULL, 'cancelled', '2026-04-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-28 17:57:29', '2026-04-29 11:21:22', 13, 9),
(446, '26/NST/420', 'Nestomalt Marothan & avurudu activation Viharamahadewi-april 26', NULL, 34, NULL, NULL, 'in_progress', '2026-04-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-28 17:57:30', '2026-04-29 11:07:34', 13, 9),
(447, '26/MBM/421', 'Snickers India Team Accomadation', 'Snickers India Team Accommodation', 61, NULL, NULL, 'in_progress', '2026-04-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-28 18:15:29', '2026-04-28 18:15:29', 16, 11),
(448, '26/NST/422', 'Milo Vendor Boy Defence Vs Mahinda @ SSC Ground', 'Milo Vendor Boy Defence Vs Mahinda @ SSC Ground', 34, NULL, NULL, 'in_progress', '2026-04-29', '2026-04-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-29 10:58:38', '2026-04-29 10:58:38', 34, 9),
(449, '26/GSK/423', 'Iodex spray Run 4  Health  Event independence Squre', 'Promoter 4 ,  superviosr  1,20*10 canopy with flat foam, hanging unit, Dummy spray Bottle,10 poles with base', 48, NULL, NULL, 'in_progress', '2026-05-10', '2026-05-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-29 12:37:29', '2026-04-29 12:37:29', 12, 11),
(450, '26/GSK/424', 'iodex spray 5a  side mens & women Hockey Tournament Navy Ground Welisara', '20 falgs with base , 1 mascot , 4 promoter,superviosr ,20*10 canopy with flat foam with carpet , Dummy Bottle , Hagging unit', 48, NULL, NULL, 'in_progress', '2026-05-15', '2026-05-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-29 12:43:48', '2026-04-29 12:43:48', 12, 11),
(451, '26/DOM/425', 'Sausage Crust Pizza Counter Top Printing - April', 'Sausage Crust Pizza Counter Top-01', 50, NULL, NULL, 'in_progress', '2026-04-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-29 12:43:52', '2026-04-29 12:43:52', 18, 11),
(452, '26/GSK/426', 'Iodex spray sri lanka foundation Field Site First aid in sports Act Injury  Management', '2 boy ,1 girl ,1 supervisor ,lorry 1 ,gift pack 130,light box 2,flags 10 ,', 48, NULL, NULL, 'in_progress', '2026-05-06', '2026-05-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-29 12:56:36', '2026-04-29 12:56:36', 12, 11),
(453, '26/LTP/427', 'Lankatile leaflets distribution galle-april', NULL, 47, NULL, NULL, 'in_progress', '2026-04-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-29 13:22:46', '2026-04-29 13:22:46', 13, 11),
(454, '26/LTP/428', 'lanka Tiles CFW Stock Delivery', NULL, 47, NULL, NULL, 'in_progress', '2026-04-29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-29 14:46:30', '2026-04-29 14:46:30', 29, 11),
(455, '26/GSK/429', 'PFC Midwife Event May - Kandy', '1,500 Participants\r\nKaraliya Hall Kandy\r\nNelunka', 48, NULL, NULL, 'completed', '2026-04-29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-29 16:20:16', '2026-05-21 17:58:43', 16, 11),
(456, '26/GSK/430', 'Iodex suwasahana Sirpada -Stall Refixing Tamol To Sinhala', NULL, 48, NULL, NULL, 'in_progress', '2026-04-29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-29 16:21:08', '2026-04-29 16:21:08', 29, 11),
(457, '26/DOM/431', 'Derana Entertainment Payment', NULL, 50, NULL, NULL, 'in_progress', '2026-04-29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-29 17:20:25', '2026-04-29 17:20:25', 29, 11),
(458, '26/GSK/432', 'Thurston Vs  Isipathana Bigmatch -Sponshership Payment', NULL, 48, NULL, NULL, 'in_progress', '2026-04-29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-29 17:40:44', '2026-04-29 17:40:44', 29, 11),
(459, '26/GSK/433', 'PFC Pharmacist Program Nuwaraeliya', '14th of May\r\nAraliya Green Hills Nuwaraeliya\r\n80 Pax\r\nNelunka', 48, NULL, NULL, 'in_progress', '2026-04-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-30 14:07:07', '2026-04-30 17:11:08', 16, 11),
(460, '26/NST/434', 'Maggi Papare ISM Sampling Activation - May', '2nd May Started', 34, NULL, NULL, 'in_progress', '2026-05-01', '2026-05-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-30 14:14:29', '2026-05-04 14:24:28', 7, 10),
(461, '26/GSK/435', 'PFC Pharmacist Program Badulla', '15th of May\r\nHeritage Grand Hotel Badulla\r\n100 Pax\r\nNelunka', 48, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-30 17:10:12', '2026-04-30 17:10:12', 16, 11),
(462, '26/LTP/436', 'Lanka Tiles Banners Printing & Delivery -Malabe', '3*5 size \r\nMalabe \r\n29/04/2026', 47, NULL, NULL, 'in_progress', '2026-04-29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-30 18:55:54', '2026-04-30 18:55:54', 18, 11),
(463, '26/NST/437', 'Milo Vendor Boy @ pallekale Ground', 'Milo Vendor Boy @ pallekale Ground', 34, NULL, NULL, 'completed', '2026-04-30', '2026-05-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-04 10:50:24', '2026-05-04 10:50:24', 34, 9),
(464, '26/NST/438', 'nestomalt dispensor 3 rent-may', NULL, 34, NULL, NULL, 'in_progress', '2026-05-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-04 13:06:05', '2026-05-04 13:06:05', 13, 10),
(465, '26/NST/439', 'Gayan Hettiarachchi Paymnet', 'Gayan Hettiarachchi monthly paymnet Jan-Dec', 34, NULL, NULL, 'in_progress', '2026-05-04', '2026-05-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-04 14:10:07', '2026-05-04 14:10:07', 29, 9),
(466, '26/NST/440', 'Maggi-Chef  Payment-Sanjeewa/Lahiru /Mafaz Rs 200,000/-', NULL, 34, NULL, NULL, 'in_progress', '2026-05-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-04 16:16:49', '2026-05-19 19:07:08', 29, 10),
(467, '26/NST/441', 'Maggi Box Payment', NULL, 34, NULL, NULL, 'in_progress', '2026-05-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-04 16:18:09', '2026-05-04 16:18:09', 29, 9),
(468, '26/LTP/442', 'lankatile borella outlet opening-may', NULL, 47, NULL, NULL, 'in_progress', '2026-05-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-05 11:57:10', '2026-05-05 11:57:10', 13, 11),
(469, '26/FRH/443', 'Fresh Harvest Social Media Apr \'26', 'Facebook & Instagram\r\nAnu', 64, NULL, NULL, 'completed', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-05 13:43:00', '2026-05-05 13:43:00', 16, 11),
(470, '26/LNK/444', 'Link Sudantha SMMT Activation-April', NULL, 62, NULL, NULL, 'in_progress', '2026-05-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-05 14:38:47', '2026-05-05 14:38:47', 17, 10),
(471, '26/SUN/445', 'Sofa Delivery and Collecting - Samadhi', '30th April & 1st May (Swarnavahini to Cinnomand grand)', 41, NULL, NULL, 'completed', '2026-04-30', '2026-05-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-06 10:58:26', '2026-05-06 10:58:26', 7, 11),
(472, '26/NST/446', 'Onestop Truck Activation - Kandy', '30th April (Madushanka)', 34, NULL, NULL, 'completed', '2026-04-30', '2026-05-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-06 12:44:24', '2026-05-25 12:42:13', 7, 9),
(473, '26/GSK/447', 'Mr. Chula Lodging N\'Eliya & Badulla / PFC Gift bag delivery', 'Gift Delivery 4th May (WTC office & Derana HO)\r\nLodging - Queen\'s Mount Glen N\'eliya 13.05.26\r\nLodging - Heritage Hotel Badulla with Dinner & Breakfast\r\n 14.05.26', 48, NULL, NULL, 'completed', '2026-05-04', '2026-05-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-06 13:07:04', '2026-05-15 12:58:46', 7, 11),
(474, '26/ILM/448', 'Solar Lights Purchase & Delivery', '04 Solar lights purchase from Negombo Sales Centre', 74, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-06 14:30:06', '2026-05-06 14:30:06', 19, 9),
(475, '26/NST/449', 'Maggi Papare Blast Activation - MT', '8th, 9th, 10 May Started', 34, NULL, NULL, 'completed', '2026-05-07', '2026-05-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-07 10:15:10', '2026-05-07 10:15:10', 7, 9),
(476, '26/NST/450', 'Maggi Sampling Counter Re Production', NULL, 34, NULL, NULL, 'in_progress', '2026-05-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-07 13:19:09', '2026-05-07 13:19:09', 29, 9),
(477, '26/NST/451', 'Nestomalt D to D - Eastern May', '12th may Started  (20 days, 4 teams', 34, NULL, NULL, 'in_progress', '2026-05-11', '2026-06-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-07 16:00:34', '2026-06-15 10:43:06', 7, 10),
(478, '26/HEM/452', 'Dr. Kamani Liyanarachchi UpToDate Subscription', 'UpToDate Website Subscription\r\n$319', 65, NULL, NULL, 'completed', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-07 18:11:23', '2026-05-07 18:12:24', 16, 11),
(479, '26/NST/453', 'Jet Pack Peremenet -April jon cost tranfer 356', NULL, 34, NULL, NULL, 'cancelled', '2026-05-08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-08 16:32:49', '2026-05-19 19:08:35', 34, 10),
(480, '26/RYC/454', 'Royal College Niners Event ( Main Event) -2026', NULL, 73, NULL, NULL, 'in_progress', '2026-05-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-11 12:43:45', '2026-05-21 12:07:26', 18, 11),
(481, '26/MBM/455', 'Royal College Niners Event - Snickers', NULL, 61, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-11 12:45:43', '2026-05-11 12:45:43', 18, 11),
(482, '26/LTP/456', 'Lanka Tiles Flags Placing Borella Outlet  -12th to 16th of May', '15 flags', 47, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-11 14:17:01', '2026-05-11 14:17:01', 13, 11),
(483, '26/NST/457', 'Ceregrow MT Activation - May', '9th May Started', 34, NULL, NULL, 'in_progress', '2026-05-08', '2026-05-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-11 15:55:35', '2026-05-11 15:55:35', 7, 9),
(484, '26/SMA/458', 'SMAK Dealer Convention & Sales Awards Night 2025', '7th of June \'26\r\nWater\'s Edge\r\nXtreme Entertainment\r\nLasantha Flora', 78, NULL, NULL, 'completed', '2026-05-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-11 17:46:41', '2026-06-08 14:27:22', 16, 11),
(485, '26/NST/459', 'Milo Dispenser Rent -April', 'Milo Dispenser Rent -April  2 Unit Rent', 34, NULL, NULL, 'in_progress', '2026-05-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-12 12:27:37', '2026-05-12 12:28:55', 29, 9),
(486, '26/NST/460', 'Milo Dispenser Rent -January', 'Milo Dispenser Rent -January  1 Unit', 34, NULL, NULL, 'in_progress', '2026-05-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-12 12:29:39', '2026-05-12 12:29:39', 29, 9),
(488, '26/NST/461', 'Milo Dispenser Rent -3 Unit May/June', NULL, 34, NULL, NULL, 'completed', '2026-05-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-12 12:46:13', '2026-05-12 12:46:13', 29, 9),
(489, '26/DIM/462', 'Roza pasta ISM Activation - May', '9th, 10th May', 57, NULL, NULL, 'completed', '2026-05-08', '2026-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-12 14:35:56', '2026-05-12 14:35:56', 7, 11),
(490, '26/NST/463', 'Nescafe gift box wrapping may month', NULL, 34, NULL, NULL, 'in_progress', '2026-05-08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-12 14:36:50', '2026-05-12 14:36:50', 17, 10),
(491, '26/ATL/464', 'Atlas Preschool Activation', NULL, 79, NULL, NULL, 'in_progress', '2026-05-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-13 12:20:28', '2026-05-13 12:20:28', 7, 11),
(492, '26/CAC/465', 'KFC Bamabalapitiya 30 Aniversary', NULL, 67, NULL, NULL, 'in_progress', '2026-05-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-13 14:42:12', '2026-05-13 14:42:12', 12, 11),
(493, '26/HEM/466', 'Dr. Naomali Lodging Radisson Blu Resort Galle', 'Radisson Blu\r\nHemas Galle Launch Event\r\n30.04.26\r\nSingle Room', 65, NULL, NULL, 'completed', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-14 17:07:24', '2026-05-14 17:07:24', 16, 11),
(494, '26/LTP/467', 'Lanka Tiles Vesak Lanterns Production', 'Delivery Location	\r\n	\r\n	\r\nNawala Lanka Tiles Showroom	105\r\nNugegoda Lanka Tiles Showroom	30\r\nPelawatta Lanka Tiles Showroom	25\r\nBorella Lanka Tiles Showroom	25\r\nFo Narahenpita Lanka Tiles Showroom	15', 47, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-14 17:29:46', '2026-05-14 17:29:46', 18, 11),
(495, '26/GSK/468', 'PFC Lightboards Reflexing   GSK /429 cost tranfer', 'February\r\nReflexing\r\nDhanushka', 48, NULL, NULL, 'cancelled', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-15 15:50:52', '2026-06-09 14:38:41', 16, 11),
(496, '26/DOM/469', 'Menu Card Printing', '11/05/2026\r\n\r\n5 Menu Cards\r\n4- BIA\r\n1- Dehiwala', 50, NULL, NULL, 'completed', '2026-05-11', '2026-05-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-18 15:11:46', '2026-05-18 15:11:59', 18, 11),
(497, '26/NST/470', 'milkmaid MT activation-may', 'dessert table and faluda & ice coffee', 34, NULL, NULL, 'in_progress', '2026-05-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-18 16:53:47', '2026-05-18 16:53:47', 13, 10),
(498, '26/NST/471', 'Milo MT Activation May', 'Milo Mt Activation May', 34, NULL, NULL, 'in_progress', '2026-05-22', '2026-05-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-19 11:05:46', '2026-05-19 11:05:46', 34, 9),
(499, '26/NST/472', 'Nescafe MT Activation-May', NULL, 34, NULL, NULL, 'in_progress', '2026-05-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-19 12:28:23', '2026-05-19 12:28:23', 13, 10),
(500, '26/NST/473', 'One Stop Permenet Outlet April', NULL, 34, NULL, NULL, 'in_progress', '2026-05-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-19 14:06:14', '2026-05-19 14:06:14', 7, 9),
(501, '26/NST/474', 'One Stop Permenet Outlet May', NULL, 34, NULL, NULL, 'in_progress', '2026-05-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-19 14:07:13', '2026-05-19 14:07:13', 7, 9),
(502, '26/NST/475', 'Nestamalt Avurudu Gemigedara Production -Rajendra Payment 75000/', 'As Per The Request By Nestamalt Brand Manager -Keshan', 34, NULL, NULL, 'in_progress', '2026-05-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-19 14:18:01', '2026-05-19 14:18:01', 29, 9),
(503, '26/RCL/476', 'Rocell Sales Event Wristbands', 'Dupont WristBands\r\n510 qty', 80, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-19 14:49:55', '2026-05-19 14:49:55', 16, 11),
(504, '26/GSK/477', 'Niners event iodex spray', NULL, 48, NULL, NULL, 'in_progress', '2026-05-19', '2026-05-29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-19 14:53:25', '2026-05-19 14:53:25', 12, 11),
(505, '26/DOM/478', 'Niners Event Dominos sales stall  26/DOM/492 Cost Tranfer', NULL, 50, NULL, NULL, 'cancelled', '2026-05-19', '2026-05-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-19 14:54:44', '2026-06-01 17:11:26', 12, 11),
(506, '26/MBM/479', 'Niners Event Snickers', NULL, 61, NULL, NULL, 'cancelled', '2026-05-19', '2026-05-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-19 14:56:04', '2026-05-21 12:06:49', 12, 11),
(507, '26/NST/480', 'Nestamalt Gift Pack', NULL, 34, NULL, NULL, 'in_progress', '2026-05-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-19 16:14:33', '2026-05-19 16:14:33', 29, 10),
(508, '26/DIM/481', 'Roza chef - Zahira college Maradana', '16th May', 57, NULL, NULL, 'completed', '2026-05-15', '2026-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-19 16:18:26', '2026-05-19 16:18:26', 7, 11),
(509, '26/DIM/482', 'Roza chef - BMICH', '17th May', 57, NULL, NULL, 'completed', '2026-05-17', '2026-05-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-19 16:19:41', '2026-05-19 16:19:41', 7, 11),
(510, '26/NST/483', 'Balance Anouncer Payment', NULL, 34, NULL, NULL, 'in_progress', '2026-05-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-19 17:27:34', '2026-05-19 17:27:34', 29, 10),
(511, '26/NST/484', 'Maggi Rasamusu and Cubes D to D - Eastern', '12th May', 34, NULL, NULL, 'completed', '2026-05-12', '2026-05-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-19 17:46:28', '2026-05-19 17:46:28', 7, 10),
(512, '26/NST/485', 'Daham Supplier Payment -Ads Store', NULL, 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-19 17:46:40', '2026-05-19 17:46:40', 29, 10),
(513, '26/NST/486', 'Jet Pack Permanent Activation  May', 'Jet Pack Permanent Activation', 34, NULL, NULL, 'in_progress', '2026-05-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-19 18:51:10', '2026-05-20 11:02:28', 34, 10),
(514, '26/NST/487', 'Nestamalt D2D -Mathugama Speciial Day 2', NULL, 34, NULL, NULL, 'in_progress', '2026-05-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-19 18:59:26', '2026-05-19 19:00:30', 17, 10),
(515, '26/NST/488', 'Milo Vendor Boy Activation @Sugathadasa Swimming Pool Complex', 'Milo Vendor Boy Activation @Sugathadasa Swimming Pool Complex', 34, NULL, NULL, 'in_progress', '2026-05-21', '2026-05-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-20 11:05:08', '2026-05-20 11:05:08', 34, 9),
(516, '26/DIF/489', 'Dialog Finance Projector Rent', '20th May', 56, NULL, NULL, 'completed', '2026-05-20', '2026-05-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-20 13:35:00', '2026-05-21 17:53:02', 7, 11),
(517, '26/NST/490', 'Milkmaid SMMT Activation (Hadji festivel)may month', '69 outlets', 34, NULL, NULL, 'in_progress', '2026-05-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-20 15:48:07', '2026-05-20 15:48:07', 17, 10),
(518, '26/DMG/491', 'Delmege Rasa Hamuwa', '25th, 26th, 27th May  (Matara, Galle, Deundara)', 35, NULL, NULL, 'in_progress', '2026-05-23', '2026-05-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-21 16:54:01', '2026-05-21 17:13:07', 7, 9),
(519, '26/ILM/492', 'T-Shirts Production', '100 qty T-shirts production for ILAA Maldives (Pvt) Ltd', 74, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-25 11:03:21', '2026-05-25 11:03:21', 19, 9),
(520, '26/ILM/493', 'Uniform Kits Production', '30 qty uniform kits production for ILAA Maldives (Pvt) Ltd', 74, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-25 11:04:48', '2026-05-25 11:04:48', 19, 9),
(521, '26/NST/494', 'Genaretoer Rent May', 'Genaretoer rent Milo Propaganda truck May', 34, NULL, NULL, 'in_progress', '2026-05-01', '2026-05-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-25 11:38:16', '2026-05-25 11:38:16', 29, 9),
(522, '26/NST/495', 'Nestomalt Lap Top Rent - May', 'Nestomalt Lap Top Rent - May', 34, NULL, NULL, 'in_progress', '2026-05-01', '2026-05-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-25 14:28:26', '2026-05-25 14:28:26', 34, 10),
(523, '26/NST/496', 'Maggi Easten SMMT Hadji Special Activation', NULL, 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-25 14:49:58', '2026-05-25 14:49:58', 17, 10),
(524, '26/NHL/497', 'Resourse Diabetic MT Activation May month', NULL, 69, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-25 14:52:46', '2026-05-25 14:52:46', 17, 11),
(525, '26/DOM/498', 'Dominos Niners Sponsorship', 'Dominos Niners Sponsorship', 50, NULL, NULL, 'pending', '2026-05-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-25 16:04:39', '2026-05-25 16:04:39', 29, 11),
(526, '26/DIM/499', 'Roza chef - Zahira college Maradana (23rd May)', '23rd May', 57, NULL, NULL, 'completed', '2026-05-22', '2026-05-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-25 18:00:07', '2026-05-25 18:00:07', 7, 11),
(527, '26/NST/515', 'Onestop Truck Activation - Torrington', '24th May', 34, NULL, NULL, 'cancelled', '2026-05-22', '2026-05-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-25 18:09:08', '2026-06-17 12:39:20', 7, 9),
(528, '26/NST/501', 'NP Nescafe Sampling - Thihagoda Temple Matara', '27th May', 34, NULL, NULL, 'completed', '2026-05-26', '2026-05-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-26 10:49:51', '2026-05-29 11:54:26', 7, 9),
(529, '26/NST/502', 'maggei Master Chef 2nd', 'maggei Master chef event', 34, NULL, NULL, 'pending', '2026-05-24', '2026-06-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-26 11:42:02', '2026-05-26 11:42:02', 12, 9),
(530, '26/GSK/503', 'iodex spray fusal Nugegoda', 'Lorry 2,Aboard 10,base with poles 10,Light board 2 Fixing & Remove', 48, NULL, NULL, 'pending', '2026-05-26', '2026-06-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-26 11:44:22', '2026-05-26 11:44:22', 12, 11),
(531, '26/GSK/504', 'iodex suwasahana wesak Kalapya Kandy', 'sample Distribute , 10*10 Stall & Promoter Boy & Girls', 48, NULL, NULL, 'pending', '2026-05-26', '2026-06-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-26 11:47:18', '2026-05-26 11:47:18', 12, 11),
(532, '26/GSK/505', 'iodex suwasahana mihinthalaya', 'Iodes 20*10 Stall ,Boy & Girls  For Sample', 48, NULL, NULL, 'pending', '2026-05-27', '2026-07-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-26 11:50:17', '2026-05-26 11:50:17', 12, 11),
(533, '26/CAC/506', 'niners Ride Event', NULL, 67, NULL, NULL, 'in_progress', '2026-05-24', '2026-05-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-26 12:30:29', '2026-05-26 12:30:29', 12, 11),
(534, '26/DIM/507', 'zara tea sampling activation', NULL, 57, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-26 12:30:43', '2026-05-26 12:30:43', 17, 11),
(535, '26/DMG/508', 'Delmage Rasa Hamuwa Client Transport', NULL, 35, NULL, NULL, 'in_progress', '2026-05-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-26 13:12:01', '2026-05-26 13:12:01', 7, 9),
(536, '26/ALS/509', 'ODO Plush SPAR Activation - May', '23rd May Start', 63, NULL, NULL, 'in_progress', '2026-05-23', '2026-05-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-26 15:01:21', '2026-05-26 15:04:19', 7, 9),
(537, '26/LIN/510', 'Niners Sponshership', NULL, 81, NULL, NULL, 'in_progress', '2026-05-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-26 15:46:43', '2026-05-26 15:46:43', 29, 11),
(538, '26/NST/511', 'Nestomalt marothan independing square-may23', NULL, 34, NULL, NULL, 'in_progress', '2026-05-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-27 10:59:57', '2026-05-27 10:59:57', 13, 9),
(539, '26/DOM/512', 'Wadduwa Sales Conference', NULL, 50, NULL, NULL, 'in_progress', '2026-05-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-27 14:52:20', '2026-05-27 14:52:20', 12, 11),
(540, '26/GSK/513', 'Niners Grand prix Iodex Spaonshership', NULL, 48, NULL, NULL, 'in_progress', '2026-05-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-27 16:46:55', '2026-05-27 16:46:55', 29, 11),
(541, '26/NST/514', 'NP Activation - Katharagama', '29th, 30th, 31st May', 34, NULL, NULL, 'in_progress', '2026-05-28', '2026-05-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-28 13:00:06', '2026-05-28 13:00:06', 7, 9),
(542, '26/NST/516', 'Matara YFM Aurudu Event', 'Matara YFM Aurudu Event', 34, NULL, NULL, 'completed', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-01 14:05:41', '2026-06-01 14:05:41', 24, 9),
(543, '26/DIM/517', 'Roza chef - Gangarama tample', '30th May', 57, NULL, NULL, 'completed', '2026-05-29', '2026-05-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-01 17:14:00', '2026-06-01 17:14:00', 7, 11),
(544, '26/CAC/518', 'Ride Niners Sponshership', NULL, 67, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-01 17:34:09', '2026-06-01 17:34:09', 29, 11),
(545, '26/LTP/519', 'Lanka Tiles -sponsorship', NULL, 47, NULL, NULL, 'in_progress', '2026-06-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-01 17:35:47', '2026-06-01 17:35:47', 29, 11),
(546, '26/SUN/520', 'Niners  Extra -Sponshership', NULL, 41, NULL, NULL, 'in_progress', '2026-06-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-02 12:44:18', '2026-06-02 12:44:18', 16, 11),
(547, '26/SUN/521', 'Niners  -Sponshership', NULL, 41, NULL, NULL, 'in_progress', '2026-06-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-02 12:45:20', '2026-06-02 12:45:20', 16, 11),
(548, '26/CTC/522', 'Niners  -Sponshership CTC', NULL, 82, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-02 12:55:32', '2026-06-02 12:55:32', 16, 11),
(549, '26/FRH/523', 'Fresh Harvest Social Media May \'26', 'Social Media Handling Fb & Insta\r\nAnu', 64, NULL, NULL, 'completed', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-02 13:16:44', '2026-06-02 13:16:44', 16, 11),
(550, '26/DOM/524', 'domino\'s Board Printing (BIA) - 24inch * 48 inch', '01/02/2026\r\n1 baord - double side print\r\nBreakfast menu one side , other side cheese burst', 50, NULL, NULL, 'completed', '2026-06-01', '2026-06-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-02 13:39:39', '2026-06-02 13:41:17', 18, 11),
(551, '26/ATL/525', 'ATLAS Pre School Activation - June', '3rd of June 2026 - 30th June 2026', 79, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-02 18:23:10', '2026-06-02 18:23:10', 7, 11),
(552, '26/DIM/526', 'Roza chef - Paliyagoda Diamond Office', '3rd June (dansal)', 57, NULL, NULL, 'in_progress', '2026-06-03', '2026-06-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-03 10:07:00', '2026-06-03 10:07:00', 7, 11),
(553, '26/DIM/527', 'Diamond - Kingsbury Event', '1st June ( 2 Ushering girls)', 57, NULL, NULL, 'completed', '2026-06-01', '2026-06-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-03 12:11:53', '2026-06-03 12:11:53', 7, 11),
(554, '26/DIM/528', 'Diamond MT Activation june', NULL, 57, NULL, NULL, 'in_progress', '2026-06-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-03 13:38:13', '2026-06-09 11:03:09', 17, 11),
(555, '26/NST/529', 'Milo MT Activation June', 'Milo MT Activation June\r\nWith sampling', 34, NULL, NULL, 'in_progress', '2026-06-05', '2026-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-03 17:20:47', '2026-06-03 17:20:47', 34, 9),
(556, '26/DMG/530', 'Delmage Rasa Hamuwa Chef Payment', NULL, 35, NULL, NULL, 'in_progress', '2026-06-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-04 16:20:45', '2026-06-04 16:20:45', 7, 9),
(557, '26/NST/531', 'Nuwan India Tea Bag Purchasing', NULL, 34, NULL, NULL, 'in_progress', '2026-06-08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-08 12:21:21', '2026-06-08 12:21:21', 29, 10),
(558, '26/NST/532', 'Nestomalt Marothan Race cource & Galle face-june 7', NULL, 34, NULL, NULL, 'in_progress', '2026-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-08 12:54:46', '2026-06-08 12:54:46', 13, 9),
(559, '26/NST/533', 'Nestomalt ISM 130 Outlets  Activation', NULL, 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-08 12:54:53', '2026-06-08 12:54:53', 17, 10),
(560, '26/GSK/534', 'Iodex Spray Hiru Sir John Tarbat Wennappuwa', 'Wennapuwa Public Ground\r\n6th & 7th of June\r\nXtreme Entertainment', 48, NULL, NULL, 'completed', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-08 14:35:01', '2026-06-08 14:35:01', 16, 11),
(561, '26/LTP/535', 'Sofa Purchasing-Lanka Tiles', NULL, 47, NULL, NULL, 'in_progress', '2026-06-08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-08 17:06:07', '2026-06-08 17:06:07', 29, 11),
(562, '26/DOM/536', 'Dominos Branding Blue water Hotel Wadduwa', '2 light box ,5 Dominos Boxes  Fixing & RemoeingOne Lorry , Labour', 50, NULL, NULL, 'in_progress', '2026-06-01', '2026-06-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-09 10:25:59', '2026-06-09 10:25:59', 12, 11),
(563, '26/GSK/537', 'Iodex Spray Futsal branding 360 Nugegoda', 'A board 10,Light board 2, flags poles  with base 10 Lorry 1', 48, NULL, NULL, 'in_progress', '2026-06-04', '2026-06-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-09 10:28:25', '2026-06-09 10:28:25', 12, 11),
(564, '26/LIM/538', 'Lion Max MT Activation June', NULL, 77, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-09 11:06:21', '2026-06-09 11:06:21', 17, 11),
(565, '26/NST/539', 'Maggi MT Activation June', NULL, 34, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-09 11:09:23', '2026-06-09 11:09:23', 17, 9),
(566, '26/UNI/540', 'uniliver sunlight Bucket Delivery', 'sathosa outlet sunlight Bucket Delivery island wide', 83, NULL, NULL, 'in_progress', '2026-06-08', '2026-06-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-09 11:11:47', '2026-06-09 11:11:47', 12, 11),
(567, '26/GSK/541', 'iodex  suwa sahana poson poya daladamaligawa kandy', 'iodex  sampling ,bag delivery,', 48, NULL, NULL, 'pending', '2026-06-26', '2026-07-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-09 11:15:02', '2026-06-09 11:15:02', 12, 11),
(568, '26/GSK/542', 'Field-Site First Aid in Sports Acute Injury Management Sri Lanka Foundation', '100 Gift pack,10 flags ,2 light box,', 48, NULL, NULL, 'in_progress', '2026-06-09', '2026-06-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-09 11:25:47', '2026-06-09 11:25:47', 12, 11),
(569, '26/NST/543', 'Milo RTD Stock Delivering to St.Thomas College', 'Milo RTD Stock Delivering to St.Thomas College', 34, NULL, NULL, 'in_progress', '2026-06-13', '2026-06-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-09 12:52:27', '2026-06-09 12:52:52', 34, 9),
(570, '26/GSK/544', 'PFC Pharmacist Program Horana Sanhinda', 'Sanhinda Reception Hall Horana\r\nEvent Date June 15th 2026\r\n150 Pax', 48, NULL, NULL, 'in_progress', '2026-06-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-09 14:35:38', '2026-06-12 10:05:30', 16, 11),
(571, '26/DIM/545', 'Roza Chef - Kattankudi', '5th, 6th, 7th June', 57, NULL, NULL, 'completed', '2026-06-05', '2026-06-08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-10 14:55:13', '2026-06-10 14:55:13', 7, 11),
(572, '26/DRA/546', 'Dragons Awards', NULL, 84, NULL, NULL, 'in_progress', '2026-06-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-10 15:28:48', '2026-06-10 15:28:48', 18, 11),
(573, '26/DIF/547', 'Dialog  Activation Trinco', '5th, 6th June', 56, NULL, NULL, 'completed', '2026-06-04', '2026-06-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-11 10:37:19', '2026-06-11 10:37:19', 7, 9),
(574, '26/GSK/548', 'iodex spray kandy slit', 'a board 10,flags 10,2 boys  accommodation ,transport ,food', 48, NULL, NULL, 'in_progress', '2026-06-11', '2026-06-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-11 11:11:52', '2026-06-11 11:11:52', 12, 11),
(575, '26/GSK/549', 'iodex spary bascket ball  event sri jayawardanepura  univercity', '2 boys , a board 10, flags pole with base 10 ,', 48, NULL, NULL, 'in_progress', '2026-06-11', '2026-06-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-11 11:25:42', '2026-06-11 11:25:42', 12, 11),
(576, '26/GSK/550', 'Ceylon Masters International Badminton Championships 2026 from Iodex Spray.', 'Display of 20 Iodex Spray flags\r\n10 A‑boards across the venue.\r\nConducting sampling using Iodex spray 10*10 stall\r\nConducting Iodex Spray selling activation  \r\nAllocation of 3 promoters', 48, NULL, NULL, 'pending', '2026-06-22', '2026-07-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-11 11:28:59', '2026-06-11 11:28:59', 12, 11),
(577, '26/NST/551', 'Nestomalt Marothan Activation negombo-june', NULL, 34, NULL, NULL, 'in_progress', '2026-06-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-11 12:07:52', '2026-06-11 12:07:52', 13, 9),
(578, '26/GSK/552', 'PFC Midwife Event - Galle', '14th June', 48, NULL, NULL, 'in_progress', '2026-06-12', '2026-06-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-11 13:36:53', '2026-06-11 13:36:53', 7, 11),
(579, '26/DMG/553', 'Delmege Event @ Hilton Residencies', 'Delmege Event @ Hilton Residencies', 35, NULL, NULL, 'in_progress', '2026-06-13', '2026-06-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-11 14:34:14', '2026-06-11 14:34:14', 34, 9),
(580, '26/NST/554', 'Nestamalt D2D Eastern June', NULL, 34, NULL, NULL, 'completed', '2026-06-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-11 15:35:49', '2026-06-11 15:35:49', 7, 10),
(581, '26/ATL/555', 'Atlas Pre School Activation-  May Month Additional Cost', 'Additional Costs', 79, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-12 13:05:19', '2026-06-12 13:05:19', 18, 11),
(582, '26/SUN/556', 'TFOB trace city Watawala', 'TFOB trace city Watawala', 41, NULL, NULL, 'in_progress', '2026-06-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-15 11:41:21', '2026-06-15 11:41:21', 7, 11),
(583, '26/DBL/557', 'Darley Butler T Shirt Production -1000 qty', '1000 qty per month', 55, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-15 13:17:05', '2026-06-15 13:17:05', 18, 10),
(584, '26/NST/558', 'Nescafe Band Payment', NULL, 34, NULL, NULL, 'in_progress', '2026-06-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-15 13:53:31', '2026-06-15 13:53:31', 29, 10),
(585, '26/GSK/559', 'Sensodyne Toothbrush Activation', NULL, 48, NULL, NULL, 'in_progress', '2026-06-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-15 14:40:04', '2026-06-15 14:40:04', 7, 11),
(586, '26/NST/560', 'Maggi Papare ISM Activation - June', '12th June Started', 34, NULL, NULL, 'in_progress', '2026-06-11', '2026-06-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-15 17:14:21', '2026-06-15 17:14:21', 7, 10),
(587, '26/NST/561', 'One Stop Permanet Outlet June', 'One Stop Permanent Outlet June', 34, NULL, NULL, 'in_progress', '2026-06-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-16 12:57:37', '2026-06-16 12:57:37', 24, 9),
(588, '26/CTP/562', 'Client Meeting Day -Transport', NULL, 90, NULL, NULL, 'in_progress', '2026-06-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-16 13:34:28', '2026-07-01 22:52:31', 34, 9),
(589, '26/FOR/563', 'Mininthale Activation-Fortune Soya', NULL, 91, NULL, NULL, 'in_progress', '2026-06-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-16 13:36:42', '2026-07-01 05:38:58', 19, 9),
(590, '26/NST/564', 'Milkmaid Activation Col South', 'Milkmaid activation Col South Pettha Branding Dummy inoivec', 34, NULL, NULL, 'in_progress', '2026-06-10', '2026-06-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-16 16:35:48', '2026-06-16 16:35:48', 12, 9),
(591, '26/GSK/565', 'john Trabat  beliatta iodex spray event', '3 boy , 1superviosr,20*10 main Stall , Flags 10 ,A board 10 ,', 48, NULL, NULL, 'in_progress', '2026-06-16', '2026-06-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-16 16:51:25', '2026-06-16 16:51:25', 12, 11),
(592, '26/ABA/566', 'Xioami Outlet Opening - OGF Food Court', 'Event Day - 17/06/2026', 58, NULL, NULL, 'in_progress', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-16 17:44:46', '2026-06-16 17:44:46', 12, 11),
(593, '26/DOM/567', 'Domino\'s Outlet Opening - Chillaw', '19/06/2026 Opening day', 50, NULL, NULL, 'in_progress', NULL, NULL, 500.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-17 13:03:43', '2026-07-02 23:44:13', 18, 11),
(594, '26/NST/568', 'Nestomalt Marothan Activation-Rajagiriya', NULL, 34, NULL, NULL, 'cancelled', '2026-07-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-07-01 05:34:03', '2026-07-05 23:59:26', 13, 9);

-- --------------------------------------------------------

--
-- Table structure for table `employers_salary_sheet_item`
--

CREATE TABLE `employers_salary_sheet_item` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `position_id` bigint(20) UNSIGNED NOT NULL,
  `promoter_id` bigint(20) UNSIGNED DEFAULT NULL,
  `attendance_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `payment_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `coordinator_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `allowance_rules` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `allowances_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Stores dynamic allowances: [{"allowance_id": 1, "allowance_name": "Transport", "amount": 500, "type": "fixed"}]',
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `sheet_no` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `employers_salary_sheet_item`
--

INSERT INTO `employers_salary_sheet_item` (`id`, `no`, `location`, `position_id`, `promoter_id`, `attendance_data`, `payment_data`, `coordinator_details`, `allowance_rules`, `allowances_data`, `job_id`, `sheet_no`, `created_at`, `updated_at`) VALUES
(518, 'ITM/2026/01/001', NULL, 9, 46, '{\"attendance\":{\"2026-01-04\":1,\"2026-01-07\":1},\"total\":2,\"amount\":3000,\"promoter_id\":\"46\",\"promoter_name\":\"K.D.C.P Madushan\",\"position\":\"Suppervisor\"}', '{\"amount\":3000,\"food_allowance\":0,\"expenses\":0,\"accommodation_allowance\":0,\"hold_for_weeks\":0,\"net_amount\":5000}', NULL, NULL, '{\"Transport Allowance\":\"2000\"}', 21, 'SAL/2026/01/001', '2026-01-20 17:37:36', '2026-01-20 17:37:36'),
(519, 'ITM/2026/01/002', NULL, 2, 53, '{\"attendance\":{\"2026-01-16\":1},\"total\":1,\"amount\":2000,\"promoter_id\":\"53\",\"promoter_name\":\"M.C Nilupul\",\"position\":\"Boy Promoter\"}', '{\"amount\":2000,\"food_allowance\":0,\"expenses\":0,\"accommodation_allowance\":0,\"hold_for_weeks\":0,\"net_amount\":2500}', '{\"coordinator_id\":\"COO\\/004\",\"current_coordinator\":\"Ajith Fernando\",\"amount\":200}', NULL, '{\"Transport Allowance\":\"500\"}', 64, 'SAL/2026/01/002', '2026-01-20 17:46:58', '2026-01-20 17:46:58'),
(520, 'ITM/2026/01/003', NULL, 2, 50, '{\"attendance\":{\"2026-01-16\":1},\"total\":1,\"amount\":2000,\"promoter_id\":\"50\",\"promoter_name\":\"M.D Rashmika\",\"position\":\"Boy Promoter\"}', '{\"amount\":2000,\"food_allowance\":0,\"expenses\":0,\"accommodation_allowance\":0,\"hold_for_weeks\":0,\"net_amount\":2500}', '{\"coordinator_id\":\"COO\\/004\",\"current_coordinator\":\"Ajith Fernando\",\"amount\":200}', NULL, '{\"Transport Allowance\":\"500\"}', 64, 'SAL/2026/01/002', '2026-01-20 17:46:58', '2026-01-20 17:46:58'),
(521, 'ITM/2026/01/004', NULL, 2, 55, '{\"attendance\":{\"2026-01-16\":1},\"total\":1,\"amount\":2000,\"promoter_id\":\"55\",\"promoter_name\":\"Ajith Fernando\",\"position\":\"Boy Promoter\"}', '{\"amount\":2000,\"food_allowance\":0,\"expenses\":0,\"accommodation_allowance\":0,\"hold_for_weeks\":0,\"net_amount\":2500}', '{\"coordinator_id\":\"COO\\/004\",\"current_coordinator\":\"Ajith Fernando\",\"amount\":200}', NULL, '{\"Transport Allowance\":\"500\"}', 64, 'SAL/2026/01/002', '2026-01-20 17:46:58', '2026-01-20 17:46:58'),
(522, 'ITM/2026/01/005', NULL, 9, 46, '{\"attendance\":{\"2026-01-07\":0,\"2026-01-08\":0,\"2026-01-09\":0,\"2026-01-10\":0,\"2026-01-11\":1,\"2026-01-12\":0,\"2026-01-13\":0,\"2026-01-14\":0,\"2026-01-15\":0,\"2026-01-16\":0,\"2026-01-17\":0,\"2026-01-18\":0,\"2026-01-19\":0,\"2026-01-20\":0,\"2026-01-21\":0},\"total\":1,\"amount\":1500,\"promoter_id\":\"46\",\"promoter_name\":\"K.D.C.P Madushan\",\"position\":\"Suppervisor\"}', '{\"amount\":1500,\"food_allowance\":0,\"expenses\":0,\"accommodation_allowance\":0,\"hold_for_weeks\":0,\"net_amount\":2500}', NULL, NULL, '{\"Transport Allowance\":\"1000\"}', 34, 'SAL/2026/01/003', '2026-01-20 18:05:39', '2026-01-20 18:05:39'),
(523, 'ITM/2026/01/006', NULL, 9, 46, '{\"attendance\":{\"2026-01-15\":1},\"total\":1,\"amount\":2000,\"promoter_id\":\"46\",\"promoter_name\":\"K.D.C.P Madushan\",\"position\":\"Suppervisor\"}', '{\"amount\":2000,\"food_allowance\":0,\"expenses\":0,\"accommodation_allowance\":0,\"hold_for_weeks\":0,\"net_amount\":2000}', NULL, NULL, NULL, 80, 'SAL/2026/01/004', '2026-01-21 14:36:17', '2026-01-21 14:36:17'),
(524, 'ITM/2026/01/007', NULL, 9, 46, '{\"attendance\":{\"2026-01-09\":1,\"2026-01-16\":1},\"total\":2,\"amount\":1500,\"promoter_id\":\"46\",\"promoter_name\":\"K.D.C.P Madushan\",\"position\":\"Suppervisor\"}', '{\"amount\":3000,\"food_allowance\":0,\"expenses\":0,\"accommodation_allowance\":0,\"hold_for_weeks\":0,\"net_amount\":5000}', NULL, NULL, '{\"Transport Allowance\":\"2000\"}', 22, 'SAL/2026/01/005', '2026-01-22 02:04:06', '2026-01-22 02:04:06'),
(525, 'ITM/2026/01/008', NULL, 9, 44, '{\"attendance\":{\"2026-01-15\":1,\"2026-01-16\":1,\"2026-01-17\":1},\"total\":3,\"amount\":3000,\"promoter_id\":\"44\",\"promoter_name\":\"Sharith Dilshan\",\"position\":\"Suppervisor\"}', '{\"amount\":0,\"food_allowance\":0,\"expenses\":0,\"accommodation_allowance\":0,\"hold_for_weeks\":0,\"net_amount\":500}', '{\"coordinator_id\":\"COO\\/003\",\"current_coordinator\":\"Sharith Dilshan\",\"amount\":600}', NULL, '{\"Transport Allowance\":\"500\"}', 56, 'SAL/2026/01/006', '2026-01-22 09:28:06', '2026-01-22 09:28:06'),
(526, 'ITM/2026/01/009', NULL, 1, 57, '{\"attendance\":{\"2026-01-13\":1},\"total\":1,\"amount\":2500,\"promoter_id\":\"57\",\"promoter_name\":\"R N Dulanjalee\",\"position\":\"Girl Promoter\"}', '{\"amount\":2500,\"food_allowance\":0,\"expenses\":0,\"accommodation_allowance\":0,\"hold_for_weeks\":0,\"net_amount\":3000}', '{\"coordinator_id\":\"COO\\/007\",\"current_coordinator\":\"M.M.A.N.Danushika Dulanjalie\",\"amount\":200}', NULL, '{\"Transport Allowance\":\"500\"}', 83, 'SAL/2026/01/007', '2026-01-22 09:50:52', '2026-01-22 09:50:52'),
(530, 'ITM/2026/01/010', NULL, 2, 46, '{\"attendance\":{\"2026-01-22\":1},\"total\":1,\"amount\":2500,\"promoter_id\":\"46\",\"promoter_name\":\"K.D.C.P Madushan\",\"position\":\"Boy Promoter\"}', '{\"amount\":2500,\"food_allowance\":0,\"expenses\":0,\"accommodation_allowance\":0,\"hold_for_weeks\":0,\"net_amount\":2500}', NULL, NULL, NULL, 39, 'SAL/2026/01/008', '2026-01-27 18:08:21', '2026-01-27 18:08:21'),
(535, 'ITM/2026/01/011', NULL, 10, 47, '{\"attendance\":{\"2026-01-22\":1,\"2026-01-23\":1,\"2026-01-24\":1},\"total\":3,\"amount\":30000,\"promoter_id\":\"47\",\"promoter_name\":\"I S dunuthilaka\",\"position\":\"Chef\"}', '{\"amount\":30000,\"food_allowance\":0,\"expenses\":0,\"accommodation_allowance\":0,\"hold_for_weeks\":0,\"net_amount\":30000}', NULL, NULL, NULL, 101, 'SAL/2026/01/009', '2026-01-28 11:44:45', '2026-01-28 11:44:45'),
(544, 'ITM/2026/01/012', NULL, 9, 37, '{\"attendance\":{\"2026-01-21\":0,\"2026-01-22\":0,\"2026-01-23\":0,\"2026-01-24\":1,\"2026-01-25\":1,\"2026-01-26\":1,\"2026-01-27\":1},\"total\":4,\"amount\":11000,\"promoter_id\":\"37\",\"promoter_name\":\"H.A.D.Shanitha\",\"position\":\"Suppervisor\"}', '{\"amount\":11000,\"food_allowance\":0,\"expenses\":0,\"accommodation_allowance\":0,\"hold_for_weeks\":0,\"net_amount\":12000}', NULL, NULL, '{\"water\":\"1000\"}', 60, 'SAL/2026/01/012', '2026-01-28 15:57:19', '2026-01-28 15:57:19'),
(545, 'ITM/2026/01/013', NULL, 9, 134, '{\"attendance\":{\"2026-01-21\":0,\"2026-01-22\":1,\"2026-01-23\":1,\"2026-01-24\":1,\"2026-01-25\":1,\"2026-01-26\":1,\"2026-01-27\":1},\"total\":6,\"amount\":16500,\"promoter_id\":\"134\",\"promoter_name\":\"W D R Ovinda\",\"position\":\"Suppervisor\"}', '{\"amount\":16500,\"food_allowance\":0,\"expenses\":0,\"accommodation_allowance\":0,\"hold_for_weeks\":0,\"net_amount\":16500}', NULL, NULL, '{\"water\":null}', 60, 'SAL/2026/01/012', '2026-01-28 15:57:19', '2026-01-28 15:57:19'),
(546, 'ITM/2026/01/014', 'pettah', 2, 44, '{\"attendance\":{\"2026-01-21\":1,\"2026-01-22\":1,\"2026-01-23\":1,\"2026-01-24\":1,\"2026-01-25\":1,\"2026-01-26\":1,\"2026-01-27\":1},\"total\":7,\"amount\":21000,\"promoter_id\":\"44\",\"promoter_name\":\"Sharith Dilshan\",\"position\":\"Boy Promoter\"}', '{\"amount\":21000,\"food_allowance\":0,\"expenses\":0,\"accommodation_allowance\":0,\"hold_for_weeks\":0,\"net_amount\":21000}', '{\"coordinator_id\":\"COO\\/003\",\"current_coordinator\":\"Sharith Dilshan\",\"amount\":1400}', NULL, '{\"water\":null}', 60, 'SAL/2026/01/012', '2026-01-28 15:57:19', '2026-01-28 15:57:19'),
(547, 'ITM/2026/01/015', 'ragama', 2, 44, '{\"attendance\":{\"2026-01-21\":0,\"2026-01-22\":0,\"2026-01-23\":0,\"2026-01-24\":1,\"2026-01-25\":1,\"2026-01-26\":1,\"2026-01-27\":1},\"total\":4,\"amount\":12000,\"promoter_id\":\"44\",\"promoter_name\":\"Sharith Dilshan\",\"position\":\"Boy Promoter\"}', '{\"amount\":12000,\"food_allowance\":0,\"expenses\":0,\"accommodation_allowance\":0,\"hold_for_weeks\":0,\"net_amount\":12000}', '{\"coordinator_id\":\"COO\\/003\",\"current_coordinator\":\"Sharith Dilshan\",\"amount\":800}', NULL, '{\"water\":null}', 60, 'SAL/2026/01/012', '2026-01-28 15:57:19', '2026-01-28 15:57:19'),
(548, 'ITM/2026/01/016', 'ragama', 2, 44, '{\"attendance\":{\"2026-01-21\":0,\"2026-01-22\":0,\"2026-01-23\":0,\"2026-01-24\":1,\"2026-01-25\":1,\"2026-01-26\":1,\"2026-01-27\":1},\"total\":4,\"amount\":12000,\"promoter_id\":\"44\",\"promoter_name\":\"Sharith Dilshan\",\"position\":\"Boy Promoter\"}', '{\"amount\":12000,\"food_allowance\":0,\"expenses\":0,\"accommodation_allowance\":0,\"hold_for_weeks\":0,\"net_amount\":12250}', '{\"coordinator_id\":\"COO\\/003\",\"current_coordinator\":\"Sharith Dilshan\",\"amount\":800}', NULL, '{\"water\":\"250\"}', 60, 'SAL/2026/01/012', '2026-01-28 15:57:19', '2026-01-28 15:57:19'),
(549, 'ITM/2026/01/017', 'keththarama', 9, 44, '{\"attendance\":{\"2026-01-22\":1,\"2026-01-24\":1,\"2026-01-27\":1},\"total\":3,\"amount\":10500,\"promoter_id\":\"44\",\"promoter_name\":\"Sharith Dilshan\",\"position\":\"Suppervisor\"}', '{\"amount\":10500,\"food_allowance\":0,\"expenses\":0,\"accommodation_allowance\":0,\"hold_for_weeks\":0,\"net_amount\":10500}', '{\"coordinator_id\":\"COO\\/003\",\"current_coordinator\":\"Sharith Dilshan\",\"amount\":600}', NULL, NULL, 89, 'SAL/2026/01/013', '2026-01-28 18:53:59', '2026-01-28 18:53:59'),
(550, 'ITM/2026/01/018', 'keththarama', 2, 44, '{\"attendance\":{\"2026-01-22\":6,\"2026-01-24\":6,\"2026-01-27\":6},\"total\":18,\"amount\":63000,\"promoter_id\":\"44\",\"promoter_name\":\"Sharith Dilshan\",\"position\":\"Boy Promoter\"}', '{\"amount\":63000,\"food_allowance\":0,\"expenses\":0,\"accommodation_allowance\":0,\"hold_for_weeks\":0,\"net_amount\":63000}', '{\"coordinator_id\":\"COO\\/003\",\"current_coordinator\":\"Sharith Dilshan\",\"amount\":3600}', NULL, NULL, 89, 'SAL/2026/01/013', '2026-01-28 18:53:59', '2026-01-28 18:53:59'),
(551, 'ITM/2026/06/001', NULL, 9, 156, '{\"attendance\":{\"2025-12-31\":0},\"total\":0,\"amount\":0,\"promoter_id\":\"156\",\"promoter_name\":\"A.A Tharushi Thathsarani\",\"position\":\"Suppervisor\"}', '{\"amount\":0,\"food_allowance\":0,\"expenses\":0,\"accommodation_allowance\":0,\"hold_for_weeks\":0,\"net_amount\":300}', '{\"coordinator_id\":\"COO\\/002\",\"current_coordinator\":\"H.A.D.S Parathibhana\",\"amount\":0}', NULL, '{\"Food Allowance\":\"300\"}', 15, 'SAL/2026/06/001', '2026-06-30 04:43:48', '2026-06-30 04:43:48'),
(552, 'ITM/2026/06/002', NULL, 9, 55, '{\"attendance\":{\"2025-12-31\":0},\"total\":0,\"amount\":0,\"promoter_id\":\"55\",\"promoter_name\":\"Ajith Fernando\",\"position\":\"Suppervisor\"}', '{\"amount\":0,\"food_allowance\":0,\"expenses\":0,\"accommodation_allowance\":0,\"hold_for_weeks\":0,\"net_amount\":300}', '{\"coordinator_id\":\"COO\\/002\",\"current_coordinator\":\"H.A.D.S Parathibhana\",\"amount\":0}', NULL, '{\"Food Allowance\":\"300\"}', 15, 'SAL/2026/06/002', '2026-06-30 04:45:28', '2026-06-30 04:45:28'),
(553, 'ITM/2026/06/003', NULL, 9, 55, '{\"attendance\":{\"2025-12-31\":0},\"total\":0,\"amount\":0,\"promoter_id\":\"55\",\"promoter_name\":\"Ajith Fernando\",\"position\":\"Suppervisor\"}', '{\"amount\":0,\"food_allowance\":0,\"expenses\":0,\"accommodation_allowance\":0,\"hold_for_weeks\":0,\"net_amount\":300}', '{\"coordinator_id\":\"COO\\/002\",\"current_coordinator\":\"H.A.D.S Parathibhana\",\"amount\":0}', NULL, '{\"Food Allowance\":\"300\"}', 15, 'SAL/2026/06/002', '2026-06-30 04:45:28', '2026-06-30 04:45:28'),
(554, 'ITM/2026/06/004', NULL, 1, 105, '{\"attendance\":{\"2025-12-31\":0},\"total\":0,\"amount\":0,\"promoter_id\":\"105\",\"promoter_name\":\"Arumugan Janani\",\"position\":\"Girl Promoter\"}', '{\"amount\":0,\"food_allowance\":0,\"expenses\":0,\"accommodation_allowance\":0,\"hold_for_weeks\":0,\"net_amount\":300}', NULL, NULL, '{\"Food Allowance\":\"300\"}', 15, 'SAL/2026/06/002', '2026-06-30 04:45:28', '2026-06-30 04:45:28'),
(555, 'ITM/2026/06/005', NULL, 9, 170, '{\"attendance\":{\"2025-12-31\":0},\"total\":0,\"amount\":0,\"promoter_id\":\"170\",\"promoter_name\":\"Dinushika Nawanjali\",\"position\":\"Suppervisor\"}', '{\"amount\":0,\"food_allowance\":0,\"expenses\":0,\"accommodation_allowance\":0,\"hold_for_weeks\":0,\"net_amount\":300}', '{\"coordinator_id\":\"COO\\/002\",\"current_coordinator\":\"H.A.D.S Parathibhana\",\"amount\":0}', NULL, '{\"Food Allowance\":\"300\"}', 15, 'SAL/2026/06/002', '2026-06-30 04:45:28', '2026-06-30 04:45:28'),
(556, 'ITM/2026/06/006', NULL, 1, 154, '{\"attendance\":{\"2025-12-31\":0},\"total\":0,\"amount\":0,\"promoter_id\":\"154\",\"promoter_name\":\"G.A Chathuni Ruwanthika\",\"position\":\"Girl Promoter\"}', '{\"amount\":0,\"food_allowance\":0,\"expenses\":0,\"accommodation_allowance\":0,\"hold_for_weeks\":0,\"net_amount\":300}', NULL, NULL, '{\"Food Allowance\":\"300\"}', 15, 'SAL/2026/06/002', '2026-06-30 04:45:28', '2026-06-30 04:45:28'),
(557, 'ITM/2026/06/007', NULL, 9, 43, '{\"attendance\":{\"2025-12-31\":0},\"total\":0,\"amount\":0,\"promoter_id\":\"43\",\"promoter_name\":\"E.M.M.Bhagya Sandamali\",\"position\":\"Suppervisor\"}', '{\"amount\":0,\"food_allowance\":0,\"expenses\":0,\"accommodation_allowance\":0,\"hold_for_weeks\":0,\"net_amount\":300}', NULL, NULL, '{\"Food Allowance\":\"300\"}', 15, 'SAL/2026/06/002', '2026-06-30 04:45:28', '2026-06-30 04:45:28'),
(558, 'ITM/2026/06/008', NULL, 9, 156, '{\"attendance\":[],\"total\":0,\"amount\":0,\"promoter_id\":\"156\",\"promoter_name\":\"A.A Tharushi Thathsarani\",\"position\":\"Suppervisor\"}', '{\"amount\":0,\"food_allowance\":0,\"expenses\":0,\"accommodation_allowance\":0,\"hold_for_weeks\":0,\"net_amount\":0}', NULL, NULL, NULL, 592, 'SAL/2026/06/003', '2026-06-30 11:05:30', '2026-06-30 11:05:30'),
(559, 'ITM/2026/06/009', NULL, 9, 156, '{\"attendance\":[],\"total\":0,\"amount\":0,\"promoter_id\":\"156\",\"promoter_name\":\"A.A Tharushi Thathsarani\",\"position\":\"Suppervisor\"}', '{\"amount\":0,\"food_allowance\":0,\"expenses\":0,\"accommodation_allowance\":0,\"hold_for_weeks\":0,\"net_amount\":0}', NULL, NULL, NULL, 592, 'SAL/2026/06/003', '2026-06-30 11:05:30', '2026-06-30 11:05:30'),
(560, 'ITM/2026/06/010', NULL, 10, 156, '{\"attendance\":[],\"total\":0,\"amount\":0,\"promoter_id\":\"156\",\"promoter_name\":\"A.A Tharushi Thathsarani\",\"position\":\"Chef\"}', '{\"amount\":0,\"food_allowance\":0,\"expenses\":0,\"accommodation_allowance\":0,\"hold_for_weeks\":0,\"net_amount\":0}', NULL, NULL, NULL, 592, 'SAL/2026/06/003', '2026-06-30 11:05:30', '2026-06-30 11:05:30'),
(561, 'ITM/2026/06/011', NULL, 9, 55, '{\"attendance\":{\"2025-12-31\":0},\"total\":0,\"amount\":0,\"promoter_id\":\"55\",\"promoter_name\":\"Ajith Fernando\",\"position\":\"Suppervisor\"}', '{\"amount\":0,\"food_allowance\":0,\"expenses\":0,\"accommodation_allowance\":0,\"hold_for_weeks\":0,\"net_amount\":300}', '{\"coordinator_id\":\"COO\\/002\",\"current_coordinator\":\"H.A.D.S Parathibhana\",\"amount\":0}', NULL, '{\"Food Allowance\":\"300\"}', 15, 'SAL/2026/06/004', '2026-06-30 11:37:01', '2026-06-30 11:37:01'),
(562, 'ITM/2026/06/012', NULL, 9, 55, '{\"attendance\":{\"2025-12-31\":0},\"total\":0,\"amount\":0,\"promoter_id\":\"55\",\"promoter_name\":\"Ajith Fernando\",\"position\":\"Suppervisor\"}', '{\"amount\":0,\"food_allowance\":0,\"expenses\":0,\"accommodation_allowance\":0,\"hold_for_weeks\":0,\"net_amount\":300}', '{\"coordinator_id\":\"COO\\/002\",\"current_coordinator\":\"H.A.D.S Parathibhana\",\"amount\":0}', NULL, '{\"Food Allowance\":\"300\"}', 15, 'SAL/2026/06/004', '2026-06-30 11:37:01', '2026-06-30 11:37:01'),
(563, 'ITM/2026/06/013', NULL, 1, 105, '{\"attendance\":{\"2025-12-31\":0},\"total\":0,\"amount\":0,\"promoter_id\":\"105\",\"promoter_name\":\"Arumugan Janani\",\"position\":\"Girl Promoter\"}', '{\"amount\":0,\"food_allowance\":0,\"expenses\":0,\"accommodation_allowance\":0,\"hold_for_weeks\":0,\"net_amount\":300}', NULL, NULL, '{\"Food Allowance\":\"300\"}', 15, 'SAL/2026/06/004', '2026-06-30 11:37:01', '2026-06-30 11:37:01'),
(564, 'ITM/2026/06/014', NULL, 9, 170, '{\"attendance\":{\"2025-12-31\":0},\"total\":0,\"amount\":0,\"promoter_id\":\"170\",\"promoter_name\":\"Dinushika Nawanjali\",\"position\":\"Suppervisor\"}', '{\"amount\":0,\"food_allowance\":0,\"expenses\":0,\"accommodation_allowance\":0,\"hold_for_weeks\":0,\"net_amount\":300}', '{\"coordinator_id\":\"COO\\/002\",\"current_coordinator\":\"H.A.D.S Parathibhana\",\"amount\":0}', NULL, '{\"Food Allowance\":\"300\"}', 15, 'SAL/2026/06/004', '2026-06-30 11:37:01', '2026-06-30 11:37:01'),
(565, 'ITM/2026/06/015', NULL, 1, 154, '{\"attendance\":{\"2025-12-31\":0},\"total\":0,\"amount\":0,\"promoter_id\":\"154\",\"promoter_name\":\"G.A Chathuni Ruwanthika\",\"position\":\"Girl Promoter\"}', '{\"amount\":0,\"food_allowance\":0,\"expenses\":0,\"accommodation_allowance\":0,\"hold_for_weeks\":0,\"net_amount\":300}', NULL, NULL, '{\"Food Allowance\":\"300\"}', 15, 'SAL/2026/06/004', '2026-06-30 11:37:01', '2026-06-30 11:37:01'),
(566, 'ITM/2026/06/016', NULL, 9, 43, '{\"attendance\":{\"2025-12-31\":0},\"total\":0,\"amount\":0,\"promoter_id\":\"43\",\"promoter_name\":\"E.M.M.Bhagya Sandamali\",\"position\":\"Suppervisor\"}', '{\"amount\":0,\"food_allowance\":0,\"expenses\":0,\"accommodation_allowance\":0,\"hold_for_weeks\":0,\"net_amount\":300}', NULL, NULL, '{\"Food Allowance\":\"300\"}', 15, 'SAL/2026/06/004', '2026-06-30 11:37:01', '2026-06-30 11:37:01');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(20, '0001_01_01_000000_create_users_table', 1),
(21, '0001_01_01_000001_create_cache_table', 1),
(22, '0001_01_01_000002_create_jobs_table', 1),
(23, '2025_09_12_165049_create_permission_tables', 1),
(24, '2025_09_12_171204_create_clients_table', 1),
(25, '2025_09_12_172611_add_short_code_to_clients_table', 1),
(26, '2025_09_12_174028_create_custom_jobs_table', 1),
(27, '2025_09_12_180355_create_promoters_table', 1),
(28, '2025_09_12_193142_create_promoter_positions_table', 1),
(29, '2025_09_12_193630_add_position_id_to_promoters_table', 1),
(30, '2025_09_12_202622_create_coordinators_table', 1),
(31, '2025_09_12_210758_create_salary_sheets_table', 1),
(32, '2025_09_13_131839_add_job_and_attendance_fields_to_salary_sheets_table', 1),
(33, '2025_09_13_154400_create_position_wise_salary_rules_table', 1),
(34, '2025_09_13_155607_add_unique_constraint_to_position_wise_salary_rules_table', 1),
(35, '2025_09_13_193007_add_job_settings_to_custom_jobs_table', 1),
(36, '2025_09_14_010556_create_new_salary_sheet_table', 1),
(37, '2025_09_14_010601_create_employers_salary_sheet_item_table', 1),
(38, '2025_09_14_012936_fix_salary_sheet_migration_conflict', 1),
(39, '2025_09_17_151039_create_allowances_table', 2),
(40, '2025_09_17_151047_add_allowances_data_to_employers_salary_sheet_item_table', 2),
(41, '2025_09_17_155245_create_allowances_table', 2),
(42, '2025_09_17_155255_add_allowances_data_to_employers_salary_sheet_item_table', 2),
(43, '2025_09_17_195327_add_allowance_column_to_custom_jobs_table', 3),
(45, '2025_09_17_185901_create_allowances_table', 4),
(46, '2025_09_18_151605_add_xelenic_id_to_users_table', 5),
(47, '2025_09_19_024026_add_promoter_id_to_employers_salary_sheet_item_table', 6),
(48, '2025_09_19_044721_create_reports_table', 7),
(49, '2025_09_23_193848_add_officer_and_reporter_ids_to_custom_jobs_table', 8),
(50, '2025_09_23_195238_create_settings_table', 9),
(52, '2025_09_23_211146_add_allowance_rules_to_employers_salary_sheet_item_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 32),
(4, 'App\\Models\\User', 9),
(4, 'App\\Models\\User', 10),
(4, 'App\\Models\\User', 11),
(5, 'App\\Models\\User', 7),
(5, 'App\\Models\\User', 12),
(5, 'App\\Models\\User', 13),
(5, 'App\\Models\\User', 16),
(5, 'App\\Models\\User', 17),
(5, 'App\\Models\\User', 18),
(5, 'App\\Models\\User', 19),
(5, 'App\\Models\\User', 24),
(5, 'App\\Models\\User', 29),
(5, 'App\\Models\\User', 33),
(5, 'App\\Models\\User', 34),
(6, 'App\\Models\\User', 36);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view users', 'web', '2025-09-13 20:47:37', '2025-09-13 20:47:37'),
(2, 'create users', 'web', '2025-09-13 20:47:37', '2025-09-13 20:47:37'),
(3, 'edit users', 'web', '2025-09-13 20:47:37', '2025-09-13 20:47:37'),
(4, 'delete users', 'web', '2025-09-13 20:47:37', '2025-09-13 20:47:37'),
(5, 'view roles', 'web', '2025-09-13 20:47:37', '2025-09-13 20:47:37'),
(6, 'create roles', 'web', '2025-09-13 20:47:37', '2025-09-13 20:47:37'),
(7, 'edit roles', 'web', '2025-09-13 20:47:37', '2025-09-13 20:47:37'),
(8, 'delete roles', 'web', '2025-09-13 20:47:37', '2025-09-13 20:47:37'),
(9, 'view clients', 'web', '2025-09-13 20:47:37', '2025-09-13 20:47:37'),
(10, 'create clients', 'web', '2025-09-13 20:47:37', '2025-09-13 20:47:37'),
(11, 'edit clients', 'web', '2025-09-13 20:47:37', '2025-09-13 20:47:37'),
(12, 'delete clients', 'web', '2025-09-13 20:47:37', '2025-09-13 20:47:37'),
(13, 'view jobs', 'web', '2025-09-13 20:47:37', '2025-09-13 20:47:37'),
(14, 'create jobs', 'web', '2025-09-13 20:47:37', '2025-09-13 20:47:37'),
(15, 'edit jobs', 'web', '2025-09-13 20:47:37', '2025-09-13 20:47:37'),
(16, 'delete jobs', 'web', '2025-09-13 20:47:37', '2025-09-13 20:47:37'),
(17, 'view promoters', 'web', '2025-09-13 20:47:37', '2025-09-13 20:47:37'),
(18, 'create promoters', 'web', '2025-09-13 20:47:37', '2025-09-13 20:47:37'),
(19, 'edit promoters', 'web', '2025-09-13 20:47:37', '2025-09-13 20:47:37'),
(20, 'delete promoters', 'web', '2025-09-13 20:47:37', '2025-09-13 20:47:37'),
(21, 'view promoter positions', 'web', '2025-09-13 20:47:37', '2025-09-13 20:47:37'),
(22, 'create promoter positions', 'web', '2025-09-13 20:47:37', '2025-09-13 20:47:37'),
(23, 'edit promoter positions', 'web', '2025-09-13 20:47:37', '2025-09-13 20:47:37'),
(24, 'delete promoter positions', 'web', '2025-09-13 20:47:37', '2025-09-13 20:47:37'),
(25, 'view coordinators', 'web', '2025-09-13 20:47:37', '2025-09-13 20:47:37'),
(26, 'create coordinators', 'web', '2025-09-13 20:47:37', '2025-09-13 20:47:37'),
(27, 'edit coordinators', 'web', '2025-09-13 20:47:37', '2025-09-13 20:47:37'),
(28, 'delete coordinators', 'web', '2025-09-13 20:47:37', '2025-09-13 20:47:37'),
(29, 'view salary sheets', 'web', '2025-09-13 20:47:37', '2025-09-13 20:47:37'),
(30, 'create salary sheets', 'web', '2025-09-13 20:47:37', '2025-09-13 20:47:37'),
(31, 'edit salary sheets', 'web', '2025-09-13 20:47:37', '2025-09-13 20:47:37'),
(32, 'delete salary sheets', 'web', '2025-09-13 20:47:37', '2025-09-13 20:47:37'),
(33, 'view dashboard', 'web', '2025-09-13 20:47:37', '2025-09-13 20:47:37'),
(34, 'access admin panel', 'web', '2025-09-13 20:47:37', '2025-09-13 20:47:37'),
(35, 'view allowances', 'web', '2025-09-17 13:32:32', '2025-09-17 13:32:32'),
(36, 'create allowances', 'web', '2025-09-17 13:32:32', '2025-09-17 13:32:32'),
(37, 'edit allowances', 'web', '2025-09-17 13:32:32', '2025-09-17 13:32:32'),
(38, 'delete allowances', 'web', '2025-09-17 13:32:32', '2025-09-17 13:32:32'),
(39, 'view reports', 'web', '2025-09-18 23:19:27', '2025-09-18 23:19:27'),
(40, 'create reports', 'web', '2025-09-18 23:19:27', '2025-09-18 23:19:27'),
(41, 'edit reports', 'web', '2025-09-18 23:19:27', '2025-09-18 23:19:27'),
(42, 'delete reports', 'web', '2025-09-18 23:19:27', '2025-09-18 23:19:27'),
(43, 'view reporters', 'web', '2025-09-23 13:44:37', '2025-09-23 13:44:37'),
(44, 'create reporters', 'web', '2025-09-23 13:44:37', '2025-09-23 13:44:37'),
(45, 'edit reporters', 'web', '2025-09-23 13:44:37', '2025-09-23 13:44:37'),
(46, 'delete reporters', 'web', '2025-09-23 13:44:37', '2025-09-23 13:44:37'),
(47, 'view officers', 'web', '2025-09-23 13:50:57', '2025-09-23 13:50:57'),
(48, 'create officers', 'web', '2025-09-23 13:50:57', '2025-09-23 13:50:57'),
(49, 'edit officers', 'web', '2025-09-23 13:50:57', '2025-09-23 13:50:57'),
(50, 'delete officers', 'web', '2025-09-23 13:50:57', '2025-09-23 13:50:57'),
(51, 'view settings', 'web', '2025-09-23 14:25:20', '2025-09-23 14:25:20'),
(52, 'edit settings', 'web', '2025-09-23 14:25:20', '2025-09-23 14:25:20'),
(53, 'print salary sheets', 'web', '2026-06-30 05:01:54', '2026-06-30 05:01:54'),
(54, 'export salary sheets', 'web', '2026-06-30 05:01:54', '2026-06-30 05:01:54');

-- --------------------------------------------------------

--
-- Table structure for table `position_wise_salary_rules`
--

CREATE TABLE `position_wise_salary_rules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `position_id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `position_wise_salary_rules`
--

INSERT INTO `position_wise_salary_rules` (`id`, `position_id`, `job_id`, `amount`, `description`, `status`, `created_at`, `updated_at`) VALUES
(33, 9, 15, 2000.00, NULL, 'active', '2026-01-06 16:48:51', '2026-01-06 16:48:51'),
(34, 9, 25, 2500.00, NULL, 'active', '2026-01-06 17:04:42', '2026-01-06 17:04:42'),
(35, 2, 31, 2000.00, NULL, 'active', '2026-01-13 16:32:08', '2026-01-13 16:32:08'),
(37, 2, 18, 2000.00, NULL, 'active', '2026-01-14 13:57:27', '2026-01-14 13:57:27'),
(38, 9, 18, 2500.00, NULL, 'active', '2026-01-14 13:58:07', '2026-01-14 13:58:07'),
(39, 1, 18, 2750.00, NULL, 'active', '2026-01-14 13:58:25', '2026-01-14 13:58:25'),
(44, 2, 64, 2000.00, NULL, 'active', '2026-01-20 15:47:27', '2026-01-20 15:47:27'),
(45, 9, 64, 2500.00, NULL, 'active', '2026-01-20 17:30:26', '2026-01-20 17:30:26'),
(46, 9, 21, 1500.00, NULL, 'active', '2026-01-20 17:31:25', '2026-01-20 17:31:25'),
(47, 9, 34, 1500.00, NULL, 'active', '2026-01-20 17:54:08', '2026-01-20 17:54:08'),
(49, 9, 80, 2000.00, NULL, 'active', '2026-01-21 14:32:47', '2026-01-21 14:32:47'),
(50, 1, 32, 2500.00, NULL, 'active', '2026-01-21 17:47:56', '2026-01-21 17:47:56'),
(53, 9, 22, 1500.00, NULL, 'active', '2026-01-22 01:57:08', '2026-01-22 01:57:08'),
(54, 2, 56, 2500.00, NULL, 'active', '2026-01-22 02:10:56', '2026-01-22 02:10:56'),
(55, 9, 56, 2500.00, NULL, 'active', '2026-01-22 09:24:01', '2026-01-22 09:24:01'),
(56, 1, 83, 2500.00, NULL, 'active', '2026-01-22 09:45:07', '2026-01-22 09:45:07'),
(60, 9, 19, 2000.00, NULL, 'active', '2026-01-26 19:42:30', '2026-01-26 19:42:30'),
(61, 2, 19, 1500.00, NULL, 'active', '2026-01-26 19:42:47', '2026-01-26 19:42:47'),
(62, 1, 19, 2000.00, NULL, 'active', '2026-01-26 19:43:24', '2026-01-26 19:43:24'),
(65, 1, 15, 2000.00, NULL, 'active', '2026-01-26 20:16:56', '2026-01-26 20:16:56'),
(66, 1, 43, 4250.00, NULL, 'active', '2026-01-27 12:04:08', '2026-01-27 12:04:08'),
(67, 9, 43, 6000.00, NULL, 'active', '2026-01-27 12:05:50', '2026-01-27 12:05:50'),
(68, 2, 39, 2500.00, NULL, 'active', '2026-01-27 12:41:12', '2026-01-27 12:41:12'),
(69, 10, 101, 10000.00, NULL, 'active', '2026-01-27 18:12:48', '2026-01-27 18:12:48'),
(70, 2, 60, 3000.00, NULL, 'active', '2026-01-27 18:25:27', '2026-01-27 18:25:27'),
(72, 1, 104, 5000.00, NULL, 'active', '2026-01-27 19:04:46', '2026-01-27 19:04:46'),
(75, 9, 70, 5000.00, NULL, 'active', '2026-01-28 11:57:35', '2026-01-28 11:57:35'),
(76, 2, 70, 3500.00, NULL, 'active', '2026-01-28 11:57:35', '2026-01-28 11:57:35'),
(77, 2, 23, 2500.00, NULL, 'active', '2026-01-28 12:12:14', '2026-01-28 12:12:14'),
(80, 1, 65, 3000.00, NULL, 'active', '2026-01-28 12:23:12', '2026-01-28 12:23:12'),
(81, 2, 65, 2000.00, NULL, 'active', '2026-01-28 12:23:30', '2026-01-28 12:23:30'),
(82, 9, 65, 2000.00, NULL, 'active', '2026-01-28 12:23:53', '2026-01-28 12:23:53'),
(83, 1, 103, 2500.00, NULL, 'active', '2026-01-28 12:52:06', '2026-01-28 12:52:06'),
(84, 2, 103, 2500.00, NULL, 'active', '2026-01-28 12:52:30', '2026-01-28 12:52:30'),
(85, 9, 103, 2500.00, NULL, 'active', '2026-01-28 13:31:39', '2026-01-28 13:31:39'),
(89, 9, 60, 2750.00, NULL, 'active', '2026-01-28 14:10:10', '2026-01-28 14:10:10'),
(90, 2, 89, 3500.00, NULL, 'active', '2026-01-28 18:27:33', '2026-01-28 18:27:33'),
(91, 9, 89, 3500.00, NULL, 'active', '2026-01-28 18:28:00', '2026-01-28 18:28:00'),
(92, 2, 121, 4750.00, NULL, 'active', '2026-02-10 16:53:33', '2026-02-10 16:53:33'),
(93, 1, 121, 4500.00, NULL, 'active', '2026-02-10 16:53:59', '2026-02-10 16:53:59'),
(94, 9, 17, 3000.00, NULL, 'active', '2026-06-30 01:09:23', '2026-06-30 01:09:23'),
(95, 1, 17, 2000.00, NULL, 'active', '2026-06-30 01:09:42', '2026-06-30 01:09:42'),
(96, 2, 15, 7000.00, NULL, 'active', '2026-06-30 04:54:28', '2026-06-30 04:54:28'),
(97, 9, 592, 2000.00, NULL, 'active', '2026-06-30 11:04:55', '2026-06-30 11:04:55'),
(98, 1, 592, 2300.00, NULL, 'active', '2026-06-30 11:04:55', '2026-06-30 11:04:55'),
(99, 10, 592, 2500.00, NULL, 'active', '2026-06-30 11:04:55', '2026-06-30 11:04:55'),
(100, 9, 593, 3000.00, NULL, 'active', '2026-07-02 23:35:10', '2026-07-02 23:35:10'),
(101, 2, 593, 2000.00, NULL, 'active', '2026-07-02 23:35:10', '2026-07-02 23:35:10'),
(102, 1, 593, 2000.00, NULL, 'active', '2026-07-02 23:35:10', '2026-07-02 23:35:10'),
(103, 10, 593, 5000.00, NULL, 'active', '2026-07-02 23:35:10', '2026-07-02 23:35:10');

-- --------------------------------------------------------

--
-- Table structure for table `promoters`
--

CREATE TABLE `promoters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `promoter_id` varchar(255) NOT NULL,
  `position_id` bigint(20) UNSIGNED DEFAULT NULL,
  `promoter_name` varchar(255) NOT NULL,
  `identity_card_no` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_branch_name` varchar(255) NOT NULL,
  `bank_account_number` varchar(255) NOT NULL,
  `status` enum('active','inactive','suspended') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promoters`
--

INSERT INTO `promoters` (`id`, `promoter_id`, `position_id`, `promoter_name`, `identity_card_no`, `phone_no`, `bank_name`, `bank_branch_name`, `bank_account_number`, `status`, `created_at`, `updated_at`) VALUES
(37, '2026/MIND/0001', 9, 'H.A.D.Shanitha', '961612314V', '0770072356', '7056', 'Kiribathgoda', '8000532118', 'active', '2026-01-06 00:01:58', '2026-01-06 00:01:58'),
(38, '2026/MIND/0002', 2, 'K.A.D Jayaweera', '200015301323', '0702883616', 'BOC', 'Gampaha', '864502', 'active', '2026-01-13 16:22:19', '2026-01-13 16:22:19'),
(39, '2026/MIND/0003', 2, 'S.K Sanjeewa', '199303502160', '773703678', 'BOC', 'Deyiyandara', '94231757', 'active', '2026-01-14 02:13:01', '2026-01-14 02:13:01'),
(40, '2026/MIND/0004', 2, 'H P Darshana Rathnayala', '200132102460', '772164212', 'NSB', 'Bulathkohohupitiya', '107100151998', 'active', '2026-01-14 11:32:15', '2026-01-14 11:32:15'),
(41, '2026/MIND/0005', 2, 'Mahesh Dayanath', '198634803271', '773387410', 'Samapth Bank', 'Ambangoda', '107253866424', 'active', '2026-01-14 11:33:27', '2026-01-14 11:33:27'),
(42, '2026/MIND/0006', 1, 'B.G. Thakshila Wijesinghe', '200364900859', '773591536', 'Peoples Bank', 'Raththota', '128200250035446', 'active', '2026-01-14 11:35:56', '2026-01-14 11:35:56'),
(43, '2026/MIND/0007', 1, 'E.M.M.Bhagya Sandamali', '977852439v', '756491037', 'Commercial bank', 'Kaduruwela', '8020556149', 'active', '2026-01-14 11:37:25', '2026-01-14 11:37:25'),
(44, '2026/MIND/0008', 9, 'Sharith Dilshan', '825433953V', '0702471098', 'Commercial Bank', 'Puttalam', '8026505950', 'active', '2026-01-14 11:41:27', '2026-01-14 11:41:27'),
(45, '2026/MIND/0009', 9, 'K.P.R Kavinda', '200433601088', '0768087127', 'Commercial Bank', 'Kiribathgoda', '8017916758', 'active', '2026-01-14 11:45:04', '2026-01-14 11:45:04'),
(46, '2026/MIND/0010', 9, 'K.D.C.P Madushan', '199924102755', '775844804', 'Commercial Bank', 'Kiribathgoda', '8690076092', 'active', '2026-01-14 11:53:30', '2026-01-14 11:53:30'),
(47, '2026/MIND/0011', 10, 'I S dunuthilaka', '198408501869', '0775927144', 'Peoples Bank', 'Gampola', '18200111359877', 'active', '2026-01-14 12:06:08', '2026-01-14 12:06:08'),
(48, '2026/MIND/0012', 2, 'KA Sidantha', '910191519V', '719516231', '7010', 'Matara', '8881686', 'active', '2026-01-20 14:23:04', '2026-01-20 14:23:04'),
(49, '2026/MIND/0013', 9, 'T.M  Pashan', '973550250v', '0779690984', '7056', '33', '8021546057', 'active', '2026-01-20 14:27:15', '2026-01-20 14:27:48'),
(50, '2026/MIND/0014', 2, 'M.D Rashmika', '200524904562', '0703695763', '7135', '237', '200130055897', 'active', '2026-01-20 14:32:29', '2026-01-20 14:32:29'),
(51, '2026/MIND/0015', 1, 'D.S Thilangani Dissanayake', '199371801981', '0756754629', '7056', '10', '8004310033', 'active', '2026-01-20 14:36:29', '2026-01-20 14:42:45'),
(52, '2026/MIND/0016', 1, 'B.A.U Indeeewari', '896333194v', '0715169632', '7278', '117', '111754866751', 'active', '2026-01-20 14:40:40', '2026-01-20 14:40:40'),
(53, '2026/MIND/0017', 2, 'M.C Nilupul', '200011301775', '0759516204', '7056', '69', '8022410760', 'active', '2026-01-20 14:44:19', '2026-01-20 14:44:19'),
(54, '2026/MIND/0018', 1, 'K.V.D Madushani', '198653402420', '0702081358', '7056', '199', '8018882434', 'active', '2026-01-20 17:11:00', '2026-01-20 17:11:00'),
(55, '2026/MIND/0019', 2, 'Ajith Fernando', '823020350V', '0777966992', '7719', '138', '101380145173', 'active', '2026-01-20 17:16:14', '2026-01-20 17:16:14'),
(56, '2026/MIND/0020', NULL, 'R U Ponnameruma', '998200490V', '0750639183', '7010', '03', '84026797', 'active', '2026-01-20 17:25:04', '2026-01-20 17:25:04'),
(57, '2026/MIND/0021', 1, 'R N Dulanjalee', '200484600718', '0779663560', '7010', '135', '90422732', 'active', '2026-01-20 17:27:08', '2026-01-20 17:27:08'),
(58, '2026/MIND/0022', 1, 'Uthayakumar Thilaxshi', '918112073V', '742255684', '7010', '5', '95290226', 'active', '2026-01-21 13:10:13', '2026-01-21 13:10:13'),
(59, '2026/MIND/0023', 1, 'Inthuja', '199962701943', '767699708', '7056', '6', '8028896339', 'active', '2026-01-21 13:29:40', '2026-01-21 13:29:40'),
(60, '2026/MIND/0024', 1, 'S.vijayareka', '923474625v', '760602847', '7135', '106', '200150029887', 'active', '2026-01-21 13:32:21', '2026-01-21 13:32:21'),
(61, '2026/MIND/0025', 1, 'R.Mayura', '198958002530', '755811606', '7010', '338', '80608675', 'active', '2026-01-21 13:35:04', '2026-01-21 13:35:04'),
(62, '2026/MIND/0026', 1, 'V.Komathy', '887952965V', '766360840', '7719', '6', '100068140006', 'active', '2026-01-21 13:36:15', '2026-01-21 13:36:15'),
(63, '2026/MIND/0027', 1, 'Sahayamary Pathamathasan', '200166200748', '742621206', '7010', '368', '82631225', 'active', '2026-01-21 13:38:08', '2026-01-21 13:38:08'),
(64, '2026/MIND/0028', 1, 'S Dinusiya', '200371200044', '775518564', '7135', '104', '200110081958', 'active', '2026-01-21 13:44:25', '2026-01-21 13:44:25'),
(65, '2026/MIND/0029', 1, 'Y Shalini', '976430484v', '762895916', '7010', '375', '92306902', 'active', '2026-01-21 13:46:31', '2026-01-21 13:46:31'),
(66, '2026/MIND/0030', 1, 'C.Dayanthiny', '200652800340', '0112902098', '7010', '44', '75630413', 'active', '2026-01-21 13:51:04', '2026-01-21 13:51:04'),
(67, '2026/MIND/0031', 1, 'Janakan Baby Nishanthi', '199278402130', '768062051', '7010', '44', '82353054', 'active', '2026-01-21 13:52:54', '2026-01-21 13:52:54'),
(68, '2026/MIND/0032', 1, 'P. Januja', '200262400080', '772824541', '7056', '44', '8025158317', 'active', '2026-01-21 13:54:27', '2026-01-21 13:54:27'),
(69, '2026/MIND/0033', 1, 'V.Madeekshani', '200067200175', '768107032', '7010', '162', '3985718', 'active', '2026-01-21 13:57:23', '2026-01-21 13:57:23'),
(70, '2026/MIND/0034', 1, 'Ratnaraj Jesika', '996020673v', '704454348', '7083', '32', '206020082211', 'active', '2026-01-21 14:00:29', '2026-01-21 14:00:29'),
(71, '2026/MIND/0035', 1, 'Pathmanathan Thushanthika', '200353612361', '772646255', '7056', '61', '8610075361', 'active', '2026-01-21 14:01:45', '2026-01-21 14:01:45'),
(72, '2026/MIND/0036', 1, 'Y. Raveesha', '200863805134', '740826669', '7010', '162', '94498591', 'active', '2026-01-21 14:03:07', '2026-01-21 14:03:07'),
(73, '2026/MIND/0037', 1, 'S.C Enjalin', '200359910931', '756610199', '7010', '162', '93640041', 'active', '2026-01-21 14:08:51', '2026-01-21 14:08:51'),
(74, '2026/MIND/0038', 1, 'Rinosa', '907845214v', '763082638', '7010', '162', '3974230', 'active', '2026-01-21 14:11:21', '2026-01-21 14:11:21'),
(75, '2026/MIND/0039', 1, 'Irshana', '200175703832', '776194960', '7135', '96', '20018 0095546', 'active', '2026-01-21 14:13:11', '2026-01-21 14:13:11'),
(76, '2026/MIND/0040', 1, 'T. PIRAVEENA', '200575604453', '752787819', '7010', '46', '94045695', 'active', '2026-01-21 14:15:59', '2026-01-21 14:15:59'),
(77, '2026/MIND/0041', 1, 'J.Mathumitha', '2005706 01958', '777683370', '7010', '46', '92350411', 'active', '2026-01-21 14:17:15', '2026-01-21 14:17:15'),
(78, '2026/MIND/0042', 1, 'Devakaanthan Vigneswary', '199063302663', '778279425', '7010', '5', '8674168', 'active', '2026-01-21 14:19:10', '2026-01-21 14:19:10'),
(79, '2026/MIND/0043', 1, 'MI.P.S.Ferando', '966190019V', '713705765', '7135', '262', '200120025367', 'active', '2026-01-21 14:25:29', '2026-01-21 14:25:29'),
(80, '2026/MIND/0044', 1, 'D.Ridma Rasanjali silva', '200151700161', '779678853', '7083', '108', '108020017751', 'active', '2026-01-21 14:27:02', '2026-01-21 14:27:02'),
(81, '2026/MIND/0045', 1, 'R.M.Nawodya geethani', '200168200674', '0768417103', '7010', '83', '88597608', 'active', '2026-01-21 14:28:06', '2026-01-21 14:28:06'),
(82, '2026/MIND/0046', 1, 'S.V  Pradeepa', '200455410268', '757774813', '7010', '280', '8288026', 'active', '2026-01-21 14:32:50', '2026-01-21 14:32:50'),
(83, '2026/MIND/0047', 1, 'K.G.C.A.weerakoon', '967362662v', '778767249', '7083', '23', '173020015134', 'active', '2026-01-21 14:35:29', '2026-01-21 14:35:29'),
(84, '2026/MIND/0048', 1, 'B.B.Rukshika Amandi Perera', '200278302453', '765731426', '7056', '36', '8027101243', 'active', '2026-01-21 14:37:42', '2026-01-21 14:37:42'),
(85, '2026/MIND/0049', 1, 'S.M.C.Nisansala Karunarathna', '937742240v', '719048230', '7719', '18', '100188865477', 'active', '2026-01-21 14:42:10', '2026-01-21 14:42:10'),
(86, '2026/MIND/0050', 1, 'P.K.V.A.Hansi', '200250401548', '760412527', '7135', '264', '200120064838', 'active', '2026-01-21 14:58:21', '2026-01-21 14:58:21'),
(87, '2026/MIND/0051', 1, 'G.W.N.R.Raveendraa', '200564601308', '778483604', '7010', '686', '78507438', 'active', '2026-01-21 14:59:34', '2026-01-21 14:59:34'),
(88, '2026/MIND/0052', 1, 'P.G Chanuri Navodya', '200761801450', '768447602', '7135', '103', '200190054447', 'active', '2026-01-21 15:02:33', '2026-01-21 15:02:33'),
(89, '2026/MIND/0053', 1, 'R.M Nihal Jayasiri Bandara', '200760503603', '766048084', '7056', '137', '8024874294', 'active', '2026-01-21 15:13:45', '2026-01-21 15:13:45'),
(90, '2026/MIND/0054', 1, 'Raja Jeyanthi Fernando', '198469501571', '779595423', '7056', '260', '8260905729', 'active', '2026-01-21 15:14:48', '2026-01-21 15:14:48'),
(91, '2026/MIND/0055', 1, 'H.H.R.Amalka', '200551902338', '766082187', '7278', '5', '100556267845', 'active', '2026-01-21 15:15:51', '2026-01-21 15:15:51'),
(92, '2026/MIND/0056', 1, 'J S Deepthi Jeewarathne', '199650702101', '771864921', '7056', '80', '8007871678', 'active', '2026-01-21 15:16:50', '2026-01-21 15:16:50'),
(93, '2026/MIND/0057', 1, 'P U G J A Wickaramanayaka', '200351002570', '741341121', '7083', '14', '223020133730', 'active', '2026-01-21 15:18:35', '2026-01-21 15:18:35'),
(94, '2026/MIND/0058', 1, 'S.P Dayarathna', '877413187v', '758181113', '7056', '4', '8040040936', 'active', '2026-01-21 15:20:45', '2026-01-21 15:20:45'),
(95, '2026/MIND/0059', 1, 'W.P.P.M.Frenando', '200553002486', '759072035', '7010', '598', '92308406', 'active', '2026-01-21 15:30:04', '2026-01-21 15:30:04'),
(96, '2026/MIND/0060', 1, 'W.P.I.A.Pernando', '968291076v', '702373132', '7135', '53', '200260028039', 'active', '2026-01-21 15:31:05', '2026-01-21 15:31:05'),
(97, '2026/MIND/0061', 1, 'M.G Renuka Kusum kumari', '198379905590', '742661981', '7135', '159', '200330037767', 'active', '2026-01-21 15:33:07', '2026-01-21 15:33:07'),
(98, '2026/MIND/0062', 1, 'D G T SK Gunathilaka', '200286202045', '762864694', '7083', '236', '236020070116', 'active', '2026-01-21 15:39:11', '2026-01-21 15:39:11'),
(99, '2026/MIND/0063', 1, 'K.G.R.K.Nawarathna', '200165600710', '701951164', '7010', '335', '5033138', 'active', '2026-01-21 15:42:06', '2026-01-21 15:42:06'),
(100, '2026/MIND/0064', 1, 'T. Tharsika', '200067500317', '743369439', '7719', '88', '115511844818', 'active', '2026-01-21 15:43:46', '2026-01-21 15:43:46'),
(101, '2026/MIND/0065', 1, 'R.Thenuka', '200151902734', '782014843', '7010', '414', '89298913', 'active', '2026-01-21 15:44:50', '2026-01-21 15:44:50'),
(102, '2026/MIND/0066', 1, 'Kabriyela Kumar', '200459010310', '741856506', '7135', '255', '200190074207', 'active', '2026-01-21 15:46:35', '2026-01-21 15:46:35'),
(103, '2026/MIND/0067', 1, 'N.Navajeyantha', '908064569V', '754328533', '7083', '31', '31020668495', 'active', '2026-01-21 15:47:38', '2026-01-21 15:47:38'),
(104, '2026/MIND/0068', 1, 'T.Nilukshi', '200460012529', '724228980', '7135', '66', '200250014356', 'active', '2026-01-21 15:48:32', '2026-01-21 15:48:32'),
(105, '2026/MIND/0069', 1, 'Arumugan Janani', '200479601551', '757477341', '7010', '414', '91557815', 'active', '2026-01-21 15:50:01', '2026-01-21 15:50:01'),
(106, '2026/MIND/0070', 1, 'I. Theiventhini', '200750301560', '755649666', '7010', '420', '94271676', 'active', '2026-01-21 15:50:56', '2026-01-21 15:50:56'),
(107, '2026/MIND/0071', 1, 'N.Jeyayamathy', '826203927V', '720171960', '7135', '224', '200150007431', 'active', '2026-01-21 15:51:58', '2026-01-21 15:51:58'),
(108, '2026/MIND/0072', 1, 'N  Husna', '9448484188', '759918258', '7135', '63', '200110063831', 'active', '2026-01-21 15:53:05', '2026-01-21 15:53:05'),
(109, '2026/MIND/0073', 1, 'T . Nishanthi', '19967343292v', '766013142', '7010', '598', '90621258', 'active', '2026-01-21 15:54:14', '2026-01-21 15:54:14'),
(110, '2026/MIND/0074', 1, 'Y. Siyana', '200423703759', '759193590', '7056', '155', '8014145052', 'active', '2026-01-21 15:59:10', '2026-01-21 15:59:10'),
(111, '2026/MIND/0075', 1, 'S Vinojini', '198458803041', '751218313', '7010', '12', '82650603', 'active', '2026-01-21 16:01:23', '2026-01-21 16:01:23'),
(112, '2026/MIND/0076', 1, 'P.Thayalini', '866014930v', '776381148', '7719', '21', '100210363910', 'active', '2026-01-21 16:18:46', '2026-01-21 16:18:46'),
(113, '2026/MIND/0077', 1, 'Suganiya', '199657603031', '769148983', '7083', '57', '57020422796', 'active', '2026-01-21 16:21:12', '2026-01-21 16:21:12'),
(114, '2026/MIND/0078', 1, 'S. Sarojini', '965683887v', '756727451', '7135', '102', '200240082438', 'active', '2026-01-21 16:22:20', '2026-01-21 16:22:20'),
(115, '2026/MIND/0079', 1, 'R. Kowthami', '957084010v', '782846642', '7719', '720', '300086393248', 'active', '2026-01-21 16:23:31', '2026-01-21 16:23:31'),
(116, '2026/MIND/0080', 1, 'V.Pratheepa', '956672953V', '753400410', '7278', '121', '112154916546', 'active', '2026-01-21 17:04:42', '2026-01-21 17:04:42'),
(117, '2026/MIND/0081', 1, 'Thenika', '906153505v', '759141792', '7719', '727', '107270147834', 'active', '2026-01-21 17:09:06', '2026-01-21 17:09:06'),
(118, '2026/MIND/0082', 1, 'R. Sukirtha', '200430703180', '755179392', '7010', '12', '91150828', 'active', '2026-01-21 17:10:57', '2026-01-21 17:10:57'),
(119, '2026/MIND/0083', 1, 'J.Rushanthini', '199970310330', '774838033', '7010', '531', '90268696', 'active', '2026-01-21 17:13:30', '2026-01-21 17:13:30'),
(120, '2026/MIND/0084', 1, 'R.G.Dilki madushani', '200476201300', '720668802', '7010', '639', '4726830', 'active', '2026-01-21 17:14:52', '2026-01-21 17:14:52'),
(121, '2026/MIND/0085', 1, 'Ayodya Indunil', '986531912v', '768436662', '7135', '55', '200200041028', 'active', '2026-01-21 17:15:53', '2026-01-21 17:15:53'),
(122, '2026/MIND/0086', 1, 'V.Abinaya', '200579301758', '743637228', '7135', '255', '200280079771', 'active', '2026-01-21 17:25:15', '2026-01-21 17:25:15'),
(123, '2026/MIND/0087', 1, 'R.A.G.D.K ekanayaka', '94663823v', '0756668225', '7010', '68', '73566738', 'active', '2026-01-21 17:50:10', '2026-01-21 17:50:10'),
(124, '2026/MIND/0088', 1, 'I.G.C.L jayasingha', '836320131v', '0753916524', '7010', '444', '89994151', 'active', '2026-01-21 18:02:29', '2026-01-21 18:02:29'),
(125, '2026/MIND/0089', 1, 'W. H. P. T. Manishani', '200384100526', '0759850950', '7010', '588', '94306609', 'active', '2026-01-21 18:04:36', '2026-01-21 18:04:36'),
(126, '2026/MIND/0090', 1, 'Rathakirushnan Thanuja', '200072003484', '0762937516', '7056', '193', '8024405542', 'active', '2026-01-21 18:09:43', '2026-01-21 18:09:43'),
(127, '2026/MIND/0091', 1, 'C.M Anjaleen', '20035991093', '0756610199', '7010', '162', '93640041', 'active', '2026-01-21 18:17:04', '2026-01-21 18:17:04'),
(128, '2026/MIND/0092', 2, 'S G Mohanlala', '802334370 V', '0773319759', '7010', '735', '77038278', 'active', '2026-01-21 18:22:14', '2026-01-27 12:04:00'),
(129, '2026/MIND/0093', 1, 'M.M.A.N.Danushik Dulanjalie', '946742805V', '0713349145', '7056', '19', '8190037787', 'active', '2026-01-21 18:24:07', '2026-01-21 18:24:07'),
(130, '2026/MIND/0094', 9, 'N Pradeep', '891982151V', '0770330103', '7056', 'colombo 10', '8500033992', 'active', '2026-01-27 12:02:56', '2026-01-27 12:02:56'),
(131, '2026/MIND/0095', 9, 'M Mazam', '8052142157V', '0762652280', '7056', 'Hambanthota', '8166005741', 'active', '2026-01-27 12:30:59', '2026-01-27 12:30:59'),
(132, '2026/MIND/0096', 1, 'R.G.G.S Weerasinghe', '200615202595', '0776816455', '7010', 'kegalla', '74168658', 'active', '2026-01-27 18:52:05', '2026-01-27 18:52:05'),
(133, '2026/MIND/0097', 2, 'Navindu Chamalka', '200520404095', '0743190169', '7056', 'Elpitiya Branch', '8028603371', 'active', '2026-01-28 12:43:58', '2026-01-28 12:43:58'),
(134, '2026/MIND/0098', 9, 'W D R Ovinda', '852592452V', '+94 76 843 3214', '7278', 'Akuressa', '117957810715', 'active', '2026-01-28 12:52:30', '2026-01-28 12:52:30'),
(135, '2026/MIND/0099', 2, 'Lahiru dilshan', '2002211404954', '+94 75 756 6692', '7056', 'Makola', '1199002994', 'active', '2026-01-28 12:55:44', '2026-01-28 12:55:44'),
(136, '2026/MIND/0100', 1, 'H.P.N.N.RATHNAYAKA', '852625142V', '0702514253', '7719', 'Bulathkohupitiya', '107100151998', 'active', '2026-01-28 13:25:04', '2026-01-28 13:25:04'),
(137, '2026/MIND/0101', NULL, 'Thanuja Shalini Fernando', '917330700 V', '0719964718', '7056', '31', '8025058785', 'active', '2026-01-28 14:39:08', '2026-01-28 14:39:08'),
(138, '2026/MIND/0102', NULL, 'D.D Herath', '200540031231', '0713872978', '7056', '70', '8700052543', 'active', '2026-01-28 14:47:40', '2026-01-28 14:47:40'),
(139, '2026/MIND/0103', NULL, 'Jithmi Upeksha Sathsarani', '200677604604', '0706341051', '7010', '39', '7115565', 'active', '2026-01-28 14:53:52', '2026-01-28 14:53:52'),
(140, '2026/MIND/0104', NULL, 'J.M.N Kawshalya sewandi Bandara', '200786802504', '8020383561', '7056', '119', '8020383561', 'active', '2026-01-28 14:58:50', '2026-01-28 14:58:50'),
(141, '2026/MIND/0105', NULL, 'Pramudi Sathyanga Muthuarachchi', '200484201690', '0742746514', '7135', '333', '200120070159', 'active', '2026-01-28 15:03:22', '2026-01-28 15:03:22'),
(142, '2026/MIND/0106', NULL, 'Hansika Sewwandi wickramasinghe', '2001611204619', '0717163613', '7135', '57', '200170044278', 'active', '2026-01-28 15:06:29', '2026-01-28 15:06:29'),
(143, '2026/MIND/0107', NULL, 'G.L Prarthana Parami Liyanage', '200363411562', '0742197918', '7056', '128', '8028676344', 'active', '2026-01-28 15:09:01', '2026-01-28 15:09:01'),
(144, '2026/MIND/0108', NULL, 'W.I.R.N.G.I Priyadarshani kumari', '200262601436', '0781316077', '7135', '333', '200150069606', 'active', '2026-01-28 15:11:46', '2026-01-28 15:11:46'),
(145, '2026/MIND/0109', NULL, 'M.A.C.R Wijewaerdana', '896460719v', '0702389565', '7135', '278', '200110050867', 'active', '2026-01-28 15:15:03', '2026-01-28 15:15:03'),
(146, '2026/MIND/0110', NULL, 'W.L Kawshalya', '927320266v', '0757783193', '7010', '675', '78996636', 'active', '2026-01-28 15:22:39', '2026-01-28 15:22:39'),
(147, '2026/MIND/0111', NULL, 'S.A.L Sathsarani', '200367710455', '0701074801', '7010', '708', '88453880', 'active', '2026-01-28 15:25:37', '2026-01-28 15:25:37'),
(148, '2026/MIND/0112', NULL, 'P.R.A Dewmini Sewwandi', '200463700568', '0719982564', '7719', '99', '100998879184', 'active', '2026-01-28 15:27:12', '2026-01-28 15:27:12'),
(149, '2026/MIND/0113', NULL, 'U.G.S Chathurangani', '200173000704', '0781672557', '7278', '56', '105656209042', 'active', '2026-01-28 15:32:14', '2026-01-28 15:32:14'),
(150, '2026/MIND/0114', NULL, 'Gayani Wasana Kaluarachchi', '908643798v', '0741641325', '7010', '309', '1674446', 'active', '2026-01-28 15:33:27', '2026-01-28 15:33:27'),
(151, '2026/MIND/0115', NULL, 'H.M.D.R Herath', '200160300967', '0786304654', '7010', '379', '6282492', 'active', '2026-01-28 15:35:30', '2026-01-28 15:35:30'),
(152, '2026/MIND/0116', NULL, 'M.H.C Viamalasiri', '200074603249', '0740131785', '7010', '566', '8764284', 'active', '2026-01-28 15:40:03', '2026-01-28 15:40:03'),
(153, '2026/MIND/0117', NULL, 'P.L Uchini Himasha', '199784304002', '0768103419', '7010', '724', '94482681', 'active', '2026-01-28 15:41:24', '2026-01-28 15:41:24'),
(154, '2026/MIND/0118', NULL, 'G.A Chathuni Ruwanthika', '200059704475', '0752604912', '7010', '743', '90615693', 'active', '2026-01-28 15:43:55', '2026-01-28 15:43:55'),
(155, '2026/MIND/0119', NULL, 'D.D.G.K.S Kumara', '200563503092', '0758786102', '7010', '305', '93641076', 'active', '2026-01-28 15:45:33', '2026-01-28 15:45:33'),
(156, '2026/MIND/0120', NULL, 'A.A Tharushi Thathsarani', '200083404480', '0781713797', '7135', '100', '200180040669', 'active', '2026-01-28 15:47:00', '2026-01-28 15:47:00'),
(157, '2026/MIND/0121', NULL, 'K.H.N Damayanthi', '927224433v', '0742593599', '7010', '592', '76367739', 'active', '2026-01-28 15:49:18', '2026-01-28 15:49:18'),
(158, '2026/MIND/0122', NULL, 'R.D.D.N Jayawickrama', '981070054v', '0717854603', '7056', '16', '8160102931', 'active', '2026-01-28 15:52:58', '2026-01-28 15:52:58'),
(159, '2026/MIND/0123', NULL, 'R Janani kumari', '968623290v', '0758832851', '7135', '59', '200270028229', 'active', '2026-01-28 15:58:37', '2026-01-28 15:58:37'),
(160, '2026/MIND/0124', NULL, 'K.S.M.S Sewwandi', '200062002026', '0771875216', '7010', '534', '71438059', 'active', '2026-01-28 15:59:56', '2026-01-28 15:59:56'),
(161, '2026/MIND/0125', NULL, 'D.D Dilini Maduwanthi Dharmasiri', '200157803384', '0702760370', '7719', '782', '300129229277', 'active', '2026-01-28 16:01:35', '2026-01-28 16:01:35'),
(162, '2026/MIND/0126', NULL, 'Shashi Udayakumara', '200258003073', '0771764320', '7135', '149', '200260014785', 'active', '2026-01-28 16:03:08', '2026-01-28 16:03:08'),
(163, '2026/MIND/0127', NULL, 'H.B.Y Winodya', '200571804456', '0772510952', '7010', '664', '94033193', 'active', '2026-01-28 16:04:37', '2026-01-28 16:04:37'),
(164, '2026/MIND/0128', NULL, 'Kawshani Bhagya', '200160204142', '0757484856', '7010', 'Meerigama', '81967036', 'active', '2026-01-28 16:09:07', '2026-01-28 16:09:07'),
(165, '2026/MIND/0129', NULL, 'Rashmi Lakshika', '200382613763', '0760797734', '7010', '556', '911944', 'active', '2026-01-28 16:12:33', '2026-01-28 16:12:33'),
(166, '2026/MIND/0130', NULL, 'Sanduni Lakshika', '9868480048', '0778981141', '7083', '125', '125020166717', 'active', '2026-01-28 16:22:07', '2026-01-28 16:22:07'),
(167, '2026/MIND/0131', NULL, 'Shashi Perera', '200466000105', '0741310276', '7056', '84', '8025277292', 'active', '2026-01-28 17:18:12', '2026-01-28 17:18:12'),
(168, '2026/MIND/0132', NULL, 'M.G.M Maheesha prathibhani', '200181200661', '0743596512', '7056', '137', '8018336722', 'active', '2026-01-28 17:22:38', '2026-01-28 17:22:38'),
(169, '2026/MIND/0133', NULL, 'K.G.S Nisansala', '200260401770', '0715866708', '7135', '266', '200190053835', 'active', '2026-01-28 17:24:04', '2026-01-28 17:24:04'),
(170, '2026/MIND/0134', NULL, 'Dinushika Nawanjali', '200162000544', '0761619440', '7010', '680', '71720760', 'active', '2026-01-28 17:26:23', '2026-01-28 17:26:23'),
(171, '2026/MIND/0135', NULL, 'S.M.K Premachandra', '986731001v', '0768766527', '7135', '282', '200190045223', 'active', '2026-01-28 17:28:33', '2026-01-28 17:28:33'),
(172, '2026/MIND/0136', NULL, 'Sudisna Krishani Edirimanna', '200270902840', '0768060473', '7135', '70', '200120060677', 'active', '2026-01-28 17:32:51', '2026-01-28 17:32:51');

-- --------------------------------------------------------

--
-- Table structure for table `promoter_positions`
--

CREATE TABLE `promoter_positions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `position_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promoter_positions`
--

INSERT INTO `promoter_positions` (`id`, `position_name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Girl Promoter', 'Female promoter for beauty and lifestyle products', 'active', '2025-09-13 20:50:02', '2025-09-13 20:50:02'),
(2, 'Boy Promoter', 'Male promoter for general products and services', 'active', '2025-09-13 20:50:02', '2025-09-13 20:50:02'),
(3, 'Senior Promoter', 'Experienced promoter with leadership responsibilities', 'active', '2025-09-13 20:50:02', '2025-09-13 20:50:02'),
(4, 'Team Leader', 'Promoter responsible for managing a team of promoters', 'active', '2025-09-13 20:50:02', '2025-09-13 20:50:02'),
(9, 'Suppervisor', 'Supervisor', 'active', '2026-01-05 23:57:30', '2026-01-05 23:57:30'),
(10, 'Chef', 'a professional cook,', 'active', '2026-01-14 12:03:13', '2026-01-14 12:03:13'),
(11, 'Compere', 'A person who introduces the performers or contestants in a variety show', 'active', '2026-01-28 12:37:30', '2026-01-28 12:37:30');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `type` enum('promoter','coordinator','salary','job','client','allowance') NOT NULL,
  `status` enum('draft','published','archived') NOT NULL DEFAULT 'draft',
  `data_filters` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-09-13 20:47:37', '2025-09-13 20:47:37'),
(2, 'manager', 'web', '2025-09-13 20:47:37', '2025-09-13 20:47:37'),
(3, 'user', 'web', '2025-09-13 20:47:37', '2025-09-13 20:47:37'),
(4, 'reporter', 'web', '2025-09-18 20:29:17', '2025-09-18 20:29:17'),
(5, 'officer', 'web', '2025-09-18 23:12:51', '2025-09-18 23:12:51'),
(6, 'client service', 'web', '2026-06-30 05:01:34', '2026-06-30 05:01:34');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 4),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(5, 1),
(5, 2),
(5, 4),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(9, 2),
(9, 4),
(9, 5),
(10, 1),
(10, 2),
(10, 4),
(11, 1),
(11, 2),
(11, 4),
(12, 1),
(12, 2),
(12, 4),
(13, 1),
(13, 2),
(13, 3),
(13, 4),
(13, 5),
(13, 6),
(14, 1),
(14, 2),
(14, 4),
(14, 5),
(15, 1),
(15, 2),
(15, 4),
(15, 5),
(16, 1),
(17, 1),
(17, 2),
(17, 4),
(17, 5),
(18, 1),
(18, 2),
(19, 1),
(19, 2),
(20, 1),
(21, 1),
(21, 2),
(21, 4),
(21, 5),
(22, 1),
(22, 2),
(23, 1),
(23, 2),
(24, 1),
(25, 1),
(25, 2),
(25, 4),
(25, 5),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(29, 2),
(29, 3),
(29, 4),
(29, 5),
(29, 6),
(30, 1),
(30, 2),
(30, 4),
(30, 5),
(30, 6),
(31, 1),
(31, 2),
(31, 4),
(31, 5),
(31, 6),
(32, 1),
(32, 4),
(32, 5),
(33, 1),
(33, 2),
(33, 3),
(33, 4),
(33, 5),
(33, 6),
(34, 1),
(34, 2),
(34, 6),
(35, 1),
(35, 2),
(35, 4),
(35, 5),
(36, 1),
(36, 2),
(36, 4),
(36, 5),
(37, 1),
(37, 2),
(37, 4),
(37, 5),
(38, 1),
(38, 2),
(38, 4),
(38, 5),
(39, 1),
(39, 4),
(39, 5),
(40, 1),
(40, 4),
(41, 1),
(41, 4),
(42, 1),
(42, 4),
(43, 1),
(43, 2),
(43, 4),
(43, 5),
(44, 1),
(44, 4),
(45, 1),
(45, 4),
(46, 1),
(46, 4),
(47, 1),
(47, 2),
(47, 4),
(47, 5),
(48, 1),
(48, 2),
(48, 4),
(49, 1),
(49, 2),
(49, 4),
(50, 1),
(50, 2),
(51, 1),
(52, 1),
(53, 6),
(54, 6);

-- --------------------------------------------------------

--
-- Table structure for table `salary_sheet`
--

CREATE TABLE `salary_sheet` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sheet_no` varchar(255) NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('draft','approved','approve','paid','complete') NOT NULL DEFAULT 'draft',
  `location` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salary_sheet`
--

INSERT INTO `salary_sheet` (`id`, `sheet_no`, `job_id`, `status`, `location`, `notes`, `created_by`, `created_at`, `updated_at`) VALUES
(52, 'SAL/2026/01/001', 21, 'approve', NULL, NULL, 7, '2026-01-20 17:37:36', '2026-01-20 23:26:11'),
(53, 'SAL/2026/01/002', 64, 'complete', NULL, NULL, 0, '2026-01-20 17:46:58', '2026-01-20 17:46:58'),
(54, 'SAL/2026/01/003', 34, 'approve', NULL, NULL, 0, '2026-01-20 18:05:39', '2026-01-20 23:27:40'),
(55, 'SAL/2026/01/004', 80, 'complete', NULL, NULL, 0, '2026-01-21 14:36:17', '2026-01-21 14:36:17'),
(56, 'SAL/2026/01/005', 22, 'approve', NULL, NULL, 0, '2026-01-22 02:04:06', '2026-01-22 09:08:19'),
(57, 'SAL/2026/01/006', 56, 'draft', NULL, NULL, 0, '2026-01-22 09:28:06', '2026-01-22 09:28:06'),
(58, 'SAL/2026/01/007', 83, 'draft', NULL, NULL, 0, '2026-01-22 09:50:52', '2026-01-22 09:50:52'),
(61, 'SAL/2026/01/008', 39, 'complete', NULL, NULL, 18, '2026-01-27 18:08:21', '2026-01-27 18:08:21'),
(62, 'SAL/2026/01/009', 101, 'draft', NULL, NULL, 7, '2026-01-27 18:15:24', '2026-01-27 18:15:24'),
(63, 'SAL/2026/01/010', 104, 'draft', NULL, NULL, 7, '2026-01-27 19:07:33', '2026-01-27 19:07:33'),
(65, 'SAL/2026/01/011', 70, 'draft', NULL, NULL, 7, '2026-01-28 11:47:27', '2026-01-28 11:47:27'),
(69, 'SAL/2026/01/012', 60, 'complete', NULL, NULL, 13, '2026-01-28 15:57:19', '2026-01-28 15:57:19'),
(70, 'SAL/2026/01/013', 89, 'complete', 'keththarama', NULL, 13, '2026-01-28 18:53:59', '2026-01-28 18:53:59'),
(71, 'SAL/2026/06/001', 15, 'draft', NULL, NULL, 1, '2026-06-30 04:43:48', '2026-06-30 04:43:48'),
(72, 'SAL/2026/06/002', 15, 'draft', NULL, NULL, 1, '2026-06-30 04:45:28', '2026-06-30 04:45:28'),
(73, 'SAL/2026/06/003', 592, 'draft', NULL, NULL, 1, '2026-06-30 11:05:30', '2026-06-30 11:05:30'),
(74, 'SAL/2026/06/004', 15, 'draft', NULL, NULL, 1, '2026-06-30 11:37:01', '2026-06-30 11:37:01');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('blevNPDVNJVnbVXqBiK4b3MUC4SdISEkqXTO3t54', 1, '172.68.200.159', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUzNqWGdtalp2dGZnT3dFVVIyMmk3d0xBSURGc3NZWWRDdVBESkdkeCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM4OiJodHRwczovL3NhbGFyeS5taW5kc3BhcmsubGsvYWRtaW4vam9icyI7czo1OiJyb3V0ZSI7czoxNjoiYWRtaW4uam9icy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1783315261),
('ij90lHAebwjLeckhSgLnw9LUJfE1OHHKZGqeSPew', 32, '172.68.200.159', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNEF4ZlpxT0JxbkNaZ3RRejBFYzZWRTFJb2U4SmVnZzRESHBQR3BZeiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjgwOiJodHRwczovL3NhbGFyeS5taW5kc3BhcmsubGsvYWRtaW4vam9icz9jbGllbnRfaWQ9Jm9mZmljZXJfaWQ9JnNlYXJjaD01Mjkmc3RhdHVzPSI7czo1OiJyb3V0ZSI7czoxNjoiYWRtaW4uam9icy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjMyO30=', 1783312472),
('RjuPmgu7xTU1Yb2GjjnNANd1Wvm0QoVdZS1S6CEB', 1, '172.68.200.158', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiY0ZTQ2ZqanpRV0w4SlJkaTFZT2s2Sk1LZGFMYjdNc0hOQ2M0SkRXeiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM4OiJodHRwczovL3NhbGFyeS5taW5kc3BhcmsubGsvYWRtaW4vam9icyI7czo1OiJyb3V0ZSI7czoxNjoiYWRtaW4uam9icy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1783315767),
('sVSsy9MOSpndBfU7hV56rgMfcIgTtCIYVXDrfFTd', 18, '172.68.200.159', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRFJvdHlKQTlYRjVWbk1jZ1dJQkJyUkU4SWxDNjVmNEh4dWxIUVVXOCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHBzOi8vc2FsYXJ5Lm1pbmRzcGFyay5say9hZG1pbi9qb2JzL2NyZWF0ZSI7czo1OiJyb3V0ZSI7czoxNzoiYWRtaW4uam9icy5jcmVhdGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxODt9', 1783315960),
('YVIrrmHFGl8W35fe0AOltdKOWuSopYYQd3A8fapT', NULL, '172.68.200.158', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQ2V1YzNJQktLSTJta01XVjZwOU5nS1JSUW9DZ3M3b1pOeUthSFRrVyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MzoiaHR0cHM6Ly9zYWxhcnkubWluZHNwYXJrLmxrL2FkbWluL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjQzOiJodHRwczovL3NhbGFyeS5taW5kc3BhcmsubGsvYWRtaW4vZGFzaGJvYXJkIjtzOjU6InJvdXRlIjtzOjE1OiJhZG1pbi5kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1783311672);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'text',
  `group` varchar(255) NOT NULL DEFAULT 'general',
  `label` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `is_public` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_public`, `created_at`, `updated_at`) VALUES
(1, 'company_name', 'Default Company', 'text', 'company', 'Company Name', 'The official name of your company', 1, '2025-09-23 14:25:17', '2025-09-23 16:35:07'),
(2, 'company_address', 'Default Address', 'textarea', 'company', 'Company Address', 'Complete business address', 1, '2025-09-23 14:25:17', '2025-09-23 16:35:07'),
(3, 'company_phone', '+1 (555) 123-4567', 'text', 'company', 'Company Phone', 'Main business phone number', 1, '2025-09-23 14:25:17', '2025-09-23 14:25:17'),
(4, 'company_email', 'info@mindspark.com', 'email', 'company', 'Company Email', 'Main business email address', 1, '2025-09-23 14:25:17', '2026-01-05 14:54:12'),
(5, 'company_website', 'https://www.mindspark.com', 'url', 'company', 'Company Website', 'Official company website URL', 1, '2025-09-23 14:25:17', '2026-01-05 14:54:12'),
(6, 'company_logo', NULL, 'text', 'company', 'Company Logo URL', 'URL to the company logo image', 1, '2025-09-23 14:25:17', '2025-09-23 14:54:20'),
(7, 'app_name', 'Mindspark oo', 'text', 'system', 'Application Name', 'Name displayed in the application header', 0, '2025-09-23 14:25:17', '2026-01-05 14:54:12'),
(8, 'app_description', 'Comprehensive business management system', 'textarea', 'system', 'Application Description', 'Brief description of the application', 0, '2025-09-23 14:25:17', '2025-09-23 14:25:17'),
(9, 'timezone', 'UTC', 'text', 'system', 'Default Timezone', 'Default timezone for the application', 0, '2025-09-23 14:25:17', '2025-09-23 14:25:17'),
(10, 'date_format', 'Y-m-d', 'text', 'system', 'Date Format', 'Default date format (PHP date format)', 0, '2025-09-23 14:25:17', '2025-09-23 14:25:17'),
(11, 'items_per_page', '10', 'number', 'system', 'Items Per Page', 'Default number of items to display per page', 0, '2025-09-23 14:25:17', '2025-09-23 14:25:17'),
(12, 'mail_from_name', 'Mindspark Solutions', 'text', 'email', 'Email From Name', 'Name used in outgoing emails', 0, '2025-09-23 14:25:17', '2026-01-05 14:54:12'),
(13, 'mail_from_address', 'noreply@mindpark.com', 'email', 'email', 'Email From Address', 'Email address used for outgoing emails', 0, '2025-09-23 14:25:17', '2025-09-23 14:25:17'),
(14, 'mail_reply_to', 'support@mindpark.com', 'email', 'email', 'Reply To Address', 'Email address for replies', 0, '2025-09-23 14:25:17', '2025-09-23 14:25:17'),
(15, 'enable_notifications', '1', 'boolean', 'notifications', 'Enable Notifications', 'Enable system notifications', 0, '2025-09-23 14:25:17', '2025-09-23 14:25:17'),
(16, 'notification_email', 'admin@mindpark.com', 'email', 'notifications', 'Notification Email', 'Email address for system notifications', 0, '2025-09-23 14:25:17', '2025-09-23 14:25:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `xelenic_id` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `xelenic_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'salary.mindspark@gmail.com', NULL, NULL, '$2y$12$sOUTbtW0dNwQCRDxTK7JU.Rn6XjES6XiOd9iKo/1BR45VM3h2Qcw6', NULL, '2025-09-13 20:47:37', '2026-01-19 20:45:26'),
(7, 'Nelunka Deshan', 'nelunka.mindspark@gmail.com', 'Activation Officer Senior', NULL, '$2y$12$M9/sjINlA8OuoO9.wd6KgeGx.KTvabJ6C1GAx/1rYRoOZR9U1rcOy', NULL, '2025-09-18 23:12:54', '2026-01-21 18:01:46'),
(9, 'Gayan Wijesinghe', 'gayan.mindspark@gmail.com', 'Director - Sales & Marketing', NULL, '$2y$12$6/5DwHASMxK8q6ujLEFE.OkJAVGQ8cAnJe./mPumKapfdwh0h4WF6', NULL, '2026-01-02 14:25:54', '2026-06-16 16:30:56'),
(10, 'Mohommed Mafaz', 'mafaz.mindspark@gmail.com', 'Director-Finance', NULL, '$2y$12$NYFWJoYhPB.5K7VeHJ4WfuIzBdh/Bzi46X.OmRXe7N7FE1ieXVOBS', NULL, '2026-01-02 14:29:04', '2026-01-14 12:11:30'),
(11, 'Chamika Wijesuriya', 'chamika.mindspark@gmail.com', 'Director-Operations', NULL, '$2y$12$XtWjw2KFQnbqTL0QlnNXm.gw2dSWqpNSY6PoG/EWiEGooSytwD6a2', NULL, '2026-01-02 14:45:22', '2026-01-14 12:11:54'),
(12, 'Nalinda Anura', 'nalinda.mindspark@gmail.com', 'Senior Activation Officer', NULL, '$2y$12$543WRRMvyoT7wLRbSa3aMupl3pJYuX3giwGsgaCWYHbT/dMfM65.G', NULL, '2026-01-05 20:00:03', '2026-01-19 12:30:13'),
(13, 'Chahtura Senevirathne', 'chathura.mindspark@gmail.com', 'Activation Executive', NULL, '$2y$12$R8NfVdHVy7zqy/2qH0qgi.jY3x.ZOQcJAdPHQRqeoH1cbzah6mqcO', NULL, '2026-01-05 20:00:58', '2026-01-21 18:02:34'),
(16, 'Shanya Rathnayaka', 'shanya.mindspark@gmail.com', 'Assistant Manager', NULL, '$2y$12$rHSlx/im.rK407J6V.mMvu9H27sbS.Sa/x7CzjQF0RWsdjzbNclUe', NULL, '2026-01-05 21:07:39', '2026-01-26 13:17:09'),
(17, 'Shashini  Keshani', 'shashini.mindspark@gmail.com', 'Activation Officer', NULL, '$2y$12$3JQTUeKkkzZ3tveDgaeex.OroAiNx9mZTMOrkp8h6tRqbDgXVIVxq', NULL, '2026-01-05 21:08:35', '2026-01-27 18:06:57'),
(18, 'Kasuni Mahesha', 'kasuni.mindspark@gmail.com', 'Business Development Executive', NULL, '$2y$12$dU0MHhAdqpvRsQ2YJKvttetI7HdLlcOU/F5EGEkxfTJ.HswpsFX1.', NULL, '2026-01-05 21:13:32', '2026-01-27 17:37:16'),
(19, 'Dinithi Chethana', 'dinithi.mindspark@gmail.com', 'Intern-Business Development', NULL, '$2y$12$1akptCqrbOl0U8yOUsYOrOTPEBcFTu4MhANhMfeq2xSTL6JPjpCMi', NULL, '2026-01-05 21:15:54', '2026-01-27 17:35:36'),
(24, 'Prabswara Dewmina', 'dewmina.mindspark@gmail.com', NULL, NULL, '$2y$12$hJxhPEZVXll9O3zS0wnskuQwI2FnlN9lcrX06NYO1zGuW9kAyUHcG', NULL, '2026-01-14 12:19:15', '2026-01-14 12:21:47'),
(29, 'Shamini Shashika', 'shamini.mindspark@gmail.com', NULL, NULL, '$2y$12$RJpdpGos/U275MGEYqW46uq1InQhfp7Ag2BR5gBXTBeZSCdAa/g1i', NULL, '2026-01-26 20:34:18', '2026-01-26 20:34:18'),
(32, 'Lalani thushari', 'thushari.mindspark@gmail.com', NULL, NULL, '$2y$12$wn.GZhNCmIPgOJlDamVrFec01qiZjnZ2g.aCaDah/8vzEK/djJXd6', NULL, '2026-02-16 16:36:25', '2026-02-16 16:36:25'),
(33, 'Dushan Lahiru', 'dushan.mindspark@gmail.com', NULL, NULL, '$2y$12$Z7ZMSQP5L2QzSlTJJKI7AuIJgSoYmIKNUS5f4Bg9CyNgT.x6c26rW', NULL, '2026-03-03 14:22:26', '2026-03-03 14:22:26'),
(34, 'Chamara Madusan', 'chamara.mindspark@gmail.com', NULL, NULL, '$2y$12$wELGUCfaO/jAgeEZbrbAeO9wsKoPrflDOUcV9Zb1PASQ6mzMlQcV.', NULL, '2026-03-10 13:20:43', '2026-03-10 13:20:43'),
(36, 'Test Client Service', 'testclient@yopmail.com', NULL, NULL, '$2y$12$mKrAYKzEAsRBCKkwOpNXsefs/htNGxXWvGK0g9LNovfaq8npsWXD6', NULL, '2026-06-29 23:33:58', '2026-06-29 23:33:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allowances`
--
ALTER TABLE `allowances`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_short_code_unique` (`short_code`),
  ADD UNIQUE KEY `clients_email_unique` (`email`);

--
-- Indexes for table `coordinators`
--
ALTER TABLE `coordinators`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coordinators_coordinator_id_unique` (`coordinator_id`),
  ADD UNIQUE KEY `coordinators_nic_no_unique` (`nic_no`);

--
-- Indexes for table `custom_jobs`
--
ALTER TABLE `custom_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `custom_jobs_job_number_unique` (`job_number`),
  ADD KEY `custom_jobs_client_id_foreign` (`client_id`),
  ADD KEY `custom_jobs_officer_id_foreign` (`officer_id`),
  ADD KEY `custom_jobs_reporter_id_foreign` (`reporter_id`);

--
-- Indexes for table `employers_salary_sheet_item`
--
ALTER TABLE `employers_salary_sheet_item`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employers_salary_sheet_item_no_unique` (`no`),
  ADD KEY `employers_salary_sheet_item_sheet_no_foreign` (`sheet_no`),
  ADD KEY `employers_salary_sheet_item_job_id_sheet_no_index` (`job_id`,`sheet_no`),
  ADD KEY `employers_salary_sheet_item_position_id_index` (`position_id`),
  ADD KEY `employers_salary_sheet_item_promoter_id_index` (`promoter_id`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `position_wise_salary_rules`
--
ALTER TABLE `position_wise_salary_rules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `position_job_unique` (`position_id`,`job_id`),
  ADD KEY `position_wise_salary_rules_job_id_foreign` (`job_id`);

--
-- Indexes for table `promoters`
--
ALTER TABLE `promoters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `promoters_promoter_id_unique` (`promoter_id`),
  ADD UNIQUE KEY `promoters_identity_card_no_unique` (`identity_card_no`),
  ADD KEY `promoters_position_id_foreign` (`position_id`);

--
-- Indexes for table `promoter_positions`
--
ALTER TABLE `promoter_positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reports_created_by_foreign` (`created_by`);

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
-- Indexes for table `salary_sheet`
--
ALTER TABLE `salary_sheet`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `salary_sheet_sheet_no_unique` (`sheet_no`),
  ADD KEY `salary_sheet_job_id_status_index` (`job_id`,`status`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_xelenic_id_unique` (`xelenic_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allowances`
--
ALTER TABLE `allowances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `coordinators`
--
ALTER TABLE `coordinators`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `custom_jobs`
--
ALTER TABLE `custom_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employers_salary_sheet_item`
--
ALTER TABLE `employers_salary_sheet_item`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `position_wise_salary_rules`
--
ALTER TABLE `position_wise_salary_rules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `promoters`
--
ALTER TABLE `promoters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT for table `promoter_positions`
--
ALTER TABLE `promoter_positions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `salary_sheet`
--
ALTER TABLE `salary_sheet`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `custom_jobs`
--
ALTER TABLE `custom_jobs`
  ADD CONSTRAINT `custom_jobs_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `custom_jobs_officer_id_foreign` FOREIGN KEY (`officer_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `custom_jobs_reporter_id_foreign` FOREIGN KEY (`reporter_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `employers_salary_sheet_item`
--
ALTER TABLE `employers_salary_sheet_item`
  ADD CONSTRAINT `employers_salary_sheet_item_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `custom_jobs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employers_salary_sheet_item_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `promoter_positions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employers_salary_sheet_item_promoter_id_foreign` FOREIGN KEY (`promoter_id`) REFERENCES `promoters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employers_salary_sheet_item_sheet_no_foreign` FOREIGN KEY (`sheet_no`) REFERENCES `salary_sheet` (`sheet_no`) ON DELETE CASCADE;

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
-- Constraints for table `position_wise_salary_rules`
--
ALTER TABLE `position_wise_salary_rules`
  ADD CONSTRAINT `position_wise_salary_rules_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `custom_jobs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `position_wise_salary_rules_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `promoter_positions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `promoters`
--
ALTER TABLE `promoters`
  ADD CONSTRAINT `promoters_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `promoter_positions` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `salary_sheet`
--
ALTER TABLE `salary_sheet`
  ADD CONSTRAINT `salary_sheet_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `custom_jobs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
