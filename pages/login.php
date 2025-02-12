<?php
require '../controller/users_controller.php'; 
loginUser($db, $email, $password)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <h2><a href="../index.php">🔙Home🏠</a><br></h2>
    <form method="post">
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Login</button> 
    </form>
</body>
</html>
