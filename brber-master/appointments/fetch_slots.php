<?php
session_start();
include 'config.php';  // Ensure this includes database connection setup

// Check if the required 'date' is passed
if (isset($_GET['date'])) {
    $date = $_GET['date'];
    $barberID = $_SESSION['selectedBarberId'] ?? 0;  // Fallback to 0 if not set

    // SQL query that checks for appointments for a given date and barber
    $query = "SELECT ts.id, ts.start_time,
          MAX(IF(ap.id IS NOT NULL AND ap.barberID = ?, 'booked', 'available')) AS status
          FROM time_slots ts
          LEFT JOIN appointments ap ON ts.id = ap.time_slot_id AND ap.date = ?
          GROUP BY ts.id, ts.start_time
          ORDER BY ts.start_time;";

    // Prepare and bind parameters
    $stmt = $mysqli->prepare($query);
    if (!$stmt) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        exit;
    }
    $stmt->bind_param("is", $barberID, $date);  // Integer for ID, string for date
    $stmt->execute();
    $result = $stmt->get_result();
    $slots = $result->fetch_all(MYSQLI_ASSOC);

    // Output the slots in JSON format
    echo json_encode($slots);
} else {
    echo json_encode(["error" => "Date parameter is missing"]);
}
