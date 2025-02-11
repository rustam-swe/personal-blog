<?php
require '../db.php';
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
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add new post</title>
</head>
<body>
    <h1>Add new post</h1>
    <h2><a href="posts.php">🔙Back</a><br></h2>
    <form method="post">
        <input type="text" name="title" placeholder="title" required><br><br>
        <textarea name="text" placeholder="text" required></textarea><br><br>
        <button type="submit">submit</button>
    </form>
    <style>
    .submit-btn {
        background-color: #333;
        background: linear-gradient(to bottom, #333, #444);
        border: 1px solid #222;
        color: #fff;
        cursor: pointer;
        height: 35px;
        width: 110px;
        font-size: 14px;
        border-radius: 5px;
    }

    .submit-btn:hover {
        background: linear-gradient(to bottom, #444, #555);
    }
</style>
</body>
</html>