<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit();
}

$host = 'localhost';
$db = 'gym_base';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$userId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$table = isset($_GET['table']) ? $_GET['table'] : 'client';

$allowedTables = ['client', 'done_normal'];

if (!in_array($table, $allowedTables)) {
    die('Invalid table specified.');
}

if ($userId > 0) {
    $sql = "DELETE FROM `$table` WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('i', $userId);
        if ($stmt->execute()) {
            header("Location: view_normal.php?table=$table&message=User deleted successfully");
            exit();
        } else {
            echo "Error deleting user: " . htmlspecialchars($stmt->error);
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . htmlspecialchars($conn->error);
    }
} else {
    echo "Invalid user ID.";
}

$conn->close();
?>
