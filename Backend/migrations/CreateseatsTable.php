<?php 
require("../connection/connection.php");


$query = "
CREATE TABLE IF NOT EXISTS seats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    auditorium_id INT NOT NULL,
    seat_row INT NOT NULL,
    seat_column INT NOT NULL,
    seat_type VARCHAR(50),
    FOREIGN KEY (auditorium_id) REFERENCES auditoriums(id) ON DELETE CASCADE
);";

$execute = $mysqli->prepare($query);
$execute->execute();