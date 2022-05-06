-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2022 at 07:30 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `drms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_account_tbl`
--

CREATE TABLE `admin_account_tbl` (
  `id` int(11) NOT NULL,
  `admin` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_account_tbl`
--

INSERT INTO `admin_account_tbl` (`id`, `admin`, `pass`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('ro9t2tu4rjd0g4l4fgolcqcqap40ckmr', '::1', 1651853404, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635313835313233363b61646d696e5f49447c733a313a2231223b5549447c733a31313a223535333531323331323531223b73746166665f747970657c733a313a2231223b);

-- --------------------------------------------------------

--
-- Table structure for table `course_handler_tbl`
--

CREATE TABLE `course_handler_tbl` (
  `course_handler_id` int(11) NOT NULL,
  `course_id` varchar(11) NOT NULL,
  `staff_id_ric` varchar(11) NOT NULL DEFAULT '0',
  `staff_id_frontline` varchar(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_handler_tbl`
--

INSERT INTO `course_handler_tbl` (`course_handler_id`, `course_id`, `staff_id_ric`, `staff_id_frontline`) VALUES
(1, '1', '55351231251', '25122132132'),
(2, '2', '55351231251', '25122132132'),
(3, '3', '55351231251', '25122132132'),
(4, '4', '43534543534', '25122132132'),
(5, '5', '43534543534', '25122132132'),
(6, '6', '43534543534', '25122132132'),
(7, '7', '43534543534', '25122132132'),
(8, '10', '43534543534', '25122132132'),
(9, '8', '43534543534', '25122132132'),
(10, '9', '43534543534', '25122132132'),
(11, '11', '43534543534', '25122132132'),
(12, '12', '43534543534', '25122132132'),
(13, '132', '43534543534', '25122132132'),
(14, '13', '52326343242', '41232132131'),
(15, '14', '52326343242', '41232132131'),
(16, '15', '52326343242', '41232132131'),
(17, '16', '52326343242', '63423432432'),
(18, '17', '52326343242', '41232132131'),
(19, '18', '52326343242', '41232132131'),
(20, '19', '52326343242', '63423432432'),
(21, '20', '43534543534', '41232132131'),
(22, '21', '43534543534', '41232132131'),
(23, '22', '43534543534', '41232132131'),
(24, '23', '43534543534', '41232132131'),
(25, '24', '43534543534', '41232132131'),
(26, '25', '35464532343', '41232132131'),
(27, '26', '35464532343', '41232132131'),
(28, '27', '35464532343', '41232132131'),
(29, '28', '35464532343', '41232132131'),
(30, '29', '43534543534', '41232132131'),
(31, '30', '53532421334', '25122132132'),
(32, '31', '53532421334', '25122132132'),
(33, '32', '53532421334', '25122132132'),
(34, '33', '53532421334', '25122132132'),
(35, '34', '53532421334', '25122132132'),
(36, '35', '53532421334', '25122132132'),
(37, '36', '43534543534', '25122132132'),
(38, '37', '43534543534', '25122132132'),
(39, '38', '43534543534', '25122132132'),
(40, '39', '43534543534', '25122132132'),
(41, '40', '43534543534', '25122132132'),
(42, '129', '0', '25122132132'),
(43, '41', '21321321321', '25122132132'),
(44, '42', '21321321321', '25122132132'),
(45, '43', '21321321321', '25122132132'),
(46, '44', '21321321321', '25122132132'),
(47, '45', '21321321321', '25122132132'),
(48, '46', '43534543534', '25122132132'),
(49, '47', '43534543534', '25122132132'),
(50, '130', '0', '0'),
(51, '48', '32623123412', '63423432432'),
(52, '49', '43534543534', '63423432432'),
(53, '50', '43534543534', '63423432432'),
(54, '131', '0', '0'),
(55, '51', '12251241241', '41232132131'),
(56, '52', '12251241241', '41232132131'),
(57, '53', '12251241241', '41232132131'),
(58, '54', '12251241241', '41232132131'),
(59, '55', '12251241241', '41232132131'),
(60, '56', '12251241241', '41232132131'),
(61, '57', '46353453543', '41232132131'),
(62, '58', '46353453543', '41232132131'),
(63, '59', '46353453543', '41232132131'),
(64, '60', '46353453543', '41232132131'),
(65, '61', '46353453543', '41232132131'),
(66, '62', '43534543534', '41232132131'),
(67, '63', '43534543534', '41232132131'),
(68, '64', '43534543534', '41232132131'),
(69, '65', '43534543534', '41232132131'),
(70, '66', '43534543534', '41232132131'),
(71, '133', '43534543534', '41232132131'),
(72, '142', '0', '0'),
(73, '67', '46353453543', '25122132132'),
(74, '68', '46353453543', '25122132132'),
(75, '69', '32623123412', '0'),
(76, '70', '32623123412', '0'),
(77, '71', '32623123412', '0'),
(78, '72', '32623123412', '0'),
(79, '73', '32623123412', '0'),
(80, '74', '32623123412', '0'),
(81, '75', '32623123412', '0'),
(82, '76', '32623123412', '0'),
(83, '77', '32623123412', '0'),
(84, '78', '32623123412', '0');

-- --------------------------------------------------------

--
-- Table structure for table `document_request_tbl`
--

CREATE TABLE `document_request_tbl` (
  `document_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `document_cost` int(11) NOT NULL,
  `document_type` int(11) NOT NULL,
  `document_copies` int(11) NOT NULL,
  `document_pages` int(11) NOT NULL,
  `document_upload` varchar(255) DEFAULT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `document_request_tbl`
--

INSERT INTO `document_request_tbl` (`document_id`, `request_id`, `document_name`, `document_cost`, `document_type`, `document_copies`, `document_pages`, `document_upload`, `date_created`) VALUES
(1, 316030, 'Certification of Course Description', 50, 4, 1, 1, '', '2022-05-05 16:03:03'),
(2, 316030, 'Certification of Grading System', 50, 8, 1, 1, '', '2022-05-05 16:03:03'),
(3, 316030, 'Certification of No Issued ID', 0, 10, 1, 1, '', '2022-05-05 16:03:03'),
(4, 1016051, 'Certification of Grades (2nd Semester, S.Y. 2022 - 2023 )', 50, 1, 1, 1, '', '2022-05-05 16:10:05'),
(5, 1416202, 'Transcript of Records', 500, 13, 1, 5, '', '2022-05-05 16:14:20'),
(6, 1416202, 'Checklist of Completed Grades', 50, 12, 1, 1, '', '2022-05-05 16:14:20'),
(7, 1416202, 'Certification of Units Earned', 50, 3, 1, 1, '', '2022-05-05 16:14:20'),
(8, 1616523, 'Certification of Course Description', 50, 4, 1, 1, '', '2022-05-05 16:16:52'),
(9, 1616523, 'Checklist of Completed Grades', 50, 12, 1, 1, '', '2022-05-05 16:16:52'),
(10, 1616523, 'Endorsement Letter', 50, 19, 1, 1, '', '2022-05-05 16:16:52'),
(11, 1916404, 'Checklist of Completed Grades', 50, 12, 1, 1, '', '2022-05-05 16:19:40'),
(12, 1916404, 'Certification of Free Tuition', 0, 9, 1, 1, '', '2022-05-05 16:19:40'),
(13, 2316125, 'Certification of Grading System', 50, 8, 1, 1, '', '2022-05-05 16:23:12'),
(14, 2316125, 'Certification of Registration', 50, 11, 1, 1, '', '2022-05-05 16:23:12'),
(15, 2716236, 'Certification of Units Earned', 50, 3, 1, 1, '', '2022-05-05 16:27:23'),
(16, 3116437, 'Certification of Registration', 50, 11, 1, 1, '', '2022-05-05 16:31:43'),
(17, 4616518, 'Certification of Grades (2nd Semester, S.Y. 2022 - 2023 )', 50, 1, 1, 1, '', '2022-05-05 16:46:51'),
(18, 4616518, 'Transcript of Records', 900, 13, 3, 3, '', '2022-05-05 16:46:51'),
(19, 4616518, 'Certification of Registration', 50, 11, 1, 1, '', '2022-05-05 16:46:51'),
(20, 4916019, 'Checklist of Completed Grades', 50, 12, 1, 1, '', '2022-05-05 16:49:01'),
(21, 4916019, 'Certification of Registration', 50, 11, 1, 1, '', '2022-05-05 16:49:01'),
(22, 50165110, 'Certification of Units Earned', 50, 3, 1, 1, '', '2022-05-05 16:50:51'),
(23, 50165110, 'Certification of Grades (2nd Semester, S.Y. 2021 - 2022 )', 50, 1, 1, 1, '', '2022-05-05 16:50:51'),
(24, 50165110, 'Certification of Enrollment (2nd Semester, S.Y. 2021 - 2022 )', 50, 2, 1, 1, '', '2022-05-05 16:50:51'),
(25, 52165411, 'Certification of Grading System', 50, 8, 1, 1, '', '2022-05-05 16:52:54'),
(26, 52165411, 'Checklist of Completed Grades', 50, 12, 1, 1, '', '2022-05-05 16:52:54'),
(27, 52165411, 'Certification of Units Earned', 50, 3, 1, 1, '', '2022-05-05 16:52:54'),
(28, 56163812, 'Certification of Course Description', 50, 4, 1, 1, '', '2022-05-05 16:56:38'),
(29, 59161113, 'Transcript of Records', 500, 13, 1, 5, '', '2022-05-05 16:59:11'),
(30, 59161113, 'Certification of Units Earned', 50, 3, 1, 1, '', '2022-05-05 16:59:11'),
(31, 59161113, 'Checklist of Completed Grades', 50, 12, 1, 1, '', '2022-05-05 16:59:11'),
(32, 11174914, 'Certification of No Issued ID', 0, 10, 1, 1, '', '2022-05-05 17:11:49'),
(33, 11174914, 'Certification of Grading System', 50, 8, 1, 1, '', '2022-05-05 17:11:49'),
(34, 11174914, 'Certification of Grades (2nd Semester, S.Y. 2020 - 2021 )', 50, 1, 1, 1, '', '2022-05-05 17:11:49'),
(35, 14174615, 'Certification of Registration', 50, 11, 1, 1, '', '2022-05-05 17:14:46'),
(36, 14174615, 'Certification of Course Description', 50, 4, 1, 1, '', '2022-05-05 17:14:46'),
(37, 14174615, 'Certification of Grading System', 50, 8, 1, 1, '', '2022-05-05 17:14:46'),
(38, 16172316, 'Certification of No Issued ID', 0, 10, 1, 1, '', '2022-05-05 17:16:23'),
(39, 16172316, 'Certification of Free Tuition', 0, 9, 1, 1, '', '2022-05-05 17:16:23'),
(40, 34171917, 'Certification of Registration', 50, 11, 1, 1, '', '2022-05-05 17:34:19'),
(41, 38172718, 'Certification of Registration', 100, 11, 2, 1, '', '2022-05-05 17:38:27'),
(42, 42174019, 'Certification of Course Description', 50, 4, 1, 1, '', '2022-05-05 17:42:40'),
(43, 2722290, 'Certification of Free Tuition', 0, 9, 1, 1, '', '2022-05-06 22:27:29'),
(44, 2922101, 'Certification of Registration', 50, 11, 1, 1, '', '2022-05-06 22:29:10'),
(45, 2922101, 'Certification of No Issued ID', 0, 10, 1, 1, '', '2022-05-06 22:29:10'),
(46, 3122332, 'Certification of Enrollment (Summer Class, S.Y. 2021 - 2022 )', 100, 2, 2, 1, '', '2022-05-06 22:31:33'),
(47, 3222283, 'Certification of No Issued ID', 0, 10, 1, 1, '', '2022-05-06 22:32:28'),
(48, 3522274, 'Certification of Course Description', 50, 4, 1, 1, '', '2022-05-06 22:35:27'),
(49, 3722005, 'Checklist of Completed Grades', 50, 12, 1, 1, '', '2022-05-06 22:37:00'),
(50, 3722005, 'Endorsement Letter', 50, 19, 1, 1, '', '2022-05-06 22:37:00'),
(51, 3722005, 'Sample \"Other\" document (Other document type request)', 50, 20, 1, 1, '', '2022-05-06 22:37:00'),
(52, 3822576, 'Certification of Registration', 50, 11, 1, 1, '', '2022-05-06 22:38:57'),
(53, 3822576, 'Checklist of Completed Grades', 50, 12, 1, 1, '', '2022-05-06 22:38:57'),
(54, 3822576, 'Certification of Course Description', 50, 4, 1, 1, '', '2022-05-06 22:38:57'),
(55, 4022467, 'Certification of Course Description', 50, 4, 1, 1, '', '2022-05-06 22:40:46'),
(56, 4322438, 'Certification of Grading System', 50, 8, 1, 1, '', '2022-05-06 22:43:43'),
(57, 4322438, 'Checklist of Completed Grades', 50, 12, 1, 1, '', '2022-05-06 22:43:43'),
(58, 4422579, 'Certification of Free Tuition', 0, 9, 1, 1, '', '2022-05-06 22:44:57'),
(59, 4422579, 'Certification of No Issued ID', 0, 10, 1, 1, '', '2022-05-06 22:44:57'),
(60, 4422579, 'Certification of Grading System', 50, 8, 1, 1, '', '2022-05-06 22:44:57'),
(61, 46220710, 'Certification of Registration', 50, 11, 1, 1, '', '2022-05-06 22:46:07'),
(62, 46220710, 'Transcript of Records', 100, 13, 1, 1, '', '2022-05-06 22:46:07'),
(63, 46220710, 'Certification of Grading System', 50, 8, 1, 1, '', '2022-05-06 22:46:07'),
(64, 48221611, 'Certification of Registration', 50, 11, 1, 1, '', '2022-05-06 22:48:16'),
(65, 48221611, 'Certification of Course Description', 50, 4, 1, 1, '', '2022-05-06 22:48:16'),
(66, 49222112, 'Certification of Units Earned', 50, 3, 1, 1, '', '2022-05-06 22:49:21'),
(67, 49222112, 'Certification of Course Description', 50, 4, 1, 1, '', '2022-05-06 22:49:21'),
(68, 49222112, 'Certification of Units Earned', 50, 3, 1, 1, '', '2022-05-06 22:49:21'),
(69, 50222013, 'Endorsement Letter', 50, 19, 1, 1, '', '2022-05-06 22:50:20'),
(70, 50222013, 'Certification of Free Tuition', 0, 9, 1, 1, '', '2022-05-06 22:50:20'),
(71, 50222013, 'Certification of Grading System', 50, 8, 1, 1, '', '2022-05-06 22:50:20'),
(72, 51224914, 'Certification of Grading System', 50, 8, 1, 1, '', '2022-05-06 22:51:49'),
(73, 53220415, 'Certification of Free Tuition', 0, 9, 1, 1, '', '2022-05-06 22:53:04'),
(74, 54222816, 'Certification of Grading System', 50, 8, 1, 1, '', '2022-05-06 22:54:28'),
(75, 55223917, 'Certification of Enrollment (1st Semester, S.Y. 2021 - 2022 )', 50, 2, 1, 1, '', '2022-05-06 22:55:39'),
(76, 55223917, 'Certification of Course Description', 50, 4, 1, 1, '', '2022-05-06 22:55:39'),
(77, 55223917, 'Certification of Units Earned', 50, 3, 1, 1, '', '2022-05-06 22:55:39'),
(78, 56223218, 'Certification of Grading System', 50, 8, 1, 1, '', '2022-05-06 22:56:32'),
(79, 56223218, 'Certification of Registration', 50, 11, 1, 1, '', '2022-05-06 22:56:32'),
(80, 1231419, 'Certification of Enrollment (1st Semester, S.Y. 2020 - 2021 )', 50, 2, 1, 1, '', '2022-05-06 23:01:14'),
(81, 1231419, 'Certification of Grading System', 50, 8, 1, 1, '', '2022-05-06 23:01:14'),
(82, 1231419, 'Certification of Grades (1st Semester, S.Y. 2020 - 2021 )', 50, 1, 1, 1, '', '2022-05-06 23:01:14');

-- --------------------------------------------------------

--
-- Table structure for table `draft_note_tbl`
--

CREATE TABLE `draft_note_tbl` (
  `draft_msg_note_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `feedback_tbl`
--

CREATE TABLE `feedback_tbl` (
  `feedback_id` int(11) NOT NULL,
  `student_type` int(1) NOT NULL,
  `user_friendly` int(1) NOT NULL,
  `suggestion` text DEFAULT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feedback_tbl`
--

INSERT INTO `feedback_tbl` (`feedback_id`, `student_type`, `user_friendly`, `suggestion`, `date_created`) VALUES
(1, 1, 5, NULL, '2022-05-05 16:03:59'),
(2, 1, 5, 'Awesome ang lupet trupii', '2022-05-05 16:12:01'),
(3, 1, 5, 'Sana all tapos na yung capstone project! HAHAHAHA!', '2022-05-05 16:15:01'),
(4, 1, 5, NULL, '2022-05-05 16:18:20'),
(5, 1, 5, 'Ayos yan trupii!', '2022-05-05 16:20:18'),
(6, 1, 5, 'Congrats trupiii!!', '2022-05-05 16:24:18'),
(7, 1, 5, 'Salamat sa everything papi', '2022-05-05 16:29:32'),
(8, 1, 5, 'Nice wan truepaaaa!', '2022-05-05 16:43:16'),
(9, 1, 5, 'Ang galing mo trupapii!', '2022-05-05 16:47:19'),
(10, 1, 5, NULL, '2022-05-05 16:49:17'),
(11, 1, 5, NULL, '2022-05-05 16:51:38'),
(12, 1, 5, NULL, '2022-05-05 16:55:15'),
(13, 1, 5, 'Nice wan biiihh!', '2022-05-05 16:57:37'),
(14, 1, 5, NULL, '2022-05-05 17:04:14'),
(15, 1, 5, NULL, '2022-05-05 17:13:29'),
(16, 1, 5, NULL, '2022-05-05 17:15:18'),
(17, 1, 5, NULL, '2022-05-05 17:32:58'),
(18, 1, 5, NULL, '2022-05-05 17:37:18'),
(19, 1, 2, 'asd', '2022-05-05 17:41:46'),
(20, 1, 2, 'sheeeeeeeeeeeeeeeesh', '2022-05-06 22:27:48'),
(21, 1, 3, NULL, '2022-05-06 22:29:24'),
(22, 1, 2, NULL, '2022-05-06 22:31:48'),
(23, 1, 3, NULL, '2022-05-06 22:35:41'),
(24, 1, 3, NULL, '2022-05-06 22:39:07'),
(25, 1, 4, NULL, '2022-05-06 22:41:00'),
(26, 1, 4, NULL, '2022-05-06 22:43:56'),
(27, 1, 5, NULL, '2022-05-06 22:45:19'),
(28, 1, 3, NULL, '2022-05-06 22:46:22'),
(29, 1, 3, NULL, '2022-05-06 22:48:26'),
(30, 1, 3, NULL, '2022-05-06 22:49:33'),
(31, 1, 3, NULL, '2022-05-06 22:50:32'),
(32, 1, 3, NULL, '2022-05-06 22:52:24'),
(33, 1, 3, NULL, '2022-05-06 22:54:39'),
(34, 1, 4, NULL, '2022-05-06 22:55:49'),
(35, 1, 5, NULL, '2022-05-06 22:56:44'),
(36, 1, 4, NULL, '2022-05-06 23:02:01');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_tbl`
--

CREATE TABLE `maintenance_tbl` (
  `id` int(1) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `maintenance_tbl`
--

INSERT INTO `maintenance_tbl` (`id`, `status`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `requestor_info_tbl`
--

CREATE TABLE `requestor_info_tbl` (
  `info_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `identity_file` varchar(100) DEFAULT NULL,
  `student_no` varchar(100) DEFAULT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) NOT NULL,
  `suffix` varchar(100) DEFAULT NULL,
  `course_name` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL,
  `email` text NOT NULL,
  `contact_no` text NOT NULL,
  `region` text NOT NULL,
  `province` text NOT NULL,
  `city` text NOT NULL,
  `barangay` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `requestor_info_tbl`
--

INSERT INTO `requestor_info_tbl` (`info_id`, `request_id`, `identity_file`, `student_no`, `firstname`, `middlename`, `lastname`, `suffix`, `course_name`, `year`, `email`, `contact_no`, `region`, `province`, `city`, `barangay`) VALUES
(1, 316030, NULL, '18-2079', 'darwin', 'bulgado', 'labiste', '', 'bachelor of science in information technology (bsit)', 'Fourth Year', '5e5ae6bb6a746d05b3bbfeffaef80329e85bdb9f1c6bc38569b747a75958c7980ec6957195ac76f95f068c6f285403e236df3f63cebdc63880e1e46b4333e128LKKaSOvzuyGwPqF/Du2Jp8tUlD5mvdxSe2v0D207ADnNE2+kQnlc+c4/+AcSf5Yo', '14688e076491e9ec6bb0655847a6b55df55f07550ef2a7f54a17d51a6d397cc1f0602397ba980141e0e0e7bfd27002342c9d1b6272085ddacdecfbcb63423ca3fR84KSKse/qEdDUYwFNFxwotAIZdZGMdk7XXyoKDJYs=', '90fab15297bc266324c0f2b26ccda00f7599aafbeea527d6c67ecc1bf81ad7337dbdaf140885cec91ad2f7ab5397865ae459b2210ff859ed77a3cce13fd48124sDfGmwR667tAHTwK5uxaM/s0wzjEed4VVjqvY0/kLG/jjqbsxhINTZEZOsIR36FF', '6cca4cbdbd57cd6e50e7b9216c5ffe7cf1135c88c3fde0cc065958f94b505c7aeedcdb0923a350055f133ef8ba434def05c0bc7adf4fc4f6154a8a8552cfdd30RJ7uL7Se/ToU0h7WHcCLt7gGtp+X5GsVK8GT/5Hrc5o=', '8c84ac6dd4a56c094e682fccfba461d830287b52097566ea4e0ab760374ac9b72b8bf2029827ae48c5f088ea9f79f8ef784146d0b6f021761a7026ac3a35f7eaOaDopM3Wx1QLLLjSbX3Yy82qljj4Ju849N6/NgAYduI=', 'dc2abff029168dcfdb55ab68610cde1964232a2e3ac21f460d1433cf978d033228aaf525ab236ba441dd37eb10092925eccbe12588dde3830c72bae508d8fa7d5gVf8XFQFw5pFBF9o6FnGk0lvD8aCR22cEFittkfjpQ='),
(2, 1016051, NULL, '18-2079', 'phoebe joy', 'laugo', 'peneyra', '', 'bachelor of science in information technology (bsit)', 'Fourth Year', 'f4f543ece7b41d54c42c3836de145a7a329c0cbf0fb4f57abd406f28e6eea6a8e631ea5276022d9715f19ca19397b503963df4af31bfd39da51f48699cf0850fvbRaBqqrRWbk+qT9DsgUYG+n0Hud6pRUHQHq57zZRjGqHg2MUpv+FFeDSnBIgeAp', '1c40c4f61059a57e50e8b00135e0db706ceba6a9c928872762ac2812d11ddfea140b8f897f741a40fb2e6c9e7b73aa4cce54db08d60dc3dc8d603d76ae102ad3bTUNj2U5de9kyQGngHzaLOBlK8XmJZCUlBIODK9GbQ8=', '9844146a9c4545af993d7323699b158c97232a4db8e4bb4087a487021dc17fa1cf11bb5a143b2f1ddccfbe66e8498f4bce6fa2dfd74320e3a2bead5d44203bc5Eg17U7xsg+6TW+ogR9LUn5zeuG+wdzuhqGVncTLI27FYsANnrV7jqCls6/dvsGpe', '8bb345af07ba5dd5229d174f6c9766a3fca72d0f9c97130a5587720b19a0215b8e29ef2549517cb90c0000d60050780893a2c7c4f485e7abf0d006c4581c5d05IDq/L/o2Dcnt3VAw37Ilf2tdqgthHzRbPV99INFu5ss=', '890679fb561e2f41d4c96ce27b988102234888da3c17148c75ad71b74da86e512cde6261e809ba201ab58b9019097a78b4f988a5fe179c4885e0d8379bfa1a762DPSA6UovmiEvSol4FOi6oKLW2tI3aZ7LZ5NDe16TMU=', '9dbd150e0213def6853d107e5f823becf564bf293697ce9d37aa9c723da70492413cf950ec3905e123cddf4615282566a797bd9c7db949a0de55b33aba13f8c0A3m6X3EEijEDEwpUfQtyR0mflfE++nqf8JrENLfZKqY='),
(3, 1416202, NULL, '18-2079', 'christine dee', 'villanueva', 'sarmiento', '', 'bachelor of science in information technology (bsit)', 'Fourth Year', '19cc53fbf1e3bc2da19c1760db9c66479c50ecf51dd6686cdca3295c126372d0ac396b30e5dd09579f25b231d83a7d7aea844305a747afc01bd0f466749aec10thGwby553nHVf5DoKoGqIolYEXj/P3Tsn2wbLLAWwdfRfRvJ1y/FGPV58tWuCSVc', '2f6efe7a9b7f2065c55b1c9a254a34087d6c5a0a87427dc19d65484e63e3ef0003c0fe871677210ddfa7bcbbb1ed2cb6dd8f15fe27419f22049efbfdea5661d3D7aPMduMNMYnOiBQoAXWNmvttjIKLcbEUcmtKm6RdZA=', '37af4ec1140ae0430ab3b47164e1689fbbf928a20465b20ddd42eddf5e4a2d532465e87b4338fb591a195bce21573fb192fe57753b9795477543d7b1ce088b15NZopHEKC5gtiMAqkgrVqQAyx35eWo96LWJZd7Dx66wlfwst757vvQL17WBu3KV1A', '63b7ee7e906116c58922fcc2691e08f822aef007cb3b2f1e0139187d4d44921e5448c4bdf415be379860a94e3c44e2c4eef504a00fce957d47d9d9e4616728d80TJpWk1c4yTe4y83f6DNdE6Z4NaFr2wIklMaSkp00vo=', '5527cbb78a24eca2f9547f8d9fbdbd5e2aff57d0cd582dfb60863bd764cde1da67113274bf6d153ca10b3a8bda97bf7b91e65b33cfab55d487c6dd8cdb1ed0b7wwiujcTLj0YY6wXFA1Eqb6HVAYPTZR9oBuLj4Ri5C+OgVnigPwtC4KFugCfUh5cV', '0525d2b958935d72ee0cbfb0251b44bbf469f66031824edc602c922109f597dd4569d5812329a007e1516857ba78f333473d96c4075cdb94a2bc7f8e8eb9828bOv8uIS2KeavyCcXqdjJTjteC2hy8myiRMsfRzscZpUQ='),
(4, 1616523, NULL, '18-2079', 'eduardo', 'mallari', 'reyes', 'ii', 'bachelor of science in information technology (bsit)', 'Fourth Year', 'ff46c62e87257064a56456199f756bf5c7dfe02bdf861c67d6584d751cd9b5dafafd73f11aeb1cf0789ae50ed0110e1624f7650a5b4b5fdcb60324766d16e328RKHgKzu+EtVMNyjuhEXo72r6ETEZZfRSEQG9ufbye29NqI0gKo/lPy/bWusPjKL/', '300db3fd100fc148df91d695ac994cab6795ff9ab2bc4d6af4931f7a697b563955e367b5aa5839025575492a082b0a821a08fb29106937f5fa740433fc9e15410NQaYM12lOAzbpaHskyx/7krom5sBNPxCjjm7hAnQo8=', '73f6873735df7fefa671c6bd6e744fb68d9d5d17b17373a39174889714144f23729d18985db8ea00fdd9c8d05d33084d47c669605a8f992ce96d1f71391d3b7cXBJpBqHQBynly0n41zYmSX2su+tffzNIrcTngPQ2rr2s+HNdNhNLynEH/1h+yoGW', '1732d38f3608abf8636751afa39d4deba5ed3517febc42ab67a82fcc170c99db7f273e5699f1ad31f188d34d6e14426b23502a1b372a6618a6c52e5448f1df03NciwmLO/jA8KhKjPdWUtmj56L691H3N7BNxug65X2ug=', 'f6531d12148b7c2aa3782b91e25dbb07ccedddb589eb1caf90965f9e4ddb8169d1f7446d4c7e811b6120397c63de2548142e86111ce02b96abbbf70a2a917f845xobiY5RM3yTZnwUI+k1GJ/w+6uLQpY//1s1Ejwfg2s=', '4ccb15e9b23035b7bd1bbec48d4c56a91dc5cdbb599d605b60e90c405e8fb9265a4645a67d67200a1fa6f27073f8beede209656adfe2b266dd1e64c9d0618311pkvjhz+Fa2jXVdWtKfjkR9U90bR1XMxyLKpXTOUXr2g='),
(5, 1916404, NULL, '18-2079', 'carty king', 'correa', 'paglinawan', '', 'bachelor of science in information technology (bsit)', 'Fourth Year', 'b098da952ae198c84ee042b2f7fdd0bddcafee6f9ff91816ba6a16bbaf8e32400411939a6765e1740e7e5c302cdbd819b1b6ad45f4c4e559082743be35855cc7QeN77p21HmdnvKQ6OjWW922BO17kvRzRFxcViJ6P8UK3cL/ysiyCJaczGkCLoMi6', 'e5342901c308032b4f638d1f647cb67de85fd2e3712c96988c2647c36f160532f6c6b0add3a6c5296ad8d8f10575593153bc9efafc8d94604d3256bcc8fb58b76Y0tWJ1dSNyJyxrJuL+vLYRMiqqQflsKvXviIBX7fWw=', 'df44d2d3c5c9e5e0741180530c6e18e29105d0a58489355f50e0982f600e0d2d95eab98fc5adc8191bacc38e5dd4f7322e28357173a1dcf8ca9d268830438c88L9V1n6iiPjW8qGKVzQ/21c+C6PlnVSgFI+RifZ+qTG9cUB5eXIhDPfSbRLf5pTRo', 'c9560765f0be31e4d2c0bdc389becdc961d91c52bde11f16f4040bea1d92668e65d0e7f4b1b25eef4d62d48f4169f3ae85128c55eeca0a15c11e7d6e46e97049fHqbCL7KYn9GdSm1wsu1a3lwWOrCqZ9B1ElTHJFkQpU=', '83bdd10d5ae036f001915d190f3c032a42fb6eba2111e15eb5644c377c1c62638f38bbc397ef7eca630c6b222e09ba58ae8c89f56e9ab9941df11f790056bb8abD+XRcr4H2l8uZus0HL1fGeokuR5J6EJUQXyMmLVHGc=', 'b245f4798a8da471cf8c639fd15cadaf1614849b0a7562d040ce80ea7231bc8faa03acd64f89675acd722ca4bd92d12a89fed68f5af3058b11ae56b722ec8a88S0Xl9f9GAOdf2ionQrLKKX37WJQMl000EwEp3IvWKJg='),
(6, 2316125, NULL, '18-2079', 'john jesreel', 'balangue', 'libed', '', 'bachelor of science in information technology (bsit)', 'Fourth Year', '6ac40294a63716c09a5bfd641dd7cf4f681c52d5c039235cf3089a8eafca9a492ca38d20cd921feb058c9a99792c548192abcaf46d0ff95ddc17fdb307b047a6MWe4ggirxhPHyAfRc2tRgzKgDAtBW2neXbmrSYi0HqlwiWQDkgYxejJwj9RKeWFK', '7d51e46ecd62c4f449ed95472da6124ed9d1b7d7bc257fb0a73508c69c95497bf6d04c4c29750abce3b7cf618cc0dd6809b66095c123b4e894a6c9ed7814d0a7BbtkpKb0/j+Pww09/xxc6JhGXzrgKqyCqi3raDN7v7o=', 'cb771fa58c150d901d5167d04229bdc9e5226b6175adbcb7f8abb3d6734988e78af31338dbbae865a8343cfe9325ddc50a005ad419b785487a5537fb22cdc6f1hfMWB++qKWKoj9B2tdgUMe9TzoMVozaHFPglGaj1YJHw1g11VHbZdsZysoXYaBKP', '11b2df5932851a683316ae475f59f48528efd8ae75a28738486f4e203fffea5c613403a0c266a69d6a969438c3bc6ca27e55f2c844d2f4aa727e32db5d16cc56exXe1WBeODZaPIQ2RTIL/9dY7FryPLwPffaxxHCJ8R8=', '1d2bfbf5c58e4256486fa208e034e0dd6b80ddae04d6299df24fc585abeeb29cabc3225fb7753e174d58cebc331dd8f342f956c654092335a75fbb8bff2f9e8eACta7xkh+NCr4XAQve1wUfiZDVlk26SzVAmSYqFWxuI=', '884cae992dd7a96808384ff8e4e00355adbbb0c6c7959578c3927f38b640fd3b3244656a559dafa84d479cdce050dadd2c37907df56852c75e4c0fcf4d1f9132FFsHaTDQ3cpjHVBLaUqyP66jVHQ1uqWyGoCHJDl24r0='),
(7, 2716236, NULL, '18-2079', 'robert', 'dela cruz', 'cruz', 'jr', 'bachelor of science in information technology (bsit)', 'Fourth Year', '69fe37dc92d5c3bfb15964be1ddaa12faa87159744b61a24367334866243af9ca9fb05d1dac3d387c9a92e8382bcdea8138753aaf4fb388ea70f0b5ab34d204fjroHkry11aBZVd55EnOcbuhosww7SArijt8Fdi9iK13ZlbuEWKugiuR6ahFcZS/W', '759314bca55ecb5aedbb4a196f5570fa65fbe9c972dabc8d1ab48fc36aae77b0a33913273106c1ec0f9800c188c9c712ab18a33466a87c27a62030b19b73ba842trAg6HrvURKogfX35W4YXNXEcQkg4KUsGHuf4MPMo8=', '5608e1145e9646d8f058017599fc1b0ec0bb0c29b5a9e1d2b378db84ebb418a5dfb3c424055e7aaca34d110a83a8648031a0be640e677f37a5f95940a109bc147spcFlB0XlahRCbbYaS9P5GMq8GkfV1GAvAzhPZmz8zdC2l+JvdEpdR9NRKQ/saq', '083ce4443aeb5375dc3b1d8d16323005c77ae0521820916468c20dbceb766e5ed3f39d94ed3fce73d8b352fbe7b1b62f6f6c7c57d28696b9a971125012e35fe0mvqNtLNJ3Cq0RwK6j4viv5Vz/JIVoXBEPfQOwflptHQ=', '7e23b8f30b3f54d9efb8a1ecb1eacb336889ee692cba370bdcf019bfbe5a2259300577bd9e7b32b976ff63fd97395b34622caeacc2e440af07e36b64bbf898a1Z9kgSRmFt8QS/ki2d/GNJcozEqoL1tG1LYJmgcIAEWcK2KKbe1/m5s8tQ8MDVZDG', 'dd49877631a60a17da49a1922b5fb71799578ab5b040ed5e425b6c0865dfe8ac621f1a3a052510d5d34e0abc452aaa174390579e943d7867dfd706dcd56379350QJjdD0fMEm9EGL9DXTrVubbDIMuX8mJjKyVSLioScU='),
(8, 3116437, NULL, '18-2079', 'harris', 'almuete', 'de leon', '', 'bachelor of science in information technology (bsit)', 'Fourth Year', '7f8df28312083f4ab0bb758d2dedbf47cda9ebc3cbe86ac6ed394cd19ce630b2f598d3fae31fdd079b2d28c4d232f9b47bc49e1237e3a6a9d0d396abba1f8c90gEU0rBd7HB8C1JmqnQE3Yn6hywPpwzNkSdB/r/8XsphQtX1ZLAr848dI9y3V2Cy4', '3deeaf98246d902c5b89027c478b6eba1eff1000ac6c052924124e3b0c73bddab8c099048d75ad9d1c25a2989ca7bd8ade26577dfd7a70ab0be44c2039f60a49qo8VMbMb8Y+grciwxvdm7KBLAFGIiVWcwmb0sHVEVLU=', 'f8f187d6c52bd80a47e3b138a3043a054282d8c4b85db03412ed7f3c7cf6434634cbbbef2ee79859ae0a5aacb83eedd812ce4c277e430e88a6cb037d2db3e7cbYHt/1tKPTC5sRyB1UBVlCIvnxkkwPvxwy8m1s/87g8112tKuHYU+VZdD5qNidUWE', '400f458e146cf83290eb4eb8287f70393fb7c717d301aa433daae873e26d101ee97fc49edba9e8880bd7f4a7828726d9bd5a7a90bdeb3a531cb3836dfe1cfe72V+IhKrIym2Blo4yWxyCt/QxzlCh0fs/0mJ6m+2y2NkU=', '176ff438fe3cb1c64512a62b93388713fd8c9da4dee1f2f49d71525d3b6a4cf47a275c033a2befbeca4020e5ea742cfcf3f4f3173f911fd0ba1bbc1c9f89da9buJvCoTc74SV+knghtab1n940B8chlxV11R7vs1uAZ5E=', 'f50c1d8a4ce7b6f0b5b30eed3a3493be6b4c3ed7a8190c79861d0c44da36e173c9a22b42fd9d349171a6e8333d253db4c6742c06cf4101d43952348f960a1ab453LG52+O20paGYPJFsVTopBwWPFXfUKHZ9q4KdPkqqEh3YTJ+6GNbfIb53YtQjY9QplieVVS6f4UJKmJGISABw=='),
(9, 4616518, NULL, '18-2079', 'benedick', 'alisto', 'del rosario', '', 'bachelor of science in information technology (bsit)', 'Fourth Year', 'c5586b7f38bb8bde48643265dd649700ee0505e11927bdc9d21eb655f3eadd329d84451ddc9b3a37fa78cc137aba2f442a7fe944fd0dccd9924cd87a5a101681q1fzaIlG1RQAvu40Mkz7dKGt9PvXt3YNDs8Qh/ce4B/Fzb1jklB877Mct/eMko1Y', '178c86c4a8ec5f5cd984c7d0c6d14ea15ed97d762cea6d9ef9b59c09f690cd8d6477546dace725f9fb603f2ce8f5cc650263fca5d9d5bde6bc23b6e56b70b97cXv3R1ISHx4qsOpfQHu/PkcSl0yNtWpFV0amNUo2sV2I=', 'd2f92ac00f40d84a3e1fd4c5ae416545b97118629081ad5d797e8ec0459b5729b4bb4602e161ca6e1feea42089f9a70ce9aef3ccb7e4d0519ed1e2f0c6054a33ME4LWUbKPbMghTWU+juvjX04Qpx9kmJW0nhkAu5gK/qAnKgMrWBJXn9ZZPM3pM6l', '4ee9b2090cc95ef9fd9b020bededa239915557c515abd658b800f877f91bac1ca609bcddd423f689477098b6e318a6e98771857f4c70b5dea4f5d5ca58734335guKJ5jEjW4Y3GZSAcIfL48NQvT/ARr8bUFhb98PZpAc=', '19708911db451a162ce859112b478034e015dfbde4312873d261de3cc74df539ee617eece57e89acc022ab29ed6e9e62517b5c3dfbf11082311e7a06b252a687OzNtdQpZbDCndEpiNRPRKiT3ac/hCYlFS0BbHcznk14=', '31f814e8dfec33955eb9dca0f07753e190314e26471d6afcb4b37c176bf558d7ace0336911e1a4d8afdde9c3be6414e05a72f0642859d1d787e9bc88d7b530c1yg5RkRuec6GdoH5bVQmnq+x0SLa0qqXg4/wR7Q4G+lw='),
(10, 4916019, NULL, '18-2079', 'ralph alex', 'alsisto', 'encabo', '', 'bachelor of science in information technology (bsit)', 'Fourth Year', 'a9d9ed93f651094e572318f1071189de3220df9c80562d8bdcaba31349540d22afac92f9bb48d9af1149c981e4f00876b423ffe5f4b5278de20a23e7b8b88871OgqAjSiOLuXEYBxQsZJwOChG6iLc33NRQxEOsa8GsUu7fxXE1+4CBbQ3eD8ma+7w', 'ee34056ee7f7784525efe341bcc2c3e0ee1e4abc1f4a9e876f66028682d3c12901f40c36265a221ed4be5783704f6c145a2c3c51ec5b34fe353cee09f734419f0kiQNHfIONzOGKCOhP1Tn7Qds+VoWg4wUkVM69FUkkM=', '173bdda5eccbf7a177e09207527d450d81e183c5993ed8d27a3657a342add6fc1ce76945e76f51667fc26f0e729a7e10d846bd3fa81014f79bca9a9a4818f581NTf5GnVWdabw4MuKWJm6QVx0MLVSEauHyoGBBxlDVpD27Wy39a5pIrHspW6WIVJ0', 'd14a27b59bcb037b2a1f3b9fe47466c264d424ec0e31da8a5bfffd6b0e4f59901840c8142bc6a3e7e9dc23814c3fd578f943cd5aae88631668aff689f24ebe803q3w/hkEpDbpSRHAWlXv5hj1mxgcbbjzM5Wkm+BE9ik=', '2e3852d0a1bcaccd197f7b90e1561f690e41c7426574dcf275a5bbea14c903c29d4389670e8923ab9dd8229933c157d4d3af83466a68a4fb2c53ef07377562e1bOhRKOaguG8rDtTWE+Uv06eGAeVtYXQa4wrZuWtVjEI=', '1fd7cf5794afad674246aa5a4e378647cf54e1345620ae8419133883293944d94aecc6f275dd61fa82cf1354de9c27f0c964c4f72f19f0200dc5f3a33f7b0e1eaX4XD0bK3QWTU4lWDDXzV7+iAMM5GZEA/UUD3omAt0A='),
(11, 50165110, NULL, '18-2079', 'princess valerie', 'arquero', 'ramos', '', 'bachelor of science in information technology (bsit)', 'Fourth Year', 'fcb0f25cc1e7867274a73f313845a2b410d68b6c8733f49966dbeed861fe779c582da120c30ed6290e4da834ffb0b7bff83123aa4171b68b44b91dff0f8272f4hiWn2RlyfrIXdXXvtRLXURMu4XeHGYX3baUVXJd2pzB9NDsD+1RQphypNF0hXQsT', 'a618cf913834b682b430e8469d8f393ac2c04f49a7b7686ff52ab9ebf50d2731c7dd959e76a79d6a1f692e1d10d64a008f30f9303ef14434d591e20c19ebb1e4L2B5gTyMwlnHHHUsuEndCBrC/nB6zGuK4YOHIzmv+Ek=', 'a5b9eb4716a09168a8b250e81c71d5cacac8f393cbbb09d01b4f0862a5b6a2007f6278e7004389a2fa3e2fea393c9daf3b7925d1068ed8aa6114f932619e805ctiGrCUNwRoJO/RSURNqFAdM+lL3yBmZvsY2Le5wMYkDZOma5B5lQSERJQ9zVvMzp', '18c8be82e4976902b708bef850e2a19001b818720e3e66738be46b4bcfdfc9fde602b62b62cc1968e3056e99c1753286b401bd7862bbd29ff42f8e0c947ab9debCHaTp21s3P4xqrQoeFM9zIY2npD3OAtJX9w0Te7YpU=', '15182092f69b6302ef5e7b957128ebe1d8fd322675bc99dac28d3e2f5a0e81886c979c1a2c8fcd5a139d441703954ed07a09bcf38c2848ef5a9b35aa4d55881eydaIp077CGj0Z4MYyA+bye71p4VvDBGVV/xXca66tzI=', 'b398e3847246d8a0eca9a0f70b57d073e4dcac4eb6af084798f2da56d96d0264e322dd04c42fbbef533cf55c69d513f229e446e96db49fc7e4e0f964f2216171qKBIe5vRGivtjSlF3V3MA5R8G63UPhC79fVAF/fdvpOkCAehIjg9NF5LKtoFkmjG'),
(12, 52165411, NULL, '18-2079', 'angel ann', 'tabale', 'ramos', '', 'bachelor of science in information technology (bsit)', 'Fourth Year', '806493e2c38667b016b6700791b43dcfa64ab7d8fe0818c5ae274db7e1aded1aeb3f208314976a85c0f118bcbaf02e5ff510d05ab70e6132c13d622f2f120a41AGhiWF4AM0uilSGEAw2r+4SbGpmzZ6beboHYfPzYBOg0U5okWZEakHCNMVVYFnQG', '4689976bb1e797cf1f4198c140ed3914e1a444499fe65b7597625a4361ebe5d43e643785b3ca280d00c919a68c9bb2026f0f49d0d1cafab29f7e63613780a298eAe8Abov+OVvySUmXxNE3O533y+txzWNIyKk4lRIMlU=', '70c7bfc7e3aa88f1cf9e372db061f7d4c7d9f9b9a8a5d570f2a85a234b349693a4051d6f5b0e54256722b5118262e5c1671ef60db2c7eed219b5c4bec13b6f94hvRKyGICkrscvl+Q7QVpfi8xTolO1kz0gURwQr0nkIX963eCEB7USWPXYI7FHK3z', '18e117ebfe199ae6e10dd19ed555ed45dcd5e109451da11b400ef6abf59d8028dfd52ea4b615f0de38f447233cbc6d6a1dea64e85878efa3c843eb4175633f2fmRvykbV3u+G2PxjQnlPjJRZcf9b4G7PpdzpXzXfyUjM=', '70fe0fd6c5638895bb3702ffc9ba3d4af4a6e4821f709c303a821b5bfc9e9488bf6103dc1a0d275cb4ac8b344e5ccda3c1cf93bda1fc6c24cc4f2d3bd13868a8LlGGvd5wwKkS0tiFAKyE1fcOfMykx53b33CsABdu9JksGJR5pVxQUsxbM98NFdJw', '10a9aff6e23a1e6250532a000662474b7e11635b797b28c42c174051da5d6d9927b895670417b80cde9f87438f31331879dc80c962723b0db362c2263762a2b8ARcsmkzhtRgSwghvjFnWUY6PM4LJ/rOvZ7pt4EvKIrQ='),
(13, 56163812, NULL, '18-2079', 'khrystine dee', 'gaveria', 'bravo', '', 'bachelor of science in information technology (bsit)', 'Fourth Year', '0c3faaa7606783935529031a313aac5d3a2a1e320800879918079e87d915e17fc96f70e0fd7f9847ecd3de2a8e4d8246c4f863b0bbe49ffcd76e59ae973cab69IjIESi+QaGqjccYTOjp225wSv2SnOKR8UDkreGhzusvbvMCAsVcULq+w+iLk5Dx3', '39313dc44d177e627e06667445a449c1e5040e7586041d4206534f74bcf9051502310ec9d58bb2e767f6d33c325e4f43f3dd05d62695f1eefc762d1190a06163hl8bUxXnCVoSe88wBEg5Gq6f19en67CTB9OytGNABRs=', '5f2fe4926deec9955a1454870493e9fcfa2495dfe87b462d9fde0553cfc414e2d952d77f2a80f71a044ba60a613c8d9c71f3d63ad5fc52be075e3fcde7c81c57Sov14zGmtPEQGGZkUfnTOFI73BoikDjNLFPVkwqm3prTtTpztqstK8RBempy5I/n', '9390935e51eeae2555f3eacaa9ee1f53a7082df4a3cc468500d833cb2f43b736df50b47867d2edaa4c0c19b5d2a404e98554107030ecd8f89c9607dcb3b235cffzuw7WfQLKzGlWdyeC3AyJeKrKl8/UX8TZwuDjGdSW0=', '87dca0d34df9d3d445ccbfa40d87f44c8b2fc3741ff87cf2e26cbbf855300388b62d8ea33ee9513b473adfc5968b3bbea4d88e874e0b4958ad2c031bce7982baayf1pRWrUYc38neChqYj7PznW+fxk7IdoYIBR2U/awLVAaiPXTIIGm0l5U+PorNc', '0e828ada7a382c50421cc040ef1d681ee2cb0ecd106edaa3333f1c9a0cd730ab7aab7ff1d9a73e2f05226f125d1a55bba711571938ee7128464533c5df033651navOFHtVYHKvcdho/WfaR2eTDgRM6JbSd/58Mvz0jMI='),
(14, 59161113, NULL, '18-2079', 'glenson', 'sumigcay', 'banate', '', 'bachelor of science in information technology (bsit)', 'Fourth Year', 'feccc8fb74956da42da466a0e3e2388212697a4d547cd4e57b545b3196f1bab2a332e992164540f8ac73b0e0818e6c8ffdd19ad53a88d2f8af70ab2b6cd7dccfJx+72T+8vhZplh8XN3IRbWMHHHsiWp8JxooRAxGXIGM4dtVVKS5s8QnzRDesaGX+', '3829c85b3caf1203f5aa21971418e4804d4eab1d7f97df263aedd1938ce1e3a40c64264da875d41a47d2fa23f2ae1dda47da6277b3a1a35e60d751dae142c5e3Ti3bFZZSuFMfsB4CG/Z3B/dGZetxn2eM19qV24SL/Pg=', 'e05b25ddede92d8752ea13a4f46ccfdf2768369fce63ac12d1575025cb9b5a8096e832d389079ea05cec1b3dbb7f227a2cf76c453ed12e3042b093bf02e44dc0N/lOThP2gmMZVYfCKWjNU3cqA8puTgGCWcv+KqSbQf29crzZ5le8z8YZMpxjC955', 'c1d3c6b7b7b6ab456f703f539691948fa54c4d1cd60283f67ff17c03536436e1c93e5534f00ce1e541e8e132e0bf8d3018896ff1c629ee8d7018248b19fba02c4ZTD5N3dLQH8c19sVegQcupbyhe53w64qPKmc7tb+3o=', 'f5a5edd5613d069396a7707a6ea466316566eb0dfb06c0480056d7b91946894f984fa66bf3697a0e3734dc6293865c99bce3c7fd3da9319b181dee148839bc7bYTnHkIzrnjUF9CxvlIkMGpsx73QH2KDF2M37poXfIWw=', '026c543de4c9a9c46afb2c546404a19c3f40d96375e1f75be5365cebc81dfacbb422a1514f87941cae47fb9c6972a8df8969555d1d0a5b6ab5cb7eca8251c802NxHIgFKWDgndY4OEKjEp8ivGHrMTkFOCPDTwGEA85Lc='),
(15, 11174914, NULL, '18-2079', 'john nixon', 'jose', 'peralta', '', 'bachelor of science in information technology (bsit)', 'Fourth Year', '602c7256b335a3ec4ae7ab86ddae8ad0b96bd9fdadd3510cce52019c0271906c6ec1cef4418a64ebf3c0f618c562257378d4a60bd391aec0c98253b8181a81fbUIgd2Dzz82/6yxNwh+J6IpvsHxQjQ5dxsYjTI1EuudTtIOT6LAld+BbaEjqf0aui', 'd7062395120e3b02776fcf96591b71df9ae816ba5550e53c3a10d6994942fdfb5ac765335736d239b2c67f4435a7154d451c05ad58036237d6a55ab68eb9d7d1PkS/WJv2lZ4IcO8YF1zq3QKjgSmnfkAabSyFi82qICk=', '6a20e52dd9d2db79d102cb64dcb2fd749fe1790a12645ba07d309e2d9069b42932e5b758b902bc45366f2a7736069191d8a7f5e3e635a5fcf14a70d500652c731gQeGsclT6aifnFduAR++QkBVJcTio3Bmi5SIVB+vAd4jxCgLmy7DCAW9tfUJArN', 'b77dfadc948562908d11639d5564c32aa1603bdb17fc7465fe9ed32a22fb11bc203ff7c395c2b1a2ce53caebb6d7cf36649685ebb4308931879d7e3c9098ede1Ijd5NWBmIAnrienLnRqRr3EeAHn+BblsaiW1ZELC/RY=', 'f69796129805801aee068bab64d84875bc7c85efbfc72505f09da3f1be0375be490dc8b0c05f14a4ec0f3daeaf27100f653dd4eff12058bba57500b3e93a30eacW6iUHumNkS7kxNLyjU9wui8Wxw2dFFtE1+nW/0GHJc=', '9b4ad255de578d45a58070dda61e09f5402dc10b46c74e8679f096d4c03ba92a8350e5f4ce4990a987d80d1687aab29bc3e9769e4a0869486fc8d2e307cd3cb2XwUWxLXV3MBWuakVNV9T7i2QGNx73USIGj/zofVxqgk='),
(16, 14174615, NULL, '18-2079', 'ryan', 'layno', 'bermoza', '', 'bachelor of science in information technology (bsit)', 'Fourth Year', 'dae6c0bc742314b33de660325b59158c197051fc80244773cd95857607d7e176ec6a5d112be68b640ea876e1765c8122640d0bc21d052c92434d9d3172f05916yUK05uMPU8nKJBSSmF67XCyjisVdXIJXdTAzUkhJ9yLRq/LqhH7EKefQ12hN59n1', '905b456c3c47d44939f0fbd9b546d863efef0a457ef190a49b064bbb59614068dab8e8b4bc76afb57097683f44824228cadf3db440fd35fd8394ba5f6dcbd84298NSXDyW1x9rSfHUlLzUTB+FWj0foSkkVRLzIgwxLVc=', '7c1318f83d537e9ff1679d00dc4867f6124d455948f044a5d4c84e6e163c5c31a997dda8544ffb1bc45bc4afa85a64062a6c5de9dfd41ac315d152ed690ce2349VdZ7iK7eHEEyuSxVnFX3iPT8EDTd0eW3j4qcsd+cHBw2zblpHhvD8jwj7XbJuFA', '9aae57f9bc5999f613e189b1718b8b17a3b756fe90246226d5f475153350bce926832b9e2ae29c5fb20dcf456ee557c852e835b78bc5a16aace43a760abe038411mu1GEL1HYwsZNM5QCu/sEybM8VCuZTy+auYsPwpFQ=', '698f50e29b1fa2d77773cb7f02f2e0e6cd0ba8198051b45009bed6d91d4855ba2790cd93ecc3e2c7b2db3d86ffcc18e2f57d45487fa1362f317f4576bbbada54EPnNiJCxCXw7UUEga6LCOTLk01/rj6PLAY9dQlszNPw=', '17cfe0455ceefd6b0753f30737eb6107d9a0a7fc5819eeffa8c07c9f9390cf1d5e7705f08f40535aa59e7c8ba5cf94569df09256b7ada4b6bace28bbe703860bWL1l5YJVqRTax1CnwlNB/w9jylYmINvVsvC6onBXqZY='),
(17, 16172316, NULL, '18-2079', 'eliane joie', 'avellanoza', 'pantaleon', '', 'bachelor of science in information technology (bsit)', 'Fourth Year', '956beb3d8e9689a709af2d9555deac2c52e6978506323e2e890c36a25d0c148c06e82af9ab7b6947046bc3e294018f57517426b5c4f005d99a2b9ce57c88ba58Af38af11DVmVpKY3T24j7qsxtQHR+2S7CpHEnesbRqvCF4aMxBCKkZDCraMfPLGS', 'b125ae5fd9d37abd41c48737e96d602217825df1a7154fff37633053ca8013f7d4f97321ca5a8770a3a2f11a7b8833b73078b4ecb382e344429992776712f737CChkaG7HYsk6Ik9fzGfwJsMdEMkprVtjC7b4t/K0yaQ=', '6a8fc8c65dce2351f6a20fbabcb703ab83022edd50fdfd371dcb4e9f81658b48c4c494d05c85b350de7edb131fe7fa619fd1bb3ae4f1dcbe22b2f517e27cb7004cSoZEc/QBxWF6oMEqMnkx7Xcsw++mtqXUYUwsc9bTdr7CpKS0/04tVnDciPwupj', 'efbb86df388d89b1e30aa18a87a21b050a1ad4afba484d135ba4d3a665e5952bdc9554df10520943e96627faa47cd0388de24f8b01df81d8f8f8c499d5a71eb8mH/yquUWejfUjCcmUBh667rrd91zW32Mbe86T+5DKrQ=', '2bde18ef0cfdf7acd8e470fa59560a7161cf9dc3761a4885ac75470f3437473abc587acfa8f370af434c248850f07f655ed26cf44b65b48f70381239139a6322jdkgQlpCw2BM+tZCXW+EwoIFz1cp6f5w1vZjtzXeOoI=', 'a441e252abe1fcba0e05dad32d6698d33cab7b3f830c70ea8e640904a543a588d8156bd0ab37343753ab7b6f38150577ef16b9d1c8cc328d69b5ebc4eedc7f5dj/Sa7JJWbhawe2ueeNqlH0ZZbQO4k5zvwZ+iXgqP94E='),
(18, 34171917, NULL, '18-2079', 'jade goldwin', 'collado', 'padua', '', 'bachelor of science in information technology (bsit)', 'Fourth Year', 'cda1259cc12ca57ccfea3db5c4bb33f79c72bcbbb8826fcff2820e2033788796f6b9d7059ed57e7d288bf489946783b50d33f22f7e4813497a7e01dc19fdb41et1RWGFk8t71CCr7GqKPRKUnyKeH31hkF8rpGThmLJBWD/DIB9Tlab62aZkyDdaOv', '6d0b9b7575400ffa0898b640f82c8359595724cd4e9b8ca399c98ff4e4284c6ef1587b0df088919fe3c935e6c34d8fc6a120d18cf3ac4520d99a6dba2e9d825fjuzFpzZulbTJNy2h0Up1hDCjMYeL4AS1baYxcZ9L+jg=', 'c3048679c885f1518f50d23fa9881ed92e7b491ed82c089c4344357c804a146a943d63ba88c137ddb06a380f6dca6e7a931491071819538a39b7daaef713a0eedUrjNwuDr9ibFfjg+Qfqqna70VLYqjZLUX7JHTfjT/Zci6t+5w1kh0ds29yvhakd', '1ddb98505c1e8036a83f6f8dcef13a87e184a70a158a97ff16cd73922a1de2869fbcf52c30e9ee73f5a5f47b996ed2da233086ccdf9e7a77be333227eb29f65dZATWKIlFeielm3AAgbYpJmnU38CO+EUGbPI+eNolxRQ=', 'e9bb1503bd9c7e5a483dc07bc90950962f7e3de29f30bf8547fa5627d24389c9c36be44246808898809fb5d8caceaaceb14f8dfff0cc07c7d4c7d52b47f38ca2Kyprdj16LYFkIb8QSpJ4MHUbeSwhzSIFhPbyrsrYpNA=', 'bf111fae8a485292e924559fdcb9a984d60226ee7b39bf172f003821822f6259ea1bf6ff66b283ae395b947cdcfdb5b80fa746148b414137b5bb5367569560412Vh7c1vQkwfWJEirHUjLwysqiVnNtbcArLXdQeltPFU='),
(19, 38172718, NULL, '18-2079', 'marben', 'galenguez', 'tienzo', '', 'bachelor of science in information technology (bsit)', 'Fourth Year', '5128450349d580805df3b29474a71178af30c0bbede1919120d7c8bd010bc30120537fece0e308771c7b8b99e811297f9bf6277c41b77db7e0e4a93955198247+Mc2+X9tUdjgpG8PxJQ7SZcR4vVN8LLHh2dHWGI541OkhGE9U0YjPlFFVHYVxjKu', '7510c1cfb92d613e12d8e4f76f5dfcf170b2871aef663cea5583d087597e4862cffb8e587033e727689598f7161196ffbedebc2998172f87283c340e2bc468c3k56a98aO4/PUkHC1UU8iSslhCE/jLzmBPLKpWT1QwzY=', 'bfefbd6a74ab351e5c869ea8d71596755d21328b4dd6a2a12dec71eecf392cf28af5624bf2c32ca18cb2c5f43ed35d7b98816e32cf1ec9efd6264ce018b8fbdalYQ3dZeIYkcqGr492C9kCivDcEYdyWC/ts+14N91ZqjfSpsTTvPn+IHtx2/hpVhP', '162a676f6f84966617512ffdbacf2526556338a383e3bef5f410291446b78e1931e48c90ad3a2f9464894731c0a310193673481cce93dec352b74b1fc07f6825u6DG+1/3O80Sfy02nMYd5rtIKv8Tojw0hhgqX24f1vM=', '6637b537c15268f610c6fa68e0b26d0d0d6356af0f07ec54d222bfd23c2828d490e2f09856e24676b1f661c6c08b99152fbe4caffc5afdd587b9af1ad1e26afa2oTsdtXPjp1DluPXMlgd5NczQhRjVYAYLqHSMxg13ag=', 'b90af5f3c8cfa1e45ad5a559202d49a4f9aff34366e917d61b9058f0fefe9631d257f9989776c1f970696a28eff342769dc60737ce725586adca5afbb57fd554LnwilRG4uMZKjVN2iNGVE1ySLfBsasnCuY6WDGKV1bc='),
(20, 42174019, NULL, '18-2079', 'jan michael', 'acosta', 'cellona', '', 'bachelor of science in information technology (bsit)', 'Fourth Year', '8a44bebbe19e2e6e69a7510666a949d72ea3e44257ddbabdc8b6e510e8f43abce2601dc30d0b9b4953a73ce529b566c629ad7551ea6160b492fe03ace11512f2ke2pyinfiKTNCxY63mSa+7HdNLWr5I77iKSrX8InwrBueEq3xn+5YGN7Dxt6EfIl', 'bfbd6c695e77b3ca01892c5d34d9812d64d80d90ab56742ddb2347e7a7d284dafaf85b896900a8ec38b54e7af7875c5d49b65a61ef1d5c465d18a565fcd89c02I3U7yJTB/7uU0+V21h6DIwHCsQ3k5iCqIEdF5bsN9Gw=', '1fa0120675897fee5b6537d5b6821e700d0baa989fb69bad54155276445cf2f2fb66896d4d080eab7a7630066e4709b05f3c3516f15e53f7885563e0465d2afdusIiKNThk4RhTUocJjU1TrmztnlnKrzl7uFywMJ3HIug5WK2fcJ7csn9ud2FVm7M', 'aee5fad4054336249c63ed8e9e792029e3f0141158a92ccc423c559539f516fe4f52a5ff1e165790d6f3af5ef552f7203f27f8cef4de2d4d49a09db978953eb3DsrRoODqEX/IkxiJzFh9ZFjSJUVFC0hHTtkUZkASgZo=', 'fbd757c215f67e1bc89b67da12bdc200ea522b8687838da0e7ac16286442094b9a6f4a554eb7609abfbb96b2add0ffa6d778ed0fcbcf7f297350e94ff9e6a8c5MROlGi/vuCKTl781QmELj88THDVteSnOxFrWrqfWfsE=', 'c4aa9b0d2b8729c8418bce201af035afa05f17d3b4b846254dc49a3a1d76f07d350294ea0599ef13a6ff8b64ed89f00735234a0711f12665529c739bb2923d09ptae957IpuIQ9etCkxOvcY29Jy9kJEdNORdjTQchJPA='),
(21, 2722290, NULL, '18-2079', 'lorence', 'oficiar', 'adones', '', 'bachelor of science in entrepreneurship (bs entrep)', 'First Year', '819f005f5dd3dc7bfba27e2a61271ca748941018ccfafd107a271c90e491ea4cc48b0bdf9b71ec29e568a81277534774913c63a6921ed00fb2c559abee680c0cP+Mop12f2vJfH9SJXkXKUhuxVtrSgKD/oA0TQJiEppV7LzJ0Qz4xUkOe2gzswAaw', '59932fd7fdd636dd157fa65f1bc6a37a1518109040fec338209dceb6d07bc035dbc3cfa472411212ff40413056a8813c2b13553832d17c323659ac641916a877J3hAllRyc0sjFLwTKdWJ3zDp33rYXejmk40u6/liLsE=', 'bd51fe23fa2679f7d1b4a142f43ddb7629967712b1357d4a5b788870505aa65e8fdb455d07b71466814895bbf00e0e02178d88b25f882bace43707a8deffe10fqZ0Cyn4gqFDQTRjMHmxMRosd7NaUBTAAJfPU7irUiR6kyowcsKe1rrSE02/Z6Fpk', 'aba5662b6d98c6ad75a745cbb4af240ee76bb6c267ac02e7993438f97bbab7b41a6fb50cecbf83b8c9a3d6c8ee6728b2f16bcfc24009322e19f0de36153da29e2zj4BM6Q0U9sUUGCLeugXRuWV6tS2x55yhd5RMYfnoU=', 'c0279dc0535b97583c4bb0210a4b4f62a1d4808e43c87ae4ac5025f9658074e693e7a13c6fefcf08017855c6e1682ca282e18cb24ec8f00ce4f022483682b43cIx6W14TulKU+s3Ow1yUskoKSrjOV3elEqDHlR9Oywjo=', 'efd459a13ca264f3d8b5714419590f3866c6e9b11baa3696e456c00b6104d33ad368f5e8f9e37d11f4649d7630f0ae2f4c7aef181565c6c877b6fd67dc15e790A9adeZnm8rvY+v8wL6eSLbzKd8ZoglWFRLxzVc0mIUw='),
(22, 2922101, NULL, '18-2079', 'dan urielle', 'sarmiento', 'batad', '', 'bachelor of science in entrepreneurship (bs entrep)', 'First Year', '7abdfc9faf85379520e125e7fb91cb8d71127414398b6324f2c366c2ec16b53f49f5c856b6673c318f16865e992528e3724c16f9a105619ff5f39e2cee060789PY7k0KnQe6Ysgy6DPdeeZRvlIwwNQ/E3KAPQPWdc4FM1MnJ3rdXeJF0FJBdMgdAG', '7b49b40928f1a1f2242d19ac2aa488e857b08558fa6fd2e5068a716097848ae42b15f7dca7a84d014a36d49e69d8c836541bb6e21eea1af9d59f9ff22633123cKjJ6VVB2bdFB0oCrwcUs2GDAXd8emu1BCsFYkUm+znw=', '4a7c666b4322607f09e3e6ad647e660651115bd8fc51b87f3b5569773c6c4332f047197723c77426ee2cce22e54ccd556a9b2c7703ff2e9649f6e14ee1962c11EQOc9dM3FvNDqQYZ4HcsxLHAmPuk1+A5f95j2vP3QY5FZLKyTbqrrZzfyQza5E7c', '790b47ca57341208dd728df2f55f136b6883d930c1f9c1dab339e1220383fddbf9970e7dac52ffbe1f47435199e7ba336c9d8559ae1d41e2902a20775047a32atBIb1lWj2gapNQbFVmC7jLk4k/M1RjIP+hNfXaKRgTbadjQw1tsc39MM1u+xx1e/', 'b9d142c2e18bd94d3c830fe6583386f0a3e799fe3075ef6295287e56854792f3186e9e486e50ca72fe980c49e38ffb90bb332ba65b5ca7590fafdb025f97e184S0M6HxpdlYYg+8U3zj3EzKyOPmfwGf4QRT6X4N7qUag=', '232e0b12cac79e380812be43ef5ab2649a55d4f9e9b30b3a5d9ad1ea69a584ae95266ee77e513ae94b4b8985674ba0e3bbef7e71f424097586692f582e6dc5d3eUR3hjLQEWxWU0XLpBcQ3tnlXduLMsOKGK1wbOSePp8='),
(23, 3122332, NULL, '18-2079', 'wesly', 'montoya', 'bugawan', '', 'bachelor of science in entrepreneurship (bs entrep)', 'First Year', '32f32d806a95db69b1300f82a30a155adcd392c4492b7b414d48a866676a676951e3528cfbf6dd075139b8fa98d732603a0d72bfe15c06b258a2555096dfd202bnwQp4iipp09/DrNu+cS3F+WHVxeNHu1V1sC8ommSy+892V9EIIix1mabknQPaDP', 'ce2ac24598a0a7e511dbb89891eeb7075597a1fe0c3ffc7d56541b378e8eccb0206eaba454dc4412fbb68dda31cd2aee3e4efcaaacd574259ecbb077fd792105gwu+2EfY1cgW/I9BGEzUPCeUffiIJH11FW+G/Ut3afk=', '71afdfa7c673a3cd2851270ab23603c21967b35b52f0733742cf0e87f72a5089fb541bc644541fd8233975afa20c052c781a4920bc4d136f277699d71d8b750bskk52gJrRrokZFmD+UfL5lMog2EgDj3068ZlWtRc0E7IaSoT044QyWPsCaFadAD6', '5e875e406e4ffd326c7b5debb69f0ed918f323cfe947372188fd692d0ee10f33f09fd1385e0a5c881de3bfe6385414f0044b5a769e4be1c2fe7b1af649382c08oiHaQ5QQ9XlpA5tqv1cDiAfjODmch3Nf8E9KLnwe+y8=', '6bc553727ad7e100b89eec8c9c5c75d97b400587fa9d9a7a2023d0ce7f9b2eadb1ecc322676bb8ed6eebf53e63b662679824d050d2a03437c9dec7e3f30834acZIiFyfeC4FP8LCzvST4bS+xPKEydGX6MggIMkcY3tgo=', '66222fcc06c90d329076f5ec15337fb14d6b7b39625a3df327e15d7a3d1a544633f29023fa19869630b41c55ddc9017027814d49abf67e1efe1844681688ec77Q5NrS8bB58IA9yOf+vLesVUl6Aiq1DwkO3R/DrhSAXg='),
(24, 3222283, NULL, '18-2079', 'john andrei', 'rillon', 'del rosario       ', '', 'bachelor of science in entrepreneurship (bs entrep)', 'First Year', '0ea3071f7faa23055cb86612f092b48ffb5cd071567e2f94df5809e7c95bd415934bf4464d22efbb6fad90b40bc51a053521e07bdf99465fada3eba64f964ce8v0OEbcoqzvCo4oVnTGsd2tpWpHxHZBdvEQoYbk/ttUlCoLMMNBMTQ4gymakTVroJ', '1b0210d407ef61b24ecb1f4870d9e4039b3dc31d2c685f3250a9963a4f631d7a392ff1cc49d252b9e5610e39baf69040c68627dd1fe264b8354b561ce6aaf400OgTIcSV9zneruw0hwRXydEhYxxgOnfiec/fYRknY1OY=', 'a595ffb785db3398eefca2cd64cbb21f7da947b0932704dc4d7672ca28ddfd77213e510cbef0bf6853f75a0841c5d3a900367a4241818c5c5063ed914f9b1232f5oIS7K0kGZ0O5JvHJJIF+G93T1wUfi5F7378cP6P674knm+SQzv/GH7SCQubS3cgg8Lm67PBdWNWtWeT32OGg==', '98d40901fe9991dae801c9f9b0a740af2b4d4c4464751eaaf64e91a9f2fd10bd83ed43e14e239da5a82242145f366ac1b42dee69a9eb3122bfdaa2d53b4c2b7fuvxK0E7aW58Cy3E/XW3MMUSWSbAx9KA61py21RQbeJI=', '167b3c1fd5ad527e6ad3b09a2211d7958bf209c1192b131db1c4439884d0481dfad0100723debd5f0299675b5ef58dee53d19e57ce6ba121b9f38589b7964293pTF+DOVQ9Ica8CPIIfZJkSR/nzief0+0av4pW7UGsbE=', '075831d19d4754a16f4d6e1ee0d52c94a1915328db41e728178c4632db1e48cdb7296ac5774e46077b55e23ae7727a0c37bb8ab12e1c77fe8d190799ca8571c6vPCPi5K2vuz1HcIRaQKFBXYyo3mjhMtB05tK5iq7FdQ='),
(25, 3522274, NULL, '18-2079', 'jose jerico', 'victorio', 'eser', '', 'bachelor of science in entrepreneurship (bs entrep)', 'First Year', 'c8ff87cb007c288915b9d9966282d2bfd84754ed0d347a7adcf12ecbb718c6e1cc4ed4c4c1ad2834dd8bfb4493321b3e3ae712ba03c24cb48e187c2e6e8f7893RByPpS8oc1DB46i29qseLxtPoX4/BT9Okde0dQ+zO4axDcut6Z8hnlgomDmcTLWI', '86a5a9805e6c5ec5625b9ed57db22e6c7f5536ce0d49d26c31adee0f89a87f13ef8dc7502338585601ec11779d1d3085e7f8d61ea952b346693bf1f3d56d68a5Xu6jEhRxXAWkH8RdUsnwILjQa/AjGA8Drv0lvrN/+Ec=', '111868335b7dfc0c8526c299653aeee2b4e377a3e0c72cb4624febcbb38c4454ca4d4ab2f4684e77d4b8e37ee9eae6aa23c04939c7e9666dc9a46fe77d90a4d2rJRwbtS/WxrVs1X3wk9myl8GwU2ZokHrIiJC06iMny8heW0nm8LcWx2YTdPw0p0shgRTfKnQrXfDNoS2+rFyCg==', '491a388b1e98071422cbf37c61c7ea8ca93dd87374f0157e388a9ca7ebb9422796c4e8f3ef7d7ec6457d9f8b1b4fe808c3cf4aea3d4d3da870e5ffe7b23a6147LWF/o6ivYerzUDUzwmzqr1WKzT+YdhbCg9o7UFtR5Jk=', 'f63d171c89d28ba3126f70ba31cb1f612407a5a37d27f3a36ae6e1a06ec03fcdcba0ecde3d72916f8b8b7634347a47123a50267a1ad617d522c5f22c7253db10fy90/1RZsBcOnLfhYt63Q2TEiDJe2IUDsWbZGsoaNeQ=', '629974c86040ba1f42e018b7c0cdd9144588e3602b03fb66b36e0b5efa9a9e085adc86480eceec595772aa54b69b04e78d43b4c790015af88026f99ca241ddb6wPa8QFLcfNxW5BXNkIvewuz6Gmzbrz1MFFa7EtTAIZk='),
(26, 3722005, NULL, '18-2079', 'kurt justin', 'rint', 'espejo', '', 'bachelor of science in agriculture (bsa)', 'First Year', '4dcd8bb4de95a5210abc5e3783152f13f7303592f62dd1d13cdaa78fb3968fabafada982abc4bc0ce6042a0b7f77288ede61f9bed985c88b05ef2c067ae22e5amIIsdeGGNffZ+zx/9W1x+cC/h9IMlg7MV99wXwSlzuvrtnNq1dCnjgF+DIcUbHcH', '18086ba905fd6a0b0b0d2bc458427815458e4e529c338ee181d3dbb137258b9c9f59b35280cc6f80959ed1fdf8537730415d3abb582e289e63d25f2cdb6111ebYjYUCp626AihlCO2b33MJ6mmvUoEzZlSwz0AV6w9qFk=', '083301d75956408b5d3c607442aaf16239a90fce6c36a95cc3c2323cdd7d393ade72f5ebcc793fd961551fc41ad48c59083705cf947c47c4900f8521e5a85671KurMvnJjYjl7u7+GNjpT0QHaZAgfMFYGcLEYWAVDK1v29+5ZIr3hwN0+cGkmcvDiPPzhvfoUz1LtY/91YtJu5w==', '62361f0727d2768f465568e1482a9a35bccaa1bc81a861e1f97041f6deffa8fab429ef8b9825b675ebfa2d343ed9c6105ea8a15e66d5a59183c188e330211acbDaiHq1+UBlOY4L8JEOnYCC6Frvlt0r0DWzG2gj1d58A=', '3fe698da481402fb40ca366862ddecf06f3103243a3d22bbd4dae0182314477c53275dbb7e90746da9987ebc8efe6dac65ed830ecd561848e0683a8c99089ae6tLiDFdyTNpZIeKGGvMXtqpdXUROWq5UoCTNSEQX2bGo=', '50e0241362664f1500ff08a192b0ac9774aaa855317e9be84382f5ad0e47ed57b9388f83cea66e925e7f56ca275674e57fd8fe07fa960e64c76dcd6b28157977x+dwiQFmXwO6WVb4Jyw1X43DWHc/P4N17sINOJzZeks='),
(27, 3822576, NULL, '18-2079', 'gabriel', '', 'garingo', '', 'bachelor of science in agriculture (bsa)', 'Third Year', '1cdea694b64475947a9602661a26b587459989d76a08bd00204824fd31f24dadf00f28a686c455ab36d5d0610300f3b9850e520f142a39e34e7dfed8a48875bbAvyxQZ+FJzPfVbV3SvePBpuUXvgxrOZfJOVSXgGmbWGKHQYIxD3TJysIy7HHybPO', 'c9e759adc4260f74cc9a43f5894e96611618c3fa1d3c83e5aaa30da26d9d670d4075ef15f4fdf5cd163d5b04d636ec50a142c5df3bae80cf9365fb32750a4737lJbAN/PS7ly5zmZa5Vlp9QoWsiukB+GlYlmJGSyeFOo=', '687e81118ae92c5982acdf091fe2031aab1ba481161cd4f5b7d7712d601f9f68d496d4ee3881a24aff25284de5e173327cb5350d39ad986efa16cb08233273b10pKzGuiXViWCs4SbcRaE8glAtcmj8NEOo02oCy9U3iPOSBrZXgEGcF1pGrqdYPGKW3tv3MHUILz+vfnx2w3bMQ==', 'e63f872697c65b84cd465d03228640e0ee8c39ae621ace50d8c9c91989719a2b403664cfdecd6c365a64ae16c3004f29cc6e02d86b7bd1d9adfcec91283d5137Wc2H8OP+ftKNP2YRwy5Ga5KdZwGJLTaGZCenKivqnQA=', 'b9db821d91cfb274a51890fab5572e97041e0457a77365f3da35da20989ae59f1cecec9e1fc3ec107d1774e11cc256c394fea96c7b72668f8ae5b38db9c85ccdzozSnNNe9W3O7XcErpWKqFovt5YLXCm8USNe7xVga4g=', 'bfb0c9248670213753a99a21d484aa3f5c23c837af149a07df05f01e9ae8d68bdb77b03c3d6d2689118878d1177c1129c1b191018ef7490eb1c7062adf1bbcd79SywOz7hxq2wWwynCJt5qvrFqBOP0e/1XL0tJ2RH5/Y='),
(28, 4022467, NULL, '18-2079', 'mateo', '', 'ibarra', 'iii', 'bachelor of science in agriculture (bsa)', 'First Year', '67ab34ef7013488e2613dd5be567e88555689ef82919650f4e15f84896f033fd946697cfbb4f50fc294549b1d9d513c80cbea61d688377da33be025c8bfa6e60Mzt1hUKJRg31o/LuywqR2sVuaO6sVy4ZgcoLyjGuIMKsg1RS8y5bCSQM9DJbmNjY', 'bc8bd27fc502a2ec1e35ea56184ffcb4495213122719474cb6e9c4c79664951ab48b3411741df6e193c82c36fb1e9df7c9eaf751da50ccc9e09806d4f59e5eba4Y1jVz5ZCFBy1x02y2porK4F7jFKnl81o0+BJRSyvfU=', '56f53871d8fd553e36072da5c1a1e4831715982dfe55106bd2b61a7286d82c5fc89cf0c8862ba86a95b881b4e7cff80b8746fa8e4c8ade83fb300ef63ecf8d8abt9yASUL2KImJ1/FU/sLpy6aFM+t+YDe6dJ1RXzMl6MeTWwnXemnGs3xw4BB8++o', 'eab5c0b88fee39e88b6550eea1bfd1d3a8abfdedfc275508efcda5fd1271df68a14513198b2f3a60676def0a46b6e14cda3b039ace88fbb3c9fd73e1552a7207YPGLPq8ld6EywTNvnRarh5aCTbCGCB4wo0cI/SF1W2Q=', '63d24b48e20ba35ca275d39be97206d36a56489936c610ae92ce6df191fe7cf8c12c3e3ae06ca5d8824af90b678489ab2d48aa648edbef231ba2730b70212469iuERUPKPIFgbPd4ZL1f1svPEzrjD5p2GErGh9cvFMJA=', 'bdf9b193c7ca89b1e230d0ba5d49106a42ca18252305c245d296e83bc4490c5dbac452e544aa13fb3f950be909dfe4eadf7abb9739eb7911bf769f0c2c0dff13W69VBdmJZjx0r1IRk9XjVD3mdDixrlXU7VX5rQ37FHU='),
(29, 4322438, NULL, '18-2079', 'christian paul', 'mackay', 'manangan', '', 'bachelor of science in agriculture (bsa)', 'First Year', '09a4efd5bafd5d7dc205f1f34ce4095ea15df5d1aaf3b8a5aee1c82620db17c2ea21c87cbbcd75713043db9ca3da94155cb3138a7b0c726c1510b3c01b6cdde9m6+TUXSeV80hjQYEC9aSXwqIaIffCqGDqENCWZ3h5W1fycnuU/soHVuMDVnfX+4K', '0bd994000e3cd8aee79d385023d6885430914f0561c868d10eac1ab0b91e97ee89984e63236b9fc0e691ffede320faa7997406521af562cffad39e79cd3de9f8gHwE1vjYyCUbKczpidL86xfFFMmdNO+2GEljJnj1M14=', 'bc06248eaf434765c34dec09d62dd4b2801e414eb1a06361615a80733d86a06e5c58eb937392f509a546015c18e9d474e9e2204476e23d4af9150548eae268dbaaEmLj9VFnqwurxNYtlssuKoI9phzTwgtaBiHWNVKUxgUHSW8ljIL38sCTP5kNjd//wsvlqTP+pFjZpTfvqxCw==', '9a1c81e79dbc405a2eadeff1bde713aa0d36040151e8518e0f4b08b45230f196b00027c9610e15e2b423f5430faa89677e3b97cdfe6f41244880a58daef407e9zyOhgUoDz4/+NRJkbkFlniUQ1xG9r9+rgeQJnXv0xY8=', 'bd04f63f0ea26a730c07970f508f20c35d2839b5984d86fb784a81388de1eab5084105887f24c0a1367201d25b7d177f0fac1d89083ef23fa14a6e3dfb6ee41d7d+OJJUkOzzkgYn7ryulkk30KOa3eeca4WdIT4uf36M=', 'a7370bbec9da84065319ee786e76730b5b9ac0fa98a955e9ee46f59e4ea23dfd10c346a8eee6dccf7139ee89dd49da82706cb6a489a0280cbc59ac735a3cb22dbymLmy8Db+rbFJPgbnf3MU3FVDJKzucdlPOEGDVXZpI='),
(30, 4422579, NULL, '18-2079', 'renz vhismark', 'inigo', 'martin', '', 'bachelor of science in agriculture (bsa)', 'First Year', '11b2ca6a62a86eb85e9a456e13a15601c9a3f8549aa0bd7fc65584f06a1d3e7a8f624f8fa34f69f5ac39e18bf3fb2517ddaf138682183e0e21aebfa7e3c51e5dKGoLyXR//mWeO8wpRO9WTJ2ng7QgzdPFUB8mi9YZMv4xmkUxgaXFnVIH726S77jB', '2bc1652bd39de99c8a03278ea567af2216ce1a95fc5338f594d5429682631e6ef772eb4f6c39c91089a07e213908af8e03c42172a48a3a019155ad39755381cchsUn5aGywaIA5jvT8hUB+LbrsuoRVRqnl+A7/g1HLbE=', '72852f878cd4426b236d1987657daff427bd9563ff40c0d21c51984be9018549dbc3c2baeffb6784f78e895c5c04d7f448dbff838a96741e38c0cce37cd25fbb0q2+QU1stEbM+grkq+NNTqvJluc2xSqFXl8iq4h5iv+E9IoCa85KZxfz2MaEr2Q9sh6OELIELDAcBfbW0OzQ5w==', 'c5d659f197aa38ebab01ddac4d9aba41b9f9c27c601bb25e00ea34c60b9b2f55b34f31c6d08d36f2acab4e3ec5a612082870f2de54b49578c6b247e29cfd3017DAKrebsMUo5DVF1G3zkbTvKhOb+IVLQBqHdyMJrZRgo=', '7d67dc288e083fae7d3a0eacaf16c9f50224b13c3fbaa73273edc51c1e78c16f61cc9e003830b5285366bfbb72a86656e1ea74ec88a87777550c9695536254b72/Zv2frCVGWFOO7mmAzOIwXaIJaOLV63AFqh/Yg4JBA=', '2137a16fdcce35f5da56eaffd793b6bb41cc58c31fa3e23362bb77a13cb70febfc646840e1a3b1190d2f691a10a25e4b6cb27b2634c291dd7a08cfb6b3577e42OGBUGPpx2VtaiIyugMUm2YEeiHQ87bywQRe+RXvjBN4='),
(31, 46220710, NULL, '18-2079', 'joel', 'rivera', 'oficiar', 'jr', 'bachelor of science in agribusiness (bsab)', 'First Year', '4fca52838e683dd3f76b055ecaabe39c5a264c139c0b5c1afa7a3797432355ec1bf4e1fd62ad2c4d9c1a7a7fb0468463f4dd52071bd2824d3f7bfcb6fd6b6de5wPHgLsY6oMyRub06D9x7fkzXROs8EHQLg6PahlltTPqVV5+oApnSZ52VWJelKTl8', 'f674ad6062daadf8ef166b76d5230e607117f12ff6c7c1fa46529e27c9f6cdfb09044cb657b8e588ac97898607eb4c111cdadbb8ed50637c49f580c3b5b928e9hIm3gEK/+vSHmqmV3+gf+x05u6zIQiwZWTXp2tmL+tM=', '05ec5bbeef3e7c55172da5fdab764233909bcec105b798b5516e2c1e213570654d4d5ba5118bc00d899d6ddc813b937ae2aa5681046561e0f52e509869519426bO1PIsoexkW5Q/EnHB+2bm1Mh0TMGZ+2cnPXEXNPLTjxurE5YnbC11hxB8fvyIVY', '86a2f3db61a3f40feec23a6991d8e7d2270b9b995ef3553701e2cf07b3c966a4677b75ac8ccc70a48ed311287a4bd97f8fc60e12a44e83b4df49348ca0d7283bXXHlqINe/rYp7RN/LAgk6tCRDtn52mgsm5KcHIXSZ2E=', '820d7270ac107c75d54bbba3bab10cad64c2008d3325bbdc6a5163fcfd3657b2972e1560a67c0d0071a79be7d9f5936104fbb66acc933fde8f7aaa707767cea2xlS1JcYHfRhR3Y+ska/C61AkytOlX3np9L+Ri9Eo6y4=', '62fcac8bf4f79ecddea7bec7078ee08b5824fbb1edee2b72fa50ac8d68a2b4bb0032df7301a14577029106353fa03b5495b6c2981d086a5c9692e8762605f21cXaCwMRj3QiGoDsTFDgcxbn+Or2VRd63nrDT5Uh8hD4U='),
(32, 48221611, NULL, '18-2079', 'king james', 'reguyal', 'patrocinio', '', 'bachelor of science in agribusiness (bsab)', 'First Year', 'e708fb2585e767c7e53b7eaf0541b9a71fb404cf7d0c69bfda72387e0166c183bd671e6d5719232732ff78866a68265b3ab409ac79d56d555b8c63194ad35870IFF84F34CQwvR5m8npDKmP9yrXn2klybxGXgXlmDecVv26IY7FsSWJZQ6N94qJhp', 'dbf896e6102d247569365a4961787bad946cd41a9102fdbd2254a2bdeb9b9f9671f67b134c05c8b5557719aa6229db7ed3bc846d14d20c8c5c47d5ac93ac5a2fSieppUyEIPaXvnZrqLrgv3XSbFWhvijqrtUJWQwrJc8=', 'cb157bf2bf09979f81b29340f69850d2d4a76de5ce18c68719b8b10efe0ce9764db8dc687b0f5feafd292e642dde206ba60701b716d7c6962397873280812b4dz5ElLR8fmhRUdHTv6vPXchMwjD/G9B5cIpQvZVJsI2lyDCLxuanhILyspGTpBb1Wbby34VbB3aEHL4Mdr3mv0A==', '0545c6543362db7677f327f1697c469fe269a9a8074ad65930bf3b9a03ab09dd82c36301ea454de36b4d1bd5d658420534fb975767d2b903be0c09841963ae29p5r9sv/k7yY59Jde6m5mydQxNKmSR4bTPOPD/OJXUtQ=', 'a5be184718baaa64bb10e4eb58dcf0d22739b84af320f7bccdec06dd59161116476e99b697ffbcf7cfc7e88686dc1ec76ed35658d6eefcda803d2f5741d4874bprmBG9qgVv/LNLVMqH5lQvfQjoIJbSXiVIzCan1ECII=', '337c18338925649561f0745ad8a73258e80701e13ea29882b68d9fab63b426168b689b39704634c750bd18915d7d9d8370dbda289bc8ed2f2304018dbac19348SWWx3DuCBviGBmbNOxRguP9SW63E9bjzVamROhqSNKc='),
(33, 49222112, NULL, '18-2079', 'aaron luis', 'valdez', 'ramos', '', 'bachelor of science in agribusiness (bsab)', 'First Year', '557fb1278e93b1ee9c73b59dba8ce0515cca311bafd402ad5db1d3c9d4f0f794c4111a256909fe52149a19d8c91ab054dd51e1fbb8a09779c54ff296340db565RitHUyiTIk5C+zMPT0tHeKEDtFtr9EO5yFPNwTUswOYFefXCs9SuWQyY6ToqtmEm', '35437b64fe9e142a48ac82876fdd13d979a9b66b64a671787c2c8e5ee486202d72e8982aef059192fd7a411f0441f744fe0e94e2fd6cefbd66d22e32f6441920N6AU27bTFRauGhn2X3GBLjoJhZvyI6nOj7RDoMZ0Pck=', '433c2f29f1c37570e4f5401cb814c5985c86c322b22232af4d4eeda96c6022c64f856be1cea640a70de1f0532b5612d8d926090a6bfc142b41be5363cfa1afa2dwmFDKZW+ApCJU0ctzyUSlo1qqz1HYNPHgeYw/1PpcL0hNrYZ0wFgssR4C6J4Giib8Ejwnx4aJDnhBYI5ZCYKQ==', '253a51d74c43bded39d44ae65403309e2dfb76255cee17d3bb45fd8007b97b69f491f2df904416e30be5544c32d52fa18edc7c4f6ef56a6fd320104f0534647fqLhj4WVtEFg+D7jcc/ABBQ3LF3BeP46plr4+2Y8aFKs=', '01838ad5b33954cdf40b6be732eb171eb3ae94a679d6469f5c897c4b4e25fe525201ce2e809d49fc49342c281bd7cd3e4404dcdf08fd738c005e69c3cea409bbF5OCXspLpKurxzajBqG2mNLVqmGBwa6vJvjytdAst9o=', '524b151da1940368aa7d1ec780229038df7b22ebae061e6aab34788773808020af837b8eb066e5fae024787f8d26b2ee3c1f2b60d0671c2598bb331627df36ad83cx/DiVM1N3QdOvJtH9anzSXU2psPBYwQafRLarXE4='),
(34, 50222013, NULL, '18-2079', 'rainer', '', 'santiago', '', 'bachelor of science in agribusiness (bsab)', 'First Year', '40cec7825fa3788a273c525224b70c44890dc8c7c51e1feaab8a12b7b5c349c911f03fb3d738bcb481270241651a70f508aa08c03153d190db678f74170d5200E1WzC4WHGoSffntEBkAR9TAmKtDSxd8/M3hPHvEhE7I6fdfwGs8vqnY2R/9jBb6b', 'dee7d65af29a1ab90465f97d2758f605f3e81fe269a7fca8cc490d8428c41cd68407e9b64b8c107bd1f786a3cfc4ff38ed1da4cce9603439af0bd7e2bb27aa50QdnhVRs6/L9eG8LP9L90K+ahVSive2x85Kybkabx1do=', '2556964d878e8b83938e7ff0521aa1d479737c23a8ca575e319c233320473f02aa06bb863ea08b1d999915b77f1b6b9fed8e8f42138f8ce39619990d50dd7757gDzUsiphONXGYcmIEsb5aEpnYwHvL2CP3+4dhxruopAe22XDLKvk49fy6DfHZlaO8p3bmGHQXb8d6buiYcM5Ng==', '40208989e05a02ec91359fbf7c79aac31ae1a87015bf1b580418bf5376bde95ba7ec45587ac110ee79b1a7fbc104efc39eeaed00318521e01b7d09157a0358e9W5vyjN+Q2tPnH0KXEaOJO2RJIq+yVSoLOD4gesWrTCE=', '8bf4a38a8eef48b7dc7604e20495f30e370020cd27fcb8de7e4c5061e54c23f9c427c804e9d8b7c8a35c77f6929a8c7b6e9d00f9f74bcf105e8f7a5825e01b08l1BDsjFerDXM0xN+RnTsxuK0ShcAE3O8OA7tzbQtowM=', '727862ff3f011713ee9c8d525a9b9c107d09b85f47ad1456828f9438819c992c7447d4c7d88e5f05d881fea21debbfd7d8882ba4367610b401b4fce53d8326573AbfZe91acRU8it1Mk+iOBuZAhzHb0sAaDqlQIe4U/E='),
(35, 51224914, NULL, '18-2079', 'mark denver', '', 'tarape', '', 'bachelor of science in agriculture (bsa)', 'First Year', 'b09b4621d91e840362f4043a147a3eb1dfd834d17af866c16395bdee5f41ff1e7d793b975ede73d43f8b199cc89c03ded253fc548e50b9d863618d5cc6d23012hacPmgmNtDcVnROqcpoHI6ry/XtXelPf/lpo8Gkh82Kqe+bjx2zHPLqcUo2b1XUc', 'e25e92abe30f24014512979fa875b7413294ceb318f5c29ba17d324becdf2ec9d09f4846bc7d9142b843aa2473e4c002c74a190402cc38c72ea6af34c5058f0d1Si4FpGaB/LcUSikVVw6oIDzz2PNAiQ1SrW8t74llMU=', 'ae5afa305d1b49bd08619a8432399f800437846a362e4195ecc67f7ec4a5679cd700e355e1921d9a0beff5368025ba8d7356ec95c25315774792199f23efc0baMY4FZlolTbIoFYd2bKXLX9bxJzSO4Pa1WGSy9wzgGt2r6UqKoqYQdqhJX1ZK47zR', '5904200af18df923c4130df2027453069855936a8578384e33e9063ae7691fe2d12fb45191dd22c6ab75f27aa99b56ee1923ca56512c3ba735a416b13cfb65935jThPG1ydfGk+xEx2jFbUJvuIv/ahH2XrKmsespFCRs=', '4bf7afe834f2b161126e4a7e963cfd83ed209f4863070ce84a42298d23a7aceee4ad45c9ee150c9b22675a4305fbd337ea1d1a348de5ac075b0c61971271bc086gbvgJAMbkWpRgqNsLKU/kZOVWdBgUA7OcIK86tWm9s=', '03df87be3e6c7dc3c265a181e3344b2c4ecb1f47168a35291a7332694f3d56530ba041743415b4c93dad9a440e86d00f424c34ebabc79af30c4d480466a5d319CpgCqfZwQbGGTq+mSGbJqdsO3C/lqHSdH9VFYjL7FfY8Vt5TaUolH0N/6VugUcj0'),
(36, 53220415, NULL, '18-2079', 'kissa cassandra', 'gabriel', 'antalan', '', 'bachelor of science in entrepreneurship (bs entrep)', 'First Year', '50db82d2c134fe9455fccdb83fe4723f1df7e84184d0d2516f511a6e7b626898ba790abc77c1df20ab9274322b51c7b8d011f9492686d05ee846445895d8ea1cLJ1y7rsRP6GQRZq6wPPUsYnHwRJQNBQvMMnEz5rDIOV+UTEdIpPHJqam8y/XU6xd', 'bee2edaf7bf5a7c62439b6609e88311b8939fd0d3792821a0476ca192edb86515f29244a7353f6d1620d2c08a7e5b61b80ca92e4cdf99505de4f0da1eab5615dL7u8HS6qMTLGTLU8Iqgia4WzgBFYjh53Z9y4RYtCYD0=', 'f41c94862acf44c60e224d9e07c379d41d82963b1ba22629a47329f8076fc7ea2f87654bd1c0155bf335179e1d9f0a9960ced0b02d6be661d8b111f82f6d5dc08aPjsH/OSfUz5REtUdks2moTd2G1bd+0uoig8jEFh4FTRlZDxPXEbo/h9YT1eZoQz/OSwG0vI//hvbOA7FjX2g==', 'd3910ce527148bd316301e47ecbbe0e20eadee86c72ed7558317eeb28c31eb9cb04bcdd8fc35a00568dab383dbe7ac73176540364c4f7e9f04cea40feeea6567EOFUxrhxMA8W2n52L2JdTetGoP8RzrAuLCPNwUcYztM=', '8172954738a2db539e6b47c4719a8eeef2b6d4d1d41b2f157ebee3114592726e312730f47abd7f2cd8286d76dec615c1ef9d4282ab6d6f7f919a1a82399230a0+It6jG0co1aEKwgYWT5m1oE5wI9tRSev/JkMlHN9ieg=', 'bffad21f7da6c38e6ef611c9072ff19b30919e3e66e36bd74e6d596718e5031c8f0f58a5dcd79ca4749904e8b8eb0ef40daa1e34397f43ad4c1a8b03c6704c0bJ1/Iy9+ZHdJKG825s4pYyiWDczbAurNIQxVh0kNoF1Y='),
(37, 54222816, NULL, '18-2079', 'reign nova', 'baladad', 'antonio', '', 'bachelor of science in entrepreneurship (bs entrep)', 'First Year', '1d2f85d7cb37e6577680da7c4d5ff98004c8cbdf8aa09305ac7fb78d4612381729f576fc132124e468864b3cd4d6c3f11644190524f16f5e538d32d3558626cd4ftKSJt+S6bBBhc/N1oCPUtJ0owqy/eUogT9DRYF9gvC/eILqOl3+1/958UnOUaN', 'da73a4e978c5064701ee71b05e4309a21adee0b74921927cf68f7d29e0f433ca58aad43a9a76ae42463d19155818083ad917403e73d084ace9c4abf11f568810fnz+6W71gHm+RX20m6ytQhM2O4CQdRGjDyDEEbXcDbE=', '0edef90fbdf006bb542d1ab3da6a6a6b89b07e7a3b2956e730118642b93a464b5ed19b6eedadfec1f4cf86ff286c2963792db98dffb78ab0744a32eaf0d92c917tU5+MQhRUPrGH723b/8OIeHOKSUKMoJuP5I5skYoxJQM1hAZELRoZz1cbyNIzsXTq7X4uCFUMqJ3Q79Xu8kug==', '9721af607f8b36a6e11b9a7c2eb4d5ea4356506945d403a911b2f6a45b35fcdd93d936f168941dad3736cfb1f06d2ef060c8bd308e8fc49d34bf9c4d9f229447dvMfPYpS4uUfqeNhhGRy7VdobGsHoZxo3QC1+iOkB1w=', '25300d75ea4af7b79c9a02c40fc846f71790c6e212e96392af2c5ad0791d59c49b59a280eefc22af612af315fb6a5c4c883ec5fd1dc645ca653c472cee824f52FjJQoERChgXoGlT6kLy93F28oHBHdFb/AyDENB8KX0I=', '70f6096e99503c9d4105049f24e067ca4437d2d69ff170e819ad9336ebb1815bf8d11e3f442776f6bece0158a31f613a36e72cdb6d57c28023e9a2b664b53e765CpNEGh7FRLJCRqPicVDSg+uJLZAIFjVpxBfc84qrCE='),
(38, 55223917, NULL, '18-2079', 'lady-jane', 'base', 'bajenting', '', 'bachelor of science in entrepreneurship (bs entrep)', 'First Year', '82ab072ccde44da196912c55fa54314f12684872c5d30920a78dcdfa522df37fa9271916b5702ff12179cfc9b3b0570d80afabea3c8003ecd224ce1d0aaef847ITUwjsrrrpjN8504oSbWC/T5k8xmCjJEAE8L30yoxr3TimeKdxsjutxGLilApE/J', 'f8b718b2e10dca7325d8d4abdb747f93788d3bcc6a12b09ddbfa864b299b983547218e5c5ac1fe6683686e60e5562f421f22f4d70fa6911e8d648abbf9d7fba0IludoinNNHZ99pZlHnZ7AYQeKOTulPRSKKOzFIytuWo=', '6961c4810e7517cc66d7f0bb1d3db7377e55d3fabaa5fe30879ca0f5c50bd8e6815a7c5dfa154346b331a1107c4f39fa5e3323b52a50b8d08bab280023a556dfFKSmFPN8/Z4o1tQSsKEup+jR6c0u1g+77sK52T+rZkPqaw8H1Bj8mUPV+BVkf2kXtXvIRNyIN2BBa4Rj8QuZ3w==', 'd02bbe112b8d29964c927603b6a0dd784cb0ff1f66370599b21d5fdf2d23398c9e0c066806cb89575f0394bb5a87d617ef45af082f880b4e2b7734dc28725b94EfhLS5hkreLiKHlfzppXMtbdRS+bA3UtmGh45bWKvwc=', '78bf18de368a85f4a1d1967d4734325bcdc2fb6226247742ea1dc8ba888c5c41c3b630e3b2e5e64243d8c9a0633574b35cd65fabb6c1a28211cc8224a59bdc82tLw5vgAHarFtoMj1w72P0PBj1EdnFMpJViZf6Z83wTk=', '268601e73f10c4d80fd1e86bddd80d5206d5b488027d0c052232c2b210871033d4cc03d107a5f051f0fcdb606089d32edc5433a1e8af1219ad8f1a94029090b96bkR0jsHg+BQ4qT63dDoJGSxxut5BsltKJ5qtZF7h9M='),
(39, 56223218, NULL, '18-2079', 'sheryn mhae', 'lictao', 'baquirin', '', 'bachelor of science in agribusiness (bsab)', 'First Year', '5d1506ca0fb7c4f65bccf9535438cab8bf5339211bc2e4d130805c4642af96787ad534a3aa112bfca4b79292041134ff815b96b0a0c661fa77f93deedc62901fujx0M0iy2KEW4oifIN2JkYSlfXtlEuDgaLupS0gsqNjvD1pXFi6UwmS7E6a0UNp2', 'ee0eb636cf1203478e790903306a8c6592ac5711b5722b65beeeb93d0dd0ef28b20e7d5a5c2087b8a48021830c89a781699c44f906769adc334800be2056122dbfIu9/uA4p62t9spVU3dElv9ZBW1zwGqBTimQvq304s=', '0c43c3715f96e507ba19d01310cc633967687ef54942bdcf2fc7c487277dd110e9c7ae067e62a0ccadfeb7957291fb9fa82bf8cdda9be497713f9cc02d029060PLjLMG5iJkkTPybSEdwBbxYdm39xBuYmfl3NlnvVHOwhCPnyvJV1cQzL+/qCIDoQyXm+adlUuYvzxnOLmLnDGQ==', '5a65cc5ee371c980396433f59ef07060779eeef027feef2f4356e55af1f39c89fa95d3e00d6257701656e753f96190b6b0d3d927785d8e12faa8ca1afc596035bytnDcH4AYDkBiAAo0U0RIFhvPJNsNh3zM4AU8IpnD4=', 'a5971bf4200ac4c5afc51c1193ff34dfefcd0e925d9dd2d46c7b100a791d7bf2b3658cfc421ee54fc9c098ac109750ec31a078b1616803f8d960fc3551442e075wLDyEhkAFuV2dmomCmuKFL9lA+0R9nut96WCrVGZFY=', '6937cc7aa46d7d7bb0d955e3ab14b7c72d5093ddd3e5cd53000fb3fd8e4322e277f669cad0351ab0c48039d6f0854daf52cd785d29373736020419fef4bc2879ivdYpDvycorpzd8NlVjOR88MFsUs/Cg92XSE1HZFSAg=');
INSERT INTO `requestor_info_tbl` (`info_id`, `request_id`, `identity_file`, `student_no`, `firstname`, `middlename`, `lastname`, `suffix`, `course_name`, `year`, `email`, `contact_no`, `region`, `province`, `city`, `barangay`) VALUES
(40, 1231419, NULL, '18-2079', 'jhero mae', 'santiago', 'beltran', '', 'bachelor of science in agribusiness (bsab)', 'First Year', '75681807af3ce40572ee51b4af980bad5b1f393b22c33eb5e1955f1ceced4b324acf06ddc04c374b1b28353e412368771cfce37badb9db44ac55a8199362aa37zNzW5aJHPpReLuW+fk1XF3S8C1+S92xSUUTBf/lZg/mMd8hTDptOiS25DH7TK/Fi', 'ca456bca60a3fac182d61a51e00737cca9d54bbf59f8b5234dd9e7ef0d08ee0c5be80354decfc3b5e50d764577324c1724ee9b5283366b9c729a8c2cda833172GQ66RGworwsKoeG+KbP5kMk/8QpflQuBnPqBc9vhqRs=', '664cc31430a4d71cb4529d9d3e8f73ee72613bf4ba02cca3311595afeb37830cbaaff601c10781a610840828e028d54d9ac2873ecefb68ba74161fb565ce9cd67mXhqUX945au4lQXK20N5o8PR3HF0Ue9ZiXiZhcEIAZixTliNEfFDRaUJz3A3D0F', 'e45b6e94f3d9da45c271bb7d73181196bfd8dabdcd366f075cdd83e926140678187ede08a4a77bd727546783588ab7c619d24ef36e3663ac8be566622953666e5pwPcER7/Cwmh+wlodsBCzWuvRt01tPhGr45Sm2SYmUWIBYBZuMHCcK8rOW9i0i3', '77ca451e19a08f836b8c67e9d7be4710ed254d0109ae44fd37cd1ce9949ce1f26db3f56cfa4bf22da34c5c0ea613711272faea43d0861bd63c26feade038d6abP7xtqttDbfRKVcmfqlhlp8oQXAqYyvEZX9twlUxsgPGR8+mUwR1J5EPOPEo5pdOh', '0c937c545ef2c98eeae1649914d96fe12b7b0ab20e0efe653dd08cd6d19a916a73a6cb416d633f92c65026e4b593dedd49d445b630a37c806c61a6a2195133bb6ezpmpoRWpkiOCEuVVYZlysWYnbKi/DaHI6tGNeVuqs=');

-- --------------------------------------------------------

--
-- Table structure for table `request_log`
--

CREATE TABLE `request_log` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `staff_id` varchar(11) NOT NULL,
  `description` text NOT NULL,
  `status` int(1) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `request_log`
--

INSERT INTO `request_log` (`id`, `request_id`, `staff_id`, `description`, `status`, `date_created`) VALUES
(1, 316030, '21321321321', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-05 16:03:03'),
(2, 1016051, '21321321321', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-05 16:10:05'),
(3, 1416202, '21321321321', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-05 16:14:20'),
(4, 1616523, '21321321321', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-05 16:16:52'),
(5, 1916404, '21321321321', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-05 16:19:40'),
(6, 2316125, '21321321321', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-05 16:23:12'),
(7, 2716236, '21321321321', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-05 16:27:23'),
(8, 3116437, '21321321321', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-05 16:31:43'),
(9, 4616518, '21321321321', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-05 16:46:51'),
(10, 4916019, '21321321321', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-05 16:49:01'),
(11, 50165110, '21321321321', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-05 16:50:51'),
(12, 52165411, '21321321321', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-05 16:52:54'),
(13, 56163812, '21321321321', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-05 16:56:38'),
(14, 59161113, '21321321321', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-05 16:59:11'),
(15, 11174914, '21321321321', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-05 17:11:49'),
(16, 14174615, '21321321321', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-05 17:14:46'),
(17, 16172316, '21321321321', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-05 17:16:23'),
(18, 34171917, '21321321321', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-05 17:34:19'),
(19, 38172718, '21321321321', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-05 17:38:27'),
(20, 42174019, '21321321321', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-05 17:42:40'),
(21, 2722290, '55351231251', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-06 22:27:29'),
(22, 2922101, '55351231251', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-06 22:29:10'),
(23, 3122332, '55351231251', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-06 22:31:33'),
(24, 3222283, '55351231251', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-06 22:32:28'),
(25, 3522274, '55351231251', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-06 22:35:27'),
(26, 3722005, '55351231251', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-06 22:37:00'),
(27, 3822576, '55351231251', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-06 22:38:57'),
(28, 4022467, '55351231251', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-06 22:40:46'),
(29, 4322438, '55351231251', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-06 22:43:43'),
(30, 4422579, '55351231251', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-06 22:44:57'),
(31, 46220710, '55351231251', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-06 22:46:07'),
(32, 48221611, '55351231251', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-06 22:48:16'),
(33, 49222112, '55351231251', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-06 22:49:21'),
(34, 50222013, '55351231251', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-06 22:50:20'),
(35, 51224914, '55351231251', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-06 22:51:49'),
(36, 53220415, '55351231251', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-06 22:53:04'),
(37, 54222816, '55351231251', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-06 22:54:28'),
(38, 55223917, '55351231251', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-06 22:55:39'),
(39, 56223218, '55351231251', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-06 22:56:32'),
(40, 1231419, '55351231251', 'Request was created and given to the designated record-in-charge.', 1, '2022-05-06 23:01:14'),
(41, 2722290, '55351231251', 'Request is completed. Documents was successfully sent to the client\'s email address.', 0, '2022-05-06 23:37:07'),
(42, 51224914, '55351231251', 'Request is completed. Documents was successfully sent to the client\'s email address.', 0, '2022-05-06 23:38:18');

-- --------------------------------------------------------

--
-- Table structure for table `request_tbl`
--

CREATE TABLE `request_tbl` (
  `request_id` int(11) NOT NULL,
  `student_type` int(1) NOT NULL,
  `course_id` int(11) NOT NULL,
  `remarks` text DEFAULT NULL,
  `status` int(1) NOT NULL,
  `outbox_status` int(1) NOT NULL,
  `payment_file` varchar(100) DEFAULT NULL,
  `purpose` varchar(100) NOT NULL,
  `delivery_option` varchar(100) NOT NULL,
  `message` text DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `date_completed` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `request_tbl`
--

INSERT INTO `request_tbl` (`request_id`, `student_type`, `course_id`, `remarks`, `status`, `outbox_status`, `payment_file`, `purpose`, `delivery_option`, `message`, `date_created`, `date_completed`) VALUES
(316030, 1, 44, NULL, 4, 0, '1', 'personal use', 'send through email address', 'Hello po ma\'am!', '2022-05-05 16:03:03', NULL),
(1016051, 1, 44, NULL, 4, 0, '1', 'personal use', 'send through email address', '', '2022-05-05 16:10:05', NULL),
(1231419, 1, 3, NULL, 4, 0, '1', 'transfer of school', 'send through email address', '', '2022-05-06 23:01:14', NULL),
(1416202, 1, 44, NULL, 4, 0, '1', 'personal use', 'claim at clsu main gate', '', '2022-05-05 16:14:20', NULL),
(1616523, 1, 44, NULL, 4, 0, '1', 'personal use', 'send through email address', '', '2022-05-05 16:16:52', NULL),
(1916404, 1, 44, NULL, 4, 0, '1', 'personal use', 'send through courier', '', '2022-05-05 16:19:40', NULL),
(2316125, 1, 44, NULL, 4, 0, '1', 'scholarship', 'send through email address', '', '2022-05-05 16:23:12', NULL),
(2716236, 1, 44, NULL, 4, 0, '1', 'advance studies', 'send through courier', '', '2022-05-05 16:27:23', NULL),
(2722290, 1, 1, '', 0, 0, '0', 'personal use', 'send through email address', '', '2022-05-06 22:27:29', '2022-05-06 23:37:07'),
(2922101, 1, 1, NULL, 4, 0, '1', 'personal use', 'send through courier', '', '2022-05-06 22:29:10', NULL),
(3116437, 1, 44, NULL, 4, 0, '1', 'employment', 'send through email address', '', '2022-05-05 16:31:43', NULL),
(3122332, 1, 1, NULL, 1, 0, '627531453f04f.jpg', 'scholarship', 'send through email address', '', '2022-05-06 22:31:33', NULL),
(3222283, 1, 1, NULL, 1, 0, '0', 'personal use', 'claim at clsu main gate', '', '2022-05-06 22:32:28', NULL),
(3522274, 1, 1, NULL, 4, 0, '1', 'advance studies', 'send through email address', '', '2022-05-06 22:35:27', NULL),
(3722005, 1, 2, NULL, 4, 0, '1', 'transfer of school', 'send through email address', '', '2022-05-06 22:37:00', NULL),
(3822576, 1, 2, NULL, 4, 0, '1', 'personal use', 'send through email address', '', '2022-05-06 22:38:57', NULL),
(4022467, 1, 2, NULL, 1, 0, '6275336ea7fd3.jpg', 'scholarship', 'send through email address', '', '2022-05-06 22:40:46', NULL),
(4322438, 1, 2, NULL, 4, 0, '1', 'personal use', 'send through email address', '', '2022-05-06 22:43:43', NULL),
(4422579, 1, 2, NULL, 1, 0, '62753469a1cfb.jpg', 'personal use', 'send through email address', '', '2022-05-06 22:44:57', NULL),
(4616518, 1, 44, NULL, 4, 0, '1', 'personal use', 'send through courier', '', '2022-05-05 16:46:51', NULL),
(4916019, 1, 44, NULL, 4, 0, '1', 'personal use', 'send through email address', '', '2022-05-05 16:49:01', NULL),
(11174914, 1, 44, NULL, 4, 0, '1', 'transfer of school', 'send through email address', '', '2022-05-05 17:11:49', NULL),
(14174615, 1, 44, NULL, 4, 0, '1', 'personal use', 'send through email address', '', '2022-05-05 17:14:46', NULL),
(16172316, 1, 44, NULL, 1, 0, '0', 'personal use', 'send through email address', '', '2022-05-05 17:16:23', NULL),
(34171917, 1, 44, NULL, 4, 0, '1', 'personal use', 'send through email address', '', '2022-05-05 17:34:19', NULL),
(38172718, 1, 44, NULL, 4, 0, '1', 'personal use', 'send through email address', '', '2022-05-05 17:38:27', NULL),
(42174019, 1, 44, NULL, 4, 0, '1', 'personal use', 'send through email address', '', '2022-05-05 17:42:40', NULL),
(46220710, 1, 3, NULL, 4, 0, '1', 'advance studies', 'send through email address', '', '2022-05-06 22:46:07', NULL),
(48221611, 1, 3, NULL, 4, 0, '1', 'transfer of school', 'send through email address', '', '2022-05-06 22:48:16', NULL),
(49222112, 1, 3, NULL, 4, 0, '1', 'personal use', 'send through email address', '', '2022-05-06 22:49:21', NULL),
(50165110, 1, 44, NULL, 4, 0, '1', 'employment', 'send through email address', '', '2022-05-05 16:50:51', NULL),
(50222013, 1, 3, NULL, 4, 0, '1', 'transfer of school', 'send through email address', '', '2022-05-06 22:50:20', NULL),
(51224914, 1, 2, '', 0, 0, '627536054dc4b.jpg', 'transfer of school', 'send through email address', '', '2022-05-06 22:51:49', '2022-05-06 23:38:18'),
(52165411, 1, 44, NULL, 4, 0, '1', 'personal use', 'send through email address', '', '2022-05-05 16:52:54', NULL),
(53220415, 1, 1, NULL, 1, 0, '0', 'personal use', 'send through email address', '', '2022-05-06 22:53:04', NULL),
(54222816, 1, 1, NULL, 4, 0, '1', 'personal use', 'send through email address', '', '2022-05-06 22:54:28', NULL),
(55223917, 1, 1, NULL, 1, 0, '627536eb8916b.jpg', 'personal use', 'send through email address', '', '2022-05-06 22:55:39', NULL),
(56163812, 1, 44, NULL, 4, 0, '1', 'employment', 'send through email address', '', '2022-05-05 16:56:38', NULL),
(56223218, 1, 3, NULL, 4, 0, '1', 'personal use', 'send through email address', '', '2022-05-06 22:56:32', NULL),
(59161113, 1, 44, NULL, 4, 0, '1', 'transfer of school', 'claim at clsu main gate', '', '2022-05-05 16:59:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff_account_tbl`
--

CREATE TABLE `staff_account_tbl` (
  `staff_id` varchar(11) NOT NULL,
  `staff_fname` varchar(100) NOT NULL,
  `staff_mname` varchar(100) DEFAULT NULL,
  `staff_lname` varchar(100) NOT NULL,
  `staff_email` text NOT NULL,
  `staff_username` text NOT NULL,
  `staff_password` text NOT NULL,
  `staff_type` int(1) NOT NULL,
  `account_status` int(1) NOT NULL DEFAULT 1,
  `last_logged` datetime NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff_account_tbl`
--

INSERT INTO `staff_account_tbl` (`staff_id`, `staff_fname`, `staff_mname`, `staff_lname`, `staff_email`, `staff_username`, `staff_password`, `staff_type`, `account_status`, `last_logged`, `date_created`) VALUES
('12251241241', 'daisy may', '', 'julian', '617e7445289521ec34efbc2f026a8e5db6ab47186119709157c65f423254996ac218afa9fe5ba0f9cd889146762c4f5d1055e79df7e009aee78799647979ef94QBF1hSVL4Wj+h5HV6NiL3c18BXufu2qUsXFFhg8DwynaMyWeBulluGzWQXP+gZGP', '04328723d312e6153b95e1303467a57d446ed187ee538ba96901b2222d25a02382fc359ceb0f52bb34525e2a392edcac51a1e8de2e535487da99e70cca8d5380VuI+IZjHLX4xGgTDKZgjzuA64X7VDrCxiabSpwGTkKk=', '70ed2c8a9e63bc21ea9ea04464782298804bdc41781e62c42d014c06bd5a020562b3ec1ae78365661519a297571d9964a4a83f8c2dfa1d29fd8d5caf72401230xTmiuS0xObVMjSNb58lNOxJDe4OP2mnLyJnLMcJ9lZw=', 1, 1, '0000-00-00 00:00:00', '2022-04-19 17:25:22'),
('21321321321', 'annabel', '', 'saturno', '8ea3815a5b4a65b8ac110636eea5cdee5161909406a5bf9a132699023fc4b077d511199a20c3c70147046a83552c40d17c9b16aa77e968e90df3aedc514bee49BnRajzDLaW7l/t7S7NoAXhk5YSFMIfb8iR/7UD7+B/KqZHhb3gU+kqCJd11egxtU', '0e678425f65c251b50a0008ce5ea9f5943c2566567d568c8a0a3b13fda9bdeb60898922d1bdfc845ce524c8f7f366f49becd5d26b3a8d05905349517919bba50efrPELZEG9UUXk/7USAdKYJuyl7Yw4vdY6w1ZdwcL58=', 'a15ee4dbb1f408b1c3ee820ac65dccb34c9e45a532e9f8b13f6b2526d880829d5c2cdd1412693e41c5d2296e212cc2dc591c5a849ed53f12fa52ecacd34d1403L87nQRRVMoGP3j5EdkGtQbh2Zhb3oQ7xGXvEKu2t2hY=', 1, 1, '0000-00-00 00:00:00', '2022-04-19 17:23:50'),
('25122132132', 'melrose', '', 'irag', '393d13c14cf66e0210fbc858e562a1ac7c5191bbebe0645cc573d58c84dab13346e18ed90d818e6cce7335af37b6a8737ffe70fbc520ecc1460ee98afdad10c9yhig4qq+eUqDb4sFV4hyek4QYKCThznrOhx+y1JwINo38hPKmUfq2YHzHXgEQ6n9', '1dab9bd1cef03dee9ee95533199d7a5ad5232452dd193c0e0a02809ad8e8ca2b249efb659dcac5bb76c9882867957443175d2ec4ea93441b6bf7d1a9a64040b8nTyaIkcTITKS+LRqTV9sTs1oEFxuJXDnTNL0xdPmeLU=', 'b6cdebe6c8a518178d1604b42fb1caccc9f29570d5d8c860fb9abb921ad5e127bd0f52092be4f4d0198a779d4de041f46b027fb54dd073ec6cf394c31c823081HFsfESEtFG+aFNNLPqXmkrV4mBMcAVDlm913rK5jYkg=', 2, 1, '0000-00-00 00:00:00', '2022-04-19 17:43:17'),
('32623123412', 'kristine aira', '', 'asencio', '0f93879d40dfa84bd2bab788d4dd494364ab5438d986650ea37a79f27ad1a5d17addf5d6f17393a93353ee818a4b1521e79f9f1cbf43f3311018122e1820ef2dva9Kt/oj+gvb42vka2HJqpgWRbL0mQghrBg48Li+6/+9g+3eqQRUiBys1ljhfNIj', 'e41e439837b64a2bae3e847e56c57e854864fb017a3a4aa28320d4eb75fb93aa9b48acd374169d5da6b5aff1100153cce39160945641b75f98b8564c72232611vSOffHoyk+8d49h4Ss25sT8u+KAwtNFmfiPTh3kFkMRLu/kKcIzd5IiLRDSijrtJ', '60893a724a2652347f69f7a3635b38e9fa059b7855e9e4327396ea3d946428cd3bd43ebc86c09c5da7d9ebb6be72481fcb7579975b69ee8df7c5f4a56326d6b8lUNCQiLr3Tm2yORGDuYkkr4s9KBSsj0KnYcU/p6WBow=', 1, 1, '0000-00-00 00:00:00', '2022-04-19 17:24:41'),
('35464532343', 'reginald', '', 'thomas', 'a153c5a80593a1deb5b0371ee423bf9688dc2a6c3c48a50c43648186c60280305a52ec08391cb666fd14b6af3f0ea2a67779e9ed88dc31cb1c81499b20c97745zuXnF3uz1y3soaC0pXUfsEanK9SeYqkr7kFD4URdzP3LPvrPJKZzpPzHB9E3gCma', '57a784a74b25a8bee63e12ea9f871c74f8b7e7acef8acf878cda728dfe5e5c02213d50826568c0b7b5addafd106264180b7244ae4797bc5ba77dca6f4b75f0f27zUV0U9VDfCyqgV117GGYmw9hNplf3OoFFivKUwqNZ4=', 'e32ae0bc851335d90ef79e184e453feec6b0a864feed47a736d42073e1ca700a53b2a58a81169f80d9f2fb7cf42f2b31d6b100674dde84092ac697884aed253e7+Ja13kbpuLp/Silvs5UVcnsagMTywZjKhck7AfsMhE=', 1, 1, '0000-00-00 00:00:00', '2022-04-19 17:16:54'),
('41232132131', 'steven', '', 'apolonio', 'd6868dfade7242ac883163b85cf286dd30a5e7aa62c5b07f02e7b3e71b6b29e949cd6083747a4229b6111ff95f32c0bf719e5fea8aea9e384934ec936252e15eh/8gghfmjmsNWwYC4uHa/BPaGJRZXVCzgrUCN4obq0iSv5ASNtqRX36bFezr8WCK', '5ef64659eac4f3dbde00bf1f0f56a37fbdf601cf40414539864e962c29e0bf9fb2df1f6a1f6c9866ea1365988648bb91cab8cbbaec9232c056bf170fd958e54cPyT+b6jcMlw2IoPBfursw81QhrTy6ifGZa/KLBiNM4Q=', 'b0c725f1bcdd95e0e07e7a3d57a8a415052256bd48fad5c13f5e098a68f1a30be38524ec174746a2205089aff9e5a054ccb27c5ce3340e212c5ee70e6eaff3e5RUcrz4ghdZ0EcNR7oTO1KodH51FBCiuKf/74PM/4tI4=', 2, 1, '0000-00-00 00:00:00', '2022-04-19 17:45:04'),
('43534543534', 'filipina', '', 'gatchalian', '0d8ee916ffb0e43161e59fdb62dc01383ea0853481d418c1b06805ddd19d057a580bbb5584db7b28ab42439686ba6e4dda72973dd030da17ab8311b104cca26c+TUP3fE3qATnqDvqCCfKtDPpwr5BGg7NtYaa/obfSdXJyeGF78E+XrAlST4KD9U0', '9535e8fddf3622f470e6e1756ad06bd4326299559737705035ccc2660c85e99f80545e03003328b171bd07dfcd38cdb82a47ad08ddf4b83f084d844bd8e7ee402XsiDlqxWRaiBj2WPlC6D/zJNovi5RsKxbCxqRSvHvQFuE2+odbaQHjPxxqt1CJX', '3c414ffa10b752334da7bc9342f990d12bd114eb21f1a6ac0eb05d86537b4d857d04fc80cdd6be1ae5ddad1b53c3315a49e76e27c73b09222b34b2d43183b294qru3+IzV7zL709VgXoe4oCCmlrujKNWDu8PLvJ2NOY4=', 1, 1, '0000-00-00 00:00:00', '2022-04-19 17:49:23'),
('46353453543', 'wilner', '', 'garcia', '362ed1f40e3441a47e6d124298c18908079b8dc3c6be0f0e58d12ee70571304df587a3ebf2239d1b617425f1e73681949ba465c91aeb6862c2fcbdcf55d126c44+f1nKGv3EQ0SIWdAs25nWh8ztSZIF2zzE3ft2zh3//TB9vu+V6KhO9d80zKOoH/', '25d6015478424e8b109673aa1e49c0d700b0e5c9b3d914bdf4cdebcbd5fd9cb10b4cc5690a674a4d20e4d6d2f15605f4b59e162b0f95affcc1613352cd964011ATuXX0cglur2mOeRjst2IRYcYvUd0zeyGoSvFBm2z+k=', '3d60ade53d2d400adbbf8c598f58bdeac48013a1e75e0d20c0fa54180b2ba5a3ecd07bc8cddd418168522a3af82394669aa7e7d35bd28d0119633bb34c29b852Eu3Visl9D3FUF7u6DKz4RnX/cCdCqsr7DZ1/qNC5dSQ=', 1, 1, '0000-00-00 00:00:00', '2022-04-19 17:26:00'),
('52326343242', 'lorie', '', 'angeles', '03d535b18ce47788b3a0acc1b0352527c4f0398cccdc7acb3afaf915a03d66f7a095aec69cf6f57342016f7fcd7ddded1db90a65ba56dd33f0de59198a36f332GtCxmCQ6uiImvOqRNjvcCxojWQXevQCbtqbZvBN5OhsHz7V1cvtslKxJ+9VOG99K', '0b3b2a02d7944c156bef97af9851e84b7c6d78bd4ffb05dd06fe2cf4611381ebb67b079d59140294a84788e5692cbb7a35642520abbf0c122891e8c0609df388SRwVFmfMm4HBUQcUXXzTDmDF+9JhB4cSf2/KuUuvaHM=', 'b527f1914c46f53d4f06e36a7687334b81f53eacd59d876e0865bcc97c2eb93378e5227f97b5ed57f67abfef304528606bf8787ad3f4da556e30c493871e40bczXriSOK8Ki4DZMx/6kizJEVzC7RlskJuHvil1ZerFAs=', 1, 1, '0000-00-00 00:00:00', '2022-04-19 17:14:22'),
('53532421334', 'alona', '', 'dela cruz', '442d5679881ed35325e4c0f065bab05c0613daafae07b616189fd98f463550df14019b994a2429426d62cd95bd2bf7531b4dc731ec0d0a66f4dabe398af662b1wH3nLP4rJUXTphu0FC5xmp7hIYuJgWEUq4EhoSZqECQP1kynJArs5dp90z2JEa09', 'cf35d18bc61cdb2b751100fb0112659e81f564d710825827e131ebdb986f6f6d715c3adbb3a28c12e245492f260370d4421a76a09a9ffe666078786a12062ad5qFWG9jmNdT7SGu4o0njpwqSp6tm9fiF7JYuoRngbxJQ=', '75af39ea080804f926cfd3fb97b37910b9d4666f15582f31c559810ee814a8e48c348a19d5705c74e3c98fdfe9f7d747bb4fda960a6404b65baa009aa856b4beO2qgFVmYajEyC1l3JRS/GpcrXMrKJMamlN3HVhp061I=', 1, 1, '0000-00-00 00:00:00', '2022-04-19 17:23:02'),
('55351231251', 'merry grace', '', 'nunez', '70b10e5558c77f915dc774d75e92196d39de179ccd13a014941ed6d8c9b965d3fcc35f0fe7c33b935642d845ad5e6856119f5d4801233e9041b2b582ff9cd879VnJP96bg8dibrUiP9zVouifC/WTwmeoX3y4dx2q+rn2iqTHpHerlGrG+sRKAjZwe', '3caf25545040ee7837083188d91d7ab6e7a930f63016386a05128652c279624fdf2f8cc0b1beef68cfbd864884deaf623ef990a1704a1f0ce885adbd0dc2c114yuVmgz/kU8zNDep5cMwfimak55kbpO1W1r5Fuwqn8JU=', 'a0b5708cb349119a6ecc4c8cd8f513ccb42d0a5386125a8403bbea331f2cea9c1b6090434d994d992d0b1c4bb854e3c4c918ed0102167153c93f4852f4170a34asTpr/FW9LNfNOpVrWVySY+dzv5H9aqmMj3620Jh3yY=', 1, 1, '0000-00-00 00:00:00', '2022-04-19 17:16:16'),
('63423432432', 'elaine', '', 'libunao', '50ccef5f0c45cdb7da8efda893486cf0cba2cdc17d4c4001b3224bb754977ae0e1df4f4b3b6bcade5ebe48d52ff3fcf705b7f493e3f1180082acabcb4e07093dhae9i1rBPpn1w5l8q0PXhkIW28//krqKn6dwBfcN63u+0aWcx7FRITEc4u/h+OwF', 'b4b24c3ca4a3ad4feab299e599a8332d1652bf74aa26ea5336f412fc1e48baf40fc722bb25eff542c0cb01177dec6aebfe9768372306232e7903d6e074ab717eph2A741Zdbv5/Un5nHEYg08ZrgP67I4OLVd+pbCJ+8g=', '04786a870d83ed2a41874c7e417da941ff6e2c340942d6582b0ddee7d423f9c5c4b331ce8e1509cabb96b375e79679a4ebde7940377a592b68421f1d1a49db87yx6OzxeBblzsmpqFRwWOaBUZUUHHdijsTkvrJbywG5g=', 2, 1, '0000-00-00 00:00:00', '2022-04-19 17:46:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_account_tbl`
--
ALTER TABLE `admin_account_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_handler_tbl`
--
ALTER TABLE `course_handler_tbl`
  ADD PRIMARY KEY (`course_handler_id`);

--
-- Indexes for table `document_request_tbl`
--
ALTER TABLE `document_request_tbl`
  ADD PRIMARY KEY (`document_id`);

--
-- Indexes for table `draft_note_tbl`
--
ALTER TABLE `draft_note_tbl`
  ADD PRIMARY KEY (`draft_msg_note_id`);

--
-- Indexes for table `feedback_tbl`
--
ALTER TABLE `feedback_tbl`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `maintenance_tbl`
--
ALTER TABLE `maintenance_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requestor_info_tbl`
--
ALTER TABLE `requestor_info_tbl`
  ADD PRIMARY KEY (`info_id`);

--
-- Indexes for table `request_log`
--
ALTER TABLE `request_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_tbl`
--
ALTER TABLE `request_tbl`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `staff_account_tbl`
--
ALTER TABLE `staff_account_tbl`
  ADD PRIMARY KEY (`staff_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_account_tbl`
--
ALTER TABLE `admin_account_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course_handler_tbl`
--
ALTER TABLE `course_handler_tbl`
  MODIFY `course_handler_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `document_request_tbl`
--
ALTER TABLE `document_request_tbl`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `draft_note_tbl`
--
ALTER TABLE `draft_note_tbl`
  MODIFY `draft_msg_note_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback_tbl`
--
ALTER TABLE `feedback_tbl`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `maintenance_tbl`
--
ALTER TABLE `maintenance_tbl`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `requestor_info_tbl`
--
ALTER TABLE `requestor_info_tbl`
  MODIFY `info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `request_log`
--
ALTER TABLE `request_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `request_tbl`
--
ALTER TABLE `request_tbl`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59161114;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
