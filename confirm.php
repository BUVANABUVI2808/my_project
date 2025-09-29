<?php
include 'db.php';
session_start();
$user_id   = $_SESSION['user_id'];
$movie_id  = $_POST['movie_id'];
$theatre_id = $_POST['theatre_id'];
$seats     = $_POST['seats'];
$amount    = $_POST['amount'];

// Save booking
mysqli_query($conn, "INSERT INTO bookings (user_id, movie_id, theatre_id, seats_booked, amount) 
VALUES ($user_id, $movie_id, $theatre_id, '$seats', $amount)");

// Redirect to GPay (upi link example)
$upi_link = "upi://pay?pa=your-gpay-id@okaxis&pn=PremiumBookings&am=$amount&cu=INR";
header("Location: $upi_link");
exit();
