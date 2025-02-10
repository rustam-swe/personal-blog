<?php
    include "db.php";
    
    if(isset($_COOKIE['user'])) {
        $userName = $_COOKIE['user'];
        $user = $db->query("SELECT * FROM users WHERE name = '$userName'")->fetch(PDO::FETCH_ASSOC);
        $userId = $user['id'];
    }
    $title = isset($_POST['title']) ? $_POST['title'] : null;
    $text = isset($_POST['text']) ? $_POST['text'] : null;
    
    if($text != null && $title != null) {
        $stmt = $db->prepare("INSERT INTO blog(title, text, user_id ) VALUES(:title, :text, :user_id)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':text', $text);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
    }

    if (isset($_POST['newTitle'],$_POST['newText'],$_POST['newId'],$_POST['newStatus'])){
        $newTitle = $_POST['newTitle'];
        $newText = $_POST['newText'];
        $newStatus = $_POST['newStatus'];
        $id = $_POST['newId'];
        $stmt = $db->prepare("UPDATE blog SET title = :title, text = :text, status = :status WHERE id = :id");
        $stmt->bindParam(':title', $newTitle);
        $stmt->bindParam(':text', $newText);
        $stmt->bindParam(':status', $newStatus);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
    if(isset($_GET['delete_cookie'])) {
        setcookie("user", "", time() - 3600);
        header("Location: /");
    }
    $stmt = $db->prepare("SELECT id, title, created_at, updated_at, user_id, status, text FROM blog WHERE user_id = ?");
    $stmt->execute([$userId]);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
<header>
    <div class="container">
        <ul>
            <li>
                <a href="/">Home</a>
                <a href="/admin.php">Admin</a>
            </li>
            <li>
                    <a href="?delete_cookie=1">Cookie O'chirish</a>
            </li>
        </ul>
    </div>
        </header>
    <div class="container">
        <form class="form" action="user.php" method="post">
            <input type="text" name="title" id="" placeholder="Sarlavhani yozing">
            <input type="text" name="text" id="" placeholder="Text qo'shing">
            <button class="" type="submit">Add task</button>
        </form>
        <ul>
        <?php
            if(count($data) > 0) {
                foreach($data as $item) {
                    echo "
                    <li class='item'>
                    <h2>{$item['title']}</h2>
                    <p>{$item['text']}</p>
                    <p>Created: {$item['created_at']}</p>
                    <p>Updated: {$item['updated_at']}</p>
                    <div style='display: flex;gap: 5px;'>
                    <form action='blog.php' method='post'>
                    <input type='hidden' name='id' value='{$item['id']}'>
                    <button class='edit'>Edit</button>
                    </form>
                     <form action='admin.php' method='post'>
                    <input type='hidden' name='deleteId' value='{$item['id']}'>
                    <button class='delete'>Delete</button>
                    </form>
                    </div>
                    <h4 style='margin-top: 10px;'>{$item['status']}</h4>
                    </li>";
                }
            } else {
                echo "<h1>Please add a Blog.</h1>";
            }
            ?>
        </ul>
    </div>
</body>
</html>