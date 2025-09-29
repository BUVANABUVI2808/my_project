<?php
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $movie_id = $_POST['movie_id'];
    $theatre_id = $_POST['theatre_id'];

    $stmt = $conn->prepare("INSERT INTO theatre_movies (movie_id, theatre_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $movie_id, $theatre_id);

    if ($stmt->execute()) {
        header("Location:dashboard.php?msg=assigned");
        exit();
    } else {
        echo "❌ Error: " . $conn->error;
    }
    $stmt->close();
}
$conn->close();
