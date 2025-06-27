<?php 
require("../connection/connection.php");


$query = "
CREATE TABLE IF NOT EXISTS films (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    release_date DATE,
    rating varchar(10),
    duration INT,
    trailer_url VARCHAR(255),
    poster_image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    age_restriction INT
);";

$execute = $mysqli->prepare($query);
$execute->execute();