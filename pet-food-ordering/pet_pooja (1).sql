-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2025 at 01:22 PM
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
-- Database: `pet_pooja`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `service` varchar(255) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `status` enum('Pending','Approved','Cancelled') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `user_id`, `name`, `email`, `phone`, `service`, `doctor_id`, `appointment_date`, `appointment_time`, `status`, `created_at`) VALUES
(1, 0, 'Sabale Pranav ', 'sabalepranav42@gmail.com', '8788400806', 'Dog Injured', 1, '2025-04-15', '12:00:00', '', '2025-03-11 03:23:30');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `customer_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `status`, `created_at`, `customer_name`, `address`, `phone`) VALUES
(1, 1, 500.00, 'Delivered', '2025-03-11 03:07:54', '', '', ''),
(2, 2, 1200.50, 'Shipped', '2025-03-11 03:07:54', '', '', ''),
(16, 0, 2200.00, 'Delivered', '2025-03-11 19:29:53', '', 'Loni', '8788400806');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `image`, `category`) VALUES
(1, 'Dog Collar', 499.00, 'Adjustable Collar for Dogs', 'dog_collar.jpg', 'accessory'),
(2, 'Cat Toy', 299.00, 'Soft Ball Toy for Cats', 'cat_toy.jpg', 'accessory'),
(3, 'Bird Cage', 1500.00, 'Large Metal Bird Cage', 'bird_cage.jpg', 'accessory'),
(4, 'Fish Tank', 2500.00, 'Glass Fish Tank with LED Lights', 'fish_tank.jpg', 'accessory'),
(5, 'Dog Bed', 1200.00, 'Soft Comfortable Dog Bed', 'dog_bed.jpg', 'accessory'),
(7, 'Horse Saddle', 2500.00, 'Premium leather horse saddle', 'horse_saddle.jpg', 'accessory'),
(8, 'Pedigree Chicken Dog Food', 500.00, 'High-protein chicken-flavored food for dogs.', 'pedigree.jpg', 'dog_food'),
(9, 'Drools Adult Dog Food', 700.00, 'Nutrient-rich dry food for adult dogs.', 'drools_adult.jpg', 'dog_food'),
(10, 'Royal Canin Puppy Food', 1200.00, 'Specially formulated for puppy growth.', 'royal_canin_puppy.jpg', 'dog_food'),
(11, 'Pedigree Gravy Dog Food', 300.00, 'Delicious wet food with real meat chunks.', 'pedigree_gravy.jpg', 'dog_food'),
(12, 'PurePet Chicken & Milk', 450.00, 'Complete diet with essential vitamins for dogs.', 'purepet.jpg', 'dog_food'),
(13, 'Whiskas Tuna Cat Food', 400.00, 'Tasty tuna-flavored cat food.', 'whiskas_tuna.jpg', 'cat_food'),
(14, 'Me-O Ocean Fish Cat Food', 600.00, 'Protein-packed fish-flavored meal for cats.', 'meo_ocean_fish.jpg', 'cat_food'),
(15, 'Royal Canin Kitten Food', 900.00, 'Nutritious food for growing kittens.', 'royal_canin_kitten.jpg', 'cat_food'),
(16, 'Sheba Wet Cat Food', 350.00, 'Soft and moist wet food for picky eaters.', 'sheba_wet.jpg', 'cat_food'),
(17, 'Purina One Chicken Cat Food', 700.00, 'High-protein dry food for adult cats.', 'purina_one.jpg', 'cat_food'),
(18, 'Tetra Bits Fish Food', 250.00, 'Premium food for all aquarium fish.', 'tetra_bits.jpg', 'fish_food'),
(19, 'Hikari Tropical Fish Food', 450.00, 'Balanced diet for tropical fish.', 'hikari_tropical.jpg', 'fish_food'),
(20, 'Optimum Goldfish Food', 150.00, 'Nutritious food for goldfish.', 'optimum_goldfish.jpg', 'fish_food'),
(21, 'Taiyo Koi Fish Food', 500.00, 'Specialized food for koi fish.', 'taiyo_koi.jpg', 'fish_food'),
(22, 'Sera Guppy Granules', 200.00, 'Soft granules for guppies and small fish.', 'sera_guppy.jpg', 'fish_food'),
(23, 'Sunseed Parrot Food', 350.00, 'Essential diet for parrots.', 'sunseed_parrot.jpg', 'bird_food'),
(24, 'Vitapol Budgie Food', 300.00, 'Healthy and tasty food for budgies.', 'vitapol_budgie.jpg', 'bird_food'),
(25, 'Wagner’s Wild Bird Food', 500.00, 'Premium mix for wild and pet birds.', 'wagners_wild.jpg', 'bird_food'),
(26, 'Kaytee Finch Food', 450.00, 'Nutritious blend for finches.', 'kaytee_finch.jpg', 'bird_food'),
(27, 'ZuPreem FruitBlend Pellets', 800.00, 'Balanced diet for all bird types.', 'zupreem_pellets.jpg', 'bird_food'),
(28, 'Purina Omolene Horse Feed', 1200.00, 'Energy-rich feed for performance horses.', 'purina_omolene.jpg', 'horse_food'),
(29, 'Nutrena SafeChoice Horse Feed', 1000.00, 'Balanced nutrition for all horse breeds.', 'nutrena_safechoice.jpg', 'horse_food'),
(30, 'Tribute Kalm N Easy', 900.00, 'High-fiber diet for nervous horses.', 'tribute_kalm.jpg', 'horse_food'),
(31, 'Manna Pro Senior Horse Feed', 1100.00, 'Specialized diet for aging horses.', 'manna_pro_senior.jpg', 'horse_food'),
(32, 'Buckeye Nutrition Gro N Win', 950.00, 'Protein-packed supplement for horses.', 'buckeye_gro_n_win.jpg', 'horse_food');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `phone`, `address`, `role`, `created_at`) VALUES
(1, 'Admin', 'admin@example.com', 'admin123', '9876543210', 'Admin Office', 'admin', '2025-03-10 16:13:41'),
(2, 'Sabale Pranav ', 'sabalepranav42@gmail.com', '123', '8788400806', 'Loni', 'user', '2025-03-10 16:14:08'),
(3, 'Vikhe Sayali', 'vikhesayali@gmail.com', '123', '7559160257', 'Loni', 'user', '2025-03-28 16:41:26'),
(4, 'Bhushan Aware', 'abc@gmail.com', '1234', '1234567890', 'wakad', 'user', '2025-09-04 10:36:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
