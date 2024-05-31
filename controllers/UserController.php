<?php

require_once('../models/User.php');

class UserController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new User($db);
    }
    // Function to handle user login
    public function login($username, $password) {
        $user = $this->userModel->login($username, $password);
        if ($user) {
            session_start();
            $_SESSION['username'] = $user['username'];
            header('Location: ../views/dashboard.php');
            echo 'logado';
            exit();
        } else {
            header('Location: ../public/index.php?error=1');
            exit();
        }
    }

    // Function to handle user registration
    public function register($username, $password) {
        if ($this->userModel->register($username, $password)) {
            header('Location: ../public/index.php?registration_success=1');
            exit();
        } else {
            header('Location: ../public/register.php?error=1');
            exit();
        }
    }
}
?>
