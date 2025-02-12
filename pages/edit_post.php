<?php
require '../controller/post_controller.php';
$post = editPost($db)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>
</head>
<body>
    <h1>Edit Post</h1>
    <h2><a href="posts.php">🔙Cancel</a><br></h2>
    <form method="post">
        <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>" required><br>
        <textarea name="text" required><?= htmlspecialchars($post['text']) ?></textarea><br>
        <button type="submit">Save changes</button>
    </form>
</body>
</html>
