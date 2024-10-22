-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 22, 2024 at 05:47 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payroll`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assign_leaves`
--

CREATE TABLE `tbl_assign_leaves` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `leave_id` int NOT NULL,
  `year` year NOT NULL,
  `assign_leave` decimal(8,2) NOT NULL,
  `leave_balance` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_assign_leaves`
--

INSERT INTO `tbl_assign_leaves` (`id`, `user_id`, `leave_id`, `year`, `assign_leave`, `leave_balance`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 2024, '2.00', '2.00', '2024-10-18 11:05:49', '2024-10-18 11:05:49'),
(2, 3, 2, 2024, '3.00', '3.00', '2024-10-18 11:05:49', '2024-10-18 11:05:49'),
(3, 3, 3, 2024, '2.00', '2.00', '2024-10-18 11:05:49', '2024-10-18 11:05:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_departments`
--

CREATE TABLE `tbl_departments` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int DEFAULT NULL COMMENT '1 for active, 0 for inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_departments`
--

INSERT INTO `tbl_departments` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Development', 1, '2024-08-09 09:38:10', '2024-08-09 09:39:20'),
(2, 'Marketing', 1, '2024-08-09 09:39:43', '2024-08-09 09:39:43'),
(3, 'Other', 1, '2024-08-20 04:49:08', '2024-08-20 04:49:08'),
(4, 'Testing', 1, '2024-09-10 11:56:58', '2024-09-16 04:17:45'),
(5, 'Quality Analyst', 1, '2024-09-11 08:46:15', '2024-09-11 08:46:15'),
(6, 'Management', 1, '2024-09-18 05:12:03', '2024-09-18 05:21:33'),
(7, 'TEST', 1, '2024-09-18 05:44:33', '2024-09-18 05:44:33'),
(8, 'Test12', 1, '2024-09-18 12:34:20', '2024-10-03 08:16:40');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_designations`
--

CREATE TABLE `tbl_designations` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int DEFAULT NULL COMMENT '1 for active, 0 for inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_designations`
--

INSERT INTO `tbl_designations` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 1, '2024-08-07 04:16:35', '2024-08-07 04:16:35'),
(2, 'Ui-Ux Designer', 1, '2024-08-07 04:23:03', '2024-08-07 04:23:03'),
(3, 'Web Designer', 1, '2024-08-07 04:23:15', '2024-08-07 04:23:15'),
(4, 'Business Development', 1, '2024-08-07 04:23:33', '2024-08-07 04:23:33'),
(5, 'Degital Marketing', 1, '2024-08-07 04:23:46', '2024-08-07 04:23:46'),
(6, 'Accountant', 1, '2024-08-07 04:23:56', '2024-08-07 04:23:56'),
(7, 'Project Manager', 1, '2024-08-07 04:24:06', '2024-08-07 05:08:12'),
(8, 'Piun', 1, '2024-08-07 05:18:40', '2024-09-24 08:25:49'),
(9, 'PHP Developer', 1, NULL, NULL),
(10, 'HR', 1, NULL, NULL),
(11, 'Quality Analyst', 1, '2024-09-10 06:24:53', '2024-09-10 06:25:27'),
(12, 'Dotnet Devloper', 1, '2024-09-10 23:18:16', '2024-09-11 22:39:50'),
(13, 'Python Devlopers', 1, '2024-09-10 23:18:17', '2024-09-15 22:40:58'),
(14, 'Dotnet', 1, '2024-09-10 23:18:18', '2024-09-11 22:39:46'),
(15, 'Laravel Devlopers', 1, '2024-09-10 23:59:39', '2024-09-18 05:10:26'),
(16, 'TEST', 1, '2024-09-18 05:44:01', '2024-09-18 05:44:01'),
(17, 'TEST11', 1, '2024-09-18 12:34:46', '2024-09-18 12:34:46'),
(18, 'Business Devlopment', 1, '2024-10-18 04:55:58', '2024-10-18 04:56:16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_failed_jobs`
--

CREATE TABLE `tbl_failed_jobs` (
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
-- Table structure for table `tbl_holiday_leaves`
--

CREATE TABLE `tbl_holiday_leaves` (
  `id` bigint UNSIGNED NOT NULL,
  `holiday_date` date DEFAULT NULL,
  `holiday_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int DEFAULT NULL COMMENT '1 for active, 0 for inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_holiday_leaves`
--

INSERT INTO `tbl_holiday_leaves` (`id`, `holiday_date`, `holiday_name`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2024-10-31', 'Diwali', 1, '2024-10-17 10:08:12', '2024-10-17 10:08:12', NULL),
(2, '2024-10-02', 'Gandhi Jayanti', 1, '2024-10-17 12:47:58', '2024-10-17 12:47:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leaves`
--

CREATE TABLE `tbl_leaves` (
  `id` bigint UNSIGNED NOT NULL,
  `leave_type_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_of_leaves` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_leaves`
--

INSERT INTO `tbl_leaves` (`id`, `leave_type_name`, `number_of_leaves`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Privilege Leave', 10, '2024-06-10 06:41:00', '2024-09-18 06:34:58', NULL),
(2, 'Sick Leave', 7, '2024-06-10 06:47:44', '2024-10-18 09:45:50', NULL),
(3, 'Casual Leave', 4, '2024-06-10 06:49:59', '2024-10-18 11:05:32', NULL),
(6, 'cl', 2, '2024-09-24 07:02:27', '2024-09-24 07:02:35', '2024-09-24 07:02:35'),
(7, 'test', 3, '2024-10-03 06:08:12', '2024-10-03 06:09:41', '2024-10-03 06:09:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leave_applies`
--

CREATE TABLE `tbl_leave_applies` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `leave_id` int DEFAULT NULL,
  `leave_mode` int DEFAULT NULL COMMENT '1 for Full Day, 2 for Half Day - 1st, 3 for Half Day - 2nd',
  `is_leave_cancle` int DEFAULT '0' COMMENT '0 for default, 1 for No, 2 for Yes',
  `reason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_approved` int DEFAULT '0' COMMENT '0 for pending, 1 for Approved, 2 for Rejected',
  `number_of_days` double(8,2) DEFAULT NULL,
  `number_of_paid_leaves` double(8,2) DEFAULT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci,
  `leave_status_remark` text COLLATE utf8mb4_unicode_ci,
  `deleted_by` int DEFAULT NULL COMMENT 'This is User Id',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_leave_applies`
--

INSERT INTO `tbl_leave_applies` (`id`, `user_id`, `from_date`, `to_date`, `leave_id`, `leave_mode`, `is_leave_cancle`, `reason`, `is_approved`, `number_of_days`, `number_of_paid_leaves`, `remark`, `leave_status_remark`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, '2024-09-25', '2024-09-25', 2, 2, 2, 'TEST', 0, 0.50, NULL, NULL, NULL, NULL, '2024-09-24 05:17:23', '2024-09-24 05:18:19', '2024-09-24 05:18:19'),
(2, 4, '2024-09-25', '2024-09-25', 2, 2, 1, 'TEST', 0, 0.50, NULL, NULL, NULL, 1, '2024-09-24 05:31:18', '2024-09-24 06:49:31', '2024-09-24 06:49:31'),
(3, 4, '2024-09-25', '2024-09-25', 2, 2, 1, 'TEST', 1, 0.50, NULL, NULL, NULL, NULL, '2024-09-24 06:04:05', '2024-09-25 05:39:22', NULL),
(4, 4, '2024-09-28', '2024-09-28', 1, 1, 1, 'test', 1, 1.00, NULL, NULL, NULL, NULL, '2024-09-24 06:32:50', '2024-09-24 06:36:54', NULL),
(5, 4, '2024-09-26', '2024-09-27', 2, 1, 1, 'test', 1, 2.00, NULL, NULL, NULL, 1, '2024-09-24 06:44:41', '2024-09-24 06:51:39', '2024-09-24 06:51:39'),
(6, 2, '2024-09-26', '2024-09-26', 1, 1, 2, 'test', 2, 1.00, NULL, NULL, NULL, NULL, '2024-09-25 09:02:11', '2024-09-30 12:32:48', NULL),
(9, 3, '2024-09-12', '2024-09-13', 1, 1, 1, 'at home', 1, 2.00, 1.00, 'as per employee requirement', NULL, NULL, '2024-10-14 10:06:12', '2024-10-14 12:24:37', NULL),
(10, 3, '2024-09-27', '2024-09-27', 2, 1, 1, 'fever', 1, 1.00, 1.00, NULL, 'leave remark', NULL, '2024-10-14 11:38:12', '2024-10-14 12:58:54', NULL),
(11, 2, '2024-10-16', '2024-10-16', 1, 1, 0, 'test', 1, 1.00, 1.00, NULL, NULL, 1, '2024-10-15 05:32:48', '2024-10-15 05:37:17', '2024-10-15 05:37:17'),
(12, 2, '2024-10-16', '2024-10-17', 2, 1, 1, 'Weakness', 1, 2.00, 2.00, NULL, NULL, NULL, '2024-10-15 05:41:36', '2024-10-15 05:43:10', NULL),
(13, 2, '2024-10-18', '2024-10-18', 3, 1, 1, 'test', 1, 1.00, 0.50, NULL, NULL, NULL, '2024-10-15 06:27:16', '2024-10-15 06:28:22', NULL),
(19, 7, '2024-10-13', '2024-10-13', 2, 1, 0, 'test', 1, 1.00, 0.50, NULL, NULL, NULL, '2024-10-17 09:09:31', '2024-10-17 09:09:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_migrations`
--

CREATE TABLE `tbl_migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_migrations`
--

INSERT INTO `tbl_migrations` (`id`, `migration`, `batch`) VALUES
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(8, '2024_06_05_100657_create_permission_tables', 3),
(10, '2024_06_07_053657_create_settings_table', 5),
(15, '2014_10_12_100000_create_password_reset_tokens_table', 7),
(18, '2024_06_10_173831_create_leaves_table', 8),
(19, '2024_06_11_100253_create_holiday_leaves_table', 9),
(31, '2024_06_12_154834_create_leave_applies_table', 14),
(40, '2024_06_10_163914_create_user_details_table', 19),
(42, '2024_06_14_123623_create_punch_in_outs_table', 21),
(46, '2024_08_07_145317_create_designations_table', 23),
(48, '2024_08_06_121818_create_salaries_table', 25),
(49, '2024_08_09_145849_create_departments_table', 26),
(50, '2024_06_11_155155_create_assign_leaves_table', 27),
(52, '2024_08_24_153505_create_salary_histories_table', 28),
(54, '2024_08_30_173548_create_projects_table', 29),
(56, '2024_08_31_165813_create_user_documents_table', 30),
(59, '2024_09_02_111141_add_address_and_gender_to_users_table', 31),
(60, '2024_09_18_161839_add_confirmation_date_to_users_table', 32),
(64, '2014_10_12_000000_create_users_table', 33),
(66, '2024_10_21_182219_add_user_id_in_users_table', 34);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_model_has_permissions`
--

CREATE TABLE `tbl_model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_model_has_roles`
--

CREATE TABLE `tbl_model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_model_has_roles`
--

INSERT INTO `tbl_model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(4, 'App\\Models\\User', 2),
(4, 'App\\Models\\User', 3),
(5, 'App\\Models\\User', 4),
(4, 'App\\Models\\User', 5),
(5, 'App\\Models\\User', 6),
(2, 'App\\Models\\User', 7);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_password_reset_tokens`
--

CREATE TABLE `tbl_password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_password_reset_tokens`
--

INSERT INTO `tbl_password_reset_tokens` (`email`, `token`, `created_at`, `updated_at`) VALUES
('rahulpatil2163@gmail.com', '1fJzl4xu1GsvX0p1FhYLnFEsb1EssQF1RienqN1dZ1i5xlfpB7SlCGyex04NIxlJ', '2024-06-10 05:05:10', '2024-06-10 05:05:10'),
('rahulpatil2163@gmail.com', 'nHx1r0lbIHjJx3wdhTYqz6NWvNzKDp9e3KOIOmDs5gquqVDXd7QzxaYjh2js6dVb', '2024-06-10 05:21:09', '2024-06-10 05:21:09'),
('admin@example.com', 'IxiZuWPFsi4573uPs2LCo0TP07PSmufMjF6Xj6TgqpqHZPVClMt5BDww7qsHb9Bc', '2024-06-26 07:15:19', '2024-06-26 07:15:19'),
('rahul.patil@inbox-infotech.com', 'xgyFOr05xY5J95f2bPumm3FfENToSuCyhbIFX4peEEihsydpvDpl9VUQYBVG5lMH', '2024-10-11 08:29:41', '2024-10-11 08:29:41'),
('rahul.patil@inbox-infotech.com', 'woOgiR6LsHdSUvbsetHzEMfa3dwiruQ2D9kn8HkqjbGqJHgwF8glBPD3qOaTAhZa', '2024-10-11 08:30:19', '2024-10-11 08:30:19'),
('rahul.patil@inbox-infotech.com', 'ztMGhYuofSms1HBMpGjectIpDW11INCyWJqpa7i5t1qTaXFQyWERCTLTYhJyhg00', '2024-10-11 08:32:01', '2024-10-11 08:32:01'),
('rahul.patil@inbox-infotech.com', '6h9EiM3mep9meCjtxYrxtDIvjPUMRNiyAAV2lsLhIp72hCmanqjfdoMVC2R0yeT0', '2024-10-11 08:32:34', '2024-10-11 08:32:34'),
('rahul.patil@inbox-infotech.com', 'EbuMWcDGM3ZtOjNdRAXM3K8ts5sUesXemzzrwOKa1QdwYzlzkleX32QsEkN619KJ', '2024-10-11 08:34:14', '2024-10-11 08:34:14'),
('payalkhanvilkar.2044@gmail.com', 'HsYudaPM4txc5J01OBZ0DT3RL7gzIRNcSZuviKGvXibEZXDu4KziQpylKuX7mGo9', '2024-10-11 09:22:53', '2024-10-11 09:22:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permissions`
--

CREATE TABLE `tbl_permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_permissions`
--

INSERT INTO `tbl_permissions` (`id`, `name`, `guard_name`, `group_name`, `created_at`, `updated_at`) VALUES
(1, 'view-role', 'web', 'Role', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(2, 'create-role', 'web', 'Role', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(3, 'edit-role', 'web', 'Role', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(4, 'delete-role', 'web', 'Role', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(5, 'view-employee', 'web', 'Employee', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(6, 'create-employee', 'web', 'Employee', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(7, 'edit-employee', 'web', 'Employee', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(8, 'delete-employee', 'web', 'Employee', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(9, 'leave-history', 'web', 'Employee', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(10, 'delete-letters', 'web', 'Employee', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(11, 'view-designation', 'web', 'Designation', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(12, 'create-designation', 'web', 'Designation', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(13, 'edit-designation', 'web', 'Designation', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(14, 'delete-designation', 'web', 'Designation', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(15, 'view-department', 'web', 'Department', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(16, 'create-department', 'web', 'Department', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(17, 'edit-department', 'web', 'Department', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(18, 'delete-department', 'web', 'Department', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(19, 'view-leave', 'web', 'Leave', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(20, 'create-leave', 'web', 'Leave', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(21, 'edit-leave', 'web', 'Leave', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(22, 'delete-leave', 'web', 'Leave', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(23, 'view-holiday-leave', 'web', 'HolidayLeave', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(24, 'create-holiday-leave', 'web', 'HolidayLeave', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(25, 'edit-holiday-leave', 'web', 'HolidayLeave', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(26, 'delete-holiday-leave', 'web', 'HolidayLeave', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(27, 'view-previous-leave', 'web', 'HolidayLeave', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(28, 'view-leave-apply', 'web', 'LeaveApply', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(29, 'create-leave-apply', 'web', 'LeaveApply', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(30, 'edit-leave-apply', 'web', 'LeaveApply', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(31, 'delete-leave-apply', 'web', 'LeaveApply', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(32, 'view-applied-leave', 'web', 'AppliedLeave', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(33, 'edit-applied-leave', 'web', 'AppliedLeave', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(34, 'delete-applied-leave', 'web', 'AppliedLeave', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(35, 'view-location', 'web', 'PunchInOut', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(36, 'employee-list-attendance-correction', 'web', 'AttendanceCorrection', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(37, 'attendance-list-attendancecorrection', 'web', 'AttendanceCorrection', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(38, 'edit-attendance-correction', 'web', 'AttendanceCorrection', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(39, 'employee-list-attendancereport', 'web', 'AttendanceReport', '2024-10-21 12:25:06', '2024-10-21 12:25:06'),
(40, 'attendance-report', 'web', 'AttendanceReport', '2024-10-21 12:25:07', '2024-10-21 12:25:07'),
(41, 'view-salary', 'web', 'Salary', '2024-10-21 12:25:07', '2024-10-21 12:25:07'),
(42, 'create-salary', 'web', 'Salary', '2024-10-21 12:25:07', '2024-10-21 12:25:07'),
(43, 'edit-salary', 'web', 'Salary', '2024-10-21 12:25:07', '2024-10-21 12:25:07'),
(44, 'show-salary', 'web', 'Salary', '2024-10-21 12:25:07', '2024-10-21 12:25:07'),
(45, 'edit-setting', 'web', 'Setting', '2024-10-21 12:25:07', '2024-10-21 12:25:07');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_personal_access_tokens`
--

CREATE TABLE `tbl_personal_access_tokens` (
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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_projects`
--

CREATE TABLE `tbl_projects` (
  `id` bigint UNSIGNED NOT NULL,
  `project_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `expected_end_date` date DEFAULT NULL,
  `project_domain_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `running_status` int DEFAULT NULL,
  `git_repository_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_backup_link_office_server` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` bigint DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `project_team` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_projects`
--

INSERT INTO `tbl_projects` (`id`, `project_name`, `start_date`, `expected_end_date`, `project_domain_name`, `running_status`, `git_repository_link`, `project_backup_link_office_server`, `client_name`, `email`, `mobile_no`, `address`, `project_team`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Checkeeper', NULL, NULL, NULL, 1, NULL, NULL, 'Client123', NULL, NULL, NULL, 'null', '2024-08-31 06:58:56', '2024-09-16 08:54:29', NULL),
(2, 'Payroll', '2024-09-11', '2024-09-30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'null', '2024-09-12 12:31:51', '2024-09-12 12:31:51', NULL),
(3, 'Payroll', '2024-09-11', '2024-09-30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'null', '2024-09-12 12:31:51', '2024-09-12 12:31:51', NULL),
(4, 'Payroll', '2024-09-11', '2024-09-30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'null', '2024-09-12 12:35:36', '2024-09-26 12:06:29', '2024-09-26 12:06:29'),
(5, 'pay', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'null', '2024-09-12 12:36:02', '2024-09-12 12:36:02', NULL),
(6, 'Payroll', '2024-09-16', '2024-09-17', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'null', '2024-09-16 07:14:24', '2024-09-16 07:14:24', NULL),
(7, 'Attandance', '2024-09-16', '2024-09-20', NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, 'null', '2024-09-16 07:16:12', '2024-09-26 12:07:27', '2024-09-26 12:07:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_punch_in_outs`
--

CREATE TABLE `tbl_punch_in_outs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `date` date NOT NULL,
  `punch_in` time DEFAULT NULL,
  `punch_in_lat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `punch_in_long` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `punch_out` time DEFAULT NULL,
  `punch_out_lat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `punch_out_long` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `punch_in_out_status` int NOT NULL COMMENT '1 for Punch In, 0 for Punch Out',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_punch_in_outs`
--

INSERT INTO `tbl_punch_in_outs` (`id`, `user_id`, `date`, `punch_in`, `punch_in_lat`, `punch_in_long`, `punch_out`, `punch_out_lat`, `punch_out_long`, `punch_in_out_status`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-09-24', '12:24:00', NULL, NULL, '18:28:00', NULL, NULL, 0, '2024-09-24 06:54:19', '2024-09-24 12:58:27'),
(2, 4, '2024-09-24', '12:28:00', NULL, NULL, '18:28:00', NULL, NULL, 0, '2024-09-24 06:58:41', '2024-09-24 12:58:07'),
(5, 1, '2024-09-25', '11:18:00', NULL, NULL, NULL, NULL, NULL, 1, '2024-09-25 05:48:25', '2024-09-25 05:48:25'),
(6, 6, '2024-09-25', '11:18:00', NULL, NULL, NULL, NULL, NULL, 1, '2024-09-25 05:48:54', '2024-09-25 05:48:54'),
(7, 1, '2024-09-26', '10:26:00', NULL, NULL, NULL, NULL, NULL, 1, '2024-09-26 04:56:19', '2024-09-26 04:56:19'),
(8, 4, '2024-09-26', '10:35:00', NULL, NULL, NULL, NULL, NULL, 1, '2024-09-26 05:05:24', '2024-09-26 05:05:24'),
(9, 1, '2024-09-30', '10:11:00', NULL, NULL, NULL, NULL, NULL, 1, '2024-09-30 04:41:48', '2024-09-30 04:41:48'),
(10, 4, '2024-09-30', '10:20:00', NULL, NULL, NULL, NULL, NULL, 1, '2024-09-30 04:50:36', '2024-09-30 04:50:36'),
(11, 1, '2024-10-03', '10:09:00', NULL, NULL, NULL, NULL, NULL, 1, '2024-10-03 04:39:40', '2024-10-03 04:39:40'),
(33, 1, '2024-10-14', '09:32:00', '22.3188337', '73.1674962', NULL, NULL, NULL, 1, '2024-10-14 04:02:56', '2024-10-14 04:02:56'),
(71, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-15 06:16:28', '2024-10-15 06:16:28'),
(72, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-15 06:16:28', '2024-10-15 06:16:28'),
(73, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-15 06:16:28', '2024-10-15 06:16:28'),
(74, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-15 06:16:28', '2024-10-15 06:16:28'),
(75, 1, '2024-10-17', '11:33:00', NULL, NULL, NULL, NULL, NULL, 1, '2024-10-17 06:03:03', '2024-10-17 06:03:03'),
(91, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:03:28', '2024-10-17 07:03:28'),
(92, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:03:28', '2024-10-17 07:03:28'),
(93, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:03:28', '2024-10-17 07:03:28'),
(94, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:03:28', '2024-10-17 07:03:28'),
(110, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:04:45', '2024-10-17 07:04:45'),
(111, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:04:45', '2024-10-17 07:04:45'),
(112, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:04:45', '2024-10-17 07:04:45'),
(113, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:04:45', '2024-10-17 07:04:45'),
(129, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:10:20', '2024-10-17 07:10:20'),
(130, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:10:20', '2024-10-17 07:10:20'),
(131, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:10:20', '2024-10-17 07:10:20'),
(132, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:10:20', '2024-10-17 07:10:20'),
(175, 3, '2024-09-02', '09:02:00', '22.3188337', '73.1674962', '18:06:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:22:17', '2024-10-17 07:22:17'),
(176, 3, '2024-09-03', '09:05:00', '22.3188337', '73.1674962', '18:28:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:22:17', '2024-10-17 07:22:17'),
(177, 3, '2024-09-04', '09:08:00', '22.3188337', '73.1674962', '18:29:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:22:17', '2024-10-17 07:22:17'),
(178, 3, '2024-09-05', '09:11:00', '22.3188337', '73.1674962', '18:30:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:22:17', '2024-10-17 07:22:17'),
(179, 3, '2024-09-06', '09:14:00', '22.3188337', '73.1674962', '18:28:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:22:17', '2024-10-17 07:22:17'),
(180, 3, '2024-09-09', '09:17:00', '22.3188337', '73.1674962', '18:28:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:22:17', '2024-10-17 07:22:17'),
(181, 3, '2024-09-10', '09:20:00', '22.3188337', '73.1674962', '18:28:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:22:17', '2024-10-17 07:22:17'),
(182, 3, '2024-09-11', '09:23:00', '22.3188337', '73.1674962', '18:28:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:22:17', '2024-10-17 07:22:17'),
(183, 3, '2024-09-12', '09:26:00', '22.3188337', '73.1674962', '18:28:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:22:17', '2024-10-17 07:22:17'),
(184, 3, '2024-09-13', '09:29:00', '22.3188337', '73.1674962', '18:28:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:22:17', '2024-10-17 07:22:17'),
(185, 3, '2024-09-16', '09:14:00', '22.3188337', '73.1674962', '18:28:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:22:17', '2024-10-17 07:22:17'),
(186, 3, '2024-09-17', '09:17:00', '22.3188337', '73.1674962', '18:28:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:22:17', '2024-10-17 07:22:17'),
(187, 3, '2024-09-18', '09:20:00', '22.3188337', '73.1674962', '18:28:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:22:17', '2024-10-17 07:22:17'),
(188, 3, '2024-09-19', '09:23:00', '22.3188337', '73.1674962', '18:28:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:22:17', '2024-10-17 07:22:17'),
(189, 3, '2024-09-20', '09:26:00', '22.3188337', '73.1674962', '18:28:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:22:17', '2024-10-17 07:22:17'),
(190, 3, '2024-09-23', '09:29:00', '22.3188337', '73.1674962', '18:28:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:22:17', '2024-10-17 07:22:17'),
(191, 3, '2024-09-24', '09:14:00', '22.3188337', '73.1674962', '18:28:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:22:17', '2024-10-17 07:22:17'),
(192, 3, '2024-09-25', '09:17:00', '22.3188337', '73.1674962', '18:28:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:22:17', '2024-10-17 07:22:17'),
(193, 3, '2024-09-26', '09:20:00', '22.3188337', '73.1674962', '18:28:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:22:17', '2024-10-17 07:22:17'),
(194, 3, '2024-09-27', '09:23:00', '22.3188337', '73.1674962', '18:28:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:22:17', '2024-10-17 07:22:17'),
(195, 3, '2024-09-30', '09:26:00', '22.3188337', '73.1674962', '18:28:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:22:17', '2024-10-17 07:22:17'),
(232, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:26:39', '2024-10-17 07:26:39'),
(233, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:26:39', '2024-10-17 07:26:39'),
(234, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:26:39', '2024-10-17 07:26:39'),
(235, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:26:39', '2024-10-17 07:26:39'),
(236, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:26:39', '2024-10-17 07:26:39'),
(237, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:26:39', '2024-10-17 07:26:39'),
(238, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:26:39', '2024-10-17 07:26:39'),
(239, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:26:39', '2024-10-17 07:26:39'),
(240, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:26:39', '2024-10-17 07:26:39'),
(241, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:26:39', '2024-10-17 07:26:39'),
(242, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:26:39', '2024-10-17 07:26:39'),
(243, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:26:39', '2024-10-17 07:26:39'),
(244, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 07:26:39', '2024-10-17 07:26:39'),
(305, 2, '2024-10-01', '09:05:00', '22.3188337', '73.1674962', '18:06:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:17:00', '2024-10-17 08:17:00'),
(306, 2, '2024-10-02', '09:07:00', '22.3188337', '73.1674962', '18:05:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:17:00', '2024-10-17 08:17:00'),
(307, 2, '2024-10-03', '09:03:00', '22.3188337', '73.1674962', '18:15:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:17:00', '2024-10-17 08:17:00'),
(308, 2, '2024-10-04', '09:05:00', '22.3188337', '73.1674962', '18:25:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:17:00', '2024-10-17 08:17:00'),
(309, 2, '2024-10-05', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:17:00', '2024-10-17 08:17:00'),
(310, 2, '2024-10-06', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:17:00', '2024-10-17 08:17:00'),
(311, 2, '2024-10-07', '09:10:00', '22.3188337', '73.1674962', '18:06:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:17:00', '2024-10-17 08:17:00'),
(312, 2, '2024-10-08', '09:01:00', '22.3188337', '73.1674962', '18:12:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:17:00', '2024-10-17 08:17:00'),
(313, 2, '2024-10-09', '09:02:00', '22.3188337', '73.1674962', '18:14:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:17:00', '2024-10-17 08:17:00'),
(314, 2, '2024-10-10', '09:00:00', '22.3188337', '73.1674962', '18:03:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:17:00', '2024-10-17 08:17:00'),
(315, 2, '2024-10-11', '09:05:00', '22.3188337', '73.1674962', '18:05:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:17:00', '2024-10-17 08:17:00'),
(316, 2, '2024-10-12', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:17:00', '2024-10-17 08:17:00'),
(317, 2, '2024-10-13', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:17:00', '2024-10-17 08:17:00'),
(318, 2, '2024-10-14', '09:03:00', '22.3188337', '73.1674962', '18:05:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:17:00', '2024-10-17 08:17:00'),
(319, 2, '2024-10-15', '09:06:00', '22.3188337', '73.1674962', '18:05:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:17:00', '2024-10-17 08:17:00'),
(320, 2, '2024-10-16', '09:05:00', '22.3188337', '73.1674962', '18:06:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:17:00', '2024-10-17 08:17:00'),
(321, 2, '2024-10-17', '09:07:00', '22.3188337', '73.1674962', '18:05:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:17:00', '2024-10-17 08:17:00'),
(322, 2, '2024-10-18', '09:03:00', '22.3188337', '73.1674962', '18:15:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:17:00', '2024-10-17 08:17:00'),
(323, 2, '2024-10-19', '09:05:00', '22.3188337', '73.1674962', '18:25:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:17:00', '2024-10-17 08:17:00'),
(324, 2, '2024-10-20', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:17:00', '2024-10-17 08:17:00'),
(325, 2, '2024-10-21', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:17:00', '2024-10-17 08:17:00'),
(326, 2, '2024-10-22', '09:10:00', '22.3188337', '73.1674962', '18:06:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:17:00', '2024-10-17 08:17:00'),
(327, 2, '2024-10-23', '09:01:00', '22.3188337', '73.1674962', '18:12:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:17:00', '2024-10-17 08:17:00'),
(328, 2, '2024-10-24', '09:02:00', '22.3188337', '73.1674962', '18:14:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:17:00', '2024-10-17 08:17:00'),
(329, 2, '2024-10-25', '09:00:00', '22.3188337', '73.1674962', '18:03:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:17:00', '2024-10-17 08:17:00'),
(330, 2, '2024-10-26', '09:05:00', '22.3188337', '73.1674962', '18:05:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:17:00', '2024-10-17 08:17:00'),
(331, 2, '2024-10-27', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:17:00', '2024-10-17 08:17:00'),
(332, 2, '2024-10-28', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:17:00', '2024-10-17 08:17:00'),
(333, 2, '2024-10-29', '09:03:00', '22.3188337', '73.1674962', '18:05:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:17:00', '2024-10-17 08:17:00'),
(334, 2, '2024-10-30', '09:06:00', '22.3188337', '73.1674962', '18:05:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:17:00', '2024-10-17 08:17:00'),
(350, 2, '2024-10-01', '09:05:00', '22.3188337', '73.1674962', '18:06:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:42:14', '2024-10-17 08:42:14'),
(351, 2, '2024-10-02', '09:07:00', '22.3188337', '73.1674962', '18:05:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:42:14', '2024-10-17 08:42:14'),
(352, 2, '2024-10-03', '09:03:00', '22.3188337', '73.1674962', '18:15:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:42:14', '2024-10-17 08:42:14'),
(353, 2, '2024-10-04', '09:05:00', '22.3188337', '73.1674962', '18:25:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:42:14', '2024-10-17 08:42:14'),
(354, 2, '2024-10-05', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:42:14', '2024-10-17 08:42:14'),
(355, 2, '2024-10-06', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:42:14', '2024-10-17 08:42:14'),
(356, 2, '2024-10-07', '09:10:00', '22.3188337', '73.1674962', '18:06:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:42:14', '2024-10-17 08:42:14'),
(357, 2, '2024-10-08', '09:01:00', '22.3188337', '73.1674962', '18:12:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:42:14', '2024-10-17 08:42:14'),
(358, 2, '2024-10-09', '09:02:00', '22.3188337', '73.1674962', '18:14:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:42:14', '2024-10-17 08:42:14'),
(359, 2, '2024-10-10', '09:00:00', '22.3188337', '73.1674962', '18:03:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:42:14', '2024-10-17 08:42:14'),
(360, 2, '2024-10-11', '09:05:00', '22.3188337', '73.1674962', '18:05:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:42:14', '2024-10-17 08:42:14'),
(361, 2, '2024-10-12', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:42:14', '2024-10-17 08:42:14'),
(362, 2, '2024-10-13', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:42:14', '2024-10-17 08:42:14'),
(363, 2, '2024-10-14', '09:03:00', '22.3188337', '73.1674962', '18:05:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:42:14', '2024-10-17 08:42:14'),
(364, 2, '2024-10-15', '09:06:00', '22.3188337', '73.1674962', '18:05:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:42:14', '2024-10-17 08:42:14'),
(365, 2, '2024-10-16', '09:05:00', '22.3188337', '73.1674962', '18:06:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:42:14', '2024-10-17 08:42:14'),
(366, 2, '2024-10-17', '09:07:00', '22.3188337', '73.1674962', '18:05:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:42:14', '2024-10-17 08:42:14'),
(367, 2, '2024-10-18', '09:03:00', '22.3188337', '73.1674962', '18:15:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:42:14', '2024-10-17 08:42:14'),
(368, 2, '2024-10-19', '09:05:00', '22.3188337', '73.1674962', '18:25:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:42:14', '2024-10-17 08:42:14'),
(369, 2, '2024-10-20', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:42:14', '2024-10-17 08:42:14'),
(370, 2, '2024-10-21', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:42:14', '2024-10-17 08:42:14'),
(371, 2, '2024-10-22', '09:10:00', '22.3188337', '73.1674962', '18:06:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:42:14', '2024-10-17 08:42:14'),
(372, 2, '2024-10-23', '09:01:00', '22.3188337', '73.1674962', '18:12:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:42:14', '2024-10-17 08:42:14'),
(373, 2, '2024-10-24', '09:02:00', '22.3188337', '73.1674962', '18:14:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:42:14', '2024-10-17 08:42:14'),
(374, 2, '2024-10-25', '09:00:00', '22.3188337', '73.1674962', '18:03:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:42:14', '2024-10-17 08:42:14'),
(375, 2, '2024-10-26', '09:05:00', '22.3188337', '73.1674962', '18:05:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:42:14', '2024-10-17 08:42:14'),
(376, 2, '2024-10-27', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:42:14', '2024-10-17 08:42:14'),
(377, 2, '2024-10-28', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:42:14', '2024-10-17 08:42:14'),
(378, 2, '2024-10-29', '09:03:00', '22.3188337', '73.1674962', '18:05:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:42:14', '2024-10-17 08:42:14'),
(379, 2, '2024-10-30', '09:06:00', '22.3188337', '73.1674962', '18:05:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:42:14', '2024-10-17 08:42:14'),
(396, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(397, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(398, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(399, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(400, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(401, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(402, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(403, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(404, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(405, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(406, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(407, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(408, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(409, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(410, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(411, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(412, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(413, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(414, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(415, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(416, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(417, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(418, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(419, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(420, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(421, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(422, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(423, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(424, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(425, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(426, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(427, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(428, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(429, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(430, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(431, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(432, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(433, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(434, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(435, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(436, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(437, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(438, 1, '1970-01-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 08:44:47', '2024-10-17 08:44:47'),
(455, 7, '2024-10-01', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 09:08:53', '2024-10-17 09:08:53'),
(456, 7, '2024-10-02', '09:07:00', '22.3188337', '73.1674962', '18:05:00', '22.3188337', '73.1674962', 0, '2024-10-17 09:08:53', '2024-10-17 09:08:53'),
(457, 7, '2024-10-03', '09:03:00', '22.3188337', '73.1674962', '18:15:00', '22.3188337', '73.1674962', 0, '2024-10-17 09:08:53', '2024-10-17 09:08:53'),
(458, 7, '2024-10-04', '09:05:00', '22.3188337', '73.1674962', '18:25:00', '22.3188337', '73.1674962', 0, '2024-10-17 09:08:53', '2024-10-17 09:08:53'),
(459, 7, '2024-10-05', '09:05:00', '22.3188337', '73.1674962', '18:25:00', '22.3188337', '73.1674962', 0, '2024-10-17 09:08:53', '2024-10-17 09:08:53'),
(460, 7, '2024-10-06', '09:05:00', '22.3188337', '73.1674962', '18:25:00', '22.3188337', '73.1674962', 0, '2024-10-17 09:08:53', '2024-10-17 09:08:53'),
(461, 7, '2024-10-08', '09:02:00', '22.3188337', '73.1674962', '18:14:00', '22.3188337', '73.1674962', 0, '2024-10-17 09:08:53', '2024-10-17 09:08:53'),
(462, 7, '2024-10-09', '09:00:00', '22.3188337', '73.1674962', '18:03:00', '22.3188337', '73.1674962', 0, '2024-10-17 09:08:53', '2024-10-17 09:08:53'),
(463, 7, '2024-10-10', '09:05:00', '22.3188337', '73.1674962', '18:05:00', '22.3188337', '73.1674962', 0, '2024-10-17 09:08:53', '2024-10-17 09:08:53'),
(464, 7, '2024-10-11', '09:05:00', '22.3188337', '73.1674962', '18:25:00', '22.3188337', '73.1674962', 0, '2024-10-17 09:08:53', '2024-10-17 09:08:53'),
(465, 7, '2024-10-12', '09:05:00', '22.3188337', '73.1674962', '18:25:00', '22.3188337', '73.1674962', 0, '2024-10-17 09:08:53', '2024-10-17 09:08:53'),
(466, 7, '2024-10-14', '00:00:00', '22.3188337', '73.1674962', '00:00:00', '22.3188337', '73.1674962', 0, '2024-10-17 09:08:53', '2024-10-17 09:08:53'),
(467, 7, '2024-10-15', '09:05:00', '22.3188337', '73.1674962', '18:25:00', '22.3188337', '73.1674962', 0, '2024-10-17 09:08:53', '2024-10-17 09:08:53'),
(468, 7, '2024-10-16', '09:06:00', '22.3188337', '73.1674962', '18:05:00', '22.3188337', '73.1674962', 0, '2024-10-17 09:08:53', '2024-10-17 09:08:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2024-10-21 12:23:39', '2024-10-21 12:23:39'),
(2, 'HR', 'web', '2024-10-21 12:23:39', '2024-10-21 12:23:39'),
(3, 'Account', 'web', '2024-10-21 12:23:39', '2024-10-21 12:23:39'),
(4, 'Employee', 'web', '2024-10-21 12:23:39', '2024-10-21 12:23:39'),
(5, 'Project Manager', 'web', '2024-10-21 12:23:39', '2024-10-21 12:23:39');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role_has_permissions`
--

CREATE TABLE `tbl_role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_role_has_permissions`
--

INSERT INTO `tbl_role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(19, 4),
(23, 4),
(28, 4),
(29, 4),
(30, 4),
(31, 4),
(35, 4),
(41, 4),
(44, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_salaries`
--

CREATE TABLE `tbl_salaries` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int DEFAULT NULL,
  `month_year` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present_days` decimal(8,2) DEFAULT NULL,
  `total_week_off` int DEFAULT NULL,
  `paid_holiday` int DEFAULT NULL,
  `number_of_paid_leaves` decimal(8,2) DEFAULT NULL,
  `absent_days` decimal(8,2) DEFAULT NULL,
  `total_days` int DEFAULT NULL,
  `number_of_days_work` decimal(8,2) DEFAULT NULL,
  `per_day_salary` decimal(8,2) DEFAULT NULL,
  `overtime_work_hr` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ot_per_hr_rs` decimal(8,2) DEFAULT NULL,
  `basic` decimal(8,2) DEFAULT NULL,
  `hra` decimal(8,2) DEFAULT NULL,
  `medical` decimal(8,2) DEFAULT NULL,
  `education` decimal(8,2) DEFAULT NULL,
  `conveyance` decimal(8,2) DEFAULT NULL,
  `special_allowance` decimal(8,2) DEFAULT NULL,
  `gross_salary_A` decimal(8,2) DEFAULT NULL,
  `is_pf_deduct` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employee_contribution` decimal(8,2) DEFAULT NULL,
  `esi_employee_contribution` decimal(8,2) DEFAULT NULL,
  `labour_welfare_employee` decimal(8,2) DEFAULT NULL,
  `professional_tax` decimal(8,2) DEFAULT NULL,
  `employee_contri_B` decimal(8,2) DEFAULT NULL,
  `net_salary_C` decimal(8,2) DEFAULT NULL,
  `employer_contribution` decimal(8,2) DEFAULT NULL,
  `esi_employer_contribution` decimal(8,2) DEFAULT NULL,
  `labour_welfare_employer` decimal(8,2) DEFAULT NULL,
  `employee_contri_D` decimal(8,2) DEFAULT NULL,
  `ctc_BCD` decimal(8,2) DEFAULT NULL,
  `final_amount` decimal(8,2) DEFAULT NULL,
  `payment_mode` int DEFAULT NULL,
  `remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_salary_slip_generate` int NOT NULL DEFAULT '0' COMMENT '1 for Yes, 0 for No',
  `salary_slip_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_salaries`
--

INSERT INTO `tbl_salaries` (`id`, `user_id`, `month_year`, `present_days`, `total_week_off`, `paid_holiday`, `number_of_paid_leaves`, `absent_days`, `total_days`, `number_of_days_work`, `per_day_salary`, `overtime_work_hr`, `ot_per_hr_rs`, `basic`, `hra`, `medical`, `education`, `conveyance`, `special_allowance`, `gross_salary_A`, `is_pf_deduct`, `employee_contribution`, `esi_employee_contribution`, `labour_welfare_employee`, `professional_tax`, `employee_contri_B`, `net_salary_C`, `employer_contribution`, `esi_employer_contribution`, `labour_welfare_employer`, `employee_contri_D`, `ctc_BCD`, `final_amount`, `payment_mode`, `remark`, `is_salary_slip_generate`, `salary_slip_path`, `created_at`, `updated_at`) VALUES
(1, 4, '2024-09', '2.00', 9, 6, NULL, '13.00', 30, '17.00', '500.00', NULL, NULL, '5666.67', '566.67', '566.67', '566.67', '566.67', '566.67', '8500.00', 'No', '0.00', '120.00', '1.00', '200.00', '321.00', '8179.00', '0.00', NULL, NULL, '0.00', '8500.00', '8500.00', 2, NULL, 1, 'salary-slip/emp-103-2024-09.pdf', '2024-09-30 06:25:00', '2024-09-30 06:25:03'),
(2, 2, '2024-09', '1.00', 9, 6, '1.00', '13.00', 30, '17.00', '500.00', NULL, NULL, '2833.33', '1133.33', '1133.33', '1133.33', '1133.33', '1133.33', '8500.00', 'No', '0.00', '120.00', '1.00', '200.00', '321.00', '8179.00', '0.00', NULL, NULL, '0.00', '8500.00', '8500.00', 1, NULL, 1, 'salary-slip/emp-102-2024-09.pdf', '2024-10-01 09:29:47', '2024-10-14 03:50:27'),
(4, 3, '2024-09', '18.00', 9, 0, '2.00', '1.00', 30, '29.00', '900.00', NULL, NULL, '10440.00', '4176.00', '1208.33', '966.67', '1546.67', '7762.33', '26100.00', 'Yes', '1253.00', '0.00', '1.00', '200.00', '1454.00', '24646.00', '2.00', '0.00', '2.00', '2.00', '26102.00', '26102.00', 1, NULL, 0, NULL, '2024-10-14 12:33:23', '2024-10-14 12:35:06'),
(5, 2, '2024-10', '13.00', 4, 0, '2.50', '11.50', 31, '19.50', '484.00', NULL, NULL, '3145.16', '1258.06', '1258.06', '1258.06', '1258.06', '1258.06', '9435.00', 'No', '0.00', '120.00', '1.00', '200.00', '321.00', '9114.00', '0.00', NULL, NULL, '0.00', '9435.00', '9435.00', 1, NULL, 1, 'salary-slip/emp-102-2024-10.pdf', '2024-10-15 06:22:43', '2024-10-15 06:34:52'),
(6, 7, '2024-10', '13.00', 5, 0, '0.50', '12.50', 31, '18.50', '581.00', NULL, NULL, '4774.19', '1193.55', '1193.55', '1193.55', '1193.55', '1193.55', '10742.00', 'No', '0.00', '120.00', '1.00', '200.00', '321.00', '10421.00', '0.00', NULL, NULL, '0.00', '10742.00', '10742.00', 2, NULL, 0, NULL, '2024-10-17 09:29:14', '2024-10-17 09:29:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_salary_histories`
--

CREATE TABLE `tbl_salary_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `year` year DEFAULT NULL,
  `job_type` int DEFAULT NULL COMMENT '1 for Job, 2 for Internship',
  `user_id` int DEFAULT NULL,
  `gross_salary_yearly` decimal(8,2) DEFAULT NULL,
  `gross_salary_monthly` decimal(8,2) DEFAULT NULL,
  `basic_yearly` decimal(8,2) DEFAULT NULL,
  `basic_monthly` decimal(8,2) DEFAULT NULL,
  `hra_yearly` decimal(8,2) DEFAULT NULL,
  `hra_monthly` decimal(8,2) DEFAULT NULL,
  `medical_yearly` decimal(8,2) DEFAULT NULL,
  `medical_monthly` decimal(8,2) DEFAULT NULL,
  `education_yearly` decimal(8,2) DEFAULT NULL,
  `education_monthly` decimal(8,2) DEFAULT NULL,
  `conveyance_yearly` decimal(8,2) DEFAULT NULL,
  `conveyance_monthly` decimal(8,2) DEFAULT NULL,
  `special_allowance_yearly` decimal(8,2) DEFAULT NULL,
  `special_allowance_monthly` decimal(8,2) DEFAULT NULL,
  `gross_salary_A_yearly` decimal(8,2) DEFAULT NULL COMMENT 'addition basic+hra+medical+education+conveyance+special_allowance',
  `gross_salary_A_monthly` decimal(8,2) DEFAULT NULL COMMENT 'addition basic+hra+medical+education+conveyance+special_allowance',
  `is_pf_deduct_yearly` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_pf_deduct_monthly` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employee_contribution_yearly` decimal(8,2) DEFAULT NULL,
  `employee_contribution_monthly` decimal(8,2) DEFAULT NULL,
  `esi_employee_contribution_yearly` decimal(8,2) DEFAULT NULL,
  `esi_employee_contribution_monthly` decimal(8,2) DEFAULT NULL,
  `labour_welfare_employee_yearly` decimal(8,2) DEFAULT NULL,
  `labour_welfare_employee_monthly` decimal(8,2) DEFAULT NULL,
  `professional_tax_yearly` decimal(8,2) DEFAULT NULL,
  `professional_tax_monthly` decimal(8,2) DEFAULT NULL,
  `employee_contribution_B_yearly` decimal(8,2) DEFAULT NULL COMMENT 'addition employee_contribution_yearly+labour_welfare_employee_yearly+professional_tax_yearly',
  `employee_contribution_B_monthly` decimal(8,2) DEFAULT NULL COMMENT 'addition employee_contribution_monthly+labour_welfare_employee_monthly+professional_tax_monthly',
  `net_salary_C_yearly` decimal(8,2) DEFAULT NULL COMMENT 'gross_salary_yearly-employee_contribution_B_yearly',
  `net_salary_C_monthly` decimal(8,2) DEFAULT NULL COMMENT 'gross_salary_monthly-employee_contribution_B_monthly',
  `employer_contribution_yearly` decimal(8,2) DEFAULT NULL,
  `employer_contribution_monthly` decimal(8,2) DEFAULT NULL,
  `esi_employer_contribution_yearly` decimal(8,2) DEFAULT NULL,
  `esi_employer_contribution_monthly` decimal(8,2) DEFAULT NULL,
  `labour_welfare_employer_yearly` decimal(8,2) DEFAULT NULL,
  `labour_welfare_employer_monthly` decimal(8,2) DEFAULT NULL,
  `employer_contri_D_yearly` decimal(8,2) DEFAULT NULL,
  `employer_contri_D_monthly` decimal(8,2) DEFAULT NULL,
  `ctc_bcd_yearly` decimal(8,2) DEFAULT NULL COMMENT 'addition = employee_contribution_B_yearly + net_salary_C_yearly + employer_contri_D_yearly',
  `ctc_bcd_monthly` decimal(8,2) DEFAULT NULL COMMENT 'addition = employee_contribution_B_monthly + net_salary_C_yearly + employer_contri_D_monthly',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_salary_histories`
--

INSERT INTO `tbl_salary_histories` (`id`, `year`, `job_type`, `user_id`, `gross_salary_yearly`, `gross_salary_monthly`, `basic_yearly`, `basic_monthly`, `hra_yearly`, `hra_monthly`, `medical_yearly`, `medical_monthly`, `education_yearly`, `education_monthly`, `conveyance_yearly`, `conveyance_monthly`, `special_allowance_yearly`, `special_allowance_monthly`, `gross_salary_A_yearly`, `gross_salary_A_monthly`, `is_pf_deduct_yearly`, `is_pf_deduct_monthly`, `employee_contribution_yearly`, `employee_contribution_monthly`, `esi_employee_contribution_yearly`, `esi_employee_contribution_monthly`, `labour_welfare_employee_yearly`, `labour_welfare_employee_monthly`, `professional_tax_yearly`, `professional_tax_monthly`, `employee_contribution_B_yearly`, `employee_contribution_B_monthly`, `net_salary_C_yearly`, `net_salary_C_monthly`, `employer_contribution_yearly`, `employer_contribution_monthly`, `esi_employer_contribution_yearly`, `esi_employer_contribution_monthly`, `labour_welfare_employer_yearly`, `labour_welfare_employer_monthly`, `employer_contri_D_yearly`, `employer_contri_D_monthly`, `ctc_bcd_yearly`, `ctc_bcd_monthly`, `created_at`, `updated_at`) VALUES
(1, 2024, 1, 2, '200000.00', '15000.00', '180000.00', '5000.00', '4000.00', '2000.00', '4000.00', '2000.00', '4000.00', '2000.00', '4000.00', '2000.00', '4000.00', '2000.00', '200000.00', '15000.00', 'No', 'No', '0.00', '0.00', '1200.00', '120.00', '12.00', '1.00', '2400.00', '200.00', '3612.00', '321.00', '196388.00', '14679.00', NULL, NULL, NULL, NULL, NULL, NULL, '0.00', '0.00', '200000.00', '15000.00', '2024-09-18 22:42:27', '2024-10-11 10:08:43'),
(2, 2024, 2, 2, '200000.00', '15000.00', '180000.00', '5000.00', '4000.00', '2000.00', '4000.00', '2000.00', '4000.00', '2000.00', '4000.00', '2000.00', '4000.00', '2000.00', '200000.00', '15000.00', 'No', 'No', '0.00', '0.00', '1200.00', '120.00', '12.00', '1.00', '2400.00', '200.00', '3612.00', '321.00', '196388.00', '14679.00', NULL, NULL, NULL, NULL, NULL, NULL, '0.00', '0.00', '200000.00', '15000.00', '2024-09-19 00:56:54', '2024-10-03 06:24:10'),
(3, 2024, 1, 3, '324000.00', '27000.00', '129600.00', '10800.00', '51840.00', '4320.00', '15000.00', '1250.00', '12000.00', '1000.00', '19200.00', '1600.00', '96360.00', '8030.00', '324000.00', '27000.00', 'Yes', 'Yes', '15552.00', '1296.00', '0.00', '0.00', '12.00', '1.00', '2400.00', '200.00', '17964.00', '1497.00', '306036.00', '25503.00', '0.00', '0.00', '0.00', '0.00', '24.00', '2.00', '24.00', '2.00', '324024.00', '27002.00', '2024-09-19 00:57:09', '2024-10-22 05:38:27'),
(4, 2024, 1, 4, '200000.00', '15000.00', '180000.00', '10000.00', '4000.00', '1000.00', '4000.00', '1000.00', '4000.00', '1000.00', '4000.00', '1000.00', '4000.00', '1000.00', '200000.00', '15000.00', 'No', 'No', '0.00', '0.00', '1200.00', '120.00', '12.00', '1.00', '2400.00', '200.00', '3612.00', '321.00', '196388.00', '14679.00', NULL, NULL, NULL, NULL, NULL, NULL, '0.00', '0.00', '200000.00', '15000.00', '2024-09-23 23:45:05', '2024-10-21 12:34:26'),
(5, 2024, 1, 5, '250000.00', '20000.00', '200000.00', '15000.00', '10000.00', '1000.00', '10000.00', '1000.00', '10000.00', '1000.00', '10000.00', '1000.00', '10000.00', '1000.00', '250000.00', '20000.00', 'Yes', 'Yes', '24000.00', '1800.00', '20000.00', '1200.00', '12.00', '1.00', '2400.00', '200.00', '46412.00', '3201.00', '203588.00', '16799.00', NULL, NULL, NULL, NULL, NULL, NULL, '0.00', '0.00', '250000.00', '20000.00', '2024-09-24 03:05:28', '2024-09-24 03:42:39'),
(6, 2024, 1, 6, '240000.00', '20000.00', '200000.00', '15000.00', '8000.00', '1000.00', '8000.00', '1000.00', '8000.00', '1000.00', '8000.00', '1000.00', '8000.00', '1000.00', '240000.00', '20000.00', 'No', 'No', '0.00', '0.00', '12000.00', '1200.00', '120.00', '10.00', '2400.00', '200.00', '14520.00', '1410.00', '225480.00', '18590.00', NULL, NULL, NULL, NULL, NULL, NULL, '0.00', '0.00', '240000.00', '20000.00', '2024-09-24 04:25:02', '2024-10-21 12:34:49'),
(7, 2024, 1, 7, '200000.00', '18000.00', '180000.00', '8000.00', '4000.00', '2000.00', '4000.00', '2000.00', '4000.00', '2000.00', '4000.00', '2000.00', '4000.00', '2000.00', '200000.00', '18000.00', 'No', 'No', '0.00', '0.00', '1200.00', '120.00', '12.00', '1.00', '2400.00', '200.00', '3612.00', '321.00', '196388.00', '17679.00', NULL, NULL, NULL, NULL, NULL, NULL, '0.00', '0.00', '200000.00', '18000.00', '2024-10-01 05:01:19', '2024-10-21 12:35:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE `tbl_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `master_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `config_key` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `config_value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `master_key`, `config_key`, `config_value`, `created_at`, `updated_at`) VALUES
(1, 'config', 'config_company_name', 'Inbox Infotech Pvt. Ltd.', NULL, '2024-10-03 03:59:08'),
(2, 'config', 'config_company_email', 'inbox-infotech@gmail.com', NULL, '2024-10-03 03:59:08'),
(3, 'config', 'config_company_mobile_no', '1234567890', NULL, '2024-10-03 03:59:08'),
(4, 'config', 'config_company_address', 'address123', NULL, '2024-10-03 03:59:08'),
(5, 'config', 'config_company_logo', 'setting/inbox-logo.png', NULL, '2024-10-03 03:59:08'),
(6, 'config', 'config_fav_icon', 'setting/fav-icon.png', NULL, '2024-10-03 03:59:08'),
(7, 'config', 'config_start_financial_year', '8', NULL, '2024-08-24 10:45:37');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` bigint UNSIGNED NOT NULL,
  `designation_id` int DEFAULT NULL,
  `department_id` int DEFAULT NULL,
  `emp_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_type` int DEFAULT NULL COMMENT '1 for Job, 2 for Internship',
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `mobile_no` bigint DEFAULT NULL,
  `personal_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` int DEFAULT NULL COMMENT '1 for Male, 2 for Female',
  `dob` date DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `releaving_date` date DEFAULT NULL,
  `probation_end_date` date DEFAULT NULL,
  `confirmation_date` date DEFAULT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_status` int DEFAULT NULL,
  `temporary_address` text COLLATE utf8mb4_unicode_ci,
  `permanent_address` text COLLATE utf8mb4_unicode_ci,
  `project_manager_id` int DEFAULT NULL COMMENT 'This is User Id',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT '1 for active, 0 for inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `designation_id`, `department_id`, `emp_id`, `job_type`, `first_name`, `middle_name`, `last_name`, `email`, `email_verified_at`, `mobile_no`, `personal_email`, `password`, `gender`, `dob`, `joining_date`, `releaving_date`, `probation_end_date`, `confirmation_date`, `profile_image`, `emp_status`, `temporary_address`, `permanent_address`, `project_manager_id`, `remember_token`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, NULL, NULL, NULL, 'Admin', '', 'Admin', 'admin@example.com', NULL, 1234567890, NULL, '$2y$10$stbwW5rnYW6/JA2.Vr0JpuA3Fpx882oiMEm6jlbyH6ubyuPm9ro4e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-10-21 12:29:06', '2024-10-21 12:29:06', NULL),
(2, 9, 1, 'emp-102', 1, 'Payal', NULL, 'Khanvilkar', 'payal.khanvilkar@inbox-infotech.com', NULL, 9874563210, NULL, '$2y$10$/OSR5xl75Eu8LKqCoiWRxexsTUl/z8ZgA/sj9FTzS8zlrIlrSjr8W', 2, '2016-04-22', '2024-01-01', NULL, '2024-02-29', '2024-09-25', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-09-18 13:56:54', '2024-10-14 23:59:16', NULL),
(3, 9, 1, 'emp-107', 1, 'Rahul', NULL, 'Patil', 'rahul.patil@inbox-infotech.com', NULL, 9545276255, 'rahulpatil2163@gmail.com', '$2y$10$xTyfktFEOXMTdaYWs3PxmeBKTHwwLcYwBugVp4ab/m8m/Z.6a5g/a', 1, '1995-06-28', '2024-06-03', NULL, '2024-08-31', '2024-09-01', NULL, NULL, 'Vadodara', 'Vadodara', 4, NULL, 1, '2024-09-18 13:57:09', '2024-10-22 05:38:27', NULL),
(4, 7, 6, 'emp-103', 1, 'Rhythm', NULL, 'Patel', 'Rhythm@gmail.com', NULL, 1236412300, NULL, '$2y$10$0K9XQXf3oP/9y1rXuDVUW.RdOuCa5BzGfWlUCYtZqcw5jUiJEwnLG', 1, '2016-02-02', '2024-01-01', NULL, '2024-06-30', '2024-09-24', 'profile_image/24092024335.jpg', NULL, NULL, NULL, NULL, NULL, 1, '2024-09-23 12:45:05', '2024-10-21 12:34:26', NULL),
(5, 1, 6, 'emp-104', 1, 'Pratham', NULL, 'P', 'Pratham@gmail.com', NULL, 1236541235, NULL, '$2y$10$80qlIRCEvwlNMT2Vx80zquMD2gbwjK4ZVJ6jWAoUOK/JQbkNiBw5u', 1, '2015-01-01', '2023-01-16', NULL, '2024-01-31', '2024-09-24', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-09-23 16:05:28', '2024-09-23 17:06:47', '2024-09-23 17:06:47'),
(6, 7, 6, 'emp-105', 1, 'Pihu', NULL, 'Patel', 'pihu@gmail.com', NULL, 4563214560, NULL, '$2y$10$9BisahFYuR8DmX6Pr57lm.K3ndhGTLNUC6qgfqt99/nMyU3GFYlby', 2, '2013-02-06', '2024-03-01', NULL, '2024-05-29', '2024-09-24', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-09-23 17:25:02', '2024-10-21 12:34:49', NULL),
(7, 10, 6, 'emp-106', 1, 'Krishiv', 'p', 'Patel', 'ankita.kamra@inbox-infotech.com', NULL, 7896541236, NULL, '$2y$10$AMeUY1UhOJ/4DYUoMYnYGeII9tnGO3pHXGMJPZfL.EYvWVNilhXaS', 1, '2018-01-01', '2024-01-01', NULL, '2024-07-31', '2024-10-01', 'profile_image/03102024317.jpg', 1, NULL, NULL, NULL, NULL, 1, '2024-09-30 18:01:19', '2024-10-21 12:35:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_details`
--

CREATE TABLE `tbl_user_details` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int DEFAULT NULL,
  `bank_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_branch_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ac_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ifsc_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uan_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gross_salary_yearly` decimal(8,2) DEFAULT NULL,
  `gross_salary_monthly` decimal(8,2) DEFAULT NULL,
  `basic_yearly` decimal(8,2) DEFAULT NULL,
  `basic_monthly` decimal(8,2) DEFAULT NULL,
  `hra_yearly` decimal(8,2) DEFAULT NULL,
  `hra_monthly` decimal(8,2) DEFAULT NULL,
  `medical_yearly` decimal(8,2) DEFAULT NULL,
  `medical_monthly` decimal(8,2) DEFAULT NULL,
  `education_yearly` decimal(8,2) DEFAULT NULL,
  `education_monthly` decimal(8,2) DEFAULT NULL,
  `conveyance_yearly` decimal(8,2) DEFAULT NULL,
  `conveyance_monthly` decimal(8,2) DEFAULT NULL,
  `special_allowance_yearly` decimal(8,2) DEFAULT NULL,
  `special_allowance_monthly` decimal(8,2) DEFAULT NULL,
  `gross_salary_A_yearly` decimal(8,2) DEFAULT NULL COMMENT 'addition basic+hra+medical+education+conveyance+special_allowance',
  `gross_salary_A_monthly` decimal(8,2) DEFAULT NULL COMMENT 'addition basic+hra+medical+education+conveyance+special_allowance',
  `is_pf_deduct_yearly` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_pf_deduct_monthly` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employee_contribution_yearly` decimal(8,2) DEFAULT NULL,
  `employee_contribution_monthly` decimal(8,2) DEFAULT NULL,
  `esi_employee_contribution_yearly` decimal(8,2) DEFAULT NULL,
  `esi_employee_contribution_monthly` decimal(8,2) DEFAULT NULL,
  `labour_welfare_employee_yearly` decimal(8,2) DEFAULT NULL,
  `labour_welfare_employee_monthly` decimal(8,2) DEFAULT NULL,
  `professional_tax_yearly` decimal(8,2) DEFAULT NULL,
  `professional_tax_monthly` decimal(8,2) DEFAULT NULL,
  `employee_contribution_B_yearly` decimal(8,2) DEFAULT NULL COMMENT 'addition employee_contribution_yearly+labour_welfare_employee_yearly+professional_tax_yearly',
  `employee_contribution_B_monthly` decimal(8,2) DEFAULT NULL COMMENT 'addition employee_contribution_monthly+labour_welfare_employee_monthly+professional_tax_monthly',
  `net_salary_C_yearly` decimal(8,2) DEFAULT NULL COMMENT 'gross_salary_yearly-employee_contribution_B_yearly',
  `net_salary_C_monthly` decimal(8,2) DEFAULT NULL COMMENT 'gross_salary_monthly-employee_contribution_B_monthly',
  `employer_contribution_yearly` decimal(8,2) DEFAULT NULL,
  `employer_contribution_monthly` decimal(8,2) DEFAULT NULL,
  `esi_employer_contribution_yearly` decimal(8,2) DEFAULT NULL,
  `esi_employer_contribution_monthly` decimal(8,2) DEFAULT NULL,
  `labour_welfare_employer_yearly` decimal(8,2) DEFAULT NULL,
  `labour_welfare_employer_monthly` decimal(8,2) DEFAULT NULL,
  `employer_contri_D_yearly` decimal(8,2) DEFAULT NULL,
  `employer_contri_D_monthly` decimal(8,2) DEFAULT NULL,
  `ctc_bcd_yearly` decimal(8,2) DEFAULT NULL COMMENT 'addition = employee_contribution_B_yearly + net_salary_C_yearly + employer_contri_D_yearly',
  `ctc_bcd_monthly` decimal(8,2) DEFAULT NULL COMMENT 'addition = employee_contribution_B_monthly + net_salary_C_yearly + employer_contri_D_monthly',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_user_details`
--

INSERT INTO `tbl_user_details` (`id`, `user_id`, `bank_name`, `bank_branch_name`, `ac_no`, `ifsc_code`, `uan_number`, `gross_salary_yearly`, `gross_salary_monthly`, `basic_yearly`, `basic_monthly`, `hra_yearly`, `hra_monthly`, `medical_yearly`, `medical_monthly`, `education_yearly`, `education_monthly`, `conveyance_yearly`, `conveyance_monthly`, `special_allowance_yearly`, `special_allowance_monthly`, `gross_salary_A_yearly`, `gross_salary_A_monthly`, `is_pf_deduct_yearly`, `is_pf_deduct_monthly`, `employee_contribution_yearly`, `employee_contribution_monthly`, `esi_employee_contribution_yearly`, `esi_employee_contribution_monthly`, `labour_welfare_employee_yearly`, `labour_welfare_employee_monthly`, `professional_tax_yearly`, `professional_tax_monthly`, `employee_contribution_B_yearly`, `employee_contribution_B_monthly`, `net_salary_C_yearly`, `net_salary_C_monthly`, `employer_contribution_yearly`, `employer_contribution_monthly`, `esi_employer_contribution_yearly`, `esi_employer_contribution_monthly`, `labour_welfare_employer_yearly`, `labour_welfare_employer_monthly`, `employer_contri_D_yearly`, `employer_contri_D_monthly`, `ctc_bcd_yearly`, `ctc_bcd_monthly`, `created_at`, `updated_at`) VALUES
(1, 2, 'eyJpdiI6InhENVIrbk1sZHN5RC9DVkJwVFhKNkE9PSIsInZhbHVlIjoidXpkOGxaYnJNTDNYZ0h6RGRYSzZRUT09IiwibWFjIjoiNWE3YjQwNTY3OTRlMmI2NjZjZDllNzhlMWFkYjBiZWQ0ZWUyZTNiNmMwZGY3ODk1NDUyMTA4YWEzN2RjYWUwOSIsInRhZyI6IiJ9', 'eyJpdiI6InVqeFNCUWhTanFGWWFFRGYva2d2dlE9PSIsInZhbHVlIjoiVjVQYXFuVElFLzIwZkNUYUhoVm9lUT09IiwibWFjIjoiM2ZmYmNiNTE4YzhlZWU1MzNmNjU3MDJhY2ZjYzlkN2ZiMmFkNGZlYjU4ZjgwMzVhODUzNDkzNzBkZDRhMjc2ZSIsInRhZyI6IiJ9', 'eyJpdiI6IkhNa2NUVUEzT0ljVElvNm9JSnNFc1E9PSIsInZhbHVlIjoid3o2MElER3FSRnd4TzFNSU1ucGFBUT09IiwibWFjIjoiNGUyMGZjOWJmMjlhODQwYmY0ODU0MTBhNGJjMTI2MDQ2ODg3ZDM3OTU3ZGIwMDY3YjE3MmIyMjRkYjQ4OGJlMiIsInRhZyI6IiJ9', 'eyJpdiI6IjNXalVyNlhUdUZuSVhWTHd4ckd2amc9PSIsInZhbHVlIjoiWERGYW1CM1JsbVZBUkdDRE1jc1pTQT09IiwibWFjIjoiMWFjZDNkZmU5ZWIwNDE0NTlhOTQ1OWE1NjgxMzM3YjhkYWJmYWJjYWVkYTNhYzAzNWMwMmZiZmI1OTdlNTE0NyIsInRhZyI6IiJ9', '123654123', '200000.00', '15000.00', '180000.00', '5000.00', '4000.00', '2000.00', '4000.00', '2000.00', '4000.00', '2000.00', '4000.00', '2000.00', '4000.00', '2000.00', '200000.00', '15000.00', 'No', 'No', '0.00', '0.00', '1200.00', '120.00', '12.00', '1.00', '2400.00', '200.00', '3612.00', '321.00', '196388.00', '14679.00', NULL, NULL, NULL, NULL, NULL, NULL, '0.00', '0.00', '200000.00', '15000.00', '2024-09-19 00:56:54', '2024-10-11 10:08:43'),
(2, 3, 'eyJpdiI6IkxGOTNQYW9VMFMxS3Z6NktjQnhKV3c9PSIsInZhbHVlIjoiWHdmWUc0bjZZd2gxbFY5ZHhKc1pQZz09IiwibWFjIjoiZDllZDEyMjg5ZTQ5ODAzNGJlOWY3NTBlZjcwY2FjYTJmMjFjYmMyNjJkMDg2NTQxZmRjMGU4MmJhMjlmZTFjMyIsInRhZyI6IiJ9', 'eyJpdiI6IkpzTDFVd2ZvdGVON1lpUjA2ZXlHcHc9PSIsInZhbHVlIjoiRmxvZmV3SVU5SmdtRVp0Rm9RaUhuQT09IiwibWFjIjoiZjVlOGRkZjVlY2Q1MWNiNGRkY2MxZmQzNTgyZjA3NDMwZmE4NWU1ZDJiZTBmMTBkNTU2MjI3ZjRiNDU1YTFkYiIsInRhZyI6IiJ9', 'eyJpdiI6IklhVUttWDNUdjExdjBMQzJrZTE0Tmc9PSIsInZhbHVlIjoiQ2NJZnZPUFRabGduVXc5cURva0xkdz09IiwibWFjIjoiZWQyNzVjYzkxMjlhNzI2MDkzZjAxMmM0YWEzNTFlMTlkZmI1MGQwNGRiZGRkMmJmNWU3Y2M1ZGM4MmRiZjc3ZiIsInRhZyI6IiJ9', 'eyJpdiI6IjgzVUxoUEN3UnBqemhiZTlFNmdLUWc9PSIsInZhbHVlIjoiRnljbHIrTkorcDBxYndmaS9uRXB2Zz09IiwibWFjIjoiOGZiOWVkNzdhMzlhOTMwNjU1MDVlNDljOGYwYmNiYzI3NGZjZDI2M2I0YTk2YmFhNmJlNDUwNmMwODFjNGRmMCIsInRhZyI6IiJ9', NULL, '324000.00', '27000.00', '129600.00', '10800.00', '51840.00', '4320.00', '15000.00', '1250.00', '12000.00', '1000.00', '19200.00', '1600.00', '96360.00', '8030.00', '324000.00', '27000.00', 'Yes', 'Yes', '15552.00', '1296.00', '0.00', '0.00', '12.00', '1.00', '2400.00', '200.00', '17964.00', '1497.00', '306036.00', '25503.00', '0.00', '0.00', '0.00', '0.00', '24.00', '2.00', '24.00', '2.00', '324024.00', '27002.00', '2024-09-19 00:57:09', '2024-10-22 05:38:27'),
(3, 4, 'eyJpdiI6IjkxbUFmRUhDTHN3K2E0TnJxOGhqV1E9PSIsInZhbHVlIjoiekpGZXVCNHFGYjNvSTZUNU9YaXREUT09IiwibWFjIjoiN2JkYzY0ZTYzYjg2YzZmNzgyZGM1NTNjOGRkNmNhYmM3OGMyYWUxNDgzMDA3OGUxYjBlZDk5NmFjNGQzZWY5MCIsInRhZyI6IiJ9', 'eyJpdiI6IlcralJ4U28wS1BmVnpLMjlzb25Ta0E9PSIsInZhbHVlIjoiRTloNmM1Tkh2TXA2MlpIclJhbWw1UT09IiwibWFjIjoiOTJkNjZkM2JjYTEyYWQ2ZGE3ZTU0YWYwOWU3MGEyMWU0NDRjNWQzNmVkYzdmODdkZmQwOTBjMTM3OWNkYTViZiIsInRhZyI6IiJ9', 'eyJpdiI6IlFjQ1VOdy9rUkIrU0phOEdzMlljMXc9PSIsInZhbHVlIjoidGRhSnF0OGFEaXhzZlFRcjI0RWxhdz09IiwibWFjIjoiMTMyNTkyOWQ1ZDg5ODcxZmRkNDFmMWMzZWRhOGIyYjYwMDZkOGM3MGQ0YzQ1YzdlMTdmOWM2YTY4NDY0NmYxMiIsInRhZyI6IiJ9', 'eyJpdiI6Im05UGhDZzZXYkR3UjNrOFJqNCs4aUE9PSIsInZhbHVlIjoiTGxZZE5aNTR1K2J2V3VRYmFMd1R1Zz09IiwibWFjIjoiZjE5MmUxYWE5YTJkMTdlNDk5NjQ2MTNjMzYzMGYzZDMwOWJmZjFhMWM0ZDZmNjQ5MGVhMDk2YzlkYzMyZGExNyIsInRhZyI6IiJ9', NULL, '200000.00', '15000.00', '180000.00', '10000.00', '4000.00', '1000.00', '4000.00', '1000.00', '4000.00', '1000.00', '4000.00', '1000.00', '4000.00', '1000.00', '200000.00', '15000.00', 'No', 'No', '0.00', '0.00', '1200.00', '120.00', '12.00', '1.00', '2400.00', '200.00', '3612.00', '321.00', '196388.00', '14679.00', NULL, NULL, NULL, NULL, NULL, NULL, '0.00', '0.00', '200000.00', '15000.00', '2024-09-23 23:45:05', '2024-10-21 12:34:26'),
(4, 5, 'eyJpdiI6IkxhS2txVThnQmhWNHdFaTdhSDlWOHc9PSIsInZhbHVlIjoiUEtwL1BTYWtveWV3alQ2UzlaeDdlQT09IiwibWFjIjoiZWRiYTc5YjZkMmFiYzdlM2M3ZGJhM2UzODgxMTU0NjQ5MDhiZGYzNmFmZjFhODEzZjcyZmNiNzQ0MWUwYTk0NSIsInRhZyI6IiJ9', 'eyJpdiI6InJlUThJMGw3NzNTb2RIT01NNW43cmc9PSIsInZhbHVlIjoiTXkxMjljM1lpM3lhNXV5K2Z4TW5xdz09IiwibWFjIjoiYjU4MGQ1MDZmZjljM2QwOTdiYTc5OWVlNDIzOGRlMzY2NDdmMDNkY2NlNGU4NDNkYTA1OTU4ZWU5NjliNTkzOSIsInRhZyI6IiJ9', 'eyJpdiI6Ik10UXlsRzNlYnZLMG1CU0xjMGIyNXc9PSIsInZhbHVlIjoiMzZtTGJYSmJISWtZZ0Q0MUUyTjQyUT09IiwibWFjIjoiYTE4ZjU2YjlhZTc5MjU2MjI2NTk3YmVmNWNiZTY2MjBkYzQzNWZjZTYwNDEwMjUzMDlhMDM3MjY0NWNjOWIzYiIsInRhZyI6IiJ9', 'eyJpdiI6InpRYjlUVEwrUm1Wcm5VR0pvaFlHTUE9PSIsInZhbHVlIjoiRTlmS2pJZWRHZTJlaUUrK240a1NZdz09IiwibWFjIjoiNzYzMmE0MjA4NGVkMzlkNjdhNTM2ODYzYzlhYmNjNTkzM2FhNjJmNWVhZmY3YjEwNmE0ZTFmYThlYzQzYzNkMCIsInRhZyI6IiJ9', NULL, '250000.00', '20000.00', '200000.00', '15000.00', '10000.00', '1000.00', '10000.00', '1000.00', '10000.00', '1000.00', '10000.00', '1000.00', '10000.00', '1000.00', '250000.00', '20000.00', 'Yes', 'Yes', '24000.00', '1800.00', '20000.00', '1200.00', '12.00', '1.00', '2400.00', '200.00', '46412.00', '3201.00', '203588.00', '16799.00', NULL, NULL, NULL, NULL, NULL, NULL, '0.00', '0.00', '250000.00', '20000.00', '2024-09-24 03:05:28', '2024-09-24 03:42:39'),
(5, 6, 'eyJpdiI6ImllSFVPajZvQjVYSC92ajRpNDRtc1E9PSIsInZhbHVlIjoickVKcG9JK0hlZy9hMWt2ZXFPbFVpUT09IiwibWFjIjoiM2ZiMmIzZmViZTQzOWNlYzRjMzE0YTM0MjVlY2Q5ZjQ5NGIzMWM5MGE0NzVjMmJmMzhmMDYwMmUxMWZmNmQzMCIsInRhZyI6IiJ9', 'eyJpdiI6IlM4MUlLZXI4R2U4OWtzNUVTeHJpN1E9PSIsInZhbHVlIjoieGNEekN2NS9PMWZxZnZyTkZuK2VTZz09IiwibWFjIjoiMmY0MTI1MzgxYTQ2Y2FhNTVmMjI3MzA2ZGI1YTg4MmVmMGIzOTJjZWY0MDVhNDVlZTE3YzAwODM4MDFiMWMxNiIsInRhZyI6IiJ9', 'eyJpdiI6ImNmTmJjV2czRTJETEt3Z1NMWWVSc2c9PSIsInZhbHVlIjoic1NydnRaNk9GWmc1d3htanlKS2FuUT09IiwibWFjIjoiZDA3N2ExYThjNzc3NzVhM2ZiZWEzMDBlZTEzNGYxMjgxZTI4N2EwZjkwNzUyZDdmMGMyNTVhYWIwZmU1YTFhZiIsInRhZyI6IiJ9', 'eyJpdiI6IlI2MWs0czBDRXkzYWtnSDlvbi9hSEE9PSIsInZhbHVlIjoib1M1NmdzeStCU0tLREZmd1QrMndtUT09IiwibWFjIjoiNjU0OGVlZWRkZThiZTJiZjUwZDlmZWRlNDMxMTJjYzg5OGRkODFlMzJiMGY3NmQyOTdkOWFjOWNlMjIwMzU5MSIsInRhZyI6IiJ9', '14566122', '240000.00', '20000.00', '200000.00', '15000.00', '8000.00', '1000.00', '8000.00', '1000.00', '8000.00', '1000.00', '8000.00', '1000.00', '8000.00', '1000.00', '240000.00', '20000.00', 'No', 'No', '0.00', '0.00', '12000.00', '1200.00', '120.00', '10.00', '2400.00', '200.00', '14520.00', '1410.00', '225480.00', '18590.00', NULL, NULL, NULL, NULL, NULL, NULL, '0.00', '0.00', '240000.00', '20000.00', '2024-09-24 04:25:02', '2024-10-21 12:34:49'),
(6, 7, 'eyJpdiI6IlhjOFU2cS8zY0NxRTdjUmtOUEZlYkE9PSIsInZhbHVlIjoicWtHYlkzREFjN0xQY2hqVmNaU1NVQT09IiwibWFjIjoiNzJhY2M5OGUwM2JiY2NmOGU4MGMzMmU1ZWZiMjg1NDViOWNhYTVhMmIxMmRjYzUwMjBkMWUyM2YzNjA1YjU0NSIsInRhZyI6IiJ9', 'eyJpdiI6Imd3TXRwbjIwS2kzS1ZsQXdIRW5sNlE9PSIsInZhbHVlIjoiN1lVWFR5OWxCaTRyOGJaWXNtTGJYQT09IiwibWFjIjoiYzI0ZGY2YTVmNDhiNTc5Y2M0ZGJhYTU0NjFhMGNiOTFhMjZmNjVhZGUzODM1MWFhNjI4OGVlZDQ5MWZkODc2MSIsInRhZyI6IiJ9', 'eyJpdiI6IkJNOU1lcDJaR3p0dGFJd2FrYmhnRlE9PSIsInZhbHVlIjoiQjNFSVlxT0c5TW5UNXBCd1JZNUFTQT09IiwibWFjIjoiN2Q1NTJjNWMwYzA5M2JhOTM2MjE5ZDY2NWI3MjM4MzVlNzkzNDJhYzI3ZTdjYjBjZjAzZDJiZWM2YzA4NmQ2NyIsInRhZyI6IiJ9', 'eyJpdiI6IlgxTEZYZksrUGNhYTBaaWhnYmlhUEE9PSIsInZhbHVlIjoibHBLTzh4amhtN2xMOU9XRk00TmZodz09IiwibWFjIjoiOWYwYmRhNDNmYzYxMDhkYTk5NGJlOTZkNDU3YTM2Mzk3OTUzODM5OTVhZWFmNDFiNGFlOTgxMDA5ZGQ3NTk5NiIsInRhZyI6IiJ9', NULL, '200000.00', '18000.00', '180000.00', '8000.00', '4000.00', '2000.00', '4000.00', '2000.00', '4000.00', '2000.00', '4000.00', '2000.00', '4000.00', '2000.00', '200000.00', '18000.00', 'No', 'No', '0.00', '0.00', '1200.00', '120.00', '12.00', '1.00', '2400.00', '200.00', '3612.00', '321.00', '196388.00', '17679.00', NULL, NULL, NULL, NULL, NULL, NULL, '0.00', '0.00', '200000.00', '18000.00', '2024-10-01 05:01:19', '2024-10-21 12:35:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_documents`
--

CREATE TABLE `tbl_user_documents` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `document_type` int NOT NULL COMMENT '1 for Internship Offer Letter, 2 for Confirmation Letter, 3 Offer Letter, 4 Appoitment Offer, 5 Experience Letter',
  `document_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_user_documents`
--

INSERT INTO `tbl_user_documents` (`id`, `user_id`, `document_type`, `document_name`, `created_at`, `updated_at`) VALUES
(4, 2, 1, 'internship-offer-letter/emp-102-2024-01-01-internship-offer-letter.pdf', '2024-10-03 11:54:10', '2024-10-03 11:54:10'),
(5, 2, 2, 'confirmation-letter/emp-102-2024-01-01-confirmation-letter.pdf', '2024-10-03 11:55:52', '2024-10-03 11:55:52'),
(6, 2, 3, 'offer-letter/emp-102-2024-01-01-offer-letter.pdf', '2024-10-03 12:06:47', '2024-10-03 12:06:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_assign_leaves`
--
ALTER TABLE `tbl_assign_leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_departments`
--
ALTER TABLE `tbl_departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_designations`
--
ALTER TABLE `tbl_designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_failed_jobs`
--
ALTER TABLE `tbl_failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tbl_failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `tbl_holiday_leaves`
--
ALTER TABLE `tbl_holiday_leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_leaves`
--
ALTER TABLE `tbl_leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_leave_applies`
--
ALTER TABLE `tbl_leave_applies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_migrations`
--
ALTER TABLE `tbl_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_model_has_permissions`
--
ALTER TABLE `tbl_model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `tbl_model_has_roles`
--
ALTER TABLE `tbl_model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `tbl_permissions`
--
ALTER TABLE `tbl_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tbl_permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `tbl_personal_access_tokens`
--
ALTER TABLE `tbl_personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tbl_personal_access_tokens_token_unique` (`token`),
  ADD KEY `tbl_personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tbl_projects`
--
ALTER TABLE `tbl_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_punch_in_outs`
--
ALTER TABLE `tbl_punch_in_outs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tbl_roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `tbl_role_has_permissions`
--
ALTER TABLE `tbl_role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `tbl_role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `tbl_salaries`
--
ALTER TABLE `tbl_salaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_salary_histories`
--
ALTER TABLE `tbl_salary_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tbl_users_email_unique` (`email`),
  ADD UNIQUE KEY `tbl_users_personal_email_unique` (`personal_email`);

--
-- Indexes for table `tbl_user_details`
--
ALTER TABLE `tbl_user_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_documents`
--
ALTER TABLE `tbl_user_documents`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_assign_leaves`
--
ALTER TABLE `tbl_assign_leaves`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_departments`
--
ALTER TABLE `tbl_departments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_designations`
--
ALTER TABLE `tbl_designations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_failed_jobs`
--
ALTER TABLE `tbl_failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_holiday_leaves`
--
ALTER TABLE `tbl_holiday_leaves`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_leaves`
--
ALTER TABLE `tbl_leaves`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_leave_applies`
--
ALTER TABLE `tbl_leave_applies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_migrations`
--
ALTER TABLE `tbl_migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `tbl_permissions`
--
ALTER TABLE `tbl_permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tbl_personal_access_tokens`
--
ALTER TABLE `tbl_personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_projects`
--
ALTER TABLE `tbl_projects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_punch_in_outs`
--
ALTER TABLE `tbl_punch_in_outs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=469;

--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_salaries`
--
ALTER TABLE `tbl_salaries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_salary_histories`
--
ALTER TABLE `tbl_salary_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_user_details`
--
ALTER TABLE `tbl_user_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_user_documents`
--
ALTER TABLE `tbl_user_documents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_model_has_permissions`
--
ALTER TABLE `tbl_model_has_permissions`
  ADD CONSTRAINT `tbl_model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `tbl_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_model_has_roles`
--
ALTER TABLE `tbl_model_has_roles`
  ADD CONSTRAINT `tbl_model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `tbl_roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_role_has_permissions`
--
ALTER TABLE `tbl_role_has_permissions`
  ADD CONSTRAINT `tbl_role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `tbl_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `tbl_roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
