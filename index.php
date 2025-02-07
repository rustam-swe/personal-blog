<?php
include "db.php";

$data = $db->query("SELECT * FROM blog ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);

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
        <link rel="stylesheet" href="./style.css">
        <title>Document</title>
    </head>
    <body>
    <header>
        <div class="container">
        <ul>
    		<li>
                	<a href="/">Home</a>
                	<a href="/admin.php">Admin</a>
		</li>
		<li>
		<?php
			if(!$user) {
			echo "<a href='login.php'>Login</a><a href='register.php'>Sign up</a>";
			} else {
			echo "<a href='/'>{$user}</a>";
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
                        </li>";
                    }
                } else {
                    echo "<h1>Please add a task.</h1>";
                }
            ?>
            </div>
        </ul>
    </div>
</body>
</html>
