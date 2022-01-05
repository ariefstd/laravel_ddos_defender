CREATE TABLE `food_stall` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `food_id` bigint unsigned NOT NULL,
  `stall_id` bigint unsigned NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `food_stall_food_id_foreign` (`food_id`),
  KEY `food_stall_stall_id_foreign` (`stall_id`),
  CONSTRAINT `food_stall_food_id_foreign` FOREIGN KEY (`food_id`) REFERENCES `food_categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `food_stall_stall_id_foreign` FOREIGN KEY (`stall_id`) REFERENCES `stalls` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
