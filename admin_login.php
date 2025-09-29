<?php
session_start();
include 'config.php'; // DB connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);

  $stmt = $conn->prepare("SELECT id, password, full_name FROM admins WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $stmt->bind_result($id, $hash, $full_name);
  if ($stmt->fetch()) {
    if (password_verify($password, $hash)) {
      // ✅ success
      $_SESSION['admin_id'] = $id;
      $_SESSION['admin_name'] = $full_name ?: $username;
      header("Location: dashboard.php");
      exit();
    } else {
      $error = "❌ Wrong password!";
    }
  } else {
    $error = "❌ No such admin!";
  }
  $stmt->close();
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Admin Login</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="bg-slideshow"></div>
  <div class="container">
    <form method="post">
      <div class="form-group horizontal">
        <label for="username">Username</label>
        <input type="text" name="username" placeholder="Admin Username" required><br>
      </div>
      <div class="form-group horizontal">
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Password" required><br>
      </div>
      <button type="submit" class="btn-register">Login</button>
    </form>
    <?php if (!empty($error)) echo "<p style='color:red'>$error</p>"; ?>
</body>

</html>