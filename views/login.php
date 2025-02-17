<?php
session_start();
include '../controllers/post_controller.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    loginUser($email, $password);
}
?>

<?php
require_once __DIR__ . '/../base/header.php';
?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center">Login</h2>

                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success" role="alert"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
                <?php endif; ?>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger" role="alert"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
                <?php endif; ?>

                <form action="" method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email." required>
                    </div>

                    <div class="form-group">
                        <label for="password">Parol</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Login</button>
                </form>

                <a href="register.php" class="register-link">Sign up</a>
            </div>
        </div>
    </div>
<?php
    require_once __DIR__ . '/../base/footer.php';
?>