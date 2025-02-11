<?php
require "../db.php";
$title = isset($_POST['title']) ? $_POST['title'] : null;
$text = isset($_POST['text']) ? $_POST['text'] : null;
if (isset($_POST['id'])){
    $id = $_POST['id'];
}
$data = $db->query("SELECT * FROM posts WHERE id = $id")->fetch(PDO::FETCH_ASSOC);
$byIdTitle =  $data['title'];
$byIdText = $data['text'];
$byIdStatus = $data['status'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<header>
        <div class="container">
        <ul class="header__list">
            <li>
                <a href="/">Home</a>
            </li>
        </ul>
        </div>
    </header>
    <div class="container">
    <form class="form" action="/pages/user.php" method="POST">
        <input type="hidden" value='<?php echo $id; ?>' name="newId">
        <input value="<?php echo "$byIdTitle";?>" type="text" name="newTitle" id="" placeholder="Sarlavhani yozing">
        <input value="<?php echo "$byIdText";?>" type="text" name="newText" id="" placeholder="Text qo'shing">
        <select name="newStatus" id="">
            <option value="drafted" <?= ($byIdStatus === "drafted") ? "selected" : ""; ?>>Drafted</option>
        <option value="published" <?= ($byIdStatus === "published") ? "selected" : ""; ?>>Published</option>
        </select>
        <button class="" type="submit">Update task</button>
    </form>
    </div>
</body>
</html>