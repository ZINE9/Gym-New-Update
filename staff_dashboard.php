<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'staff') {
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

$searchTermNormal = '';
$searchTermVip = '';
$selectedTrainer = '';

if (isset($_POST['search_normal'])) {
    $searchTermNormal = $conn->real_escape_string($_POST['search_normal']);
    $sqlNormal = "SELECT * FROM client WHERE name LIKE '%$searchTermNormal%' OR phone LIKE '%$searchTermNormal%'
                  UNION
                  SELECT * FROM done_normal WHERE name LIKE '%$searchTermNormal%' OR phone LIKE '%$searchTermNormal%'";
} else {
    $sqlNormal = "SELECT * FROM client
                  UNION
                  SELECT * FROM done_normal";
}
$resultNormal = $conn->query($sqlNormal);

if (isset($_POST['search_vip']) || isset($_POST['trainer'])) {
    $searchTermVip = isset($_POST['search_vip']) ? $conn->real_escape_string($_POST['search_vip']) : '';
    $selectedTrainer = isset($_POST['trainer']) ? $conn->real_escape_string($_POST['trainer']) : '';

    $sqlVip = "SELECT * FROM vip WHERE (name LIKE '%$searchTermVip%' OR phone LIKE '%$searchTermVip%')"
            . ($selectedTrainer ? " AND select_option1 = '$selectedTrainer'" : "")
            . " UNION "
            . "SELECT * FROM done_vip WHERE (name LIKE '%$searchTermVip%' OR phone LIKE '%$searchTermVip%')"
            . ($selectedTrainer ? " AND select_option1 = '$selectedTrainer'" : "");
} else {
    $sqlVip = "SELECT * FROM vip UNION SELECT * FROM done_vip";
}
$resultVip = $conn->query($sqlVip);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <link rel="stylesheet" href="staff_dashboard.css">
</head>
<body>
    <div class="container">
        <h1>Staff Dashboard</h1>
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h2>

        <div class="navigation-links">
            <a href="staff_dashboard.php?section=normal">Normal Users</a>
            <a href="staff_dashboard.php?section=vip">VIP Users</a>
        </div>

        <?php if (isset($_GET['section']) && $_GET['section'] == 'normal' || !isset($_GET['section'])): ?>
            <div class="section" id="normal-section">
                <form method="POST" action="">
                    <input type="text" name="search_normal" placeholder="Search normal users by name or phone" value="<?php echo htmlspecialchars($searchTermNormal); ?>">
                    <button type="submit">Search</button>
                </form>
                <h3>Normal Users</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Phone</th>
                            <th>Weight</th>
                            <th>Gender</th>
                            <th>Gym Exp</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($resultNormal->num_rows > 0): ?>
                            <?php while ($user = $resultNormal->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($user['name']); ?></td>
                                    <td><?php echo htmlspecialchars($user['phone']); ?></td>
                                    <td><?php echo htmlspecialchars($user['weight']) . ' ' . htmlspecialchars($user['weight_unit']); ?></td>
                                    <td><?php echo htmlspecialchars($user['gender']); ?></td>
                                    <td><?php echo htmlspecialchars($user['select_option2']); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">No normal users found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['section']) && $_GET['section'] == 'vip'): ?>
            <div class="section" id="vip-section">
                <form method="POST" action="">
                    <input type="text" name="search_vip" placeholder="Search VIP users by name or phone" value="<?php echo htmlspecialchars($searchTermVip); ?>">
                    
                    <label for="trainer">Select Trainer:</label>
                    <select name="trainer" id="trainer">
                        <option value="">All Trainers</option>
                        <option value="Trainer 1" <?php if ($selectedTrainer == 'Trainer 1') echo 'selected'; ?>>Trainer 1</option>
                        <option value="Trainer 2" <?php if ($selectedTrainer == 'Trainer 2') echo 'selected'; ?>>Trainer 2</option>
                        <option value="Trainer 3" <?php if ($selectedTrainer == 'Trainer 3') echo 'selected'; ?>>Trainer 3</option>
                        <option value="Trainer 4" <?php if ($selectedTrainer == 'Trainer 4') echo 'selected'; ?>>Trainer 4</option>
                        <option value="Trainer 5" <?php if ($selectedTrainer == 'Trainer 5') echo 'selected'; ?>>Trainer 5</option>
                    </select>
                    
                    <button type="submit">Search</button>
                </form>
                <h3>VIP Users</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Phone</th>
                            <th>Weight</th>
                            <th>Gender</th>
                            <th>Trainer</th>
                            <th>Gym Exp</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($resultVip->num_rows > 0): ?>
                            <?php while ($user = $resultVip->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($user['name']); ?></td>
                                    <td><?php echo htmlspecialchars($user['phone']); ?></td>
                                    <td><?php echo htmlspecialchars($user['weight']) . ' ' . htmlspecialchars($user['weight_unit']); ?></td>
                                    <td><?php echo htmlspecialchars($user['gender']); ?></td>
                                    <td><?php echo htmlspecialchars($user['select_option1']); ?></td>
                                    <td><?php echo htmlspecialchars($user['select_option2']); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">No VIP users found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <p><a href="./index.php" class="logout-link">Logout</a></p>
    </div>
</body>
</html>

<?php
$conn->close();
?>
