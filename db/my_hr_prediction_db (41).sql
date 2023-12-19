-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2022 at 12:34 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_hr_prediction_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `allowance_heads`
--

CREATE TABLE `allowance_heads` (
  `id` bigint(20) NOT NULL,
  `allowance_com_id` int(11) DEFAULT NULL,
  `allowance_head_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `allowance_heads`
--

INSERT INTO `allowance_heads` (`id`, `allowance_com_id`, `allowance_head_name`, `created_at`, `updated_at`) VALUES
(8, 1, 'House Rent', '2021-10-10 04:30:38', '2021-12-05 10:01:22'),
(9, 1, 'Medical Allowances', '2021-10-10 04:30:51', '2021-12-05 10:01:25'),
(10, 1, 'Transport Allowances', '2021-10-10 04:30:57', '2021-12-05 10:01:32'),
(11, 1, 'Mobile Allowance', '2021-10-10 04:31:04', '2021-12-05 10:01:34'),
(12, 1, 'Special Allowance', '2021-10-10 04:31:10', '2021-12-05 10:01:36');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(10) NOT NULL,
  `announcement_com_id` int(10) NOT NULL,
  `announcement_department_id` int(10) NOT NULL,
  `announcement_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `announcement_desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `announcement_by` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `announcement_com_id`, `announcement_department_id`, `announcement_title`, `announcement_desc`, `announcement_by`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'Test2', 'Test2', 5, '2021-12-06 06:33:27', '2021-12-06 02:16:52'),
(5, 1, 1, 'hhhh', 'tryhtr', 5, '2021-12-06 02:20:11', '2021-12-06 02:20:11');

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` int(10) NOT NULL,
  `area_com_id` int(10) NOT NULL,
  `area_region_id` int(10) NOT NULL,
  `area_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `area_com_id`, `area_region_id`, `area_name`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Dhaka-North', '2021-11-29 03:46:01', '2021-12-04 23:10:52'),
(3, 1, 5, 'Mowlobi Bazar', '2021-12-05 00:52:27', '2021-12-05 00:56:43');

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` bigint(20) NOT NULL,
  `asset_com_id` bigint(20) NOT NULL,
  `asset_department_id` bigint(20) NOT NULL,
  `asset_employee_id` bigint(20) NOT NULL,
  `asset_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asset_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asset_category_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asset_is_working` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asset_purchase_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asset_warranty_end_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asset_manufacturer` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asset_serial_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asset_note` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `asset_image` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `asset_com_id`, `asset_department_id`, `asset_employee_id`, `asset_name`, `asset_code`, `asset_category_name`, `asset_is_working`, `asset_purchase_date`, `asset_warranty_end_date`, `asset_manufacturer`, `asset_serial_number`, `asset_note`, `asset_image`, `created_at`, `updated_at`) VALUES
(4, 1, 1, 10, 'Microlab', 'TMN-8', 'Speaker', 'Yes', '2022-01-18', '2022-01-21', 'Computer Source', '232-323-343-43', 'One pc Microlab TMN-8 Speaker', 'uploads/asset-images/1642923646.jpg', '2022-01-23 01:40:46', '2022-01-23 01:40:46');

-- --------------------------------------------------------

--
-- Table structure for table `asset_categories`
--

CREATE TABLE `asset_categories` (
  `id` bigint(20) NOT NULL,
  `asset_category_com_id` bigint(20) NOT NULL,
  `asset_category_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `asset_categories`
--

INSERT INTO `asset_categories` (`id`, `asset_category_com_id`, `asset_category_name`, `created_at`, `updated_at`) VALUES
(2, 1, 'Speaker', '2022-01-22 23:47:22', '2022-01-23 01:37:10');

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `attendance_com_id` int(10) NOT NULL,
  `attendance_date` date NOT NULL,
  `clock_in` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `check_in_ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clock_out` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_out_ip` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_in_latitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `check_out_latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_in_longitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `check_out_longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_in_out` tinyint(4) NOT NULL,
  `time_late` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '00:00',
  `early_leaving` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '00:00',
  `overtime` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '00:00',
  `total_work` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '00:00',
  `total_rest` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '00:00',
  `attendance_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'present',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `employee_id`, `attendance_com_id`, `attendance_date`, `clock_in`, `check_in_ip`, `clock_out`, `check_out_ip`, `check_in_latitude`, `check_out_latitude`, `check_in_longitude`, `check_out_longitude`, `check_in_out`, `time_late`, `early_leaving`, `overtime`, `total_work`, `total_rest`, `attendance_status`, `created_at`, `updated_at`) VALUES
(132, 5, 1, '2021-12-01', '13:25:58', '127.0.0.1', '13:26:02', '127.0.0.1', '23.8219166', '23.8219166', '90.4212171', '90.4212171', 1, '04:25:58', '04:33:58', '00:00', '00:00', '00:00', 'Present', '2022-01-01 01:25:58', '2022-01-01 01:26:02'),
(136, 5, 1, '2022-01-02', '15:12:40', '127.0.0.1', '15:12:44', '127.0.0.1', '23.8220099', '23.8220099', '90.4210882', '90.4210882', 1, '06:12:40', '00:00', '01:12:44', '00:00', '00:00', 'Present', '2022-01-02 03:12:40', '2022-01-02 03:12:44'),
(137, 5, 1, '2022-01-03', '11:09:58', '127.0.0.1', '11:20:38', '127.0.0.1', '23.8126469', '23.8126469', '90.4107072', '90.4107072', 1, '02:9:58', '06:39:22', '00:00', '00:00', '00:00', 'Present', '2022-01-02 23:09:58', '2022-01-02 23:20:38'),
(139, 5, 1, '2022-01-18', '16:41:16', '127.0.0.1', '17:12:25', '127.0.0.1', '23.8218004', '23.8218004', '90.4211987', '90.4211987', 1, '07:41:16', '00:47:35', '00:00', '00:00', '00:00', 'Present', '2022-01-18 04:41:16', '2022-01-18 05:12:25'),
(140, 5, 1, '2022-01-19', '09:24:38', '127.0.0.1', NULL, NULL, '23.8218241', NULL, '90.4210329', NULL, 0, '00:24:38', '00:00', '00:00', '00:00', '00:00', 'Present', '2022-01-18 21:24:38', '2022-01-18 21:24:38'),
(141, 5, 1, '2022-01-22', '10:01:36', '127.0.0.1', '10:01:43', '127.0.0.1', '23.8220099', '23.8220099', '90.4210882', '90.4210882', 1, '01:1:36', '07:58:17', '00:00', '00:00', '00:00', 'Present', '2022-01-21 22:01:36', '2022-01-21 22:01:43'),
(142, 5, 1, '2022-01-23', '11:18:46', '127.0.0.1', NULL, NULL, '23.8221958', NULL, '90.4211066', NULL, 0, '02:18:46', '00:00', '00:00', '00:00', '00:00', 'Present', '2022-01-22 23:18:47', '2022-01-22 23:18:47'),
(143, 5, 1, '2022-01-24', '09:41:12', '127.0.0.1', '11:43:48', '127.0.0.1', '23.821824', '23.821824', '90.4210514', '90.4210514', 1, '00:41:12', '06:16:12', '00:00', '00:00', '00:00', 'Present', '2022-01-23 21:41:12', '2022-01-23 23:43:48'),
(144, 5, 1, '2022-01-25', '09:42:21', '127.0.0.1', NULL, NULL, '23.821824', NULL, '90.4210514', NULL, 0, '00:42:21', '00:00', '00:00', '00:00', '00:00', 'Present', '2022-01-24 21:42:21', '2022-01-24 21:42:21');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_locations`
--

CREATE TABLE `attendance_locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `latitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendance_locations`
--

INSERT INTO `attendance_locations` (`id`, `latitude`, `longitude`, `post_code`, `city`, `region`, `country`, `created_at`, `updated_at`) VALUES
(40, '23.8219403', '90.4210329', '1212', 'Dhaka', 'baridhara RA', 'Bangladesh', '2021-08-11 09:58:40', '2021-08-11 11:05:59'),
(41, '39.7668', '88.7608433', '1206', 'Dhaka', 'Gulistan', 'Bangladesh', '2021-11-23 07:12:00', '2021-11-23 07:12:00'),
(42, '23.8125446', '90.4107076', '1206', 'Dhaka', 'Baridhara', 'Bangladesh', '2021-11-24 04:09:43', '2021-11-24 04:09:43');

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

CREATE TABLE `awards` (
  `id` bigint(20) NOT NULL,
  `award_com_id` bigint(20) NOT NULL,
  `award_department_id` bigint(20) NOT NULL,
  `award_employee_id` bigint(20) NOT NULL,
  `award_type_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `award_gift` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `award_cash` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `award_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `award_photo` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `award_info` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `awards`
--

INSERT INTO `awards` (`id`, `award_com_id`, `award_department_id`, `award_employee_id`, `award_type_name`, `award_gift`, `award_cash`, `award_date`, `award_photo`, `award_info`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 6, 'Best Seller of the Month', 'test', '6000', '2022-01-18', 'uploads/award-photos/1642479745.jpg', 'ssss', '2022-01-17 22:22:25', '2022-01-17 22:22:25'),
(3, 1, 1, 6, 'Best Seller of the Month', 'Bike233333', '500023333', '2022-02-02', 'uploads/award-photos/1642482177.png', 'h2333', '2022-01-17 22:50:56', '2022-01-19 22:51:47');

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` bigint(20) NOT NULL,
  `bank_account_com_id` bigint(20) NOT NULL,
  `bank_account_employee_id` bigint(20) NOT NULL,
  `stuff_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_account_number` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_branch` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `bank_account_com_id`, `bank_account_employee_id`, `stuff_id`, `bank_name`, `bank_account_number`, `bank_code`, `bank_branch`, `created_at`, `updated_at`) VALUES
(2, 1, 5, '458-92389-923', 'DBBL', '35238732175', '2334', 'Baridhara DOHS', '2022-01-05 02:28:54', '2022-01-05 02:28:54');

-- --------------------------------------------------------

--
-- Table structure for table `commissions`
--

CREATE TABLE `commissions` (
  `id` bigint(20) NOT NULL,
  `commission_com_id` bigint(20) NOT NULL,
  `commission_employee_id` bigint(20) NOT NULL,
  `commission_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commission_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commission_desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `commission_month_year` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commission_amount` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `commissions`
--

INSERT INTO `commissions` (`id`, `commission_com_id`, `commission_employee_id`, `commission_type`, `commission_title`, `commission_desc`, `commission_month_year`, `commission_amount`, `created_at`, `updated_at`) VALUES
(3, 1, 5, 'Performance-Bonus', 'preformance', 'eeee', '2021-11-01', 2000, '2021-12-28 03:29:19', '2021-12-28 03:29:19'),
(4, 1, 7, 'Project-Bonus', 'dsss', 'dfdf', '2021-10-01', 12000, '2021-12-28 05:42:56', '2021-12-28 05:42:56'),
(5, 1, 39, 'Project-Bonus', 'Project Bonus', 'Project Bonus', '2022-01-01', 20000, '2022-01-10 02:25:05', '2022-01-10 02:25:05');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(10) NOT NULL,
  `company_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_phone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_web_address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_package` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_logo` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `company_email`, `company_password`, `company_phone`, `company_address`, `company_web_address`, `company_city`, `company_country`, `company_package`, `company_logo`, `created_at`, `updated_at`) VALUES
(1, 'Prediction Learning Associates Ltd.', 'mahbubwebsoft@gmail.com', '', '+8801713334874', 'h-20.jatrabari', 'https://www.perfettivanmelle.com/', 'Dhaka', 'Bangladesh', 'Premium', 'uploads/logos\\logo (1).png', '2021-11-28 08:48:38', '2022-01-16 00:13:06'),
(2, 'Walton', NULL, '', NULL, NULL, NULL, NULL, NULL, 'General', NULL, '2021-11-28 08:48:38', '2021-11-28 08:48:38'),
(14, 'qqqq', 'it@predictionla.com', '12345678', '21321453233', NULL, NULL, 'Dhaka', 'Bangladesh', 'Platinum', 'uploads/logos\\259401568_2063302520494858_4130558274730544292_n.jpg', '2021-12-29 04:58:11', '2021-12-29 04:58:11'),
(19, 'City One', 'cityone@gmail.com', '12345678', '547788456238845', NULL, NULL, 'Dhaka', 'Bangladesh', 'Platinum', 'uploads/logos\\multicolored-gas-cylinders-isolated.jpg', '2022-01-12 06:02:01', '2022-01-12 06:02:01'),
(20, 'abc', 'perdictionitabc@gmail.com', '12345678', '784563463634', NULL, NULL, 'Dhaka', 'Bangladesh', 'Platinum', 'uploads/logos\\multicolored-gas-cylinders-isolated.jpg', '2022-01-12 06:33:33', '2022-01-12 06:33:33');

-- --------------------------------------------------------

--
-- Table structure for table `company_calendars`
--

CREATE TABLE `company_calendars` (
  `id` bigint(20) NOT NULL,
  `company_calendar_com_id` bigint(20) NOT NULL,
  `company_calendar_unique_key` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_calendar_employee_id` bigint(20) DEFAULT NULL,
  `company_calendar_employee_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_calendar_employee_all` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `calander_detail_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `calander_details` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_calendar_event_department_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_calendars`
--

INSERT INTO `company_calendars` (`id`, `company_calendar_com_id`, `company_calendar_unique_key`, `company_calendar_employee_id`, `company_calendar_employee_name`, `company_calendar_employee_all`, `calander_detail_type`, `title`, `calander_details`, `start`, `end`, `company_calendar_event_department_name`, `created_at`, `updated_at`) VALUES
(83, 1, 'L8Fp9ZBAAvDS5CCCPUM85kvEd', NULL, NULL, 'Yes', 'Holiday', 'Valentines Day', NULL, '2022-02-14', '2022-02-14', NULL, '2022-01-26 03:13:56', '2022-01-26 03:13:56'),
(87, 1, NULL, 10, 'Maee Al', NULL, 'Leave', 'Leave for Maee Al', 'qsqs', '2022-01-27', '2022-01-26', NULL, '2022-01-26 03:21:26', '2022-01-26 03:21:26'),
(88, 1, NULL, 7, 'Majhar Alam', NULL, 'Leave', 'Leave for Majhar Alam', 'a', '2022-01-03', '2022-01-11', NULL, '2022-01-26 03:59:10', '2022-01-26 03:59:10'),
(89, 1, NULL, 6, 'Tarek Alam', NULL, 'Leave', 'Leave for Tarek Alam', 'adsad', '2022-01-27', '2022-01-29', NULL, '2022-01-26 04:03:10', '2022-01-26 04:03:10');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` bigint(20) NOT NULL,
  `complaint_com_id` bigint(20) NOT NULL,
  `complaint_from_department_id` bigint(20) NOT NULL,
  `complaint_from_employee_id` bigint(20) NOT NULL,
  `complaint_to_department_id` bigint(20) NOT NULL,
  `complaint_to_employee_id` bigint(20) NOT NULL,
  `complaint_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `complaint_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `complaint_desc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `complaint_com_id`, `complaint_from_department_id`, `complaint_from_employee_id`, `complaint_to_department_id`, `complaint_to_employee_id`, `complaint_date`, `complaint_title`, `complaint_desc`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 6, 3, 7, '2022-01-20', 's', 's', '2022-01-20 05:34:14', '2022-01-20 05:34:14');

-- --------------------------------------------------------

--
-- Table structure for table `db_houses`
--

CREATE TABLE `db_houses` (
  `id` int(10) NOT NULL,
  `db_house_com_id` int(10) NOT NULL,
  `db_house_region_id` int(10) NOT NULL,
  `db_house_area_id` int(10) NOT NULL,
  `db_house_territory_id` int(10) NOT NULL,
  `db_house_town_id` int(10) NOT NULL,
  `db_house_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `db_houses`
--

INSERT INTO `db_houses` (`id`, `db_house_com_id`, `db_house_region_id`, `db_house_area_id`, `db_house_territory_id`, `db_house_town_id`, `db_house_name`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 'Gulshan DB House1', '2021-11-29 03:50:29', '2021-12-05 00:50:46');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) NOT NULL,
  `department_com_id` int(10) NOT NULL,
  `department_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_com_id`, `department_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'IT', '2021-11-29 07:37:04', '2021-11-29 07:37:04'),
(3, 1, 'Human Resources', '2021-12-02 03:59:37', '2021-12-02 03:59:37');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` int(10) NOT NULL,
  `designation_com_id` int(10) NOT NULL,
  `designation_department_id` int(10) NOT NULL,
  `designation_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `designation_com_id`, `designation_department_id`, `designation_name`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Senior Software Engineer', '2021-11-29 08:06:23', '2021-11-29 08:06:23'),
(4, 1, 3, 'HR manager', '2021-12-05 23:44:27', '2021-12-05 23:44:27'),
(5, 1, 1, 'Junior Software Engineer', '2021-11-29 08:06:23', '2021-11-29 08:06:23');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) NOT NULL,
  `document_com_id` bigint(20) NOT NULL,
  `document_employee_id` bigint(20) DEFAULT NULL,
  `document_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_file` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `document_com_id`, `document_employee_id`, `document_type`, `document_title`, `document_description`, `document_file`, `created_at`, `updated_at`) VALUES
(2, 1, 6, 'Certificate', 'lorem ipsum', 'dregfdesf tgrertf', 'uploads/employee-document-files/1642240003.pdf', '2022-01-15 03:46:43', '2022-01-15 03:46:43'),
(3, 1, 7, 'Certificate', 'kjkjkj', 'jkjkjkjkjk', 'uploads/employee-document-files/1643004302.png', '2022-01-24 00:05:02', '2022-01-24 00:05:02');

-- --------------------------------------------------------

--
-- Table structure for table `emergency_contacts`
--

CREATE TABLE `emergency_contacts` (
  `id` int(20) NOT NULL,
  `emergency_contact_com_id` bigint(20) NOT NULL,
  `emergency_contact_employee_id` bigint(20) NOT NULL,
  `emergency_contact_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emergency_contact_relation` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emergency_contact_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emergency_contact_phone` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emergency_contact_address` varchar(291) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `emergency_contacts`
--

INSERT INTO `emergency_contacts` (`id`, `emergency_contact_com_id`, `emergency_contact_employee_id`, `emergency_contact_name`, `emergency_contact_relation`, `emergency_contact_email`, `emergency_contact_phone`, `emergency_contact_address`, `created_at`, `updated_at`) VALUES
(2, 1, 6, 'Mizanur Rahman', 'Uncle', 'mc4wq@gx5j.comrr', '084998625795345', 'Nikunja-25', '2022-01-15 02:57:53', '2022-01-15 02:57:53');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) NOT NULL,
  `event_com_id` bigint(20) NOT NULL,
  `event_unique_key` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_department_id` bigint(20) NOT NULL,
  `event_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_time` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `festival_bonuses`
--

CREATE TABLE `festival_bonuses` (
  `id` bigint(20) NOT NULL,
  `festival_bonus_com_id` bigint(20) NOT NULL,
  `festival_bonus_date_month_year` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `festival_bonus_title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `festival_bonuses`
--

INSERT INTO `festival_bonuses` (`id`, `festival_bonus_com_id`, `festival_bonus_date_month_year`, `festival_bonus_title`, `created_at`, `updated_at`) VALUES
(1, 1, '2021-11-02', 'Eid-ul-Fitr', '2021-12-28 08:40:16', '2021-12-28 08:40:16'),
(4, 1, '2021-09-01', 'Eid ul Adha', '2021-12-29 02:20:19', '2021-12-29 02:24:37');

-- --------------------------------------------------------

--
-- Table structure for table `file_configs`
--

CREATE TABLE `file_configs` (
  `id` bigint(20) NOT NULL,
  `file_config_com_id` bigint(20) NOT NULL,
  `file_config_file_size` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `file_configs`
--

INSERT INTO `file_configs` (`id`, `file_config_com_id`, `file_config_file_size`, `created_at`, `updated_at`) VALUES
(3, 1, 1, '2022-01-24 00:44:01', '2022-01-24 00:44:01');

-- --------------------------------------------------------

--
-- Table structure for table `file_managers`
--

CREATE TABLE `file_managers` (
  `id` bigint(20) NOT NULL,
  `file_manager_com_id` bigint(20) NOT NULL,
  `file_manager_department_id` bigint(20) NOT NULL,
  `file_manager_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_manager_file` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_manager_external_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `file_managers`
--

INSERT INTO `file_managers` (`id`, `file_manager_com_id`, `file_manager_department_id`, `file_manager_name`, `file_manager_file`, `file_manager_external_link`, `created_at`, `updated_at`) VALUES
(3, 1, 1, 'Salary Sheet', 'uploads/file-managers/1642929598.png', 'https://www.linkedin.com/in/mahbub-alam-9a5141214/', '2022-01-23 03:01:02', '2022-01-23 03:19:58'),
(4, 1, 3, 'Ticket', 'uploads/file-managers/1642929858.jpg', NULL, '2022-01-23 03:24:18', '2022-01-23 03:24:51'),
(5, 1, 1, 'Salary Sheet', 'uploads/file-managers/1642998029.png', 'sssss.tgd', '2022-01-23 22:20:29', '2022-01-23 22:20:29');

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` int(10) NOT NULL,
  `holiday_com_id` int(10) DEFAULT NULL,
  `holiday_unique_key` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `holiday_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `holiday_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `holiday_number` int(11) DEFAULT NULL,
  `start_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id`, `holiday_com_id`, `holiday_unique_key`, `holiday_type`, `holiday_name`, `holiday_number`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(72, 1, NULL, 'Weekly-Holiday', 'Fri', 4, NULL, NULL, '2021-12-14 03:38:26', '2022-01-25 23:30:55'),
(91, 1, 'L8Fp9ZBAAvDS5CCCPUM85kvEd', 'Other-Holiday', 'Valentines Day', NULL, '2022-02-14', '2022-02-14', '2022-01-26 03:13:56', '2022-01-26 03:13:56');

-- --------------------------------------------------------

--
-- Table structure for table `immigrants`
--

CREATE TABLE `immigrants` (
  `id` bigint(20) NOT NULL,
  `immigrant_com_id` bigint(20) NOT NULL,
  `immigrant_employee_id` bigint(20) NOT NULL,
  `immigrant_document_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `immigrant_document_number` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `immigrant_issue_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `immigrant_expired_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `immigrant_eligible_review_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `immigrant_document_file` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `immigrant_country` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `immigrants`
--

INSERT INTO `immigrants` (`id`, `immigrant_com_id`, `immigrant_employee_id`, `immigrant_document_type`, `immigrant_document_number`, `immigrant_issue_date`, `immigrant_expired_date`, `immigrant_eligible_review_date`, `immigrant_document_file`, `immigrant_country`, `created_at`, `updated_at`) VALUES
(5, 1, 6, 'VVIP', '7641111', '2022-01-10', '2022-01-24', '2022-01-25', 'uploads/immigrant-files/1642222831.png', 'Bangladesh', '2022-01-15 05:00:31', '2022-01-14 23:00:31');

-- --------------------------------------------------------

--
-- Table structure for table `latetime_configs`
--

CREATE TABLE `latetime_configs` (
  `id` bigint(20) NOT NULL,
  `latetime_config_com_id` bigint(20) NOT NULL,
  `minimum_countable_time` int(10) NOT NULL,
  `minimum_countable_day` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `latetime_configs`
--

INSERT INTO `latetime_configs` (`id`, `latetime_config_com_id`, `minimum_countable_time`, `minimum_countable_day`, `created_at`, `updated_at`) VALUES
(3, 1, 45, 3, '2022-01-02 05:02:23', '2022-01-02 05:08:30');

-- --------------------------------------------------------

--
-- Table structure for table `late_times`
--

CREATE TABLE `late_times` (
  `id` bigint(20) NOT NULL,
  `late_time_com_id` bigint(20) NOT NULL,
  `late_time_employee_id` bigint(20) NOT NULL,
  `late_time_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `late_times`
--

INSERT INTO `late_times` (`id`, `late_time_com_id`, `late_time_employee_id`, `late_time_date`, `created_at`, `updated_at`) VALUES
(1, 1, 5, '2021-12-03', '2022-01-02 23:09:58', '2022-01-02 23:09:58'),
(2, 1, 5, '2021-12-03', '2022-01-02 23:09:58', '2022-01-02 23:09:58'),
(3, 1, 5, '2021-12-03', '2022-01-02 23:09:58', '2022-01-02 23:09:58'),
(7, 1, 5, '2022-01-18', '2022-01-18 04:31:23', '2022-01-18 04:31:23'),
(8, 1, 5, '2022-01-18', '2022-01-18 04:41:16', '2022-01-18 04:41:16'),
(9, 1, 5, '2022-01-22', '2022-01-21 22:01:36', '2022-01-21 22:01:36'),
(10, 1, 5, '2022-01-23', '2022-01-22 23:18:47', '2022-01-22 23:18:47');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `leaves_leave_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `leaves_company_id` bigint(20) UNSIGNED NOT NULL,
  `leaves_department_id` bigint(20) UNSIGNED NOT NULL,
  `leaves_designation_id` int(11) NOT NULL,
  `leaves_employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `leaves_approver_id` bigint(20) DEFAULT NULL,
  `leaves_start_date` date NOT NULL,
  `leaves_end_date` date NOT NULL,
  `total_days` int(11) NOT NULL,
  `leave_reason` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `leaves_status` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `leaves_region_id` int(11) DEFAULT NULL,
  `leaves_area_id` int(11) DEFAULT NULL,
  `leaves_territory_id` int(11) DEFAULT NULL,
  `leaves_town_id` int(11) DEFAULT NULL,
  `leaves_db_house_id` int(11) DEFAULT NULL,
  `is_half` tinyint(4) DEFAULT 0,
  `is_notify` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `leaves_leave_type_id`, `leaves_company_id`, `leaves_department_id`, `leaves_designation_id`, `leaves_employee_id`, `leaves_approver_id`, `leaves_start_date`, `leaves_end_date`, `total_days`, `leave_reason`, `remarks`, `leaves_status`, `leaves_region_id`, `leaves_area_id`, `leaves_territory_id`, `leaves_town_id`, `leaves_db_house_id`, `is_half`, `is_notify`, `created_at`, `updated_at`) VALUES
(26, 1, 1, 1, 1, 7, 5, '2022-01-10', '2022-01-20', 10, 'aaaa', NULL, 'Approved', 1, 1, 1, 1, 1, 1, 0, '2022-01-09 22:08:43', '2022-01-10 02:48:18'),
(51, 1, 1, 1, 1, 7, 5, '2022-01-03', '2022-01-11', 10, 'a', NULL, 'Approved', 1, 1, 1, 1, 1, NULL, 0, '2022-01-09 23:34:50', '2022-01-26 03:59:10'),
(52, 1, 1, 1, 1, 7, 5, '2022-01-27', '2022-01-14', 10, 'a', NULL, 'Approved', 1, 1, 1, 1, 1, NULL, 0, '2022-01-09 23:35:45', '2022-01-26 03:44:44'),
(53, 1, 1, 1, 1, 7, 5, '2022-01-13', '2022-01-12', 10, 'a', NULL, 'Approved', 1, 1, 1, 1, 1, NULL, 0, '2022-01-09 23:37:17', '2022-01-26 03:42:26'),
(56, 1, 1, 1, 1, 6, 5, '2022-01-12', '2022-01-19', 10, 'Sick Leave', NULL, 'Approved', 1, 1, 1, 1, 1, 1, 0, '2022-01-10 03:39:13', '2022-01-25 03:23:32'),
(57, 1, 1, 1, 1, 6, 5, '2022-01-20', '2022-01-25', 10, 'aaa', NULL, 'Approved', 1, 1, 1, 1, 1, 1, 0, '2022-01-10 03:48:46', '2022-01-10 03:49:02'),
(58, 1, 1, 1, 1, 6, 8, '2022-01-19', '2022-01-14', 10, 'ssss', NULL, 'Approved', 1, 1, 1, 1, 1, NULL, 0, '2022-01-12 06:31:02', '2022-01-25 05:24:12'),
(59, NULL, 1, 1, 1, 6, 8, '2022-01-27', '2022-01-27', 10, 'aaa', NULL, 'Approved', 1, 1, 1, 1, 1, NULL, 0, '2022-01-25 05:25:05', '2022-01-25 05:25:33'),
(60, NULL, 1, 1, 1, 10, 6, '2022-01-27', '2022-01-26', 10, 'qsqs', NULL, 'Approved', 1, 1, 1, 1, 1, NULL, 0, '2022-01-26 03:16:31', '2022-01-26 03:16:54'),
(61, NULL, 1, 1, 1, 6, 8, '2022-01-27', '2022-01-29', 10, 'adsad', NULL, 'Approved', 1, 1, 1, 1, 1, NULL, 0, '2022-01-26 04:02:11', '2022-01-26 04:03:10'),
(62, NULL, 1, 1, 1, 26, 6, '2022-01-27', '2022-01-28', 10, 'dfs', NULL, 'Pending', 1, 1, 1, 1, 1, NULL, 0, '2022-01-26 04:10:01', '2022-01-26 04:10:01');

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE `leave_types` (
  `id` int(10) NOT NULL,
  `leave_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `allocated_day` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `leave_type_company_id` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leave_types`
--

INSERT INTO `leave_types` (`id`, `leave_type`, `allocated_day`, `leave_type_company_id`, `created_at`, `updated_at`) VALUES
(1, 'Sick Leave', '14', 1, '2021-12-11 23:38:38', '2021-12-11 23:38:38'),
(3, 'Casual Leave', '14', 1, '2021-12-12 03:15:34', '2021-12-12 03:15:34');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loans_com_id` bigint(20) NOT NULL,
  `loans_employee_id` bigint(20) UNSIGNED NOT NULL,
  `loans_month_year` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loans_start_date` date DEFAULT NULL,
  `loans_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loans_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loans_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loans_no_of_installments` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loans_remaining_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loans_remaining_installments` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loans_monthly_payable` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loans_reason` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `loans_com_id`, `loans_employee_id`, `loans_month_year`, `loans_start_date`, `loans_title`, `loans_amount`, `loans_type`, `loans_no_of_installments`, `loans_remaining_amount`, `loans_remaining_installments`, `loans_monthly_payable`, `loans_reason`, `created_at`, `updated_at`) VALUES
(2, 1, 5, '2021-11', '2021-12-13', 'sss1', '12000', 'Home-Development', '20', '10000001', '20', '500000.05', 'rewrerer1', '2021-12-26 03:56:42', '2021-12-26 05:34:45'),
(6, 1, 39, '2022-01', '2022-01-10', 'Other Loan', '100000', 'Other-Loan', '20', '100000', '20', '5000', 'Loan Test', '2022-01-10 02:31:12', '2022-01-10 02:31:12');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `log_date` datetime NOT NULL,
  `table_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `log_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `log_date`, `table_name`, `log_type`, `data`) VALUES
(1, 5, '2021-12-02 04:55:51', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.45 Safari\\/537.36\"}'),
(2, 5, '2021-12-02 05:24:36', 'users', 'edit', '{\"id\":5,\"report_to_parent_id\":null,\"first_name\":\"Mahbub\",\"last_name\":\"Alam\",\"username\":\"\",\"email\":\"mahbubwebsoft@gmail.com\",\"email_verified_at\":null,\"phone\":\"453454345345345345\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/profile_photos\\\\mahbub.jpg\",\"com_id\":1,\"department_id\":0,\"designation_id\":0,\"office_shift_id\":0,\"attendance_type\":\"\",\"attendance_status\":\"No\",\"joining_date\":\"\",\"is_active\":\"\",\"login_location_id\":\"\",\"check_in_ip\":\"127.0.0.1\",\"check_out_ip\":\"127.0.0.1\",\"check_in_latitude\":\"23.8218475\",\"check_in_longitude\":\"90.4210146\",\"check_out_latitude\":\"23.8218475\",\"check_out_longitude\":\"90.4210146\",\"region_id\":0,\"area_id\":null,\"territory_id\":null,\"town_id\":null,\"db_house_id\":null,\"role_id\":1,\"com_pack\":\"Premium\",\"date_of_birth\":\"\",\"gender\":\"0\",\"remember_token\":null,\"created_at\":\"2021-11-28 09:14:14\",\"updated_at\":\"2021-12-01 09:37:15\"}'),
(3, 5, '2021-12-02 05:26:15', 'users', 'edit', '{\"id\":5,\"report_to_parent_id\":null,\"first_name\":\"Mahbub\",\"last_name\":\"Alam\",\"username\":\"\",\"email\":\"mahbubwebsoft@gmail.com\",\"email_verified_at\":null,\"phone\":\"453454345345345345\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/profile_photos\\\\mahbub.jpg\",\"com_id\":1,\"department_id\":0,\"designation_id\":0,\"office_shift_id\":0,\"attendance_type\":\"\",\"attendance_status\":\"No\",\"joining_date\":\"\",\"is_active\":\"\",\"login_location_id\":\"\",\"check_in_ip\":null,\"check_out_ip\":null,\"check_in_latitude\":null,\"check_in_longitude\":null,\"check_out_latitude\":null,\"check_out_longitude\":null,\"region_id\":0,\"area_id\":null,\"territory_id\":null,\"town_id\":null,\"db_house_id\":null,\"role_id\":1,\"com_pack\":\"Premium\",\"date_of_birth\":\"\",\"gender\":\"0\",\"remember_token\":null,\"created_at\":\"2021-11-28 09:14:14\",\"updated_at\":\"2021-12-02 05:24:36\"}'),
(4, 5, '2021-12-02 05:33:22', 'users', 'edit', '{\"id\":5,\"report_to_parent_id\":null,\"first_name\":\"Mahbub\",\"last_name\":\"Alam\",\"username\":\"\",\"email\":\"mahbubwebsoft@gmail.com\",\"email_verified_at\":null,\"phone\":\"453454345345345345\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/profile_photos\\\\mahbub.jpg\",\"com_id\":1,\"department_id\":0,\"designation_id\":0,\"office_shift_id\":0,\"attendance_type\":\"\",\"attendance_status\":\"No\",\"joining_date\":\"\",\"is_active\":\"\",\"login_location_id\":\"\",\"check_in_ip\":\"No\",\"check_out_ip\":\"No\",\"check_in_latitude\":\"No\",\"check_in_longitude\":\"No\",\"check_out_latitude\":\"No\",\"check_out_longitude\":\"No\",\"region_id\":0,\"area_id\":null,\"territory_id\":null,\"town_id\":null,\"db_house_id\":null,\"role_id\":1,\"com_pack\":\"Premium\",\"date_of_birth\":\"\",\"gender\":\"0\",\"remember_token\":null,\"created_at\":\"2021-11-28 09:14:14\",\"updated_at\":\"2021-12-02 05:26:15\"}'),
(5, 5, '2021-12-02 05:33:29', 'users', 'edit', '{\"id\":5,\"report_to_parent_id\":null,\"first_name\":\"Mahbub\",\"last_name\":\"Alam\",\"username\":\"\",\"email\":\"mahbubwebsoft@gmail.com\",\"email_verified_at\":null,\"phone\":\"453454345345345345\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/profile_photos\\\\mahbub.jpg\",\"com_id\":1,\"department_id\":0,\"designation_id\":0,\"office_shift_id\":0,\"attendance_type\":\"\",\"attendance_status\":\"Yes\",\"joining_date\":\"\",\"is_active\":\"\",\"login_location_id\":\"\",\"check_in_ip\":\"127.0.0.1\",\"check_out_ip\":\"No\",\"check_in_latitude\":\"23.821801\",\"check_in_longitude\":\"90.4209962\",\"check_out_latitude\":\"No\",\"check_out_longitude\":\"No\",\"region_id\":0,\"area_id\":null,\"territory_id\":null,\"town_id\":null,\"db_house_id\":null,\"role_id\":1,\"com_pack\":\"Premium\",\"date_of_birth\":\"\",\"gender\":\"0\",\"remember_token\":null,\"created_at\":\"2021-11-28 09:14:14\",\"updated_at\":\"2021-12-02 05:33:22\"}'),
(6, 5, '2021-12-02 05:46:02', 'users', 'delete', '{\"id\":14,\"report_to_parent_id\":10,\"first_name\":\"z\",\"last_name\":\"z\",\"username\":\"z\",\"email\":\"mc4wq@gxz5j.com\",\"email_verified_at\":null,\"phone\":\"084998625792\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/profile_photos\\\\z_1638263509.avtr).jpg\",\"com_id\":1,\"department_id\":1,\"designation_id\":0,\"office_shift_id\":1,\"attendance_type\":\"general\",\"attendance_status\":null,\"joining_date\":\"2021-11-30\",\"is_active\":null,\"login_location_id\":\"42\",\"check_in_ip\":null,\"check_out_ip\":null,\"check_in_latitude\":\"N\\/A\",\"check_in_longitude\":\"N\\/A\",\"check_out_latitude\":\"N\\/A\",\"check_out_longitude\":\"N\\/A\",\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":null,\"date_of_birth\":\"2021-12-01\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2021-11-30 09:11:49\",\"updated_at\":\"2021-11-30 09:11:49\"}'),
(7, 5, '2021-12-02 08:10:58', 'users', 'edit', '{\"id\":5,\"report_to_parent_id\":null,\"company_profile\":\"Yes\",\"first_name\":\"Mahbub\",\"last_name\":\"Alam\",\"username\":\"\",\"email\":\"mahbubwebsoft@gmail.com\",\"email_verified_at\":null,\"phone\":\"453454345345345345\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/profile_photos\\\\mahbub.jpg\",\"com_id\":1,\"department_id\":0,\"designation_id\":0,\"office_shift_id\":0,\"attendance_type\":\"\",\"attendance_status\":\"No\",\"joining_date\":\"\",\"is_active\":\"\",\"login_location_id\":\"\",\"check_in_ip\":\"No\",\"check_out_ip\":\"No\",\"check_in_latitude\":\"No\",\"check_in_longitude\":\"No\",\"check_out_latitude\":\"No\",\"check_out_longitude\":\"No\",\"region_id\":0,\"area_id\":null,\"territory_id\":null,\"town_id\":null,\"db_house_id\":null,\"role_id\":1,\"com_pack\":\"Premium\",\"date_of_birth\":\"\",\"gender\":\"0\",\"remember_token\":null,\"created_at\":\"2021-11-28 09:14:14\",\"updated_at\":\"2021-12-02 05:33:29\"}'),
(8, 5, '2021-12-02 08:12:46', 'users', 'edit', '{\"id\":5,\"report_to_parent_id\":null,\"company_profile\":\"Yes\",\"first_name\":\"Prediction Learning Associates Ltdnnnnnnnnnnnnnnnnnnnnnn\",\"last_name\":\"Alam\",\"username\":\"\",\"email\":\"mahbubwebsoft@gmail.comnnnnnnnnnnnnnn\",\"email_verified_at\":null,\"phone\":\"453454345345345345nnnnnnnnnnn\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/logos\\\\logo (1).png\",\"com_id\":1,\"department_id\":0,\"designation_id\":0,\"office_shift_id\":0,\"attendance_type\":\"\",\"attendance_status\":\"No\",\"joining_date\":\"\",\"is_active\":\"\",\"login_location_id\":\"\",\"check_in_ip\":\"No\",\"check_out_ip\":\"No\",\"check_in_latitude\":\"No\",\"check_in_longitude\":\"No\",\"check_out_latitude\":\"No\",\"check_out_longitude\":\"No\",\"region_id\":0,\"area_id\":null,\"territory_id\":null,\"town_id\":null,\"db_house_id\":null,\"role_id\":1,\"com_pack\":\"Premium\",\"date_of_birth\":\"\",\"gender\":\"0\",\"remember_token\":null,\"created_at\":\"2021-11-28 09:14:14\",\"updated_at\":\"2021-12-02 08:10:58\"}'),
(9, 5, '2021-12-02 08:13:17', 'users', 'edit', '{\"id\":5,\"report_to_parent_id\":null,\"company_profile\":\"Yes\",\"first_name\":\"Prediction Learning Associates Ltd\",\"last_name\":\"Alam\",\"username\":\"\",\"email\":\"info@predictionla.com\",\"email_verified_at\":null,\"phone\":\"+8801713334874\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/logos\\\\logo (1).png\",\"com_id\":1,\"department_id\":0,\"designation_id\":0,\"office_shift_id\":0,\"attendance_type\":\"\",\"attendance_status\":\"No\",\"joining_date\":\"\",\"is_active\":\"\",\"login_location_id\":\"\",\"check_in_ip\":\"No\",\"check_out_ip\":\"No\",\"check_in_latitude\":\"No\",\"check_in_longitude\":\"No\",\"check_out_latitude\":\"No\",\"check_out_longitude\":\"No\",\"region_id\":0,\"area_id\":null,\"territory_id\":null,\"town_id\":null,\"db_house_id\":null,\"role_id\":1,\"com_pack\":\"Premium\",\"date_of_birth\":\"\",\"gender\":\"0\",\"remember_token\":null,\"created_at\":\"2021-11-28 09:14:14\",\"updated_at\":\"2021-12-02 08:12:46\"}'),
(10, 5, '2021-12-02 08:13:17', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.45 Safari\\/537.36\"}'),
(11, 5, '2021-12-02 11:45:34', 'users', 'edit', '{\"id\":5,\"report_to_parent_id\":null,\"company_profile\":\"Yes\",\"first_name\":\"Prediction Learning Associates Ltd\",\"last_name\":\"Alam\",\"username\":\"\",\"email\":\"info@predictionla.com\",\"email_verified_at\":null,\"phone\":\"+8801713334874\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/logos\\\\logo (1).png\",\"com_id\":1,\"department_id\":0,\"designation_id\":0,\"office_shift_id\":0,\"attendance_type\":\"\",\"attendance_status\":\"No\",\"joining_date\":\"\",\"is_active\":\"\",\"login_location_id\":\"\",\"check_in_ip\":\"No\",\"check_out_ip\":\"No\",\"check_in_latitude\":\"No\",\"check_in_longitude\":\"No\",\"check_out_latitude\":\"No\",\"check_out_longitude\":\"No\",\"region_id\":0,\"area_id\":null,\"territory_id\":null,\"town_id\":null,\"db_house_id\":null,\"role_id\":1,\"com_pack\":\"Premium\",\"date_of_birth\":\"\",\"gender\":\"0\",\"remember_token\":\"vkrvqEgEGxYECFTuEsOACfSk6kFTwoXko8zGLmJxHWK6EfbDNELtRVTGWuva\",\"created_at\":\"2021-11-28 09:14:14\",\"updated_at\":\"2021-12-02 08:12:46\"}'),
(12, 5, '2021-12-02 11:46:14', 'users', 'edit', '{\"id\":5,\"report_to_parent_id\":null,\"company_profile\":\"Yes\",\"first_name\":\"Prediction Learning Associates Ltd\",\"last_name\":\"Alam\",\"username\":\"\",\"email\":\"info@predictionla.com\",\"email_verified_at\":null,\"phone\":\"+8801713334874\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/logos\\\\logo (1).png\",\"com_id\":1,\"department_id\":0,\"designation_id\":0,\"office_shift_id\":0,\"attendance_type\":\"\",\"attendance_status\":\"Yes\",\"joining_date\":\"\",\"is_active\":\"\",\"login_location_id\":\"\",\"check_in_ip\":\"127.0.0.1\",\"check_out_ip\":\"No\",\"check_in_latitude\":\"23.821801\",\"check_in_longitude\":\"90.4209962\",\"check_out_latitude\":\"No\",\"check_out_longitude\":\"No\",\"region_id\":0,\"area_id\":null,\"territory_id\":null,\"town_id\":null,\"db_house_id\":null,\"role_id\":1,\"com_pack\":\"Premium\",\"date_of_birth\":\"\",\"gender\":\"0\",\"remember_token\":\"vkrvqEgEGxYECFTuEsOACfSk6kFTwoXko8zGLmJxHWK6EfbDNELtRVTGWuva\",\"created_at\":\"2021-11-28 09:14:14\",\"updated_at\":\"2021-12-02 11:45:34\"}'),
(13, 5, '2021-12-02 11:54:18', 'users', 'edit', '{\"id\":5,\"report_to_parent_id\":null,\"company_profile\":\"Yes\",\"first_name\":\"Prediction Learning Associates Ltd\",\"last_name\":\"Alam\",\"username\":\"\",\"email\":\"info@predictionla.com\",\"email_verified_at\":null,\"phone\":\"+8801713334874\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/logos\\\\logo (1).png\",\"com_id\":1,\"department_id\":0,\"designation_id\":0,\"office_shift_id\":0,\"attendance_type\":\"\",\"attendance_status\":\"Yes\",\"joining_date\":\"\",\"is_active\":\"\",\"login_location_id\":\"\",\"check_in_ip\":\"127.0.0.1\",\"check_out_ip\":\"127.0.0.1\",\"check_in_latitude\":\"23.821801\",\"check_in_longitude\":\"90.4209962\",\"check_out_latitude\":\"23.821801\",\"check_out_longitude\":\"90.4209962\",\"region_id\":0,\"area_id\":null,\"territory_id\":null,\"town_id\":null,\"db_house_id\":null,\"role_id\":1,\"com_pack\":\"Premium\",\"date_of_birth\":\"\",\"gender\":\"0\",\"remember_token\":\"vkrvqEgEGxYECFTuEsOACfSk6kFTwoXko8zGLmJxHWK6EfbDNELtRVTGWuva\",\"created_at\":\"2021-11-28 09:14:14\",\"updated_at\":\"2021-12-02 11:46:14\"}'),
(14, 5, '2021-12-04 03:33:42', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.45 Safari\\/537.36\"}'),
(15, 5, '2021-12-04 10:07:03', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.45 Safari\\/537.36\"}'),
(16, 5, '2021-12-05 03:18:23', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.45 Safari\\/537.36\"}'),
(17, 5, '2021-12-05 07:48:26', 'users', 'edit', '{\"id\":5,\"report_to_parent_id\":null,\"company_profile\":\"Yes\",\"first_name\":\"Prediction Learning Associates Ltd\",\"last_name\":\"Alam\",\"username\":\"\",\"email\":\"info@predictionla.com\",\"email_verified_at\":null,\"phone\":\"+8801713334874\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/logos\\\\logo (1).png\",\"com_id\":1,\"department_id\":0,\"designation_id\":0,\"office_shift_id\":0,\"attendance_type\":\"\",\"attendance_status\":\"Yes\",\"joining_date\":\"\",\"is_active\":\"\",\"login_location_id\":\"\",\"check_in_ip\":\"127.0.0.1\",\"check_out_ip\":\"127.0.0.1\",\"check_in_latitude\":\"23.821801\",\"check_in_longitude\":\"90.4209962\",\"check_out_latitude\":\"23.821801\",\"check_out_longitude\":\"90.4209962\",\"region_id\":0,\"area_id\":null,\"territory_id\":null,\"town_id\":null,\"db_house_id\":null,\"role_id\":1,\"com_pack\":\"Premium\",\"date_of_birth\":\"\",\"gender\":\"0\",\"remember_token\":\"UO61gMupnkZuqUHL8X4YUCGIhlu4SJyetwIKqKRJYrJNpZmJEOhx8eGxu90W\",\"created_at\":\"2021-11-28 09:14:14\",\"updated_at\":\"2021-12-02 11:46:14\"}'),
(18, 5, '2021-12-05 07:48:28', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.45 Safari\\/537.36\"}'),
(19, 5, '2021-12-05 11:54:57', 'users', 'edit', '{\"id\":5,\"report_to_parent_id\":null,\"company_profile\":\"Yes\",\"first_name\":\"Prediction Learning Associates Ltd\",\"last_name\":\"Alam\",\"username\":\"\",\"email\":\"info@predictionla.com\",\"email_verified_at\":null,\"phone\":\"+8801713334874\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/logos\\\\logo (1).png\",\"com_id\":1,\"department_id\":0,\"designation_id\":0,\"office_shift_id\":0,\"attendance_type\":\"\",\"attendance_status\":\"Yes\",\"joining_date\":\"\",\"is_active\":\"\",\"login_location_id\":\"\",\"check_in_ip\":\"127.0.0.1\",\"check_out_ip\":\"127.0.0.1\",\"check_in_latitude\":\"23.8218016\",\"check_in_longitude\":\"90.4209962\",\"check_out_latitude\":\"23.821801\",\"check_out_longitude\":\"90.4209962\",\"region_id\":0,\"area_id\":null,\"territory_id\":null,\"town_id\":null,\"db_house_id\":null,\"role_id\":1,\"com_pack\":\"Premium\",\"date_of_birth\":\"\",\"gender\":\"0\",\"remember_token\":\"esjZaDopdyv5bdia34Xoo9YQJp8TLP2RreOWMZdYmkHwD2dO13rkAzNQhRRd\",\"created_at\":\"2021-11-28 09:14:14\",\"updated_at\":\"2021-12-02 11:46:14\"}'),
(20, 5, '2021-12-06 04:06:48', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.45 Safari\\/537.36\"}'),
(21, 5, '2021-12-06 04:54:04', 'users', 'edit', '{\"id\":5,\"report_to_parent_id\":null,\"company_profile\":\"Yes\",\"first_name\":\"Prediction Learning Associates Ltd\",\"last_name\":\"Alam\",\"username\":\"\",\"email\":\"info@predictionla.com\",\"email_verified_at\":null,\"phone\":\"+8801713334874\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/logos\\\\logo (1).png\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"\",\"attendance_status\":\"Yes\",\"joining_date\":\"\",\"is_active\":\"\",\"login_location_id\":\"\",\"check_in_ip\":\"127.0.0.1\",\"check_out_ip\":\"127.0.0.1\",\"check_in_latitude\":\"23.8218016\",\"check_in_longitude\":\"90.4209962\",\"check_out_latitude\":\"23.821801\",\"check_out_longitude\":\"90.4209962\",\"region_id\":0,\"area_id\":null,\"territory_id\":null,\"town_id\":null,\"db_house_id\":null,\"role_id\":1,\"com_pack\":\"Premium\",\"date_of_birth\":\"\",\"gender\":\"0\",\"remember_token\":\"Rz4EZ1NEBzTGZqlW9bWLaKDVW5sOT7Q9fvYBZDqeRdR3xPyDTfiPwhQO06rb\",\"created_at\":\"2021-11-28 09:14:14\",\"updated_at\":\"2021-12-02 11:46:14\"}'),
(22, 5, '2021-12-06 04:54:06', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.45 Safari\\/537.36\"}'),
(23, 5, '2021-12-06 08:23:05', 'users', 'edit', '{\"id\":5,\"report_to_parent_id\":null,\"company_profile\":\"Yes\",\"first_name\":\"Prediction Learning Associates\",\"last_name\":\"Ltd\",\"username\":\"\",\"email\":\"info@predictionla.com\",\"email_verified_at\":null,\"phone\":\"+8801713334874\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/logos\\\\logo (1).png\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"\",\"attendance_status\":\"Yes\",\"joining_date\":\"\",\"is_active\":\"\",\"login_location_id\":\"\",\"check_in_ip\":\"127.0.0.1\",\"check_out_ip\":\"127.0.0.1\",\"check_in_latitude\":\"23.8218016\",\"check_in_longitude\":\"90.4209962\",\"check_out_latitude\":\"23.821801\",\"check_out_longitude\":\"90.4209962\",\"region_id\":0,\"area_id\":null,\"territory_id\":null,\"town_id\":null,\"db_house_id\":null,\"role_id\":1,\"com_pack\":\"Premium\",\"date_of_birth\":\"\",\"gender\":\"0\",\"remember_token\":\"uHBfaf4WyrT6DSVATOGTvVwUHNAopDs6AKpJkEzJxwHKk4IryxjaW53KXs2R\",\"created_at\":\"2021-11-28 09:14:14\",\"updated_at\":\"2021-12-02 11:46:14\"}'),
(24, 4, '2021-12-06 08:23:27', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.45 Safari\\/537.36\"}'),
(25, 5, '2021-12-06 08:24:57', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.45 Safari\\/537.36\"}'),
(26, 5, '2021-12-06 11:57:09', 'users', 'edit', '{\"id\":5,\"report_to_parent_id\":null,\"company_profile\":\"Yes\",\"first_name\":\"Prediction Learning Associates\",\"last_name\":\"Ltd\",\"username\":\"\",\"email\":\"info@predictionla.com\",\"email_verified_at\":null,\"phone\":\"+8801713334874\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/logos\\\\logo (1).png\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"\",\"attendance_status\":\"Yes\",\"joining_date\":\"\",\"is_active\":\"\",\"login_location_id\":\"\",\"check_in_ip\":\"127.0.0.1\",\"check_out_ip\":\"127.0.0.1\",\"check_in_latitude\":\"23.8218016\",\"check_in_longitude\":\"90.4209962\",\"check_out_latitude\":\"23.821801\",\"check_out_longitude\":\"90.4209962\",\"region_id\":0,\"area_id\":null,\"territory_id\":null,\"town_id\":null,\"db_house_id\":null,\"role_id\":1,\"com_pack\":\"Premium\",\"date_of_birth\":\"\",\"gender\":\"0\",\"remember_token\":\"bkjb2N1Zdiuq6cMuWRsHGiuOTzfKqtQFBZRuMEYyLosfbBrPLn8ajvadDCRf\",\"created_at\":\"2021-11-28 09:14:14\",\"updated_at\":\"2021-12-02 11:46:14\"}'),
(27, 5, '2021-12-07 03:24:40', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.45 Safari\\/537.36\"}'),
(28, 5, '2021-12-08 03:38:26', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.93 Safari\\/537.36\"}'),
(29, 5, '2021-12-09 03:23:25', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.93 Safari\\/537.36\"}'),
(30, 5, '2021-12-09 11:52:45', 'users', 'edit', '{\"id\":5,\"report_to_parent_id\":null,\"company_profile\":\"Yes\",\"first_name\":\"Prediction Learning Associates\",\"last_name\":\"Ltd\",\"username\":\"PredictionLA\",\"email\":\"info@predictionla.com\",\"email_verified_at\":null,\"phone\":\"+8801713334874\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/logos\\\\logo (1).png\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"\",\"attendance_status\":\"Yes\",\"joining_date\":\"\",\"is_active\":\"\",\"login_location_id\":\"\",\"check_in_ip\":\"127.0.0.1\",\"check_out_ip\":\"127.0.0.1\",\"check_in_latitude\":\"23.8218016\",\"check_in_longitude\":\"90.4209962\",\"check_out_latitude\":\"23.821801\",\"check_out_longitude\":\"90.4209962\",\"region_id\":0,\"area_id\":null,\"territory_id\":null,\"town_id\":null,\"db_house_id\":null,\"role_id\":1,\"com_pack\":\"Premium\",\"date_of_birth\":\"\",\"gender\":\"0\",\"remember_token\":\"unooAywNYSrfAz1QDW6sHZn5tp76XFo571rWsO9tx4WZrHi3CDkwBeNZWXIa\",\"created_at\":\"2021-11-28 09:14:14\",\"updated_at\":\"2021-12-02 11:46:14\"}'),
(31, 5, '2021-12-11 03:21:45', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.93 Safari\\/537.36\"}'),
(32, 5, '2021-12-11 03:23:59', 'users', 'edit', '{\"id\":5,\"report_to_parent_id\":null,\"company_profile\":\"Yes\",\"first_name\":\"Prediction Learning Associates\",\"last_name\":\"Ltd\",\"username\":\"PredictionLA\",\"email\":\"info@predictionla.com\",\"email_verified_at\":null,\"phone\":\"+8801713334874\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/logos\\\\logo (1).png\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"\",\"attendance_status\":\"Yes\",\"joining_date\":\"\",\"is_active\":\"\",\"login_location_id\":\"\",\"check_in_ip\":\"127.0.0.1\",\"check_out_ip\":\"127.0.0.1\",\"check_in_latitude\":\"23.8218016\",\"check_in_longitude\":\"90.4209962\",\"check_out_latitude\":\"23.821801\",\"check_out_longitude\":\"90.4209962\",\"region_id\":0,\"area_id\":null,\"territory_id\":null,\"town_id\":null,\"db_house_id\":null,\"role_id\":1,\"com_pack\":\"Premium\",\"date_of_birth\":\"\",\"gender\":\"0\",\"remember_token\":\"r8Y2PbDT2qYuHS4RLu0WEWdpfYhdLnuwFnQxwjGRThsjIVlLMJoNKmUy5B8m\",\"created_at\":\"2021-11-28 09:14:14\",\"updated_at\":\"2021-12-02 11:46:14\"}'),
(33, 5, '2021-12-11 03:24:11', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.93 Safari\\/537.36\"}'),
(34, 5, '2021-12-12 03:26:09', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.93 Safari\\/537.36\"}'),
(35, 5, '2021-12-13 03:36:30', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.93 Safari\\/537.36\"}'),
(36, 5, '2021-12-13 11:50:43', 'users', 'edit', '{\"id\":5,\"report_to_parent_id\":null,\"company_profile\":\"Yes\",\"first_name\":\"Prediction Learning Associates\",\"last_name\":\"Ltd\",\"username\":\"PredictionLA\",\"email\":\"info@predictionla.com\",\"email_verified_at\":null,\"phone\":\"+8801713334874\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/logos\\\\logo (1).png\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"\",\"attendance_status\":\"Yes\",\"joining_date\":\"\",\"is_active\":\"\",\"login_location_id\":\"\",\"check_in_ip\":\"127.0.0.1\",\"check_out_ip\":\"127.0.0.1\",\"check_in_latitude\":\"23.8218016\",\"check_in_longitude\":\"90.4209962\",\"check_out_latitude\":\"23.821801\",\"check_out_longitude\":\"90.4209962\",\"region_id\":0,\"area_id\":null,\"territory_id\":null,\"town_id\":null,\"db_house_id\":null,\"role_id\":1,\"com_pack\":\"Premium\",\"date_of_birth\":\"\",\"gender\":\"0\",\"remember_token\":\"kdO1B1Q1JrPH7T8TOAGYhpcNjzudFKK3DxZlYK2pHKOi5nTCKpRtKRfh6oBr\",\"created_at\":\"2021-11-28 09:14:14\",\"updated_at\":\"2021-12-02 11:46:14\"}'),
(37, 5, '2021-12-13 11:50:46', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.93 Safari\\/537.36\"}'),
(38, 5, '2021-12-13 11:50:49', 'users', 'edit', '{\"id\":5,\"report_to_parent_id\":null,\"company_profile\":\"Yes\",\"first_name\":\"Prediction Learning Associates\",\"last_name\":\"Ltd\",\"username\":\"PredictionLA\",\"email\":\"info@predictionla.com\",\"email_verified_at\":null,\"phone\":\"+8801713334874\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/logos\\\\logo (1).png\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"\",\"attendance_status\":\"Yes\",\"joining_date\":\"\",\"is_active\":\"\",\"login_location_id\":\"\",\"check_in_ip\":\"127.0.0.1\",\"check_out_ip\":\"127.0.0.1\",\"check_in_latitude\":\"23.8218016\",\"check_in_longitude\":\"90.4209962\",\"check_out_latitude\":\"23.821801\",\"check_out_longitude\":\"90.4209962\",\"region_id\":0,\"area_id\":null,\"territory_id\":null,\"town_id\":null,\"db_house_id\":null,\"role_id\":1,\"com_pack\":\"Premium\",\"date_of_birth\":\"\",\"gender\":\"0\",\"remember_token\":\"jO8Xim17tVZGmCEEEFA5JQiD3DAq9husHdGy36ykpLKoxFzy9YA7MOcfqSjo\",\"created_at\":\"2021-11-28 09:14:14\",\"updated_at\":\"2021-12-02 11:46:14\"}'),
(39, 5, '2021-12-14 03:38:10', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.93 Safari\\/537.36\"}'),
(40, 5, '2021-12-15 03:37:19', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.93 Safari\\/537.36\"}'),
(41, 5, '2021-12-18 03:36:58', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(42, 5, '2021-12-19 03:36:43', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(43, 5, '2021-12-20 03:35:02', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(44, 5, '2021-12-21 03:26:55', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(45, 5, '2021-12-22 03:26:03', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(46, 5, '2021-12-23 03:30:36', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(47, 5, '2021-12-23 03:52:48', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(48, 5, '2021-12-23 06:14:12', 'users', 'edit', '{\"id\":7,\"report_to_parent_id\":5,\"company_profile\":null,\"first_name\":\"Majhar\",\"last_name\":\"Alam\",\"username\":\"20294\",\"email\":\"mc4wq@gx5j.comaasdasd\",\"email_verified_at\":null,\"phone\":\"08499862579\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/profile_photos\\\\mahbub.jpg\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"general\",\"attendance_status\":null,\"joining_date\":\"2021\\/09\\/01\",\"gross_salary\":null,\"user_provident_fund\":5,\"is_active\":null,\"login_location_id\":\"40\",\"check_in_ip\":null,\"check_out_ip\":null,\"check_in_latitude\":\"N\\/A\",\"check_in_longitude\":\"N\\/A\",\"check_out_latitude\":\"N\\/A\",\"check_out_longitude\":\"N\\/A\",\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":null,\"date_of_birth\":\"3542355\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2021-11-29 10:56:16\",\"updated_at\":\"2021-11-29 10:56:16\"}'),
(49, 5, '2021-12-23 06:14:19', 'users', 'edit', '{\"id\":7,\"report_to_parent_id\":5,\"company_profile\":null,\"first_name\":\"Majhar\",\"last_name\":\"Alam\",\"username\":\"20294\",\"email\":\"mc4wq@gx5j.comaasdasd\",\"email_verified_at\":null,\"phone\":\"08499862579\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/profile_photos\\\\mahbub.jpg\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"general\",\"attendance_status\":null,\"joining_date\":\"2021\\/09\\/01\",\"gross_salary\":null,\"user_provident_fund\":6,\"is_active\":null,\"login_location_id\":\"40\",\"check_in_ip\":null,\"check_out_ip\":null,\"check_in_latitude\":\"N\\/A\",\"check_in_longitude\":\"N\\/A\",\"check_out_latitude\":\"N\\/A\",\"check_out_longitude\":\"N\\/A\",\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":null,\"date_of_birth\":\"3542355\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2021-11-29 10:56:16\",\"updated_at\":\"2021-12-23 06:14:12\"}'),
(50, 5, '2021-12-23 06:14:24', 'users', 'edit', '{\"id\":7,\"report_to_parent_id\":5,\"company_profile\":null,\"first_name\":\"Majhar\",\"last_name\":\"Alam\",\"username\":\"20294\",\"email\":\"mc4wq@gx5j.comaasdasd\",\"email_verified_at\":null,\"phone\":\"08499862579\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/profile_photos\\\\mahbub.jpg\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"general\",\"attendance_status\":null,\"joining_date\":\"2021\\/09\\/01\",\"gross_salary\":null,\"user_provident_fund\":7,\"is_active\":null,\"login_location_id\":\"40\",\"check_in_ip\":null,\"check_out_ip\":null,\"check_in_latitude\":\"N\\/A\",\"check_in_longitude\":\"N\\/A\",\"check_out_latitude\":\"N\\/A\",\"check_out_longitude\":\"N\\/A\",\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":null,\"date_of_birth\":\"3542355\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2021-11-29 10:56:16\",\"updated_at\":\"2021-12-23 06:14:19\"}'),
(51, 5, '2021-12-23 06:24:49', 'users', 'edit', '{\"id\":10,\"report_to_parent_id\":6,\"company_profile\":null,\"first_name\":\"Maee\",\"last_name\":\"Al\",\"username\":\"mah\",\"email\":\"mc4wq@gx5j.com\",\"email_verified_at\":null,\"phone\":\"0849986257954444444\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/profile_photos\\\\avtr).jpg\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"general\",\"attendance_status\":null,\"joining_date\":\"2021-12-01\",\"gross_salary\":null,\"user_provident_fund\":null,\"is_active\":\"1\",\"login_location_id\":\"42\",\"check_in_ip\":null,\"check_out_ip\":null,\"check_in_latitude\":\"N\\/A\",\"check_in_longitude\":\"N\\/A\",\"check_out_latitude\":\"N\\/A\",\"check_out_longitude\":\"N\\/A\",\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":null,\"date_of_birth\":\"2021-12-01\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2021-11-30 07:10:01\",\"updated_at\":\"2021-11-30 08:58:39\"}'),
(52, 5, '2021-12-26 03:26:18', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(53, 5, '2021-12-26 06:26:11', 'users', 'edit', '{\"id\":7,\"report_to_parent_id\":5,\"company_profile\":null,\"first_name\":\"Majhar\",\"last_name\":\"Alam\",\"username\":\"20294\",\"email\":\"mc4wq@gx5j.comaasdasd\",\"email_verified_at\":null,\"phone\":\"08499862579\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/profile_photos\\\\mahbub.jpg\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"general\",\"attendance_status\":null,\"joining_date\":\"2021\\/09\\/01\",\"gross_salary\":100,\"user_provident_fund\":10,\"is_active\":null,\"login_location_id\":\"40\",\"check_in_ip\":null,\"check_out_ip\":null,\"check_in_latitude\":\"N\\/A\",\"check_in_longitude\":\"N\\/A\",\"check_out_latitude\":\"N\\/A\",\"check_out_longitude\":\"N\\/A\",\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":null,\"date_of_birth\":\"3542355\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2021-11-29 10:56:16\",\"updated_at\":\"2021-12-23 06:14:24\"}'),
(54, 5, '2021-12-26 06:26:22', 'users', 'edit', '{\"id\":7,\"report_to_parent_id\":5,\"company_profile\":null,\"first_name\":\"Majhar\",\"last_name\":\"Alam\",\"username\":\"20294\",\"email\":\"mc4wq@gx5j.comaasdasd\",\"email_verified_at\":null,\"phone\":\"08499862579\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/profile_photos\\\\mahbub.jpg\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"general\",\"attendance_status\":null,\"joining_date\":\"2021\\/09\\/01\",\"gross_salary\":200,\"user_provident_fund\":10,\"is_active\":null,\"login_location_id\":\"40\",\"check_in_ip\":null,\"check_out_ip\":null,\"check_in_latitude\":\"N\\/A\",\"check_in_longitude\":\"N\\/A\",\"check_out_latitude\":\"N\\/A\",\"check_out_longitude\":\"N\\/A\",\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":null,\"date_of_birth\":\"3542355\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2021-11-29 10:56:16\",\"updated_at\":\"2021-12-26 06:26:11\"}'),
(55, 5, '2021-12-26 06:31:55', 'users', 'edit', '{\"id\":7,\"report_to_parent_id\":5,\"company_profile\":null,\"first_name\":\"Majhar\",\"last_name\":\"Alam\",\"username\":\"20294\",\"email\":\"mc4wq@gx5j.comaasdasd\",\"email_verified_at\":null,\"phone\":\"08499862579\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/profile_photos\\\\mahbub.jpg\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"general\",\"attendance_status\":null,\"joining_date\":\"2021\\/09\\/01\",\"gross_salary\":300,\"user_provident_fund\":10,\"is_active\":null,\"login_location_id\":\"40\",\"check_in_ip\":null,\"check_out_ip\":null,\"check_in_latitude\":\"N\\/A\",\"check_in_longitude\":\"N\\/A\",\"check_out_latitude\":\"N\\/A\",\"check_out_longitude\":\"N\\/A\",\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":null,\"date_of_birth\":\"3542355\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2021-11-29 10:56:16\",\"updated_at\":\"2021-12-26 06:26:22\"}'),
(56, 5, '2021-12-26 06:32:20', 'users', 'edit', '{\"id\":7,\"report_to_parent_id\":5,\"company_profile\":null,\"first_name\":\"Majhar\",\"last_name\":\"Alam\",\"username\":\"20294\",\"email\":\"mc4wq@gx5j.comaasdasd\",\"email_verified_at\":null,\"phone\":\"08499862579\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/profile_photos\\\\mahbub.jpg\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"general\",\"attendance_status\":null,\"joining_date\":\"2021\\/09\\/01\",\"gross_salary\":100,\"user_provident_fund\":10,\"is_active\":null,\"login_location_id\":\"40\",\"check_in_ip\":null,\"check_out_ip\":null,\"check_in_latitude\":\"N\\/A\",\"check_in_longitude\":\"N\\/A\",\"check_out_latitude\":\"N\\/A\",\"check_out_longitude\":\"N\\/A\",\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":null,\"date_of_birth\":\"3542355\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2021-11-29 10:56:16\",\"updated_at\":\"2021-12-26 06:31:55\"}'),
(57, 5, '2021-12-26 06:33:53', 'users', 'edit', '{\"id\":7,\"report_to_parent_id\":5,\"company_profile\":null,\"first_name\":\"Majhar\",\"last_name\":\"Alam\",\"username\":\"20294\",\"email\":\"mc4wq@gx5j.comaasdasd\",\"email_verified_at\":null,\"phone\":\"08499862579\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/profile_photos\\\\mahbub.jpg\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"general\",\"attendance_status\":null,\"joining_date\":\"2021\\/09\\/01\",\"gross_salary\":null,\"user_provident_fund\":10,\"is_active\":null,\"login_location_id\":\"40\",\"check_in_ip\":null,\"check_out_ip\":null,\"check_in_latitude\":\"N\\/A\",\"check_in_longitude\":\"N\\/A\",\"check_out_latitude\":\"N\\/A\",\"check_out_longitude\":\"N\\/A\",\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":null,\"date_of_birth\":\"3542355\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2021-11-29 10:56:16\",\"updated_at\":\"2021-12-26 06:32:20\"}'),
(58, 5, '2021-12-26 06:39:12', 'users', 'edit', '{\"id\":7,\"report_to_parent_id\":5,\"company_profile\":null,\"first_name\":\"Majhar\",\"last_name\":\"Alam\",\"username\":\"20294\",\"email\":\"mc4wq@gx5j.comaasdasd\",\"email_verified_at\":null,\"phone\":\"08499862579\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/profile_photos\\\\mahbub.jpg\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"general\",\"attendance_status\":null,\"joining_date\":\"2021\\/09\\/01\",\"gross_salary\":200,\"user_provident_fund\":10,\"is_active\":null,\"login_location_id\":\"40\",\"check_in_ip\":null,\"check_out_ip\":null,\"check_in_latitude\":\"N\\/A\",\"check_in_longitude\":\"N\\/A\",\"check_out_latitude\":\"N\\/A\",\"check_out_longitude\":\"N\\/A\",\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":null,\"date_of_birth\":\"3542355\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2021-11-29 10:56:16\",\"updated_at\":\"2021-12-26 06:33:53\"}'),
(59, 5, '2021-12-26 06:39:57', 'users', 'edit', '{\"id\":7,\"report_to_parent_id\":5,\"company_profile\":null,\"first_name\":\"Majhar\",\"last_name\":\"Alam\",\"username\":\"20294\",\"email\":\"mc4wq@gx5j.comaasdasd\",\"email_verified_at\":null,\"phone\":\"08499862579\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/profile_photos\\\\mahbub.jpg\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"general\",\"attendance_status\":null,\"joining_date\":\"2021\\/09\\/01\",\"gross_salary\":0,\"user_provident_fund\":10,\"is_active\":null,\"login_location_id\":\"40\",\"check_in_ip\":null,\"check_out_ip\":null,\"check_in_latitude\":\"N\\/A\",\"check_in_longitude\":\"N\\/A\",\"check_out_latitude\":\"N\\/A\",\"check_out_longitude\":\"N\\/A\",\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":null,\"date_of_birth\":\"3542355\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2021-11-29 10:56:16\",\"updated_at\":\"2021-12-26 06:39:12\"}'),
(60, 5, '2021-12-27 03:29:19', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(61, 5, '2021-12-27 04:28:12', 'users', 'edit', '{\"id\":7,\"report_to_parent_id\":5,\"company_profile\":null,\"first_name\":\"Majhar\",\"last_name\":\"Alam\",\"username\":\"20294\",\"email\":\"mc4wq@gx5j.comaasdasd\",\"email_verified_at\":null,\"phone\":\"08499862579\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/profile_photos\\\\mahbub.jpg\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"general\",\"attendance_status\":null,\"joining_date\":\"2021\\/09\\/01\",\"gross_salary\":10,\"user_provident_fund\":10,\"is_active\":null,\"login_location_id\":\"40\",\"check_in_ip\":null,\"check_out_ip\":null,\"check_in_latitude\":\"N\\/A\",\"check_in_longitude\":\"N\\/A\",\"check_out_latitude\":\"N\\/A\",\"check_out_longitude\":\"N\\/A\",\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":null,\"date_of_birth\":\"3542355\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2021-11-29 10:56:16\",\"updated_at\":\"2021-12-26 06:39:57\"}'),
(62, 5, '2021-12-28 03:37:50', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(63, 5, '2021-12-29 03:27:48', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(64, 5, '2021-12-29 09:10:18', 'users', 'edit', '{\"id\":5,\"super_system_admin\":null,\"report_to_parent_id\":null,\"company_profile\":\"Yes\",\"first_name\":\"Prediction Learning Associates\",\"last_name\":\"Ltd\",\"username\":\"PredictionLA\",\"email\":\"info@predictionla.com\",\"email_verified_at\":null,\"phone\":\"+8801713334874\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/logos\\\\logo (1).png\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"\",\"attendance_status\":\"Yes\",\"joining_date\":\"\",\"gross_salary\":100000,\"user_provident_fund\":null,\"is_active\":\"\",\"login_location_id\":\"\",\"check_in_ip\":\"127.0.0.1\",\"check_out_ip\":\"127.0.0.1\",\"check_in_latitude\":\"23.8218016\",\"check_in_longitude\":\"90.4209962\",\"check_out_latitude\":\"23.821801\",\"check_out_longitude\":\"90.4209962\",\"region_id\":0,\"area_id\":null,\"territory_id\":null,\"town_id\":null,\"db_house_id\":null,\"role_id\":1,\"com_pack\":\"Premium\",\"date_of_birth\":\"\",\"gender\":\"0\",\"remember_token\":\"fGOzLyOljwiV0WzSleadStDD1pRxBCyrryXSpqdwOkaqDIx8w1LsFtcdFtVQ\",\"created_at\":\"2021-11-28 09:14:14\",\"updated_at\":\"2021-12-02 11:46:14\"}'),
(65, 1, '2021-12-29 09:10:37', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(66, 5, '2021-12-29 10:24:23', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(67, 5, '2021-12-29 11:01:42', 'users', 'edit', '{\"id\":5,\"super_system_admin\":null,\"report_to_parent_id\":null,\"company_profile\":\"Yes\",\"first_name\":\"Prediction Learning Associates\",\"last_name\":\"Ltd\",\"username\":\"PredictionLA\",\"email\":\"info@predictionla.com\",\"email_verified_at\":null,\"phone\":\"+8801713334874\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/logos\\\\logo (1).png\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"\",\"attendance_status\":\"Yes\",\"joining_date\":\"\",\"gross_salary\":100000,\"user_provident_fund\":null,\"is_active\":\"\",\"login_location_id\":\"\",\"check_in_ip\":\"127.0.0.1\",\"check_out_ip\":\"127.0.0.1\",\"check_in_latitude\":\"23.8218016\",\"check_in_longitude\":\"90.4209962\",\"check_out_latitude\":\"23.821801\",\"check_out_longitude\":\"90.4209962\",\"region_id\":0,\"area_id\":null,\"territory_id\":null,\"town_id\":null,\"db_house_id\":null,\"role_id\":1,\"com_pack\":\"Premium\",\"date_of_birth\":\"\",\"gender\":\"0\",\"remember_token\":\"LGfaRkmN5eY1UDvI408rc7uzJrV2zPdCmaW7Sboxrj6rNSLct1WniY1ye4CB\",\"created_at\":\"2021-11-28 09:14:14\",\"updated_at\":\"2021-12-02 11:46:14\"}'),
(68, 36, '2021-12-29 11:01:46', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(69, 5, '2021-12-29 11:10:43', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(70, 5, '2021-12-29 11:12:41', 'users', 'edit', '{\"id\":5,\"super_system_admin\":null,\"report_to_parent_id\":null,\"company_profile\":\"Yes\",\"first_name\":\"Prediction Learning Associates\",\"last_name\":\"Ltd\",\"username\":\"PredictionLA\",\"email\":\"info@predictionla.com\",\"email_verified_at\":null,\"phone\":\"+8801713334874\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/logos\\\\logo (1).png\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"\",\"attendance_status\":\"Yes\",\"joining_date\":\"\",\"gross_salary\":100000,\"user_provident_fund\":null,\"is_active\":\"\",\"login_location_id\":\"\",\"check_in_ip\":\"127.0.0.1\",\"check_out_ip\":\"127.0.0.1\",\"check_in_latitude\":\"23.8218016\",\"check_in_longitude\":\"90.4209962\",\"check_out_latitude\":\"23.821801\",\"check_out_longitude\":\"90.4209962\",\"region_id\":0,\"area_id\":null,\"territory_id\":null,\"town_id\":null,\"db_house_id\":null,\"role_id\":1,\"com_pack\":\"Premium\",\"date_of_birth\":\"\",\"gender\":\"0\",\"remember_token\":\"mYuJYfdV5obe0ipQy7lZqOQggwgOIviZVjqk7vGW1lTJTxvpAxwpRHgxL3Pm\",\"created_at\":\"2021-11-28 09:14:14\",\"updated_at\":\"2021-12-02 11:46:14\"}'),
(71, 36, '2021-12-29 11:12:46', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(72, 5, '2021-12-29 11:17:04', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(73, 5, '2021-12-29 11:19:20', 'users', 'edit', '{\"id\":5,\"super_system_admin\":null,\"report_to_parent_id\":null,\"company_profile\":\"Yes\",\"first_name\":\"Prediction Learning Associates\",\"last_name\":\"Ltd\",\"username\":\"PredictionLA\",\"email\":\"info@predictionla.com\",\"email_verified_at\":null,\"phone\":\"+8801713334874\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/logos\\\\logo (1).png\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"\",\"attendance_status\":\"Yes\",\"joining_date\":\"\",\"gross_salary\":100000,\"user_provident_fund\":null,\"is_active\":\"\",\"login_location_id\":\"\",\"check_in_ip\":\"127.0.0.1\",\"check_out_ip\":\"127.0.0.1\",\"check_in_latitude\":\"23.8218016\",\"check_in_longitude\":\"90.4209962\",\"check_out_latitude\":\"23.821801\",\"check_out_longitude\":\"90.4209962\",\"region_id\":0,\"area_id\":null,\"territory_id\":null,\"town_id\":null,\"db_house_id\":null,\"role_id\":1,\"com_pack\":\"Premium\",\"date_of_birth\":\"\",\"gender\":\"0\",\"remember_token\":\"sFQdFtMCQV26AXVH60YFjXdkTpDoIXy4uGyhbiN2MafJ4tEqgqzBXeSEjYju\",\"created_at\":\"2021-11-28 09:14:14\",\"updated_at\":\"2021-12-02 11:46:14\"}'),
(74, 36, '2021-12-29 11:19:26', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(75, 36, '2021-12-30 03:30:36', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(76, 1, '2021-12-30 03:35:31', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(77, 5, '2021-12-30 03:35:51', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}');
INSERT INTO `logs` (`id`, `user_id`, `log_date`, `table_name`, `log_type`, `data`) VALUES
(78, 5, '2021-12-30 04:28:50', 'users', 'edit', '{\"id\":37,\"super_system_admin\":null,\"report_to_parent_id\":null,\"company_profile\":null,\"first_name\":\"Jack\",\"last_name\":\"Rozario\",\"username\":\"jackrozario\",\"email\":\"rozario@gmail.com\",\"email_verified_at\":null,\"phone\":\"7649034211433\",\"password\":\"$2y$10$jfVyBmX5bEmQeZ08\\/wFBKuCrlrR3HE32eQ.piELkcy9boaWitK9Om\",\"profile_photo\":\"uploads\\/profile_photos\\/1640838490.png\",\"com_id\":1,\"department_id\":1,\"designation_id\":0,\"office_shift_id\":4,\"attendance_type\":\"general\",\"attendance_status\":\"No\",\"joining_date\":\"2021-12-30\",\"gross_salary\":null,\"user_provident_fund\":null,\"is_active\":null,\"login_location_id\":null,\"check_in_ip\":null,\"check_out_ip\":null,\"check_in_latitude\":\"No\",\"check_in_longitude\":\"No\",\"check_out_latitude\":\"No\",\"check_out_longitude\":\"No\",\"over_time_payable\":\"Yes\",\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":null,\"date_of_birth\":\"2021-12-01\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2021-12-30 04:28:11\",\"updated_at\":\"2021-12-30 04:28:11\"}'),
(79, 5, '2021-12-30 05:13:55', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(80, 5, '2021-12-30 06:00:50', 'users', 'edit', '{\"id\":5,\"super_system_admin\":null,\"report_to_parent_id\":null,\"company_profile\":\"Yes\",\"first_name\":\"Prediction Learning Associates\",\"last_name\":\"Ltd\",\"username\":\"PredictionLA\",\"email\":\"info@predictionla.com\",\"email_verified_at\":null,\"phone\":\"+8801713334874\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/logos\\\\logo (1).png\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"\",\"attendance_status\":\"Yes\",\"joining_date\":\"\",\"gross_salary\":100000,\"user_provident_fund\":null,\"is_active\":\"\",\"login_location_id\":\"\",\"check_in_ip\":\"127.0.0.1\",\"check_out_ip\":\"127.0.0.1\",\"check_in_latitude\":\"23.8218016\",\"check_in_longitude\":\"90.4209962\",\"check_out_latitude\":\"23.821801\",\"check_out_longitude\":\"90.4209962\",\"over_time_payable\":\"No\",\"region_id\":0,\"area_id\":null,\"territory_id\":null,\"town_id\":null,\"db_house_id\":null,\"role_id\":1,\"com_pack\":\"Premium\",\"date_of_birth\":\"\",\"gender\":\"0\",\"remember_token\":\"wpvclTp1lRkWmWBu6eQ4J3JC8iOrlwNc1JlGMI1DIeHk3CkkjjkhzBAWIl8M\",\"created_at\":\"2021-11-28 09:14:14\",\"updated_at\":\"2021-12-02 11:46:14\"}'),
(81, 5, '2021-12-30 06:00:53', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(82, 5, '2021-12-30 08:20:24', 'users', 'edit', '{\"id\":32,\"super_system_admin\":null,\"report_to_parent_id\":null,\"company_profile\":null,\"first_name\":\"c\",\"last_name\":\"c\",\"username\":\"c\",\"email\":\"machbubwebsoft@gmail.com\",\"email_verified_at\":null,\"phone\":\"+8801734281290\",\"password\":\"$2y$10$uJiko.j6COvzFWEkSKWN5ODYSQf6eyPGnE6HHzoZ\\/dsPNnu.yGF.2\",\"profile_photo\":\"uploads\\/profile_photos\\/1638957595.png\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"general\",\"attendance_status\":\"No\",\"joining_date\":\"2021-12-28\",\"gross_salary\":null,\"user_provident_fund\":null,\"is_active\":null,\"login_location_id\":\"40\",\"check_in_ip\":null,\"check_out_ip\":null,\"check_in_latitude\":\"No\",\"check_in_longitude\":\"No\",\"check_out_latitude\":\"No\",\"check_out_longitude\":\"No\",\"over_time_payable\":\"No\",\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":null,\"date_of_birth\":\"2021-12-15\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2021-12-08 09:59:56\",\"updated_at\":\"2021-12-08 09:59:56\"}'),
(83, 5, '2021-12-30 08:22:41', 'users', 'edit', '{\"id\":34,\"super_system_admin\":null,\"report_to_parent_id\":null,\"company_profile\":null,\"first_name\":\"s\",\"last_name\":\"s\",\"username\":\"s\",\"email\":\"sahibakhatun@gmail.com\",\"email_verified_at\":null,\"phone\":\"3333333333\",\"password\":\"$2y$10$LVODoXIZmCdBLXfl2.\\/QDOYvYzmcdUoSartojSb6J6W15SmMkCbAq\",\"profile_photo\":\"uploads\\/profile_photos\\/1640766682.jpg\",\"com_id\":1,\"department_id\":1,\"designation_id\":0,\"office_shift_id\":4,\"attendance_type\":\"general\",\"attendance_status\":\"No\",\"joining_date\":\"2021-12-29\",\"gross_salary\":null,\"user_provident_fund\":null,\"is_active\":null,\"login_location_id\":\"40\",\"check_in_ip\":null,\"check_out_ip\":null,\"check_in_latitude\":\"No\",\"check_in_longitude\":\"No\",\"check_out_latitude\":\"No\",\"check_out_longitude\":\"No\",\"over_time_payable\":\"No\",\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":7,\"com_pack\":null,\"date_of_birth\":\"1994-06-30\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2021-12-29 08:31:22\",\"updated_at\":\"2021-12-29 08:31:22\"}'),
(84, 5, '2021-12-30 08:40:19', 'users', 'edit', '{\"id\":7,\"super_system_admin\":null,\"report_to_parent_id\":5,\"company_profile\":null,\"first_name\":\"Majhar\",\"last_name\":\"Alam\",\"username\":\"20294\",\"email\":\"mc4wq@gx5j.comaasdasd\",\"email_verified_at\":null,\"phone\":\"08499862579\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/profile_photos\\\\mahbub.jpg\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"general\",\"attendance_status\":null,\"joining_date\":\"2021\\/09\\/01\",\"gross_salary\":200000,\"user_provident_fund\":10,\"is_active\":null,\"login_location_id\":\"40\",\"check_in_ip\":null,\"check_out_ip\":null,\"check_in_latitude\":\"N\\/A\",\"check_in_longitude\":\"N\\/A\",\"check_out_latitude\":\"N\\/A\",\"check_out_longitude\":\"N\\/A\",\"over_time_payable\":\"No\",\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":null,\"date_of_birth\":\"3542355\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2021-11-29 10:56:16\",\"updated_at\":\"2021-12-27 04:28:12\"}'),
(85, 5, '2022-01-01 04:42:58', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(86, 5, '2022-01-02 03:27:21', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(87, 5, '2022-01-03 03:25:25', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(88, 5, '2022-01-03 09:29:33', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(89, 5, '2022-01-04 03:45:54', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(90, 5, '2022-01-05 03:27:12', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(91, 5, '2022-01-05 04:21:08', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(92, 5, '2022-01-06 03:38:34', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(93, 5, '2022-01-08 03:41:50', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(94, 5, '2022-01-08 04:04:14', 'users', 'edit', '{\"id\":7,\"super_system_admin\":null,\"report_to_parent_id\":32,\"company_profile\":null,\"first_name\":\"Majhar\",\"last_name\":\"Alam\",\"username\":\"20294\",\"email\":\"mc4wq@gx5j.comaasdasd\",\"email_verified_at\":null,\"phone\":\"08499862579\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/profile_photos\\\\mahbub.jpg\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"general\",\"attendance_status\":null,\"joining_date\":\"2021\\/09\\/01\",\"gross_salary\":200000,\"user_provident_fund\":10,\"is_active\":null,\"login_location_id\":\"40\",\"check_in_ip\":null,\"check_out_ip\":null,\"check_in_latitude\":\"N\\/A\",\"check_in_longitude\":\"N\\/A\",\"check_out_latitude\":\"N\\/A\",\"check_out_longitude\":\"N\\/A\",\"over_time_payable\":\"No\",\"user_over_time_type\":null,\"user_over_time_rate\":0,\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":null,\"date_of_birth\":\"2021-11-23\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2021-11-29 10:56:16\",\"updated_at\":\"2021-12-30 08:40:19\"}'),
(95, 5, '2022-01-10 03:36:37', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(96, 5, '2022-01-10 08:09:08', 'users', 'edit', '{\"id\":5,\"super_system_admin\":null,\"report_to_parent_id\":null,\"company_profile\":\"Yes\",\"first_name\":\"Prediction Learning Associates\",\"last_name\":\"Ltd\",\"username\":\"PredictionLA\",\"email\":\"mahbubwebsoft@gmail.com\",\"email_verified_at\":null,\"phone\":\"+8801713334874\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/logos\\\\logo (1).png\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"\",\"attendance_status\":\"Yes\",\"joining_date\":\"2021-12-01\",\"gross_salary\":100000,\"user_provident_fund\":null,\"is_active\":\"\",\"login_location_id\":\"\",\"check_in_ip\":\"127.0.0.1\",\"check_out_ip\":\"127.0.0.1\",\"check_in_latitude\":\"23.8218016\",\"check_in_longitude\":\"90.4209962\",\"check_out_latitude\":\"23.821801\",\"check_out_longitude\":\"90.4209962\",\"over_time_payable\":\"Yes\",\"user_over_time_type\":\"Automatic\",\"user_over_time_rate\":2,\"region_id\":0,\"area_id\":null,\"territory_id\":null,\"town_id\":null,\"db_house_id\":null,\"role_id\":1,\"com_pack\":\"Premium\",\"date_of_birth\":\"2021-11-23\",\"gender\":\"0\",\"remember_token\":\"or83mL3oNEe2UynSEChmRBxCoG0lSsMaiQJUC9D1S0eJ5t0Nrogpr6GmHtHF\",\"created_at\":\"2021-11-28 09:14:14\",\"updated_at\":\"2021-12-02 11:46:14\"}'),
(97, 5, '2022-01-10 08:09:15', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(98, 5, '2022-01-10 08:09:41', 'users', 'edit', '{\"id\":39,\"super_system_admin\":null,\"report_to_parent_id\":null,\"company_profile\":null,\"first_name\":\"jk\",\"last_name\":\"jk\",\"username\":\"admin\",\"email\":\"jk@dfdfd.com\",\"email_verified_at\":null,\"phone\":\"3454345532423\",\"password\":\"$2y$10$vbacfQ6xBltLlwAm8cmYGOVgr4RNqnsoL.VhlBkvxdxNMCSD2rgKS\",\"profile_photo\":\"uploads\\/profile_photos\\/1641802114.png\",\"com_id\":1,\"department_id\":1,\"designation_id\":0,\"office_shift_id\":4,\"attendance_type\":\"general\",\"attendance_status\":\"No\",\"joining_date\":\"2022-01-10\",\"gross_salary\":null,\"user_provident_fund\":null,\"is_active\":null,\"login_location_id\":null,\"check_in_ip\":null,\"check_out_ip\":null,\"check_in_latitude\":\"No\",\"check_in_longitude\":\"No\",\"check_out_latitude\":\"No\",\"check_out_longitude\":\"No\",\"over_time_payable\":\"Yes\",\"user_over_time_type\":\"Automatic\",\"user_over_time_rate\":2,\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":\"Premium\",\"date_of_birth\":\"2022-01-11\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2022-01-10 08:08:34\",\"updated_at\":\"2022-01-10 08:08:34\"}'),
(99, 5, '2022-01-10 08:10:58', 'users', 'edit', '{\"id\":39,\"super_system_admin\":null,\"report_to_parent_id\":null,\"company_profile\":null,\"first_name\":\"jk\",\"last_name\":\"jk\",\"username\":\"admin\",\"email\":\"jk@dfdfd.com\",\"email_verified_at\":null,\"phone\":\"3454345532423\",\"password\":\"$2y$10$vbacfQ6xBltLlwAm8cmYGOVgr4RNqnsoL.VhlBkvxdxNMCSD2rgKS\",\"profile_photo\":\"uploads\\/profile_photos\\/1641802181.png\",\"com_id\":1,\"department_id\":1,\"designation_id\":0,\"office_shift_id\":4,\"attendance_type\":\"general\",\"attendance_status\":\"No\",\"joining_date\":\"2022-01-10\",\"gross_salary\":null,\"user_provident_fund\":null,\"is_active\":null,\"login_location_id\":null,\"check_in_ip\":null,\"check_out_ip\":null,\"check_in_latitude\":\"No\",\"check_in_longitude\":\"No\",\"check_out_latitude\":\"No\",\"check_out_longitude\":\"No\",\"over_time_payable\":\"Yes\",\"user_over_time_type\":\"Automatic\",\"user_over_time_rate\":2,\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":\"Premium\",\"date_of_birth\":\"2022-01-11\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2022-01-10 08:08:34\",\"updated_at\":\"2022-01-10 08:09:41\"}'),
(100, 5, '2022-01-10 08:51:17', 'users', 'edit', '{\"id\":5,\"super_system_admin\":null,\"report_to_parent_id\":null,\"company_profile\":\"Yes\",\"first_name\":\"Prediction Learning Associates\",\"last_name\":\"Ltd\",\"username\":\"PredictionLA\",\"email\":\"mahbubwebsoft@gmail.com\",\"email_verified_at\":null,\"phone\":\"+8801713334874\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/logos\\\\logo (1).png\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"\",\"attendance_status\":\"Yes\",\"joining_date\":\"2021-12-01\",\"gross_salary\":100000,\"user_provident_fund\":null,\"is_active\":\"\",\"login_location_id\":\"\",\"check_in_ip\":\"127.0.0.1\",\"check_out_ip\":\"127.0.0.1\",\"check_in_latitude\":\"23.8218016\",\"check_in_longitude\":\"90.4209962\",\"check_out_latitude\":\"23.821801\",\"check_out_longitude\":\"90.4209962\",\"over_time_payable\":\"Yes\",\"user_over_time_type\":\"Automatic\",\"user_over_time_rate\":2,\"region_id\":0,\"area_id\":null,\"territory_id\":null,\"town_id\":null,\"db_house_id\":null,\"role_id\":1,\"com_pack\":\"Premium\",\"date_of_birth\":\"2021-11-23\",\"gender\":\"0\",\"remember_token\":\"mxbPjIgTvdPk0FqjBYJ9pxTGaWWrA6K1ISaciEz6IB5s0XeaD24QIt1kGuop\",\"created_at\":\"2021-11-28 09:14:14\",\"updated_at\":\"2021-12-02 11:46:14\"}'),
(101, 1, '2022-01-10 08:51:27', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(102, 5, '2022-01-10 09:27:15', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(103, 5, '2022-01-11 03:27:23', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(104, 5, '2022-01-11 07:41:04', 'users', 'edit', '{\"id\":5,\"super_system_admin\":null,\"report_to_parent_id\":null,\"company_profile\":\"Yes\",\"first_name\":\"Prediction Learning Associates\",\"last_name\":\"Ltd\",\"username\":\"PredictionLA\",\"email\":\"mahbubwebsoft@gmail.com\",\"email_verified_at\":null,\"phone\":\"+8801713334874\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/logos\\\\logo (1).png\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"\",\"attendance_status\":\"Yes\",\"joining_date\":\"2021-08-01\",\"gross_salary\":100000,\"user_provident_fund_member\":null,\"user_provident_fund\":null,\"is_active\":\"\",\"login_location_id\":\"\",\"check_in_ip\":\"127.0.0.1\",\"check_out_ip\":\"127.0.0.1\",\"check_in_latitude\":\"23.8218016\",\"check_in_longitude\":\"90.4209962\",\"check_out_latitude\":\"23.821801\",\"check_out_longitude\":\"90.4209962\",\"over_time_payable\":\"Yes\",\"user_over_time_type\":\"Automatic\",\"user_over_time_rate\":2,\"region_id\":0,\"area_id\":null,\"territory_id\":null,\"town_id\":null,\"db_house_id\":null,\"role_id\":1,\"com_pack\":\"Premium\",\"date_of_birth\":\"2021-11-23\",\"gender\":\"0\",\"remember_token\":\"zjrP01L2n7HUsSajq6DYT4crhs7VLI00xtkP6gE1G71zxSAIT6UcmPTUjLve\",\"created_at\":\"2021-11-28 09:14:14\",\"updated_at\":\"2021-12-02 11:46:14\"}'),
(105, 5, '2022-01-11 08:28:18', 'users', 'edit', '{\"id\":5,\"super_system_admin\":null,\"report_to_parent_id\":null,\"company_profile\":\"Yes\",\"first_name\":\"Prediction Learning Associates\",\"last_name\":\"Ltd\",\"username\":\"PredictionLA\",\"email\":\"mahbubwebsoft@gmail.com\",\"email_verified_at\":null,\"phone\":\"+8801713334874\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/logos\\\\logo (1).png\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"\",\"attendance_status\":\"Yes\",\"joining_date\":\"2021-08-01\",\"gross_salary\":100000,\"user_provident_fund_member\":\"Yes\",\"user_provident_fund\":null,\"is_active\":\"\",\"login_location_id\":\"\",\"check_in_ip\":\"127.0.0.1\",\"check_out_ip\":\"127.0.0.1\",\"check_in_latitude\":\"23.8218016\",\"check_in_longitude\":\"90.4209962\",\"check_out_latitude\":\"23.821801\",\"check_out_longitude\":\"90.4209962\",\"over_time_payable\":\"Yes\",\"user_over_time_type\":\"Automatic\",\"user_over_time_rate\":2,\"region_id\":0,\"area_id\":null,\"territory_id\":null,\"town_id\":null,\"db_house_id\":null,\"role_id\":1,\"com_pack\":\"Premium\",\"date_of_birth\":\"2021-11-23\",\"gender\":\"0\",\"remember_token\":\"zjrP01L2n7HUsSajq6DYT4crhs7VLI00xtkP6gE1G71zxSAIT6UcmPTUjLve\",\"created_at\":\"2021-11-28 09:14:14\",\"updated_at\":\"2022-01-11 07:41:04\"}'),
(106, 5, '2022-01-11 08:28:21', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(107, 5, '2022-01-11 08:40:31', 'users', 'edit', '{\"id\":5,\"super_system_admin\":null,\"report_to_parent_id\":null,\"company_profile\":\"Yes\",\"first_name\":\"Prediction Learning Associates\",\"last_name\":\"Ltd\",\"username\":\"PredictionLA\",\"email\":\"mahbubwebsoft@gmail.com\",\"email_verified_at\":null,\"phone\":\"+8801713334874\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/logos\\\\logo (1).png\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"\",\"attendance_status\":\"Yes\",\"joining_date\":\"2021-08-01\",\"gross_salary\":100000,\"user_provident_fund_member\":\"Yes\",\"user_provident_fund\":null,\"is_active\":\"\",\"login_location_id\":\"\",\"check_in_ip\":\"127.0.0.1\",\"check_out_ip\":\"127.0.0.1\",\"check_in_latitude\":\"23.8218016\",\"check_in_longitude\":\"90.4209962\",\"check_out_latitude\":\"23.821801\",\"check_out_longitude\":\"90.4209962\",\"over_time_payable\":\"Yes\",\"user_over_time_type\":\"Automatic\",\"user_over_time_rate\":2,\"region_id\":0,\"area_id\":null,\"territory_id\":null,\"town_id\":null,\"db_house_id\":null,\"role_id\":1,\"com_pack\":\"Premium\",\"date_of_birth\":\"2021-11-23\",\"gender\":\"0\",\"remember_token\":\"zo33DsGB5aAwZqgwwLSbozp6T1FwZz26PVHDxMqz86pZoE6F5fLEurvAPkrh\",\"created_at\":\"2021-11-28 09:14:14\",\"updated_at\":\"2022-01-11 07:41:04\"}'),
(108, 8, '2022-01-11 08:41:38', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(109, 8, '2022-01-11 08:42:05', 'users', 'edit', '{\"id\":8,\"super_system_admin\":null,\"report_to_parent_id\":6,\"company_profile\":null,\"first_name\":\"Jowel\",\"last_name\":\"Alam\",\"username\":\"mahfujur\",\"email\":\"seriouslyserious247@gmail.com\",\"email_verified_at\":null,\"phone\":\"0849986257944444\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/profile_photos\\\\mahbub.jpg\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"general\",\"attendance_status\":null,\"joining_date\":\"2021-09-22\",\"gross_salary\":null,\"user_provident_fund_member\":\"\",\"user_provident_fund\":null,\"is_active\":null,\"login_location_id\":\"42\",\"check_in_ip\":null,\"check_out_ip\":null,\"check_in_latitude\":\"N\\/A\",\"check_in_longitude\":\"N\\/A\",\"check_out_latitude\":\"N\\/A\",\"check_out_longitude\":\"N\\/A\",\"over_time_payable\":\"No\",\"user_over_time_type\":null,\"user_over_time_rate\":0,\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":null,\"date_of_birth\":\"2021-11-23\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2021-11-29 12:01:06\",\"updated_at\":\"2021-11-29 12:01:06\"}'),
(110, 5, '2022-01-11 08:42:54', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(111, 5, '2022-01-12 03:38:54', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(112, 1, '2022-01-12 11:56:09', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko\\/20100101 Firefox\\/72.0\"}'),
(113, 5, '2022-01-12 12:30:27', 'users', 'edit', '{\"id\":6,\"super_system_admin\":null,\"report_to_parent_id\":5,\"company_profile\":null,\"first_name\":\"Tarek\",\"last_name\":\"Alam\",\"username\":\"\",\"email\":\"rakibulhasan.rh890@gmail.com\",\"email_verified_at\":null,\"phone\":\"453454345345345345\",\"password\":\"$2y$10$jtki9mhU26EHucxFRuXUHey4P5.LV\\/1JFjuxKho\\/tMm\\/q7wpllTp2\",\"profile_photo\":\"uploads\\/profile_photos\\\\mahbub.jpg\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":0,\"attendance_type\":\"\",\"attendance_status\":null,\"joining_date\":\"2021-08-01\",\"gross_salary\":100,\"user_provident_fund_member\":null,\"user_provident_fund\":5,\"is_active\":\"\",\"login_location_id\":\"\",\"check_in_ip\":\"No\",\"check_out_ip\":\"No\",\"check_in_latitude\":\"No\",\"check_in_longitude\":\"No\",\"check_out_latitude\":\"No\",\"check_out_longitude\":\"No\",\"over_time_payable\":\"No\",\"user_over_time_type\":null,\"user_over_time_rate\":0,\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":\"Premium\",\"date_of_birth\":\"2021-11-23\",\"gender\":\"0\",\"remember_token\":null,\"created_at\":\"2021-11-28 09:20:42\",\"updated_at\":\"2021-11-28 09:20:42\"}'),
(114, 49, '2022-01-12 12:34:02', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko\\/20100101 Firefox\\/72.0\"}'),
(115, 1, '2022-01-12 12:34:25', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko\\/20100101 Firefox\\/72.0\"}'),
(116, 5, '2022-01-13 03:53:52', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}'),
(117, 5, '2022-01-13 07:46:08', 'users', 'edit', '{\"id\":6,\"super_system_admin\":null,\"report_to_parent_id\":8,\"company_profile\":null,\"first_name\":\"Tarek\",\"last_name\":\"Alam\",\"username\":\"tarekalam\",\"email\":\"rakibulhasan.rh890@gmail.com\",\"email_verified_at\":null,\"phone\":\"453454345345345345\",\"password\":\"$2y$10$jtki9mhU26EHucxFRuXUHey4P5.LV\\/1JFjuxKho\\/tMm\\/q7wpllTp2\",\"profile_photo\":\"uploads\\/profile_photos\\\\mahbub.jpg\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":0,\"attendance_type\":\"\",\"attendance_status\":null,\"joining_date\":\"2021-08-01\",\"gross_salary\":100,\"user_provident_fund_member\":null,\"user_provident_fund\":5,\"is_active\":\"\",\"login_location_id\":\"\",\"check_in_ip\":\"No\",\"check_out_ip\":\"No\",\"check_in_latitude\":\"No\",\"check_in_longitude\":\"No\",\"check_out_latitude\":\"No\",\"check_out_longitude\":\"No\",\"over_time_payable\":\"Yes\",\"user_over_time_type\":null,\"user_over_time_rate\":0,\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":\"Premium\",\"date_of_birth\":\"2021-11-23\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2021-11-28 09:20:42\",\"updated_at\":\"2022-01-12 12:30:27\"}'),
(118, 5, '2022-01-13 07:51:52', 'users', 'edit', '{\"id\":6,\"super_system_admin\":null,\"report_to_parent_id\":8,\"company_profile\":null,\"first_name\":\"Tarek\",\"last_name\":\"Alam\",\"username\":\"tarekalam\",\"email\":\"rakibulhasan.rh890@gmail.com\",\"email_verified_at\":null,\"phone\":\"453454345345345345\",\"password\":\"$2y$10$jtki9mhU26EHucxFRuXUHey4P5.LV\\/1JFjuxKho\\/tMm\\/q7wpllTp2\",\"profile_photo\":\"uploads\\/profile_photos\\\\mahbub.jpg\",\"com_id\":1,\"department_id\":1,\"designation_id\":0,\"office_shift_id\":4,\"attendance_type\":\"ip_based\",\"attendance_status\":null,\"joining_date\":\"2021-08-02\",\"gross_salary\":100,\"user_provident_fund_member\":null,\"user_provident_fund\":5,\"is_active\":\"1\",\"login_location_id\":\"\",\"check_in_ip\":\"No\",\"check_out_ip\":\"No\",\"check_in_latitude\":\"No\",\"check_in_longitude\":\"No\",\"check_out_latitude\":\"No\",\"check_out_longitude\":\"No\",\"over_time_payable\":\"Yes\",\"user_over_time_type\":\"Manual\",\"user_over_time_rate\":2,\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":\"Premium\",\"date_of_birth\":\"2021-11-23\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2021-11-28 09:20:42\",\"updated_at\":\"2022-01-13 07:46:08\"}'),
(119, 5, '2022-01-13 07:57:22', 'users', 'edit', '{\"id\":6,\"super_system_admin\":null,\"report_to_parent_id\":8,\"company_profile\":null,\"first_name\":\"Tarek\",\"last_name\":\"Alam\",\"username\":\"tarekalam\",\"email\":\"rakibulhasan.rh890@gmail.com\",\"email_verified_at\":null,\"phone\":\"453454345345345345\",\"password\":\"$2y$10$jtki9mhU26EHucxFRuXUHey4P5.LV\\/1JFjuxKho\\/tMm\\/q7wpllTp2\",\"profile_photo\":\"uploads\\/profile_photos\\\\mahbub.jpg\",\"com_id\":1,\"department_id\":1,\"designation_id\":0,\"office_shift_id\":4,\"attendance_type\":\"general\",\"attendance_status\":null,\"joining_date\":\"2021-08-02\",\"gross_salary\":100,\"user_provident_fund_member\":null,\"user_provident_fund\":5,\"is_active\":\"1\",\"login_location_id\":\"\",\"check_in_ip\":\"No\",\"check_out_ip\":\"No\",\"check_in_latitude\":\"No\",\"check_in_longitude\":\"No\",\"check_out_latitude\":\"No\",\"check_out_longitude\":\"No\",\"over_time_payable\":\"Yes\",\"user_over_time_type\":\"Automatic\",\"user_over_time_rate\":2,\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":\"Premium\",\"date_of_birth\":\"2021-11-23\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2021-11-28 09:20:42\",\"updated_at\":\"2022-01-13 07:51:52\"}'),
(120, 5, '2022-01-15 03:35:54', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/97.0.4692.71 Safari\\/537.36\"}'),
(121, 5, '2022-01-15 08:21:05', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/97.0.4692.71 Safari\\/537.36\"}'),
(122, 5, '2022-01-16 03:51:18', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/97.0.4692.71 Safari\\/537.36\"}'),
(123, 5, '2022-01-16 06:05:55', 'users', 'edit', '{\"id\":5,\"super_system_admin\":null,\"report_to_parent_id\":null,\"company_profile\":\"Yes\",\"first_name\":\"Prediction Learning Associates\",\"last_name\":\"Ltd\",\"username\":\"PredictionLA\",\"email\":\"mahbubwebsoft@gmail.com\",\"email_verified_at\":null,\"phone\":\"+8801713334874\",\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/logos\\\\logo (1).png\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"\",\"attendance_status\":\"Yes\",\"joining_date\":\"2021-08-01\",\"gross_salary\":100000,\"user_provident_fund_member\":\"Yes\",\"user_provident_fund\":10,\"is_active\":\"\",\"login_location_id\":\"\",\"check_in_ip\":\"127.0.0.1\",\"check_out_ip\":\"127.0.0.1\",\"check_in_latitude\":\"23.8218016\",\"check_in_longitude\":\"90.4209962\",\"check_out_latitude\":\"23.821801\",\"check_out_longitude\":\"90.4209962\",\"over_time_payable\":\"Yes\",\"user_over_time_type\":\"Automatic\",\"user_over_time_rate\":2,\"region_id\":0,\"area_id\":null,\"territory_id\":null,\"town_id\":null,\"db_house_id\":null,\"role_id\":1,\"com_pack\":\"Premium\",\"date_of_birth\":\"2021-11-23\",\"gender\":\"0\",\"remember_token\":\"l5kDVTC8ONJgz64zAp12EE2N5fwl0nROwUT9Y023OzfK80Hxqmt7ZZZnwuE1\",\"created_at\":\"2021-11-28 09:14:14\",\"updated_at\":\"2022-01-11 07:41:04\"}'),
(124, 5, '2022-01-16 10:06:51', 'users', 'edit', '{\"id\":5,\"super_system_admin\":null,\"report_to_parent_id\":null,\"company_profile\":\"Yes\",\"first_name\":\"Prediction Learning Associates Ltd.\",\"last_name\":\"Ltd\",\"username\":\"PredictionLA\",\"email\":\"mahbubwebsoft@gmail.com\",\"email_verified_at\":null,\"phone\":\"+8801713334874\",\"address\":null,\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/logos\\\\logo (1).png\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"\",\"attendance_status\":\"Yes\",\"joining_date\":\"2021-08-01\",\"gross_salary\":100000,\"user_provident_fund_member\":\"Yes\",\"user_provident_fund\":10,\"is_active\":\"\",\"login_location_id\":\"\",\"check_in_ip\":\"127.0.0.1\",\"check_out_ip\":\"127.0.0.1\",\"check_in_latitude\":\"23.8218016\",\"check_in_longitude\":\"90.4209962\",\"check_out_latitude\":\"23.821801\",\"check_out_longitude\":\"90.4209962\",\"over_time_payable\":\"Yes\",\"user_over_time_type\":\"Automatic\",\"user_over_time_rate\":2,\"region_id\":0,\"area_id\":null,\"territory_id\":null,\"town_id\":null,\"db_house_id\":null,\"role_id\":1,\"com_pack\":\"Premium\",\"date_of_birth\":\"2021-11-23\",\"gender\":\"0\",\"remember_token\":\"l5kDVTC8ONJgz64zAp12EE2N5fwl0nROwUT9Y023OzfK80Hxqmt7ZZZnwuE1\",\"created_at\":\"2021-11-28 09:14:14\",\"updated_at\":\"2022-01-16 06:05:55\"}'),
(125, 5, '2022-01-16 10:08:05', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/97.0.4692.71 Safari\\/537.36\"}'),
(126, 5, '2022-01-16 10:08:29', 'users', 'edit', '{\"id\":5,\"super_system_admin\":null,\"report_to_parent_id\":null,\"company_profile\":\"Yes\",\"first_name\":\"Prediction Learning Associates Ltd.\",\"last_name\":\"Ltd\",\"username\":\"PredictionLA\",\"email\":\"mahbubwebsoft@gmail.com\",\"email_verified_at\":null,\"phone\":\"+8801713334874\",\"address\":null,\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/logos\\\\logo (1).png\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"\",\"attendance_status\":\"Yes\",\"joining_date\":\"2021-08-01\",\"gross_salary\":100000,\"user_provident_fund_member\":\"Yes\",\"user_provident_fund\":10,\"is_active\":\"\",\"login_location_id\":\"\",\"check_in_ip\":\"127.0.0.1\",\"check_out_ip\":\"127.0.0.1\",\"check_in_latitude\":\"23.8218016\",\"check_in_longitude\":\"90.4209962\",\"check_out_latitude\":\"23.821801\",\"check_out_longitude\":\"90.4209962\",\"over_time_payable\":\"Yes\",\"user_over_time_type\":\"Automatic\",\"user_over_time_rate\":2,\"region_id\":0,\"area_id\":null,\"territory_id\":null,\"town_id\":null,\"db_house_id\":null,\"role_id\":1,\"com_pack\":\"Premium\",\"date_of_birth\":\"2021-11-23\",\"gender\":\"0\",\"remember_token\":\"BRDM9Bs8T6x0k0rCfQsIhKe17x5eGeV9eIQnJB6ocy0SRFz1rPkFdBLKCDRo\",\"created_at\":\"2021-11-28 09:14:14\",\"updated_at\":\"2022-01-16 06:05:55\"}'),
(127, 8, '2022-01-16 10:08:35', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/97.0.4692.71 Safari\\/537.36\"}'),
(128, 8, '2022-01-16 10:09:13', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/97.0.4692.71 Safari\\/537.36\"}'),
(129, 8, '2022-01-16 10:21:06', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/97.0.4692.71 Safari\\/537.36\"}'),
(130, 5, '2022-01-16 10:21:33', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/97.0.4692.71 Safari\\/537.36\"}'),
(131, 5, '2022-01-17 03:40:38', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/97.0.4692.71 Safari\\/537.36\"}'),
(132, 5, '2022-01-17 09:40:58', 'users', 'edit', '{\"id\":6,\"super_system_admin\":null,\"report_to_parent_id\":8,\"company_profile\":null,\"first_name\":\"Tarek\",\"last_name\":\"Alam\",\"username\":\"tarekalam\",\"email\":\"rakibulhasan.rh890@gmail.com\",\"email_verified_at\":null,\"phone\":\"453454345345345345\",\"address\":null,\"password\":\"$2y$10$jtki9mhU26EHucxFRuXUHey4P5.LV\\/1JFjuxKho\\/tMm\\/q7wpllTp2\",\"profile_photo\":\"uploads\\/profile_photos\\\\mahbub.jpg\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":4,\"attendance_type\":\"general\",\"attendance_status\":null,\"joining_date\":\"2021-08-02\",\"gross_salary\":100,\"user_provident_fund_member\":null,\"user_provident_fund\":5,\"is_active\":\"1\",\"login_location_id\":\"\",\"check_in_ip\":\"No\",\"check_out_ip\":\"No\",\"check_in_latitude\":\"No\",\"check_in_longitude\":\"No\",\"check_out_latitude\":\"No\",\"check_out_longitude\":\"No\",\"over_time_payable\":\"Yes\",\"user_over_time_type\":\"Automatic\",\"user_over_time_rate\":2,\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":\"Premium\",\"date_of_birth\":\"2021-11-23\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2021-11-28 09:20:42\",\"updated_at\":\"2022-01-13 07:57:22\"}'),
(133, 5, '2022-01-17 09:45:12', 'users', 'edit', '{\"id\":6,\"super_system_admin\":null,\"report_to_parent_id\":8,\"company_profile\":null,\"first_name\":\"Tarek\",\"last_name\":\"Alam\",\"username\":\"tarekalam\",\"email\":\"rakibulhasan.rh890@gmail.com\",\"email_verified_at\":null,\"phone\":\"453454345345345345\",\"address\":null,\"password\":\"$2y$10$jtki9mhU26EHucxFRuXUHey4P5.LV\\/1JFjuxKho\\/tMm\\/q7wpllTp2\",\"profile_photo\":\"uploads\\/profile_photos\\\\mahbub.jpg\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":4,\"attendance_type\":\"general\",\"attendance_status\":null,\"joining_date\":\"2021-08-02\",\"gross_salary\":4,\"user_provident_fund_member\":null,\"user_provident_fund\":5,\"is_active\":\"1\",\"login_location_id\":\"\",\"check_in_ip\":\"No\",\"check_out_ip\":\"No\",\"check_in_latitude\":\"No\",\"check_in_longitude\":\"No\",\"check_out_latitude\":\"No\",\"check_out_longitude\":\"No\",\"over_time_payable\":\"Yes\",\"user_over_time_type\":\"Automatic\",\"user_over_time_rate\":2,\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":\"Premium\",\"date_of_birth\":\"2021-11-23\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2021-11-28 09:20:42\",\"updated_at\":\"2022-01-17 09:40:58\"}'),
(134, 5, '2022-01-17 10:28:24', 'users', 'edit', '{\"id\":6,\"super_system_admin\":null,\"report_to_parent_id\":8,\"company_profile\":null,\"first_name\":\"Tarek\",\"last_name\":\"Alam\",\"username\":\"tarekalam\",\"email\":\"rakibulhasan.rh890@gmail.com\",\"email_verified_at\":null,\"phone\":\"453454345345345345\",\"address\":null,\"password\":\"$2y$10$jtki9mhU26EHucxFRuXUHey4P5.LV\\/1JFjuxKho\\/tMm\\/q7wpllTp2\",\"profile_photo\":\"uploads\\/profile_photos\\\\mahbub.jpg\",\"com_id\":1,\"department_id\":3,\"designation_id\":4,\"office_shift_id\":4,\"attendance_type\":\"general\",\"attendance_status\":null,\"joining_date\":\"2021-08-02\",\"gross_salary\":300000,\"user_provident_fund_member\":null,\"user_provident_fund\":5,\"is_active\":\"1\",\"login_location_id\":\"\",\"check_in_ip\":\"No\",\"check_out_ip\":\"No\",\"check_in_latitude\":\"No\",\"check_in_longitude\":\"No\",\"check_out_latitude\":\"No\",\"check_out_longitude\":\"No\",\"over_time_payable\":\"Yes\",\"user_over_time_type\":\"Automatic\",\"user_over_time_rate\":2,\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":\"Premium\",\"date_of_birth\":\"2021-11-23\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2021-11-28 09:20:42\",\"updated_at\":\"2022-01-17 09:45:12\"}'),
(135, 5, '2022-01-17 10:41:03', 'users', 'edit', '{\"id\":5,\"super_system_admin\":null,\"report_to_parent_id\":null,\"company_profile\":\"Yes\",\"first_name\":\"Prediction Learning Associates Ltd.\",\"last_name\":\"Ltd\",\"username\":\"PredictionLA\",\"email\":\"mahbubwebsoft@gmail.com\",\"email_verified_at\":null,\"phone\":\"+8801713334874\",\"address\":null,\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/logos\\\\logo (1).png\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"\",\"attendance_status\":\"Yes\",\"joining_date\":\"2021-08-01\",\"gross_salary\":100000,\"user_provident_fund_member\":\"Yes\",\"user_provident_fund\":10,\"is_active\":\"\",\"login_location_id\":\"\",\"check_in_ip\":\"127.0.0.1\",\"check_out_ip\":\"127.0.0.1\",\"check_in_latitude\":\"23.8218016\",\"check_in_longitude\":\"90.4209962\",\"check_out_latitude\":\"23.821801\",\"check_out_longitude\":\"90.4209962\",\"over_time_payable\":\"Yes\",\"user_over_time_type\":\"Automatic\",\"user_over_time_rate\":2,\"region_id\":0,\"area_id\":null,\"territory_id\":null,\"town_id\":null,\"db_house_id\":null,\"role_id\":1,\"com_pack\":\"Premium\",\"date_of_birth\":\"2021-11-23\",\"gender\":\"0\",\"remember_token\":\"iSHDbI4yHegYXAjfLqSUmKLFp12OlV3FGjteWksk5LzjdpvkrncWaenvBiI3\",\"created_at\":\"2021-11-28 09:14:14\",\"updated_at\":\"2022-01-16 06:05:55\"}'),
(136, 5, '2022-01-17 10:42:13', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/97.0.4692.71 Safari\\/537.36\"}'),
(137, 5, '2022-01-17 11:07:12', 'users', 'edit', '{\"id\":6,\"super_system_admin\":null,\"report_to_parent_id\":8,\"company_profile\":null,\"first_name\":\"Tarek\",\"last_name\":\"Alam\",\"username\":\"tarekalam\",\"email\":\"rakibulhasan.rh890@gmail.com\",\"email_verified_at\":null,\"phone\":\"453454345345345345\",\"address\":null,\"password\":\"$2y$10$jtki9mhU26EHucxFRuXUHey4P5.LV\\/1JFjuxKho\\/tMm\\/q7wpllTp2\",\"profile_photo\":\"uploads\\/profile_photos\\\\mahbub.jpg\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":4,\"attendance_type\":\"general\",\"attendance_status\":null,\"joining_date\":\"2021-08-02\",\"gross_salary\":400000,\"user_provident_fund_member\":null,\"user_provident_fund\":5,\"is_active\":\"1\",\"login_location_id\":\"\",\"check_in_ip\":\"No\",\"check_out_ip\":\"No\",\"check_in_latitude\":\"No\",\"check_in_longitude\":\"No\",\"check_out_latitude\":\"No\",\"check_out_longitude\":\"No\",\"over_time_payable\":\"Yes\",\"user_over_time_type\":\"Automatic\",\"user_over_time_rate\":2,\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":\"Premium\",\"date_of_birth\":\"2021-11-23\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2021-11-28 09:20:42\",\"updated_at\":\"2022-01-17 10:28:24\"}'),
(138, 5, '2022-01-17 11:09:27', 'users', 'edit', '{\"id\":6,\"super_system_admin\":null,\"report_to_parent_id\":8,\"company_profile\":null,\"first_name\":\"Tarek\",\"last_name\":\"Alam\",\"username\":\"tarekalam\",\"email\":\"rakibulhasan.rh890@gmail.com\",\"email_verified_at\":null,\"phone\":\"453454345345345345\",\"address\":null,\"password\":\"$2y$10$jtki9mhU26EHucxFRuXUHey4P5.LV\\/1JFjuxKho\\/tMm\\/q7wpllTp2\",\"profile_photo\":\"uploads\\/profile_photos\\\\mahbub.jpg\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":4,\"attendance_type\":\"general\",\"attendance_status\":null,\"joining_date\":\"2021-08-02\",\"gross_salary\":500000,\"user_provident_fund_member\":null,\"user_provident_fund\":5,\"is_active\":\"1\",\"login_location_id\":\"\",\"check_in_ip\":\"No\",\"check_out_ip\":\"No\",\"check_in_latitude\":\"No\",\"check_in_longitude\":\"No\",\"check_out_latitude\":\"No\",\"check_out_longitude\":\"No\",\"over_time_payable\":\"Yes\",\"user_over_time_type\":\"Automatic\",\"user_over_time_rate\":2,\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":\"Premium\",\"date_of_birth\":\"2021-11-23\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2021-11-28 09:20:42\",\"updated_at\":\"2022-01-17 11:07:12\"}'),
(139, 5, '2022-01-18 03:18:34', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/97.0.4692.71 Safari\\/537.36\"}'),
(140, 5, '2022-01-18 07:13:08', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/97.0.4692.71 Safari\\/537.36\"}'),
(141, 5, '2022-01-19 03:24:27', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/97.0.4692.71 Safari\\/537.36\"}'),
(142, 5, '2022-01-19 12:16:30', 'users', 'edit', '{\"id\":6,\"super_system_admin\":null,\"report_to_parent_id\":8,\"company_profile\":null,\"first_name\":\"Tarek\",\"last_name\":\"Alam\",\"username\":\"tarekalam\",\"email\":\"rakibulhasan.rh890@gmail.com\",\"email_verified_at\":null,\"phone\":\"453454345345345345\",\"address\":null,\"password\":\"$2y$10$jtki9mhU26EHucxFRuXUHey4P5.LV\\/1JFjuxKho\\/tMm\\/q7wpllTp2\",\"profile_photo\":\"uploads\\/profile_photos\\\\mahbub.jpg\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":4,\"attendance_type\":\"general\",\"attendance_status\":null,\"joining_date\":\"2021-08-02\",\"gross_salary\":5000000,\"user_provident_fund_member\":null,\"user_provident_fund\":5,\"is_active\":\"1\",\"login_location_id\":\"\",\"check_in_ip\":\"No\",\"check_out_ip\":\"No\",\"check_in_latitude\":\"No\",\"check_in_longitude\":\"No\",\"check_out_latitude\":\"No\",\"check_out_longitude\":\"No\",\"over_time_payable\":\"Yes\",\"user_over_time_type\":\"Automatic\",\"user_over_time_rate\":2,\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":\"Premium\",\"date_of_birth\":\"2021-11-23\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2021-11-28 09:20:42\",\"updated_at\":\"2022-01-17 11:09:27\"}'),
(143, 5, '2022-01-19 12:54:48', 'users', 'edit', '{\"id\":5,\"super_system_admin\":null,\"report_to_parent_id\":null,\"company_profile\":\"Yes\",\"first_name\":\"Prediction Learning Associates Ltd.\",\"last_name\":\"Ltd\",\"username\":\"PredictionLA\",\"email\":\"mahbubwebsoft@gmail.com\",\"email_verified_at\":null,\"phone\":\"+8801713334874\",\"address\":null,\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/logos\\\\logo (1).png\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"\",\"attendance_status\":\"Yes\",\"joining_date\":\"2021-08-01\",\"gross_salary\":100000,\"user_provident_fund_member\":\"Yes\",\"user_provident_fund\":10,\"is_active\":\"\",\"login_location_id\":\"\",\"check_in_ip\":\"127.0.0.1\",\"check_out_ip\":\"127.0.0.1\",\"check_in_latitude\":\"23.8218016\",\"check_in_longitude\":\"90.4209962\",\"check_out_latitude\":\"23.821801\",\"check_out_longitude\":\"90.4209962\",\"over_time_payable\":\"Yes\",\"user_over_time_type\":\"Automatic\",\"user_over_time_rate\":2,\"region_id\":0,\"area_id\":null,\"territory_id\":null,\"town_id\":null,\"db_house_id\":null,\"role_id\":1,\"com_pack\":\"Premium\",\"date_of_birth\":\"2021-11-23\",\"gender\":\"0\",\"remember_token\":\"UGyWCN06o2zGUQkTUWymNBnR9NOYvHg0Ud9AddGqi1D9NC6YWyXD5iMVaBeD\",\"created_at\":\"2021-11-28 09:14:14\",\"updated_at\":\"2022-01-16 06:05:55\"}'),
(144, 5, '2022-01-20 03:18:04', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/97.0.4692.71 Safari\\/537.36\"}'),
(145, 5, '2022-01-20 03:19:55', 'users', 'delete', '{\"id\":30,\"super_system_admin\":null,\"report_to_parent_id\":7,\"company_profile\":null,\"first_name\":\"Tarek\",\"last_name\":\"Al\",\"username\":\"mah\",\"email\":\"mcwewewsseessswe4wq@gx5j.com\",\"email_verified_at\":null,\"phone\":\"0849986257954444444\",\"address\":null,\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/profile_photos\\\\avtr).jpg\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"general\",\"attendance_status\":null,\"joining_date\":\"2021-12-01\",\"gross_salary\":null,\"user_provident_fund_member\":\"\",\"user_provident_fund\":null,\"is_active\":\"1\",\"login_location_id\":\"42\",\"check_in_ip\":null,\"check_out_ip\":null,\"check_in_latitude\":\"N\\/A\",\"check_in_longitude\":\"N\\/A\",\"check_out_latitude\":\"N\\/A\",\"check_out_longitude\":\"N\\/A\",\"over_time_payable\":\"No\",\"user_over_time_type\":null,\"user_over_time_rate\":0,\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":null,\"date_of_birth\":\"2021-12-01\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2021-11-30 07:10:01\",\"updated_at\":\"2021-11-30 08:58:39\"}'),
(146, 5, '2022-01-20 07:51:15', 'users', 'edit', '{\"id\":28,\"super_system_admin\":null,\"report_to_parent_id\":26,\"company_profile\":null,\"first_name\":\"REZA\",\"last_name\":\"Al\",\"username\":\"mah\",\"email\":\"mcweweweewe4wq@gx5j.com\",\"email_verified_at\":null,\"phone\":\"0849986257954444444\",\"address\":null,\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/profile_photos\\\\avtr).jpg\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"general\",\"attendance_status\":null,\"joining_date\":\"2021-12-01\",\"gross_salary\":null,\"user_provident_fund_member\":\"\",\"user_provident_fund\":null,\"is_active\":\"1\",\"login_location_id\":\"42\",\"check_in_ip\":null,\"check_out_ip\":null,\"check_in_latitude\":\"N\\/A\",\"check_in_longitude\":\"N\\/A\",\"check_out_latitude\":\"N\\/A\",\"check_out_longitude\":\"N\\/A\",\"over_time_payable\":\"No\",\"user_over_time_type\":null,\"user_over_time_rate\":0,\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":null,\"date_of_birth\":\"2021-12-01\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2021-11-30 07:10:01\",\"updated_at\":\"2021-11-30 08:58:39\"}');
INSERT INTO `logs` (`id`, `user_id`, `log_date`, `table_name`, `log_type`, `data`) VALUES
(147, 5, '2022-01-20 09:00:00', 'users', 'edit', '{\"id\":33,\"super_system_admin\":null,\"report_to_parent_id\":null,\"company_profile\":null,\"first_name\":\"d\",\"last_name\":\"d\",\"username\":\"d\",\"email\":\"mahbdubwebsoft@gmail.com\",\"email_verified_at\":null,\"phone\":\"+8801734281290\",\"address\":null,\"password\":\"$2y$10$I9jtpiaFVOeemknaX2OLsuRiSg\\/f24e2ClxeWak1NC7saBsiFVGwu\",\"profile_photo\":\"uploads\\/profile_photos\\/1638957885.jpg\",\"com_id\":1,\"department_id\":3,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"general\",\"attendance_status\":\"No\",\"joining_date\":\"2021-12-27\",\"gross_salary\":null,\"user_provident_fund_member\":\"\",\"user_provident_fund\":null,\"is_active\":null,\"login_location_id\":\"40\",\"check_in_ip\":null,\"check_out_ip\":null,\"check_in_latitude\":\"No\",\"check_in_longitude\":\"No\",\"check_out_latitude\":\"No\",\"check_out_longitude\":\"No\",\"over_time_payable\":\"No\",\"user_over_time_type\":null,\"user_over_time_rate\":0,\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":null,\"date_of_birth\":\"2021-12-14\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2021-12-08 10:04:45\",\"updated_at\":\"2021-12-08 10:04:45\"}'),
(148, 5, '2022-01-20 09:01:30', 'users', 'edit', '{\"id\":38,\"super_system_admin\":null,\"report_to_parent_id\":null,\"company_profile\":null,\"first_name\":\"s\",\"last_name\":\"s\",\"username\":\"wqwee\",\"email\":\"sahibakshatun@gmail.com\",\"email_verified_at\":null,\"phone\":\"345455322\",\"address\":null,\"password\":\"$2y$10$rlzN.rSh2MTiomqeI2s5SOT9aAdQIdIuRZknvLEEffCTGBGwDetYe\",\"profile_photo\":\"uploads\\/profile_photos\\/1641113116.png\",\"com_id\":1,\"department_id\":3,\"designation_id\":0,\"office_shift_id\":4,\"attendance_type\":\"general\",\"attendance_status\":\"No\",\"joining_date\":\"2022-01-02\",\"gross_salary\":null,\"user_provident_fund_member\":\"\",\"user_provident_fund\":null,\"is_active\":null,\"login_location_id\":null,\"check_in_ip\":null,\"check_out_ip\":null,\"check_in_latitude\":\"No\",\"check_in_longitude\":\"No\",\"check_out_latitude\":\"No\",\"check_out_longitude\":\"No\",\"over_time_payable\":\"Yes\",\"user_over_time_type\":\"Automatic\",\"user_over_time_rate\":0,\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":\"Premium\",\"date_of_birth\":\"2022-01-21\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2022-01-02 08:45:17\",\"updated_at\":\"2022-01-02 08:45:17\"}'),
(149, 5, '2022-01-20 10:19:42', 'users', 'edit', '{\"id\":7,\"super_system_admin\":null,\"report_to_parent_id\":8,\"company_profile\":null,\"first_name\":\"Majhar\",\"last_name\":\"Alam\",\"username\":\"20294\",\"email\":\"mc4wq@gx5j.comaasdasd\",\"email_verified_at\":null,\"phone\":\"08499862579\",\"address\":null,\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/profile_photos\\\\mahbub.jpg\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"general\",\"attendance_status\":null,\"joining_date\":\"2021\\/09\\/01\",\"gross_salary\":200000,\"user_provident_fund_member\":\"\",\"user_provident_fund\":10,\"is_active\":null,\"login_location_id\":\"40\",\"check_in_ip\":null,\"check_out_ip\":null,\"check_in_latitude\":\"N\\/A\",\"check_in_longitude\":\"N\\/A\",\"check_out_latitude\":\"N\\/A\",\"check_out_longitude\":\"N\\/A\",\"over_time_payable\":\"No\",\"user_over_time_type\":null,\"user_over_time_rate\":0,\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":null,\"date_of_birth\":\"2021-11-23\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2021-11-29 10:56:16\",\"updated_at\":\"2022-01-08 04:04:14\"}'),
(150, 5, '2022-01-20 10:23:22', 'users', 'edit', '{\"id\":28,\"super_system_admin\":null,\"report_to_parent_id\":26,\"company_profile\":null,\"first_name\":\"REZA\",\"last_name\":\"Al\",\"username\":\"mah\",\"email\":\"mcweweweewe4wq@gx5j.com\",\"email_verified_at\":null,\"phone\":\"0849986257954444444\",\"address\":null,\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/profile_photos\\\\avtr).jpg\",\"com_id\":1,\"department_id\":3,\"designation_id\":4,\"office_shift_id\":1,\"attendance_type\":\"general\",\"attendance_status\":null,\"joining_date\":\"2021-12-01\",\"gross_salary\":null,\"user_provident_fund_member\":\"\",\"user_provident_fund\":null,\"is_active\":\"1\",\"login_location_id\":\"42\",\"check_in_ip\":null,\"check_out_ip\":null,\"check_in_latitude\":\"N\\/A\",\"check_in_longitude\":\"N\\/A\",\"check_out_latitude\":\"N\\/A\",\"check_out_longitude\":\"N\\/A\",\"over_time_payable\":\"No\",\"user_over_time_type\":null,\"user_over_time_rate\":0,\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":null,\"date_of_birth\":\"2021-12-01\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2021-11-30 07:10:01\",\"updated_at\":\"2022-01-20 07:51:15\"}'),
(151, 5, '2022-01-20 10:26:10', 'users', 'edit', '{\"id\":6,\"super_system_admin\":null,\"report_to_parent_id\":8,\"company_profile\":null,\"first_name\":\"Tarek\",\"last_name\":\"Alam\",\"username\":\"tarekalam\",\"email\":\"rakibulhasan.rh890@gmail.com\",\"email_verified_at\":null,\"phone\":\"453454345345345345\",\"address\":null,\"password\":\"$2y$10$jtki9mhU26EHucxFRuXUHey4P5.LV\\/1JFjuxKho\\/tMm\\/q7wpllTp2\",\"profile_photo\":\"uploads\\/profile_photos\\\\mahbub.jpg\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":4,\"attendance_type\":\"general\",\"attendance_status\":null,\"joining_date\":\"2021-08-02\",\"gross_salary\":6000000,\"user_provident_fund_member\":null,\"user_provident_fund\":5,\"is_active\":\"1\",\"login_location_id\":\"\",\"check_in_ip\":\"No\",\"check_out_ip\":\"No\",\"check_in_latitude\":\"No\",\"check_in_longitude\":\"No\",\"check_out_latitude\":\"No\",\"check_out_longitude\":\"No\",\"over_time_payable\":\"Yes\",\"user_over_time_type\":\"Automatic\",\"user_over_time_rate\":2,\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":\"Premium\",\"date_of_birth\":\"2021-11-23\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2021-11-28 09:20:42\",\"updated_at\":\"2022-01-19 12:16:30\"}'),
(152, 5, '2022-01-20 10:32:10', 'users', 'edit', '{\"id\":6,\"super_system_admin\":null,\"report_to_parent_id\":8,\"company_profile\":null,\"first_name\":\"Tarek\",\"last_name\":\"Alam\",\"username\":\"tarekalam\",\"email\":\"rakibulhasan.rh890@gmail.com\",\"email_verified_at\":null,\"phone\":\"453454345345345345\",\"address\":null,\"password\":\"$2y$10$jtki9mhU26EHucxFRuXUHey4P5.LV\\/1JFjuxKho\\/tMm\\/q7wpllTp2\",\"profile_photo\":\"uploads\\/profile_photos\\\\mahbub.jpg\",\"com_id\":1,\"department_id\":3,\"designation_id\":4,\"office_shift_id\":4,\"attendance_type\":\"general\",\"attendance_status\":null,\"joining_date\":\"2021-08-02\",\"gross_salary\":6000000,\"user_provident_fund_member\":null,\"user_provident_fund\":5,\"is_active\":\"1\",\"login_location_id\":\"\",\"check_in_ip\":\"No\",\"check_out_ip\":\"No\",\"check_in_latitude\":\"No\",\"check_in_longitude\":\"No\",\"check_out_latitude\":\"No\",\"check_out_longitude\":\"No\",\"over_time_payable\":\"Yes\",\"user_over_time_type\":\"Automatic\",\"user_over_time_rate\":2,\"region_id\":1,\"area_id\":1,\"territory_id\":1,\"town_id\":1,\"db_house_id\":1,\"role_id\":2,\"com_pack\":\"Premium\",\"date_of_birth\":\"2021-11-23\",\"gender\":\"Male\",\"remember_token\":null,\"created_at\":\"2021-11-28 09:20:42\",\"updated_at\":\"2022-01-20 10:26:10\"}'),
(153, 5, '2022-01-22 03:50:52', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/97.0.4692.71 Safari\\/537.36\"}'),
(154, 5, '2022-01-23 03:26:51', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/97.0.4692.71 Safari\\/537.36\"}'),
(155, 5, '2022-01-24 03:41:00', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/97.0.4692.71 Safari\\/537.36\"}'),
(156, 5, '2022-01-24 11:47:39', 'users', 'edit', '{\"id\":5,\"super_system_admin\":null,\"report_to_parent_id\":null,\"company_profile\":\"Yes\",\"first_name\":\"Prediction Learning Associates Ltd.\",\"last_name\":\"Ltd\",\"username\":\"PredictionLA\",\"email\":\"mahbubwebsoft@gmail.com\",\"email_verified_at\":null,\"phone\":\"+8801713334874\",\"address\":null,\"password\":\"$2y$10$\\/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W\",\"profile_photo\":\"uploads\\/logos\\\\logo (1).png\",\"com_id\":1,\"department_id\":1,\"designation_id\":1,\"office_shift_id\":1,\"attendance_type\":\"\",\"attendance_status\":\"Yes\",\"joining_date\":\"2021-08-01\",\"gross_salary\":100000,\"user_provident_fund_member\":\"Yes\",\"user_provident_fund\":10,\"is_active\":\"\",\"login_location_id\":\"\",\"check_in_ip\":\"127.0.0.1\",\"check_out_ip\":\"127.0.0.1\",\"check_in_latitude\":\"23.8218016\",\"check_in_longitude\":\"90.4209962\",\"check_out_latitude\":\"23.821801\",\"check_out_longitude\":\"90.4209962\",\"over_time_payable\":\"Yes\",\"user_over_time_type\":\"Automatic\",\"user_over_time_rate\":2,\"region_id\":0,\"area_id\":null,\"territory_id\":null,\"town_id\":null,\"db_house_id\":null,\"role_id\":1,\"com_pack\":\"Premium\",\"date_of_birth\":\"2021-11-23\",\"gender\":\"0\",\"remember_token\":\"ofcXPIIFPSJKFeFX2QVI4HzFnD9a0SjTIusW4Qtj9YB4Z8M9I48bkyKOjekf\",\"created_at\":\"2021-11-28 09:14:14\",\"updated_at\":\"2022-01-16 06:05:55\"}'),
(157, 5, '2022-01-25 03:38:34', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/97.0.4692.71 Safari\\/537.36\"}'),
(158, 5, '2022-01-26 03:30:06', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/97.0.4692.99 Safari\\/537.36\"}');

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `id` bigint(20) NOT NULL,
  `meeting_com_id` bigint(20) NOT NULL,
  `meeting_department_id` bigint(20) NOT NULL,
  `meeting_employee_id` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `meeting_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meeting_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meeting_time` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meeting_status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meeting_note` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meeting_notifiable` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`id`, `meeting_com_id`, `meeting_department_id`, `meeting_employee_id`, `meeting_title`, `meeting_date`, `meeting_time`, `meeting_status`, `meeting_note`, `meeting_notifiable`, `created_at`, `updated_at`) VALUES
(3, 1, 1, '[\"6\",\"7\",\"8\",\"10\",\"26\",\"27\",\"32\",\"37\"]', 'Project Vision', '2022-01-05', '03:50', 'Pending', 's', NULL, '2022-01-18 23:55:04', '2022-01-18 23:55:04'),
(5, 1, 1, '[\"6\",\"7\",\"8\",\"10\",\"26\",\"27\"]', 'Project Vision', '2022-01-27', '13:03', 'Postponed', 'rrrr', NULL, '2022-01-19 01:00:53', '2022-01-19 01:00:53');

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
(11, '2014_10_12_000000_create_users_table', 1),
(12, '2014_10_12_100000_create_password_resets_table', 1),
(13, '2019_08_19_000000_create_failed_jobs_table', 1),
(14, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(31, '2020_11_20_100001_create_log_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(10) NOT NULL,
  `module_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `com_id` int(10) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `module_name`, `com_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'User', 1, 1, '2021-11-28 10:09:08', '2021-11-28 10:09:08'),
(2, 'Employees', 1, 1, '2021-11-28 10:33:11', '2021-11-28 10:33:11');

-- --------------------------------------------------------

--
-- Table structure for table `monthly_attendances`
--

CREATE TABLE `monthly_attendances` (
  `id` int(10) NOT NULL,
  `monthly_com_id` int(10) NOT NULL,
  `monthly_employee_id` int(10) NOT NULL,
  `attendance_month` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attendance_year` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `day_one` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day_two` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day_three` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day_four` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day_five` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day_six` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day_seven` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day_eight` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day_nine` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day_ten` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day_eleven` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day_twelve` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day_thirteen` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day_fourteen` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day_fifteen` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day_sixteen` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day_seventeen` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day_eighteen` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day_nineteen` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day_twenty` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day_twenty_one` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day_twenty_two` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day_twenty_three` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day_twenty_four` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day_twenty_five` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day_twenty_six` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day_twenty_seven` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day_twenty_eight` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day_twenty_nine` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day_thirty` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day_thirty_one` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monthly_payment_status` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `monthly_attendances`
--

INSERT INTO `monthly_attendances` (`id`, `monthly_com_id`, `monthly_employee_id`, `attendance_month`, `attendance_year`, `day_one`, `day_two`, `day_three`, `day_four`, `day_five`, `day_six`, `day_seven`, `day_eight`, `day_nine`, `day_ten`, `day_eleven`, `day_twelve`, `day_thirteen`, `day_fourteen`, `day_fifteen`, `day_sixteen`, `day_seventeen`, `day_eighteen`, `day_nineteen`, `day_twenty`, `day_twenty_one`, `day_twenty_two`, `day_twenty_three`, `day_twenty_four`, `day_twenty_five`, `day_twenty_six`, `day_twenty_seven`, `day_twenty_eight`, `day_twenty_nine`, `day_thirty`, `day_thirty_one`, `monthly_payment_status`, `created_at`, `updated_at`) VALUES
(10, 1, 6, '2021-12-01', '2021-12-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'P', 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-12-13 05:21:26', '2021-12-13 21:39:31'),
(14, 1, 5, '2021-12-01', '2021-12-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'P', 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-12-13 05:21:26', '2022-01-21 22:32:48'),
(15, 1, 5, '2022-01-01', '2022-01-01', 'P', 'P', 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'P', NULL, NULL, NULL, 'P', NULL, 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-01 01:26:02', '2022-01-23 23:43:48');

-- --------------------------------------------------------

--
-- Table structure for table `office_shifts`
--

CREATE TABLE `office_shifts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shift_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_shift` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office_shift_com_id` bigint(20) UNSIGNED NOT NULL,
  `sunday_in` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sunday_out` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saturday_in` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saturday_out` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `friday_in` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `friday_out` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thursday_in` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thursday_out` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wednesday_in` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wednesday_out` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tuesday_in` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tuesday_out` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monday_in` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monday_out` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `office_shifts`
--

INSERT INTO `office_shifts` (`id`, `shift_name`, `default_shift`, `office_shift_com_id`, `sunday_in`, `sunday_out`, `saturday_in`, `saturday_out`, `friday_in`, `friday_out`, `thursday_in`, `thursday_out`, `wednesday_in`, `wednesday_out`, `tuesday_in`, `tuesday_out`, `monday_in`, `monday_out`, `created_at`, `updated_at`) VALUES
(4, 'Full-Time', NULL, 1, '09:00', '14:00', '09:00', '18:00', '09:00', '18:00', '09:00', '18:00', '09:00', '18:00', '09:00', '18:00', '09:00', '18:00', '2021-12-11 21:54:38', '2021-12-11 21:54:38');

-- --------------------------------------------------------

--
-- Table structure for table `other_payments`
--

CREATE TABLE `other_payments` (
  `id` bigint(20) NOT NULL,
  `other_payment_com_id` bigint(20) NOT NULL,
  `other_payment_employee_id` bigint(20) NOT NULL,
  `other_payment_month_year` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_payment_title` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_payment_amount` int(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `other_payments`
--

INSERT INTO `other_payments` (`id`, `other_payment_com_id`, `other_payment_employee_id`, `other_payment_month_year`, `other_payment_title`, `other_payment_amount`, `created_at`, `updated_at`) VALUES
(2, 1, 7, '2021-11-01', 'q444', 44444, '2021-12-27 00:55:27', '2021-12-28 03:57:13'),
(4, 1, 7, '2021-10-01', '9lp6JZG52l', 78678687, '2021-12-27 01:03:27', '2021-12-28 03:57:05'),
(5, 1, 5, '2021-11-01', 'q444', 2000, '2021-12-28 03:57:32', '2021-12-28 03:57:32');

-- --------------------------------------------------------

--
-- Table structure for table `overtime_configs`
--

CREATE TABLE `overtime_configs` (
  `id` bigint(20) NOT NULL,
  `overtime_config_com_id` bigint(20) NOT NULL,
  `minimum_countable_over_time` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `overtime_configs`
--

INSERT INTO `overtime_configs` (`id`, `overtime_config_com_id`, `minimum_countable_over_time`, `created_at`, `updated_at`) VALUES
(2, 1, 45, '2022-01-10 04:37:03', '2022-01-10 04:37:03');

-- --------------------------------------------------------

--
-- Table structure for table `over_times`
--

CREATE TABLE `over_times` (
  `id` bigint(20) NOT NULL,
  `over_time_com_id` bigint(20) NOT NULL,
  `over_time_employee_id` bigint(20) NOT NULL,
  `over_time_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `over_time_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `over_time_company_duty_in_seconds` bigint(20) NOT NULL,
  `over_time_employee_in_seconds` bigint(20) NOT NULL,
  `over_time_rate` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `over_times`
--

INSERT INTO `over_times` (`id`, `over_time_com_id`, `over_time_employee_id`, `over_time_type`, `over_time_date`, `over_time_company_duty_in_seconds`, `over_time_employee_in_seconds`, `over_time_rate`, `created_at`, `updated_at`) VALUES
(12, 1, 5, 'Automatic', '2022-01-02', 18000, 4364, 2, '2022-01-02 03:12:44', '2022-01-02 03:12:44');

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
-- Table structure for table `pay_slips`
--

CREATE TABLE `pay_slips` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pay_slip_key` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_slip_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_slip_employee_id` bigint(20) UNSIGNED NOT NULL,
  `pay_slip_com_id` bigint(20) UNSIGNED NOT NULL,
  `pay_slip_department_id` bigint(20) NOT NULL,
  `pay_slip_payment_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_slip_payment_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_slip_gross_salary` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_slip_basic_salary` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_slip_net_salary` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_slip_house_rent` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_slip_medical_allowance` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_slip_conveyance_allowance` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_slip_festival_bonus` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_slip_commissions` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_slip_loans` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_slip_tax_deduction` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_slip_statutory_deduction` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_slip_provident_fund` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_slip_overtimes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_slip_other_payments` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_slip_pension_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_slip_pension_amount` double(8,2) DEFAULT NULL,
  `pay_slip_working_days` int(11) NOT NULL,
  `pay_slip_status` tinyint(4) NOT NULL,
  `pay_slip_month_year` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pay_slips`
--

INSERT INTO `pay_slips` (`id`, `pay_slip_key`, `pay_slip_number`, `pay_slip_employee_id`, `pay_slip_com_id`, `pay_slip_department_id`, `pay_slip_payment_type`, `pay_slip_payment_date`, `pay_slip_gross_salary`, `pay_slip_basic_salary`, `pay_slip_net_salary`, `pay_slip_house_rent`, `pay_slip_medical_allowance`, `pay_slip_conveyance_allowance`, `pay_slip_festival_bonus`, `pay_slip_commissions`, `pay_slip_loans`, `pay_slip_tax_deduction`, `pay_slip_statutory_deduction`, `pay_slip_provident_fund`, `pay_slip_overtimes`, `pay_slip_other_payments`, `pay_slip_pension_type`, `pay_slip_pension_amount`, `pay_slip_working_days`, `pay_slip_status`, `pay_slip_month_year`, `created_at`, `updated_at`) VALUES
(8, '2YK4xFLYNs5', '693108331663045', 6, 1, 1, 'Monthly', '2022-01-04', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-04 02:07:25', '2022-01-04 02:07:25'),
(9, 'tgfhgfhbfxdzfsdfhjdfgdrfs', '894346590420135', 6, 1, 1, 'Monthly', '2022-01-04', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-04 02:15:48', '2022-01-04 02:15:48'),
(10, 'fjgfgngfgngfdfrstrgvf', '817089558256645', 6, 1, 1, 'Monthly', '2022-01-04', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-04 02:16:19', '2022-01-04 02:16:19'),
(11, 'jonLjGOB92j98ppT9JGfs5uqrkBOum5', '953628772023725', 5, 1, 1, 'Monthly', '2022-01-04', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-04 02:16:37', '2022-01-04 02:16:37'),
(12, 'gjghfcbhghfdkjfyhgcfntgf', '7797021974785', 5, 1, 1, 'Monthly', '2022-01-04', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-04 02:16:56', '2022-01-04 02:16:56'),
(13, 'tgfhjgfdbmjtyuudfdzfsg', '438160068931795', 5, 1, 1, 'Monthly', '2022-01-04', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-04 02:17:18', '2022-01-04 02:17:18'),
(14, 'Ca29srvH3Cf5CzQByWLNAMuKV5', '980232704258485', 5, 1, 1, 'Monthly', '2022-01-04', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-04 02:17:48', '2022-01-04 02:17:48'),
(15, 'xU4167uqdnLk7qcbZ1x5heLHp5', '956437119084465', 5, 1, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-04 21:56:48', '2022-01-04 21:56:48'),
(109, '0OODSr1CMDlIK7EOhfCd0dw5P5', '22479261389275', 5, 1, 1, 'Monthly', '2022-01-11', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-11 04:52:39', '2022-01-11 04:52:39'),
(110, 'jjBlkVUDHvdz5YJOkapY2yi7x5', '196695156097955', 5, 1, 1, 'Monthly', '2022-01-11', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-11 04:54:03', '2022-01-11 04:54:03'),
(111, 'PuSIR9DGzdsefaBWyeTLQJKjJ5', '987938524585385', 5, 1, 1, 'Monthly', '2022-01-11', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-11 05:03:25', '2022-01-11 05:03:25'),
(112, 'ay0MEwRsyuN2y955IJ3w5r7rX5', '215374965311185', 5, 1, 1, 'Monthly', '2022-01-11', '100000', '9677.4193548387', '47709.677419355', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '967.74193548387', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-11 05:07:47', '2022-01-11 05:07:47'),
(113, '5SJv66pi35jTFw8Ux5kicE7Xh5', '33474070283635', 5, 1, 1, 'Monthly', '2022-01-11', '100000', '9677.4193548387', '38260.419354839', '30000', '5000', '5000', '0', '0', '1000', '417', '0', '10000', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-11 05:11:13', '2022-01-11 05:11:13'),
(114, '5YcDfqfrJVulhqBefoFCXRprE5', '953346222083275', 5, 1, 1, 'Monthly', '2022-01-12', '100000', '9677.4193548387', '38260.419354839', '30000', '5000', '5000', '0', '0', '1000', '417', '0', '10000', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-12 02:33:32', '2022-01-12 02:33:32'),
(115, '7dn3zDQOCicR0uxgqwwNiEzDU5', '22950707120015', 5, 1, 1, 'Monthly', '2022-01-12', '100000', '9677.4193548387', '38260.419354839', '30000', '5000', '5000', '0', '0', '1000', '417', '0', '10000', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-12 03:55:41', '2022-01-12 03:55:41'),
(116, 'J1avaj1sEMXPXk9m0Ct4ZWYqV5', '209067900123945', 5, 1, 1, 'Monthly', '2022-01-12', '100000', '9677.4193548387', '38260.419354839', '30000', '5000', '5000', '0', '0', '1000', '417', '0', '10000', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-12 04:15:28', '2022-01-12 04:15:28'),
(117, 'e0CncTZAomPkzESNYJue5yEef5', '692572118430235', 5, 1, 1, 'Monthly', '2022-01-12', '100000', '9677.4193548387', '38260.419354839', '30000', '5000', '5000', '0', '0', '1000', '417', '0', '10000', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-12 04:16:01', '2022-01-12 04:16:01'),
(118, '5JUSUKGg9QV3pGXPXcv7h68yi5', '135330298974435', 5, 1, 1, 'Monthly', '2022-01-12', '100000', '9677.4193548387', '38260.419354839', '30000', '5000', '5000', '0', '0', '1000', '417', '0', '10000', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-12 07:01:12', '2022-01-12 07:01:12'),
(119, '7nOlLz5EvKRC8TDBh8vptXUnG5', '533546092113085', 5, 1, 1, 'Monthly', '2022-01-22', '100000', '9677.4193548387', '38260.419354839', '30000', '5000', '5000', '0', '0', '1000', '417', '0', '10000', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-21 22:32:48', '2022-01-21 22:32:48');

-- --------------------------------------------------------

--
-- Table structure for table `pensions`
--

CREATE TABLE `pensions` (
  `id` bigint(20) NOT NULL,
  `pension_com_id` bigint(20) NOT NULL,
  `pension_employee_id` bigint(20) NOT NULL,
  `pension_start_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pension_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pension_amount` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pensions`
--

INSERT INTO `pensions` (`id`, `pension_com_id`, `pension_employee_id`, `pension_start_date`, `pension_type`, `pension_amount`, `created_at`, `updated_at`) VALUES
(3, 1, 7, '2022-01-05', 'Fixed', 2, '2021-12-27 04:17:50', '2021-12-27 04:17:50');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) NOT NULL,
  `module_id` int(10) NOT NULL,
  `sub_module_id` int(10) NOT NULL,
  `com_id` int(10) NOT NULL,
  `role_id` int(10) NOT NULL,
  `add_status` int(10) NOT NULL,
  `edit_status` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `module_id`, `sub_module_id`, `com_id`, `role_id`, `add_status`, `edit_status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 0, 0, '2021-11-28 10:52:40', '2021-11-28 10:52:40'),
(2, 1, 1, 14, 0, 0, 0, '2021-11-28 10:52:40', '2021-11-28 10:52:40');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `policies`
--

CREATE TABLE `policies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `policy_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `policy_desc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policy_com_id` bigint(20) UNSIGNED DEFAULT NULL,
  `policy_added_by` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `policies`
--

INSERT INTO `policies` (`id`, `policy_title`, `policy_desc`, `policy_com_id`, `policy_added_by`, `created_at`, `updated_at`) VALUES
(1, 'Policy\r\n', 'Policy Description', 1, '5', '2021-12-06 08:55:17', '2021-12-06 08:55:17');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) NOT NULL,
  `project_com_id` bigint(20) NOT NULL,
  `assign_to` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_name` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_priority` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_client_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_start_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_end_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `progress_progress` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_com_id`, `assign_to`, `project_name`, `project_priority`, `project_client_name`, `project_start_date`, `project_end_date`, `progress_progress`, `created_at`, `updated_at`) VALUES
(2, 1, '[\"6\",\"10\"]', 'Robot Project', 'High', 'Mr. Hasan', '2021-12-13', '2022-01-27', '30', '2021-12-23 01:40:27', '2021-12-23 02:28:52'),
(4, 1, '[\"6\",\"10\"]', 'Robot Project23', 'High', 'Mr. Hasan23', '2021-12-29', '2021-12-30', '20%', '2021-12-27 00:11:39', '2022-01-19 04:51:21');

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` bigint(20) NOT NULL,
  `promotion_com_id` bigint(20) NOT NULL,
  `promotion_employee_id` bigint(20) NOT NULL,
  `promotion_old_department` bigint(20) DEFAULT NULL,
  `promotion_new_department` bigint(20) DEFAULT NULL,
  `promotion_old_designation` bigint(20) DEFAULT NULL,
  `promotion_new_designation` bigint(20) DEFAULT NULL,
  `promotion_old_gross_salary` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `promotion_new_gross_salary` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `promotion_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `promotion_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `promotion_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`id`, `promotion_com_id`, `promotion_employee_id`, `promotion_old_department`, `promotion_new_department`, `promotion_old_designation`, `promotion_new_designation`, `promotion_old_gross_salary`, `promotion_new_gross_salary`, `promotion_title`, `promotion_date`, `promotion_description`, `created_at`, `updated_at`) VALUES
(5, 1, 6, 1, 1, 1, 1, '100', '5000000', 'test5', '2022-01-18', 'trest5', '2022-01-17 03:45:12', '2022-01-17 05:09:27'),
(6, 1, 6, 3, 1, 1, 1, '300000', '400000', 'test2', '2022-01-17', 'rest2', '2022-01-17 04:28:24', '2022-01-17 04:28:24'),
(7, 1, 6, 1, 1, 1, 1, '5000000', '6000000', 'hi', '2022-01-28', 'dfddf', '2022-01-19 06:16:30', '2022-01-19 06:16:30'),
(8, 1, 7, 1, 3, 4, 4, '200000', '300000', 'dffd', '2022-01-20', 'fdfdf', '2022-01-20 04:19:42', '2022-01-20 04:19:42'),
(9, 1, 28, 3, 1, 1, 1, 'null', '500000', 'hh', '2022-01-26', 'jhj', '2022-01-20 04:23:22', '2022-01-20 04:23:22'),
(10, 1, 6, 1, 3, 4, 4, '6000000', '6000000', 'test', '2022-02-03', 'xasds', '2022-01-20 04:26:10', '2022-01-20 04:26:10'),
(11, 1, 6, 3, 1, 4, 1, '6000000', '7000000', 'test', '2022-01-21', 'fgrf', '2022-01-20 04:32:10', '2022-01-20 04:32:10');

-- --------------------------------------------------------

--
-- Table structure for table `providentfund_bankaccounts`
--

CREATE TABLE `providentfund_bankaccounts` (
  `id` bigint(20) NOT NULL,
  `providentfund_bankaccount_com_id` bigint(20) NOT NULL,
  `providentfund_bankaccount_employee_id` bigint(20) NOT NULL,
  `providentfund_bankaccount_stuff_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `providentfund_bankaccount_bank_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `providentfund_bankaccount_bank_account_number` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `providentfund_bankaccount_branch_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `providentfund_bankaccount_branch_code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `providentfund_bankaccounts`
--

INSERT INTO `providentfund_bankaccounts` (`id`, `providentfund_bankaccount_com_id`, `providentfund_bankaccount_employee_id`, `providentfund_bankaccount_stuff_id`, `providentfund_bankaccount_bank_name`, `providentfund_bankaccount_bank_account_number`, `providentfund_bankaccount_branch_name`, `providentfund_bankaccount_branch_code`, `created_at`, `updated_at`) VALUES
(4, 1, 6, '111-566-545-545', 'DBBL', '321-3213-434-3454', 'DOHS Baridhara', '1229', '2022-01-12 02:23:14', '2022-01-12 02:23:14'),
(5, 1, 5, '111-566-545-54545', 'DBBL', '321-3213-434-345434564', 'DOHS Baridhara', '1229', '2022-01-12 02:23:14', '2022-01-12 02:23:14');

-- --------------------------------------------------------

--
-- Table structure for table `providentfund_configs`
--

CREATE TABLE `providentfund_configs` (
  `id` bigint(20) NOT NULL,
  `providentfund_config_com_id` bigint(20) NOT NULL,
  `providentfund_config_amount_precentage` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `providentfund_configs`
--

INSERT INTO `providentfund_configs` (`id`, `providentfund_config_com_id`, `providentfund_config_amount_precentage`, `created_at`, `updated_at`) VALUES
(2, 1, 10, '2022-01-11 03:31:36', '2022-01-11 03:43:00');

-- --------------------------------------------------------

--
-- Table structure for table `providentfund_members`
--

CREATE TABLE `providentfund_members` (
  `id` bigint(20) NOT NULL,
  `providentfund_member_com_id` bigint(20) NOT NULL,
  `providentfund_member_employee_id` bigint(20) NOT NULL,
  `providentfund_member_start_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `providentfund_reports`
--

CREATE TABLE `providentfund_reports` (
  `id` bigint(20) NOT NULL,
  `providentfund_report_com_id` bigint(20) NOT NULL,
  `providentfund_report_employee_id` bigint(20) NOT NULL,
  `providentfund_report_total_amount` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `providentfund_reports`
--

INSERT INTO `providentfund_reports` (`id`, `providentfund_report_com_id`, `providentfund_report_employee_id`, `providentfund_report_total_amount`, `created_at`, `updated_at`) VALUES
(3, 1, 5, '80000', '2022-01-12 04:15:28', '2022-01-21 22:32:48');

-- --------------------------------------------------------

--
-- Table structure for table `provident_funds`
--

CREATE TABLE `provident_funds` (
  `id` bigint(20) NOT NULL,
  `provident_fund_com_id` bigint(20) NOT NULL,
  `provident_fund_employee_id` bigint(20) NOT NULL,
  `provident_fund_payment_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provident_fund_month_year` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provident_fund_employee_amount` varchar(291) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provident_fund_company_amount` varchar(291) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provident_funds`
--

INSERT INTO `provident_funds` (`id`, `provident_fund_com_id`, `provident_fund_employee_id`, `provident_fund_payment_date`, `provident_fund_month_year`, `provident_fund_employee_amount`, `provident_fund_company_amount`, `created_at`, `updated_at`) VALUES
(5, 1, 6, '2022-01-11', '2021-12-01', '10000', '10000', '2022-01-11 05:11:13', '2022-01-11 05:11:13'),
(6, 1, 5, '2022-01-12', '2021-12-01', '10000', '10000', '2022-01-12 02:33:32', '2022-01-12 02:33:32'),
(7, 1, 6, '2022-01-12', '2021-12-01', '10000', '10000', '2022-01-12 02:33:32', '2022-01-12 02:33:32'),
(9, 1, 5, '2022-01-12', '2021-12-01', '10000', '10000', '2022-01-12 04:15:28', '2022-01-12 04:15:28'),
(10, 1, 5, '2022-01-12', '2021-12-01', '10000', '10000', '2022-01-12 04:16:01', '2022-01-12 04:16:01'),
(11, 1, 5, '2022-01-12', '2021-12-01', '10000', '10000', '2022-01-12 07:01:12', '2022-01-12 07:01:12'),
(12, 1, 5, '2022-01-22', '2021-12-01', '10000', '10000', '2022-01-21 22:32:48', '2022-01-21 22:32:48');

-- --------------------------------------------------------

--
-- Table structure for table `qualifications`
--

CREATE TABLE `qualifications` (
  `id` bigint(20) NOT NULL,
  `qualification_com_id` bigint(20) NOT NULL,
  `qualification_employee_id` bigint(20) NOT NULL,
  `qualification_institute_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qualification_education_level` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qualification_from_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qualification_to_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qualification_language_version` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qualification_skill` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qualification_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qualifications`
--

INSERT INTO `qualifications` (`id`, `qualification_com_id`, `qualification_employee_id`, `qualification_institute_name`, `qualification_education_level`, `qualification_from_date`, `qualification_to_date`, `qualification_language_version`, `qualification_skill`, `qualification_description`, `created_at`, `updated_at`) VALUES
(3, 1, 6, 'Primeasia University', 'Bsc', '2016-01-17', '2020-12-17', 'English', 'Computer Science & Engineering', 'Computer Science & Engineering', '2022-01-17 01:10:34', '2022-01-17 01:10:34');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(10) NOT NULL,
  `region_com_id` int(10) NOT NULL,
  `region_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `region_com_id`, `region_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dhaka', '2021-11-29 03:44:18', '2021-12-02 04:28:28'),
(2, 1, 'Chittagong', '2021-12-02 04:28:53', '2021-12-02 04:28:53'),
(5, 1, 'Sylhet', '2021-12-05 00:51:20', '2021-12-05 00:51:37'),
(6, 1, 'Full-Time', '2021-12-11 04:45:48', '2021-12-11 04:45:48');

-- --------------------------------------------------------

--
-- Table structure for table `resignations`
--

CREATE TABLE `resignations` (
  `id` bigint(20) NOT NULL,
  `resignation_com_id` bigint(20) NOT NULL,
  `resignation_department_id` bigint(20) NOT NULL,
  `resignation_employee_id` bigint(20) NOT NULL,
  `resignation_notice_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resignation_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resignation_desc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resignations`
--

INSERT INTO `resignations` (`id`, `resignation_com_id`, `resignation_department_id`, `resignation_employee_id`, `resignation_notice_date`, `resignation_date`, `resignation_desc`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 27, '2022-01-20', '2022-01-25', 'xd2', '2022-01-20 03:46:35', '2022-01-20 04:44:51');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `roles_com_id` int(10) NOT NULL,
  `roles_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roles_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roles_is_active` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `roles_com_id`, `roles_name`, `guard_name`, `roles_description`, `roles_is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'web', 'Can access and change everything', 1, NULL, NULL),
(2, 1, 'employee', 'web', 'Default access', 1, '2020-07-26 13:50:45', '2020-07-26 13:50:45'),
(3, 1, 'client', 'web', 'When you create a client, this role and associated.', 1, '2020-10-08 03:10:23', '2020-10-08 03:10:23'),
(4, 1, 'Manager', 'web', 'Can Manage', 1, '2021-02-24 10:24:58', '2021-02-24 10:24:58'),
(5, 1, 'Editor', 'web', 'Custom access', 1, '2021-02-24 10:24:58', '2021-02-24 10:24:58'),
(6, 1, 'Prediction HR', 'web', 'For new contract', 1, '2021-06-02 12:18:06', '2021-06-06 13:07:25'),
(7, 1, 'PVMHR', 'web', 'PVM Payroll HR staffs, will oversee outsourced staffs operations.', 1, '2021-06-16 07:48:03', '2021-06-16 07:55:25'),
(8, 1, 'PVM TM/Supervisor', 'web', 'PVM payroll staffs, will oversee the outsourced staffs e.g. Leave, Attendance, Performance etc.', 1, '2021-06-16 07:49:58', '2021-06-16 07:53:30'),
(9, 1, 'PLA PVM HR Operations', 'web', 'Prediction payroll staffs, dedicated to manage entire outsourced operations for PVM', 1, '2021-06-16 07:52:43', '2021-06-16 07:52:43'),
(13, 1, 'k', NULL, 'e', 1, '2021-12-17 22:13:21', '2021-12-17 22:13:21');

-- --------------------------------------------------------

--
-- Table structure for table `salary_configs`
--

CREATE TABLE `salary_configs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `salary_config_com_id` bigint(20) NOT NULL,
  `salary_config_basic_salary` bigint(20) NOT NULL,
  `salary_config_house_rent_allowance` bigint(20) NOT NULL,
  `salary_config_conveyance_allowance` bigint(20) NOT NULL,
  `salary_config_medical_allowance` bigint(20) NOT NULL,
  `salary_config_festival_bonus` bigint(20) NOT NULL COMMENT '2 eid Bonus',
  `salary_config_provident_fund` bigint(20) NOT NULL,
  `salary_config_festival_bonus_active_period` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salary_configs`
--

INSERT INTO `salary_configs` (`id`, `salary_config_com_id`, `salary_config_basic_salary`, `salary_config_house_rent_allowance`, `salary_config_conveyance_allowance`, `salary_config_medical_allowance`, `salary_config_festival_bonus`, `salary_config_provident_fund`, `salary_config_festival_bonus_active_period`, `created_at`, `updated_at`) VALUES
(6, 1, 60, 30, 5, 5, 50, 5, 2, '2021-12-30 00:05:18', '2021-12-30 00:05:18');

-- --------------------------------------------------------

--
-- Table structure for table `social_profiles`
--

CREATE TABLE `social_profiles` (
  `id` bigint(20) NOT NULL,
  `social_profile_com_id` bigint(20) NOT NULL,
  `social_profile_employee_id` bigint(20) NOT NULL,
  `social_profile_fb_profile` varchar(291) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_profile_linkedin_profile` varchar(291) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_profile_skype_profile` varchar(291) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_profile_twitter_profile` varchar(291) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_profile_whatsapp_profile` varchar(291) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_profiles`
--

INSERT INTO `social_profiles` (`id`, `social_profile_com_id`, `social_profile_employee_id`, `social_profile_fb_profile`, `social_profile_linkedin_profile`, `social_profile_skype_profile`, `social_profile_twitter_profile`, `social_profile_whatsapp_profile`, `created_at`, `updated_at`) VALUES
(2, 1, 6, 'https://m.facebook.com/people/Mahbub-Alam-Prodhan/100004453903705/', 'https://www.linkedin.com/in/mahbub-alam-9a5141214/', '01734281290', 'https://twitter.com/MahbubA74978207', '01734281290', '2022-01-15 03:09:14', '2022-01-15 04:35:20');

-- --------------------------------------------------------

--
-- Table structure for table `statutory_deductions`
--

CREATE TABLE `statutory_deductions` (
  `id` bigint(20) NOT NULL,
  `statutory_deduc_com_id` bigint(20) NOT NULL,
  `statutory_deduc_employee_id` bigint(20) NOT NULL,
  `statutory_deduc_month_year` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `statutory_deduc_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `statutory_deduc_title` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `statutory_deduc_amount` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statutory_deductions`
--

INSERT INTO `statutory_deductions` (`id`, `statutory_deduc_com_id`, `statutory_deduc_employee_id`, `statutory_deduc_month_year`, `statutory_deduc_type`, `statutory_deduc_title`, `statutory_deduc_amount`, `created_at`, `updated_at`) VALUES
(3, 1, 7, '2021-12', 'Other Statutory Deduction', 'q122', 888888888881223, '2021-12-26 23:42:27', '2021-12-27 00:00:33'),
(4, 1, 5, '2021-11-01', 'Social Security System', 'aa', 30000, '2021-12-28 03:41:59', '2021-12-28 03:41:59');

-- --------------------------------------------------------

--
-- Table structure for table `sub_modules`
--

CREATE TABLE `sub_modules` (
  `id` int(10) NOT NULL,
  `module_id` int(10) NOT NULL,
  `com_id` int(10) NOT NULL,
  `role_id` int(10) NOT NULL,
  `sub_module_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_modules`
--

INSERT INTO `sub_modules` (`id`, `module_id`, `com_id`, `role_id`, `sub_module_name`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'User List', '2021-11-28 10:57:28', '2021-11-28 10:57:28'),
(2, 1, 1, 1, 'User Roles and Access', '2021-11-28 11:02:45', '2021-11-28 11:02:45');

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` bigint(20) NOT NULL,
  `support_ticket_com_id` bigint(20) NOT NULL,
  `support_ticket_department_id` bigint(20) DEFAULT NULL,
  `support_ticket_employee_id` bigint(20) NOT NULL,
  `support_ticket_priority` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `support_ticket_subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `support_ticket_note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `support_ticket_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `support_ticket_attachment` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `support_ticket_desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `support_ticket_status` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `support_tickets`
--

INSERT INTO `support_tickets` (`id`, `support_ticket_com_id`, `support_ticket_department_id`, `support_ticket_employee_id`, `support_ticket_priority`, `support_ticket_subject`, `support_ticket_note`, `support_ticket_date`, `support_ticket_attachment`, `support_ticket_desc`, `support_ticket_status`, `created_at`, `updated_at`) VALUES
(4, 1, 1, 6, 'Critical', 'dasds', 'dsadasd23', '2022-01-22', 'uploads/employee-ticket-files/1642848174.png', 'sdsadsdsdds', 'Closed', '2022-01-22 04:13:58', '2022-01-22 21:46:24'),
(6, 1, 1, 10, 'High', 'fefasdasdas', 'th', '2022-01-25', 'uploads/employee-ticket-files/1642909741.png', 'yjyj', 'Open', '2022-01-22 21:49:01', '2022-01-22 21:49:01'),
(7, 1, 1, 31, 'Critical', 'dasds', 'dsadasd2', '2022-01-23', 'uploads/employee-ticket-files/1642910262.png', 'erffdf', 'Pending', '2022-01-22 21:57:42', '2022-01-22 21:58:37'),
(8, 1, 3, 7, 'High', 'vcfgdf', 'fgf', '2022-01-11', 'uploads/employee-ticket-files/1642911093.png', 'fgfgfgfgfgf', 'Pending', '2022-01-22 22:11:33', '2022-01-22 22:11:33'),
(9, 1, 1, 6, 'Medium', 'fefasdasdas2', 'qa2', '2022-01-11', 'uploads/employee-ticket-files/1642914286.png', 'qq2', 'Closed', '2022-01-22 23:02:03', '2022-01-22 23:04:46');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) NOT NULL,
  `task_com_id` bigint(20) NOT NULL,
  `task_project_id` int(20) DEFAULT NULL,
  `task_assigned_to` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_title` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_start_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_end_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_assigned_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_estimated_hour` int(20) DEFAULT NULL,
  `task_progress` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `task_com_id`, `task_project_id`, `task_assigned_to`, `task_title`, `task_start_date`, `task_end_date`, `task_assigned_by`, `task_estimated_hour`, `task_progress`, `created_at`, `updated_at`) VALUES
(5, 1, 4, '[\"6\",\"8\",\"26\"]', 'erfdefdef', '2022-01-21', '2022-01-27', '5', 235, '100%', '2022-01-19 04:30:45', '2022-01-19 05:16:38'),
(7, 1, 4, '[\"6\",\"8\",\"26\"]', 'RB-TASK', '2022-01-20', '2022-01-27', '5', 40, '0%', '2022-01-19 04:46:43', '2022-01-19 04:46:43'),
(8, 1, 4, '[\"8\",\"7\",\"26\"]', 'RB-TASK', '2022-01-20', '2022-01-27', '5', 40, '0%', '2022-01-19 04:46:43', '2022-01-19 04:46:43');

-- --------------------------------------------------------

--
-- Table structure for table `tax_configs`
--

CREATE TABLE `tax_configs` (
  `id` int(10) NOT NULL,
  `tax_com_id` int(10) NOT NULL,
  `minimum_salary` int(100) NOT NULL,
  `next_to` bigint(200) DEFAULT NULL,
  `maximum_salary` bigint(200) NOT NULL,
  `tax_percentage` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tax_configs`
--

INSERT INTO `tax_configs` (`id`, `tax_com_id`, `minimum_salary`, `next_to`, `maximum_salary`, `tax_percentage`, `created_at`, `updated_at`) VALUES
(1, 1, 300000, 100000, 400000, 5, '2021-12-17 23:38:18', '2021-12-18 22:16:37'),
(2, 1, 400000, 300000, 700000, 10, '2021-12-17 23:44:03', '2021-12-17 23:44:03'),
(3, 1, 700000, 400000, 1100000, 15, '2021-12-17 23:44:57', '2021-12-17 23:44:57'),
(4, 1, 1100000, 500000, 1600000, 20, '2021-12-17 23:45:50', '2021-12-17 23:45:50'),
(5, 1, 1600000, 160000000, 16000000000000, 25, '2021-12-17 23:54:52', '2021-12-17 23:54:52');

-- --------------------------------------------------------

--
-- Table structure for table `terminations`
--

CREATE TABLE `terminations` (
  `id` bigint(20) NOT NULL,
  `termination_com_id` bigint(20) NOT NULL,
  `termination_department_id` bigint(20) NOT NULL,
  `termination_employee_id` bigint(20) NOT NULL,
  `termination_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `termination_desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `termination_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `termination_notice_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `terminations`
--

INSERT INTO `terminations` (`id`, `termination_com_id`, `termination_department_id`, `termination_employee_id`, `termination_type`, `termination_desc`, `termination_date`, `termination_notice_date`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 6, 'Disciplinary', 'aaaa', '2022-01-22', '2022-01-28', '2022-01-22 01:40:43', '2022-01-22 01:40:43');

-- --------------------------------------------------------

--
-- Table structure for table `territories`
--

CREATE TABLE `territories` (
  `id` int(10) NOT NULL,
  `territory_com_id` int(10) NOT NULL,
  `territory_region_id` int(10) NOT NULL,
  `territory_area_id` int(10) NOT NULL,
  `territory_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `territories`
--

INSERT INTO `territories` (`id`, `territory_com_id`, `territory_region_id`, `territory_area_id`, `territory_name`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'Gulshan', '2021-11-29 03:47:39', '2021-12-04 23:58:04'),
(3, 1, 5, 3, 'Japlong', '2021-12-05 00:54:57', '2021-12-05 00:54:57'),
(4, 1, 5, 3, 'Turag', '2021-12-05 01:17:23', '2021-12-05 01:17:23');

-- --------------------------------------------------------

--
-- Table structure for table `towns`
--

CREATE TABLE `towns` (
  `id` int(10) NOT NULL,
  `town_com_id` int(10) NOT NULL,
  `town_region_id` int(10) NOT NULL,
  `town_area_id` int(10) NOT NULL,
  `town_territory_id` int(10) NOT NULL,
  `town_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `towns`
--

INSERT INTO `towns` (`id`, `town_com_id`, `town_region_id`, `town_area_id`, `town_territory_id`, `town_name`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 'Gulshan-1', '2021-11-29 03:48:28', '2021-12-05 00:46:51');

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `id` bigint(20) NOT NULL,
  `transfer_com_id` bigint(20) NOT NULL,
  `transfer_from_department_id` bigint(20) NOT NULL,
  `transfer_employee_id` bigint(20) NOT NULL,
  `transfer_to_department_id` bigint(20) NOT NULL,
  `transfer_to_designation_id` bigint(20) NOT NULL,
  `transfer_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transfer_desc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transfers`
--

INSERT INTO `transfers` (`id`, `transfer_com_id`, `transfer_from_department_id`, `transfer_employee_id`, `transfer_to_department_id`, `transfer_to_designation_id`, `transfer_date`, `transfer_desc`, `created_at`, `updated_at`) VALUES
(2, 1, 3, 33, 1, 1, '2022-01-20', 'aaa3', '2022-01-20 01:51:15', '2022-01-20 03:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `travel`
--

CREATE TABLE `travel` (
  `id` bigint(20) NOT NULL,
  `travel_com_id` bigint(20) NOT NULL,
  `travel_department_id` bigint(20) NOT NULL,
  `travel_employee_id` bigint(20) NOT NULL,
  `travel_arrangement_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `travel_purpose` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `travel_place` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `travel_desc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `travel_start_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `travel_end_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `travel_expected_budget` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `travel_actual_budget` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `travel_mode` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `travel_status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `travel`
--

INSERT INTO `travel` (`id`, `travel_com_id`, `travel_department_id`, `travel_employee_id`, `travel_arrangement_type`, `travel_purpose`, `travel_place`, `travel_desc`, `travel_start_date`, `travel_end_date`, `travel_expected_budget`, `travel_actual_budget`, `travel_mode`, `travel_status`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 6, 'Traveling', 'Visiting as a company audit officer', 'Chandpur, Chittagong, Bangladesh', 'Visiting as a company audit officer', '2022-01-20', '2022-01-26', '1200002', '100000', 'By Plane', 'Approved', '2022-01-20 00:39:41', '2022-01-25 05:38:34'),
(3, 1, 1, 8, 'Traveling', 'HR employee auditing', 'Kurigram', 'HR employee auditing', '2022-01-01', '2022-01-05', '120033', '10000033', 'By Bus', 'Approved', '2022-01-25 05:40:18', '2022-01-25 05:40:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `super_system_admin` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `report_to_parent_id` int(10) DEFAULT NULL,
  `company_profile` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_photo` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `com_id` int(11) NOT NULL,
  `department_id` int(10) NOT NULL,
  `designation_id` int(10) NOT NULL,
  `office_shift_id` int(10) NOT NULL,
  `attendance_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attendance_status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joining_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gross_salary` int(11) DEFAULT NULL,
  `user_provident_fund_member` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_provident_fund` bigint(100) DEFAULT NULL,
  `is_active` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_location_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_in_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_out_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_in_latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_in_longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_out_latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_out_longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `over_time_payable` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_over_time_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_over_time_rate` int(10) DEFAULT NULL,
  `region_id` int(10) DEFAULT NULL,
  `area_id` int(10) DEFAULT NULL,
  `territory_id` int(10) DEFAULT NULL,
  `town_id` int(10) DEFAULT NULL,
  `db_house_id` int(10) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `com_pack` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `super_system_admin`, `report_to_parent_id`, `company_profile`, `first_name`, `last_name`, `username`, `email`, `email_verified_at`, `phone`, `address`, `password`, `profile_photo`, `com_id`, `department_id`, `designation_id`, `office_shift_id`, `attendance_type`, `attendance_status`, `joining_date`, `gross_salary`, `user_provident_fund_member`, `user_provident_fund`, `is_active`, `login_location_id`, `check_in_ip`, `check_out_ip`, `check_in_latitude`, `check_in_longitude`, `check_out_latitude`, `check_out_longitude`, `over_time_payable`, `user_over_time_type`, `user_over_time_rate`, `region_id`, `area_id`, `territory_id`, `town_id`, `db_house_id`, `role_id`, `com_pack`, `date_of_birth`, `gender`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Yes', NULL, NULL, 'Prediction', 'IT', '', 'perdictionit@gmail.com', NULL, '01324246893', NULL, '$2y$10$1dgz0EftKJcSnUw4aw/LLeCU8weeDcV/TKR.U8fjM5pmzbNhEBAve', NULL, 0, 0, 0, 0, NULL, NULL, '2021-12-01', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'No', NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2021-11-23', NULL, NULL, '2021-12-29 08:52:21', '2021-12-29 08:52:21'),
(4, NULL, NULL, 'Yes', 'Zara House', 'Alam', '', 'jara@gmail.com', NULL, '453454345345345345', NULL, '$2y$10$ySP4X87XGO5tJ5.t81Jls.pzYg2ioTXwKt.iXYT3fz4OwwX0K0a9C', 'uploads/profile_photos\\mahbub.jpg', 2, 0, 0, 0, '', NULL, '2021-12-01', NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'No', NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 'Premium', '2021-11-23', '0', NULL, '2021-11-28 01:07:18', '2021-11-28 01:07:18'),
(5, NULL, NULL, 'Yes', 'Prediction Learning Associates Ltd.', 'Ltd', 'PredictionLA', 'mahbubwebsoft@gmail.com', NULL, '+8801713334874', NULL, '$2y$10$/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W', 'uploads/logos\\logo (1).png', 1, 1, 1, 1, '', 'Yes', '2021-08-01', 100000, 'Yes', 10, '', '', '127.0.0.1', '127.0.0.1', '23.8218016', '90.4209962', '23.821801', '90.4209962', 'Yes', 'Automatic', 2, 0, NULL, NULL, NULL, NULL, 1, 'Premium', '2021-11-23', '0', '9Hbu74eFbUt33faoBqWJ48MaHAqLWfnlrmfBRyCYzPjTcTJtHkl7xga9WWm2', '2021-11-28 03:14:14', '2022-01-16 00:05:55'),
(6, NULL, 8, NULL, 'Tarek', 'Alam', 'tarekalam', 'rakibulhasan.rh890@gmail.com', NULL, '453454345345345345', NULL, '$2y$10$jtki9mhU26EHucxFRuXUHey4P5.LV/1JFjuxKho/tMm/q7wpllTp2', 'uploads/profile_photos\\mahbub.jpg', 1, 1, 1, 4, 'general', NULL, '2021-08-02', 7000000, NULL, 5, '1', '', 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Automatic', 2, 1, 1, 1, 1, 1, 2, 'Premium', '2021-11-23', 'Male', NULL, '2021-11-28 03:20:42', '2022-01-20 04:32:10'),
(7, NULL, 8, NULL, 'Majhar', 'Alam', '20294', 'mc4wq@gx5j.comaasdasd', NULL, '08499862579', NULL, '$2y$10$/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W', 'uploads/profile_photos\\mahbub.jpg', 1, 3, 4, 1, 'general', NULL, '2021/09/01', 300000, '', 10, NULL, '40', NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'No', NULL, 0, 1, 1, 1, 1, 1, 2, NULL, '2021-11-23', 'Male', NULL, '2021-11-29 04:56:16', '2022-01-20 04:19:42'),
(8, NULL, 6, NULL, 'Jowel', 'Alam', 'mahfujur', 'seriouslyserious247@gmail.com', NULL, '0849986257944444', NULL, '$2y$10$/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W', 'uploads/profile_photos\\mahbub.jpg', 1, 1, 1, 1, 'general', NULL, '2021-09-22', NULL, 'Yes', NULL, NULL, '42', NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'No', NULL, 0, 1, 1, 1, 1, 1, 2, NULL, '2021-11-23', 'Male', NULL, '2021-11-29 06:01:06', '2022-01-11 02:42:05'),
(10, NULL, 6, NULL, 'Maee', 'Al', 'mah', 'mc4wq@gx5j.com', NULL, '0849986257954444444', NULL, '$2y$10$/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W', 'uploads/profile_photos/1640240689.jpg', 1, 1, 1, 1, 'general', NULL, '2021-12-01', NULL, '', NULL, '1', '42', NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'No', NULL, 0, 1, 1, 1, 1, 1, 2, NULL, '2021-12-01', 'Male', NULL, '2021-11-30 01:10:01', '2021-12-23 00:24:49'),
(26, NULL, 6, NULL, 'Rotna', 'Al', 'mah', 'mcwewe4wq@gx5j.com', NULL, '0849986257954444444', NULL, '$2y$10$/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W', 'uploads/profile_photos\\avtr).jpg', 1, 1, 1, 1, 'general', NULL, '2021-12-01', NULL, '', NULL, '1', '42', NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'No', NULL, 0, 1, 1, 1, 1, 1, 2, NULL, '2021-12-01', 'Male', NULL, '2021-11-30 01:10:01', '2021-11-30 02:58:39'),
(27, NULL, 26, NULL, 'Marthgf', 'Al', 'mah', 'mcwewewe4wq@gx5j.com', NULL, '0849986257954444444', NULL, '$2y$10$/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W', 'uploads/profile_photos\\avtr).jpg', 1, 1, 1, 1, 'general', NULL, '2021-12-01', NULL, '', NULL, '1', '42', NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'No', NULL, 0, 1, 1, 1, 1, 1, 2, NULL, '2021-12-01', 'Male', NULL, '2021-11-30 01:10:01', '2021-11-30 02:58:39'),
(28, NULL, 26, NULL, 'REZA', 'Al', 'mah', 'mcweweweewe4wq@gx5j.com', NULL, '0849986257954444444', NULL, '$2y$10$/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W', 'uploads/profile_photos\\avtr).jpg', 1, 1, 1, 1, 'general', NULL, '2021-12-01', 500000, '', NULL, '1', '42', NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'No', NULL, 0, 1, 1, 1, 1, 1, 2, NULL, '2021-12-01', 'Male', NULL, '2021-11-30 01:10:01', '2022-01-20 04:23:22'),
(29, NULL, 7, NULL, 'Karim', 'Al', 'mah', 'mcweweweessswe4wq@gx5j.com', NULL, '0849986257954444444', NULL, '$2y$10$/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W', 'uploads/profile_photos\\avtr).jpg', 1, 1, 1, 1, 'general', NULL, '2021-12-01', NULL, '', NULL, '1', '42', NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'No', NULL, 0, 1, 1, 1, 1, 1, 2, NULL, '2021-12-01', 'Male', NULL, '2021-11-30 01:10:01', '2021-11-30 02:58:39'),
(31, NULL, 6, NULL, 'Aslam', 'Al', 'mah', 'mcwewesswsseessswe4wq@gx5j.com', NULL, '0849986257954444444', NULL, '$2y$10$/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W', 'uploads/profile_photos\\avtr).jpg', 1, 1, 1, 1, 'general', NULL, '2021-12-01', NULL, '', NULL, '1', '42', NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'No', NULL, 0, 1, 1, 1, 1, 1, 2, NULL, '2021-12-01', 'Male', NULL, '2021-11-30 01:10:01', '2021-11-30 02:58:39'),
(32, NULL, NULL, NULL, 'c', 'c', 'c', 'machbubwebsoft@gmail.com', NULL, '+8801734281290', NULL, '$2y$10$uJiko.j6COvzFWEkSKWN5ODYSQf6eyPGnE6HHzoZ/dsPNnu.yGF.2', 'uploads/profile_photos/1638957595.png', 1, 1, 1, 1, 'general', 'No', '2021-12-28', 0, '', NULL, NULL, '40', NULL, NULL, 'No', 'No', 'No', 'No', 'No', NULL, 0, 1, 1, 1, 1, 1, 2, NULL, '2021-12-15', 'Male', NULL, '2021-12-08 03:59:56', '2021-12-30 02:20:23'),
(33, NULL, NULL, NULL, 'd', 'd', 'd', 'mahbdubwebsoft@gmail.com', NULL, '+8801734281290', NULL, '$2y$10$I9jtpiaFVOeemknaX2OLsuRiSg/f24e2ClxeWak1NC7saBsiFVGwu', 'uploads/profile_photos/1638957885.jpg', 1, 1, 1, 1, 'general', 'No', '2021-12-27', NULL, '', NULL, NULL, '40', NULL, NULL, 'No', 'No', 'No', 'No', 'No', NULL, 0, 1, 1, 1, 1, 1, 2, NULL, '2021-12-14', 'Male', NULL, '2021-12-08 04:04:45', '2022-01-20 03:00:00'),
(34, NULL, NULL, NULL, 's', 's', 's', 'sahibakhatun@gmail.com', NULL, '33333333334', NULL, '$2y$10$Pa.lgHF5skNsRxIwrUWdv.7hX0jNpCD/GUGBhEOjs9KzTd631Ix26', 'uploads/profile_photos/1640852561.png', 1, 1, 0, 4, 'general', 'No', '2021-12-29', NULL, '', NULL, '1', '40', NULL, NULL, 'No', 'No', 'No', 'No', 'No', NULL, 0, 1, 1, 1, 1, 1, 7, NULL, '1994-06-30', 'Male', NULL, '2021-12-29 02:31:22', '2021-12-30 02:22:41'),
(36, NULL, NULL, 'Yes', 'qqqq', ' ', ' ', 'it@predictionla.com', NULL, '21321453233', NULL, '$2y$10$xZrhBXCALuLLQsA369VOCevI89WDAOTSPWVnV4TMIl7hkN7CII9XO', 'uploads/logos\\259401568_2063302520494858_4130558274730544292_n.jpg', 14, 0, 0, 0, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'No', NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 'Platinum', NULL, NULL, NULL, '2021-12-29 04:58:11', '2021-12-29 04:58:11'),
(37, NULL, NULL, NULL, 'Jack', 'Rozario', 'jackrozario', 'rozario@gmail.com', NULL, '7649034211433', NULL, '$2y$10$jfVyBmX5bEmQeZ08/wFBKuCrlrR3HE32eQ.piELkcy9boaWitK9Om', 'uploads/profile_photos/1640838490.png', 1, 1, 0, 4, 'general', 'No', '2021-12-30', 200000, '', NULL, NULL, NULL, NULL, NULL, 'No', 'No', 'No', 'No', 'Yes', NULL, 0, 1, 1, 1, 1, 1, 2, 'Platinum', '2021-12-01', 'Male', NULL, '2021-12-29 22:28:11', '2021-12-29 22:28:50'),
(38, NULL, NULL, NULL, 's', 's', 'wqwee', 'sahibakshatun@gmail.com', NULL, '345455322', NULL, '$2y$10$rlzN.rSh2MTiomqeI2s5SOT9aAdQIdIuRZknvLEEffCTGBGwDetYe', 'uploads/profile_photos/1641113116.png', 1, 1, 1, 4, 'general', 'No', '2022-01-02', NULL, '', NULL, NULL, NULL, NULL, NULL, 'No', 'No', 'No', 'No', 'Yes', 'Automatic', 0, 1, 1, 1, 1, 1, 2, 'Premium', '2022-01-21', 'Male', NULL, '2022-01-02 02:45:17', '2022-01-20 03:01:30'),
(39, NULL, NULL, NULL, 'jk', 'jk', 'admin', 'jk@dfdfd.com', NULL, '3454345532423', NULL, '$2y$10$vbacfQ6xBltLlwAm8cmYGOVgr4RNqnsoL.VhlBkvxdxNMCSD2rgKS', 'uploads/profile_photos/1641802181.png', 1, 1, 0, 4, 'general', 'No', '2022-01-10', 200000, '', NULL, NULL, NULL, NULL, NULL, 'No', 'No', 'No', 'No', 'Yes', 'Automatic', 2, 1, 1, 1, 1, 1, 2, 'Premium', '2022-01-11', 'Male', NULL, '2022-01-10 02:08:34', '2022-01-10 02:10:58'),
(48, NULL, NULL, 'Yes', 'City One', ' ', ' ', 'cityone@gmail.com', NULL, '547788456238845', NULL, '$2y$10$hWwoq5L00nNcgAeB3FdRXuCg3iNvVvSNMwjlLZqkGM3n/ucDixE3C', 'uploads/logos\\multicolored-gas-cylinders-isolated.jpg', 19, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Platinum', NULL, NULL, NULL, '2022-01-12 06:02:01', '2022-01-12 06:02:01'),
(49, NULL, NULL, 'Yes', 'abc', ' ', ' ', 'perdictionitabc@gmail.com', NULL, '784563463634', NULL, '$2y$10$eCIdwrVVLZ9KkopjNsCZYuGdlLDiOtkJh6FPidU/5k2kNTKiYqbAO', 'uploads/logos\\multicolored-gas-cylinders-isolated.jpg', 20, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Platinum', NULL, NULL, NULL, '2022-01-12 06:33:34', '2022-01-12 06:33:34');

-- --------------------------------------------------------

--
-- Table structure for table `variable_methods`
--

CREATE TABLE `variable_methods` (
  `id` bigint(20) NOT NULL,
  `variable_method_com_id` bigint(20) NOT NULL,
  `variable_method_category` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `variable_method_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `variable_methods`
--

INSERT INTO `variable_methods` (`id`, `variable_method_com_id`, `variable_method_category`, `variable_method_name`, `created_at`, `updated_at`) VALUES
(5, 1, 'Arrangement', 'Traveling', '2022-01-17 00:56:54', '2022-01-17 01:17:58'),
(6, 1, 'Payment', 'Cash', '2022-01-17 00:57:23', '2022-01-17 00:57:23'),
(7, 1, 'Payment', 'Cheque', '2022-01-17 00:58:43', '2022-01-17 00:58:43'),
(8, 1, 'Payment', 'Transfer', '2022-01-17 00:59:00', '2022-01-17 00:59:00'),
(9, 1, 'Qualification', 'Msc', '2022-01-17 00:59:59', '2022-01-17 00:59:59'),
(10, 1, 'Qualification', 'Mcom', '2022-01-17 01:00:09', '2022-01-17 01:00:09'),
(11, 1, 'Qualification', 'MBA', '2022-01-17 01:00:24', '2022-01-17 01:00:24'),
(12, 1, 'Qualification', 'Bsc', '2022-01-17 01:00:36', '2022-01-17 01:00:36'),
(13, 1, 'Qualification', 'Bcom', '2022-01-17 01:00:47', '2022-01-17 01:00:47'),
(14, 1, 'Qualification', 'BBA', '2022-01-17 01:00:55', '2022-01-17 01:00:55'),
(15, 1, 'Qualification', 'SSC', '2022-01-17 01:01:05', '2022-01-17 01:01:05'),
(16, 1, 'Qualification', 'HSC', '2022-01-17 01:01:16', '2022-01-17 01:01:16'),
(17, 1, 'Job', 'Entry Level', '2022-01-17 01:01:52', '2022-01-17 01:01:52'),
(18, 1, 'Job', 'Mid Level', '2022-01-17 01:02:04', '2022-01-17 01:02:04'),
(19, 1, 'Job', 'Expert', '2022-01-17 01:02:18', '2022-01-17 01:02:18');

-- --------------------------------------------------------

--
-- Table structure for table `variable_types`
--

CREATE TABLE `variable_types` (
  `id` bigint(20) NOT NULL,
  `variable_type_com_id` bigint(20) NOT NULL,
  `variable_type_category` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `variable_type_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `variable_types`
--

INSERT INTO `variable_types` (`id`, `variable_type_com_id`, `variable_type_category`, `variable_type_name`, `created_at`, `updated_at`) VALUES
(5, 1, 'Award', 'Best Seller of the Month', '2022-01-16 23:32:10', '2022-01-16 23:47:52'),
(6, 1, 'Warning', 'Varbal', '2022-01-16 23:33:06', '2022-01-16 23:46:42'),
(7, 1, 'Warning', 'Written', '2022-01-16 23:33:23', '2022-01-16 23:33:23'),
(8, 1, 'Warning', 'Show Cause', '2022-01-16 23:34:21', '2022-01-16 23:34:21'),
(9, 1, 'Termination', 'Disciplinary', '2022-01-16 23:34:37', '2022-01-16 23:47:05'),
(10, 1, 'Job-Status', 'Full Time', '2022-01-16 23:35:32', '2022-01-16 23:35:32'),
(11, 1, 'Job-Status', 'Part Time', '2022-01-16 23:35:45', '2022-01-16 23:35:45');

-- --------------------------------------------------------

--
-- Table structure for table `warnings`
--

CREATE TABLE `warnings` (
  `id` bigint(20) NOT NULL,
  `warning_com_id` bigint(20) NOT NULL,
  `warning_department_id` bigint(20) NOT NULL,
  `warning_employee_id` bigint(20) NOT NULL,
  `warning_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warning_subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warning_desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `warning_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warning_status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warnings`
--

INSERT INTO `warnings` (`id`, `warning_com_id`, `warning_department_id`, `warning_employee_id`, `warning_type`, `warning_subject`, `warning_desc`, `warning_date`, `warning_status`, `created_at`, `updated_at`) VALUES
(3, 1, 1, 6, 'Varbal', 'asfdass2', 'hjki', '2022-01-20', 'Solved', '2022-01-22 00:26:59', '2022-01-22 00:26:59');

-- --------------------------------------------------------

--
-- Table structure for table `work_experiences`
--

CREATE TABLE `work_experiences` (
  `id` bigint(20) NOT NULL,
  `work_experience_com_id` bigint(20) NOT NULL,
  `work_experience_employee_id` bigint(20) NOT NULL,
  `work_experience_company_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `work_experience_from_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `work_experience_to_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `work_experience_post` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `work_experience_desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `work_experiences`
--

INSERT INTO `work_experiences` (`id`, `work_experience_com_id`, `work_experience_employee_id`, `work_experience_company_name`, `work_experience_from_date`, `work_experience_to_date`, `work_experience_post`, `work_experience_desc`, `created_at`, `updated_at`) VALUES
(2, 1, 6, 'dssdasfd2', '2022-01-27', '2022-01-24', 'fdasfdas2', 'werEWasc', '2022-01-15 04:30:37', '2022-01-15 04:30:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allowance_heads`
--
ALTER TABLE `allowance_heads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_categories`
--
ALTER TABLE `asset_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendances_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `attendance_locations`
--
ALTER TABLE `attendance_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `awards`
--
ALTER TABLE `awards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commissions`
--
ALTER TABLE `commissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_calendars`
--
ALTER TABLE `company_calendars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_houses`
--
ALTER TABLE `db_houses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emergency_contacts`
--
ALTER TABLE `emergency_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `festival_bonuses`
--
ALTER TABLE `festival_bonuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file_configs`
--
ALTER TABLE `file_configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file_managers`
--
ALTER TABLE `file_managers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `immigrants`
--
ALTER TABLE `immigrants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `latetime_configs`
--
ALTER TABLE `latetime_configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `late_times`
--
ALTER TABLE `late_times`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leaves_company_id_foreign` (`leaves_company_id`),
  ADD KEY `leaves_employee_id_foreign` (`leaves_employee_id`),
  ADD KEY `leaves_leave_type_id_foreign` (`leaves_leave_type_id`),
  ADD KEY `leaves_department_id_foreign` (`leaves_department_id`);

--
-- Indexes for table `leave_types`
--
ALTER TABLE `leave_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monthly_attendances`
--
ALTER TABLE `monthly_attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `office_shifts`
--
ALTER TABLE `office_shifts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `office_shifts_company_id_foreign` (`office_shift_com_id`);

--
-- Indexes for table `other_payments`
--
ALTER TABLE `other_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `overtime_configs`
--
ALTER TABLE `overtime_configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `over_times`
--
ALTER TABLE `over_times`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pay_slips`
--
ALTER TABLE `pay_slips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pensions`
--
ALTER TABLE `pensions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `policies`
--
ALTER TABLE `policies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `policies_company_id_foreign` (`policy_com_id`),
  ADD KEY `policies_added_by_foreign` (`policy_added_by`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `providentfund_bankaccounts`
--
ALTER TABLE `providentfund_bankaccounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `providentfund_configs`
--
ALTER TABLE `providentfund_configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `providentfund_members`
--
ALTER TABLE `providentfund_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `providentfund_reports`
--
ALTER TABLE `providentfund_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provident_funds`
--
ALTER TABLE `provident_funds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qualifications`
--
ALTER TABLE `qualifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resignations`
--
ALTER TABLE `resignations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary_configs`
--
ALTER TABLE `salary_configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_profiles`
--
ALTER TABLE `social_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statutory_deductions`
--
ALTER TABLE `statutory_deductions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_modules`
--
ALTER TABLE `sub_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax_configs`
--
ALTER TABLE `tax_configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terminations`
--
ALTER TABLE `terminations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `territories`
--
ALTER TABLE `territories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `towns`
--
ALTER TABLE `towns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `travel`
--
ALTER TABLE `travel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `variable_methods`
--
ALTER TABLE `variable_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `variable_types`
--
ALTER TABLE `variable_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warnings`
--
ALTER TABLE `warnings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_experiences`
--
ALTER TABLE `work_experiences`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allowance_heads`
--
ALTER TABLE `allowance_heads`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `asset_categories`
--
ALTER TABLE `asset_categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `attendance_locations`
--
ALTER TABLE `attendance_locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `awards`
--
ALTER TABLE `awards`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `commissions`
--
ALTER TABLE `commissions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `company_calendars`
--
ALTER TABLE `company_calendars`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `db_houses`
--
ALTER TABLE `db_houses`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `emergency_contacts`
--
ALTER TABLE `emergency_contacts`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `festival_bonuses`
--
ALTER TABLE `festival_bonuses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `file_configs`
--
ALTER TABLE `file_configs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `file_managers`
--
ALTER TABLE `file_managers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `immigrants`
--
ALTER TABLE `immigrants`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `latetime_configs`
--
ALTER TABLE `latetime_configs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `late_times`
--
ALTER TABLE `late_times`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `leave_types`
--
ALTER TABLE `leave_types`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `monthly_attendances`
--
ALTER TABLE `monthly_attendances`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `office_shifts`
--
ALTER TABLE `office_shifts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `other_payments`
--
ALTER TABLE `other_payments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `overtime_configs`
--
ALTER TABLE `overtime_configs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `over_times`
--
ALTER TABLE `over_times`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pay_slips`
--
ALTER TABLE `pay_slips`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `pensions`
--
ALTER TABLE `pensions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `policies`
--
ALTER TABLE `policies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `providentfund_bankaccounts`
--
ALTER TABLE `providentfund_bankaccounts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `providentfund_configs`
--
ALTER TABLE `providentfund_configs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `providentfund_members`
--
ALTER TABLE `providentfund_members`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `providentfund_reports`
--
ALTER TABLE `providentfund_reports`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `provident_funds`
--
ALTER TABLE `provident_funds`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `qualifications`
--
ALTER TABLE `qualifications`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `resignations`
--
ALTER TABLE `resignations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `salary_configs`
--
ALTER TABLE `salary_configs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `social_profiles`
--
ALTER TABLE `social_profiles`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `statutory_deductions`
--
ALTER TABLE `statutory_deductions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_modules`
--
ALTER TABLE `sub_modules`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tax_configs`
--
ALTER TABLE `tax_configs`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `terminations`
--
ALTER TABLE `terminations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `territories`
--
ALTER TABLE `territories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `towns`
--
ALTER TABLE `towns`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `travel`
--
ALTER TABLE `travel`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `variable_methods`
--
ALTER TABLE `variable_methods`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `variable_types`
--
ALTER TABLE `variable_types`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `warnings`
--
ALTER TABLE `warnings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `work_experiences`
--
ALTER TABLE `work_experiences`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
