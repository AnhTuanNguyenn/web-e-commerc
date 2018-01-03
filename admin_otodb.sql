-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 02, 2018 at 10:56 PM
-- Server version: 5.5.31
-- PHP Version: 5.6.20

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `admin_otodb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0: chua xu ly, 1: dang xu ly, 2: xu ly xong: 3  da huy',
  `logs` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `del` tinyint(4) NOT NULL DEFAULT '0',
  `date_create` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `fullname`, `tel`, `email`, `address`, `content`, `status`, `logs`, `del`, `date_create`) VALUES
(1, 'Hoàng Văn Khánh', '0987654321', 'email@gmail.com', 'Trần xuân soạn, Quận 7', '', 2, '[Công ty TNHH CADIVI] đã cập nhật trạng thái đơn hàng từ Đang xử lý sang Đã xử lý<br/>', 0, '2017-09-24 16:44:07'),
(2, 'Trần Hữu Linh', '01239524121', 'email1@gmail.com', 'Hai Bà Trưng, Quận 1', '', 2, '[Công ty TNHH CADIVI] đã cập nhật trạng thái đơn hàng từ  sang <br/>', 0, '2017-09-24 16:51:01'),
(3, 'Nam Le', '0987821341', 'namlengoc.itpro@gmail.com', 'Trần Quốc thảo', 'Test ghi chú', 2, '[Công ty TNHH CADIVI] đã cập nhật trạng thái đơn hàng từ Chưa xử lý sang Đang xử lý<br/>[Công ty TNHH CADIVI] đã cập nhật trạng thái đơn hàng từ Đang xử lý sang Đã xử lý<br/>', 0, '2017-09-24 07:05:17'),
(4, 'Công ty TNHH Ymobile Việt Nam', '123123123', 'duycaliychi1993@gmail.com', '123 thong nhat', 'something', 3, '', 0, '2017-09-25 22:45:02'),
(5, 'Lê Ngọc Nam', '0987654321', 'namlengoc.itpro@gmail.com', 'Trần xuân soạn, Quận 7', '', 0, '', 0, '2017-09-26 00:24:25'),
(6, 'Nam Le', '0978334603', 'namlengoc.itpro@gmail.com', 'demo', 'Ghi chú xíu', 3, '[Nam Lê] đã cập nhật trạng thái đơn hàng từ Chưa xử lý sang Đang xử lý<br/>', 0, '2017-12-22 12:09:49'),
(7, 'Nam Le', '0987654321', 'namlengoc.itpro@gmail.com', '123 Lê Thánh Tôn, Phường Bến Thành, Quận 1, TP. HCM, Việt Nam', '12415125125125', 0, '', 0, '2017-12-23 23:09:50'),
(8, 'Nam Le', '098765421', 'namlengoc.itpro@gmail.com', '241241', '1513251sagag32', 0, '', 0, '2017-12-23 23:15:47'),
(9, 'Nam Le', '0987654321', 'namlengoc.itpro@gmail.com', '123 Lê Thánh Tôn, Phường Bến Thành, Quận 1, TP. HCM, Việt Nam', '214214124214', 0, '', 0, '2017-12-23 23:19:25'),
(10, 'Nam le1', '0987654321', 'namlengoc.itpro@gmail.com', '124124', '214124124', 0, '', 0, '2017-12-23 23:24:44'),
(11, 'Nam Le', '099987664214', 'namlengoc.itpro@gmail.com', '123 Lê Thánh Tôn, Phường Bến Thành, Quận 1, TP. HCM, Việt Nam', '214214124214124', 0, '', 0, '2017-12-23 23:26:37');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `tel` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(67) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `content` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `date_create` datetime NOT NULL,
  `view` tinyint(4) NOT NULL DEFAULT '0',
  `del` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `fullname`, `user_id`, `tel`, `address`, `email`, `title`, `content`, `date_create`, `view`, `del`) VALUES
(6, 'Nam Le', 37570, '+358104488000', 'Karaportti 3, 02610 Espoo', 'namlengo@gmail.com', 'Tiến độ thi công dự án Làng Sen Việt Nam tháng 7 - 2016', 'Demo gửi mail nè', '2016-07-28 19:57:01', 1, 0),
(7, 'Nguyen', 37570, '0123345123', '123 thong nhat', 'duy.pat@gmail.com', 'gui mai tét', 'test mail', '2017-09-24 22:56:50', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `info_cart`
--

CREATE TABLE IF NOT EXISTS `info_cart` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `total` tinyint(4) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Dumping data for table `info_cart`
--

INSERT INTO `info_cart` (`id`, `cart_id`, `thread_id`, `total`, `price`) VALUES
(1, 1, 41148, 2, 960000),
(2, 1, 41155, 1, 620000),
(3, 1, 41157, 1, 379050),
(4, 2, 41148, 2, 960000),
(5, 2, 41155, 1, 620000),
(6, 2, 41157, 1, 379050),
(7, 3, 41155, 2, 620000),
(8, 3, 41156, 1, 1200000),
(9, 4, 41156, 1, 1200000),
(10, 5, 41156, 2, 1200000),
(11, 5, 41157, 1, 379050),
(12, 6, 41185, 1, 77),
(13, 6, 41186, 1, 1412421),
(14, 7, 41185, 3, 77),
(15, 7, 41186, 2, 1412421),
(16, 8, 41185, 1, 77),
(17, 9, 41165, 1, 66),
(18, 9, 41185, 1, 77),
(19, 10, 41165, 1, 66),
(20, 10, 41185, 1, 77),
(21, 11, 41166, 1, 77),
(22, 11, 41186, 3, 1412421),
(23, 11, 41187, 1, 1244124);

-- --------------------------------------------------------

--
-- Table structure for table `logs_access`
--

CREATE TABLE IF NOT EXISTS `logs_access` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `session_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('news','thread','album','record') COLLATE utf8_unicode_ci NOT NULL,
  `client_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `web` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `date_create` datetime NOT NULL,
  `del` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `logs_visitor`
--

CREATE TABLE IF NOT EXISTS `logs_visitor` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `session_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('news','thread','album','record') COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `date_create` datetime NOT NULL,
  `del` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2404 ;

--
-- Dumping data for table `logs_visitor`
--

INSERT INTO `logs_visitor` (`id`, `session_id`, `type`, `user_id`, `parent_id`, `date_create`, `del`) VALUES
(2351, 'an0lrvjel97h4b3aib27ru42r7', 'thread', 37570, 41158, '2017-09-24 12:56:21', 0),
(2352, 'an0lrvjel97h4b3aib27ru42r7', 'thread', 37570, 41157, '2017-09-24 13:08:15', 0),
(2353, 'an0lrvjel97h4b3aib27ru42r7', 'thread', 37570, 41155, '2017-09-24 13:04:03', 0),
(2354, 'an0lrvjel97h4b3aib27ru42r7', '', 37570, 991, '2017-09-24 13:08:35', 0),
(2355, 'an0lrvjel97h4b3aib27ru42r7', '', 37570, 991, '2017-09-24 13:08:37', 0),
(2356, 'an0lrvjel97h4b3aib27ru42r7', '', 37570, 991, '2017-09-24 13:08:38', 0),
(2357, 'an0lrvjel97h4b3aib27ru42r7', '', 37570, 991, '2017-09-24 13:09:39', 0),
(2358, 'an0lrvjel97h4b3aib27ru42r7', '', 37570, 991, '2017-09-24 13:09:42', 0),
(2359, 'an0lrvjel97h4b3aib27ru42r7', '', 37570, 991, '2017-09-24 13:09:44', 0),
(2360, 'an0lrvjel97h4b3aib27ru42r7', '', 37570, 991, '2017-09-24 13:10:45', 0),
(2361, 'an0lrvjel97h4b3aib27ru42r7', '', 37570, 991, '2017-09-24 13:10:47', 0),
(2362, 'an0lrvjel97h4b3aib27ru42r7', '', 37570, 991, '2017-09-24 13:10:48', 0),
(2363, 'an0lrvjel97h4b3aib27ru42r7', '', 37570, 991, '2017-09-24 13:10:51', 0),
(2364, 'an0lrvjel97h4b3aib27ru42r7', '', 37570, 991, '2017-09-24 13:10:53', 0),
(2365, 'an0lrvjel97h4b3aib27ru42r7', '', 37570, 991, '2017-09-24 13:11:37', 0),
(2366, 'an0lrvjel97h4b3aib27ru42r7', '', 37570, 991, '2017-09-24 13:11:38', 0),
(2367, 'an0lrvjel97h4b3aib27ru42r7', '', 37570, 991, '2017-09-24 13:11:40', 0),
(2368, 'an0lrvjel97h4b3aib27ru42r7', '', 37570, 991, '2017-09-24 13:11:42', 0),
(2369, 'an0lrvjel97h4b3aib27ru42r7', '', 37570, 991, '2017-09-24 13:12:31', 0),
(2370, 'an0lrvjel97h4b3aib27ru42r7', '', 37570, 991, '2017-09-24 13:12:32', 0),
(2371, 'an0lrvjel97h4b3aib27ru42r7', '', 37570, 991, '2017-09-24 13:12:34', 0),
(2372, 'an0lrvjel97h4b3aib27ru42r7', '', 37570, 991, '2017-09-24 13:14:11', 0),
(2373, 'an0lrvjel97h4b3aib27ru42r7', '', 37570, 991, '2017-09-24 13:14:14', 0),
(2374, 'an0lrvjel97h4b3aib27ru42r7', '', 37570, 991, '2017-09-24 13:14:16', 0),
(2375, 'an0lrvjel97h4b3aib27ru42r7', '', 37570, 991, '2017-09-24 13:14:32', 0),
(2376, 'an0lrvjel97h4b3aib27ru42r7', '', 37570, 991, '2017-09-24 13:14:37', 0),
(2377, 'an0lrvjel97h4b3aib27ru42r7', '', 37570, 991, '2017-09-24 13:14:39', 0),
(2378, 'an0lrvjel97h4b3aib27ru42r7', '', 37570, 991, '2017-09-24 13:14:40', 0),
(2379, 'an0lrvjel97h4b3aib27ru42r7', 'record', 37570, 991, '2017-09-24 13:16:10', 0),
(2380, 'an0lrvjel97h4b3aib27ru42r7', 'thread', 37570, 41156, '2017-09-24 13:16:37', 0),
(2381, 'an0lrvjel97h4b3aib27ru42r7', 'thread', 37570, 41148, '2017-09-24 13:18:23', 0),
(2382, 'an0lrvjel97h4b3aib27ru42r7', 'thread', 37570, 41149, '2017-09-24 13:20:31', 0),
(2383, 'sg3tk54ttld2t64ih27hedtrv2', 'thread', 37570, 41158, '2017-09-24 22:33:57', 0),
(2384, 'sg3tk54ttld2t64ih27hedtrv2', 'thread', 37570, 41154, '2017-09-24 22:42:10', 0),
(2385, 'sg3tk54ttld2t64ih27hedtrv2', 'record', 37570, 998, '2017-09-24 22:45:33', 0),
(2386, 'sg3tk54ttld2t64ih27hedtrv2', 'record', 37570, 991, '2017-09-24 22:48:31', 0),
(2387, 'rfo3pbogd6hcrh7g55v0851vn1', 'thread', 37570, 41156, '2017-09-25 04:04:48', 0),
(2388, 'rfo3pbogd6hcrh7g55v0851vn1', 'thread', 37570, 41157, '2017-09-25 04:05:36', 0),
(2389, 'rfo3pbogd6hcrh7g55v0851vn1', 'thread', 37570, 41155, '2017-09-25 04:09:06', 0),
(2390, 'rfo3pbogd6hcrh7g55v0851vn1', 'thread', 37570, 41152, '2017-09-25 04:22:13', 0),
(2391, 'rfo3pbogd6hcrh7g55v0851vn1', 'thread', 37570, 41158, '2017-09-25 04:28:56', 0),
(2392, 'rfo3pbogd6hcrh7g55v0851vn1', 'thread', 37570, 41150, '2017-09-25 04:29:24', 0),
(2393, 'rfo3pbogd6hcrh7g55v0851vn1', 'record', 37570, 991, '2017-09-25 04:47:04', 0),
(2394, 'k79oluogs06trgfnj7ei2jgru4', 'thread', 37570, 41158, '2017-09-25 12:29:31', 0),
(2395, 'k79oluogs06trgfnj7ei2jgru4', 'record', 37570, 994, '2017-09-25 12:34:34', 0),
(2396, 'k79oluogs06trgfnj7ei2jgru4', 'record', 37570, 995, '2017-09-25 12:38:59', 0),
(2397, '4kpktgip127i0hp1v0rdecr4s0', 'thread', 37570, 41148, '2017-09-25 22:43:17', 0),
(2398, '4kpktgip127i0hp1v0rdecr4s0', 'thread', 37570, 41156, '2017-09-25 22:44:27', 0),
(2399, '4kpktgip127i0hp1v0rdecr4s0', 'thread', 37570, 41158, '2017-09-25 22:52:59', 0),
(2400, 'ks9l9v672u5upnsnp1fqgfbmi4', 'thread', 37570, 41159, '2017-09-26 02:30:45', 0),
(2401, 'ks9l9v672u5upnsnp1fqgfbmi4', 'thread', 37570, 41149, '2017-09-26 02:39:53', 0),
(2402, '7oibrg3cn59g6a5kn520j9rfg5', 'thread', 37570, 41152, '2017-09-26 22:48:48', 0),
(2403, '7oibrg3cn59g6a5kn520j9rfg5', 'thread', 37570, 41158, '2017-09-26 23:06:58', 0);

-- --------------------------------------------------------

--
-- Table structure for table `thread`
--

CREATE TABLE IF NOT EXISTS `thread` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` tinyint(4) NOT NULL DEFAULT '0',
  `category_shop_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `sub_title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `short_content` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `images` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `price` bigint(20) unsigned NOT NULL DEFAULT '0',
  `currency` enum('usd','euro','','') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'usd',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `flag_hot` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `flag_example` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0: đã sử dụng, 1: thông tin vd ',
  `date_create` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  `del` tinyint(4) NOT NULL DEFAULT '0',
  `visitor` int(11) NOT NULL DEFAULT '0',
  `comment` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=41188 ;

--
-- Dumping data for table `thread`
--

INSERT INTO `thread` (`id`, `category_id`, `category_shop_id`, `title`, `sub_title`, `short_content`, `content`, `images`, `price`, `currency`, `user_id`, `flag_hot`, `flag_example`, `date_create`, `date_update`, `del`, `visitor`, `comment`) VALUES
(41148, 1, 753, 'Đèn trần PARKER', 'Den-tran-PARKER', '', '<h4 class="title"><span class="text">ĐẶC ĐIỂM SẢN PHẨM</span></h4>\r\n<div class="content">\r\n<table width="100%">\r\n<tbody>\r\n<tr>\r\n<td>Chất Liệu</td>\r\n<td>Kim loại</td>\r\n</tr>\r\n<tr>\r\n<td>Màu sắc</td>\r\n<td>Màu đen</td>\r\n</tr>\r\n<tr>\r\n<td>Kích thước</td>\r\n<td>Dài 30 cm, Sâu 30 cm, Cao 24 cm</td>\r\n</tr>\r\n<tr>\r\n<td>Mã Sản Phẩm</td>\r\n<td>1062908</td>\r\n</tr>\r\n<tr>\r\n<td>Thiết Kế Bởi</td>\r\n<td> </td>\r\n</tr>\r\n<tr>\r\n<td>Xuất Xứ</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '590183d08dbac.jpg', 960000, 'usd', 37570, 0, 0, '2017-04-27 07:34:18', '2017-04-27 07:38:26', 0, 3, 0),
(41149, 1, 754, 'Móc treo đồ REBEL', 'Moc-treo-do-REBEL', '', '<table width="100%">\r\n<tbody>\r\n<tr>\r\n<td>Chất Liệu</td>\r\n<td>Powder Coated Steel</td>\r\n</tr>\r\n<tr>\r\n<td>Màu sắc</td>\r\n<td>Màu đen</td>\r\n</tr>\r\n<tr>\r\n<td>Kích thước</td>\r\n<td>Dài 30 cm, Đường kính 2 cm</td>\r\n</tr>\r\n<tr>\r\n<td>Mã Sản Phẩm</td>\r\n<td>1072532</td>\r\n</tr>\r\n<tr>\r\n<td>Thiết Kế Bởi</td>\r\n<td>Sofia Holt[937]</td>\r\n</tr>\r\n<tr>\r\n<td>Xuất Xứ<br /><br /></td>\r\n</tr>\r\n</tbody>\r\n</table>', '590184e17ba26.jpg', 85000, 'usd', 37570, 0, 0, '2017-04-27 07:42:59', '0000-00-00 00:00:00', 0, 2, 0),
(41150, 1, 755, 'Giường HARRIS', 'Giuong-HARRIS', '', '<table width="100%">\r\n<tbody>\r\n<tr>\r\n<td>Chất Liệu</td>\r\n<td>Sồi/MDF/Veneer sồi</td>\r\n</tr>\r\n<tr>\r\n<td>Màu sắc</td>\r\n<td>Oak</td>\r\n</tr>\r\n<tr>\r\n<td>Kích thước</td>\r\n<td>Dài 200 cm, Ngang 180 cm, Cao 109 cm</td>\r\n</tr>\r\n<tr>\r\n<td>Mã Sản Phẩm</td>\r\n<td>1026580</td>\r\n</tr>\r\n<tr>\r\n<td>Thiết Kế Bởi</td>\r\n<td> </td>\r\n</tr>\r\n<tr>\r\n<td>Xuất Xứ<br /><br /></td>\r\n</tr>\r\n</tbody>\r\n</table>', '590185d6b9458.jpg', 1500000, 'usd', 37570, 1, 0, '2017-04-27 07:47:03', '0000-00-00 00:00:00', 0, 1, 0),
(41151, 1, 755, 'Giường ANN LOUISE', 'Giuong-ANN-LOUISE', '', '<h4 class="title"><span class="text">ĐẶC ĐIỂM SẢN PHẨM</span></h4>\r\n<div class="content"><br class="Apple-interchange-newline" />\r\n<table width="100%">\r\n<tbody>\r\n<tr>\r\n<td>Chất Liệu</td>\r\n<td>Gỗ keo/MDF</td>\r\n</tr>\r\n<tr>\r\n<td>Màu sắc</td>\r\n<td>Màu trắng</td>\r\n</tr>\r\n<tr>\r\n<td>Kích thước</td>\r\n<td>Dài 214/200 cm, Ngang 174/160 cm, Cao 80 cm</td>\r\n</tr>\r\n<tr>\r\n<td>Mã Sản Phẩm</td>\r\n<td>1029635</td>\r\n</tr>\r\n<tr>\r\n<td>Thiết Kế Bởi</td>\r\n<td>Nguyen Thuy Nhung[198]</td>\r\n</tr>\r\n<tr>\r\n<td>Xuất Xứ</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '590185f8e069b.jpg', 7500000, 'usd', 37570, 1, 0, '2017-04-27 07:47:37', '0000-00-00 00:00:00', 0, 0, 0),
(41152, 1, 756, 'Giường KEIKO', 'Giuong-KEIKO', '', '<h4 class="title"><span class="text">ĐẶC ĐIỂM SẢN PHẨM</span></h4>\r\n<div class="content"><br class="Apple-interchange-newline" />\r\n<table width="100%">\r\n<tbody>\r\n<tr>\r\n<td>Chất Liệu</td>\r\n<td>Sồi/MDF/Veneer sồi</td>\r\n</tr>\r\n<tr>\r\n<td>Màu sắc</td>\r\n<td>Không</td>\r\n</tr>\r\n<tr>\r\n<td>Kích thước</td>\r\n<td>Dài 200 cm, Ngang 180 cm, Cao 30/ 81 cm</td>\r\n</tr>\r\n<tr>\r\n<td>Mã Sản Phẩm</td>\r\n<td>1008791</td>\r\n</tr>\r\n<tr>\r\n<td>Thiết Kế Bởi</td>\r\n<td> </td>\r\n</tr>\r\n<tr>\r\n<td>Xuất Xứ</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '5901cebceb533.jpg', 9000000, 'usd', 37570, 1, 0, '2017-04-27 07:49:06', '2017-04-27 12:58:06', 0, 5, 0),
(41153, 1, 755, 'Giường MOZART', 'Giuong-MOZART', '', '<table width="100%">\r\n<tbody>\r\n<tr>\r\n<td>Chất Liệu</td>\r\n<td>MDF/Gỗ cao su</td>\r\n</tr>\r\n<tr>\r\n<td>Màu sắc</td>\r\n<td>White/ Natural</td>\r\n</tr>\r\n<tr>\r\n<td>Kích thước</td>\r\n<td>Dài 200 cm, Ngang 160 cm, Cao 80 cm</td>\r\n</tr>\r\n<tr>\r\n<td>Mã Sản Phẩm</td>\r\n<td>1048520</td>\r\n</tr>\r\n<tr>\r\n<td>Thiết Kế Bởi</td>\r\n<td>Nguyen Thuy Nhung[198]</td>\r\n</tr>\r\n<tr>\r\n<td>Xuất Xứ<br /><br /></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p> </p>', '5901941c19a73.jpg', 4075500, 'usd', 37570, 1, 0, '2017-04-27 07:50:06', '2017-04-27 08:47:57', 1, 0, 0),
(41154, 1, 755, 'Giường tầng GRAFFITI', '1493275385-Giuong-tang-GRAFFITI', '', '<table width="100%">\r\n<tbody>\r\n<tr>\r\n<td>Chất Liệu</td>\r\n<td>Powder Coated Steel</td>\r\n</tr>\r\n<tr>\r\n<td>Màu sắc</td>\r\n<td>Màu đen</td>\r\n</tr>\r\n<tr>\r\n<td>Kích thước</td>\r\n<td>Sâu 90/ 138 cm, Ngang 190 cm, Cao 175 cm</td>\r\n</tr>\r\n<tr>\r\n<td>Mã Sản Phẩm</td>\r\n<td>1462</td>\r\n</tr>\r\n<tr>\r\n<td>Thiết Kế Bởi</td>\r\n<td> </td>\r\n</tr>\r\n<tr>\r\n<td>Xuất Xứ<br /><br /></td>\r\n</tr>\r\n</tbody>\r\n</table>', '590186aa9ee51.jpg', 4075500, 'usd', 37570, 0, 0, '2017-04-27 07:50:35', '2017-04-27 08:43:05', 0, 1, 0),
(41155, 1, 753, 'Ghế ngoài trời CAFE ROYALE', 'Ghe-ngoai-troi-CAFE-ROYALE', '', '<table width="100%">\r\n<tbody>\r\n<tr>\r\n<td>Chất Liệu</td>\r\n<td>Powder Coated Steel</td>\r\n</tr>\r\n<tr>\r\n<td>Màu sắc</td>\r\n<td>Màu đen</td>\r\n</tr>\r\n<tr>\r\n<td>Kích thước</td>\r\n<td>Sâu 49 cm, Ngang 41 cm, Cao 45/83 cm</td>\r\n</tr>\r\n<tr>\r\n<td>Mã Sản Phẩm</td>\r\n<td>1068931</td>\r\n</tr>\r\n<tr>\r\n<td>Thiết Kế Bởi</td>\r\n<td>Joachim Poirier[372]</td>\r\n</tr>\r\n<tr>\r\n<td>Xuất Xứ</td>\r\n<td> </td>\r\n</tr>\r\n</tbody>\r\n</table>', '59019462995a2.jpg', 620000, 'usd', 37570, 1, 0, '2017-04-27 08:49:07', '0000-00-00 00:00:00', 0, 3, 0),
(41156, 1, 753, 'Bàn ngoài trời CAFE ROYALE', 'Ban-ngoai-troi-CAFE-ROYALE', '', '<p> </p>\r\n<table width="100%">\r\n<tbody>\r\n<tr>\r\n<td>Chất Liệu</td>\r\n<td>Powder Coated Steel</td>\r\n</tr>\r\n<tr>\r\n<td>Màu sắc</td>\r\n<td>Màu đen</td>\r\n</tr>\r\n<tr>\r\n<td>Kích thước</td>\r\n<td>Cao 73 cm, Đường kính 70 cm</td>\r\n</tr>\r\n<tr>\r\n<td>Mã Sản Phẩm</td>\r\n<td>1068917</td>\r\n</tr>\r\n<tr>\r\n<td>Thiết Kế Bởi</td>\r\n<td>Joachim Poirier[372]</td>\r\n</tr>\r\n<tr>\r\n<td>Xuất Xứ</td>\r\n</tr>\r\n</tbody>\r\n</table>', '5901ce0f647ef.jpg', 1200000, 'usd', 37570, 0, 0, '2017-04-27 08:50:04', '2017-04-27 12:55:12', 0, 11, 0),
(41157, 1, 753, 'Ghế đôn ngoài trời CAFE ROYALE', 'Ghe-don-ngoai-troi-CAFE-ROYALE', '', '<table width="100%">\r\n<tbody>\r\n<tr>\r\n<td>Chất Liệu</td>\r\n<td>Powder Coated Steel</td>\r\n</tr>\r\n<tr>\r\n<td>Màu sắc</td>\r\n<td>Màu trắng</td>\r\n</tr>\r\n<tr>\r\n<td>Kích thước</td>\r\n<td>Sâu 47 cm, Ngang 47 cm, Cao 46 cm</td>\r\n</tr>\r\n<tr>\r\n<td>Mã Sản Phẩm</td>\r\n<td>1068962</td>\r\n</tr>\r\n<tr>\r\n<td>Thiết Kế Bởi</td>\r\n<td>Joachim Poirier[372]</td>\r\n</tr>\r\n<tr>\r\n<td>Xuất Xứ<br /><br /></td>\r\n</tr>\r\n</tbody>\r\n</table>', '590194c89d050.jpg', 379050, 'usd', 37570, 1, 0, '2017-04-27 08:50:49', '0000-00-00 00:00:00', 0, 15, 0),
(41158, 1, 755, 'Kem Đánh Răng Dr. Kool Than Tre', 'Kem-Danh-Rang-Dr-Kool-Than-Tre', '', '<table id="chi-tiet" class="table table-bordered table-detail table-striped" style="height: 197px;" width="1318" cellspacing="0"><colgroup><col /><col /></colgroup>\r\n<tbody>\r\n<tr>\r\n<td class="first" style="width: 200px;">SKU                    </td>\r\n<td class="last">3832346405655</td>\r\n</tr>\r\n<tr>\r\n<td class="first">Thương hiệu</td>\r\n<td class="last"><a href="http://tiki.vn/thuong-hieu/dr-kool.html">Dr. Kool</a></td>\r\n</tr>\r\n<tr>\r\n<td class="first">Sản xuất tại</td>\r\n<td class="last"><strong>Mỹ</strong></td>\r\n</tr>\r\n<tr>\r\n<td class="first">Thành phần</td>\r\n<td class="last">Sorbitol, Hydrated Silaca, Water, Sodium Laruyl sulfate, Sodium Chloride (Sea Salt, Bamboo Salt), Peg-32, flavor, cellulose Gum, Sodium Benzoate, Sodium Fluoride, Sodium Saccharin, Trisodium Phosphate, Ci 42090, Ci 19140</td>\r\n</tr>\r\n<tr>\r\n<td class="first">Hạn sử dụng</td>\r\n<td class="last">Xem trên bao bì sản phẩm</td>\r\n</tr>\r\n<tr>\r\n<td class="first">Trọng lượng</td>\r\n<td class="last">150g</td>\r\n</tr>\r\n<tr>\r\n<td class="first">Hướng dẫn bảo quản</td>\r\n<td class="last">Tránh nhiệt độ cao và ánh nắng trực tiếp</td>\r\n</tr>\r\n<tr>\r\n<td class="first">Hướng dẫn sử dụng</td>\r\n<td class="last">\r\n<ul>\r\n<li>Cho một lượng vừa đủ kem đánh răng lên mặt lông của bàn chải và chải nhẹ nhàng lên răng</li>\r\n<li>Đánh răng xong súc miệng bằng nước sạch</li>\r\n<li>Nên đánh răng sau khi ăn xong, tối trước khi đi ngủ và sáng sau khi thức dậy, ít nhất hai lần mỗi ngày</li>\r\n<li>Để tránh làm tổn thương men răng, hãy chọn bàn chải tốt và mỗi sáu tháng thay một lần để đảm bảo vệ sinh, phòng tránh nhiễm khuẩn</li>\r\n</ul>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>', '59c7d133d0d1f.jpg', 0, 'usd', 37570, 0, 0, '2017-09-24 12:38:48', '2017-09-24 22:42:01', 0, 17, 0),
(41159, 1, 757, 'Phát wifi 4g', 'Phat-wifi-4g', '', '<div id="js_i0a" class="_5pbx userContent" data-ft="{">\r\n<div id="id_59c9ec9367f9d7d03417033" class="text_exposed_root text_exposed">\r\n<p>                                                               </p>\r\n<p>Phát WiFi 4G mới nhất 2017</p>\r\n<p>Phát WiFi 4G - LTE Nhật Bản là sản phẩm bán chạy nhất 2017 vì ?<br />- Thiết kế nhỏ gọn đẹp mắt, màn hình hiển thị hiệu ứng LED công nghệ cao của Sony <br />- Dể dàng sử dụng và cài đặt kết nối với điện thoại, máy tính...<span class="text_exposed_show"><br />- Sử dụng công nghệ tiết kiệm Pin <br />- Sử dụng công nghệ sạc nhanh<br />- Sử dụng chip Qualcomm tốc độ cao<br />- Sử dụng ngôn ngữ cài đặt bằng nhiều thứ tiếng (có tiếng anh).<br />- Phiên bản quốc tế dùng được tất cả các nhà mạng trên thế giới<br />- Kết nối 10 thiết bị cùng lúc vẫn chạy rất mạnh<br />- Kết nối được những vùng có sóng yếu<br /></span></p>\r\n<p>                                                                                                                  <img src="../../..//customer/dientu/data/admin/images/thread/876880a335b9d9e780a8.jpg" alt="" width="443" height="340" /></p>\r\n</div>\r\n</div>', '59c9594187901.jpg', 0, 'usd', 37570, 1, 0, '2017-09-26 02:24:27', '2017-09-26 02:41:13', 0, 2, 0),
(41160, 0, 0, 'Sản phẩm 2', 'San-pham-2', '', 'giới thiệu', '', 100000, 'usd', 37571, 0, 0, '2017-12-19 22:38:54', '2017-12-19 22:41:17', 1, 0, 0),
(41161, 0, 0, 'San pham 2', '1513778413-San-pham-2', '', '412412412', '', 123, 'euro', 37571, 0, 0, '2017-12-20 21:00:13', '0000-00-00 00:00:00', 1, 0, 0),
(41162, 0, 0, 'Sản phẩm 1', 'San-pham-1', 'Giới thiệu gnắ', '<p>agjăiogjw agm ăgăgă412412412</p>', '5a3bcfd27102a.png', 123, 'euro', 37571, 1, 0, '2017-12-20 21:00:24', '2017-12-21 22:15:07', 0, 0, 0),
(41163, 0, 0, 'San pham 2', '1513778426-San-pham-2', '', '412412412', '', 123, 'euro', 37571, 1, 0, '2017-12-20 21:00:26', '0000-00-00 00:00:00', 0, 0, 0),
(41164, 0, 0, 'sanr pham 2', 'sanr-pham-2', '', '12451251', '5a3a6d77cdfe6.png', 123456, 'usd', 37571, 1, 0, '2017-12-20 21:02:31', '0000-00-00 00:00:00', 0, 0, 0),
(41165, 0, 0, 'Lorem ipsum dolor sitconsectetuer adipiscing elit', 'Lorem-ipsum-dolor-sitconsectetuer-adipiscing-elit', '', 'Lorem ipsum dolor sitconsectetuer adipiscing elit', '5a3a6ddeb2194.jpg', 66, 'usd', 37571, 1, 0, '2017-12-20 21:04:14', '0000-00-00 00:00:00', 0, 0, 0),
(41166, 0, 0, 'Lorem ipsum dolor sitconsectetuer adipiscing elit', '1513778697-Lorem-ipsum-dolor-sitconsectetuer-adipiscing-elit', '', 'Lorem ipsum dolor sitconsectetuer adipiscing elit\r\n', '5a3a6e090ca2d.jpg', 77, 'euro', 37571, 1, 0, '2017-12-20 21:04:57', '0000-00-00 00:00:00', 0, 0, 0),
(41167, 0, 0, 'Lorem ipsum dolor sitconsectetuer adipiscing elit', '1513778700-Lorem-ipsum-dolor-sitconsectetuer-adipiscing-elit', '', 'Lorem ipsum dolor sitconsectetuer adipiscing elit\r\n', '5a3a6e0c62778.jpg', 77, 'euro', 37571, 0, 0, '2017-12-20 21:05:00', '0000-00-00 00:00:00', 0, 0, 0),
(41168, 0, 0, 'Lorem ipsum dolor sitconsectetuer adipiscing elit', '1513778701-Lorem-ipsum-dolor-sitconsectetuer-adipiscing-elit', '', 'Lorem ipsum dolor sitconsectetuer adipiscing elit\r\n', '5a3a6e0d5e69e.jpg', 77, 'euro', 37571, 0, 0, '2017-12-20 21:05:01', '0000-00-00 00:00:00', 0, 0, 0),
(41169, 0, 0, 'Lorem ipsum dolor sitconsectetuer adipiscing elit', '1513778702-Lorem-ipsum-dolor-sitconsectetuer-adipiscing-elit', '', 'Lorem ipsum dolor sitconsectetuer adipiscing elit\r\n', '5a3a6e0de7fb3.jpg', 77, 'euro', 37571, 0, 0, '2017-12-20 21:05:02', '0000-00-00 00:00:00', 0, 0, 0),
(41170, 0, 0, 'Lorem ipsum dolor sitconsectetuer adipiscing elit', '1513778702-Lorem-ipsum-dolor-sitconsectetuer-adipiscing-elit', '', 'Lorem ipsum dolor sitconsectetuer adipiscing elit\r\n', '5a3a6e0e9394c.jpg', 77, 'euro', 37571, 0, 0, '2017-12-20 21:05:02', '0000-00-00 00:00:00', 0, 0, 0),
(41171, 0, 0, 'Lorem ipsum dolor sitconsectetuer adipiscing elit', '1513778703-Lorem-ipsum-dolor-sitconsectetuer-adipiscing-elit', '', 'Lorem ipsum dolor sitconsectetuer adipiscing elit\r\n', '5a3a6e0f43f30.jpg', 77, 'euro', 37571, 0, 0, '2017-12-20 21:05:03', '0000-00-00 00:00:00', 0, 0, 0),
(41172, 0, 0, 'Sản phẩm hay', 'San-pham-hay', '', '<p><img src="data/images/editor/banner2.jpg" alt="" /></p>\r\n<p>Lorem ipsum dolor sitconsectetuer adipiscing elit 321312</p>', '5a3a7949066ff.jpg', 123, 'euro', 37571, 0, 0, '2017-12-20 21:05:03', '2017-12-20 22:18:54', 0, 0, 0),
(41173, 0, 0, 'Lorem ipsum dolor sitconsectetuer adipiscing elit', '1513778704-Lorem-ipsum-dolor-sitconsectetuer-adipiscing-elit', '', 'Lorem ipsum dolor sitconsectetuer adipiscing elit\r\n', '5a3a6e1057bcf.jpg', 77, 'euro', 37571, 0, 0, '2017-12-20 21:05:04', '0000-00-00 00:00:00', 0, 0, 0),
(41174, 0, 0, 'Lorem ipsum dolor sitconsectetuer adipiscing elit', '1513778705-Lorem-ipsum-dolor-sitconsectetuer-adipiscing-elit', '', 'Lorem ipsum dolor sitconsectetuer adipiscing elit\r\n', '5a3a6e10e7fb3.jpg', 77, 'euro', 37571, 0, 0, '2017-12-20 21:05:05', '0000-00-00 00:00:00', 0, 0, 0),
(41175, 0, 0, 'Lorem ipsum dolor sitconsectetuer adipiscing elit', '1513778705-Lorem-ipsum-dolor-sitconsectetuer-adipiscing-elit', '', 'Lorem ipsum dolor sitconsectetuer adipiscing elit\r\n', '5a3a6e116e263.jpg', 77, 'euro', 37571, 0, 0, '2017-12-20 21:05:05', '0000-00-00 00:00:00', 0, 0, 0),
(41176, 0, 0, 'Lorem ipsum dolor sitconsectetuer adipiscing elit', '1513778706-Lorem-ipsum-dolor-sitconsectetuer-adipiscing-elit', '', 'Lorem ipsum dolor sitconsectetuer adipiscing elit\r\n', '5a3a6e11f3e6f.jpg', 77, 'euro', 37571, 0, 0, '2017-12-20 21:05:06', '0000-00-00 00:00:00', 0, 0, 0),
(41177, 0, 0, 'Lorem ipsum dolor sitconsectetuer adipiscing elit', '1513778706-Lorem-ipsum-dolor-sitconsectetuer-adipiscing-elit', '', 'Lorem ipsum dolor sitconsectetuer adipiscing elit\r\n', '5a3a6e127b803.jpg', 77, 'euro', 37571, 0, 0, '2017-12-20 21:05:06', '0000-00-00 00:00:00', 0, 0, 0),
(41178, 0, 0, 'Lorem ipsum dolor sitconsectetuer adipiscing elit', '1513778707-Lorem-ipsum-dolor-sitconsectetuer-adipiscing-elit', '', 'Lorem ipsum dolor sitconsectetuer adipiscing elit\r\n', '5a3a6e1308d24.jpg', 77, 'euro', 37571, 0, 0, '2017-12-20 21:05:07', '0000-00-00 00:00:00', 0, 0, 0),
(41179, 0, 0, 'Lorem ipsum dolor sitconsectetuer adipiscing elit', '1513778707-Lorem-ipsum-dolor-sitconsectetuer-adipiscing-elit', '', 'Lorem ipsum dolor sitconsectetuer adipiscing elit\r\n', '5a3a6e13863ac.jpg', 77, 'euro', 37571, 0, 0, '2017-12-20 21:05:07', '0000-00-00 00:00:00', 0, 0, 0),
(41180, 0, 0, 'Lorem ipsum dolor sitconsectetuer adipiscing elit', '1513778708-Lorem-ipsum-dolor-sitconsectetuer-adipiscing-elit', '', 'Lorem ipsum dolor sitconsectetuer adipiscing elit\r\n', '5a3a6e1404c4b.jpg', 77, 'euro', 37571, 0, 0, '2017-12-20 21:05:08', '0000-00-00 00:00:00', 0, 0, 0),
(41181, 0, 0, 'Lorem ipsum dolor sitconsectetuer adipiscing elit', '1513778708-Lorem-ipsum-dolor-sitconsectetuer-adipiscing-elit', '', 'Lorem ipsum dolor sitconsectetuer adipiscing elit\r\n', '5a3a6e146a18a.jpg', 77, 'euro', 37571, 0, 0, '2017-12-20 21:05:08', '0000-00-00 00:00:00', 0, 0, 0),
(41182, 0, 0, 'Lorem ipsum dolor sitconsectetuer adipiscing elit', '1513778709-Lorem-ipsum-dolor-sitconsectetuer-adipiscing-elit', '', 'Lorem ipsum dolor sitconsectetuer adipiscing elit\r\n', '5a3a6e14f1479.jpg', 77, 'euro', 37571, 0, 0, '2017-12-20 21:05:09', '0000-00-00 00:00:00', 0, 0, 0),
(41183, 0, 0, 'Lorem ipsum dolor sitconsectetuer adipiscing elit', '1513778709-Lorem-ipsum-dolor-sitconsectetuer-adipiscing-elit', '', 'Lorem ipsum dolor sitconsectetuer adipiscing elit\r\n', '5a3a6e155b507.jpg', 77, 'euro', 37571, 0, 0, '2017-12-20 21:05:09', '0000-00-00 00:00:00', 0, 0, 0),
(41184, 0, 0, 'Lorem ipsum dolor sitconsectetuer adipiscing elit', '1513778709-Lorem-ipsum-dolor-sitconsectetuer-adipiscing-elit', '', 'Lorem ipsum dolor sitconsectetuer adipiscing elit\r\n', '5a3a6e15b9ba6.jpg', 77, 'euro', 37571, 0, 0, '2017-12-20 21:05:09', '0000-00-00 00:00:00', 0, 0, 0),
(41185, 0, 0, 'Lorem ipsum dolor sitconsectetuer adipiscing elit', '1513778710-Lorem-ipsum-dolor-sitconsectetuer-adipiscing-elit', '', 'Lorem ipsum dolor sitconsectetuer adipiscing elit\r\n', '5a3a6e16e0d42.jpg', 77, 'euro', 37571, 0, 0, '2017-12-20 21:05:10', '0000-00-00 00:00:00', 0, 0, 0),
(41186, 0, 0, 'sanr pham 3', 'sanr-pham-3', 'SHort content', '<p>2412412412</p>', '5a3b3d0012e7e.png', 1412421, 'usd', 37571, 0, 0, '2017-12-21 11:48:00', '0000-00-00 00:00:00', 0, 0, 0),
(41187, 0, 0, 'Sản phẩm 4', 'San-pham-4', '4214124124124', '<p>41241241241</p>', '5a3b3d306889e.png', 1244124, 'usd', 37571, 0, 0, '2017-12-21 11:48:48', '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `f_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `s_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `address_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birth` date NOT NULL,
  `tel` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `fax` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `tax` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `web` varchar(67) COLLATE utf8_unicode_ci NOT NULL,
  `images` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `banner` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `favicon` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keyword` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_tag` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `google_site_verification` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `fb_link` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `maps` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1-> mua bán, đăng tin rao văt , 2-> shop, 3-> quảng bá doanh nghiệp',
  `date_create` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  `date_login` datetime NOT NULL,
  `level` tinyint(4) NOT NULL DEFAULT '0',
  `exp` int(10) unsigned NOT NULL DEFAULT '0',
  `coin` int(10) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `type_template` enum('user_template','custom_template','','') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user_template',
  `live_chat` tinyint(2) NOT NULL DEFAULT '1',
  `del` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=37573 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `fullname`, `f_name`, `s_name`, `email`, `address`, `address_2`, `birth`, `tel`, `phone`, `fax`, `tax`, `web`, `images`, `banner`, `favicon`, `title`, `meta_description`, `meta_keyword`, `meta_tag`, `google_site_verification`, `fb_link`, `maps`, `type`, `date_create`, `date_update`, `date_login`, `level`, `exp`, `coin`, `active`, `type_template`, `live_chat`, `del`) VALUES
(37570, 'admin', '76643a5c986cd9302d3138fadc845f20', 'Công ty TNHH Ymobile Việt Nam', '', '', 'duycaliychi@gmail.com', '39 Hoàng Bật Đạt, Phường 15, Quận Tân Bình, Thành Phố Hồ Chí Minh', '', '0000-00-00', '0934 092 477', '', '', '', 'www.ymobile.com.vn', '59c822febdb19.png', '', '', 'Phát Wifi 4G - 123', 'Phát Wifi 4G', 'Phát Wifi 4G', '', '', 'https://www.facebook.com/phatwifi/', '{"localmaps":"123 L\\u00ea Th\\u00e1nh T\\u00f4n, Ho Chi Minh City, Ho Chi Minh, Vietnam","latitude":"10.824324605255434","longitude":"106.63498365718385"}', 3, '0000-00-00 00:00:00', '2017-09-25 22:43:26', '2016-08-04 09:38:23', 1, 0, 600, 1, '', 1, 0),
(37571, 'user_1', 'ce8d186456b96bfb92d09e6d43149965', '', 'Nam', 'Lê', 'user_1@gmail.com', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0, 0, 'user_template', 1, 0),
(37572, 'tyty', '4584d75b2584727aa00d820239f12d33', '', '', '', 'tyty@fr.com', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 0, 0, 'user_template', 1, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
