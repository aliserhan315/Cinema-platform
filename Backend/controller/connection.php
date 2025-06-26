<?php
$host = "localhost";
$username = "ali";
$password = "ali123";
$database = "cinema";
try {
    $mysqli = new mysqli($host, $database, $username, $password);
} catch (mysqli_sql_exception $e) {
    die("Connection failed: " . $e->getMessage());
}
