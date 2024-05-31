<?php
session_start();

// Include database connection and user controller
require_once('../config/database.php');
require_once('../controllers/UserController.php');
require_once('../controllers/CarController.php');

// Initialize user controller
$userController = new UserController($conn);

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if username and password are set
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password']; 
       
        // Call the login function of UserController
        $userController->login($username, $password);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/main.css">
    <style>
body{
  /*   background-image: url("https://wallpapers.com/images/featured/4k-car-g6a4f0e15hkua5oa.jpg"); */
  background: #aaaa;
  background-position: center;
  color: #000;
}
.loginpage .form{
    max-width: 450px;
    margin: 0 auto;
    padding-block: .7rem;
}
        </style>
</head>
<body>
    <div class="wrapper container loginpage">
        <div class="row mt-5">
            <div class="form col-md-6 offset-md-3">
                <h2>Login</h2>
                <?php
                // Display error message if login fails
                if (isset($_GET['error']) && $_GET['error'] == 1) {
                    echo '<div class="alert alert-danger" role="alert">Invalid username or password!</div>';
                }
                ?>
                <form action="index.php" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Usuário:</label>
                        <input type="text" class="form-control" id="username" name="username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Senha:</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
    <?php include('../views/footer.php') ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
