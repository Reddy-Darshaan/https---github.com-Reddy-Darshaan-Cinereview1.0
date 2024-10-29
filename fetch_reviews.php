<?php
require 'db_connect.php'; // Include your database connection
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $movie_title = $_GET['movie_title']; // Get movie title from the query string
    $sql = "SELECT user_id, rating, review FROM reviews WHERE movie_title = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $movie_title);
    $stmt->execute();
    $result = $stmt->get_result();

    $reviews = [];
    while ($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }
    echo json_encode(['success' => true, 'reviews' => $reviews]);

    $stmt->close();
    $conn->close();
}
?>
