<?php
include 'db.php';

if (isset($_POST['register'])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $sql = "INSERT INTO users (username, email, password) VALUES ('$username','$email','$password')";


  if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Registered Successfully!'); window.location.href='login.php';</script>";
  } else {
    echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
  }
}
?>
<html>

<head>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="bg-slideshow"></div>
  <div class="container">
    <form method="post">
      <!-- Username side by side with label -->
      <div class="form-group horizontal">

        <label for="username">Username</label><input type="text" name="username" required><br>
      </div>
      <div class="form-group horizontal">
        <label for="email">Email</label><input type="email" name="email" required><br>
      </div>

      <div class="form-group horizontal">
        <label for="password">Password</label> <input type="password" name="password" required><br>
      </div>
      <button type="submit" name="register" class="btn-register">Register</button>
      <p class="message">Already have an account? <a href="login.php">Login here</a></p>
    </form>
  </div>
</body>

</html>