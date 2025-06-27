<?php 
require("../connection/connection.php");


$query = "
CREATE TABLE IF NOT EXISTS auditoriums (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    seat_rows INT NOT NULL,
    seat_columns INT NOT NULL
);";

$execute = $mysqli->prepare($query);
$execute->execute();