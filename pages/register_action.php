<?php
require '../db.php'; // MySQL ulanish fayli

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Parolni shifrlash

    // Foydalanuvchini bazaga qo‘shish
    $stmt = $db->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    
    if ($stmt->execute([$name, $email, $password])) {
        header("Location: posts.php"); 
        exit();
    } else {
        echo "Xatolik yuz berdi. Qaytadan urinib ko‘ring.";
    }
}
?>
