<?php include("config.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta charset="UTF-8">
  <title>Premium Bookings</title>
  <style>
    body {
      margin: 0;
      font-family: Popins;
      background: #1c1c1c;
      color: #fff;
    }

    /* Navbar */
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 40px;
      background: rgba(50, 50, 50, 0.8);
      backdrop-filter: blur(6px);
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .logo {
      font-size: 28px;
      font-weight: bold;
      color: gold;
      position: relative;
    }

    .logo::after {
      position: absolute;
      top: -12px;
      left: 28px;
      font-size: 20px;
    }

    .nav-links a {
      margin: 0 12px;
      text-decoration: none;
      color: #ccc;
    }

    .nav-links a:hover {
      color: gold;
    }

    .search-icon {
      font-size: 20px;
      cursor: pointer;
    }

    h1 {
      font-family: popins;
    }

    /* Hero Section */
    .hero {
      height: 70vh;
      background: url('banner.jpg') center/cover no-repeat;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      position: relative;
      animation: scrollBanner 15s linear infinite;
      cursor: pointer;
    }

    @keyframes scrollBanner {
      0% {
        background-position: 0 0;
      }

      100% {
        background-position: -1000px 0;
      }
    }

    .hero h1 {
      font-size: 48px;
      color: gold;
      text-shadow: 2px 2px 8px #000;
    }

    .btn {
      margin-top: 20px;
      padding: 12px 30px;
      font-size: 18px;
      border: none;
      border-radius: 8px;
      background: #444;
      color: white;
      cursor: pointer;
      transition: 0.3s;
    }

    .btn:hover {
      background: gold;
      color: black;
    }

    /* Sections */
    section {
      padding: 40px;
    }

    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
      gap: 20px;
    }

    .card {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 12px;
      padding: 15px;
      text-align: center;
      transition: 0.5s ease;
      cursor: pointer;
    }

    .card img {

      width: 100%;
      border-radius: 8px;
    }

    .card:hover {

      transform: scale(1.1);
    }

    .card h4 {
      margin: 10px 0 5px;
    }

    .card span {
      font-size: 14px;
      color: #aaa;
    }

    /* Footer */
    footer {
      background: #111;
      text-align: center;
      padding: 20px;
      margin-top: 40px;
      color: #888;
    }

    a {
      text-decoration: none;
      color: #ffcc00;
      margin-left: 40%;
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <div class="navbar">
    <div class="logo">
      <img src="posters/logo.png" alt="Logo" style="height:50px;">
    </div>
    <div class="nav-links">
      <a href="#">Home</a>
      <a href="movies.php">Movies</a>

      <a href="offers.php">Offers</a>
      <a href="logout.php">Logout</a>
    </div>
    <div class="search-icon">
      <form action="">

      </form>
    </div>
  </div>

  <!-- Hero Section -->
  <div class="hero" onclick="window.location.href='movies.php'">
    <h1>Premium Bookings</h1>
    <button class="btn" onclick="event.stopPropagation(); selectLocation();">Book Now</button>
  </div>

  <!-- Now Showing -->

  <section class="now">
    <h2>🎬Next Showing</h2>
    <div class="movies-grid">
      <?php
      include 'db.php'; // DB connect file
      $result = mysqli_query($conn, "SELECT * FROM movies ORDER BY show_time ASC LIMIT 6");
      while ($row = mysqli_fetch_assoc($result)) {
        echo '
          <div class="movie-card">
             <h3>' . $row['title'] . '</h3>
              <p>' . $row['description'] . '</p>
              <p><strong>Showtime:</strong> ' . date("d M Y h:i A", strtotime($row['show_time'])) . '</p>
              <button onclick="window.location.href=\'book.php?movie_id=' . $row['id'] . '\'">Book Now</button>
          </div>
          ';
      }
      ?>
    </div>
  </section>
  <!-- Coming Soon -->
  <section id="coming">
    <h2>⏳ Coming Soon</h2>
    <div class="grid">
      <div class="card"><img src="bg11.jpg">
        <h4>Sachien</h4><span>Releases 1 Oct</span>
      </div>
      <div class="card"><img src="bg12.jpg">
        <h4>Velayutham</h4><span>Releases 12 Oct</span>
      </div>
      <div class="card"><img src="bg5.jpg">
        <h4>Kaavalan</h4><span>Releases 12 Oct</span>
      </div>
      <div class="card"><img src="bg58.jpg">
        <h4>Priyamanavale</h4><span>Releases 12 Oct</span>
      </div>
      <div class="card"><img src="bg9.jpg">
        <h4>Pokkiri</h4><span>Releases 25 Oct</span>
      </div>
    </div>
  </section>

  <!-- Offers -->
  <section id="offers">
    <h2>Offers</h2>
    <div class="offers-search">
      <form method="get" action="offers.php">
        <input type="text" name="theatre" placeholder="Search theatre or city for offers"><br><br>
        <button type="submit">Find Offers</button>
      </form>
    </div>
  </section>

  <!-- Reviews -->
  <?php
  // Latest Reviews Fetch
  $reviewsQuery = "
  SELECT r.rating, r.comment, r.created_at, 
         m.title AS movie_title, 
         t.name AS theatre_name
  FROM reviews r
  JOIN movies m ON r.movie_id = m.id
  JOIN theaters t ON r.theatre_id = t.id
  ORDER BY r.created_at DESC
  LIMIT 5
";
  $reviewsResult = $conn->query($reviewsQuery);
  ?>

  <section id="reviews" style="padding:40px; background:#111; color:#fff;">
    <h2 style="text-align:center; color:#ffcc00;">User Reviews</h2>

    <?php if ($reviewsResult && $reviewsResult->num_rows > 0): ?>
      <div style="max-width:800px; margin:20px auto;">
        <?php while ($rev = $reviewsResult->fetch_assoc()): ?>
          <div style="background:#222; margin-bottom:15px; padding:15px; border-radius:8px;">
            <h3 style="margin:0; color:#ffcc00;"><?php echo htmlspecialchars($rev['movie_title']); ?></h3>
            <p style="margin:5px 0; font-size:14px; color:#aaa;">
              <?php echo htmlspecialchars($rev['theatre_name']); ?> |
              <?php echo date("d M Y, h:i A", strtotime($rev['created_at'])); ?>
            </p>
            <p style="margin:5px 0;">⭐ <?php echo $rev['rating']; ?>/5</p>
            <p style="margin:10px 0;"><?php echo nl2br(htmlspecialchars($rev['comment'])); ?></p>
          </div>
        <?php endwhile; ?>
      </div>
    <?php else: ?>
      <p style="text-align:center; color:#aaa;">No reviews yet. Be the first to <a href="review.php" style="color:#ffcc00;">add one</a>!</p>
    <?php endif; ?>
    <a href="review.php">Submit Your Ratings and Reviews</a>
  </section>

  <!-- Footer -->
  <footer>
    <p>© 2025 Premium Bookings | Contact | Privacy Policy</p>
  </footer>

  <script>
    function selectLocation() {
      let loc = prompt("Enter your location:");
      if (loc) {
        window.location.href = "theaters.php?location=" + encodeURIComponent(loc);
      }
    }

    function bookMovie(id) {
      window.location.href = "theaters.php?movie_id=" + id;
    }
  </script>
</body>

</html>