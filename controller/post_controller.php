<?php
//session_start(); 
require __DIR__ . '/../db.php';
require  'login_and_registratsiya_controller.php';

function fetchPosts($db, $currentPage) {
    $user_id = $_SESSION['user_id'] ?? null; // Agar foydalanuvchi login qilmagan bo‘lsa, $user_id = null

    $postsPerPage = 2;
    $offset = ($currentPage - 1) * $postsPerPage;
    // Barcha postlarni olish
  
    $postsCount = $db->query("SELECT COUNT(*) AS posts_count FROM posts")->fetch()['posts_count'];
    $totalPages = ceil($postsCount / $postsPerPage);

    $stmt = $db->prepare("SELECT posts.*, users.name FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC LIMIT $postsPerPage OFFSET $offset");
    $stmt->execute();
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return [
      'posts' => $posts,
      'totalPages' => $totalPages
    ];
}


$createPosts = function($title, $text) use ($db){

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
            $loginUser = function($email, $password) use ($db){    
            
                if (!empty($email) && !empty($password)) {
                    
                    $query = $db->prepare("SELECT * FROM users WHERE email = :email");
                    $query->execute(['email' => $email]);
                    $user = $query->fetch(PDO::FETCH_ASSOC);
            
                   
                    if ($user && password_verify($password, $user['password'])) {
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['user_id'] = $user['id']; 
            
                        header("Location: ../pages/posts.php");
                        exit;
                    } else {
                        echo "❌ Email yoki parol noto‘g‘ri!";
                    }          
                } else {
                    echo "❌ Email va parol kiritilishi shart!";
                }
            };
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

function paginate($totalPages, $currentPage) {
  for($page = 1; $totalPages >= $page; $page++){
    if($currentPage == $page) {
      echo "<span style='margin-right:10px; color:red'> $page </span>";
    } else{
      echo "<a href='?page=$page' style='margin-right:10px''> $page </a>";
    }
  }
}
