-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 06, 2020 at 02:57 PM
-- Server version: 5.7.31-0ubuntu0.18.04.1
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_authentication_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2020_06_07_045915_create_products_table', 1),
(4, '2014_10_12_100000_create_password_resets_table', 2),
(7, '2020_08_07_092838_create_skills_table', 3),
(8, '2020_08_07_095146_create_skill_user_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` double(8,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `status`, `name`, `description`, `price`, `image`, `created_at`, `updated_at`) VALUES
(81, 1, 'ghfg', 'hfg', 67567.00, NULL, '2020-09-01 04:45:47', '2020-09-01 04:45:47'),
(82, 0, 'fdsfds', 'ffsdfdsf', 32432.00, '1598974410-images.jpeg', '2020-09-01 09:33:30', '2020-09-04 10:00:08'),
(83, 1, 'tyrtyr', 'yrty', 5453.00, NULL, '2020-09-04 10:02:40', '2020-09-04 10:02:40');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Johnathan', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(2, 'Peyton', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(3, 'Stan', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(4, 'Domingo', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(5, 'Willy', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(6, 'Isaias', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(7, 'Laron', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(8, 'Cristopher', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(9, 'Thad', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(10, 'Hyman', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(11, 'Allen', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(12, 'Edwardo', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(13, 'Declan', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(14, 'Eladio', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(15, 'Jordyn', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(16, 'Dion', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(17, 'Ethan', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(18, 'Oda', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(19, 'Rodrick', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(20, 'Kamren', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(21, 'Delmer', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(22, 'Kevin', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(23, 'Domenic', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(24, 'Ezra', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(25, 'Merle', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(26, 'Manuel', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(27, 'Wilson', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(28, 'Jermain', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(29, 'Montana', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(30, 'Xzavier', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(31, 'Jeremie', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(32, 'Ross', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(33, 'Abdullah', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(34, 'Lukas', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(35, 'Cleveland', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(36, 'Cole', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(37, 'Nikko', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(38, 'Carson', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(39, 'Mitchell', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(40, 'Adrien', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(41, 'Rollin', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(42, 'Jeffry', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(43, 'Ernest', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(44, 'Reed', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(45, 'Antone', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(46, 'Sigmund', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(47, 'Friedrich', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(48, 'Jayme', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(49, 'Afton', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(50, 'Albin', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(51, 'Kristoffer', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(52, 'Ryan', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(53, 'Bernardo', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(54, 'Rylan', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(55, 'Arvid', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(56, 'Daryl', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(57, 'Orland', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(58, 'Jovani', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(59, 'Watson', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(60, 'Mason', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(61, 'Clemens', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(62, 'Erin', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(63, 'Cory', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(64, 'Boyd', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(65, 'Gunner', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(66, 'Jamaal', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(67, 'Javier', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(68, 'Rodolfo', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(69, 'Jaylin', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(70, 'Rudolph', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(71, 'Saul', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(72, 'Benton', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(73, 'Rocio', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(74, 'Christopher', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(75, 'Kay', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(76, 'Santos', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(77, 'Tito', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(78, 'Arden', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(79, 'Gussie', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(80, 'Arne', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(81, 'Clay', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(82, 'Jimmy', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(83, 'Lindsey', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(84, 'Brandt', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(85, 'Isadore', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(86, 'Rosario', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(87, 'Savion', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(88, 'Cordelia', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(89, 'Leone', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(90, 'Josh', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(91, 'Kody', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(92, 'Marley', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(93, 'Jett', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(94, 'Nathen', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(95, 'Darian', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(96, 'Evan', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(97, 'Gabe', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(98, 'Lewis', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(99, 'Sofia', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(100, 'Percy', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(101, 'Chester', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(102, 'Murphy', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(103, 'Lincoln', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(104, 'Giuseppe', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(105, 'Antonio', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(106, 'Terrence', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(107, 'Nasir', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(108, 'Kayleigh', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(109, 'Louie', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(110, 'Xander', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(111, 'Alexandre', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(112, 'Marvin', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(113, 'Jeff', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(114, 'Aiden', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(115, 'Kristian', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(116, 'Marcus', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(117, 'Roscoe', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(118, 'Dylan', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(119, 'Preston', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(120, 'Frank', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(121, 'Lew', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(122, 'Russell', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(123, 'Ewell', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(124, 'Daron', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(125, 'Vicente', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(126, 'Connor', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(127, 'Rupert', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(128, 'Wilburn', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(129, 'Jayson', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(130, 'Constantin', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(131, 'Vidal', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(132, 'Rolando', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(133, 'Brayan', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(134, 'Lucius', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(135, 'Sage', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(136, 'Mohammed', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(137, 'Jesus', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(138, 'Columbus', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(139, 'Zackery', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(140, 'Selmer', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(141, 'Nathaniel', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(142, 'Alfredo', '2020-08-07 03:54:09', '2020-08-07 03:54:09'),
(144, 'Richard', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(146, 'Caleb', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(147, 'Milan', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(148, 'Enrico', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(149, 'Kurt', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(150, 'Macey', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(151, 'Arno', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(152, 'Joel', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(153, 'Joshuah', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(154, 'Clement', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(155, 'Clinton', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(156, 'Ramon', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(157, 'Ernie', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(158, 'Hector', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(159, 'Tyson', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(160, 'Cordell', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(161, 'Darrin', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(162, 'Lyric', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(163, 'Consuelo', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(164, 'Torrey', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(165, 'Madyson', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(166, 'Vladimir', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(167, 'Elbert', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(168, 'Dennis', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(169, 'Mack', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(170, 'Jaden', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(171, 'Gaetano', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(172, 'Jarrell', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(173, 'Darien', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(174, 'Ferne', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(175, 'Santino', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(176, 'Mikel', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(177, 'Ricardo', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(178, 'Mose', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(179, 'Cristobal', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(180, 'Jamie', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(181, 'Dee', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(182, 'Chesley', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(183, 'Samson', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(184, 'Judah', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(185, 'Wilfred', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(186, 'Neal', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(187, 'Rogelio', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(188, 'Lonnie', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(189, 'Frederic', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(190, 'Stanley', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(191, 'Einar', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(192, 'Kurtis', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(193, 'Angus', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(194, 'Ceasar', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(195, 'Diego', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(196, 'Ruben', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(197, 'Jarvis', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(198, 'Seamus', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(199, 'Oren', '2020-08-07 03:54:10', '2020-08-07 03:54:10'),
(200, 'Drake', '2020-08-07 03:54:10', '2020-08-07 03:54:10');

-- --------------------------------------------------------

--
-- Table structure for table `skill_user`
--

CREATE TABLE `skill_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `skill_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skill_user`
--

INSERT INTO `skill_user` (`id`, `user_id`, `skill_id`) VALUES
(8, 2, 8),
(9, 2, 46),
(10, 2, 17);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `image`, `email`, `address`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Abdullah Al Mamun', '1598951517-images.jpeg', 'test@gmail.com', 'Pabna, Bangladesh', NULL, '$2y$10$FZ2zZuD.Ce.HFpWZ6wCAkOjpTI8ebSZSnEEy3lX2Mikd2iUfnuQLG', '0vt8MWlQAvvu9cQc47aRzRreyIt27Dm4U50GuKw1heM5VOifQc7MBW8tQSB8', '2020-06-13 09:40:28', '2020-09-01 03:11:57'),
(11, 'fsfdsf', NULL, 'dsfsdf@test.com', 'sfsdfs', NULL, '$2y$10$TlTfUZhYhIHkfYglxdpoyOHetNc/.HvH0bNvueOu1k57f8us3zPIC', NULL, '2020-06-15 10:42:03', '2020-06-15 10:42:03'),
(12, 'fsfdsf', NULL, 'dsfs111df@test.com', 'sfsdfs', NULL, '$2y$10$TiHSUy0qeC92cjLHWiZnX.INBcSeskaeuqUoAvDAUEvczbpwTHdRi', NULL, '2020-06-16 09:03:09', '2020-06-16 09:03:09'),
(13, 'Aut reiciendis perfe', NULL, 'nyziq@mailinator.com', 'In qui quia expedita', NULL, '$2y$10$ttJ1I0z2.IV0DeEmwJJ2rOYdMDGP8KwbfCeGsQVDFeV0LTx2eBp52', NULL, '2020-07-15 08:57:38', '2020-07-15 08:57:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `skill_user`
--
ALTER TABLE `skill_user`
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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `skill_user`
--
ALTER TABLE `skill_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
