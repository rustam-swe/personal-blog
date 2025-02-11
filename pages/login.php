<?php
require "../db.php";
if(isset($_POST['userName'],$_POST['userEmail'],$_POST['userPass'])) {
    $userName = $_POST['userName'];
	$userEmail = $_POST['userEmail'];
	$userPass = $_POST['userPass'];
    $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute([
        'email' => $userEmail,
    ]);
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if($user) {
	    setcookie("user", $userName, time() + (86400 * 30), "/");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<form action="/pages/login.php" method="POST">
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
		<a href="/pages/register.php">Registratsiya</a>
	</form>    
</body>
</html>
