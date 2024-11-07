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

if ($userId) {
    $sql = "SELECT * FROM `$table` WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found.";
        exit();
    }
} else {
    echo "Invalid user ID.";
    exit();
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
    $start_date = $_POST['date'];
    $number_of_months = intval($_POST['select_option3']); 

    $startDateObj = new DateTime($start_date);
    $endDateObj = clone $startDateObj;  
    $endDateObj->modify("+$number_of_months month");
    $end_date = $endDateObj->format('Y-m-d');  

    $updateSql = "UPDATE `$table` SET name = ?, phone = ?, weight = ?, weight_unit = ?, gender = ?, select_option1 = ?, select_option2 = ?, select_option3 = ?, start = ?, end = ? WHERE id = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param('ssssssssssi', $name, $phone, $weight, $weight_unit, $gender, $select_option1, $select_option2, $select_option3, $start_date, $end_date, $userId);

    if ($stmt->execute()) {
        header("Location: view_vip.php?table=$table&message=User updated successfully");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit VIP User</title>
    <link rel="stylesheet" href="view_users.css">
</head>
<body>
    <form method="POST" class="form-container">
        <h2>Edit VIP User</h2><br>
        <div class="form-column">
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            </div>
            <div>
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
            </div>
            <div>
                <label for="weight">Weight:</label>
                <input type="number" id="weight" name="weight" value="<?php echo htmlspecialchars($user['weight']); ?>" required>
                <select id="weight_unit" name="weight_unit">
                    <option value="lb" <?php echo $user['weight_unit'] === 'lb' ? 'selected' : ''; ?>>lb</option>
                    <option value="kg" <?php echo $user['weight_unit'] === 'kg' ? 'selected' : ''; ?>>kg</option>
                </select>
            </div>

            <div class="form-item-full">
                <label>Gender:</label>
                <div class="radio-group">
                    <input type="radio" id="male" name="gender" value="male" <?php echo $user['gender'] === 'male' ? 'checked' : ''; ?> required>
                    <label for="male">Male</label>
                    <input type="radio" id="female" name="gender" value="female" <?php echo $user['gender'] === 'female' ? 'checked' : ''; ?>>
                    <label for="female">Female</label>
                </div>
            </div>
        </div>

        <div class="form-column">
            <div>
                <label for="select_option1">Select Trainer:</label>
                <select id="select_option1" name="select_option1" required>
                    <option value="Trainer 1" <?php echo $user['select_option1'] === 'Trainer 1' ? 'selected' : ''; ?>>Trainer 1</option>
                    <option value="Trainer 2" <?php echo $user['select_option1'] === 'Trainer 2' ? 'selected' : ''; ?>>Trainer 2</option>
                    <option value="Trainer 3" <?php echo $user['select_option1'] === 'Trainer 3' ? 'selected' : ''; ?>>Trainer 3</option>
                    <option value="Trainer 4" <?php echo $user['select_option1'] === 'Trainer 4' ? 'selected' : ''; ?>>Trainer 4</option>
                    <option value="Trainer 5" <?php echo $user['select_option1'] === 'Trainer 5' ? 'selected' : ''; ?>>Trainer 5</option>
                </select>
            </div>
            <div>
                <label for="select_option2">Played before?</label>
                <select id="select_option2" name="select_option2" required>
                    <option value="Under 3 Months" <?php echo $user['select_option2'] === 'Under 3 Months' ? 'selected' : ''; ?>>Under 3 Months</option>
                    <option value="Between 3 and 6 Months" <?php echo $user['select_option2'] === 'Between 3 and 6 Months' ? 'selected' : ''; ?>>Between 3 and 6 Months</option>
                    <option value="Above 6 Months" <?php echo $user['select_option2'] === 'Above 6 Months' ? 'selected' : ''; ?>>Above 6 Months</option>
                </select>
            </div>
            <div>
                <label for="select_option3">How many months has the user played?</label>
                <select id="select_option3" name="select_option3" required>
                    <option value="1" <?php echo $user['select_option3'] === '1' ? 'selected' : ''; ?>>1 Month</option>
                    <option value="2" <?php echo $user['select_option3'] === '2' ? 'selected' : ''; ?>>2 Months</option>
                    <option value="3" <?php echo $user['select_option3'] === '3' ? 'selected' : ''; ?>>3 Months</option>
                    <option value="4" <?php echo $user['select_option3'] === '4' ? 'selected' : ''; ?>>4 Months</option>
                    <option value="5" <?php echo $user['select_option3'] === '5' ? 'selected' : ''; ?>>5 Months</option>
                </select>
            </div>
            <div>
                <label for="date">Start Date:</label>
                <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($user['start']); ?>" required>
            </div>
        </div>

        <button type="submit" class="form-item-full">Update User</button>
        <a href="view_vip.php?table=<?php echo $table; ?>" class="back-link">Cancel</a>
    </form>
</body>
</html>
