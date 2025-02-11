<?php

require '../db.php';

$fetchPosts = function() use ($db) {
  $stmt = $db->prepare("SELECT * FROM posts");
  $stmt->execute();
  $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if (!$posts) die("Posts not found!");

  return $posts;
};

function createPost($title, $text) {
    $stmt = $db->prepare("INSERT INTO posts (title, text) VALUES (:title, :text)");
    $stmt->execute(['title' => $title, 'text' => $text]);
    header("Location: index.php");
}


