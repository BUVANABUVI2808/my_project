<?php
session_start();
include 'config.php';

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
        }

        .container {
            width: 90%;
            margin: auto;
        }

        h1 {
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
    </style>
</head>
<form method="post" action="save_movie.php">
    <h2>Add Movie</h2>
    <input type="text" name="title" placeholder="Movie Title" required>
    <textarea name="description" placeholder="Description"></textarea>
    <input type="datetime-local" name="show_time" required>
    <input type="number" name="seats_available" placeholder="Total Seats" required>
    <button type="submit">Save Movie</button>
</form>