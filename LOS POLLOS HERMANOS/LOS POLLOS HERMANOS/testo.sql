-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2025 at 01:19 AM
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
-- Database: `testo`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `zip_code` varchar(20) NOT NULL,
  `delivery_method` enum('Home Delivery','Pickup') NOT NULL,
  `payment_method` enum('Credit Card','Mobile Pay','Cash') NOT NULL,
  `special_instructions` text DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `delivery_fee` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','Preparing','Out for Delivery','Delivered','Cancelled') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_name`, `phone`, `email`, `address`, `city`, `zip_code`, `delivery_method`, `payment_method`, `special_instructions`, `subtotal`, `delivery_fee`, `tax`, `total`, `order_date`, `status`) VALUES
(1, 'John Doe', '+20123456789', 'john@example.com', '123 Main St', 'Cairo', '11511', 'Home Delivery', 'Credit Card', NULL, 340.00, 30.00, 17.00, 387.00, '2025-05-03 20:11:00', 'Pending'),
(2, 'Sarah Smith', '+20112233445', 'sarah@example.com', '456 Park Ave', 'Alexandria', '21500', 'Pickup', 'Cash', NULL, 520.00, 0.00, 26.00, 546.00, '2025-05-03 20:28:34', 'Pending'),
(3, 'Michael Johnson', '+20105556677', 'michael@example.com', '789 Palm St', 'Giza', '12511', 'Home Delivery', 'Credit Card', NULL, 590.00, 30.00, 31.00, 651.00, '2025-05-03 20:28:34', 'Pending'),
(4, 'Ahmed Hassan', '+20108765432', 'ahmed@example.com', '321 Garden St', 'Nasr City', '11765', 'Home Delivery', '', NULL, 470.00, 25.00, 24.75, 519.75, '2025-05-03 20:30:23', 'Pending'),
(5, 'Layla Mohamed', '+20111222333', 'layla@example.com', '654 Olive Rd', 'Maadi', '11431', 'Pickup', 'Credit Card', NULL, 310.00, 0.00, 15.50, 325.50, '2025-05-03 20:30:23', 'Pending'),
(6, 'yahia Adel', '01003275141', 'yahiaadel884@gmail.com', 'Waterway', 'Cairo', '4740103', 'Home Delivery', 'Credit Card', '', 470.00, 30.00, 23.50, 523.50, '2025-05-03 20:52:11', 'Pending'),
(7, 'dsa asd', '01275496000', 'sadsa@gmail.com', 'MOON', 'Cairo', '4740103', 'Pickup', 'Cash', '', 180.00, 0.00, 9.00, 189.00, '2025-05-03 20:56:39', 'Pending'),
(8, 'Yehia Selim', '01275496000', 'yaya@gg', 'MOON', 'Cairo', '12424', 'Home Delivery', 'Cash', '', 220.00, 30.00, 11.00, 261.00, '2025-05-03 21:17:28', 'Pending'),
(9, 'lol olo', '01275496000', 'lolo@lol', 'MOON', 'Cairo', '12424', 'Pickup', 'Cash', 'dasfasdfads', 60.00, 0.00, 3.00, 63.00, '2025-05-03 22:09:06', 'Pending'),
(10, 'lol olo', '01275496000', 'lolo@lol', 'MOON', 'Cairo', '12424', 'Home Delivery', 'Cash', '', 280.00, 30.00, 14.00, 324.00, '2025-05-04 02:12:32', 'Pending'),
(11, 'yahia Adel', '01003275141', 'yahiaadel884@gmail.com', 'Waterway', 'Cairo', '4740103', 'Home Delivery', 'Credit Card', '', 950.00, 30.00, 47.50, 1027.50, '2025-05-04 03:18:01', 'Pending'),
(12, 'lol olo', '01275496000', 'lolo@lol', 'MOON', 'Cairo', '12424', 'Pickup', 'Credit Card', '', 370.00, 0.00, 18.50, 388.50, '2025-05-04 12:05:30', 'Pending'),
(13, 'yahia Adel', '01003275141', 'yahiaadel884@gmail.com', 'Waterway', 'Cairo', '4740103', 'Home Delivery', 'Credit Card', '', 935.00, 30.00, 46.75, 1011.75, '2025-05-04 22:24:58', 'Pending'),
(14, 'yahia Adel', '01003275141', 'yahiaadel884@gmail.com', 'Waterway', 'Cairo', '4740103', 'Home Delivery', 'Credit Card', '', 300.00, 30.00, 15.00, 345.00, '2025-05-04 22:28:17', 'Pending'),
(15, 'ggg', '2952623', 'mohannedelsssawy4@gmsil.com', 'wdsaxa', 'yyyyeeeeee', '25265', 'Home Delivery', 'Credit Card', '', 150.00, 30.00, 7.50, 187.50, '2025-05-04 23:54:44', 'Pending'),
(16, 'weee', '2581151', 'mokkaaa@gmail.com', 'asdsadaz', 'asddaasdas', '266', 'Home Delivery', 'Credit Card', '', 315.00, 30.00, 15.75, 360.75, '2025-05-05 01:19:42', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `size` enum('Regular','Large') NOT NULL,
  `meal_option` enum('Burger Only','With Fries','With Drink','Combo') NOT NULL,
  `addons` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `product_name`, `quantity`, `unit_price`, `size`, `meal_option`, `addons`) VALUES
(1, 1, 1, 'Bacon Mushroom Jack', 1, 200.00, 'Large', 'Combo', '[\"Extra Cheese\", \"Bacon\"]'),
(2, 2, 2, 'Spicy Chicken Ranch', 2, 180.00, '', 'Combo', '[\"Extra Sauce\"]'),
(3, 2, 3, 'Veggie Delight', 1, 160.00, '', '', '[\"Avocado\"]'),
(4, 3, 4, 'Classic Cheeseburger', 1, 150.00, 'Large', 'Combo', '[\"Extra Pickles\"]'),
(5, 3, 5, 'BBQ Bacon Burger', 2, 220.00, '', 'Combo', '[\"Extra Bacon\", \"Onion Rings\"]'),
(6, 4, 6, 'Classic Pepperoni', 1, 250.00, 'Large', '', '[\"Extra Cheese\", \"Extra Pepperoni\"]'),
(7, 4, 7, 'Margherita', 1, 220.00, '', '', '[\"Fresh Basil\"]'),
(8, 5, 8, 'Garlic Bread', 2, 60.00, 'Regular', '', '[\"Extra Garlic\"]'),
(9, 5, 6, 'Classic Pepperoni', 1, 250.00, '', '', '[\"Olives\"]'),
(10, 6, 6, 'Classic Pepperoni', 1, 250.00, 'Large', 'With Drink', 'Avocado'),
(11, 6, 7, 'Margherita', 1, 220.00, 'Large', 'Combo', 'Jalapeños'),
(12, 7, 2, 'Spicy Chicken Ranch', 1, 180.00, 'Large', 'Combo', 'Extra Cheese, Extra Bacon, Jalapeños, Onion Rings'),
(13, 8, 5, 'BBQ Bacon Burger', 1, 220.00, 'Large', 'Combo', 'Jalapeños'),
(14, 9, 8, 'Garlic Bread', 1, 60.00, 'Large', 'Combo', 'Jalapeños'),
(15, 10, 5, 'BBQ Bacon Burger', 1, 220.00, 'Regular', 'Combo', ''),
(16, 11, 11, 'Meat Lovers Pizza', 1, 270.00, 'Large', 'Combo', 'Extra Cheese, Jalapeños'),
(17, 11, 5, 'BBQ Bacon Burger', 1, 220.00, 'Large', 'Combo', 'Extra Cheese'),
(18, 11, 15, 'Onion Rings', 1, 65.00, 'Regular', 'Burger Only', ''),
(19, 11, 21, 'Tiramisu', 1, 130.00, 'Large', 'Burger Only', 'Chocolate Sauce'),
(20, 12, 6, 'Classic Pepperoni', 1, 250.00, 'Large', 'With Fries', 'Extra Cheese, Extra Bacon'),
(21, 13, 6, 'Classic Pepperoni', 1, 250.00, 'Large', 'Combo', 'Extra Cheese, Jalapeños'),
(22, 13, 2, 'Spicy Chicken Ranch', 1, 180.00, 'Large', 'Combo', 'Extra Cheese, Jalapeños'),
(23, 13, 15, 'Onion Rings', 1, 65.00, 'Large', 'Burger Only', ''),
(24, 13, 21, 'Tiramisu', 1, 130.00, 'Large', 'Burger Only', 'Chocolate Sauce, Nuts '),
(25, 14, 7, 'Margherita', 1, 220.00, 'Large', 'With Drink', 'Extra Cheese'),
(26, 15, 19, 'Chocolate Lava Cake', 1, 120.00, 'Regular', 'With Drink', 'Sprinkles '),
(27, 16, 12, 'Vegetarian Pizza', 1, 210.00, 'Large', 'Combo', 'Jalapeños');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_description` text NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_price`, `product_image`, `product_category`, `product_description`, `is_active`, `created_at`) VALUES
(1, 'Bacon Mushroom Jack', 200.00, 'bcnmashr.png', 'Burgers', 'Beef patty with bacon, sautéed mushrooms, cheddar cheese, and mayo', 1, '2025-05-03 20:11:00'),
(2, 'Spicy Chicken Ranch', 180.00, 'spicychickenranch.png', 'Burgers', 'Crispy chicken with spicy ranch sauce, lettuce, and tomato', 1, '2025-05-03 20:28:34'),
(3, 'Veggie Delight', 160.00, 'veggie.png', 'Burgers', 'Grilled vegetable patty with avocado, sprouts, and tahini sauce', 1, '2025-05-03 20:28:34'),
(4, 'Classic Cheeseburger', 150.00, 'cheeseburger.png', 'Burgers', 'Beef patty with American cheese, lettuce, tomato, and special sauce', 1, '2025-05-03 20:28:34'),
(5, 'BBQ Bacon Burger', 220.00, 'bbqburger.png', 'Burgers', 'Beef patty with crispy bacon, cheddar, and smoky BBQ sauce', 1, '2025-05-03 20:28:34'),
(6, 'Classic Pepperoni', 250.00, 'pepp.png', 'Pizza', 'Traditional pizza with tomato sauce, mozzarella, and premium pepperoni', 1, '2025-05-03 20:30:23'),
(7, 'Margherita', 220.00, 'marg.png', 'Pizza', 'Simple classic with tomato sauce, fresh mozzarella, and basil', 1, '2025-05-03 20:30:23'),
(8, 'Garlic Bread', 60.00, 'gar.png', 'Sides', 'Freshly baked bread with garlic butter and herbs', 1, '2025-05-03 20:30:23'),
(9, 'Double Cheese Bacon Burger', 240.00, 'doublebacon.png', 'Burgers', 'Double beef patties with double cheese, crispy bacon, and special sauce', 1, '2025-05-04 00:49:11'),
(10, 'Hawaiian Pizza', 230.00, 'hawai.png', 'Pizza', 'Tomato sauce, mozzarella, ham, and pineapple', 1, '2025-05-04 00:49:11'),
(11, 'Meat Lovers Pizza', 270.00, 'meat.png', 'Pizza', 'Tomato sauce, mozzarella, pepperoni, sausage, bacon, and ham', 1, '2025-05-04 00:49:11'),
(12, 'Vegetarian Pizza', 210.00, 'veget.png', 'Pizza', 'Tomato sauce, mozzarella, mushrooms, bell peppers, onions, and olives', 1, '2025-05-04 00:49:11'),
(13, 'BBQ Chicken Pizza', 260.00, 'bbqpizza.png', 'Pizza', 'BBQ sauce, mozzarella, grilled chicken, red onions, and cilantro', 1, '2025-05-04 00:49:11'),
(14, 'French Fries', 50.00, 'btates.png', 'Sides', 'Crispy golden fries with sea salt', 1, '2025-05-04 00:49:11'),
(15, 'Onion Rings', 65.00, 'onionrings.png', 'Sides', 'Crispy battered onion rings with dipping sauce', 1, '2025-05-04 00:49:11'),
(16, 'Mozzarella Sticks', 70.00, 'mozz.png', 'Sides', 'Breaded mozzarella sticks with marinara sauce', 1, '2025-05-04 00:49:11'),
(17, 'Chicken Wings', 90.00, 'wings.png', 'Sides', 'Crispy chicken wings with your choice of sauce', 1, '2025-05-04 00:49:11'),
(18, 'Caesar Salad', 80.00, 'cae.png', 'Sides', 'Fresh romaine lettuce with Caesar dressing, croutons, and parmesan', 1, '2025-05-04 00:49:11'),
(19, 'Chocolate Lava Cake', 120.00, 'lava.png', 'Desserts', 'Warm chocolate cake with a molten center, served with vanilla ice cream', 1, '2025-05-04 00:54:00'),
(20, 'New York Cheesecake', 110.00, 'checake.png', 'Desserts', 'Classic creamy cheesecake with strawberry topping', 1, '2025-05-04 00:54:00'),
(21, 'Tiramisu', 130.00, 'tira.png', 'Desserts', 'Layers of coffee-soaked ladyfingers and mascarpone cream', 1, '2025-05-04 00:54:00'),
(22, 'Apple Pie', 100.00, 'applepie.png', 'Desserts', 'Homemade apple pie with cinnamon, served warm with ice cream', 1, '2025-05-04 00:54:00'),
(23, 'Chocolate Brownie Sundae', 140.00, 'sundae.png', 'Desserts', 'Warm chocolate brownie topped with ice cream, chocolate sauce, and nuts', 1, '2025-05-04 00:54:00'),
(24, 'Churros', 90.00, 'chhh.png', 'Desserts', 'Crispy fried dough sticks with chocolate dipping sauce', 1, '2025-05-04 00:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'yahia', 'Adel', 'yahiaadel884@gmail.com', '$2y$10$6HZAUe3MARGWHLRllTpOKuyRuX.PBPC1g.L8MAV9A9klixp726yPa', '2025-05-04 00:00:06', '2025-05-04 00:00:06'),
(2, 'Yehia', 'Selim', 'yaya@gg', '$2y$10$QTtOh3.h3gMA/G05YprLrek9/TieiOlsoJkITI2ATMNf1CJ44K14G', '2025-05-04 00:05:02', '2025-05-04 00:05:02'),
(4, 'dsa', 'asd', 'sadsa@gmail.com', '$2y$10$x8iCFzAxdoFFhhxcq7w8u.jYDHOzC53pdnAkRVKvKuK4h6Rysi4rO', '2025-05-04 00:06:22', '2025-05-04 00:06:22'),
(6, 'lol', 'olo', 'lolo@lol', '$2y$10$ZCdRtrkkmF.h1bTuFnPB1.SBW.BLivXMpnBAWjtmqz5aUswptmq56', '2025-05-04 00:12:05', '2025-05-04 00:12:05'),
(7, 'yyyy', 'yyyy', 'mjmjm@gmail.com', '$2y$10$0hAY.x9qPB3GjgziAyKoMeSfX19G1LgnuLWjVu1ZamMh0jNxBMNpW', '2025-05-04 20:56:30', '2025-05-04 20:56:30'),
(8, 'ahmed', 'ehab', 'ahmedehab@gmail.com', '$2y$10$nF9b/E4mjmhGFLxCpPfId.QHYuQlOMN/s06ZlbZo2bdUqUmq6Jst2', '2025-05-04 22:21:25', '2025-05-04 22:21:25'),
(10, 'ahmed', 'ehab', 'ahmedeha8b@gmail.com', '$2y$10$oXswmZ20wsYjc/i51en6JemE2UPOgQoHUd9hDLrHzJCPoxUy3nJgO', '2025-05-04 22:22:27', '2025-05-04 22:22:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
