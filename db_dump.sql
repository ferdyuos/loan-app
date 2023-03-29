
create database if not exists loan;

use loan;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `type` varchar(128) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` varchar(128) DEFAULT NULL,
  `image_path` text DEFAULT NULL,
  `date_created` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
   `nin` varchar(255) DEFAULT NULL,
  `bvn` int(11) DEFAULT NULL,
  `image_path` text DEFAULT NULL,
  `date_created` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `ratings` varchar(255) DEFAULT NULL,
  `job` varchar(255) DEFAULT NULL,
  `job_index` int(11) DEFAULT NULL,
  `experience` int(4) DEFAULT NULL,
  `total_bank_balance` int(20) DEFAULT NULL,
  `guarantor_total_bank_balance` int(20) DEFAULT NULL,
  `salary` int(11) DEFAULT NULL,
  `matric_no` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `hostel` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




CREATE TABLE `entities` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
   `email` varchar(255) DEFAULT NULL,
    `username` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `cac_number` varchar(255) DEFAULT NULL,
  `sub_id` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `verified` varchar(255) DEFAULT NULL,
  `image_path` text DEFAULT NULL,
  `date_created` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cac_number` (`cac_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `loan_record` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `granted_entity_id` int(20) DEFAULT NULL,
  `granted_entity_email` varchar(255) DEFAULT NULL,
  `granted_entity_username` varchar(255) DEFAULT NULL,
   `granted_entity_name` varchar(255) DEFAULT NULL,
  `recipient_id` int(20) DEFAULT NULL,
  `recipient_email` varchar(255) DEFAULT NULL,
  `recipient_username` varchar(255) DEFAULT NULL,
  `recipient_name` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `date_created` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `peer_record` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `sender_id` int(20) DEFAULT NULL,
  `sender_email` varchar(255) DEFAULT NULL,
  `sender_username` varchar(255) DEFAULT NULL,
  `sender_name` varchar(255) DEFAULT NULL,
  `recipient_id` int(20) DEFAULT NULL,
  `recipient_email` varchar(255) DEFAULT NULL,
 `recipient_username` varchar(255) DEFAULT NULL,
  `recipient_name` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date_created` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


