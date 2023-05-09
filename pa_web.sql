-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2023 at 06:56 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pa_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `status` enum('progress','success','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user_id`, `total_price`, `status`) VALUES
(2, 3, 4400000, 'success'),
(3, 3, 700000, 'success'),
(4, 3, 100000, 'success'),
(5, 3, 33000, 'success'),
(6, 3, 68000, 'cancelled'),
(7, 3, 35000, 'cancelled');

--
-- Triggers `order`
--
DELIMITER $$
CREATE TRIGGER `Transaksi sukses` AFTER UPDATE ON `order` FOR EACH ROW IF NEW.status = 'success' THEN 
        INSERT INTO `transaction_history` (`id_produk`, `user_id`, `total_price`, `status`) 
        VALUES (NEW.id, NEW.user_id, NEW.total_price, NEW.status); 
    END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`id`, `order_id`, `product_id`, `amount`, `total`) VALUES
(2, 2, 4, 4, 1600000),
(3, 2, 6, 4, 2400000),
(5, 3, 6, 1, 600000);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `image`, `description`, `content`) VALUES
(3, 'Bakpiaku Ubi Ungu', 40000, 'assets/img/menu/menu-item-3.png', ' best seller!!!\r\n', ' Ubi Ungu, Tepung, Gula, Margarin '),
(4, 'Bakpiaku Keju', 45000, 'assets/img/menu/menu-item-4.png', ' best seller!!\r\n', ' Keju, Susu, Tepung, Gula, Margarin '),
(5, 'Bakpiaku Pandan', 55000, 'assets/img/menu/menu-item-5.png', ' best seller!!!', ' Pandan, Tepung, Gula, Margarin '),
(6, 'Bakpiaku Kacang', 60000, 'assets/img/menu/menu-item-6.png', ' best seller!!!', ' Coklat, kacang cincang, Tepung, Gula, \r\n Margarin ');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_history`
--

CREATE TABLE `transaction_history` (
  `id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `id_produk` int(5) NOT NULL,
  `total_price` int(20) NOT NULL,
  `status` enum('progress','success','cancelled') NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_history`
--

INSERT INTO `transaction_history` (`id`, `user_id`, `id_produk`, `total_price`, `status`, `waktu`) VALUES
(1, 3, 3, 700000, 'success', '2023-05-07 20:11:30'),
(2, 3, 4, 100000, 'success', '2023-05-07 20:12:08');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('user','admin','owner') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'owner', 'owner@gmail.com', 'owner', 'owner'),
(2, 'admin', 'admin@gmail.com', 'admin', 'admin'),
(3, 'user1', 'user1@gmail.com', 'user', 'user'),
(4, 'eja', 'ferryzanurwahyu50@gmail.com', '$2y$10$pgV6pE31LUQ6Axxo.zl30OnYJFPZMJitG/rtjYorXlOgfNNQoLDES', 'user'),
(5, 'apa', 'sadasd@email.com', '$2y$10$qC.yTf9kBsz6ojrdizlsluPh4jr6.273XZguRGLwUeBsrudwQrXka', 'user'),
(6, 'dasdas', 'asdas', '$2y$10$m8RKkYfuk.I0n6uYoayHpO.zpl99IKpjkyEx3cmHixljCA8dqam/G', 'user'),
(7, 'adDAS', 'asds', '$2y$10$wSpooCRHjQLwhSWieuLzOunA0Hp0.oZFvtwjwVPHRgZUGOQx8Vo3C', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_history`
--
ALTER TABLE `transaction_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaction_history`
--
ALTER TABLE `transaction_history`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_product_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`),
  ADD CONSTRAINT `order_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
