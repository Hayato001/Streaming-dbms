<?php
session_start();
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    die("Access denied. Admins only.");
}
?>

<?php
require 'db.php';

$filmID = $_GET['filmID'] ?? null;

if (!$filmID) {
    die("No movie selected for deletion.");
}

try {
    $stmt = $pdo->prepare("DELETE FROM Film WHERE filmID = :filmID");
    $stmt->execute([':filmID' => $filmID]);

    echo "Movie deleted successfully!<br>";
    echo "<a href='taskB.html'>Return to Movie Listings</a>";
} catch (PDOException $e) {
    die("Error deleting movie: " . $e->getMessage());
}
?>
