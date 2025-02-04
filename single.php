<?php
$servername = "localhost";
$username = "root";
$password = "root5005";

try {
  $conn = new PDO("mysql:host=$servername;dbname=todo", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
}

if(isset($_POST['id'])) {
    $id = $_POST['id'];
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
    <?php
        $data = $conn->query("SELECT * FROM blog")->fetchAll(PDO::FETCH_ASSOC);
            foreach($data as $item) {
                if($id == $item['id']){
                    echo "
                    <li class='item'>
                    <h2>{$item['title']}</h2>
                    <p>{$item['text']}</p>
                    <div class='wrap'>
                    <p>{$item['created_at']}</p>
                    </div>
                    </li>";
                }
            }
    ?>
    </div>
</body>
</html>