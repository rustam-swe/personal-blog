<?php
include "../db.php";

$update = $db->prepare("ALTER TABLE blog ADD updated_at TIMESTAMP DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP");
$update->execute();
$user_id = $db->prepare('ALTER TABLE blog ADD user_id int');
$user_id->execute();
echo "Added user_id to posts table";
?>
