-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 20, 2020 at 07:13 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bus465`
--
DROP DATABASE bus465;
CREATE DATABASE bus465;
-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `delivery_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`id`, `start_date`, `end_date`, `delivery_date`) VALUES
(1, '2020-09-06', '2020-09-12', '2020-09-13'),
(2, '2020-09-13', '2020-09-19', '2020-09-20'),
(3, '2020-09-20', '2020-09-26', '2020-09-27'),
(4, '2020-09-27', '2020-10-03', '2020-10-04'),
(5, '2020-10-04', '2020-10-10', '2020-10-11'),
(6, '2020-10-11', '2020-10-17', '2020-10-18'),
(7, '2020-10-18', '2020-10-24', '2020-10-25'),
(8, '2020-10-25', '2020-10-31', '2020-11-01'),
(9, '2020-11-01', '2020-11-07', '2020-11-08');

-- --------------------------------------------------------

--
-- Table structure for table `batch_items`
--

CREATE TABLE `batch_items` (
  `id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `max_quantity` int(2) NOT NULL,
  `quantity_sold` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `batch_items`
--

INSERT INTO `batch_items` (`id`, `batch_id`, `product_id`, `max_quantity`, `quantity_sold`) VALUES
(1, 1, 13, 10, 0),
(2, 1, 9, 5, 0),
(7, 1, 1, 8, 0),
(8, 1, 11, 15, 0),
(9, 1, 5, 20, 0),
(10, 1, 8, 10, 0),
(11, 4, 13, 5, 0),
(12, 8, 13, 10, 0),
(13, 8, 17, 10, 0),
(15, 7, 17, 0, 0),
(16, 1, 12, 6, 0),
(17, 9, 18, 10, 0),
(18, 7, 18, 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `batch_item_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `quantity` int(2) NOT NULL,
  `active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `email` varchar(320) NOT NULL,
  `dob` date NOT NULL,
  `password` varchar(64) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `street_1` varchar(255) DEFAULT NULL,
  `street_2` varchar(255) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `zip_code` varchar(6) DEFAULT NULL,
  `country` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `email`, `dob`, `password`, `first_name`, `last_name`, `phone`, `street_1`, `street_2`, `city`, `state`, `zip_code`, `country`) VALUES
(1, 'test@gmail.com', '1990-01-01', '$2y$10$ut2iJvSAwtBRW0MCP6A40O1NrAhkHHjM1Utj11RzUStkxJ4YAVt3u', 'Test', 'Guy', '7781234567', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'h.hiro129@gmail.com', '1998-01-29', '$2y$10$lMez.bhw/E2r/QLFhHt2U.ZNt7fMyvGO6G4zC8yugGgnHzgkvNZFm', 'Hiro', 'Nomura', '7789299987', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'test123@gmail.com', '1990-01-01', '$2y$10$ywrMqukJC2zbkjbwI3BNIuaCsdAU7URY28crfWHdpSKsVEoqfGIFq', 'Test', 'Guy123', '7781234567', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `email` varchar(320) NOT NULL,
  `date` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `street_1` varchar(255) DEFAULT NULL,
  `street_2` varchar(255) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `zip_code` varchar(6) DEFAULT NULL,
  `country` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_id` int(11) NOT NULL,
  `batch_item_id` int(11) NOT NULL,
  `quantity` int(2) NOT NULL,
  `price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `sender_email` varchar(320) DEFAULT NULL,
  `amount` decimal(6,2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `description` text,
  `img_link` varchar(255) NOT NULL DEFAULT 'img/placeholder.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `active`, `description`, `img_link`) VALUES
(1, 'Sugar pie', '33.89', 1, 'Sugar pie is a typical dessert of the western European countries of Northern France and Belgium; in the province of Quebec and French-Canadian communities throughout Canada, where it is called tarte au sucre; and the Midwestern United States states.\r\n', 'img/placeholder.png'),
(2, 'Sugar cookies', '22.31', 1, 'A sugar cookie is a cookie with the main ingredients being sugar, flour, butter, eggs, vanilla, and either baking powder or baking soda. Sugar cookies may be formed by hand, dropped, or rolled and cut into shapes. They are commonly decorated with additional sugar, icing, sprinkles, or a combination of these.', 'img/placeholder.png'),
(3, 'Shortcake', '3.88', 1, 'Shortcake is a sweet cake or biscuit in the American sense that is a crumbly bread that has been leavened with baking powder or baking soda. In the UK, the term shortcake refers to a biscuit similar to shortbread. They are generally less dense and more crunchy and dry than shortbread. ', 'img/placeholder.png'),
(4, 'Granola bar', '47.43', 1, 'Granola bars (or muesli bars) have become popular as a snack, similar to the traditional flapjack familiar in the Commonwealth countries. Granola bars consist of granola mixed with honey or other sweetened syrup, pressed and baked into a bar shape, resulting in the production of a more convenient snack.', 'img/placeholder.png'),
(5, 'Eclairs', '45.95', 1, 'An éclair is an oblong pastry made with choux dough filled with a cream and topped with chocolate icing. The dough, which is the same as that used for profiterole, is typically piped into an oblong shape with a pastry bag and baked until it is crisp and hollow inside.', 'img/placeholder.png'),
(6, 'Doughnut', '24.21', 1, 'A doughnut or donut is a type of fried dough confection or dessert food. The doughnut is popular in many countries and is prepared in various forms as a sweet snack that can be homemade or purchased in bakeries, supermarkets, food stalls, and franchised specialty vendors. ', 'img/placeholder.png'),
(7, 'Croissant', '33.00', 1, 'A croissant is a buttery, flaky, viennoiserie pastry of Austrian origin, named for its historical crescent shape. Croissants and other viennoiserie are made of a layered yeast-leavened dough.', 'img/placeholder.png'),
(8, 'Chocolate', '2.80', 1, 'Chocolate is a preparation of roasted and ground cacao seeds that is made in the form of a liquid, paste, or in a block, which may also be used as a flavoring ingredient in other foods.', 'img/placeholder.png'),
(9, 'Cheesecake', '12.11', 1, 'Cheesecake is a sweet dessert consisting of one or more layers. The main, and thickest layer, consists of a mixture of soft, fresh cheese, eggs, and sugar. If there is a bottom layer, it often consists of a crust or base made from crushed cookies, graham crackers, pastry, or sometimes sponge cake. ', 'img/placeholder.png'),
(10, 'Brownies', '46.75', 1, 'A chocolate brownie or simply a brownie is a square or rectangular chocolate baked confection. Brownies come in a variety of forms and may be either fudgy or cakey, depending on their density. They may include nuts, frosting, cream cheese, chocolate chips, or other ingredients. ', 'img/placeholder.png'),
(11, 'Boston cream pie', '25.34', 1, 'A Boston cream pie is an American dessert consisting of a yellow butter cake filled with custard or cream and topped with chocolate glaze. The dessert acquired its name when cakes and pies were cooked in the same pans, and the words were used interchangeably.', 'img/placeholder.png'),
(12, 'Biscuit', '46.10', 1, 'A biscuit is a flour-based baked food product. Outside North America the biscuit is typically hard, flat, and unleavened; in North America it is typically a soft, leavened quick bread.', 'img/placeholder.png'),
(13, 'Banana bread', '47.16', 1, 'Banana bread is a type of bread made from mashed bananas. It is often a moist, sweet, cake-like quick bread; however there are some banana bread recipes that are traditional-style raised breads.', 'img/placeholder.png'),
(17, 'Waffles', '11.00', 1, 'This is a Belgian Waffle. Tastes very good.', 'img/productimage/17_waffles.jpg'),
(18, 'Matcha Cookie', '99.99', 1, 'This is a Matcha Cookie.', 'img/productimage/18_matcha cookie.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batch_items`
--
ALTER TABLE `batch_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `batch_id` (`batch_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`batch_item_id`,`cart_id`),
  ADD KEY `cart_id` (`cart_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_id`,`batch_item_id`),
  ADD KEY `batch_item_id` (`batch_item_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `batch_items`
--
ALTER TABLE `batch_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `batch_items`
--
ALTER TABLE `batch_items`
  ADD CONSTRAINT `batch_items_ibfk_1` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`),
  ADD CONSTRAINT `batch_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`batch_item_id`) REFERENCES `batch_items` (`id`),
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`batch_item_id`) REFERENCES `batch_items` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
