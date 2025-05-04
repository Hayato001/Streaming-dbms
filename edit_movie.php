<?php
session_start();
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    die("Access denied. Admins only.");
}
?>

<?php
require 'db.php';

// Get filmID from the URL
$filmID = $_GET['filmID'] ?? null;

if (!$filmID) {
    die("No film selected for editing.");
}

// Fetch movie data
$stmt = $pdo->prepare("SELECT * FROM Film WHERE filmID = :filmID");
$stmt->execute([':filmID' => $filmID]);
$movie = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$movie) {
    die("Movie not found.");
}

// Fetch Genres
$genreStmt = $pdo->query("SELECT * FROM Genre");
$genres = $genreStmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch Lengths
$lengthStmt = $pdo->query("SELECT * FROM Length");
$lengths = $lengthStmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch Ratings
$ratingStmt = $pdo->query("SELECT * FROM Rating");
$ratings = $ratingStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Movie</title>
</head>
<body>

<h1>Edit Movie: <?php echo htmlspecialchars($movie['title']); ?></h1>

<form action="update_movie.php" method="POST">
    <input type="hidden" name="filmID" value="<?php echo $movie['filmID']; ?>">

    <label>Title:</label><br>
    <input type="text" name="title" value="<?php echo htmlspecialchars($movie['title']); ?>" required><br><br>

    <label>Release Year:</label><br>
    <input type="number" name="releaseYear" value="<?php echo $movie['releaseYear']; ?>" required><br><br>

    <label>Description:</label><br>
    <textarea name="filmDescription" rows="4" cols="50" required><?php echo htmlspecialchars($movie['filmDescription']); ?></textarea><br><br>

    <label>Genre:</label><br>
    <select name="genreID" required>
        <?php foreach ($genres as $genre): ?>
            <option value="<?php echo $genre['genreID']; ?>" <?php if ($genre['genreID'] == $movie['genreID']) echo 'selected'; ?>>
                <?php echo htmlspecialchars($genre['genreName']); ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Length:</label><br>
    <select name="lengthID" required>
        <?php foreach ($lengths as $length): ?>
            <option value="<?php echo $length['lengthID']; ?>" <?php if ($length['lengthID'] == $movie['lengthID']) echo 'selected'; ?>>
                <?php echo htmlspecialchars($length['lengthCategory']); ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Rating:</label><br>
    <select name="ratingID" required>
        <?php foreach ($ratings as $rating): ?>
            <option value="<?php echo $rating['ratingID']; ?>" <?php if ($rating['ratingID'] == $movie['ratingID']) echo 'selected'; ?>>
                <?php echo htmlspecialchars($rating['ratingID']); ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <input type="submit" value="Update Movie">
</form>

</body>
</html>
