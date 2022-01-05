CREATE TABLE `catalogs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `catalog_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catalog_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catalog_seq` int NOT NULL,
  `catalog_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `catalogs_catalog_slug_unique` (`catalog_slug`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
