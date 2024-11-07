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
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $weight = $_POST['weight'];
    $weight_unit = $_POST['weight_unit'];
    $gender = $_POST['gender'];
    $select_option1 = $_POST['select_option1'];
    $select_option2 = $_POST['select_option2'];
    $select_option3 = $_POST['select_option3'];
    $date = $_POST['date'];
    $payment_status = $_POST['payment_status'];

    $monthsToAdd = intval($select_option3);
    $startDate = new DateTime($date);
    $startDate->modify("+$monthsToAdd month");
    $endDate = $startDate->format('Y-m-d');

    $targetTable = $payment_status === 'done' ? 'done_vip' : 'vip';

    $stmt = $pdo->prepare("INSERT INTO $targetTable (name, phone, weight, weight_unit, gender, select_option1, select_option2, select_option3, start, end) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $phone, $weight, $weight_unit, $gender, $select_option1, $select_option2, $select_option3, $date, $endDate]);

    echo "VIP user information added successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage VIP Users</title>
    <link rel="stylesheet" href="design.css">
</head>
<body>
    <header>
        <h1>Manage VIP Users</h1>
        <nav>
            <a href="admin_dashboard.php">Back to Dashboard</a>
        </nav>
    </header>

    <main>
        <form method="POST" action="vip.php" class="form-container">
            <h2>Add VIP User</h2><br>
            <div class="form-column">
                <div>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div>
                    <label for="phone">Phone:</label>
                    <input type="text" id="phone" name="phone" required>
                </div>
                <div>
                    <label for="weight">Weight:</label>
                    <input type="number" id="weight" name="weight" value="0" required>
                    <select id="weight_unit" name="weight_unit">
                        <option value="lb">lb</option>
                        <option value="kg">kg</option>
                    </select>
                </div>
                <div class="form-item-full">
                    <label>Gender:</label>
                    <div class="radio-group">
                        <input type="radio" id="male" name="gender" value="male" required>
                        <label for="male">Male</label>
                        <input type="radio" id="female" name="gender" value="female">
                        <label for="female">Female</label>
                    </div>
                </div>
            </div>

            <div class="form-column">
                <div>
                    <label for="select_option1">Select Trainer</label>
                    <select id="select_option1" name="select_option1" required>
                        <option value="Trainer 1">Trainer 1</option>
                        <option value="Trainer 2">Trainer 2</option>
                        <option value="Trainer 3">Trainer 3</option>
                        <option value="Trainer 4">Trainer 4</option>
                        <option value="Trainer 5">Trainer 5</option>
                    </select>
                </div>
                <div>
                    <label for="select_option2">Played before?</label>
                    <select id="select_option2" name="select_option2" required>
                        <option value="Under 3 Months">Under 3 Months</option>
                        <option value="Between 3 and 6 Months">Between 3 and 6 Months</option>
                        <option value="Above 6 Months">Above 6 Months</option>
                    </select>
                </div>
                <div>
                    <label for="select_option3">How many months does user play?</label>
                    <select id="select_option3" name="select_option3" required>
                        <option value="1">1 Month</option>
                        <option value="2">2 Months</option>
                        <option value="3">3 Months</option>
                        <option value="4">4 Months</option>
                        <option value="5">5 Months</option>
                    </select>
                </div>
                <div>
                    <label for="date">Start Date:</label>
                    <input type="date" id="date" name="date" required>
                </div>
                <div class="form-item-full">
                    <label>Payment Status:</label>
                    <div class="radio-group">
                        <input type="radio" id="paid" name="payment_status" value="done" required>
                        <label for="paid">Done</label>
                        <input type="radio" id="not_paid" name="payment_status" value="not_done">
                        <label for="not_paid">Not Done</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="form-item-full">Add VIP User</button>
        </form>
    </main>
</body>
</html>