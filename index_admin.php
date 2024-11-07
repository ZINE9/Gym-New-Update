<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="index.css">
    <title>Sign In / Sign Up</title>
</head>
<body>
    <div class="container">
        <img src="home.jpg" alt="Wedding" width="600" height="400" class="image">

        <div class="form-container">
            <h2>Admin Sign In</h2>
            <form action="signin.php" method="post" id="signinForm">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <select name="role" required>
                    <option value="admin">Admin</option>
                </select>
                <button type="submit">Sign In</button>
            </form>
        </div>
    </div>

    <script src="index.js"></script>
</body>
</html>
