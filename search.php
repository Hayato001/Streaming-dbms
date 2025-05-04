<?php
require 'db.php';

session_start();
$isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true;


// Collect parameters
$name = $_GET['name'] ?? '';
$genre = $_GET['genre'] ?? '';
$rating = $_GET['rating'] ?? '';
$length = $_GET['length'] ?? '';

// Build base query
$query = "
    SELECT f.filmID, f.title, f.filmDescription, g.genreName, r.ratingID, l.lengthCategory, f.releaseYear
    FROM Film f
    JOIN Genre g ON f.genreID = g.genreID
    JOIN Rating r ON f.ratingID = r.ratingID
    JOIN Length l ON f.lengthID = l.lengthID
    WHERE 1
";

// Dynamic filters
$params = [];

if (!empty($name)) {
    $query .= " AND f.title LIKE :name";
    $params[':name'] = "%$name%";
}

if (!empty($genre)) {
    $query .= " AND g.genreName LIKE :genre";
    $params[':genre'] = "%$genre%";
}


if (!empty($rating)) {
    $query .= " AND r.ratingID = :rating";
    $params[':rating'] = $rating;
}

if (!empty($length)) {
    $query .= " AND l.lengthCategory LIKE :length";
    $params[':length'] = "%$length%";
}

// Prepare and execute
$stmt = $pdo->prepare($query);
$stmt->execute($params);

$movies = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Output as JSON
header('Content-Type: application/json');
echo json_encode([
    'movies' => $movies,
    'isAdmin' => $isAdmin
]);

?>
