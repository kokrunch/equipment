-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2024 at 06:36 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `it_equipment`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_borrow`
--

CREATE TABLE `tb_borrow` (
  `borrow_id` int(11) NOT NULL COMMENT 'รหัสการยืม',
  `borrow_quantity` int(11) NOT NULL COMMENT 'จำนวนการยืม',
  `borrow_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'รายละเอียดการยืม',
  `borrow_date` datetime NOT NULL COMMENT 'วันที่ขอยืม',
  `borrow_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'สถานะในการยืม',
  `borrow_return_date` datetime DEFAULT NULL COMMENT 'วันที่คืน',
  `borrow_approve_date` datetime DEFAULT NULL COMMENT 'วันที่อนุมัติ',
  `borrow_approve_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'สถานะอนุมัติยืม',
  `borrow_notapprove` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'เหตุผลที่ไม่อนุมัติ',
  `equipment_id` int(11) DEFAULT NULL COMMENT 'รหัสครุภัณฑ์',
  `emp_id` int(11) DEFAULT NULL COMMENT 'คนยืม',
  `admin_approve` int(11) DEFAULT NULL COMMENT 'คนอนุมัติให้ยืม',
  `create_date` timestamp NULL DEFAULT current_timestamp(),
  `room_desc_equ_id` int(11) DEFAULT NULL COMMENT 'ยืมไปใช้ที่ไหน',
  `br_use_to` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_borrow`
--

INSERT INTO `tb_borrow` (`borrow_id`, `borrow_quantity`, `borrow_description`, `borrow_date`, `borrow_status`, `borrow_return_date`, `borrow_approve_date`, `borrow_approve_status`, `borrow_notapprove`, `equipment_id`, `emp_id`, `admin_approve`, `create_date`, `room_desc_equ_id`, `br_use_to`) VALUES
(416, 1, '-', '2024-05-04 00:00:00', NULL, '2024-06-08 00:00:00', '2001-05-24 02:01:19', 'ไม่ผ่านอนุมัติ', '-', 865, 103, 110, '2024-04-26 07:14:06', 114, NULL),
(417, 1, '-', '2024-05-11 00:00:00', NULL, '2024-05-26 00:00:00', NULL, 'รออนุมัติ', NULL, 865, 103, NULL, '2024-05-01 07:52:28', 115, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_borrow_return`
--

CREATE TABLE `tb_borrow_return` (
  `return_id` int(11) NOT NULL,
  `return_date` datetime DEFAULT NULL COMMENT 'วันที่นำมาคืน',
  `return_emp` varchar(255) DEFAULT NULL COMMENT 'คนที่รับคืน',
  `borrow_id` int(11) DEFAULT NULL COMMENT 'รหัสการยืม',
  `return_detail` varchar(255) DEFAULT NULL COMMENT 'หมายเหตุ',
  `return_quantity` int(11) DEFAULT NULL COMMENT 'จำนวนที่คืน',
  `create_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tb_branch`
--

CREATE TABLE `tb_branch` (
  `branch_id` int(11) NOT NULL COMMENT 'รหัสสาขา',
  `branch_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ชื่อสาขา',
  `fac_id` int(11) DEFAULT NULL COMMENT 'รหัสคณะ',
  `create_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tb_budget_year`
--

CREATE TABLE `tb_budget_year` (
  `budget_id` int(11) NOT NULL,
  `budget_year` varchar(10) DEFAULT NULL,
  `budget_start_date` timestamp NULL DEFAULT NULL,
  `budget_end_date` timestamp NULL DEFAULT NULL,
  `budget_year_status` tinyint(1) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_budget_year`
--

INSERT INTO `tb_budget_year` (`budget_id`, `budget_year`, `budget_start_date`, `budget_end_date`, `budget_year_status`, `create_date`) VALUES
(33, '2566', '2022-09-30 17:00:00', '2023-09-29 17:00:00', 1, '2023-09-06 08:22:40');

-- --------------------------------------------------------

--
-- Table structure for table `tb_disburse`
--

CREATE TABLE `tb_disburse` (
  `dis_id` int(11) NOT NULL,
  `dis_code` varchar(255) DEFAULT NULL COMMENT 'หมายเลขการเบิก',
  `dis_date` datetime DEFAULT NULL COMMENT 'วันที่เบิก',
  `dis_approve_date` datetime DEFAULT NULL COMMENT 'วันที่อนุมัติ',
  `dis_note` varchar(255) DEFAULT NULL COMMENT 'เหตุผลที่เบิก',
  `dis_status` varchar(255) DEFAULT NULL COMMENT 'สถานะ อนุมัติ ไม่อนุมัติ',
  `dis_not_approve` varchar(255) DEFAULT NULL COMMENT 'เหตุผลที่ไม่อนุมัติ',
  `emp_id` int(11) DEFAULT NULL COMMENT 'คนเบิก',
  `emp_approve` int(11) DEFAULT NULL COMMENT 'คนอนุมัติ',
  `create_date` timestamp NULL DEFAULT current_timestamp(),
  `report_note` varchar(255) DEFAULT NULL COMMENT 'รายงานการเบิกหลังจากการขอเบิกไปแล้ว'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_disburse`
--

INSERT INTO `tb_disburse` (`dis_id`, `dis_code`, `dis_date`, `dis_approve_date`, `dis_note`, `dis_status`, `dis_not_approve`, `emp_id`, `emp_approve`, `create_date`, `report_note`) VALUES
(167, NULL, '2024-05-03 00:00:00', '2024-05-03 00:00:00', '', 'อนุมัติแล้ว', '', 103, 110, '2024-05-03 06:26:26', '-');

-- --------------------------------------------------------

--
-- Table structure for table `tb_disburse_cart`
--

CREATE TABLE `tb_disburse_cart` (
  `mat_cart_id` int(11) NOT NULL,
  `mat_bud_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `emp_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tb_disburse_detail`
--

CREATE TABLE `tb_disburse_detail` (
  `dis_det_id` int(11) NOT NULL,
  `dis_id` int(11) DEFAULT NULL COMMENT 'ใบเบิกไหน',
  `quantity` int(11) DEFAULT NULL COMMENT 'จำนวนเท่าไหร่',
  `dis_mat_detail` varchar(255) DEFAULT NULL COMMENT 'เหตุผล หมายเหตุ ที่เบิกวัสดุนี้',
  `mat_budget_id` int(11) DEFAULT NULL COMMENT 'วัสดุอะไร',
  `create_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_disburse_detail`
--

INSERT INTO `tb_disburse_detail` (`dis_det_id`, `dis_id`, `quantity`, `dis_mat_detail`, `mat_budget_id`, `create_date`) VALUES
(242, 167, 1, '', 722, '2024-05-03 06:26:27');

-- --------------------------------------------------------

--
-- Table structure for table `tb_employee`
--

CREATE TABLE `tb_employee` (
  `emp_id` int(11) NOT NULL,
  `emp_username` varchar(255) DEFAULT NULL,
  `emp_password` varchar(255) DEFAULT NULL,
  `emp_firstname` varchar(255) DEFAULT NULL,
  `emp_lastname` varchar(255) DEFAULT NULL,
  `emp_gender` varchar(255) DEFAULT NULL,
  `emp_email` varchar(255) DEFAULT NULL,
  `emp_tel` varchar(255) DEFAULT NULL,
  `sub_role_id` int(11) DEFAULT NULL,
  `emp_img` varchar(255) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_employee`
--

INSERT INTO `tb_employee` (`emp_id`, `emp_username`, `emp_password`, `emp_firstname`, `emp_lastname`, `emp_gender`, `emp_email`, `emp_tel`, `sub_role_id`, `emp_img`, `branch_id`, `create_date`) VALUES
(102, 'admin', '12345', 'admin', 'admin', 'male', 'test', '0000000000', 1, NULL, NULL, '2023-02-13 06:05:11'),
(103, 'jaidee', '1234', 'ใจดี', 'บำรุงสุข', 'female', 'test', '0000000000', 2, '1714448794.png', NULL, '2023-02-13 06:05:57'),
(104, 'tech_comp', '1234', 'ช่างคอม', 'ใจดี', 'male', 'test', '0000000000', 4, NULL, NULL, '2023-02-13 06:18:43'),
(105, 'tech_struct', '1234', 'ช่างสร้าง', 'ใจดี', 'male', 'test', '0000000000', 6, NULL, NULL, '2023-02-13 06:20:06'),
(106, 'jaisai', '1234', 'ปัญญา', 'แก้วก่าน', 'male', 'panya.k@msu.ac.th', '0833631387', 3, '1693992514.jpg', NULL, '2023-02-13 06:20:30'),
(108, 'tech_arct', '1234', 'ใจโสต', 'สุขดี', 'male', 'test', '0000000000', 5, NULL, NULL, '2023-02-13 07:46:54'),
(109, 'money', '1234', 'เงิน', 'ทอง', 'female', 'test', '0000000000', 8, '1677212982.jpg', NULL, '2023-02-23 04:35:26'),
(110, 'rungnapa', 'rungnapa@PW', 'รุ่งนภา', 'ไกรแสน', 'female', 'test', '0000000000', 24, '1714114898.jpg', NULL, '2023-02-23 04:35:26'),
(111, 'thananchai.k', 'thananchai.k1234', 'ธนันชัย', 'คำเกตุ', 'male', 'thananchai.k@msu.ac.th', '5210', 2, NULL, NULL, '2023-03-18 06:05:57');

-- --------------------------------------------------------

--
-- Table structure for table `tb_equipment`
--

CREATE TABLE `tb_equipment` (
  `equ_id` int(11) NOT NULL COMMENT 'รหัสวัสดุ',
  `equ_code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'หมายเลขครุภัณฑ์',
  `equ_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อวัสดุ',
  `equ_type_id` int(11) NOT NULL COMMENT 'รหัสประเภทวัสดุ',
  `equ_brand` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ยี่ห้อ',
  `equ_model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'รุ่น',
  `equ_detail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'รายละเอียด',
  `equ_color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'สี',
  `equ_serail_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'รหัสเฉพาะ',
  `equ_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'สถานะ ชำรุด ใช้งานได้',
  `create_date` timestamp NULL DEFAULT current_timestamp() COMMENT 'วันที่บันทึก',
  `equ_owner` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ผู้ครอบครอง'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_equipment`
--

INSERT INTO `tb_equipment` (`equ_id`, `equ_code`, `equ_name`, `equ_type_id`, `equ_brand`, `equ_model`, `equ_detail`, `equ_color`, `equ_serail_no`, `equ_status`, `create_date`, `equ_owner`) VALUES
(865, '01', 'test', 39, 'test', 'test', 'test', 'ดำ', '00', 'ปกติ', '2024-03-18 08:55:35', 'test'),
(866, '1234', 'test', 39, 'asda', 'asdas', 'detaol', 'asda', 'sdfsafd', 'ปกติ', '2024-07-03 09:21:47', 'anirut'),
(867, '1234', 'test', 39, 'asda', 'asdas', 'detaol', 'asda', 'sdfsafd', 'ปกติ', '2024-07-03 09:22:03', 'anirut'),
(868, '123123', 'asdasd', 39, 'adsasd', 'asdads', 'asd', 'adsas', 'asdasd', 'ปกติ', '2024-08-14 10:25:53', 'asdasd'),
(869, '123123', 'asdasd', 39, 'adsasd', 'asdads', 'asd', 'adsas', 'asdasd', 'ปกติ', '2024-08-14 10:25:57', 'asdasd'),
(870, '123123', 'asdasd', 39, 'adsasd', 'asdads', 'asd', 'adsas', 'asdasd', 'ปกติ', '2024-08-14 10:26:02', 'asdasd'),
(871, '123123', 'asdasd', 39, 'adsasd', 'asdads', 'asd', 'adsas', 'asdasd', 'ปกติ', '2024-08-14 10:26:06', 'asdasd');

-- --------------------------------------------------------

--
-- Table structure for table `tb_equipment_budget_year`
--

CREATE TABLE `tb_equipment_budget_year` (
  `equ_bud_id` int(11) NOT NULL,
  `equ_id` int(11) DEFAULT NULL,
  `equ_price` decimal(10,2) DEFAULT NULL,
  `equ_stock` int(11) DEFAULT 0,
  `budget_id` int(11) DEFAULT NULL,
  `equ_date_income` varchar(255) DEFAULT NULL,
  `equ_expire_date` datetime DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_equipment_budget_year`
--

INSERT INTO `tb_equipment_budget_year` (`equ_bud_id`, `equ_id`, `equ_price`, `equ_stock`, `budget_id`, `equ_date_income`, `equ_expire_date`, `create_date`) VALUES
(855, 865, '1.00', 1, 33, '06-มี.ค.-67', '2024-03-21 00:00:00', '2024-03-18 08:55:35'),
(856, 866, '100.00', 1, 33, '03-ก.ค.-67', '2024-07-03 00:00:00', '2024-07-03 09:21:47'),
(857, 867, '100.00', 1, 33, '03-ก.ค.-67', '2024-07-03 00:00:00', '2024-07-03 09:22:03'),
(858, 868, '111.00', 1111, 33, '14-ส.ค.-67', '2024-08-14 00:00:00', '2024-08-14 10:25:53'),
(859, 869, '111.00', 1111, 33, '14-ส.ค.-67', '2024-08-14 00:00:00', '2024-08-14 10:25:57'),
(860, 870, '111.00', 1111, 33, '14-ส.ค.-67', '2024-08-14 00:00:00', '2024-08-14 10:26:02'),
(861, 871, '111.00', 1111, 33, '14-ส.ค.-67', '2024-08-14 00:00:00', '2024-08-14 10:26:06');

-- --------------------------------------------------------

--
-- Table structure for table `tb_equipment_images`
--

CREATE TABLE `tb_equipment_images` (
  `equ_img_id` int(11) NOT NULL,
  `equ_img_name` varchar(255) DEFAULT NULL COMMENT 'ชื่อรูป',
  `equ_id` int(11) DEFAULT NULL COMMENT 'ครุภัณฑ์',
  `create_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_equipment_images`
--

INSERT INTO `tb_equipment_images` (`equ_img_id`, `equ_img_name`, `equ_id`, `create_date`) VALUES
(57, '344449152418032024.jpg', 865, '2024-03-18 08:55:35'),
(58, '10965810932403072024.jpg', 867, '2024-07-03 09:22:03');

-- --------------------------------------------------------

--
-- Table structure for table `tb_equipment_type`
--

CREATE TABLE `tb_equipment_type` (
  `type_id` int(11) NOT NULL COMMENT 'รหัสประเภทวัสดุ',
  `type_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อประเภทวัสดุ',
  `create_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_equipment_type`
--

INSERT INTO `tb_equipment_type` (`type_id`, `type_name`, `create_date`) VALUES
(39, 'ครุภัณฑ์สำนักงาน', '2023-09-06 09:30:56'),
(40, 'ครุภัณฑ์การศึกษา', '2023-09-06 09:31:13'),
(41, 'ครุภัณฑ์ยานพาหนะและขนส่ง', '2023-09-06 09:31:40'),
(42, 'ครุภัณฑ์การเกษตร', '2023-09-06 09:32:16'),
(43, 'ครุภัณฑ์ก่อสร้าง', '2023-09-06 09:32:30'),
(44, 'ครุภัณฑ์ไฟฟ้าและวิทยุ', '2023-09-06 09:32:55'),
(45, 'ครุภัณฑ์โฆษณาและเผยแพร่', '2023-09-06 09:33:30'),
(46, 'ครุภัณฑ์วิทยาศาสตร์และการแพทย์', '2023-09-06 09:34:10'),
(47, 'ครุภัณฑ์งานบ้านงานครัว', '2023-09-06 09:34:31'),
(48, 'ครุภัณฑ์โรงงาน', '2023-09-06 09:34:49'),
(49, 'ครุภัณฑ์กีฬา', '2023-09-06 09:35:26'),
(50, 'ครุภัณฑ์สำรวจ', '2023-09-06 09:35:39'),
(51, 'ครุภัณฑ์ดนตรีและนาฎศิลป์', '2023-09-06 09:36:08'),
(52, 'ครุภัณฑ์คอมพิวเตอร์หรืออิเล็กทรอนิกส์', '2023-09-06 09:36:53'),
(53, 'ครุภัณฑ์สนาม', '2023-09-06 09:37:09'),
(54, 'ครุภัณฑ์อื่นๆ', '2023-09-06 09:37:21');

-- --------------------------------------------------------

--
-- Table structure for table `tb_faculty`
--

CREATE TABLE `tb_faculty` (
  `fac_id` int(11) NOT NULL COMMENT 'รหัสคณะ',
  `fac_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อคณะ',
  `create_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_faculty`
--

INSERT INTO `tb_faculty` (`fac_id`, `fac_name`, `create_date`) VALUES
(3, 'คณะยาคูล ยาใจที่จริงใจ', '2023-02-13 07:20:45');

-- --------------------------------------------------------

--
-- Table structure for table `tb_line_token`
--

CREATE TABLE `tb_line_token` (
  `token_id` int(11) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL COMMENT 'ชื่อแผนก ชื่อกลุ่ม line',
  `token` varchar(255) DEFAULT NULL COMMENT 'line โทเคน',
  `role_id` int(11) DEFAULT NULL COMMENT 'ตำแหน่ง',
  `create_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tb_material`
--

CREATE TABLE `tb_material` (
  `mat_id` int(11) NOT NULL COMMENT 'รหัสครุภัณฑ์',
  `mat_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ชื่อครุภัณฑ์',
  `mat_type_id` int(11) DEFAULT NULL COMMENT 'รหัสประเภทครุภัณฑ์',
  `mat_brand` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_material`
--

INSERT INTO `tb_material` (`mat_id`, `mat_name`, `mat_type_id`, `mat_brand`, `unit_id`, `create_date`) VALUES
(397, 'กระเป๋าซองซิป', 49, '-', 64, '2024-02-14 06:37:55'),
(398, 'ดินสอกด', 49, '-', 65, '2024-02-14 06:41:29'),
(399, 'ปากกาเจล', 49, '-', 65, '2024-02-14 06:44:27'),
(400, 'ยางลบ', 49, '-', 67, '2024-02-14 06:45:12'),
(401, 'กระดาษทิชชูเช็ดหน้า', 52, '-', 68, '2024-02-14 06:52:36'),
(402, 'ทิชชูเปียก', 52, '-', 68, '2024-02-14 06:53:15'),
(403, 'ตรายางหมึกในตัวขนาด 15*75 mm.', 49, '-', 62, '2024-02-14 07:09:33'),
(404, 'ตรายางหมึกในตัว 25*82 mm.', 49, '-', 62, '2024-02-15 01:39:55'),
(407, 'ตรายางหมึกในตัว 25*70 mm.', 49, '-', 62, '2024-02-15 01:45:28'),
(409, 'ตราหมึกในตัวขนาด 22*58 mm.', 49, '-', 62, '2024-02-15 01:52:10'),
(410, 'ตรายางหมึกในตัว 10*47', 49, '-', 62, '2024-02-15 01:53:24'),
(411, '256 GB Flash Drive Samdisk', 49, 'Samdisk', 69, '2024-02-15 01:58:06'),
(413, 'ชุดกาแฟเบญจรงค์', 49, '-', 70, '2024-02-15 02:02:31'),
(414, 'จานรองขนมเบญจรงค์', 49, '-', 70, '2024-02-15 02:03:49'),
(415, 'ถาดไม้', 49, '-', 70, '2024-02-15 02:05:39'),
(417, 'ช้อนกาแฟสแตนเลส', 49, '-', 71, '2024-02-15 07:49:42'),
(418, 'ส้มเล็กสแตนเลส', 49, '-', 71, '2024-02-15 07:51:10'),
(419, 'กล่องมีล้อ', 49, '-', 64, '2024-02-15 07:52:28'),
(420, 'ริบบิ้น', 49, '-', 68, '2024-02-15 08:03:55'),
(421, 'Ram DDR4(3200) 32GB KINGSTON', 61, 'Kingston', 62, '2024-02-15 08:06:36'),
(422, 'ฮาร์ดดิสก์ SanDisk SSD Extreme Portable 1TB', 61, 'SanDisk', 72, '2024-02-15 08:10:31'),
(423, 'KINGSTON RAM DDR4(2666) 8gb FOR Notebook', 61, 'KINGSTON', 62, '2024-02-15 08:13:13'),
(424, 'คีย์บอร์ด LOGITECH POP KEYS BLAST', 61, 'LOGITECH', 72, '2024-02-15 08:15:24'),
(425, 'POWER BANK 15000 mAh REMAX', 61, 'REMAX', 62, '2024-02-15 08:17:35'),
(426, 'Pioneering Minds ก้าว รุก บุก เบิก', 62, '-', 73, '2024-02-15 08:29:11'),
(427, 'ด้านมืดของพลังแห่งการเล่าเรื่อง', 62, '-', 73, '2024-02-15 08:30:28'),
(429, 'Content That Sells เขียนคอนเทนต์ให้ตรงใจฯ', 62, '-', 73, '2024-02-15 08:32:56'),
(430, 'อาละดินกับลัดไดต์', 62, '-', 73, '2024-02-15 08:34:55'),
(431, 'จิตวิญญาณบริหารผ่านวิกฤติ', 62, '-', 73, '2024-02-15 08:37:04'),
(432, 'สุดยอดกลยุทธ์ 8 บริษัทแนวหน้าของโลก', 62, '-', 73, '2024-02-15 08:40:26'),
(433, 'คัมภีร์การบริหารโครงการ', 62, '-', 73, '2024-02-15 08:41:40'),
(434, 'กลยุทธ์การเจรจาต่อรอง', 62, '-', 73, '2024-02-15 08:42:55'),
(435, 'Blizscaling รุกเร็ว โตไว ด้วยกลยุทธ์', 62, '-', 73, '2024-02-15 08:44:32'),
(436, 'Principle Your Guided Journal ภาคภาษาไทย', 62, '-', 73, '2024-02-15 08:46:50'),
(438, 'Changing World Order ภาคภาษาไทย', 62, '-', 73, '2024-02-15 08:50:19'),
(439, 'คัมภีย์ผู้นำ', 62, '-', 73, '2024-02-15 08:52:35'),
(440, 'The Invisible Leader ผู้นำล่องหน', 62, '-', 73, '2024-02-15 08:54:19'),
(442, 'คู่มือนอกรีต ในการสร้างสิ่งที่ควรค่าฯ', 62, '-', 73, '2024-02-15 08:56:09'),
(444, 'คำสารภาพของคนโฆษณา', 62, '-', 73, '2024-02-15 08:57:26'),
(446, 'Marketing Psychology of Great Customer', 62, '-', 73, '2024-02-15 08:59:10'),
(447, 'ผู้นำที่ใช่ วิถี 8 สู่ผู้นำที่ไม่มีวันฯ', 62, '-', 73, '2024-02-15 09:00:41'),
(449, 'วิถีคนปานกลาง', 62, '-', 73, '2024-02-15 09:02:19'),
(450, 'Move Heaven and Earth', 62, '-', 73, '2024-02-15 09:18:26'),
(451, 'the Art of Noticing ศิลปะแห่งการสังเกต', 62, '-', 73, '2024-02-15 09:20:23'),
(452, 'วิชาอารมณ์ขัน :ฝึกลับคมอารมณ์ขันแบบจริง', 62, '-', 73, '2024-02-15 09:21:52'),
(453, 'บล๊อกเชนเข้าใจง่าย', 62, '-', 73, '2024-02-15 09:22:42'),
(454, 'The Gift of Influence ทุกคนคือแรงดลใจ', 62, '-', 73, '2024-02-15 09:24:03'),
(455, 'ขาย1คนตามมาซื้อ100คน', 62, '-', 73, '2024-02-15 09:25:36'),
(456, 'ชีวิตคือของขวัญ', 62, '-', 73, '2024-02-15 09:26:20'),
(459, 'fujifilm CT203490 Black ตลับหมึกโทนเนอร์ สีดำ', 49, 'fujifilm', 74, '2024-02-15 09:30:25'),
(460, 'fujifilm CT203491 C ตลับหมึกโทนเนอร์ สีฟ้า', 61, 'fujifilm', 74, '2024-02-15 09:32:43'),
(461, 'fujifilm CT203492 M ตลับหมึกโทนเนอร์ สีม่วง', 61, 'fujifilm', 74, '2024-02-15 09:34:15'),
(462, 'fujifilm CT203493 Y ตลับหมึกโทนเนอร์ สีเหลือง', 61, 'fujifilm', 74, '2024-02-15 09:35:46'),
(463, 'Mymol 500 mg. ฟ้า-ขาว 100\'s กระปุก', 69, '-', 75, '2024-02-16 01:52:36'),
(464, 'Ponstan 500 mg. 10\'s', 69, '-', 76, '2024-02-16 01:54:25'),
(465, 'Counter Pain cool 30 g. ฟ้า', 69, '-', 63, '2024-02-16 01:56:43'),
(466, 'Histatab 4 mg. 100\'s', 69, '-', 75, '2024-02-16 01:58:18'),
(467, 'Cadramine-V location  60 ml.', 69, '-', 77, '2024-02-16 02:00:00'),
(468, 'Air-x รสมินต์', 69, '-', 76, '2024-02-16 02:01:37'),
(469, 'Antacil แผง 10\'s', 69, '-', 76, '2024-02-16 02:03:01'),
(470, 'Dimenhydrinate 50 mg.T.man 10\'s', 69, '-', 76, '2024-02-16 02:05:12'),
(471, 'ยาหมอง ตราถ้วยทอง 8 g.', 69, '-', 74, '2024-02-16 02:06:30'),
(472, 'น้ำมันมวย 30 ml.', 69, '-', 77, '2024-02-16 02:07:49'),
(473, 'klean &amp; kare Nomal saline 100 ml.', 69, '-', 77, '2024-02-16 02:09:47'),
(474, 'Betamed solution Medic Pharma 15 ml.', 69, '-', 77, '2024-02-16 02:11:28'),
(475, 'Elastic Bandage 3&quot;x5yds Longmed', 69, '-', 78, '2024-02-16 02:13:05'),
(476, 'Alcohol 70% ศิริบัญชา 60 ml.', 69, '-', 77, '2024-02-16 02:14:23'),
(477, 'Softip ไม้พันสำลีก้านยาว size S 100\'s', 69, '-', 68, '2024-02-16 02:32:28'),
(478, 'Longmed Net Gauzc 2x2 นิ้ว 10\'s', 69, '-', 80, '2024-02-16 04:35:16'),
(479, 'Tigerplast พลาสเตอร์ปิดแผล ผ้า', 69, '-', 62, '2024-02-16 04:48:31'),
(480, 'Nexcare Transpore 1/2&quot;x5 yds', 69, '-', 78, '2024-02-16 09:13:01'),
(481, 'Zam-buk 8g. เล็ก', 69, '-', 74, '2024-02-16 09:23:27'),
(482, 'Opsar 120 ml. ใหญ่', 69, '-', 77, '2024-02-16 09:28:00'),
(483, 'Oreda ส้ม ซองเล็ก 3 g.', 69, '-', 79, '2024-02-19 01:54:26'),
(484, 'D-Lyte Compplex รสส้ม 25 g.', 69, '-', 79, '2024-02-19 02:05:20'),
(485, 'Domp-M 10 mg. 10\'s', 69, '-', 76, '2024-02-19 02:06:37'),
(486, 'Buscopan  10 mg. 10\'s', 69, '-', 76, '2024-02-19 02:08:16'),
(487, 'สำลลีก้อน รถพยาบาล 40 g.', 69, '-', 68, '2024-02-19 02:09:55'),
(488, 'พิมเสนน้ำตราโป้ยเซียน(สำลี:ขวดพลาสติก) 8 ml.', 69, '-', 63, '2024-02-19 02:11:51'),
(489, 'ป้ายไวนิล ขนาด 400*600 cm.', 49, '-', 81, '2024-02-19 02:17:57'),
(490, 'สโตอิรายวัน(The Daiy Stoic)', 62, '-', 73, '2024-02-19 06:47:27'),
(491, 'คริสโตเฟอร์ โนแลน ความลับในภาพเคลื่อนไหว', 62, '-', 73, '2024-02-19 06:50:17'),
(492, 'The Secret Lives of Customers', 62, '-', 73, '2024-02-21 07:35:39'),
(493, 'The POWER OF ONE MORE พลังอีกหนึ่ง', 62, '-', 73, '2024-02-21 07:42:38'),
(494, 'มหันตภัยคุกคาม (Mega Threats)', 62, '-', 73, '2024-02-21 07:45:47'),
(495, '50 Marketing Framework มองการตลาดฯ', 62, '-', 73, '2024-02-21 08:01:08'),
(496, 'ทุนนิยมสอดแนม', 62, '-', 73, '2024-02-22 07:53:36'),
(497, 'นี่คือสิ่งที่เตือนว่าโลกจะถึงคราวอวสาน', 62, '-', 73, '2024-02-22 07:55:21'),
(498, 'ชีวิต 3.0 : LIFE 3.0 ', 62, '-', 73, '2024-02-22 08:21:30'),
(499, '7 1/2 บทเรียนสมองมหัศจรรณ์ : Seven and A', 62, '-', 73, '2024-02-22 08:24:14'),
(500, 'ถ่านอัลคาไลน์ Panasonic 6LR61T/1SL', 49, '-', 67, '2024-02-22 08:58:56'),
(501, 'ถ่านอัลคาไลน์ Panasonic LR6T/4B AA (แพ็ค 4 ก้อน)', 49, '-', 68, '2024-02-23 02:02:19'),
(502, 'ถ่านอัลคาไลน์ Panasonic LR03T/4B AAA (แพ็ค 4 ก้อน)', 49, '-', 68, '2024-02-23 02:04:28'),
(503, 'เทปกาวสองหน้า สก๊อตช์ 4010 ขนาด1.9มม. x1.5 มม.', 49, '-', 70, '2024-02-23 02:07:38'),
(504, 'ปากกาลูกลื่น0.7 มม. ควอนตั้ม Sense สีน้ำเงิน', 49, '-', 66, '2024-02-23 02:12:10'),
(505, 'ลวดเสียบกระดาษ 33 มม. (กล่อง 300 ตัว) one 100433-2', 49, '-', 70, '2024-02-23 02:14:40'),
(506, 'มีดคัตเตอร์ 45L สก๊อตช์ (คละสี)', 49, '-', 66, '2024-02-23 02:17:19'),
(507, 'น้ำหมึกเติมตรายาง A-Line ขนาด 30 มล. (ชุด 2 ชิ้น)', 49, '-', 70, '2024-02-23 02:21:06'),
(508, 'คลิปดำ 15 มม. (กล่อง 12 ตัว) ตร้าม้า No.113', 49, '-', 80, '2024-02-23 02:22:39'),
(509, 'คลิปดำ 3/4 นิ้ว (กล่อง 12 ตัว) ตร้าม้า No.112', 49, '-', 80, '2024-02-23 02:27:02'),
(510, 'คลิปดำ 1 นิ้ว (กล่อง 12 ตัว) ตราม้า No.111', 49, '-', 80, '2024-02-23 02:28:33'),
(511, 'เทปลบคำผิดตราช้าง BEAM 5 มม. x 4ม.', 49, 'ช้าง BEAM', 70, '2024-02-23 02:33:47'),
(512, 'คลิปบอร์ดหนังเทียม A4 น้ำเงิน ออร์ก้า A-100', 49, 'ออร์ก้า A-100', 70, '2024-02-23 02:35:54'),
(513, 'คลิปบอร์ดพลาสติก A4 คละสี ONE', 49, '-', 70, '2024-02-23 02:37:21'),
(514, 'กรีนเนอร์โน้ต 3x3 นิ้ว(แพ็ค 4 เล่ม)', 49, '-', 68, '2024-02-23 02:40:03'),
(515, 'ชุดดินสอกด 0.5 มม. Rotring Tikky ( 2ชิ้น/แพ็ค)', 49, 'Rotring Tikky', 86, '2024-02-23 02:54:42'),
(516, 'แฟล็กซ์ 1.19 x 4.32 ซม. Post-it 684SH 30 แผ่น (แพ็', 49, '-', 68, '2024-02-23 03:00:27'),
(517, 'Post-it 683-5CF คละสี 5 สี 0.5 x 1.7 นิ้ว', 49, '-', 68, '2024-02-23 03:02:24'),
(518, 'สมุดทะเบียนส่ง A4 55 แกรม 80 แผ่น 777', 49, '-', 68, '2024-02-23 03:03:31'),
(519, 'สมุดลงทะเบียนส่ง A4 55 แกรม 80 แผ่น 777', 49, '-', 73, '2024-02-23 03:10:21'),
(520, 'กระดาษถ่ายเอกสาร A4 80 แกรม (แพ็ค 5 รีม) ไอเดีย เว', 49, '-', 68, '2024-02-23 03:12:00'),
(521, 'น้ำดื่มถัง', 49, '-', 82, '2024-02-23 03:24:45'),
(522, 'ฝาถัง', 49, '-', 72, '2024-02-23 03:25:44'),
(523, 'ตลับหมึกโทนเนอร์ HP 26A CF226A หมึกสีดำ', 49, '-', 80, '2024-02-23 03:29:13'),
(524, 'แฟลชไดร์ฟ Type-C 32GB ดำ', 49, 'Kingston DT80 ', 61, '2024-02-23 03:38:53'),
(525, 'Hub USB Type C(ORICO)มัลติพอร์ต 11 in 1 USB 3.0 HD', 49, '-', 72, '2024-02-23 03:41:03'),
(526, 'SanDisk Ultra 64 GB', 49, '-', 62, '2024-02-23 03:43:41'),
(527, 'กระดาษ A4 80 แกรม (แพ็ค5รีม) Double A ', 62, 'Double A ', 83, '2024-02-23 04:42:59'),
(530, 'pentel ปากกาเจล ขนาด 0.5 มม. สีน้ำเงิน แท่ง', 62, 'pentel', 65, '2024-02-23 04:45:30'),
(531, 'ปากกาลูกลื่น  0.5 มม. น้ำเงิน โหล', 62, '-', 71, '2024-02-23 04:48:31'),
(532, 'ถ่านอัลคาไลน์ AA (แพ็ค10ก้อน)ทอง Panasonic LR6T/10', 62, 'Panasonic', 86, '2024-02-23 04:51:03'),
(533, 'ถ่านอัลคาไลน์ PANASONIC รุ่นLR03t/6BN1F ขนาดAAA แพ', 62, 'PANASONIC', 86, '2024-02-23 04:56:15'),
(534, 'ซองขาว เบอร์ 9/125 AA (50ซอง)', 62, '-', 86, '2024-02-23 05:30:55'),
(535, 'ชูเปอร์สติกกี้โน้ต โพสต์-อิท 2027-SSGFA คละสี 3x3 ', 62, '-', 70, '2024-02-23 05:33:53'),
(536, 'กระดาษแฟล็กซ์ Post-it 683-4B ขนาด 0.5x1.7 (ม่วง เข', 62, '-', 70, '2024-02-23 06:02:14'),
(537, 'ซองเอกสารสีน้ำตาลแบบขยายข้างหนา 125 แกรมแพ็ค50 ใบ ', 62, '-', 86, '2024-02-23 06:04:31'),
(538, 'ไวนิล พับเจาะ ขนาด 190*900 cm.', 49, '-', 84, '2024-02-23 06:09:21'),
(539, 'ไวนิล พับเจาะ ขนาด 236*264 cm.', 49, '-', 84, '2024-02-23 06:10:32'),
(540, 'ไวนิล พับเจาะ ขนาด 170*390 cm.', 49, '-', 84, '2024-02-23 06:13:06'),
(541, 'ไวนิล พับเจาะ ขนาด 249*740 cm.', 49, '-', 84, '2024-02-23 06:14:25'),
(542, 'ไวนิล พับเจาะ ขนาด 50*220 cm.', 49, '-', 84, '2024-02-23 06:15:18'),
(543, 'ไวนิลตัดชิดขอบ ขนาด 116*116 cm.', 49, '-', 84, '2024-02-23 06:17:18'),
(544, 'ลูกบอลตกแต่ง', 49, '-', 68, '2024-02-23 06:25:03'),
(545, 'ของตกแต่ง', 49, '-', 68, '2024-02-23 06:25:46'),
(546, 'ดาวตกแต่ง ', 49, '-', 68, '2024-02-23 06:26:52'),
(547, 'ดิ้นเงิน-ดิ้นทอง', 49, '-', 68, '2024-02-23 06:28:07'),
(548, 'ริบบิ้นผ้า NO.2', 49, '-', 78, '2024-02-23 06:29:30'),
(549, 'ริบบิ้นผ้า NO.5', 49, '-', 78, '2024-02-23 06:32:16'),
(550, 'ริบบิ้นผ้า NO.3 ', 49, '-', 78, '2024-02-23 06:33:42'),
(551, 'เข็มหมุด', 49, '-', 80, '2024-02-23 06:34:52'),
(552, 'ปกใบประกาศนียบัตร', 49, '-', 68, '2024-02-23 06:37:20'),
(553, 'แล็คซีน 2 นิ้ว', 49, '-', 78, '2024-02-23 06:38:47'),
(554, 'แล็คซีน 3 นิ้ว', 49, '-', 78, '2024-02-23 06:49:39'),
(555, 'กระดาษปกใบประกาศนนียบัตร', 49, '-', 68, '2024-02-23 06:50:56'),
(556, 'คัตเตอร์ ตราช้าง', 49, '-', 72, '2024-02-23 06:51:54'),
(558, 'กรรไกร 8 นิ้ว', 49, '-', 72, '2024-02-23 06:53:03'),
(559, 'คลิบดำ No.111', 49, '-', 80, '2024-02-23 06:55:12'),
(560, 'ตรายางวันที่', 49, '-', 72, '2024-02-23 06:57:16'),
(561, 'ใบประกาศ ', 49, '-', 72, '2024-02-23 06:59:24'),
(562, 'Rolton K300 ไมค์ช่วยสอน ลำโพงพกพา', 49, '-', 62, '2024-02-23 07:07:00'),
(563, 'HP Smart Tank 750/720/670 หมึกแท้ GT53K สีดำ', 49, '-', 61, '2024-02-23 07:11:16'),
(564, 'HP Smart Tank 750/720/670 หมึกแท้ GT52 สีฟ้า', 49, '-', 80, '2024-02-23 07:15:20'),
(565, 'HP Smart Tank 750/720/670 หมึกแท้ GT52 สีชมพู', 62, '-', 80, '2024-02-23 07:18:09'),
(566, 'HP Smart Tank 750/720/670 หมึกแท้ GT52 สีเหลือง', 49, '-', 80, '2024-02-23 07:20:16'),
(567, 'Disney หุฟังบลูทูธไร้สาย ของแท้(หมีพูห์)', 49, '-', 69, '2024-02-23 07:28:56'),
(568, 'ปากกาไวท์บอร์ด หัวกลม(แพ็ค12ด้าม)น้ำเงินไพล็อต', 49, '-', 68, '2024-02-23 07:33:03'),
(569, 'ปากกาไวท์บอร์ด หัวกลม(แพ็ค12ด้าม) ดำ ไพล็อต', 49, '-', 68, '2024-02-23 07:35:15'),
(570, 'ปากกาไวท์บอร์ดหัวกลม(แพ็ค12ด้าม) แดงไพล็อต', 49, '-', 68, '2024-02-23 07:36:35'),
(571, 'ซองเอกสารน้ำตาล KA 555 สีน้ำตาล 9x12 3/4 นิ้ว(แพ็ค', 49, '-', 68, '2024-02-23 07:39:53'),
(572, 'กระดาษถ่ายเอกสาร กรีน Double A A4 80แกรม ', 49, '-', 80, '2024-02-23 07:41:15'),
(573, 'ปากกา Pentel Energel รุ่น BLN75 0.5 สีดำ', 49, 'Pentel', 65, '2024-02-23 07:46:40'),
(574, 'ปากกา Pentel Energel รุ่น BLN75 0.5 สีน้ำเงิน', 49, 'Pentel', 65, '2024-02-23 07:50:48'),
(575, 'ปากกา Pentel Energel รุ่น BLN75 0.5 สีแดง', 49, 'Pentel', 65, '2024-02-23 07:52:21'),
(576, 'ปากกาน้ำเงิน Pentel 0.7 mm ball', 62, 'Pentel', 65, '2024-02-23 07:55:14'),
(577, 'ปากกาน้ำเงิน Pentel 0.5 mm ball ', 62, 'Pentel', 65, '2024-02-23 07:56:27'),
(578, 'ปากกาลูกลื่น ตราช้าง Drift Torio หมึกน้ำเงิน(คละสี', 62, '-', 71, '2024-02-23 07:58:57'),
(579, 'หมึกเครื่องพิมพ์ brother LC3617C', 62, 'brother', 74, '2024-02-23 08:00:29'),
(580, 'หมึกเครื่องพิมพ์ brother LC3617M', 62, 'brother', 74, '2024-02-23 08:01:49'),
(581, 'หมึกเครื่องพิมพ์ brother LC3617Y', 62, 'brother', 74, '2024-02-23 08:03:28'),
(582, 'หมึกเครื่องพิมพ์ brother LC361BK', 62, 'brother', 74, '2024-02-23 08:04:38'),
(583, 'Laser Pointer LOGITECH', 62, '-', 69, '2024-02-23 08:05:45'),
(584, 'แผ่นพับหลักสูตรแบบการเรียนรู้คู่การทำงานฯ', 62, '-', 85, '2024-02-23 08:08:21'),
(585, 'ใบปลิวสาขาวิชาสารสนเทศศาสตร์', 49, '-', 85, '2024-02-23 08:10:08'),
(586, 'แผ่นพับแนะนำคณะวิทยาการสารสนเทศ', 49, '-', 85, '2024-02-23 08:11:13'),
(587, 'Converter  Type-C 9in1 UGREEN(15600)', 62, 'UGREEN', 62, '2024-02-23 08:16:26'),
(588, 'ที่ชาร์จ MagSafe', 62, '-', 62, '2024-02-23 08:17:59'),
(589, '[Metal] UGREEN Vertical Laptop Stand Adjustable fo', 62, 'UGREEN', 62, '2024-02-23 08:21:07'),
(590, '2 TB SSD M.2 PCle 4.0 HIKSEMI FUTURE(HS-SSD-FUTURE', 62, 'HIKSEMI', 62, '2024-02-23 08:25:07'),
(591, 'Converter Type-C To HDMI+USB 3.0 GLINK GL007C', 63, 'GLINK', 62, '2024-02-23 08:27:17'),
(592, 'Apple Air tag', 62, 'Apple', 62, '2024-02-23 08:28:56'),
(593, '10-in-1 Hub USB C Hard Drive M.2 SSD Enclos', 49, 'ACASIS', 61, '2024-02-23 08:30:41'),
(594, '1TB SSD M.2 PCle 4.0 NM710 NVME', 62, 'LEXAR', 62, '2024-02-23 08:32:05'),
(595, 'Adapter Microsoft Surface Charger ชาร์จได้ Pro3 44', 62, '-', 62, '2024-02-23 08:33:39'),
(596, 'WD HDD Ext 2 TB My Passport Ultra Type C Silver', 62, '-', 62, '2024-02-23 08:37:25'),
(597, 'หูฟังไร้สาย Sony Headphone with Mic Wireless WH-CH', 62, 'Sony', 62, '2024-02-23 08:40:55'),
(598, '1TB SSD M.2 PCle4.0  FUTURE ECO(HS-SSD-FUTU', 62, 'HIKSEMI', 62, '2024-02-23 08:47:01'),
(599, 'USB KEYBOARD LECOO KB103 BLACK BY LENOVO', 62, 'LENOVO', 62, '2024-02-23 08:48:26'),
(600, 'BLUETOOTH/WIRELLESS MOUSE LOGITECH LIFT VERTICAL E', 62, 'LOGITECH', 62, '2024-02-23 09:05:04'),
(601, 'PAD SIGNO E-SPORT MT 330 AREAS-3 SPEED GAMING', 62, 'SIGNO', 62, '2024-02-23 09:06:47'),
(602, 'USB MOUSE HP M160 BLACK ', 62, '-', 62, '2024-02-23 09:07:49'),
(603, 'หูฟัง ข้างซ้าย(L) Airpod Gen2 (หมายเลขรุ่นA2031)', 62, '-', 62, '2024-02-23 09:12:00'),
(604, 'UGREEN USB-C to HDMI Thanderbolt 3 Connecter 4K Gr', 62, 'UGREEN', 62, '2024-02-23 09:23:39'),
(605, 'Apple อะแดปเตอร์แปลงไฟ USB-C ขนาด 20 วัตต์', 62, 'Apple', 62, '2024-02-23 09:25:23'),
(606, '4G Router TP-LINK (Archer MR400) Wireless AC1200 D', 62, 'Archer', 62, '2024-02-27 01:57:10'),
(607, 'EarPods( หัวเสียบหูฟังขนาด 3.5 มม. ) ', 62, '-', 62, '2024-02-27 02:00:20'),
(608, 'COOLING PAD(อุปกรณ์ระบายความร้อนโน๊ตบุ๊ค) COOLER M', 62, '-', 62, '2024-02-27 02:02:52'),
(609, 'RECHARGEABLE BATTERY(ถ่านชาร์จ)PANASONIC ENELOOP A', 49, 'ENELOOP', 86, '2024-02-27 02:04:46'),
(610, 'DNIO A6140C 140W การชาร์จเร็วสุดๆ 6 พอร์ต อะแดปเตอ', 62, 'ldnio', 62, '2024-02-27 02:07:50'),
(611, 'SANDISK micro SD 1TB รุ่น SDSQUAC-1T00-GN6MN', 62, 'SANDISK', 62, '2024-02-27 02:10:43'),
(612, 'SANDISK Micro SD 512 GB รุ่น SDSQUAC-512G-GN6MN', 62, 'SANDISK', 62, '2024-02-27 02:13:14'),
(613, 'หูฟังไร้สาย AirPods(2nd gen)', 62, '-', 62, '2024-02-27 02:16:08'),
(614, 'แท่นวางโน๊ตบุ๊คเพื่อสุขภาพ', 62, '-', 62, '2024-02-27 02:16:55'),
(615, '1TB SSD SAMSUNG 990 PRO (M.2)', 62, 'SAMSUNG', 62, '2024-02-27 02:18:21'),
(616, 'AUKEY OMNIA MIX3 90W 3-PORT PD GAN CHARGER (ADAPTE', 62, 'AUKEY', 62, '2024-02-27 02:19:54'),
(617, 'Eloop E57 Built-in cable Fast Charge powerbank 100', 62, 'Eloop', 62, '2024-02-27 02:24:49'),
(618, 'NVR 8CH. VIG#NVR1008H', 62, '-', 62, '2024-02-27 03:00:22'),
(619, 'Acasis แท่นชาร์จ USB-C (15-in-1) สำหรับแล็ป USB-C ', 62, 'ACASIS', 62, '2024-02-27 05:20:01'),
(620, '1 TB SSD SATA CITY SSD E100(STD) (HS-SSD-E', 62, 'HIKSEMI', 62, '2024-02-27 05:30:03'),
(621, 'ปากกาลูกลื่นควอนตั้ม 007 Max 0.7มม. สีน้ำเงิน', 62, 'Max', 80, '2024-03-01 01:59:15'),
(622, 'เทปลบคำผิด', 62, '-', 71, '2024-03-01 02:01:30'),
(623, 'WEBCAM SINGNO(WB400)', 62, 'SINGNO', 69, '2024-03-01 02:03:10'),
(624, 'กล้อง webcam 4k oker a538(โต๊ะประชุม 1 ตัว)', 62, '-', 69, '2024-03-01 02:04:50'),
(625, 'มีดคัตเตอร์ 45L ฟ้า XP002024105', 62, 'สก๊อตช์', 72, '2024-03-01 08:32:28'),
(626, 'กระดาษทำปก 160 แกรม ขาว (แพ็ค50แผ่น)', 62, 'KTV ACQ', 68, '2024-03-01 08:35:57'),
(627, 'แลคซีน 3 นิ้ว สีดำ', 62, '-', 78, '2024-03-01 08:39:24'),
(628, 'เทปใสกว้าง 2 นิ้ว ', 62, '-', 83, '2024-03-01 08:41:08'),
(629, 'สมุดโน้ตสันห่วง', 62, '-', 73, '2024-03-01 08:46:30'),
(630, 'กาว 2 หน้า ขนาด 8 มิล ', 62, '-', 78, '2024-03-01 09:13:45'),
(631, 'ปลั๊กไฟ 3 ตา', 62, 'Toshino', 72, '2024-03-01 09:15:12'),
(632, 'Flash Drive USC3.2 32GB', 62, '-', 72, '2024-03-01 09:18:39'),
(633, 'คลิปบอร์ด A4', 62, '-', 72, '2024-03-01 09:19:44'),
(634, 'เครื่องเย็บกระดาษเบอร์ 10 ', 62, '-', 72, '2024-03-01 09:21:44'),
(635, 'เครื่องเย็บกระดาษเบอร์ 35', 62, '-', 72, '2024-03-01 09:22:39'),
(636, 'แท่นดึงเทปใส', 49, '-', 72, '2024-03-01 09:23:46'),
(637, 'fujifilm CT203490 M ตลับหมึกโทนเนอร์ สีม่วงของแท้(', 49, 'fujifilm', 74, '2024-03-01 09:28:12'),
(638, 'fujifilm CT203493 Y ตลับหมึกโทนเนอร์ สีเหลือง ของแ', 62, 'fujifilm', 74, '2024-03-01 09:31:30'),
(639, 'กระดาษถ่ายเอกสารถนอมสายตา A4 80แกรม', 49, 'Green Read', 61, '2024-03-04 01:52:48'),
(640, '64 GB SD CARD(เอสดีการ์ด)SANDISK EXTREME PRO SDXC ', 49, 'SANDISK EXTREME PRO SDXC UHS-I CARD (SDSDXXU-064G-GN4IN)', 72, '2024-03-04 02:06:03'),
(641, 'ถ่านอัลคาไลน์ AAA (แพ็ค 12 ก้อน)Pana sonic LR03T/1', 49, '-', 68, '2024-03-04 02:08:02'),
(642, 'ถ่านพานาโซนิคอัลคาไลน์ LR6T/2B Size AA 12แพ็ค x 24', 49, 'Panasonic Alkaline Bettery LR6T/2B Size AA', 86, '2024-03-04 02:13:05'),
(643, 'ถ่านธรรมดา Panasinic AA R6NT แพ็ค 4 ก้อน สีดำ', 49, '-', 86, '2024-03-04 02:18:18'),
(644, 'ถ่านกระดุมลิเธี่ยม Panasonic CR-2032 (แผง5ก้อน)', 49, '-', 76, '2024-03-04 02:19:53'),
(645, 'Sony WH-1000XM4 Wireless Headphone หูฟังไร้สาย ระบ', 49, '-', 62, '2024-03-04 02:22:09'),
(646, 'คลิปบอร์ดสีพาสเทล คลิปบอร์ด พลาสติก แผ่นรองเขียน', 49, '-', 62, '2024-03-04 03:00:01'),
(647, 'สายชาร์จ/ซิงค์', 49, 'Aukey 1.8M USB C to USB C Quick charge 3.0 durable Braided Nylon cable', 62, '2024-03-04 03:12:30'),
(648, 'พาวเวอร์แบงค์ แบตเตอร์รี่สำรอง', 49, 'Remex RPP-552 20000mAh', 62, '2024-03-04 03:20:48'),
(649, 'Powerbank 10000 mAh Fast Charge PD 20W สีขาว', 49, 'ELOOP EW52 Magnetic', 62, '2024-03-04 03:24:00'),
(651, 'การ์ดเอสเอสดี', 49, 'Corsair SSD MP 600 MIni 1TB', 62, '2024-03-04 03:32:06'),
(652, 'ฮาร์ดดิสภายนอก SSD การเชื่อมต่อ USB 3.2 ความเร็วเข', 49, '-', 62, '2024-03-04 03:34:00'),
(653, 'ปากาเจล หัวขนาด0.5 น้ำหมึกน้ำเงิน', 49, 'Pentel Energel Clena รุ่น BLN75', 66, '2024-03-04 03:43:55'),
(654, 'ปากกาเจล เพนเทล สีน้ำเงิน 0.6มม', 49, 'Pentel  K116-C', 66, '2024-03-04 03:50:19'),
(655, 'Glue tape เทปกาวสองหน้าแบบตลับ ตราช้าง', 49, '-', 62, '2024-03-04 03:56:12'),
(656, 'เครื่องเย็บกระดาษ', 49, 'ตราช้าง HS-E10', 62, '2024-03-04 03:57:30'),
(657, 'เทปลบคำผิดตราช้าง เพอเฟคโต้ 5 มม. x 6ม.', 49, 'ตราช้าง เพอเฟคโต้', 62, '2024-03-04 04:17:25'),
(658, 'กระดาษโน๊ตมีกาว Post-it Flags', 49, '-', 62, '2024-03-04 04:18:34'),
(659, 'กาวแท่ง8.2กรัม ขาว UHU 185 ', 49, '-', 65, '2024-03-04 04:24:51'),
(660, 'ไม้บรรทัดอะลูมิเนียมคาดสี P.K. ขนาด 12 นิ้ว คละสี ', 49, '-', 72, '2024-03-04 04:32:48'),
(661, 'กาว 3M กาว 2 หน้า เทปโฟมกาวสองหน้า 12มม. x 2ม.', 49, '-', 72, '2024-03-04 04:34:28'),
(662, 'HP 93A Black Original Laserjet Toner Cartridge', 49, '-', 80, '2024-03-04 04:43:35'),
(663, 'แพลนบอร์ด 3mm.A3(แพ็ค 6 แผ่น) ดำพีโอเอฟ', 49, '-', 70, '2024-03-04 04:49:32'),
(664, 'สีไม้ 36 สี มาสเตอร์อาร์ต', 49, 'มาสเตอร์อาร์ต รุ่น MANGA ', 70, '2024-03-04 04:56:40'),
(665, 'บอร์ดเกม 7 สิ่งมหัศจรรย์ ', 62, '-', 62, '2024-03-04 04:57:55'),
(666, 'บอร์ดเกมต่อรถตะลุยนิวยอร์ก', 62, '-', 62, '2024-03-04 06:00:00'),
(667, 'ถาดอเนกประสงค์ 4 ช่อง ดำ', 49, '-', 62, '2024-03-04 06:01:14'),
(668, 'สก๊อตช์ 3M เทปใส รุ่น 600 12mm x 66mm', 49, '-', 62, '2024-03-04 06:08:40'),
(669, 'ปลั๊กไฟสี - 4ช่อง 2 USB 5สวิทช์(สี) สายไฟยาว 3 เมต', 49, 'Randy 889UC-3M ', 62, '2024-03-04 06:10:37'),
(670, 'ปลั๊กไฟ มอก. 3680W 6 ช่อง รับกำลังไฟสูง ปลั๊กไฟยาว', 49, 'Randy', 62, '2024-03-04 06:11:33'),
(671, 'ไฟไลฟ์สด LED 10W ขาว ', 49, 'Remax- RL-LT17 ', 70, '2024-03-04 06:15:40'),
(672, 'ปากกาเน้นข้อความลบได้คละสี(แพ็ค6) ไพล็อต', 49, 'SFL-60SL-6CN 270', 86, '2024-03-04 06:17:03'),
(673, 'สีชอล์ค Pentel 50สี oil pastels ', 49, '-', 80, '2024-03-04 06:18:14'),
(674, 'สีชอล์ค Pentel 12สี oil pastels ', 49, '-', 80, '2024-03-04 06:18:57'),
(675, 'กระดาษโปสเตอร์สีแข็งหน้าเดียว ( 50 แผ่น )', 49, '-', 70, '2024-03-04 06:26:52'),
(676, 'SSD 870 EVO SATA III 2.5 inch', 49, '-', 87, '2024-03-04 06:28:26'),
(677, 'DDR4(2400) 8GB Kingston (Hyper-X/HX424C15FB2/8)', 49, '-', 87, '2024-03-04 06:29:21'),
(678, 'กาวแท่งเล็ก 7x150 มม. สีใส (ห่อละ 1 กก.)', 49, 'เอนี่บอนด์ ', 70, '2024-03-04 06:30:14'),
(679, 'สายไฟพ่วง ปลั๊กพ่วงสนาม 10 เมตร ', 49, '-', 70, '2024-03-04 06:32:03'),
(681, 'เหล็ก Solid Adapter สกรู 1/4 ถึง 3/8', 49, 'ขาตั้งกล้องขาตั้งแฟลช Light Stand New Iron Solid Adapter Screw 1/4 to 3/8', 70, '2024-03-04 06:33:25'),
(682, 'กล่อง Apple Box 1 ชุด', 49, '-', 70, '2024-03-04 06:34:07'),
(683, 'ถุงทรายถ่วงขาไฟ ถุงทรายถ่วงน้ำหนัก Sand Weight Bag', 49, '-', 88, '2024-03-04 06:36:33'),
(684, 'กระเป๋าขาตั้งไฟ', 49, '-', 64, '2024-03-04 06:38:16'),
(685, 'แบตเตอรี่กล่อง ', 49, 'Sony A6500  NP-FW50 ', 67, '2024-03-04 06:39:43'),
(686, 'ชุดอุปกรณ์แต่งหน้า', 49, '-', 70, '2024-03-04 06:41:05'),
(687, 'SSD Enclosure M.2 SATA NVME/NGFF กล่องใส่ SSD USB ', 49, 'UGREEN (CM400) ', 72, '2024-03-04 06:43:01'),
(688, 'SSD Samsung 980 PRO PCle 4.0 NVMe M.2 Internal Sol', 49, '-', 87, '2024-03-04 06:43:49'),
(689, 'หูฟังบลูทูธ', 49, '-', 62, '2024-03-04 06:48:08'),
(690, 'ลำโพงบลูทูธ', 49, '-', 62, '2024-03-04 06:48:54'),
(691, 'เมาส์ปากกา ', 49, '-', 62, '2024-03-04 06:49:34'),
(692, 'ดินสอ rotring ', 49, '-', 70, '2024-03-04 06:50:25'),
(693, 'เมาส์ไร้สาย', 49, '-', 69, '2024-03-04 06:51:08'),
(694, 'ALFA AWUS036ACS Wireless AC600 USB Adepter', 62, 'ALFA', 62, '2024-03-04 06:53:09'),
(695, 'TP-LINK Wireless USB Adebter ', 61, 'รุ่น Archer T2U Plus AC600 Dual Band High Power', 62, '2024-03-04 06:56:56'),
(696, 'COMFAST รุ่นCF-953AX 1800bps wifi 6 USB Adapter', 49, '-', 62, '2024-03-04 07:00:28'),
(697, 'แบตเตอรี่ลิเธียมแบบชาร์จไฟ 12 v 6Ah พร้อม BMS แบตเ', 49, '-', 62, '2024-03-04 07:03:47'),
(698, 'แบตเตอรี่โน๊ตบุ๊ค ', 61, 'Toshiba Portege Z830 Z835', 62, '2024-03-04 07:08:12'),
(699, 'อะแดปเตอร์ Toshiba Poryege', 61, 'Toshiba Poryege', 62, '2024-03-04 07:09:52'),
(700, 'พัดลม  Toshiba Z830 Z835', 61, '-', 62, '2024-03-04 07:11:15'),
(701, 'ผ้าไฮเกรด', 49, '-', 89, '2024-03-04 07:13:48'),
(702, 'ผ้าต่วน', 49, '-', 78, '2024-03-04 07:14:40'),
(703, 'ธงราวสามเหลี่ยมแบบผ้าสีขาวสลับสีน้ำเงิน', 49, '-', 90, '2024-03-04 07:18:08'),
(704, 'สกรูไม้สีดำ น๊อตดำเกลียวดำ', 49, '-', 68, '2024-03-04 07:21:41'),
(705, 'สกรูไม้สีดำ น๊อตดำเกลียวดำ', 49, '-', 68, '2024-03-04 07:21:41'),
(706, 'สกรูไม้สีดำ น๊อตดำเกลียวดำ', 49, '-', 68, '2024-03-04 07:21:41'),
(707, 'สกรูไม้สีดำ น๊อตดำเกลียวดำ', 49, '-', 68, '2024-03-04 07:21:41'),
(708, 'สกรูไม้สีดำ น๊อตดำเกลียวดำ', 49, '-', 68, '2024-03-04 07:21:41'),
(709, 'เคเบิ้ลไทร์สีดำ', 49, '-', 68, '2024-03-04 07:23:01'),
(710, 'สกรูเกลียวปล่อยหัวF', 49, '-', 68, '2024-03-04 07:24:22'),
(711, 'แผงกั้นจราจร ', 49, '-', 72, '2024-03-04 07:25:06'),
(712, 'ลวด 1.5 มิล ', 49, '-', 78, '2024-03-04 07:25:47'),
(713, 'ลวด1.24มิล', 49, '-', 78, '2024-03-04 07:26:51'),
(714, 'สีทาถนน', 49, '-', 91, '2024-03-04 07:28:07'),
(715, 'ลวดขาวเบอร์ 8 ', 49, '-', 78, '2024-03-04 07:28:57'),
(716, 'คีมปากแหลม ', 49, '-', 72, '2024-03-04 07:29:38'),
(717, 'แผ่นโฟมเมก้า', 49, '-', 85, '2024-03-04 07:30:26'),
(718, 'สกรูเกลียว', 49, '-', 88, '2024-03-04 07:31:11'),
(719, 'แปรงทาสี 4 นิ้ว ', 49, '-', 72, '2024-03-04 07:32:13'),
(720, 'ลูกลอยไฟฟ้า', 49, '-', 72, '2024-03-04 07:32:58'),
(721, 'ปูนซีเมนต์สำเร็จรูป', 49, '-', 92, '2024-03-04 07:34:26'),
(722, 'หมึก HP76 A', 49, '-', 80, '2024-03-04 07:35:50'),
(723, 'หมึก HP136 A', 49, '-', 80, '2024-03-04 07:36:42'),
(724, 'หมึก HP37 A', 49, '-', 80, '2024-03-04 07:37:35'),
(725, 'หมึก HP85 A', 49, '-', 80, '2024-03-04 07:38:29'),
(726, 'กระดาษ |Dea work 80 แกรม', 49, '-', 61, '2024-03-04 07:39:39'),
(727, 'คลิปดำเบอร์108', 49, '-', 80, '2024-03-04 07:40:23'),
(728, 'คลิปดำเบอร์109', 49, '-', 80, '2024-03-04 07:41:09'),
(729, 'ปากกาเพนเทล', 49, '-', 80, '2024-03-04 07:42:38'),
(730, 'น้ำยาลบคำผิด', 49, '-', 72, '2024-03-04 07:43:33'),
(731, 'ฟิวเจอร์บอร์ด ', 49, '-', 85, '2024-03-04 07:44:11'),
(732, 'คลิปดำใหญ่จัมโบ้ ', 49, '-', 72, '2024-03-04 07:45:13'),
(733, 'ธงตั้งโต๊ะ', 49, '-', 72, '2024-03-04 07:45:59'),
(734, 'ธงชาติไทย', 49, '-', 93, '2024-03-04 07:47:16'),
(735, 'ธงวปร', 49, '-', 93, '2024-03-04 07:47:53'),
(736, 'แปรงขัดส้วม', 49, '-', 72, '2024-03-04 07:49:10'),
(737, 'ถุงมือส้ม', 49, '-', 71, '2024-03-04 07:49:52'),
(738, 'ผงซักฟอก', 49, '-', 68, '2024-03-04 07:50:59'),
(739, 'ถุงขยะ 30*40', 49, '-', 89, '2024-03-04 07:51:48'),
(740, 'ถุงขยะ 22*30 ', 49, '-', 89, '2024-03-04 07:52:37'),
(741, 'น้ำยาเช็ดกระจก', 49, '-', 77, '2024-03-04 07:53:21'),
(742, 'ไม้ขนไก่', 49, '-', 72, '2024-03-04 07:54:06'),
(743, 'ไม้กวาดเอ็น', 49, '-', 72, '2024-03-04 07:54:45'),
(744, 'ถังน้ำสีดำ', 49, '-', 64, '2024-03-04 07:55:24'),
(745, 'สก็อตไบร์ท', 49, '-', 72, '2024-03-04 07:56:04'),
(746, 'ไม้กววาดหยักไย่', 49, '-', 72, '2024-03-04 07:56:48'),
(747, 'ไม้ดันฝุ่นด้ามยาว ', 49, '-', 72, '2024-03-04 07:57:33'),
(748, 'ไม้กวาดทางมะพร้าว', 49, '-', 72, '2024-03-04 07:58:20'),
(749, 'ทิชชู่ห้องน้ำม้วนใหญ่', 49, '-', 72, '2024-03-04 07:59:21'),
(750, 'เจลน้ำหอม', 49, '-', 72, '2024-03-04 07:59:53'),
(751, 'น้ำยาล้างจาน', 49, '-', 94, '2024-03-04 08:01:36'),
(752, 'สเปรย์ปรับอากาศ', 49, '-', 91, '2024-03-04 08:02:27'),
(753, 'น้ำยาล้างห้องน้ำ', 49, '-', 94, '2024-03-04 08:03:35'),
(754, 'สบู่เหลวล้างมือ', 49, '-', 94, '2024-03-04 08:04:31'),
(755, 'เทปใสแกนใหญ่', 49, '-', 78, '2024-03-04 08:05:07'),
(756, 'เทปโฟม 3 M ', 49, '-', 78, '2024-03-04 08:05:59'),
(757, 'UGREEN 40234 HAMI Switch 4 K3 inpput', 49, 'UGREEN', 62, '2024-03-04 08:07:50'),
(758, 'Cable HDMI 4k', 49, '-', 90, '2024-03-04 08:08:32'),
(759, 'WL009 rx ตัวรับ receiver', 49, '-', 70, '2024-03-04 08:09:33'),
(760, 'WL009 rx ตัวรับ receiver', 49, '-', 70, '2024-03-04 08:09:33'),
(761, 'WL009 set ตัวส่งตัวรับอะแดปเตอร์รับส่งสัญญานวิดิโอ', 49, '-', 70, '2024-03-04 08:11:20'),
(762, 'Cable Extension USB3 M/F 3M', 49, '-', 90, '2024-03-04 08:12:38'),
(763, 'Cable Soun USB to RCA femaie', 49, '-', 90, '2024-03-04 08:13:36'),
(764, 'สายรัดสเตอดิโอ 5.35มม -35มมม', 49, '-', 90, '2024-03-04 08:14:47'),
(765, 'AV 169 6.5mm Maie to RCA Femaie', 49, '-', 62, '2024-03-04 08:15:56'),
(766, 'Cable Splitter with mic 3.5 AUX Audio', 49, '-', 62, '2024-03-04 08:17:35'),
(767, 'HD 134 HDMI 2.0/1.4k HDMI high speed 18 Gbps', 49, '-', 62, '2024-03-04 08:19:24'),
(768, 'USB 2.0 male to male cable', 49, '-', 62, '2024-03-04 08:20:42'),
(769, 'ถ่านกระดุม Sony CR2025', 49, '-', 76, '2024-03-04 08:21:49'),
(770, 'USB Mouse lositech B 100 black', 49, '-', 62, '2024-03-04 08:25:01'),
(771, 'USB Keyboard lecco kb 101 black', 49, '-', 62, '2024-03-04 08:26:05'),
(772, '480 GB SSD SATA APACER AS340', 49, '-', 62, '2024-03-04 08:28:21'),
(773, 'ตะกั่วบัดกรี ULTRACORE ALLOY 60/40', 49, '-', 62, '2024-03-04 08:29:42'),
(774, 'CAT6 UTP Cabie', 49, '-', 80, '2024-03-04 08:30:37'),
(775, 'หัวแร้งบัดกรี', 49, '-', 62, '2024-03-04 08:31:20'),
(776, '4TB HDD SEAGATE IRONWOLF', 49, '-', 62, '2024-03-04 08:34:25'),
(777, '32GB flash Drive Sandisk Ulter', 49, '-', 62, '2024-03-04 08:36:46'),
(778, 'ชุดคีมอเนกประสงค์ 4 ชิ้น', 49, '-', 70, '2024-03-04 08:38:10'),
(779, 'ชุดไขควงด้ามหุ้มยาง 8 ชิ้น', 49, '-', 70, '2024-03-04 08:39:12'),
(780, 'ชุดประแจหกเหลี่ยม', 49, '-', 70, '2024-03-04 08:40:59'),
(781, 'ชุดประแจหกเหลี่ยมท๊อกมีรู', 49, '-', 70, '2024-03-04 08:42:03'),
(782, 'รางงปลั๊กไฟ5ช่อง', 49, '-', 70, '2024-03-04 08:42:50'),
(783, 'Power Color Redeon R7 240', 49, '-', 70, '2024-03-04 08:44:23'),
(784, 'CAT5E UTP Cable (305m/Box)', 49, '-', 62, '2024-03-04 08:47:41'),
(785, 'CAT6 UTP Cable(305m/box)', 62, '-', 62, '2024-03-04 08:53:41'),
(786, 'RJ45 CAT5 100/Pack', 62, '-', 86, '2024-03-04 08:54:51'),
(787, 'RJ45 CAT6 50/Pack', 62, '-', 86, '2024-03-04 08:57:18'),
(788, 'GLINK สายไฟเบอร์ออฟติก 1 Core SM 1KM(มีสลิง)', 62, '-', 62, '2024-03-04 08:59:36'),
(789, 'ชุดเครื่องมือเข้าหัวไฟเบอร์ออฟติก (กระเป๋าใหญ่)', 62, '-', 80, '2024-03-04 09:01:50'),
(790, 'คีมปอกสายไฟเบอร์ออฟติกสแตนเลส Comptyco รุ่น VCFS-3', 62, 'Comptyco รุ่น VCFS-30', 62, '2024-03-04 09:04:26'),
(791, 'GLINK หัวไฟเบอร์ออฟติก SC/UPC รุ่น GLF-132B', 62, '-', 62, '2024-03-04 09:06:42'),
(792, 'UGREEN รุ่น cm204 usb to rj45 console cable ขนาด 1', 62, 'UGREEN ', 62, '2024-03-04 09:09:12'),
(793, 'CAT6 UTP Cable(100m/Box)', 62, '-', 62, '2024-03-04 09:12:09'),
(794, 'หัวแลน แบบทะลุ Cat6 บรรจุ 100ชิ้น', 62, '-', 62, '2024-03-04 09:14:02'),
(795, 'TP-LINK Gigabit Switching Hub 8 port รุ่นTL-SG1008', 62, '-', 62, '2024-03-04 09:20:13'),
(796, 'TP-LINK Switching Hub 6 port รุ่นTL-SF1006P', 62, '-', 62, '2024-03-04 09:21:57'),
(797, 'Texas Instrument SN74HC08N,Quad 2-input AND Logic ', 62, 'Texas', 62, '2024-03-04 09:24:37'),
(798, 'Texas Instrument SN74HC00N,Quad 2-input NAND Logic', 62, '-', 62, '2024-03-04 09:26:18'),
(799, 'Texas Instrument SN74HC32N,Quad 2-input OR Logic', 62, '-', 62, '2024-03-04 09:27:34'),
(800, 'Texas Instrument SN74HC86N,Quad 2-input XOR Logic', 62, '-', 62, '2024-03-04 09:28:50'),
(801, 'Texas Instrument SN7402N,Quad 2-input NOR Logic', 62, '-', 62, '2024-03-04 09:30:21'),
(802, 'CD4069 Six CMOS inverter Circuits(Not gate) IC Chi', 62, '-', 62, '2024-03-04 09:32:28'),
(803, 'กลอนไฟฟ้า กลอนลิ้นชักไฟฟ้า 12V DC หัวกลม สลักนอก', 62, '-', 62, '2024-03-05 01:45:07'),
(804, 'Esp-32 cam + โมดูลอัพโหลด(บอร์ดที่เสียบข้างหลัง)', 62, '-', 62, '2024-03-05 01:46:13'),
(805, 'Esp-32 wifi Bluetooth', 62, '-', 62, '2024-03-05 01:47:08'),
(806, '2-way angle tilt dumping sensor module เซ็นเซอร์คว', 62, '-', 62, '2024-03-05 01:48:21'),
(807, 'จอ TFT แบบสัมผัส สื่อสารแบบ SPI 2.8-inch SPI LCD', 62, '-', 62, '2024-03-05 01:49:42'),
(808, 'บ้านตุ๊กตา DIY ประกอบเอง บ้านจีน รุ่น Bamboo Creek', 62, '-', 95, '2024-03-05 01:53:14'),
(809, 'Rocker Switch 4 PIN', 62, '-', 62, '2024-03-05 01:54:37'),
(810, 'เร้าเตอร์ใส่ซิม Totolink Network LR1200', 62, '-', 62, '2024-03-05 01:56:58'),
(811, 'MQ-3 Alcohol Sensor (ตรวจจับ แอลกอฮอล์ ในลมหายใจ)', 62, '-', 62, '2024-03-05 01:57:59'),
(812, 'เซ็นเซอร์วัดระดับน้ำแบบไม่ต้องจุ่มน้ำ', 62, '-', 62, '2024-03-05 01:59:00'),
(813, 'เซ็นเซอร์ตรวจจับเสียง Sound Sensor Module (Condens', 62, '-', 62, '2024-03-05 01:59:43'),
(814, 'Speak Recognition Voice Recognition Module', 62, '-', 62, '2024-03-05 02:01:08'),
(815, 'DHT22 AM2302 เซ็นเซอร์วัดอุณภูมิและความชื้น สำหรับ', 62, '-', 62, '2024-03-05 02:02:04'),
(816, 'Fingerprint Sensor เซ็นเซอร์สแกนลายนิ้วมือ AS608 J', 62, '-', 62, '2024-03-05 02:02:52'),
(817, 'Mini Pump 3-5V small pump ปั๊มน้ำขนาดเล็ก 3-5V แนว', 62, '-', 62, '2024-03-05 02:04:41'),
(818, 'สายยางอ๊อกซิเจน อุปกรณ์ตู้ปลา', 62, '-', 62, '2024-03-05 02:05:20'),
(819, 'โมดูลรีเลย์ relay 5v relay Module', 62, '-', 62, '2024-03-05 02:06:13'),
(820, 'Magic Keyboard พร้อม Touch ID สำหรับ Mac (ดำ)', 62, '-', 62, '2024-03-05 02:07:07'),
(821, 'Magic Trackped', 62, '-', 62, '2024-03-05 02:09:06'),
(822, '1 TB SSD M.2 PCIe 4.0 KINGSTON KC3000 (SKC3000S/10', 62, '-', 62, '2024-03-05 02:10:07'),
(823, 'Magic Mouse', 62, '-', 62, '2024-03-05 02:10:48'),
(824, 'Magic Keyboard พร้อม Touch ID สำหรับ Mac', 62, '-', 62, '2024-03-05 02:11:49'),
(825, 'Power Bar LUMIRA LS-803 (3M) White/Green', 62, '-', 62, '2024-03-05 02:12:32'),
(826, 'หูฟังไร้สาย Sony Float Run WI-OE610 Off-Ear Wirele', 62, '-', 62, '2024-03-05 02:14:26'),
(827, 'SONY NW-WS623 หูฟังสปอร์ตไร้สาย สีดำ', 62, '-', 62, '2024-03-05 02:15:10'),
(828, 'OPPO Earphone MH135 หูฟังมีสาย', 62, '-', 62, '2024-03-05 02:15:58'),
(829, 'Logitech Wireless Presenter R400', 62, '-', 62, '2024-03-05 02:16:50'),
(830, 'MARSHALL หูฟังไร้สาย (สีดำ) รุ่น Minor III', 62, '-', 62, '2024-03-05 02:17:32'),
(831, 'LEXAR SL200 SSD External ฮาร์ดดิสพกพา (2TB) รุ่น L', 62, '-', 62, '2024-03-05 02:18:27'),
(832, 'สายสัญญาณ Ugreen Aux Cable AV125 40779 1M', 62, '-', 62, '2024-03-05 02:19:06'),
(833, 'Logitech R500s Laser Pointer', 62, '-', 62, '2024-03-05 02:19:56'),
(834, 'Logitech เมาส์ไร้สาย รุ่น G304 Wireless Gaming Mou', 62, '-', 62, '2024-03-05 02:20:48'),
(835, 'EDIFIER WH950NB หูฟังบลูทูธ FULL-SIZE พร้อมโหมดตัด', 62, '-', 62, '2024-03-05 02:22:00'),
(836, '2 TB SSD M.2 PCIe 4.0 T-FORCE Z44A5 (TM8FPP002T0C1', 62, '-', 62, '2024-03-05 02:22:42'),
(837, 'RAM DDR4(3200, NB) 16GB KINGSTON FURY IMPACT (KF43', 62, '-', 62, '2024-03-05 02:23:34'),
(838, 'Commy USB-C Hub Adapter 6 in 1 (HB 601)', 62, '-', 62, '2024-03-05 02:24:22'),
(839, 'BLUETOOTH MOUSE LOGITECH M350S TONAL GRAPHITE', 62, 'LOGITECH', 62, '2024-03-05 02:25:02'),
(840, 'หูฟัง Samsung Galaxy Buds 2 True Wireless', 62, '-', 62, '2024-03-05 02:25:42'),
(841, 'iWALK LinkPod Pro5000PL แบตสำรองไร้สายแบบ FastChar', 62, '-', 62, '2024-03-05 02:26:45'),
(842, 'แท่นวาง mophie 3-in-1 สำหรับที่ชาร์จ MagSafe', 62, '-', 62, '2024-03-05 02:27:33'),
(843, 'ไขควงไฟฟ้า Xiaomi Electric Precision Screwdriver G', 62, 'Xiaomi ', 62, '2024-03-05 02:28:21'),
(844, 'HEADSET (7.1) COOLER MASTER MASTERPULSE MH650', 62, '-', 62, '2024-03-05 02:33:35'),
(845, 'Hagibis U100pro USB C Docking Station Dual Monitor', 62, '-', 62, '2024-03-05 02:34:17'),
(846, '1 TB SSD M.2 PCIe 4.0 WD BLACK SN770 (WDS100T3X0E)', 62, '-', 62, '2024-03-05 02:35:29'),
(847, '32GB (16GBx2) DDR4 3200MHz RAM (หน่วยความจำ) PATRI', 62, '-', 62, '2024-03-05 02:37:00'),
(848, 'VGA (การ์ดแสดงผล) ASUS DUAL RADEON RX 6600 V2 8GB ', 62, 'Asus', 62, '2024-03-05 02:38:25'),
(849, '5 TB EXT HDD 2.5\'\' WD MY PASSPORT BLACK (WDBPKJ005', 62, '-', 62, '2024-03-05 02:39:26'),
(850, 'Logitech G Pro X Superlight wireless gaming mouse ', 62, '-', 62, '2024-03-05 02:44:04'),
(851, 'สาย Lightning เป็น USB (1 ม.)', 62, '-', 62, '2024-03-05 02:45:06'),
(852, 'UGREEN CD296 WORLD TRAVEL CHARGER WITH USB 1-PORT ', 62, 'UGREEN', 62, '2024-03-05 02:46:03'),
(853, 'UGREEN MD112 Mini DisplayPort to HDMI Female Adapt', 62, 'UGREEN', 62, '2024-03-05 02:47:06'),
(854, 'POWER BANK (แบตเตอรี่สำรอง) ANKER POWER CORE SLIM ', 62, '-', 62, '2024-03-05 02:48:19'),
(855, '2 TB EXT HDD 2.5\'\' TOSHIBA CANVIO ADVANCE GREEN HD', 62, 'TOSHIBA', 62, '2024-03-05 02:49:42'),
(856, 'MOUSE (เมาส์ไร้สาย) LOGITECH MX MASTER 2S WIRELESS', 62, '-', 62, '2024-03-05 02:50:38'),
(857, 'Inch High-Definition LED Electronic Photo Album Pi', 62, '-', 62, '2024-03-05 02:51:57'),
(862, 'ลวด 1.5 มิล', 51, '-', 69, '2024-03-07 04:03:24'),
(863, ' ดด', 49, '-', 61, '2024-03-07 04:16:28'),
(864, '   น', 49, '-', 61, '2024-03-07 04:18:19'),
(865, '      ', 68, '-', 62, '2024-03-07 04:28:13'),
(866, 'ลวด 1.5 มิล', 49, '-', 78, '2024-03-07 04:34:51'),
(867, 'ลวด 1.5 มิล ', 49, '-', 78, '2024-03-07 04:37:37'),
(875, 'กระเป๋า', 52, 'lg', 63, '2024-03-18 06:52:23'),
(878, 'แซนวิท', 49, 'lg', 62, '2024-03-18 07:26:35'),
(880, 'PK\0\0\0\0\0!\0A7??n\0\0\0\0\0[Content_Types].xml ', NULL, NULL, NULL, '2024-07-03 07:38:42'),
(881, '3???N?B???C%?*?????=??YK)ub8x?R-\ZJ?W??Q23V$??s', NULL, NULL, NULL, '2024-07-03 07:38:42'),
(885, '???', NULL, NULL, NULL, '2024-07-03 07:38:42'),
(886, '}?c?C??', NULL, NULL, NULL, '2024-07-03 07:38:42'),
(888, '????3??$?0?q??-+???E???`|????j?z?J????H??b|s', NULL, NULL, NULL, '2024-07-03 07:38:42'),
(889, 'e??δ???e?o?3mE?Q?', NULL, NULL, NULL, '2024-07-03 07:38:42'),
(891, '??]?6?Kr?ҹ?3?=v؍P<s?L???~&!E?w?I|??;D=CP?1ܷ', NULL, NULL, NULL, '2024-07-03 07:38:42'),
(893, '0mx???E???A?A?f??c??????', NULL, NULL, NULL, '2024-07-03 07:38:42'),
(896, '???5?*?a]KmXj\0b??D?	i?\Z?e4?7?', NULL, NULL, NULL, '2024-07-03 07:38:42'),
(897, 'Ih??????N??D?\0??0??J????Li?ii??f??]???w????Hゑ', NULL, NULL, NULL, '2024-07-03 07:38:42'),
(901, '`(b?d?c(aP\0?| ??PƐ', NULL, NULL, NULL, '2024-07-03 07:38:42'),
(903, '? A\0D3\"at#!?? %?`4FC`4\0\0\0\0??\0PK\0\0\0\0\0!\0aI', NULL, NULL, NULL, '2024-07-03 07:38:42');

-- --------------------------------------------------------

--
-- Table structure for table `tb_material_budget_year`
--

CREATE TABLE `tb_material_budget_year` (
  `mat_bud_id` int(11) NOT NULL,
  `mat_id` int(11) DEFAULT NULL,
  `mat_price` decimal(10,2) DEFAULT NULL,
  `mat_stock` int(11) DEFAULT NULL,
  `mat_date_income` datetime DEFAULT NULL,
  `budget_id` int(11) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_material_budget_year`
--

INSERT INTO `tb_material_budget_year` (`mat_bud_id`, `mat_id`, `mat_price`, `mat_stock`, `mat_date_income`, `budget_id`, `create_date`) VALUES
(262, 397, '32.00', 1000, '2024-02-05 00:00:00', 33, '2024-02-14 06:37:55'),
(263, 398, '20.00', 1000, '2024-02-05 00:00:00', 33, '2024-02-14 06:41:29'),
(264, 399, '15.00', 1000, '2024-02-05 00:00:00', 33, '2024-02-14 06:44:27'),
(265, 400, '6.00', 1000, '2024-02-05 00:00:00', 33, '2024-02-14 06:45:12'),
(266, 401, '25.00', 40, '2024-02-05 00:00:00', 33, '2024-02-14 06:52:36'),
(267, 402, '25.00', 24, '2024-02-05 00:00:00', 33, '2024-02-14 06:53:15'),
(268, 403, '615.25', 2, '2024-02-07 00:00:00', 33, '2024-02-14 07:09:33'),
(269, 403, '615.25', 1, '2024-02-07 00:00:00', 33, '2024-02-15 01:37:53'),
(270, 404, '802.50', 1, '2024-02-07 00:00:00', 33, '2024-02-15 01:39:55'),
(271, 404, '802.50', 1, '2024-02-07 00:00:00', 33, '2024-02-15 01:40:30'),
(272, 404, '738.30', 1, '2024-02-07 00:00:00', 33, '2024-02-15 01:43:51'),
(273, 407, '738.30', 1, '2024-02-07 00:00:00', 33, '2024-02-15 01:45:28'),
(274, 409, '615.25', 1, '2024-02-07 00:00:00', 33, '2024-02-15 01:52:11'),
(275, 410, '428.00', 1, '2024-02-07 00:00:00', 33, '2024-02-15 01:53:24'),
(276, 407, '738.30', 1, '2024-02-07 00:00:00', 33, '2024-02-15 01:54:17'),
(277, 407, '738.30', 1, '2024-02-07 00:00:00', 33, '2024-02-15 01:54:45'),
(278, 411, '650.00', 50, '2024-02-08 00:00:00', 33, '2024-02-15 01:58:06'),
(279, 413, '450.00', 9, '2023-10-17 00:00:00', 33, '2024-02-15 02:02:31'),
(280, 414, '260.00', 9, '2023-10-17 00:00:00', 33, '2024-02-15 02:03:49'),
(281, 415, '240.00', 9, '2023-10-17 00:00:00', 33, '2024-02-15 02:05:39'),
(282, 417, '1.00', 185, '2023-10-17 00:00:00', 33, '2024-02-15 07:49:42'),
(283, 418, '185.00', 1, '2023-10-17 00:00:00', 33, '2024-02-15 07:51:10'),
(284, 419, '380.00', 1, '2023-10-17 00:00:00', 33, '2024-02-15 07:52:28'),
(285, 420, '4700.00', 4, '2023-10-17 00:00:00', 33, '2024-02-15 08:03:55'),
(286, 421, '2800.00', 5, '2023-11-10 00:00:00', 33, '2024-02-15 08:06:36'),
(287, 422, '2980.00', 5, '2023-11-10 00:00:00', 33, '2024-02-15 08:10:31'),
(288, 423, '890.00', 6, '2023-11-10 00:00:00', 33, '2024-02-15 08:13:13'),
(289, 424, '3760.00', 1, '2023-11-10 00:00:00', 33, '2024-02-15 08:15:24'),
(290, 425, '1080.00', 4, '2023-11-10 00:00:00', 33, '2024-02-15 08:17:35'),
(291, 426, '255.00', 1, '2023-11-13 00:00:00', 33, '2024-02-15 08:29:11'),
(292, 427, '305.15', 1, '2023-11-13 00:00:00', 33, '2024-02-15 08:30:28'),
(293, 429, '292.00', 1, '2023-11-13 00:00:00', 33, '2024-02-15 08:32:56'),
(294, 430, '276.25', 1, '2023-11-13 00:00:00', 33, '2024-02-15 08:34:55'),
(295, 431, '382.50', 1, '2023-11-13 00:00:00', 33, '2024-02-15 08:37:04'),
(296, 432, '229.00', 1, '2023-11-13 00:00:00', 33, '2024-02-15 08:40:26'),
(297, 433, '204.00', 1, '2023-11-13 00:00:00', 33, '2024-02-15 08:41:40'),
(298, 434, '221.00', 1, '2023-11-13 00:00:00', 33, '2024-02-15 08:42:55'),
(299, 435, '335.40', 1, '2023-11-13 00:00:00', 33, '2024-02-15 08:44:32'),
(300, 436, '377.40', 1, '2023-11-13 00:00:00', 33, '2024-02-15 08:46:50'),
(301, 438, '660.45', 1, '2023-11-13 00:00:00', 33, '2024-02-15 08:50:19'),
(302, 439, '335.75', 1, '2023-11-13 00:00:00', 33, '2024-02-15 08:52:35'),
(303, 440, '416.50', 1, '2023-11-13 00:00:00', 33, '2024-02-15 08:54:19'),
(304, 442, '357.00', 1, '2023-11-13 00:00:00', 33, '2024-02-15 08:56:09'),
(305, 444, '305.15', 1, '2023-11-13 00:00:00', 33, '2024-02-15 08:57:26'),
(306, 446, '250.75', 1, '2023-11-13 00:00:00', 33, '2024-02-15 08:59:10'),
(307, 447, '390.15', 1, '2023-11-13 00:00:00', 33, '2024-02-15 09:00:41'),
(308, 449, '289.00', 1, '2023-11-13 00:00:00', 33, '2024-02-15 09:02:19'),
(309, 450, '1.00', 276, '2023-11-13 00:00:00', 33, '2024-02-15 09:18:26'),
(310, 451, '399.50', 1, '2023-11-13 00:00:00', 33, '2024-02-15 09:20:23'),
(311, 452, '297.50', 1, '2023-11-13 00:00:00', 33, '2024-02-15 09:21:52'),
(312, 453, '272.00', 1, '2023-11-13 00:00:00', 33, '2024-02-15 09:22:42'),
(313, 454, '236.00', 1, '2023-11-13 00:00:00', 33, '2024-02-15 09:24:03'),
(314, 455, '220.00', 1, '2023-11-13 00:00:00', 33, '2024-02-15 09:25:36'),
(315, 456, '260.00', 1, '2023-11-13 00:00:00', 33, '2024-02-15 09:26:20'),
(316, 459, '3980.00', 1, '2023-11-14 00:00:00', 33, '2024-02-15 09:30:25'),
(317, 460, '3980.00', 1, '2023-11-14 00:00:00', 33, '2024-02-15 09:32:43'),
(318, 461, '3980.00', 1, '2023-11-14 00:00:00', 33, '2024-02-15 09:34:15'),
(319, 462, '3980.00', 1, '2023-11-14 00:00:00', 33, '2024-02-15 09:35:46'),
(320, 463, '45.00', 1, '2023-11-23 00:00:00', 33, '2024-02-16 01:52:36'),
(321, 464, '55.00', 1, '2023-11-23 00:00:00', 33, '2024-02-16 01:54:25'),
(322, 465, '59.00', 1, '2023-11-23 00:00:00', 33, '2024-02-16 01:56:43'),
(323, 466, '15.00', 2, '2023-11-23 00:00:00', 33, '2024-02-16 01:58:18'),
(324, 467, '25.00', 1, '2023-11-23 00:00:00', 33, '2024-02-16 02:00:00'),
(325, 468, '15.00', 1, '2023-11-23 00:00:00', 33, '2024-02-16 02:01:37'),
(326, 469, '10.00', 1, '2023-11-23 00:00:00', 33, '2024-02-16 02:03:01'),
(327, 470, '10.00', 3, '2023-11-23 00:00:00', 33, '2024-02-16 02:05:12'),
(328, 471, '23.00', 1, '2023-11-23 00:00:00', 33, '2024-02-16 02:06:30'),
(329, 472, '45.00', 1, '2023-11-23 00:00:00', 33, '2024-02-16 02:07:49'),
(330, 473, '35.00', 1, '2023-11-23 00:00:00', 33, '2024-02-16 02:09:47'),
(331, 474, '20.00', 1, '2023-11-23 00:00:00', 33, '2024-02-16 02:11:28'),
(332, 475, '20.00', 12, '2023-11-23 00:00:00', 33, '2024-02-16 02:13:05'),
(333, 476, '15.00', 1, '2023-11-23 00:00:00', 33, '2024-02-16 02:14:23'),
(334, 477, '20.00', 1, '2023-11-23 00:00:00', 33, '2024-02-16 02:32:28'),
(335, 478, '40.00', 1, '2023-11-23 00:00:00', 33, '2024-02-16 04:35:16'),
(336, 479, '1.00', 30, '2023-11-23 00:00:00', 33, '2024-02-16 04:48:31'),
(337, 480, '25.00', 2, '2023-11-23 00:00:00', 33, '2024-02-16 09:13:01'),
(338, 481, '29.00', 1, '2023-11-23 00:00:00', 33, '2024-02-16 09:23:27'),
(339, 482, '40.00', 2, '2023-11-23 00:00:00', 33, '2024-02-16 09:28:00'),
(340, 483, '3.00', 2, '2023-11-23 00:00:00', 33, '2024-02-19 01:54:26'),
(341, 484, '5.00', 2, '2023-11-23 00:00:00', 33, '2024-02-19 02:05:21'),
(342, 485, '35.00', 2, '2023-11-23 00:00:00', 33, '2024-02-19 02:06:37'),
(343, 486, '45.00', 2, '2023-11-23 00:00:00', 33, '2024-02-19 02:08:16'),
(344, 487, '20.00', 2, '2023-11-23 00:00:00', 33, '2024-02-19 02:09:55'),
(345, 488, '25.00', 1, '2023-11-23 00:00:00', 33, '2024-02-19 02:11:51'),
(346, 489, '3840.00', 1, '2023-11-23 00:00:00', 33, '2024-02-19 02:17:58'),
(347, 490, '361.25', 1, '2023-11-27 00:00:00', 33, '2024-02-19 06:47:27'),
(348, 491, '1.00', 509, '2023-11-27 00:00:00', 33, '2024-02-19 06:50:17'),
(349, 492, '242.25', 1, '2023-11-27 00:00:00', 33, '2024-02-21 07:35:39'),
(350, 493, '238.00', 1, '2023-11-27 00:00:00', 33, '2024-02-21 07:42:38'),
(351, 494, '335.75', 1, '2023-11-27 00:00:00', 33, '2024-02-21 07:45:47'),
(352, 495, '352.75', 1, '2023-11-27 00:00:00', 33, '2024-02-21 08:01:08'),
(353, 496, '637.50', 1, '2023-11-27 00:00:00', 33, '2024-02-22 07:53:36'),
(354, 497, '382.50', 1, '2023-11-27 00:00:00', 33, '2024-02-22 07:55:21'),
(355, 498, '501.50', 1, '2023-11-27 00:00:00', 33, '2024-02-22 08:21:30'),
(356, 499, '242.25', 1, '2023-11-27 00:00:00', 33, '2024-02-22 08:24:14'),
(357, 500, '99.00', 1, '2023-12-01 00:00:00', 33, '2024-02-22 08:58:56'),
(358, 501, '136.00', 12, '2023-12-01 00:00:00', 33, '2024-02-23 02:02:19'),
(359, 502, '136.00', 12, '2023-12-01 00:00:00', 33, '2024-02-23 02:04:28'),
(360, 503, '130.00', 24, '2023-12-01 00:00:00', 33, '2024-02-23 02:07:38'),
(361, 504, '19.00', 120, '2023-12-01 00:00:00', 33, '2024-02-23 02:12:10'),
(362, 505, '76.00', 4, '2023-12-01 00:00:00', 33, '2024-02-23 02:14:40'),
(363, 506, '140.00', 15, '2023-12-01 00:00:00', 33, '2024-02-23 02:17:19'),
(364, 507, '270.00', 1, '2023-12-01 00:00:00', 33, '2024-02-23 02:21:06'),
(365, 508, '18.00', 12, '2023-12-01 00:00:00', 33, '2024-02-23 02:22:39'),
(366, 509, '20.00', 12, '2023-12-01 00:00:00', 33, '2024-02-23 02:27:02'),
(367, 510, '28.00', 12, '2023-12-01 00:00:00', 33, '2024-02-23 02:28:33'),
(368, 511, '40.00', 12, '2023-12-01 00:00:00', 33, '2024-02-23 02:33:47'),
(369, 512, '120.00', 2, '2023-12-01 00:00:00', 33, '2024-02-23 02:35:54'),
(370, 513, '62.00', 4, '2023-12-01 00:00:00', 33, '2024-02-23 02:37:21'),
(371, 514, '165.00', 5, '2023-12-01 00:00:00', 33, '2024-02-23 02:40:03'),
(372, 515, '168.00', 5, '2023-12-01 00:00:00', 33, '2024-02-23 02:54:43'),
(373, 516, '110.00', 3, '2023-12-01 00:00:00', 33, '2024-02-23 03:00:27'),
(374, 517, '80.00', 5, '2023-12-01 00:00:00', 33, '2024-02-23 03:02:24'),
(375, 518, '140.00', 2, '2023-12-01 00:00:00', 33, '2024-02-23 03:03:31'),
(376, 519, '140.00', 2, '2023-12-01 00:00:00', 33, '2024-02-23 03:10:21'),
(377, 520, '650.00', 6, '2023-10-01 00:00:00', 33, '2024-02-23 03:12:00'),
(378, 521, '15.00', 150, '2023-12-04 00:00:00', 33, '2024-02-23 03:24:46'),
(379, 522, '10.00', 1, '2023-12-04 00:00:00', 33, '2024-02-23 03:25:44'),
(380, 523, '4980.00', 5, '2023-12-01 00:00:00', 33, '2024-02-23 03:29:13'),
(381, 524, '260.00', 80, '2023-12-01 00:00:00', 33, '2024-02-23 03:38:53'),
(382, 525, '2240.00', 2, '2023-12-04 00:00:00', 33, '2024-02-23 03:41:03'),
(383, 526, '160.00', 10, '2023-12-07 00:00:00', 33, '2024-02-23 03:43:41'),
(384, 527, '700.00', 15, '2023-12-14 00:00:00', 33, '2024-02-23 04:42:59'),
(385, 530, '45.00', 25, '2023-12-14 00:00:00', 33, '2024-02-23 04:45:30'),
(386, 531, '280.00', 2, '2024-12-14 00:00:00', 33, '2024-02-23 04:48:31'),
(387, 532, '263.00', 5, '2023-12-14 00:00:00', 33, '2024-02-23 04:51:03'),
(388, 533, '270.00', 5, '2023-12-14 00:00:00', 33, '2024-02-23 04:56:15'),
(389, 534, '60.00', 2, '2023-12-14 00:00:00', 33, '2024-02-23 05:30:55'),
(390, 535, '140.00', 6, '2023-12-14 00:00:00', 33, '2024-02-23 05:33:53'),
(391, 536, '70.00', 6, '2023-12-14 00:00:00', 33, '2024-02-23 06:02:14'),
(392, 537, '460.00', 2, '2023-12-14 00:00:00', 33, '2024-02-23 06:04:31'),
(393, 538, '2736.00', 2, '2023-12-14 00:00:00', 33, '2024-02-23 06:09:21'),
(394, 539, '1375.00', 1, '2023-12-14 00:00:00', 33, '2024-02-23 06:10:32'),
(395, 540, '1060.00', 1, '2023-12-14 00:00:00', 33, '2024-02-23 06:13:06'),
(396, 541, '2840.00', 1, '2023-12-14 00:00:00', 33, '2024-02-23 06:14:25'),
(397, 542, '176.00', 4, '2023-12-14 00:00:00', 33, '2024-02-23 06:15:18'),
(398, 543, '215.00', 4, '2023-12-14 00:00:00', 33, '2024-02-23 06:17:18'),
(399, 544, '60.00', 9, '2023-12-14 00:00:00', 33, '2024-02-23 06:25:03'),
(400, 545, '30.00', 1, '2023-12-14 00:00:00', 33, '2024-02-23 06:25:46'),
(401, 546, '50.00', 1, '2023-12-14 00:00:00', 33, '2024-02-23 06:26:52'),
(402, 547, '60.00', 2, '2023-12-14 00:00:00', 33, '2024-02-23 06:28:07'),
(403, 548, '70.00', 3, '2023-12-14 00:00:00', 33, '2024-02-23 06:29:30'),
(404, 549, '100.00', 2, '2023-12-14 00:00:00', 33, '2024-02-23 06:32:16'),
(405, 550, '80.00', 8, '2023-12-14 00:00:00', 33, '2024-02-23 06:33:42'),
(406, 551, '70.00', 1, '2023-12-14 00:00:00', 33, '2024-02-23 06:34:52'),
(407, 552, '100.00', 1, '2023-12-14 00:00:00', 33, '2024-02-23 06:37:20'),
(408, 553, '35.00', 50, '2023-12-14 00:00:00', 33, '2024-02-23 06:38:47'),
(409, 554, '55.00', 110, '2023-12-14 00:00:00', 33, '2024-02-23 06:49:39'),
(410, 555, '180.00', 1, '2023-12-14 00:00:00', 33, '2024-02-23 06:50:56'),
(411, 556, '55.00', 30, '2023-12-14 00:00:00', 33, '2024-02-23 06:51:54'),
(412, 558, '80.00', 12, '2023-12-14 00:00:00', 33, '2024-02-23 06:53:03'),
(413, 559, '40.00', 40, '2023-12-14 00:00:00', 33, '2024-02-23 06:55:12'),
(414, 560, '150.00', 3, '2023-12-14 00:00:00', 33, '2024-02-23 06:57:16'),
(415, 561, '100.00', 4, '2023-12-14 00:00:00', 33, '2024-02-23 06:59:24'),
(416, 562, '800.00', 10, '2023-12-18 00:00:00', 33, '2024-02-23 07:07:00'),
(417, 563, '200.00', 2, '2023-12-14 00:00:00', 33, '2024-02-23 07:11:16'),
(418, 564, '250.00', 2, '2023-12-18 00:00:00', 33, '2024-02-23 07:15:20'),
(419, 565, '250.00', 2, '2023-12-18 00:00:00', 33, '2024-02-23 07:18:09'),
(420, 566, '250.00', 2, '2023-12-18 00:00:00', 33, '2024-02-23 07:20:16'),
(421, 567, '270.00', 1, '2023-12-18 00:00:00', 33, '2024-02-23 07:28:56'),
(422, 568, '230.00', 3, '2023-12-18 00:00:00', 33, '2024-02-23 07:33:03'),
(423, 569, '230.00', 3, '2023-12-18 00:00:00', 33, '2024-02-23 07:35:15'),
(424, 570, '230.00', 3, '2023-12-18 00:00:00', 33, '2024-02-23 07:36:35'),
(425, 571, '130.00', 3, '2023-12-18 00:00:00', 33, '2024-02-23 07:39:53'),
(426, 572, '625.00', 2, '2023-12-18 00:00:00', 33, '2024-02-23 07:41:15'),
(427, 573, '50.00', 16, '2023-12-18 00:00:00', 33, '2024-02-23 07:46:40'),
(428, 573, '50.00', 0, '2023-12-18 00:00:00', 33, '2024-02-23 07:48:11'),
(429, 573, '50.00', 16, '2023-12-18 00:00:00', 33, '2024-02-23 07:49:06'),
(430, 574, '50.00', 16, '2023-12-18 00:00:00', 33, '2024-02-23 07:50:48'),
(431, 575, '50.00', 16, '2023-12-18 00:00:00', 33, '2024-02-23 07:52:21'),
(432, 576, '54.00', 45, '2023-12-21 00:00:00', 33, '2024-02-23 07:55:14'),
(433, 577, '54.00', 45, '2023-12-21 00:00:00', 33, '2024-02-23 07:56:27'),
(434, 578, '240.00', 3, '2023-12-21 00:00:00', 33, '2024-02-23 07:58:57'),
(435, 579, '410.00', 4, '2023-12-21 00:00:00', 33, '2024-02-23 08:00:29'),
(436, 580, '410.00', 4, '2023-12-21 00:00:00', 33, '2024-02-23 08:01:49'),
(437, 581, '410.00', 4, '2023-12-21 00:00:00', 33, '2024-02-23 08:03:28'),
(438, 582, '410.00', 5, '2023-12-21 00:00:00', 33, '2024-02-23 08:04:38'),
(439, 583, '980.00', 7, '2023-12-21 00:00:00', 33, '2024-02-23 08:05:45'),
(440, 584, '5.00', 1480, '2023-12-21 00:00:00', 33, '2024-02-23 08:08:21'),
(441, 585, '2.00', 3700, '2023-12-21 00:00:00', 33, '2024-02-23 08:10:08'),
(442, 586, '4.20', 6000, '2023-12-21 00:00:00', 33, '2024-02-23 08:11:13'),
(443, 587, '2250.00', 2, '2023-12-22 00:00:00', 33, '2024-02-23 08:16:26'),
(444, 588, '2000.00', 1, '2023-12-22 00:00:00', 33, '2024-02-23 08:17:59'),
(445, 589, '630.00', 1, '2023-12-22 00:00:00', 33, '2024-02-23 08:21:07'),
(446, 590, '5400.00', 4, '2023-12-22 00:00:00', 33, '2024-02-23 08:25:07'),
(447, 591, '370.00', 1, '2023-12-22 00:00:00', 33, '2024-02-23 08:27:17'),
(448, 592, '1490.00', 6, '2023-12-22 00:00:00', 33, '2024-02-23 08:28:56'),
(449, 593, '5600.00', 1, '2023-12-22 00:00:00', 33, '2024-02-23 08:30:41'),
(450, 594, '2600.00', 2, '2023-12-22 00:00:00', 33, '2024-02-23 08:32:05'),
(451, 595, '690.00', 1, '2023-12-22 00:00:00', 33, '2024-02-23 08:33:39'),
(452, 596, '3500.00', 1, '2023-12-22 00:00:00', 33, '2024-02-23 08:37:25'),
(453, 597, '2250.00', 2, '2023-12-22 00:00:00', 33, '2024-02-23 08:40:55'),
(454, 598, '2400.00', 3, '2023-12-22 00:00:00', 33, '2024-02-23 08:47:01'),
(455, 599, '315.00', 3, '2023-12-22 00:00:00', 33, '2024-02-23 08:48:26'),
(456, 600, '2490.00', 1, '2023-12-22 00:00:00', 33, '2024-02-23 09:05:04'),
(457, 601, '2490.00', 1, '2023-12-22 00:00:00', 33, '2024-02-23 09:06:47'),
(458, 602, '170.00', 1, '2023-12-22 00:00:00', 33, '2024-02-23 09:07:49'),
(459, 603, '3390.00', 1, '2023-12-22 00:00:00', 33, '2024-02-23 09:12:00'),
(460, 604, '1090.00', 1, '2023-12-22 00:00:00', 33, '2024-02-23 09:23:39'),
(461, 605, '990.00', 1, '2023-12-22 00:00:00', 33, '2024-02-23 09:25:23'),
(462, 606, '2490.00', 1, '2023-12-22 00:00:00', 33, '2024-02-27 01:57:10'),
(463, 607, '990.00', 2, '2023-12-22 00:00:00', 33, '2024-02-27 02:00:20'),
(464, 608, '400.00', 1, '2023-12-22 00:00:00', 33, '2024-02-27 02:02:52'),
(465, 609, '1000.00', 1, '2023-12-22 00:00:00', 33, '2024-02-27 02:04:46'),
(466, 610, '1550.00', 1, '2023-12-22 00:00:00', 33, '2024-02-27 02:07:51'),
(467, 611, '3700.00', 1, '2023-12-22 00:00:00', 33, '2024-02-27 02:10:43'),
(468, 612, '1520.00', 1, '2023-12-22 00:00:00', 33, '2024-02-27 02:13:14'),
(469, 613, '4690.00', 1, '2023-12-22 00:00:00', 33, '2024-02-27 02:16:08'),
(470, 614, '810.00', 1, '2023-12-22 00:00:00', 33, '2024-02-27 02:16:55'),
(471, 615, '4530.00', 1, '2023-12-22 00:00:00', 33, '2024-02-27 02:18:21'),
(472, 616, '3000.00', 1, '2023-12-22 00:00:00', 33, '2024-02-27 02:19:54'),
(473, 617, '870.00', 1, '2023-12-22 00:00:00', 33, '2024-02-27 02:24:49'),
(474, 618, '3300.00', 1, '2023-12-22 00:00:00', 33, '2024-02-27 03:00:22'),
(475, 619, '3100.00', 1, '2023-12-22 00:00:00', 33, '2024-02-27 05:20:01'),
(476, 620, '1950.00', 1, '2023-12-22 00:00:00', 33, '2024-02-27 05:30:03'),
(477, 621, '390.15', 2, '2023-12-27 00:00:00', 33, '2024-03-01 01:59:15'),
(478, 622, '1026.00', 1, '2023-12-27 00:00:00', 33, '2024-03-01 02:01:30'),
(479, 623, '1526.00', 20, '2023-12-27 00:00:00', 33, '2024-03-01 02:03:10'),
(480, 624, '3150.00', 1, '2023-12-27 00:00:00', 33, '2024-03-01 02:04:50'),
(481, 558, '117.00', 10, '2023-12-27 00:00:00', 33, '2024-03-01 02:05:46'),
(482, 625, '117.00', 10, '2023-12-27 00:00:00', 33, '2024-03-01 08:32:28'),
(483, 626, '370.50', 2, '2023-12-27 00:00:00', 33, '2024-03-01 08:35:57'),
(484, 627, '113.10', 20, '2023-12-27 00:00:00', 33, '2024-03-01 08:39:24'),
(485, 628, '5616.00', 1, '2023-12-27 00:00:00', 33, '2024-03-01 08:41:08'),
(486, 629, '60.00', 50, '2023-12-27 00:00:00', 33, '2024-03-01 08:46:30'),
(487, 630, '185.90', 20, '2023-12-23 00:00:00', 33, '2024-03-01 09:13:45'),
(488, 631, '352.50', 10, '2023-12-27 00:00:00', 33, '2024-03-01 09:15:12'),
(489, 632, '193.50', 10, '2023-12-27 00:00:00', 33, '2024-03-01 09:18:39'),
(490, 633, '87.00', 5, '2023-12-27 00:00:00', 33, '2024-03-01 09:19:44'),
(491, 634, '105.00', 5, '2023-12-27 00:00:00', 33, '2024-03-01 09:21:44'),
(492, 635, '242.20', 2, '2023-12-27 00:00:00', 33, '2024-03-01 09:22:39'),
(493, 636, '124.50', 1, '2023-12-27 00:00:00', 33, '2024-03-01 09:23:46'),
(494, 459, '4380.00', 3, '2023-12-27 00:00:00', 33, '2024-03-01 09:25:35'),
(495, 460, '4380.00', 2, '2023-12-27 00:00:00', 33, '2024-03-01 09:26:30'),
(496, 637, '4380.00', 2, '2023-12-27 00:00:00', 33, '2024-03-01 09:28:12'),
(497, 638, '4380.00', 2, '2023-12-27 00:00:00', 33, '2024-03-01 09:31:30'),
(498, 639, '180.00', 10, '2024-01-05 00:00:00', 33, '2024-03-04 01:52:48'),
(499, 640, '550.00', 10, '2024-01-05 00:00:00', 33, '2024-03-04 02:06:03'),
(500, 641, '380.00', 10, '2024-01-05 00:00:00', 33, '2024-03-04 02:08:02'),
(501, 642, '690.00', 10, '2024-01-05 00:00:00', 33, '2024-03-04 02:13:05'),
(502, 643, '72.00', 10, '2024-01-05 00:00:00', 33, '2024-03-04 02:18:18'),
(503, 644, '80.00', 3, '2024-01-05 00:00:00', 33, '2024-03-04 02:19:53'),
(504, 645, '3761.00', 11, '2024-01-05 00:00:00', 33, '2024-03-04 02:22:09'),
(505, 646, '50.00', 3, '2024-01-05 00:00:00', 33, '2024-03-04 03:00:01'),
(506, 647, '620.00', 2, '2024-01-05 00:00:00', 33, '2024-03-04 03:12:30'),
(507, 648, '1290.00', 7, '2024-01-05 00:00:00', 33, '2024-03-04 03:20:48'),
(508, 649, '980.00', 2, '2024-01-05 00:00:00', 33, '2024-03-04 03:24:00'),
(509, 651, '4900.00', 1, '2024-01-05 00:00:00', 33, '2024-03-04 03:32:06'),
(510, 652, '6900.00', 1, '2024-01-05 00:00:00', 33, '2024-03-04 03:34:00'),
(511, 653, '60.00', 80, '2024-01-05 00:00:00', 33, '2024-03-04 03:43:55'),
(512, 654, '50.00', 70, '2024-01-05 00:00:00', 33, '2024-03-04 03:50:19'),
(513, 655, '50.00', 20, '2024-01-05 00:00:00', 33, '2024-03-04 03:56:12'),
(514, 656, '129.00', 10, '0204-01-05 00:00:00', 33, '2024-03-04 03:57:30'),
(515, 657, '52.00', 20, '2024-01-05 00:00:00', 33, '2024-03-04 04:17:25'),
(516, 658, '180.00', 2, '2024-01-05 00:00:00', 33, '2024-03-04 04:18:34'),
(517, 659, '43.00', 40, '2024-01-05 00:00:00', 33, '2024-03-04 04:24:51'),
(518, 660, '39.00', 5, '2024-01-05 00:00:00', 33, '2024-03-04 04:32:48'),
(519, 661, '75.00', 30, '2024-01-05 00:00:00', 33, '2024-03-04 04:34:28'),
(520, 662, '8900.00', 5, '2024-01-05 00:00:00', 33, '2024-03-04 04:43:36'),
(521, 663, '170.00', 10, '2024-01-05 00:00:00', 33, '2024-03-04 04:49:32'),
(522, 664, '3200.00', 320, '2024-01-05 00:00:00', 33, '2024-03-04 04:56:40'),
(523, 665, '2300.00', 2300, '2024-01-05 00:00:00', 33, '2024-03-04 04:57:55'),
(524, 666, '900.00', 1, '2024-01-04 00:00:00', 33, '2024-03-04 06:00:00'),
(525, 667, '130.00', 20, '2024-01-05 00:00:00', 33, '2024-03-04 06:01:14'),
(526, 668, '120.00', 20, '2024-01-05 00:00:00', 33, '2024-03-04 06:08:40'),
(527, 669, '490.00', 20, '2024-01-05 00:00:00', 33, '2024-03-04 06:10:37'),
(528, 670, '600.00', 20, '2024-01-05 00:00:00', 33, '2024-03-04 06:11:33'),
(529, 671, '1690.00', 2, '2024-01-05 00:00:00', 33, '2024-03-04 06:15:40'),
(530, 672, '330.00', 1, '2024-01-05 00:00:00', 33, '2024-03-04 06:17:03'),
(531, 673, '210.00', 10, '2024-01-05 00:00:00', 33, '2024-03-04 06:18:14'),
(532, 674, '60.00', 20, '2024-01-05 00:00:00', 33, '2024-03-04 06:18:57'),
(533, 675, '560.00', 1, '2024-01-05 00:00:00', 33, '2024-03-04 06:26:52'),
(534, 676, '1590.00', 1, '2024-01-05 00:00:00', 33, '2024-03-04 06:28:26'),
(535, 677, '1700.00', 1, '2024-01-05 00:00:00', 33, '2024-03-04 06:29:21'),
(536, 678, '420.00', 1, '2024-01-05 00:00:00', 33, '2024-03-04 06:30:14'),
(537, 679, '650.00', 5, '2024-01-05 00:00:00', 33, '2024-03-04 06:32:03'),
(538, 681, '34.00', 10, '2024-01-05 00:00:00', 33, '2024-03-04 06:33:25'),
(539, 682, '4900.00', 1, '2024-01-05 00:00:00', 33, '2024-03-04 06:34:07'),
(540, 683, '400.00', 10, '2024-01-05 00:00:00', 33, '2024-03-04 06:36:33'),
(541, 684, '2000.00', 5, '2024-01-05 00:00:00', 33, '2024-03-04 06:38:16'),
(542, 685, '2990.00', 10, '2024-01-05 00:00:00', 33, '2024-03-04 06:39:43'),
(543, 686, '7000.00', 4, '2024-01-05 00:00:00', 33, '2024-03-04 06:41:05'),
(544, 687, '545.00', 1, '2024-01-05 00:00:00', 33, '2024-03-04 06:43:01'),
(545, 688, '4767.00', 1, '2024-01-05 00:00:00', 33, '2024-03-04 06:43:49'),
(546, 689, '285.00', 100, '2024-01-10 00:00:00', 33, '2024-03-04 06:48:08'),
(547, 690, '250.00', 50, '2024-01-10 00:00:00', 33, '2024-03-04 06:48:54'),
(548, 691, '1150.00', 20, '2024-01-10 00:00:00', 33, '2024-03-04 06:49:34'),
(549, 692, '130.00', 50, '2024-01-10 00:00:00', 33, '2024-03-04 06:50:25'),
(550, 693, '130.00', 50, '2024-01-10 00:00:00', 33, '2024-03-04 06:51:08'),
(551, 694, '1933.49', 8, '2024-01-17 00:00:00', 33, '2024-03-04 06:53:09'),
(552, 695, '858.00', 8, '2024-01-05 00:00:00', 33, '2024-03-04 06:56:56'),
(553, 696, '904.15', 10, '2024-01-05 00:00:00', 33, '2024-03-04 07:00:28'),
(554, 697, '1474.00', 5, '2024-01-05 00:00:00', 33, '2024-03-04 07:03:47'),
(555, 698, '7000.00', 1, '2024-01-17 00:00:00', 33, '2024-03-04 07:08:13'),
(556, 699, '1160.00', 1, '2024-01-05 00:00:00', 33, '2024-03-04 07:09:52'),
(557, 700, '800.00', 1, '2024-01-17 00:00:00', 33, '2024-03-04 07:11:15'),
(558, 701, '150.00', 24, '2024-01-24 00:00:00', 33, '2024-03-04 07:13:48'),
(559, 702, '1080.00', 7, '2024-01-24 00:00:00', 33, '2024-03-04 07:14:40'),
(560, 703, '210.00', 60, '2024-01-19 00:00:00', 33, '2024-03-04 07:18:08'),
(561, 708, '75.00', 1, '2024-01-19 00:00:00', 33, '2024-03-04 07:21:41'),
(562, 708, '75.00', 1, '2024-01-19 00:00:00', 33, '2024-03-04 07:21:41'),
(563, 708, '75.00', 1, '2024-01-19 00:00:00', 33, '2024-03-04 07:21:41'),
(564, 708, '75.00', 1, '2024-01-19 00:00:00', 33, '2024-03-04 07:21:41'),
(565, 708, '75.00', 1, '2024-01-19 00:00:00', 33, '2024-03-04 07:21:41'),
(566, 709, '120.00', 1, '2024-02-19 00:00:00', 33, '2024-03-04 07:23:01'),
(567, 710, '45.00', 2, '2024-02-19 00:00:00', 33, '2024-03-04 07:24:22'),
(568, 711, '3000.00', 5, '2024-01-19 00:00:00', 33, '2024-03-04 07:25:06'),
(569, 712, '100.00', 6, '2024-01-19 00:00:00', 33, '2024-03-04 07:25:47'),
(570, 713, '100.00', 2, '2024-01-19 00:00:00', 33, '2024-03-04 07:26:51'),
(571, 714, '900.00', 10, '2024-01-19 00:00:00', 33, '2024-03-04 07:28:07'),
(572, 715, '120.00', 2, '2024-02-19 00:00:00', 33, '2024-03-04 07:28:58'),
(573, 716, '450.00', 5, '2024-01-19 00:00:00', 33, '2024-03-04 07:29:38'),
(574, 717, '550.00', 8, '2024-01-19 00:00:00', 33, '2024-03-04 07:30:26'),
(575, 718, '110.00', 2, '2024-01-19 00:00:00', 33, '2024-03-04 07:31:11'),
(576, 719, '100.00', 5, '2024-01-19 00:00:00', 33, '2024-03-04 07:32:13'),
(577, 720, '900.00', 1, '2024-01-19 00:00:00', 33, '2024-03-04 07:32:58'),
(578, 721, '2900.00', 26, '2024-01-19 00:00:00', 33, '2024-03-04 07:34:26'),
(579, 722, '3600.00', 13, '2024-01-19 00:00:00', 33, '2024-03-04 07:35:50'),
(580, 723, '1900.00', 8, '2024-01-19 00:00:00', 33, '2024-03-04 07:36:42'),
(581, 724, '7100.00', 1, '2024-01-19 00:00:00', 33, '2024-03-04 07:37:35'),
(582, 725, '2850.00', 20, '2024-01-19 00:00:00', 33, '2024-03-04 07:38:29'),
(583, 726, '110.00', 300, '2024-01-19 00:00:00', 33, '2024-03-04 07:39:39'),
(584, 727, '50.00', 24, '2024-01-19 00:00:00', 33, '2024-03-04 07:40:23'),
(585, 728, '40.00', 24, '2024-01-19 00:00:00', 33, '2024-03-04 07:41:09'),
(586, 729, '440.00', 20, '2024-01-19 00:00:00', 33, '2024-03-04 07:42:38'),
(587, 730, '55.00', 24, '2024-02-19 00:00:00', 33, '2024-03-04 07:43:33'),
(588, 731, '150.00', 10, '2024-01-19 00:00:00', 33, '2024-03-04 07:44:11'),
(589, 732, '65.00', 48, '2024-01-19 00:00:00', 33, '2024-03-04 07:45:13'),
(590, 733, '100.00', 4, '2024-01-19 00:00:00', 33, '2024-03-04 07:45:59'),
(591, 734, '55.00', 3, '2024-01-19 00:00:00', 33, '2024-03-04 07:47:16'),
(592, 735, '65.00', 3, '2024-01-19 00:00:00', 33, '2024-03-04 07:47:53'),
(593, 736, '25.00', 10, '2024-01-19 00:00:00', 33, '2024-03-04 07:49:10'),
(594, 737, '360.00', 3, '2024-01-19 00:00:00', 33, '2024-03-04 07:49:52'),
(595, 738, '45.00', 24, '2024-01-19 00:00:00', 33, '2024-03-04 07:50:59'),
(596, 739, '45.00', 100, '2024-01-19 00:00:00', 33, '2024-03-04 07:51:48'),
(597, 740, '45.00', 100, '2024-01-19 00:00:00', 33, '2024-03-04 07:52:37'),
(598, 741, '70.00', 12, '2024-01-19 00:00:00', 33, '2024-03-04 07:53:21'),
(599, 742, '110.00', 10, '2024-01-19 00:00:00', 33, '2024-03-04 07:54:06'),
(600, 743, '100.00', 5, '2024-01-19 00:00:00', 33, '2024-03-04 07:54:45'),
(601, 744, '50.00', 5, '2024-01-19 00:00:00', 33, '2024-03-04 07:55:24'),
(602, 745, '25.00', 30, '2024-01-19 00:00:00', 33, '2024-03-04 07:56:04'),
(603, 746, '50.00', 5, '2024-01-19 00:00:00', 33, '2024-03-04 07:56:48'),
(604, 747, '480.00', 5, '2024-01-19 00:00:00', 33, '2024-03-04 07:57:33'),
(605, 748, '40.00', 10, '2024-01-19 00:00:00', 33, '2024-03-04 07:58:20'),
(606, 749, '900.00', 5, '2024-01-19 00:00:00', 33, '2024-03-04 07:59:21'),
(607, 750, '100.00', 4, '2024-01-19 00:00:00', 33, '2024-03-04 07:59:53'),
(608, 751, '185.00', 5, '2024-01-19 00:00:00', 33, '2024-03-04 08:01:36'),
(609, 752, '135.00', 12, '2024-01-19 00:00:00', 33, '2024-03-04 08:02:27'),
(610, 753, '195.00', 20, '2024-01-19 00:00:00', 33, '2024-03-04 08:03:35'),
(611, 754, '160.00', 5, '2024-01-19 00:00:00', 33, '2024-03-04 08:04:31'),
(612, 755, '40.00', 24, '2024-01-19 00:00:00', 33, '2024-03-04 08:05:07'),
(613, 756, '200.00', 10, '2024-01-19 00:00:00', 33, '2024-03-04 08:05:59'),
(614, 757, '990.00', 30, '2024-01-19 00:00:00', 33, '2024-03-04 08:07:50'),
(615, 758, '550.00', 20, '2024-01-19 00:00:00', 33, '2024-03-04 08:08:32'),
(616, 759, '3690.00', 3, '2024-01-19 00:00:00', 33, '2024-03-04 08:09:33'),
(617, 760, '3690.00', 3, '2024-01-19 00:00:00', 33, '2024-03-04 08:09:33'),
(618, 761, '6290.00', 1, '2024-01-10 00:00:00', 33, '2024-03-04 08:11:20'),
(619, 762, '390.00', 10, '2024-01-10 00:00:00', 33, '2024-03-04 08:12:38'),
(620, 763, '395.00', 10, '2024-01-19 00:00:00', 33, '2024-03-04 08:13:36'),
(621, 764, '398.00', 10, '2024-01-10 00:00:00', 33, '2024-03-04 08:14:47'),
(622, 765, '190.00', 10, '2024-01-10 00:00:00', 33, '2024-03-04 08:15:56'),
(623, 766, '225.00', 10, '2024-01-10 00:00:00', 33, '2024-03-04 08:17:35'),
(624, 767, '390.00', 20, '2024-01-10 00:00:00', 33, '2024-03-04 08:19:24'),
(625, 768, '210.00', 10, '2024-01-10 00:00:00', 33, '2024-03-04 08:20:42'),
(626, 769, '175.00', 20, '2024-01-10 00:00:00', 33, '2024-03-04 08:21:49'),
(627, 770, '159.00', 100, '2024-01-10 00:00:00', 33, '2024-03-04 08:25:01'),
(628, 771, '240.00', 100, '2024-01-10 00:00:00', 33, '2024-03-04 08:26:05'),
(629, 772, '1250.00', 50, '2024-01-10 00:00:00', 33, '2024-03-04 08:28:21'),
(630, 773, '890.00', 1, '2024-01-10 00:00:00', 33, '2024-03-04 08:29:42'),
(631, 774, '5960.00', 1, '2024-01-10 00:00:00', 33, '2024-03-04 08:30:37'),
(632, 775, '390.00', 5, '2024-01-10 00:00:00', 33, '2024-03-04 08:31:20'),
(633, 776, '5990.00', 4, '2024-01-10 00:00:00', 33, '2024-03-04 08:34:25'),
(634, 777, '225.00', 55, '2024-01-10 00:00:00', 33, '2024-03-04 08:36:46'),
(635, 778, '2690.00', 4, '2024-01-10 00:00:00', 33, '2024-03-04 08:38:10'),
(636, 779, '850.00', 4, '2024-01-10 00:00:00', 33, '2024-03-04 08:39:12'),
(637, 780, '290.00', 4, '2024-01-10 00:00:00', 33, '2024-03-04 08:40:59'),
(638, 781, '380.00', 4, '2024-01-10 00:00:00', 33, '2024-03-04 08:42:03'),
(639, 782, '790.00', 20, '2024-01-10 00:00:00', 33, '2024-03-04 08:42:50'),
(640, 783, '2390.00', 102, '2024-01-10 00:00:00', 33, '2024-03-04 08:44:23'),
(641, 784, '3315.00', 2, '2024-01-17 00:00:00', 33, '2024-03-04 08:47:41'),
(642, 785, '3468.00', 3, '2024-01-10 00:00:00', 33, '2024-03-04 08:53:41'),
(643, 786, '127.50', 5, '2024-01-10 00:00:00', 33, '2024-03-04 08:54:51'),
(644, 787, '168.30', 10, '2024-01-10 00:00:00', 33, '2024-03-04 08:57:18'),
(645, 788, '2910.40', 2, '0000-00-00 00:00:00', 33, '2024-03-04 08:59:36'),
(646, 789, '4820.35', 2, '2024-01-17 00:00:00', 33, '2024-03-04 09:01:50'),
(647, 790, '818.55', 10, '2024-01-17 00:00:00', 33, '2024-03-04 09:04:26'),
(648, 791, '309.23', 20, '2024-01-17 00:00:00', 33, '2024-03-04 09:06:42'),
(649, 792, '593.85', 10, '2024-01-17 00:00:00', 33, '2024-03-04 09:09:12'),
(650, 793, '2924.00', 2, '2024-01-17 00:00:00', 33, '2024-03-04 09:12:09'),
(651, 794, '1043.25', 2, '2024-01-17 00:00:00', 33, '2024-03-04 09:14:02'),
(652, 795, '2717.00', 1, '2024-01-17 00:00:00', 33, '2024-03-04 09:20:13'),
(653, 796, '1287.00', 2, '2024-01-17 00:00:00', 33, '2024-03-04 09:21:57'),
(654, 797, '35.70', 25, '2024-01-17 00:00:00', 33, '2024-03-04 09:24:37'),
(655, 798, '27.20', 25, '2024-01-17 00:00:00', 33, '2024-03-04 09:26:18'),
(656, 799, '44.20', 25, '2024-01-17 00:00:00', 33, '2024-03-04 09:27:34'),
(657, 800, '56.10', 25, '2024-01-17 00:00:00', 33, '2024-03-04 09:28:50'),
(658, 801, '141.10', 25, '2024-01-17 00:00:00', 33, '2024-03-04 09:30:21'),
(659, 802, '17.00', 25, '2024-01-17 00:00:00', 33, '2024-03-04 09:32:28'),
(660, 803, '360.00', 2, '2024-01-17 00:00:00', 33, '2024-03-05 01:45:07'),
(661, 804, '500.00', 10, '2024-01-17 00:00:00', 33, '2024-03-05 01:46:13'),
(662, 805, '290.00', 5, '2024-01-17 00:00:00', 33, '2024-03-05 01:47:08'),
(663, 806, '130.00', 20, '2024-01-17 00:00:00', 33, '2024-03-05 01:48:21'),
(664, 807, '770.00', 5, '2024-01-17 00:00:00', 33, '2024-03-05 01:49:42'),
(665, 808, '1600.00', 2, '2024-01-17 00:00:00', 33, '2024-03-05 01:53:14'),
(666, 809, '30.00', 20, '2024-01-17 00:00:00', 33, '2024-03-05 01:54:37'),
(667, 810, '4450.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 01:56:58'),
(668, 811, '110.00', 20, '2024-01-17 00:00:00', 33, '2024-03-05 01:57:59'),
(669, 812, '900.00', 2, '2024-01-17 00:00:00', 33, '2024-03-05 01:59:00'),
(670, 813, '70.00', 20, '2024-01-17 00:00:00', 33, '2024-03-05 01:59:43'),
(671, 814, '1700.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 02:01:08'),
(672, 815, '130.00', 10, '2024-01-17 00:00:00', 33, '2024-03-05 02:02:04'),
(673, 816, '360.00', 2, '2024-01-17 00:00:00', 33, '2024-03-05 02:02:52'),
(674, 817, '60.00', 20, '2024-01-17 00:00:00', 33, '2024-03-05 02:04:41'),
(675, 818, '130.00', 2, '2024-01-17 00:00:00', 33, '2024-03-05 02:05:20'),
(676, 819, '30.00', 20, '2024-01-17 00:00:00', 33, '2024-03-05 02:06:13'),
(677, 820, '7600.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 02:07:07'),
(678, 821, '5620.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 02:09:06'),
(679, 822, '3090.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 02:10:07'),
(680, 823, '3680.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 02:10:48'),
(681, 824, '5630.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 02:11:49'),
(682, 825, '220.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 02:12:32'),
(683, 826, '4600.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 02:14:26'),
(684, 827, '5740.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 02:15:10'),
(685, 828, '460.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 02:15:58'),
(686, 829, '1080.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 02:16:50'),
(687, 830, '5500.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 02:17:32'),
(688, 831, '5500.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 02:18:27'),
(689, 832, '290.00', 3, '2024-01-17 00:00:00', 33, '2024-03-05 02:19:06'),
(690, 833, '1600.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 02:19:56'),
(691, 834, '1800.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 02:20:48'),
(692, 835, '5750.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 02:22:00'),
(693, 836, '4540.00', 2, '2024-01-17 00:00:00', 33, '2024-03-05 02:22:42'),
(694, 837, '1720.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 02:23:34'),
(695, 838, '1390.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 02:24:22'),
(696, 839, '720.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 02:25:02'),
(697, 840, '4400.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 02:25:42'),
(698, 841, '1400.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 02:26:45'),
(699, 842, '4200.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 02:27:33'),
(700, 843, '2590.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 02:28:21'),
(701, 844, '2600.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 02:33:35'),
(702, 845, '5840.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 02:34:17'),
(703, 846, '3200.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 02:35:29'),
(704, 847, '3300.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 02:37:00'),
(705, 848, '11800.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 02:38:25'),
(706, 849, '4600.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 02:39:26'),
(707, 850, '4800.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 02:44:04'),
(708, 851, '1030.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 02:45:06'),
(709, 852, '1900.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 02:46:03'),
(710, 853, '420.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 02:47:06'),
(711, 854, '980.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 02:48:19'),
(712, 855, '3200.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 02:49:42'),
(713, 856, '3580.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 02:50:38'),
(714, 857, '2800.00', 1, '2024-01-17 00:00:00', 33, '2024-03-05 02:51:57'),
(715, 500, '99.00', 11, '2023-12-01 00:00:00', 33, '2024-03-07 02:48:21'),
(716, 515, '168.00', 10, '2023-12-01 00:00:00', 33, '2024-03-07 03:15:29'),
(717, 862, '80.00', 2, '2024-01-18 00:00:00', 33, '2024-03-07 04:03:24'),
(718, 862, '70.00', 1, '2024-03-01 00:00:00', 33, '2024-03-07 04:09:48'),
(719, 712, '100.00', 1, '2024-03-01 00:00:00', 33, '2024-03-07 04:10:33'),
(720, 712, '450.00', 1, '2024-03-01 00:00:00', 33, '2024-03-07 04:11:50'),
(721, 712, '70.00', 1, '2024-03-01 00:00:00', 33, '2024-03-07 04:13:52'),
(722, 863, '1.00', 1, '2024-03-01 00:00:00', 33, '2024-03-07 04:16:28'),
(723, 864, '1.00', 1, '2024-03-01 00:00:00', 33, '2024-03-07 04:18:19'),
(724, 865, '1.00', 1, '2024-03-01 00:00:00', 33, '2024-03-07 04:28:13'),
(725, 866, '1.00', 1, '2024-03-01 00:00:00', 33, '2024-03-07 04:34:51'),
(726, 867, '1.00', 1, '2024-03-01 00:00:00', 33, '2024-03-07 04:37:37'),
(727, 875, '50.00', 1, '2024-02-14 00:00:00', 33, '2024-03-18 06:52:23'),
(728, 878, '50.00', 1, '2024-02-14 00:00:00', 33, '2024-03-18 07:26:35'),
(729, 880, NULL, NULL, NULL, 33, '2024-07-03 07:38:42'),
(730, 881, NULL, NULL, NULL, 33, '2024-07-03 07:38:42'),
(731, 885, NULL, NULL, NULL, 33, '2024-07-03 07:38:42'),
(732, 886, NULL, NULL, NULL, 33, '2024-07-03 07:38:42'),
(733, 888, NULL, NULL, NULL, 33, '2024-07-03 07:38:42'),
(734, 889, NULL, NULL, NULL, 33, '2024-07-03 07:38:42'),
(735, 891, NULL, NULL, NULL, 33, '2024-07-03 07:38:42'),
(736, 893, NULL, NULL, NULL, 33, '2024-07-03 07:38:42'),
(737, 896, NULL, NULL, NULL, 33, '2024-07-03 07:38:42'),
(738, 897, NULL, NULL, NULL, 33, '2024-07-03 07:38:42'),
(739, 901, NULL, NULL, NULL, 33, '2024-07-03 07:38:42'),
(740, 903, NULL, NULL, NULL, 33, '2024-07-03 07:38:42');

-- --------------------------------------------------------

--
-- Table structure for table `tb_material_budget_year_log`
--

CREATE TABLE `tb_material_budget_year_log` (
  `mat_budget_log_id` int(11) NOT NULL,
  `mat_quantity` int(11) DEFAULT NULL COMMENT 'จำนวนที่เบิกออกไป',
  `mat_bud_id` int(11) DEFAULT NULL COMMENT 'รหัสการนำเข้าวัสดุ',
  `dis_id` int(11) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_material_budget_year_log`
--

INSERT INTO `tb_material_budget_year_log` (`mat_budget_log_id`, `mat_quantity`, `mat_bud_id`, `dis_id`, `create_date`) VALUES
(175, 1, 722, 167, '2024-05-03 06:26:27');

-- --------------------------------------------------------

--
-- Table structure for table `tb_material_type`
--

CREATE TABLE `tb_material_type` (
  `type_id` int(11) NOT NULL COMMENT 'รหัสประเภทครุภัณฑ์',
  `type_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อประเภทครุภัณฑ์',
  `create_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_material_type`
--

INSERT INTO `tb_material_type` (`type_id`, `type_name`, `create_date`) VALUES
(49, 'วัสดุสำนักงาน', '2023-09-06 09:01:13'),
(51, 'วัสดุไฟฟ้าและวิทยุ', '2023-09-06 09:38:49'),
(52, 'วัสดุงานบ้านงานครัว', '2023-09-06 09:39:11'),
(53, 'วัสดุก่อสร้าง', '2023-09-06 09:39:26'),
(54, 'วัสดุยานพาหนะและขนส่ง', '2023-09-06 09:39:55'),
(55, 'วัสดุเชื้อเพลิงและหล่อลื่น', '2023-09-06 09:40:20'),
(56, 'วัสดุวิทยาศาสตร์และการแพทย์', '2023-09-06 09:41:02'),
(57, 'วัสดุการเกษตร', '2023-09-06 09:41:19'),
(58, 'วัสดุโฆษณาและเผยแพร่', '2023-09-06 09:42:04'),
(59, 'วัสดุเครื่องแต่งกาย', '2023-09-06 09:42:24'),
(60, 'วัสดุกีฬา', '2023-09-06 09:42:37'),
(61, 'วัสดุคอมพิวเตอร์', '2023-09-06 09:42:52'),
(62, 'วัสดุการศึกษา', '2023-09-06 09:43:10'),
(63, 'วัสดุเครื่องดับเพลิง', '2023-09-06 09:43:29'),
(64, 'วัสดุสนาม', '2023-09-06 09:43:46'),
(65, 'วัสดุสำรวจ', '2023-09-06 09:45:09'),
(67, 'วัสดุจราจร', '2023-09-06 09:45:35'),
(68, 'วัสดุอื่นๆ', '2023-09-06 09:45:52'),
(69, 'วัสดุยาและเวชภัณฑ์', '2024-02-16 01:50:49'),
(70, 'วัสดุดนตรี', '2024-03-07 04:32:47');

-- --------------------------------------------------------

--
-- Table structure for table `tb_notification`
--

CREATE TABLE `tb_notification` (
  `noti_id` int(11) NOT NULL,
  `noti_title` varchar(255) DEFAULT NULL COMMENT 'หัวข้อแจ้งเตือน',
  `noti_detail` varchar(255) DEFAULT NULL COMMENT 'รายละเอียด',
  `token_id` int(11) DEFAULT NULL COMMENT 'แจ้งไปยัง token',
  `create_date` timestamp NULL DEFAULT current_timestamp(),
  `status` tinyint(1) DEFAULT 0 COMMENT '0, ยังไม่ดู 1 ดูแล้ว'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tb_repair`
--

CREATE TABLE `tb_repair` (
  `repair_id` int(11) NOT NULL COMMENT 'รหัสการซ่่อม',
  `repair_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รายละเอียดการซ่อม',
  `repair_status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'สถานะการส่งซ่อม',
  `repair_necessity` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ความจำเป็น เร่งด่วน',
  `repair_reason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'เหตุผลที่เร่งด่วน',
  `repair_note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'หมายเหตุ เนื่องจากต้องส่งซ่อมศูนย์',
  `repair_result` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ผลการซ่อม',
  `repair_date` datetime NOT NULL COMMENT 'วันที่แจ้งซ่่อมครุภัณฑ์',
  `repair_approve_date` datetime DEFAULT NULL COMMENT 'วันที่อนุมัติ',
  `repair_fixing_date` datetime DEFAULT NULL COMMENT 'วันที่ดำเนินการซ่อม',
  `repair_deadline_date` datetime DEFAULT NULL COMMENT 'วันที่ต้องซ่อมเสร็จ',
  `repair_success_date` datetime DEFAULT NULL COMMENT 'วันที่ซ่อมเสร็จ',
  `emp_approve` int(11) DEFAULT NULL COMMENT 'คนที่อนุมัติ',
  `equ_id` int(11) DEFAULT NULL COMMENT 'รหัสครุภัณฑ์',
  `emp_id` int(11) DEFAULT NULL COMMENT 'คนที่แจ้งซ่อม',
  `faction_id` int(11) DEFAULT NULL COMMENT 'แผนกรับซ่อม',
  `create_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tb_role`
--

CREATE TABLE `tb_role` (
  `role_id` int(11) NOT NULL COMMENT 'รหัสสิทธิ์',
  `role_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ชื่อสิทธิ์',
  `create_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_role`
--

INSERT INTO `tb_role` (`role_id`, `role_name`, `create_date`) VALUES
(1, 'ผู้ดูแลระบบ', '2023-02-13 06:08:52'),
(2, 'อาจารย์/บุคลากร', '2023-02-13 06:09:03'),
(3, 'เจ้าหน้าที่', '2023-02-13 07:14:09'),
(4, 'ช่าง', '2023-02-13 07:14:15'),
(5, 'เจ้าหน้าที่การเงิน', '2023-02-24 04:03:35'),
(1862, 'นิสิตช่วยงาน', '2024-02-14 04:03:35');

-- --------------------------------------------------------

--
-- Table structure for table `tb_room`
--

CREATE TABLE `tb_room` (
  `room_id` int(11) NOT NULL,
  `room_name` varchar(50) DEFAULT NULL,
  `room_floor` varchar(3) DEFAULT NULL,
  `room_detail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_room`
--

INSERT INTO `tb_room` (`room_id`, `room_name`, `room_floor`, `room_detail`) VALUES
(57, '106', 'G', ''),
(58, '101', 'G', 'ห้องพักผ่อน'),
(59, '214', '2', ''),
(60, '212', '2', ''),
(61, '213', '2', ''),
(63, '302', '3', ''),
(64, '102', 'G', ''),
(65, '103', 'G', ''),
(66, '104', 'G', ''),
(67, '107', 'G', ''),
(68, '108', 'G', ''),
(69, '109', 'G', ''),
(70, '201', '2', ''),
(71, '202', '2', ''),
(72, '203', '2', ''),
(73, '204', '2', ''),
(74, '205', '2', ''),
(75, '206', '2', ''),
(76, '207', '2', ''),
(77, '208', '2', ''),
(78, '209', '2', ''),
(79, '210', '2', ''),
(80, '211', '2', ''),
(81, '301', '3', ''),
(82, '303', '3', ''),
(83, '304', '3', ''),
(84, '305', '3', ''),
(85, '306', '3', ''),
(86, '307', '3', ''),
(87, '308', '3', ''),
(88, '309', '3', ''),
(89, '310', '3', ''),
(90, '311', '3', ''),
(91, '312', '3', ''),
(92, '313', '3', ''),
(93, '401', '4', ''),
(94, '402', '4', ''),
(95, '403', '4', ''),
(96, '404', '4', ''),
(97, '405', '4', ''),
(98, '406', '4', ''),
(100, '407', '4', ''),
(102, '408', '4', ''),
(103, '409', '4', ''),
(104, '410', '4', ''),
(105, '411', '4', ''),
(106, '412', '4', ''),
(107, '413', '4', ''),
(108, '501', '5', ''),
(109, '502', '5', ''),
(110, '503', '5', ''),
(111, '504', '5', ''),
(112, '505', '5', ''),
(113, '506', '5', ''),
(114, '507', '5', ''),
(116, '508', '5', ''),
(117, '509', '5', ''),
(118, '510', '5', ''),
(119, '511', '5', ''),
(120, '512', '5', ''),
(121, '513', '5', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_room_desc_equ`
--

CREATE TABLE `tb_room_desc_equ` (
  `room_desc_equ_id` int(11) NOT NULL,
  `room_id` int(11) DEFAULT NULL COMMENT 'ห้องไหน',
  `equ_id` int(11) NOT NULL COMMENT 'ครุภัณฑ์อะไร',
  `quantity` int(11) NOT NULL COMMENT 'จำนวน',
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `use_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_room_desc_equ`
--

INSERT INTO `tb_room_desc_equ` (`room_desc_equ_id`, `room_id`, `equ_id`, `quantity`, `create_date`, `use_status`) VALUES
(114, 58, 865, 1, '2024-04-26 07:14:06', '0'),
(115, 64, 865, 1, '2024-05-01 07:52:28', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tb_room_desc_mat`
--

CREATE TABLE `tb_room_desc_mat` (
  `room_desc_mat_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `mat_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tb_send_repair`
--

CREATE TABLE `tb_send_repair` (
  `send_repair_id` int(11) NOT NULL COMMENT 'รหัสการส่งซ่อม',
  `send_repair_company` varchar(255) DEFAULT NULL COMMENT 'ชื่อบริษัทที่ส่งซ่อม',
  `emp_send_id` int(11) DEFAULT NULL COMMENT 'รหัสช่างที่ส่งซ่อม',
  `send_repair_status` varchar(255) DEFAULT NULL,
  `send_repair_result` varchar(255) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT current_timestamp(),
  `emp_appv_id` int(11) DEFAULT NULL COMMENT 'รหัสคนที่ส่งซ่อม',
  `repair_id` int(11) DEFAULT NULL COMMENT 'รหัสการซ่อม'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tb_stock_equipment`
--

CREATE TABLE `tb_stock_equipment` (
  `equ_stock_id` int(11) NOT NULL,
  `equ_id` int(11) DEFAULT NULL,
  `equ_stock` int(11) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_stock_equipment`
--

INSERT INTO `tb_stock_equipment` (`equ_stock_id`, `equ_id`, `equ_stock`, `create_date`) VALUES
(872, 865, 0, '2024-03-18 08:55:35'),
(873, 866, 1, '2024-07-03 09:21:47'),
(874, 867, 1, '2024-07-03 09:22:03'),
(875, 868, 1111, '2024-08-14 10:25:53'),
(876, 869, 1111, '2024-08-14 10:25:57'),
(877, 870, 1111, '2024-08-14 10:26:02'),
(878, 871, 1111, '2024-08-14 10:26:06');

-- --------------------------------------------------------

--
-- Table structure for table `tb_stock_material`
--

CREATE TABLE `tb_stock_material` (
  `mat_stock_id` int(11) NOT NULL,
  `mat_id` int(11) DEFAULT NULL,
  `mat_quantity` int(11) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_stock_material`
--

INSERT INTO `tb_stock_material` (`mat_stock_id`, `mat_id`, `mat_quantity`, `create_date`) VALUES
(209, 397, 1000, '2024-02-14 06:37:55'),
(210, 398, 1000, '2024-02-14 06:41:29'),
(211, 399, 1000, '2024-02-14 06:44:27'),
(212, 400, 1000, '2024-02-14 06:45:12'),
(213, 401, 40, '2024-02-14 06:52:36'),
(214, 402, 24, '2024-02-14 06:53:16'),
(215, 403, 3, '2024-02-14 07:09:33'),
(216, 404, 3, '2024-02-15 01:39:56'),
(217, 407, 3, '2024-02-15 01:45:28'),
(218, 409, 1, '2024-02-15 01:52:11'),
(219, 410, 1, '2024-02-15 01:53:24'),
(220, 411, 50, '2024-02-15 01:58:06'),
(221, 413, 9, '2024-02-15 02:02:31'),
(222, 414, 9, '2024-02-15 02:03:49'),
(223, 415, 9, '2024-02-15 02:05:39'),
(224, 417, 185, '2024-02-15 07:49:42'),
(225, 418, 1, '2024-02-15 07:51:10'),
(226, 419, 1, '2024-02-15 07:52:28'),
(227, 420, 4, '2024-02-15 08:03:55'),
(228, 421, 5, '2024-02-15 08:06:36'),
(229, 422, 5, '2024-02-15 08:10:31'),
(230, 423, 6, '2024-02-15 08:13:13'),
(231, 424, 1, '2024-02-15 08:15:24'),
(232, 425, 4, '2024-02-15 08:17:35'),
(233, 426, 1, '2024-02-15 08:29:11'),
(234, 427, 1, '2024-02-15 08:30:28'),
(235, 429, 1, '2024-02-15 08:32:56'),
(236, 430, 1, '2024-02-15 08:34:55'),
(237, 431, 1, '2024-02-15 08:37:04'),
(238, 432, 1, '2024-02-15 08:40:26'),
(239, 433, 1, '2024-02-15 08:41:40'),
(240, 434, 1, '2024-02-15 08:42:55'),
(241, 435, 1, '2024-02-15 08:44:32'),
(242, 436, 1, '2024-02-15 08:46:50'),
(243, 438, 1, '2024-02-15 08:50:19'),
(244, 439, 1, '2024-02-15 08:52:35'),
(245, 440, 1, '2024-02-15 08:54:19'),
(246, 442, 1, '2024-02-15 08:56:09'),
(247, 444, 1, '2024-02-15 08:57:26'),
(248, 446, 1, '2024-02-15 08:59:10'),
(249, 447, 1, '2024-02-15 09:00:41'),
(250, 449, 1, '2024-02-15 09:02:19'),
(251, 450, 276, '2024-02-15 09:18:26'),
(252, 451, 1, '2024-02-15 09:20:23'),
(253, 452, 1, '2024-02-15 09:21:52'),
(254, 453, 1, '2024-02-15 09:22:42'),
(255, 454, 1, '2024-02-15 09:24:03'),
(256, 455, 1, '2024-02-15 09:25:36'),
(257, 456, 1, '2024-02-15 09:26:20'),
(258, 459, 4, '2024-02-15 09:30:25'),
(259, 460, 3, '2024-02-15 09:32:43'),
(260, 461, 1, '2024-02-15 09:34:15'),
(261, 462, 1, '2024-02-15 09:35:46'),
(262, 463, 1, '2024-02-16 01:52:36'),
(263, 464, 1, '2024-02-16 01:54:25'),
(264, 465, 1, '2024-02-16 01:56:43'),
(265, 466, 2, '2024-02-16 01:58:18'),
(266, 467, 1, '2024-02-16 02:00:00'),
(267, 468, 1, '2024-02-16 02:01:37'),
(268, 469, 1, '2024-02-16 02:03:01'),
(269, 470, 3, '2024-02-16 02:05:12'),
(270, 471, 1, '2024-02-16 02:06:30'),
(271, 472, 1, '2024-02-16 02:07:49'),
(272, 473, 1, '2024-02-16 02:09:47'),
(273, 474, 1, '2024-02-16 02:11:28'),
(274, 475, 12, '2024-02-16 02:13:05'),
(275, 476, 1, '2024-02-16 02:14:23'),
(276, 477, 1, '2024-02-16 02:32:28'),
(277, 478, 1, '2024-02-16 04:35:16'),
(278, 479, 30, '2024-02-16 04:48:31'),
(279, 480, 2, '2024-02-16 09:13:01'),
(280, 481, 1, '2024-02-16 09:23:27'),
(281, 482, 2, '2024-02-16 09:28:00'),
(282, 483, 2, '2024-02-19 01:54:26'),
(283, 484, 2, '2024-02-19 02:05:21'),
(284, 485, 2, '2024-02-19 02:06:37'),
(285, 486, 2, '2024-02-19 02:08:16'),
(286, 487, 2, '2024-02-19 02:09:55'),
(287, 488, 1, '2024-02-19 02:11:51'),
(288, 489, 1, '2024-02-19 02:17:58'),
(289, 490, 1, '2024-02-19 06:47:27'),
(290, 491, 509, '2024-02-19 06:50:17'),
(291, 492, 1, '2024-02-21 07:35:39'),
(292, 493, 1, '2024-02-21 07:42:38'),
(293, 494, 1, '2024-02-21 07:45:47'),
(294, 495, 1, '2024-02-21 08:01:08'),
(295, 496, 1, '2024-02-22 07:53:36'),
(296, 497, 1, '2024-02-22 07:55:21'),
(297, 498, 1, '2024-02-22 08:21:30'),
(298, 499, 1, '2024-02-22 08:24:14'),
(299, 500, 12, '2024-02-22 08:58:56'),
(300, 501, 12, '2024-02-23 02:02:19'),
(301, 502, 12, '2024-02-23 02:04:28'),
(302, 503, 24, '2024-02-23 02:07:38'),
(303, 504, 120, '2024-02-23 02:12:10'),
(304, 505, 4, '2024-02-23 02:14:40'),
(305, 506, 15, '2024-02-23 02:17:19'),
(306, 507, 1, '2024-02-23 02:21:06'),
(307, 508, 12, '2024-02-23 02:22:39'),
(308, 509, 12, '2024-02-23 02:27:02'),
(309, 510, 12, '2024-02-23 02:28:33'),
(310, 511, 12, '2024-02-23 02:33:47'),
(311, 512, 2, '2024-02-23 02:35:54'),
(312, 513, 4, '2024-02-23 02:37:21'),
(313, 514, 5, '2024-02-23 02:40:03'),
(314, 515, 15, '2024-02-23 02:54:43'),
(315, 516, 3, '2024-02-23 03:00:27'),
(316, 517, 5, '2024-02-23 03:02:24'),
(317, 518, 2, '2024-02-23 03:03:31'),
(318, 519, 2, '2024-02-23 03:10:21'),
(319, 520, 6, '2024-02-23 03:12:00'),
(320, 521, 150, '2024-02-23 03:24:46'),
(321, 522, 1, '2024-02-23 03:25:44'),
(322, 523, 5, '2024-02-23 03:29:13'),
(323, 524, 80, '2024-02-23 03:38:53'),
(324, 525, 2, '2024-02-23 03:41:03'),
(325, 526, 10, '2024-02-23 03:43:41'),
(326, 527, 15, '2024-02-23 04:42:59'),
(327, 530, 25, '2024-02-23 04:45:30'),
(328, 531, 2, '2024-02-23 04:48:31'),
(329, 532, 5, '2024-02-23 04:51:03'),
(330, 533, 5, '2024-02-23 04:56:15'),
(331, 534, 2, '2024-02-23 05:30:55'),
(332, 535, 6, '2024-02-23 05:33:53'),
(333, 536, 6, '2024-02-23 06:02:14'),
(334, 537, 2, '2024-02-23 06:04:31'),
(335, 538, 2, '2024-02-23 06:09:21'),
(336, 539, 1, '2024-02-23 06:10:32'),
(337, 540, 1, '2024-02-23 06:13:06'),
(338, 541, 1, '2024-02-23 06:14:25'),
(339, 542, 4, '2024-02-23 06:15:18'),
(340, 543, 4, '2024-02-23 06:17:18'),
(341, 544, 9, '2024-02-23 06:25:03'),
(342, 545, 1, '2024-02-23 06:25:46'),
(343, 546, 1, '2024-02-23 06:26:52'),
(344, 547, 2, '2024-02-23 06:28:07'),
(345, 548, 3, '2024-02-23 06:29:30'),
(346, 549, 2, '2024-02-23 06:32:16'),
(347, 550, 8, '2024-02-23 06:33:42'),
(348, 551, 1, '2024-02-23 06:34:52'),
(349, 552, 1, '2024-02-23 06:37:20'),
(350, 553, 50, '2024-02-23 06:38:47'),
(351, 554, 110, '2024-02-23 06:49:39'),
(352, 555, 1, '2024-02-23 06:50:56'),
(353, 556, 30, '2024-02-23 06:51:54'),
(354, 558, 22, '2024-02-23 06:53:03'),
(355, 559, 40, '2024-02-23 06:55:12'),
(356, 560, 3, '2024-02-23 06:57:16'),
(357, 561, 4, '2024-02-23 06:59:24'),
(358, 562, 10, '2024-02-23 07:07:00'),
(359, 563, 2, '2024-02-23 07:11:16'),
(360, 564, 2, '2024-02-23 07:15:20'),
(361, 565, 2, '2024-02-23 07:18:09'),
(362, 566, 2, '2024-02-23 07:20:16'),
(363, 567, 1, '2024-02-23 07:28:56'),
(364, 568, 3, '2024-02-23 07:33:03'),
(365, 569, 3, '2024-02-23 07:35:15'),
(366, 570, 3, '2024-02-23 07:36:35'),
(367, 571, 3, '2024-02-23 07:39:53'),
(368, 572, 2, '2024-02-23 07:41:15'),
(369, 573, 32, '2024-02-23 07:46:40'),
(370, 574, 16, '2024-02-23 07:50:48'),
(371, 575, 16, '2024-02-23 07:52:21'),
(372, 576, 45, '2024-02-23 07:55:14'),
(373, 577, 45, '2024-02-23 07:56:27'),
(374, 578, 3, '2024-02-23 07:58:57'),
(375, 579, 4, '2024-02-23 08:00:29'),
(376, 580, 4, '2024-02-23 08:01:49'),
(377, 581, 4, '2024-02-23 08:03:28'),
(378, 582, 5, '2024-02-23 08:04:38'),
(379, 583, 7, '2024-02-23 08:05:45'),
(380, 584, 1480, '2024-02-23 08:08:21'),
(381, 585, 3700, '2024-02-23 08:10:09'),
(382, 586, 6000, '2024-02-23 08:11:13'),
(383, 587, 2, '2024-02-23 08:16:26'),
(384, 588, 1, '2024-02-23 08:17:59'),
(385, 589, 1, '2024-02-23 08:21:07'),
(386, 590, 4, '2024-02-23 08:25:07'),
(387, 591, 1, '2024-02-23 08:27:17'),
(388, 592, 6, '2024-02-23 08:28:56'),
(389, 593, 1, '2024-02-23 08:30:41'),
(390, 594, 2, '2024-02-23 08:32:05'),
(391, 595, 1, '2024-02-23 08:33:39'),
(392, 596, 1, '2024-02-23 08:37:25'),
(393, 597, 2, '2024-02-23 08:40:55'),
(394, 598, 3, '2024-02-23 08:47:01'),
(395, 599, 3, '2024-02-23 08:48:26'),
(396, 600, 1, '2024-02-23 09:05:04'),
(397, 601, 1, '2024-02-23 09:06:47'),
(398, 602, 1, '2024-02-23 09:07:49'),
(399, 603, 1, '2024-02-23 09:12:00'),
(400, 604, 1, '2024-02-23 09:23:39'),
(401, 605, 1, '2024-02-23 09:25:23'),
(402, 606, 1, '2024-02-27 01:57:10'),
(403, 607, 2, '2024-02-27 02:00:20'),
(404, 608, 1, '2024-02-27 02:02:52'),
(405, 609, 1, '2024-02-27 02:04:46'),
(406, 610, 1, '2024-02-27 02:07:51'),
(407, 611, 1, '2024-02-27 02:10:43'),
(408, 612, 1, '2024-02-27 02:13:14'),
(409, 613, 1, '2024-02-27 02:16:08'),
(410, 614, 1, '2024-02-27 02:16:55'),
(411, 615, 1, '2024-02-27 02:18:21'),
(412, 616, 1, '2024-02-27 02:19:54'),
(413, 617, 1, '2024-02-27 02:24:49'),
(414, 618, 1, '2024-02-27 03:00:22'),
(415, 619, 1, '2024-02-27 05:20:01'),
(416, 620, 1, '2024-02-27 05:30:03'),
(417, 621, 2, '2024-03-01 01:59:15'),
(418, 622, 1, '2024-03-01 02:01:30'),
(419, 623, 20, '2024-03-01 02:03:10'),
(420, 624, 1, '2024-03-01 02:04:50'),
(421, 625, 10, '2024-03-01 08:32:28'),
(422, 626, 2, '2024-03-01 08:35:57'),
(423, 627, 20, '2024-03-01 08:39:24'),
(424, 628, 1, '2024-03-01 08:41:08'),
(425, 629, 50, '2024-03-01 08:46:30'),
(426, 630, 20, '2024-03-01 09:13:45'),
(427, 631, 10, '2024-03-01 09:15:12'),
(428, 632, 10, '2024-03-01 09:18:39'),
(429, 633, 5, '2024-03-01 09:19:44'),
(430, 634, 5, '2024-03-01 09:21:44'),
(431, 635, 2, '2024-03-01 09:22:39'),
(432, 636, 1, '2024-03-01 09:23:46'),
(433, 637, 2, '2024-03-01 09:28:12'),
(434, 638, 2, '2024-03-01 09:31:30'),
(435, 639, 10, '2024-03-04 01:52:48'),
(436, 640, 10, '2024-03-04 02:06:03'),
(437, 641, 10, '2024-03-04 02:08:02'),
(438, 642, 10, '2024-03-04 02:13:05'),
(439, 643, 10, '2024-03-04 02:18:18'),
(440, 644, 3, '2024-03-04 02:19:53'),
(441, 645, 11, '2024-03-04 02:22:09'),
(442, 646, 3, '2024-03-04 03:00:01'),
(443, 647, 2, '2024-03-04 03:12:30'),
(444, 648, 7, '2024-03-04 03:20:48'),
(445, 649, 2, '2024-03-04 03:24:00'),
(446, 651, 1, '2024-03-04 03:32:06'),
(447, 652, 1, '2024-03-04 03:34:00'),
(448, 653, 80, '2024-03-04 03:43:55'),
(449, 654, 70, '2024-03-04 03:50:19'),
(450, 655, 20, '2024-03-04 03:56:12'),
(451, 656, 10, '2024-03-04 03:57:30'),
(452, 657, 20, '2024-03-04 04:17:25'),
(453, 658, 2, '2024-03-04 04:18:34'),
(454, 659, 40, '2024-03-04 04:24:51'),
(455, 660, 5, '2024-03-04 04:32:48'),
(456, 661, 30, '2024-03-04 04:34:28'),
(457, 662, 5, '2024-03-04 04:43:36'),
(458, 663, 10, '2024-03-04 04:49:32'),
(459, 664, 320, '2024-03-04 04:56:40'),
(460, 665, 2300, '2024-03-04 04:57:55'),
(461, 666, 1, '2024-03-04 06:00:00'),
(462, 667, 20, '2024-03-04 06:01:14'),
(463, 668, 20, '2024-03-04 06:08:40'),
(464, 669, 20, '2024-03-04 06:10:37'),
(465, 670, 20, '2024-03-04 06:11:33'),
(466, 671, 2, '2024-03-04 06:15:40'),
(467, 672, 1, '2024-03-04 06:17:03'),
(468, 673, 10, '2024-03-04 06:18:14'),
(469, 674, 20, '2024-03-04 06:18:57'),
(470, 675, 1, '2024-03-04 06:26:52'),
(471, 676, 1, '2024-03-04 06:28:26'),
(472, 677, 1, '2024-03-04 06:29:21'),
(473, 678, 1, '2024-03-04 06:30:14'),
(474, 679, 5, '2024-03-04 06:32:03'),
(475, 681, 10, '2024-03-04 06:33:25'),
(476, 682, 1, '2024-03-04 06:34:07'),
(477, 683, 10, '2024-03-04 06:36:33'),
(478, 684, 5, '2024-03-04 06:38:16'),
(479, 685, 10, '2024-03-04 06:39:43'),
(480, 686, 4, '2024-03-04 06:41:05'),
(481, 687, 1, '2024-03-04 06:43:01'),
(482, 688, 1, '2024-03-04 06:43:49'),
(483, 689, 100, '2024-03-04 06:48:08'),
(484, 690, 50, '2024-03-04 06:48:54'),
(485, 691, 20, '2024-03-04 06:49:34'),
(486, 692, 50, '2024-03-04 06:50:25'),
(487, 693, 50, '2024-03-04 06:51:08'),
(488, 694, 8, '2024-03-04 06:53:09'),
(489, 695, 8, '2024-03-04 06:56:56'),
(490, 696, 10, '2024-03-04 07:00:28'),
(491, 697, 5, '2024-03-04 07:03:47'),
(492, 698, 1, '2024-03-04 07:08:13'),
(493, 699, 1, '2024-03-04 07:09:52'),
(494, 700, 1, '2024-03-04 07:11:15'),
(495, 701, 24, '2024-03-04 07:13:48'),
(496, 702, 7, '2024-03-04 07:14:40'),
(497, 703, 60, '2024-03-04 07:18:08'),
(498, 708, 1, '2024-03-04 07:21:41'),
(499, 708, 1, '2024-03-04 07:21:41'),
(500, 708, 1, '2024-03-04 07:21:41'),
(501, 708, 1, '2024-03-04 07:21:41'),
(502, 708, 1, '2024-03-04 07:21:41'),
(503, 709, 1, '2024-03-04 07:23:01'),
(504, 710, 2, '2024-03-04 07:24:22'),
(505, 711, 5, '2024-03-04 07:25:06'),
(506, 712, 9, '2024-03-04 07:25:47'),
(507, 713, 2, '2024-03-04 07:26:51'),
(508, 714, 10, '2024-03-04 07:28:07'),
(509, 715, 2, '2024-03-04 07:28:58'),
(510, 716, 5, '2024-03-04 07:29:38'),
(511, 717, 8, '2024-03-04 07:30:26'),
(512, 718, 2, '2024-03-04 07:31:11'),
(513, 719, 5, '2024-03-04 07:32:13'),
(514, 720, 1, '2024-03-04 07:32:58'),
(515, 721, 26, '2024-03-04 07:34:26'),
(516, 722, 13, '2024-03-04 07:35:50'),
(517, 723, 8, '2024-03-04 07:36:42'),
(518, 724, 1, '2024-03-04 07:37:35'),
(519, 725, 20, '2024-03-04 07:38:29'),
(520, 726, 300, '2024-03-04 07:39:39'),
(521, 727, 24, '2024-03-04 07:40:23'),
(522, 728, 24, '2024-03-04 07:41:09'),
(523, 729, 20, '2024-03-04 07:42:38'),
(524, 730, 24, '2024-03-04 07:43:33'),
(525, 731, 10, '2024-03-04 07:44:11'),
(526, 732, 48, '2024-03-04 07:45:13'),
(527, 733, 4, '2024-03-04 07:45:59'),
(528, 734, 3, '2024-03-04 07:47:16'),
(529, 735, 3, '2024-03-04 07:47:53'),
(530, 736, 10, '2024-03-04 07:49:10'),
(531, 737, 3, '2024-03-04 07:49:52'),
(532, 738, 24, '2024-03-04 07:50:59'),
(533, 739, 100, '2024-03-04 07:51:48'),
(534, 740, 100, '2024-03-04 07:52:37'),
(535, 741, 12, '2024-03-04 07:53:21'),
(536, 742, 10, '2024-03-04 07:54:06'),
(537, 743, 5, '2024-03-04 07:54:45'),
(538, 744, 5, '2024-03-04 07:55:24'),
(539, 745, 30, '2024-03-04 07:56:04'),
(540, 746, 5, '2024-03-04 07:56:48'),
(541, 747, 5, '2024-03-04 07:57:33'),
(542, 748, 10, '2024-03-04 07:58:20'),
(543, 749, 5, '2024-03-04 07:59:21'),
(544, 750, 4, '2024-03-04 07:59:53'),
(545, 751, 5, '2024-03-04 08:01:36'),
(546, 752, 12, '2024-03-04 08:02:27'),
(547, 753, 20, '2024-03-04 08:03:35'),
(548, 754, 5, '2024-03-04 08:04:31'),
(549, 755, 24, '2024-03-04 08:05:07'),
(550, 756, 10, '2024-03-04 08:05:59'),
(551, 757, 30, '2024-03-04 08:07:50'),
(552, 758, 20, '2024-03-04 08:08:32'),
(553, 759, 3, '2024-03-04 08:09:33'),
(554, 760, 3, '2024-03-04 08:09:33'),
(555, 761, 1, '2024-03-04 08:11:20'),
(556, 762, 10, '2024-03-04 08:12:38'),
(557, 763, 10, '2024-03-04 08:13:36'),
(558, 764, 10, '2024-03-04 08:14:47'),
(559, 765, 10, '2024-03-04 08:15:57'),
(560, 766, 10, '2024-03-04 08:17:35'),
(561, 767, 20, '2024-03-04 08:19:24'),
(562, 768, 10, '2024-03-04 08:20:42'),
(563, 769, 20, '2024-03-04 08:21:49'),
(564, 770, 100, '2024-03-04 08:25:01'),
(565, 771, 100, '2024-03-04 08:26:05'),
(566, 772, 50, '2024-03-04 08:28:21'),
(567, 773, 1, '2024-03-04 08:29:42'),
(568, 774, 1, '2024-03-04 08:30:37'),
(569, 775, 5, '2024-03-04 08:31:20'),
(570, 776, 4, '2024-03-04 08:34:25'),
(571, 777, 55, '2024-03-04 08:36:46'),
(572, 778, 4, '2024-03-04 08:38:10'),
(573, 779, 4, '2024-03-04 08:39:12'),
(574, 780, 4, '2024-03-04 08:41:00'),
(575, 781, 4, '2024-03-04 08:42:03'),
(576, 782, 20, '2024-03-04 08:42:50'),
(577, 783, 102, '2024-03-04 08:44:23'),
(578, 784, 2, '2024-03-04 08:47:41'),
(579, 785, 3, '2024-03-04 08:53:41'),
(580, 786, 5, '2024-03-04 08:54:51'),
(581, 787, 10, '2024-03-04 08:57:18'),
(582, 788, 2, '2024-03-04 08:59:36'),
(583, 789, 2, '2024-03-04 09:01:50'),
(584, 790, 10, '2024-03-04 09:04:26'),
(585, 791, 20, '2024-03-04 09:06:42'),
(586, 792, 10, '2024-03-04 09:09:12'),
(587, 793, 2, '2024-03-04 09:12:09'),
(588, 794, 2, '2024-03-04 09:14:02'),
(589, 795, 1, '2024-03-04 09:20:13'),
(590, 796, 2, '2024-03-04 09:21:57'),
(591, 797, 25, '2024-03-04 09:24:37'),
(592, 798, 25, '2024-03-04 09:26:18'),
(593, 799, 25, '2024-03-04 09:27:34'),
(594, 800, 25, '2024-03-04 09:28:50'),
(595, 801, 25, '2024-03-04 09:30:21'),
(596, 802, 25, '2024-03-04 09:32:28'),
(597, 803, 2, '2024-03-05 01:45:07'),
(598, 804, 10, '2024-03-05 01:46:13'),
(599, 805, 5, '2024-03-05 01:47:08'),
(600, 806, 20, '2024-03-05 01:48:21'),
(601, 807, 5, '2024-03-05 01:49:42'),
(602, 808, 2, '2024-03-05 01:53:14'),
(603, 809, 20, '2024-03-05 01:54:37'),
(604, 810, 1, '2024-03-05 01:56:58'),
(605, 811, 20, '2024-03-05 01:57:59'),
(606, 812, 2, '2024-03-05 01:59:00'),
(607, 813, 20, '2024-03-05 01:59:43'),
(608, 814, 1, '2024-03-05 02:01:08'),
(609, 815, 10, '2024-03-05 02:02:04'),
(610, 816, 2, '2024-03-05 02:02:52'),
(611, 817, 20, '2024-03-05 02:04:41'),
(612, 818, 2, '2024-03-05 02:05:20'),
(613, 819, 20, '2024-03-05 02:06:13'),
(614, 820, 1, '2024-03-05 02:07:07'),
(615, 821, 1, '2024-03-05 02:09:06'),
(616, 822, 1, '2024-03-05 02:10:07'),
(617, 823, 1, '2024-03-05 02:10:48'),
(618, 824, 1, '2024-03-05 02:11:49'),
(619, 825, 1, '2024-03-05 02:12:32'),
(620, 826, 1, '2024-03-05 02:14:26'),
(621, 827, 1, '2024-03-05 02:15:10'),
(622, 828, 1, '2024-03-05 02:15:58'),
(623, 829, 1, '2024-03-05 02:16:50'),
(624, 830, 1, '2024-03-05 02:17:32'),
(625, 831, 1, '2024-03-05 02:18:27'),
(626, 832, 3, '2024-03-05 02:19:06'),
(627, 833, 1, '2024-03-05 02:19:56'),
(628, 834, 1, '2024-03-05 02:20:48'),
(629, 835, 1, '2024-03-05 02:22:00'),
(630, 836, 2, '2024-03-05 02:22:42'),
(631, 837, 1, '2024-03-05 02:23:34'),
(632, 838, 1, '2024-03-05 02:24:22'),
(633, 839, 1, '2024-03-05 02:25:02'),
(634, 840, 1, '2024-03-05 02:25:42'),
(635, 841, 1, '2024-03-05 02:26:45'),
(636, 842, 1, '2024-03-05 02:27:33'),
(637, 843, 1, '2024-03-05 02:28:21'),
(638, 844, 1, '2024-03-05 02:33:35'),
(639, 845, 1, '2024-03-05 02:34:17'),
(640, 846, 1, '2024-03-05 02:35:29'),
(641, 847, 1, '2024-03-05 02:37:00'),
(642, 848, 1, '2024-03-05 02:38:25'),
(643, 849, 1, '2024-03-05 02:39:26'),
(644, 850, 1, '2024-03-05 02:44:04'),
(645, 851, 1, '2024-03-05 02:45:06'),
(646, 852, 1, '2024-03-05 02:46:03'),
(647, 853, 1, '2024-03-05 02:47:06'),
(648, 854, 1, '2024-03-05 02:48:19'),
(649, 855, 1, '2024-03-05 02:49:42'),
(650, 856, 1, '2024-03-05 02:50:38'),
(651, 857, 1, '2024-03-05 02:51:57'),
(652, 862, 3, '2024-03-07 04:03:24'),
(653, 863, 0, '2024-03-07 04:16:28'),
(654, 864, 1, '2024-03-07 04:18:19'),
(655, 865, 1, '2024-03-07 04:28:13'),
(656, 866, 1, '2024-03-07 04:34:51'),
(657, 867, 1, '2024-03-07 04:37:37'),
(658, 875, 1, '2024-03-18 06:52:23'),
(659, 878, 1, '2024-03-18 07:26:35'),
(660, 880, NULL, '2024-07-03 07:38:42'),
(661, 881, NULL, '2024-07-03 07:38:42'),
(662, 885, NULL, '2024-07-03 07:38:42'),
(663, 886, NULL, '2024-07-03 07:38:42'),
(664, 888, NULL, '2024-07-03 07:38:42'),
(665, 889, NULL, '2024-07-03 07:38:42'),
(666, 891, NULL, '2024-07-03 07:38:42'),
(667, 893, NULL, '2024-07-03 07:38:42'),
(668, 896, NULL, '2024-07-03 07:38:42'),
(669, 897, NULL, '2024-07-03 07:38:42'),
(670, 901, NULL, '2024-07-03 07:38:42'),
(671, 903, NULL, '2024-07-03 07:38:42');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sub_role`
--

CREATE TABLE `tb_sub_role` (
  `sub_role_id` int(11) NOT NULL,
  `sub_role_name` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_sub_role`
--

INSERT INTO `tb_sub_role` (`sub_role_id`, `sub_role_name`, `role_id`, `create_date`) VALUES
(1, 'แอดมิน', 1, '2023-02-13 06:16:49'),
(2, 'อาจารย์', 2, '2023-02-13 06:16:49'),
(3, 'เจ้าหน้าที่พัสดุ', 3, '2023-02-13 06:16:49'),
(4, 'ช่างเทคนิค', 4, '2023-02-13 06:16:49'),
(5, 'ช่างโสต', 4, '2023-02-13 06:16:49'),
(6, 'ช่างโครงสร้าง', 4, '2023-02-13 06:16:49'),
(7, 'ร้อยตำรวดทะหารเอกโทจัดตะวานาวาอากาดเอกจอมพลจอมทัพนายกรัดถะมนตรีสะพาผู้แทนราดสะดอน', 3, '2023-02-14 07:46:07'),
(8, 'เจ้าหน้าที่การเงิน', 5, '2023-02-23 04:14:59'),
(24, 'นิสิตช่วยงาน', 1862, '2024-02-14 04:14:59'),
(28, 'บุคคลกร', 1, '2024-04-29 07:56:13'),
(29, 'บุคคลกร2', 2, '2024-04-29 07:56:32'),
(30, 'บุคคลกร3', 3, '2024-04-29 07:56:48'),
(31, 'บุคคลกร4', 4, '2024-04-29 07:57:20');

-- --------------------------------------------------------

--
-- Table structure for table `tb_token_employee`
--

CREATE TABLE `tb_token_employee` (
  `emp_token_id` int(11) NOT NULL,
  `token_id` int(11) DEFAULT NULL COMMENT 'รหัส Token',
  `emp_id` int(11) DEFAULT NULL COMMENT 'รหัสพนักงาน',
  `create_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tb_unit`
--

CREATE TABLE `tb_unit` (
  `unit_id` int(11) NOT NULL COMMENT 'รหัสหน่วยนับ',
  `unit_name` varchar(60) DEFAULT NULL COMMENT 'ชื่อหน่วยนับ',
  `create_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_unit`
--

INSERT INTO `tb_unit` (`unit_id`, `unit_name`, `create_date`) VALUES
(61, 'รีม', '2023-09-06 09:01:51'),
(62, 'ชิ้น', '2023-09-06 09:02:12'),
(63, 'หลอด', '2023-09-06 09:03:03'),
(64, 'ใบ', '2024-02-14 06:12:03'),
(65, 'แท่ง', '2024-02-14 06:12:12'),
(66, 'ด้าม', '2024-02-14 06:42:02'),
(67, 'ก้อน', '2024-02-14 06:42:35'),
(68, 'แพค/ห่อ', '2024-02-14 06:50:09'),
(69, 'ตัว', '2024-02-15 01:56:47'),
(70, 'ชุด', '2024-02-15 02:01:11'),
(71, 'โหล', '2024-02-15 02:06:15'),
(72, 'อัน', '2024-02-15 08:08:50'),
(73, 'เล่ม', '2024-02-15 08:19:40'),
(74, 'ตลับ', '2024-02-15 09:29:19'),
(75, 'กระปุก', '2024-02-15 09:36:17'),
(76, 'แผง', '2024-02-15 09:36:24'),
(77, 'ขวด', '2024-02-15 09:36:41'),
(78, 'ม้วน', '2024-02-15 09:36:57'),
(79, 'ซอง', '2024-02-15 09:37:15'),
(80, 'กล่อง', '2024-02-16 02:47:25'),
(81, 'รายการ', '2024-02-19 02:16:54'),
(82, 'ถัง', '2024-02-23 03:23:39'),
(83, 'ลัง', '2024-02-23 04:42:18'),
(84, 'ป้าย', '2024-02-23 06:06:20'),
(85, 'แผ่น', '2024-02-23 08:07:35'),
(86, 'แพ็ค', '2024-03-04 02:09:22'),
(87, 'เครื่อง', '2024-03-04 06:27:40'),
(88, 'ถุง', '2024-03-04 06:35:43'),
(89, 'กิโลกรัม', '2024-03-04 07:12:59'),
(90, 'เส้น', '2024-03-04 07:17:11'),
(91, 'กระป๋อง', '2024-03-04 07:27:31'),
(92, 'คิว', '2024-03-04 07:33:43'),
(93, 'ผืน', '2024-03-04 07:46:44'),
(94, 'USแกลลอน', '2024-03-04 08:00:44'),
(95, 'หลัง', '2024-03-05 01:51:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_borrow`
--
ALTER TABLE `tb_borrow`
  ADD PRIMARY KEY (`borrow_id`) USING BTREE,
  ADD KEY `matetial_id` (`equipment_id`) USING BTREE,
  ADD KEY `tb_borrow_ibfk_5` (`emp_id`) USING BTREE,
  ADD KEY `tb_borrow_ibfk_6` (`room_desc_equ_id`) USING BTREE;

--
-- Indexes for table `tb_borrow_return`
--
ALTER TABLE `tb_borrow_return`
  ADD PRIMARY KEY (`return_id`) USING BTREE,
  ADD KEY `borrow_id` (`borrow_id`) USING BTREE;

--
-- Indexes for table `tb_branch`
--
ALTER TABLE `tb_branch`
  ADD PRIMARY KEY (`branch_id`) USING BTREE,
  ADD KEY `fac_id` (`fac_id`) USING BTREE;

--
-- Indexes for table `tb_budget_year`
--
ALTER TABLE `tb_budget_year`
  ADD PRIMARY KEY (`budget_id`) USING BTREE;

--
-- Indexes for table `tb_disburse`
--
ALTER TABLE `tb_disburse`
  ADD PRIMARY KEY (`dis_id`) USING BTREE,
  ADD KEY `emp_id_fk_disburse` (`emp_id`) USING BTREE,
  ADD KEY `admin_approve_fk_disburse` (`emp_approve`) USING BTREE;

--
-- Indexes for table `tb_disburse_cart`
--
ALTER TABLE `tb_disburse_cart`
  ADD PRIMARY KEY (`mat_cart_id`) USING BTREE,
  ADD KEY `mat_bud_id` (`mat_bud_id`) USING BTREE,
  ADD KEY `emp_id` (`emp_id`) USING BTREE;

--
-- Indexes for table `tb_disburse_detail`
--
ALTER TABLE `tb_disburse_detail`
  ADD PRIMARY KEY (`dis_det_id`) USING BTREE,
  ADD KEY `dis_id` (`dis_id`) USING BTREE;

--
-- Indexes for table `tb_employee`
--
ALTER TABLE `tb_employee`
  ADD PRIMARY KEY (`emp_id`) USING BTREE,
  ADD KEY `sub_id_fk_emp` (`sub_role_id`) USING BTREE;

--
-- Indexes for table `tb_equipment`
--
ALTER TABLE `tb_equipment`
  ADD PRIMARY KEY (`equ_id`) USING BTREE,
  ADD KEY `equ_type_id` (`equ_type_id`) USING BTREE;

--
-- Indexes for table `tb_equipment_budget_year`
--
ALTER TABLE `tb_equipment_budget_year`
  ADD PRIMARY KEY (`equ_bud_id`) USING BTREE,
  ADD KEY `equ_id_fkk_equ_budget` (`equ_id`) USING BTREE,
  ADD KEY `bud_id_fk_equ_budget` (`budget_id`) USING BTREE;

--
-- Indexes for table `tb_equipment_images`
--
ALTER TABLE `tb_equipment_images`
  ADD PRIMARY KEY (`equ_img_id`) USING BTREE,
  ADD KEY `equ_id_fk_equ_img` (`equ_id`) USING BTREE;

--
-- Indexes for table `tb_equipment_type`
--
ALTER TABLE `tb_equipment_type`
  ADD PRIMARY KEY (`type_id`) USING BTREE;

--
-- Indexes for table `tb_faculty`
--
ALTER TABLE `tb_faculty`
  ADD PRIMARY KEY (`fac_id`) USING BTREE;

--
-- Indexes for table `tb_line_token`
--
ALTER TABLE `tb_line_token`
  ADD PRIMARY KEY (`token_id`) USING BTREE;

--
-- Indexes for table `tb_material`
--
ALTER TABLE `tb_material`
  ADD PRIMARY KEY (`mat_id`) USING BTREE,
  ADD KEY `tb_unit_unit_id` (`unit_id`) USING BTREE,
  ADD KEY `fk_tb_material_mat_type_id` (`mat_type_id`) USING BTREE;

--
-- Indexes for table `tb_material_budget_year`
--
ALTER TABLE `tb_material_budget_year`
  ADD PRIMARY KEY (`mat_bud_id`) USING BTREE,
  ADD KEY `mat_id` (`mat_id`) USING BTREE,
  ADD KEY `budget_id` (`budget_id`) USING BTREE;

--
-- Indexes for table `tb_material_budget_year_log`
--
ALTER TABLE `tb_material_budget_year_log`
  ADD PRIMARY KEY (`mat_budget_log_id`) USING BTREE,
  ADD KEY `mat_bud_id` (`mat_bud_id`) USING BTREE;

--
-- Indexes for table `tb_material_type`
--
ALTER TABLE `tb_material_type`
  ADD PRIMARY KEY (`type_id`) USING BTREE;

--
-- Indexes for table `tb_notification`
--
ALTER TABLE `tb_notification`
  ADD PRIMARY KEY (`noti_id`) USING BTREE,
  ADD KEY `token_id_fk_noti` (`token_id`) USING BTREE;

--
-- Indexes for table `tb_repair`
--
ALTER TABLE `tb_repair`
  ADD PRIMARY KEY (`repair_id`) USING BTREE,
  ADD KEY `equ_id` (`equ_id`) USING BTREE,
  ADD KEY `emp_id _fk_repair_employee` (`emp_id`) USING BTREE,
  ADD KEY `emp_approve_fk_repair` (`emp_approve`) USING BTREE,
  ADD KEY `faction_id_fk_repair` (`faction_id`) USING BTREE;

--
-- Indexes for table `tb_role`
--
ALTER TABLE `tb_role`
  ADD PRIMARY KEY (`role_id`) USING BTREE;

--
-- Indexes for table `tb_room`
--
ALTER TABLE `tb_room`
  ADD PRIMARY KEY (`room_id`) USING BTREE;

--
-- Indexes for table `tb_room_desc_equ`
--
ALTER TABLE `tb_room_desc_equ`
  ADD PRIMARY KEY (`room_desc_equ_id`) USING BTREE,
  ADD KEY `room_id_fk_desc_room` (`room_id`) USING BTREE,
  ADD KEY `equ_id` (`equ_id`) USING BTREE;

--
-- Indexes for table `tb_room_desc_mat`
--
ALTER TABLE `tb_room_desc_mat`
  ADD PRIMARY KEY (`room_desc_mat_id`) USING BTREE,
  ADD KEY `room_id_fk_desc_room_mat` (`room_id`) USING BTREE,
  ADD KEY `mat_id_fk_desc_room_mat` (`mat_id`) USING BTREE;

--
-- Indexes for table `tb_send_repair`
--
ALTER TABLE `tb_send_repair`
  ADD PRIMARY KEY (`send_repair_id`) USING BTREE,
  ADD KEY `emp_send_id` (`emp_send_id`) USING BTREE,
  ADD KEY `emp_appv_id` (`emp_appv_id`) USING BTREE,
  ADD KEY `repair_id` (`repair_id`) USING BTREE;

--
-- Indexes for table `tb_stock_equipment`
--
ALTER TABLE `tb_stock_equipment`
  ADD PRIMARY KEY (`equ_stock_id`) USING BTREE,
  ADD KEY `fk_equ_id` (`equ_id`) USING BTREE;

--
-- Indexes for table `tb_stock_material`
--
ALTER TABLE `tb_stock_material`
  ADD PRIMARY KEY (`mat_stock_id`) USING BTREE,
  ADD KEY `fk_mat_id` (`mat_id`) USING BTREE;

--
-- Indexes for table `tb_sub_role`
--
ALTER TABLE `tb_sub_role`
  ADD PRIMARY KEY (`sub_role_id`) USING BTREE,
  ADD KEY `role_id` (`role_id`) USING BTREE;

--
-- Indexes for table `tb_token_employee`
--
ALTER TABLE `tb_token_employee`
  ADD PRIMARY KEY (`emp_token_id`) USING BTREE,
  ADD KEY `token_id_fk_token_emp` (`token_id`) USING BTREE,
  ADD KEY `emp_id_fk_token_emp` (`emp_id`) USING BTREE;

--
-- Indexes for table `tb_unit`
--
ALTER TABLE `tb_unit`
  ADD PRIMARY KEY (`unit_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_borrow`
--
ALTER TABLE `tb_borrow`
  MODIFY `borrow_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสการยืม', AUTO_INCREMENT=418;

--
-- AUTO_INCREMENT for table `tb_borrow_return`
--
ALTER TABLE `tb_borrow_return`
  MODIFY `return_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `tb_branch`
--
ALTER TABLE `tb_branch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสสาขา', AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tb_budget_year`
--
ALTER TABLE `tb_budget_year`
  MODIFY `budget_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tb_disburse`
--
ALTER TABLE `tb_disburse`
  MODIFY `dis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `tb_disburse_cart`
--
ALTER TABLE `tb_disburse_cart`
  MODIFY `mat_cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=322;

--
-- AUTO_INCREMENT for table `tb_disburse_detail`
--
ALTER TABLE `tb_disburse_detail`
  MODIFY `dis_det_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT for table `tb_employee`
--
ALTER TABLE `tb_employee`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `tb_equipment`
--
ALTER TABLE `tb_equipment`
  MODIFY `equ_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสวัสดุ', AUTO_INCREMENT=872;

--
-- AUTO_INCREMENT for table `tb_equipment_budget_year`
--
ALTER TABLE `tb_equipment_budget_year`
  MODIFY `equ_bud_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=862;

--
-- AUTO_INCREMENT for table `tb_equipment_images`
--
ALTER TABLE `tb_equipment_images`
  MODIFY `equ_img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tb_equipment_type`
--
ALTER TABLE `tb_equipment_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสประเภทวัสดุ', AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tb_faculty`
--
ALTER TABLE `tb_faculty`
  MODIFY `fac_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสคณะ', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_line_token`
--
ALTER TABLE `tb_line_token`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tb_material`
--
ALTER TABLE `tb_material`
  MODIFY `mat_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสครุภัณฑ์', AUTO_INCREMENT=904;

--
-- AUTO_INCREMENT for table `tb_material_budget_year`
--
ALTER TABLE `tb_material_budget_year`
  MODIFY `mat_bud_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=741;

--
-- AUTO_INCREMENT for table `tb_material_budget_year_log`
--
ALTER TABLE `tb_material_budget_year_log`
  MODIFY `mat_budget_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `tb_material_type`
--
ALTER TABLE `tb_material_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสประเภทครุภัณฑ์', AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `tb_notification`
--
ALTER TABLE `tb_notification`
  MODIFY `noti_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `tb_repair`
--
ALTER TABLE `tb_repair`
  MODIFY `repair_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสการซ่่อม', AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `tb_role`
--
ALTER TABLE `tb_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสสิทธิ์', AUTO_INCREMENT=1863;

--
-- AUTO_INCREMENT for table `tb_room`
--
ALTER TABLE `tb_room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `tb_room_desc_equ`
--
ALTER TABLE `tb_room_desc_equ`
  MODIFY `room_desc_equ_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `tb_room_desc_mat`
--
ALTER TABLE `tb_room_desc_mat`
  MODIFY `room_desc_mat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_send_repair`
--
ALTER TABLE `tb_send_repair`
  MODIFY `send_repair_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสการส่งซ่อม', AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tb_stock_equipment`
--
ALTER TABLE `tb_stock_equipment`
  MODIFY `equ_stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=879;

--
-- AUTO_INCREMENT for table `tb_stock_material`
--
ALTER TABLE `tb_stock_material`
  MODIFY `mat_stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=672;

--
-- AUTO_INCREMENT for table `tb_sub_role`
--
ALTER TABLE `tb_sub_role`
  MODIFY `sub_role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tb_token_employee`
--
ALTER TABLE `tb_token_employee`
  MODIFY `emp_token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `tb_unit`
--
ALTER TABLE `tb_unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสหน่วยนับ', AUTO_INCREMENT=96;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_borrow`
--
ALTER TABLE `tb_borrow`
  ADD CONSTRAINT `tb_borrow_ibfk_5` FOREIGN KEY (`emp_id`) REFERENCES `tb_employee` (`emp_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_borrow_ibfk_6` FOREIGN KEY (`room_desc_equ_id`) REFERENCES `tb_room_desc_equ` (`room_desc_equ_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_borrow_return`
--
ALTER TABLE `tb_borrow_return`
  ADD CONSTRAINT `tb_borrow_return_ibfk_1` FOREIGN KEY (`borrow_id`) REFERENCES `tb_borrow` (`borrow_id`);

--
-- Constraints for table `tb_branch`
--
ALTER TABLE `tb_branch`
  ADD CONSTRAINT `tb_branch_ibfk_1` FOREIGN KEY (`fac_id`) REFERENCES `tb_faculty` (`fac_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_disburse`
--
ALTER TABLE `tb_disburse`
  ADD CONSTRAINT `admin_approve_fk_disburse` FOREIGN KEY (`emp_approve`) REFERENCES `tb_employee` (`emp_id`),
  ADD CONSTRAINT `emp_id_fk_disburse` FOREIGN KEY (`emp_id`) REFERENCES `tb_employee` (`emp_id`);

--
-- Constraints for table `tb_disburse_cart`
--
ALTER TABLE `tb_disburse_cart`
  ADD CONSTRAINT `tb_disburse_cart_ibfk_1` FOREIGN KEY (`mat_bud_id`) REFERENCES `tb_material_budget_year` (`mat_bud_id`),
  ADD CONSTRAINT `tb_disburse_cart_ibfk_2` FOREIGN KEY (`emp_id`) REFERENCES `tb_employee` (`emp_id`);

--
-- Constraints for table `tb_disburse_detail`
--
ALTER TABLE `tb_disburse_detail`
  ADD CONSTRAINT `tb_disburse_detail_ibfk_1` FOREIGN KEY (`dis_id`) REFERENCES `tb_disburse` (`dis_id`);

--
-- Constraints for table `tb_employee`
--
ALTER TABLE `tb_employee`
  ADD CONSTRAINT `sub_id_fk_emp` FOREIGN KEY (`sub_role_id`) REFERENCES `tb_sub_role` (`sub_role_id`);

--
-- Constraints for table `tb_equipment`
--
ALTER TABLE `tb_equipment`
  ADD CONSTRAINT `type_id_fk_equ` FOREIGN KEY (`equ_type_id`) REFERENCES `tb_equipment_type` (`type_id`);

--
-- Constraints for table `tb_equipment_budget_year`
--
ALTER TABLE `tb_equipment_budget_year`
  ADD CONSTRAINT `bud_id_fk_equ_budget` FOREIGN KEY (`budget_id`) REFERENCES `tb_budget_year` (`budget_id`),
  ADD CONSTRAINT `equ_id_fkk_equ_budget` FOREIGN KEY (`equ_id`) REFERENCES `tb_equipment` (`equ_id`);

--
-- Constraints for table `tb_equipment_images`
--
ALTER TABLE `tb_equipment_images`
  ADD CONSTRAINT `equ_id_fk_equ_img` FOREIGN KEY (`equ_id`) REFERENCES `tb_equipment` (`equ_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_material`
--
ALTER TABLE `tb_material`
  ADD CONSTRAINT `fk_tb_material_mat_type_id` FOREIGN KEY (`mat_type_id`) REFERENCES `tb_material_type` (`type_id`),
  ADD CONSTRAINT `tb_unit_unit_id` FOREIGN KEY (`unit_id`) REFERENCES `tb_unit` (`unit_id`);

--
-- Constraints for table `tb_material_budget_year`
--
ALTER TABLE `tb_material_budget_year`
  ADD CONSTRAINT `tb_material_budget_year_ibfk_1` FOREIGN KEY (`mat_id`) REFERENCES `tb_material` (`mat_id`),
  ADD CONSTRAINT `tb_material_budget_year_ibfk_2` FOREIGN KEY (`budget_id`) REFERENCES `tb_budget_year` (`budget_id`);

--
-- Constraints for table `tb_material_budget_year_log`
--
ALTER TABLE `tb_material_budget_year_log`
  ADD CONSTRAINT `tb_material_budget_year_log_ibfk_1` FOREIGN KEY (`mat_bud_id`) REFERENCES `tb_material_budget_year` (`mat_bud_id`);

--
-- Constraints for table `tb_notification`
--
ALTER TABLE `tb_notification`
  ADD CONSTRAINT `token_id_fk_noti` FOREIGN KEY (`token_id`) REFERENCES `tb_line_token` (`token_id`);

--
-- Constraints for table `tb_repair`
--
ALTER TABLE `tb_repair`
  ADD CONSTRAINT `emp_approve_fk_repair` FOREIGN KEY (`emp_approve`) REFERENCES `tb_employee` (`emp_id`),
  ADD CONSTRAINT `emp_id_fk_repair` FOREIGN KEY (`emp_id`) REFERENCES `tb_employee` (`emp_id`),
  ADD CONSTRAINT `equ_id_fk_repair` FOREIGN KEY (`equ_id`) REFERENCES `tb_equipment` (`equ_id`),
  ADD CONSTRAINT `faction_id_fk_repair` FOREIGN KEY (`faction_id`) REFERENCES `tb_sub_role` (`sub_role_id`);

--
-- Constraints for table `tb_room_desc_equ`
--
ALTER TABLE `tb_room_desc_equ`
  ADD CONSTRAINT `equ_id_fk_desc_room` FOREIGN KEY (`equ_id`) REFERENCES `tb_equipment` (`equ_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `room_id_fk_desc_room` FOREIGN KEY (`room_id`) REFERENCES `tb_room` (`room_id`);

--
-- Constraints for table `tb_room_desc_mat`
--
ALTER TABLE `tb_room_desc_mat`
  ADD CONSTRAINT `mat_id_fk_desc_room_mat` FOREIGN KEY (`mat_id`) REFERENCES `tb_material` (`mat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `room_id_fk_desc_room_mat` FOREIGN KEY (`room_id`) REFERENCES `tb_room` (`room_id`);

--
-- Constraints for table `tb_send_repair`
--
ALTER TABLE `tb_send_repair`
  ADD CONSTRAINT `tb_send_repair_ibfk_1` FOREIGN KEY (`emp_send_id`) REFERENCES `tb_employee` (`emp_id`),
  ADD CONSTRAINT `tb_send_repair_ibfk_2` FOREIGN KEY (`emp_appv_id`) REFERENCES `tb_employee` (`emp_id`),
  ADD CONSTRAINT `tb_send_repair_ibfk_3` FOREIGN KEY (`repair_id`) REFERENCES `tb_repair` (`repair_id`);

--
-- Constraints for table `tb_stock_equipment`
--
ALTER TABLE `tb_stock_equipment`
  ADD CONSTRAINT `fk_equ_id` FOREIGN KEY (`equ_id`) REFERENCES `tb_equipment` (`equ_id`);

--
-- Constraints for table `tb_stock_material`
--
ALTER TABLE `tb_stock_material`
  ADD CONSTRAINT `fk_mat_id` FOREIGN KEY (`mat_id`) REFERENCES `tb_material` (`mat_id`);

--
-- Constraints for table `tb_sub_role`
--
ALTER TABLE `tb_sub_role`
  ADD CONSTRAINT `tb_sub_role_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `tb_role` (`role_id`);

--
-- Constraints for table `tb_token_employee`
--
ALTER TABLE `tb_token_employee`
  ADD CONSTRAINT `emp_id_fk_token_emp` FOREIGN KEY (`emp_id`) REFERENCES `tb_employee` (`emp_id`),
  ADD CONSTRAINT `token_id_fk_token_emp` FOREIGN KEY (`token_id`) REFERENCES `tb_line_token` (`token_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
