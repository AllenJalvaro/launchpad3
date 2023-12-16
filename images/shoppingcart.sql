-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2023 at 09:56 PM
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
-- Database: `shoppingcart`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `added_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryID` int(11) NOT NULL,
  `categoryName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryID`, `categoryName`) VALUES
(1, 'Shoes'),
(2, 'Clothing');

-- --------------------------------------------------------

--
-- Table structure for table `featured_products`
--

CREATE TABLE `featured_products` (
  `featuredID` int(11) NOT NULL,
  `productID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `featured_products`
--

INSERT INTO `featured_products` (`featuredID`, `productID`) VALUES
(3, 8),
(1, 11),
(2, 13);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `desc` text NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `rrp` decimal(7,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL,
  `img` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `desc`, `price`, `rrp`, `quantity`, `img`, `date_added`) VALUES
(6, 'Fitness Tracker Band', 'The \"Fitness Tracker Band\" is a sleek and versatile wearable designed to enhance your fitness journey. With advanced features such as heart rate monitoring, step tracking, and sleep analysis, this band provides comprehensive insights into your daily activities. Its stylish design ensures comfort throughout workouts or daily wear, while the intuitive interface allows for easy navigation. Stay motivated and achieve your fitness goals with the Fitness Tracker Band – your reliable companion for a healthier lifestyle.', 3999.99, 4599.99, 194, 'fitnesstrackerband.jpg', '2023-12-12 22:30:53'),
(7, 'Kettlebell', 'Kettle bell is a versatile and dynamic fitness tool, essential for strength training and functional workouts. Crafted from durable materials, our kettlebells offer a comfortable grip and balanced design, allowing users to engage in a wide range of exercises to target various muscle groups. Ideal for both beginners and seasoned fitness enthusiasts, these kettlebells are perfect for enhancing cardiovascular fitness, building strength, and promoting overall wellness. Elevate your home gym experience with our high-quality kettlebells, designed to deliver effective and efficient workouts. ', 598.00, 698.00, 47, 'kettlebell.jpg', '2023-12-12 22:33:09'),
(8, 'Protein Bar', 'Indulge in our high-protein bars, the perfect on-the-go snack to fuel your active lifestyle. Packed with premium protein, these bars offer a delicious and convenient way to support your muscle recovery and energy needs. Whether you\'re hitting the gym or craving a nutritious treat, our protein bars provide a tasty blend of flavors while delivering the essential nutrients your body deserves. ', 28.00, 32.00, 235, 'proteinbar.jpg', '2023-12-12 22:34:25'),
(9, 'Yoga Mat', 'Discover the perfect companion for your yoga practice with our premium Yoga Mat. Designed for optimal comfort and support, this non-slip mat provides a stable foundation for your poses. The durable and eco-friendly material ensures longevity, while the lightweight design makes it convenient for on-the-go yogis. Elevate your practice with a mat that combines functionality with style, offering a slip-resistant surface and easy maintenance. Embrace the serenity of your yoga journey with our high-quality Yoga Mat, an essential for every mindful practitioner.', 589.30, 679.50, 34, 'yogamat.jpg', '2023-12-12 22:35:37'),
(10, 'Resistance Bands for Working Out', 'Enhance your workout routine with our Fabric Resistance Bands Set designed for both women and men. These booty bands provide targeted resistance, making them ideal for leg workouts. Whether you\'re at the gym or in the comfort of your home, these exercise bands are perfect for strengthening and toning your lower body. The set includes a variety of resistance levels, allowing you to customize your fitness routine. Elevate your exercise experience with these durable and versatile workout bands, crafted for maximum comfort and effectiveness. Achieve your fitness goals with style and convenience using our premium Fabric Resistance Bands.', 340.00, 0.00, 57, 'resistancebands.jpg', '2023-12-12 22:40:11'),
(11, 'Active Quick Dry Crew T Shirts', 'The \"Active Quick Dry Crew T-Shirts\" are the perfect blend of comfort and functionality. Crafted with a quick-drying fabric, these T-shirts keep you cool and dry during intense workouts or active pursuits. The crew neck design offers a classic and versatile look, suitable for both exercise and casual wear. Whether you\'re hitting the gym or navigating a busy day, these T-shirts provide the breathability and moisture-wicking performance you need to stay comfortable and stylish throughout your activities. Elevate your active wardrobe with these essential and high-performance quick-dry T-shirts.', 499.75, 0.00, 47, 'gymshirt.jpg', '2023-12-12 23:05:50'),
(12, 'Quick Dry Activewear with Pockets', 'Elevate your game with our Athletic Basketball Shorts – a perfect blend of style and functionality. Crafted from breathable mesh fabric, these shorts offer quick-dry technology to keep you cool and comfortable on and off the court. Featuring convenient pockets for added versatility, these activewear shorts are designed to enhance your performance while providing a sleek and modern look. Whether you\'re hitting the gym or dominating the basketball court, our Athletic Basketball Shorts are your go-to choice for superior comfort and athletic style.', 395.25, 0.00, 187, 'shorts.jpg', '2023-12-12 23:05:50'),
(13, 'Ultraboost 22 Running Shoes', 'Experience peak performance with our Men\'s Ultraboost 22 Running Shoes. Engineered for comfort and speed, these cutting-edge running shoes feature advanced cushioning technology for a responsive and energized run. The sleek design combines style with functionality, providing a perfect blend of support and flexibility. Whether you\'re hitting the track or the pavement, these Ultraboost 22 Running Shoes deliver unparalleled comfort and performance, making every run an exhilarating experience.', 1999.50, 2799.80, 9, 'shoes.jpg', '2023-12-12 23:10:08'),
(14, 'Breathable Sneakers ONEMIX', 'Experience the perfect blend of comfort and style with ONEMIX Light Armor 21601 Breathable Sneakers. Designed for the modern individual, these sneakers feature advanced breathable technology that keeps your feet cool and comfortable throughout the day. The Light Armor series combines sleek aesthetics with innovative materials, ensuring a lightweight feel without compromising durability. Whether you\'re hitting the gym, running errands, or simply enjoying a casual day out, these sneakers provide the ideal balance of support and breathability. Elevate your footwear collection with ONEMIX Light Armor 21601, where fashion meets functionality for the active lifestyle.', 11499.99, 27000.99, 3, 'onemix.jpg', '2023-12-12 23:10:08'),
(15, 'IRON °FLASK Sports Water Bottle', 'The \"IRON °FLASK Sports Water Bottle\" is a premium hydration solution designed for active lifestyles. Crafted with durable stainless steel, this sports water bottle is built to withstand the demands of your toughest workouts. With a sleek and modern design, it not only delivers on performance but also makes a stylish statement. The double-wall vacuum insulation keeps your beverages at the desired temperature, whether you\'re enjoying a refreshing cold drink or a piping hot beverage. The wide-mouth opening ensures easy filling, and the leak-proof lid guarantees a mess-free experience on the go. Stay hydrated in style with the IRON °FLASK Sports Water Bottle, your reliable companion for all your fitness endeavors.', 599.00, 0.00, 35, 'tumblr.jpg', '2023-12-13 02:46:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`) VALUES
(1, 'allen'),
(2, 'patrick'),
(3, 'vincent');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `featured_products`
--
ALTER TABLE `featured_products`
  ADD PRIMARY KEY (`featuredID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `featured_products`
--
ALTER TABLE `featured_products`
  MODIFY `featuredID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `featured_products`
--
ALTER TABLE `featured_products`
  ADD CONSTRAINT `featured_products_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
