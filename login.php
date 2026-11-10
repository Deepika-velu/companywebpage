<?php
session_start();
include 'db.php';

$error = "";

if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    if ($role == "admin") {
        $stmt = $conn->prepare(
            "SELECT * FROM admins WHERE email = ?"
        );
    } else {
        $stmt = $conn->prepare(
            "SELECT * FROM employees WHERE email = ?"
        );
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {

            session_regenerate_id(true);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $role;

            header("Location: dashboard.php");
            exit();

        } else {
            $error = "Invalid password!";
        }

    } else {
        $error = "User not found!";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Company Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<script src="script.js"></script>
<body>

<div class="form-box">
    <h2>Login</h2>

    <p><?php echo htmlspecialchars($error); ?></p>

    <form method="POST" onsubmit="return validateForm()">

        <input type="email" name="email"
               placeholder="Email Address" required>

        <input type="password" name="password"
               placeholder="Password" required>

        <select name="role" required>
            <option value="">Select Login Type</option>
            <option value="admin">Admin</option>
            <option value="employee">Employee</option>
        </select>

        <button type="submit" name="login">
            Login
        </button>

    </form>

    <p>New Employee? <a href="register.php">Register Here</a></p>

    <a href="index.php">Back to Home</a>
</div>

</body>
</html>