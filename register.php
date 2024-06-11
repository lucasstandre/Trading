<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute(['username' => $username, 'password' => $password]);
        echo "Registration successful!";
    } catch (PDOException $e) {
        if ($e->errorInfo[1] == 1062) {
            echo "Username already taken!";
        } else {
            echo "An error occurred: " . $e->getMessage();
        }
    }
}
?>
