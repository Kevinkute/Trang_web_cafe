-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 12, 2024 lúc 01:42 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanlycafe`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account_inf`
--

CREATE TABLE `account_inf` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `admin` int(11) NOT NULL,
  `email` text NOT NULL,
  `reset_code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `account_inf`
--

INSERT INTO `account_inf` (`id`, `username`, `password`, `admin`, `email`, `reset_code`) VALUES
(1, 'cuong', '1', 1, 'cuong@gmail.com', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `category` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`, `category`) VALUES
(1, 'Espresso', 'Espresso là một loại cà phê đậm đà được chiết xuất từ hạt cà phê nguyên chất. Được pha chế bằng máy pha cà phê chuyên dụng, Espresso mang đến hương vị đậm đà và hương thơm đặc trưng', 50000, 'Đồ uống'),
(2, 'Latte', 'Latte là sự kết hợp hoàn hảo giữa espresso và sữa tươi, tạo nên hương vị nhẹ nhàng, béo ngậy và thơm ngon. Latte thường được trang trí với lớp bọt sữa mịn màng.', 55000, 'Đồ uống'),
(3, 'Cappuccino', 'Cappuccino là một loại cà phê được pha chế từ espresso, sữa nóng và bọt sữa. Hương vị đậm đà của espresso hòa quyện với sự béo ngậy của sữa, tạo nên một thức uống hoàn hảo.', 60000, 'Đồ uống'),
(4, 'Bánh Chocolate', 'Bánh Chocolate là món bánh ngọt hoàn hảo với lớp bánh mềm mịn và hương vị chocolate đậm đà. Bánh được làm từ nguyên liệu tươi ngon, đảm bảo mang đến trải nghiệm tuyệt vời cho thực khách.', 70000, 'Bánh'),
(5, 'Cheesecake', 'Cheesecake là món bánh kết hợp giữa lớp kem phô mai mềm mịn và đế bánh quy giòn tan. Bánh mang đến hương vị thơm ngon, béo ngậy, là sự lựa chọn hoàn hảo cho những ai yêu thích các món bánh ngọt.', 75000, 'Bánh'),
(6, 'Bánh Red Velvet', 'Bánh Red Velvet là sự kết hợp hoàn hảo giữa màu đỏ quyến rũ và vị ngọt ngào của kem phô mai. Bánh có kết cấu mềm mịn, hương vị thơm ngon và đẹp mắt, là lựa chọn lý tưởng cho các dịp đặc biệt.', 80000, 'Bánh');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `tong` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `ngay` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sales`
--

INSERT INTO `sales` (`id`, `tong`, `soluong`, `ngay`) VALUES
(1, 1000000, 100, '2024-12-10'),
(2, 2200000, 120, '0000-00-00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `phone` int(11) NOT NULL,
  `adress` text NOT NULL,
  `salary` text NOT NULL,
  `position` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `staff`
--

INSERT INTO `staff` (`id`, `name`, `phone`, `adress`, `salary`, `position`) VALUES
(1, 'toan', 912345678, 'số 1 nhà A, phố B đường C', '25000', 'rank B');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
