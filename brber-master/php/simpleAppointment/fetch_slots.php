<?php
include 'config.php';  

if (isset($_GET['date'])) {
    $date = $_GET['date'];
    $query = "SELECT ts.id, ts.start_time, 
              CASE WHEN ap.date IS NULL THEN 'available' ELSE 'booked' END AS status
              FROM time_slots ts
              LEFT JOIN appointments ap ON ts.id = ap.time_slot_id AND ap.date = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $date);
    $stmt->execute();
    $result = $stmt->get_result();
    $slots = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($slots);
}
?>