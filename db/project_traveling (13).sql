-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2023 at 02:25 PM
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

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `haversine` (`lat1` DOUBLE, `lon1` DOUBLE, `lat2` DOUBLE, `lon2` DOUBLE) RETURNS DOUBLE NO SQL
    DETERMINISTIC
    SQL SECURITY INVOKER
    COMMENT 'Haversine Formula to Calculate Approximate distance Between two'
BEGIN
return 6371 * (ACOS(COS(RADIANS(lat1)) * COS(RADIANS(lat2)) *
              COS(RADIANS(lon2) - RADIANS(lon1)) +
              SIN(RADIANS(lat1)) * SIN(RADIANS(lat2))
            ));
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `table_event`
--

CREATE TABLE `table_event` (
  `ev_id` int(11) NOT NULL,
  `ev_name` text NOT NULL,
  `ev_desc` longtext CHARACTER SET utf8 NOT NULL,
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
(16, 'งานนมัสการองค์พระสมุทรเจดีย์', '<center>\r\n<h2> วิดีโอพรีวิว </h2>\r\n<video src=\"./videos/1674701139.mp4\" controls></video>\r\n</center>', '2023-11-03', '2023-11-13', './images/1671528182.jpg', 1, 1),
(19, 'ประเพณีรับบัว', '# จัดขึ้นที่วัดหลวงพ่อโต', '2023-10-23', '2023-10-30', './images/1674203273.jpg', 2, 1),
(20, 'สงกรานต์พระประแดง', '<h2>\r\nจังหวัดสมุทรปราการและชาวอำเภอพระประแดง จึงได้ร่วมกันจัดงานสงกรานต์พระประแดงขึ้น เพื่อเป็นการต้อนรับปีใหม่ของไทยและเพื่ออนุรักษ์ประเพณีของชาวรามัญเอาไว้ โดยก่อนวันสงกรานต์จะมาถึง ชาวบ้านจะเตรียมบ้านเรือนให้สะอาด นำเงินที่เก็บหอมรอมริบไว้มาใช้จ่ายเพื่อการรื่นเริงในวันสงกรานต์ มีการกวนกาละแม ข้าวเหนียวแดง เพื่อทำบุญตักบาตรหรือแจกจ่ายญาติพี่น้อง ผู้ที่คุ้นเคยและเคารพนับถือ\r\n</h2>\r\n<p>\r\nเมื่อถึงวันสงกรานต์จะมีพิธีส่ง “ข้าวสงกรานต์” หรือ ที่เรียกว่า \"ข้าวแช่” ซึ่งจะนำไปถวายพระที่วัดตอนเช้าตรู่ โดยผู้ส่งข้าวสงกรานต์นิยมใช้สาว ๆ\r\n</p>\r\n<p>\r\nการสรงน้ำพระสงฆ์ของชาวพระประแดง จะสร้างซุ้มกั้นเป็นห้องน้ำด้วยทางมะพร้าว ปูด้วยแผ่นกระดานสำหรับให้พระเข้าไปสรงน้ำ โดยจะนิมนต์พระสงฆ์ที่มีอาวุโสสูงลงสรงก่อน ชาวบ้านจะใช้ขันตักน้ำในโอ่งเทลงไปในราง  น้ำจะไหลตามรางเข้าไปในซุ้มที่พระสรง เมื่อพระสงฆ์องค์หนึ่งสรงน้ำเสร็จก็นิมนต์พระองค์ต่อๆ ไป ในการสรงน้ำ การสรงน้ำพระถือเป็นการขอพรทำให้อยู่เย็นเป็นสุข\r\n</p>\r\n<h3>\r\nหลังจากสรงน้ำพระเสร็จแล้ว เป็นการรดน้ำของหนุ่มๆ สาวๆ โดยมี 3 ครั้งด้วยกัน คือ\r\n</h3>\r\n<ul>\r\n<li>ครั้งที่หนึ่ง เมื่อสาวกลับมาจากส่งข้าวสงกรานต์ตามวัดต่างๆ</li>\r\n<li>ครั้งที่สอง เมื่อสาวกลับจากสรงน้ำพระสงฆ์</li>\r\n<li>ครั้งที่สาม ถือเป็นการรดน้ำครั้งพิเศษ คือ ช่วงบ่ายที่มีการสรงน้ำพระพุทธรูปในมณฑปวัดโปรดเกตุเชษฐาราม</li>\r\n</ul>\r\n<p>\r\nในตอนกลางคืนยังมีการเล่น “สะบ้า” ซึ่งเป็นธรรมเนียมเก่าแก่ของชาวรามัญ การเล่นสะบ้ามี 2 ประเภท คือ สะบ้าประเภทเล่นกลางวัน เรียกว่า ทอยสะบ้าหัวช้าง และ การเล่นสะบ้าบ่อนในตอนกลางคืน และสิ่งที่ขาดไม่ได้ในงานสงกรานต์ของชาวพระประแดง คือ “การแห่นกแห่ปลา” ตามตำนานเพื่อเป็นการช่วยชีวิตปลาที่ตกคลักอยู่ตามหนองบึงในฤดูแล้งไปปล่อยในที่มีน้ำเพื่อให้พ้นความตาย และเป็นการรักษาพันธุ์ปลาในทางอ้อม โดยจะมีสาวรามัญร่วมขบวนแห่นำนกและปลาไปปล่อยตามที่ต่างๆ นอกจากนั้นยังมีการละเล่นสลับไปในขบวนด้วย ได้แก่ แตรวง ทะแยมอญ เถิดเทิง เป็นที่สนุกสนานรื่นเริง\r\n</p>\r\n<h3>ตัวอย่างงานประเพณีสงกรานต์พระประแดง</h3>\r\n<video src=\"./videos/1674718263.mp4\" width=\"320\" controls>\r\n</video>', '2023-04-19', '2023-04-21', './images/1674715382.jpg', 2, 1),
(21, 'งานวัดหลวงพ่อปาน', '<h3>\r\nเป็นงานประจำปีของชาวอำเภอบางบ่อ ทั้ง 8 ตำบลร่วมแรงร่วมใจกันจัดขึ้นเพื่อระลึกถึงคุณงามความดีของหลวงพ่อปาน ซึ่งมีสมณศักดิ์ในทางสงฆ์ว่า พระครูพิพัฒน์นิโรธกิจ อดีตเจ้าอาวาสวัดมงคลโคธาวาส (วัดบางเหี้ย) ที่ตำบลคลองด่าน\r\n</h3>\r\n<p>จะจัดในช่วงเวลา วันขึ้น 8 ค่ำ เดือน 12 ของทุกปี เป็นเวลา 2-3 วัน</p>\r\n\r\n<p>ความสำคัญ ประเพณีนมัสการหลวงพ่อปาน เป็นงานประจำปีของชาวอำเภอบางบ่อ ทั้ง 8 ตำบลร่วมแรงร่วมใจกันจัดขึ้นเพื่อระลึกถึงคุณงามความดีของหลวงพ่อปาน ซึ่งมีสมณศักดิ์ในทางสงฆ์ว่า พระครูพิพัฒน์นิโรธกิจ อดีตเจ้าอาวาสวัดมงคลโคธาวาส (วัดบางเหี้ย) ที่ตำบลคลองด่าน หลวงพ่อปานเกิดที่ตำบลบางเหี้ย บิดาเป็นคนจีน มารดา ชื่อ ตาล ได้บรรพชาเป็นสามเณรที่วัดอรุณราชวราราม (วัดแจ้ง) โดยมีเจ้าคุณศรีศากยะมุณีเป็นอุปัชฌาย์ หลวงพ่อปานเป็นเกจิอาจารย์ที่มีชื่อเสียง เป็นพระที่เมตตา มีวาจาศักดิ์สิทธิ์ วัตถุมงคลของท่านมีชื่อเสียงและเป็นที่ยอมรับของประชาชนทั่วไป คือ เขี้ยวเสือ จากคุณงามความดีของท่านปัจจุบันยังฝังอยู่ในจิตใจของชาวอำเภอบางบ่อ ทุกปีขึ้น 8 ค่ำ เดือน 12 ประชาชน ร่วมกับหน่วยงานต่าง ๆ ได้พร้อมกันจัดงานขึ้น\r\n</p>\r\n<p>\r\nพิธีกรรม เดิมการจัดงานนี้จะจัดขึ้นที่วัดมงคลโคธาวาส ตำบลคลองด่านก่อน 1-2 วัน แล้วอัญเชิญรูปเหมือนหลวงพ่อปานลงเรือ ล่องไปตามลำคลองคลองด่าน ในเวลาเช้า มีขบวนเรือตกแต่งอย่างสวยงาม ไปที่หน้าอำเภอบางบ่อ ซึ่งจัดมณฑปไว้เตรียมรับ หลังจากนั้นจะเริ่มแข่งเรือ ส่วนภาคกลางคืนจะมีมหรสพสมโภชกันจนถึงสว่าง ในงานนี้ มีการละเล่นชนิดหนึ่งซึ่งเล่นกันมานาน คือ \"โจ๊ก\" เป็นที่สนใจของประชาชนที่มาร่วมงานเป็นอันมาก จึงถือกันเป็นประเพณีเลยว่า เมื่อมีงานหลวงพ่อปาน จะต้องมีการทาย\"โจ๊ก\" ด้วย แต่ในปัจจุบันประมาณ 1-2 ปีที่ผ่านมา \"โจ๊ก\" ในงานหลวงพ่อปานไม่มี แต่ไปเล่นในงานลอยกระทงแทน สำหรับงานนมัสการหลวงพ่อปานนี้ เดิมจะใช้เวลา ในการจัด 1 วัน 1 คืน คือมีงานตลอดคืนจนถึงรุ่งเช้า แต่ปัจจุบันระยะเวลาในการจัด ใช้เวลา 2-3 วัน โดยเริ่มจากวันขึ้น 8 ค่ำ เดือน 12 ในงานจะมีการแข่งเรือยาว เพื่อเป็นการรักษาประเพณีอันดีงามของท้องถิ่น เพื่อความสามัคคีของประชาชน นอกจากนี้ยังมีการประกวดหนุ่มสาวพายเรือ และมหรสพต่าง ๆ เหมือนงานวัดทั่วไป เช่น ลิเก ดนตรี ภาพยนตร์ นอกจากนี้ยังมีการจำหน่ายสินค้าพื้นบ้านที่เป็นสัญลักษณ์ของอำเภอบางบ่อ คือ ปลาสลิดแห้ง รสดี คนในปัจจุบันนี้จะเรียกหลวงพ่อปานว่า \"หลวงปู่ปาน\"\r\n</p>\r\n<p>\r\nสาระ ความศรัทธาต่อหลวงพ่อปาน และความเป็นอันหนึ่งอันเดียวกันของชาวบ้าน\r\n</p>\r\n<p>ตัวอย่างภาพกิจกรรมแห่หลวงพ่อปาน</p>\r\n<video src=\"./videos/1674716382.mp4\" controls width=\"320\">\r\n</video>', '2023-11-20', '2023-11-22', './images/1674715494.jpg', 4, 1);

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
(12, 'ศาลากลางจังหวัด-สป.png', '1674701609.png', 1, 'image'),
(14, 'songkran-3.jpg', '1674715382.jpg', 1, 'image'),
(15, 'efwefw.jpg', '1674715494.jpg', 1, 'image'),
(16, 'ชาวคลองด่านเมืองปากน้ำร่วมประเพณีแห่หลวงปู่ปานทางทะเล.mp4', '1674716382.mp4', 1, 'video'),
(17, '2021-11-19.jpg', '1674717267.jpg', 1, 'image'),
(18, 'ขบวนแห่ประเพณีสงกรานต์พระประแดง ประจำปี2561 ขบวนที่1.mp4', '1674718263.mp4', 1, 'video');

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
(2, 'บางพลี,บางพลีใหญ่'),
(3, 'พระประแดง,ตลาด'),
(4, 'บางบ่อ,คลองด่าน');

-- --------------------------------------------------------

--
-- Table structure for table `table_moon_calendar`
--

CREATE TABLE `table_moon_calendar` (
  `moon_year` int(10) UNSIGNED NOT NULL,
  `moon_start_date` tinyint(3) UNSIGNED NOT NULL,
  `moon_start_month` tinyint(3) UNSIGNED NOT NULL,
  `moon_double_eighth` tinyint(1) NOT NULL,
  `moon_start_long` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `table_moon_calendar`
--

INSERT INTO `table_moon_calendar` (`moon_year`, `moon_start_date`, `moon_start_month`, `moon_double_eighth`, `moon_start_long`) VALUES
(2023, 10, 2, 1, 1);

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
(2, 'วัดบางพลีใหญ่ใน', '13.60493750000000000000000000000', '100.71118750000000000000000000000', 2, '', 1),
(3, 'ที่ว่าการอำเภอพระประแดง', '13.65869608655996500000000000000', '100.53378414681625000000000000000', 3, '', 1),
(4, 'วัดมงคลโคธาวาส', '13.51357695537153300000000000000', '100.82084674827094000000000000000', 4, '', 1);

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
(2, 'หน้าศาลากลางจังหวัดสมุทรปราการ', 13.5998147, 100.5969073, './images/1674701609.png', 1),
(3, 'หน้าวัดหลวงพ่อปาน', 13.5135721, 100.8203237, './images/1674717267.jpg', 4);

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
-- Indexes for table `table_moon_calendar`
--
ALTER TABLE `table_moon_calendar`
  ADD PRIMARY KEY (`moon_year`);

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
  MODIFY `ev_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `table_file`
--
ALTER TABLE `table_file`
  MODIFY `file_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `table_local`
--
ALTER TABLE `table_local`
  MODIFY `lc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `table_place`
--
ALTER TABLE `table_place`
  MODIFY `pl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `table_user`
--
ALTER TABLE `table_user`
  MODIFY `us_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `table_viewpoint`
--
ALTER TABLE `table_viewpoint`
  MODIFY `vp_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
