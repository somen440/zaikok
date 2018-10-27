CREATE TABLE `line_verifies` (
  `line_verify_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `line_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `temp_image_path` text COLLATE utf8mb4_unicode_ci,
  `current_inventory_group_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`line_verify_id`),
  UNIQUE KEY `line_verifies_line_id_unique` (`line_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
