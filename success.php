<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$amount = $_POST['amount'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Payment Success</title>
    <style>
        body {
            font-family: Arial;
            background: #111;
            color: #fff;
            text-align: center;
        }

        .success {
            margin-top: 100px;
        }

        .success h1 {
            color: #00e676;
        }
    </style>
</head>

<body>
    <div class="success">
        <h1>✅ Payment Successful</h1>
        <p>Thank you for your booking!</p>
        <p>Amount Paid: ₹<?php echo $amount; ?></p>
        <a href="home.php" style="color:#ffcc00;">Back to Home</a>
    </div>
</body>

</html>