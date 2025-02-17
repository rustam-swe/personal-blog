<?php
require './controllers/post_controller.php';

if (!isset($_SESSION['user'])) {
    header("Location: views/login.php");
    exit;
}

$searchPhrase = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';

$page = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
$limit = 5;
$offset = ($page - 1) * $limit;

$totalPosts = countPosts($category);
$totalPages = ceil($totalPosts / $limit);

$posts = $searchPhrase ? searchPosts($searchPhrase) : fetchPosts($category);

$posts = array_slice($posts, $offset, $limit);
?>

<?php
    require_once __DIR__ . '/base/header.php';
    ?>
    <h1 class="text-center">Personal Blog</h1>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a class="btn btn-primary" href="views/create.php">Add new post</a>
            <form action="" method="get" class="d-flex align-items-center">
                <input type="text" name="search" placeholder="Search" value="<?= htmlspecialchars($searchPhrase) ?>" class="form-control me-2">
                <select name="category" class="form-select me-2">
                    <option value="">All Categories</option>
                    <option value="Cybersport" <?= $category === 'Cybersport' ? 'selected' : '' ?>>Cybersport</option>
                    <option value="Personal" <?= $category === 'Personal' ? 'selected' : '' ?>>Personal</option>
                    <option value="Programming" <?= $category === 'Programming' ? 'selected' : '' ?>>Programming</option>
                </select>
                <button type="submit" class="btn btn-secondary">Filter</button>
            </form>
            <a class="btn btn-primary" href="views/my_posts.php">My posts</a>
            <a class="btn btn-danger" href="views/logout.php">Exit</a>
        </div>

        <?php if (!$posts): ?>
            <p class="text-center">Posts not found</p>
        <?php else: ?>
            <?php foreach ($posts as $post): ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a class="h3" href="views/post.php?id=<?= $post['id'] ?>">
                                <?= htmlspecialchars($post['title']) ?>
                            </a>
                        </h5>
                        <span class="text-muted"><?= $post['created_at'] ?></span>
                        <p class="card-text"><?= nl2br(htmlspecialchars(substr($post['text'], 0, 100))) ?>...</p>
                        <b>Category: <?= htmlspecialchars($post['category']) ?></b>
                        <?php if ($_SESSION['user']['id'] == $post['user_id']): ?>
                            <div class="d-flex justify-content-end align-items-center">
                                <a class="btn btn-primary me-2" href="views/edit.php?id=<?= $post['id'] ?>">edit</a>
                                <form method="post" action="controllers/post_controller.php">
                                    <input type="hidden" name="delete_id" value="<?= $post['id'] ?>">
                                    <button class="btn btn-danger" type="submit" onclick="return confirm('Do you want to delete?')">Delete</button>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php if ($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $page - 1 ?>&category=<?= urlencode($category) ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <li class="page-item"><span class="page-link"><?= $page ?> of <?= $totalPages ?></span></li>

                    <?php if ($page < $totalPages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $page + 1 ?>&category=<?= urlencode($category) ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
    <?php
    require_once __DIR__ . '/base/footer.php';
    ?>