<?php
include "db.php";
$users = $db->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['userName'],$_POST['userEmail'],$_POST['userPass'])) {
	$userName = $_POST['userName'];
	$userEmail = $_POST['userEmail'];
	$userPass = $_POST['userPass'];
	$user = $db->prepare("SELECT * FROM users WHERE name = :name AND email = :email AND password = :password");
	$user->execute([
        'name' => $userName,
        'email' => $userEmail,
        'password' => $userPass
    ]);
	$user = $user->fetchAll(PDO::FETCH_ASSOC);
	if(!$user) {
		$stmt = $db->prepare("INSERT INTO users(name, email ,password) VALUES (:name, :email ,:password)");
		$stmt->bindParam(':name', $userName);
		$stmt->bindParam(':email', $userEmail);
		$stmt->bindParam(':password', $userPass);
		$stmt->execute();
		setcookie("user", $userName, time() + (86400 * 30));
		header("Location: /");
	}else {
		echo "Siz avval registratsiyadan o'tgansiz iltimos <a href='register.php'>shu sahifaga o'ting</a>";
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
	<form action="login.php" method="POST">
		<input type="text" name="userName" required placeholder="Username kiriting: ">
		<input type="email" name="userEmail" required placeholder="email kiriting: ">
		<input type="password" name="userPass" required placeholder="password kiriting: ">
		<button type="submit">Send</button>
	</form>    
</body>
</html>
