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
$table = isset($_GET['table']) && $_GET['table'] === 'done_vip' ? 'done_vip' : 'vip';

if ($userId > 0) {
    $sql = "DELETE FROM $table WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $userId);

    if ($stmt->execute()) {
        header('Location: view_vip.php?table=' . $table . '&message=User deleted successfully');
        exit();
    } else {
        echo "Error deleting user: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Invalid user ID.";
}

$conn->close();
?>
