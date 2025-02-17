<?php
//session_start();
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
