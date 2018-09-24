-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.38 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for estore
CREATE DATABASE IF NOT EXISTS `estore` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `estore`;

-- Dumping structure for table estore.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_product` int(11) NOT NULL,
  `product_price` int(11) DEFAULT NULL,
  `id_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cart_users` (`id_user`),
  KEY `FK_cart_products` (`id_product`),
  CONSTRAINT `FK_cart_products` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`),
  CONSTRAINT `FK_cart_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

-- Dumping data for table estore.cart: ~1 rows (approximately)
DELETE FROM `cart`;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;

-- Dumping structure for table estore.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `id_order_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_orders_users` (`id_user`),
  CONSTRAINT `FK_orders_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table estore.orders: ~3 rows (approximately)
DELETE FROM `orders`;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Dumping structure for table estore.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(200) DEFAULT NULL,
  `product_price` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table estore.products: ~8 rows (approximately)
DELETE FROM `products`;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `product_name`, `product_price`) VALUES
	(1, 'WHITE T-SHIRT', NULL),
	(2, 'RED T-SHIRT', NULL),
	(3, 'BLUE JACKET', NULL),
	(4, 'FLOWERED DRESS', NULL),
	(5, 'BLACK AND WHITE DRESS', NULL),
	(6, 'GREY JACKET', NULL),
	(7, 'BIEGE PANTS', NULL),
	(8, 'WHITE SHORTS', NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Dumping structure for table estore.product_properties_values
CREATE TABLE IF NOT EXISTS `product_properties_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property_value` varchar(200) NOT NULL DEFAULT '0',
  `id_product` int(11) DEFAULT NULL,
  `id_property` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_product_properties_values_products` (`id_product`),
  CONSTRAINT `FK_product_properties_values_products` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table estore.product_properties_values: ~8 rows (approximately)
DELETE FROM `product_properties_values`;
/*!40000 ALTER TABLE `product_properties_values` DISABLE KEYS */;
INSERT INTO `product_properties_values` (`id`, `property_value`, `id_product`, `id_property`) VALUES
	(1, 'white_t-shirt.png', 1, 1),
	(2, 'red_t-shirt.png', 2, 1),
	(3, 'blue_jacket.png', 3, 1),
	(4, 'flowered_dress.png', 4, 1),
	(5, 'black_and_white_dress.png', 5, 1),
	(6, 'grey_jacket.png', 6, 1),
	(7, 'biege_pants.png', 7, 1),
	(8, 'white_shorts.png', 8, 1);
/*!40000 ALTER TABLE `product_properties_values` ENABLE KEYS */;

-- Dumping structure for table estore.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table estore.users: ~0 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
