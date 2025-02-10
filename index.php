<?php
include "db.php";

$data = $db->query("SELECT * FROM blog JOIN users on blog.user_id = users.id WHERE status = 'published'")->fetchAll(PDO::FETCH_ASSOC);

if(isset($_COOKIE['user'])) {
	$user = $_COOKIE['user'];
}else {
    header("Location: /login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="./style.css">
        <title>Document</title>
    </head>
    <body>
    <header>
        <div class="container">
        <ul class="header__list">
    		<li>
            	<a href="/">Home</a>
		    </li>
		<li>
		<?php
			if(!$user) {
			echo "<a href='login.php'>Login</a><a href='register.php'>Sign up</a>";
			} else {
			echo "<a href='/user.php'>{$user}</a>";
			}
		?>
		</li>
        </ul>
        </div>
    </header>
        <div class="wrapper">
            <div class="container">
            <ul class="list">
            <?php
                if(count($data) > 0) {
                    foreach($data as $item) {
                        echo "
                        <li class='item'>
                        <h2>{$item['title']}</h2>
                        <p>{$item['text']}</p>
                        <div class='wrap'>
			            <p>{$item['created_at']}</p>
			            <span>{$item['updated_at']}</span>
                        <form action='single.php' method='post'>
                            <input type='hidden' name='id' value='{$item['id']}'>
                            <button class='info'>Batafsil</button>
                        </form>
                        </div>
                        <p>Author: <b>{$item['name']}</b></p>
                        </li>";
                    }
                } else {
                    echo "<h1 style='text-align:center;'>There is no news announced at this time..</h1>";
                }
            ?>
            </div>
        </ul>
    </div>
</body>
</html>
