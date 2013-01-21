-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 21, 2013 at 01:16 PM
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
-- Table structure for table `lakeland_album_images`
--

CREATE TABLE IF NOT EXISTS `lakeland_album_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `title` text NOT NULL,
  `album` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `lakeland_album_images`
--

INSERT INTO `lakeland_album_images` (`id`, `image`, `title`, `album`, `priority`) VALUES
(1, 'af49-tulips.jpg', 'Flowers', 1, 0),
(2, 'a407-lighthouse.jpg', 'Tower', 1, 0),
(3, 'a51f-penguins.jpg', 'Penguis', 1, 0),
(4, 'cfd6-jellyfish.jpg', 'Jelly FIsh', 2, 0),
(5, 'bfcc-chrysanthemum.jpg', 'Flower', 2, 0),
(6, 'c225-desert.jpg', 'Desert', 2, 0),
(7, '3e6d-koala.jpg', 'Koala', 2, 0),
(8, '6dee-hydrangeas.jpg', 'Wild Orchird From Mikumi National Park', 3, 0),
(9, 'e583-desert.jpg', 'Mountains', 3, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=376 ;

--
-- Dumping data for table `lakeland_captcha`
--

INSERT INTO `lakeland_captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES
(360, 1358749489, '127.0.0.1', 'ZP8MKUD'),
(361, 1358749934, '127.0.0.1', 'X8M43TK'),
(362, 1358749999, '127.0.0.1', 'GUPJ2KV'),
(363, 1358750067, '127.0.0.1', '4XHDK9C'),
(364, 1358753679, '127.0.0.1', '769REFV'),
(365, 1358753718, '127.0.0.1', 'FZPCKVH'),
(366, 1358755014, '127.0.0.1', 'Z7GDSUP'),
(367, 1358755062, '127.0.0.1', '2CKT84R'),
(368, 1358756103, '127.0.0.1', 'ZPU9S3E'),
(369, 1358756202, '127.0.0.1', 'PG83ZYD'),
(370, 1358756236, '127.0.0.1', '3CFRTM9'),
(371, 1358756299, '127.0.0.1', 'QRJHVKY'),
(372, 1358756393, '127.0.0.1', 'DBYJP3E'),
(373, 1358756610, '127.0.0.1', '2T83BZF'),
(374, 1358758591, '127.0.0.1', '5AVBWH6'),
(375, 1358758615, '127.0.0.1', 'FKG9Z5V');

-- --------------------------------------------------------

--
-- Table structure for table `lakeland_destinations`
--

CREATE TABLE IF NOT EXISTS `lakeland_destinations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `destination_type` int(11) NOT NULL,
  `destination_name` varchar(255) NOT NULL,
  `thumb_nail` varchar(255) NOT NULL,
  `destination_description` text NOT NULL,
  `images` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `lakeland_destinations`
--

INSERT INTO `lakeland_destinations` (`id`, `destination_type`, `destination_name`, `thumb_nail`, `destination_description`, `images`, `url`) VALUES
(1, 11, 'Bahari Beach', '<img width = "100" src = "images/thumb__4034-beach-desktop-wallpapers-3.jpg" />', '<p>\r\n	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas id ipsum eu nunc accumsan convallis sit amet nec ante. Duis non risus elit, vel faucibus dui. Ut in iaculis dui. Fusce scelerisque molestie ante, sit amet aliquam justo vehicula quis. Proin varius nisl et nibh varius vel viverra felis rutrum. Donec lobortis luctus augue. Proin consequat tincidunt magna, vitae interdum purus bibendum vulputate. Vivamus eu leo gravida erat pulvinar bibendum quis suscipit elit. In lectus nulla, fermentum vel consequat non, venenatis vel urna. Nullam cursus hendrerit bibendum. Duis venenatis mi eget orci fringilla tristique in ac purus. Quisque cursus, magna ut hendrerit vulputate, arcu elit condimentum sem, et imperdiet risus est ac justo. Praesent risus metus, tristique suscipit bibendum id, pellentesque eu ligula. Suspendisse in ligula lorem. Cras suscipit mattis mollis. Sed adipiscing nisi eu mi imperdiet lacinia.</p>\r\n<p>\r\n	Curabitur nisi nunc, sodales sed hendrerit non, posuere nec tellus. Integer sit amet urna eget erat scelerisque gravida. Mauris eleifend tincidunt odio, a pharetra augue aliquet sed. Phasellus id felis ligula, a blandit diam. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam commodo odio in sapien gravida ut tempor metus vulputate. Pellentesque vulputate sapien sit amet felis porttitor ut cursus dui sodales. Integer magna mauris, sollicitudin commodo porttitor id, ornare sit amet mauris. Ut vestibulum condimentum diam nec euismod. Donec ut augue erat. Fusce in lacus nisl, eu placerat lorem. Fusce eget nulla nisl. Aliquam laoreet posuere ligula, non laoreet lorem volutpat eget. Donec sem tellus, scelerisque sed ultrices vitae, gravida id metus. Maecenas semper nulla et odio volutpat non tincidunt dui hendrerit.</p>\r\n', '<a href = "backend/destination_images/1/update">Images</a>', 'bahari-beach'),
(2, 12, 'Masai Dancing Spot', '<img width = "100" src = "images/thumb__2a7a-jumping-masai-warriors.jpg" />', '<p>\r\n	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas id ipsum eu nunc accumsan convallis sit amet nec ante. Duis non risus elit, vel faucibus dui. Ut in iaculis dui. Fusce scelerisque molestie ante, sit amet aliquam justo vehicula quis. Proin varius nisl et nibh varius vel viverra felis rutrum. Donec lobortis luctus augue. Proin consequat tincidunt magna, vitae interdum purus bibendum vulputate. Vivamus eu leo gravida erat pulvinar bibendum quis suscipit elit. In lectus nulla, fermentum vel consequat non, venenatis vel urna. Nullam cursus hendrerit bibendum. Duis venenatis mi eget orci fringilla tristique in ac purus. Quisque cursus, magna ut hendrerit vulputate, arcu elit condimentum sem, et imperdiet risus est ac justo. Praesent risus metus, tristique suscipit bibendum id, pellentesque eu ligula. Suspendisse in ligula lorem. Cras suscipit mattis mollis. Sed adipiscing nisi eu mi imperdiet lacinia.</p>\r\n<p>\r\n	Curabitur nisi nunc, sodales sed hendrerit non, posuere nec tellus. Integer sit amet urna eget erat scelerisque gravida. Mauris eleifend tincidunt odio, a pharetra augue aliquet sed. Phasellus id felis ligula, a blandit diam. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam commodo odio in sapien gravida ut tempor metus vulputate. Pellentesque vulputate sapien sit amet felis porttitor ut cursus dui sodales. Integer magna mauris, sollicitudin commodo porttitor id, ornare sit amet mauris. Ut vestibulum condimentum diam nec euismod. Donec ut augue erat. Fusce in lacus nisl, eu placerat lorem. Fusce eget nulla nisl. Aliquam laoreet posuere ligula, non laoreet lorem volutpat eget. Donec sem tellus, scelerisque sed ultrices vitae, gravida id metus. Maecenas semper nulla et odio volutpat non tincidunt dui hendrerit.</p>\r\n', '<a href = "backend/destination_images/2/update">Images</a>', 'masai-dancing-spot'),
(3, 10, 'Mikumi National Park', '<img width = "100" src = "images/thumb__7387-images.jpg" />', '<p>\r\n	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas id ipsum eu nunc accumsan convallis sit amet nec ante. Duis non risus elit, vel faucibus dui. Ut in iaculis dui. Fusce scelerisque molestie ante, sit amet aliquam justo vehicula quis. Proin varius nisl et nibh varius vel viverra felis rutrum. Donec lobortis luctus augue. Proin consequat tincidunt magna, vitae interdum purus bibendum vulputate. Vivamus eu leo gravida erat pulvinar bibendum quis suscipit elit. In lectus nulla, fermentum vel consequat non, venenatis vel urna. Nullam cursus hendrerit bibendum. Duis venenatis mi eget orci fringilla tristique in ac purus. Quisque cursus, magna ut hendrerit vulputate, arcu elit condimentum sem, et imperdiet risus est ac justo. Praesent risus metus, tristique suscipit bibendum id, pellentesque eu ligula. Suspendisse in ligula lorem. Cras suscipit mattis mollis. Sed adipiscing nisi eu mi imperdiet lacinia.</p>\r\n<p>\r\n	Curabitur nisi nunc, sodales sed hendrerit non, posuere nec tellus. Integer sit amet urna eget erat scelerisque gravida. Mauris eleifend tincidunt odio, a pharetra augue aliquet sed. Phasellus id felis ligula, a blandit diam. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam commodo odio in sapien gravida ut tempor metus vulputate. Pellentesque vulputate sapien sit amet felis porttitor ut cursus dui sodales. Integer magna mauris, sollicitudin commodo porttitor id, ornare sit amet mauris. Ut vestibulum condimentum diam nec euismod. Donec ut augue erat. Fusce in lacus nisl, eu placerat lorem. Fusce eget nulla nisl. Aliquam laoreet posuere ligula, non laoreet lorem volutpat eget. Donec sem tellus, scelerisque sed ultrices vitae, gravida id metus. Maecenas semper nulla et odio volutpat non tincidunt dui hendrerit.</p>\r\n', '<a href = "backend/destination_images/3/update">Images</a>', 'mikumi-national-park');

-- --------------------------------------------------------

--
-- Table structure for table `lakeland_destination_images`
--

CREATE TABLE IF NOT EXISTS `lakeland_destination_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `title` text NOT NULL,
  `destination` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `lakeland_destination_images`
--

INSERT INTO `lakeland_destination_images` (`id`, `image`, `title`, `destination`, `priority`) VALUES
(23, 'f37b-lighthouse.jpg', '', 4, 2),
(24, 'ee02-koala.jpg', '', 4, 3),
(25, '0cfd-penguins.jpg', '', 4, 1),
(26, 'e84d-tulips.jpg', '', 4, 4),
(27, '9219-chrysanthemum.jpg', 'Flowers', 5, 2),
(28, 'cafa-hydrangeas.jpg', 'Flowers', 5, 3),
(29, 'd1bd-desert.jpg', 'Desert', 5, 4),
(30, '7035-jellyfish.jpg', 'Jelly Fish', 5, 1),
(31, '2a7a-jumping-masai-warriors.jpg', 'Warriors Jumping with pointed Spears', 2, 0),
(32, 'ae78-masai-warriors-tanzania2.jpg', 'Trying Out Jumping', 2, 0),
(33, '53e0-masai.jpg', 'Three at a time', 2, 0),
(34, '302d-african-traditional-jumps-masai-mara-warriors-dancing-kenya-1600x1604.jpg', 'I jump the highest', 2, 0),
(35, '7387-images.jpg', 'Lions Gazing', 3, 0),
(36, '1d99-1640__550x400_zebra-mikumi-national-park.jpg', 'Zebra''s Chilling', 3, 0),
(37, '6734-impala-eland.jpg', 'Impala and Eland', 3, 0),
(38, '52b4-african_bush_elephant_mikumi.jpg', 'Elephant Strutting ', 3, 0),
(39, '4034-beach-desktop-wallpapers-3.jpg', 'Coconut Tree at the Beach', 1, 0),
(40, '622a-nha-trang-beach.jpg', 'Beach Huts', 1, 0),
(41, '46e2-tropical-beach-wallpaper-1920x1200.jpg', 'Beach Bed', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lakeland_destination_types`
--

CREATE TABLE IF NOT EXISTS `lakeland_destination_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `lakeland_destination_types`
--

INSERT INTO `lakeland_destination_types` (`id`, `title`) VALUES
(1, 'National Park'),
(2, 'Beach'),
(3, 'Cultural Tourism Spot');

-- --------------------------------------------------------

--
-- Table structure for table `lakeland_draws_from`
--

CREATE TABLE IF NOT EXISTS `lakeland_draws_from` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `lakeland_draws_from`
--

INSERT INTO `lakeland_draws_from` (`id`, `title`, `type`) VALUES
(1, 'Group Overland Safaris Categories', 1),
(2, 'Destinations Categories', 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `lakeland_itinerary`
--

INSERT INTO `lakeland_itinerary` (`id`, `title`, `activities`, `safari`) VALUES
(1, 'Day One', '<ul>\r\n	<li>\r\n		Dance</li>\r\n	<li>\r\n		Play</li>\r\n	<li>\r\n		Sing</li>\r\n</ul>\r\n', 1),
(2, 'Day Two', '<ul>\r\n	<li>\r\n		Sit</li>\r\n	<li>\r\n		Read</li>\r\n	<li>\r\n		Reflect</li>\r\n</ul>\r\n', 1),
(3, 'Day 1', '<ul>\r\n	<li>\r\n		Eat</li>\r\n	<li>\r\n		Pray</li>\r\n	<li>\r\n		Love</li>\r\n</ul>\r\n', 3),
(4, 'Day 2', '<ul>\r\n	<li>\r\n		Dance</li>\r\n	<li>\r\n		Sleep</li>\r\n	<li>\r\n		Walk</li>\r\n</ul>\r\n', 3),
(5, 'Saturday', '<ul>\r\n	<li>\r\n		Dance</li>\r\n	<li>\r\n		Play</li>\r\n	<li>\r\n		Sing</li>\r\n</ul>\r\n', 5),
(6, 'Day 1: Arrive in Dar es Salaam', '<ul>\r\n	<li>\r\n		Accommodation in a Hotel</li>\r\n</ul>\r\n', 9),
(7, 'Day 2: Dar es Salaam - Mikumi National Park', '<ul>\r\n	<li>\r\n		Game drive and overnight Mikumi</li>\r\n	<li>\r\n		Distance 300kms</li>\r\n	<li>\r\n		Camping in Mikumi National Park</li>\r\n</ul>\r\n', 9),
(8, 'Day 3:  Mikumi - Udzungwa Mountains', '<ul>\r\n	<li>\r\n		Hiking</li>\r\n	<li>\r\n		Distance 75kms</li>\r\n	<li>\r\n		Camping at Udzungwa</li>\r\n</ul>\r\n', 9);

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
  `draws_from` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `browser_title` varchar(70) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `lakeland_pages`
--

INSERT INTO `lakeland_pages` (`id`, `title`, `content`, `section`, `parent_page`, `url`, `thumbnail`, `draws_from`, `priority`, `browser_title`) VALUES
(1, 'Home', '<p>\r\n	Lakeland Africa Limited is Tanzania&#39;s leading provider of group overland budget travels.&nbsp; It was formed with the intention of ultimately providing all forms of land travels as well as wildlife safaris, adventure and cultural tourism.</p>\r\n<p>\r\n	<strong>Our current services:</strong></p>\r\n<p>\r\n	City Car &amp; Truck Rentals, Airport and hotel transfers, Camping safaris, Beach holidays, Wildlife tourism, Overland Adventure tourism, Cultural and historical tourism, Mountain Climbing. We also organise fishing and water sports such as canoeing festivals in Lake Victoria.</p>\r\n', 0, 0, 'home', '', 0, 1, 'Lakeland Africa Limited'),
(2, 'About Us', '<p>\r\n	<strong>Our Mission</strong></p>\r\n<p>\r\n	We believe that developed Tanzania is best for Lakeland Africa Limited. We therefore exist to help create wealth for our nation, for our employees and for our shareholders through a dedicated customer service to our clients.</p>\r\n<p>\r\n	<br />\r\n	<strong>Our Values</strong></p>\r\n<ul>\r\n	<li>\r\n		Honesty and integrity: We are ethical; we respect and keep our word</li>\r\n	<li>\r\n		Efficiency and effective: High level of service delivery</li>\r\n	<li>\r\n		Personalized services: We avoid the one size fits all modul</li>\r\n	<li>\r\n		Team work: we pool together our ideas and efforts to the benefit of our clients</li>\r\n	<li>\r\n		The community that houses us is our own best hope for progress, wealth creation and security.</li>\r\n</ul>\r\n<p>\r\n	<br />\r\n	<strong>Our Vision</strong></p>\r\n<p>\r\n	To care, think and always act in the best interest of our clients and the Nation.</p>\r\n', 0, 0, 'about-us', '', 0, 2, 'About Lakeland Africa'),
(3, 'Group Overland Safaris', '', 0, 0, 'group-overland-safaris', '', 1, 3, ''),
(4, 'Destination', '', 0, 0, 'destination', '', 2, 4, ''),
(5, 'Safari Vehicles', '', 0, 0, 'vehicles', '', 0, 5, ''),
(12, 'Overland Vehicles', '<p>\r\n	Overland Vehicles</p>\r\n', 1, 5, 'overland-vehicles', '', 0, 12, ''),
(13, 'Safari Landcruisers', '<p>\r\n	Safari Landcruisers.</p>\r\n', 1, 5, 'safari-landcruisers', '', 0, 13, ''),
(14, 'Car Rental', '', 0, 0, 'carrentals', '', 0, 14, ''),
(15, 'Self Driven Car Rentals in Dar es Salaam & Tanzania', '<table border="0" cellpadding="1" cellspacing="1" style="width: 500px;">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n				<strong>Car Rental Rates Within Dar es Salaam</strong></td>\r\n			<td>\r\n				<strong>US$</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Toyota Saloon</td>\r\n			<td>\r\n				30</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Toyota Rav 4 (Old Model)</td>\r\n			<td>\r\n				35</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Toyota Rav 4 (New Model)</td>\r\n			<td>\r\n				60</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Hyundai / Suzuki Grand Vitara</td>\r\n			<td>\r\n				60</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Nissan X-trail</td>\r\n			<td>\r\n				60</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Harrier / Noah</td>\r\n			<td>\r\n				60</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Toyota Prado / Land Cruiser / Nissan Patrol / 4WD</td>\r\n			<td>\r\n				80</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Mini Bus</td>\r\n			<td>\r\n				80</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Toyota Coaster</td>\r\n			<td>\r\n				180</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p>\r\n	&nbsp;</p>\r\n<table border="0" cellpadding="1" cellspacing="1" style="width: 500px;">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n				<strong>Car Rental Rates Within Dar es Salaam</strong></td>\r\n			<td>\r\n				<strong>US$</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Toyota Saloon</td>\r\n			<td>\r\n				50</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Toyota Rav 4 (Old Model)</td>\r\n			<td>\r\n				45</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Toyota Rav 4 (New Model)</td>\r\n			<td>\r\n				70</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Hyundai / Suzuki Grand Vitara</td>\r\n			<td>\r\n				70</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Nissan X-trail</td>\r\n			<td>\r\n				70</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Harrier / Noah</td>\r\n			<td>\r\n				70</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Toyota Prado / Land Cruiser / Nissan Patrol / 4WD</td>\r\n			<td>\r\n				80</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Mini Bus</td>\r\n			<td>\r\n				80</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Toyota Coaster</td>\r\n			<td>\r\n				220</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p>\r\n	&nbsp;</p>\r\n<table border="0" cellpadding="1" cellspacing="1" style="width: 500px;">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n				<strong>Car Monthly Rental Rates</strong></td>\r\n			<td>\r\n				<strong>US$</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Toyota Saloon</td>\r\n			<td>\r\n				850</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Toyota Rav 4 (Old Model)</td>\r\n			<td>\r\n				1,000</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Toyota Rav 4 (New Model)</td>\r\n			<td>\r\n				1,600</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Hyundai / Suzuki Grand Vitara</td>\r\n			<td>\r\n				1,600</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Nissan X-trail</td>\r\n			<td>\r\n				1,600</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Harrier / Noah</td>\r\n			<td>\r\n				1,600</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Toyota Prado / Land Cruiser / Nissan Patrol / 4WD</td>\r\n			<td>\r\n				1,600</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Mini Bus</td>\r\n			<td>\r\n				2,200</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Toyota Coaster</td>\r\n			<td>\r\n				2,200</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<strong>Conditions for the Rates Above:</strong></p>\r\n<ul>\r\n	<li>\r\n		You are free to travel 100kms per day within or outside Dar es Salaam. Any extra kilometer travelled over and above the first 100kms will be charged at US$ 0.5 as an addition cost.&nbsp; Except for the Overland Truck which has unlimited mileage usage within Tanzania.</li>\r\n	<li>\r\n		Fuel is not included in the charges except for the Overland Truck where the above rates include fuel.</li>\r\n	<li>\r\n		VAT is excluded from the above charge</li>\r\n	<li>\r\n		Driver allowance is an addition cost and is paid to Lakeland Africa Limited.</li>\r\n	<li>\r\n		Driver overtime is charged at USD 1.2 per hour.</li>\r\n	<li>\r\n		Monthly wages for the driver US $ 250 within Dar es Salaam and US $ 500 outside Dar es Salaam.</li>\r\n</ul>\r\n', 2, 14, 'self-driven-car-rentals-in-dar-es-salaam-tanzania', '', 0, 15, ''),
(16, 'Chaufer Driven Car Hire in Dar es Salaam & Tanzania', '<table border="0" cellpadding="1" cellspacing="1" style="width: 500px;">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n				<strong>Car Rental Rates Within Dar es Salaam</strong></td>\r\n			<td>\r\n				<strong>US$</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Toyota Saloon</td>\r\n			<td>\r\n				50</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Toyota Rav 4 (Old Model)</td>\r\n			<td>\r\n				35</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Toyota Rav 4 (New Model)</td>\r\n			<td>\r\n				60</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Hyundai / Suzuki Grand Vitara</td>\r\n			<td>\r\n				60</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Nissan X-trail</td>\r\n			<td>\r\n				60</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Harrier / Noah</td>\r\n			<td>\r\n				60</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Toyota Prado / Land Cruiser / Nissan Patrol / 4WD</td>\r\n			<td>\r\n				80</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Mini Bus</td>\r\n			<td>\r\n				80</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Toyota Coaster</td>\r\n			<td>\r\n				180</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p>\r\n	&nbsp;</p>\r\n<table border="0" cellpadding="1" cellspacing="1" style="width: 500px;">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n				<strong>Car Rental Rates Within Dar es Salaam</strong></td>\r\n			<td>\r\n				<strong>US$</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Toyota Saloon</td>\r\n			<td>\r\n				50</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Toyota Rav 4 (Old Model)</td>\r\n			<td>\r\n				45</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Toyota Rav 4 (New Model)</td>\r\n			<td>\r\n				70</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Hyundai / Suzuki Grand Vitara</td>\r\n			<td>\r\n				70</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Nissan X-trail</td>\r\n			<td>\r\n				70</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Harrier / Noah</td>\r\n			<td>\r\n				70</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Toyota Prado / Land Cruiser / Nissan Patrol / 4WD</td>\r\n			<td>\r\n				80</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Mini Bus</td>\r\n			<td>\r\n				80</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Toyota Coaster</td>\r\n			<td>\r\n				220</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p>\r\n	&nbsp;</p>\r\n<table border="0" cellpadding="1" cellspacing="1" style="width: 500px;">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n				<strong>Car Monthly Rental Rates</strong></td>\r\n			<td>\r\n				<strong>US$</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Toyota Saloon</td>\r\n			<td>\r\n				850</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Toyota Rav 4 (Old Model)</td>\r\n			<td>\r\n				1,000</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Toyota Rav 4 (New Model)</td>\r\n			<td>\r\n				1,600</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Hyundai / Suzuki Grand Vitara</td>\r\n			<td>\r\n				1,600</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Nissan X-trail</td>\r\n			<td>\r\n				1,600</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Harrier / Noah</td>\r\n			<td>\r\n				1,600</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Toyota Prado / Land Cruiser / Nissan Patrol / 4WD</td>\r\n			<td>\r\n				1,600</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Mini Bus</td>\r\n			<td>\r\n				2,200</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Toyota Coaster</td>\r\n			<td>\r\n				2,200</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p>\r\n	&nbsp;</p>\r\n<table border="0" cellpadding="1" cellspacing="1" style="width: 500px;">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n				<strong>Drivers&rsquo; Allowance:</strong></td>\r\n			<td>\r\n				<strong>US$</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Rate within Dar es Salaam per day</td>\r\n			<td>\r\n				15</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				Daily Rate outside Dar Es Salaam</td>\r\n			<td>\r\n				30</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p>\r\n	<strong>Conditions for the Rates Above:</strong></p>\r\n<ul>\r\n	<li>\r\n		You are free to travel 100kms per day within or outside Dar es Salaam. Any extra kilometer travelled over and above the first 100kms will be charged at US$ 0.5 as an addition cost.&nbsp; Except for the Overland Truck which has unlimited mileage usage within Tanzania.</li>\r\n	<li>\r\n		Fuel is not included in the charges except for the Overland Truck where the above rates include fuel.</li>\r\n	<li>\r\n		VAT is excluded from the above charge</li>\r\n	<li>\r\n		Driver allowance is an addition cost and is paid to Lakeland Africa Limited.</li>\r\n	<li>\r\n		Driver overtime is charged at USD 1.2 per hour.</li>\r\n	<li>\r\n		Monthly wages for the driver US $ 250 within Dar es Salaam and US $ 500 outside Dar es Salaam.</li>\r\n</ul>\r\n', 2, 14, 'chaufer-driven-car-hire-in-dar-es-salaam-tanzania', '', 0, 16, ''),
(17, 'Dar es Salaam Airport & City Transfers & Pickups', '<ol>\r\n	<li>\r\n		<strong>Office2Office Transfer:</strong><br />\r\n		<br />\r\n		This is a Professional approach and gives your company and staff a professional image.<br />\r\n		<br />\r\n		&nbsp;</li>\r\n	<li>\r\n		<strong>Airport Transfer:</strong><br />\r\n		<br />\r\n		Pick up at the airport and transfer to your home, office or hotel. Pick up clients from their homes, offices and hotels to their desired destinations. It is professional, Safe, secure and reliable to use a professional shuttle and transfer company that arrives at your door steps.<br />\r\n		<br />\r\n		&nbsp;</li>\r\n	<li>\r\n		<strong>Visitors Transfer:</strong><br />\r\n		<br />\r\n		A well uniformed chauffeur and a well known company will be there so meet and greet your visitor and bring them to your office, home or take them to the airport. So book our transfer services and then relax.<br />\r\n		<br />\r\n		&nbsp;</li>\r\n	<li>\r\n		<strong>Hotel2Business Transfer:</strong><br />\r\n		<br />\r\n		From the hotel, we will transfer you or your visitor to a stated meeting. A clean car and a uniformed clean driver who knows the city so well is sure to beat the traffic and get our clients to their business meeting. Plus it is safe and professional to arrive at your meeting in a professional way. Image matters in business.<br />\r\n		<br />\r\n		&nbsp;</li>\r\n	<li>\r\n		<strong>Meeting2Meeting Transfer:</strong><br />\r\n		<br />\r\n		No needs to wait for a passing Taxi after you have had a meeting. Let our uniformed driver wait for you at the door steps.<br />\r\n		<br />\r\n		&nbsp;</li>\r\n	<li>\r\n		<strong>Late Night Travellers&rsquo; Transfer:</strong><br />\r\n		<br />\r\n		Please don&rsquo;t grab a Taxi or unknown driver. Also it&rsquo;s our professional view that it is unwise to use family members or employees to drive you to and from the airport and other terminals at night. The employees need to rest and be ready for the next productive day; they need to be with their families at night and with employers during the day. At night family members need to be safe and secure at home. Use a professional night transfer service.<br />\r\n		<br />\r\n		&nbsp;</li>\r\n	<li>\r\n		<strong>Executive Transfers:</strong><br />\r\n		<br />\r\n		We will meet and greet your VIP and transfer them using the cars that have VIP status. You instruct us what to do and we will do exactly that.<br />\r\n		<br />\r\n		&nbsp;</li>\r\n	<li>\r\n		<strong>My kids Shuttle:</strong><br />\r\n		<br />\r\n		Home to school morning service, school to home afternoon service and the extracurricular activities evening transfer services. It gives you the time to concentrate on the most important tasks at hand, no need to reschedule that important meeting. No need to worry about the safety and security of the kids as we have thoroughly checked the background of all drivers handling the kids.<br />\r\n		<br />\r\n		&nbsp;</li>\r\n	<li>\r\n		<strong>Night Out Transfers:</strong><br />\r\n		<br />\r\n		With us you know your driver during your night out.<br />\r\n		<br />\r\n		&nbsp;</li>\r\n	<li>\r\n		<strong>Don&rsquo;t drink and Drive shuttles:</strong><br />\r\n		<br />\r\n		When you know you will be drunk, book our transfer service in advance and indicate the time that our driver can come and transfer you home. We help you not to endanger other road users&rsquo; lives. A good citizen doesn&rsquo;t drink and drive. Book our shuttle services if you know you will be drunk.<br />\r\n		<br />\r\n		&nbsp;</li>\r\n	<li>\r\n		<strong>Home-Office-Home (Same Route Employees&rsquo; Shuttle):</strong><br />\r\n		<br />\r\n		Come with your friends and co workers and create a classic home to work group shuttle. Alternatively contact our office to join our pre-arranged employees&rsquo; shuttles. Avoid the hassles of using daladalas. Go to work in style and comfort.</li>\r\n</ol>\r\n', 2, 14, 'dar-es-salaam-airport-city-transfers-pickups', '', 0, 17, ''),
(20, 'Photo Albums', '<p>\r\n	Please View and Enjoy our Photo Albums</p>\r\n', 0, 0, 'photo-albums', '', 0, 20, ''),
(21, 'Contact Us', '<p>\r\n	<strong>Office Phone</strong>: +255 222 761 811<br />\r\n	<strong>Fax:</strong> +255 222 761 812<br />\r\n	<strong>Mobile:</strong> +255 784 885 901<br />\r\n	<strong>Skype(ID:XXXXXX): </strong> <!--\r\n\r\nSkype ''Skype Me™!'' button\r\nhttp://www.skype.com/go/skypebuttons\r\n-->\r\n<script type="text/javascript" src="http://download.skype.com/share/skypebuttons/js/skypeCheck.js"></script>\r\n<a href="skype:lakelandafrica?call"><img src="http://download.skype.com/share/skypebuttons/buttons/call_blue_white_124x52.png" style="border: none;" width="124" height="52" alt="Skype Me™!" /></a></p>\r\n<p>\r\n	<strong>Physical Address:</strong><br />\r\n	<br />\r\n	2nd Floor, Room No. 3,<br />\r\n	Mwanamboka Plaza,<br />\r\n	Kawawa Road, Kinondoni,<br />\r\n	P.O. Box 13835<br />\r\n	Dar es Salaam, Tanzania</p>\r\n<p>\r\n	<em><strong>Housed in the same building with NBC Bank Kinondoni Branch</strong></em></p>\r\n<p>\r\n	&nbsp;</p>\r\n', 0, 0, 'contact-us', '', 0, 21, '');

-- --------------------------------------------------------

--
-- Table structure for table `lakeland_page_categories`
--

CREATE TABLE IF NOT EXISTS `lakeland_page_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(75) NOT NULL,
  `parent_category` int(11) NOT NULL,
  `intro_text` text NOT NULL,
  `url` varchar(160) NOT NULL,
  `template` varchar(50) NOT NULL,
  `type` int(11) NOT NULL,
  `safari_type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `lakeland_page_categories`
--

INSERT INTO `lakeland_page_categories` (`id`, `title`, `parent_category`, `intro_text`, `url`, `template`, `type`, `safari_type`) VALUES
(1, 'Day Tours', 0, '', 'day-tours', 'safari', 1, 3),
(2, 'Weekend Getaways', 0, '', 'weekend-getaways', 'safari', 1, 2),
(3, 'Overland Safaris', 0, '', 'overland-safaris', 'safari', 1, 0),
(4, '21 - 40 Tanzania Overland Safaris', 3, '', '21-40-tanzania-overland-safaris', 'safari', 1, 1),
(5, '14 - 20 Tanzania Overland Safaris', 3, '', '14-20-tanzania-overland-safaris', 'safari', 1, 1),
(6, '7 - 13 Tanzania Overland Safaris', 3, '', '7-13-tanzania-overland-safaris', 'safari', 1, 1),
(7, '3 - 6 Tanzania Overland Safaris', 3, '', '3-6-tanzania-overland-safaris', 'safari', 1, 1),
(8, 'Custom Packages', 0, '<p>\r\n	Intro</p>\r\n', 'custom-packages', 'safari', 1, 0),
(9, 'Scheduled Trips', 0, '', 'scheduled-trips', 'schedule', 1, 0),
(10, 'Tanzania National Parks', 0, '', 'tanzania-national-parks', 'destination', 2, 0),
(11, 'Beaches', 0, '', 'beaches', 'destination', 2, 0),
(12, 'Cultural Tourism', 0, '', 'cultural-tourism', 'destination\n', 2, 0),
(13, '1 - 2 Tanzania Overland Safaris', 3, '', '1-2-tanzania-overland-safaris', 'safari', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lakeland_photo_albums`
--

CREATE TABLE IF NOT EXISTS `lakeland_photo_albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `thumb_nail` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `images` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `lakeland_photo_albums`
--

INSERT INTO `lakeland_photo_albums` (`id`, `title`, `thumb_nail`, `url`, `images`) VALUES
(1, 'The North Tanzania Tour', '<img width = "100" src = "images/thumb__af49-tulips.jpg" />', 'the-north-tanzania-tour', '<a href = "backend/album_images/1/update">Images</a>'),
(2, 'The South Tanzania Tour', '<img width = "100" src = "images/thumb__cfd6-jellyfish.jpg" />', 'the-south-tanzania-tour', '<a href = "backend/album_images/2/insert">Images</a>'),
(3, 'The Northern Tanzania 14th Dec - 27th Dec', '<img width = "100" src = "images/thumb__6dee-hydrangeas.jpg" />', 'the-northern-tanzania-14th-dec-27th-dec', '<a href = "backend/album_images/3/insert">Images</a>');

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
  `price` varchar(255) NOT NULL,
  `includes` text NOT NULL,
  `excludes` text NOT NULL,
  `itinerary` varchar(255) NOT NULL,
  `images` varchar(255) NOT NULL,
  `url` varchar(100) NOT NULL,
  `safari_type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `lakeland_safaris`
--

INSERT INTO `lakeland_safaris` (`id`, `title`, `type`, `thumb_nail`, `introductory_text`, `price`, `includes`, `excludes`, `itinerary`, `images`, `url`, `safari_type`) VALUES
(5, 'Weekend Getaway Test Long Title for Schedule', 0, '<img width = "100" src = "images/thumb__7035-jellyfish.jpg" />', '<p>\r\n	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla velit dui, elementum vitae volutpat non, rhoncus at dolor. Integer dapibus orci eget tellus egestas fringilla. Nunc enim turpis, auctor id mattis eu, gravida in nisl. Aliquam tristique arcu ac erat congue sagittis. Nunc faucibus purus non enim vestibulum ultrices. Nunc nec dolor nisl, et bibendum felis. Duis lorem sem, molestie nec bibendum eu, gravida ut massa. Nam scelerisque fermentum ipsum, sit amet tincidunt lorem iaculis nec. Pellentesque sagittis vulputate lorem a adipiscing. Quisque et urna vitae massa suscipit auctor sed sed velit. Sed tincidunt ornare enim id bibendum. Aliquam erat volutpat. Sed imperdiet pretium libero, ac porttitor ligula congue id. Nulla dictum, sapien in dignissim consectetur, odio velit varius tortor, non interdum mauris quam a nisl. In ultrices ultricies lobortis. Phasellus porttitor venenatis mauris.</p>\r\n<p>\r\n	Nunc varius fermentum imperdiet. Aliquam in enim diam. Praesent eu neque tellus, non iaculis leo. Etiam et mi dolor. Mauris tincidunt, eros id dapibus tincidunt, leo arcu rhoncus arcu, vitae auctor neque orci eget lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec posuere ullamcorper fringilla. Morbi turpis neque, hendrerit ac sodales eu, gravida ornare enim.</p>\r\n', '1000', '<ul>\r\n	<li>\r\n		1</li>\r\n	<li>\r\n		2</li>\r\n	<li>\r\n		3</li>\r\n</ul>\r\n', '<ul>\r\n	<li>\r\n		4</li>\r\n	<li>\r\n		5</li>\r\n	<li>\r\n		6</li>\r\n</ul>\r\n', '<a href = "backend/lakeland_itinerary/5/2">Itinerary</a>', '<a href = "backend/images/5/2">Images</a>', 'weekend-getaway-test-long-title-for-schedule', 2),
(6, 'Test Safari To See If It Works', 0, '', '', '0', '', '', '', '', '', 0),
(7, 'This is a Test', 0, '', '', '0', '', '', '', '', '', 0),
(9, '13 Day 12 Night Southern Tanzania Overland Safari', 6, '<img width = "100" src = "images/thumb__9dc6-desert.jpg" />', '<p>\r\n	These activities take about 6 hours</p>\r\n', 'USD 2,000 for Foreigners, TZS 150,000 for Tanzanians', '<ul>\r\n	<li>\r\n		Hotel accommodation on the day of arrival</li>\r\n	<li>\r\n		Airport Transfers</li>\r\n	<li>\r\n		Tour guide, Chef and driver.</li>\r\n	<li>\r\n		Three meals a day: breakfast, Lunch and Dinner</li>\r\n	<li>\r\n		One bottler of water per day( 1.5litres)</li>\r\n	<li>\r\n		Transport(Overland Truck)</li>\r\n	<li>\r\n		Guiding Fees</li>\r\n	<li>\r\n		Camping equipment</li>\r\n	<li>\r\n		National Park entry fees</li>\r\n	<li>\r\n		National Park Camping fees</li>\r\n	<li>\r\n		Boat safari/cruise in the Selous Game Reserve</li>\r\n	<li>\r\n		Cultural Tour guide fee in Morogoro</li>\r\n	<li>\r\n		Historical sites tour fees in Bagamoyo</li>\r\n	<li>\r\n		Cultural dances in Bagamoyo.</li>\r\n</ul>\r\n', '<ul>\r\n	<li>\r\n		VISAs&nbsp;</li>\r\n	<li>\r\n		Medical Insurance</li>\r\n	<li>\r\n		International Tickets</li>\r\n</ul>\r\n', '<a href = "backend/lakeland_itinerary/9/1">Itinerary</a>', '<a href = "backend/images/9/1">Images</a>', '13-day-12-night-southern-tanzania-overland-safari', 1),
(10, 'Mikumi National Park Tanzania Day Trip', 0, '<img width = "100" src = "images/thumb__0cbb-lighthouse.jpg" />', '<p>\r\n	This park is 300kms away from Dar Es Salaam and 100kms away from Morogoro Town.</p>\r\n<p>\r\n	To read more about Mikumi National Park&nbsp;<a href="http://localhost/lakeland/destination/mikumi-national-park">click here</a></p>\r\n<p>\r\n	<br />\r\n	<strong>Why Lakeland Africa goes to Mikumi National Park:</strong></p>\r\n<ul>\r\n	<li>\r\n		Wonderful wildlife game viewing nearby the Dar es Salaam commercial city, giving those business visitors and tourists with a short stay in Dar Es Salaam a good two days or even a one day visit of this great natural wildlife.</li>\r\n	<li>\r\n		A nearby weekends and holidays period getaway national park for local residents in Dar es Salaam city.</li>\r\n	<li>\r\n		The park is accessible all year round.</li>\r\n	<li>\r\n		Main attractions here:</li>\r\n	<li>\r\n		The Mkata flood plain dominated by open grassland along with the mountain ranges that border the park on two sides</li>\r\n	<li>\r\n		The woodlands is a favorite area for sporting lions</li>\r\n	<li>\r\n		Home to a formidable herds of buffalo and Mikumi elephants are more compact than those in the rest of the country</li>\r\n	<li>\r\n		The highlight of Mikumi National Park is the African hunting dog, one of Africa&rsquo;s rarest mammals.</li>\r\n	<li>\r\n		Birdlife is also a great attraction here as the rains swell the park birds population due to the European birds seeking refuge in the Mikumi National Park</li>\r\n</ul>\r\n<p>\r\n	Although this park can still be visited throughout the year the best times to go are December to March when wildlife numbers are their highest and elephants from Selous Game Reserve and Rubeho Mountains converge here.</p>\r\n<p>\r\n	The dry season from August to October is also ideal when animals are concentrated around water sources.</p>\r\n', '100', '', '', '<a href = "backend/lakeland_itinerary/10/3">Itinerary</a>', '<a href = "backend/images/10/3">Images</a>', 'mikumi-national-park-tanzania-day-trip', 3),
(11, 'Test', 6, '<img width = "100" src = "images/thumb__1f2d-hydrangeas.jpg" />', '', '0', '', '', '<a href = "backend/lakeland_itinerary/11/1">Itinerary</a>', '<a href = "backend/images/11/1">Images</a>', 'test', 1),
(13, '', 0, '', '', '0', '', '', '', '', '', 0),
(14, 'Test 2', 7, '<img width = "100" src = "images/thumb__0663-chrysanthemum.jpg" />', '', '0', '', '', '<a href = "backend/lakeland_itinerary/14/1">Itinerary</a>', '<a href = "backend/images/14/1">Images</a>', 'test-2', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `lakeland_safari_images`
--

INSERT INTO `lakeland_safari_images` (`id`, `image`, `title`, `safari`, `priority`) VALUES
(23, 'f37b-lighthouse.jpg', '', 4, 2),
(24, 'ee02-koala.jpg', '', 4, 3),
(25, '0cfd-penguins.jpg', '', 4, 1),
(26, 'e84d-tulips.jpg', '', 4, 4),
(27, '9219-chrysanthemum.jpg', 'Flowers', 5, 2),
(28, 'cafa-hydrangeas.jpg', 'Flowers', 5, 3),
(29, 'd1bd-desert.jpg', 'Desert', 5, 4),
(30, '7035-jellyfish.jpg', 'Jelly Fish', 5, 1),
(31, '8bbf-hydrangeas.jpg', 'Flowers', 1, 2),
(32, 'f183-jellyfish.jpg', 'Jelly Fish', 1, 1),
(33, '0ff3-desert.jpg', 'Desert', 1, 3),
(34, 'ae00-koala.jpg', 'Koala Bear', 1, 4),
(35, '5ed7-tulips.jpg', 'Flowers', 3, 2),
(36, '894a-lighthouse.jpg', 'The Lighthouse', 3, 1),
(37, 'bb7f-chrysanthemum.jpg', 'Orange Flower', 3, 3),
(38, '8e16-hydrangeas.jpg', 'Flowers in Mikumi National Park Tanzania', 9, 2),
(39, '9dc6-desert.jpg', 'Udzungwa Mountains in Tanzania', 9, 1),
(40, '8eb0-jellyfish.jpg', 'Jellyfish Swimming off Zanzibar', 9, 3),
(41, '0cbb-lighthouse.jpg', 'Tower', 10, 0),
(42, '8bdb-koala.jpg', 'Koala', 10, 0),
(43, 'aa25-penguins-1-.jpg', 'Penguins', 10, 0),
(44, '1f2d-hydrangeas.jpg', '', 11, 0),
(45, '20f6-desert.jpg', '', 11, 0),
(46, '0f7e-desert.jpg', '', 12, 0),
(47, '308d-jellyfish.jpg', '', 12, 0),
(48, '0663-chrysanthemum.jpg', '', 14, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `lakeland_scheduled_trips`
--

INSERT INTO `lakeland_scheduled_trips` (`id`, `start_date`, `end_date`, `trip`) VALUES
(10, '2013-01-26', '2013-01-27', 10);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `lakeland_sections`
--

INSERT INTO `lakeland_sections` (`id`, `name`, `url_string`, `priority`) VALUES
(1, 'Safari Vehicles', 'vehicles', 6),
(2, 'Car Rentals', 'carrentals', 5),
(3, 'Destinations', 'destinations', 4),
(4, 'Group Overland Safaris', 'safaris', 3),
(6, 'Home', 'home', 1),
(7, 'About Us', 'about-lakeland-africa', 2),
(8, 'Contact Us', 'contact-us', 8),
(9, 'Photo Albums', 'photo-albums', 7);

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
(1, '\0\0', 'administrator', '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4', '9462e8eee0', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1358758544, 1, 'Admin', 'istrator', 'ADMIN', '0');

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
