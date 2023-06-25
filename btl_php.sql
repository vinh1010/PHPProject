-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 12, 2021 lúc 10:46 AM
-- Phiên bản máy phục vụ: 10.4.20-MariaDB
-- Phiên bản PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `btl_php`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `status`) VALUES
(1, 'Fresh Fruit', 1),
(2, 'Dried Foods', 1),
(4, 'Meat', 1),
(5, 'Vegetable', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `total_price` float NOT NULL,
  `address_ship` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `note` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `id_user`, `total_price`, `address_ship`, `phone`, `note`, `status`, `created_at`) VALUES
(1, 1, 20, 'Long Phu - Hoa Thach - Quoc Oai', '0971976699', '', 4, '2021-08-02 06:41:58'),
(2, 2, 63, 'Long Phu - Hoa Thach - Quoc Oai', '0971976699', '', 4, '2021-08-03 09:00:33'),
(3, 2, 14, 'Long Phu - Hoa Thach - Quoc Oai', '0971976699', '', 4, '2021-08-03 11:46:21'),
(4, 2, 60, 'Long Phu - Hoa Thach - Quoc Oai', '0971976699', '', 4, '2021-08-04 06:39:46'),
(5, 3, 12, 'Long Phu - Hoa Thach - Quoc Oai', '0971976699', '', 4, '2021-08-04 09:10:41');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `id_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_detail`
--

INSERT INTO `order_detail` (`id_order`, `id_product`, `price`, `quantity`, `image`, `name`, `created_at`) VALUES
(1, 4, 8, 1, 'Dried Peach.png', 'Dried Peach', '2021-08-02 06:41:58'),
(1, 19, 12, 1, 'apple.png', 'Apple', '2021-08-02 06:41:58'),
(2, 11, 27, 2, 'Walnut Isolated.png', 'Walnut Isolated', '2021-08-03 09:00:33'),
(2, 2, 9, 1, 'Dried Banana.png', 'Dried Banana', '2021-08-03 09:00:33'),
(3, 2, 9, 1, 'Dried Banana.png', 'Dried Banana', '2021-08-03 11:46:21'),
(3, 33, 5, 1, 'Tomato.png', 'Tomato', '2021-08-03 11:46:21'),
(4, 13, 20, 2, 'Beaf.png', 'Beaf', '2021-08-04 06:39:46'),
(4, 14, 20, 1, 'Birds Eggs.png', 'Birds Eggs', '2021-08-04 06:39:46'),
(5, 19, 12, 1, 'apple.png', 'Apple', '2021-08-04 09:10:41');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `sale_price` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name`, `image`, `category_id`, `price`, `sale_price`, `status`, `description`, `created_at`) VALUES
(1, 'Dehydrated Ginged', 'Dehydrated Ginged.png', 2, 14, 0, 1, '', '2021-08-02 06:22:52'),
(2, 'Dried Banana', 'Dried Banana.png', 2, 15, 9, 1, '', '2021-08-02 06:23:18'),
(3, 'Dried Cherries', 'Dried Cherries.png', 2, 17, 0, 1, '', '2021-08-02 06:23:42'),
(4, 'Dried Peach', 'Dried Peach.png', 2, 16, 8, 1, '', '2021-08-02 06:24:16'),
(5, 'Dried Red', 'Dried Red.png', 2, 20, 0, 1, '', '2021-08-02 06:24:44'),
(6, 'Dry Dates', 'Dry Dates.png', 2, 12, 0, 1, '', '2021-08-02 06:25:04'),
(7, 'Dry Orejon', 'Dry Orejon.png', 2, 19, 10, 1, '', '2021-08-02 06:25:27'),
(8, 'Fried Cashew', 'Fried Cashew.png', 2, 16, 0, 1, '', '2021-08-02 06:25:46'),
(9, 'Nuts Exotic', 'Nuts Exotic.png', 2, 18, 9, 1, '', '2021-08-02 06:26:09'),
(10, 'Nuts', 'Nuts.png', 2, 10, 0, 1, '', '2021-08-02 06:26:32'),
(11, 'Walnut Isolated', 'Walnut Isolated.png', 2, 30, 27, 1, '', '2021-08-02 06:26:58'),
(12, 'Red Beans', 'Nuts2.png', 2, 17, 0, 1, '', '2021-08-02 06:27:45'),
(13, 'Beaf', 'Beaf.png', 4, 20, 0, 1, '', '2021-08-02 06:30:10'),
(14, 'Birds Eggs', 'Birds Eggs.png', 4, 24, 20, 1, '', '2021-08-02 06:30:37'),
(15, 'Chicken Leg', 'Chicken Leg.png', 4, 20, 0, 1, '', '2021-08-02 06:31:13'),
(16, 'Chicken', 'Chicken.png', 4, 19, 0, 1, '', '2021-08-02 06:31:30'),
(17, 'Eggs', 'Eggs.png', 4, 17, 0, 1, '', '2021-08-02 06:31:52'),
(18, 'Meat', 'Meat.png', 4, 25, 0, 1, '', '2021-08-02 06:32:17'),
(19, 'Apple', 'apple.png', 1, 12, 0, 1, '', '2021-08-02 06:32:46'),
(20, 'Banana', 'banana.png', 1, 11, 5, 1, '', '2021-08-02 06:33:06'),
(21, 'Blueberries', 'blueberries.png', 1, 15, 0, 1, '', '2021-08-02 06:33:31'),
(22, 'Citrus', 'citrus.png', 1, 6, 0, 1, '', '2021-08-02 06:33:52'),
(23, 'Coconut', 'coconut.png', 1, 13, 0, 1, '', '2021-08-02 06:34:11'),
(24, 'Nectarine', 'nectarine.png', 1, 12, 0, 1, '', '2021-08-02 06:34:31'),
(25, 'Orange', 'orange.png', 1, 10, 0, 1, '', '2021-08-02 06:34:53'),
(26, 'Strawberry', 'strawberry-food.png', 1, 14, 9, 1, '', '2021-08-02 06:35:16'),
(27, 'Avocado', 'Avocado.png', 5, 6, 0, 1, '', '2021-08-02 06:35:37'),
(28, 'Brinjal', 'Brinjal.png', 5, 8, 5, 1, '', '2021-08-02 06:35:54'),
(29, 'Galic', 'Galic.png', 5, 7, 0, 1, '', '2021-08-02 06:36:08'),
(30, 'Kale', 'Kale.png', 5, 2, 0, 1, '', '2021-08-02 06:36:20'),
(31, 'Leaves', 'Leaves.png', 5, 3, 0, 1, '', '2021-08-02 06:36:32'),
(32, 'Red Beet', 'Red Beet.png', 5, 5, 0, 1, '', '2021-08-02 06:36:44'),
(33, 'Tomato', 'Tomato.png', 5, 7, 5, 1, '', '2021-08-02 06:36:58'),
(34, 'Yellow paper', 'Yellow paper.png', 5, 10, 0, 1, '', '2021-08-02 06:37:10'),
(35, 'Zucchini', 'Zucchini.png', 5, 12, 8, 1, '', '2021-08-02 06:37:40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `role` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'customer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `phone`, `role`, `created_at`) VALUES
(1, 'Vinh Nguyen', 'ducvinh10102002@gmail.com', '$2y$10$iex9WOAX0WR/FHYMUVv8bu9HCoLwzzG9xvW4opogIy1lnh8U110We', NULL, 'admin', '2021-08-02 05:59:57'),
(2, 'Admin', 'admin@gmail.com', '$2y$10$cgBNmRSYwfg0zEGHpFsGe.J0YLYdg1WteHXYWzF1LUCoiWz6DHOk.', NULL, 'customer', '2021-08-03 09:00:01'),
(3, 'Nguyen A', 'nguyena@gmail.com', '$2y$10$bvoMT1P7sInhlaaXJQwVUuZ8FriMkiepeGw553oB3iLLHz/hCvxj.', NULL, 'customer', '2021-08-04 09:04:33');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_user` (`id_user`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD KEY `order_ordetail` (`id_order`),
  ADD KEY `ordetail_product` (`id_product`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pro_cate` (`category_id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `order_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Các ràng buộc cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_ordetail` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `ordetail_product` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `pro_cate` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
