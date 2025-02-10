<?php
include "db.php";
$title = isset($_POST['title']) ? $_POST['title'] : null;
$text = isset($_POST['text']) ? $_POST['text'] : null;
if($text != null) {
    $db->query("INSERT INTO blog( title, text ) VALUES ('$title','$text')");
}
$data = $db->query("SELECT * FROM blog")->fetchAll(PDO::FETCH_ASSOC);
if (isset($_GET['id'])){
    $id = $_GET['id'];
}
if (isset($_POST['newTitle']) && isset($_POST['newText']) && isset($_POST['newId'])){
    $newTitle = $_POST['newTitle'];
    $newText = $_POST['newText'];
    $id = $_POST['newId'];
    $stmt = $db->prepare("UPDATE blog SET title = :title, text = :text WHERE id = :id");
    $stmt->bindParam(':title', $newTitle);
    $stmt->bindParam(':text', $newText);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}
if (isset($_POST['deleteId'])) {
    $id = $_POST['deleteId'];
    $stmt = $db->prepare("DELETE FROM  blog WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <header>
            <div class="container">
            <ul>
                <li>
                    <a href="/">Home</a>
                    <a href="/admin.php">Admin</a>
                </li>
            </ul>
            </div>
        </header>
    <div class="container">
        <form class="form" action="admin.php" method="post">
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
                    <p>{$item['created_at']}</p>
                    <form action='blog.php' method='post'>
                    <input type='hidden' name='id' value='{$item['id']}'>
                    <button class='edit'>Edit</button>
                    </form>
                     <form action='admin.php' method='post'>
                    <input type='hidden' name='deleteId' value='{$item['id']}'>
                    <button class='delete'>Delete</button>
                    </form>
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