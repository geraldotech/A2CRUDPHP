<?php
require_once('../config/database.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    // usar o bcrypt for hashing melhor abordagem
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);

    try {
        $stmt->execute();
        echo "Registration successful!";
    } catch(PDOException $e) {
        // Check if the error code is for duplicate entry
        if ($e->getCode() == '23000' && strpos($e->getMessage(), 'Duplicate entry') !== false) {
            echo "usuário já existe, escolha um nome diferente por favor";
        } else {
            // Other database error, display generic error message
            echo "Error: An error occurred while processing your request.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de usuário
</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mx-auto" style="max-width: 50%;">
        <h1 class="mb-4">Cadastro de usuário</h1>
        <form action="register.php" method="post">
            <div class="form-group">
                <label for="username">Usuário</label>
                <input type="text" class="form-control form-control-sm" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" class="form-control form-control-sm" id="password" name="password" required>
            </div>
            <button type="submit" class="mt-3 btn btn-primary btn-sm">Registrar</button>
        </form>
    </div>
</body>
</html>
