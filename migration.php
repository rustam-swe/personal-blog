<?php

$pdo = new PDO("mysql:host=localhost;dbname=personal_blog", 'root', '1234');

$stmt = $pdo->prepare("create table posts(
    id int primary key auto_increment,
    title varchar(255) NOT NULL,
    content text not null,
    created_at datetime
)");

$stmt->execute();

printf("Table created successfully\n");






