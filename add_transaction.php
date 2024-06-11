<?php
require 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type = $_POST['type'];
    $amount = $_POST['amount'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO transactions (user_id, type, amount) VALUES (:user_id, :type, :amount)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute(['user_id' => $user_id, 'type' => $type, 'amount' => $amount]);
        echo "Transaction added successfully!";
    } catch (PDOException $e) {
        echo "An error occurred: " . $e->getMessage();
    }
}
?>
