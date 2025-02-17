<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

include '../models/db.php';

$user_id = $_SESSION['user']['id'];
$status = $_GET['status'] ?? ''; 

$sql = "SELECT * FROM posts WHERE user_id = :user_id";
$params = ['user_id' => $user_id];

if ($status) {
    $sql .= " AND status = :status";
    $params['status'] = $status;
}

$sql .= " ORDER BY created_at DESC";
$stmt = $db->prepare($sql);
$stmt->execute($params);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
    require_once __DIR__ . '/../base/header.php';
    ?>
    <h1 class="center">Personal Blog</h1>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <a class="btn btn-primary" href="../index.php">Home page</a>
            <a class="btn btn-success" href="create.php">Add new post</a>
            <form method="get" class="d-flex align-items-center">
                <select name="status" onchange="this.form.submit()" class="form-select me-2">
                    <option value="">All</option>
                    <option value="published" <?= $status === 'published' ? 'selected' : '' ?>>Published</option>
                    <option value="drafted" <?= $status === 'drafted' ? 'selected' : '' ?>>Drafted</option>
                </select>
            </form>
        </div>
        
        <?php foreach ($posts as $post): ?>
            <div class="card my-3">
                <div class="card-header">
                    <h3>
                        <a class="h3" href="post.php?id=<?= $post['id'] ?>">
                            <?= htmlspecialchars($post['title']) ?>
                        </a>
                    </h3>
                </div>
                <div class="card-body">
                    <span class="badge bg-primary"><?= $post['status'] ?></span> <br>
                    <span><?= $post['created_at'] ?></span> <br>
                    <span><i><?= $post['updated_at'] ?></i></span>
                    <p class="card-text"><?= nl2br(htmlspecialchars(substr($post['text'], 0, 100))) ?>...</p>
                    <?php if ($_SESSION['user']['id'] == $post['user_id']) { ?>
                        <div class="d-flex justify-content-between align-items-center">
                            <a class="btn btn-warning" href="edit.php?id=<?= $post['id'] ?>">edit</a>
                            <form method="post" action="../controllers/post_controller.php">
                               <input type="hidden" name="delete_id" value="<?= $post['id'] ?>">
                               <button class="btn btn-danger" type="submit" onclick="return confirm('Do you want to delete?')">Delete</button>
                            </form>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
    require_once __DIR__ . '/../base/footer.php';
    ?>