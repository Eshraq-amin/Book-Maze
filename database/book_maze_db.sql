-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2022 at 04:18 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_maze_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`id`, `email`, `password`, `created`) VALUES
(1, 'admin@mail.com', '123', '2022-03-25 05:12:55');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `book_poster` varchar(255) NOT NULL,
  `book_genres_id` int(11) NOT NULL,
  `book_publishers_id` int(11) NOT NULL,
  `book_authors_id` int(11) NOT NULL,
  `book_description` text NOT NULL,
  `book_price` double(15,2) NOT NULL,
  `featured` enum('Yes','No') NOT NULL DEFAULT 'No',
  `created` datetime NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `book_title`, `book_poster`, `book_genres_id`, `book_publishers_id`, `book_authors_id`, `book_description`, `book_price`, `featured`, `created`, `is_active`) VALUES
(1, 'A Sky', 'assets/img/gallery/1.jpg', 1, 1, 1, 'Description for the A Sky', 50.00, 'Yes', '2022-03-22 05:13:42', '1'),
(2, 'The Maid', 'assets/img/gallery/2.jpg', 1, 1, 1, 'Description of The Maid', 75.00, 'Yes', '2022-03-22 05:20:33', '1'),
(3, 'Capturing Hope', 'assets/img/gallery/3.jpg', 2, 2, 2, 'Description of Capturing Hope', 65.00, 'Yes', '2022-03-24 05:21:40', '1'),
(4, 'A Terrible Kindness', 'assets/img/gallery/4.jpg', 2, 2, 2, 'Description of The Terrible Kindness', 100.00, 'Yes', '2022-03-16 05:23:12', '1'),
(5, 'The Golden Flame', 'assets/img/gallery/5.jpg', 3, 3, 3, 'Description of The Golden Flame', 125.00, 'Yes', '2022-03-24 05:24:51', '1'),
(6, 'The Bone Spindle', 'assets/img/gallery/6.jpg', 3, 3, 3, 'Description of The Bone Spindle', 150.00, 'No', '2022-03-16 05:26:02', '1'),
(7, 'The Rose & The Dagger', 'assets/img/gallery/7.jpg', 4, 4, 4, 'Description of The Rose & The Dagger', 90.00, 'No', '2022-03-16 05:29:33', '1'),
(8, 'A Deadly Education', 'assets/img/gallery/8.jpg', 4, 4, 4, 'Description of A Deadly Education', 160.00, 'No', '2022-03-24 05:30:30', '1'),
(9, 'No Rules Rules', 'assets/img/gallery/9.jpg', 5, 5, 5, 'Description of No Rules Rules', 25.00, 'No', '2022-03-16 05:31:38', '1'),
(10, 'The Guest Cat', 'assets/img/gallery/10.jpg', 5, 5, 5, 'Description of The Guest Cat', 175.00, 'Yes', '2022-03-24 05:32:43', '1'),
(11, 'The Song Achilles', 'assets/img/gallery/11.jpg', 3, 2, 5, 'Description of The Song Achilles', 50.00, 'No', '2022-03-16 05:34:26', '1'),
(12, 'Norse Mythology', 'assets/img/gallery/12.jpg', 1, 5, 2, 'Description of Norse Mythology', 100.00, 'No', '2022-03-16 05:35:57', '1'),
(13, 'Six Crimson Cranes', 'assets/img/gallery/13.jpg', 1, 4, 3, 'Description of Six Crimson Cranes', 125.00, 'No', '2022-03-16 05:37:27', '1'),
(14, 'The Paris Bookseller', 'assets/img/gallery/14.jpg', 2, 2, 5, 'Description of The Paris Bookseller', 175.00, 'Yes', '2022-03-08 05:40:02', '1'),
(15, 'I Must Betray You', 'assets/img/gallery/15.jpg', 2, 3, 4, 'Description of I Must Betray You', 200.00, 'No', '2022-03-16 05:41:24', '1');

-- --------------------------------------------------------

--
-- Table structure for table `books_rating`
--

DROP TABLE IF EXISTS `books_rating`;
CREATE TABLE `books_rating` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `given_rating` int(11) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books_rating`
--

INSERT INTO `books_rating` (`id`, `customer_id`, `order_id`, `book_id`, `given_rating`, `created`) VALUES
(1, 5, 1, 8, 4, '2022-03-22 07:39:01'),
(2, 5, 1, 1, 4, '2022-03-22 07:39:01'),
(3, 5, 1, 12, 4, '2022-03-22 07:39:01'),
(4, 5, 2, 8, 5, '2022-03-22 11:52:38'),
(5, 5, 2, 9, 5, '2022-03-22 11:52:38'),
(6, 7, 5, 2, 5, '2022-03-22 12:21:29'),
(7, 7, 5, 1, 5, '2022-03-22 12:21:29'),
(8, 5, 3, 2, 1, '2022-03-24 06:13:34'),
(9, 5, 6, 10, 5, '2022-03-24 09:57:01'),
(10, 5, 7, 11, 4, '2022-03-24 10:03:33'),
(11, 5, 7, 15, 4, '2022-03-24 10:03:33');

-- --------------------------------------------------------

--
-- Table structure for table `book_authors`
--

DROP TABLE IF EXISTS `book_authors`;
CREATE TABLE `book_authors` (
  `id` int(11) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `author_description` text NOT NULL,
  `created` date NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_authors`
--

INSERT INTO `book_authors` (`id`, `author_name`, `author_description`, `created`, `is_active`) VALUES
(1, 'Buster Hyman', 'Description About Buster Hyman', '2022-03-16', '1'),
(2, 'Phil Harmonic', 'Description About Phil Harmonic', '2022-03-16', '1'),
(3, 'Cam L. Toe', 'Description About Cam L. Toe', '2022-03-16', '1'),
(4, 'Otto Matic', 'Description About Otto Matic', '2022-03-16', '1'),
(5, 'Juan Annatoo', 'Description About Juan Annatoo', '2022-03-16', '1');

-- --------------------------------------------------------

--
-- Table structure for table `book_genres`
--

DROP TABLE IF EXISTS `book_genres`;
CREATE TABLE `book_genres` (
  `id` int(11) NOT NULL,
  `genre_name` varchar(255) NOT NULL,
  `created` date NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_genres`
--

INSERT INTO `book_genres` (`id`, `genre_name`, `created`, `is_active`) VALUES
(1, 'History', '2022-03-16', '1'),
(2, 'Horror - Thriller', '2022-03-16', '1'),
(3, 'Love Stories', '2022-03-16', '1'),
(4, 'Science Fiction', '2022-03-16', '1'),
(5, 'Biography', '2022-03-16', '1');

-- --------------------------------------------------------

--
-- Table structure for table `book_publishers`
--

DROP TABLE IF EXISTS `book_publishers`;
CREATE TABLE `book_publishers` (
  `id` int(11) NOT NULL,
  `publisher_name` varchar(255) NOT NULL,
  `created` date NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_publishers`
--

INSERT INTO `book_publishers` (`id`, `publisher_name`, `created`, `is_active`) VALUES
(1, 'Green Publications', '2022-03-16', '1'),
(2, 'Anondo Publications', '2022-03-16', '1'),
(3, 'Rinku Publications', '2022-03-16', '1'),
(4, 'Sheba Publications', '2022-03-16', '1'),
(5, 'Red Publications', '2022-03-16', '1');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `status` enum('Placed','Pending','Failure','Completed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `total_amount`, `created`, `status`) VALUES
(1, 5, '360', '2022-03-22 06:19:14', 'Completed'),
(2, 5, '190', '2022-03-22 11:52:15', 'Completed'),
(3, 5, '77', '2022-03-22 12:08:45', 'Completed'),
(4, 6, '400', '2022-03-22 12:10:54', 'Completed'),
(5, 7, '135', '2022-03-22 12:20:59', 'Completed'),
(6, 5, '180', '2022-03-24 09:56:54', 'Completed'),
(7, 5, '360', '2022-03-24 10:03:04', 'Completed'),
(8, 5, '67', '2022-03-24 10:08:13', 'Completed'),
(9, 5, '250', '2022-03-25 07:03:05', 'Failure');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `item_id`, `item_quantity`) VALUES
(1, 1, 8, 1),
(2, 1, 1, 1),
(3, 1, 12, 1),
(4, 2, 8, 1),
(5, 2, 9, 1),
(6, 3, 2, 1),
(7, 4, 14, 2),
(8, 5, 2, 1),
(9, 5, 1, 1),
(10, 6, 10, 1),
(11, 7, 11, 3),
(12, 7, 15, 1),
(13, 8, 3, 1),
(14, 9, 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `user_name`, `email`, `password`, `address`) VALUES
(1, '', '', 'Eshraq Amin', 'eshraaq.the1@gmail.com', '123456', ''),
(2, '', '', 'tajwar mahmood', 'tajwar@gmail.com', '123456', ''),
(3, '', '', 'nibras', 'nibras@gmail.com', '123456', ''),
(4, '', '', 'moon', 'moon@gmail.com', '123456', ''),
(5, 'Farhan', 'Saqib', 'Farhan Saqib', 'farhan_sqb@yahoo.com', 'tom', 'Test Address'),
(6, '', '', 'Nadeem Asghar', 'nadeem58@gmail.com', '123', ''),
(7, '', '', 'Fani Ahmed', 'fani_ahmed@gmail.com', '123', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_delivery_address`
--

DROP TABLE IF EXISTS `users_delivery_address`;
CREATE TABLE `users_delivery_address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `address_1` varchar(255) NOT NULL,
  `address_2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `order_notes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_delivery_address`
--

INSERT INTO `users_delivery_address` (`id`, `user_id`, `order_id`, `first_name`, `last_name`, `company_name`, `phone`, `email`, `country`, `address_1`, `address_2`, `city`, `state`, `zip`, `payment_type`, `order_notes`) VALUES
(1, 1, 5, 'Farhan', 'Saqib', 'Test Company', '03244202185', 'farhan_sqb@yahoo.com', 'Pakistan', 'Lahore', 'Samnabad', 'Lahore', 'Punjab', '54500', 'check', 'Test Notes'),
(2, 2, 5, 'Farhan', 'Saqib', 'Test Company', '03244202185', 'farhan_sqb@yahoo.com', 'Pakistan', 'Lahore', 'Samnabad', 'Lahore', 'Punjab', '54500', 'paypal', 'Testing...'),
(3, 3, 5, 'Farhan', 'Saqib', 'Test Company', '03244202185', 'farhan_sqb@yahoo.com', 'Pakistan', 'Lahore', 'Samnabad', 'Lahore', 'Punjab', '54500', 'check', 'Ordered!...'),
(4, 4, 0, 'Nadeem', 'Asghar', 'E&W', '03334102198', 'nadeem@gmail.com', 'Pakistan', 'Lahore', 'Samnabad', 'Lahore', 'Punjab', '54500', 'check', 'New User Order Without Login so User Register!....'),
(5, 5, 7, 'Fani', 'Ahmed', 'AAA', '03244202122', 'fani_ahmed@gmail.com', 'Pakistan', 'Lahore', 'Samnabad', 'Lahore', 'Punjab', '54500', 'check', 'New User Creation Case...'),
(6, 6, 5, 'Farhan', 'Saqib', 'Test Company', '03244202185', 'farhan_sqb@yahoo.com', 'Pakistan', 'Lahore', 'Samnabad', 'Lahore', 'Punjab', '54500', 'check', 'Testing...'),
(7, 7, 5, 'Farhan', 'Saqib', 'Test Company', '03244202185', 'farhan_sqb@yahoo.com', 'Pakistan', 'Lahore', 'Samnabad', 'Lahore', 'Punjab', '54500', 'check', 'Test Order be defaut we setup it as Completed so you can rate it right after placing...'),
(8, 8, 5, 'Farhan', 'Saqib', 'Test Company', '03244202185', 'farhan_sqb@yahoo.com', 'Pakistan', 'Lahore', 'Samnabad', 'Lahore', 'Punjab', '54500', 'check', 'Test'),
(9, 9, 5, 'Farhan', 'Saqib', 'Test Company', '03244202185', 'farhan_sqb@yahoo.com', 'Pakistan', 'Lahore', 'Samnabad', 'Lahore', 'Punjab', '54500', 'check', 'Status Update...');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books_rating`
--
ALTER TABLE `books_rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_authors`
--
ALTER TABLE `book_authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_genres`
--
ALTER TABLE `book_genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_publishers`
--
ALTER TABLE `book_publishers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_name` (`user_name`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `users_delivery_address`
--
ALTER TABLE `users_delivery_address`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `books_rating`
--
ALTER TABLE `books_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `book_authors`
--
ALTER TABLE `book_authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `book_genres`
--
ALTER TABLE `book_genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `book_publishers`
--
ALTER TABLE `book_publishers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users_delivery_address`
--
ALTER TABLE `users_delivery_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
