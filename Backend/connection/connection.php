<?php
$host = "localhost";
$username = "ali";
$password = "ali123";
$database = "cinema";
try {
    $mysqli = new mysqli($host, $username, $password, $database);
} catch (mysqli_sql_exception $e) {
    die("Connection failed: " . $e->getMessage());
}
