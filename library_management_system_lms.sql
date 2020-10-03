-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 30, 2020 at 09:19 AM
-- Server version: 8.0.18
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_management_system_lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_name` varchar(255) NOT NULL,
  `book_image` varchar(255) NOT NULL,
  `book_author_name` varchar(255) NOT NULL,
  `book_puplication_name` varchar(255) NOT NULL,
  `book_purchase_date` varchar(255) NOT NULL,
  `book_price` int(11) NOT NULL,
  `book_qty` int(11) NOT NULL,
  `available_qty` int(11) NOT NULL,
  `librarian_username` varchar(255) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COMMENT='book table created success';

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `book_name`, `book_image`, `book_author_name`, `book_puplication_name`, `book_purchase_date`, `book_price`, `book_qty`, `available_qty`, `librarian_username`, `date_time`) VALUES
(11, 'php Language', '20200927025356.jpg', 'nitton sir', 'ni book publication', '2020-09-26', 450, 1, 2, 'selim', '2020-09-27 08:53:56'),
(31, 'Python', '20200928073159.jpg', 'Subeen sir', 'Dimik Publication', '2020-09-21', 122, 2, 4, 'selim', '2020-09-28 01:31:59'),
(41, 'Python-2', '20200928073159.jpg', 'Subeen-2', 'Dimik', '2020-09-25', 120, 2, 0, 'selim', '2020-09-28 01:31:59'),
(42, 'Emon Khan', '20200928074213.jpeg', 'emon 2', 'merigacha', '2020-09-14', 128, 2, 10, 'selim', '2020-09-28 13:42:13');

-- --------------------------------------------------------

--
-- Table structure for table `issue_books`
--

DROP TABLE IF EXISTS `issue_books`;
CREATE TABLE IF NOT EXISTS `issue_books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `book_issue_date` varchar(255) NOT NULL,
  `book_return_date` varchar(255) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='issue books table created success';

--
-- Dumping data for table `issue_books`
--

INSERT INTO `issue_books` (`id`, `student_id`, `book_id`, `book_issue_date`, `book_return_date`, `date_time`) VALUES
(1, 3, 11, '28-09-2020 12:09:07 pm', '29-09-2020 11:17:10 am', '2020-09-28 06:09:12'),
(2, 4, 31, '28-09-2020 12:09:18 pm', '29-09-2020 11:17:08 am', '2020-09-28 06:09:32'),
(3, 4, 31, '28-09-2020 06:55:46 pm', '29-09-2020 11:17:06 am', '2020-09-28 12:56:01'),
(4, 3, 31, '28-09-2020 06:56:40 pm', '29-09-2020 07:24:24 am', '2020-09-28 12:56:49'),
(5, 4, 42, '29-09-2020 10:56:09 am', '29-09-2020 11:15:21 am', '2020-09-29 04:56:25'),
(6, 3, 11, '29-09-2020 11:17:34 am', '', '2020-09-29 05:17:40'),
(7, 4, 31, '29-09-2020 11:17:48 am', '', '2020-09-29 05:17:53');

-- --------------------------------------------------------

--
-- Table structure for table `librarian`
--

DROP TABLE IF EXISTS `librarian`;
CREATE TABLE IF NOT EXISTS `librarian` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='librarian table created success';

--
-- Dumping data for table `librarian`
--

INSERT INTO `librarian` (`id`, `firstname`, `lastname`, `email`, `username`, `password`, `image`, `status`, `date_time`) VALUES
(1, 'selim', 'reza', 'selim@gmail.com', 'selim', '12101989', 'lib_image/avatar.jpg', 'admin', '2020-09-24 14:33:34');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `roll` int(11) NOT NULL,
  `reg_no` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='students table created success';

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `fname`, `lname`, `roll`, `reg_no`, `email`, `username`, `password`, `phone`, `image`, `status`, `date_time`) VALUES
(1, 'Selim', 'Swadhin', 123456, 654123, 'selimrezaswadhim@gmail.com', 'rezasa', '$2y$10$ZHdfrTPH1miz5jb3dSlS6ObT8eSxx/7NfSENEcmu2KlCHwm6G7m7C', 1724063642, NULL, 0, '2020-09-23 15:08:56'),
(3, 'hena', 'Swadhin', 123456, 654123, 'selimrezaswadhin@gmail.com', 'zannat', '$2y$10$adUPzcAm1qFkP.S4UJb2L.8HuzGwCyLaXo2P79HzkRkbrblW3z/au', 1724063643, NULL, 1, '2020-09-23 15:28:05'),
(4, 'reza', 'Swadhin', 789456, 987456, 'selimreza@gmail.com', 'helloworld', '$2y$10$wIf0VT2j1wI6ZqLQtD0EL.Qyqz1gHq4QqgnoXA5rS7D0kbFLcoThe', 1472145872, 'upload/avatar.jpg', 1, '2020-09-24 16:34:37'),
(5, 'rezaa', 'Swadhinn', 789457, 987457, 'selimrezaa@gmail.com', 'helloworldd', '$2y$10$wIf0VT2j1wI6ZqLQtD0EL.Qyqz1gHq4QqgnoXA5rS7D0kbFLcoThe', 1472145873, 'upload/avatar.jpg', 1, '2020-09-24 16:34:37'),
(6, 'rezaul', 'Swadhin 2', 789458, 987458, 'selimrezasa@gmail.com', 'helloworlds', '$2y$10$wIf0VT2j1wI6ZqLQtD0EL.Qyqz1gHq4QqgnoXA5rS7D0kbFLcoThe', 1472145874, 'upload/avatar.jpg', 1, '2020-09-24 16:34:37'),
(9, 'rezaul karim', 'Swadhin 3', 789459, 987459, 'selimrezass@gmail.com', 'helloworldss', '$2y$10$wIf0VT2j1wI6ZqLQtD0EL.Qyqz1gHq4QqgnoXA5rS7D0kbFLcoThe', 1472145875, 'upload/avatar.jpg', 1, '2020-09-24 16:34:37');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
