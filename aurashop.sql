-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 27, 2023 lúc 12:37 PM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `aurashop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `addresscustomer`
--

CREATE TABLE `addresscustomer` (
  `idAddress` int(11) UNSIGNED NOT NULL,
  `idCustomer` int(11) UNSIGNED NOT NULL,
  `Address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PhoneNumber` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `CustomerName` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `addresscustomer`
--

INSERT INTO `addresscustomer` (`idAddress`, `idCustomer`, `Address`, `PhoneNumber`, `CustomerName`) VALUES
(1, 1, 'Xuân Khánh, Ninh Kiều Cần Thơ', '0923542102', 'Nguyễn Trà My'),
(2, 1, 'Bình Thủy, Cần Thơ', '0923542101', 'Nguyễn Hoàng Long'),
(3, 5, '123dada', '1231231231', 'adad'),
(4, 7, 'Hưng Phú, Cần Thơ', '1234567899', 'Trần Thanh Xuân'),
(5, 8, '33/2 Mậu thân Cần Thơ', '1212121212', 'Minh Anh'),
(6, 9, 'Dinh Cong Trang, Can Tho', '1515151515', 'Hung Pham'),
(7, 3, 'Ninh Kiều, Cần Thơ', '0345445689', 'Trần Ngọc Hân'),
(8, 7, 'Dinh Cong Trang, Can Tho', '1212121212', 'Trần Thanh Xuân'),
(9, 3, 'Cần Thơ', '1231231231', 'Thái Vươn Phàm'),
(10, 6, '123123123', '1231231231', '123123');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `idAdmin` int(11) UNSIGNED NOT NULL,
  `AdminName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `AdminUser` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `AdminPass` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `AdminRePass` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Position` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `NumberPhone` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`idAdmin`, `AdminName`, `AdminUser`, `AdminPass`, `AdminRePass`, `Position`, `Address`, `NumberPhone`, `Email`, `Avatar`) VALUES
(0, '', '', '', '', '', '', '', '', NULL),
(1, 'Trần Thanh Xuân', 'xuan', '202cb962ac59075b964b07152d234b70', '202cb962ac59075b964b07152d234b70', 'Quản Lý', 'Bình Thủy, Cần Thơ', '0935213520', 'xuan@gmail.com', '6168af13a0.jpg'),
(3, 'Nguyễn Gia Hy', 'hy', '25d55ad283aa400af464c76d713c07ad', '25d55ad283aa400af464c76d713c07ad', 'Quản Lý', 'Đường 30/4, Xuân Khánh, Ninh Kiều, Cần Thơ', '0935124532', 'hyb1805869@student.ctu.edu.vn', 'b66d6771bc.jpg'),
(4, 'Thái Vươn Phàm', 'pham', '4297f44b13955235245b2497399d7a93', '4297f44b13955235245b2497399d7a93', 'Quản Lý', 'Ninh Kiều, Cần Thơ', '0942513520', 'pham@gmail.com', NULL),
(6, 'nv123', 'nv123', '25d55ad283aa400af464c76d713c07ad', '25d55ad283aa400af464c76d713c07ad', 'Nhân Viên', 'Xuân Khánh, Ninh Kiều Cần Thơ', '0944022217', 'a@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill`
--

CREATE TABLE `bill` (
  `idBill` int(11) UNSIGNED NOT NULL,
  `idAdmin` int(11) UNSIGNED DEFAULT 0,
  `idCustomer` int(11) UNSIGNED NOT NULL,
  `idAddress` int(10) UNSIGNED NOT NULL,
  `OrderDate` datetime NOT NULL DEFAULT current_timestamp(),
  `ReceiveDate` datetime DEFAULT NULL,
  `Status` int(11) NOT NULL DEFAULT 0,
  `TotalBill` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Payment` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'cash'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bill`
--

INSERT INTO `bill` (`idBill`, `idAdmin`, `idCustomer`, `idAddress`, `OrderDate`, `ReceiveDate`, `Status`, `TotalBill`, `Payment`) VALUES
(11, 3, 1, 2, '2022-04-04 09:54:58', '2022-04-04 04:54:58', 99, '463000', 'cash'),
(17, 3, 1, 1, '2022-04-04 10:00:07', '2022-04-04 05:00:07', 2, '1467000', 'cash'),
(18, 1, 7, 4, '2022-04-08 07:12:28', '2022-04-08 02:12:28', 2, '682000', 'cash'),
(19, 1, 7, 4, '2022-04-08 07:12:32', '2022-04-08 02:12:32', 2, '329000', 'cash'),
(20, 1, 7, 4, '2022-04-08 07:13:52', '2022-04-08 02:13:52', 2, '386000', 'cash'),
(21, 1, 8, 5, '2022-04-08 07:19:27', '2022-04-08 02:19:27', 2, '2850000', 'cash'),
(22, 1, 8, 5, '2022-04-08 07:19:25', '2022-04-08 02:19:25', 2, '858000', 'cash'),
(23, 1, 8, 5, '2022-04-08 07:19:38', '2022-05-03 09:07:37', 2, '2890000', 'cash'),
(24, 4, 9, 6, '2022-04-21 15:09:57', '2022-05-03 10:51:36', 2, '4565000', 'cash'),
(25, 4, 7, 4, '2022-04-21 15:12:08', '2022-04-21 10:12:08', 2, '3565000', 'cash'),
(26, 4, 7, 4, '2022-04-21 15:34:53', '2022-04-21 10:34:53', 2, '1935000', 'cash'),
(27, 4, 7, 4, '2022-04-21 15:42:35', '2022-04-21 10:42:35', 2, '3225000', 'cash'),
(29, 4, 7, 4, '2022-04-21 16:07:17', '2022-04-21 11:07:17', 2, '675000', 'cash'),
(30, 1, 7, 4, '2022-04-22 10:05:17', '2022-05-06 02:27:06', 2, '2370000', 'cash'),
(32, 3, 1, 2, '2022-04-25 03:54:03', '2022-04-25 03:56:23', 2, '568000', 'cash'),
(33, 0, 1, 1, '2022-04-25 03:56:50', NULL, 99, '356000', 'cash'),
(34, 1, 7, 4, '2022-05-06 02:24:16', '2022-05-06 02:27:04', 2, '981000', 'cash'),
(35, 1, 7, 4, '2022-05-06 02:25:08', '2022-05-06 02:27:01', 2, '8612000', 'cash'),
(36, 0, 7, 4, '2022-05-06 19:15:25', NULL, 99, '514000', 'cash'),
(37, 1, 7, 4, '2022-05-07 22:51:55', '2022-05-07 23:25:11', 2, '2064000', 'cash'),
(38, 0, 7, 4, '2022-05-07 23:24:39', NULL, 99, '2600000', 'cash'),
(39, 1, 7, 8, '2022-05-08 00:13:24', '2022-05-09 20:51:11', 2, '360000', 'cash'),
(40, 1, 7, 4, '2022-05-08 00:26:04', '2022-05-09 20:51:08', 2, '616000', 'cash'),
(41, 1, 7, 4, '2022-05-09 20:33:03', '2022-05-09 20:51:06', 2, '2940000', 'cash'),
(42, 0, 3, 7, '2022-05-12 00:34:45', NULL, 99, '1041000', 'cash'),
(43, 1, 7, 8, '2022-05-14 12:35:12', '2022-05-14 12:36:35', 2, '15800000', 'cash'),
(44, 1, 7, 4, '2022-05-16 16:38:33', '2022-05-16 16:38:52', 2, '818000', 'cash'),
(45, 1, 7, 4, '2022-05-17 16:31:38', '2022-05-18 14:08:35', 2, '3870000', 'cash'),
(46, 1, 7, 4, '2022-05-17 16:32:28', '2022-05-18 14:08:32', 2, '738000', 'cash'),
(47, 4, 7, 4, '2022-05-17 18:46:40', '2022-05-18 14:08:31', 2, '719000', 'cash'),
(48, 4, 7, 4, '2022-05-17 20:20:34', '2022-05-18 14:08:29', 2, '719000', 'cash'),
(49, 4, 7, 4, '2022-05-17 20:20:49', '2022-05-18 14:08:26', 2, '2199000', 'cash'),
(50, 4, 7, 4, '2022-05-17 21:34:52', '2022-05-18 14:08:28', 2, '4650000', 'momo'),
(51, 4, 7, 4, '2022-05-18 11:11:07', '2022-05-18 14:08:23', 2, '719000', 'momo'),
(52, 4, 7, 4, '2022-05-18 11:53:14', '2022-05-18 14:08:21', 2, '719000', 'momo'),
(53, 4, 7, 4, '2022-05-18 11:59:00', '2022-05-18 14:08:20', 2, '719000', 'zalo'),
(54, 4, 7, 8, '2022-05-18 14:09:13', NULL, 1, '1378000', 'momo'),
(55, 0, 6, 10, '2022-05-18 16:24:30', NULL, 0, '2239000', 'zalo');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `billinfo`
--

CREATE TABLE `billinfo` (
  `idBill` int(11) UNSIGNED NOT NULL,
  `idProduct` int(11) UNSIGNED NOT NULL,
  `Price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `QuantityBuy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `billinfo`
--

INSERT INTO `billinfo` (`idBill`, `idProduct`, `Price`, `QuantityBuy`) VALUES
(11, 13, '433000', 1),
(17, 13, '433000', 3),
(17, 14, '168000', 1),
(18, 36, '326000', 2),
(19, 37, '299000', 1),
(20, 30, '356000', 1),
(21, 27, '2850000', 1),
(22, 9, '276000', 3),
(23, 23, '2890000', 1),
(24, 12, '230000', 1),
(24, 34, '945000', 1),
(24, 25, '3390000', 1),
(25, 34, '645000', 3),
(25, 36, '326000', 5),
(26, 34, '645000', 3),
(27, 34, '645000', 5),
(29, 34, '645000', 1),
(30, 33, '1066000', 1),
(30, 36, '326000', 4),
(32, 16, '439000', 1),
(32, 35, '99000', 1),
(33, 36, '326000', 1),
(34, 36, '326000', 2),
(34, 37, '299000', 1),
(35, 11, '7900000', 1),
(35, 30, '356000', 2),
(36, 36, '242000', 2),
(37, 34, '662000', 2),
(37, 37, '370000', 2),
(38, 28, '1300000', 2),
(39, 35, '165000', 2),
(40, 36, '293000', 2),
(41, 22, '1470000', 2),
(42, 30, '347000', 3),
(43, 11, '7900000', 2),
(44, 32, '788000', 1),
(45, 9, '385000', 2),
(45, 41, '1550000', 2),
(46, 7, '354000', 2),
(47, 40, '689000', 1),
(48, 40, '689000', 1),
(49, 42, '2199000', 1),
(50, 41, '1550000', 3),
(51, 40, '689000', 1),
(52, 40, '689000', 1),
(53, 40, '689000', 1),
(54, 40, '689000', 2),
(55, 40, '689000', 1),
(55, 41, '1550000', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blog`
--

CREATE TABLE `blog` (
  `idBlog` int(11) UNSIGNED NOT NULL,
  `idProduct` int(11) UNSIGNED NOT NULL,
  `BlogContent` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date` datetime DEFAULT NULL,
  `HideShow` tinyint(3) NOT NULL,
  `BlogDesc` text COLLATE utf8_unicode_ci NOT NULL,
  `BlogTitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `BlogImage` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `blog`
--

INSERT INTO `blog` (`idBlog`, `idProduct`, `BlogContent`, `Date`, `HideShow`, `BlogDesc`, `BlogTitle`, `BlogImage`) VALUES
(1, 7, '<p>AURA COSMETIC sale tất tần tật c&aacute;c sản phẩm chống nắng HOT HIT, nổi đ&igrave;nh nổi đ&aacute;m trong l&agrave;ng skincare như&nbsp; Laroche Posay,&nbsp; Vichy,...chỉ từ <strong>#79k, </strong>duy nhất từ ng&agrave;y 15/04 - 20/04! &Aacute;p dụng cả Online &amp; mua trực tiếp.</p>\r\n\r\n<p><img alt=\"⛅️\" src=\"https://www.facebook.com/images/emoji.php/v9/t26/1.5/16/26c5.png\" style=\"height:16px; width:16px\" /> D&ugrave; mưa hay nắng, d&ugrave; ra đường hay chỉ ở trong nh&agrave;, NHẤT QUYẾT phải c&oacute; kem chống nắng nếu kh&ocirc;ng muốn l&agrave;n da của m&igrave;nh xuất hiện th&ecirc;m nhiều đốm t&agrave;n nhang, sạm da hay ch&aacute;y nắng, thậm ch&iacute; c&ograve;n đẩy nhanh qu&aacute; tr&igrave;nh l&atilde;o h&oacute;a nha c&aacute;c chị em.</p>\r\n\r\n<p><img alt=\"⛅️\" src=\"https://www.facebook.com/images/emoji.php/v9/t26/1.5/16/26c5.png\" style=\"height:16px; width:16px\" /> C&aacute;c sản phẩm được SALE bao gồm đầy đủ c&aacute;c dạng từ Kem chống nắng, Xịt chống nắng cho đến Sữa chống nắng, Gel chống nắng<a href=\"https://www.banvoucher.online/vinpearl-ha-long\">,</a>... tha hồ cho c&aacute;c n&agrave;ng lựa chọn, ph&ugrave; hợp với những l&agrave;n da nhạy cảm nhất.</p>\r\n\r\n<p><img alt=\"?\" src=\"https://www.facebook.com/images/emoji.php/v9/taa/1.5/16/1f449.png\" style=\"height:16px; width:16px\" /> Nhanh tay ĐẶT H&Agrave;NG NGAY H&Ocirc;M NAY để chớp cơ hội V&Agrave;NG.&nbsp;</p>\r\n\r\n<p style=\"text-align:center\">&nbsp; &nbsp;&nbsp;<img alt=\"\" src=\"https://media.hasaki.vn/wysiwyg/HaNguyen/kem-chong-nang-vichy-toan-than-dang-gel-spf-50-200ml.jpg\" style=\"height:500px; width:500px\" /></p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:16px\">Th&ecirc;m một &quot;em&quot; xịt chống nắng ngon bổ rẻ đang c&oacute; gi&aacute; sale cực hấp dẫn. Nếu đ&atilde; m&ecirc; kem chống nắng n&acirc;ng&nbsp;&nbsp; t&ocirc;ng của Vichy th&igrave; bạn nhất định sẽ &quot;kết&quot; sản phẩm n&agrave;y.</span></p>\r\n\r\n<p style=\"text-align:center\"><em>&nbsp; &nbsp;<img alt=\"\" src=\"https://product.hstatic.net/1000006063/product/laroche_9dcd38809c0f4b868d64ce24e7108f47.jpg\" style=\"height:600px; width:600px\" /></em></p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:16px\">&nbsp;Ngo&agrave;i đồ trang điểm, thương hiệu La Roche Posay c&ograve;n c&oacute; kem chống nắng rất ổn. Sản phẩm&nbsp; đang được giảm 50%, n&agrave;ng n&agrave;o đang muốn d&ugrave;ng thử n&ecirc;n tranh thủ dịp sale 6/6 n&agrave;y để mua cho lợi.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2022-05-18 07:05:29', 1, '<p>AURA COSMETIC sale tất tần tật c&aacute;c sản phẩm #chống_nắng HOT HIT, nổi đ&igrave;nh nổi đ&aacute;m trong l&agrave;ng skincare như Anessa, Laroche Posay, Naruko, Cetaphil, Bioderma, Vichy,...chỉ từ #79k, duy nhất từ ng&agrave;y 15/04 - 20/04! &Aacute;p dụng cả Online &amp; mua trực tiếp.</p>\r\n', 'KHỎE - RẺ VÔ ĐỊCH SALE CHỐNG NẮNG - NGẠI GÌ NẮNG - ĐỒNG GIÁ CHỈ TỪ 79K', 'd4.png'),
(3, 7, '<h1>B&atilde;o deal giảm 70% cực khủng</h1>\r\n\r\n<h2><span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Flashsale lu&ocirc;n l&agrave; cơ hội v&agrave;ng săn để bạn h&agrave;ng &ldquo;xịn&rdquo; m&agrave; gi&aacute; lại v&ocirc; c&ugrave;ng hấp dẫn! Mỹ phẩm cao cấp từ chống nắng đến dưỡng da &ndash; Sale cực đỉnh ngay từ h&ocirc;m nay.&nbsp;Mua 1 tặng 1&nbsp;hay đồng gi&aacute;&nbsp;299K&nbsp;v&agrave; rẻ hơn thế nữa. C&ograve;n chần chờ g&igrave; m&agrave; kh&ocirc;ng xem v&agrave; mua ngay!</span></span></h2>\r\n\r\n<p style=\"text-align:center\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<img alt=\"\" src=\"https://cdn.chanhtuoi.com/uploads/2022/03/w400/771705c5cdc6e675cccada1cadb3a597-jpg-720x720q80.jpg.webp\" style=\"height:400px; width:400px\" /></p>\r\n\r\n<p><em>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </em><span style=\"font-size:16px\">&nbsp; &nbsp; &nbsp;Estee giảm s&acirc;u tới 15% Tặng k&egrave;m Voucher 10% &aacute;p dụng trực tiếp tr&ecirc;n sản phẩm</span></p>\r\n\r\n<p style=\"text-align:center\"><em>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img alt=\"\" src=\"https://product.hstatic.net/200000017272/product/3337875694469_8f654075117a46cab140fecaeb37be91_master.png\" style=\"height:600px; width:600px\" /></em></p>\r\n\r\n<p style=\"text-align:center\">&nbsp; &nbsp; &nbsp; <span style=\"font-size:16px\">&nbsp; &nbsp; &nbsp;Flash Sale Mua 1 Tặng 1, Combo ưu đ&atilde;i chỉ từ 49K &aacute;p dụng mua tại cửa h&agrave;ng AURABeauty</span></p>\r\n\r\n<p>&nbsp;</p>\r\n', '2022-05-13 07:05:30', 1, '<p>Ưu đ&atilde;i c&oacute; một kh&ocirc;ng hai tại AURA COSMETICS</p>\r\n\r\n<p>Voucher Freeship d&agrave;nh cho kh&aacute;ch h&agrave;ng th&acirc;n thiết</p>\r\n', 'SALE THƯƠNG HIỆU-GIẢM BÙNG CHÁY ĐẾN 70%', '1504_PC2.jpg'),
(4, 7, '<p style=\"text-align:center\">Đầy đủ c&aacute;c sản phẩm nằm trong c&aacute;c bước dưỡng da từ tẩy trang, sữa rửa mặt tới dưỡng ẩm, đủ để n&agrave;ng n&acirc;ng tầm nhan sắc của m&igrave;nh những ng&agrave;y h&egrave;.&nbsp;</p>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"text-align:center\">&nbsp; &nbsp; &nbsp;</p>\r\n\r\n<p style=\"text-align:center\">&nbsp;<img alt=\"\" src=\"https://product.hstatic.net/200000017272/product/3337871308612_e75d485ecc1e470b8edc1dff307439e0_master.jpg\" style=\"height:500px; width:500px\" /></p>\r\n\r\n<p style=\"text-align:center\"><em>&nbsp; &nbsp; &nbsp; &nbsp;<span style=\"font-size:16px\"> &nbsp; &nbsp; </span></em><span style=\"font-size:16px\">&nbsp;Xịt kho&aacute;ng Vichy&nbsp;cho những ng&agrave;y h&egrave; nắng n&oacute;ng khiến da kh&ocirc; sạm, th&ocirc; r&aacute;p v&agrave; thiếu nước</span></p>\r\n\r\n<p><em>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</em></p>\r\n\r\n<p><em>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<img alt=\"\" src=\"https://cf.shopee.vn/file/273e95c490fb47d3f3b3cfcb046086f0\" style=\"height:600px; width:600px\" /></em></p>\r\n\r\n<h3 style=\"text-align:center\"><span style=\"font-size:16px\">Sữa Rửa Mặt Dạng Gel Cho Da Dầu Mụn La Roche-Posay Effaclar Purifying Foaming Gel For Oily Sensitive Skin</span></h3>\r\n', '2022-05-13 07:05:43', 1, '<p>Tiếp nối h&agrave;nh tr&igrave;nh săn sale m&ugrave;a h&egrave; bất tận, AURA Cosmetics gửi đến bạn h&agrave;ng trăm #DEAL_HOT mỗi ng&agrave;y, giảm s&acirc;u chưa từng c&oacute; c&aacute;c sản phẩm đến từ: EUCERIN, VICHY, BIO ESSENCE,...&nbsp;</p>\r\n', 'HÈ RỰC RỠ SALE HẾT CỠ ', 'deals2.jpg'),
(6, 7, '<h2><strong>1. Vichy</strong></h2>\r\n\r\n<p style=\"text-align:center\"><img alt=\"\" src=\"https://product.hstatic.net/1000006063/product/1250_3f59eedcfab44201acff88c36d8c5bd6.jpg\" style=\"height:600px; width:600px\" /></p>\r\n\r\n<div style=\"text-align:justify\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:16px\"><span style=\"color:#5e5e5e\"><span style=\"background-color:#ffffff\">Vichy l&agrave; nh&atilde;n hiệu dược mỹ phẩm Ph&aacute;p được tin d&ugrave;ng tr&ecirc;n to&agrave;n thế giới ! Ngay từ khi mới th&agrave;nh lập Viện nghi&ecirc;n cứu Vichy ở Ph&aacute;p v&agrave;o năm 1931, Tiến sĩ Haller đ&atilde; ứng dụng những ti&ecirc;u chuẩn nghi&ecirc;m ngặt của y học v&agrave;o mỹ phẩm, kết hợp c&aacute;c hoạt chất ti&ecirc;n tiến với nguồn nước kho&agrave;ng Vichy diệu kỳ c&oacute; khả năng tăng cường sức sống v&agrave; l&agrave;m dịu l&agrave;n da. Với hơn 80 năm kinh nghiệm v&agrave; ph&aacute;t minh, Vichy đang mang đến cho bạn l&agrave;n da đẹp mỗi ng&agrave;y với phương ch&acirc;m l&agrave;m đẹp: &quot; L&Agrave;N DA ĐẸP L&Agrave; DA THỰC SỰ KHỎE MẠNH &quot;</span></span></span></span></div>\r\n\r\n<div style=\"text-align:justify\">&nbsp;</div>\r\n\r\n<div style=\"text-align:justify\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:16px\"><span style=\"color:#5e5e5e\"><span style=\"background-color:#ffffff\">L&agrave; thương hiệu mỹ phẩm cao cấp của Ph&aacute;p th&agrave;nh lập năm 1931, trực thuộc tập đo&agrave;n L&rsquo;Or&eacute;al, t&iacute;nh đến nay mỹ phẩm Vichy đ&atilde; c&oacute; hơn 80 năm trong lĩnh vực chăm s&oacute;c vẻ đẹp v&agrave; sức khỏe l&agrave;n da.</span></span></span></span></div>\r\n\r\n<div style=\"text-align:justify\">&nbsp;</div>\r\n\r\n<div style=\"text-align:justify\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:16px\"><span style=\"color:#5e5e5e\"><span style=\"background-color:#ffffff\"><a href=\"http://myphamvichychinhhang.blogspot.com/2017/10/gioi-thieu-ve-thuong-hieu-my-pham-vichy-cua-phap.html\" style=\"outline:0px; transition:all 0.3s ease 0s; color:#e44332; text-decoration:none\" target=\"_blank\">Thương hiệu mỹ phẩm Vichy</a>&nbsp;nổi tiếng v&agrave; đặc trưng do sử dụng nước thủy nhiệt từ c&aacute;c suối nước n&oacute;ng của thị trấn Vichy, Ph&aacute;p, l&agrave;m nguồn nước duy nhất được sử dụng trong c&aacute;c c&ocirc;ng thức l&agrave;m đẹp, trở th&agrave;nh một trong những thương hiệu lớn nhất v&agrave; được ưa chuộng nhất trong thị trường chăm s&oacute;c da ch&acirc;u &Acirc;u hiện nay.</span></span></span></span></div>\r\n\r\n<h2><strong>2. Estee Lauder</strong></h2>\r\n\r\n<p><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:16px\"><a href=\"https://c.lazada.vn/t/c.1aLN?url=https%3A%2F%2Fwww.lazada.vn%2Fshop%2Festee-lauder%3Ftab%3Dpromotion%26path%3Dpromotion-30838-0.htm&amp;sub_aff_id=Estee\" target=\"_blank\">Estee Lauder</a>&nbsp;l&agrave; thương hiệu mỹ phẩm nổi tiếng của Mỹ được th&agrave;nh lập v&agrave;o năm 1946 bởi cặp vợ chồng b&agrave; Estee Lauder v&agrave; &ocirc;ng Joseph H.Lauder. Về mỹ phẩm, Estee Lauder nổi tiếng với c&aacute;c sản phẩm dưỡng ẩm v&agrave; serum c&oacute; c&ocirc;ng hiện đại nhất, kem chống nắng rất chất lượng. Về trang điểm, Estee Lauder mang đến cho người d&ugrave;ng c&aacute;c sản phẩm như phấn nền, kem che khuyết điểm, m&aacute; hồng, phấn mắt, son m&ocirc;i&hellip;</span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"https://img.websosanh.vn/v10/users/review/images/vdan856e5c1ee/estee.jpg?compress=85\" style=\"height:550px; width:770px\" /></p>\r\n\r\n<p><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:16px\">Duy nhất 3.3-5.3 Tặng bộ chăm s&oacute;c da 5 m&oacute;n trị gi&aacute; 3370k + Son Pure Color Envy full size trị gi&aacute; 950k khi mua Serum chống l&atilde;o h&oacute;a Advanced Night Repair 50ml trị gi&aacute; 3450k.</span></span></p>\r\n\r\n<ul>\r\n	<li><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:16px\">Thanh to&aacute;n 0-2h2.3.3&nbsp;1 tặng th&ecirc;m Tinh chất Reset 630k.</span></span></li>\r\n	<li><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:16px\">8-12h 3.3&nbsp;tặng Tinh chất dưỡng trắng Probright 560k.</span></span></li>\r\n	<li><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:16px\">12-14h 3.3&nbsp;tặng Kem dưỡng trắng Supreme Bright trị gi&aacute; 460k.</span></span></li>\r\n	<li><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:16px\">20-24h 3.3&nbsp;tặng Tinh chất Reset 630k.&nbsp;</span></span></li>\r\n	<li><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:16px\">0-9h 4.3&nbsp;tặng Sữa dưỡng trắng Pro Bright trị gi&aacute; 300k</span></span></li>\r\n	<li><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:16px\">10-14h tặng Son Mini trị gi&aacute; 460k, 20-24h tặng Kem dưỡng trắng Supreme Bright trị gi&aacute; 460k.&nbsp;</span></span></li>\r\n	<li><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:16px\">0-9h 5.3&nbsp;tặng Kem dưỡng ẩm Supreme trị gi&aacute; 280k.</span></span></li>\r\n	<li><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:16px\">10-14h tặng Kem nền Double wear trị gi&aacute; 340k.</span></span></li>\r\n	<li><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:16px\">20-24h 5.3&nbsp;tặng Tinh chất Reset trị gi&aacute; 630k.&nbsp;</span></span></li>\r\n	<li><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:16px\">Bồ Qu&agrave; tặng chăm da &amp; Make up Phi&ecirc;n bản giới hạn với Hộp qu&agrave; sang trọng lấy cảm hứng từ b&aacute;nh kẹo m&ugrave;a lễ hội, tiết kiệm đến 70%.</span></span></li>\r\n</ul>\r\n', '2022-05-13 07:05:37', 1, '<p>Freeship to&agrave;n quốc từ 169k Bữa tiệc si&ecirc;u sale th&aacute;ng 3 ch&iacute;nh thức bắt đầu từ 3.3-5/3</p>\r\n\r\n<p>C&ugrave;ng h&agrave;ng loạt c&aacute;c gương mặt &quot;AURA&nbsp;Best Seller&quot; từ c&aacute;c nh&atilde;n h&agrave;ng đ&igrave;nh đ&aacute;m kh&aacute;c như: Christian Lenart, Vacosi, Dr.Nuell, Jonzac, Peripera, Lanc&ocirc;me</p>\r\n', 'ƯU ĐÃI THÁNG 3 - BAO LA DEAL CHẤT ', 'd6.jpg'),
(8, 7, '<p><big>1.&nbsp;Sữa Rửa Mặt Tạo Bọt Ngừa Mụn &amp; L&agrave;m Sạch S&acirc;u Vichy Normaderm Anti-Imperfection Deep Cleansing Foaming Cream 125ml</big></p>\r\n\r\n<p>- Giảm 15% nay chỉ c&ograve;n 375,000đ</p>\r\n\r\n<p><strong>- Sữa Rửa Mặt Tạo Bọt Ngừa Mụn &amp; L&agrave;m Sạch S&acirc;u Vichy Normaderm Anti-Imperfection Deep Cleansing Foaming Cream 125ml&nbsp;</strong>từ&nbsp;<strong><a href=\"https://demonl.000webhostapp.com/NienLuanN5/Aura-Store/shop-single.php?idProduct=36\">thương hiệu dược mỹ phẩm Vichy</a>&nbsp;</strong>gi&uacute;p loại bỏ to&agrave;n bộ bụi bẩn, tế b&agrave;o chết v&agrave; b&atilde; nhờn tồn đọng s&acirc;u trong lỗ ch&acirc;n l&ocirc;ng, l&agrave;m giảm v&agrave; ngăn ngừa mụn hiệu quả, mang lại cho bạn l&agrave;n da sạch tho&aacute;ng v&agrave; thanh khiết.</p>\r\n\r\n<p style=\"text-align:center\"><img alt=\"\" src=\"https://media.hasaki.vn/wysiwyg/HaNguyen/sua-rua-mat-vichy-ngua-mun-se-lo-chan-long-125ml-2.jpg\" style=\"height:400px; width:400px\" /></p>\r\n\r\n<p>2.&nbsp;Sữa Rửa Mặt Đất S&eacute;t L&agrave;m Sạch S&acirc;u VICHY Normaderm Phytosolution Volcanic Mattifying Cleansing Cream 125ml</p>\r\n\r\n<p>- Giảm 30% nay chỉ c&ograve;n 375,000đ</p>\r\n\r\n<p><strong>- Sữa Rửa Mặt Đất S&eacute;t L&agrave;m Sạch S&acirc;u VICHY Normaderm Phytosolution Volcanic Mattifying Cleansing</strong>&nbsp;<strong>Cream&nbsp;</strong>l&agrave;<strong>&nbsp;&nbsp;<a href=\"https://demonl.000webhostapp.com/NienLuanN5/Aura-Store/shop-single.php?idProduct=21\">sữa rửa mặt</a>&nbsp;</strong>&nbsp;với th&agrave;nh phần ch&iacute;nh bao gồm đất s&eacute;t, đ&aacute; kho&aacute;ng n&uacute;i lửa v&agrave; than hoạt t&iacute;nh gi&uacute;p l&agrave;m sạch s&acirc;u bụi bẩn, b&atilde; nhờn v&agrave; kiểm so&aacute;t dầu thừa hiệu quả&nbsp;&nbsp;thuộc thương hiệu dược mỹ phẩm&nbsp;<a href=\"https://thegioiskinfood.com/collections/Vichy\"><strong>Vichy</strong></a>&nbsp;đến&nbsp;từ Ph&aacute;p</p>\r\n\r\n<p style=\"text-align:center\"><img alt=\"\" src=\"https://product.hstatic.net/1000006063/product/26_copy_59e5fdc182f14f55addfd5c69b315f5d_1024x1024.png\" style=\"height:500px; width:500px\" /></p>\r\n', '2022-05-16 11:05:33', 1, '<p>Sữa rửa mặt Vichy cho da dầu giảm 15%</p>\r\n\r\n<p>Serum trị th&acirc;m n&aacute;m La Roche Posay giảm đến 30% v&agrave; nhiều ưu đ&atilde;i kh&aacute;c đến từ AURA. Freeship với h&oacute;a đơn tr&ecirc;n 1,000,000đ</p>\r\n', '[SIÊU SALE  THÁNG 5] SỮA RỬA MẶT TẠI AURA COSMETIC', '8601-CVS-Vichy-LRP-CeraVe-Easel-Card.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brand`
--

CREATE TABLE `brand` (
  `idBrand` int(11) UNSIGNED NOT NULL,
  `BrandName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `BrandAddress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `BrandPhone` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `brand`
--

INSERT INTO `brand` (`idBrand`, `BrandName`, `BrandAddress`, `BrandPhone`) VALUES
(7, 'Vichy', '10', '953521522'),
(11, 'La Roche Posay', 'Cần Thơ', '1234567899'),
(12, 'Estee Lauder', 'Cần Thơ', '1234567899'),
(13, 'Lancome', 'Cần Thơ', '1234567899');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `idCart` int(11) UNSIGNED NOT NULL,
  `idCustomer` int(11) UNSIGNED NOT NULL,
  `idProduct` int(11) UNSIGNED NOT NULL,
  `Price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `QuantityBuy` int(11) NOT NULL,
  `Total` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`idCart`, `idCustomer`, `idProduct`, `Price`, `QuantityBuy`, `Total`) VALUES
(72, 1, 35, '165000', 4, '660000'),
(81, 3, 34, '662000', 1, '662000'),
(83, 1, 32, '788000', 4, '3152000'),
(93, 10, 40, '689000', 1, '689000'),
(97, 7, 9, '385000', 1, '385000');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `idCategory` int(11) UNSIGNED NOT NULL,
  `CategoryName` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`idCategory`, `CategoryName`) VALUES
(3, 'Chống nắng'),
(4, 'Sữa rửa mặt'),
(7, 'Tẩy trang'),
(8, 'Toner'),
(9, 'Xịt khoáng'),
(10, 'Kem dưỡng ẩm'),
(11, 'Kem trị mụn'),
(13, 'Serum'),
(14, 'Bộ Sản Phẩm');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `compare`
--

CREATE TABLE `compare` (
  `id` int(11) NOT NULL,
  `idCustomer` int(11) UNSIGNED NOT NULL,
  `idProduct` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `compare`
--

INSERT INTO `compare` (`id`, `idCustomer`, `idProduct`) VALUES
(5, 3, 36),
(12, 1, 36),
(13, 1, 37),
(21, 3, 34),
(22, 3, 30),
(23, 1, 41);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `idCustomer` int(11) UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `repassword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PhoneNumber` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CustomerName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Avatar` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`idCustomer`, `username`, `password`, `repassword`, `PhoneNumber`, `CustomerName`, `Avatar`) VALUES
(1, 'b1805869', '25d55ad283aa400af464c76d713c07ad', '25d55ad283aa400af464c76d713c07ad', '0944022217', 'Nguyễn Gia Hy', '884d6f6af3.jpg'),
(3, 'testusr', '25d55ad283aa400af464c76d713c07ad', '25d55ad283aa400af464c76d713c07ad', NULL, NULL, NULL),
(4, 'xuan0103', '626a38c75c17981ff3d89e0917c1c542', '626a38c75c17981ff3d89e0917c1c542', NULL, NULL, NULL),
(5, 'phamne123', '0aff9773c2ddc624cf08e2c01e63541c', '0aff9773c2ddc624cf08e2c01e63541c', NULL, NULL, NULL),
(6, 'nguyengiahy', '25d55ad283aa400af464c76d713c07ad', '25d55ad283aa400af464c76d713c07ad', NULL, NULL, NULL),
(7, 'thanhxuan', '91223d888d7b98ef1abf57358efbfedc', '91223d888d7b98ef1abf57358efbfedc', '0378069348', 'Trần Thanh Xuân', 'b13647e2ec.jpg'),
(8, 'minhanh', '91223d888d7b98ef1abf57358efbfedc', '91223d888d7b98ef1abf57358efbfedc', '1212121212', 'Minh Anh', NULL),
(9, 'hungpham', '91223d888d7b98ef1abf57358efbfedc', '91223d888d7b98ef1abf57358efbfedc', '1414141414', 'Hung Pham', NULL),
(10, 'phamm', 'f5bb0c8de146c67b44babbf4e6584cc0', 'f5bb0c8de146c67b44babbf4e6584cc0', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `idProduct` int(11) UNSIGNED NOT NULL,
  `idCategory` int(11) UNSIGNED NOT NULL,
  `idBrand` int(11) UNSIGNED NOT NULL,
  `Quantity` int(11) NOT NULL,
  `ProductName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `DesProduct` text COLLATE utf8_unicode_ci NOT NULL,
  `ShortDes_Pro` text COLLATE utf8_unicode_ci NOT NULL,
  `Price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Date_Add` datetime NOT NULL,
  `Sold` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`idProduct`, `idCategory`, `idBrand`, `Quantity`, `ProductName`, `DesProduct`, `ShortDes_Pro`, `Price`, `Date_Add`, `Sold`) VALUES
(7, 3, 7, 8, 'Kem Chống Nắng Kiềm Dầu Chống Ô Nhiễm Và Bụi Mịn Vichy Capital Soleil Mattifying 3-In-1 SPF50+ 50ml', '<p>Kem Chống Nắng Kiềm Dầu Chống &Ocirc; Nhiễm V&agrave; Bụi Mịn Vichy Capital Soleil Mattifying 3-In-1 SPF50+ l&agrave; kem chống nắng với c&ocirc;ng nghệ m&agrave;ng lọc Mexoryl độc quyền c&ugrave;ng th&agrave;nh phần ch&iacute;nh từ đất s&eacute;t xanh, men vi sinh v&agrave; nước kho&aacute;ng n&uacute;i lửa Vichy kết hợp c&ugrave;ng c&ocirc;ng nghệ thấm h&uacute;t dầu mới gi&uacute;p kiểm so&aacute;t dầu hiệu quả gi&uacute;p bảo vệ v&agrave; nu&ocirc;i dưỡng l&agrave;n da hiệu quả trước t&aacute;c nh&acirc;n &ocirc; nhiễm b&ecirc;n ngo&agrave;i thuộc thương hiệu dược mỹ phẩm Vichy đến từ Ph&aacute;p.</p>\r\n\r\n<p>&bull; Đặc trưng:</p>\r\n\r\n<p>- Kem Chống Nắng Kiềm Dầu Chống &Ocirc; Nhiễm V&agrave; Bụi Mịn Vichy Capital Soleil Mattifying 3-In-1 SPF50+ hiện nay sản phẩm đ&atilde; c&oacute; mặt tại Thế Giới Skinfood l&agrave; kem chống nắng h&oacute;a học lai vật l&yacute; với m&agrave;ng lọc chống tia UVA/UVB phổ rộng gi&uacute;p phản xạ lại c&aacute;c tia UV, h&igrave;nh th&agrave;nh &quot;lớp chắn&quot; v&ocirc; h&igrave;nh bảo vệ da, đồng thời hấp thụ bức xạ v&agrave; ph&acirc;n hủy ch&uacute;ng th&agrave;nh dạng nhiệt năng.</p>\r\n', 'Kem Chống Nắng Kiềm Dầu Chống Ô Nhiễm Và Bụi Mịn Vichy Capital Soleil Mattifying 3-In-1 SPF50+ là kem chống nắng với công nghệ màng lọc Mexoryl độc quyền cùng thành phần chính từ đất sét xanh, men vi sinh và nước khoáng núi lửa Vichy kết hợp cùng công nghệ thấm hút dầu mới giúp kiểm soát dầu hiệu quả giúp bảo vệ và nuôi dưỡng làn da hiệu quả trước tác nhân ô nhiễm bên ngoài thuộc thương hiệu dược mỹ phẩm Vichy đến từ Pháp.', '505000', '2022-03-25 06:53:58', 2),
(9, 4, 11, 6, '[200ml] Sữa Rửa Mặt Dạng Gel Cho Da Dầu Mụn La Roche-Posay Effaclar Purifying Foaming Gel For Oily Sensitive Skin', '<p>- Sữa Rửa Mặt Dạng Gel Cho Da Dầu Mụn La Roche-Posay Effaclar Purifying Foaming Gel For Oily Sensitive Skin hiện tại đ&atilde; c&oacute; mặt tại Thế Giới Skinfood c&oacute; công thức được lựa chọn kĩ càng với các thành phần làm sạch dịu nhẹ phù hợp cho da dầu v&agrave; da mụn nhạy cảm. Nhẹ nh&agrave;ng l&agrave;m sạch tạp chất v&agrave; b&atilde; nhờn dư thừa. Giảm khả năng h&igrave;nh th&agrave;nh mụn đầu đen v&agrave; giảm b&oacute;ng nhờn hiệu quả, mang lại l&agrave;n da sạch tho&aacute;ng</p>\r\n\r\n<p>- Chứa th&agrave;nh phần Zinc Pidolate l&agrave; chất c&oacute; khả năng kiềm dầu, giảm b&oacute;ng nhờn, c&acirc;n bằng độ ẩm cho da gi&uacute;p da lu&ocirc;n th&ocirc;ng tho&aacute;ng.</p>\r\n\r\n<p>- Chứa nước kho&aacute;ng La Roche-Posay - nguồn năng lượng của thi&ecirc;n nhi&ecirc;n với c&aacute;c kho&aacute;ng chất v&agrave; nguy&ecirc;n tố vi lượng gồm c&aacute;c th&agrave;nh phần thiết yếu nu&ocirc;i dưỡng l&agrave;n da như gi&agrave;u h&agrave;m lượng Selenium tự nhi&ecirc;n c&oacute; khả năng chống oxy h&oacute;a mạnh mẽ, lập tức l&agrave;m dịu da v&agrave; giảm k&iacute;ch ứng.Ngo&agrave;i ra c&ograve;n gi&uacute;p l&agrave;m dịu v&agrave; giảm bớt c&aacute;c triệu chứng của c&aacute;c bệnh nh&acirc;n vi&ecirc;m da cơ địa v&agrave; vẩy nến</p>\r\n\r\n<p>- Được c&aacute;c chuy&ecirc;n gia da liễu tr&ecirc;n to&agrave;n thế giới khuy&ecirc;n d&ugrave;ng. Kết cấu dạng gel gi&uacute;p l&agrave;m sạch da với cảm gi&aacute;c tươi m&aacute;t, dễ chịu cho da sau khi sử dụng</p>\r\n\r\n<p>&bull; Đối tượng khuy&ecirc;n d&ugrave;ng:</p>\r\n\r\n<p>- D&agrave;nh cho da dầu v&agrave; hỗn hợp thi&ecirc;n dầu</p>\r\n\r\n<p>- D&agrave;nh cho những l&agrave;n da c&oacute; tuyến nhờn hoạt động qu&aacute; độ da mụn v&agrave; da nhạy cảm</p>\r\n\r\n<p>- D&agrave;nh cho những l&agrave;n da thường xuy&ecirc;n bị k&iacute;ch th&iacute;ch do những t&aacute;c động b&ecirc;n ngo&agrave;i</p>\r\n\r\n<p>&bull; Hướng dẫn sử dụng: Làm &acirc;̉m da với nước &acirc;́m, cho một lượng vừa đủ sản ph&acirc;̉m ra tay, tạo bọt, thoa sản ph&acirc;̉m lên mặt, tránh vùng da quanh mắt. Massage nhẹ nhàng, sau đó rửa sạch lại với nước và thấm khô.</p>\r\n', 'Sữa Rửa Mặt Dạng Gel Cho Da Dầu Mụn La Roche-Posay Effaclar Purifying Foaming Gel For Oily Sensitive Skin hiện tại đã có mặt tại Thế Giới Skinfood có công thức được lựa chọn kĩ càng với các thành phần làm sạch dịu nhẹ phù hợp cho da dầu và da mụn nhạy cảm. Nhẹ nhàng làm sạch tạp chất và bã nhờn dư thừa. Giảm khả năng hình thành mụn đầu đen và giảm bóng nhờn hiệu quả, mang lại làn da sạch thoáng', '385000', '2022-03-25 08:29:16', 5),
(10, 10, 12, 5, 'Kem dưỡng trắng và chống lão hóa Revitalizing Supreme+ Bright Power Soft Crème - Moisturizer 50ml', '<p>Estee Lauder Revitalizing Supreme + Bright Power Soft Cr&egrave;me</p>\r\n\r\n<p>➡️ Sự b&ugrave;ng nổ sản sinh kh&ocirc;ng kiểm so&aacute;t của Melanin (Hắc Sắc Tố) đến từ tia UV &aacute;nh nắng mặt trời, ch&iacute;nh l&agrave; nguy&ecirc;n nh&acirc;n ch&iacute;nh g&oacute;p phần h&igrave;nh th&agrave;nh c&aacute;c đốm n&acirc;u, sạm m&agrave;u, theo thời gian h&igrave;nh th&agrave;nh c&aacute;c v&ugrave;ng da kh&ocirc;ng đều m&agrave;u thấy r&otilde; được bằng mắt tr&ecirc;n khắp bề mặt da.</p>\r\n\r\n<p>➡️ Ch&iacute;nh v&igrave; thế, n&agrave;ng cần sắm ngay cho m&igrave;nh một em kem dưỡng trắng &amp; chống l&atilde;o h&oacute;a đa t&aacute;c động Supreme Bright Soft Creme - sự kết hợp ho&agrave;n hảo giữa c&ocirc;ng nghệ l&agrave;m s&aacute;ng da mạnh mẽ &amp; chống l&atilde;o h&oacute;a to&agrave;n diện chỉ sau 14 ng&agrave;y.</p>\r\n\r\n<p>➡️ Ngo&agrave;i khả năng kho&aacute; ẩm, em kem dưỡng Revitalizing Supreme+ Bright c&ograve;n c&oacute; nhiều nhiệm vụ hơn thế:</p>\r\n\r\n<p>◼️ L&agrave;m s&aacute;ng, đều m&agrave;u da, ngăn chặn t&igrave;nh trạng rối loạn sắc tố. ◼️ Cải thiện độ săn chắc, gi&uacute;p da dần hồi, căng mướt. ◼️ Củng cố h&agrave;ng r&agrave;o độ ẩm tự nhi&ecirc;n, gi&uacute;p da khoẻ mạnh, hạn chế sự h&igrave;nh th&agrave;nh c&aacute;c nếp nhăn mới.</p>\r\n\r\n<p>➡️ TH&Agrave;NH PHẦN: ◼️ Chiết xuất qu&yacute; hiếm từ hạt Moringa (C&acirc;y Ch&ugrave;m Ng&acirc;y), kết hợp c&ugrave;ng c&ocirc;ng nghệ RevitaKeyTM, gi&uacute;p k&iacute;ch hoạt 200 chức năng chống l&atilde;o ho&aacute;, từ đ&oacute; sản sinh collagen v&agrave; elastin mạnh mẽ, l&agrave;n da dần săn chắc v&agrave; căng mượt đ&aacute;ng kể. C&acirc;y ch&ugrave;m ng&acirc;y, yếu tố nổi tiếng trong việc cải thiện độ săn chắc, đ&agrave;n hồi, giảm nhăn v&agrave; ngăn ngừa t&igrave;nh trạng l&atilde;o ho&aacute; tr&ecirc;n da.</p>\r\n', 'Estee Lauder Revitalizing Supreme + Bright Power Soft Crème Chiết xuất quý hiếm từ hạt Moringa (Cây Chùm Ngây), kết hợp cùng công nghệ RevitaKeyTM, giúp kích hoạt 200 chức năng chống lão hoá, từ đó sản sinh collagen và elastin mạnh mẽ, làn da dần săn chắc và căng mượt đáng kể. Cây chùm ngây, yếu tố nổi tiếng trong việc cải thiện độ săn chắc, đàn hồi, giảm nhăn và ngăn ngừa tình trạng lão hoá trên da.', '6000000', '2022-03-25 08:39:46', 0),
(11, 10, 13, 2, 'ABSOLUE RICH CREAM WITH GRAND ROSE EXTRACTS', '<p>Kem dưỡng chuy&ecirc;n s&acirc;u Absolue mới, chiết xuất từ phức hợp Hoa hồng thượng hạng, gi&uacute;p t&aacute;i tạo da chỉ sau 3 tuần sử dụng. Lanc&ocirc;me lưu giữ trọn vẹn sức mạnh t&aacute;i tạo của Hoa hồng: nhờ v&agrave;o quy tr&igrave;nh chiết xuất tinh tế, tạo ra dưỡng chất độc quyền từ phức hợp Hoa hồng thượng hạng v&agrave; đưa v&agrave;o d&ograve;ng sản phẩm chăm s&oacute;c da biểu tượng của Lanc&ocirc;me &ndash; Absolue.</p>\r\n', 'Kem dưỡng chuyên sâu Absolue mới, chiết xuất từ phức hợp Hoa hồng thượng hạng, giúp tái tạo da chỉ sau 3 tuần sử dụng. Lancôme lưu giữ trọn vẹn sức mạnh tái tạo của Hoa hồng: nhờ vào quy trình chiết xuất tinh tế, tạo ra dưỡng chất độc quyền từ phức hợp Hoa hồng thượng hạng và đưa vào dòng sản phẩm chăm sóc da biểu tượng của Lancôme – Absolue.', '7900000', '2022-03-25 08:45:05', 3),
(12, 9, 11, 39, 'Nước Khoáng Làm Sạch Và Dịu Da La Roche-Posay Serozinc', '<p>- Nước Kho&aacute;ng L&agrave;m Sạch V&agrave; Dịu Da La Roche-Posay Serozinc hiện đ&atilde; c&oacute; mặt tại Thế Giới Skinfood với c&aacute;c giọt nước si&ecirc;u nhỏ thẩm thấu s&acirc;u v&agrave;o da cho hiệu quả l&agrave;m dịu tức th&igrave;, giảm k&iacute;ch ứng v&agrave; bảo vệ da.</p>\r\n\r\n<p>-Chứa Zinc Sulfate với khả năng miễn dịch, tổng hợp protein, tổng hợp DNA , l&agrave;m l&agrave;nh vết thương v&agrave; kh&aacute;ng vi&ecirc;m, điều n&agrave;y c&oacute; thể gi&uacute;p l&agrave;m giảm một số mẩn đỏ v&agrave; k&iacute;ch ứng li&ecirc;n quan đến c&aacute;c t&igrave;nh trạng mụn, hỗ trợ điều trị c&aacute;c vết sẹo do mụn để lại. Kẽm cũng c&oacute; khả năng hỗ trợ điều trị c&aacute;c t&igrave;nh trạng vi&ecirc;m da kh&aacute;c như: n&aacute;m, bệnh rosacea, vi&ecirc;m da tiết b&atilde;, eczema. - Chứa nước kho&aacute;ng La Roche-Posay</p>\r\n\r\n<p>- nguồn năng lượng của thi&ecirc;n nhi&ecirc;n một sự kết hợp đặc biệt giữa kho&aacute;ng chất v&agrave; nguy&ecirc;n tố vi lượng gồm c&aacute;c th&agrave;nh phần thiết yếu nu&ocirc;i dưỡng l&agrave;n da như gi&agrave;u h&agrave;m lượng Selenium &amp; Oligo-Elenment c&oacute; khả năng chống oxy h&oacute;a mạnh mẽ, lập tức l&agrave;m dịu da v&agrave; giảm k&iacute;ch ứng.</p>\r\n\r\n<p>- Được c&aacute;c chuy&ecirc;n gia da liễu tr&ecirc;n to&agrave;n thế giới khuy&ecirc;n d&ugrave;ng. L&agrave;n da sẽ nhanh ch&oacute;ng cảm nhận được sự tươi m&aacute;t v&agrave; dịu nhẹ của nước kho&aacute;ng ngay khi sử dụng</p>\r\n\r\n<p>&bull; Đối tượng khuy&ecirc;n d&ugrave;ng:</p>\r\n\r\n<p>- D&agrave;nh cho mọi loại da</p>\r\n\r\n<p>- D&agrave;nh cho l&agrave;n da dầu, tiết nhiều b&atilde; nhờn, da đang k&iacute;ch ứng cần l&agrave;m dịu tức thời,da dầu mụn</p>\r\n\r\n<p>&bull; Hướng dẫn sử dụng: Để b&igrave;nh xịt c&aacute;ch xa mặt khoảng 20cm v&agrave; xịt đều xung quanh bề mặt da</p>\r\n\r\n<p>- Ngay sau khi rửa mặt gi&uacute;p h&igrave;nh th&agrave;nh ngay lớp m&agrave;ng dưỡng ẩm v&agrave; cấp nước nhanh ch&oacute;ng cho da - Trước khi trang điểm gi&uacute;p da mềm mại, đủ ẩm để c&oacute; lớp nền căng b&oacute;ng v&agrave; mịn m&agrave;ng hơn</p>\r\n\r\n<p>- Ngay sau khi trang điểm gi&uacute;p giữ được độ tươi mới cho lớp nền rạng rỡ</p>\r\n\r\n<p>- Khi lớp trang điểm bị kh&ocirc; v&agrave; sần x&ugrave;i gi&uacute;p lớp nền trở n&ecirc;n ẩm mịn, mịn m&agrave;ng, tươi mới trở lại</p>\r\n', 'Nước Khoáng Làm Sạch Và Dịu Da La Roche-Posay Serozinc hiện đã có mặt tại Thế Giới Skinfood với các giọt nước siêu nhỏ thẩm thấu sâu vào da cho hiệu quả làm dịu tức thì, giảm kích ứng và bảo vệ da.', '230000', '2022-03-25 08:49:31', 1),
(13, 13, 7, 7, '[30ml] Dưỡng Chất Khoáng Cô Đặc Vichy Mineral 89 Serum', '<p>- Dưỡng Chất Kho&aacute;ng C&ocirc; Đặc Vichy Mineral 89 Serum hiện đ&atilde; c&oacute; mặt tại Thế Giới Skinfood đ&atilde; được 175 b&aacute;c sĩ da liễu thử nghiệm tr&ecirc;n 1600 phụ nữ tr&ecirc;n to&agrave;n thế giới. An to&agrave;n v&agrave; hiệu quả cho mọi loại da chỉ với một c&ocirc;ng thức tối giản: 11 th&agrave;nh phần v&agrave; kh&ocirc;ng m&ugrave;i hương.</p>\r\n\r\n<p>- 89% th&agrave;nh phần của Vichy Mineral 89 Serum l&agrave; nước kho&aacute;ng Vichy. C&ocirc;ng thức gi&agrave;u nước kho&aacute;ng n&uacute;i lửa Vichy gi&uacute;p cấp nước, l&agrave;m dịu da tức th&igrave;, chống oxy h&oacute;a - bảo vệ da trước t&aacute;c động của gốc tự do trong &aacute;nh nắng, củng cố &amp; phục hồi h&agrave;ng r&agrave;o bảo vệ da.</p>\r\n\r\n<p>- Chứa Hyaluronic Acid c&oacute; nguồn gốc tự nhi&ecirc;n với khả năng cấp nước v&agrave; giữ nước hơn 1.000 lần trọng lượng của n&oacute; trong nước để gi&uacute;p hydrat h&oacute;a v&agrave; l&agrave;m đầy đặn l&agrave;n da hiệu quả</p>\r\n\r\n<p>- Th&agrave;nh phần Glycerin c&oacute; cơ chế hoạt động l&agrave; hấp thụ nước từ m&ocirc;i trường b&ecirc;n ngo&agrave;i gi&uacute;p cung cấp độ ẩm cần thiết một c&aacute;ch tự nhi&ecirc;n, tạo một lớp m&agrave;ng bảo vệ da, hạn chế sự tho&aacute;t hơi nước tr&ecirc;n bề mặt da, khiến da kh&ocirc;ng bị kh&ocirc;, mất hơi nước, lu&ocirc;n duy tr&igrave; độ ẩm cho da khiến da lu&ocirc;n được mịn m&agrave;ng.</p>\r\n', 'Dưỡng Chất Khoáng Cô Đặc Vichy Mineral 89 Serum hiện đã có mặt tại Thế Giới Skinfood đã được 175 bác sĩ da liễu thử nghiệm trên 1600 phụ nữ trên toàn thế giới. An toàn và hiệu quả cho mọi loại da chỉ với một công thức tối giản: 11 thành phần và không mùi hương.', '650000', '2022-03-25 08:53:11', 4),
(14, 11, 11, 43, 'Tinh Chất La Roche-Posay Giảm Mụn 3 Tác Động 30ml Effaclar Serum', '<h2><span style=\"font-family:Times New Roman,Times,serif\"><strong>Loại da ph&ugrave; hợp:</strong></span></h2>\r\n\r\n<ul>\r\n	<li>Sản phẩm ph&ugrave; hợp cho da dầu, da mụn.</li>\r\n</ul>\r\n\r\n<h2><span style=\"font-family:Times New Roman,Times,serif\"><strong>Giải ph&aacute;p cho t&igrave;nh trạng da:</strong></span></h2>\r\n\r\n<ul>\r\n	<li>Mụn sưng vi&ecirc;m / mụn kh&ocirc;ng sưng vi&ecirc;m.</li>\r\n</ul>\r\n\r\n<h2><span style=\"font-family:Times New Roman,Times,serif\"><strong>Ưu thế nổi bật:</strong></span></h2>\r\n\r\n<ul>\r\n	<li>Chứa phức hợp 3 loại axit chuy&ecirc;n s&acirc;u&nbsp;<strong>LHA, Salicylic Acid, Glycolic Acid&nbsp;</strong>gi&uacute;p loại bỏ tế b&agrave;o chết, giải ph&oacute;ng lỗ ch&acirc;n l&ocirc;ng bị tắc nghẽn v&agrave; tạo điều kiện thuận lợi cho tuyến b&atilde; nhờn được lưu th&ocirc;ng, đồng thời kh&aacute;ng khuẩn, kh&aacute;ng vi&ecirc;m, hỗ trợ l&agrave;m giảm v&agrave; ngăn ngừa mụn.</li>\r\n	<li>\r\n	<p><strong>Niacinamide</strong>&nbsp;gi&uacute;p củng cố h&agrave;ng r&agrave;o bảo vệ da, ngăn ngừa hiện tượng mất độ ẩm v&agrave; mất nước, ngo&agrave;i ra c&ograve;n gi&uacute;p l&agrave;m giảm khả năng tăng sắc tố da sau vi&ecirc;m,&nbsp;giảm th&acirc;m mụn v&agrave; hỗ trợ thu nhỏ lỗ ch&acirc;n l&ocirc;ng.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Nước kho&aacute;ng La Roche-Posay</strong>&nbsp;gi&uacute;p l&agrave;m dịu da, giảm k&iacute;ch ứng.</p>\r\n	</li>\r\n	<li>\r\n	<p>Sản phẩm với kết cấu serum mỏng nhẹ, thẩm thấu nhanh, mang lại cảm gi&aacute;c thoải m&aacute;i.</p>\r\n	</li>\r\n</ul>\r\n\r\n<h2>Hiệu quả:</h2>\r\n\r\n<ul>\r\n	<li>\r\n	<p>Hiệu quả được kiểm nghiệm l&acirc;m s&agrave;ng cho thấy 83% người d&ugrave;ng cảm thấy l&agrave;m da được cải thiện chỉ sau 1 đ&ecirc;m sử dụng Effaclar Serum*.</p>\r\n	</li>\r\n	<li>\r\n	<p>Sau 28 ng&agrave;y sử dụng:</p>\r\n\r\n	<ul>\r\n		<li>-21% mụn kh&ocirc;ng sưng vi&ecirc;m</li>\r\n		<li>-49% kh&ocirc;ng th&acirc;m mụn</li>\r\n		<li>-45% mụn sưng vi&ecirc;m</li>\r\n	</ul>\r\n	</li>\r\n</ul>\r\n\r\n<p><em>*Nghi&ecirc;n cứu tr&ecirc;n 63 phụ nữ từ 18-50 tuổi sử dụng sản phẩm.</em></p>\r\n', 'Tinh Chất La Roche-Posay Effaclar Serum là sản phẩm serum chuyên biệt dành cho da mụn trưởng thành mới ra mắt từ thương hiệu dược mỹ phẩm La Roche-Posay, với công thức chứa tổ hợp 3 acid LHA, Salicylic Acid, Glycolic Acid và Niacinamide, nước khoáng La Roche-Posay sẽ giúp kháng khuẩn, làm dịu da và giảm sưng mụn hiệu quả, đồng thời cải thiện kết cấu cho bề mặt da láng mịn, ngăn sự hình thành thâm mụn cho da đều màu hơn.\r\n\r\n', '240000', '2022-03-27 03:10:17', 1),
(15, 10, 11, 200, 'Kem dưỡng giúp làm dịu, làm mượt, làm mát & phục hồi da phù hợp cho trẻ em La Roche-Posay Cicaplast Baume B5 40ml', '<p>Kem dưỡng gi&uacute;p l&agrave;m dịu, l&agrave;m mượt, l&agrave;m m&aacute;t &amp; phục hồi da ph&ugrave; hợp cho trẻ em La Roche-Posay Cicaplast Baume B5 40ml kh&ocirc;ng chỉ gi&uacute;p dưỡng ẩm m&agrave; c&ograve;n giảm thiểu r&otilde; rệt c&aacute;c dấu hiệu của sự k&iacute;ch ứng tr&ecirc;n những v&ugrave;ng da bị tổn thương v&agrave; phục hồi l&agrave;n da. Sản phẩm được khuy&ecirc;n d&ugrave;ng sau c&aacute;c liệu tr&igrave;nh điều t.rị thẩm mỹ &amp; k&iacute;ch ứng da nhẹ ở người lớn, trẻ em v&agrave; trẻ sơ sinh.</p>\r\n\r\n<p>TH&Ocirc;NG TIN SẢN PHẨM</p>\r\n\r\n<p>Loại sản phẩm</p>\r\n\r\n<p>- Kem dưỡng l&agrave;m dịu da kh&ocirc; &amp; k&iacute;ch ứng, phục hồi &amp; bảo vệ da. Loại da ph&ugrave; hợp - Da hư tổn, da bị k&iacute;ch ứng, bong tr&oacute;c v&agrave; sau c&aacute;c liệu tr&igrave;nh điều t.rị da liễu - Ph&ugrave; hợp cho người lớn, trẻ em &amp; trẻ sơ sinh.</p>\r\n\r\n<p>- D&ugrave;ng cho mặt &amp; cơ thể. Độ an to&agrave;n</p>\r\n\r\n<p>- Khả năng dung nạp tối ưu.</p>\r\n\r\n<p>- Quy tắc sản xuất nghi&ecirc;m ngặt để tối thiểu nguy cơ g&acirc;y dị ứng da.</p>\r\n\r\n<p>- Kh&ocirc;ng paraben, kh&ocirc;ng hương liệu, kh&ocirc;ng chứa mỡ cừu, kh&ocirc;ng để lại vệt trắng.</p>\r\n\r\n<p>Th&agrave;nh phần</p>\r\n\r\n<p>- Một c&ocirc;ng thức ho&agrave;n chỉnh với 3 c&ocirc;ng dụng:</p>\r\n\r\n<p>&bull; Phục hồi l&agrave;n da: [Madecassoside] + [Đồng - Kẽm &ndash; Manganese]</p>\r\n\r\n<p>&bull; L&agrave;m dịu l&agrave;n da kh&ocirc; v&agrave; bị k&iacute;ch ứng: [5% Panthenol]</p>\r\n\r\n<p>&bull; Bảo vệ da: [Kết cấu kem đặc ẩm] + [C&aacute;c hoạt chất chống vi khuẩn]</p>\r\n\r\n<p>C&ocirc;ng dụng</p>\r\n\r\n<p>- T&aacute;i tạo da sau mụn, n&ecirc;n d&ugrave;ng sau khi vừa nặn mụn để ngăn ngừa vết th&acirc;m.</p>\r\n\r\n<p>- Phục h&ocirc;̀i làn da &amp; làm dịu các vùng da khô, da kích ứng &amp; cảm giác bỏng rát, mang lại cảm giác d&ecirc;̃ chịu. Hiệu quả đ&atilde; được chứng minh</p>\r\n\r\n<p>- 100% đối tượng đồng &yacute; rằng:</p>\r\n\r\n<p>&bull; Sản phẩm dễ sử dụng</p>\r\n\r\n<p>&bull; Kh&ocirc;ng g&acirc;y r&iacute;t - 96% đối tượng đồng &yacute; rằng:</p>\r\n\r\n<p>&bull; Sản phẩm kh&ocirc;ng l&agrave;m da nhờn</p>\r\n\r\n<p>&bull; Thẩm thấu nhanh Hướng dẫn sử dụng</p>\r\n\r\n<p>- Sau liệu tr&igrave;nh điều t.rị da liễu hoặc l&agrave;m theo hướng dẫn của b&aacute;c sĩ da liễu:</p>\r\n\r\n<p>&bull; Da bị k&iacute;ch ứng v&agrave; da kh&ocirc;: 2 lần một ng&agrave;y.</p>\r\n\r\n<p>&bull; Da bị nứt nẻ: 3 lần một ng&agrave;y.</p>\r\n\r\n<p>&bull; Đối với c&aacute;c vấn đề da kh&aacute;c: 2 lần một ng&agrave;y.</p>\r\n\r\n<p>- Sử dụng 2 - 3 l&acirc;̀n/ngày lên vùng da đã được làm sạch và làm dịu với nước khoáng. Thoa một lượng vừa đủ, nhẹ nhàng mát-xa đ&ecirc;̉ kem th&acirc;́m sâu vào trong da. Tránh thoa lên vùng mắt.</p>\r\n\r\n<p>Hướng dẫn bảo quản</p>\r\n\r\n<p>- Nơi tho&aacute;ng m&aacute;t, tr&aacute;nh &aacute;nh nắng trực tiếp.</p>\r\n\r\n<p>- Đậy nắp kỹ sau khi sử dụng.</p>\r\n\r\n<p>Hạn sử dụng: 3 năm kể từ ng&agrave;y sản xuất</p>\r\n\r\n<p>Ng&agrave;y sản xuất: Xem tr&ecirc;n bao b&igrave; sản phẩm</p>\r\n\r\n<p>Xuất xứ thương hiệu: Ph&aacute;p</p>\r\n\r\n<p>Nơi sản xuất: Ph&aacute;p</p>\r\n\r\n<p>TH&Ocirc;NG TIN THƯƠNG HIỆU</p>\r\n\r\n<p>La Roche-Posay l&agrave; nh&atilde;n h&agrave;ng dược mỹ phẩm đến từ Ph&aacute;p trực thuộc tập đo&agrave;n L&rsquo;Oreal đ&atilde; hoạt động được hơn 30 năm, phối hợp nghi&ecirc;n cứu với c&aacute;c chuy&ecirc;n gia da liễu tr&ecirc;n to&agrave;n thế giới cho ra đời c&aacute;c sản phẩm dưỡng da hướng đến thị trường sản phẩm d&agrave;nh cho da nhạy cảm, ngo&agrave;i ra c&ograve;n c&oacute; d&ograve;ng sản phẩm d&agrave;nh cho trẻ em. Th&agrave;nh phần nổi bật xuất hiện trong c&aacute;c sản phẩm của La Roche-Posay (LRP) l&agrave; nước suối kho&aacute;ng &ndash; thermal spring water. Tất cả những sản phẩm thuộc La Roche Posay đều được thử nghiệm l&acirc;m s&agrave;ng v&agrave; đ&aacute;nh gi&aacute; kh&aacute;ch quan từ bệnh viện Saint Jacques-Toulouse. Quy tr&igrave;nh b&agrave;o chế của sản phẩm cũng rất nghi&ecirc;m ngặt mang lại cho người sử dụng vẻ đẹp tự nhi&ecirc;n v&agrave; rất an to&agrave;n.</p>\r\n\r\n<p>Ch&uacute; &yacute;: Bao b&igrave; thay đổi t&ugrave;y theo từng đợt nhập h&agrave;ng</p>\r\n\r\n<p>#LAROCHEPOSAY #Cicaplast #kemduong #phuchoida #chinhhang</p>\r\n', 'Kem dưỡng giúp làm dịu, làm mượt, làm mát & phục hồi da phù hợp cho trẻ em La Roche-Posay Cicaplast Baume B5 40ml không chỉ giúp dưỡng ẩm mà còn giảm thiểu rõ rệt các dấu hiệu của sự kích ứng trên những vùng da bị tổn thương và phục hồi làn da. Sản phẩm được khuyên dùng sau các liệu trình điều t.rị thẩm mỹ & kích ứng da nhẹ ở người lớn, trẻ em và trẻ sơ sinh.', '365000', '2022-04-06 11:11:03', 0),
(16, 7, 11, 49, 'Nước làm sạch sâu và tẩy trang cho da nhạy cảm La Roche-Posay Micellar Water Ultra Sensitive Skin 400ml', '<p>V&Igrave; SAO BẠN SẼ TH&Iacute;CH?<br />\r\nNước tẩy trang gi&agrave;u kho&aacute;ng cho da nhạy cảm La Roche-Posay Micellar Water Ultra Sensitive Skin 400ml với c&ocirc;ng nghệ cải tiến Glyco Micellar mang lại hiệu quả l&agrave;m sạch s&acirc;u vượt trội, gi&uacute;p lấy đi lớp trang điểm, b&atilde; nhờn v&agrave; c&aacute;c hạt bụi si&ecirc;u nhỏ c&oacute; trong kh&oacute;i xe v&agrave; m&ocirc;i trường &ocirc; nhiễm nhưng vẫn an to&agrave;n cho l&agrave;n da nhạy cảm. Th&agrave;nh phần gi&agrave;u GLYCERIN gi&uacute;p dưỡng ẩm l&agrave;m mềm da, giảm ma s&aacute;t tối đa khi l&agrave;m sạch &amp; nước kho&aacute;ng La Roche-Posay l&agrave;m dịu da, giảm k&iacute;ch ứng v&agrave; chống o.xi h&oacute;a. Sản phẩm ph&ugrave; hợp để tẩy trang cho v&ugrave;ng mặt, mắt v&agrave; m&ocirc;i.</p>\r\n\r\n<p>TH&Ocirc;NG TIN SẢN PHẨM</p>\r\n\r\n<p>Loại sản phẩm<br />\r\n- Nước tẩy trang c&ocirc;ng nghệ cải tiến Glyco Micellar mang lại hiệu quả l&agrave;m sạch s&acirc;u vượt trội cho da nhạy cảm.</p>\r\n\r\n<p>Loại da ph&ugrave; hợp<br />\r\n- Ph&ugrave; hợp cho da nhạy cảm.</p>\r\n\r\n<p>Độ an to&agrave;n<br />\r\n- Kh&ocirc;ng paraben / Kh&ocirc;ng chất tạo m&agrave;u / Kh&ocirc;ng cồn/ Kh&ocirc;ng chứa x&agrave; ph&ograve;ng.<br />\r\n- Duy tr&igrave; độ pH tự nhi&ecirc;n của da n&ecirc;n an to&agrave;n với mọi loại da, kể cả da nhạy cảm.</p>\r\n\r\n<p>Th&agrave;nh phần<br />\r\n- C&ocirc;ng nghệ cải tiến Glyco Micellar mang lại hiệu quả l&agrave;m sạch s&acirc;u vượt trội.<br />\r\n- GLYCERIN gi&uacute;p dưỡng ẩm v&agrave; l&agrave;m mềm da.<br />\r\n- Nước kho&aacute;ng La Roche-Posay c&oacute; t&iacute;nh năng l&agrave;m dịu da, giảm k&iacute;ch ứng v&agrave; chống o.xi h&oacute;a.</p>\r\n\r\n<p>C&ocirc;ng dụng<br />\r\n- L&agrave;m sạch đến 99% lớp trang điểm, 70% mascara v&agrave; c&aacute;c hạt bụi si&ecirc;u nhỏ c&oacute; trong kh&oacute;i xe v&agrave; m&ocirc;i trường &ocirc; nhiễm chỉ sau một lượt b&ocirc;ng cotton*.<br />\r\n- Cung cấp độ ẩm v&agrave; giảm ma s&aacute;t tối đa khi l&agrave;m sạch.<br />\r\n- Chống o.xy h&oacute;a, gi&uacute;p bảo vệ da trước m&ocirc;i trường &ocirc; nhiễm.</p>\r\n\r\n<p>Hướng dẫn sử dụng<br />\r\n- D&ugrave;ng b&ocirc;ng cotton thoa sản phẩm l&ecirc;n mặt, mắt v&agrave; m&ocirc;i.<br />\r\n- Kh&ocirc;ng cần rửa lại bằng nước.</p>\r\n\r\n<p>Hướng dẫn bảo quản<br />\r\n- Nơi tho&aacute;ng m&aacute;t, tr&aacute;nh &aacute;nh nắng mặt trời trực tiếp.</p>\r\n\r\n<p>HSD: 3 năm kể từ ng&agrave;y sản xuất<br />\r\nNSX: In tr&ecirc;n bao b&igrave; sản phẩm<br />\r\nXuất xứ thương hiệu: Ph&aacute;p<br />\r\nNơi sản xuất: Ph&aacute;p</p>\r\n\r\n<p>ƯU ĐIỂM NỔI BẬT<br />\r\n- L&agrave;m sạch đến 99% lớp trang điểm, 70% mascara v&agrave; c&aacute;c hạt bụi si&ecirc;u nhỏ c&oacute; trong kh&oacute;i xe v&agrave; m&ocirc;i trường &ocirc; nhiễm chỉ sau một lượt b&ocirc;ng cotton*.<br />\r\n- Cung cấp độ ẩm v&agrave; giảm ma s&aacute;t tối đa khi l&agrave;m sạch.<br />\r\n- Chống o.xy h&oacute;a, gi&uacute;p bảo vệ da trước m&ocirc;i trường &ocirc; nhiễm.</p>\r\n\r\n<p>HIỆU QUẢ SỬ DỤNG<br />\r\n- L&agrave;m sạch đến 99% lớp trang điểm, 70% mascara v&agrave; c&aacute;c hạt bụi si&ecirc;u nhỏ c&oacute; trong kh&oacute;i xe v&agrave; m&ocirc;i trường &ocirc; nhiễm chỉ sau một lượt b&ocirc;ng cotton*.<br />\r\n- Cung cấp độ ẩm v&agrave; giảm ma s&aacute;t tối đa khi l&agrave;m sạch.</p>\r\n\r\n<p>HƯỚNG DẪN SỬ DỤNG<br />\r\n- D&ugrave;ng b&ocirc;ng cotton thoa sản phẩm l&ecirc;n mặt, mắt v&agrave; m&ocirc;i.<br />\r\n- Kh&ocirc;ng cần rửa lại bằng nước.</p>\r\n', 'Nước tẩy trang giàu khoáng cho da nhạy cảm La Roche-Posay Micellar Water Ultra Sensitive Skin 400ml với công nghệ cải tiến Glyco Micellar mang lại hiệu quả làm sạch sâu vượt trội, giúp lấy đi lớp trang điểm, bã nhờn và các hạt bụi siêu nhỏ có trong khói xe và môi trường ô nhiễm nhưng vẫn an toàn cho làn da nhạy cảm. Thành phần giàu GLYCERIN giúp dưỡng ẩm làm mềm da, giảm ma sát tối đa khi làm sạch & nước khoáng La Roche-Posay làm dịu da, giảm kích ứng và chống o.xi hóa. Sản phẩm phù hợp để tẩy trang cho vùng mặt, mắt và môi.', '465000', '2022-04-06 11:17:15', 1),
(17, 8, 13, 15, 'Nước thần dưỡng chất kép Lancome Clarifique Dual Essence 90ml', '<p style=\"text-align:justify\">- Kh&aacute;m ph&aacute; Quyền năng mới Nước thần Dưỡng chất k&eacute;p Clarifique của Lanc&ocirc;me: cho l&agrave;n da s&aacute;ng trong mịn m&agrave;ng, thu nhỏ lỗ ch&acirc;n l&ocirc;ng chỉ sau 4 tuần.<br />\r\n- Dựa tr&ecirc;n nghi&ecirc;n cứu độc quyền về khoa học Enzyme, Nước thần dưỡng chất k&eacute;p Clarfique được c&ocirc;ng thức được chiết xuất từ chồi non c&acirc;y gỗ sồi Ph&aacute;p, được mệnh danh l&agrave; &quot;Ngọc trai thực vật nước Ph&aacute;p&quot;, c&oacute; khả năng t&aacute;i tạo l&agrave;n da v&agrave; đảm bảo cấu tr&uacute;c da tinh tế v&agrave; mịn m&agrave;ng cũng như m&agrave;u da tươi s&aacute;ng hơn.</p>\r\n\r\n<p style=\"text-align:justify\">- C&ocirc;ng thức dưỡng chất k&eacute;p được định lượng ch&iacute;nh x&aacute;c của, c&ugrave;ng thanh khuấy thần th&aacute;nh t&acirc;n tiến, được thiết kế để tạo ra c&aacute;c bọt kh&iacute; si&ecirc;u nhỏ ho&agrave; quyện của cả 2 lớp dưỡng chất.</p>\r\n\r\n<p style=\"text-align:justify\">- Sau 4 tuần sử dụng, l&agrave;n da được t&aacute;i tạo cải thiện về cấu tr&uacute;c bề mặt &amp; sắc tố da: da căng mịn hơn +43%, da đều m&agrave;u hơn +24%, lỗ ch&acirc;n thu nhỏ -13%.</p>\r\n\r\n<p style=\"text-align:justify\">- Sản phẩm được nghi&ecirc;n cứu tr&ecirc;n l&agrave;n da người ch&acirc;u &Aacute; với độ h&agrave;i l&ograve;ng cao: 93% phụ nữ đồng &yacute; l&agrave;n da được cải thiện tốt hơn.</p>\r\n\r\n<p style=\"text-align:justify\"><br />\r\nHướng dẫn sử dụng:</p>\r\n\r\n<p style=\"text-align:justify\">Bước 1. Lắc dưỡng chất trước mỗi lần sử dụng.Bước 2. Đổ một v&agrave;i giọt v&agrave;o l&ograve;ng b&agrave;n tay.Bước 3. L&agrave;m ấm l&ograve;ng b&agrave;n tay, sau đ&oacute; vỗ l&ecirc;n mặt, &aacute;p nhẹ l&ecirc;n 2 m&aacute;, cổ &amp; cằm của bạn.Sử dụng s&aacute;ng v&agrave; tối sau bước rửa mặt, c&acirc;n bằng da &amp; trước Serum Đen Thần Th&aacute;nh Advanced Genifique. B&ocirc;i kem chống nắng h&agrave;ng ng&agrave;y.</p>\r\n\r\n<p style=\"text-align:justify\">Hướng dẫn bảo quản:</p>\r\n\r\n<p style=\"text-align:justify\">- Nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, tr&aacute;nh &aacute;nh nắng trực tiếp</p>\r\n\r\n<p style=\"text-align:justify\"><br />\r\nXuất xứ: Ph&aacute;p.</p>\r\n\r\n<p style=\"text-align:justify\">Hạn sử dụng: 03 năm kể từ NSX (NSX: xem &quot;MFG&quot; tr&ecirc;n bao b&igrave;)</p>\r\n\r\n<p style=\"text-align:justify\">TH&Ocirc;NG TIN THƯƠNG HIỆU:</p>\r\n\r\n<p style=\"text-align:justify\">Lanc&ocirc;me l&agrave; nh&atilde;n hiệu chuy&ecirc;n về nước hoa, c&aacute;c sản phẩm chăm s&oacute;c da v&agrave; mỹ phẩm make-up cao cấp được th&agrave;nh lập bởi Armand Petitjean v&agrave;o năm 1935. T&ecirc;n gọi của thương hiệu n&agrave;y được Petitjean lấy cảm hứng từ t&ograve;a l&acirc;u đ&agrave;i &quot;Le Ch&acirc;teau de Lancosme&quot;, nằm ở v&ugrave;ng ngoại &ocirc; Indre của nước Ph&aacute;p - địa danh nổi tiếng với những đ&oacute;a hồng hoang d&atilde; đẹp v&agrave; thơm. Hoa hồng cũng được chọn trở th&agrave;nh biểu tượng của thương hiệu, đại diện cho vẻ đẹp qu&yacute; ph&aacute;i, ki&ecirc;u kỳ v&agrave; sang trọng của nước Ph&aacute;p trong tinh thần Lancome. Kh&ocirc;ng chỉ l&agrave; vẻ đẹp của h&igrave;nh thức b&ecirc;n ngo&agrave;i, th&agrave;nh phần chất lượng cao b&ecirc;n trong, ph&iacute;a sau mỗi sản phẩm của Lancome đều c&oacute; một c&acirc;u chuyện, một cung bậc ri&ecirc;ng chạm tới cảm x&uacute;c của người d&ugrave;ng.</p>\r\n\r\n<p style=\"text-align:justify\">Năm 1964, Lanc&ocirc;me được tập đo&agrave;n L&#39;Oreal mua lại v&agrave; được đầu tư hơn về mọi mặt để tiếp tục sứ mệnh t&ocirc;n vinh vẻ đẹp ri&ecirc;ng của mỗi người phụ nữ, gi&uacute;p họ tự tin hơn bất kể người đ&oacute; ở độ tuổi n&agrave;o v&agrave; đang sống trong ho&agrave;n cảnh n&agrave;o. Hiện nay, c&aacute;c sản phẩm của Lanc&ocirc;me như nước hoa, kem che khuyết điểm, mascara nổi trội, d&ograve;ng phấn Absolue, kẻ mắt nước, phấn mắt, son m&ocirc;i... đ&atilde; c&oacute; mặt rộng r&atilde;i v&agrave; được y&ecirc;u th&iacute;ch tại nhiều quốc gia tr&ecirc;n khắp thế giới, trong đ&oacute; c&oacute; Việt Nam.</p>\r\n', 'Dựa trên nghiên cứu độc quyền về khoa học Enzyme, Nước thần dưỡng chất kép Clarfique được công thức được chiết xuất từ chồi non cây gỗ sồi Pháp, được mệnh danh là \"Ngọc trai thực vật nước Pháp\", có khả năng tái tạo làn da và đảm bảo cấu trúc da tinh tế và mịn màng cũng như màu da tươi sáng hơn.', '1800000', '2022-04-07 11:04:51', 0),
(18, 13, 12, 46, '[MỚI RA MẮT] Tinh chất đậm đặc dưỡng trắng cấp tốc Estee Lauder Perfectionist Pro Intense Brightening Essence Ampoule Vitamin C/E +Licorice 40ml', '<p><input alt=\"\" src=\"https://lzd-img-global.slatic.net/g/shop/d3d672721021066dd36947b270f14137.jpeg_2200x2200q80.jpg_.webp\" style=\"width: 960px; height: 1000px;\" type=\"image\" /></p>\r\n', 'Liệu pháp đặc trị mạnh mẽ, cô đặc tập trung với kết cấu nước mỏng nhẹ, tái tạo & đổi mới tế bào da, cho làn da tươi sáng rạng rỡ & giảm nhanh các vùng sạm nám, không đều màu, cải thiện lỗ chân lông hiệu quả.', '3640000', '2022-04-07 11:20:18', 0),
(19, 13, 7, 2, 'Tinh Chất Giúp Cải Thiện & Ngăn Ngừa Thâm Nám Đốm Nâu Toàn Diện Vichy Liftactiv B3 Dark Spots Serum 30ml', '<p><strong>&bull; Đặc trưng:&nbsp;</strong></p>\r\n\r\n<p>-&nbsp;<strong>Tinh Chất Gi&uacute;p Cải Thiện &amp; Ngăn Ngừa Th&acirc;m N&aacute;m Đốm N&acirc;u To&agrave;n Diện Vichy Liftactiv B3 Dark Spots Serum</strong>&nbsp;<strong>&nbsp;</strong>hiện nay sản phẩm đ&atilde; c&oacute; mặt tại&nbsp;<strong><a href=\"https://thegioiskinfood.com/\">Thế Giới Skinfood</a>.&nbsp;</strong>Với sự kết hợp giữa&nbsp;<strong>13% phức hợp</strong>&nbsp;th&agrave;nh phần hoạt t&iacute;nh cao:</p>\r\n\r\n<p>-<strong>&nbsp;Niacinamide B3:&nbsp;</strong>Nhờ t&aacute;c động chống tăng sắc tố ở lớp da cơ bản, sự xuất hiện của c&aacute;c đốm đen sẽ giảm r&otilde; rệt, cho l&agrave;n da tươi s&aacute;ng đều m&agrave;u</p>\r\n\r\n<p>-<strong>&nbsp;Axit glycolic&nbsp;</strong>v&agrave; c&aacute;c th&agrave;nh phần tẩy tế b&agrave;o chết &nbsp;gi&uacute;p l&agrave;m giảm sắc tố,&nbsp;cải thiện&nbsp;l&agrave;n da đều m&agrave;u v&agrave; rạng rỡ hơn</p>\r\n\r\n<p>- Giảm 71% mật độ v&agrave; k&iacute;ch thước đốm n&acirc;u, th&acirc;m n&aacute;m sau 2 th&aacute;ng</p>\r\n\r\n<p>- Sản phẩm kh&ocirc;ng g&acirc;y k&iacute;ch ứng, an to&agrave;n v&agrave;&nbsp;cho da nhạy cảm được kiểm tra bởi chuy&ecirc;n gia&nbsp;</p>\r\n\r\n<p>- Kết cấu nhẹ v&agrave; kh&ocirc;ng chứa dầu, nhanh ch&oacute;ng được hấp thụ v&agrave;o da v&agrave; để lại l&agrave;n da mềm mại dễ chịu.Thiết kế v&ograve;i đặc biệt&nbsp;c&oacute; thể t&aacute;c động đến đốm n&acirc;u nhỏ nhất</p>\r\n\r\n<p><strong>&bull; Đối tượng khuy&ecirc;n d&ugrave;ng:</strong></p>\r\n\r\n<p>- D&agrave;nh cho mọi loại da, kể cả da&nbsp;<a href=\"https://thegioiskinfood.com/search?type=product&amp;q=nh%E1%BA%A1y+c%E1%BA%A3m\"><strong>nhạy cảm</strong></a></p>\r\n\r\n<p>- D&agrave;nh cho l&agrave;n&nbsp;<a href=\"https://thegioiskinfood.com/collections/duong-trang-tri-tham\"><strong>da xỉn m&agrave;u, th&acirc;m sạm, kh&ocirc;ng đều m&agrave;u</strong></a></p>\r\n\r\n<p>- D&agrave;nh cho l&agrave;n da bắt đầu&nbsp;xuất hiện c&aacute;c dấu hiệu l&atilde;o h&oacute;a</p>\r\n\r\n<p><strong>&bull; Hướng dẫn sử dụng:&nbsp;</strong>Cho sản phẩm ra tay, vỗ nhẹ khắp mặt gi&uacute;p sản phẩm thẩm thấu triệt để. Sử dụng kết hợp kem dưỡng c&ugrave;ng d&ograve;ng gi&uacute;p tăng hiệu quả l&agrave;m s&aacute;ng da.&nbsp;Sử dụng 2 lần, s&aacute;ng v&agrave; tối v&agrave;&nbsp;sử dụng kết hợp kem chống nắng v&agrave;o buổi s&aacute;ng</p>\r\n', 'Tinh Chất Giúp Cải Thiện & Ngăn Ngừa Thâm Nám Đốm Nâu Toàn Diện Vichy Liftactiv B3 Dark Spots Serum là tinh chất dưỡng giúp da bạn cải thiện và ngăn ngừa đốm nâu, thâm nám toàn diện sau 8 tuần sử dụng thuộc thương hiệu dược mỹ phẩm Vichy đến từ Pháp\r\n', '1250000', '2022-04-07 11:46:39', 0),
(20, 4, 7, 30, '[400ml] Gel Rửa Mặt Cho Da Dầu Mụn Làm Sạch Sâu, Giảm Nhờn Vichy Normaderm Phytosolution Intensive Purifying Gel', '<p><strong>&bull; Đặc trưng:</strong></p>\r\n\r\n<p>-&nbsp;<strong>Gel Rửa Mặt Cho Da Dầu Mụn L&agrave;m Sạch S&acirc;u, Giảm Nhờn Vichy Normaderm Phytosolution Intensive Purifying Gel&nbsp;</strong>hiện đ&atilde; c&oacute; mặt tại<strong>&nbsp;<a href=\"https://thegioiskinfood.com/\">Thế Giới Skinfood</a></strong>&nbsp;chứa c&aacute;c th&agrave;nh phần nổi bật như&nbsp;<strong>Salicylic</strong>&nbsp;<strong>Acid</strong>&nbsp;<strong>chiết xuất từ c&acirc;y lộc đề&nbsp;</strong>gi&uacute;p l&agrave;m sạch&nbsp; v&agrave; k&iacute;ch th&iacute;ch c&aacute;c tế b&agrave;o chết bong tr&oacute;c gi&uacute;p bề mặt da th&ocirc;ng tho&aacute;ng v&agrave; l&agrave;m dịu nhanh c&aacute;c vết tấy đỏ, giảm vi&ecirc;m v&agrave; l&agrave;m sạch da nhờn để ngăn ngừa c&aacute;c vấn đề về mụn.</p>\r\n\r\n<p>- Chứa th&agrave;nh phần&nbsp;<strong>Zin</strong>&nbsp;<strong>Oxide</strong>&nbsp;c&oacute; khả năng kh&aacute;ng vi&ecirc;m, giảm vi khuẩn g&acirc;y mụn, cải thiện vết thương v&agrave; ngăn ngừa nhiễm tr&ugrave;ng da do vi khuẩn, phục hồi da v&agrave;&nbsp;hỗ trợ điều trị mụn. Ngo&agrave;i ra c&ograve;n chứa th&agrave;nh phần&nbsp;Copper gi&uacute;p điều tiết b&atilde; nhờn, l&agrave;m giảm lượng dầu thừa tr&ecirc;n da, từ đ&oacute; ngăn ngừa h&igrave;nh th&agrave;nh nh&acirc;n mụn mới do b&iacute;t tắc.</p>\r\n\r\n<p>-&nbsp;<strong>Probiotic</strong>&nbsp;<strong>Bifidus</strong>&nbsp;được dẫn xuất&nbsp; từ qu&aacute; tr&igrave;nh l&ecirc;n men vi sinh tự nhi&ecirc;n gi&uacute;p bổ sung độ ẩm, ngăn t&igrave;nh trạng kh&ocirc; v&agrave; mất nước qua da. Đồng thời, gi&uacute;p củng cố v&agrave; t&aacute;i cấu tr&uacute;c h&agrave;ng r&agrave;o bảo vệ da.</p>\r\n\r\n<p>- C&ocirc;ng thức gi&agrave;u&nbsp;<strong>nước kho&aacute;ng n&uacute;i lửa Vichy</strong>&nbsp;gi&uacute;p cấp nước, l&agrave;m dịu da tức th&igrave;, chống oxy h&oacute;a - bảo vệ da trước t&aacute;c động của gốc tự do trong &aacute;nh nắng,&nbsp;củng cố &amp; phục hồi h&agrave;ng r&agrave;o bảo vệ da.</p>\r\n\r\n<p>- Đ&atilde; được kiểm kiệm da liễu kh&ocirc;ng g&acirc;y k&iacute;ch ứng,&nbsp;kh&ocirc;ng chứa sulfate, kh&ocirc;ng x&agrave; ph&ograve;ng c&ugrave;ng độ pH 5.5 an to&agrave;n sử dụng cho mọi loại da.</p>\r\n\r\n<p>- Với kết cấu dạng gel với khả năng tạo bọt gi&uacute;p l&agrave;m sạch nhưng vẫn giữ lại độ ẩm cho da, mang lại cảm gi&aacute;c tươi m&aacute;t v&agrave; ẩm mịn sau khi sử dụng.</p>\r\n\r\n<p><strong>&bull; Đối tượng khuy&ecirc;n d&ugrave;ng:</strong></p>\r\n\r\n<p>- D&agrave;nh cho da dầu v&agrave; hỗn hợp thi&ecirc;n dầu&nbsp;</p>\r\n\r\n<p>- D&agrave;nh cho những l&agrave;n da c&oacute; tuyến nhờn hoạt động qu&aacute; độ</p>\r\n\r\n<p>- D&agrave;nh cho những l&agrave;n da c&oacute;&nbsp;<a href=\"https://thegioiskinfood.com/collections/mun-do-kich-ung\"><strong>mụn sưng vi&ecirc;m,&nbsp;kể cả da mụn v&agrave; da nhạy cảm</strong></a></p>\r\n\r\n<p><strong>&bull; Hướng dẫn sử dụng:&nbsp;</strong>Sau khi tẩy trang, lấy một lượng sản phẩm vừa đủ v&agrave;o l&ograve;ng b&agrave;n tay, tạo bọt đều khắp mặt v&agrave; rửa sạch với nước.</p>\r\n', 'Gel Rửa Mặt Cho Da Dầu Mụn Làm Sạch Sâu, Giảm Nhờn Vichy Normaderm Phytosolution Intensive Purifying Gel là gel rửa mặt thuộc dòng sản phẩm chăm sóc chuyên sâu hàng ngày dành cho da dầu mụn với công thức chứa nước khoáng Vichy và các thành phần giúp làm giảm mụn như Zinc oxide, Copper, Salicylic acid, Bifidus Probiotics... giúp làm sạch sâu làn da và hỗ trợ giảm mụn đầu đen, mụn sưng viêm, điều tiết bã nhờn hiệu quả thuộc thương hiệu Vichy  đến từ Pháp', '625000', '2022-04-07 11:51:17', 0),
(21, 4, 7, 17, 'Sữa Rửa Mặt Đất Sét Làm Sạch Sâu VICHY Normaderm Phytosolution Volcanic Mattifying Cleansing Cream 125ml', '<p><strong>&bull; Đặc trưng:</strong></p>\r\n\r\n<p><strong>-&nbsp;Sữa Rửa Mặt Đất S&eacute;t L&agrave;m Sạch S&acirc;u VICHY Normaderm Phytosolution Volcanic Mattifying Cleansing Cream&nbsp;</strong>hiện nay sản phẩm đ&atilde; c&oacute; mặt tại&nbsp;<strong><a href=\"https://thegioiskinfood.com/\">Thế Giới Skinfood</a>&nbsp;</strong>c&oacute; chứa th&agrave;nh phần cấu tạo từ&nbsp;<strong>đất s&eacute;t Kaolin&nbsp;</strong>chứa nhiều kho&aacute;ng chất ch&oacute; lợi cho da. Ngo&agrave;i ra loại đất s&eacute;t n&agrave;y c&ograve;n hỗ trợ h&uacute;t độc tố, l&agrave;m sạch&nbsp;cặn trang điểm, tế b&agrave;o chết, b&atilde; nhờn s&acirc;u trong lỗ ch&acirc;n l&ocirc;ng một c&aacute;ch nhẹ nh&agrave;ng nhưng kh&ocirc;ng g&acirc;y kh&ocirc;, căng k&iacute;t da</p>\r\n\r\n<p>- Chứa th&agrave;nh phần<strong>&nbsp;bột than hoạt t&iacute;nh</strong>&nbsp;hoạt động như một nam ch&acirc;m h&uacute;t bụi bẩn v&agrave; tạp chất ra khỏi da, giải đ&ocirc;̣c cho da, đồng thời l&agrave;m s&aacute;ng da. Than hoạt t&iacute;nh&nbsp;hấp thụ dầu thừa v&agrave; bụi bẩn tr&ecirc;n da, giải độc tố, giảm thiểu t&igrave;nh trạng da bị b&iacute;t tắc sinh mụn ẩn, mụn đầu đen&hellip;</p>\r\n\r\n<p>- Ngo&agrave;i ra c&ograve;n chứa<strong>&nbsp;Salicylic Acid&nbsp;</strong>c&oacute; khả năng t&aacute;c động s&acirc;u đến lỗ ch&acirc;n l&ocirc;ngsẽ gi&uacute;p tẩy v&agrave; l&agrave;m sạch s&acirc;u hơn trong lỗ ch&acirc;n l&ocirc;ng, từ đ&oacute; gi&uacute;p giải quyết c&aacute;c vấn đề tắc nghẽn lỗ ch&acirc;n l&ocirc;ng g&acirc;y n&ecirc;n t&igrave;nh trạng mụn, đồng thời BHA cũng hỗ trợ trong việc l&agrave;m giảm c&aacute;c rối loạn sắc tố da.</p>\r\n\r\n<p><strong>&bull; Đối tượng khuy&ecirc;n d&ugrave;ng:</strong></p>\r\n\r\n<p>- D&agrave;nh cho mọi loại da, kể cả&nbsp;<a href=\"https://thegioiskinfood.com/collections/mun-do-kich-ung\"><strong>da nhạy cảm</strong></a></p>\r\n\r\n<p>- D&agrave;nh cho những l&agrave;n da xuất hiện nhiều tế b&agrave;o chết</p>\r\n\r\n<p>- D&agrave;nh cho những bạn thường xuy&ecirc;n bị tiết dầu qu&aacute; độ,&nbsp;<a href=\"https://thegioiskinfood.com/collections/mun-dau-den-lo-chan-long-to\"><strong>da xuất hiện nhiều mụn đầu đen, mụn c&aacute;m</strong></a></p>\r\n\r\n<p><strong>&bull; Hướng dẫn sử dụng:</strong>&nbsp;Sau khi tẩy trang, l&agrave;m ẩm da với nước, lấy 1 lượng sản phẩm vừa đủ ra l&ograve;ng b&agrave;n tay ướt v&agrave; tạo bọt rồi thoa đều l&ecirc;n mặt (tr&aacute;nh v&ugrave;ng mắt v&agrave; m&ocirc;i), kết hợp massage nhẹ nh&agrave;ng theo chiều kết cấu da.&nbsp;Rửa sạch lại mặt với nước.</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'Sữa Rửa Mặt Đất Sét Làm Sạch Sâu VICHY Normaderm Phytosolution Volcanic Mattifying Cleansing Cream là  sữa rửa mặt  với thành phần chính bao gồm đất sét, đá khoáng núi lửa và than hoạt tính giúp làm sạch sâu bụi bẩn, bã nhờn và kiểm soát dầu thừa hiệu quả  thuộc thương hiệu dược mỹ phẩm Vichy đến từ Pháp', '535000', '2022-04-07 11:54:01', 0),
(22, 10, 12, 16, 'Kem Dưỡng Cô Đặc Phục Hồi Da Vùng Mắt Estée Lauder Matrix 15ml', '<h2><strong>Th&agrave;nh phần Kem dưỡng mắt Est&eacute;e Lauder Matrix 15ml</strong></h2>\r\n\r\n<p>- Hỗ trợ tăng cường độ đ&agrave;n hồi, l&agrave;m săn chắc da v&ugrave;ng mắt.</p>\r\n\r\n<p>- Hỗ trợ l&agrave;m đầy c&aacute;c nếp nhăn, vết ch&acirc;n chim ở đuối mắt.</p>\r\n\r\n<p>- Hỗ trợ nu&ocirc;i dưỡng l&agrave;n da v&ugrave;ng mắt tươi trẻ.</p>\r\n\r\n<p>- Hỗ trợ l&agrave;m mờ quầng th&acirc;m.</p>\r\n\r\n<p>- Hỗ trợ l&agrave;m giảm c&aacute;c bọng mắt.</p>\r\n\r\n<p>- Hỗ trợ t&aacute;i tạo tế b&agrave;o da mới để kh&ocirc;i phục l&agrave;n da trẻ khỏe.</p>\r\n\r\n<p>- Hỗ trợ dưỡng ẩm chuy&ecirc;n s&acirc;u suốt 24h mỗi ng&agrave;y.</p>\r\n\r\n<h2><strong>Hướng dẫn sử dụng&nbsp;</strong><strong>Kem dưỡng mắt Est&eacute;e Lauder</strong></h2>\r\n\r\n<p>- Sử dụng kem dưỡng 2 lần/ng&agrave;y v&agrave; d&ugrave;ng ở bước cuối trong quy tr&igrave;nh chăm s&oacute;c da.</p>\r\n\r\n<p>- D&ugrave;ng đầu&nbsp;<a href=\"https://vuahanghieu.com/may-massage\">m&aacute;y massage</a>&nbsp;đi k&egrave;m nhẹ nh&agrave;ng lăn dưới mỗi b&ecirc;n mắt 3 lần, xoay tr&ograve;n 360 độ b&ecirc;n dưới v&agrave; tr&ecirc;n mắt, kế th&uacute;c vỗ nhẹ bằng ng&oacute;n đeo nhẫn để gel thẩm thấu ho&agrave;n to&agrave;n v&agrave;o da.</p>\r\n', 'Kem dưỡng phục hồi da vùng mắt Estée Lauder Matrix 15ml là dòng kem dưỡng mắt cao cấp hỗ trợ phục hồi làn da săn chắc, thắt chặt kết cấu để làm mờ các nếp nhăn và vết chân chim, làm sáng da vùng mắt, đánh tan quầng thâm và bọng mắt, dưỡng ẩm chuyên sâu suốt 24h mỗi ngày.', '2100000', '2022-04-08 12:00:22', 2),
(23, 13, 12, 16, 'Tinh Chất Estée Lauder Advanced Night Repair Multi Recovery Complex 100ml', '<h2><strong>Th&agrave;nh phần Tinh Chất Est&eacute;e Lauder Advanced Night Repair Multi Recovery Complex 100ml</strong></h2>\r\n\r\n<p>Sản phẩm kh&ocirc;ng chứa kh&ocirc;ng chứa paraben, phthalate, dầu kho&aacute;ng, sulfat SLS &amp; SLES, v&agrave; chứa &iacute;t hơn một phần trăm hương thơm tổng hợp.</p>\r\n\r\n<h2><strong>Ưu điểm của&nbsp;Tinh Chất Est&eacute;e Lauder Advanced Night Repair Multi Recovery Complex 100ml</strong></h2>\r\n\r\n<p>- Tinh chất dưỡng cao cấp gi&uacute;p ngăn ngừa l&atilde;o h&oacute;a, th&uacute;c đẩy t&aacute;i tạo v&agrave; phục hồi da, l&agrave;m đều m&agrave;u da, đem lại l&agrave;n da tươi s&aacute;ng v&agrave; mịn m&agrave;ng hơn</p>\r\n\r\n<p>- Est&eacute;e Lauder Advanced Night Repair Multi Recovery Complex gi&uacute;p chống l&atilde;o ho&aacute; to&agrave;n diện, với c&ocirc;ng nghệ phục hồi độc quyền, arn được chứng minh sẽ giảm c&aacute;c dấu hiệu l&atilde;o ho&aacute;. Arn hỗ trợ đồng bộ ho&aacute; tự nhi&ecirc;n của qu&aacute; tr&igrave;nh hồi phục da ban đ&ecirc;m từ đ&oacute; arn mang đến cho bạn l&agrave;n da mịn m&agrave;ng, mướt, trẻ trung v&agrave; s&aacute;ng khoẻ hơn. Kh&ocirc;ng chỉ phục hồi da ban đ&ecirc;m m&agrave; c&ograve;n bảo vệ da ban ng&agrave;y nữa</p>\r\n\r\n<p>- Est&eacute;e Lauder Advanced Night cung cấp một lượng lớn hyaluronic acid - một nam ch&acirc;m h&uacute;t nước tự nhi&ecirc;n gi&uacute;p cấp nước li&ecirc;n tục cho da, gi&uacute;p tối đa ho&aacute; qu&aacute; tr&igrave;nh hồi phục tự nhi&ecirc;n cho da theo c&aacute;ch tối ưu nhất. Từ đ&oacute; arn hồi phục, bảo vệ v&agrave; dưỡng l&agrave;m cho l&agrave;n da bạn thực sự khoẻ, mịn mướt v&agrave; s&aacute;ng đều m&agrave;u l&ecirc;n mỗi ng&agrave;y.</p>\r\n\r\n<p>- Est&eacute;e Lauder c&oacute; kết cấu rất lỏng n&ecirc;n khi bạn b&ocirc;i sẽ thấm rất nhanh, ho&agrave;n to&agrave;n kh&ocirc;ng g&acirc;y b&iacute; da.</p>\r\n\r\n<p>- Tinh chất đ&atilde; được kiểm nghiệm da liễu, kh&ocirc;ng chứa chất tạo m&ugrave;i, kh&ocirc;ng chứa dầu n&ecirc;n rất l&agrave;nh t&iacute;nh ngay cả đối với da nhạy cảm v&agrave; kh&ocirc;ng g&acirc;y b&iacute; da.</p>\r\n\r\n<p>Được mệnh danh l&agrave; tinh chất thần th&aacute;nh nh&agrave;<a href=\"https://vuahanghieu.com/estee-lauder\" title=\"Estée Lauder\"><strong>&nbsp;Est&eacute;e Lauder</strong></a>, nghi&ecirc;n cứu chỉ r&otilde; những thay đổi r&otilde; rệt c&oacute; được chỉ sau 1- 2 tuần sử dụng. D&ugrave;ng sau bước l&agrave;m sạch mặt v&agrave; trước khi dưỡng ẩm, với c&ocirc;ng thức lỏng, nhẹ thấm h&uacute;t nhanh, ph&ugrave; hợp mọi loại da ngay cả da nhạy cảm.</p>\r\n', 'Tinh Chất Estée Lauder Advanced Night Repair Multi Recovery Complex 100ml là dòng nước thần dưỡng da cao cấp từ thương hiệu Estée Lauder của Mỹ. Estée Lauder Advanced Night Repair Multi Recovery Complex tái sinh làm trẻ hóa của làn da, trả lại nét đẹp tuổi thanh xuân rõ lên trông thấy, để bạn luôn trông tươi tắn, rạng rỡ, đầy sức sống.', '3300000', '2022-04-08 12:04:03', 2),
(24, 10, 12, 18, 'Set Dưỡng Ẩm, Hỗ Trợ Trẻ Hóa Cho Mặt Và Mắt Estee Lauder', '<h2><strong>Đặc điểm của set dưỡng da mặt v&agrave; mắt Estee Lauder</strong></h2>\r\n\r\n<p><strong>Set Dưỡng Ẩm, Hỗ Trợ Trẻ H&oacute;a Cho Mặt V&agrave; Mắt Estee Lauder bao gồm:</strong></p>\r\n\r\n<ul>\r\n	<li>Serum Estee Lauder Advanced Night Repair (30ml)</li>\r\n	<li>Kem dưỡng Revitalizing Supreme (15ml)</li>\r\n	<li>Kem mắt Estee Lauder Advanced Night Repair (5ml)</li>\r\n</ul>\r\n\r\n<h3><strong>1. Serum Estee Lauder Advanced Night Repair (30ml)</strong></h3>\r\n\r\n<p>Th&iacute;ch hợp cho mọi loại da: da dầu, da kh&ocirc;, da dầu mụn, hỗn hợp, da nhạy cảm v&agrave; da bị hư tổn.</p>\r\n\r\n<ul>\r\n	<li>Hỗ trợ t&aacute;i tạo, phục hồi da mạnh mẽ cho l&agrave;n da rạng rỡ, trẻ trung.</li>\r\n	<li>Hỗ trợ dưỡng ẩm s&acirc;u với c&ocirc;ng nghệ nam ch&acirc;m h&uacute;t ẩm tự nhi&ecirc;n, đồng thời hạn chế t&igrave;nh trạng da mất nước.</li>\r\n	<li>Hỗ trợ l&agrave;m giảm c&aacute;c dấu hiệu tuổi t&aacute;c tr&ecirc;n da, giảm nhăn da, l&agrave;m dầy c&aacute;c r&atilde;nh.</li>\r\n	<li>Hỗ trợ l&agrave;m da săn chắc, tăng đ&agrave;n hồi, da tr&ocirc;ng trẻ hơn, rạng rỡ hơn.</li>\r\n	<li>Sức mạnh c&ocirc;ng nghệ khoa học Advanced Night Repair</li>\r\n</ul>\r\n\r\n<p><em><strong>Hướng dẫn sử dụng Serum Estee Lauder Advanced Night Repair 30ml</strong></em></p>\r\n\r\n<ul>\r\n	<li>Sau khi l&agrave;m sạch da. Trước khi d&ugrave;ng kem dưỡng ẩm.</li>\r\n	<li>Sử dụng v&agrave;i giọt.</li>\r\n	<li>Nhẹ nh&agrave;ng m&aacute;t-xa khắp mặt v&agrave; cổ họng.</li>\r\n</ul>\r\n\r\n<h3><strong>2. Kem dưỡng Revitalizing Supreme (15ml)</strong></h3>\r\n\r\n<ul>\r\n	<li>Hỗ trợ l&agrave;m tăng độ đ&agrave;n hồi cho da, hạn chế c&aacute;c dấu hiệu tuổi t&aacute;c tr&ecirc;n da như c&aacute;c vết ch&acirc;n chim, nếp nhăn, da chảy xệ v&agrave; mất nước.</li>\r\n	<li>Hỗ trợ cung cấp nước, dưỡng ẩm cho da mang lại l&agrave;n da đ&agrave;n hồi, săn chắc, mềm mại, dẻo dai hơn v&agrave; c&oacute; khả năng t&aacute;i sinh tốt hơn.</li>\r\n	<li>Đ&atilde; được kiểm nghiệm, hạn chế t&igrave;nh trạng g&acirc;y mụn hay g&acirc;y k&iacute;ch ứng da.</li>\r\n</ul>\r\n\r\n<p><em><strong>Hướng dẫn sử dụng</strong></em></p>\r\n\r\n<ul>\r\n	<li>Sử dụng sau bước l&agrave;m sạch da v&agrave; serum, lấy một lượng kem dưỡng vừa đủ thoa l&ecirc;n mặt rồi massage nhẹ nh&agrave;ng để c&aacute;c dưỡng chất thấu s&acirc;u v&agrave;o da.</li>\r\n	<li>D&ugrave;ng 2 lần/ ng&agrave;y v&agrave;o mỗi buổi s&aacute;ng v&agrave; tối</li>\r\n	<li>Sản phẩm th&iacute;ch hợp sử dụng cho độ tuổi từ 25 trở l&ecirc;n.</li>\r\n</ul>\r\n', 'Set Dưỡng Ẩm, Hỗ Trợ Trẻ Hóa Cho Mặt Và Mắt Estee Lauder là một set dưỡng da đến từ thương hiệu Estée Lauder. Set Dưỡng Ẩm, Hỗ Trợ Trẻ Hóa Cho Mặt Và Mắt Estee Lauder bao gồm 3 sản phẩm best seller của hãng, sẽ là món quà tặng ý nghĩa dành tặng người thương đó nhé.', '5500000', '2022-04-08 12:06:55', 0),
(25, 13, 12, 17, 'Tinh chất phục hồi da ban đêm Estee Lauder Advanced Night Repair Serum 50ml', '<h2>C&ocirc;ng dụng</h2>\r\n\r\n<p>Tinh chất phục hồi da ban đ&ecirc;m Estee Lauder Advanced Night Repair Serum 50ml với kết cấu rất lỏng nhẹ, mang lại khả năng thẩm thấu nhanh v&agrave;o s&acirc;u b&ecirc;n trong lỗ ch&acirc;n l&ocirc;ng, kh&ocirc;ng g&acirc;y b&iacute; da.&nbsp;</p>\r\n\r\n<p>Tinh chất phục hồi da ban đ&ecirc;m Estee Lauder Advanced Night Repair Serum 50ml với c&ocirc;ng nghệ phục hồi độc quyền gi&uacute;p l&agrave;m&nbsp;giảm v&agrave; chống lại c&aacute;c dấu hiệu&nbsp;l&atilde;o h&oacute;a, nếp nhăn tr&ecirc;n da.</p>\r\n\r\n<p>Hỗ trợ sự đồng bộ ho&aacute; tự nhi&ecirc;n (synchronization) của qu&aacute; tr&igrave;nh hồi phục da ban đ&ecirc;m, từ đ&oacute; mang đến cho bạn l&agrave;n da căng mịn tự nhi&ecirc;n. Kh&ocirc;ng chứa dầu v&agrave; c&aacute;c th&agrave;nh phần c&oacute; hại cho da.&nbsp;</p>\r\n\r\n<p>M&agrave;u đ&agrave;o nhạt trong suốt, độ đặc vừa phải gi&uacute;p dễ d&agrave;ng t&aacute;n nhẹ l&ecirc;n da đồng thời duy tr&igrave; lớp da s&aacute;ng mịn tự nhi&ecirc;n.</p>\r\n\r\n<h2>Hướng dẫn sử dụng</h2>\r\n\r\n<p>Sử dụng trước bước dưỡng da với kem</p>\r\n\r\n<p>Lấy 1 lượng serum vừa đủ, thoa đều khắp mặt, kết hợp massage nhẹ nh&agrave;ng v&agrave; vỗ nhẹ để c&aacute;c dưỡng chất thấm đều v&agrave;o da.</p>\r\n\r\n<p>Sản phẩm hiện đang được ph&acirc;n phối ch&iacute;nh h&atilde;ng tại hệ thống AURA&nbsp;tr&ecirc;n to&agrave;n quốc.</p>\r\n', 'Tinh chất phục hồi da ban đêm Estee Lauder Advanced Night Repair Serum 50ml với công nghệ ChronoluxCB ™ giúp cung cấp độ ẩm sâu cho da, đồng thời giảm nếp nhăn và giúp da săn chắc đáng kể.', '3390000', '2022-04-08 12:15:16', 1),
(26, 10, 13, 20, 'Bộ Tinh Chất Dưỡng Da Lancôme Advanced Génifique Radiance Boosting Face Serum Duo (2x50ml)', '<h2><strong>Ưu điểm Bộ Tinh Chất Dưỡng Da Lanc&ocirc;me Advanced G&eacute;nifique Radiance Boosting Face Serum Duo</strong></h2>\r\n\r\n<ul>\r\n	<li>Hỗ trợ chức năng t&aacute;i cấu tr&uacute;c v&agrave; phục hồi của c&aacute;c tế b&agrave;o da.</li>\r\n	<li>Gi&uacute;p da săn chắc, l&agrave;m mờ v&agrave; ngăn chặn sự h&igrave;nh th&agrave;nh sắc tố v&agrave; nếp nhăn.</li>\r\n	<li>Thẩm thấu cực kỳ nhanh, kh&ocirc;ng g&acirc;y tắc nghẽn lỗ ch&acirc;n l&ocirc;ng v&agrave; kh&ocirc;ng g&acirc;y mụn.&nbsp;</li>\r\n	<li>Giữ nước cho da, mềm mại v&agrave; mịn m&agrave;ng hơn r&otilde; rệt.</li>\r\n	<li>Hỗ trợ v&agrave; l&agrave;m giảm sự xuất hiện của c&aacute;c dấu hiệu tuổi t&aacute;c.</li>\r\n	<li>C&ocirc;ng thức ho&agrave;n hảo hỗ trợ h&agrave;ng r&agrave;o độ ẩm cho da, gi&uacute;p bảo vệ da chống lại c&aacute;c t&aacute;c nh&acirc;n b&ecirc;n ngo&agrave;i.</li>\r\n</ul>\r\n\r\n<h2><strong>Hướng dẫn sử dụng</strong></h2>\r\n\r\n<ul>\r\n	<li>Sau khi l&agrave;m sạch mặt, lấy 2-3 giọt l&ecirc;n ng&oacute;n tay thoa đều v&agrave; massage v&ugrave;ng mặt.&nbsp;</li>\r\n	<li>Sử dụng 2 lần/ng&agrave;y v&agrave;o buổi s&aacute;ng - tối.</li>\r\n</ul>\r\n', 'Bộ Tinh Chất Dưỡng Da Lancôme Advanced Génifique Radiance Boosting Face Serum Duo (2x50ml) là dòng serum cap cấp đến từ thương hiệu mỹ phẩm hàng đầu của Pháp - Lancôme. Ngay từ khi có mặt trên thị trường, bộ sản phẩm đã nhận được sự săn đón của những tín đồ làm đẹp. ', '5750000', '2022-04-08 12:18:36', 0);
INSERT INTO `product` (`idProduct`, `idCategory`, `idBrand`, `Quantity`, `ProductName`, `DesProduct`, `ShortDes_Pro`, `Price`, `Date_Add`, `Sold`) VALUES
(27, 13, 13, 19, 'Tinh Chất Lancôme Rénergie Multi-Lift Ultra Full Spectrum Anti-Ageing Serum 50ml', '<h2><strong>Ưu điểm của Lanc&ocirc;me R&eacute;nergie Multi-Lift Ultra Full Spectrum Anti-Ageing Serum 50ml</strong></h2>\r\n\r\n<p><strong>Lanc&ocirc;me R&eacute;nergie Multi-Lift Ultra Full Spectrum Anti-Ageing Serum&nbsp;</strong>ra đời dựa tr&ecirc;n c&ocirc;ng thức ti&ecirc;n tiến nhất của Lancome. C&ugrave;ng với kết cấu dạng lỏng nhẹ, lọ tinh chất gi&agrave;u dưỡng chất n&agrave;y thấm nhanh v&agrave;o da mang lại l&agrave;n da rạng rỡ mỗi ng&agrave;y.</p>\r\n\r\n<p>Hỗ trợ bổ sung dưỡng chất cho l&agrave;n da mịn m&agrave;ng hơn, tươi s&aacute;ng hơn.</p>\r\n\r\n<p>Hỗ trợ duy tr&igrave; độ săn chắc của da.</p>\r\n\r\n<p>Hỗ trợ l&agrave;m giảm sạm n&aacute;m, t&agrave;n nhang tr&ecirc;n da.</p>\r\n\r\n<p>Hỗ trợ bảo vệ da khỏi tia UV h&agrave;ng ng&agrave;y với SPF 50.</p>\r\n\r\n<p>Hỗ trợ thu nhỏ lỗ ch&acirc;n l&ocirc;ng.</p>\r\n\r\n<h2><strong>Hướng dẫn sử dụng</strong></h2>\r\n\r\n<p>&Aacute;p dụng v&agrave;o buổi s&aacute;ng v&agrave; buổi tối sau khi l&agrave;m sạch da. Thoa v&agrave;o buổi s&aacute;ng l&ecirc;n mặt, cổ v&agrave; v&ugrave;ng da ngực đ&atilde; được l&agrave;m sạch theo chuyển động tr&ograve;n. M&aacute;t - xa nhẹ cho đến khi tinh chất thẩm thấu v&agrave;o da.</p>\r\n', 'Tinh Chất Lancôme Rénergie Multi-Lift Ultra Full Spectrum Anti-Ageing Serum 50ml là dòng sản phẩm cao cấp đến từ thương hiệu Lancôme nổi tiếng. Với công thức vượt trội Lancôme Rénergie Multi-Lift Ultra Full Spectrum Anti-Ageing dưỡng da sáng khỏe, tự nhiên.', '3200000', '2022-04-08 12:21:31', 1),
(28, 7, 13, 15, 'Nước Tẩy Trang Hoa Hồng Dưỡng Ẩm Lancôme Eau Micellaire Confort 200ml', '<h2><strong>Ưu điểm của Nước Tẩy Trang Lanc&ocirc;me Eau Micellaire Confort</strong></h2>\r\n\r\n<p><strong>Nước tẩy trang Lanc&ocirc;me Eau Micellaire Confort</strong>&nbsp;l&agrave; một loại nước tẩy trang ki&ecirc;m hoa hồng c&oacute; dưỡng ẩm v&agrave; l&agrave;m dịu c&oacute; chứa Mật ong, Glycerin v&agrave; nước hoa hồng. N&oacute; đảm bảo một cảm gi&aacute;c thoải m&aacute;i, l&agrave;m dịu sau khi loại bỏ trang điểm v&agrave; c&aacute;c tạp chất. N&oacute; kh&ocirc;ng để lại dư lượng tr&ecirc;n da cho một kết quả mịn m&agrave;ng, mượt m&agrave; m&agrave; kh&ocirc;ng c&oacute; cảm gi&aacute;c kh&ocirc; căng.</p>\r\n\r\n<p>Hiệu quả v&agrave; nhẹ nh&agrave;ng loại bỏ makeup v&agrave; tạp chất.</p>\r\n\r\n<p>Da được thanh lọc, l&agrave;m dịu, mềm mại v&agrave; ngậm nước.</p>\r\n\r\n<p>Rửa sạch dễ d&agrave;ng cho da mềm mại v&agrave; mịn m&agrave;ng.</p>\r\n\r\n<p>Hỗ trợ l&agrave;m tho&aacute;ng lỗ ch&acirc;n l&ocirc;ng, l&agrave;m thoải m&aacute;i da tươi s&aacute;ng, sạch sẽ.</p>\r\n\r\n<h2><strong>Hướng dẫn sử dụng</strong></h2>\r\n\r\n<p>N&ecirc;n sử dụng 2 lần s&aacute;ng v&agrave; tối.</p>\r\n\r\n<p>Cho nước tẩy trang v&agrave;o b&ocirc;ng tẩy trang, sau đ&oacute; nhẹ nh&agrave;ng thấm l&ecirc;n mặt, xoa nhẹ để loại bỏ lớp bụi bẩn, tạp chất tr&ecirc;n da, hoặc l&agrave; loại bỏ lớp trang điểm c&ograve;n dư tr&ecirc;n da.</p>\r\n\r\n<p>Kh&ocirc;ng cần rửa lại với nước.</p>\r\n', 'Nước Tẩy Trang Hoa Hồng Dưỡng Ẩm Lancôme Eau Micellaire Confort 200ml là dòng sản phẩm cao cấp đến từ thương hiệu Lancôme nổi tiếng. Với công thức vượt trội Lancôme Eau Micellaire Confort nhẹ nhàng lấy đi lớp trang điểm và bụi bẩn trên da, cho bạn làn da thông thoáng hơn.', '1300000', '2022-04-08 12:24:26', 0),
(29, 8, 13, 12, 'Toner Lancôme Làm Sạch Da Tonique Eclat 200ml', '<blockquote>\r\n<p>Lanc&ocirc;me đ&atilde; tạo ra d&ograve;ng Tonique Eclat với c&aacute;c th&agrave;nh phần c&oacute; nguồn gốc từ thi&ecirc;n nhi&ecirc;n. Một trải nghiệm rửa mặt thật dịu nhẹ v&agrave; hỗ trợ l&agrave;m giảm t&igrave;nh trạng kh&ocirc; r&aacute;p tr&ecirc;n da.</p>\r\n\r\n<h3>Hiệu quả sản phẩm</h3>\r\n</blockquote>\r\n\r\n<blockquote>- Hỗ trợ t&aacute;i tạo tế b&agrave;o cho&nbsp;l&agrave;n da tr&ocirc;ng rạng rỡ, khỏe khoắn.</blockquote>\r\n\r\n<blockquote>- Hỗ trợ l&agrave;m da th&ecirc;m dịu m&aacute;t.</blockquote>\r\n\r\n<blockquote>- Hỗ trợ cấp ẩm cho da th&ecirc;m mềm mại.</blockquote>\r\n\r\n<blockquote>- Hỗ trợ bảo vệ da khỏi c&aacute;c t&aacute;c nh&acirc;n g&acirc;y hại</blockquote>\r\n', 'Tonique Eclat toner là loại lotion dịu nhẹ hỗ trợ cân bằng cho da, hỗ trợ lấy đi các tế bào da thừa trên da một cách tốt hơn.\r\n\r\nDùng cho da thường và da hỗn hợp.\r\n\r\nSử dụng 2 lần mỗi ngày: sáng và tối', '900000', '2022-04-08 12:26:21', 0),
(30, 3, 11, 47, 'Kem Chống Nắng Dạng Sữa Không Nhờn Rít Cho Da Nhạy Cảm La Roche-Posay Anthelios Invisible Fluid SPF50+ 50ml', '<p><strong>&bull; Đặc trưng:</strong></p>\r\n\r\n<p><strong>- Kem Chống Nắng Dạng Sữa Kh&ocirc;ng Nhờn R&iacute;t Cho Da Nhạy Cảm La Roche-Posay Anthelios Invisible Fluid SPF50+&nbsp;</strong>hiện tại đ&atilde; c&oacute; mặt tại<strong>&nbsp;<a href=\"https://thegioiskinfood.com/\">Thế Giới Skinfood</a>.&nbsp;</strong>Với&nbsp;<strong>m&agrave;ng lọc độc quyền&nbsp;XL-PROTECT&trade;</strong>&nbsp;sự kết hợp giữa m&agrave;ng lọc quang phổ rộng chưa nhiều m&agrave;ng lọc tia UV v&agrave; th&agrave;nh phần chống oxy h&oacute;a kh&ocirc;ng những mang đến khả năng bảo vệ vượt trội trước tia UVA, UVB m&agrave; c&ograve;n gi&uacute;p chống lại c&aacute;c t&aacute;c nh&acirc;n kh&aacute;c g&acirc;y hại cho da như &ocirc; nhi&ecirc;m, tia hồng ngoại.</p>\r\n\r\n<p>-&nbsp;<strong>C&ocirc;ng nghệ Intelimer</strong>, gi&uacute;p mang lại độ bảo vệ &amp; kh&aacute;ng&nbsp; tr&ocirc;i tối đa với kết cấu lỏng nhẹ, kh&ocirc;ng nhờn r&iacute;t.</p>\r\n\r\n<p>- Ngo&agrave;i ra c&ograve;n chứa th&agrave;nh phần<strong>&nbsp;Glycerin&nbsp;</strong>cơ chế hoạt động l&agrave; hấp thụ nước từ m&ocirc;i trường b&ecirc;n ngo&agrave;i gi&uacute;p&nbsp;cung cấp độ ẩm cần thiết một c&aacute;ch tự nhi&ecirc;n, tạo một lớp m&agrave;ng bảo vệ da, hạn chế sự tho&aacute;t hơi nước tr&ecirc;n bề mặt da, khiến da kh&ocirc;ng bị kh&ocirc;, mất hơi nước, lu&ocirc;n duy tr&igrave; độ ẩm cho da khiến da lu&ocirc;n được mịn m&agrave;ng.</p>\r\n\r\n<p>- Chứa nước kho&aacute;ng La Roche-Posay - nguồn năng lượng của thi&ecirc;n nhi&ecirc;n</p>\r\n\r\n<p><em>Được sinh ra từ sự giao thoa giữa nước mưa v&agrave; đ&aacute; phấn ngh&igrave;n năm tại nguồn nước kho&aacute;ng nhiệt nổi tiếng nhất thế giới - thị trấn&nbsp;La Roche-Posay tại Ph&aacute;p.&nbsp;Được sử dụng lần đầu ti&ecirc;n trong chăm s&oacute;c da v&agrave;o năm 1928, Nước kho&aacute;ng nhiệt từ l&agrave;ng La Roche-Posay đ&atilde; nổi tiếng h&agrave;ng ng&agrave;n năm v&igrave; v&ocirc; số lợi &iacute;ch mang lại cho l&agrave;n da</em></p>\r\n\r\n<p><em>Chứa một sự kết hợp đặc biệt&nbsp;giữa kho&aacute;ng chất v&agrave; nguy&ecirc;n tố vi lượng gồm c&aacute;c th&agrave;nh phần thiết yếu nu&ocirc;i dưỡng l&agrave;n da như gi&agrave;u h&agrave;m lượng Selenium tự nhi&ecirc;n c&oacute; khả năng chống oxy h&oacute;a mạnh mẽ, lập tức l&agrave;m dịu da v&agrave; giảm k&iacute;ch ứng được sử dụng ở ch&acirc;u &Acirc;u trong suốt nhiều thế kỷ, th&iacute;ch hợp cho cả l&agrave;n da trẻ em&nbsp;</em></p>\r\n\r\n<p><em>Ngo&agrave;i ra, c&aacute;c chuy&ecirc;n gia da liễu tr&ecirc;n to&agrave;n thế giới đều nhận thức r&otilde; được khả năng diệu k&igrave; của nước kho&aacute;ng gi&uacute;p l&agrave;m dịu v&agrave; giảm bớt c&aacute;c triệu chứng của c&aacute;c bệnh nh&acirc;n vi&ecirc;m da cơ địa v&agrave; vẩy nến</em></p>\r\n\r\n<p><em>***Chứng nhận độ tinh khiết đặc biệt:&nbsp;Nước kho&aacute;ng nhiệt La Roche-Posay trải qua trung b&igrave;nh 1.000 thử nghiệm mỗi năm. Mục đ&iacute;ch lột trong c&aacute;c nghi&ecirc;n cứu được thực hiện bởi viện nghi&ecirc;n cứu da liễu La Roche-Posay đ&atilde; ph&aacute;t hiện ra được kh&iacute;a cạnh ho&agrave;n to&agrave;n mới của nước kho&aacute;ng đ&oacute; l&agrave;&nbsp;Aqua Posae Filiformis, một hoạt chất mang t&iacute;nh đột ph&aacute; trong việc chăm s&oacute;c l&agrave;n da bị vi&ecirc;m da cơ địa đ&atilde; h&igrave;nh th&agrave;nh v&agrave; được t&igrave;m thấy trong nước kho&aacute;ng La Roche-Posay&nbsp;&nbsp;</em></p>\r\n\r\n<p><em>Ngo&agrave;i ra, c&aacute;c chuy&ecirc;n gia da liễu&nbsp;tr&ecirc;n to&agrave;n thế giới đều nhận thứa&nbsp;để đảm bảo chất lượng của n&oacute; suốt cả năm</em></p>\r\n\r\n<p>- Được c&aacute;c chuy&ecirc;n gia da liễu tr&ecirc;n to&agrave;n thế giới khuy&ecirc;n d&ugrave;ng.&nbsp;Đ&atilde; thử nghiệm dưới sự kiểm so&aacute;t da liễu tr&ecirc;n da nhạy cảm v&agrave; dễ k&iacute;ch ứng.&nbsp;Đ&atilde; thử nghiệm dưới sự kiểm so&aacute;t nh&atilde;n khoa tr&ecirc;n mắt v&agrave; v&ugrave;ng mắt nhạy cảm. Đ&atilde; thử nghiệm tr&ecirc;n người đeo k&iacute;nh &aacute;p tr&ograve;ng.</p>\r\n\r\n<p>- Kết cấu dạng sữa thẩm thấu nhanh ch&oacute;ng khi thoa l&ecirc;n da, kh&ocirc;ng để lại vệt trắng mang lại cảm gi&aacute;c dễ chịu. C&oacute; khả năng kh&aacute;ng nước, chống mồ h&ocirc;i v&agrave; c&aacute;t.</p>\r\n\r\n<p><strong>&bull; Đối tượng khuy&ecirc;n d&ugrave;ng:</strong></p>\r\n\r\n<p>- D&agrave;nh cho mọi loại da, kể cả&nbsp;<a href=\"https://thegioiskinfood.com/collections/mun-do-kich-ung\"><strong>da nhạy cảm.</strong></a></p>\r\n\r\n<p>- D&agrave;nh cho những<strong>&nbsp;l&agrave;n da yếu ớt mỏng manh.</strong></p>\r\n\r\n<p>- D&agrave;nh cho những l&agrave;n da thường xuy&ecirc;n bị k&iacute;ch th&iacute;ch bởi những t&aacute;c động ở b&ecirc;n ngo&agrave;i m&ocirc;i trường.</p>\r\n\r\n<p><strong>&bull; Hướng dẫn sử dụng:&nbsp;</strong>Sử dụng ở bước cuối c&ugrave;ng trong chu tr&igrave;nh chăm s&oacute;c da, lấy một lượng vừa đủ thoa đều l&ecirc;n da. N&ecirc;n b&ocirc;i tối thiểu trước 20 ph&uacute;t&nbsp;khi ra ngo&agrave;i để kem chống nắng ổn định tr&ecirc;n da.</p>\r\n', 'Kem Chống Nắng Dạng Sữa Không Nhờn Rít Cho Da Nhạy Cảm La Roche-Posay Anthelios Invisible Fluid SPF50+  là dòng sản phẩm kem chống nắng có khả năng chống nắng phổ rộng, bảo vệ da toàn diện trước tác hại từ tia UVA/UVB thuộc thương hiệu La Roche-Posay.', '495000', '2022-04-08 12:30:04', 3),
(32, 13, 11, 129, 'Tinh Chất Giảm Thâm Nám & Nếp Nhăn, Chống Lão Hóa La Roche-Posay Retinol B3 Serum Anti-Wrinkle Concentrate Regenerating Resurfacing 30ml', '<p><strong>&bull; Đặc trưng:&nbsp;</strong></p>\r\n\r\n<p>-&nbsp;<strong>Tinh Chất Giảm Th&acirc;m N&aacute;m &amp; Nếp Nhăn, Chống&nbsp;L&atilde;o H&oacute;a La Roche-Posay Retinol B3 Serum Anti-Wrinkle Concentrate Regenerating Resurfacing</strong>&nbsp;hiện đ&atilde; c&oacute; mặt tại&nbsp;<a href=\"https://thegioiskinfood.com/\"><strong>Thế Giới Skinfood</strong></a>. Chứa c&aacute;c th&agrave;nh phần chống l&atilde;o h&oacute;a phức hợp nhẹ nh&agrave;ng cho hiệu quả ưu việt&nbsp;gi&uacute;p k&iacute;ch th&iacute;ch qu&aacute; tr&igrave;nh t&aacute;i tạo da, tăng cường sản sinh&nbsp;<strong>Collagen</strong>&nbsp;để nu&ocirc;i dưỡng l&agrave;n da đ&agrave;n hồi, khoẻ mạnh, hỗ trợ&nbsp;l&agrave;m th&ocirc;ng tho&aacute;ng lỗ ch&acirc;n l&ocirc;ng, ngo&agrave;i ra c&aacute;c th&agrave;nh phần thiết yếu, cung cấp đủ ẩm cho da, nu&ocirc;i dưỡng da s&aacute;ng&nbsp;khoẻ v&agrave; đ&agrave;n hồi.</p>\r\n\r\n<p>- Chứa&nbsp;<strong>Retinol 0.3%</strong>&nbsp;c&oacute; khả năng thẩm thấu v&agrave;o da v&agrave;&nbsp;tăng cường qu&aacute; tr&igrave;nh t&aacute;i sinh tế b&agrave;o, k&iacute;ch th&iacute;ch sản sinh&nbsp;<strong>Collagen</strong>&nbsp;cũng như hỗ trợ giảm&nbsp;mụn v&agrave; kh&aacute;ng khuẩn, ngo&agrave;i ra&nbsp;<strong>Retinol</strong>&nbsp;c&ograve;n c&oacute; t&aacute;c dụng&nbsp;chống l&atilde;o h&oacute;a&nbsp;gi&uacute;p giảm thiểu c&aacute;c vấn đề về da như n&aacute;m, sạm, th&acirc;m t&agrave;n nhang v&agrave; đặc biệt l&agrave; bảo vệ da trước c&aacute;c t&aacute;c động ti&ecirc;u cực từ m&ocirc;i trường b&ecirc;n ngo&agrave;i.</p>\r\n\r\n<p>- Chứa&nbsp;<strong>Vitamin B3</strong>&nbsp;cấp ẩm v&agrave; duy tr&igrave; độ ẩm cần thiết tr&ecirc;n da, ngo&agrave;i ra con hỗ trợ kh&aacute;ng vi&ecirc;m&nbsp;ngăn ngừa&nbsp;c&aacute;c vết th&acirc;m n&aacute;m, t&agrave;n nhang,&nbsp;gi&uacute;p bổ sung v&agrave; k&iacute;ch th&iacute;ch sản sinh&nbsp;<strong>Ceramide</strong>&nbsp;tự nhi&ecirc;n,&nbsp;k&iacute;ch th&iacute;ch tổng hợp&nbsp;<strong>Protein</strong>&nbsp;v&agrave;&nbsp;<strong>Collagen</strong>&nbsp;chống lại qu&aacute; tr&igrave;nh&nbsp;oxy h&oacute;a, cải thiện độ săn chắc v&agrave; đ&agrave;n hồi cho da, tăng hệ miễn dịch cho l&agrave;n da, nu&ocirc;i dưỡng l&agrave;n da tươi trẻ v&agrave; rạng rỡ.</p>\r\n\r\n<p>- Sản phẩm đ&atilde;&nbsp;được chứng minh l&acirc;m s&agrave;ng về khả năng dưỡng da&nbsp;săn chắc, cải thiện kết cấu&nbsp;mịn m&agrave;ng v&agrave; l&agrave;m&nbsp;đều m&agrave;u da.</p>\r\n\r\n<p>- Kết cấu&nbsp;mỏng nhẹ, thẩm thấu nhanh v&agrave; s&acirc;u v&agrave;o da, kh&ocirc;ng g&acirc;y bết d&iacute;nh.</p>\r\n\r\n<p><strong>&bull; Đối tượng khuy&ecirc;n d&ugrave;ng:</strong></p>\r\n\r\n<p>- D&ugrave;ng được cho mọi loại da, đặc biệt l&agrave; da nhạy cảm&nbsp;</p>\r\n\r\n<p>- L&agrave;n&nbsp;<a href=\"https://thegioiskinfood.com/collections/tai-tao-chong-lao-hoa\"><strong>da&nbsp;xuất hiện c&aacute;c dấu hiệu l&atilde;o ho&aacute;</strong></a>&nbsp;như: đốm n&acirc;u, nếp nhăn,&hellip;</p>\r\n\r\n<p>- D&agrave;nh cho l&agrave;n&nbsp;<a href=\"https://thegioiskinfood.com/collections/duong-trang-tri-tham\"><strong>da xỉn m&agrave;u, k&eacute;m tươi s&aacute;ng</strong></a></p>\r\n\r\n<p><strong>&bull; Hướng dẫn sử dụng:</strong>&nbsp;Nhỏ ba giọt serum Retinol B3 Serum sau khi d&ugrave;ng toner&nbsp;(Chỉ sử dụng Retinol v&agrave;o buổi tối). Sử dụng sản phẩm 2-3 lần một tuần trong thời gian đầu, sau đ&oacute; tăng l&ecirc;n 5-7 ng&agrave;y khi da th&iacute;ch ứng&nbsp;với Retinol.</p>\r\n\r\n<p><strong><em>***Lưu &yacute;:</em></strong></p>\r\n\r\n<p>- Tr&aacute;nh tiếp x&uacute;c trực tiếp với mắt v&agrave; m&ocirc;i.</p>\r\n\r\n<p>- Kh&ocirc;ng sử dụng với c&aacute;c sản phẩm Retinol kh&aacute;c.</p>\r\n\r\n<p>- Lu&ocirc;n sử dụng chỉ số SPF &gt;15+ v&agrave;o buổi s&aacute;ng (kể cả khi ở trong nh&agrave;), v&igrave; sản phẩm n&agrave;y c&oacute; thể l&agrave;m tăng độ nhạy cảm của da với &aacute;nh nắng mặt trời.</p>\r\n\r\n<p>- Khuy&ecirc;n d&ugrave;ng SPF 50+ cho da nhạy cảm</p>\r\n', 'Tinh Chất Giảm Thâm Nám & Nếp Nhăn, Chống Lão Hóa La Roche-Posay Retinol B3 Serum Anti-Wrinkle Concentrate Regenerating Resurfacing là dòng tinh chất Retinol đầu tiên của La Roche-Posay được nghiên cứu, chọn lọc kỹ càng bởi các chuyên gia da liễu để chống lại các dấu hiệu lão hoá ở da. Với công thức đặc biệt, Retinol B3 Serum là một giải pháp hoàn hảo cho làn da mất nước, nếp nhăn, không đều màu và thuộc tuýp da nhạy cảm', '1125000', '2022-04-08 12:36:02', 1),
(33, 13, 11, 31, 'Tinh Chất Làm Sáng Da Và Giảm Thâm Nám La Roche-Posay Redermic Pure Vitamin C10 Serum 30ml', '<p><strong>&bull; Đặc trưng:&nbsp;</strong></p>\r\n\r\n<p><strong>-&nbsp;Tinh Chất L&agrave;m S&aacute;ng Da V&agrave; Giảm Th&acirc;m N&aacute;m La Roche-Posay Redermic Pure Vitamin C10 Serum</strong>&nbsp;hiện tại đ&atilde; c&oacute; mặt tại<strong>&nbsp;<a href=\"https://thegioiskinfood.com/\">Thế Giới Skinfood</a></strong>&nbsp;chứa th&agrave;nh phần&nbsp;<strong>Vitamin C 10%</strong>&nbsp;th&agrave;nh phần chống oxy h&oacute;a gi&uacute;p ngăn ngừa &amp; khắc phục dấu hiệu l&atilde;o h&oacute;a da phổ biến như: da mất đ&agrave;n hồi, th&acirc;m n&aacute;m, xỉn m&agrave;u, nếp nhăn. Vitamin C đ&oacute;ng một vai tr&ograve; quan trọng trong việc duy tr&igrave; độ ẩm, tăng sản xuất collagen v&agrave; tăng độ s&aacute;ng của da.</p>\r\n\r\n<p>- Chứa th&agrave;nh phần&nbsp;<strong>Salicylic Acid</strong>&nbsp;một hoạt chất gi&uacute;p tẩy tế b&agrave;o chết nhẹ, hoạt chất n&agrave;y ph&aacute; vỡ c&aacute;c tế b&agrave;o kết d&iacute;nh lại với nhau. N&oacute; tẩy tế b&agrave;o chết v&agrave; l&agrave;m dịu c&ugrave;ng một l&uacute;c, v&agrave; thậm ch&iacute; c&oacute; đặc t&iacute;nh chống vi&ecirc;m, n&ecirc;n rất ph&ugrave; hợp với l&agrave;n da nhạy cảm.</p>\r\n\r\n<p>- Ngo&agrave;i ra chứa hoạt chất&nbsp;<strong>Neurosensine</strong>&nbsp;t&aacute;c động trực tiếp v&agrave;o cơ chế g&acirc;y k&iacute;ch ứng da. Hoạt chất n&agrave;y k&iacute;ch th&iacute;ch giải ph&oacute;ng c&aacute;c t&iacute;n hiệu chống lại Histamine, một hoạt chất trung gian rất quan trọng trong qu&aacute; tr&igrave;nh phản ứng dị ứng da.</p>\r\n\r\n<p><strong>-&nbsp;&nbsp;</strong>Chứa<strong>&nbsp;nước kho&aacute;ng La Roche-Posa</strong>y - nguồn năng lượng của thi&ecirc;n nhi&ecirc;n&nbsp;một sự kết hợp đặc biệt&nbsp;giữa kho&aacute;ng chất v&agrave; nguy&ecirc;n tố vi lượng gồm c&aacute;c th&agrave;nh phần thiết yếu nu&ocirc;i dưỡng l&agrave;n da như gi&agrave;u h&agrave;m lượng Selenium &amp; Oligo-Elenment&nbsp;c&oacute; khả năng chống oxy h&oacute;a mạnh mẽ, lập tức l&agrave;m dịu da v&agrave; giảm k&iacute;ch ứng.</p>\r\n\r\n<p>- Được c&aacute;c chuy&ecirc;n gia da liễu tr&ecirc;n to&agrave;n thế giới khuy&ecirc;n d&ugrave;ng.</p>\r\n\r\n<p><strong>&bull; Đối tượng khuy&ecirc;n d&ugrave;ng:</strong></p>\r\n\r\n<p>- D&agrave;nh cho mọi loại da</p>\r\n\r\n<p>- D&agrave;nh cho những l&agrave;n da tối m&agrave;u, kh&ocirc;ng đều m&agrave;u</p>\r\n\r\n<p>- D&agrave;nh cho những l&agrave;n da c&oacute; nhiều khuyết điểm như<a href=\"https://thegioiskinfood.com/collections/duong-trang-tri-tham\"><strong>&nbsp;th&acirc;m, n&aacute;m, t&agrave;n nhang</strong></a>,&nbsp;da kh&ocirc; r&aacute;p, sần s&ugrave;i, thiếu sức sống</p>\r\n\r\n<p><strong>&bull; Hướng dẫn sử dụng:&nbsp;</strong>Sử dụng sau bước toner, lấy một lượng serum vừa đủ. Thoa đều l&ecirc;n mặt v&agrave; vỗ nhẹ cho tinh chất thẩm thấu.</p>\r\n', 'Tinh Chất Làm Sáng Da Và Giảm Thâm Nám La Roche-Posay Redermic Pure Vitamin C10 Serum là tinh chất Giúp Làm Sáng Và Giảm Thâm Nám La Roche-Posay Redermic Pure Vitamin C10 Serum chứa thành phần chống lão hóa độc đáo với nồng độ Vitamin C nguyên chất cao, cùng với Salicylic Acid và hoạt chất làm dịu Neurosensine, ở độ pH lý tưởng giúp cải thiện làn da sạm màu, không đều màu phục hồi vẻ rạng rỡ của làn da  thuộc thương hiệu dược mỹ phẩm La Roche-Posay đến từ Pháp.', '1356000', '2022-04-08 12:39:16', 1),
(34, 3, 11, 30, 'Kem Chống Nắng Nâng Tông Da Sáng Hồng La Roche-Posay Uvidea Anthelios Tone-Up Rosy SPF50+ 30ml', '<p><strong>&bull; Đặc trưng:&nbsp;</strong></p>\r\n\r\n<p><strong>-&nbsp;Kem Chống Nắng N&acirc;ng T&ocirc;ng Da S&aacute;ng Hồng La Roche-Posay Uvidea Anthelios Tone-Up Rosy SPF50+&nbsp;</strong>hiện đ&atilde; c&oacute; mặt tại&nbsp;<a href=\"https://thegioiskinfood.com/\"><strong>Thế Giới SKinfood</strong></a>&nbsp;gi&uacute;p bảo vệ da khỏi tia UV &amp; m&ocirc;i trường &ocirc; nhiễm gi&uacute;p ngăn ngừa những t&aacute;c hại từ m&ocirc;i trường l&ecirc;n da như: da xỉn m&agrave;u, sạm da, l&atilde;o h&oacute;a,&nbsp;mang đến l&agrave;n da s&aacute;ng hồng, rạng rỡ tức th&igrave; với t&ocirc;ng m&agrave;u trắng hồng tự nhi&ecirc;n ph&ugrave; hợp cho da xỉn m&agrave;u v&agrave; t&ocirc;ng da v&agrave;ng ch&acirc;u &Aacute;.</p>\r\n\r\n<p><strong>- Chứa Mexoryl SX, Mexoryl XL, Uvinu A+</strong>&nbsp;tạo n&ecirc;n m&agrave;ng lọc bảo vệ da tối ưu khỏi tia UV &amp; &ocirc; nhiễm.</p>\r\n\r\n<p><strong>- Chứa Detoxyl, Venuceane, Vitamin E</strong>&nbsp;phức hợp chống oxy h&oacute;a, gi&uacute;p tăng cường h&agrave;ng r&agrave;o bảo vệ da, ngăn ngừa sạm n&aacute;m, l&atilde;o h&oacute;a, dưỡng s&aacute;ng da, cải thiện sắc tố gi&uacute;p da đều m&agrave;u.</p>\r\n\r\n<p><strong>- Chứa kho&aacute;ng chất thi&ecirc;n nhi&ecirc;n</strong>&nbsp;+&nbsp;<strong>TiO2 (Titanium Dioxide)</strong>&nbsp;n&acirc;ng t&ocirc;ng da tức th&igrave; một c&aacute;ch tự nhi&ecirc;n.</p>\r\n\r\n<p>- Chiết xuất&nbsp;<strong>hoa mẫu đơn</strong>&nbsp;nu&ocirc;i dưỡng l&agrave;n da s&aacute;ng dần, ức chế sự h&igrave;nh th&agrave;nh melanin, sắc tố da được cải thiện đều m&agrave;u hơn.</p>\r\n\r\n<p>- Chứa tảo&nbsp;<strong>VENUCEANE</strong>&nbsp;l&agrave; một hệ thống men chuyển h&oacute;a đa chức năng, c&oacute; một năng lực bảo vệ da tuyệt đối v&agrave; bền vững, chống lại c&aacute;c gốc h&oacute;a học tự do, tr&aacute;nh hư hỏng tế b&agrave;o v&agrave; tổn thương sợi Collage v&agrave; DNA khi &aacute;nh nắng c&agrave;ng mạnh. Hoạt động của&nbsp;<strong>VENUCEANE</strong>&nbsp;bền vững theo thời gian v&agrave; c&oacute; khả năng tự điều chỉnh, nhiệt độ/&aacute;p suất c&agrave;ng cao, tiếp x&uacute;c với nhiều chất độc hại hay sự chiếu xạ c&agrave;ng mạnh th&igrave; khả năng bảo vệ c&agrave;ng lớn.</p>\r\n\r\n<p>- Sản phẩm kh&ocirc;ng chứa th&agrave;nh phần g&acirc;y hại cho da như&nbsp;hương liệu, Paraben.</p>\r\n\r\n<p>- C&ocirc;ng thức kem chống nắng mỏng nhẹ, thẩm thấu nhanh ch&oacute;ng v&agrave; kh&ocirc;ng g&acirc;y bết r&iacute;t khi sử dụng. Hiệu ứng n&acirc;ng t&ocirc;ng s&aacute;ng hồng mang đến l&agrave;n&nbsp;da tươi s&aacute;ng v&agrave; tr&agrave;n đầy sức sống.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>&bull; Đối tượng khuy&ecirc;n d&ugrave;ng:</strong></p>\r\n\r\n<p>-&nbsp;D&agrave;nh cho da&nbsp;<a href=\"https://thegioiskinfood.com/collections/duong-am-da-thuong-da-kho\"><strong>thường/da kh&ocirc;/da hỗn hợp</strong></a></p>\r\n\r\n<p>- Ph&ugrave; hợp với những bạn l&agrave;m việc trong m&ocirc;i trường m&aacute;y lạnh</p>\r\n\r\n<p>- D&agrave;nh cho l&agrave;n da xỉn m&agrave;u, k&eacute;m tươi s&aacute;ng</p>\r\n\r\n<p><strong>&bull; Hướng dẫn sử dụng:&nbsp;</strong>D&ugrave;ng 1 lượng kem vừa đủ v&agrave; chia đều tr&ecirc;n mặt v&agrave; cổ, sau đ&oacute; thoa đều nhẹ nh&agrave;ng khắp mặt v&agrave; cổ. Sử dụng v&agrave;o ban ng&agrave;y, trước khi ra nắng 30 ph&uacute;t, sau c&aacute;c bước dưỡng da th&ocirc;ng thường, v&agrave; trước c&aacute;c bước trang điểm tiếp theo (nếu c&oacute;).</p>\r\n', 'Kem Chống Nắng Nâng Tông Da Sáng Hồng La Roche-Posay Uvidea Anthelios Tone-Up Rosy SPF50+ là dòng kem chống nắng nâng tông đến từ thương hiệu dược mỹ phẩm La Roche-Posay. Sản phẩm được nhiều chuyên gia da liễu khuyên dùng nhờ khả năng bao vệ da vượt trội trước ánh nắng mặt trời và ô nhiễm môi trường đồng thời hỗ trợ nâng tông, cải thiện tông da sáng hồng tự nhiên tức thì', '945000', '2022-04-08 12:41:31', 20),
(35, 9, 7, 197, '[50g] Nước Xịt Khoáng Cấp Ẩm Và Bảo Vệ Da Vichy Mineralizing Thermal Water', '<p><strong>&bull; Đặc trưng:&nbsp;</strong></p>\r\n\r\n<p>-&nbsp;<strong>Nước Xịt Kho&aacute;ng Cấp Ẩm V&agrave; Bảo Vệ Da Vichy Mineralizing Thermal Water</strong>&nbsp;hiện đ&atilde;&nbsp;&nbsp;c&oacute; mặt tại<strong>&nbsp;<a href=\"https://thegioiskinfood.com/\">Thế Giới Skinfood</a>&nbsp;</strong>với nguồn nước kho&aacute;ng được lấy từ t&acirc;m của n&uacute;i lửa Auvergne,&nbsp; nơi tập trung những nguồn nước kho&aacute;ng lớn nhất ở Ph&aacute;p.<strong>&nbsp;Nước kho&aacute;ng Vichy</strong>&nbsp;v&agrave; c&aacute;c kho&aacute;ng chất gi&uacute;p tăng cường h&agrave;ng r&agrave;o độ ẩm tự nhi&ecirc;n v&agrave; bảo vệ l&agrave;n da của bạn khỏi c&aacute;c t&aacute;c nh&acirc;n g&acirc;y hại từ m&ocirc;i trường - l&agrave; một trong những nguy&ecirc;n nh&acirc;n g&acirc;y n&ecirc;n l&atilde;o h&oacute;a sớm.</p>\r\n\r\n<p>- C&aacute;c kho&aacute;ng chất c&oacute; trong nước kho&aacute;ng Vichy gi&uacute;p l&agrave;n da được c&acirc;n bằng độ pH, cấp nước tức th&igrave; v&agrave; giữ ẩm cho l&agrave;n da từ c&aacute;c kho&aacute;ng chất như&nbsp;<strong>Sodium, Potassium v&agrave; Hydrogenocarbonates</strong></p>\r\n\r\n<p>- C&aacute;c kho&aacute;ng chất như&nbsp;<strong>Boron, Calcium, Lithium v&agrave; Strontium</strong>&nbsp;c&oacute; khả năng l&agrave;m dịu da nhanh ch&oacute;ng, bảo vệ v&agrave; kh&aacute;ng khuẩn cho l&agrave;n da.</p>\r\n\r\n<p>- Đặc biệt, c&aacute;c kho&aacute;ng chất như<strong>&nbsp;Iron,&nbsp;Fluorine,&nbsp;Magnesium</strong>&nbsp;v&agrave;&nbsp;<strong>Silicium</strong>&nbsp;c&oacute; khả năng chống oxy h&oacute;a hiệu quả v&agrave; k&iacute;ch th&iacute;ch t&aacute;i tạo c&aacute;c tế b&agrave;o da</p>\r\n\r\n<p><strong>&bull; Đối tượng khuy&ecirc;n d&ugrave;ng:&nbsp;</strong></p>\r\n\r\n<p>- D&agrave;nh cho mọi loại da, kể cả&nbsp;<a href=\"https://thegioiskinfood.com/search?type=product&amp;q=filter=(title:product%20adjacent%20da%20nh%E1%BA%A1y%20c%E1%BA%A3m)||(title:product%20**%20da%20nh%E1%BA%A1y%20c%E1%BA%A3m)||(sku:product**%20da%20nh%E1%BA%A1y%20c%E1%BA%A3m)||(vendor:product%20contains%20da%20nh%E1%BA%A1y%20c%E1%BA%A3m)\"><strong>da nhạy cảm</strong></a></p>\r\n\r\n<p>- D&agrave;nh cho l&agrave;n da kh&ocirc; r&aacute;p, thiếu nước v&agrave; mất sức sống</p>\r\n\r\n<p>- D&agrave;nh cho những l&agrave;n da mỏng manh, yếu ớt thường xuy&ecirc;n bị k&iacute;ch ứng, mệt mỏi bởi c&aacute;c t&aacute;c động của m&ocirc;i trường b&ecirc;n ngo&agrave;i</p>\r\n\r\n<p><strong>&bull; Hướng dẫn sử dụng:&nbsp;</strong>&nbsp;Để b&igrave;nh xịt c&aacute;ch xa mặt khoảng 20cm v&agrave; xịt đều xung quanh bề mặt da</p>\r\n\r\n<p>- Ngay sau khi rửa mặt gi&uacute;p h&igrave;nh th&agrave;nh ngay lớp m&agrave;ng dưỡng ẩm v&agrave; cấp nước nhanh ch&oacute;ng cho da</p>\r\n\r\n<p>- Trước khi trang điểm gi&uacute;p da mềm mại, đủ ẩm để c&oacute; lớp nền căng b&oacute;ng v&agrave; mịn m&agrave;ng hơn</p>\r\n\r\n<p>- Ngay sau khi trang điểm gi&uacute;p giữ được độ tươi mới cho lớp nền rạng rỡ</p>\r\n\r\n<p>- Khi lớp trang điểm bị kh&ocirc; v&agrave; sần x&ugrave;i gi&uacute;p lớp nền trở n&ecirc;n ẩm mịn, mịn m&agrave;ng, tươi mới trở lại</p>\r\n', 'Nước Xịt Khoáng Cấp Ẩm Và Bảo Vệ Da Vichy Mineralizing Thermal Water là xịt khoáng với công thức đặc biệt từ nước khoáng Vichy hoàn toàn tự nhiên chứa 15 khoáng chất quý hiếm như sắt, potassium, canxi, manganese,.. giúp tăng khả năng miễn dịch và củng cố kết cấu cho làn da, nhanh chóng làm dịu làn da hiệu quả thuộc thương hiệu Vichy  đến từ Pháp', '165000', '2022-04-08 12:44:50', 3),
(36, 4, 7, 10, 'Sữa Rửa Mặt Tạo Bọt Ngừa Mụn & Làm Sạch Sâu Vichy Normaderm Anti-imperfection Deep Cleansing Foaming Cream 125ml', '<p><strong>&bull; Đặc trưng:&nbsp;</strong></p>\r\n\r\n<p><strong>Sữa Rửa Mặt Tạo Bọt Ngừa Mụn &amp; L&agrave;m Sạch S&acirc;u Vichy Normaderm Anti-imperfection Deep Cleansing Foaming Cream&nbsp;</strong>hiện nay sản phẩm đ&atilde; c&oacute; mặt tại&nbsp;<strong><a href=\"https://thegioiskinfood.com/\">Thế Giới Skinfood</a>&nbsp;</strong>c&oacute; t&aacute;c dụng l&agrave;m sạch&nbsp;ho&agrave;n to&agrave;n bụi bẩn, da chết v&agrave; b&atilde; nhờn gi&uacute;p se kh&iacute;t lỗ ch&acirc;n l&ocirc;ng, ngừa mụn hiệu quả v&agrave; thanh lọc l&agrave;n da.</p>\r\n\r\n<p><strong>-&nbsp;Salycilic Acid&nbsp;</strong>c&oacute; khả năng kh&aacute;ng khuẩn, kh&aacute;ng vi&ecirc;m nhẹ v&agrave; l&agrave;m sạch s&acirc;u gi&uacute;p lỗ ch&acirc;n l&ocirc;ng được th&ocirc;ng tho&aacute;ng, bụi bẩn v&agrave; b&atilde; nhờn kh&ocirc;ng c&ograve;n đọng lại tr&ecirc;n da ngăn chặn tối đa t&aacute;c nh&acirc;n g&acirc;y ra mụn. Ngo&agrave;i ra, Salycilic Acid c&oacute; t&aacute;c dụng hiệu quả trong việc kiểm so&aacute;t dầu v&agrave; khi ngấm s&acirc;u v&agrave;o da gi&uacute;p lấy đi c&aacute;c tế b&agrave;o chết một c&aacute;ch nhẹ nh&agrave;ng gi&uacute;p da mềm mịn hơn</p>\r\n\r\n<p><strong>-&nbsp;Stearic Acid, Palmitic Acid&nbsp;</strong>l&agrave; c&aacute;c axit b&eacute;o c&oacute; nguồn gốc từ thực vật, c&oacute; chức năng như một chất hoạt động bề mặt nhưng lại c&oacute; khả năng l&agrave;m dịu v&agrave; l&agrave;m mềm cho l&agrave;n da kh&aacute; tốt. Đặc biệt l&agrave; đặc t&iacute;nh kh&aacute;ng vi&ecirc;m v&agrave; kh&aacute;ng khuẩn v&agrave; gi&uacute;p phục hồi chức năng h&agrave;ng r&agrave;o bảo vệ tự nhi&ecirc;n của da gi&uacute;p ngăn ngừa v&agrave; phục hồi c&aacute;c tổn thương da khi da bị k&iacute;ch ứng như đau r&aacute;t, vi&ecirc;m, tấy đỏ do t&aacute;c động từ b&ecirc;n ngo&agrave;i</p>\r\n\r\n<p><strong>- Ngo&agrave;i ra, Lauric Acid</strong>&nbsp;cũng thuộc nh&oacute;m axit b&eacute;o, c&oacute; khả năng ngăn chặn vi khuẩn khiến mụn l&acirc;y lan tr&ecirc;n da, từ đ&oacute; chống nấm v&agrave; giảm vi&ecirc;m do mụn hiệu quả. Hơn nữa, n&oacute; c&ograve;n gi&uacute;p giảm qu&aacute; tr&igrave;nh l&atilde;o h&oacute;a của tế b&agrave;o da, c&acirc;n bằng độ pH v&agrave; duy tr&igrave; độ ẩm tối đa cho da.</p>\r\n\r\n<p>-&nbsp;Th&agrave;nh phần&nbsp;<strong>Glycerin</strong>&nbsp;c&oacute; cơ chế hoạt động l&agrave; hấp thụ nước từ m&ocirc;i trường b&ecirc;n ngo&agrave;i gi&uacute;p cung cấp độ ẩm cần thiết một c&aacute;ch tự nhi&ecirc;n, tạo một lớp m&agrave;ng bảo vệ da, hạn chế sự tho&aacute;t hơi nước tr&ecirc;n bề mặt da, khiến da kh&ocirc;ng bị kh&ocirc;, mất hơi nước, lu&ocirc;n duy tr&igrave; độ ẩm cho da khiến da lu&ocirc;n được mịn m&agrave;ng.</p>\r\n\r\n<p>- C&ocirc;ng thức gi&agrave;u<strong>&nbsp;nước kho&aacute;ng n&uacute;i lửa Vichy</strong>&nbsp;gi&uacute;p cấp nước, l&agrave;m dịu da tức th&igrave;, chống oxy h&oacute;a - bảo vệ da trước t&aacute;c động của gốc tự do trong &aacute;nh nắng,&nbsp;củng cố &amp; phục hồi h&agrave;ng r&agrave;o bảo vệ da.</p>\r\n\r\n<p>- Kết cấu dạng kem mềm mịn, tạo bọt b&ocirc;ng mịn.&nbsp;Được c&aacute;c chuy&ecirc;n gia da liễu khuy&ecirc;n d&ugrave;ng. Với nguồn nước kho&aacute;ng Vichy ph&ugrave; hợp với l&agrave;n da Ch&acirc;u &Aacute; nhạy cảm.</p>\r\n\r\n<p><strong>&bull; Đối tượng khuy&ecirc;n d&ugrave;ng:</strong></p>\r\n\r\n<p>- D&agrave;nh cho mọi loại da&nbsp;</p>\r\n\r\n<p>- D&agrave;nh cho l&agrave;n&nbsp;<a href=\"https://thegioiskinfood.com/collections/cap-nuoc-giam-dau\"><strong>da dầu, tiết nhiều b&atilde; nhờn</strong></a>,&nbsp;<a href=\"https://thegioiskinfood.com/collections/mun-do-kich-ung\"><strong>da dầu mụn</strong></a></p>\r\n\r\n<p><strong>&bull; Hướng dẫn sử dụng:</strong>&nbsp;Sau khi tẩy trang, lấy một lượng sản phẩm vừa đủ v&agrave;o l&ograve;ng b&agrave;n tay, tạo bọt đều khắp mặt v&agrave; rửa sạch với nước.</p>\r\n', 'Sữa Rửa Mặt Tạo Bọt Ngừa Mụn & Làm Sạch Sâu Vichy Normaderm Anti-imperfection Deep Cleansing Foaming Cream là sữa rửa mặt chứa thành phần có hiệu quả cao đối với làn da dầu, mụn - Salicylic Acid giúp kiểm soát nhờn trên da, kháng viêm và giảm mụn cùng với kết cấu tạo bọt bông mịn làm sạch sâu bã nhờn giúp lỗ chân lông thông thoáng  thuộc thương hiệu dược mỹ phẩm Vichy đến từ Pháp', '345000', '2022-04-08 12:46:59', 17),
(37, 7, 7, 21, 'Nước Tẩy Trang Dành Cho Da Dầu Mụn Vichy Normaderm 3-in-1 Micellar Solution 200ml', '<p><strong>&bull; Đặc trưng:</strong></p>\r\n\r\n<p><strong>-&nbsp;Nước Tẩy Trang Danh Cho Da Dầu Mụn Vichy Normaderm 3-in-1 Micellar Solution&nbsp;</strong>hiện nay sản phẩm đ&atilde; c&oacute; mặt tại&nbsp;<strong><a href=\"https://thegioiskinfood.com/\">Thế Giới Skinfood</a>,&nbsp;</strong>sử dụng c&ocirc;ng nghệ<strong>&nbsp;Micellar</strong>&nbsp;chứa c&aacute;c hạt ph&acirc;n tử Mixen si&ecirc;u nhỏ c&oacute; khả năng l&agrave;m sạch&nbsp;b&atilde; nhờn, lớp trang điểm v&agrave;&nbsp;c&aacute;c tạp chất g&acirc;y ra bởi c&aacute;c t&aacute;c hại b&ecirc;n ngo&agrave;i,&nbsp;gi&uacute;p l&agrave;n da được sạch s&acirc;u, dưỡng ẩm,&nbsp;th&ocirc;ng tho&aacute;ng lỗ ch&acirc;n l&ocirc;ng, nu&ocirc;i dưỡng l&agrave;n da khỏe mạnh từ s&acirc;u b&ecirc;n trong.</p>\r\n\r\n<p><strong>-&nbsp;Chứa kẽm PCA</strong>&nbsp;gi&uacute;p giữ&nbsp;ẩm, kh&aacute;ng khuẩn,&nbsp;kh&aacute;ng vi&ecirc;m, điều tiết lượng dầu tr&ecirc;n da, ngăn ngừa vi khuẩn g&acirc;y mụn, thu nhỏ lỗ ch&acirc;n l&ocirc;ng,&nbsp;tăng độ đ&agrave;n hồi v&agrave; săn chắc cho da, gi&uacute;p l&agrave;m chậm qu&aacute; tr&igrave;nh&nbsp;l&atilde;o h&oacute;a da.</p>\r\n\r\n<p>- C&ocirc;ng thức gi&agrave;u h&agrave;m lượng&nbsp;<strong>nước kho&aacute;ng n&uacute;i lửa Vichy</strong>&nbsp;gi&uacute;p cấp ẩm s&acirc;u, l&agrave;m dịu da, chống oxy h&oacute;a,&nbsp;bảo vệ da trước c&aacute;c&nbsp;t&aacute;c động b&ecirc;n ngo&agrave;i, phục hồi v&agrave; củng cố&nbsp;h&agrave;ng r&agrave;o bảo vệ da.</p>\r\n\r\n<p>- Đ&atilde; được kiểm kiệm da liễu kh&ocirc;ng g&acirc;y k&iacute;ch ứng, kh&ocirc;ng chứa Paraben,&nbsp;kh&ocirc;ng chất bảo quản.</p>\r\n\r\n<p>- Kết cấu dạng nước,&nbsp;mỏng nhẹ, thẩm thấu nhanh, dễ d&agrave;ng lấy đi bụi bẩn v&agrave; lớp trang điểm,&nbsp;kh&ocirc;ng g&acirc;y nhờn d&iacute;nh kh&oacute; chịu, mang lại cảm gi&aacute;c tươi mới, kh&ocirc; tho&aacute;ng.</p>\r\n\r\n<p><strong>&bull; Đối tượng khuy&ecirc;n d&ugrave;ng:</strong></p>\r\n\r\n<p>- D&agrave;nh cho l&agrave;n&nbsp;<a href=\"http://xn--%20hin%20nay%20sn%20phm%20%20c%20mt%20ti%20th%20gii%20skinfood-i7e01h37cc900h7cawtx5a5piq10c/\"><strong>da dầu, hoặc hỗn hợp thi&ecirc;n dầu</strong></a></p>\r\n\r\n<p>- D&agrave;nh cho l&agrave;n da c&oacute; nhiều khuyết điểm như mụn hay vết th&acirc;m mụn</p>\r\n\r\n<p>- D&agrave;nh cho l&agrave;n da sần s&ugrave;i, mất sức sống</p>\r\n\r\n<p><strong>&bull; Hướng dẫn sử dụng:</strong>&nbsp;Lấy&nbsp;1 lượng vừa đủ&nbsp;thấm&nbsp;v&agrave;o b&ocirc;ng tẩy trang v&agrave;&nbsp;lau nhẹ nh&agrave;ng&nbsp;tr&ecirc;n mặt theo chiều kết cấu da để lấy&nbsp;đi&nbsp;bụi bẩn v&agrave; lớp trang điểm.</p>\r\n', 'Nước Tẩy Trang Dành Cho Da Dầu Mụn Vichy Normaderm 3-in-1 Micellar Solution  là nước tẩy trang chứa các thành phần hoạt tính được sử dụng trong da liễu có thể làm sạch bụi bẩn, bã nhờn và lớp trang điểm, giúp da thông thoáng, sạch sâu, ngăn ngừa vi khuẩn gây mụn, mang lại làn da tươi tắn, khỏe đẹp thuộc thương hiệu dược mỹ phẩm Vichy đến từ Pháp', '370000', '2022-04-08 12:49:55', 4),
(39, 14, 12, 10, '[Phiên Bản Giới Hạn] Bộ quà tặng Estée Lauder 4 món gồm Serum Advanced Night Repair 50ml + Tinh chất Micro Essence 30ml + Tinh chất Reset 5ml + Kem dưỡng mắt Eye Supercharged 5ml (Giá trị thực 4,910,000d)', '<p>Điểm mới: C&ocirc;ng nghệ Sức Mạnh T&iacute;n Hiệu Nguồn ChronoluxTM = Phục hồi nhanh hơn + Sức mạnh trẻ h&oacute;a da<br />\r\nPhục hồi nhanh hơn: khởi động v&agrave; tối ưu h&oacute;a sự phục hồi tự nhi&ecirc;n của da từ c&aacute;c t&aacute;c động h&agrave;ng ng&agrave;y của m&ocirc;i trường - nhanh hơn.<br />\r\nC&ocirc;ng nghệ trẻ h&oacute;a: Gi&uacute;p l&agrave;n da tăng cường sự sinh sản collagen tự nhi&ecirc;n v&agrave; t&aacute;i tạo tế b&agrave;o da mới. Ngay lập tức da cảm nhận săn chắc hơn.</p>\r\n\r\n<p>MỘT GIỌT:<br />\r\nL&agrave;n da rạng rỡ v&agrave; căng mọng đủ ẩm.<br />\r\nSức mạnh chống oxy h&oacute;a suốt 8h v&agrave;o ban ng&agrave;y<br />\r\nHyaluronic Acid c&ocirc; đặc &amp; giữ nước đến 72h v&agrave;o ban đ&ecirc;m</p>\r\n\r\n<p><br />\r\nBA TUẦN:<br />\r\nNếp nhăn giảm 25%.<br />\r\nNgay lập tức, l&agrave;n da săn chắc hơn.&nbsp;<br />\r\n90% phụ nữ đ&atilde; d&ugrave;ng v&agrave; đồng &yacute;.</p>\r\n\r\n<p>MỘT CHAI<br />\r\nLỗ ch&acirc;n l&ocirc;ng được cải thiện. L&agrave;n da tr&ocirc;ng khỏe hơn, đ&agrave;n hồi v&agrave; đầy sức sống.</p>\r\n\r\n<p>Ban đ&ecirc;m: Khi bạn ngủ, Advanced Night Repair NHANH CH&Oacute;NG gi&uacute;p tối ưu h&oacute;a qu&aacute; tr&igrave;nh phục hồi tự nhi&ecirc;n của da v&agrave;o ban đ&ecirc;m! Th&ecirc;m v&agrave;o đ&oacute;, c&ocirc;ng dụng MỚI giữ ẩm đến 72h gi&uacute;p tạo ra m&ocirc;i trường l&yacute; tưởng để tối ưu h&oacute;a qu&aacute; tr&igrave;nh phục hồi tự nhi&ecirc;n của l&agrave;n da. &nbsp; &nbsp;&nbsp;</p>\r\n\r\n<p>Ban ng&agrave;y: Bảo vệ da trước những t&aacute;c nh&acirc;n g&acirc;y hại của m&ocirc;i trường. NGAY LẬP TỨC, c&ocirc;ng dụng MỚI bảo vệ sự chống oxi h&oacute;a to&agrave;n diện của da đến 8h. &nbsp;&nbsp;</p>\r\n\r\n<p>Mọi dấu hiệu l&atilde;o h&oacute;a&mdash;Sử dụng đều v&agrave;o ban ng&agrave;y cũng như ban đ&ecirc;m gi&uacute;p l&agrave;m giảm c&aacute;c dấu hiệu l&atilde;o h&oacute;a c&oacute; thể nh&igrave;n thấy được như đường nhăn, nếp nhăn, sự kh&ocirc;ng đều m&agrave;u của da, sự mất nước, th&ecirc;m v&agrave;o đ&oacute;, c&ocirc;ng dụng MỚI gi&uacute;p giảm nhanh hơn nếp nhăn, t&igrave;nh trạng da k&eacute;m săn chắc v&agrave; l&agrave;m thu nhỏ lỗ ch&acirc;n l&ocirc;ng. &nbsp;</p>\r\n\r\n<p>D&agrave;nh cho tất cả mọi người&mdash;mọi chủng tộc, mọi độ tuổi, mọi loại da.</p>\r\n\r\n<p>C&aacute;ch sử dụng:&nbsp;<br />\r\n- L&agrave;m ấm sản phẩm trong c&aacute;c ng&oacute;n tay v&agrave; mat xa tr&ecirc;n gương mặt theo chuyển động h&igrave;nh tim.<br />\r\n- Lướt nhẹ xuống xương h&agrave;m v&agrave; kết th&uacute;c ngay dưới cằm.<br />\r\n- Kết th&uacute;c với động t&aacute;c vuốt nhẹ cổ theo chiều đi xuống</p>\r\n\r\n<p><br />\r\nĐiểm mới: C&ocirc;ng nghệ Sức Mạnh T&iacute;n Hiệu Nguồn ChronoluxTM = Phục hồi nhanh hơn + Sức mạnh trẻ h&oacute;a da<br />\r\nPhục hồi nhanh hơn: khởi động v&agrave; tối ưu h&oacute;a sự phục hồi tự nhi&ecirc;n của da từ c&aacute;c t&aacute;c động h&agrave;ng ng&agrave;y của m&ocirc;i trường - nhanh hơn.<br />\r\nC&ocirc;ng nghệ trẻ h&oacute;a: Gi&uacute;p l&agrave;n da tăng cường sự sinh sản collagen tự nhi&ecirc;n v&agrave; t&aacute;i tạo tế b&agrave;o da mới. Ngay lập tức da cảm nhận săn chắc hơn.</p>\r\n\r\n<p>MỘT GIỌT:<br />\r\nL&agrave;n da rạng rỡ v&agrave; căng mọng đủ ẩm.<br />\r\nSức mạnh chống oxy h&oacute;a suốt 8h v&agrave;o ban ng&agrave;y<br />\r\nHyaluronic Acid c&ocirc; đặc &amp; giữ nước đến 72h v&agrave;o ban đ&ecirc;m</p>\r\n\r\n<p><br />\r\nBA TUẦN:<br />\r\nNếp nhăn giảm 25%.<br />\r\nNgay lập tức, l&agrave;n da săn chắc hơn.&nbsp;<br />\r\n90% phụ nữ đ&atilde; d&ugrave;ng v&agrave; đồng &yacute;.</p>\r\n\r\n<p>MỘT CHAI<br />\r\nLỗ ch&acirc;n l&ocirc;ng được cải thiện. L&agrave;n da tr&ocirc;ng khỏe hơn, đ&agrave;n hồi v&agrave; đầy sức sống.</p>\r\n\r\n<p>Ban đ&ecirc;m: Khi bạn ngủ, Advanced Night Repair NHANH CH&Oacute;NG gi&uacute;p tối ưu h&oacute;a qu&aacute; tr&igrave;nh phục hồi tự nhi&ecirc;n của da v&agrave;o ban đ&ecirc;m! Th&ecirc;m v&agrave;o đ&oacute;, c&ocirc;ng dụng MỚI giữ ẩm đến 72h gi&uacute;p tạo ra m&ocirc;i trường l&yacute; tưởng để tối ưu h&oacute;a qu&aacute; tr&igrave;nh phục hồi tự nhi&ecirc;n của l&agrave;n da. &nbsp; &nbsp;&nbsp;</p>\r\n\r\n<p>Ban ng&agrave;y: Bảo vệ da trước những t&aacute;c nh&acirc;n g&acirc;y hại của m&ocirc;i trường. NGAY LẬP TỨC, c&ocirc;ng dụng MỚI bảo vệ sự chống oxi h&oacute;a to&agrave;n diện của da đến 8h. &nbsp;&nbsp;</p>\r\n\r\n<p>Mọi dấu hiệu l&atilde;o h&oacute;a&mdash;Sử dụng đều v&agrave;o ban ng&agrave;y cũng như ban đ&ecirc;m gi&uacute;p l&agrave;m giảm c&aacute;c dấu hiệu l&atilde;o h&oacute;a c&oacute; thể nh&igrave;n thấy được như đường nhăn, nếp nhăn, sự kh&ocirc;ng đều m&agrave;u của da, sự mất nước, th&ecirc;m v&agrave;o đ&oacute;, c&ocirc;ng dụng MỚI gi&uacute;p giảm nhanh hơn nếp nhăn, t&igrave;nh trạng da k&eacute;m săn chắc v&agrave; l&agrave;m thu nhỏ lỗ ch&acirc;n l&ocirc;ng. &nbsp;</p>\r\n\r\n<p>D&agrave;nh cho tất cả mọi người&mdash;mọi chủng tộc, mọi độ tuổi, mọi loại da.</p>\r\n\r\n<p>C&aacute;ch sử dụng:&nbsp;<br />\r\n- L&agrave;m ấm sản phẩm trong c&aacute;c ng&oacute;n tay v&agrave; mat xa tr&ecirc;n gương mặt theo chuyển động h&igrave;nh tim.<br />\r\n- Lướt nhẹ xuống xương h&agrave;m v&agrave; kết th&uacute;c ngay dưới cằm.<br />\r\n- Kết th&uacute;c với động t&aacute;c vuốt nhẹ cổ theo chiều đi xuống</p>\r\n', 'Set quà tuyệt vời bao gồm serum Advanced Night Repair fullsize 50ml - dòng dưỡng da nổi tiếng toàn cầu tiên tiến nhất mang đến cho bạn làn da rạng rỡ, tươi trẻ. Sử dụng hằng ngày theo liệu trình này sẽ giúp bạn ngăn ngừa và giảm dần các nếp nhăn lão hóa.', '2999000', '2022-05-16 20:39:25', 0),
(40, 14, 12, 12, '[Phiên Bản Giới Hạn] Bộ quà tặng Estée Lauder 3 món gồm Sữa rửa mặt Micro Cleansing Foam 30ml + Seurm Advanced Night Repar 7ml + Kem dưỡng mắt Eye Supercharged 5ml (Giá trị thực: 1,620,000đ)', '<p>Điểm mới: C&ocirc;ng nghệ Sức Mạnh T&iacute;n Hiệu Nguồn ChronoluxTM = Phục hồi nhanh hơn + Sức mạnh trẻ h&oacute;a da<br />\r\nPhục hồi nhanh hơn: khởi động v&agrave; tối ưu h&oacute;a sự phục hồi tự nhi&ecirc;n của da từ c&aacute;c t&aacute;c động h&agrave;ng ng&agrave;y của m&ocirc;i trường - nhanh hơn.<br />\r\nC&ocirc;ng nghệ trẻ h&oacute;a: Gi&uacute;p l&agrave;n da tăng cường sự sinh sản collagen tự nhi&ecirc;n v&agrave; t&aacute;i tạo tế b&agrave;o da mới. Ngay lập tức da cảm nhận săn chắc hơn.</p>\r\n\r\n<p>MỘT GIỌT:<br />\r\nL&agrave;n da rạng rỡ v&agrave; căng mọng đủ ẩm.<br />\r\nSức mạnh chống oxy h&oacute;a suốt 8h v&agrave;o ban ng&agrave;y<br />\r\nHyaluronic Acid c&ocirc; đặc &amp; giữ nước đến 72h v&agrave;o ban đ&ecirc;m</p>\r\n\r\n<p><br />\r\nBA TUẦN:<br />\r\nNếp nhăn giảm 25%.<br />\r\nNgay lập tức, l&agrave;n da săn chắc hơn.&nbsp;<br />\r\n90% phụ nữ đ&atilde; d&ugrave;ng v&agrave; đồng &yacute;.</p>\r\n\r\n<p>MỘT CHAI<br />\r\nLỗ ch&acirc;n l&ocirc;ng được cải thiện. L&agrave;n da tr&ocirc;ng khỏe hơn, đ&agrave;n hồi v&agrave; đầy sức sống.</p>\r\n\r\n<p>Ban đ&ecirc;m: Khi bạn ngủ, Advanced Night Repair NHANH CH&Oacute;NG gi&uacute;p tối ưu h&oacute;a qu&aacute; tr&igrave;nh phục hồi tự nhi&ecirc;n của da v&agrave;o ban đ&ecirc;m! Th&ecirc;m v&agrave;o đ&oacute;, c&ocirc;ng dụng MỚI giữ ẩm đến 72h gi&uacute;p tạo ra m&ocirc;i trường l&yacute; tưởng để tối ưu h&oacute;a qu&aacute; tr&igrave;nh phục hồi tự nhi&ecirc;n của l&agrave;n da. &nbsp; &nbsp;&nbsp;</p>\r\n\r\n<p>Ban ng&agrave;y: Bảo vệ da trước những t&aacute;c nh&acirc;n g&acirc;y hại của m&ocirc;i trường. NGAY LẬP TỨC, c&ocirc;ng dụng MỚI bảo vệ sự chống oxi h&oacute;a to&agrave;n diện của da đến 8h. &nbsp;&nbsp;</p>\r\n\r\n<p>Mọi dấu hiệu l&atilde;o h&oacute;a&mdash;Sử dụng đều v&agrave;o ban ng&agrave;y cũng như ban đ&ecirc;m gi&uacute;p l&agrave;m giảm c&aacute;c dấu hiệu l&atilde;o h&oacute;a c&oacute; thể nh&igrave;n thấy được như đường nhăn, nếp nhăn, sự kh&ocirc;ng đều m&agrave;u của da, sự mất nước, th&ecirc;m v&agrave;o đ&oacute;, c&ocirc;ng dụng MỚI gi&uacute;p giảm nhanh hơn nếp nhăn, t&igrave;nh trạng da k&eacute;m săn chắc v&agrave; l&agrave;m thu nhỏ lỗ ch&acirc;n l&ocirc;ng. &nbsp;</p>\r\n\r\n<p>D&agrave;nh cho tất cả mọi người&mdash;mọi chủng tộc, mọi độ tuổi, mọi loại da.</p>\r\n\r\n<p>C&aacute;ch sử dụng:&nbsp;<br />\r\n- L&agrave;m ấm sản phẩm trong c&aacute;c ng&oacute;n tay v&agrave; mat xa tr&ecirc;n gương mặt theo chuyển động h&igrave;nh tim.<br />\r\n- Lướt nhẹ xuống xương h&agrave;m v&agrave; kết th&uacute;c ngay dưới cằm.<br />\r\n- Kết th&uacute;c với động t&aacute;c vuốt nhẹ cổ theo chiều đi xuống</p>\r\n', 'Điểm mới: Công nghệ Sức Mạnh Tín Hiệu Nguồn ChronoluxTM = Phục hồi nhanh hơn + Sức mạnh trẻ hóa da\r\nPhục hồi nhanh hơn: khởi động và tối ưu hóa sự phục hồi tự nhiên của da từ các tác động hàng ngày của môi trường - nhanh hơn.\r\nCông nghệ trẻ hóa: Giúp làn da tăng cường sự sinh sản collagen tự nhiên và tái tạo tế bào da mới. Ngay lập tức da cảm nhận săn chắc hơn.', '689000', '2022-05-16 20:53:16', 5),
(41, 3, 13, 28, 'Kem chống nắng có màu che phủ tự nhiên Lancome UV Expert BB COMPLETE 2 SPF 50+ PA++++ 30ml – Tone tự nhiên', '<p>Lanc&ocirc;me l&agrave; nh&atilde;n hiệu chuy&ecirc;n về nước hoa, c&aacute;c sản phẩm chăm s&oacute;c da v&agrave; mỹ phẩm make-up cao cấp được th&agrave;nh lập bởi Armand Petitjean v&agrave;o năm 1935. T&ecirc;n gọi của thương hiệu n&agrave;y được Petitjean lấy cảm hứng từ t&ograve;a l&acirc;u đ&agrave;i &quot;Le Ch&acirc;teau de Lancosme&quot;, nằm ở v&ugrave;ng ngoại &ocirc; Indre của nước Ph&aacute;p - địa danh nổi tiếng với những đ&oacute;a hồng hoang d&atilde; đẹp v&agrave; thơm. Hoa hồng cũng được chọn trở th&agrave;nh biểu tượng của thương hiệu, đại diện cho vẻ đẹp qu&yacute; ph&aacute;i, ki&ecirc;u kỳ v&agrave; sang trọng của nước Ph&aacute;p trong tinh thần Lancome. Kh&ocirc;ng chỉ l&agrave; vẻ đẹp của h&igrave;nh thức b&ecirc;n ngo&agrave;i, th&agrave;nh phần chất lượng cao b&ecirc;n trong, ph&iacute;a sau mỗi sản phẩm của Lancome đều c&oacute; một c&acirc;u chuyện, một cung bậc ri&ecirc;ng chạm tới cảm x&uacute;c của người d&ugrave;ng.</p>\r\n\r\n<p>Năm 1964, Lanc&ocirc;me được tập đo&agrave;n L&#39;Oreal mua lại v&agrave; được đầu tư hơn về mọi mặt để tiếp tục sứ mệnh t&ocirc;n vinh vẻ đẹp ri&ecirc;ng của mỗi người phụ nữ, gi&uacute;p họ tự tin hơn bất kể người đ&oacute; ở độ tuổi n&agrave;o v&agrave; đang sống trong ho&agrave;n cảnh n&agrave;o. Hiện nay, c&aacute;c sản phẩm của Lanc&ocirc;me như nước hoa, kem che khuyết điểm, mascara nổi trội, d&ograve;ng phấn Absolue, kẻ mắt nước, phấn mắt, son m&ocirc;i... đ&atilde; c&oacute; mặt rộng r&atilde;i v&agrave; được y&ecirc;u th&iacute;ch tại nhiều quốc gia tr&ecirc;n khắp thế giới, trong đ&oacute; c&oacute; Việt Nam.</p>\r\n', 'UV Expert BB Complete là kem bảo vệ đa năng chứa thành phần hoa Tuyết Nhung giúp da chống lại những tác nhân có hại hàng ngày như tia UV và ô nhiễm*. Công nghệ bao phủ của sản phẩm sẽ giúp làn da thêm tươi sáng và đều màu. Chất kem không nhờn rít, không bết dính, mỏng nhẹ và thẩm thấu nhanh.Dưỡng da mượt mà, mịn đẹp và trẻ trung hơn.Giúp mang đến sắc da tự nhiên và che đi khuyết điểm.Công thức được nghiên cứu và thử nghiệm dành cho làn da châu Á.Các lựa chọn:– Complete 1 – tông màu sáng– Complete 2 – tông màu tự nhiên*Chống lại sự bám dính của những tác nhân ô nhiễm như bụi bẩn…', '1550000', '2022-05-16 20:57:59', 5),
(42, 10, 12, 21, 'Kem dưỡng làm sáng, mờ thâm và căng mịn da Lancome Clarifique Brightening Milky Cream 50ml', '<p>Kem dưỡng v&agrave; l&agrave;m s&aacute;ng da Lanc&ocirc;me Clarifique Brightening Milky Cream với c&ocirc;ng thức từ chiết xuất chồi c&acirc;y gỗ sồi Ph&aacute;p, th&uacute;c đẩy qu&aacute; tr&igrave;nh t&aacute;i tạo tự nhi&ecirc;n của l&agrave;n da. Sự kết hợp th&agrave;nh phần bao gồm hợp chất mạnh mẽ của gốc Vitamin C v&agrave; Niacinamide, sẽ gi&uacute;p l&agrave;n da rạng rỡ v&agrave; đều m&agrave;u hơn hẳn.</p>\r\n\r\n<p>TH&Ocirc;NG TIN CHI TIẾT:</p>\r\n\r\n<p>Loại sản phẩm:</p>\r\n\r\n<p>- Kem dưỡng v&agrave; l&agrave;m s&aacute;ng da</p>\r\n\r\n<p><br />\r\nTh&agrave;nh phần:</p>\r\n\r\n<p>- C&ocirc;ng thức từ chiết xuất chồi c&acirc;y gỗ sồi Ph&aacute;p- Hợp chất mạnh mẽ của gốc Vitamin C v&agrave; Niacinamide</p>\r\n\r\n<p><br />\r\nC&ocirc;ng dụng:</p>\r\n\r\n<p>- Th&uacute;c đẩy qu&aacute; tr&igrave;nh t&aacute;i tạo tự nhi&ecirc;n của l&agrave;n da.</p>\r\n\r\n<p>- Cải thiện v&agrave; l&agrave;m đều m&agrave;u da hiệu quả</p>\r\n\r\n<p>- Gi&uacute;p da th&ecirc;m rạng rỡ v&agrave; tươi tắn hơn</p>\r\n\r\n<p><br />\r\nHướng dẫn sử dụng:</p>\r\n\r\n<p>- Bước 1: Lấy một lượng bằng hạt đậu l&ecirc;n đầu ng&oacute;n tay.</p>\r\n\r\n<p>- Bước 2: Massage l&ecirc;n mặt theo chuyển động tr&ograve;n, bắt đầu từ v&ugrave;ng m&aacute; đến tr&aacute;n v&agrave; phần c&ograve;n lại của mặt v&agrave; cổ. D&ugrave;ng mỗi s&aacute;ng v&agrave; tối như bước dưỡng cuối c&ugrave;ng của da. Sau đ&oacute; d&ugrave;ng kem chống nắng.</p>\r\n\r\n<p><br />\r\nHướng dẫn bảo quản:</p>\r\n\r\n<p>- Nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, tr&aacute;nh &aacute;nh nắng trực tiếp</p>\r\n\r\n<p><br />\r\nXuất xứ thương hiệu: Ph&aacute;p</p>\r\n\r\n<p>Hạn sử dụng: 03 năm kể từ NSX (NSX: xem &quot;MFG&quot; tr&ecirc;n bao b&igrave;)</p>\r\n', 'Kem dưỡng và làm sáng da Lancôme Clarifique Brightening Milky Cream với công thức từ chiết xuất chồi cây gỗ sồi Pháp, thúc đẩy quá trình tái tạo tự nhiên của làn da. Sự kết hợp thành phần bao gồm hợp chất mạnh mẽ của gốc Vitamin C và Niacinamide, sẽ giúp làn da rạng rỡ và đều màu hơn hẳn.', '2199000', '2022-05-16 21:00:38', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `productimage`
--

CREATE TABLE `productimage` (
  `idImage` int(11) UNSIGNED NOT NULL,
  `idProduct` int(11) UNSIGNED NOT NULL,
  `ImageName` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `productimage`
--

INSERT INTO `productimage` (`idImage`, `idProduct`, `ImageName`) VALUES
(30, 7, 'a_e05534208e1b4d008343fd2b3b6718ce_master.jpg'),
(31, 7, '2_8140428284af4351be4af47bae4f3ba3_1024x1024_ca5550217dfe4ec2ad602cf42a98a74c_1024x1024.jpg'),
(35, 9, '4afc3d74c43c1ee4e40733717eb01d6f.jpg'),
(36, 9, '3015668-1_a9994f7e0c724335b8d3e593a7e0c9b2_1024x1024.jpg'),
(37, 9, 'L1.jpg'),
(38, 10, '25951111961c96db79b6f15d2c769949.jpg'),
(39, 10, 'kem-duong-da-mat-chong-lao-hoa-estee-lauder-supreme-50ml-0.jpg'),
(40, 10, '5eb7820c45e7c3c4cd66d034ea0a261d.jpg'),
(41, 11, 'lancome-absolue-revitalizing-eye-cream-20-ml-1637844884.jpg'),
(42, 11, '7db3fafdc4a6cb6040f6643cbd84e956.jpg'),
(43, 11, 'absolue-rich-cream-with-grand-rose-extract.jpg'),
(44, 12, '2c7ca918bda01686618bd33e00c01820.jpg'),
(45, 12, 'e9dddd4da561154ce7399921abe89853.jpg'),
(46, 12, '5e52752a65ef64e51a9152c91e6daeab.png'),
(51, 13, 'd3cfdae70b75655e7f562446c9e2f757.jpg'),
(52, 13, 'cedaaadce085a2aec89d2f54ef6605e3.jpg'),
(57, 14, 'tinh-chat-la-roche-posay-giam-mun-3-tac-dong-30ml-5_img_358x358_843626_fit_center.jpg'),
(58, 14, 'facebook-dynamic-tinh-chat-la-roche-posay-giam-mun-3-tac-dong-30ml_img_358x358_843626_fit_center.jpg'),
(59, 15, 'lr1.jpg'),
(60, 15, 'lr2.jpg'),
(61, 15, 'lr3.jpg'),
(62, 16, 'lr4.jpg'),
(63, 16, 'lr5.jpg'),
(65, 17, 'lc2.png'),
(66, 17, 'lc3.png'),
(67, 17, 'lc4.png'),
(68, 17, 'lc5.png'),
(69, 18, 'es1.png'),
(70, 18, 'es2.png'),
(71, 18, 'es3.png'),
(72, 19, 'vichy3.png'),
(73, 19, 'vichy1.png'),
(74, 19, 'vichy2.jpg'),
(75, 20, 'vichy2c.jpg'),
(76, 20, 'vichy2b.jpg'),
(77, 20, 'vichy2a.jpg'),
(78, 21, 'vichy3c.jpg'),
(79, 21, 'vichy3b.jpg'),
(80, 21, 'vichy3a.jpg'),
(81, 22, 'e1c.jpg'),
(82, 22, 'e1b.jpg'),
(83, 22, 'e1a.jpg'),
(84, 23, 'e2c.jpg'),
(85, 23, 'e2b.jpg'),
(86, 23, 'e2a.jpg'),
(87, 24, 'e3c.jpg'),
(88, 24, 'e3b.jpg'),
(89, 24, 'e3a.jpg'),
(90, 25, 'e4c.jpg'),
(91, 25, 'e4b.jpg'),
(92, 25, 'e4a.jpg'),
(93, 26, 'la1c.jpg'),
(94, 26, 'la1b.jpg'),
(95, 26, 'la1a.jpg'),
(96, 27, 'la2a.jpg'),
(97, 27, 'la2b.jpg'),
(98, 27, 'la2c.jpg'),
(99, 28, 'la3c.jpg'),
(100, 28, 'la3b.jpg'),
(101, 28, 'la3a.jpg'),
(102, 29, 'la4c.jpg'),
(103, 29, 'la4b.jpg'),
(104, 29, 'la4a.jpg'),
(105, 30, 'lr2c.png'),
(106, 30, 'lr2b.png'),
(107, 30, 'lr1a.png'),
(111, 32, 'lr3c.png'),
(112, 32, 'lr3b.png'),
(113, 32, 'lr3a.png'),
(114, 33, 'lr4c.jpg'),
(115, 33, 'lr4b.jpg'),
(116, 33, 'lr4a.jpg'),
(117, 34, 'lr5c.jpg'),
(118, 34, 'lr5b.jpg'),
(119, 34, 'lr5a.jpg'),
(120, 35, 'v1c.jpg'),
(121, 35, 'v1b.jpg'),
(122, 35, 'v1a.jpg'),
(129, 37, 'v2c.jpg'),
(130, 37, 'v2b.jpg'),
(131, 37, 'v2a.jpg'),
(132, 36, 'v4b.jpg'),
(133, 36, 'v4a.jpg'),
(135, 39, 'es6.png'),
(136, 39, 'es7.png'),
(137, 39, 'es8.png'),
(138, 39, 'es9.png'),
(139, 40, 'es10.png'),
(140, 41, 'lc6.png'),
(141, 41, 'lc7.png'),
(142, 41, 'lc8.png'),
(143, 42, 'lc9.png'),
(144, 42, 'lc10.png'),
(145, 42, 'lc11.png'),
(146, 42, 'lc12.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `saleproduct`
--

CREATE TABLE `saleproduct` (
  `idSale` int(11) NOT NULL,
  `idProduct` int(10) UNSIGNED NOT NULL,
  `SaleName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `SaleStart` datetime NOT NULL,
  `SaleEnd` datetime NOT NULL,
  `Discount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `saleproduct`
--

INSERT INTO `saleproduct` (`idSale`, `idProduct`, `SaleName`, `SaleStart`, `SaleEnd`, `Discount`) VALUES
(3, 36, 'Sale Lễ 30/4 - 1/5', '2022-05-05 22:45:00', '2022-05-25 22:45:00', 15),
(4, 34, 'Sale Lễ 30/4 - 1/5', '2022-05-05 22:45:00', '2022-05-25 22:45:00', 30),
(5, 32, 'Sale Lễ 30/4 - 1/5', '2022-05-05 22:45:00', '2022-05-25 22:45:00', 30),
(6, 30, 'Sale Lễ 30/4 - 1/5', '2022-05-05 22:45:00', '2022-05-25 22:45:00', 30),
(7, 26, 'Sale Lễ 30/4 - 1/5', '2022-05-05 22:45:00', '2022-05-25 22:45:00', 30),
(8, 23, 'Sale Lễ 30/4 - 1/5', '2022-05-05 22:45:00', '2022-05-25 22:45:00', 30),
(9, 22, 'Sale Lễ 30/4 - 1/5', '2022-05-05 22:45:00', '2022-05-25 22:45:00', 30),
(10, 18, 'Sale Lễ 30/4 - 1/5', '2022-05-05 22:45:00', '2022-05-25 22:45:00', 30),
(11, 15, 'Sale Lễ 30/4 - 1/5', '2022-05-05 22:45:00', '2022-05-25 22:45:00', 30),
(12, 14, 'Sale Lễ 30/4 - 1/5', '2022-05-05 22:45:00', '2022-05-25 22:45:00', 30),
(13, 10, 'Sale Lễ 30/4 - 1/5', '2022-05-05 22:45:00', '2022-05-25 22:45:00', 30),
(14, 7, 'Sale Lễ 30/4 - 1/5', '2022-05-05 22:45:00', '2022-05-25 22:45:00', 30),
(15, 21, 'Khuyến mãi tháng 5', '2022-05-15 18:50:00', '2022-05-31 18:50:00', 30);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wishlist`
--

CREATE TABLE `wishlist` (
  `idWish` int(11) UNSIGNED NOT NULL,
  `idCustomer` int(11) UNSIGNED NOT NULL,
  `idProduct` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `wishlist`
--

INSERT INTO `wishlist` (`idWish`, `idCustomer`, `idProduct`) VALUES
(12, 1, 14),
(17, 1, 35),
(16, 1, 36),
(15, 1, 37),
(10, 5, 13),
(8, 5, 14),
(13, 6, 13),
(22, 7, 9),
(18, 7, 34),
(19, 7, 35),
(20, 7, 41),
(21, 7, 42);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `addresscustomer`
--
ALTER TABLE `addresscustomer`
  ADD PRIMARY KEY (`idAddress`),
  ADD KEY `idCustomer` (`idCustomer`);

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idAdmin`),
  ADD UNIQUE KEY `AdminUser` (`AdminUser`);

--
-- Chỉ mục cho bảng `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`idBill`),
  ADD KEY `idAdmin` (`idAdmin`,`idCustomer`),
  ADD KEY `idCustomer` (`idCustomer`),
  ADD KEY `idAddress` (`idAddress`);

--
-- Chỉ mục cho bảng `billinfo`
--
ALTER TABLE `billinfo`
  ADD KEY `idBill` (`idBill`,`idProduct`),
  ADD KEY `idCart` (`idProduct`);

--
-- Chỉ mục cho bảng `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`idBlog`),
  ADD KEY `idProduct` (`idProduct`);

--
-- Chỉ mục cho bảng `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`idBrand`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`idCart`),
  ADD KEY `idCustomer` (`idCustomer`,`idProduct`),
  ADD KEY `idProduct` (`idProduct`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`idCategory`);

--
-- Chỉ mục cho bảng `compare`
--
ALTER TABLE `compare`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCustomer` (`idCustomer`),
  ADD KEY `idProduct` (`idProduct`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`idCustomer`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`idProduct`),
  ADD KEY `idCategory` (`idCategory`,`idBrand`),
  ADD KEY `idBrand` (`idBrand`);

--
-- Chỉ mục cho bảng `productimage`
--
ALTER TABLE `productimage`
  ADD PRIMARY KEY (`idImage`),
  ADD KEY `idProduct` (`idProduct`);

--
-- Chỉ mục cho bảng `saleproduct`
--
ALTER TABLE `saleproduct`
  ADD PRIMARY KEY (`idSale`),
  ADD KEY `idProduct` (`idProduct`);

--
-- Chỉ mục cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`idWish`),
  ADD KEY `idCustomer` (`idCustomer`,`idProduct`),
  ADD KEY `idProduct` (`idProduct`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `addresscustomer`
--
ALTER TABLE `addresscustomer`
  MODIFY `idAddress` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `idAdmin` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `bill`
--
ALTER TABLE `bill`
  MODIFY `idBill` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT cho bảng `blog`
--
ALTER TABLE `blog`
  MODIFY `idBlog` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `brand`
--
ALTER TABLE `brand`
  MODIFY `idBrand` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `idCart` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `idCategory` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `compare`
--
ALTER TABLE `compare`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `idCustomer` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `idProduct` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT cho bảng `productimage`
--
ALTER TABLE `productimage`
  MODIFY `idImage` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT cho bảng `saleproduct`
--
ALTER TABLE `saleproduct`
  MODIFY `idSale` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `idWish` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `addresscustomer`
--
ALTER TABLE `addresscustomer`
  ADD CONSTRAINT `AddressCustomer_ibfk_1` FOREIGN KEY (`idCustomer`) REFERENCES `customer` (`idCustomer`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `Bill_ibfk_1` FOREIGN KEY (`idCustomer`) REFERENCES `customer` (`idCustomer`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `Bill_ibfk_2` FOREIGN KEY (`idAddress`) REFERENCES `addresscustomer` (`idAddress`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `Bill_ibfk_3` FOREIGN KEY (`idAdmin`) REFERENCES `admin` (`idAdmin`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `billinfo`
--
ALTER TABLE `billinfo`
  ADD CONSTRAINT `BillInfo_ibfk_1` FOREIGN KEY (`idBill`) REFERENCES `bill` (`idBill`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `BillInfo_ibfk_4` FOREIGN KEY (`idProduct`) REFERENCES `product` (`idProduct`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `Blog_ibfk_1` FOREIGN KEY (`idProduct`) REFERENCES `product` (`idProduct`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `Cart_ibfk_1` FOREIGN KEY (`idCustomer`) REFERENCES `customer` (`idCustomer`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `Cart_ibfk_2` FOREIGN KEY (`idProduct`) REFERENCES `product` (`idProduct`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `compare`
--
ALTER TABLE `compare`
  ADD CONSTRAINT `Compare_ibfk_1` FOREIGN KEY (`idCustomer`) REFERENCES `customer` (`idCustomer`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `Compare_ibfk_2` FOREIGN KEY (`idProduct`) REFERENCES `product` (`idProduct`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `Product_ibfk_1` FOREIGN KEY (`idCategory`) REFERENCES `category` (`idCategory`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `Product_ibfk_2` FOREIGN KEY (`idBrand`) REFERENCES `brand` (`idBrand`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `productimage`
--
ALTER TABLE `productimage`
  ADD CONSTRAINT `ProductImage_ibfk_1` FOREIGN KEY (`idProduct`) REFERENCES `product` (`idProduct`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `saleproduct`
--
ALTER TABLE `saleproduct`
  ADD CONSTRAINT `SaleProduct_ibfk_1` FOREIGN KEY (`idProduct`) REFERENCES `product` (`idProduct`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `WishList_ibfk_1` FOREIGN KEY (`idCustomer`) REFERENCES `customer` (`idCustomer`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `WishList_ibfk_2` FOREIGN KEY (`idProduct`) REFERENCES `product` (`idProduct`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
