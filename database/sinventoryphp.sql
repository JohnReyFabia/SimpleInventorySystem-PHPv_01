-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2023 at 10:16 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sinventoryphp`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrow_history`
--

CREATE TABLE `borrow_history` (
  `borrow_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `quantity_borrowed` int(11) NOT NULL,
  `borrow_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `return_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrow_history`
--

INSERT INTO `borrow_history` (`borrow_id`, `product_id`, `order_id`, `quantity_borrowed`, `borrow_date`, `return_date`) VALUES
(1, 11, 2, 1, '2023-11-29 02:25:45', '2023-11-29 02:25:45'),
(2, 13, 3, 2, '2023-11-29 02:27:09', '2023-11-29 02:27:09'),
(3, 6, 4, 21, '2023-11-30 06:41:06', '2023-11-30 06:41:06');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_active` int(11) NOT NULL DEFAULT 0,
  `brand_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`, `brand_active`, `brand_status`) VALUES
(1, 'None', 1, 2),
(2, 'None', 1, 1),
(3, '10 ML', 1, 1),
(4, '250 ML', 1, 1),
(5, '100 ML', 1, 1),
(6, 'Assorted', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categories_id` int(11) NOT NULL,
  `categories_name` varchar(255) NOT NULL,
  `categories_active` int(11) NOT NULL DEFAULT 0,
  `categories_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categories_id`, `categories_name`, `categories_active`, `categories_status`) VALUES
(1, 'Physics Equipment', 1, 1),
(2, 'Biology Equipment', 1, 1),
(3, 'Chemistry Equipment', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `location_active` int(11) NOT NULL,
  `location_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `location_name`, `location_active`, `location_status`) VALUES
(1, 'Bench Top', 1, 1),
(2, 'Blue Box', 1, 1),
(3, 'Lower Cab', 1, 1),
(4, 'Floor', 1, 1),
(5, 'Table', 1, 1),
(6, 'Tops', 1, 1),
(7, 'SC - 5C', 1, 1),
(8, 'SC - 5D', 1, 1),
(9, 'SC - 4A', 1, 1),
(10, 'SC - 3D', 1, 1),
(11, 'SC - 3C', 1, 1),
(12, 'SC - 3B', 1, 1),
(13, 'SC - 3A', 1, 2),
(14, 'SC - 3A', 1, 1),
(15, 'Cabinet', 1, 1),
(16, 'Steel Rack', 1, 1),
(43, 'Basket', 1, 1),
(44, 'Location', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `order_status` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `student_number` varchar(255) NOT NULL,
  `college` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `year_level` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `client_name`, `payment_status`, `order_status`, `user_id`, `student_number`, `college`, `course`, `year_level`) VALUES
(1, '2023-12-09', 'John', 0, 1, 0, '2018-7-a234', 'College of Science', 'Computer Science', '1'),
(2, '2023-12-09', '2', 0, 1, 0, 'r', 'r', 'r', 'r'),
(3, '2023-12-09', '22', 0, 1, 0, '22', '22', '22', '22'),
(4, '2023-12-09', 'Ailene', 0, 1, 0, '32324kjb', 'COLLEGE college ceat ', 'it', 'first year 1st year');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT 0,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `quantity` varchar(255) NOT NULL,
  `brand` int(11) NOT NULL,
  `total` varchar(255) NOT NULL,
  `order_item_status` int(11) NOT NULL DEFAULT 0,
  `isReturned` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`order_item_id`, `order_id`, `product_id`, `quantity`, `brand`, `total`, `order_item_status`, `isReturned`) VALUES
(2, 2, 13, '2', 45, '45.00', 1, 1),
(3, 3, 15, '1', 45, '45.00', 1, 1),
(4, 0, 16, '12', 22, '264.00', 1, 0),
(5, 0, 16, '13', 22, '264.00', 1, 0),
(6, 0, 16, '12', 22, '286.00', 1, 0),
(7, 4, 16, '12', 22, '264.00', 1, 1),
(8, 5, 3, '2', 53, '106.00', 1, 1),
(9, 6, 3, '14', 53, '742.00', 1, 1),
(11, 8, 9, '4', 87, '348.00', 1, 1),
(12, 9, 14, '4', 321, '1284.00', 1, 1),
(13, 10, 6, '1', 70, '70.00', 1, 0),
(14, 10, 7, '1', 29, '29.00', 1, 0),
(15, 10, 10, '1', 35, '35.00', 1, 1),
(16, 10, 4, '1', 140, '140.00', 1, 1),
(17, 20, 10, '1', 4, '', 0, 0),
(18, 21, 10, '1', 6, '', 0, 0),
(19, 22, 12, '1', 4, '', 0, 0),
(20, 22, 10, '1', 3, '', 0, 0),
(21, 22, 12, '1', 4, '', 0, 0),
(22, 23, 10, '1', 3, '', 0, 0),
(23, 23, 10, '1', 4, '', 0, 0),
(24, 24, 10, '2', 5, '45.00', 0, 1),
(25, 25, 12, '32', 5, '0.00', 0, 1),
(26, 26, 11, '30', 5, '30.00', 0, 0),
(27, 1, 4, '1', 4, '', 0, 1),
(28, 1, 8, '3', 6, '', 0, 1),
(29, 2, 11, '1', 3, '', 0, 1),
(30, 3, 13, '2', 3, '', 0, 1),
(31, 4, 6, '21', 3, '21.00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` text NOT NULL,
  `brand_id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `SerialNumber` varchar(255) NOT NULL,
  `PropertyNumber` varchar(255) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_image`, `brand_id`, `categories_id`, `location_id`, `quantity`, `SerialNumber`, `PropertyNumber`, `active`, `status`, `remarks`) VALUES
(1, 'Lab phase', 'assests/images/stock/126535122064b5491c42d37.PNG', 3, 1, 1, '12', '145', '455', 2, 2, ''),
(2, 'laboratory', 'assests/images/stock/170630325464b54b3b56cba.PNG', 2, 2, 1, '12', '323212', '123', 2, 2, ''),
(3, 'lacsdg', 'assests/images/stock/110950768664b54be6531f7.PNG', 2, 1, 3, '12', '231', '12312', 2, 2, ''),
(4, 'Crucible Tong', 'assests/images/stock/66505733264b93d799de39.png', 2, 2, 7, '20', '', '', 1, 1, 'remark'),
(5, 'Evaporating Dish', 'assests/images/stock/157945691964b93fd8ce491.png', 6, 2, 7, '46', '', '', 1, 1, 'Breakable/Disposable'),
(6, 'Microscope, (Biological Compound)', 'assests/images/stock/11441822564b9416e309b8.jpg', 2, 2, 6, '21', 'M#: CX 21FSI', 'PSU CS 164-10-099 to 119', 1, 1, ''),
(7, 'Microscope (Motic)', 'assests/images/stock/72828299464b941ed9dc2f.jpg', 2, 2, 6, '2', '31303671 & 313036', 'PSU CS-Lab 401 14-303 & 304', 1, 1, ''),
(8, 'Triple Beam Balance', 'assests/images/stock/6688027064b9427b3fe10.png', 2, 2, 16, '4', '', 'CS Lab 02-0206-1140 & 1142', 1, 1, ''),
(9, 'Alcohol Lamp', 'assests/images/stock/143669090764b943102e407.png', 2, 3, 8, '20', '', '', 1, 1, ''),
(10, 'Crucible with Cover', 'assests/images/stock/65856618664b9438567be4.jpg', 6, 3, 7, '47', '', '', 1, 1, ''),
(11, 'Tripod', 'assests/images/stock/36275421364b94404a62db.jpg', 2, 2, 8, '30', '', '', 1, 1, ''),
(12, 'Wire Gauze', 'assests/images/stock/161316452964b9444b68eac.jpg', 2, 2, 8, '32', '', '', 1, 1, ''),
(13, 'Clay Triangle', 'assests/images/stock/61696984764b9449501088.jpg', 2, 3, 8, '29', '', '', 1, 1, ''),
(14, 'Bunsen Burner', 'assests/images/stock/209619256964b944e320cd3.jpg', 2, 3, 8, '5', '', '', 1, 1, ''),
(15, 'Desktop Computer (Dell Inspiron)', 'assests/images/stock/208889113764b9458d334c3.jpg', 2, 1, 6, '1', '', 'PSU CS-Lab 164 14-179', 2, 1, ''),
(16, '123', 'assests/images/stock/8354746836573fff7c1120.jpg', 4, 2, 12, '2', '213', '123', 1, 1, '123'),
(17, 'equipment', 'assests/images/stock/99529368365740170b8df3.jpg', 2, 1, 5, '2', 'serial number', 'pn', 1, 1, ''),
(18, 'uiuiasd', 'assests/images/stock/645347979657401b3137ff.jpg', 4, 2, 16, '2', 'cccc', 'bbbb', 1, 1, 'aaa'),
(19, 'eeee', 'assests/images/stock/1951541778657401c7ae54b.jpg', 2, 3, 14, '22', 'sss', 'ppp', 1, 1, 'rrr'),
(21, 'newest', 'assests/images/stock/737435655657402a93a640.jpg', 3, 2, 11, '2', 'newest', 'newest', 1, 1, 'newest');

-- --------------------------------------------------------

--
-- Table structure for table `s_users`
--

CREATE TABLE `s_users` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `emailadd` varchar(255) NOT NULL,
  `college` varchar(255) NOT NULL,
  `program` varchar(255) NOT NULL,
  `year_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `s_users`
--

INSERT INTO `s_users` (`user_id`, `fname`, `lname`, `emailadd`, `college`, `program`, `year_level`) VALUES
(4, 'fname ', 'lname', '', 'asd', 'asd', 0),
(5, 'asd', 'jjkjk', '', 'kj', 'kj', 0),
(6, 'jkjk', 'jkjkj', '', 'jkjkj', 'kjkjk', 0),
(7, 'sadasd', 'jkljllkl', '', 'College of Business and Accountancy', 'Accountancy', 0),
(8, 'John', 'Fabia', '', 'College of Arts and Humanities', 'Political Science', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `role`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '', 'admin'),
(2, 'staff', '5f4dcc3b5aa765d61d8327deb882cf99', 'staff@stockmg.com', 'user'),
(3, 'sad', '8d41627e46d5b8556d0d3e30ec15538e', 'sad', 'user'),
(4, 'email', '1a1dc91c907325c69271ddf0c944bc72', 'email', 'user'),
(5, 'jkjkjk', '771f01104d905386a134a676167edccc', 'jkjkjk', 'user'),
(6, 'kjkjkj', 'ed474ee8e3b2f7c00e406d57c76c9638', 'kjkjkj', 'user'),
(7, 'cfyvgubhinjomkl,', '34da1e365fd56ec090a539cfe4202664', 'cfyvgubhinjomkl,', 'user'),
(8, 'john', '527bd5b5d689e2c32ae974c6229ff785', 'john', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `borrow_history`
--
ALTER TABLE `borrow_history`
  ADD PRIMARY KEY (`borrow_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categories_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `remarks` (`remarks`),
  ADD KEY `remarks_2` (`remarks`);

--
-- Indexes for table `s_users`
--
ALTER TABLE `s_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `borrow_history`
--
ALTER TABLE `borrow_history`
  MODIFY `borrow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categories_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `s_users`
--
ALTER TABLE `s_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
