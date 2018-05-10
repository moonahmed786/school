-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2017 at 08:39 AM
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
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('All Access', '/*'),
('Manufacturer Admins', '/cities/*'),
('Manufacturer Admins', '/companies/*'),
('Manufacturer Admins', '/countries/*'),
('Manufacturer Admins', '/drainproducts/*'),
('Manufacturer Admins', '/drains/*'),
('Manufacturer Admins', '/features/*'),
('Manufacturer Admins', '/flowratedata/*'),
('Manufacturer Admins', '/graterules/*'),
('Manufacturer Admins', '/jobs/*'),
('Manufacturer Admins', '/notifications/*'),
('Manufacturer Admins', '/parts/*'),
('Manufacturer Admins', '/quotations/*'),
('Manufacturer Admins', '/settings/*'),
('Manufacturer Admins', '/user/*'),
('Manufacturer Admins', '/states/*'),
('Manufacturer Admins', '/statuses/*'),
('Manufacturer Admins', '/timezones/*'),
('Manufacturer Admins', '/users-companies/*'),
('Manufacturer Admin', 'Manufacturer Admins'),
('Sale Agency Manger', '/jobs/*'),
('Sales Rep', '/jobs/*'),
('Sales Agency Manager', '/jobs/*'),
('Sales Agency Manager', '/user/update'),
('Sales Agency Manager', 'Sale Agency Manger'),
('Sales Agency Manager', '/companies/*'),
('Sales Agency Manager', '/jobs/index'),
('Sales Agency Manager', '/jobs/create'),
('Sales Rep', '/jobs/create'),
('Sales Rep', '/jobs/delete'),
('Sales Rep', '/jobs/index'),
('Sales Rep', '/jobs/sub-cities'),
('Sales Rep', '/jobs/sub-states'),
('Sales Rep', '/jobs/update'),
('Sales Rep', '/jobs/view'),
('Sales Rep', 'Sale Rep'),
('Sales Agency Manager', '/jobs/delete'),
('Sales Agency Manager', '/jobs/sub-cities'),
('Sales Agency Manager', '/jobs/sub-states'),
('Sales Agency Manager', '/jobs/update'),
('Sales Agency Manager', '/jobs/view'),
('Sale Agency Manger', '/quotations/*'),
('Sale Agency Manger', '/user/*'),
('Sale Agency Manger', '/quotations/submitapproval'),
('Sale Agency Manger', '/notifications/list'),
('Sale Rep', '/jobs/*'),
('Sale Rep', '/jobs/create'),
('Sale Rep', '/jobs/delete'),
('Sale Rep', '/jobs/index'),
('Sale Rep', '/jobs/sub-cities'),
('Sale Rep', '/jobs/sub-states'),
('Sale Rep', '/jobs/update'),
('Sale Rep', '/jobs/view'),
('Sale Rep', '/quotations/*'),
('Sale Rep', '/quotations/approve'),
('Sale Rep', '/quotations/create'),
('Sale Rep', '/quotations/delete'),
('Sale Rep', '/quotations/generatepdf'),
('Sale Rep', '/quotations/get-catch-basin-size'),
('Sale Rep', '/quotations/get-grate-material'),
('Sale Rep', '/quotations/get-load-rating'),
('Sale Rep', '/quotations/index'),
('Sale Rep', '/quotations/submitapproval'),
('Sale Rep', '/quotations/update'),
('Sale Rep', '/quotations/view'),
('Sale Rep', '/site/request-password-reset'),
('Sale Rep', '/user/request-password-reset'),
('Sale Rep', '/notifications/list'),
('All Access', '/admin/*'),
('All Access', '/admin/assignment/*'),
('All Access', '/admin/assignment/assign'),
('All Access', '/admin/assignment/index'),
('All Access', '/admin/assignment/revoke'),
('All Access', '/admin/assignment/view'),
('All Access', '/admin/default/*'),
('All Access', '/admin/default/index'),
('All Access', '/admin/menu/*'),
('All Access', '/admin/menu/create'),
('All Access', '/admin/menu/delete'),
('All Access', '/admin/menu/index'),
('All Access', '/admin/menu/update'),
('All Access', '/admin/menu/view'),
('All Access', '/admin/permission/*'),
('All Access', '/admin/permission/assign'),
('All Access', '/admin/permission/create'),
('All Access', '/admin/permission/delete'),
('All Access', '/admin/permission/index'),
('All Access', '/admin/permission/remove'),
('All Access', '/admin/permission/update'),
('All Access', '/admin/permission/view'),
('All Access', '/admin/role/*'),
('All Access', '/admin/role/assign'),
('All Access', '/admin/role/create'),
('All Access', '/admin/role/delete'),
('All Access', '/admin/role/index'),
('All Access', '/admin/role/remove'),
('All Access', '/admin/role/update'),
('All Access', '/admin/role/view'),
('All Access', '/admin/route/*'),
('All Access', '/admin/route/assign'),
('All Access', '/admin/route/create'),
('All Access', '/admin/route/index'),
('All Access', '/admin/route/refresh'),
('All Access', '/admin/route/remove'),
('All Access', '/admin/rule/*'),
('All Access', '/admin/rule/create'),
('All Access', '/admin/rule/delete'),
('All Access', '/admin/rule/index'),
('All Access', '/admin/rule/update'),
('All Access', '/admin/rule/view'),
('All Access', '/admin/user/*'),
('All Access', '/admin/user/activate'),
('All Access', '/admin/user/change-password'),
('All Access', '/admin/user/delete'),
('All Access', '/admin/user/index'),
('All Access', '/admin/user/login'),
('All Access', '/admin/user/logout'),
('All Access', '/admin/user/request-password-reset'),
('All Access', '/admin/user/reset-password'),
('All Access', '/admin/user/signup'),
('All Access', '/admin/user/view'),
('All Access', '/cities/*'),
('All Access', '/cities/create'),
('All Access', '/cities/delete'),
('All Access', '/cities/index'),
('All Access', '/cities/update'),
('All Access', '/cities/view'),
('All Access', '/companies/*'),
('All Access', '/companies/create'),
('All Access', '/companies/delete'),
('All Access', '/companies/index'),
('All Access', '/companies/update'),
('All Access', '/companies/view'),
('All Access', '/components/*'),
('All Access', '/components/create'),
('All Access', '/components/delete'),
('All Access', '/components/index'),
('All Access', '/components/update'),
('All Access', '/components/view'),
('All Access', '/countries/*'),
('All Access', '/countries/create'),
('All Access', '/countries/delete'),
('All Access', '/countries/index'),
('All Access', '/countries/update'),
('All Access', '/countries/view'),
('All Access', '/debug/*'),
('All Access', '/debug/default/*'),
('All Access', '/debug/default/db-explain'),
('All Access', '/debug/default/download-mail'),
('All Access', '/debug/default/index'),
('All Access', '/debug/default/toolbar'),
('All Access', '/debug/default/view'),
('All Access', '/debug/user/*'),
('All Access', '/debug/user/reset-identity'),
('All Access', '/debug/user/set-identity'),
('All Access', '/drainproducts/*'),
('All Access', '/drainproducts/create'),
('All Access', '/drainproducts/delete'),
('All Access', '/drainproducts/index'),
('All Access', '/drainproducts/update'),
('All Access', '/drainproducts/view'),
('All Access', '/drains/*'),
('All Access', '/drains/create'),
('All Access', '/drains/delete'),
('All Access', '/drains/index'),
('All Access', '/drains/update'),
('All Access', '/drains/view'),
('All Access', '/features-all/*'),
('All Access', '/features-all/create'),
('All Access', '/features-all/delete'),
('All Access', '/features-all/index'),
('All Access', '/features-all/update'),
('All Access', '/features-all/view'),
('All Access', '/features/*'),
('All Access', '/features/create'),
('All Access', '/features/delete'),
('All Access', '/features/index'),
('All Access', '/features/update'),
('All Access', '/features/view'),
('All Access', '/featuretypes/*'),
('All Access', '/featuretypes/create'),
('All Access', '/featuretypes/delete'),
('All Access', '/featuretypes/index'),
('All Access', '/featuretypes/update'),
('All Access', '/featuretypes/view'),
('All Access', '/flowratedata/*'),
('All Access', '/flowratedata/create'),
('All Access', '/flowratedata/delete'),
('All Access', '/flowratedata/index'),
('All Access', '/flowratedata/update'),
('All Access', '/flowratedata/view'),
('All Access', '/gii/*'),
('All Access', '/gii/default/*'),
('All Access', '/gii/default/action'),
('All Access', '/gii/default/diff'),
('All Access', '/gii/default/index'),
('All Access', '/gii/default/preview'),
('All Access', '/gii/default/view'),
('All Access', '/graterules/*'),
('All Access', '/graterules/create'),
('All Access', '/graterules/delete'),
('All Access', '/graterules/index'),
('All Access', '/graterules/update'),
('All Access', '/graterules/view'),
('All Access', '/jobs/*'),
('All Access', '/jobs/create'),
('All Access', '/jobs/delete'),
('All Access', '/jobs/index'),
('All Access', '/jobs/sub-cities'),
('All Access', '/jobs/sub-states'),
('All Access', '/jobs/update'),
('All Access', '/jobs/view'),
('All Access', '/languages/*'),
('All Access', '/languages/create'),
('All Access', '/languages/delete'),
('All Access', '/languages/index'),
('All Access', '/languages/update'),
('All Access', '/languages/view'),
('All Access', '/lengths/*'),
('All Access', '/lengths/create'),
('All Access', '/lengths/delete'),
('All Access', '/lengths/index'),
('All Access', '/lengths/update'),
('All Access', '/lengths/view'),
('All Access', '/notifications/*'),
('All Access', '/notifications/create'),
('All Access', '/notifications/delete'),
('All Access', '/notifications/index'),
('All Access', '/notifications/list'),
('All Access', '/notifications/update'),
('All Access', '/notifications/view'),
('All Access', '/parts/*'),
('All Access', '/parts/create'),
('All Access', '/parts/delete'),
('All Access', '/parts/index'),
('All Access', '/parts/update'),
('All Access', '/parts/view'),
('All Access', '/postalcodes/*'),
('All Access', '/postalcodes/create'),
('All Access', '/postalcodes/delete'),
('All Access', '/postalcodes/index'),
('All Access', '/postalcodes/update'),
('All Access', '/postalcodes/view'),
('All Access', '/quotations/*'),
('All Access', '/quotations/approve'),
('All Access', '/quotations/create'),
('All Access', '/quotations/delete'),
('All Access', '/quotations/generatepdf'),
('All Access', '/quotations/get-catch-basin-size'),
('All Access', '/quotations/get-grate-material'),
('All Access', '/quotations/get-load-rating'),
('All Access', '/quotations/index'),
('All Access', '/quotations/submitapproval'),
('All Access', '/quotations/update'),
('All Access', '/quotations/view'),
('All Access', '/series/*'),
('All Access', '/series/create'),
('All Access', '/series/delete'),
('All Access', '/series/index'),
('All Access', '/series/update'),
('All Access', '/series/view'),
('All Access', '/settings/*'),
('All Access', '/settings/create'),
('All Access', '/settings/delete'),
('All Access', '/settings/index'),
('All Access', '/settings/update'),
('All Access', '/settings/view'),
('All Access', '/site/*'),
('All Access', '/site/about'),
('All Access', '/site/captcha'),
('All Access', '/site/contact'),
('All Access', '/site/error'),
('All Access', '/site/index'),
('All Access', '/site/login'),
('All Access', '/site/logout'),
('All Access', '/site/request-password-reset'),
('All Access', '/site/reset-password'),
('All Access', '/states/*'),
('All Access', '/states/create'),
('All Access', '/states/delete'),
('All Access', '/states/index'),
('All Access', '/states/update'),
('All Access', '/states/view'),
('All Access', '/statuses/*'),
('All Access', '/statuses/create'),
('All Access', '/statuses/delete'),
('All Access', '/statuses/index'),
('All Access', '/statuses/update'),
('All Access', '/statuses/view'),
('All Access', '/timezones/*'),
('All Access', '/timezones/create'),
('All Access', '/timezones/delete'),
('All Access', '/timezones/index'),
('All Access', '/timezones/update'),
('All Access', '/timezones/view'),
('All Access', '/user/*'),
('All Access', '/user/changecountry'),
('All Access', '/user/create'),
('All Access', '/user/delete'),
('All Access', '/user/index'),
('All Access', '/user/password'),
('All Access', '/user/request-password-reset'),
('All Access', '/user/resetcountry'),
('All Access', '/user/update'),
('All Access', '/user/view'),
('All Access', '/users-companies/*'),
('All Access', '/users-companies/create'),
('All Access', '/users-companies/delete'),
('All Access', '/users-companies/index'),
('All Access', '/users-companies/update'),
('All Access', '/users-companies/view'),
('All Access', 'Enterprise Admin'),
('All Access', 'Manufacturer Admin'),
('All Access', 'Manufacturer Admins'),
('sdfsdfsd', 'Manufacturer Admin'),
('sdfsdfsd', 'Sale Agency Manger'),
('sdfsdfsd', '/admin/assignment/revoke'),
('adasdasd', '/admin/permission/view'),
('Enterprise Admins', '/*');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
