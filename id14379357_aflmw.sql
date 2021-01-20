-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 20, 2021 at 01:43 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id14379357_aflmw`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `order_id` varchar(50) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `order_id`, `bank_name`, `total`, `date_created`) VALUES
(1, '202007209B04', 'Bank Rak212', '34122', '2020-07-20 04:34:56'),
(2, '20200720D73E', 'Bank Islam', '34122', '2020-07-20 04:35:39'),
(3, '2020072092AF', 'bank 1', '2312', '2020-07-20 05:12:45'),
(4, '202007206A34', 'Bank Islam', '9916', '2020-07-20 11:38:26'),
(5, '20200812C952', 'Ambank', '12808', '2020-08-12 15:32:04'),
(6, '2020081283A8', 'Ambank', '7604', '2020-08-12 15:41:46');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `model_name` varchar(255) NOT NULL DEFAULT '0',
  `price` double NOT NULL DEFAULT 0,
  `manufacturer` varchar(255) NOT NULL DEFAULT '0',
  `stock` varchar(255) NOT NULL DEFAULT '0',
  `description` text DEFAULT NULL,
  `picture` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `model_name`, `price`, `manufacturer`, `stock`, `description`, `picture`) VALUES
(7, 'A7 Mark II ', 4500, 'Sony', '10', 'Megapixels: 24MP Full-Frame | ISO: 100-25,600 | Shooting Speed: 5 fps | Body size/weight:  5.0 x 3.8 x 2.4 inches;  1.22 pounds | Viewfinder: OLED | Screen: 3-inch touchscreen LCD | Battery Life (CIPA): 350 shots', 'a7iiB&H.jpg'),
(8, 'z50', 3890, 'Nikon', '150', 'Megapixels: 20.9MP APS-C | ISO:  100 – 51,200| Shooting Speed: 11fps | Body size/weight: \r\n9.1 x 7.1 x 5.2 inches;  2.7 pound | Viewfinder: OLED | Screen: 3.2-inch touchscreen LCD | Battery Life (CIPA):  300 shots\r\n', 'z50.jpg'),
(9, 'D750', 8219, 'Nikon', '199', 'Megapixels: 24.3MP Full-Frame | ISO: 100-12,800 | Shooting Speed: 6.5fps | Body size/weight: 5.5 x 4.4 x 3.1 inches; 1.7 pound | Viewfinder: Pentaprism | Screen: 3.2-inch tilting LCD | Battery Life (CIPA):  1230 shots', 'D750.jpg'),
(10, 'D3400', 1799, 'Nikon', '235', 'Megapixels: 24MP APS-C | ISO: 100 – 25,600 | Shooting Speed: 5fps | Body size/weight: 4.9 x 3.9 x 3.0 inches; 395 g| Viewfinder: Pentaprism | Screen: 3-inch LCD | Battery Life (CIPA): 1,200 shots', 'd3400.jpg'),
(11, 'EOS 80D', 6129, 'Canon', '112', 'Megapixels: 24.4MP APS-C | ISO: 100 – 25,600 | Shooting Speed: 7fps | Body size/weight: 5.5 x 4.1 x 3.1 inches; 1.61 pound | Viewfinder: Pentaprism | Screen: 3-inch articulating LCD | Battery Life (CIPA): 960 shots', 'eos80DTechNave.jpg'),
(12, 'EOS 6D Mark II', 8499, 'Canon', '10', 'Megapixels: 26.2MP Full-Frame | ISO: 100 – 40,000 | Shooting Speed: 6.5fps | Body size/weight: 5.7 x 4.4 x 2.9 inches; 1.51 pound | Viewfinder: Pentaprism | Screen: 3-inch articulating touchscreen LCD | Battery Life (CIPA): 1200 shots', 'eos6DIISLRlounge.jpg'),
(13, 'X-T4', 7950, 'Fujifilm', '108', 'Megapixels: 26.1 APS-C | ISO: 160 – 12,800 | Shooting Speed: 15 fps | Body size/weight: 5.3 x 3.65 x 2.51 inches; 1.16 pound | Viewfinder: OLED | Screen: 3-inch touchscreen LCD | Battery Life (CIPA): 600 shots', 'xt4B&Hphotovideocom.jpg'),
(14, 'A6100 ', 2312, 'Sony', '310', 'Megapixels: 24.2 APS-C | ISO: 100- 25,600 | Shooting Speed: 11 fps | Body size/weight: 4.75 x 2.75 x 2.13 inches; 1 pound | Viewfinder: OLED | Screen: 2.95-inch touchscreen LCD | Battery Life (CIPA): 420 shots', 'a6100B&Hphotovideocom.jpg'),
(15, 'D5600 ', 4002, 'Nikon', '41', 'Megapixels: 24.2 MP APS-C CMOS DX-format sensor | Lens Type: Interchangeable | ISO Range: ISO 100-25600 | Image Stabilization: In-lens | Video (Max Resolution): 1920 x 1080 at 60 fps | Shooting Speed: 5 fps | Display: 3.2-inch swiveling touchscreen | Wi-Fi: 802.11 b,g and Bluetooth 4.1 | Battery Life: 970 shots | Size/Weight: 4.9 x 3.8 x 2.8 inches/16.4 ounces', 'd5600B&Hphotovideocom.jpg'),
(16, 'X-Pro3 ', 7604, 'Fujifilm', '18', '26.1MP APS-C X-Trans BSI CMOS 4 Sensor |X-Processor 4 Image Processor | Hybrid 0.5x OVF with 3.69m-Dot OLED EVF | 3.0\" Hidden 180° Tilting Touchscreen', 'xpro3B&Hphotovideocom.jpg'),
(17, 'XYZ', 100, 'Leica', '2', 'dummy', '1024px-OpenMoji-black_1F41B.svg.png');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL DEFAULT 'PROCESSING',
  `order_id` varchar(50) DEFAULT NULL,
  `is_reviewed` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`id`, `product_id`, `user_id`, `quantity`, `date_created`, `status`, `order_id`, `is_reviewed`) VALUES
(3, 4, 6, 1, '2020-07-20 05:12:45', 'PROCESSING', '2020072092AF', 0),
(4, 4, 8, 1, '2020-07-20 11:38:26', 'PROCESSING', '202007206A34', 0),
(5, 6, 8, 1, '2020-07-20 11:38:26', 'PROCESSING', '202007206A34', 0),
(6, 9, 9, 1, '2020-08-12 15:32:04', 'SHIPPING', '20200812C952', 0),
(7, 7, 9, 1, '2020-08-12 15:32:04', 'DELIVERED', '20200812C952', 0),
(9, 16, 9, 1, '2020-08-12 15:41:46', 'PROCESSING', '2020081283A8', 0);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `review_details` text DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL DEFAULT '0',
  `type` int(11) DEFAULT 2,
  `user_address` varchar(255) NOT NULL,
  `mobile_no` varchar(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `type`, `user_address`, `mobile_no`, `date_created`) VALUES
(1, 'Admin', 'admin@test.com', 'admin', 1, 'asdsadsa', '021321321', '2020-06-09 07:21:20'),
(6, 'WOO ZHENGHAN', 'woo_zhenghan@hotmail.com', 'Qwertyuiop[0', 2, 'Lorem Ipsum Sample Woo Zhenghan Address', '01234567890', '2020-07-20 04:59:10'),
(8, 'Faizal', 'waduhek@gmail.com', 'Abc123.', 2, 'myhouse is at myhouse', '01234567890', '2020-07-20 07:36:52'),
(9, 'jane', 'pclim@unimas.my', 'Abc#123', 2, '123 Jalan Merdeka', '0112222222', '2020-08-12 15:27:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
