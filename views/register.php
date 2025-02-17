<?php
session_start();

require_once '../controllers/post_controller.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    registerUser($name, $email, $password);
}
?>

<?php
    require_once __DIR__ . '/../base/header.php';
    ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Sign up</h2>

                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success" role="alert"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
                <?php endif; ?>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger" role="alert"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
                <?php endif; ?>

                <form method="POST" class="bg-light p-4 rounded shadow-sm">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="name" placeholder="Ismingiz" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Parol" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Sign up</button>
                </form>

                <p class="mt-3 text-center">Already have an account? <a href="login.php">Login</a></p>
            </div>
        </div>
    </div>

    <?php
    require_once __DIR__ . '/../base/footer.php';
    ?>

