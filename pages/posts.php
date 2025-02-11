<?php
require '../db.php';
session_start(); // Sessiyani boshlash

// Foydalanuvchi login qilganligini tekshirish
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id']; // Hozirgi foydalanuvchi ID

// Faqat login bo‘lgan foydalanuvchiga tegishli postlarni olish
$stmt = $db->prepare("SELECT * FROM posts WHERE user_id = :user_id ORDER BY created_at DESC");
$stmt->execute(['user_id' => $user_id]);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Posts</title>
</head>
<body>
    <a href="login.php">🔙Login.Back</a>
    <a href="register.php">🔙Register.Back</a>
    <h2><a href="../index.php">Home🏠</a><br></h2>
    <h1>My Posts</h1>
   
    <a href="create_post.php">Add new post</a>

    <?php if (empty($posts)): ?>
        <p>No posts available.</p> <!-- Agar post bo'lmasa, xabar chiqadi -->
    <?php else: ?>
        <?php foreach ($posts as $post): ?>
            <h2>
                <a href="post.php?id=<?= $post['id'] ?>">
                    <?= htmlspecialchars($post['title']) ?>
                </a>
            </h2>
            <p><?= nl2br(htmlspecialchars(substr($post['text'], 0, 100))) ?>...</p>
            <span><?=$post['created_at']?></span>
            <a href="edit_post.php?id=<?= $post['id'] ?>">Edit</a>
            <a href="delete_post.php?id=<?= $post['id'] ?>" onclick="return confirm('Do you want to delete?')">Delete</a>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
