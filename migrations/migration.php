<?php
require "../db.php";

$db->query("DROP TABLE IF EXISTS users");
$db->query("DROP TABLE IF EXISTS posts");

$usersTable = "CREATE TABLE `users` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255),
  `email` varchar(255),
  `password` varchar(255)
)";

$postsTable = "CREATE TABLE `posts` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `title` varchar(255),
  `text` varchar(255),
  `user_id` int,
  `status` enum('published', 'drafted') DEFAULT 'published',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

$postsForeignKey = "ALTER TABLE `posts` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)";

$usersStmt = $db->prepare($usersTable);
$usersStmt->execute();


$postsStmt = $db->prepare($postsTable);
$postsStmt->execute();

$db->query($postsForeignKey);

echo "Tables: users, posts created successfully\n";
?>
