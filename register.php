<?php
include 'db.php';

$message = "";

if (isset($_POST['register'])) {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
    );
    $department = trim($_POST['department']);
    $phone = trim($_POST['phone']);

    $stmt = $conn->prepare(
        "INSERT INTO employees
        (name, email, password, department, phone)
        VALUES (?, ?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "sssss",
        $name,
        $email,
        $password,
        $department,
        $phone
    );

    if ($stmt->execute()) {
        $message = "Registration successful!";
    } else {
        $message = "Registration failed. Email may already exist.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<script src="script.js"></script>
<body>

<div class="form-box">
    <h2>Employee Registration</h2>

    <p><?php echo htmlspecialchars($message); ?></p>

    <form method="POST" onsubmit="return validateForm()">
        <input type="text" name="name"
               placeholder="Employee Name" required>

        <input type="email" name="email"
               placeholder="Email Address" required>

        <input type="password" name="password"
               placeholder="Password" required>

        <input type="text" name="department"
               placeholder="Department" required>

        <input type="text" name="phone"
               placeholder="Phone Number" required>

        <button type="submit" name="register">
            Register
        </button>
    </form>

    <p>Already registered? <a href="login.php">Login</a></p>
    <a href="index.php">Back to Home</a>
</div>

</body>
</html>