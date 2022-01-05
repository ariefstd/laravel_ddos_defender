CREATE TABLE `teams` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `team_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_seq` int NOT NULL,
  `team_position` varchar(240) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `teams_team_slug_unique` (`team_slug`),
  KEY `teams_category_id_foreign` (`category_id`),
  CONSTRAINT `teams_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories_teams` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
