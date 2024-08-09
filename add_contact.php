<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    try {
        $stmt = $pdo->prepare("INSERT INTO contacts (user_id, name, phone, email) VALUES (?, ?, ?, ?)");
        $stmt->execute([$user_id, $name, $phone, $email]);
        echo "Contact added successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Unauthorized access.";
}
?>
