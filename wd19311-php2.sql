-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th3 27, 2025 lúc 02:48 PM
-- Phiên bản máy phục vụ: 8.0.30
-- Phiên bản PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `wd19311-php2`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdonhang`
--

CREATE TABLE `chitietdonhang` (
  `id` int NOT NULL,
  `id_dh` int NOT NULL,
  `id_sp` int NOT NULL,
  `soluong` int NOT NULL,
  `giaban` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`id`, `id_dh`, `id_sp`, `soluong`, `giaban`) VALUES
(41, 123, 1, 1, 450000),
(42, 124, 3, 1, 350000),
(43, 124, 7, 1, 490000),
(44, 125, 2, 2, 350000),
(45, 125, 7, 1, 490000),
(46, 125, 4, 1, 350000),
(47, 126, 3, 1, 350000),
(48, 127, 3, 1, 350000),
(49, 127, 2, 1, 350000),
(50, 128, 1, 1, 450000),
(51, 129, 1, 1, 450000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmuc`
--

CREATE TABLE `danhmuc` (
  `id` int NOT NULL,
  `tendm` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `danhmuc`
--

INSERT INTO `danhmuc` (`id`, `tendm`) VALUES
(1, 'Nhẫn'),
(2, 'Khuyên Tai '),
(3, 'Vòng Tay '),
(9, 'Dây Chuyền');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `id` int NOT NULL,
  `ngaydat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `soluongSP` int NOT NULL,
  `tongtien` int NOT NULL,
  `magg` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trangthai` set('Chờ xác nhận','Đang giao hàng','Giao thành công','Đơn bị hủy') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Chờ xác nhận',
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`id`, `ngaydat`, `soluongSP`, `tongtien`, `magg`, `trangthai`, `id_user`) VALUES
(123, '2025-02-26 17:46:28', 1, 450000, NULL, 'Đang giao hàng', 14),
(124, '2025-02-26 17:50:27', 2, 840000, NULL, 'Giao thành công', 14),
(125, '2025-02-27 17:18:55', 4, 1540000, NULL, 'Giao thành công', 14),
(126, '2025-02-27 17:19:03', 1, 350000, NULL, 'Đang giao hàng', 14),
(127, '2025-02-27 17:25:45', 2, 700000, NULL, 'Chờ xác nhận', 13),
(128, '2025-02-27 18:31:26', 1, 450000, NULL, 'Chờ xác nhận', 14),
(129, '2025-02-27 18:45:12', 1, 450000, NULL, 'Đang giao hàng', 14);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `id_sp` int NOT NULL,
  `soluong` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `id` int NOT NULL,
  `ten` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hinh` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gia` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sale` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mota` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ngaydang` date NOT NULL,
  `id_dm` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`id`, `ten`, `hinh`, `gia`, `sale`, `mota`, `ngaydang`, `id_dm`) VALUES
(1, 'R MIDI PINK SUN AND PINK CIRCLE', 'nhan.webp', '450000', '480.000', 'fsdfadsf', '2025-02-02', 1),
(2, 'E STUD LINE BUTTERFLY EM', 'bongtai3.webp\r\n', '350000', '370000', 'cDFDSV', '2025-02-02', 2),
(3, 'E STUD FAT BUBBLE HEART HALF TINY GEM', 'bongtai1.webp', '350000', '', '', '2025-01-22', 2),
(4, 'E STUD BIG CLOVER HEART GEM', 'bongtai2.webp', '350000', '', '', '2025-01-22', 2),
(6, 'TR SIMPLE TWIST OXIDIZE', 'nhan2.webp', '270000', '', '', '2025-01-13', 1),
(7, 'R MIDI PRINCESS BIG GEM', 'nhan3.webp', '490000', '', '', '2025-02-03', 1),
(8, 'R MIDI PRINCESS CIRCLE GEM', 'nhan4.webp', '390000', '', '', '2025-01-19', 1),
(9, 'BRA HALF BRAIDED AND DOUBLE CIRCLE BUTTERFLY DOUBLE BALL OVAL CHAIN', 'vong2.webp', '990000', '', '', '2025-01-17', 3),
(10, 'BRA CRESCENT MOON MULTI GEM AND CIRCLE GEM', 'vong3.webp', '390000', '', '', '2025-01-14', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sdt` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vaitro` enum('user','admin') COLLATE utf8mb4_unicode_ci DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `sdt`, `vaitro`) VALUES
(13, 'hehe', '11111', 'dsvagdfhb@gmail.com', '0683481365', 'user'),
(14, 'admin', '11111', 'asd@hagmail.com', '0683481365', 'admin'),
(15, 'trangsuc123', '1', 'minh123@gmail.com', '0683481365', 'user'),
(22, 'minhaaa', '111111', 'minh1223@gmail.com', '0123143267', 'admin');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_dh` (`id_dh`,`id_sp`),
  ADD KEY `id_sp` (`id_sp`);

--
-- Chỉ mục cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_TK` (`id_user`),
  ADD KEY `magg` (`magg`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`,`id_sp`),
  ADD KEY `id_sp` (`id_sp`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_dm` (`id_dm`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT cho bảng `giohang`
--
ALTER TABLE `giohang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Ràng buộc đối với các bảng kết xuất
--

--
-- Ràng buộc cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD CONSTRAINT `chitietdonhang_ibfk_2` FOREIGN KEY (`id_sp`) REFERENCES `sanpham` (`id`),
  ADD CONSTRAINT `chitietdonhang_ibfk_3` FOREIGN KEY (`id_dh`) REFERENCES `donhang` (`id`);

--
-- Ràng buộc cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `donhang_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`id_dm`) REFERENCES `danhmuc` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
