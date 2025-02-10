<?php
require "../db.php";
  $stmt = $db->prepare("CREATE TABLE IF NOT EXISTS blog(
  id SERIAL PRIMARY KEY,
  title VARCHAR(128) NOT NULL ,
  text TEXT NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
  )");

  $stmt->execute();
  
  echo "Jadval muvaffaqiyatli yaratildi!";
?>
