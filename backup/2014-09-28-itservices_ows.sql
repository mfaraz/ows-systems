-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2014 at 01:02 PM
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
  `customer` varchar(50) DEFAULT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ci_invoices`
--

INSERT INTO `ci_invoices` (`iid`, `invoice_number`, `chash`, `cruser`, `customer`, `total`, `cash_receive`, `cash_type`, `discount`, `grand_total`, `deposit`, `balance`, `cash_exchange`, `crdate`, `modate`, `report`, `status`) VALUES
(1, '000000000001', 'ef4788e79b999f6bd983b9293ae64d40', 1, '0978470847', 40.00, 20.00, 'US', '0', 40.00, 20.00, 20.00, 0.00, 1411787959, 0, 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ci_invoice_details`
--

INSERT INTO `ci_invoice_details` (`idid`, `iid`, `parent_id`, `cid`, `name`, `qty`, `unit_price`, `sub_total`) VALUES
(1, 1, 1, 7, 'Product 1', 1, 40.00, 40.00);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ci_products`
--

INSERT INTO `ci_products` (`pid`, `parent_id`, `cid`, `cruser`, `name`, `unit_in_stocks`, `unit_in_sales`, `description`, `crdate`, `modate`, `status`) VALUES
(1, 1, 4, 1, 'Product 1', 43, 7, '', 1410327786, 0, 1),
(2, 1, 7, 1, 'LG G3', 50, 0, '', 1411788233, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ci_reports`
--

CREATE TABLE IF NOT EXISTS `ci_reports` (
  `invoice_number` char(12) NOT NULL,
  `customer` varchar(50) NOT NULL,
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

INSERT INTO `ci_reports` (`invoice_number`, `customer`, `invoice_seller`, `invoice_date`, `invoice_day`, `invoice_month`, `invoice_year`, `product_name`, `product_qty`, `product_price`, `product_total`, `category_name`) VALUES
('000000000001', '0978470847', 'Man', '27-09-2014', '27', '09', 2014, 'Product 1', 1, 40.00, 40.00, 'Romanson');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

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
  `sess_id` tinyint(1) NOT NULL DEFAULT '0',
  `sess_username` varchar(50) NOT NULL DEFAULT '',
  `sess_fullname` varchar(100) NOT NULL DEFAULT '',
  `sess_role` varchar(50) NOT NULL DEFAULT '',
  `mul_sales` tinyint(1) NOT NULL DEFAULT '0',
  `mul_products` tinyint(1) NOT NULL DEFAULT '0',
  `mul_categories` tinyint(1) NOT NULL DEFAULT '0',
  `mul_reports` tinyint(1) NOT NULL DEFAULT '0',
  `mul_deposits` tinyint(1) NOT NULL DEFAULT '0',
  `mul_users` tinyint(1) NOT NULL DEFAULT '0',
  `mul_settings` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sess_id`),
  UNIQUE KEY `sess_username` (`sess_username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`sess_id`, `sess_username`, `sess_fullname`, `sess_role`, `mul_sales`, `mul_products`, `mul_categories`, `mul_reports`, `mul_deposits`, `mul_users`, `mul_settings`) VALUES
(1, 'admin', 'Man Math', 'System Administrator', 1, 1, 1, 1, 1, 1, 1);

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
  `DISPLAY_CUSTOMER` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_settings`
--

INSERT INTO `ci_settings` (`DEFAULT_COMPANY_NAME`, `DEFAULT_COMPANY_LOGO`, `DEFAULT_COMPANY_ADDRESS`, `DEFAULT_COMPANY_PHONE`, `DEFAULT_USD_TO_KH`, `DISPLAY_CUSTOMER`) VALUES
('International Optics and watch shop', 'logo.jpg', '#058, 7Markara, Stree, Group 10, Mondol2, Sangkat 4, Sihanouk Province', '098 933 510 / 034 933 510', 4000, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ci_users`
--

INSERT INTO `ci_users` (`uid`, `rid`, `username`, `password`, `firstname`, `lastname`, `sex`, `email`, `phone`, `crdate`, `modate`, `status`) VALUES
(1, 1, 'admin', 'df53c745fae51cb9b4a5ecef96e3fff7', 'Man', 'Math', 0, 'manmath4@gmail.com', '0978470847', 1406449163, 1410367467, 1),
(3, 2, 'marida', 'e39e69b03c79c81be2514d9983321aae', 'Marida', 'Hieng', 1, 'maridahieng@yahoo.com', '0979243513', 1410363579, 1411787109, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
