<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../controllers/post_controller.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['title']) && !empty($_POST['text']) && !empty($_POST['status']) && !empty($_POST['category'])) {
        $title = trim($_POST['title']);
        $text = trim($_POST['text']);
        $status = $_POST['status'];
        $category = $_POST['category'];
        $user_id = $_SESSION['user']['id'];

        if (createPost($title, $text, $user_id, $status, $category)) {
            header("Location: ../index.php");
            exit;
        } else {
            $error = "An error occurred, please try again.";
        }
    } else {
        $error = "Please fill in all fields!";
    }
}
?>
<?php
    require_once __DIR__ . '/../base/header.php';
    ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center mb-4">Add New Post</h1>
            <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
            <form method="post" class="bg-light p-4 rounded shadow-sm">
                <div class="form-group mb-3">
                    <input type="text" class="form-control" name="title" placeholder="Title" required>
                </div>
                <div class="form-group mb-3">
                    <textarea name="text" class="form-control" placeholder="Text" required></textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="status" class="form-label">Status:</label>
                    <select name="status" class="form-select" required>
                        <option value="drafted">Drafted</option>
                        <option value="published">Published</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="category" class="form-label">Category:</label>
                    <select name="category" class="form-select" required>
                        <option value="Cybersport">Cybersport</option>
                        <option value="Programming">Programming</option>
                        <option value="Personal">Personal</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
            <a href="../index.php" class="btn btn-link mt-3">Return to homepage</a>
        </div>
    </div>
</div>

<?php
    require_once __DIR__ . '/../base/footer.php';
    ?>

