-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Superadmin',	'1',	1496065537);

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/*',	2,	NULL,	NULL,	NULL,	1495105750,	1495105750),
('/admin/*',	2,	NULL,	NULL,	NULL,	1495105749,	1495105749),
('/admin/assignment/*',	2,	NULL,	NULL,	NULL,	1495105748,	1495105748),
('/admin/assignment/assign',	2,	NULL,	NULL,	NULL,	1495105748,	1495105748),
('/admin/assignment/index',	2,	NULL,	NULL,	NULL,	1495105748,	1495105748),
('/admin/assignment/revoke',	2,	NULL,	NULL,	NULL,	1495105748,	1495105748),
('/admin/assignment/view',	2,	NULL,	NULL,	NULL,	1495105748,	1495105748),
('/admin/default/*',	2,	NULL,	NULL,	NULL,	1495105748,	1495105748),
('/admin/default/index',	2,	NULL,	NULL,	NULL,	1495105748,	1495105748),
('/admin/menu/*',	2,	NULL,	NULL,	NULL,	1495105748,	1495105748),
('/admin/menu/create',	2,	NULL,	NULL,	NULL,	1495105748,	1495105748),
('/admin/menu/delete',	2,	NULL,	NULL,	NULL,	1495105748,	1495105748),
('/admin/menu/index',	2,	NULL,	NULL,	NULL,	1495105748,	1495105748),
('/admin/menu/update',	2,	NULL,	NULL,	NULL,	1495105748,	1495105748),
('/admin/menu/view',	2,	NULL,	NULL,	NULL,	1495105748,	1495105748),
('/admin/permission/*',	2,	NULL,	NULL,	NULL,	1495105748,	1495105748),
('/admin/permission/assign',	2,	NULL,	NULL,	NULL,	1495105748,	1495105748),
('/admin/permission/create',	2,	NULL,	NULL,	NULL,	1495105748,	1495105748),
('/admin/permission/delete',	2,	NULL,	NULL,	NULL,	1495105748,	1495105748),
('/admin/permission/index',	2,	NULL,	NULL,	NULL,	1495105748,	1495105748),
('/admin/permission/remove',	2,	NULL,	NULL,	NULL,	1495105748,	1495105748),
('/admin/permission/update',	2,	NULL,	NULL,	NULL,	1495105748,	1495105748),
('/admin/permission/view',	2,	NULL,	NULL,	NULL,	1495105748,	1495105748),
('/admin/role/*',	2,	NULL,	NULL,	NULL,	1495105749,	1495105749),
('/admin/role/assign',	2,	NULL,	NULL,	NULL,	1495105749,	1495105749),
('/admin/role/create',	2,	NULL,	NULL,	NULL,	1495105748,	1495105748),
('/admin/role/delete',	2,	NULL,	NULL,	NULL,	1495105749,	1495105749),
('/admin/role/index',	2,	NULL,	NULL,	NULL,	1495105748,	1495105748),
('/admin/role/remove',	2,	NULL,	NULL,	NULL,	1495105749,	1495105749),
('/admin/role/update',	2,	NULL,	NULL,	NULL,	1495105749,	1495105749),
('/admin/role/view',	2,	NULL,	NULL,	NULL,	1495105748,	1495105748),
('/admin/route/*',	2,	NULL,	NULL,	NULL,	1495105749,	1495105749),
('/admin/route/assign',	2,	NULL,	NULL,	NULL,	1495105749,	1495105749),
('/admin/route/create',	2,	NULL,	NULL,	NULL,	1495105749,	1495105749),
('/admin/route/index',	2,	NULL,	NULL,	NULL,	1495105749,	1495105749),
('/admin/route/refresh',	2,	NULL,	NULL,	NULL,	1495105749,	1495105749),
('/admin/route/remove',	2,	NULL,	NULL,	NULL,	1495105749,	1495105749),
('/admin/rule/*',	2,	NULL,	NULL,	NULL,	1495105749,	1495105749),
('/admin/rule/create',	2,	NULL,	NULL,	NULL,	1495105749,	1495105749),
('/admin/rule/delete',	2,	NULL,	NULL,	NULL,	1495105749,	1495105749),
('/admin/rule/index',	2,	NULL,	NULL,	NULL,	1495105749,	1495105749),
('/admin/rule/update',	2,	NULL,	NULL,	NULL,	1495105749,	1495105749),
('/admin/rule/view',	2,	NULL,	NULL,	NULL,	1495105749,	1495105749),
('/admin/user/*',	2,	NULL,	NULL,	NULL,	1495105749,	1495105749),
('/admin/user/activate',	2,	NULL,	NULL,	NULL,	1495105749,	1495105749),
('/admin/user/change-password',	2,	NULL,	NULL,	NULL,	1495105749,	1495105749),
('/admin/user/delete',	2,	NULL,	NULL,	NULL,	1495105749,	1495105749),
('/admin/user/index',	2,	NULL,	NULL,	NULL,	1495105749,	1495105749),
('/admin/user/login',	2,	NULL,	NULL,	NULL,	1495105749,	1495105749),
('/admin/user/logout',	2,	NULL,	NULL,	NULL,	1495105749,	1495105749),
('/admin/user/request-password-reset',	2,	NULL,	NULL,	NULL,	1495105749,	1495105749),
('/admin/user/reset-password',	2,	NULL,	NULL,	NULL,	1495105749,	1495105749),
('/admin/user/signup',	2,	NULL,	NULL,	NULL,	1495105749,	1495105749),
('/admin/user/view',	2,	NULL,	NULL,	NULL,	1495105749,	1495105749),
('/base/*',	2,	NULL,	NULL,	NULL,	1496066913,	1496066913),
('/car/*',	2,	NULL,	NULL,	NULL,	1496066587,	1496066587),
('/car/bulk-delete',	2,	NULL,	NULL,	NULL,	1496066587,	1496066587),
('/car/create',	2,	NULL,	NULL,	NULL,	1496066587,	1496066587),
('/car/delete',	2,	NULL,	NULL,	NULL,	1496066587,	1496066587),
('/car/index',	2,	NULL,	NULL,	NULL,	1496066587,	1496066587),
('/car/update',	2,	NULL,	NULL,	NULL,	1496066587,	1496066587),
('/car/view',	2,	NULL,	NULL,	NULL,	1496066587,	1496066587),
('/customer/*',	2,	NULL,	NULL,	NULL,	1496066914,	1496066914),
('/customer/bulk-delete',	2,	NULL,	NULL,	NULL,	1496066914,	1496066914),
('/customer/create',	2,	NULL,	NULL,	NULL,	1496066913,	1496066913),
('/customer/delete',	2,	NULL,	NULL,	NULL,	1496066913,	1496066913),
('/customer/index',	2,	NULL,	NULL,	NULL,	1496066913,	1496066913),
('/customer/update',	2,	NULL,	NULL,	NULL,	1496066913,	1496066913),
('/customer/view',	2,	NULL,	NULL,	NULL,	1496066913,	1496066913),
('/debug/*',	2,	NULL,	NULL,	NULL,	1495105750,	1495105750),
('/debug/default/*',	2,	NULL,	NULL,	NULL,	1495105750,	1495105750),
('/debug/default/db-explain',	2,	NULL,	NULL,	NULL,	1495105749,	1495105749),
('/debug/default/download-mail',	2,	NULL,	NULL,	NULL,	1495105750,	1495105750),
('/debug/default/index',	2,	NULL,	NULL,	NULL,	1495105749,	1495105749),
('/debug/default/toolbar',	2,	NULL,	NULL,	NULL,	1495105750,	1495105750),
('/debug/default/view',	2,	NULL,	NULL,	NULL,	1495105750,	1495105750),
('/driver/*',	2,	NULL,	NULL,	NULL,	1496066914,	1496066914),
('/driver/bulk-delete',	2,	NULL,	NULL,	NULL,	1496066914,	1496066914),
('/driver/create',	2,	NULL,	NULL,	NULL,	1496066914,	1496066914),
('/driver/delete',	2,	NULL,	NULL,	NULL,	1496066914,	1496066914),
('/driver/index',	2,	NULL,	NULL,	NULL,	1496066914,	1496066914),
('/driver/update',	2,	NULL,	NULL,	NULL,	1496066914,	1496066914),
('/driver/view',	2,	NULL,	NULL,	NULL,	1496066914,	1496066914),
('/gii/*',	2,	NULL,	NULL,	NULL,	1495105750,	1495105750),
('/gii/default/*',	2,	NULL,	NULL,	NULL,	1495105750,	1495105750),
('/gii/default/action',	2,	NULL,	NULL,	NULL,	1495105750,	1495105750),
('/gii/default/diff',	2,	NULL,	NULL,	NULL,	1495105750,	1495105750),
('/gii/default/index',	2,	NULL,	NULL,	NULL,	1495105750,	1495105750),
('/gii/default/preview',	2,	NULL,	NULL,	NULL,	1495105750,	1495105750),
('/gii/default/view',	2,	NULL,	NULL,	NULL,	1495105750,	1495105750),
('/gridview/*',	2,	NULL,	NULL,	NULL,	1495105747,	1495105747),
('/gridview/export/*',	2,	NULL,	NULL,	NULL,	1495105747,	1495105747),
('/gridview/export/download',	2,	NULL,	NULL,	NULL,	1495105747,	1495105747),
('/report/*',	2,	NULL,	NULL,	NULL,	1496069359,	1496069359),
('/report/index',	2,	NULL,	NULL,	NULL,	1496069359,	1496069359),
('/site/*',	2,	NULL,	NULL,	NULL,	1495105750,	1495105750),
('/site/about',	2,	NULL,	NULL,	NULL,	1495105750,	1495105750),
('/site/captcha',	2,	NULL,	NULL,	NULL,	1495105750,	1495105750),
('/site/contact',	2,	NULL,	NULL,	NULL,	1495105750,	1495105750),
('/site/error',	2,	NULL,	NULL,	NULL,	1495105750,	1495105750),
('/site/index',	2,	NULL,	NULL,	NULL,	1495105750,	1495105750),
('/site/login',	2,	NULL,	NULL,	NULL,	1495105750,	1495105750),
('/site/logout',	2,	NULL,	NULL,	NULL,	1495105750,	1495105750),
('/transaction-return/*',	2,	NULL,	NULL,	NULL,	1496066914,	1496066914),
('/transaction-return/bulk-delete',	2,	NULL,	NULL,	NULL,	1496066914,	1496066914),
('/transaction-return/create',	2,	NULL,	NULL,	NULL,	1496066914,	1496066914),
('/transaction-return/delete',	2,	NULL,	NULL,	NULL,	1496066914,	1496066914),
('/transaction-return/index',	2,	NULL,	NULL,	NULL,	1496066914,	1496066914),
('/transaction-return/update',	2,	NULL,	NULL,	NULL,	1496066914,	1496066914),
('/transaction-return/view',	2,	NULL,	NULL,	NULL,	1496066914,	1496066914),
('/transaction/*',	2,	NULL,	NULL,	NULL,	1496066914,	1496066914),
('/transaction/bulk-delete',	2,	NULL,	NULL,	NULL,	1496066914,	1496066914),
('/transaction/create',	2,	NULL,	NULL,	NULL,	1496066914,	1496066914),
('/transaction/delete',	2,	NULL,	NULL,	NULL,	1496066914,	1496066914),
('/transaction/index',	2,	NULL,	NULL,	NULL,	1496066914,	1496066914),
('/transaction/update',	2,	NULL,	NULL,	NULL,	1496066914,	1496066914),
('/transaction/view',	2,	NULL,	NULL,	NULL,	1496066914,	1496066914),
('Superadmin',	1,	NULL,	NULL,	NULL,	1496065286,	1496065286),
('user',	1,	NULL,	NULL,	NULL,	1496065308,	1496065308);

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('Superadmin',	'/*'),
('user',	'/site/*');

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `car`;
CREATE TABLE `car` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `police_number` varchar(10) NOT NULL,
  `year_out` year(4) NOT NULL,
  `car_type` varchar(30) NOT NULL COMMENT 'merek kendaraan',
  `color` varchar(20) NOT NULL,
  `price` decimal(14,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `car` (`id`, `police_number`, `year_out`, `car_type`, `color`, `price`, `quantity`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1,	'B6941PFJ',	'2014',	'Honda Mobilio 2005',	'Red',	250000.00,	5,	1,	NULL,	'2017-06-13 15:35:14',	NULL,	1),
(2,	'B5059GPL',	'2015',	'Toyota Avanza 2015',	'White',	300000.00,	2,	1,	'2017-06-13 14:53:04',	'2017-06-13 15:35:20',	1,	1),
(3,	'B3849EIO',	'2016',	'Suzuki Ertiga 2016',	'Black',	350000.00,	3,	1,	'2017-06-13 14:53:38',	'2017-06-13 15:35:26',	1,	1),
(4,	'B6574TOT',	'2017',	'Daihatsu Xenia 2017',	'Silver',	250000.00,	1,	1,	'2017-06-13 14:54:55',	'2017-06-13 15:35:33',	1,	1);

DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identity_number` varchar(30) NOT NULL,
  `photo_identity_number` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `join_at` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `customer` (`id`, `identity_number`, `photo_identity_number`, `name`, `address`, `phone`, `join_at`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1,	'1726319832',	'',	'Gunawan',	'Jl Tesk',	'098765789',	'2017-05-18 00:00:00',	1,	'2017-05-29 14:46:18',	NULL,	1,	1),
(2,	'1726319832',	'reinita-feyzsbyrfwsmbbxuzbvz.jpg',	'Reinita',	'Jakarta Barat',	'087617261721',	'2017-06-08 00:00:00',	1,	'2017-06-13 15:02:55',	NULL,	1,	1),
(3,	'7281739183',	'amelia-maulany-gj1aaoufsczjuksfsieo.jpg',	'Amelia Maulany',	'Jl Raya Sentul bogor',	'028173873102',	'2017-06-05 00:00:00',	1,	'2017-06-13 15:03:37',	NULL,	1,	1);

DROP TABLE IF EXISTS `driver`;
CREATE TABLE `driver` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identity_number` varchar(30) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `join_at` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `driver` (`id`, `identity_number`, `name`, `address`, `phone`, `join_at`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1,	'8909876542',	'Hendri Gunawan',	'Jl Batu Ceper X No 2Y Jakarta Pusat',	'08561471500',	'2017-05-31 00:00:00',	1,	NULL,	'2017-06-13 14:56:04',	NULL,	1),
(2,	'1234567890',	'Bobby Dwi Adam',	'Jl Meruya Selatan Jakarta Barat',	'085718291829',	'2017-06-01 00:00:00',	1,	'2017-06-13 14:55:48',	NULL,	1,	1),
(3,	'6789054321',	'Muhamad Ega',	'Jl Semanan Jakarta Barat',	'085177291281',	'2017-06-02 00:00:00',	1,	'2017-06-13 14:56:56',	NULL,	1,	1);

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `menu` (`id`, `name`, `parent`, `route`, `order`, `data`) VALUES
(1,	'Dashboard',	NULL,	'/site/index',	0,	NULL),
(2,	'Car',	NULL,	'/car/index',	50,	NULL),
(3,	'Transaction',	NULL,	'/transaction/index',	10,	NULL),
(4,	'Transaction Return',	NULL,	'/transaction-return/index',	20,	NULL),
(5,	'Customer',	NULL,	'/customer/index',	30,	NULL),
(6,	'Driver',	NULL,	'/driver/index',	40,	NULL),
(7,	'Report',	NULL,	'/report/index',	60,	NULL);

DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base',	1495016698),
('m140506_102106_rbac_init',	1495016820),
('m140602_111327_create_menu_table',	1495016778),
('m160312_050000_create_user',	1495016778);

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE `transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(30) NOT NULL COMMENT 'unique',
  `customer_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `rent_at` date NOT NULL,
  `rent_finish_at` date NOT NULL,
  `actualy_total` decimal(14,2) NOT NULL COMMENT 'total sebenarnya',
  `bill_total` decimal(14,2) NOT NULL COMMENT 'total bayar',
  `status` smallint(6) NOT NULL COMMENT '1=Rent;2=Finish',
  `status_payment` smallint(6) NOT NULL COMMENT '1=Paid;2=DP',
  `user_id` bigint(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `car_id` (`car_id`),
  KEY `driver_id` (`driver_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transaction_ibfk_3` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transaction_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `transaction` (`id`, `code`, `customer_id`, `car_id`, `driver_id`, `rent_at`, `rent_finish_at`, `actualy_total`, `bill_total`, `status`, `status_payment`, `user_id`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1,	'INV-B6574TOT-2017-06-9457',	1,	4,	1,	'2017-06-13',	'2017-06-13',	500000.00,	500000.00,	2,	2,	1,	'2017-06-13 15:59:31',	'2017-06-13 16:51:17',	1,	1),
(2,	'INV-B6941PFJ-2017-06-0002',	2,	1,	3,	'2017-06-13',	'2017-06-17',	1000000.00,	1000000.00,	2,	2,	1,	'2017-06-13 16:54:39',	'2017-06-13 16:54:51',	1,	1);

DROP TABLE IF EXISTS `transaction_return`;
CREATE TABLE `transaction_return` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` int(11) NOT NULL,
  `code` varchar(30) NOT NULL,
  `return_at` datetime NOT NULL,
  `total` decimal(14,2) NOT NULL,
  `description` varchar(255) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaction_id` (`transaction_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `transaction_return_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transaction_return_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `role` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'superadmin,user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_unique_username` (`username`),
  UNIQUE KEY `user_unique_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `user` (`id`, `username`, `email`, `password_hash`, `password_reset_token`, `auth_key`, `status`, `created_at`, `updated_at`, `role`) VALUES
(1,	'admin',	'hendri.gnw@gmail.com',	'$2y$10$NG0aKRQ7PUu8LfzQbTiaC.Ae.3Ie8ERGbe9nuGpiUsvyx7xV2apZG',	'',	'',	10,	1495106144,	0,	''),
(2,	'hendri',	'hendri@gmail.com',	'$2y$13$ClhXcv/HkL60/PJ0N5j/iubPU66I/0MxclMMVYaQ19rCAm28Axma6',	'',	'Y16TfXgMcLYiahJ8b5NCoMNw9_dQ__ql',	10,	1495106144,	1495106144,	'');

-- 2017-06-13 15:12:18
