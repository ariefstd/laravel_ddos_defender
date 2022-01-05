CREATE TABLE `stalls_photos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `stall_id` bigint unsigned NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stalls_photos_stall_id_foreign` (`stall_id`),
  CONSTRAINT `stalls_photos_stall_id_foreign` FOREIGN KEY (`stall_id`) REFERENCES `stalls` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
