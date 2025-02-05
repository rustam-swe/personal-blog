<?php
$servername = "localhost";
$username = "root";
$password = "root5005";

try {
    $conn = new PDO("mysql:host=$servername;dbname=todo", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("CREATE TABLE IF NOT EXISTS blog(
  id SERIAL PRIMARY KEY,
  title VARCHAR(128) NOT NULL ,
  text TEXT NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
  )");

  $stmt->execute();
  
  echo "Jadval muvaffaqiyatli yaratildi!";
} catch(PDOException $e) {
    echo "Ulanishda xatolik yuz berdi: " . $e->getMessage();
}
?>