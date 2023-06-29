-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 29, 2023 lúc 12:40 PM
-- Phiên bản máy phục vụ: 10.4.20-MariaDB
-- Phiên bản PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `manager`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `clients`
--

CREATE TABLE `clients` (
  `ID` bigint(20) NOT NULL,
  `Fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Gender` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CreatedBy` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `clients`
--

INSERT INTO `clients` (`ID`, `Fullname`, `Email`, `Address`, `Gender`, `CreatedBy`) VALUES
(32, 'admin', 'admin@gmail.com', 'Bình Giang', '1', 32),
(86, 'Phạm Tuyết Anh', 'aaaaa2@gmail.com', 'Bình Giang', 'nu', 86),
(87, 'Phạm Tuyết Anh', 'pppoo@gmail.com', 'Bình Giang', 'nu', 87),
(106, 'Anh', 'pha2@gmail.com', 'Bình Giang', 'nu', 106),
(121, 'Phạm Tuyết Anh', 'poiv@gmail.com', 'Bình Giang', 'nu', 121),
(123, 'Phạm Tuyết Anh', 'hhhhh@gmail.com', 'Bình Giang', 'nu', 123);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tokens`
--

CREATE TABLE `tokens` (
  `ID_token` int(11) NOT NULL,
  `token` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tokens`
--

INSERT INTO `tokens` (`ID_token`, `token`) VALUES
(1, 'd54bd6c893a1509b60d412f1e19857a8fba2c701dfa182a28cc765ed42c79d5a'),
(2, 'bd8fde11becffbe46fbe0bf59c3c7c8230e075422e7fbbdf6244b889b48643be'),
(6, '291cfa74dbb1018d2ffde1bdfe314307efd726d889479dbb05981a206f3a6f26'),
(7, '4cd9f35ad95fe4e5e55f5e46265c5c8506a509a91825540bdf4b63037ce59c0a'),
(9, 'e46499ff49fb833d64923dc8f8ad0e0ddcbd0e1c29dfacaa10db41c61a6b00b2'),
(10, 'fd145b3af1420cd1737450e6fb4580b7489e1b942b72eac5eb56d0db81b15482');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `ID` bigint(11) NOT NULL,
  `Email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`ID`, `Email`, `Fullname`, `Password`, `role`) VALUES
(32, 'admin@gmail.com', 'admin', '$2y$10$9QzMyIUsuV60AdJ8Pn1/M.3eN9iuljhTsPx9HYjZLbjAqrvyxKcn.', 1),
(86, 'aaaaa2@gmail.com', 'Phạm Tuyết Anh', '$2y$10$GtMApmU8sC/X21cZwaAMyOw8nYUvxa00XB1rPzpcKi.4hhj30xeFG', 0),
(87, 'pppoo@gmail.com', 'Phạm Tuyết Anh', '$2y$10$Ofg8Sh6v/A2aBlZyc.w/UuHOcCPVwgm9YeIn4tY8wKc6.LlXyPnsK', 0),
(106, 'pha2@gmail.com', 'Anh', '$2y$10$gbAbgat/LDaIQxVytsYhMuleZsis0CdgewC.ciE6W5ZB15l62hCNS', 0),
(121, 'poiv@gmail.com', 'Phạm Tuyết Anh', '$2y$10$hy37FqO32n/JyeR9iD2BmeWCq8lMY/qgCGL.AIVMdQl/gS5G03Igq', 0),
(123, 'hhhhh@gmail.com', 'Phạm Tuyết Anh', '$2y$10$EWP8WTd7vvisU4fsrVPz2.FsFg/dwh8iKRWpp.JmRj7gtNQ8J/Hhi', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user` (`CreatedBy`);

--
-- Chỉ mục cho bảng `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`ID_token`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `clients`
--
ALTER TABLE `clients`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT cho bảng `tokens`
--
ALTER TABLE `tokens`
  MODIFY `ID_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `ID` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `user` FOREIGN KEY (`CreatedBy`) REFERENCES `users` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
