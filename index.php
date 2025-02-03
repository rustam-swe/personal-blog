<html>
<h1>Personal Blog</h1>
<form action="index.php" method="post">
  <input type="text" name="title" placeholder="Title"><br>
  <textarea name="text"></textarea><br>
<button type="submit">Submit</button>
</form>
</html>

<?php

$title = $_POST['title'] ?? null;
$text = $_POST['text'] ?? null;
$date = date('Y-m-d H:i:s');

try {
  $db = new PDO("mysql:host=localhost;dbname=personal_blog", 'root', '1234');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

$stmt = $db->prepare("INSERT INTO posts(title, text, created_at) VALUES(:title, :text, :created_at)");
$stmt->execute(['title'=>$title, 'text'=>$text, 'created_at' => $date]);







