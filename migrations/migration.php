<?php
require "../db.php";

$db->query("DROP TABLE IF EXISTS users");
$db->query("DROP TABLE IF EXISTS poststatus");
$db->query("DROP TABLE IF EXISTS posts");


$usersTable = "CREATE TABLE  IF NOT EXISTS`users` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255),
  `email` varchar(255) UNIQUE,
  `password` varchar(255)
)";

$poststTable = "CREATE TABLE IF NOT EXISTS `poststatus`(
  `id` int  primary key AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL UNIQUE
)";

$postsTable = "CREATE TABLE IF NOT EXISTS `posts` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `title` varchar(255),
  `text` TEXT,
  `user_id` int,
  `status_id` int,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`status_id`) REFERENCES `poststatus` (`id`) ON DELETE SET NULL
)";


$usersStmt = $db->prepare($usersTable);
$usersStmt->execute();

$postStatusStmt = $db->prepare($poststTable);
$postStatusStmt->execute();

$postsStmt = $db->prepare($postsTable);
$postsStmt->execute();


echo "Tables: users, posts, postStatus created successfully\n";
?>
