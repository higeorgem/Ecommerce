-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2019 at 10:38 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `user_pass` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`user_id`, `user_email`, `user_pass`) VALUES
(1, 'george@gmail.com', 'joji1234');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(100) NOT NULL,
  `brand_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(1, 'HP'),
(2, 'DELL'),
(3, 'SONY'),
(4, 'TECNO'),
(5, 'TOYOTA'),
(6, 'BUNDUKI'),
(8, 'O REILY');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `p_id` int(10) NOT NULL,
  `ip_add` varchar(255) NOT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`p_id`, `ip_add`, `qty`) VALUES
(1, '::1', 0),
(3, '::1', 0),
(4, '::1', 0),
(12, '::1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(100) NOT NULL,
  `cat_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'LAPTOPS'),
(2, 'CAMERAS'),
(3, 'CELLPHONES'),
(4, 'CLOTHES'),
(5, 'CARS'),
(6, 'SHOES'),
(7, 'Electronics'),
(8, 'BOOKS');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(10) NOT NULL,
  `customer_ip` varchar(255) NOT NULL,
  `customer_name` text NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_pass` varchar(100) NOT NULL,
  `customer_country` text NOT NULL,
  `customer_city` text NOT NULL,
  `customer_contact` varchar(255) NOT NULL,
  `customer_image` text NOT NULL,
  `customer_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_ip`, `customer_name`, `customer_email`, `customer_pass`, `customer_country`, `customer_city`, `customer_contact`, `customer_image`, `customer_address`) VALUES
(5, '::1', 'George Mutugi', 'gmutugi@student.maseno.ac.ke', 'joji1234', 'Kenya', 'Nairobi', '0742786021', 'Array', '53 Marima'),
(6, '::1', 'ken', 'ken@gmail.com', 'ken1234', 'Tanzania', 'Dar es saalam', '0707178204', 'Array', 'dar'),
(7, '::1', 'Harriet', 'harriet@gmail.com', 'harriet1234', 'Rwanda', 'Ansi', '0774559899', 'Array', '24 ans'),
(8, '::1', 'abdu', 'abdu@gmail.com', 'abdu1234', 'Ethiopia', 'Addis', '0798148440', 'Array', '53 ababa'),
(9, '::1', 'Kevo', 'kevo@gmail.com', 'kevo1234', 'Kenya', 'Eldoret', '0707178204', 'Array', '50 Eldoret'),
(10, '::1', 'George', 'george@gmail.com', 'joji1234', 'Kenya', 'Meru', '0742786021', 'Array', '50 Marima'),
(11, '::1', 'Braian Obiero', 'brayan@gmail.com', 'brayab1234', 'Tanzania', 'Kisumu', '0723546782', 'Array', '56 kisumu city'),
(12, '::1', 'Mr. Nyabundi', 'nyabundi@gmail.com', '1234', 'Kenya', 'Kisumu', '078998899889', 'Array', 'private bag');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_cat` int(100) NOT NULL,
  `product_brand` int(100) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_desc` text NOT NULL,
  `product_image` text NOT NULL,
  `product_keywords` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_cat`, `product_brand`, `product_title`, `product_price`, `product_desc`, `product_image`, `product_keywords`) VALUES
(1, 4, 6, 'Khaki', 1500, 'Fashionable khaki wear', 'IMG_20190202_110612.jpg', 'khaki, Fashion, Trousers, Men'),
(2, 1, 1, 'Linux OS', 2000, 'Kali Linux for hackers and penetration testers', 'Chris Kiragu 20180306_182154.jpg', 'Hacking, Hackers, Kali, Linux, OS'),
(3, 1, 1, 'HP 15', 35000, 'Brand new HP 15 slim laptop. Intel core i3, 1TB HDD ', 'HP - main-qimg-3ece096bfdff283d91dce229c5e71462-c.jpg', 'Laptop, Hp, Computer, Slim'),
(4, 1, 1, 'HP BackPack', 1500, 'WaterProof and TheftProof HP backpack', 'IMG-20181217-WA0011.jpg', 'Hp, Bag, Laptop, Bag, Backpack'),
(5, 3, 0, 'SmartWatch', 1000, 'modern apple classic smart watch', 'IMG-20190201-WA0010.jpg', 'Smart, Watch, Clock, Apple, Classic,  Fashion'),
(6, 1, 2, 'Dell Inspiron', 35500, 'Brand New Slim Dell Laptop. Intel Core i3, 4 CPUs, 500GB HDD, Webcam, Bluetooth, WiFi', 'dell-laptop-battery-problem.jpg', 'Dell, Slim, Laptop, Computer, Inspiron'),
(7, 2, 3, 'Nikon Canon Camera', 45000, 'Digital camera. High quality images and enhanced background. Good flash', 'Canon-EOS-Rebel-T3i.jpg', 'Camera, Digital, Nikon, Canon, Dslr'),
(8, 5, 5, 'Lamborghini', 120000000, 'Brand new Lamborghini', 'FB_IMG_15120153880698769.jpg', 'Lamborghini, Lambo, Car, Vehicle '),
(9, 4, 6, 'Hoodie', 1800, 'grey fashionable hood', 'IMG_20180801_182552.jpg', 'Hood, Hoodie, Hood, Fashion, Fashionable'),
(10, 7, 6, 'Robot', 500000, 'Highly intelligent Robotic Lion for maximum security. Can be a pet too', '324-2.jpg', 'Robot, AXL, Lion, Simba, Robotic'),
(11, 4, 6, 'Jade Vest', 600, 'Fashionable Vest for Men', 'IMG_20171227_120444_918.jpg', 'Vest, Fashion, Fashionable, Clothes'),
(12, 7, 6, 'Radio', 1000, 'Digital FM Radio', '324.jpg', 'radio'),
(13, 7, 2, 'Desktop', 80000, 'Powerful Dsktop server', 'Chris Kiragu 20180306_182154.jpg', 'server');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
