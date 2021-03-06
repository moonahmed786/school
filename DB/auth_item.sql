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
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/*', 2, NULL, NULL, NULL, 1496145349, 1496145349),
('/admin/*', 2, NULL, NULL, NULL, 1505413939, 1505413939),
('/admin/assignment/*', 2, NULL, NULL, NULL, 1505413937, 1505413937),
('/admin/assignment/assign', 2, NULL, NULL, NULL, 1505413937, 1505413937),
('/admin/assignment/index', 2, NULL, NULL, NULL, 1505413937, 1505413937),
('/admin/assignment/revoke', 2, NULL, NULL, NULL, 1505413937, 1505413937),
('/admin/assignment/view', 2, NULL, NULL, NULL, 1505413937, 1505413937),
('/admin/default/*', 2, NULL, NULL, NULL, 1505413937, 1505413937),
('/admin/default/index', 2, NULL, NULL, NULL, 1505413937, 1505413937),
('/admin/menu/*', 2, NULL, NULL, NULL, 1505413938, 1505413938),
('/admin/menu/create', 2, NULL, NULL, NULL, 1505413937, 1505413937),
('/admin/menu/delete', 2, NULL, NULL, NULL, 1505413937, 1505413937),
('/admin/menu/index', 2, NULL, NULL, NULL, 1505413937, 1505413937),
('/admin/menu/update', 2, NULL, NULL, NULL, 1505413937, 1505413937),
('/admin/menu/view', 2, NULL, NULL, NULL, 1505413937, 1505413937),
('/admin/permission/*', 2, NULL, NULL, NULL, 1505413938, 1505413938),
('/admin/permission/assign', 2, NULL, NULL, NULL, 1505413938, 1505413938),
('/admin/permission/create', 2, NULL, NULL, NULL, 1505413938, 1505413938),
('/admin/permission/delete', 2, NULL, NULL, NULL, 1505413938, 1505413938),
('/admin/permission/index', 2, NULL, NULL, NULL, 1505413938, 1505413938),
('/admin/permission/remove', 2, NULL, NULL, NULL, 1505413938, 1505413938),
('/admin/permission/update', 2, NULL, NULL, NULL, 1505413938, 1505413938),
('/admin/permission/view', 2, NULL, NULL, NULL, 1505413938, 1505413938),
('/admin/role/*', 2, NULL, NULL, NULL, 1505413938, 1505413938),
('/admin/role/assign', 2, NULL, NULL, NULL, 1505413938, 1505413938),
('/admin/role/create', 2, NULL, NULL, NULL, 1505413938, 1505413938),
('/admin/role/delete', 2, NULL, NULL, NULL, 1505413938, 1505413938),
('/admin/role/index', 2, NULL, NULL, NULL, 1505413938, 1505413938),
('/admin/role/remove', 2, NULL, NULL, NULL, 1505413938, 1505413938),
('/admin/role/update', 2, NULL, NULL, NULL, 1505413938, 1505413938),
('/admin/role/view', 2, NULL, NULL, NULL, 1505413938, 1505413938),
('/admin/route/*', 2, NULL, NULL, NULL, 1505413938, 1505413938),
('/admin/route/assign', 2, NULL, NULL, NULL, 1505413938, 1505413938),
('/admin/route/create', 2, NULL, NULL, NULL, 1505413938, 1505413938),
('/admin/route/index', 2, NULL, NULL, NULL, 1505413938, 1505413938),
('/admin/route/refresh', 2, NULL, NULL, NULL, 1505413938, 1505413938),
('/admin/route/remove', 2, NULL, NULL, NULL, 1505413938, 1505413938),
('/admin/rule/*', 2, NULL, NULL, NULL, 1505413938, 1505413938),
('/admin/rule/create', 2, NULL, NULL, NULL, 1505413938, 1505413938),
('/admin/rule/delete', 2, NULL, NULL, NULL, 1505413938, 1505413938),
('/admin/rule/index', 2, NULL, NULL, NULL, 1505413938, 1505413938),
('/admin/rule/update', 2, NULL, NULL, NULL, 1505413938, 1505413938),
('/admin/rule/view', 2, NULL, NULL, NULL, 1505413938, 1505413938),
('/admin/user/*', 2, NULL, NULL, NULL, 1505413939, 1505413939),
('/admin/user/activate', 2, NULL, NULL, NULL, 1505413939, 1505413939),
('/admin/user/change-password', 2, NULL, NULL, NULL, 1505413939, 1505413939),
('/admin/user/delete', 2, NULL, NULL, NULL, 1505413939, 1505413939),
('/admin/user/index', 2, NULL, NULL, NULL, 1505413939, 1505413939),
('/admin/user/login', 2, NULL, NULL, NULL, 1505413939, 1505413939),
('/admin/user/logout', 2, NULL, NULL, NULL, 1505413939, 1505413939),
('/admin/user/request-password-reset', 2, NULL, NULL, NULL, 1505413939, 1505413939),
('/admin/user/reset-password', 2, NULL, NULL, NULL, 1505413939, 1505413939),
('/admin/user/signup', 2, NULL, NULL, NULL, 1505413939, 1505413939),
('/admin/user/view', 2, NULL, NULL, NULL, 1505413939, 1505413939),
('/assignment/*', 2, NULL, NULL, NULL, 1507801052, 1507801052),
('/assignment/assign', 2, NULL, NULL, NULL, 1507801052, 1507801052),
('/assignment/index', 2, NULL, NULL, NULL, 1507801052, 1507801052),
('/assignment/revoke', 2, NULL, NULL, NULL, 1507801052, 1507801052),
('/assignment/view', 2, NULL, NULL, NULL, 1507801052, 1507801052),
('/cities/*', 2, NULL, NULL, NULL, 1496213912, 1496213912),
('/cities/create', 2, NULL, NULL, NULL, 1496213912, 1496213912),
('/cities/delete', 2, NULL, NULL, NULL, 1496213912, 1496213912),
('/cities/index', 2, NULL, NULL, NULL, 1496213911, 1496213911),
('/cities/update', 2, NULL, NULL, NULL, 1496213912, 1496213912),
('/cities/view', 2, NULL, NULL, NULL, 1496213912, 1496213912),
('/companies/*', 2, NULL, NULL, NULL, 1496213912, 1496213912),
('/companies/create', 2, NULL, NULL, NULL, 1496213912, 1496213912),
('/companies/delete', 2, NULL, NULL, NULL, 1496213912, 1496213912),
('/companies/index', 2, NULL, NULL, NULL, 1496213912, 1496213912),
('/companies/update', 2, NULL, NULL, NULL, 1496213912, 1496213912),
('/companies/view', 2, NULL, NULL, NULL, 1496213912, 1496213912),
('/components/*', 2, NULL, NULL, NULL, 1496213913, 1496213913),
('/components/create', 2, NULL, NULL, NULL, 1496213913, 1496213913),
('/components/delete', 2, NULL, NULL, NULL, 1496213913, 1496213913),
('/components/index', 2, NULL, NULL, NULL, 1496213912, 1496213912),
('/components/update', 2, NULL, NULL, NULL, 1496213913, 1496213913),
('/components/view', 2, NULL, NULL, NULL, 1496213913, 1496213913),
('/countries/*', 2, NULL, NULL, NULL, 1496213913, 1496213913),
('/countries/create', 2, NULL, NULL, NULL, 1496213913, 1496213913),
('/countries/delete', 2, NULL, NULL, NULL, 1496213913, 1496213913),
('/countries/index', 2, NULL, NULL, NULL, 1496213913, 1496213913),
('/countries/update', 2, NULL, NULL, NULL, 1496213913, 1496213913),
('/countries/view', 2, NULL, NULL, NULL, 1496213913, 1496213913),
('/debug/*', 2, NULL, NULL, NULL, 1505413939, 1505413939),
('/debug/default/*', 2, NULL, NULL, NULL, 1505413939, 1505413939),
('/debug/default/db-explain', 2, NULL, NULL, NULL, 1505413939, 1505413939),
('/debug/default/download-mail', 2, NULL, NULL, NULL, 1505413939, 1505413939),
('/debug/default/index', 2, NULL, NULL, NULL, 1505413939, 1505413939),
('/debug/default/toolbar', 2, NULL, NULL, NULL, 1505413939, 1505413939),
('/debug/default/view', 2, NULL, NULL, NULL, 1505413939, 1505413939),
('/debug/user/*', 2, NULL, NULL, NULL, 1505413939, 1505413939),
('/debug/user/reset-identity', 2, NULL, NULL, NULL, 1505413939, 1505413939),
('/debug/user/set-identity', 2, NULL, NULL, NULL, 1505413939, 1505413939),
('/drainproducts/*', 2, NULL, NULL, NULL, 1496213914, 1496213914),
('/drainproducts/create', 2, NULL, NULL, NULL, 1496213913, 1496213913),
('/drainproducts/delete', 2, NULL, NULL, NULL, 1496213914, 1496213914),
('/drainproducts/index', 2, NULL, NULL, NULL, 1496213913, 1496213913),
('/drainproducts/update', 2, NULL, NULL, NULL, 1496213913, 1496213913),
('/drainproducts/view', 2, NULL, NULL, NULL, 1496213913, 1496213913),
('/drains/*', 2, NULL, NULL, NULL, 1496213914, 1496213914),
('/drains/create', 2, NULL, NULL, NULL, 1496213914, 1496213914),
('/drains/delete', 2, NULL, NULL, NULL, 1496213914, 1496213914),
('/drains/index', 2, NULL, NULL, NULL, 1496213914, 1496213914),
('/drains/update', 2, NULL, NULL, NULL, 1496213914, 1496213914),
('/drains/view', 2, NULL, NULL, NULL, 1496213914, 1496213914),
('/features-all/*', 2, NULL, NULL, NULL, 1505413940, 1505413940),
('/features-all/create', 2, NULL, NULL, NULL, 1505413939, 1505413939),
('/features-all/delete', 2, NULL, NULL, NULL, 1505413940, 1505413940),
('/features-all/index', 2, NULL, NULL, NULL, 1505413939, 1505413939),
('/features-all/update', 2, NULL, NULL, NULL, 1505413940, 1505413940),
('/features-all/view', 2, NULL, NULL, NULL, 1505413939, 1505413939),
('/features/*', 2, NULL, NULL, NULL, 1496213915, 1496213915),
('/features/create', 2, NULL, NULL, NULL, 1496213914, 1496213914),
('/features/delete', 2, NULL, NULL, NULL, 1496213915, 1496213915),
('/features/index', 2, NULL, NULL, NULL, 1496213914, 1496213914),
('/features/update', 2, NULL, NULL, NULL, 1496213914, 1496213914),
('/features/view', 2, NULL, NULL, NULL, 1496213914, 1496213914),
('/featuretypes/*', 2, NULL, NULL, NULL, 1496213915, 1496213915),
('/featuretypes/create', 2, NULL, NULL, NULL, 1496213915, 1496213915),
('/featuretypes/delete', 2, NULL, NULL, NULL, 1496213915, 1496213915),
('/featuretypes/index', 2, NULL, NULL, NULL, 1496213915, 1496213915),
('/featuretypes/update', 2, NULL, NULL, NULL, 1496213915, 1496213915),
('/featuretypes/view', 2, NULL, NULL, NULL, 1496213915, 1496213915),
('/flowratedata/*', 2, NULL, NULL, NULL, 1496213915, 1496213915),
('/flowratedata/create', 2, NULL, NULL, NULL, 1496213915, 1496213915),
('/flowratedata/delete', 2, NULL, NULL, NULL, 1496213915, 1496213915),
('/flowratedata/index', 2, NULL, NULL, NULL, 1496213915, 1496213915),
('/flowratedata/update', 2, NULL, NULL, NULL, 1496213915, 1496213915),
('/flowratedata/view', 2, NULL, NULL, NULL, 1496213915, 1496213915),
('/gii/*', 2, NULL, NULL, NULL, 1505413939, 1505413939),
('/gii/default/*', 2, NULL, NULL, NULL, 1505413939, 1505413939),
('/gii/default/action', 2, NULL, NULL, NULL, 1505413939, 1505413939),
('/gii/default/diff', 2, NULL, NULL, NULL, 1505413939, 1505413939),
('/gii/default/index', 2, NULL, NULL, NULL, 1505413939, 1505413939),
('/gii/default/preview', 2, NULL, NULL, NULL, 1505413939, 1505413939),
('/gii/default/view', 2, NULL, NULL, NULL, 1505413939, 1505413939),
('/graterules/*', 2, NULL, NULL, NULL, 1496213916, 1496213916),
('/graterules/create', 2, NULL, NULL, NULL, 1496213916, 1496213916),
('/graterules/delete', 2, NULL, NULL, NULL, 1496213916, 1496213916),
('/graterules/index', 2, NULL, NULL, NULL, 1496213916, 1496213916),
('/graterules/update', 2, NULL, NULL, NULL, 1496213916, 1496213916),
('/graterules/view', 2, NULL, NULL, NULL, 1496213916, 1496213916),
('/item/*', 2, NULL, NULL, NULL, 1508135241, 1508135241),
('/item/assign', 2, NULL, NULL, NULL, 1508135241, 1508135241),
('/item/create', 2, NULL, NULL, NULL, 1508135241, 1508135241),
('/item/delete', 2, NULL, NULL, NULL, 1508135241, 1508135241),
('/item/index', 2, NULL, NULL, NULL, 1508135241, 1508135241),
('/item/remove', 2, NULL, NULL, NULL, 1508135241, 1508135241),
('/item/update', 2, NULL, NULL, NULL, 1508135241, 1508135241),
('/item/view', 2, NULL, NULL, NULL, 1508135241, 1508135241),
('/jobs/*', 2, NULL, NULL, NULL, 1496213916, 1496213916),
('/jobs/approve-quote', 2, NULL, NULL, NULL, 1507723158, 1507723158),
('/jobs/create', 2, NULL, NULL, NULL, 1496213916, 1496213916),
('/jobs/delete', 2, NULL, NULL, NULL, 1496213916, 1496213916),
('/jobs/index', 2, NULL, NULL, NULL, 1496213916, 1496213916),
('/jobs/sub-cities', 2, NULL, NULL, NULL, 1496213916, 1496213916),
('/jobs/sub-states', 2, NULL, NULL, NULL, 1496213916, 1496213916),
('/jobs/update', 2, NULL, NULL, NULL, 1496213916, 1496213916),
('/jobs/update-label', 2, NULL, NULL, NULL, 1507723158, 1507723158),
('/jobs/view', 2, NULL, NULL, NULL, 1496213916, 1496213916),
('/languages/*', 2, NULL, NULL, NULL, 1504674000, 1504674000),
('/languages/create', 2, NULL, NULL, NULL, 1504674000, 1504674000),
('/languages/delete', 2, NULL, NULL, NULL, 1504674000, 1504674000),
('/languages/index', 2, NULL, NULL, NULL, 1504674000, 1504674000),
('/languages/update', 2, NULL, NULL, NULL, 1504674000, 1504674000),
('/languages/view', 2, NULL, NULL, NULL, 1504674000, 1504674000),
('/lengths/*', 2, NULL, NULL, NULL, 1496213917, 1496213917),
('/lengths/create', 2, NULL, NULL, NULL, 1496213917, 1496213917),
('/lengths/delete', 2, NULL, NULL, NULL, 1496213917, 1496213917),
('/lengths/index', 2, NULL, NULL, NULL, 1496213917, 1496213917),
('/lengths/update', 2, NULL, NULL, NULL, 1496213917, 1496213917),
('/lengths/view', 2, NULL, NULL, NULL, 1496213917, 1496213917),
('/notifications/*', 2, NULL, NULL, NULL, 1496213917, 1496213917),
('/notifications/create', 2, NULL, NULL, NULL, 1496213917, 1496213917),
('/notifications/delete', 2, NULL, NULL, NULL, 1496213917, 1496213917),
('/notifications/index', 2, NULL, NULL, NULL, 1496213917, 1496213917),
('/notifications/list', 2, NULL, NULL, NULL, 1504674000, 1504674000),
('/notifications/update', 2, NULL, NULL, NULL, 1496213917, 1496213917),
('/notifications/view', 2, NULL, NULL, NULL, 1496213917, 1496213917),
('/parts/*', 2, NULL, NULL, NULL, 1496213918, 1496213918),
('/parts/create', 2, NULL, NULL, NULL, 1496213917, 1496213917),
('/parts/delete', 2, NULL, NULL, NULL, 1496213918, 1496213918),
('/parts/index', 2, NULL, NULL, NULL, 1496213917, 1496213917),
('/parts/update', 2, NULL, NULL, NULL, 1496213918, 1496213918),
('/parts/view', 2, NULL, NULL, NULL, 1496213917, 1496213917),
('/permission/*', 2, NULL, NULL, NULL, 1508135242, 1508135242),
('/permission/assign', 2, NULL, NULL, NULL, 1508135242, 1508135242),
('/permission/create', 2, NULL, NULL, NULL, 1508135242, 1508135242),
('/permission/delete', 2, NULL, NULL, NULL, 1508135242, 1508135242),
('/permission/index', 2, NULL, NULL, NULL, 1508135242, 1508135242),
('/permission/remove', 2, NULL, NULL, NULL, 1508135242, 1508135242),
('/permission/update', 2, NULL, NULL, NULL, 1508135242, 1508135242),
('/permission/view', 2, NULL, NULL, NULL, 1508135242, 1508135242),
('/postalcodes/*', 2, NULL, NULL, NULL, 1504674000, 1504674000),
('/postalcodes/create', 2, NULL, NULL, NULL, 1504674000, 1504674000),
('/postalcodes/delete', 2, NULL, NULL, NULL, 1504674000, 1504674000),
('/postalcodes/index', 2, NULL, NULL, NULL, 1504674000, 1504674000),
('/postalcodes/update', 2, NULL, NULL, NULL, 1504674000, 1504674000),
('/postalcodes/view', 2, NULL, NULL, NULL, 1504674000, 1504674000),
('/quotations/*', 2, NULL, NULL, NULL, 1496213918, 1496213918),
('/quotations/approve', 2, NULL, NULL, NULL, 1505213551, 1505213551),
('/quotations/create', 2, NULL, NULL, NULL, 1496213918, 1496213918),
('/quotations/delete', 2, NULL, NULL, NULL, 1496213918, 1496213918),
('/quotations/generatepdf', 2, NULL, NULL, NULL, 1505213551, 1505213551),
('/quotations/get-catch-basin-size', 2, NULL, NULL, NULL, 1505213551, 1505213551),
('/quotations/get-grate-material', 2, NULL, NULL, NULL, 1505213551, 1505213551),
('/quotations/get-load-rating', 2, NULL, NULL, NULL, 1505213551, 1505213551),
('/quotations/index', 2, NULL, NULL, NULL, 1496213918, 1496213918),
('/quotations/submitapproval', 2, NULL, NULL, NULL, 1505213532, 1505213532),
('/quotations/update', 2, NULL, NULL, NULL, 1496213918, 1496213918),
('/quotations/view', 2, NULL, NULL, NULL, 1496213918, 1496213918),
('/role/*', 2, NULL, NULL, NULL, 1508135242, 1508135242),
('/role/assign', 2, NULL, NULL, NULL, 1508135242, 1508135242),
('/role/create', 2, NULL, NULL, NULL, 1508135242, 1508135242),
('/role/delete', 2, NULL, NULL, NULL, 1508135242, 1508135242),
('/role/index', 2, NULL, NULL, NULL, 1508135242, 1508135242),
('/role/remove', 2, NULL, NULL, NULL, 1508135242, 1508135242),
('/role/update', 2, NULL, NULL, NULL, 1508135242, 1508135242),
('/role/view', 2, NULL, NULL, NULL, 1508135242, 1508135242),
('/series/*', 2, NULL, NULL, NULL, 1496213918, 1496213918),
('/series/create', 2, NULL, NULL, NULL, 1496213918, 1496213918),
('/series/delete', 2, NULL, NULL, NULL, 1496213918, 1496213918),
('/series/index', 2, NULL, NULL, NULL, 1496213918, 1496213918),
('/series/update', 2, NULL, NULL, NULL, 1496213918, 1496213918),
('/series/view', 2, NULL, NULL, NULL, 1496213918, 1496213918),
('/settings/*', 2, NULL, NULL, NULL, 1496213919, 1496213919),
('/settings/create', 2, NULL, NULL, NULL, 1496213919, 1496213919),
('/settings/delete', 2, NULL, NULL, NULL, 1496213919, 1496213919),
('/settings/index', 2, NULL, NULL, NULL, 1496213918, 1496213918),
('/settings/update', 2, NULL, NULL, NULL, 1496213919, 1496213919),
('/settings/view', 2, NULL, NULL, NULL, 1496213919, 1496213919),
('/site/*', 2, NULL, NULL, NULL, 1505413940, 1505413940),
('/site/about', 2, NULL, NULL, NULL, 1505413940, 1505413940),
('/site/captcha', 2, NULL, NULL, NULL, 1505413940, 1505413940),
('/site/contact', 2, NULL, NULL, NULL, 1505413940, 1505413940),
('/site/error', 2, NULL, NULL, NULL, 1505413940, 1505413940),
('/site/forget-password', 2, NULL, NULL, NULL, 1507723158, 1507723158),
('/site/index', 2, NULL, NULL, NULL, 1505413940, 1505413940),
('/site/login', 2, NULL, NULL, NULL, 1505413940, 1505413940),
('/site/logout', 2, NULL, NULL, NULL, 1505413940, 1505413940),
('/site/request-password-reset', 2, NULL, NULL, NULL, 1504084465, 1504084465),
('/site/reset-password', 2, NULL, NULL, NULL, 1504084471, 1504084471),
('/site/set-password', 2, NULL, NULL, NULL, 1507723158, 1507723158),
('/states/*', 2, NULL, NULL, NULL, 1496213919, 1496213919),
('/states/create', 2, NULL, NULL, NULL, 1496213919, 1496213919),
('/states/delete', 2, NULL, NULL, NULL, 1496213919, 1496213919),
('/states/index', 2, NULL, NULL, NULL, 1496213919, 1496213919),
('/states/update', 2, NULL, NULL, NULL, 1496213919, 1496213919),
('/states/view', 2, NULL, NULL, NULL, 1496213919, 1496213919),
('/statuses/*', 2, NULL, NULL, NULL, 1496213920, 1496213920),
('/statuses/create', 2, NULL, NULL, NULL, 1496213920, 1496213920),
('/statuses/delete', 2, NULL, NULL, NULL, 1496213920, 1496213920),
('/statuses/index', 2, NULL, NULL, NULL, 1496213920, 1496213920),
('/statuses/update', 2, NULL, NULL, NULL, 1496213920, 1496213920),
('/statuses/view', 2, NULL, NULL, NULL, 1496213920, 1496213920),
('/timezones/*', 2, NULL, NULL, NULL, 1496213921, 1496213921),
('/timezones/create', 2, NULL, NULL, NULL, 1496213920, 1496213920),
('/timezones/delete', 2, NULL, NULL, NULL, 1496213920, 1496213920),
('/timezones/index', 2, NULL, NULL, NULL, 1496213920, 1496213920),
('/timezones/update', 2, NULL, NULL, NULL, 1496213920, 1496213920),
('/timezones/view', 2, NULL, NULL, NULL, 1496213920, 1496213920),
('/user/*', 2, NULL, NULL, NULL, 1496213921, 1496213921),
('/user/changecountry', 2, NULL, NULL, NULL, 1505413940, 1505413940),
('/user/create', 2, NULL, NULL, NULL, 1496213921, 1496213921),
('/user/delete', 2, NULL, NULL, NULL, 1496213921, 1496213921),
('/user/index', 2, NULL, NULL, NULL, 1496213921, 1496213921),
('/user/notifications', 2, NULL, NULL, NULL, 1507723158, 1507723158),
('/user/password', 2, NULL, NULL, NULL, 1504674000, 1504674000),
('/user/request-password-reset', 2, NULL, NULL, NULL, 1504674000, 1504674000),
('/user/resetcountry', 2, NULL, NULL, NULL, 1505413940, 1505413940),
('/user/update', 2, NULL, NULL, NULL, 1496213921, 1496213921),
('/user/view', 2, NULL, NULL, NULL, 1496213921, 1496213921),
('/users-companies/*', 2, NULL, NULL, NULL, 1496213922, 1496213922),
('/users-companies/create', 2, NULL, NULL, NULL, 1496213921, 1496213921),
('/users-companies/delete', 2, NULL, NULL, NULL, 1496213921, 1496213921),
('/users-companies/index', 2, NULL, NULL, NULL, 1496213921, 1496213921),
('/users-companies/update', 2, NULL, NULL, NULL, 1496213921, 1496213921),
('/users-companies/view', 2, NULL, NULL, NULL, 1496213921, 1496213921),
('All Access', 1, NULL, NULL, NULL, 1496145376, 1507876214),
('dsgfsdfds', 1, NULL, NULL, NULL, 1508150167, 1508150167),
('Enterprise Admin', 1, NULL, NULL, NULL, 1496145195, 1496145195),
('Enterprise Admins', 2, NULL, NULL, NULL, 1507616133, 1507616133),
('Manufacturer Admin', 1, NULL, NULL, NULL, 1496145212, 1505467159),
('Manufacturer Admins', 2, NULL, NULL, NULL, 1502092465, 1505808070),
('Sale Agency Manger', 2, NULL, NULL, NULL, 1502091995, 1502091995),
('Sale Rep', 2, NULL, NULL, NULL, 1502091688, 1502091688),
('Sales Agency Manager', 1, NULL, NULL, NULL, 1496145227, 1496145227),
('Sales Rep', 1, NULL, NULL, NULL, 1496145203, 1505461914),
('sdgsdgsdfgs', 2, NULL, NULL, NULL, 1508150181, 1508150181);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `type` (`type`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
