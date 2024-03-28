<?php
include("../php/config.php");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch reviews from database
$sql = "SELECT * FROM reviews ORDER BY date DESC";
$result = $conn->query($sql);

// Display reviews
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="review">';
        echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
        echo '<div class="stars">' . str_repeat('&#9733; ', $row['numStars']) . '</div>';
        echo '<p>' . htmlspecialchars($row['content']) . '</p>';
        if (!empty($row['picture'])) {
            echo '<img src="uploads/' . htmlspecialchars($row['picture']) . '" alt="Review Photo" style="max-width: 100%; height: auto;">';
        }
        echo '</div>';
    }
} else {
    echo "No reviews yet.";
}

// Close connection
$conn->close();
?>
