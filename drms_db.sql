-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2022 at 09:03 AM
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
-- Database: `drms_db`
--

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
('il4s7rmjlaa90jr7rq44qnkh7rc34nne', '::1', 1645776155, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634353737353933333b757365727c693a313b);

-- --------------------------------------------------------

--
-- Table structure for table `college_tbl`
--

CREATE TABLE `college_tbl` (
  `college_id` int(11) NOT NULL,
  `college_name` varchar(255) NOT NULL,
  `college_acronym` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `college_tbl`
--

INSERT INTO `college_tbl` (`college_id`, `college_name`, `college_acronym`) VALUES
(1, 'college of agriculture', 'cag'),
(2, 'college of arts and social sciences', 'cass'),
(3, 'college of science', 'cs'),
(4, 'college of business administration and accountancy', 'cbaa'),
(5, 'college of education', 'ced'),
(6, 'college of engineering', 'cen'),
(7, 'college of fisheries', 'cf'),
(8, 'college of science and industry', 'cshi'),
(9, 'college of veterinary science and medicine', 'cvsm');

-- --------------------------------------------------------

--
-- Table structure for table `course_handler_tbl`
--

CREATE TABLE `course_handler_tbl` (
  `course_handler_id` int(11) NOT NULL,
  `staff_id_ric` int(11) NOT NULL DEFAULT 0,
  `staff_id_frontline` int(11) NOT NULL DEFAULT 0,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_handler_tbl`
--

INSERT INTO `course_handler_tbl` (`course_handler_id`, `staff_id_ric`, `staff_id_frontline`, `course_id`) VALUES
(1, 1, 4, 1),
(2, 1, 4, 2),
(3, 1, 4, 3),
(4, 1, 4, 4),
(5, 1, 4, 5),
(6, 1, 4, 6),
(7, 1, 4, 7),
(8, 1, 4, 8),
(9, 1, 4, 9),
(10, 1, 4, 10),
(11, 1, 4, 11),
(12, 1, 4, 12),
(13, 2, 4, 13),
(14, 2, 4, 14),
(15, 2, 4, 15),
(16, 2, 4, 16),
(17, 2, 4, 17),
(18, 2, 4, 18),
(19, 2, 4, 19),
(20, 2, 4, 20),
(21, 2, 4, 21),
(22, 2, 4, 22),
(23, 3, 4, 23),
(24, 3, 4, 24),
(25, 3, 4, 25),
(26, 3, 4, 26),
(27, 3, 4, 27),
(28, 3, 4, 28),
(29, 3, 4, 29),
(30, 3, 4, 30),
(31, 3, 4, 31),
(32, 3, 4, 32);

-- --------------------------------------------------------

--
-- Table structure for table `course_tbl`
--

CREATE TABLE `course_tbl` (
  `course_id` int(11) NOT NULL,
  `college_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_acronym` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_tbl`
--

INSERT INTO `course_tbl` (`course_id`, `college_id`, `course_name`, `course_acronym`) VALUES
(1, 1, 'bachelor of science in agribusiness', 'bsab'),
(2, 1, 'bachelor of science in agriculture', 'bsa'),
(3, 2, 'bachelor of arts in filipino', 'bafil'),
(4, 2, 'bachelor of arts in literature', 'bslit'),
(5, 2, 'bachelor of arts in social sciences', 'bass'),
(6, 2, 'bachelor of science in development communication', 'bsdc'),
(7, 2, 'bachelor of science in psychology', 'bspysch'),
(8, 3, 'bachelor of science in biology', 'bsbio'),
(9, 3, 'bachelor of science in chemistry', 'bschem'),
(10, 3, 'bachelor of science in environment science', 'bses'),
(11, 3, 'bachelor of mathematics', 'bsmath'),
(12, 3, 'bachelor of science in statistics', 'bsstat'),
(13, 4, 'bachelor of science in accountancy', 'bsac'),
(14, 4, 'bachelor of science in business administration', 'bsba'),
(15, 4, 'bachelor of science in entrepreneurship', 'bsentrep'),
(16, 4, 'bachelor of science in management accounting', 'bsma'),
(17, 5, 'bachelor of culture and arts education', 'bcaed'),
(18, 5, 'bachelor of early childhood education', 'beced'),
(19, 5, 'bachelor of elementary education', 'beed'),
(20, 5, 'bachelor of physical education', 'bped'),
(21, 5, 'bachelor of secondary education', 'bsed'),
(22, 5, 'bachelor of technology and livelihood education', 'btled'),
(23, 6, 'bachelor of science in agricultural and bio system engineering', 'bsabe'),
(24, 6, 'bachelor of science in civil engineering', 'bsce'),
(25, 6, 'bachelor of science in information technology', 'bsit'),
(26, 6, 'bachelor of science in meteorology', 'bsmet'),
(27, 7, 'bachelor of science in fisheries', 'bsf'),
(28, 8, 'bachelor of science in food technology', 'bsft'),
(29, 8, 'bachelor of science fashion and textile technology', 'bsfft'),
(30, 8, 'bachelor of science in hospitality management', 'bshm'),
(31, 8, 'bachelor of science tourism management', 'bstm'),
(32, 9, 'doctor of veterinary medicine', 'dvm');

-- --------------------------------------------------------

--
-- Table structure for table `document_request_tbl`
--

CREATE TABLE `document_request_tbl` (
  `document_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `document_type` int(11) NOT NULL,
  `document_copies` int(1) NOT NULL,
  `document_pages` int(1) NOT NULL,
  `document_upload` varchar(255) DEFAULT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `draft_note_tbl`
--

CREATE TABLE `draft_note_tbl` (
  `draft_msg_note_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `feedback_tbl`
--

CREATE TABLE `feedback_tbl` (
  `feedback_id` int(11) NOT NULL,
  `student_type` int(1) NOT NULL,
  `user_friendly` int(1) NOT NULL,
  `informative` int(1) NOT NULL,
  `suggestion` text DEFAULT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback_tbl`
--

INSERT INTO `feedback_tbl` (`feedback_id`, `student_type`, `user_friendly`, `informative`, `suggestion`, `date_created`) VALUES
(1, 1, 5, 5, 'nays wan', '2022-02-25 16:00:37');

-- --------------------------------------------------------

--
-- Table structure for table `requestor_info_tbl`
--

CREATE TABLE `requestor_info_tbl` (
  `info_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `identity_file` varchar(255) NOT NULL,
  `student_no` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) NOT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `course_name` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `request_tbl`
--

CREATE TABLE `request_tbl` (
  `request_id` int(11) NOT NULL,
  `student_type` int(1) NOT NULL,
  `course_id` int(11) NOT NULL,
  `remarks` text DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `payment_file` varchar(255) DEFAULT NULL,
  `purpose` varchar(255) NOT NULL,
  `delivery_option` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `date_completed` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `staff_account_tbl`
--

CREATE TABLE `staff_account_tbl` (
  `staff_id` int(11) NOT NULL,
  `staff_fname` varchar(255) NOT NULL,
  `staff_mname` varchar(255) DEFAULT NULL,
  `staff_lname` varchar(255) NOT NULL,
  `staff_suffix` varchar(255) DEFAULT NULL,
  `staff_email` varchar(255) NOT NULL,
  `staff_username` varchar(255) NOT NULL,
  `staff_password` varchar(255) NOT NULL,
  `staff_type` int(1) NOT NULL,
  `account_status` int(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff_account_tbl`
--

INSERT INTO `staff_account_tbl` (`staff_id`, `staff_fname`, `staff_mname`, `staff_lname`, `staff_suffix`, `staff_email`, `staff_username`, `staff_password`, `staff_type`, `account_status`, `date_created`) VALUES
(1, 'darwin', 'bulgado', 'labiste', '', 'labiste.darwin@clsu2.edu.ph', 'labiste.darwin', 'Lolalolay0810', 1, 1, '2022-02-03 19:21:57'),
(2, 'phoebe joy', 'laugo', 'peneyra', '', 'peneyra.phoebe@clsu2.edu.ph', 'peneyra.phoebe', 'Peneyra123!', 1, 1, '2022-02-03 19:22:03'),
(3, 'christine dee', 'villanueva', 'sarmiento', '', 'sarmiento.christine@clsu2.edu.ph', 'sarmiento.christine', 'Sarmiento123!', 1, 1, '2022-02-03 19:22:05'),
(4, 'angel ann', 'tabale', 'ramos', '', 'ramos.angel@clsu2.edu.ph', 'ramos.angel', 'Ramos123!', 2, 1, '2022-02-03 19:22:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `college_tbl`
--
ALTER TABLE `college_tbl`
  ADD PRIMARY KEY (`college_id`);

--
-- Indexes for table `course_handler_tbl`
--
ALTER TABLE `course_handler_tbl`
  ADD PRIMARY KEY (`course_handler_id`);

--
-- Indexes for table `course_tbl`
--
ALTER TABLE `course_tbl`
  ADD PRIMARY KEY (`course_id`);

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
-- AUTO_INCREMENT for table `college_tbl`
--
ALTER TABLE `college_tbl`
  MODIFY `college_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `course_handler_tbl`
--
ALTER TABLE `course_handler_tbl`
  MODIFY `course_handler_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `course_tbl`
--
ALTER TABLE `course_tbl`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `document_request_tbl`
--
ALTER TABLE `document_request_tbl`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `draft_note_tbl`
--
ALTER TABLE `draft_note_tbl`
  MODIFY `draft_msg_note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `feedback_tbl`
--
ALTER TABLE `feedback_tbl`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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

--
-- AUTO_INCREMENT for table `staff_account_tbl`
--
ALTER TABLE `staff_account_tbl`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
