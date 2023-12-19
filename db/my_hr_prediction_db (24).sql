-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2022 at 12:28 PM
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
(137, 5, 1, '2022-01-03', '11:09:58', '127.0.0.1', '11:20:38', '127.0.0.1', '23.8126469', '23.8126469', '90.4107072', '90.4107072', 1, '02:9:58', '06:39:22', '00:00', '00:00', '00:00', 'Present', '2022-01-02 23:09:58', '2022-01-02 23:20:38');

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
(4, 1, 7, 'Project-Bonus', 'dsss', 'dfdf', '2021-10-01', 12000, '2021-12-28 05:42:56', '2021-12-28 05:42:56');

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

INSERT INTO `companies` (`id`, `company_name`, `company_email`, `company_password`, `company_phone`, `company_city`, `company_country`, `company_package`, `company_logo`, `created_at`, `updated_at`) VALUES
(1, 'Prediction Learning Associates Ltd', 'info@predictionla.com', '', '+8801713334874', 'Dhaka', 'Bangladesh', 'Premium', 'uploads/logos\\logo (1).png', '2021-11-28 08:48:38', '2021-12-02 02:12:46'),
(2, 'Walton', NULL, '', NULL, NULL, NULL, 'General', NULL, '2021-11-28 08:48:38', '2021-11-28 08:48:38'),
(14, 'qqqq', 'it@predictionla.com', '12345678', '21321453233', 'Dhaka', 'Bangladesh', 'Platinum', 'uploads/logos\\259401568_2063302520494858_4130558274730544292_n.jpg', '2021-12-29 04:58:11', '2021-12-29 04:58:11');

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
(4, 1, 3, 'HR manager', '2021-12-05 23:44:27', '2021-12-05 23:44:27');

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
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` int(10) NOT NULL,
  `holiday_com_id` int(10) DEFAULT NULL,
  `holiday_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `holiday_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `holiday_number` int(11) DEFAULT NULL,
  `start_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id`, `holiday_com_id`, `holiday_type`, `holiday_name`, `holiday_number`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(72, 1, 'Weekly-Holiday', 'Fri', 5, NULL, NULL, '2021-12-14 03:38:26', '2021-12-14 03:46:16');

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
(3, 1, 5, '2021-12-03', '2022-01-02 23:09:58', '2022-01-02 23:09:58');

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
(2, 1, 5, '2021-11', '2021-12-13', 'sss1', '12000', 'Home-Development', '20', '10000001', '20', '500000.05', 'rewrerer1', '2021-12-26 03:56:42', '2021-12-26 05:34:45');

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
(91, 5, '2022-01-05 04:21:08', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.110 Safari\\/537.36\"}');

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
(14, 1, 5, '2021-12-01', '2021-12-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'P', 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-12-13 05:21:26', '2022-01-05 04:22:16'),
(15, 1, 5, '2022-01-01', '2022-01-01', 'P', 'P', 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-01 01:26:02', '2022-01-02 23:20:38');

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

INSERT INTO `pay_slips` (`id`, `pay_slip_key`, `pay_slip_number`, `pay_slip_employee_id`, `pay_slip_com_id`, `pay_slip_payment_type`, `pay_slip_payment_date`, `pay_slip_gross_salary`, `pay_slip_basic_salary`, `pay_slip_net_salary`, `pay_slip_house_rent`, `pay_slip_medical_allowance`, `pay_slip_conveyance_allowance`, `pay_slip_festival_bonus`, `pay_slip_commissions`, `pay_slip_loans`, `pay_slip_tax_deduction`, `pay_slip_statutory_deduction`, `pay_slip_provident_fund`, `pay_slip_overtimes`, `pay_slip_other_payments`, `pay_slip_pension_type`, `pay_slip_pension_amount`, `pay_slip_working_days`, `pay_slip_status`, `pay_slip_month_year`, `created_at`, `updated_at`) VALUES
(8, '2YK4xFLYNs5', '693108331663045', 5, 1, 'Monthly', '2022-01-04', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-04 02:07:25', '2022-01-04 02:07:25'),
(9, 'tgfhgfhbfxdzfsdfhjdfgdrfs', '894346590420135', 5, 1, 'Monthly', '2022-01-04', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-04 02:15:48', '2022-01-04 02:15:48'),
(10, 'fjgfgngfgngfdfrstrgvf', '817089558256645', 5, 1, 'Monthly', '2022-01-04', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-04 02:16:19', '2022-01-04 02:16:19'),
(11, 'jonLjGOB92j98ppT9JGfs5uqrkBOum5', '953628772023725', 5, 1, 'Monthly', '2022-01-04', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-04 02:16:37', '2022-01-04 02:16:37'),
(12, 'gjghfcbhghfdkjfyhgcfntgf', '7797021974785', 5, 1, 'Monthly', '2022-01-04', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-04 02:16:56', '2022-01-04 02:16:56'),
(13, 'tgfhjgfdbmjtyuudfdzfsg', '438160068931795', 5, 1, 'Monthly', '2022-01-04', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-04 02:17:18', '2022-01-04 02:17:18'),
(14, 'Ca29srvH3Cf5CzQByWLNAMuKV5', '980232704258485', 5, 1, 'Monthly', '2022-01-04', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-04 02:17:48', '2022-01-04 02:17:48'),
(15, 'xU4167uqdnLk7qcbZ1x5heLHp5', '956437119084465', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-04 21:56:48', '2022-01-04 21:56:48'),
(16, 'awgLN4vFqe0R5FV23p1nlS3HL5', '194962571358065', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-04 21:58:29', '2022-01-04 21:58:29'),
(17, 'NXPoYcKRRnouHozI2a1Vp2aRN5', '622731948344825', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-04 22:30:00', '2022-01-04 22:30:00'),
(18, 'lZjcJuiqZh6aTt8Jis23taRTU5', '446703085639835', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-04 22:31:22', '2022-01-04 22:31:22'),
(19, 'Si2XrqAx4Kye98SNh9Jomyywk5', '25530528276255', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 03:18:28', '2022-01-05 03:18:28'),
(20, 'v4XOthL9gj6Vth6DmTzszlrdb5', '452222754801215', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 03:19:07', '2022-01-05 03:19:07'),
(21, 'CmZHTnl9DDehTWCWZiIkCNfXZ5', '514808356253735', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 03:21:26', '2022-01-05 03:21:26'),
(22, 'BsSw4jLkPOzCdoJ5f76ECDdwb5', '966214032843865', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 03:22:00', '2022-01-05 03:22:00'),
(23, '1Tc7G4ItZGDQ8CjQFZ8f2chD85', '171184293922795', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 03:22:52', '2022-01-05 03:22:52'),
(24, 'm5u8Opc0Pcf9rz0Lw4r3YNG5L5', '786370725679595', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 03:23:33', '2022-01-05 03:23:33'),
(25, 'Tt1FIsqKPPyRgutQQURYG5rRc5', '846279926457215', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 03:23:49', '2022-01-05 03:23:49'),
(26, 'jUaUZGgE6dLwY4UKhazbrI4PA5', '729897662022375', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 04:22:16', '2022-01-05 04:22:16'),
(27, '4HYuoouYzCgrun7tgbp09UBxQ5', '935229344190645', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 04:23:03', '2022-01-05 04:23:03'),
(28, 'WgWEG4T7QjJ6wqooG0RDkHj5o5', '365442568269765', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 04:23:36', '2022-01-05 04:23:36'),
(29, 'UuCwT6GTvTnU19f3pO40ocxV85', '72703704205445', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 04:24:07', '2022-01-05 04:24:07'),
(30, 'WkPMVwOH9d3RtM7v0L8WZ2X0A5', '45182056839555', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 04:25:23', '2022-01-05 04:25:23'),
(31, 'mJ8uMf7CdqEv7qmgUtzY1Byzm5', '399828966710315', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 04:26:46', '2022-01-05 04:26:46'),
(32, 'HlLXSnuMZBNh0ojNpTcTBqKvQ5', '177859546886295', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 04:30:32', '2022-01-05 04:30:32'),
(33, 'C8U6ogfuXGTzMzYwKUDXaOYvC5', '204301130534315', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 04:31:06', '2022-01-05 04:31:06'),
(34, 'XYOMsPXC36E05nOJ7cwt67mVv5', '319617480219765', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 04:37:15', '2022-01-05 04:37:15'),
(35, 'hfn2LooV8sVVxAfa2rNbg2Jo55', '567218760110105', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 04:37:36', '2022-01-05 04:37:36'),
(36, 'YrxOpzD2ltsKPYAuLtafjzbG15', '108042870401765', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 04:39:42', '2022-01-05 04:39:42'),
(37, 'auZRtY2ukYdJtjEOgYLMhH2bb5', '115436278841025', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 04:40:55', '2022-01-05 04:40:55'),
(38, 'D30xNuE9os8j8kNGdOZpsGFnw5', '877834790553015', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 04:41:13', '2022-01-05 04:41:13'),
(39, 'KidML4iI8VMdTxzeR5yyKKbQU5', '922929695368375', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 04:41:48', '2022-01-05 04:41:48'),
(40, 'VOdjxYl6OGKDnZHj0wiRFpY7u5', '440719584476165', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 04:42:20', '2022-01-05 04:42:20'),
(41, 'OLqeCZXZ50R8pfgydbSJhLJw55', '43206163440615', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 04:42:50', '2022-01-05 04:42:50'),
(42, 'KdqqFWJOfv9U7HxXG6XzxmtTV5', '160216619350235', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 04:43:24', '2022-01-05 04:43:24'),
(43, 'Ak5ZeGcoRGOUZPLprkVPX4WlP5', '690138291967735', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 04:44:04', '2022-01-05 04:44:04'),
(44, 'yvG4CPIcRBaP4nNfXIBZmOfSd5', '894252417424625', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 04:45:45', '2022-01-05 04:45:45'),
(45, 'KZoefvb9VbJCAGvrwQZuRCik45', '602647246283485', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 04:46:13', '2022-01-05 04:46:13'),
(46, 'QZz6Bjd9wtjYB3AJ1U0AfwsiX5', '714160594286445', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 04:50:22', '2022-01-05 04:50:22'),
(47, 'mwZaqMl80EVMdDO2Tb8x2AhHL5', '310622873183535', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 04:52:37', '2022-01-05 04:52:37'),
(48, 'TGQAuFlU9KmRdK7SAMZQfOM4N5', '541115698981885', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 04:53:49', '2022-01-05 04:53:49'),
(49, 'McEjgs2DGboiDEXZV8abC2y8J5', '720840275778315', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 04:54:19', '2022-01-05 04:54:19'),
(50, 'VoH4HQD3JxMkB52YZqVFSQ0065', '1834363289775', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 04:54:32', '2022-01-05 04:54:32'),
(51, 'lV6nu975hYaFAoqHlCI0Jkkhy5', '16677091911845', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 04:56:58', '2022-01-05 04:56:58'),
(52, 'o4wVKhpYZdswSoBvhHxandSxV5', '55029338924265', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 05:01:10', '2022-01-05 05:01:10'),
(53, 'xmhBtRLG0BNxJMuNA9Pu8OJBn5', '131020976392055', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 05:01:19', '2022-01-05 05:01:19'),
(54, 'G2NBzhYY8yw988cmBjAYvYS6n5', '590261383111305', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 05:01:55', '2022-01-05 05:01:55'),
(55, '3uKxvFX9q5MFyjaH2Ajj8FiA05', '472911801258535', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 05:04:59', '2022-01-05 05:04:59'),
(56, '0wBiKZDf1BWQinKblSUkVDhVD5', '43349438614725', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 05:08:04', '2022-01-05 05:08:04'),
(57, '1hTnMuYIfhxW2rA2UgN5yfWTQ5', '278116157879475', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 05:08:35', '2022-01-05 05:08:35'),
(58, 'AW46tJLd1ivYG5Bx2glxuIjpi5', '743731561188325', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 05:09:11', '2022-01-05 05:09:11'),
(59, 'OIMTaP8jeohY7WYIvPtqsRwLk5', '379381024500815', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 05:09:49', '2022-01-05 05:09:49'),
(60, 'TiNfhof46LKJhKmn0DFCQHzdH5', '680066352680695', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 05:11:16', '2022-01-05 05:11:16'),
(61, 'lIVDefRVi8xZdAmGquWufwWft5', '278472216800305', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 05:13:34', '2022-01-05 05:13:34'),
(62, '1xnfqxRHrun5jxfyutXjxaXvF5', '599641267044065', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 05:14:14', '2022-01-05 05:14:14'),
(63, 'm0xiLHShH9oGc0xkpJ77W2ii85', '945878172405995', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 05:17:42', '2022-01-05 05:17:42'),
(64, 'OcSC6Jc9zKJ0H7X3UvWUMjuw45', '370000531497205', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 05:19:08', '2022-01-05 05:19:08'),
(65, '8y3xDj5kHZdcAAON3TT9bGwWx5', '623206384573595', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 05:19:27', '2022-01-05 05:19:27'),
(66, 'dXyx9aNjHHdVVt13fRY2rugWu5', '502105479448215', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 05:21:07', '2022-01-05 05:21:07'),
(67, 'ACJatT9drgpnMXvif2ZBmknIU5', '521747481380115', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 05:21:19', '2022-01-05 05:21:19'),
(68, 'qzgwuwjDWUucfcDVSFDUQgBqx5', '550145626465285', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 05:22:42', '2022-01-05 05:22:42'),
(69, 'KH15bUMYYTcr7kdlA9n3F4GvA5', '436239159066655', 5, 1, 'Monthly', '2022-01-05', '100000', '9677.4193548387', '48677.419354839', '30000', '5000', '5000', '0', '0', '1000', '0', '0', '0', '0', '0', NULL, NULL, 5, 1, '2021-12-01', '2022-01-05 05:23:33', '2022-01-05 05:23:33');

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
(2, 1, '10', 'Robot Project', 'High', 'Mr. Hasan', '2021-12-13', '2022-01-27', '30', '2021-12-23 01:40:27', '2021-12-23 02:28:52'),
(4, 1, '7', 'Robot Project', 'High', 'Mr. Hasan', '2021-12-29', '2021-12-30', '1%', '2021-12-27 00:11:39', '2021-12-27 00:11:39');

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
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) NOT NULL,
  `task_com_id` bigint(20) NOT NULL,
  `task_assigned_to` bigint(20) NOT NULL,
  `task_title` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_start_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_end_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_assigned_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_progress` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `task_com_id`, `task_assigned_to`, `task_title`, `task_start_date`, `task_end_date`, `task_assigned_by`, `task_progress`, `created_at`, `updated_at`) VALUES
(1, 1, 10, 'fgd', 'fd', 'bgfvd', 'Prediction Learning Associates Ltd', 'gbf', '2021-12-23 03:13:23', '2021-12-23 03:13:23'),
(2, 1, 10, 'erfdefdef', '2021-12-21', '2021-12-30', 'Prediction Learning Associates Ltd', 'erfef', '2021-12-23 03:16:32', '2021-12-23 03:16:32');

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
  `user_over_time_rate` int(10) NOT NULL,
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

INSERT INTO `users` (`id`, `super_system_admin`, `report_to_parent_id`, `company_profile`, `first_name`, `last_name`, `username`, `email`, `email_verified_at`, `phone`, `password`, `profile_photo`, `com_id`, `department_id`, `designation_id`, `office_shift_id`, `attendance_type`, `attendance_status`, `joining_date`, `gross_salary`, `user_provident_fund`, `is_active`, `login_location_id`, `check_in_ip`, `check_out_ip`, `check_in_latitude`, `check_in_longitude`, `check_out_latitude`, `check_out_longitude`, `over_time_payable`, `user_over_time_type`, `user_over_time_rate`, `region_id`, `area_id`, `territory_id`, `town_id`, `db_house_id`, `role_id`, `com_pack`, `date_of_birth`, `gender`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Yes', NULL, NULL, 'Prediction', 'IT', '', 'perdictionit@gmail.com', NULL, '01324246893', '$2y$10$1dgz0EftKJcSnUw4aw/LLeCU8weeDcV/TKR.U8fjM5pmzbNhEBAve', NULL, 0, 0, 0, 0, NULL, NULL, '2021-12-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'No', NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, '2021-12-29 08:52:21', '2021-12-29 08:52:21'),
(4, NULL, NULL, 'Yes', 'Zara House', 'Alam', '', 'jara@gmail.com', NULL, '453454345345345345', '$2y$10$ySP4X87XGO5tJ5.t81Jls.pzYg2ioTXwKt.iXYT3fz4OwwX0K0a9C', 'uploads/profile_photos\\mahbub.jpg', 2, 0, 0, 0, '', NULL, '2021-12-01', NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'No', NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 'Premium', '', '0', NULL, '2021-11-28 01:07:18', '2021-11-28 01:07:18'),
(5, NULL, NULL, 'Yes', 'Prediction Learning Associates', 'Ltd', 'PredictionLA', 'info@predictionla.com', NULL, '+8801713334874', '$2y$10$/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W', 'uploads/logos\\logo (1).png', 1, 1, 1, 1, '', 'Yes', '2021-12-01', 100000, NULL, '', '', '127.0.0.1', '127.0.0.1', '23.8218016', '90.4209962', '23.821801', '90.4209962', 'Yes', 'Automatic', 2, 0, NULL, NULL, NULL, NULL, 1, 'Premium', '', '0', 'or83mL3oNEe2UynSEChmRBxCoG0lSsMaiQJUC9D1S0eJ5t0Nrogpr6GmHtHF', '2021-11-28 03:14:14', '2021-12-02 05:46:14'),
(6, NULL, 5, NULL, 'Tarek', 'Alam', '', 'oxlo4@mofc.com', NULL, '453454345345345345', '$2y$10$jtki9mhU26EHucxFRuXUHey4P5.LV/1JFjuxKho/tMm/q7wpllTp2', 'uploads/profile_photos\\mahbub.jpg', 1, 1, 1, 0, '', NULL, '2021-12-01', 100, 5, '', '', 'No', 'No', 'No', 'No', 'No', 'No', 'No', NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 'Premium', '', '0', NULL, '2021-11-28 03:20:42', '2021-11-28 03:20:42'),
(7, NULL, 32, NULL, 'Majhar', 'Alam', '20294', 'mc4wq@gx5j.comaasdasd', NULL, '08499862579', '$2y$10$/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W', 'uploads/profile_photos\\mahbub.jpg', 1, 1, 1, 1, 'general', NULL, '2021/09/01', 200000, 10, NULL, '40', NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'No', NULL, 0, 1, 1, 1, 1, 1, 2, NULL, '3542355', 'Male', NULL, '2021-11-29 04:56:16', '2021-12-30 02:40:19'),
(8, NULL, 6, NULL, 'Jowel', 'Alam', 'mahfujur', 'mc4wqeeeeeeee@gx5j.com', NULL, '0849986257944444', '$2y$10$/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W', 'uploads/profile_photos\\mahbub.jpg', 1, 1, 1, 1, 'general', NULL, '2021-11-22', NULL, NULL, NULL, '42', NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'No', NULL, 0, 1, 1, 1, 1, 1, 2, NULL, '2021-11-23', 'Male', NULL, '2021-11-29 06:01:06', '2021-11-29 06:01:06'),
(10, NULL, 6, NULL, 'Maee', 'Al', 'mah', 'mc4wq@gx5j.com', NULL, '0849986257954444444', '$2y$10$/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W', 'uploads/profile_photos/1640240689.jpg', 1, 1, 1, 1, 'general', NULL, '2021-12-01', NULL, NULL, '1', '42', NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'No', NULL, 0, 1, 1, 1, 1, 1, 2, NULL, '2021-12-01', 'Male', NULL, '2021-11-30 01:10:01', '2021-12-23 00:24:49'),
(26, NULL, 6, NULL, 'Rotna', 'Al', 'mah', 'mcwewe4wq@gx5j.com', NULL, '0849986257954444444', '$2y$10$/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W', 'uploads/profile_photos\\avtr).jpg', 1, 1, 1, 1, 'general', NULL, '2021-12-01', NULL, NULL, '1', '42', NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'No', NULL, 0, 1, 1, 1, 1, 1, 2, NULL, '2021-12-01', 'Male', NULL, '2021-11-30 01:10:01', '2021-11-30 02:58:39'),
(27, NULL, 26, NULL, 'Marthgf', 'Al', 'mah', 'mcwewewe4wq@gx5j.com', NULL, '0849986257954444444', '$2y$10$/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W', 'uploads/profile_photos\\avtr).jpg', 1, 1, 1, 1, 'general', NULL, '2021-12-01', NULL, NULL, '1', '42', NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'No', NULL, 0, 1, 1, 1, 1, 1, 2, NULL, '2021-12-01', 'Male', NULL, '2021-11-30 01:10:01', '2021-11-30 02:58:39'),
(28, NULL, 26, NULL, 'REZA', 'Al', 'mah', 'mcweweweewe4wq@gx5j.com', NULL, '0849986257954444444', '$2y$10$/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W', 'uploads/profile_photos\\avtr).jpg', 1, 1, 1, 1, 'general', NULL, '2021-12-01', NULL, NULL, '1', '42', NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'No', NULL, 0, 1, 1, 1, 1, 1, 2, NULL, '2021-12-01', 'Male', NULL, '2021-11-30 01:10:01', '2021-11-30 02:58:39'),
(29, NULL, 7, NULL, 'Karim', 'Al', 'mah', 'mcweweweessswe4wq@gx5j.com', NULL, '0849986257954444444', '$2y$10$/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W', 'uploads/profile_photos\\avtr).jpg', 1, 1, 1, 1, 'general', NULL, '2021-12-01', NULL, NULL, '1', '42', NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'No', NULL, 0, 1, 1, 1, 1, 1, 2, NULL, '2021-12-01', 'Male', NULL, '2021-11-30 01:10:01', '2021-11-30 02:58:39'),
(30, NULL, 7, NULL, 'Tarek', 'Al', 'mah', 'mcwewewsseessswe4wq@gx5j.com', NULL, '0849986257954444444', '$2y$10$/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W', 'uploads/profile_photos\\avtr).jpg', 1, 1, 1, 1, 'general', NULL, '2021-12-01', NULL, NULL, '1', '42', NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'No', NULL, 0, 1, 1, 1, 1, 1, 2, NULL, '2021-12-01', 'Male', NULL, '2021-11-30 01:10:01', '2021-11-30 02:58:39'),
(31, NULL, 6, NULL, 'Aslam', 'Al', 'mah', 'mcwewesswsseessswe4wq@gx5j.com', NULL, '0849986257954444444', '$2y$10$/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W', 'uploads/profile_photos\\avtr).jpg', 1, 1, 1, 1, 'general', NULL, '2021-12-01', NULL, NULL, '1', '42', NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'No', NULL, 0, 1, 1, 1, 1, 1, 2, NULL, '2021-12-01', 'Male', NULL, '2021-11-30 01:10:01', '2021-11-30 02:58:39'),
(32, NULL, NULL, NULL, 'c', 'c', 'c', 'machbubwebsoft@gmail.com', NULL, '+8801734281290', '$2y$10$uJiko.j6COvzFWEkSKWN5ODYSQf6eyPGnE6HHzoZ/dsPNnu.yGF.2', 'uploads/profile_photos/1638957595.png', 1, 1, 1, 1, 'general', 'No', '2021-12-28', 0, NULL, NULL, '40', NULL, NULL, 'No', 'No', 'No', 'No', 'No', NULL, 0, 1, 1, 1, 1, 1, 2, NULL, '2021-12-15', 'Male', NULL, '2021-12-08 03:59:56', '2021-12-30 02:20:23'),
(33, NULL, NULL, NULL, 'd', 'd', 'd', 'mahbdubwebsoft@gmail.com', NULL, '+8801734281290', '$2y$10$I9jtpiaFVOeemknaX2OLsuRiSg/f24e2ClxeWak1NC7saBsiFVGwu', 'uploads/profile_photos/1638957885.jpg', 1, 3, 1, 1, 'general', 'No', '2021-12-27', NULL, NULL, NULL, '40', NULL, NULL, 'No', 'No', 'No', 'No', 'No', NULL, 0, 1, 1, 1, 1, 1, 2, NULL, '2021-12-14', 'Male', NULL, '2021-12-08 04:04:45', '2021-12-08 04:04:45'),
(34, NULL, NULL, NULL, 's', 's', 's', 'sahibakhatun@gmail.com', NULL, '33333333334', '$2y$10$Pa.lgHF5skNsRxIwrUWdv.7hX0jNpCD/GUGBhEOjs9KzTd631Ix26', 'uploads/profile_photos/1640852561.png', 1, 1, 0, 4, 'general', 'No', '2021-12-29', NULL, NULL, '1', '40', NULL, NULL, 'No', 'No', 'No', 'No', 'No', NULL, 0, 1, 1, 1, 1, 1, 7, NULL, '1994-06-30', 'Male', NULL, '2021-12-29 02:31:22', '2021-12-30 02:22:41'),
(36, NULL, NULL, 'Yes', 'qqqq', ' ', ' ', 'it@predictionla.com', NULL, '21321453233', '$2y$10$xZrhBXCALuLLQsA369VOCevI89WDAOTSPWVnV4TMIl7hkN7CII9XO', 'uploads/logos\\259401568_2063302520494858_4130558274730544292_n.jpg', 14, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'No', NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 'Platinum', NULL, NULL, NULL, '2021-12-29 04:58:11', '2021-12-29 04:58:11'),
(37, NULL, NULL, NULL, 'Jack', 'Rozario', 'jackrozario', 'rozario@gmail.com', NULL, '7649034211433', '$2y$10$jfVyBmX5bEmQeZ08/wFBKuCrlrR3HE32eQ.piELkcy9boaWitK9Om', 'uploads/profile_photos/1640838490.png', 1, 1, 0, 4, 'general', 'No', '2021-12-30', 200000, NULL, NULL, NULL, NULL, NULL, 'No', 'No', 'No', 'No', 'Yes', NULL, 0, 1, 1, 1, 1, 1, 2, 'Platinum', '2021-12-01', 'Male', NULL, '2021-12-29 22:28:11', '2021-12-29 22:28:50'),
(38, NULL, NULL, NULL, 's', 's', 'wqwee', 'sahibakshatun@gmail.com', NULL, '345455322', '$2y$10$rlzN.rSh2MTiomqeI2s5SOT9aAdQIdIuRZknvLEEffCTGBGwDetYe', 'uploads/profile_photos/1641113116.png', 1, 3, 0, 4, 'general', 'No', '2022-01-02', NULL, NULL, NULL, NULL, NULL, NULL, 'No', 'No', 'No', 'No', 'Yes', 'Automatic', 0, 1, 1, 1, 1, 1, 2, 'Premium', '2022-01-21', 'Male', NULL, '2022-01-02 02:45:17', '2022-01-02 02:45:17');

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
-- Indexes for table `employees`
--
ALTER TABLE `employees`
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
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
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
-- Indexes for table `regions`
--
ALTER TABLE `regions`
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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

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
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `attendance_locations`
--
ALTER TABLE `attendance_locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `commissions`
--
ALTER TABLE `commissions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `latetime_configs`
--
ALTER TABLE `latetime_configs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `late_times`
--
ALTER TABLE `late_times`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `leave_types`
--
ALTER TABLE `leave_types`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

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
-- AUTO_INCREMENT for table `over_times`
--
ALTER TABLE `over_times`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pay_slips`
--
ALTER TABLE `pay_slips`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tax_configs`
--
ALTER TABLE `tax_configs`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `salary_loans_employee_id_foreign` FOREIGN KEY (`loans_employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
