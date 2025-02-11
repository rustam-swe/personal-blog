<?php
require "../db.php";
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
	$user	 = $user->fetchAll(PDO::FETCH_ASSOC);
	if(!$user) {
		$stmt = $db->prepare("INSERT INTO users(name, email ,password) VALUES (:name, :email ,:password)");
		$stmt->bindParam(':name', $userName);
		$stmt->bindParam(':email', $userEmail);
		$stmt->bindParam(':password', $userPass);
		$stmt->execute();
		setcookie("user", $userName, time() + 3600, "/");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
	<form action="register.php" method="POST">
	<div class="mb-3">	
		<label for="userName" class="form-label">Username</label>
		<input type="text" class="form-control" name="userName" required placeholder="Username kiriting: " id="userName">
	</div>
	<div class="mb-3">	
		<label for="exampleInputEmail1" class="form-label">Email address</label>
		<input type="email" name="userEmail" class="form-control" required placeholder="email kiriting: " id="exampleInputEmail1">
	</div>
	<div class="mb-3">	
		<label for="password" class="form-label">Password</label>
		<input type="password" id="password" class="form-control" name="userPass" required placeholder="password kiriting: ">
	</div>
		<button type="submit" class="btn btn-primary">Send</button>
		<a href="/pages/login.php">Login</a>
	</form>    
</body>
</html>