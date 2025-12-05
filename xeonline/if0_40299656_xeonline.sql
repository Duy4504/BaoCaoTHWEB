-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: sql100.infinityfree.com
-- Thời gian đã tạo: Th12 04, 2025 lúc 10:54 PM
-- Phiên bản máy phục vụ: 10.6.22-MariaDB
-- Phiên bản PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `if0_40299656_xeonline`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `description`, `price`, `contact`, `image`, `status`, `created_at`) VALUES
(1, 3, 'Lambo', 'Xe mới', '1000000000.00', '0988777666', 'uploads/img_691f4c57135f6.jpg', 'approved', '2025-11-21 01:13:59'),
(2, 3, 'E 300 AMG (W214)', 'Loại nhiên liệu\r\nXăng\r\nCông suất\r\n150 kW (204 mã lực)\r\nNgày kiểm tra cuối cùng\r\ntháng 01, 2025\r\nTốc độ tối đa\r\n240 km/h\r\nDung tích xi lanh\r\n1.999 cm³\r\nXi-lanh\r\n4\r\nHộp số\r\nTự động\r\nChỗ ngồi\r\n5\r\nCác cửa\r\n4\r\nTăng tốc 0-100 km/h\r\n7,5 s\r\nMô-men xoắn\r\n320 Nm\r\nThương hiệu\r\nMercedes-Benz\r\nKiểu dáng thân xe\r\nLimousine\r\nDòng xe\r\n21404652\r\nLoại hạng\r\nW214', '3209000000.00', '0988777666', 'uploads/img_691f5200081c2.jpg', 'approved', '2025-11-21 01:38:08'),
(3, 4, 'E 200 Exclusive (W214)', 'Loại nhiên liệu\r\nXăng\r\nCông suất\r\n150 kW (204 mã lực)\r\nNgày kiểm tra cuối cùng\r\ntháng 01, 2025\r\nTốc độ tối đa\r\n240 km/h\r\nDung tích xi lanh\r\n1.999 cm³\r\nXi-lanh\r\n4\r\nHộp số\r\nTự động\r\nChỗ ngồi\r\n5\r\nCác cửa\r\n4\r\nTăng tốc 0-100 km/h\r\n7,5 s\r\nMô-men xoắn\r\n320 Nm\r\nThương hiệu\r\nMercedes-Benz\r\nĐộng cơ\r\nE 200\r\nKiểu dáng thân xe\r\nLimousine\r\nDòng xe\r\n21405052\r\nLoại hạng\r\nW214', '2589000000.00', '0988777877', 'uploads/img_691f5293a789e.jpg', 'approved', '2025-11-21 01:40:35'),
(4, 4, 'SH 2025', 'xe mới', '200000000.00', '098098098', NULL, 'approved', '2025-11-21 01:45:22'),
(5, 3, 'Lambo', 'Xe mới', '1000000000.00', '0988777666', 'uploads/img_691f4c57135f6.jpg', 'approved', '2025-11-21 01:13:59'),
(6, 3, 'E 300 AMG (W214)', 'Loại nhiên liệu\r\nXăng\r\nCông suất\r\n150 kW (204 mã lực)\r\nNgày kiểm tra cuối cùng\r\ntháng 01, 2025\r\nTốc độ tối đa\r\n240 km/h\r\nDung tích xi lanh\r\n1.999 cm³\r\nXi-lanh\r\n4\r\nHộp số\r\nTự động\r\nChỗ ngồi\r\n5\r\nCác cửa\r\n4\r\nTăng tốc 0-100 km/h\r\n7,5 s\r\nMô-men xoắn\r\n320 Nm\r\nThương hiệu\r\nMercedes-Benz\r\nKiểu dáng thân xe\r\nLimousine\r\nDòng xe\r\n21404652\r\nLoại hạng\r\nW214', '3209000000.00', '0988777666', 'uploads/img_691f5200081c2.jpg', 'approved', '2025-11-21 01:38:08'),
(7, 4, 'E 200 Exclusive (W214)', 'Loại nhiên liệu\r\nXăng\r\nCông suất\r\n150 kW (204 mã lực)\r\nNgày kiểm tra cuối cùng\r\ntháng 01, 2025\r\nTốc độ tối đa\r\n240 km/h\r\nDung tích xi lanh\r\n1.999 cm³\r\nXi-lanh\r\n4\r\nHộp số\r\nTự động\r\nChỗ ngồi\r\n5\r\nCác cửa\r\n4\r\nTăng tốc 0-100 km/h\r\n7,5 s\r\nMô-men xoắn\r\n320 Nm\r\nThương hiệu\r\nMercedes-Benz\r\nĐộng cơ\r\nE 200\r\nKiểu dáng thân xe\r\nLimousine\r\nDòng xe\r\n21405052\r\nLoại hạng\r\nW214', '2589000000.00', '0988777877', 'uploads/img_691f5293a789e.jpg', 'approved', '2025-11-21 01:40:35'),
(8, 4, 'SH 2025', 'xe mới', '200000000.00', '098098098', NULL, 'approved', '2025-11-21 01:45:22'),
(9, 3, 'Lambo', 'Xe mới', '1000000000.00', '0988777666', 'uploads/img_691f4c57135f6.jpg', 'approved', '2025-11-21 01:13:59'),
(10, 3, 'E 300 AMG (W214)', 'Loại nhiên liệu\r\nXăng\r\nCông suất\r\n150 kW (204 mã lực)\r\nNgày kiểm tra cuối cùng\r\ntháng 01, 2025\r\nTốc độ tối đa\r\n240 km/h\r\nDung tích xi lanh\r\n1.999 cm³\r\nXi-lanh\r\n4\r\nHộp số\r\nTự động\r\nChỗ ngồi\r\n5\r\nCác cửa\r\n4\r\nTăng tốc 0-100 km/h\r\n7,5 s\r\nMô-men xoắn\r\n320 Nm\r\nThương hiệu\r\nMercedes-Benz\r\nKiểu dáng thân xe\r\nLimousine\r\nDòng xe\r\n21404652\r\nLoại hạng\r\nW214', '3209000000.00', '0988777666', 'uploads/img_691f5200081c2.jpg', 'approved', '2025-11-21 01:38:08'),
(11, 4, 'E 200 Exclusive (W214)', 'Loại nhiên liệu\r\nXăng\r\nCông suất\r\n150 kW (204 mã lực)\r\nNgày kiểm tra cuối cùng\r\ntháng 01, 2025\r\nTốc độ tối đa\r\n240 km/h\r\nDung tích xi lanh\r\n1.999 cm³\r\nXi-lanh\r\n4\r\nHộp số\r\nTự động\r\nChỗ ngồi\r\n5\r\nCác cửa\r\n4\r\nTăng tốc 0-100 km/h\r\n7,5 s\r\nMô-men xoắn\r\n320 Nm\r\nThương hiệu\r\nMercedes-Benz\r\nĐộng cơ\r\nE 200\r\nKiểu dáng thân xe\r\nLimousine\r\nDòng xe\r\n21405052\r\nLoại hạng\r\nW214', '2589000000.00', '0988777877', 'uploads/img_691f5293a789e.jpg', 'approved', '2025-11-21 01:40:35'),
(12, 4, 'SH 2025', 'xe mới', '200000000.00', '098098098', NULL, 'approved', '2025-11-21 01:45:22'),
(13, 3, 'Lambo', 'Xe mới', '1000000000.00', '0988777666', 'uploads/img_691f4c57135f6.jpg', 'approved', '2025-11-21 01:13:59'),
(14, 3, 'E 300 AMG (W214)', 'Loại nhiên liệu\\r\\nXăng\\r\\nCông suất\\r\\n150 kW (204 mã lực)\\r\\nNgày kiểm tra cuối cùng\\r\\ntháng 01, 2025\\r\\nTốc độ tối đa\\r\\n240 km/h\\r\\nDung tích xi lanh\\r\\n1.999 cm³\\r\\nXi-lanh\\r\\n4\\r\\nHộp số\\r\\nTự động\\r\\nChỗ ngồi\\r\\n5\\r\\nCác cửa\\r\\n4\\r\\nTăng tốc 0-100 km/h\\r\\n7,5 s\\r\\nMô-men xoắn\\r\\n320 Nm\\r\\nThương hiệu\\r\\nMercedes-Benz\\r\\nKiểu dáng thân xe\\r\\nLimousine\\r\\nDòng xe\\r\\n21404652\\r\\nLoại hạng\\r\\nW214', '3209000000.00', '0988777666', 'uploads/img_691f5200081c2.jpg', 'approved', '2025-11-21 01:38:08'),
(15, 4, 'E 200 Exclusive (W214)', 'Loại nhiên liệu\\r\\nXăng\\r\\nCông suất\\r\\n150 kW (204 mã lực)\\r\\nNgày kiểm tra cuối cùng\\r\\ntháng 01, 2025\\r\\nTốc độ tối đa\\r\\n240 km/h\\r\\nDung tích xi lanh\\r\\n1.999 cm³\\r\\nXi-lanh\\r\\n4\\r\\nHộp số\\r\\nTự động\\r\\nChỗ ngồi\\r\\n5\\r\\nCác cửa\\r\\n4\\r\\nTăng tốc 0-100 km/h\\r\\n7,5 s\\r\\nMô-men xoắn\\r\\n320 Nm\\r\\nThương hiệu\\r\\nMercedes-Benz\\r\\nĐộng cơ\\r\\nE 200\\r\\nKiểu dáng thân xe\\r\\nLimousine\\r\\nDòng xe\\r\\n21405052\\r\\nLoại hạng\\r\\nW214', '2589000000.00', '0988777877', 'uploads/img_691f5293a789e.jpg', 'approved', '2025-11-21 01:40:35'),
(16, 4, 'SH 2025', 'xe mới', '200000000.00', '098098098', NULL, 'approved', '2025-11-21 01:45:22'),
(17, 4, 'dấd', 'ádadadads', '13131412000.00', '131231412313', 'uploads/img_691f5dd215ebb.jpg', 'approved', '2025-11-20 18:28:34'),
(18, 3, 'o too', 'jhsdf', '0.00', '345345', 'uploads/img_691fe0e930dc0.jpg', 'approved', '2025-11-21 03:47:53'),
(19, 20, 'xe hoi', 'xe dwp', '26546000.00', '435435', 'uploads/img_691fe18e9dc24.jpg', 'rejected', '2025-11-21 03:50:38'),
(20, 3, 'bmw', 'xe moi', '2000000000.00', '0909097654', 'uploads/img_693251936a207.jpg', 'approved', '2025-12-05 03:29:23');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(3, 'admin123', 'nguytduy176@gmail.com', '$2y$10$v3zj/EfrkAAIvcEGtSTns.AdnmK.1W8WSqRQd/SSxtnkPARBUiAYy', 'admin', '2025-11-21 00:49:46'),
(4, 'baocameo', 'ntd@gmail.com', '$2y$10$ztTDJPp2j/Cajh32SwNfy.0Gr4sN9kejO5WC6mxDaMk0FORxkc8pW', 'user', '2025-11-21 01:22:13'),
(20, 'vantai', 'tai@gmail.com', '$2y$10$u421X5RXGfGLR2C9/YrW0u5.TSOJkLVhCX2lEJQhQ4x.5UgsDNeIi', 'user', '2025-11-21 03:24:05'),
(21, 'tai', 'nguyenhoanghiep3005@gmail.con', '$2y$10$F8fUKRI58z0XUm7gwrU/y.sIWvZlI7qR7vGIGxDSdmYD29fVfnNQ.', 'user', '2025-12-02 05:28:54');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
