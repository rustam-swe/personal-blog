<?php
require '../controller/users_controller.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($email && $password) {
        $loginUser($email, $password);
    } else {
        echo "Xatolik: Email yoki parol noto‘g‘ri kiritilgan!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

    
    <header class="bg-light shadow-sm">
        <div class="container d-flex justify-content-between align-items-center py-3">
            <!-- Logo or Title -->
            <a class="navbar-brand text-primary" href="#">
                <h2 style="font-family: 'Arial', sans-serif;">👋 Personal-Blog</h2>
            </a>
            <!-- Navigation links -->
            <nav>
                <a href="/" class="text-dark mx-3">🏠 Bosh sahifa</a>
                <a href="/about.html" class="text-dark mx-3">ℹ️ Biz haqimizda</a>
                <a href="/contact.html" class="text-dark mx-3">📩 Aloqa</a>
            </nav>
        </div>
    </header>

    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow" style="width: 350px;">
            <h3 class="text-center">🔐 Login</h3>
            <form method="POST">
                <input type="email" name="email" class="form-control mb-3" placeholder="📧 Email" required>
                <input type="password" name="password" class="form-control mb-3" placeholder="🔑 Password" required>
                <button type="submit" class="btn btn-primary w-100">Login 🚀</button>
            </form>
            <br>
            <a href="/" class="btn btn-outline-primary w-100">🔙 Home</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
