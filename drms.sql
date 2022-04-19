-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2022 at 12:08 PM
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
('pfv5juhiflvre2nlv5hkfvjrlnps8r9h', '::1', 1650346692, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635303334363037373b),
('0991frfi55hqaeaaq32bobk0qba12ag6', '::1', 1650362857, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635303336323634383b61646d696e5f49447c733a313a2231223b5549447c733a31313a223335343634353332333433223b73746166665f747970657c733a313a2231223b);

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
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;

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
