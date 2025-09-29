<?php
include 'config.php';
$sql = "SELECT * FROM movies";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>

<head>
  <title>Movies List</title>
  <style>
    body {
      font-family: Arial;
      background: #1a1a1a;
      color: white;
    }

    .movie-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 20px;
      padding: 20px;
    }

    .movie-card {
      background: #2a2a2a;
      padding: 15px;
      border-radius: 10px;
      text-align: center;
    }

    .movie-card img {
      width: 100%;
      height: 250px;
      object-fit: cover;
      border-radius: 10px;
    }

    .movie-card h3 {
      margin: 10px 0;
    }

    .book-btn {
      padding: 8px 15px;
      background: chocolate;
      border: none;
      border-radius: 6px;
      color: white;
      cursor: pointer;
    }

    .book-btn:hover {
      background: #8b4513;
    }
  </style>
</head>

<body>
  <h1 style="text-align:center;">🎥 Now Showing</h1>
  <div class="movie-grid">
    <?php while ($row = $result->fetch_assoc()) { ?>
      <div class="movie-card">

        <h3><?php echo $row['title']; ?></h3>
        <p><?php echo $row['description']; ?></p>
        <button class="book-btn" onclick="window.location.href='book.php?movie_id=<?php echo $row['id']; ?>'">Book Tickets</button>
      </div>
    <?php } ?>
  </div>
</body>

</html>