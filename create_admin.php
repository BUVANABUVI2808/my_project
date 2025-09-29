<?php
include 'config.php'; // db connection

$username = "admin1";
$password = "Admin@123";
$full_name = "Site Admin";

$hash = password_hash($password, PASSWORD_BCRYPT);

// Insert admin
$stmt = $conn->prepare("INSERT INTO admins (username, password, full_name) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $hash, $full_name);

if ($stmt->execute()) {
    echo "✅ Admin created successfully!";
} else {
    echo "❌ Error: " . $conn->error;
}

$stmt->close();
$conn->close();
