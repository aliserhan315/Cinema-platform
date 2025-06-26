<?php 
require("../connection/connection.php");


$query = "
CREATE TABLE IF NOT EXISTS user_genres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    genre_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (genre_id) REFERENCES genres(id) ON DELETE CASCADE,
);";

$execute = $mysqli->prepare($query);
$execute->execute();