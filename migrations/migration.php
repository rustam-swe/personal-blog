<?php
require "../db.php";
$db->query("DROP TABLE IF EXISTS users");
$db->query("DROP TABLE IF EXISTS posts");

$usersTable = "CREATE TABLE  users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL
)";

$postsTable = "CREATE TABLE posts(
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  text VARCHAR(255) NOT NULL,
  user_id INT,
  status ENUM('published', 'drafted') DEFAULT 'drafted',
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
)";

$postsForeignKey = "ALTER TABLE posts ADD FOREIGN KEY (user_id) REFERENCES users (id)";

$usersStmt = $db->prepare($usersTable);
$usersStmt->execute();

$postsStmt = $db->prepare($postsTable);
$postsStmt->execute();

$db->query($postsForeignKey);

echo "Tables: users, posts created successfully\n";
?>
