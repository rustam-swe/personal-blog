<?php
include 'db.php'; // MySQL ulanish fayli

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_btn'])) {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Parolni xavfsiz saqlash

    // Foydalanuvchini bazaga qo‘shish
    $stmt = $db->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    if ($stmt->execute([$name, $email, $password])) {
        header("Location: register_action.php"); // Muvaffaqiyatli ro‘yxatdan o‘tganida yo‘naltirish
        exit();
    } else {
        echo "Xatolik yuz berdi.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>

<form action="register_action.php" method="POST">
  <div class="container">
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="name"><b>Name</b></label><br>
    <input type="text" placeholder="Enter Name" name="name" required><br><br>

    <label for="email"><b>Email</b></label><br>
    <input type="email" placeholder="Enter Email" name="email" required><br><br>

    <label for="password"><b>Password</b></label><br>
    <input type="password" placeholder="Enter Password" name="password" required><br><br>
    <hr>

    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p><br>
    <button type="submit" name="submit_btn" class="registerbtn">Register</button>
  </div>

  <div class="container signin">
    <p>Already have an account? <a href="login.php">Sign in</a>.</p>
  </div>
</form>

</body>
</html>
