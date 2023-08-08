-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2023 at 11:36 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `worldtrd`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_payment`
--

CREATE TABLE `bank_payment` (
  `bank_id` int(11) NOT NULL,
  `bank_name` varchar(200) NOT NULL,
  `account_title` varchar(100) NOT NULL,
  `account_number` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 = unactive , 1 = active',
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bank_payment`
--

INSERT INTO `bank_payment` (`bank_id`, `bank_name`, `account_title`, `account_number`, `status`, `date`) VALUES
(1, 'FISAL BANK', 'MUHAMMAD NAVEED', '3615301000000464', 1, '2023-05-05'),
(2, 'USDT TRC 20', 'Muhammad Bilal', 'TDLtQvgHdcTvxntCKGahPjNeg1uCsWCvdv', 1, '2023-05-05');

-- --------------------------------------------------------

--
-- Table structure for table `comission`
--

CREATE TABLE `comission` (
  `comissionid` int(11) NOT NULL,
  `invest_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `from_user` int(11) NOT NULL,
  `amount` float NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comission`
--

INSERT INTO `comission` (`comissionid`, `invest_id`, `user_id`, `from_user`, `amount`, `date`, `status`) VALUES
(1, 12, 10, 10, 7, '2023-05-16 12:19:44', 1),
(2, 12, 10, 10, 5, '2023-05-16 12:19:44', 1),
(3, 12, 10, 10, 3, '2023-05-16 12:19:44', 1),
(4, 12, 10, 10, 2, '2023-05-16 12:19:44', 1),
(9, 14, 7, 17, 7, '2023-05-16 12:41:44', 1),
(10, 14, 3, 17, 5, '2023-05-16 12:41:44', 1),
(11, 14, 2, 17, 3, '2023-05-16 12:41:44', 1),
(12, 14, 1, 17, 2, '2023-05-16 12:41:44', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE `deposit` (
  `deposit_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `transaction_file` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deposit`
--

INSERT INTO `deposit` (`deposit_id`, `user_id`, `bank_id`, `transaction_file`) VALUES
(2, 2, NULL, 'AIA0kUE6_access.PNG'),
(3, 2, NULL, 'OVwJ84Ca_aievari (1).jpg'),
(4, 3, NULL, 'bvRQJGi9_aievari.jpg'),
(5, 2, NULL, 'gXE7ClZG_access.PNG'),
(6, 6, NULL, '7IaXBwXK_usdt.png'),
(7, 10, NULL, 'sldjflksd.jpg'),
(8, 17, NULL, 'sflsakljfkl.jpg\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `dollar_charges`
--

CREATE TABLE `dollar_charges` (
  `dollar_charge_id` int(11) NOT NULL,
  `dollar_charge_amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dollar_charges`
--

INSERT INTO `dollar_charges` (`dollar_charge_id`, `dollar_charge_amount`) VALUES
(1, 300);

-- --------------------------------------------------------

--
-- Table structure for table `invest`
--

CREATE TABLE `invest` (
  `invest_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `end_date` datetime DEFAULT NULL,
  `amount` float NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invest`
--

INSERT INTO `invest` (`invest_id`, `plan_id`, `user_id`, `date`, `end_date`, `amount`, `status`) VALUES
(4, 1, 2, '2023-05-13 20:00:00', '2023-06-12 12:08:27', 50, 1),
(5, 3, 2, '2023-05-13 12:08:36', NULL, 70, 1),
(6, 1, 3, '2023-05-12 12:11:49', NULL, 20, 1),
(7, 1, 3, '2023-05-12 12:11:55', NULL, 30, 1),
(8, 1, 3, '2023-05-11 01:06:30', '2023-06-11 13:54:30', 10, 1),
(9, 1, 6, '2023-05-13 03:40:00', '2023-06-12 03:40:00', 50, 1),
(10, 1, 6, '2023-05-13 03:53:44', '2023-06-12 03:53:44', 10, 1),
(11, 1, 6, '2023-04-11 03:53:57', '2023-05-11 03:53:57', 20, 1),
(12, 3, 10, '2023-05-16 12:19:44', '2023-06-15 12:19:44', 100, 1),
(14, 3, 17, '2023-05-16 12:41:44', '2023-06-15 12:41:44', 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification_table`
--

CREATE TABLE `notification_table` (
  `notification_id` int(11) NOT NULL,
  `notification_title` varchar(260) NOT NULL,
  `notification_desc` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification_table`
--

INSERT INTO `notification_table` (`notification_id`, `notification_title`, `notification_desc`, `status`, `date`) VALUES
(4, 'My nofviation', 'Today is the Good day for new investors so carry on Have a Nice day Naveed ', 1, '2023-05-30');

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE `plan` (
  `plan_id` int(11) NOT NULL,
  `plan_title` varchar(100) NOT NULL,
  `minimum_amount` float NOT NULL,
  `maximum_amount` float NOT NULL,
  `duration_number` int(11) NOT NULL,
  `duration_type` tinyint(1) NOT NULL COMMENT '0 = day  , 1  = month',
  `daily_profit_percentage` float NOT NULL,
  `return_amount` tinyint(1) DEFAULT NULL,
  `profit_daily` tinyint(1) NOT NULL COMMENT '0 = no , 1 = yes',
  `cat_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0 = unactive , 1 = active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`plan_id`, `plan_title`, `minimum_amount`, `maximum_amount`, `duration_number`, `duration_type`, `daily_profit_percentage`, `return_amount`, `profit_daily`, `cat_id`, `status`) VALUES
(1, 'Emergency Plan', 10, 50, 30, 0, 1.3, 1, 1, 3, 1),
(3, 'Hmara plan', 70, 120, 30, 0, 0.3, 0, 1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `plan_category`
--

CREATE TABLE `plan_category` (
  `cat_id` int(11) NOT NULL,
  `category_title` varchar(100) NOT NULL,
  `category_img` varchar(300) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0 = un active , 1 = active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plan_category`
--

INSERT INTO `plan_category` (`cat_id`, `category_title`, `category_img`, `status`) VALUES
(2, 'Silver', 'VxSbUl9l_B ! IG.png', 1),
(3, 'Gold', 'UajSxY15_B 1 (1).png', 1),
(4, 'Bronze', 'byWuRvAs_cooding.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `profite`
--

CREATE TABLE `profite` (
  `profite_id` int(11) NOT NULL,
  `invest_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profite`
--

INSERT INTO `profite` (`profite_id`, `invest_id`, `user_id`, `amount`, `date`, `status`) VALUES
(1, 8, 3, 0.13, '2023-05-12 01:00:00', 1),
(3, 8, 3, 0.13, '2023-05-14 03:39:53', 1),
(4, 8, 3, 0.13, '2023-05-14 03:40:13', 1),
(5, 9, 6, 0.65, '2023-05-14 03:40:13', 1),
(6, 8, 3, 0.13, '2023-05-14 03:40:45', 1),
(7, 9, 6, 0.65, '2023-05-14 03:40:46', 1),
(8, 8, 3, 0.13, '2023-05-14 03:40:48', 1),
(9, 9, 6, 0.65, '2023-05-14 03:40:48', 1),
(10, 4, 2, 0.65, '2023-05-15 11:53:25', 1),
(11, 8, 3, 0.13, '2023-05-15 11:53:25', 1),
(12, 9, 6, 0.65, '2023-05-15 11:53:25', 1),
(13, 10, 6, 0.13, '2023-05-15 11:53:25', 1),
(14, 4, 2, 0.65, '2023-05-16 01:57:55', 1),
(15, 8, 3, 0.13, '2023-05-16 01:57:55', 1),
(16, 9, 6, 0.65, '2023-05-16 01:57:55', 1),
(17, 10, 6, 0.13, '2023-05-16 01:57:55', 1),
(18, 4, 2, 0.65, '2023-05-17 02:43:52', 1),
(19, 8, 3, 0.13, '2023-05-17 02:43:52', 1),
(20, 9, 6, 0.65, '2023-05-17 02:43:52', 1),
(21, 10, 6, 0.13, '2023-05-17 02:43:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `teamcomission`
--

CREATE TABLE `teamcomission` (
  `comissionid` int(11) NOT NULL,
  `level` tinyint(1) NOT NULL,
  `comission_per` float NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teamcomission`
--

INSERT INTO `teamcomission` (`comissionid`, `level`, `comission_per`, `status`) VALUES
(1, 1, 7, 1),
(2, 2, 5, 1),
(3, 3, 3, 1),
(4, 4, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `ntransaction_id` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '0 = deposit , 1 = withdraw , 2 = invest,3 = profit , 4 = comission\r\n',
  `transaction_id` varchar(300) NOT NULL DEFAULT '0' COMMENT 'Transaction id connect with withdraw id , and deposit id , and invest id ',
  `user_id` int(11) DEFAULT NULL,
  `amount` float NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0 = pending , 1 = accepted , 2 = rejected',
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`ntransaction_id`, `type`, `transaction_id`, `user_id`, `amount`, `status`, `date`) VALUES
(1, 0, '1', 2, 150, 1, '2023-05-11 22:48:43'),
(4, 0, '2', 2, 200, 1, '2023-05-12 09:13:44'),
(5, 0, '3', 2, 100, 1, '2023-05-12 09:15:30'),
(7, 0, '4', 3, 100, 1, '2023-05-10 10:26:34'),
(8, 2, '4', 2, 50, 1, '2023-05-12 12:08:27'),
(9, 2, '5', 2, 50, 2, '2023-05-12 12:08:36'),
(10, 2, '6', 3, 100, 1, '2023-05-12 12:11:49'),
(11, 2, '7', 3, 30, 1, '2023-05-12 12:11:55'),
(12, 2, '8', 3, 10, 1, '2023-05-12 13:54:30'),
(13, 0, '5', 2, 50, 2, '2023-05-12 21:08:47'),
(14, 0, '6', 6, 100, 1, '2023-05-13 03:37:23'),
(15, 2, '9', 6, 50, 1, '2023-05-13 03:40:00'),
(16, 2, '10', 6, 10, 1, '2023-05-13 03:53:44'),
(17, 2, '11', 6, 20, 1, '2023-05-13 03:53:57'),
(18, 3, '1', 3, 0.13, 1, '2023-05-14 03:18:52'),
(20, 3, '3', 3, 0.13, 1, '2023-05-14 03:39:53'),
(21, 3, '4', 3, 0.13, 1, '2023-05-14 03:40:13'),
(22, 3, '5', 6, 0.65, 1, '2023-05-14 03:40:13'),
(23, 3, '6', 3, 0.13, 1, '2023-05-14 03:40:46'),
(24, 3, '7', 6, 0.65, 1, '2023-05-14 03:40:46'),
(25, 3, '8', 3, 0.13, 1, '2023-05-14 03:40:48'),
(26, 3, '9', 6, 0.65, 1, '2023-05-14 03:40:48'),
(27, 3, '10', 2, 0.65, 1, '2023-05-15 11:53:25'),
(28, 3, '11', 3, 0.13, 1, '2023-05-15 11:53:25'),
(29, 3, '12', 6, 0.65, 1, '2023-05-15 11:53:25'),
(30, 3, '13', 6, 0.13, 1, '2023-05-15 11:53:25'),
(31, 3, '14', 2, 0.65, 1, '2023-05-16 01:57:55'),
(32, 3, '15', 3, 0.13, 1, '2023-05-16 01:57:55'),
(33, 3, '16', 6, 0.65, 1, '2023-05-16 01:57:55'),
(35, 0, '7', 10, 100, 1, '2023-05-16 11:42:52'),
(36, 2, '12', 10, 100, 1, '2023-05-16 12:19:44'),
(37, 0, '8', 17, 200, 1, '2023-05-16 12:28:07'),
(43, 2, '14', 17, 100, 1, '2023-05-16 12:41:44'),
(44, 4, '9', 7, 7, 1, '2023-05-16 12:41:44'),
(45, 4, '10', 3, 5, 1, '2023-05-16 12:41:44'),
(46, 4, '11', 2, 3, 1, '2023-05-16 12:41:44'),
(47, 4, '12', 1, 2, 1, '2023-05-16 12:41:44'),
(48, 3, '18', 2, 0.65, 1, '2023-05-17 02:43:52'),
(49, 3, '19', 3, 0.13, 1, '2023-05-17 02:43:52'),
(50, 3, '20', 6, 0.65, 1, '2023-05-17 02:43:52'),
(51, 3, '21', 6, 0.13, 1, '2023-05-17 02:43:52');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_phone` varchar(15) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(250) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `parent_Level` int(11) NOT NULL,
  `role` tinyint(1) NOT NULL COMMENT '0 = user , 1 = manager , 2 = senoir manager , 3 admin , 4 super admin',
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `delstatus` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_phone`, `user_email`, `user_password`, `status`, `parent_id`, `parent_Level`, `role`, `date`, `delstatus`) VALUES
(1, 'Naveed', '03162859445', 'naveed@gmail.com', 'Naveed@admin', 1, 0, 0, 3, '2023-04-30 00:03:16', 0),
(2, 'muhammad Farhan', '0316-2859444', 'farhan@gmail.com', '123', 1, 1, 1, 0, '2023-05-05 02:43:54', 0),
(3, 'Anees raza', '0307-2505874', 'anees@gmail.com', '456', 1, 2, 2, 0, '2023-05-05 02:51:09', 0),
(6, 'ahmed', '0316-2859445', 'ahmed@gmail.com', '123', 1, 2, 2, 0, '2023-05-12 14:32:02', 0),
(7, 'aysha', '0316-2859445', 'ayesha@gmail.com', '123', 1, 3, 3, 0, '2023-05-12 14:32:19', 0),
(8, 'rehman', '0316-2859445', 'rehman@gmail.com', '123', 1, 3, 3, 0, '2023-05-12 14:32:35', 0),
(9, 'subhan', '0316-2859445', 'subhan@gmail.com', '123', 1, 2, 2, 0, '2023-05-12 14:32:48', 0),
(10, 'furqan ', '032124524', 'furqan@gmail.com', '123', 1, 6, 3, 0, '2023-05-15 10:35:44', 0),
(11, 'Ali', '03256595', 'ali@gmail.com', 'ali123', 1, 3, 3, 0, '2023-05-15 14:37:00', 0),
(12, 'Usman', '035896147', 'usman@gmail.com', 'usman@gmail.com', 1, 10, 4, 0, '2023-05-15 14:39:39', 0),
(13, 'Amir', '03658947', 'amir@gmail.com', 'amir123', 1, 11, 4, 0, '2023-05-15 14:40:52', 0),
(14, 'Hamza', '032556895', 'hamza@gmail.com', 'hamza123', 1, 13, 5, 0, '2023-05-15 14:42:55', 0),
(15, 'anus', '03589641', 'anus@gmail.com', 'anus123', 1, 13, 5, 0, '2023-05-15 14:44:45', 0),
(16, 'ubaid', '032569784', 'ubiad@gmail.com', '123', 1, 10, 4, 0, '2023-05-16 03:41:03', 0),
(17, 'kamran', '0322568478', 'kamran@gmail.com', '456', 1, 7, 4, 0, '2023-05-16 04:06:20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `withdraw`
--

CREATE TABLE `withdraw` (
  `withdraw_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `final_amount` float NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `account_title` varchar(100) NOT NULL,
  `account_number` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_charges`
--

CREATE TABLE `withdraw_charges` (
  `charges_id` int(11) NOT NULL,
  `charges` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `withdraw_charges`
--

INSERT INTO `withdraw_charges` (`charges_id`, `charges`) VALUES
(1, 56.2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_payment`
--
ALTER TABLE `bank_payment`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `comission`
--
ALTER TABLE `comission`
  ADD PRIMARY KEY (`comissionid`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`deposit_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `bank_id` (`bank_id`);

--
-- Indexes for table `dollar_charges`
--
ALTER TABLE `dollar_charges`
  ADD PRIMARY KEY (`dollar_charge_id`);

--
-- Indexes for table `invest`
--
ALTER TABLE `invest`
  ADD PRIMARY KEY (`invest_id`);

--
-- Indexes for table `notification_table`
--
ALTER TABLE `notification_table`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`plan_id`);

--
-- Indexes for table `plan_category`
--
ALTER TABLE `plan_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `profite`
--
ALTER TABLE `profite`
  ADD PRIMARY KEY (`profite_id`);

--
-- Indexes for table `teamcomission`
--
ALTER TABLE `teamcomission`
  ADD PRIMARY KEY (`comissionid`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`ntransaction_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `withdraw`
--
ALTER TABLE `withdraw`
  ADD PRIMARY KEY (`withdraw_id`);

--
-- Indexes for table `withdraw_charges`
--
ALTER TABLE `withdraw_charges`
  ADD PRIMARY KEY (`charges_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_payment`
--
ALTER TABLE `bank_payment`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comission`
--
ALTER TABLE `comission`
  MODIFY `comissionid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deposit`
--
ALTER TABLE `deposit`
  MODIFY `deposit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `dollar_charges`
--
ALTER TABLE `dollar_charges`
  MODIFY `dollar_charge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invest`
--
ALTER TABLE `invest`
  MODIFY `invest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `notification_table`
--
ALTER TABLE `notification_table`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `plan_category`
--
ALTER TABLE `plan_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `profite`
--
ALTER TABLE `profite`
  MODIFY `profite_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `teamcomission`
--
ALTER TABLE `teamcomission`
  MODIFY `comissionid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `ntransaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `withdraw`
--
ALTER TABLE `withdraw`
  MODIFY `withdraw_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdraw_charges`
--
ALTER TABLE `withdraw_charges`
  MODIFY `charges_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `deposit`
--
ALTER TABLE `deposit`
  ADD CONSTRAINT `deposit_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `deposit_ibfk_2` FOREIGN KEY (`bank_id`) REFERENCES `bank_payment` (`bank_id`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
