<?php
require "../models/db.php"; 
require "../controllers/post_controller.php";

if (isset($_GET['id'])) {
    $post_id = $_GET['id'];
    $post = fetchPost($db, $post_id); 

    if (!$post) {
        die("Post topilmadi!");
    }
} else {
    die("ID berilmagan!");
}
?>

<?php
    require_once __DIR__ . '/../base/header.php';
    ?>
    <div class="container">
        <h1 class="display-4"><?= htmlspecialchars($post['title']) ?></h1>
        <div class="post-meta">Yozilgan sana: <?= htmlspecialchars($post['created_at']) ?></div>
        <p class="lead"><?= nl2br(htmlspecialchars($post['text'])) ?></p>
        <a href="../index.php" class="btn btn-primary">Asosiy sahifaga qaytish</a>
    </div>
    <?php
    require_once __DIR__ . '/../base/footer.php';
    ?>
