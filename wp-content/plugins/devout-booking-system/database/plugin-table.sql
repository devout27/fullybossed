-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `wp_dc_suppliers`;
CREATE TABLE `wp_dc_suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `company` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
DROP TABLE IF EXISTS `wp_dc_supplier_emails`;
CREATE TABLE `wp_dc_supplier_emails` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `wp_dc_supplier_orders`;
CREATE TABLE `wp_dc_supplier_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `main_order_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` int(11) DEFAULT '1' COMMENT '1-Intelition 2-Sent',
  `subtotal` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `order_note` varchar(250) DEFAULT NULL,
  `supplier_email` varchar(250) DEFAULT NULL,
  `preferred_delivery_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `wp_dc_supplier_order_items`;
CREATE TABLE `wp_dc_supplier_order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `product_custumer_price` decimal(10,2) DEFAULT NULL COMMENT 'Product Ka FrontEnd Price',
  `preferred_delivery_date` date DEFAULT NULL,
  `supplier_price` decimal(10,2) DEFAULT NULL,
  `supplier_order_id` int(11) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `supplier_email` varchar(250) DEFAULT NULL,
  `main_order_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `wp_dc_supplier_product_prices`;
CREATE TABLE `wp_dc_supplier_product_prices` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT '0',
  `supplier_price` decimal(10,2) DEFAULT '0.00',
  `supplier_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- 2021-03-10 13:30:19
