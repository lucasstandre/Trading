<?php
$host = 'localhost';
$db = 'finance_tracker';
$user = 'user1'; // Change this to your database user
$pass = '819Lucas'; // Change this to your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected to the database successfully!";
} catch (PDOException $e) {
    die("Could not connect to the database $db :" . $e->getMessage());
}
?>
