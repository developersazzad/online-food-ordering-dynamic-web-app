-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2021 at 09:34 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_food`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_game`
--

CREATE TABLE `about_game` (
  `id` int(11) NOT NULL,
  `parrent_id` int(11) NOT NULL,
  `title_name` text NOT NULL,
  `title_text` text NOT NULL,
  `status` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `about_game`
--

INSERT INTO `about_game` (`id`, `parrent_id`, `title_name`, `title_text`, `status`, `date`) VALUES
(1, 4, ' What is DubaiKing Game ..?', ' ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.', 1, '2020-11-13 06:47:24'),
(2, 4, ' WHAT IS DubaiKing TYPES?', ' Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.', 1, '2020-11-12 20:39:27'),
(3, 4, 'HOW CAN WE DUBAIKING GAME..!', ' Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.', 1, '2020-11-12 12:17:05');

-- --------------------------------------------------------

--
-- Table structure for table `add_cart`
--

CREATE TABLE `add_cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `proudect_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `add_on` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `add_cart`
--

INSERT INTO `add_cart` (`id`, `user_id`, `proudect_id`, `qty`, `add_on`) VALUES
(421, 20, 779, 1, '2020-10-21'),
(458, 26, 66, 4, '2020-11-04'),
(459, 26, 779, 1, '2020-11-04');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(110) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `password`, `email`) VALUES
(1, 'admin', 'admin', 'admin', '');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(75) NOT NULL,
  `order_number` int(11) NOT NULL,
  `stats` int(11) NOT NULL,
  `add_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `order_number`, `stats`, `add_on`) VALUES
(2, 'Cold drinks', 3, 1, '2020-09-27 10:19:36'),
(5, 'Aniversery Cake', 2, 1, '2020-09-27 10:31:04'),
(9, 'Cake', 1, 1, '2020-09-27 10:43:22'),
(12, 'Electronics', 5, 1, '2020-10-04 19:44:00');

-- --------------------------------------------------------

--
-- Table structure for table `contect_us`
--

CREATE TABLE `contect_us` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(18) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contect_us`
--

INSERT INTO `contect_us` (`id`, `name`, `mobile`, `email`, `subject`, `message`, `date`) VALUES
(2, 'sazzad', '', 'sazzad@gmail.com', 'need', 'test test test test test test test test test test test test test test test test test test test test test test test test test test ', '2020-09-29'),
(7, 'shamima akter', '01835558000', 'sazzad45@gmail.com', 'Hi sazzad.', 'Hi sazzad I am your wife.\r\n', '2020-09-30');

-- --------------------------------------------------------

--
-- Table structure for table `copone_code`
--

CREATE TABLE `copone_code` (
  `id` int(11) NOT NULL,
  `copone_code` varchar(120) NOT NULL,
  `copone_type` enum('P','F','M','') NOT NULL,
  `copone_value` varchar(110) NOT NULL,
  `cart_min_value` varchar(100) NOT NULL,
  `expire_on` date NOT NULL,
  `stats` int(11) NOT NULL,
  `add_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `copone_code`
--

INSERT INTO `copone_code` (`id`, `copone_code`, `copone_type`, `copone_value`, `cart_min_value`, `expire_on`, `stats`, `add_on`) VALUES
(3, 'f54rdf', 'F', '50', '500', '2020-10-22', 1, '2020-10-19 06:38:38'),
(4, 'friday', 'P', '30', '300', '2020-10-21', 1, '2020-10-20 05:33:26');

-- --------------------------------------------------------

--
-- Table structure for table `delevery_boy`
--

CREATE TABLE `delevery_boy` (
  `id` int(11) NOT NULL,
  `name` varchar(110) NOT NULL,
  `mobile` int(11) NOT NULL,
  `password` int(11) NOT NULL,
  `stats` int(11) NOT NULL,
  `add_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delevery_boy`
--

INSERT INTO `delevery_boy` (`id`, `name`, `mobile`, `password`, `stats`, `add_on`) VALUES
(1, 'sazzad', 11, 1122, 0, '2020-09-27 11:21:37'),
(2, 'shamima', 1835558000, 0, 1, '2020-09-27 11:46:48'),
(3, 'mahir', 7979797, 0, 1, '2020-09-27 11:47:38'),
(4, 'manik', 122, 0, 1, '2020-10-19 19:24:38');

-- --------------------------------------------------------

--
-- Table structure for table `dish`
--

CREATE TABLE `dish` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `dish` varchar(255) NOT NULL,
  `dish_detail` varchar(255) NOT NULL,
  `images` varchar(255) NOT NULL,
  `stats` int(11) NOT NULL,
  `add_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dish`
--

INSERT INTO `dish` (`id`, `category_id`, `dish`, `dish_detail`, `images`, `stats`, `add_on`) VALUES
(11, 9, 'Child like cake', 'it use chokolate and batterit use chokolate and batterit use ', '48619_proudect.jpg', 1, '0000-00-00 00:00:00'),
(12, 9, 'Aniversery', 'it use chokolate and batterit use chokolate and batterit use ', '59332_proudect.jpg', 1, '2020-11-01 08:59:43'),
(13, 12, 'Birthay x', 'it use chokolate and batterit use chokolate and batterit use ', '66245_proudect.jpg', 1, '2020-11-01 08:50:36'),
(15, 9, 'Mini Pasta ', 'a', '61875_proudect.jpg', 0, '2020-11-01 08:49:09'),
(16, 5, 'soft cipsddss', 'it use chokolate and batterit use chokolate and batterit use ', '20624_proudect.jpg', 0, '2020-11-01 08:48:28'),
(17, 12, 'drinks Baer', 'zz', '67359_proudect.jpg', 1, '2020-11-01 08:58:08'),
(19, 9, 'cake spasial', 'it use chokolate and batterit use chokolate and batterit use', '32860_proudect.jpg', 1, '2020-11-04 07:51:05');

-- --------------------------------------------------------

--
-- Table structure for table `dish_details`
--

CREATE TABLE `dish_details` (
  `id` int(11) NOT NULL,
  `dish_id` int(11) NOT NULL,
  `Attribute` varchar(200) NOT NULL,
  `Price` int(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dish_details`
--

INSERT INTO `dish_details` (`id`, `dish_id`, `Attribute`, `Price`, `status`, `date`) VALUES
(32, 11, '4 pound', 800, '1', '2020-10-14'),
(56, 11, '8pound', 1200, '0', '2020-10-14'),
(58, 12, '1 pounds', 200, '1', '2020-10-14'),
(62, 12, '2 pounds', 320, '0', '2020-10-14'),
(63, 14, 'singal', 120, '1', '2020-11-01'),
(64, 14, 'full', 200, '1', '2020-11-01'),
(65, 10, 'delevery', 0, '0', '2020-10-14'),
(66, 18, '1 packet', 20, '1', '2020-11-01'),
(67, 16, '1 packet', 20, '1', '2020-11-01'),
(68, 16, '3 packet', 25, '1', '2020-11-01'),
(69, 15, '1 pics', 120, '1', '2020-11-01'),
(70, 15, '2pics', 200, '1', '2020-11-01'),
(74, 13, '1 pounds', 120, '1', '2020-11-01'),
(75, 9, 'total', 400, '1', '2020-10-14'),
(76, 9, '1 pounds', 120, '1', '2020-10-14'),
(765, 17, 'sdes', 121, '1', '2020-11-01'),
(766, 15, 'ss', 22, '1', '2020-11-01'),
(767, 10, 'ss', 123, '1', '2020-10-14'),
(769, 10, 'ss', 112, '0', '2020-10-14'),
(771, 17, 'full', 123, '1', '2020-11-01'),
(772, 18, '2 packet', 123, '1', '2020-11-01'),
(774, 18, 'ssdddd', 2222, '1', '2020-11-01'),
(778, 16, 'dx', 33, '1', '2020-11-01'),
(779, 16, 'xx', 123, '1', '2020-11-01'),
(780, 16, 's', 345, '1', '2020-11-01'),
(781, 16, '123', 0, '1', '2020-11-01'),
(782, 20, 'aasd', 124, '1', '2020-11-01'),
(783, 19, 'one_item', 234, '1', '2020-11-04');

-- --------------------------------------------------------

--
-- Table structure for table `index_banner`
--

CREATE TABLE `index_banner` (
  `id` int(11) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `sub_heading` text NOT NULL,
  `images` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `link_text` varchar(255) NOT NULL,
  `order_number` varchar(200) NOT NULL,
  `stats` varchar(255) NOT NULL,
  `addad_on` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `index_banner`
--

INSERT INTO `index_banner` (`id`, `heading`, `sub_heading`, `images`, `link`, `link_text`, `order_number`, `stats`, `addad_on`) VALUES
(4, 'Drink & Heathy Food.', 'Fresh Heathy and Organic.', '80072_proudect.jpg', 'shop.php', 'Order Now ', '2', '1', '2020-09-29'),
(8, 'Order And Chill in Your Home.', '10 minute We sarve our Food.', '58828_proudect.jpg', 'shop.php', 'Order Now And Chill', '1', '1', '2020-09-29'),
(9, 'Banger 30% Off', 'Over all order To apply Copone.', '50809_proudect.jpg', 'shop.php', 'Order Banger ', '3', '1', '2020-09-29'),
(10, 'All fastFood is hare.', 'Sazzad Hossain rahath', '76524_proudect.jpg', 'shop.php?sort_id=2', 'Order FastFood', '4', '1', '2020-10-31');

-- --------------------------------------------------------

--
-- Table structure for table `order_detels`
--

CREATE TABLE `order_detels` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_order_id` varchar(120) NOT NULL,
  `desh_detali_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `quantity` varchar(20) NOT NULL,
  `add_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_detels`
--

INSERT INTO `order_detels` (`id`, `order_id`, `user_order_id`, `desh_detali_id`, `price`, `quantity`, `add_on`) VALUES
(78, 46, '13974', 74, 120, '2', '2020-10-30 07:03:30'),
(79, 47, '50657', 74, 120, '1', '2020-10-30 07:34:09'),
(80, 47, '50657', 69, 120, '1', '2020-10-30 07:34:09'),
(81, 48, '73043', 64, 200, '1', '2020-11-01 05:27:45'),
(82, 48, '73043', 74, 120, '3', '2020-11-01 05:27:45'),
(83, 50, '12479', 783, 234, '4', '2020-11-02 07:00:55'),
(84, 50, '12479', 68, 25, '1', '2020-11-02 07:00:55'),
(85, 51, '16452', 780, 345, '1', '2021-08-03 08:50:11'),
(86, 51, '16452', 32, 800, '1', '2021-08-03 08:50:11'),
(87, 52, '92739', 783, 234, '3', '2021-08-03 09:02:08'),
(88, 52, '92739', 32, 800, '1', '2021-08-03 09:02:08'),
(89, 52, '92739', 765, 121, '1', '2021-08-03 09:02:08');

-- --------------------------------------------------------

--
-- Table structure for table `order_master`
--

CREATE TABLE `order_master` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `zip_code` varchar(20) NOT NULL,
  `total_price` float NOT NULL,
  `copone_coad` varchar(120) NOT NULL,
  `final_price` float NOT NULL,
  `gst` float NOT NULL,
  `delevery_boy_id` varchar(110) NOT NULL,
  `pamment_stats` varchar(120) NOT NULL,
  `pamment_type` varchar(100) NOT NULL,
  `pamment_id` varchar(120) NOT NULL,
  `order_stats` varchar(110) NOT NULL,
  `cancel_at` varchar(20) NOT NULL,
  `cancel_date` datetime NOT NULL,
  `add_on` datetime NOT NULL DEFAULT current_timestamp(),
  `delivered_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_master`
--

INSERT INTO `order_master` (`id`, `user_id`, `name`, `email`, `mobile`, `address`, `city`, `zip_code`, `total_price`, `copone_coad`, `final_price`, `gst`, `delevery_boy_id`, `pamment_stats`, `pamment_type`, `pamment_id`, `order_stats`, `cancel_at`, `cancel_date`, `add_on`, `delivered_on`) VALUES
(48, 28, 'shamima sazzad', 'sazzad01835558000@gmail.com', '12345566', '', '', '', 560, '', 560, 1, '1', '', 'cod', '', 'on the way', 'Admin', '2020-11-04 02:52:46', '2020-11-01 05:27:45', '2020-11-01 22:27:45'),
(50, 26, 'sazzad', 'sazzad.upwork.me@gmail.com', '123456789', 'chokria', 'rer', '1234', 961, '', 961, 1, '1', '', 'cod', '', 'cancel', '', '0000-00-00 00:00:00', '2020-11-02 07:00:55', '2020-11-02 12:00:55'),
(51, 28, 'sazzad', 'sazzad01835558000@gmail.com', '12345566', '', '', '', 1145, '', 1145, 1, '0', '', 'paytm', '', 'cancel', 'user', '2021-08-03 08:56:57', '2021-08-03 08:50:11', '2021-08-03 12:50:11'),
(52, 28, 'sazzad', 'sazzad01835558000@gmail.com', '12345566', '', '', '', 1623, '', 1623, 1, '0', '', 'paytm', '', 'pandding', '', '0000-00-00 00:00:00', '2021-08-03 09:02:08', '2021-08-03 13:02:08');

-- --------------------------------------------------------

--
-- Table structure for table `order_stats`
--

CREATE TABLE `order_stats` (
  `id` int(11) NOT NULL,
  `order_stats` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_stats`
--

INSERT INTO `order_stats` (`id`, `order_stats`) VALUES
(1, 'pandding'),
(2, 'on the way'),
(3, 'cooking'),
(4, 'cancel'),
(5, 'delivered');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `proudect_id` int(11) NOT NULL,
  `rating` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id`, `user_id`, `proudect_id`, `rating`) VALUES
(72, 28, 18, 4),
(73, 28, 14, 5),
(74, 28, 16, 2),
(75, 28, 14, 5),
(76, 28, 13, 5),
(77, 28, 11, 5);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `website_stats` int(11) NOT NULL,
  `website_off_msg` varchar(100) NOT NULL,
  `cart_min_value` float NOT NULL,
  `wallat_amount` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `website_stats`, `website_off_msg`, `cart_min_value`, `wallat_amount`, `date`) VALUES
(1, 0, 'This days our website and hotel total closed.for critical isssu.', 100, 50, '2020-10-29');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `images` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` int(11) NOT NULL,
  `password` varchar(200) NOT NULL,
  `stats` int(11) NOT NULL,
  `email_verify` varchar(120) NOT NULL,
  `raffarl_number` varchar(100) NOT NULL,
  `form_raffer_code` varchar(100) NOT NULL,
  `add_on` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `images`, `email`, `mobile`, `password`, `stats`, `email_verify`, `raffarl_number`, `form_raffer_code`, `add_on`) VALUES
(26, 'sazzad', '7862.jpg', 'sazzad.upwork.me@gmail.com', 123456789, 'sazzad00', 1, '1', '2d926c8dc7da0f204334d645fa2789a3', '', '2020-10-26'),
(28, 'sazzad', '9432.jpg', 'sazzad01835558000@gmail.com', 12345566, 'shamima00', 1, '1', '', '', '2020-10-29'),
(29, 'sazzad', '', 'sazzad@gmail.com', 1234, '123', 1, '1', '49df6a068a976f6a36d24c75110e3dcc', '2d926c8dc7da0f204334d645fa2789a3', '2020-11-06'),
(30, 'sazzad', '', 'developer.sazzad,me@gmail.com', 1833285263, 'sazzad00', 1, '0', 'ea224f772194ee751320b022215ad22d', '', '2021-08-03'),
(31, 'sazzad', '', 'developer.sazzad.me@gmail.com', 1833285263, 'sazzad00', 1, '0', 'f8a44641cfa34ddb5b5c4d20283f39bc', '', '2021-08-03');

-- --------------------------------------------------------

--
-- Table structure for table `wallat`
--

CREATE TABLE `wallat` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `type` enum('in','out') NOT NULL,
  `msg` varchar(500) NOT NULL,
  `Txn_id` varchar(200) NOT NULL,
  `add_on` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wallat`
--

INSERT INTO `wallat` (`id`, `user_id`, `amount`, `type`, `msg`, `Txn_id`, `add_on`) VALUES
(16, 28, 24, 'in', 'test', '007', '2020-11-04'),
(17, 0, 50, 'in', 'Sign up bonus', '', '2020-11-06'),
(18, 0, 50, 'in', 'Sign up bonus', '', '2020-11-06'),
(19, 0, 50, 'in', 'Sign up bonus', '', '2020-11-06'),
(20, 0, 50, 'in', 'Sign up bonus', '', '2020-11-06'),
(21, 29, 50, 'in', 'Sign up bonus', '', '2020-11-06'),
(22, 30, 50, 'in', 'Sign up bonus', '', '2021-08-03'),
(23, 31, 50, 'in', 'Sign up bonus', '', '2021-08-03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_cart`
--
ALTER TABLE `add_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contect_us`
--
ALTER TABLE `contect_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `copone_code`
--
ALTER TABLE `copone_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delevery_boy`
--
ALTER TABLE `delevery_boy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dish`
--
ALTER TABLE `dish`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dish_details`
--
ALTER TABLE `dish_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `index_banner`
--
ALTER TABLE `index_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detels`
--
ALTER TABLE `order_detels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_master`
--
ALTER TABLE `order_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_stats`
--
ALTER TABLE `order_stats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallat`
--
ALTER TABLE `wallat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_cart`
--
ALTER TABLE `add_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=465;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contect_us`
--
ALTER TABLE `contect_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `copone_code`
--
ALTER TABLE `copone_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `delevery_boy`
--
ALTER TABLE `delevery_boy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dish`
--
ALTER TABLE `dish`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `dish_details`
--
ALTER TABLE `dish_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=785;

--
-- AUTO_INCREMENT for table `index_banner`
--
ALTER TABLE `index_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_detels`
--
ALTER TABLE `order_detels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `order_master`
--
ALTER TABLE `order_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `order_stats`
--
ALTER TABLE `order_stats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `wallat`
--
ALTER TABLE `wallat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
