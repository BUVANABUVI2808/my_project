<?php
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $location = $_POST['location'];

    $stmt = $conn->prepare("INSERT INTO theaters (name, location) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $location);

    if ($stmt->execute()) {
        header("Location: dashboard.php?msg=theatre_added");
        exit();
    } else {
        echo "❌ Error: " . $conn->error;
    }
    $stmt->close();
}
$conn->close();
?>