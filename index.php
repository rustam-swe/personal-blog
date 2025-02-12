<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Blog</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Personal Blog</h1>
        <?php
           require __DIR__ . '/controller/post_controller.php';
           $allposts = indexPosts($db, $allposts);

            foreach ($allposts as $posts) { 
                echo "<div class='card mb-3'>";
                echo "<div class='card-body'>";
                echo "<h2 class='card-title'>" . htmlspecialchars($posts["title"]) . "</h2>";
                echo "<p class='card-text'>" . nl2br(htmlspecialchars($posts["text"])) . "</p>";
                echo "<small class='text-muted'>✍️ Muallif: " . htmlspecialchars($posts["name"]) . " | 📅 Yaratilgan sana: " . $posts["created_at"] . "</small>";
                echo "</div>";
                echo "</div>";
            }
        ?>
        <div class="text-center mt-4">
            <p>Akkauntga kirish! <a href="/pages/login.php" class="btn btn-primary">Sign in</a></p>
            <p>Ro‘yxatdan o‘tish! <a href="/pages/register.php" class="btn btn-success">Sign up</a></p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>