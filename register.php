<?php

var_dump($_POST);
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    include "db.php";

    $query = "INSERT INTO users (name, email, password)
        VALUES (:name, :email, :password)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    $id = $db->lastInsertId();

    setcookie('user_id', $id);
    header('Location: /');
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
<form method="POST">
    <input type="text" name="name">
    <input type="email" name="email">
    <input type="password" name="password">
    <button type="submit">Submit</button>
</form>
</body>
</html>


