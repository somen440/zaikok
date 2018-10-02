CREATE TABLE `inventories` (
  `inventory_id` int(10) unsigned NOT NULL,
  `inventory_group_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `count` tinyint(3) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`inventory_group_id`, `inventory_id`),
  INDEX user_id_inventory_group_id (`user_id`, `inventory_group_id`),
  FOREIGN KEY (`user_id`) REFERENCES users(`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
