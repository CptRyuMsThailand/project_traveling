-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2023 at 04:37 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

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
(16, 'งานนมัสการองค์พระสมุทรเจดีย์', '\r\n<center>\r\n<h2> วิดีโอพรีวิว </h2>\r\n<video src=\"./videos/1674701139.mp4\" controls></video>\r\n</center>', '2023-11-03', '2023-11-13', '1671528182.jpg,1671528183.jpg,1671528184.jpg', 1, 1),
(19, 'ประเพณีรับบัว', '# จัดขึ้นที่วัดหลวงพ่อโต', '2023-10-23', '2023-10-30', '1674203273.jpg,1674203274.jpg', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `table_file`
--

CREATE TABLE `table_file` (
  `file_id` int(10) UNSIGNED NOT NULL,
  `file_name` text NOT NULL,
  `file_path` text NOT NULL,
  `file_uploader` int(11) NOT NULL,
  `file_type` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `table_file`
--

INSERT INTO `table_file` (`file_id`, `file_name`, `file_path`, `file_uploader`, `file_type`) VALUES
(2, 'WIN_20210627_13_08_09_Pro.jpg', '1674621603.jpg', 1, 'image'),
(3, 'WIN_20210819_10_51_01_Pro.jpg', '1674621626.jpg', 1, 'image'),
(4, 'WIN_20210819_10_55_42_Pro.jpg', '1674621726.jpg', 1, 'image'),
(7, 'WIN_20210802_18_19_23_Pro.mp4', '1674626997.mp4', 1, 'video'),
(8, 'WIN_20210802_18_32_09_Pro.mp4', '1674626998.mp4', 1, 'video'),
(9, 'Screenshot_20230125-161427_Maps.jpg', '1674638116.jpg', 1, 'image'),
(10, 'received_584189403098407.mp4', '1674701139.mp4', 1, 'video'),
(12, 'ศาลากลางจังหวัด-สป.png', '1674701609.png', 1, 'image');

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
(1, 'เมือง,ปากน้ำ'),
(2, 'บางพลี,บางพลีใหญ่');

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
(1, 'ศาลากลางจังหวัดสมุทรปราการ', '13.59954753288291200000000000000', '100.59634001073748000000000000000', 1, '', 0),
(2, 'วัดบางพลีใหญ่ใน', '13.60493750000000000000000000000', '100.71118750000000000000000000000', 2, '', 1);

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

-- --------------------------------------------------------

--
-- Table structure for table `table_viewpoint`
--

CREATE TABLE `table_viewpoint` (
  `vp_id` bigint(20) NOT NULL,
  `vp_name` text NOT NULL,
  `vp_lat` double NOT NULL,
  `vp_lon` double NOT NULL,
  `vp_img` text NOT NULL,
  `vp_place_ref` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `table_viewpoint`
--

INSERT INTO `table_viewpoint` (`vp_id`, `vp_name`, `vp_lat`, `vp_lon`, `vp_img`, `vp_place_ref`) VALUES
(1, 'หอชมเมืองสมุทรปราการ', 13.5984461, 100.5991077, './images/1674638116.jpg', 1),
(2, 'หน้าศาลากลางจังหวัดสมุทรปราการ', 13.5998147, 100.5969073, './images/1674701609.png', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_event`
--
ALTER TABLE `table_event`
  ADD PRIMARY KEY (`ev_id`);

--
-- Indexes for table `table_file`
--
ALTER TABLE `table_file`
  ADD PRIMARY KEY (`file_id`);

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
-- Indexes for table `table_viewpoint`
--
ALTER TABLE `table_viewpoint`
  ADD PRIMARY KEY (`vp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_event`
--
ALTER TABLE `table_event`
  MODIFY `ev_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `table_file`
--
ALTER TABLE `table_file`
  MODIFY `file_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `table_local`
--
ALTER TABLE `table_local`
  MODIFY `lc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `table_place`
--
ALTER TABLE `table_place`
  MODIFY `pl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `table_user`
--
ALTER TABLE `table_user`
  MODIFY `us_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `table_viewpoint`
--
ALTER TABLE `table_viewpoint`
  MODIFY `vp_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
