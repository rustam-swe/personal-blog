<?php

$pdo = new PDO(dsn:"mysql:host=localhost;dbname=PERSONAL_BLOG", username:"root", password:"0404");

$stmt = $pdo->prepare(query:"CREATE TABLE posts(
    ID INT AUTO_INCREMENT PRIMARY KEY,
    TITLE VARCHAR(255) NOT NULL,
    CANTENT TEXT NOT NULL,
    CREATED_AT DATETIME
)");

$stmt->execute();
printf(format:"Table created successfully\n");