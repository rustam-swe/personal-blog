<?php
require __DIR__ . '/../db.php';

require  'login_and_registratsiya_controller.php';

function fetchPosts($db) {
    session_start(); 

    checkLogin($db);

    $user_id = $_SESSION['user_id'];

    // Faqat login bo‘lgan foydalanuvchiga tegishli postlarni olish
    $stmt = $db->prepare("SELECT posts.*, users.name FROM posts JOIN users ON posts.user_id = users.id WHERE posts.user_id = :user_id ORDER BY posts.created_at DESC");
    $stmt->execute(['user_id' => $user_id]);
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $posts;
};

function createPosts($db, $title, $text){
    session_start();

    checkLogin($db);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = trim($_POST['title']);
        $text = trim($_POST['text']);
        $user_id = $_SESSION['user_id'];

        $stmt = $db->prepare("INSERT INTO posts (title, text, user_id) VALUES (:title, :text, :user_id)");
        $stmt->execute(['title' => $title, 'text' => $text, 'user_id' => $user_id]);

        header("Location: posts.php");
        exit;
    }
};

function editPost($db){
    session_start();

    checkLogin($db);

    $id = $_GET['id'] ?? null;
    $user_id = $_SESSION['user_id'];

    if (!$id) die("Post not found!");

    //Foydalanuvchiga tegishli postni olish
    $stmt = $db->prepare("SELECT * FROM posts WHERE id = :id AND user_id = :user_id");
    $stmt->execute(['id' => $id, 'user_id' => $user_id]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    // Post mavjudligini tekshirish
    if (!$post) {
        die("Post not found or you do not have permission!");
    }

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = trim($_POST['title']);
        $text = trim($_POST['text']);

        // Faqat agar post haqiqatdan o‘zgargan bo‘lsa, `updated_at` yangilanadi
        if ($post['title'] !== $title || $post['text'] !== $text) {
            $stmt = $db->prepare("UPDATE posts SET title = :title, text = :text, updated_at = NOW() WHERE id = :id AND user_id = :user_id");
        } else {
            $stmt = $db->prepare("UPDATE posts SET title = :title, text = :text WHERE id = :id AND user_id = :user_id");
        }

        $stmt->execute(['title' => $title, 'text' => $text, 'id' => $id, 'user_id' => $user_id]);

        header("Location: posts.php");
        exit;
    }
    return $post;
}   

function indexPosts($db){
    $conn = $db;
    $sql = "SELECT posts.*, users.name FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC";
    $stmt = $conn->query($sql);
    $allposts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $allposts;
}

?>
