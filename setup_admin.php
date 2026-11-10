<?php
include 'db.php';

$name = "Company Admin";
$email = "admin@company.com";
$password = password_hash("admin123", PASSWORD_DEFAULT);
$department = "Management";

$stmt = $conn->prepare(
    "INSERT INTO admins (name, email, password, department)
     VALUES (?, ?, ?, ?)"
);

$stmt->bind_param(
    "ssss",
    $name,
    $email,
    $password,
    $department
);

if ($stmt->execute()) {
    echo "Admin account created successfully!";
} else {
    echo "Admin account already exists or creation failed.";
}

$stmt->close();
?>