<?php
include 'config.php';
$search = isset($_GET['theatre']) ? $conn->real_escape_string(trim($_GET['theatre'])) : '';
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Offers</title>
</head>

<body style="font-family:Arial;background:#111;color:#fff;padding:20px;">
  <h2>Search Offers</h2>
  <form method="get">
    <input type="text" name="theatre" placeholder="Enter theatre name or city" value="<?php echo htmlspecialchars($search); ?>" style="padding:8px;width:300px">
    <button type="submit" style="padding:8px 12px;margin-left:8px">Search</button>
  </form>

  <div style="margin-top:20px;">
    <?php
    if ($search === '') {
      echo "<p style='color:#ccc'>Type theatre name or city to find offers.</p>";
    } else {
      // join offers with theatres
      $sql = "SELECT o.offer_title, o.offer_desc, t.name, t.location
              FROM offers o
              JOIN theaters t ON o.theatre_id = t.id
              WHERE t.name LIKE '%$search%' OR t.location LIKE '%$search%'
              ORDER BY o.created_at DESC";
      $res = $conn->query($sql);
      if (!$res) {
        echo "<p style='color:salmon'>Query error: " . $conn->error . "</p>";
      } elseif ($res->num_rows == 0) {
        echo "<p style='color:#ccc'>No offers found for '<b>" . htmlspecialchars($search) . "</b>'.</p>";
      } else {
        while ($row = $res->fetch_assoc()) {
          echo "<div style='background:#222;padding:12px;margin:12px 0;border-radius:8px;'>
                  <h3 style='margin:0;color:#ffcc00;'>" . htmlspecialchars($row['offer_title']) . "</h3>
                  <small style='color:#aaa'>{$row['name']} - {$row['location']}</small>
                  <p style='color:#ddd;margin-top:8px;'>" . nl2br(htmlspecialchars($row['offer_desc'])) . "</p>
                </div>";
        }
      }
    }
    ?>
  </div>
  <p><a href="index.php" style="color:#ffcc00">Back to Home</a></p>
</body>

</html>