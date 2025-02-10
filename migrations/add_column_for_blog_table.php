<?php
require "../db.php";

$update = $db->prepare("ALTER TABLE blog ADD updated_at TIMESTAMP DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP");
$update->execute();
$user_id = $db->prepare('ALTER TABLE blog ADD user_id int');
$user_id->execute();
$status = $db->prepare("ALTER TABLE blog ADD status ENUM('published', 'drafted') DEFAULT 'drafted'");
$status->execute();
echo "Added user_id to posts table";
?>
