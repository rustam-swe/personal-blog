<?php
$servername = "localhost";
$username = "root";
$password = "root5005";

try {
  $conn = new PDO("mysql:host=$servername;dbname=todo", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
}
$title = isset($_POST['title']) ? $_POST['title'] : null;
$text = isset($_POST['text']) ? $_POST['text'] : null;
$data = $conn->query("SELECT * FROM blog")->fetchAll(PDO::FETCH_ASSOC);
if (isset($_POST['id'])){
    $id = $_POST['id'];
}
foreach($data as $item) {
    if($item['id'] == $id) {
        $byIdTitle =  $item['title'];
        $byIdText = $item['text'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
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
    <form class="form" action="admin.php" method="POST">
        <input type="hidden" value='<?php echo $id; ?>' name="newId">
        <input value="<?php echo "$byIdTitle";?>" type="text" name="newTitle" id="" placeholder="Sarlavhani yozing">
        <input value="<?php echo "$byIdText";?>" type="text" name="newText" id="" placeholder="Text qo'shing">
        <button class="" type="submit">Update task</button>
    </form>
    </div>
</body>
</html>