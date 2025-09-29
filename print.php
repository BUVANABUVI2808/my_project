<?php
include 'config.php';

if (!isset($_GET['booking_id'])) {
    die("Invalid ticket request.");
}

$booking_id = intval($_GET['booking_id']);

// Fetch booking with movie + theatre
$sql = "SELECT b.id, b.seats, b.total_amount, b.grand_total, 
               m.title AS movie, t.name AS theatre 
        FROM bookings b
        JOIN movies m ON b.movie_id = m.id
        JOIN theatres t ON b.theatre_id = t.id
        WHERE b.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();
$ticket = $result->fetch_assoc();

if (!$ticket) {
    die("Ticket not found.");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Print Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .ticket {
            border: 2px dashed #333;
            padding: 20px;
            width: 400px;
            margin: auto;
            text-align: center;
        }

        button {
            margin-top: 15px;
            padding: 10px 20px;
        }
    </style>
</head>

<body>
    <div class="ticket">
        <h2>🎟 Movie Ticket</h2>
        <p><strong>Movie:</strong> <?php echo htmlspecialchars($ticket['movie']); ?></p>
        <p><strong>Theatre:</strong> <?php echo htmlspecialchars($ticket['theatre']); ?></p>
        <p><strong>Seats:</strong> <?php echo htmlspecialchars($ticket['seats']); ?></p>
        <p><strong>Total Amount:</strong> ₹<?php echo $ticket['total_amount']; ?></p>
        <p><strong>Grand Total (with GST):</strong> ₹<?php echo $ticket['grand_total']; ?></p>
        <button onclick="window.print()">🖨 Print</button>
    </div>
</body>

</html>