<?php
session_start();
require 'db.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM contacts WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($contacts as $contact) {
            echo "<li>
                <strong>Name:</strong> " . htmlspecialchars($contact['name']) . "<br>
                <strong>Phone:</strong> " . htmlspecialchars($contact['phone']) . "<br>
                <strong>Email:</strong> " . htmlspecialchars($contact['email']) . "<br>
                <button onclick='deleteContact(" . $contact['id'] . ")'>Delete</button>
            </li>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Unauthorized access.";
}
?>
