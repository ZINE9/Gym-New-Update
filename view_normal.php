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

$table = isset($_GET['table']) && $_GET['table'] === 'done_normal' ? 'done_normal' : 'client';

$search = '';
$sql = "SELECT * FROM `$table`";

if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
    $search = $conn->real_escape_string(trim($_GET['search']));
    $sql .= " WHERE name LIKE '%$search%' 
              OR phone LIKE '%$search%' 
              OR weight LIKE '%$search%'";
}

$sql .= " ORDER BY id ASC";

$result = $conn->query($sql);
$userCount = $result ? $result->num_rows : 0;

$message = isset($_GET['message']) ? htmlspecialchars($_GET['message']) : '';

if (isset($_GET['done_id']) && $table === 'client') {
    $done_id = intval($_GET['done_id']);

    $selectSql = "SELECT * FROM `client` WHERE id = ?";
    $stmt = $conn->prepare($selectSql);
    $stmt->bind_param("i", $done_id);
    $stmt->execute();
    $userData = $stmt->get_result()->fetch_assoc();

    if ($userData) {
        $insertSql = "INSERT INTO `done_normal` (name, phone, weight, weight_unit, select_option2, select_option3, start, end)
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertSql);
        $stmt->bind_param(
            "ssssssss",
            $userData['name'],
            $userData['phone'],
            $userData['weight'],
            $userData['weight_unit'],
            $userData['select_option2'],
            $userData['select_option3'],
            $userData['start'],
            $userData['end']
        );

        if ($stmt->execute()) {
            $deleteSql = "DELETE FROM `client` WHERE id = ?";
            $stmt = $conn->prepare($deleteSql);
            $stmt->bind_param("i", $done_id);
            $stmt->execute();

            header("Location: view_normal.php?table=client&message=User moved to Completed Payment successfully");
            exit();
        } else {
            $message = "Error moving user to Completed Payment.";
        }
    } else {
        $message = "User not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
    <link rel="stylesheet" href="view_users.css">
</head>
<body>
    <div class="container">
        <h1><?php echo $table === 'client' ? 'Normal Users' : 'Completed Payment Users'; ?> Registration Reports</h1>
        
        <?php if ($message): ?>
            <p class="success-message"><?php echo $message; ?></p>
        <?php endif; ?>
        
        <p>Total Users: <?php echo $userCount; ?></p>
        
        <form method="get" class="toggle-form">
            <input type="hidden" name="table" value="<?php echo $table === 'client' ? 'done_normal' : 'client'; ?>">
            <button type="submit">
                Switch to <?php echo $table === 'client' ? 'Completed Payment Users' : 'Normal Users'; ?>
            </button>
        </form>

        <form method="get" class="search-form">
            <input type="hidden" name="table" value="<?php echo $table; ?>">
            <input type="text" name="search" placeholder="Search by name, phone, etc." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Search</button>
        </form>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Phone</th>
                    <th>Weight</th>
                    <th>Months</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $counter = 1;
                if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $counter++; ?></td> 
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['phone']); ?></td>
                            <td><?php echo htmlspecialchars($row['weight']) . ' ' . htmlspecialchars($row['weight_unit']); ?></td>
                            <td><?php echo htmlspecialchars($row['select_option3']); ?></td>
                            <input type="hidden" value="<?php $row['select_option2']; ?>">
                            <td><?php echo htmlspecialchars($row['start']); ?></td>
                            <td><?php echo htmlspecialchars($row['end']); ?></td>
                            <td>
                                <a href="edit_normal.php?id=<?php echo $row['id']; ?>&table=<?php echo $table; ?>" class="btn edit-btn">Edit</a>
                                <a href="delete_normal.php?id=<?php echo $row['id']; ?>&table=<?php echo $table; ?>" class="btn delete-btn" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                                <?php if ($table === 'client'): ?>
                                    <a href="view_normal.php?table=client&done_id=<?php echo $row['id']; ?>" class="btn done-btn" onclick="return confirm('Are you sure you want to mark this user as done?');">Done</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8">No results found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        
        <p><a href="admin_dashboard.php" class="back-link">Back to Dashboard</a></p>
    </div>
</body>
</html>

<?php $conn->close(); ?>
