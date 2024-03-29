-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2024 at 12:32 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qorishop`
--

-- --------------------------------------------------------

--
-- Table structure for table `shopcategories`
--

CREATE TABLE `shopcategories` (
  `id` int(11) NOT NULL,
  `shopcategory` varchar(255) NOT NULL,
  `parentId` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `shopcategories`
--

INSERT INTO `shopcategories` (`id`, `shopcategory`, `parentId`) VALUES
(1, 'Genero', 0),
(2, 'Accesorios', 0),
(3, 'Complementos', 0),
(4, 'Hombre', 1),
(5, 'Mujer', 1),
(6, 'Cadenas', 2),
(7, 'Relojes', 2),
(8, 'Collares', 2),
(9, 'Carteras', 3),
(10, 'Canguros', 3),
(11, 'Monederos', 3),
(12, 'Billeteras', 3);

-- --------------------------------------------------------

--
-- Table structure for table `shopproducts`
--

CREATE TABLE `shopproducts` (
  `id` int(11) NOT NULL,
  `shopproduct_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `shopcategory_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `shopproducts`
--

INSERT INTO `shopproducts` (`id`, `shopproduct_name`, `price`, `shopcategory_id`, `description`, `image`) VALUES
(1, 'Nuevo Producto', 300.00, 4, 'This is Nuevo Producto', 'shopproduct_image_660119aae2377.jpg'),
(2, 'Shoes', 77.00, 7, 'This is shoes.', 'shopproduct_image_66011e3434e93.jpg'),
(3, 'Brand9', 99.00, 8, 'This is Brand9', 'shopproduct_image_66011e527f1a0.png'),
(4, 'Brand8', 66.00, 10, 'This is Brand8', 'shopproduct_image_66011e64d2b41.png'),
(5, 'B7', 80.00, 10, 'This is B7', 'shopproduct_image_66011e7bdbcea.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `techcategories`
--

CREATE TABLE `techcategories` (
  `id` int(11) NOT NULL,
  `techcategory` varchar(255) NOT NULL,
  `parentId` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `techcategories`
--

INSERT INTO `techcategories` (`id`, `techcategory`, `parentId`) VALUES
(1, 'Marca', 0),
(2, 'Accesorios', 0),
(3, 'Samsumg', 1),
(4, 'Apple', 1),
(5, 'Fundas', 2),
(6, 'Cargadores', 2);

-- --------------------------------------------------------

--
-- Table structure for table `techproducts`
--

CREATE TABLE `techproducts` (
  `id` int(11) NOT NULL,
  `techproduct_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `techcategory_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `techproducts`
--

INSERT INTO `techproducts` (`id`, `techproduct_name`, `price`, `techcategory_id`, `description`, `image`) VALUES
(1, 'Oupidatat non', 250.00, 5, 'This is Oupidatat non.', 'techproduct_image_66011bcc5a32b.jpg'),
(2, 'Apple phone', 300.00, 4, 'This is iPhone.', 'techproduct_image_66011bfced61e.jpg'),
(3, 'Watch', 150.00, 5, 'This is Watch.', 'techproduct_image_66011c52c8ceb.jpg'),
(4, 'Shoes', 100.00, 6, 'This is Shoes.', 'techproduct_image_66011c6549e57.jpg'),
(5, 'Glass', 130.00, 5, 'This is glass', 'techproduct_image_66011c7f55ec3.jpg'),
(6, 'Brand2', 60.00, 3, 'This is brand2', 'techproduct_image_66011ca06e47e.png'),
(7, 'Brand1', 40.00, 4, 'This is Brand2', 'techproduct_image_66011cbe94478.png'),
(8, 'iPhone 14', 140.00, 4, 'This is iPhone 14', 'techproduct_image_66011ce1b823e.jpg'),
(9, 'Brand3', 50.00, 5, 'This is Brand3', 'techproduct_image_66011d4711a5f.jpg'),
(10, 'Brand4', 88.00, 6, 'This is Brand4', 'techproduct_image_66011d609637b.jpg'),
(11, 'Final Test', 160.00, 4, 'This is final test1.', 'techproduct_image_66011edc25502.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(0, 'Daniel', 'danieleverest0214@gmail.com', '$2y$10$HikPeBeyoCUOf5Vn5brEBu3cSvWiqOmiTENMPPykrpcDaVOVphcNC'),
(0, 'Test', 'superadmin@gmail.com', '$2y$10$eiiQbgPz00XKJBAQNSR3jOcucuSg6w1VwdH9DdCWuO8/pFRpC.sTS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `shopcategories`
--
ALTER TABLE `shopcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopproducts`
--
ALTER TABLE `shopproducts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_shopproducts_category_id` (`shopcategory_id`);

--
-- Indexes for table `techcategories`
--
ALTER TABLE `techcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `techproducts`
--
ALTER TABLE `techproducts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_techproducts_category_id` (`techcategory_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shopcategories`
--
ALTER TABLE `shopcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `shopproducts`
--
ALTER TABLE `shopproducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `techcategories`
--
ALTER TABLE `techcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `techproducts`
--
ALTER TABLE `techproducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `shopproducts`
--
ALTER TABLE `shopproducts`
  ADD CONSTRAINT `fk_shopproducts_category_id` FOREIGN KEY (`shopcategory_id`) REFERENCES `shopcategories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `techproducts`
--
ALTER TABLE `techproducts`
  ADD CONSTRAINT `fk_techproducts_category_id` FOREIGN KEY (`techcategory_id`) REFERENCES `techcategories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
