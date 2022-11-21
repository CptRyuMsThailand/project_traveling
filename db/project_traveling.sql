-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2022 at 10:28 AM
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
  `ev_desc` text NOT NULL,
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
(1, 'งานนมัสการองค์พระสมุทรเจดีย์', '', '2022-10-15', '2022-10-26', 'image1.jpg', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `table_place`
--

CREATE TABLE `table_place` (
  `pl_id` int(11) NOT NULL,
  `pl_name` varchar(50) NOT NULL,
  `pl_geo_latlon` text NOT NULL,
  `pl_desc` text NOT NULL,
  `pl_origin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `table_user`
--

CREATE TABLE `table_user` (
  `us_id` int(11) NOT NULL,
  `us_name` text NOT NULL,
  `us_pass` text NOT NULL,
  `us_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_event`
--
ALTER TABLE `table_event`
  ADD PRIMARY KEY (`ev_id`);

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
  MODIFY `ev_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `table_place`
--
ALTER TABLE `table_place`
  MODIFY `pl_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `table_user`
--
ALTER TABLE `table_user`
  MODIFY `us_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
