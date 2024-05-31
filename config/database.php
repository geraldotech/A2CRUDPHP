<?php

// Database configuration
$DB_HOST = 'localhost';
$DB_NAME = 'revendafilial';
$DB_USER = 'root';
$DB_PASS = '';

try {
    $conn = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASS);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}
