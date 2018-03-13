-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 11, 2018 at 11:24 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u286209732_ssh`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `provider` varchar(50) NOT NULL,
  `pemilik` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `name`, `provider`, `pemilik`) VALUES
(6, '1233422', 'BCA', 'Anton medan');

-- --------------------------------------------------------

--
-- Table structure for table `captcha`
--

CREATE TABLE `captcha` (
  `captcha_id` bigint(13) UNSIGNED NOT NULL,
  `captcha_time` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `word` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `captcha`
--

INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES
(740, 1520783407, '114.124.144.233', 'hftQc'),
(741, 1520787270, '114.124.146.182', '0c5Gb'),
(742, 1520787285, '114.124.146.182', 'FnEQv');

-- --------------------------------------------------------

--
-- Table structure for table `continent`
--

CREATE TABLE `continent` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL,
  `desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `continent`
--

INSERT INTO `continent` (`id`, `name`, `desc`) VALUES
(4, 'Asia', ''),
(5, 'Europe', ''),
(6, 'North America', ''),
(7, 'South America', ''),
(8, 'Africa', ''),
(9, 'Oceania', '');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `name` varchar(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `voucher_id` int(11) NOT NULL,
  `created_on` int(50) NOT NULL,
  `updated_on` int(50) NOT NULL,
  `dibayar` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) UNSIGNED NOT NULL,
  `continent_id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `desc` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `continent_id`, `name`, `desc`) VALUES
(8, 4, 'Singapore', ''),
(9, 4, 'Japan', ''),
(10, 4, 'Indonesia', ''),
(11, 4, 'Hongkong', ''),
(12, 4, 'Vietnam', ''),
(13, 4, 'India', ''),
(14, 4, 'Turkey', ''),
(15, 4, 'Malaysia', ''),
(16, 5, 'Netherlands', ''),
(17, 5, 'France', ''),
(18, 5, 'Germany', 'Germany'),
(23, 8, 'Johannesburg', ''),
(24, 9, 'Australia', '');

-- --------------------------------------------------------

--
-- Table structure for table `location_group`
--

CREATE TABLE `location_group` (
  `id` int(11) UNSIGNED NOT NULL,
  `location_id` int(11) UNSIGNED NOT NULL,
  `server_id` int(11) UNSIGNED NOT NULL,
  `continent_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_attempts`
--



-- --------------------------------------------------------

--
-- Table structure for table `phone`
--

CREATE TABLE `phone` (
  `id` int(11) NOT NULL,
  `provider` varchar(50) NOT NULL,
  `number` varchar(20) NOT NULL,
  `pemilik` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `phone`
--

INSERT INTO `phone` (`id`, `provider`, `number`, `pemilik`) VALUES
(5, 'XL &  AXIS', '098776', 'Anton medan'),
(6, 'Telkomsel', '081391138453', 'Jawir aed'),
(7, 'Indosat Ooredoo', '0858', 'Anton '),
(8, 'Three ', '089666', 'Anton');

-- --------------------------------------------------------

--
-- Table structure for table `port`
--

CREATE TABLE `port` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `server`
--

CREATE TABLE `server` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `host` varchar(25) NOT NULL,
  `password` varchar(20) NOT NULL,
  `created_on` int(11) DEFAULT NULL,
  `updated_on` int(11) DEFAULT NULL,
  `limit_user` int(11) DEFAULT '10',
  `price` int(11) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `premium` tinyint(1) NOT NULL,
  `desc` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `server_config`
--

CREATE TABLE `server_config` (
  `id` int(1) NOT NULL DEFAULT '1',
  `trial` int(3) NOT NULL DEFAULT '1',
  `premium` int(3) NOT NULL DEFAULT '30',
  `free` int(3) NOT NULL DEFAULT '7',
  `public_enable` tinyint(1) NOT NULL DEFAULT '0',
  `server_only` tinyint(1) NOT NULL DEFAULT '0',
  `location_only` tinyint(1) NOT NULL DEFAULT '0',
  `continent_only` tinyint(1) NOT NULL DEFAULT '0',
  `template` varchar(45) NOT NULL DEFAULT 'default'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `server_config`
--

INSERT INTO `server_config` (`id`, `trial`, `premium`, `free`, `public_enable`, `server_only`, `location_only`, `continent_only`, `template`) VALUES
(1, 2, 30, 7, 1, 0, 0, 1, 'default');

-- --------------------------------------------------------

--
-- Table structure for table `server_created`
--

CREATE TABLE `server_created` (
  `id` int(11) NOT NULL,
  `server_id` int(11) NOT NULL,
  `created_by` varchar(45) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(45) NOT NULL,
  `created_on` int(20) NOT NULL,
  `expired_on` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `trial` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `server_port`
--

CREATE TABLE `server_port` (
  `id` int(11) UNSIGNED NOT NULL,
  `server_id` int(11) UNSIGNED NOT NULL,
  `service_id` int(11) UNSIGNED NOT NULL,
  `port_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `server_service`
--

CREATE TABLE `server_service` (
  `id` int(10) UNSIGNED NOT NULL,
  `server_id` int(11) UNSIGNED NOT NULL,
  `service_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `desc` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `name`) VALUES
(5, 'fastssh_style'),
(15, 'default');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `image` varchar(20) NOT NULL DEFAULT 'default.png',
  `saldo` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `image`, `saldo`) VALUES
(39, '114.124.141.39', 'administrator', '$2y$08$9XWLqTS5MeMGyBQ6YNJiKupIgHXmIPqGZik5H.WRTCoIp8Ab0gNpS', NULL, 'webssh@webssh.xyz', NULL, NULL, NULL, NULL, 1520810555, 1520810601, 1, 'Admin', 'istrator', NULL, NULL, 'default.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 39, 1);

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `value` int(11) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `voucher_invoice`
--

CREATE TABLE `voucher_invoice` (
  `id` int(11) NOT NULL,
  `keranjang_id` int(11) NOT NULL,
  `created_on` int(50) NOT NULL,
  `message` text NOT NULL,
  `bukti` varchar(50) NOT NULL,
  `dibaca` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `captcha`
--
ALTER TABLE `captcha`
  ADD PRIMARY KEY (`captcha_id`),
  ADD KEY `word` (`word`);

--
-- Indexes for table `continent`
--
ALTER TABLE `continent`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location_group`
--
ALTER TABLE `location_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_location_group_2_idx` (`location_id`),
  ADD KEY `fk_location_group_3_idx` (`server_id`),
  ADD KEY `fk_location_group_1_idx` (`continent_id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phone`
--
ALTER TABLE `phone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `port`
--
ALTER TABLE `port`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `server`
--
ALTER TABLE `server`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `server_created`
--
ALTER TABLE `server_created`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `server_port`
--
ALTER TABLE `server_port`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_server_port_1_idx` (`server_id`),
  ADD KEY `fk_server_port_2_idx` (`service_id`),
  ADD KEY `fk_server_port_3_idx` (`port_id`);

--
-- Indexes for table `server_service`
--
ALTER TABLE `server_service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_server_service_1_idx` (`server_id`),
  ADD KEY `fk_server_service_2_idx` (`service_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voucher_invoice`
--
ALTER TABLE `voucher_invoice`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `captcha`
--
ALTER TABLE `captcha`
  MODIFY `captcha_id` bigint(13) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=743;

--
-- AUTO_INCREMENT for table `continent`
--
ALTER TABLE `continent`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `location_group`
--
ALTER TABLE `location_group`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=925;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `phone`
--
ALTER TABLE `phone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `port`
--
ALTER TABLE `port`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `server`
--
ALTER TABLE `server`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `server_created`
--
ALTER TABLE `server_created`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `server_port`
--
ALTER TABLE `server_port`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1062;

--
-- AUTO_INCREMENT for table `server_service`
--
ALTER TABLE `server_service`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `voucher_invoice`
--
ALTER TABLE `voucher_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `location_group`
--
ALTER TABLE `location_group`
  ADD CONSTRAINT `fk_location_group_1` FOREIGN KEY (`continent_id`) REFERENCES `continent` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_location_group_2` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_location_group_3` FOREIGN KEY (`server_id`) REFERENCES `server` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `server_port`
--
ALTER TABLE `server_port`
  ADD CONSTRAINT `fk_server_port_1` FOREIGN KEY (`server_id`) REFERENCES `server` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_server_port_2` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_server_port_3` FOREIGN KEY (`port_id`) REFERENCES `port` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `server_service`
--
ALTER TABLE `server_service`
  ADD CONSTRAINT `fk_server_service_1` FOREIGN KEY (`server_id`) REFERENCES `server` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_server_service_2` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
