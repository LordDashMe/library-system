-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jan 23, 2019 at 06:55 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dev_library_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `author` text COLLATE utf8_unicode_ci NOT NULL,
  `date_published` text COLLATE utf8_unicode_ci NOT NULL,
  `date_created` text COLLATE utf8_unicode_ci NOT NULL,
  `is_published` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'np = Not Published | p = Published',
  `is_deleted` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'We use date flag for the field is_deleted in order to log when the deletion happened.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `description`, `author`, `date_published`, `date_created`, `is_published`, `is_deleted`) VALUES
('5c47f3f067b4f', 'Clean Code 103', 'Clean...', 'Uncle Bob', '2019-01-23 06:02:35', '2019-01-23 05:56:16', 'np', ''),
('5c47f4e519d1c', 'Clean Code 103', 'Clean...', 'Uncle Bob', '2019-01-23 06:09:15', '2019-01-23 06:00:21', 'p', ''),
('5c47f523f0f3a', 'Clean Code 103', 'Clean...', 'Uncle Bob', '2019-01-23 06:04:21', '2019-01-23 06:01:23', 'np', ''),
('5c47f53dc78f9', 'Clean Code 104', 'Clean Clean...', 'John Doe', '2019-01-23 06:09:07', '2019-01-23 06:01:49', 'p', ''),
('5c47f555501f2', 'Clean Code 103', 'Clean...', 'Uncle Bob', '2019-01-23 06:04:21', '2019-01-23 06:02:13', 'p', ''),
('5c47f757ca181', 'Clean Code 500', '5001', 'Uncle Bob', '2019-01-23 06:16:14', '2019-01-23 06:10:47', 'p', ''),
('5c47f86fd3ecd', 'Clean Code 101 Book', 'New Description', 'Uncle Bob', '2019-01-23 06:15:44', '2019-01-23 06:15:27', 'p', '2019-01-23 06:15:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
