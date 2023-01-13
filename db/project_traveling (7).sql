-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2023 at 10:29 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_traveling`
--

-- --------------------------------------------------------

--
-- Table structure for table `table_event`
--

CREATE TABLE `table_event` (
  `ev_id` int(11) NOT NULL,
  `ev_name` text NOT NULL,
  `ev_desc` text CHARACTER SET utf8 NOT NULL,
  `ev_date_beg` date NOT NULL,
  `ev_date_end` date NOT NULL,
  `ev_img_list` text NOT NULL,
  `ev_ref_place_id` int(11) NOT NULL,
  `ev_origin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `table_event`
--

INSERT INTO `table_event` (`ev_id`, `ev_name`, `ev_desc`, `ev_date_beg`, `ev_date_end`, `ev_img_list`, `ev_ref_place_id`, `ev_origin`) VALUES
(16, 'งานนมัสการองค์พระสมุทรเจดีย์', '# Header Testing', '2022-10-15', '2022-10-26', '1671528182.jpg,1671528183.jpg,1671528184.jpg', 1, 1),
(18, 'งานอะไรสักอย่าง2', '			# ทดสอบหัวข้อ\r\n\r\nทดสอบเนื้อหา		', '2022-12-31', '2022-12-31', '1672306544.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `table_local`
--

CREATE TABLE `table_local` (
  `lc_id` int(11) NOT NULL,
  `lc_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `table_local`
--

INSERT INTO `table_local` (`lc_id`, `lc_name`) VALUES
(1, 'เมือง,ปากน้ำ');

-- --------------------------------------------------------

--
-- Table structure for table `table_place`
--

CREATE TABLE `table_place` (
  `pl_id` int(11) NOT NULL,
  `pl_name` varchar(50) NOT NULL,
  `pl_geo_lat` decimal(32,29) NOT NULL,
  `pl_geo_lon` decimal(32,29) NOT NULL,
  `pl_amphoe` int(11) NOT NULL,
  `pl_desc` text NOT NULL,
  `pl_origin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `table_place`
--

INSERT INTO `table_place` (`pl_id`, `pl_name`, `pl_geo_lat`, `pl_geo_lon`, `pl_amphoe`, `pl_desc`, `pl_origin`) VALUES
(1, 'ศาลากลางจังหวัดสมุทรปราการ', '13.59954753288291200000000000000', '100.59634001073748000000000000000', 1, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `table_user`
--

CREATE TABLE `table_user` (
  `us_id` int(11) NOT NULL,
  `us_name` text NOT NULL,
  `us_pass` text NOT NULL,
  `us_fname` text NOT NULL,
  `us_superuser` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `table_user`
--

INSERT INTO `table_user` (`us_id`, `us_name`, `us_pass`, `us_fname`, `us_superuser`) VALUES
(1, 'admin', '12345', 'Administrator', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_event`
--
ALTER TABLE `table_event`
  ADD PRIMARY KEY (`ev_id`);

--
-- Indexes for table `table_local`
--
ALTER TABLE `table_local`
  ADD PRIMARY KEY (`lc_id`);

--
-- Indexes for table `table_place`
--
ALTER TABLE `table_place`
  ADD PRIMARY KEY (`pl_id`);

--
-- Indexes for table `table_user`
--
ALTER TABLE `table_user`
  ADD PRIMARY KEY (`us_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_event`
--
ALTER TABLE `table_event`
  MODIFY `ev_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `table_local`
--
ALTER TABLE `table_local`
  MODIFY `lc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `table_place`
--
ALTER TABLE `table_place`
  MODIFY `pl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `table_user`
--
ALTER TABLE `table_user`
  MODIFY `us_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
