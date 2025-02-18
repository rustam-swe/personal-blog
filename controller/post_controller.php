<?php
session_start(); 
require __DIR__ . '/../db.php';
require  'login_and_registratsiya_controller.php';

function fetchPosts($db) {
    $user_id = $_SESSION['user_id'] ?? null; 

    $stmt = $db->prepare("SELECT posts.*, users.name FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC");
    $stmt->execute();
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $posts;
}


$createPosts = function($title, $text, $status) use ($db){


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = trim($_POST['title']);
	    $text = trim($_POST['text']);
	    $status = trim($_POST['status']);
        $user_id = $_SESSION['user_id'];

        $stmt = $db->prepare("INSERT INTO posts (title, text, status, user_id) VALUES (:title, :text, :status, :user_id)");
        $stmt->execute(['title' => $title, 'text' => $text, 'status' => $status, 'user_id' => $user_id]);

        header("Location: posts.php");
        exit;
    }
};  

function editPost($db){
    // Agar session start qilmagan bo'lsangiz, bu yerga qo'shing
    session_start();

    $id = $_GET['id'] ?? null;
    $user_id = $_SESSION['user_id'];

    if (!$id) die("Post not found!");

    // Foydalanuvchiga tegishli postni olish
    $stmt = $db->prepare("SELECT * FROM posts WHERE id = :id AND user_id = :user_id");
    $stmt->execute(['id' => $id, 'user_id' => $user_id]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);  

    if (!$post) {
        die("Post not found or you do not have permission!");
    }

    // POST so'rovi yuborilganida
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = trim($_POST['title']);
        $text = trim($_POST['text']);

        // Agar ma'lumotlar o'zgargan bo'lsa
        if ($post['title'] !== $title || $post['text'] !== $text) {
            $stmt = $db->prepare("UPDATE posts SET title = :title, text = :text, updated_at = NOW() WHERE id = :id AND user_id = :user_id");
            $stmt->execute(['title' => $title, 'text' => $text, 'id' => $id, 'user_id' => $user_id]);
        }

        // So'nggi qadamda sahifaga qaytish
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
function searchPosts(PDO $db, $searchPhrase, $status) {
    $query = "SELECT posts.*, users.name FROM posts JOIN users ON posts.user_id = users.id WHERE 1";

    if ($searchPhrase) {
        $query .= " AND (posts.title LIKE :search OR posts.text LIKE :search)";
    }
    if ($status) {
        $query .= " AND posts.status = :status";
    }

    $stmt = $db->prepare($query);

    if ($searchPhrase) {
        $stmt->bindValue(':search', "%$searchPhrase%", PDO::PARAM_STR);
    }
    if ($status) {
        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
    }

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$totalPosts = function() use ($db) {
	$stmt = $db->query("SELECT COUNT(id) as total FROM posts");
	return $stmt->fetchColumn();
};

$pageCount = function(int $perPage = 2) use ($totalPosts) {
    return ceil($totalPosts() / $perPage);
};

?>
