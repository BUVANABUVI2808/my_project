<?php
// seats.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'config.php'; // <-- path correctா இருக்கணும்

// movie_id & theatre_id GET/POST check
$movie_id   = isset($_GET['movie_id']) ? intval($_GET['movie_id']) : (isset($_POST['movie_id']) ? intval($_POST['movie_id']) : 0);
$theatre_id = isset($_GET['theatre_id']) ? intval($_GET['theatre_id']) : (isset($_POST['theatre_id']) ? intval($_POST['theatre_id']) : 0);

if ($movie_id <= 0 || $theatre_id <= 0) {
  die("<h3 style='color:salmon;text-align:center;margin-top:40px;'>Error: Movie or Theatre not selected. Please go back and choose.</h3>");
}

/* ---- Already booked seats fetch ---- */
$bookedSeats = [];
$stmt = $conn->prepare("SELECT seats_booked FROM bookings WHERE movie_id = ? AND theatre_id = ?");
if ($stmt) {
  $stmt->bind_param("ii", $movie_id, $theatre_id);
  $stmt->execute();
  $res = $stmt->get_result();
  while ($row = $res->fetch_assoc()) {
    if (!empty($row['seats_booked'])) {
      $parts = array_map('trim', explode(',', $row['seats_booked']));
      $bookedSeats = array_merge($bookedSeats, $parts);
    }
  }
  $stmt->close();
} else {
  die("<pre style='color:salmon'>DB Error: " . htmlspecialchars($conn->error) . "</pre>");
}
$bookedSeats = array_unique($bookedSeats);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Select Seats</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      background: #0f0f12;
      color: #fff;
      margin: 0;
      padding: 20px
    }

    .wrap {
      max-width: 980px;
      margin: 20px auto
    }

    h1 {
      color: #ffcc00;
      text-align: center
    }

    .info {
      background: #17171a;
      padding: 12px;
      border-radius: 8px;
      margin: 12px 0;
      color: #ddd
    }

    .seat-layout {
      max-height: 520px;
      overflow-y: auto;
      background: rgba(255, 255, 255, 0.02);
      padding: 18px;
      border-radius: 10px;
      display: flex;
      flex-direction: column;
      gap: 12px
    }

    .row {
      display: flex;
      justify-content: center;
      gap: 10px;
      align-items: flex-end
    }

    .seat {
      width: 44px;
      height: 44px;
      border-radius: 6px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      background: #444;
      color: #fff;
      user-select: none;
      font-weight: 600;
      transition: transform .12s ease, background .12s ease
    }

    .seat input {
      display: none
    }

    .seat.locked {
      background: #6b6b6b;
      cursor: not-allowed;
      opacity: .9
    }

    .seat.selected {
      background: gold;
      color: #000;
      transform: scale(1.05)
    }

    .legend {
      display: flex;
      gap: 12px;
      justify-content: center;
      margin-top: 12px
    }

    .legend div {
      padding: 6px 10px;
      border-radius: 6px;
      background: #222;
      color: #ddd;
      font-size: 14px
    }

    .screen {
      width: 80%;
      margin: 14px auto;
      background: #ccc;
      height: 18px;
      border-radius: 4px;
      color: #111;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700
    }

    .actions {
      margin-top: 18px;
      text-align: center
    }

    button.primary {
      background: #ffcc00;
      border: none;
      padding: 12px 20px;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 700
    }

    button.primary:hover {
      background: #f0b200
    }

    @media(max-width:640px) {
      .seat {
        width: 36px;
        height: 36px;
        font-size: 13px
      }

      .screen {
        width: 92%
      }
    }
  </style>
  <script>
    function toggleSeat(el) {
      var cb = el.querySelector('input[type="checkbox"]');
      if (!cb) return;
      if (cb.disabled) return; // locked seat
      cb.checked = !cb.checked;
      if (cb.checked) el.classList.add('selected');
      else el.classList.remove('selected');
    }

    function collectAndSubmit(form) {
      var checked = form.querySelectorAll('input[name="seats[]"]:checked');
      if (checked.length === 0) {
        alert('Please select at least one seat.');
        return false;
      }
      return true;
    }
  </script>
</head>

<body>
  <div class="wrap">
    <h1>Select Your Seats</h1>
    <div class="info">
      <strong>Movie ID:</strong> <?php echo htmlspecialchars($movie_id); ?> &nbsp;
      <strong>Theatre ID:</strong> <?php echo htmlspecialchars($theatre_id); ?>
    </div>

    <div class="seat-layout" role="group" aria-label="Seat layout">
      <div class="screen">SCREEN</div>

      <form method="POST" action="payment.php" onsubmit="return collectAndSubmit(this)">
        <input type="hidden" name="movie_id" value="<?php echo htmlspecialchars($movie_id); ?>">
        <input type="hidden" name="theatre_id" value="<?php echo htmlspecialchars($theatre_id); ?>">

        <?php
        $rows = range('A', 'J'); // rows A..J
        $cols = 12;             // seats 1..12

        foreach ($rows as $r) {
          echo "<div class='row' aria-label='Row " . htmlspecialchars($r) . "'>";
          for ($c = 1; $c <= $cols; $c++) {
            $seat = $r . $c;
            $id = 'seat_' . htmlspecialchars($seat);
            $seatText = htmlspecialchars($seat);

            if (in_array($seat, $bookedSeats, true)) {
              echo "<span class='seat locked' title='Already booked'>{$seatText}
                          <input type='checkbox' name='seats[]' value='{$seatText}' disabled>
                        </span>";
            } else {
              echo "<label class='seat' onclick='toggleSeat(this)' for='{$id}' title='Click to select'>
                          {$seatText}
                          <input id='{$id}' type='checkbox' name='seats[]' value='{$seatText}'>
                        </label>";
            }
          }
          echo "</div>";
        }
        ?>

        <div class="legend">
          <div style="background:gold;color:#000;font-weight:700">Selected</div>
          <div style="background:#444;">Available</div>
          <div style="background:#6b6b6b;">Booked</div>
        </div>

        <div class="actions">
          <button type="submit" class="primary">Proceed to Payment</button>
        </div>
      </form>
    </div>
  </div>
</body>

</html>