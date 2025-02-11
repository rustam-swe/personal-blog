<?php
require '../db.php';
session_start(); // Sessiyani boshlash

// Foydalanuvchi login qilganligini tekshirish
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id']; // Hozirgi foydalanuvchi ID
$id = $_GET['id'] ?? null;

if (!$id) {
    die("Post not found!");
}

// Post foydalanuvchiga tegishli ekanligini tekshirish
$stmt = $db->prepare("SELECT * FROM posts WHERE id = :id AND user_id = :user_id");
$stmt->execute(['id' => $id, 'user_id' => $user_id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    die("Post not found or you do not have permission to delete it!");
}

// Postni bazadan o‘chirish
$stmt = $db->prepare("DELETE FROM posts WHERE id = :id");
$stmt->execute(['id' => $id]);

// O‘chirilgandan keyin postlar sahifasiga qaytish
header("Location: posts.php");
exit;
?>
