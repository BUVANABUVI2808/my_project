<?php
session_start();
include 'config.php';

if (!isset($_SESSION['admin_id'])) {
  header("Location: admin_login.php");
  exit();
}
?>

<html>

<head>
  <style>
    div {
      margin-left: 40%;
    }

    body {
      background: #c7b6ee;
      font-family: popins;

      font-weight: 100%;
      font-size: xx-large;

    }

    .hover-text:hover {
      color: blue;
      transform: scale(1.1);
      letter-spacing: .10px;
    }

    a {
      text-decoration: none;
    }
  </style>
</head>

<body>
  <h1>🎬 Admin Dashboard</h1>
  <p>Welcome, <?php echo $_SESSION['admin_name']; ?> | <a href="logout.php" style="color:red">Logout</a></p>
  <div class="a">
    <a href="add_movies.php">
      <p class="hover-text">Add Movies<p>
    </a>
    <a href="add_theatre.php">
      <p class="hover-text">Add Theatres</p>
    </a>
    <a href="assign.php">
      <p class="hover-text">Assign Movies</p>
    </a>
    <a href="bookings.php">
      <p class="hover-text">View Bookings</p>
    </a>
    <a href="admin_offer.php">
      <p class="hover-text">Offers</p>
    </a>
  </div>
</body>

</html>