-- Adminer 4.6.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `picture_address` varchar(10000) NOT NULL,
  `price` varchar(255) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `products` (`id`, `title`, `description`, `picture_address`, `price`, `creationDate`) VALUES
(1,	'Bamboo Citadel Katana by Citadel',	'This rendition of the classical bamboo themed katana is a light and fast sword. Hand forged from imported European DNH7 high carbon steel the differentially hardened blade features a \"bo-hi\" or fuller to lighten and balance the blade without sacrificing strength. This is an extremely collectible and capable sword.',	'https://casiberia.com/img/prod/2x/sc4003.jpg',	'2799.00',	'2019-09-03 09:02:42'),
(2,	'Lotus Citadel Katana by Citadel',	'This katana is made in the same manner as the more costly Citadel katana (see Ocean and Bamboo) but with a focus on cutting practice this sword\'s fittings have been simplified to their purest form. The blade is solid, with no bo-hi or fuller to provide a slightly higher weight and forward balance. ',	'https://casiberia.com/img/prod/2x/sc4002.jpg',	'2,199.00',	'2019-09-03 12:58:14'),
(3,	'Praying Mantis Katana by Paul Chen ',	'The Praying Mantis is a symbol of cunning and power in Japanese culture and is consequently a highly respected theme in Samurai swords. Built on the new Hanwei L6/Bainite blade in the Shobu Zukuri style with Bo-Hi, and featuring superb koshirae, the Praying Mantis Katana is a very desirable and functional piece. The subdued green silk ito and deep brown of the lacquered saya provide handsome contrast to the dark copper and golden accents of the tsuba, fuchi and kashira. The stalking mantis lies in wait for his next prey, mirroring the power and grace in this exceptional katana.\r\n',	'https://casiberia.com/img/prod/2x/sh2359.jpg',	'1,900.00',	'2019-09-03 13:03:37'),
(4,	'Oni Katana by Paul Chen / Hanwei',	'The Oni are mythical creatures from Japanese folklore similar to western demons or trolls. In modern culture they are beginning to move away from this menacing connotation into the role of guardian or protector, similar in character to gargoyles. Their power and ferocity, however, have not diminished. The Japanese saying that translates to â€œOni with an iron clubâ€, or \"to be of an invincible nature\", fits perfectly the 29â€ L6/Bainite blade on which our Oni Katana is built. The blade features the geometry of our Performance Series for outstanding cutting ability. The 14â€ tsuka is wrapped in black ray skin and silk ito while the Koshirae feature Oni in various classical styles. A unique combination of folklore and functionality. \r\n',	'https://casiberia.com/img/prod/2x/sh6018klg.jpg',	'1,800.00',	'2019-09-03 13:05:10'),
(5,	'Lion Dog Katana by Paul Chen',	'The Lion Dog Katana features an O-Kissaki blade of Hanwei\'s own high-alloy HWS-1S steel, which combines superior performance with an outstanding O-choji hamon. This steel is made in Paul Chen\'s new Hanwei factory, with high-tech equipment, producing a very pure advanced-metallurgy blade with the best edge-holding capability and resilience of any blade ever produced by Hanwei. The outstanding performance characteristics of blades forged from HWS-1S steel derive from a combination of the careful selection of alloying elements and a complex processing procedure, basically involving the manipulation of the steelâ€™s carbon content across the blade section. This results in a very tough and resilient blade with a hard, highly abrasion-resistant edge.',	'https://casiberia.com/img/prod/2x/sh2439.jpg',	'1,400.00',	'2019-09-05 08:16:48');

DROP TABLE IF EXISTS `statuses`;
CREATE TABLE `statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `statuses` (`id`, `status`) VALUES
(1,	'guest'),
(2,	'verifiedUser'),
(3,	'admin');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_id` int(11) NOT NULL DEFAULT '1',
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `age` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status_id` (`status_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `status_id`, `firstName`, `lastName`, `nickname`, `age`, `password`) VALUES
(2,	3,	'admin',	'admin',	'theAdmin69',	1128,	'c7Ln72MiFdqUU'),
(3,	1,	'Noobie',	'Ofnoobs',	'theNewbie69',	21,	'LgDQqhmypz5wc'),
(4,	1,	'secondNoob',	'Ofnoobs',	'secondNoobie69',	22,	'KiW9Mnw1w3XCk'),
(6,	2,	'Firstinitiate',	'Ofinitiates',	'TheInitiate69',	27,	'Cmnsga5ygtB9M'),
(7,	2,	'Secondinitiate',	'Ofinitiates',	'secondInitiate69',	28,	'knEWyNWJkH0MQ'),
(8,	2,	'lolo',	'pppp',	'terminator69',	19,	'$2y$10$yOOJZnAdyHJIlpF/S9WC8.Z2C.dSzazxiV.D1OtVFo/BIO1UPmMA2');

DROP TABLE IF EXISTS `user_has_products_in_basket`;
CREATE TABLE `user_has_products_in_basket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_has_products_in_basket_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `user_has_products_in_basket_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user_has_products_in_basket` (`id`, `product_id`, `user_id`, `quantity`) VALUES
(3,	4,	8,	2),
(4,	4,	2,	1),
(5,	5,	8,	7),
(6,	3,	8,	3),
(13,	2,	8,	1);

-- 2019-09-05 15:02:41
