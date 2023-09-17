-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 17, 2023 at 06:59 AM
-- Server version: 10.5.22-MariaDB-cll-lve
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `donatepu_live`
--

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE `campaigns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `goal_amount` int(11) NOT NULL,
  `country` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `campaign_status` varchar(30) NOT NULL DEFAULT 'running',
  `campaign_category_id` bigint(20) NOT NULL,
  `is_featured` tinyint(4) DEFAULT 0,
  `video_url` text DEFAULT NULL,
  `public_user_id` bigint(20) NOT NULL,
  `anonymous` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `slug` varchar(100) DEFAULT NULL,
  `images` text DEFAULT NULL,
  `cover_image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`id`, `title`, `description`, `start_date`, `end_date`, `goal_amount`, `country`, `address`, `campaign_status`, `campaign_category_id`, `is_featured`, `video_url`, `public_user_id`, `anonymous`, `created_at`, `updated_at`, `deleted_at`, `status`, `slug`, `images`, `cover_image`) VALUES
(21, 'Donate to Children', 'The vastness of space has always captivated the human imagination. Throughout history, we have looked to the stars with wonder and curiosity, seeking to unravel the mysteries that lie beyond our planet. Space exploration has come a long way since the early days of stargazing, and today, we have reached unprecedented levels of understanding about the universe around us.\r\n\r\nModern space exploration began with the launch of Sputnik 1 by the Soviet Union in 1957. Since then, numerous nations and organizations have joined the cosmic quest, sending astronauts, satellites, and probes to explore the cosmos. The Apollo moon missions of the late 1960s and early 1970s stand as a testament to human ingenuity and perseverance, with Neil Armstrong\'s iconic words as he stepped on the moon, \"That\'s one small step for man, one giant leap for mankind.\"\r\n\r\nThe vastness of space has always captivated the human imagination. Throughout history, we have looked to the stars with wonder and curiosity, seeking to unravel the mysteries that lie beyond our planet. Space exploration has come a long way since the early days of stargazing, and today, we have reached unprecedented levels of understanding about the universe around us.', '2023-09-03', '2023-07-19', 10000, 'nepal', 'Chorcha 7, Bhaktapur', 'completed', 1, 0, NULL, 27, 0, NULL, '2023-09-17 06:50:07', NULL, 1, 'donate-to-children-21', NULL, 'campaigns/MouLjeDH9uCxdEVzS1Z7.jpg'),
(22, 'Educational Campaign', 'No personal bank account/payment gateway details allowed to prevent fraud and money laundering. \r\nNo personal bank account/payment gateway details allowed to prevent fraud and money laundering. \r\nNo personal bank account/payment gateway details allowed to prevent fraud and money laundering. \r\nNo personal bank account/payment gateway details allowed to prevent fraud and money laundering. \r\nNo personal bank account/payment gateway details allowed to prevent fraud and money laundering. \r\nNo personal bank account/payment gateway details allowed to prevent fraud and money laundering. \r\nNo personal bank account/payment gateway details allowed to prevent fraud and money laundering. \r\nNo personal bank account/payment gateway details allowed to prevent fraud and money laundering. \r\nNo personal bank account/payment gateway details allowed to prevent fraud and money laundering. \r\nNo personal bank account/payment gateway details allowed to prevent fraud and money laundering. \r\nNo personal bank account/payment gateway details allowed to prevent fraud and money laundering. \r\nNo personal bank account/payment gateway details allowed to prevent fraud and money laundering. \r\nNo personal bank account/payment gateway details allowed to prevent fraud and money laundering.', '2023-09-01', '2023-09-09', 12345, 'nepal', 'Chorcha 7, India', 'completed', 1, 0, NULL, 27, 0, NULL, '2023-09-17 06:39:32', NULL, 1, 'educational-campaign', NULL, 'campaigns/ZTIYbI02YTLHKyCyWA3S.jpeg'),
(23, 'Drinking water Campation', 'No personal bank account/payment gateway details allowed to prevent fraud and money laundering. \r\nNo personal bank account/payment gateway details allowed to prevent fraud and money laundering. \r\nNo personal bank account/payment gateway details allowed to prevent fraud and money laundering. \r\nNo personal bank account/payment gateway details allowed to prevent fraud and money laundering. \r\nNo personal bank account/payment gateway details allowed to prevent fraud and money laundering. \r\nNo personal bank account/payment gateway details allowed to prevent fraud and money laundering. \r\nNo personal bank account/payment gateway details allowed to prevent fraud and money laundering. \r\nNo personal bank account/payment gateway details allowed to prevent fraud and money laundering. \r\nNo personal bank account/payment gateway details allowed to prevent fraud and money laundering. \r\nNo personal bank account/payment gateway details allowed to prevent fraud and money laundering. \r\nNo personal bank account/payment gateway details allowed to prevent fraud and money laundering. \r\nNo personal bank account/payment gateway details allowed to prevent fraud and money laundering. \r\nNo personal bank account/payment gateway details allowed to prevent fraud and money laundering.', '2023-09-03', '2023-09-22', 9000, 'india', 'Gaya 7, India', 'running', 1, 0, NULL, 27, 0, NULL, '2023-09-03 11:21:40', NULL, 1, 'drinking-water-campation', NULL, 'campaigns/0HBOQQzSTw34FXx1vy6v.jpeg');

-- --------------------------------------------------------

--
-- Stand-in structure for view `campaigns_summary_view`
-- (See below for the actual view)
--
CREATE TABLE `campaigns_summary_view` (
`id` bigint(20) unsigned
,`title` varchar(200)
,`description` text
,`start_date` date
,`end_date` date
,`goal_amount` int(11)
,`country` varchar(50)
,`address` varchar(50)
,`campaign_status` varchar(30)
,`campaign_category_id` bigint(20)
,`is_featured` tinyint(4)
,`video_url` text
,`public_user_id` bigint(20)
,`anonymous` tinyint(4)
,`created_at` timestamp
,`updated_at` timestamp
,`deleted_at` timestamp
,`status` tinyint(4)
,`slug` varchar(100)
,`images` text
,`cover_image` text
,`summary_total_collection` double
,`net_amount_collection` double(17,0)
,`total_visits` bigint(21)
,`summary_service_charge_amount` double(17,0)
,`total_number_donation` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `campaign_categories`
--

CREATE TABLE `campaign_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `cover_image` text NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `campaign_categories`
--

INSERT INTO `campaign_categories` (`id`, `title`, `status`, `cover_image`, `description`, `created_at`, `updated_at`, `slug`, `deleted_at`) VALUES
(1, 'Category 1', 1, 'campaign-categories/oqe5ygL8cvHtNbj4dwIO.png', 'sdfsdf', '2023-06-02 20:56:00', '2023-08-29 20:18:08', 'testtest', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `campaign_visits`
--

CREATE TABLE `campaign_visits` (
  `id` int(10) UNSIGNED NOT NULL,
  `campaign_id` int(11) NOT NULL,
  `latitude` text DEFAULT NULL,
  `longitude` text DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `campaign_visits`
--

INSERT INTO `campaign_visits` (`id`, `campaign_id`, `latitude`, `longitude`, `ip`, `created_at`, `updated_at`) VALUES
(2, 21, '27.67363', '85.4336003', '27.34.49.103', NULL, NULL),
(4, 21, '27.6736264', '86.4335946', '27.34.49.103', '2023-08-15 18:15:00', NULL),
(5, 21, '28.6736372', '85.4336059', '27.34.49.103', '2023-08-18 18:15:00', NULL),
(6, 22, NULL, NULL, '27.34.49.103', '2023-08-18 18:15:00', NULL),
(7, 22, NULL, NULL, '27.34.49.103', '2023-08-19 18:15:00', NULL),
(8, 22, '27.6736339', '85.4336058', '27.34.49.228', '2023-08-20 18:15:00', NULL),
(9, 21, '27.6851498', '85.3202849', '110.44.123.47', '2023-08-22 18:15:00', NULL),
(10, 22, '27.6851675', '85.3203187', '110.44.123.47', '2023-08-22 18:15:00', NULL),
(11, 22, '27.6736365', '85.4336313', '27.34.49.99', '2023-08-23 18:15:00', NULL),
(12, 21, '27.6851255', '85.3202902', '110.44.123.47', '2023-08-24 18:15:00', NULL),
(13, 22, '27.6736337', '85.4336455', '27.34.49.84', '2023-08-25 18:15:00', NULL),
(14, 22, '27.6736397', '85.4336305', '27.34.49.84', '2023-08-26 18:15:00', NULL),
(15, 22, '27.6736452', '85.4336234', '27.34.49.193', '2023-08-26 18:15:00', NULL),
(16, 22, '27.685123', '85.3202826', '110.44.123.47', '2023-08-27 18:15:00', NULL),
(17, 22, '27.6736143', '85.4336064', '27.34.49.120', '2023-08-29 18:15:00', NULL),
(18, 21, '27.6736193', '85.4336098', '27.34.49.120', '2023-08-29 18:15:00', NULL),
(19, 21, '27.6736338', '85.4336204', '27.34.49.120', '2023-08-30 00:00:00', NULL),
(20, 22, '27.6736345', '85.4336394', '27.34.49.120', '2023-08-30 00:00:00', NULL),
(21, 21, '27.664348', '85.4293989', '120.89.104.114', '2023-08-31 00:00:00', NULL),
(22, 23, '27.6643043', '85.4293741', '120.89.104.114', '2023-08-31 00:00:00', NULL),
(23, 22, '27.6736291', '85.4336123', '27.34.49.207', '2023-09-01 00:00:00', NULL),
(24, 23, '27.6736274', '85.4336035', '27.34.49.207', '2023-09-01 00:00:00', NULL),
(25, 22, '27.6736226', '85.4336096', '110.44.123.47', '2023-09-03 00:00:00', NULL),
(26, 21, '27.6736414', '85.4336105', '27.34.49.243', '2023-09-03 00:00:00', NULL),
(27, 21, '27.6760671', '85.4356342', '27.34.49.30', '2023-09-03 00:00:00', NULL),
(28, 21, '27.6851262', '85.3203426', '110.44.123.47', '2023-09-04 00:00:00', NULL),
(29, 23, '27.6736302', '85.4336084', '27.34.49.145', '2023-09-06 18:15:00', NULL),
(30, 21, '27.6736288', '85.4336044', '27.34.49.145', '2023-09-07 00:00:00', NULL),
(31, 23, '27.6736305', '85.4336063', '27.34.49.145', '2023-09-07 00:00:00', NULL),
(32, 23, '27.6851147', '85.3203061', '110.44.123.47', '2023-09-08 00:00:00', NULL),
(33, 22, '27.6851127', '85.3203152', '110.44.123.47', '2023-09-11 00:00:00', NULL),
(34, 23, '27.6850976', '85.3203515', '110.44.123.47', '2023-09-12 00:00:00', NULL),
(35, 23, '27.6736403', '85.4336098', '27.34.49.59', '2023-09-16 00:00:00', NULL),
(36, 23, '27.6736257', '85.433605', '27.34.49.10', '2023-09-17 00:00:00', NULL),
(37, 21, '27.67363', '85.4336065', '27.34.49.10', '2023-09-17 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `order`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 'Category 1', 'category-1', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(2, NULL, 1, 'Category 2', 'category-2', '2023-06-02 20:05:53', '2023-06-02 20:05:53');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `message` varchar(2000) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `message`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'sdfhjskdkj', 'kjdhfkjsdh@asda.com', 'sdfsdf', 'jkshdkjfhsdf', NULL, NULL),
(2, 'Rabi Gorkhali', 'rabigorkhaly@gmail.com', 'dfg', '9843169319', '2023-06-17 23:32:02', NULL),
(3, 'Rabi Gorkhali', 'rabigorkhaly@gmail.com', 'dfsf', '9843169319', '2023-06-19 05:36:13', NULL),
(4, 'Rabi Gorkhali', 'rabigorkhaly@gmail.com', 'JUst Now', '9843169319', '2023-06-19 05:37:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `code`) VALUES
(1, 'Afghanistan', 'AF'),
(2, 'Albania', 'AL'),
(3, 'Algeria', 'DZ'),
(4, 'Andorra', 'AD'),
(5, 'Angola', 'AO'),
(6, 'Antigua and Barbuda', 'AG'),
(7, 'Argentina', 'AR'),
(8, 'Armenia', 'AM'),
(9, 'Australia', 'AU'),
(10, 'Austria', 'AT'),
(11, 'Azerbaijan', 'AZ'),
(12, 'Bahamas', 'BS'),
(13, 'Bahrain', 'BH'),
(14, 'Bangladesh', 'BD'),
(15, 'Barbados', 'BB'),
(16, 'Belarus', 'BY'),
(17, 'Belgium', 'BE'),
(18, 'Belize', 'BZ'),
(19, 'Benin', 'BJ'),
(20, 'Bhutan', 'BT'),
(21, 'Bolivia', 'BO'),
(22, 'Bosnia and Herzegovina', 'BA'),
(23, 'Botswana', 'BW'),
(24, 'Brazil', 'BR'),
(25, 'Brunei', 'BN'),
(26, 'Bulgaria', 'BG'),
(27, 'Burkina Faso', 'BF'),
(28, 'Burundi', 'BI'),
(29, 'Cabo Verde', 'CV'),
(30, 'Cambodia', 'KH'),
(31, 'Cameroon', 'CM'),
(32, 'Canada', 'CA'),
(33, 'Central African Republic', 'CF'),
(34, 'Chad', 'TD'),
(35, 'Chile', 'CL'),
(36, 'China', 'CN'),
(37, 'Colombia', 'CO'),
(38, 'Comoros', 'KM'),
(39, 'Congo', 'CG'),
(40, 'Costa Rica', 'CR'),
(41, 'Cote d\'Ivoire', 'CI'),
(42, 'Croatia', 'HR'),
(43, 'Cuba', 'CU'),
(44, 'Cyprus', 'CY'),
(45, 'Czech Republic', 'CZ'),
(46, 'Democratic Republic of the Congo', 'CD'),
(47, 'Denmark', 'DK'),
(48, 'Djibouti', 'DJ'),
(49, 'Dominica', 'DM'),
(50, 'Dominican Republic', 'DO'),
(51, 'Ecuador', 'EC'),
(52, 'Egypt', 'EG'),
(53, 'El Salvador', 'SV'),
(54, 'Equatorial Guinea', 'GQ'),
(55, 'Eritrea', 'ER'),
(56, 'Estonia', 'EE'),
(57, 'Eswatini', 'SZ'),
(58, 'Ethiopia', 'ET'),
(59, 'Fiji', 'FJ'),
(60, 'Finland', 'FI'),
(61, 'France', 'FR'),
(62, 'Gabon', 'GA'),
(63, 'Gambia', 'GM'),
(64, 'Georgia', 'GE'),
(65, 'Germany', 'DE'),
(66, 'Ghana', 'GH'),
(67, 'Greece', 'GR'),
(68, 'Grenada', 'GD'),
(69, 'Guatemala', 'GT'),
(70, 'Guinea', 'GN'),
(71, 'Guinea-Bissau', 'GW'),
(72, 'Guyana', 'GY'),
(73, 'Haiti', 'HT'),
(74, 'Honduras', 'HN'),
(75, 'Hungary', 'HU'),
(76, 'Iceland', 'IS'),
(77, 'India', 'IN'),
(78, 'Indonesia', 'ID'),
(79, 'Iran', 'IR'),
(80, 'Iraq', 'IQ'),
(81, 'Ireland', 'IE'),
(82, 'Israel', 'IL'),
(83, 'Italy', 'IT'),
(84, 'Jamaica', 'JM'),
(85, 'Japan', 'JP'),
(86, 'Jordan', 'JO'),
(87, 'Kazakhstan', 'KZ'),
(88, 'Kenya', 'KE'),
(89, 'Kiribati', 'KI'),
(90, 'Korea', 'KP'),
(91, 'Korea', 'KR'),
(92, 'Kosovo', 'XK'),
(93, 'Kuwait', 'KW'),
(94, 'Kyrgyzstan', 'KG'),
(95, 'Laos', 'LA'),
(96, 'Latvia', 'LV'),
(97, 'Lebanon', 'LB'),
(98, 'Lesotho', 'LS'),
(99, 'Liberia', 'LR'),
(100, 'Libya', 'LY'),
(101, 'Liechtenstein', 'LI'),
(102, 'Lithuania', 'LT'),
(103, 'Luxembourg', 'LU'),
(104, 'Madagascar', 'MG'),
(105, 'Malawi', 'MW'),
(106, 'Malaysia', 'MY'),
(107, 'Maldives', 'MV'),
(108, 'Mali', 'ML'),
(109, 'Malta', 'MT'),
(110, 'Marshall Islands', 'MH'),
(111, 'Mauritania', 'MR'),
(112, 'Mauritius', 'MU'),
(113, 'Mexico', 'MX'),
(114, 'Micronesia', 'FM'),
(115, 'Moldova', 'MD'),
(116, 'Monaco', 'MC'),
(117, 'Mongolia', 'MN'),
(118, 'Montenegro', 'ME'),
(119, 'Morocco', 'MA'),
(120, 'Mozambique', 'MZ'),
(121, 'Myanmar', 'MM'),
(122, 'Namibia', 'NA'),
(123, 'Nauru', 'NR'),
(124, 'Nepal', 'NP'),
(125, 'Netherlands', 'NL'),
(126, 'New Zealand', 'NZ'),
(127, 'Nicaragua', 'NI'),
(128, 'Niger', 'NE'),
(129, 'Nigeria', 'NG'),
(130, 'North Macedonia', 'MK'),
(131, 'Norway', 'NO'),
(132, 'Oman', 'OM'),
(133, 'Pakistan', 'PK'),
(134, 'Palau', 'PW'),
(135, 'Panama', 'PA'),
(136, 'Papua New Guinea', 'PG'),
(137, 'Paraguay', 'PY'),
(138, 'Peru', 'PE'),
(139, 'Philippines', 'PH'),
(140, 'Poland', 'PL'),
(141, 'Portugal', 'PT'),
(142, 'Qatar', 'QA'),
(143, 'Romania', 'RO'),
(144, 'Russia', 'RU'),
(145, 'Rwanda', 'RW'),
(146, 'Saint Kitts and Nevis', 'KN'),
(147, 'Saint Lucia', 'LC'),
(148, 'Saint Vincent and the Grenadines', 'VC'),
(149, 'Samoa', 'WS'),
(150, 'San Marino', 'SM'),
(151, 'Sao Tome and Principe', 'ST'),
(152, 'Saudi Arabia', 'SA'),
(153, 'Senegal', 'SN'),
(154, 'Serbia', 'RS'),
(155, 'Seychelles', 'SC'),
(156, 'Sierra Leone', 'SL'),
(157, 'Singapore', 'SG'),
(158, 'Slovakia', 'SK'),
(159, 'Slovenia', 'SI'),
(160, 'Solomon Islands', 'SB'),
(161, 'Somalia', 'SO'),
(162, 'South Africa', 'ZA'),
(163, 'South Sudan', 'SS'),
(164, 'Spain', 'ES'),
(165, 'Sri Lanka', 'LK'),
(166, 'Sudan', 'SD'),
(167, 'Suriname', 'SR'),
(168, 'Switzerland', 'CH'),
(169, 'Sweden', 'SE'),
(170, 'Syria', 'SY'),
(171, 'Taiwan', 'TW'),
(172, 'Tajikistan', 'TJ'),
(173, 'Tanzania', 'TZ'),
(174, 'Thailand', 'TH'),
(175, 'Timor-Leste', 'TL'),
(176, 'Togo', 'TG'),
(177, 'Tonga', 'TO'),
(178, 'Trinidad and Tobago', 'TT'),
(179, 'Tunisia', 'TN'),
(180, 'Turkey', 'TR'),
(181, 'Turkmenistan', 'TM'),
(182, 'Tuvalu', 'TV'),
(183, 'Uganda', 'UG'),
(184, 'Ukraine', 'UA'),
(185, 'United Arab Emirates', 'AE'),
(186, 'United Kingdom', 'GB'),
(187, 'United States', 'US'),
(188, 'Uruguay', 'UY'),
(189, 'Uzbekistan', 'UZ'),
(190, 'Vanuatu', 'VU'),
(191, 'Vatican City', 'VA'),
(192, 'Venezuela', 'VE'),
(193, 'Vietnam', 'VN'),
(194, 'Yemen', 'YE'),
(195, 'Zambia', 'ZM'),
(196, 'Zimbabwe', 'ZW');

-- --------------------------------------------------------

--
-- Table structure for table `data_rows`
--

CREATE TABLE `data_rows` (
  `id` int(10) UNSIGNED NOT NULL,
  `data_type_id` int(10) UNSIGNED NOT NULL,
  `field` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT 0,
  `browse` tinyint(1) NOT NULL DEFAULT 1,
  `read` tinyint(1) NOT NULL DEFAULT 1,
  `edit` tinyint(1) NOT NULL DEFAULT 1,
  `add` tinyint(1) NOT NULL DEFAULT 1,
  `delete` tinyint(1) NOT NULL DEFAULT 1,
  `details` text DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_rows`
--

INSERT INTO `data_rows` (`id`, `data_type_id`, `field`, `type`, `display_name`, `required`, `browse`, `read`, `edit`, `add`, `delete`, `details`, `order`) VALUES
(1, 1, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, '{}', 1),
(2, 1, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required|max:50\"}}', 2),
(3, 1, 'email', 'text', 'Email', 1, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required|max:50|email|unique\"}}', 3),
(4, 1, 'password', 'password', 'Password', 1, 0, 0, 1, 1, 0, '{\"validation\":{\"rule\":\"required|max:50|min:8\"}}', 4),
(5, 1, 'remember_token', 'text', 'Remember Token', 0, 0, 0, 0, 0, 0, '{}', 5),
(6, 1, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 0, '{}', 6),
(7, 1, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 7),
(8, 1, 'avatar', 'image', 'Avatar', 0, 1, 1, 1, 1, 1, '{\"resize\":{\"width\":\"1000\",\"height\":null},\"quality\":\"70%\",\"upsize\":true,\"thumbnails\":[{\"name\":\"medium\",\"scale\":\"50%\"},{\"name\":\"small\",\"scale\":\"25%\"},{\"name\":\"cropped\",\"crop\":{\"width\":\"300\",\"height\":null}}]}', 8),
(9, 1, 'user_belongsto_role_relationship', 'relationship', 'Role', 0, 1, 1, 1, 1, 0, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsTo\",\"column\":\"role_id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"roles\",\"pivot\":\"0\",\"taggable\":\"0\"}', 10),
(10, 1, 'user_belongstomany_role_relationship', 'relationship', 'Roles', 0, 1, 1, 1, 1, 0, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"user_roles\",\"pivot\":\"1\",\"taggable\":\"0\"}', 11),
(11, 1, 'settings', 'hidden', 'Settings', 0, 0, 0, 0, 0, 0, '{}', 12),
(12, 2, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(13, 2, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(14, 2, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3),
(15, 2, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4),
(16, 3, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(17, 3, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(18, 3, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3),
(19, 3, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4),
(20, 3, 'display_name', 'text', 'Display Name', 1, 1, 1, 1, 1, 1, NULL, 5),
(21, 1, 'role_id', 'select_dropdown', 'Role', 0, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required|max:50\"}}', 9),
(29, 5, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, '{}', 1),
(30, 5, 'author_id', 'text', 'Author', 1, 0, 1, 1, 0, 1, '{}', 2),
(31, 5, 'category_id', 'text', 'Category', 0, 0, 1, 1, 1, 0, '{}', 3),
(32, 5, 'title', 'text', 'Title', 1, 1, 1, 1, 1, 1, '{}', 4),
(33, 5, 'excerpt', 'text_area', 'Excerpt', 0, 0, 1, 1, 1, 1, '{}', 5),
(34, 5, 'body', 'rich_text_box', 'Body', 1, 0, 1, 1, 1, 1, '{}', 6),
(35, 5, 'image', 'image', 'Post Image', 0, 1, 1, 1, 1, 1, '{\"resize\":{\"width\":\"1000\",\"height\":\"null\"},\"quality\":\"70%\",\"upsize\":true,\"thumbnails\":[{\"name\":\"medium\",\"scale\":\"50%\"},{\"name\":\"small\",\"scale\":\"25%\"},{\"name\":\"cropped\",\"crop\":{\"width\":\"460\",\"height\":\"245\"}}]}', 7),
(36, 5, 'slug', 'text', 'Slug', 1, 0, 1, 1, 1, 1, '{\"slugify\":{\"origin\":\"title\",\"forceUpdate\":true},\"validation\":{\"rule\":\"unique:posts,slug\"}}', 8),
(37, 5, 'meta_description', 'text_area', 'Meta Description', 0, 0, 1, 1, 1, 1, '{}', 9),
(38, 5, 'meta_keywords', 'text_area', 'Meta Keywords', 0, 0, 1, 1, 1, 1, '{}', 10),
(39, 5, 'status', 'select_dropdown', 'Status', 1, 1, 1, 1, 1, 1, '{\"default\":\"DRAFT\",\"options\":{\"PUBLISHED\":\"published\",\"DRAFT\":\"draft\",\"PENDING\":\"pending\"}}', 11),
(40, 5, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 0, '{}', 12),
(41, 5, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 13),
(42, 5, 'seo_title', 'text', 'SEO Title', 0, 1, 1, 1, 1, 1, '{}', 14),
(43, 5, 'featured', 'checkbox', 'Featured', 1, 1, 1, 1, 1, 1, '{}', 15),
(44, 6, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, '{}', 1),
(45, 6, 'author_id', 'text', 'Author', 1, 0, 0, 0, 0, 0, '{}', 2),
(46, 6, 'title', 'text', 'Title', 1, 1, 1, 1, 1, 1, '{}', 3),
(47, 6, 'excerpt', 'text_area', 'Excerpt', 0, 0, 1, 1, 1, 1, '{}', 4),
(48, 6, 'body', 'rich_text_box', 'Body', 0, 0, 1, 1, 1, 1, '{}', 5),
(49, 6, 'slug', 'text', 'Slug', 1, 0, 1, 1, 1, 1, '{\"slugify\":{\"origin\":\"title\"},\"validation\":{\"rule\":\"unique:pages,slug\"}}', 6),
(50, 6, 'meta_description', 'text', 'Meta Description', 0, 0, 1, 1, 1, 1, '{}', 7),
(51, 6, 'meta_keywords', 'text', 'Meta Keywords', 0, 0, 1, 1, 1, 1, '{}', 8),
(52, 6, 'status', 'select_dropdown', 'Status', 1, 1, 1, 1, 1, 1, '{\"default\":\"INACTIVE\",\"options\":{\"INACTIVE\":\"INACTIVE\",\"ACTIVE\":\"ACTIVE\"}}', 9),
(53, 6, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 0, '{}', 10),
(54, 6, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 11),
(55, 6, 'image', 'image', 'Page Image', 0, 1, 1, 1, 1, 1, '{\"quality\":\"70%\",\"upsize\":true,\"thumbnails\":[{\"name\":\"small\",\"scale\":\"25%\"},{\"name\":\"cropped\",\"crop\":{\"width\":\"1265\",\"height\":\"226\"}}],\"edit\":{\"rule\":\"nullable\"},\"add\":{\"rule\":\"required|image|max:10000\"}}', 12),
(63, 10, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(64, 10, 'title', 'text', 'Title', 1, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required|max:100\"}}', 2),
(65, 10, 'status', 'radio_btn', 'Status', 1, 1, 1, 1, 1, 1, '{\"default\":\"1\",\"options\":{\"0\":\"false\",\"1\":\"True\"}}', 4),
(66, 10, 'cover_image', 'image', 'Cover Image', 1, 1, 1, 1, 1, 1, '{\"resize\":{\"width\":\"1000\",\"height\":null},\"quality\":\"70%\",\"upsize\":true,\"thumbnails\":[{\"name\":\"medium\",\"scale\":\"50%\"},{\"name\":\"small\",\"scale\":\"25%\"},{\"name\":\"cropped\",\"crop\":{\"width\":\"1581\",\"height\":\"226\"}}]}', 5),
(67, 10, 'description', 'text_area', 'Description', 0, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required|max:1000\"}}', 6),
(68, 10, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 7),
(69, 10, 'updated_at', 'timestamp', 'Updated At', 0, 1, 1, 0, 0, 0, '{}', 8),
(70, 12, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(71, 12, 'full_name', 'text', 'Full Name', 1, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":[\"required\",\"max:30\"]}}', 2),
(72, 12, 'username', 'text', 'Username', 0, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":[\"required\",\"max:15\"]}}', 3),
(73, 12, 'password', 'text', 'Password', 0, 0, 0, 0, 1, 1, '{\"validation\":{\"rule\":[\"max:30\",\"min:8\"],\"edit\":{\"rule\":\"nullable\"},\"add\":{\"rule\":\"required\"}}}', 4),
(74, 12, 'country', 'select_dropdown', 'Country', 0, 1, 1, 1, 1, 1, '{\"default\":\"nepal\",\"options\":{\"nepal\":\"Nepal\",\"india\":\"India\"},\"validation\":{\"rule\":\"required|max:20\"}}', 5),
(75, 12, 'address', 'text', 'Address', 0, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":[\"max:30\",\"min:8\",\"nullable\"]}}', 6),
(76, 12, 'email', 'text', 'Email', 0, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":[\"max:100\",\"email\"],\"edit\":{\"rule\":\"required\"},\"add\":{\"rule\":\"required\"}}}', 7),
(77, 12, 'is_email_verified', 'radio_btn', 'Is Email Verified', 1, 1, 1, 1, 1, 1, '{\"default\":\"0\",\"options\":{\"0\":\"No\",\"1\":\"Yes\"}}', 8),
(78, 12, 'email_verified_at', 'timestamp', 'Email Verified At', 0, 1, 1, 0, 0, 0, '{}', 9),
(80, 12, 'is_kyc_verified', 'radio_btn', 'Is Kyc Verified?', 0, 1, 1, 1, 1, 1, '{\"default\":\"0\",\"options\":{\"0\":\"No\",\"1\":\"Yes\"}}', 11),
(81, 12, 'kyc_verified_by', 'select_dropdown', 'Kyc Verified By', 0, 0, 0, 1, 1, 1, '{\"validation\":{\"rule\":[\"nullable\",\"max:30\"]}}', 12),
(82, 12, 'mobile_number', 'text', 'Mobile Number', 0, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":[\"max:15\",\"min:8\",\"nullable\"],\"edit\":{\"rule\":\"nullable\"},\"add\":{\"rule\":\"nullable\"}}}', 13),
(83, 12, 'mobile_number_secondary', 'text', 'Mobile Number Secondary', 0, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":[\"max:15\",\"min:8\",\"nullable\"]}}', 14),
(84, 12, 'landline_number', 'text', 'Landline Number', 0, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":[\"max:15\",\"min:8\"]}}', 15),
(85, 12, 'date_of_birth', 'date', 'Date Of Birth', 0, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required|date|before:today|nullable\"}}', 16),
(86, 12, 'created_at', 'timestamp', 'Created At', 0, 1, 0, 0, 0, 0, '{}', 18),
(87, 12, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 19),
(88, 12, 'deleted_at', 'timestamp', 'Deleted At', 0, 0, 0, 0, 0, 0, '{}', 20),
(90, 13, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(91, 13, 'title', 'text', 'Title', 1, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required|max:200|min:10\"}}', 3),
(92, 13, 'description', 'text_area', 'Description', 1, 0, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required|max:2000\"}}', 5),
(93, 13, 'start_date', 'date', 'Start Date', 1, 1, 1, 1, 1, 1, '{\"validation\":{\"edit\":{\"rule\":\"required\"},\"add\":{\"rule\":\"required|date|after_or_equal:today\"}}}', 6),
(94, 13, 'end_date', 'date', 'End Date', 1, 1, 1, 1, 1, 1, '{\"validation\":{\"edit\":{\"rule\":\"required\"},\"add\":{\"rule\":\"required|date|after:start_date\"}}}', 7),
(95, 13, 'goal_amount', 'number', 'Goal Amount', 1, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required|numeric|min:1000|max:1000000\"}}', 8),
(96, 13, 'country', 'select_dropdown', 'Country', 1, 1, 1, 1, 1, 1, '{\"default\":\"nepal\",\"options\":{\"afghanistan\":\"Afghanistan\",\"albania\":\"Albania\",\"algeria\":\"Algeria\",\"andorra\":\"Andorra\",\"angola\":\"Angola\",\"antigua_and_barbuda\":\"Antigua and Barbuda\",\"argentina\":\"Argentina\",\"armenia\":\"Armenia\",\"australia\":\"Australia\",\"austria\":\"Austria\",\"azerbaijan\":\"Azerbaijan\",\"bahamas\":\"Bahamas\",\"bahrain\":\"Bahrain\",\"bangladesh\":\"Bangladesh\",\"barbados\":\"Barbados\",\"belarus\":\"Belarus\",\"belgium\":\"Belgium\",\"belize\":\"Belize\",\"benin\":\"Benin\",\"bhutan\":\"Bhutan\",\"bolivia\":\"Bolivia\",\"bosnia_and_herzegovina\":\"Bosnia and Herzegovina\",\"botswana\":\"Botswana\",\"brazil\":\"Brazil\",\"brunei\":\"Brunei\",\"bulgaria\":\"Bulgaria\",\"burkina_faso\":\"Burkina Faso\",\"burundi\":\"Burundi\",\"cabo_verde\":\"Cabo Verde\",\"cambodia\":\"Cambodia\",\"cameroon\":\"Cameroon\",\"canada\":\"Canada\",\"central_african_republic\":\"Central African Republic\",\"chad\":\"Chad\",\"chile\":\"Chile\",\"china\":\"China\",\"colombia\":\"Colombia\",\"comoros\":\"Comoros\",\"congo_democratic_republic_of_the\":\"Democratic Republic of the Congo\",\"congo_republic_of_the\":\"Republic of the Congo\",\"costa_rica\":\"Costa Rica\",\"cote_divoire\":\"C\\u00f4te d\'Ivoire\",\"croatia\":\"Croatia\",\"cuba\":\"Cuba\",\"cyprus\":\"Cyprus\",\"czech_republic\":\"Czech Republic\",\"denmark\":\"Denmark\",\"djibouti\":\"Djibouti\",\"dominica\":\"Dominica\",\"dominican_republic\":\"Dominican Republic\",\"ecuador\":\"Ecuador\",\"egypt\":\"Egypt\",\"el_salvador\":\"El Salvador\",\"equatorial_guinea\":\"Equatorial Guinea\",\"eritrea\":\"Eritrea\",\"estonia\":\"Estonia\",\"eswatini\":\"Eswatini\",\"ethiopia\":\"Ethiopia\",\"fiji\":\"Fiji\",\"finland\":\"Finland\",\"france\":\"France\",\"gabon\":\"Gabon\",\"gambia\":\"Gambia\",\"georgia\":\"Georgia\",\"germany\":\"Germany\",\"ghana\":\"Ghana\",\"greece\":\"Greece\",\"grenada\":\"Grenada\",\"guatemala\":\"Guatemala\",\"guinea\":\"Guinea\",\"guinea_bissau\":\"Guinea-Bissau\",\"guyana\":\"Guyana\",\"haiti\":\"Haiti\",\"honduras\":\"Honduras\",\"hungary\":\"Hungary\",\"iceland\":\"Iceland\",\"india\":\"India\",\"indonesia\":\"Indonesia\",\"iran\":\"Iran\",\"iraq\":\"Iraq\",\"ireland\":\"Ireland\",\"israel\":\"Israel\",\"italy\":\"Italy\",\"jamaica\":\"Jamaica\",\"japan\":\"Japan\",\"jordan\":\"Jordan\",\"kazakhstan\":\"Kazakhstan\",\"kenya\":\"Kenya\",\"kiribati\":\"Kiribati\",\"korea_north\":\"North Korea\",\"korea_south\":\"South Korea\",\"kosovo\":\"Kosovo\",\"kuwait\":\"Kuwait\",\"kyrgyzstan\":\"Kyrgyzstan\",\"laos\":\"Laos\",\"latvia\":\"Latvia\",\"lebanon\":\"Lebanon\",\"lesotho\":\"Lesotho\",\"liberia\":\"Liberia\",\"libya\":\"Libya\",\"liechtenstein\":\"Liechtenstein\",\"lithuania\":\"Lithuania\",\"luxembourg\":\"Luxembourg\",\"madagascar\":\"Madagascar\",\"malawi\":\"Malawi\",\"malaysia\":\"Malaysia\",\"maldives\":\"Maldives\",\"mali\":\"Mali\",\"malta\":\"Malta\",\"marshall_islands\":\"Marshall Islands\",\"mauritania\":\"Mauritania\",\"mauritius\":\"Mauritius\",\"mexico\":\"Mexico\",\"micronesia\":\"Micronesia\",\"moldova\":\"Moldova\",\"monaco\":\"Monaco\",\"mongolia\":\"Mongolia\",\"montenegro\":\"Montenegro\",\"morocco\":\"Morocco\",\"mozambique\":\"Mozambique\",\"myanmar\":\"Myanmar\",\"namibia\":\"Namibia\",\"nauru\":\"Nauru\",\"nepal\":\"Nepal\",\"netherlands\":\"Netherlands\",\"new_zealand\":\"New Zealand\",\"nicaragua\":\"Nicaragua\",\"niger\":\"Niger\",\"nigeria\":\"Nigeria\",\"north_macedonia\":\"North Macedonia\",\"norway\":\"Norway\",\"oman\":\"Oman\",\"pakistan\":\"Pakistan\",\"palau\":\"Palau\",\"panama\":\"Panama\",\"papua_new_guinea\":\"Papua New Guinea\",\"paraguay\":\"Paraguay\",\"peru\":\"Peru\",\"philippines\":\"Philippines\",\"poland\":\"Poland\",\"portugal\":\"Portugal\",\"qatar\":\"Qatar\",\"romania\":\"Romania\",\"russia\":\"Russia\",\"rwanda\":\"Rwanda\",\"saint_kitts_and_nevis\":\"Saint Kitts and Nevis\",\"saint_lucia\":\"Saint Lucia\",\"saint_vincent_and_the_grenadines\":\"Saint Vincent and the Grenadines\",\"samoa\":\"Samoa\",\"san_marino\":\"San Marino\",\"sao_tome_and_principe\":\"S\\u00e3o Tom\\u00e9 and Principe\",\"saudi_arabia\":\"Saudi Arabia\",\"senegal\":\"Senegal\",\"serbia\":\"Serbia\",\"seychelles\":\"Seychelles\",\"sierra_leone\":\"Sierra Leone\",\"singapore\":\"Singapore\",\"slovakia\":\"Slovakia\",\"slovenia\":\"Slovenia\",\"solomon_islands\":\"Solomon Islands\",\"somalia\":\"Somalia\",\"south_africa\":\"South Africa\",\"south_sudan\":\"South Sudan\",\"spain\":\"Spain\",\"sri_lanka\":\"Sri Lanka\",\"sudan\":\"Sudan\",\"suriname\":\"Suriname\",\"sweden\":\"Sweden\",\"switzerland\":\"Switzerland\",\"syria\":\"Syria\",\"taiwan\":\"Taiwan\",\"tajikistan\":\"Tajikistan\",\"tanzania\":\"Tanzania\",\"thailand\":\"Thailand\",\"timor_leste\":\"Timor-Leste\",\"togo\":\"Togo\",\"tonga\":\"Tonga\",\"trinidad_and_tobago\":\"Trinidad and Tobago\",\"tunisia\":\"Tunisia\",\"turkey\":\"Turkey\",\"turkmenistan\":\"Turkmenistan\",\"tuvalu\":\"Tuvalu\",\"uganda\":\"Uganda\",\"ukraine\":\"Ukraine\",\"united_arab_emirates\":\"United Arab Emirates\",\"united_kingdom\":\"United Kingdom\",\"united_states\":\"United States of America\",\"uruguay\":\"Uruguay\",\"uzbekistan\":\"Uzbekistan\",\"vanuatu\":\"Vanuatu\",\"vatican_city\":\"Vatican City\",\"venezuela\":\"Venezuela\",\"vietnam\":\"Vietnam\",\"yemen\":\"Yemen\",\"zambia\":\"Zambia\",\"zimbabwe\":\"Zimbabwe\"},\"validation\":{\"rule\":\"required|string|max:255\"}}', 9),
(97, 13, 'address', 'text', 'Address', 1, 0, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required|max:50\"}}', 10),
(98, 13, 'campaign_status', 'select_dropdown', 'Campaign Status', 1, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required|in:pending,accepted,running,rejected,completed,withdrwal-processing,withdrawn\"},\"default\":\"pending\",\"options\":{\"pending\":\"Pending\",\"accepted\":\"Accepted\",\"running\":\"Running\",\"rejected\":\"Rejected\",\"completed\":\"Completed\",\"withdrawal-processing\":\"Withdrawl Processing\",\"withdrawn\":\"Withdrawn\"}}', 11),
(99, 13, 'campaign_category_id', 'select_dropdown', 'Campaign Category', 1, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required\"}}', 12),
(100, 13, 'is_featured', 'radio_btn', 'Is Featured ?', 0, 1, 1, 1, 1, 1, '{\"default\":\"0\",\"options\":{\"0\":\"No\",\"1\":\"Yes\"}}', 13),
(101, 13, 'video_url', 'text', 'Video Url', 0, 0, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"max:100|url|nullable\"}}', 14),
(102, 13, 'public_user_id', 'select_dropdown', 'Public User', 1, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required\"}}', 2),
(103, 13, 'anonymous', 'select_dropdown', 'Anonymous', 1, 1, 1, 1, 1, 1, '{\"default\":\"0\",\"options\":{\"0\":\"No\",\"1\":\"Yes\"}}', 15),
(104, 13, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 0, '{}', 16),
(105, 13, 'updated_at', 'timestamp', 'Updated At', 0, 1, 1, 0, 0, 0, '{}', 17),
(106, 13, 'deleted_at', 'timestamp', 'Deleted At', 0, 0, 1, 0, 0, 0, '{}', 18),
(108, 13, 'campaign_hasone_campaign_category_relationship', 'relationship', 'Campaign Categories', 1, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Voyager\\\\CampaignCategory\",\"table\":\"campaign_categories\",\"type\":\"belongsTo\",\"column\":\"campaign_category_id\",\"key\":\"id\",\"label\":\"title\",\"pivot_table\":\"campaign_categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 20),
(109, 13, 'campaign_belongsto_public_user_relationship', 'relationship', 'Public Users', 1, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Voyager\\\\PublicUser\",\"table\":\"public_users\",\"type\":\"belongsTo\",\"column\":\"public_user_id\",\"key\":\"id\",\"label\":\"username\",\"pivot_table\":\"campaign_categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 22),
(110, 1, 'email_verified_at', 'timestamp', 'Email Verified At', 0, 1, 1, 1, 1, 1, '{}', 6),
(112, 12, 'public_user_belongsto_user_relationship', 'relationship', 'Kyc Verified By', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Voyager\\\\User\",\"table\":\"users\",\"type\":\"belongsTo\",\"column\":\"kyc_verified_by\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"campaign_categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 21),
(113, 15, 'id', 'number', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(114, 15, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required|max:50\"}}', 2),
(115, 15, 'url', 'text', 'Url', 0, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required|max:100|url\"}}', 3),
(116, 15, 'callback_url', 'text', 'Callback Url', 0, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required|max:100|url\"}}', 4),
(117, 15, 'show_in_frontend', 'radio_btn', 'Show In Frontend', 0, 1, 1, 1, 1, 1, '{\"default\":1,\"options\":{\"0\":\"No\",\"1\":\"Yes\"}}', 5),
(118, 15, 'status', 'radio_btn', 'Status', 0, 1, 1, 1, 1, 1, '{\"default\":1,\"options\":{\"0\":\"No\",\"1\":\"Yes\"}}', 6),
(119, 15, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, '{}', 7),
(120, 15, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 8),
(121, 18, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(122, 18, 'is_anonymous', 'radio_btn', 'Is Anonymous', 1, 1, 1, 1, 1, 1, '{\"default\":\"0\",\"options\":{\"0\":\"No\",\"1\":\"Yes\"}}', 2),
(123, 18, 'fullname', 'text', 'Fullname', 0, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":[\"required\",\"max:50\"]}}', 3),
(124, 18, 'country', 'select_dropdown', 'Country', 0, 1, 1, 1, 1, 1, '{\"default\":\"nepal\",\"options\":{\"nepal\":\"Nepal\",\"india\":\"India\"},\"validation\":{\"rule\":\"required|max:20\"}}', 4),
(125, 18, 'email', 'text', 'Email', 0, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":[\"max:100\",\"email\",\"nullable\"]}}', 6),
(127, 18, 'payment_status', 'select_dropdown', 'Payment Status', 0, 1, 1, 1, 1, 1, '{\"default\":\"pending\",\"options\":{\"pending\":\"Pending\",\"processing\":\"Processing\",\"cancelled\":\"Cancelled\",\"successful\":\"Successful\"},\"validation\":{\"rule\":\"required|max:20\"}}', 8),
(128, 18, 'payment_gateway_id', 'select_dropdown', 'Payment Gateway Id', 1, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":[\"required\"]}}', 9),
(129, 18, 'transaction_id', 'text', 'Transaction Id', 1, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":[\"required\",\"max:100\"]}}', 10),
(131, 18, 'service_charge_percentage', 'number', 'Service Charge Percentage(%))', 1, 1, 1, 1, 1, 1, '{\"default\":\"7\",\"validation\":{\"rule\":[\"required\",\"max:12\",\"min:0\"]}}', 12),
(132, 18, 'mobile_number', 'text', 'Mobile Number', 0, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":[\"string\",\"max:13\",\"min:10\"]}}', 13),
(133, 18, 'bank_name', 'text', 'Bank Name', 0, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":[\"max:50\"]}}', 14),
(134, 18, 'bank_swift_code', 'text', 'Bank Swift Code', 0, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":[\"max:50\"]}}', 15),
(135, 18, 'bank_account_number', 'text', 'Bank Account Number', 0, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":[\"max:50\"]}}', 16),
(136, 18, 'bank_address', 'text', 'Bank Address', 0, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":[\"max:50\"]}}', 17),
(137, 18, 'bank_account_name', 'text', 'Bank Account Name', 0, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":[\"max:50\"]}}', 18),
(138, 18, 'iban', 'text', 'Iban', 0, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":[\"max:50\"]}}', 19),
(139, 18, 'is_verified', 'text', 'Is Verified', 0, 1, 1, 1, 1, 1, '{\"default\":\"0\",\"options\":{\"0\":\"No\",\"1\":\"Yes\"}}', 20),
(140, 18, 'payment_receipt', 'image', 'Payment Receipt', 0, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":[\"file\",\"max:10240\",\"mimes:pdf,doc,docx,jpg,jpeg,png,heic\"]}}', 21),
(141, 18, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 0, '{}', 22),
(142, 18, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 23),
(143, 18, 'deleted_at', 'timestamp', 'Deleted At', 0, 0, 0, 0, 0, 0, '{}', 24),
(145, 18, 'donation_belongsto_payment_gateway_relationship', 'relationship', 'payment_gateways', 1, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Voyager\\\\PaymentGateway\",\"table\":\"payment_gateways\",\"type\":\"belongsTo\",\"column\":\"payment_gateway_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"campaign_categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 27),
(146, 21, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(147, 21, 'campaign_id', 'select_dropdown', 'Campaign', 1, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":[\"required\",\"max:30\"]}}', 2),
(148, 21, 'withdrawal_status', 'select_dropdown', 'Withdrawal Status', 0, 1, 1, 1, 1, 1, '{\"default\":\"pending\",\"options\":{\"pending\":\"Pending\",\"reviewing\":\"Reviewing\",\"processing\":\"Processing\",\"rejected\":\"Rejected\",\"approved\":\"Approved\",\"completed\":\"Completed\"},\"validation\":{\"rule\":\"required|max:20\"}}', 3),
(153, 21, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 0, '{}', 8),
(154, 21, 'updated_at', 'timestamp', 'Updated At', 0, 0, 1, 0, 0, 0, '{}', 9),
(155, 21, 'deleted_at', 'timestamp', 'Deleted At', 0, 0, 1, 0, 0, 0, '{}', 10),
(157, 13, 'status', 'radio_btn', 'Status', 0, 1, 1, 1, 1, 1, '{\"default\":\"0\",\"options\":{\"0\":\"False\",\"1\":\"True\"}}', 23),
(159, 13, 'cover_image', 'image', 'Cover Image', 0, 0, 1, 1, 1, 1, '{\"resize\":{\"width\":\"1000\",\"height\":null},\"quality\":\"70%\",\"upsize\":true,\"thumbnails\":[{\"name\":\"medium\",\"scale\":\"50%\"},{\"name\":\"small\",\"scale\":\"25%\"},{\"name\":\"cropped\",\"crop\":{\"width\":\"360\",\"height\":\"235\"}}],\"edit\":{\"rule\":\"nullable\"},\"add\":{\"rule\":\"required|image|max:10000\"}}', 24),
(161, 21, 'withdrawal_transaction_id', 'text', 'Withdrawal Transaction Id', 0, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"max:300\"}}', 4),
(165, 21, 'withdrawal_mobile_number', 'text', 'Withdrawal Mobile Number', 0, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":[\"required\",\"max:13\",\"min:6\"]}}', 8),
(167, 21, 'withdrawal_amount', 'number', 'Withdrawal Amount', 0, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":[\"required\",\"numeric\",\"max:100000\",\"min:1000\"]}}', 10),
(170, 21, 'withdrawal_belongsto_campaign_relationship', 'relationship', 'campaigns', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Voyager\\\\Campaign\",\"table\":\"campaigns\",\"type\":\"belongsTo\",\"column\":\"campaign_id\",\"key\":\"id\",\"label\":\"title\",\"pivot_table\":\"campaign_categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 13),
(171, 13, 'slug', 'text', 'Slug', 0, 1, 1, 1, 1, 1, '{\"slugify\":{\"origin\":\"title\",\"forceUpdate\":true}}', 4),
(172, 13, 'images', 'multiple_images', 'Images', 0, 1, 1, 1, 1, 1, '{}', 25),
(173, 23, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(174, 23, 'title', 'text', 'Title', 1, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required|max:200\"}}', 2),
(175, 23, 'description', 'text_area', 'Description', 1, 0, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required|max:5000\"}}', 3),
(176, 23, 'cover_image', 'image', 'Cover Image', 1, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"dimensions:min_height=476,min_width=1280\"},\"quality\":\"70%\",\"upsize\":true,\"thumbnails\":[{\"name\":\"medium\",\"scale\":\"50%\"},{\"name\":\"small\",\"scale\":\"25%\"},{\"name\":\"cropped\",\"crop\":{\"width\":\"1280\",\"height\":\"476\"}}],\"edit\":{\"rule\":\"nullable\"},\"add\":{\"rule\":\"required|image|max:10000\"}}', 4),
(177, 23, 'position', 'text', 'Position', 1, 1, 1, 1, 1, 1, '{}', 5),
(178, 23, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 6),
(179, 23, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 7),
(180, 23, 'go_to_link', 'text', 'Go To Link', 0, 0, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"url|max:100\"}}', 8),
(181, 23, 'status', 'radio_btn', 'Status', 0, 1, 1, 1, 1, 1, '{\"default\":\"0\",\"options\":{\"0\":\"False\",\"1\":\"True\"}}', 9),
(182, 23, 'btn_text', 'text', 'Btn Text', 0, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"max:20\"}}', 10),
(183, 18, 'slug', 'text', 'Slug', 0, 1, 1, 1, 1, 1, '{}', 26),
(184, 18, 'address', 'text', 'Street Address', 0, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":[\"max:100\",\"nullable\"]}}', 5),
(185, 12, 'profile_picture', 'image', 'Profile Picture', 0, 1, 1, 1, 1, 1, '{\"resize\":{\"width\":\"1000\",\"height\":null},\"quality\":\"70%\",\"upsize\":true,\"edit\":{\"rule\":\"nullable|max:10000|image\"},\"add\":{\"rule\":\"required|image|max:10000\"},\"thumbnails\":[{\"name\":\"medium\",\"scale\":\"100%\"},{\"name\":\"small\",\"scale\":\"25%\"},{\"name\":\"cropped\",\"crop\":{\"width\":\"120\",\"height\":\"120\"}}]}', 19),
(186, 27, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(187, 27, 'name', 'text', 'Name', 0, 1, 1, 1, 1, 1, '{}', 2),
(188, 27, 'email', 'text', 'Email', 0, 1, 1, 1, 1, 1, '{}', 3),
(189, 27, 'message', 'text', 'Message', 0, 1, 1, 1, 1, 1, '{}', 4),
(190, 27, 'phone', 'text', 'Phone', 0, 1, 1, 1, 1, 1, '{}', 5),
(191, 27, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 6),
(192, 27, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 7),
(193, 28, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(194, 28, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required|max:100\"}}', 2),
(195, 28, 'url', 'text', 'Url', 0, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required|max:100\"}}', 3),
(196, 28, 'callback_url', 'text', 'Callback Url', 0, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required|max:100\"}}', 4),
(197, 28, 'show_in_frontend', 'text', 'Show In Frontend', 0, 1, 1, 1, 1, 1, '{}', 5),
(198, 28, 'status', 'text', 'Status', 0, 1, 1, 1, 1, 1, '{}', 6),
(199, 28, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 7),
(200, 28, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 8),
(201, 28, 'slug', 'text', 'Slug', 0, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required|max:100\"}}', 9),
(202, 18, 'donation_belongsto_campaign_relationship', 'relationship', 'campaigns', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Voyager\\\\Campaign\",\"table\":\"campaigns\",\"type\":\"belongsTo\",\"column\":\"campaign_id\",\"key\":\"id\",\"label\":\"title\",\"pivot_table\":\"campaign_categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 28),
(203, 29, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(204, 29, 'message', 'text', 'Message', 0, 1, 1, 0, 0, 1, '{}', 2),
(205, 29, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 1, '{}', 3),
(206, 29, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 4),
(207, 30, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(208, 30, 'public_user_id', 'select_dropdown', 'Public User Id', 1, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required\"}}', 2),
(209, 30, 'payment_gateway_id', 'select_dropdown', 'Payment Gateway Id', 1, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required\"}}', 3),
(210, 30, 'mobile_number', 'text', 'Mobile Number', 1, 1, 1, 1, 1, 1, '{}', 4),
(211, 30, 'detail', 'text_area', 'Detail', 1, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required|max:2000|min:50\"}}', 5),
(212, 30, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 6),
(213, 30, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 7),
(214, 30, 'user_payment_gateway_belongsto_payment_gateway_relationship', 'relationship', 'payment_gateways', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Voyager\\\\PaymentGateway\",\"table\":\"payment_gateways\",\"type\":\"belongsTo\",\"column\":\"payment_gateway_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"campaign_categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 8),
(215, 30, 'user_payment_gateway_belongsto_public_user_relationship', 'relationship', 'public_users', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Voyager\\\\PublicUser\",\"table\":\"public_users\",\"type\":\"belongsTo\",\"column\":\"public_user_id\",\"key\":\"id\",\"label\":\"email\",\"pivot_table\":\"campaign_categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 9),
(216, 18, 'giver_public_user_id', 'select_dropdown', 'Giver Public User Id', 0, 1, 1, 1, 1, 1, '{}', 6),
(217, 18, 'amount', 'text', 'Amount', 1, 1, 1, 1, 1, 1, '{}', 10),
(218, 18, 'description', 'text', 'Description', 0, 1, 1, 1, 1, 1, '{}', 26),
(219, 18, 'campaign_id', 'text', 'Campaign Id', 0, 1, 1, 1, 1, 1, '{}', 27),
(220, 18, 'receiver_public_user_id', 'select_dropdown', 'Receiver Public User Id', 1, 1, 1, 1, 1, 1, '{}', 28),
(221, 18, 'donation_belongsto_public_user_relationship_1', 'relationship', 'Receiver', 1, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Voyager\\\\PublicUser\",\"table\":\"public_users\",\"type\":\"belongsTo\",\"column\":\"receiver_public_user_id\",\"key\":\"id\",\"label\":\"username\",\"pivot_table\":\"campaign_categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 29),
(222, 18, 'donation_belongsto_public_user_relationship_2', 'relationship', 'Giver', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Voyager\\\\PublicUser\",\"table\":\"public_users\",\"type\":\"belongsTo\",\"column\":\"giver_public_user_id\",\"key\":\"id\",\"label\":\"username\",\"pivot_table\":\"campaign_categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 30),
(223, 21, 'user_payment_gateway_id', 'select_dropdown', 'User Payment Gateway', 0, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":[\"required\"]}}', 16),
(224, 21, 'withdrawal_belongsto_user_payment_gateway_relationship', 'relationship', 'user_payment_gateways', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Voyager\\\\UserPaymentGateway\",\"table\":\"user_payment_gateways\",\"type\":\"belongsTo\",\"column\":\"user_payment_gateway_id\",\"key\":\"id\",\"label\":\"payment_gateway_name\",\"pivot_table\":\"campaign_categories\",\"pivot\":\"0\",\"taggable\":\"0\"}', 17),
(225, 31, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(226, 31, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required|max:200\"}}', 2),
(227, 31, 'message', 'text_area', 'Message', 0, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required|max:5000\"}}', 3),
(228, 31, 'designation', 'text', 'Designation', 0, 1, 1, 1, 1, 1, '{}', 4),
(229, 31, 'profile_picture', 'image', 'Profile Picture', 0, 1, 1, 1, 1, 1, '{\"quality\":\"70%\",\"upsize\":true,\"thumbnails\":[{\"name\":\"medium\",\"scale\":\"50%\"},{\"name\":\"small\",\"scale\":\"25%\"},{\"name\":\"cropped\",\"crop\":{\"width\":\"100\",\"height\":\"100\"}}],\"edit\":{\"rule\":\"nullable\"},\"add\":{\"rule\":\"required|image|max:10000\"}}', 5),
(230, 31, 'status', 'radio_btn', 'Status', 0, 1, 1, 1, 1, 1, '{\"default\":\"0\",\"options\":{\"0\":\"False\",\"1\":\"True\"}}', 6),
(231, 31, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 1, '{}', 7),
(232, 31, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 8),
(233, 32, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(234, 32, 'name', 'text', 'Name', 0, 1, 1, 1, 1, 1, '{}', 2),
(235, 32, 'logo', 'image', 'Logo', 0, 1, 1, 1, 1, 1, '{\"quality\":\"70%\",\"upsize\":true,\"thumbnails\":[{\"name\":\"medium\",\"scale\":\"50%\"},{\"name\":\"small\",\"scale\":\"25%\"},{\"name\":\"cropped\",\"crop\":{\"width\":\"112\",\"height\":\"90\"}}],\"edit\":{\"rule\":\"nullable\"},\"add\":{\"rule\":\"required|image|max:10000\"}}', 3),
(236, 32, 'website', 'text', 'Website', 0, 1, 1, 1, 1, 1, '{}', 4),
(237, 32, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 5),
(238, 32, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 6),
(239, 33, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(240, 33, 'title', 'text', 'Title', 0, 1, 1, 1, 1, 1, '{}', 2),
(241, 33, 'url', 'text', 'Url', 0, 1, 1, 1, 1, 1, '{}', 3),
(242, 33, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 4),
(243, 33, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 5),
(244, 23, 'sub_title', 'text', 'Sub Title', 0, 1, 1, 1, 1, 1, '{}', 11),
(245, 28, 'position', 'number', 'Position', 0, 1, 1, 1, 1, 1, '{}', 10),
(246, 34, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(247, 34, 'parent_id', 'text', 'Parent Id', 0, 1, 1, 1, 1, 1, '{}', 2),
(248, 34, 'order', 'text', 'Order', 1, 1, 1, 1, 1, 1, '{}', 3),
(249, 34, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 4),
(250, 34, 'slug', 'text', 'Slug', 1, 1, 1, 1, 1, 1, '{}', 5),
(251, 34, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 6),
(252, 34, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 7),
(253, 10, 'slug', 'text', 'Slug', 0, 1, 1, 1, 1, 1, '{\"slugify\":{\"origin\":\"title\",\"forceUpdate\":true}}', 3),
(254, 12, 'remember_token', 'text', 'Remember Token', 0, 1, 1, 1, 1, 1, '{}', 20),
(255, 12, 'email_verify_token', 'text', 'Email Verify Token', 0, 1, 1, 1, 1, 1, '{}', 21),
(256, 12, 'status', 'radio_btn', 'Status', 1, 1, 1, 1, 1, 1, '{\"default\":\"0\",\"options\":{\"0\":\"Inactive\",\"1\":\"Active\"}}', 22),
(257, 21, 'public_user_id', 'select_dropdown', 'Public User Id', 0, 1, 1, 1, 1, 1, '{}', 11),
(258, 21, 'successful_withdrawal_date', 'timestamp', 'Successful Withdrawal Date', 0, 1, 1, 1, 1, 1, '{}', 12),
(259, 21, 'withdrawal_service_charge', 'text', 'Withdrawal Service Charge', 0, 1, 1, 1, 1, 1, '{}', 13),
(260, 21, 'withdrawal_belongsto_public_user_relationship', 'relationship', 'public_users', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Voyager\\\\PublicUser\",\"table\":\"public_users\",\"type\":\"belongsTo\",\"column\":\"public_user_id\",\"key\":\"id\",\"label\":\"email\",\"pivot_table\":\"campaign_categories\",\"pivot\":\"0\",\"taggable\":null}', 18);

-- --------------------------------------------------------

--
-- Table structure for table `data_types`
--

CREATE TABLE `data_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `display_name_singular` varchar(255) NOT NULL,
  `display_name_plural` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `model_name` varchar(255) DEFAULT NULL,
  `policy_name` varchar(255) DEFAULT NULL,
  `controller` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT 0,
  `server_side` tinyint(4) NOT NULL DEFAULT 0,
  `details` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_types`
--

INSERT INTO `data_types` (`id`, `name`, `slug`, `display_name_singular`, `display_name_plural`, `icon`, `model_name`, `policy_name`, `controller`, `description`, `generate_permissions`, `server_side`, `details`, `created_at`, `updated_at`) VALUES
(1, 'users', 'users', 'User', 'Users', 'voyager-person', 'TCG\\Voyager\\Models\\User', 'TCG\\Voyager\\Policies\\UserPolicy', 'TCG\\Voyager\\Http\\Controllers\\VoyagerUserController', NULL, 1, 0, '{\"order_column\":\"name\",\"order_display_column\":\"name\",\"order_direction\":\"desc\",\"default_search_key\":null,\"scope\":null}', '2023-06-02 20:05:53', '2023-06-03 04:19:24'),
(2, 'menus', 'menus', 'Menu', 'Menus', 'voyager-list', 'TCG\\Voyager\\Models\\Menu', NULL, '', '', 1, 0, NULL, '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(3, 'roles', 'roles', 'Role', 'Roles', 'voyager-lock', 'TCG\\Voyager\\Models\\Role', NULL, 'TCG\\Voyager\\Http\\Controllers\\VoyagerRoleController', '', 1, 0, NULL, '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(5, 'posts', 'posts', 'Post', 'Posts', 'voyager-news', 'TCG\\Voyager\\Models\\Post', 'TCG\\Voyager\\Policies\\PostPolicy', NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"desc\",\"default_search_key\":null,\"scope\":null}', '2023-06-02 20:05:53', '2023-08-19 00:15:33'),
(6, 'pages', 'pages', 'Page', 'Pages', 'voyager-file-text', 'TCG\\Voyager\\Models\\Page', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"desc\",\"default_search_key\":null,\"scope\":null}', '2023-06-02 20:05:53', '2023-08-01 10:17:58'),
(10, 'campaign_categories', 'campaign-categories', 'Campaign Category', 'Campaign Categories', 'voyager-news', 'App\\Models\\Voyager\\CampaignCategory', NULL, NULL, NULL, 1, 0, '{\"order_column\":\"title\",\"order_display_column\":\"title\",\"order_direction\":\"desc\",\"default_search_key\":null,\"scope\":null}', '2023-06-03 01:09:37', '2023-08-24 20:59:47'),
(12, 'public_users', 'public-users', 'Public User', 'Public Users', 'voyager-people', 'App\\Models\\Voyager\\PublicUser', NULL, NULL, NULL, 1, 1, '{\"order_column\":\"id\",\"order_display_column\":\"full_name\",\"order_direction\":\"desc\",\"default_search_key\":\"username\",\"scope\":null}', '2023-06-03 01:45:10', '2023-09-07 05:00:50'),
(13, 'campaigns', 'campaigns', 'Campaign', 'Campaigns', 'voyager-activity', 'App\\Models\\Voyager\\Campaign', NULL, NULL, NULL, 1, 1, '{\"order_column\":\"id\",\"order_display_column\":\"title\",\"order_direction\":\"desc\",\"default_search_key\":\"title\",\"scope\":null}', '2023-06-03 02:22:46', '2023-09-04 06:42:01'),
(18, 'donations', 'donations', 'Donation', 'Donations', 'voyager-gift', 'App\\Models\\Voyager\\Donation', NULL, NULL, NULL, 1, 1, '{\"order_column\":\"id\",\"order_display_column\":\"fullname\",\"order_direction\":\"desc\",\"default_search_key\":\"fullname\",\"scope\":null}', '2023-06-05 04:24:59', '2023-07-09 03:25:47'),
(21, 'withdrawals', 'withdrawals', 'Withdrawal', 'Withdrawals', 'voyager-move', 'App\\Models\\Voyager\\Withdrawal', NULL, NULL, NULL, 1, 1, '{\"order_column\":\"id\",\"order_display_column\":null,\"order_direction\":\"desc\",\"default_search_key\":null,\"scope\":null}', '2023-06-05 06:17:11', '2023-09-07 08:14:08'),
(23, 'slider_banners', 'slider-banners', 'Slider Banner', 'Slider Banners', 'voyager-window-list', 'App\\Models\\Voyager\\SliderBanner', NULL, NULL, NULL, 1, 0, '{\"order_column\":\"position\",\"order_display_column\":\"title\",\"order_direction\":\"asc\",\"default_search_key\":\"title\",\"scope\":null}', '2023-06-08 09:24:09', '2023-07-29 04:18:34'),
(27, 'contact_us', 'contact-us', 'Contact Us', 'Contact Us', NULL, 'App\\Models\\Voyager\\ContactUs', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2023-06-17 23:26:59', '2023-06-17 23:26:59'),
(28, 'payment_gateways', 'payment-gateways', 'Payment Gateway', 'Payment Gateways', NULL, 'App\\Models\\Voyager\\PaymentGateway', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2023-06-19 11:03:34', '2023-08-08 10:19:09'),
(29, 'system_error_logs', 'system-error-logs', 'System Error Log', 'System Error Logs', NULL, 'App\\Models\\Voyager\\SystemErrorLog', NULL, NULL, NULL, 1, 0, '{\"order_column\":\"id\",\"order_display_column\":\"message\",\"order_direction\":\"desc\",\"default_search_key\":null}', '2023-06-25 02:30:26', '2023-06-25 02:30:26'),
(30, 'user_payment_gateways', 'user-payment-gateways', 'User Payment Gateway', 'User Payment Gateways', NULL, 'App\\Models\\Voyager\\UserPaymentGateway', NULL, NULL, NULL, 1, 0, '{\"order_column\":\"id\",\"order_display_column\":\"mobile_number\",\"order_direction\":\"asc\",\"default_search_key\":\"created_at\",\"scope\":null}', '2023-07-08 03:38:55', '2023-07-08 04:39:19'),
(31, 'testimonials', 'testimonials', 'Testimonial', 'Testimonials', NULL, 'App\\Models\\Voyager\\Testimonial', NULL, NULL, NULL, 1, 0, '{\"order_column\":\"name\",\"order_display_column\":\"name\",\"order_direction\":\"asc\",\"default_search_key\":null}', '2023-07-27 09:59:58', '2023-07-27 09:59:58'),
(32, 'partners', 'partners', 'Partner', 'Partners', NULL, 'App\\Models\\Voyager\\Partner', NULL, NULL, NULL, 1, 0, '{\"order_column\":\"name\",\"order_display_column\":\"name\",\"order_direction\":\"asc\",\"default_search_key\":\"name\"}', '2023-07-27 10:17:49', '2023-07-27 10:17:49'),
(33, 'usefull_links', 'usefull-links', 'Usefull Link', 'Usefull Links', NULL, 'App\\Models\\Voyager\\UsefullLink', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2023-07-29 02:55:52', '2023-07-29 02:55:52'),
(34, 'categories', 'categories', 'Category', 'Categories', NULL, 'App\\Models\\Voyager\\Category', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2023-08-24 20:49:57', '2023-08-24 20:49:57');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int(10) UNSIGNED NOT NULL,
  `is_anonymous` tinyint(4) NOT NULL DEFAULT 0,
  `fullname` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `giver_public_user_id` bigint(20) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT '''pending''',
  `payment_gateway_id` bigint(20) NOT NULL,
  `transaction_id` varchar(255) NOT NULL DEFAULT '''offline''',
  `amount` float NOT NULL,
  `service_charge_percentage` float NOT NULL DEFAULT 0,
  `mobile_number` varchar(30) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `bank_swift_code` varchar(100) DEFAULT NULL,
  `bank_account_number` varchar(100) DEFAULT NULL,
  `bank_address` varchar(100) DEFAULT NULL,
  `bank_account_name` varchar(100) DEFAULT NULL,
  `iban` varchar(100) DEFAULT NULL,
  `is_verified` tinyint(4) DEFAULT 0,
  `payment_receipt` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `campaign_id` bigint(20) DEFAULT NULL,
  `receiver_public_user_id` bigint(20) NOT NULL,
  `payment_gateway_all_response` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `is_anonymous`, `fullname`, `country`, `email`, `giver_public_user_id`, `payment_status`, `payment_gateway_id`, `transaction_id`, `amount`, `service_charge_percentage`, `mobile_number`, `bank_name`, `bank_swift_code`, `bank_account_number`, `bank_address`, `bank_account_name`, `iban`, `is_verified`, `payment_receipt`, `created_at`, `updated_at`, `deleted_at`, `slug`, `address`, `description`, `campaign_id`, `receiver_public_user_id`, `payment_gateway_all_response`) VALUES
(63, 0, 'Rabi Gorkhali 1', 'nepal', 'rabigorkhaly@gmail.com', NULL, 'completed', 2, 'CmQBG2v9ww7jaQsgQFvMad', 200, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-09-07 03:03:19', '2023-09-07 03:03:19', NULL, NULL, 'Chorcha 7, Bhaktapur', 'sdkjfnskdjfnksjdnf', 23, 27, '{\"idx\":\"CmQBG2v9ww7jaQsgQFvMad\",\"type\":{\"idx\":\"2jwzDS9wkxbkDFquJqfAEC\",\"name\":\"Wallet payment\"},\"state\":{\"idx\":\"DhvMj9hdRufLqkP8ZY4d8g\",\"name\":\"Completed\",\"template\":\"is complete\"},\"amount\":20000,\"fee_amount\":600,\"reference\":null,\"refunded\":false,\"created_on\":\"2023-09-07T14:32:49.175924+05:45\",\"user\":{\"idx\":\"\",\"name\":\"Rabi Gorkhali (9843169319)\"},\"merchant\":{\"idx\":\"rDebTPWcbMafQoaKGaoPrV\",\"name\":\"Rabi Test\",\"mobile\":\"a4orapple@gmail.com\",\"email\":\"a4orapple@gmail.com\"},\"remarks\":null,\"token\":\"6BYtGcHM7YoDHX4gNj448L\",\"cashback\":0,\"product_identity\":\"23\"}'),
(64, 0, 'Rabi Gorkhali 1', 'nepal', 'a@asd.com', 27, 'pending', 4, 'testest', 45, 7, '9843169319', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'donations/64f9907989510.jpeg', '2023-09-07 03:12:29', '2023-09-07 03:12:30', NULL, NULL, 'Chorcha 7, Bhaktapur', 'sdkjfnskdjfnksjdnfkjsdnfkjsndkfjnskdjfnksjdnfksj', 23, 27, NULL),
(65, 0, 'Rabi Gorkhali 1', 'nepal', 'a@asd.com', 27, 'pending', 4, 'testest', 45, 7, '9843169319', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'donations/64f9908b4bb10.jpeg', '2023-09-07 03:12:47', '2023-09-07 03:12:48', NULL, NULL, 'Chorcha 7, Bhaktapur', 'sdkjfnskdjfnksjdnfkjsdnfkjsndkfjnskdjfnksjdnfksj', 23, 27, NULL),
(66, 0, 'Rabi Gorkhali 1', 'nepal', 'a@asd.com', 27, 'pending', 4, 'testest', 45, 7, '9843169319', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'donations/64f990ab17c7b.jpeg', '2023-09-07 03:13:19', '2023-09-07 03:13:19', NULL, NULL, 'Chorcha 7, Bhaktapur', 'sdkjfnskdjfnksjdnfkjsdnfkjsndkfjnskdjfnksjdnfksj', 23, 27, NULL),
(67, 0, 'Rabi Gorkhali 1', 'nepal', 'a@asd.com', 27, 'pending', 4, 'testest', 45, 7, '9843169319', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'donations/64f9914f8b7e9.jpeg', '2023-09-07 03:16:03', '2023-09-07 03:16:04', NULL, NULL, 'Chorcha 7, Bhaktapur', 'sdkjfnskdjfnksjdnfkjsdnfkjsndkfjnskdjfnksjdnfksj', 23, 27, NULL),
(68, 0, 'Rabi Gorkhali 1', 'nepal', 'a@asd.com', 27, 'pending', 4, 'testest', 45, 7, '9843169319', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'donations/64f9918670ee3.jpeg', '2023-09-07 03:16:58', '2023-09-07 03:16:59', NULL, NULL, 'Chorcha 7, Bhaktapur', 'sdkjfnskdjfnksjdnfkjsdnfkjsndkfjnskdjfnksjdnfksj', 23, 27, NULL),
(69, 0, 'Rabi Gorkhali 1', 'nepal', 'a@asd.com', 27, 'pending', 4, 'testest', 45, 7, '9843169319', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'donations/64f991c3960bd.jpeg', '2023-09-07 03:17:59', '2023-09-07 03:18:00', NULL, NULL, 'Chorcha 7, Bhaktapur', 'sdkjfnskdjfnksjdnfkjsdnfkjsndkfjnskdjfnksjdnfksj', 23, 27, NULL),
(70, 0, 'Rabi Gorkhali 1', 'nepal', 'rabigorkhaly@gmail.com', 27, 'pending', 4, 'testest', 11, 7, '9843169319', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'donations/64f991fc8e37b.jpeg', '2023-09-07 03:18:56', '2023-09-07 03:18:57', NULL, NULL, 'Chorcha 7, Bhaktapur', 'sdfsdfsdfsdfsdf', 23, 27, NULL),
(71, 0, 'Rabi Gorkhali 1', 'nepal', 'rabigorkhaly@gmail.com', 27, 'pending', 4, 'testest', 11, 7, '9843169319', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'donations/64f992b237e0d.jpeg', '2023-09-07 03:21:58', '2023-09-07 03:21:59', NULL, NULL, 'Chorcha 7, Bhaktapur', 'sdfsdfsdfsdfsdf', 23, 27, NULL),
(72, 0, 'Rabi Gorkhali 1', 'nepal', 'rabigorkhaly@gmail.com', 27, 'pending', 4, 'testest', 1212, 7, '9843169319', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'donations/64f99351c76b0.jpeg', '2023-09-07 03:24:37', '2023-09-07 03:24:38', NULL, NULL, 'Chorcha 7, Bhaktapur', 'dsjfnsdkjfnskdjnfksjdnfk', 23, 27, NULL),
(73, 0, 'Rabi Gorkhali 1', 'nepal', 'rabigorkhaly@gmail.com', 27, 'pending', 4, 'testest', 123, 7, '9843169319', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'donations/64f9a46673457.jpeg', '2023-09-07 10:22:30', '2023-09-07 10:22:30', NULL, NULL, 'Chorcha 7, Bhaktapur', 'jksndfkjs djsnfkjsnkjsdf', 23, 27, NULL),
(74, 0, 'Rabi Gorkhali', 'nepal', 'rabigorkhaly@gmail.com', NULL, 'completed', 1, '0006541', 100, 7, '9843169319', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-09-16 07:08:16', '2023-09-16 07:08:16', NULL, NULL, 'Chorcha 7, Bhaktapur', 'dfjgok dfogjknd fgkj dfkg jdfgm', 23, 27, '{\"response_code\":\"\\nSuccess\\n\"}'),
(75, 0, 'Rabi Gorkhali', 'nepal', 'rabigorkhaly@gmail.com', NULL, 'pending', 4, 'testest', 111, 7, '9843169319', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'donations/650554f30bf49.jpg', '2023-09-16 07:10:43', '2023-09-16 07:10:43', NULL, NULL, 'Chorcha 7, Bhaktapur', 'sdlkf sdkfjns kdfkjsd foskdlf slkd foskld fklsdmf', 23, 27, NULL),
(76, 0, 'Rabi Gorkhali', 'nepal', 'rabigorkhaly@gmail.com', NULL, 'pending', 4, 'testest', 111, 7, '9843169319', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'donations/650554fdeb162.jpg', '2023-09-16 07:10:53', '2023-09-16 07:10:54', NULL, NULL, 'Chorcha 7, Bhaktapur', 'sdlkf sdkfjns kdfkjsd foskdlf slkd foskld fklsdmf', 23, 27, NULL),
(77, 0, 'Rabi Gorkhali', 'nepal', 'rabigorkhaly@gmail.com', NULL, 'pending', 4, 'testest', 111, 7, '9843169319', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'donations/6505581ca5141.jpg', '2023-09-16 07:24:12', '2023-09-16 07:24:12', NULL, NULL, 'Chorcha 7, Bhaktapur', 'sdlkf sdkfjns kdfkjsd foskdlf slkd foskld fklsdmf', 23, 27, NULL),
(78, 0, 'Rabi Gorkhali', 'nepal', 'rabigorkhaly@gmail.com', NULL, 'pending', 4, 'testest', 89, 7, '9843169319', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'donations/650559d4467ed.jpg', '2023-09-16 07:31:32', '2023-09-16 07:31:32', NULL, NULL, 'Chorcha 7, Bhaktapur', 'sdkjfnskjnskjdfnksjdnfkjs dfkjsndkfjnsdf', 23, 27, NULL),
(79, 0, 'Rabi Gorkhali', 'nepal', 'rabigorkhaly@gmail.com', NULL, 'pending', 4, 'testest', 12, 7, '9843169319', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'donations/65068e749f113.JPG', '2023-09-17 05:28:20', '2023-09-17 05:28:20', NULL, NULL, 'Chorcha 7, Bhaktapur', 'sdfjnsdlkfnsdkfnsdklnflskdnflksdnf', 23, 27, NULL),
(80, 0, 'Rabi Gorkhali', 'nepal', 'rabigorkhaly@gmail.com', NULL, 'pending', 4, 'testest', 12, 7, '9843169319', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'donations/65068eadad03c.JPG', '2023-09-17 05:29:17', '2023-09-17 05:29:17', NULL, NULL, 'Chorcha 7, Bhaktapur', 'sdfjnsdlkfnsdkfnsdklnflskdnflksdnf', 23, 27, NULL),
(81, 0, 'Rabi Gorkhali', 'nepal', 'rabigorkhaly@gmail.com', NULL, 'pending', 4, 'testest', 12, 7, '9843169319', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'donations/65068ee1b3d2a.JPG', '2023-09-17 05:30:09', '2023-09-17 05:30:09', NULL, NULL, 'Chorcha 7, Bhaktapur', 'sdfjnsdlkfnsdkfnsdklnflskdnflksdnf', 23, 27, NULL),
(82, 0, 'Rabi Gorkhali', 'nepal', 'rabigorkhaly@gmail.com', NULL, 'pending', 4, 'testest', 12, 7, '9843169319', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'donations/65068f0b03b31.JPG', '2023-09-17 05:30:51', '2023-09-17 05:30:51', NULL, NULL, 'Chorcha 7, Bhaktapur', 'sdfjnsdlkfnsdkfnsdklnflskdnflksdnf', 23, 27, NULL),
(83, 0, 'Rabi Gorkhali', 'nepal', 'rabigorkhaly@gmail.com', NULL, 'pending', 4, 'testest', 12, 7, '9843169319', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'donations/65068f67a2085.JPG', '2023-09-17 05:32:23', '2023-09-17 05:32:23', NULL, NULL, 'Chorcha 7, Bhaktapur', 'sdfjnsdlkfnsdkfnsdklnflskdnflksdnf', 23, 27, NULL),
(84, 0, 'Rabi Gorkhali Esewa', 'nepal', 'rabigorkhaly@gmail.com', NULL, 'completed', 1, '000655P', 12, 7, '9843169319', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-09-17 05:33:21', '2023-09-17 05:33:21', NULL, NULL, 'Chorcha 7, Bhaktapur', 'sdljkf sdlfnsd lfmsldkf sldkf sdf', 23, 27, '{\"response_code\":\"\\nSuccess\\n\"}'),
(85, 0, 'Rabi Gorkhali', 'nepal', 'rabigorkhaly@gmail.com', NULL, 'pending', 4, 'testest', 14, 7, '9843169319', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'donations/650690ddca3d2.jpg', '2023-09-17 05:38:37', '2023-09-17 05:38:38', NULL, NULL, 'Chorcha 7, Bhaktapur', 'sdflksndlfks kdflsdkjnflskdnfsdf', 23, 27, NULL),
(86, 0, 'Rabi Gorkhali', 'nepal', 'rabigorkhaly@gmail.com', NULL, 'pending', 4, 'testest', 14, 7, '9843169319', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'donations/6506913f5e155.jpg', '2023-09-17 05:40:15', '2023-09-17 05:40:15', NULL, NULL, 'Chorcha 7, Bhaktapur', 'sdflksndlfks kdflsdkjnflskdnfsdf', 23, 27, NULL),
(87, 0, 'Rabi Gorkhali', 'nepal', 'rabigorkhaly@gmail.com', NULL, 'pending', 4, 'testest', 12, 7, '9843169319', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'donations/6506a09ccc09a.jpg', '2023-09-17 06:45:48', '2023-09-17 06:45:49', NULL, NULL, 'Chorcha 7, Bhaktapur', 'sdfjsndlfknsldkfnslkdnflskdf', 23, 27, NULL);

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
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2023-06-02 20:05:53', '2023-06-02 20:05:53');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `target` varchar(255) NOT NULL DEFAULT '_self',
  `icon_class` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `parameters` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_id`, `title`, `url`, `target`, `icon_class`, `color`, `parent_id`, `order`, `created_at`, `updated_at`, `route`, `parameters`) VALUES
(1, 1, 'Dashboard', '', '_self', 'voyager-boat', NULL, NULL, 1, '2023-06-02 20:05:53', '2023-06-02 20:05:53', 'voyager.dashboard', NULL),
(2, 1, 'Media', '', '_self', 'voyager-images', NULL, NULL, 10, '2023-06-02 20:05:53', '2023-06-15 11:50:56', 'voyager.media.index', NULL),
(3, 1, 'Users', '', '_self', 'voyager-person', NULL, NULL, 9, '2023-06-02 20:05:53', '2023-06-15 11:50:56', 'voyager.users.index', NULL),
(4, 1, 'Roles', '', '_self', 'voyager-lock', NULL, NULL, 8, '2023-06-02 20:05:53', '2023-06-15 11:50:56', 'voyager.roles.index', NULL),
(5, 1, 'Tools', '', '_self', 'voyager-tools', NULL, NULL, 14, '2023-06-02 20:05:53', '2023-06-08 10:38:25', NULL, NULL),
(6, 1, 'Menu Builder', '', '_self', 'voyager-list', NULL, 5, 1, '2023-06-02 20:05:53', '2023-06-03 03:55:43', 'voyager.menus.index', NULL),
(7, 1, 'Database', '', '_self', 'voyager-data', NULL, 5, 2, '2023-06-02 20:05:53', '2023-06-03 03:55:43', 'voyager.database.index', NULL),
(8, 1, 'Compass', '', '_self', 'voyager-compass', NULL, 5, 3, '2023-06-02 20:05:53', '2023-06-03 03:55:43', 'voyager.compass.index', NULL),
(9, 1, 'BREAD', '', '_self', 'voyager-bread', NULL, 5, 4, '2023-06-02 20:05:53', '2023-06-03 03:55:43', 'voyager.bread.index', NULL),
(10, 1, 'Settings', '', '_self', 'voyager-settings', NULL, NULL, 15, '2023-06-02 20:05:53', '2023-06-08 10:38:25', 'voyager.settings.index', NULL),
(12, 1, 'Posts', '', '_self', 'voyager-news', NULL, NULL, 11, '2023-06-02 20:05:53', '2023-06-15 11:50:56', 'voyager.posts.index', NULL),
(13, 1, 'Pages', '', '_self', 'voyager-file-text', NULL, NULL, 12, '2023-06-02 20:05:53', '2023-06-15 11:50:56', 'voyager.pages.index', NULL),
(15, 1, 'Campaign Categories', '', '_self', 'voyager-news', NULL, 18, 1, '2023-06-03 01:09:37', '2023-06-03 03:57:14', 'voyager.campaign-categories.index', NULL),
(16, 1, 'Public Users', '', '_self', 'voyager-people', NULL, NULL, 4, '2023-06-03 01:45:10', '2023-06-15 11:50:56', 'voyager.public-users.index', NULL),
(17, 1, 'Campaigns', '', '_self', 'voyager-activity', NULL, 18, 2, '2023-06-03 02:22:46', '2023-06-15 11:51:05', 'voyager.campaigns.index', NULL),
(18, 1, 'Campaign Management', '', '_self', 'voyager-lightbulb', '#000000', NULL, 3, '2023-06-03 03:56:55', '2023-06-05 05:55:37', NULL, ''),
(20, 1, 'Donations', '', '_self', 'voyager-gift', '#000000', NULL, 2, '2023-06-05 04:24:59', '2023-06-05 05:56:01', 'voyager.donations.index', 'null'),
(21, 1, 'Withdrawals', '', '_self', 'voyager-move', '#000000', NULL, 5, '2023-06-05 06:17:11', '2023-06-15 11:50:56', 'voyager.withdrawals.index', 'null'),
(22, 1, 'Slider Banners', '', '_self', 'voyager-window-list', NULL, NULL, 6, '2023-06-08 09:24:09', '2023-06-15 11:50:56', 'voyager.slider-banners.index', NULL),
(25, 1, 'Contact Us', '', '_self', NULL, NULL, NULL, 16, '2023-06-17 23:26:59', '2023-06-17 23:26:59', 'voyager.contact-us.index', NULL),
(26, 1, 'Payment Gateways', '', '_self', NULL, NULL, NULL, 17, '2023-06-19 11:03:34', '2023-06-19 11:03:34', 'voyager.payment-gateways.index', NULL),
(27, 1, 'System Error Logs', '', '_self', NULL, NULL, NULL, 18, '2023-06-25 02:30:26', '2023-06-25 02:30:26', 'voyager.system-error-logs.index', NULL),
(28, 1, 'User Payment Gateways', '', '_self', NULL, NULL, NULL, 19, '2023-07-08 03:38:55', '2023-07-08 03:38:55', 'voyager.user-payment-gateways.index', NULL),
(29, 1, 'Testimonials', '', '_self', NULL, NULL, NULL, 20, '2023-07-27 09:59:58', '2023-07-27 09:59:58', 'voyager.testimonials.index', NULL),
(30, 1, 'Partners', '', '_self', NULL, NULL, NULL, 21, '2023-07-27 10:17:49', '2023-07-27 10:17:49', 'voyager.partners.index', NULL),
(31, 1, 'Usefull Links', '', '_self', NULL, NULL, NULL, 22, '2023-07-29 02:55:52', '2023-07-29 02:55:52', 'voyager.usefull-links.index', NULL),
(32, 1, 'Categories', '', '_self', NULL, NULL, NULL, 23, '2023-08-24 20:49:57', '2023-08-24 20:49:57', 'voyager.categories.index', NULL);

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
(29, '2014_10_12_000000_create_users_table', 1),
(30, '2014_10_12_100000_create_password_resets_table', 1),
(31, '2016_01_01_000000_add_voyager_user_fields', 1),
(32, '2016_01_01_000000_create_data_types_table', 1),
(33, '2016_01_01_000000_create_pages_table', 1),
(34, '2016_01_01_000000_create_posts_table', 1),
(35, '2016_02_15_204651_create_categories_table', 1),
(36, '2016_05_19_173453_create_menu_table', 1),
(37, '2016_10_21_190000_create_roles_table', 1),
(38, '2016_10_21_190000_create_settings_table', 1),
(39, '2016_11_30_135954_create_permission_table', 1),
(40, '2016_11_30_141208_create_permission_role_table', 1),
(41, '2016_12_26_201236_data_types__add__server_side', 1),
(42, '2017_01_13_000000_add_route_to_menu_items_table', 1),
(43, '2017_01_14_005015_create_translations_table', 1),
(44, '2017_01_15_000000_make_table_name_nullable_in_permissions_table', 1),
(45, '2017_03_06_000000_add_controller_to_data_types_table', 1),
(46, '2017_04_11_000000_alter_post_nullable_fields_table', 1),
(47, '2017_04_21_000000_add_order_to_data_rows_table', 1),
(48, '2017_07_05_210000_add_policyname_to_data_types_table', 1),
(49, '2017_08_05_000000_add_group_to_settings_table', 1),
(50, '2017_11_26_013050_add_user_role_relationship', 1),
(52, '2018_03_11_000000_add_user_settings', 1),
(53, '2018_03_14_000000_add_details_to_data_types_table', 1),
(54, '2018_03_16_000000_make_settings_value_nullable', 1),
(55, '2019_08_19_000000_create_failed_jobs_table', 1),
(56, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(57, '2017_11_26_015000_create_user_roles_table', 2),
(58, '2023_07_01_065653_create_table_password_reset_public_user', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `excerpt` text DEFAULT NULL,
  `body` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'INACTIVE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `author_id`, `title`, `excerpt`, `body`, `image`, `slug`, `meta_description`, `meta_keywords`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'How it works', 'Hang the jib grog grog blossom grapple dance the hempen jig gangway pressgang bilge rat to go on account lugger. Nelsons folly gabion line draught scallywag fire ship gaff fluke fathom case shot. Sea Legs bilge rat sloop matey gabion long clothes run a shot across the bow Gold Road cog league.', '<p>We operate based on the following principles:</p>\r\n<p>1. Creation of Campaign: An individual or organization creates a campaign on the crowdfunding platform. They outline their project or cause, set a funding goal, and specify a deadline for achieving it.</p>\r\n<p>2. Public or Donor Contributions: The campaign is made public, and both the general public and potential donors are invited to contribute funds towards the cause. Donors can choose to donate any amount they wish.</p>\r\n<p>3. Fundraising Period: The campaign remains active for a specified period or until the funding goal is reached. During this time, donors can make contributions towards the campaign.</p>\r\n<p>4. Offline Donation Support: Currently, the platform supports offline donations. This means that donors can contribute funds through offline methods such as bank transfers, checks, or in-person payments.</p>\r\n<p>5. Goal or Deadline Achievement: Once the campaign reaches its funding goal or deadline, the campaign creator can proceed to the next step.</p>\r\n<p>6. Withdrawal Process: The campaign creator can initiate a withdrawal request for the collected amount. The platform facilitates the transfer of the funds from the campaign account to the designated recipient, typically the campaign creator.</p>\r\n<p>7. Processing Time: The withdrawal process takes approximately two days to complete. During this time, the platform verifies the withdrawal request and ensures the funds are transferred securely.</p>\r\n<p>8. Future Online Donation Features: The crowdfunding platform currently supports only offline donations, but it plans to introduce online donation features in the near future. This will provide donors with more convenient options for contributing funds, such as utilizing multiple payment gateways.</p>\r\n<p>In summary, a our platform enables individuals or organizations to create campaigns and raise funds from the public or donors. The platform supports offline donations initially, with a withdrawal process that takes around two days. Future enhancements will include the introduction of online donation features, providing a broader range of payment options to potential donors.</p>', 'pages/CU0thlgNeoQarCSNTuPf.JPG', 'how-it-works', 'Yar Meta Description', 'Keyword1, Keyword2', 'ACTIVE', '2023-06-02 20:05:53', '2023-08-01 10:18:24'),
(2, 1, 'About Us', 'About Us', '<p>Welcome to Our Crowdfunding Platform!</p>\r\n<p>We are a dedicated crowdfunding website that connects passionate individuals, innovative projects, and generous backers. Our platform serves as a hub for people looking to bring their ideas to life, make a positive impact, and receive support from a global community.</p>\r\n<p>With us, you can explore a diverse range of causes, creative ventures, charitable initiatives, and entrepreneurial endeavors. Whether you\'re a project creator or a supporter, we provide a user-friendly and secure environment where dreams can thrive.</p>\r\n<p>Our mission is to empower individuals, organizations, and communities to rally together, share their stories, and collectively drive change. We believe in the power of collaboration and aim to facilitate meaningful connections that transcend borders and boundaries.</p>\r\n<p>Join our vibrant community and be part of a movement that fuels innovation, supports social good, and fosters positive transformation. Together, let\'s make a difference and turn dreams into reality.</p>\r\n<div class=\"group w-full text-gray-800 dark:text-gray-100 border-b border-black/10 dark:border-gray-900/50 bg-gray-50 dark:bg-[#444654]\">\r\n<div class=\"flex p-4 gap-4 text-base md:gap-6 md:max-w-2xl lg:max-w-[38rem] xl:max-w-3xl md:py-6 lg:px-0 m-auto\">\r\n<div class=\"relative flex w-[calc(100%-50px)] flex-col gap-1 md:gap-3 lg:w-[calc(100%-115px)]\">\r\n<div class=\"flex flex-grow flex-col gap-3\">\r\n<div class=\"min-h-[20px] flex flex-col items-start gap-4 whitespace-pre-wrap break-words\">\r\n<div class=\"markdown prose w-full break-words dark:prose-invert dark\">\r\n<p>Currently, we have a beta release, and in the near future, we will be launching all the necessary features. With these features, the public will be able to create campaigns and conveniently withdraw their funds using a secure payment gateway.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', NULL, 'about-us', 'about us , crowdfunding', 'crowdfunding', 'ACTIVE', '2023-06-18 05:56:54', '2023-06-18 05:56:54');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `website` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `name`, `logo`, `website`, `created_at`, `updated_at`) VALUES
(1, 'Nifra', 'partners/nwHKwUjjX1uIqyXoJsQD.jpeg', 'http://test.com', '2023-07-27 10:18:22', '2023-07-27 10:18:22'),
(2, 'Hydro', 'partners/hwMlLZ1ghXsiFitUI5AN.jpeg', 'http://test.com', '2023-07-27 10:18:42', '2023-07-27 10:18:42');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('rabigorkhaly@gmail.com', '$2y$10$R4tCEsJ1.KfLWDqeFTJc9OETgUMyI5Jg9DDviepcJaINzhXX5cc7e', '2023-07-01 00:47:49');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_public_user`
--

CREATE TABLE `password_reset_public_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_public_user`
--

INSERT INTO `password_reset_public_user` (`id`, `email`, `token`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'rabigorkhaly@gmail.com', 'c6c18e0e-a4ed-4f8b-acc1-ffdef9ee8309', NULL, NULL, '2023-08-15 19:47:43', '2023-08-15 19:47:43'),
(2, 'rabigorkhaly@gmail.com', '4f3f57df-da3e-4102-a306-a91afec64ad3', NULL, NULL, '2023-08-16 11:25:20', '2023-08-16 11:25:20'),
(3, 'rabigorkhaly@gmail.com', 'bc8e2176-6ff6-470c-9807-c954d6c18f58', NULL, NULL, '2023-08-24 09:47:25', '2023-08-24 09:47:25'),
(4, 'rabigorkhaly@gmail.com', '5a959faf-dbfa-4cff-93ef-7a3379fe9bda', NULL, NULL, '2023-08-30 17:35:26', '2023-08-30 17:35:26');

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateways`
--

CREATE TABLE `payment_gateways` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `url` varchar(100) DEFAULT NULL,
  `callback_url` varchar(100) DEFAULT NULL,
  `show_in_frontend` tinyint(4) DEFAULT 1,
  `status` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(98) DEFAULT NULL,
  `position` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_gateways`
--

INSERT INTO `payment_gateways` (`id`, `name`, `url`, `callback_url`, `show_in_frontend`, `status`, `created_at`, `updated_at`, `slug`, `position`) VALUES
(1, 'Esewa', 'http://localhost/donatepur/public/admin/payment-gateways/create', 'http://localhost/donatepur/public/admin/payment-gateways/create', 1, 1, '2023-06-07 04:07:00', '2023-09-16 07:07:31', 'esewa', 2),
(2, 'Khalti', 'https://sworga.rabigorkhali.com.np', 'http://localhost/donatepur/public/admin/payment-gateways/create', 1, 1, '2023-06-19 11:04:00', '2023-08-08 10:20:03', 'khalti', 1),
(3, 'Offline', 'https://sworga.rabigorkhali.com.np', 'esewa.com', 1, 0, '2023-08-06 04:00:00', '2023-08-08 10:19:50', 'offline', 4),
(4, 'Bank', 'https://sworga.rabigorkhali.com.np', 'esewa.com', 1, 1, '2023-08-08 10:11:00', '2023-08-08 10:19:37', 'bank', 5);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `table_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `key`, `table_name`, `created_at`, `updated_at`) VALUES
(1, 'browse_admin', NULL, '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(2, 'browse_bread', NULL, '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(3, 'browse_database', NULL, '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(4, 'browse_media', NULL, '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(5, 'browse_compass', NULL, '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(6, 'browse_menus', 'menus', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(7, 'read_menus', 'menus', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(8, 'edit_menus', 'menus', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(9, 'add_menus', 'menus', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(10, 'delete_menus', 'menus', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(11, 'browse_roles', 'roles', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(12, 'read_roles', 'roles', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(13, 'edit_roles', 'roles', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(14, 'add_roles', 'roles', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(15, 'delete_roles', 'roles', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(16, 'browse_users', 'users', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(17, 'read_users', 'users', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(18, 'edit_users', 'users', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(19, 'add_users', 'users', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(20, 'delete_users', 'users', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(21, 'browse_settings', 'settings', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(22, 'read_settings', 'settings', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(23, 'edit_settings', 'settings', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(24, 'add_settings', 'settings', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(25, 'delete_settings', 'settings', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(31, 'browse_posts', 'posts', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(32, 'read_posts', 'posts', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(33, 'edit_posts', 'posts', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(34, 'add_posts', 'posts', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(35, 'delete_posts', 'posts', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(36, 'browse_pages', 'pages', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(37, 'read_pages', 'pages', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(38, 'edit_pages', 'pages', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(39, 'add_pages', 'pages', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(40, 'delete_pages', 'pages', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(46, 'browse_campaign_categories', 'campaign_categories', '2023-06-03 01:09:37', '2023-06-03 01:09:37'),
(47, 'read_campaign_categories', 'campaign_categories', '2023-06-03 01:09:37', '2023-06-03 01:09:37'),
(48, 'edit_campaign_categories', 'campaign_categories', '2023-06-03 01:09:37', '2023-06-03 01:09:37'),
(49, 'add_campaign_categories', 'campaign_categories', '2023-06-03 01:09:37', '2023-06-03 01:09:37'),
(50, 'delete_campaign_categories', 'campaign_categories', '2023-06-03 01:09:37', '2023-06-03 01:09:37'),
(51, 'browse_public_users', 'public_users', '2023-06-03 01:45:10', '2023-06-03 01:45:10'),
(52, 'read_public_users', 'public_users', '2023-06-03 01:45:10', '2023-06-03 01:45:10'),
(53, 'edit_public_users', 'public_users', '2023-06-03 01:45:10', '2023-06-03 01:45:10'),
(54, 'add_public_users', 'public_users', '2023-06-03 01:45:10', '2023-06-03 01:45:10'),
(55, 'delete_public_users', 'public_users', '2023-06-03 01:45:10', '2023-06-03 01:45:10'),
(56, 'browse_campaigns', 'campaigns', '2023-06-03 02:22:46', '2023-06-03 02:22:46'),
(57, 'read_campaigns', 'campaigns', '2023-06-03 02:22:46', '2023-06-03 02:22:46'),
(58, 'edit_campaigns', 'campaigns', '2023-06-03 02:22:46', '2023-06-03 02:22:46'),
(59, 'add_campaigns', 'campaigns', '2023-06-03 02:22:46', '2023-06-03 02:22:46'),
(60, 'delete_campaigns', 'campaigns', '2023-06-03 02:22:46', '2023-06-03 02:22:46'),
(66, 'browse_donations', 'donations', '2023-06-05 04:24:59', '2023-06-05 04:24:59'),
(67, 'read_donations', 'donations', '2023-06-05 04:24:59', '2023-06-05 04:24:59'),
(68, 'edit_donations', 'donations', '2023-06-05 04:24:59', '2023-06-05 04:24:59'),
(69, 'add_donations', 'donations', '2023-06-05 04:24:59', '2023-06-05 04:24:59'),
(70, 'delete_donations', 'donations', '2023-06-05 04:24:59', '2023-06-05 04:24:59'),
(71, 'browse_withdrawals', 'withdrawals', '2023-06-05 06:17:11', '2023-06-05 06:17:11'),
(72, 'read_withdrawals', 'withdrawals', '2023-06-05 06:17:11', '2023-06-05 06:17:11'),
(73, 'edit_withdrawals', 'withdrawals', '2023-06-05 06:17:11', '2023-06-05 06:17:11'),
(74, 'add_withdrawals', 'withdrawals', '2023-06-05 06:17:11', '2023-06-05 06:17:11'),
(75, 'delete_withdrawals', 'withdrawals', '2023-06-05 06:17:11', '2023-06-05 06:17:11'),
(76, 'browse_slider_banners', 'slider_banners', '2023-06-08 09:24:09', '2023-06-08 09:24:09'),
(77, 'read_slider_banners', 'slider_banners', '2023-06-08 09:24:09', '2023-06-08 09:24:09'),
(78, 'edit_slider_banners', 'slider_banners', '2023-06-08 09:24:09', '2023-06-08 09:24:09'),
(79, 'add_slider_banners', 'slider_banners', '2023-06-08 09:24:09', '2023-06-08 09:24:09'),
(80, 'delete_slider_banners', 'slider_banners', '2023-06-08 09:24:09', '2023-06-08 09:24:09'),
(91, 'browse_contact_us', 'contact_us', '2023-06-17 23:26:59', '2023-06-17 23:26:59'),
(92, 'read_contact_us', 'contact_us', '2023-06-17 23:26:59', '2023-06-17 23:26:59'),
(93, 'edit_contact_us', 'contact_us', '2023-06-17 23:26:59', '2023-06-17 23:26:59'),
(94, 'add_contact_us', 'contact_us', '2023-06-17 23:26:59', '2023-06-17 23:26:59'),
(95, 'delete_contact_us', 'contact_us', '2023-06-17 23:26:59', '2023-06-17 23:26:59'),
(96, 'browse_payment_gateways', 'payment_gateways', '2023-06-19 11:03:34', '2023-06-19 11:03:34'),
(97, 'read_payment_gateways', 'payment_gateways', '2023-06-19 11:03:34', '2023-06-19 11:03:34'),
(98, 'edit_payment_gateways', 'payment_gateways', '2023-06-19 11:03:34', '2023-06-19 11:03:34'),
(99, 'add_payment_gateways', 'payment_gateways', '2023-06-19 11:03:34', '2023-06-19 11:03:34'),
(100, 'delete_payment_gateways', 'payment_gateways', '2023-06-19 11:03:34', '2023-06-19 11:03:34'),
(101, 'browse_system_error_logs', 'system_error_logs', '2023-06-25 02:30:26', '2023-06-25 02:30:26'),
(102, 'read_system_error_logs', 'system_error_logs', '2023-06-25 02:30:26', '2023-06-25 02:30:26'),
(103, 'edit_system_error_logs', 'system_error_logs', '2023-06-25 02:30:26', '2023-06-25 02:30:26'),
(104, 'add_system_error_logs', 'system_error_logs', '2023-06-25 02:30:26', '2023-06-25 02:30:26'),
(105, 'delete_system_error_logs', 'system_error_logs', '2023-06-25 02:30:26', '2023-06-25 02:30:26'),
(106, 'browse_user_payment_gateways', 'user_payment_gateways', '2023-07-08 03:38:55', '2023-07-08 03:38:55'),
(107, 'read_user_payment_gateways', 'user_payment_gateways', '2023-07-08 03:38:55', '2023-07-08 03:38:55'),
(108, 'edit_user_payment_gateways', 'user_payment_gateways', '2023-07-08 03:38:55', '2023-07-08 03:38:55'),
(109, 'add_user_payment_gateways', 'user_payment_gateways', '2023-07-08 03:38:55', '2023-07-08 03:38:55'),
(110, 'delete_user_payment_gateways', 'user_payment_gateways', '2023-07-08 03:38:55', '2023-07-08 03:38:55'),
(111, 'browse_testimonials', 'testimonials', '2023-07-27 09:59:58', '2023-07-27 09:59:58'),
(112, 'read_testimonials', 'testimonials', '2023-07-27 09:59:58', '2023-07-27 09:59:58'),
(113, 'edit_testimonials', 'testimonials', '2023-07-27 09:59:58', '2023-07-27 09:59:58'),
(114, 'add_testimonials', 'testimonials', '2023-07-27 09:59:58', '2023-07-27 09:59:58'),
(115, 'delete_testimonials', 'testimonials', '2023-07-27 09:59:58', '2023-07-27 09:59:58'),
(116, 'browse_partners', 'partners', '2023-07-27 10:17:49', '2023-07-27 10:17:49'),
(117, 'read_partners', 'partners', '2023-07-27 10:17:49', '2023-07-27 10:17:49'),
(118, 'edit_partners', 'partners', '2023-07-27 10:17:49', '2023-07-27 10:17:49'),
(119, 'add_partners', 'partners', '2023-07-27 10:17:49', '2023-07-27 10:17:49'),
(120, 'delete_partners', 'partners', '2023-07-27 10:17:49', '2023-07-27 10:17:49'),
(121, 'browse_usefull_links', 'usefull_links', '2023-07-29 02:55:52', '2023-07-29 02:55:52'),
(122, 'read_usefull_links', 'usefull_links', '2023-07-29 02:55:52', '2023-07-29 02:55:52'),
(123, 'edit_usefull_links', 'usefull_links', '2023-07-29 02:55:52', '2023-07-29 02:55:52'),
(124, 'add_usefull_links', 'usefull_links', '2023-07-29 02:55:52', '2023-07-29 02:55:52'),
(125, 'delete_usefull_links', 'usefull_links', '2023-07-29 02:55:52', '2023-07-29 02:55:52'),
(126, 'browse_categories', 'categories', '2023-08-24 20:49:57', '2023-08-24 20:49:57'),
(127, 'read_categories', 'categories', '2023-08-24 20:49:57', '2023-08-24 20:49:57'),
(128, 'edit_categories', 'categories', '2023-08-24 20:49:57', '2023-08-24 20:49:57'),
(129, 'add_categories', 'categories', '2023-08-24 20:49:57', '2023-08-24 20:49:57'),
(130, 'delete_categories', 'categories', '2023-08-24 20:49:57', '2023-08-24 20:49:57');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1),
(121, 1),
(122, 1),
(123, 1),
(124, 1),
(125, 1),
(126, 1),
(127, 1),
(128, 1),
(129, 1),
(130, 1);

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
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `author_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `seo_title` varchar(255) DEFAULT NULL,
  `excerpt` text DEFAULT NULL,
  `body` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `status` enum('PUBLISHED','DRAFT','PENDING') NOT NULL DEFAULT 'DRAFT',
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `author_id`, `category_id`, `title`, `seo_title`, `excerpt`, `body`, `image`, `slug`, `meta_description`, `meta_keywords`, `status`, `featured`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Aboy Loyve', NULL, 'This is the excerpt for the Lorem Ipsum Post', '<p>This is the body of the lorem ipsum post</p>', 'posts/28WFeW7IcYoLuMSOeMsm.jpeg', 'aboy-loyve', 'This is the meta description', 'keyword1, keyword2, keyword3', 'PUBLISHED', 0, '2023-06-02 20:05:53', '2023-07-29 02:32:19'),
(2, 1, 1, 'My Sample Post', NULL, 'This is the excerpt for the sample Post', '<p>This is the body for the sample post, which includes the body.</p>\r\n<h2>We can use all kinds of format!</h2>\r\n<p>And include a bunch of other stuff.</p>', 'posts/ElNyrAkqR8pxlgCxcrjs.jpg', 'my-sample-post', 'Meta Description for sample post', 'keyword1, keyword2, keyword3', 'PUBLISHED', 0, '2023-06-02 20:05:53', '2023-08-19 00:16:27'),
(3, 1, 1, 'Latest Post', NULL, 'This is the excerpt for the latest post', '<p>This is the body for the latest post</p>', 'posts/9U6AduCphyidZkS1zGR7.jpg', 'latest-post', 'This is the meta description', 'keyword1, keyword2, keyword3', 'PUBLISHED', 0, '2023-06-02 20:05:53', '2023-08-19 00:18:07'),
(4, 0, NULL, 'Yarr Post', NULL, 'Reef sails nipperkin bring a spring upon her cable coffer jury mast spike marooned Pieces of Eight poop deck pillage. Clipper driver coxswain galleon hempen halter come about pressgang gangplank boatswain swing the lead. Nipperkin yard skysail swab lanyard Blimey bilge water ho quarter Buccaneer.', '<p>Swab deadlights Buccaneer fire ship square-rigged dance the hempen jig weigh anchor cackle fruit grog furl. Crack Jennys tea cup chase guns pressgang hearties spirits hogshead Gold Road six pounders fathom measured fer yer chains. Main sheet provost come about trysail barkadeer crimp scuttle mizzenmast brig plunder.</p>\n<p>Mizzen league keelhaul galleon tender cog chase Barbary Coast doubloon crack Jennys tea cup. Blow the man down lugsail fire ship pinnace cackle fruit line warp Admiral of the Black strike colors doubloon. Tackle Jack Ketch come about crimp rum draft scuppers run a shot across the bow haul wind maroon.</p>\n<p>Interloper heave down list driver pressgang holystone scuppers tackle scallywag bilged on her anchor. Jack Tar interloper draught grapple mizzenmast hulk knave cable transom hogshead. Gaff pillage to go on account grog aft chase guns piracy yardarm knave clap of thunder.</p>', '', 'yarr-post', 'this be a meta descript', 'keyword1, keyword2, keyword3', 'PUBLISHED', 0, '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(5, 1, 1, 'sdfushdifhsdiu', NULL, NULL, '<p>iuhfsidufhsidhbf difughdifgbidfhgiudhf</p>\r\n<p>iuhfsidufhsidhbf difughdifgbidfhgiudhf</p>\r\n<p>iuhfsidufhsidhbf difughdifgbidfhgiudhf</p>\r\n<p>iuhfsidufhsidhbf difughdifgbidfhgiudhf</p>\r\n<p>iuhfsidufhsidhbf difughdifgbidfhgiudhf</p>\r\n<p>iuhfsidufhsidhbf difughdifgbidfhgiudhf</p>\r\n<p>iuhfsidufhsidhbf difughdifgbidfhgiudhf</p>\r\n<p>iuhfsidufhsidhbf difughdifgbidfhgiudhf</p>\r\n<p>iuhfsidufhsidhbf difughdifgbidfhgiudhf</p>\r\n<p>iuhfsidufhsidhbf difughdifgbidfhgiudhf</p>\r\n<p>iuhfsidufhsidhbf difughdifgbidfhgiudhf</p>\r\n<p>iuhfsidufhsidhbf difughdifgbidfhgiudhf</p>\r\n<p>iuhfsidufhsidhbf difughdifgbidfhgiudhf</p>\r\n<p>iuhfsidufhsidhbf difughdifgbidfhgiudhf</p>\r\n<p>iuhfsidufhsidhbf difughdifgbidfhgiudhf</p>\r\n<p>iuhfsidufhsidhbf difughdifgbidfhgiudhf</p>\r\n<p>iuhfsidufhsidhbf difughdifgbidfhgiudhf</p>\r\n<p>iuhfsidufhsidhbf difughdifgbidfhgiudhf</p>\r\n<p>iuhfsidufhsidhbf difughdifgbidfhgiudhf</p>', 'posts/3bdCNMoDxKxM9YqUIPuQ.JPG', 'sdfushdifhsdiu', NULL, NULL, 'PUBLISHED', 0, '2023-08-19 00:22:31', '2023-08-19 00:22:44');

-- --------------------------------------------------------

--
-- Table structure for table `public_users`
--

CREATE TABLE `public_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(25) NOT NULL,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `address` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `is_email_verified` tinyint(4) NOT NULL DEFAULT 0,
  `email_verified_at` datetime DEFAULT NULL,
  `is_kyc_verified` tinyint(3) UNSIGNED DEFAULT 0,
  `kyc_verified_by` bigint(20) DEFAULT NULL,
  `mobile_number` varchar(20) DEFAULT NULL,
  `mobile_number_secondary` varchar(20) DEFAULT NULL,
  `landline_number` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `remember_token` text DEFAULT NULL,
  `email_verify_token` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `public_users`
--

INSERT INTO `public_users` (`id`, `full_name`, `username`, `password`, `country`, `address`, `email`, `is_email_verified`, `email_verified_at`, `is_kyc_verified`, `kyc_verified_by`, `mobile_number`, `mobile_number_secondary`, `landline_number`, `date_of_birth`, `created_at`, `updated_at`, `deleted_at`, `profile_picture`, `remember_token`, `email_verify_token`, `status`) VALUES
(27, 'Rabi Gorkhali 1', 'rabi', '$2y$10$LVCEtZdwHTyVNzO5evmQ3urREoX.E9Ftj7WON5RS1HIzvfeFDTsvm', 'nepal', 'Chorcha 7, Bhaktapur', 'rabigorkhaly@gmail.com', 1, '2023-07-01 11:40:49', 0, NULL, '9843169319', '9843169319', '12123111', '2002-02-27', '2023-07-01 05:00:48', '2023-09-07 04:56:06', NULL, '/public/public-users/64f469cf033c5.jpg', NULL, 'f9ce6871-abc0-4d09-8f61-ad8abbd011c2', '1'),
(28, 'Test 2 User', 'test2users', 'test2test2', 'nepal', 'Test 2 Bhaktapur', 'test2@gmail.com', 1, '2023-07-09 12:57:00', 1, 1, '9843169319', '12121212', '12121212', '1991-03-06', '2023-07-09 01:29:08', '2023-09-07 04:55:41', NULL, 'public-users/Dk3wercgXrjUz1bazFRG.png', NULL, NULL, '1'),
(29, 'Donatepur', 'donatepur', '$2y$10$L//LikfZbGglpLxTWMo3T.28cPACkb.1OBb2GqZ9ag8ZOA9PSvE5K', 'nepal', NULL, 'donatepur@gmail.com', 1, NULL, 1, NULL, '9702236623', NULL, NULL, NULL, '2023-07-17 07:47:40', '2023-09-07 02:32:57', NULL, NULL, NULL, NULL, '1'),
(31, 'testest3', 'testest3', '$2y$10$LVCEtZdwHTyVNzO5evmQ3urREoX.E9Ftj7WON5RS1HIzvfeFDTsvm', 'nepal', 'testest3', 'testest3testest3@gmail.com', 1, NULL, 0, 1, '9999999999', '9999999999', '99999999', '2023-03-09', '2023-09-07 05:01:35', '2023-09-07 05:01:35', NULL, 'public-users/VFr4e6JHJq57cMiBjx9x.jpeg', '7P3nKpTN6Y17LQGrmEJNygx4baMprSy7fBYJzOtBidiCAjxwPLYaKieGYP3f', '23123', '1');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(2, 'user', 'Normal User', '2023-06-02 20:05:53', '2023-06-02 20:05:53');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `details` text DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `group` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `display_name`, `value`, `details`, `type`, `order`, `group`) VALUES
(1, 'site.title', 'Site Title', 'Donatepur', '', 'text', 1, 'Site'),
(2, 'site.description', 'Site Description', 'The Place of Hopes', '', 'text', 2, 'Site'),
(3, 'site.logo', 'Site Logo', 'settings/ydCsF11mYcuR9yeKLKFF.png', '', 'image', 3, 'Site'),
(4, 'site.google_analytics_tracking_id', 'Google Analytics Tracking ID', NULL, '', 'text', 4, 'Site'),
(5, 'admin.bg_image', 'Admin Background Image', '', '', 'image', 5, 'Admin'),
(6, 'admin.title', 'Admin Title', 'Donatepur', '', 'text', 1, 'Admin'),
(7, 'admin.description', 'Admin Description', 'Welcome to Voyager. The Missing Admin for Laravel', '', 'text', 2, 'Admin'),
(8, 'admin.loader', 'Admin Loader', 'settings/June2023/ON0zufKyttMt7YUEnFjp.png', '', 'image', 3, 'Admin'),
(9, 'admin.icon_image', 'Admin Icon Image', '', '', 'image', 4, 'Admin'),
(10, 'admin.google_analytics_client_id', 'Google Analytics Client ID (used for admin dashboard)', NULL, '', 'text', 1, 'Admin'),
(11, 'site.site_email', 'Email', 'rabigorkhaly@gmail.com', NULL, 'text', 6, 'Site'),
(12, 'site.mobile_number', 'mobile_number', '9843169319', NULL, 'text', 7, 'Site'),
(13, 'site.twitter_url', 'Twitter Url', 'http://localhost/donatepur/public/admin/settings', NULL, 'text', 8, 'Site'),
(14, 'site.facebook_url', 'Facebook Url', 'http://localhost/donatepur/public/admin/settings', NULL, 'text', 9, 'Site'),
(15, 'site.instagram_url', 'Instagram Url', 'http://localhost/donatepur/public/admin/settings', NULL, 'text', 10, 'Site'),
(16, 'site.linkedin_url', 'LinkedIn URL', NULL, NULL, 'text', 11, 'Site'),
(17, 'site.footer_short_description', 'Footer Short Description', 'This is footer description. I love this site.', NULL, 'text_area', 12, 'Site'),
(18, 'site.top_donar_text', 'Top Donors Text', 'You have shown us that making a difference is not just a choice, but a way of life. Your support as a donor has been instrumental in our mission, and we are forever grateful. Thank you for your commitment.', NULL, 'text_area', 13, 'Site'),
(19, 'site.site_address', 'Site Address', 'Chorcha 7, Bhaktapur', NULL, 'text', 14, 'Site'),
(20, 'site.copy_right_footer_text', 'Copy Right Text', 'Copyright ©2023 Donatepur. All Rights Reserved', NULL, 'text', 15, 'Site'),
(21, 'site.footer_faq_link', 'Footer FAQ', NULL, NULL, 'text', 16, 'Site'),
(22, 'site.footer_help_desk', 'Footer HELP DESK', NULL, NULL, 'text', 17, 'Site'),
(23, 'site.footer_donate', 'Footer Donate', NULL, NULL, 'text', 18, 'Site'),
(24, 'site.footer_get_donation', 'Footer Get Donation', NULL, NULL, 'text', 19, 'Site'),
(27, 'bank.bank_name', 'Bank Name', 'Nepal Investment Bank', NULL, 'text', 20, 'Bank'),
(28, 'bank.bank_account_number', 'Bank Account Number', '92837948234u2', NULL, 'text', 21, 'Bank'),
(29, 'bank.bank_account_name', 'Bank Account Name', 'Donatepur Pvt', NULL, 'text', 22, 'Bank'),
(30, 'bank.bank_qr', 'Bank QR', 'settings/WPP45qx31r3Hgpn6hRpb.png', NULL, 'image', 23, 'Bank'),
(31, 'site.site_meta_title', 'Site Meta Title', NULL, NULL, 'text_area', 24, 'Site'),
(32, 'site.site_key_words', 'Site Meta Keywords', 'donatepur, crowdfunding platfotm in nepal, raise donation in nepal, collect donation in nepal, donate in nepal', NULL, 'text_area', 25, 'Site'),
(33, 'site.fav_icon', 'Fav Icon', 'settings/GaBvrOA4DPv3WO6i4Rz9.png', NULL, 'image', 26, 'Site');

-- --------------------------------------------------------

--
-- Table structure for table `slider_banners`
--

CREATE TABLE `slider_banners` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `cover_image` varchar(255) NOT NULL,
  `position` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `go_to_link` varchar(300) DEFAULT '#',
  `status` tinyint(4) DEFAULT 1,
  `btn_text` varchar(120) DEFAULT 'Join Us',
  `sub_title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slider_banners`
--

INSERT INTO `slider_banners` (`id`, `title`, `description`, `cover_image`, `position`, `created_at`, `updated_at`, `go_to_link`, `status`, `btn_text`, `sub_title`) VALUES
(1, 'Fund for Nepal Trek', 'This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1This is slider 1', 'slider-banners/nvqLxj2Swv7ZeG07lmPq.jpg', 23, '2023-06-08 10:45:00', '2023-09-03 11:31:02', 'http://localhost/donatepur/public/admin/slider-banners/1/edit', 1, 'Donate', 'Help me to visit Nepal'),
(2, 'Help me attend YOGA Class', 'Warm greetings and profound gratitude! Your generous donation of Rs.111 to the \"Donate to Children\" campaign is like a radiant spark that lights up our mission. It\'s a testament to your remarkable kindness and your belief in the power of positive change. Your contribution will make a significant impact on the lives of children in need, and for that, we\'re deeply thankful. If you ever want to learn more about the impact of your donation or have any questions, please feel free to ask. Your support is a beacon of hope, and we\'re honored to have you on board. Thank you for your incredible generosity!Warm greetings and profound gratitude! Your generous donation of Rs.111 to the \"Donate to Children\" campaign is like a radiant spark that lights up our mission. It\'s a testament to your remarkable kindness and your belief in the power of positive change. Your contribution will make a significant impact on the lives of children in need, and for that, we\'re deeply thankful. If you ever want to learn more about the impact of your donation or have any questions, please feel free to ask. Your support is a beacon of hope, and we\'re honored to have you on board. Thank you for your incredible generosity!Warm greetings and profound gratitude! Your generous donation of Rs.111 to the \"Donate to Children\" campaign is like a radiant spark that lights up our mission. It\'s a testament to your remarkable kindness and your belief in the power of positive change. Your contribution will make a significant impact on the lives of children in need, and for that, we\'re deeply thankful. If you ever want to learn more about the impact of your donation or have any questions, please feel free to ask. Your support is a beacon of hope, and we\'re honored to have you on board. Thank you for your incredible generosity!Warm greetings and profound gratitude! Your generous donation of Rs.111 to the \"Donate to Children\" campaign is like a radiant spark that lights up our mission. It\'s a testament to your remarkable kindness and your belief in the power of positive change. Your contribution will make a significant impact on the lives of children in need, and for that, we\'re deeply thankful. If you ever want to learn more about the impact of your donation or have any questions, please feel free to ask. Your support is a beacon of hope, and we\'re honored to have you on board. Thank you for your incredible generosity!Warm greetings and profound gratitude! Your generous donation of Rs.111 to the \"Donate to Children\" campaign is like a radiant spark that lights up our mission. It\'s a testament to your remarkable kindness and your belief in the power of positive change. Your contribution will make a significant impact on the lives of children in need, and for that, we\'re deeply thankful. If you ever want to learn more about the impact of your donation or have any questions, please feel free to ask. Your support is a beacon of hope, and we\'re honored to have you on board. Thank you for your incredible generosity!', 'slider-banners/M7O0nOFyQFwgSG3kacde.jpg', 1, '2023-06-08 10:51:00', '2023-09-03 11:31:54', 'http://localhost/clonedonatepur/donatepur/public/admin/slider-banners/2/edit', 1, 'Support Us', 'YoGa - a happy place');

-- --------------------------------------------------------

--
-- Table structure for table `system_error_logs`
--

CREATE TABLE `system_error_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `message` text DEFAULT NULL,
  `designation` text DEFAULT NULL,
  `profile_picture` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `message`, `designation`, `profile_picture`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Shahrukh KHan', 'Educational institutions play a crucial role in preparing future generations for the AI-driven world. Integrating AI education into curricula can empower students to understand AI\'s potential, ethical implications, and responsible usage. Moreover, fostering a culture of lifelong learning will be essential to adapt to the ever-evolving technological landscape continually.\r\n\r\nIn conclusion, the future of AI holds immense potential to revolutionize society for the better. With responsible development and thoughtful consideration of its impact on humanity, AI can tackle complex challenges, improve lives, and pave the way for a more sustainable future. By embracing AI as a tool for collaboration and progress, we can ensure that it becomes a force for good and benefits all of humanity in the years to come.', 'CEO, Co-Founder', 'testimonials/f84C4UoJuGe5JdNOpJJS.jpeg', 1, '2023-07-27 10:03:23', '2023-07-27 10:03:23'),
(2, 'Salman KHan', 'Educational institutions play a crucial role in preparing future generations for the AI-driven world. Integrating AI education into curricula can empower students to understand AI\'s potential, ethical implications, and responsible usage. Moreover, fostering a culture of lifelong learning will be essential to adapt to the ever-evolving technological landscape continually.\r\n\r\nIn conclusion, the future of AI holds immense potential to revolutionize society for the better. With responsible development and thoughtful consideration of its impact on humanity, AI can tackle complex challenges, improve lives, and pave the way for a more sustainable future. By embracing AI as a tool for collaboration and progress, we can ensure that it becomes a force for good and benefits all of humanity in the years to come.', 'CEO, Co-Founder', 'testimonials/xeosrPNM2jhneOkHeF5K.jpeg', 1, '2023-07-27 10:03:43', '2023-07-27 10:03:43');

-- --------------------------------------------------------

--
-- Table structure for table `translations`
--

CREATE TABLE `translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `table_name` varchar(255) NOT NULL,
  `column_name` varchar(255) NOT NULL,
  `foreign_key` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `translations`
--

INSERT INTO `translations` (`id`, `table_name`, `column_name`, `foreign_key`, `locale`, `value`, `created_at`, `updated_at`) VALUES
(1, 'data_types', 'display_name_singular', 5, 'pt', 'Post', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(2, 'data_types', 'display_name_singular', 6, 'pt', 'Página', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(3, 'data_types', 'display_name_singular', 1, 'pt', 'Utilizador', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(4, 'data_types', 'display_name_singular', 4, 'pt', 'Categoria', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(5, 'data_types', 'display_name_singular', 2, 'pt', 'Menu', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(6, 'data_types', 'display_name_singular', 3, 'pt', 'Função', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(7, 'data_types', 'display_name_plural', 5, 'pt', 'Posts', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(8, 'data_types', 'display_name_plural', 6, 'pt', 'Páginas', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(9, 'data_types', 'display_name_plural', 1, 'pt', 'Utilizadores', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(10, 'data_types', 'display_name_plural', 4, 'pt', 'Categorias', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(11, 'data_types', 'display_name_plural', 2, 'pt', 'Menus', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(12, 'data_types', 'display_name_plural', 3, 'pt', 'Funções', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(13, 'categories', 'slug', 1, 'pt', 'categoria-1', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(14, 'categories', 'name', 1, 'pt', 'Categoria 1', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(15, 'categories', 'slug', 2, 'pt', 'categoria-2', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(16, 'categories', 'name', 2, 'pt', 'Categoria 2', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(17, 'pages', 'title', 1, 'pt', 'Olá Mundo', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(18, 'pages', 'slug', 1, 'pt', 'ola-mundo', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(19, 'pages', 'body', 1, 'pt', '<p>Olá Mundo. Scallywag grog swab Cat o\'nine tails scuttle rigging hardtack cable nipper Yellow Jack. Handsomely spirits knave lad killick landlubber or just lubber deadlights chantey pinnace crack Jennys tea cup. Provost long clothes black spot Yellow Jack bilged on her anchor league lateen sail case shot lee tackle.</p>\r\n<p>Ballast spirits fluke topmast me quarterdeck schooner landlubber or just lubber gabion belaying pin. Pinnace stern galleon starboard warp carouser to go on account dance the hempen jig jolly boat measured fer yer chains. Man-of-war fire in the hole nipperkin handsomely doubloon barkadeer Brethren of the Coast gibbet driver squiffy.</p>', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(20, 'menu_items', 'title', 1, 'pt', 'Painel de Controle', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(21, 'menu_items', 'title', 2, 'pt', 'Media', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(22, 'menu_items', 'title', 12, 'pt', 'Publicações', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(23, 'menu_items', 'title', 3, 'pt', 'Utilizadores', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(24, 'menu_items', 'title', 11, 'pt', 'Categorias', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(25, 'menu_items', 'title', 13, 'pt', 'Páginas', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(26, 'menu_items', 'title', 4, 'pt', 'Funções', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(27, 'menu_items', 'title', 5, 'pt', 'Ferramentas', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(28, 'menu_items', 'title', 6, 'pt', 'Menus', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(29, 'menu_items', 'title', 7, 'pt', 'Base de dados', '2023-06-02 20:05:53', '2023-06-02 20:05:53'),
(30, 'menu_items', 'title', 10, 'pt', 'Configurações', '2023-06-02 20:05:53', '2023-06-02 20:05:53');

-- --------------------------------------------------------

--
-- Table structure for table `usefull_links`
--

CREATE TABLE `usefull_links` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text DEFAULT NULL,
  `url` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usefull_links`
--

INSERT INTO `usefull_links` (`id`, `title`, `url`, `created_at`, `updated_at`) VALUES
(1, 'Test 1', 'https://sworga.rabigorkhali.com.np', '2023-07-29 02:56:08', '2023-07-29 02:56:08'),
(2, 'Test2', 'https://sworga.rabigorkhali.com.np', '2023-07-29 02:56:15', '2023-07-29 02:56:15'),
(3, 'Test3', 'https://youtu.be/izGwDsrQ1eQ', '2023-07-29 02:56:25', '2023-07-29 02:56:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT 'users/default.png',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `settings` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `avatar`, `email_verified_at`, `password`, `remember_token`, `settings`, `created_at`, `updated_at`) VALUES
(1, 1, 'Rabi Gorkhali', 'rabigorkhaly@gmail.com', 'users/September2023/ZxOcp8TJ4thESKzobt3I.jpeg', NULL, '$2y$10$6Tc2h4VEuyR60ytaz1SPCOmB2uPk0qlDAlUGVKjrfXzmnsESQsSXa', 'RFn5xjvl5SKC5KtQtLDWpT6dOowxArSlak6UF56xj6Zxal7A7Nqd4WfRYgm2', '{\"locale\":\"en\"}', '2023-06-02 20:05:53', '2023-09-01 07:33:00'),
(2, 2, 'name', 'rabigorkhaly11@gmail.com', 'users/default.png', NULL, '$2y$10$ayAkCLfYYZr8J4yJS1GLqu7rbgkCe6fLrAfnqzcKY2RZcLhhWFbze', NULL, NULL, '2023-06-14 09:00:53', '2023-06-14 09:00:53');

-- --------------------------------------------------------

--
-- Table structure for table `user_payment_gateways`
--

CREATE TABLE `user_payment_gateways` (
  `id` int(10) UNSIGNED NOT NULL,
  `public_user_id` bigint(20) NOT NULL,
  `mobile_number` varchar(14) NOT NULL,
  `detail` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `qr_code` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `payment_gateway_name` varchar(100) DEFAULT NULL,
  `bank_account_number` varchar(100) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `bank_address` varchar(100) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_payment_gateways`
--

INSERT INTO `user_payment_gateways` (`id`, `public_user_id`, `mobile_number`, `detail`, `created_at`, `updated_at`, `qr_code`, `status`, `payment_gateway_name`, `bank_account_number`, `bank_name`, `bank_address`, `deleted_at`) VALUES
(7, 27, '9843169319', 'jhgjhjhghvhgvujghvjhjhgjhgjhgjhgjhgjhgjhgjhgjhgjhg', NULL, NULL, NULL, 1, 'Esewa', 'eswa', 'eswa', 'eswa', NULL),
(12, 27, '9843169319', 'dfkjsndkfjs dfjksndfkjsndf', NULL, NULL, NULL, 1, 'Bank', '1232435345', 'Investment Bank', 'Chorcha 7, Bhaktapur', NULL),
(13, 27, '9843169319', 'dfgdifughdifughidufhgidufhgiduhfgiudhfgiudhfigudhfiguhdfiughdifughdifughdiufghdiufhgdiufhgidufhgidufhgiudfhgidufhgiudhfg', NULL, NULL, NULL, 1, 'Bank', '345345345', 'Test', 'Chorcha 7, Bhaktapur', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `campaign_id` bigint(20) NOT NULL,
  `withdrawal_status` varchar(50) DEFAULT NULL,
  `withdrawal_transaction_id` varchar(100) DEFAULT NULL,
  `user_payment_gateway_id` bigint(20) DEFAULT NULL,
  `withdrawal_mobile_number` varchar(100) DEFAULT NULL,
  `withdrawal_amount` varchar(100) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `public_user_id` bigint(20) DEFAULT NULL,
  `successful_withdrawal_date` timestamp NULL DEFAULT NULL,
  `withdrawal_service_charge` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdrawals`
--

INSERT INTO `withdrawals` (`id`, `campaign_id`, `withdrawal_status`, `withdrawal_transaction_id`, `user_payment_gateway_id`, `withdrawal_mobile_number`, `withdrawal_amount`, `deleted_at`, `created_at`, `updated_at`, `public_user_id`, `successful_withdrawal_date`, `withdrawal_service_charge`) VALUES
(1, 21, 'pending', NULL, 13, '9843169319', '204', NULL, '2023-09-07 02:33:39', NULL, 27, NULL, 15),
(2, 22, 'processing', NULL, 7, '9843169319', '1230', NULL, '2023-09-07 02:37:15', '2023-09-07 02:37:43', 27, '2023-09-12 08:21:00', 12);

-- --------------------------------------------------------

--
-- Structure for view `campaigns_summary_view`
--
DROP TABLE IF EXISTS `campaigns_summary_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`donatepu`@`localhost` SQL SECURITY DEFINER VIEW `campaigns_summary_view`  AS SELECT `cmp`.`id` AS `id`, `cmp`.`title` AS `title`, `cmp`.`description` AS `description`, `cmp`.`start_date` AS `start_date`, `cmp`.`end_date` AS `end_date`, `cmp`.`goal_amount` AS `goal_amount`, `cmp`.`country` AS `country`, `cmp`.`address` AS `address`, `cmp`.`campaign_status` AS `campaign_status`, `cmp`.`campaign_category_id` AS `campaign_category_id`, `cmp`.`is_featured` AS `is_featured`, `cmp`.`video_url` AS `video_url`, `cmp`.`public_user_id` AS `public_user_id`, `cmp`.`anonymous` AS `anonymous`, `cmp`.`created_at` AS `created_at`, `cmp`.`updated_at` AS `updated_at`, `cmp`.`deleted_at` AS `deleted_at`, `cmp`.`status` AS `status`, `cmp`.`slug` AS `slug`, `cmp`.`images` AS `images`, `cmp`.`cover_image` AS `cover_image`, (select sum(`donations`.`amount`) from `donations` where `donations`.`campaign_id` = `cmp`.`id` and `donations`.`payment_status` = 'completed') AS `summary_total_collection`, (select floor(sum(`don`.`amount` - `don`.`amount` * `don`.`service_charge_percentage` / 100)) from `donations` `don` where `don`.`campaign_id` = `cmp`.`id` and `don`.`payment_status` = 'completed') AS `net_amount_collection`, (select count(`campaign_visits`.`id`) from `campaign_visits` where `campaign_visits`.`campaign_id` = `cmp`.`id`) AS `total_visits`, (select floor(sum(`don`.`amount` * `don`.`service_charge_percentage` / 100)) from `donations` `don` where `don`.`campaign_id` = `cmp`.`id` and `don`.`payment_status` = 'completed') AS `summary_service_charge_amount`, (select count(`donations`.`id`) from `donations` where `donations`.`campaign_id` = `cmp`.`id` and `donations`.`payment_status` = 'completed') AS `total_number_donation` FROM `campaigns` AS `cmp` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `campaigns_slug_unique` (`slug`);

--
-- Indexes for table `campaign_categories`
--
ALTER TABLE `campaign_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `campaign_categories_slug_unique` (`slug`);

--
-- Indexes for table `campaign_visits`
--
ALTER TABLE `campaign_visits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_us_name_index` (`name`),
  ADD KEY `contact_us_email_index` (`email`),
  ADD KEY `contact_us_phone_index` (`phone`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_rows`
--
ALTER TABLE `data_rows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_rows_data_type_id_foreign` (`data_type_id`);

--
-- Indexes for table `data_types`
--
ALTER TABLE `data_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_types_name_unique` (`name`),
  ADD UNIQUE KEY `data_types_slug_unique` (`slug`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `donations_slug_unique` (`slug`),
  ADD KEY `donations_mobile_number_index` (`mobile_number`),
  ADD KEY `donations_email_index` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_name_unique` (`name`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_items_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `password_reset_public_user`
--
ALTER TABLE `password_reset_public_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `password_reset_public_user_token_unique` (`token`);

--
-- Indexes for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_gateways_slug_unique` (`slug`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_key_index` (`key`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_permission_id_index` (`permission_id`),
  ADD KEY `permission_role_role_id_index` (`role_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`);

--
-- Indexes for table `public_users`
--
ALTER TABLE `public_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `slider_banners`
--
ALTER TABLE `slider_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_error_logs`
--
ALTER TABLE `system_error_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `translations_table_name_column_name_foreign_key_locale_unique` (`table_name`,`column_name`,`foreign_key`,`locale`);

--
-- Indexes for table `usefull_links`
--
ALTER TABLE `usefull_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `user_payment_gateways`
--
ALTER TABLE `user_payment_gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `user_roles_user_id_index` (`user_id`),
  ADD KEY `user_roles_role_id_index` (`role_id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `campaign_categories`
--
ALTER TABLE `campaign_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `campaign_visits`
--
ALTER TABLE `campaign_visits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- AUTO_INCREMENT for table `data_rows`
--
ALTER TABLE `data_rows`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=261;

--
-- AUTO_INCREMENT for table `data_types`
--
ALTER TABLE `data_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `password_reset_public_user`
--
ALTER TABLE `password_reset_public_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `public_users`
--
ALTER TABLE `public_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `slider_banners`
--
ALTER TABLE `slider_banners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `system_error_logs`
--
ALTER TABLE `system_error_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `translations`
--
ALTER TABLE `translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `usefull_links`
--
ALTER TABLE `usefull_links`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_payment_gateways`
--
ALTER TABLE `user_payment_gateways`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
