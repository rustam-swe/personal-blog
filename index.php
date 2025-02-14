<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Blog</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #74ebd5, #9face6);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 500px;
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        h1 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }
        p {
            font-size: 18px;
            color: #555;
            margin-bottom: 15px;
        }
        .btn-custom {
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 30px;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>👋 Personal Blogga Xush Kelibsiz!</h1>
        <p>Akkauntingizga kiring yoki ro‘yxatdan o‘ting:</p>
        <a href="/pages/login.php" class="btn btn-primary btn-custom">🔑 Kirish</a>
        <a href="/pages/register.php" class="btn btn-success btn-custom">📝 Ro‘yxatdan o‘tish</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
