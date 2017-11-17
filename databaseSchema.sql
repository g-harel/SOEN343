-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mer 15 Novembre 2017 à 20:23
-- Version du serveur :  5.7.17-log
-- Version de PHP :  7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `soen343`
--

-- --------------------------------------------------------

DROP TABLE IF EXISTS sessions;
DROP TABLE IF EXISTS units;
DROP TABLE IF EXISTS accounts;
DROP TABLE IF EXISTS desktops;
DROP TABLE IF EXISTS laptops;
DROP TABLE IF EXISTS monitors;
DROP TABLE IF EXISTS tablets;
DROP TABLE IF EXISTS computers;
DROP TABLE IF EXISTS items;

--
-- Structure de la table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 NOT NULL,
  `password` varchar(100) CHARACTER SET latin1 NOT NULL,
  `first_name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `last_name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `phone_number` bigint(20) UNSIGNED NOT NULL,
  `door_number` int(10) UNSIGNED NOT NULL,
  `appartement` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `street` varchar(100) CHARACTER SET latin1 NOT NULL,
  `city` varchar(100) CHARACTER SET latin1 NOT NULL,
  `province` varchar(100) CHARACTER SET latin1 NOT NULL,
  `country` varchar(50) CHARACTER SET latin1 NOT NULL,
  `postal_code` varchar(12) CHARACTER SET latin1 NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Contenu de la table `accounts`
--

INSERT INTO `accounts` (`id`, `email`, `password`, `first_name`, `last_name`, `phone_number`, `door_number`, `appartement`, `street`, `city`, `province`, `country`, `postal_code`, `isAdmin`) VALUES
(1, 'admin@gmail.com', 'admin123', 'John', 'Doe', 123456789, 101, NULL, 'Maple', 'Montreal', 'Quebec', 'Canada', 'J6J3K7', 1),
(2, 'admin2@gmail.com', 'admin123', 'Mike', 'Joe', 5141234567, 1055, NULL, 'Nancy', 'Montreal', 'Quebec', 'Canada', 'P3U2J1', 1),
(3, 'admin3@gmail.com', 'admin123', 'Jane', 'Doe', 5146666666, 28615, NULL, 'Lorimier', 'Montreal', 'Quebec', 'Canada', 'H0H0H0', 1);

-- --------------------------------------------------------

--
-- Structure de la table `computers`
--

CREATE TABLE `computers` (
  `item_id` int(10) UNSIGNED NOT NULL,
  `processor_type` varchar(100) NOT NULL,
  `ram_size` int(10) UNSIGNED NOT NULL,
  `cpu_cores` int(10) UNSIGNED NOT NULL,
  `weight` float(10,2) NOT NULL,
  `hdd_size` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `computers`
--

INSERT INTO `computers` (`item_id`, `processor_type`, `ram_size`, `cpu_cores`, `weight`, `hdd_size`) VALUES
(3, 'Intel', 12, 4, 5.00, 128),
(4, 'Rockchip', 16, 6, 13.20, 1000),
(5, 'AMD', 2, 4, 1.00, 2000),
(6, 'Intel', 8, 2, 3.00, 256),
(23, 'NoIdea', 16, 8, 31.20, 1000),
(24, 'NoIdea', 16, 8, 31.20, 1000);

-- --------------------------------------------------------

--
-- Structure de la table `desktops`
--

CREATE TABLE `desktops` (
  `item_id` int(10) UNSIGNED NOT NULL,
  `height` float(10,2) NOT NULL,
  `width` float(10,2) NOT NULL,
  `thickness` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `desktops`
--

INSERT INTO `desktops` (`item_id`, `height`, `width`, `thickness`) VALUES
(4, 43.00, 24.00, 13.00),
(23, 12.00, 12.00, 4.00),
(24, 12.00, 12.00, 4.00);

-- --------------------------------------------------------

--
-- Structure de la table `items`
--

CREATE TABLE `items` (
  `id` int(10) UNSIGNED NOT NULL,
  `category` varchar(20) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `price` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `items`
--

INSERT INTO `items` (`id`, `category`, `brand`, `price`) VALUES
(1, 'test', 'test', 12.00),
(2, 'test2', 'test2', 99.00),
(3, 'laptop', 'IBM', 1500.00),
(4, 'desktop', 'Dell', 1055.00),
(5, 'tablet', 'Apple', 900.00),
(6, 'laptop', 'Apple', 9999.00),
(7, 'desktop', 'Alienware', 2400.00),
(8, 'desktop', 'Alienware3333', 240022.00),
(9, 'desktop', 'Alienware', 2400.00),
(10, 'desktop', 'Alienware3333', 240022.00),
(11, 'desktop', 'Alienware', 2400.00),
(12, 'desktop', 'Alienware3333', 240022.00),
(13, 'desktop', 'Alienware', 2400.00),
(14, 'desktop', 'Alienware3333', 240022.00),
(15, 'desktop', 'Alienware', 2400.00),
(16, 'desktop', 'Alienware3333', 240022.00),
(17, 'desktop', 'Alienware', 2400.00),
(18, 'desktop', 'Alienware3333', 240022.00),
(23, 'desktop', 'Alienware6666', 111111.00),
(24, 'desktop', 'Alienware3333', 240022.00);

-- --------------------------------------------------------

--
-- Structure de la table `laptops`
--

CREATE TABLE `laptops` (
  `item_id` int(10) UNSIGNED NOT NULL,
  `display_size` float(10,2) NOT NULL,
  `os` varchar(100) NOT NULL,
  `battery` varchar(100) NOT NULL,
  `camera` varchar(100) NOT NULL,
  `is_touchscreen` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `laptops`
--

INSERT INTO `laptops` (`item_id`, `display_size`, `os`, `battery`, `camera`, `is_touchscreen`) VALUES
(3, 14.00, 'Windows XP', 'Li-Ion', 'Yes', 0),
(6, 13.30, 'macOS', 'Mac', 'Yes', 0);

-- --------------------------------------------------------

--
-- Structure de la table `monitors`
--

CREATE TABLE `monitors` (
  `item_id` int(10) UNSIGNED NOT NULL,
  `display_size` float(10,2) NOT NULL,
  `weight` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `monitors`
--

INSERT INTO `monitors` (`item_id`, `display_size`, `weight`) VALUES
(1, 12.00, 12.00),
(2, 77.00, 77.00);

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(10) UNSIGNED NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  `login_time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `tablets`
--

CREATE TABLE `tablets` (
  `item_id` int(10) UNSIGNED NOT NULL,
  `display_size` float(10,2) NOT NULL,
  `width` float(10,2) NOT NULL,
  `height` float(10,2) NOT NULL,
  `thickness` float(10,2) NOT NULL,
  `battery` varchar(100) NOT NULL,
  `os` varchar(100) NOT NULL,
  `camera` varchar(100) NOT NULL,
  `is_touchscreen` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tablets`
--

INSERT INTO `tablets` (`item_id`, `display_size`, `width`, `height`, `thickness`, `battery`, `os`, `camera`, `is_touchscreen`) VALUES
(5, 7.00, 3.00, 2.00, 6.00, 'Mac', 'iOS', 'Yes', 0);

-- --------------------------------------------------------

--
-- Structure de la table `units`
--

CREATE TABLE `units` (
  `serial` varchar(32) NOT NULL,
  `item_id` int(11) UNSIGNED NOT NULL,
  `status` ENUM('AVAILABLE', 'RESERVED', 'PURCHASED'),
  `account_id` int(11) UNSIGNED,
  `reserved_date` timestamp NULL,
  `purchased_price` float(10,2) NULL,
  `purchased_date` timestamp NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `units`
--

INSERT INTO `units` (`serial`, `item_id`, `status`, `account_id`, `reserved_date`, `purchased_price`, `purchased_date`) VALUES
('ABCDEF123', 1, 'AVAILABLE', 1, NOW(), 12.99, NOW()),
('312FEDCBA', 2, 'AVAILABLE', 3, NOW(), 12.99, NOW());

-- --------------------------------------------------------

--
-- Index pour la table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Index pour la table `computers`
--
ALTER TABLE `computers`
  ADD PRIMARY KEY (`item_id`),
  ADD UNIQUE KEY `id_UNIQUE` (`item_id`);

--
-- Index pour la table `desktops`
--
ALTER TABLE `desktops`
  ADD PRIMARY KEY (`item_id`),
  ADD UNIQUE KEY `id_UNIQUE` (`item_id`);

--
-- Index pour la table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Index pour la table `laptops`
--
ALTER TABLE `laptops`
  ADD PRIMARY KEY (`item_id`),
  ADD UNIQUE KEY `id_UNIQUE` (`item_id`);

--
-- Index pour la table `monitors`
--
ALTER TABLE `monitors`
  ADD PRIMARY KEY (`item_id`),
  ADD UNIQUE KEY `id_UNIQUE` (`item_id`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `account_id_UNIQUE` (`account_id`);

--
-- Index pour la table `tablets`
--
ALTER TABLE `tablets`
  ADD PRIMARY KEY (`item_id`),
  ADD UNIQUE KEY `id_UNIQUE` (`item_id`);

--
-- Index pour la table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`serial`),
  ADD KEY `item_id_fk` (`item_id`),
  ADD KEY `account_id_fk` (`account_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT pour la table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `computers`
--
ALTER TABLE `computers`
  ADD CONSTRAINT `fk_computer_item_id` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `desktops`
--
ALTER TABLE `desktops`
  ADD CONSTRAINT `fk_desktop_item_id` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `laptops`
--
ALTER TABLE `laptops`
  ADD CONSTRAINT `fk_laptop_item_id` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `monitors`
--
ALTER TABLE `monitors`
  ADD CONSTRAINT `fk_monitor_item_id` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `account_id` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tablets`
--
ALTER TABLE `tablets`
  ADD CONSTRAINT `fk_tablet_item_id` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `units`
--
ALTER TABLE `units`
  ADD CONSTRAINT `account_id_fk` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_id_fk` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
