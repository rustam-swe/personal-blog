<?php
require "../controller/post_controller.php";
$createPosts($title, $text, $status);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Post</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-control {
            border-radius: 5px;
        }
        .submit-btn {
            background-color: #007bff;
            border: none;
            color: white;
            font-size: 16px;
            padding: 10px;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
            transition: background 0.3s;
        }
        .submit-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<header class="bg-light shadow-sm">
    <div class="container d-flex justify-content-between align-items-center py-3">
        <!-- Logo or Title -->
        <a class="navbar-brand text-primary" href="#">
            <h2 style="font-family: 'Arial', sans-serif;">👋 Personal-Blog</h2>
        </a>
        <!-- Navigation links -->
        <nav>
            <a href="/" class="text-dark mx-3">Bosh sahifa</a>
            <a href="/about.html" class="text-dark mx-3">Biz haqimizda</a>
            <a href="/contact.html" class="text-dark mx-3">Aloqa</a>
        </nav>
    </div>
</header>
<div class="container">
    <h2><a href="posts.php" class="btn btn-outline-primary">🔙 Back</a></h2>
    <h1>Add New Post</h1>

    <form method="post">
        <div class="mb-3">
            <input type="text" name="title" class="form-control" placeholder="Enter title" required>
        </div>
        <div class="mb-3">
            <textarea name="text" class="form-control" rows="5" placeholder="Enter post text" required></textarea>
        </div>
	<div>
	    <select name="status" class="form-select">
		<option value="published">Published</option>
		<option value="drafted">Drafted</option>
	    </select>
	</div>
	<br><button type="submit" class="submit-btn">Submit</button>
    </form>
</div>
<div class="container text-center mt-4">
        <p>About the Blog
This blog is designed to share my personal experiences, 
thoughts, and creations. I write here about important events in my life, 
my travels, books, technology, 
and many other topics. 
I try to make each post on my blog 
interesting and useful to read.</p>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
