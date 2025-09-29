<?php
include 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Validate POST
if (!isset($_POST['movie_id'], $_POST['theatre_id'], $_POST['seats'])) {
  die("Invalid booking details.");
}

$movie_id   = intval($_POST['movie_id']);
$theatre_id = intval($_POST['theatre_id']);
$seats      = $_POST['seats'];

if (!is_array($seats) || count($seats) === 0) {
  die("No seats selected.");
}

/* --------------------- Get movie details --------------------- */
$stmtMovie = $conn->prepare("SELECT title, ticket_price FROM movies WHERE id = ? LIMIT 1");
$stmtMovie->bind_param("i", $movie_id);
$stmtMovie->execute();
$resMovie = $stmtMovie->get_result();
$movie = $resMovie->fetch_assoc();
$stmtMovie->close();

if (!$movie) {
  die("Movie not found.");
}

/* --------------------- Get theatre details ------------------- */
$stmtTheatre = $conn->prepare("SELECT name FROM theaters WHERE id = ? LIMIT 1");
$stmtTheatre->bind_param("i", $theatre_id);
$stmtTheatre->execute();
$resTheatre = $stmtTheatre->get_result();
$theatre = $resTheatre->fetch_assoc();
$stmtTheatre->close();

if (!$theatre) {
  die("Theatre not found.");
}

$ticketPrice = floatval($movie['ticket_price']);
$seatCount = count($seats);

/* ----------------- Extra seat charges logic ----------------- */
$extraCharge = 0;
foreach ($seats as $seat) {
  $num = intval(preg_replace('/[^0-9]/', '', $seat));
  if ($num >= 4 && $num <= 7) {
    $extraCharge += 40;
  }
}

/* ----------------- Billing calculations ----------------- */
$totalBase = round($ticketPrice * $seatCount, 2);
$totalBeforeGST = round($totalBase + $extraCharge, 2);
$gst = round($totalBeforeGST * 0.18, 2);
$grandTotal = round($totalBeforeGST + $gst, 2);

$seats_str = implode(", ", $seats);

/* ----------------- Save booking (optional) ----------------- */
$stmtInsert = $conn->prepare("INSERT INTO bookings (movie_id, theatre_id, seats_booked, total_amount) VALUES (?, ?, ?, ?)");
$stmtInsert->bind_param("iisd", $movie_id, $theatre_id, $seats_str, $grandTotal);
$stmtInsert->execute();
$booking_id = $stmtInsert->insert_id;
$stmtInsert->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Payment Successful</title>
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      background: #0f0f12;
      color: #fff;
      padding: 24px
    }

    .box {
      max-width: 700px;
      background: #1b1b1f;
      margin: 30px auto;
      padding: 20px;
      border-radius: 10px;
      border: 1px solid #2a2a2a
    }

    h1 {
      color: #00e676
    }

    .muted {
      color: #bfbfbf
    }

    .btn {
      padding: 10px 18px;
      margin: 10px 5px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 700
    }

    .print-btn {
      background: #ffcc00;
      color: #000
    }

    .back-btn {
      background: #1976d2;
      color: #fff
    }
  </style>
</head>

<body>
  <div class="box">
    <h1>✅ Payment Successful</h1>
    <p class="muted">Booking ID: <strong><?php echo intval($booking_id); ?></strong></p>

    <h3>Booking Summary</h3>
    <p><strong>Movie:</strong> <?php echo htmlspecialchars($movie['title']); ?></p>
    <p><strong>Theatre:</strong> <?php echo htmlspecialchars($theatre['name']); ?></p>
    <p><strong>Seats:</strong> <?php echo htmlspecialchars($seats_str); ?> (<?php echo $seatCount; ?> seats)</p>
    <p><strong>Base Amount:</strong> ₹<?php echo number_format($totalBase, 2); ?></p>
    <p><strong>Extra Seat Charges:</strong> ₹<?php echo number_format($extraCharge, 2); ?></p>
    <p><strong>GST (18%):</strong> ₹<?php echo number_format($gst, 2); ?></p>
    <h2>Grand Total: ₹<?php echo number_format($grandTotal, 2); ?></h2>

    <div>
      <button class="btn print-btn" onclick="window.print()">🖨 Print Ticket</button>
      <a href="index.php"><button class="btn back-btn">⬅ Back to Dashboard</button></a>
    </div>
  </div>
</body>

</html>