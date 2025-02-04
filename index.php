<?php
$servername = "localhost";
$username = "root";
$password = "root5005";

try {
  $conn = new PDO("mysql:host=$servername;dbname=todo", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style.css">
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
        <div class="wrapper">
            <div class="container">
            <ul class="list">
            <?php
                $data = $conn->query("SELECT * FROM blog")->fetchAll(PDO::FETCH_ASSOC);
                if(count($data) > 0) {
                    foreach($data as $item) {
                        echo "
                        <li class='item'>
                        <h2>{$item['title']}</h2>
                        <p>{$item['text']}</p>
                        <div class='wrap'>
                        <p>{$item['created_at']}</p>
                        <form action='single.php' method='post'>
                            <input type='hidden' name='id' value='{$item['id']}'>
                            <button class='info'>Batafsil</button>
                        </form>
                        </div>
                        </li>";
                    }
                } else {
                    echo "<h1>Please add a task.</h1>";
                }
            ?>
            </div>
        </ul>
    </div>
</body>
</html>