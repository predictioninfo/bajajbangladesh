-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2021 at 12:07 PM
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
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` int(10) NOT NULL,
  `com_id` int(10) NOT NULL,
  `region_id` int(10) NOT NULL,
  `area_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `com_id`, `region_id`, `area_name`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Dhaka-North', '2021-11-29 03:46:01', '2021-11-29 03:46:01');

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
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
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(10) NOT NULL,
  `company_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

INSERT INTO `companies` (`id`, `company_name`, `company_email`, `company_phone`, `company_city`, `company_country`, `company_package`, `company_logo`, `created_at`, `updated_at`) VALUES
(1, 'Prediction Learning Associates Ltd', 'info@predictionla.com', '+8801713334874', 'Dhaka', 'Bangladesh', 'Premium', 'uploads/logos\\logo (1).png', '2021-11-28 08:48:38', '2021-12-02 02:12:46'),
(2, 'Walton', NULL, NULL, NULL, NULL, 'General', NULL, '2021-11-28 08:48:38', '2021-11-28 08:48:38');

-- --------------------------------------------------------

--
-- Table structure for table `db_houses`
--

CREATE TABLE `db_houses` (
  `id` int(10) NOT NULL,
  `com_id` int(10) NOT NULL,
  `region_id` int(10) NOT NULL,
  `area_id` int(10) NOT NULL,
  `territory_id` int(10) NOT NULL,
  `town_id` int(10) NOT NULL,
  `db_house_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `db_houses`
--

INSERT INTO `db_houses` (`id`, `com_id`, `region_id`, `area_id`, `territory_id`, `town_id`, `db_house_name`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 'Gulshan DB House', '2021-11-29 03:50:29', '2021-11-29 03:50:29');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) NOT NULL,
  `com_id` int(10) NOT NULL,
  `department_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `com_id`, `department_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'IT', '2021-11-29 07:37:04', '2021-11-29 07:37:04'),
(3, 1, 'Human Resources', '2021-12-02 03:59:37', '2021-12-02 03:59:37');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` int(10) NOT NULL,
  `com_id` int(10) NOT NULL,
  `department_id` int(10) NOT NULL,
  `designation_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `com_id`, `department_id`, `designation_name`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Senior Software Engineer', '2021-11-29 08:06:23', '2021-11-29 08:06:23');

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
(10, 5, '2021-12-02 08:13:17', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/96.0.4664.45 Safari\\/537.36\"}');

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
-- Table structure for table `office_shifts`
--

CREATE TABLE `office_shifts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shift_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_shift` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `com_id` bigint(20) UNSIGNED NOT NULL,
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

INSERT INTO `office_shifts` (`id`, `shift_name`, `default_shift`, `com_id`, `sunday_in`, `sunday_out`, `saturday_in`, `saturday_out`, `friday_in`, `friday_out`, `thursday_in`, `thursday_out`, `wednesday_in`, `wednesday_out`, `tuesday_in`, `tuesday_out`, `monday_in`, `monday_out`, `created_at`, `updated_at`) VALUES
(1, 'Full Time', NULL, 1, '09:00AM', '06:00PM', '09:00AM', '06:00PM', NULL, NULL, '09:00AM', '06:00PM', '09:00AM', '06:00PM', '09:00AM', '06:00PM', '09:00AM', '06:00PM', '2021-08-06 13:12:19', '2021-08-17 10:06:50');

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
(1, 1, 1, 1, 1, 0, 0, '2021-11-28 10:52:40', '2021-11-28 10:52:40');

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
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(10) NOT NULL,
  `com_id` int(10) NOT NULL,
  `region_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `com_id`, `region_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dhaka', '2021-11-29 03:44:18', '2021-12-02 04:28:28'),
(2, 1, 'Chittagong', '2021-12-02 04:28:53', '2021-12-02 04:28:53');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `com_id` int(10) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `com_id`, `name`, `guard_name`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'web', 'Can access and change everything', 1, NULL, NULL),
(2, 1, 'employee', 'web', 'Default access', 1, '2020-07-26 13:50:45', '2020-07-26 13:50:45'),
(3, 1, 'client', 'web', 'When you create a client, this role and associated.', 1, '2020-10-08 03:10:23', '2020-10-08 03:10:23'),
(4, 1, 'Manager', 'web', 'Can Manage', 1, '2021-02-24 10:24:58', '2021-02-24 10:24:58'),
(5, 1, 'Editor', 'web', 'Custom access', 1, '2021-02-24 10:24:58', '2021-02-24 10:24:58'),
(6, 1, 'Prediction HR', 'web', 'For new contract', 1, '2021-06-02 12:18:06', '2021-06-06 13:07:25'),
(7, 1, 'PVMHR', 'web', 'PVM Payroll HR staffs, will oversee outsourced staffs operations.', 1, '2021-06-16 07:48:03', '2021-06-16 07:55:25'),
(8, 1, 'PVM TM/Supervisor', 'web', 'PVM payroll staffs, will oversee the outsourced staffs e.g. Leave, Attendance, Performance etc.', 1, '2021-06-16 07:49:58', '2021-06-16 07:53:30'),
(9, 1, 'PLA PVM HR Operations', 'web', 'Prediction payroll staffs, dedicated to manage entire outsourced operations for PVM', 1, '2021-06-16 07:52:43', '2021-06-16 07:52:43');

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
-- Table structure for table `territories`
--

CREATE TABLE `territories` (
  `id` int(10) NOT NULL,
  `com_id` int(10) NOT NULL,
  `region_id` int(10) NOT NULL,
  `area_id` int(10) NOT NULL,
  `territory_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `territories`
--

INSERT INTO `territories` (`id`, `com_id`, `region_id`, `area_id`, `territory_name`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'Gulshan', '2021-11-29 03:47:39', '2021-11-29 03:47:39');

-- --------------------------------------------------------

--
-- Table structure for table `towns`
--

CREATE TABLE `towns` (
  `id` int(10) NOT NULL,
  `com_id` int(10) NOT NULL,
  `region_id` int(10) NOT NULL,
  `area_id` int(10) NOT NULL,
  `territory_id` int(10) NOT NULL,
  `town_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `towns`
--

INSERT INTO `towns` (`id`, `com_id`, `region_id`, `area_id`, `territory_id`, `town_name`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 'Gulshan-1', '2021-11-29 03:48:28', '2021-11-29 03:48:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `is_active` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_location_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_in_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_out_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_in_latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_in_longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_out_latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_out_longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

INSERT INTO `users` (`id`, `report_to_parent_id`, `company_profile`, `first_name`, `last_name`, `username`, `email`, `email_verified_at`, `phone`, `password`, `profile_photo`, `com_id`, `department_id`, `designation_id`, `office_shift_id`, `attendance_type`, `attendance_status`, `joining_date`, `is_active`, `login_location_id`, `check_in_ip`, `check_out_ip`, `check_in_latitude`, `check_in_longitude`, `check_out_latitude`, `check_out_longitude`, `region_id`, `area_id`, `territory_id`, `town_id`, `db_house_id`, `role_id`, `com_pack`, `date_of_birth`, `gender`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, NULL, NULL, 'Zara House', 'Alam', '', 'jara@gmail.com', NULL, '453454345345345345', '$2y$10$ySP4X87XGO5tJ5.t81Jls.pzYg2ioTXwKt.iXYT3fz4OwwX0K0a9C', 'uploads/profile_photos\\mahbub.jpg', 2, 0, 0, 0, '', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, 'General', '', '0', NULL, '2021-11-28 01:07:18', '2021-11-28 01:07:18'),
(5, NULL, 'Yes', 'Prediction Learning Associates Ltd', 'Alam', '', 'info@predictionla.com', NULL, '+8801713334874', '$2y$10$/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W', 'uploads/logos\\logo (1).png', 1, 0, 0, 0, '', 'No', '', '', '', 'No', 'No', 'No', 'No', 'No', 'No', 0, NULL, NULL, NULL, NULL, 1, 'Premium', '', '0', 'vkrvqEgEGxYECFTuEsOACfSk6kFTwoXko8zGLmJxHWK6EfbDNELtRVTGWuva', '2021-11-28 03:14:14', '2021-12-02 02:12:46'),
(6, 5, NULL, 'VJB8ClqTwm', 'Alam', '', 'oxlo4@mofc.com', NULL, '453454345345345345', '$2y$10$jtki9mhU26EHucxFRuXUHey4P5.LV/1JFjuxKho/tMm/q7wpllTp2', 'uploads/profile_photos\\mahbub.jpg', 1, 0, 0, 0, '', NULL, '', '', '', NULL, NULL, NULL, NULL, 'N/A', 'N/A', 0, NULL, NULL, NULL, NULL, 0, 'Premium', '', '0', NULL, '2021-11-28 03:20:42', '2021-11-28 03:20:42'),
(7, 5, NULL, 'Majhar', 'Alam', '20294', 'mc4wq@gx5j.comaasdasd', NULL, '08499862579', '$2y$10$/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W', 'uploads/profile_photos\\mahbub.jpg', 1, 1, 0, 1, 'general', NULL, '2021/09/01', NULL, '40', NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 1, 1, 1, 1, 1, 2, NULL, '3542355', 'Male', NULL, '2021-11-29 04:56:16', '2021-11-29 04:56:16'),
(8, 5, NULL, 'Majhareeeeeeeeeeeeeeeee', 'Alam', 'mahfujur', 'mc4wqeeeeeeee@gx5j.com', NULL, '0849986257944444', '$2y$10$/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W', 'uploads/profile_photos\\mahbub.jpg', 1, 1, 0, 1, 'general', NULL, '2021-11-22', NULL, '42', NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 1, 1, 1, 1, 1, 2, NULL, '2021-11-23', 'Male', NULL, '2021-11-29 06:01:06', '2021-11-29 06:01:06'),
(9, 6, NULL, 'Mahbub', 'Alam', 'mahbubalam', 'mahbubrtytwebsoft@gmail.com', NULL, '+880173428129067868', '$2y$10$/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W', 'uploads/profile_photos\\mahbub.jpg', 1, 1, 0, 1, 'general', NULL, '2021-11-30', NULL, '42', NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 1, 1, 1, 1, 1, 2, NULL, '2021-11-30', 'Male', NULL, '2021-11-29 06:04:15', '2021-11-29 06:04:15'),
(10, 6, NULL, 'Ma', 'Al', 'mah', 'mc4wq@gx5j.com', NULL, '0849986257954444444', '$2y$10$/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W', 'uploads/profile_photos\\avtr).jpg', 1, 1, 0, 1, 'general', NULL, '2021-12-01', '1', '42', NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 1, 1, 1, 1, 1, 2, NULL, '2021-12-01', 'Male', NULL, '2021-11-30 01:10:01', '2021-11-30 02:58:39'),
(15, 7, NULL, 'Robin', 'Alam', 'robin', 'robin@gmail.com', NULL, '+880173428129066', '$2y$10$/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W', 'uploads/profile_photos\\avatar.png', 1, 1, 0, 1, 'general', NULL, '2021-12-15', '1', '42', NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 1, 1, 1, 1, 1, 2, NULL, '2021-12-01', 'Male', NULL, '2021-11-30 03:35:43', '2021-11-30 03:39:41'),
(16, 7, NULL, 'Rita', 'Yasmin', 'a', 'mc4wrfetgretgklgfq@gx5j.com', NULL, '08499862579786564', '$2y$10$/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W', 'uploads/profile_photos\\a_1638265085.avtr_female.jpg', 1, 1, 0, 1, 'general', NULL, '2021-12-01', NULL, NULL, NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 1, 1, 1, 1, 1, 2, NULL, '2021-12-01', 'Female', NULL, '2021-11-30 03:38:05', '2021-11-30 03:38:05'),
(17, 8, NULL, 'Robin', 'Alam', 'robin1', 'robidddn@gmail.com', NULL, '+880173428129066', '$2y$10$/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W', 'uploads/profile_photos\\avatar.png', 1, 1, 0, 1, 'general', NULL, '2021-12-15', '1', '42', NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 1, 1, 1, 1, 1, 2, NULL, '2021-12-01', 'Male', NULL, '2021-11-30 03:35:43', '2021-11-30 03:39:41'),
(19, 8, NULL, 'm', 'm', 'mmm', 'mahbubwmebsoft@gmail.com', NULL, '+88017342812907', '$2y$10$/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W', 'uploads/profile_photos\\1638266660.jpg', 1, 1, 0, 1, 'general', NULL, '2021-12-08', NULL, '42', NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 1, 1, 1, 1, 1, 2, NULL, '2021-12-01', 'Male', NULL, '2021-11-30 04:04:20', '2021-11-30 04:04:20'),
(25, 9, NULL, 'vv', 'vv', 'vvvvv', 'mahbvvvubwebsoft@gmail.com', NULL, '+880173428129044', '$2y$10$/zLJ8b1vs0wNhIDJDZrFyeFGfKeHWAOmnJ33TdCPNv3MPJfd4Yt4W', 'uploads/profile_photos/1638268865.png', 1, 1, 0, 1, 'general', NULL, '2021-12-01', NULL, '42', NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 1, 1, 1, 1, 1, 2, NULL, '2021-12-01', 'Male', NULL, '2021-11-30 04:41:05', '2021-11-30 04:41:05');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `office_shifts`
--
ALTER TABLE `office_shifts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `office_shifts_company_id_foreign` (`com_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
-- Indexes for table `sub_modules`
--
ALTER TABLE `sub_modules`
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
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `attendance_locations`
--
ALTER TABLE `attendance_locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `db_houses`
--
ALTER TABLE `db_houses`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
-- AUTO_INCREMENT for table `office_shifts`
--
ALTER TABLE `office_shifts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sub_modules`
--
ALTER TABLE `sub_modules`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `territories`
--
ALTER TABLE `territories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `towns`
--
ALTER TABLE `towns`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
