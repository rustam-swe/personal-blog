<?php
include "db.php";
if(isset($_POST['userName'],$_POST['userEmail'],$_POST['userPass'])) {
    $userName = $_POST['userName'];
	$userEmail = $_POST['userEmail'];
	$userPass = $_POST['userPass'];
    $stmt = $db->prepare("SELECT * FROM users WHERE name = :name AND email = :email AND password = :password");
    $stmt->execute([
        'name' => $userName,
        'email' => $userEmail,
        'password' => $userPass
    ]);
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if($user) {
	    setcookie("user", $userName, time() + (86400 * 30));
        header("Location: /");
    }else {
        echo "username yoki email yoki password noto'g'ri";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
	<form action="register.php" method="POST">
		<input type="text" name="userName" required placeholder="Username kiriting: ">
		<input type="email" name="userEmail" required placeholder="email kiriting: ">
		<input type="password" name="userPass" required placeholder="password kiriting: ">
		<button type="submit">Send</button>
	</form>    
</body>
</html>
