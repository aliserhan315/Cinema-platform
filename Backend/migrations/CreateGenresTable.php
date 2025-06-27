<?php 
require("../connection/connection.php");


$query = "
CREATE TABLE IF NOT EXISTS genres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) UNIQUE NOT NULL);";

$execute = $mysqli->prepare($query);
$execute->execute();