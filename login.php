<?php
session_start();
include 'db.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("Location: splash.php");
            exit();
            header("location:index.php");
        } else {
            echo "<script>alert('Wrong Password!'); window.location.href='login.php';</script>";
        }
    } else {
        echo "<script>alert('User not found!'); window.location.href='login.php';</script>";
    }
}
?>
<html>

<head>
<style>
    a
    {
        text-decoration: none;
        color: red;
    }
</style>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="bg-slideshow"></div>

    <div class="container">
        <form method="post">
            <div class="form-group horizontal">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Email" required>
            </div>

            <div class="form-group horizontal">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <button type="submit" name="login" class="btn-register">Login
            </button>
            <p class="message">Didn't have an account? <a href="register.php">Register here</a></p>
            <p>For Admin Login...<a href="admin_login.php">Click here</a></p>
        </form>
    </div>
</body>

</html>