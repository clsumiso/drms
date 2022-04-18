-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2022 at 02:01 PM
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
('lo4mv3jdm493preiqp1vvijnf6c0gshg', '127.0.0.1', 1650224244, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635303232343234343b),
('46nijegq6iu0l0gd5ubeh26d4l3f9ah0', '127.0.0.1', 1650224474, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635303232343437343b),
('psl3es62g1vhr3ui3kvjda59d159vv6p', '::1', 1650228008, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635303232373636353b);

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

-- --------------------------------------------------------

--
-- Table structure for table `staff_account_tbl`
--

CREATE TABLE `staff_account_tbl` (
  `staff_id` varchar(11) NOT NULL,
  `staff_fname` varchar(100) NOT NULL,
  `staff_mname` varchar(100) NOT NULL,
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
('21512213213', 'darwin', 'bulgado', 'labiste', '3cc948d966353be15a7b1d3b32df02a0bdea7a0df7c23e3c0f65b536997c9eaa5a69907f109c1a08539779892b4d345b1c214ecadd2c79544a5ba1b079c28b99WoxjMlLHeQSyb7vBd1gO1+5wUYbslBtX7+au40r/FXjFfd2KdErP6GvBDssRqWTh', '5f339c989901538c11e9a21592b91ce88633faad8946a9eb7a23c303f952f52f99ef992bc29ca3527d5b66eba9d0704776f86437e84b174e3c42ae4c38199c3bsPfZl7aisn9q5OMAy/6elD1JeB+MaVbQfthAuzIXFmE=', 'a2f55305c734b94bb1176884cf91abbd52e96e878cc0ec34b799cb6a766892386c2581d65fcddced3f9af00614035bc7343204ba9f468f3b73362246c3e9e900dm2Cs/Jds29WUX3HsIbaP25mFZlitGTC7qjGwkmM7GQ=', 1, 1, '2022-04-18 01:06:12', '2022-04-16 00:02:55');

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
  MODIFY `course_handler_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `document_request_tbl`
--
ALTER TABLE `document_request_tbl`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `draft_note_tbl`
--
ALTER TABLE `draft_note_tbl`
  MODIFY `draft_msg_note_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback_tbl`
--
ALTER TABLE `feedback_tbl`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `maintenance_tbl`
--
ALTER TABLE `maintenance_tbl`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `requestor_info_tbl`
--
ALTER TABLE `requestor_info_tbl`
  MODIFY `info_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request_tbl`
--
ALTER TABLE `request_tbl`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
