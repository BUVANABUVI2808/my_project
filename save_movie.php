<?php
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $show_time = $_POST['show_time'];
    $seats_available = $_POST['seats_available'];

    $stmt = $conn->prepare("INSERT INTO movies (title, description, show_time, seats_available) VALUES (?,?,?,?)");
    $stmt->bind_param("sssi", $title, $description, $show_time, $seats_available);

    if ($stmt->execute()) {
        header("Location: dashboard.php?msg=movie_added");
        exit();
    } else {
        echo "❌ Error: " . $conn->error;
    }
    $stmt->close();
}
$conn->close();
?>


<form method="POST">
    <label>Movie Title:</label>
    <input type="text" name="title" required><br><br>

    <label>Description</label>
    <input type="text" name="descrition" required><br><br>

    <label>Show time:</label>
    <input type="number" name="show_time" required><br><br>

    <label>Total seats:</label>
    <input type="number" name="seats_available" required><br><br>

    <label>Ticket Price (₹):</label>
    <input type="number" step="0.01" name="ticket_price" required><br><br>

    <button type="submit">Save Movie</button>
</form>