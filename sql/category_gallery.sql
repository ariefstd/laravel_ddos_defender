CREATE TABLE `category_gallery` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `gallery_id` bigint unsigned NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_gallery_category_id_foreign` (`category_id`),
  KEY `category_gallery_gallery_id_foreign` (`gallery_id`),
  CONSTRAINT `category_gallery_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories_galleries` (`id`) ON DELETE CASCADE,
  CONSTRAINT `category_gallery_gallery_id_foreign` FOREIGN KEY (`gallery_id`) REFERENCES `galleries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
