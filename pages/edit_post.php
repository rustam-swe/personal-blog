<?php
require '../controller/post_controller.php';
$post = editPost($db)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-control {
            border-radius: 5px;
        }
        .btn-save {
            background-color: #007bff;
            border: none;
            color: white;
            font-size: 16px;
            padding: 10px;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
            transition: background 0.3s;
        }
        .btn-save:hover {
            background-color: #0056b3;
        }
        .btn-cancel {
            display: block;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2><a href="posts.php" class="btn btn-outline-danger btn-cancel">🔙 Cancel</a></h2>
    <h1>Edit Post</h1>

    <form method="post">
        <div class="mb-3">
            <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($post['title']) ?>" required>
        </div>
        <div class="mb-3">
            <textarea name="text" class="form-control" rows="5" required><?= htmlspecialchars($post['text']) ?></textarea>
        </div>
        <button type="submit" class="btn-save">Save Changes</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
