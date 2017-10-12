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

DROP TABLE IF EXISTS televisions;
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


-- -----------------------------------------------------
-- Table `soen343`.`television`
-- -----------------------------------------------------
CREATE TABLE `soen343`.`televisions` (
  `item_id` INT UNSIGNED NOT NULL,
  `height` FLOAT(10, 2) NOT NULL,
  `width` FLOAT(10, 2) NOT NULL,
  `thickness` FLOAT(10, 2) NOT NULL,
  `weight` FLOAT(10, 2) NOT NULL,
  `type` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`item_id`),
  UNIQUE INDEX `id_UNIQUE` (`item_id` ASC),
  CONSTRAINT `fk_item_id`
    FOREIGN KEY (`item_id`)
    REFERENCES `soen343`.`items` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


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


-- -----------------------------------------------------
-- Table `soen343`.`computer`
-- -----------------------------------------------------
CREATE TABLE `soen343`.`computers` (
  `item_id` INT UNSIGNED NOT NULL,
  `processor_type` VARCHAR(100) NOT NULL,
  `ram_size` INT UNSIGNED NOT NULL,
  `cpu_cores` INT UNSIGNED NOT NULL,
  `weight` FLOAT(10, 2) NOT NULL,
  `type` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`item_id`),
  UNIQUE INDEX `id_UNIQUE` (`item_id` ASC),
  CONSTRAINT `fk_computer_item_id`
    FOREIGN KEY (`item_id`)
    REFERENCES `soen343`.`items` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


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


-- -----------------------------------------------------
-- Table `soen343`.`laptop`
-- -----------------------------------------------------
CREATE TABLE `soen343`.`laptops` (
  `item_id` INT UNSIGNED NOT NULL,
  `display_size` FLOAT(10, 2) NOT NULL,
  `os` VARCHAR(100) NOT NULL,
  `battery` VARCHAR(100) NOT NULL,
  `camera` VARCHAR(100) NOT NULL,
  `touchscreen` BOOLEAN NOT NULL,
  PRIMARY KEY (`item_id`),
  UNIQUE INDEX `id_UNIQUE` (`item_id` ASC),
  CONSTRAINT `fk_laptop_item_id`
    FOREIGN KEY (`item_id`)
    REFERENCES `soen343`.`items` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


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
  `touchscreen` BOOLEAN NOT NULL,
  PRIMARY KEY (`item_id`),
  UNIQUE INDEX `id_UNIQUE` (`item_id` ASC),
  CONSTRAINT `fk_tablet_item_id`
    FOREIGN KEY (`item_id`)
    REFERENCES `soen343`.`items` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

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
