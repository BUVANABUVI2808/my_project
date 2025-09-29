<?php
session_start();
include 'config.php';
if (!isset($_SESSION['admin_id'])) {
  header("Location: admin_login.php");
  exit();
}

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $theatre_id = (int)$_POST['theatre_id'];
  $title = $conn->real_escape_string($_POST['title']);
  $desc  = $conn->real_escape_string($_POST['desc']);

  $sql = "INSERT INTO offers (theatre_id, offer_title, offer_desc) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("iss", $theatre_id, $title, $desc);
  if ($stmt->execute()) {
    $msg = "Offer saved successfully.";
  } else {
    $msg = "Error: " . $conn->error;
  }
  $stmt->close();
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Admin - Add Offer</title>
</head>

<body style="font-family:Arial;background:#222;color:#fff;padding:20px;">
  <h2>Add Offer</h2>
  <?php if ($msg) echo "<p style='color:lightgreen;'>$msg</p>"; ?>
  <form method="post">
    <label>Theatre</label><br>
    <select name="theatre_id" required>
      <?php
      $q = $conn->query("SELECT id, name, location FROM theaters");
      if (!$q) {
        echo "<option value=''>No theatres</option>";
      } else {
        while ($r = $q->fetch_assoc()) {
          echo "<option value='{$r['id']}'>{$r['name']} - {$r['location']}</option>";
        }
      }
      ?>
    </select><br><br>

    <label>Offer Title</label><br>
    <input type="text" name="title" required style="width:60%;padding:8px"><br><br>

    <label>Offer Description</label><br>
    <textarea name="desc" required style="width:60%;height:120px;padding:8px"></textarea><br><br>

    <button type="submit" style="padding:10px 16px;border-radius:6px;background:#ffcc00;border:none;cursor:pointer">Save Offer</button>
  </form>

  <p><a href="dashboard.php" style="color:#ffcc00">Back to Dashboard</a></p>
</body>

</html>