CREATE TABLE `food_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `food_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `food_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `food_seq` int NOT NULL,
  `food_thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `food_categories_food_slug_unique` (`food_slug`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
