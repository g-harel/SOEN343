-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2017 at 02:54 AM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `soen343`
--

DROP TABLE IF EXISTS monitors;
DROP TABLE IF EXISTS desktops;
DROP TABLE IF EXISTS laptops;
DROP TABLE IF EXISTS tablets;
DROP TABLE IF EXISTS computers;
DROP TABLE IF EXISTS items;

DROP TABLE IF EXISTS sessions;
DROP TABLE IF EXISTS users;

-- -----------------------------------------------------
-- Table `soen343`.`item`
-- -----------------------------------------------------
CREATE TABLE `soen343`.`items` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `category` VARCHAR(20) NOT NULL,
  `brand` VARCHAR(100) NOT NULL,
  `price` FLOAT(10, 2) NOT NULL,
  `quantity` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `category`, `brand`, `price`, `quantity`) VALUES
(1, 'test', 'test', 12.00, 1),
(2, 'test2', 'test2', 99.00, 99),
(3, 'laptop', 'IBM', 1500.00, 2),
(4, 'desktop', 'Dell', 1055.00, 20),
(5, 'tablet', 'Apple', 900.00, 43),
(6, 'laptop', 'Apple', 9999.00, 9);


-- -----------------------------------------------------
-- Table `soen343`.`monitor`
-- -----------------------------------------------------
CREATE TABLE `soen343`.`monitors` (
  `item_id` INT UNSIGNED NOT NULL,
  `display_size` FLOAT(10, 2) NOT NULL,
  `weight` FLOAT(10, 2) NOT NULL,
  PRIMARY KEY (`item_id`),
  UNIQUE INDEX `id_UNIQUE` (`item_id` ASC),
  CONSTRAINT `fk_monitor_item_id`
    FOREIGN KEY (`item_id`)
    REFERENCES `soen343`.`items` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

--
-- Dumping data for table `monitors`
--

INSERT INTO `monitors` (`item_id`, `display_size`, `weight`) VALUES
(1, 12.00, 12.00),
(2, 77.00, 77.00);



-- -----------------------------------------------------
-- Table `soen343`.`computer`
-- -----------------------------------------------------
CREATE TABLE `soen343`.`computers` (
  `item_id` INT UNSIGNED NOT NULL,
  `processor_type` VARCHAR(100) NOT NULL,
  `ram_size` INT UNSIGNED NOT NULL,
  `cpu_cores` INT UNSIGNED NOT NULL,
  `weight` FLOAT(10, 2) NOT NULL,
  `hdd_size` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`item_id`),
  UNIQUE INDEX `id_UNIQUE` (`item_id` ASC),
  CONSTRAINT `fk_computer_item_id`
    FOREIGN KEY (`item_id`)
    REFERENCES `soen343`.`items` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

--
-- Dumping data for table `computers`
--

INSERT INTO `computers` (`item_id`, `processor_type`, `ram_size`, `cpu_cores`, `weight`, `hdd_size`) VALUES
(3, 'Intel', 12, 4, 5.00, 128),
(4, 'Rockchip', 16, 6, 13.20, 1000),
(5, 'AMD', 2, 4, 1.00, 2000),
(6, 'Intel', 8, 2, 3.00, 256);


-- -----------------------------------------------------
-- Table `soen343`.`desktop`
-- -----------------------------------------------------
CREATE TABLE `soen343`.`desktops` (
  `item_id` INT UNSIGNED NOT NULL,
  `height` FLOAT(10, 2) NOT NULL,
  `width` FLOAT(10, 2) NOT NULL,
  `thickness` FLOAT(10, 2) NOT NULL,
  PRIMARY KEY (`item_id`),
  UNIQUE INDEX `id_UNIQUE` (`item_id` ASC),
  CONSTRAINT `fk_desktop_item_id`
    FOREIGN KEY (`item_id`)
    REFERENCES `soen343`.`items` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

--
-- Dumping data for table `desktops`
--

INSERT INTO `desktops` (`item_id`, `height`, `width`, `thickness`) VALUES
(4, 43.00, 24.00, 13.00);


-- -----------------------------------------------------
-- Table `soen343`.`laptop`
-- -----------------------------------------------------
CREATE TABLE `soen343`.`laptops` (
  `item_id` INT UNSIGNED NOT NULL,
  `display_size` FLOAT(10, 2) NOT NULL,
  `os` VARCHAR(100) NOT NULL,
  `battery` VARCHAR(100) NOT NULL,
  `camera` VARCHAR(100) NOT NULL,
  `is_touchscreen` BOOLEAN NOT NULL,
  PRIMARY KEY (`item_id`),
  UNIQUE INDEX `id_UNIQUE` (`item_id` ASC),
  CONSTRAINT `fk_laptop_item_id`
    FOREIGN KEY (`item_id`)
    REFERENCES `soen343`.`items` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

--
-- Dumping data for table `laptops`
--

INSERT INTO `laptops` (`item_id`, `display_size`, `os`, `battery`, `camera`, `is_touchscreen`) VALUES
(3, 14.00, 'Windows XP', 'Li-Ion', 'Yes', 0),
(6, 13.30, 'macOS', 'Mac', 'Yes', 0);


-- -----------------------------------------------------
-- Table `soen343`.`tablet`
-- -----------------------------------------------------
CREATE TABLE `soen343`.`tablets` (
  `item_id` INT UNSIGNED NOT NULL,
  `display_size` FLOAT(10, 2) NOT NULL,
  `width` FLOAT(10, 2) NOT NULL,
  `height` FLOAT(10, 2) NOT NULL,
  `thickness` FLOAT(10, 2) NOT NULL,
  `battery` VARCHAR(100) NOT NULL,
  `os` VARCHAR(100) NOT NULL,
  `camera` VARCHAR(100) NOT NULL,
  `is_touchscreen` BOOLEAN NOT NULL,
  PRIMARY KEY (`item_id`),
  UNIQUE INDEX `id_UNIQUE` (`item_id` ASC),
  CONSTRAINT `fk_tablet_item_id`
    FOREIGN KEY (`item_id`)
    REFERENCES `soen343`.`items` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

--
-- Dumping data for table `tablets`
--

INSERT INTO `tablets` (`item_id`, `display_size`, `width`, `height`, `thickness`, `battery`, `os`, `camera`, `is_touchscreen`) VALUES
(5, 7.00, 3.00, 2.00, 6.00, 'Mac', 'iOS', 'Yes', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `login_time_stamp` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `phone_number` bigint(20) UNSIGNED NOT NULL,
  `door_number` int(10) UNSIGNED NOT NULL,
  `appartement` varchar(10) DEFAULT NULL,
  `street` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `country` varchar(50) NOT NULL,
  `postal_code` varchar(12) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `first_name`, `last_name`, `phone_number`, `door_number`, `appartement`, `street`, `city`, `province`, `country`, `postal_code`, `isAdmin`) VALUES
(1, 'admin@gmail.com', 'admin123', 'John', 'Doe', 123456789, 101, NULL, 'Maple', 'Montreal', 'Quebec', 'Canada', 'J6J3K7', 1);
INSERT INTO `users` (`id`, `email`, `password`, `first_name`, `last_name`, `phone_number`, `door_number`, `appartement`, `street`, `city`, `province`, `country`, `postal_code`, `isAdmin`) VALUES
(2, 'mikehawk@gmail.com', 'mikey', 'Mike', 'Hawk', 5141234567, 1055, NULL, 'Nancy', 'Montreal', 'Quebec', 'Canada', 'P3U2J1', 1);
INSERT INTO `users` (`id`, `email`, `password`, `first_name`, `last_name`, `phone_number`, `door_number`, `appartement`, `street`, `city`, `province`, `country`, `postal_code`, `isAdmin`) VALUES
(3, 'munch@gmail.com', 'qwerty', 'Munchma', 'Quchi', 5146666666, 28615, NULL, 'Lorimier', 'Montreal', 'Quebec', 'Canada', 'H0H0H0', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `user_id_UNIQUE` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
