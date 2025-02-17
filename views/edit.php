<?php
session_start();

require_once '../controllers/post_controller.php';
require_once '../models/db.php';

$id = $_GET['id'] ?? null;
if (!$id) die("Post not found!");

$stmt = $db->prepare("SELECT * FROM posts WHERE id = :id");
$stmt->execute(['id' => $id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['title'], $_POST['text'], $_POST['status']) && isset($_SESSION['user']['id'])) {
        edit($_POST['title'], $_POST['text'],  $id , $_POST['status']);
    }
}
?>
<?php
    require_once __DIR__ . '/../base/header.php';
    ?>
    <div class="container">
        <h1 class="text-center mb-4">Edit post</h1>
        <form method="POST" class="bg-light p-4 rounded shadow-sm">
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="title" value="<?= htmlspecialchars($post['title']) ?>" required>
            </div>
            <div class="form-group mb-3">
                <textarea name="text" class="form-control" required><?= htmlspecialchars($post['text']) ?></textarea>
            </div>
            <div class="form-group mb-3">
                <label for="status" class="form-label">Status:</label>
                <select name="status" class="form-select">
                    <option value="drafted" <?= $post['status'] === 'drafted' ? 'selected' : '' ?>>Drafted</option>
                    <option value="published" <?= $post['status'] === 'published' ? 'selected' : '' ?>>Published</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>
    <?php
    require_once __DIR__ . '/../base/footer.php';
    ?>

