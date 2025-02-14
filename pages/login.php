<?php
require '../controller/users_controller.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['email'], $_POST['password'])){
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        loginUser($db, $email, $password);
    }else{
        echo "Xatolik Email yoki parol notug'ri kiritilgan!";
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
    <style>
        body {
            background: linear-gradient(to right,rgb(95, 88, 88), #fad0c4);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif;
        }
        .login-container {
            width: 350px;
            background: rgba(255, 255, 255, 0.95);
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        h1 {
            font-size: 26px;
            margin-bottom: 20px;
            color: #333;
        }
        .form-control {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 16px;
        }
        .btn-custom {
            width: 100%;
            padding: 10px;
            font-size: 18px;
            border-radius: 25px;
            transition: all 0.3s ease;
            background:rgb(33, 21, 202);
            border: none;
            color: white;
        }
        .btn-custom:hover {
            background:rgb(116, 107, 106);
            transform: scale(1.05);
        }
        .home-link {
            display: inline-block;
            margin-top: 15px;
            font-size: 16px;
            color: #007bff;
            text-decoration: none;
        }
        .home-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>🔐 Login</h1>
        <form method="post">
            <input type="email" name="email" class="form-control" placeholder="📧 Email" required>
            <input type="password" name="password" class="form-control" placeholder="🔑 Password" required>
            <button type="submit" class="btn btn-custom">Login 🚀</button>
        </form>
        <a href="../index.php" class="home-link">🔙 Home 🏠</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

