-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2025 at 12:53 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newsportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('bb9a861a5ca65852da3b6a75c43617da', 'i:1;', 1751280541),
('bb9a861a5ca65852da3b6a75c43617da:timer', 'i:1751280541;', 1751280541);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `display_home` tinyint(4) NOT NULL DEFAULT 1,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `publish` tinyint(4) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `title`, `slug`, `image`, `description`, `display_home`, `meta_title`, `meta_keywords`, `meta_description`, `publish`, `position`, `created_at`, `updated_at`) VALUES
(5, 7, 'new test', 'new-test', 'uploads/category/new-test1750866450.jpg', '<p>new test</p>', 0, 'new test', 'new test', 'new test', 1, 1, '2025-06-25 10:02:30', '2025-06-29 00:17:06'),
(6, 0, 'second category', 'second-category', 'uploads/category/second-category1750923879.jpg', '<p>second category</p>', 0, 'second category', 'second category', 'second category', 1, 2, '2025-06-26 01:59:39', '2025-06-26 01:59:39'),
(7, 0, 'third category', 'third-category', 'uploads/category/third-category1751168911.jpg', '<p>test</p>', 0, 'third category', 'third category', 'third category', 1, 3, '2025-06-28 22:03:31', '2025-06-28 22:03:31');

-- --------------------------------------------------------

--
-- Table structure for table `category_news`
--

CREATE TABLE `category_news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `news_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `name` varchar(100) DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_code`, `name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'AF', 'Afghanistan', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(2, 'AL', 'Albania', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(3, 'DZ', 'Algeria', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(4, 'DS', 'American Samoa', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(5, 'AD', 'Andorra', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(6, 'AO', 'Angola', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(7, 'AI', 'Anguilla', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(8, 'AQ', 'Antarctica', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(9, 'AG', 'Antigua and Barbuda', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(10, 'AR', 'Argentina', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(11, 'AM', 'Armenia', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(12, 'AW', 'Aruba', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(13, 'AU', 'Australia', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(14, 'AT', 'Austria', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(15, 'AZ', 'Azerbaijan', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(16, 'BS', 'Bahamas', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(17, 'BH', 'Bahrain', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(18, 'BD', 'Bangladesh', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(19, 'BB', 'Barbados', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(20, 'BY', 'Belarus', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(21, 'BE', 'Belgium', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(22, 'BZ', 'Belize', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(23, 'BJ', 'Benin', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(24, 'BM', 'Bermuda', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(25, 'BT', 'Bhutan', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(26, 'BO', 'Bolivia', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(27, 'BA', 'Bosnia and Herzegovina', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(28, 'BW', 'Botswana', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(29, 'BV', 'Bouvet Island', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(30, 'BR', 'Brazil', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(31, 'IO', 'British Indian Ocean Territory', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(32, 'BN', 'Brunei Darussalam', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(33, 'BG', 'Bulgaria', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(34, 'BF', 'Burkina Faso', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(35, 'BI', 'Burundi', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(36, 'KH', 'Cambodia', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(37, 'CM', 'Cameroon', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(38, 'CA', 'Canada', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(39, 'CV', 'Cape Verde', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(40, 'KY', 'Cayman Islands', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(41, 'CF', 'Central African Republic', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(42, 'TD', 'Chad', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(43, 'CL', 'Chile', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(44, 'CN', 'China', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(45, 'CX', 'Christmas Island', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(46, 'CC', 'Cocos (Keeling) Islands', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(47, 'CO', 'Colombia', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(48, 'KM', 'Comoros', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(49, 'CG', 'Congo', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(50, 'CK', 'Cook Islands', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(51, 'CR', 'Costa Rica', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(52, 'HR', 'Croatia (Hrvatska)', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(53, 'CU', 'Cuba', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(54, 'CY', 'Cyprus', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(55, 'CZ', 'Czech Republic', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(56, 'DK', 'Denmark', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(57, 'DJ', 'Djibouti', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(58, 'DM', 'Dominica', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(59, 'DO', 'Dominican Republic', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(60, 'TP', 'East Timor', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(61, 'EC', 'Ecuador', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(62, 'EG', 'Egypt', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(63, 'SV', 'El Salvador', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(64, 'GQ', 'Equatorial Guinea', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(65, 'ER', 'Eritrea', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(66, 'EE', 'Estonia', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(67, 'ET', 'Ethiopia', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(68, 'FK', 'Falkland Islands (Malvinas)', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(69, 'FO', 'Faroe Islands', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(70, 'FJ', 'Fiji', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(71, 'FI', 'Finland', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(72, 'FR', 'France', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(73, 'FX', 'France, Metropolitan', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(74, 'GF', 'French Guiana', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(75, 'PF', 'French Polynesia', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(76, 'TF', 'French Southern Territories', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(77, 'GA', 'Gabon', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(78, 'GM', 'Gambia', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(79, 'GE', 'Georgia', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(80, 'DE', 'Germany', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(81, 'GH', 'Ghana', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(82, 'GI', 'Gibraltar', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(83, 'GK', 'Guernsey', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(84, 'GR', 'Greece', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(85, 'GL', 'Greenland', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(86, 'GD', 'Grenada', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(87, 'GP', 'Guadeloupe', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(88, 'GU', 'Guam', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(89, 'GT', 'Guatemala', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(90, 'GN', 'Guinea', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(91, 'GW', 'Guinea-Bissau', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(92, 'GY', 'Guyana', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(93, 'HT', 'Haiti', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(94, 'HM', 'Heard and Mc Donald Islands', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(95, 'HN', 'Honduras', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(96, 'HK', 'Hong Kong', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(97, 'HU', 'Hungary', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(98, 'IS', 'Iceland', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(99, 'IN', 'India', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(100, 'IM', 'Isle of Man', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(101, 'ID', 'Indonesia', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(102, 'IR', 'Iran (Islamic Republic of)', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(103, 'IQ', 'Iraq', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(104, 'IE', 'Ireland', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(105, 'IL', 'Israel', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(106, 'IT', 'Italy', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(107, 'CI', 'Ivory Coast', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(108, 'JE', 'Jersey', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(109, 'JM', 'Jamaica', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(110, 'JP', 'Japan', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(111, 'JO', 'Jordan', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(112, 'KZ', 'Kazakhstan', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(113, 'KE', 'Kenya', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(114, 'KI', 'Kiribati', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(115, 'KP', 'Korea, Democratic People\'s Republic of', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(116, 'KR', 'Korea, Republic of', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(117, 'XK', 'Kosovo', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(118, 'KW', 'Kuwait', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(119, 'KG', 'Kyrgyzstan', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(120, 'LA', 'Lao People\'s Democratic Republic', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(121, 'LV', 'Latvia', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(122, 'LB', 'Lebanon', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(123, 'LS', 'Lesotho', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(124, 'LR', 'Liberia', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(125, 'LY', 'Libyan Arab Jamahiriya', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(126, 'LI', 'Liechtenstein', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(127, 'LT', 'Lithuania', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(128, 'LU', 'Luxembourg', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(129, 'MO', 'Macau', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(130, 'MK', 'Macedonia', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(131, 'MG', 'Madagascar', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(132, 'MW', 'Malawi', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(133, 'MY', 'Malaysia', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(134, 'MV', 'Maldives', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(135, 'ML', 'Mali', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(136, 'MT', 'Malta', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(137, 'MH', 'Marshall Islands', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(138, 'MQ', 'Martinique', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(139, 'MR', 'Mauritania', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(140, 'MU', 'Mauritius', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(141, 'TY', 'Mayotte', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(142, 'MX', 'Mexico', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(143, 'FM', 'Micronesia, Federated States of', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(144, 'MD', 'Moldova, Republic of', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(145, 'MC', 'Monaco', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(146, 'MN', 'Mongolia', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(147, 'ME', 'Montenegro', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(148, 'MS', 'Montserrat', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(149, 'MA', 'Morocco', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(150, 'MZ', 'Mozambique', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(151, 'MM', 'Myanmar', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(152, 'NA', 'Namibia', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(153, 'NR', 'Nauru', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(154, 'NP', 'Nepal', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(155, 'NL', 'Netherlands', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(156, 'AN', 'Netherlands Antilles', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(157, 'NC', 'New Caledonia', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(158, 'NZ', 'New Zealand', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(159, 'NI', 'Nicaragua', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(160, 'NE', 'Niger', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(161, 'NG', 'Nigeria', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(162, 'NU', 'Niue', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(163, 'NF', 'Norfolk Island', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(164, 'MP', 'Northern Mariana Islands', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(165, 'NO', 'Norway', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(166, 'OM', 'Oman', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(167, 'PK', 'Pakistan', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(168, 'PW', 'Palau', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(169, 'PS', 'Palestine', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(170, 'PA', 'Panama', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(171, 'PG', 'Papua New Guinea', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(172, 'PY', 'Paraguay', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(173, 'PE', 'Peru', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(174, 'PH', 'Philippines', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(175, 'PN', 'Pitcairn', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(176, 'PL', 'Poland', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(177, 'PT', 'Portugal', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(178, 'PR', 'Puerto Rico', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(179, 'QA', 'Qatar', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(180, 'RE', 'Reunion', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(181, 'RO', 'Romania', 'uploads/country/romania1732683965.png', 1, '2024-11-26 17:25:09', '2024-11-26 23:21:05'),
(182, 'RU', 'Russian Federation', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(183, 'RW', 'Rwanda', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(184, 'KN', 'Saint Kitts and Nevis', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(185, 'LC', 'Saint Lucia', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(186, 'VC', 'Saint Vincent and the Grenadines', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(187, 'WS', 'Samoa', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(188, 'SM', 'San Marino', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(189, 'ST', 'Sao Tome and Principe', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(190, 'SA', 'Saudi Arabia', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(191, 'SN', 'Senegal', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(192, 'RS', 'Serbia', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(193, 'SC', 'Seychelles', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(194, 'SL', 'Sierra Leone', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(195, 'SG', 'Singapore', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(196, 'SK', 'Slovakia', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(197, 'SI', 'Slovenia', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(198, 'SB', 'Solomon Islands', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(199, 'SO', 'Somalia', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(200, 'ZA', 'South Africa', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(201, 'GS', 'South Georgia South Sandwich Islands', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(202, 'ES', 'Spain', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(203, 'LK', 'Sri Lanka', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(204, 'SH', 'St. Helena', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(205, 'PM', 'St. Pierre and Miquelon', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(206, 'SD', 'Sudan', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(207, 'SR', 'Suriname', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(208, 'SJ', 'Svalbard and Jan Mayen Islands', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(209, 'SZ', 'Swaziland', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(210, 'SE', 'Sweden', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(211, 'CH', 'Switzerland', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(212, 'SY', 'Syrian Arab Republic', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(213, 'TW', 'Taiwan', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(214, 'TJ', 'Tajikistan', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(215, 'TZ', 'Tanzania, United Republic of', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(216, 'TH', 'Thailand', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(217, 'TG', 'Togo', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(218, 'TK', 'Tokelau', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(219, 'TO', 'Tonga', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(220, 'TT', 'Trinidad and Tobago', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(221, 'TN', 'Tunisia', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(222, 'TR', 'Turkey', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(223, 'TM', 'Turkmenistan', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(224, 'TC', 'Turks and Caicos Islands', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(225, 'TV', 'Tuvalu', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(226, 'UG', 'Uganda', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(227, 'UA', 'Ukraine', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(228, 'AE', 'United Arab Emirates', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(229, 'GB', 'United Kingdom', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(230, 'US', 'United States', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(231, 'UM', 'United States minor outlying islands', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(232, 'UY', 'Uruguay', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(233, 'UZ', 'Uzbekistan', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(234, 'VU', 'Vanuatu', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(235, 'VA', 'Vatican City State', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(236, 'VE', 'Venezuela', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(237, 'VN', 'Vietnam', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(238, 'VG', 'Virgin Islands (British)', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(239, 'VI', 'Virgin Islands (U.S.)', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(240, 'WF', 'Wallis and Futuna Islands', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(241, 'EH', 'Western Sahara', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(242, 'YE', 'Yemen', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(243, 'ZR', 'Zaire', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(244, 'ZM', 'Zambia', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(245, 'ZW', 'Zimbabwe', NULL, 1, '2024-11-26 17:25:09', '2024-11-26 17:25:09'),
(247, '', 'my country', 'uploads/country/my-country1732643686.png', 1, '2024-11-26 12:09:46', '2024-11-26 12:09:46');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_06_24_092932_create_categories_table', 1),
(5, '2025_06_25_062801_add_two_factor_columns_to_users_table', 1),
(6, '2025_06_25_062842_create_personal_access_tokens_table', 1),
(7, '2025_06_26_092121_create_news_table', 2),
(8, '2025_06_26_095506_create_category_news_table', 3),
(9, '2025_06_29_072613_create_socials_table', 4),
(10, '2025_06_29_072624_create_settings_table', 4),
(11, '2025_06_29_072632_create_pages_table', 4),
(12, '2025_06_30_040217_create_permission_tables', 5);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(2, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `highlited_news` tinyint(4) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `publish` tinyint(4) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `delete_opt` tinyint(4) NOT NULL DEFAULT 0,
  `publish` tinyint(4) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(2, 'admin_table', 'web', '2025-06-29 23:21:39', '2025-06-30 01:24:09'),
(3, 'page_table', 'web', '2025-06-30 01:24:00', '2025-06-30 01:24:00');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(2, 'Superadmin', 'web', '2025-06-30 01:08:49', '2025-06-30 01:08:49'),
(3, 'Admin', 'web', '2025-06-30 01:16:33', '2025-06-30 01:16:33');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(2, 2),
(2, 3),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('cGEx8vo4aGocVwxzib6gpW3Nl9VADec4bGsD7IRT', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYVp1YnpCT3RzMWozZmZzUUFSVGpCanlJczc3c0JBamhKM3FFY1dYciI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1751280769);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_title` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_2` varchar(255) DEFAULT NULL,
  `landline` varchar(255) DEFAULT NULL,
  `landline_2` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `mobile_no_2` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `address` mediumtext DEFAULT NULL,
  `post_code` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `google_analytics` longtext DEFAULT NULL,
  `google_map` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` mediumtext DEFAULT NULL,
  `meta_description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_title`, `email`, `email_2`, `landline`, `landline_2`, `mobile_no`, `mobile_no_2`, `fax`, `address`, `post_code`, `logo`, `favicon`, `google_analytics`, `google_map`, `meta_title`, `meta_keywords`, `meta_description`, `created_at`, `updated_at`) VALUES
(3, 'Krishi', 'krishi@gmail.com', 'kris1hi@gmail.com', '1444558098', '1444558098', '9887765444', '9987654345', '123456789', 'test test', '7987989', 'uploads/setting/logo1751212830.jpg', 'uploads/setting/favicon1751212830.png', 'test', NULL, 'test', 'test', 'tet', '2025-06-29 10:02:39', '2025-06-29 10:15:30');

-- --------------------------------------------------------

--
-- Table structure for table `socials`
--

CREATE TABLE `socials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `publish` tinyint(4) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `detail` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `postcode` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_type` tinyint(4) NOT NULL DEFAULT 1,
  `publish` tinyint(4) NOT NULL DEFAULT 1,
  `is_dev` tinyint(4) NOT NULL DEFAULT 0,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `image`, `phone`, `detail`, `address`, `city`, `postcode`, `country`, `user_type`, `publish`, `is_dev`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Manaslu Infotech Nepal', 'manasluinfotech@gmail.com', NULL, '$2y$12$GLUnyf4GamwV46vsvXGLD.HFJ1uzfbMlKx77HeXhOyOMIWzbK4ETy', 'uploads/user/manaslu-infotech-nepal1751278316.jpg', '987876', 'test', NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-25 00:48:58', '2025-06-30 05:02:32'),
(2, 'Suman Neupane', 'suman@gmail.com', NULL, '$2y$12$lH.r1dRavpx8OKTpVrreXOXg9XBec7kTCMKlyrQNHlvtvr.THmCa.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-25 01:29:07', '2025-06-25 01:29:07'),
(3, 'Dipak', 'dipak@gmail.com', NULL, '$2y$12$UXpkm0K/5TbW0O6vHRSFYe7bzg.I15UMw6NH0AqswDAcSnnZpqJ/K', 'uploads/user/dipak1751277032.jpg', '98979766', 'test', NULL, NULL, NULL, NULL, 1, 1, 0, NULL, NULL, NULL, 'jmLc7LeR2GiGUrsVmhLKGoJ0JwWMvySyjY7GoLI5', NULL, NULL, '2025-06-30 03:47:13', '2025-06-30 04:05:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_news`
--
ALTER TABLE `category_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `socials`
--
ALTER TABLE `socials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `category_news`
--
ALTER TABLE `category_news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `socials`
--
ALTER TABLE `socials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
