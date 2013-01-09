-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 09, 2013 at 06:52 AM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lakeland`
--

-- --------------------------------------------------------

--
-- Table structure for table `lakeland_captcha`
--

CREATE TABLE IF NOT EXISTS `lakeland_captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,
  `captcha_time` int(10) unsigned NOT NULL,
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `word` varchar(20) NOT NULL,
  PRIMARY KEY (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=346 ;

--
-- Dumping data for table `lakeland_captcha`
--

INSERT INTO `lakeland_captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES
(345, 1355910887, '127.0.0.1', 'H852REB');

-- --------------------------------------------------------

--
-- Table structure for table `lakeland_groups`
--

CREATE TABLE IF NOT EXISTS `lakeland_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `lakeland_groups`
--

INSERT INTO `lakeland_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `lakeland_pages`
--

CREATE TABLE IF NOT EXISTS `lakeland_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(70) NOT NULL,
  `content` text NOT NULL,
  `section` int(11) NOT NULL,
  `parent_page` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `thumbnail` varchar(50) NOT NULL,
  `alternate_browser_title` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `lakeland_pages`
--

INSERT INTO `lakeland_pages` (`id`, `title`, `content`, `section`, `parent_page`, `url`, `thumbnail`, `alternate_browser_title`) VALUES
(1, 'Lakeland Africa Limited', '<p>\r\n	Lakeland Africa Limited is Tanzania&#39;s leading provider of group overland budget travels.&nbsp; It was formed with the intention of ultimately providing all forms of land travels as well as wildlife safaris, adventure and cultural tourism.</p>\r\n<p>\r\n	<strong>Our current services:</strong></p>\r\n<p>\r\n	City Car &amp; Truck Rentals, Airport and hotel transfers, Camping safaris, Beach holidays, Wildlife tourism, Overland Adventure tourism, Cultural and historical tourism, Mountain Climbing. We also organise fishing and water sports such as canoeing festivals in Lake Victoria.</p>\r\n', 0, 0, 'home', '', ''),
(4, 'About Lakeland Africa', '<p>\r\n	<strong>Our Mission</strong></p>\r\n<p>\r\n	We believe that developed Tanzania is best for Lakeland Africa Limited. We therefore exist to help create wealth for our nation, for our employees and for our shareholders through a dedicated customer service to our clients.</p>\r\n<p>\r\n	<br />\r\n	<strong>Our Values</strong></p>\r\n<ul>\r\n	<li>\r\n		Honesty and integrity: We are ethical; we respect and keep our word</li>\r\n	<li>\r\n		Efficiency and effective: High level of service delivery</li>\r\n	<li>\r\n		Personalized services: We avoid the one size fits all modul</li>\r\n	<li>\r\n		Team work: we pool together our ideas and efforts to the benefit of our clients</li>\r\n	<li>\r\n		The community that houses us is our own best hope for progress, wealth creation and security.</li>\r\n</ul>\r\n<p>\r\n	<br />\r\n	<strong>Our Vision</strong></p>\r\n<p>\r\n	To care, think and always act in the best interest of our clients and the Nation.</p>\r\n', 0, 0, 'about-us', '', ''),
(5, 'Overland Vehicles', '<p>\r\n	Overland Vehicles</p>\r\n', 1, 0, 'overland-vehicles', '', ''),
(6, 'Safari Landcruisers', '<p>\r\n	Safari Landcruisers.</p>\r\n', 1, 0, 'safari-landcruisers', '', ''),
(7, 'Self Driven Car Rentals', '<p>\r\n	Self Driven Car Rentals</p>\r\n', 2, 0, 'self-driven-car-rentals', '', ''),
(8, 'Chaufer Driven', '<p>\r\n	Chaufer Driven</p>\r\n', 2, 0, 'chaufer-driven', '', ''),
(9, 'Airport & City Transfers', '<p>\r\n	Airport &amp; City Transfers</p>\r\n', 2, 0, 'airport-city-transfers', '', ''),
(10, 'National Parks', '<p>\r\n	National Parks</p>\r\n', 3, 0, 'national-parks', '', ''),
(11, 'Beaches', '<p>\r\n	Beaches</p>\r\n', 3, 0, 'beaches', '', ''),
(12, 'Cultural Tourism', '<p>\r\n	Cultural Tourism</p>\r\n', 3, 0, 'cultural-tourism', '', ''),
(13, 'Day Tours', '<p>\r\n	Day Tours</p>\r\n', 4, 0, 'day-tours', '', ''),
(14, 'Weekend Getaways', '<p>\r\n	Weekend Getaways</p>\r\n', 4, 0, 'weekend-getaways', '', ''),
(15, 'Overland Safaris', '', 4, 0, '', '', ''),
(16, 'Custom Packages', '<p>\r\n	Custom Packages</p>\r\n', 4, 0, 'custom-packages', '', ''),
(17, 'Scheduled Trips', '<p>\r\n	Scheduled Trips</p>\r\n', 4, 0, 'scheduled-trips', '', ''),
(18, '21 - 40 Day Trips', '<p>\r\n	21 - 40 Day Trips</p>\r\n', 0, 15, '21-40-day-trips', '', ''),
(19, '14 - 20 Day Trips', '<p>\r\n	14 - 20 Day Trips</p>\r\n', 0, 15, '14-20-day-trips', '', ''),
(20, '7 - 13 Day Trips', '<p>\r\n	7 - 13 Day Trips</p>\r\n', 0, 15, '7-13-day-trips', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `lakeland_safaris`
--

CREATE TABLE IF NOT EXISTS `lakeland_safaris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(70) NOT NULL,
  `thumb_nail` varchar(100) NOT NULL,
  `introductory_text` text NOT NULL,
  `price` int(11) NOT NULL,
  `includes` text NOT NULL,
  `excludes` text NOT NULL,
  `itinerary` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lakeland_sections`
--

CREATE TABLE IF NOT EXISTS `lakeland_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `url_string` varchar(255) NOT NULL,
  `priority` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `lakeland_sections`
--

INSERT INTO `lakeland_sections` (`id`, `name`, `url_string`, `priority`) VALUES
(1, 'Safari Vehicles', 'vehicles', 6),
(2, 'Car Rentals', 'carrentals', 5),
(3, 'Destinations', 'destinations', 4),
(4, 'Group Overland Safaris', 'safaris', 3),
(6, 'Home', 'home', 1),
(7, 'About Us', 'about-us', 2),
(8, 'Contact Us', 'contact-us', 7);

-- --------------------------------------------------------

--
-- Table structure for table `lakeland_users`
--

CREATE TABLE IF NOT EXISTS `lakeland_users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(80) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `lakeland_users`
--

INSERT INTO `lakeland_users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '\0\0', 'administrator', '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4', '9462e8eee0', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1357650413, 1, 'Admin', 'istrator', 'ADMIN', '0');

-- --------------------------------------------------------

--
-- Table structure for table `lakeland_users_groups`
--

CREATE TABLE IF NOT EXISTS `lakeland_users_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `lakeland_users_groups`
--

INSERT INTO `lakeland_users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 3, 2),
(5, 4, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
