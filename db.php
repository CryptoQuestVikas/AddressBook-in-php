<?php
$host = 'localhost';
$dbname = 'address_book';
$user = 'root';  // Change if necessary
$password = '';  // Change if necessary

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
