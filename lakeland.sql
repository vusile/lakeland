-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 11, 2013 at 04:00 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

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
-- Table structure for table `lakeland_itinerary`
--

CREATE TABLE IF NOT EXISTS `lakeland_itinerary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `activities` text NOT NULL,
  `safari` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `lakeland_itinerary`
--

INSERT INTO `lakeland_itinerary` (`id`, `title`, `activities`, `safari`) VALUES
(1, 'Day One', '<ul>\r\n	<li>\r\n		Dance</li>\r\n	<li>\r\n		Play</li>\r\n	<li>\r\n		Sing</li>\r\n</ul>\r\n', 1),
(2, 'Day Two', '<ul>\r\n	<li>\r\n		Sit</li>\r\n	<li>\r\n		Read</li>\r\n	<li>\r\n		Reflect</li>\r\n</ul>\r\n', 1),
(3, 'Day 1', '<ul>\r\n	<li>\r\n		Eat</li>\r\n	<li>\r\n		Pray</li>\r\n	<li>\r\n		Love</li>\r\n</ul>\r\n', 3),
(4, 'Day 2', '<ul>\r\n	<li>\r\n		Dance</li>\r\n	<li>\r\n		Sleep</li>\r\n	<li>\r\n		Walk</li>\r\n</ul>\r\n', 3),
(5, 'Saturday', '<ul>\r\n	<li>\r\n		Dance</li>\r\n	<li>\r\n		Play</li>\r\n	<li>\r\n		Sing</li>\r\n</ul>\r\n', 5);

-- --------------------------------------------------------

--
-- Table structure for table `lakeland_overland_safaris_packages`
--

CREATE TABLE IF NOT EXISTS `lakeland_overland_safaris_packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `lakeland_overland_safaris_packages`
--

INSERT INTO `lakeland_overland_safaris_packages` (`id`, `title`) VALUES
(1, '21 - 40 Day Trips'),
(2, '14 - 20 Day Trips'),
(3, '7 - 13 Day Trips');

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
(16, 'Custom Packages', '<p>\r\n	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores nihil dolores aliquam odio adipisci itaque nostrum cupiditate dolore officiis esse porro amet cum debitis neque a laboriosam quam ipsa voluptates.</p>\r\n<p>\r\n	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores nihil dolores aliquam odio adipisci itaque nostrum cupiditate dolore officiis esse porro amet cum debitis neque a laboriosam quam ipsa voluptates.</p>\r\n', 4, 0, 'custom-packages', '', ''),
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
  `type` int(11) NOT NULL,
  `thumb_nail` varchar(100) NOT NULL,
  `introductory_text` text NOT NULL,
  `price` int(11) NOT NULL,
  `includes` text NOT NULL,
  `excludes` text NOT NULL,
  `itinerary` varchar(255) NOT NULL,
  `images` varchar(255) NOT NULL,
  `url` varchar(100) NOT NULL,
  `safari_type` int(11) NOT NULL,
  `schedule` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `lakeland_safaris`
--

INSERT INTO `lakeland_safaris` (`id`, `title`, `type`, `thumb_nail`, `introductory_text`, `price`, `includes`, `excludes`, `itinerary`, `images`, `url`, `safari_type`, `schedule`) VALUES
(1, 'Test Safari Test Safari  Test Safari ', 1, '<img width = "100" src = "images/thumb__5a97-001.jpg" />', '<p>\r\n	Nunc varius fermentum imperdiet. Aliquam in enim diam. Praesent eu neque tellus, non iaculis leo. Etiam et mi dolor. Mauris tincidunt, eros id dapibus tincidunt, leo arcu rhoncus arcu, vitae auctor neque orci eget lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec posuere ullamcorper fringilla. Morbi turpis neque, hendrerit ac sodales eu, gravida ornare enim.</p>\r\n', 900, '<ul>\r\n	<li>\r\n		One</li>\r\n	<li>\r\n		Two</li>\r\n	<li>\r\n		Three</li>\r\n</ul>\r\n', '<ul>\r\n	<li>\r\n		Four</li>\r\n	<li>\r\n		Five</li>\r\n	<li>\r\n		Six</li>\r\n</ul>\r\n', '<a href = "backend/lakeland_itinerary/1/1">Itinerary</a>', '<a href = "backend/images/1/1">Images</a>', 'test-safari', 1, '<a href = "backend/lakeland_scheduled_trips/add/1">Schedule</a>'),
(3, 'Test Trip 2 Test Trip 2 Test Trip 2', 1, '<img width = "100" src = "images/thumb__6f30-007.jpg" />', '<p>\r\n	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla velit dui, elementum vitae volutpat non, rhoncus at dolor. Integer dapibus orci eget tellus egestas fringilla. Nunc enim turpis, auctor id mattis eu, gravida in nisl. Aliquam tristique arcu ac erat congue sagittis. Nunc faucibus purus non enim vestibulum ultrices. Nunc nec dolor nisl, et bibendum felis. Duis lorem sem, molestie nec bibendum eu, gravida ut massa. Nam scelerisque fermentum ipsum, sit amet tincidunt lorem iaculis nec. Pellentesque sagittis vulputate lorem a adipiscing. Quisque et urna vitae massa suscipit auctor sed sed velit. Sed tincidunt ornare enim id bibendum. Aliquam erat volutpat. Sed imperdiet pretium libero, ac porttitor ligula congue id. Nulla dictum, sapien in dignissim consectetur, odio velit varius tortor, non interdum mauris quam a nisl. In ultrices ultricies lobortis. Phasellus porttitor venenatis mauris.</p>\r\n<p>\r\n	Nunc varius fermentum imperdiet. Aliquam in enim diam. Praesent eu neque tellus, non iaculis leo. Etiam et mi dolor. Mauris tincidunt, eros id dapibus tincidunt, leo arcu rhoncus arcu, vitae auctor neque orci eget lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec posuere ullamcorper fringilla. Morbi turpis neque, hendrerit ac sodales eu, gravida ornare enim.</p>\r\n', 1200, '<ul>\r\n	<li>\r\n		One</li>\r\n	<li>\r\n		Two</li>\r\n	<li>\r\n		Three</li>\r\n</ul>\r\n', '<ul>\r\n	<li>\r\n		One</li>\r\n	<li>\r\n		Two</li>\r\n	<li>\r\n		Three</li>\r\n</ul>\r\n', '<a href = "backend/lakeland_itinerary/3/1">Itinerary</a>', '<a href = "backend/images/3/1">Images</a>', 'test-trip-2', 1, '<a href = "backend/lakeland_scheduled_trips/add/3">Schedule</a>'),
(4, 'Day Trip 1', 0, '<img width = "100" src = "images/thumb__0cfd-penguins.jpg" />', '<p>\r\n	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla velit dui, elementum vitae volutpat non, rhoncus at dolor. Integer dapibus orci eget tellus egestas fringilla. Nunc enim turpis, auctor id mattis eu, gravida in nisl. Aliquam tristique arcu ac erat congue sagittis. Nunc faucibus purus non enim vestibulum ultrices. Nunc nec dolor nisl, et bibendum felis. Duis lorem sem, molestie nec bibendum eu, gravida ut massa. Nam scelerisque fermentum ipsum, sit amet tincidunt lorem iaculis nec. Pellentesque sagittis vulputate lorem a adipiscing. Quisque et urna vitae massa suscipit auctor sed sed velit. Sed tincidunt ornare enim id bibendum. Aliquam erat volutpat. Sed imperdiet pretium libero, ac porttitor ligula congue id. Nulla dictum, sapien in dignissim consectetur, odio velit varius tortor, non interdum mauris quam a nisl. In ultrices ultricies lobortis. Phasellus porttitor venenatis mauris.</p>\r\n<p>\r\n	Nunc varius fermentum imperdiet. Aliquam in enim diam. Praesent eu neque tellus, non iaculis leo. Etiam et mi dolor. Mauris tincidunt, eros id dapibus tincidunt, leo arcu rhoncus arcu, vitae auctor neque orci eget lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec posuere ullamcorper fringilla. Morbi turpis neque, hendrerit ac sodales eu, gravida ornare enim.</p>\r\n', 900, '', '', '<a href = "backend/lakeland_itinerary/4/3">Itinerary</a>', '<a href = "backend/images/4/3">Images</a>', 'day-trip-1', 3, '<a href = "backend/lakeland_scheduled_trips/add/4">Schedule</a>'),
(5, 'Weekend Getaway Test Long Title for Schedule', 0, '<img width = "100" src = "images/thumb__7035-jellyfish.jpg" />', '<p>\r\n	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla velit dui, elementum vitae volutpat non, rhoncus at dolor. Integer dapibus orci eget tellus egestas fringilla. Nunc enim turpis, auctor id mattis eu, gravida in nisl. Aliquam tristique arcu ac erat congue sagittis. Nunc faucibus purus non enim vestibulum ultrices. Nunc nec dolor nisl, et bibendum felis. Duis lorem sem, molestie nec bibendum eu, gravida ut massa. Nam scelerisque fermentum ipsum, sit amet tincidunt lorem iaculis nec. Pellentesque sagittis vulputate lorem a adipiscing. Quisque et urna vitae massa suscipit auctor sed sed velit. Sed tincidunt ornare enim id bibendum. Aliquam erat volutpat. Sed imperdiet pretium libero, ac porttitor ligula congue id. Nulla dictum, sapien in dignissim consectetur, odio velit varius tortor, non interdum mauris quam a nisl. In ultrices ultricies lobortis. Phasellus porttitor venenatis mauris.</p>\r\n<p>\r\n	Nunc varius fermentum imperdiet. Aliquam in enim diam. Praesent eu neque tellus, non iaculis leo. Etiam et mi dolor. Mauris tincidunt, eros id dapibus tincidunt, leo arcu rhoncus arcu, vitae auctor neque orci eget lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec posuere ullamcorper fringilla. Morbi turpis neque, hendrerit ac sodales eu, gravida ornare enim.</p>\r\n', 1000, '<ul>\r\n	<li>\r\n		1</li>\r\n	<li>\r\n		2</li>\r\n	<li>\r\n		3</li>\r\n</ul>\r\n', '<ul>\r\n	<li>\r\n		4</li>\r\n	<li>\r\n		5</li>\r\n	<li>\r\n		6</li>\r\n</ul>\r\n', '<a href = "backend/lakeland_itinerary/5/2">Itinerary</a>', '<a href = "backend/images/5/2">Images</a>', 'weekend-getaway-test', 2, '<a href = "backend/lakeland_scheduled_trips/add/5">Schedule</a>');

-- --------------------------------------------------------

--
-- Table structure for table `lakeland_safari_images`
--

CREATE TABLE IF NOT EXISTS `lakeland_safari_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `title` text NOT NULL,
  `safari` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `lakeland_safari_images`
--

INSERT INTO `lakeland_safari_images` (`id`, `image`, `title`, `safari`, `priority`) VALUES
(13, '21cc-002.jpg', 'Crossing the Indian Ocean', 1, 3),
(14, '5a97-001.jpg', 'The River Green', 1, 1),
(15, '98ca-003.jpg', 'Le Jardin', 1, 4),
(16, 'e00f-004.jpg', 'Pretty House', 1, 5),
(17, 'c7f4-005.jpg', 'Town', 1, 6),
(18, '398f-006.jpg', 'Chillis', 1, 2),
(19, '6f30-007.jpg', 'The Beautiful Bridge', 3, 0),
(20, '626f-008.jpg', 'Waterfalls', 3, 0),
(21, 'f681-011.jpg', 'Blue Garden', 3, 0),
(22, '9788-012.jpg', 'Forest River', 3, 0),
(23, 'f37b-lighthouse.jpg', '', 4, 2),
(24, 'ee02-koala.jpg', '', 4, 3),
(25, '0cfd-penguins.jpg', '', 4, 1),
(26, 'e84d-tulips.jpg', '', 4, 4),
(27, '9219-chrysanthemum.jpg', 'Flowers', 5, 2),
(28, 'cafa-hydrangeas.jpg', 'Flowers', 5, 3),
(29, 'd1bd-desert.jpg', 'Desert', 5, 4),
(30, '7035-jellyfish.jpg', 'Jelly Fish', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lakeland_scheduled_trips`
--

CREATE TABLE IF NOT EXISTS `lakeland_scheduled_trips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `trip` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `lakeland_scheduled_trips`
--

INSERT INTO `lakeland_scheduled_trips` (`id`, `start_date`, `end_date`, `trip`) VALUES
(7, '2013-01-17', '2013-01-31', 1),
(8, '2013-02-01', '2013-02-28', 5),
(9, '2013-04-01', '2013-05-08', 3);

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
(1, '\0\0', 'administrator', '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4', '9462e8eee0', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1357800684, 1, 'Admin', 'istrator', 'ADMIN', '0');

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
