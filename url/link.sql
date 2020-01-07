-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jan 07, 2020 at 04:06 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shortdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `link`
--

CREATE TABLE `link` (
  `id` int(11) NOT NULL,
  `url` tinytext NOT NULL,
  `short_code` varchar(50) NOT NULL,
  `hits` int(11) NOT NULL,
  `added_date` timestamp NULL DEFAULT current_timestamp(),
  `user_ip` text NOT NULL,
  `browser` text NOT NULL,
  `referer` text DEFAULT NULL,
  `lastused` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `link`
--

INSERT INTO `link` (`id`, `url`, `short_code`, `hits`, `added_date`, `user_ip`, `browser`, `referer`, `lastused`) VALUES
(1, 'https://www.westmeathindependent.ie/', '4f3084', 2, '2020-01-07 02:48:41', '::1', 'Chrome', 'localhost:4006', '2020-01-07 02:48:57'),
(2, 'https://timetable.ait.ie/login.aspx?ReturnUrl=/default.aspx', '36a88f', 2, '2020-01-07 02:50:03', '::1', 'Chrome', 'localhost:4006', '2020-01-07 02:51:13'),
(3, 'https://www.imdb.com/movies-coming-soon/', '5ca43a', 1, '2020-01-07 02:50:36', '::1', 'Chrome', 'localhost:4006', '2020-01-07 02:50:42'),
(4, 'https://www.enterprise.ie/en/car-hire/locations/ireland.html', 'f64fa7', 1, '2020-01-07 02:53:36', '::1', 'Chrome', 'localhost:4006', '2020-01-07 02:53:39'),
(5, 'https://www.revenue.ie/en/personal-tax-credits-reliefs-and-exemptions/index.aspx', 'bc985b', 1, '2020-01-07 02:54:45', '::1', 'Chrome', 'localhost:4006', '2020-01-07 02:54:49'),
(6, 'https://www.irishtimes.com/life-and-style', '73bc18', 1, '2020-01-07 02:55:37', '::1', 'Chrome', 'localhost:4006', '2020-01-07 02:55:42'),
(7, 'https://www.hpshop.ie/printers-scanners/hp-multifunction-printers.html', '53187d', 1, '2020-01-07 02:57:00', '::1', 'Chrome', 'localhost:4006', '2020-01-07 02:57:07'),
(8, 'http://www.slimframework.com/docs/v4/start/installation.html', '56f854', 1, '2020-01-07 02:58:59', '::1', 'Chrome', 'localhost:4006', '2020-01-07 02:59:08'),
(9, 'https://www.php.net/archive/2019.php#2019-12-18-3', '429abd', 1, '2020-01-07 03:00:10', '::1', 'Chrome', 'localhost:4006', '2020-01-07 03:00:37'),
(10, 'https://api.jquery.com/category/forms/', '59ed71', 1, '2020-01-07 03:01:21', '::1', 'Chrome', 'localhost:4006', '2020-01-07 03:01:25'),
(12, 'https://www.jetbrains.com/phpstorm/social/', '774519', 1, '2020-01-07 03:03:38', '::1', 'Chrome', 'localhost:4006', '2020-01-07 03:03:41'),
(13, 'http://www.drjava.org/docs/user/ch10.html', '3ca282', 1, '2020-01-07 03:05:01', '::1', 'Chrome', 'localhost:4006', '2020-01-07 03:05:04'),
(14, 'https://www.apm.org.uk/resources/find-a-resource/agile-project-management/', '09ae10', 1, '2020-01-07 03:05:42', '::1', 'Chrome', 'localhost:4006', '2020-01-07 03:05:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `link`
--
ALTER TABLE `link`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `link`
--
ALTER TABLE `link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
