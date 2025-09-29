<?php
session_start();
include 'config.php';

// Redirect to login if admin not logged in
if (!isset($_SESSION['admin_id'])) {
  header("Location: admin_login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <style>
    body {
      font-family: Arial;
      background: #222;
      color: #fff;
      margin: 0;
      padding: 0;
    }

    .container {
      width: 90%;
      margin: auto;
      padding: 20px;
    }

    h1,
    h2 {
      color: #ffcc00;
    }

    form {
      margin: 20px 0;
      padding: 15px;
      background: #333;
      border-radius: 10px;
    }

    input,
    select,
    textarea {
      width: 100%;
      padding: 8px;
      margin: 5px 0;
      border-radius: 5px;
      border: none;
    }

    button {
      background: #ffcc00;
      color: #000;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      background: #ffaa00;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    table,
    th,
    td {
      border: 1px solid #555;
      padding: 10px;
      text-align: left;
    }

    th {
      background: #333;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>Admin Dashboard</h1>
    <h2>🎟️ User Bookings</h2>

    <table>
      <tr>
        <th>User</th>
        <th>Movie</th>
        <th>Theatre</th>
        <th>Seats</th>
        <th>Booking Time</th>
      </tr>
      <?php
      // Use LEFT JOINs to ensure all bookings appear even if some data is missing
      $sql = "SELECT b.id, u.username, m.title, t.name AS theatre_name, b.seats_booked, b.booked_at 
                FROM bookings b
                LEFT JOIN users u ON b.user_id = u.id
                LEFT JOIN movies m ON b.movie_id = m.id
                LEFT JOIN theaters t ON b.theatre_id = t.id
                ORDER BY b.booked_at DESC";

      $result = $conn->query($sql);

      if (!$result) {
        echo "<tr><td colspan='5'>Query Error: " . $conn->error . "</td></tr>";
      } elseif ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . htmlspecialchars($row['username'] ?? 'N/A') . "</td>";
          echo "<td>" . htmlspecialchars($row['title'] ?? 'N/A') . "</td>";
          echo "<td>" . htmlspecialchars($row['theatre_name'] ?? 'N/A') . "</td>";
          echo "<td>" . htmlspecialchars($row['seats_booked'] ?? 'N/A') . "</td>";
          echo "<td>" . htmlspecialchars($row['booked_at'] ?? 'N/A') . "</td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='5'>No bookings found</td></tr>";
      }
      ?>
    </table>
  </div>
</body>

</html>