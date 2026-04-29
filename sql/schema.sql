-- ====================================================
-- CHMSTORE (CHIMSTOKET) - MySQL / MariaDB schema v2
-- ====================================================
SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(60) NOT NULL UNIQUE,
  `password_hash` VARCHAR(255) NOT NULL,
  `full_name` VARCHAR(120) NOT NULL DEFAULT '',
  `role` ENUM('admin','manager','staff') NOT NULL DEFAULT 'admin',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `student_no` VARCHAR(30) NOT NULL UNIQUE,
  `full_name` VARCHAR(120) NOT NULL,
  `email` VARCHAR(150) DEFAULT NULL,
  `course` VARCHAR(80) DEFAULT NULL,
  `year_level` VARCHAR(20) DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(150) NOT NULL,
  `description` TEXT,
  `category` VARCHAR(80) NOT NULL DEFAULT 'Uniforms',
  `price` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `image` VARCHAR(255) DEFAULT '../assets/images/uniformnobg.png',
  `status` ENUM('published','unpublished','archived') NOT NULL DEFAULT 'published',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY(`id`),
  KEY `idx_category`(`category`), KEY `idx_status`(`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `product_variants`;
CREATE TABLE `product_variants` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` INT UNSIGNED NOT NULL,
  `variant_name` VARCHAR(120) NOT NULL DEFAULT '',
  `size` VARCHAR(30) DEFAULT NULL,
  `color` VARCHAR(30) DEFAULT NULL,
  `sku` VARCHAR(60) NOT NULL UNIQUE,
  `stock` INT UNSIGNED NOT NULL DEFAULT 0,
  `price` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(`id`), KEY `idx_product`(`product_id`),
  CONSTRAINT `fk_variant_product` FOREIGN KEY(`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_code` VARCHAR(40) NOT NULL UNIQUE,
  `pickup_code` VARCHAR(40) NOT NULL DEFAULT '',
  `student_id` INT UNSIGNED DEFAULT NULL,
  `total` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `status` ENUM('Pending','Processing','Ready for Pickup','Completed','Cancelled') NOT NULL DEFAULT 'Pending',
  `payment_method` ENUM('Cash at BOA','Online Payment') NOT NULL DEFAULT 'Cash at BOA',
  `payment_status` ENUM('Unpaid','Paid','Refunded') NOT NULL DEFAULT 'Unpaid',
  `reference_number` VARCHAR(60) DEFAULT NULL,
  `accepted_by` VARCHAR(120) DEFAULT NULL,
  `accepted_date` VARCHAR(60) DEFAULT NULL,
  `processed_by` VARCHAR(120) DEFAULT NULL,
  `processed_date` VARCHAR(60) DEFAULT NULL,
  `completed_by` VARCHAR(120) DEFAULT NULL,
  `completed_date` VARCHAR(60) DEFAULT NULL,
  `cancel_reason` VARCHAR(255) DEFAULT NULL,
  `cancel_reason_date` VARCHAR(60) DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY(`id`), KEY `idx_status`(`status`), KEY `idx_student`(`student_id`),
  CONSTRAINT `fk_order_student` FOREIGN KEY(`student_id`) REFERENCES `students`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` INT UNSIGNED NOT NULL,
  `product_id` INT UNSIGNED NOT NULL,
  `variant_id` INT UNSIGNED DEFAULT NULL,
  `quantity` INT UNSIGNED NOT NULL DEFAULT 1,
  `price` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY(`id`), KEY `idx_order`(`order_id`),
  CONSTRAINT `fk_item_order`   FOREIGN KEY(`order_id`)   REFERENCES `orders`(`id`)           ON DELETE CASCADE,
  CONSTRAINT `fk_item_product` FOREIGN KEY(`product_id`) REFERENCES `products`(`id`)         ON DELETE RESTRICT,
  CONSTRAINT `fk_item_variant` FOREIGN KEY(`variant_id`) REFERENCES `product_variants`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `sender_type` ENUM('student','admin','system') NOT NULL DEFAULT 'student',
  `sender_name` VARCHAR(120) NOT NULL,
  `sender_email` VARCHAR(150) DEFAULT NULL,
  `receiver_name` VARCHAR(120) DEFAULT NULL,
  `receiver_email` VARCHAR(150) DEFAULT NULL,
  `subject` VARCHAR(200) NOT NULL DEFAULT '(No subject)',
  `body` TEXT,
  `is_read` TINYINT(1) NOT NULL DEFAULT 0,
  `is_starred` TINYINT(1) NOT NULL DEFAULT 0,
  `folder` ENUM('inbox','sent','archive','trash') NOT NULL DEFAULT 'inbox',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(`id`), KEY `idx_folder`(`folder`), KEY `idx_read`(`is_read`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS=1;
