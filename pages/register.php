<?php
require '../controller/users_controller.php'; 
registerUser($db, $name, $email, $password)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">pages/posts.
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>

<form action="register_action.php" method="POST">
  <div class="container">
    <h1>Register</h1>
    <h2><a href="../index.php">🔙Home🏠</a><br></h2>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="name"><b>Name</b></label><br>
    <input type="text" placeholder="Enter Name" name="name" required><br><br>

    <label for="email"><b>Email</b></label><br>
    <input type="email" placeholder="Enter Email" name="email" required><br><br>

    <label for="password"><b>Password</b></label><br>
    <input type="password" placeholder="Enter Password" name="password" required><br><br>
    <hr>

    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p><br>
    <button type="submit" name="submit_btn" class="registerbtn">Register</button>
  </div>

  <div class="container signin">
    <p>Already have an account? <a href="login.php">Sign in</a>.</p>
  </div>
</form>

</body>
</html>
