-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 30, 2021 at 04:24 AM
-- Server version: 5.6.49-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qrice_live`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_adminusers`
--

CREATE TABLE `tbl_adminusers` (
  `admin_id` int(11) NOT NULL,
  `adminname` varchar(150) NOT NULL,
  `username` varchar(150) NOT NULL,
  `roll` enum('Admin','Subadmin','Employee','Managers') NOT NULL DEFAULT 'Subadmin',
  `password` varchar(150) NOT NULL,
  `password_text` varchar(255) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mobile` varchar(150) NOT NULL,
  `adhar_card` varchar(150) NOT NULL,
  `pan_card` varchar(150) NOT NULL,
  `profile` varchar(150) NOT NULL,
  `status` enum('Active','Inactive','Trash') NOT NULL DEFAULT 'Active',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_adminusers`
--

INSERT INTO `tbl_adminusers` (`admin_id`, `adminname`, `username`, `roll`, `password`, `password_text`, `email`, `mobile`, `adhar_card`, `pan_card`, `profile`, `status`, `created_date`, `modified_date`) VALUES
(1, 'Admin', 'admin', 'Admin', '25d55ad283aa400af464c76d713c07ad', 'admin@123', 'balaji.rice2020@gmail.com', '7878787878', '', '', '5f4cc9c258473.jpg', 'Active', '2020-02-11 06:13:17', '2020-04-07 04:56:04');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_applogs`
--

CREATE TABLE `tbl_applogs` (
  `applog_id` int(11) NOT NULL,
  `funcation_name` varchar(250) NOT NULL,
  `params` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brands`
--

CREATE TABLE `tbl_brands` (
  `brand_id` int(11) NOT NULL,
  `image` varchar(250) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('Active','Inactive','Trash') NOT NULL DEFAULT 'Active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_brands`
--

INSERT INTO `tbl_brands` (`brand_id`, `image`, `name`, `status`) VALUES
(1, '5362Screenshot_20210129-132851_Gallery.jpg', 'Sai agro industries', 'Trash'),
(2, '54741. Sree Kedharalakshmi Agro Foods.jpeg', 'Sree Kedharalakshmi Agro Foods', 'Trash'),
(3, '77441. Sree Kedharalakshmi Agro Foods.jpeg', 'Sree Kedharalakshmi Agro Foods', 'Trash'),
(4, '94682. 25kg Uttam Back.jpeg', 'Uttam ', 'Trash'),
(5, '93021. Sree Kedharalakshmi Agro Foods.jpeg', 'SK Agro', 'Trash'),
(6, '82803. Padma Sai Agro.jpeg', 'PSA Industries', 'Active'),
(7, '95741. ITC Logo.JPG', 'ITC Limited', 'Active'),
(8, '1517images (14).jpeg', 'Sunpure', 'Trash'),
(9, '5779IMG-20210205-WA0002.jpg', 'All puri', 'Trash'),
(10, '678161WbzkliV6L._SX425_.jpg', 'Brandtest0502', 'Trash'),
(11, '401761WbzkliV6L._SX425_.jpg', 'Brand1test0502', 'Trash'),
(12, '1206KoalaBear200x200.jpg', 'testbrand', 'Trash'),
(13, '7355KoalaBear200x200.jpg', 'textbrandagain', 'Trash'),
(14, '628243.jpeg', 'Chinnu', 'Trash'),
(15, '2835FB_IMG_1612161946556.jpg', 'Sree Kedharalakshmi Agro Foods', 'Active'),
(16, '9904FB_IMG_1612161941837.jpg', 'Shree Maata Agro Tech', 'Active'),
(17, '6768Jeeni.JPG', 'Jeevitha Enterprises', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_carts`
--

CREATE TABLE `tbl_carts` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `buy_now` int(11) NOT NULL DEFAULT '0',
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_carts`
--

INSERT INTO `tbl_carts` (`cart_id`, `user_id`, `buy_now`, `product_id`, `qty`) VALUES
(43, 4, 0, 2, 1),
(103, 3, 0, 5, 1),
(104, 2, 1, 6, 1),
(144, 17, 0, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contacts`
--

CREATE TABLE `tbl_contacts` (
  `contact_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_deliveryaddresses`
--

CREATE TABLE `tbl_deliveryaddresses` (
  `address_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `primary_address` int(11) NOT NULL DEFAULT '0',
  `name` varchar(150) DEFAULT NULL,
  `mobile_number` varchar(150) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `locality` varchar(150) DEFAULT NULL,
  `city` text,
  `state` varchar(150) DEFAULT NULL,
  `pincode` varchar(150) DEFAULT NULL,
  `alt_mobile` varchar(150) DEFAULT NULL,
  `latitude` varchar(150) DEFAULT NULL,
  `longitude` varchar(150) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `status` enum('Active','Trash') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_deliveryaddresses`
--

INSERT INTO `tbl_deliveryaddresses` (`address_id`, `user_id`, `primary_address`, `name`, `mobile_number`, `address`, `locality`, `city`, `state`, `pincode`, `alt_mobile`, `latitude`, `longitude`, `type`, `status`) VALUES
(1, 1, 1, 'sathyanarayana k', '7975179949', 'no 201, 1st floor, krs endeavour, Kenchenahalli, Rajareshwari Nagar', NULL, 'Bangalore', 'karnataka', '560098', NULL, NULL, NULL, 'Home', 'Active'),
(2, 2, 0, 'rini Kanik', '9752525402', 'lorem ipsum street', NULL, 'Neemuch', 'Madhya Pradesh', '458441', NULL, NULL, NULL, 'Home', 'Active'),
(3, 3, 0, 'sj', '9752256670', 'indore', NULL, 'indore', 'mp', '456010', NULL, NULL, NULL, 'Home', 'Active'),
(4, 4, 1, 'sathyanarayana k', '9986870244', 'flat no 201, 1st floor, krs endeavour, kenchenahalli, rajarajeshwari nagar', NULL, 'Bangalore', 'karnataka', '560098', NULL, NULL, NULL, 'Home', 'Trash'),
(5, 2, 0, 'test', '9696969696', 'lorem ipsum street', NULL, 'neemuch', 'madhya pradesh', '452001', NULL, NULL, NULL, 'Home', 'Active'),
(6, 4, 1, 'sathyanarayana k', '9986870244', 'no 2120, shop no 02, 1st A main, 6th D Cross, kengeri Satellite town', NULL, 'Bengaluru', 'Karnataka', '560060', NULL, NULL, NULL, 'Home', 'Active'),
(7, 3, 1, 'sjj', '8962470921', 'indore', NULL, 'indore', 'mp', '456001', NULL, NULL, NULL, 'Home', 'Active'),
(8, 4, 0, 'Sathyanarayana K', '9986870244', 'no 2120, 1st A main, 6th D Cross  Kengeri Satellite Town', NULL, 'Bengaluru', 'Karnataka', '560060', NULL, NULL, NULL, 'Home', 'Active'),
(9, 5, 1, 'Sathyanarayana K', '9986870244', 'No 2120, Shop No 02, 1st A main, 6th D Cross, Kengeri Satellite Town', NULL, 'Bangalore', 'Karnataka', '560060', NULL, NULL, NULL, 'Home', 'Trash'),
(10, 5, 0, 'Sathyanarayana K', '9986870244', 'Flat No 201, 1st Floor, KRS Endeavour, Kenchenahalli, Rajarajeshwari Nagar', NULL, 'Bangalore', 'Karnataka', '560098', NULL, NULL, NULL, 'Home', 'Active'),
(11, 6, 0, 'Lokesh babu K r', '9632009563', 'avathi, ', NULL, 'devanahalli', 'karnataka', '562110', NULL, NULL, NULL, 'Home', 'Active'),
(12, 7, 0, 'Sathyanarayana K', '7975179949', 'No 2120, 1st A main, 6th D Cross, KG Town', NULL, 'Bangalore', 'Karnataka', '560060', NULL, NULL, NULL, 'Home', 'Trash'),
(13, 8, 0, 'loki', '9741314502', 'avathi', NULL, 'devanahalli', 'karnataka', '562110', NULL, NULL, NULL, 'Home', 'Active'),
(14, 11, 0, 'yamini', '9164111669', 'opp. lic officeswathi buildings, polytechnic road, k r Extension, ', NULL, 'Chintamani ', 'Karnataka ', '563125', NULL, NULL, NULL, 'Home', 'Active'),
(15, 7, 0, 'sathyanarayana K', '7975179949', 'flat no 201, 1st floor, krs endeavour, Kenchenahalli,  Rajareshwari nagar', NULL, 'Bangalore', 'karnataka', '560098', NULL, NULL, NULL, 'Home', 'Trash'),
(16, 12, 1, 'Madhusudhan K S', '8147559255', '#125, K.S.Colony, 1st Main, Ramakrishna Block, Thyagarajnagar, 2nd Block', NULL, 'Bengaluru', 'Karnataka', '560028', NULL, NULL, NULL, 'Home', 'Active'),
(17, 5, 0, 'sathyanarayana k', '9986870244', 'no 2120, shop no 02, 1st A main, 6th D Cross, kengeri Satellite town', NULL, 'Bangalore', 'karnataka', '560060', NULL, NULL, NULL, 'Home', 'Active'),
(18, 7, 0, 'tester', '1234569789', 'indore', NULL, 'indore', 'mp', '456010', NULL, NULL, NULL, 'Home', 'Active'),
(19, 7, 0, 'testernew', '1546434846', 'ujjain', NULL, 'ujjain', 'mp', '456001', NULL, NULL, NULL, 'Home', 'Active'),
(20, 5, 0, 'Sathyanarayana K', '9986870244', 'no 125, 1st main road, K S Colony, ramakrishna block, thyagarajanagar 2nd block', NULL, 'bangalore', 'karnataka', '560028', NULL, NULL, NULL, 'Home', 'Active'),
(21, 15, 0, 'Sagar K R', '9844446438', 'ghhbb', NULL, 'Bangalore', 'Karnataka', '560036', NULL, NULL, NULL, 'Home', 'Trash'),
(22, 15, 0, 'Sagar K R', '9844446438', 'santrupthi', NULL, 'Bangalore', 'Karnataka', '560036', NULL, NULL, NULL, 'Home', 'Active'),
(23, 16, 0, 'sathyanarayana K', '9986870244', 'no 201, 1st floor, krs endeavour, kenchenahalli, rajarajeshwari nagar', NULL, 'bangalore', 'karnataka', '560098', NULL, NULL, NULL, 'Home', 'Active'),
(24, 17, 0, 'Rini kanik', '9752525402', 'lorem ipsum street', NULL, 'neemu', 'Madhya Pradesh', '458441', NULL, NULL, NULL, 'Home', 'Active'),
(25, 17, 0, 'Rini Kanik', '9752525402', 'patel palaza ', NULL, 'neemuch', 'Madhya Pradesh', '458441', NULL, NULL, NULL, 'Home', 'Active'),
(26, 16, 0, 'Sathyanarayana K', '9986870244', 'No 2120, 1st A main, 6th D Cross, kengeri Satellite town', NULL, 'Bangalore', 'Karnataka', '560060', NULL, NULL, NULL, 'Home', 'Active'),
(27, 18, 0, 'sj', '9752256670', 'ujjain', NULL, 'ujjain', 'mp', '456010', NULL, NULL, NULL, 'Home', 'Active'),
(28, 18, 0, 'shubh', '7225001959', 'Tilaknagar indore', NULL, 'indore', 'madhya Pradesh ', '452018', NULL, '22.7189594', '75.897201', 'Home', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_deliveryboys`
--

CREATE TABLE `tbl_deliveryboys` (
  `deliveryboy_id` int(11) NOT NULL,
  `deliveryboyid` varchar(255) DEFAULT NULL,
  `fcmid` text,
  `name` varchar(255) DEFAULT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `otp` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `loginid` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `alt_mobile` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `ifsc_code` varchar(255) DEFAULT NULL,
  `pan_number` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `status` enum('Active','Inactive','Trash') NOT NULL DEFAULT 'Active',
  `onlinestatus` enum('Online','Offline') NOT NULL DEFAULT 'Online'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_deliveryboys`
--

INSERT INTO `tbl_deliveryboys` (`deliveryboy_id`, `deliveryboyid`, `fcmid`, `name`, `profile`, `otp`, `email`, `loginid`, `password`, `mobile`, `alt_mobile`, `address`, `city`, `state`, `pincode`, `bank_name`, `account_number`, `ifsc_code`, `pan_number`, `latitude`, `longitude`, `created_date`, `status`, `onlinestatus`) VALUES
(1, '0001', 'edrhWDWVQqy1WG1AYsSEpH:APA91bFPvNkQmq7nHZv9spESpU3uzGL7JUV8eQfdLo_gJrBAq03X5oizGXDPQ0MIDDTVPgzRl-bwqdFTkAUsyuz1u37W5TGFG1O_Ffkze9yRDDmUPCSkSKw0Uj-6kmU9b05l1qoa5JYG', 'TestDriver', '', NULL, 'testdriver@gmail.com', NULL, '25d55ad283aa400af464c76d713c07ad', '9887876756', NULL, 'lorem ipsum street', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-30 10:31:33', 'Trash', 'Online'),
(2, '123456789', 'frKprJO5SX-TyzlBrQgMOJ:APA91bGKSwwWnix7XN8VdrzWATHOoIQNiUBbYgz2UmNdx_R8WCvKnvSI1K_JF6DW_4gMt9D3_B3bGAxC38gCHut3tjUYpqyIOdRUv95kTWMhnFGjfrEAVYfq5HjdfiNP2OS2_C10Kysl', 'MADHU', '', NULL, 'lokeshbabu.kr1@gmail.com', NULL, '0a8bad7df4b858617b64c2169faabdd3', '9986870244', NULL, 'Rajarajeshwari nagar, bangalore', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-01 14:05:19', 'Trash', 'Online'),
(3, 'madhu', NULL, 'Madhu', '', '417496', 'sathya.anmol@gmail.com', NULL, '45474d69d3fac5b1e35cda7eef060fc8', '9986870244', NULL, 'Dgukkytrtt yuijg ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-10 13:50:25', 'Trash', 'Online'),
(4, 'RS1779', 'dwh9xN5YQrWAMXpjd1hosL:APA91bFlkCUU4hjHiPUz0aKNksdhYPe5bd3mj66bpdVe5kVlJH8DlGwr3RywsPP5uUi84gilg5mg403Cx_jaR0dqAFd4gLXp_5XImcYuc2pPLywxqrolZT0xdc03LQX1PyIR-ypJ98EF', 'Madhu', '', NULL, 'k.sathya146@gmail.com', NULL, '45474d69d3fac5b1e35cda7eef060fc8', '7975179949', NULL, 'Thyagarajanagar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 21:02:50', 'Trash', 'Online'),
(5, 'Driver1', 'd7CBZJ_tSzqlEXDbPyZS9k:APA91bG-Mj1xu2z_UTJcY4mEpPR7PzncK2UbfRyBNxkNhndaB3BeYNxHP_762uADLL8VA0_iWPTjaJz5An15NgzkGpOD36pma9y55VWPjNR9HIQ4myrfo9VFRrKFdhpUaM4gp4uDAUwj', 'Driver', '', NULL, 'driver@gmail.com', NULL, '25d55ad283aa400af464c76d713c07ad', '8435326838', NULL, 'lorem ipsum street Neemuch, madhya pradesh 458441', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-18 10:46:11', 'Trash', 'Online'),
(6, 'test123', 'dzin8UsYRbi6KwkP7uNadq:APA91bEPXOGcX6j2PWp7MokEK3DhSysqufW714tgoUI6ZZSugMPR1cbT4TQvnqmtE63fHP4j8dh5Uj_Mk3I6vR_2YpGusgGPP0YocKhzUKwYAm3asCo6uisEN4_SxHdlLcndTBSYd2dU', 'test', '', NULL, 'test123@gmail.com', NULL, 'e10adc3949ba59abbe56e057f20f883e', '7225001959', NULL, 'ujjain', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-21 19:16:30', 'Trash', 'Online'),
(7, 'RS1779', NULL, 'madhu', '', NULL, 'k.sathya146@gmail.com', NULL, '45474d69d3fac5b1e35cda7eef060fc8', '7975179949', NULL, 'xxxxxxx', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-17 21:05:24', 'Trash', 'Online'),
(8, 'RS1779', NULL, 'madhusudhan k s', '', NULL, 'k.sathya146@gmail.com', NULL, '45474d69d3fac5b1e35cda7eef060fc8', '7975179949', NULL, 'no 125, 1st main road, ks colony, r k block, thyagarajanagar 2nd block,  bengaluru 560070', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-04-02 12:57:38', 'Trash', 'Online'),
(9, 'RS1779', NULL, 'Madhu', '', NULL, 'sathya.anmol@gmail.com', NULL, '45474d69d3fac5b1e35cda7eef060fc8', '7975179949', NULL, '1234', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-04-15 14:58:34', 'Trash', 'Online'),
(10, 'RS1779', NULL, 'madhusudhan k s', '', NULL, 'balaji.rice2020@gmail.com', NULL, '45474d69d3fac5b1e35cda7eef060fc8', '7975179949', NULL, '125, 1st main, k s colony, r k block, t r nagar, blore 560028', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-04-29 11:53:35', 'Active', 'Online');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_emailcontents`
--

CREATE TABLE `tbl_emailcontents` (
  `emailcontent_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `label` text NOT NULL,
  `fromname` varchar(150) NOT NULL,
  `fromemail` varchar(150) NOT NULL,
  `tomail` varchar(150) DEFAULT NULL,
  `ccmail` text,
  `subject` varchar(150) NOT NULL,
  `emailcontent` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_emailcontents`
--

INSERT INTO `tbl_emailcontents` (`emailcontent_id`, `title`, `label`, `fromname`, `fromemail`, `tomail`, `ccmail`, `subject`, `emailcontent`, `created_date`) VALUES
(1, 'Welcome email to User', 'email: {email}, password: {password}', 'Qrice', 'support@moziztech.com', '', '', 'Welcome to Lequilla', '<p>Welcome, {name}</p>\r\n\r\nYou have been registered successfully at {link}\r\n\r\nWe are delighted to have you as part of our family and take part of our world wide mining project.\r\n\r\nYou are a few steps away to enjoying all the goodness we\'ve installed for you!Just log into your account now, click on \"DEPOSIT\", select a plan and watch your investment grow!\r\n\r\nYou can earn 16% to 20% of your Investment depending on the package you invest on!', '2017-11-10 04:46:59'),
(2, 'Forgot password details', 'Name: {name}, Email: {email}, Password: {password}', 'Qrice', 'support@moziztech.com', '', '', 'Forgot password', '<p>Dear {name},</p>\r\n\r\n<p>Please find a temporary password created for your account.</p>\r\n\r\n<p><strong>Email</strong>: {email}</p>\r\n\r\n<p><strong>Password</strong>: {password}</p>\r\n\r\n<p><strong>Thanks &amp; Regards</strong></p>\r\n\r\n<p><strong>Lequilla Team</strong></p>\r\n\r\n<p><strong>Note: </strong>Please do no respond this email.</p>\r\n', '2017-11-10 04:52:50'),
(3, 'Notification to customer : Order status', 'name: {name}, Product name: {product}, status: {status}', 'Qrice', 'support@moziztech.com', NULL, NULL, 'Lequilla Order Status', '<p>Dear<strong> {name}</strong></p>\r\n\r\n<p><strong>Order ID:</strong> {orderid} status has been updated to <strong>{status}</strong></p>\r\n\r\n\r\n<p>If you want to more details, Please contact support team contact@shopaik.com</p>\r\n\r\n<p><strong>Thanks &amp; Regards<br />\r\nSHOPAIK TEAM</strong></p>\r\n', '2017-11-21 05:06:01'),
(4, 'Notification to admin: profile update', 'name: {name}, Product name: {product}, status: {status}', 'Qrice', 'support@moziztech.com', NULL, NULL, 'IDLA : Profile update request', '<p>Dear<strong> Admin</strong></p>\r\n<p>A customer has requested profile updation!</p>\r\n<p>Below are the details:</p>\r\n<p>Customer ID: {customer_id}</p>\r\n<p>Customer Name: {customer_name}</p>\r\n<p>Mobile: {mobile}</p>\r\n<p>PlotNo: {address}</p>\r\n<p>Lane: {address2}</p>\r\n<p>Colony: {colony}</p>\r\n<p>City: {city}</p>\r\n<p>State: {state}</p>\r\n\r\n', '2017-11-21 05:06:01'),
(5, 'Welcome email to Vendor', 'name: {name}, email :{email},mobile :{mobile}', 'Qrice', 'support@moziztech.com', NULL, NULL, 'Welcome to Lequilla Team', '<p>Welcome, {name}</p>\r\n\r\n<p>Thankyou for register as an vendor in <b>Lequilla</b></p>\r\n\r\n<p>Email : {email}</p>\r\n<p>Phone Number : {mobile}</p>\r\n<br>\r\n<p>Please wait for admin Approval!</p>\r\n\r\n\r\n\r\n<p><strong>Thanks &amp; Regards</strong></p>\r\n\r\n<p><strong>Lequilla Team</strong></p>\r\n\r\n<p><strong>Note: </strong>Please do no respond this email.</p>\r\n\r\n', '2017-11-21 05:06:01'),
(6, 'Vendor registration notification to admin', '{name},{email},{phone},{shop_name},{location}', 'Qrice', 'support@moziztech.com', NULL, NULL, 'Vendor Registration Notification', '<p>Dear admin,</p>\r\n<p>Vendor has been registered in Lequilla</p>\r\n<p>Details are below</p>\r\n<p>Name: {name}</p>\r\n<p>Email: {email}</p>\r\n<p>Mobile: {phone}</p>\r\n<p>Shop Name: {shop_name}</p>\r\n<p>Location: {location}</p>\r\n<br>\r\n<p><strong>Thanks &amp; Regards</strong></p>\r\n\r\n<p><strong>Lequilla Team</strong></p>\r\n\r\n<p><strong>Note: </strong>Please do no respond this email.</p>', '2017-11-21 05:06:01'),
(7, 'Featured Product Request', 'productname : {productname} , vendorname : {vendorname} , shopname : {shopname}, amount : {amount}', 'Qrice', 'support@moziztech.com', NULL, NULL, 'Featured Product Request', '<p>Dear admin</p>\r\n\r\n<p>Vendor sent to a request for a Featured Product</p>\r\n<br>\r\n\r\n<p><b>Shop Name : </b> {shopname}</p>\r\n\r\n<p><b>Vendor Name : </b> {vendorname}</p>\r\n\r\n<p><b>Product Name :</b> {productname}</p>\r\n\r\n<p><b>Amount :</b> {amount}</p>\r\n\r\n<p>Thanks & Records, </p>\r\n<p>LeQuilla Team</p>\r\n\r\n<p>Please do not respond to this mail.</p>', '2017-11-21 05:06:01'),
(8, 'Order status', '{name},{status},{content}', 'Qrice', 'support@moziztech.com', NULL, NULL, 'Order status', '<p>Hi {name},</p>\r\n{status}\r\n<br>\r\n{content}\r\n<br>\r\n<p><strong>Thanks &amp; Regards</strong></p>\r\n\r\n<p><strong>Qrice Team</strong></p>\r\n\r\n<p><strong>Note: </strong>Please do no respond this email.</p>', '0000-00-00 00:00:00'),
(9, 'Vendor Status & Password Updation', 'name: {name}, email :{email},mobile :{mobile},\r\npassword :{password},link :{link}', 'Qrice', 'support@moziztech.com', NULL, NULL, 'Welcome to Lequilla Team', '<p>Welcome, {name}</p>\r\n\r\n<p>Your password updated successfully!</p>\r\n\r\n<p>Login Link : {link}</p>\r\n\r\n<p>Email : {email}</p>\r\n<p>Phone Number : {mobile}</p>\r\n<p>Password : {password}</p>\r\n<br>\r\n\r\n<p><strong>Thanks &amp; Regards</strong></p>\r\n\r\n<p><strong>Lequilla Team</strong></p>\r\n\r\n<p><strong>Note: </strong>Please do no respond this email.</p>\r\n\r\n', '2017-11-21 05:06:01'),
(10, 'Registration Status', 'name: {name}, email :{email},mobile :{mobile}\r\n', 'Qrice', 'support@moziztech.com', NULL, NULL, 'Welcome to Lequilla Team', '<p>Welcome, {name}</p>\r\n\r\n<p>Sorry!, your registration (vendor) has been rejected, please contact Admin.</p>\r\n\r\n<p>Email : {email}</p>\r\n<p>Phone Number : {mobile}</p>\r\n<br>\r\n\r\n<p><strong>Thanks &amp; Regards</strong></p>\r\n\r\n<p><strong>Lequilla Team</strong></p>\r\n\r\n<p><strong>Note: </strong>Please do no respond this email.</p>\r\n\r\n', '2017-11-21 05:06:01'),
(11, 'Featured Product Request', 'productname : {productname} , vendorname : {vendorname} , shopname : {shopname}, amount : {amount}', 'Qrice', 'support@moziztech.com', NULL, NULL, 'Featured Product Request', '<p>Dear {vendorname}</p>\r\n\r\n<p>Your request to admin successfully!, please wait for admin approval.</p>\r\n<br>\r\n\r\n<p><b>Shop Name :</b> {shopname}</p>\r\n\r\n<p><b>Vendor Name :</b> {vendorname}</p>\r\n\r\n<p><b>Product Name :</b> {productname}</p>\r\n\r\n<p><b>Total Amount :</b> {amount}</p>\r\n\r\n\r\n<p>Thanks & Records, </p>\r\n<p>LeQuilla Team</p>\r\n\r\n<p>Please do not respond to this mail.</p>', '2017-11-21 05:06:01'),
(12, 'Order status', '{vendorname},{status},{content}', 'Qrice', 'support@moziztech.com', NULL, NULL, 'Order status', '<p>Hi {vendorname},</p>\r\n{status}\r\n<br>\r\n{content}\r\n<br>\r\n<p><strong>Thanks &amp; Regards</strong></p>\r\n\r\n<p><strong>Lequilla Team</strong></p>\r\n\r\n<p><strong>Note: </strong>Please do no respond this email.</p>', '0000-00-00 00:00:00'),
(13, 'Welcome email to Staffs', '{email},{mobile},{password},{name}', 'Qrice', 'support@moziztech.com', '', '', 'Welcome to Lequilla', '<p>Welcome, {name}</p>\r\n\r\nYou have been registered successfully in LeQuilla\r\n\r\n<p>Email : <strong>{email}</strong></p>\r\n<p>Mobile : <strong>{mobile}</strong></p>\r\n<p>Password : <strong>{password}</strong></p>\r\n\r\n<p><strong>Thanks &amp; Regards</strong></p>\r\n\r\n<p><strong>Lequilla Team</strong></p>\r\n\r\n<p><strong>Note: </strong>Please do no respond this email.</p>', '2017-11-10 04:46:59'),
(14, 'password details', '{email},{mobile},{password},{name}', 'Qrice', 'support@moziztech.com', '', '', 'Staff Password Details', '<p>Welcome, {name}</p>\r\n\r\nYour password has been updated!.\r\n\r\n<p>Email : <strong>{email}</strong></p>\r\n<p>Mobile : <strong>{mobile}</strong></p>\r\n<p>Password : <strong>{password}</strong></p>\r\n\r\n<p><strong>Thanks &amp; Regards</strong></p>\r\n\r\n<p><strong>Lequilla Team</strong></p>\r\n\r\n<p><strong>Note: </strong>Please do no respond this email.</p>', '2017-11-10 04:46:59'),
(15, 'Deliveryboy Reg', '{loginid},{password}', 'Qrice', 'support@moziztech.com', '', '', 'Staff Password Details', '<p>Welcome, {name}</p>\r\n<p>You have been added as deliveryboy by Qrice Admin</p>\r\n<p>You can login to our Qrice app using below credentials</p>\r\n<p>Login ID:{loginid}</p>\r\n<p>Password:{password}</p>', '2017-11-10 04:46:59'),
(16, 'New Order', '{name},{content},{detail}', 'Qrice', 'support@moziztech.com', NULL, NULL, 'Order status', '<p>Dear {name},</p>\r\n{content}\r\n<br>\r\n{detail}\r\n<br>\r\n<p><strong>Thanks &amp; Regards</strong></p>\r\n\r\n<p><strong>Qrice Team</strong></p>\r\n\r\n<p><strong>Note: </strong>Please do no respond this email.</p>', '0000-00-00 00:00:00'),
(17, 'Notification to admin: new enquiry', 'name: {name}, email: {email}, subject: {subject}, message: {message}', 'Qrice', 'varsha.rana2507@gmail.com', NULL, NULL, 'New enquiry', '<p>Dear<strong> Admin</strong></p>\r\n<p>New enquiry has been submitted!</p>\r\n<p>Below are the details:</p>\r\n<p>Name: {name}</p>\r\n<p>email: {email}</p>\r\n<p>subject: {subject}</p>\r\n<p>message: {message}</p>\r\n\r\n', '2017-11-21 05:06:01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faqs`
--

CREATE TABLE `tbl_faqs` (
  `faq_id` int(11) NOT NULL,
  `title` tinytext NOT NULL,
  `detail` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_faqs`
--

INSERT INTO `tbl_faqs` (`faq_id`, `title`, `detail`) VALUES
(10, 'How do I register?', 'You can download the application from Google play store, then open QRice application & Signup with all details, After registration you can place order by logging into your account with login and password.'),
(11, 'Do I need to Register to Place order?', 'Only registered users are allowed to place an order and claim certain offers/discounts when placing order at QRice.in application platform. \r\nOR\r\nRegistered users can login and place order to claim available offers.'),
(12, 'Are there any charges for registration?', 'No fees will be charged for registering with QRice Application Platform.'),
(13, 'Can I have multiple registrations?', 'Each email address and contact phone number can only be associated with one QRice account.'),
(14, 'Can I add more than one delivery address in an account?', 'Yes, you can add multiple delivery addresses in your QRice account. However, remember that all items placed in a single order can only be delivered to one address. If you want different products delivered to different address you need to place them as separate orders.'),
(15, 'How do I reset my password?', 'Click on the forgot password in the login page, Provide Registered Mobile Number in order to receive an OTP (One Time Password), Then enter the same OTP in the application which will redirect to creation of new password.\r\nIn Case of any further issues feel free to contact our support team at (customersupport@qrice.in) or call (+91-7975179949).'),
(16, 'How do I place my order?', 'Register with us and then you will be able to shop for item of your choice from application.'),
(17, 'How do I pay? Do you offer CoD?', 'You can make payment at QRice Application as you want, (a) Cash on Delivery, (b) Net Banking on Ordering, (c) Credit/Debit card on Ordering (d) UPI Payments {Phonepe / Gpay / Amazon Pay etc.}  (e) We also accept Cash on Delivery where our customer care person will verify the order with you over phone and deliver it.'),
(18, 'Are there any other charges or taxes or hidden charges in addition to the price shown?', 'No, Price shown in the website is inclusive of GST for all products. Additional Delivery charges are not applicable for orders above 1500/- Rs & 49/- Rs as Nominal Delivery charges applicable for orders below 1500/-Rs.'),
(19, 'Where do I enter the promo code?', 'Once you are done selecting your products and click on checkout you will be prompted to select shipping address, then confirming the order you will be prompted to confirm order. On the confirm order page is an option to enter promo code. The amount will automatically be deducted from your invoice value.'),
(20, 'When will I receive my order?', 'Once you are done selecting your products and click on placing & confirming your order will be delivered within 48 hours on placing order. You will be contacted through provided mobile number to confirm the delivery timing and address.\r\nIn an unavoidable circumstance, we deliver within 5 business days but usually we are keen on 1-2 business days.\r\n'),
(21, 'How will the delivery be done?', 'We have a dedicated team of delivery personnel and fleet of vehicles operating across the city which ensures timely and accurate delivery to our valued customers.'),
(22, 'Can I Change the delivery info after Placing an Order?', 'No, once order has been processed delivery address cannot be changed, contact customer support for assistance.'),
(23, 'How much are the delivery charges?', 'Delivery charges are not applicable for orders above 1500/- Rs & includes 50/- Rs as Nominal Delivery charges applicable for orders below 1500/-Rs.'),
(24, 'Will someone inform me if my order delivery gets delayed?', 'In case of a delay, our customer support team will keep you updated about your delivery.'),
(25, 'Is it possible to order an item which is out of stock?', 'No you can only order products which are in stock. We try to ensure availability of all products on our application however due to supply chain issues sometimes this is not possible'),
(26, 'How do I check the current status of my order?', 'The only way you can check the status of your order is by contacting our customer support team.'),
(27, 'When and how can I cancel an order?', 'You can cancel your order at any time before we process and send the â€œprocessing\" email to you (Usually within 1-2 hours of placing the order) by contacting customer support team customersupport@qrice.in or +91-7959179949. and once the cancellation is approved we will refund the amount within 48 hours and the amount will reflect within 5 working days. Your entire order amount will be refunded via the refund method selected by you.'),
(28, 'Is it safe to shop here?', 'YES. We use the Secure Sockets Layer (SSL) encryption on banking transaction. To make online purchases from us, you must use an SSL-enabled browser. Doing this protects the confidentiality of your personal and credit card information while itâ€™s transmitted over the Internet.'),
(29, 'Do you use cookies?', 'Yes, we do. We use them to personalize your experience on our Platform. Personalize means we wish to keep your session in cookies and when you access the same system our site will remember you with the cookie. If you logout site then cookies will get reset automatically.'),
(30, 'How safe is the information shared with you?', 'We do not share, sell or rent your contact information. However, in rare exceptions where it may be required by the laws of the land, we may have to share the information.'),
(31, 'I have a question which is not answered here, what do I do?', 'Call our Customer Care Centre at +91 7975179949 or email at customersupport@qrice.in, our customer care representatives will initiate and take care of your queries and provide a resolution at the earliest convenience.\r\nAvailable all seven days from 8 AM to 8 PM.'),
(32, 'How will the delivery be done?', 'We have a dedicated team of delivery personnel and fleet of vehicles operating across the city which ensures timely and accurate delivery to our valued customers.\r\n'),
(33, 'testing', 'hello world');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notifications`
--

CREATE TABLE `tbl_notifications` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL,
  `customers` text,
  `deliveryboys` text,
  `expiry_date` date NOT NULL,
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_offers`
--

CREATE TABLE `tbl_offers` (
  `id` int(11) NOT NULL,
  `expiry_date` date NOT NULL,
  `text` text,
  `customers` text,
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orderdetails`
--

CREATE TABLE `tbl_orderdetails` (
  `orderdetail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `qty` float NOT NULL,
  `total_amount` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_orderdetails`
--

INSERT INTO `tbl_orderdetails` (`orderdetail_id`, `order_id`, `product_id`, `price`, `qty`, `total_amount`) VALUES
(1, 1, 2, 300, 1, 300),
(2, 2, 2, 300, 1, 300),
(3, 3, 2, 300, 1, 300),
(4, 4, 2, 300, 1, 300),
(5, 5, 2, 300, 1, 300),
(6, 6, 2, 300, 1, 300),
(7, 7, 2, 300, 1, 300),
(8, 8, 2, 300, 1, 300),
(9, 9, 2, 300, 1, 300),
(10, 10, 2, 300, 1, 300),
(11, 11, 4, 1199, 1, 1199),
(12, 12, 4, 1199, 1, 1199),
(13, 13, 4, 1199, 1, 1199),
(14, 14, 4, 1199, 1, 1199),
(15, 15, 4, 1199, 1, 1199),
(16, 16, 6, 379, 1, 379),
(17, 17, 6, 379, 1, 379),
(18, 18, 4, 1249, 1, 1249),
(19, 19, 4, 1249, 1, 1249),
(20, 20, 6, 390, 1, 390),
(21, 21, 6, 390, 1, 390),
(22, 22, 6, 390, 1, 390),
(23, 23, 4, 1249, 2, 2498),
(24, 24, 4, 1249, 1, 1249),
(25, 25, 4, 1249, 1, 1249),
(26, 26, 4, 1249, 1, 1249),
(27, 27, 4, 1249, 1, 1249),
(28, 28, 5, 1249, 1, 1249),
(29, 29, 6, 390, 1, 390),
(30, 30, 4, 1249, 1, 1249),
(31, 31, 4, 1249, 2, 2498),
(32, 32, 6, 390, 1, 390),
(33, 33, 5, 1249, 1, 1249),
(34, 34, 6, 390, 1, 390),
(35, 35, 6, 390, 1, 390),
(36, 36, 6, 390, 1, 390),
(37, 37, 4, 1249, 1, 1249),
(38, 38, 4, 1249, 1, 1249),
(39, 39, 4, 1249, 1, 1249),
(40, 40, 4, 1249, 1, 1249),
(41, 40, 5, 1249, 1, 1249),
(42, 41, 4, 1249, 1, 1249),
(43, 42, 4, 1249, 1, 1249),
(44, 43, 5, 1249, 1, 1249),
(45, 44, 5, 1249, 1, 1249),
(46, 44, 4, 1249, 1, 1249),
(47, 45, 5, 1249, 1, 1249),
(48, 46, 5, 1249, 1, 1249),
(49, 47, 5, 1249, 1, 1249),
(50, 48, 4, 1249, 1, 1249),
(51, 49, 4, 1249, 1, 1249),
(52, 50, 6, 390, 1, 390),
(53, 51, 6, 390, 1, 390),
(54, 52, 6, 390, 1, 390),
(55, 53, 5, 1249, 1, 1249),
(56, 53, 4, 1249, 1, 1249),
(57, 54, 6, 390, 1, 390),
(58, 55, 6, 390, 1, 390),
(59, 56, 6, 390, 1, 390),
(60, 57, 7, 369, 1, 369),
(61, 58, 8, 2, 1, 2),
(62, 59, 8, 2, 1, 2),
(63, 60, 8, 2, 1, 2),
(64, 61, 7, 369, 1, 369);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ordernotifications`
--

CREATE TABLE `tbl_ordernotifications` (
  `notify_id` int(11) NOT NULL,
  `msg` varchar(250) NOT NULL,
  `notify_from` varchar(100) NOT NULL,
  `id` int(11) NOT NULL,
  `to` varchar(100) NOT NULL,
  `to_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ordernotifications`
--

INSERT INTO `tbl_ordernotifications` (`notify_id`, `msg`, `notify_from`, `id`, `to`, `to_id`, `created_date`) VALUES
(1, 'Your order status updated to Delivered!. Order Id - ORDER10011', 'order', 11, 'User', 6, '2021-02-01 16:50:49'),
(2, 'Your order status updated to Delivered!. Order Id - ORDER10012', 'order', 12, 'User', 7, '2021-02-01 14:46:06'),
(3, 'Your order status updated to Delivered!. Order Id - ORDER10009', 'order', 9, 'User', 5, '2021-02-01 16:51:04'),
(4, 'Your order status updated to Delivered!. Order Id - ORDER10010', 'order', 10, 'User', 5, '2021-02-01 16:50:57'),
(5, 'Your order status updated to Delivered!. Order Id - ORDER10015', 'order', 15, 'User', 11, '2021-02-01 16:50:40'),
(6, 'Your order status updated to Delivered!. Order Id - ORDER10013', 'order', 13, 'User', 5, '2021-02-01 16:52:23'),
(7, 'Your order status updated to Delivered!. Order Id - ORDER10014', 'order', 14, 'User', 8, '2021-02-01 16:52:30'),
(8, 'Your order status updated to Delivered!. Order Id - ORDER10016', 'order', 16, 'User', 7, '2021-02-01 19:58:39'),
(9, 'Your order status updated to Delivered!. Order Id - ORDER10018', 'order', 18, 'User', 5, '2021-02-03 01:22:21'),
(10, 'Your order status updated to Delivered!. Order Id - ORDER10017', 'order', 17, 'User', 7, '2021-02-03 01:22:27'),
(11, 'Your order status updated to Delivered!. Order Id - ORDER10019', 'order', 19, 'User', 7, '2021-02-03 01:22:14'),
(12, 'Your order status updated to Delivered!. Order Id - ORDER10020', 'order', 20, 'User', 8, '2021-02-03 21:35:39'),
(13, 'New Order Assigned for you!, please check it out!. Order Id - ORDER10022', 'order', 22, 'Dboy', 1, '2021-02-06 11:06:54'),
(14, 'Your order status updated to Delivered!. Order Id - ORDER10025', 'order', 25, 'User', 5, '2021-02-08 15:41:03'),
(15, 'Your order status updated to Delivered!. Order Id - ORDER10024', 'order', 24, 'User', 5, '2021-02-08 15:41:39'),
(16, 'Your order status updated to Delivered!. Order Id - ORDER10023', 'order', 23, 'User', 2, '2021-02-08 15:43:59'),
(17, 'Your order status updated to Delivered!. Order Id - ORDER10021', 'order', 21, 'User', 3, '2021-02-08 15:31:01'),
(18, 'Your order status updated to Delivered!. Order Id - ORDER10027', 'order', 27, 'User', 5, '2021-02-24 10:31:29'),
(19, 'Your order status updated to Delivered!. Order Id - ORDER10028', 'order', 28, 'User', 15, '2021-02-24 10:31:35'),
(20, 'Your order status updated to Delivered!. Order Id - ORDER10033', 'order', 33, 'User', 17, '2021-02-18 11:37:50'),
(21, 'Your order status updated to Delivered!. Order Id - ORDER10035', 'order', 35, 'User', 17, '2021-02-18 11:15:23'),
(22, 'Your order status updated to Delivered!. Order Id - ORDER10037', 'order', 37, 'User', 17, '2021-02-18 11:37:39'),
(23, 'Your order status updated to Delivered!. Order Id - ORDER10046', 'order', 46, 'User', 17, '2021-03-08 18:16:50'),
(24, 'Your order status updated to Delivered!. Order Id - ORDER10048', 'order', 48, 'User', 16, '2021-02-24 10:31:41'),
(25, 'New Order Assigned for you!, please check it out!. Order Id - ORDER10049', 'order', 49, 'Dboy', 6, '2021-02-23 12:45:49'),
(26, 'Your order status updated to Delivered!. Order Id - ORDER10051', 'order', 51, 'User', 17, '2021-03-02 18:34:50'),
(27, 'New Order Assigned for you!, please check it out!. Order Id - ORDER10052', 'order', 52, 'Dboy', 4, '2021-02-28 11:35:54'),
(28, 'Your order status updated to Delivered!. Order Id - ORDER10053', 'order', 53, 'User', 16, '2021-03-02 18:34:42'),
(29, 'Your order status updated to Out for Delivery!. Order Id - ORDER10054', 'order', 54, 'User', 16, '2021-03-02 18:34:36'),
(30, 'Your order status updated to Out for Delivery!. Order Id - ORDER10055', 'order', 55, 'User', 16, '2021-03-10 00:44:28'),
(31, 'New Order Assigned for you!, please check it out!. Order Id - ORDER10060', 'order', 60, 'Dboy', 5, '2021-03-08 18:18:54'),
(32, 'New Order Assigned for you!, please check it out!. Order Id - ORDER10061', 'order', 61, 'Dboy', 6, '2021-03-13 16:37:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `order_id` int(11) NOT NULL,
  `orderid` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `deliveryboy_id` int(11) DEFAULT NULL,
  `total_products` int(11) NOT NULL,
  `total_amount` double NOT NULL,
  `delivery_charge` double NOT NULL DEFAULT '0',
  `sample_rice_charge` double DEFAULT '0',
  `discount_code` varchar(200) DEFAULT NULL,
  `discount_amount` double DEFAULT '0',
  `grand_total` double DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `order_status` enum('Confirmed','Assigned','Re-assign','Out for Delivery','Delivered','Cancelled') DEFAULT 'Confirmed',
  `cancelled_by` enum('Admin','User','Dboy') DEFAULT NULL,
  `payment_id` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `instruction` text,
  `datetime` datetime NOT NULL,
  `delivery_datetime` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`order_id`, `orderid`, `user_id`, `deliveryboy_id`, `total_products`, `total_amount`, `delivery_charge`, `sample_rice_charge`, `discount_code`, `discount_amount`, `grand_total`, `address_id`, `order_status`, `cancelled_by`, `payment_id`, `payment_method`, `instruction`, `datetime`, `delivery_datetime`, `updated_date`) VALUES
(57, 'ORDER10057', 16, NULL, 1, 429, 50, 10, '', NULL, 369, 23, 'Cancelled', NULL, 'pay_Gk1UYAu6iJXJbc', 'Online', NULL, '2021-03-08 09:41:39', NULL, NULL),
(56, 'ORDER10056', 18, NULL, 1, 450, 50, 10, '', NULL, 390, 27, 'Confirmed', NULL, '', 'COD', NULL, '2021-03-06 14:11:52', NULL, NULL),
(55, 'ORDER10055', 16, 4, 1, 450, 50, 10, '', NULL, 390, 23, 'Out for Delivery', NULL, 'pay_Gi1ydnk21P1D7k', 'Online', NULL, '2021-03-03 08:52:10', NULL, NULL),
(54, 'ORDER10054', 16, 4, 1, 450, 50, 10, '', NULL, 390, 23, 'Out for Delivery', NULL, '', 'COD', NULL, '2021-03-02 18:33:56', NULL, NULL),
(53, 'ORDER10053', 16, 4, 2, 2558, 50, 10, '', NULL, 2498, 26, 'Delivered', NULL, '', 'COD', NULL, '2021-03-02 18:28:37', NULL, NULL),
(46, 'ORDER10046', 17, 6, 1, 1209, 50, 10, 'FYCKQS', 100, 1249, 25, 'Delivered', NULL, '', 'COD', NULL, '2021-02-21 20:45:04', NULL, NULL),
(52, 'ORDER10052', 16, 4, 1, 350, 50, 10, 'FYCKQS', 100, 390, 26, 'Cancelled', NULL, 'pay_Ggt9CccsHPndzs', 'Online', NULL, '2021-02-28 11:34:47', NULL, NULL),
(51, 'ORDER10051', 17, 4, 1, 450, 50, 10, '', NULL, 450, 25, 'Delivered', NULL, '', 'COD', NULL, '2021-02-28 11:23:46', NULL, NULL),
(50, 'ORDER10050', 16, NULL, 1, 350, 50, 10, 'FYCKQS', 100, 390, 26, 'Confirmed', NULL, 'pay_Gfphuxktw4NkXw', 'Online', NULL, '2021-02-25 19:33:58', NULL, NULL),
(49, 'ORDER10049', 17, 5, 1, 1209, 50, 10, 'FYCKQS', 100, 1249, 25, 'Assigned', NULL, '', 'COD', NULL, '2021-02-23 12:36:06', NULL, NULL),
(47, 'ORDER10047', 16, NULL, 1, 1209, 50, 10, 'FYCKQS', 100, 1249, 26, 'Confirmed', NULL, '', 'COD', NULL, '2021-02-23 11:30:49', NULL, NULL),
(48, 'ORDER10048', 16, 4, 1, 1309, 50, 10, '', NULL, 1249, 26, 'Delivered', NULL, '', 'COD', NULL, '2021-02-23 11:34:46', NULL, NULL),
(39, 'ORDER10039', 17, NULL, 1, 1309, 50, 10, 'FYCKQS', 100, 1369, 25, 'Confirmed', NULL, '', 'COD', NULL, '2021-02-18 11:50:58', NULL, NULL),
(38, 'ORDER10038', 17, NULL, 1, 60, 50, 10, '', NULL, 120, 25, 'Confirmed', NULL, '', 'COD', NULL, '2021-02-18 11:49:14', NULL, NULL),
(37, 'ORDER10037', 17, 5, 1, 1209, 50, 10, 'FYCKQS', 100, 1269, 25, 'Delivered', NULL, '', 'COD', NULL, '2021-02-18 11:22:14', NULL, NULL),
(36, 'ORDER10036', 17, NULL, 1, 340, 50, 0, 'FYCKQS', 100, 390, 25, 'Confirmed', NULL, '', 'COD', NULL, '2021-02-18 11:17:41', NULL, NULL),
(35, 'ORDER10035', 17, 5, 1, 340, 50, 0, 'FYCKQS', 100, 390, 25, 'Delivered', NULL, '', 'COD', NULL, '2021-02-18 11:06:05', NULL, NULL),
(34, 'ORDER10034', 17, NULL, 1, 440, 50, 0, '', NULL, 490, 25, 'Confirmed', NULL, '', 'COD', NULL, '2021-02-18 10:53:25', NULL, NULL),
(33, 'ORDER10033', 17, 6, 1, 1199, 50, 0, 'FYCKQS', 100, 1249, 24, 'Delivered', NULL, '', 'COD', NULL, '2021-02-18 10:40:27', NULL, NULL),
(32, 'ORDER10032', 17, NULL, 1, 340, 50, 0, 'FYCKQS', 100, 390, 24, 'Confirmed', NULL, '', 'COD', NULL, '2021-02-18 10:36:04', NULL, NULL),
(31, 'ORDER10031', 2, NULL, 1, 2548, 50, 0, '', NULL, 2598, 24, 'Cancelled', NULL, '', 'COD', NULL, '2021-02-18 10:30:26', NULL, NULL),
(29, 'ORDER10029', 15, NULL, 1, 440, 50, 0, '', NULL, 490, 22, 'Confirmed', NULL, '', 'COD', NULL, '2021-02-16 21:38:31', NULL, NULL),
(30, 'ORDER10030', 16, NULL, 1, 1299, 50, 0, '', NULL, 1349, 23, 'Cancelled', NULL, '', 'COD', NULL, '2021-02-16 22:24:00', NULL, NULL),
(28, 'ORDER10028', 15, 4, 1, 1299, 50, 0, '', NULL, 1349, 22, 'Delivered', NULL, '', 'COD', NULL, '2021-02-16 21:30:19', NULL, NULL),
(27, 'ORDER10027', 5, 4, 1, 1299, 50, 0, '', NULL, 1349, 17, 'Delivered', NULL, '', 'COD', NULL, '2021-02-10 13:45:16', NULL, NULL),
(58, 'ORDER10058', 18, NULL, 1, 6, 2, 2, '', NULL, 2, 27, 'Confirmed', NULL, 'pay_Gk2XHa7XvFEUmp', 'Online', NULL, '2021-03-08 10:42:59', NULL, NULL),
(59, 'ORDER10059', 18, NULL, 1, 6, 2, 2, '', NULL, 2, 27, 'Confirmed', NULL, 'pay_Gk2yNK4oSPKBQO', 'Online', NULL, '2021-03-08 11:10:39', NULL, NULL),
(60, 'ORDER10060', 18, 6, 1, 6, 2, 2, '', NULL, 2, 27, 'Assigned', NULL, '', 'COD', NULL, '2021-03-08 17:36:44', NULL, NULL),
(61, 'ORDER10061', 18, 6, 1, 373, 2, 2, '', NULL, 369, 27, 'Assigned', NULL, '', 'COD', NULL, '2021-03-13 16:37:05', NULL, NULL),
(62, 'ORDER10028', 15, 4, 1, 1299, 50, 0, '', NULL, 1349, 22, 'Delivered', NULL, '', 'COD', NULL, '2021-02-16 21:30:19', NULL, NULL),
(63, 'ORDER10027', 5, 4, 1, 1299, 50, 0, '', NULL, 1349, 17, 'Delivered', NULL, '', 'COD', NULL, '2021-02-10 13:45:16', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pincodes`
--

CREATE TABLE `tbl_pincodes` (
  `pin_id` int(11) NOT NULL,
  `pincode` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pincodes`
--

INSERT INTO `tbl_pincodes` (`pin_id`, `pincode`) VALUES
(2, 458441),
(3, 456010),
(4, 456001),
(5, 560098),
(6, 560060),
(7, 560028),
(8, 563125),
(9, 562110),
(10, 560100),
(11, 560103),
(12, 560036),
(13, 560070),
(14, 560004);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_productcategories`
--

CREATE TABLE `tbl_productcategories` (
  `procategory_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `status` enum('Active','Trash') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_productcategories`
--

INSERT INTO `tbl_productcategories` (`procategory_id`, `name`, `image`, `parent_id`, `status`) VALUES
(1, 'Rice', '1818images (13).jpeg', 0, 'Trash'),
(2, 'Rice', '75031. Rice.jpeg', 0, 'Trash'),
(3, 'Flours', '14292. Flours.jpeg', 0, 'Trash'),
(4, 'Rice', '38701. Rice.jpeg', 0, 'Trash'),
(5, 'Rice', '93531. Shree Maatha Agro Tech.jpeg', 0, 'Trash'),
(6, 'Raw Rice', '64942. Raw Rice.jpg', 0, 'Active'),
(7, 'Steam Rice', '72011. Rice.jpeg', 0, 'Trash'),
(8, 'Flour', '84762. Flours.jpeg', 0, 'Active'),
(9, 'Edible oil', '7924IMG-20210201-WA0008.jpg', 0, 'Trash'),
(10, 'Edible oil', '9847images (14).jpeg', 0, 'Trash'),
(11, 'Steam rice', '5076images (14).jpeg', 0, 'Trash'),
(12, 'Cattest0502', '113261WbzkliV6L._SX425_.jpg', 0, 'Trash'),
(13, 'test', '474KoalaBear200x200.jpg', 0, 'Trash'),
(14, 'testagain category', '5077KoalaBear200x200.jpg', 0, 'Trash'),
(15, 'Energy Foods', '2523Siri Danyagalu.JPG', 0, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `features` text,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `subcategory_id` int(11) DEFAULT NULL,
  `brand_id` int(11) NOT NULL DEFAULT '0',
  `image` varchar(255) NOT NULL,
  `weight` varchar(255) NOT NULL,
  `mrp` double NOT NULL,
  `our_price` double NOT NULL,
  `discount` varchar(255) NOT NULL,
  `discount_price` double NOT NULL,
  `inventory_value` int(11) NOT NULL,
  `lowstock_value` int(11) NOT NULL,
  `pincode` text,
  `status` enum('Active','Inactive','Trash') DEFAULT 'Active',
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`product_id`, `name`, `description`, `features`, `category_id`, `subcategory_id`, `brand_id`, `image`, `weight`, `mrp`, `our_price`, `discount`, `discount_price`, `inventory_value`, `lowstock_value`, `pincode`, `status`, `datetime`) VALUES
(1, 'Uttam', 'Good', 'Nice to eat', 1, 1, 1, '6520images (13).jpeg', '5 kg', 250, 200, '20', 180, 200, 10, '560098', 'Trash', '2021-01-29 23:49:19'),
(2, 'Ambati Raw Rice', 'this is for testing purpose', 'this is for testing purpose', 2, 3, 2, '44841. 25kgs Ambati Front 24M.jpeg', '25 Kg', 1499, 1299, '100', 1199, 91, 2, '458441,456010,456001,560098,560060,560028,563125,562110,560100,560103,560036', 'Trash', '2021-02-01 12:39:55'),
(3, 'Ambati Raw Rice', 'good rice', 'good rice', 2, 3, 2, '53551. 25kgs Ambati Front 24M.jpeg', '25 Kg', 1499, 1299, '100', 1199, 100, 3, '458441,456010,456001,560098,560060,560028,563125,562110,560100,560103,560036', 'Trash', '2021-02-01 12:42:45'),
(4, 'Ambati Sona Masoori', 'Ambati Sona Masoori Raw Rice has been perfectly aged making it non-sticky and fluffy when cooked. It is popularly used in the preparation of pulao, kheer, biryani and other delectable dishes. Dishes can be cooked in just 15 minutes using this rice. Buy Ambati Sona Masoori Raw Rice Online Now!\r\n\r\nDisclaimer:\r\nDespite our attempts to provide you with the most accurate information possible, the actual packaging, ingredients and color of the product may sometimes vary. Please read the label, directions and warnings carefully before use.', 'â€¢	It is very strong rice and contains high fibre contents.\r\nâ€¢	It has a very good aroma, lightweight and is also very delicious.\r\nâ€¢	It is considered using healthier than the basmati and is also easier to digest.\r\nâ€¢	Strengthens bones, Easy to cook.\r\nâ€¢	Sona Masoori rice contains a good amount of starch and needs to be rinsed before cooking.', 6, 6, 15, '43371. 25kgs Ambati Front 24M.jpeg', '25 Kg', 1499, 1299, '50 OFF', 1249, 10, 2, '458441,456010,456001,560098,560060,560028,563125,562110,560100,560103,560036,560070,560004', 'Active', '2021-03-03 08:53:45'),
(5, 'Uttam Special', 'Uttam Special Raw Rice is mainly cultivated in southern parts of India. It is rich in flavor and has a delightful aroma. The size of the grain is consistent as per the consumer\'s requirement. Buy Uttam Raw Rice online today!\r\n\r\nDisclaimer:\r\nDespite our attempts to provide you with the most accurate information possible, the actual packaging, ingredients and color of the product may sometimes vary. Please read the label, directions and warnings carefully before use.', 'â€¢	Packed with utmost care & Superior quality product.\r\nâ€¢	It is very strong rice and contains high fibre contents.\r\nâ€¢	It has a very good aroma, Fine texture, easier to digest and is also very delicious.\r\nâ€¢	Strengthens bones, Easy to cook.\r\nâ€¢	Sona Masoori rice contains a good amount of starch and needs to be rinsed before cooking.', 6, 6, 6, '57202. 25kg Uttam Front.jpeg', '25 Kg', 1499, 1299, '50 OFF', 1249, 1, 3, '458441,456010,456001,560098,560060,560028,563125,562110,560100,560103,560036,560070,560004', 'Active', '2021-02-23 11:08:47'),
(6, 'Aashirvaad Whole Wheat Atta', 'Aashirvaad Whole Wheat Atta provides the goodness of health in every bite. This product incorporates many benefits of wheat and lets your body maintain a nutrient balance. It is made of nutritious wheat grains. Also, it has a sweet taste that gives you fuller and softer rotis, every single time. Buy Aashirvaad Whole Wheat Atta online now. Despite our attempts to provide you with the most accurate information possible, the actual packaging, ingredients and color of the product may sometimes vary. Please read the label, directions and warnings carefully before use.', 'â€¢	No chemical fertilizers\r\nâ€¢	Free from pesticides\r\nâ€¢	Extra protein helps build strength', 8, 7, 7, '65071. 10kg Aashirvaad Front.jpg', '10 Kg', 490, 440, '50 OFF', 390, 4, 3, '458441,456010,456001,560098,560060,560028,563125,562110,560100,560103,560036,560070,560004', 'Active', '2021-02-25 15:37:59'),
(7, 'Jeeni Millet Health Mix', '. With protein, dietary fibre and iron you cannot ask for a better start to the day of your family.\r\n. A source of protein are the building blocks of our body and required to keep our immunity levels up.\r\n. 100% Natural and 0% additive free product, so that the cereals and millets used can deliver goodness of nature.', '. 100% Natural and 0% additive free product, so that the cereals and millets used can deliver goodness of nature.', 15, 9, 17, '805220210306_202509.jpg', '1 Kg', 369, 369, '0', 369, 3, 2, '458441,456010,456001,560098,560060,560028,563125,562110,560100,560103,560036,560070,560004', 'Active', '2021-03-06 20:26:18'),
(8, 'TestProduct', 'This is for testing purpose', 'This is for testing purpose', 6, 4, 7, '798961WbzkliV6L._SX425_.jpg', '1 kg', 100, 99, '97 OFF', 2, 7, 1, '458441,456010,456001,560098,560060,560028,563125,562110,560100,560103,560036,560070,560004', 'Active', '2021-03-08 10:02:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_productsubcategories`
--

CREATE TABLE `tbl_productsubcategories` (
  `prosubcategory_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `status` enum('Active','Trash') NOT NULL DEFAULT 'Active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_productsubcategories`
--

INSERT INTO `tbl_productsubcategories` (`prosubcategory_id`, `name`, `parent_id`, `status`) VALUES
(1, 'Raw Rice', 1, 'Trash'),
(2, 'Steam Rice', 1, 'Trash'),
(3, 'Raw Rice', 2, 'Trash'),
(4, 'Raw Rice', 6, 'Trash'),
(5, 'Atta', 7, 'Trash'),
(6, 'Sona Masoori', 6, 'Active'),
(7, 'Atta', 8, 'Active'),
(8, 'Boiled Rice', 7, 'Trash'),
(9, 'Powder', 15, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_productvariations`
--

CREATE TABLE `tbl_productvariations` (
  `variation_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variation` varchar(255) NOT NULL,
  `mrp` double NOT NULL,
  `salesprice` double DEFAULT NULL,
  `price` double NOT NULL,
  `inventory_value` varchar(255) DEFAULT NULL,
  `lowstock` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_promocodes`
--

CREATE TABLE `tbl_promocodes` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `expiry_date` date NOT NULL,
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_promocodes`
--

INSERT INTO `tbl_promocodes` (`id`, `type`, `value`, `code`, `expiry_date`, `created_date`) VALUES
(3, 'Percentage Value', '8', 'IPLT20', '2021-05-30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reviews`
--

CREATE TABLE `tbl_reviews` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `review` text NOT NULL,
  `rating` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `review_status` enum('Unapproved','Approved') NOT NULL DEFAULT 'Unapproved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_reviews`
--

INSERT INTO `tbl_reviews` (`review_id`, `user_id`, `order_id`, `review`, `rating`, `created_date`, `review_status`) VALUES
(1, 16, 48, 'Nice Delivery', 5, '2021-02-24 10:32:19', 'Unapproved');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sitesettings`
--

CREATE TABLE `tbl_sitesettings` (
  `id` int(11) NOT NULL,
  `site_title` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `fav_icon` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `instagram_url` varchar(255) NOT NULL,
  `twitter_url` varchar(255) NOT NULL,
  `pinterest_url` varchar(255) NOT NULL,
  `facebook_url` varchar(255) NOT NULL,
  `mapurl` text NOT NULL,
  `websiteurl` varchar(250) NOT NULL,
  `terms_conditions` text NOT NULL,
  `privacy_policy` text NOT NULL,
  `appinfo` text NOT NULL,
  `appversion` varchar(50) NOT NULL,
  `referal_amount` double NOT NULL,
  `delivery_charge` double NOT NULL,
  `sample_rice_charge` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sitesettings`
--

INSERT INTO `tbl_sitesettings` (`id`, `site_title`, `logo`, `fav_icon`, `phone`, `email`, `address`, `latitude`, `longitude`, `instagram_url`, `twitter_url`, `pinterest_url`, `facebook_url`, `mapurl`, `websiteurl`, `terms_conditions`, `privacy_policy`, `appinfo`, `appversion`, `referal_amount`, `delivery_charge`, `sample_rice_charge`) VALUES
(1, 'QRice', '5edfc6ab57aff.png', '5edfc6ab5859f.png', '+91 7975179949', 'balaji.rice2020@gmail.com', 'Flat No. 201, 1st Floor, KRS Endeavour, Kenchenahalli Rajarajeshwari Nagar, Bengaluru, IN 5600098', '12.971599', '77.594566', 'https://www.instagram.com/', 'https://www.facebook.com/', 'https://in.pinterest.com/', 'https://www.facebook.com/', 'https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d16314.040319384443!2d76.78971872075262!3d30.729516995183413!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1582179204866!5m2!1sen!2sin', 'https://yourwebsiteurl', 'PLATFORM TERMS OF USE Welcome, and thank you for your interest in QRice.in (\"QRice,\" \"Balaji Rice Traders,\" \"we,\" or \"us\") and our website at www.qrice.in, along with our related websites, networks, applications, mobile applications, and other services provided by us (collectively, the \"Service\"). These Terms of Service are a legally binding contract between you and QRice (Balaji Rice Traders) regarding your use of the Service. PLEASE READ THE FOLLOWING TERMS CAREFULLY: BY CLICKING \"I ACCEPT,\" OR BY DOWNLOADING, INSTALLING, OR OTHERWISE ACCESSING OR USING THE SERVICE, YOU AGREE THAT YOU HAVE READ AND UNDERSTOOD, AND, AS A CONDITION TO YOUR USE OF THE SERVICE, YOU AGREE TO BE BOUND BY, THE FOLLOWING TERMS AND CONDITIONS, INCLUDING QRICE PRIVACY POLICY (TOGETHER, THESE \"TERMS\"). IF YOU ARE NOT ELIGIBLE, OR DO NOT AGREE TO THE TERMS, THEN YOU DO NOT HAVE OUR PERMISSION TO USE THE SERVICE. YOUR USE OF THE SERVICE, AND QRICE PROVISION OF THE SERVICE TO YOU, CONSTITUTES AN AGREEMENT BY QRICE AND BY YOU TO BE BOUND BY THESE TERMS. \r\n\r\nAccount & Registration \r\nâ€¢ To access most features of the Service, you must register for an account. When you register for an account, you may be required to provide us with some information such as name, e-mail address, and mobile number and additional data may require during delivery. You also must provide and verify a valid mobile number before the account creation process can be completed. You agree that the information you provide to us is accurate and that you will keep it accurate and up to date at all times. When you register, you will be asked to provide a password. You are solely responsible for maintaining the confidentiality of your account and password, and you accept responsibility for all activities that occur under your account. If you believe that your account is no longer secure, then you must immediately notify us at customersupport@qrice.in. QRice reserves the right to refuse service, terminate accounts, remove or edit content, or cancel orders in its sole discretion. \r\n\r\nPrices & Pictures \r\nâ€¢ The prices of the products are subject to change and the prices as applicable on the day of the order & All product-related pictures are provided for reference purposes only. Original product may vary from the reference picture shown on the platform. â€¢ The prices stated on the platform will be inclusive of GST payable. \r\n\r\nDelivery \r\nâ€¢ Any dates quoted for delivery of the Products are approximate only and the Company shall not be liable for any delay in delivery of the Products howsoever caused. Time for delivery shall not be of the essence unless previously agreed by the Company in writing. \r\nCancellation by Customer / Site \r\nâ€¢ You can cancel your order at any time before we process and send the â€œprocessing\" email to you (Usually within 1-2 hours of placing the order) by contacting customer support team customersupport@qrice.in or +91-7959179949. And once the cancellation is approved we will refund the amount within 48 hours and the amount will reflect within 5 working days. Your entire order amount will be refunded via the refund method selected by you. \r\nâ€¢ If we suspect any deceitful transaction by any customer or any transaction which defies the terms & conditions of using the application, we at our sole discretion could cancel such orders. We will maintain a negative list of all deceitful transactions and customers and would deny access to them or cancel any orders placed by them. \r\n\r\nAs a User you Confirm the below \r\nâ€¢ If a non-delivery occurs on account of a mistake by you (i.e. wrong name or address or any other wrong information or non-availability at the time of delivery) any extra cost incurred by us for re-delivery shall be claimed from you. \r\nâ€¢ You will provide authentic and true information in all instances where such information is requested of you. We reserve the rights to confirm and validate the information and other details provided by you at any point of time. If upon confirmation your details are found to be false (wholly or partly), it has the right in its sole discretion to reject the registration and refuse entry to you from using the Services without prior intimation whatsoever. \r\nâ€¢ You are accessing the services available on this Application and transacting at your sole risk and are using your best and prudent judgment before entering into any transaction through this application. \r\nâ€¢ The address at which delivery of the product ordered by you is to be made shall be correct and complete in all respects. \r\nâ€¢ Before placing an order you will check the product description carefully, Product features, by placing an order for a product you agree to be bound by the conditions of sale included in the itemâ€™s description. \r\nâ€¢ You will use the services provided by the Application, consultants and contracted companies, for lawful purposes only and comply with all applicable laws and regulations while using and transacting on the Application. \r\n\r\nYou shall not use the site for the following purpose \r\nâ€¢ Disseminating any unlawful, harassing, libellous, abusive, threatening, harmful, vulgar, obscene, or otherwise objectionable material. Posting of images or other virtual contents are not allowed. \r\nâ€¢ Transmitting material that encourages conduct that constitutes a criminal offence or results in civil liability or otherwise breaches any relevant laws, regulations or code of practice. \r\nâ€¢ Making, transmitting or storing electronic copies of materials protected by copyright without the permission of the owner. \r\nâ€¢ Gaining unauthorized access to other computer systems. \r\nâ€¢Interfering with any other personâ€™s use or enjoyment of the platform (Website & Itâ€™s Application). \r\nâ€¢Breaching any applicable laws. \r\nâ€¢Interfering or disrupting networks or web sites connected to the Site. \r\n\r\nReviews, Feedback, Submissions \r\nâ€¢ All reviews, comments, feedback, postcards, suggestions, ideas, and other submissions disclosed, submitted or offered to the Application on or by this application or otherwise disclosed, submitted or offered in connection with your use of this Application (collectively, the â€œCommentsâ€) shall be and remain the property of QRice. \r\nâ€¢ Such disclosure, submission or offer of any Comments shall constitute an assignment to QRice of all worldwide rights, titles and interests in all copyrights and other intellectual properties in the Comments. Thus, QRice owns exclusively all such rights, titles and interests and shall not be limited in any way in its use, commercial or otherwise, of any Comments. \r\nâ€¢ QRice will be entitled to use, reproduce, disclose, modify, adapt, create derivative works from, publish, display and distribute any Comments you submit for any purpose whatsoever, without restriction and without compensating you in any way. QRice is and shall be under no obligation (1) to maintain any Comments in confidence; (2) to pay you any compensation for any Comments; or (3) to respond to any Comments. You agree that any Comments submitted by you to the Application will not violate this policy or any right of any third party, including copyright, trademark, privacy or other personal or proprietary right(s), and will not cause injury to any person or entity. You further agree that no Comments submitted by you to the Application will be or contain libellous or otherwise unlawful, threatening, abusive or obscene material, or contain software viruses, political campaigning, commercial solicitation, chain letters, mass mailings or any form of â€œspamâ€. \r\nâ€¢ QRice does not regularly review posted Comments, but does reserve the right (but not the compulsion) to monitor and edit or remove any Comments submitted to the Application. You grant QRice the right to use the name that you submit in connection with any Comments. \r\nâ€¢ You agree not to use a false email address, impersonate any person or entity, or otherwise mislead as to the origin of any Comments you submit. You are and shall remain solely responsible for the content of any Comments you make and you agree to indemnify QRice and its affiliates for all claims resulting from any Comments you submit. QRice and its affiliates take no responsibility and assume no liability for any Comments submitted by you or any third party. \r\n\r\nCopyright & Trademark \r\nâ€¢ QRice, its suppliers and licensors expressly reserve all intellectual property rights in all text, programs, products, processes, technology, content and other materials, which appear on this Application. Access to this Application does not confer and shall not be considered as conferring upon anyone any license under any of QRice or any third partyâ€™s intellectual property rights. \r\nâ€¢ All rights, including copyright, in this application are owned by or licensed to QRice. Any use of this application or its contents, including copying or storing it or them in whole or part, other than for your own personal, non-commercial use is prohibited without the permission of QRice. \r\nâ€¢ You may not modify, distribute or re-post anything on this website for any purpose. The names and logos and all related product and service names, design marks and slogans are the trademarks or service marks of QRice, its affiliates, its partners or its suppliers. \r\nâ€¢ All other marks are the property of their respective companies. No trademark or service mark license is granted in connection with the materials contained in this Application. Access to this application does not authorize anyone to use any name, logo or mark in any manner. References on this application to any names, marks, products or services of third parties or hypertext links to third party sites or information are provided solely as a convenience to you and do not in any way constitute or imply QRice endorsement, sponsorship or recommendation of the third party, information, product or service. QRice is not responsible for the content of any third party sites/applications and does not make any representations regarding the content or accuracy of material on such sites/applications. \r\nâ€¢ If you decide to link to any such third party websites/applications, you do so entirely at your own risk. All materials, including images, text, illustrations, designs, icons, photographs, programs, music clips or downloads, video clips and written and other materials that are part of this Application (collectively, the â€œContentsâ€) are intended solely for personal, non-commercial use. You may download or copy the Contents and other downloadable materials displayed on the website/application for your personal use only. No right, title or interest in any downloaded materials or software is transferred to you as a result of any such downloading or copying. You may not reproduce (except as noted above), publish, transmit, distribute, display, modify, create derivative works from, sell or participate in any sale of or exploit in any way, in whole or in part, any of the Contents, the Website or any related software. \r\nâ€¢ All software used in this Application is the property of QRice or its licensees and suppliers and protected by Indian and international copyright laws. The Contents and software on this Application may be used only as a shopping resource. Any other use, including the  reproduction, modification, distribution, transmission, republication, display, or performance, of the Contents on this application is strictly prohibited. \r\nâ€¢ Unless otherwise noted, all Contents are copyrights, trademarks, trade dress and/or other intellectual property owned, controlled or licensed by QRice, one of its affiliates or by third parties who have licensed their materials to QRice and are protected by Indian and international copyright laws. The compilation (meaning the collection, arrangement, and assembly) of all Contents on this application is the exclusive property of QRice and is also protected by Indian and international copyright laws. \r\n\r\nTermination \r\nâ€¢ This User Agreement is effective unless and until terminated by either you or QRice. You may terminate this User Agreement at any time, provided that you discontinue any further use of this Application. QRice may terminate this User Agreement at any time and may do so immediately without notice, and accordingly deny your access to the application; such termination will be without any liability to QRice. Upon any termination of the User Agreement by either you or QRice, you must promptly destroy all materials downloaded or otherwise obtained from this Application, as well as all copies of such materials, whether made under the User Agreement or otherwise. QRice right to any Comments shall survive any termination of this User Agreement. Any such termination of the User Agreement shall not cancel your obligation to pay for the product already ordered from the Application or affect any liability that may have arisen under the User Agreement.\r\n\r\nRETURN & REFUND POLICY\r\nâ€¢ We are very keen on choosing products, packing and deliver it. In extreme conditions due to some transit damages / wrong product / human error in packing / missing product happen, in that we are open to accept the query from you.\r\nâ€¢ You can communicate to customer care through mail (customersupport@qrice.in) or call (+91-7975179949) to place return queries and upon considerations you can send it across or we will be collecting it and evaluating by our product quality team and then eligibility can be decided for replacement / Refund.\r\nâ€¢ Please check the goods on delivery and ensure that they are supplied correctly or not. Goods sold will not be taken back unless the product is damaged, expired or faulty. If any of the goods prove to be defect, Please initiate a return query for the same within 3 days by communicating customer care through mail (customersupport@qrice.in) or call (+91-7975179949). \r\nNote: Items will be returned in original / received condition.\r\nâ€¢ In case of returns being taken as per our returns policy, for cash on delivery, we will return the money for the returned goods at the time of delivery itself. In case of credit/debit card payments we will credit the money back to your credit/debit card or Net banking which takes upto 8 to 10 working days to reflect in your statement. We will not be giving any cash refunds for purchase done using credit/debit card payments. Please contact customer support for further clarifications.\r\nâ€¢ If any return due to wrong address or non-availability during delivery then you may need to pick up the delivery or in an extra cost it will be delivered again as we are providing free delivery offer and it can be consumed for a single time only.\r\nâ€¢ If we found guilty on transactions / returning by any customer then we will discard the order or returns will not be taken.', 'PRIVACY POLICY \r\nThis privacy policy discloses the privacy practices for www.qrice.in. This privacy policy applies solely to information collected by this application. It will notify you of the following: \r\nâ€¢ What personally identifiable information is collected from you through the application, how it is used and with whom it may be shared. â€¢ What choices are available to you regarding the use of your data. \r\nâ€¢ The security procedures in place to protect the misuse of your information. \r\nâ€¢ How you can correct any inaccuracies in the information. \r\n\r\nInformation Collection, Use, and Sharing \r\nâ€¢ QRice (Balaji Rice Traders) is the sole owners of the information collected on this site. We only have access to/collect information that you voluntarily give us via Registration Sign Up. We will not sell or rent this information to anyone. \r\nâ€¢ We will use your information to respond to you, regarding the reason you contacted us. We will not share your information with any third party outside of our organization, other than as necessary to fulfill your request, e.g. like to ship an order, deliver the order. \r\nâ€¢ Unless you ask us not to, we may contact you via email in the future to tell you about specials, new products or services, or changes to this privacy policy. \r\n\r\nYour Access to and Control Over Information \r\nYou may opt out of any future contacts from us at any time. You can do the following at any time by contacting us via the email address or phone number given on our website: \r\nâ€¢ See what data we have about you, if any. \r\nâ€¢ Change/correct any data we have about you. \r\nâ€¢ Have us delete any data we have about you. \r\nâ€¢ Express any concern you have about our use of your data. \r\n\r\nSecurity \r\nâ€¢ We take precautions to protect your information. When you submit sensitive information via our platform, your information is protected both online and offline. \r\nâ€¢ Wherever we collect sensitive information (such as credit card data), that information is encrypted and transmitted to us in a secure way. You can verify this by looking for a closed lock icon at the bottom of your web browser, or looking for \"https\" at the beginning of the address of the web page.\r\nâ€¢ While we use encryption to protect sensitive information transmitted online, we also protect your information offline. Only employees who need the information to perform a specific job (for example, billing or customer service) are granted access to personally identifiable information. The computers/servers in which we store personally identifiable information are kept in a secure environment.\r\n\r\nOur Cookies\r\nâ€¢ A cookie is a piece of data which we store value for each user session that gives a unique ID number. We use cookies to allow us to personalize your experience on our website.\r\nâ€¢ We do not share, sell or rent your contact information. However, in exceptions where it may be required by the laws of the land during that time we may have to share the information.\r\n\r\nUpdates\r\nâ€¢ Our Privacy Policy may change from time to time and all updates will be posted on this page.\r\nâ€¢ If you feel that we are not abiding by this privacy policy, you should contact us immediately via telephone at +91-7975179949 or via email customersupport@qrice.in\r\n\r\nContact us\r\nâ€¢ Flat No 201, 1st Floor, KRS Endeavour\r\n  Kenchenahalli, Rajarajeshwari Nagar\r\n  Bangalore â€“560098.\r\n  âœ† +91-7975179949\r\n  âœ‰customersupport@qrice.in', 'QRice is the 1st online rice store in Bengaluru, which is going to commence its services in certain areas of Bengaluru. After covering certain areas, we would also love to extend our services to the whole Bengaluru city very soon.  We are keenly dedicated to deliver rice to every doorstep in Bengaluru. It is our utmost priority to respond to all our customerâ€™s needs, delivering our customers orders to their respective address at the earliest possible.  First you need to login to our app in order to place an order.  You can make your payment through methods like online payment and cash on delivery.  There are options to return and exchange the purchased product (within 3 days after delivery)* conditions apply.  Now you are free from the hardship of carrying 25kg rice bag to your house. We will take care of it for free Order rice from \"QRice\" and get the rice bag delivered to your doorsteps without delay.', 'Version 1.1.0.0.0', 0, 49, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sliders`
--

CREATE TABLE `tbl_sliders` (
  `slider_id` int(11) NOT NULL,
  `image` varchar(250) NOT NULL,
  `url` varchar(250) DEFAULT NULL,
  `status` enum('Active','Trash') NOT NULL,
  `created_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sliders`
--

INSERT INTO `tbl_sliders` (`slider_id`, `image`, `url`, `status`, `created_date`) VALUES
(20, '5f21168e25e06.jpg', NULL, 'Active', NULL),
(23, '5f45310434442.jpg', NULL, 'Active', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staticpages`
--

CREATE TABLE `tbl_staticpages` (
  `page_id` int(11) NOT NULL,
  `page_title` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `page_content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(250) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_staticpages`
--

INSERT INTO `tbl_staticpages` (`page_id`, `page_title`, `page_content`, `image`, `created_date`) VALUES
(1, 'About Us', 'Q-Rice is the first ever Bengaluru based online platform which delivers the most important and basic requirement of almost every human in their everyday life. We mainly deal with different variants of rice with the supreme motive of providing top level customer satisfaction by delivering the finest handpicked quality of rice variants from our suppliers and manufactures.', '24205image_2020_03_10T06_51_55_319Z.png', '2019-09-16 07:49:34'),
(2, 'Terms  & Conditions', '<dl><dt><dfn>Quid adiuvas?</dfn></dt><dd>Illud dico, ea, quae dicat, praeclare inter se cohaerere.</dd><dt><dfn>Ille incendat?</dfn></dt><dd>Ratio enim nostra consentit, pugnat oratio.</dd><dt><dfn>Age sane, inquam.</dfn></dt><dd>Tum Lucius: Mihi vero ista valde probata sunt, quod item fratri puto.</dd><dt><dfn>Quid ergo?</dfn></dt><dd>Quae tamen a te agetur non melior, quam illae sunt, quas interdum optines.</dd><dt><dfn>Tenent mordicus.</dfn></dt><dd>Miserum hominem! Si dolor summum malum est, dici aliter non potest.</dd></dl>\r\n\r\n\r\n<p>Duo Reges: constructio interrete. Oratio me istius philosophi non \r\noffendit; Videsne quam sit magna dissensio? Deque his rebus satis multa \r\nin nostris de re publica libris sunt dicta a Laelio. Sed vos squalidius,\r\n illorum vides quam niteat oratio. Ecce aliud simile dissimile. </p>\r\n\r\n<p><b>Hoc tu nunc in illo probas.</b> Terram, mihi crede, ea lanx et \r\nmaria deprimet. Morbo gravissimo affectus, exul, orbus, egens, \r\ntorqueatur eculeo: quem hunc appellas, Zeno? <a href=\"http://loripsum.net/\" target=\"_blank\">Zenonis est, inquam, hoc Stoici.</a>\r\n Id enim volumus, id contendimus, ut officii fructus sit ipsum officium.\r\n Ego quoque, inquit, didicerim libentius si quid attuleris, quam te \r\nreprehenderim. Quae qui non vident, nihil umquam magnum ac cognitione \r\ndignum amaverunt. Id quaeris, inquam, in quo, utrum respondero, verses \r\nte huc atque illuc necesse est. </p>\r\n\r\n<ol><li>Etsi ea quidem, quae adhuc dixisti, quamvis ad aetatem recte isto modo dicerentur.</li><li>Duo enim genera quae erant, fecit tria.</li></ol>', '96104image_2020_03_10T07_00_00_542Z.png', '2019-09-16 07:49:34');
INSERT INTO `tbl_staticpages` (`page_id`, `page_title`, `page_content`, `image`, `created_date`) VALUES
(3, 'Return Policy', '<!--[if gte mso 9]><xml>\r\n <o:OfficeDocumentSettings>\r\n  <o:AllowPNG></o:AllowPNG>\r\n </o:OfficeDocumentSettings>\r\n</xml><![endif]--><!--[if gte mso 9]><xml>\r\n <w:WordDocument>\r\n  <w:View>Normal</w:View>\r\n  <w:Zoom>0</w:Zoom>\r\n  <w:TrackMoves></w:TrackMoves>\r\n  <w:TrackFormatting></w:TrackFormatting>\r\n  <w:PunctuationKerning></w:PunctuationKerning>\r\n  <w:ValidateAgainstSchemas></w:ValidateAgainstSchemas>\r\n  <w:SaveIfXMLInvalid>false</w:SaveIfXMLInvalid>\r\n  <w:IgnoreMixedContent>false</w:IgnoreMixedContent>\r\n  <w:AlwaysShowPlaceholderText>false</w:AlwaysShowPlaceholderText>\r\n  <w:DoNotPromoteQF></w:DoNotPromoteQF>\r\n  <w:LidThemeOther>EN-US</w:LidThemeOther>\r\n  <w:LidThemeAsian>X-NONE</w:LidThemeAsian>\r\n  <w:LidThemeComplexScript>X-NONE</w:LidThemeComplexScript>\r\n  <w:Compatibility>\r\n   <w:BreakWrappedTables></w:BreakWrappedTables>\r\n   <w:SnapToGridInCell></w:SnapToGridInCell>\r\n   <w:WrapTextWithPunct></w:WrapTextWithPunct>\r\n   <w:UseAsianBreakRules></w:UseAsianBreakRules>\r\n   <w:DontGrowAutofit></w:DontGrowAutofit>\r\n   <w:SplitPgBreakAndParaMark></w:SplitPgBreakAndParaMark>\r\n   <w:EnableOpenTypeKerning></w:EnableOpenTypeKerning>\r\n   <w:DontFlipMirrorIndents></w:DontFlipMirrorIndents>\r\n   <w:OverrideTableStyleHps></w:OverrideTableStyleHps>\r\n  </w:Compatibility>\r\n  <m:mathPr>\r\n   <m:mathFont m:val=\"Cambria Math\"></m:mathFont>\r\n   <m:brkBin m:val=\"before\"></m:brkBin>\r\n   <m:brkBinSub m:val=\"--\"></m:brkBinSub>\r\n   <m:smallFrac m:val=\"off\"></m:smallFrac>\r\n   <m:dispDef></m:dispDef>\r\n   <m:lMargin m:val=\"0\"></m:lMargin>\r\n   <m:rMargin m:val=\"0\"></m:rMargin>\r\n   <m:defJc m:val=\"centerGroup\"></m:defJc>\r\n   <m:wrapIndent m:val=\"1440\"></m:wrapIndent>\r\n   <m:intLim m:val=\"subSup\"></m:intLim>\r\n   <m:naryLim m:val=\"undOvr\"></m:naryLim>\r\n  </m:mathPr></w:WordDocument>\r\n</xml><![endif]--><!--[if gte mso 9]><xml>\r\n <w:LatentStyles DefLockedState=\"false\" DefUnhideWhenUsed=\"false\"\r\n  DefSemiHidden=\"false\" DefQFormat=\"false\" DefPriority=\"99\"\r\n  LatentStyleCount=\"371\">\r\n  <w:LsdException Locked=\"false\" Priority=\"0\" QFormat=\"true\" Name=\"Normal\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" QFormat=\"true\" Name=\"heading 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 7\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 8\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 9\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 7\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 8\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 9\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 7\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 8\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 9\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Normal Indent\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"footnote text\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"annotation text\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"header\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"footer\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index heading\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"35\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"caption\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"table of figures\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"envelope address\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"envelope return\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"footnote reference\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"annotation reference\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"line number\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"page number\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"endnote reference\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"endnote text\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"table of authorities\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"macro\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"toa heading\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Bullet\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Number\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Bullet 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Bullet 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Bullet 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Bullet 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Number 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Number 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Number 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Number 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"10\" QFormat=\"true\" Name=\"Title\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Closing\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Signature\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"1\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"Default Paragraph Font\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text Indent\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Continue\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Continue 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Continue 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Continue 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Continue 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Message Header\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"11\" QFormat=\"true\" Name=\"Subtitle\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Salutation\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Date\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text First Indent\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text First Indent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Note Heading\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text Indent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text Indent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Block Text\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Hyperlink\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"FollowedHyperlink\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"22\" QFormat=\"true\" Name=\"Strong\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"20\" QFormat=\"true\" Name=\"Emphasis\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Document Map\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Plain Text\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"E-mail Signature\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Top of Form\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Bottom of Form\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Normal (Web)\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Acronym\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Address\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Cite\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Code\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Definition\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Keyboard\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Preformatted\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Sample\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Typewriter\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Variable\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Normal Table\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"annotation subject\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"No List\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Outline List 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Outline List 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Outline List 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Simple 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Simple 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Simple 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Classic 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Classic 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Classic 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Classic 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Colorful 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Colorful 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Colorful 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Columns 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Columns 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Columns 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Columns 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Columns 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Grid 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Grid 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Grid 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Grid 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Grid 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Grid 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Grid 7\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Grid 8\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table List 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table List 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table List 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table List 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table List 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table List 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table List 7\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table List 8\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table 3D effects 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table 3D effects 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table 3D effects 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Contemporary\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Elegant\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Professional\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Subtle 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Subtle 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Web 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Web 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Web 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Balloon Text\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" Name=\"Table Grid\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Theme\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" Name=\"Placeholder Text\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"1\" QFormat=\"true\" Name=\"No Spacing\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"60\" Name=\"Light Shading\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"61\" Name=\"Light List\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"62\" Name=\"Light Grid\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"63\" Name=\"Medium Shading 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"64\" Name=\"Medium Shading 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"65\" Name=\"Medium List 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"66\" Name=\"Medium List 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"67\" Name=\"Medium Grid 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"68\" Name=\"Medium Grid 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"69\" Name=\"Medium Grid 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"70\" Name=\"Dark List\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"71\" Name=\"Colorful Shading\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"72\" Name=\"Colorful List\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"73\" Name=\"Colorful Grid\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"60\" Name=\"Light Shading Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"61\" Name=\"Light List Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"62\" Name=\"Light Grid Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"63\" Name=\"Medium Shading 1 Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"64\" Name=\"Medium Shading 2 Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"65\" Name=\"Medium List 1 Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" Name=\"Revision\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"34\" QFormat=\"true\"\r\n   Name=\"List Paragraph\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"29\" QFormat=\"true\" Name=\"Quote\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"30\" QFormat=\"true\"\r\n   Name=\"Intense Quote\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"66\" Name=\"Medium List 2 Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"67\" Name=\"Medium Grid 1 Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"68\" Name=\"Medium Grid 2 Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"69\" Name=\"Medium Grid 3 Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"70\" Name=\"Dark List Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"71\" Name=\"Colorful Shading Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"72\" Name=\"Colorful List Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"73\" Name=\"Colorful Grid Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"60\" Name=\"Light Shading Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"61\" Name=\"Light List Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"62\" Name=\"Light Grid Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"63\" Name=\"Medium Shading 1 Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"64\" Name=\"Medium Shading 2 Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"65\" Name=\"Medium List 1 Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"66\" Name=\"Medium List 2 Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"67\" Name=\"Medium Grid 1 Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"68\" Name=\"Medium Grid 2 Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"69\" Name=\"Medium Grid 3 Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"70\" Name=\"Dark List Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"71\" Name=\"Colorful Shading Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"72\" Name=\"Colorful List Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"73\" Name=\"Colorful Grid Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"60\" Name=\"Light Shading Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"61\" Name=\"Light List Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"62\" Name=\"Light Grid Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"63\" Name=\"Medium Shading 1 Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"64\" Name=\"Medium Shading 2 Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"65\" Name=\"Medium List 1 Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"66\" Name=\"Medium List 2 Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"67\" Name=\"Medium Grid 1 Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"68\" Name=\"Medium Grid 2 Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"69\" Name=\"Medium Grid 3 Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"70\" Name=\"Dark List Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"71\" Name=\"Colorful Shading Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"72\" Name=\"Colorful List Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"73\" Name=\"Colorful Grid Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"60\" Name=\"Light Shading Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"61\" Name=\"Light List Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"62\" Name=\"Light Grid Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"63\" Name=\"Medium Shading 1 Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"64\" Name=\"Medium Shading 2 Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"65\" Name=\"Medium List 1 Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"66\" Name=\"Medium List 2 Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"67\" Name=\"Medium Grid 1 Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"68\" Name=\"Medium Grid 2 Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"69\" Name=\"Medium Grid 3 Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"70\" Name=\"Dark List Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"71\" Name=\"Colorful Shading Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"72\" Name=\"Colorful List Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"73\" Name=\"Colorful Grid Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"60\" Name=\"Light Shading Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"61\" Name=\"Light List Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"62\" Name=\"Light Grid Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"63\" Name=\"Medium Shading 1 Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"64\" Name=\"Medium Shading 2 Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"65\" Name=\"Medium List 1 Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"66\" Name=\"Medium List 2 Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"67\" Name=\"Medium Grid 1 Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"68\" Name=\"Medium Grid 2 Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"69\" Name=\"Medium Grid 3 Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"70\" Name=\"Dark List Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"71\" Name=\"Colorful Shading Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"72\" Name=\"Colorful List Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"73\" Name=\"Colorful Grid Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"60\" Name=\"Light Shading Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"61\" Name=\"Light List Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"62\" Name=\"Light Grid Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"63\" Name=\"Medium Shading 1 Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"64\" Name=\"Medium Shading 2 Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"65\" Name=\"Medium List 1 Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"66\" Name=\"Medium List 2 Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"67\" Name=\"Medium Grid 1 Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"68\" Name=\"Medium Grid 2 Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"69\" Name=\"Medium Grid 3 Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"70\" Name=\"Dark List Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"71\" Name=\"Colorful Shading Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"72\" Name=\"Colorful List Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"73\" Name=\"Colorful Grid Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"19\" QFormat=\"true\"\r\n   Name=\"Subtle Emphasis\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"21\" QFormat=\"true\"\r\n   Name=\"Intense Emphasis\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"31\" QFormat=\"true\"\r\n   Name=\"Subtle Reference\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"32\" QFormat=\"true\"\r\n   Name=\"Intense Reference\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"33\" QFormat=\"true\" Name=\"Book Title\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"37\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"Bibliography\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"TOC Heading\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"41\" Name=\"Plain Table 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"42\" Name=\"Plain Table 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"43\" Name=\"Plain Table 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"44\" Name=\"Plain Table 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"45\" Name=\"Plain Table 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"40\" Name=\"Grid Table Light\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\" Name=\"Grid Table 1 Light\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"Grid Table 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"Grid Table 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"Grid Table 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"Grid Table 5 Dark\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\" Name=\"Grid Table 6 Colorful\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\" Name=\"Grid Table 7 Colorful\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"Grid Table 1 Light Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"Grid Table 2 Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"Grid Table 3 Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"Grid Table 4 Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"Grid Table 5 Dark Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"Grid Table 6 Colorful Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"Grid Table 7 Colorful Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"Grid Table 1 Light Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"Grid Table 2 Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"Grid Table 3 Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"Grid Table 4 Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"Grid Table 5 Dark Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"Grid Table 6 Colorful Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"Grid Table 7 Colorful Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"Grid Table 1 Light Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"Grid Table 2 Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"Grid Table 3 Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"Grid Table 4 Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"Grid Table 5 Dark Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"Grid Table 6 Colorful Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"Grid Table 7 Colorful Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"Grid Table 1 Light Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"Grid Table 2 Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"Grid Table 3 Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"Grid Table 4 Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"Grid Table 5 Dark Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"Grid Table 6 Colorful Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"Grid Table 7 Colorful Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"Grid Table 1 Light Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"Grid Table 2 Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"Grid Table 3 Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"Grid Table 4 Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"Grid Table 5 Dark Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"Grid Table 6 Colorful Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"Grid Table 7 Colorful Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"Grid Table 1 Light Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"Grid Table 2 Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"Grid Table 3 Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"Grid Table 4 Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"Grid Table 5 Dark Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"Grid Table 6 Colorful Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"Grid Table 7 Colorful Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\" Name=\"List Table 1 Light\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"List Table 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"List Table 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"List Table 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"List Table 5 Dark\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\" Name=\"List Table 6 Colorful\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\" Name=\"List Table 7 Colorful\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"List Table 1 Light Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"List Table 2 Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"List Table 3 Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"List Table 4 Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"List Table 5 Dark Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"List Table 6 Colorful Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"List Table 7 Colorful Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"List Table 1 Light Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"List Table 2 Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"List Table 3 Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"List Table 4 Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"List Table 5 Dark Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"List Table 6 Colorful Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"List Table 7 Colorful Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"List Table 1 Light Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"List Table 2 Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"List Table 3 Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"List Table 4 Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"List Table 5 Dark Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"List Table 6 Colorful Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"List Table 7 Colorful Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"List Table 1 Light Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"List Table 2 Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"List Table 3 Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"List Table 4 Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"List Table 5 Dark Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"List Table 6 Colorful Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"List Table 7 Colorful Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"List Table 1 Light Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"List Table 2 Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"List Table 3 Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"List Table 4 Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"List Table 5 Dark Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"List Table 6 Colorful Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"List Table 7 Colorful Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"List Table 1 Light Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"List Table 2 Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"List Table 3 Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"List Table 4 Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"List Table 5 Dark Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"List Table 6 Colorful Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"List Table 7 Colorful Accent 6\"></w:LsdException>\r\n </w:LatentStyles>\r\n</xml><![endif]--><!--[if gte mso 10]>\r\n<style>\r\n /* Style Definitions */\r\n table.MsoNormalTable\r\n	{mso-style-name:\"Table Normal\";\r\n	mso-tstyle-rowband-size:0;\r\n	mso-tstyle-colband-size:0;\r\n	mso-style-noshow:yes;\r\n	mso-style-priority:99;\r\n	mso-style-parent:\"\";\r\n	mso-padding-alt:0in 5.4pt 0in 5.4pt;\r\n	mso-para-margin-top:0in;\r\n	mso-para-margin-right:0in;\r\n	mso-para-margin-bottom:8.0pt;\r\n	mso-para-margin-left:0in;\r\n	line-height:107%;\r\n	mso-pagination:widow-orphan;\r\n	font-size:11.0pt;\r\n	font-family:\"Calibri\",\"sans-serif\";\r\n	mso-ascii-font-family:Calibri;\r\n	mso-ascii-theme-font:minor-latin;\r\n	mso-hansi-font-family:Calibri;\r\n	mso-hansi-theme-font:minor-latin;\r\n	mso-bidi-font-family:\"Times New Roman\";\r\n	mso-bidi-theme-font:minor-bidi;}\r\n</style>\r\n<![endif]-->\r\n\r\n<p class=\"MsoNormal\" style=\"margin-bottom:8.0pt;text-align:center\" align=\"center\"><b style=\"mso-bidi-font-weight:normal\"><span style=\"font-family:\" calibri\",\"sans-serif\";=\"\" mso-ascii-theme-font:minor-latin;mso-hansi-theme-font:minor-latin;mso-bidi-theme-font:=\"\" minor-latin\"=\"\">PharmaLink is technical platform to connect sellers and buyers and\r\nnot involved in sales of any product.</span></b></p>\r\n\r\n<p class=\"MsoNormal\" style=\"margin-bottom:8.0pt\"><span style=\"font-family:\" calibri\",\"sans-serif\";=\"\" mso-ascii-theme-font:minor-latin;mso-hansi-theme-font:minor-latin;mso-bidi-theme-font:=\"\" minor-latin\"=\"\">Read Terms and Condition Along with Return and Refund Policy.</span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"margin-bottom:8.0pt\"><span style=\"font-family:\" calibri\",\"sans-serif\";=\"\" mso-ascii-theme-font:minor-latin;mso-hansi-theme-font:minor-latin;mso-bidi-theme-font:=\"\" minor-latin\"=\"\">&nbsp;These are general Return and Refund Policy:</span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"margin-bottom:8.0pt\"><span style=\"font-family:\" calibri\",\"sans-serif\";=\"\" mso-ascii-theme-font:minor-latin;mso-hansi-theme-font:minor-latin;mso-bidi-theme-font:=\"\" minor-latin\"=\"\">&nbsp;</span><b style=\"mso-bidi-font-weight:\r\nnormal\"><u><span style=\"font-family:\" calibri\",\"sans-serif\";mso-ascii-theme-font:=\"\" minor-latin;mso-hansi-theme-font:minor-latin;mso-bidi-theme-font:minor-latin\"=\"\">Refund\r\nPolicy</span></u></b></p>\r\n\r\n<p class=\"MsoNormal\" style=\"margin-bottom:8.0pt\"><span style=\"font-family:\" calibri\",\"sans-serif\";=\"\" mso-ascii-theme-font:minor-latin;mso-hansi-theme-font:minor-latin;mso-bidi-theme-font:=\"\" minor-latin\"=\"\">At PharmaLink, we do our best to ensure that you are completely\r\nsatisfied with our Products and Services. And we are happy to issue a full\r\nrefund based on the conditions listed below:</span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"margin-top:12.0pt\"><span style=\"font-family:\" calibri\",\"sans-serif\";=\"\" mso-ascii-theme-font:minor-latin;mso-hansi-theme-font:minor-latin;mso-bidi-theme-font:=\"\" minor-latin\"=\"\">Full Refund Possible If: </span></p>\r\n\r\n<p class=\"MsoListParagraphCxSpFirst\" style=\"margin-top:12.0pt;margin-right:0in;\r\nmargin-bottom:0in;margin-left:.25in;margin-bottom:.0001pt;mso-add-space:auto;\r\ntext-indent:-.25in;mso-list:l0 level1 lfo1\"><span style=\"font-family:\" calibri\",\"sans-serif\";mso-fareast-font-family:calibri\"=\"\"><span style=\"mso-list:Ignore\">-<span style=\"font:7.0pt \" times=\"\" new=\"\" roman\"\"=\"\"></span></span></span><span style=\"font-family:\" calibri\",\"sans-serif\";=\"\" mso-ascii-theme-font:minor-latin;mso-hansi-theme-font:minor-latin;mso-bidi-theme-font:=\"\" minor-latin\"=\"\">You received a defective item;</span></p>\r\n\r\n<p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-top:12.0pt;margin-right:0in;\r\nmargin-bottom:0in;margin-left:.25in;margin-bottom:.0001pt;mso-add-space:auto;\r\ntext-indent:-.25in;mso-list:l0 level1 lfo1\"><span style=\"font-family:\" calibri\",\"sans-serif\";mso-fareast-font-family:calibri\"=\"\"><span style=\"mso-list:Ignore\">-<span style=\"font:7.0pt \" times=\"\" new=\"\" roman\"\"=\"\"></span></span></span><span style=\"font-family:\" calibri\",\"sans-serif\";=\"\" mso-ascii-theme-font:minor-latin;mso-hansi-theme-font:minor-latin;mso-bidi-theme-font:=\"\" minor-latin\"=\"\">The ordered item(s) is lost or damaged during transit;</span></p>\r\n\r\n<p class=\"MsoListParagraphCxSpLast\" style=\"margin-top:12.0pt;margin-right:0in;\r\nmargin-bottom:0in;margin-left:.25in;margin-bottom:.0001pt;mso-add-space:auto;\r\ntext-indent:-.25in;mso-list:l0 level1 lfo1\"><span style=\"font-family:\" calibri\",\"sans-serif\";mso-fareast-font-family:calibri\"=\"\"><span style=\"mso-list:Ignore\">-<span style=\"font:7.0pt \" times=\"\" new=\"\" roman\"\"=\"\"></span></span></span><span style=\"font-family:\" calibri\",\"sans-serif\";=\"\" mso-ascii-theme-font:minor-latin;mso-hansi-theme-font:minor-latin;mso-bidi-theme-font:=\"\" minor-latin\"=\"\">The ordered item(s) is past its expiry date.</span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"margin-bottom:8.0pt\"><span style=\"font-family:\" calibri\",\"sans-serif\";=\"\" mso-ascii-theme-font:minor-latin;mso-hansi-theme-font:minor-latin;mso-bidi-theme-font:=\"\" minor-latin\"=\"\">Please Note: Mode of refund may vary depending on circumstances.\r\nIf the mode of refund is by Credit/Debit Card or Net Banking, Please allow 7 to\r\n10 working days for the credit to appear in your account. While we regret any\r\ninconvenience caused by this time frame, it is the bankâ€™s policy that delays\r\nthe refund timing and we have no control over that.</span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"margin-bottom:8.0pt\"><span style=\"font-family:\" calibri\",\"sans-serif\";=\"\" mso-ascii-theme-font:minor-latin;mso-hansi-theme-font:minor-latin;mso-bidi-theme-font:=\"\" minor-latin\"=\"\">To request a refund, simply email us your order details, including\r\nthe reason why youâ€™re requesting a refund. We take customer feedback very\r\nseriously and use it to constantly improve our quality of service.&nbsp;<br>\r\nIf you have any queries, do call our help desk at +917558383315, email us at PharmaLink.care@gmail.com,\r\nor contact our customer support executives through online chat. We\'re here for\r\nyou!</span></p>\r\n\r\n\r\n\r\n<p class=\"MsoNormal\" style=\"margin-bottom:8.0pt\"><b style=\"mso-bidi-font-weight:\r\nnormal\"><u><span style=\"font-family:\" calibri\",\"sans-serif\";mso-ascii-theme-font:=\"\" minor-latin;mso-hansi-theme-font:minor-latin;mso-bidi-theme-font:minor-latin\"=\"\">Return\r\nPolicy</span></u></b><span style=\"font-family:\" calibri\",\"sans-serif\";=\"\" mso-ascii-theme-font:minor-latin;mso-hansi-theme-font:minor-latin;mso-bidi-theme-font:=\"\" minor-latin\"=\"\"><br></span></p><p class=\"MsoNormal\" style=\"margin-bottom:8.0pt\"><span style=\"font-family:\" calibri\",\"sans-serif\";=\"\" mso-ascii-theme-font:minor-latin;mso-hansi-theme-font:minor-latin;mso-bidi-theme-font:=\"\" minor-latin\"=\"\">We do our best to ensure that the products you order are delivered\r\naccording to your specifications. However, should you receive an incomplete\r\norder, damaged or incorrect product(s), please notify us immediately. Please\r\nnote that PharmaLink will not accept liability for such delivery issues if you\r\nfail to notify us within 5 working days of receipt.</span>\r\n\r\n</p><p class=\"MsoNormal\" style=\"margin-bottom:8.0pt\"><span style=\"font-family:\" calibri\",\"sans-serif\";=\"\" mso-ascii-theme-font:minor-latin;mso-hansi-theme-font:minor-latin;mso-bidi-theme-font:=\"\" minor-latin\"=\"\">We also understand that various circumstances may arise leading\r\nyou to want to return a product or products that are not defective. In these\r\ncases, we may allow the return of unopened, unused products after deducting a\r\n30% or 100/- (whichever higher) restocking charge, ONLY if you notify us within\r\n5 working days of receipt.</span></p>\r\n\r\n\r\n\r\n<p class=\"MsoNormal\" style=\"margin-bottom:8.0pt\"><b style=\"mso-bidi-font-weight:\r\nnormal\"><u><span style=\"font-family:\" calibri\",\"sans-serif\";mso-ascii-theme-font:=\"\" minor-latin;mso-hansi-theme-font:minor-latin;mso-bidi-theme-font:minor-latin\"=\"\">Return\r\nPolicy Exceptions</span></u></b></p>\r\n\r\n<p class=\"MsoNormal\" style=\"margin-bottom:8.0pt\"><span style=\"font-family:\" calibri\",\"sans-serif\";=\"\" mso-ascii-theme-font:minor-latin;mso-hansi-theme-font:minor-latin;mso-bidi-theme-font:=\"\" minor-latin\"=\"\">Please note that we are unable to offer replacements or exchanges\r\nfor the following product categories: Cold chain products (Insulin etc.),\r\nInjections, Health Monitor &amp; Equipmentâ€™s and Ortho Support. Also, PharmaLink\r\nreserves the right to refuse returns (or refunds) for certain products. </span></p>\r\n\r\n<p class=\"MsoNormal\"><span style=\"font-family:\" calibri\",\"sans-serif\";mso-ascii-theme-font:=\"\" minor-latin;mso-hansi-theme-font:minor-latin;mso-bidi-theme-font:minor-latin;=\"\" color:black;mso-themecolor:text1\"=\"\">Last updated Date: 01/11/2019</span></p><p class=\"MsoNormal\" style=\"margin-bottom:0in;margin-bottom:.0001pt;line-height:\r\nnormal\"><span style=\"font-size:12.0pt;mso-bidi-font-family:Calibri;mso-bidi-theme-font:\r\nminor-latin\">Contact Information:</span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"margin-bottom:0in;margin-bottom:.0001pt;line-height:\r\nnormal\"><span style=\"font-size:12.0pt;mso-bidi-font-family:Calibri;mso-bidi-theme-font:\r\nminor-latin\">Please contact us for any questions or comments regarding these\r\nTerms and Conditions.</span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"margin-bottom:0in;margin-bottom:.0001pt;line-height:\r\nnormal\"><span style=\"font-size:12.0pt;mso-bidi-font-family:Calibri;mso-bidi-theme-font:\r\nminor-latin\">Telephone number: +917558383315</span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"margin-bottom:0in;margin-bottom:.0001pt;line-height:\r\nnormal\"><span style=\"font-size:12.0pt;mso-bidi-font-family:Calibri;mso-bidi-theme-font:\r\nminor-latin\">E-mail: PharmaLink.care@gmail.com</span></p>\r\n\r\n<!--[if gte mso 9]><xml>\r\n <o:OfficeDocumentSettings>\r\n  <o:AllowPNG></o:AllowPNG>\r\n </o:OfficeDocumentSettings>\r\n</xml><![endif]--><!--[if gte mso 9]><xml>\r\n <w:WordDocument>\r\n  <w:View>Normal</w:View>\r\n  <w:Zoom>0</w:Zoom>\r\n  <w:TrackMoves></w:TrackMoves>\r\n  <w:TrackFormatting></w:TrackFormatting>\r\n  <w:PunctuationKerning></w:PunctuationKerning>\r\n  <w:ValidateAgainstSchemas></w:ValidateAgainstSchemas>\r\n  <w:SaveIfXMLInvalid>false</w:SaveIfXMLInvalid>\r\n  <w:IgnoreMixedContent>false</w:IgnoreMixedContent>\r\n  <w:AlwaysShowPlaceholderText>false</w:AlwaysShowPlaceholderText>\r\n  <w:DoNotPromoteQF></w:DoNotPromoteQF>\r\n  <w:LidThemeOther>EN-US</w:LidThemeOther>\r\n  <w:LidThemeAsian>X-NONE</w:LidThemeAsian>\r\n  <w:LidThemeComplexScript>X-NONE</w:LidThemeComplexScript>\r\n  <w:Compatibility>\r\n   <w:BreakWrappedTables></w:BreakWrappedTables>\r\n   <w:SnapToGridInCell></w:SnapToGridInCell>\r\n   <w:WrapTextWithPunct></w:WrapTextWithPunct>\r\n   <w:UseAsianBreakRules></w:UseAsianBreakRules>\r\n   <w:DontGrowAutofit></w:DontGrowAutofit>\r\n   <w:SplitPgBreakAndParaMark></w:SplitPgBreakAndParaMark>\r\n   <w:EnableOpenTypeKerning></w:EnableOpenTypeKerning>\r\n   <w:DontFlipMirrorIndents></w:DontFlipMirrorIndents>\r\n   <w:OverrideTableStyleHps></w:OverrideTableStyleHps>\r\n  </w:Compatibility>\r\n  <m:mathPr>\r\n   <m:mathFont m:val=\"Cambria Math\"></m:mathFont>\r\n   <m:brkBin m:val=\"before\"></m:brkBin>\r\n   <m:brkBinSub m:val=\"--\"></m:brkBinSub>\r\n   <m:smallFrac m:val=\"off\"></m:smallFrac>\r\n   <m:dispDef></m:dispDef>\r\n   <m:lMargin m:val=\"0\"></m:lMargin>\r\n   <m:rMargin m:val=\"0\"></m:rMargin>\r\n   <m:defJc m:val=\"centerGroup\"></m:defJc>\r\n   <m:wrapIndent m:val=\"1440\"></m:wrapIndent>\r\n   <m:intLim m:val=\"subSup\"></m:intLim>\r\n   <m:naryLim m:val=\"undOvr\"></m:naryLim>\r\n  </m:mathPr></w:WordDocument>\r\n</xml><![endif]--><!--[if gte mso 9]><xml>\r\n <w:LatentStyles DefLockedState=\"false\" DefUnhideWhenUsed=\"false\"\r\n  DefSemiHidden=\"false\" DefQFormat=\"false\" DefPriority=\"99\"\r\n  LatentStyleCount=\"371\">\r\n  <w:LsdException Locked=\"false\" Priority=\"0\" QFormat=\"true\" Name=\"Normal\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" QFormat=\"true\" Name=\"heading 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 7\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 8\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 9\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 7\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 8\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 9\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 7\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 8\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 9\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Normal Indent\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"footnote text\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"annotation text\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"header\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"footer\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index heading\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"35\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"caption\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"table of figures\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"envelope address\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"envelope return\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"footnote reference\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"annotation reference\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"line number\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"page number\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"endnote reference\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"endnote text\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"table of authorities\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"macro\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"toa heading\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Bullet\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Number\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Bullet 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Bullet 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Bullet 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Bullet 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Number 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Number 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Number 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Number 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"10\" QFormat=\"true\" Name=\"Title\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Closing\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Signature\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"1\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"Default Paragraph Font\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text Indent\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Continue\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Continue 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Continue 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Continue 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Continue 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Message Header\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"11\" QFormat=\"true\" Name=\"Subtitle\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Salutation\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Date\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text First Indent\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text First Indent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Note Heading\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text Indent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text Indent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Block Text\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Hyperlink\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"FollowedHyperlink\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"22\" QFormat=\"true\" Name=\"Strong\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"20\" QFormat=\"true\" Name=\"Emphasis\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Document Map\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Plain Text\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"E-mail Signature\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Top of Form\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Bottom of Form\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Normal (Web)\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Acronym\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Address\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Cite\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Code\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Definition\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Keyboard\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Preformatted\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Sample\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Typewriter\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Variable\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Normal Table\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"annotation subject\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"No List\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"', '', '2019-09-16 07:49:34');
INSERT INTO `tbl_staticpages` (`page_id`, `page_title`, `page_content`, `image`, `created_date`) VALUES
(4, 'Privacy Policy', '<dl><dt><br></dt><p style=\"margin-top: 0.5em; margin-bottom: 0.5em; color: rgb(34, 34, 34); font-family: sans-serif;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p style=\"margin-top: 0.5em; margin-bottom: 0.5em; color: rgb(34, 34, 34); font-family: sans-serif;\">Curabitur pretium tincidunt lacus. Nulla gravida orci a odio. Nullam varius, turpis et commodo pharetra, est eros bibendum elit, nec luctus magna felis sollicitudin mauris. Integer in mauris eu nibh euismod gravida. Duis ac tellus et risus vulputate vehicula. Donec lobortis risus a elit. Etiam tempor. Ut ullamcorper, ligula eu tempor congue, eros est euismod turpis, id tincidunt sapien risus a quam. Maecenas fermentum consequat mi. Donec fermentum. Pellentesque malesuada nulla a mi. Duis sapien sem, aliquet nec, commodo eget, consequat quis, neque. Aliquam faucibus, elit ut dictum aliquet, felis nisl adipiscing sapien, sed malesuada diam lacus eget erat. Cras mollis scelerisque nunc. Nullam arcu. Aliquam consequat. Curabitur augue lorem, dapibus quis, laoreet et, pretium ac, nisi. Aenean magna nisl, mollis quis, molestie eu, feugiat in, orci. In hac habitasse platea dictumst.</p><p style=\"margin-top: 0.5em; margin-bottom: 0.5em; color: rgb(34, 34, 34); font-family: sans-serif;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p style=\"margin-top: 0.5em; margin-bottom: 0.5em; color: rgb(34, 34, 34); font-family: sans-serif;\">Curabitur pretium tincidunt lacus. Nulla gravida orci a odio. Nullam varius, turpis et commodo pharetra, est eros bibendum elit, nec luctus magna felis sollicitudin mauris. Integer in mauris eu nibh euismod gravida. Duis ac tellus et risus vulputate vehicula. Donec lobortis risus a elit. Etiam tempor. Ut ullamcorper, ligula eu tempor congue, eros est euismod turpis, id tincidunt sapien risus a quam. Maecenas fermentum consequat mi. Donec fermentum. Pellentesque malesuada nulla a mi. Duis sapien sem, aliquet nec, commodo eget, consequat quis, neque. Aliquam faucibus, elit ut dictum aliquet, felis nisl adipiscing sapien, sed malesuada diam lacus eget erat. Cras mollis scelerisque nunc. Nullam arcu. Aliquam consequat. Curabitur augue lorem, dapibus quis, laoreet et, pretium ac, nisi. Aenean magna nisl, mollis quis, molestie eu, feugiat in, orci. In hac habitasse platea dictumst.</p></dl>', '5e86f66ccd899.png', '2019-09-16 07:49:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `fcmid` text,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `otp` int(20) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `notification_count` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Active','Inactive','Trash') NOT NULL DEFAULT 'Pending',
  `datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `fcmid`, `name`, `email`, `password`, `mobile`, `profile`, `otp`, `latitude`, `longitude`, `notification_count`, `status`, `datetime`) VALUES
(1, 'fPNI7UDMSCKau-cxvXpoYb:APA91bHB8Z6-6_Scu1GubBGv3PTpuaA4w4eT0clrka9dP6gdp4-qtvRDsauGGOvKyAjKbLz00zWHy6k4dNQFnq7mp_Sf808amGwbn-XtXAPO_0mAcIGXQWslWy13x2Bmj76oawh5djrg', '', 'balaji.rice2020@gmail.com', '45474d69d3fac5b1e35cda7eef060fc8', '7975179949', NULL, 498763, '12.92914565781', '77.507941424847', NULL, 'Trash', '2021-01-29 23:32:46'),
(2, 'dUaq3-n7SD2PAT_SzxSeY_:APA91bGTowhpJM2i3zZv-BOY5UCU1VgjP37IxuJjwk8yOnsHkUkLUz1vtZCv4CNs4SPcVpAPrbldq285CYJbj6a3OXLpAyPHHVElFvG_GVS_-Uxe2W92WUUqr8-KUzTGsQfmireOQWcu', 'Shiksha', 'kanikrini1991@gmail.com', '25d55ad283aa400af464c76d713c07ad', '9752525402', '22991611982003.jpeg', 979973, '24.0887517', '75.0539862', NULL, 'Trash', '2021-01-30 10:10:53'),
(3, 'dzIHuwKiT7i1vQHj75VKHW:APA91bFrELHT0GVw1bmEzd-Qnt9SE-lBcBQyMpD1ZuxsgRXSCxR9VtSXG9pb0ns7Vq5ylU_I563NH1zClG4PjI_8EO7lQIDDiS6YrKb6NRjWFpgEEc8FtmdgsEZkM9I0oPKkgi_JGGov', 'shubham', 'sj@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '9752256670', NULL, 210011, '23.1532204', '75.8158073', NULL, 'Trash', '2021-01-30 15:37:08'),
(4, 'dIKNKAMIHBQyY4O3TbGUDp:APA91bEpECikbeCt4G1dttr_1YNYiRp4Y3ETZIc-pkTAaMXZrMokrTGzVJznQBSsYGd3j7BhJi1jES3bNd0R5LqI-MhsNIIpgCQ5Z_fC54qjDPi13oRaXSb8wcobH8W_Hth638fcYUak', '', 'sathya.anmol@gmail.com', '45474d69d3fac5b1e35cda7eef060fc8', '9986870244', NULL, 740243, '12.9219659', '77.4859257', NULL, 'Trash', '2021-01-31 12:58:00'),
(5, 'czH8oJd6TlinrcjvmdZnnC:APA91bHu5PgCY7ylfC7Ejk6sGCxPsPTYUSLS6wPoYTUZAo_qjpseK0RHS7QWEnrdPHVhGGzOmetEVKvZZG3zZiwqDMJnf1nlBQJq6w-4soZNocWXsrLYZwba0ekIAGiaDoOWgF-dYwAA', 'sathyanarayana k', 'sathya.anmol@gmail.com', '45474d69d3fac5b1e35cda7eef060fc8', '9986870244', NULL, 892262, '12.932009506593', '77.569142058492', NULL, 'Trash', '2021-02-01 10:28:46'),
(6, 'd0lQVL3PRhWSM8enp7MkSo:APA91bFKZqudTHfHcyNk49gKr0eYFHomqL_KLhEkaXkaQ3lyBbkaWRXUnU2hMwhjJyfg-VwGwIt5JIB9Pv5UU9QLUpuwc2Y7V2vWOnZ7cqaERz-Az1B2_SezXwwcLlH-ahrLN9YGpyv2', '', 'lokeshbabu.kr1@gmail.com', '0a8bad7df4b858617b64c2169faabdd3', '9632009563', NULL, 842971, '13.282743', '77.7323321', NULL, 'Trash', '2021-02-01 13:26:01'),
(7, 'e5tsq3j9S0elOEAt_bWTkc:APA91bFpgP3Rm7bevuNeMVGj0pXkCcDX2oePWKaqCo7VhBdeq8sG8GKp1sN0hXp6UrwoCP8aWHiCJRinwQ4E0U08-IapdK9oKDm3kP7DIFfds9RhHLgVE036DVeVbiw493mZqSDw3WdV', 'Sathyanarayana K', 'balaji.medgen@gmail.com', '45474d69d3fac5b1e35cda7eef060fc8', '7975179949', NULL, 823304, '12.929693987403', '77.507303394377', NULL, 'Trash', '2021-02-01 14:32:12'),
(8, 'cbBL5Ek4TRy1cvM-oDNWFO:APA91bHiaBZUcEb8e6Dnc0WgnHf21UUcCIMkPCkE1WZeCn0v1dYysB15_bdV9p5Ka9YhGNtswPqb7SSIvb7n3qeJzMWfqWdUL9VagaRo5o1SlbQnmP13AF1AOZd8hsJ1mVbL_B9XrN1X', '', 'lokeshbabu.kr9@gmail.com', '0a8bad7df4b858617b64c2169faabdd3', '9741314502', NULL, 674958, '13.3005', '77.7246883', NULL, 'Trash', '2021-02-01 15:43:40'),
(9, 'fGHhZBG-SE283jrhGz3ToO:APA91bHt6Y0snsK6U_z2QCs3LR2198eInRvMulEY22zAVGf58-s9Ea_d1R9Q0i-9c0V__N262l54Hi3FYeyNnDwGtc6TMZRolEhxjmo5TrStTr3doB7g45sJJMLDfG4W-aw2lUnXzybC', '', 'keerthinath.ganjam@gmail.com', '1cefb1b48af551dfe907f43826de0f37', '9844741683', NULL, 308517, NULL, NULL, NULL, 'Trash', '2021-02-01 16:02:23'),
(10, 'f7qcoAYZR0C7LAnw-jGB2h:APA91bH90xDIj7k4xxNS4AEgY8D4mQyqT-1HhPYsw_8j9NAqPNKYo5z_mQhPGsFMDRPR-u9485j1q54eOKJPXTTcUdjQnUbXrRQy58I7aiH1jmoy24gBFxK7CjNZ2LTLNQQMeeMdccUH', '', 'yashashwini.yashu5@gmail.com', '670976eef8b5322c7da17961513c6a50', '9731871406', NULL, 279648, '13.4011563', '78.0520769', NULL, 'Trash', '2021-02-01 16:37:14'),
(11, 'cRzPAh9uRteK27b1dk0p3F:APA91bE4uOXWVvicWMkoeEmuXxVqGr3HDbEc9KQj8RTssC7JWuFSHvDYVwk2zlCiK5rT4PKzxRRZsAHbp10YK5_4q7G_Ibby8Pz01ij3e6lryKWQFdTUm5_n2L-pS1aChdUudpgc7_ex', '', 'namayamini@gmail.com', '9e335c8812ad8d2903a6846535a2a7b8', '9164111669', NULL, 489384, '12.9313671', '77.5069397', NULL, 'Trash', '2021-02-01 16:41:08'),
(12, 'cqWhXJy4RO28BZsMaTxmNY:APA91bHb9Wl_CwSCfAzOBySR4rYO4-GsTak5P9aIPRPJ8cY2XH3JH13l2tkyvVAIjV0gHSHFNsFrQbP9NS3jtlaQfg3erMyzgzp3fa32N7udIZ6EbXsh3qbkkiQWalH3mLjbceTayyRT', 'Madhusudhan K S', 'maddy.as.tyson@gmail.com', '3c05c660a16c11b92ca0378d103d7de9', '8147559255', NULL, 475677, '12.9317223', '77.5691619', NULL, 'Trash', '2021-02-01 17:06:02'),
(13, 'd0lQVL3PRhWSM8enp7MkSo:APA91bFKZqudTHfHcyNk49gKr0eYFHomqL_KLhEkaXkaQ3lyBbkaWRXUnU2hMwhjJyfg-VwGwIt5JIB9Pv5UU9QLUpuwc2Y7V2vWOnZ7cqaERz-Az1B2_SezXwwcLlH-ahrLN9YGpyv2', '', 'lokeshbabukr@gmail.com', '0a8bad7df4b858617b64c2169faabdd3', '9353139815', NULL, 148978, '13.282743', '77.7323321', NULL, 'Trash', '2021-02-08 20:03:13'),
(14, 'dDsqON8zRzKdV6OBO8_fcr:APA91bHOvvawLtc7lATXPddN05BsQwRUTItA-ppY9Toz7WYD6da5LyGrpUGUKN_j3AFXQm1agYGq_MXQhEzaER-jm5Bi_Wi_DSAyCXzfx_1OLhgMtXOpoVg8zjd2xrOtOpqEFrv5f0Hd', '', 'playstorecnx70@gmail.com', '58b4e38f66bcdb546380845d6af27187', '6364908648', NULL, 947120, '0', '0', NULL, 'Trash', '2021-02-15 15:38:02'),
(15, 'dB6SgzM1ThKKsMnJFlP5_7:APA91bFiTqVqwhuC2lXgP_KWjZ3IjM1WHeakCDcfPFlhwvOHksfpBSZBfGGzmvfbSqfnHM9sSVrsJPxL3DHpbMdb6_tIaB38hgK5TGxMWJIcSsDa7uuHMBLwmr_TY9PUu_6SxGv4yopz', 'Sagar K R', 'sagarkopparam.r@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '9844446438', NULL, 277062, '0', '0', NULL, 'Trash', '2021-02-16 21:17:37'),
(16, 'dYsE8so-RQqhBywpz1SY4O:APA91bGNDyk5G3tEYtXp4tADoZnqOpzZmSCrStlhspivYS8q4bOLjkMMXS17HGnxlz-OpkA7rxhBiaZa9xOfp2ooIBb6YBvtzayHBTUVJP46NZ7qZQWUIQovms9db9t-9zL1QeUABW_i', '', 'sathya.anmol@gmail.com', '45474d69d3fac5b1e35cda7eef060fc8', '9986870244', NULL, 341227, '12.9300234', '77.5078809', NULL, 'Trash', '2021-02-16 21:39:04'),
(17, 'e2u_4VyWSLSfusNalUTKhO:APA91bH1VXtT-JyktZcHCdcMLc8kMvwowbO3D0Efp-i_zWLTVDGAsPxfSoGrlP5uf6q8O0OjqW4S1q9zDhiMyLF346dTAn0ljbjj7EUbbo2pX0RpanVr5QH0Wyyn5XRq_1gtlxs8XKHZ', '', 'kanikrini1991@gmail.com', '25d55ad283aa400af464c76d713c07ad', '9752525402', NULL, 237551, '0', '0', NULL, 'Trash', '2021-02-18 10:24:01'),
(18, 'eRIbD3cNQ_-CQEUCvh6ZiS:APA91bHWxd1xUzg04-Fhw0lLe0co6v2A4_A3XFoaUehCJR3zVoN5wew-169znA_bkIXfDhDMeFAZMUovtjjPi-TDZs5LcZXhynZnpx66L40PKTKDtLCrxKiXvUif1VirKw9Jp9uxb27Y', '', 'sj@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '9752256670', NULL, 282934, '23.1427609', '75.8129015', NULL, 'Trash', '2021-02-24 10:53:53'),
(19, NULL, NULL, NULL, 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, 95539, NULL, NULL, NULL, 'Pending', '2021-03-31 13:46:59');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wishlists`
--

CREATE TABLE `tbl_wishlists` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_wishlists`
--

INSERT INTO `tbl_wishlists` (`id`, `user_id`, `product_id`) VALUES
(5, 15, 5),
(4, 5, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_adminusers`
--
ALTER TABLE `tbl_adminusers`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_applogs`
--
ALTER TABLE `tbl_applogs`
  ADD PRIMARY KEY (`applog_id`);

--
-- Indexes for table `tbl_brands`
--
ALTER TABLE `tbl_brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `tbl_carts`
--
ALTER TABLE `tbl_carts`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `tbl_contacts`
--
ALTER TABLE `tbl_contacts`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `tbl_deliveryaddresses`
--
ALTER TABLE `tbl_deliveryaddresses`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_deliveryboys`
--
ALTER TABLE `tbl_deliveryboys`
  ADD PRIMARY KEY (`deliveryboy_id`);

--
-- Indexes for table `tbl_emailcontents`
--
ALTER TABLE `tbl_emailcontents`
  ADD PRIMARY KEY (`emailcontent_id`);

--
-- Indexes for table `tbl_faqs`
--
ALTER TABLE `tbl_faqs`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_offers`
--
ALTER TABLE `tbl_offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_orderdetails`
--
ALTER TABLE `tbl_orderdetails`
  ADD PRIMARY KEY (`orderdetail_id`);

--
-- Indexes for table `tbl_ordernotifications`
--
ALTER TABLE `tbl_ordernotifications`
  ADD PRIMARY KEY (`notify_id`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `deliveryboy_id` (`deliveryboy_id`);

--
-- Indexes for table `tbl_pincodes`
--
ALTER TABLE `tbl_pincodes`
  ADD PRIMARY KEY (`pin_id`);

--
-- Indexes for table `tbl_productcategories`
--
ALTER TABLE `tbl_productcategories`
  ADD PRIMARY KEY (`procategory_id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_productsubcategories`
--
ALTER TABLE `tbl_productsubcategories`
  ADD PRIMARY KEY (`prosubcategory_id`);

--
-- Indexes for table `tbl_productvariations`
--
ALTER TABLE `tbl_productvariations`
  ADD PRIMARY KEY (`variation_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `tbl_promocodes`
--
ALTER TABLE `tbl_promocodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reviews`
--
ALTER TABLE `tbl_reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `tbl_sitesettings`
--
ALTER TABLE `tbl_sitesettings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sliders`
--
ALTER TABLE `tbl_sliders`
  ADD PRIMARY KEY (`slider_id`);

--
-- Indexes for table `tbl_staticpages`
--
ALTER TABLE `tbl_staticpages`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_wishlists`
--
ALTER TABLE `tbl_wishlists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_adminusers`
--
ALTER TABLE `tbl_adminusers`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_applogs`
--
ALTER TABLE `tbl_applogs`
  MODIFY `applog_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_brands`
--
ALTER TABLE `tbl_brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_carts`
--
ALTER TABLE `tbl_carts`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `tbl_contacts`
--
ALTER TABLE `tbl_contacts`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_deliveryaddresses`
--
ALTER TABLE `tbl_deliveryaddresses`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_deliveryboys`
--
ALTER TABLE `tbl_deliveryboys`
  MODIFY `deliveryboy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_emailcontents`
--
ALTER TABLE `tbl_emailcontents`
  MODIFY `emailcontent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_faqs`
--
ALTER TABLE `tbl_faqs`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_offers`
--
ALTER TABLE `tbl_offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_orderdetails`
--
ALTER TABLE `tbl_orderdetails`
  MODIFY `orderdetail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `tbl_ordernotifications`
--
ALTER TABLE `tbl_ordernotifications`
  MODIFY `notify_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `tbl_pincodes`
--
ALTER TABLE `tbl_pincodes`
  MODIFY `pin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_productcategories`
--
ALTER TABLE `tbl_productcategories`
  MODIFY `procategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_productsubcategories`
--
ALTER TABLE `tbl_productsubcategories`
  MODIFY `prosubcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_productvariations`
--
ALTER TABLE `tbl_productvariations`
  MODIFY `variation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_promocodes`
--
ALTER TABLE `tbl_promocodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_reviews`
--
ALTER TABLE `tbl_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_sitesettings`
--
ALTER TABLE `tbl_sitesettings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_sliders`
--
ALTER TABLE `tbl_sliders`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_staticpages`
--
ALTER TABLE `tbl_staticpages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_wishlists`
--
ALTER TABLE `tbl_wishlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
