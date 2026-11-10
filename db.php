<?php
$conn = new mysqli(
    "localhost",
    "root",
    "",
    "companywebpage_db"
);

if ($conn->connect_error) {
    die("Database connection failed: " .
        $conn->connect_error);
}
?>