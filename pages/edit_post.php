<?php
require '../db.php';
session_start();

// Foydalanuvchini tekshirish
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'] ?? null;
$user_id = $_SESSION['user_id']; // Hozirgi foydalanuvchi ID

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
    $title = $_POST['title'];
    $text = $_POST['text'];

    // Postni yangilash
    $stmt = $db->prepare("UPDATE posts SET title = :title, text = :text WHERE id = :id AND user_id = :user_id");
    $stmt->execute(['title' => $title, 'text' => $text, 'id' => $id, 'user_id' => $user_id]);

    header("Location: posts.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>
</head>
<body>
    <h1>Edit Post</h1>
    <h2><a href="posts.php">🔙Cancel</a><br></h2>
    <form method="post">
        <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>" required><br>
        <textarea name="text" required><?= htmlspecialchars($post['text']) ?></textarea><br>
        <button type="submit">Save changes</button>
    </form>
</body>
</html>
