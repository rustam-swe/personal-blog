
<?php
include '../db.php';

// SQL JOIN orqali postlar va mualliflarni olish
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
<html>
<head>
    <meta charset="UTF-8">
    <title>personal_blog</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
        }
        h1 {
            color: #333;
        }device-width
        .post {
            border-bottom: 1px solid #ddd;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }
        .post a {
            text-decoration: none;
            color:rgba(0, 204, 255, 0.99);
        }
        .post a:hover {
            text-decoration: underline;
        }
        .date {
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <h1>Personal Blog</h1>
    <a href="create_post.php">Add new post</a>

    <?php foreach ($posts as $post): ?>
        <h2>
            <a href="post.php?id=<?= $post['id'] ?>">
                <?= htmlspecialchars($post['title']) ?>
            </a>
        </h2>
        <p><b>Author:</b> <?= htmlspecialchars($post['author']) ?></p> 
        <span><?=$post['created_at']?></span>
        <span><i><?=$post['updated_at']?></i></span>
        <p><?= nl2br(htmlspecialchars(substr($post['text'], 0, 100))) ?>...</p>
        <a href="edit.php?id=<?= $post['id'] ?>">edit</a>
        <a href="delete.php?id=<?= $post['id'] ?>" onclick="return confirm('Do you want to delete?')">delete</a>
    <?php endforeach; ?>
</body>
</html>

