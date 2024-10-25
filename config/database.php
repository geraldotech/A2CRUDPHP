<?php

// Database configuration
$DB_HOST = 'sh4ob67ph9l80v61.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
$DB_NAME = 'qbbzzx6kg3koxx7y';
$DB_USER = 'sttyw86jbah9ghmk';
$DB_PASS = 'adi9h23cf399fk6s';

try {
    $conn = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASS);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}
