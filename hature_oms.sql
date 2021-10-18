-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 18, 2021 at 10:11 PM
-- Server version: 8.0.26-0ubuntu0.20.04.3
-- PHP Version: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hature_oms`
--

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `_lft` bigint UNSIGNED DEFAULT NULL,
  `_rgt` bigint UNSIGNED DEFAULT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `charge` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `name`, `created_by_id`, `_lft`, `_rgt`, `parent_id`, `charge`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Rampura', 1, NULL, NULL, NULL, NULL, '2021-10-10 11:10:08', '2021-10-10 11:10:08', NULL),
(2, 'Basabo', 1, NULL, NULL, NULL, NULL, '2021-10-10 11:11:00', '2021-10-10 11:11:00', NULL),
(3, 'Badda', 1, NULL, NULL, NULL, NULL, '2021-10-10 11:11:00', '2021-10-10 11:11:00', NULL),
(4, 'Malibag', 1, NULL, NULL, NULL, NULL, '2021-10-10 11:11:00', '2021-10-10 11:11:00', NULL),
(5, 'Khalgaon', 1, NULL, NULL, NULL, NULL, '2021-10-10 11:11:00', '2021-10-10 11:11:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `created_by_id`, `name`, `alias`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Grocery', 'Foodstuffs', 1, '2021-10-05 16:50:42', '2021-10-05 16:50:42', NULL),
(2, 1, 'Stationery', 'Stationery', 1, '2021-10-05 16:52:30', '2021-10-05 16:52:30', NULL),
(3, 1, 'Sanitary', 'Sanitary', 1, '2021-10-05 16:55:39', '2021-10-10 14:32:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company_task_order_types`
--

CREATE TABLE `company_task_order_types` (
  `id` bigint UNSIGNED NOT NULL,
  `company_id` bigint UNSIGNED NOT NULL,
  `type_id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge` decimal(11,2) DEFAULT NULL,
  `slab_type` enum('F','P') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_task_order_types`
--

INSERT INTO `company_task_order_types` (`id`, `company_id`, `type_id`, `type`, `color`, `charge`, `slab_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 2, 'Delivery', '#5974ff', '2.00', 'P', '2021-10-10 11:02:34', '2021-10-10 11:02:34', NULL),
(2, 5, 2, 'Delivery', '#5974ff', '3.00', 'P', '2021-10-10 11:04:38', '2021-10-10 11:04:38', NULL),
(3, 6, 2, 'Delivery', '#5974ff', '5.00', 'P', '2021-10-10 11:04:38', '2021-10-10 11:04:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `failed_jobs`
--

INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(1, 'c4e133a1-61c7-4b53-b7f3-b21570e86276', 'database', 'default', '{\"uuid\":\"c4e133a1-61c7-4b53-b7f3-b21570e86276\",\"displayName\":\"App\\\\Jobs\\\\SendOtpMailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendOtpMailJob\",\"command\":\"O:23:\\\"App\\\\Jobs\\\\SendOtpMailJob\\\":12:{s:7:\\\"\\u0000*\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:6:\\\"\\u0000*\\u0000otp\\\";i:123456;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2021-10-11 12:59:32.363454\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'ErrorException: Trying to get property \'email\' of non-object in /var/www/html/HatureOMS/app/Jobs/SendOtpMailJob.php:36\nStack trace:\n#0 /var/www/html/HatureOMS/app/Jobs/SendOtpMailJob.php(36): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError()\n#1 /var/www/html/HatureOMS/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\SendOtpMailJob->handle()\n#2 /var/www/html/HatureOMS/vendor/laravel/framework/src/Illuminate/Container/Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#3 /var/www/html/HatureOMS/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#4 /var/www/html/HatureOMS/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#5 /var/www/html/HatureOMS/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#6 /var/www/html/HatureOMS/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call()\n#7 /var/www/html/HatureOMS/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#8 /var/www/html/HatureOMS/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#9 /var/www/html/HatureOMS/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then()\n#10 /var/www/html/HatureOMS/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(120): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#11 /var/www/html/HatureOMS/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#12 /var/www/html/HatureOMS/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#13 /var/www/html/HatureOMS/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(122): Illuminate\\Pipeline\\Pipeline->then()\n#14 /var/www/html/HatureOMS/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#15 /var/www/html/HatureOMS/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call()\n#16 /var/www/html/HatureOMS/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(428): Illuminate\\Queue\\Jobs\\Job->fire()\n#17 /var/www/html/HatureOMS/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(378): Illuminate\\Queue\\Worker->process()\n#18 /var/www/html/HatureOMS/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(172): Illuminate\\Queue\\Worker->runJob()\n#19 /var/www/html/HatureOMS/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(117): Illuminate\\Queue\\Worker->daemon()\n#20 /var/www/html/HatureOMS/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(101): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#21 /var/www/html/HatureOMS/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#22 /var/www/html/HatureOMS/vendor/laravel/framework/src/Illuminate/Container/Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#23 /var/www/html/HatureOMS/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#24 /var/www/html/HatureOMS/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#25 /var/www/html/HatureOMS/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call()\n#26 /var/www/html/HatureOMS/vendor/laravel/framework/src/Illuminate/Console/Command.php(136): Illuminate\\Container\\Container->call()\n#27 /var/www/html/HatureOMS/vendor/symfony/console/Command/Command.php(299): Illuminate\\Console\\Command->execute()\n#28 /var/www/html/HatureOMS/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run()\n#29 /var/www/html/HatureOMS/vendor/symfony/console/Application.php(978): Illuminate\\Console\\Command->run()\n#30 /var/www/html/HatureOMS/vendor/symfony/console/Application.php(295): Symfony\\Component\\Console\\Application->doRunCommand()\n#31 /var/www/html/HatureOMS/vendor/symfony/console/Application.php(167): Symfony\\Component\\Console\\Application->doRun()\n#32 /var/www/html/HatureOMS/vendor/laravel/framework/src/Illuminate/Console/Application.php(92): Symfony\\Component\\Console\\Application->run()\n#33 /var/www/html/HatureOMS/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run()\n#34 /var/www/html/HatureOMS/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#35 {main}', '2021-10-11 06:59:35');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_07_28_124629_create_otps_table', 1),
(5, '2021_08_02_060051_create_password_histories', 1),
(6, '2021_08_02_062735_add_password_column_in_password_histories_table', 1),
(7, '2021_08_08_113530_create_categories_table', 1),
(8, '2021_08_08_113730_create_products_table', 1),
(9, '2021_08_08_113731_product_foregin_relation_with_catagory_by_catagory_id', 1),
(10, '2021_08_10_105956_drop_created_by_id_column_from_categories_table', 2),
(11, '2021_08_10_111206_add_created_by_id_column_for_categories_table', 3),
(12, '2021_08_12_055219_modify_columns_unit_price_height_width_weight_size_to_decimal_for_products_table', 4),
(13, '2021_08_12_060016_move_column_created_by_id_after_id_for_categories_table', 5),
(14, '2021_08_12_060017_move_column_created_by_id_after_id_for_categories_table', 6),
(15, '2021_08_12_063059_drop_column_created_by_id_for_categories_table', 7),
(16, '2021_08_12_063630_add_column_created_by_id_for_categories_table', 8),
(17, '2021_08_16_060804_create_user_types_table', 9),
(18, '2021_08_16_062252_add_user_type_id_column_for_users_table', 9),
(19, '2021_08_16_101122_add_status_column_for_users_table', 10),
(20, '2021_08_16_101805_drop_status_column_from_users_table', 11),
(21, '2021_08_16_101941_add_status_column_for_users_table', 12),
(22, '2021_08_16_112057_create_users_agents_table', 13),
(23, '2021_08_16_112200_create_users_merchants_table', 13),
(24, '2021_08_16_113541_add_deleted_at_column_for_users_merchants_table', 14),
(25, '2021_08_17_111933_add_deleted_at_column_for_users_table', 15),
(26, '2021_08_18_052706_add_mobile_column_for_users_table', 16),
(27, '2021_08_19_113147_add_columns_for_users_table', 17),
(28, '2021_08_19_162354_add_column_avater_for_users_table', 18),
(29, '2021_08_24_090647_add_measurement_unit_column_for_products_table', 19),
(30, '2021_08_24_095932_create_areas_table', 20),
(31, '2021_08_24_102715_create_universal_task_order_types_table', 21),
(32, '2021_08_24_102900_create_universal_task_order_statuses_table', 22),
(33, '2021_08_24_103001_create_company_task_order_types_table', 23),
(34, '2021_08_24_105156_create_orders_table', 24),
(35, '2021_08_24_105233_create_order_statuses_table', 25),
(36, '2021_08_24_105303_create_order_assignments_table', 26),
(37, '2021_08_26_142349_add_column_for_company_task_order_types', 27),
(38, '2021_08_26_144054_add__company_id_and_type_id_column_for_company_task_order_types', 28),
(39, '2021_08_26_200100_add_column_for_universal_task_order_types_table', 29),
(40, '2021_08_28_114040_add_status_column_for_users_merchants_table', 30),
(41, '2021_09_12_062827_drop_product_unit_id_for_order_products_table', 31),
(42, '2021_09_12_063717_add_columns_for_order_products_table', 32),
(43, '2021_09_12_064939_modify_columns_for_order_products_table', 33),
(45, '2021_09_19_121642_create_order_assignment_activities_table', 34),
(46, '2021_09_21_132619_create_tasks_table', 35),
(47, '2021_09_22_060541_create_task_status_activities_table', 36),
(48, '2021_09_28_112217_add_column_for_order_table', 37),
(49, '2021_09_29_064444_create_user_account_types_table', 38),
(50, '2021_09_29_064512_create_user_accounts_table', 38),
(51, '2021_09_29_074858_add_column_for_user_accounts_table', 39),
(53, '2021_09_29_082703_create_statements_table', 40),
(56, '2021_09_29_114023_create_transaction_types_table', 43),
(57, '2021_09_29_114545_create_transaction_statuses_table', 44),
(58, '2021_09_29_115250_create_transactions_table', 45),
(59, '2021_10_11_120411_create_jobs_table', 46);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `order_type_id` bigint UNSIGNED DEFAULT NULL,
  `contact_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_lat` double DEFAULT NULL,
  `address_lng` double DEFAULT NULL,
  `product_weight` decimal(8,2) DEFAULT NULL,
  `product_height` decimal(8,2) DEFAULT NULL,
  `product_length` decimal(8,2) DEFAULT NULL,
  `product_width` decimal(8,2) DEFAULT NULL,
  `deadline` timestamp NULL DEFAULT NULL,
  `ref_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(8,2) DEFAULT NULL,
  `collected_amount` decimal(11,2) DEFAULT NULL,
  `instruction` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `created_by_id`, `order_type_id`, `contact_name`, `contact_company_name`, `contact_mobile`, `contact_email`, `image`, `address`, `address_lat`, `address_lng`, `product_weight`, `product_height`, `product_length`, `product_width`, `deadline`, `ref_id`, `amount`, `collected_amount`, `instruction`, `note`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '279d37006b', 6, 2, 'Sumit', NULL, '01818111112', 'sumit@gmail.com', NULL, '111/B, East Rampura', NULL, NULL, '0.00', '0.00', '0.00', '0.00', '2021-10-19 18:00:00', '1', '515.00', NULL, 'Call before delivery.', 'Get fresh products.', '2021-09-17 05:15:51', '2021-10-10 05:15:51', NULL),
(2, '46260637b7', 4, 2, 'Harun', NULL, '01818111110', 'harun@gmail.com', NULL, '216, Mirpur DOHS', NULL, NULL, '0.00', '0.00', '0.00', '0.00', '2021-10-14 18:00:00', '1', '435.00', '450.00', 'Call before delivery.', 'Please delivery products quickly.', '2021-09-16 08:20:31', '2021-10-10 06:27:55', NULL),
(3, '5d4786a903', 1, 2, 'Sumit', NULL, '01818111112', 'sumit@gmail.com', NULL, '111/B, East Rampura', NULL, NULL, '0.00', '0.00', '0.00', '0.00', '2021-10-23 18:00:00', '1', '28250.00', NULL, 'Please call before delivery.', 'Get fresh product.', '2021-09-17 00:06:27', '2021-10-17 00:13:00', NULL),
(4, '26c1d6c919', 1, 2, 'Altaf', NULL, '01818111111', 'altaf@gmail.com', NULL, '716, Mirpur DOHS', NULL, NULL, '0.00', '0.00', '0.00', '0.00', '2021-10-30 18:00:00', '1', '295.00', NULL, 'Please call before delivery.', 'Get the fresh products.', '2021-09-17 14:14:10', '2021-10-18 16:06:33', NULL),
(5, '5830de3907', 1, 2, 'Harun', NULL, 'harun@gmail.com', 'harun@gmail.com', NULL, '216, Mirpur DOHS', NULL, NULL, '0.00', '0.00', '0.00', '0.00', '2021-10-16 18:00:00', '1', '605.00', NULL, 'Please call before delivery.', 'Get the fresh products.', '2021-09-17 00:06:27', '2021-10-17 00:13:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_assignments`
--

CREATE TABLE `order_assignments` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED DEFAULT NULL,
  `assigned_by_id` bigint UNSIGNED NOT NULL,
  `assigned_to_id` bigint UNSIGNED NOT NULL,
  `current_order_status_id` bigint UNSIGNED DEFAULT NULL,
  `collected_amount` decimal(8,2) DEFAULT NULL,
  `area_id` bigint UNSIGNED DEFAULT NULL,
  `service_charge` decimal(8,2) DEFAULT NULL,
  `area_charge` decimal(8,2) DEFAULT NULL,
  `weight_charge` decimal(8,2) DEFAULT NULL,
  `delivery_type_charge` decimal(8,2) DEFAULT NULL,
  `cancellation_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reschedule_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment` enum('PAID','DUE','IN PROGRESS') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_assignments`
--

INSERT INTO `order_assignments` (`id`, `order_id`, `assigned_by_id`, `assigned_to_id`, `current_order_status_id`, `collected_amount`, `area_id`, `service_charge`, `area_charge`, `weight_charge`, `delivery_type_charge`, `cancellation_reason`, `reschedule_reason`, `payment`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 6, 1, 6, NULL, 1, '15.45', NULL, NULL, NULL, NULL, NULL, 'DUE', '2021-10-10 05:15:51', '2021-10-10 06:03:20', NULL),
(2, 2, 4, 1, 4, NULL, 5, '13.05', NULL, NULL, NULL, NULL, NULL, 'DUE', '2021-10-10 05:20:31', '2021-10-10 06:27:55', NULL),
(3, 3, 6, 1, 1, NULL, 1, '847.50', NULL, NULL, NULL, NULL, NULL, 'DUE', '2021-10-14 04:58:00', '2021-10-17 00:13:00', NULL),
(4, 4, 5, 1, 6, NULL, 4, '8.85', NULL, NULL, NULL, NULL, NULL, 'DUE', '2021-10-16 14:14:10', '2021-10-16 14:17:24', NULL),
(5, 5, 5, 1, 1, NULL, 2, '18.15', NULL, NULL, NULL, NULL, NULL, 'DUE', '2021-09-17 00:06:27', '2021-10-17 00:13:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_assignment_activities`
--

CREATE TABLE `order_assignment_activities` (
  `id` bigint UNSIGNED NOT NULL,
  `order_assignment_id` bigint UNSIGNED NOT NULL,
  `created_by_id` bigint UNSIGNED NOT NULL,
  `status_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_assignment_activities`
--

INSERT INTO `order_assignment_activities` (`id`, `order_assignment_id`, `created_by_id`, `status_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, 6, '2021-10-10 06:03:05', '2021-10-10 06:03:05', NULL),
(2, 1, 1, 6, '2021-10-10 06:03:20', '2021-10-10 06:03:20', NULL),
(3, 2, 7, 4, '2021-10-10 06:27:55', '2021-10-10 06:27:55', NULL),
(4, 2, 7, 4, '2021-10-10 06:27:55', '2021-10-10 06:27:55', NULL),
(6, 4, 1, 6, '2021-10-16 14:17:24', '2021-10-16 14:17:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED DEFAULT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `measurement_unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_price` decimal(11,2) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `total_price` decimal(11,2) DEFAULT NULL,
  `ref` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `order_id`, `product_id`, `measurement_unit`, `unit_price`, `quantity`, `total_price`, `ref`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'kg', '90.00', 1, '90.00', NULL, '2021-10-10 05:15:51', '2021-10-10 05:15:51', NULL),
(2, 1, 2, 'kg', '100.00', 1, '100.00', NULL, '2021-10-10 05:15:51', '2021-10-10 05:15:51', NULL),
(3, 1, 3, 'kg', '65.00', 5, '325.00', NULL, '2021-10-10 05:15:51', '2021-10-10 05:15:51', NULL),
(4, 2, 4, 'piece', '50.00', 5, '250.00', NULL, '2021-10-10 05:20:31', '2021-10-10 05:20:31', NULL),
(5, 2, 5, 'piece', '15.00', 10, '150.00', NULL, '2021-10-10 05:20:31', '2021-10-10 05:20:31', NULL),
(6, 2, 6, 'piece', '5.00', 7, '35.00', NULL, '2021-10-10 05:20:31', '2021-10-10 05:20:31', NULL),
(7, 3, 7, 'piece', '100.00', 5, '500.00', NULL, '2021-10-14 04:58:00', '2021-10-14 04:58:00', NULL),
(8, 3, 8, 'piece', '250.00', 3, '750.00', NULL, '2021-10-14 04:58:00', '2021-10-14 04:58:00', NULL),
(9, 3, 9, 'piece', '4500.00', 6, '27000.00', NULL, '2021-10-14 04:58:00', '2021-10-14 04:58:00', NULL),
(10, 4, 4, 'piece', '50.00', 5, '250.00', NULL, '2021-10-16 14:14:10', '2021-10-16 14:14:10', NULL),
(11, 4, 6, 'piece', '5.00', 9, '45.00', NULL, '2021-10-16 14:14:10', '2021-10-16 14:14:10', NULL),
(12, 5, 1, 'kg', '90.00', 2, '180.00', NULL, '2021-10-17 00:06:27', '2021-10-17 00:06:27', NULL),
(13, 5, 2, 'kg', '100.00', 1, '100.00', NULL, '2021-10-17 00:06:27', '2021-10-17 00:06:27', NULL),
(14, 5, 3, 'kg', '65.00', 5, '325.00', NULL, '2021-10-17 00:06:27', '2021-10-17 00:06:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_statuses`
--

CREATE TABLE `order_statuses` (
  `id` bigint UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flow_enabled` tinyint DEFAULT NULL,
  `lcf` tinyint DEFAULT NULL,
  `sequence` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_statuses`
--

INSERT INTO `order_statuses` (`id`, `status`, `color`, `flow_enabled`, `lcf`, `sequence`) VALUES
(1, 'Pending', '#bdbdbd', 1, 0, NULL),
(2, 'Accepted', '#dd88dc', 1, 0, NULL),
(3, 'In progress', '#e5d62d', 1, 0, NULL),
(4, 'Successful', '#54ba1c', 1, 1, NULL),
(5, 'Canceled', '#e65858', 0, 1, NULL),
(6, 'Assigned', '#4186e0 	', 1, 0, NULL),
(7, 'Rescheduled', '#47da9d\r\n', 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `otps`
--

CREATE TABLE `otps` (
  `id` bigint UNSIGNED NOT NULL,
  `identity` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purpose` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `otps`
--

INSERT INTO `otps` (`id`, `identity`, `otp`, `purpose`, `client`, `ip_address`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'harun@gmail.com', '123456', 'Password Reset', NULL, '127.0.0.1', 1, '2021-08-21 08:35:37', '2021-08-21 08:35:56', NULL),
(2, 'sumit@gmail.com', '123456', 'Password Reset', NULL, '127.0.0.1', 1, '2021-08-23 00:17:31', '2021-08-23 00:17:52', NULL),
(3, 'rad@gmail.com', '123456', 'Password Reset', NULL, '127.0.0.1', 1, '2021-08-26 14:22:57', '2021-08-26 14:23:15', NULL),
(4, 'jannat@gmail.com', '123456', 'Password Reset', NULL, '127.0.0.1', 1, '2021-09-12 06:31:21', '2021-09-12 06:31:46', NULL),
(5, 'arif@gmail.com', '123456', 'Password Reset', NULL, '127.0.0.1', 1, '2021-09-20 03:40:47', '2021-09-20 03:41:06', NULL),
(6, 'jalal@gmail.com', '123456', 'Password Reset', NULL, '127.0.0.1', 1, '2021-09-27 00:45:28', '2021-09-27 00:45:40', NULL),
(7, 'altaf@gmail.com', '123456', 'Password Reset', NULL, '127.0.0.1', 1, '2021-09-28 00:09:58', '2021-09-28 00:10:10', NULL),
(8, 'juba@gmail.com', '123456', 'Password Reset', NULL, '127.0.0.1', 0, '2021-10-04 00:41:32', '2021-10-04 00:41:32', NULL),
(9, 'juba@gmail.com', '123456', 'Password Reset', NULL, '127.0.0.1', 1, '2021-10-04 00:41:35', '2021-10-04 00:41:50', NULL),
(10, 'harun@gmail.com', '123456', 'Password Reset', NULL, '127.0.0.1', 1, '2021-10-04 06:29:42', '2021-10-04 06:29:55', NULL),
(11, 'altaf@gmail.com', '123456', 'Password Reset', NULL, '127.0.0.1', 1, '2021-10-05 01:53:20', '2021-10-05 01:53:37', NULL),
(12, 'sumit@gmail.com', '123456', 'Password Reset', NULL, '127.0.0.1', 1, '2021-10-05 05:05:57', '2021-10-05 05:06:19', NULL),
(13, 'lucy@gmail.com', '123456', 'Password Reset', NULL, '127.0.0.1', 1, '2021-10-05 05:12:49', '2021-10-05 05:13:02', NULL),
(14, 'alex@gmail.com', '123456', 'Password Reset', NULL, '127.0.0.1', 1, '2021-10-05 06:45:31', '2021-10-05 06:45:46', NULL),
(15, 'ben@gmail.com', '123456', 'Password Reset', NULL, '127.0.0.1', 1, '2021-10-05 06:57:50', '2021-10-05 06:58:12', NULL),
(16, 'hafiz@gmail.com', '123456', 'Password Reset', NULL, '127.0.0.1', 1, '2021-10-05 17:51:34', '2021-10-05 17:51:49', NULL),
(17, 'faraque@gmail.com', '123456', 'Password Reset', NULL, '127.0.0.1', 1, '2021-10-05 17:51:59', '2021-10-05 17:52:11', NULL),
(18, 'josef@gmail.com', '123456', 'Password Reset', NULL, '127.0.0.1', 1, '2021-10-05 17:52:30', '2021-10-05 17:52:43', NULL),
(19, 'rabbe@gmail.com', '123456', 'Password Reset', NULL, '127.0.0.1', 1, '2021-10-05 17:52:50', '2021-10-05 17:53:06', NULL),
(20, 'rokon@gmail.com', '123456', 'Password Reset', NULL, '127.0.0.1', 1, '2021-10-05 17:53:13', '2021-10-05 17:53:25', NULL),
(21, 'admin@gmail.com', '123456', 'Password Reset', NULL, '127.0.0.1', 0, '2021-10-11 05:22:38', '2021-10-11 05:22:38', NULL),
(22, 'admin@gmail.com', '123456', 'Password Reset', NULL, '127.0.0.1', 0, '2021-10-11 06:31:14', '2021-10-11 06:31:14', NULL),
(23, 'admin@gmail.com', '123456', 'Password Reset', NULL, '127.0.0.1', 0, '2021-10-11 06:32:04', '2021-10-11 06:32:04', NULL),
(24, 'admin@gmail.com', '123456', 'Password Reset', NULL, '127.0.0.1', 0, '2021-10-11 06:33:35', '2021-10-11 06:33:35', NULL),
(25, 'admin@gmail.com', '123456', 'Password Reset', NULL, '127.0.0.1', 0, '2021-10-11 06:34:16', '2021-10-11 06:34:16', NULL),
(26, 'admin@gmail.com', '123456', 'Password Reset', NULL, '127.0.0.1', 0, '2021-10-11 06:40:29', '2021-10-11 06:40:29', NULL),
(27, 'admin@gmail.com', '123456', 'Password Reset', NULL, '127.0.0.1', 0, '2021-10-11 06:42:25', '2021-10-11 06:42:25', NULL),
(28, 'admin@gmail.com', '123456', 'Password Reset', NULL, '127.0.0.1', 0, '2021-10-11 06:50:36', '2021-10-11 06:50:36', NULL),
(29, 'admin@gmail.com', '123456', 'Password Reset', NULL, '127.0.0.1', 0, '2021-10-11 06:51:21', '2021-10-11 06:51:21', NULL),
(30, 'admin@gmail.com', '123456', 'Password Reset', NULL, '127.0.0.1', 0, '2021-10-11 06:59:17', '2021-10-11 06:59:17', NULL),
(31, 'admin@gmail.com', '123456', 'Password Reset', NULL, '127.0.0.1', 0, '2021-10-11 07:08:53', '2021-10-11 07:08:53', NULL),
(32, 'sumit@gmail.com', '123456', 'Password Reset', NULL, '127.0.0.1', 0, '2021-10-11 07:09:00', '2021-10-11 07:09:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_histories`
--

CREATE TABLE `password_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_histories`
--

INSERT INTO `password_histories` (`id`, `user_id`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, '$2y$10$euQl7zW.XfPdA9stbXCqHes8jGU/1.NUUC8m5AhfYm2ftnQ4gbt16', '2021-10-04 06:29:55', '2021-10-04 06:29:55', NULL),
(2, 5, '$2y$10$G6QdBCoZcNskYlzLhT8BdO8F.VXi0tt//xycfE6CZwngMKXZKzuvq', '2021-10-05 01:53:37', '2021-10-05 01:53:37', NULL),
(3, 6, '$2y$10$7/QZbajodG9xfNLIVNAjze4c.47W86EaRf10PJsPtIG1h1uu4A/Qa', '2021-10-05 05:06:19', '2021-10-05 05:06:19', NULL),
(4, 7, '$2y$10$ggZg31K6vxAFBQ6a8UKSCeL.3WvZ2cOBZ.v7hOTejwC1XAgyDnALG', '2021-10-05 05:13:02', '2021-10-05 05:13:02', NULL),
(5, 8, '$2y$10$Xi1usdzF67mq7YE39vTxz.dAaFyWnc8P8nICttPsy8J/Vh5iRpW4y', '2021-10-05 06:45:46', '2021-10-05 06:45:46', NULL),
(6, 9, '$2y$10$qAqz5W7XChXZcRMsz2K.tOUj3PtbkKLgHd2F..59lDZ5u8VI.fmN6', '2021-10-05 06:58:12', '2021-10-05 06:58:12', NULL),
(7, 10, '$2y$10$qomyz6UtMvdcSSi/I3NxxuCBL/MxU1j6nPV7SbOdFg5DWNjiXfoJa', '2021-10-05 17:51:49', '2021-10-05 17:51:49', NULL),
(8, 11, '$2y$10$8WVDcVhtBELEhaapuABMQOadYLSbMTZfKI1DHevDZMdd.37D38vYW', '2021-10-05 17:52:11', '2021-10-05 17:52:11', NULL),
(9, 12, '$2y$10$/3C4PqHL9IFtrWfotA.g6eVuqlGRCibmgwfQTHr0oeVtyJtw8ykYi', '2021-10-05 17:52:43', '2021-10-05 17:52:43', NULL),
(10, 13, '$2y$10$H3pCMLm27I6qb1o5k4g.HO/U9LXwTr77H6R0fVSLme7XqEK4JT7qK', '2021-10-05 17:53:06', '2021-10-05 17:53:06', NULL),
(11, 14, '$2y$10$bEEI7dG8S9PCDfSooOm9DuWg68ezAzQ7YYZ9JL.foW5Dvb2XsJyDa', '2021-10-05 17:53:25', '2021-10-05 17:53:25', NULL);

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
  `id` bigint UNSIGNED NOT NULL,
  `created_by_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_price` decimal(8,2) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `height` decimal(8,2) NOT NULL,
  `width` decimal(8,2) NOT NULL,
  `weight` decimal(8,2) NOT NULL,
  `size` decimal(8,2) NOT NULL,
  `measurement_unit` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `created_by_id`, `category_id`, `name`, `description`, `unit_price`, `image`, `height`, `width`, `weight`, `size`, `measurement_unit`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'Ginger', 'Deshi ginger.', '90.00', 'uploads/1633474880_ginger.jpg', '0.00', '0.00', '1.00', '0.00', 'kg', 1, '2021-10-05 17:01:20', '2021-10-05 17:02:17', NULL),
(2, 1, 1, 'Garlic', 'Deshi garlic.', '100.00', 'uploads/1633475089_garlic.jpeg', '0.00', '0.00', '1.00', '0.00', 'kg', 1, '2021-10-05 17:04:49', '2021-10-05 17:04:49', NULL),
(3, 1, 1, 'Onion', 'Deshi onion.', '65.00', 'uploads/1633475181_onion.jpg', '0.00', '0.00', '1.00', '0.00', 'kg', 1, '2021-10-05 17:06:21', '2021-10-05 17:06:21', NULL),
(4, 1, 2, 'Notebook', 'Brand Goodluck.', '50.00', 'uploads/1633475581_notebook.jpeg', '0.00', '0.00', '0.00', '0.00', 'piece', 1, '2021-10-05 17:13:01', '2021-10-05 17:13:01', NULL),
(5, 1, 2, 'Paper file', 'Brand Goodluck', '15.00', 'uploads/1633475655_file.jpg', '0.00', '0.00', '0.00', '0.00', 'piece', 1, '2021-10-05 17:14:15', '2021-10-05 17:14:15', NULL),
(6, 1, 2, 'Pen', 'Metador i-Teen', '5.00', 'uploads/1633475767_pen.jpg', '0.00', '0.00', '0.00', '0.00', 'piece', 1, '2021-10-05 17:16:07', '2021-10-05 17:16:07', NULL),
(7, 1, 3, 'Tap', 'Brand RFL', '100.00', 'uploads/1633476004_tap.jpg', '0.00', '0.00', '0.00', '0.00', 'piece', 1, '2021-10-05 17:20:04', '2021-10-10 14:32:52', NULL),
(8, 1, 3, 'Shower', 'Brand RFL', '250.00', 'uploads/1633476114_shower.jpeg', '0.00', '0.00', '0.00', '0.00', 'piece', 1, '2021-10-05 17:21:54', '2021-10-10 14:32:52', NULL),
(9, 1, 3, 'Sanitary Ware', 'Brand RAK', '4500.00', 'uploads/1633476276_sanitaryware.jpg', '0.00', '0.00', '0.00', '0.00', 'piece', 1, '2021-10-05 17:24:36', '2021-10-10 14:32:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `statements`
--

CREATE TABLE `statements` (
  `id` bigint UNSIGNED NOT NULL,
  `transaction_id` bigint UNSIGNED DEFAULT NULL,
  `transaction_type_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `debit` decimal(16,4) DEFAULT NULL,
  `credit` decimal(16,4) DEFAULT NULL,
  `current_balance` decimal(16,4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint UNSIGNED NOT NULL,
  `task_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `assigned_id` bigint UNSIGNED DEFAULT NULL,
  `order_assignment_id` bigint UNSIGNED DEFAULT NULL,
  `area_id` bigint UNSIGNED DEFAULT NULL,
  `current_status_id` bigint UNSIGNED DEFAULT NULL,
  `deadline` timestamp NULL DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `qrcode` text COLLATE utf8mb4_unicode_ci,
  `instruction` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assigned_amount` decimal(11,2) DEFAULT NULL,
  `collected_amount` decimal(11,2) DEFAULT NULL,
  `contact_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ref_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sequence` int DEFAULT NULL,
  `sequence_version` int DEFAULT NULL,
  `service_charge` decimal(11,2) DEFAULT NULL,
  `cancellation_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reschedule_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment` enum('PAID','DUE','IN PROGRESS') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `task_id`, `created_by_id`, `assigned_id`, `order_assignment_id`, `area_id`, `current_status_id`, `deadline`, `start_time`, `end_time`, `qrcode`, `instruction`, `assigned_amount`, `collected_amount`, `contact_name`, `contact_email`, `contact_mobile`, `contact_address`, `ref_id`, `sequence`, `sequence_version`, `service_charge`, `cancellation_reason`, `reschedule_reason`, `payment`, `note`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '44dbc0cf98', 1, 7, 2, 5, 4, '2021-10-14 18:00:00', NULL, NULL, NULL, 'Call before delivery.', '435.00', '450.00', 'Harun', 'harun@gmail.com', '01818111110', '216, Mirpur DOHS', NULL, NULL, NULL, '13.05', NULL, NULL, 'DUE', 'Please delivery products quickly.', '2021-10-10 06:03:05', '2021-10-10 06:27:55', NULL),
(2, '402f7e7919', 1, 9, 1, 1, 6, '2021-10-19 18:00:00', NULL, NULL, NULL, 'Call before delivery.', '515.00', NULL, 'Sumit', 'sumit@gmail.com', '01818111112', '111/B, East Rampura', NULL, NULL, NULL, '15.45', NULL, NULL, 'DUE', 'Get fresh products.', '2021-10-10 06:03:20', '2021-10-10 06:03:20', NULL),
(3, '78e641e3a9', 1, 7, 4, 4, 6, '2021-10-30 18:00:00', NULL, NULL, NULL, 'Please call before delivery.', '295.00', NULL, 'Altaf', 'altaf@gmail.com', '01818111111', '716, Mirpur DOHS', '1', NULL, NULL, '8.85', NULL, NULL, 'DUE', 'Get the fresh products.', '2021-10-16 14:17:24', '2021-10-18 16:06:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `task_status_activities`
--

CREATE TABLE `task_status_activities` (
  `id` bigint UNSIGNED NOT NULL,
  `task_id` bigint UNSIGNED DEFAULT NULL,
  `created_by_id` bigint UNSIGNED DEFAULT NULL,
  `status_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task_status_activities`
--

INSERT INTO `task_status_activities` (`id`, `task_id`, `created_by_id`, `status_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 6, '2021-10-10 06:03:05', '2021-10-10 06:03:05', NULL),
(2, 2, 1, 6, '2021-10-10 06:03:20', '2021-10-10 06:03:20', NULL),
(3, 1, 7, 4, '2021-10-10 06:27:55', '2021-10-10 06:27:55', NULL),
(4, 3, 1, 6, '2021-10-16 14:17:24', '2021-10-16 14:17:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `tx_unique_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender_id` bigint UNSIGNED DEFAULT NULL,
  `receiver_id` bigint UNSIGNED DEFAULT NULL,
  `transaction_type_id` bigint UNSIGNED DEFAULT NULL,
  `transaction_status_id` bigint UNSIGNED DEFAULT NULL,
  `amount` decimal(16,4) NOT NULL,
  `sender_fee` decimal(16,4) DEFAULT NULL,
  `sender_tax` decimal(16,4) DEFAULT NULL,
  `sender_commission` decimal(16,2) DEFAULT NULL,
  `sender_service_charge` decimal(16,2) DEFAULT NULL,
  `total_amount` decimal(16,4) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_statuses`
--

CREATE TABLE `transaction_statuses` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_statuses`
--

INSERT INTO `transaction_statuses` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Success', '2021-09-29 11:55:34', '2021-09-29 11:55:34', NULL),
(2, 'Failed', '2021-09-29 11:55:34', '2021-09-29 11:55:34', NULL),
(3, 'Pending', '2021-09-29 11:56:44', '2021-09-29 11:56:44', NULL),
(4, 'Processing', '2021-09-29 11:56:44', '2021-09-29 11:56:44', NULL),
(5, 'Other', '2021-09-29 11:57:36', '2021-09-29 11:57:36', NULL),
(6, 'Suspicious', '2021-09-29 11:57:36', '2021-09-29 11:57:36', NULL),
(7, 'On Hold', '2021-09-29 11:57:36', '2021-09-29 11:57:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_types`
--

CREATE TABLE `transaction_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_printable` tinyint(1) NOT NULL DEFAULT '0',
  `nature` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `universal_task_order_statuses`
--

CREATE TABLE `universal_task_order_statuses` (
  `id` bigint UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flow_enable` tinyint NOT NULL DEFAULT '1',
  `lcf` tinyint NOT NULL DEFAULT '1',
  `sequence` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `universal_task_order_types`
--

CREATE TABLE `universal_task_order_types` (
  `id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge` decimal(11,2) DEFAULT NULL,
  `slab` enum('F','P') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `universal_task_order_types`
--

INSERT INTO `universal_task_order_types` (`id`, `type`, `color`, `charge`, `slab`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Pickup', '#ff59da', '2.00', 'F', '2021-08-25 11:47:42', '2021-08-25 11:47:42', NULL),
(2, 'Delivery', '#5974ff', '2.00', 'P', '2021-08-25 11:49:44', '2021-08-25 11:49:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `user_type_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `additional_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type_id`, `name`, `email`, `additional_email`, `mobile`, `additional_mobile`, `address`, `avatar`, `email_verified_at`, `password`, `remember_token`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Admin', 'admin@gmail.com', NULL, '01717111110', NULL, '816, Mirpur DOHS', 'profiles/1633343371_admin.jpg', NULL, '$2y$10$X6EDBeqQD7Fu/zj0EStDEOpxCLhLBVDAO6KrPL.vPtG729YSRAK0e', NULL, 1, '2021-10-04 03:53:02', '2021-10-04 04:29:31', NULL),
(2, 1, 'Abu Bokor Sadik', 'sadik@gmail.com', NULL, '01717111111', NULL, NULL, NULL, NULL, '$2y$10$0sz/FHZEtOYpTfpAFCoarubUAiQwhIyrKQ1zstSJz9U./PuEbc1oq', NULL, 1, '2021-10-04 03:54:03', '2021-10-04 03:54:03', NULL),
(3, 1, 'Monir Ahmed', 'monir@gmail.com', NULL, '01717111112', NULL, NULL, NULL, NULL, '$2y$10$AZEmMIkI3bPC7/74.rCYZuLnz.pIDTAs0AIjOIck1XNEUi7UU5c76', NULL, 1, '2021-10-04 03:54:39', '2021-10-04 03:54:39', NULL),
(4, 2, 'Harun', 'harun@gmail.com', NULL, '01818111110', NULL, '216, Mirpur DOHS', 'profiles/1633351222_harun.jpg', NULL, '$2y$10$euQl7zW.XfPdA9stbXCqHes8jGU/1.NUUC8m5AhfYm2ftnQ4gbt16', NULL, 1, '2021-08-02 05:50:51', '2021-10-04 06:40:22', NULL),
(5, 2, 'Altaf', 'altaf@gmail.com', NULL, '01818111111', NULL, '716, Mirpur DOHS', 'profiles/1633429698_altaf.jpg', NULL, '$2y$10$G6QdBCoZcNskYlzLhT8BdO8F.VXi0tt//xycfE6CZwngMKXZKzuvq', NULL, 1, '2021-10-05 01:47:52', '2021-10-05 04:28:18', NULL),
(6, 2, 'Sumit', 'sumit@gmail.com', NULL, '01818111112', NULL, '111/B, East Rampura', 'profiles/1633432083_sumit.png', NULL, '$2y$10$7/QZbajodG9xfNLIVNAjze4c.47W86EaRf10PJsPtIG1h1uu4A/Qa', NULL, 1, '2021-10-05 05:01:37', '2021-10-05 05:08:03', NULL),
(7, 3, 'Lucy', 'lucy@gmail.com', NULL, '01919111110', NULL, '222, East Basabo', 'profiles/1633432664_lucy.jpg', NULL, '$2y$10$ggZg31K6vxAFBQ6a8UKSCeL.3WvZ2cOBZ.v7hOTejwC1XAgyDnALG', NULL, 1, '2021-10-05 05:11:29', '2021-10-05 05:38:56', NULL),
(8, 3, 'Alex', 'alex@gmail.com', NULL, '01919111111', NULL, '43 West Goran', 'profiles/1633438239_alex.jpg', NULL, '$2y$10$Xi1usdzF67mq7YE39vTxz.dAaFyWnc8P8nICttPsy8J/Vh5iRpW4y', NULL, 1, '2021-10-05 06:30:51', '2021-10-05 06:50:39', NULL),
(9, 3, 'Ben', 'ben@gmail.com', NULL, '01919111112', NULL, '12/C, Old Poltan', 'profiles/1633439100_ben.jpeg', NULL, '$2y$10$qAqz5W7XChXZcRMsz2K.tOUj3PtbkKLgHd2F..59lDZ5u8VI.fmN6', NULL, 1, '2021-10-05 06:32:04', '2021-10-05 07:05:57', NULL),
(10, 2, 'Hafiz', 'hafiz@gmail.com', NULL, '01818111113', NULL, 'House-111, Block-C, Road-3, Banasree', 'profiles/1633478457_hafiz.jpg', NULL, '$2y$10$qomyz6UtMvdcSSi/I3NxxuCBL/MxU1j6nPV7SbOdFg5DWNjiXfoJa', NULL, 1, '2021-10-05 17:41:35', '2021-10-05 18:00:57', NULL),
(11, 2, 'Omar Faraque', 'faraque@gmail.com', NULL, '01818111114', NULL, 'Banker\'s building,  Block-B, Main road,  Banasree.', 'profiles/1633478333_faraque.jpg', NULL, '$2y$10$8WVDcVhtBELEhaapuABMQOadYLSbMTZfKI1DHevDZMdd.37D38vYW', NULL, 1, '2021-10-05 17:44:32', '2021-10-05 17:58:53', NULL),
(12, 3, 'Josef', 'josef@gmail.com', NULL, '01919111113', NULL, NULL, NULL, NULL, '$2y$10$/3C4PqHL9IFtrWfotA.g6eVuqlGRCibmgwfQTHr0oeVtyJtw8ykYi', NULL, 1, '2021-10-05 17:46:18', '2021-10-05 17:52:43', NULL),
(13, 3, 'Rabbe', 'rabbe@gmail.com', NULL, '01919111114', NULL, NULL, NULL, NULL, '$2y$10$H3pCMLm27I6qb1o5k4g.HO/U9LXwTr77H6R0fVSLme7XqEK4JT7qK', NULL, 1, '2021-10-05 17:47:11', '2021-10-05 17:53:06', NULL),
(14, 3, 'Rokon', 'rokon@gmail.com', NULL, '01919111115', NULL, NULL, NULL, NULL, '$2y$10$bEEI7dG8S9PCDfSooOm9DuWg68ezAzQ7YYZ9JL.foW5Dvb2XsJyDa', NULL, 1, '2021-10-05 17:48:20', '2021-10-05 17:53:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_agents`
--

CREATE TABLE `users_agents` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `agent_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_agents`
--

INSERT INTO `users_agents` (`id`, `user_id`, `agent_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 7, '2021-10-05 05:11:29', '2021-10-05 05:11:29', NULL),
(2, 1, 8, '2021-10-05 06:30:51', '2021-10-05 06:30:51', NULL),
(3, 1, 9, '2021-10-05 06:32:04', '2021-10-05 06:32:04', NULL),
(4, 2, 12, '2021-10-05 17:46:18', '2021-10-05 17:46:18', NULL),
(5, 2, 13, '2021-10-05 17:47:11', '2021-10-05 17:47:11', NULL),
(6, 2, 14, '2021-10-05 17:48:20', '2021-10-05 17:48:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_merchants`
--

CREATE TABLE `users_merchants` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `merchant_id` bigint UNSIGNED NOT NULL,
  `status` tinyint DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_merchants`
--

INSERT INTO `users_merchants` (`id`, `user_id`, `merchant_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 4, 1, '2021-10-04 05:50:51', '2021-10-04 05:50:51', NULL),
(2, 1, 5, 1, '2021-10-05 01:47:54', '2021-10-05 01:47:54', NULL),
(3, 1, 6, 1, '2021-10-05 05:01:37', '2021-10-05 05:01:37', NULL),
(4, 2, 5, 1, '2021-10-05 17:36:56', '2021-10-05 17:36:56', NULL),
(5, 2, 10, 1, '2021-10-05 17:41:37', '2021-10-05 17:41:37', NULL),
(6, 2, 11, 1, '2021-10-05 17:44:32', '2021-10-05 17:44:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `user_account_type_id` bigint UNSIGNED DEFAULT NULL,
  `account_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` decimal(11,2) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`id`, `user_id`, `user_account_type_id`, `account_no`, `balance`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'PAA000001', '0.00', 1, '2021-08-01 10:05:57', '2021-08-01 10:05:57', NULL),
(2, 2, 1, 'PAA000002', '0.00', 1, '2021-08-03 10:05:57', '2021-08-03 10:05:57', NULL),
(3, 3, 1, 'PAA000003', '0.00', 1, '2021-08-05 10:05:57', '2021-08-05 10:05:57', NULL),
(4, 4, 1, 'PAA000004', '4000.00', 1, '2021-08-10 12:35:34', '2021-08-10 12:35:34', NULL),
(5, 5, 1, 'PAA000005', '4000.00', 1, '2021-10-05 07:51:47', '2021-10-05 07:51:47', NULL),
(6, 6, 1, 'PAA000006', '4000.00', 1, '2021-10-05 11:04:29', '2021-10-05 11:04:29', NULL),
(7, 10, 1, 'PAA000007', '4000.00', 1, '2021-10-05 23:56:08', '2021-10-05 23:56:08', NULL),
(8, 11, 1, 'PAA000008', '4000.00', 1, '2021-10-05 23:56:08', '2021-10-05 23:56:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_account_types`
--

CREATE TABLE `user_account_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_account_types`
--

INSERT INTO `user_account_types` (`id`, `name`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Savings Account', 1, '2021-09-29 07:03:15', '2021-09-29 07:03:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', '2021-08-16 06:30:44', '2021-08-16 06:30:44', NULL),
(2, 'Merchant', '2021-08-16 06:30:57', '2021-08-16 06:30:57', NULL),
(3, 'Agent', '2021-08-16 06:31:25', '2021-08-16 06:31:25', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `areas_created_by_id_foreign` (`created_by_id`),
  ADD KEY `areas_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_created_by_id_foreign` (`created_by_id`);

--
-- Indexes for table `company_task_order_types`
--
ALTER TABLE `company_task_order_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_task_order_types_company_id_foreign` (`company_id`),
  ADD KEY `company_task_order_types_type_id_foreign` (`type_id`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_created_by_id_foreign` (`created_by_id`),
  ADD KEY `orders_order_type_id_foreign` (`order_type_id`);

--
-- Indexes for table `order_assignments`
--
ALTER TABLE `order_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_assignments_order_id_foreign` (`order_id`),
  ADD KEY `order_assignments_assigned_by_id_foreign` (`assigned_by_id`),
  ADD KEY `order_assignments_assigned_to_id_foreign` (`assigned_to_id`),
  ADD KEY `order_assignments_current_order_status_id_foreign` (`current_order_status_id`),
  ADD KEY `order_assignments_area_id_foreign` (`area_id`);

--
-- Indexes for table `order_assignment_activities`
--
ALTER TABLE `order_assignment_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_assignment_activities_order_assignment_id_foreign` (`order_assignment_id`),
  ADD KEY `order_assignment_activities_created_by_id_foreign` (`created_by_id`),
  ADD KEY `order_assignment_activities_status_id_foreign` (`status_id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_products_order_id_foreign` (`order_id`),
  ADD KEY `order_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otps`
--
ALTER TABLE `otps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_histories`
--
ALTER TABLE `password_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_histories_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_created_by_id_foreign` (`created_by_id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `statements`
--
ALTER TABLE `statements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `statements_description_unique` (`description`),
  ADD KEY `statements_transaction_id_foreign` (`transaction_id`),
  ADD KEY `statements_user_id_foreign` (`user_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_created_by_id_foreign` (`created_by_id`),
  ADD KEY `tasks_assigned_id_foreign` (`assigned_id`),
  ADD KEY `tasks_order_assignment_id_foreign` (`order_assignment_id`),
  ADD KEY `tasks_area_id_foreign` (`area_id`),
  ADD KEY `tasks_current_status_id_foreign` (`current_status_id`);

--
-- Indexes for table `task_status_activities`
--
ALTER TABLE `task_status_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_status_activities_task_id_foreign` (`task_id`),
  ADD KEY `task_status_activities_created_by_id_foreign` (`created_by_id`),
  ADD KEY `task_status_activities_status_id_foreign` (`status_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactions_tx_unique_id_unique` (`tx_unique_id`),
  ADD UNIQUE KEY `transactions_order_id_unique` (`order_id`),
  ADD KEY `transactions_sender_id_foreign` (`sender_id`),
  ADD KEY `transactions_receiver_id_foreign` (`receiver_id`),
  ADD KEY `transactions_transaction_type_id_foreign` (`transaction_type_id`),
  ADD KEY `transactions_transaction_status_id_foreign` (`transaction_status_id`);

--
-- Indexes for table `transaction_statuses`
--
ALTER TABLE `transaction_statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transaction_statuses_name_unique` (`name`);

--
-- Indexes for table `transaction_types`
--
ALTER TABLE `transaction_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transaction_types_name_unique` (`name`),
  ADD UNIQUE KEY `transaction_types_nature_unique` (`nature`);

--
-- Indexes for table `universal_task_order_statuses`
--
ALTER TABLE `universal_task_order_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `universal_task_order_types`
--
ALTER TABLE `universal_task_order_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`),
  ADD KEY `users_user_type_id_foreign` (`user_type_id`);

--
-- Indexes for table `users_agents`
--
ALTER TABLE `users_agents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_agents_user_id_foreign` (`user_id`),
  ADD KEY `users_agents_agent_id_foreign` (`agent_id`);

--
-- Indexes for table `users_merchants`
--
ALTER TABLE `users_merchants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_merchants_user_id_foreign` (`user_id`),
  ADD KEY `users_merchants_merchant_id_foreign` (`merchant_id`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_accounts_account_no_unique` (`account_no`),
  ADD KEY `user_accounts_user_id_foreign` (`user_id`),
  ADD KEY `user_accounts_user_account_type_id_foreign` (`user_account_type_id`);

--
-- Indexes for table `user_account_types`
--
ALTER TABLE `user_account_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `company_task_order_types`
--
ALTER TABLE `company_task_order_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_assignments`
--
ALTER TABLE `order_assignments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_assignment_activities`
--
ALTER TABLE `order_assignment_activities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `otps`
--
ALTER TABLE `otps`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `password_histories`
--
ALTER TABLE `password_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `statements`
--
ALTER TABLE `statements`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `task_status_activities`
--
ALTER TABLE `task_status_activities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction_statuses`
--
ALTER TABLE `transaction_statuses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transaction_types`
--
ALTER TABLE `transaction_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `universal_task_order_statuses`
--
ALTER TABLE `universal_task_order_statuses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `universal_task_order_types`
--
ALTER TABLE `universal_task_order_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users_agents`
--
ALTER TABLE `users_agents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users_merchants`
--
ALTER TABLE `users_merchants`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_account_types`
--
ALTER TABLE `user_account_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `areas`
--
ALTER TABLE `areas`
  ADD CONSTRAINT `areas_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `areas_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `areas` (`id`);

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `company_task_order_types`
--
ALTER TABLE `company_task_order_types`
  ADD CONSTRAINT `company_task_order_types_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `company_task_order_types_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `universal_task_order_types` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_order_type_id_foreign` FOREIGN KEY (`order_type_id`) REFERENCES `universal_task_order_types` (`id`);

--
-- Constraints for table `order_assignments`
--
ALTER TABLE `order_assignments`
  ADD CONSTRAINT `order_assignments_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`),
  ADD CONSTRAINT `order_assignments_assigned_by_id_foreign` FOREIGN KEY (`assigned_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `order_assignments_assigned_to_id_foreign` FOREIGN KEY (`assigned_to_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `order_assignments_current_order_status_id_foreign` FOREIGN KEY (`current_order_status_id`) REFERENCES `order_statuses` (`id`),
  ADD CONSTRAINT `order_assignments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `order_assignment_activities`
--
ALTER TABLE `order_assignment_activities`
  ADD CONSTRAINT `order_assignment_activities_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `order_assignment_activities_order_assignment_id_foreign` FOREIGN KEY (`order_assignment_id`) REFERENCES `order_assignments` (`id`),
  ADD CONSTRAINT `order_assignment_activities_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `order_statuses` (`id`);

--
-- Constraints for table `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_products_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `password_histories`
--
ALTER TABLE `password_histories`
  ADD CONSTRAINT `password_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `statements`
--
ALTER TABLE `statements`
  ADD CONSTRAINT `statements_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`),
  ADD CONSTRAINT `statements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`),
  ADD CONSTRAINT `tasks_assigned_id_foreign` FOREIGN KEY (`assigned_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tasks_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tasks_current_status_id_foreign` FOREIGN KEY (`current_status_id`) REFERENCES `order_statuses` (`id`),
  ADD CONSTRAINT `tasks_order_assignment_id_foreign` FOREIGN KEY (`order_assignment_id`) REFERENCES `order_assignments` (`id`);

--
-- Constraints for table `task_status_activities`
--
ALTER TABLE `task_status_activities`
  ADD CONSTRAINT `task_status_activities_created_by_id_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `task_status_activities_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `order_statuses` (`id`),
  ADD CONSTRAINT `task_status_activities_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `user_accounts` (`id`),
  ADD CONSTRAINT `transactions_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `user_accounts` (`id`),
  ADD CONSTRAINT `transactions_transaction_status_id_foreign` FOREIGN KEY (`transaction_status_id`) REFERENCES `transaction_statuses` (`id`),
  ADD CONSTRAINT `transactions_transaction_type_id_foreign` FOREIGN KEY (`transaction_type_id`) REFERENCES `transaction_types` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_user_type_id_foreign` FOREIGN KEY (`user_type_id`) REFERENCES `user_types` (`id`);

--
-- Constraints for table `users_agents`
--
ALTER TABLE `users_agents`
  ADD CONSTRAINT `users_agents_agent_id_foreign` FOREIGN KEY (`agent_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `users_agents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users_merchants`
--
ALTER TABLE `users_merchants`
  ADD CONSTRAINT `users_merchants_merchant_id_foreign` FOREIGN KEY (`merchant_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `users_merchants_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD CONSTRAINT `user_accounts_user_account_type_id_foreign` FOREIGN KEY (`user_account_type_id`) REFERENCES `user_account_types` (`id`),
  ADD CONSTRAINT `user_accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
