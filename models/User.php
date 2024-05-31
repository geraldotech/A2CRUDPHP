<?php

class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

   // Function to handle user login
    public function login($username, $password) {
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        } else {
            return false;
        }
    }


    // Function to handle user registration
    public function register($username, $password) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $hashed_password);

        return $stmt->execute();
    }
}

?>
