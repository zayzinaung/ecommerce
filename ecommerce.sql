-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 21, 2018 at 07:20 AM
-- Server version: 5.6.38
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jlslive_global_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `activation_codes`
--

CREATE TABLE `activation_codes` (
  `id` int(11) NOT NULL,
  `user_email` varchar(80) NOT NULL,
  `activation_code` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activation_codes`
--

INSERT INTO `activation_codes` (`id`, `user_email`, `activation_code`) VALUES
(1, 'ptaung4@gmail.com', '9205'),
(2, 'jasmine@gmail.com', '2730'),
(3, 'rose@gmail.com', '1243');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `brand_icon` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`, `slug`, `brand_icon`, `created_at`, `updated_at`) VALUES
(1, 'Other', '', '5f3c41ae88d94fda5506547d3d1eb1b0default.jpg', '2015-10-24 17:00:00', '2015-10-24 17:00:00'),
(2, 'le coq sportif', '', '448ea94139f746b18c4ea5a5f60767eelecoq.jpg', '2015-10-24 17:02:05', '2015-10-24 17:02:05');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Women\'s Clothes', 'womens-clothes', '2015-10-24 15:52:37', '2015-10-24 15:52:37'),
(2, 'Men\'s Clothes', 'mens-clothes', '2015-10-24 15:54:29', '2015-10-24 15:54:29'),
(3, 'Digital & Electronics', 'digital-electronics', '2015-10-24 15:56:20', '2015-10-24 15:56:20');

-- --------------------------------------------------------

--
-- Table structure for table `class_lists`
--

CREATE TABLE `class_lists` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_lists`
--

INSERT INTO `class_lists` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'user', 'Users Module', '2015-01-04 11:33:19', '2015-01-04 05:03:19'),
(8, 'module', 'Module ', '2015-01-06 05:23:31', '2015-01-06 05:23:31'),
(9, 'role', 'Role Module', '2015-01-08 08:13:52', '2015-01-08 01:43:52'),
(33, 'backup', 'Back Up Module', '2015-05-05 12:01:19', '2015-05-05 12:01:19'),
(34, 'general', 'General Setting', '2015-05-05 12:01:32', '2015-05-05 12:01:32'),
(35, 'category', 'Category Management', '2015-06-07 22:22:04', '2015-06-07 20:56:39'),
(36, 'brand', 'Product Brand Management', '2015-06-07 22:22:08', '2015-06-07 21:14:07'),
(37, 'subcategory', 'Subcategory management', '2015-06-10 22:01:00', '2015-06-10 22:01:00'),
(38, 'product_info', 'Product information module', '2015-06-16 20:42:12', '2015-06-16 20:42:12'),
(39, 'color', 'Product Color Management', '2015-07-09 02:34:31', '2015-07-09 02:34:31'),
(40, 'size', 'Product Size Management', '2015-07-09 20:50:09', '2015-07-09 20:50:09'),
(41, 'length', 'Product Length Management', '2015-07-09 20:52:55', '2015-07-09 20:52:55'),
(42, 'weight', 'Product Weight Management', '2015-07-09 23:03:33', '2015-07-09 23:03:33'),
(43, 'country', 'Country Management', '2015-07-10 02:33:05', '2015-07-10 02:33:05'),
(44, 'fuel', 'Fuel Management', '2015-07-13 20:11:54', '2015-07-13 20:11:54'),
(45, 'product', 'Product Module', '2015-07-21 00:33:02', '2015-07-21 00:33:02'),
(46, 'slider', 'Slider Module for frontend slide show', '2015-10-14 03:44:35', '2015-10-14 03:44:35'),
(47, 'member', 'Members Module', '2015-08-25 22:10:29', '2015-08-25 22:10:29'),
(48, 'discount', 'Manage Discount', '2015-10-14 03:46:43', '2015-10-14 03:46:43'),
(49, 'gst', 'Manage GST', '2015-10-14 03:47:00', '2015-10-14 03:47:00'),
(50, 'shipping', 'Manage Shipping', '2015-10-14 03:47:28', '2015-10-14 03:47:28'),
(51, 'order', 'Order Management', '2015-09-11 02:17:33', '2015-09-11 02:17:33'),
(52, 'account', 'Account Module', '2015-09-29 03:51:57', '2015-09-29 03:51:57'),
(53, 'profitandloss', 'Profit and loss management', '2015-10-14 03:46:14', '2015-10-14 03:46:14'),
(54, 'review', 'Review Management', '2015-11-12 02:46:22', '2015-11-12 02:46:22'),
(55, 'gallery', 'Gallery Module', '2015-11-30 07:42:23', '2015-11-30 07:42:23'),
(56, 'pages', 'Pages Management', '2015-12-02 05:41:25', '2015-12-02 05:41:25'),
(57, 'footer', 'Footer CMS', '2015-12-02 08:38:16', '2015-12-02 08:38:16'),
(58, 'header', 'Header Management', '2015-12-04 06:43:17', '2015-12-04 06:43:17'),
(59, 'staff', 'Staff Module', '2015-12-11 07:11:27', '2015-12-11 07:11:27'),
(60, 'salary_payment', 'Salary Payment Management', '2015-12-11 08:38:22', '2015-12-11 08:38:22'),
(61, 'cpf', 'Cpf Management', '2015-12-11 08:38:56', '2015-12-11 08:38:56');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(10) UNSIGNED NOT NULL,
  `color_name` varchar(64) NOT NULL,
  `color_image` varchar(128) NOT NULL,
  `color_code` varchar(128) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `color_name`, `color_image`, `color_code`, `created_at`, `updated_at`) VALUES
(1, 'Red', 'b8df6fb172ae479cb75fd2a3402533dcred.jpg', '#FF0000', '2015-07-10 00:49:10', '2015-10-20 04:14:14'),
(2, 'Yellow', '9c13f276c6fd01145697054a90b750d4yellow.jpg', '#FFFF00', '2015-10-20 03:19:36', '2015-10-20 04:12:53'),
(3, 'Pink', 'a82fae2c36640b30fee4b912780f112cpink.jpg', '#FFC0CB', '2015-10-20 04:19:30', '2015-10-20 04:19:30'),
(4, 'Orange', 'fe7ed1cd6237e094d8151086aad4443corange.jpg', '#FFA500', '2015-10-20 04:20:20', '2015-10-20 04:20:20'),
(5, 'Blue', 'd2d59ff2558956301b6440f3969f6e48blue.jpg', '#0000FF', '2015-10-20 04:21:09', '2015-10-20 04:21:09'),
(6, 'Black', '5d9168ec8f5f51109aaabd107abb190dblack.jpg', '#000000', '2015-10-20 04:21:42', '2015-10-20 04:21:42'),
(7, 'White', '930992271b886624582f899b435e6bd9white.jpg', '#FFFFFF', '2015-10-20 04:22:18', '2015-10-20 04:22:18'),
(8, 'Green', 'b9b0bd7805057cb251619147f0d426dagreen.jpg', '#008000', '2015-10-20 04:24:42', '2015-10-20 04:24:42'),
(9, 'Purple', '9491ff19be7f450e062d50552304a4depurple.jpg', '#800080', '2015-10-20 04:25:23', '2015-10-20 04:25:23'),
(10, 'Gray', '9f1f9ba5d9de27d620544351bf0cb88dgray.jpg', '#808080', '2015-10-20 04:25:59', '2015-10-20 04:25:59'),
(11, 'Chocolate', 'c2f70870e381a4be36524c70636d4f49chocolate.jpg', '#D2691E', '2015-10-20 04:38:06', '2015-10-20 04:38:06'),
(12, 'Silver', '118ef0551f8bee9b8ad05a6d94a8eb2asilver.jpg', '#C0C0C0', '2015-10-20 04:39:07', '2015-10-20 04:39:07'),
(13, 'Gold', '604ff04d4d641f1b9993a7b6f0abcf36gold.jpg', '#FFD700', '2015-10-20 04:41:01', '2015-10-20 04:41:01'),
(14, 'Cyan', 'a96810de9b6adb3ee651d5eaa0cc06e4cyan.jpg', '#00FFFF', '2015-10-20 04:42:17', '2015-10-20 04:42:17'),
(15, 'Olive', 'ebc7279d68571a54f2231647c05def01olive.jpg', '#808000', '2015-10-20 04:43:10', '2015-10-20 04:43:10');

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

CREATE TABLE `contracts` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country_name` varchar(100) NOT NULL DEFAULT '',
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `flag` varchar(255) NOT NULL DEFAULT '',
  `calling_code` varchar(8) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_name`, `country_code`, `flag`, `calling_code`, `created_at`, `updated_at`) VALUES
(1, 'Afghanistan', 'AF', 'afghanistan.png', '93', '2015-07-22 20:06:13', '2015-07-12 20:01:10'),
(2, 'Aland Islands', 'AX', 'aland islands.png', '358', '2015-07-22 20:27:35', '2015-07-12 20:01:10'),
(3, 'Albania', 'AL', 'albania.png', '355', '2015-07-22 20:27:59', '2015-07-12 20:01:10'),
(4, 'Algeria', 'DZ', 'algeria.png', '213', '2015-07-22 20:28:27', '2015-07-12 20:01:10'),
(5, 'American Samoa', 'AS', 'american samoa.png', '1+684', '2015-07-22 20:28:49', '2015-07-12 20:01:10'),
(6, 'Andorra', 'AD', 'andorra.png', '376', '2015-07-22 21:50:32', '2015-07-12 11:00:00'),
(7, 'Angola', 'AO', 'angola.png', '244', '2015-07-22 21:51:01', '2015-07-12 11:00:00'),
(8, 'Anguilla', 'AI', 'anguilla.png', '1+264', '2015-07-22 21:51:24', '2015-07-12 11:00:00'),
(9, 'Antarctica', 'AQ', 'antarctica.png', '672', '2015-07-22 21:51:55', '2015-07-12 11:00:00'),
(10, 'Antigua and Barbuda', 'AG', 'antigua and barbuda.png', '1+268', '2015-07-22 21:52:23', '2015-07-12 11:00:00'),
(11, 'Argentina', 'AR', 'argentina.png', '54', '2015-07-22 21:52:45', '2015-07-12 11:00:00'),
(12, 'Armenia', 'AM', 'armenia.png', '374', '2015-07-22 21:54:33', '2015-07-12 11:00:00'),
(13, 'Aruba', 'AW', 'aruba.png', '297', '2015-07-22 21:54:59', '2015-07-12 11:00:00'),
(14, 'Australia', 'AU', 'australia.png', '61', '2015-07-22 21:56:25', '2015-07-12 11:00:00'),
(15, 'Austria', 'AT', 'austria.png', '43', '2015-07-22 21:56:51', '2015-07-12 11:00:00'),
(16, 'Azerbaijan', 'AZ', 'azerbaijan.png', '994', '2015-07-22 21:57:14', '2015-07-12 11:00:00'),
(17, 'Bahamas', 'BS', 'bahamas.png', '1+242', '2015-07-22 22:08:08', '2015-07-12 11:00:00'),
(18, 'Bahrain', 'BH', 'BH.png', '973', '2015-07-12 20:05:10', '2015-07-12 11:00:00'),
(19, 'Bangladesh', 'BD', 'BD.png', '880', '2015-07-12 20:05:12', '2015-07-12 11:00:00'),
(20, 'Barbados', 'BB', 'BB.png', '1+246', '2015-07-12 20:05:12', '2015-07-12 11:00:00'),
(21, 'Belarus', 'BY', 'BY.png', '375', '2015-07-12 20:05:13', '2015-07-12 11:00:00'),
(22, 'Belgium', 'BE', 'BE.png', '32', '2015-07-12 20:05:14', '2015-07-12 11:00:00'),
(23, 'Belize', 'BZ', 'BZ.png', '501', '2015-07-12 20:05:16', '2015-07-12 11:00:00'),
(24, 'Benin', 'BJ', 'BJ.png', '229', '2015-07-12 20:05:18', '2015-07-12 11:00:00'),
(25, 'Bermuda', 'BM', 'BM.png', '1+441', '2015-07-12 20:05:17', '2015-07-12 11:00:00'),
(26, 'Bhutan', 'BT', 'BT.png', '975', '2015-07-12 20:05:19', '2015-07-12 11:00:00'),
(27, 'Bolivia', 'BO', 'BO.png', '591', '2015-07-12 20:05:20', '2015-07-12 11:00:00'),
(28, 'Bonaire, Sint Eustatius and Saba', 'BQ', 'BQ.png', '599', '2015-07-12 20:05:21', '2015-07-12 11:00:00'),
(29, 'Bosnia and Herzegovina', 'BA', 'BA.png', '387', '2015-07-12 20:05:22', '2015-07-12 11:00:00'),
(30, 'Botswana', 'BW', 'BW.png', '267', '2015-07-12 20:05:23', '2015-07-12 11:00:00'),
(31, 'Bouvet Island', 'BV', 'BV.png', 'NONE', '2015-07-12 20:05:29', '2015-07-12 11:00:00'),
(32, 'Brazil', 'BR', 'BR.png', '55', '2015-07-12 20:05:30', '2015-07-12 11:00:00'),
(33, 'British Indian Ocean Territory', 'IO', 'IO.png', '246', '2015-07-12 20:05:30', '2015-07-12 11:00:00'),
(34, 'Brunei', 'BN', 'BN.png', '673', '2015-07-12 20:05:32', '2015-07-12 11:00:00'),
(35, 'Bulgaria', 'BG', 'BG.png', '359', '2015-07-12 20:05:33', '2015-07-12 11:00:00'),
(36, 'Burkina Faso', 'BF', 'BF.png', '226', '2015-07-12 20:05:35', '2015-07-12 11:00:00'),
(37, 'Burundi', 'BI', 'BI.png', '257', '2015-07-12 20:05:35', '2015-07-12 11:00:00'),
(38, 'Cambodia', 'KH', 'KH.png', '855', '2015-07-12 20:05:34', '2015-07-12 11:00:00'),
(39, 'Cameroon', 'CM', 'CM.png', '237', '2015-07-12 20:05:37', '2015-07-12 11:00:00'),
(40, 'Canada', 'CA', 'CA.png', '1', '2015-07-12 20:05:38', '2015-07-12 11:00:00'),
(41, 'Cape Verde', 'CV', 'CV.png', '238', '2015-07-12 20:05:39', '2015-07-12 11:00:00'),
(42, 'Cayman Islands', 'KY', 'KY.png', '1+345', '2015-07-12 20:05:40', '2015-07-12 11:00:00'),
(43, 'Central African Republic', 'CF', 'CF.png', '236', '2015-07-12 20:05:41', '2015-07-12 11:00:00'),
(44, 'Chad', 'TD', 'TD.png', '235', '2015-07-12 20:05:44', '2015-07-12 11:00:00'),
(45, 'Chile', 'CL', 'CL.png', '56', '2015-07-12 20:05:44', '2015-07-12 11:00:00'),
(46, 'China', 'CN', 'CN.png', '86', '2015-07-12 20:05:45', '2015-07-12 11:00:00'),
(47, 'Christmas Island', 'CX', 'CX.png', '61', '2015-07-12 20:05:47', '2015-07-12 11:00:00'),
(48, 'Cocos (Keeling) Islands', 'CC', 'CC.png', '61', '2015-07-12 20:05:48', '2015-07-12 11:00:00'),
(49, 'Colombia', 'CO', 'CO.png', '57', '2015-07-12 20:05:49', '2015-07-12 11:00:00'),
(50, 'Comoros', 'KM', 'KM.png', '269', '2015-07-12 20:05:50', '2015-07-12 11:00:00'),
(51, 'Congo', 'CG', 'CG.png', '242', '2015-07-12 20:05:54', '2015-07-12 11:00:00'),
(52, 'Cook Islands', 'CK', 'CK.png', '682', '2015-07-12 20:05:53', '2015-07-12 11:00:00'),
(53, 'Costa Rica', 'CR', 'CR.png', '506', '2015-07-12 20:05:53', '2015-07-12 11:00:00'),
(54, 'Cote d\'ivoire (Ivory Coast)', 'CI', 'CI.png', '225', '2015-07-12 20:05:52', '2015-07-12 11:00:00'),
(55, 'Croatia', 'HR', 'HR.png', '385', '2015-07-12 20:05:51', '2015-07-12 11:00:00'),
(56, 'Cuba', 'CU', 'CU.png', '53', '2015-07-12 20:05:56', '2015-07-12 11:00:00'),
(57, 'Curacao', 'CW', 'CW.png', '599', '2015-07-12 20:05:57', '2015-07-12 11:00:00'),
(58, 'Cyprus', 'CY', 'CY.png', '357', '2015-07-12 20:05:58', '2015-07-12 11:00:00'),
(59, 'Czech Republic', 'CZ', 'CZ.png', '420', '2015-07-12 20:05:59', '2015-07-12 11:00:00'),
(60, 'Democratic Republic of the Congo', 'CD', 'CD.png', '243', '2015-07-12 20:05:59', '2015-07-12 11:00:00'),
(61, 'Denmark', 'DK', 'DK.png', '45', '2015-07-12 20:06:05', '2015-07-12 11:00:00'),
(62, 'Djibouti', 'DJ', 'DJ.png', '253', '2015-07-12 20:06:07', '2015-07-12 11:00:00'),
(63, 'Dominica', 'DM', 'DM.png', '1+767', '2015-07-12 20:06:06', '2015-07-12 11:00:00'),
(64, 'Dominican Republic', 'DO', 'DO.png', '1+809, 8', '2015-07-12 20:06:08', '2015-07-12 11:00:00'),
(65, 'Ecuador', 'EC', 'EC.png', '593', '2015-07-12 20:06:10', '2015-07-12 11:00:00'),
(66, 'Egypt', 'EG', 'EG.png', '20', '2015-07-12 20:06:10', '2015-07-12 11:00:00'),
(67, 'El Salvador', 'SV', 'SV.png', '503', '2015-07-12 20:06:11', '2015-07-12 11:00:00'),
(68, 'Equatorial Guinea', 'GQ', 'GQ.png', '240', '2015-07-12 20:06:13', '2015-07-12 11:00:00'),
(69, 'Eritrea', 'ER', 'ER.png', '291', '2015-07-12 20:06:14', '2015-07-12 11:00:00'),
(70, 'Estonia', 'EE', 'EE.png', '372', '2015-07-12 20:06:15', '2015-07-12 11:00:00'),
(71, 'Ethiopia', 'ET', 'ET.png', '251', '2015-07-12 20:06:12', '2015-07-12 11:00:00'),
(72, 'Falkland Islands (Malvinas)', 'FK', 'FK.png', '500', '2015-07-12 20:06:17', '2015-07-12 11:00:00'),
(73, 'Faroe Islands', 'FO', 'FO.png', '298', '2015-07-12 20:06:20', '2015-07-12 11:00:00'),
(74, 'Fiji', 'FJ', 'FJ.png', '679', '2015-07-12 20:06:19', '2015-07-12 11:00:00'),
(75, 'Finland', 'FI', 'FI.png', '358', '2015-07-12 20:06:18', '2015-07-12 11:00:00'),
(76, 'France', 'FR', 'FR.png', '33', '2015-07-12 20:06:26', '2015-07-12 11:00:00'),
(77, 'French Guiana', 'GF', 'GF.png', '594', '2015-07-12 20:06:25', '2015-07-12 11:00:00'),
(78, 'French Polynesia', 'PF', 'PF.png', '689', '2015-07-12 20:06:24', '2015-07-12 11:00:00'),
(79, 'French Southern Territories', 'TF', 'TF.png', '', '2015-07-12 20:06:24', '2015-07-12 11:00:00'),
(80, 'Gabon', 'GA', 'GA.png', '241', '2015-07-12 20:06:23', '2015-07-12 11:00:00'),
(81, 'Gambia', 'GM', 'GM.png', '220', '2015-07-12 20:06:22', '2015-07-12 11:00:00'),
(82, 'Georgia', 'GE', 'GE.png', '995', '2015-07-12 20:06:29', '2015-07-12 11:00:00'),
(83, 'Germany', 'DE', 'DE.png', '49', '2015-07-12 20:06:29', '2015-07-12 11:00:00'),
(84, 'Ghana', 'GH', 'GH.png', '233', '2015-07-12 20:06:28', '2015-07-12 11:00:00'),
(85, 'Gibraltar', 'GI', 'GI.png', '350', '2015-07-12 20:06:31', '2015-07-12 11:00:00'),
(86, 'Greece', 'GR', 'GR.png', '30', '2015-07-12 20:06:32', '2015-07-12 11:00:00'),
(87, 'Greenland', 'GL', 'GL.png', '299', '2015-07-12 20:06:33', '2015-07-12 11:00:00'),
(88, 'Grenada', 'GD', 'GD.png', '1+473', '2015-07-12 20:06:34', '2015-07-12 11:00:00'),
(89, 'Guadaloupe', 'GP', 'GP.png', '590', '2015-07-12 20:06:35', '2015-07-12 11:00:00'),
(90, 'Guam', 'GU', 'GU.png', '1+671', '2015-07-12 20:06:36', '2015-07-12 11:00:00'),
(91, 'Guatemala', 'GT', 'GT.png', '502', '2015-07-12 20:08:29', '2015-07-12 11:00:00'),
(92, 'Guernsey', 'GG', 'GG.png', '44', '2015-07-12 20:08:32', '2015-07-12 11:00:00'),
(93, 'Guinea', 'GN', 'GN.png', '224', '2015-07-12 20:08:31', '2015-07-12 11:00:00'),
(94, 'Guinea-Bissau', 'GW', 'GW.png', '245', '2015-07-12 20:08:33', '2015-07-12 11:00:00'),
(95, 'Guyana', 'GY', 'GY.png', '592', '2015-07-12 20:08:31', '2015-07-12 11:00:00'),
(96, 'Haiti', 'HT', 'HT.png', '509', '2015-07-12 20:08:30', '2015-07-12 11:00:00'),
(97, 'Heard Island and McDonald Islands', 'HM', 'HM.png', 'NONE', '2015-07-12 20:08:35', '2015-07-12 11:00:00'),
(98, 'Honduras', 'HN', 'HN.png', '504', '2015-07-12 20:08:30', '2015-07-12 11:00:00'),
(99, 'Hong Kong', 'HK', 'HK.png', '852', '2015-07-12 20:08:36', '2015-07-12 11:00:00'),
(100, 'Hungary', 'HU', 'HU.png', '36', '2015-07-12 20:08:43', '2015-07-12 11:00:00'),
(101, 'Iceland', 'IS', 'IS.png', '354', '2015-07-12 20:08:41', '2015-07-12 11:00:00'),
(102, 'India', 'IN', 'IN.png', '91', '2015-07-12 20:08:44', '2015-07-12 11:00:00'),
(103, 'Indonesia', 'ID', 'ID.png', '62', '2015-07-12 20:08:40', '2015-07-12 11:00:00'),
(104, 'Iran', 'IR', 'IR.png', '98', '2015-07-12 20:08:40', '2015-07-12 11:00:00'),
(105, 'Iraq', 'IQ', 'IQ.png', '964', '2015-07-12 20:08:46', '2015-07-12 11:00:00'),
(106, 'Ireland', 'IE', 'IE.png', '353', '2015-07-12 20:08:38', '2015-07-12 11:00:00'),
(107, 'Isle of Man', 'IM', 'IM.png', '44', '2015-07-12 20:08:38', '2015-07-12 11:00:00'),
(108, 'Israel', 'IL', 'IL.png', '972', '2015-07-12 20:09:00', '2015-07-12 11:00:00'),
(109, 'Italy', 'IT', 'IT.png', '39', '2015-07-12 20:08:59', '2015-07-12 11:00:00'),
(110, 'Jamaica', 'JM', 'JM.png', '1+876', '2015-07-12 20:08:58', '2015-07-12 11:00:00'),
(111, 'Japan', 'JP', 'JP.png', '81', '2015-07-12 20:08:58', '2015-07-12 11:00:00'),
(112, 'Jersey', 'JE', 'JE.png', '44', '2015-07-12 20:08:57', '2015-07-12 11:00:00'),
(113, 'Jordan', 'JO', 'JO.png', '962', '2015-07-12 20:08:56', '2015-07-12 11:00:00'),
(114, 'Kazakhstan', 'KZ', 'KZ.png', '7', '2015-07-12 20:08:56', '2015-07-12 11:00:00'),
(115, 'Kenya', 'KE', 'KE.png', '254', '2015-07-12 20:08:55', '2015-07-12 11:00:00'),
(116, 'Kiribati', 'KI', 'KI.png', '686', '2015-07-12 20:08:55', '2015-07-12 11:00:00'),
(117, 'Kosovo', 'XK', 'XK.png', '381', '2015-07-12 20:08:54', '2015-07-12 11:00:00'),
(118, 'Kuwait', 'KW', 'KW.png', '965', '2015-07-12 20:08:53', '2015-07-12 11:00:00'),
(119, 'Kyrgyzstan', 'KG', 'KG.png', '996', '2015-07-12 20:08:53', '2015-07-12 11:00:00'),
(120, 'Laos', 'LA', 'LA.png', '856', '2015-07-12 20:08:52', '2015-07-12 11:00:00'),
(121, 'Latvia', 'LV', 'LV.png', '371', '2015-07-12 20:09:12', '2015-07-12 11:00:00'),
(122, 'Lebanon', 'LB', 'LB.png', '961', '2015-07-12 20:09:15', '2015-07-12 11:00:00'),
(123, 'Lesotho', 'LS', 'LS.png', '266', '2015-07-12 20:09:16', '2015-07-12 11:00:00'),
(124, 'Liberia', 'LR', 'LR.png', '231', '2015-07-12 20:09:10', '2015-07-12 11:00:00'),
(125, 'Libya', 'LY', 'LY.png', '218', '2015-07-12 20:09:09', '2015-07-12 11:00:00'),
(126, 'Liechtenstein', 'LI', 'LI.png', '423', '2015-07-12 20:09:08', '2015-07-12 11:00:00'),
(127, 'Lithuania', 'LT', 'LT.png', '370', '2015-07-10 21:11:37', '0000-00-00 00:00:00'),
(128, 'Luxembourg', 'LU', 'LU.png', '352', '2015-07-10 21:11:37', '0000-00-00 00:00:00'),
(129, 'Macao', 'MO', 'MO.png', '853', '2015-07-10 21:11:37', '0000-00-00 00:00:00'),
(130, 'Macedonia', 'MK', 'MK.png', '389', '2015-07-10 21:11:37', '0000-00-00 00:00:00'),
(131, 'Madagascar', 'MG', 'MG.png', '261', '2015-07-10 21:11:37', '0000-00-00 00:00:00'),
(132, 'Malawi', 'MW', 'MW.png', '265', '2015-07-10 21:11:37', '0000-00-00 00:00:00'),
(133, 'Malaysia', 'MY', 'MY.png', '60', '2015-07-10 21:11:37', '0000-00-00 00:00:00'),
(134, 'Maldives', 'MV', 'MV.png', '960', '2015-07-10 21:11:37', '0000-00-00 00:00:00'),
(135, 'Mali', 'ML', 'ML.png', '223', '2015-07-10 21:11:37', '0000-00-00 00:00:00'),
(136, 'Malta', 'MT', 'MT.png', '356', '2015-07-10 21:11:37', '0000-00-00 00:00:00'),
(137, 'Marshall Islands', 'MH', 'MH.png', '692', '2015-07-10 21:11:37', '0000-00-00 00:00:00'),
(138, 'Martinique', 'MQ', 'MQ.png', '596', '2015-07-10 21:11:37', '0000-00-00 00:00:00'),
(139, 'Mauritania', 'MR', 'MR.png', '222', '2015-07-10 21:11:37', '0000-00-00 00:00:00'),
(140, 'Mauritius', 'MU', 'MU.png', '230', '2015-07-10 21:11:37', '0000-00-00 00:00:00'),
(141, 'Mayotte', 'YT', 'YT.png', '262', '2015-07-10 21:11:37', '0000-00-00 00:00:00'),
(142, 'Mexico', 'MX', 'MX.png', '52', '2015-07-10 21:11:37', '0000-00-00 00:00:00'),
(143, 'Micronesia', 'FM', 'FM.png', '691', '2015-07-10 21:11:37', '0000-00-00 00:00:00'),
(144, 'Moldava', 'MD', 'MD.png', '373', '2015-07-10 21:11:37', '0000-00-00 00:00:00'),
(145, 'Monaco', 'MC', 'MC.png', '377', '2015-07-10 21:11:37', '0000-00-00 00:00:00'),
(146, 'Mongolia', 'MN', 'MN.png', '976', '2015-07-10 21:11:37', '0000-00-00 00:00:00'),
(147, 'Montenegro', 'ME', 'ME.png', '382', '2015-07-10 21:11:37', '0000-00-00 00:00:00'),
(148, 'Montserrat', 'MS', 'MS.png', '1+664', '2015-07-10 21:11:37', '0000-00-00 00:00:00'),
(149, 'Morocco', 'MA', 'MA.png', '212', '2015-07-10 21:11:37', '0000-00-00 00:00:00'),
(150, 'Mozambique', 'MZ', 'MZ.png', '258', '2015-07-10 21:11:37', '0000-00-00 00:00:00'),
(151, 'Myanmar (Burma)', 'MM', 'MM.png', '95', '2015-07-12 19:58:48', '0000-00-00 00:00:00'),
(152, 'Namibia', 'NA', 'NA.png', '264', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(153, 'Nauru', 'NR', 'NR.png', '674', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(154, 'Nepal', 'NP', 'NP.png', '977', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(155, 'Netherlands', 'NL', 'NL.png', '31', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(156, 'New Caledonia', 'NC', 'NC.png', '687', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(157, 'New Zealand', 'NZ', 'NZ.png', '64', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(158, 'Nicaragua', 'NI', 'NI.png', '505', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(159, 'Niger', 'NE', 'NE.png', '227', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(160, 'Nigeria', 'NG', 'NG.png', '234', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(161, 'Niue', 'NU', 'NU.png', '683', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(162, 'Norfolk Island', 'NF', 'NF.png', '672', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(163, 'North Korea', 'KP', 'KP.png', '850', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(164, 'Northern Mariana Islands', 'MP', 'MP.png', '1+670', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(165, 'Norway', 'NO', 'NO.png', '47', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(166, 'Oman', 'OM', 'OM.png', '968', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(167, 'Pakistan', 'PK', 'PK.png', '92', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(168, 'Palau', 'PW', 'PW.png', '680', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(169, 'Palestine', 'PS', 'PS.png', '970', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(170, 'Panama', 'PA', 'PA.png', '507', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(171, 'Papua New Guinea', 'PG', 'PG.png', '675', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(172, 'Paraguay', 'PY', 'PY.png', '595', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(173, 'Peru', 'PE', 'PE.png', '51', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(174, 'Phillipines', 'PH', 'PH.png', '63', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(175, 'Pitcairn', 'PN', 'PN.png', 'NONE', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(176, 'Poland', 'PL', 'PL.png', '48', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(177, 'Portugal', 'PT', 'PT.png', '351', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(178, 'Puerto Rico', 'PR', 'PR.png', '1+939', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(179, 'Qatar', 'QA', 'QA.png', '974', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(180, 'Reunion', 'RE', 'RE.png', '262', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(181, 'Romania', 'RO', 'RO.png', '40', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(182, 'Russia', 'RU', 'RU.png', '7', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(183, 'Rwanda', 'RW', 'RW.png', '250', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(184, 'Saint Barthelemy', 'BL', 'BL.png', '590', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(185, 'Saint Helena', 'SH', 'SH.png', '290', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(186, 'Saint Kitts and Nevis', 'KN', 'KN.png', '1+869', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(187, 'Saint Lucia', 'LC', 'LC.png', '1+758', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(188, 'Saint Martin', 'MF', 'MF.png', '590', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(189, 'Saint Pierre and Miquelon', 'PM', 'PM.png', '508', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(190, 'Saint Vincent and the Grenadines', 'VC', 'VC.png', '1+784', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(191, 'Samoa', 'WS', 'WS.png', '685', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(192, 'San Marino', 'SM', 'SM.png', '378', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(193, 'Sao Tome and Principe', 'ST', 'ST.png', '239', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(194, 'Saudi Arabia', 'SA', 'SA.png', '966', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(195, 'Senegal', 'SN', 'SN.png', '221', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(196, 'Serbia', 'RS', 'RS.png', '381', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(197, 'Seychelles', 'SC', 'SC.png', '248', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(198, 'Sierra Leone', 'SL', 'SL.png', '232', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(199, 'Singapore', 'SG', 'SG.png', '65', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(200, 'Sint Maarten', 'SX', 'SX.png', '1+721', '2015-07-10 21:20:00', '0000-00-00 00:00:00'),
(201, 'Slovakia', 'SK', 'SK.png', '421', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(202, 'Slovenia', 'SI', 'ST.png', '386', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(203, 'Solomon Islands', 'SB', 'SB.png', '677', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(204, 'Somalia', 'SO', 'SO.png', '252', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(205, 'South Africa', 'ZA', 'ZA.png', '27', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(206, 'South Georgia and the South Sandwich Islands', 'GS', 'GS.png', '500', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(207, 'South Korea', 'KR', 'KR.png', '82', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(208, 'South Sudan', 'SS', 'SS.png', '211', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(209, 'Spain', 'ES', 'ES.png', '34', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(210, 'Sri Lanka', 'LK', 'LK.png', '94', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(211, 'Sudan', 'SD', 'SD.png', '249', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(212, 'Suriname', 'SR', 'SR.png', '597', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(213, 'Svalbard and Jan Mayen', 'SJ', 'SJ.png', '47', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(214, 'Swaziland', 'SZ', 'SZ.png', '268', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(215, 'Sweden', 'SE', 'SE.png', '46', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(216, 'Switzerland', 'CH', 'CH.png', '41', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(217, 'Syria', 'SY', 'SY.png', '963', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(218, 'Taiwan', 'TW', 'TW.png', '886', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(219, 'Tajikistan', 'TJ', 'TJ.png', '992', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(220, 'Tanzania', 'TZ', 'TZ.png', '255', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(221, 'Thailand', 'TH', 'TH.png', '66', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(222, 'Timor-Leste (East Timor)', 'TL', 'TL.png', '670', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(223, 'Togo', 'TG', 'TG.png', '228', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(224, 'Tokelau', 'TK', 'TK.png', '690', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(225, 'Tonga', 'TO', 'TO.png', '676', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(226, 'Trinidad and Tobago', 'TT', 'TT.png', '1+868', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(227, 'Tunisia', 'TN', 'TN.png', '216', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(228, 'Turkey', 'TR', 'TR.png', '90', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(229, 'Turkmenistan', 'TM', 'TM.png', '993', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(230, 'Turks and Caicos Islands', 'TC', 'TC.png', '1+649', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(231, 'Tuvalu', 'TV', 'TV.png', '688', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(232, 'Uganda', 'UG', 'UG.png', '256', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(233, 'Ukraine', 'UA', 'UA.png', '380', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(234, 'United Arab Emirates', 'AE', 'AE.png', '971', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(235, 'United Kingdom', 'GB', 'GB.png', '44', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(236, 'United States', 'US', 'US.png', '1', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(237, 'United States Minor Outlying Islands', 'UM', 'UM.png', 'NONE', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(238, 'Uruguay', 'UY', 'UY.png', '598', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(239, 'Uzbekistan', 'UZ', 'UZ.png', '998', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(240, 'Vanuatu', 'VU', 'VU.png', '678', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(241, 'Vatican City', 'VA', 'VA.png', '39', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(242, 'Venezuela', 'VE', 'VE.png', '58', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(243, 'Vietnam', 'VN', 'VN.png', '84', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(244, 'Virgin Islands, British', 'VG', 'VG.png', '1+284', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(245, 'Virgin Islands, US', 'VI', 'VI.png', '1+340', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(246, 'Wallis and Futuna', 'WF', 'WF.png', '681', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(247, 'Western Sahara', 'EH', 'EH.png', '212', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(248, 'Yemen', 'YE', 'YE.png', '967', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(249, 'Zambia', 'ZM', 'ZM.png', '260', '2015-07-10 21:28:15', '0000-00-00 00:00:00'),
(250, 'Zimbabwe', 'ZW', 'ZW.png', '263', '2015-07-10 21:28:15', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cpf_payments`
--

CREATE TABLE `cpf_payments` (
  `id` int(11) NOT NULL,
  `staff_information` text NOT NULL,
  `month` varchar(255) NOT NULL,
  `payment_date` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `employee` varchar(255) NOT NULL,
  `employer` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cpf_setting`
--

CREATE TABLE `cpf_setting` (
  `id` int(11) NOT NULL,
  `salary` varchar(255) NOT NULL,
  `condition1` int(11) NOT NULL,
  `condition2` int(11) NOT NULL,
  `employee` float NOT NULL,
  `employer` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cpf_setting`
--

INSERT INTO `cpf_setting` (`id`, `salary`, `condition1`, `condition2`, `employee`, `employer`, `created_at`, `updated_at`) VALUES
(1, '750', 0, 35, 20, 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, '750', 35, 45, 20, 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, '750', 45, 50, 20, 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, '750', 50, 55, 19, 16, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, '750', 55, 60, 13, 12, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, '750', 60, 65, 7.5, 8.5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, '750', 65, 0, 5, 7.5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, '500', 0, 35, 60, 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, '500', 35, 45, 60, 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, '500', 45, 50, 60, 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, '500', 50, 55, 57, 16, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, '500', 55, 60, 39, 12, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, '500', 60, 65, 22.5, 8.5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, '500', 65, 0, 15, 7.5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, '5000', 0, 0, 1000, 800, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cron_job`
--

CREATE TABLE `cron_job` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `return` text COLLATE utf8_unicode_ci NOT NULL,
  `runtime` float(8,2) NOT NULL,
  `cron_manager_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cron_manager`
--

CREATE TABLE `cron_manager` (
  `id` int(10) UNSIGNED NOT NULL,
  `rundate` datetime NOT NULL,
  `runtime` float(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL,
  `method` varchar(50) DEFAULT NULL,
  `description` text NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `method`, `description`, `is_active`) VALUES
(1, 'price', 'a:3:{s:5:\"price\";s:5:\"59.99\";s:13:\"discount_rate\";s:1:\"5\";s:6:\"remark\";s:11:\"5% Discount\";}', 1),
(2, 'qty', 'a:3:{s:3:\"qty\";s:3:\"100\";s:13:\"discount_rate\";s:2:\"10\";s:6:\"remark\";s:12:\"10% Discount\";}', 0);

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `legend` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`name`, `subject`, `content`, `legend`, `updated_at`, `id`) VALUES
('member_register', 'Activate Your Account   ', '<p><span style=\"line-height: 1.6em;\">Hello {USERNAME}</span></p>\n\n<p>{NEWLINE}</p>\n\n<p>Please activate your account using the following link.</p>\n\n<p>{NEWLINE} ---------------------------------------------- {NEWLINE}</p>\n\n<p>{LINK}</p>\n\n<p>---------------------------------------------- {NEWLINE}</p>\n\n<p style=\"margin: 0px 0px 10px; color: rgb(0, 0, 0); font-family: \'Open Sans\', sans-serif; line-height: 20px; border-radius: 0px !important;\">Thanks and Best regards,</p>\n\n<p style=\"margin: 0px 0px 10px; color: rgb(0, 0, 0); font-family: \'Open Sans\', sans-serif; line-height: 20px; border-radius: 0px !important;\">Customer Response Team</p>\n', '', '2015-10-27 07:47:10', 1),
('member_forgot_password', 'This is your new password ', '<p>{NEWLINE}</p>\n\n<p>Your password has been reset. {NEWLINE}</p>\n\n<p>User name : {USERNAME} {NEWLINE}</p>\n\n<p>Your new password is : {PASSWORD} {NEWLINE}</p>\n\n<p>Please Login in here {LINK} {NEWLINE}</p>\n\n<p style=\"margin: 0px 0px 10px; color: rgb(0, 0, 0); font-family: \'Open Sans\', sans-serif; line-height: 20px; border-radius: 0px !important;\">From..</p>\n\n<p style=\"margin: 0px 0px 10px; color: rgb(0, 0, 0); font-family: \'Open Sans\', sans-serif; line-height: 20px; border-radius: 0px !important;\">Customer Response Team</p>\n', '{PASSWORD}', '2015-10-27 07:47:20', 3),
('sent_through', 'Shipment process(sent through)', 'Hi Mr/Mrs {NAME},  \n\nYour shipment of the consignment number\n{CONSIGNMENT} has been sent through with Courier Name ({COURIERNAME}) and Courier No ({COURIERNO}).\n\nThank you for your order.\n{NEWLINE}\nBest Regards,\nCustomer Response Team', '', '2015-09-21 06:49:54', 9),
('delivered_on', 'Shipment process(delivered on)', 'Hi Mr/Mrs {NAME},  \n\nYour shipment of the consignment no {CONSIGNMENT}  has been delivered on {DELIEVERED}.\n\nThank you for your order.\n{NEWLINE}\nBest Regards,\nCustomer Response Team', '', '2015-09-21 07:40:16', 10),
('charges_shipping', 'Shipment process(charges shipping)', 'Hi Mr/Mrs {NAME},  \n\nYour shipment of the consignment no {CONSIGNMENT}  has been delivered on {DELIEVERED} and sent through with Courier Name ({COURIERNAME}) and Courier No ({COURIERNO}).\n\nThank you for your order.\n{NEWLINE}\nBest Regards,\nCustomer Response Team', '', '2015-09-21 07:33:12', 11);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `expense_name` varchar(100) NOT NULL,
  `expense_amount` decimal(10,2) NOT NULL,
  `payment_date` int(11) NOT NULL,
  `cash` int(1) NOT NULL DEFAULT '0',
  `cheque` text,
  `enet` varchar(100) DEFAULT NULL,
  `other` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `expense_name`, `expense_amount`, `payment_date`, `cash`, `cheque`, `enet`, `other`, `created_at`, `updated_at`) VALUES
(1, 'test', '30.99', 1445967000, 1, NULL, NULL, NULL, '2015-10-27 09:25:55', '2015-10-27 09:25:55');

-- --------------------------------------------------------

--
-- Table structure for table `facebook_gallery`
--

CREATE TABLE `facebook_gallery` (
  `id` int(5) NOT NULL,
  `facebook_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facebook_gallery`
--

INSERT INTO `facebook_gallery` (`id`, `facebook_id`) VALUES
(1, '260330667334379');

-- --------------------------------------------------------

--
-- Table structure for table `footer_cms`
--

CREATE TABLE `footer_cms` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `text` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `footer_cms`
--

INSERT INTO `footer_cms` (`id`, `name`, `title`, `phone`, `email`, `fax`, `text`) VALUES
(1, 'first_column', 'About Us', NULL, NULL, NULL, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam sit nonummy nibh euismod tincidunt ut laoreet dolore magna aliquarm erat sit volutpat. Nostrud exerci tation ullamcorper suscipit lobortis nisl aliquip commodo consequat.'),
(2, 'third_column', 'https://www.facebook.com/facebook', NULL, NULL, NULL, NULL),
(3, 'fourth_column', 'Our Contacts', '300 323 3456', 'info@metronic.com', '300 323 1456', '<p>35, Lorem Lis Street, Park Ave</p>\n\n<p>California, US</p>\n');

-- --------------------------------------------------------

--
-- Table structure for table `fuels`
--

CREATE TABLE `fuels` (
  `id` int(10) UNSIGNED NOT NULL,
  `fuel_name` varchar(64) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fuels`
--

INSERT INTO `fuels` (`id`, `fuel_name`, `created_at`, `updated_at`) VALUES
(1, 'Petrol', '2015-07-13 20:27:52', '2015-07-13 20:28:08'),
(2, 'Gasoline', '2015-07-13 20:29:01', '2015-07-13 20:29:01'),
(3, 'Diesel', '2015-07-13 20:29:15', '2015-07-13 20:29:15');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `alt` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `name`, `image`, `alt`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Shirt', 'bafd25effe78f3eb7b55b21eaea9ed03le-coq-sportif-tee-shirt-brassard-rayures-adulte.jpg', 'Yellow', 'Shirt', '2015-12-01 09:08:46', '2016-01-19 05:21:23'),
(2, 'T-shirt', '72d8538c3da2faf117494f4d447a3a41le-coq-sportif-tee-shirt-brassard-rayures-adulte (1).jpg', 'Grey', 'T-shirt', '2015-12-02 03:54:26', '2015-12-02 03:54:26');

-- --------------------------------------------------------

--
-- Table structure for table `general_setting`
--

CREATE TABLE `general_setting` (
  `id` int(11) NOT NULL,
  `format` text,
  `symbol` varchar(50) DEFAULT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `general_setting`
--

INSERT INTO `general_setting` (`id`, `format`, `symbol`, `type`) VALUES
(1, '{dd}/{mm}/{YY}', NULL, 'date_format'),
(2, 'Asia/Rangoon', NULL, 'timezone'),
(3, 'GLB', NULL, 'prefix'),
(4, 'zinaung@official-crystal.com', NULL, 'from_email'),
(5, 'ptaung4@gmail.com', NULL, 'to_email'),
(6, 'MMK', 'Ks', 'currency'),
(7, 'inactive', NULL, 'facebook_gallery'),
(8, 'active', NULL, 'gallery'),
(9, 'a:5:{s:5:\"phone\";s:12:\"300 323 3456\";s:5:\"email\";s:17:\"company@gmail.com\";s:7:\"address\";s:46:\"35, Lorem Lis Street, Park Ave, California, US\";s:3:\"fax\";s:0:\"\";s:8:\"landline\";s:0:\"\";}', NULL, 'company_info'),
(10, 'default', NULL, 'theme'),
(11, '1', NULL, 'login_attempt'),
(12, '5', NULL, 'login_freeze');

-- --------------------------------------------------------

--
-- Table structure for table `gst`
--

CREATE TABLE `gst` (
  `id` int(5) NOT NULL,
  `tax` float NOT NULL,
  `is_apply` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gst`
--

INSERT INTO `gst` (`id`, `tax`, `is_apply`) VALUES
(1, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `incomes`
--

CREATE TABLE `incomes` (
  `id` int(11) NOT NULL,
  `income_name` varchar(100) NOT NULL,
  `income_amount` decimal(10,2) NOT NULL,
  `received_date` int(11) NOT NULL,
  `cash` int(1) NOT NULL DEFAULT '0',
  `cheque` text,
  `enet` varchar(100) DEFAULT NULL,
  `other` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `incomes`
--

INSERT INTO `incomes` (`id`, `income_name`, `income_amount`, `received_date`, `cash`, `cheque`, `enet`, `other`, `created_at`, `updated_at`) VALUES
(1, 'test', '34.00', 1445880600, 1, NULL, NULL, NULL, '2015-10-27 09:29:27', '2015-10-27 09:29:27'),
(2, 'Test Income', '55.45', 1449682200, 1, NULL, NULL, NULL, '2015-12-11 03:52:01', '2015-12-11 03:52:01'),
(3, 'Test Income', '30.99', 1447090200, 1, NULL, NULL, NULL, '2015-12-11 03:52:46', '2015-12-11 03:52:46');

-- --------------------------------------------------------

--
-- Table structure for table `length`
--

CREATE TABLE `length` (
  `id` int(10) UNSIGNED NOT NULL,
  `length_name` varchar(64) NOT NULL,
  `length_sample` varchar(64) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `length`
--

INSERT INTO `length` (`id`, `length_name`, `length_sample`, `created_at`, `updated_at`) VALUES
(1, 'Millimeter', 'mm', '2015-07-09 22:08:17', '2015-07-09 22:15:27');

-- --------------------------------------------------------

--
-- Table structure for table `menu_setting`
--

CREATE TABLE `menu_setting` (
  `id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `header_ordering` int(11) NOT NULL,
  `header_active` int(1) NOT NULL DEFAULT '0',
  `footer_ordering` int(11) NOT NULL,
  `footer_active` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_setting`
--

INSERT INTO `menu_setting` (`id`, `page_id`, `parent_id`, `header_ordering`, `header_active`, `footer_ordering`, `footer_active`) VALUES
(1, 1, 2, 0, 1, 0, 1),
(2, 2, 0, 0, 1, 1, 1),
(3, 3, 1, 0, 1, 2, 1),
(4, 4, 0, 2, 1, 0, 0),
(5, 5, 0, 1, 1, 0, 0),
(6, 6, 5, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `action_name` varchar(60) NOT NULL,
  `message` text NOT NULL,
  `message_media` enum('email','sms','both') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `action_name`, `message`, `message_media`, `created_at`, `updated_at`) VALUES
(1, 'START GREETING', 'Dear NAME,', 'both', '2015-08-14 19:40:00', '2015-08-14 19:40:00'),
(2, 'ACCOUNT ACTIVATION', 'Welcome to Global Ecommerce. Please enter the SMS to get 4-digit activation code. Then go to the following link and submit the code to complete registration.', 'email', '2015-08-14 19:42:00', '2015-08-14 19:42:00'),
(3, 'END GREETING', '--Global Ecommerce', 'both', '2015-08-14 19:45:00', '2015-08-14 19:45:00'),
(4, 'SMS 2FA', 'Please check your mailbox to get the activation link. Click the link and type 2FA in the input box to complete registration.', 'sms', '2015-08-14 19:50:00', '2015-08-14 19:50:00');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2013_06_27_143953_create_cronmanager_table', 1),
('2013_06_27_144035_create_cronjob_table', 1),
('2015_01_01_161758_create_userss_table', 2),
('2015_01_27_080304_create_sessions_table', 2),
('2015_07_09_151611_create_colors_table', 2),
('2015_07_09_151752_create_sizes_table', 2),
('2015_07_09_151846_create_length_table', 2),
('2015_07_09_151956_create_weight_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `offlinesales`
--

CREATE TABLE `offlinesales` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `cash` int(1) NOT NULL DEFAULT '0',
  `cheque` text,
  `enet` varchar(100) DEFAULT NULL,
  `other` varchar(255) DEFAULT NULL,
  `member_name` varchar(200) NOT NULL,
  `email_address` varchar(200) NOT NULL,
  `address` varchar(300) NOT NULL,
  `mobile_no` varchar(50) NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `per_price` decimal(10,2) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `selling_date` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offlinesales`
--

INSERT INTO `offlinesales` (`id`, `product_id`, `cash`, `cheque`, `enet`, `other`, `member_name`, `email_address`, `address`, `mobile_no`, `order_quantity`, `per_price`, `total_amount`, `selling_date`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL, NULL, 'Aung Aung', 'aung@gmail.com', 'Yangon', '1234567', 1, '39.95', '39.95', 1446139800, '2015-10-29 03:45:00', '2015-10-26 16:07:09'),
(2, 1, 1, NULL, NULL, NULL, 'Phyu Thinn', 'ptaung4@gmail.com', 'No.7/.....', '12345678', 1, '39.95', '39.95', 1446139800, '2015-10-29 03:45:01', '2015-10-26 16:15:10');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `shipment_level` int(1) NOT NULL,
  `bill_no` varchar(20) NOT NULL,
  `guest` text,
  `order_quantity` int(11) NOT NULL,
  `original_price` decimal(10,2) NOT NULL,
  `discount` float NOT NULL,
  `gst` float NOT NULL,
  `order_date` datetime NOT NULL,
  `payment_method` varchar(20) NOT NULL,
  `is_paid` int(1) NOT NULL DEFAULT '0',
  `cash` int(1) NOT NULL,
  `cheque` text,
  `other` varchar(255) DEFAULT NULL,
  `enet` varchar(100) DEFAULT NULL,
  `courier_name` varchar(255) NOT NULL,
  `courier_no` varchar(255) NOT NULL,
  `delivered_on` int(11) NOT NULL,
  `receipt` int(1) NOT NULL DEFAULT '0',
  `is_cancel` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `member_id`, `product_id`, `shipment_level`, `bill_no`, `guest`, `order_quantity`, `original_price`, `discount`, `gst`, `order_date`, `payment_method`, `is_paid`, `cash`, `cheque`, `other`, `enet`, `courier_name`, `courier_no`, `delivered_on`, `receipt`, `is_cancel`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 3, '7523691E5F', NULL, 1, '39.95', 0, 7, '2015-10-26 13:22:49', 'offline', 0, 0, NULL, NULL, NULL, 'test', '1234', 1446139800, 0, 0, '2015-10-26 06:52:49', '2015-10-26 06:52:49');

-- --------------------------------------------------------

--
-- Table structure for table `other_setting`
--

CREATE TABLE `other_setting` (
  `id` int(10) NOT NULL,
  `type` varchar(100) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `sign` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `other_setting`
--

INSERT INTO `other_setting` (`id`, `type`, `address`, `phone`, `description`, `position`, `name`, `sign`) VALUES
(1, 'receipt', 'No.7, Yadanar Street, Yangon, Myanmar', '012345', 'Thank You for your support', 'HR', 'Kitty', '190cc35d58deeb2d6bf72f0a0faf1a58sign.jpg'),
(2, 'invoice', 'No.7, Yadanar Street, Yangon, Myanmar', '123456', 'Thank You', 'Manager', 'Jerry', '51780c88d4fadc26d425d7560f1fe8d2s.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'about_us', 'About Us', '<h4><strong>Nemo enim ipsam voluptatem quia voluptas sit</strong></h4>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.&nbsp;<br />\r\n<br />\r\nUt enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&nbsp;<br />\r\n<br />\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\r\n\r\n<h4><strong>Nemo enim ipsam voluptatem</strong></h4>\r\n\r\n<p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?</p>\r\n\r\n<h4><strong>Et harum quidem rerum facilis est</strong></h4>\r\n\r\n<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>\r\n', 'e6d130494ca0798c27840ee71b084208about.jpg', '2015-12-03 02:59:40', '2017-07-27 07:51:06'),
(2, 'our_service', 'Our Service', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam sit nonummy nibh euismod tincidunt ut laoreet dolore magna aliquarm erat sit volutpat. Nostrud exerci tation ullamcorper suscipit lobortis nisl aliquip commodo consequat.</p>\n', '99574871aab204d2e66d6f12e0fdc27babout.jpg', '2015-12-03 07:59:43', '2015-12-03 07:59:43'),
(3, 'terms_and_conditions', 'Terms and Conditions', '', NULL, '2015-12-03 08:55:46', '2015-12-03 08:55:46'),
(4, 'contact', 'Contact Us', '<p>Lorem ipsum dolor sit amet, Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat consectetuer adipiscing elit, sed diam nonummy nibh euismod tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>\r\n', NULL, '2015-12-04 04:09:00', '2015-12-07 05:45:53'),
(5, 'products', 'Products', NULL, NULL, '2015-12-07 02:43:00', '2015-12-07 02:43:00'),
(6, 'gallery', 'Gallery', NULL, NULL, '2015-12-07 06:23:00', '2015-12-07 06:23:00');

-- --------------------------------------------------------

--
-- Table structure for table `paypal_transaction`
--

CREATE TABLE `paypal_transaction` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(30) DEFAULT NULL,
  `order_bill_no` varchar(20) DEFAULT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission` varchar(255) CHARACTER SET latin1 NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `role_id`, `permission`, `created_at`, `updated_at`) VALUES
(1, 1, 'user', 0, 0),
(2, 1, 'role', 0, 0),
(3, 1, 'module', 0, 0),
(34, 1, 'backup', 0, 0),
(35, 1, 'general', 0, 0),
(40, 1, 'brand', 0, 0),
(41, 1, 'category', 0, 0),
(42, 1, 'subcategory', 0, 0),
(44, 1, 'product_info', 0, 0),
(45, 1, 'color', 0, 0),
(46, 1, 'size', 0, 0),
(47, 1, 'length', 0, 0),
(48, 1, 'weight', 0, 0),
(49, 1, 'country', 0, 0),
(50, 1, 'fuel', 0, 0),
(51, 1, 'product', 0, 0),
(52, 1, 'slider', 0, 0),
(53, 1, 'member', 0, 0),
(54, 1, 'discount', 0, 0),
(55, 1, 'gst', 0, 0),
(56, 1, 'shipping', 0, 0),
(57, 1, 'order', 0, 0),
(58, 1, 'account', 0, 0),
(59, 1, 'profitandloss', 0, 0),
(60, 1, 'review', 0, 0),
(61, 1, 'gallery', 0, 0),
(62, 1, 'pages', 0, 0),
(63, 1, 'footer', 0, 0),
(64, 1, 'header', 0, 0),
(65, 1, 'staff', 0, 0),
(66, 1, 'salary_payment', 0, 0),
(67, 1, 'cpf', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(64) NOT NULL,
  `slug` varchar(64) NOT NULL,
  `quantity` int(11) NOT NULL,
  `quantity_use` int(11) NOT NULL,
  `product_no` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `discount` int(2) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `brand` int(11) NOT NULL,
  `more_data` text NOT NULL,
  `country_id` int(11) NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(100) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `is_delete` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `slug`, `quantity`, `quantity_use`, `product_no`, `description`, `price`, `discount`, `category_id`, `subcategory_id`, `brand`, `more_data`, `country_id`, `meta_title`, `meta_keywords`, `meta_description`, `is_active`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'TESTING Product', 'testing-product', 5, 0, 'REF: 2500365-5', '<p>Mens Cobalt Basic Essential T-shirt by Le Coq Sportif</p>\r\n', '20.55', 2, 1, 1, 1, 'a:5:{s:6:\"colors\";s:1:\"1\";s:5:\"sizes\";s:1:\"1\";s:6:\"length\";N;s:6:\"weight\";N;s:5:\"fuels\";N;}', 12, '', '', '', 1, 0, '2015-12-22 08:19:10', '2015-12-23 03:23:02'),
(2, 'BASIC T-SHIRT IN COBALT', 'basic-t-shirt-in-cobalt', 10, 3, 'REF: 2500365-1', '<p>Mens Cobalt Basic Essential T-shirt by Le Coq Sportif</p>\r\n', '39.95', 2, 2, 4, 2, 'a:5:{s:6:\"colors\";s:1:\"5\";s:5:\"sizes\";s:1:\"1\";s:6:\"length\";N;s:6:\"weight\";N;s:5:\"fuels\";N;}', 14, '', '', '', 1, 0, '2015-10-26 15:13:31', '2015-10-26 09:32:31'),
(3, 'TESTING Product', 'testing-product-2', 20, 0, 'REF: 2500365-1', '<p>Mens Cobalt Basic Essential T-shirt by Le Coq Sportif</p>\r\n', '39.95', 2, 2, 4, 2, 'a:5:{s:6:\"colors\";s:1:\"2\";s:5:\"sizes\";s:1:\"1\";s:6:\"length\";N;s:6:\"weight\";N;s:5:\"fuels\";N;}', 14, '', '', '', 1, 0, '2015-12-22 08:17:00', '2015-12-23 03:23:30');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `image_order` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `image_order`) VALUES
(1, 1, 'c5a9904af7a6812f72558c9a41633aaebasic_colbalt_edit_large_.jpg', 1),
(2, 2, 'f1a8eff44f994bdb0459182e205de8e1le-coq-sportif-tee-shirt-brassard-rayures-adulte.jpg', 1),
(3, 3, '2006b1c5101c1244a908ec72e3ba4af9photo_booth.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_info`
--

CREATE TABLE `product_info` (
  `id` int(11) NOT NULL,
  `product_label` varchar(255) NOT NULL,
  `input_type` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_info`
--

INSERT INTO `product_info` (`id`, `product_label`, `input_type`, `created_at`, `updated_at`) VALUES
(1, 'Subtitle', 'text', '2015-10-26 13:56:07', '2015-10-26 13:56:07'),
(2, 'More Info', 'textarea', '2015-10-26 14:01:31', '2015-10-26 09:24:26'),
(3, 'Detail Info', 'textarea', '2015-10-26 14:14:03', '2015-10-26 09:24:24');

-- --------------------------------------------------------

--
-- Table structure for table `product_info_data`
--

CREATE TABLE `product_info_data` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_info_id` int(11) NOT NULL,
  `data` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_info_data`
--

INSERT INTO `product_info_data` (`id`, `product_id`, `product_info_id`, `data`) VALUES
(3, 2, 1, 'Shirt'),
(4, 2, 3, '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n'),
(5, 3, 1, 'Shirt'),
(6, 3, 3, '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n'),
(7, 1, 1, 'Shirt'),
(8, 1, 3, '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `staff_id` varchar(32) NOT NULL,
  `file` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `staff_id`, `file`, `created_at`, `updated_at`) VALUES
(1, '2', '1449825193_2profiles.jpg', '2015-12-11 09:13:13', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `profitandloss`
--

CREATE TABLE `profitandloss` (
  `id` int(11) NOT NULL,
  `from_date` int(11) NOT NULL,
  `to_date` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profitandloss`
--

INSERT INTO `profitandloss` (`id`, `from_date`, `to_date`, `created_at`, `updated_at`) VALUES
(1, 1443634200, 1446226200, '2015-10-26 08:13:56', '2015-10-26 08:13:56');

-- --------------------------------------------------------

--
-- Table structure for table `resumes`
--

CREATE TABLE `resumes` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` int(5) NOT NULL,
  `review` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `rating`, `review`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 3, 'Good..', '2015-11-11 03:25:40', '2015-11-11 03:25:40'),
(2, 2, 1, 2, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor ', '2015-11-11 04:08:37', '2015-11-11 04:08:37'),
(3, 4, 1, 2, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor', '2015-11-11 06:15:26', '2015-11-11 06:15:26'),
(4, 1, 1, 3, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor', '2015-12-07 07:57:41', '2015-12-07 07:57:41');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `role_desc` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `description`, `role_desc`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'Admin', '2015-06-16 20:43:21', '2015-06-16 20:43:21'),
(2, 'Member', 'Member', '2015-08-25 21:39:44', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `salary_payments`
--

CREATE TABLE `salary_payments` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `gross_salary` varchar(255) NOT NULL,
  `comission` varchar(255) NOT NULL,
  `overtime` varchar(255) NOT NULL,
  `conByEmp` varchar(255) NOT NULL,
  `salary_advance` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `payment_date` int(128) NOT NULL,
  `month` varchar(255) NOT NULL,
  `payment_info` text NOT NULL,
  `method` varchar(16) NOT NULL,
  `cpf_status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  `ip_address` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `user_data` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `payload`, `last_activity`, `ip_address`, `user_agent`, `user_data`) VALUES
('0950368748c3e0b8cdb4161e343086578231d5e8', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYnhZTmpCTFZmMlluaGgzVTlXNEhlNFBCQzRwcUZRS2ZMN21seFVXVCI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE1MjQyNzA1NjA7czoxOiJjIjtpOjE1MjQyNzA1NjA7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1524270560, '0', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `shipment_levels`
--

CREATE TABLE `shipment_levels` (
  `id` int(4) NOT NULL,
  `level_status_message` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipment_levels`
--

INSERT INTO `shipment_levels` (`id`, `level_status_message`) VALUES
(1, 'Your shipment under process'),
(2, 'Your shipment has been sent through'),
(3, 'Your shipment has been delieverd on');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `id` int(11) NOT NULL,
  `method` varchar(50) DEFAULT NULL,
  `description` text NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`id`, `method`, `description`, `is_active`) VALUES
(1, 'Free Shipping', 'a:1:{s:3:\"day\";s:1:\"5\";}', 1),
(2, 'Charges Shipping', 'a:2:{s:3:\"day\";s:1:\"2\";s:6:\"amount\";s:5:\"14.98\";}', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` int(10) UNSIGNED NOT NULL,
  `size_name` varchar(64) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `size_name`, `created_at`, `updated_at`) VALUES
(1, 'Small', '2015-07-09 21:36:35', '2015-07-09 21:46:40'),
(2, 'Medium', '2015-08-09 23:41:03', '2015-08-09 23:41:03'),
(3, 'Large', '2015-08-10 20:28:37', '2015-08-10 20:28:37');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(10) UNSIGNED NOT NULL,
  `slider_name` varchar(64) NOT NULL,
  `slider_image` varchar(128) NOT NULL,
  `description` varchar(128) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `slider_name`, `slider_image`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Slider', 'a420d2dccc1b0fb1a3edec89065fba6abg.jpg', '<p><strong>Tones of</strong></p>\r\n\r\n<p>shop UI features</p>\r\n\r\n<p><em>designed</em></p>\r\n', '2015-08-07 02:22:25', '2015-08-07 19:25:38'),
(2, 'Slider2', 'c65e8465b75df7e7a824d4ac8571bd4dbg.jpg', '<p><strong>Lorem ipsum</strong></p>\r\n\r\n<p>sit amet&nbsp;constectetuer</p>\r\n\r\n<p><em>diam</em></p>\r\n', '2015-08-07 02:24:05', '2015-08-07 19:26:41');

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `dob` int(11) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `salutation` varchar(255) NOT NULL,
  `ic_type` varchar(255) NOT NULL,
  `fin` varchar(255) NOT NULL,
  `fin_exp_date` varchar(255) NOT NULL,
  `ppn` varchar(255) NOT NULL,
  `ppn_exp_date` varchar(255) NOT NULL,
  `join_date` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `salary` double NOT NULL,
  `basic_salary` double NOT NULL,
  `tax` varchar(128) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `data` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`id`, `name`, `dob`, `designation`, `salutation`, `ic_type`, `fin`, `fin_exp_date`, `ppn`, `ppn_exp_date`, `join_date`, `email`, `salary`, `basic_salary`, `tax`, `status`, `data`, `created_at`, `updated_at`) VALUES
(2, 'Phyu', 672514200, 'Testing', 'mrs', 'Singaporean/PR(Pink/Blue) IC', '123456', '', '34211498536', '', 1436635800, 'ptaung4@gmail.com', 300, 300, '', 0, 'a:0:{}', '2015-12-11 09:10:19', '2015-12-11 09:10:19');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(11) NOT NULL,
  `stock_name` varchar(255) NOT NULL,
  `buying_date` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `bought_from` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `stock_name`, `buying_date`, `amount`, `quantity`, `bought_from`, `created_at`, `updated_at`) VALUES
(1, 'Test', 1446053400, '45.00', 2, 'test', '2015-10-29 05:11:37', '2015-10-29 05:11:37');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `subcategory_name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 1, 'Women\'s Dresses', 'womens-dresses', '2015-10-24 15:57:58', '2015-10-24 15:57:58'),
(2, 1, 'Women\'s Tops', 'womens-tops', '2015-10-24 15:59:14', '2015-10-24 15:59:14'),
(3, 1, 'Women\'s Skirts', 'womens-skirts', '2015-10-24 16:02:20', '2015-10-24 16:02:20'),
(4, 2, 'Men\'s T-Shirt', 'mens-shirt', '2015-10-26 03:44:46', '2015-10-26 15:14:46');

-- --------------------------------------------------------

--
-- Table structure for table `sub_permissions`
--

CREATE TABLE `sub_permissions` (
  `id` int(11) NOT NULL,
  `perm_id` int(11) NOT NULL,
  `description` varchar(255) CHARACTER SET latin1 NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_permissions`
--

INSERT INTO `sub_permissions` (`id`, `perm_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 43, 'view_product_info', 0, 0),
(2, 43, 'create_product_info', 0, 0),
(3, 43, 'edit_product_info', 0, 0),
(4, 43, 'delete_product_info', 0, 0),
(820, 1, 'view_user', 0, 0),
(821, 1, 'create_user', 0, 0),
(822, 1, 'edit_user', 0, 0),
(823, 1, 'delete_user', 0, 0),
(824, 2, 'view_role', 0, 0),
(825, 2, 'create_role', 0, 0),
(826, 2, 'edit_role', 0, 0),
(827, 2, 'delete_role', 0, 0),
(828, 3, 'view_module', 0, 0),
(829, 3, 'create_module', 0, 0),
(830, 3, 'edit_module', 0, 0),
(831, 3, 'delete_module', 0, 0),
(832, 34, 'view_backup', 0, 0),
(833, 34, 'create_backup', 0, 0),
(834, 34, 'edit_backup', 0, 0),
(835, 34, 'delete_backup', 0, 0),
(836, 35, 'view_general', 0, 0),
(837, 35, 'create_general', 0, 0),
(838, 35, 'edit_general', 0, 0),
(839, 35, 'delete_general', 0, 0),
(840, 40, 'view_brand', 0, 0),
(841, 40, 'create_brand', 0, 0),
(842, 40, 'edit_brand', 0, 0),
(843, 40, 'delete_brand', 0, 0),
(844, 41, 'view_category', 0, 0),
(845, 41, 'create_category', 0, 0),
(846, 41, 'edit_category', 0, 0),
(847, 41, 'delete_category', 0, 0),
(848, 42, 'view_subcategory', 0, 0),
(849, 42, 'create_subcategory', 0, 0),
(850, 42, 'edit_subcategory', 0, 0),
(851, 42, 'delete_subcategory', 0, 0),
(852, 44, 'view_product_info', 0, 0),
(853, 44, 'create_product_info', 0, 0),
(854, 44, 'edit_product_info', 0, 0),
(855, 44, 'delete_product_info', 0, 0),
(856, 45, 'view_color', 0, 0),
(857, 45, 'create_color', 0, 0),
(858, 45, 'edit_color', 0, 0),
(859, 45, 'delete_color', 0, 0),
(860, 46, 'view_size', 0, 0),
(861, 46, 'create_size', 0, 0),
(862, 46, 'edit_size', 0, 0),
(863, 46, 'delete_size', 0, 0),
(864, 47, 'view_length', 0, 0),
(865, 47, 'create_length', 0, 0),
(866, 47, 'edit_length', 0, 0),
(867, 47, 'delete_length', 0, 0),
(868, 48, 'view_weight', 0, 0),
(869, 48, 'create_weight', 0, 0),
(870, 48, 'edit_weight', 0, 0),
(871, 48, 'delete_weight', 0, 0),
(872, 49, 'view_country', 0, 0),
(873, 49, 'create_country', 0, 0),
(874, 49, 'edit_country', 0, 0),
(875, 49, 'delete_country', 0, 0),
(876, 50, 'view_fuel', 0, 0),
(877, 50, 'create_fuel', 0, 0),
(878, 50, 'edit_fuel', 0, 0),
(879, 50, 'delete_fuel', 0, 0),
(880, 51, 'view_product', 0, 0),
(881, 51, 'create_product', 0, 0),
(882, 51, 'edit_product', 0, 0),
(883, 51, 'delete_product', 0, 0),
(884, 52, 'view_slider', 0, 0),
(885, 52, 'create_slider', 0, 0),
(886, 52, 'edit_slider', 0, 0),
(887, 52, 'delete_slider', 0, 0),
(888, 53, 'view_member', 0, 0),
(889, 53, 'create_member', 0, 0),
(890, 53, 'edit_member', 0, 0),
(891, 53, 'delete_member', 0, 0),
(892, 54, 'view_discount', 0, 0),
(893, 54, 'edit_discount', 0, 0),
(894, 55, 'view_gst', 0, 0),
(895, 55, 'edit_gst', 0, 0),
(896, 56, 'view_shipping', 0, 0),
(897, 56, 'edit_shipping', 0, 0),
(898, 57, 'view_order', 0, 0),
(899, 57, 'create_order', 0, 0),
(900, 57, 'edit_order', 0, 0),
(901, 57, 'delete_order', 0, 0),
(902, 58, 'view_account', 0, 0),
(903, 58, 'create_account', 0, 0),
(904, 58, 'edit_account', 0, 0),
(905, 58, 'delete_account', 0, 0),
(906, 59, 'view_profitandloss', 0, 0),
(907, 59, 'create_profitandloss', 0, 0),
(908, 59, 'edit_profitandloss', 0, 0),
(909, 59, 'delete_profitandloss', 0, 0),
(910, 60, 'view_review', 0, 0),
(911, 60, 'create_review', 0, 0),
(912, 60, 'edit_review', 0, 0),
(913, 60, 'delete_review', 0, 0),
(914, 61, 'view_gallery', 0, 0),
(915, 61, 'create_gallery', 0, 0),
(916, 61, 'edit_gallery', 0, 0),
(917, 61, 'delete_gallery', 0, 0),
(918, 62, 'view_pages', 0, 0),
(919, 62, 'create_pages', 0, 0),
(920, 62, 'edit_pages', 0, 0),
(921, 62, 'delete_pages', 0, 0),
(922, 63, 'view_footer', 0, 0),
(923, 63, 'create_footer', 0, 0),
(924, 63, 'edit_footer', 0, 0),
(925, 64, 'view_header', 0, 0),
(926, 64, 'create_header', 0, 0),
(927, 64, 'edit_header', 0, 0),
(928, 65, 'view_staff', 0, 0),
(929, 65, 'create_staff', 0, 0),
(930, 65, 'edit_staff', 0, 0),
(931, 65, 'delete_staff', 0, 0),
(932, 66, 'view_salary_payment', 0, 0),
(933, 66, 'create_salary_payment', 0, 0),
(934, 66, 'edit_salary_payment', 0, 0),
(935, 66, 'delete_salary_payment', 0, 0),
(936, 67, 'view_cpf', 0, 0),
(937, 67, 'create_cpf', 0, 0),
(938, 67, 'edit_cpf', 0, 0),
(939, 67, 'delete_cpf', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `facebook_id` varchar(30) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `name` varchar(64) CHARACTER SET latin1 NOT NULL,
  `email` varchar(64) CHARACTER SET latin1 NOT NULL,
  `username` varchar(128) CHARACTER SET latin1 NOT NULL,
  `password` varchar(128) CHARACTER SET latin1 DEFAULT NULL,
  `neutral` varchar(5) CHARACTER SET latin1 DEFAULT NULL,
  `phone` int(8) NOT NULL,
  `landline` int(8) NOT NULL,
  `address` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `password_temp` varchar(60) CHARACTER SET latin1 DEFAULT NULL,
  `code` varchar(60) CHARACTER SET latin1 DEFAULT NULL,
  `activation` tinyint(4) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `facebook_id`, `name`, `email`, `username`, `password`, `neutral`, `phone`, `landline`, `address`, `country_id`, `password_temp`, `code`, `activation`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, '0', 'Administrator', 'zayzinaung@gmail.com', 'admin', '$2y$10$fX1/qkZzXg4QwfmiQ3iiLekkIIfirPEe3ro8Z4HoRvIkKb6Wgna1q', NULL, 0, 0, 'Evercrystal', 0, '$2y$10$fX1/qkZzXg4QwfmiQ3iiLekkIIfirPEe3ro8Z4HoRvIkKb6Wgna1q', 'ciWpMmEGwOGsMNbJmafuzFJXeqomvcGQdKSitiCyEnGpSlWxvRnPA15IQRn7', 1, 1, '2015-08-19 20:35:18', '2015-06-05 22:40:01'),
(2, 2, '0', 'Member', 'ptaung4@gmail.com', 'Phyu Thinn', '$2y$10$fX1/qkZzXg4QwfmiQ3iiLekkIIfirPEe3ro8Z4HoRvIkKb6Wgna1q', 'Mrs', 12345678, 12345, 'No.7/.....', 199, NULL, NULL, 1, 1, '2015-11-11 04:07:35', '2015-10-24 15:32:05'),
(3, 2, '988753654509581', 'Member', 'ptaung4@gmail.com', 'Phyu Thinn Aung', NULL, NULL, 0, 0, NULL, 0, NULL, NULL, 1, 1, '2015-11-11 03:09:51', '2015-11-11 03:09:51'),
(4, 2, '0', 'Member', 'jasmine@gmail.com', 'Jasmine', '$2y$10$fX1/qkZzXg4QwfmiQ3iiLekkIIfirPEe3ro8Z4HoRvIkKb6Wgna1q', 'Mrs', 12345678, 0, 'SG', 199, NULL, NULL, 1, 1, '2015-11-30 06:57:50', '2015-11-11 05:47:01'),
(5, 2, '0', 'Member', 'rose@gmail.com', 'Rose', '$2y$10$fX1/qkZzXg4QwfmiQ3iiLekkIIfirPEe3ro8Z4HoRvIkKb6Wgna1q', 'Mrs', 12345678, 0, 'Yangon', 151, NULL, NULL, 1, 1, '2015-11-11 06:05:09', '2015-11-11 06:04:34');

-- --------------------------------------------------------

--
-- Table structure for table `weight`
--

CREATE TABLE `weight` (
  `id` int(10) UNSIGNED NOT NULL,
  `weight_name` varchar(64) NOT NULL,
  `weight_sample` varchar(64) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `weight`
--

INSERT INTO `weight` (`id`, `weight_name`, `weight_sample`, `created_at`, `updated_at`) VALUES
(1, 'Kilogram', 'kg', '2015-07-09 23:10:22', '2015-07-09 23:10:22');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activation_codes`
--
ALTER TABLE `activation_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_lists`
--
ALTER TABLE `class_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staff_id` (`staff_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cpf_payments`
--
ALTER TABLE `cpf_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cpf_setting`
--
ALTER TABLE `cpf_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cron_job`
--
ALTER TABLE `cron_job`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cron_job_name_cron_manager_id_index` (`name`,`cron_manager_id`);

--
-- Indexes for table `cron_manager`
--
ALTER TABLE `cron_manager`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facebook_gallery`
--
ALTER TABLE `facebook_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footer_cms`
--
ALTER TABLE `footer_cms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fuels`
--
ALTER TABLE `fuels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_setting`
--
ALTER TABLE `general_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gst`
--
ALTER TABLE `gst`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incomes`
--
ALTER TABLE `incomes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `length`
--
ALTER TABLE `length`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_setting`
--
ALTER TABLE `menu_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offlinesales`
--
ALTER TABLE `offlinesales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `other_setting`
--
ALTER TABLE `other_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paypal_transaction`
--
ALTER TABLE `paypal_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `subcategory_id` (`subcategory_id`),
  ADD KEY `country_id` (`country_id`),
  ADD KEY `brand` (`brand`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_info`
--
ALTER TABLE `product_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_info_data`
--
ALTER TABLE `product_info_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `product_info_id` (`product_info_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profitandloss`
--
ALTER TABLE `profitandloss`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resumes`
--
ALTER TABLE `resumes`
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary_payments`
--
ALTER TABLE `salary_payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `staff_id_2` (`staff_id`);

--
-- Indexes for table `shipment_levels`
--
ALTER TABLE `shipment_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `sub_permissions`
--
ALTER TABLE `sub_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `weight`
--
ALTER TABLE `weight`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activation_codes`
--
ALTER TABLE `activation_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `class_lists`
--
ALTER TABLE `class_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT for table `cpf_payments`
--
ALTER TABLE `cpf_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cpf_setting`
--
ALTER TABLE `cpf_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `cron_job`
--
ALTER TABLE `cron_job`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cron_manager`
--
ALTER TABLE `cron_manager`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `facebook_gallery`
--
ALTER TABLE `facebook_gallery`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `footer_cms`
--
ALTER TABLE `footer_cms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fuels`
--
ALTER TABLE `fuels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `general_setting`
--
ALTER TABLE `general_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `gst`
--
ALTER TABLE `gst`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `incomes`
--
ALTER TABLE `incomes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `length`
--
ALTER TABLE `length`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu_setting`
--
ALTER TABLE `menu_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `offlinesales`
--
ALTER TABLE `offlinesales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `other_setting`
--
ALTER TABLE `other_setting`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `paypal_transaction`
--
ALTER TABLE `paypal_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_info`
--
ALTER TABLE `product_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_info_data`
--
ALTER TABLE `product_info_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profitandloss`
--
ALTER TABLE `profitandloss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `salary_payments`
--
ALTER TABLE `salary_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipment_levels`
--
ALTER TABLE `shipment_levels`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_permissions`
--
ALTER TABLE `sub_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=940;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `weight`
--
ALTER TABLE `weight`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contracts`
--
ALTER TABLE `contracts`
  ADD CONSTRAINT `contracts_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staffs` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`brand`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_info_data`
--
ALTER TABLE `product_info_data`
  ADD CONSTRAINT `product_info_data_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_info_data_ibfk_2` FOREIGN KEY (`product_info_id`) REFERENCES `product_info` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `resumes`
--
ALTER TABLE `resumes`
  ADD CONSTRAINT `resumes_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staffs` (`id`);

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
