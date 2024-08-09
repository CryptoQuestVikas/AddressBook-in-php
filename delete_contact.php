<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $contact_id = $_POST['contact_id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM contacts WHERE id = ? AND user_id = ?");
        $stmt->execute([$contact_id, $_SESSION['user_id']]);
        echo "Contact deleted successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Unauthorized access.";
}
?>
