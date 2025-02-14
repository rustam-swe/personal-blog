<?php
require __DIR__ . "/../db.php";

function registerUser($db, $name, $email, $password){
//    if(isset($name, $email, $password)){
//         $stmt=$db->prepare("INSERT INTO users(name, email, password)
//                            VALUES($name, $email, $password)");
//         $stmt->execute();
//         echo "Okay";
//    }

   if ($stmt->execute([$name, $email, $password])) {
        header("Location: posts.php"); 
        exit();
   } else {
        echo "Xatolik yuz berdi. Qaytadan urinib ko‘ring.";
} 
    
};

function loginUser($db, $email, $password){
    session_start();
    if (!isset($email, $password)) {
        echo "❌ Email va parol kiritilishi shart!";
        return;
    }

    try {
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
    }catch (PDOException $e) {
        echo "❌ Xatolik yuz berdi: " . $e->getMessage();
    }
}
