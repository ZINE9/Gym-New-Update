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

$table = isset($_GET['table']) && $_GET['table'] === 'done_vip' ? 'done_vip' : 'vip';

$search = '';
$trainerFilter = '';
$sql = "SELECT * FROM `$table`";

if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
    $search = $conn->real_escape_string(trim($_GET['search']));
    $sql .= " WHERE (name LIKE '%$search%' 
              OR phone LIKE '%$search%' 
              OR weight LIKE '%$search%')";
}

if (isset($_GET['trainer']) && !empty(trim($_GET['trainer']))) {
    $trainerFilter = $conn->real_escape_string($_GET['trainer']);
    $sql .= $search ? " AND select_option1 = '$trainerFilter'" : " WHERE select_option1 = '$trainerFilter'";
}

$sql .= " ORDER BY id ASC";

$result = $conn->query($sql);
$userCount = $result ? $result->num_rows : 0;

$message = isset($_GET['message']) ? htmlspecialchars($_GET['message']) : '';

if (isset($_GET['done_id']) && $table === 'vip') {
    $done_id = intval($_GET['done_id']);

    $moveUserQuery = "INSERT INTO done_vip (name, phone, weight, weight_unit, select_option1, select_option2, select_option3, start, end)
                      SELECT name, phone, weight, weight_unit, select_option1, select_option2, select_option3, start, end FROM vip WHERE id = $done_id";
    
    if ($conn->query($moveUserQuery) === TRUE) {
        $deleteUserQuery = "DELETE FROM vip WHERE id = $done_id";
        $conn->query($deleteUserQuery);
        header("Location: view_vip.php?table=vip&message=User moved to completed payment");
        exit();
    } else {
        $message = "Error moving user: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View VIP Users</title>
    <link rel="stylesheet" href="view_users.css">
</head>
<body>
    <div class="container">
        <h1><?php echo $table === 'vip' ? 'VIP Users' : 'Completed Payment VIP Users'; ?> Registration Reports</h1>
        
        <?php if ($message): ?>
            <p class="success-message"><?php echo $message; ?></p>
        <?php endif; ?>
        
        <p>Total <?php echo $table === 'vip' ? 'VIP' : 'Completed Payment VIP'; ?> Users: <?php echo $userCount; ?></p>
        
        <form method="get" class="toggle-form">
            <input type="hidden" name="table" value="<?php echo $table === 'vip' ? 'done_vip' : 'vip'; ?>">
            <button type="submit">Switch to <?php echo $table === 'vip' ? 'Completed Payment VIP Users' : 'VIP Users'; ?></button>
        </form>

        <form method="get" class="search-form">
            <input type="hidden" name="table" value="<?php echo $table; ?>">
            <input type="text" name="search" placeholder="Search by username, phone, etc." value="<?php echo htmlspecialchars($search); ?>">
            
            <label for="trainer">Select Trainer:</label>
            <select name="trainer" id="trainer">
                <option value="">All Trainers</option>
                <option value="Trainer 1" <?php echo $trainerFilter === 'Trainer 1' ? 'selected' : ''; ?>>Trainer 1</option>
                <option value="Trainer 2" <?php echo $trainerFilter === 'Trainer 2' ? 'selected' : ''; ?>>Trainer 2</option>
                <option value="Trainer 3" <?php echo $trainerFilter === 'Trainer 3' ? 'selected' : ''; ?>>Trainer 3</option>
                <option value="Trainer 4" <?php echo $trainerFilter === 'Trainer 4' ? 'selected' : ''; ?>>Trainer 4</option>
                <option value="Trainer 5" <?php echo $trainerFilter === 'Trainer 5' ? 'selected' : ''; ?>>Trainer 5</option>
            </select>
            
            <button type="submit">Search</button>
        </form>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Phone</th>
                    <th>Weight</th>
                    <th>Trainer</th>
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
                            <td><?php echo htmlspecialchars($row['select_option1']); ?></td>
                            <td><?php echo htmlspecialchars($row['select_option3']); ?></td>
                            <td><?php echo htmlspecialchars($row['start']); ?></td>
                            <td><?php echo htmlspecialchars($row['end']); ?></td>
                            <td>
                                <a href="edit_vip.php?id=<?php echo $row['id']; ?>&table=<?php echo $table; ?>" class="btn edit-btn">Edit</a>
                                <a href="delete_vip.php?id=<?php echo $row['id']; ?>&table=<?php echo $table; ?>" class="btn delete-btn" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                                <?php if ($table === 'vip'): ?>
                                    <a href="?done_id=<?php echo $row['id']; ?>&table=<?php echo $table; ?>" class="btn done-btn" onclick="return confirm('Mark this user as completed payment?');">Done</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9">No results found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        
        <p><a href="admin_dashboard.php" class="back-link">Back to Dashboard</a></p>
    </div>
</body>
</html>

<?php $conn->close(); ?>
