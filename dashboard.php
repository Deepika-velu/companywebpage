<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

function e($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

$role = $_SESSION['role'];

if ($role == "admin") {

    $result = $conn->query(
        "SELECT id, name, email, department, phone FROM employees"
    );

    $heading = "All Employee Details";

} else {

    $result = $conn->query(
        "SELECT id, name, email, department FROM admins"
    );

    $heading = "All Admin Details";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Company Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <h2>ABC Company</h2>
    <a href="logout.php">Logout</a>
</nav>

<div class="dashboard">

    <h1>Welcome, <?php echo e($_SESSION['name']); ?>!</h1>

    <h2><?php echo $heading; ?></h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Department</th>

            <?php if ($role == "admin") { ?>
                <th>Phone</th>
            <?php } ?>
        </tr>

        <?php while ($row = $result->fetch_assoc()) { ?>

        <tr>
            <td><?php echo e($row['id']); ?></td>
            <td><?php echo e($row['name']); ?></td>
            <td><?php echo e($row['email']); ?></td>
            <td><?php echo e($row['department']); ?></td>

            <?php if ($role == "admin") { ?>
                <td><?php echo e($row['phone']); ?></td>
            <?php } ?>
        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>