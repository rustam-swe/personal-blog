<?php
require __DIR__ . '/../db.php';

function fetchPosts($db) {
    session_start(); 

    // Foydalanuvchi login qilganligini tekshirish
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }

    $user_id = $_SESSION['user_id']; // Hozirgi foydalanuvchi ID

    // Faqat login bo‘lgan foydalanuvchiga tegishli postlarni olish
    $stmt = $db->prepare("SELECT posts.*, users.name FROM posts JOIN users ON posts.user_id = users.id WHERE posts.user_id = :user_id ORDER BY posts.created_at DESC");
    $stmt->execute(['user_id' => $user_id]);
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $posts;
};

function createPosts($db, $title, $text){
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
    exit;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = trim($_POST['title']);
        $text = trim($_POST['text']);
        $user_id = $_SESSION['user_id'];

        $stmt = $db->prepare("INSERT INTO posts (title, text, user_id) VALUES (:title, :text, :user_id)");
        $stmt->execute(['title' => $title, 'text' => $text, 'user_id' => $user_id]);

        header("Location: posts.php");
        exit;
    }
};

function editPost($db){
    session_start();

    // Foydalanuvchini tekshirish
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }

    $id = $_GET['id'] ?? null;
    $user_id = $_SESSION['user_id']; // Hozirgi foydalanuvchi IbD

    if (!$id) die("Post not found!");

    //Foydalanuvchiga tegishli postni olish
    $stmt = $db->prepare("SELECT * FROM posts WHERE id = :id AND user_id = :user_id");
    $stmt->execute(['id' => $id, 'user_id' => $user_id]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    // Post mavjudligini tekshirish
    if (!$post) {
        die("Post not found or you do not have permission!");
    }

    // POST so‘rov (o‘zgartirish yuborilganda)
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = trim($_POST['title']);
        $text = trim($_POST['text']);

        // Postni yangilash
        $stmt = $db->prepare("UPDATE posts SET title = :title, text = :text WHERE id = :id AND user_id = :user_id");
        $stmt->execute(['title' => $title, 'text' => $text, 'id' => $id, 'user_id' => $user_id]);

        header("Location: posts.php");
        exit;require "controller/post_controller.php";
        $allposts = indexPosts($db, $allposts);
    }
    return $post;
}   

function indexPosts($db){
    $conn = $db;
    $sql = "SELECT posts.*, users.name FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC";
    $stmt = $conn->query($sql);
    $allposts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $allposts;
}

?>