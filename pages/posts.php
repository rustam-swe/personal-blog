<?php
require "../controller/post_controller.php";
$posts=fetchPosts($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Posts</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 { 
            color: #333;
        }
        a {
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
        .post {
            padding: 15px;
            margin-bottom: 15px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .post h2 a {
            color: #333;
        } fetchposts
        .post p {
            color: #666;
        }
        .post-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }
        .post-actions a {
            padding: 5px 10px;
            border-radius: 3px;
            background: #007bff;
            color: white;
        }
        .post-actions a:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><a href="../index.php">🏠 Home</a></h2>
        <h1>My Posts</h1>
        <a href="create_post.php" style="display: inline-block; margin-bottom: 10px; padding: 10px; background: #28a745; color: white; border-radius: 5px;">➕ Add new post</a>
        
        <?php if (empty($posts)): ?>
            <p>No posts available.</p>
        <?php else: ?>
            <?php foreach ($posts as $post): ?>
                <div class="post">
                    <h2><a href="post.php?id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']) ?></a></h2>
                    <p><?= nl2br(htmlspecialchars(substr($post['text'], 0, 100))) ?>...</p>
                    <span style="color: #888; font-size: 0.9em;">📅 <?= $post['created_at'] ?> | ✍️ Author: <?= htmlspecialchars($post['name']) ?></span>  
                    
                    <!-- Faqat post tahrirlangan bo‘lsa, "Edited" vaqtini chiqarish -->
                    <?php if (!empty($post['updated_at'])): ?>
                        <br>
                        <span style="color: #888; font-size: 0.9em;">📝 Edited: <?= $post['updated_at'] ?></span>
                    <?php endif; ?>

                    <div class="post-actions">
                        <a href="edit_post.php?id=<?= $post['id'] ?>">✏️ Edit</a>
                        <a href="delete_post.php?id=<?= $post['id'] ?>" onclick="return confirm('Do you want to delete?')" style="background: #dc3545;">🗑️ Delete</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>
