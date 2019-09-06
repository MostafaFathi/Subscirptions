-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2017 at 08:58 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `education_center_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `center_appointment_tb`
--

CREATE TABLE `center_appointment_tb` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_id` int(11) NOT NULL,
  `day_no` int(11) NOT NULL,
  `time_from` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_to` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `center_appointment_tb`
--

INSERT INTO `center_appointment_tb` (`id`, `group_id`, `day_no`, `time_from`, `time_to`, `created_at`, `updated_at`) VALUES
(75, 14, 6, '11:00', '01:00', '2017-07-15 07:04:48', '2017-07-15 07:04:48'),
(74, 14, 5, '10:00', '11:00', '2017-07-15 07:04:48', '2017-07-15 07:04:48'),
(73, 14, 1, '10:00', '11:00', '2017-07-15 07:04:48', '2017-07-15 07:04:48'),
(69, 8, 6, '09:00', '10:00', '2017-07-15 07:02:39', '2017-07-15 07:02:39'),
(68, 8, 4, '09:00', '10:00', '2017-07-15 07:02:39', '2017-07-15 07:02:39'),
(67, 8, 2, '09:00', '10:00', '2017-07-15 07:02:39', '2017-07-15 07:02:39'),
(63, 7, 4, '08:00', '10:00', '2017-07-14 19:35:07', '2017-07-14 19:35:07'),
(62, 7, 1, '08:00', '10:00', '2017-07-14 19:35:07', '2017-07-14 19:35:07'),
(24, 11, 2, '12:00', '01:00', '2017-07-13 08:51:40', '2017-07-13 08:51:40'),
(25, 11, 4, '12:00', '01:00', '2017-07-13 08:51:40', '2017-07-13 08:51:40'),
(26, 11, 6, '12:30', '01:30', '2017-07-13 08:51:40', '2017-07-13 08:51:40'),
(27, 12, 1, '08:00', '09:00', '2017-07-14 08:02:44', '2017-07-14 08:02:44'),
(28, 12, 3, '08:00', '09:00', '2017-07-14 08:02:44', '2017-07-14 08:02:44'),
(29, 12, 5, '08:00', '09:00', '2017-07-14 08:02:44', '2017-07-14 08:02:44');

-- --------------------------------------------------------

--
-- Table structure for table `center_branch_salaray_tb`
--

CREATE TABLE `center_branch_salaray_tb` (
  `tag_no` int(10) UNSIGNED NOT NULL,
  `salaray_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `center_branch_tb`
--

CREATE TABLE `center_branch_tb` (
  `branch_id` int(10) UNSIGNED NOT NULL,
  `branch_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_phone` int(11) DEFAULT NULL,
  `branch_img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'secondary',
  `center_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `center_branch_tb`
--

INSERT INTO `center_branch_tb` (`branch_id`, `branch_name`, `branch_address`, `branch_phone`, `branch_img`, `branch_type`, `center_id`, `created_at`, `updated_at`) VALUES
(1, 'الفرع الاول', NULL, 59985544, NULL, 'secondary', 7, '2017-06-10 14:33:20', '2017-06-10 14:33:20'),
(2, 'مركز الانوار التعليمي | الفرع الرئيسي', NULL, 59954422, NULL, 'primary', 10, '2017-06-10 14:39:44', '2017-06-10 14:41:25'),
(3, 'مركز النور التعليمي | الفرع الرئيسي', NULL, 599542246, NULL, 'secondary', 4, '2017-06-12 05:37:57', '2017-06-12 05:37:57'),
(4, 'الفرع الثاني', 'غزة الشجاعية', 59954877, NULL, 'secondary', 4, '2017-06-18 11:38:20', '2017-06-18 11:39:11');

-- --------------------------------------------------------

--
-- Table structure for table `center_branch_users_tb`
--

CREATE TABLE `center_branch_users_tb` (
  `tag_no` int(10) UNSIGNED NOT NULL,
  `branch_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `center_branch_users_tb`
--

INSERT INTO `center_branch_users_tb` (`tag_no`, `branch_id`, `user_id`, `created_at`, `updated_at`) VALUES
(7, 4, 1, '2017-06-20 14:46:38', '2017-06-20 14:46:38'),
(6, 3, 1, '2017-06-20 14:46:38', '2017-06-20 14:46:38'),
(4, 3, 31, '2017-06-20 14:43:39', '2017-06-20 14:43:39'),
(5, 3, 31, '2017-06-20 14:43:46', '2017-06-20 14:43:46');

-- --------------------------------------------------------

--
-- Table structure for table `center_courses_tb`
--

CREATE TABLE `center_courses_tb` (
  `course_id` int(10) UNSIGNED NOT NULL,
  `course_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `center_employee_salaray_tb`
--

CREATE TABLE `center_employee_salaray_tb` (
  `tag_no` int(10) UNSIGNED NOT NULL,
  `student_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `salary_payment_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `salary_payment_value` float NOT NULL,
  `salaray_ratio` double(8,2) DEFAULT NULL,
  `salaray_value` int(11) DEFAULT NULL,
  `user_inserted` int(11) NOT NULL,
  `user_updated` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `center_employee_tb`
--

CREATE TABLE `center_employee_tb` (
  `emp_id` int(10) UNSIGNED NOT NULL,
  `emp_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emp_specialist` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_age` int(11) DEFAULT NULL,
  `emp_gender` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT 'm',
  `emp_experiance` int(11) DEFAULT NULL,
  `emp_graduate_year` date DEFAULT NULL,
  `emp_phone` int(11) DEFAULT NULL,
  `emp_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `salaray_id` int(11) DEFAULT NULL,
  `job_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `center_employee_tb`
--

INSERT INTO `center_employee_tb` (`emp_id`, `emp_name`, `emp_specialist`, `emp_age`, `emp_gender`, `emp_experiance`, `emp_graduate_year`, `emp_phone`, `emp_email`, `emp_img`, `branch_id`, `salaray_id`, `job_id`, `created_at`, `updated_at`) VALUES
(1, 'أحمد فتحي حلس', 'تكنولوجيا تعليم', 30, 'm', 5, NULL, 599541142, NULL, NULL, 3, NULL, 4, '2017-07-01 07:38:35', '2017-07-04 06:52:20'),
(2, 'ياسمين أحمد الخالدي', 'سكرتاريا2', 26, 'm', 3, NULL, 599000222, NULL, NULL, 4, NULL, 2, '2017-07-01 07:39:21', '2017-07-01 08:34:26'),
(3, 'الاء يوسف محمود أبو كميل', 'رياضيات', 25, 'f', 5, NULL, 597228578, 'gaza192@hotmail.com', NULL, 4, NULL, 2, '2017-07-01 08:01:03', '2017-07-01 08:35:27');

-- --------------------------------------------------------

--
-- Table structure for table `center_group_students_tb`
--

CREATE TABLE `center_group_students_tb` (
  `tag_no` int(10) UNSIGNED NOT NULL,
  `group_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `payment_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `payment_value` double(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `center_group_students_tb`
--

INSERT INTO `center_group_students_tb` (`tag_no`, `group_id`, `student_id`, `payment_status`, `payment_value`, `created_at`, `updated_at`) VALUES
(61, 7, 4, 'F', 50.00, '2017-07-14 19:35:07', '2017-07-15 05:57:47'),
(60, 7, 9, 'F', 30.00, '2017-07-14 19:35:07', '2017-07-15 07:10:31'),
(59, 7, 7, 'F', 30.00, '2017-07-14 19:35:07', '2017-07-15 10:28:10'),
(71, 14, 9, 'F', 30.00, '2017-07-15 07:04:48', '2017-07-15 07:10:31'),
(67, 8, 11, 'P', 15.00, '2017-07-15 07:02:39', '2017-07-17 04:03:12'),
(15, 11, 10, 'N', 0.00, '2017-07-13 08:51:40', '2017-07-13 08:51:40'),
(16, 12, 4, 'F', 50.00, '2017-07-14 08:02:44', '2017-07-15 05:57:47'),
(17, 12, 10, 'N', 0.00, '2017-07-14 08:02:44', '2017-07-14 08:02:44'),
(18, 12, 11, 'P', 15.00, '2017-07-14 08:02:44', '2017-07-17 04:03:12'),
(19, 12, 9, 'F', 30.00, '2017-07-14 08:02:44', '2017-07-15 07:10:31'),
(20, 12, 7, 'F', 30.00, '2017-07-14 08:02:44', '2017-07-15 10:28:10'),
(74, 7, 10, 'P', 20.00, '2017-07-15 19:52:57', '2017-07-15 19:52:57'),
(75, 7, 11, 'P', 15.00, '2017-07-15 19:52:57', '2017-07-17 04:03:12'),
(66, 8, 7, 'F', 30.00, '2017-07-15 07:02:39', '2017-07-15 10:28:10'),
(70, 14, 10, 'N', 0.00, '2017-07-15 07:04:48', '2017-07-15 07:04:48');

-- --------------------------------------------------------

--
-- Table structure for table `center_group_tb`
--

CREATE TABLE `center_group_tb` (
  `group_id` int(10) UNSIGNED NOT NULL,
  `group_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_start_date` date NOT NULL,
  `emp_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `center_group_tb`
--

INSERT INTO `center_group_tb` (`group_id`, `group_name`, `group_start_date`, `emp_id`, `branch_id`, `created_at`, `updated_at`) VALUES
(8, 'مجموعة رياضيات صف اول الاستاذ احمد', '2017-07-14', 1, 3, '2017-07-12 16:24:18', '2017-07-15 07:02:39'),
(7, 'مجموعة رياضيات ب', '2017-07-12', 3, 4, '2017-07-12 15:56:17', '2017-07-14 19:04:18'),
(14, 'مجموعة رياضيات صف تالت الاستاذ احمد', '2017-07-15', 1, 4, '2017-07-15 07:04:01', '2017-07-15 07:04:01'),
(11, 'مجموعة رياضيات صف تاني الاستاذ احمد', '2017-07-20', 1, 4, '2017-07-13 08:51:40', '2017-07-13 08:51:40'),
(12, 'عربي صف تاني', '2017-07-14', 2, 4, '2017-07-14 08:02:44', '2017-07-14 08:02:44');

-- --------------------------------------------------------

--
-- Table structure for table `center_jobs_table`
--

CREATE TABLE `center_jobs_table` (
  `job_id` int(11) NOT NULL,
  `job_name` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `center_jobs_table`
--

INSERT INTO `center_jobs_table` (`job_id`, `job_name`) VALUES
(2, 'مدرس'),
(3, 'سكرتير'),
(4, 'مدير'),
(5, 'نائب مدير'),
(6, 'آذن'),
(7, 'متدرب'),
(8, 'محاسب'),
(9, 'إداري'),
(10, 'موظف');

-- --------------------------------------------------------

--
-- Table structure for table `center_levels_tb`
--

CREATE TABLE `center_levels_tb` (
  `level_id` int(10) UNSIGNED NOT NULL,
  `level_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `center_levels_tb`
--

INSERT INTO `center_levels_tb` (`level_id`, `level_name`, `created_at`, `updated_at`) VALUES
(1, 'الصف الأول', NULL, NULL),
(2, 'الصف الثاني', NULL, NULL),
(3, 'الصف الثالث', NULL, NULL),
(4, 'الصف الرابع', NULL, NULL),
(5, 'الصف الخامس', NULL, NULL),
(6, 'الصف السادس', NULL, NULL),
(7, 'الصف السابع', NULL, NULL),
(8, 'الصف الثامن', NULL, NULL),
(9, 'الصف التاسع', NULL, NULL),
(10, 'الصف العاشر', NULL, NULL),
(11, 'الصف الحادي عشر', NULL, NULL),
(12, 'الصف الثاني عشر', NULL, NULL),
(13, 'بكالورويس جامعة', NULL, NULL),
(14, 'دبلوم جامعة', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `center_opening_tb`
--

CREATE TABLE `center_opening_tb` (
  `id` int(11) NOT NULL,
  `center_id` int(11) NOT NULL,
  `open_start_date` date NOT NULL,
  `open_end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `center_opening_tb`
--

INSERT INTO `center_opening_tb` (`id`, `center_id`, `open_start_date`, `open_end_date`, `created_at`, `updated_at`) VALUES
(2, 4, '2017-07-01', '2018-08-31', '2017-07-02 04:01:46', '2017-07-02 04:24:07'),
(13, 4, '2017-06-22', NULL, '2017-07-02 05:00:55', '2017-07-02 05:00:55'),
(12, 4, '2017-06-01', '2017-06-21', '2017-07-02 04:59:53', '2017-07-02 05:00:55'),
(11, 4, '2018-09-01', '2017-05-31', '2017-07-02 04:24:07', '2017-07-02 04:59:53');

-- --------------------------------------------------------

--
-- Table structure for table `center_owner_tb`
--

CREATE TABLE `center_owner_tb` (
  `center_owner_id` int(10) UNSIGNED NOT NULL,
  `center_owner_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `center_owner_address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `center_owner_phone` int(11) DEFAULT NULL,
  `center_owner_age` int(11) DEFAULT NULL,
  `center_owner_gender` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `center_permissions_tb`
--

CREATE TABLE `center_permissions_tb` (
  `permission_no` int(10) UNSIGNED NOT NULL,
  `permission_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission_parent_no` int(11) DEFAULT NULL,
  `is_operation` int(11) DEFAULT '0',
  `permission_type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'child',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `center_permissions_tb`
--

INSERT INTO `center_permissions_tb` (`permission_no`, `permission_name`, `permission_parent_no`, `is_operation`, `permission_type`, `created_at`, `updated_at`) VALUES
(1, 'شجرة الصلاحيات - نظام تعليمي', 0, 0, 'parent', NULL, NULL),
(66, 'Delete', 65, 1, 'child', '2017-06-13 06:09:37', '2017-06-13 06:09:37'),
(67, 'Show', 65, 1, 'child', '2017-06-13 06:09:37', '2017-06-13 06:09:37'),
(65, 'صلاحيات المستخدمين', 64, 0, 'child', '2017-06-13 06:09:37', '2017-06-13 06:09:37'),
(64, 'إدارة المستخدمين', 1, 0, 'child', '2017-06-13 06:09:20', '2017-06-13 06:09:20'),
(59, 'Show', 55, 1, 'child', '2017-06-13 06:07:31', '2017-06-13 06:07:31'),
(58, 'Delete', 55, 1, 'child', '2017-06-13 06:07:31', '2017-06-13 06:07:31'),
(57, 'Edit', 55, 1, 'child', '2017-06-13 06:07:31', '2017-06-13 06:07:31'),
(56, 'Add', 55, 1, 'child', '2017-06-13 06:07:31', '2017-06-13 06:07:31'),
(55, 'إدارة الصلاحيات', 31, 0, 'child', '2017-06-13 06:07:31', '2017-06-13 06:07:31'),
(51, 'Show', 47, 1, 'child', '2017-06-13 06:04:10', '2017-06-13 06:04:10'),
(50, 'Delete', 47, 1, 'child', '2017-06-13 06:04:10', '2017-06-13 06:04:10'),
(49, 'Edit', 47, 1, 'child', '2017-06-13 06:04:10', '2017-06-13 06:04:10'),
(48, 'Add', 47, 1, 'child', '2017-06-13 06:04:10', '2017-06-13 06:04:10'),
(47, 'إدارة فروع المركز', 31, 0, 'child', '2017-06-13 06:04:10', '2017-06-13 06:04:10'),
(46, 'Show', 42, 1, 'child', '2017-06-13 05:59:53', '2017-06-13 05:59:53'),
(45, 'Delete', 42, 1, 'child', '2017-06-13 05:59:53', '2017-06-13 05:59:53'),
(44, 'Edit', 42, 1, 'child', '2017-06-13 05:59:53', '2017-06-13 05:59:53'),
(43, 'Add', 42, 1, 'child', '2017-06-13 05:59:53', '2017-06-13 05:59:53'),
(42, 'إدارة بيانات المركز', 31, 0, 'child', '2017-06-13 05:59:53', '2017-06-13 05:59:53'),
(31, 'إدارة عامة', 1, 0, 'child', '2017-06-13 05:47:44', '2017-06-13 05:47:44'),
(68, 'Grant', 65, 1, 'child', '2017-06-13 06:09:37', '2017-06-13 06:09:37'),
(69, 'بيانات المستخدمين', 64, 0, 'child', '2017-06-13 06:10:19', '2017-06-13 06:10:19'),
(70, 'Add', 69, 1, 'child', '2017-06-13 06:10:19', '2017-06-13 06:10:19'),
(71, 'Edit', 69, 1, 'child', '2017-06-13 06:10:19', '2017-06-13 06:10:19'),
(72, 'Delete', 69, 1, 'child', '2017-06-13 06:10:19', '2017-06-13 06:10:19'),
(73, 'Show', 69, 1, 'child', '2017-06-13 06:10:19', '2017-06-13 06:10:19'),
(74, 'تاريخ تعديلات المستخدمين', 64, 0, 'child', '2017-06-13 06:10:45', '2017-06-13 06:10:45'),
(77, 'Show', 74, 1, 'operation', '2017-06-13 13:05:21', '2017-06-13 13:05:21');

-- --------------------------------------------------------

--
-- Table structure for table `center_permissions_users_tb`
--

CREATE TABLE `center_permissions_users_tb` (
  `tag_no` int(10) UNSIGNED NOT NULL,
  `permission_no` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `center_permissions_users_tb`
--

INSERT INTO `center_permissions_users_tb` (`tag_no`, `permission_no`, `user_id`, `created_at`, `updated_at`) VALUES
(150, 31, 1, '2017-06-18 11:30:19', '2017-06-18 11:30:19'),
(149, 77, 1, '2017-06-18 11:30:19', '2017-06-18 11:30:19'),
(85, 43, 31, '2017-06-17 12:21:42', '2017-06-17 12:21:42'),
(84, 44, 31, '2017-06-17 12:21:42', '2017-06-17 12:21:42'),
(83, 45, 31, '2017-06-17 12:21:42', '2017-06-17 12:21:42'),
(82, 46, 31, '2017-06-17 12:21:42', '2017-06-17 12:21:42'),
(81, 42, 31, '2017-06-17 12:21:42', '2017-06-17 12:21:42'),
(80, 48, 31, '2017-06-17 12:21:41', '2017-06-17 12:21:41'),
(79, 49, 31, '2017-06-17 12:21:41', '2017-06-17 12:21:41'),
(78, 50, 31, '2017-06-17 12:21:41', '2017-06-17 12:21:41'),
(77, 51, 31, '2017-06-17 12:21:41', '2017-06-17 12:21:41'),
(76, 47, 31, '2017-06-17 12:21:41', '2017-06-17 12:21:41'),
(75, 56, 31, '2017-06-17 12:21:41', '2017-06-17 12:21:41'),
(74, 57, 31, '2017-06-17 12:21:41', '2017-06-17 12:21:41'),
(73, 58, 31, '2017-06-17 12:21:41', '2017-06-17 12:21:41'),
(72, 59, 31, '2017-06-17 12:21:41', '2017-06-17 12:21:41'),
(71, 55, 31, '2017-06-17 12:21:41', '2017-06-17 12:21:41'),
(70, 31, 31, '2017-06-17 12:21:41', '2017-06-17 12:21:41'),
(69, 73, 31, '2017-06-17 12:21:41', '2017-06-17 12:21:41'),
(68, 72, 31, '2017-06-17 12:21:41', '2017-06-17 12:21:41'),
(67, 71, 31, '2017-06-17 12:21:41', '2017-06-17 12:21:41'),
(66, 70, 31, '2017-06-17 12:21:41', '2017-06-17 12:21:41'),
(65, 69, 31, '2017-06-17 12:21:41', '2017-06-17 12:21:41'),
(64, 67, 31, '2017-06-17 12:21:41', '2017-06-17 12:21:41'),
(63, 65, 31, '2017-06-17 12:21:41', '2017-06-17 12:21:41'),
(62, 64, 31, '2017-06-17 12:21:41', '2017-06-17 12:21:41'),
(61, 1, 31, '2017-06-17 12:21:41', '2017-06-17 12:21:41'),
(148, 74, 1, '2017-06-18 11:30:19', '2017-06-18 11:30:19'),
(147, 73, 1, '2017-06-18 11:30:19', '2017-06-18 11:30:19'),
(146, 72, 1, '2017-06-18 11:30:19', '2017-06-18 11:30:19'),
(145, 71, 1, '2017-06-18 11:30:19', '2017-06-18 11:30:19'),
(144, 70, 1, '2017-06-18 11:30:19', '2017-06-18 11:30:19'),
(143, 69, 1, '2017-06-18 11:30:19', '2017-06-18 11:30:19'),
(142, 68, 1, '2017-06-18 11:30:19', '2017-06-18 11:30:19'),
(141, 67, 1, '2017-06-18 11:30:18', '2017-06-18 11:30:18'),
(140, 66, 1, '2017-06-18 11:30:18', '2017-06-18 11:30:18'),
(139, 65, 1, '2017-06-18 11:30:18', '2017-06-18 11:30:18'),
(138, 64, 1, '2017-06-18 11:30:18', '2017-06-18 11:30:18'),
(137, 1, 1, '2017-06-18 11:30:18', '2017-06-18 11:30:18'),
(151, 55, 1, '2017-06-18 11:30:19', '2017-06-18 11:30:19'),
(152, 59, 1, '2017-06-18 11:30:19', '2017-06-18 11:30:19'),
(153, 58, 1, '2017-06-18 11:30:19', '2017-06-18 11:30:19'),
(154, 57, 1, '2017-06-18 11:30:19', '2017-06-18 11:30:19'),
(155, 56, 1, '2017-06-18 11:30:19', '2017-06-18 11:30:19'),
(156, 47, 1, '2017-06-18 11:30:19', '2017-06-18 11:30:19'),
(157, 51, 1, '2017-06-18 11:30:19', '2017-06-18 11:30:19'),
(158, 50, 1, '2017-06-18 11:30:19', '2017-06-18 11:30:19'),
(159, 49, 1, '2017-06-18 11:30:19', '2017-06-18 11:30:19'),
(160, 48, 1, '2017-06-18 11:30:19', '2017-06-18 11:30:19'),
(161, 42, 1, '2017-06-18 11:30:19', '2017-06-18 11:30:19'),
(162, 46, 1, '2017-06-18 11:30:19', '2017-06-18 11:30:19'),
(163, 45, 1, '2017-06-18 11:30:19', '2017-06-18 11:30:19'),
(164, 44, 1, '2017-06-18 11:30:19', '2017-06-18 11:30:19'),
(165, 43, 1, '2017-06-18 11:30:19', '2017-06-18 11:30:19'),
(173, 71, 32, '2017-06-18 12:38:47', '2017-06-18 12:38:47'),
(172, 69, 32, '2017-06-18 12:38:47', '2017-06-18 12:38:47'),
(171, 64, 32, '2017-06-18 12:38:47', '2017-06-18 12:38:47'),
(170, 1, 32, '2017-06-18 12:38:47', '2017-06-18 12:38:47');

-- --------------------------------------------------------

--
-- Table structure for table `center_salaray_tb`
--

CREATE TABLE `center_salaray_tb` (
  `salary_id` int(10) UNSIGNED NOT NULL,
  `emp_id` int(11) NOT NULL,
  `salaray_type` int(11) NOT NULL,
  `salary_month` int(11) NOT NULL,
  `salaray_type_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `center_students_tb`
--

CREATE TABLE `center_students_tb` (
  `student_id` int(10) UNSIGNED NOT NULL,
  `student_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_father_work` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_phone` int(11) DEFAULT NULL,
  `student_phone2` int(11) DEFAULT NULL,
  `student_age` int(11) DEFAULT NULL,
  `student_gender` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_reg_date` date DEFAULT NULL,
  `student_school` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `center_students_tb`
--

INSERT INTO `center_students_tb` (`student_id`, `student_name`, `student_father_work`, `student_address`, `student_phone`, `student_phone2`, `student_age`, `student_gender`, `student_reg_date`, `student_school`, `branch_id`, `level_id`, `created_at`, `updated_at`) VALUES
(3, 'الاء يوسف ابو كميل', 'مهندس', 'حي الشجاعية', 599542463, 2801477, 25, 'f', '2017-06-21', 'الجامعة الاسلامية', 3, 12, '2017-06-20 22:37:59', '2017-06-23 22:34:58'),
(4, 'مصطفى فتحي خضير حلس', 'مدرس', 'الشجاعية', 599542463, 280, 25, 'm', '2017-07-03', 'يييي', 3, 13, '2017-06-20 22:41:19', '2017-07-08 15:13:20'),
(5, 'زينة سائد فتحي حلس', 'موظف سلطة', 'شرق شارع الخط الشرقي', 599542468, 2802070, 14, 'f', '2017-06-22', 'مدرسة الناصرة أ', 3, 8, '2017-06-21 13:16:32', '2017-06-21 13:16:32'),
(7, 'يزن محمد فتحي حلس', 'موظف غزة', 'شارع الطواحين', 599595550, 2801477, 10, NULL, '2017-06-23', 'مدرسة ابن الهيثم للبنين أ', 4, 3, '2017-06-21 13:23:23', '2017-06-21 13:23:23'),
(9, 'مراد عبدالكريم حلس', 'موظف سلطة', 'الشجاعية', 599875632, 28114455, 9, 'm', '2017-06-23', 'مدرسة حطين', 4, 1, '2017-06-23 14:57:09', '2017-07-03 05:48:48'),
(10, 'بيان محمد فتحي حلس', NULL, NULL, NULL, NULL, NULL, 'm', '2017-06-25', NULL, 4, 1, '2017-06-23 17:28:24', '2017-06-23 17:28:24'),
(11, 'عبدالكريم توفيق حلس', NULL, NULL, NULL, NULL, NULL, NULL, '2017-06-24', NULL, 4, 9, '2017-06-23 17:28:50', '2017-06-23 17:31:56'),
(12, 'براء خالد ابو العطا', NULL, NULL, NULL, NULL, NULL, NULL, '2017-06-13', NULL, 4, 7, '2017-06-23 17:29:12', '2017-06-23 17:31:46'),
(17, 'ابراهيم ضياء شمالي', NULL, NULL, NULL, NULL, NULL, NULL, '2017-06-08', NULL, 4, 8, '2017-06-29 08:02:54', '2017-06-29 08:02:54'),
(15, 'مؤيد عبدالله ابو العطا', NULL, NULL, NULL, NULL, NULL, NULL, '2017-06-10', NULL, 4, 3, '2017-06-23 17:29:51', '2017-06-23 17:30:57');

-- --------------------------------------------------------

--
-- Table structure for table `center_student_course_tb`
--

CREATE TABLE `center_student_course_tb` (
  `tag_no` int(10) UNSIGNED NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `center_student_recyclebin`
--

CREATE TABLE `center_student_recyclebin` (
  `student_id` int(10) UNSIGNED NOT NULL,
  `student_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_father_work` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_phone` int(11) DEFAULT NULL,
  `student_phone2` int(11) DEFAULT NULL,
  `student_age` int(11) DEFAULT NULL,
  `student_gender` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_reg_date` date DEFAULT NULL,
  `student_school` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `center_student_recyclebin`
--

INSERT INTO `center_student_recyclebin` (`student_id`, `student_name`, `student_father_work`, `student_address`, `student_phone`, `student_phone2`, `student_age`, `student_gender`, `student_reg_date`, `student_school`, `branch_id`, `level_id`, `created_at`, `updated_at`) VALUES
(2, 'غيداء عبدلله ابو العطا', NULL, NULL, NULL, NULL, NULL, NULL, '2017-06-16', NULL, 3, 10, '2017-06-23 23:19:13', '2017-06-23 23:19:13'),
(3, 'نادين ضياء شمالي', NULL, NULL, NULL, NULL, NULL, NULL, '2017-06-22', NULL, 3, 10, '2017-06-23 23:21:10', '2017-06-23 23:21:10'),
(4, 'شهد سائد حلس', 'مهندس', 'الشجاعية', 5995422, 2805020, 20, 'm', '2017-06-23', 'اللد', 3, 6, '2017-06-23 23:22:14', '2017-06-23 23:22:14');

-- --------------------------------------------------------

--
-- Table structure for table `educational_center_tb`
--

CREATE TABLE `educational_center_tb` (
  `center_id` int(10) UNSIGNED NOT NULL,
  `center_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `center_address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `center_cover_img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `center_phone` int(11) DEFAULT NULL,
  `center_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `center_owner` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `center_user_id` int(11) NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `first_open_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `educational_center_tb`
--

INSERT INTO `educational_center_tb` (`center_id`, `center_name`, `center_address`, `center_cover_img`, `center_phone`, `center_email`, `center_owner`, `center_user_id`, `status`, `first_open_date`, `created_at`, `updated_at`) VALUES
(3, 'مركز السلام التعليمي', NULL, 'default_center_img.png', 59954245, 'gaza@hot.com', 'مصطفى فتحي حلس', 4, 'active', '2017-06-01', '2017-06-10 08:16:22', '2017-06-10 08:16:22'),
(4, 'مركز النور التعليمي مصطفى', NULL, '1497179886.jpg', 599542222, 'gaffffffza2@hot.com', 'مصطفى فتحي حلس 3', 1, 'active', NULL, '2017-06-10 08:31:43', '2017-06-12 05:35:31'),
(5, 'مركز النور التعليمي', NULL, 'default_center.png', 599542452, 'gaza2@hot.com', 'مصطفى فتحي حلس', 3, 'inactive', NULL, '2017-06-10 14:26:23', '2017-06-11 08:12:56'),
(6, 'مركز النور التعليمي', 'الشجاعية', 'default_center.png', 599542452, 'gaza2@hot.com', 'أحمد فتحي حلس', 3, 'active', NULL, '2017-06-10 14:26:49', '2017-06-10 14:26:49'),
(7, 'مركز النور التعليمي', 'الشجاعية', 'default_center.png', 599542452, 'gaza2@hot.com', 'أحمد فتحي حلس', 3, 'active', NULL, '2017-06-10 14:29:54', '2017-06-10 14:29:54'),
(8, 'مركز الانوار التعليمي', NULL, 'default_center.png', 599542452, 'gaza2@hot.com', 'مصطفى فتحي حلس', 5, 'active', NULL, '2017-06-10 14:37:51', '2017-06-10 14:37:51'),
(9, 'مركز الانوار التعليمي', NULL, 'default_center.png', 599542452, 'gaza2@hot.com', 'مصطفى فتحي حلس', 5, 'active', NULL, '2017-06-10 14:38:25', '2017-06-10 14:38:25'),
(10, 'مركز الانوار التعليمي', NULL, 'default_center.png', 599542452, 'gaza2@hot.com', 'مصطفى فتحي حلس', 5, 'inactive', NULL, '2017-06-10 14:39:44', '2017-06-11 08:13:04');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(166, '2014_10_12_000000_create_users_table', 1),
(167, '2014_10_12_100000_create_password_resets_table', 1),
(168, '2017_06_03_100000_create_center_levels_tb', 1),
(169, '2017_06_03_200000_create_center_owner_table', 1),
(170, '2017_06_03_300000_create_center_courses_table', 1),
(171, '2017_06_03_400000_create_center_permissions_table', 1),
(172, '2017_06_03_500000_create_center_salaray_table', 1),
(173, '2017_06_03_600000_create_educational_center_table', 1),
(174, '2017_06_03_700000_create_center_branch_tb', 1),
(175, '2017_06_03_800000_create_center_employee_table', 1),
(176, '2017_06_03_900000_create_center_students_table', 1),
(177, '2017_06_03_910000_create_center_permissions_users_table', 1),
(178, '2017_06_03_920000_create_center_branch_users_table', 1),
(179, '2017_06_03_930000_create_center_student_course_table', 1),
(180, '2017_06_03_940000_create_center_branch_salaray_table', 1),
(181, '2017_06_03_950000_create_center_employee_salaray_table', 1),
(182, '2017_06_24_015229_create_center_recyclebin_student_table', 2),
(183, '2017_07_01_083234_center_jobs_table', 1),
(184, '2017_07_02_054931_center_opening_tb', 1),
(185, '2017_07_11_160400_center_group_tb', 3),
(186, '2017_07_11_162653_center_appointment_tb', 4),
(187, '2017_07_12_084145_center_group_students_tb', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'm',
  `img` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default_user.png',
  `center_id` int(11) NOT NULL DEFAULT '0',
  `phone` int(11) NOT NULL DEFAULT '599',
  `language` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ar',
  `privilege_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'normal',
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `gender`, `img`, `center_id`, `phone`, `language`, `privilege_type`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'mhilles', 'gaza192@hotmail.com', '$2y$10$7Jdx7MfK2PDYRz9R2wdfvubDCIewC14oquHPW4kbG113Qv9vMfiQC', 'm', '1499582933.jpg', 4, 599542463, 'ar', 'admin', 'active', '58n14yHwtZ7dFICPwl9BiEqgrdn09Zi8Prg9Fzt3DzzFwYNSPd83tgHJrU75', '2017-06-08 05:42:49', '2017-07-09 03:48:54'),
(2, 'mohammed', 'wfqwddsq@hotmail.com', '$2y$10$XLU6W9lDIkF0Ftl6nDUaPOGmJgAsi42EI9HiGhr4sooVEchPHET2W', 'm', 'default_user.png', 0, 59954222, 'ar', 'normal', 'active', NULL, '2017-06-08 21:32:27', '2017-06-08 21:32:27'),
(3, 'ahmed', 'wqwq@hotmail.coma', '$2y$10$65dgC8K7hM.v1qHVbZ7/ue27Xh3InE1eI9E9WZs3r8B90sKMwD.7u', 'm', 'default_user.png', 3, 5995488, 'ar', 'normal', 'active', 'hXEGcGB8vZrjHPWPVpKdeaxrYQK2qA8yL3HZMFZ8BWFHJOwIc1YEJfJjra04', '2017-06-08 21:33:07', '2017-06-10 14:29:54'),
(4, 'khalid', 'wqswq@hotmail.coma', '$2y$10$mSYzYaB/6rrtFRxqzdm4veMYCXFFX2b7kRezRqe1T4eAJTzKPQr.y', 'm', 'default_user.png', 3, 5995488, 'ar', 'normal', 'active', NULL, '2017-06-08 21:33:36', '2017-06-10 08:16:22'),
(5, 'yousof', 'wqaswq@hotmail.coma', '$2y$10$UxjN3gxJRHwk.1iWGCyG6OaGlBAYYMx53Y3dtJXYaulVB6YT6lgpG', 'm', 'default_user.png', 10, 5995488, 'ar', 'normal', 'inactive', '8AGRN3zPMpisuAsT9bJPzYQDZrRgx4qWNg1Vl93YOA46uNxRvRkDJ4ZaPiNU', '2017-06-08 21:33:48', '2017-06-11 08:13:04'),
(6, 'alaa', 'wqasswq@hotmail.coma', '$2y$10$KeOXqH6DUzv2u5xmo2nP1.80/wte9WmHMiZcWSP6CkmN5H1g2DO6e', 'f', 'default_user.png', 0, 5995488, 'ar', 'normal', 'active', NULL, '2017-06-08 21:34:02', '2017-06-08 21:34:02'),
(7, 'smira', 'wqapswq@hotmail.coma', '$2y$10$Cf2DkzVzbnfS/UCZO83FTui/5/EIKpdw83LLSemkxWGLnwfNnqwba', 'f', 'default_user.png', 0, 5995488, 'ar', 'normal', 'active', NULL, '2017-06-08 21:34:13', '2017-06-08 21:34:13'),
(8, 'saleem', 'wfqwddxsq@hotmail.com', '$2y$10$KcIjvHtmXvMdLbL2EpCsGeWayJNZL.em11HLXIjy7sLK0Dj9RsdOS', 'm', 'default_user.png', 0, 599875442, 'ar', 'normal', 'active', NULL, '2017-06-09 10:25:38', '2017-06-09 10:25:38'),
(9, 'khload', 'wfqwddxssq@hotmail.com', '$2y$10$lG/UT/.1HY3gltNjMToFi.s5VQGAB2Z70tCmfHqNhcxQEu0EJIbS6', 'm', 'default_user.png', 0, 599875442, 'ar', 'normal', 'active', NULL, '2017-06-09 10:25:50', '2017-06-09 10:25:50'),
(10, 'amer', 'wfqwddxr@hotmail.com', '$2y$10$QOMRCDurLl90OE1vHlM3peC3jTRzTKad35RKAueQ6m6CluK0zLoT.', 'm', 'default_user.png', 0, 599875442, 'ar', 'normal', 'active', NULL, '2017-06-09 10:26:01', '2017-06-09 10:26:01'),
(11, 'yehia', 'wffddxr@hotmail.com', '$2y$10$Tl2ydJXZgtte3HS1BrmRuO8rWwtF7Q2mQo0XDJvm0nAX0ETSbX7yO', 'm', 'default_user.png', 0, 599875442, 'ar', 'normal', 'active', NULL, '2017-06-09 10:26:09', '2017-06-09 10:26:09'),
(12, 'mofida', 'wwqwq@hotmail.coma', '$2y$10$h1fu.qK0A8hbOLM.FxKGAOndb7yNyXP48Kt/Vt1EBue05mHdtngb2', 'm', 'default_user.png', 0, 2131234, 'ar', 'normal', 'active', NULL, '2017-06-09 11:47:24', '2017-06-09 11:47:24'),
(13, 'fathi', 'wwqdwq@hotmail.coma', '$2y$10$i68v7OZ3MmncWd6PyUr0g.KKgfS1yG9ycPuOfkaUtMANV9xrEBR8i', 'm', 'default_user.png', 0, 2131234, 'ar', 'normal', 'active', NULL, '2017-06-09 11:47:31', '2017-06-09 11:47:31'),
(14, 'omar', 'wwdsdwq@hotmail.coma', '$2y$10$t9atKxsL4ol4.viqvzn2y.vm2axS8hp4KJoERZPdcSvjjomyftADC', 'm', 'default_user.png', 0, 2131234, 'ar', 'normal', 'active', NULL, '2017-06-09 11:47:37', '2017-06-09 11:47:37'),
(15, 'saed', 'wwdsdf@hotmail.coma', '$2y$10$sEYLkjtJhmoO30oc4FVE/.goqIV4PK0UE9quSDYiozm5UgarbSO8G', 'm', 'default_user.png', 0, 2131234, 'ar', 'normal', 'active', NULL, '2017-06-09 11:47:43', '2017-06-09 11:47:43'),
(16, 'ahed', 'wwss@hotmail.coma', '$2y$10$.LmcRO/Bk5Yod7ud4fOsi.3Ua2mUuJXi/4l4z1QiPAFtAcbsPiYFa', 'm', 'default_user.png', 0, 2131234, 'ar', 'normal', 'active', NULL, '2017-06-09 11:47:49', '2017-06-09 11:47:49'),
(17, 'khudair', 'wssss@hotmail.coma', '$2y$10$KDAFVOzdvKD0MjePPFJleOwBKdaxvCKf/nT1IUOSffw/jL/2tbX2S', 'm', 'default_user.png', 0, 2131234, 'ar', 'normal', 'active', NULL, '2017-06-09 11:47:57', '2017-06-09 11:47:57'),
(18, 'abed', 'wsasss@hotmail.coma', '$2y$10$LU3AOUdIpHQKN9j7RrNHBuYFST.CaiJ4bJ7tq7nXHgbXAJ7RFtszy', 'm', 'default_user.png', 0, 2131234, 'ar', 'normal', 'active', NULL, '2017-06-09 11:48:02', '2017-06-09 11:48:02'),
(19, 'asdsd', 'wsdswddq@hotmail.com', '$2y$10$WWHs8Wxz7brQlFNNoAm.tuLhmAzjLsgXpr2nqiqP2F3w3pzxq5tMO', 'm', 'default_user.png', 0, 3242343, 'ar', 'normal', 'active', NULL, '2017-06-09 14:37:57', '2017-06-09 14:37:57'),
(20, 'asdsdds', 'wssdswddq@hotmail.com', '$2y$10$NR1HNpv6thFFbZtQMiPvqe.s1EAk58jPG0P.Q2u6K6Skz/Li323Ja', 'm', 'default_user.png', 0, 3242343, 'ar', 'normal', 'active', NULL, '2017-06-09 14:39:29', '2017-06-09 14:39:29'),
(21, 'asdsfff', 'wssdddq@hotmail.com', '$2y$10$327xcFU4LWZP/WuHVyxPKOZsrtffE3ReNp.Kjms4ZMekCffVwFtFK', 'm', 'default_user.png', 0, 3242343, 'ar', 'normal', 'active', NULL, '2017-06-09 14:41:17', '2017-06-09 14:41:17'),
(22, 'asdsffff', 'wdssdddq@hotmail.com', '$2y$10$QcXVEQ6BPZ7kPCG58uxb4.x/u/ufAHfp/g2sTn.zAWut7vLMKRahu', 'm', 'default_user.png', 0, 3242343, 'ar', 'normal', 'active', NULL, '2017-06-09 14:56:45', '2017-06-09 14:56:45'),
(23, 'asdsffsff', 'wdssadddq@hotmail.com', '$2y$10$XSJNes.PlEefBC4CjD9sLeVvP0miDjr4HUEBoYs8gqocgTs/8O8MG', 'm', 'default_user.png', 0, 3242343, 'ar', 'normal', 'active', NULL, '2017-06-09 14:56:49', '2017-06-09 14:56:49'),
(24, 'asdsffsfff', 'wdssadddrq@hotmail.com', '$2y$10$X1GiLrUjKgC2bz1QoXUIBediSiyv7nzOuHfOs53pR4ZL6bA0Nmxie', 'm', 'default_user.png', 0, 3242343, 'ar', 'normal', 'active', NULL, '2017-06-09 14:56:54', '2017-06-09 14:56:54'),
(25, 'assdsffsfff', 'wdssadq@hotmail.com', '$2y$10$.W3UTsrEthcj0suAJ11v2eCkS505ooQra4GxeaSbrh2eK1XAP5lE2', 'm', 'default_user.png', 0, 3242343, 'ar', 'normal', 'active', NULL, '2017-06-09 14:57:00', '2017-06-09 14:57:00'),
(26, 'asdsfffff', 'wdssdq@hotmail.com', '$2y$10$fIx8Y3jaewstyzuLNsyQrO8GHuIvj5HWJbXxwm7b5aXz4wPfLAY0O', 'm', 'default_user.png', 0, 3242343, 'ar', 'normal', 'active', NULL, '2017-06-09 14:57:08', '2017-06-09 14:57:08'),
(27, 'iuuufffff', 'wdsxxq@hotmail.com', '$2y$10$3yDjhcQhFMxLbzCR060Fk.v8ohYdjT1xrSaop21DdAkPj53rIc8Ma', 'm', 'default_user.png', 0, 3242343, 'ar', 'normal', 'active', NULL, '2017-06-09 14:57:21', '2017-06-09 14:57:21'),
(28, 'iuudfffff', 'wdyxq@hotmail.com', '$2y$10$C0gTRrKxXRfFPma1FIMVu.D7.BlDOIDhBXmDQAzMXdRIWwZ83.YhS', 'm', 'default_user.png', 0, 3242343, 'ar', 'normal', 'active', NULL, '2017-06-09 14:57:27', '2017-06-09 14:57:27'),
(29, 'iuudffffj', 'wdllxq@hotmail.com', '$2y$10$FqDP3brK3SR6Mxcfi6RJles93hSXQMbSAYmyXfhvt7OklAK8pEJsS', 'm', 'default_user.png', 0, 3242343, 'ar', 'normal', 'active', NULL, '2017-06-09 14:57:36', '2017-06-09 14:57:36'),
(30, 'kamal', 'gdaza192@hotmail.com', '$2y$10$pZJvATENKbFpJkLNebozsORNOrmUmOovptOVjK9lH/wN6mMCSAhoW', 'm', 'default_user.png', 7, 5995422, 'ar', 'normal', 'active', '51z2aiGyiV1LKjrvAW3yqdOn8ZSlK48acqz4MaXtMrTSRpb3XCgFIp7w2gHP', '2017-06-10 14:32:07', '2017-06-10 14:32:07'),
(31, 'sloom', 'wfqdwddsq@hotmail.com', '$2y$10$lDmqtUqmbDWJIY0Hxo6f3evtl391ur0WRYu/.1LEmKRbte0NwndUS', 'm', 'default_user.png', 4, 59987855, 'ar', 'normal', 'active', NULL, '2017-06-11 12:27:02', '2017-06-12 05:35:31'),
(32, 'mkhalid', 'najah2@hotmail.com', '$2y$10$G23O05p2R/GuJmMYcqn/XOm2gvMJEYuQsMnXXVUuv4Tpv5eiUBN5q', 'm', '1497796828.jpg', 4, 599542463, 'ar', 'normal', 'active', 'h5yE2xESMWW2qvcDZcdEYBHndX2DjDcyn2ML6FAyS3e7eUFKk6f8qWrJ4sRF', '2017-06-18 11:40:30', '2017-06-18 11:40:30'),
(35, 'kjfdkjkj', 'wfqesq@hotmail.com', '$2y$10$EZbtWjvlZK57/8GColYcIOfB26s2CeOUgzBMOaVyUTJVrJAS4406K', 'f', 'default_user.png', 4, 599548752, 'ar', 'normal', 'active', NULL, '2017-06-20 16:24:32', '2017-06-20 16:24:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `center_appointment_tb`
--
ALTER TABLE `center_appointment_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `center_branch_salaray_tb`
--
ALTER TABLE `center_branch_salaray_tb`
  ADD PRIMARY KEY (`tag_no`),
  ADD KEY `center_branch_salaray_tb_salaray_id_foreign` (`salaray_id`),
  ADD KEY `center_branch_salaray_tb_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `center_branch_tb`
--
ALTER TABLE `center_branch_tb`
  ADD PRIMARY KEY (`branch_id`),
  ADD KEY `center_branch_tb_center_id_foreign` (`center_id`);

--
-- Indexes for table `center_branch_users_tb`
--
ALTER TABLE `center_branch_users_tb`
  ADD PRIMARY KEY (`tag_no`),
  ADD KEY `center_branch_users_tb_branch_id_foreign` (`branch_id`),
  ADD KEY `center_branch_users_tb_user_id_foreign` (`user_id`);

--
-- Indexes for table `center_courses_tb`
--
ALTER TABLE `center_courses_tb`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `center_courses_tb_level_id_foreign` (`level_id`);

--
-- Indexes for table `center_employee_salaray_tb`
--
ALTER TABLE `center_employee_salaray_tb`
  ADD PRIMARY KEY (`tag_no`),
  ADD KEY `center_employee_salaray_tb_user_inserted_foreign` (`user_inserted`),
  ADD KEY `center_employee_salaray_tb_user_updated_foreign` (`user_updated`);

--
-- Indexes for table `center_employee_tb`
--
ALTER TABLE `center_employee_tb`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `center_employee_tb_branch_id_foreign` (`branch_id`),
  ADD KEY `center_employee_tb_salaray_id_foreign` (`salaray_id`);

--
-- Indexes for table `center_group_students_tb`
--
ALTER TABLE `center_group_students_tb`
  ADD PRIMARY KEY (`tag_no`);

--
-- Indexes for table `center_group_tb`
--
ALTER TABLE `center_group_tb`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `center_jobs_table`
--
ALTER TABLE `center_jobs_table`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `center_levels_tb`
--
ALTER TABLE `center_levels_tb`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `center_opening_tb`
--
ALTER TABLE `center_opening_tb`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `center_id` (`center_id`,`open_start_date`,`open_end_date`);

--
-- Indexes for table `center_owner_tb`
--
ALTER TABLE `center_owner_tb`
  ADD PRIMARY KEY (`center_owner_id`);

--
-- Indexes for table `center_permissions_tb`
--
ALTER TABLE `center_permissions_tb`
  ADD PRIMARY KEY (`permission_no`);

--
-- Indexes for table `center_permissions_users_tb`
--
ALTER TABLE `center_permissions_users_tb`
  ADD PRIMARY KEY (`tag_no`),
  ADD KEY `center_permissions_users_tb_permission_no_foreign` (`permission_no`),
  ADD KEY `center_permissions_users_tb_user_id_foreign` (`user_id`);

--
-- Indexes for table `center_salaray_tb`
--
ALTER TABLE `center_salaray_tb`
  ADD PRIMARY KEY (`salary_id`);

--
-- Indexes for table `center_students_tb`
--
ALTER TABLE `center_students_tb`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `center_students_tb_branch_id_foreign` (`branch_id`),
  ADD KEY `center_students_tb_level_id_foreign` (`level_id`);

--
-- Indexes for table `center_student_course_tb`
--
ALTER TABLE `center_student_course_tb`
  ADD PRIMARY KEY (`tag_no`),
  ADD KEY `center_student_course_tb_student_id_foreign` (`student_id`),
  ADD KEY `center_student_course_tb_course_id_foreign` (`course_id`),
  ADD KEY `center_student_course_tb_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `center_student_recyclebin`
--
ALTER TABLE `center_student_recyclebin`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `center_student_recyclebin_branch_id_foreign` (`branch_id`),
  ADD KEY `center_student_recyclebin_level_id_foreign` (`level_id`);

--
-- Indexes for table `educational_center_tb`
--
ALTER TABLE `educational_center_tb`
  ADD PRIMARY KEY (`center_id`),
  ADD KEY `educational_center_tb_center_user_id_foreign` (`center_user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `center_appointment_tb`
--
ALTER TABLE `center_appointment_tb`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `center_branch_salaray_tb`
--
ALTER TABLE `center_branch_salaray_tb`
  MODIFY `tag_no` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `center_branch_tb`
--
ALTER TABLE `center_branch_tb`
  MODIFY `branch_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `center_branch_users_tb`
--
ALTER TABLE `center_branch_users_tb`
  MODIFY `tag_no` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `center_courses_tb`
--
ALTER TABLE `center_courses_tb`
  MODIFY `course_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `center_employee_salaray_tb`
--
ALTER TABLE `center_employee_salaray_tb`
  MODIFY `tag_no` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `center_employee_tb`
--
ALTER TABLE `center_employee_tb`
  MODIFY `emp_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `center_group_students_tb`
--
ALTER TABLE `center_group_students_tb`
  MODIFY `tag_no` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `center_group_tb`
--
ALTER TABLE `center_group_tb`
  MODIFY `group_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `center_jobs_table`
--
ALTER TABLE `center_jobs_table`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `center_levels_tb`
--
ALTER TABLE `center_levels_tb`
  MODIFY `level_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `center_opening_tb`
--
ALTER TABLE `center_opening_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `center_owner_tb`
--
ALTER TABLE `center_owner_tb`
  MODIFY `center_owner_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `center_permissions_tb`
--
ALTER TABLE `center_permissions_tb`
  MODIFY `permission_no` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `center_permissions_users_tb`
--
ALTER TABLE `center_permissions_users_tb`
  MODIFY `tag_no` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;
--
-- AUTO_INCREMENT for table `center_salaray_tb`
--
ALTER TABLE `center_salaray_tb`
  MODIFY `salary_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `center_students_tb`
--
ALTER TABLE `center_students_tb`
  MODIFY `student_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `center_student_course_tb`
--
ALTER TABLE `center_student_course_tb`
  MODIFY `tag_no` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `center_student_recyclebin`
--
ALTER TABLE `center_student_recyclebin`
  MODIFY `student_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `educational_center_tb`
--
ALTER TABLE `educational_center_tb`
  MODIFY `center_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
