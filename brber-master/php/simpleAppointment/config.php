<?php
$mysqli = new mysqli("localhost", "root", "", "southside_db");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>