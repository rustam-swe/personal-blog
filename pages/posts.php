<?php
// if (session_status() === PHP_SESSION_NONE) {
//     session_start();
// }

require "../controller/post_controller.php";
include "../db.php"; 

$logged_in_user = $_SESSION['user_id'] ?? null;


$searchPhrase = $_GET['search'] ?? '';
$status = $_GET['status'] ?? '';

$allposts = ($searchPhrase || $status) ? searchPosts($db, $searchPhrase, $status) : fetchPosts($db);


$user_posts = [];
$other_posts = [];

foreach ($allposts as $post) {
    if ($logged_in_user && $logged_in_user == $post['user_id']) {
        $user_posts[] = $post;
    } else {
        $other_posts[] = $post;
    }
}
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Blog</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .card {
            border-radius: 10px;
            border: 1px solid #ddd;
        }
        .card-body {
            padding: 15px;
        }
        .card-title {
            font-weight: bold;
            font-size: 18px;
        }
        .bg-white {
            border-radius: 10px;
            padding: 15px;
        }
    </style>
</head>
<body class="bg-light">

<div class="container py-4">
    <h1 class="text-center mb-4">📌 Personal Blog</h1>

    <?php if (!empty($user_posts)): ?>
        <div class="mb-4 p-3 bg-white shadow rounded">
            <h3 class="mb-3">📌 My Posts</h3>
            <form action="" method="get" class="d-flex gap-2">
                <input type="text" name="search" class="form-control" placeholder="🔍 Search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                <select name="status" class="form-select">
                    <option value="">All</option>
                    <option value="published" <?= ($_GET['status'] ?? '') == 'published' ? 'selected' : '' ?>>Published</option>
                    <option value="drafted" <?= ($_GET['status'] ?? '') == 'drafted' ? 'selected' : '' ?>>Drafted</option>
                </select>
                <button type="submit" class="btn btn-primary">🔍 Search</button>
            </form>
            <a href="logout.php" class="btn btn-danger mt-3">❌ Log out</a>
            <a href="create_post.php" class="btn btn-success mt-3">➕ Add new post</a>
        </div>

        <?php foreach ($user_posts as $post): ?>
            <div class="card mb-3 shadow">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($post["title"]) ?></h5>
                    <p class="card-text"><?= nl2br(htmlspecialchars($post["text"])) ?></p>
                    <small class="text-muted">📅 <?= $post["created_at"] ?></small>
                    <div class="mt-2">
                        <a href="edit_post.php?id=<?= $post['id'] ?>" class="btn btn-primary btn-sm">✏️ Edit</a>
                        <a href="delete_post.php?id=<?= $post['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Haqiqatan ham o‘chirmoqchimisiz?');">🗑 Delete</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (!empty($other_posts)): ?>
        <div class="mt-5 mb-4 p-3 bg-white shadow rounded">
            <h3 class="mb-3">🌍 Others</h3>
        </div>

        <?php foreach ($other_posts as $post): ?>
            <div class="card mb-3 border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($post["title"]) ?></h5>
                    <p class="card-text"><?= nl2br(htmlspecialchars($post["text"])) ?></p>
                    <small class="text-muted">✍️ Muallif: <?= htmlspecialchars($post["name"]) ?> | 📅 <?= $post["created_at"] ?></small>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
