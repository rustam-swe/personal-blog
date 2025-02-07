<?php

include '../db.php';

$stmt = $db->prepare('ALTER TABLE posts ADD user_id int AFTER id');
$stmt->execute();

echo "Added user_id to posts table";
