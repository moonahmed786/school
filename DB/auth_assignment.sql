-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2017 at 08:38 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yii2_ats_old`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Sales Agency Manager', '9', 1503902594),
('Sale Agency Manger', '9', 1503913830),
('Sales Rep', '12', 1504175242),
('Sale Rep', '12', 1504175245),
('Sales Rep', '13', 1504685080),
('Sale Rep', '13', 1504685082),
('Sales Rep', '26', 1504698201),
('Sale Rep', '26', 1504698203),
('Sales Rep', '27', 1505197173),
('Sale Rep', '27', 1505197176),
('Sales Rep', '28', 1505197453),
('Sale Rep', '28', 1505197455),
('Sales Rep', '31', 1505414696),
('Sale Rep', '31', 1505414699),
('sdfsdfsdfsdfsd', '30', 1505814816),
('Sale Agency Manger', '30', 1505814819),
('asdasdasfd', '30', 1505814823),
('Sales Rep', '32', 1505821596),
('Sale Rep', '32', 1505821598),
('Sale Rep', '33', 1505823181),
('Sales Rep', '33', 1505823185),
('Manufacturer Admin', '53', 1507206848),
('Enterprise Admin', '1', 1507616147),
('Enterprise Admins', '1', 1507616151),
('All Access', '1', 1507616173),
('Manufacturer Admins', '53', 1507808689),
('Sales Rep', '8', 1507814285),
('Sale Rep', '8', 1507814289);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
