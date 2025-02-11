<?php
session_start();
require 'db.php'; // MySQL ulanishi

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Foydalanuvchi mavjudligini tekshirish
    $stmt = $db->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
        // Sessiyaga foydalanuvchi ma’lumotlarini saqlash
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["email"] = $email;
        header("Location: add_users_.php"); // Foydalanuvchini yo‘naltirish
        exit();
    } else {
        $error = "Email yoki parol noto‘g‘ri!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

<form action="index.php" method="post">
  <div class="container">
    <h2>Login</h2>

    <?php if (!empty($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <label for="email"><b>Email</b></label><br>
    <input type="email" placeholder="Enter Email" name="email" required><br><br>

    <label for="password"><b>Password</b></label><br>
    <input type="password" placeholder="Enter Password" name="password" required><br><br>

    <button type="submit">Login</button>
  </div>

  <div class="container">
    <p>Ro‘yxatdan o‘tmaganmisiz? <a href="/pages/register.php">Registratsiya</a></p>
  </div>
</form>

</body>
</htmldb.ph>
