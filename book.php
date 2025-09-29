<?php
include 'config.php';
$movie_id = isset($_GET['movie_id']) ? intval($_GET['movie_id']) : 0;

// அந்த movieக்கு theatres எடுப்பது
$theatreQuery = $conn->query("SELECT * FROM theaters");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Book Movie</title>
</head>

<body style="font-family:Arial; text-align:center;">
    <h2>🎬 Book Movie</h2>

    <form method="GET" action="seats.php">
        <input type="hidden" name="movie_id" value="<?php echo $movie_id; ?>">

        <label><b>Select Theatre:</b></label>
        <select name="theatre_id" required>
            <option value="">-- Choose Theatre --</option>
            <?php while ($t = $theatreQuery->fetch_assoc()): ?>
                <option value="<?php echo $t['id']; ?>">
                    <?php echo htmlspecialchars($t['name']); ?>
                </option>
            <?php endwhile; ?>
        </select>
        <br><br>
        <button type="submit">Continue</button>
    </form>
</body>

</html>