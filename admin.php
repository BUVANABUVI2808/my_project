<?php
// create_admin.php
// Update DB creds if needed
$host = "localhost";
$user = "root";
$pass = "";
$db   = "movie_booking";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// CHANGE these to your desired admin credentials
$admin_username = "admin";
$admin_password_plain = "Admin@123"; // change this to a strong password
$admin_fullname = "Super Admin";

// secure hash
$hash = password_hash($admin_password_plain, PASSWORD_BCRYPT);

// prepare & insert
$stmt = $conn->prepare("INSERT INTO admins (username, password, full_name) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $admin_username, $hash, $admin_fullname);

if ($stmt->execute()) {
    echo "Admin created successfully. Username: {$admin_username} \n";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
