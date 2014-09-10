-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2014 at 01:29 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `itservices_ows`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_categories`
--

CREATE TABLE IF NOT EXISTS `ci_categories` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `cruser` int(11) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  `description` varchar(250) DEFAULT '',
  `crdate` int(11) NOT NULL DEFAULT '0',
  `modate` int(11) DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `ci_categories`
--

INSERT INTO `ci_categories` (`cid`, `parent_id`, `cruser`, `name`, `description`, `crdate`, `modate`, `status`) VALUES
(1, 0, 1, 'Watches', '', 1406641477, 0, 1),
(2, 0, 1, 'Optic Glasses', '', 1406641506, 1406642837, 1),
(3, 0, 1, 'Accessories', '', 1406641506, 0, 1),
(4, 1, 1, 'Romanson', '', 1410274770, 0, 1),
(5, 1, 1, 'Swiss', '', 1410274925, 0, 1),
(7, 2, 1, 'Cate1', '', 1410369841, 0, 1),
(8, 2, 1, 'Cate2', '', 1410369853, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ci_invoices`
--

CREATE TABLE IF NOT EXISTS `ci_invoices` (
  `iid` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_number` char(12) DEFAULT '000000000000',
  `chash` char(32) DEFAULT NULL,
  `cruser` int(11) NOT NULL DEFAULT '0',
  `customer_phone` varchar(30) DEFAULT '0',
  `total` double(10,2) NOT NULL DEFAULT '0.00',
  `cash_receive` double(10,2) DEFAULT '0.00',
  `cash_type` char(2) NOT NULL,
  `discount` char(3) DEFAULT '0',
  `grand_total` double(10,2) DEFAULT '0.00',
  `deposit` double(10,2) DEFAULT '0.00',
  `balance` double(10,2) DEFAULT '0.00',
  `cash_exchange` double(10,2) DEFAULT '0.00',
  `crdate` int(11) NOT NULL DEFAULT '0',
  `modate` int(11) DEFAULT '0',
  `report` tinyint(1) DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`iid`),
  UNIQUE KEY `invoice_number_2` (`invoice_number`),
  KEY `invoice_number` (`invoice_number`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ci_invoices`
--

INSERT INTO `ci_invoices` (`iid`, `invoice_number`, `chash`, `cruser`, `customer_phone`, `total`, `cash_receive`, `cash_type`, `discount`, `grand_total`, `deposit`, `balance`, `cash_exchange`, `crdate`, `modate`, `report`, `status`) VALUES
(1, '000000000001', 'ef4788e79b999f6bd983b9293ae64d40', 1, '0', 0.00, 0.00, '', '0', 0.00, 0.00, 0.00, 0.00, 1409680556, 0, 0, 0),
(2, '000000000002', '855816ffe149aba178f98abb44171578', 1, '0', 0.00, 0.00, '', '0', 0.00, 0.00, 0.00, 0.00, 1409746009, 0, 0, 0),
(3, '000000000003', 'bfc9687ee2ff86051cef907b8f79a9cb', 1, '0', 0.00, 0.00, '', '0', 0.00, 0.00, 0.00, 0.00, 1409758260, 0, 0, 0),
(4, '000000000004', 'c756920f483355bc029d56e394058c77', 1, '0', 0.00, 0.00, '', '0', 0.00, 0.00, 0.00, 0.00, 1410330016, 0, 0, 0),
(5, '000000000005', 'e1bbe9030590253dc1c87f25c9bc78e8', 1, '0978570847', 25.00, 50.00, 'US', '0', 25.00, 0.00, 0.00, 25.00, 1410372873, 0, 0, 1),
(6, '000000000006', 'f17cbd33907fd879498a2a99ff12e791', 1, '0', 0.00, 0.00, '', '0', 0.00, 0.00, 0.00, 0.00, 1410373305, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ci_invoice_details`
--

CREATE TABLE IF NOT EXISTS `ci_invoice_details` (
  `idid` int(11) NOT NULL AUTO_INCREMENT,
  `iid` int(11) NOT NULL DEFAULT '0',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `cid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL,
  `qty` smallint(4) NOT NULL DEFAULT '0',
  `unit_price` double(7,2) NOT NULL DEFAULT '0.00',
  `sub_total` double(7,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`idid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ci_invoice_details`
--

INSERT INTO `ci_invoice_details` (`idid`, `iid`, `parent_id`, `cid`, `name`, `qty`, `unit_price`, `sub_total`) VALUES
(1, 1, 0, 1, 'Product2', 5, 25.00, 125.00),
(2, 2, 0, 1, 'Product1', 5, 25.00, 125.00),
(3, 3, 0, 1, 'Product2', 5, 5.00, 25.00),
(4, 4, 1, 4, 'Product 1', 5, 25.00, 125.00),
(5, 5, 1, 7, 'Product 1', 5, 5.00, 25.00),
(6, 6, 1, 7, 'Product 1', 2, 5.00, 10.00);

-- --------------------------------------------------------

--
-- Table structure for table `ci_products`
--

CREATE TABLE IF NOT EXISTS `ci_products` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `cid` int(11) NOT NULL DEFAULT '0',
  `cruser` int(11) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  `unit_in_stocks` int(11) NOT NULL DEFAULT '0',
  `unit_in_sales` int(11) NOT NULL DEFAULT '0',
  `description` varchar(250) DEFAULT '',
  `crdate` int(11) NOT NULL DEFAULT '0',
  `modate` int(11) DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ci_products`
--

INSERT INTO `ci_products` (`pid`, `parent_id`, `cid`, `cruser`, `name`, `unit_in_stocks`, `unit_in_sales`, `description`, `crdate`, `modate`, `status`) VALUES
(1, 1, 4, 1, 'Product 1', 45, 5, '', 1410327786, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ci_reports`
--

CREATE TABLE IF NOT EXISTS `ci_reports` (
  `invoice_number` char(12) NOT NULL,
  `invoice_seller` varchar(50) NOT NULL,
  `invoice_date` char(10) NOT NULL,
  `invoice_day` char(2) NOT NULL,
  `invoice_month` char(2) NOT NULL,
  `invoice_year` smallint(4) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `product_qty` int(10) NOT NULL,
  `product_price` double(10,2) NOT NULL,
  `product_total` double(10,2) NOT NULL,
  `category_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_reports`
--

INSERT INTO `ci_reports` (`invoice_number`, `invoice_seller`, `invoice_date`, `invoice_day`, `invoice_month`, `invoice_year`, `product_name`, `product_qty`, `product_price`, `product_total`, `category_name`) VALUES
('000000000001', 'Man', '02-09-2014', '02', '09', 2014, 'Product1', 5, 5.00, 25.00, 'Watches'),
('000000000002', 'Man', '03-09-2014', '03', '09', 2014, 'Product2', 5, 10.00, 50.00, 'Optic Glasses');

-- --------------------------------------------------------

--
-- Table structure for table `ci_roles`
--

CREATE TABLE IF NOT EXISTS `ci_roles` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `description` varchar(250) DEFAULT '',
  `mul_sales` tinyint(1) DEFAULT '0',
  `mul_deposits` tinyint(1) DEFAULT '0',
  `mul_products` tinyint(1) DEFAULT '0',
  `mul_categories` tinyint(1) DEFAULT '0',
  `mul_reports` tinyint(1) DEFAULT '0',
  `mul_users` tinyint(1) DEFAULT '0',
  `mul_settings` tinyint(1) DEFAULT '0',
  `crdate` int(11) NOT NULL DEFAULT '0',
  `modate` int(11) DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ci_roles`
--

INSERT INTO `ci_roles` (`rid`, `name`, `description`, `mul_sales`, `mul_deposits`, `mul_products`, `mul_categories`, `mul_reports`, `mul_users`, `mul_settings`, `crdate`, `modate`, `status`) VALUES
(1, 'System Administrator', 'Super user in this systems, in which has full control permission to manage in the project systems.', 1, 1, 1, 1, 1, 1, 1, 1406449163, 0, 1),
(2, 'Cashier', '', 1, 1, 0, 0, 0, 0, 0, 1406449163, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('6213c4cfa108364ed265a4cab75aaadc', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:32.0) Gecko/20100101 Firefox/32.0', 1410367524, 'a:14:{s:9:"user_data";s:0:"";s:5:"ci_id";s:1:"1";s:11:"ci_username";s:5:"admin";s:12:"ci_firstname";s:3:"Man";s:11:"ci_fullname";s:8:"Man Math";s:7:"ci_role";s:20:"System Administrator";s:9:"mul_sales";s:1:"1";s:12:"mul_products";s:1:"1";s:14:"mul_categories";s:1:"1";s:11:"mul_reports";s:1:"1";s:12:"mul_deposits";s:1:"1";s:9:"mul_users";s:1:"1";s:12:"mul_settings";s:1:"1";s:17:"flash:old:message";s:261:"<div class="hidden-print alert alert-success alert-dismissable"><button type="button"\r\n		class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;New invoice has been printed and saved!</div>";}'),
('7d3712b3cf0e224da37742588c553ab3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36', 1410370923, 'a:15:{s:9:"user_data";s:0:"";s:5:"ci_id";s:1:"1";s:11:"ci_username";s:5:"admin";s:12:"ci_firstname";s:3:"Man";s:11:"ci_fullname";s:8:"Man Math";s:7:"ci_role";s:20:"System Administrator";s:9:"mul_sales";s:1:"1";s:12:"mul_products";s:1:"1";s:14:"mul_categories";s:1:"1";s:11:"mul_reports";s:1:"1";s:12:"mul_deposits";s:1:"1";s:9:"mul_users";s:1:"1";s:12:"mul_settings";s:1:"1";s:4:"type";s:7:"monthly";s:14:"cur_invoice_id";i:6;}'),
('cc816f5f6d313572b360c57ab08266bc', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.6 Safari/537.11', 1410352785, 'a:13:{s:9:"user_data";s:0:"";s:5:"ci_id";s:1:"1";s:11:"ci_username";s:5:"admin";s:12:"ci_firstname";s:3:"Man";s:11:"ci_fullname";s:8:"Man Math";s:7:"ci_role";s:20:"System Administrator";s:9:"mul_sales";s:1:"1";s:12:"mul_products";s:1:"1";s:14:"mul_categories";s:1:"1";s:11:"mul_reports";s:1:"1";s:12:"mul_deposits";s:1:"1";s:9:"mul_users";s:1:"1";s:12:"mul_settings";s:1:"1";}'),
('db5927f96fc0e731d9a8db2d17574fbc', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.103 Safari/537.36', 1410330521, 'a:13:{s:9:"user_data";s:0:"";s:5:"ci_id";s:1:"1";s:11:"ci_username";s:5:"admin";s:12:"ci_firstname";s:3:"Man";s:11:"ci_fullname";s:8:"Man Math";s:7:"ci_role";s:20:"System Administrator";s:9:"mul_sales";s:1:"1";s:12:"mul_products";s:1:"1";s:14:"mul_categories";s:1:"1";s:11:"mul_reports";s:1:"1";s:12:"mul_deposits";s:1:"1";s:9:"mul_users";s:1:"1";s:12:"mul_settings";s:1:"1";}'),
('e64df9a84281b2d2a0a79293f51eb14a', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.103 Safari/537.36', 1410330473, 'a:14:{s:9:"user_data";s:0:"";s:5:"ci_id";s:1:"1";s:11:"ci_username";s:5:"admin";s:12:"ci_firstname";s:3:"Man";s:11:"ci_fullname";s:8:"Man Math";s:7:"ci_role";s:20:"System Administrator";s:11:"mul_welcome";s:1:"1";s:9:"mul_sales";s:1:"1";s:12:"mul_products";s:1:"1";s:14:"mul_categories";s:1:"1";s:11:"mul_reports";s:1:"1";s:12:"mul_deposits";s:1:"1";s:9:"mul_users";s:1:"1";s:12:"mul_settings";s:1:"1";}'),
('fd5a43227bd535aabe9780bd713eaf26', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.103 Safari/537.36', 1410327619, 'a:16:{s:9:"user_data";s:0:"";s:5:"ci_id";s:1:"1";s:11:"ci_username";s:5:"admin";s:12:"ci_firstname";s:3:"Man";s:11:"ci_fullname";s:8:"Man Math";s:7:"ci_role";s:20:"System Administrator";s:11:"mul_welcome";s:1:"1";s:9:"mul_sales";s:1:"1";s:12:"mul_products";s:1:"1";s:14:"mul_categories";s:1:"1";s:11:"mul_reports";s:1:"1";s:12:"mul_deposits";s:1:"1";s:9:"mul_users";s:1:"1";s:12:"mul_settings";s:1:"1";s:14:"cur_invoice_id";i:4;s:4:"type";s:6:"yearly";}');

-- --------------------------------------------------------

--
-- Table structure for table `ci_settings`
--

CREATE TABLE IF NOT EXISTS `ci_settings` (
  `DEFAULT_COMPANY_NAME` varchar(250) NOT NULL DEFAULT '',
  `DEFAULT_COMPANY_LOGO` varchar(250) NOT NULL,
  `DEFAULT_COMPANY_ADDRESS` tinytext NOT NULL,
  `DEFAULT_COMPANY_PHONE` varchar(250) NOT NULL DEFAULT '',
  `DEFAULT_USD_TO_KH` smallint(4) NOT NULL DEFAULT '4000',
  `DEFAULT_COMPANY_EMAIL` varchar(250) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_settings`
--

INSERT INTO `ci_settings` (`DEFAULT_COMPANY_NAME`, `DEFAULT_COMPANY_LOGO`, `DEFAULT_COMPANY_ADDRESS`, `DEFAULT_COMPANY_PHONE`, `DEFAULT_USD_TO_KH`, `DEFAULT_COMPANY_EMAIL`) VALUES
('International Optics and watch shop', 'logo.jpg', '#058, 7Markara, Stree, Group 10, Mondol2, Sangkat 4, Sihanouk Province', '098 933 510 / 034 933 510', 4000, '');

-- --------------------------------------------------------

--
-- Table structure for table `ci_users`
--

CREATE TABLE IF NOT EXISTS `ci_users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `rid` int(11) NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  `firstname` varchar(50) DEFAULT '',
  `lastname` varchar(50) DEFAULT '',
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '"0" => "Male", "1" => "Female"',
  `email` varchar(250) DEFAULT '',
  `phone` varchar(30) DEFAULT '',
  `crdate` int(11) NOT NULL DEFAULT '0',
  `modate` int(11) DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`username`,`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ci_users`
--

INSERT INTO `ci_users` (`uid`, `rid`, `username`, `password`, `firstname`, `lastname`, `sex`, `email`, `phone`, `crdate`, `modate`, `status`) VALUES
(1, 1, 'admin', 'df53c745fae51cb9b4a5ecef96e3fff7', 'Man', 'Math', 0, 'manmath4@gmail.com', '0978470847', 1406449163, 1410367467, 1),
(3, 2, 'marida123', 'd68599d99d0212b25a1fa761ac9419ed', 'Maridadddd', 'Hieng', 1, 'maridahieng@yahoo.com', '0979243513', 1410363579, 1410365773, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
