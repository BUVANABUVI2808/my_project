<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $movie_id = $_POST['movie_id'];
    $theatre_id = $_POST['theatre_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    $stmt = $conn->prepare("INSERT INTO reviews (movie_id, theatre_id, rating, comment) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiis", $movie_id, $theatre_id, $rating, $comment);

    if ($stmt->execute()) {
        echo "<script>alert('Review submitted successfully!'); window.location='index.php#reviews';</script>";
    } else {
        echo "<script>alert('Error saving review');</script>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Submit Review</title>
    <style>
        body {
            background: #111;
            color: #fff;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 60px auto;
            background: #222;
            padding: 20px;
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            color: #ffcc00;
        }

        label {
            display: block;
            margin-top: 10px;
            color: #ddd;
        }

        select,
        textarea,
        button {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            border-radius: 6px;
            border: none;
            outline: none;
        }

        textarea {
            resize: none;
            height: 80px;
        }

        button {
            background: #ffcc00;
            color: #111;
            font-weight: bold;
            cursor: pointer;
            margin-top: 15px;
        }

        button:hover {
            background: gold;
        }

        /* ⭐ Rating Stars */
        .stars {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center;
            margin: 15px 0;
        }

        .stars input {
            display: none;
        }

        .stars label {
            font-size: 30px;
            color: #444;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .stars input:checked~label,
        .stars label:hover,
        .stars label:hover~label {
            color: gold;
            transform: scale(1.2);
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Submit Your Review</h2>
        <form method="POST" action="">
            <label for="movie_id">Select Movie:</label>
            <select name="movie_id" required>
                <?php
                $movies = $conn->query("SELECT id, title FROM movies");
                while ($m = $movies->fetch_assoc()) {
                    echo "<option value='{$m['id']}'>{$m['title']}</option>";
                }
                ?>
            </select>

            <label for="theatre_id">Select Theatre:</label>
            <select name="theatre_id" required>
                <?php
                $theatres = $conn->query("SELECT id, name FROM theaters");
                while ($t = $theatres->fetch_assoc()) {
                    echo "<option value='{$t['id']}'>{$t['name']}</option>";
                }
                ?>
            </select>

            <label>Rating:</label>
            <div class="stars">
                <input type="radio" id="star5" name="rating" value="5" required><label for="star5">&#9733;</label>
                <input type="radio" id="star4" name="rating" value="4"><label for="star4">&#9733;</label>
                <input type="radio" id="star3" name="rating" value="3"><label for="star3">&#9733;</label>
                <input type="radio" id="star2" name="rating" value="2"><label for="star2">&#9733;</label>
                <input type="radio" id="star1" name="rating" value="1"><label for="star1">&#9733;</label>
            </div>

            <label for="comment">Your Review:</label>
            <textarea name="comment" placeholder="Write your feedback..." required></textarea>

            <button type="submit">Submit Review</button>
        </form>
    </div>
</body>

</html>