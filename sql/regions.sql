CREATE TABLE `regions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `city_id` bigint unsigned NOT NULL,
  `region_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `regions_region_slug_unique` (`region_slug`),
  KEY `regions_city_id_foreign` (`city_id`),
  CONSTRAINT `regions_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
