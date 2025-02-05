<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h1 class="text-center">📜 Personal Blog</h1>

    <div class="card p-4 shadow-sm mb-4">
        <form action="index.php" method="post">
            <input type="hidden" name="post_id" value="">
            <input type="text" name="title" class="form-control mb-2" placeholder="Title" required>
            <textarea name="text" class="form-control mb-2" placeholder="Post mazmuni" required></textarea>
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>

    <?php
    try {
        $db = new PDO("mysql:host=localhost;dbname=PERSONAL_BLOG", 'root', '0404');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("<p class='text-danger text-center'>Connection failed: " . $e->getMessage() . "</p>");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $post_id = $_POST['post_id'] ?? null;
        $title = $_POST['title'] ?? null;
        $text = $_POST['text'] ?? null;
        $date = date('Y-m-d H:i:s');

        if ($title && $text) {
            if ($post_id) {
                $stmt = $db->prepare("UPDATE posts SET TITLE = :TITLE, CANTENT = :CANTENT WHERE ID = :ID");
                $stmt->execute(['TITLE' => $title, 'CANTENT' => $text, 'ID' => $post_id]);
                echo "<div class='alert alert-success text-center'>Post muvaffaqiyatli yangilandi!</div>";
            } else {
                $stmt = $db->prepare("INSERT INTO posts(TITLE, CANTENT, CREATED_AT) VALUES(:TITLE, :CANTENT, :CREATED_AT)");
                $stmt->execute(['TITLE' => $title, 'CANTENT' => $text, 'CREATED_AT' => $date]);
                echo "<div class='alert alert-success text-center'>Post muvaffaqiyatli qo‘shildi!</div>";
            }
        }
    }

    if (isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];
        $stmt = $db->prepare("DELETE FROM posts WHERE ID = :ID");
        $stmt->execute(['ID' => $delete_id]);
        echo "<div class='alert alert-danger text-center'>Post o‘chirildi!</div>";
    }
    ?>

    <h2 class="text-center my-4">📌 Barcha Postlar</h2>
    <div class="row">
        <?php
        $stmt = $db->query("SELECT * FROM posts ORDER BY CREATED_AT DESC");
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($posts) {
            foreach ($posts as $post) {
                echo "
                <div class='col-md-4 mb-3'>
                    <div class='card shadow-sm'>
                        <div class='card-body'>
                            <h5 class='card-title'>{$post['TITLE']}</h5>
                            <p class='card-text'>{$post['CANTENT']}</p>
                            <small class='text-muted'>📅 {$post['CREATED_AT']}</small>
                            <div class='mt-3'>
                                <a href='index.php?edit={$post['ID']}' class='btn btn-sm btn-warning'>✏ Tahrirlash</a>
                                <a href='index.php?delete={$post['ID']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Rostdan ham o‘chirmoqchimisiz?\")'>🗑 O‘chirish</a>
                            </div>
                        </div>
                    </div>
                </div>";
            }
        } else {
            echo "<p class='text-center text-muted'>🚫 Hozircha hech qanday post mavjud emas.</p>";
        }
        ?>
    </div>
</div>

</body>
</html>
