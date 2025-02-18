<?php
require '../controller/users_controller.php'; 
require '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Foydalanuvchini ro‘yxatdan o‘tkazish
    if (registerUser($db, $name, $email, $password)) {
        echo "<script>alert('Registration successful!'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Registration failed. Try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 400px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 80px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
        }
        .registerbtn {
            width: 100%;
            padding: 10px;
            border: none;
            background: #28a745;
            color: white;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: 0.3s;
        }
        .registerbtn:hover {
            background: #218838;
        }
        .signin {
            text-align: center;
            margin-top: 10px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>

<body>
<header class="bg-light shadow-sm">
        <div >
            <a class="navbar-brand text-primary" href="#">
                <h2 style="font-family: 'Arial', sans-serif;">👋 Personal-Blog</h2>
            </a>
            
            <nav>
                <a href="/" class="text-dark mx-3">🏠 Bosh sahifa</a>
                <a href="/about.html" class="text-dark mx-3">ℹ️ Biz haqimizda</a>
                <a href="/contact.html" class="text-dark mx-3">📩 Aloqa</a>
            </nav>
        </div>
    </header>

<div class="container">
    <h1>Register</h1>
    <p class="text-center">Please fill in this form to create an account.</p>
    <hr>

    <form action="" method="POST">
        <label for="name"><b>Name</b></label>
        <input type="text" placeholder="Enter Name" name="name" required>

        <label for="email"><b>Email</b></label>
        <input type="email" placeholder="Enter Email" name="email" required>

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>
        
        <hr>
        <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
        <button type="submit" class="registerbtn">Register</button>
    </form>

    <div class="signin">
        <p>Already have an account? <a href="login.php">Sign in</a>.</p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
