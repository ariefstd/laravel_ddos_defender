CREATE TABLE `promos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `promo_title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `promo_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `promo_thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `promo_excerpt` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `promo_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `promo_meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `promo_meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `promo_meta_keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `promos_promo_slug_unique` (`promo_slug`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
