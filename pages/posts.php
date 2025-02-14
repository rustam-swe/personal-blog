<?php
require "../controller/post_controller.php";
$posts=fetchPosts($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Posts</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .post {
            padding: 15px;
            margin-bottom: 15px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .post:hover {
            transform: scale(1.02);
        }
        .post h2 a {
            color: #333;
            text-decoration: none;
        }
        .post h2 a:hover {
            text-decoration: underline;
        }
        .post p {
            color: #666;
        }
        .post-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }
        .post-actions a {
            padding: 7px 15px;
            border-radius: 5px;
            color: white;
            text-decoration: none;
        }
        .edit-btn {
            background: #007bff;
        }
        .edit-btn:hover {
            background: #0056b3;
        }
        .delete-btn {
            background: #dc3545;
        }
        .delete-btn:hover {
            background: #b52b37;
        }
        .add-btn {
            display: block;
            margin: 10px 0;
            padding: 10px;
            background: #28a745;
            color: white;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
        }
        .add-btn:hover {
            background: #218838;
        }
    </style>
</head>
<body>

<div class="container">
    <h2><a href="../index.php" class="btn btn-outline-primary">🏠 Home</a></h2>
    <h1>My Posts</h1>
    <a href="create_post.php" class="add-btn">➕ Add new post</a>

    <?php if (empty($posts)): ?>
        <p class="text-center text-muted">No posts available.</p>
    <?php else: ?>
        <?php foreach ($posts as $post): ?>
            <div class="post">
                <h2><a href="post.php?id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']) ?></a></h2>
                <p><?= nl2br(htmlspecialchars(substr($post['text'], 0, 100))) ?>...</p>
                <small class="text-muted">📅 <?= $post['created_at'] ?> | ✍️ Author: <?= htmlspecialchars($post['name']) ?></small>

                <?php if (!empty($post['updated_at'])): ?>
                    <br>
                    <small class="text-muted">📝 Edited: <?= $post['updated_at'] ?></small>
                <?php endif; ?>

                <div class="post-actions">
                    <a href="edit_post.php?id=<?= $post['id'] ?>" class="edit-btn">✏️ Edit</a>
                    <a href="delete_post.php?id=<?= $post['id'] ?>" onclick="return confirm('Do you want to delete?')" class="delete-btn">🗑️ Delete</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php
        $allpostss = indexPosts($db);
        foreach ($allpostss as $posts) { 
            echo "<div class='card mb-3'>";
            echo "<div class='card-body'>";
            echo "<h2 class='card-title'>" . htmlspecialchars($posts["title"]) . "</h2>";
            echo "<p class='card-text'>" . nl2br(htmlspecialchars($posts["text"])) . "</p>";
            echo "<small class='text-muted'>✍️ Muallif: " . htmlspecialchars($posts["name"]) . " | 📅 Yaratilgan sana: " . $posts["created_at"] . "</small>";
            echo "</div>";
            echo "</div>";
        }
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
