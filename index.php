<?php
session_start();
include __DIR__ . "/controller/post_controller.php";
include __DIR__ . "/db.php";

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
</head>
<body>

    <div class="container text-center mt-4">
        <h1>👋 Personal Blogga Xush Kelibsiz!</h1>
        <p>Akkauntingizga kiring yoki ro‘yxatdan o‘ting:</p>
        <a href="/pages/login.php" class="btn btn-primary">🔑 Kirish</a>
        <a href="/pages/register.php" class="btn btn-success">📝 Ro‘yxatdan o‘tish</a>
    </div>

    <div class="container mt-4">
        <form action="" method="get" class="row g-2">
            <div class="col-md-5">
                <input type="text" name="search" class="form-control" placeholder="🔍 Search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">All</option>
                    <option value="published" <?= ($_GET['status'] ?? '') == 'published' ? 'selected' : '' ?>>Published</option>
                    <option value="drafted" <?= ($_GET['status'] ?? '') == 'drafted' ? 'selected' : '' ?>>Drafted</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">🔍 Search</button>
            </div>
        </form>
    </div>

    <div class="container mt-4">
        <?php if (empty($allposts)): ?>
            <div class="alert alert-warning text-center">⛔ Post topilmadi!</div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($allposts as $post): ?>
                    <div class="col-md-6">
                        <div class="card mb-3 shadow-sm">
                            <div class="card-body">
                                <h2 class="card-title"><?= htmlspecialchars($post["title"]) ?></h2>
                                <p class="card-text"><?= nl2br(htmlspecialchars($post["text"])) ?></p>
                                <small class="text-muted">
                                    ✍️ Muallif: <?= htmlspecialchars($post["name"]) ?> | 📅 <?= $post["created_at"] ?>
                                </small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
