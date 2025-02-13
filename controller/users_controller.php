<?php
require "../db.php";

function registerUser($db, $name, $email, $password){
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_btn'])) {
        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Parolni xavfsiz saqlash
    
        // Foydalanuvchini bazaga qo‘shish
        $stmt = $db->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        if ($stmt->execute([$name, $email, $password])) {
            header("Location: register_action.php");
            exit();
        } else {
            echo "Xatolik yuz berdi.";
        }
    }

};

function loginUser($db, $email, $password){
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id']; 
            $_SESSION['user_name'] = $user['name'];
            header("Location: posts.php");
             exit;
        } else {
            echo "❌ Login yoki parol noto'g'ri!";
        }
    }
}
