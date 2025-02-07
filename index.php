<?php
include 'db.php';

// SQL so‘rovi orqali postlar va mualliflarni olish
$stmt = $db->query("
    SELECT posts.id, posts.title, posts.text, posts.created_at, posts.updated_at, 
           COALESCE(users.name, 'Unknown Author') AS author
    FROM posts
    LEFT JOIN users ON posts.user_id = users.id
    ORDER BY posts.created_at DESC
");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Personal Blog</title>
    <style>
        /* Umumiy container */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Blog sarlavhasi */
        h1 {
            text-align: center;
            color: #007bff;
        }

        /* Postlarni joylash */
        .posts {
            margin-top: 20px;
        }

        /* Har bir post uchun karta */
        .post-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .post-card:hover {
            transform: scale(1.02);
        }

        /* Post nomi */
        .post-card h2 {
            margin: 0;
            color: #007bff;
        }

        .post-card h2 a {
            text-decoration: none;
        }

        .post-card h2 a:hover {
            text-decoration: underline;
        }

        /* Muallif va sana */
        .author, .date {
            font-size: 14px;
            color: #777;
        }

        /* Post qisqacha tavsif */
        .excerpt {
            margin: 10px 0;
        }

        /* Tugmalar */
        .buttons {
            margin-top: 10px;
        }

        .btn {
            display: inline-block;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            margin-right: 5px;
        }

        .btn-read {
            background-color: #007bff;
            color: white;
        }

        .btn-edit {
            background-color: #ffc107;
            color: black;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }

        .btn-primary {
            display: block;
            text-align: center;
            margin-bottom: 15px;
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            font-size: 16px;
            font-weight: bold;
        }

        .btn:hover {
            opacity: 0.8;
        }

        /* Postlar mavjud bo‘lmasa */
        .no-posts {
            text-align: center;
            color: #666;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>📖 Personal Blog</h1>
        <a href="create.php" class="btn btn-primary">➕ Add new post</a>

        <div class="posts">
            <?php if (count($posts) > 0): ?>
                <?php foreach ($posts as $post): ?>
                    <div class="post-card">
                        <h2>
                            <a href="post.php?id=<?= $post['id'] ?>">
                                <?= htmlspecialchars($post['title']) ?>
                            </a>
                        </h2>
                        <p class="author">✍️ Author: <b><?= htmlspecialchars($post['author']) ?></b></p>
                        <p class="date">🕒 <?= date("F j, Y, g:i a", strtotime($post['created_at'])) ?></p>
                        <p class="excerpt"><?= nl2br(htmlspecialchars(substr($post['text'], 0, 120))) ?>...</p>
                        <div class="buttons">
                            <a href="post.php?id=<?= $post['id'] ?>" class="btn btn-read">📖 Read more</a>
                            <a href="edit.php?id=<?= $post['id'] ?>" class="btn btn-edit">✏️ Edit</a>
                            <a href="delete.php?id=<?= $post['id'] ?>" class="btn btn-delete" onclick="return confirm('Do you want to delete?')">🗑️ Delete</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-posts">No posts found.</p>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>
